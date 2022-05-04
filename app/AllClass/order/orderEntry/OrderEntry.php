<?php

namespace App\AllClass\order\orderEntry;

use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use App\AllClass\master\CSVLogger;
use App\AllClass\common\CreateOrderDetails;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;
use App\tantousya;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Helper;
use Exception;

class OrderEntry
{

    public static function create($request, $bango, $file)
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
        $validator = OrderEntryCreateValidation::handle(request()->all());

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
                $kokyakuorderbango = static::getKokyakuOrderBango();
                $dataChar06 = ($orderRequest->order_category == 'U150' && $orderRequest->creation_category == '1') ? $orderRequest->number_search : null;
                $orderHenkan = [
                    'datachar02' => $orderRequest->order_category ?? null,
                    'datachar01' => $orderRequest->creation_category ?? null,
                    'datachar06' => $dataChar06,
                    'kokyakuorderbango' => $kokyakuorderbango ?? null,
                    'intorder01' => static::stringDataConvertedToIntegerFormat($orderRequest->order_date) ?? null,
                    'intorder02' => static::stringDataConvertedToIntegerFormat($orderRequest->delivery_date) ?? null,
                    'intorder04' => static::stringDataConvertedToIntegerFormat($orderRequest->inspection_date) ?? null,
                    'intorder03' => static::stringDataConvertedToIntegerFormat($orderRequest->sales_date) ?? null,
                    'intorder05' => static::stringDataConvertedToIntegerFormat($orderRequest->payment_date) ?? null,
                    'datachar03' => $orderRequest->pj ?? null,
                    'datachar04' => $orderRequest->customer_order_number ?? null,
                    'ordertypebango2' => 0,
                    'datachar05' => $bango,
                    'synchroorderbango' => 0,
                    'date' => Carbon::now()->format('Y-m-d H:i:s'),
                    'orderuserbango' => $bango
                ];
                $orderHenkan = QueryHelper::insertData('orderhenkan', $orderHenkan, 'bango', true, $bango, __CLASS__, __FUNCTION__, __LINE__);

                //check orderbango
                $reviewData1 = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7301'");
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
                $modified_orderbango = "21" . $orderbango2 . str_pad($orderbango, $mobile_flag, '0', STR_PAD_LEFT);
                if (!file_exists('uploads')) {
                    mkdir('uploads', 0777, true);
                }
                if (!file_exists('uploads/order_entry')) {
                    mkdir('uploads/order_entry', 0777, true);
                }
                if (!file_exists('uploads/lbook/')) {
                    mkdir('uploads/lbook/', 0777, true);
                }

                if ($orderHenkan) {
                    if ($file != "" || $orderRequest->purchase_order_file_name != "") {
                        if ($file != "") {
                            $filenameWithExtension = $file->getClientOriginalName();
                            $fileExtension = '.' . $file->getClientOriginalExtension();
                            $filename = explode($fileExtension, $filenameWithExtension);
                            $filename = $filename[0] . '¶' . $kokyakuorderbango . '_' . static::getCurrentTime() . $fileExtension;

                            $file->move(public_path('uploads/order_entry'), $filename);
                        } else {
                            $filename = $orderRequest->purchase_order_file_name;
                        }

                        //============== L-Book reg start here ==================//
                        $soukonyuko_insert_data = [
                            'orderbango' => $orderHenkan->bango,
                            'datachar01' => $modified_orderbango,
                            'datachar02' => $orderRequest->sold_to ?? null,
                            'datachar03' => $orderRequest->sales_billing_destination ?? null,
                            'datachar04' => $orderRequest->end_customer ?? null,
                            'datachar05' => $orderHenkan->kokyakuorderbango ?? null,
                            'datachar06' => $bango,
                            'datachar07' => 'H104',
                            'datachar08' => $orderRequest->order_subject,
                            'datachar09' => $filename,
                            'datachar10' => 'H920',
                            'dataint25' => 0,
                            'datachar11' => static::getCurrentTime(),
                            //'datatxt0099' => Helper::getSystemIP(),
                            'datachar13' => $bango,
                        ];
                        $soukonyuko = QueryHelper::insertData('soukonyuko', $soukonyuko_insert_data, 'datachar01', true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                        if ($soukonyuko && $file != "") {
                            \File::copy(public_path('uploads/order_entry/') . $filename, public_path('uploads/lbook/') . $filename);
                        }

                        //update orderhenkan data
                        $orderhenkan_update_data = [
                            //'kokyakuorderbango' => $orderHenkan->kokyakuorderbango,
                            'bango' => $orderHenkan->bango,
                            'datachar08' => $modified_orderbango,
                        ];
                        QueryHelper::updateData('orderhenkan', $orderhenkan_update_data, 'bango', $bango, __CLASS__, __FUNCTION__, __LINE__);

                        //update review data
                        $review_update_data = [
                            'kokyakusyouhinbango' => 'D7301',
                            'orderbango' => $orderbango,
                            'check_flag' => 0,
                            'color' => static::getCurrentTime(),
                            'size' => Helper::getSystemIP(),
                            'nickname' => $bango,
                        ];
                        QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                        //============== L-Book reg end here ==================//

                    }
                }
                $tohanOrder = [
                    'orderbango' => $orderHenkan->bango,
                    'juchubango' => $orderHenkan->kokyakuorderbango ?? null,
                    'datatxt0109' =>  $orderHenkan->kokyakuorderbango ?? null,
                    'information1' => $orderRequest->sold_to ?? null,
                    'information2' => $orderRequest->sales_billing_destination ?? null,
                    'information3' => $orderRequest->end_customer ?? null,
                    'information4' => $orderRequest->agency_1 ?? null,
                    'information5' => $orderRequest->agency_2 ?? null,
                    'information6' => $orderRequest->bill_to ?? null,
                    'juchukubun1' => $orderRequest->order_subject ?? null,
                    'kessaihouhou' => $orderRequest->payment_method ?? null,
                    'chumonsyajouhou' => $orderRequest->acceptance_condition ?? null,
                    'soufusakijouhou' => $orderRequest->sales_standard ?? null,
                    'housoukubun' => $orderRequest->immediate_version ?? null,
                    'information8' => $orderRequest->voucher_remarks ?? null,
                    'information7' => $orderRequest->in_house_remarks ?? null,
                    //'information9' => $orderRequest->purchase_order_file_name != "" ? $orderbango . $orderRequest->purchase_order_file_name : null,
                    'money10' => $orderRequest->sales_amount_total ?? null,
                    'moneymax' => $orderRequest->gross_profit_margin ?? null,
                    'otodoketime' => static::getOtodokeTime($orderRequest->sales_billing_destination) ?? null,
                ];
                QueryHelper::insertData('tuhanorder', $tohanOrder, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                $hikiatesyukko = [
                    'orderbango' => $orderHenkan->bango,
                    'syouhinid' => $kokyakuorderbango ?? null,
                    'datachar01' => '1',
                    'datachar02' => null,
                    'datachar03' => null,
                    'datachar04' => '2',
                    'datachar05' => null,
                    'datachar06' => '2',
                    'datachar07' => null,
                    'datachar08' => '',
                    'datachar09' => '2',
                    'datachar10' => '2',
                    'datachar16' => '2',
                    'datachar17' => null,
                    'datachar18' => null,
                    'yoteimeter' => 0,
                    'tanabango' => static::getCurrentTime(),
                    'idoutanabango' => null,
                    'tantousyabango' => $bango
                ];
                QueryHelper::insertData('hikiatesyukko', $hikiatesyukko, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                foreach ($orderDetailRequests as $request) {
                    $request = (object)$request;
                    $datachar13 = static::productCdWiseProductClassification($request->productCd, $request->data_char13);
                    if($datachar13 == 2){
                       $dataint17 = 2; 
                    }else{
                        $dataint17 = 1;
                    }
                    $misyukko = [
                        'orderbango' => $orderHenkan->bango,
                        'syouhinid' => $kokyakuorderbango ?? null,
                        'kawasename' => $request->productCd ?? null,
                        'syouhinname' => $request->productName ?? null,
                        'dataint09' => static::stringDataConvertedToIntegerFormat($request->orderDate) ?? null,
                        'dataint10' => static::stringDataConvertedToIntegerFormat($request->individualDeliveryDate) ?? null,
                        'datachar06' => $request->deliveryDestination ?? null,
                        'codename' => $request->unit ?? null,
                        'syukkasu' => static::stringDataConvertedToIntegerFormat($request->quantity, 'comma') ?? null,
                        'dataint04' => static::stringDataConvertedToIntegerFormat($request->unitSellingPrice, 'comma') ?? null,
                        'dataint05' => static::stringDataConvertedToIntegerFormat($request->se, 'comma') ?? null,
                        'dataint06' => static::stringDataConvertedToIntegerFormat($request->institute, 'comma') ?? null,
                        'dataint07' => static::stringDataConvertedToIntegerFormat($request->ship, 'comma') ?? null,
                        'dataint08' => static::stringDataConvertedToIntegerFormat($request->purchase, 'comma') ?? null,
                        'datachar01' => $request->sales ?? null,
                        'datachar02' => $request->se2 ?? null,
                        //'barcode' => $request->productSubCd . ' ' . $request->productSubName,
                        'dataint16' => 0,
                        'dataint17' => $dataint17,
                        'dataint18' =>round(static::stringDataConvertedToIntegerFormat($request->quantity, 'comma')*static::stringDataConvertedToIntegerFormat($request->unitSellingPrice, 'comma')) ,
                        'barcode' => $request->productSubCd,
                        'datachar07' => $request->issueNote ?? null,
                        'datachar08' => $request->statementRemarks ?? null,
                        'datachar09' => $request->deliveryMethod ?? null,
                        'datachar15' => $request->continutionCategory ?? null,
                        'datachar16' => $request->newVup ?? null,
                        'datachar17' => $request->vupCategory ?? null,
                        'datachar22' => '0000',
                        'datachar12' => $request->maintenance ?? null,
                        'datachar05' => $request->supplier ?? null,
                        'datachar03' => $request->manufacturePartNumber ?? null,
                        'datachar04' => $request->manufactureProductName ?? null,
                        'syouhinsyu' => $request->line ?? null,
                        'hantei' => $request->branch ?? null,
                        'dataint01' => 0,
                        'dataint02' => $request->serial,
                        'dataint11' => static::stringDataConvertedToIntegerFormat($request->price, 'comma') ?? null,
                        'dataint12' => static::stringDataConvertedToIntegerFormat($request->grossProfit, 'comma') ?? null,
                        'datachar13' => static::productCdWiseProductClassification($request->productCd, $request->data_char13) ?? null,
                        'datachar14' => static::productCdWiseDataChar04($request->productCd) ?? null,
                        'yoteimeter' => $request->deletedProduct ?? 0,
                        'tanabango' => static::getCurrentTime(),
                        'tantousyabango' => $bango,
                        'idoutanabango' => static::getSpecificIdotanaBango($request->setcode, $request->percentage),
                        'datachar21' => $request->flatContract ?? null
                    ];
                    QueryHelper::insertData('misyukko', $misyukko, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                    $juchusyukko = [
                        'syouhinid' => $kokyakuorderbango,
                        'syouhinsyu' => $request->line,
                        'hantei' => $request->branch,
                        'datachar01' => 2,
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
                }

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

                //create history details => CreateOrderDetails::data($bango,$kokyakuorderbango, $ordertypebango2,$datachar01)
                CreateOrderDetails::data($bango,$kokyakuorderbango, 0,1,'02-01');
                
                $result['status'] = 'ok';
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### order_entry end\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "COMMIT");
                session()->flash('success_msg', "受注番号" . $kokyakuorderbango . "で登録しました");
                $session_order_bango = '';
                if (self::isConfirmModalShow($orderHenkan->kokyakuorderbango) && $orderRequest->order_category != 'U150') {
                    $session_order_bango =   $orderHenkan->kokyakuorderbango;
                }
                $result['session_order_bango'] = $session_order_bango;
                $result['session_company_code'] = $orderRequest->sold_to;
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

    public static function edit($request, $bango, $file)
    {
        list($orderRequest, $orderDetailRequests) = static::getProcessedRequests();
        //dd($orderRequest,$orderDetailRequests);
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

        $validator = OrderEntryCreateValidation::handle(request()->all());

        $errors = $validator->errors();

        if ($errors->any()) {
            return $errors;
        } elseif (!$errors->any() && $request->confirm_status == 0) {
            $result['status'] = 'confirm';
            return $result;
        } elseif ($request->confirm_status == 1 && !$errors->any()) {
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### order_entry start\n";
            QueryHandler::logger($bango, $log_data);
            $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
            pg_query($conn, "BEGIN");

            try {
                $orderId = $orderRequest->order_number;
                $previous_misyukko_record = QueryHelper::fetchResult("select * from misyukko where syouhinid = '$orderId'  ");

                foreach ($previous_misyukko_record as $key => $value) {
                    foreach ($value as $k => $val) {
                        $syukkoInsert[$k] = $val;
                    }
                    $syukkoInsert['yoteimeter'] = $syukkoInsert['yoteimeter'] == '2' ? $syukkoInsert['yoteimeter'] : 0;
                    $syukkoInsert['dataint01'] = (int)($orderRequest->ordertypebango2);
                    $syukkoInsert['syouhinid'] = $orderId;
                    $syukkoInsert['tanabango'] = static::getCurrentTime();
                    $syukkoInsert['tantousyabango'] = $bango;
                    QueryHelper::insertData('syukko', $syukkoInsert, 'syouhinid', true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                }

                $data = ['syouhinid' => $orderId];
                QueryHelper::deleteData('misyukko', $data, 'syouhinid', $bango, __CLASS__, __FUNCTION__, __LINE__);
                QueryHelper::deleteData('juchusyukko', $data, 'syouhinid', $bango, __CLASS__, __FUNCTION__, __LINE__);
                //                DB::table('misyukko')->where('syouhinid', $orderId)->delete();
                ////orderhenkan create///////
                $orderHenkan = [
                    'datachar02' => $orderRequest->order_category ?? null,
                    'datachar01' => $orderRequest->creation_category ?? null,
                    //                  'datachar06' => $orderRequest->number_search ?? null,
                    'kokyakuorderbango' => $orderRequest->order_number ?? null,
                    'intorder01' => static::stringDataConvertedToIntegerFormat($orderRequest->order_date) ?? null,
                    'intorder02' => static::stringDataConvertedToIntegerFormat($orderRequest->delivery_date) ?? null,
                    'intorder04' => static::stringDataConvertedToIntegerFormat($orderRequest->inspection_date) ?? null,
                    'intorder03' => static::stringDataConvertedToIntegerFormat($orderRequest->sales_date) ?? null,
                    'intorder05' => static::stringDataConvertedToIntegerFormat($orderRequest->payment_date) ?? null,
                    'datachar03' => $orderRequest->pj ?? null,
                    'datachar04' => $orderRequest->customer_order_number ?? null,
                    'ordertypebango2' => (int)($orderRequest->ordertypebango2) + 1,
                    'datachar05' => $orderRequest->datachar05,
                    'synchroorderbango' => 0,
                    'date' => Carbon::now()->format('Y-m-d H:i:s'),
                    'orderuserbango' => $bango
                ];

                $orderHenkan = QueryHelper::insertData('orderhenkan', $orderHenkan, 'bango', true, $bango, __CLASS__, __FUNCTION__, __LINE__);

                /////hikiyatesyukko edit//////////
                $hikiatesyukko = [
                    'syouhinid' => $orderHenkan->kokyakuorderbango,
                    'orderbango' => $orderHenkan->bango,
                    'yoteimeter' => 0,
                    'idoutanabango' => static::getCurrentTime(),
                    'tantousyabango' => $bango,
                    'kaiinid' => null
                ];

                QueryHelper::updateData('hikiatesyukko', $hikiatesyukko, ['syouhinid' => $orderHenkan->kokyakuorderbango, 'kaiinid' => null], $bango, __CLASS__, __FUNCTION__, __LINE__);
                //check orderbango
                $reviewData1 = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7301'");
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
                $modified_orderbango = "21" . $orderbango2 . str_pad($orderbango, $mobile_flag, '0', STR_PAD_LEFT);
                if (!file_exists('uploads')) {
                    mkdir('uploads', 0777, true);
                }
                if (!file_exists('uploads/order_entry')) {
                    mkdir('uploads/order_entry', 0777, true);
                }
                if (!file_exists('uploads/lbook/')) {
                    mkdir('uploads/lbook/', 0777, true);
                }
                if ($orderHenkan) {
                    if ($file != "" || $orderRequest->purchase_order_file_name != "") {
                        if ($file != "") {

                            $filenameWithExtension = $file->getClientOriginalName();
                            $fileExtension = '.' . $file->getClientOriginalExtension();
                            $filename = explode($fileExtension, $filenameWithExtension);
                            $filename = $filename[0] . '¶' . $orderHenkan->kokyakuorderbango . '_' . static::getCurrentTime() . $fileExtension;
                            //$filename = $filename[0] . '_' . $modified_orderbango . '.' . $filename[1];
                            $file->move(public_path('uploads/order_entry'), $filename);
                            $soukonyuko_insert_data = [
                                'orderbango' => $orderHenkan->bango ?? null,
                                'datachar01' => $modified_orderbango,
                                'datachar02' => $orderRequest->sold_to ?? null,
                                'datachar03' => $orderRequest->sales_billing_destination ?? null,
                                'datachar04' => $orderRequest->end_customer ?? null,
                                'datachar05' => $orderRequest->order_number ?? null,
                                'datachar06' => $bango,
                                'datachar07' => 'H104',
                                'datachar08' => $orderRequest->order_subject,
                                'datachar09' => $filename,
                                'datachar10' => 'H920',
                                'dataint25' => 0,
                                'datachar11' => static::getCurrentTime(),
                                'datachar13' => $bango,
                            ];
                            $soukonyuko = QueryHelper::insertData('soukonyuko', $soukonyuko_insert_data, 'datachar01', true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                            if ($soukonyuko) {
                                \File::copy(public_path('uploads/order_entry/') . $filename, public_path('uploads/lbook/') . $filename);
                            }
                            //update orderhenkan data
                            $orderhenkan_update_data = [
                                'bango' => $orderHenkan->bango,
                                // 'kokyakuorderbango' => $orderHenkan->kokyakuorderbango,
                                'datachar08' => $modified_orderbango
                            ];
                            QueryHelper::updateData('orderhenkan', $orderhenkan_update_data, 'bango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                            //update review data
                            $review_update_data = [
                                'kokyakusyouhinbango' => 'D7301',
                                'orderbango' => $orderbango,
                                'check_flag' => 0,
                                'color' => static::getCurrentTime(),
                                'size' => Helper::getSystemIP(),
                                'nickname' => $bango,
                            ];
                            QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                        } else {


                            $soukonyuko_update_data = [
                                'orderbango' => $orderHenkan->bango,
                                'datachar05' => $orderRequest->order_number,
                                'datachar04' => $orderRequest->end_customer
                            ];

                            // QueryHelper::updateData('soukonyuko', $soukonyuko_update_data, 'datachar05', $bango, __CLASS__, __FUNCTION__, __LINE__);
                            QueryHelper::updateData('soukonyuko', $soukonyuko_update_data, ['datachar05' => $orderRequest->order_number, 'datachar01' => $orderRequest->datachar08], $bango, __CLASS__, __FUNCTION__, __LINE__);

                            //update orderhenkan data
                            $orderhenkan_update_data = [
                                'bango' => $orderHenkan->bango,
                                // 'kokyakuorderbango' => $orderHenkan->kokyakuorderbango,
                                'datachar08' => $orderRequest->datachar08
                            ];
                            QueryHelper::updateData('orderhenkan', $orderhenkan_update_data, 'bango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                        }


                        //============== L-Book reg end here ==================//
                    }
                    $tohanOrder = [
                        'orderbango' => $orderHenkan->bango,
                        'juchubango' => $orderHenkan->kokyakuorderbango ?? null,
                        'datatxt0109' =>  $orderHenkan->kokyakuorderbango ?? null,
                        'information1' => $orderRequest->sold_to ?? null,
                        'information2' => $orderRequest->sales_billing_destination ?? null,
                        'information3' => $orderRequest->end_customer ?? null,
                        'information4' => $orderRequest->agency_1 ?? null,
                        'information5' => $orderRequest->agency_2 ?? null,
                        'information6' => $orderRequest->bill_to ?? null,
                        'juchukubun1' => $orderRequest->order_subject ?? null,
                        'kessaihouhou' => $orderRequest->payment_method ?? null,
                        'chumonsyajouhou' => $orderRequest->acceptance_condition ?? null,
                        'soufusakijouhou' => $orderRequest->sales_standard ?? null,
                        'housoukubun' => $orderRequest->immediate_version ?? null,
                        'information8' => $orderRequest->voucher_remarks ?? null,
                        'information7' => $orderRequest->in_house_remarks ?? null,
                        //'information9' => $fileName,
                        'money10' => $orderRequest->sales_amount_total ?? null,
                        'moneymax' => $orderRequest->gross_profit_margin ?? null,
                        'otodoketime' => static::getOtodokeTime($orderRequest->sales_billing_destination) ?? null,
                    ];
                    QueryHelper::insertData('tuhanorder', $tohanOrder, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                }

                foreach ($orderDetailRequests as $request) {
                    $request = (object)$request;
                    $datachar13 = static::productCdWiseProductClassification($request->productCd, $request->data_char13);
                    if($datachar13 == 2){
                       $dataint17 = 2; 
                    }else{
                        $dataint17 = 1;
                    }
                    $misyukko = [
                        'orderbango' => $orderHenkan->bango,
                        'syouhinid' => $orderRequest->order_number ?? null,
                        'kawasename' => $request->productCd ?? null,
                        'syouhinname' => $request->productName ?? null,
                        'dataint09' => static::stringDataConvertedToIntegerFormat($request->orderDate) ?? null,
                        'dataint10' => static::stringDataConvertedToIntegerFormat($request->individualDeliveryDate) ?? null,
                        'datachar06' => $request->deliveryDestination ?? null,
                        'codename' => $request->unit ?? null,
                        'syukkasu' => static::stringDataConvertedToIntegerFormat($request->quantity, 'comma') ?? null,
                        'dataint04' => static::stringDataConvertedToIntegerFormat($request->unitSellingPrice, 'comma') ?? null,
                        'dataint05' => static::stringDataConvertedToIntegerFormat($request->se, 'comma') ?? null,
                        'dataint06' => static::stringDataConvertedToIntegerFormat($request->institute, 'comma') ?? null,
                        'dataint07' => static::stringDataConvertedToIntegerFormat($request->ship, 'comma') ?? null,
                        'dataint08' => static::stringDataConvertedToIntegerFormat($request->purchase, 'comma') ?? null,
                        'datachar01' => $request->sales ?? null,
                        'datachar02' => $request->se2 ?? null,
                        'dataint16' => $request->dataint16,
                        'dataint17' => $dataint17,
                        'datachar22'=>'0000',
                        'dataint18' =>round(static::stringDataConvertedToIntegerFormat($request->quantity, 'comma')*static::stringDataConvertedToIntegerFormat($request->unitSellingPrice, 'comma')) ,
                        //'barcode' => $request->productSubCd . ' ' . $request->productSubName,
                        'barcode' => $request->productSubCd,
                        'datachar07' => $request->issueNote ?? null,
                        'datachar08' => $request->statementRemarks ?? null,
                        'datachar09' => $request->deliveryMethod ?? null,
                        'datachar15' => $request->continutionCategory ?? null,
                        'datachar16' => $request->newVup ?? null,
                        'datachar17' => $request->vupCategory ?? null,
                        'datachar12' => $request->maintenance ?? null,
                        'datachar05' => $request->supplier ?? null,
                        'datachar03' => $request->manufacturePartNumber ?? null,
                        'datachar04' => $request->manufactureProductName ?? null,
                        'syouhinsyu' => $request->line ?? null,
                        'hantei' => $request->branch ?? null,
                        'dataint01' => (int)($orderRequest->ordertypebango2) + 1,
                        'dataint02' => $request->serial,
                        'dataint11' => static::stringDataConvertedToIntegerFormat($request->price, 'comma') ?? null,
                        'dataint12' => static::stringDataConvertedToIntegerFormat($request->grossProfit, 'comma') + $request->dataint16 ?? null,
                        'datachar13' => static::productCdWiseProductClassification($request->productCd, $request->data_char13) ?? null,
                        'datachar14' => static::productCdWiseDataChar04($request->productCd) ?? null,
                        'yoteimeter' => $request->deletedProduct ?? 0,
                        'datachar21' => $request->flatContract ?? null,
                        'tanabango' => static::getCurrentTime(),
                        'tantousyabango' => $bango,
                        'idoutanabango' => static::getSpecificIdotanaBango($request->setcode, $request->percentage)
                    ];

                    QueryHelper::insertData('misyukko', $misyukko, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);

                    /////juchusyukko edit//////////
                    $juchusyukko = [
                        'orderbango' => $orderHenkan->bango,
                        'syouhinid' => $orderRequest->order_number ?? null,
                        'datachar01' => 2,
                        'datachar02' => 2,
                        'datachar03' => 2,
                        'datachar04' => 1,
                        'syouhinsyu' => $request->line ?? null,
                        'hantei' => $request->branch ?? null,
                        'yoteimeter' => $request->deletedProduct ?? 0,
                        'tanabango' => static::getCurrentTime(),
                        'tantousyabango' => $bango,
                        'idoutanabango' => static::getCurrentTime()
                    ];

                    QueryHelper::insertData('juchusyukko', $juchusyukko, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                }

                //create history details => CreateOrderDetails::data($bango,$kokyakuorderbango, $ordertypebango2,$datachar01)
                $tmp_kokyakuorderbango = $orderRequest->order_number ?? null;
                $tmp_ordertypebango2 = (int)($orderRequest->ordertypebango2) + 1;
                CreateOrderDetails::data($bango,$tmp_kokyakuorderbango, $tmp_ordertypebango2,2,'02-01');
                
                $result['status'] = 'ok';
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### order_entry end\n";
                QueryHandler::logger($bango, $log_data);
                session()->flash('success_msg', "受注番号" . $orderRequest->order_number . "で登録しました");
                // $session_order_bango = '';
                // if (self::isConfirmModalShow($orderHenkan->kokyakuorderbango)) {
                //     $session_order_bango = $orderHenkan->kokyakuorderbango;
                // }
                // $result['session_order_bango'] = $session_order_bango;
                pg_query($conn, "COMMIT");
            } catch (\Exception $e) {
                //dd($e);
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                QueryHandler::logger($bango, $log_data);
                session()->flash('success_msg', "something" . $orderRequest->order_number . "went wrong");
                pg_query($conn, "ROLLBACK");
                $result['status'] = 'ng';
                $result['exception'] = $e->getMessage();
            }

            return $result;
        }
    }

    public static function deleteOrder($request, $bango, $file)
    {

        list($orderRequest, $orderDetailRequests) = static::getProcessedRequests();
        $bangoName = tantousya::find($bango)->name;

        foreach ($orderRequest as $key => $value) {
            if ($key == '_token' || $key == 'type') {
                unset($orderRequest[$key]);
            }
        }
        $orderRequest = (object)$orderRequest;
        $validator = OrderEntryCreateValidation::handle(request()->all());

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
                $orderId = $orderRequest->order_number;
                $previous_misyukko_record = QueryHelper::fetchResult("select * from misyukko where syouhinid = '$orderId'  ");
                foreach ($previous_misyukko_record as $key => $value) {
                    foreach ($value as $k => $val) {
                        $syukkoInsert[$k] = $val;
                    }

                    $syukkoInsert['syouhinid'] = $orderId;
                    $syukkoInsert['tanabango'] = static::getCurrentTime();
                    $syukkoInsert['tantousyabango'] = $bango;

                    QueryHelper::insertData('syukko', $syukkoInsert, 'syouhinid', true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                }

                ////misyukko previous data delete///
                $data = ['syouhinid' => $orderId];
                QueryHelper::deleteData('misyukko', $data, 'syouhinid', $bango, __CLASS__, __FUNCTION__, __LINE__);
                //                DB::table('misyukko')->where('syouhinid', $orderId)->delete();
                /////orderhenkan edit//////////

                $orderHenkan = [
                    'datachar02' => $orderRequest->order_category ?? null,
                    'datachar01' => $orderRequest->creation_category ?? null,
                    'datachar06' => $orderRequest->number_search ?? null,
                    'kokyakuorderbango' => $orderRequest->order_number ?? null,
                    'ordertypebango2' => (int)($orderRequest->ordertypebango2) + 1,
                    'datachar05' => $orderRequest->datachar05,
                    'synchroorderbango' => 1,
                    'date' => Carbon::now()->format('Y-m-d H:i:s'),
                    'orderuserbango' => $bango,
                    'intorder01' => static::stringDataConvertedToIntegerFormat($orderRequest->order_date) ?? null,
                    'intorder02' => static::stringDataConvertedToIntegerFormat($orderRequest->delivery_date) ?? null,
                    'intorder04' => static::stringDataConvertedToIntegerFormat($orderRequest->inspection_date) ?? null,
                    'intorder03' => static::stringDataConvertedToIntegerFormat($orderRequest->sales_date) ?? null,
                    'intorder05' => static::stringDataConvertedToIntegerFormat($orderRequest->payment_date) ?? null,
                    'datachar03' => $orderRequest->pj ?? null,
                    'datachar04' => $orderRequest->customer_order_number ?? null,
                    'datachar08' => $orderRequest->datachar08 ?? null

                ];

                $orderHenkan = QueryHelper::insertData('orderhenkan', $orderHenkan, 'bango', true, $bango, __CLASS__, __FUNCTION__, __LINE__);

                //tuhaorder insert
                $tohanOrder = [
                    'orderbango' => $orderHenkan->bango,
                    'juchubango' => $orderHenkan->kokyakuorderbango ?? null,
                    'datatxt0109' =>  $orderHenkan->kokyakuorderbango ?? null,
                    'information1' => $orderRequest->sold_to ?? null,
                    'information2' => $orderRequest->sales_billing_destination ?? null,
                    'information3' => $orderRequest->end_customer ?? null,
                    'information4' => $orderRequest->agency_1 ?? null,
                    'information5' => $orderRequest->agency_2 ?? null,
                    'information6' => $orderRequest->bill_to ?? null,
                    'juchukubun1' => $orderRequest->order_subject ?? null,
                    'kessaihouhou' => $orderRequest->payment_method ?? null,
                    'chumonsyajouhou' => $orderRequest->acceptance_condition ?? null,
                    'soufusakijouhou' => $orderRequest->sales_standard ?? null,
                    'housoukubun' => $orderRequest->immediate_version ?? null,
                    'information8' => $orderRequest->voucher_remarks ?? null,
                    'information7' => $orderRequest->in_house_remarks ?? null,
                    //'information9' => $fileName,
                    'money10' => $orderRequest->sales_amount_total ?? null,
                    'moneymax' => $orderRequest->gross_profit_margin ?? null,
                    'otodoketime' => static::getOtodokeTime($orderRequest->sales_billing_destination) ?? null,
                ];
                QueryHelper::insertData('tuhanorder', $tohanOrder, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                //============= delete lbook start here ==============//
                //            $update_data = [
                //               'datachar05' => $orderRequest->order_number,
                //               'dataint25' => 1,
                //               'datachar11' => static::getCurrentTime(),
                //            ];
                //            QueryHelper::updateData('soukonyuko',$update_data,'datachar05',$bango,__CLASS__,__FUNCTION__,__LINE__);
                //============= delete lbook end here ==============//

                /////hikiyatesyukko edit//////////
                $hikiatesyukko = [
                    'syouhinid' => $orderHenkan->kokyakuorderbango,
                    'orderbango' => $orderHenkan->bango,
                    'yoteimeter' => 1,
                    'idoutanabango' => static::getCurrentTime(),
                    'tantousyabango' => $bango,
                    'kaiinid' => null
                ];

                QueryHelper::updateData('hikiatesyukko', $hikiatesyukko, ['syouhinid' => $orderHenkan->kokyakuorderbango, 'kaiinid' => null], $bango, __CLASS__, __FUNCTION__, __LINE__);


                foreach ($previous_misyukko_record as $key => $value) {
                    foreach ($value as $k => $val) {
                        $syukkoInsert[$k] = $val;
                    }
                    $syukkoInsert['orderbango'] = $orderHenkan->bango ?? null;
                    $syukkoInsert['dataint01'] = (int)($orderRequest->ordertypebango2) + 1;
                    $syukkoInsert['yoteimeter'] = $syukkoInsert['yoteimeter'] == '2' ? $syukkoInsert['yoteimeter'] : 1;
                    $syukkoInsert['syouhinid'] = $orderId;
                    $syukkoInsert['tanabango'] = static::getCurrentTime();
                    $syukkoInsert['tantousyabango'] = $bango;

                    QueryHelper::insertData('syukko', $syukkoInsert, 'syouhinid', true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                }
                /////juchusyukko edit//////////
                foreach ($orderDetailRequests as $request) {
                    $juchusyukko = [
                        'syouhinid' => $orderHenkan->kokyakuorderbango ?? null,
                        'yoteimeter' => $request->deletedProduct ?? 1,
                        'orderbango' => $orderHenkan->bango,
                        'idoutanabango' => static::getCurrentTime(),
                        'tantousyabango' => $bango
                    ];
                    QueryHelper::updateData('juchusyukko', $juchusyukko, 'syouhinid', $bango, __CLASS__, __FUNCTION__, __LINE__);
                }
                
                //create history details => CreateOrderDetails::data($bango,$kokyakuorderbango, $ordertypebango2,$datachar01)
                $tmp_kokyakuorderbango = $orderHenkan->kokyakuorderbango;
                $tmp_ordertypebango2 = (int)($orderRequest->ordertypebango2) + 1;
                CreateOrderDetails::data($bango,$tmp_kokyakuorderbango, $tmp_ordertypebango2,3,'02-01');
                
                $result['status'] = 'ok';
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### order_entry end\n";
                QueryHandler::logger($bango, $log_data);
                session()->flash('success_msg', "受注番号" . $orderRequest->order_number . "を削除しました");
                pg_query($conn, "COMMIT");
            } catch (\Exception $e) {
                //  dd($e);
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                QueryHandler::logger($bango, $log_data);
                session()->flash('success_msg', "something" . $orderRequest->order_number . "went wrong");
                pg_query($conn, "ROLLBACK");
                $result['status'] = 'ng';
                $result['exception'] = $e->getMessage();
            }
            return $result;
        }
    }

    public static function getCurrentTime()
    {
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        return str_replace(" ", "", $mytime);
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

    public static function productCdWiseProductClassification($productCd, $dataChar13)
    {
        if ($dataChar13) {
            return $dataChar13;
        }
        $classificationValue = QueryHelper::fetchSingleResult("select * from syouhin1 where kokyakusyouhinbango = '$productCd'")->data100 ?? null;

        if ($classificationValue) {
            $classificationValue = in_array($classificationValue, ['60', '30', '31', 'D160', 'D131']) ? $classificationValue : "other";
            $classificationValues = ["60" => "2", "30" => "3", "31" => "3", "D160" => "2", "D131" => "3", "other" => "1"];
            return $classificationValues[$classificationValue];
        }
        return null;
    }

    public static function productCdWiseDataChar04($productCd)
    {
        $value = QueryHelper::fetchSingleResult("select * from syouhin1 where kokyakusyouhinbango = '$productCd'")->data23 ?? null;
        if ($value) {
            return explode(' ', $value)[0];
        }
        return null;
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

    public static function getProcessedRequests()
    {
        $orderDetailRequestInput = ['productCd', 'productName', 'orderDate', 'individualDeliveryDate', 'deliveryDestination', 'unit', 'quantity', 'unitSellingPrice', 'se', 'institute', 'ship', 'purchase', 'sales', 'se2', 'productSubCd', 'shippingInstruction', 'maintenance', 'supplier', 'manufacturePartNumber', 'manufactureProductName', 'issueNote', 'deliveryMethod', 'continutionCategory', 'newVup', 'vupCategory', 'statementRemarks', 'line', 'branch', 'serial', 'productSubName', 'price', 'grossProfit', 'percentage', 'setcode', 'deletedProduct', 'data_char13', 'flatContract', 'shoyin_color', 'dataint16'];
        $orderRequest = request()->except($orderDetailRequestInput);
        $orderDetailRequests = request()->only($orderDetailRequestInput);
        try {
            if (count($orderDetailRequests['productCd']) > 1) {
                foreach ($orderDetailRequests as $key => $value) {
                    foreach ($value as $newKey => $val) {
                        if ($key == 'productCd') {
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

    public static function getOtodokeTime($digits)
    {
        //        $data28 = QueryHelper::fetchSingleResult("select * from syouhin1 where kokyakusyouhinbango = '$productCd[0]'")->data28 ?? null;
        //        if ($data28) {
        //            return $data28;
        //        } else
        if ($digits) {
            $yobi12 = substr($digits, 0, 6);
            $torihikisakibango = substr($digits, 6, 2);
            $haisou = QueryHelper::fetchSingleResult("select * from haisou where torihikisakibango = '$torihikisakibango' and shikibetsucode = '$yobi12'  and kounyusu = 0 ")->bango ?? null;
            if ($haisou) {
                $other = QueryHelper::fetchSingleResult("select * from others2 where otherint1 = $haisou");
                $other1 = $other->other1 ?? null;
                if ($other1) {
                    if ($other1 == '1 会社M') {
                        $companyData = QueryHelper::fetchSingleResult("select * from kokyaku1 where yobi12 = '$yobi12' and denpyosaiban = 0 ")->mail_toiawase_mb ?? null;
                        return $companyData;
                    } elseif ($other1 == '2 事業所M') {
                        return $other->other16 ?? null;
                    }
                }
                return null;
            }
            return null;
        }
        return null;
    }

    public static function renderCategoryKanri($length_limit, $categoryValue, $categoryType)
    {
        $categories = QueryHelper::fetchResult("select * from categorykanri where category1 = '$categoryType' and suchi2 = 0 and substring (category2,1,$length_limit) = '$categoryValue' order by suchi1 ASC") ?? null;
        $default_name = ['C5' => "選択無し", 'C6' => "選択無し", 'E7' => "選択無し", 'E6' => "選択無し", 'maljabena' => "選択無し"];
        $html = '<option data-categoryType="null" data-categoryValue="' . $categoryType . '"  value="">' . $default_name[$categoryType] . '</option>';
        if (isset($categories)) {
            foreach ($categories as $category) {
                $html .= "<option data-categoryType=" . $category->category1 . " data-categoryValue=" . $category->category2 . " value=" . $category->category1 . $category->category2 . ">" . substr($category->category2, $length_limit) . " " . $category->category4 . "</option>";
            }
            return $html;
        } else {
            return $html;
        }
    }

    public static function calculateBillingDates($billingDestination)
    {
        $yobi12 = substr($billingDestination, 0, 6);
        $torihikisakibango = substr($billingDestination, 6, 2);
        $haisou = QueryHelper::fetchSingleResult("select * from haisou where shikibetsucode = '$yobi12'  and kounyusu = 0 and torihikisakibango = '$torihikisakibango'");
        $companyData = QueryHelper::fetchSingleResult("select * from kokyaku1 where yobi12 = '$yobi12' and denpyosaiban = 0 ");
        $haisouBango = $haisou->bango ?? null;
        $day = null;
        $month = null;
        $isForward = null;
        $addDayForSystemDate = null;
        if ($haisouBango) {
            $other2 = QueryHelper::fetchSingleResult("select * from others2 where otherint1 = '$haisouBango'");
            $other1 = $other2->other1 ?? null;
            if ($other1) {
                if (explode(" ", $other1)[0] == '1') {
                    $month = !is_null($companyData->ytoiawsesaiban) ? (int)$companyData->ytoiawsesaiban : null;
                    $day = $companyData->yetoiawsestart ? (int)$companyData->yetoiawsestart : null;
                    $isForward = $companyData->yetoiawseend ? $companyData->yetoiawseend : null;
                    $addDayForSystemDate = $companyData->ytoiawsestart ? substr($companyData->ytoiawsestart, 2, 2) : null;
                    return [$day, $month, $isForward, $addDayForSystemDate];
                } elseif (explode(" ", $other1)[0] == '2') {
                    $month = !is_null($other2->other5) ? (int)$other2->other5 : null;
                    $day = $other2->other6 ? (int)$other2->other6 : null;
                    $isForward = $other2->other7 ? $other2->other7 : null;
                    $addDayForSystemDate = $other2->other3 ? substr($other2->other3, 2, 2) : null;
                    return [$day, $month, $isForward, $addDayForSystemDate];
                }
            }
        }
        return [$day, $month, $isForward, $addDayForSystemDate];
    }

    public static function calculateBalance($billingDestination)
    {
        $a = 0;
        $b = 0;
        $c = 0;
        $a_2 = 0;
        $b_2 = 0;
        $c_2 = 0;
        $yobi12 = substr($billingDestination, 0, 6);
        $torihikisakibango = substr($billingDestination, 6, 2);
        $date = date("Ymd");
        $all_balance = array();
        //$balance = QueryHelper::fetchSingleResult("select max(replace(substring(date0009::text,1,10),'-','')) as date, sum(datanum0064) as balance_total from seikyuzandaka where substring(datatxt0142::text,1,6) = '$yobi12' and replace(substring(date0009::text,1,10),'-','') < '$date' ");
        $max_date = QueryHelper::fetchSingleResult("select max(replace(substring(date0009::text,1,10),'-','')) as date from seikyuzandaka where substring(datatxt0142::text,1,6) = '$yobi12' and replace(substring(date0009::text,1,10),'-','') <= '$date' ")->date ?? null;
        if($max_date){
            $invoice = QueryHelper::fetchSingleResult("select sum(datanum0064) as balance_total from seikyuzandaka where substring(datatxt0142::text,1,6) = '$yobi12' and replace(substring(date0009::text,1,10),'-','') = '$max_date' ");
            $sales = QueryHelper::fetchSingleResult("select sum(tuhanorder.numeric3) as numeric3_total, sum(tuhanorder.numeric4) as numeric4_total 
                    from tuhanorder
                    left join orderhenkan
                        on tuhanorder.orderbango = orderhenkan.bango
                    where substring(tuhanorder.information2,1,6) = '$yobi12' and orderhenkan.intorder03 > '$max_date' and orderhenkan.intorder03 <= '$date' and tuhanorder.text1 != 'U560' and tuhanorder.text1 != 'U523'
                    ");
            $deposit = QueryHelper::fetchSingleResult("select sum(nyukingaku) as nyukingaku_total 
                    from daikinseisan
                    where substring(chumonsyaname,1,6) = '$yobi12' and replace(substring(torikomidate::text,1,10),'-','') > '$max_date'
                    and replace(substring(torikomidate::text,1,10),'-','') <= '$date' and soufusakiname != 'A907'
                    ");
        
            $a = $invoice->balance_total;
            $b = $sales->numeric3_total + $sales->numeric4_total;
            $c = $deposit->nyukingaku_total;
        }

        $all_balance['A'] = $a;
        $all_balance['C'] = $a + $b - $c;
        
        // Part 2
        $max_date_2 = QueryHelper::fetchSingleResult("select max(replace(substring(date0008::text,1,10),'-','')) as date from urikakezandaka where substring(datatxt0138::text,1,6) = '$yobi12' and replace(substring(date0008::text,1,10),'-','') <= '$date' ")->date ?? null;
        if($max_date_2){
            $bill = QueryHelper::fetchSingleResult("select COALESCE(sum(datanum0035),0) as bill_total from urikakezandaka where substring(datatxt0138::text,1,6) = '$yobi12' and replace(substring(date0008::text,1,10),'-','') = '$max_date_2' ");
            
            $deposit_bill = QueryHelper::fetchSingleResult("select sum(nyukingaku) as nyukingaku_total 
                    from daikinseisan
                    where substring(chumonsyaname,1,6) = '$yobi12' and replace(substring(torikomidate::text,1,10),'-','') > '$max_date_2'
                    and replace(substring(torikomidate::text,1,10),'-','') <= '$date' and soufusakiname = 'A905'
                    ");
            $deposit_bill2 = QueryHelper::fetchSingleResult("select sum(nyukingaku) as nyukingaku_total 
                    from daikinseisan
                    where substring(chumonsyaname,1,6) = '$yobi12' and replace(substring(torikomidate::text,1,10),'-','') > '$max_date_2'
                    and replace(substring(torikomidate::text,1,10),'-','') <= '$date' and soufusakiname = 'A907'
                    ");
            $a_2 = $bill->bill_total;
            $b_2 = $deposit_bill->nyukingaku_total;
            $c_2 = $deposit_bill2->nyukingaku_total;
        }
        
        $all_balance['D'] = $a_2 + $b_2 - $c_2;

        // Part 3
        $haisou = QueryHelper::fetchSingleResult("select * from haisou where shikibetsucode = '$yobi12' and kounyusu = 0 and torihikisakibango = '$torihikisakibango'");
        $companyData = QueryHelper::fetchSingleResult("select * from kokyaku1 where yobi12 = '$yobi12' and denpyosaiban = 0 ");
        $haisouBango = $haisou->bango ?? null;
        $percent_val = "";
        if ($haisouBango) {
            $other2 = QueryHelper::fetchSingleResult("select * from others2 where otherint1 = '$haisouBango'");
            $other1 = $other2->other1 ?? null;
            if ($other1) {
                if (explode(" ", $other1)[0] == '1') {
                    $code = $companyData->mail_toiawase_mb ? $companyData->mail_toiawase_mb : null;
                    $code1 = substr($code,0,2);
                    $code2 = substr($code,2,2);
                    $category_data = QueryHelper::fetchSingleResult("select * from categorykanri where category1='$code1' and category2='$code2' ");
                    $percent_val = substr($category_data->category5, 0, 2);
                } elseif (explode(" ", $other1)[0] == '2') {
                     $code = $other2->other16 ? $other2->other16 : null;
                     $code1 = substr($code,0,2);
                     $code2 = substr($code,2,2);
                     $category_data = QueryHelper::fetchSingleResult("select * from categorykanri where category1='$code1' and category2='$code2' ");
                     $percent_val = substr($category_data->category5, 0, 2);
                }
            }
        }

        $first_date = date("Ym01");
        $last_date = date('Ymt', strtotime("first day of +2 month",strtotime($date)));
        $backorder_amount = QueryHelper::fetchSingleResult("select sum(tuhanorder.money10) as money10_total,
                sum(tuhanorder.money10 * '$percent_val')/100 as money10_total_percentage 
                from tuhanorder
                left join orderhenkan
                    on tuhanorder.orderbango = orderhenkan.bango
                left join hikiatesyukko
                    on orderhenkan.kokyakuorderbango=hikiatesyukko.syouhinid
                where substring(tuhanorder.information2,1,6) = '$yobi12' and orderhenkan.datachar02 != 'U123' and orderhenkan.datachar02 != 'U160'
                and hikiatesyukko.datachar04 = '2' and orderhenkan.intorder03 between '$first_date' and '$last_date'
                ");
        
        $all_balance['E'] = $backorder_amount->money10_total + $backorder_amount->money10_total_percentage;
        //$all_balance['E'] = $backorder_amount->money10_total_percentage;
        $all_balance['B'] = $companyData->denpyostart;

        return $all_balance;
    }

    public static function getSpecificIdotanaBango($setcode, $percentage)
    {
        if ($setcode) {
            $tanabango = $setcode . ',';
            $tanabango .= $percentage ? $percentage : 0;
            return $tanabango;
        }
        return null;
    }

    public static function getDeliveryMethods($category1, $category2)
    {

        if ($category1 && $category2) {
            $deliveryMethod = QueryHelper::fetchSingleResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = '$category1' and category2 = '$category2' and suchi2 = 0 order by  bango");
            return $deliveryMethod ? $deliveryMethod->category2 . ' ' . $deliveryMethod->category4 : null;
        }
        return null;
    }

    public static function getContinutionCategory($syouhinbango)
    {

        if ($syouhinbango) {
            $syouhinbango = explode(' ', $syouhinbango) ? explode(' ', $syouhinbango)[0] : $syouhinbango;
            $continutionCategory = QueryHelper::fetchSingleResult("select syouhinbango, jouhou, color, bango from request where color = '0201継続区分' and syouhinbango = '$syouhinbango' ");
            return $continutionCategory ? $continutionCategory->syouhinbango . ' ' . $continutionCategory->jouhou : null;
        }
        return null;
    }
    public static function getChildCount($productCd)
    {

        if ($productCd) {
            $shoyhin4Bango = QueryHelper::fetchSingleResult("select bango from syouhin1 where kokyakusyouhinbango = '$productCd' ")->bango ?? "";
            $data100 = QueryHelper::fetchSingleResult("select data100 from syouhin1 where kokyakusyouhinbango = '$productCd' ")->data100 ?? "";
            $childCount =  QueryHelper::fetchSingleResult("select count( bango) from syouhin4 where chardata4 = '$productCd' and dspbango is not null")->count ?? "";
            $syouhin4 =  QueryHelper::fetchSingleResult("select color from syouhin4 where bango = $shoyhin4Bango ");
            $color = $syouhin4 ? $syouhin4->color : "";
            return [$data100, $childCount, $color];
        }
        return ["", "", ""];
    }
    public static function isConfirmModalShow($kokyakusyouhinbango)
    {
        $res = QueryHelper::fetchSingleResult("select  count(syouhin1.bango) as haschild from misyukko
                        inner join syouhin1 on misyukko.kawasename::int = syouhin1.kokyakusyouhinbango::int
                        inner join juchusyukko on misyukko.syouhinid = juchusyukko.syouhinid
                        where misyukko.idoutanabango is not null and misyukko.syouhinid = '$kokyakusyouhinbango'
                        and  syouhin1.data100 = 'D131' and  juchusyukko.datachar01='2'")->haschild ?? 0;
        return (bool) $res;
    }
}
