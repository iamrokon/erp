<?php

namespace App\Http\Controllers\sales;
use Illuminate\Http\Request;
use App\tantousya;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\sales\unpaidList\UnpaidListHeaders;
use App\AllClass\sales\unpaidList\ValidateUnpaidList;
use App\AllClass\sales\unpaidList\ValidateUnpaidDate;
use App\AllClass\sales\unpaidList\AllUnpaidList;
use App\AllClass\ButtonMsg;
use Illuminate\Pagination\Paginator;
use App\AllClass\master\excelDownload;
use App\AllClass\TableSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\AllClass\master\ExcelReportDownload;
use Carbon\Carbon;
use App\AllClass\master\CSVLogger;
use App\AllClass\newExcelExport;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;

class UnPaidListController extends Controller
{
    private $headers = [
        '売上番号	' => 'datachar10',
        '売上区分	' => 'datachar02_detail',
        '受注番号' => 'kokyakuorderbango',
        '受注先' => 'information1_detail',
        '受注件名' => 'juchukubun1_short',
        '最終顧客' => 'information3_detail',
        '担当' => 'user_name',
        '売上日' => 'v_intorder03',
        '入金予定日' => 'intorder05_input',
        '実入金日' => 'v_intorder05',
        '前受' => 'unsoutesuryou',
        '入金済' => 'req_dataint01',
        '売上金額' => 'unpaidlist_sales_amount',
        '入金額' => 'unpaidlist_sum_of_nyukingaku',
        '入金残' => 'unpaidlist_deposit_balance',
        '売上請求先' => 'information2_detail',
        '入金消込番号' => 'max_old_shinkurokokyakuorderbango',
        '入金消込行番号' => 'max_moneymax',
        '売掛残高更新フラグ' => 'req_soufusakiname',
        '請求残高更新フラグ' => 'req_soufusakiyubinbango',
    ];


    public function index(Request $request)
    {
        $bango = request('userId');

        //check validation for first search
        if($request->ajax()){
            $validator = ValidateUnpaidList::validate($request,$bango);
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
        $C2Data_left = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_left%' ")->get()->execute();
        $C2Data_right = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_right%' ")->get()->execute();

        //get tantousya data
        $datachar05 = QueryHelper::fetchResult("select * from tantousya where deleteflag = 0 and ztanka='$review_orderbango' and innerlevel >= 10 and innerlevel <= 20 order by bango");

        $mode_selection = QueryHelper::select(['*'])->from('request')->where(" color = '0412モード選択'")->orderBy("syouhinbango asc")->get()->execute();
        $display_order = QueryHelper::select(['*'])->from('request')->where(" color = '0412表示順'")->orderBy("syouhinbango asc")->get()->execute();
        
        if (!empty($data_from_view['chkboxinp'])) {
            $deleted_item = $data_from_view['chkboxinp'];
        } else {
            $deleted_item = 0;
        }

        $headers = UnpaidListHeaders::headers($bango);
        $table_headers = UnpaidListHeaders::headers($bango, 'table_headers');
        $page_no = UnpaidListHeaders::$page_no;
        $route = 'unpaidListTableSetting';
        $redirect_path = 'unpaidListReload';

        $temp_table = 'unpaid_list';

        //show page start here
        if (isset($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh')) {
            $fsRemoveKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp'];
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp','division_datachar05_start','division_datachar05_end','department_datachar05_start','department_datachar05_end','group_datachar05_start','group_datachar05_end','intorder05_start','intorder05_end','intorder03_start','intorder03_end','rd1','rd2','temp_intorder05_input','check_intorder05_input','orderhenkan_bango'];

            try {
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh') {
                    //clear bottom search request data
                    if($data_from_view['Button'] == 'refresh'){
                        $data_from_view = self::clearBottomReqData($data_from_view);
                    }

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
                    
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);                   

                    //first search req data
                    $fsReqData = [];
                    foreach ($data as $key => $value) {
                        if (strpos($key, 'ReqVal') !== false) {
                            $temp_new_key = str_replace('ReqVal', '', $key);
                            if (array_key_exists($temp_new_key,$data)){ //when pagination change
                                $fsReqData[$temp_new_key] = $data[$temp_new_key];
                                $data[$temp_new_key] = $data[$temp_new_key];
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
                    
                    if(($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'refresh') && $defalut_check == 0){
                        $pagi = 20;
                        return view('sales.unpaidList.mainUnpaidList', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'pagi', 'deleted_item', 'buttonMessage','mode_selection', 'display_order','B9Data_left','B9Data_right','C1Data_left','C1Data_right','C2Data_left','C2Data_right','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','datachar05'));
                    }
                   
                    $query = AllUnpaidList::data($bango, $deleted_item,$req_data)->toSql();
                    if(isset($data['unpaidlist_sales_amount'])){
                        $data['unpaidlist_sales_amount'] = str_replace(',', '', $data['unpaidlist_sales_amount']);
                    }
                    if(isset($data['unpaidlist_sum_of_nyukingaku'])){
                        $data['unpaidlist_sum_of_nyukingaku'] = str_replace(',', '', $data['unpaidlist_sum_of_nyukingaku']);
                    }
                    if(isset($data['unpaidlist_deposit_balance'])){
                        $data['unpaidlist_deposit_balance'] = str_replace(',', '', $data['unpaidlist_deposit_balance']);
                    }
                    
                    $unpaidInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    if ($unpaidInfo->items() == null && $unpaidInfo->currentPage() != 1) {
                        $currentPage = ($unpaidInfo->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $unpaidInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    }                    
                    
                    if ($unpaidInfo->total() == 0) {
                        $exceedUser = '該当するデータがありません。';
                    } else {
                        $exceedUser = '';
                    }

                    //export excel
                    if ($data_from_view['Button'] == 'xls') {
                        $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                        $headers = $this->headers;
                        $excelName = '未入金一覧.xlsx';
                        return $this->excelDownload($headers, $searched, $excelName);
                    }

                }
            } catch (\Exception $e) {
                $exceedUser = '検索形式が間違っています。';
                $unpaidInfo = collect();
                $unpaidInfo = $unpaidInfo->paginate($pagination);

                return view('sales.unpaidList.mainUnpaidList', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'unpaidInfo', 'tantousya', 'deleted_item','exceedUser', 'buttonMessage','mode_selection', 'display_order','B9Data_left','B9Data_right','C1Data_left','C1Data_right','C2Data_left','C2Data_right','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','datachar05','req_data','fsReqData'));
            }

            return view('sales.unpaidList.mainUnpaidList', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'unpaidInfo', 'tantousya', 'deleted_item','exceedUser', 'buttonMessage','mode_selection', 'display_order','B9Data_left','B9Data_right','C1Data_left','C1Data_right','C2Data_left','C2Data_right','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','datachar05','req_data','fsReqData'));
        }

        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;
        $query = AllUnpaidList::data($bango, $deleted_item)->toSql();

        session()->forget('oldInput' . $bango);
        return view('sales.unpaidList.mainUnpaidList', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'pagi', 'deleted_item', 'buttonMessage','mode_selection', 'display_order', 'B9Data_left','B9Data_right','C1Data_left','C1Data_right','C2Data_left','C2Data_right','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','datachar05'));
    }

    public function updateSelectedDepositeDate(Request $request){
        $bango = request('userId');
        $intorder05 = $request->temp_intorder05_input;
        $check_intorder05 = $request->check_intorder05_input;
        $orderhenkan_bangos = $request->orderhenkan_bango;
        
        $validator = ValidateUnpaidDate::validate($request,$bango);
        $errors = $validator->errors();
        if($errors->any()){
           $err_msg = $errors->all();
           return ['err_field'=>$errors,'err_msg'=>$err_msg];
        }else if(!$errors->any() && request('submit_confirmation') == ""){
            return "confirmation_msg";
        }else{
            foreach($intorder05 as $key=>$val){
                if($check_intorder05[$key] != $val){
                    $ordrhenkn_bango = $orderhenkan_bangos[$key];
                    $orderhenkanInfo = QueryHelper::fetchSingleResult("select bango,datachar10,kokyakuorderbango from orderhenkan where bango = '$ordrhenkn_bango'");

                    //update orderhenkan data
                    $orderhenkan_update_data = [
                            'bango' => $ordrhenkn_bango,
                            'intorder05' => str_replace("/", "", $val),
                            'orderuserbango' => $bango,
                        ];
                    $orderhenkanUpdate = QueryHelper::updateData('orderhenkan', $orderhenkan_update_data, 'bango', $bango, __CLASS__, __FUNCTION__, __LINE__);

                    //update hikiatesyukko data
                    $hikiatesyukko_update_data = [
                            'orderbango' => $ordrhenkn_bango,
                            'idoutanabango' => Carbon::now()->format('Y-m-d H:i:s'),
                            'tantousyabango' => $bango,
                        ];
                    $hikiatesyukkoUpdate = QueryHelper::updateData('hikiatesyukko', $hikiatesyukko_update_data, 'orderbango', $bango, __CLASS__, __FUNCTION__, __LINE__);

                    $update_msg[] = "受注番号".$orderhenkanInfo->kokyakuorderbango."で登録しました。";
                    Session::flash('update_msg',$update_msg);
                }
            }

            return "ok";
        }

    }

    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = UnpaidListHeaders::$page_no;
        return $Setting = TableSetting::setting($this->headers, $id, $pageNo);
    }

    public function tableSettingSave(Request $request, $id, $type = null)
    {
        $pageNo = UnpaidListHeaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '未入金一覧', $type);
    }
    
    public function clearBottomReqData($request_data){
        $headers = [
            '売上番号	' => 'datachar10',
            '売上区分	' => 'soufusakiname',
            '受注番号' => 'kokyakuorderbango',
            '受注先' => 'information1_detail',
            '受注件名' => 'juchukubun1_short',
            '最終顧客' => 'information3_detail',
            '担当' => 'user_name_search',
            '売上日' => 'v_intorder03',
            '入金予定日' => 'intorder05_input',
            '実入金日' => 'v_intorder05',
            '前受' => 'unsoutesuryou',
            '入金済' => 'req_dataint01',
            '売上金額' => 'unpaidlist_sales_amount',
            '入金額' => 'unpaidlist_sum_of_nyukingaku',
            '入金残' => 'unpaidlist_deposit_balance',
            '売上請求先' => 'information2_detail',
            '入金消込行番号' => 'max_moneymax',
            '入金消込番号' => 'max_old_shinkurokokyakuorderbango',
            '売掛残高更新フラグ' => 'req_soufusakiname',
            '請求残高更新フラグ' => 'req_soufusakiyubinbango',
        ];
        foreach($request_data as $key=>$val){
            if (in_array($key, $headers)){
                $request_data[$key] = null;
            }
        }
        return $request_data;
    }

}
