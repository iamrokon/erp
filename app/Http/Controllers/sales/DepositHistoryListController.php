<?php

namespace App\Http\Controllers\sales;

use App\AllClass\sales\DepositHistoryList\DepositHistoryList;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\tantousya;
use App\AllClass\ButtonMsg;
use App\AllClass\TableSetting;
use App\kengen;
use Illuminate\Pagination\Paginator;
use App\AllClass\sales\DepositHistoryList\AllDepositHistoryList;
use App\AllClass\sales\DepositHistoryList\validateDepositHistoryList;
use App\AllClass\sales\DepositHistoryList\depositHistoryListHeaders;
use DB;
use Session;
use App\AllClass\db\QueryHelperFacade as QueryHelper;


class DepositHistoryListController extends Controller
{
    private $headers = [
        '処理日'  =>  'disposal_day',
        '消込番号'  =>  'application_number',
        '消込行番号'  =>  'dhl_apply_line_number',
        '入金日'  =>  'payment_day',
        '売上番号'  =>  'sales_number',
        '売上請求先'  =>  'billing_address',
        '入金消込額'  =>  'dhl_deposit_application',
        '担当'  =>  'in_charge',
        '受注番号'  =>  'order_number',
        '受注先'  =>  'contractor',
        '売上日'  =>  'sales_date',
        '受注件名'  =>  'order_subject',
        '入金番号'  =>  'deposit_number',
        '入金行番号' => 'deposit_line_number',
        '入金方法' => 'payment_method',
        '売掛残高更新フラグ' => 'receivable_flag',
        '請求残高更新フラグ' => 'billing_flag',
        '前受区分' => 'advance_classification',
        '売済区分' => 'sold_category',
        '入金消込Ｔ登録年月日' => 'registration_date',
        '入金消込Ｔ登録時刻' => 'registration_time',
        '入金消込Ｔ更新者' => 'changer'

    ];


    public function index(Request $request)
    {
        // DB::table('kengensettei')->where('kengenchar05', '04-22')->delete();
        // DB::table('kengensettei')->where('kengenchar05', '04-11')->delete();
        $bango = request('userId');
        if ($request->ajax()) {
            $validator = DepositHistoryList::validate($request->all(), $bango);
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
        $headers = DepositHistoryList::headers($bango);
        $table_headers = DepositHistoryList::headers($bango, 'table_headers');
        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $bango)->where('kengenchar05', '04-22')->get()->count();
        if($initial_header == 0){
            unset($headers['売掛残高更新フラグ']);
            unset($headers['請求残高更新フラグ']);
            unset($headers['入金消込Ｔ登録年月日']);
            unset($headers['入金消込Ｔ登録時刻']);
            unset($headers['入金消込Ｔ更新者']);
        }
        $page_no = DepositHistoryList::$pageNo;
        $route = 'depositHistoryListTableSetting';
        $redirect_path = 'depositHistoryListReload';
        $temp_table = 'deposit_history_list_temp';
        $data_from_view = $request->all();
        session()->put('oldInput' . $bango, $data_from_view);
        $default_req_data  = '';
        if (isset($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh')) {
            $fsRemoveKeys = ['page', 'Button', 'pagination', '_token', 'userId'];
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'payment_day_start', 'payment_day_end', 'disposal_day_start', 'disposal_day_end', 'billing_address_text', 'unsoutesuryou'];
            try {
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh') {
                    //clear bottom search request data
                    if ($data_from_view['Button'] == 'refresh') {
                        $data_from_view = $this->clearBottomReqData($data_from_view);
                    }

                    //default req data
                    $default_data =  $data_from_view;
                    
                    //remove number format comma
                    $str_to_int = ['dhl_deposit_application'];
                    foreach ($data_from_view as $key => $value) {
                        if (in_array($key, $str_to_int)) {
                            $data_from_view[$key] = str_replace(',', '', $data_from_view[$key]);
                        }
                    }

                    //remove date format
                    //$date_to_int = ['sales_date'];
                    //foreach ($data_from_view as $key => $value) {
                    //    if (in_array($key, $date_to_int)) {
                    //        $data_from_view[$key] = str_replace('/', '', $data_from_view[$key]);
                    //    }
                    //}

                    //check number format
                    //$formatted_fields = ['dhl_deposit_application'];
                    //foreach ($data_from_view as $key => $value) {
                    //    if (in_array($key, $formatted_fields) && strpos($value, ',') == false) {
                    //        $data_from_view[$key] = $data_from_view[$key] == "" ? null : number_format($data_from_view[$key]);
                    //    }
                    //}

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
                        $default_req_data = $default_data;
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
                        $search_removeKeys = ['payment_day_start', 'payment_day_end', 'disposal_day_start', 'disposal_day_end', 'billing_address_text', 'unsoutesuryou'];
                        $reqData = $this->removeDataFromView($fsReqData, $search_removeKeys);
                        $query = AllDepositHistoryList::data($bango, $bangos, $fsReqData)->toSql();
                        $allDepositHistoryList = $this->searchDataFetch($query, $reqData, $bango, $temp_table);
                        foreach ($allDepositHistoryList as $key => $val) {
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
                        return view('sales.depositHistoryList.main', compact('bango', 'tantousya', 'data_from_view', 'buttonMessage', 'headers', 'table_headers', 'redirect_path', 'page_no', 'route', 'pagi'));
                    }

                    $query = AllDepositHistoryList::data($bango, $bangos, $fs_req_data, $first_search_res)->toSql();
                    unset($data['top_billing_address']);
                    $allDepositHistoryList = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    if ($allDepositHistoryList->items() == null && $allDepositHistoryList->currentPage() != 1) {
                        $currentPage = ($allDepositHistoryList->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $allDepositHistoryList = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    }

                    if ($allDepositHistoryList->total() == 0) {
                        $exceedDepositHistoryList = '該当するデータがありません。';
                    } else {
                        $exceedDepositHistoryList = '';
                    }

                    if ($data_from_view['Button'] == 'FirstSearch') {
                        $fsReqData = $fs_req_data; //fsReqData=first search request data
                    }

                    //export excel
                    if ($data_from_view['Button'] == 'xls') {
                        $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                        $headers = $this->headers;
                        $excelName = '入金消込履歴一覧.xlsx';
                        return $this->excelDownload($headers, $searched, $excelName);
                    }
                }
            } catch (\Exception $e) {
                $query = AllDepositHistoryList::data()->toSql();
                $exceedDepositHistoryList = '検索形式が間違っています。';
                $allDepositHistoryList = QueryHelper::fetchResult($query);
                $allDepositHistoryList = collect($allDepositHistoryList);
                $allDepositHistoryList = $allDepositHistoryList->paginate($pagination);
                return view('sales.depositHistoryList.main', compact('bango', 'tantousya', 'data_from_view', 'buttonMessage', 'headers', 'table_headers', 'redirect_path', 'page_no', 'route', 'default_req_data', 'fsReqData', 'allDepositHistoryList', 'exceedDepositHistoryList'));
            }

            return view('sales.depositHistoryList.main', compact('bango', 'tantousya', 'data_from_view', 'buttonMessage', 'headers', 'table_headers', 'redirect_path', 'page_no', 'route', 'default_req_data', 'fsReqData', 'allDepositHistoryList', 'exceedDepositHistoryList'));
        }

        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;
        //        if (request('change_id')) {
        //            $query = allOrderHistory::data($bango, $deleted_item)->whereRaw("bango = '" . request('change_id') . "'")->toSql();
        //        } else {
        //            $query = allOrderHistory::data($bango, $deleted_item)->toSql();
        //        }
        session()->forget('oldInput' . $bango);
        return view('sales.depositHistoryList.main', compact('bango', 'tantousya', 'pagi', 'data_from_view', 'buttonMessage', 'headers', 'table_headers', 'redirect_path', 'page_no', 'route'));
    }
    public function tableSetting($id, $user_default = null)
    {
        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $id)->where('kengenchar05', '04-22')->get()->count();
        $id = $user_default ? $user_default : $id;
        $pageNo = DepositHistoryList::$pageNo;
        //return  TableSetting::setting($this->headers, $id, $pageNo);
        $Setting = TableSetting::setting($this->headers, $id, $pageNo);
        if($initial_header == 0){
            $Setting['receivable_flag'] = "";
            $Setting['billing_flag'] = "";
            $Setting['registration_date'] = "";
            $Setting['registration_time'] = "";
            $Setting['changer'] = "";
        }
        return $Setting;
    }
    public function tableSettingSave(Request $request, $id, $type = null)
    {

        $pageNo = DepositHistoryList::$pageNo;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '個人マスタ', $type);
    }
    public  function clearBottomReqData($request_data)
    {
        $headers = [
            '処理日'  =>  'disposal_day',
            '消込番号'  =>  'application_number',
            '消込行番号'  =>  'dhl_apply_line_number',
            '入金日'  =>  'payment_day',
            '売上番号'  =>  'sales_number',
            '売上請求先'  =>  'billing_address',
            '入金消込額'  =>  'dhl_deposit_application',
            '担当'  =>  'in_charge',
            '受注番号'  =>  'order_number',
            '受注先'  =>  'contractor',
            '売上日'  =>  'sales_date',
            '受注件名'  =>  'order_subject',
            '入金番号'  =>  'deposit_number',
            '入金行番号' => 'deposit_line_number',
            '入金方法' => 'payment_method',
            '売掛残高更新フラグ' => 'receivable_flag',
            '請求残高更新フラグ' => 'billing_flag',
            '前受区分' => 'advance_classification',
            '売済区分' => 'sold_category',
            '売済区分' => 'sold_category',
            '入金消込Ｔ登録年月日' => 'registration_date',
            '入金消込Ｔ登録時刻' => 'registration_time',
            '入金消込Ｔ更新者' => 'changer'
        ];
        foreach ($request_data as $key => $val) {
            if (in_array($key, $headers)) {
                $request_data[$key] = null;
            }
        }
        return $request_data;
    }
}
