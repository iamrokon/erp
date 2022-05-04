<?php
namespace App\Http\Controllers\purchase;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\tantousya;
use App\Helpers\Helper;
use Exception;
use Illuminate\Support\Facades\Session;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use App\AllClass\purchase\paymentDataCreation\PaymentDataCreation;
use App\AllClass\purchase\paymentInput\PaymentInputDataEntry;


class PaymentDataCreationController extends Controller
{
    public function index(){
        $bango = request('userId');
        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $name = QueryHelper::select(['name'])->from('tantousya')->where("DeleteFlag = '0' ")->orderBy("bango asc")->get()->execute();
        // $categorykanriesU1 = QueryHelper::fetchResult("select category1,category2,category4 from categorykanri where category1 = 'U6' and category2 != '22' ORDER BY category2 ASC");
        $color = '0603作成区分';
        // $request1s = QueryHelper::select(['syouhinbango', 'jouhou'])->from('request')->where("color = '0603作成区分'")->orderBy("bango asc")->get()->execute();
        // $U2Data = QueryHelper::fetchResult("select category1,category2,category4 from categorykanri where category1 = 'D9' ORDER BY category2 ASC");
        // $data201 = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'D9' and suchi2 = 0 order by suchi1 ASC "); 
        // $data202 = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'H2' and suchi2 = 0 order by suchi1 ASC "); 
        // $data203 = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'H3' and suchi2 = 0 order by suchi1 ASC ");  
        // $c4Categorykanries = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'U9' and suchi2 = 0 order by suchi1 ASC ");
        return view('purchase.paymentDataCreation.mainPaymentDataCreation',compact('bango', 'tantousya', 'name'));
    }
    public function save(Request $request, $bango)
    {   
        if(isset($request->type) && $request->type == "search"){
            return PaymentDataCreation::search($request->all(), $bango);
        }
        elseif($request->type == "insert") {
            $date101 = $request->payment_deadline;
            $date102 = $request->payment_date;
            $date103 = $request->voucher_date;
            $requestData = $request->data;
            $result = [];
            foreach( $requestData as $data ){
                $szData = (object)$data;
                if($szData->sz0025||$szData->sz0027 || $szData->sz0029){
                    $line = 0;
                    $hikiatesyukko2Data = [];
                    $syouhinid = PaymentInputDataEntry::getSyouhinId();
                    if($szData->sz0025){
                        $line++;
                        array_push($hikiatesyukko2Data, [$line, $szData->sz0025, $szData->sz0026]);
                    }
                    if($szData->sz0027){
                        $line++;
                        array_push($hikiatesyukko2Data, [$line, $szData->sz0027, $szData->sz0028]);
                    }
                    if($szData->sz0029){
                        $line++;
                        array_push($hikiatesyukko2Data, [$line, $szData->sz0029, $szData->sz0030]);
                    }
                    // dd($hikiatesyukko2Data);
                    $insertResult = $this->insertData($syouhinid, $szData, $hikiatesyukko2Data, $bango, $date101, $date102, $date103, 1);                    
                    // dd($hikiatesyukko2Data);
                    if($insertResult["status"]=="ng"){
                        session()->flash('success_msg', "something went wrong");
                        return $insertResult;
                    }elseif($insertResult["status"]=="ok"){
                        $insertResult["office"] = $szData->sz0002;
                        $insertResult["date"] = $szData->sz0001;
                        $insertResult["line"] = $line;
                        array_push($result, $insertResult);
                    }
                }
                // dd($szData->sz0001, $szData->sz0002);
                if($szData->sz0031 || $szData->sz0033 || $szData->sz0035){
                    $line = 0;
                    $hikiatesyukko2Data = [];
                    $syouhinid = PaymentInputDataEntry::getSyouhinId();
                    if($szData->sz0031){
                        $line++;
                        array_push($hikiatesyukko2Data, [$line, $szData->sz0031, $szData->sz0032]);
                    }
                    if($szData->sz0033){
                        $line++;
                        array_push($hikiatesyukko2Data, [$line, $szData->sz0033, $szData->sz0034]);
                    }
                    if($szData->sz0035){
                        $line++;
                        array_push($hikiatesyukko2Data, [$line, $szData->sz0035, $szData->sz0036]);
                    }
                    // dd($hikiatesyukko2Data);
                    $insertResult = $this->insertData($syouhinid, $szData, $hikiatesyukko2Data, $bango, $date101, $date102, $date103, 2);                    
                    if($insertResult["status"]=="ng"){
                        session()->flash('success_msg', "something went wrong");
                        return $insertResult;
                    }elseif($insertResult["status"]=="ok"){
                        $insertResult["office"] = $szData->sz0002;
                        $insertResult["date"] = $szData->sz0001;
                        $insertResult["line"] = $line;
                        array_push($result, $insertResult);
                    }
                }
                // if((!empty($szData->sz0025) || !empty($szData->sz0026)) ||(!empty($szData->sz0027) || !empty($szData->sz0028)) || (!empty($szData->sz0029) || !empty($szData->sz0030))){
                //     $line = 0;
                //     $hikiatesyukko2Data = [];
                //     $syouhinid = PaymentInputDataEntry::getSyouhinId();
                //     if((!empty($szData->sz0025) || $szData->sz0025 !== "") && (!empty($szData->sz0026)||$szData->sz0026 !=="")){
                //         $line++;
                //         array_push($hikiatesyukko2Data, [$line, $szData->sz0025, $szData->sz0026]);
                //     }
                //     if((!empty($szData->sz0027) || $szData->sz0027 !== "") && (!empty($szData->sz0028)||$szData->sz0028 !=="")){
                //         $line++;
                //         array_push($hikiatesyukko2Data, [$line, $szData->sz0027, $szData->sz0028]);
                //     }
                //     if((!empty($szData->sz0029) || $szData->sz0029 !== "") && (!empty($szData->sz0030)||$szData->sz0030 !=="")){
                //         $line++;
                //         array_push($hikiatesyukko2Data, [$line, $szData->sz0029, $szData->sz0030]);
                //     }
                //     $insertResult = $this->insertData($syouhinid, $szData, $hikiatesyukko2Data, $bango, $date101, $date102, $date103, 1);                    
                //     // dd($hikiatesyukko2Data);
                //     if($insertResult["status"]=="ng"){
                //         session()->flash('success_msg', "something went wrong");
                //         return $insertResult;
                //     }elseif($insertResult["status"]=="ok"){
                //         $insertResult["office"] = $szData->sz0002;
                //         $insertResult["date"] = $szData->sz0001;
                //         $insertResult["line"] = $line;
                //         array_push($result, $insertResult);
                //     }
                // }
                // // dd($szData->sz0001, $szData->sz0002);
                // if((!empty($szData->sz0031) || !empty($szData->sz0032)) ||(!empty($szData->sz0033) || !empty($szData->sz0034)) || (!empty($szData->sz0035) || !empty($szData->sz0036))){
                //     $line = 0;
                //     $hikiatesyukko2Data = [];
                //     $syouhinid = PaymentInputDataEntry::getSyouhinId();
                //     if((!empty($szData->sz0031) || $szData->sz0031 !== "") && (!empty($szData->sz0032)||$szData->sz0032 !=="")){
                //         $line++;
                //         array_push($hikiatesyukko2Data, [$line, $szData->sz0031, $szData->sz0032]);
                //     }
                //     if((!empty($szData->sz0033) || $szData->sz0033 !== "") && (!empty($szData->sz0034)||$szData->sz0034 !=="")){
                //         $line++;
                //         array_push($hikiatesyukko2Data, [$line, $szData->sz0033, $szData->sz0034]);
                //     }
                //     if((!empty($szData->sz0035) || $szData->sz0035 !== "") && (!empty($szData->sz0036)||$szData->sz0036 !=="")){
                //         $line++;
                //         array_push($hikiatesyukko2Data, [$line, $szData->sz0035, $szData->sz0036]);
                //     }
                //     $insertResult = $this->insertData($syouhinid, $szData, $hikiatesyukko2Data, $bango, $date101, $date102, $date103, 2);                    
                //     if($insertResult["status"]=="ng"){
                //         session()->flash('success_msg', "something went wrong");
                //         return $insertResult;
                //     }elseif($insertResult["status"]=="ok"){
                //         $insertResult["office"] = $szData->sz0002;
                //         $insertResult["date"] = $szData->sz0001;
                //         $insertResult["line"] = $line;
                //         array_push($result, $insertResult);
                //     }
                // }
            }
            // dd("data will be insert here", $result);
            if ($result){
                session()->flash('success_msg', "支払データを作成しました。");
                return ["status" => "ok", "result" => $result];
            }
            else{
                return ["status" => "ng"];
            }
        }
    } 
    public function insertData($syouhinid, $szData, $hikiatesyukko2Data, $bango, $date101, $date102,$date103, $sz0025 = 1){
        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### payment_data_creation start\n";
        QueryHandler::logger($bango, $log_data);
        $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
        pg_query($conn, "BEGIN");
        try {  
            $datachar02 = $this->getK16Data($szData->sz0002, "syukeiki", "other31");
            $datachar03 = $this->getK16Data($szData->sz0002, "datatxt0053", "other32");
            $totalSyouhizeiritu = 0;
            foreach ($hikiatesyukko2Data as $hikiatesyukko) {
                $hikiatesyukko = (object)$hikiatesyukko;
                $syouhizeiritu = (int)$hikiatesyukko->{2} ?? 0;
                $totalSyouhizeiritu = $totalSyouhizeiritu + $syouhizeiritu;
                // dd($hikiatesyukko->{0},$hikiatesyukko->{1},$hikiatesyukko->{2});
                $hikiatesyukko2 = [
                    'orderbango' => null,
                    'syouhinid' => $syouhinid ?? null,
                    'syouhinsyu' => $hikiatesyukko->{0} ?? null,
                    // 'syouhizeiritu' => PaymentInputDataEntry::stringDataConvertedToIntegerFormat(5000567, 'comma') ?? null,
                    'syouhizeiritu' => $syouhizeiritu,
                    'datachar01' => $hikiatesyukko->{1} ?? null,
                    'datachar02' => $datachar02, 
                    'datachar03' => $datachar03,                       
                    'datachar11' => null,                       
                    'denpyobango' => 0,
                    'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'),
                    'denpyoshimebi' => null,
                    'barcode' => null,
                    'codename' => null,
                    'kawaserate' => null,
                    'kawasename' => null,
                    'syouhizeikubun' => null,
                    'yoyakubi' => null,
                    'tantousyabango' => $bango,
                    'kanryoubi' => $szData->sz0037 ?? null,
                ];
                $hikiatesyukko2 = QueryHelper::insertDataWithNullField('hikiatesyukko2', $hikiatesyukko2, 'syouhinid', false, $bango, __CLASS__, __FUNCTION__, __LINE__);                   
            }
            $nyuko = [
                'syouhinid' =>  $syouhinid ?? null,
                'denpyohakkoubi' => $date102 ?? null,
                'kaiinid' => $szData->sz0002 ?? null,
                'denpyoshimebi' => $szData->sz0001 ?? null,
                'denpyobango' => 0,
                // 'yoteibi' => static::getCurrentTime(),
                'yoteibi' => Carbon::now()->format('Y-m-d H:i:s'),
                'tantousyabango' => $bango,
                'kingaku' => $totalSyouhizeiritu,
                'season' => $sz0025 ?? null,
                'yoyakubi' => $date103 ?? null,       
            ]; 
            // dd($hikiatesyukko2, $nyuko); 
            $nyuko = QueryHelper::insertData('nyuko', $nyuko, 'syouhinid', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
            // after create orderhenkan
            $dataNum0014 = PaymentInputDataEntry::stringDataConvertedToIntegerFormat($date101)?? null;
            $unsoumei = QueryHelper::fetchSingleResult("select * from toiawasebango where bikou1 = '$szData->sz0002' and datanum0014 = '$dataNum0014'")->unsoumei ?? null;
            // dd($dataNum0014, $unsoumei);
            $hikiatenyuko = [
                'syouhinid' => $unsoumei ?? null,
                'syouhinsyu' => 1,
            ];
            QueryHelper::updateData('hikiatenyuko', $hikiatenyuko, 'syouhinid', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
            
            $review = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7071'");
            $orderBango = $review->orderbango;
            $orderBango = (int)$orderBango + 1;
            $review = [
                'kokyakusyouhinbango' => 'D7071',
                'orderbango' => $orderBango,
                'jouhou' => PaymentInputDataEntry::getCurrentTime(),
                'color' => PaymentInputDataEntry::getCurrentTime(),
                'size' => request()->ip(),
                'nickname' => $bango,
            ];
            QueryHelper::updateData('review', $review, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);

            $result['status'] = 'ok';
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### payment_data_creation end\n";
            QueryHandler::logger($bango, $log_data);
            pg_query($conn, "COMMIT");
            $result['syouhinid'] = $syouhinid;
        }catch (\Exception $e) {
            // dd($e);
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
            QueryHandler::logger($bango, $log_data);
            pg_query($conn, "ROLLBACK");
            $result['status'] = 'ng';
            $result['exception'] = $e->getMessage();
        }
        return $result;
    }
    public function getK16Data($supplierID, $field1, $field2)
    {
        $yobi12 = substr($supplierID, 0, 6);
        $torihikisakibango = substr($supplierID, 6, 2);
        $haisou = QueryHelper::fetchSingleResult("select * from haisou where shikibetsucode = '$yobi12'  and kounyusu = 0 and torihikisakibango = '$torihikisakibango'");
        $companyData = QueryHelper::fetchSingleResult("select * from kokyaku1 where yobi12 = '$yobi12' and denpyosaiban = 0 ");
        $haisouBango = $haisou->bango ?? null;
        $companyBango = $companyData->bango ?? null;
        $value = null;
        if ($haisouBango) {
            $other2 = QueryHelper::fetchSingleResult("select * from others2 where otherint1 = '$haisouBango'");
            $other1 = $other2->other1 ?? null;
            // dd($supplierID, $field1, $field2, $companyBango, $haisouBango, $other2);
            if ($other1) {
                if (explode(" ", $other1)[0] == '1') {
                    $haisoujouhou = QueryHelper::fetchSingleResult("select * from haisoujouhou where syukei1 = $companyBango");
                    $value = $haisoujouhou->{$field1} ?? null;
                    return $value;
                } elseif (explode(" ", $other1)[0] == '2') {
                    $value = $other2->{$field2} ?? null;
                    return $value;
                }
            }
        }
        return $value;
    }  
}