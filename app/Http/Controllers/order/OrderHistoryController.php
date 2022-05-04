<?php

namespace App\Http\Controllers\order;
use App\AllClass\master\nameMaster\allCategorykanri;
use Illuminate\Http\Request;
use App\tantousya;
use App\kengen;
use App\requestTable;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\order\orderHistory\orderHistoryHeaders;
use App\AllClass\order\orderHistory\validateOrderHistory;
use App\AllClass\order\orderHistory\allOrderHistory;
use App\AllClass\order\orderEntry\searchCompany2;
use App\AllClass\order\orderEntry\searchCompany4;
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

class OrderHistoryController extends Controller
{
    private $headers = [
        '受注区分' => 'datachar02_detail',
        '作成区分' => 'datachar01',
        '担当' => 'user_name',
        '受注番号' => 'kokyakuorderbango',
        '訂正回数' => 'ordertypebango2',
        '受注件名' => 'juchukubun1',
        '受注先' => 'information1_detail',
        '売上請求先' => 'information2_detail',
        '最終顧客' => 'information3_detail',
        '受注金額' => 'formatted_money10',
        '粗利' => 'formatted_moneymax',
        '受注日' => 'intorder01',
        '検収日' => 'intorder04',
        '売上日' => 'intorder03',
        '入金日' => 'intorder05',
        '[最終顧客]データソース' => 'end_cus_source',
        '[最終顧客]ユーザー' => 'end_cus_user',
        '[最終顧客]取引開始日' => 'trading_start_date',
        '[受注先]取引開始日' => 'trading_end_date',
        'プロジェクト番号' => 'order_history_datachar03',
        '客先注番' => 'order_history_datachar04',
        '代理店1' => 'information4_detail',
        '代理店2' => 'information5_detail',
        '請求書送付先' => 'information6_detail',
        '入金方法' => 'kessaihouhou_detail',
        '即時区分' => 'housoukubun',
        '検収条件' => 'chumonsyajouhou_detail',
        '注文書書類保管番号' => 'order_history_datachar08',
        '検収確認書書類保管番号' => 'order_history_datachar09',
        '売上指示・検印フェーズ' => 'hktsyukko_datachar01_detail',
        '売上指示者' => 'datachar02_tan_name',
        '売上検印者' => 'datachar03_tan_name',
        '伝票作成フラグ' => 'hktsyukko_datachar04_detail',
        '伝票作成者' => 'datachar05_tan_name',
        '検収書確認フラグ' => 'hktsyukko_datachar06_detail',
        '検収書確認者' => 'datachar07_tan_name',
        '受注実績作成フラグ' => 'hktsyukko_datachar08_detail',
        '売上伝票メール送信フラグ' => 'hktsyukko_datachar09_detail',
        '売上伝票PDFダウンロードフラグ' => 'hktsyukko_datachar10_detail',
        '最終顧客／販売ランク' => 'koyk1_domain',
        '最終顧客／顧客深耕層別化' => 'koyk1_domain2',
        '定期定額契約番号' => 'chumonbango',
        '仕入完了計算フラグ' => 'datachar16',
        '仕入完了指示者' => 'datachar17_tan_name',
        '仕入完了検印者' => 'datachar18_tan_name',
        '受注T登録年月日' => 'registration_date',
        '受注T登録時刻' => 'registration_time',
        '受注T更新者' => 'changer',
        '受注T訂正回数' => 'initial_ordertypebango2',
        '受注F登録年月日' => 'tanabango_date',
        '受注F登録時刻' => 'tanabango_time',
        '受注F更新年月日' => 'update_date',
        '受注F更新時刻' => 'update_time',
        '受注F更新者' => 'tantousyabango',
    ];


    public function postOrderHistory(Request $request)
    {
        $bango = request('userId');

        //check validation for first search
        if($request->ajax()){
            $validator = validateOrderHistory::validate($request,$bango);
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

        //pull option selection starts here
        $data003=substr($tantousya->datatxt0003, 2,4);
        $data003_left=substr($tantousya->datatxt0003, 2,4);
        $data003_right=substr($tantousya->datatxt0003, 2,4);
        if (isset($data_from_view['division_datachar05_start'])) {
           $data003_left=substr($data_from_view['division_datachar05_start'], 2,4);
        }else if (isset($data_from_view['division_datachar05_startReqVal'])) {
           $data003_left=substr($data_from_view['division_datachar05_startReqVal'], 2,4);
        }
        if (isset($data_from_view['division_datachar05_end'])) {
           $data003_right=substr($data_from_view['division_datachar05_end'], 2,4);
        }if (isset($data_from_view['division_datachar05_endReqVal'])) {
           $data003_right=substr($data_from_view['division_datachar05_endReqVal'], 2,4);
        }
        $data004=substr($tantousya->datatxt0004, 2,5);
        $data005=substr($tantousya->datatxt0005, 2,6);
        $personal_datatxt0003=QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'B9' ")->where("category2 = '$data003' ")->get()->first();
        $personal_datatxt0004=QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C1' ")->where("category2 = '$data004' ")->get()->first();
        $personal_datatxt0005=QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("category2 = '$data005' ")->get()->first();
        //pull option selection ends here

        $buttonMessage = ButtonMsg::read($bango);

        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 20;
        }

        $default_content_setumei = $bango;
        $check_tan = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango'")->where("mail4 = 'C310'")->get()->execute();

        //review data
        $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7501'");
        $review_orderbango = $reviewData->orderbango;

        //get categorykanri data
        $B9Data_left = QueryHelper::fetchResult("select *,RIGHT(category2, 2) as category2_show from categorykanri where category1 = 'B9' and (suchi2 = 0 or suchi2 is null) and left(category2, 2) ='$review_orderbango' ORDER BY category2 ASC");
        $B9Data_right = QueryHelper::fetchResult("select *,RIGHT(category2, 2) as category2_show from categorykanri where category1 = 'B9' and (suchi2 = 0 or suchi2 is null) and left(category2, 2) ='$review_orderbango' ORDER BY category2 ASC");
        $C1Data_left = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C1' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_left%' ")->get()->execute();
        $C1Data_right = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C1' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_right%' ")->get()->execute();
        if (isset($data_from_view['department_datachar05_start'])) {
            $data003_left = substr($data_from_view['department_datachar05_start'],2,5);
            $data003_right = substr($data_from_view['department_datachar05_start'],2,5);
        }
        if (isset($data_from_view['group_datachar05_start'])) {
            $data003_short = substr($data_from_view['group_datachar05_start'],2,5);
            $data003 = substr($data_from_view['group_datachar05_start'],2,6);
            $C2Data_left = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_short%' ")->get()->execute();
            $C2Data_right = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_short%' ")->where("CAST(category2 as integer) >= $data003 ")->get()->execute();
        }else{
            $C2Data_left = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_left%' ")->get()->execute();
            $C2Data_right = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_right%' ")->get()->execute();
        }
        
        //get tantousya data
        $datachar05 = QueryHelper::fetchResult("select * from tantousya where deleteflag = 0 and ztanka='$review_orderbango' and innerlevel >= 10 and innerlevel <= 20 order by bango");

        if (!empty($data_from_view['chkboxinp'])) {
            $deleted_item = $data_from_view['chkboxinp'];
        } else {
            $deleted_item = 0;
        }

        $headers = orderHistoryHeaders::headers($bango);
        $table_headers = orderHistoryHeaders::headers($bango, 'table_headers');
        $page_no = orderHistoryHeaders::$page_no;
        $route = 'orderHistoryTableSetting';
        $redirect_path = 'orderHistoryReload';
        
        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $bango)->where('kengenchar05', '02-03')->get()->count();
        if($initial_header == 0){
            unset($headers['仕入完了計算フラグ']);
            unset($headers['仕入完了指示者']);
            unset($headers['仕入完了検印者']);
            unset($headers['受注T登録年月日']);
            unset($headers['受注T登録時刻']);
            unset($headers['受注T更新者']);
            unset($headers['受注T訂正回数']);
            unset($headers['受注F登録年月日']);
            unset($headers['受注F登録時刻']);
            unset($headers['受注F更新年月日']);
            unset($headers['受注F更新時刻']);
            unset($headers['受注F更新者']);
        }

        //$categorykanri = QueryHelper::select(["*", "CONCAT(categorykanri.category1,'',categorykanri.category2) as oid"])->from('categorykanri')->get()->execute();

        $temp_table = 'order_history_temp';

        //show page start here
        if (isset($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh')) {
            $fsRemoveKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp'];
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp','division_datachar05_start','division_datachar05_end','department_datachar05_start','department_datachar05_end','group_datachar05_start','group_datachar05_end','intorder01_start','intorder01_end','rd1','rd2','kokyakuorderbango_start','kokyakuorderbango_end','information1_text','information2_text','information3_text'];

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
                    $str_to_int = ['money10', 'moneymax'];
                    foreach ($data_from_view as $key => $value) {
                        if (in_array($key, $str_to_int)) {
                            $data_from_view[$key] = str_replace(',', '', $data_from_view[$key]);
                        }
                    }

                    $data = $this->removeDataFromView($data_from_view, $removeKeys);

                    //check first search or default search
                    //if($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort'){
                    //    $default_req_data = $default_data;
                    //}else{
                    //   $default_req_data = "";
                    //}

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
                    if(isset($data['user_name_search'])){
                        $data['user_name_search'] = str_replace('　','',str_replace(' ','',$data['user_name_search']));
                    }
                    if(isset($data['datachar17_tan_name_search'])){
                        $data['datachar17_tan_name_search'] = str_replace('　','',str_replace(' ','',$data['datachar17_tan_name_search']));
                    }
                    if(isset($data['datachar18_tan_name_search'])){
                        $data['datachar18_tan_name_search'] = str_replace('　','',str_replace(' ','',$data['datachar18_tan_name_search']));
                    }
                    if(isset($data['datachar02_tan_name_search'])){
                        $data['datachar02_tan_name_search'] = str_replace('　','',str_replace(' ','',$data['datachar02_tan_name_search']));
                    }
                    if(isset($data['datachar03_tan_name_search'])){
                        $data['datachar03_tan_name_search'] = str_replace('　','',str_replace(' ','',$data['datachar03_tan_name_search']));
                    }
                    if(isset($data['datachar05_tan_name_search'])){
                        $data['datachar05_tan_name_search'] = str_replace('　','',str_replace(' ','',$data['datachar05_tan_name_search']));
                    }
                    if(isset($data['datachar07_tan_name_search'])){
                        $data['datachar07_tan_name_search'] = str_replace('　','',str_replace(' ','',$data['datachar07_tan_name_search']));
                    }

                    //first search bangos
                    //$first_search_res = "";
                    //if(!empty($fsReqData)){
                    //    $search_removeKeys = ['division_datachar05_start','division_datachar05_end','department_datachar05_start','department_datachar05_end','group_datachar05_start','group_datachar05_end','intorder01_start','intorder01_end','rd1','rd2','kokyakuorderbango_start','kokyakuorderbango_end','information1_text','information2_text','information3_text'];
                    //    $reqData = $this->removeDataFromView($fsReqData, $search_removeKeys);
                    //    $query = allOrderHistory::data($bango, $deleted_item,$bangos,$fsReqData)->toSql();
                    //    $orderHistoryInfo = $this->searchDataFetch($query, $reqData, $bango, $temp_table);
                    //    foreach($orderHistoryInfo as $key=>$val){
                    //        foreach($val as $k=>$v){
                    //            if($k=="bango"){
                    //                array_push($bangos,$v);
                    //            }
                    //        }
                    //    }
                    //    if(count($bangos)<1){
                    //        $first_search_res = "no_data";
                    //    }
                    //}else if(($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort') && empty($fsReqData)){
                    //    $pagi = 20;
                    //   return view('order.orderHistory.mainOrderHistory', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'pagi', 'deleted_item', 'buttonMessage','B9Data_left','B9Data_right','C1Data_left','C1Data_right','C2Data_left','C2Data_right','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','datachar05','hktsyukko_datachar01','hktsyukko_datachar06'));
                    //}
                    
                    if(($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'refresh') && $defalut_check == 0){
                        $pagi = 20;
                        return view('order.orderHistory.mainOrderHistory', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'pagi', 'deleted_item', 'buttonMessage','B9Data_left','B9Data_right','C1Data_left','C1Data_right','C2Data_left','C2Data_right','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','datachar05'));
                    }

                    $query = allOrderHistory::data($bango, $deleted_item,$req_data)->toSql();
                    $orderHistoryInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    $orderHistoryInfo2 = $this->searchDataFetch($query, $data, $bango, $temp_table);
                    if ($orderHistoryInfo->items() == null && $orderHistoryInfo->currentPage() != 1) {
                        $currentPage = ($orderHistoryInfo->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $orderHistoryInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                        $orderHistoryInfo2 = $this->searchDataFetch($query, $data, $bango, $temp_table);
                    }
                    if ($orderHistoryInfo->total() == 0) {
                        $exceedUser = '該当するデータがありません。';
                    } else {
                        $exceedUser = '';
                    }

                    //if($data_from_view['Button'] == 'FirstSearch'){
                    //    $fsReqData = $req_data; //fsReqData=first search request data
                    //}

                    //export excel
                    if ($data_from_view['Button'] == 'xls') {
                        $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                        $headers = $this->headers;
                        $excelName = '受注履歴一覧・受注照会.xlsx';
                        //return newExcelExport::download($searched,$headers, $excelName);
                        return $this->excelDownload($headers, $searched, $excelName);
                    }


                }
            } catch (\Exception $e) {
                $exceedUser = '検索形式が間違っています。';
                //$orderHistoryInfo = QueryHelper::fetchResult($query);
                $orderHistoryInfo = collect();
                $order_amount  = $orderHistoryInfo->sum('money10');
                $gross_profit  = $orderHistoryInfo->sum('moneymax');
                $orderHistoryInfo = $orderHistoryInfo->paginate($pagination);

                return view('order.orderHistory.mainOrderHistory', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'orderHistoryInfo', 'tantousya', 'deleted_item','exceedUser', 'buttonMessage','B9Data_left','B9Data_right','C1Data_left','C1Data_right','C2Data_left','C2Data_right','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','datachar05','fsReqData','order_amount','gross_profit'));
            }

            $order_amount  = $orderHistoryInfo2->sum('money10');
            $gross_profit  = $orderHistoryInfo2->sum('moneymax');
            return view('order.orderHistory.mainOrderHistory', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'orderHistoryInfo', 'tantousya', 'deleted_item','exceedUser', 'buttonMessage','B9Data_left','B9Data_right','C1Data_left','C1Data_right','C2Data_left','C2Data_right','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','datachar05','req_data','fsReqData','order_amount','gross_profit'));
        }

        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;
        //if (request('change_id')) {
        //    $query = allOrderHistory::data($bango, $deleted_item)->whereRaw("bango = '" . request('change_id') . "'")->toSql();
        //} else {
        //    $query = allOrderHistory::data($bango, $deleted_item)->toSql();
        //}

//        $orderHistoryInfo = QueryHelper::fetchResult($query);
//        $orderHistoryInfo = collect($orderHistoryInfo);
//        $order_amount  = $orderHistoryInfo->sum('money10');
//        $gross_profit  = $orderHistoryInfo->sum('moneymax');
//        $orderHistoryInfo = $orderHistoryInfo->paginate($pagi);

        session()->forget('oldInput' . $bango);
        //return view('order.orderHistory.mainOrderHistory', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'orderHistoryInfo', 'tantousya', 'pagi', 'deleted_item', 'buttonMessage','B9Data_left','B9Data_right','C1Data_left','C1Data_right','C2Data_left','C2Data_right','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','datachar05','order_amount','gross_profit'));
        return view('order.orderHistory.mainOrderHistory', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'pagi', 'deleted_item', 'buttonMessage','B9Data_left','B9Data_right','C1Data_left','C1Data_right','C2Data_left','C2Data_right','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','datachar05'));
    }


    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $id)->where('kengenchar05', '02-03')->get()->count();
        $pageNo = orderHistoryHeaders::$page_no;
        //return $Setting = TableSetting::setting($this->headers, $id, $pageNo);
        $Setting = TableSetting::setting($this->headers, $id, $pageNo);
        if($initial_header == 0){
            $Setting['datachar16'] = "";
            $Setting['datachar17_tan_name'] = "";
            $Setting['datachar18_tan_name'] = "";
            $Setting['registration_date'] = "";
            $Setting['registration_time'] = "";
            $Setting['changer'] = "";
            $Setting['initial_ordertypebango2'] = "";
            $Setting['tanabango_date'] = "";
            $Setting['tanabango_time'] = "";
            $Setting['update_date'] = "";
            $Setting['update_time'] = "";
            $Setting['tantousyabango'] = "";
        }
        return $Setting;

    }

    public function tableSettingSave(Request $request, $id, $type = null)
    {
        $pageNo = orderHistoryHeaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '受注履歴一覧・受注照会', $type);
    }


    public function ApiReadCompanyDetail(Request $request, $id, $num){
        $companyData = QueryHelper::fetchSingleResult("select * from kokyaku1 where bango = '$num' and denpyosaiban = 0");
        $companyData = json_decode(json_encode($companyData),true);

        $array = [];
        foreach ($companyData as $key => $value) {
            $array[$key] = $value;
        }

        return $array;
    }

    public function clearBottomReqData($request_data){
        $headers = [
            '受注区分' => 'datachar02_detail',
            '作成区分' => 'datachar01',
            '担当' => 'user_name_search',
            '受注番号' => 'kokyakuorderbango',
            '訂正回数' => 'ordertypebango2',
            '受注件名' => 'juchukubun1',
            '受注先' => 'information1_detail',
            '売上請求先' => 'information2_detail',
            '最終顧客' => 'information3_detail',
            '受注金額' => 'money10',
            '粗利' => 'moneymax',
            '受注日' => 'intorder01',
            '検収日' => 'intorder04',
            '売上日' => 'intorder03',
            '入金日' => 'intorder05',
            '[最終顧客]データソース' => 'end_cus_source',
            '[最終顧客]ユーザー' => 'end_cus_user',
            '[最終顧客]取引開始日' => 'trading_start_date',
            '[受注先]取引開始日' => 'trading_end_date',
            'プロジェクト番号' => 'order_history_datachar03',
            '客先注番' => 'order_history_datachar04',
            '代理店1' => 'information4_detail',
            '代理店2' => 'information5_detail',
            '請求書送付先' => 'information6_detail',
            '入金方法' => 'kessaihouhou_detail',
            '即時区分' => 'housoukubun',
            '検収条件' => 'chumonsyajouhou_detail',
            '注文書書類保管番号' => 'order_history_datachar08',
            '検収確認書書類保管番号' => 'order_history_datachar09',
            '売上指示・検印フェーズ' => 'hktsyukko_datachar01_detail',
            '売上指示者' => 'datachar02_tan_name_search',
            '売上検印者' => 'datachar03_tan_name_search',
            '伝票作成フラグ' => 'hktsyukko_datachar04_detail',
            '伝票作成者' => 'datachar05_tan_name_search',
            '検収書確認フラグ' => 'hktsyukko_datachar06_detail',
            '検収書確認者' => 'datachar07_tan_name_search',
            '受注実績作成フラグ' => 'hktsyukko_datachar08_detail',
            '売上伝票メール送信フラグ' => 'hktsyukko_datachar09_detail',
            '売上伝票PDFダウンロードフラグ' => 'hktsyukko_datachar10_detail',
            '最終顧客／販売ランク' => 'koyk1_domain',
            '最終顧客／顧客深耕層別化' => 'koyk1_domain2',
            '仕入完了計算フラグ' => 'datachar16',
            '定期定額契約番号' => 'chumonbango',
            '仕入完了指示者' => 'datachar17_tan_name_search',
            '仕入完了検印者' => 'datachar18_tan_name_search',
            '受注T登録年月日' => 'registration_date',
            '受注T登録時刻' => 'registration_time',
            '受注T更新者' => 'changer',
            '受注T訂正回数' => 'initial_ordertypebango2',
            '受注F登録年月日' => 'tanabango_date',
            '受注F登録時刻' => 'tanabango_time',
            '受注F更新年月日' => 'update_date',
            '受注F更新時刻' => 'update_time',
            '受注F更新者' => 'tantousyabango',
        ];
        foreach($request_data as $key=>$val){
            if (in_array($key, $headers)){
                $request_data[$key] = null;
            }
        }
        return $request_data;
    }

}
