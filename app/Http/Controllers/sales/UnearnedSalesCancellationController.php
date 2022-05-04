<?php

namespace App\Http\Controllers\sales;
use Illuminate\Http\Request;
use App\tantousya;
use DB;
use Session;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use App\Helpers\Helper;
use App\AllClass\sales\unearnedSalesCancellation\UnearnedSalesCancellationValidation;
use File;

class UnearnedSalesCancellationController extends Controller{
    public function index(Request $request){
        $bango = request('userId');
        $tantousya = tantousya::find($bango);
        
        return view('sales.unearnedSalesCancellation.mainCancellationOfUnearnedSales',compact('bango','tantousya'));  
    }


    public function cancellationProcess(Request $request){
        $validator = UnearnedSalesCancellationValidation::handle(request()->all());
        $errors = $validator->errors();

        if ($errors->any()) {
            return ['err_msg' => $errors];
        }elseif(!$errors->any() && $request->submit_confirmation == ""){
            $result["status"] = "confirm";
            return $result;
        }else if (!$errors->any()) {
            // cancellation process
            $result = $this->unearnedSalesCancellationProcess($request);
            // if empty, return validation error message
            if(count($result) > 0){
                return $result;
            }else{
                 return ['err_msg' => "該当するデータがありません。"];
            }
        }// ./Ends no errors found
    }


    // 501, submit function
    public function unearnedSalesCancellationProcess(Request $request){
        $bango = request('userId');

        QueryHelper::runQuery("DROP TABLE IF EXISTS unearned_sales_cancel_process_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE unearned_sales_cancel_process_temp as
                       select   
                            -- tuhanorder table selection                              
                            tuhanorder.orderbango as orderbango,
                            tuhanorder.text2 as tuhanorder_UR0006_text2,
                            tuhanorder.information1 as tuhanorder_UR0007_information1,
                            tuhanorder.information2 as tuhanorder_UR0008_information2,
                            tuhanorder.information6 as tuhanorder_UR0009_information6,
                            tuhanorder.information3 as tuhanorder_UR0010_information3,
                            tuhanorder.numeric2 as tuhanorder_UR0013_numeric2,
                            tuhanorder.kessaihouhou as tuhanorder_UR0015_kessaihouhou,
                            tuhanorder.housoukubun as tuhanorder_UR0016_housoukubun,
                            tuhanorder.information7 as tuhanorder_UR0017_information7,
                            tuhanorder.information8 as tuhanorder_UR0018_information8,
                            tuhanorder.numeric3 as tuhanorder_UR0019_numeric3,
                            tuhanorder.numeric4 as tuhanorder_UR0020_numeric4,
                            tuhanorder.text3 as tuhanorder_UR0021_text3,
                            tuhanorder.otodoketime as tuhanorder_UR0022_otodoketime,
                            tuhanorder.chumondate as tuhanorder_UR0024_chumondate,
                            tuhanorder.unsoudaibikitesuryou as tuhanorder_UR0025_unsoudaibikitesuryou,
                            tuhanorder.unsoutesuryou as tuhanorder_UR0026_unsoutesuryou,
                            tuhanorder.text4 as tuhanorder_UR0027_text4,
                            tuhanorder.youbou as tuhanorder_UR0029_youbou,
                            tuhanorder.affbango as tuhanorder_UR0030_affbango,
                            tuhanorder.numeric5 as tuhanorder_UR0035_numeric5,
                            -- orderhenkan data selection
                            orderhenkan.kokyakuorderbango as orderhenkan_UR0005_kokyakuorderbango
                            -- hikiatenyuko data selection
                            hikiatesyukko.dataint02 as hikiatesyukko_URF003_dataint02,
                            hikiatesyukko.dataint05 as hikiatesyukko_URF006_dataint05,
                            hikiatesyukko.dataint06 as hikiatesyukko_URF007_dataint06,
                            hikiatesyukko.dataint07 as hikiatesyukko_URF008_dataint07,
                            hikiatesyukko.datachar11 as hikiatesyukko_URF009_datachar11,
                            hikiatesyukko.datachar12 as hikiatesyukko_URF010_datachar12,
                            hikiatesyukko.datachar13 as hikiatesyukko_URF011_datachar13,
                            hikiatesyukko.datachar14 as hikiatesyukko_URF012_datachar14,
                            hikiatesyukko.datachar15 as hikiatesyukko_URF013_datachar15,
                            hikiatesyukko.dataint08 as hikiatesyukko_URF020_dataint08,
                            hikiatesyukko.dataint09 as hikiatesyukko_URF021_dataint09,
                            -- syukkoold selection
                            syukkoold.syouhinsyu as syukkoold_UM0002_syouhinsyu,
                            syukkoold.hantei as syukkoold_UM0003_hantei,
                            syukkoold.dataint02 as syukkoold_UM0005_dataint02,
                            syukkoold.datachar13 as syukkoold_UM0006_datachar13,
                            syukkoold.syouhinid as syukkoold_UM0007_syouhinid,
                            syukkoold.kawasename as syukkoold_UM0008_kawasename,
                            syukkoold.syouhinname as syukkoold_UM0009_syouhinname,
                            syukkoold.syukkasu as syukkoold_UM0010_syukkasu,
                            syukkoold.codename as syukkoold_UM0011_codename,
                            syukkoold.dataint04 as syukkoold_UM0012_dataint04,
                            syukkoold.datachar08 as syukkoold_UM0013_datachar08,
                            syukkoold.dataint14 as syukkoold_UM0014_dataint14,
                            syukkoold.dataint15 as syukkoold_UM0015_dataint15,
                            syukkoold.datachar18 as syukkoold_UM0016_datachar18,
                            syukkoold.datachar19 as syukkoold_UM0017_datachar19,
                            syukkoold.datachar20 as syukkoold_UM0018_datachar20,
                            syukkoold.datachar10 as syukkoold_UM0019_datachar10
                            from orderhenkan
                            left join tuhanorder on tuhanorder.orderbango = orderhenkan.bango and tuhanorder.juchubango = orderhenkan.kokyakuorderbango
                            left join misyukko  on orderhenkan.bango = misyukko.orderbango and orderhenkan.kokyakuorderbango = misyukko.syouhinid
                            left join hikiatesyukko on hikiatesyukko.orderbango = orderhenkan.bango
                            join juchusyukko on misyukko.syouhinid = juchusyukko.syouhinid and misyukko.syouhinsyu = juchusyukko.syouhinsyu and misyukko.hantei = juchusyukko.hantei
                            join syukkoold on syukkoold.orderbango = orderhenkan.bango
                            where 
                            orderhenkan.datachar07=misyukko.datachar21 and
                            tuhanorder.datatxt0122='J310' and
                            tuhanorder.chumonbango=orderhenkan.datachar07 and
                            orderhenkan.datachar02='U123' and
                            hikiatesyukko.syouhinid=tuhanorder.juchubango and
                            hikiatesyukko.datachar04='1' and
                            hikiatesyukko.datachar16='2' and
                            juchusyukko.syouhinid=tuhanorder.juchubango and
                            juchusyukko.datachar01='1' and
                            orderhenkan.kokyakuorderbango=tuhanorder.juchubango and
                            tuhanorder.Text1='U523' and
                            tuhanorder.unsoudaibikitesuryou='1' and
                            hikiatesyukko.kaiinid=tuhanorder.juchukubun2 and
                            hikiatesyukko.dataint01='2' and
                            syukkoold.syouhinid=misyukko.syouhinid and
                            syukkoold.syouhinsyu=misyukko.syouhinsyu and
                            syukkoold.hantei= misyukko.hantei
                            or
                            (orderhenkan.kokyakuorderbango=tuhanorder.juchubango and tuhanorder.Text1='U523' and tuhanorder.unsoudaibikitesuryou='2' and hikiatesyukko.kaiinid=tuhanorder.juchukubun2 and hikiatesyukko.dataint01='2' and syukkoold.syouhinid=misyukko.syouhinid and syukkoold.syouhinsyu=misyukko.syouhinsyu and syukkoold.hantei=misyukko.hantei
                            )");

        // QueryHelper::runQuery("DROP TABLE IF EXISTS unearned_sales_cancel_process_temp");
        // QueryHelper::runQuery("CREATE TEMPORARY TABLE unearned_sales_cancel_process_temp as
        //                select                                 
        //                     orderhenkan.bango as bango
        //                     from orderhenkan
        //                     limit 1
        //                     ");


            $query = DB::table('unearned_sales_cancel_process_temp')->toSql();
            $result = collect(QueryHelper::fetchResult($query));

            // return error
            if(count($result) == 0){
                return $result;
            }else{
                $tuhanorder_UR0025_unsoudaibikitesuryou = $result[0]->tuhanorder_UR0025_unsoudaibikitesuryou;
                if($tuhanorder_UR0025_unsoudaibikitesuryou == 1){
                    // insert
                    $result = $this->insert1($bango, $request, $result);
                    return $result;
                }else{
                    if($tuhanorder_UR0025_unsoudaibikitesuryou == 2){
                        // insert, not update yet!
                        $result = $this->insert2($bango, $request, $result);
                        return $result;
                    }
                }
            }
    }



    // data pass from where tuhanorder.unsoudaibikitesuryou(ur00025) = 1
    private function insert1($bango, $request, $result){
            // tuhanorder insertion
            $tuhanorder_insertable_data = [
                'juchukubun2' => 'D7051',
                'text1' => 'U550',
                // UR0006 <- tuhanorder.text2 <- original value
                'text2' => $result[0]->tuhanorder_UR0006_text2,
                // UR0007 <- tuhanorder.information1 <- original value
                'information1' => $result[0]->tuhanorder_UR0007_information1,
                // UR0008 <- tuhanorder.information2 <- original value
                'information2' => $result[0]->tuhanorder_UR0008_information2,
                 // UR0009 <- tuhanorder.information6 <- original value
                'information6' => $result[0]->tuhanorder_UR0009_information6,
                // UR0010 <- tuhanorder.information3 <- original value
                'information3' => $result[0]->tuhanorder_UR0010_information3,
                // UR0013 <- tuhanorder.numeric2 <- original value
                'numeric2' => $result[0]->tuhanorder_UR0013_numeric2,
                // UR0015 <- tuhanorder.kessaihouhou <- original value
                'kessaihouhou' => $result[0]->tuhanorder_UR0015_kessaihouhou,
                // UR0016 <- tuhanorder.housoukubun <- original value
                'housoukubun' => $result[0]->tuhanorder_UR0016_housoukubun,
                // UR0017 <- tuhanorder.information7 <- original value
                'information7' => $result[0]->tuhanorder_UR0017_information7,
                // UR0018 <- tuhanorder.information8 <- original value
                'information8' => $result[0]->tuhanorder_UR0018_information8,
                // UR0019 <- tuhanorder.numeric3 <- original value
                'numeric3' => $result[0]->tuhanorder_UR0019_numeric3,
                // UR0020 <- tuhanorder.numeric4 <- original value
                'numeric4' => $result[0]->tuhanorder_UR0020_numeric4,
                // UR0021 <- tuhanorder.text3 <- original value
                'text3' => $result[0]->tuhanorder_UR0021_text3,
                // UR0022 <- tuhanorder.otodoketime <- original value
                'otodoketime' => $result[0]->tuhanorder_UR0022_otodoketime,
                // UR0024 <- tuhanorder.chumondate <- original value
                'chumondate' => $result[0]->tuhanorder_UR0024_chumondate,
                // UR00025 <- uhanorder.unsoudaibikitesuryou <- original value
                'unsoudaibikitesuryou' => result[0]->tuhanorder_UR0025_unsoudaibikitesuryou,
                // UR0025 <- tuhanorder.unsoutesuryou <- original value
                'unsoutesuryou' => $result[0]->tuhanorder_UR0026_unsoutesuryou,
                // UR0026 <- tuhanorder.text4 <- original value
                'text4' => $result[0]->tuhanorder_UR0027_text4,
                'text5' => '2',
                // UR0029 <- tuhanorder.youbou <- original value
                'youbou' => $result[0]->tuhanorder_UR0029_youbou,
                // UR0030 <- tuhanorder.affbango <- original value
                'affbango' => $result[0]->tuhanorder_UR0030_affbango,
                // UR0035 <- tuhanorder.numeric5 <- original value
                'numeric5' => $result[0]->tuhanorder_UR0035_numeric5,
            ];

        //$tuhanorder_result = QueryHelper::insertData('tuhanorder', $tuhanorder_insertable_data, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);


            // orderhenkan table insertion
            $orderhenkan_insertable_data = [
                    'datachar10' => 'D7051',
                    'ordertypebango2' => 0,
                    'datachar01' => 1,
                    // original value
                    'kokyakuorderbango' => $result[0]->orderhenkan_UR0005_kokyakuorderbango,
                    'intorder01' => $request->unearned_sales_cancellation_102,
                    'intorder03' => $request->unearned_sales_cancellation_102,
                    'intorder05' => $request->unearned_sales_cancellation_102,
                    'synchroorderbango' => 0,
                    'date' => Carbon::now()->format('Y-m-d H:i:s'),
                    'orderuserbango' => $bango
            ];

            //$orderhenkan_result = QueryHelper::insertData('orderhenkan', $orderhenkan_insertable_data, 'bango', true, $bango, __CLASS__, __FUNCTION__, __LINE__);

            
            // hikiatesyukko table insertion
            $hikiatesyukko_insertable_data = [
                'kaiinid' => 'D7051',
                'dataint01' => 1,
                // URF0003 <- hikiatesyukko.dataint02 <- original value
                'dataint02' => $result[0]->hikiatesyukko_URF003_dataint02,
                'dataint03' => 2,
                'dataint04' => 2,
                // URF0006 <- hikiatesyukko.dataint05 <- original value
                'dataint05' => $result[0]->hikiatesyukko_URF006_dataint05,
                // URF0007 <- hikiatesyukko.dataint06 <- original value
                'dataint06' => $result[0]->hikiatesyukko_URF007_dataint06,
                // URF0008 <- hikiatesyukko.dataint07 <- original value
                'dataint07' => $result[0]->hikiatesyukko_URF008_dataint07,
                // URF0009 <- hikiatesyukko.datachar11 <- original value
                'datachar11' => $result[0]->hikiatesyukko_URF009_datachar11,
                // URF010 <- hikiatesyukko.datachar12 <- original value
                'datachar12' =>  $result[0]->hikiatesyukko_URF010_datachar12,
                // URF011 <- hikiatesyukko.datachar13 <- original value
                'datachar13' => $result[0]->hikiatesyukko_URF011_datachar13,
                // URF012 <- hikiatesyukko.datachar14 <- original value
                'datachar14' => $result[0]->hikiatesyukko_URF012_datachar14,
                // URF013 <- hikiatesyukko.datachar15 <- original value
                'datachar15' => $result[0]->hikiatesyukko_URF013_datachar15,
                'yoteimeter' => 0,
                'tanabango' => Carbon::now()->format('Y-m-d H:i:s'),
                'idoutanabango' => '',
                'tantousyabango' => $bango,
                // URF020 <- hikiatesyukko.dataint08 <- original value
                'dataint08' => $result[0]->hikiatesyukko_URF020_dataint08,
                // URF021 <- hikiatesyukko.dataint09 <- original value
                'dataint09' =>  $result[0]->hikiatesyukko_URF021_dataint09,
            ];

            // $hikiatesyukko_result = QueryHelper::insertData('hikiatesyukko',$hikiatesyukko_insertable_data,'hanbaibukacd', true, $bango, __CLASS__, __FUNCTION__, __LINE__);


            // syukkoold insert table
            $syukkoold_insertable_data = [
                'kaiinid' => 'D7051',
                 // UM0002 <- syukkoold.syouhinsyu <- original value
                'syouhinsyu' =>  $result[0]->syukkoold_UM0002_syouhinsyu,
                // UM0003 <- syukkoold.syouhinsyu <- original value
                'hantei' => $result[0]->syukkoold_UM0003_hantei,
                'dataint01' => 0,
                // UM0005 <- syukkoold.syouhinsyu <- original value
                'dataint02' => $result[0]->syukkoold_UM0005_dataint02,
                // UM0006 <- syukkoold.syouhinsyu <- original value
                'datachar13' => $result[0]->syukkoold_UM0006_datachar13,
                // UM0007 <- syukkoold.syouhinsyu <- original value
                'syouhinid' => $result[0]->syukkoold_UM0007_syouhinid,
                // UM0008 <- syukkoold.syouhinsyu <- original value
                'kawasename' => $result[0]->syukkoold_UM0008_kawasename,
                // UM0009 <- syukkoold.syouhinsyu <- original value
                'syouhinname' => $result[0]->syukkoold_UM0009_syouhinname,
                // UM0010 <- syukkoold.syouhinsyu <- original value
                'syukkasu' => $result[0]->syukkoold_UM0010_syukkasu,
                // UM0011 <- syukkoold.syouhinsyu <- original value
                'codename' => $result[0]->syukkoold_UM0011_codename,
                // UM0012 <- syukkoold.syouhinsyu <- original value
                'dataint04' => $result[0]->syukkoold_UM0012_dataint04,
                // UM0013 <- syukkoold.syouhinsyu <- original value
                'datachar08' => $result[0]->syukkoold_UM0013_datachar08,
                // UM0014 <- syukkoold.syouhinsyu <- original value
                'dataint14' => $result[0]->syukkoold_UM0014_dataint14,
                // UM0015 <- syukkoold.syouhinsyu <- original value
                'dataint15' => $result[0]->syukkoold_UM0015_dataint15,
                // UM0016 <- syukkoold.syouhinsyu <- original value
                'datachar18' => $result[0]->syukkoold_UM0016_datachar18,
                // UM0017 <- syukkoold.syouhinsyu <- original value
                'datachar19' => $result[0]->syukkoold_UM0017_datachar19,
                // UM0018 <- syukkoold.syouhinsyu <- original value
                'datachar20' => $result[0]->syukkoold_UM0018_datachar20,
                 // UM0019 <- syukkoold.syouhinsyu <- original value
                'datachar10' => $result[0]->syukkoold_UM0019_datachar10,
                'yoteimeter' => 0,
                'tanabango' => Carbon::now()->format('Y-m-d H:i:s'),
                'tantousyabango' => $bango
            ];

            //$syukkoold_result = QueryHelper::insertData('syukkoold', $syukkoold_insertable_data, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);

            $hikiatesyukko_insertable_data = [
                'kaiinid' => 'D7051',
                'datachar01' => 2,
                'datachar03' => '',
                'datachar04' => 2,
                'datachar05' => '',
                'datachar06' => 2,
                'datachar07' => '',
                'tantousyabango' => Carbon::now()->format('Y-m-d H:i:s'),
                'idoutanabango' => Carbon::now()->format('Y-m-d H:i:s'),
                'tantousyabango' => $bango,
                'datachar09' => 2,
                'datachar10' => 2
            ];

            $hikiatesyukko = QueryHelper::updateData('hikiatesyukko',$hikiatesyukko_update_data,'hanbaibukacd',$bango,__CLASS__,__FUNCTION__,__LINE__);

            
            // update review table

             $result['status'] = 'ok';
            // $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### unearned sales cancellation end\n";
            // QueryHandler::logger($bango, $log_data);
            // pg_query($conn, "COMMIT");

             session()->flash('success_msg', "発注番号 で登録しました");
             $result['success_msg'] = "発注番号 で登録しました";
             return $result;
    }


    
    // data pass from where tuhanorder.unsoudaibikitesuryou(ur00025) = 2
    private function insert2($bango, $request, $result){
        
    }


    private function createSalesNumber(){
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
        $sales_number = "09" . $orderbango2 . str_pad($orderbango, $mobile_flag, '0', STR_PAD_LEFT);

        return $sales_number;
    }


    // billing data and order data retrive after 101 onchange 
    public function billing_data_order_data_retrive(Request $request){
        $unearned_sales_cancellation_101 = $request->unearned_sales_cancellation_101;
            QueryHelper::runQuery("DROP TABLE IF EXISTS unearned_sales_cancel_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE unearned_sales_cancel_temp as
                                select                                 
                                tuhanorder.information1 as unearned_sales_cancellation_201,
                                tuhanorder.information2 as unearned_sales_cancellation_202,
                                tuhanorder.kessaihouhou as unearned_sales_cancellation_203,
                                tuhanorder.numeric3 as unearned_sales_cancellation_204
                                from orderhenkan
                                left join tuhanorder on tuhanorder.orderbango = orderhenkan.bango and tuhanorder.juchubango = orderhenkan.kokyakuorderbango
                                left join misyukko  on orderhenkan.bango = misyukko.orderbango and orderhenkan.kokyakuorderbango = misyukko.syouhinid
                                left join hikiatesyukko on hikiatesyukko.orderbango = orderhenkan.bango
                                join juchusyukko on misyukko.syouhinid = juchusyukko.syouhinid and misyukko.syouhinsyu = juchusyukko.syouhinsyu and misyukko.hantei = juchusyukko.hantei
                                join syukkoold on syukkoold.orderbango = orderhenkan.bango
                                where 
                                tuhanorder.juchukubun2 = '$unearned_sales_cancellation_101' and 
                                hikiatesyukko.dataint01 = 2 and 
                                syukkoold.kaiinid = tuhanorder.juchukubun2 and 
                                syukkoold.syouhinid = misyukko.syouhinid and  
                                syukkoold.syouhinsyu = misyukko.syouhinsyu and 
                                syukkoold.hantei = misyukko.hantei and 
                                tuhanorder.juchubango = misyukko.syouhinid and 
                                hikiatesyukko.datachar04 = '1' and 
                                hikiatesyukko.datachar16 = '2' and 
                                juchusyukko.datachar01 = '1' and 
                                misyukko.datachar21 = tuhanorder.datatxt0110 and 
                                tuhanorder.datatxt0122 = 'J310' and 
                                juchusyukko.hanbaibukacd = tuhanorder.datatxt0110 and 
                                juchusyukko.dataInt20 = tuhanorder.numeric5 and 
                                juchusyukko.dataChar25 = '1' and 
                                tuhanorder.datatxt0110::integer > 0 and 
                                -- 売上請求明細「UM0008商品CD」＞商品マスタHM0032商品分類３syukkoold.kawasename > syouhin1.data100
                                -- 定期定額契約「KY0024商品CD」＞商品マスタHM0032商品分類３
                                (tuhanorder.text1 = 'U510' or orderhenkan.datachar02 = 'U110' or tuhanorder.Text1 = 'U522' or orderhenkan.datachar02 = 'U122')");

            $query = DB::table('unearned_sales_cancel_temp')->toSql();
            $result = collect(QueryHelper::fetchResult($query));

            $output["status"] = "true";
            $output["msg"] = "billing_data_order_retrive_for_101";
            $output["result"] = $result;
            return $output;
    }
}