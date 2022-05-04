<?php

namespace App\Http\Controllers\purchase;
use App\AllClass\master\nameMaster\allCategorykanri;
use Illuminate\Http\Request;
use App\tantousya;
use App\kengen;
//use App\categorykanri;
use App\requestTable;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\purchase\supplierLedger\AllSupplierLedger;
use App\AllClass\purchase\supplierLedger\supplierLedgerHeaders;
use App\AllClass\purchase\supplierLedger\validateSupplierLedger;
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
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;

class SupplierLedgerController extends Controller
{   private $headers = [
      '日付' => 'ledger_date',
      '区分' => 'classification',
      '伝票番号' => 'slip_number',
      '行' => 'line_number',
      '品名・備考' => 'product_name',
      '数' => 'formatted_ledger_number',
      '単価/期日' => 'formatted_ledger_unit_price',
      '金額' => 'formatted_ledger_amount',
      '支払額' => 'formatted_ledger_payment_amount',
      '買掛残高' => 'formatted_ledger_accounts_payable',
      '受注番号' => 'order_number',
      '受注先' => 'contractor',
      '件名' => 'ledger_subject'
    ];
    public function postSupplierLedger(Request $request)
    {
        $bango = request('userId');

        //check validation for first search
        if($request->ajax()){
            $validator = validateSupplierLedger::validate($request,$bango);
            $errors = $validator->errors();
            if($errors->any()){
               $err_msg = $errors->all();
               return ['err_field'=>$errors,'err_msg'=>$err_msg];
            }else{
                return "ok";
            }
        }

        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $name = QueryHelper::select(['name'])->from('tantousya')->where("DeleteFlag = '0' ")->orderBy("bango asc")->get()->execute();       
        $buttonMessage = ButtonMsg::read($bango);
        $supplierLedgerData =collect([])->paginate(20);
        $headers = SupplierLedgerHeaders::headers($bango);
        $table_headers = SupplierLedgerHeaders::headers($bango, 'table_headers');
        $page_no = SupplierLedgerHeaders::$page_no;
        $route = 'supplierLedgerTableSetting';
        $redirect_path = 'supplierLedgerReload';

        $data_from_view = $request->all();
        $data_from_view_session = $request->all();
        session()->put('oldInput' . $bango, $data_from_view);
        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 20;
        }
        // $old = $request->all();
        $supplierLedgerError='';
        $supplierLedgerSuccess='';
        $temp_table = 'supplier_ledger_temp';
        // checking query
        // if($request->supplier){
        //     try {
        //         list($query, $kk) = AllSupplierLedger::readData($bango, $data_from_view);
        //         $data = collect(QueryHelper::fetchResult($query));
        //         dd($data);
        //     }catch (Exception $e) {
        //         dd($e);
        //     }
        // }
        // show page start here
        if (isset($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh')) {
            $fsRemoveKeys = ['page', 'Button', 'pagination', '_token', 'userId'];
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'start_date','end_date','supplier','supplier_text'];
            
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
                // $str_to_int = ['money10', 'moneymax'];
                // foreach ($data_from_view as $key => $value) {
                //   if (in_array($key, $str_to_int)) {
                //     $data_from_view[$key] = str_replace(',', '', $data_from_view[$key]);
                //   }
                // }
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
                  $fsReqData = $req_data;
                }
                //to search full text
                if(isset($data['ledger_number'])){
                  $data['ledger_number'] = str_replace(',', '', $data['ledger_number']);
                }
                if(isset($data['ledger_unit_price'])){
                  $data['ledger_unit_price'] = str_replace(',', '', $data['ledger_unit_price']);
                }
                if(isset($data['ledger_amount'])){
                    $data['ledger_amount'] = str_replace(',', '', $data['ledger_amount']);
                }
                if(isset($data['ledger_payment_amount'])){
                    $data['ledger_payment_amount'] = str_replace(',', '', $data['ledger_payment_amount']);
                }
                if(isset($data['ledger_accounts_payable'])){
                    $data['ledger_accounts_payable'] = str_replace(',', '', $data['ledger_accounts_payable']);
                }
                // dd($data);
                if(($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'refresh') && $defalut_check == 0){
                  $pagi = 20;
                  return view('purchase.supplierLedger.mainSupplierLedger', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'pagi','buttonMessage'));
                }
                //$query = AllSupplierLedger::readData($bango, $req_data);
                list($query, $kk) = AllSupplierLedger::readData($bango, $req_data);
                // dd($query, $kk);
                $supplierLedgerData = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                // dd($query, $supplierLedgerData);
                // $supplierLedgerData2 = $this->searchDataFetch($query, $data, $bango, $temp_table);
                if ($supplierLedgerData->items() == null && $supplierLedgerData->currentPage() != 1) {
                  $currentPage = ($supplierLedgerData->lastPage());
                  Paginator::currentPageResolver(function () use ($currentPage) {
                    return $currentPage;
                  });
                  $supplierLedgerData = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                  $supplierLedgerData = $this->searchDataFetch($query, $data, $bango, $temp_table);
                }
                if ($supplierLedgerData->total() == 0) {
                  $exceedUser = '該当するデータがありません。';
                } else {
                  $exceedUser = '';
                }
                //export excel
                if ($data_from_view['Button'] == 'xls') {
                  $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                  $headers = $this->headers;
                  $excelName = '仕入先元帳.xlsx';
                  //return newExcelExport::download($searched,$headers, $excelName);
                  return $this->excelDownload($headers, $searched, $excelName);
                }  
              }
            } catch (\Exception $e) {
              // dd($e);
              $exceedUser = '検索形式が間違っています。';
              $supplierLedgerData = collect();
              $supplierLedgerData = $supplierLedgerData->paginate($pagination);
              return view('purchase.supplierLedger.mainSupplierLedger', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path',  'tantousya','exceedUser', 'buttonMessage', 'fsReqData'));
            }
            $kk0015Value = $kk ?? 0;
            return view('purchase.supplierLedger.mainSupplierLedger', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'supplierLedgerData', 'tantousya','exceedUser', 'buttonMessage','req_data','fsReqData', 'kk0015Value'));
        }          
        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;
        session()->forget('oldInput' . $bango);
        return view('purchase.supplierLedger.mainSupplierLedger',compact('bango','headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'name', 'buttonMessage', 'supplierLedgerError', 'pagi'));
    }

    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = SupplierLedgerHeaders::$page_no;
        return $Setting = TableSetting::setting($this->headers, $id, $pageNo);
    }

    public function tableSettingSave(Request $request, $id, $bango, $type = null)
    {
        $pageNo = SupplierLedgerHeaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '在庫一覧', $type);
    }
    public function clearBottomReqData($request_data){
        $headers = [
            '日付' => 'ledger_date',
            '区分' => 'classification',
            '伝票番号' => 'slip_number',
            '行' => 'line_number',
            '品名・備考' => 'product_name',
            '数' => 'ledger_number',
            '単価/期日' => 'ledger_unit_price',
            '金額' => 'ledger_amount',
            '支払額' => 'ledger_payment_amount',
            '買掛残高' => 'ledger_accounts_payable',
            '受注番号' => 'order_number',
            '受注先' => 'contractor',
            '件名' => 'ledger_subject' 
        ];
        foreach($request_data as $key=>$val){
            if (in_array($key, $headers)){
                $request_data[$key] = null;
            }
        }
        return $request_data;
    }
}