<?php

namespace App\AllClass\other\grossProfitAdjustmentInput;

use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use App\AllClass\master\CSVLogger;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;
use App\tantousya;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Helper;
use Exception;

class GrossProfitAdjustmentInputDataEntry
{
    public static function create($request, $bango)
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
        $validator = GrossProfitAdjustmentInputValidation::handle(request()->all());

        $errors = $validator->errors();
        if ($errors->any()) {
            return $errors;
        } elseif (!$errors->any() && $request->confirm_status == 0) {
            $result['status'] = 'confirm';
            return $result;
        } else if ($request->confirm_status == 1 && !$errors->any()) {
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### order_entry start\n";
            QueryHandler::logger($bango, $log_data);
            $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
            pg_query($conn, "BEGIN");
            try {
                $order_number = $orderRequest->order_number ?? null;
                // dd($order_number);
                $kokyakuorderbango = null;
                $kaiinId = null;
                if($order_number){
                    $kokyakuorderbango = $order_number;
                    $ordertypebango2 = QueryHelper::fetchSingleResult("select max(ordertypebango2) from orderhenkan where kokyakuorderbango = '$kokyakuorderbango' and datachar10 is null")->max ?? 0;
                    $orderhenkan = QueryHelper::fetchSingleResult("select * from orderhenkan where kokyakuorderbango = '$kokyakuorderbango' and ordertypebango2 = $ordertypebango2 and datachar10 is null") ?? null;
                    $tuhanorder = QueryHelper::fetchSingleResult("select * from tuhanorder where juchubango = '$kokyakuorderbango' and orderbango = '$orderhenkan->bango'") ?? null;
                    $hikiatesyukko = QueryHelper::fetchSingleResult("select * from hikiatesyukko where syouhinid = '$kokyakuorderbango' and orderbango = '$orderhenkan->bango'") ?? null;
                    $misyukko = QueryHelper::fetchResult("select * from misyukko where syouhinid = '$kokyakuorderbango' and orderbango = '$orderhenkan->bango'");
                    $juchusyukko = QueryHelper::fetchResult("select * from juchusyukko where syouhinid = '$kokyakuorderbango' and orderbango = '$orderhenkan->bango'");
                    
                    //Sales Data Fetching
                    $salesOrdertypebango2 = QueryHelper::fetchSingleResult("select max(ordertypebango2) from orderhenkan where kokyakuorderbango = '$kokyakuorderbango' and datachar10 is not null")->max ?? 0;
                    $salesOrderhenkan = QueryHelper::fetchSingleResult("select * from orderhenkan where kokyakuorderbango = '$kokyakuorderbango' and ordertypebango2 = $salesOrdertypebango2 and datachar10 is not null") ?? null;
                    $salesTuhanorder = QueryHelper::fetchSingleResult("select * from tuhanorder where juchubango = '$kokyakuorderbango' and orderbango = '$salesOrderhenkan->bango'") ?? null;
                    $salesHikiatesyukko = QueryHelper::fetchSingleResult("select * from hikiatesyukko where syouhinid = '$kokyakuorderbango' and orderbango = '$salesOrderhenkan->bango'") ?? null;
                    $syukkoold = QueryHelper::fetchResult("select * from syukkoold where syouhinid = '$kokyakuorderbango' and kaiinid = '$salesOrderhenkan->datachar10'");
                    // dd($salesOrderhenkan,$salesTuhanorder,$salesHikiatesyukko,$syukkoold);
                    $lastElement = end($orderDetailRequests);
                    $maxLineNumber = $lastElement['line'];
                    $kaiinId = $salesOrderhenkan->datachar10;

                    //inserting old misyukko data into syukko table
                    foreach ($misyukko as $key => $value) {
                        foreach ($value as $k => $val) {
                            $syukkoInsert[$k] = $val;
                        }
                        $syukkoInsert['yoteimeter'] = $syukkoInsert['yoteimeter'] == '2' ? $syukkoInsert['yoteimeter'] : 0;
                        $syukkoInsert['dataint01'] = (int)($ordertypebango2);
                        $syukkoInsert['syouhinid'] = $kokyakuorderbango;
                        $syukkoInsert['tanabango'] = static::getCurrentTime();
                        $syukkoInsert['tantousyabango'] = $bango;
                        // dd($syukkoInsert);
                        QueryHelper::insertData('syukko', $syukkoInsert, 'syouhinid', true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                    }

                    $orderHenkan1 = [
                        'datachar02' => $orderhenkan->datachar02,
                        'datachar01' => '2',
                        'datachar06' => $orderhenkan->datachar06,
                        'kokyakuorderbango' => $kokyakuorderbango ?? null,
                        'intorder01' => $orderhenkan->intorder01,
                        'intorder02' => $orderhenkan->intorder02,
                        'intorder04' => $orderhenkan->intorder04,
                        'intorder03' => $orderhenkan->intorder03,
                        'intorder05' => $orderhenkan->intorder05,
                        'datachar03' => $orderhenkan->datachar03,
                        'datachar04' => $orderhenkan->datachar04,
                        'ordertypebango2' => $ordertypebango2+1,
                        'datachar11' => $orderhenkan->datachar11,
                        'datachar12' => $orderhenkan->datachar12,
                        'datachar13' => $orderhenkan->datachar13,
                        'datachar14' => $orderhenkan->datachar14,
                        'datachar05' => $orderhenkan->datachar05,
                        'datachar15' => '2',
                        'synchroorderbango' => 0,
                        'synchroorderbango2' => $orderhenkan->synchroorderbango2,
                        'date' => $orderhenkan->date,
                        'orderuserbango' => $bango
                    ];
                    $orderHenkan1 = QueryHelper::insertData('orderhenkan', $orderHenkan1, 'bango', true, $bango, __CLASS__, __FUNCTION__, __LINE__);

                    //Delete old misyukko and juchusyukko data
                    $data = ['syouhinid' => $kokyakuorderbango];
                    QueryHelper::deleteData('misyukko', $data, 'syouhinid', $bango, __CLASS__, __FUNCTION__, __LINE__);
                    QueryHelper::deleteData('juchusyukko', $data, 'syouhinid', $bango, __CLASS__, __FUNCTION__, __LINE__);
                    QueryHelper::deleteData('hikiatesyukko', $data, 'syouhinid', $bango, __CLASS__, __FUNCTION__, __LINE__);
                    //inserting old misyukko data newly
                    $oldLineNumber = 0;
                    $maxSyouhinsyu = 0;
                    $money10 = 0;
                    // $sumAmount = 0;
                    $moneyMax = 0;
                    foreach ($misyukko as $key => $value) {
                        $maxSyouhinsyu = $value->syouhinsyu > $maxSyouhinsyu ? $value->syouhinsyu : $maxSyouhinsyu;
                        $oldLineNumber++;
                        $request = (object)$value;
                        $dataint18 = ((int)$request->dataint18 ?? 0);
                        $money10  += $dataint18;
                        $amount = $dataint18 - (($request->syukkasu*($request->dataint05 + $request->dataint06 + $request->dataint07 + $request->dataint08))-$request->dataint16);
                        $moneyMax += $amount;
                        $misyukko1 = [
                            'orderbango' => $orderHenkan1->bango,
                            'syouhinid' => $kokyakuorderbango ?? null,
                            'kawasename' => $request->kawasename,
                            'syouhinname' => $request->syouhinname,
                            'dataint09' => $request->dataint09,
                            'dataint10' => $request->dataint10,
                            'datachar06' => $request->datachar06,
                            'codename' => $request->codename,
                            'syukkasu' => $request->syukkasu,
                            'dataint04' => $request->dataint04,
                            'dataint05' => $request->dataint05,
                            'dataint06' => $request->dataint06,
                            'dataint07' => $request->dataint07,
                            'dataint08' => $request->dataint08,
                            'datachar01' => $request->datachar01,
                            'datachar02' => $request->datachar02,
                            'dataint16' => $request->dataint16,
                            'dataint17' => 1,
                            'dataint18' =>$request->dataint18,
                            'barcode' => $request->barcode,
                            'datachar07' => $request->datachar07,
                            'datachar08' => $request->datachar08,
                            'datachar09' => $request->datachar09,
                            'datachar15' => $request->datachar15,
                            'datachar16' => $request->datachar16,
                            'datachar17' => $request->datachar17,
                            'datachar22' => $request->datachar22,
                            'datachar12' => $request->datachar12,
                            'datachar05' => $request->datachar05,
                            'datachar03' => $request->datachar03,
                            'datachar04' => $request->datachar04,
                            'syouhinsyu' => $request->syouhinsyu,
                            'hantei' => $request->hantei,
                            'dataint01' => $ordertypebango2+1,
                            'dataint02' => $request->dataint02,
                            'dataint19' => $request->dataint19,
                            'dataint20' => $request->dataint20,
                            'datachar13' => $request->datachar13,
                            'datachar14' => $request->datachar14,
                            'yoteimeter' => $request->yoteimeter,
                            'tanabango' => $request->tanabango,
                            'tantousyabango' => $bango,
                            'datachar21' => $request->datachar21
                        ];
                        QueryHelper::insertData('misyukko', $misyukko1, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                    }
                    foreach($juchusyukko as $request){
                        $request = (object)$request;
                        $juchusyukko1 = [
                            'syouhinid' => $kokyakuorderbango,
                            'syouhinsyu' => $request->syouhinsyu,
                            'hantei' => $request->hantei,
                            'datachar01' => $request->datachar01,
                            'datachar02' => $request->datachar02,
                            'datachar03' => $request->datachar03,
                            'datachar04' => $request->datachar04,
                            'yoteimeter' => $request->yoteimeter,
                            'tanabango' => $request->tanabango,
                            'idoutanabango' => static::getCurrentTime(),
                            'tantousyabango' => $bango,
                            'orderbango' => $orderHenkan1->bango,
                        ];
                        QueryHelper::insertData('juchusyukko', $juchusyukko1, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                    }
                    foreach ($orderDetailRequests as $request) {
                        $request = (object)$request;
                        $newLineNumber = $oldLineNumber + $request->line;
                        $lineNumber = $oldLineNumber + $maxLineNumber + $request->line;
                        $syouhinsyuPositive = $maxSyouhinsyu + $request->line;
                        $syouhinsyuNegative = $maxSyouhinsyu + $maxLineNumber + $request->line;
                        // dd($lineNumber, $maxLineNumber, $request->line);
                        $product = QueryHelper::fetchSingleResult("select * from syouhin1 where kokyakusyouhinbango = '$request->productNumber'") ?? null;
                        $others = QueryHelper::fetchSingleResult("select other2,other21 from others where other1 = '$product->data23'") ?? null;
                        $color = QueryHelper::fetchSingleResult("select color from syouhin4 where bango = '$product->bango'")->color ?? null;
                        $dataint05 = 0;
                        $dataint06 = 0;
                        $dataint07 = 0;
                        $datachar01 = null;
                        $datachar02 = null;
                        if($request->orderAmountClassification == 'V120'){
                            $dataint05 = static::stringDataConvertedToIntegerFormat($request->productUnitPrice, 'comma') ?? 0;
                        }else if($request->orderAmountClassification == 'V130'){
                            $dataint06 = static::stringDataConvertedToIntegerFormat($request->productUnitPrice, 'comma') ?? 0;
                        }else if($request->orderAmountClassification == 'V140'){
                            $dataint07 = static::stringDataConvertedToIntegerFormat($request->productUnitPrice, 'comma') ?? 0;
                        }
                        if($request->orderAmountClassification == 'V110'){
                            $datachar01 = $request->responsiblePerson;
                        }else{
                            $datachar02 = $request->responsiblePerson;
                        }
                        $syukkasu = static::stringDataConvertedToIntegerFormat($request->productQuantity, 'comma') ?? null;
                        $dataint18 = round(static::stringDataConvertedToIntegerFormat($request->productQuantity, 'comma')*static::stringDataConvertedToIntegerFormat($request->productUnitPrice, 'comma'));
                        $dataint08 = 0;
                        $dataint16 = 0;
                        $money10  += (int)$dataint18;
                        $money10 += ((int)$dataint18*(-1));
                        $amount = $dataint18 - (($syukkasu*($dataint05 + $dataint06 + $dataint07 + $dataint08)) - $dataint16);
                        $moneyMax += $amount;
                        $misyukko2 = [
                            'orderbango' => $orderHenkan1->bango,
                            'syouhinid' => $kokyakuorderbango ?? null,
                            'kawasename' => $request->productNumber ?? null,
                            'syouhinname' => $request->productName ?? null,
                            'dataint09' => null,
                            'dataint10' => static::stringDataConvertedToIntegerFormat($orderRequest->order_date) ?? null,
                            'datachar06' => null,
                            'codename' => null,
                            'syukkasu' => static::stringDataConvertedToIntegerFormat($request->productQuantity, 'comma') ?? null,
                            'dataint04' => static::stringDataConvertedToIntegerFormat($request->productUnitPrice, 'comma') ?? null,
                            'dataint05' => $dataint05,
                            'dataint06' => $dataint06,
                            'dataint07' => $dataint07,
                            'dataint08' => 0,
                            'datachar01' => $datachar01,
                            'datachar02' => $datachar02,
                            'dataint16' => 0,
                            'dataint17' => 1,
                            'dataint18' =>round(static::stringDataConvertedToIntegerFormat($request->productQuantity, 'comma')*static::stringDataConvertedToIntegerFormat($request->productUnitPrice, 'comma')),
                            'barcode' => $others->other2 ?? null,
                            'datachar07' => null,
                            'datachar08' => null,
                            'datachar09' => $color,
                            'datachar15' => $product->tokuchou ?? null,
                            'datachar16' => $product->data22 ?? null,
                            'datachar17' => $product->data51 ?? null,
                            'datachar22' => '0000',
                            'datachar12' => $product->url ?? null,
                            'datachar05' => $product->season ?? null,
                            'datachar03' => $product->kongouritsu ?? null,
                            'datachar04' => $product->mdjouhou ?? null,
                            'syouhinsyu' => $syouhinsyuPositive,
                            'hantei' => 0,
                            'dataint01' => $ordertypebango2+1,
                            'dataint02' => $newLineNumber,
                            'dataint19' => static::stringDataConvertedToIntegerFormat($orderRequest->order_date) ?? null,
                            'dataint20' => null,
                            'datachar13' => '1',
                            'datachar14' => $product->data23 ?? null,
                            'yoteimeter' => 0,
                            'tanabango' => static::getCurrentTime(),
                            'tantousyabango' => $bango,
                            'datachar21' => null
                        ];
                        QueryHelper::insertData('misyukko', $misyukko2, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                        $juchusyukko2 = [
                            'syouhinid' => $kokyakuorderbango,
                            'syouhinsyu' => $newLineNumber,
                            'hantei' => 0,
                            'datachar01' => 1,
                            'datachar02' => 2,
                            'datachar03' => 2,
                            'datachar04' => 1,
                            'yoteimeter' => 0,
                            'tanabango' => static::getCurrentTime(),
                            'idoutanabango' => null,
                            'tantousyabango' => $bango,
                            'orderbango' => $orderHenkan1->bango,
                        ];
                        QueryHelper::insertData('juchusyukko', $juchusyukko2, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                        
                        //GrossProfit data insertion
                        $dataint05 = 0;
                        $dataint06 = 0;
                        $dataint07 = 0;
                        if($orderRequest->order_category == 'V120'){
                            $dataint05 = static::stringDataConvertedToIntegerFormat($request->productUnitPrice, 'comma') ?? 0;
                        }else if($orderRequest->order_category == 'V130'){
                            $dataint06 = static::stringDataConvertedToIntegerFormat($request->productUnitPrice, 'comma') ?? 0;
                        }else if($orderRequest->order_category == 'V140'){
                            $dataint07 = static::stringDataConvertedToIntegerFormat($request->productUnitPrice, 'comma') ?? 0;
                        }
                        $syukkasu = (-1) * $syukkasu;
                        $amount = ((-1)*$dataint18) - (($syukkasu*($dataint05 + $dataint06 + $dataint07 + $dataint08)) - $dataint16);
                        $moneyMax += $amount;
                        $misyukkoGrossProfit = [
                            'orderbango' => $orderHenkan1->bango,
                            'syouhinid' => $kokyakuorderbango ?? null,
                            'kawasename' => $request->productNumber ?? null,
                            'syouhinname' => $request->productName ?? null,
                            'dataint09' => null,
                            'dataint10' => static::stringDataConvertedToIntegerFormat($orderRequest->order_date) ?? null,
                            'datachar06' => null,
                            'codename' => null,
                            'syukkasu' => static::stringDataConvertedToIntegerFormat($request->productQuantity, 'comma')*(-1) ?? null,
                            'dataint04' => static::stringDataConvertedToIntegerFormat($request->productUnitPrice, 'comma') ?? null,
                            'dataint05' => $dataint05,
                            'dataint06' => $dataint06,
                            'dataint07' => $dataint07,
                            'dataint08' => 0,
                            'datachar01' => $datachar01,
                            'datachar02' => $datachar02,
                            'dataint16' => 0,
                            'dataint17' => 1,
                            'dataint18' =>(-1)*round(static::stringDataConvertedToIntegerFormat($request->productQuantity, 'comma')*static::stringDataConvertedToIntegerFormat($request->productUnitPrice, 'comma')),
                            'barcode' => $others->other2 ?? null,
                            'datachar07' => null,
                            'datachar08' => null,
                            'datachar09' => $color,
                            'datachar15' => $product->tokuchou ?? null,
                            'datachar16' => $product->data22 ?? null,
                            'datachar17' => $product->data51 ?? null,
                            'datachar22' => '0000',
                            'datachar12' => $product->url ?? null,
                            'datachar05' => $product->season ?? null,
                            'datachar03' => $product->kongouritsu ?? null,
                            'datachar04' => $product->mdjouhou ?? null,
                            'syouhinsyu' => $syouhinsyuNegative,
                            'hantei' => 0,
                            'dataint01' => $ordertypebango2+1,
                            'dataint02' => $lineNumber,
                            'dataint19' => static::stringDataConvertedToIntegerFormat($orderRequest->order_date) ?? null,
                            'dataint20' => null,
                            'datachar13' => '1',
                            'datachar14' => $product->data23 ?? null,
                            'yoteimeter' => 0,
                            'tanabango' => static::getCurrentTime(),
                            'tantousyabango' => $bango,
                            'datachar21' => null
                        ];
                        QueryHelper::insertData('misyukko', $misyukkoGrossProfit, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                        $juchusyukkoGrossProfit = [
                            'syouhinid' => $kokyakuorderbango,
                            'syouhinsyu' => $lineNumber,
                            'hantei' => 0,
                            'datachar01' => 1,
                            'datachar02' => 2,
                            'datachar03' => 2,
                            'datachar04' => 1,
                            'yoteimeter' => 0,
                            'tanabango' => static::getCurrentTime(),
                            'idoutanabango' => null,
                            'tantousyabango' => $bango,
                            'orderbango' => $orderHenkan1->bango,
                        ];
                        // dd($misyukko, $misyukkoGrossProfit, $juchusyukko, $juchusyukkoGrossProfit);
                        QueryHelper::insertData('juchusyukko', $juchusyukkoGrossProfit, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                    }
                    // $moneyMax = $money10 - $sumAmount;
                    // dd($money10,$sumAmount,$moneyMax);
                    $tuhanOrder1 = [
                        'orderbango' => $orderHenkan1->bango,
                        'juchubango' => $kokyakuorderbango ?? null,
                        'information1' => $tuhanorder->information1,
                        'information2' => $tuhanorder->information2,
                        'information3' => $tuhanorder->information3,
                        'information4' => $tuhanorder->information4,
                        'information5' => $tuhanorder->information5,
                        'information6' => $tuhanorder->information6,
                        'juchukubun1' => $tuhanorder->juchukubun1,
                        'kessaihouhou' => $tuhanorder->kessaihouhou,
                        'chumonsyajouhou' => $tuhanorder->chumonsyajouhou,
                        'soufusakijouhou' => $tuhanorder->soufusakijouhou,
                        'housoukubun' => $tuhanorder->housoukubun,
                        'information8' => $orderRequest->voucherRemarks ?? null,
                        'information7' => $orderRequest->houseRemarks ?? null,
                        'information9' => $tuhanorder->information9,
                        'chumonbango' => $tuhanorder->chumonbango,
                        'money10' => $money10,
                        'moneymax' => $moneyMax,
                        'otodoketime' => $tuhanorder->otodoketime,
                    ];
                    QueryHelper::insertData('tuhanorder', $tuhanOrder1, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                    $hikiatesyukko1 = [
                        'orderbango' => $orderHenkan1->bango,
                        'syouhinid' => $kokyakuorderbango ?? null,
                        'datachar01' => $hikiatesyukko->datachar01,
                        'datachar02' => $hikiatesyukko->datachar02,
                        'datachar03' => $hikiatesyukko->datachar03,
                        'datachar04' => $hikiatesyukko->datachar04,
                        'datachar05' => $hikiatesyukko->datachar05,
                        'datachar06' => $hikiatesyukko->datachar06,
                        'datachar07' => $hikiatesyukko->datachar07,
                        'datachar08' => $hikiatesyukko->datachar08,
                        'datachar09' => $hikiatesyukko->datachar09,
                        'datachar10' => $hikiatesyukko->datachar10,
                        'datachar16' => $hikiatesyukko->datachar16,
                        'datachar17' => $hikiatesyukko->datachar17,
                        'datachar18' => $hikiatesyukko->datachar18,
                        'yoteimeter' => 0,
                        'tanabango' => static::getCurrentTime(),
                        'idoutanabango' => null,
                        'tantousyabango' => $bango
                    ];
                    // dd($orderHenkan1, $tuhanOrder1,$hikiatesyukko1);
                    QueryHelper::insertData('hikiatesyukko', $hikiatesyukko1, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                    
                    
                    // $review = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7011'");
                    // $orderBango = $review->orderbango;
                    // $orderBango = (int)$orderBango + 1;
                    // $review = [
                    //     'kokyakusyouhinbango' => 'D7011',
                    //     'orderbango' => $orderBango,
                    //     'jouhou' => static::getCurrentTime(),
                    //     'color' => static::getCurrentTime(),
                    //     'size' => request()->ip(),
                    //     'nickname' => $bango,
                    // ];
                    // QueryHelper::updateData('review', $review, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                    
                    //Sales Data Insertion
                    $orderhenkan_insert_data = [
                        'datachar01' => '2',
                        'datachar02' => $salesOrderhenkan->datachar02,
                        'datachar10' => $kaiinId,
                        'kokyakuorderbango' => $kokyakuorderbango ?? null,
                        'intorder01' => $salesOrderhenkan->intorder01,
                        'intorder03' => $salesOrderhenkan->intorder03,
                        'intorder05' => $salesOrderhenkan->intorder05,
                        'datachar03' => null,
                        'datachar04' => null,
                        'datachar05' => $salesOrderhenkan->datachar05,
                        'ordertypebango2' => $salesOrdertypebango2+1,
                        'synchroorderbango' => 0,
                        'date' => Carbon::now()->format('Y-m-d H:i:s'),
                        'orderuserbango' => $bango
                    ];
                    $orderHenkan2 = QueryHelper::insertData('orderhenkan',$orderhenkan_insert_data,'bango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                    
                    $tuhanorder_insert_data = [
                        'orderbango' => $orderHenkan2->bango,
                        'juchubango' => $kokyakuorderbango ?? null,
                        'juchukubun2' => $kaiinId,
                        'information1' => $salesTuhanorder->information1,
                        'information2' => $salesTuhanorder->information2,
                        'information3' => $salesTuhanorder->information3,
                        'information4' => $salesTuhanorder->information4,
                        'information5' => $salesTuhanorder->information5,
                        'information6' => $salesTuhanorder->information6,
                    //     'juchukubun1' => $orderDetailRequests[0]['productName'] ?? null,
                        'kessaihouhou' => $salesTuhanorder->kessaihouhou,
                        'housoukubun' => $salesTuhanorder->housoukubun,
                        'information8' => $orderRequest->voucherRemarks ?? null,
                        'information7' => $orderRequest->houseRemarks ?? null,
                    //     'money10' => null,
                    //     'moneymax' => null,
                        'otodoketime' => $salesTuhanorder->otodoketime,
                        'text1' => $salesTuhanorder->text1,
                        'text2' => $salesTuhanorder->text2,
                        'text3' => $salesTuhanorder->text3,
                        'text4' => $salesTuhanorder->text4,
                        'text5' => '2000',
                        'numeric2' => $salesTuhanorder->numeric2,
                        'numeric3' => $money10,
                        'numeric4' => $salesTuhanorder->numeric4,
                        'unsoudaibikitesuryou' => $salesTuhanorder->unsoudaibikitesuryou,
                        'unsoutesuryou' => $salesTuhanorder->unsoutesuryou
                    ];
                    $tuhanorder2 = QueryHelper::insertData('tuhanorder',$tuhanorder_insert_data,'orderbango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                    $hikiatesyukko_insert_data = [
                        'orderbango' => $orderHenkan2->bango,
                        'syouhinid' => $kokyakuorderbango ?? null,
                        'kaiinid' => $kaiinId,
                        'dataint01' => $salesHikiatesyukko->dataint01,
                        'dataint02' => $salesHikiatesyukko->dataint02,
                        'dataint03' => $salesHikiatesyukko->dataint03,
                        'dataint04' => $salesHikiatesyukko->dataint04,
                        'dataint05' => $salesHikiatesyukko->dataint05,
                        'dataint06' => $salesHikiatesyukko->dataint06,
                        'dataint07' => $salesHikiatesyukko->dataint07,
                        'dataint08' => $salesHikiatesyukko->dataint08,
                        'dataint09' => $salesHikiatesyukko->dataint09,
                        'datachar10' => $salesHikiatesyukko->datachar10,
                        'datachar11' => $salesHikiatesyukko->datachar11,
                        'datachar12' => $salesHikiatesyukko->datachar12,
                        'datachar13' => $salesHikiatesyukko->datachar13,
                        'datachar14' => $salesHikiatesyukko->datachar14,
                        'datachar15' => $salesHikiatesyukko->datachar15,
                        'datachar16' => null,
                        'datachar17' => null,
                        'datachar18' => null,
                        'yoteimeter' => 0,
                        'tanabango' => $salesHikiatesyukko->tanabango,
                        'idoutanabango' => static::getCurrentTime(),
                        'tantousyabango' => $bango
                    ];
                    QueryHelper::insertData('hikiatesyukko', $hikiatesyukko_insert_data, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                    
                    //inserting old misyukko data into syukko table
                    $maxSyouhinsyu = 0;
                    $maxDataint02 = 0;
                    foreach ($syukkoold as $key => $value) {
                        $maxSyouhinsyu = $value->syouhinsyu > $maxSyouhinsyu ? $value->syouhinsyu : $maxSyouhinsyu;
                        $maxDataint02++;
                        foreach ($value as $k => $val) {
                            $syukkooldInsert[$k] = $val;
                        }
                        $syukkooldInsert['yoteimeter'] = 0;
                        $syukkooldInsert['dataint01'] = $salesOrdertypebango2+1;
                        $syukkooldInsert['syouhinid'] = $kokyakuorderbango;
                        // $syukkooldInsert['tanabango'] = static::getCurrentTime();
                        $syukkooldInsert['tantousyabango'] = $bango;
                        $syukkooldInsert['orderbango'] = $orderHenkan2->bango;
                        // dd($syukkooldInsert);
                        QueryHelper::updateData('syukkoold', $syukkooldInsert, ['syouhinid' => $kokyakuorderbango,'dataint02' => $value->dataint02], false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                    }
                    foreach ($orderDetailRequests as $request) {
                        $request = (object)$request;
                        $syukkoold = [
                            'orderbango' => $orderHenkan2->bango,
                            'kaiinid' =>$kaiinId,
                            'syouhinid' => $kokyakuorderbango ?? null,
                            'kawasename' => $request->productNumber ?? null,
                            'syouhinname' => $request->productName ?? null,
                            'datachar10' => null,
                            'datachar18' => null,
                            'codename' => null,
                            'syukkasu' => static::stringDataConvertedToIntegerFormat($request->productQuantity, 'comma') ?? null,
                            'dataint04' => static::stringDataConvertedToIntegerFormat($request->productUnitPrice, 'comma') ?? null,
                            'datachar19' =>round(static::stringDataConvertedToIntegerFormat($request->productQuantity, 'comma')*static::stringDataConvertedToIntegerFormat($request->productUnitPrice, 'comma')),
                            'datachar20' => '0',
                            'datachar08' => null,
                            'syouhinsyu' => $maxSyouhinsyu + $request->line,
                            'hantei' => 0,
                            'dataint01' => $salesOrdertypebango2+1,
                            'dataint02' => $maxDataint02 + $request->line,
                            'dataint14' => null,
                            'dataint15' => null,
                            'datachar13' => '1',
                            'yoteimeter' => 0,
                            'tanabango' => static::getCurrentTime(),
                            'tantousyabango' => $bango,
                        ];
                        QueryHelper::insertData('syukkoold', $syukkoold, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                    }

                    // $review1 = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7051'");
                    // $orderBango = $review1->orderbango;
                    // $orderBango = (int)$orderBango + 1;
                    // $review1 = [
                    //     'kokyakusyouhinbango' => 'D7051',
                    //     'orderbango' => $orderBango,
                    //     'jouhou' => static::getCurrentTime(),
                    //     'color' => static::getCurrentTime(),
                    //     'size' => request()->ip(),
                    //     'nickname' => $bango,
                    // ];
                    // QueryHelper::updateData('review', $review1, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);

                    $result['status'] = 'ok';
                    $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### order_entry end\n";
                    QueryHandler::logger($bango, $log_data);
                    pg_query($conn, "COMMIT");
                    session()->flash('success_msg', '受注番号'.$kokyakuorderbango.'売上番号'.$kaiinId. 'で登録しました');
                }else{
                    $kokyakuorderbango = static::getKokyakuOrderBango();
                    $lastElement = end($orderDetailRequests);
                    $maxLineNumber = $lastElement['line'];
                    $kaiinId = static::getKaiinId();
                    $orderHenkan = [
                        'datachar02' => 'U110',
                        'datachar01' => '1',
                        'datachar06' => null,
                        'kokyakuorderbango' => $kokyakuorderbango ?? null,
                        'intorder01' => static::stringDataConvertedToIntegerFormat($orderRequest->order_date) ?? null,
                        'intorder02' => static::stringDataConvertedToIntegerFormat($orderRequest->order_date) ?? null,
                        'intorder04' => static::stringDataConvertedToIntegerFormat($orderRequest->order_date) ?? null,
                        'intorder03' => static::stringDataConvertedToIntegerFormat($orderRequest->order_date) ?? null,
                        'intorder05' => static::stringDataConvertedToIntegerFormat($orderRequest->order_date) ?? null,
                        'datachar03' => null,
                        'datachar04' => null,
                        'ordertypebango2' => 0,
                        'datachar05' => $orderRequest->employee_cd ?? null,
                        'datachar14' => static::stringDataConvertedToIntegerFormat($orderRequest->order_date) ?? null,
                        'datachar15' => '2',
                        'synchroorderbango' => 0,
                        'date' => Carbon::now()->format('Y-m-d H:i:s'),
                        'orderuserbango' => $bango
                    ];
                    $orderHenkan = QueryHelper::insertData('orderhenkan', $orderHenkan, 'bango', true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                    
                    $moneyMax = 0;
                    $money10 = 0;
                    $sumAmount = 0;
                    foreach ($orderDetailRequests as $request) {
                        $request = (object)$request;
                        $lineNumber = $maxLineNumber + $request->line;
                        // dd($lineNumber, $maxLineNumber, $request->line);
                        $product = QueryHelper::fetchSingleResult("select * from syouhin1 where kokyakusyouhinbango = '$request->productNumber'") ?? null;
                        $others = QueryHelper::fetchSingleResult("select other2,other21 from others where other1 = '$product->data23'") ?? null;
                        $color = QueryHelper::fetchSingleResult("select color from syouhin4 where bango = '$product->bango'")->color ?? null;
                        $dataint05 = 0;
                        $dataint06 = 0;
                        $dataint07 = 0;
                        $datachar01 = null;
                        $datachar02 = null;
                        if($request->orderAmountClassification == 'V120'){
                            $dataint05 = static::stringDataConvertedToIntegerFormat($request->productUnitPrice, 'comma') ?? 0;
                        }else if($request->orderAmountClassification == 'V130'){
                            $dataint06 = static::stringDataConvertedToIntegerFormat($request->productUnitPrice, 'comma') ?? 0;
                        }else if($request->orderAmountClassification == 'V140'){
                            $dataint07 = static::stringDataConvertedToIntegerFormat($request->productUnitPrice, 'comma') ?? 0;
                        }
                        if($request->orderAmountClassification == 'V110'){
                            $datachar01 = $request->responsiblePerson;
                        }else{
                            $datachar02 = $request->responsiblePerson;
                        }
                        $syukkasu = static::stringDataConvertedToIntegerFormat($request->productQuantity, 'comma') ?? null;
                        $dataint18 = round(static::stringDataConvertedToIntegerFormat($request->productQuantity, 'comma')*static::stringDataConvertedToIntegerFormat($request->productUnitPrice, 'comma'));
                        $dataint08 = 0;
                        $dataint16 = 0;
                        $money10  += (int)$dataint18;
                        $money10 += ((int)$dataint18*(-1));
                        $amount = $dataint18 - (($syukkasu*($dataint05 + $dataint06 + $dataint07 + $dataint08)) - $dataint16);
                        // $sumAmount += $amount;
                        $moneyMax += $amount;
                        $misyukko = [
                            'orderbango' => $orderHenkan->bango,
                            'syouhinid' => $kokyakuorderbango ?? null,
                            'kawasename' => $request->productNumber ?? null,
                            'syouhinname' => $request->productName ?? null,
                            'dataint09' => null,
                            'dataint10' => static::stringDataConvertedToIntegerFormat($orderRequest->order_date) ?? null,
                            'datachar06' => null,
                            'codename' => null,
                            'syukkasu' => static::stringDataConvertedToIntegerFormat($request->productQuantity, 'comma') ?? null,
                            'dataint04' => static::stringDataConvertedToIntegerFormat($request->productUnitPrice, 'comma') ?? null,
                            'dataint05' => $dataint05,
                            'dataint06' => $dataint06,
                            'dataint07' => $dataint07,
                            'dataint08' => 0,
                            'datachar01' => $datachar01,
                            'datachar02' => $datachar02,
                            'dataint16' => 0,
                            'dataint17' => 1,
                            'dataint18' =>round(static::stringDataConvertedToIntegerFormat($request->productQuantity, 'comma')*static::stringDataConvertedToIntegerFormat($request->productUnitPrice, 'comma')) ,
                            'barcode' => $others->other2 ?? null,
                            'datachar07' => null,
                            'datachar08' => null,
                            'datachar09' => $color,
                            'datachar15' => $product->tokuchou ?? null,
                            'datachar16' => $product->data22 ?? null,
                            'datachar17' => $product->data51 ?? null,
                            'datachar22' => '0000',
                            'datachar12' => $product->url ?? null,
                            'datachar05' => $product->season ?? null,
                            'datachar03' => $product->kongouritsu ?? null,
                            'datachar04' => $product->mdjouhou ?? null,
                            'syouhinsyu' => $request->line ?? null,
                            'hantei' => 0,
                            'dataint01' => 0,
                            'dataint02' => $request->line,
                            'dataint19' => static::stringDataConvertedToIntegerFormat($orderRequest->order_date) ?? null,
                            'dataint20' => null,
                            'datachar13' => '1',
                            'datachar14' => $product->data23 ?? null,
                            'yoteimeter' => 0,
                            'tanabango' => static::getCurrentTime(),
                            'tantousyabango' => $bango,
                            'datachar21' => null
                        ];
                        QueryHelper::insertData('misyukko', $misyukko, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                        $juchusyukko = [
                            'syouhinid' => $kokyakuorderbango,
                            'syouhinsyu' => $request->line,
                            'hantei' => 0,
                            'datachar01' => 1,
                            'datachar02' => 2,
                            'datachar03' => 2,
                            'datachar04' => 1,
                            'yoteimeter' => 0,
                            'tanabango' => static::getCurrentTime(),
                            'idoutanabango' => null,
                            'tantousyabango' => $bango,
                            'orderbango' => $orderHenkan->bango,
                        ];
                        QueryHelper::insertData('juchusyukko', $juchusyukko, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                        
                        //GrossProfit data insertion
                        $dataint05 = 0;
                        $dataint06 = 0;
                        $dataint07 = 0;
                        if($orderRequest->order_category == 'V120'){
                            $dataint05 = static::stringDataConvertedToIntegerFormat($request->productUnitPrice, 'comma') ?? 0;
                        }else if($orderRequest->order_category == 'V130'){
                            $dataint06 = static::stringDataConvertedToIntegerFormat($request->productUnitPrice, 'comma') ?? 0;
                        }else if($orderRequest->order_category == 'V140'){
                            $dataint07 = static::stringDataConvertedToIntegerFormat($request->productUnitPrice, 'comma') ?? 0;
                        }
                        $syukkasu = (-1) * $syukkasu;
                        $amount = ((-1)*$dataint18) - (($syukkasu*($dataint05 + $dataint06 + $dataint07 + $dataint08)) - $dataint16);
                        $moneyMax += $amount;
                        $misyukkoGrossProfit = [
                            'orderbango' => $orderHenkan->bango,
                            'syouhinid' => $kokyakuorderbango ?? null,
                            'kawasename' => $request->productNumber ?? null,
                            'syouhinname' => $request->productName ?? null,
                            'dataint09' => null,
                            'dataint10' => static::stringDataConvertedToIntegerFormat($orderRequest->order_date) ?? null,
                            'datachar06' => null,
                            'codename' => null,
                            'syukkasu' => static::stringDataConvertedToIntegerFormat($request->productQuantity, 'comma')*(-1) ?? null,
                            'dataint04' => static::stringDataConvertedToIntegerFormat($request->productUnitPrice, 'comma') ?? null,
                            'dataint05' => $dataint05,
                            'dataint06' => $dataint06,
                            'dataint07' => $dataint07,
                            'dataint08' => 0,
                            'datachar01' => $datachar01,
                            'datachar02' => $datachar02,
                            'dataint16' => 0,
                            'dataint17' => 1,
                            'dataint18' =>(-1)*round(static::stringDataConvertedToIntegerFormat($request->productQuantity, 'comma')*static::stringDataConvertedToIntegerFormat($request->productUnitPrice, 'comma')),
                            'barcode' => $others->other2 ?? null,
                            'datachar07' => null,
                            'datachar08' => null,
                            'datachar09' => $color,
                            'datachar15' => $product->tokuchou ?? null,
                            'datachar16' => $product->data22 ?? null,
                            'datachar17' => $product->data51 ?? null,
                            'datachar22' => '0000',
                            'datachar12' => $product->url ?? null,
                            'datachar05' => $product->season ?? null,
                            'datachar03' => $product->kongouritsu ?? null,
                            'datachar04' => $product->mdjouhou ?? null,
                            'syouhinsyu' => $lineNumber ?? null,
                            'hantei' => 0,
                            'dataint01' => 0,
                            'dataint02' => $lineNumber,
                            'dataint19' => static::stringDataConvertedToIntegerFormat($orderRequest->order_date) ?? null,
                            'dataint20' => null,
                            'datachar13' => '1',
                            'datachar14' => $product->data23 ?? null,
                            'yoteimeter' => 0,
                            'tanabango' => static::getCurrentTime(),
                            'tantousyabango' => $bango,
                            'datachar21' => null
                        ];
                        QueryHelper::insertData('misyukko', $misyukkoGrossProfit, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                        $juchusyukkoGrossProfit = [
                            'syouhinid' => $kokyakuorderbango,
                            'syouhinsyu' => $lineNumber,
                            'hantei' => 0,
                            'datachar01' => 1,
                            'datachar02' => 2,
                            'datachar03' => 2,
                            'datachar04' => 1,
                            'yoteimeter' => 0,
                            'tanabango' => static::getCurrentTime(),
                            'idoutanabango' => null,
                            'tantousyabango' => $bango,
                            'orderbango' => $orderHenkan->bango,
                        ];
                        // dd($misyukko, $misyukkoGrossProfit, $juchusyukko, $juchusyukkoGrossProfit);
                        QueryHelper::insertData('juchusyukko', $juchusyukkoGrossProfit, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                    }
                    // $moneyMax = $money10 - $sumAmount;
                    $tohanOrder = [
                        'orderbango' => $orderHenkan->bango,
                        'juchubango' => $orderHenkan->kokyakuorderbango ?? null,
                        'information1' => '00000101001',
                        'information2' => '00000101001',
                        'information3' => '00000101001',
                        'information4' => null,
                        'information5' => null,
                        'information6' => '00000101001',
                        'juchukubun1' => $orderDetailRequests[0]['productName'] ?? null,
                        'kessaihouhou' => 'A901',
                        'chumonsyajouhou' => 'U24',
                        'soufusakijouhou' => 'U31',
                        'housoukubun' => '1',
                        'information8' => $orderRequest->voucherRemarks ?? null,
                        'information7' => $orderRequest->houseRemarks ?? null,
                        'money10' => $money10,
                        'moneymax' => $moneyMax,
                        'otodoketime' => 'B110',
                    ];
                    QueryHelper::insertData('tuhanorder', $tohanOrder, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                    $hikiatesyukko = [
                        'orderbango' => $orderHenkan->bango,
                        'syouhinid' => $kokyakuorderbango ?? null,
                        'datachar01' => '3',
                        'datachar02' => $bango,
                        'datachar03' => $bango,
                        'datachar04' => '1',
                        'datachar05' => null,
                        'datachar06' => '2',
                        'datachar07' => null,
                        'datachar08' => '',
                        'datachar09' => '2',
                        'datachar10' => '2',
                        'datachar16' => '1',
                        'datachar17' => $bango,
                        'datachar18' => $bango,
                        'yoteimeter' => 0,
                        'tanabango' => static::getCurrentTime(),
                        'idoutanabango' => null,
                        'tantousyabango' => $bango
                    ];
                    QueryHelper::insertData('hikiatesyukko', $hikiatesyukko, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                    

                    $review = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7011'");
                    $orderBango = $review->orderbango;
                    $orderBango = (int)$orderBango + 1;
                    $review = [
                        'kokyakusyouhinbango' => 'D7011',
                        'orderbango' => $orderBango,
                        'jouhou' => static::getCurrentTime(),
                        'color' => static::getCurrentTime(),
                        'size' => request()->ip(),
                        'nickname' => $bango,
                    ];
                    QueryHelper::updateData('review', $review, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                    
                    //Sales Data Insertion
                    $orderhenkan_insert_data = [
                        'datachar01' => '1',
                        'datachar10' => $kaiinId,
                        'kokyakuorderbango' => $kokyakuorderbango ?? null,
                        'intorder01' => static::stringDataConvertedToIntegerFormat($orderRequest->order_date) ?? null,
                        'intorder03' => static::stringDataConvertedToIntegerFormat($orderRequest->order_date) ?? null,
                        'intorder05' => static::stringDataConvertedToIntegerFormat($orderRequest->order_date) ?? null,
                        'datachar02' => 'U110',
                        'datachar03' => null,
                        'datachar04' => null,
                        'datachar05' => $orderRequest->employee_cd ?? null,
                        'ordertypebango2' => 0,
                        'synchroorderbango' => 0,
                        'date' => Carbon::now()->format('Y-m-d H:i:s'),
                        'orderuserbango' => $bango
                    ];
                    $orderHenkan2 = QueryHelper::insertData('orderhenkan',$orderhenkan_insert_data,'bango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                    
                    $tuhanorder_insert_data = [
                        'orderbango' => $orderHenkan2->bango,
                        'juchubango' => $kokyakuorderbango ?? null,
                        'juchukubun2' => $kaiinId,
                        'information1' => '00000101001',
                        'information2' => '00000101001',
                        'information3' => '00000101001',
                        'information4' => null,
                        'information5' => null,
                        'information6' => '00000101001',
                        // 'juchukubun1' => $orderDetailRequests[0]['productName'] ?? null,
                        'kessaihouhou' => 'A901',
                        'housoukubun' => '1',
                        'information8' => $orderRequest->voucherRemarks ?? null,
                        'information7' => $orderRequest->houseRemarks ?? null,
                        'money10' => null,
                        'moneymax' => null,
                        'otodoketime' => 'B110',
                        'text1' => 'U510',
                        'text2' => $orderRequest->employee_cd ?? null,
                        'text3' => null,
                        'text4' => null,
                        'text5' => '2000',
                        'numeric2' => static::stringDataConvertedToIntegerFormat($orderRequest->order_date) ?? null,
                        'numeric3' => $money10,
                        'numeric4' => 0,
                        'unsoudaibikitesuryou' => 1,
                        'unsoutesuryou' => 1
                    ];
                    $tuhanorder = QueryHelper::insertData('tuhanorder',$tuhanorder_insert_data,'orderbango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                    $hikiatesyukko_insert_data = [
                        'orderbango' => $orderHenkan2->bango,
                        'syouhinid' => $kokyakuorderbango ?? null,
                        'kaiinid' => $kaiinId,
                        'dataint01' => 1,
                        'dataint02' => 2,
                        'dataint03' => 9,
                        'dataint04' => 1,
                        'dataint05' => null,
                        'dataint06' => 1,
                        'dataint07' => 2,
                        'dataint08' => 2,
                        'dataint09' => 2,
                        'datachar10' => null,
                        'datachar16' => null,
                        'datachar17' => null,
                        'datachar18' => null,
                        'yoteimeter' => 0,
                        'tanabango' => static::getCurrentTime(),
                        'idoutanabango' => null,
                        'tantousyabango' => $bango
                    ];
                    QueryHelper::insertData('hikiatesyukko', $hikiatesyukko_insert_data, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                    
                    foreach ($orderDetailRequests as $request) {
                        $request = (object)$request;
                        $syukkoold = [
                            'orderbango' => $orderHenkan2->bango,
                            'kaiinid' =>$kaiinId,
                            'syouhinid' => $kokyakuorderbango ?? null,
                            'kawasename' => $request->productNumber ?? null,
                            'syouhinname' => $request->productName ?? null,
                            'datachar10' => null,
                            'datachar18' => null,
                            'codename' => null,
                            'syukkasu' => static::stringDataConvertedToIntegerFormat($request->productQuantity, 'comma') ?? null,
                            'dataint04' => static::stringDataConvertedToIntegerFormat($request->productUnitPrice, 'comma') ?? null,
                            'datachar19' =>round(static::stringDataConvertedToIntegerFormat($request->productQuantity, 'comma')*static::stringDataConvertedToIntegerFormat($request->productUnitPrice, 'comma')),
                            'datachar20' => '0',
                            'datachar08' => null,
                            'syouhinsyu' => $request->line ?? null,
                            'hantei' => 0,
                            'dataint01' => 0,
                            'dataint02' => $request->line,
                            'dataint14' => null,
                            'dataint15' => null,
                            'datachar13' => '1',
                            'yoteimeter' => 0,
                            'tanabango' => static::getCurrentTime(),
                            'tantousyabango' => $bango,
                        ];
                        QueryHelper::insertData('syukkoold', $syukkoold, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                    }

                    $review1 = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7051'");
                    $orderBango = $review1->orderbango;
                    $orderBango = (int)$orderBango + 1;
                    $review1 = [
                        'kokyakusyouhinbango' => 'D7051',
                        'orderbango' => $orderBango,
                        'jouhou' => static::getCurrentTime(),
                        'color' => static::getCurrentTime(),
                        'size' => request()->ip(),
                        'nickname' => $bango,
                    ];
                    QueryHelper::updateData('review', $review1, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);

                    $result['status'] = 'ok';
                    $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### order_entry end\n";
                    QueryHandler::logger($bango, $log_data);
                    pg_query($conn, "COMMIT");
                    session()->flash('success_msg', '受注番号'.$kokyakuorderbango.'売上番号'.$kaiinId. 'で登録しました');
                }
            } catch (\Exception $e) {
                // dd($e);
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "ROLLBACK");
                session()->flash('success_msg', "something" . $kokyakuorderbango . "went wrong");
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
    public static function getKokyakuOrderBango()
    {
        $kokyakubango1stPart = "01";
        $kokyakubango2ndPart = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7501' ")->orderbango ?? null;
        $repeat = QueryHelper::fetchSingleResult("select review.mobile_flag from review where kokyakusyouhinbango = 'D7011' ")->mobile_flag ?? null;
        $kokyakubango3rdPart = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7011' ")->orderbango ?? null;
        $kokyakubango3rdPart = (int)$kokyakubango3rdPart + 1;
        $kokyakubango3rdPart = sprintf('%0' . $repeat . 'd', $kokyakubango3rdPart);
        return $kokyakubango1stPart . '' . $kokyakubango2ndPart . '' . $kokyakubango3rdPart;
    }
    public static function getKaiinId()
    {
        $kokyakubango1stPart = "09";
        $kokyakubango2ndPart = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7501' ")->orderbango ?? null;
        $repeat = QueryHelper::fetchSingleResult("select review.mobile_flag from review where kokyakusyouhinbango = 'D7051' ")->mobile_flag ?? null;
        $kokyakubango3rdPart = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7051' ")->orderbango ?? null;
        $kokyakubango3rdPart = (int)$kokyakubango3rdPart + 1;
        $kokyakubango3rdPart = sprintf('%0' . $repeat . 'd', $kokyakubango3rdPart);
        return $kokyakubango1stPart . '' . $kokyakubango2ndPart . '' . $kokyakubango3rdPart;
    }

    public static function getProcessedRequests()
    {
        $orderDetailRequestInput = ['line', 'productNumber', 'productName', 'productQuantity', 'productUnitPrice', 'orderAmountClassification','responsiblePerson', 'productAmount'];
        $orderRequest = request()->except($orderDetailRequestInput);
        $orderDetailRequests = request()->only($orderDetailRequestInput);
        try {
            if (count($orderDetailRequests['productNumber']) > 1) {
                foreach ($orderDetailRequests as $key => $value) {
                    foreach ($value as $newKey => $val) {
                        if ($key == 'productNumber') {
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
}