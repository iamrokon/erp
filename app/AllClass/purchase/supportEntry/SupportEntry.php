<?php

namespace App\AllClass\purchase\supportEntry;

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

class SupportEntry{
    public static function create($request, $bango, $file){
        // $result = DB::table("misyukko")
        //            ->select("*")
        //            ->where("misyukko.datachar22", "!=", "")
        //            ->get();
        // // 23474

        // echo "<pre>";
        // var_dump($result);
        // return 0;

        // $result['status'] = 'ok';
        // $result['success_msg'] = "発注番号 059886454 で登録しました";
        // return $result;
        $validator = SupportEntryCreateValidation::handle(request()->all());


        $errors = $validator->errors();
        if ($errors->any()) {
            return $errors;
        }elseif(!$errors->any() && $request->submit_confirmation == ""){
            $result["status"] = "confirm";
            return $result;
        }else if (!$errors->any()) {
            // log
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### support_entry start\n";
            QueryHandler::logger($bango, $log_data);
            
            // connection for pg_query
            $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));

            pg_query($conn, "BEGIN");



            
            // kokyakuorderbango generate
            //$kokyakuorderbango = $request->number_search;
            $orderInfo = self::getOrderBango();
            $kokyakuorderbango = $orderInfo['kokyakuorderbango'];
            $review_orderbango = $orderInfo['review_orderbango'];


            try{
                // prepare for batch upload
                // upload the batch if exist | 217 proposal upload --------> orderhenkan. datatxt0150
                // mapping the orderhenkan attributes
                // insertion data to oderhenkan tble
                if (!file_exists('uploads')) {
                    mkdir('uploads', 0777, true);
                }

                if (!file_exists('uploads/support_entry')) {
                    mkdir('uploads/support_entry', 0777, true);
                }

                if (!file_exists('uploads/lbook/')) {
                    mkdir('uploads/lbook/', 0777, true);
                }

                if ($file != "" || $request->proposal_file != "") {
                    if ($file != "") {
                        $filenameWithExtension = $file->getClientOriginalName();
                        $fileExtension = '.' . $file->getClientOriginalExtension();
                        $filename = explode($fileExtension, $filenameWithExtension);
                        $filename = $filename[0] . '¶' . $kokyakuorderbango . '_' . static::getCurrentTime() . $fileExtension;

                        $file->move(public_path('uploads/support_entry'), $filename);
                      //  $file->move(public_path('uploads/lbook'), $filename);
                    } else {
                        $filename = $request->proposal_file;
                    }
                }else{
                    $filename = $request->proposal_file;
                } // . end batch upload 
                // .end orderhenkan insertion
                




               
                // start orderHenkan transaction
                $orderhenkan_insertable_data = [
                        // number search => order number
                        'kokyakuorderbango' => $kokyakuorderbango ?? null,

                        // 0 fixed
                        'ordertypebango2' => 0,
                        
                        // 104
                        'orderuserbango' => $request->number_search ?? null,
                        
                        // empty field
                        //'datachar01' => '',
                        
                        // 13 (support)
                        'datachar02' => 'V413',
                        
                        // 1 new
                        // old spec kokyakubango 
                        // new spec intorder04
                       // 'kokyakubango' => 1,

                         'intorder04' => 1,
                         
                        // empty field
                        //'kokyakubango' => '',
                        
                        // TODAY date
                        'date' => Carbon::now()->format('Y-m-d H:i:s'),
                        
                        // JU0008
                       // 'datachar09' => '受注「JU0008受注担当者」',
                        'datachar09' => $request->datachar05_ju0008,
                        
                        // 105 contractor
                       // 'datachar10' => $request->contractor ?? null,
                        'datachar10' => $request->orderhenkan_datachar10_information1 ?? null,
                        
                        // 106 end customers
                       // 'datachar11' => $request->end_customer ?? null,
                        'datachar11' => $request->orderhenkan_datachar10_information3 ?? null,
                        
                        // blank field
                        //'intorder01' => '',
                        //'intorder02' => '',
                        //'datachar04' => '',
                        //'datachar05' => '',
                        //'datachar06' => '',
                        //'datachar07' => '',
                        
                        // 209 : old spec
                        // 'datatxt0147' => $request->order_shipping_remarks_209 ?? null,

                        // 210: new spec
                        'datatxt0147' => $request->order_summary_remarks ?? null,

                        // 201 : deletedate
                        'deletedate' => $request->datepicker6_oen ?? null,
                        
                        // 202 : first visit date
                        'date0012' => $request->datepicker7_oen ?? null,
                        
                        // 203
                        'datachar12' => $request->consultation_person_name ?? null,
                        
                        // 206
                        // orderhenkan.datachar13 = 206 = tuhanorder.juchukubun1 = business name
                        'datachar13' => $request->juchukubun1_business_name ?? null,
                        
                        // 205 model name
                        'datachar14' => $request->model_name ?? null,
                        
                        // 207 os
                        'datachar15' => $request->os ?? null,
                        
                        // 211 basic design completed
                        'date0013' => $request->datepicker8_oen ?? null,
                        
                        // 212 setup start
                        'date0014' => $request->datepicker9_oen ?? null,
                        
                        // 213 production start
                        'date0015' => $request->datepicker10_oen ?? null,
                        
                        // 215 acceptance condition
                        'datatxt0148' => $request->acceptance_condition ?? null,
                        'datatxt0149' => $request->datatxt0004_216 ?? null,
                       // 'datatxt0150' => $filename ?? null,
                        
                        // blank
                       //  'datatxt0151' => '',
                        
                        // 2(not)
                        'intorder03' => 2,
                        
                        // blank
                        // 'datatxt0152' => '',
                        
                        //blank
                       // 'synchroorderbango' => 0,
                       
                        // blank
                       // 'date0018' => '',
                       
                        // blank
                       // 'date0019' => '',
                       
                        // blank
                       // 'datatxt0144' => '',
                       
                        // blank
                       // 'datatxt0154' => '',
                       
                        // ”0”(有効)
                        'synchroorderbango2' => 0,
                       
                        // system date time
                        //'date0016' => static::getCurrentTime(),
                        'date0016' => Carbon::now()->format('Y-m-d H:i:s'),
                       
                        // blank
                       // 'date0017' => '',
                       
                        // ログイン社員CD : $bango
                        'datatxt0155' => $bango ?? null,
                       
                        // blank
                        // 'datatxt0156' => '',
                       
                        // 204
                        'datatxt0157' => $request->include_place ?? null,
                       
                        // 202-A
                        'date0020' => $request->datepicker11_oen ?? null
                ];

               $orderhenkan_result = QueryHelper::insertData('orderhenkan', $orderhenkan_insertable_data, 'bango', true, $bango, __CLASS__, __FUNCTION__, __LINE__);




              
               if($orderhenkan_result){

                   //============== L-Book reg start here ==================//

                    //update review data

                    /*$fiscal_year = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7501' ")->orderbango ?? null;

                    $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7301'");



                    if ($reviewData) {
                        $modified_orderbango = '03' . $fiscal_year . $reviewData->orderbango + 1;
                        //$modified_orderbango = '03' . $fiscal_year . $reviewData->orderbango + 1;
                       // $modified_orderbango = "03".$fiscal_year.str_pad($reviewData->orderbango + 1,$reviewData->mobile_flag,'0',STR_PAD_LEFT );
                    }*/


                    $lbook_orderInfo = self::getOrderBangoForLbook();
                    $lbook_kokyakuorderbango = $lbook_orderInfo['kokyakuorderbango'];
                    $lbook_review_orderbango = $lbook_orderInfo['review_orderbango'];


                    if ($file != "" || $request->proposal_file != "") {
                     if ($file != "") {
                           \File::copy(public_path('uploads/support_entry/') . $filename, public_path('uploads/lbook/') . $filename);


                           // SOUKONYUKO INSERTION
                            $soukonyuko_insert_data = [
                                'orderbango' => $orderhenkan_result->bango,
                                'datachar01' => $lbook_kokyakuorderbango,
                                //'datachar02' => $request->contractor ?? null,
                                'datachar02' => $request->tuhanorder_information1 ?? null,
                                'datachar03' => $request->tuhanorder_information2 ?? null,
                               // 'datachar04' => $request->end_customer ?? null,
                                'datachar04' => $request->tuhanorder_information3 ?? null,
                                'datachar05' => $request->order_number ?? null,
                                'datachar06' => $orderhenkan_result->datachar05,
                                'datachar07' => 'H130',
                                'datachar08' => $orderhenkan_result->tuhanorder_juchukubun1_orders_subject ?? null,
                                'datachar09' => $filename,
                                'datachar10' => 'H910',
                                'dataint25' => 0,
                                'datachar11' => Carbon::now()->format('Y-m-d H:i:s'),
                                'datachar12' => null,
                                'datachar13' => $bango,
                            ];

                            $soukonyuko = QueryHelper::insertData('soukonyuko', $soukonyuko_insert_data, 'datachar01', true, $bango, __CLASS__, __FUNCTION__, __LINE__);


                            
                            // REVIEW UPDATE
                            $review_update_data = [
                                'kokyakusyouhinbango' => 'D7301',
                                'orderbango' => $lbook_review_orderbango,
                                'check_flag' => 0,
                                'color' => static::getCurrentTime(),
                                'size' => Helper::getSystemIP(),
                                'nickname' => $bango,
                            ];
                            QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);


                           
                            // TUHANORDER
                            // $tuhanorder_update_data = [
                            //     'information2' => $request->tuhanorder_information2 ?? null,
                            //     'information3' => $request->tuhanorder_information3 ?? null,
                            //     'juchukubun1' => $orderhenkan_result->tuhanorder_juchukubun1_orders_subject ?? null,
                            // ];

                             // QueryHelper::updateData('tuhanorder', $tuhanorder_update_data, ['juchubango' => $kokyakuorderbango,'orderbango'=>$orderhenkan_result->bango], $bango, __CLASS__, __FUNCTION__, __LINE__);

                             //QueryHelper::updateData('tuhanorder', $tuhanorder_update_data, ['juchubango' => $request->number_search], $bango, __CLASS__, __FUNCTION__, __LINE__);

                            //update orderhenkan data
                            $orderhenkan_update_data = [
                                //'kokyakuorderbango' => $orderHenkan->kokyakuorderbango,
                                'bango' => $orderhenkan_result->bango,
                                // 'datachar05' => $bango,
                                'datatxt0150' => $lbook_kokyakuorderbango
                            ];

                            QueryHelper::updateData('orderhenkan', $orderhenkan_update_data, 'bango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                        }
                    
                    //============== L-Book reg end here ==================//
                        }

                        // REVIEW UPDATE
                        $review_update_data = [
                            'kokyakusyouhinbango' => 'D7012',
                            'orderbango' => $review_orderbango,
                            'check_flag' => 0,
                            'color' => static::getCurrentTime(),
                            'size' => Helper::getSystemIP(),
                            'nickname' => $bango,
                        ];
                        QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                    }

                     


        

               // start hikiatenyuko table
                $hikiatenyuko_insertable_data = [
                    'orderbango' => $orderhenkan_result->bango,
                    'syouhinid' => $kokyakuorderbango ?? null,
                    'syouhinsyu' => 2,
                    'hantei' => null,
                    'dataint01' => null,
                    'dataint02' => null,
                    'dataint03' => 2,
                    'dataint04' => 2,
                    'dataint05' => 2,
                    'dataint06' => 2,
                    'dataint07' => 2,
                    'dataint08' => null,
                    'dataint09' => null,
                    'datachar02' => null,
                    'datachar03' => null,
                    'datachar04' => null,
                    'datachar05' => null,
                    'yoteimeter' => 0,
                    'denpyoshimebi' => null,
                    'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'),
                    'tantousyabango' => $bango
                ];

               $hikiatenyuko_result = QueryHelper::insertData('hikiatenyuko', $hikiatenyuko_insertable_data, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);




              
              
                /* minyukko table writting process algorithm
                 | data extract from misyukko for minukko requirement
                 |-------------------------------------------------------------------
                 | @Todo 2022-01-11
                 | get only one record where syouhinsyu = 1
                 | 
                 | @Todo 2022-02-01  
                 | get all record. and remove syouhinsyu = 1 and limit = 1
                 |
                 */

                $misyukko_line_data = DB::table("misyukko")
                                                ->select("*")
                                                ->where("syouhinid", "=", $request->number_search)
                                                ->where("dataint05", ">", 0)
                                                ->where("datachar13", "=", '1')
                                                // ->where("syouhinsyu", "=", '1')
                                                ->where(DB::raw("substring(datachar22, 1, 1)"), '=', 0)
                                                ->where("yoteimeter", "=", '0')
                                                // ->limit(1)
                                                ->get();

                $misyukko_line_data_length = count($misyukko_line_data);



                if($misyukko_line_data_length > 0){
                    $minyukko_order_number = 1;
                    for($i = 0; $i < $misyukko_line_data_length; $i++){
                        $dataint10_date =  $misyukko_line_data[$i]->dataint10;
                        $dataint10_date =  substr($dataint10_date,0, 4) . '-' . substr($dataint10_date,4, 2) . '-'. substr($dataint10_date,6, 2);

                        
                        $minyuko_insertable_data = [
                            'orderbango' => $orderhenkan_result->bango,
                            // 発注「HC0001発注番号」=> orderbango.kokyakuorderbango = order number
                            'syouhinid' => $kokyakuorderbango ?? null,
                            // 発注番号単位に001から連番で採番
                            'syouhinsyu' => $minyukko_order_number,
                            // ”000”固定
                            'hantei' => '000',
                            // ”0”固定
                            'zaikometer' => 0,
                            // 受注明細「JM0001受注番号」=> misyukko.syouhinid = orderhenkan.kokyakuorderbango
                            'idoutanabango' => $misyukko_line_data[$i]->syouhinid,
                            // 受注明細「JM0002受注行番号
                            'yoteimeter' => $misyukko_line_data[$i]->syouhinsyu ?? null,
                            // 受注明細「JM0003受注行番号枝番」=> 
                            'nyukometer' => $misyukko_line_data[$i]->hantei ?? null,
                            // ”V120”(SE)固定
                            'datachar01' => 'V120',
                            // 受注明細「JM0025個別納期」
                            'yoteibi' => $dataint10_date ?? null,
                            // 受注明細「JM0026納品先CD」
                            'kaiinid' => $misyukko_line_data[$i]->datachar06 ?? null,
                            // 受注明細「JM0008商品CD」
                            // 'datachar02' => $misyukko_line_data[$i]->syouhinname ?? null,
                            // @20211201
                            'datachar02' => $misyukko_line_data[$i]->kawasename ?? null,
                            // 受注明細「JM0009商品名」
                            // @20211201
                           // 'datachar03' => $misyukko_line_data[$i]->datachar14 ?? null,
                            'datachar03' => $misyukko_line_data[$i]->syouhinname ?? null,
                            // 受注明細「JM0009商品サブ区分」
                            'dataint20' => $misyukko_line_data[$i]->datachar14 ?? null,
                            // 受注明細「JM0010商品サブＣＤ」
                            'datachar04' => $misyukko_line_data[$i]->barcode ?? null,
                            // 受注明細「JM0011商品サブ名称」
                            'datachar05' => $misyukko_line_data[$i]->barcode ?? null,
                            // 受注明細「JM0012数量」
                            'nyukosu' => $misyukko_line_data[$i]->syukkasu ?? null,
                            'datachar06' => $misyukko_line_data[$i]->codename ?? null,
                            // 受注明細「JM0015仕切（SE）単価」
                            'kingaku' => $misyukko_line_data[$i]->dataint05 ?? null,
                            // 受注明細「JM0015仕切（SE）単価」
                            'genka' => $misyukko_line_data[$i]->dataint05 ?? null,
                            // 発注数量×発注単価 = minyuko.nyukosu x minyuko.genka
                            'syouhizeiritu' => ($misyukko_line_data[$i]->syukkasu * $misyukko_line_data[$i]->dataint05) ?? null,
                            // 受注明細「JM0021メーカー品番」
                            'datachar07' => $misyukko_line_data[$i]->datachar03 ?? null,
                            // 受注明細「JM0022メーカー品名」
                            'datachar08' => $misyukko_line_data[$i]->datachar04 ?? null,
                            // 画面「209発注出荷備考」
                            'datachar09' => $request->order_shipping_remarks_209 ?? null,
                            // 受注明細「JM0029納品方法」
                            'datachar10' => $misyukko_line_data[$i]->datachar09 ?? null,
                            // 画面「208社内備考」
                            'datachar11' => $request->information7_in_house_remarks ?? null,
                            // 受注明細 MIN(「JM0020SE粗利担当」
                            'datachar13' => $misyukko_line_data[$i]->datachar02 ?? null,
                            // ”0”(有効)
                            'denpyobango' => 0,
                            // 登録実行時のSYSTEM-DATE
                            'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'),
                            // // ログイン社員CD
                            'tantousyabango' => $bango,
                            // 受注「JU0029請求課税区分」
                            'datachar18' => $request->tuhanorder_otodoketime_ju0029 ?? null,
                            // 発注金額×税率
                            // (支払課税区分より、共通仕様C21を用いて算出)
                            // 端数処理はHJ0064支払税端数区分にて行う
                            // Tax calculation
                            // HS0021 x HS0048
                            // minyuko.syouhizeiritu x $request->tuhanorder_otodoketime_ju0029
                             'soukobango' => SupportEntry::calculateTaxRateForAdjustment($orderhenkan_result->datachar10, $request->tuhanorder_otodoketime_ju0029, $bango, ($misyukko_line_data[$i]->syukkasu * $misyukko_line_data[$i]->dataint05)) ?? null
                        ];

                        $minyukko_order_number++;
                       
                        $minuko_result = QueryHelper::insertData('minyuko', $minyuko_insertable_data, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                   }
                }

            
                // var_dump($orderhenkan_result);
                // echo "<br> misyuko";
                // var_dump($misyukko_line_data);
                // echo "minyuko";
                // var_dump($minuko_result);


                // $misyukko_line_data = DB::table("misyukko")
                //                                 ->select("*")
                //                                 ->where("syouhinid", "=", $request->number_search)
                //                                 ->where("dataint05", ">", 0)
                //                                 ->where("datachar13", "=", '1')
                //                                 ->where(DB::raw("substring(datachar22, 1, 1)"), '=', 0)
                //                                 ->where("yoteimeter", "=", '0')
                //                                 ->get();

                // $misyukko_line_data_length = count($misyukko_line_data);

                // juchusyukko2
                if($misyukko_line_data_length > 0){
                        $HS0001 = 1;
                    for($i = 0; $i < $misyukko_line_data_length; $i++){
                        $juchusyukko2_insertable_data = [
                            'orderbango' => $orderhenkan_result->bango,
                            // 発注明細「HS0001発注番号」
                            'syouhinid' => $kokyakuorderbango,
                            // 発注明細「HS0002発注行番号」
                            'syouhinsyu' => $HS0001,
                            // 発注明細「HS0003発注行番号枝番」
                            'hantei' => '000',
                            // ”1”(未処理)
                            'season' => 1,
                            // ”0”(有効)
                            'yoteimeter' => 0,
                            // 登録実行時のSYSTEM-DATE
                            'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'),
                            // ログイン社員CD
                            'tantousyabango' => $bango,
                            // ”2”(未)
                            'day' => 2,
                            // ”2”(未)
                            'tanka' => 2,
                        ];  

                        $HS0001++;

                        $juchusyukko2_result = QueryHelper::insertData('juchusyukko2', $juchusyukko2_insertable_data, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);      
                    }
                }
                


                // misyukko

                DB::table('misyukko')
                        ->where("syouhinid", "=", $request->number_search)
                        ->where("dataint05", ">", 0)
                        ->where("datachar13", "=", '1')
                        ->where("yoteimeter", "=", 0)
                        ->update(['datachar22' => DB::raw("concat(1, substring(datachar22, 2, 4))")]);


                //inserting in rreriki
                CreateHatchuDetails::data($bango,$kokyakuorderbango, 0,1,'05-06');

                // commit
                $result['status'] = 'ok';
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### support_entry end\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "COMMIT");

                // successfull msg
                session()->flash('success_msg', "発注番号 " . $kokyakuorderbango . " で登録しました");
                $result['success_msg'] = "発注番号 " . $kokyakuorderbango . " で登録しました";

            }catch (\Exception $e) {
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "ROLLBACK");
                session()->flash('success_msg', "something" . $kokyakuorderbango . "went wrong");
                $result['status'] = 'ng';
                $result['error_msg'] = "something" . $kokyakuorderbango . "went wrong";
                $result['exception'] = $e->getMessage();
            }
        }

        return $result;
    }


    // update
    public static function update($request, $bango, $file){
       // echo "val : " . $request->$orderhenkan_ordertypebango2_maxval;
        
      //=  dd($request->all());
        // $kokyakuorderbango = '0351000153';
        // $orderhenkan_orderuserbango = '0151014552';

        //  $orderhenkan_edit_data_result = DB::table("orderhenkan")
        //                                         ->select("*")
        //                                         ->whereIn('intorder04', ['1','2'])
        //                                         ->where("datachar02", "=", 'V413')
        //                                         ->where("kokyakuorderbango", "=", $kokyakuorderbango)
        //                                         ->where("orderuserbango", "=", $orderhenkan_orderuserbango)
        //                                         ->where("synchroorderbango2", "=", '0')
        //                                         ->get();

        //         var_dump($orderhenkan_edit_data_result);


        // $result['status'] = 'ok';
        // $result['success_msg'] = "受注番号 059886454 で登録しました";
        // return $result;
        $validator = SupportEntryCreateValidation::handle(request()->all());


        $errors = $validator->errors();
        if ($errors->any()) {
            return $errors;
        }elseif(!$errors->any() && $request->submit_confirmation == ""){
            $result["status"] = "confirm";
            return $result;
        }else if (!$errors->any()) {
            // log
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### support_entry start\n";
            QueryHandler::logger($bango, $log_data);
            
            // connection for pg_query
            $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));

            pg_query($conn, "BEGIN");



    
            // support number
            $kokyakuorderbango = $request->number_search;
            $orderhenkan_orderuserbango = $request->order_number;

            try{

                if (!file_exists('uploads')) {
                    mkdir('uploads', 0777, true);
                }

                if (!file_exists('uploads/support_entry')) {
                    mkdir('uploads/support_entry', 0777, true);
                }

                if (!file_exists('uploads/lbook/')) {
                    mkdir('uploads/lbook/', 0777, true);
                }

                if ($file != "" || $request->proposal_file != "") {
                    if ($file != "") {
                        $filenameWithExtension = $file->getClientOriginalName();
                        $fileExtension = '.' . $file->getClientOriginalExtension();
                        $filename = explode($fileExtension, $filenameWithExtension);
                        $filename = $filename[0] . '¶' . $kokyakuorderbango . '_' . static::getCurrentTime() . $fileExtension;

                        $file->move(public_path('uploads/support_entry'), $filename);
                      //  $file->move(public_path('uploads/lbook'), $filename);
                    } else {
                        $filename = $request->proposal_file;
                    }
                }else{
                    if($request->lbook_file_input){
                        $filename = $request->lbook_file_input;
                    }else{
                        $filename = $request->proposal_file;
                    }
                } // . end batch upload 
                // .end orderhenkan insertion
                



               
                // start orderHenkan transaction
                $orderhenkan_insertable_data = [
                        // number search => order number
                         'kokyakuorderbango' => $kokyakuorderbango ?? null,

                        // 0 fixed
                        'ordertypebango2' => ($request->orderhenkan_ordertypebango2_maxval) + 1,
                        
                        // 104
                        'orderuserbango' => $request->order_number ?? null,
                        
                        // empty field
                        //'datachar01' => '',
                        
                        // 13 (support)
                         'datachar02' => 'V413',
                        
                        // 1 new
                        // old spec kokyakubango 
                        // new spec intorder04
                       // 'kokyakubango' => 1,

                         'intorder04' => 2,
                         
                        // empty field
                        //'kokyakubango' => '',
                        
                        // TODAY date
                        'date' => Carbon::now()->format('Y-m-d H:i:s'),
                        
                        // JU0008
                       // 'datachar09' => '受注「JU0008受注担当者」',
                        'datachar09' => $request->datachar05_ju0008,
                        
                        // 105 contractor
                       // 'datachar10' => $request->contractor ?? null,
                        'datachar10' => $request->orderhenkan_datachar10_information1 ?? null,
                        
                        // 106 end customers
                       // 'datachar11' => $request->end_customer ?? null,
                        'datachar11' => $request->orderhenkan_datachar10_information3 ?? null,
                        
                        // blank field
                        //'intorder01' => '',
                        //'intorder02' => '',
                        //'datachar04' => '',
                        //'datachar05' => '',
                        //'datachar06' => '',
                        //'datachar07' => '',
                        
                        // 209 : old spec
                        // 'datatxt0147' => $request->order_shipping_remarks_209 ?? null,

                        // 210: new spec
                        'datatxt0147' => $request->order_summary_remarks ?? null,

                        // 201 : deletedate
                        'deletedate' => $request->datepicker6_oen ?? null,
                        
                        // 202 : first visit date
                        'date0012' => $request->datepicker7_oen ?? null,
                        
                        // 203
                        'datachar12' => $request->consultation_person_name ?? null,
                        
                        // 206
                        // orderhenkan.datachar13 = 206 = tuhanorder.juchukubun1 = business name
                        'datachar13' => $request->juchukubun1_business_name ?? null,
                        
                        // 205 model name
                        'datachar14' => $request->model_name ?? null,
                        
                        // 207 os
                        'datachar15' => $request->os ?? null,
                        
                        // 211 basic design completed
                        'date0013' => $request->datepicker8_oen ?? null,
                        
                        // 212 setup start
                        'date0014' => $request->datepicker9_oen ?? null,
                        
                        // 213 production start
                        'date0015' => $request->datepicker10_oen ?? null,
                        
                        // 215 acceptance condition
                        'datatxt0148' => $request->acceptance_condition ?? null,
                        'datatxt0149' => $request->datatxt0004_216 ?? null,
                        // this field is depend on lbook, if value present. if no pdf, value = null
                       // 'datatxt0150' => $filename ?? null,
                        // datatxt0150 = $request->hidden_lbook_kokyakuorderbango;
                        // if pdf upload, update with new lbook_kokyakuorderbango in lbook registration
                       // 'datatxt0150' => $request->hidden_lbook_kokyakuorderbango ?? null,
                        
                        // blank
                       //  'datatxt0151' => '',
                        
                        // 2(not)
                        'intorder03' => 2,
                        
                        // blank
                        // 'datatxt0152' => '',
                        
                        //blank
                       // 'synchroorderbango' => 0,
                       
                        // blank
                       // 'date0018' => '',
                       
                        // blank
                       // 'date0019' => '',
                       
                        // blank
                       // 'datatxt0144' => '',
                       
                        // blank
                       // 'datatxt0154' => '',
                       
                        // ”0”(有効)
                        'synchroorderbango2' => 0,
                       
                        // system date time
                        //'date0016' => static::getCurrentTime(),
                        'date0016' => $request->hidden_orderhenkan_date0016,
                       
                        // blank
                        'date0017' => Carbon::now()->format('Y-m-d H:i:s'),
                       
                        // ログイン社員CD : $bango
                        'datatxt0155' => $bango ?? null,
                       
                        // blank
                        // 'datatxt0156' => '',
                       
                        // 204
                        'datatxt0157' => $request->include_place ?? null,
                       
                        // 202-A
                        'date0020' => $request->datepicker11_oen ?? null
                ];

               $orderhenkan_result = QueryHelper::insertData('orderhenkan', $orderhenkan_insertable_data, 'bango', true, $bango, __CLASS__, __FUNCTION__, __LINE__);




              

               if($orderhenkan_result){


                     //============== L-Book reg start here ==================//
                    //update review data

                    /*$fiscal_year = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7501' ")->orderbango ?? null;

                    $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7301'");



                    if ($reviewData) {
                        $modified_orderbango = '03' . $fiscal_year . $reviewData->orderbango + 1;
                        //$modified_orderbango = '03' . $fiscal_year . $reviewData->orderbango + 1;
                       // $modified_orderbango = "03".$fiscal_year.str_pad($reviewData->orderbango + 1,$reviewData->mobile_flag,'0',STR_PAD_LEFT );
                    }*/


                    $lbook_orderInfo = self::getOrderBangoForLbook();
                    $lbook_kokyakuorderbango = $lbook_orderInfo['kokyakuorderbango'];
                    $lbook_review_orderbango = $lbook_orderInfo['review_orderbango'];


                    if ($file != "" || $request->proposal_file != "") {
                     if ($file != "") {
                    
                             // SOUKONYUKO INSERTION
                            $soukonyuko_insert_data = [
                                'orderbango' => $orderhenkan_result->bango,
                                'datachar01' => $lbook_kokyakuorderbango,
                               // 'datachar02' => $request->contractor ?? null,
                                'datachar02' => $request->tuhanorder_information1 ?? null,
                                'datachar03' => $request->tuhanorder_information2 ?? null,
                               // 'datachar04' => $request->end_customer ?? null,
                                'datachar04' => $request->tuhanorder_information3 ?? null,
                                'datachar05' => $request->order_number ?? null,
                                'datachar06' => $orderhenkan_result->datachar05,
                                'datachar07' => 'H130',
                                'datachar08' => $orderhenkan_result->tuhanorder_juchukubun1_orders_subject ?? null,
                                'datachar09' => $filename,
                                'datachar10' => 'H910',
                                'dataint25' => 0,
                                'datachar11' => Carbon::now()->format('Y-m-d H:i:s'),
                                'datachar12' => null,
                                'datachar13' => $bango,
                            ];

                            $soukonyuko = QueryHelper::insertData('soukonyuko', $soukonyuko_insert_data, 'datachar01', true, $bango, __CLASS__, __FUNCTION__, __LINE__);

                            if ($soukonyuko) {
                                \File::copy(public_path('uploads/support_entry/') . $filename, public_path('uploads/lbook/') . $filename);
                            }


                             //update orderhenkan data
                            $orderhenkan_update_data = [
                                //'kokyakuorderbango' => $orderHenkan->kokyakuorderbango,
                                'bango' => $orderhenkan_result->bango,
                                // 'datachar05' => $bango,
                                'datatxt0150' => $lbook_kokyakuorderbango
                            ];

                            QueryHelper::updateData('orderhenkan', $orderhenkan_update_data, 'bango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                            

                            // REVIEW UPDATE
                            $review_update_data = [
                                'kokyakusyouhinbango' => 'D7301',
                                'orderbango' => $lbook_review_orderbango,
                                'check_flag' => 0,
                                'color' => static::getCurrentTime(),
                                'size' => Helper::getSystemIP(),
                                'nickname' => $bango,
                            ];
                            QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);


                            // REVIEW UPDATE
                          /*  $review_update_data = [
                                'kokyakusyouhinbango' => 'D7012',
                                'orderbango' => $lbook_review_orderbango,
                                'check_flag' => 0,
                                'color' => static::getCurrentTime(),
                                'size' => Helper::getSystemIP(),
                                'nickname' => $bango,
                            ];
                            QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);*/

                         }

                        }
                    }

            //============== L-Book reg end here ==================//


        
         /*   $hikiatenyuko_previous_data = DB::table("hikiatenyuko")
                                                ->select("*")
                                                ->where("orderbango", "=", $request->orderhenkan_bango)
                                                ->get();

               // start hikiatenyuko table
                $hikiatenyuko_updatable_data = [
                    // orderhenkan.bango
                    'orderbango' => $orderhenkan_result->bango,
                    'syouhinid' => $kokyakuorderbango ?? null,
                    'syouhinsyu' => 2,
                    'hantei' => null,
                    'dataint01' => null,
                    'dataint02' => null,
                    'dataint03' => 2,
                    'dataint04' => 2,
                    'dataint05' => 2,
                    'dataint06' => 2,
                    'dataint07' => 2,
                    'dataint08' => null,
                    'dataint09' => null,
                    'datachar02' => null,
                    'datachar03' => null,
                    'datachar04' => null,
                    'datachar05' => null,
                    'yoteimeter' => 0,
                  //  'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'),
                    'denpyohakkoubi' => $hikiatenyuko_previous_data[0]->denpyohakkoubi,
                    'denpyoshimebi' => Carbon::now()->format('Y-m-d H:i:s'),
                    'tantousyabango' => $bango
                ];

               $hikiatenyuko_result = QueryHelper::updateData('hikiatenyuko', $hikiatenyuko_updatable_data, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);*/

                DB::table('hikiatenyuko')
                        ->where("syouhinid", "=", $kokyakuorderbango)
                        ->update(['orderbango' => $orderhenkan_result->bango,
                                  'dataint03' => '2', 
                                  'dataint04' => '2', 
                                  'dataint06' => '2', 
                                  'denpyoshimebi' => Carbon::now()->format('Y-m-d H:i:s')
                              ]);
                


                /*
                * USAC002-213
                * @2022/02/07
                * ---------------------------------------------------------------------
                * write misyuko, juchusyukko2 data for new commer to minyuko. Because after order entry edit, * misyuko data product increase or decrease. It is new requirement.
                * ----------------------------------------------------------------------
                * Solution : same as insertion process, insert misyuko to minyuko and minyuko.zaikometer = 1.
                * If any data in misyuko, then edit from order entry page. otherwise entry from minyuko
                */
                $misyukko_line_data = DB::table("misyukko")
                                            ->select("*")
                                            ->where("syouhinid", "=", $request->order_number)
                                            ->where("dataint05", ">", 0)
                                            ->where("datachar13", "=", '1')
                                            ->where(DB::raw("substring(datachar22, 1, 1)"), '=', 0)
                                            ->where("yoteimeter", "=", '0')
                                            ->get();

                $misyukko_line_data_length = count($misyukko_line_data);



                if($misyukko_line_data_length > 0){
                    // get the zaikometer value from minyuko
                    $zaikometerCalculation = DB::table("minyuko")
                                                ->select("*")
                                                ->where("orderbango", "=", $request->orderhenkan_bango)
                                                ->limit(1)
                                                ->get();

                    if(count($zaikometerCalculation) > 0){
                        $zaikometerCalculation = $zaikometerCalculation[0]->zaikometer + 1;
                    }else{
                        $zaikometerCalculation = 0;
                    }

                    // ./ end zaikometer calculation

                    $minyukko_order_number = 1;
                    for($i = 0; $i < $misyukko_line_data_length; $i++){
                        $dataint10_date =  $misyukko_line_data[$i]->dataint10;
                        $dataint10_date =  substr($dataint10_date,0, 4) . '-' . substr($dataint10_date,4, 2) . '-'. substr($dataint10_date,6, 2);

                        
                        $minyuko_insertable_data = [
                            'orderbango' => $orderhenkan_result->bango,
                            // 発注「HC0001発注番号」=> orderbango.kokyakuorderbango = order number = $request->number_search
                            'syouhinid' => $request->number_search ?? null,
                            // 発注番号単位に001から連番で採番
                            'syouhinsyu' => $minyukko_order_number,
                            // ”000”固定
                            'hantei' => '000',
                            // ”0”固定
                            // 1 in update time. 0 for insertion time.
                            'zaikometer' => $zaikometerCalculation, 

                            // 受注明細「JM0001受注番号」=> misyukko.syouhinid = orderhenkan.kokyakuorderbango
                            'idoutanabango' => $misyukko_line_data[$i]->syouhinid,
                            // 受注明細「JM0002受注行番号
                            'yoteimeter' => $misyukko_line_data[$i]->syouhinsyu ?? null,
                            // 受注明細「JM0003受注行番号枝番」=> 
                            'nyukometer' => $misyukko_line_data[$i]->hantei ?? null,
                            // ”V120”(SE)固定
                            'datachar01' => 'V120',
                            // 受注明細「JM0025個別納期」
                            'yoteibi' => $dataint10_date ?? null,
                            // 受注明細「JM0026納品先CD」
                            'kaiinid' => $misyukko_line_data[$i]->datachar06 ?? null,
                            // 受注明細「JM0008商品CD」
                            // 'datachar02' => $misyukko_line_data[$i]->syouhinname ?? null,
                            // @20211201
                            'datachar02' => $misyukko_line_data[$i]->kawasename ?? null,
                            // 受注明細「JM0009商品名」
                            // @20211201
                           // 'datachar03' => $misyukko_line_data[$i]->datachar14 ?? null,
                            'datachar03' => $misyukko_line_data[$i]->syouhinname ?? null,
                            // 受注明細「JM0009商品サブ区分」
                            'dataint20' => $misyukko_line_data[$i]->datachar14 ?? null,
                            // 受注明細「JM0010商品サブＣＤ」
                            'datachar04' => $misyukko_line_data[$i]->barcode ?? null,
                            // 受注明細「JM0011商品サブ名称」
                            'datachar05' => $misyukko_line_data[$i]->barcode ?? null,
                            // 受注明細「JM0012数量」
                            'nyukosu' => $misyukko_line_data[$i]->syukkasu ?? null,
                            'datachar06' => $misyukko_line_data[$i]->codename ?? null,
                            // 受注明細「JM0015仕切（SE）単価」
                            'kingaku' => $misyukko_line_data[$i]->dataint05 ?? null,
                            // 受注明細「JM0015仕切（SE）単価」
                            'genka' => $misyukko_line_data[$i]->dataint05 ?? null,
                            // 発注数量×発注単価 = minyuko.nyukosu x minyuko.genka
                            'syouhizeiritu' => ($misyukko_line_data[$i]->syukkasu * $misyukko_line_data[$i]->dataint05) ?? null,
                            // 受注明細「JM0021メーカー品番」
                            'datachar07' => $misyukko_line_data[$i]->datachar03 ?? null,
                            // 受注明細「JM0022メーカー品名」
                            'datachar08' => $misyukko_line_data[$i]->datachar04 ?? null,
                            // 画面「209発注出荷備考」
                            'datachar09' => $request->order_shipping_remarks_209 ?? null,
                            // 受注明細「JM0029納品方法」
                            'datachar10' => $misyukko_line_data[$i]->datachar09 ?? null,
                            // 画面「208社内備考」
                            'datachar11' => $request->information7_in_house_remarks ?? null,
                            // 受注明細 MIN(「JM0020SE粗利担当」
                            'datachar13' => $misyukko_line_data[$i]->datachar02 ?? null,
                            // ”0”(有効)
                            'denpyobango' => 0,
                            // 登録実行時のSYSTEM-DATE
                            'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'),
                            // // ログイン社員CD
                            'tantousyabango' => $bango,
                            // 受注「JU0029請求課税区分」
                            'datachar18' => $request->tuhanorder_otodoketime_ju0029 ?? null,
                            // 発注金額×税率
                            // (支払課税区分より、共通仕様C21を用いて算出)
                            // 端数処理はHJ0064支払税端数区分にて行う
                            // Tax calculation
                            // HS0021 x HS0048
                            // minyuko.syouhizeiritu x $request->tuhanorder_otodoketime_ju0029
                             'soukobango' => SupportEntry::calculateTaxRateForAdjustment($request->orderhenkan_datachar10_information1, $request->tuhanorder_otodoketime_ju0029, $bango, ($misyukko_line_data[$i]->syukkasu * $misyukko_line_data[$i]->dataint05)) ?? null
                        ];

                        $minyukko_order_number++;
                       
                        $minuko_result = QueryHelper::insertData('minyuko', $minyuko_insertable_data, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                   }
                }

                // juchusyukko2
                if($misyukko_line_data_length > 0){
                        $HS0001 = 1;
                    for($i = 0; $i < $misyukko_line_data_length; $i++){
                        $juchusyukko2_insertable_data = [
                            'orderbango' => $orderhenkan_result->bango,
                            // 発注明細「HS0001発注番号」
                            'syouhinid' => $request->number_search,
                            // 発注明細「HS0002発注行番号」
                            'syouhinsyu' => $HS0001,
                            // 発注明細「HS0003発注行番号枝番」
                            'hantei' => '000', // same as minyuko.hantei
                            // ”1”(未処理)
                            'season' => 1,
                            // ”0”(有効)
                            'yoteimeter' => 0,
                            // 登録実行時のSYSTEM-DATE
                            'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'),
                            // ログイン社員CD
                            'tantousyabango' => $bango,
                            // ”2”(未)
                            'day' => 2,
                            // ”2”(未)
                            'tanka' => 2,
                        ];  

                        $HS0001++;

                        $juchusyukko2_result = QueryHelper::insertData('juchusyukko2', $juchusyukko2_insertable_data, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);      
                    }
                }


                // Update the misyuko table if data exist
                if($misyukko_line_data_length > 0){
                    // misyukko
                    DB::table('misyukko')
                            ->where("syouhinid", "=", $request->order_number)
                            ->where("dataint05", ">", 0)
                            ->where("datachar13", "=", '1')
                            ->where("yoteimeter", "=", 0)
                            ->update(['datachar22' => DB::raw("concat(1, substring(datachar22, 2, 4))")]);
                }
                // ./  USAC002-213



                
                // minyukko
                // data extract from misyukko for minukko requirement
                // $misyukko_line_data_length == 0 means no data in misyuko table found. So no edit from order entry page. So, update from minyuko table
                if($misyukko_line_data_length == 0){
                    $minyukko_line_data = DB::table("minyuko")
                                                    ->select("*")
                                                    ->where("orderbango", "=", $request->orderhenkan_bango)
                                                    ->get();

                    $minyukko_line_data_length = count($minyukko_line_data);



                    if($minyukko_line_data_length > 0){
                        $minyukko_order_number = 1;
                        for($i = 0; $i < $minyukko_line_data_length; $i++){
                            $dataint10_date =  $minyukko_line_data[$i]->dataint10;
                            // $dataint10_date =  substr($dataint10_date,0, 4) . '-' . substr($dataint10_date,4, 2) . '-'. substr($dataint10_date,6, 2);
                           
                            $minyuko_insertable_data = [
                                'orderbango' => $orderhenkan_result->bango,
                                // 発注「HC0001発注番号」=> orderbango.kokyakuorderbango = order number
                                'syouhinid' => $kokyakuorderbango ?? null,
                                // 発注番号単位に001から連番で採番
                                //'syouhinsyu' => $minyukko_order_number,
                                'syouhinsyu' => $minyukko_line_data[$i]->syouhinsyu,
                                // ”000”固定
                                // 'hantei' => '000',
                                'hantei' => $minyukko_line_data[$i]->hantei,
                                // ”0”固定
                                'zaikometer' =>  ($minyukko_line_data[$i]->zaikometer) + 1,
                                // 受注明細「JM0001受注番号」=> misyukko.syouhinid = orderhenkan.kokyakuorderbango
                                // 'idoutanabango' => $kokyakuorderbango,
                                'idoutanabango' => $minyukko_line_data[$i]->idoutanabango,
                                // 受注明細「JM0002受注行番号
                                'yoteimeter' => $minyukko_line_data[$i]->yoteimeter ?? null,
                                // 受注明細「JM0003受注行番号枝番」=> 
                                'nyukometer' => $minyukko_line_data[$i]->nyukometer ?? null,
                                // ”V120”(SE)固定
                                'datachar01' => 'V120',
                                // 受注明細「JM0025個別納期」
                               // 'yoteibi' => $dataint10_date ?? null,
                                'yoteibi' => $minyukko_line_data[$i]->yoteibi ?? null,
                                // 受注明細「JM0026納品先CD」
                                'kaiinid' => $minyukko_line_data[$i]->kaiinid ?? null,
                                // 受注明細「JM0008商品CD」
                                'datachar02' => $minyukko_line_data[$i]->datachar02 ?? null,
                                // 受注明細「JM0009商品名」
                                'datachar03' => $minyukko_line_data[$i]->datachar03 ?? null,
                                // 受注明細「JM0009商品サブ区分」
                                'dataint20' => $minyukko_line_data[$i]->dataint20 ?? null,
                                // 受注明細「JM0010商品サブＣＤ」
                                'datachar04' => $minyukko_line_data[$i]->datachar04 ?? null,
                                // 受注明細「JM0011商品サブ名称」
                                'datachar05' => $minyukko_line_data[$i]->datachar05 ?? null,
                                // 受注明細「JM0012数量」
                                'nyukosu' => $minyukko_line_data[$i]->nyukosu ?? null,
                                'datachar06' => $minyukko_line_data[$i]->datachar06 ?? null,
                                // 受注明細「JM0015仕切（SE）単価」
                                'kingaku' => $minyukko_line_data[$i]->kingaku ?? null,
                                // 受注明細「JM0015仕切（SE）単価」
                                'genka' => $minyukko_line_data[$i]->genka ?? null,
                                // 発注数量×発注単価 = minyuko.nyukosu x minyuko.genka
                                'syouhizeiritu' => $minyukko_line_data[$i]->syouhizeiritu ?? null,
                                // 受注明細「JM0021メーカー品番」
                                'datachar07' => $minyukko_line_data[$i]->datachar07 ?? null,
                                // 受注明細「JM0022メーカー品名」
                                'datachar08' => $minyukko_line_data[$i]->datachar08 ?? null,
                                // 画面「209発注出荷備考」
                                'datachar09' => $request->order_shipping_remarks_209 ?? null,
                                // 受注明細「JM0029納品方法」
                                'datachar10' => $minyukko_line_data[$i]->datachar10 ?? null,
                                // 画面「208社内備考」
                                'datachar11' => $request->information7_in_house_remarks ?? null,
                                // 受注明細 MIN(「JM0020SE粗利担当」
                                'datachar13' => $minyukko_line_data[$i]->datachar13 ?? null,
                                // ”0”(有効)
                                'denpyobango' => 0,
                                // 登録実行時のSYSTEM-DATE
                                'denpyohakkoubi' => $minyukko_line_data[$i]->denpyohakkoubi,
                                // // ログイン社員CD
                                'tantousyabango' => $bango,
                                // 受注「JU0029請求課税区分」
                                'datachar18' => $request->tuhanorder_otodoketime_ju0029 ?? null,
                                // 発注金額×税率
                                // (支払課税区分より、共通仕様C21を用いて算出)
                                // 端数処理はHJ0064支払税端数区分にて行う
                                // Tax calculation
                                // HS0021 x HS0048
                                // minyuko.syouhizeiritu x $request->tuhanorder_otodoketime_ju0029
                                 'soukobango' => $minyukko_line_data[$i]->soukobango  ?? null
                            ];

                            $minyukko_order_number++;
                           
                            $minuko_result = QueryHelper::insertData('minyuko', $minyuko_insertable_data, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                       }
                    }



                    // juchusyukko2 update
                    // DB::table('juchusyukko2')
                    //         ->where("syouhinid", "=", $kokyakuorderbango)
                    //         ->update(["orderbango" => $orderhenkan_result->bango, 'denpyoshimebi' => Carbon::now()->format('Y-m-d H:i:s')]);


                    $juchusyukko2_update_data = [
                            'syouhinid' => $kokyakuorderbango ?? null,
                            'denpyoshimebi' => Carbon::now()->format('Y-m-d H:i:s'),
                            'orderbango' => $orderhenkan_result->bango,
                        ];

                    QueryHelper::updateData('juchusyukko2', $juchusyukko2_update_data, 'syouhinid', $bango, __CLASS__, __FUNCTION__, __LINE__);
                }
            


                // DB::table('juchusyukko2')
                //         ->where("syouhinid", "=", $kokyakuorderbango)
                //         ->where("orderbango", "=", $request->orderhenkan_bango)
                //         ->update(['denpyoshimebi' => Carbon::now()->format('Y-m-d H:i:s'), 'orderbango' => $orderhenkan_result->bango]);
                


                // misyukko
                // don't update

                //inserting into rireki
                $tmp_kokyakuorderbango = $kokyakuorderbango ?? null;
                $tmp_ordertypebango2 = (int)($request->orderhenkan_ordertypebango2_maxval) + 1;
                CreateHatchuDetails::data($bango,$tmp_kokyakuorderbango, $tmp_ordertypebango2,2,'05-06');


                // commit
                $result['status'] = 'ok';
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### support_entry end\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "COMMIT");

                // successfull msg
                session()->flash('success_msg', "発注番号 " . $kokyakuorderbango . " で登録しました");
                $result['success_msg'] = "発注番号 " . $kokyakuorderbango . " で登録しました";

            }catch (\Exception $e) {
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "ROLLBACK");
                session()->flash('success_msg', "something" . $kokyakuorderbango . "went wrong");
                $result['status'] = 'ng';
                $result['error_msg'] = "something" . $kokyakuorderbango . "went wrong";
                $result['exception'] = $e->getMessage();
            }
        }

        return $result;
    }




     // delete
    public static function delete($request, $bango, $file){
       // echo "val : " . $request->$orderhenkan_ordertypebango2_maxval;
        
      //=  dd($request->all());
        // $kokyakuorderbango = '0351000153';
        // $orderhenkan_orderuserbango = '0151014552';

        //  $orderhenkan_edit_data_result = DB::table("orderhenkan")
        //                                         ->select("*")
        //                                         ->whereIn('intorder04', ['1','2'])
        //                                         ->where("datachar02", "=", 'V413')
        //                                         ->where("kokyakuorderbango", "=", $kokyakuorderbango)
        //                                         ->where("orderuserbango", "=", $orderhenkan_orderuserbango)
        //                                         ->where("synchroorderbango2", "=", '0')
        //                                         ->get();

        //         var_dump($orderhenkan_edit_data_result);


        // $result['status'] = 'ok';
        // $result['success_msg'] = "受注番号 059886454 で登録しました";
        // return $result;
       // $validator = SupportEntryCreateValidation::handle(request()->all());


       // $errors = $validator->errors();
       // if ($errors->any()) {
      //      return $errors;
      //  }elseif(!$errors->any() && $request->submit_confirmation == ""){
        if($request->submit_confirmation == ""){
            $result["status"] = "confirm";
            return $result;
        }else{
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### support_entry start\n";
            QueryHandler::logger($bango, $log_data);
            
            // connection for pg_query
            $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));

            pg_query($conn, "BEGIN");



    
            // support number
            $kokyakuorderbango = $request->number_search;
            $orderhenkan_orderuserbango = $request->order_number;

            try{

                // if (!file_exists('uploads')) {
                //     mkdir('uploads', 0777, true);
                // }

                // if (!file_exists('uploads/support_entry')) {
                //     mkdir('uploads/support_entry', 0777, true);
                // }

                // if (!file_exists('uploads/lbook/')) {
                //     mkdir('uploads/lbook/', 0777, true);
                // }

                /*if ($file != "" || $request->proposal_file != "") {
                    if ($file != "") {
                        $filenameWithExtension = $file->getClientOriginalName();
                        $fileExtension = '.' . $file->getClientOriginalExtension();
                        $filename = explode($fileExtension, $filenameWithExtension);
                        $filename = $filename[0] . '¶' . $kokyakuorderbango . '_' . static::getCurrentTime() . $fileExtension;

                        $file->move(public_path('uploads/support_entry'), $filename);
                      //  $file->move(public_path('uploads/lbook'), $filename);
                    } else {
                        $filename = $request->proposal_file;
                    }
                }else{
                    $filename = $request->proposal_file;
                } */// . end batch upload 
                // .end orderhenkan insertion
                



               
                // start orderHenkan transaction
                $orderhenkan_insertable_data = [
                        // number search => order number
                         'kokyakuorderbango' => $kokyakuorderbango ?? null,

                        // 0 fixed
                        'ordertypebango2' => ($request->orderhenkan_ordertypebango2_maxval) + 1,
                        
                        // 104
                        'orderuserbango' => $request->order_number ?? null,
                        
                        // empty field
                        //'datachar01' => '',
                        
                        // 13 (support)
                        'datachar02' => 'V413',
                        
                        // 1 new
                        // old spec kokyakubango 
                        // new spec intorder04
                       // 'kokyakubango' => 1,

                         'intorder04' => 3,
                         
                        // empty field
                        //'kokyakubango' => '',
                        
                        // TODAY date
                        'date' => Carbon::now()->format('Y-m-d H:i:s'),
                        
                        // JU0008
                       // 'datachar09' => '受注「JU0008受注担当者」',
                        'datachar09' => $request->datachar05_ju0008,
                        
                        // 105 contractor
                       // 'datachar10' => $request->contractor ?? null,
                        'datachar10' => $request->orderhenkan_datachar10_information1 ?? null,
                        
                        // 106 end customers
                       // 'datachar11' => $request->end_customer ?? null,
                        'datachar11' => $request->orderhenkan_datachar10_information3 ?? null,
                        
                        // blank field
                        //'intorder01' => '',
                        //'intorder02' => '',
                        //'datachar04' => '',
                        //'datachar05' => '',
                        //'datachar06' => '',
                        //'datachar07' => '',
                        
                        // 209 : old spec
                        // 'datatxt0147' => $request->order_shipping_remarks_209 ?? null,

                        // 210: new spec
                        'datatxt0147' => $request->order_summary_remarks ?? null,

                        // 201 : deletedate
                        'deletedate' => $request->datepicker6_oen ?? null,
                        
                        // 202 : first visit date
                        'date0012' => $request->datepicker7_oen ?? null,
                        
                        // 203
                        'datachar12' => $request->consultation_person_name ?? null,
                        
                        // 206
                        // orderhenkan.datachar13 = 206 = tuhanorder.juchukubun1 = business name
                        'datachar13' => $request->juchukubun1_business_name ?? null,
                        
                        // 205 model name
                        'datachar14' => $request->model_name ?? null,
                        
                        // 207 os
                        'datachar15' => $request->os ?? null,
                        
                        // 211 basic design completed
                        'date0013' => $request->datepicker8_oen ?? null,
                        
                        // 212 setup start
                        'date0014' => $request->datepicker9_oen ?? null,
                        
                        // 213 production start
                        'date0015' => $request->datepicker10_oen ?? null,
                        
                        // 215 acceptance condition
                        'datatxt0148' => $request->acceptance_condition ?? null,
                        'datatxt0149' => $request->datatxt0004_216 ?? null,
                        // this field is depend on lbook, if value present. if no pdf, value = null
                       // 'datatxt0150' => $filename ?? null,
                        // datatxt0150 = $request->hidden_lbook_kokyakuorderbango;
                        // if pdf upload, update with new lbook_kokyakuorderbango in lbook registration
                        // 'datatxt0150' => $request->hidden_lbook_kokyakuorderbango ?? null,
                        
                        // blank
                       //  'datatxt0151' => '',
                        
                        // 2(not)
                        'intorder03' => 2,
                        
                        // blank
                        // 'datatxt0152' => '',
                        
                        //blank
                       // 'synchroorderbango' => 0,
                       
                        // blank
                       // 'date0018' => '',
                       
                        // blank
                       // 'date0019' => '',
                       
                        // blank
                       // 'datatxt0144' => '',
                       
                        // blank
                       // 'datatxt0154' => '',
                       
                        // ”0”(有効)
                        'synchroorderbango2' => 1,
                       
                        // system date time
                        //'date0016' => static::getCurrentTime(),
                      //  'date0016' => Carbon::now()->format('Y-m-d H:i:s'),
                        'date0016' => $request->hidden_orderhenkan_date0016,

                        // blank
                       // 'date0017' => '',
                       
                        // ログイン社員CD : $bango
                        'datatxt0155' => $bango ?? null,
                       
                        // blank
                        // 'datatxt0156' => '',
                       
                        // 204
                        'datatxt0157' => $request->include_place ?? null,
                       
                        // 202-A
                        'date0020' => $request->datepicker11_oen ?? null
                ];

               $orderhenkan_result = QueryHelper::insertData('orderhenkan', $orderhenkan_insertable_data, 'bango', true, $bango, __CLASS__, __FUNCTION__, __LINE__);




              

             /*  if($orderhenkan_result){


                     //============== L-Book reg start here ==================//
                    //update review data

                    $fiscal_year = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7501' ")->orderbango ?? null;

                    $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7301'");



                    if ($reviewData) {
                        $modified_orderbango = '03' . $fiscal_year . $reviewData->orderbango + 1;
                        //$modified_orderbango = '03' . $fiscal_year . $reviewData->orderbango + 1;
                       // $modified_orderbango = "03".$fiscal_year.str_pad($reviewData->orderbango + 1,$reviewData->mobile_flag,'0',STR_PAD_LEFT );
                    }*/


                    /*$lbook_orderInfo = self::getOrderBangoForLbook();
                    $lbook_kokyakuorderbango = $lbook_orderInfo['kokyakuorderbango'];
                    $lbook_review_orderbango = $lbook_orderInfo['review_orderbango'];


                    if ($file != "" || $request->proposal_file != "") {
                     if ($file != "") {
                    
                             // SOUKONYUKO INSERTION
                            $soukonyuko_insert_data = [
                                'orderbango' => $orderhenkan_result->bango,
                                'datachar01' => $lbook_kokyakuorderbango,
                                'datachar02' => $request->contractor ?? null,
                                'datachar03' => $request->tuhanorder_information2 ?? null,
                                'datachar04' => $request->end_customer ?? null,
                                'datachar05' => $request->order_number ?? null,
                                'datachar06' => $orderhenkan_result->datachar05,
                                'datachar07' => 'H130',
                                'datachar08' => $orderhenkan_result->tuhanorder_juchukubun1_orders_subject ?? null,
                                'datachar09' => $filename,
                                'datachar10' => '',
                                'dataint25' => 0,
                                'datachar11' => Carbon::now()->format('Y-m-d H:i:s'),
                                'datachar12' => null,
                                'datachar13' => $bango,
                            ];

                            $soukonyuko = QueryHelper::insertData('soukonyuko', $soukonyuko_insert_data, 'datachar01', true, $bango, __CLASS__, __FUNCTION__, __LINE__);

                            if ($soukonyuko) {
                                \File::copy(public_path('uploads/support_entry/') . $filename, public_path('uploads/lbook/') . $filename);
                            }


                             //update orderhenkan data
                            $orderhenkan_update_data = [
                                //'kokyakuorderbango' => $orderHenkan->kokyakuorderbango,
                                'bango' => $orderhenkan_result->bango,
                                // 'datachar05' => $bango,
                                'datatxt0150' => $lbook_kokyakuorderbango
                            ];

                            QueryHelper::updateData('orderhenkan', $orderhenkan_update_data, 'bango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                            

                            // REVIEW UPDATE
                            $review_update_data = [
                                'kokyakusyouhinbango' => 'D7301',
                                'orderbango' => $lbook_review_orderbango,
                                'check_flag' => 0,
                                'color' => static::getCurrentTime(),
                                'size' => Helper::getSystemIP(),
                                'nickname' => $bango,
                            ];
                            QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);


                            // REVIEW UPDATE
                            $review_update_data = [
                                'kokyakusyouhinbango' => 'D7012',
                                'orderbango' => $lbook_review_orderbango,
                                'check_flag' => 0,
                                'color' => static::getCurrentTime(),
                                'size' => Helper::getSystemIP(),
                                'nickname' => $bango,
                            ];
                            QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);

                         }

                        }
                    }*/

            //============== L-Book reg end here ==================//


             // $hikiatenyuko_previous_data = DB::table("hikiatenyuko")
             //                                    ->select("*")
             //                                    ->where("orderbango", "=", $request->orderhenkan_bango)
             //                                    ->get();

             //   // start hikiatenyuko table
             //    $hikiatenyuko_updatable_data = [
             //        // orderhenkan.bango
             //        'orderbango' => $orderhenkan_result->bango,
             //        'syouhinid' => $kokyakuorderbango ?? null,
             //        'syouhinsyu' => 2,
             //        'hantei' => null,
             //        'dataint01' => null,
             //        'dataint02' => null,
             //        'dataint03' => 2,
             //        'dataint04' => 2,
             //        'dataint05' => 2,
             //        'dataint06' => 2,
             //        'dataint07' => 2,
             //        'dataint08' => null,
             //        'dataint09' => null,
             //        'datachar02' => null,
             //        'datachar03' => null,
             //        'datachar04' => null,
             //        'datachar05' => null,
             //        'yoteimeter' => 1,
             //       // 'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'),
             //        'denpyohakkoubi' => $hikiatenyuko_previous_data[0]->denpyohakkoubi,
             //        'denpyoshimebi' => Carbon::now()->format('Y-m-d H:i:s'),
             //        'tantousyabango' => $bango
             //    ];

             //   $hikiatenyuko_result = QueryHelper::updateData('hikiatenyuko', $hikiatenyuko_updatable_data, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);

                    DB::table('hikiatenyuko')
                        ->where("syouhinid", "=", $kokyakuorderbango)
                        ->update(['orderbango' => $orderhenkan_result->bango, 'denpyoshimebi' => Carbon::now()->format('Y-m-d H:i:s')]);


              
                // minyukko
                // data extract from misyukko for minukko requirement
                $minyukko_line_data = DB::table("minyuko")
                                                ->select("*")
                                                ->where("orderbango", "=", $request->orderhenkan_bango)
                                                ->get();

                $minyukko_line_data_length = count($minyukko_line_data);



                if($minyukko_line_data_length > 0){
                    $minyukko_order_number = 1;
                    for($i = 0; $i < $minyukko_line_data_length; $i++){
                        $dataint10_date =  $minyukko_line_data[$i]->dataint10;
                        // $dataint10_date =  substr($dataint10_date,0, 4) . '-' . substr($dataint10_date,4, 2) . '-'. substr($dataint10_date,6, 2);

                        
                        $minyuko_insertable_data = [
                            'orderbango' => $orderhenkan_result->bango,
                            // 発注「HC0001発注番号」=> orderbango.kokyakuorderbango = order number
                            'syouhinid' => $kokyakuorderbango ?? null,
                            // 発注番号単位に001から連番で採番
                           // 'syouhinsyu' => $minyukko_order_number,
                            'syouhinsyu' => $minyukko_line_data[$i]->syouhinsyu,
                            // ”000”固定
                            'hantei' => $minyukko_line_data[$i]->hantei,
                            // ”0”固定
                            'zaikometer' =>  $minyukko_line_data[$i]->zaikometer + 1,
                            // 受注明細「JM0001受注番号」=> misyukko.syouhinid = orderhenkan.kokyakuorderbango
                            // 'idoutanabango' => $kokyakuorderbango,
                            'idoutanabango' => $minyukko_line_data[$i]->idoutanabango,
                            // 受注明細「JM0002受注行番号
                            'yoteimeter' => $minyukko_line_data[$i]->yoteimeter ?? null,
                            // 受注明細「JM0003受注行番号枝番」=> 
                            'nyukometer' => $minyukko_line_data[$i]->nyukometer ?? null,
                            // ”V120”(SE)固定
                            'datachar01' => 'V120',
                            // 受注明細「JM0025個別納期」
                            'yoteibi' => $dataint10_date ?? null,
                            // 受注明細「JM0026納品先CD」
                            'kaiinid' => $minyukko_line_data[$i]->kaiinid ?? null,
                            // 受注明細「JM0008商品CD」
                            'datachar02' => $minyukko_line_data[$i]->datachar02 ?? null,
                            // 受注明細「JM0009商品名」
                            'datachar03' => $minyukko_line_data[$i]->datachar03 ?? null,
                            // 受注明細「JM0009商品サブ区分」
                            'dataint20' => $minyukko_line_data[$i]->dataint20 ?? null,
                            // 受注明細「JM0010商品サブＣＤ」
                            'datachar04' => $minyukko_line_data[$i]->datachar04 ?? null,
                            // 受注明細「JM0011商品サブ名称」
                            'datachar05' => $minyukko_line_data[$i]->datachar05 ?? null,
                            // 受注明細「JM0012数量」
                            'nyukosu' => $minyukko_line_data[$i]->nyukosu ?? null,
                            'datachar06' => $minyukko_line_data[$i]->datachar06 ?? null,
                            // 受注明細「JM0015仕切（SE）単価」
                            'kingaku' => $minyukko_line_data[$i]->kingaku ?? null,
                            // 受注明細「JM0015仕切（SE）単価」
                            'genka' => $minyukko_line_data[$i]->genka ?? null,
                            // 発注数量×発注単価 = minyuko.nyukosu x minyuko.genka
                            'syouhizeiritu' => $minyukko_line_data[$i]->syouhizeiritu ?? null,
                            // 受注明細「JM0021メーカー品番」
                            'datachar07' => $minyukko_line_data[$i]->datachar07 ?? null,
                            // 受注明細「JM0022メーカー品名」
                            'datachar08' => $minyukko_line_data[$i]->datachar08 ?? null,
                            // 画面「209発注出荷備考」
                            'datachar09' => $request->order_shipping_remarks_209 ?? null,
                            // 受注明細「JM0029納品方法」
                            'datachar10' => $minyukko_line_data[$i]->datachar10 ?? null,
                            // 画面「208社内備考」
                            'datachar11' => $request->information7_in_house_remarks ?? null,
                            // 受注明細 MIN(「JM0020SE粗利担当」
                            'datachar13' => $minyukko_line_data[$i]->datachar13 ?? null,
                            // ”0”(有効)
                            'denpyobango' => 1,
                            // 登録実行時のSYSTEM-DATE
                            'denpyohakkoubi' => $minyukko_line_data[$i]->denpyohakkoubi,
                            // // ログイン社員CD
                            'tantousyabango' => $bango,
                            // 受注「JU0029請求課税区分」
                            'datachar18' => $request->tuhanorder_otodoketime_ju0029 ?? null,
                            // 発注金額×税率
                            // (支払課税区分より、共通仕様C21を用いて算出)
                            // 端数処理はHJ0064支払税端数区分にて行う
                            // Tax calculation
                            // HS0021 x HS0048
                            // minyuko.syouhizeiritu x $request->tuhanorder_otodoketime_ju0029
                             'soukobango' => $minyukko_line_data[$i]->soukobango  ?? null
                        ];

                        $minyukko_order_number++;
                       
                        $minuko_result = QueryHelper::insertData('minyuko', $minyuko_insertable_data, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                   }
                }



                $juchusyukko2_update_data = [
                        'syouhinid' => $kokyakuorderbango ?? null,
                        'denpyoshimebi' => Carbon::now()->format('Y-m-d H:i:s'),
                        'orderbango' => $orderhenkan_result->bango,
                        'yoteimeter' => '1'
                    ];

                QueryHelper::updateData('juchusyukko2', $juchusyukko2_update_data, 'syouhinid', $bango, __CLASS__, __FUNCTION__, __LINE__);



                // juchusyukko2 update
                // DB::table('juchusyukko2')
                //         ->where("syouhinid", "=", $kokyakuorderbango)
                //         ->where("orderbango", "=", $request->orderhenkan_bango)
                //         ->update(['denpyoshimebi' => Carbon::now()->format('Y-m-d H:i:s'), 'yoteimeter' => '1']);

                


                // misyukko
                // don't update
                DB::table('misyukko')
                    ->where("syouhinid", "=", $request->order_number)
                    ->where("dataint05", ">", 0)
                    ->where("datachar13", "=", '1')
                    ->where("yoteimeter", "=", 0)
                    ->update(['datachar22' => DB::raw("concat(0, substring(datachar22, 2, 4))")]);        

                
                //inserting into rireki
                $tmp_kokyakuorderbango = $kokyakuorderbango ?? null;
                $tmp_ordertypebango2 = (int)($request->orderhenkan_ordertypebango2_maxval) + 1;
                CreateHatchuDetails::data($bango,$tmp_kokyakuorderbango, $tmp_ordertypebango2,3,'05-06');
                // commit
                $result['status'] = 'ok';
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### support_entry end\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "COMMIT");

                // successfull msg
                session()->flash('success_msg', "発注番号 " . $kokyakuorderbango . " で登録しました");
                $result['success_msg'] = "発注番号 " . $kokyakuorderbango . " で登録しました";

            }catch (\Exception $e) {
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "ROLLBACK");
                session()->flash('success_msg', "something" . $kokyakuorderbango . "went wrong");
                $result['status'] = 'ng';
                $result['error_msg'] = "something" . $kokyakuorderbango . "went wrong";
                $result['exception'] = $e->getMessage();
            }
        }

        return $result;
    }

     public static function getOrderBango(){
        $fiscal_year = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7501' ")->orderbango ?? null;
        $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7012'");
        if($reviewData){
            $orderbango = $reviewData->orderbango + 1;
            $mobile_flag = $reviewData->mobile_flag ;
        }else{
            $orderbango = "";
            $mobile_flag = "";
        }
        $kokyakuorderbango = "03".$fiscal_year.str_pad($orderbango,$mobile_flag,'0',STR_PAD_LEFT );
        return ['kokyakuorderbango'=>$kokyakuorderbango,'review_orderbango'=>$orderbango];
    }

    public static function getOrderBangoForLbook(){
        $fiscal_year = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7501' ")->orderbango ?? null;
        $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7301'");
        if($reviewData){
            $orderbango = $reviewData->orderbango + 1;
            $mobile_flag = $reviewData->mobile_flag ;
        }else{
            $orderbango = "";
            $mobile_flag = "";
        }
        $kokyakuorderbango = "21".$fiscal_year.str_pad($orderbango,$mobile_flag,'0',STR_PAD_LEFT );
        return ['kokyakuorderbango'=>$kokyakuorderbango,'review_orderbango'=>$orderbango];
    }


     public static function calculateTaxRateForAdjustment($datachar10,$datachar18,$bango,$syouhizeiritu){
        // $info2 = tuhanorder.information1 = orderhenkan.datachar10 = 00014301001
        // $otodoketime = tuhanorder.otodoketime = minyuko.datachar18 = B120
        // $bango = $bango = 6624
        // syukkasu = minyuko.syouhizeiritu = amount = 44
        

        $kokyakuCode = substr($datachar10, 0,6); // 000143
        $haisouCode = substr($datachar10, 6,2); // 01

       
        $kokyaku = QueryHelper::select(['bango,mallsoukobango1'])->from('kokyaku1')->where("yobi12 = '$kokyakuCode' ")->get()->first(); // 291, B21
        $haisoujouhou = QueryHelper::select(['bunrui5, datatxt0051'])->from('haisoujouhou')->where("syukei1 = '$kokyaku->bango' ")->get()->first(); // 1 伝票単位

        $bunrui5 = $haisoujouhou->bunrui5; // E21
        $bunrui5_cat1 = substr($bunrui5, 0, 2);
        $bunrui5_cat2 = substr($bunrui5, 2, 1);

        // dd($bunrui5);
      //  dd($bunrui5_cat1, $bunrui5_cat2);
        
        $status_check = QueryHelper::fetchSingleResult("select category4 from categorykanri where category1 = '$bunrui5_cat1' and category2 = '$bunrui5_cat2'");

        $status_check = $status_check->category4; // 四捨五入
     //   dd($status_check);

        $category1 = substr($datachar18,0,2); // B1
        $category2 = substr($datachar18,2,2); // 20
        $categorykanri = QueryHelper::fetchSingleResult("select substring(category5,1,2) as category5 from categorykanri where category1 = '$category1' AND category2 = '$category2' "); 

         // echo "datachar10 : " . $datachar10 . ", datachar10: " . $datachar18 . ", bango: " . $bango . ", syouhizeiritu: " . $syouhizeiritu . "<br>";
         // echo "kokyakucode: " . $kokyakuCode . ", haisouCode : " . $haisouCode . "<br>";
         // echo "kokyaku : ";
         // var_dump($kokyaku);
         // echo "haisoujouhou : ";
         // var_dump($haisoujouhou);

         // echo "category1 : " . $category1 . ", category2 : " . $category2 . "<br>";
         // echo "categorykanri : ";
         // var_dump($categorykanri);

        // echo "others 2 : ";
        //  var_dump($others2);


        $category5 = (int) $categorykanri->category5; // 10

        $mallsoukobango1 = $kokyaku->mallsoukobango1; // B21
        $soukobango = ($syouhizeiritu*$category5)/100; // (44*10) / 100
        

        //check tax rate for round,floor or selling
      //  echo "value: " . $soukobango . "<br>"; // 4.4

        if($status_check == '四捨五入'){
            $soukobango = round($soukobango); // 4
        }else if($status_check == '切り捨て'){
            $soukobango = floor($soukobango); // 5
        }else if($status_check == '切り上げ'){
            $soukobango = ceil($soukobango); // 4
        }

        return $soukobango;
    }


     //calculate tax rate for adjustment
    public static function calculateTaxRateForAdjustment__old($info2,$otodoketime,$bango,$syukkasu,$dataint04){
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
        $soukobango = ($syukkasu*$dataint04*$category5)/100;
        
        if(explode(' ', $others2[0]->other1)[0] == '1'){
            $format_status = substr($mallsoukobango1,2,1);
            $data_status = explode(' ', $haisoujouhou->datatxt0051)[0];
        }else{
            $format_status = substr($others2[0]->other18,2,1);
            $data_status = explode(' ', $others2[0]->other17)[0];
        }

        //check tax rate for round,floor or selling
        if($format_status == '1'){
            $soukobango = round($soukobango);
        }else if($format_status == '2'){
            $soukobango = floor($soukobango);
        }else if($format_status == '3'){
            $soukobango = ceil($soukobango);
        }

        return $soukobango;
    }



    public static function getCurrentTime(){
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        return str_replace(" ", "", $mytime);
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
                    'datachar05' => $bango,
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
                $reviewData1 = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7012'");
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
                                'kokyakusyouhinbango' => 'D7012',
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
                        'dataint12' => static::stringDataConvertedToIntegerFormat($request->grossProfit, 'comma') ?? null,
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
                    'datachar05' => $bango,
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
        $orderDetailRequestInput = ['productCd', 'productName', 'orderDate', 'individualDeliveryDate', 'deliveryDestination', 'unit', 'quantity', 'unitSellingPrice', 'se', 'institute', 'ship', 'purchase', 'sales', 'se2', 'productSubCd', 'shippingInstruction', 'maintenance', 'supplier', 'manufacturePartNumber', 'manufactureProductName', 'issueNote', 'deliveryMethod', 'continutionCategory', 'newVup', 'vupCategory', 'statementRemarks', 'line', 'branch', 'serial', 'productSubName', 'price', 'grossProfit', 'percentage', 'setcode', 'deletedProduct', 'data_char13', 'flatContract', 'shoyin_color'];
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
