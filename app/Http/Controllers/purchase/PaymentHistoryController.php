<?php

namespace App\Http\Controllers\purchase;

use App\Http\Controllers\Controller;
use App\AllClass\ButtonMsg;
use App\AllClass\db\QueryHandler;
use App\AllClass\purchase\paymentHistory\AllPaymentHistory;
use App\AllClass\purchase\paymentHistory\PaymentHistoryHeaders;
use App\AllClass\TableSetting;
use App\kengen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\tantousya;
use Exception;
use DateTime;
use Illuminate\Support\Facades\Session;
use App\AllClass\db\QueryHelperFacade as QueryHelper;


class PaymentHistoryController extends Controller
{
    private $headers = [
        '支払日' => 'payment_date',
        '支払番号' => 'payment_no',
        '支払方法' => 'payment_method',
        '法人マイナンバー' => 'corporate_no',
        '支払先' => 'payment_destination',
        '支払額' => 'payment_amount',
        '手形期日' => 'payment_due_date',
        '銀行' => 'bank',
        '備考' => 'remarks',

        '買掛区分' => 'accounts_payable_segment',
        '会計伝票日付' => 'fiscal_voucher_date',
        '会計科目CD' => 'accounting_subject',
        '会計内訳CD' => 'accounting_breakdown',
        '支払会計データ作成フラグ' => 'payment_data_creation_flag',
        '買掛残高更新フラグ' => 'accounts_payable_update_flag',
        '支払残高更新フラグ' => 'payment_balance_update_flag',
        '支払テーブル登録年月日時刻' => 'payment_registration_date_time',
        '支払テーブル更新者' => 'payment_table_updater',
        '支払関連フラグ登録年月日時刻' => 'payment_flag_registration_date_time',
        '支払関連フラグ更新者' => 'payment_flag_updater',
        '支払明細登録年月日時刻' => 'payment_item_registration_flag',
        '支払明細更新者' => 'payment_line_updater'
    ];
    public function postPaymentHistory(Request $request)
    {
        $bango = request('userId');
        $first_date = date('Y/m/d',strtotime('first day of this month'));
        $last_date = date('Y/m/d',strtotime('last day of this month'));
        $data_from_view = $request->all();
        session()->put('oldInput' . $bango, $data_from_view);
        $tantousya = tantousya::find($bango);
        $data104 = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'D9' and suchi2 = 0 order by suchi1 ASC ");
        $headers = PaymentHistoryHeaders::headers($bango);
        $table_headers = PaymentHistoryHeaders::headers($bango, 'table_headers');
        $route = 'paymentHistoryTableSetting';
        $redirect_path = 'paymentHistoryReload';

        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $bango)->where('kengenchar05', '06-14')->get()->count();
        if($initial_header == 0){
            unset($headers['買掛区分']);
            unset($headers['会計伝票日付']);
            unset($headers['会計科目CD']);
            unset($headers['会計内訳CD']);
            unset($headers['支払会計データ作成フラグ']);
            unset($headers['買掛残高更新フラグ']);
            unset($headers['支払残高更新フラグ']);
            unset($headers['支払テーブル登録年月日時刻']);
            unset($headers['支払テーブル更新者']);
            unset($headers['支払関連フラグ登録年月日時刻']);
            unset($headers['支払関連フラグ更新者']);
            unset($headers['支払明細登録年月日時刻']);
            unset($headers['支払明細更新者']);
        }

        $buttonMessage = ButtonMsg::read($bango);
        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 20;
        }
        $old = $request->all();
        $paymentHistoryError='';
        $paymentHistorySuccess='';
// //        if($tantousya->innerlevel<=10 ) $privileged_user = true; else $privileged_user = false;
// //        dd($request->all());

        if (!empty($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' )) {    
            $fsRemoveTableKeys=['payment_date', 'payment_no', 'payment_method', 'corporate_no', 'payment_destination','payment_amount',
                'payment_due_date', 'bank','remarks','accounts_payable_segment','fiscal_voucher_date',
                'accounting_subject', 'accounting_breakdown', 'payment_data_creation_flag', 'accounts_payable_update_flag', 'payment_balance_update_flag','payment_registration_date_time',
                'payment_table_updater','payment_flag_registration_date_time','payment_flag_updater','payment_item_registration_flag','payment_line_updater',
                'payment_amount_sort','payment_registration_date_time_sort','payment_flag_registration_date_time_sort','sortField','sortType'];
            $fsReqData= $this->removeDataFromView($data_from_view, $fsRemoveTableKeys);
            $temp_table= "payment_history_temp";
            
            try {
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort') {
                    //default req data
                    //$default_data =  $data_from_view;
                    $formatted_int_fields=['payment_amount_sort'];
                    $formatted_date_fields=['payment_registration_date_time_sort', 'payment_flag_registration_date_time_sort'];
                     $allTableRequest = $this->modifyBladeData($data_from_view, $fsRemoveTableKeys);

                    foreach ($allTableRequest as $key => $value) {
                        if ((in_array($key, $formatted_date_fields) || in_array($key, $formatted_int_fields)) && $value!=null) {
//                            dd($value);
                            $allTableRequest[$key] = str_replace(array('/', ':',',',' '),'',$value);
                        }

                    }
                    //dd($allTableRequest);
                    $query= AllPaymentHistory::readData($bango,$fsReqData);
                    //dd($query);
                    $paymentHistoryInfos = $this->searchDataFetch($query, $allTableRequest, $bango, $temp_table, $pagination);
                    //dd($paymentHistoryInfos);
                    if ($paymentHistoryInfos->items() == null && $paymentHistoryInfos->currentPage() != 1) {
                        $currentPage = ($paymentHistoryInfos->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $paymentHistoryInfos = $this->searchDataFetch($query, $allTableRequest, $bango, $temp_table, $pagination);
                    }
//                    dd($purchaseOrderInfos->total());
                    if ($paymentHistoryInfos->total() == 0) {
                        if(Session::has('defaultSrc')){
                            if (Session::get('defaultSrc')=='1'){
                                $paymentHistoryError = '該当するデータがありません。';
                            }
                            else{
                                $paymentHistoryError = '';
                            }
                        }
                        else{
                            $paymentHistoryError = '';
                        }
                    } else {
                        $paymentHistoryError = '';
                    }
                }else if ($data_from_view['Button'] == 'xls') {
                    $query= AllPaymentHistory::readData($bango,$fsReqData);

                    $allTableRequest = $this->modifyBladeData($data_from_view, $fsRemoveTableKeys);

                    $searched = $this->searchDataFetch($query, $allTableRequest, $bango, $temp_table, $pagination, 'xls');
//                        dd($searched);
                    $headers = $this->headers;

                    $headers['支払テーブル更新者']='payment_table_updater_fullname';
                    $headers['支払関連フラグ更新者']='payment_flag_updater_fullname';
                    $headers['支払明細更新者']='payment_line_updater_fullname';
//                    dd($allTableRequest,$searched,$headers);
                    $excelName = '支払履歴一覧.xlsx';
                    return $this->excelDownload($headers, $searched, $excelName);
                }
            }catch (\Exception $e) {
// //                dd($e);
               $paymentHistoryError = '検索形式が間違っています。';
                $paymentHistoryInfos = collect([])->paginate($pagination);
                if ($paymentHistoryInfos->total() == 0) {
                    if(Session::has('defaultSrc')){
                        if (Session::get('defaultSrc')=='1'){
                            $paymentHistoryError = '検索形式が間違っています。';
                        }
                        else{
                            $paymentHistoryError = '';
                        }
                    }
                    else{
                        $paymentHistoryError = '';
                    }
                } else {
                    $paymentHistoryError = '';
                }
            }

             return view('purchase.paymentHistory.mainPaymentHistory',compact('bango','tantousya','last_date','first_date','paymentHistoryInfos','fsReqData','headers','buttonMessage','route','redirect_path','table_headers','paymentHistoryError','old','data104'));
        }
        else if (!empty(request('firstButton')) && request('firstButton')== 'topSearch' || !empty(request('Button')) && request('Button') == 'refresh')
        {
            $old=[];
            $fsReqData= $request->all();
//            dd($data_from_view,$bango);
            $query= AllPaymentHistory::readData($bango,$data_from_view);
           //dd($query);
            if ($query=='ng'){
                $paymentHistoryError = '該当するデータがありません。';
                session()->put('defaultSrc', '0');
                $paymentHistoryInfos=collect([])->paginate(20);
            }
            else{
                try {
                    if (count(QueryHelper::fetchResult($query))==0){
                        if(request('Button') == 'refresh'){
                            $paymentHistoryError = '';
                        }else{
                            $paymentHistoryError = '該当するデータがありません。';
                        }
                        session()->put('defaultSrc', '0');
                    }
                    else{
                        $paymentHistoryError = '';
                        session()->put('defaultSrc', '1');
                    }
                    $paymentHistoryInfos = collect(QueryHelper::fetchResult($query))->paginate(20);
                } catch (\Exception $e) {
                    $paymentHistoryError = '該当するデータがありません。';
                    session()->put('defaultSrc', '0');
                    $paymentHistoryInfos=collect([])->paginate(20);
                }
            }
//            dd($headers);
            return view('purchase.paymentHistory.mainPaymentHistory',compact('bango','tantousya','last_date','first_date','paymentHistoryInfos','old','fsReqData','headers','buttonMessage','route','redirect_path','table_headers','paymentHistoryError','paymentHistorySuccess','data104'));
        }


        $old=null;
        session()->put('defaultSrc', '0');
        $paymentHistoryInfos =collect([])->paginate(20);
        return view('purchase.paymentHistory.mainPaymentHistory',compact('bango','tantousya','last_date','first_date','paymentHistoryInfos','old','headers','buttonMessage','route','redirect_path','table_headers','paymentHistoryError','paymentHistorySuccess','data104'));
    }

    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = PaymentHistoryHeaders::$page_no;
//        return $Setting = TableSetting::setting($this->headers, $id, $pageNo);
        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $id)->where('kengenchar05', '06-14')->get()->count();
        $Setting = TableSetting::setting($this->headers, $id, $pageNo);
        if($initial_header == 0){
            $Setting['accounts_payable_segment'] = "";
            $Setting['fiscal_voucher_date'] = "";
            $Setting['accounting_subject'] = "";
            $Setting['accounting_breakdown'] = "";
            $Setting['payment_data_creation_flag'] = "";
            $Setting['accounts_payable_update_flag'] = "";
            $Setting['payment_balance_update_flag'] = "";
            $Setting['payment_registration_date_time'] = "";
            $Setting['payment_table_updater'] = "";
            $Setting['payment_flag_registration_date_time'] = "";
            $Setting['payment_flag_updater'] = "";
            $Setting['payment_item_registration_flag'] = "";
            $Setting['payment_line_updater'] = "";
        }
        return $Setting;
    }

    public function tableSettingSave(Request $request, $id, $bango, $type = null)
    {
        $pageNo = PaymentHistoryHeaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '支払履歴一覧・支払照会', $type);
    }

    private function modifyBladeData($alldata,$index){
        $newArr=[];

        foreach ($index as $key => $value) {
            $newArr[$value]=!empty($alldata[$value])?$alldata[$value]:null;
        }
        return $newArr;
    }
}
