<?php

namespace App\Http\Controllers\master;

use App\AllClass\db\QueryHandler;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\master\CSVLogger;
use App\AllClass\master\csvRecordDelete;
use App\AllClass\master\csvRecordRetrieve;
use App\AllClass\master\customerProduct\AllCustomerProduct;
use App\AllClass\master\customerProduct\CustomerProduct;
use App\AllClass\master\employeeMaster\ButtonMsg;
use App\AllClass\master\excelDownload;
use App\AllClass\master\ExcelReportDownload;
use App\AllClass\SearchClass;
use App\AllClass\SortClass;
use App\AllClass\TableSetting;
use App\categorykanri;
use App\Kakaku;
use App\kokyaku1;
use App\requestTable;
use App\syouhin1;
use App\tantousya;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Excel;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

class CustomerProductMasterController extends Controller
{
    private $headers = [
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
        //'更新時端末IP' => 'datatxt0081',
        '更新者' => 'created_by'
    ];

    public function postMethod(Request $request)
    {
        $bango = request('userId');
        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $buttonMessage = ButtonMsg::read($bango);
        $data_from_view=$request->all();
        $data_from_view_session=$request->all();
        session()->put('oldInput'.$bango,$data_from_view_session);
        //string to int conversion search, check leading zeroes, lzc=leading zero check
        $lzcKeys = ['company_search_sort','product_search_sort'];
        $data_from_view = $this->stringToIntSearch($data_from_view, $lzcKeys);

        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 20;
        }

        if (!empty($data_from_view['chkboxinp'])) {
            $deleted_item = $data_from_view['chkboxinp'];
        } else {
            $deleted_item = 0;
        }
        $headers = CustomerProduct::headers($bango);
        $table_headers = CustomerProduct::headers($bango, 'table_headers');
        $page_no = CustomerProduct::$page_no;
        $route = 'customerProductManagementTableSetting';
        $redirect_path = 'customerProductReload';
        //$kokyaku1s = kokyaku1::orderBy('bango', 'asc')->whereNotNull('yobi12')->where('denpyosaiban', 0)->get();
        //$categorykanries = categorykanri::where('category1','D5')->get();
        //$syouhin1s = syouhin1::all();
        //$requestColors = requestTable::where('color', '0813単価区分')->orderBy('syouhinbango', 'asc')->whereNotNull('jouhou')->whereNotNull('syouhinbango')->get();
        $kokyaku1s = QueryHelper::select(['*'])->from('kokyaku1')->where('yobi12 is not null')->where("denpyosaiban = 0")->orderBy('yobi12 asc')->get()->execute();
        $categorykanries = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'D5' ")->get()->execute();
        $syouhin1s = QueryHelper::fetchResult("select distinct syouhin1.* from syouhin1 join kakaku on kakaku.syouhinbango = syouhin1.bango join syouhin2 on syouhin2.bango = syouhin1.bango where syouhin1.isuriage = 0 order by syouhin1.bango");
        $requestColors = QueryHelper::select(['*'])->from('request')->where("color = '0813単価区分'")->where('jouhou is not null')->where('syouhinbango is not null')->orderBy('syouhinbango')->get()->execute();
        $inputCategory1s = QueryHelper::select(['*'])->from('request')->where("color = '0813入力区分1'")->where('jouhou is not null')->where('syouhinbango is not null')->get()->execute();
        $inputCategory2s = QueryHelper::select(['*'])->from('request')->where("color = '0813入力区分2'")->where('jouhou is not null')->where('syouhinbango is not null')->get()->execute();
        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;
        if (!empty($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls')) {
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp'];
            $query = AllCustomerProduct::data($bango, $deleted_item);
            $temp_table = 'customer_product_temp';
            try {
                //modify number format fields
                $str_to_int = ['hanbaisu', 'icon', 'kakaku', 'jyougensu', 'yoyaku', 'yoyakusu', 'yoyakukanousu', 'sortbango', 'dataint01'];
                foreach ($data_from_view as $key => $value) {
                    if (in_array($key, $str_to_int)) {
                        $data_from_view[$key] = str_replace(',', '', $data_from_view[$key]);
                    }
                }
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort') {
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);
                    $kokyakus = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    if ($kokyakus->items() == null && $kokyakus->currentPage() != 1) {
                        $currentPage = ($kokyakus->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $kokyakus = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);

                    }
                    if ($kokyakus->total() == 0) {
                        $exceedKokyakus = '該当するデータがありません。';
                    } else {
                        $exceedKokyakus = '';
                    }
                } else if ($data_from_view['Button'] == 'xls') {
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);
                    $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                    $headers = $this->headers;
                    $excelName = '得意先別商品マスタ.xlsx';
                    return $this->excelDownload($headers, $searched, $excelName);
                }
            } catch (\Exception $e) {
                $exceedKokyakus = '検索形式が間違っています。';
                $kokyakus = QueryHelper::fetchResult($query);
                $kokyakus = collect($kokyakus)->paginate($pagination);
            }
            return view('master.customer_product.main', compact('tantousya', 'bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'kokyakus', 'kokyaku1s', 'syouhin1s', 'requestColors', 'inputCategory1s', 'inputCategory2s', 'deleted_item', 'pagi', 'deleted_item', 'buttonMessage', 'categorykanries', 'exceedKokyakus'));
        }
        $exceedKokyakus = '';
        if (request('change_id')) {
            $changeId = request('change_id');
            $query = AllCustomerProduct::data($bango, $deleted_item);
            $query .= " and uuid = '$changeId'";
        } else {
            $query = AllCustomerProduct::data($bango, $deleted_item);
        }
        $kokyakus = QueryHelper::fetchResult($query);
        $kokyakus = collect($kokyakus)->paginate($pagi);
        session()->forget('oldInput' . $bango);
        return view('master.customer_product.main', compact('tantousya', 'bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'kokyakus', 'kokyaku1s', 'syouhin1s', 'requestColors', 'inputCategory1s', 'inputCategory2s', 'deleted_item', 'pagi', 'deleted_item', 'buttonMessage', 'categorykanries', 'exceedKokyakus'));

    }

    public function customerProductDetail($bango)
    {
        $uuid = \request('id');
        $query = AllCustomerProduct::data($bango);
        $query .= " where uuid = '$uuid'";
        $data['kakaku'] = QueryHelper::fetchSingleResult($query);
        return $data;
    }

    public function deleteCustomerProductDetail($bango, $type = null)
    {
        $uuid = \request('id');
        $extractUuid = explode('|',$uuid);
        $syutenjyouken = $extractUuid[0];
        $syutenbi = $extractUuid[1];
        $icon = $extractUuid[2];

        $tantousha = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $bangoName = $tantousha->name ?? null;
        $query = AllCustomerProduct::data($bango);
        $query .= "where uuid = '$uuid'";
        $deleteBefore = QueryHelper::fetchSingleResult($query);
        $condition = ['syutenjyouken' => $syutenjyouken,'syutenbi'=>$syutenbi,'icon'=>$icon];
        //start log query
        $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 得意先別商品マスタ start\n";
        QueryHandler::logger($bango,$log_data);
        if ($type == 1) {
            $updateData = [
                'pointritu' => 0,
                'datatxt0080' => CustomerProduct::getCurrentTime(),
                'pcsyuten' => $bango,
              //  'datatxt0081' => Helper::getSystemIP()
            ];
            QueryHelper::updateData('kakaku',$updateData,$condition,$bango,__CLASS__,__FUNCTION__,__LINE__);
        } else {
            $updateData = [
                'pointritu' => 1,
                'datatxt0080' => CustomerProduct::getCurrentTime(),
                'pcsyuten' => $bango,
             //   'datatxt0081' => Helper::getSystemIP()
            ];
            QueryHelper::updateData('kakaku',$updateData,$condition,$bango,__CLASS__,__FUNCTION__,__LINE__);
        }
        $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 得意先別商品マスタ end\n";
        QueryHandler::logger($bango,$log_data);
        $query = AllCustomerProduct::data($bango);
        $query .= "where uuid = '$uuid'";
        $deleteAfter = QueryHelper::fetchSingleResult($query);
        $headers = $this->headers;
        $headers['データ有効区分'] = 'pointritu';
        if ($type == 1) {
            CSVLogger::putData('customerProductMaster.csv', 'kakaku', $deleteBefore, $deleteAfter, $bangoName, $headers, 3);
        } else {
            CSVLogger::putData('customerProductMaster.csv', 'kakaku', $deleteBefore, $deleteAfter, $bangoName, $headers, 0);
        }
        return 'ok';

    }

    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = CustomerProduct::$page_no;

        return $Setting = TableSetting::setting($this->headers, $id, $pageNo);

    }

    public function tableSettingSave(Request $request, $id, $type = null)
    {

        $pageNo = CustomerProduct::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '得意先別商品マスタ', $type);
    }

    public function postEditCustomerProduct(Request $request, $bango)
    {

        if (request('type') == 'create') {
            $insert = CustomerProduct::create($request->all(), $bango, $this->headers, request('validate_only'));

            if (is_array($insert) && ($insert['status'] == 'ok' || $insert['status'] == 'error')) {
                return $insert;
            } else {
                $errors = $insert->all();
                return ['err_field' => $insert, 'err_msg' => $errors];
            }
        } elseif (request('type') == 'edit') {

            $insert = CustomerProduct::edit($request->all(), $bango, $this->headers, request('validate_only'));
            if (is_array($insert) && $insert['status'] == 'ok') {
                return $insert;
            } else {
                $errors = $insert->all();
                return ['err_field' => $insert, 'err_msg' => $errors];
            }
        }
    }
}
