<?php

namespace App\AllClass\master\customerProduct;


use App\AllClass\CheckTotalValueLessThanForOperatingMargin;
use App\AllClass\CheckTotalValueLessThanForPBOperatingGross;
use App\AllClass\CheckValueLessThan;
use App\AllClass\db\QueryHandler;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\master\CSVLogger;
use App\AllClass\master\csvRecordEdit;
use App\AllClass\master\csvRecordInsert;
use App\AllClass\TableSetting;
use App\Kakaku;
use App\kengen;
use App\syouhin1;
use App\tantousya;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Helpers\Helper;

class CustomerProduct
{
    public static $page_no = '08-13';

    public static function headers($bango, $type = null)
    {
        $headers = [
            '会社CＤ' => 'company_name',
            '商品ＣＤ' => 'product_name',
            '単価区分' => 'icon',
            '基本販売価格' => 'formatted_kakaku',
            'ＰＢ販売価格' => 'formatted_hanbaisu',
            '営業粗利' => 'formatted_jyougensu',
            'ＰＢ営業粗利' => 'formatted_yoyaku',
            '仕入価格' => 'formatted_yoyakusu',
            '仕切（SE）' => 'formatted_yoyakukanousu',
            '仕切（研究所）' => 'formatted_sortbango',
            '仕切（出荷ｾﾝﾀｰ）' => 'formatted_dataint01',
            '入力区分1' => 'datachar01',
            '入力区分2' => 'datachar02',
            '登録年月日' => 'created_date',
            '登録時刻' => 'created_time',
            '更新年月日' => 'edited_date',
            '更新時刻' => 'edited_time',
           // '更新時端末IP' => 'datatxt0081',
            '更新者' => 'created_by'
        ];
        $pageNo = static::$page_no;
        if ($type) {
            return TableSetting::getHeaders($bango, $pageNo, $headers, $type);
        }
        return TableSetting::getHeaders($bango, $pageNo, $headers);

    }

    public static function create($request, $bango, $headers, $validate_only=0)
    {
        foreach ($request as $key => $value) {
            if ($key == '_token' || $key == 'type' || $key == 'url') {
                unset($request[$key]);
            }
            if ($value == "") {
                $request[$key] = null;
            }
        }

        $syutenbi = trim(explode('-', $request['product_id'])[0]) ?? null;
        $syouhinBango = trim(explode('-', $request['product_id'])[1]) ?? null;
        $company_id = $request['company_id'];
        $unit_price = $request['unit_price'];
//        $data = (bool)QueryHelper::fetchSingleResult("select count(*) from kakaku where syutenjyouken = '$company_id' and syutenbi = '$syutenbi' and icon = '$unit_price' ")->count;
//        if ($data) {
//            $result['status'] = 'error';
//            $result['error_mesasge'] = '「 同じ会社CD、商品CD,単価区分の価格が登録済みです。変更画面から変更してください。」';
//            return $result;
//        }

        $validator = self::validation($request, $bango,'create');

        $errors = $validator->errors();

        if ($errors->any() || Input::has('field')) {
            return $errors;
        } else {
            if($validate_only!='1'){
                $tantousha = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
                $bangoName = $tantousha->name ?? null;
                $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 得意先別商品マスタ start\n";
                QueryHandler::logger($bango,$log_data);
                $insert = [
                    'syutenjyouken' => trim($company_id) ?? null,
                    'syutenbi' => $syutenbi,
                    'icon' => trim($unit_price) ?? null,
                    'kakaku' =>  $request['basic_selling'] ?? null,
                    'hanbaisu' => $request['pb_sales'] ?? null,
                    'jyougensu' =>  $request['operating_margin'] ?? null,
                    'yoyaku' =>  $request['pb_operating_gross'] ?? null,
                    'yoyakusu' =>  $request['purchase_price'] ?? null,
                    'yoyakukanousu' =>  $request['partition_se'] ?? null,
                    'sortbango' => $request['partition_lab'] ?? null,
                    'dataint01' => $request['partition_shopping'] ?? null,
                    'datachar01' => trim($request['input_category_1']) ?? null,
                    'datachar02' => trim($request['input_category_2']) ?? null,
                    'pointritu' => 0,
                    'datachar03' => trim(self::getCurrentTime()),
                  //  'datatxt0081' => Helper::getSystemIP(),
                    'datatxt0082' => $bango,
                    'syouhinbango' => $syouhinBango
                ];
                Session::flash('success_msg', '得意先別商品CD ' . $syutenbi . ' 登録完了しました。');
                QueryHelper::insertData('kakaku', $insert, ['syutenjyouken', 'syutenbi', 'icon'],false,$bango,__CLASS__,__FUNCTION__,__LINE__);

                $implodeArray = [trim($company_id), $syutenbi, trim($unit_price)];
                $result['datachar03'] = implode('|', $implodeArray);
                $uuid = $result['datachar03'];
                $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 得意先別商品マスタ end\n";
                QueryHandler::logger($bango,$log_data);
                $query = AllCustomerProduct::data($bango);
                $query .= "where uuid = '$uuid'";
                $data = QueryHelper::fetchSingleResult($query);
                $headers['データ有効区分'] = 'pointritu';
                CSVLogger::putData('customerProductMaster.csv', 'kakaku', $data, $data, $bangoName, $headers, 1);
            }
            $result['status'] = 'ok';
            return $result;
        }
    }

    public static function edit($request, $bango, $headers, $validate_only=0)
    {
        foreach ($request as $key => $value) {
            if ($key == '_token' || $key == 'type' || $key == 'url') {
                unset($request[$key]);
            }
            if ($value == "") {
                $request[$key] = null;
            }
        }

        $validator = self::validation($request, $bango,'edit');

        $errors = $validator->errors();

        if ($errors->any() || Input::has('field')) {
            return $errors;
        } else {
            if($validate_only!='1'){
                $tantousha = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
                $bangoName = $tantousha->name ?? null;
                $uuid = $request['customerProductBango'];

                $syutenbi = trim(explode('-', $request['product_id'])[0]) ?? null;
                $syouhinBango = explode('-', $request['product_id'])[1] ?? null;
                $query = AllCustomerProduct::data($bango);
                $query .= "where uuid = '$uuid'";
                $updateBefore = QueryHelper::fetchSingleResult($query);
                $syutenjyouken = trim($request['company_id']);
                $icon = trim($request['unit_price']);
                $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 得意先別商品マスタ start\n";
                QueryHandler::logger($bango,$log_data);
                $update = [
                    'syutenjyouken' => $syutenjyouken ?? null,
                    'syutenbi' => $syutenbi,
                    'icon' => $icon ?? null,
                    'kakaku' => $request['basic_selling'] ?? null,
                    'hanbaisu' => $request['pb_sales'] ?? null,
                    'jyougensu' => $request['operating_margin'] ?? null,
                    'yoyaku' => $request['pb_operating_gross'] ?? null,
                    'yoyakusu' => $request['purchase_price'] ?? null,
                    'yoyakukanousu' => $request['partition_se'] ?? null,
                    'sortbango' => $request['partition_lab'] ?? null,
                    'dataint01' => $request['partition_shopping'] ?? null,
                    'datachar01' => trim($request['input_category_1']) ?? null,
                    'datachar02' => trim($request['input_category_2']) ?? null,
                    'datatxt0080' => trim(self::getCurrentTime()),
                    'syouhinbango' => $syouhinBango,
               //     'datatxt0081' => Helper::getSystemIP(),
                    'pointritu' => 0,
                    'datatxt0082' => $bango
                ];
                QueryHelper::updateData('kakaku', $update, ['syutenjyouken' => $syutenjyouken, 'syutenbi' => $syutenbi, 'icon' => $icon],$bango,__CLASS__,__FUNCTION__,__LINE__);
                Session::flash('success_msg', '得意先別商品CD ' . $syutenbi . ' 変更完了しました。');
                $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 得意先別商品マスタ end\n";
                QueryHandler::logger($bango,$log_data);
                $updateAfter = QueryHelper::fetchSingleResult($query);
                $headers['データ有効区分'] = 'pointritu';
                CSVLogger::putData('customerProductMaster.csv', 'kakaku', $updateBefore, $updateAfter, $bangoName, $headers, 2);
                $result['datachar03'] = $uuid;
            }
            $result['status'] = 'ok';
            return $result;
        }

    }


    public static function validation($request, $bango,$mode)
    {
        $rules = [];
        if (Input::has('field')) {
            $rules['basic_selling'] = ['nullable', 'numeric', 'max:99999999', 'min:0'];
            $rules['pb_sales'] = ['nullable', 'numeric', 'max:99999999', 'min:0'];
            $rules['operating_margin'] = ['nullable', 'numeric', 'max:99999999', 'min:0'];
            $rules['pb_operating_gross'] = ['nullable', 'numeric', 'max:99999999', 'min:0'];
            $rules['purchase_price'] = ['nullable', 'numeric', 'max:99999999', 'min:0'];
            $rules['partition_se'] = ['nullable', 'numeric', 'max:99999999', 'min:0'];
            $rules['partition_lab'] = ['nullable', 'numeric', 'max:99999999', 'min:0'];
            $rules['partition_shopping'] = ['nullable', 'numeric', 'max:99999999', 'min:0'];
            $rules['input_category_1'] = ['required'];
        } else {
            $syutenbi = trim(explode('-', $request['product_id'])[0]) ?? null;
            $company_id = $request['company_id'];
            $unit_price = $request['unit_price'];
            if($mode == 'create'){
                $rules['company_id'] = ['required',new UniqueCustomerProduct($company_id,$syutenbi,$unit_price)];
            }else{
                $rules['company_id'] = ['required'];
            }
            $rules['product_id'] = ['required'];
            $rules['unit_price'] = ['required'];
            $rules['basic_selling'] = ['nullable', 'numeric', 'max:99999999', 'min:0'];
            $rules['pb_sales'] = ['nullable', 'numeric', 'max:99999999', 'min:0'];
            $rules['operating_margin'] = ['nullable', 'numeric', 'max:99999999', 'min:0'];
            $rules['pb_operating_gross'] = ['nullable', 'numeric', 'max:99999999', 'min:0'];
            $rules['purchase_price'] = ['nullable', 'numeric', 'max:99999999', 'min:0'] ;
            $rules['partition_se'] = ['nullable', 'numeric', 'max:99999999', 'min:0'];
            $rules['partition_lab'] = ['nullable', 'numeric', 'max:99999999', 'min:0'];
            $rules['partition_shopping'] = ['nullable', 'numeric', 'max:99999999', 'min:0'];
            $rules['input_category_1'] = ['required'];
        }

        $messages = [];
        $messages['required'] = '【:attribute】必須項目に入力がありません。';
        $messages['numeric'] = '【:attribute】半角数字以外は使用できません。';
        $messages['max'] = '【:attribute】8桁以下で入力してください。';
        $messages['min'] = '【:attribute】基本販売金額より大きい金額は入力できません。';
        $messages['operating_margin.min'] = '【営業粗利】合計金額が基本販売価格を上回っています。';
        $messages['pb_operating_gross.min'] = '【PB営業粗利】合計金額がPB販売価格を上回っています。';



        $attributes = [
            'company_id' => '会社CD',
            'product_id' => '商品CD',
            'unit_price' => '単価区分',
            'basic_selling' => '基本販売価格',
            'pb_sales' => 'PB販売価格',
            'operating_margin' => '営業粗利',
            'pb_operating_gross' => 'PB営業粗利',
            'purchase_price' => '仕入価格',
            'partition_se' => '仕切(SE)',
            'partition_lab' => '仕切(研究所)',
            'partition_shopping' => '仕切(出荷センター)',
            'input_category_1' => '入力区分1'
        ];
        if (Input::has('field')) {
            $front_field = explode(",", request('field'));
            foreach ($rules as $key => $val) {
                if ($key != 'operating_margin' || $key != 'pb_operating_gross') {

                } else if (!in_array($key, $front_field)) {
                    unset($rules[$key]);
                }
            }
        }
        return Validator::make($request, $rules, $messages, $attributes);
    }

    public static function getCurrentTime()
    {
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        $mytime = str_replace(" ", "", $mytime);
        return $mytime;
    }

}
