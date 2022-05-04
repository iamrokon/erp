<?php

namespace App\Http\Controllers\purchase;
use App\AllClass\master\nameMaster\allCategorykanri;
use App\AllClass\purchase\purchaseOrder\AllPurchaseOrder;
use App\AllClass\purchase\purchaseOrder\PdfData;
use App\AllClass\purchase\purchaseOrder\PurchaseOrderHeaders;
use App\Mail\mailPasswordPurchaseOrder;
use App\Mail\mailZipPurchaseOrder;
use DateTime;
use Illuminate\Http\Request;
use App\tantousya;
use App\kengen;
use App\requestTable;
use App\AllClass\order\backOrder\validateBackOrderUpdate;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\ButtonMsg;
use Illuminate\Pagination\Paginator;
use App\AllClass\master\excelDownload;
use App\kokyaku1;
use App\AllClass\TableSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use PDF;
use ZipArchive;
use Mail;
use File;
use Excel;
use App\AllClass\master\ExcelReportDownload;
use Carbon\Carbon;
use App\AllClass\master\CSVLogger;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;

class PurchaseOrderController extends Controller
{
    private $headers = [
        '発注番号' => 'order_number1',
        '発注訂正回数' => 'correction_orders',
        '受注番号' => 'order_number2',
        '発注日' => 'date',
        '受注先' => 'contractor',
        '仕入先' => 'supplier',
        '担当' => 'user_name',
        '✓' => 'check_tik',
        /*'(チェックボックス)' => '',*/
        '検印' => 'seal',
        '発注書書類保管番号' => 'storage_number',
        /*'発注書PDF' => 'purchase_order_pdf',*/
        'メール済' => 'emailed',
        '仕入先見積番号' => 'supplier_quotation_number',
        '発注総額' => 'total_order_amount',
        '発注消費税総額' => 'purchase_consumption_tax',
        '最終顧客' => 'end_customer',
        '発注履歴作成フラグ' => 'order_history_creation_flag',
        '検印者' => 'checker'
    ];

    public function postPurchaseOrder(Request $request)
    {
        /*$sql = "DELETE FROM kengensettei where kengenchar05::text LIKE '%05-03%' and kengenchar01::text LIKE '%col%'";
                        QueryHelper::runQuery($sql);*/
        $systemDate=date('Y/m/d');
        $month_ini = new DateTime("first day of last month");
        $beforeSystemDate=$month_ini->format('Y/m/d');
        $bango = request('userId');
        $data_from_view = $request->all();
        session()->put('oldInput' . $bango, $data_from_view);
        $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7501'");
        $review_orderbango = $reviewData->orderbango;
        $tantousya = tantousya::find($bango);
        $data003=substr($tantousya->datatxt0003, 2,4);
        $data003_left=substr($tantousya->datatxt0003, 2,4);
        $data003_right=substr($tantousya->datatxt0003, 2,4);
        if (isset($data_from_view['division_datachar05_start'])) {
            $data003_left=substr($data_from_view['division_datachar05_start'], 2,4);
        }
        if (isset($data_from_view['division_datachar05_end'])) {
            $data003_right=substr($data_from_view['division_datachar05_end'], 2,4);
        }
        $data004 = substr($tantousya->datatxt0004, 2,5);
        $data005 = substr($tantousya->datatxt0005, 2,6);

        $personal_datatxt0003 = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'B9' ")->where("category2 = '$data003' ")->get()->first();

        $personal_datatxt0004 = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C1' ")->where("category2 = '$data004' ")->get()->first();

        $personal_datatxt0005 = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("category2 = '$data005' ")->get()->first();


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

//        dd($C1Data_left);
        //get tantousya data
        //$datachar05 = QueryHelper::fetchResult("select * from tantousya where deleteflag = 0 and ztanka='$review_orderbango' order by bango");
        $datachar05 = QueryHelper::fetchResult("select * from tantousya where deleteflag = 0 and ztanka='$review_orderbango' and innerlevel >= 10 and innerlevel <= 20 order by bango");

        $headers = PurchaseOrderHeaders::headers($bango);
        $table_headers = PurchaseOrderHeaders::headers($bango, 'table_headers');
        $route = 'purchaseOrderTableSetting';
        $redirect_path = 'purchaseOrderReload';
        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $bango)->where('kengenchar05', '05-03')->get()->count();
        if($initial_header == 0){
            unset($headers['仕入先見積番号']);
            unset($headers['発注総額']);
            unset($headers['発注消費税総額']);
            unset($headers['最終顧客']);
            unset($headers['発注履歴作成フラグ']);
            unset($headers['検印者']);
        }
        $buttonMessage = ButtonMsg::read($bango);
        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 20;
        }
        $old = $request->all();
        /*session()->put('oldInput' . $bango, $data_from_view);*/
        if($tantousya->innerlevel<=10 ) $privileged_user = true; else $privileged_user = false;
//        dd($tantousya->innerlevel,$privileged_user);
        $purchaseOrderError='';
        $purchaseOrderSuccess='';
//        dd($data_from_view,request());
        if (!empty($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' )) {
            $fsRemoveTableKeys=['order_number1', 'correction_orders', 'order_number2', 'date', 'contractor','supplier', 'user_name', 'seal','storage_number','emailed','supplier_quotation_number','total_order_amount', 'purchase_consumption_tax', 'end_customer', 'order_history_creation_flag','checker','sortField','sortType'];
//            $fsTableKeys=['division_datachar05_start', 'department_datachar05_start', 'group_datachar05_start', 'division_datachar05_end', 'department_datachar05_end','group_datachar05_end', 'datachar05', 'orderDateFrom','orderDateTo','orderNo','rd1','rd2', 'correction_checkbox_h', 'information1_text', 'information1_short','information2_text','information2_short','information3_text','information3_short','pagination'];
            $fsReqData= $this->removeDataFromView($data_from_view, $fsRemoveTableKeys);
//            dd($data_from_view,$fsReqData);
            $temp_table= "purchase_order_temp";

            try {
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort') {

//                    dd($data_from_view);
                    $formatted_int_fields=['purchase_consumption_tax','total_order_amount'];
                    $allTableRequest = $this->modifyBladeData($data_from_view, $fsRemoveTableKeys);
//                    dd($allTableRequest);

                    foreach ($allTableRequest as $key => $value) {
                        if (in_array($key, $formatted_int_fields) && $value!=null) {
//                            dd($value);
                            $allTableRequest[$key] = str_replace(',','',$value);
                        }
                    }
                    $query= AllPurchaseOrder::readData($bango,$fsReqData);

//                    dd($allTableRequest);

                    $purchaseOrderInfos = $this->searchDataFetch($query, $allTableRequest, $bango, $temp_table, $pagination);
                    if ($purchaseOrderInfos->items() == null && $purchaseOrderInfos->currentPage() != 1) {
                        $currentPage = ($purchaseOrderInfos->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $purchaseOrderInfos = $this->searchDataFetch($query, $allTableRequest, $bango, $temp_table, $pagination);
                    }
//                    dd($purchaseOrderInfos->total());
                    if ($purchaseOrderInfos->total() == 0) {
                        if(Session::has('defaultSrc')){
                            if (Session::get('defaultSrc')=='1'){
                                $purchaseOrderError = '該当するデータがありません。';
                            }
                            else{
                                $purchaseOrderError = '';
                            }
                        }
                        else{
                            $purchaseOrderError = '';
                        }
                    } else {
                        $purchaseOrderError = '';
                    }
                }
                else if ($data_from_view['Button'] == 'xls') {
                    $query= AllPurchaseOrder::readData($bango,$fsReqData);

                    $allTableRequest = $this->modifyBladeData($data_from_view, $fsRemoveTableKeys);

                    $searched = $this->searchDataFetch($query, $allTableRequest, $bango, $temp_table, $pagination, 'xls');
//                        dd($searched);
                    $headers = $this->headers;
                    $headers['発注消費税総額']='purchase_consumption_tax_show';
                    $headers['発注総額']='total_order_amount_show';
//                    dd($allTableRequest,$searched,$headers);
                    $excelName = '発注一覧・発注書.xlsx';
                    return $this->excelDownload($headers, $searched, $excelName);
                }
            } catch (\Exception $e) {
//                dd($e,Session::has('defaultSrc'),Session::get('defaultSrc'));
                $purchaseOrderInfos = collect([])->paginate($pagination);
                if ($purchaseOrderInfos->total() == 0) {
                    if(Session::has('defaultSrc')){
                        if (Session::get('defaultSrc')=='1'){
//                            dd('hlw');
                            $purchaseOrderError = '該当するデータがありません。';
                        }
                        else{
//                            dd('hi');
                            $purchaseOrderError = '';
                        }
                    }
                    else{
                        $purchaseOrderError = '';
                    }
                } else {
                    $purchaseOrderError = '';
                }
            }
//dd($fsReqData);
            return view('purchase.purchaseOrder.mainPurchaseOrder',compact('bango','tantousya','privileged_user','B9Data_left','C1Data_left','C2Data_left','B9Data_right','C1Data_right','C2Data_right','datachar05','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','systemDate','beforeSystemDate','purchaseOrderInfos','fsReqData','headers','buttonMessage','route','redirect_path','table_headers','purchaseOrderError','old'));
        }

        else if (!empty(request('firstButton')) && request('firstButton')== 'topSearch' || !empty(request('Button')) && request('Button') == 'refresh')
        {
            $old=[];
            $fsReqData= $request->all();
            $query= AllPurchaseOrder::readData($bango,$data_from_view);
            if (count(QueryHelper::fetchResult($query))==0){
                $purchaseOrderError = '該当するデータがありません。';
                session()->put('defaultSrc', '0');
            }
            else{
                $purchaseOrderError = '';
                session()->put('defaultSrc', '1');
            }
            $purchaseOrderInfos = collect(QueryHelper::fetchResult($query))->paginate(20);/*collect([])->paginate(20);*/
//            dd($headers);
            return view('purchase.purchaseOrder.mainPurchaseOrder',compact('bango','tantousya','privileged_user','B9Data_left','C1Data_left','C2Data_left','B9Data_right','C1Data_right','C2Data_right','datachar05','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','systemDate','beforeSystemDate','purchaseOrderInfos','old','fsReqData','headers','buttonMessage','route','redirect_path','table_headers','purchaseOrderSuccess','purchaseOrderError'));
        }
        $old=null;
        session()->put('defaultSrc', '0');
        $purchaseOrderInfos =collect([])->paginate(20);

        return view('purchase.purchaseOrder.mainPurchaseOrder',compact('bango','tantousya','privileged_user','B9Data_left','C1Data_left','C2Data_left','B9Data_right','C1Data_right','C2Data_right','datachar05','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','systemDate','beforeSystemDate','purchaseOrderInfos','old','headers','buttonMessage','route','redirect_path','table_headers','purchaseOrderSuccess','purchaseOrderError'));
    }

    public function purchaseStampUpdate(Request $request){
        $syouhinIds=$request['syouhinIds'];
        $syouhinIdDates=$request['syouhinIdDates'];
        $bango=$request['userId'];
        //dd($syouhinIds,$syouhinIdDates);
        //return 2;

        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### purchaseOrder102_update start\n";
        QueryHandler::logger($bango, $log_data);
        $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
        pg_query($conn, 'BEGIN');
        try{
            $updatedSyouhinIdArr=[];
            foreach ($syouhinIds as $key => $value) {
                $update_check=QueryHelper::fetchResult("select hikiatenyuko.dataint06 from hikiatenyuko where hikiatenyuko.syouhinid = '$value' limit 1");
                if (!empty($update_check) && $update_check[0]->dataint06==2){
                    $date_check=$syouhinIdDates[$key];  //taking the DenpyoShimeBi old value
                    $hikiatenyuko=[
                        'syouhinid' => $value,
                        'datachar01'=> $bango,
                        'dataint06'=>1,
                        'denpyoshimebi'=>date("Y-m-d H:i:s"),
                        'tantousyabango'=>$bango
                    ];

                    $check_order=QueryHelper::updateData('hikiatenyuko', $hikiatenyuko, 'syouhinid', $bango, __CLASS__, __FUNCTION__, __LINE__,null,null,null,$date_check,'denpyoshimebi');

                    if (gettype($check_order)!='Object' && $check_order=='check_ng') {
                        pg_query($conn, "ROLLBACK");
                        return 3;
                    }
                }
                else{
                    array_push($updatedSyouhinIdArr,$value);
                }

            }
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### purchaseOrder102_update end\n";
            pg_query($conn, 'COMMIT');
            if (count($updatedSyouhinIdArr)==0){
                session()->flash('success_msg', '検印処理を行いました。');
                return 1;
            }else{
                /*$s_msg='';
                $p_start='<p>';
                $p_end='</p>';
                foreach ($updatedSyouhinIdArr as $k=>$v){
                    if ($k==0){
                        $s_msg= $p_start.'作成済み。'.'(' . $v . ')'.$p_end ;
                    }

                    else{
                        $s_msg=$s_msg . $p_start.'作成済み。'.'(' . $v . ')'.$p_end ;
                    }
                }*/
                $e_msg='該当するデータがありません。';
//                dd($s_msg);
                session()->flash('error_msg', $e_msg);
                return 1;
            }
        }catch(\Exception $e){
            pg_query($conn, 'ROLLBACK');
            return 2;
//            return $e;
        }

    }

    public function purchasePdfCreate(Request $request){
        $syouhinIds=$request['syouhinIds'];
        $syouhinIdDates=$request['syouhinIdDates'];
        $correctionOrders=$request['correctionOrders'];
        $bango=$request['userId'];
        //dd($syouhinIds,$syouhinIdDates);
//        return [$syouhinIds,$syouhinIdDates,$bango];

        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### purchaseOrder102_update start\n";
        QueryHandler::logger($bango, $log_data);
        $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
        pg_query($conn, 'BEGIN');
        try{
            $createdPdfSyouhinIdArr=[];
            foreach ($syouhinIds as $key => $value) {
                $orderhenkanData = QueryHelper::fetchSingleResult("
                                    select
                                    orderhenkan.bango,
                                    orderhenkan.datachar09,
                                    orderhenkan.orderuserbango,
                                    tuhanorder.information1,
                                    tuhanorder.information2,
                                    tuhanorder.information3,
                                    left (kokyaku1.address,8)|| '_' || left (minyuko.datachar08,12) || '_' || orderhenkan.kokyakuorderbango as address
                                    from orderhenkan
                                    left join tuhanorder
                                    on tuhanorder.juchubango = orderhenkan.orderuserbango
                                    left join kokyaku1
                                    on kokyaku1.yobi12 = left (orderhenkan.datachar08,6)
                                    left join minyuko
                                    on minyuko.syouhinid = orderhenkan.kokyakuorderbango
                                    where kokyakuorderbango = '$value' and ordertypebango2 = '$correctionOrders[$key]'");
//                return [$orderhenkanData,$value,$correctionOrders[$key]];
                $first_condition_check=QueryHelper::fetchResult("select hikiatenyuko.dataint03 from hikiatenyuko where hikiatenyuko.syouhinid = '$value' limit 1");
                if (!empty($first_condition_check) && $first_condition_check[0]->dataint03!=1){
                    /*$reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7301'");
                    $orderbango = $reviewData->orderbango + 1;*/
                    $reviewData1 = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7301'");
                    if ($reviewData1) {
                        $orderbango = $reviewData1->orderbango + 1;
                        $mobile_flag = $reviewData1->mobile_flag;
                    } else {
                        $orderbango = "";
                        $mobile_flag = "";
                    }
                    $reviewData2 = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7501'");
                    if ($reviewData2) {
                        $orderbango2 = $reviewData2->orderbango;
                    } else {
                        $orderbango2 = "";
                    }
                    $modified_orderbango = "21" . $orderbango2 . str_pad($orderbango, $mobile_flag, '0', STR_PAD_LEFT);
//                    $date_check=$syouhinIdDates[$key];  //for multiuser update data
//                    dd('hlw');
                    $query = PdfData::data($bango,$value,$correctionOrders[$key])->toSql();
                    $purchasePdfData = QueryHelper::fetchResult($query);
                    $purchasePdfData = collect($purchasePdfData);
                    /*$con_of_blank_row=count($purchasePdfData)%3;
                    $con_of_blank_row=$con_of_blank_row!=0;
                    $count_data=count($purchasePdfData);
                    $count_data=8;
                    $no_of_page=intval($count_data/3);
                    if ($count_data%3==0){
                        $no_of_page=$no_of_page;
                    }else{
                        $no_of_page=$no_of_page+1;
                    }


                    $actual_row_show=$no_of_page*3;
                    $no_of_blank_row=0;
                    if ($count_data<$actual_row_show){
                        $no_of_blank_row=$actual_row_show-$count_data;
                    }
                    dd($count_data%3,$con_of_blank_row,$no_of_page,$count_data,$actual_row_show,$no_of_blank_row);*/
                    //pdf create start here
                    $pdf = PDF::loadView('purchase.purchaseOrder.pdfCreation.pdf',['data'=>$purchasePdfData]);

                    if (!file_exists('pdf/purchaseOrder')) {
                        mkdir('pdf/purchaseOrder', 0777, true);
                    }
                    $pdf_name = explode("-",$purchasePdfData[0]->order_number_update)[0].explode("-",$purchasePdfData[0]->order_number_update)[1]."hac.pdf";
                    $destination = public_path('pdf/purchaseOrder/'.$pdf_name);

                    file_put_contents($destination, $pdf->output());
                    //pdf create end here

                    //update review data
                    $review_update_data = [
                        'kokyakusyouhinbango' => 'D7301',
                        'orderbango' => $orderbango,
                        'check_flag' => 0,
                        'color' => static::getCurrentTime(),
                        //'size' => Helper::getSystemIP(),
                        'nickname' => $bango,
                    ];
                    QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);

                    $orderhenkan=[
                        'kokyakuorderbango' => $value,
                        'ordertypebango2'=> $correctionOrders[$key],
                        'datatxt0151'=>$modified_orderbango,
                        'date0017'=>date("Y-m-d H:i:s"),
                        'datatxt0155'=>$bango,
                    ];
                    QueryHelper::updateData('orderhenkan', $orderhenkan, ['kokyakuorderbango'=>$value,'ordertypebango2'=>$correctionOrders[$key]], $bango, __CLASS__, __FUNCTION__, __LINE__);
                    $hikiatenyuko=[
                        'syouhinid' => $value,
                        'dataint03'=>1,
                    ];
                    QueryHelper::updateData('hikiatenyuko', $hikiatenyuko, 'syouhinid', $bango, __CLASS__, __FUNCTION__, __LINE__);



                    $soukonyuko=[
                        'orderbango' => $orderhenkanData->bango,
                        'syouhinid' => $value,
                        'datachar01'=>$modified_orderbango,
                        'datachar02' => $orderhenkanData->information1,
                        'datachar03'=>$orderhenkanData->information2,
                        'datachar04' => $orderhenkanData->information3,
                        'datachar05'=>$orderhenkanData->orderuserbango,
                        'datachar06' => $orderhenkanData->datachar09,
                        'datachar07'=>'H109',
                        'datachar08' => $orderhenkanData->address,
                        'datachar09'=>$pdf_name,
                        'datachar10' => 'H910',
                        'datachar11'=>date("Y-m-d H:i:s"),
                        'datachar12' => null,
                        'datachar13'=>$bango,
                        'dataint25' => '0',

                    ];
                    QueryHelper::insertData('soukonyuko',$soukonyuko,'orderbango',false,$bango,__CLASS__,__FUNCTION__,__LINE__);
//                    QueryHelper::updateData('soukonyuko', $soukonyuko, 'syouhinid', $bango, __CLASS__, __FUNCTION__, __LINE__);
//                    dd('hlw');
                    //for multiuser update
                    /*$check_order=QueryHelper::updateData('hikiatenyuko', $hikiatenyuko, 'syouhinid', $bango, __CLASS__, __FUNCTION__, __LINE__,null,null,null,$date_check,'denpyoshimebi');
                    if (gettype($check_order)!='Object' && $check_order=='check_ng') {
                        pg_query($conn, "ROLLBACK");
                        return 3;
                    }*/
                }
                else{
                    array_push($createdPdfSyouhinIdArr,$value);
                }

            }
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### purchaseOrder102_update end\n";
            pg_query($conn, 'COMMIT');
//            return 'ok';
            if (count($createdPdfSyouhinIdArr)==0){
                session()->flash('success_msg', '処理が正常に終了しました。');
                return 1;
            }else{
                /*$s_msg='';
                $p_start='<p>';
                $p_end='</p>';
                foreach ($createdPdfSyouhinIdArr as $k=>$v){
                    if ($k==0){
                        $s_msg= $p_start.'PDF未作成のデータです。'.'(' . $v . ')'.$p_end ;
                    }

                    else{
                        $s_msg=$s_msg . $p_start.'PDF未作成のデータです。'.'(' . $v . ')'.$p_end ;
                    }
                }*/
                $e_msg='該当するデータがありません。';
//                dd($s_msg);
                session()->flash('error_msg', $e_msg);
                return 1;
            }
        }catch(\Exception $e){
            pg_query($conn, 'ROLLBACK');
            return 2;
//            dd($e) ;
        }

    }

    public function purchaseSendEmail(Request $request){
        $syouhinIds=$request['syouhinIds'];
        $syouhinIdDates=$request['syouhinIdDates'];
        $correctionOrders=$request['correctionOrders'];
        $bango=$request['userId'];
        //dd($syouhinIds,$syouhinIdDates);
//        return [$syouhinIds,$syouhinIdDates,$bango];

        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### purchaseOrder102_update start\n";
        QueryHandler::logger($bango, $log_data);
        $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
        pg_query($conn, 'BEGIN');
        try{
            $sentEmailSyouhinIdArr=[];
            $newEmailSyouhinIdArr=[];
            foreach ($syouhinIds as $key => $value) {
                $orderhenkanData = QueryHelper::fetchSingleResult("
                                    select
                                    orderhenkan.bango,
                                    soukonyuko.datachar09,
                                    tantousya.mail,
                                    kokyaku1.name as kokyaku1_name,
                                    orderhenkan.datachar08,
                                    haisou.name,
                                    etsuransya.mail2,
                                    etsuransya.tantousya



                                    from orderhenkan
                                    join soukonyuko
                                    on  soukonyuko.datachar01 =  orderhenkan.datatxt0151
                                    and soukonyuko.orderbango = orderhenkan.bango
                                    left join tantousya
                                    on tantousya.bango = orderhenkan.datachar09
                                    left join kokyaku1
                                    on kokyaku1.yobi12 = left (orderhenkan.datachar08,6)
                                    left join haisou
                                    on haisou.shikibetsucode = left(orderhenkan.datachar08,6)
                                    and haisou.torihikisakibango = substring (orderhenkan.datachar08,7,2)
                                    left join etsuransya
                                    on etsuransya.datatxt0014||etsuransya.datatxt0015||etsuransya.datatxt0049 = orderhenkan.datachar08
                                    where kokyakuorderbango = '$value' and ordertypebango2 = '$correctionOrders[$key]'");
//                return [$orderhenkanData,$value,$correctionOrders[$key]];
                $first_condition_check=QueryHelper::fetchResult("select hikiatenyuko.dataint03 from hikiatenyuko where hikiatenyuko.syouhinid = '$value' limit 1");
//                dd($first_condition_check);
                if (!empty($first_condition_check) && $first_condition_check[0]->dataint03 ==1){
                    $date_time = static::getCurrentTime();
//                    dd($date_time);
                    if (!empty($orderhenkanData)){
                        $pdf_name=$orderhenkanData->datachar09;
                    }else{
                        return 191;
                        //orderhenkanData pdf name not found(spec changed)
                    }

                    $fromMail=env('MAIL_FROM');
                    $mailFlag=env('MAIL_SEND_CONTROL','NONE');
//                    dd($orderhenkanData);

                    $ccMail=($orderhenkanData->mail)?$orderhenkanData->mail:null;
                    $vendorName=$orderhenkanData->kokyaku1_name;
                    $address=$orderhenkanData->name;
                    $departmentName=$orderhenkanData->mail2.$orderhenkanData->tantousya;
                    $departmentNameFlag=$orderhenkanData->mail2;
                    $vendorPersonalName=$orderhenkanData->tantousya;
                    $correctionOrder=strlen(strval($correctionOrders[$key]));
//                    dd($correctionOrders,$correctionOrder);
                    if ($correctionOrder==1){
                        $correctionOrder='0'.$correctionOrders[$key];
                    }
                    else{
                        $correctionOrder=$correctionOrders[$key];
                    }
//                    dd($correctionOrders,$correctionOrder);
                    $orderNumber=$value.'-'.$correctionOrder;
                    $passDate=date('r'); //RFC 2822 - Internet Message Format
//dd($orderhenkanData,$orderNumber,$departmentName,$passDate,$vendorPersonalName);
                    //getting pass
                    $datatxt0014= substr($orderhenkanData->datachar08, 0,6);
                    $datatxt0015= substr($orderhenkanData->datachar08, 6,2);
                    $datatxt0049= substr($orderhenkanData->datachar08, 8,3);
//                    dd($datatxt0049);
                    $password=null;
                    $kokyaku = QueryHelper::select(['*,substring(address,1,5) as address'])->from('kokyaku1')->where("yobi12 = '$datatxt0014' ")->get()->first();

                    $haisou = QueryHelper::select(['*,substring(haisoumoji1,1,3) as haisoumoji1'])->from('haisou')->where("shikibetsucode = '$datatxt0014' ")->where("torihikisakibango = '$datatxt0015' ")->get()->first();
//dd($haisou);
                    $others2 = QueryHelper::fetchResult("select * from others2 where otherint1 = (select bango from haisou where haisou.shikibetsucode = '$datatxt0014' and haisou.torihikisakibango = '$datatxt0015')");
                    if (strpos($others2[0]->other1, '1')===false) {
                        $password = $others2[0]->other12;
                    }else{
                        $password = $kokyaku->mail_toiawase;
                    }
                    if ($password==null){
                        return 404;
                    }
//                    dd($password==null,$password,$others2[0]->other1,$others2[0]->other12,$kokyaku->mail_toiawase,$datatxt0014,$datatxt0015);
                    $etsuransya = QueryHelper::fetchResult("select mail1,mail2,substring(mail4,1,3) as mail4,tantousya from etsuransya where datatxt0014= '$datatxt0014' and datatxt0015= '$datatxt0015' and datatxt0049= '$datatxt0049'");

                    $toMial=($etsuransya[0]->mail1)?$etsuransya[0]->mail1:null;
                    if (!filter_var($toMial, FILTER_VALIDATE_EMAIL)) {
                        return 22;
                    }
//                    dd($etsuransya);
                    $zip_name = $date_time.'_'.$datatxt0014.$datatxt0015."_hac";
                    if(!file_exists('zip/purchaseOrder/')){
                        mkdir('zip/purchaseOrder/',0777,true);
                    }
                    $zipFileName = 'zip/purchaseOrder/'.$zip_name.'.zip';



                    $zip = new ZipArchive;

                    if (!file_exists('zip')) {
                        mkdir('zip', 0777, true);
                    }

                    if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE)
                    {
//dd($password);
                        if (!$zip->setPassword($password)) {
                            throw new \RuntimeException('Set password failed');
                        }
                        // compress file
                        $fileName = 'pdf/purchaseOrder/'.$pdf_name;
                        $baseName = basename($fileName);
                        if (!$zip->addFile($fileName, $baseName)) {
                            throw new \RuntimeException(sprintf('Add file failed: %s', $fileName));
                        }

                        if (!$zip->setEncryptionName($baseName, ZipArchive::EM_AES_128)) {
                            throw new \RuntimeException(sprintf('Set encryption failed: %s', $baseName));
                        }
                        $zip->close();
                    } else {
                        echo 'failed';
                    }

                    $zipPack='zip/purchaseOrder/'.$zip_name.'.zip';
//                    dd($zipPack);
                    if ($toMial == null OR empty($ccMail)) {
                        return 21;
                    }
//                     dd($toMial,$ccMail,$fromMail);
                    if ($mailFlag == "NONE") {
                        return 33;
                    }elseif($mailFlag == "COLGIS" and $toMial != null){

                        if (strpos($toMial, 'colgis') !== false) {
//                            dd('hlw');
                            Mail::send(new mailZipPurchaseOrder($ccMail,$vendorName,$address,$departmentName,$departmentNameFlag,$vendorPersonalName,$orderNumber,$toMial,$zipPack,$fromMail));
//dd('hlw');
                            if (count(Mail::failures()) > 0) {
                               return (Mail::failures());
                             };
                            sleep(1);
                            Mail::send(new mailPasswordPurchaseOrder($password,$passDate,$toMial,$ccMail,$zipPack,$fromMail));
                            if (count(Mail::failures()) > 0) {
                               return (Mail::failures());
                             };
//                            return 1111;
                            array_push($newEmailSyouhinIdArr,$value);
                            $hikiatenyuko=[
                                'syouhinid' => $value,
                                'dataint05'=>1,
                            ];
                            QueryHelper::updateData('hikiatenyuko', $hikiatenyuko, 'syouhinid', $bango, __CLASS__, __FUNCTION__, __LINE__);
                        }
                        else{
                            return 44;
                        }
                    }elseif ($mailFlag == "ALL" and $toMial != null) {
//                        dd('hlw1');
                        Mail::send(new mailZipPurchaseOrder($ccMail,$vendorName,$address,$departmentName,$departmentNameFlag,$orderNumber,$toMial,$zipPack,$fromMail));
                        if (count(Mail::failures()) > 0) {
                            return (Mail::failures());
                        };
                        sleep(1);
                        Mail::send(new mailPasswordPurchaseOrder($password,$passDate,$toMial,$ccMail,$zipPack,$fromMail));
                        if (count(Mail::failures()) > 0) {
                            return (Mail::failures());
                        };
                        array_push($newEmailSyouhinIdArr,$value);
                        $hikiatenyuko=[
                            'syouhinid' => $value,
                            'dataint05'=>1,
                        ];
                        QueryHelper::updateData('hikiatenyuko', $hikiatenyuko, 'syouhinid', $bango, __CLASS__, __FUNCTION__, __LINE__);
                    }
                }
                else{
                    array_push($sentEmailSyouhinIdArr,$value);
                }

            }
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### purchaseOrder102_update end\n";
            pg_query($conn, 'COMMIT');
//            return 'ok';
            if (count($sentEmailSyouhinIdArr)==0){
                $no_of_email_sent=count($newEmailSyouhinIdArr);
                $s_msg='メールを '.$no_of_email_sent.' 件送信しました。';
                session()->flash('success_msg', $s_msg);
                return 1;
            }else{
                /*$s_msg='';
                $p_start='<p>';
                $p_end='</p>';
                foreach ($sentEmailSyouhinIdArr as $k=>$v){
                    if ($k==0){
                        $s_msg= $p_start.' 該当するデータがありません。'.'(' . $v . ')'.$p_end ;
                    }

                    else{
                        $s_msg=$s_msg . $p_start.' 該当するデータがありません。'.'(' . $v . ')'.$p_end ;
                    }
                }*/
                $e_msg='該当するデータがありません。';
//                dd($s_msg);
                session()->flash('error_msg', $e_msg);
                return 1;
            }
        }catch(\Exception $e){
            pg_query($conn, 'ROLLBACK');
            return 55;
//            return $e;
        }
    }

    public function downloadPurchaseOrderPdfConfirm(Request $request){
//        dd($request->all());
        $pdfName=$request->pdfName;
        $pdfOrderNo=$request->pdfOrderNo;
        $pdfCorrectionNo=$request->pdfCorrectionNo;
        $bango=$request->userId;
//        dd($pdfName,$pdfOrderNo,$pdfCorrectionNo,$bango);

        $path='pdf/purchaseOrder/'.$pdfName;
        if(file_exists($path)==false){
            return 0;
        }
        else if (substr($pdfName, -4) != '.pdf' || $pdfName == ""){
            return 1;
        }
        else{
            return 3;

        }
    }

    public function downloadPurchaseOrderPdf(Request $request){
//        dd($request->all());
        $pdfName=$request->pdfName;
        $pdfOrderNo=$request->pdfOrderNo;
        $pdfCorrectionNo=$request->pdfCorrectionNo;
        $bango=$request->userId;
//        dd($pdfName,$pdfOrderNo,$pdfCorrectionNo,$bango);

        $file= public_path('pdf/purchaseOrder/'.$pdfName);

        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response()->download($file, $pdfName, $headers);
    }

    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        /*$pageNo = PurchaseOrderHeaders::$page_no;
        return $Setting = TableSetting::setting($this->headers, $id, $pageNo);*/
        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $id)->where('kengenchar05', '05-03')->get()->count();
        $pageNo = PurchaseOrderHeaders::$page_no;
        //return $Setting = TableSetting::setting($this->headers, $id, $pageNo);
        $Setting = TableSetting::setting($this->headers, $id, $pageNo);
        if($initial_header == 0){
            $Setting['supplier_quotation_number'] = "";
            $Setting['total_order_amount'] = "";
            $Setting['purchase_consumption_tax'] = "";
            $Setting['end_customer'] = "";
            $Setting['order_history_creation_flag'] = "";
            $Setting['checker'] = "";
        }
        return $Setting;
    }

    public function tableSettingSave(Request $request, $id, $bango, $type = null)
    {
        $pageNo = PurchaseOrderHeaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '社員マスタ', $type);
    }

    private function modifyBladeData($alldata,$index){
        $newArr=[];

        foreach ($index as $key => $value) {
            $newArr[$value]=!empty($alldata[$value])?$alldata[$value]:null;
        }
        return $newArr;
    }

    public static function getCurrentTime(){
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        return str_replace(" ", "", $mytime);
    }
}
