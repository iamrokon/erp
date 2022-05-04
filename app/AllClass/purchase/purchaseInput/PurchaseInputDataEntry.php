<?php

namespace App\AllClass\purchase\purchaseInput;

use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use App\AllClass\master\CSVLogger;
use App\AllClass\common\CreateHatchuDetails;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;
use App\tantousya;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Helper;
use Exception;

class PurchaseInputDataEntry
{
    public static function create($request, $bango)
    {
        // $res = QueryHelper::fetchResult("select * from toiawasebango where unsoumei = '0851000294'");
        // dd($res);
        // dd(static::checkAndGetCategoryFromSubjects($request['accountingSubject']));
        list($orderRequest, $orderDetailRequests) = static::getProcessedRequests();
        $bangoName = tantousya::find($bango)->name;
        foreach ($orderRequest as $key => $value) {
            if ($key == '_token' || $key == 'type') {
                unset($orderRequest[$key]);
            }
            if ($value == "") {
                $orderRequest[$key] = null;
            }
        }
        $orderRequest = (object)$orderRequest;
        $validator = PurchaseInputValidation::handleSubmit(request()->all());

        $errors = $validator->errors();
        $checker = static::checkAndGetCategoryFromSubjects($request['accountingSubject']);
        // dd($checker);
        $checkStatus = $checker['status'];
        $catSubject = $checker['category'];
        if ($errors->any() || $checkStatus=='no') {
            $result['status'] = 'no';
            $result['errors'] = $errors;
            $result['checkStatus'] = $checkStatus;
            return $result;
        } elseif (!$errors->any()&& $checkStatus=='ok' && $request->confirm_status == 0) {
            $result['status'] = 'confirm';
            return $result;
        } else if ($request->confirm_status == 1 && !$errors->any()&& $checkStatus=='ok') {
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### purchase_input start\n";
            QueryHandler::logger($bango, $log_data);
            $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
            pg_query($conn, "BEGIN");
            try {
                $unsoumei = static::getUnsoumei();
                if($catSubject=='10' || $catSubject=='70'){
                    $order_category = 'U6'.$catSubject;
                }else{
                    $order_category = null;
                }
                if($orderRequest->inspector){
                    $dataint02 = 1;
                }else{
                    $dataint02 = 0;
                }
                // $dataChar06 = ($orderRequest->order_category == 'U150' && $orderRequest->creation_category == '1') ? $orderRequest->number_search : null;
                $toiawasebango = [
                    'unsoumei' =>  $unsoumei ?? null,
                    'toiawasebango' => $order_category ?? null,
                    'konpousu' => $orderRequest->creation_category ?? null,
                    'touchakutime' => static::getEmployeeId($orderRequest->tantou),
                    'bikou1' => $orderRequest->supplier ?? null,
                    'touchakudate' => $orderRequest->purchase_date ?? null,
                    'denpyoname' => $orderRequest->delivery_note ?? null,
                    'dataint01' => static::stringDataConvertedToIntegerFormat($orderRequest->delivery_date)?? null,
                    'bikou2' => $orderRequest->comments ?? null,
                    'dataint02' => static::stringDataConvertedToIntegerFormat($orderRequest->payment_date) ?? null, //convert date
                    'dataint03' => static::stringDataConvertedToIntegerFormat($orderRequest->totalSales, 'comma') ?? null,
                    'datanum0001' => static::stringDataConvertedToIntegerFormat($orderRequest->salesTax, 'comma') ?? null,
                    'datanum0002' => 1,
                    'datanum0008' => null,
                    'datanum0009' => null,
                    'datanum0010' => null,
                    'datanum0011' => null,
                    'datachar01' => null,
                    'datachar02' => null,
                    'datachar03' => '0',
                    'datanum0012' => static::getCurrentTime(),
                    'datatxt0001' => $bango,
                    'datanum0013' => 0,
                    'datanum0014' => null,
                    'datanum0015' => null,
                    'datatxt0002' => '2',
                    'datatxt0019' => '1',
                    'datanum0016' => null
                ];
                // dd($unsoumei,$toiawasebango);
                $toiawasebango = QueryHelper::insertData('toiawasebango', $toiawasebango, 'unsoumei', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                // dd($unsoumei,$toiawasebango);
                // after create orderhenkan
                $hikiatenyuko = [
                    // 'orderbango' => $toiawasebango->bango,
                    'syouhinid' => $toiawasebango->unsoumei ?? null,
                    'syouhinsyu' => 2,
                    'hantei' => 2,
                    'dataint01' => 2,
                    'dataint02' => $dataint02,
                    'dataint03' => null,
                    'dataint04' => null,
                    'dataint05' => null,
                    'dataint06' => null,
                    'dataint07' => null,
                    'dataint08' => null,
                    'dataint09' => null,
                    'datachar01' => null,
                    'datachar02' => null,
                    'datachar03' => null,
                    'datachar06' => static::getEmployeeId($orderRequest->instructor) ?? null,
                    'datachar07' => static::getEmployeeId($orderRequest->inspector) ?? null,
                    'yoteimeter' => 0,
                    'denpyoshimebi' => Carbon::now()->format('Y-m-d H:i:s'),
                    'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'),
                    'tantousyabango' => $bango
                ];
                QueryHelper::insertData('hikiatenyuko', $hikiatenyuko, 'syouhinid', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                foreach ($orderDetailRequests as $request) {
                    $request = (object)$request;
                    if($request->orderNumber){
                        $yoteimeter = substr($request->orderNumber, 10, 3);
                        $idoutanabango = substr($request->orderNumber, 0, 10);
                    }else{
                        $yoteimeter = null;
                        $idoutanabango = null;
                    }
                    $nyukoold = [
                        // 'orderbango' => $toiawasebango->bango,
                        'syouhinid' => $toiawasebango->unsoumei ?? null,
                        'syouhinsyu' => $request->line ?? null,
                        'hantei' => 000,
                        'zaikometer' => 0, 
                        'kingaku' => static::stringDataConvertedToIntegerFormat($request->productUnitPrice, 'comma') ?? null,
                        'nyukosu' => static::stringDataConvertedToIntegerFormat($request->productQuantity, 'comma') ?? null,                       
                        'genka' => null,
                        'syouhizeiritu' => static::stringDataConvertedToIntegerFormat($request->productAmount, 'comma') ?? null,
                        'datachar01' => null,
                        'datachar02' => null,
                        'datachar03' => null,
                        'datachar06' =>  null,
                        'datachar07' => $request->productNumber ?? null,
                        'datachar08' => $request->productName ?? null,
                        'datachar09' => null,
                        'datachar10' => null,
                        'datachar11' => $request->detailedRemarks ?? null,
                        'datachar13' => null,
                        'datachar14' => null,
                        'datachar15' => null,
                        'datachar16' => null,
                        'datachar17' => null,
                        'datachar18' => $request->taxation ?? null,
                        'datachar19' => null,
                        'barcode' => $request->accountingSubject ?? null,
                        'codename' => $request->accountingItems ?? null,
                        'yoteibi' => null,
                        'dataint20' => null,
                        'dataint21' => null,
                        'dataint22' => null,
                        'dataint23' => null,
                        'dataint24' => null,
                        'dataint25' => null,                      
                        'season' => null,
                        'nengetsu' => null,
                        'weeks' => null,
                        'yoyakubi' => null,                       
                        'denpyobango' => 0,
                        'denpyoshimebi' => null,
                        'yoteimeter' => $yoteimeter, //901 hobe
                        'nyukometer' => 0,
                        'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'),
                        'tantousyabango' => $bango,
                        'idoutanabango' => $idoutanabango,//hidden902
                        'soukobango' => static::stringDataConvertedToIntegerFormat($request->productTax, 'comma') ?? null,
                    ];
                    $nyukoold = QueryHelper::insertData('nyukoold', $nyukoold, 'syouhinid', false, $bango, __CLASS__, __FUNCTION__, __LINE__);                   
                }
                $review = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7031'");
                $orderBango = $review->orderbango;
                $orderBango = (int)$orderBango + 1;
                $review = [
                    'kokyakusyouhinbango' => 'D7031',
                    'orderbango' => $orderBango,
                    'jouhou' => static::getCurrentTime(),
                    'color' => static::getCurrentTime(),
                    'size' => request()->ip(),
                    'nickname' => $bango,
                ];
                QueryHelper::updateData('review', $review, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);

                //inserting in rreriki
                CreateHatchuDetails::data($bango,$unsoumei, 0,1,'06-03','purchase_input');

                $result['status'] = 'ok';
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### purchase_input end\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "COMMIT");
                session()->flash('success_msg', "仕入番号" . $unsoumei . "で登録しました。");
                $session_order_bango = $toiawasebango->unsoumei;
                $result['session_order_bango'] = $session_order_bango;
                $result['session_company_code'] = $orderRequest->supplier;
            }catch (\Exception $e) {
                // dd($e);
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "ROLLBACK");
                session()->flash('success_msg', "something" . $unsoumei . "went wrong");
                $result['status'] = 'ng';
                $result['exception'] = $e->getMessage();
            }
            return $result;
        }
    }

    public static function edit($request, $bango)
    {
        list($orderRequest, $orderDetailRequests) = static::getProcessedRequests();
        $bangoName = tantousya::find($bango)->name;
        foreach ($orderRequest as $key => $value) {
            if ($key == '_token' || $key == 'type') {
                unset($orderRequest[$key]);
            }
            if ($value == "") {
                $orderRequest[$key] = null;
            }
        }
        $orderRequest = (object)$orderRequest;
        $validator = PurchaseInputValidation::handleSubmit(request()->all());
        $errors = $validator->errors();
        $checker = static::checkAndGetCategoryFromSubjects($request['accountingSubject']);
        $checkStatus = $checker['status'];
        $catSubject = $checker['category'];
        if ($errors->any() || $checkStatus=='no') {
            $result['status'] = 'no';
            $result['errors'] = $errors;
            $result['checkStatus'] = $checkStatus;
            return $result;
        } elseif (!$errors->any()&& $checkStatus=='ok' && $request->confirm_status == 0) {
            $result['status'] = 'confirm';
            return $result;
        } else if ($request->confirm_status == 1 && !$errors->any()&& $checkStatus=='ok') {
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### purchase_input start\n";
            QueryHandler::logger($bango, $log_data);
            $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
            pg_query($conn, "BEGIN");
            try {
                $purchaseId = $orderRequest->purchase_number;
                if($catSubject=='10' || $catSubject=='70'){
                    $order_category = 'U6'.$catSubject;
                }else{
                    $order_category = null;
                }
                if($orderRequest->inspector){
                    $dataint02 = 1;
                }else{
                    $dataint02 = 0;
                }
                $toiawasebango = [
                    'unsoumei' =>  $purchaseId ?? null,
                    'toiawasebango' => $order_category ?? null,
                    'konpousu' => $orderRequest->creation_category ?? null,
                    'touchakutime' => static::getEmployeeId($orderRequest->tantou),
                    'bikou1' => $orderRequest->supplier ?? null,
                    'touchakudate' => $orderRequest->purchase_date ?? null,
                    'denpyoname' => $orderRequest->delivery_note ?? null,
                    'dataint01' => static::stringDataConvertedToIntegerFormat($orderRequest->delivery_date)?? null,
                    'bikou2' => $orderRequest->comments ?? null,
                    'dataint02' => static::stringDataConvertedToIntegerFormat($orderRequest->payment_date) ?? null, //convert date
                    'dataint03' => static::stringDataConvertedToIntegerFormat($orderRequest->totalSales, 'comma') ?? null,
                    'datanum0001' => static::stringDataConvertedToIntegerFormat($orderRequest->salesTax, 'comma') ?? null,
                    'datanum0002' => 1,
                    'datanum0008' => null,
                    'datanum0009' => null,
                    'datanum0010' => null,
                    'datanum0011' => null,
                    'datachar01' => null,
                    'datachar02' => null,
                    'datachar03' => '0',
                    'datanum0012' => static::getCurrentTime(),
                    'datatxt0001' => $bango,
                    'datanum0013' => (int)($orderRequest->datanum0013) + 1,
                    'datanum0014' => null,
                    'datanum0015' => null,
                    'datatxt0002' => '2',
                    'datatxt0019' => '1',
                    'datanum0016' => null
                ];
                // $toiawasebango = QueryHelper::updateData('toiawasebango', $toiawasebango, 'unsoumei', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                $toiawasebango = QueryHelper::insertData('toiawasebango', $toiawasebango, 'unsoumei', false, $bango, __CLASS__, __FUNCTION__, __LINE__);

                // after create orderhenkan
                $hikiatenyuko = [
                    'syouhinid' => $toiawasebango->unsoumei ?? null,
                    'syouhinsyu' => 2,
                    'hantei' => 2,
                    'dataint01' => 2,
                    'dataint02' => $dataint02,
                    'dataint03' => null,
                    'dataint04' => null,
                    'dataint05' => null,
                    'dataint06' => null,
                    'dataint07' => null,
                    'dataint08' => null,
                    'dataint09' => null,
                    'datachar01' => null,
                    'datachar02' => null,
                    'datachar03' => null,
                    'datachar06' => static::getEmployeeId($orderRequest->instructor) ?? null,
                    'datachar07' => static::getEmployeeId($orderRequest->inspector) ?? null,
                    'yoteimeter' => 0,
                    // 'denpyoshimebi' => Carbon::now()->format('Y-m-d H:i:s'),
                    'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'),
                    'tantousyabango' => $bango
                ];
                QueryHelper::updateData('hikiatenyuko', $hikiatenyuko, 'syouhinid',$bango, __CLASS__, __FUNCTION__, __LINE__);
                foreach ($orderDetailRequests as $request) {
                    $request = (object)$request;
                    if($request->orderNumber){
                        $yoteimeter = substr($request->orderNumber, 10, 3);
                        $idoutanabango = substr($request->orderNumber, 0, 10);
                    }else{
                        $yoteimeter = null;
                        $idoutanabango = null;
                    }
                    $nyukoold = [
                        'syouhinid' => $toiawasebango->unsoumei ?? null,
                        'syouhinsyu' => $request->line ?? null,
                        'hantei' => 000,
                        'zaikometer' => (int)($orderRequest->datanum0013) + 1, 
                        'kingaku' => static::stringDataConvertedToIntegerFormat($request->productUnitPrice, 'comma') ?? null,
                        'nyukosu' => static::stringDataConvertedToIntegerFormat($request->productQuantity, 'comma') ?? null,                       
                        'genka' => null,
                        'syouhizeiritu' => static::stringDataConvertedToIntegerFormat($request->productAmount, 'comma') ?? null,
                        'datachar01' => null,
                        'datachar02' => null,
                        'datachar03' => null,
                        'datachar06' =>  null,
                        'datachar07' => $request->productNumber ?? null,
                        'datachar08' => $request->productName ?? null,
                        'datachar09' => null,
                        'datachar10' => null,
                        'datachar11' => $request->detailedRemarks ?? null,
                        'datachar13' => null,
                        'datachar14' => null,
                        'datachar15' => null,
                        'datachar16' => null,
                        'datachar17' => null,
                        'datachar18' => $request->taxation ?? null,
                        'datachar19' => null,
                        'barcode' => $request->accountingSubject ?? null,
                        'codename' => $request->accountingItems ?? null,
                        'yoteibi' => null,
                        'dataint20' => null,
                        'dataint21' => null,
                        'dataint22' => null,
                        'dataint23' => null,
                        'dataint24' => null,
                        'dataint25' => null,                      
                        'season' => null,
                        'nengetsu' => null,
                        'weeks' => null,
                        'yoyakubi' => null,                       
                        'denpyobango' => 0,
                        'denpyoshimebi' => null,
                        'yoteimeter' => $yoteimeter, //901 hobe
                        'nyukometer' => 0,
                        'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'),
                        'tantousyabango' => $bango,
                        'idoutanabango' => $idoutanabango,//hidden902
                        'soukobango' => static::stringDataConvertedToIntegerFormat($request->productTax, 'comma') ?? null,
                    ];
                    // $nyukoold = QueryHelper::updateData('nyukoold', $nyukoold, ['syouhinid' => $purchaseId,'syouhinsyu' => $request->line], false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                    $nyukoold = QueryHelper::insertData('nyukoold', $nyukoold, 'syouhinid', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                    $juchusyukko2 = [                
                        'denpyoshimebi' => Carbon::now()->format('Y-m-d H:i:s'),
                        // 'day' => 2,
                        'tantousyabango' => $bango,
                        'tanka' => 2,
                    ];
                    QueryHelper::updateData('juchusyukko2', $juchusyukko2, ['syouhinid' => $idoutanabango,'syouhinsyu' => $yoteimeter], $bango, __CLASS__, __FUNCTION__, __LINE__);
                    if($idoutanabango && $yoteimeter){
                        $zaikoMeter = QueryHelper::fetchSingleResult("select max(zaikometer) from minyuko where syouhinid = '$idoutanabango' and syouhinsyu = '$yoteimeter'")->max ?? 0;
                        // $minyukoData = QueryHelper::fetchSingleResult("select  idoutanabango from minyuko where syouhinid = '$idoutanabango' and syouhinsyu = '$yoteimeter' and zaikometer = $zaikoMeter")->get()-first() ?? "";
                        $minyukoData = QueryHelper::select(['idoutanabango'])->from('minyuko')->where("syouhinid = '$idoutanabango' and syouhinsyu = '$yoteimeter' and zaikometer = $zaikoMeter")->get()->first();
                        if($minyukoData && $minyukoData->idoutanabango){
                            $hikiatesyukko = [
                                // 'orderbango' => $orderHenkan->bango,
                                // 'syouhinid' => $minyuko->yoteimeter ?? null,
                                'tantousyabango' => $bango,
                                'datachar16' => '2',
                                'idoutanabango' => static::getCurrentTime()
                            ];
                            QueryHelper::updateData('hikiatesyukko', $hikiatesyukko, ['syouhinid' => $minyukoData->idoutanabango], $bango, __CLASS__, __FUNCTION__, __LINE__);
                        }
                    }
                }

                //inserting into rireki
                $tmp_kokyakuorderbango = $orderRequest->purchase_number ?? null;
                $tmp_ordertypebango2 = (int)($orderRequest->datanum0013) + 1;
                CreateHatchuDetails::data($bango,$tmp_kokyakuorderbango, $tmp_ordertypebango2,2,'06-03','purchase_input');

                $result['status'] = 'ok';
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### purchase_input end\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "COMMIT");
                session()->flash('success_msg', "仕入番号" . $orderRequest->purchase_number . "で登録しました。");
            }catch (\Exception $e) {
                // dd($e);
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "ROLLBACK");
                session()->flash('success_msg', "something" . $orderRequest->purchase_number . "went wrong");
                $result['status'] = 'ng';
                $result['exception'] = $e->getMessage();
            }
            return $result;
        }
    }

    public static function deleteOrder($request, $bango)
    {
        list($orderRequest, $orderDetailRequests) = static::getProcessedRequests();
        $bangoName = tantousya::find($bango)->name;
        foreach ($orderRequest as $key => $value) {
            if ($key == '_token' || $key == 'type') {
                unset($orderRequest[$key]);
            }
            if ($value == "") {
                $orderRequest[$key] = null;
            }
        }
        $orderRequest = (object)$orderRequest;
        $validator = PurchaseInputValidation::handleSubmit(request()->all());
        $errors = $validator->errors();
        $checker = static::checkAndGetCategoryFromSubjects($request['accountingSubject']);
        $checkStatus = $checker['status'];
        $catSubject = $checker['category'];
        if ($errors->any() || $checkStatus=='no') {
            $result['status'] = 'no';
            $result['errors'] = $errors;
            $result['checkStatus'] = $checkStatus;
            return $result;
        } elseif (!$errors->any()&& $checkStatus=='ok' && $request->confirm_status == 0) {
            $result['status'] = 'confirm';
            return $result;
        } else if ($request->confirm_status == 1 && !$errors->any()&& $checkStatus=='ok') {
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### purchase_input start\n";
            QueryHandler::logger($bango, $log_data);
            $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
            pg_query($conn, "BEGIN");
            try {
                $purchaseId = $orderRequest->purchase_number;
                if($catSubject=='10' || $catSubject=='70'){
                    $order_category = 'U6'.$catSubject;
                }else{
                    $order_category = null;
                }
                if($orderRequest->inspector){
                    $dataint02 = 1;
                }else{
                    $dataint02 = 0;
                }
                $toiawasebango = [
                    'unsoumei' =>  $purchaseId ?? null,
                    'toiawasebango' => $order_category ?? null,
                    'konpousu' => $orderRequest->creation_category ?? null,
                    'touchakutime' => static::getEmployeeId($orderRequest->tantou),
                    'bikou1' => $orderRequest->supplier ?? null,
                    'touchakudate' => $orderRequest->purchase_date ?? null,
                    'denpyoname' => $orderRequest->delivery_note ?? null,
                    'dataint01' => static::stringDataConvertedToIntegerFormat($orderRequest->delivery_date)?? null,
                    'bikou2' => $orderRequest->comments ?? null,
                    'dataint02' => static::stringDataConvertedToIntegerFormat($orderRequest->payment_date) ?? null, //convert date
                    'dataint03' => static::stringDataConvertedToIntegerFormat($orderRequest->totalSales, 'comma') ?? null,
                    'datanum0001' => static::stringDataConvertedToIntegerFormat($orderRequest->salesTax, 'comma') ?? null,
                    'datanum0002' => 1,
                    'datanum0008' => null,
                    'datanum0009' => null,
                    'datanum0010' => null,
                    'datanum0011' => null,
                    'datachar01' => null,
                    'datachar02' => null,
                    'datachar03' => '1',
                    'datanum0012' => static::getCurrentTime(),
                    'datatxt0001' => $bango,
                    'datanum0013' => (int)($orderRequest->datanum0013) + 1,
                    'datanum0014' => null,
                    'datanum0015' => null,
                    'datatxt0002' => null,
                    'datatxt0019' => '1',
                    'datanum0016' => null
                ];
                // $toiawasebango = QueryHelper::updateData('toiawasebango', $toiawasebango, 'unsoumei', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                $toiawasebango = QueryHelper::insertData('toiawasebango', $toiawasebango, 'unsoumei', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                // after create orderhenkan
                $hikiatenyuko = [
                    'syouhinid' => $toiawasebango->unsoumei ?? null,
                    'syouhinsyu' => 2,
                    'hantei' => 2,
                    'dataint01' => 2,
                    'dataint02' => $dataint02,
                    'dataint03' => null,
                    'dataint04' => null,
                    'dataint05' => null,
                    'dataint06' => null,
                    'dataint07' => null,
                    'dataint08' => null,
                    'dataint09' => null,
                    'datachar01' => null,
                    'datachar02' => null,
                    'datachar03' => null,
                    // 'datachar06' => static::getEmployeeId($orderRequest->instructor) ?? null,
                    // 'datachar07' => static::getEmployeeId($orderRequest->inspector) ?? null,
                    'yoteimeter' => 1,
                    // 'denpyoshimebi' => Carbon::now()->format('Y-m-d H:i:s'),
                    'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'),
                    'tantousyabango' => $bango
                ];
                QueryHelper::updateData('hikiatenyuko', $hikiatenyuko, 'syouhinid',$bango, __CLASS__, __FUNCTION__, __LINE__);
                foreach ($orderDetailRequests as $request) {
                    $request = (object)$request;
                    if($request->orderNumber){
                        $yoteimeter = substr($request->orderNumber, 10, 3);
                        $idoutanabango = substr($request->orderNumber, 0, 10);
                    }else{
                        $yoteimeter = null;
                        $idoutanabango = null;
                    }
                    $nyukoold = [
                        'syouhinid' => $toiawasebango->unsoumei ?? null,
                        'syouhinsyu' => $request->line ?? null,
                        'hantei' => 000,
                        'zaikometer' => (int)($orderRequest->datanum0013) + 1, 
                        'kingaku' => static::stringDataConvertedToIntegerFormat($request->productUnitPrice, 'comma') ?? null,
                        'nyukosu' => static::stringDataConvertedToIntegerFormat($request->productQuantity, 'comma') ?? null,                       
                        'genka' => null,
                        'syouhizeiritu' => static::stringDataConvertedToIntegerFormat($request->productAmount, 'comma') ?? null,
                        'datachar01' => null,
                        'datachar02' => null,
                        'datachar03' => null,
                        'datachar06' =>  null,
                        'datachar07' => $request->productNumber ?? null,
                        'datachar08' => $request->productName ?? null,
                        'datachar09' => null,
                        'datachar10' => null,
                        'datachar11' => $request->detailedRemarks ?? null,
                        'datachar13' => null,
                        'datachar14' => null,
                        'datachar15' => null,
                        'datachar16' => null,
                        'datachar17' => null,
                        'datachar18' => $request->taxation ?? null,
                        'datachar19' => null,
                        'barcode' => $request->accountingSubject ?? null,
                        'codename' => $request->accountingItems ?? null,
                        'yoteibi' => null,
                        'dataint20' => null,
                        'dataint21' => null,
                        'dataint22' => null,
                        'dataint23' => null,
                        'dataint24' => null,
                        'dataint25' => null,                      
                        'season' => null,
                        'nengetsu' => null,
                        'weeks' => null,
                        'yoyakubi' => null,                       
                        'denpyobango' => 1,
                        'denpyoshimebi' => null,
                        'yoteimeter' => $yoteimeter, //901 hobe
                        'nyukometer' => 0,
                        'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'),
                        'tantousyabango' => $bango,
                        'idoutanabango' => $idoutanabango,//hidden902
                        'soukobango' => static::stringDataConvertedToIntegerFormat($request->productTax, 'comma') ?? null,
                    ];
                    // $nyukoold = QueryHelper::updateData('nyukoold', $nyukoold, ['syouhinid' => $purchaseId,'syouhinsyu' => $request->line], false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                    $nyukoold = QueryHelper::insertData('nyukoold', $nyukoold, 'syouhinid', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                }

                //inserting into rireki
                $tmp_kokyakuorderbango = $orderRequest->purchase_number ?? null;
                $tmp_ordertypebango2 = (int)($orderRequest->datanum0013) + 1;
                CreateHatchuDetails::data($bango,$tmp_kokyakuorderbango, $tmp_ordertypebango2,3,'06-03','purchase_input');

                $result['status'] = 'ok';
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### purchase_input end\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "COMMIT");
                session()->flash('success_msg', "発注番号" . $orderRequest->purchase_number . "で削除しました。");
            }catch (\Exception $e) {
                // dd($e);
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "ROLLBACK");
                session()->flash('success_msg', "something" . $orderRequest->purchase_number . "went wrong");
                $result['status'] = 'ng';
                $result['exception'] = $e->getMessage();
            }
            return $result;
        }
    }

    public static function stringDataConvertedToIntegerFormat($value, $type = null)
    {
        $indicator = $type ? "," : "/";
        if (mb_strpos($value, $indicator)) {
            return str_replace($indicator, "", $value);
        }

        return $value;
    }

    public static function getUnsoumei()
    {
        $kokyakubango1stPart = "08";
        $kokyakubango2ndPart = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7501' ")->orderbango ?? null;
        $repeat = QueryHelper::fetchSingleResult("select review.mobile_flag from review where kokyakusyouhinbango = 'D7031' ")->mobile_flag ?? null;
        $kokyakubango3rdPart = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7031' ")->orderbango ?? null;
        $kokyakubango3rdPart = (int)$kokyakubango3rdPart + 1;
        // dd($kokyakubango3rdPart);
        $kokyakubango3rdPart = sprintf('%0' . $repeat . 'd', $kokyakubango3rdPart);
        return $kokyakubango1stPart . '' . $kokyakubango2ndPart . '' . $kokyakubango3rdPart;
    }

    public static function getProcessedRequests()
    {
        $orderDetailRequestInput = ['line', 'orderNumber', 'productNumber', 'productName', 'productQuantity', 'productUnitPrice', 'productAmount', 'productTax', 'taxation', 'accountingSubject', 'accountingItems', 'detailedRemarks'];
        $orderRequest = request()->except($orderDetailRequestInput);
        $orderDetailRequests = request()->only($orderDetailRequestInput);
        try {
            if (count($orderDetailRequests['line']) > 1) {
                foreach ($orderDetailRequests as $key => $value) {
                    foreach ($value as $newKey => $val) {
                        if ($key == 'line') {
                            if (!$value[$newKey]) {
                                foreach ($orderDetailRequestInput as $rkey) {
                                    unset($orderDetailRequests[$rkey][$newKey]);
                                }
                            }
                        }
                    }
                }
            }

            $orderDetailRequests = static::formatMulDimForm($orderDetailRequests);
        } catch (\Exception $e) {
            dd($e, $orderDetailRequests);
        }

        return [$orderRequest, $orderDetailRequests];
    }

    public static function convertNumberToString($digits, $type = null)
    {
        if ($digits) {
            $key = $type ? $type : 'r17_3cd';
            return QueryHelper::fetchSingleResult("select  $key from v_torihikisaki where torihikisaki_cd  = '$digits'")->$key ?? "";
        }
        return '';
    }
    public static function formatMulDimForm($rows): array
    {
        if (!count($rows)) {
            return [];
        }

        $data = [];

        $keys = collect($rows)->keys()->toArray();

        $iters = $rows[$keys[0]];

        foreach ($iters as $idx => $iter) {
            foreach ($keys as $key) {
                $data[$idx][$key] = $rows[$key][$idx];
            }
        }

        return $data;
    }
    public static function getCurrentTime()
    {
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        return str_replace(" ", "", $mytime);
    }
    public static function getEmployeeId($name){
        if($name){
            $employeId = QueryHelper::fetchSingleResult("select bango from tantousya where name = '$name' ")->bango ?? "";
            return $employeId;
        }
        return "";
    }
    public static function checkAndGetCategoryFromSubjects($subjects){
        // $arr = [];
        // foreach($subjects as $subject){
        //     if($subject){
        //         $cat2 = substr($subject,2);
        //         // dd($cat2);
        //         $res = QueryHelper::fetchSingleResult("select patternsub2 from categorykanri where category1 = 'J1' and category2 = '$cat2' and suchi2 = 0 ")->patternsub2 ?? null;
        //         array_push($arr, $res);
        //     }
        // }
        // dd($arr);
        $isSame = static::same($subjects);
        if($isSame){
            if($subjects[0] == null){
                return ['status'=>'ok','category'=>null];
            }else{
                $cat2 = substr($subjects[0],2);
                $res = QueryHelper::fetchSingleResult("select patternsub2 from categorykanri where category1 = 'J1' and category2 = '$cat2' and suchi2 = 0 ")->patternsub2 ?? null;
                return ['status'=>'ok','category'=>$res];
            }
            
        }else{
            $arr = [];
            foreach($subjects as $subject){
                if($subject){
                    $cat2 = substr($subject,2);
                    $res = QueryHelper::fetchSingleResult("select patternsub2 from categorykanri where category1 = 'J1' and category2 = '$cat2' and suchi2 = 0 ")->patternsub2 ?? null;
                    array_push($arr, $res);
                }
            }
            if(static::same($arr)){
                return ['status'=>'ok','category'=>$arr[0]];
            }
            else{
                return ['status'=>'no','category'=>null];
            }
        }
        return "";
    }
    public static function same($arr) {
        return $arr === array_filter($arr, function ($element) use ($arr) {
            return ($element === $arr[0]);
        });
    }

}
