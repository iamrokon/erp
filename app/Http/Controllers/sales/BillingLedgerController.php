<?php


namespace App\Http\Controllers\sales;

use App\AllClass\db\QueryHandler;
use App\AllClass\sales\BillingLedger\BillingLedger;
use App\AllClass\ButtonMsg;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\sales\BillingLedger\AllBillingLedgerCarry;
use App\AllClass\sales\BillingLedger\AllBillingLedgerPayment;
use App\AllClass\sales\BillingLedger\AllBillingLedgerSale;
use App\AllClass\sales\BillingLedger\BillingLedgerMerge;
use App\AllClass\TableSetting;
use App\Http\Controllers\Controller;
use App\kengen;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use PDF;

class BillingLedgerController extends Controller
{
    public $headers = [
        '日付' => 'dates',
        '区分' => 'classification',
        '伝票番号' => 'slip_number',
        '行' => 'lines',
        '品名' => 'product_name',
        '数' => 'numbers',
        '単価/期日' => 'unit_price',
        '売上金額' => 'sales_amount',
        '消費税額' => 'consumption_tax',
        '入金金額' => 'deposit_amount',
        '残高' => 'balance',
        '受注伝票番号' => 'order_slip_number',
        '受注行' => 'order_line',
        '備考' => 'remarks',
        '受注先' => 'contractor',
        '最終顧客' => 'end_customer',
        '受注担当部署CD' => 'classification1',
        '受注担当者' => 'user_name',
        '伝票備考'=>'voucher_remarks',
        '客先注番'=>'customer_note_number',
    ];
    public function index(Request $request)
    {
        /*$sql = "DELETE FROM kengensettei where kengenchar05::text LIKE '%04-08%' and kengenchar01::text LIKE '%col%'";
                        QueryHelper::runQuery($sql);*/
        $bango = request('userId');
        //dd(Route::previous()->getName());
        //update or insert tableSetting
        /*$this->updateTableSetting(request('userId'));*/
        /*if (Route::currentRouteName()=='billingLedger'){
            $this->updateTableSetting(request('userId'));
        }*/

        if ($request->ajax()) {

            $validator = BillingLedger::validate($request, $bango);
            $errors = $validator->errors();
            if ($errors->any()) {
                $err_msg = $errors->all();
                return ['err_field' => $errors, 'err_msg' => $err_msg];
            } else {
                return 'ok';
            }
        }
        $buttonMessage = ButtonMsg::read($bango);
        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 20;
        }
        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $headers = BillingLedger::headers($bango);
        /*$headers = $this->updateTableSetting($bango);*/
        $table_headers = BillingLedger::headers($bango, 'table_headers');
        $page_no = BillingLedger::$pageNo;
        $route = 'billingLedgerTableSetting';
        $redirect_path = 'billingLedgerReload';
        $temp_table = 'all_billing_ledger_temp';
        $data_from_view = $request->all();

        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $bango)->where('kengenchar05', '04-08')->get()->count();
        if($initial_header == 0){
            unset($headers['受注担当部署CD']);
            unset($headers['受注担当者']);
            unset($headers['伝票備考']);
            unset($headers['客先注番']);
        }

        session()->put('oldInput' . $bango, $data_from_view);
        if (isset($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh')) {
            $fsRemoveKeys = ['page', 'Button', 'pagination', '_token', 'userId'];
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'ledger_year_start', 'ledger_year_end', 'billing_address_text', 'billing_address'];
            try {
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh') {
                    //clear bottom search request data
                    if ($data_from_view['Button'] == 'refresh') {
                        $data_from_view = $this->clearBottomReqData($data_from_view);
                    }

                    //remove date format
                    $date_to_int = ['dates'];
                    foreach ($data_from_view as $key => $value) {
                        if (in_array($key, $date_to_int)) {
                            $data_from_view[$key] = str_replace('/', '', $data_from_view[$key]);
                        }
                    }
                    //remove number format comma
                    $str_to_int = ['unit_price', 'sales_amount', 'consumption_tax'];
                    foreach ($data_from_view as $key => $value) {
                        if (in_array($key, $str_to_int)) {
                            $data_from_view[$key] = str_replace(',', '', $data_from_view[$key]);
                        }
                    }

                    $fs_req_data = $this->removeDataFromView($data_from_view, $fsRemoveKeys);

                    foreach ($fs_req_data as $key => $value) {
                        if (strpos($key, 'ReqVal') !== false) {
                            $fs_req_data[str_replace('ReqVal', '', $key)] = $value;
                            unset($fs_req_data[$key]);
                        }
                    }

                    $data = $this->removeDataFromView($data_from_view, $removeKeys);

                    //check first search or default search
                    if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort') {
                        $default_req_data = $data;
                    } else {
                        $default_req_data = "";
                    }

                    //first search req data
                    $fsReqData = [];
                    $bangos = [];
                    foreach ($data as $key => $value) {
                        if (strpos($key, 'ReqVal') !== false) {
                            $fsReqData[str_replace('ReqVal', '', $key)] = $value;
                            unset($data[$key]);
                        }
                    }

                    //to search full text
                    //                    if(isset($data['user_name_search'])){
                    //                        $data['user_name_search'] = str_replace('　','',str_replace(' ','',$data['user_name_search']));
                    //                    }
                    //                    if(isset($data['datachar02_tan_name_search'])){
                    //                        $data['datachar02_tan_name_search'] = str_replace('　','',str_replace(' ','',$data['datachar02_tan_name_search']));
                    //                    }
                    //                    if(isset($data['datachar03_tan_name_search'])){
                    //                        $data['datachar03_tan_name_search'] = str_replace('　','',str_replace(' ','',$data['datachar03_tan_name_search']));
                    //                    }
                    //                    if(isset($data['datachar05_tan_name_search'])){
                    //                        $data['datachar05_tan_name_search'] = str_replace('　','',str_replace(' ','',$data['datachar05_tan_name_search']));
                    //                    }
                    //                    if(isset($data['datachar07_tan_name_search'])){
                    //                        $data['datachar07_tan_name_search'] = str_replace('　','',str_replace(' ','',$data['datachar07_tan_name_search']));
                    //                    }

                    //first search bangos
                    $first_search_res = "";

                    if (!empty($fsReqData)) {
                        $search_removeKeys = ['ledger_year_start', 'ledger_year_end', 'billing_address_text', 'billing_address'];
                        $reqData = $this->removeDataFromView($fsReqData, $search_removeKeys);
                        AllBillingLedgerCarry::data($fsReqData);
                        AllBillingLedgerSale::data($fsReqData);
                        AllBillingLedgerPayment::data($fsReqData);
                        $query = BillingLedgerMerge::data($fsReqData)->toSql();
                        $allBillingLedger = $this->searchDataFetch($query, $reqData, $bango, $temp_table);
                        foreach ($allBillingLedger as $key => $val) {
                            foreach ($val as $k => $v) {
                                if ($k == "bango") {
                                    array_push($bangos, $v);
                                }
                            }
                        }
                        if (count($bangos) < 1) {
                            $first_search_res = "no_data";
                        }
                    } else if (($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort') && empty($fsReqData)) {
                        $pagi = 20;
                        return view('sales.billingLedger.index', compact('bango', 'tantousya', 'data_from_view', 'buttonMessage', 'headers', 'table_headers', 'redirect_path', 'page_no', 'route', 'pagi'));
                    }

                    AllBillingLedgerCarry::data($fs_req_data);
                    AllBillingLedgerSale::data($fs_req_data);
                    AllBillingLedgerPayment::data($fs_req_data);
                    $query = BillingLedgerMerge::data($fs_req_data)->toSql();
                    $allBillingLedger = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    if ($allBillingLedger->items() == null && $allBillingLedger->currentPage() != 1) {
                        $currentPage = ($allBillingLedger->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $allBillingLedger = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    }

                    if ($allBillingLedger->total() == 0) {
                        $exceedBillingLedger = '該当するデータがありません。';
                    } else {
                        $exceedBillingLedger = '';
                    }

                    if ($data_from_view['Button'] == 'FirstSearch') {
                        $fsReqData = $fs_req_data; //fsReqData=first search request data
                    }

                    //export excel
                    if ($data_from_view['Button'] == 'xls') {
                        $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                        $headers = $this->headers;
                        $headers['日付']='dates_xls';
                        $headers['単価/期日']='unit_price_xls';
                        $headers['売上金額']='sales_amount_xls';
                        $headers['消費税額']='consumption_tax_xls';
                        $headers['入金金額']='deposit_amount_xls';
                        $headers['残高']='balance_xls';
                        $excelName = '得意先元帳（社外）.xlsx';
                        return $this->excelDownload($headers, $searched, $excelName);
                    }
                }
            } catch (\Exception $e) {
                dd($e);
                AllBillingLedgerCarry::data();
                AllBillingLedgerSale::data();
                AllBillingLedgerPayment::data();
                $query = BillingLedgerMerge::data()->toSql();
                $exceedBillingLedger = '検索形式が間違っています。';
                $allBillingLedger = QueryHelper::fetchResult($query);
                $allBillingLedger = collect($allBillingLedger);
                $allBillingLedger = $allBillingLedger->paginate($pagination);
                return view('sales.billingLedger.index', compact('bango', 'tantousya', 'data_from_view', 'buttonMessage', 'headers', 'table_headers', 'redirect_path', 'page_no', 'route', 'default_req_data', 'fsReqData', 'allBillingLedger', 'exceedBillingLedger'));
            }

            return view('sales.billingLedger.index', compact('bango', 'tantousya', 'data_from_view', 'buttonMessage', 'headers', 'table_headers', 'redirect_path', 'page_no', 'route', 'default_req_data', 'fsReqData', 'allBillingLedger', 'exceedBillingLedger'));
        }

        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;
        session()->forget('oldInput' . $bango);
        return view('sales.billingLedger.index', compact('bango', 'tantousya', 'pagi', 'data_from_view', 'buttonMessage', 'headers', 'table_headers', 'redirect_path', 'page_no', 'route'));
    }


    public function downloadBillingLedger(Request $request){
        $bango = request('userId');

        $buttonMessage = ButtonMsg::read($bango);

        if ($request->ajax()) {

            $validator = BillingLedger::validate($request, $bango);
            $errors = $validator->errors();
            if ($errors->any()) {
                $err_msg = $errors->all();
               // return ['err_field' => $errors, 'err_msg' => $err_msg];
                $exceedBillingLedger = '該当するデータがありません。';
                return [2, $exceedBillingLedger];
            } else {
                // return 'ok';
            }
        }


        // if (!empty(request('pagination'))) {
        //     $pagination = request('pagination');
        // } else {
        //     $pagination = 20;
        // }

        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $headers = BillingLedger::headers($bango);
        /*$headers = $this->updateTableSetting($bango);*/
        $table_headers = BillingLedger::headers($bango, 'table_headers');
        $page_no = BillingLedger::$pageNo;
        $route = 'billingLedgerTableSetting';
        $redirect_path = 'billingLedgerReload';
        $temp_table = 'all_billing_ledger_temp';
        $data_from_view = $request->all();

        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $bango)->where('kengenchar05', '04-08')->get()->count();
        if($initial_header == 0){
            unset($headers['受注担当部署CD']);
            unset($headers['受注担当者']);
            unset($headers['伝票備考']);
            unset($headers['客先注番']);
        }

        session()->put('oldInput' . $bango, $data_from_view);

        // if (isset($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh')) {
            $fsRemoveKeys = ['page', 'Button', 'pagination', '_token', 'userId'];
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'ledger_year_start', 'ledger_year_end', 'billing_address_text', 'billing_address'];
            try {
              //  if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh') {
                    //clear bottom search request data
                    if ($data_from_view['Button'] == 'refresh') {
                        $data_from_view = $this->clearBottomReqData($data_from_view);
                    }

                    //remove date format
                    $date_to_int = ['dates'];
                    foreach ($data_from_view as $key => $value) {
                        if (in_array($key, $date_to_int)) {
                            $data_from_view[$key] = str_replace('/', '', $data_from_view[$key]);
                        }
                    }
                    //remove number format comma
                    $str_to_int = ['unit_price', 'sales_amount', 'consumption_tax'];
                    foreach ($data_from_view as $key => $value) {
                        if (in_array($key, $str_to_int)) {
                            $data_from_view[$key] = str_replace(',', '', $data_from_view[$key]);
                        }
                    }

                    $fs_req_data = $this->removeDataFromView($data_from_view, $fsRemoveKeys);

                    foreach ($fs_req_data as $key => $value) {
                        if (strpos($key, 'ReqVal') !== false) {
                            $fs_req_data[str_replace('ReqVal', '', $key)] = $value;
                            unset($fs_req_data[$key]);
                        }
                    }

                    $data = $this->removeDataFromView($data_from_view, $removeKeys);

                    //check first search or default search
                    if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort') {
                        $default_req_data = $data;
                    } else {
                        $default_req_data = "";
                    }

                    //first search req data
                    $fsReqData = [];
                    $bangos = [];
                    foreach ($data as $key => $value) {
                        if (strpos($key, 'ReqVal') !== false) {
                            $fsReqData[str_replace('ReqVal', '', $key)] = $value;
                            unset($data[$key]);
                        }
                    }

                    $first_search_res = "";

                    if (!empty($fsReqData)) {
                        $search_removeKeys = ['ledger_year_start', 'ledger_year_end', 'billing_address_text', 'billing_address'];
                        $reqData = $this->removeDataFromView($fsReqData, $search_removeKeys);
                        AllBillingLedgerCarry::data($fsReqData);
                        AllBillingLedgerSale::data($fsReqData);
                        AllBillingLedgerPayment::data($fsReqData);
                        $query = BillingLedgerMerge::data($fsReqData)->toSql();
                        $allBillingLedger = $this->searchDataFetch($query, $reqData, $bango, $temp_table);
                        foreach ($allBillingLedger as $key => $val) {
                            foreach ($val as $k => $v) {
                                if ($k == "bango") {
                                    array_push($bangos, $v);
                                }
                            }
                        }
                        if (count($bangos) < 1) {
                            $first_search_res = "no_data";
                        }
                    } else if (($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort') && empty($fsReqData)) {
                        $pagi = 20;
                        return view('sales.billingLedger.index', compact('bango', 'tantousya', 'data_from_view', 'buttonMessage', 'headers', 'table_headers', 'redirect_path', 'page_no', 'route', 'pagi'));
                    }

                    AllBillingLedgerCarry::data($fs_req_data);
                    AllBillingLedgerSale::data($fs_req_data);
                    AllBillingLedgerPayment::data($fs_req_data);
                    $query = BillingLedgerMerge::data($fs_req_data)->toSql();
                    $allBillingLedger = $this->searchDataFetch($query, $data, $bango, $temp_table, null);
                    // if ($allBillingLedger->items() == null && $allBillingLedger->currentPage() != 1) {
                    //     $currentPage = ($allBillingLedger->lastPage());
                    //     Paginator::currentPageResolver(function () use ($currentPage) {
                    //         return $currentPage;
                    //     });
                    //     $allBillingLedger = $this->searchDataFetch($query, $data, $bango, $temp_table, null);
                    // }

                   // if ($allBillingLedger->total() == 0) {
                    if (count($allBillingLedger) == 0) {
                        $exceedBillingLedger = '該当するデータがありません。';
                         return [2, $exceedBillingLedger];
                    } else {
                        $exceedBillingLedger = '';
                    }

                    if ($data_from_view['Button'] == 'FirstSearch') {
                        $fsReqData = $fs_req_data; //fsReqData=first search request data
                    }

                    // echo "<pre>";
                    // var_dump($allBillingLedger);

                    // pdf creation start
                    $ledger_year_start = $request->ledger_year_start;
                    $ledger_year_end = $request->ledger_year_end;
                    $billing_address = $request->billing_address;
                    // rednering the html to pdf
                    $pdf = PDF::loadView('sales.billingLedger.billingLedgerPdfTemplate', ['ledger_year_start' => $ledger_year_start, 'ledger_year_end' => $ledger_year_end, 'billing_address' => $billing_address, 'allBillingLedger' => $allBillingLedger])->setPaper('a4', 'landscape');
                    
                    // store the pdf to public/pdf/billingLedger
                    if (!file_exists('pdf/billingLedger')) {
                        mkdir('pdf/billingLedger', 0777, true);
                    }

                    // pdf filename : ファイル名：102売上請求先CD（8桁）+（102売上請求先）会社名略称+（102売上請求先）事業所名略称+"得意先元帳（社外）".pdf
                    $cd_explode = explode("/", $request->billing_address_text);

                    $pdf_name = $cd_explode[0] . $cd_explode[1] . $cd_explode[2] . "得意先元帳（社外）.pdf";
                    $destination = public_path('pdf/billingLedger/'.$pdf_name);
                    // save the pdf
                    file_put_contents($destination, $pdf->output());
                    // create download link
                    $downloadLink= URL('pdf/billingLedger/' . $pdf_name);

                    // return file name and download link
                    return [$pdf_name, $downloadLink];
               // } // ./ Ends if
            } catch (\Exception $e) {
                dd($e);
            }
       // } // ./ ends If
        
    }

    public function tableSetting($id, $user_default = null)
    {
        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $id)->where('kengenchar05', '04-08')->get()->count();
        $id = $user_default ? $user_default : $id;
        $pageNo = BillingLedger::$pageNo;
        $Setting = TableSetting::setting($this->headers, $id, $pageNo);
        if($initial_header == 0){
            $Setting['classification1'] = "";
            $Setting['user_name'] = "";
            $Setting['voucher_remarks'] = "";
            $Setting['customer_note_number'] = "";
        }
        return $Setting;
    }

    public function tableSettingSave(Request $request, $id, $type = null)
    {

        $pageNo = BillingLedger::$pageNo;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '得意先元帳（社外）', $type);
    }
    public  function clearBottomReqData($request_data)
    {
        $headers = [
            '日付' => 'dates',
            '区分' => 'classification',
            '伝票番号' => 'slip_number',
            '行' => 'lines',
            '品名' => 'product_name',
            '数' => 'numbers',
            '単価/期日' => 'unit_price',
            '売上金額' => 'sales_amount',
            '消費税額' => 'consumption_tax',
            '入金金額' => 'deposit_amount',
            '残高' => 'balance',
            '受注伝票番号' => 'order_slip_number',
            '受注行' => 'order_line',
            '備考' => 'remarks',
            '受注先' => 'contractor',
            '最終顧客' => 'end_customer',
            '受注担当部署CD' => 'classification1',
            '受注担当者' => 'user_name',
            '伝票備考'=>'voucher_remarks',
            '客先注番'=>'customer_note_number',
        ];
        foreach ($request_data as $key => $val) {
            if (in_array($key, $headers)) {
                $request_data[$key] = null;
            }
        }
        return $request_data;
    }
}
