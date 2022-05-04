<?php

namespace App\AllClass\purchase\hatchuNyuryoku;

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

class PurchaseEntry
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
        // $dataChar08 = static::setLbookDataChar08($orderRequest->supplier, $orderDetailRequests[0]["productName"]);
        $validator = PurchaseCreateValidation::handle(request()->all());
        $errors = $validator->errors();
        if ($errors->any()) {
            return $errors;
        } elseif (!$errors->any() && $request->confirm_status == 0) {
            $result['status'] = 'confirm';
            return $result;
        } else if ($request->confirm_status == 1 && !$errors->any()) {
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### hatchu_nyuryoku start\n";
            QueryHandler::logger($bango, $log_data);
            $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
            pg_query($conn, "BEGIN");
            try {
                $kokyakuorderbango = static::getKokyakuOrderBango();
                $dataChar08 = static::setLbookDataChar08($orderRequest->supplier, $orderDetailRequests[0]["productName"]);
                // $dataChar06 = ($orderRequest->order_category == 'U150' && $orderRequest->creation_category == '1') ? $orderRequest->number_search : null;
                $orderHenkan = [
                    'datachar02' => $orderRequest->order_category ?? null,
                    'datachar01' => substr($orderRequest->siiresakimitumori, 0, 50) ?? null,
                    'intorder04' => $orderRequest->creation_category ?? null,
                    'datachar08' => $orderRequest->supplier ?? null,
                    'datachar09' => static::getEmployeeId($orderRequest->tantou),
                    'datachar10' => $orderRequest->sold_to ?? null,
                    'datachar11' => $orderRequest->end_customer?? null,
                    'kokyakuorderbango' => $kokyakuorderbango ?? null,
                    'intorder01' => static::stringDataConvertedToIntegerFormat($orderRequest->sales_amount_total) ?? null,
                    'intorder02' => static::stringDataConvertedToIntegerFormat($orderRequest->totalTax ) ?? null,
                    'datachar03' => null,
                    'datachar04' => $orderRequest->hacchu_bikou1 ?? null,
                    'datachar05' => $orderRequest->hacchu_bikou2 ?? null,
                    'datachar06' => $orderRequest->hacchu_bikou3 ?? null,
                    'datatxt0152' => $orderRequest->support_number_search ?? null,
                    'datatxt0155' => $bango,
                    'datatxt0156' => $orderRequest->payment_criteria ?? null,
                    'intorder03' => 2,
                    'ordertypebango2' => 0,
                    'synchroorderbango2' => 0,
                    'date' => $orderRequest->order_date ?? null,
                    'date0016' => Carbon::now()->format('Y-m-d H:i:s'),
                    'orderuserbango' => $orderRequest->order_user_bango ?? null
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
                if (!file_exists('uploads/hatchu-nyuryoku')) {
                    mkdir('uploads/hatchu-nyuryoku', 0777, true);
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

                            $file->move(public_path('uploads/hatchu-nyuryoku'), $filename);
                        } else {
                            $filename = $orderRequest->purchase_order_file_name;
                        }

                        //============== L-Book reg start here ==================//
                        $soukonyuko_insert_data = [
                            'orderbango' => $orderHenkan->bango,
                            'datachar01' => $modified_orderbango,
                            'datachar02' => $orderRequest->sold_to ?? null,
                            'datachar03' => null,
                            'datachar04' => $orderRequest->end_customer ?? null,
                            'datachar05' => $orderHenkan->kokyakuorderbango ?? null,
                            'datachar06' => $bango,
                            'datachar07' => 'H128',
                            'datachar08' => $dataChar08 ?? null,
                            'datachar09' => $filename,
                            'datachar10' => 'H910',
                            'dataint25' => 0,
                            'datachar11' => static::getCurrentTime(),
                            //'datatxt0099' => Helper::getSystemIP(),
                            'datachar13' => $bango,
                        ];
                        $soukonyuko = QueryHelper::insertData('soukonyuko', $soukonyuko_insert_data, 'datachar01', true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                        if ($soukonyuko && $file != "") {
                            \File::copy(public_path('uploads/hatchu-nyuryoku/') . $filename, public_path('uploads/lbook/') . $filename);
                        }

                        //update orderhenkan data
                        $orderhenkan_update_data = [
                            //'kokyakuorderbango' => $orderHenkan->kokyakuorderbango,
                            'bango' => $orderHenkan->bango,
                            'datatxt0150' => $modified_orderbango,
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

                // after create orderhenkan
                $hikiatenyuko = [
                    'orderbango' => $orderHenkan->bango,
                    'syouhinid' => $orderHenkan->kokyakuorderbango ?? null,
                    'syouhinsyu' => null,
                    'hantei' => null,
                    'dataint01' => null,
                    'dataint02' => 2,
                    'dataint03' => 2,
                    'dataint04' => 2,
                    'dataint05' => 2,
                    'dataint06' => 2,
                    'dataint07' => $orderRequest->saisyukokyaku_checkbox ?? 2,
                    'dataint08' => null,
                    'dataint09' => null,
                    'datachar01' => null,
                    'datachar02' => null,
                    'datachar03' => null,
                    'datachar04' => null,
                    'datachar05' => null,
                    'yoteimeter' => 0,
                    'denpyoshimebi' => null,
                    'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'),
                    'tantousyabango' => $bango
                ];
                QueryHelper::insertData('hikiatenyuko', $hikiatenyuko, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                foreach ($orderDetailRequests as $request) {
                    $request = (object)$request;
                    $minyuko = [
                        'orderbango' => $orderHenkan->bango,
                        'syouhinid' => $orderHenkan->kokyakuorderbango ?? null,
                        'syouhinsyu' => $request->line ?? null,
                        'hantei' => 000,
                        'zaikometer' => 0, 
                        'kingaku' => static::stringDataConvertedToIntegerFormat($request->price, 'comma') ?? null,
                        'nyukosu' => static::stringDataConvertedToIntegerFormat($request->quantity, 'comma') ?? null,
                        'datachar01' => static::getOrderClassification($orderRequest->order_category) ?? null,
                        'datachar02' => $request->syouhincd ?? null,
                        'datachar03' => $request->productName ?? null,
                        'genka' => static::stringDataConvertedToIntegerFormat($request->partitionUnitPrice, 'comma') ?? null,
                        'syouhizeiritu' => static::stringDataConvertedToIntegerFormat($request->orderAmount, 'comma') ?? null,
                        'datachar06' =>  null,
                        'datachar07' => $request->me_ka_hinban ?? null,
                        'datachar08' => $request->productName ?? null,
                        'datachar09' => null,
                        'datachar10' => null,
                        'datachar11' => $request->comment ?? null,
                        'datachar12' => $request->genchoujikan ?? null,
                        'kaiinid' => $request->deliveryDestination ?? null,
                        'kanryoubi' => $request->genchoubi ?? null,
                        'yoteibi' => $request->kobetunouki ?? null,
                        'dataint20' => null,
                        'dataint21' => $request->saitan ?? 2,
                        'dataint22' => null,
                        'dataint23' => null,
                        'dataint24' => null,
                        'dataint25' => null,
                        'datachar13' => null,
                        'season' => null,
                        'nengetsu' => null,
                        'weeks' => null,
                        'yoyakubi' => null,
                        'datachar14' => static::getEmployeeId($request->houseEntry) ?? null,
                        'datachar15' => null,
                        'datachar16' => null,
                        'datachar17' => null,
                        'datachar19' => null,
                        'datachar18' => $request->siharaikazeikubun ?? null,
                        'denpyobango' => 0,
                        'denpyoshimebi' => null,
                        'yoteimeter' => $request->juchubangougyou ?? null,
                        'nyukometer' => $request->juchubangougyoueda ?? null,
                        'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'),
                        'tantousyabango' => $bango,
                        'idoutanabango' => $request->juchubangou ?? null,
                        'soukobango' => static::stringDataConvertedToIntegerFormat($request->syouhizei, 'comma') ?? null,
                    ];
                    $minyuko = QueryHelper::insertData('minyuko', $minyuko, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                    $juchusyukko2 = [
                        'syouhinid' => $orderHenkan->kokyakuorderbango ?? null,
                        'syouhinsyu' => $request->line ?? null,
                        'hantei' => $minyuko->hantei,
                        'season' => 1,
                        'nengetsu' => null,
                        'weeks' => null,
                        'datachar01' => null,
                        'datachar02' => null,
                        'datachar03' => null,
                        'datachar04' => null,
                        'yoteimeter' => 0,
                        'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'),
                        'day' => 2,
                        'tantousyabango' => $bango,
                        'tanka' => 2,
                        'orderbango' => $orderHenkan->bango,
                    ];
                    QueryHelper::insertData('juchusyukko2', $juchusyukko2, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                }
                $review = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7012'");
                $orderBango = $review->orderbango;
                $orderBango = (int)$orderBango + 1;
                $review = [
                    'kokyakusyouhinbango' => 'D7012',
                    'orderbango' => $orderBango,
                    'jouhou' => static::getCurrentTime(),
                    'color' => static::getCurrentTime(),
                    'size' => request()->ip(),
                    'nickname' => $bango,
                ];
                QueryHelper::updateData('review', $review, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                
                //inserting in rreriki
                CreateHatchuDetails::data($bango,$kokyakuorderbango,0,1,'05-02');

                $result['status'] = 'ok';
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### hatchu_nyuryoku end\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "COMMIT");
                session()->flash('success_msg', "発注番号" . $kokyakuorderbango . "で登録しました。");
                $session_order_bango = $orderHenkan->kokyakuorderbango;
                // if (self::isConfirmModalShow($orderHenkan->kokyakuorderbango) && $orderRequest->order_category != 'U150') {
                //     $session_order_bango =   $orderHenkan->kokyakuorderbango;
                // }
                $result['session_order_bango'] = $session_order_bango;
                $result['session_company_code'] = $orderRequest->sold_to;
            }catch (\Exception $e) {
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
        $validator = PurchaseCreateValidation::handle(request()->all());
        $errors = $validator->errors();
        if ($errors->any()) {
            return $errors;
        } elseif (!$errors->any() && $request->confirm_status == 0) {
            $result['status'] = 'confirm';
            return $result;
        } elseif ($request->confirm_status == 1 && !$errors->any()) {
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### hatchu_nyuryoku start\n";
            QueryHandler::logger($bango, $log_data);
            $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
            pg_query($conn, "BEGIN");
            try {
                $orderId = $orderRequest->order_number;
                $dataChar08 = static::setLbookDataChar08($orderRequest->supplier, $orderDetailRequests[0]["productName"]);
                // $dataChar06 = ($orderRequest->order_category == 'U150' && $orderRequest->creation_category == '1') ? $orderRequest->number_search : null;
                $orderHenkan = [
                    'datachar02' => $orderRequest->order_category ?? null,
                    'datachar01' => substr($orderRequest->siiresakimitumori, 0, 50) ?? null,
                    'intorder04' => $orderRequest->creation_category ?? null,
                    'datachar08' => $orderRequest->supplier ?? null,
                    'datachar09' => static::getEmployeeId($orderRequest->tantou),
                    'datachar10' => $orderRequest->sold_to ?? null,
                    'datachar11' => $orderRequest->end_customer?? null,
                    'kokyakuorderbango' => $orderRequest->order_number ?? null,
                    'intorder01' => static::stringDataConvertedToIntegerFormat($orderRequest->sales_amount_total) ?? null,
                    'intorder02' => static::stringDataConvertedToIntegerFormat($orderRequest->totalTax ) ?? null,
                    'datachar03' => null,
                    'datachar04' => $orderRequest->hacchu_bikou1 ?? null,
                    'datachar05' => $orderRequest->hacchu_bikou2 ?? null,
                    'datachar06' => $orderRequest->hacchu_bikou3 ?? null,
                    'datatxt0152' => $orderRequest->support_number_search ?? null,
                    'datatxt0155' => $bango,
                    'datatxt0156' => $orderRequest->payment_criteria ?? null,
                    'intorder03' => 2,
                    'ordertypebango2' => (int)($orderRequest->ordertypebango2) + 1,
                    'synchroorderbango2' => 0,
                    'date' => $orderRequest->order_date ?? null,
                    'date0016' => $orderRequest->date0016 ?? null,
                    'date0017' => Carbon::now()->format('Y-m-d H:i:s'),
                    'orderuserbango' => $orderRequest->order_user_bango ?? null
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
                if (!file_exists('uploads/hatchu-nyuryoku')) {
                    mkdir('uploads/hatchu-nyuryoku', 0777, true);
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
                            $file->move(public_path('uploads/hatchu-nyuryoku'), $filename);
                            $soukonyuko_insert_data = [
                                'orderbango' => $orderHenkan->bango,
                                'datachar01' => $modified_orderbango,
                                'datachar02' => $orderRequest->sold_to ?? null,
                                'datachar03' => null,
                                'datachar04' => $orderRequest->end_customer ?? null,
                                'datachar05' => $orderRequest->order_number ?? null,
                                'datachar06' => $bango,
                                'datachar07' => 'H128',
                                'datachar08' => $dataChar08 ?? null,
                                'datachar09' => $filename,
                                'datachar10' => 'H910',
                                'dataint25' => 0,
                                'datachar11' => static::getCurrentTime(),
                                //'datatxt0099' => Helper::getSystemIP(),
                                'datachar13' => $bango,
                            ];
                            $soukonyuko = QueryHelper::insertData('soukonyuko', $soukonyuko_insert_data, 'datachar01', true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                            if ($soukonyuko) {
                                \File::copy(public_path('uploads/hatchu-nyuryoku/') . $filename, public_path('uploads/lbook/') . $filename);
                            }
                            //update orderhenkan data
                            $orderhenkan_update_data = [
                                'bango' => $orderHenkan->bango,
                                // 'kokyakuorderbango' => $orderHenkan->kokyakuorderbango,
                                'datatxt0150' => $modified_orderbango
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
                                'datachar04' => $orderRequest->end_customer,
                                'datachar08' => $dataChar08
                            ];

                            // QueryHelper::updateData('soukonyuko', $soukonyuko_update_data, 'datachar05', $bango, __CLASS__, __FUNCTION__, __LINE__);
                            QueryHelper::updateData('soukonyuko', $soukonyuko_update_data, ['datachar05' => $orderRequest->order_number, 'datachar01' => $orderRequest->datachar08], $bango, __CLASS__, __FUNCTION__, __LINE__);

                            //update orderhenkan data
                            $orderhenkan_update_data = [
                                'bango' => $orderHenkan->bango,
                                // 'kokyakuorderbango' => $orderHenkan->kokyakuorderbango,
                                'datatxt0150' => $orderRequest->datatxt0150 ?? null
                            ];
                            QueryHelper::updateData('orderhenkan', $orderhenkan_update_data, 'bango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                        }
                                        //============== L-Book reg end here ==================//

                    }
                }

                // after create orderhenkan
                $hikiatenyuko = [
                    'orderbango' => $orderHenkan->bango,
                    'syouhinid' => $orderHenkan->kokyakuorderbango ?? null,
                    'syouhinsyu' => null,
                    'hantei' => null,
                    'dataint01' => null,
                    'dataint02' => 2,
                    'dataint03' => 2,
                    'dataint04' => 2,
                    'dataint05' => 2,
                    'dataint06' => 2,
                    'dataint07' => $orderRequest->saisyukokyaku_checkbox ?? 2,
                    'dataint08' => null,
                    'dataint09' => null,
                    'datachar01' => null,
                    'datachar02' => null,
                    'datachar03' => null,
                    'datachar04' => null,
                    'datachar05' => null,
                    'yoteimeter' => 0,
                    'denpyoshimebi' => Carbon::now()->format('Y-m-d H:i:s'),
                    // 'denpyohakkoubi' => null,
                    'tantousyabango' => $bango
                ];
                QueryHelper::updateData('hikiatenyuko', $hikiatenyuko, 'syouhinid',$bango, __CLASS__, __FUNCTION__, __LINE__);
                foreach ($orderDetailRequests as $request) {
                    $request = (object)$request;
                    $minyuko = [
                        'orderbango' => $orderHenkan->bango,
                        'syouhinid' => $orderHenkan->kokyakuorderbango ?? null,
                        'syouhinsyu' => $request->line ?? null,
                        'hantei' => 000,
                        'zaikometer' => (int)($orderRequest->ordertypebango2) + 1, 
                        'kingaku' => static::stringDataConvertedToIntegerFormat($request->price, 'comma') ?? null,
                        'nyukosu' => static::stringDataConvertedToIntegerFormat($request->quantity, 'comma') ?? null,
                        'datachar01' => static::getOrderClassification($orderRequest->order_category) ?? null,
                        'datachar02' => $request->syouhincd ?? null,
                        'datachar03' => $request->productName ?? null,
                        'genka' => static::stringDataConvertedToIntegerFormat($request->partitionUnitPrice, 'comma') ?? null,
                        'syouhizeiritu' => static::stringDataConvertedToIntegerFormat($request->orderAmount, 'comma') ?? null,
                        'datachar06' =>  null,
                        'datachar07' => $request->me_ka_hinban ?? null,
                        'datachar08' => $request->productName ?? null,
                        'datachar09' => null,
                        'datachar10' => null,
                        'datachar11' => $request->comment ?? null,
                        'datachar12' => $request->genchoujikan ?? null,
                        'kaiinid' => $request->deliveryDestination ?? null,
                        'kanryoubi' => $request->genchoubi ?? null,
                        'yoteibi' => $request->kobetunouki ?? null,
                        'dataint20' => null,
                        'dataint21' => $request->saitan ?? 2,
                        'dataint22' => null,
                        'dataint23' => null,
                        'dataint24' => null,
                        'dataint25' => null,
                        'datachar13' => null,
                        'season' => null,
                        'nengetsu' => null,
                        'weeks' => null,
                        'yoyakubi' => null,
                        'datachar14' => static::getEmployeeId($request->houseEntry) ?? null,
                        'datachar15' => null,
                        'datachar16' => null,
                        'datachar17' => null,
                        'datachar19' => null,
                        'datachar18' => $request->siharaikazeikubun ?? null,
                        'denpyobango' => 0,
                        'denpyoshimebi' => Carbon::now()->format('Y-m-d H:i:s'),
                        'yoteimeter' => $request->juchubangougyou ?? null,
                        'nyukometer' => $request->juchubangougyoueda ?? null,
                        'denpyohakkoubi' => $request->denpyohakkoubi ?? null,
                        'tantousyabango' => $bango,
                        'idoutanabango' => $request->juchubangou ?? null,
                        'soukobango' => static::stringDataConvertedToIntegerFormat($request->syouhizei, 'comma') ?? null,
                    ];
                    $minyuko = QueryHelper::insertData('minyuko', $minyuko, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                    $juchusyukko2 = [
                        'syouhinid' => $orderHenkan->kokyakuorderbango ?? null,
                        'syouhinsyu' => $request->line ?? null,
                        'hantei' => $minyuko->hantei,
                        'season' => 1,
                        'nengetsu' => null,
                        'weeks' => null,
                        'datachar01' => null,
                        'datachar02' => null,
                        'datachar03' => null,
                        'datachar04' => null,
                        'yoteimeter' => 0,
                        // 'denpyohakkoubi' => null,
                        'denpyoshimebi' => Carbon::now()->format('Y-m-d H:i:s'),
                        'day' => 2,
                        'tantousyabango' => $bango,
                        'tanka' => 2,
                        'orderbango' => $orderHenkan->bango,
                    ];
                    QueryHelper::updateData('juchusyukko2', $juchusyukko2, ['syouhinid' => $minyuko->syouhinid,'syouhinsyu' => $request->line], $bango, __CLASS__, __FUNCTION__, __LINE__);
                    $juchusyukko = [
                        // 'orderbango' => $orderHenkan->bango,
                        // 'syouhinid' => $minyuko->yoteimeter ?? null,
                        'tantousyabango' => $bango,
                        'datachar03' => 1,
                        'idoutanabango' => static::getCurrentTime()
                    ];
                    QueryHelper::updateData('juchusyukko', $juchusyukko, ['syouhinid' => $request->juchubangou, 'syouhinsyu' => $request->juchubangougyou, 'hantei' => $request->juchubangougyoueda], $bango, __CLASS__, __FUNCTION__, __LINE__);
                    if($orderRequest->order_category == 'V430' || $orderRequest->order_category == 'V440'){
                        $misyukko = [
                            'tantousyabango' => $bango,
                        ];
                        QueryHelper::updateData('misyukko', $misyukko, ['syouhinid' => $request->juchubangou, 'syouhinsyu' => $request->juchubangougyou, 'hantei' => $request->juchubangougyoueda], $bango, __CLASS__, __FUNCTION__, __LINE__);
                    }else {
                        $datachar22 = static::setJM0039ForMisyukkoUpdate($minyuko->datachar01, $request->juchubangou, $request->juchubangougyou, $request->juchubangougyoueda);
                        $misyukko = [
                            'tantousyabango' => $bango,
                            'datachar22' => $datachar22,
                        ];
                        QueryHelper::updateData('misyukko', $misyukko, ['syouhinid' => $request->juchubangou, 'syouhinsyu' => $request->juchubangougyou, 'hantei' => $request->juchubangougyoueda], $bango, __CLASS__, __FUNCTION__, __LINE__);
                    }
                         
                }

                //inserting into rireki
                $tmp_kokyakuorderbango = $orderRequest->order_number ?? null;
                $tmp_ordertypebango2 = (int)($orderRequest->ordertypebango2) + 1;
                CreateHatchuDetails::data($bango,$tmp_kokyakuorderbango, $tmp_ordertypebango2,2,'05-02');

                $result['status'] = 'ok';
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### hatchu_nyuryoku end\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "COMMIT");
                session()->flash('success_msg', "発注番号" . $orderRequest->order_number . "で更新しました。");
            }catch (\Exception $e) {
                // dd($e);
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "ROLLBACK");
                session()->flash('success_msg', "something" . $orderRequest->order_number . "went wrong");
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
            if ($value == "") {
                $orderRequest[$key] = null;
            }
        }
        $orderRequest = (object)$orderRequest;
        $validator = PurchaseCreateValidation::handle(request()->all());
        $errors = $validator->errors();
        if ($errors->any()) {
            return $errors;
        } elseif (!$errors->any() && $request->confirm_status == 0) {
            $result['status'] = 'confirm';
            return $result;
        } elseif ($request->confirm_status == 1 && !$errors->any()) {
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### hatchu_nyuryoku start\n";
            QueryHandler::logger($bango, $log_data);
            $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
            pg_query($conn, "BEGIN");
            try {
                $orderId = $orderRequest->order_number;
                $dataChar08 = static::setLbookDataChar08($orderRequest->supplier, $orderDetailRequests[0]["productName"]);
                $orderHenkan = [
                    'datachar02' => $orderRequest->order_category ?? null,
                    'datachar01' => substr($orderRequest->siiresakimitumori, 0, 50) ?? null,
                    'intorder04' => $orderRequest->creation_category ?? null,
                    'datachar08' => $orderRequest->supplier ?? null,
                    'datachar09' => static::getEmployeeId($orderRequest->tantou),
                    'datachar10' => $orderRequest->sold_to ?? null,
                    'datachar11' => $orderRequest->end_customer?? null,
                    'kokyakuorderbango' => $orderRequest->order_number ?? null,
                    'intorder01' => static::stringDataConvertedToIntegerFormat($orderRequest->sales_amount_total) ?? null,
                    'intorder02' => static::stringDataConvertedToIntegerFormat($orderRequest->totalTax ) ?? null,
                    'datachar03' => null,
                    'datachar04' => $orderRequest->hacchu_bikou1 ?? null,
                    'datachar05' => $orderRequest->hacchu_bikou2 ?? null,
                    'datachar06' => $orderRequest->hacchu_bikou3 ?? null,
                    'datatxt0152' => $orderRequest->support_number_search ?? null,
                    'datatxt0155' => $bango,
                    'datatxt0156' => $orderRequest->payment_criteria ?? null,
                    'intorder03' => 2,
                    'ordertypebango2' => (int)($orderRequest->ordertypebango2) + 1,
                    'synchroorderbango2' => 1,
                    'date' => $orderRequest->order_date ?? null,
                    'date0016' => $orderRequest->date0016 ?? null,
                    'date0017' => Carbon::now()->format('Y-m-d H:i:s'),
                    'orderuserbango' => $orderRequest->order_user_bango ?? null
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
                if (!file_exists('uploads/hatchu-nyuryoku')) {
                    mkdir('uploads/hatchu-nyuryoku', 0777, true);
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
                            $file->move(public_path('uploads/hatchu-nyuryoku'), $filename);
                            $soukonyuko_insert_data = [
                                'orderbango' => $orderHenkan->bango,
                                'datachar01' => $modified_orderbango,
                                'datachar02' => $orderRequest->sold_to ?? null,
                                'datachar03' => null,
                                'datachar04' => $orderRequest->end_customer ?? null,
                                'datachar05' => $orderRequest->order_number ?? null,
                                'datachar06' => $bango,
                                'datachar07' => 'H128',
                                'datachar08' => $dataChar08 ?? null,
                                'datachar09' => $filename,
                                'datachar10' => 'H910',
                                'dataint25' => 0,
                                'datachar11' => static::getCurrentTime(),
                                //'datatxt0099' => Helper::getSystemIP(),
                                'datachar13' => $bango,
                            ];
                            $soukonyuko = QueryHelper::insertData('soukonyuko', $soukonyuko_insert_data, 'datachar01', true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                            if ($soukonyuko) {
                                \File::copy(public_path('uploads/hatchu-nyuryoku/') . $filename, public_path('uploads/lbook/') . $filename);
                            }
                            //update orderhenkan data
                            $orderhenkan_update_data = [
                                'bango' => $orderHenkan->bango,
                                // 'kokyakuorderbango' => $orderHenkan->kokyakuorderbango,
                                'datatxt0150' => $modified_orderbango
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
                                'datachar04' => $orderRequest->end_customer,
                                'datachar08' => $dataChar08
                            ];

                            // QueryHelper::updateData('soukonyuko', $soukonyuko_update_data, 'datachar05', $bango, __CLASS__, __FUNCTION__, __LINE__);
                            QueryHelper::updateData('soukonyuko', $soukonyuko_update_data, ['datachar05' => $orderRequest->order_number, 'datachar01' => $orderRequest->datachar08], $bango, __CLASS__, __FUNCTION__, __LINE__);

                            //update orderhenkan data
                            $orderhenkan_update_data = [
                                'bango' => $orderHenkan->bango,
                                // 'kokyakuorderbango' => $orderHenkan->kokyakuorderbango,
                                'datatxt0150' => $orderRequest->datatxt0150 ?? null
                            ];
                            QueryHelper::updateData('orderhenkan', $orderhenkan_update_data, 'bango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                        }
                                        //============== L-Book reg end here ==================//

                    }
                }

                // after create orderhenkan
                $hikiatenyuko = [
                    'orderbango' => $orderHenkan->bango,
                    'syouhinid' => $orderHenkan->kokyakuorderbango ?? null,
                    'syouhinsyu' => null,
                    'hantei' => null,
                    'dataint01' => null,
                    'dataint02' => 2,
                    'dataint03' => 2,
                    'dataint04' => 2,
                    'dataint05' => 2,
                    'dataint06' => 2,
                    'dataint07' => $orderRequest->saisyukokyaku_checkbox ?? 2,
                    'dataint08' => null,
                    'dataint09' => null,
                    'datachar01' => null,
                    'datachar02' => null,
                    'datachar03' => null,
                    'datachar04' => null,
                    'datachar05' => null,
                    'yoteimeter' => 1,
                    'denpyoshimebi' => Carbon::now()->format('Y-m-d H:i:s'),
                    // 'denpyohakkoubi' => null,
                    'tantousyabango' => $bango
                ];
                QueryHelper::updateData('hikiatenyuko', $hikiatenyuko, 'syouhinid',$bango, __CLASS__, __FUNCTION__, __LINE__);
                foreach ($orderDetailRequests as $request) {
                    $request = (object)$request;
                    $minyuko = [
                        'orderbango' => $orderHenkan->bango,
                        'syouhinid' => $orderHenkan->kokyakuorderbango ?? null,
                        'syouhinsyu' => $request->line ?? null,
                        'hantei' => 000,
                        'zaikometer' => (int)($orderRequest->ordertypebango2) + 1, 
                        'kingaku' => static::stringDataConvertedToIntegerFormat($request->price, 'comma') ?? null,
                        'nyukosu' => static::stringDataConvertedToIntegerFormat($request->quantity, 'comma') ?? null,
                        'datachar01' => static::getOrderClassification($orderRequest->order_category) ?? null,
                        'datachar02' => $request->syouhincd ?? null,
                        'datachar03' => $request->productName ?? null,
                        'genka' => static::stringDataConvertedToIntegerFormat($request->partitionUnitPrice, 'comma') ?? null,
                        'syouhizeiritu' => static::stringDataConvertedToIntegerFormat($request->orderAmount, 'comma') ?? null,
                        'datachar06' =>  null,
                        'datachar07' => $request->me_ka_hinban ?? null,
                        'datachar08' => $request->productName ?? null,
                        'datachar09' => null,
                        'datachar10' => null,
                        'datachar11' => $request->comment ?? null,
                        'datachar12' => $request->genchoujikan ?? null,
                        'kaiinid' => $request->deliveryDestination ?? null,
                        'kanryoubi' => $request->genchoubi ?? null,
                        'yoteibi' => $request->kobetunouki ?? null,
                        'dataint20' => null,
                        'dataint21' => $request->saitan ?? 2,
                        'dataint22' => null,
                        'dataint23' => null,
                        'dataint24' => null,
                        'dataint25' => null,
                        'datachar13' => null,
                        'season' => null,
                        'nengetsu' => null,
                        'weeks' => null,
                        'yoyakubi' => null,
                        'datachar14' => static::getEmployeeId($request->houseEntry) ?? null,
                        'datachar15' => null,
                        'datachar16' => null,
                        'datachar17' => null,
                        'datachar19' => null,
                        'datachar18' => $request->siharaikazeikubun ?? null,
                        'denpyobango' => 1,
                        'denpyoshimebi' => Carbon::now()->format('Y-m-d H:i:s'),
                        'yoteimeter' => $request->juchubangougyou ?? null,
                        'nyukometer' => $request->juchubangougyoueda ?? null,
                        'denpyohakkoubi' => $request->denpyohakkoubi ?? null,
                        'tantousyabango' => $bango,
                        'idoutanabango' => $request->juchubangou ?? null,
                        'soukobango' => static::stringDataConvertedToIntegerFormat($request->syouhizei, 'comma') ?? null,
                    ];
                    $minyuko = QueryHelper::insertData('minyuko', $minyuko, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                    $juchusyukko2 = [
                        'syouhinid' => $orderHenkan->kokyakuorderbango ?? null,
                        'syouhinsyu' => $request->line ?? null,
                        'hantei' => $minyuko->hantei,
                        'season' => 1,
                        'nengetsu' => null,
                        'weeks' => null,
                        'datachar01' => null,
                        'datachar02' => null,
                        'datachar03' => null,
                        'datachar04' => null,
                        'yoteimeter' => 1,
                        // 'denpyohakkoubi' => null,
                        'denpyoshimebi' => Carbon::now()->format('Y-m-d H:i:s'),
                        'day' => 2,
                        'tantousyabango' => $bango,
                        'tanka' => 2,
                        'orderbango' => $orderHenkan->bango,
                    ];
                    QueryHelper::updateData('juchusyukko2', $juchusyukko2, ['syouhinid' => $request->juchubangou, 'syouhinsyu' => $request->juchubangougyou, 'hantei' => $request->juchubangougyoueda], $bango, __CLASS__, __FUNCTION__, __LINE__);
                    $juchusyukko = [
                        // 'orderbango' => $orderHenkan->bango,
                        // 'syouhinid' => $minyuko->yoteimeter ?? null,
                        'tantousyabango' => $bango,
                        'datachar03' => 2,
                        'idoutanabango' => static::getCurrentTime()
                    ];
                    QueryHelper::updateData('juchusyukko', $juchusyukko, ['syouhinid' => $request->juchubangou, 'syouhinsyu' => $request->juchubangougyou, 'hantei' => $request->juchubangougyoueda], $bango, __CLASS__, __FUNCTION__, __LINE__);
                    if($orderRequest->order_category == 'V430' || $orderRequest->order_category == 'V440'){
                        $misyukko = [
                            'tantousyabango' => $bango,
                        ];
                        QueryHelper::updateData('misyukko', $misyukko, ['syouhinid' => $request->juchubangou, 'syouhinsyu' => $request->juchubangougyou, 'hantei' => $request->juchubangougyoueda], $bango, __CLASS__, __FUNCTION__, __LINE__);
                    }else {
                        $datachar22 = static::setJM0039ForMisyukkoUpdate($minyuko->datachar01, $request->juchubangou, $request->juchubangougyou, $request->juchubangougyoueda);
                        $misyukko = [
                            'tantousyabango' => $bango,
                            'datachar22' => $datachar22,
                        ];
                        QueryHelper::updateData('misyukko', $misyukko, ['syouhinid' => $request->juchubangou, 'syouhinsyu' => $request->juchubangougyou, 'hantei' => $request->juchubangougyoueda], $bango, __CLASS__, __FUNCTION__, __LINE__);
                    }
                         
                }

                //inserting into rireki
                $tmp_kokyakuorderbango = $orderRequest->order_number ?? null;
                $tmp_ordertypebango2 = (int)($orderRequest->ordertypebango2) + 1;
                CreateHatchuDetails::data($bango,$tmp_kokyakuorderbango, $tmp_ordertypebango2,3,'05-02');

                $result['status'] = 'ok';
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### hatchu_nyuryoku end\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "COMMIT");
                session()->flash('success_msg', "発注番号" . $orderRequest->order_number . "で削除しました。");
            }catch (\Exception $e) {
                // dd($e);
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "ROLLBACK");
                session()->flash('success_msg', "something" . $orderRequest->order_number . "went wrong");
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
        $kokyakubango1stPart = "03";
        $kokyakubango2ndPart = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7501' ")->orderbango ?? null;
        $repeat = QueryHelper::fetchSingleResult("select review.mobile_flag from review where kokyakusyouhinbango = 'D7012' ")->mobile_flag ?? null;
        $kokyakubango3rdPart = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7012' ")->orderbango ?? null;
        $kokyakubango3rdPart = (int)$kokyakubango3rdPart + 1;
        $kokyakubango3rdPart = sprintf('%0' . $repeat . 'd', $kokyakubango3rdPart);
        return $kokyakubango1stPart . '' . $kokyakubango2ndPart . '' . $kokyakubango3rdPart;
    }

    public static function getProcessedRequests()
    {
        $orderDetailRequestInput = ['line', 'syouhincd', 'me_ka_hinban','productName','deliveryDestination', 'quantity', 'price', 'rate', 'partitionUnitPrice', 'orderAmount', 'serial', 'line', 'setcode', 'deletedProduct', 'shoyin_color', 'kobetunouki', 'genchoubi', 'genchoujikan', 'juchubangou', 'juchubangougyou', 'juchubangougyoueda', 'saitan', 'siharaikazeikubun', 'syouhizei', 'houseEntry', 'comment', 'denpyohakkoubi'];
        $orderRequest = request()->except($orderDetailRequestInput);
        $orderDetailRequests = request()->only($orderDetailRequestInput);
        try {
            if (count($orderDetailRequests['syouhincd']) > 1) {
                foreach ($orderDetailRequests as $key => $value) {
                    foreach ($value as $newKey => $val) {
                        if ($key == 'syouhincd') {
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
        // dd($orderRequest, $orderDetailRequests);
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
    public static function getOrderClassification($category){
        if($category){
            if($category == 'V410'){
                return 'V150';
            }elseif($category == 'V470'){
                return 'V150';
            }elseif($category == 'V440'){
                return 'V160';
            }elseif($category == 'V460'){
                return '';
            }
        }
        return "";
    }
    public static function setJM0039ForMisyukkoUpdate($datachar01 = null, $idoutanabango = null, $yoteimeter = null, $nyukometer = null){
        $datachar22 = "";
        if($idoutanabango && (!empty($yoteimeter) || is_numeric($yoteimeter)) && (!empty($nyukometer) || is_numeric($nyukometer))){
            $datachar22 = QueryHelper::fetchSingleResult("select * from misyukko where  syouhinid = '$idoutanabango' and syouhinsyu = '$yoteimeter' and hantei = '$nyukometer'")->datachar22 ?? null;
        }
        if($datachar01 && $datachar01 == 'V110'){
            if($datachar22){
                $datachar22[3] = '0';
            }
            // else{
            //     $datachar22 = '0000';
            // }
        }else if($datachar01){
            if($datachar22){
                $datachar22[3] = '1';
            }
            // else{
            //     $datachar22 = '0001';
            // }
        }else{
            $datachar22 = '0001';
        }
        return $datachar22;
    }
    public static function setLbookDataChar08($data105 = null, $data203 = null){
        $conId = substr($data105, 0, 6);
        $data = QueryHelper::fetchSingleResult("select substring(address,0,8) as address from kokyaku1 where yobi12 = '$conId'")->address ?? null;
        $result = $data. "_" . substr($data203, 0, 36). "_見積等";
        // dd($result, strlen($data), $data);
        return $result;
    }
}