<?php
namespace App\Http\Controllers\purchase;

use App\AllClass\ButtonMsg;
use App\AllClass\db\QueryHandler;
use App\AllClass\purchase\purchaseHistory\AllPurchaseHistory;
use App\AllClass\purchase\purchaseHistory\PurchaseHistoryHeaders;
use App\AllClass\purchase\purchaseHistory\PurchaseHistoryInquiry;
use App\AllClass\common\CreateHatchuDetails;
use App\AllClass\TableSetting;
use App\Http\Controllers\Controller;
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

class PurchaseHistoryController extends Controller
{
    private $headers = [
        '行' => 'line_no',
        '仕入先' => 'supplier',
        '区分' => 'classification',
        /*'仕入番号' => 'purchase_no',*/
        '仕入日' => 'purchase_date',
        '指検状態' => 'finger_test_information',
        '指示' => 'instructions_check',
        '検印' => 'stamp_check',
        '金額' => 'purchase_history_amount',
        '発注番号' => 'order_number',
        '受注先' => 'order_to',
        '最終顧客' => 'end_customer',
        '会計科目CD' => 'accounting_subject',
        '内訳CD' => 'breakdown',
        '仕入購入区分' => 'purchase_category',

        '作成区分' => 'creation_division',
        '仕入担当者' => 'purchaser',
        '納品書番号' => 'invoice_number',
        '納品書日付' => 'invoice_date',
        '伝票備考' => 'slip_remarks',
        '支払日' => 'payment_date',
        '仕入消費税額' => 'purchase_consumption_tax_amount',
        '仕入履歴作成フラグ' => 'purchase_history_creation_flag',
        '予備1' => 'spare1',
        '予備2' => 'spare2',
        '予備3' => 'spare3',
        '予備4' => 'spare4',
        '予備5' => 'spare5',
        '予備6' => 'spare6',
        'データ有効区分' => 'data_valid_segment',
        '登録年月日' => 'registration_date',

        '登録時刻' => 'registration_time',
        '更新者' => 'updater',
        '訂正回数' => 'number_of_corrections',
        '支払締め日' => 'payment_closing_date',
        '支払一括消費税額' => 'consumption_tax_paid',
        '仕入済区分' => 'purchased_segment',
        '前払区分' => 'prepayment_segment',
        '仮払仕入日' => 'provisional_purchase_date',
        '支払データ作成フラグ' => 'payment_data_creation_flag',
        '買掛残高更新フラグ' => 'accounts_payable_update_flag',
        '仕入購入指示者' => 'purchase_orderer',
        '仕入購入検印者' => 'purchase_seal_holder',
        '仕入会計データ作成フェーズ' => 'accounting_data_creation_phase',
        'フラグ予備1' => 'flag_reserve1'
    ];
    public function postPurchaseHistory(Request $request)
    {
        /*$sql = "DELETE FROM kengensettei where kengenchar05::text LIKE '%06-04%' and kengenchar01::text LIKE '%col%'";
                        QueryHelper::runQuery($sql);*/
        $systemDate=date('Y/m/d');
        $month_ini = new DateTime("first day of last month");
        $beforeSystemDate=$month_ini->format('Y/m/d');
        $lastYear = date("Y/m", strtotime("-1 years"));
        $lastYear = $lastYear.'/01';
        $bango = request('userId');
        $data_from_view = $request->all();
//        dd($data_from_view);
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
//        $datachar05 = QueryHelper::fetchResult("select * from tantousya where deleteflag = 0 and ztanka='$review_orderbango' order by bango");
        $datachar05 = QueryHelper::fetchResult("select * from tantousya where deleteflag = 0 and ztanka='$review_orderbango' and innerlevel >= 10 and innerlevel <= 20 order by bango");
        //accounting subject dropdown
        $data310 = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'J1' and suchi2 = 0 order by suchi1 ASC ");

        $headers = PurchaseHistoryHeaders::headers($bango);
        $table_headers = PurchaseHistoryHeaders::headers($bango, 'table_headers');
        $route = 'purchaseHistoryTableSetting';
        $redirect_path = 'purchaseHistoryReload';

        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $bango)->where('kengenchar05', '06-04')->get()->count();
        if($initial_header == 0){
            unset($headers['仕入購入区分']);
            unset($headers['作成区分']);
            unset($headers['仕入担当者']);
            unset($headers['納品書番号']);
            unset($headers['納品書日付']);
            unset($headers['伝票備考']);
            unset($headers['支払日']);
            unset($headers['仕入消費税額']);
            unset($headers['仕入履歴作成フラグ']);
            unset($headers['予備1']);
            unset($headers['予備2']);
            unset($headers['予備3']);
            unset($headers['予備4']);
            unset($headers['予備5']);
            unset($headers['予備6']);
            unset($headers['データ有効区分']);
            unset($headers['登録年月日']);
            unset($headers['登録時刻']);
            unset($headers['更新者']);
            unset($headers['訂正回数']);
            unset($headers['支払締め日']);
            unset($headers['支払一括消費税額']);
            unset($headers['仕入済区分']);
            unset($headers['前払区分']);
            unset($headers['仮払仕入日']);
            unset($headers['支払データ作成フラグ']);
            unset($headers['買掛残高更新フラグ']);
            unset($headers['仕入購入指示者']);
            unset($headers['仕入購入検印者']);
            unset($headers['仕入会計データ作成フェーズ']);
            unset($headers['フラグ予備1']);
        }

        $buttonMessage = ButtonMsg::read($bango);
        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 20;
        }
        $old = $request->all();
        $purchaseHistoryError='';
        $purchaseHistorySuccess='';
//        if($tantousya->innerlevel<=10 ) $privileged_user = true; else $privileged_user = false;
//        dd($request->all());

        if (!empty($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' )) {
//            dd($request->all());
            $fsRemoveTableKeys=['line_no', 'supplier', 'classification', 'purchase_no', 'purchase_date','finger_test_information', 'instructions_check', 'stamp_check','purchase_history_amount','order_number','order_to','end_customer', 'accounting_subject', 'breakdown', 'purchase_category',
                'creation_division','purchaser','invoice_number','invoice_date','slip_remarks','payment_date','purchase_consumption_tax_amount','purchase_history_creation_flag','spare1','spare2','spare3','spare4','spare5','spare6','data_valid_segment','registration_date',
                'registration_time','updater','number_of_corrections','payment_closing_date','consumption_tax_paid','purchased_segment','prepayment_segment','provisional_purchase_date','payment_data_creation_flag','accounts_payable_update_flag','purchase_orderer','purchase_seal_holder',
                'accounting_data_creation_phase','flag_reserve1','purchase_date_sort','purchase_history_amount_sort','payment_date_sort','purchase_consumption_tax_amount_sort','registration_date_sort','registration_time_sort','payment_closing_date_sort','invoice_date_sort','consumption_tax_paid_sort',
                'provisional_purchase_date_sort','sortField','sortType'];
            $fsReqData= $this->removeDataFromView($data_from_view, $fsRemoveTableKeys);
//            dd($fsReqData);
            $temp_table= "purchase_history_temp";

            try {
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort') {

//                    dd($data_from_view);
                    $formatted_int_fields=['purchase_history_amount_sort','purchase_consumption_tax_amount_sort','consumption_tax_paid_sort'];
                    $formatted_date_fields=['purchase_date_sort','payment_date_sort','registration_date_sort','registration_time_sort','provisional_purchase_date_sort','payment_closing_date_sort','invoice_date_sort'];
                    $allTableRequest = $this->modifyBladeData($data_from_view, $fsRemoveTableKeys);
//                    dd($allTableRequest);

                    foreach ($allTableRequest as $key => $value) {
                        if ((in_array($key, $formatted_date_fields) || in_array($key, $formatted_int_fields)) && $value!=null) {
//                            dd($value);
                            $allTableRequest[$key] = str_replace(array('/', ':',',',' '),'',$value);
                        }

                    }
//                    dd($allTableRequest,'hlw');
                    $query= AllPurchaseHistory::readData($bango,$fsReqData);

//                    dd($allTableRequest);

                    $purchaseHistoryInfos = $this->searchDataFetch($query, $allTableRequest, $bango, $temp_table, $pagination);
                    if ($purchaseHistoryInfos->items() == null && $purchaseHistoryInfos->currentPage() != 1) {
                        $currentPage = ($purchaseHistoryInfos->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $purchaseHistoryInfos = $this->searchDataFetch($query, $allTableRequest, $bango, $temp_table, $pagination);
                    }
//                    dd($purchaseOrderInfos->total());
                    if ($purchaseHistoryInfos->total() == 0) {
                        if(Session::has('defaultSrc')){
                            if (Session::get('defaultSrc')=='1'){
                                $purchaseHistoryError = '該当するデータがありません。';
                            }
                            else{
                                $purchaseHistoryError = '';
                            }
                        }
                        else{
                            $purchaseHistoryError = '';
                        }
                    } else {
                        $purchaseHistoryError = '';
                    }
                }
                else if ($data_from_view['Button'] == 'xls') {
//                    dd('are ruko jara...sabar karo');
                    $query= AllPurchaseHistory::readData($bango,$fsReqData);

                    $allTableRequest = $this->modifyBladeData($data_from_view, $fsRemoveTableKeys);

                    $searched = $this->searchDataFetch($query, $allTableRequest, $bango, $temp_table, $pagination, 'xls');
//                        dd($searched);
                    $headers = $this->headers;
                    /*$headers['発注消費税総額']='purchase_consumption_tax_show';
                    $headers['発注総額']='total_order_amount_show';*/
//                    dd($allTableRequest,$searched,$headers);
                    $excelName = '仕入購入履歴一覧・仕入照会.xlsx';
                    return $this->excelDownload($headers, $searched, $excelName);
                }
            } catch (\Exception $e) {
//                dd($e);
//                $purchaseOrderError = '検索形式が間違っています。';
                $purchaseHistoryInfos = collect([])->paginate($pagination);
                if ($purchaseHistoryInfos->total() == 0) {
                    if(Session::has('defaultSrc')){
                        if (Session::get('defaultSrc')=='1'){
                            $purchaseHistoryError = '該当するデータがありません。';
                        }
                        else{
                            $purchaseHistoryError = '';
                        }
                    }
                    else{
                        $purchaseHistoryError = '';
                    }
                } else {
                    $purchaseHistoryError = '';
                }
            }

            return view('purchase.purchaseHistory.mainPurchaseHistory',compact('bango','tantousya','B9Data_left','C1Data_left','C2Data_left','B9Data_right','C1Data_right','C2Data_right','datachar05','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','data310','systemDate','beforeSystemDate','lastYear','purchaseHistoryInfos','fsReqData','headers','buttonMessage','route','redirect_path','table_headers','purchaseHistoryError','old'));
        }

        else if (!empty(request('firstButton')) && request('firstButton')== 'topSearch' || !empty(request('Button')) && request('Button') == 'refresh')
        {
            $old=[];
            $fsReqData= $request->all();
//            dd($data_from_view,$bango);
            $query= AllPurchaseHistory::readData($bango,$data_from_view);
//            dd($query);
            if ($query=='ng'){
                $purchaseHistoryError = '該当するデータがありません。';
                session()->put('defaultSrc', '0');
                $purchaseHistoryInfos=collect([])->paginate(20);
            }
            else{
                if (count(QueryHelper::fetchResult($query))==0){
                    $purchaseHistoryError = '該当するデータがありません。';
                    session()->put('defaultSrc', '0');
                }
                else{
                    $purchaseHistoryError = '';
                    session()->put('defaultSrc', '1');
                }
                $purchaseHistoryInfos = collect(QueryHelper::fetchResult($query))->paginate(20);/*collect([])->paginate(20);*/
            }

//            dd($headers);
            return view('purchase.purchaseHistory.mainPurchaseHistory',compact('bango','tantousya','B9Data_left','C1Data_left','C2Data_left','B9Data_right','C1Data_right','C2Data_right','datachar05','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','data310','systemDate','beforeSystemDate','lastYear','purchaseHistoryInfos','old','fsReqData','headers','buttonMessage','route','redirect_path','table_headers','purchaseHistoryError','purchaseHistorySuccess'));
        }


        $old=null;
        session()->put('defaultSrc', '0');
        $purchaseHistoryInfos =collect([])->paginate(20);
        return view('purchase.purchaseHistory.mainPurchaseHistory',compact('bango','tantousya','B9Data_left','C1Data_left','C2Data_left','B9Data_right','C1Data_right','C2Data_right','datachar05','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','data310','systemDate','beforeSystemDate','lastYear','purchaseHistoryInfos','old','headers','buttonMessage','route','redirect_path','table_headers','purchaseHistoryError','purchaseHistorySuccess'));
    }

    public function purchaseHistoryValidation(Request $request){
        $chk1Arr=$request['chk1Arr'];
        $chk2Arr=$request['chk2Arr'];
        $chk1StatusArr=$request['chk1StatusArr'];
        $chk2StatusArr=$request['chk2StatusArr'];
        $barcodeVal=$request['barcodeVal'];
        $bango=$request['userId'];
        $innerLevel=tantousya::find($bango)->innerlevel;

//        dd($chk1Arr,$chk2Arr,$chk1StatusArr,$chk2StatusArr,$barcodeVal,$bango,$innerLevel);

        $errorArr=[];

        foreach ($chk1Arr as $key => $value) {
            $chk1data=explode("_",$value);
            $chk1syouhinsyu=$chk1data[2];
            $chk1unsoumei=$chk1data[3];
            $chk1datanum0013=$chk1data[4];
            $chk1laststatus=$chk1data[5];
            $chk1nowstatus=$chk1StatusArr[$key];
            $chk1datachar06=$chk1data[6];
            $chk1idoutanabango=$chk1data[7];

            $chk2data=explode("_",$chk2Arr[$key]);
            $chk2syouhinsyu=$chk2data[2];
            $chk2unsoumei=$chk2data[3];
            $chk2datanum0013=$chk2data[4];
            $chk2laststatus=$chk2data[5];
            $chk2nowstatus=$chk2StatusArr[$key];
            $chk2datachar07=$chk2data[6];
            $chk2idoutanabango=$chk2data[7];
            //dd($chk1data,$chk2data,$chk1nowstatus,$chk2nowstatus,$chk1syouhinsyu,$chk2syouhinsyu,$chk1unsoumei,$chk2unsoumei,$chk1datanum0013,$chk2datanum0013,$chk1laststatus,$chk1nowstatus,$chk2laststatus,$chk2nowstatus,$chk1datachar06,$chk2datachar07);

            if (($chk1laststatus=='1' && $chk1nowstatus=='0') && $chk2nowstatus=='1'){
                $error_properties=$chk1syouhinsyu.'_'.$chk1unsoumei.'_'.$chk1datanum0013;
                array_push($errorArr,$error_properties);
            }

        }

        if (count($errorArr)>0){
            return 0;
        }
        else{
            return 1;
        }

    }

    public function purchaseHistoryUpdate(Request $request){
        $chk1Arr=$request['chk1Arr'];
        $chk2Arr=$request['chk2Arr'];
        $chk1StatusArr=$request['chk1StatusArr'];
        $chk2StatusArr=$request['chk2StatusArr'];
        $barcodeVal=$request['barcodeVal'];
        $bango=$request['userId'];
        $innerLevel=tantousya::find($bango)->innerlevel;
        $updatedArr=[];
        //dd($chk1Arr,$chk2Arr,$chk1StatusArr,$chk2StatusArr,$innerLevel);
        //return 2;

        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### purchaseHistory152_update start\n";
        QueryHandler::logger($bango, $log_data);
        $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
        pg_query($conn, 'BEGIN');
        try{
            $insertedUnsoumeiArr=[];
            foreach ($chk1Arr as $key => $value) {
                $chk1data=explode("_",$value);
                $chk1syouhinsyu=$chk1data[2];
                $chk1unsoumei=$chk1data[3];
                $chk1datanum0013=$chk1data[4];
                $chk1laststatus=$chk1data[5];
                $chk1nowstatus=$chk1StatusArr[$key];
                $chk1datachar06=$chk1data[6];
                $chk1idoutanabango=$chk1data[7];

                $chk2data=explode("_",$chk2Arr[$key]);
                $chk2syouhinsyu=$chk2data[2];
                $chk2unsoumei=$chk2data[3];
                $chk2datanum0013=$chk2data[4];
                $chk2laststatus=$chk2data[5];
                $chk2nowstatus=$chk2StatusArr[$key];
                $chk2datachar07=$chk2data[6];
                $chk2idoutanabango=$chk2data[7];
//                dd($chk1data,$chk2data,$chk1nowstatus,$chk2nowstatus,$chk1syouhinsyu,$chk2syouhinsyu,$chk1unsoumei,$chk2unsoumei,$chk1datanum0013,$chk2datanum0013,$chk1laststatus,$chk1nowstatus,$chk2laststatus,$chk2nowstatus,$chk1datachar06,$chk2datachar07);

                $update_datachar06_val=null;
                $update_datachar07_val=null;

                $update=false;
                $c='';
                if ($innerLevel<15){
                    if (($chk1laststatus=='0' && $chk2laststatus=='0')&&($chk1nowstatus=='1' && $chk2nowstatus=='0')){
                        $update_datachar06_val=$bango;
                        $update_datachar07_val=null;
                        $update=true;
                        $c='condition1';
                    }
                    elseif (($chk1laststatus=='1' && $chk2laststatus=='0')&&($chk1nowstatus=='1' && $chk2nowstatus=='1')){
                        $update_datachar06_val=$chk1datachar06;//pre db value
                        $update_datachar07_val=$bango;
                        $update=true;
                        $c='condition2';
                    }
                    elseif (($chk1laststatus=='1' && $chk2laststatus=='1')&&($chk1nowstatus=='1' && $chk2nowstatus=='0')){
                        $update_datachar06_val=$chk1datachar06;//pre db value
                        $update_datachar07_val=null;
                        $update=true;
                        $c='condition3';
                    }
                    elseif (($chk1laststatus=='1' && $chk2laststatus=='1')&&($chk1nowstatus=='0' && $chk2nowstatus=='0')){
                        $update_datachar06_val=null;
                        $update_datachar07_val=null;
                        $update=true;
                        $c='condition4';
                    }
                    elseif (($chk1laststatus=='1' && $chk2laststatus=='0')&&($chk1nowstatus=='0' && $chk2nowstatus=='0')){
                        $update_datachar06_val=null;
                        $update_datachar07_val=null;
                        $update=true;
                        $c='condition5';
                    }
                    elseif (($chk1laststatus=='1' && $chk2laststatus=='1')&&($chk1nowstatus=='1' && $chk2nowstatus=='1')){
                        $update_datachar06_val=$chk1datachar06;
                        $update_datachar07_val=$chk2datachar07;
                        $update=false;
                        $c='condition6';
                    }
                    else{$update=false;}
                }
                elseif ($innerLevel>15 && $innerLevel<19){
                    if (($chk1laststatus=='0' && $chk2laststatus=='0')&&($chk1nowstatus=='1' && $chk2nowstatus=='0')){
                        $update_datachar06_val=$bango;
                        $update_datachar07_val=null;
                        $update=true;
                        $c='condition1';
                    }
                    elseif (($chk1laststatus=='1' && $chk2laststatus=='0')&&($chk1nowstatus=='1' && $chk2nowstatus=='1')){
                        $update_datachar06_val=$chk1datachar06;//pre db value
                        $update_datachar07_val=$bango;
                        $update=true;
                        $c='condition2';
                    }
                    elseif (($chk1laststatus=='1' && $chk2laststatus=='0')&&($chk1nowstatus=='0' && $chk2nowstatus=='0')){
                        $update_datachar06_val=null;
                        $update_datachar07_val=null;
                        $update=true;
                        $c='condition3';
                    }
                    elseif (($chk1laststatus=='1' && $chk2laststatus=='1')&&($chk1nowstatus=='1' && $chk2nowstatus=='1')){
                        $update_datachar06_val=$chk1datachar06;
                        $update_datachar07_val=$chk2datachar07;
                        $update=false;
                        $c='condition4';
                    }
                    else{$update=false;}
                }
                elseif ($innerLevel>18){
                    if (($chk1laststatus=='0' && $chk2laststatus=='0')&&($chk1nowstatus=='1' && $chk2nowstatus=='0')){
                        $update_datachar06_val=$bango;
                        $update_datachar07_val=null;
                        $update=true;
                        $c='condition1';
                    }
                    elseif (($chk1laststatus=='1' && $chk2laststatus=='0')&&($chk1nowstatus=='0' && $chk2nowstatus=='0')){
                        $update_datachar06_val=null;
                        $update_datachar07_val=null;
                        $update=true;
                        $c='condition2';
                    }
                    else{$update=false;}
                }

                if ($update==true){
                    $hikiatenyuko=[
                        'syouhinid' => $chk1unsoumei,
                        'datachar06' => $update_datachar06_val,
                        'datachar07' => $update_datachar07_val,
                        'denpyoshimebi' => date("Y-m-d H:i:s"),
                        'tantousyabango'=>$bango
                    ];
                    QueryHelper::updateData('hikiatenyuko', $hikiatenyuko, 'syouhinid', $bango, __CLASS__, __FUNCTION__, __LINE__);
                    $updated_properties=$chk1syouhinsyu.'_'.$chk1unsoumei.'_'.$chk1datanum0013;
                    array_push($updatedArr,$updated_properties);
//                    dd($updatedArr,$update_datachar06_val,$update_datachar07_val,$c,$innerLevel,$bango);

                    if (!in_array($chk1unsoumei,$insertedUnsoumeiArr)) {
                        array_push($insertedUnsoumeiArr,$chk1unsoumei);

                        //for insert toiawasebango
                        //$toiawasebangoDbData=QueryHelper::fetchResult("select toiawasebango.* from toiawasebango where toiawasebango.unsoumei = '$chk1unsoumei' and toiawasebango.datanum0013 = '$chk1datanum0013' limit 1");
                        $maxToiawasebangoDbData=QueryHelper::fetchSingleResult("SELECT DISTINCT unsoumei, max (datanum0013) as max_datanum0013 FROM toiawasebango WHERE unsoumei='$chk1unsoumei'  group by unsoumei order by unsoumei");
                        $dbMaxDataNum0013=$maxToiawasebangoDbData->max_datanum0013;
                        $toiawasebangoDbData=QueryHelper::fetchResult("select toiawasebango.* from toiawasebango where toiawasebango.unsoumei = '$chk1unsoumei' and toiawasebango.datanum0013 = '$dbMaxDataNum0013' limit 1");
                        $toiawasebango_insert_data = [
                            'orderbango' => $toiawasebangoDbData[0]->orderbango,
                            'syukkosakibango' => $toiawasebangoDbData[0]->syukkosakibango,
                            'unsoumei' => $toiawasebangoDbData[0]->unsoumei,
                            'toiawasebango' => $toiawasebangoDbData[0]->toiawasebango,
                            'konpousu' => 2,
                            'touchakudate' => $toiawasebangoDbData[0]->touchakudate,
                            'touchakutime' => $toiawasebangoDbData[0]->touchakutime,
                            'bikou1' => $toiawasebangoDbData[0]->bikou1,
                            'bikou2' => $toiawasebangoDbData[0]->bikou2,
                            'denpyoname' => $toiawasebangoDbData[0]->denpyoname,
                            'dataint01' => $toiawasebangoDbData[0]->dataint01,
                            'dataint02' => $toiawasebangoDbData[0]->dataint02,
                            'dataint03' => $toiawasebangoDbData[0]->dataint03,
                            'datanum0001' => $toiawasebangoDbData[0]->datanum0001,
                            'datanum0002' => $toiawasebangoDbData[0]->datanum0002,
                            'datanum0008' => $toiawasebangoDbData[0]->datanum0008,
                            'datanum0009' => $toiawasebangoDbData[0]->datanum0009,
                            'datanum0010' => $toiawasebangoDbData[0]->datanum0010,
                            'datanum0011' => $toiawasebangoDbData[0]->datanum0011,
                            'datanum0012' => date("YmdHis"),
                            'datanum0013' => (int)$toiawasebangoDbData[0]->datanum0013+1,
                            'datanum0014' => $toiawasebangoDbData[0]->datanum0014,
                            'datanum0015' => $toiawasebangoDbData[0]->datanum0015,
                            'datanum0016' => $toiawasebangoDbData[0]->datanum0016,
                            'datanum0017' => $toiawasebangoDbData[0]->datanum0017,
                            'datachar01' => $toiawasebangoDbData[0]->datachar01,
                            'datachar02' => $toiawasebangoDbData[0]->datachar02,
                            'datachar03' => $toiawasebangoDbData[0]->datachar03,
                            'datatxt0001' => $bango,
                            'datatxt0002' => $toiawasebangoDbData[0]->datatxt0002,
                            'datatxt0019' => $toiawasebangoDbData[0]->datatxt0019,
                            'datatxt0020' => $toiawasebangoDbData[0]->datatxt0020,
                            'datatxt0021' => $toiawasebangoDbData[0]->datatxt0021,
                            'datatxt0022' => $toiawasebangoDbData[0]->datatxt0022,
                            'datatxt0023' => $toiawasebangoDbData[0]->datatxt0023,
                            'datatxt0024' => $toiawasebangoDbData[0]->datatxt0024,
                            'datatxt0025' => $toiawasebangoDbData[0]->datatxt0025,
                            'datatxt0026' => $toiawasebangoDbData[0]->datatxt0026,
                            'datatxt0027' => $toiawasebangoDbData[0]->datatxt0027,
                            'datatxt0028' => $toiawasebangoDbData[0]->datatxt0028
                        ];

                        //dd($toiawasebangoDbData,$toiawasebango_insert_data);
                        QueryHelper::insertData('toiawasebango', $toiawasebango_insert_data, 'orderbango', true, $bango, __CLASS__, __FUNCTION__, __LINE__);

                        //for insert nyukoold
                        $nyukooldDbData=QueryHelper::fetchResult("select nyukoold.* from nyukoold where nyukoold.syouhinid = '$chk1unsoumei' and nyukoold.zaikometer ='$chk1datanum0013'");

                        if (!empty($nyukooldDbData)){
                            foreach ($nyukooldDbData as $k=>$val){
                                $nyukoold_insert_data = [
                                    'orderbango' => $val->orderbango,
                                    'syouhinbango' => $val->syouhinbango,
                                    'yoteisu' => $val->yoteisu,
                                    'yoteibi' => $val->yoteibi,
                                    'nyukosu' => $val->nyukosu,
                                    'kanryoubi' => $val->kanryoubi,
                                    'kingaku' => $val->kingaku,
                                    'genka' => $val->genka,
                                    'syouhizeiritu' => $val->syouhizeiritu,
                                    'soukobango' => $val->soukobango,
                                    'ukeiremotobango' => $val->ukeiremotobango,
                                    'ukeiresakibango' => $val->ukeiresakibango,
                                    'nyukosoukobango' => $val->nyukosoukobango,
                                    'tanabango' => $val->tanabango,
                                    'tantousyabango' => $bango,
                                    'shiharaibango' => $val->shiharaibango,
                                    'denpyobango' => $val->denpyobango,
                                    'denpyohakkoubi' => date("Y-m-d H:i:s"),
                                    'season' => $val->season,
                                    'nengetsu' => $val->nengetsu,
                                    'weeks' => $val->weeks,
                                    'day' => $val->day,
                                    'tanka' => $val->tanka,
                                    'zaiko' => $val->zaiko,
                                    'idoutanabango' => $chk1idoutanabango,
                                    'yoteimeter' => $val->yoteimeter,
                                    'nyukometer' => $val->nyukometer,
                                    'zaikometer' => (int)$chk1datanum0013+1,
                                    'barcode' => $val->barcode,
                                    'codename' => $val->codename,
                                    'denpyoshimebi' => $val->denpyoshimebi,
                                    'kawaserate' => $val->kawaserate,
                                    'kawasename' => $val->kawasename,
                                    'syouhizeikubun' => $val->syouhizeikubun,
                                    'yoyakubi' => $val->yoyakubi,
                                    'syouhinname' => $val->syouhinname,
                                    'kaiinid' => $val->kaiinid,
                                    'syouhinid' => $val->syouhinid,
                                    'syouhinsyu' => $val->syouhinsyu,
                                    'hantei' => $val->hantei,

                                    'dataint01' => $val->dataint01,
                                    'dataint02' => $val->dataint02,
                                    'dataint03' => $val->dataint03,
                                    'dataint04' => $val->dataint04,
                                    'dataint05' => $val->dataint05,
                                    'dataint06' => $val->dataint06,
                                    'dataint07' => $val->dataint07,
                                    'dataint08' => $val->dataint08,
                                    'dataint09' => $val->dataint09,
                                    'dataint10' => $val->dataint10,
                                    'dataint11' => $val->dataint11,
                                    'dataint12' => $val->dataint12,
                                    'dataint13' => $val->dataint13,
                                    'dataint14' => $val->dataint14,
                                    'dataint15' => $val->dataint15,
                                    'dataint16' => $val->dataint16,
                                    'dataint17' => $val->dataint17,
                                    'dataint18' => $val->dataint18,
                                    'dataint19' => $val->dataint19,
                                    'dataint20' => $val->dataint20,
                                    'dataint21' => $val->dataint21,
                                    'dataint22' => $val->dataint22,
                                    'dataint23' => $val->dataint23,
                                    'dataint24' => $val->dataint24,
                                    'dataint25' => $val->dataint25,

                                    'datachar01' => $val->datachar01,
                                    'datachar02' => $val->datachar02,
                                    'datachar03' => $val->datachar03,
                                    'datachar04' => $val->datachar04,
                                    'datachar05' => $val->datachar05,
                                    'datachar06' => $val->datachar06,
                                    'datachar07' => $val->datachar07,
                                    'datachar08' => $val->datachar08,
                                    'datachar09' => $val->datachar09,
                                    'datachar10' => $val->datachar10,
                                    'datachar11' => $val->datachar11,
                                    'datachar12' => $val->datachar12,
                                    'datachar13' => $val->datachar13,
                                    'datachar14' => $val->datachar14,
                                    'datachar15' => $val->datachar15,
                                    'datachar16' => $val->datachar16,
                                    'datachar17' => $val->datachar17,
                                    'datachar18' => $val->datachar18,
                                    'datachar19' => $val->datachar19,
                                    'datachar20' => $val->datachar20,
                                    'datachar21' => $val->datachar21,
                                    'datachar22' => $val->datachar22,
                                    'datachar23' => $val->datachar23,
                                    'datachar24' => $val->datachar24,
                                    'datachar25' => $val->datachar25,
                                    'datachar26' => $val->datachar26,
                                    'datachar27' => $val->datachar27,
                                    'datachar28' => $val->datachar28,
                                    'datachar29' => $val->datachar29,
                                    'recordnumber' => $val->recordnumber,
                                    'tankano' => $val->tankano,
                                    'syouhinbukacd' => $val->syouhinbukacd,
                                    'hanbaibukacd' => $val->hanbaibukacd
                                ];
                                QueryHelper::insertData('nyukoold', $nyukoold_insert_data, 'orderbango', true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                            }
                        }

                        //inserting into rireki
                        $tmp_kokyakuorderbango = $toiawasebangoDbData[0]->unsoumei;
                        $tmp_ordertypebango2 = (int)$toiawasebangoDbData[0]->datanum0013+1;
                        CreateHatchuDetails::data($bango,$tmp_kokyakuorderbango, $tmp_ordertypebango2,2,'06-04','purchase_input');
                    }
                }

            }
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### purchaseOrder102_update end\n";
            pg_query($conn, 'COMMIT');

            if (count($updatedArr)>0){
                session()->flash('success_msg', '登録が完了しました。');
                return 1;
            }
            else{
                return 2;
            }
        }catch(\Exception $e){
            pg_query($conn, 'ROLLBACK');
            //return 2;
            return $e;
        }

    }

    //before change spec update
    public function purchaseHistoryUpdatePrevious(Request $request){
        $chk1Arr=$request['chk1Arr'];
        $chk2Arr=$request['chk2Arr'];
        $chk1StatusArr=$request['chk1StatusArr'];
        $chk2StatusArr=$request['chk2StatusArr'];
        $barcodeVal=$request['barcodeVal'];
        $bango=$request['userId'];
//        dd($chk1Arr,$chk2Arr,$chk1StatusArr,$chk2StatusArr);
        //return 2;

        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### purchaseHistory152_update start\n";
        QueryHandler::logger($bango, $log_data);
        $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
        pg_query($conn, 'BEGIN');
        try{
            foreach ($chk1Arr as $key => $value) {
                $chk1data=explode("_",$value);
                $chk1syouhinsyu=$chk1data[2];
                $chk1unsoumei=$chk1data[3];
                $chk1datanum0013=$chk1data[4];
                $chk1laststatus=$chk1data[5];
                $chk1nowstatus=$chk1StatusArr[$key];
                $chk1datachar06=$chk1data[6];
                $chk1idoutanabango=$chk1data[7];

                $chk2data=explode("_",$chk2Arr[$key]);
                $chk2syouhinsyu=$chk2data[2];
                $chk2unsoumei=$chk2data[3];
                $chk2datanum0013=$chk2data[4];
                $chk2laststatus=$chk2data[5];
                $chk2nowstatus=$chk2StatusArr[$key];
                $chk2datachar07=$chk2data[6];
                $chk2idoutanabango=$chk2data[7];
//                dd($chk1data,$chk2data,$chk1nowstatus,$chk2nowstatus,$chk1syouhinsyu,$chk2syouhinsyu,$chk1unsoumei,$chk2unsoumei,$chk1datanum0013,$chk2datanum0013,$chk1laststatus,$chk1nowstatus,$chk2laststatus,$chk2nowstatus,$chk1datachar06,$chk2datachar07);

                $update_datachar06_val=null;
                $update_datachar07_val=null;

                if (($chk1laststatus=='1' && $chk2laststatus=='1')&&($chk1nowstatus=='1' && $chk2nowstatus=='0')){
                    $update_datachar06_val=$chk1datachar06;//pre db value
                    $update_datachar07_val=null;
                }
                elseif (($chk1laststatus=='1' && $chk2laststatus=='1')&&($chk1nowstatus=='0' && $chk2nowstatus=='0')){
                    $update_datachar06_val=null;
                    $update_datachar07_val=null;
                }
                elseif (($chk1laststatus=='1' && $chk2laststatus=='0')&&($chk1nowstatus=='1' && $chk2nowstatus=='1')){
                    $update_datachar06_val=$chk1datachar06;//pre db value
                    $update_datachar07_val=$bango;
                }
                elseif (($chk1laststatus=='1' && $chk2laststatus=='0')&&($chk1nowstatus=='0' && $chk2nowstatus=='0')){
                    $update_datachar06_val=null;
                    $update_datachar07_val=null;
                }
                elseif (($chk1laststatus=='0' && $chk2laststatus=='0')&&($chk1nowstatus=='1' && $chk2nowstatus=='0')){
                    $update_datachar06_val=$bango;
                    $update_datachar07_val=null;
                }
                elseif (($chk1laststatus=='1' && $chk2laststatus=='0')&&($chk1nowstatus=='0' && $chk2nowstatus=='0')){
                    $update_datachar06_val=null;
                    $update_datachar07_val=null;
                }//extra condition added
                elseif (($chk1laststatus=='1' && $chk2laststatus=='1')&&($chk1nowstatus=='1' && $chk2nowstatus=='1')){
                    $update_datachar06_val=$bango;
                    $update_datachar07_val=$bango;
                }
                elseif (($chk1laststatus=='0' && $chk2laststatus=='0')&&($chk1nowstatus=='1' && $chk2nowstatus=='1')){
                    $update_datachar06_val=$bango;
                    $update_datachar07_val=$bango;
                }
//                dd($chk1Arr,$chk2Arr,$chk1StatusArr, $chk2StatusArr,$chk1laststatus,$chk2laststatus,$chk1nowstatus,$chk2nowstatus,$update_datachar06_val,$update_datachar07_val);

                $toiawasebangoDbData=QueryHelper::fetchResult("select toiawasebango.* from toiawasebango where toiawasebango.unsoumei = '$chk1unsoumei' and toiawasebango.datanum0013 = '$chk1datanum0013' limit 1");
                $nyukooldDbData=QueryHelper::fetchResult("select nyukoold.* from nyukoold where nyukoold.syouhinid = '$chk1unsoumei' limit 1");
//                dd($toiawasebangoDbData,$nyukooldDbData);
                if (!empty($toiawasebangoDbData) && !empty($nyukooldDbData)){
//                dd($toiawasebangoDbData);
                    $hikiatenyuko=[
                        'syouhinid' => $toiawasebangoDbData[0]->unsoumei,
                        'datachar06' => $update_datachar06_val,
                        'datachar07' => $update_datachar07_val,
                        'denpyoshimebi' => date("Y-m-d H:i:s"),
                        'tantousyabango'=>$bango
                    ];

                    QueryHelper::updateData('hikiatenyuko', $hikiatenyuko, 'syouhinid', $bango, __CLASS__, __FUNCTION__, __LINE__);
                    //for insert toiawasebango
                   /* $toiawasebango_insert_data = [
                        'orderbango' => $toiawasebangoDbData[0]->orderbango,
                        'syukkosakibango' => $toiawasebangoDbData[0]->syukkosakibango,
                        'unsoumei' => $toiawasebangoDbData[0]->unsoumei,
                        'toiawasebango' => $toiawasebangoDbData[0]->toiawasebango,
                        'konpousu' => 2,
                        'touchakudate' => $toiawasebangoDbData[0]->touchakudate,
                        'touchakutime' => $toiawasebangoDbData[0]->touchakutime,
                        'bikou1' => $toiawasebangoDbData[0]->bikou1,
                        'bikou2' => $toiawasebangoDbData[0]->bikou2,
                        'denpyoname' => $toiawasebangoDbData[0]->denpyoname,
                        'dataint01' => $toiawasebangoDbData[0]->dataint01,
                        'dataint02' => $toiawasebangoDbData[0]->dataint02,
                        'dataint03' => $toiawasebangoDbData[0]->dataint03,
                        'datanum0001' => $toiawasebangoDbData[0]->datanum0001,
                        'datanum0002' => $toiawasebangoDbData[0]->datanum0002,
                        'datanum0008' => $toiawasebangoDbData[0]->datanum0008,
                        'datanum0009' => $toiawasebangoDbData[0]->datanum0009,
                        'datanum0010' => $toiawasebangoDbData[0]->datanum0010,
                        'datanum0011' => $toiawasebangoDbData[0]->datanum0011,
                        'datanum0012' => date("YmdHis"),
                        'datanum0013' => (int)$toiawasebangoDbData[0]->datanum0013+1,
                        'datanum0014' => $toiawasebangoDbData[0]->datanum0014,
                        'datanum0015' => $toiawasebangoDbData[0]->datanum0015,
                        'datanum0016' => $toiawasebangoDbData[0]->datanum0016,
                        'datanum0017' => $toiawasebangoDbData[0]->datanum0017,
                        'datachar01' => $toiawasebangoDbData[0]->datachar01,
                        'datachar02' => $toiawasebangoDbData[0]->datachar02,
                        'datachar03' => $toiawasebangoDbData[0]->datachar03,
                        'datatxt0001' => $bango,
                        'datatxt0002' => $toiawasebangoDbData[0]->datatxt0002,
                        'datatxt0019' => $toiawasebangoDbData[0]->datatxt0019,
                        'datatxt0020' => $toiawasebangoDbData[0]->datatxt0020,
                        'datatxt0021' => $toiawasebangoDbData[0]->datatxt0021,
                        'datatxt0022' => $toiawasebangoDbData[0]->datatxt0022,
                        'datatxt0023' => $toiawasebangoDbData[0]->datatxt0023,
                        'datatxt0024' => $toiawasebangoDbData[0]->datatxt0024,
                        'datatxt0025' => $toiawasebangoDbData[0]->datatxt0025,
                        'datatxt0026' => $toiawasebangoDbData[0]->datatxt0026,
                        'datatxt0027' => $toiawasebangoDbData[0]->datatxt0027,
                        'datatxt0028' => $toiawasebangoDbData[0]->datatxt0028
                    ];

                    QueryHelper::insertData('toiawasebango', $toiawasebango_insert_data, 'orderbango', true, $bango, __CLASS__, __FUNCTION__, __LINE__);*/
                    //for insert nyukoold
                    /*$nyukoold_insert_data = [
                        'orderbango' => $nyukooldDbData[0]->orderbango,
                        'syouhinbango' => $nyukooldDbData[0]->syouhinbango,
                        'yoteisu' => $nyukooldDbData[0]->yoteisu,
                        'yoteibi' => $nyukooldDbData[0]->yoteibi,
                        'nyukosu' => $nyukooldDbData[0]->nyukosu,
                        'kanryoubi' => $nyukooldDbData[0]->kanryoubi,
                        'kingaku' => $nyukooldDbData[0]->kingaku,
                        'genka' => $nyukooldDbData[0]->genka,
                        'syouhizeiritu' => $nyukooldDbData[0]->syouhizeiritu,
                        'soukobango' => $nyukooldDbData[0]->soukobango,
                        'ukeiremotobango' => $nyukooldDbData[0]->ukeiremotobango,
                        'ukeiresakibango' => $nyukooldDbData[0]->ukeiresakibango,
                        'nyukosoukobango' => $nyukooldDbData[0]->nyukosoukobango,
                        'tanabango' => $nyukooldDbData[0]->tanabango,
                        'tantousyabango' => $bango,
                        'shiharaibango' => $nyukooldDbData[0]->shiharaibango,
                        'denpyobango' => $nyukooldDbData[0]->denpyobango,
                        'denpyohakkoubi' => date("Y-m-d H:i:s"),
                        'season' => $nyukooldDbData[0]->season,
                        'nengetsu' => $nyukooldDbData[0]->nengetsu,
                        'weeks' => $nyukooldDbData[0]->weeks,
                        'day' => $nyukooldDbData[0]->day,
                        'tanka' => $nyukooldDbData[0]->tanka,
                        'zaiko' => $nyukooldDbData[0]->zaiko,
                        'idoutanabango' => $chk1idoutanabango,
                        'yoteimeter' => (int)$chk1syouhinsyu,
                        'nyukometer' => $nyukooldDbData[0]->nyukometer,
                        'zaikometer' => (int)$chk1datanum0013+1,
                        'barcode' => $barcodeVal,
                        'codename' => null,
                        'denpyoshimebi' => $nyukooldDbData[0]->denpyoshimebi,
                        'kawaserate' => $nyukooldDbData[0]->kawaserate,
                        'kawasename' => $nyukooldDbData[0]->kawasename,
                        'syouhizeikubun' => $nyukooldDbData[0]->syouhizeikubun,
                        'yoyakubi' => $nyukooldDbData[0]->yoyakubi,
                        'syouhinname' => $nyukooldDbData[0]->syouhinname,
                        'kaiinid' => $nyukooldDbData[0]->kaiinid,
                        'syouhinid' => $nyukooldDbData[0]->syouhinid,
                        'syouhinsyu' => $nyukooldDbData[0]->syouhinsyu,
                        'hantei' => $nyukooldDbData[0]->hantei,

                        'dataint01' => $nyukooldDbData[0]->dataint01,
                        'dataint02' => $nyukooldDbData[0]->dataint02,
                        'dataint03' => $nyukooldDbData[0]->dataint03,
                        'dataint04' => $nyukooldDbData[0]->dataint04,
                        'dataint05' => $nyukooldDbData[0]->dataint05,
                        'dataint06' => $nyukooldDbData[0]->dataint06,
                        'dataint07' => $nyukooldDbData[0]->dataint07,
                        'dataint08' => $nyukooldDbData[0]->dataint08,
                        'dataint09' => $nyukooldDbData[0]->dataint09,
                        'dataint10' => $nyukooldDbData[0]->dataint10,
                        'dataint11' => $nyukooldDbData[0]->dataint11,
                        'dataint12' => $nyukooldDbData[0]->dataint12,
                        'dataint13' => $nyukooldDbData[0]->dataint13,
                        'dataint14' => $nyukooldDbData[0]->dataint14,
                        'dataint15' => $nyukooldDbData[0]->dataint15,
                        'dataint16' => $nyukooldDbData[0]->dataint16,
                        'dataint17' => $nyukooldDbData[0]->dataint17,
                        'dataint18' => $nyukooldDbData[0]->dataint18,
                        'dataint19' => $nyukooldDbData[0]->dataint19,
                        'dataint20' => $nyukooldDbData[0]->dataint20,
                        'dataint21' => $nyukooldDbData[0]->dataint21,
                        'dataint22' => $nyukooldDbData[0]->dataint22,
                        'dataint23' => $nyukooldDbData[0]->dataint23,
                        'dataint24' => $nyukooldDbData[0]->dataint24,
                        'dataint25' => $nyukooldDbData[0]->dataint25,

                        'datachar01' => $nyukooldDbData[0]->datachar01,
                        'datachar02' => $nyukooldDbData[0]->datachar02,
                        'datachar03' => $nyukooldDbData[0]->datachar03,
                        'datachar04' => $nyukooldDbData[0]->datachar04,
                        'datachar05' => $nyukooldDbData[0]->datachar05,
                        'datachar06' => $nyukooldDbData[0]->datachar06,
                        'datachar07' => $nyukooldDbData[0]->datachar07,
                        'datachar08' => $nyukooldDbData[0]->datachar08,
                        'datachar09' => $nyukooldDbData[0]->datachar09,
                        'datachar10' => $nyukooldDbData[0]->datachar10,
                        'datachar11' => $nyukooldDbData[0]->datachar11,
                        'datachar12' => $nyukooldDbData[0]->datachar12,
                        'datachar13' => $nyukooldDbData[0]->datachar13,
                        'datachar14' => $nyukooldDbData[0]->datachar14,
                        'datachar15' => $nyukooldDbData[0]->datachar15,
                        'datachar16' => $nyukooldDbData[0]->datachar16,
                        'datachar17' => $nyukooldDbData[0]->datachar17,
                        'datachar18' => $nyukooldDbData[0]->datachar18,
                        'datachar19' => $nyukooldDbData[0]->datachar19,
                        'datachar20' => $nyukooldDbData[0]->datachar20,
                        'datachar21' => $nyukooldDbData[0]->datachar21,
                        'datachar22' => $nyukooldDbData[0]->datachar22,
                        'datachar23' => $nyukooldDbData[0]->datachar23,
                        'datachar24' => $nyukooldDbData[0]->datachar24,
                        'datachar25' => $nyukooldDbData[0]->datachar25,
                        'datachar26' => $nyukooldDbData[0]->datachar26,
                        'datachar27' => $nyukooldDbData[0]->datachar27,
                        'datachar28' => $nyukooldDbData[0]->datachar28,
                        'datachar29' => $nyukooldDbData[0]->datachar29,
                        'recordnumber' => $nyukooldDbData[0]->recordnumber,
                        'tankano' => $nyukooldDbData[0]->tankano,
                        'syouhinbukacd' => $nyukooldDbData[0]->syouhinbukacd,
                        'hanbaibukacd' => $nyukooldDbData[0]->hanbaibukacd
                    ];

                    QueryHelper::insertData('nyukoold', $nyukoold_insert_data, 'orderbango', true, $bango, __CLASS__, __FUNCTION__, __LINE__);*/
                    //for update nyukoold
                    /*$nyukoold_update_data = [
                        'syouhinid' => $toiawasebangoDbData[0]->unsoumei,
                        'idoutanabango' => $nyukooldDbData[0]->idoutanabango,
                        'yoteimeter' => $nyukooldDbData[0]->syouhinsyu,
                        'barcode' => $barcodeVal,
                        'codename' => null,
                        'denpyohakkoubi' => date("Y-m-d H:i:s"),
                        'tantousyabango' => $bango,
                        'zaikometer' => (int)$toiawasebangoDbData[0]->datanum0013+1
                    ];
                    QueryHelper::updateData('nyukoold', $nyukoold_update_data, 'syouhinid', $bango, __CLASS__, __FUNCTION__, __LINE__);*/
                }
                else{
                    return 404;
                    //toiawasebangoDbData && nyukooldDbData nai
                }

            }
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### purchaseOrder102_update end\n";
            pg_query($conn, 'COMMIT');
            session()->flash('success_msg', '登録が完了しました。');
            return 1;
        }catch(\Exception $e){
            pg_query($conn, 'ROLLBACK');
            //return 2;
            return $e;
        }

    }

    public function purchaseHistoryInquiry(Request $request){
//        dd($request->all());
        $purchase_no=$request->pNo;
        $correction_no=$request->cNo;
        $line_no=$request->lNo;
        $bango=$request->userId;
//        dd($purchase_no,$correction_no,$bango);
        $query= PurchaseHistoryInquiry::readData($bango,$purchase_no,$correction_no,$line_no);
        $purchaseHistoryInquiryInfos = collect(QueryHelper::fetchResult($query));

//        dd($purchaseHistoryInquiryInfos);
        $tantousya = tantousya::find($bango);
        return view('purchase.purchaseHistory.purchaseInquiry.mainPurchaseInquiry',compact('bango','tantousya','purchaseHistoryInquiryInfos'));
    }

    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = PurchaseHistoryHeaders::$page_no;
        /*return $Setting = TableSetting::setting($this->headers, $id, $pageNo);*/
        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $id)->where('kengenchar05', '06-04')->get()->count();
        $Setting = TableSetting::setting($this->headers, $id, $pageNo);
        if($initial_header == 0){
            $Setting['purchase_category'] = "";
            $Setting['creation_division'] = "";
            $Setting['purchaser'] = "";
            $Setting['invoice_number'] = "";
            $Setting['invoice_date'] = "";
            $Setting['slip_remarks'] = "";
            $Setting['payment_date'] = "";
            $Setting['purchase_consumption_tax_amount'] = "";
            $Setting['purchase_history_creation_flag'] = "";
            $Setting['spare1'] = "";
            $Setting['spare2'] = "";
            $Setting['spare3'] = "";
            $Setting['spare4'] = "";
            $Setting['spare5'] = "";
            $Setting['spare6'] = "";
            $Setting['data_valid_segment'] = "";
            $Setting['registration_date'] = "";
            $Setting['registration_time'] = "";
            $Setting['updater'] = "";
            $Setting['number_of_corrections'] = "";
            $Setting['payment_closing_date'] = "";
            $Setting['consumption_tax_paid'] = "";
            $Setting['purchased_segment'] = "";
            $Setting['prepayment_segment'] = "";
            $Setting['provisional_purchase_date'] = "";
            $Setting['payment_data_creation_flag'] = "";
            $Setting['accounts_payable_update_flag'] = "";
            $Setting['purchase_orderer'] = "";
            $Setting['purchase_seal_holder'] = "";
            $Setting['accounting_data_creation_phase'] = "";
            $Setting['flag_reserve1'] = "";
        }
        return $Setting;
    }

    public function tableSettingSave(Request $request, $id, $bango, $type = null)
    {
        $pageNo = PurchaseHistoryHeaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '仕入購入履歴一覧・仕入照会', $type);
    }

    private function modifyBladeData($alldata,$index){
        $newArr=[];

        foreach ($index as $key => $value) {
            $newArr[$value]=!empty($alldata[$value])?$alldata[$value]:null;
        }
        return $newArr;
    }
}
