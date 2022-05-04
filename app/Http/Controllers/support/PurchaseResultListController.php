<?php

namespace App\Http\Controllers\support;
use App\AllClass\master\nameMaster\allCategorykanri;
use Illuminate\Http\Request;
use App\tantousya;
use App\kengen;
//use App\categorykanri;
use App\requestTable;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\support\purchaseResultList\AllPurchaseResultList;
use App\AllClass\support\purchaseResultList\purchaseResultListHeaders;
use App\AllClass\support\purchaseResultList\validatePurchaseResultList;
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

class PurchaseResultListController extends Controller
{
    private $headers = [
        'サポート番号行' => 'support_number',
        '受注先' => 'contractor',
        '最終顧客' => 'end_customer',
        '受注番号' => 'order_number',
        '売上日' => 'sales_date',
        '売' => 'sell',
        '外注予定' => 'formatted_schedule',
        '外注発注' => 'formatted_amount',
        '外注実績' => 'formatted_results',
        '完了指検' => 'inspection',
        '差異' => 'formatted_purchase_difference',
        '外注仕入完了日' => 'purchase_date',
        '外注仕入完了計算フラグ' => 'purchase_flag'
    ];


    public function postPurchaseResultList(Request $request)
    {
        $bango = request('userId');

        //check validation for first search
        if($request->ajax()){
            $validator = validatePurchaseResultList::validate($request,$bango);
            $errors = $validator->errors();
            if($errors->any()){
               $err_msg = $errors->all();
               return ['err_field'=>$errors,'err_msg'=>$err_msg];
            }else{
                return "ok";
            }
        }
        // dd($request->all());
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


        $headers = purchaseResultListHeaders::headers($bango);
        $table_headers = purchaseResultListHeaders::headers($bango, 'table_headers');
        $page_no = purchaseResultListHeaders::$page_no;
        $route = 'purchaseResultListTableSetting';
        $redirect_path = 'purchaseResultListReload';

        $temp_table = 'purchase_result_list_temp';

        //show page start here
        if (isset($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh')) {
            $fsRemoveKeys = ['page', 'Button', 'pagination', '_token', 'userId'];
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId','datachar05','division_datachar05_start','division_datachar05_end','department_datachar05_start','department_datachar05_end','group_datachar05_start','group_datachar05_end','purchaseDateFrom','purchaseDateTo','salesDateFrom','salesDateTo','payresd1',
                    'selected_inspection','up_support_number','prev_inspection','barcode','codename','tanka'];

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
                    // dd($data);

                    if($data_from_view['Button'] == 'FirstSearch'){
                        $fsReqData = $req_data; //fsReqData = first search request data
                    }
                    if(($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'refresh') && $defalut_check == 0){
                        $pagi = 20;
                        return view('support.purchaseResultList.mainPurchaseResultList', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'pagi', 'buttonMessage','B9Data_left','B9Data_right','C1Data_left','C1Data_right','C2Data_left','C2Data_right','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','datachar05'));
                    }

                    $query = AllPurchaseResultList::data($bango,$req_data)->toSql();
                    $purchaseResultListData = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    $purchaseResultListData2 = $this->searchDataFetch($query, $data, $bango, $temp_table);
                    if ($purchaseResultListData->items() == null && $purchaseResultListData->currentPage() != 1) {
                        $currentPage = ($purchaseResultListData->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $purchaseResultListData = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                        $purchaseResultListData2 = $this->searchDataFetch($query, $data, $bango, $temp_table);
                    }
                    if ($purchaseResultListData->total() == 0) {
                        $exceedUser = '該当するデータがありません。';
                    } else {
                        $exceedUser = '';
                    }

                    //export excel
                    if ($data_from_view['Button'] == 'xls') {
                        $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                        $headers = $this->headers;
                        $excelName = '外注仕入実績一覧.xlsx';
                        return $this->excelDownload($headers, $searched, $excelName);
                    }
                }
            } catch (\Exception $e) {
                $exceedUser = '検索形式が間違っています。';
                //$purchaseResultListData = QueryHelper::fetchResult($query);
                $purchaseResultListData = collect();
                $purchaseResultListData = $purchaseResultListData->paginate($pagination);
                return view('support.purchaseResultList.mainPurchaseResultList', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'purchaseResultListData', 'tantousya', 'exceedUser', 'buttonMessage','B9Data_left','B9Data_right','C1Data_left','C1Data_right','C2Data_left','C2Data_right','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','datachar05','fsReqData'));
            }
            $amount  = $purchaseResultListData2->sum('purchase_result_list_amount');
            $results  = $purchaseResultListData2->sum('purchase_result_list_results');
            $difference  = $purchaseResultListData2->sum('purchase_result_list_difference');
            return view('support.purchaseResultList.mainPurchaseResultList', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'purchaseResultListData', 'tantousya','exceedUser', 'buttonMessage','B9Data_left','B9Data_right','C1Data_left','C1Data_right','C2Data_left','C2Data_right','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','datachar05','req_data','fsReqData','amount','results','difference'));
        }
        
        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;
        session()->forget('oldInput' . $bango);
        return view('support.purchaseResultList.mainPurchaseResultList', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'pagi', 'buttonMessage','B9Data_left','B9Data_right','C1Data_left','C1Data_right','C2Data_left','C2Data_right','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','datachar05'));
    }

    // updatePurchaseResultList
    public function updatePurchaseResultList(Request $request){
        
        // dd($request->all());
        $bango = request('userId');
        $support_numbers = $request->up_support_number;
        $tanka = $request->tanka;
        $codename = $request->codename;
        $barcode = $request->barcode;
        $prev_inspection = $request->prev_inspection;
        $update_inspection = $request->selected_inspection;
        
        list($status, $errors) = $this->validator($request);
        // $errors = $validator->errors();
        if($status){
        //    $err_msg = $errors->all();
           return ['err_status'=>true,'errors'=>$errors];
        }else if(!$status && request('submit_confirmation') == ""){
            return "confirmation_msg";
        }else{
            foreach($support_numbers as $key=>$val){
                $prev = $prev_inspection[$key];
                $update = $update_inspection[$key];
                if($prev != $update){
                    $syouhinid = substr($val, 0, 10);
                    $syouhinsyu = substr($val, 10, 3);
                    $tanka_value = $tanka[$key];
                    $barcode_value = $barcode[$key];
                    $codename_value = $codename[$key];
                    if($prev==1 && $update==2){
                        $tanka_value = 2;
                        $barcode_value = $bango;
                        $codename_value = null;
                    }
                    else if($prev==2 && $update==1){
                        $tanka_value = 2;
                        $barcode_value = null;
                        $codename_value = null;
                    }
                    else if($prev==2 && $update==3){
                        $tanka_value = 2;
                        // $barcode_value = null;
                        $codename_value = $bango;
                    }
                    else if($prev==3 && $update==1){
                        $tanka_value = 2;
                        $barcode_value = null;
                        $codename_value = null;
                    }
                    else if($prev==3 && $update==2){
                        $tanka_value = 2;
                        // $barcode_value = null;
                        $codename_value = null;
                    }
                    else if($prev==3 && $update==4){
                        $tanka_value = 1;
                        // $barcode_value = null;
                        // $codename_value = null;
                    }else{
                        return "not_ok";
                    }

                    //update juchusyukko2 data
                    $juchusyukko2_update_data = [
                            'tanka' => $tanka_value,
                            'barcode' => $barcode_value,
                            'codename' => $codename_value,
                            'denpyoshimebi' => Carbon::now()->format('Y-m-d H:i:s'),
                            'tantousyabango' => $bango,
                        ];
                    // dd($juchusyukko2_update_data);
                    $juchusyukko2Update = QueryHelper::updateData('juchusyukko2', $juchusyukko2_update_data, ['syouhinid' => $syouhinid, 'syouhinsyu' => $syouhinsyu], $bango, __CLASS__, __FUNCTION__, __LINE__);

                    $update_msg = "登録しました";
                    Session::flash('success_msg',$update_msg);
                }
            }
            return "ok";
        }
    }


    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = purchaseResultListHeaders::$page_no;
        return $Setting = TableSetting::setting($this->headers, $id, $pageNo);
    }
    public function tableSettingSave(Request $request, $id, $bango, $type = null)
    {
        $pageNo = purchaseResultListHeaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '外注仕入実績一覧', $type);
    }
    public function clearBottomReqData($request_data){
        $headers = [
            'サポート番号行' => 'support_number',
            '受注先' => 'contractor',
            '最終顧客' => 'end_customer',
            '受注番号' => 'order_number',
            '売上日' => 'sales_date',
            '売' => 'sell',
            '外注予定' => 'purchase_Result_list_schedule',
            '外注発注' => 'purchase_Result_list_amounts',
            '外注実績' => 'purchase_Result_list_results',
            '完了指検' => 'inspection',
            '差異' => 'purchase_Result_list_difference',
            '外注仕入完了日' => 'purchase_date',
            '外注仕入完了計算フラグ' => 'purchase_flag'
        ];
        foreach($request_data as $key=>$val){
            if (in_array($key, $headers)){
                $request_data[$key] = null;
            }
        }
        return $request_data;
    }
    public function validator($data){
        $flags = $data->tanka;
        $status = false;
        foreach($flags as $key=>$val){
            if($val == 1){
                $flags[$key] = false;
                $status = true;
            }else{
                $flags[$key] = true;
            }
        }
        // dd($flags);
        return [$status, $flags];
    }
}