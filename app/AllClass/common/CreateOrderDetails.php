<?php

namespace App\AllClass\common;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use Carbon\Carbon;
use App\Helpers\Helper;
use Mail;
use App\Mail\SendMail;

Class CreateOrderDetails
{
    public static function data($bango, $kokyakuorderbango, $ordertypebango2, $datachar01, $page_no, $type = null, $datachar10 = null)
    {
        $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7401'");
        $review_orderbango = $reviewData->orderbango + 1;
        $orderNumber = STR_PAD($review_orderbango,10,'0',STR_PAD_LEFT);
        $original_ordertypebango2 = $ordertypebango2;
        
        if($type == 'sales_data'){
            $syukkooldData = QueryHelper::fetchResult("
            select syukkoold.*,
            (syukkoold.dataint18 - ((syukkoold.syukkasu*syukkoold.dataint05) + (syukkoold.syukkasu*syukkoold.dataint06) + (syukkoold.syukkasu*syukkoold.dataint07) + (syukkoold.syukkasu*syukkoold.dataint08)) - syukkoold.dataint16 ) as kr0030_10,
            juchusyukko.datachar01 as juchusyukko_datachar01
            from (select syouhinid,MAX(dataint01) as max_dataint01 from syukkoold group by syouhinid) as tmp_syukkoold
            join syukkoold on  syukkoold.syouhinid = tmp_syukkoold.syouhinid AND syukkoold.dataint01 = tmp_syukkoold.max_dataint01
            join juchusyukko
                on syukkoold.syouhinid = juchusyukko.syouhinid
                AND syukkoold.syouhinsyu = juchusyukko.syouhinsyu
                AND syukkoold.hantei = juchusyukko.hantei
            where syukkoold.syouhinid = '$kokyakuorderbango' 
            --AND syukkoold.dataint01 = $ordertypebango2
            ");
            
            if($datachar01 == 2){ //$datachar01 = 2 means edit data
                //set 1, red data=>copy
                $tmp_ordertypebango2 = $ordertypebango2 - 1;
                $rirekiData = QueryHelper::fetchResult("select * from rireki where kr0002 = '$datachar10' AND kr0005 = '$tmp_ordertypebango2'");
                self::createRedData($bango,$orderNumber,$kokyakuorderbango,$tmp_ordertypebango2,$rirekiData,2);

                //set 2, black data=>create
                $review_orderbango = $review_orderbango + 1;
                $orderNumber = STR_PAD($review_orderbango,10,'0',STR_PAD_LEFT);
                $ordertypebango2 = $ordertypebango2;
                foreach($syukkooldData as $key=>$val){
                    $kr0025 = $val->syukkasu;
                    if($val->dataint05 != 0){
                        $kr0007 = 'V120';
                        $kr0028 = $val->datachar02;
                        $kr0029 = $val->dataint05;
                        $kr0030 = $kr0025 * $kr0029;
                        $status = self::insertSalesHistoryDetails($bango,$page_no,$orderNumber,$kokyakuorderbango,$original_ordertypebango2,$ordertypebango2,$val,$kr0007,$kr0028,$kr0029,$kr0030,$datachar10);
                        if($status == 'db_error'){
                            return "db_error";
                        }
                    }
                    if($val->dataint06 != 0){
                        $kr0007 = 'V130';
                        $kr0028 = '0020';
                        $kr0029 = $val->dataint06;
                        $kr0030 = $kr0025 * $kr0029;
                        $status = self::insertSalesHistoryDetails($bango,$page_no,$orderNumber,$kokyakuorderbango,$original_ordertypebango2,$ordertypebango2,$val,$kr0007,$kr0028,$kr0029,$kr0030,$datachar10);
                        if($status == 'db_error'){
                            return "db_error";
                        }
                        if($status == 'db_error'){
                            return "db_error";
                        }
                    }
                    if($val->dataint07 != 0){
                        $kr0007 = 'V140';
                        $kr0028 = '0970';
                        $kr0029 = $val->dataint07;
                        $kr0030 = $kr0025 * $kr0029;
                        $status = self::insertSalesHistoryDetails($bango,$page_no,$orderNumber,$kokyakuorderbango,$original_ordertypebango2,$ordertypebango2,$val,$kr0007,$kr0028,$kr0029,$kr0030,$datachar10);
                        if($status == 'db_error'){
                            return "db_error";
                        }
                    }
                    if($val->dataint08 != 0){
                        $kr0007 = 'V150';
                        $kr0028 = $val->datachar01;
                        $kr0029 = $val->dataint08;
                        $kr0030 = $kr0025 * $kr0029;
                        $status = self::insertSalesHistoryDetails($bango,$page_no,$orderNumber,$kokyakuorderbango,$original_ordertypebango2,$ordertypebango2,$val,$kr0007,$kr0028,$kr0029,$kr0030,$datachar10);
                        if($status == 'db_error'){
                            return "db_error";
                        }
                    }
                    //if($val->dataint05 == 0 || $val->dataint06 == 0 || $val->dataint07 == 0 || $val->dataint08 == 0){
                    $kr0007 = 'V110';
                    $kr0028 = $val->datachar01;
                    $kr0030 = $val->kr0030_10;
                    $kr0029 = $kr0030 / $val->syukkasu;
                    $status = self::insertSalesHistoryDetails($bango,$page_no,$orderNumber,$kokyakuorderbango,$original_ordertypebango2,$ordertypebango2,$val,$kr0007,$kr0028,$kr0029,$kr0030,$datachar10);
                    if($status == 'db_error'){
                        return "db_error";
                    }
                    //}
                }
                
                //update kr0034 by sum_of_kr0032 when data_status = 2
                $data_status = session()->get('data_status'.$bango);
                if($data_status == 2){
                    $sum_of_kr0032 = QueryHelper::fetchSingleResult("select sum(kr0032) as sum_of_kr0032 from rireki where kr0000 = '$orderNumber' and kr0002 = '$kokyakuorderbango'")->sum_of_kr0032 ?? null;
                    //update rireki data
                    $rireki_update_data = [
                        'kr0000' => $orderNumber,
                        'kr0002' => $kokyakuorderbango,
                        'kr0034' => $sum_of_kr0032,
                    ];
                    QueryHelper::updateData('rireki', $rireki_update_data, ['kr0000' => $orderNumber,'kr0002'=>$kokyakuorderbango], $bango, __CLASS__, __FUNCTION__, __LINE__);
                }
                session()->forget('data_status'.$bango);

                //update review data
                $review_update_data = [
                    'kokyakusyouhinbango' => 'D7401',
                    'orderbango' => $review_orderbango,
                    'check_flag' => 0,
                    'color' => Carbon::now()->setTimezone("Asia/Tokyo")->format('YmdHis'),
                    'size' => Helper::getSystemIP(),
                    'nickname' => $bango,
                ];
                QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);

            }elseif($datachar01 == 3){
                //set 1, red data=>copy
                $tmp_ordertypebango2 = $ordertypebango2 - 1;
                $rirekiData = QueryHelper::fetchResult("select * from rireki where kr0002 = '$datachar10' AND kr0005 = '$tmp_ordertypebango2'");
                self::createRedData($bango,$orderNumber,$kokyakuorderbango,$tmp_ordertypebango2,$rirekiData,3);
            }else{
                foreach($syukkooldData as $key=>$val){
                    $kr0025 = $val->syukkasu;
                    if($val->dataint05 != 0){
                        $kr0007 = 'V120';
                        $kr0028 = $val->datachar02;
                        $kr0029 = $val->dataint05;
                        $kr0030 = $kr0025 * $kr0029;
                        $status = self::insertSalesHistoryDetails($bango,$page_no,$orderNumber,$kokyakuorderbango,$original_ordertypebango2,$ordertypebango2,$val,$kr0007,$kr0028,$kr0029,$kr0030,$datachar10);
                        if($status == 'db_error'){
                            return "db_error";
                        }
                    }
                    if($val->dataint06 != 0){
                        $kr0007 = 'V130';
                        $kr0028 = '0020';
                        $kr0029 = $val->dataint06;
                        $kr0030 = $kr0025 * $kr0029;
                        $status = self::insertSalesHistoryDetails($bango,$page_no,$orderNumber,$kokyakuorderbango,$original_ordertypebango2,$ordertypebango2,$val,$kr0007,$kr0028,$kr0029,$kr0030,$datachar10);
                        if($status == 'db_error'){
                            return "db_error";
                        }
                        if($status == 'db_error'){
                            return "db_error";
                        }
                    }
                    if($val->dataint07 != 0){
                        $kr0007 = 'V140';
                        $kr0028 = '0970';
                        $kr0029 = $val->dataint07;
                        $kr0030 = $kr0025 * $kr0029;
                        $status = self::insertSalesHistoryDetails($bango,$page_no,$orderNumber,$kokyakuorderbango,$original_ordertypebango2,$ordertypebango2,$val,$kr0007,$kr0028,$kr0029,$kr0030,$datachar10);
                        if($status == 'db_error'){
                            return "db_error";
                        }
                    }
                    if($val->dataint08 != 0){
                        $kr0007 = 'V150';
                        $kr0028 = $val->datachar01;
                        $kr0029 = $val->dataint08;
                        $kr0030 = $kr0025 * $kr0029;
                        $status = self::insertSalesHistoryDetails($bango,$page_no,$orderNumber,$kokyakuorderbango,$original_ordertypebango2,$ordertypebango2,$val,$kr0007,$kr0028,$kr0029,$kr0030,$datachar10);
                        if($status == 'db_error'){
                            return "db_error";
                        }
                    }
                    //if($val->dataint05 == 0 || $val->dataint06 == 0 || $val->dataint07 == 0 || $val->dataint08 == 0){
                    $kr0007 = 'V110';
                    $kr0028 = $val->datachar01;
                    $kr0030 = $val->kr0030_10;
                    $kr0029 = $kr0030 / $val->syukkasu;
                    $status = self::insertSalesHistoryDetails($bango,$page_no,$orderNumber,$kokyakuorderbango,$original_ordertypebango2,$ordertypebango2,$val,$kr0007,$kr0028,$kr0029,$kr0030,$datachar10);
                    if($status == 'db_error'){
                        return "db_error";
                    }
                    //}
                }

                //update kr0034 by sum_of_kr0032 when data_status = 2
                $data_status = session()->get('data_status'.$bango);
                if($data_status == 2){
                    $sum_of_kr0032 = QueryHelper::fetchSingleResult("select sum(kr0032) as sum_of_kr0032 from rireki where kr0000 = '$orderNumber' and kr0002 = '$kokyakuorderbango'")->sum_of_kr0032 ?? null;
                    //update rireki data
                    $rireki_update_data = [
                        'kr0000' => $orderNumber,
                        'kr0002' => $kokyakuorderbango,
                        'kr0034' => $sum_of_kr0032,
                    ];
                    QueryHelper::updateData('rireki', $rireki_update_data, ['kr0000' => $orderNumber,'kr0002'=>$kokyakuorderbango], $bango, __CLASS__, __FUNCTION__, __LINE__);
                }
                session()->forget('data_status'.$bango);
                
                //update review data
                $review_update_data = [
                    'kokyakusyouhinbango' => 'D7401',
                    'orderbango' => $review_orderbango,
                    'check_flag' => 0,
                    'color' => Carbon::now()->setTimezone("Asia/Tokyo")->format('YmdHis'),
                    'size' => Helper::getSystemIP(),
                    'nickname' => $bango,
                ];
                QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
            }
            
            //create actual data history
            self::createActualDataHistory($bango,$page_no);
            
        }else{
            $misyukkoData = QueryHelper::fetchResult("
            select misyukko.*,
            (misyukko.dataint18 - ((misyukko.syukkasu*misyukko.dataint05) + (misyukko.syukkasu*misyukko.dataint06) + (misyukko.syukkasu*misyukko.dataint07) + (misyukko.syukkasu*misyukko.dataint08)) - misyukko.dataint16 ) as kr0030_10,
            juchusyukko.datachar01 as juchusyukko_datachar01
            from misyukko 
            join juchusyukko
                on misyukko.syouhinid = juchusyukko.syouhinid
                AND misyukko.syouhinsyu = juchusyukko.syouhinsyu
                AND misyukko.hantei = juchusyukko.hantei
            where misyukko.syouhinid = '$kokyakuorderbango' AND misyukko.dataint01 = $ordertypebango2
            ");
            if($datachar01 == 2){
                //set 1, red data=>copy
                $tmp_ordertypebango2 = $ordertypebango2 - 1;
                $rirekiData = QueryHelper::fetchResult("select * from rireki where kr0002 = '$kokyakuorderbango' AND kr0005 = '$tmp_ordertypebango2'");
                self::createRedData($bango,$orderNumber,$kokyakuorderbango,$tmp_ordertypebango2,$rirekiData,2);

                //set 2, black data=>create
                $review_orderbango = $review_orderbango + 1;
                $orderNumber = STR_PAD($review_orderbango,10,'0',STR_PAD_LEFT);
                $ordertypebango2 = $ordertypebango2;
                foreach($misyukkoData as $key=>$val){
                    $kr0025 = $val->syukkasu;
                    if($val->dataint05 != 0){
                        $kr0007 = 'V120';
                        $kr0028 = $val->datachar02;
                        $kr0029 = $val->dataint05;
                        $kr0030 = $kr0025 * $kr0029;
                        $status = self::insertHistoryDetails($bango,$page_no,$orderNumber,$kokyakuorderbango,$ordertypebango2,$val,$kr0007,$kr0028,$kr0029,$kr0030);
                        if($status == 'db_error'){
                            return "db_error";
                        }
                    }
                    if($val->dataint06 != 0){
                        $kr0007 = 'V130';
                        $kr0028 = '0020';
                        $kr0029 = $val->dataint06;
                        $kr0030 = $kr0025 * $kr0029;
                        $status = self::insertHistoryDetails($bango,$page_no,$orderNumber,$kokyakuorderbango,$ordertypebango2,$val,$kr0007,$kr0028,$kr0029,$kr0030);
                        if($status == 'db_error'){
                            return "db_error";
                        }
                    }
                    if($val->dataint07 != 0){
                        $kr0007 = 'V140';
                        $kr0028 = '0970';
                        $kr0029 = $val->dataint07;
                        $kr0030 = $kr0025 * $kr0029;
                        $status = self::insertHistoryDetails($bango,$page_no,$orderNumber,$kokyakuorderbango,$ordertypebango2,$val,$kr0007,$kr0028,$kr0029,$kr0030);
                        if($status == 'db_error'){
                            return "db_error";
                        }
                    }
                    if($val->dataint08 != 0){
                        $kr0007 = 'V150';
                        $kr0028 = $val->datachar01;
                        $kr0029 = $val->dataint08;
                        $kr0030 = $kr0025 * $kr0029;
                        $status = self::insertHistoryDetails($bango,$page_no,$orderNumber,$kokyakuorderbango,$ordertypebango2,$val,$kr0007,$kr0028,$kr0029,$kr0030);
                        if($status == 'db_error'){
                            return "db_error";
                        }
                    }
                    //if($val->dataint05 == 0 || $val->dataint06 == 0 || $val->dataint07 == 0 || $val->dataint08 == 0){
                    $kr0007 = 'V110';
                    $kr0028 = $val->datachar01;
                    $kr0030 = $val->kr0030_10;
                    $kr0029 = $kr0030 / $val->syukkasu;
                    $status =  self::insertHistoryDetails($bango,$page_no,$orderNumber,$kokyakuorderbango,$ordertypebango2,$val,$kr0007,$kr0028,$kr0029,$kr0030);
                    if($status == 'db_error'){
                        return "db_error";
                    }
                    //}
                }
                
                //update kr0034 by sum_of_kr0032 when data_status = 2
                $data_status = session()->get('data_status'.$bango);
                if($data_status == 2){
                    $sum_of_kr0032 = QueryHelper::fetchSingleResult("select sum(kr0032) as sum_of_kr0032 from rireki where kr0000 = '$orderNumber' and kr0002 = '$kokyakuorderbango'")->sum_of_kr0032 ?? null;
                    //update rireki data
                    $rireki_update_data = [
                        'kr0000' => $orderNumber,
                        'kr0002' => $kokyakuorderbango,
                        'kr0034' => $sum_of_kr0032,
                    ];
                    QueryHelper::updateData('rireki', $rireki_update_data, ['kr0000' => $orderNumber,'kr0002'=>$kokyakuorderbango], $bango, __CLASS__, __FUNCTION__, __LINE__);
                }
                session()->forget('data_status'.$bango);

                //update review data
                $review_update_data = [
                    'kokyakusyouhinbango' => 'D7401',
                    'orderbango' => $review_orderbango,
                    'check_flag' => 0,
                    'color' => Carbon::now()->setTimezone("Asia/Tokyo")->format('YmdHis'),
                    'size' => Helper::getSystemIP(),
                    'nickname' => $bango,
                ];
                QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);

            }elseif($datachar01 == 3){
                //set 1, red data=>copy
                $tmp_ordertypebango2 = $ordertypebango2 - 1;
                $rirekiData = QueryHelper::fetchResult("select * from rireki where kr0002 = '$kokyakuorderbango' AND kr0005 = '$tmp_ordertypebango2'");
                self::createRedData($bango,$orderNumber,$kokyakuorderbango,$tmp_ordertypebango2,$rirekiData,3);
                
                //update orderhenkan data
                $orderhenkan_update_data = [
                    'kokyakuorderbango' => $kokyakuorderbango,
                    'ordertypebango2' => $ordertypebango2,
                    'ordertypebango' => 1,
                ];
                QueryHelper::updateData('orderhenkan', $orderhenkan_update_data, ['kokyakuorderbango'=>$kokyakuorderbango,'ordertypebango2'=>$ordertypebango2], $bango, __CLASS__, __FUNCTION__, __LINE__);
                
            }else{
                //$ordertypebango2 = ($datachar01 == 3 ? $ordertypebango2 - 1 : $ordertypebango2);
                foreach($misyukkoData as $key=>$val){
                    $kr0025 = $val->syukkasu;
                    if($val->dataint05 != 0){
                        $kr0007 = 'V120';
                        $kr0028 = $val->datachar02;
                        $kr0029 = $val->dataint05;
                        $kr0030 = $kr0025 * $kr0029;
                        $status = self::insertHistoryDetails($bango,$page_no,$orderNumber,$kokyakuorderbango,$ordertypebango2,$val,$kr0007,$kr0028,$kr0029,$kr0030);
                        if($status == 'db_error'){
                            return "db_error";
                        }
                    }
                    if($val->dataint06 != 0){
                        $kr0007 = 'V130';
                        $kr0028 = '0020';
                        $kr0029 = $val->dataint06;
                        $kr0030 = $kr0025 * $kr0029;
                        $status = self::insertHistoryDetails($bango,$page_no,$orderNumber,$kokyakuorderbango,$ordertypebango2,$val,$kr0007,$kr0028,$kr0029,$kr0030);
                        if($status == 'db_error'){
                            return "db_error";
                        }
                    }
                    if($val->dataint07 != 0){
                        $kr0007 = 'V140';
                        $kr0028 = '0970';
                        $kr0029 = $val->dataint07;
                        $kr0030 = $kr0025 * $kr0029;
                        $status = self::insertHistoryDetails($bango,$page_no,$orderNumber,$kokyakuorderbango,$ordertypebango2,$val,$kr0007,$kr0028,$kr0029,$kr0030);
                        if($status == 'db_error'){
                            return "db_error";
                        }
                    }
                    if($val->dataint08 != 0){
                        $kr0007 = 'V150';
                        $kr0028 = $val->datachar01;
                        $kr0029 = $val->dataint08;
                        $kr0030 = $kr0025 * $kr0029;
                        $status = self::insertHistoryDetails($bango,$page_no,$orderNumber,$kokyakuorderbango,$ordertypebango2,$val,$kr0007,$kr0028,$kr0029,$kr0030);
                        if($status == 'db_error'){
                            return "db_error";
                        }
                    }
                    //if($val->dataint05 == 0 || $val->dataint06 == 0 || $val->dataint07 == 0 || $val->dataint08 == 0){
                    $kr0007 = 'V110';
                    $kr0028 = $val->datachar01;
                    $kr0030 = $val->kr0030_10;
                    $kr0029 = $kr0030 / $val->syukkasu;
                    $status = self::insertHistoryDetails($bango,$page_no,$orderNumber,$kokyakuorderbango,$ordertypebango2,$val,$kr0007,$kr0028,$kr0029,$kr0030);
                    if($status == 'db_error'){
                        return "db_error";
                    }
                    //}
                }

                //update kr0034 by sum_of_kr0032 when data_status = 2
                $data_status = session()->get('data_status'.$bango);
                if($data_status == 2){
                    $sum_of_kr0032 = QueryHelper::fetchSingleResult("select sum(kr0032) as sum_of_kr0032 from rireki where kr0000 = '$orderNumber' and kr0002 = '$kokyakuorderbango'")->sum_of_kr0032 ?? null;
                    //update rireki data
                    $rireki_update_data = [
                        'kr0000' => $orderNumber,
                        'kr0002' => $kokyakuorderbango,
                        'kr0034' => $sum_of_kr0032,
                    ];
                    QueryHelper::updateData('rireki', $rireki_update_data, ['kr0000' => $orderNumber,'kr0002'=>$kokyakuorderbango], $bango, __CLASS__, __FUNCTION__, __LINE__);
                }
                session()->forget('data_status'.$bango);
               
                //update review data
                $review_update_data = [
                    'kokyakusyouhinbango' => 'D7401',
                    'orderbango' => $review_orderbango,
                    'check_flag' => 0,
                    'color' => Carbon::now()->setTimezone("Asia/Tokyo")->format('YmdHis'),
                    'size' => Helper::getSystemIP(),
                    'nickname' => $bango,
                ];
                QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
            }
            
            //create actual data history
            self::createActualDataHistory($bango,$page_no);
            
        }   
    }
    
    public static function insertHistoryDetails($bango,$page_no,$orderNumber,$kokyakuorderbango,$ordertypebango2,$val,$kr0007,$kr0028,$kr0029,$kr0030)
    {
        try{
            $orderhenkanData = QueryHelper::fetchSingleResult("
                select 
                orderhenkan.*,
                tuhanorder.information1,
                tuhanorder.information2,
                tuhanorder.information3,
                tuhanorder.information4,
                tuhanorder.information5,
                tuhanorder.otodoketime,
                tuhanorder.money10,
                tuhanorder.housoukubun,
                hikiatesyukko.datachar04 as hikiatesyukko_datachar04
                from (select kokyakuorderbango,max(ordertypebango2) as max_ordertypebango2 from orderhenkan where datachar10 is null group by kokyakuorderbango) as tmp_orderhenkan
                join orderhenkan on orderhenkan.kokyakuorderbango = tmp_orderhenkan.kokyakuorderbango and orderhenkan.ordertypebango2 = tmp_orderhenkan.max_ordertypebango2
                join tuhanorder on tuhanorder.orderbango = orderhenkan.bango and tuhanorder.juchubango = orderhenkan.kokyakuorderbango
                join hikiatesyukko on hikiatesyukko.orderbango = orderhenkan.bango
                where orderhenkan.kokyakuorderbango = '$kokyakuorderbango' 
                --AND ordertypebango2 = $ordertypebango2
                ");
            //dd($orderhenkanData,$ordertypebango2,$kokyakuorderbango);
            $kawasename = $val->kawasename;
            $productData = QueryHelper::fetchSingleResult("select   
                            syouhin1.*,
                            syouhin2.jouhou2,
                            syouhin4.syouhingroup,
                            syouhin4.ruijihinbango
                            from syouhin1 
                            join syouhin2 on syouhin2.bango = syouhin1.bango
                            join syouhin4 on syouhin4.bango = syouhin1.bango
                            where kokyakusyouhinbango = '$kawasename'");
            //dd("testing cholche..",$productData);
            if($productData){
                $kr0093 = $productData->jouhou;
                $kr0095 = $productData->koyuujouhou;
                $kr0097 = $productData->color;
                $kr0099 = $productData->bumon;
                $kr0101 = $productData->jouhou2;
                $tmp_kr0103 = $productData->data23;
                $kr0103 = explode(' ',$tmp_kr0103)[0];
                $kr0104 = explode(' ',$tmp_kr0103)[1];
                $kr0105 = $productData->data52;
                $kr0107 = $productData->data53;
                $kr0109 = $productData->data54;
                $kr0111 = $productData->data100;
                $kr0113 = $productData->synchrosyouhinbango;
                $kr0114 = $productData->data26;
                $kr0116 = $productData->syouhingroup;
                $kr0117 = $productData->ruijihinbango;
            }else{
                $kr0093 = null;
                $kr0095 = null;
                $kr0097 = null;
                $kr0099 = null;
                $kr0101 = null;
                $kr0103 = null;
                $kr0104 = null;
                $kr0105 = null;
                $kr0107 = null;
                $kr0109 = null;
                $kr0111 = null;
                $kr0113 = null;
                $kr0114 = null;
                $kr0116 = null;
                $kr0117 = null;
            }
            $kr0085 = self::getTantousyaData($kr0028,'datatxt0003');
            $kr0087 = self::getTantousyaData($kr0028,'datatxt0004');
            $kr0089 = self::getTantousyaData($kr0028,'datatxt0005');
            $otodoketime = $orderhenkanData->otodoketime;
            $money10 = $orderhenkanData->money10;
            $taxAmount = self::calculateConsumptionTax($bango,$orderhenkanData->information2,$otodoketime,$val->syouhinid,$money10,$val->dataint18,$val->syukkasu,$val->dataint04);
            $kr0032 = $taxAmount['kr0032'];
            $kr0034 = $taxAmount['kr0034'];
            
            if($val->barcode != null){
                $arr = explode(" ",$val->barcode);
                $barcode_cd = $arr[0];
                unset($arr[0]);
                $barcode_name = implode(" ",$arr);
            }else{
                $barcode_cd = null;
                $barcode_name = null;
            }
            
            $kokyakuCode = substr($orderhenkanData->information2, 0,6);
            $haisouCode = substr($orderhenkanData->information2, 6,2);
            $kokyaku = QueryHelper::select(['bango,mallsoukobango1,ytoiawseend'])->from('kokyaku1')->where("yobi12 = '$kokyakuCode' ")->get()->first();
            $haisoujouhou = QueryHelper::select(['bunrui3'])->from('haisoujouhou')->where("syukei1 = '$kokyaku->bango' ")->get()->first();
            $others2 = QueryHelper::fetchResult("select other1,other24,other4 from others2 where otherint1 = (select bango from haisou where haisou.shikibetsucode = '$kokyakuCode' and haisou.torihikisakibango = '$haisouCode')");
            if(explode(' ', $others2[0]->other1)[0] == '1'){
                //$kr0042 = $haisoujouhou->bunrui3;
                $kr0042 = $kokyaku->ytoiawseend;
            }else{
                $kr0042 = $others2[0]->other4;
            }
            
            $tmp_kr0091 = self::getTantousyaData($kr0028,'syozoku');
            $kr0091 = explode(' ',$tmp_kr0091)[0];
            //$kr0092 = explode(' ',$tmp_kr0091)[1];
            
            $kr0092 = self::getCategoryData($kr0089,'patternsub2');
            if($kr0092 != null){
               $kr0092 = substr($kr0092,0,2); 
            }
            
            $rireki_insert_data = [
                'kr0000' => $orderNumber,
                //'kr0001' => 'V820',
                'kr0001' => 'V810',
                'kr0002' => $kokyakuorderbango,
                'kr0003' => $val->syouhinsyu,
                'kr0004' => $val->hantei,
                'kr0005' => $ordertypebango2,
                'kr0006' => 1,
                'kr0007' => $kr0007,
                'kr0008' => $orderhenkanData->datachar02,
                'kr0009' => $val->datachar13,
                'kr0010' => $orderhenkanData->datachar05,
                'kr0011' => $orderhenkanData->information1,
                'kr0012' => $orderhenkanData->information2,
                'kr0013' => $orderhenkanData->information3,
                'kr0014' => $orderhenkanData->information4,
                'kr0015' => $orderhenkanData->information5,
                'kr0016' => $val->datachar05,
                'kr0017' => $val->kawasename,
                'kr0018' => $val->syouhinname,
                'kr0019' => $val->datachar14,
                'kr0020' => $barcode_cd,
                'kr0021' => $barcode_name,
                'kr0022' => $val->datachar03,
                'kr0023' => $val->datachar04,
                'kr0024' => $val->dataint04,
                'kr0025' => $val->syukkasu,
                'kr0026' => $val->codename,
                'kr0027' => $val->dataint18,
                'kr0028' => $kr0028,
                'kr0029' => $kr0029,
                'kr0030' => $kr0030,
                'kr0031' => $otodoketime,
                'kr0032' => $kr0032,
                'kr0033' => $money10,
                'kr0034' => $kr0034,
                'kr0035' => Carbon::now()->format('Y-m-d'),
                'kr0036' => $orderhenkanData->intorder01 == null ? null : strftime ( '%Y-%m-%d' , strtotime($orderhenkanData->intorder01))." 00:00:00",
                'kr0037' => $val->dataint09 == null ? null : strftime ( '%Y-%m-%d' , strtotime($val->dataint09))." 00:00:00",
                'kr0038' => $val->dataint10 == null ? null : strftime ( '%Y-%m-%d' , strtotime($val->dataint10))." 00:00:00",
                'kr0039' => $orderhenkanData->intorder04 == null ? null : strftime ( '%Y-%m-%d' , strtotime($orderhenkanData->intorder04))." 00:00:00",
                'kr0040' => $orderhenkanData->intorder03 == null ? null : strftime ( '%Y-%m-%d' , strtotime($orderhenkanData->intorder03))." 00:00:00",
                'kr0041' => $orderhenkanData->intorder05 == null ? null : strftime ( '%Y-%m-%d' , strtotime($orderhenkanData->intorder05))." 00:00:00",
                'kr0042' => $kr0042,
                'kr0043' => $orderhenkanData->housoukubun,
                'kr0044' => $val->datachar09,
                'kr0045' => $val->datachar15,
                'kr0046' => $val->datachar16,
                'kr0047' => $val->datachar17,
                'kr0048' => $val->datachar12,
                'kr0049' => null,
                'kr0050' => null,
                'kr0051' => null,
                'kr0052' => null,
                'kr0053' => null,
                'kr0054' => null,
                'kr0055' => null,
                'kr0056' => null,
                'kr0057' => $kokyakuorderbango,
                'kr0058' => $val->syouhinsyu,
                'kr0059' => $val->hantei,
                'kr0060' => $ordertypebango2,
                'kr0061' => null,
                'kr0062' => null,
                'kr0063' => null,
                'kr0064' => null,
                'kr0065' => $orderhenkanData->hikiatesyukko_datachar04,
                'kr0066' => null,
                'kr0067' => $val->juchusyukko_datachar01,
                'kr0068' => null,
                'kr0069' => ($kr0007 == 50 || $kr0007 == 60) ? 9 : 2,
                'kr0070' => 0,
                'kr0071' => 2,
                'kr0072' => $val->yoteimeter,
                'kr0073' => $val->dataint17,
                'kr0074' => null,
                'kr0075' => null,
                'kr0076' => null,
                'kr0077' => null,
                'kr0078' => null,
                'kr0079' => null,
                'kr0080' => null,
                'kr0081' => null,
                'kr0082' => Carbon::now()->format('Y-m-d H:i:s'),
                'kr0083' => $val->tantousyabango,
                'kr0084' => substr($kokyakuorderbango,2,2),
                'kr0085' => $kr0085,
                'kr0086' => self::getCategoryData($kr0085),
                'kr0087' => $kr0087,
                'kr0088' => self::getCategoryData($kr0087),
                'kr0089' => $kr0089,
                'kr0090' => self::getCategoryData($kr0089),
                'kr0091' => $kr0091,
                'kr0092' => $kr0092,
                'kr0093' => $kr0093,
                'kr0094' => self::getCategoryData($kr0093),
                'kr0095' => $kr0095,
                'kr0096' => self::getCategoryData($kr0095),
                'kr0097' => $kr0097,
                'kr0098' => self::getCategoryData($kr0097),
                'kr0099' => $kr0099,
                'kr0100' => self::getCategoryData($kr0099),
                'kr0101' => $kr0101,
                'kr0102' => self::getCategoryData($kr0101),
                'kr0103' => $kr0103,
                'kr0104' => $kr0104,
                'kr0105' => $kr0105,
                'kr0106' => self::getCategoryData($kr0105),
                'kr0107' => $kr0107,
                'kr0108' => self::getCategoryData($kr0107),
                'kr0109' => $kr0109,
                'kr0110' => self::getCategoryData($kr0109),
                'kr0111' => $kr0111,
                'kr0112' => self::getCategoryData($kr0111),
                'kr0113' => $kr0113,
                'kr0114' => $kr0114,
                'kr0115' => self::getCategoryData($kr0114),
                'kr0116' => $kr0116,
                'kr0117' => $kr0117,
                'kr0118' => $orderhenkanData->datachar01,
            ];
            $rireki = QueryHelper::insertData('rireki',$rireki_insert_data,'kr0000',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
            
            //update orderhenkan data
            $orderhenkan_update_data = [
                'kokyakuorderbango' => $kokyakuorderbango,
                'ordertypebango2' => $ordertypebango2,
                'ordertypebango' => 1,
            ];
            QueryHelper::updateData('orderhenkan', $orderhenkan_update_data, ['kokyakuorderbango'=>$kokyakuorderbango,'ordertypebango2'=>$ordertypebango2], $bango, __CLASS__, __FUNCTION__, __LINE__);
            
            return "ok";
        } catch (\Exception $e) {
            $pattern = "";
            if($page_no == '02-01' || $page_no == '03-04'){
                $pattern = '01';
            }elseif($page_no == '04-03'){
               $pattern = '02'; 
            }
            $email_subject = "エラー：「0205受注売上→履歴データ作成」　".$kokyakuorderbango;
            $toMail = 'likhon.colgisbd@gmail.com';
            //$fromMail = 'rhklikhon@gmail.com';
            $fromMail = env('MAIL_FROM');
            $sender_name = '';
            $html = '<p>'.$kokyakuorderbango.'より「0205受注売上→履歴データ作成」でエラーが発生しております</p>';
            $html .= '<p> 発生時刻 = '.Carbon::now()->format("Y/m/d H:i:s").'</p>';
            $html .= '<p>エラー詳細</p>';
            $html .= '<p>エラー、該当データは※番号-訂正回数'.$kokyakuorderbango.'-'.$pattern.' です。</p>';
            Mail::send(new SendMail($email_subject,$toMail,$fromMail,$sender_name,$html));
            if (count(Mail::failures()) > 0) {
                return (Mail::failures());
            };
            return "db_error";
        }
    }
    
    public static function insertSalesHistoryDetails($bango,$page_no,$orderNumber,$kokyakuorderbango,$original_ordertypebango2,$ordertypebango2,$val,$kr0007,$kr0028,$kr0029,$kr0030,$datachar10)
    {
        try{
            $dataint02 = $val->dataint02;
            $misyukkoData = QueryHelper::fetchSingleResult("
                select 
                misyukko.datachar22,
                misyukko.datachar15,
                misyukko.datachar16,
                misyukko.datachar17,
                misyukko.dataint17
                from misyukko
                where misyukko.syouhinid = '$kokyakuorderbango' 
                AND misyukko.dataint02 = $dataint02
                ");
            
            $orderhenkanData = QueryHelper::fetchSingleResult("
                select 
                orderhenkan.*,
                tuhanorder.information1,
                tuhanorder.information2,
                tuhanorder.information3,
                tuhanorder.information4,
                tuhanorder.information5,
                tuhanorder.otodoketime,
                tuhanorder.money10,
                tuhanorder.housoukubun,
                tuhanorder.unsoudaibikitesuryou,
                tuhanorder.unsoutesuryou,
                tuhanorder.text1,
                tuhanorder.text2,
                hikiatesyukko.datachar04 as hikiatesyukko_datachar04
                from (select kokyakuorderbango,max(ordertypebango2) as max_ordertypebango2 from orderhenkan where datachar10 is not null group by kokyakuorderbango) as tmp_orderhenkan
                join orderhenkan on orderhenkan.kokyakuorderbango = tmp_orderhenkan.kokyakuorderbango and orderhenkan.ordertypebango2 = tmp_orderhenkan.max_ordertypebango2
                join tuhanorder on tuhanorder.orderbango = orderhenkan.bango and tuhanorder.juchubango = orderhenkan.kokyakuorderbango
                join hikiatesyukko on hikiatesyukko.orderbango = orderhenkan.bango
                where orderhenkan.kokyakuorderbango = '$kokyakuorderbango' 
                --AND ordertypebango2 = $ordertypebango2
                ");
            //dd($orderhenkanData,$ordertypebango2,$kokyakuorderbango);
            $kawasename = $val->kawasename;
            $productData = QueryHelper::fetchSingleResult("select   
                            syouhin1.*,
                            syouhin2.jouhou2,
                            syouhin4.syouhingroup,
                            syouhin4.ruijihinbango
                            from syouhin1 
                            join syouhin2 on syouhin2.bango = syouhin1.bango
                            join syouhin4 on syouhin4.bango = syouhin1.bango
                            where kokyakusyouhinbango = '$kawasename'");
            //dd("testing cholche..",$productData);
            if($productData){
                $kr0016 = $productData->season;
                $kr0093 = $productData->jouhou;
                $kr0095 = $productData->koyuujouhou;
                $kr0097 = $productData->color;
                $kr0099 = $productData->bumon;
                $kr0101 = $productData->jouhou2;
                $tmp_kr0103 = $productData->data23;
                $kr0103 = explode(' ',$tmp_kr0103)[0];
                $kr0104 = explode(' ',$tmp_kr0103)[1];
                $kr0105 = $productData->data52;
                $kr0107 = $productData->data53;
                $kr0109 = $productData->data54;
                $kr0111 = $productData->data100;
                $kr0113 = $productData->synchrosyouhinbango;
                $kr0114 = $productData->data26;
                $kr0116 = $productData->syouhingroup;
                $kr0117 = $productData->ruijihinbango;
            }else{
                $kr0016 = null;
                $kr0093 = null;
                $kr0095 = null;
                $kr0097 = null;
                $kr0099 = null;
                $kr0101 = null;
                $kr0103 = null;
                $kr0104 = null;
                $kr0105 = null;
                $kr0107 = null;
                $kr0109 = null;
                $kr0111 = null;
                $kr0113 = null;
                $kr0114 = null;
                $kr0116 = null;
                $kr0117 = null;
            }
            $kr0085 = self::getTantousyaData($kr0028,'datatxt0003');
            $kr0087 = self::getTantousyaData($kr0028,'datatxt0004');
            $kr0089 = self::getTantousyaData($kr0028,'datatxt0005');
            $kr0092 = self::getCategoryData($kr0089,'patternsub2');
            if($kr0092 != null){
               $kr0092 = substr($kr0092,0,2); 
            }
            //$datachar10 = $orderhenkanData->datachar10;
            $otodoketime = $orderhenkanData->otodoketime;
            $money10 = $orderhenkanData->money10;
            $taxAmount = self::calculateConsumptionTax($bango,$orderhenkanData->information2,$otodoketime,$val->syouhinid,$money10,$val->dataint18,$val->syukkasu,$val->dataint04);
            $kr0032 = $taxAmount['kr0032'];
            $kr0034 = $taxAmount['kr0034'];
            
            if($val->barcode != null){
                $arr = explode(" ",$val->barcode);
                $barcode_cd = $arr[0];
                unset($arr[0]);
                $barcode_name = implode(" ",$arr);
            }else{
                $barcode_cd = null;
                $barcode_name = null;
            }
            
            $kokyakuCode = substr($orderhenkanData->information2, 0,6);
            $haisouCode = substr($orderhenkanData->information2, 6,2);
            $kokyaku = QueryHelper::select(['bango,mallsoukobango1,ytoiawseend'])->from('kokyaku1')->where("yobi12 = '$kokyakuCode' ")->get()->first();
            $haisoujouhou = QueryHelper::select(['bunrui3'])->from('haisoujouhou')->where("syukei1 = '$kokyaku->bango' ")->get()->first();
            $others2 = QueryHelper::fetchResult("select other1,other24,other4 from others2 where otherint1 = (select bango from haisou where haisou.shikibetsucode = '$kokyakuCode' and haisou.torihikisakibango = '$haisouCode')");
            if(explode(' ', $others2[0]->other1)[0] == '1'){
                //$kr0042 = $haisoujouhou->bunrui3;
                $kr0042 = $kokyaku->ytoiawseend;
            }else{
                $kr0042 = $others2[0]->other4;
            }
            
            $tmp_kr0091 = self::getTantousyaData($kr0028,'syozoku');
            $kr0091 = explode(' ',$tmp_kr0091)[0];
            
            
            if($misyukkoData && ($misyukkoData->datachar22 != null && substr($misyukkoData->datachar22,0,1) == '1')){
//                $orderhenkanData = QueryHelper::fetchSingleResult("
//                select 
//                orderhenkan.*,
//                tuhanorder.information2,
//                tuhanorder.unsoudaibikitesuryou,
//                tuhanorder.unsoutesuryou
//                from (select kokyakuorderbango,max(ordertypebango2) as max_ordertypebango2 from orderhenkan where datachar10 is not null group by kokyakuorderbango) as tmp_orderhenkan
//                join orderhenkan on orderhenkan.kokyakuorderbango = tmp_orderhenkan.kokyakuorderbango and orderhenkan.ordertypebango2 = tmp_orderhenkan.max_ordertypebango2
//                join tuhanorder on tuhanorder.orderbango = orderhenkan.bango and tuhanorder.juchubango = orderhenkan.kokyakuorderbango
//                --where orderhenkan.orderuserbango = '$kokyakuorderbango' 
//                where orderhenkan.kokyakuorderbango = '$kokyakuorderbango' 
//                AND orderhenkan.datachar02 = 'V413'
//                ");
                QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_m");
                QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_m as
                select distinct 
                kokyakuorderbango, max(ordertypebango2) as maxval
                from orderhenkan
                where synchroorderbango = 0 
                and datachar10 = '$datachar10'
                group by kokyakuorderbango");
                $orderhenkanData = QueryHelper::fetchSingleResult("
                select 
                orderhenkan.kokyakuorderbango as order_kokyakuorderbango,
                orderhenkan_tmp.*,
                --orderhenkan_tmp.intorder03 as order_intorder03,
                tuhanorder.information2,
                tuhanorder.unsoudaibikitesuryou,
                tuhanorder.unsoutesuryou
                from (select kokyakuorderbango,max(ordertypebango2) as max_ordertypebango2 from orderhenkan group by kokyakuorderbango) as tmp_orderhenkan
                join orderhenkan on orderhenkan.kokyakuorderbango = tmp_orderhenkan.kokyakuorderbango and orderhenkan.ordertypebango2 = tmp_orderhenkan.max_ordertypebango2
                join orderhenkan as orderhenkan_tmp on orderhenkan_tmp.kokyakuorderbango = orderhenkan.orderuserbango
                left join orderhenkan_m on orderhenkan_tmp.kokyakuorderbango = orderhenkan_m.kokyakuorderbango
                    and orderhenkan_tmp.ordertypebango2 = orderhenkan_m.maxval
                join tuhanorder on tuhanorder.orderbango = orderhenkan_tmp.bango and tuhanorder.juchubango = orderhenkan_tmp.kokyakuorderbango
                where orderhenkan.orderuserbango = '$kokyakuorderbango' 
                AND orderhenkan.datachar02 = 'V413'
                ");
                //dd($orderhenkanData);
                if($orderhenkanData){
                    $minyukoData = QueryHelper::fetchSingleResult("
                    select 
                    minyuko.*
                    from minyuko
                    where minyuko.syouhinid = '$orderhenkanData->order_kokyakuorderbango' 
                    --AND minyuko.zaikometer = $original_ordertypebango2
                    AND minyuko.zaikometer = 0
                    ");
                    //dd($minyukoData);
                    if($minyukoData)
                    {
                        if(substr($orderhenkanData->datachar02,2,2) != 13){
                            $kr0071 = 2;
                        }elseif(substr($orderhenkanData->datachar02,2,2) == 13 && $orderhenkanData->intorder04 == 1){
                            $kr0071 = 9;
                        }else{
                            $kr0071 = null;
                        }
                        $rireki_insert_data = [
                            'kr0000' => $orderNumber,
                            'kr0001' => 'V820',
                            'kr0002' => $minyukoData->syouhinid,
                            'kr0003' => $original_ordertypebango2,
                            'kr0004' => $minyukoData->hantei,
                            'kr0005' => $minyukoData->zaikometer,
                            'kr0006' => 1,
                            'kr0007' => $minyukoData->datachar01,
                            'kr0008' => $orderhenkanData->datachar02,
                            'kr0009' => $minyukoData->datachar13,
                            'kr0010' => $orderhenkanData->datachar09,
                            'kr0011' => $orderhenkanData->datachar10,
                            'kr0012' => $orderhenkanData->information2,
                            'kr0013' => $orderhenkanData->datachar11,
                            'kr0014' => null,
                            'kr0015' => null,
                            'kr0016' => $orderhenkanData->datachar08,
                            'kr0017' => $minyukoData->datachar02,
                            'kr0018' => $minyukoData->datachar03,
                            'kr0019' => $minyukoData->dataint20,
                            'kr0020' => $minyukoData->datachar04,
                            'kr0021' => $minyukoData->datachar05,
                            'kr0022' => $minyukoData->datachar07,
                            'kr0023' => $minyukoData->datachar08,
                            'kr0024' => $minyukoData->kingaku,
                            'kr0025' => $minyukoData->nyukosu,
                            'kr0026' => $minyukoData->datachar06,
                            'kr0027' => $minyukoData->syouhizeiritu,
                            'kr0028' => $minyukoData->datachar13,
                            'kr0029' => $minyukoData->genka,
                            'kr0030' => $minyukoData->syouhizeiritu,
                            'kr0031' => $minyukoData->datachar18,
                            'kr0032' => $minyukoData->soukobango,
                            'kr0033' => $orderhenkanData->intorder01,
                            'kr0034' => $orderhenkanData->intorder02,
                            'kr0035' => Carbon::now()->format('Y-m-d'),
                            'kr0036' => null,
                            'kr0037' => $orderhenkanData->date,
                            'kr0038' => $minyukoData->yoteibi,
                            'kr0039' => null,
                            'kr0040' => $orderhenkanData->intorder03 == null ? null : strftime ( '%Y-%m-%d' , strtotime($orderhenkanData->intorder03))." 00:00:00",
                            'kr0041' => $orderhenkanData->intorder05 == null ? null : strftime ( '%Y-%m-%d' , strtotime($orderhenkanData->intorder05))." 00:00:00",
                            'kr0042' => $orderhenkanData->datachar08,
                            'kr0043' => null,
                            'kr0044' => $minyukoData->datachar10,
                            'kr0045' => $misyukkoData->datachar15,
                            'kr0046' => $misyukkoData->datachar16,
                            'kr0047' => $misyukkoData->datachar17,
                            'kr0048' => null,
                            'kr0049' => null,
                            'kr0050' => null,
                            'kr0051' => $orderhenkanData->unsoudaibikitesuryou,
                            'kr0052' => $orderhenkanData->unsoutesuryou,
                            'kr0053' => null,
                            'kr0054' => null,
                            'kr0055' => null,
                            'kr0056' => null,
                            'kr0057' => $orderhenkanData->orderuserbango,
                            'kr0058' => $minyukoData->yoteimeter,
                            'kr0059' => $minyukoData->nyukometer,
                            'kr0060' => $original_ordertypebango2,
                            'kr0061' => $orderhenkanData->datachar10,
                            'kr0062' => null,
                            'kr0063' => null,
                            'kr0064' => null,
                            'kr0065' => null,
                            'kr0065' => null,
                            'kr0066' => null,
                            'kr0067' => null,
                            'kr0067' => null,
                            'kr0068' => null,
                            'kr0069' => ($kr0007 == 50 || $kr0007 == 60) ? 9 : 2,
                            'kr0070' => 0,
                            'kr0071' => $kr0071,
                            'kr0072' => $orderhenkanData->synchroorderbango2,
                            'kr0073' => $misyukkoData->dataint17,
                            'kr0074' => null,
                            'kr0075' => null,
                            'kr0076' => null,
                            'kr0077' => null,
                            'kr0078' => null,
                            'kr0079' => null,
                            'kr0080' => null,
                            'kr0081' => null,
                            'kr0082' => Carbon::now()->format('Y-m-d H:i:s'),
                            'kr0083' => $orderhenkanData->datatxt0155,
                            //'kr0084' => substr($original_ordertypebango2,2,2),
                            'kr0085' => $kr0085,
                            'kr0086' => self::getCategoryData($kr0085),
                            'kr0087' => $kr0087,
                            'kr0088' => self::getCategoryData($kr0087),
                            'kr0089' => $kr0089,
                            'kr0090' => self::getCategoryData($kr0089),
                            'kr0091' => $kr0091,
                            'kr0092' => $kr0092,
                            'kr0093' => $kr0093,
                            'kr0094' => self::getCategoryData($kr0093),
                            'kr0095' => $kr0095,
                            'kr0096' => self::getCategoryData($kr0095),
                            'kr0097' => $kr0097,
                            'kr0098' => self::getCategoryData($kr0097),
                            'kr0099' => $kr0099,
                            'kr0100' => self::getCategoryData($kr0099),
                            'kr0101' => $kr0101,
                            'kr0102' => self::getCategoryData($kr0101),
                            'kr0103' => $kr0103,
                            'kr0104' => $kr0104,
                            'kr0105' => $kr0105,
                            'kr0106' => self::getCategoryData($kr0105),
                            'kr0107' => $kr0107,
                            'kr0108' => self::getCategoryData($kr0107),
                            'kr0109' => $kr0109,
                            'kr0110' => self::getCategoryData($kr0109),
                            'kr0111' => $kr0111,
                            'kr0112' => self::getCategoryData($kr0111),
                            'kr0113' => $kr0113,
                            'kr0114' => $kr0114,
                            'kr0115' => self::getCategoryData($kr0114),
                            'kr0116' => $kr0116,
                            'kr0117' => $kr0117,
                            'kr0118' => $orderhenkanData->intorder04,
                        ];
                        $rireki = QueryHelper::insertData('rireki',$rireki_insert_data,'kr0000',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                        //dd($minyukoData,"Need to confirmation if gets more row..");
                    }
                }
            }else{
                $rireki_insert_data = [
                    'kr0000' => $orderNumber,
                    'kr0001' => 'V820',
                    'kr0002' => $datachar10,
                    'kr0003' => $val->syouhinsyu,
                    'kr0004' => $val->hantei,
                    'kr0005' => $ordertypebango2,
                    'kr0006' => 1,
                    'kr0007' => $kr0007,
                    'kr0008' => $orderhenkanData->text1,
                    'kr0009' => $val->datachar13,
                    'kr0010' => $orderhenkanData->text2,
                    'kr0011' => $orderhenkanData->information1,
                    'kr0012' => $orderhenkanData->information2,
                    'kr0013' => $orderhenkanData->information3,
                    'kr0014' => $orderhenkanData->information4,
                    'kr0015' => $orderhenkanData->information5,
                    //'kr0016' => $val->datachar05,
                    'kr0016' => $kr0016,
                    'kr0017' => $val->kawasename,
                    'kr0018' => $val->syouhinname,
                    'kr0019' => $val->datachar14,
                    'kr0020' => $barcode_cd,
                    'kr0021' => $barcode_name,
                    'kr0022' => $val->datachar03,
                    'kr0023' => $val->datachar04,
                    'kr0024' => $val->dataint04,
                    'kr0025' => $val->syukkasu,
                    'kr0026' => $val->codename,
                    'kr0027' => $val->dataint18,
                    'kr0028' => $kr0028,
                    'kr0029' => $kr0029,
                    'kr0030' => $kr0030,
                    'kr0031' => $otodoketime,
                    'kr0032' => $kr0032,
                    'kr0033' => $money10,
                    'kr0034' => $kr0034,
                    'kr0035' => Carbon::now()->format('Y-m-d'),
                    'kr0036' => $orderhenkanData->intorder01 == null ? null : strftime ( '%Y-%m-%d' , strtotime($orderhenkanData->intorder01))." 00:00:00",
                    'kr0037' => $val->dataint09 == null ? null : strftime ( '%Y-%m-%d' , strtotime($val->dataint09))." 00:00:00",
                    'kr0038' => $val->dataint10 == null ? null : strftime ( '%Y-%m-%d' , strtotime($val->dataint10))." 00:00:00",
                    'kr0039' => $orderhenkanData->intorder04 == null ? null : strftime ( '%Y-%m-%d' , strtotime($orderhenkanData->intorder04))." 00:00:00",
                    'kr0040' => $orderhenkanData->intorder03 == null ? null : strftime ( '%Y-%m-%d' , strtotime($orderhenkanData->intorder03))." 00:00:00",
                    'kr0041' => $orderhenkanData->intorder05 == null ? null : strftime ( '%Y-%m-%d' , strtotime($orderhenkanData->intorder05))." 00:00:00",
                    'kr0042' => $kr0042,
                    'kr0043' => $orderhenkanData->housoukubun,
                    'kr0044' => $val->datachar09,
                    'kr0045' => $val->datachar15,
                    'kr0046' => $val->datachar16,
                    'kr0047' => $val->datachar17,
                    'kr0048' => null,
                    'kr0049' => null,
                    'kr0050' => null,
                    'kr0051' => $orderhenkanData->unsoudaibikitesuryou,
                    'kr0052' => $orderhenkanData->unsoutesuryou,
                    'kr0053' => null,
                    'kr0054' => null,
                    'kr0055' => null,
                    'kr0056' => null,
                    'kr0057' => $kokyakuorderbango,
                    'kr0058' => $val->syouhinsyu,
                    'kr0059' => $val->hantei,
                    'kr0060' => $ordertypebango2,
                    'kr0061' => null,
                    'kr0062' => null,
                    'kr0063' => null,
                    'kr0064' => null,
                    //'kr0065' => $orderhenkanData->hikiatesyukko_datachar04,
                    'kr0065' => null,
                    'kr0066' => null,
                    //'kr0067' => $val->juchusyukko_datachar01,
                    'kr0067' => null,
                    'kr0068' => null,
                    'kr0069' => ($kr0007 == 50 || $kr0007 == 60) ? 9 : 2,
                    'kr0070' => 0,
                    'kr0071' => 2,
                    'kr0072' => $val->yoteimeter,
                    'kr0073' => 2,
                    'kr0074' => null,
                    'kr0075' => null,
                    'kr0076' => null,
                    'kr0077' => null,
                    'kr0078' => null,
                    'kr0079' => null,
                    'kr0080' => null,
                    'kr0081' => null,
                    'kr0082' => Carbon::now()->format('Y-m-d H:i:s'),
                    'kr0083' => $val->tantousyabango,
                    //'kr0084' => $val->syouhinsyu,
                    'kr0084' => substr($datachar10,2,2),
                    'kr0085' => $kr0085,
                    'kr0086' => self::getCategoryData($kr0085),
                    'kr0087' => $kr0087,
                    'kr0088' => self::getCategoryData($kr0087),
                    'kr0089' => $kr0089,
                    'kr0090' => self::getCategoryData($kr0089),
                    //'kr0091' => $kr0028,
                    'kr0091' => $kr0091,
                    'kr0092' => $kr0092,
                    'kr0093' => $kr0093,
                    'kr0094' => self::getCategoryData($kr0093),
                    'kr0095' => $kr0095,
                    'kr0096' => self::getCategoryData($kr0095),
                    'kr0097' => $kr0097,
                    'kr0098' => self::getCategoryData($kr0097),
                    'kr0099' => $kr0099,
                    'kr0100' => self::getCategoryData($kr0099),
                    'kr0101' => $kr0101,
                    'kr0102' => self::getCategoryData($kr0101),
                    'kr0103' => $kr0103,
                    'kr0104' => $kr0104,
                    'kr0105' => $kr0105,
                    'kr0106' => self::getCategoryData($kr0105),
                    'kr0107' => $kr0107,
                    'kr0108' => self::getCategoryData($kr0107),
                    'kr0109' => $kr0109,
                    'kr0110' => self::getCategoryData($kr0109),
                    'kr0111' => $kr0111,
                    'kr0112' => self::getCategoryData($kr0111),
                    'kr0113' => $kr0113,
                    'kr0114' => $kr0114,
                    'kr0115' => self::getCategoryData($kr0114),
                    'kr0116' => $kr0116,
                    'kr0117' => $kr0117,
                    'kr0118' => $orderhenkanData->datachar01,
                ];
                $rireki = QueryHelper::insertData('rireki',$rireki_insert_data,'kr0000',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
            }
            

//            $orderuserbango = $orderhenkanData->orderuserbango;
//            $tmp_orderhenkanData = QueryHelper::fetchResult("
//                select 
//                orderhenkan.*,
//                tuhanorder.information1,
//                tuhanorder.information2,
//                tuhanorder.information3,
//                tuhanorder.information4,
//                tuhanorder.information5,
//                tuhanorder.otodoketime,
//                tuhanorder.money10,
//                tuhanorder.housoukubun
//                from (select kokyakuorderbango,orderuserbango,max(ordertypebango2) as max_ordertypebango2 from orderhenkan where datachar10 is not null group by kokyakuorderbango,orderuserbango) as tmp_orderhenkan
//                join orderhenkan on orderhenkan.kokyakuorderbango = tmp_orderhenkan.kokyakuorderbango and orderhenkan.ordertypebango2 = tmp_orderhenkan.max_ordertypebango2
//                join tuhanorder on tuhanorder.juchubango = orderhenkan.orderuserbango
//                --join hikiatesyukko on hikiatesyukko.orderbango = orderhenkan.bango
//                where orderhenkan.orderuserbango = '$orderuserbango' 
//                and orderhenkan.datachar02 = 'V413'
//                ");
//
//            foreach($tmp_orderhenkanData as $key2=>$val2){
//                $kokyakuCode = substr($val2->information2, 0,6);
//                $haisouCode = substr($val2->information2, 6,2);
//                $kokyaku = QueryHelper::select(['bango,mallsoukobango1,ytoiawseend'])->from('kokyaku1')->where("yobi12 = '$kokyakuCode' ")->get()->first();
//                $haisoujouhou = QueryHelper::select(['bunrui3'])->from('haisoujouhou')->where("syukei1 = '$kokyaku->bango' ")->get()->first();
//                $others2 = QueryHelper::fetchResult("select other1,other24,other4 from others2 where otherint1 = (select bango from haisou where haisou.shikibetsucode = '$kokyakuCode' and haisou.torihikisakibango = '$haisouCode')");
//                if(explode(' ', $others2[0]->other1)[0] == '1'){
//                    //$kr0042 = $haisoujouhou->bunrui3;
//                    $kr0042 = $kokyaku->ytoiawseend;
//                }else{
//                    $kr0042 = $others2[0]->other4;
//                }
//                
//                $temp_kokyakuorderbango = $val2->kokyakuorderbango;
//                $minyukoData = QueryHelper::fetchResult("
//                select 
//                minyuko.*
//                from (select syouhinid,max(zaikometer) as max_zaikometer from minyuko group by syouhinid) as tmp_minyuko
//                join minyuko on minyuko.syouhinid = tmp_minyuko.syouhinid and minyuko.zaikometer = tmp_minyuko.max_zaikometer
//                where minyuko.syouhinid = '$temp_kokyakuorderbango' 
//                ");
//                $datachar15 = $val->datachar15;
//                $datachar16 = $val->datachar16;
//                $datachar17 = $val->datachar17;
//                if(substr($tmp_orderhenkanData->datachar02,2,2) != 13){
//                    $kr0071 = 2;
//                }elseif(substr($tmp_orderhenkanData->datachar02,2,2) == 13 && $tmp_orderhenkanData->intorder04 == 1){
//                    $kr0071 = 9;
//                }else{
//                    $kr0071 = null;
//                }
//                $rireki_insert_data = [
//                    'kr0000' => $orderNumber,
//                    'kr0001' => 'V820',
//                    'kr0002' => $val2->syouhinid,
//                    'kr0003' => $tmp_orderhenkanData->ordertypebango2,
//                    'kr0004' => $val2->hantei,
//                    'kr0005' => $val2->zaikometer,
//                    'kr0006' => 1,
//                    'kr0007' => $val2->datachar01,
//                    'kr0008' => $tmp_orderhenkanData->datachar02,
//                    //'kr0009' => ※KR0009,
//                    'kr0010' => $tmp_orderhenkanData->datachar09,
//                    'kr0011' => $tmp_orderhenkanData->datachar10,
//                    'kr0012' => $tmp_orderhenkanData->information2,
//                    'kr0013' => $tmp_orderhenkanData->datachar11,
//                    'kr0014' => null,
//                    'kr0015' => null,
//                    'kr0016' => $tmp_orderhenkanData->datachar08,
//                    'kr0017' => $val2->datachar02,
//                    'kr0018' => $val->datachar03,
//                    'kr0019' => $val2->dataint20,
//                    'kr0020' => $val2->datachar04,
//                    'kr0021' => $val2->datachar05,
//                    'kr0022' => $val2->datachar07,
//                    'kr0023' => $val2->datachar08,
//                    'kr0024' => $val2->kingaku,
//                    'kr0025' => $val2->nyukosu,
//                    'kr0026' => $val2->datachar05,
//                    'kr0027' => $val2->syouhizeiritu,
//                    'kr0028' => $val2->datachar13,
//                    'kr0029' => $val2->genka,
//                    'kr0030' => $val2->syouhizeiritu,
//                    'kr0031' => $val2->datachar18,
//                    'kr0032' => $val2->soukobango,
//                    'kr0033' => $tmp_orderhenkanData->intorder01,
//                    //'kr0034' => ※KR0032,
//                    'kr0035' => Carbon::now()->format('Y-m-d'),
//                    'kr0036' => null,
//                    'kr0037' => $tmp_orderhenkanData->date == null ? null : strftime ( '%Y-%m-%d' , strtotime($tmp_orderhenkanData->date))." 00:00:00",
//                    'kr0038' => $val2->yoteibi == null ? null : strftime ( '%Y-%m-%d' , strtotime($val2->yoteibi))." 00:00:00",
//                    'kr0039' => null,
//                    'kr0040' => $tmp_orderhenkanData->intorder03 == null ? null : strftime ( '%Y-%m-%d' , strtotime($tmp_orderhenkanData->intorder03))." 00:00:00",
//                    'kr0041' => $tmp_orderhenkanData->intorder05 == null ? null : strftime ( '%Y-%m-%d' , strtotime($tmp_orderhenkanData->intorder05))." 00:00:00",
//                    //'kr0042' => $tmp_orderhenkanData->information2,
//                    'kr0042' => $kr0042,
//                    'kr0043' => null,
//                    'kr0044' => $val2->datachar10,
//                    'kr0045' => $datachar15,
//                    'kr0046' => $datachar16,
//                    'kr0047' => $datachar17,
//                    'kr0048' => null,
//                    'kr0049' => null,
//                    'kr0050' => null,
//                    'kr0051' => $tmp_orderhenkanData->unsoudaibikitesuryou,
//                    'kr0052' => $tmp_orderhenkanData->unsoutesuryou,
//                    'kr0053' => null,
//                    'kr0054' => null,
//                    'kr0055' => null,
//                    'kr0056' => null,
//                    'kr0057' => $tmp_orderhenkanData->orderuserbango,
//                    'kr0058' => $val2->yoteimeter,
//                    'kr0059' => $val2->nyukometer,
//                    //'kr0060' => ※KR0060元訂正回数１,
//                    'kr0061' => $tmp_orderhenkanData->datachar10,
//                    'kr0062' => null,
//                    'kr0063' => null,
//                    'kr0064' => null,
//                    'kr0065' => $tmp_orderhenkanData->hikiatesyukko_datachar04,
//                    'kr0066' => null,
//                    'kr0067' => $val->juchusyukko_datachar01,
//                    'kr0068' => null,
//                    'kr0069' => ($kr0007 == 50 || $kr0007 == 60) ? 9 : 2,
//                    'kr0070' => 0,
//                    'kr0071' => $kr0071,
//                    'kr0072' => $tmp_orderhenkanData->synchroorderbango2,
//                    //'kr0073' => ※KR0009,
//                    'kr0074' => null,
//                    'kr0075' => null,
//                    'kr0076' => null,
//                    'kr0077' => null,
//                    'kr0078' => null,
//                    'kr0079' => null,
//                    'kr0080' => null,
//                    'kr0081' => null,
//                    'kr0082' => Carbon::now()->format('Y-m-d H:i:s'),
//                    'kr0083' => $tmp_orderhenkanData->datatxt0155,
//                    'kr0084' => $val2->syouhinsyu,
//                    'kr0085' => $kr0085,
//                    'kr0086' => self::getCategoryData($kr0085),
//                    'kr0087' => $kr0087,
//                    'kr0088' => self::getCategoryData($kr0087),
//                    'kr0089' => $kr0089,
//                    'kr0090' => self::getCategoryData($kr0089),
//                    'kr0091' => $kr0028,
//                    'kr0092' => $kr0089,
//                    'kr0093' => $kr0093,
//                    'kr0094' => self::getCategoryData($kr0093),
//                    'kr0095' => $kr0095,
//                    'kr0096' => self::getCategoryData($kr0095),
//                    'kr0097' => $kr0097,
//                    'kr0098' => self::getCategoryData($kr0097),
//                    'kr0099' => $kr0099,
//                    'kr0100' => self::getCategoryData($kr0099),
//                    'kr0101' => $kr0101,
//                    'kr0102' => self::getCategoryData($kr0101),
//                    'kr0103' => $kr0103,
//                    'kr0104' => self::getCategoryData($kr0103),
//                    'kr0105' => $kr0105,
//                    'kr0106' => self::getCategoryData($kr0105),
//                    'kr0107' => $kr0107,
//                    'kr0108' => self::getCategoryData($kr0107),
//                    'kr0109' => $kr0109,
//                    'kr0110' => self::getCategoryData($kr0109),
//                    'kr0111' => $kr0111,
//                    'kr0112' => self::getCategoryData($kr0111),
//                    'kr0113' => $kr0113,
//                    'kr0114' => $kr0114,
//                    'kr0115' => self::getCategoryData($kr0114),
//                    'kr0116' => $kr0116,
//                    'kr0117' => $kr0117,
//                    'kr0118' => $tmp_orderhenkanData->intorder04,
//                ];
//                $rireki = QueryHelper::insertData('rireki',$rireki_insert_data,'kr0000',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
//            }
            
        } catch (\Exception $e) {
            $pattern = "";
            if($page_no == '02-01' || $page_no == '04-04-01'){
                $pattern = '01';
            }elseif($page_no == '04-01' || $page_no == '04-03' || $page_no == '04-04-02'){
               $pattern = '02'; 
            }
            $email_subject = "エラー：「0205受注売上→履歴データ作成」　".$kokyakuorderbango;
            $toMail = 'likhon.colgisbd@gmail.com';
            //$fromMail = 'rhklikhon@gmail.com';
            $fromMail = env('MAIL_FROM');
            $sender_name = '';
            $html = '<p>'.$kokyakuorderbango.'より「0205受注売上→履歴データ作成」でエラーが発生しております</p>';
            $html .= '<p> 発生時刻 = '.Carbon::now()->format("Y/m/d H:i:s").'</p>';
            $html .= '<p>エラー詳細</p>';
            $html .= '<p>エラー、該当データは※番号-訂正回数'.$kokyakuorderbango.'-'.$pattern.' です。</p>';
            Mail::send(new SendMail($email_subject,$toMail,$fromMail,$sender_name,$html));
            if (count(Mail::failures()) > 0) {
                return (Mail::failures());
            };
            return "db_error";
        }
    }
    
    public static function createRedData($bango,$orderNumber,$kokyakuorderbango,$ordertypebango2,$rirekiData,$correction_type){
        foreach($rirekiData as $key=>$val){
            if($correction_type == 3){
                $kr0118 = 3;
            }else{
                $kr0118 = $val->kr0118;
            }
            $rireki_insert_data = [
                'kr0000' => $orderNumber,
                'kr0001' => $val->kr0001,
                'kr0002' => $val->kr0002,
                'kr0003' => $val->kr0003,
                'kr0004' => $val->kr0004,
                'kr0005' => $ordertypebango2,
                'kr0006' => 2,
                'kr0007' => $val->kr0007,
                'kr0008' => $val->kr0008,
                'kr0009' => $val->kr0009,
                'kr0010' => $val->kr0010,
                'kr0011' => $val->kr0011,
                'kr0012' => $val->kr0012,
                'kr0013' => $val->kr0013,
                'kr0014' => $val->kr0014,
                'kr0015' => $val->kr0015,
                'kr0016' => $val->kr0016,
                'kr0017' => $val->kr0017,
                'kr0018' => $val->kr0018,
                'kr0019' => $val->kr0019,
                'kr0020' => $val->kr0020,
                'kr0021' => $val->kr0021,
                'kr0022' => $val->kr0022,
                'kr0023' => $val->kr0023,
                'kr0024' => $val->kr0024,
                'kr0025' => -$val->kr0025,
                'kr0026' => $val->kr0026,
                'kr0027' => -$val->kr0027,
                'kr0028' => $val->kr0028,
                'kr0029' => $val->kr0029,
                'kr0030' => -$val->kr0030,
                'kr0031' => $val->kr0031,
                'kr0032' => -$val->kr0032,
                'kr0033' => -$val->kr0033,
                'kr0034' => -$val->kr0034,
                //'kr0035' => $val->kr0035,
                'kr0035' => Carbon::now()->format('Y-m-d'),
                'kr0036' => $val->kr0036,
                'kr0037' => $val->kr0037,
                'kr0038' => $val->kr0038,
                'kr0039' => $val->kr0039,
                'kr0040' => $val->kr0040,
                'kr0041' => $val->kr0041,
                'kr0042' => $val->kr0042,
                'kr0043' => $val->kr0043,
                'kr0044' => $val->kr0044,
                'kr0045' => $val->kr0045,
                'kr0046' => $val->kr0046,
                'kr0047' => $val->kr0047,
                'kr0048' => $val->kr0048,
                'kr0049' => $val->kr0049,
                'kr0050' => $val->kr0050,
                'kr0051' => $val->kr0051,
                'kr0052' => $val->kr0052,
                'kr0053' => $val->kr0053,
                'kr0054' => $val->kr0054,
                'kr0055' => $val->kr0055,
                'kr0056' => $val->kr0056,
                'kr0057' => $val->kr0057,
                'kr0058' => $val->kr0058,
                'kr0059' => $val->kr0059,
                'kr0060' => $val->kr0060,
                'kr0061' => $val->kr0061,
                'kr0062' => $val->kr0062,
                'kr0063' => $val->kr0063,
                'kr0064' => $val->kr0064,
                'kr0065' => $val->kr0065,
                'kr0066' => $val->kr0066,
                'kr0067' => $val->kr0067,
                'kr0068' => $val->kr0068,
                'kr0069' => $val->kr0069,
                'kr0070' => $val->kr0070,
                'kr0071' => $val->kr0071,
                'kr0072' => $val->kr0072,
                'kr0073' => $val->kr0073,
                'kr0074' => $val->kr0074,
                'kr0075' => $val->kr0075,
                'kr0076' => $val->kr0076,
                'kr0077' => $val->kr0077,
                'kr0078' => $val->kr0078,
                'kr0079' => $val->kr0079,
                'kr0080' => $val->kr0080,
                'kr0081' => $val->kr0081,
                'kr0082' => Carbon::now()->format('Y-m-d H:i:s'),
                'kr0083' => $val->kr0083,
                'kr0084' => $val->kr0084,
                'kr0085' => $val->kr0085,
                'kr0086' => $val->kr0086,
                'kr0087' => $val->kr0087,
                'kr0088' => $val->kr0088,
                'kr0089' => $val->kr0089,
                'kr0090' => $val->kr0090,
                'kr0091' => $val->kr0091,
                'kr0092' => $val->kr0092,
                'kr0093' => $val->kr0093,
                'kr0094' => $val->kr0094,
                'kr0095' => $val->kr0095,
                'kr0096' => $val->kr0096,
                'kr0097' => $val->kr0097,
                'kr0098' => $val->kr0098,
                'kr0099' => $val->kr0099,
                'kr0100' => $val->kr0100,
                'kr0101' => $val->kr0101,
                'kr0102' => $val->kr0102,
                'kr0103' => $val->kr0103,
                'kr0104' => $val->kr0104,
                'kr0105' => $val->kr0105,
                'kr0106' => $val->kr0106,
                'kr0107' => $val->kr0107,
                'kr0108' => $val->kr0108,
                'kr0109' => $val->kr0109,
                'kr0110' => $val->kr0110,
                'kr0111' => $val->kr0111,
                'kr0112' => $val->kr0112,
                'kr0113' => $val->kr0113,
                'kr0114' => $val->kr0114,
                'kr0115' => $val->kr0115,
                'kr0116' => $val->kr0116,
                'kr0117' => $val->kr0117,
                'kr0118' => $kr0118,
            ];
            $rireki = QueryHelper::insertData('rireki',$rireki_insert_data,'kr0000',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
        }
    }
    
    public static function createActualDataHistory($bango,$page_no){
        $rireki = QueryHelper::fetchResult("
            select * 
            from rireki
            where kr0001 IN('V810','V830')
            --and kr0001 NOT IN('V150','V160')
            and kr0007 NOT IN('V150','V160')
            and kr0073 = 1
            and kr0069 = 2
            and kr0071 != 9
            ");
        $rireki2 = QueryHelper::fetchResult("
            select * 
            from rireki
            where kr0001 IN('V820')
            --and kr0001 NOT IN('V150','V160')
            and kr0007 NOT IN('V150','V160')
            and kr0009 = 1
            and kr0052 = 1
            and kr0069 = 2
            and kr0071 != 9
            ");
        $mergedData = collect($rireki)->merge(collect($rireki2));
        foreach($mergedData as $key=>$val){
            $ys0011 = null;
            $ys0013 = null;
            $ys0028 = null;
            $ys0030 = null;
            $ys0032 = null;
            $ys0017_u2 = null;
            $ys0019_u2 = null;
            $ys0021_u2 = null;
            $ys0036_u2 = null;
            $ys0038_u2 = null;
            $ys0040_u2 = null;
            if($val->kr0007 == 'V110'){
                $ys0011 = $val->kr0030;
                $ys0013 = $val->kr0027;
                $ys0028 = $val->kr0025;
                $ys0030 = $val->kr0030;
                $ys0032 = $val->kr0027;
                $ys0017_u2 = $val->kr0025;
                $ys0019_u2 = $val->kr0030;
                $ys0021_u2 = $val->kr0027;
                $ys0036_u2 = $val->kr0025;
                $ys0038_u2 = $val->kr0030;
                $ys0040_u2 = $val->kr0027;
            }elseif($val->kr0007 == 'V120'){
                $ys0011 = $val->kr0030;
                $ys0013 = 0;
                $ys0028 = 0;
                $ys0030 = $val->kr0030;
                $ys0032 = 0;
                $ys0017_u2 = 0;
                $ys0019_u2 = $val->kr0030;
                $ys0021_u2 = 0;
                $ys0036_u2 = 0;
                $ys0038_u2 = $val->kr0030;
                $ys0040_u2 = 0;
            }elseif($val->kr0007 == 'V130'){
                $ys0011 = $val->kr0030;
                $ys0013 = 0;
                $ys0028 = 0;
                $ys0030 = $val->kr0030;
                $ys0032 = 0;
                $ys0017_u2 = 0;
                $ys0019_u2 = $val->kr0030;
                $ys0021_u2 = 0;
                $ys0036_u2 = 0;
                $ys0038_u2 = $val->kr0030;
                $ys0040_u2 = 0;
            }elseif($val->kr0007 == 'V140'){
                $ys0011 = $val->kr0030;
                $ys0013 = 0;
                $ys0028 = 0;
                $ys0030 = $val->kr0030;
                $ys0032 = 0;
                $ys0017_u2 = 0;
                $ys0019_u2 = $val->kr0030;
                $ys0021_u2 = 0;
                $ys0036_u2 = 0;
                $ys0038_u2 = $val->kr0030;
                $ys0040_u2 = 0;
            }
            $useful1_insert_data = [
                'useful1' => $val->kr0001 == 'V820' ? 'V920' : 'V910',
                'useful2' => 1,
                'useful3' => $val->kr0084,
                'useful4' => $val->kr0085,
                'useful5' => $val->kr0087,
                'useful6' => $val->kr0089,
                'useful7' => $val->kr0028,
                'useful8' => $val->kr0035,
                'useful9' => $val->kr0007,
                'useful10' => 0,
                'useful11' => $ys0011,
                'useful12' => 0,
                'useful13' => $ys0013,
                'useful14' => 0,
                'useful15' => 0,
                'useful16' => null,
                'useful17' => null,
                'useful18' => null,
                'useful19' => null,
                'useful20' => 0,
                'useful21' => 0,
                'useful22' => 0,
                'useful23' => Carbon::now()->format("Y-m-d H:i:s"),
                'useful24' => null,
                //'useful25' => $bango,
                'useful25' => '0999',
                'useful26' => 1,
                'useful27' => 0,
                'useful28' => $ys0028,
                'useful29' => 0,
                'useful30' => $ys0030,
                'useful31' => 0,
                'useful32' => $ys0032,
                ];
            $useful1 = QueryHelper::insertData('useful1',$useful1_insert_data,'useful1',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
            
            $useful2_insert_data = [
                'useful1' => $val->kr0001 == 'V820' ? 'V920' : 'V910',
                'useful2' => 1,
                'useful3' => $val->kr0084,
                'useful4' => $val->kr0035,
                'useful5' => $val->kr0085,
                'useful6' => $val->kr0087,
                'useful7' => $val->kr0089,
                'useful8' => $val->kr0107,
                'useful9' => $val->kr0093,
                'useful10' => $val->kr0045,
                'useful11' => null,
                'useful12' => null,
                'useful13' => null,
                'useful14' => null,
                'useful15' => null,
                'useful16' => 0,
                'useful17' => $ys0017_u2,
                'useful18' => 0,
                'useful19' => $ys0019_u2,
                'useful20' => 0,
                'useful21' => $ys0021_u2,
                'useful22' => 0,
                'useful23' => 0,
                'useful24' => 0,
                //'useful25' => Carbon::now()->format("Y-m-d H:i:s"),
                'useful25' => null,
                'useful26' => null,
                'useful27' => null,
                'useful28' => 0,
                'useful29' => 0,
                'useful30' => 0,
                'useful31' => Carbon::now()->format("Y-m-d H:i:s"),
                'useful32' => null,
                //'useful33' => $bango,
                'useful33' => '0999',
                'useful34' => 1,
                'useful35' => 0,
                'useful36' => $ys0036_u2,
                'useful37' => 0,
                'useful38' => $ys0038_u2,
                'useful39' => 0,
                'useful40' => $ys0040_u2,
                ];
            $useful2 = QueryHelper::insertData('useful2',$useful2_insert_data,'useful1',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
            
            //update review data
            $kr0000 = $val->kr0000;
            $kr0001 = $val->kr0001;
            $kr0002 = $val->kr0002;
            $kr0069 = $val->kr0069;
            $rireki_update_data = [
                'kr0000' => $kr0000,
                'kr0002' => $kr0002,
                'kr0069' => 1,
            ];
            QueryHelper::updateData('rireki', $rireki_update_data, ['kr0000'=>$kr0000,'kr0001'=>$kr0001,'kr0002'=>$kr0002,'kr0069'=>$kr0069], $bango, __CLASS__, __FUNCTION__, __LINE__);
        }
    }
    
    //calculate tax rate
    public static function calculateConsumptionTax($bango,$info2,$otodoketime,$syouhinid,$kr0033,$kr0027,$syukkasu,$dataint04){
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

        if(explode(' ', $others2[0]->other1)[0] == '1'){
            $format_status = substr($mallsoukobango1,2,1);
            $data_status = explode(' ', $haisoujouhou->datatxt0051)[0];
        }else{
            $format_status = substr($others2[0]->other18,2,1);
            $data_status = explode(' ', $others2[0]->other17)[0];
        }

        if ($data_status == '1' || $data_status == '3') {
            $kr0032 = ($kr0027*$category5)/100;
            $kr0034 = ($kr0033*$category5)/100;
            //check tax rate for round,floor or selling
            if($format_status == '1'){
                $kr0032 = round($kr0032);
                $kr0034 = round($kr0034);
            }else if($format_status == '2'){
                $kr0032 = floor($kr0032);
                $kr0034 = floor($kr0034);
            }else if($format_status == '3'){
                $kr0032 = ceil($kr0032);
                $kr0034 = ceil($kr0034);
            }
            return [
                "kr0032" => $kr0032,
                "kr0034" => $kr0034,
            ];
        }else if($data_status == '2'){
            $kr0032 = ($syukkasu*$dataint04*$category5)/100;
            $misyukko = QueryHelper::fetchResult("select syukkasu,hantei,dataint04 from misyukko where syouhinid = '$syouhinid' AND hantei = 0 ");
            $kr0034 = 0;
            foreach($misyukko as $key=>$value){
                $kr0034 = $kr0034 + ($misyukko[$key]->syukkasu*$misyukko[$key]->dataint04*$category5)/100;
            }

            //check tax rate for round,floor or selling
            if($format_status == '1'){
                $kr0032 = round($kr0032);
                $kr0034 = round($kr0034);
            }else if($format_status == '2'){
                $kr0032 = floor($kr0032);
                $kr0034 = floor($kr0034);
            }else if($format_status == '3'){
                $kr0032 = ceil($kr0032);
                $kr0034 = ceil($kr0034);
            }
            
            session()->put('data_status'.$bango, $data_status);
            
            return [
                "kr0032" => $kr0032,
                "kr0034" => $kr0034,
            ];
        }else{
            return [
                "kr0032" => null,
                "kr0034" => null,
            ];
        }
    }
    
    public static function getTantousyaData($search_val,$field_name){
        $tantousyaData = QueryHelper::fetchSingleResult("
            select   
            *
            from tantousya 
            where bango = '$search_val'
            ");
        if($tantousyaData){
            return $tantousyaData->$field_name;
        }else{
           return null;  
        }
    }
    
    public static function getCategoryData($search_val,$field_name = null){
        if($search_val == null){
           return null; 
        }else{
            $cat1 = substr($search_val,0,2);
            $cat2 = substr($search_val,2);
            $categorykanriData = QueryHelper::fetchSingleResult("
                select   
                *
                from categorykanri 
                where category1 = '$cat1' and category2 = '$cat2'
                ");
            if($categorykanriData){
                if($field_name == null){
                   return $categorykanriData->category4; 
                }else{
                  return $categorykanriData->$field_name;  
                }
                
            }else{
               return null;  
            }
        }
    }
    
}
