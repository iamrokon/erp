<?php

namespace App\Http\Controllers\master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AllClass\master\officeMaster\officeheaders;
use App\AllClass\master\officeMaster\createOfficeMaster;
use App\AllClass\master\officeMaster\editOfficeMaster;
use App\AllClass\master\officeMaster\allHaisou;
use App\AllClass\master\companyMaster\allCompany;
use App\AllClass\SearchClass;
use App\AllClass\SortClass;
use App\kokyaku1;
use App\haisou;
use \Carbon\Carbon;
use App\tantousya;
use App\etsuransya;
use App\AllClass\master\excelDownload;
use App\requestTable;
use App\AllClass\TableSetting;
use App\AllClass\master\CSVLogger;
use App\AllClass\master\csvRecordDelete;
use Session;
use Excel;
use DB;
use App\AllClass\master\ExcelReportDownload;
use Illuminate\Pagination\Paginator;
use App\AllClass\master\employeeMaster\ButtonMsg;
use URL;
use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use DateTime;
use App\Helpers\Helper;

class OfficeMasterController extends Controller
{
    private $headers = [
        '会社CD' => 'office_shikibetsucode',
        '会社名' => 'gaishamei',
        '事業所CD' => 'office_torihikisakibango',
        '事業所名' => 'name',
        '事業所名略称' => 'haisoumoji1',
        '入力区分' => 'torihikisakirank1',
        '担当SA1' => 'syukeitukikijunwithname',
        '担当SA2' => 'syukeitukiwithname',
        '担当SE1' => 'syukeikikijunwithname',
        '担当SE2' => 'syukeinenkijunwithname',
        '郵便番号' => 'office_yubinbango',
        '都道府県名' => 'address1',
        '市区町村名' => 'address2',
        '町域名' => 'address3',
        '番地・建物名' => 'address4',
        'TEL' => 'office_tel',
        'FAX' => 'office_torihikisakirank2',
        'JIS市区町村CD' => 'office_yobi1',
        'メールアドレス' => 'mail',
        '売上区分' => 'haisoumoji2',
        '仕入区分' => 'syukeiki',
        '事業所口座使用区分' => 'other1',
        '即時区分' => 'other2',
        '請求締め日' => 'other3_detail',
        '入金方法' => 'other4_detail',
        '入金月' => 'other5',
        '入金日' => 'office_other6',
        '入金日休日設定' => 'other7',
        '入金振込手数料設定' => 'other8',
        '与信限度額' => 'formatted_otherfloat1',
        '請求先CD' => 'office_other9',
        '請求書送付日' => 'office_other10',
        '請求書メール区分' => 'other11',
        '請求書メール宛先' => 'other12',
        '請求書UIS' => 'other13',
        '請求書郵送' => 'other14',
        '請求書郵送先CD' => 'office_other15',
        '請求課税区分' => 'other16_detail',
        '請求消費税計算区分' => 'other17',
        '請求税端数区分' => 'other18_detail',
        '支払締め日' => 'other19_detail',
        '支払月' => 'other20',
        '支払日' => 'other21_detail',
        '支払日休日設定' => 'other22',
        '支払振込手数料設定' => 'other23',
        '支払方法' => 'other24_detail',
        '支払手形サイト' => 'otherfloat2',
        '支払振込手数料区分' => 'other30_detail',
        '振込銀行' => 'office_other25',
        '振込支店' => 'office_other26',
        '預金種別' => 'otherfloat4',
        '口座番号' => 'office_other27',
        '口座名義人' => 'other28',
        '仕向銀行' => 'other31_detail',
        '仕向支店' => 'other32_detail',
        '支払課税区分' => 'other33_detail',
        '支払消費税計算区分' => 'other34',
        '支払税端数区分' => 'other35_detail',
        '源泉税率' => 'otherfloat3',
        '旧取引先CD' => 'office_other36',
        '手形決済月' => 'other37',
        '手形決済日' => 'office_other38',
        '専伝区分' => 'other39',
        '指定納品書帳票CD' => 'office_other40',
        '登録年月日' => 'created_date',
        '登録時刻' => 'created_time',
        '更新年月日' => 'updated_date',
        '更新時刻' => 'updated_time',
        //'更新時端末IP' => 'netlogin',
        '更新者' => 'user_name'
    ];

    public function postOfficeMaster(Request $request)
    {

        if (request('yobi12')) {
            $com_yobi12 = request('yobi12');
        } else {
            $com_yobi12 = null;
        }

        $bango = request('userId');
        $headers = officeheaders::headers($bango);
        $table_headers = officeheaders::headers($bango, 'table_headers');
        $page_no = officeheaders::$page_no;
        $route = 'officeMasterTableSetting';
        $redirect_path = 'officeMasterReload';

        //check office page open from company page or not
        if($com_yobi12 != null){
            $kokyakus = QueryHelper::select(['*'])->from('kokyaku1')->where("yobi12 = '$com_yobi12'")->where("denpyosaiban = 0")->orderBy("bango asc")->get()->execute();
        }else{
            $kokyakus = QueryHelper::select(['*'])->from('kokyaku1')->where("denpyosaiban = 0")->orderBy("bango asc")->get()->execute();
        }

        if ($kokyakus) {
            $kokyaku_bango = $kokyakus[0]->bango;
        } else {
            $kokyaku_bango = null;
        }

        $com_query = allCompany::data($bango, 0, $kokyaku_bango);

        $init_selected_kokyaku = QueryHelper::fetchSingleResult($com_query);

        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();

        $tantousyas = QueryHelper::select(['*'])->from('tantousya')->where('deleteflag = 0')->where('innerlevel >= 10')->orderBy('bango asc')->get()->execute();

        $req_color = '0802入力区分';
        $requests = QueryHelper::select(['*'])->from('request')->where(" color = '$req_color'")->orderBy("syouhinbango asc")->get()->execute();

        $other3 = QueryHelper::fetchResult("select * from categorykanri where category1 = 'A8' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $other4 = QueryHelper::fetchResult("select * from categorykanri where category1 = 'A9' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $other16 = QueryHelper::fetchResult("select * from categorykanri where category1 = 'B1' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $other18 = QueryHelper::fetchResult("select * from categorykanri where category1 = 'B2' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $other19 = QueryHelper::fetchResult("select * from categorykanri where category1 = 'D8' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $other21 = QueryHelper::fetchResult("select * from categorykanri where category1 = 'F9' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $other24 = QueryHelper::fetchResult("select * from categorykanri where category1 = 'D9' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $other30 = QueryHelper::fetchResult("select * from categorykanri where category1 = 'F2' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $otherfloat4_color = '0802預金種別';
        $otherfloat4 = QueryHelper::select(['*'])->from('request')->where(" color = '$otherfloat4_color'")->orderBy("syouhinbango asc")->get()->execute();

        $other31 = QueryHelper::fetchResult("select * from categorykanri where category1 = 'H2' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $other32 = QueryHelper::fetchResult("select * from categorykanri where category1 = 'H3' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $other33 = QueryHelper::fetchResult("select * from categorykanri where category1 = 'E1' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $other35 = QueryHelper::fetchResult("select * from categorykanri where category1 = 'E2' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $data_from_view = $request->all();
        $data_from_view_session = $request->all();
        session()->put('oldInputOfficeMaster' . $bango, $data_from_view_session);

        //string to int conversion search, check leading zeroes, lzc=leading zero check
        //$lzcKeys = ['shikibetsucode_search_sort','torihikisakibango_search_sort','other9_search_sort','other15_search_sort','other36_search_sort','other40_search_sort'];
        //$data_from_view = $this->stringToIntSearch($data_from_view, $lzcKeys);

        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 20;
        }

//        if (!empty($data_from_view['kokyakubango']) || \request('companyId')) {
//            $companyId = $data_from_view['kokyakubango'] ?? \request('companyId');
//        } else {
//            $companyId = false;
//        }
//        if (!empty($data_from_view['Button']) && $data_from_view['Button'] == 'refresh') {
//            $companyId = false;
//        }

        $buttonMessage = ButtonMsg::read($bango);

        $popUpData['kokyaku1'] = QueryHelper::select(['*'])->from('kokyaku1')->where("denpyosaiban = 0")->orderBy("bango asc")->get()->execute();
        $popUpData['haisou'] = QueryHelper::select(['*'])->from('haisou')->get()->execute();
        $popUpData['etsuransya'] = QueryHelper::select(['*'])->from('etsuransya')->get()->execute();

        if (!empty($data_from_view['chkboxinp'])) {
            $deleted_item = $data_from_view['chkboxinp'];
        } else {
            $deleted_item = 0;
        }


        if (!empty($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls')) {
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp', 'yobi12'];
            $query = allHaisou::data($bango, $deleted_item, false, $com_yobi12);
            $temp_table = 'haisou_temp';
            try {
                //modify number format fields
                $str_to_int = ['otherfloat1'];
                foreach ($data_from_view as $key => $value) {
                    if (in_array($key, $str_to_int)) {
                        $data_from_view[$key] = str_replace(',', '', $data_from_view[$key]);
                    }
                }
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort') {
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);
                    $haisous = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    if ($haisous->items() == null && $haisous->currentPage() != 1) {

                        $currentPage = ($haisous->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $haisous = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);

                    }
                    if ($haisous->total() == 0) {
                        $exceedUser = '該当するデータがありません。';
                    } else {
                        $exceedUser = '';
                    }
                } else if ($data_from_view['Button'] == 'xls') {
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);
                    $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                    $headers = $this->headers;
                    $excelName = '事業所マスタ.xlsx';
                    return $this->excelDownload($headers, $searched, $excelName);
                }

            } catch (\Exception $e) {
                $exceedUser = '検索形式が間違っています。';
                $haisous = QueryHelper::fetchResult($query);
                $haisous = collect($haisous)->paginate($pagination);

            }

            return view('master.officeMaster.office', compact('deleted_item', 'tantousya', 'popUpData', 'bango', 'haisous', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'kokyakus', 'init_selected_kokyaku', 'tantousyas', 'requests', 'buttonMessage', 'other3', 'other4', 'other16', 'other18', 'other19','other21', 'other30','otherfloat4', 'other24', 'other31', 'other32', 'other33', 'other35', 'exceedUser', 'com_yobi12'));
        }
        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;

        if (request('change_id')) {
            $change_id = request('change_id');
            $query = allHaisou::data($bango, $deleted_item, false, $com_yobi12);
            $query .= " and bango = $change_id ";
        } else {
            $query = allHaisou::data($bango, $deleted_item, false, $com_yobi12);
        }

        $haisous = QueryHelper::fetchResult($query);
        $haisous = collect($haisous)->paginate($pagi);
        session()->forget('oldInputOfficeMaster' . $bango);
        return view('master.officeMaster.office', compact('deleted_item', 'pagi', 'tantousya', 'popUpData', 'bango', 'haisous', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'kokyakus', 'init_selected_kokyaku', 'tantousyas', 'requests', 'buttonMessage', 'other3', 'other4', 'other16', 'other18', 'other19','other21', 'other30','otherfloat4', 'other24', 'other31', 'other32', 'other33', 'other35', 'com_yobi12'));
    }

    public function postEditEmployeeMaster(Request $request, $bango)
    {
        if (request('type') == 'create') {

            $insert = createOfficeMaster::create($request->all(), $bango, $this->headers);
            if (is_array($insert) && $insert['status'] == 'ok') {
                Session::flash('success_msg', '事業所CD　' . $insert['torihikisakibango'] . ' 登録 完了しました。');
                return $insert;
            }elseif(is_array($insert) && $insert['status'] == 'ng'){
               Session::flash('failure_msg','間違えました。');
               return $insert;
            }else if($insert == 'confirmation'){
                return "confirmation_msg";
            } else {
                $errors = $insert->all();
                return ['err_field' => $insert, 'err_msg' => $errors];
            }
        }

        if (request('type') == 'edit') {

            $edit = editOfficeMaster::edit($request->all(), $bango, $this->headers);
            if (is_array($edit) && $edit['status'] == 'ok') {
                Session::flash('success_msg', '事業所CD　' . $edit['torihikisakibango'] . ' 登録 完了しました。');
                return $edit;
            }elseif(is_array($edit) && $edit['status'] == 'ng'){
               Session::flash('failure_msg','間違えました。');
               return $edit;
            }else if($edit == 'confirmation'){
                return "confirmation_msg";
            } else {
                $errors = $edit->all();
                return ['err_field' => $edit, 'err_msg' => $errors];
            }
        }
    }

    public function masterDetail(Request $request, $bango)
    {
        $id = $request['id'];
        $query = allHaisou::data($bango, '*', $id);
        $data = collect(QueryHelper::fetchSingleResult($query))->toArray();

        $array = [];
        foreach ($data as $key => $value) {
            $array[$key] = $value;
        }
        $array['base_url'] = URL::to('/');
        return $array;
    }

    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = officeheaders::$page_no;

        return $Setting = TableSetting::setting($this->headers, $id, $pageNo);

    }

    public function tableSettingSave(Request $request, $id, $type = null)
    {
        $pageNo = officeheaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '事業所マスタ', $type);
    }

    public function deleteOrReturnOffice(Request $request, $bango, $type = null)
    {
        $bangoName = tantousya::find($bango)->name;
        $id = $request->all();

        $kesuId = array_keys($id)[0];
        $kesuId = array_keys($id)[0];
        $mytime = Carbon::now()->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        $mytime = str_replace(" ", "", $mytime);

        $query = allHaisou::data($bango, '*', $kesuId);
        $deleteBefore = QueryHelper::fetchSingleResult($query);

        //start log query
        $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 事業所マスタ start\n";
        QueryHandler::logger($bango,$log_data);

        if ($type == 1) {
            $update_data = [
               'bango' => $kesuId,
               'kounyusu' => 0,
               'netuserpasswd' => $mytime,
               'syukeinen' => $bango,
              // 'netlogin' => Helper::getSystemIP()
            ];
            QueryHelper::updateData('haisou',$update_data,'bango',$bango,__CLASS__,__FUNCTION__,__LINE__);
        } else {
            $update_data = [
               'bango' => $kesuId,
               'kounyusu' => 1,
               'netuserpasswd' => $mytime,
               'syukeinen' => $bango,
              // 'netlogin' => Helper::getSystemIP()
            ];
            QueryHelper::updateData('haisou',$update_data,'bango',$bango,__CLASS__,__FUNCTION__,__LINE__);
        }

        //end log query
        $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 事業所マスタ end\n";
        QueryHandler::logger($bango,$log_data);

        //$deleteAfter = allHaisou::data($kesuId)->where('bango',$kesuId)->first();
        $query = allHaisou::data($bango, '*', $kesuId);
        $deleteAfter = QueryHelper::fetchSingleResult($query);

        $headers = $this->headers;
        $headers['データ有効区分'] = 'kounyusu';
        //csvRecordDelete::putData('officeMaster.csv','haisou',$deleteBefore,$deleteAfter,$bangoName,$headers);

        if ($type == 1) {
            CSVLogger::putData('事業所マスタ.csv', 'haisou', $deleteBefore, $deleteAfter, $bangoName, $headers, 3);
        } else {
            CSVLogger::putData('事業所マスタ.csv', 'haisou', $deleteBefore, $deleteAfter, $bangoName, $headers, 0);
        }

        return 'ok';
    }

    public function ApiReadHaisou(Request $request, $id, $num){

        //$haisouData = QueryHelper::fetchResult("select bango,torihikisakibango,name,address,haisoumoji1,yubinbango from haisou where kokyakubango = '$num' and kounyusu = 0 ORDER BY yubinbango,name ASC");
        $haisouData = QueryHelper::fetchResult("
            select
            haisou.bango,
            haisou.torihikisakibango,
            haisou.name,
            haisou.address,
            haisou.haisoumoji1,
            haisou.yubinbango,
            CASE
                WHEN kokyaku1.yetoiawsestart = '31' THEN '末'
                ELSE kokyaku1.yetoiawsestart END as yetoiawsestart,
            SPLIT_PART(kokyaku1.ytoiawsesaiban,' ',2) as ytoiawsesaiban_detail,

            --payment_day
            CASE
                WHEN substring(others2.other1,1,1) = '1' THEN
                            concat(
                            CASE
                                WHEN trim(categorykanriYtoiawsestart.category4) = '' THEN NULL
                                ELSE trim(categorykanriYtoiawsestart.category4) END,
                            ' ',
                            SPLIT_PART(kokyaku1.ytoiawsesaiban,' ',2),
                            ' ',
                            CASE
                                WHEN kokyaku1.yetoiawsestart is null THEN NULL
                                WHEN kokyaku1.yetoiawsestart = '31' THEN '末日'
                                ELSE concat(kokyaku1.yetoiawsestart,'日') END
                            )
                WHEN substring(others2.other1,1,1) = '2' THEN
                        concat(
                            CASE
                                WHEN trim(categorykanriOther3.category4) = '' THEN NULL
                                ELSE trim(categorykanriOther3.category4) END,
                            ' ',
                            SPLIT_PART(others2.other5,' ',2),
                            ' ',
                            CASE
                                WHEN others2.other6 is null THEN NULL
                                WHEN others2.other6 = '31' THEN '末日'
                                ELSE concat(others2.other6,'日') END
                            )
                ELSE '' END as payment_day,
            --payment_day

            --invoice_method
            CASE
                WHEN substring(others2.other1,1,1) = '1' THEN concat(kokyaku1.mail_jyushin_mb,'/',kokyaku1.mail_nouhin)
                WHEN substring(others2.other1,1,1) = '2' THEN concat(others2.other14,'/',others2.other11)
                ELSE '' END as invoice_method
            --invoice_method

            from haisou
            join kokyaku1 on kokyaku1.bango = haisou.kokyakubango
            join others2 on others2.otherint1 = haisou.bango
            left join categorykanri as categorykanriYtoiawsestart
                on substring(kokyaku1.ytoiawsestart,1,2) = categorykanriYtoiawsestart.category1
                and substring(kokyaku1.ytoiawsestart,3,4) = categorykanriYtoiawsestart.category2
            left join categorykanri as categorykanriOther3
                on substring(others2.other3,1,2) = categorykanriOther3.category1
                and substring(others2.other3,3,4) = categorykanriOther3.category2
            where haisou.kokyakubango = '$num' and haisou.kounyusu = 0
            ORDER BY haisou.yubinbango,haisou.name ASC
            ");


        $sendArray = [];

        foreach ($haisouData as $key => $value) {

            foreach ($value as $k => $val) {
                $sendArray[$key][$k] = $val;
            }
        }

        return $sendArray;
    }

    public function ApiReadHaisou_2(Request $request, $id, $num){

        //$haisouData = QueryHelper::fetchResult("select bango,torihikisakibango,name,address,haisoumoji1,yubinbango from haisou where kokyakubango = '$num' and kounyusu = 0 ORDER BY yubinbango,name ASC");
        $haisouData = QueryHelper::fetchResult("
            select
            haisou.bango,
            haisou.torihikisakibango,
            haisou.name,
            haisou.address,
            others2.other1,
            haisou.haisoumoji1,
            haisou.yubinbango,
            CASE
                WHEN kokyaku1.yetoiawsestart = '31' THEN '末'
                ELSE kokyaku1.yetoiawsestart END as yetoiawsestart,
            SPLIT_PART(kokyaku1.ytoiawsesaiban,' ',2) as ytoiawsesaiban_detail,
            CASE
            WHEN substring(others2.other1,1,1) = '1' THEN
                        concat(
                        CASE
                            WHEN trim(categorykanritel.category4) = '' THEN NULL
                            ELSE trim(categorykanritel.category4) END,
                        ' ',
                        CASE
                            WHEN substring (haisoujouhou.mail,1,1)= '' THEN NULL
                            WHEN substring (haisoujouhou.mail,1,1)= '0' THEN '当月'
                            WHEN substring (haisoujouhou.mail,1,1)= '1' THEN '翌月'
                            WHEN substring (haisoujouhou.mail,1,1)= '2' THEN '翌々月'
                            WHEN substring (haisoujouhou.mail,1,1)= '3' THEN '3ヶ月'
                            WHEN substring (haisoujouhou.mail,1,1)= '4' THEN '4ヶ月'
                            ELSE null END,
                        ' ',
                        CASE
                            WHEN haisoujouhou.sex= '' THEN NULL
                            WHEN haisoujouhou.sex= 'F910' THEN '10日'
                            WHEN haisoujouhou.sex= 'F925' THEN '25日'
                            WHEN haisoujouhou.sex= 'F931' THEN '末日'
                            ELSE null END
                        )
            WHEN substring(others2.other1,1,1) = '2' THEN
                    concat(
                        CASE
                            WHEN trim(categorykanriother19.category4) = '' THEN NULL
                            ELSE trim(categorykanriother19.category4) END,
                        ' ',
                        CASE
                            WHEN substring (others2.other20,1,1)= '' THEN NULL
                            WHEN substring (others2.other20,1,1)= '0' THEN '当月'
                            WHEN substring (others2.other20,1,1)= '1' THEN '翌月'
                            WHEN substring (others2.other20,1,1)= '2' THEN '翌々月'
                            WHEN substring (others2.other20,1,1)= '3' THEN '3ヶ月'
                            WHEN substring (others2.other20,1,1)= '4' THEN '4ヶ月'
                            ELSE null END,
                        ' ',
                        CASE
                            WHEN others2.other21= '' THEN NULL
                            WHEN others2.other21= 'F910' THEN '10日'
                            WHEN others2.other21= 'F925' THEN '25日'
                            WHEN others2.other21= 'F931' THEN '末日'
                            ELSE null END
                        )
            ELSE '' END as payment_day,
            categorykanri_2.category4 as payment_method


            from haisou
            join kokyaku1 on kokyaku1.bango = haisou.kokyakubango
            left join haisoujouhou on haisoujouhou.syukei1 = kokyaku1.bango
            join others2 on others2.otherint1 = haisou.bango

            left join categorykanri as categorykanritel
                on substring(haisoujouhou.tel,1,2) = categorykanritel.category1
                and substring(haisoujouhou.tel,3,4) = categorykanritel.category2
            left join categorykanri as categorykanriother19
                on substring(others2.other19,1,2) = categorykanriother19.category1
                and substring(others2.other19,3,4) = categorykanriother19.category2

            left join categorykanri as categorykanri_2
            on CASE WHEN substring(others2.other1,1,1) = '1'
                  THEN categorykanri_2.category1||categorykanri_2.category2 =  haisoujouhou.bunrui3
                  WHEN substring(others2.other1,1,1) ='2'
                  THEN categorykanri_2.category1||categorykanri_2.category2 = others2.other24 END
            where haisou.kokyakubango = '$num' and haisou.kounyusu = 0
            and CASE WHEN substring(others2.other1,1,1) = '1'
                  THEN substring(haisoujouhou.syukeikikijun,1,1) = '1'
                  WHEN substring(others2.other1,1,1) ='2'
                  THEN substring(haisou.syukeiki,1,1) = '1' END
            ORDER BY haisou.yubinbango,haisou.name ASC
            ");


        $sendArray = [];

        foreach ($haisouData as $key => $value) {

            foreach ($value as $k => $val) {
                $sendArray[$key][$k] = $val;
            }
        }

        return $sendArray;
    }

    public function ApiReadEtsuransya(Request $request, $id, $num){

        $etsuransyaData = QueryHelper::fetchResult("select bango,tantousya,mail2,datatxt0049 from etsuransya where datanum0018 = '$num' and deleteflag = 0 ORDER BY mail2,tantousya ASC");
        //$etsuransyaData = json_decode(json_encode($etsuransyaData),true);

        $sendArray = [];

        foreach ($etsuransyaData as $key => $value) {

            foreach ($value as $k => $val) {
                $sendArray[$key][$k] = $val;
            }
        }

        return $sendArray;
    }

    public function ApiReadEtsuransyaDetail(Request $request, $id, $num){

        $etsuransyaData = QueryHelper::fetchSingleResult("select tantousya,mail1,mail2,mail3,mail4,datatxt0015,datatxt0016,datatxt0049 from etsuransya where bango = '$num' and deleteflag = 0");
        //$etsuransyaData = json_decode(json_encode($etsuransyaData),true);

        $array = [];
        foreach ($etsuransyaData as $key => $value) {
            $array[$key] = $value;
        }

        return $array;
    }

    public function loadSelectedKokyaku(Request $request, $bango)
    {
        $yobi12 = $request->yobi12;
        $kokyaSql = DB::table('kokyaku1')->whereRaw("yobi12 = '$yobi12'")->toSql();
        $init_data = QueryHelper::fetchSingleResult($kokyaSql);
        $kokyaku_bango = $init_data->bango;
        $com_query = allCompany::data($bango, 0, $kokyaku_bango);
        $init_selected_kokyaku = collect(QueryHelper::fetchSingleResult($com_query))->toArray();

        return $init_selected_kokyaku;
    }

}
