<?php

namespace App\Http\Controllers\sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\tantousya;
use App\AllClass\ButtonMsg;
use App\AllClass\TableSetting;
use Illuminate\Pagination\Paginator;
use App\AllClass\sales\depositHistory\allDepositHistory;
use App\AllClass\sales\depositHistory\validateDepositHistory;
use App\AllClass\sales\depositHistory\depositHistoryHeaders;
use App\AllClass\order\orderEntry\searchCompany2;
use App\AllClass\order\orderEntry\searchCompany4;
use App\kengen;
use DB;
use Session;
use App\AllClass\db\QueryHelperFacade as QueryHelper;


class DepositHistoryController extends Controller
{
    private $headers = [
        '入金日'  =>  'torikomidate',
        '入金番号'  =>  'deposit_history_shinkurokokyakuname',
        '行'  =>  'deposit_history_shinkurokokyakugroup',
        '訂正回数'  =>  'shinkurokokyakuorderbango',
        '入金方法'  =>  'soufusakiname_val',
        '売上請求先'  =>  'information1_detail_show',
        '入金額'  =>  'deposit_history_nyukingaku',
        '手形決済日'  =>  'chumondate',
        '入金銀行'  =>  'soufusaki_val',
        '入金支店'  =>  'unsoumei_val',
        '備考'  =>  'toiawasebango',
        '入金会計データ作成フラグ'  =>  'tsuchimail',
        '入金消込完了フラグ'  =>  'rendoumail',
        '入金T登録年月日' => 'registration_date',
        '入金T登録時刻' => 'registration_time',
        '入金T更新年月日' => 'update_date',
        '入金T更新時刻' => 'update_time',
        '入金T更新者' => 'changer',
        '入金T訂正回数' => 'num_of_cor',
        '入金F登録年月日' => 'registration_date_2',
        '入金F登録時刻' => 'registration_time_2',
        '入金F更新年月日' => 'update_date_2',
        '入金F更新時刻' => 'update_time_2',
        '入金F更新者' => 'changer_2'
    ];

    public function postDepositHistory(Request $request)
    {
        $bango = request('userId');

        if ($request->ajax()) {
            $validator = validatedepositHistory::validate($request, $bango);
            $errors = $validator->errors();
            if ($errors->any()) {
                $err_msg = $errors->all();
                return ['err_field' => $errors, 'err_msg' => $err_msg];
            } else {
                return "ok";
            }
        }
        //
        $data_from_view = $request->all();
        //dd($data_from_view);
        $default_req_data = '';
        $data_from_view_session = $request->all();
        session()->put('oldInput' . $bango, $data_from_view);
        //
        $route = 'depositHistoryTableSetting';
        $redirect_path = 'depositHistoryReload';
        $tantousya = tantousya::find($bango);

        $query = searchCompany2::data($bango, 0);
        // dump($query);
        $popUpData['kokyaku1'] = QueryHelper::fetchResult($query);
        $query2 = searchCompany4::data($bango, 0);
        $popUpData['kokyaku1_2'] = QueryHelper::fetchResult($query2);
        $buttonMessage = ButtonMsg::read($bango);

        $color_array = array();

        $color_array =
            [
                'tsuchimail' => '0411入金会計データ作成フラグ',
                'rendoumail' => '0411入金消込完了フラグ',
            ];

        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 20;
        }

        if (!empty($data_from_view['chkboxinp'])) {
            $deleted_item = $data_from_view['chkboxinp'];
        } else {
            $deleted_item = 2;
        }

        $headers = depositHistoryHeaders::headers($bango);
        $table_headers = depositHistoryHeaders::headers($bango, 'table_headers');
        $page_no = depositHistoryHeaders::$page_no;

        $pageNo = "04-11";
        $header_exists = QueryHelper::fetchResult("select * from kengensettei where kengenchar01='col' and kengenchar03='$bango' and kengenchar05='$pageNo' ");

        if ($header_exists == NULL) {
            $headers = [
                '入金日'  =>  'torikomidate',
                '入金番号'  =>  'deposit_history_shinkurokokyakuname',
                '行'  =>  'deposit_history_shinkurokokyakugroup',
                '訂正回数'  =>  'shinkurokokyakuorderbango',
                '入金方法'  =>  'soufusakiname_val',
                '売上請求先'  =>  'information1_detail_show',
                '入金額'  =>  'deposit_history_nyukingaku',
                '手形決済日'  =>  'chumondate',
                '入金銀行'  =>  'soufusaki_val',
                '入金支店'  =>  'unsoumei_val',
                '備考'  =>  'toiawasebango',
                '入金T登録年月日' => 'registration_date',
                '入金T登録時刻' => 'registration_time',
                '入金T更新年月日' => 'update_date',
                '入金T更新時刻' => 'update_time',
                '入金T更新者' => 'changer',
                '入金T訂正回数' => 'num_of_cor',
                '入金F登録年月日' => 'registration_date_2',
                '入金F登録時刻' => 'registration_time_2',
                '入金F更新年月日' => 'update_date_2',
                '入金F更新時刻' => 'update_time_2',
                '入金F更新者' => 'changer_2'
            ];
        }
        
        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $bango)->where('kengenchar05', '04-11')->get()->count();
        if($initial_header == 0){
            unset($headers['入金T登録年月日']);
            unset($headers['入金T登録時刻']);
            unset($headers['入金T更新年月日']);
            unset($headers['入金T更新時刻']);
            unset($headers['入金T更新者']);
            unset($headers['入金T訂正回数']);
            unset($headers['入金F登録年月日']);
            unset($headers['入金F登録時刻']);
            unset($headers['入金F更新年月日']);
            unset($headers['入金F更新時刻']);
            unset($headers['入金F更新者']);
        }

        $temp_table = 'deposit_history_temp';

        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;

        //dd($data_from_view['Button']);
        if (isset($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh')) {
            $fsRemoveKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp', 'update'];
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp', 'update', 'torikomidate_start', 'torikomidate_end', 'nyukinbi2_start', 'nyukinbi2_end', 'information1_detail'];

            try {
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh') {

                    //clear bottom search request data
                    if ($data_from_view['Button'] == 'refresh') {
                        $data_from_view = self::clearBottomReqData($data_from_view);
                    }

                    //default req data
                    $default_data =  $data_from_view;

                    //remove number format comma
                    $str_to_int = ['deposit_history_nyukingaku', 'deposit_history_shinkurokokyakugroup', 'shinkurokokyakuorderbango'];
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

                    if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort') {
                        $default_req_data = $default_data;
                    } else {
                        $default_req_data = "";
                    }
                    //first search req data
                    //dd($data);
                    $fsReqData = [];
                    $shinkurokokyakuname = [];
                    $shinkurokokyakugroup = [];
                    $reqData = [];
                    foreach ($data as $key => $value) {
                        if (strpos($key, 'ReqVal') !== false) {
                            $fsReqData[str_replace('ReqVal', '', $key)] = $value;
                            unset($data[$key]);
                        }
                    }
                    $first_search_res = "";
                    if (!empty($fsReqData)) {
                        $search_removeKeys = ['torikomidate_start', 'torikomidate_end', 'nyukinbi2_start', 'nyukinbi2_end', 'information1_detail'];
                        $reqData = $this->removeDataFromView($fsReqData, $search_removeKeys);
                        $first_search_result = "";
                        $detail = "";
                        $query = allDepositHistory::data($bango, $deleted_item, $fsReqData, $color_array)->toSql();
                        $depositHistoryInfo = $this->searchDataFetch($query, $reqData, $bango, $temp_table);
                        //dd($depositHistoryInfo);
                        foreach ($depositHistoryInfo as $key => $val) {
                            foreach ($val as $k => $v) {
                                if ($k == "deposit_history_shinkurokokyakuname") {
                                    array_push($shinkurokokyakuname, (int)$v);
                                }
                                if ($k == "deposit_history_shinkurokokyakugroup") {
                                    array_push($shinkurokokyakugroup, (int)$v);
                                }
                            }
                        }
                    } else if (($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'refresh') && empty($fsReqData)) {
                        //dd("hi");
                        $query = allDepositHistory::data($bango, $deleted_item)->whereRaw('kokyakubango = 0')->toSql();

                        $depositHistoryInfo = QueryHelper::fetchResult($query);
                        //dd($depositHistoryInfo);
                        $depositHistoryInfo = collect($depositHistoryInfo);
                        $depositHistoryInfo = $depositHistoryInfo->paginate($pagi);
                        $total_deposit  = $depositHistoryInfo->sum('deposit_history_nyukingaku');
                        $total_deposit2  = $depositHistoryInfo->sum('nyukingaku_o');

                        return view('sales.depositHistory.mainDepositHistory', compact('bango', 'popUpData', 'headers', 'page_no', 'table_headers', 'tantousya', 'depositHistoryInfo', 'buttonMessage', 'route', 'redirect_path', 'total_deposit'));
                    }
                    // if($data_from_view['Button'] == 'refresh'){
                    //    $data = array();
                    // }
                    $query = allDepositHistory::data($bango, $deleted_item, $fs_req_data, $color_array, $shinkurokokyakuname, $shinkurokokyakugroup)->toSql();
                    //dd($shinkurokokyakuname);
                    $depositHistoryInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    //dd($depositHistoryInfo);


                    $depositHistoryInfo2 = $this->searchDataFetch($query, $data, $bango, $temp_table);
                    if ($depositHistoryInfo->items() == null && $depositHistoryInfo->currentPage() != 1) {
                        $currentPage = ($depositHistoryInfo->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $depositHistoryInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                        $depositHistoryInfo2 = $this->searchDataFetch($query, $data, $bango, $temp_table);
                    }
                    if ($depositHistoryInfo->total() == 0) {
                        $exceedUser = '該当するデータがありません。';
                    } else {
                        $exceedUser = '';
                    }

                    if ($data_from_view['Button'] == 'FirstSearch') {
                        $fsReqData = $fs_req_data; //fsReqData=first search request data
                    }
                    if ($data_from_view['Button'] == 'xls') {
                        //$searched = $this->searchDataFetch($query, $reqData, $bango, $temp_table, $pagination, 'xls');
                        $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                        $excelName = '入金履歴一覧.xlsx';
                        $headers = $this->headers;
                        return $this->excelDownload($headers, $searched, $excelName);
                    }
                }
            } catch (\Exception $e) {
                $exceedUser = '検索形式が間違っています。';
                //foreach ($data_from_view as $key => $value) {
                //    if (strpos($key, 'ReqVal') !== false) {
                //        $fsReqData[str_replace('ReqVal', '', $key)] = $value;
                //        unset($fsReqData[$key]);
                //    }
                //}
                $depositHistoryInfo =  [];
                //$depositHistoryInfo = collect($depositHistoryInfo);
                $depositHistoryInfo = collect();
                $total_deposit  = $depositHistoryInfo->sum('deposit_history_nyukingaku');
                $total_deposit2  = $depositHistoryInfo->sum('nyukingaku_o');
                $depositHistoryInfo = $depositHistoryInfo->paginate($pagi);

                return view('sales.depositHistory.mainDepositHistory', compact('bango', 'popUpData', 'headers', 'table_headers', 'tantousya', 'depositHistoryInfo', 'buttonMessage', 'route', 'redirect_path', 'default_req_data', 'exceedUser', 'total_deposit', 'fsReqData'));
            }

            $total_deposit  = $depositHistoryInfo2->sum('deposit_history_nyukingaku');
            $total_deposit2  = $depositHistoryInfo2->sum('nyukingaku_o');
            //dd($depositHistoryInfo);
            return view('sales.depositHistory.mainDepositHistory', compact('bango', 'popUpData', 'headers', 'page_no', 'table_headers', 'tantousya', 'depositHistoryInfo', 'buttonMessage', 'fsReqData', 'route', 'redirect_path', 'total_deposit', 'default_req_data', 'exceedUser'));
        }

        $query = allDepositHistory::data($bango, $deleted_item)->whereRaw('kokyakubango = 0')->toSql();

        $depositHistoryInfo = QueryHelper::fetchResult($query);
        //dd($depositHistoryInfo);
        $depositHistoryInfo = collect($depositHistoryInfo);
        $depositHistoryInfo = $depositHistoryInfo->paginate($pagi);
        $total_deposit  = $depositHistoryInfo->sum('deposit_history_nyukingaku');
        $total_deposit2  = $depositHistoryInfo->sum('nyukingaku_o');

        return view('sales.depositHistory.mainDepositHistory', compact('bango', 'popUpData', 'headers', 'page_no', 'table_headers', 'tantousya', 'depositHistoryInfo', 'buttonMessage', 'route', 'redirect_path', 'total_deposit'));
    }


    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = depositHistoryHeaders::$page_no;
        $header_exists = QueryHelper::fetchResult("select * from kengensettei where kengenchar01='col' and kengenchar03='$id' and kengenchar05='$pageNo' ");

        if ($header_exists == NULL) {
            $Setting = TableSetting::setting($this->headers, $id, $pageNo);
            $Setting['tsuchimail'] = "";
            $Setting['rendoumail'] = "";
            $Setting['registration_date'] = "";
            $Setting['registration_time'] = "";
            $Setting['update_date'] = "";
            $Setting['update_time'] = "";
            $Setting['changer'] = "";
            $Setting['num_of_cor'] = "";
            $Setting['registration_date_2'] = "";
            $Setting['registration_time_2'] = "";
            $Setting['update_date_2'] = "";
            $Setting['update_time_2'] = "";
            $Setting['changer_2'] = "";
            return $Setting;
        } else {
            return $Setting = TableSetting::setting($this->headers, $id, $pageNo);
        }
    }

    public function tableSettingSave(Request $request, $id, $type = null)
    {
        $pageNo = depositHistoryHeaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '入金履歴一覧・入金照会', $type);
    }

    public function clearBottomReqData($request_data)
    {
        $headers = [
            '入金日'  =>  'torikomidate',
            '入金番号'  =>  'deposit_history_shinkurokokyakuname',
            '行'  =>  'deposit_history_shinkurokokyakugroup',
            '訂正回数'  =>  'shinkurokokyakuorderbango',
            '入金方法'  =>  'soufusakiname_val',
            '売上請求先'  =>  'information1_detail_show',
            '入金額'  =>  'deposit_history_nyukingaku',
            '手形決済日'  =>  'chumondate',
            '入金銀行'  =>  'soufusaki_val',
            '入金支店'  =>  'unsoumei_val',
            '備考'  =>  'toiawasebango',
            '入金会計データ作成フラグ'  =>  'tsuchimail',
            '入金消込完了フラグ'  =>  'rendoumail',
            '入金T登録年月日' => 'registration_date',
            '入金T登録時刻' => 'registration_time',
            '入金T更新年月日' => 'update_date',
            '入金T更新時刻' => 'update_time',
            '入金T更新者' => 'changer',
            '入金T訂正回数' => 'num_of_cor',
            '入金F登録年月日' => 'registration_date_2',
            '入金F登録時刻' => 'registration_time_2',
            '入金F更新年月日' => 'update_date_2',
            '入金F更新時刻' => 'update_time_2',
            '入金F更新者' => 'changer_2'
        ];
        foreach ($request_data as $key => $val) {
            if (in_array($key, $headers)) {
                $request_data[$key] = null;
            }
        }
        return $request_data;
    }
}
