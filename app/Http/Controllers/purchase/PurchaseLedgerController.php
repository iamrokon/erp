<?php

namespace App\Http\Controllers\purchase;
use Illuminate\Http\Request;
use App\tantousya;
use App\kengen;
use App\requestTable;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\purchase\purchaseLedger\PurchaseLedgerHeaders;
use App\AllClass\purchase\purchaseLedger\ValidatePurchaseLedger;
use App\AllClass\purchase\purchaseLedger\AllPurchaseLedger;
use App\AllClass\ButtonMsg;
use Illuminate\Pagination\Paginator;
use App\AllClass\master\excelDownload;
use App\kokyaku1;
use App\AllClass\TableSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Excel;
use App\AllClass\master\ExcelReportDownload;
use Carbon\Carbon;
use App\AllClass\master\CSVLogger;
use App\AllClass\newExcelExport;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;

class PurchaseLedgerController extends Controller
{
    private $headers = [
        '日付' => 'touchakudate',
        '区分' => 'toiawasebango',
        '伝票番号' => 'syouhinid',
        '行' => 'syouhinsyu',
        '品名・備考' => 'datachar08',
        '数' => 'formatted_purchase_ledger_nyukosu',
        '単価/期日' => 'formatted_purchase_ledger_kingaku',
        '金額' => 'formatted_purchase_ledger_syouhizeiritu',
        '支払額' => 'formatted_purchase_ledger_payment_amount',
        '買掛残高' => 'formatted_purchase_ledger_accounts_payable',
        '会計科目CD' => 'barcode',
        '会計内訳CD' => 'codename',
        '明細備考' => 'datachar11',
    ];


    public function postPurchaseLedger(Request $request)
    {
        $bango = request('userId');

        //check validation for first search
        if($request->ajax()){
            $validator = ValidatePurchaseLedger::validate($request,$bango);
            $errors = $validator->errors();
            if($errors->any()){
               $err_msg = $errors->all();
               return ['err_field'=>$errors,'err_msg'=>$err_msg];
            }else{
                return "ok";
            }
        }

        $data_from_view = $request->all();
        $data_from_view_session = $request->all();
        session()->put('oldInput' . $bango, $data_from_view);

        $tantousya = tantousya::find($bango);


        $buttonMessage = ButtonMsg::read($bango);

        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 20;
        }


        $headers = PurchaseLedgerHeaders::headers($bango);
        $table_headers = PurchaseLedgerHeaders::headers($bango, 'table_headers');
        $page_no = PurchaseLedgerHeaders::$page_no;
        $route = 'purchaseLedgerTableSetting';
        $redirect_path = 'purchaseLedgerReload';
        $balance_of_prev_month = 0;
        

        $temp_table = 'purchase_ledger_temp';

        //show page start here
        if (isset($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh')) {
            $fsRemoveKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp'];
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp','touchakudate_start','touchakudate_end','bikou1','bikou1_text'];

            try {
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh') {
                    //clear bottom search request data
                    if($data_from_view['Button'] == 'refresh'){
                        $data_from_view = self::clearBottomReqData($data_from_view);
                    }
                    
                    //default req data
                    $default_data =  $data_from_view;

                    //formatted first search data
                    $defalut_check = 0;
                    $req_data = $this->removeDataFromView($data_from_view, $fsRemoveKeys);
                    foreach ($req_data as $key => $value) {
                        if (strpos($key, 'ReqVal') !== false) {
                            $defalut_check++;
                            $new_key = str_replace('ReqVal', '', $key);
                            if (array_key_exists($new_key,$req_data)){ //when pagination change
                                $req_data[$new_key] = $req_data[$new_key];
                            }else{
                                $req_data[$new_key] = $value;
                            }
                            unset($req_data[$key]);
                        }
                    }
                    
                    //remove comma from formatted value
                    $str_to_int = ['purchase_ledger_nyukosu','purchase_ledger_kingaku','purchase_ledger_syouhizeiritu','purchase_ledger_payment_amount', 'purchase_ledger_accounts_payable'];
                    foreach ($data_from_view as $key => $value) {
                        if (in_array($key, $str_to_int)) {
                            $data_from_view[$key] = str_replace(',', '', $data_from_view[$key]);
                        }
                    }

                    $data = $this->removeDataFromView($data_from_view, $removeKeys);

                    //first search req data
                    $fsReqData = [];
                    $bangos = [];
                   
                    foreach ($data as $key => $value) {
                        if (strpos($key, 'ReqVal') !== false) {
                            $temp_new_key = str_replace('ReqVal', '', $key);
                            if (array_key_exists($temp_new_key,$data)){ //when pagination change
                                $data[$temp_new_key] = $data[$temp_new_key];
                                $fsReqData[$temp_new_key] = $data[$temp_new_key];
                            }else{
                                $fsReqData[$temp_new_key] = $value;
                                $data[$temp_new_key] = $value;
                            }
                            unset($data[$key]);
                        }
                    }
                   
                    $data = $this->removeDataFromView($data, $removeKeys);

                    if($data_from_view['Button'] == 'FirstSearch'){
                        $fsReqData = $req_data; //fsReqData = first search request data
                    }
                    
                    //to search full text
                    // if(isset($data['user_name_search'])){
                    //     $data['user_name_search'] = str_replace('　','',str_replace(' ','',$data['user_name_search']));
                    // }
                    
                    if(($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'refresh') && $defalut_check == 0){
                        $pagi = 20;
                        return view('purchase.purchaseLedger.mainPurchaseLedger', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'pagi', 'buttonMessage', 'balance_of_prev_month'));
                    }

                    $touchakudate_start = str_replace("/","-",$req_data['touchakudate_start']);
                    $bikou1 = $req_data['bikou1'];
                    $balance_of_prev_month = QueryHelper::fetchSingleResult("select kk0002,kk0015 from kaikakezandaka where to_char(kk0001, 'YYYY-MM') < '$touchakudate_start' 
                        AND kk0002 = '$bikou1'
                        AND kk0003 = '2'
                        order by kk0001 desc ")->kk0015 ?? 0;
                    
                    $query = AllPurchaseLedger::data($bango,$req_data)->toSql();
                    $purchaseLedgerInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    if ($purchaseLedgerInfo->items() == null && $purchaseLedgerInfo->currentPage() != 1) {
                        $currentPage = ($purchaseLedgerInfo->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $purchaseLedgerInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    }
                    if ($purchaseLedgerInfo->total() == 0) {
                        $exceedUser = '該当するデータがありません。';
                    } else {
                        $exceedUser = '';
                    }

                    //export excel
                    if ($data_from_view['Button'] == 'xls') {
                        $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                        $headers = $this->headers;
                        $excelName = '購入先元帳.xlsx';
                        return $this->excelDownload($headers, $searched, $excelName);
                    }
                }
           } catch (\Exception $e) {
               $exceedUser = '検索形式が間違っています。';
               $purchaseLedgerInfo = collect();
               $purchaseLedgerInfo = $purchaseLedgerInfo->paginate($pagination);
               return view('purchase.purchaseLedger.mainPurchaseLedger', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'purchaseLedgerInfo', 'tantousya', 'buttonMessage','fsReqData','exceedUser'));
           }
            return view('purchase.purchaseLedger.mainPurchaseLedger', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'purchaseLedgerInfo', 'tantousya', 'buttonMessage','req_data','fsReqData', 'balance_of_prev_month','exceedUser'));
        }

        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;
        session()->forget('oldInput' . $bango);
        return view('purchase.purchaseLedger.mainPurchaseLedger', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'pagi', 'buttonMessage', 'balance_of_prev_month'));
    }


    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = PurchaseLedgerHeaders::$page_no;
        return $Setting = TableSetting::setting($this->headers, $id, $pageNo);
    }

    public function tableSettingSave(Request $request, $id, $bango, $type = null)
    {
        $pageNo = PurchaseLedgerHeaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '在庫一覧', $type);
    }


    public function clearBottomReqData($request_data){
        $headers = [
            '日付' => 'touchakudate',
            '区分' => 'toiawasebango',
            '伝票番号' => 'syouhinid',
            '行' => 'syouhinsyu',
            '品名・備考' => 'datachar08',
            '数' => 'purchase_ledger_nyukosu',
            '単価/期日' => 'purchase_ledger_kingaku',
            '金額' => 'purchase_ledger_syouhizeiritu',
            '支払額' => 'purchase_ledger_payment_amount',
            '買掛残高' => 'purchase_ledger_accounts_payable',
            '会計科目CD' => 'barcode',
            '会計内訳CD' => 'codename',
            '明細備考' => 'datachar11',
        ];
        foreach($request_data as $key=>$val){
            if (in_array($key, $headers)){
                $request_data[$key] = null;
            }
        }
        return $request_data;
    }

}
