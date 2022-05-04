<?php

namespace App\Http\Controllers\purchase;

use App\AllClass\ButtonMsg;
use App\AllClass\db\QueryHandler;
use App\AllClass\purchase\purchaseDetails\AllPurchaseDetails;
use App\AllClass\purchase\purchaseDetails\PurchaseDetails1Headers;
use App\AllClass\purchase\purchaseDetails\PurchaseDetails2Headers;
use App\AllClass\TableSetting;
use App\Http\Controllers\Controller;
use App\kengen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\tantousya;
use Exception;
use Illuminate\Support\Facades\Session;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

class PurchaseDetailsController extends Controller
{
    private $headers = [
        '発注予定日' => 'order_date',
        '個別納期' => 'delivery_date',
        '仕入先' => 'vendor',
        '品名' => 'name',
        '数量' => 'purchase_details1_quantity',
        '単価' => 'purchase_details1_unit_price',
        '金額' => 'purchase_details1_amount',
        '発注作成' => 'create_order',
        '受注番号行番号枝番' => 'order_line_branch_no'
    ];
    private $headers2 = [
        '仕入番号行番号' => 'line_no',
        '仕入日' => 'purchase_date',
        '仕入先' => 'vendor2',
        '納品書番号' => 'invoice_no',
        '品名' => 'name2',
        '数量' => 'purchase_details2_quantity2',
        '単価' => 'purchase_details2_unit_price2',
        '金額' => 'purchase_details2_amount2',
        '発注番号行番号' => 'order_line_no',
        '発注金額分類' => 'classification'
    ];
    public function postPurchaseDetails(Request $request)
    {
        /*$sql = "DELETE FROM kengensettei where kengenchar05::text LIKE '%06-23-1%' and kengenchar01::text LIKE '%col%'";
        QueryHelper::runQuery($sql);
        $sql = "DELETE FROM kengensettei where kengenchar05::text LIKE '%06-23-2%' and kengenchar01::text LIKE '%col%'";
        QueryHelper::runQuery($sql);*/
        $bango = request('userId');
        $data_from_view = $request->all();
        session()->put('oldInput' . $bango, $data_from_view);
        $tantousya = tantousya::find($bango);

        $headers = PurchaseDetails1Headers::headers($bango);
        $table_headers = PurchaseDetails1Headers::headers($bango, 'table_headers');
        $headers2 = PurchaseDetails2Headers::headers($bango);
        $table_headers2 = PurchaseDetails2Headers::headers($bango, 'table_headers');
        $route = 'purchaseDetailsTableSetting';
        $route2 = 'purchaseDetailsTableSetting2';
        $redirect_path = 'purchaseDetailsReload';


        $buttonMessage = ButtonMsg::read($bango);

        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 20;
        }
        if (!empty(request('pagination2'))) {
            $pagination2 = request('pagination2');
        } else {
            $pagination2 = 20;
        }
        $purchaseDetailsError='';
        $purchaseDetailsSuccess='';

        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $bango)->where('kengenchar05', '06-23-1')->get()->count();
        if($initial_header == 0){
            unset($headers['受注番号行番号枝番']);
        }
        $initial_header2 = kengen::where('kengenchar01', 'col')->where('kengenchar03', $bango)->where('kengenchar05', '06-23-2')->get()->count();
        if($initial_header2 == 0){
            unset($headers2['発注番号行番号']);
            unset($headers2['発注金額分類']);
        }

//        dd($data_from_view);
        if (!empty($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' ) && (isset($data_from_view['order_no']))) {
            //dd($request->all());
            //for 1st table
            if ($data_from_view['tableType']=='orderDataTable'){
                //dd($request->all());
                $fsRemoveTableKeys=['order_date', 'order_date_sort', 'delivery_date' ,'delivery_date_sort', 'vendor', 'name',
                                    'purchase_details1_quantity', 'purchase_details1_quantity_sort', 'purchase_details1_unit_price',
                                    'purchase_details1_unit_price_sort', 'purchase_details1_amount', 'purchase_details1_amount_sort',
                                    'create_order','order_line_branch_no','sortField','sortType'];
                $table1keys=['line_no', 'purchase_date', 'vendor2' ,'invoice_no', 'name2', 'purchase_details_quantity2', 'purchase_details_quantity2_sort',
                    'purchase_details_unit_price2','purchase_details_unit_price2_sort', 'purchase_details_amount2','purchase_details_amount2_sort', 'order_line_no',
                    'classification','sortField','sortType'];
                $fsReqData= $this->removeDataFromView($data_from_view, $fsRemoveTableKeys);

                if (Session::has('old2Input' . $bango)){
                    $old2 = $this->makeTableKeysValNull(session()->get('old2Input' . $bango),$table1keys);
                }
                else{
                    $old2 = [];
                }

                session()->put('old1Input' . $bango, $request->all());
                $old = $request->all();
                $temp_table= "purchase_details1_temp";

                try {
                    if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort') {
                        //dd($data_from_view);
                        $formatted_int_fields=['purchase_details1_quantity_sort','purchase_details1_unit_price_sort','purchase_details1_amount_sort'];
                        $formatted_date_fields=['order_date_sort','delivery_date_sort'];
                        $allTableRequest = $this->modifyBladeData($data_from_view, $fsRemoveTableKeys);

                        foreach ($allTableRequest as $key => $value) {
                            if ((in_array($key, $formatted_date_fields) || in_array($key, $formatted_int_fields)) && $value!=null) {
                                $allTableRequest[$key] = str_replace(array('/', ':',',',' '),'',$value);
                            }

                        }

                        $query= AllPurchaseDetails::readData($bango,$fsReqData);

                        $purchaseDetailsInfos = collect(QueryHelper::fetchResult($query[0]));
                        $purchaseDetails2Infos = collect(QueryHelper::fetchResult($query[2]))->paginate(20);

                        $purchaseDetails1Infos = $this->searchDataFetch($query[1], $allTableRequest, $bango, $temp_table, $pagination);

                        if ($purchaseDetails1Infos->items() == null && $purchaseDetails1Infos->currentPage() != 1) {
                            $currentPage = ($purchaseDetails1Infos->lastPage());
                            Paginator::currentPageResolver(function () use ($currentPage) {
                                return $currentPage;
                            });
                            $purchaseDetails1Infos = $this->searchDataFetch($query[1], $allTableRequest, $bango, $temp_table, $pagination);
                        }

                        if ($purchaseDetails1Infos->total() == 0) {
                            if(Session::has('defaultSrc')){
                                if (Session::get('defaultSrc')=='1'){
                                    $purchaseDetailsError = '該当するデータがありません。';
                                }
                                else{
                                    $purchaseDetailsError = '';
                                }
                            }
                            else{
                                $purchaseDetailsError = '';
                            }
                        } else {
                            $purchaseDetailsError = '';
                        }
                    }
                    else if ($data_from_view['Button'] == 'xls') {
                        $query= AllPurchaseDetails::readData($bango,$fsReqData);
                        $allTableRequest = $this->modifyBladeData($data_from_view, $fsRemoveTableKeys);
                        $searched = $this->searchDataFetch($query[1], $allTableRequest, $bango, $temp_table, $pagination, 'xls');
                        $headers = $this->headers;
                        $excelName = '仕入実績明細.xlsx';
                        return $this->excelDownload($headers, $searched, $excelName);
                    }
                } catch (\Exception $e) {
                    //dd($e);
                    $query= AllPurchaseDetails::readData($bango,$data_from_view);
                    $purchaseDetailsInfos = collect(QueryHelper::fetchResult($query[0]));
                    $purchaseDetails2Infos =collect([])->paginate($pagination2);
                    $purchaseDetails1Infos =collect([])->paginate($pagination);
                    if ($purchaseDetails1Infos->total() == 0) {
                        if(Session::has('defaultSrc')){
                            if (Session::get('defaultSrc')=='1'){
                                $purchaseDetailsError = '該当するデータがありません。';
                            }
                            else{
                                $purchaseDetailsError = '';
                            }
                        }
                        else{
                            $purchaseDetailsError = '';
                        }
                    } else {
                        $purchaseDetailsError = '';
                    }
                }
            }
            //for 2nd table
            elseif ($data_from_view['tableType']=='purchaseDataTable'){
            //dd('purchaseDetailsTable');
                $fsRemoveTableKeys=['line_no', 'purchase_date', 'vendor2' ,'invoice_no', 'name2', 'purchase_details2_quantity2', 'purchase_details2_quantity2_sort',
                    'purchase_details2_unit_price2','purchase_details2_unit_price2_sort', 'purchase_details2_amount2','purchase_details2_amount2_sort', 'order_line_no', 'classification','sortField','sortType'];
                $table1Keys=['order_date', 'order_date_sort', 'delivery_date' ,'delivery_date_sort', 'vendor', 'name',
                    'purchase_details1_quantity', 'purchase_details1_quantity_sort', 'purchase_details1_unit_price', 'purchase_details1_unit_price_sort', 'purchase_details1_amount', 'purchase_details1_amount_sort',
                    'create_order','order_line_branch_no','sortField','sortType'];

                session()->put('old2Input' . $bango, $request->all());
                $old2 = $request->all();
                if (Session::has('old1Input' . $bango)){
                    $old = $this->makeTableKeysValNull(session()->get('old1Input' . $bango),$table1Keys);
                }
                else{
                      $old['tableType'] = "orderDataTable";
                      $old['Button'] = "Thesearch";
                      $old['sortField'] = null;
                      $old['sortType'] = null;
                      $old['userId'] = $old2['userId'];
                      $old['_token'] = $old2['_token'];
                      $old['order_no'] = $old2['order_no'];
                      $old['page'] = "1";
                      $old['pagination'] = "20";
                      $old['order_date_sort'] = null;
                      $old['delivery_date_sort'] = null;
                      $old['vendor'] = null;
                      $old['name'] = null;
                      $old['purchase_details1_quantity_sort'] = null;
                      $old['purchase_details1_unit_price_sort'] = null;
                      $old['purchase_details1_amount_sort'] = null;
                      $old['create_order'] = null;
                      $old['order_line_branch_no'] = null;
                }

                $fsReqData= $this->removeDataFromView($data_from_view, $fsRemoveTableKeys);
                $temp_table= "purchase_details2_temp";

                try {
                    if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort') {
                        //dd($data_from_view);
                        $formatted_int_fields=['purchase_details2_quantity2_sort','purchase_details2_unit_price2_sort','purchase_details2_amount2_sort'];
                        $formatted_date_fields=['purchase_date_sort'];
                        $allTableRequest = $this->modifyBladeData($data_from_view, $fsRemoveTableKeys);

                        foreach ($allTableRequest as $key => $value) {
                            if ((in_array($key, $formatted_date_fields) || in_array($key, $formatted_int_fields)) && $value!=null) {
                                $allTableRequest[$key] = str_replace(array('/', ':',',',' '),'',$value);
                            }
                        }
                        $query= AllPurchaseDetails::readData($bango,$fsReqData);

                        $purchaseDetailsInfos = collect(QueryHelper::fetchResult($query[0]));
                        if ($old2['order_no']== null){
                            $purchaseDetails1Infos = collect([])->paginate(20);
                        }
                        else{
                            $purchaseDetails1Infos = Session::get('purchaseDetails1Infos'.$bango);
                            if ($purchaseDetails1Infos->items() == null && $purchaseDetails1Infos->currentPage() != 1) {
                                $currentPage = ($purchaseDetails1Infos->lastPage());
                                Paginator::currentPageResolver(function () use ($currentPage) {
                                    return $currentPage;
                                });
                                $purchaseDetails1Infos = Session::get('purchaseDetails1Infos'.$bango);
                            }
                        }

                        $purchaseDetails2Infos = $this->searchDataFetch($query[2], $allTableRequest, $bango, $temp_table, $pagination2);
                        if ($purchaseDetails2Infos->items() == null && $purchaseDetails2Infos->currentPage() != 1) {
                            $currentPage = ($purchaseDetails2Infos->lastPage());
                            Paginator::currentPageResolver(function () use ($currentPage) {
                                return $currentPage;
                            });
                            $purchaseDetails2Infos = $this->searchDataFetch($query[2], $allTableRequest, $bango, $temp_table, $pagination2);
                        }
                        if ($purchaseDetails2Infos->total() == 0) {
                            if(Session::has('defaultSrc')){
                                if (Session::get('defaultSrc')=='1'){
                                    $purchaseDetailsError = '該当するデータがありません。';
                                }
                                else{
                                    $purchaseDetailsError = '';
                                }
                            }
                            else{
                                $purchaseDetailsError = '';
                            }
                        } else {
                            $purchaseDetailsError = '';
                        }
                    }
                    else if ($data_from_view['Button'] == 'xls') {
                        $query= AllPurchaseDetails::readData($bango,$fsReqData);
                        $allTableRequest = $this->modifyBladeData($data_from_view, $fsRemoveTableKeys);
                        $searched = $this->searchDataFetch($query[2], $allTableRequest, $bango, $temp_table, $pagination2, 'xls');
                        $headers = $this->headers2;
                        $excelName = '仕入実績明細.xlsx';
                        return $this->excelDownload($headers, $searched, $excelName);
                    }
                } catch (\Exception $e) {
                    //dd($e);
                    $query= AllPurchaseDetails::readData($bango,$data_from_view);
                    $purchaseDetailsInfos = collect(QueryHelper::fetchResult($query[0]));
                    $purchaseDetails2Infos =collect([])->paginate($pagination2);
                    $purchaseDetails1Infos =collect([])->paginate($pagination);
                    if ($purchaseDetails1Infos->total() == 0) {
                        if(Session::has('defaultSrc')){
                            if (Session::get('defaultSrc')=='1'){
                                $purchaseDetailsError = '該当するデータがありません。';
                            }
                            else{
                                $purchaseDetailsError = '';
                            }
                        }
                        else{
                            $purchaseDetailsError = '';
                        }
                    } else {
                        $purchaseDetailsError = '';
                    }
                }
            }
            return view('purchase.purchaseDetails.mainPurchaseDetails',compact('bango','tantousya','purchaseDetailsInfos','purchaseDetails1Infos','purchaseDetails2Infos','fsReqData','old','old2','headers','headers2','buttonMessage','route','route2','redirect_path','table_headers','table_headers2','purchaseDetailsError'));
        }

        else if (!empty(request('firstButton')) && request('firstButton')== 'topSearch' || !empty(request('Button')) && request('Button') == 'refresh')
        {
            // dd($request->all());
            $old=[];
            $old2=[];
            session()->forget('old1Input'.$bango);
            session()->forget('old2Input'.$bango);
            $fsReqData= $request->all();
            $query= AllPurchaseDetails::readData($bango,$data_from_view);
            //dd($query);
            if ($query[0]=='ng'){
                $purchaseDetailsError = '該当するデータがありません。';
                $purchaseDetailsInfos=collect([]);
                $purchaseDetails1Infos =collect([])->paginate(20);
                $purchaseDetails2Infos =collect([])->paginate(20);
                session()->put('defaultSrc', '0');
                session()->forget('purchaseDetails1Infos'.$bango);
                session()->forget('purchaseDetails2Infos'.$bango);
            }
            else{
                if (count(QueryHelper::fetchResult($query[0]))==0){
                    $purchaseDetailsError = '該当するデータがありません。';
                    session()->put('defaultSrc', '0');
                }
                else{
                    $purchaseDetailsError = '';
                    session()->put('defaultSrc', '1');
//                    dd(Session::has('defaultSrc') , Session::get('defaultSrc'));
                }
                $purchaseDetailsInfos = collect(QueryHelper::fetchResult($query[0]));
                if (!empty(request('tableType')) && request('tableType')== 'purchaseDataTable' && request('Button')== 'refresh'){
                    $purchaseDetails1Infos =session()->get('purchaseDetails1Infos'.$bango);
                    $purchaseDetails2Infos =session()->get('purchaseDetails2Infos'.$bango);
                }
                else{
                    session()->forget('purchaseDetails1Infos'.$bango);
                    session()->forget('purchaseDetails2Infos'.$bango);
                    $purchaseDetails1Infos =collect(QueryHelper::fetchResult($query[1]))->paginate(20);
                    $purchaseDetails2Infos =collect(QueryHelper::fetchResult($query[2]))->paginate(20);
                    session()->put('purchaseDetails1Infos'.$bango, $purchaseDetails1Infos);
                    session()->put('purchaseDetails2Infos'.$bango, $purchaseDetails2Infos);
                }
            }
            return view('purchase.purchaseDetails.mainPurchaseDetails',compact('bango','tantousya','purchaseDetailsInfos','purchaseDetails1Infos','purchaseDetails2Infos','old','old2','fsReqData','headers','headers2','buttonMessage','route','route2','redirect_path','table_headers','table_headers2','purchaseDetailsError','purchaseDetailsSuccess'));
        }

        $old=null;
        $old2=null;
        session()->forget('old1Input'.$bango);
        session()->forget('old2Input'.$bango);
        session()->put('defaultSrc', '0');
        $purchaseDetailsInfos =collect([]);
        $purchaseDetails1Infos =collect([])->paginate(20);
        $purchaseDetails2Infos =collect([])->paginate(20);
        return view('purchase.purchaseDetails.mainPurchaseDetails',compact('bango','tantousya','purchaseDetailsInfos','purchaseDetails1Infos','purchaseDetails2Infos','old','old2','headers','headers2','buttonMessage','route','route2','redirect_path','table_headers','table_headers2','purchaseDetailsError','purchaseDetailsSuccess'));
    }
    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = PurchaseDetails1Headers::$page_no;
//        return $Setting = TableSetting::setting($this->headers, $id, $pageNo);
        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $id)->where('kengenchar05', '06-23-1')->get()->count();
        $Setting = TableSetting::setting($this->headers, $id, $pageNo);
        if($initial_header == 0){
            $Setting['order_line_branch_no'] = "";
        }
        return $Setting;
    }

    public function tableSettingSave(Request $request, $id, $bango, $type = null)
    {
        $pageNo = PurchaseDetails1Headers::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '仕入実績明細', $type);
    }

    public function tableSetting2($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = PurchaseDetails2Headers::$page_no;
//        return $Setting = TableSetting::setting($this->headers2, $id, $pageNo);
        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $id)->where('kengenchar05', '06-23-2')->get()->count();
        $Setting = TableSetting::setting($this->headers2, $id, $pageNo);
        if($initial_header == 0){
            $Setting['order_line_no'] = "";
            $Setting['classification'] = "";
        }
        return $Setting;
    }

    public function tableSetting2Save(Request $request, $id, $bango, $type = null)
    {
        $pageNo = PurchaseDetails2Headers::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers2, '仕入実績明細', $type);
    }

    private function modifyBladeData($alldata,$index){
        $newArr=[];

        foreach ($index as $key => $value) {
            $newArr[$value]=!empty($alldata[$value])?$alldata[$value]:null;
        }
        return $newArr;
    }

    private function makeTableKeysValNull($allData,$indexArr){
        $newArr=[];
        foreach ($allData as $key => $value) {
            if (in_array($key,$indexArr)){
                $newArr[$key]= null;
            }
            else{
                $newArr[$key] = $value;
            }
        }
        return $newArr;
    }

    public function validationCheck(Request $request){
        $req_order_no=$request->orderNo;
        $bango=$request->userId;
        $errorVal=null;
        try {
            QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_max");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_max AS
            SELECT DISTINCT
            kokyakuorderbango, max(ordertypebango2) as maxval
            FROM orderhenkan
            WHERE synchroorderbango =0
            AND datachar10 IS NULL
            AND kokyakuorderbango='$req_order_no'
            GROUP BY kokyakuorderbango ");

            $purchase_details_sql = "  where orderhenkan.datachar02 not in ('U160') and hikiatesyukko.kaiinid is null";

            QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_validation_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_validation_temp AS
            select distinct
            hikiatesyukko.datachar16,
            hikiatesyukko.datachar18,
            hikiatesyukko.syouhinid

            from orderhenkan
            join orderhenkan_max
            on orderhenkan_max.kokyakuorderbango=orderhenkan.kokyakuorderbango
            and orderhenkan_max.maxval=orderhenkan.ordertypebango2
            join hikiatesyukko
            on hikiatesyukko.syouhinid=orderhenkan.kokyakuorderbango
            $purchase_details_sql
            limit 1");
            $dataChar16Val=QueryHelper::fetchResult("select * from purchase_validation_temp");
            if (count($dataChar16Val)>0){
                if (($dataChar16Val[0]->datachar16=='1') && ($dataChar16Val[0]->datachar18!=null)){
                    $errorVal='0';
                }
                elseif (($dataChar16Val[0]->datachar16=='1') && ($dataChar16Val[0]->datachar18==null)){
                    $errorVal='1';
                }
                elseif (($dataChar16Val[0]->datachar16!='1') && ($dataChar16Val[0]->datachar18==null)){
                    $errorVal='2';
                }
                else{
                    $errorVal='ok';
                }
            }else{
                $errorVal= 'ng';
            }
        }
        catch (Exception $e){
            $errorVal= 'ng';
//            dd($e);
        }
        return $errorVal;
//        dd(QueryHelper::fetchResult("select * from purchase_validation_temp"));
    }

    public function updatePurchaseDetails(Request $request){
//        dd($request);
        $bango=$request->userId;
        $orderNo=$request->orderNo;
        $date_check=$request->idoutanabangoVal;  //taking the hikiatesyukko's pre datetime
        $instructorBango=$request->instructorBango;
        $inspectorBango=$request->inspectorBango;
        $status=null;
//        dd($bango,$orderNo,$date_check,$instructorBango,$inspectorBango);
        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### hikiatesyukko_update start\n";
        QueryHandler::logger($bango, $log_data);
        $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
        pg_query($conn, 'BEGIN');
        try{
            $hikiatesyukko=[
                'syouhinid' => $orderNo,
                'tantousyabango' => $bango,
                'idoutanabango'=> date("YmdHis"),
                'datachar17'=>$instructorBango,
                'datachar18'=>$inspectorBango
            ];

            $check_order=QueryHelper::updateData('hikiatesyukko', $hikiatesyukko, 'syouhinid', $bango, __CLASS__, __FUNCTION__, __LINE__,null,null,null,$date_check,'idoutanabango');

            if (gettype($check_order)!='Object' && $check_order=='check_ng') {
                pg_query($conn, "ROLLBACK");
                $status='2';
                return $status;
            }
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### hikiatesyukko update end\n";
            pg_query($conn, 'COMMIT');
            $status='1';
            return $status;
        }catch(\Exception $e){
            pg_query($conn, 'ROLLBACK');
            $status='0';
            return $status;
        }
    }
}
