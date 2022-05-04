<?php

namespace App\Http\Controllers\sales;
use Illuminate\Http\Request;
use App\tantousya;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\sales\salesSlip\SalesSlipHeaders;
use App\AllClass\sales\salesSlip\ValidateSalesSlip;
use App\AllClass\sales\salesSlip\AllSalesSlip;
use App\AllClass\sales\salesSlip\AllVoucherCreation;
use App\AllClass\sales\salesSlip\PdfData;
use App\AllClass\sales\salesSlip\DownloadData;
use App\AllClass\order\orderEntry\searchCompany;
use App\AllClass\sales\salesSlip\salesCategoriFilter;
use App\AllClass\common\CreateOrderDetails;
use App\AllClass\ButtonMsg;
use Illuminate\Pagination\Paginator;
use App\AllClass\master\excelDownload;
use App\AllClass\TableSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Excel;
use PDF;
use ZipArchive;
use Mail;
use App\AllClass\sales\salesSlip\Mail\mailZip;
use App\AllClass\sales\salesSlip\Mail\mailPasswordsalesAccpt;
use App\AllClass\master\ExcelReportDownload;
use File;
use Carbon\Carbon;
use App\AllClass\master\CSVLogger;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use App\Helpers\Helper;

class SalesSlipController extends Controller
{
    private $headers = [
        '受注番号' => 'kokyakuorderbango',
        '受注件名' => 'juchukubun1',
        '受注先' => 'information1_detail',
        '売上請求先' => 'information2_detail',
        '最終顧客' => 'information3_detail',
        '担当' => 'user_name',
        '売上日' => 'intorder03',
        '受注金額' => 'formatted_money10',
        '売上伝票PDF' => 'text4',
        'tick_mark' => 'checkbox',
        '売上番号' => 'sales_slip_juchukubun2',
        '発行者' => 'hktsyukko_datachar05_detail',
        '郵送' => 'information2_mail_jyushin_mb',
        '印刷済' => 'hktsyukko_datachar10',
        'メール' => 'information2_mail_nouhin',
        'メール済' => 'hktsyukko_datachar09',
        '請求書送付先CD' => 'information6',
        '請求書送付先' => 'information6_detail',
    ];


    public function postSalesSlip(Request $request){

        $bango = request('userId');
        $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7501'");
        $review_orderbango = $reviewData->orderbango;

        //clear pdf creation session data
        session()->forget('generatedPdfCount');

        //convert half-width to full-width
        //$request['information1_detail_show'] = mb_convert_kana(request('information1_detail_show'),"RNASKHC");

        //check validation for first search
        if($request->ajax()){
            $validator = ValidateSalesSlip::validate($request,$bango);
            $errors = $validator->errors();
            if($errors->any()){
                $err_msg = $errors->all();
                return ['err_field'=>$errors,'err_msg'=>$err_msg];
            }else{
                return "ok";
            }
        }

        $data_from_view = $request->all();
        if(isset($data_from_view['selected_item'])){
            $selected_item = $data_from_view['selected_item'];
            session()->put("salisSlip_selected_item",$selected_item);
        }

        $data_from_view_session = $request->all();
        session()->put('oldInput' . $bango, $data_from_view);

        $tantousya = tantousya::find($bango);
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
        }else if (isset($data_from_view['division_datachar05_endReqVal'])) {
            $data003_right=substr($data_from_view['division_datachar05_endReqVal'], 2,4);
        }
        $data004=substr($tantousya->datatxt0004, 2,5);
        $data005=substr($tantousya->datatxt0005, 2,6);

        $personal_datatxt0003=QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'B9' ")->where("category2 = '$data003' ")->get()->first();
        $personal_datatxt0004=QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C1' ")->where("category2 = '$data004' ")->get()->first();
        $personal_datatxt0005=QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("category2 = '$data005' ")->get()->first();

        $buttonMessage = ButtonMsg::read($bango);

        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 50;
        }

        $default_content_setumei = $bango;
        $check_tan = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango'")->where("mail4 = 'C310'")->get()->execute();

        //get categorykanri data
        $B9Data_left = QueryHelper::fetchResult("select *,RIGHT(category2, 2) as category2_show from categorykanri where category1 = 'B9' and (suchi2 = 0 or suchi2 is null) and left(category2, 2) ='$review_orderbango' ORDER BY category2 ASC");
        $B9Data_right = QueryHelper::fetchResult("select *,RIGHT(category2, 2) as category2_show from categorykanri where category1 = 'B9' and (suchi2 = 0 or suchi2 is null) and left(category2, 2) ='$review_orderbango' ORDER BY category2 ASC");
        $C1Data_left = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C1' ")->where("category2 LIKE '%$data003_left%' ")->where("left(category2, 2) ='$review_orderbango'")->get()->execute();
        $C1Data_right = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("left(category2, 2) ='$review_orderbango'")->where("category1 = 'C1' ")->where("category2 LIKE '%$data003_right%' ")->get()->execute();
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

        if (isset($data_from_view['department_datachar05_start'])) {
            $data003_left=substr($data_from_view['department_datachar05_start'], 2,5);
        }
        if (isset($data_from_view['department_datachar05_end'])) {
            $data003_right=substr($data_from_view['department_datachar05_end'], 2,5);
        }

        $datachar02 = QueryHelper::fetchResult("select category1,category2,category4 from categorykanri where category1 = 'U1' and (suchi2 = 0 or suchi2 is null) and category2 NOT IN('23','70') ORDER BY category2 ASC");

        //get tantousya data
        $datachar05 = QueryHelper::fetchResult("select * from tantousya where deleteflag = 0 and ztanka='$review_orderbango' order by bango");

        if (!empty($data_from_view['chkboxinp'])) {
            $deleted_item = $data_from_view['chkboxinp'];
        } else {
            $deleted_item = 0;
        }

        $headers = SalesSlipHeaders::headers($bango);
        $table_headers = SalesSlipHeaders::headers($bango, 'table_headers');
        $page_no = SalesSlipHeaders::$page_no;
        $route = 'salesSlipTableSetting';
        $redirect_path = 'salesSlipReload';

        $temp_table = 'sales_slip_after_temp';

        //show page start here
        if (isset($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh')) {
            $fsRemoveKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp'];
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp','division_datachar05_start','division_datachar05_end','department_datachar05_start','department_datachar05_end','group_datachar05_start','group_datachar05_end','intorder03_start','intorder03_end','hktsyukko_datachar04','kokyakuorderbango_start','kokyakuorderbango_end','information1_text','information2_text','information3_text','selected_item'];
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

                    //remove number format comma
                    $str_to_int = ['money10'];
                    foreach ($data_from_view as $key => $value) {
                        if (in_array($key, $str_to_int)) {
                            $data_from_view[$key] = str_replace(',', '', $data_from_view[$key]);
                        }
                        //unset when hktsyukko_datachar04=3 to search all from datachar04
                        //if($key == 'hktsyukko_datachar04' && $value == 3){
                        //    unset($data_from_view[$key]);
                        //}
                    }

                    //$fs_req_data = $this->removeDataFromView($data_from_view, $fsRemoveKeys);
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);

                    //check first search or default search
                    //if($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort'){
                    //    $default_req_data = $default_data;
                    //}else{
                    //    $default_req_data = "";
                    //}

                    //first search req data
                    $fsReqData = [];
                    $bangos = [];

                    //foreach ($data as $key => $value) {
                    //    if (strpos($key, 'ReqVal') !== false) {
                    //        $fsReqData[str_replace('ReqVal', '', $key)] = $value;
                    //        unset($data[$key]);
                    //    }
                    //}
                    
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
                    
                    //filter $fs_req_data
                    //foreach ($fs_req_data as $key => $value) {
                    //    if (strpos($key, 'ReqVal') !== false) {
                    //        $fs_req_data[str_replace('ReqVal', '', $key)] = $value;
                    //        unset($fs_req_data[$key]);
                    //    }else{
                    //        $fs_req_data[$key] = $value;
                    //    }
                    //}

                    if($data_from_view['Button'] == 'FirstSearch'){
                        $fsReqData = $req_data; //fsReqData = first search request data
                    }
                    
                    //to search full text
                    if(isset($data['user_name_search'])){
                        $data['user_name_search'] = str_replace('　','',str_replace(' ','',$data['user_name_search']));
                    }
                    if(isset($data['hktsyukko_datachar05_detail_search'])){
                        $data['hktsyukko_datachar05_detail_search'] = str_replace('　','',str_replace(' ','',$data['hktsyukko_datachar05_detail_search']));
                    }

                    //first search bangos
                    //$first_search_res = "";
                    //if(!empty($fsReqData)){
                    //    $search_removeKeys = ['division_datachar05_start','division_datachar05_end','department_datachar05_start','department_datachar05_end','group_datachar05_start','group_datachar05_end','intorder03_start','intorder03_end','kokyakuorderbango_start','kokyakuorderbango_end','information1_text','information2_text','information3_text','selected_item'];
                    //    $reqData = $this->removeDataFromView($fsReqData, $search_removeKeys);

                    //    $query = AllSalesSlip::data($bango, $deleted_item,$bangos,$fsReqData)->toSql();

                    //    $salesSlipInfo = $this->searchDataFetch($query, $reqData, $bango, $temp_table);

                    //    foreach($salesSlipInfo as $key=>$val){
                    //        foreach($val as $k=>$v){
                    //            if($k=="bango"){
                    //                array_push($bangos,$v);
                    //            }
                    //        }
                    //    }
                    //    if(count($bangos)<1){
                    //        $first_search_res = "no_data";
                    //    }
                    //}else if(($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'refresh') && empty($fsReqData)){
                    //    $pagi = 50;
                    //    return view('sales.salesSlip.mainSalesSlip', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'pagi', 'deleted_item', 'buttonMessage','B9Data_left','C1Data_left','C2Data_left','B9Data_right','C1Data_right','C2Data_right','datachar02','datachar05','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','data_from_view'));
                    //}
                    
                    if(($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'refresh') && $defalut_check == 0){
                        $pagi = 20;
                        return view('sales.salesSlip.mainSalesSlip', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'pagi', 'deleted_item', 'buttonMessage','B9Data_left','C1Data_left','C2Data_left','B9Data_right','C1Data_right','C2Data_right','datachar02','datachar05','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','data_from_view'));
                    }

                    $query = AllSalesSlip::data($bango, $deleted_item, $req_data)->toSql();
                    $salesSlipInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    if ($salesSlipInfo->items() == null && $salesSlipInfo->currentPage() != 1) {
                        $currentPage = ($salesSlipInfo->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $salesSlipInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    }

                    if ($salesSlipInfo->total() == 0) {
                        $exceedUser = '該当するデータがありません。';
                    } else {
                        $exceedUser = '';
                    }

                    //if($data_from_view['Button'] == 'FirstSearch'){
                    //    $fsReqData = $fs_req_data; //fsReqData=first search request data
                    //}

                    //export excel
                    if ($data_from_view['Button'] == 'xls') {

                        $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                        $headers = $this->headers;
                        unset($headers['tick_mark']);
                        $excelName = '売上伝票発行.xlsx';
                        return $this->excelDownload($headers, $searched, $excelName);
                    }

                }
            } catch (\Exception $e) {
                //dd($e);
                $exceedUser = '検索形式が間違っています。';
                $order_amount = "";
                $gross_profit = "";
                $pagi = 50;
                return view('sales.salesSlip.mainSalesSlip', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'pagi', 'deleted_item','exceedUser', 'buttonMessage','B9Data_left','C1Data_left','C2Data_left','B9Data_right','C1Data_right','C2Data_right','datachar02','datachar05','fsReqData','order_amount','gross_profit','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','data_from_view'));
            }

            $order_amount  = $salesSlipInfo->sum('money10');
            $gross_profit  = $salesSlipInfo->sum('moneymax');
            return view('sales.salesSlip.mainSalesSlip', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'salesSlipInfo', 'tantousya', 'deleted_item','exceedUser', 'buttonMessage','B9Data_left','C1Data_left','C2Data_left','B9Data_right','C1Data_right','C2Data_right','datachar02','datachar05','fsReqData','order_amount','gross_profit','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','data_from_view','req_data'));
        }

        $pagi = 50;
        session()->forget('oldInput' . $bango);
        session()->forget('salisSlip_selected_item');
        return view('sales.salesSlip.mainSalesSlip', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'pagi', 'deleted_item', 'buttonMessage','B9Data_left','C1Data_left','C2Data_left','B9Data_right','C1Data_right','C2Data_right','datachar02','datachar05','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','data_from_view'));
    }


    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = SalesSlipHeaders::$page_no;
        return $Setting = TableSetting::setting($this->headers, $id, $pageNo);

    }

    public function tableSettingSave(Request $request, $id, $type = null)
    {
        $pageNo = SalesSlipHeaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '売上伝票発行', $type);
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

    public static function filterCategory(Request $request)
    {

        $var=salesCategoriFilter::filter($request->all());

        return json_encode($var);
    }


    public function voucherCreation(Request $request){
        $bango = request('userId');
        $selected_item = $request->selected_item;
        $count_no_of_generated_pdf = 0;
        session()->put("salisSlip_selected_item",$selected_item);
        /*if ($bango='8003') {

          self::sendMail($request,1);
        }*/
        foreach($selected_item as $key=>$kokyakuorderbango){
            $orderhenkanInfo = QueryHelper::fetchSingleResult("select * from orderhenkan where kokyakuorderbango = '$kokyakuorderbango' AND datachar10 IS NULL order by bango desc");
            if($orderhenkanInfo){
                $orderhenkan_bango = $orderhenkanInfo->bango;
                $intorder03 = $orderhenkanInfo->intorder03;
            }else{
                $orderhenkan_bango = "";
                $intorder03 = "";
            }

            $hikiatesyukkoInfo = QueryHelper::fetchSingleResult("select substring(datachar04,1,1) as datachar04 from hikiatesyukko where orderbango = '$orderhenkan_bango'");

            //get end key
            $end_kokyakuorderbango = $selected_item[array_key_last($selected_item)];
            $end_key_status = self::getEndKeyStatus($end_kokyakuorderbango);
            $end_key = -10;
            if($end_key_status == 1){
                $end_key = array_key_last($selected_item)-1;
            }

            //date check
            $reviewDt = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7503'");
            if ($reviewDt) {
                $temp_orderbango = $reviewDt->orderbango;
            } else {
                $temp_orderbango = "";
            }

            if($orderhenkanInfo && ($hikiatesyukkoInfo && $hikiatesyukkoInfo->datachar04 != 1) && ($intorder03 > $temp_orderbango)){
                $count_no_of_generated_pdf++;
                //start log query
                $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 売上伝票発行 start\n";
                QueryHandler::logger($bango,$log_data);

                $conn = pg_connect("host=".env("DB_HOST")." port=".env("DB_PORT")."  dbname=".env("DB_DATABASE")." user=".env("DB_USERNAME")." password=".env("DB_PASSWORD"));
                pg_query($conn,"BEGIN");
                try{
                    //check orderbango
                    $reviewData1 = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7051'");
                    if ($reviewData1) {
                        $orderbango = $reviewData1->orderbango + 1;
                        $mobile_flag = $reviewData1->mobile_flag;
                    } else {
                        $orderbango = "";
                        $mobile_flag = "";
                    }

                    $reviewData2 = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7501'");
                    if ($reviewData2) {
                        $orderbango2 = $reviewData2->orderbango;
                    } else {
                        $orderbango2 = "";
                    }
                    $modified_orderbango = "09" . $orderbango2 . str_pad($orderbango, $mobile_flag, '0', STR_PAD_LEFT);

                    $orderhenkan_insert_data = [
                        'kokyakubango' => $orderhenkanInfo->kokyakubango,
                        'kokyakuorderbango' => $orderhenkanInfo->kokyakuorderbango,
                        //'orderuserbango' => $orderhenkanInfo->orderuserbango,
                        'orderuserbango' => $bango,
                        'date' => Carbon::now()->format('Y-m-d H:i:s'),
                        'ordertypebango' => $orderhenkanInfo->ordertypebango,
                        'synchroorderbango' => $orderhenkanInfo->synchroorderbango,
                        'synchroorderbango2' => $orderhenkanInfo->synchroorderbango2,
                        'datachar01' => 1,
                        'datachar02' => $orderhenkanInfo->datachar02,
                        'deletedate' => $orderhenkanInfo->deletedate,
                        'datachar03' => $orderhenkanInfo->datachar03,
                        'datachar04' => $orderhenkanInfo->datachar04,
                        'datachar05' => $orderhenkanInfo->datachar05,
                        'datachar06' => $orderhenkanInfo->datachar06,
                        'datachar07' => $orderhenkanInfo->datachar07,
                        'ordertypebango2' => 0,
                        'datachar08' => $orderhenkanInfo->datachar08,
                        'datachar09' => $orderhenkanInfo->datachar09,
                        'datachar10' => $modified_orderbango,
                        'datachar11' => $orderhenkanInfo->datachar11,
                        'datachar12' => $orderhenkanInfo->datachar12,
                        'datachar13' => $orderhenkanInfo->datachar13,
                        'datachar14' => $orderhenkanInfo->datachar14,
                        'datachar15' => $orderhenkanInfo->datachar15,
                        'intorder01' => $orderhenkanInfo->intorder01,
                        'intorder02' => $orderhenkanInfo->intorder02,
                        'intorder03' => $orderhenkanInfo->intorder03,
                        'intorder04' => $orderhenkanInfo->intorder04,
                        'intorder05' => $orderhenkanInfo->intorder05,
                    ];

                    $orderhenkan = QueryHelper::insertData('orderhenkan',$orderhenkan_insert_data,'bango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                    if($orderhenkan){
                        $tuhanorderInfo = QueryHelper::fetchSingleResult("select * from tuhanorder where orderbango = '$orderhenkan_bango' AND juchubango = '$orderhenkanInfo->kokyakuorderbango' ");
                        $info2 = $tuhanorderInfo->information2;

                        $kokyakuCode = substr($info2, 0,6);
                        $haisouCode = substr($info2, 6,2);
                        $kokyaku = QueryHelper::select(['*'])->from('kokyaku1')->where("yobi12 = '$kokyakuCode' ")->get()->first();

                        if($tuhanorderInfo->housoukubun == 1){
                            $text3 = self::generateInvoiceNumber($bango);
                            $dataint08 = 1;
                            $dataint09 = 1;
                        }else{
                            $text3 = null;
                            $dataint08 = 2;
                            $dataint09 = 2;
                        }

                        $tuhanorder_insert_data = [
                            'orderbango' => $orderhenkan->bango,
                            'juchubango' => $tuhanorderInfo->juchubango,
                            'chumonbango' => $tuhanorderInfo->chumonbango,
                            'juchukubun1' => $tuhanorderInfo->juchukubun1,
                            'juchukubun2' => $modified_orderbango,
                            'datatxt0130' => $modified_orderbango,
                            'chumondate' => $tuhanorderInfo->chumondate,
                            'otodokedate' => $tuhanorderInfo->otodokedate,
                            'otodoketime' => $tuhanorderInfo->otodoketime,
                            'chumonsyabango' => $tuhanorderInfo->chumonsyabango,
                            'soufusakibango' => $tuhanorderInfo->soufusakibango,
                            'kessaihouhou' => $tuhanorderInfo->kessaihouhou,
                            'housoukubun' => $tuhanorderInfo->housoukubun,
                            'chumonsyajouhou' => $tuhanorderInfo->chumonsyajouhou,
                            'soufusakijouhou' => $tuhanorderInfo->soufusakijouhou,
                            'numeric1' => $tuhanorderInfo->numeric1,
                            'numeric2' => $tuhanorderInfo->numeric2,
                            'numeric3' => $tuhanorderInfo->money10,
                            'numeric4' => null,
                            'numeric5' => $tuhanorderInfo->numeric5,
                            'numericmax' => $tuhanorderInfo->numericmax,
                            'money1' => $tuhanorderInfo->money1,
                            'money2' => $tuhanorderInfo->money2,
                            'money3' => $tuhanorderInfo->money3,
                            'money4' => $tuhanorderInfo->money4,
                            'money5' => $tuhanorderInfo->money5,
                            'moneymax' => $tuhanorderInfo->moneymax,
                            'information1' => $tuhanorderInfo->information1,
                            'information2' => $tuhanorderInfo->information2,
                            'information3' => $tuhanorderInfo->information3,
                            'information4' => $tuhanorderInfo->information4,
                            'information5' => $tuhanorderInfo->information5,
                            'nyukingaku' => $tuhanorderInfo->nyukingaku,
                            'unsoudaibikitesuryou' => 1,
                            //'unsoutesuryou' => $tuhanorderInfo->unsoutesuryou,
                            'unsoutesuryou' => 1,
                            'unsouinchigaku' => $tuhanorderInfo->unsouinchigaku,
                            'unsousplittesuryou' => $tuhanorderInfo->unsousplittesuryou,
                            'youbou' => $tuhanorderInfo->youbou,
                            'affbango' => $tuhanorderInfo->affbango,
                            'syukei1' => $tuhanorderInfo->syukei1,
                            'syukei2' => $tuhanorderInfo->syukei2,
                            'syukei3' => $tuhanorderInfo->syukei3,
                            'syukei4' => $tuhanorderInfo->syukei4,
                            'syukei5' => $tuhanorderInfo->syukei5,
                            'text1' => 'U5'.substr($orderhenkan->datachar02,2),
                            'text2' => $orderhenkan->datachar05,
                            'text3' => $text3,
                            'text4' => $tuhanorderInfo->text4,
                            'text5' => $tuhanorderInfo->text5,
                            'numeric6' => $tuhanorderInfo->numeric6,
                            'numeric7' => $tuhanorderInfo->numeric7,
                            'numeric8' => $tuhanorderInfo->numeric8,
                            'numeric9' => $tuhanorderInfo->numeric9,
                            'numeric10' => $tuhanorderInfo->numeric10,
                            'money6' => $tuhanorderInfo->money6,
                            'money7' => $tuhanorderInfo->money7,
                            'money8' => $tuhanorderInfo->money8,
                            'money9' => $tuhanorderInfo->money9,
                            'money10' => $tuhanorderInfo->money10,
                            'information6' => $tuhanorderInfo->information6,
                            'information7' => $tuhanorderInfo->information7,
                            'information8' => $tuhanorderInfo->information8,
                            'information9' => $tuhanorderInfo->information9,
                            'information10' => $tuhanorderInfo->information10,
                        ];
                        $tuhanorder = QueryHelper::insertData('tuhanorder',$tuhanorder_insert_data,'orderbango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                        if($tuhanorder){
                            //get tax rate,update tuhanorder.numeric4
                            //$numeric4 = self::calculateTaxRate($info2,$tuhanorder->money10,$tuhanorderInfo->otodoketime,$modified_orderbango,$bango);
                            $numeric4 = self::calculateTaxRate($info2,$tuhanorder->money10,$tuhanorderInfo->otodoketime,$tuhanorderInfo->juchubango,$bango);
                            if($numeric4 != null){
                                $tuhanorder_update_data = [
                                    'juchukubun2' => $modified_orderbango,
                                    'numeric4' => $numeric4,
                                ];
                                $tuhanorderUpdate = QueryHelper::updateData('tuhanorder', $tuhanorder_update_data, 'juchukubun2', $bango, __CLASS__, __FUNCTION__, __LINE__);
                            }

                            $hikiatesyukkoInfo = QueryHelper::fetchSingleResult("select * from hikiatesyukko where syouhinid = '$orderhenkanInfo->kokyakuorderbango'");
                            //hikiatesyukko insert start here
                            $hikiatesyukko_insert_data = [
                                'orderbango' => $orderhenkan->bango,
                                'syouhinbango' => $hikiatesyukkoInfo->syouhinbango,
                                'yoteisu' => $hikiatesyukkoInfo->yoteisu,
                                'yoteibi' => $hikiatesyukkoInfo->yoteibi,
                                'syukkasu' => $hikiatesyukkoInfo->syukkasu,
                                'kanryoubi' => $hikiatesyukkoInfo->kanryoubi,
                                'kanryoubi' => $hikiatesyukkoInfo->kingaku,
                                'genka' => $hikiatesyukkoInfo->genka,
                                'syouhizeiritu' => $hikiatesyukkoInfo->syouhizeiritu,
                                'soukobango' => $hikiatesyukkoInfo->soukobango,
                                'syukkomotobango' => $hikiatesyukkoInfo->syukkomotobango,
                                'syukkosakibango' => $hikiatesyukkoInfo->syukkosakibango,
                                'syukkosoukobango' => $hikiatesyukkoInfo->syukkosoukobango,
                                'tanabango' => static::getCurrentTime(),
                                'tantousyabango' => $bango,
                                'seikyubango' => $hikiatesyukkoInfo->seikyubango,
                                'denpyobango' => $hikiatesyukkoInfo->denpyobango,
                                'denpyohakkoubi' => $hikiatesyukkoInfo->denpyohakkoubi,
                                'season' => $hikiatesyukkoInfo->season,
                                'nengetsu' => $hikiatesyukkoInfo->nengetsu,
                                'weeks' => $hikiatesyukkoInfo->weeks,
                                'day' => $hikiatesyukkoInfo->day,
                                'tanka' => $hikiatesyukkoInfo->tanka,
                                'zaiko' => $hikiatesyukkoInfo->zaiko,
                                'idoutanabango' => null,
                                'yoteimeter' => 0,
                                'syukkameter' => $hikiatesyukkoInfo->syukkameter,
                                'zaikometer' => $hikiatesyukkoInfo->zaikometer,
                                'barcode' => $hikiatesyukkoInfo->barcode,
                                'codename' => $hikiatesyukkoInfo->codename,
                                'denpyoshimebi' => $hikiatesyukkoInfo->denpyoshimebi,
                                'kawaserate' => $hikiatesyukkoInfo->kawaserate,
                                'kawasename' => $hikiatesyukkoInfo->kawasename,
                                'syouhizeikubun' => $hikiatesyukkoInfo->syouhizeikubun,
                                'yoyakubi' => $hikiatesyukkoInfo->yoyakubi,
                                'syouhinname' => $hikiatesyukkoInfo->syouhinname,
                                'kaiinid' => $modified_orderbango,
                                'syouhinid' => $orderhenkanInfo->kokyakuorderbango,
                                'syouhinsyu' => $hikiatesyukkoInfo->syouhinsyu,
                                'hantei' => $hikiatesyukkoInfo->hantei,
                                'dataint01' => 2,
                                'dataint02' => $tuhanorder->text3 == null?2:1,
                                'dataint03' => 2,
                                'dataint04' => 1,
                                'dataint05' => 2,
                                'datachar01' => $hikiatesyukkoInfo->datachar01,
                                'datachar02' => $hikiatesyukkoInfo->datachar02,
                                'datachar03' => $hikiatesyukkoInfo->datachar03,
                                'datachar04' => 1,
                                'datachar05' => $bango,
                                'recordnumber' => $hikiatesyukkoInfo->recordnumber,
                                'dataint06' => 1,
                                'dataint07' => 2,
                                //'dataint08' => 2,
                                'dataint08' => $dataint08,
                                //'dataint09' => 2,
                                'dataint09' => $dataint09,
                                'dataint10' => $hikiatesyukkoInfo->dataint10,
                                'datachar06' => $hikiatesyukkoInfo->datachar06,
                                'datachar07' => $hikiatesyukkoInfo->datachar07,
                                'datachar08' => $hikiatesyukkoInfo->datachar08,
                                //'datachar09' => 1,
                                'datachar09' => $hikiatesyukkoInfo->datachar09,
                                'datachar10' => $hikiatesyukkoInfo->datachar10,
                                'tankano' => $hikiatesyukkoInfo->tankano,
                                'syouhinbukacd' => $hikiatesyukkoInfo->syouhinbukacd,
                                'hanbaibukacd' => $hikiatesyukkoInfo->hanbaibukacd,
                                'dataint11' => $hikiatesyukkoInfo->dataint11,
                                'dataint12' => $hikiatesyukkoInfo->dataint12,
                                'dataint13' => $hikiatesyukkoInfo->dataint13,
                                'dataint14' => $hikiatesyukkoInfo->dataint14,
                                'dataint15' => $hikiatesyukkoInfo->dataint15,
                                'datachar11' => null,
                                'datachar12' => $tuhanorder->text3 == null?null:$bango,
                                'datachar13' => null,
                                'datachar14' => null,
                                'datachar15' => null,
                                'dataint16' => $hikiatesyukkoInfo->dataint16,
                                'dataint17' => $hikiatesyukkoInfo->dataint17,
                                'dataint18' => $hikiatesyukkoInfo->dataint18,
                                'dataint19' => $hikiatesyukkoInfo->dataint19,
                                'dataint20' => $hikiatesyukkoInfo->dataint20,
                                'datachar16' => $hikiatesyukkoInfo->datachar16,
                                'datachar17' => $hikiatesyukkoInfo->datachar17,
                                'datachar18' => $hikiatesyukkoInfo->datachar18,
                                'datachar19' => $hikiatesyukkoInfo->datachar19,
                                'datachar20' => $hikiatesyukkoInfo->datachar20,
                                'dataint21' => $hikiatesyukkoInfo->dataint21,
                                'dataint22' => $hikiatesyukkoInfo->dataint22,
                                'dataint23' => $hikiatesyukkoInfo->dataint23,
                                'dataint24' => $hikiatesyukkoInfo->dataint24,
                                'dataint25' => $hikiatesyukkoInfo->dataint25,
                                'dataint26' => $hikiatesyukkoInfo->dataint26,
                                'dataint27' => $hikiatesyukkoInfo->dataint27,
                                'dataint28' => $hikiatesyukkoInfo->dataint28,
                                'dataint29' => $hikiatesyukkoInfo->dataint29,
                                'dataint30' => $hikiatesyukkoInfo->dataint30,
                                'datachar21' => $hikiatesyukkoInfo->datachar21,
                                'datachar22' => $hikiatesyukkoInfo->datachar22,
                                'datachar23' => $hikiatesyukkoInfo->datachar23,
                                'datachar24' => $hikiatesyukkoInfo->datachar24,
                                'datachar25' => $hikiatesyukkoInfo->datachar25,
                                'datachar26' => $hikiatesyukkoInfo->datachar26,
                                'datachar27' => $hikiatesyukkoInfo->datachar27,
                                'datachar28' => $hikiatesyukkoInfo->datachar28,
                                'datachar29' => $hikiatesyukkoInfo->datachar29,
                                'datachar30' => $hikiatesyukkoInfo->datachar30,
                            ];
                            $hikiatesyukko_insert = QueryHelper::insertData('hikiatesyukko',$hikiatesyukko_insert_data,'orderbango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);

                            //hikiatesyukko update start here
                            $hikiatesyukko_update_data = [
                                'orderbango' => $orderhenkanInfo->bango,
                                'syouhinid' => $orderhenkanInfo->kokyakuorderbango,
                                //'datachar09' => 1,
                                'idoutanabango' => static::getCurrentTime(),
                                //'tantousyabango' => $bango,
                                'datachar04' => 1,
                                'datachar05' => $bango
                            ];

                            $hikiatesyukko = QueryHelper::updateData('hikiatesyukko', $hikiatesyukko_update_data, ['orderbango' => $orderhenkanInfo->bango,'syouhinid'=>$orderhenkanInfo->kokyakuorderbango], true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                            if($hikiatesyukko){
                                $misyukkoInfo = QueryHelper::fetchResult("select * from misyukko where syouhinid = '$orderhenkanInfo->kokyakuorderbango' ");
                                $total_count = count($misyukkoInfo);
                                $temp_count = 1;
                                foreach($misyukkoInfo as $k => $val){
                                    //check end data
                                    if($total_count == $temp_count){
                                       $count_status = 'end';
                                    }else {
                                        $count_status = '';
                                    }
                                    $temp_count++;

                                    if($val->yoteimeter != 2){

                                    $otodoketime = $tuhanorderInfo->otodoketime;
                                    $datachar20 = self::calculateTaxRateForAdjustment($info2,$tuhanorder->money10,$otodoketime,$modified_orderbango,$bango,$val->syukkasu,$val->dataint04,$orderhenkanInfo->kokyakuorderbango,$count_status,$numeric4,$val->syouhinsyu);
                                    $syukkoold_insert_data = [
                                        'orderbango' => $orderhenkan->bango,
                                        'syouhinbango' => $val->syouhinbango,
                                        'yoteisu' => $val->yoteisu,
                                        'yoteibi' => $val->yoteibi,
                                        'syukkasu' => $val->syukkasu,
                                        'kanryoubi' => $val->kanryoubi,
                                        'kingaku' => $val->kingaku,
                                        'genka' => $val->genka,
                                        'syouhizeiritu' => $val->syouhizeiritu,
                                        'soukobango' => $val->soukobango,
                                        'syukkomotobango' => $val->syukkomotobango,
                                        'syukkosakibango' => $val->syukkosakibango,
                                        'syukkosoukobango' => $val->syukkosoukobango,
                                        'tanabango' => static::getCurrentTime(),
                                        'tantousyabango' => $bango,
                                        'seikyubango' => $val->seikyubango,
                                        'denpyobango' => $val->denpyobango,
                                        'denpyohakkoubi' => $val->denpyohakkoubi,
                                        'season' => $val->season,
                                        'nengetsu' => $val->nengetsu,
                                        'weeks' => $val->weeks,
                                        'day' => $val->day,
                                        'tanka' => $val->tanka,
                                        'zaiko' => $val->zaiko,
                                        'idoutanabango' => $val->idoutanabango,
                                        'yoteimeter' => $val->yoteimeter,
                                        'syukkameter' => $val->syukkameter,
                                        'zaikometer' => $val->zaikometer,
                                        'barcode' => $val->barcode,
                                        'codename' => $val->codename,
                                        'denpyoshimebi' => $val->denpyoshimebi,
                                        'kawaserate' => $val->kawaserate,
                                        'kawasename' => $val->kawasename,
                                        'syouhizeikubun' => $val->syouhizeikubun,
                                        'yoyakubi' => $val->yoyakubi,
                                        'syouhinname' => $val->syouhinname,
                                        'kaiinid' => $modified_orderbango,
                                        'syouhinid' => $val->syouhinid,
                                        'syouhinsyu' => $val->syouhinsyu,
                                        'hantei' => $val->hantei,
                                        'dataint01' => $val->dataint01,
                                        'dataint02' => $val->dataint02,
                                        'dataint03' => $val->dataint03,
                                        'datachar01' => $val->datachar01,
                                        'datachar02' => $val->datachar02,
                                        'datachar03' => $val->datachar03,
                                        'recordnumber' => $val->recordnumber,
                                        'dataint04' => $val->dataint04,
                                        'dataint05' => $val->dataint05,
                                        'datachar04' => $val->datachar04,
                                        'datachar05' => $val->datachar05,
                                        'dataint06' => $val->dataint06,
                                        'dataint07' => $val->dataint07,
                                        'dataint08' => $val->dataint08,
                                        'dataint09' => $val->dataint09,
                                        'dataint10' => $val->dataint10,
                                        'datachar06' => $val->datachar06,
                                        'datachar07' => $val->datachar07,
                                        'datachar08' => $val->datachar08,
                                        'datachar09' => $val->datachar09,
                                        'datachar10' => $val->datachar10,
                                        'tankano' => $val->tankano,
                                        'syouhinbukacd' => $val->syouhinbukacd,
                                        'hanbaibukacd' => $val->hanbaibukacd,
                                        'dataint11' => $val->dataint11,
                                        'dataint12' => $val->dataint12,
                                        'dataint13' => $val->dataint13,
                                        'dataint14' => $val->dataint14,
                                        'dataint15' => $val->dataint15,
                                        'datachar11' => $val->datachar11,
                                        'datachar12' => $val->datachar12,
                                        'datachar13' => $val->datachar13,
                                        'datachar14' => $val->datachar14,
                                        'datachar15' => $val->datachar15,
                                        'dataint16' => $val->dataint16,
                                        'dataint17' => $val->dataint17,
                                        'dataint18' => $val->dataint18,
                                        'dataint19' => $val->dataint19,
                                        'dataint20' => $val->dataint20,
                                        'datachar16' => $val->datachar16,
                                        'datachar17' => $val->datachar17,
                                        'datachar18' => $val->datachar18,
                                        'datachar19' => $val->syukkasu*$val->dataint04,
                                        'datachar20' => $datachar20,
                                        'dataint21' => $val->dataint21,
                                        'dataint22' => $val->dataint22,
                                        'dataint23' => $val->dataint23,
                                        'dataint24' => $val->dataint24,
                                        'dataint25' => $val->dataint25,
                                        'dataint26' => $val->dataint26,
                                        'dataint27' => $val->dataint27,
                                        'dataint28' => $val->dataint28,
                                        'dataint29' => $val->dataint29,
                                        'dataint30' => $val->dataint30,
                                        'datachar21' => $val->datachar21,
                                        'datachar22' => $val->datachar22,
                                        'datachar23' => $val->datachar23,
                                        'datachar24' => $val->datachar24,
                                        'datachar25' => $val->datachar25,
                                        'datachar26' => $val->datachar26,
                                        'datachar27' => $val->datachar27,
                                        'datachar28' => $val->datachar28,
                                        'datachar29' => $val->datachar29,
                                    ];
                                    $syukkoold = QueryHelper::insertData('syukkoold',$syukkoold_insert_data,'orderbango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);

                                    //update juchusyukko data
                                    $soukosyukkoData = QueryHelper::fetchSingleResult("select hanbaibukacd,syouhinbango,yoteisu from soukosyukko where syouhinid = '$val->syouhinid' AND syouhinsyu = '$val->syouhinsyu' AND hantei = '$val->hantei' ");
                                    if($soukosyukkoData){
                                    $juchusyukko_update_data = [
                                        'hanbaibukacd'=>$soukosyukkoData->hanbaibukacd,
                                        'dataint18'=>$soukosyukkoData->syouhinbango,
                                        'dataint19'=>$soukosyukkoData->yoteisu,
                                        'datachar25'=> 1,
                                    ];
                                    QueryHelper::updateData('juchusyukko', $juchusyukko_update_data, ['hanbaibukacd'=>$soukosyukkoData->hanbaibukacd,'dataint18'=>$soukosyukkoData->syouhinbango,'dataint19'=>$soukosyukkoData->yoteisu], $bango, __CLASS__, __FUNCTION__, __LINE__);
                                    }

                                    }

                                }

                                $syukkooldInfo = QueryHelper::fetchSingleResult("select syouhinid,dataint02,datachar20 from syukkoold where syouhinid = '$orderhenkanInfo->kokyakuorderbango' order by dataint02 desc ");

                                //update syukkoold data
                                self::updateSyukkooldData($info2,$tuhanorder->numeric3,$tuhanorderInfo->otodoketime,$modified_orderbango,$bango,$syukkooldInfo,$numeric4);

                                //update juchusyukko data
                                //$juchusyukko_update_data = [
                                //    'orderbango'=>$tuhanorderInfo->orderbango,
                                //    'datachar25'=> 1,
                                //];
                                //QueryHelper::updateData('juchusyukko', $juchusyukko_update_data, ['orderbango'=>$tuhanorderInfo->orderbango], $bango, __CLASS__, __FUNCTION__, __LINE__);

                                //update review data
                                $review_update_data = [
                                    'kokyakusyouhinbango' => 'D7051',
                                    'orderbango' => $orderbango,
                                    'check_flag' => 0,
                                    'color' => static::getCurrentTime(),
                                    'size' => Helper::getSystemIP(),
                                    'nickname' => $bango,
                                ];
                                $reviewUpdate = QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                            }
                        }

                        $deleted_item = 0;
                        $kokyakuorderbango = $orderhenkan->kokyakuorderbango;

                        $query = PdfData::data($bango, $deleted_item,$kokyakuorderbango)->toSql();
                        $voucherData = QueryHelper::fetchResult($query);
                        $voucherData = collect($voucherData);

                        //pdf create start here
                        $pdf = PDF::loadView('sales.salesSlip.voucherCreation.pdf',['data'=>$voucherData]);

                        if (!file_exists('pdf/salesSlip')) {
                            mkdir('pdf/salesSlip', 0777, true);
                        }
                        $pdf_name = $voucherData[0]->juchukubun2."_".$voucherData[0]->information2_short."_".$voucherData[0]->company_address."_".$voucherData[0]->office_haisoumoji1."_uri.pdf";
                        $destination = public_path('pdf/salesSlip/'.$pdf_name);

                        file_put_contents($destination, $pdf->output());
                        //pdf create end here

                        //update tuhanorder data
                        $tuhanorder_update_data = [
                            'orderbango' => $tuhanorder->orderbango,
                            'text4' => $pdf_name,
                        ];
                        $tuhanorderUpdate = QueryHelper::updateData('tuhanorder', $tuhanorder_update_data, 'orderbango', $bango, __CLASS__, __FUNCTION__, __LINE__);

                        //update parent & child data
                        $tuhanorder_update_data2 = [
                            'datatxt0109' => $tuhanorder->juchubango,
                            'datatxt0130' => $modified_orderbango,
                        ];
                        $tuhanorderUpdate = QueryHelper::updateData('tuhanorder', $tuhanorder_update_data2, 'datatxt0109', $bango, __CLASS__, __FUNCTION__, __LINE__,'','juchukubun2 IS NOT NULL',1);

                    }

                    //create history details => CreateOrderDetails::data($bango,$kokyakuorderbango, $ordertypebango2,$datachar01)
                    $tmp_kokyakuorderbango = $orderhenkanInfo->kokyakuorderbango;
                    CreateOrderDetails::data($bango,$tmp_kokyakuorderbango, 0,1,'04-03','sales_data',$modified_orderbango);

                    //end log query
                    $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 売上伝票発行 end\n";
                    QueryHandler::logger($bango,$log_data);

                    session()->put('tempPdfCount', 1);
                    pg_query($conn, "COMMIT");

                } catch (\Exception $e) {
                    $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                    QueryHandler::logger($bango, $log_data);

                    pg_query($conn,"ROLLBACK");
                }

                if (($key == array_key_last($selected_item)) || ($end_key == $key)) {
                    //send mail

                    self::sendMail($request,1);

                    if(session()->has('generatedPdfCount')){
                        $generatedPdfCount = session()->get('generatedPdfCount');
                        $generatedPdfCount = $generatedPdfCount + 1;
                        //session()->forget('generatedPdfCount');
                        $count = count($selected_item);
                        $pdf_msg[] = $generatedPdfCount.'/'.$count." PDFを作成しました。";
                    }else{
                        //session()->forget('generatedPdfCount');
                        if(session()->has('tempPdfCount')){
                            $pdf_msg[] = "1/1 PDFを作成しました。";
                        }else{
                            $pdf_msg = [];
                        }
                    }

                    //$pdf_msg[] = "PDFを作成しました。";
                    Session::flash('pdf_msg', $pdf_msg);

                   return ['end',now(),$kokyakuorderbango];
                }else{
                    if(session()->has('generatedPdfCount')){
                        $generatedPdfCount = session()->get('generatedPdfCount');
                        $generatedPdfCount = $generatedPdfCount + 1;
                        session()->put('generatedPdfCount', $generatedPdfCount);
                    }else{
                      session()->put('generatedPdfCount', 1);
                    }

                    return ['going',now(),$kokyakuorderbango];
                }

            }else{
                if($intorder03 <= $temp_orderbango){
                    $date_err_msg[] = "売上確定済です。受注番号".$kokyakuorderbango;
                    Session::flash('date_err_msg', $date_err_msg);
                }else{
                    $pdf_err_msg[] = "PDFはすでに作成済みです。(".$kokyakuorderbango.")";
                    Session::flash('pdf_err_msg', $pdf_err_msg);
                }
            }

        }


        return "ng";

    }

    //calculate tax rate
    public function calculateTaxRate($info2,$money10,$otodoketime,$syouhinid,$bango){
        $kokyakuCode = substr($info2, 0,6);
        $haisouCode = substr($info2, 6,2);
        $kokyaku = QueryHelper::select(['bango,mallsoukobango1'])->from('kokyaku1')->where("yobi12 = '$kokyakuCode' ")->get()->first();
        $haisoujouhou = QueryHelper::select(['datatxt0051'])->from('haisoujouhou')->where("syukei1 = '$kokyaku->bango' ")->get()->first();
        $others2 = QueryHelper::fetchResult("select other1,other17,other18 from others2 where otherint1 = (select bango from haisou where haisou.shikibetsucode = '$kokyakuCode' and haisou.torihikisakibango = '$haisouCode')");

        $category1 = substr($otodoketime,0,2);
        $category2 = substr($otodoketime,2,2);
        $categorykanri = QueryHelper::fetchSingleResult("select substring(category5,1,2) as category5 from categorykanri where category1 = '$category1' AND category2 = '$category2' ");
        $category5 = (int) $categorykanri->category5;

        $mallsoukobango1 = $kokyaku->mallsoukobango1;

        if(explode(' ', $others2[0]->other1)[0] == '1'){
            $format_status = substr($mallsoukobango1,2,1);
            $data_status = explode(' ', $haisoujouhou->datatxt0051)[0];
        }else{
            $format_status = substr($others2[0]->other18,2,1);
            $data_status = explode(' ', $others2[0]->other17)[0];
        }

        if ($data_status == '1') {

            $numeric4 = ($money10*$category5)/100;

            //check tax rate for round,floor or selling
            if($format_status == '1'){
                $numeric4 = round($numeric4);
            }else if($format_status == '2'){
                $numeric4 = floor($numeric4);
            }else if($format_status == '3'){
                $numeric4 = ceil($numeric4);
            }

            return $numeric4;

            //update tuhanorder data
            //$tuhanorder_update_data = [
            //    'juchukubun2' => $kaiinid,
            //    'numeric4' => $numeric4,
            //];
            //$tuhanorderUpdate = QueryHelper::updateData('tuhanorder', $tuhanorder_update_data, 'juchukubun2', $bango, __CLASS__, __FUNCTION__, __LINE__);

        }else if($data_status == '2'){
            //$syukkoold = QueryHelper::fetchResult("select syukkasu,hantei,dataint04 from syukkoold where kaiinid = '$kaiinid' AND hantei = 0 ");
            $misyukko = QueryHelper::fetchResult("select syukkasu,hantei,dataint04 from misyukko where syouhinid = '$syouhinid' AND hantei = 0 ");
            $numeric4 = 0;
            foreach($misyukko as $key=>$value){
                $numeric4 = $numeric4 + ($misyukko[$key]->syukkasu*$misyukko[$key]->dataint04*$category5)/100;
            }

            //check tax rate for round,floor or selling
            if($format_status == '1'){
                $numeric4 = round($numeric4);
            }else if($format_status == '2'){
                $numeric4 = floor($numeric4);
            }else if($format_status == '3'){
                $numeric4 = ceil($numeric4);
            }

            return $numeric4;

        }else{
            return null;
        }
    }

    //calculate tax rate for adjustment
    public function calculateTaxRateForAdjustment($info2,$money10,$otodoketime,$kaiinid,$bango,$syukkasu,$dataint04,$syouhinid,$count_status,$numeric4,$syouhinsyu){
        $kokyakuCode = substr($info2, 0,6);
        $haisouCode = substr($info2, 6,2);
        $kokyaku = QueryHelper::select(['bango,mallsoukobango1'])->from('kokyaku1')->where("yobi12 = '$kokyakuCode' ")->get()->first();
        $haisoujouhou = QueryHelper::select(['datatxt0051'])->from('haisoujouhou')->where("syukei1 = '$kokyaku->bango' ")->get()->first();
        $others2 = QueryHelper::fetchResult("select other1,other17,other18 from others2 where otherint1 = (select bango from haisou where haisou.shikibetsucode = '$kokyakuCode' and haisou.torihikisakibango = '$haisouCode')");

        $category1 = substr($otodoketime,0,2);
        $category2 = substr($otodoketime,2,2);
        $categorykanri = QueryHelper::fetchSingleResult("select substring(category5,1,2) as category5 from categorykanri where category1 = '$category1' AND category2 = '$category2' ");
        $category5 = (int) $categorykanri->category5;

        $mallsoukobango1 = $kokyaku->mallsoukobango1;
        $datachar20 = ($syukkasu*$dataint04*$category5)/100;

        if(explode(' ', $others2[0]->other1)[0] == '1'){
            $format_status = substr($mallsoukobango1,2,1);
            $data_status = explode(' ', $haisoujouhou->datatxt0051)[0];
        }else{
            $format_status = substr($others2[0]->other18,2,1);
            $data_status = explode(' ', $others2[0]->other17)[0];
        }

        //check tax rate for round,floor or selling
        if($format_status == '1'){
            $datachar20 = round($datachar20);
        }else if($format_status == '2'){
            $datachar20 = floor($datachar20);
        }else if($format_status == '3'){
            $datachar20 = ceil($datachar20);
        }

        //update tuhanorder or syukkoold last data
        if($count_status == 'end'){
            $sum_of_datachar20 = 0;
            if ($data_status == '1') {
                $datachar20 = $datachar20;
                
                $data = QueryHelper::fetchSingleResult("select sum(datachar20::int) as sum_of_datachar20 from syukkoold where syouhinid = '$syouhinid' AND datachar13 != '2' ");
                if($data){
                    $temp_sum = $data->sum_of_datachar20 + $datachar20;
                }else{
                    $temp_sum = 0;
                }
                $difference = $numeric4 - $temp_sum;
                if($difference != 0){
                    $datachar20 = $datachar20 + $difference;
                    //update syukkoold data
                    //$syukkoold_update_data = [
                    //    'syouhinid' => $syouhinid,
                    //    'syouhinsyu' => $syouhinid,
                    //    'hantei' => 0,
                    //    'datachar20' => $datachar20 + $difference,
                    //];
                    //$syukkooldUpdate = QueryHelper::updateData('syukkoold', $syukkoold_update_data, ['syouhinid' => $syouhinid,'syouhinsyu'=>$syouhinsyu], $bango, __CLASS__, __FUNCTION__, __LINE__);
                    
                }
            }else if($data_status == '2'){
                $data = QueryHelper::fetchSingleResult("select sum(datachar20::int) as sum_of_datachar20 from syukkoold where syouhinid = '$syouhinid' AND datachar13 != '2' ");
                if($data){
                    $temp_sum = $data->sum_of_datachar20 + $datachar20;
                }else{
                    $temp_sum = 0;
                }
                
                if($numeric4 != $temp_sum){
                    //update tuhanorder data
                    $tuhanorder_update_data = [
                        'juchukubun2' => $kaiinid,
                        'numeric4' => $temp_sum,
                    ];
                    $tuhanorderUpdate = QueryHelper::updateData('tuhanorder', $tuhanorder_update_data, 'juchukubun2', $bango, __CLASS__, __FUNCTION__, __LINE__);
                }
                
                //newly comment out
//                $tempdata = QueryHelper::fetchSingleResult("select count(hantei) as total_hantei from misyukko where syouhinid = '$syouhinid' AND hantei = 0 ");
//                $total = $tempdata->total_hantei;
//                for($i=1;$i<=$total;$i++){
//                    $data = QueryHelper::fetchSingleResult("select sum(dataint04) as sum_of_dataint04 from syukkoold where syouhinid = '$syouhinid' AND syouhinsyu = '$i' AND datachar13 != '2' ");
//
//                    $difference = $numeric4 - ($data->sum_of_dataint04+$datachar20);
//                    $temp_datachar20 = $data->sum_of_dataint04 + $difference;
//
//                    if($data->sum_of_dataint04 != null){
//                        $sum_of_dataint04 = $data->sum_of_dataint04;
//                        $sum_of_datachar20 = $sum_of_datachar20 + $sum_of_dataint04;
//                        //update syukkoold data
//                        $syukkoold_update_data = [
//                            'syouhinid' => $syouhinid,
//                            'syouhinsyu' => $i,
//                            'hantei' => 0,
//                            'datachar20' => $sum_of_dataint04,
//                        ];
//                        $syukkooldUpdate = QueryHelper::updateData('syukkoold', $syukkoold_update_data, ['syouhinid' => $syouhinid,'syouhinsyu'=>$i,'hantei'=>0], $bango, __CLASS__, __FUNCTION__, __LINE__);
//                    }else{
//                        $sum_of_dataint04 = $datachar20;
//                        $sum_of_datachar20 = $sum_of_datachar20 + $sum_of_dataint04;
//                    }
//
//                }
                //newly comment out
                
                
                //$data = QueryHelper::fetchSingleResult("select COALESCE(sum(datachar20::int),0) as sum_of_datachar20 from syukkoold where syouhinid = '$syouhinid' AND datachar13 != '2' ");
                //$sum_of_datachar20 = $datachar20 + $data->sum_of_datachar20;
//                if($numeric4 != $sum_of_datachar20){
//                    //update tuhanorder data
//                    $tuhanorder_update_data = [
//                        'juchukubun2' => $kaiinid,
//                        'numeric4' => $sum_of_datachar20,
//                    ];
//                    $tuhanorderUpdate = QueryHelper::updateData('tuhanorder', $tuhanorder_update_data, 'juchukubun2', $bango, __CLASS__, __FUNCTION__, __LINE__);
//                }
            }
        }

        return $datachar20;
    }

    //create invoice number
    public function generateInvoiceNumber($bango){
        $fiscal_year = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7501' ")->orderbango ?? null;
        $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7201'");
        if($reviewData){
            $orderbango = $reviewData->orderbango + 1;
            $mobile_flag = $reviewData->mobile_flag ;
        }else{
            $orderbango = "";
            $mobile_flag = "";
        }
        $invoice_number = "12".$fiscal_year.str_pad($orderbango,$mobile_flag,'0',STR_PAD_LEFT );

        //update review data
        $review_update_data = [
            'kokyakusyouhinbango' => 'D7201',
            'orderbango' => $orderbango,
            'check_flag' => 0,
            'color' => static::getCurrentTime(),
            'nickname' => $bango,
        ];
        QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);

        return $invoice_number;
    }

    //get end key status
    public function getEndKeyStatus($end_kokyakuorderbango){
        $orderhenkanInfo = QueryHelper::fetchSingleResult("select * from orderhenkan where kokyakuorderbango = '$end_kokyakuorderbango' AND datachar10 IS NULL order by bango desc");
        if($orderhenkanInfo){
            $orderhenkan_bango = $orderhenkanInfo->bango;
        }else{
            $orderhenkan_bango = "";
        }
        $hikiatesyukkoInfo = QueryHelper::fetchSingleResult("select substring(datachar09,1,1) as datachar09 from hikiatesyukko where orderbango = '$orderhenkan_bango'");
        if(!empty($hikiatesyukkoInfo)){
            return $hikiatesyukkoInfo->datachar09;
        }
        return null;
    }

    //update syukkoold data
    public function updateSyukkooldData($info2,$numeric3,$otodoketime,$kaiinid,$bango,$syukkooldInfo,$numeric4){
        $kokyakuCode = substr($info2, 0,6);
        $haisouCode = substr($info2, 6,2);
        $kokyaku = QueryHelper::select(['bango,mallsoukobango1'])->from('kokyaku1')->where("yobi12 = '$kokyakuCode' ")->get()->first();
        $haisoujouhou = QueryHelper::select(['datatxt0051'])->from('haisoujouhou')->where("syukei1 = '$kokyaku->bango' ")->get()->first();
        $others2 = QueryHelper::fetchResult("select other17,other18 from others2 where otherint1 = (select bango from haisou where haisou.shikibetsucode = '$kokyakuCode' and haisou.torihikisakibango = '$haisouCode')");

        $category1 = substr($otodoketime,0,2);
        $category2 = substr($otodoketime,2,2);
        $categorykanri = QueryHelper::fetchSingleResult("select substring(category5,1,2) as category5 from categorykanri where category1 = '$category1' AND category2 = '$category2' ");
        $category5 = (int) $categorykanri->category5;

        $mallsoukobango1 = $kokyaku->mallsoukobango1;

        if (explode(' ', $others2[0]->other17)[0] == '1' || explode(' ', $haisoujouhou->datatxt0051)[0] == '1') {
            $count = QueryHelper::fetchSingleResult("select count(orderbango) as total from syukkoold where syouhinid = '$syukkooldInfo->syouhinid' AND substring(datachar13,1,1)='2'");
            if($count->total>0){
                //$datachar20 = QueryHelper::fetchSingleResult("select SUM(CAST(datachar20 as double precision)) as sum_of_datachar20 from syukkoold where syouhinid = '$syukkooldInfo->syouhinid'");
                $datachar20 = QueryHelper::fetchSingleResult("select SUM(CAST(datachar20 as double precision)) as sum_of_datachar20 from syukkoold where syouhinid = '$syukkooldInfo->syouhinid' AND dataInt02 NOT IN(select dataInt02 from syukkoold where syouhinid = '$syukkooldInfo->syouhinid' and substring(datachar13,1,1)='2') ");
                $difference = $numeric4 - (double)$datachar20->sum_of_datachar20;
                //update syukkoold data
                $syukkoold_update_data = [
                    'syouhinid' => $syukkooldInfo->syouhinid,
                    'dataint02' => $syukkooldInfo->dataint02,
                    'datachar20' => $difference+(double)$syukkooldInfo->datachar20,
                ];
                $syukkooldUpdate = QueryHelper::updateData('syukkoold', $syukkoold_update_data, ['syouhinid'=>$syukkooldInfo->syouhinid,'dataint02'=>$syukkooldInfo->dataint02], $bango, __CLASS__, __FUNCTION__, __LINE__);
            }
        }
    }

    public static function getCurrentTime(){
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        return str_replace(" ", "", $mytime);
    }

    //send mail to the selected item, $req_from_pdf_generate = request from voucherCreation(), js function = voucherCreation()
    public function sendMail(Request $request,$req_from_pdf_generate = null){

        $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
        $n=0;
        $mail_status = "";
        $count_sent_mail_item = 0;
        $allData=$request->all();
        $groupArr2=[];
        $groupArr6=[];
        $bango = request('userId');
        $selected_item = $request->selected_item;
        $order_id_str='(';
        foreach ($selected_item as $key => $value) {
            //check pdf (generated or not generated)
            $orderhenkan_bango = QueryHelper::fetchSingleResult("select bango,kokyakuorderbango from orderhenkan where kokyakuorderbango = '$value' AND datachar10 IS NULL order by bango desc")->bango??null;
            $hikiatesyukkoInfo = QueryHelper::fetchSingleResult("select substring(datachar04,1,1) as datachar04 from hikiatesyukko where orderbango = '$orderhenkan_bango'");
            if($hikiatesyukkoInfo && $hikiatesyukkoInfo->datachar04 != 1){
                $not_generated_pdf_msg[] = "対象：".$value;
                Session::flash('not_generated_pdf_msg', $not_generated_pdf_msg);
            }
            //check pdf (generated or not generated)

            if (array_key_last($selected_item) == $key) {
                $order_id_str.= "'".$value ."')";
            }else{
                $order_id_str.= "'".$value ."' ,";
            }

        }

        $data=QueryHelper::fetchResult("select distinct
                tuhanorder.information2,
                substring(tuhanorder.information2,1,8) as modi_info2,
                tuhanorder.information6,
                substring(tuhanorder.information6,1,8) as modi_info6,
                tuhanorder.text2,
                tuhanorder.juchukubun2,
                tuhanorder.juchubango,
                tantousya.mail as cc,
                substring(tuhanorder.housoukubun,1,1) as housoukubun,
                kokyaku1_2.address as address_2,
                kokyaku1_2.name as name_2,
                CASE
                WHEN substring(others2_2.other1,1,1) ='1' THEN substring(kokyaku1_2.mail_nouhin,1,1)
                ELSE substring(others2_2.other11,1,1)
                END as status_check_2,
                CASE
                WHEN substring(others2_2.other1,1,1) ='1' THEN kokyaku1_2.mail_toiawase
                ELSE others2_2.other12
                END as password_2,
                haisou_2.name as h_name_2,
                haisou_2.haisoumoji1 as haisoumoji1_2,
                haisou_2.name as h_name_2,
                etsuransya_2.mail1 as mail1_2,
                etsuransya_2.mail2 as mail2_2,
                etsuransya_2.mail4 as mail4_2,
                etsuransya_2.tantousya as tantousya_2,
                substring(etsuransya_2.mail4,1,3) as modified_mail4_2,

                kokyaku1_6.address as address_6,
                kokyaku1_6.name as name_6,
                CASE
                WHEN substring(others2_6.other1,1,1) ='1' THEN substring(kokyaku1_6.mail_nouhin,1,1)
                ELSE substring(others2_6.other11,1,1)
                END as status_check_6,
                CASE
                WHEN substring(others2_6.other1,1,1) ='1' THEN kokyaku1_6.mail_toiawase
                ELSE others2_6.other12
                END as password_6,
                haisou_6.name as h_name_6,
                haisou_6.haisoumoji1 as haisoumoji1_6,
                haisou_6.name as h_name_6,
                etsuransya_6.mail1 as mail1_6,
                etsuransya_6.mail2 as mail2_6,
                etsuransya_6.mail4 as mail4_6,
                etsuransya_6.tantousya as tantousya_6,
                substring(etsuransya_6.mail4,1,3) as modified_mail4_6

                from tuhanorder

                join tantousya
                on tuhanorder.text2=tantousya.bango

                join kokyaku1 as kokyaku1_2
                on substring(tuhanorder.information2,1,6) = kokyaku1_2.yobi12

                join kokyaku1 as kokyaku1_6
                on substring(tuhanorder.information6,1,6) = kokyaku1_6.yobi12

                join haisou as haisou_2
                on substring(tuhanorder.information2,7,2)=haisou_2.torihikisakibango
                and kokyaku1_2.bango = haisou_2.kokyakubango

                join haisou as haisou_6
                on substring(tuhanorder.information6,7,2)=haisou_6.torihikisakibango
                and kokyaku1_6.bango = haisou_6.kokyakubango

                join others2 as others2_2
                on others2_2.otherint1 = haisou_2.bango

                join others2 as others2_6
                on others2_6.otherint1 = haisou_6.bango

                join etsuransya as etsuransya_2
                on etsuransya_2.datatxt0014=substring(tuhanorder.information2,1,6)
                and etsuransya_2.datatxt0015=substring(tuhanorder.information2,7,2)
                and etsuransya_2.datatxt0049=substring(tuhanorder.information2,9,3)

                join etsuransya as etsuransya_6
                on etsuransya_6.datatxt0014=substring(tuhanorder.information6,1,6)
                and etsuransya_6.datatxt0015=substring(tuhanorder.information6,7,2)
                and etsuransya_6.datatxt0049=substring(tuhanorder.information6,9,3)

                where tuhanorder.juchubango IN $order_id_str AND juchukubun2 IS NOT NULL order by tuhanorder.juchukubun2 desc");


        $groupArr2=[];
        $groupArr6=[];

        foreach ($data as $key => $value) {
        $count_sent_mail_item++;
        $pdf_name = $value->juchukubun2."_".$value->modi_info2."_".$value->address_2."_".$value->haisoumoji1_2."_uri.pdf";


         $groupArr2[$value->modi_info2][$value->juchubango]['pdf']=$pdf_name;
         $groupArr2[$value->modi_info2][$value->juchubango]['information2']=$value->information2;
         $groupArr2[$value->modi_info2][$value->juchubango]['information6']=$value->information6;
         $groupArr2[$value->modi_info2][$value->juchubango]['juchukubun2']= $value->juchukubun2;
         $groupArr2[$value->modi_info2][$value->juchubango]['juchubango']=$value->juchubango;
         $groupArr2[$value->modi_info2][$value->juchubango]['cc']=   $value->cc;
         $groupArr2[$value->modi_info2][$value->juchubango]['address']=$value->address_2;
         $groupArr2[$value->modi_info2][$value->juchubango]['housoukubun']=  $value->housoukubun;
         $groupArr2[$value->modi_info2][$value->juchubango]['status_check']=$value->status_check_2;
         $groupArr2[$value->modi_info2][$value->juchubango]['password']=$value->password_2;
         $groupArr2[$value->modi_info2][$value->juchubango]['haisoumoji1']= $value->haisoumoji1_2;
         $groupArr2[$value->modi_info2][$value->juchubango]['mail1']=$value->mail1_2;
         $groupArr2[$value->modi_info2][$value->juchubango]['mail2']=   $value->mail2_2;
         $groupArr2[$value->modi_info2][$value->juchubango]['address']=$value->address_2;
         $groupArr2[$value->modi_info2][$value->juchubango]['mail4']=  $value->mail4_2;
         $groupArr2[$value->modi_info2][$value->juchubango]['modified_mail4']=$value->modified_mail4_2;
         $groupArr2[$value->modi_info2][$value->juchubango]['h_name']=$value->h_name_2;
         $groupArr2[$value->modi_info2][$value->juchubango]['tantousya']=$value->tantousya_2;
         $groupArr2[$value->modi_info2][$value->juchubango]['name']=$value->name_2;

         $groupArr6[$value->modi_info2][$value->juchubango]['pdf']=$pdf_name;
         $groupArr6[$value->modi_info2][$value->juchubango]['information2']=$value->information2;
         $groupArr6[$value->modi_info2][$value->juchubango]['information6']=$value->information6;
         $groupArr6[$value->modi_info2][$value->juchubango]['juchukubun2']= $value->juchukubun2;
         $groupArr6[$value->modi_info2][$value->juchubango]['juchubango']=$value->juchubango;
         $groupArr6[$value->modi_info2][$value->juchubango]['cc']=   $value->cc;
         $groupArr6[$value->modi_info2][$value->juchubango]['address']=$value->address_6;
         $groupArr6[$value->modi_info2][$value->juchubango]['housoukubun']=  $value->housoukubun;
         $groupArr6[$value->modi_info2][$value->juchubango]['status_check']=$value->status_check_2;
         $groupArr6[$value->modi_info2][$value->juchubango]['password']=$value->password_6;
         $groupArr6[$value->modi_info2][$value->juchubango]['haisoumoji1']= $value->haisoumoji1_6;
         $groupArr6[$value->modi_info2][$value->juchubango]['mail1']=$value->mail1_6;
         $groupArr6[$value->modi_info2][$value->juchubango]['mail2']=   $value->mail2_6;
         $groupArr6[$value->modi_info2][$value->juchubango]['address']=$value->address_6;
         $groupArr6[$value->modi_info2][$value->juchubango]['mail4']=  $value->mail4_6;
         $groupArr6[$value->modi_info2][$value->juchubango]['modified_mail4']=$value->modified_mail4_6;
         $groupArr6[$value->modi_info2][$value->juchubango]['h_name']=$value->h_name_6;
         $groupArr6[$value->modi_info2][$value->juchubango]['tantousya']=$value->tantousya_6;
         $groupArr6[$value->modi_info2][$value->juchubango]['name']=$value->name_6;
        }



        if($count_sent_mail_item>0){
            if ($allData['billing_address']=='1' && $req_from_pdf_generate!='1') {

                $no_pass_msg=[];
                foreach ($groupArr2 as $key => $value) {
                    $max_uriage_data=[];
                    $ccArr=[];
                    $housoukubun=[];
                    foreach ($value as $k => $val) {
                        if ($k == array_key_first($value)) {

                            $max_uriage_data['pdf']=$val['pdf'];
                            $max_uriage_data['information2']=$val['information2'];
                            $max_uriage_data['information6']=$val['information6'];
                            $max_uriage_data['juchukubun2']=$val['juchukubun2'];
                            $max_uriage_data['juchubango']=$val['juchubango'];
                            $max_uriage_data['cc']=$val['cc'];
                            $max_uriage_data['address']=$val['address'];
                            $max_uriage_data['housoukubun']=$val['housoukubun'];
                            $max_uriage_data['status_check']=$val['status_check'];
                            $max_uriage_data['password']=$val['password'];
                            $max_uriage_data['haisoumoji1']=$val['haisoumoji1'];
                            $max_uriage_data['mail1']=$val['mail1'];
                            $max_uriage_data['mail2']=$val['mail2'];
                            $max_uriage_data['address']=$val['address'];
                            $max_uriage_data['mail4']=$val['mail4'];
                            $max_uriage_data['modified_mail4']=$val['modified_mail4'];
                            $max_uriage_data['h_name']=$val['h_name'];
                            $max_uriage_data['tantousya']=$val['tantousya'];
                            $max_uriage_data['name']=$val['name'];
                        }

                    }

                        $mail_send_status=$max_uriage_data['status_check'];
                        $password=$max_uriage_data['password'];
                        $to_mail=$max_uriage_data['mail1'];

                        if ($to_mail=='' || !filter_var($to_mail, FILTER_VALIDATE_EMAIL)) {
                            $no_mail_msg[] = "対象：".$max_uriage_data['information2'].' '.$max_uriage_data['address']."/".$max_uriage_data['haisoumoji1']."/".$max_uriage_data['modified_mail4'].' '.$to_mail;
                            Session::flash('no_mail_msg', $no_mail_msg);
                            //return ['mailnai',$n];
                        }

                        $zip_name = date('Ymd')."_".substr($max_uriage_data['information2'], 0,8) ."_uri";
                        $zip = new ZipArchive;
                        if(!file_exists('zip/salesSlip')){
                            mkdir('zip/salesSlip',0777,true);
                        }
                        $zipFileName = 'zip/salesSlip/'.$zip_name.'.zip';


                        if ($password == null) {
                            if (!in_array($max_uriage_data['information2']."のパスワードの入力がないため、メール送信できませんでした。", $no_pass_msg)) {
                                $no_pass_msg[] = $max_uriage_data['information2']."のパスワードの入力がないため、メール送信できませんでした。";
                               Session::flash('no_pass_msg', $no_pass_msg);
                            }

                            //return ['no_password',$n];
                        }

                        if($password != null && $to_mail !='' && filter_var($to_mail, FILTER_VALIDATE_EMAIL)){
                            if(file_exists($zipFileName)){
                                unlink($zipFileName);
                            }

                            if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE)
                            {

                                if (!$zip->setPassword($password)) {
                                    throw new \RuntimeException('Set password failed');
                                }
                                // compress file

                                foreach ($value as $k => $val) {
                                    array_push($housoukubun, $val['housoukubun']);
                                    $fileName = 'pdf/salesSlip/'.$val['pdf'];
                                    $baseName = basename($fileName);

                                    if (!$zip->addFile($fileName, $baseName)) {
                                        throw new \RuntimeException(sprintf('Add file failed: %s', $fileName));
                                    }
                                    if (!$zip->setEncryptionName($baseName, ZipArchive::EM_AES_256)) {
                                        throw new \RuntimeException(sprintf('Set encryption failed: %s', $baseName));
                                    }
                                    //cc mail listing
                                    $cc = 0;
                                    if (isset($val['cc']) && $val['cc'] != null) {
                                        if ($val['cc'] !=null && !filter_var($val['cc'], FILTER_VALIDATE_EMAIL)) {
                                            $cc++;
                                            $no_mail_msg[] = "対象：".$max_uriage_data['information2'].' '.$max_uriage_data['address']."/".$max_uriage_data['haisoumoji1']."/".$max_uriage_data['modified_mail4'].' '.$to_mail;
                                            Session::flash('no_mail_msg', $no_mail_msg);
                                            //return ['mailnai',$n];
                                        }
                                        array_push($ccArr, $val['cc']);
                                    }
                                }
                                $zip->close();

                            } else {
                                echo ['failed',$n];
                            }

                            //for testting i am using this variable change value

                            if($cc == 0)
                            {

                                $n++;
                                $mail_status = $this->mailFunction($password,$to_mail,$ccArr,$zipFileName,$max_uriage_data,$housoukubun);
                            }


                        }

                        if($mail_status == "ok"){
                            //update database
                            foreach ($value as $key => $val) {
                                pg_query($conn, "BEGIN");
                                try{
                                    $hikiatesyukko = [
                                        'syouhinid' => $key,
                                        'datachar09' => 1,
                                        'idoutanabango' => static::getCurrentTime(),
                                        'tantousyabango' => $bango
                                    ];

                                    QueryHelper::updateData('hikiatesyukko', $hikiatesyukko, 'syouhinid', $bango, __CLASS__, __FUNCTION__, __LINE__);
                                    pg_query($conn,"COMMIT");
                                }catch (\Exception $e) {
                                    pg_query($conn, "ROLLBACK");
                                }
                            }
                        }else{
                            $mail_status = "";
                        }

                }

            }

            if ($allData['bill_to']=='1') {

                $no_pass_msg=[];
                foreach ($groupArr6 as $key => $value) {

                    $max_uriage_data=[];
                    $ccArr=[];
                    $housoukubun=[];
                    //if ($allData['billing_address']!='1' OR $key!=$information2)

                    foreach ($value as $k => $val) {
                        if ($k == array_key_first($value)) {

                            $max_uriage_data['pdf']=$val['pdf'];
                            $max_uriage_data['information2']=$val['information2'];
                            $max_uriage_data['information6']=$val['information6'];
                            $max_uriage_data['juchukubun2']=$val['juchukubun2'];
                            $max_uriage_data['juchubango']=$val['juchubango'];
                            $max_uriage_data['cc']=$val['cc'];
                            $max_uriage_data['address']=$val['address'];
                            $max_uriage_data['housoukubun']=$val['housoukubun'];
                            $max_uriage_data['status_check']=$val['status_check'];
                            $max_uriage_data['password']=$val['password'];
                            $max_uriage_data['haisoumoji1']=$val['haisoumoji1'];
                            $max_uriage_data['mail1']=$val['mail1'];
                            $max_uriage_data['mail2']=$val['mail2'];
                            $max_uriage_data['address']=$val['address'];
                            $max_uriage_data['mail4']=$val['mail4'];
                            $max_uriage_data['modified_mail4']=$val['modified_mail4'];
                            $max_uriage_data['h_name']=$val['h_name'];
                            $max_uriage_data['tantousya']=$val['tantousya'];
                            $max_uriage_data['name']=$val['name'];
                        }

                    }

                        $mail_send_status=$max_uriage_data['status_check'];
                        $password=$max_uriage_data['password'];
                        $to_mail=$max_uriage_data['mail1'];

                        if ($to_mail=='' || !filter_var($to_mail, FILTER_VALIDATE_EMAIL)) {
                            $no_mail_msg[] = "対象：".$max_uriage_data['information6'].' '.$max_uriage_data['address']."/".$max_uriage_data['haisoumoji1']."/".$max_uriage_data['modified_mail4'].' '.$to_mail;
                            if($req_from_pdf_generate == 1){
                                if($mail_send_status == 1){
                                    Session::flash('no_mail_msg', $no_mail_msg);
                                }
                            }else{
                                Session::flash('no_mail_msg', $no_mail_msg);
                            }
                            //return ['mailnai',$n];
                        }

                        $zip_name = date('Ymd')."_".substr($max_uriage_data['information2'], 0,8) ."_uri";
                        $zip = new ZipArchive;
                        if(!file_exists('zip/salesSlip')){
                            mkdir('zip/salesSlip',0777,true);
                        }
                        $zipFileName = 'zip/salesSlip/'.$zip_name.'.zip';


                        if ($password == null) {
                            if (!in_array($max_uriage_data['information6']."のパスワードの入力がないため、メール送信できませんでした。", $no_pass_msg)) {
                                $no_pass_msg[] = $max_uriage_data['information6']."のパスワードの入力がないため、メール送信できませんでした。";
                                if($req_from_pdf_generate == 1){
                                    if($mail_send_status == 1){
                                        Session::flash('no_pass_msg', $no_pass_msg);
                                    }
                                }else{
                                    Session::flash('no_pass_msg', $no_pass_msg);
                                }
                            }


                            //return ['no_password',$n];
                        }

                        if($password != null && $to_mail !='' && filter_var($to_mail, FILTER_VALIDATE_EMAIL)){
                            if(file_exists($zipFileName)){
                                unlink($zipFileName);
                            }

                            if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE)
                            {

                                if (!$zip->setPassword($password)) {
                                    throw new \RuntimeException('Set password failed');
                                }
                                // compress file

                                foreach ($value as $k => $val) {

                                    $fileName = 'pdf/salesSlip/'.$val['pdf'];

                                    $baseName = basename($fileName);

                                    array_push($housoukubun, $val['housoukubun']);

                                    if (!$zip->addFile($fileName, $baseName)) {
                                        throw new \RuntimeException(sprintf('Add file failed: %s', $fileName));
                                    }
                                    if (!$zip->setEncryptionName($baseName, ZipArchive::EM_AES_256)) {
                                        throw new \RuntimeException(sprintf('Set encryption failed: %s', $baseName));
                                    }
                                    //cc mail listing

                                    $cc = 0;
                                    if (isset($val['cc']) && $val['cc'] != null) {
                                        if ($val['cc'] !=null && !filter_var($val['cc'], FILTER_VALIDATE_EMAIL)) {
                                            $cc++;
                                            $no_mail_msg[] = "対象：".$max_uriage_data['information6'].' '.$max_uriage_data['address']."/".$max_uriage_data['haisoumoji1']."/".$max_uriage_data['modified_mail4'].' '.$to_mail;
                                            Session::flash('no_mail_msg', $no_mail_msg);
                                            //return ['mailnai',$n];
                                        }
                                        array_push($ccArr, $val['cc']);
                                    }
                                }
                                $zip->close();

                            } else {
                                echo ['failed',$n];
                            }

                            //for testting i am using this variable change value

                            if($req_from_pdf_generate == 1){

                                if($cc == 0 && $mail_send_status == 1){
                                    $n++;

                                    $mail_status = $this->mailFunction($password,$to_mail,$ccArr,$zipFileName,$max_uriage_data,$housoukubun);
                                }
                            }else{

                                if($cc == 0){
                                    $n++;
                                    $mail_status = $this->mailFunction($password,$to_mail,$ccArr,$zipFileName,$max_uriage_data,$housoukubun);

                                }
                            }

                        }

                    //}

                    if($mail_status == "ok"){
                        //update database
                        foreach ($value as $key => $val) {
                            pg_query($conn,"BEGIN");
                            try{
                                $hikiatesyukko = [
                                    'syouhinid' => $key,
                                    'datachar09' => 1,
                                    'idoutanabango' => static::getCurrentTime(),
                                    'tantousyabango' => $bango
                                ];

                                if($req_from_pdf_generate == 1){
                                    if($mail_send_status == 1){
                                        QueryHelper::updateData('hikiatesyukko', $hikiatesyukko, 'syouhinid', $bango, __CLASS__, __FUNCTION__, __LINE__);
                                    }
                                }else{
                                    QueryHelper::updateData('hikiatesyukko', $hikiatesyukko, 'syouhinid', $bango, __CLASS__, __FUNCTION__, __LINE__);
                                }
                                pg_query($conn, "COMMIT");
                            }catch (\Exception $e) {
                                pg_query($conn, "ROLLBACK");
                            }
                        }
                    }else{
                        $mail_status = "";
                    }

                }

            }


            $return = "ok";
            if($n>0 && !Session::has('ng_msg')){
                $email_success_msg = $n."件、メール送信しました。";
                Session::flash('email_success_msg', $email_success_msg);
            }
            if(Session::has('no_mail_msg')){
                $no_mail_common_msg = "有効なメールアドレスではありませんでしたので、以下はメール未送信です。";
                Session::flash('no_mail_common_msg', $no_mail_common_msg);
            }
            if(Session::has('not_generated_pdf_msg')){
                $not_generated_pdf_common_msg = "PDF未作成のデータでしたので、以下はメール未送信です。";
                Session::flash('not_generated_pdf_common_msg', $not_generated_pdf_common_msg);
            }
            return [$return,$n];
        }else{
            $return = "ok";
            if(Session::has('not_generated_pdf_msg')){
                $not_generated_pdf_common_msg = "PDF未作成のデータでしたので、以下はメール未送信です。";
                Session::flash('not_generated_pdf_common_msg', $not_generated_pdf_common_msg);
            }
            return [$return,$n];
        }



    }

    private function mailFunction($password,$to_mail,$ccArr,$zipPack,$max_uriage_data,$housoukubun)
    {

        $ccMail=$ccArr;
        $fromMail=env('MAIL_FROM');
        $mailFlag=env('MAIL_SEND_CONTROL','NONE');

        if ($mailFlag == "NONE") {
            $ng_msg[] = "選択した宛先の個人項目「メールアドレス」 が入力されていないため、処理できません。マスタより登録後、再度処理を行ってください。";
            Session::flash('ng_msg', $ng_msg);
            return 'ng';
        }elseif($mailFlag == "COLGIS" and $to_mail != null){

            if (strpos($to_mail, 'colgis') !== false) {

                Mail::send(new mailZip($max_uriage_data,$to_mail,$ccMail,$zipPack,$fromMail,$housoukubun));
                if (count(Mail::failures()) > 0) {
                    return (Mail::failures());
                };

                Mail::send(new mailPasswordsalesAccpt($password,$max_uriage_data,$to_mail,$ccMail,$zipPack,$fromMail,$housoukubun));
                if (count(Mail::failures()) > 0) {
                    return (Mail::failures());
                };
            }
            else{
                $ng_msg[] = "選択した宛先の個人項目「メールアドレス」 が入力されていないため、処理できません。マスタより登録後、再度処理を行ってください。";
                Session::flash('ng_msg', $ng_msg);
                return 'ng';
            }
        }elseif ($mailFlag == "ALL" and $to_mail != null) {
            Mail::send(new mailZip($max_uriage_data,$to_mail,$ccMail,$zipPack,$fromMail,$housoukubun));
            if (count(Mail::failures()) > 0) {
                return (Mail::failures());
            };
            Mail::send(new mailPasswordsalesAccpt($password,$max_uriage_data,$to_mail,$ccMail,$zipPack,$fromMail,$housoukubun));
            if (count(Mail::failures()) > 0) {
                return (Mail::failures());
            };
        }
        return 'ok';
    }

    //download pdf of selected item
    public function downloadPDF(Request $request){
        $bango = request('userId');
        $selected_item = $request->selected_item;
        $item_list = array();
        foreach($selected_item as $key=>$kokyakuorderbango){
            $deleted_item = 0;
            $query = DownloadData::data($bango, $deleted_item,$kokyakuorderbango)->toSql();
            $voucherData = QueryHelper::fetchResult($query);
            $voucherData = collect($voucherData);

            if(count($voucherData)>0){
                $pdf_name = $voucherData[0]->juchukubun2."_".$voucherData[0]->information2_short."_".$voucherData[0]->company_address."_".$voucherData[0]->office_haisoumoji1."_uri.pdf";
                if(file_exists(public_path('pdf/salesSlip/'.$pdf_name))){
                    $item_list[] = 'pdf/salesSlip/'.$pdf_name;


                    //update hikiatesyukko
                    //$hikiatesyukkoInfo = QueryHelper::fetchSingleResult("select * from hikiatesyukko where syouhinid = '$kokyakuorderbango' AND kaiinid IS NOT NULL order by orderbango desc");
                    //if($hikiatesyukkoInfo){
                        $hikiatesyukko_update_data = [
                            //'orderbango' => $hikiatesyukkoInfo->orderbango,
                            //'syouhinid' => $hikiatesyukkoInfo->syouhinid,
                            'syouhinid' => $kokyakuorderbango,
                            'idoutanabango' => static::getCurrentTime(),
                            'tantousyabango' => $bango,
                            'datachar10' => 1,
                        ];
                        $hikiatesyukko = QueryHelper::updateData('hikiatesyukko', $hikiatesyukko_update_data, ['syouhinid'=>$kokyakuorderbango], true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                    //}

                }
            }

        }

        $no_of_download = array();
        if(!empty($item_list)){
            $modifier = 1;
            $new_item_list = array_chunk($item_list, 2);
            foreach ($new_item_list as $key => $value) {
                $date_time = static::getCurrentTime();
                $zip_name = $date_time."(".$modifier.")"."_uri";
                $zip = new ZipArchive;
                if(!file_exists('zip/salesSlip/downloadedZip')){
                    mkdir('zip/salesSlip/downloadedZip',0777,true);
                }
                $zipFileName = 'zip/salesSlip/downloadedZip/'.$zip_name.'.zip';

                if ($zip->open(public_path($zipFileName), ZipArchive::CREATE) === TRUE){
                    // compress file
                    foreach ($value as $k => $val) {
                        $fileName = $val;
                        $baseName = basename($fileName);

                        if (!$zip->addFile($fileName, $baseName)) {
                            throw new \RuntimeException(sprintf('Add file failed: %s', $fileName));
                        }

                    }
                    $zip->close();

                    $modifier++;
                    $no_of_download[]= URL($zipFileName);

                } else {
                    echo ['failed',$n];
                }

            }
            return $no_of_download;
        }else{
            return "not_ok";
        }
    }

    public function clearBottomReqData($request_data){
        $headers = [
            '受注番号' => 'kokyakuorderbango',
            '受注件名' => 'juchukubun1',
            '受注先' => 'information1_detail',
            '売上請求先' => 'information2_detail',
            '最終顧客' => 'information3_detail',
            '担当' => 'user_name_search',
            '売上日' => 'intorder03',
            '受注金額' => 'money10',
            '売上伝票PDF' => 'text4',
            'tick_mark' => 'checkbox',
            '売上番号' => 'sales_slip_juchukubun2',
            '発行者' => 'hktsyukko_datachar05_detail_search',
            '郵送' => 'information2_mail_jyushin_mb',
            '印刷済' => 'hktsyukko_datachar10',
            'メール' => 'information2_mail_nouhin',
            'メール済' => 'hktsyukko_datachar09',
            '請求書送付先CD' => 'information6',
            '請求書送付先' => 'information6_detail',
        ];
        foreach($request_data as $key=>$val){
            if (in_array($key, $headers)){
                $request_data[$key] = null;
            }
        }
        return $request_data;
    }

}




