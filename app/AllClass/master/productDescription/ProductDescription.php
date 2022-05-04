<?php


namespace App\AllClass\master\productDescription;


use App\AllClass\db\QueryHandler;
use App\AllClass\PdfOrZipFormatValidator;
use App\AllClass\specialCharValidation;
use App\AllClass\TableSetting;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\master\CSVLogger;
use App\AllClass\zenkaku;
use App\AllClass\ZenkakuNew;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Helper;

class ProductDescription
{
    public static $page_no = '08-15';

    public static function headers($bango, $type = null)
    {
        $headers = [
            '商品説明CD区分' => 'url',
            '商品説明CD' => 'product_des_urlsm',
            '商品名' => 'shohin1_name',
            '見積明細備考' => 'mbcatch',
            'サービス内容' => 'setumei',
            '工数目安' => 'catch',
            '成果物' => 'caption',
            '社内備考' => 'catchsm',
            '販売時留意点' => 'mbcatchsm',
            '商品説明PDF' => 'mbcaption',
            '補足説明' => 'supplementary_explanation',
            '入力区分' => 'datatxt0096',
            '登録年月日' => 'created_date',
            '登録時刻' => 'created_time',
            '更新年月日' => 'edited_date',
            '更新時刻' => 'edited_time',
            // '更新時端末IP' => 'ip_address',
            '更新者' => 'created_by'
        ];
        $pageNo = static::$page_no;
        if ($type) {
            return TableSetting::getHeaders($bango, $pageNo, $headers, $type);
        }
        return TableSetting::getHeaders($bango, $pageNo, $headers);
    }

    public static function create($request, $bango, $file, $headers, $validate_only = 0)
    {
        foreach ($request as $key => $value) {
            if ($key == '_token' || $key == 'type' || $key == 'submit_url' || $key == "chkboxinp") {
                unset($request[$key]);
            }
            if ($value == "") {
                $request[$key] = null;
            }
        }
        $validator = self::validate($request, $bango);
        $errors = $validator->errors();

        if ($errors->any() || Input::has('field')) {
            return $errors;
        } else {
            if ($validate_only != '1') {
                $tantousha = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
                $bangoName = $tantousha->name ?? null;
                $urlsm = $request['urlsm'];
                $syhohinBango = QueryHelper::fetchSingleResult("select count(*) from gazou where hyouji = 0 ")->count;
                $syhohinBango += 1;
                $url = $request['url'];
                $requestTable = QueryHelper::fetchSingleResult("select * from request where jouhou = '$url' and syouhinbango is not null ");
                $url = $requestTable->syouhinbango . " " . $requestTable->jouhou;
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 商品説明マスタ start\n";
                QueryHandler::logger($bango, $log_data);
                $insert = [
                    'url' => trim($url),
                    'urlsm' => trim($urlsm),
                    'mbcatch' => trim($request['mbcatch']),
                    'setumei' => trim($request['setumei']),
                    'catch' => trim($request['catch']),
                    'caption' => trim($request['caption']),
                    'catchsm' => trim($request['catchsm']),
                    'mbcatchsm' => trim($request['mbcatchsm']),
                    'mbcaption' => trim($request['inp2']),
                    'hyouji' => 0,
                    'datatxt0098' => trim(self::getCurrentTime()),
                    //'datatxt0100' => Helper::getSystemIP(),
                    'datatxt0101' => $bango,
                    'datatxt0096' => trim($request['datatxt0096']),
                    'syouhinbango' => $syhohinBango

                ];
                $gazou = QueryHelper::insertData('gazou', $insert, 'urlsm', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                if ($gazou) {
                    if ($file != "") {
                        $file->move(public_path('uploads/product_des_master'), $file->getClientOriginalName());
                    }
                }
                \session()->flash('success_msg', '商品説明コード ' . $urlsm . ' 登録完了しました。');
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 商品説明マスタ end\n";
                QueryHandler::logger($bango, $log_data);
                $query = AllProductDescription::data($bango);
                $query .= " where urlsm = '$gazou->urlsm'";

                $data = QueryHelper::fetchSingleResult($query);
                $headers['データ有効区分'] = 'hyouji';
                CSVLogger::putData('productDescriptionMaster.csv', 'gazou', $data, $data, $bangoName, $headers, 1);
                $result['id'] = $gazou->urlsm;
            }
            $result['status'] = 'ok';
            return $result;
        }
    }

    public static function edit($request, $bango, $file, $headers, $validate_only = 0)
    {

        foreach ($request as $key => $value) {
            if ($key == '_token' || $key == 'type' || $key == 'submit_url' || $key == "chkboxinp") {
                unset($request[$key]);
            }
            if ($value == "") {
                $request[$key] = null;
            }
        }
        $validator = self::validate($request, $bango);

        $errors = $validator->errors();

        if ($errors->any() || Input::has('field')) {
            return $errors;
        } else {
            if ($validate_only != '1') {
                $tantousha = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
                $bangoName = $tantousha->name ?? null;

                $productDesBango = $request['productDesBango'];
                $query = AllProductDescription::data($bango);
                $query .= " where urlsm =  '$productDesBango'";
                $updateBefore = QueryHelper::fetchSingleResult($query);

                $new_inp2 = request('new_inp2');
                $old_inp2 = request('old_inp2');
                if ($old_inp2 == $new_inp2) {
                    $inp2 = $old_inp2;
                } else {
                    $inp2 = $new_inp2;
                }
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 商品説明マスタ start\n";
                QueryHandler::logger($bango, $log_data);
                $update = [
                    'urlsm' => trim($productDesBango),
                    'mbcatch' => trim($request['mbcatch']),
                    'setumei' => trim($request['setumei']),
                    'catch' => trim($request['catch']),
                    'caption' => trim($request['caption']),
                    'catchsm' => trim($request['catchsm']),
                    'mbcatchsm' => trim($request['mbcatchsm']),
                    'mbcaption' => trim($inp2),
                    'datatxt0099' => trim(self::getCurrentTime()),
                    // 'datatxt0100' => Helper::getSystemIP(),
                    'datatxt0101' => $bango,
                    'datatxt0096' => trim($request['datatxt0096'])
                ];
                $dataUpdate = QueryHelper::updateData('gazou', $update, 'urlsm', $bango, __CLASS__, __FUNCTION__, __LINE__);
                if ($dataUpdate) {
                    if ($old_inp2 != $new_inp2) {
                        $file_path = public_path() . '/uploads/product_des_master/' . $old_inp2;
                        \File::delete($file_path);
                        $file->move(public_path('/uploads/product_des_master/'), $file->getClientOriginalName());
                    }
                }

                $urlsm = $updateBefore->urlsm;
                \session()->flash('success_msg', '商品説明コード ' . $urlsm . '  変更完了しました。');
                $updateAfter = QueryHelper::fetchSingleResult($query);
                $headers['データ有効区分'] = 'hyouji';
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 商品説明マスタ end\n";
                QueryHandler::logger($bango, $log_data);
                CSVLogger::putData('productDescriptionMaster.csv', 'gazou', $updateBefore, $updateAfter, $bangoName, $headers, 2);
                $result['id'] = $productDesBango;
            }
            $result['status'] = 'ok';
            return $result;
        }
    }

    public static function validate($request, $bango)
    {
        $rules = [];
        if (Input::has('field')) {
            if (request('type') == 'create') {
                $rules['urlsm'] = ['required', new UniqueUrlsm($request['urlsm']), 'regex:/^[0-9]+$/', new CheckProductionDescriptionCd($request['url'])];
            }
            $rules['mbcatch'] = ['nullable', 'max:30', new ZenkakuNew];
            $rules['setumei'] = ['nullable', new ZenkakuNew, new CheckMaxLengthAfterRemoveNewLine(180)];
            $rules['catch'] = ['nullable', new ZenkakuNew, new CheckMaxLengthAfterRemoveNewLine(260)];
            $rules['caption'] = ['nullable', new ZenkakuNew, new CheckMaxLengthAfterRemoveNewLine(50)];
            $rules['catchsm'] = ['nullable', new ZenkakuNew, new CheckMaxLengthAfterRemoveNewLine(60)];
            $rules['mbcatchsm'] = ['nullable', new ZenkakuNew, new CheckMaxLengthAfterRemoveNewLine(200)];
            $rules['mbcaption'] = ['nullable', 'max:10000'];
            if (request('type') == 'create') {
                $rules['inp2'] = ['nullable', 'max:50'];
            } else {
                $rules['new_inp2'] = ['nullable', 'max:50'];
            }
            //$rules['datatxt0096'] = ['required', 'max:100000', 'regex:/^([a-zA-Z0-9.])*$/'];
        } else {
            if (request('type') == 'create') {
                $rules['urlsm'] = ['required', new UniqueUrlsm($request['urlsm']), 'regex:/^[0-9]+$/', new CheckProductionDescriptionCd($request['url']), new CheckForProductOrProductSub($request['url'])];
            }
            $rules['mbcatch'] = ['nullable', 'max:30', new specialCharValidation, new ZenkakuNew];
            $rules['setumei'] = ['nullable', new ZenkakuNew, new CheckMaxLengthAfterRemoveNewLine(180), new specialCharValidation];
            $rules['catch'] = ['nullable', new ZenkakuNew, new CheckMaxLengthAfterRemoveNewLine(260), new specialCharValidation];
            $rules['caption'] = ['nullable', new ZenkakuNew, new CheckMaxLengthAfterRemoveNewLine(50), new specialCharValidation];
            $rules['catchsm'] = ['nullable', new ZenkakuNew, new CheckMaxLengthAfterRemoveNewLine(60), new specialCharValidation];
            $rules['mbcatchsm'] = ['nullable', new ZenkakuNew, new CheckMaxLengthAfterRemoveNewLine(200), new specialCharValidation];
            $rules['mbcaption'] = ['nullable', 'max:10000', 'mimes:zip,pdf', new specialCharValidation];
            if (request('type') == 'create') {
                $rules['inp2'] = ['nullable', 'max:50', new specialCharValidation, new PdfOrZipFormatValidator];
            } else {
                $rules['new_inp2'] = ['nullable', 'max:50', new specialCharValidation, new PdfOrZipFormatValidator];
            }
            //$rules['datatxt0096'] = ['required', 'max:100000', new CheckForProductCdInputCategory(), 'regex:/^([a-zA-Z0-9.])*$/'];
        }
        $messages = [];
        $messages['required'] = '【:attribute】必須項目に入力がありません。';
        $messages['max'] = '【:attribute】:max 桁以下で入力してください。';
        $messages['regex'] = '【:attribute】半角数字以外は使用できません。';
        $messages['mbcaption.mimes'] = '';
        //$messages['urlsm.unique'] = '【:attribute】このCDは既に登録されています。';
        //  $messages['mbcaption.size'] = '【:attribute】file must not greater than 2 mb 。';


        $attributes = [
            'urlsm' => '商品説明CD',
            'mbcatch' => '見積明細備考',
            'setumei' => 'サービス内容',
            'catch' => '工数目安',
            'caption' => '成果物',
            'catchsm' => '社内備考',
            'mbcatchsm' => '販売時留意点',
            'mbcaption' => '商品説明PDF',
            'inp2' => '商品説明PDF',
            'new_inp2' => '商品説明PDF',
            'datatxt0096' => '入力区分',

        ];
        if (Input::has('field')) {
            $front_field = explode(",", request('field'));
            foreach ($rules as $key => $val) {
                if (!in_array($key, $front_field)) {
                    unset($rules[$key]);
                }
            }
        }
        return Validator::make($request, $rules, $messages, $attributes);
    }

    public static function getCurrentTime()
    {
        $mytime = \Carbon\Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        $mytime = str_replace(" ", "", $mytime);
        return $mytime;
    }

    public static function getDataTxt96($request)
    {
        $syouhinBango = $request['datatxt0096'];
        if (is_null($syouhinBango)) {
            return null;
        }
        $query = "select * from request where color = '0815入力区分' and syouhinbango = '$syouhinBango' ";
        $datatxt0096 = QueryHelper::fetchSingleResult($query);
        if (!$datatxt0096) {
            return null;
        }
        return $datatxt0096->syouhinbango . ' ' . $datatxt0096->jouhou;
    }
}
