<?php

namespace App\Http\Controllers\sales;

use App\tantousya;
use App\kengen;
use App\AllClass\ButtonMsg;
use App\AllClass\TableSetting;
use Illuminate\Support\Facades\Session;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\sales\accountList\allData;
use App\AllClass\sales\accountList\AccountListHeaders;
use App\AllClass\sales\accountList\validateAccountList;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use PDF;

class AccountListController extends Controller
{
    public function index(Request $request)
    {
        $bango = request('userId');

        if($request->ajax())
        {
            $validator = validateAccountList::validate($request,$bango);
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

        $headers = AccountListHeaders::get_headers($bango);
        $table_headers = AccountListHeaders::get_headers($bango, 'table_headers');
        $page_no = AccountListHeaders::$page_no;
        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $bango)->where('kengenchar05', '04-20')->get()->count();
        if($initial_header == 0){
            unset($headers['前月末残高']);
            unset($headers['当月売上額']);
            unset($headers['当月返品額']);
            unset($headers['当月値引額']);
            unset($headers['当月他売上額']);
            unset($headers['当月消費税額']);
            unset($headers['当月現金入金額']);
            unset($headers['当月手形入金額']);
            unset($headers['当月相殺額']);
            unset($headers['当月入金値引額']);
            unset($headers['当月他入金額']);
            unset($headers['当月末残高']);
            unset($headers['前月末手形残高']);
            unset($headers['当月手形決済額']);
            unset($headers['当月末手形残高']);
            unset($headers['前月末前受残高']);
            unset($headers['当月前受請求額']);
            unset($headers['当月前受消費税額']);
            unset($headers['当月前受現金入金額']);
            unset($headers['当月前受手形入金額']);
            unset($headers['当月前受相殺額']);
            unset($headers['当月前受入金値引額']);
            unset($headers['当月前受他入金額']);
            unset($headers['当月末前受残高']);
        }
        $route = 'accountListTableSetting';
        $redirect_path = 'accountListReload';
        
        $old = $request->all();

        $temp_table = 'all_accounts_temp';
        $show_total = 0;

        if (!empty($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' ))
        //if (isset($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh'))
        {
            $fsRemoveTableKeys=['sales_billing_cd','sales_billing_name','prev_receivable','sales','discount','consumption_tax','cash','bills','other_deposit','rem_recievable','cred_balance',
                    'cred_class_final','balance_of_bill_before','bill_settlement_amount','balance_of_bill','balance_of_advance_before','invoice_amount_before','invoice_amount_before',
                    'consumption_tax_before','cash_deposit_before','receipt_amount_before_current','offset_amount_before','deposit_discount_before','receipt_amount_before','balance_of_receipt_before','row_total','sortField','sortType'];
            
            $fsReqData= $this->removeDataFromView($data_from_view, $fsRemoveTableKeys);
            $temp_table= "all_accounts_temp";
            
            try {
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort') {
                    
                    $formatted_int_fields=['prev_receivable','sales','discount','consumption_tax','cash','bills','other_deposit','rem_recievable','cred_balance',
                    'cred_class_final','balance_of_bill_before','bill_settlement_amount','balance_of_bill','balance_of_advance_before','invoice_amount_before','invoice_amount_before',
                    'consumption_tax_before','cash_deposit_before','receipt_amount_before_current','offset_amount_before','deposit_discount_before','receipt_amount_before','balance_of_receipt_before','row_total'];
                    //$formatted_date_fields=['payment_registration_date_time_sort', 'payment_flag_registration_date_time_sort'];
                    $allTableRequest = $this->modifyBladeData($data_from_view, $fsRemoveTableKeys);

                    foreach ($allTableRequest as $key => $value) {
                        if ((in_array($key, $formatted_int_fields)) && $value!=null) {
    
                            $allTableRequest[$key] = str_replace(array('/', ':',',',' '),'',$value);
                        }

                    }
                    $query = allData::read_data($fsReqData);
                    
                    $account_list = $this->searchDataFetch($query[0], $allTableRequest, $bango, $temp_table, $pagination);
                    $account_list_total = QueryHelper::fetchResult($query[1]);
                    $current_page_no = $account_list->currentPage();
                    $last_page_no = $account_list->lastPage();
                    //dd($paymentHistoryInfos);
                    if ($account_list->items() == null && $account_list->currentPage() != 1) {
                        $currentPage = ($account_list->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $account_list = $this->searchDataFetch($query[0], $allTableRequest, $bango, $temp_table, $pagination);
                    }

                    // if ($account_list->total() == 0) {
                    //     if(Session::has('defaultSrc')){
                    //         if (Session::get('defaultSrc')=='1'){
                    //             $paymentHistoryError = '該当するデータがありません。';
                    //         }
                    //         else{
                    //             $paymentHistoryError = '';
                    //         }
                    //     }
                    //     else{
                    //         $paymentHistoryError = '';
                    //     }
                    // } else {
                    //     $paymentHistoryError = '';
                    // }
                    if ($account_list->total() != 0 && $current_page_no == $last_page_no) {
                        $show_total = 1;
                    }
                    if ($account_list->total() == 0) {
                        $exceedUser = '該当するデータがありません。';
                    } else {
                        $exceedUser = '';
                    }
                }else if ($data_from_view['Button'] == 'xls') {
                    $query = allData::read_data($fsReqData);
                    //dd($query);
                    $allTableRequest = $this->modifyBladeData($data_from_view, $fsRemoveTableKeys);
                    $searched = $this->searchDataFetch($query[0], $allTableRequest, $bango, $temp_table, $pagination, 'xls');
                    $searched_total = QueryHelper::fetchResult($query[1]);
                    $new_searched_arr = array();
                    foreach($searched as $key=>$val){
                        array_push($new_searched_arr,$val);
                    }
                    foreach($searched_total as $key=>$val){
                        array_push($new_searched_arr,$val);
                    }
                    $headers = AccountListHeaders::$excel_headers;
                    $excelName = '売掛残高一覧.xlsx';
                    return $this->excelDownload($headers, $new_searched_arr, $excelName);
                }
            }catch (\Exception $e) {
                // $exceedUser = '検索形式が間違っています。';
                // $account_list = collect([])->paginate($pagination);
                // $account_list_total = collect([])->paginate($pagination);
                $exceedUser = '検索形式が間違っています。';
                $account_list = QueryHelper::fetchResult($query[0]);
                $account_list_total = QueryHelper::fetchResult($query[1]);
                $account_list = collect($account_list)->paginate($pagination);
                return view('sales.accountList.main', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'account_list', 'account_list_total', 'tantousya',  'exceedUser', 'buttonMessage','default_req_data','fsReqData','show_total'));
            }
            return view('sales.accountList.main', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'account_list', 'account_list_total', 'tantousya',  'exceedUser', 'buttonMessage','fsReqData','old','show_total'));
        }else if (!empty(request('Button')) && request('Button')== 'FirstSearch' || !empty(request('Button')) && request('Button') == 'refresh')
        {
            $old=[];
            $fsReqData= $request->all();
            $query = allData::read_data($data_from_view);
            //dd($query);
            //if ($query=='ng'){
                // $paymentHistoryError = '該当するデータがありません。';
                // session()->put('defaultSrc', '0');
            //     $account_list=collect([])->paginate(20);
            //     $account_list_total = QueryHelper::fetchResult($query[1]);
            // }
            // else{
                try {
                    if (count(QueryHelper::fetchResult($query[0]))==0){
                        if(request('Button') == 'refresh'){
                            $exceedUser = '';
                        }else{
                            $exceedUser = '該当するデータがありません。';
                        }
                        //session()->put('defaultSrc', '0');
                    }
                    else{
                        $exceedUser = '';
                        //session()->put('defaultSrc', '1');
                    }
                    $account_list = collect(QueryHelper::fetchResult($query[0]))->paginate($pagination);
                    if ($account_list->total() == 0) {
                        $exceedUser = '該当するデータがありません。';
                    } else {
                        $exceedUser = '';
                    }
                    $account_list_total = QueryHelper::fetchResult($query[1]);
                    $current_page_no = $account_list->currentPage();
                    $last_page_no = $account_list->lastPage();
                    if ($account_list->total() != 0 && $current_page_no == $last_page_no) {
                        $show_total = 1;
                    }
                } catch (\Exception $e) {
                    $exceedUser = '該当するデータがありません。';
                    //session()->put('defaultSrc', '0');
                    $account_list=collect([])->paginate($pagination);
                    $account_list_total = QueryHelper::fetchResult($query[1]);
                }
            //}
            //dd($show_total);
            return view('sales.accountList.main', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'account_list', 'account_list_total', 'tantousya',  'exceedUser', 'buttonMessage','fsReqData','old','show_total'));
        }
        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;
        session()->forget('oldInput' . $bango);
        return view('sales.accountList.main', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'pagi', 'buttonMessage','show_total'));
    }

    public function downloadAccountList(Request $request)
    {
        $bango = request('userId');

        if($request->ajax())
        {
            $validator = validateAccountList::validate($request,$bango);
            $errors = $validator->errors();
            if($errors->any()){
               $err_msg = $errors->all();
               $exceedUser = '該当するデータがありません。';
               return [2,$exceedUser];
               //return ['err_field'=>$errors,'err_msg'=>$err_msg];

            }else{
               // return "ok";
            }
        }

        $data_from_view = $request->all();
        $data_from_view_session = $request->all();
        session()->put('oldInput' . $bango, $data_from_view);
        $tantousya = tantousya::find($bango);
        $buttonMessage = ButtonMsg::read($bango);

        // if (!empty(request('pagination'))) {
        //     $pagination = request('pagination');
        // } else {
        //     $pagination = 20;
        // }

        $headers = AccountListHeaders::get_headers($bango);
        $table_headers = AccountListHeaders::get_headers($bango, 'table_headers');
        $page_no = AccountListHeaders::$page_no;
        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $bango)->where('kengenchar05', '04-20')->get()->count();
        if($initial_header == 0){
            unset($headers['前月末残高']);
            unset($headers['当月売上額']);
            unset($headers['当月返品額']);
            unset($headers['当月値引額']);
            unset($headers['当月他売上額']);
            unset($headers['当月消費税額']);
            unset($headers['当月現金入金額']);
            unset($headers['当月手形入金額']);
            unset($headers['当月相殺額']);
            unset($headers['当月入金値引額']);
            unset($headers['当月他入金額']);
            unset($headers['当月末残高']);
            unset($headers['前月末手形残高']);
            unset($headers['当月手形決済額']);
            unset($headers['当月末手形残高']);
            unset($headers['前月末前受残高']);
            unset($headers['当月前受請求額']);
            unset($headers['当月前受消費税額']);
            unset($headers['当月前受現金入金額']);
            unset($headers['当月前受手形入金額']);
            unset($headers['当月前受相殺額']);
            unset($headers['当月前受入金値引額']);
            unset($headers['当月前受他入金額']);
            unset($headers['当月末前受残高']);
        }
        $route = 'accountListTableSetting';
        $redirect_path = 'accountListReload';
        
        $old = $request->all();

        $temp_table = 'all_accounts_temp';
        $show_total = 0;

        //if (!empty($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' ))
        //if (isset($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh'))
        // {
            $fsRemoveTableKeys=['sales_billing_cd','sales_billing_name','prev_receivable','sales','discount','consumption_tax','cash','bills','other_deposit','rem_recievable','cred_balance',
                    'cred_class_final','balance_of_bill_before','bill_settlement_amount','balance_of_bill','balance_of_advance_before','invoice_amount_before','invoice_amount_before',
                    'consumption_tax_before','cash_deposit_before','receipt_amount_before_current','offset_amount_before','deposit_discount_before','receipt_amount_before','balance_of_receipt_before','row_total','sortField','sortType'];
            
            $fsReqData= $this->removeDataFromView($data_from_view, $fsRemoveTableKeys);
            $temp_table= "all_accounts_temp";
            
            try {
               // if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort') {
                    
                    $formatted_int_fields=['prev_receivable','sales','discount','consumption_tax','cash','bills','other_deposit','rem_recievable','cred_balance',
                    'cred_class_final','balance_of_bill_before','bill_settlement_amount','balance_of_bill','balance_of_advance_before','invoice_amount_before','invoice_amount_before',
                    'consumption_tax_before','cash_deposit_before','receipt_amount_before_current','offset_amount_before','deposit_discount_before','receipt_amount_before','balance_of_receipt_before','row_total'];
                    //$formatted_date_fields=['payment_registration_date_time_sort', 'payment_flag_registration_date_time_sort'];
                    $allTableRequest = $this->modifyBladeData($data_from_view, $fsRemoveTableKeys);

                    foreach ($allTableRequest as $key => $value) {
                        if ((in_array($key, $formatted_int_fields)) && $value!=null) {
    
                            $allTableRequest[$key] = str_replace(array('/', ':',',',' '),'',$value);
                        }

                    }
                    $query = allData::read_data($fsReqData);
                    
                    $account_list = $this->searchDataFetch($query[0], $allTableRequest, $bango, $temp_table, null);
                    $account_list2 = $this->searchDataFetch($query[0], $allTableRequest, $bango, $temp_table);
                   
                    $account_list_total = QueryHelper::fetchResult($query[1]);
                    // $current_page_no = $account_list->currentPage();
                    // $last_page_no = $account_list->lastPage();

                   
                    
                    //dd($account_list);
                    if (count($account_list) == 0) {
                        $exceedUser = '該当するデータがありません。';
                        return [2, $exceedUser];
                    } else {
                        $exceedUser = '';
                    }
                    
                //}else if ($data_from_view['Button'] == 'xls') {
                    // $query = allData::read_data($fsReqData);
                    // //dd($query);
                    // $allTableRequest = $this->modifyBladeData($data_from_view, $fsRemoveTableKeys);
                    // $searched = $this->searchDataFetch($query[0], $allTableRequest, $bango, $temp_table, null, 'xls');
                    // $searched_total = QueryHelper::fetchResult($query[1]);
                    // $new_searched_arr = array();
                    // foreach($searched as $key=>$val){
                    //     array_push($new_searched_arr,$val);
                    // }
                    // foreach($searched_total as $key=>$val){
                    //     array_push($new_searched_arr,$val);
                    // }

                $total1303 = 0;
                $total1304 = 0;
                $total1305 = 0;
                $total1306 = 0;
                $total1307 = 0;
                $total1308 = 0;
                $total1309 = 0;
                $total1310 = 0;
                $total1311 = 0;
                
                foreach($account_list2 as $key => $value){
                
                    if(strlen($value->sales_billing_cd) == 8){                               
                    $total1303 += $value->prev_receivable;
                    $total1304 += $value->net_sales_curr_month;
                    $total1305 += $value->discount;
                    $total1306 += $value->tax_curr_month;
                    $total1307 += $value->cash;
                    $total1308 += $value->bills;
                    $total1309 += $value->other_deposit;
                    $total1310 += $value->rem_recievable;
                    $total1311 += $value->loan_balance;
                
                    }
                }

                $total1303 = number_format($total1303);
                $total1304 = number_format($total1304);
                $total1305 = number_format($total1305);
                $total1306 = number_format($total1306);
                $total1307 = number_format($total1307);
                $total1308 = number_format($total1308);
                $total1309 = number_format($total1309);
                $total1310 = number_format($total1310);
                $total1311 = number_format($total1311);

                    $lastIndex = count($account_list)-1;

                    $date = $request->date;
                    $dateTime = date('y/m/d H:i'); 

                    $information2_1_short = $request->information2_1_short ? $request->information2_1_short : $account_list[1]->sales_billing_cd;
                    $information2_2_short = $request->information2_2_short ? $request->information2_2_short : $account_list[$lastIndex]->sales_billing_cd;
                    
                    //dd(count($account_list));
                    
                    $pdf = PDF::loadView('sales.accountList.accountListPdfTemplate', ['dateTime'=>$dateTime,'date' => $date, 'information2_1_short' => $information2_1_short, 'information2_2_short' => $information2_2_short, 'account_list' => $account_list,'total1303'=>$total1303,'total1304'=>$total1304,'total1305'=>$total1305,'total1306'=>$total1306,'total1307'=>$total1307,'total1308'=>$total1308,'total1309'=>$total1309,'total1310'=>$total1310,'total1311'=>$total1311])->setPaper('a4', 'landscape');
                    
                    if (!file_exists('pdf/accountList')) {
                        mkdir('pdf/accountList', 0777, true);
                    }

                    $currentDateTime = str_replace(array(':', '/', ' '), '', date('Y/m/d H:i:s')); 

                    //$cd_explode = explode("/", $request->date);
                    //$cd_explode = explode("/", $request->information2_1_text);
                    $replaceDate = str_replace('/',"",$date);

                    $pdf_name = "売掛残高一覧". $replaceDate . $currentDateTime .".pdf";
                    $destination = public_path('pdf/accountList/'.$pdf_name);
                    // save the pdf
                    file_put_contents($destination, $pdf->output());
                    // create download link
                    $downloadLink= URL('pdf/accountList/' . $pdf_name);

                    // return file name and download link
                    return [$pdf_name, $downloadLink];
        
               // }
            }catch (\Exception $e) {
                // $exceedUser = '検索形式が間違っています。';
                // $account_list = collect([])->paginate($pagination);
            //     // $account_list_total = collect([])->paginate($pagination);
            //     $exceedUser = '検索形式が間違っています。';
            //     $account_list = QueryHelper::fetchResult($query[0]);
            //     $account_list_total = QueryHelper::fetchResult($query[1]);
            //     $account_list = collect($account_list)->paginate($pagination);
            //     return view('sales.accountList.main', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'account_list', 'account_list_total', 'tantousya',  'exceedUser', 'buttonMessage','default_req_data','fsReqData','show_total'));
                   dd($e);    
        }    
    }

    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = AccountListHeaders::$page_no;
        $Setting = TableSetting::setting(AccountListHeaders::$base_headers, $id, $pageNo);
        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $id)->where('kengenchar05', '04-20')->get()->count();
        //dd($initial_header);
        if($initial_header == 0){
            $Setting['balance_at_the_end_of_month_before'] = "";
            $Setting['net_sales_curr_month'] = "";
            $Setting['return_curr_month'] = "";
            $Setting['discount_curr_month'] = "";
            $Setting['sales_curr_month_others'] = "";
            $Setting['tax_curr_month'] = "";
            $Setting['cash_deposit_curr_month'] = "";
            $Setting['bill_receipt_curr_month'] = "";
            $Setting['offset_amount_curr_month'] = "";
            $Setting['curr_deposit_discount'] = "";
            $Setting['reposited_that_month'] = "";
            $Setting['balance_at_the_end_of_month'] = "";
            $Setting['balance_of_bill_before'] = "";
            $Setting['bill_settlement_amount'] = "";
            $Setting['balance_of_bill'] = "";
            $Setting['balance_of_advance_before'] = "";
            $Setting['invoice_amount_before'] = "";
            $Setting['consumption_tax_before'] = "";
            $Setting['cash_deposit_before'] = "";
            $Setting['receipt_amount_before_current'] = "";
            $Setting['offset_amount_before'] = "";
            $Setting['deposit_discount_before'] = "";
            $Setting['receipt_amount_before'] = "";
            $Setting['balance_of_receipt_before'] = "";
        }
        return $Setting;
    }

    public function tableSettingSave(Request $request, $id, $type = null)
    {
        $pageNo = AccountListHeaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, AccountListHeaders::$base_headers, '売掛残高一覧', $type);
    }

    private function modifyBladeData($alldata,$index){
        $newArr=[];

        foreach ($index as $key => $value) {
            $newArr[$value]=!empty($alldata[$value])?$alldata[$value]:null;
        }
        return $newArr;
    }
}
