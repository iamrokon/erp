<?php

namespace App\AllClass\common;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use App\AllClass\master\CSVLogger;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use Carbon\Carbon;
use App\Helpers\Helper;
use App\AllClass\common\CreateHatchuDetails;

Class CreateOrderEntryAndHatchuData
{
    public static function data($bango)
    {
        $orderEntryData = collect(self::getOrderEntryData());
        // $orderEntryData = $orderEntryData->where('ju0003',3);
        // dd($orderEntryData);
        foreach ($orderEntryData as $orderData) {
            $orderData = (object)$orderData;
            if ($orderData->ju0003 == 1){
                self::create($bango, $orderData);
            }
            else if ($orderData->ju0003 == 2){
                // dd($orderData);
                self::update($bango, $orderData);
            }else if ($orderData->ju0003 == 3){
                // dd($orderData);
                self::delete($bango, $orderData);
            }  
        }
        // dd("x");
    }
    public static function getOrderEntryData()
    {
        $orderEntryData = QueryHelper::fetchResult("
            select
            'V120' as JU0000,
            orderhenkan.kokyakuorderbango as JU0001,
            orderhenkan.ordertypebango2 as JU0002,
            orderhenkan.datachar01 as JU0003,
            orderhenkan.datachar02 as JU0004,
            orderhenkan.datachar05 as JU0008,
            tuhanorder.information1 as JU0009,
            tuhanorder.information3 as JU0011,
            tuhanorder.chumonbango as JU0031,
            orderhenkan.synchroorderbango as JU0038,
            misyukko.syouhinid as JM0001,
            misyukko.syouhinsyu as JM0002,
            misyukko.hantei as JM0003,
            misyukko.dataint01 as JM0004,
            misyukko.kawasename as JM0007,
            misyukko.syouhinname as JM0008,
            misyukko.datachar14 as JM0009,
            left(misyukko.barcode,10) as JM0010,
            substring(misyukko.barcode,12,length(misyukko.barcode)-12) as JM0011,
            misyukko.syukkasu as JM0012,
            misyukko.codename as JM0013,
            misyukko.dataint04 as JM0014,
            misyukko.dataint05 as JM0015,
            misyukko.dataint08 as JM0018,
            misyukko.datachar02 as JM0020,
            misyukko.datachar03 as JM0021,
            misyukko.datachar04 as JM0022,
            misyukko.datachar05 as JM0023,
            misyukko.dataint09 as JM0024,
            misyukko.dataint10 as JM0025,
            misyukko.datachar06 as JM0026,
            misyukko.datachar07 as JM0027,
            misyukko.datachar09 as JM0029,
            misyukko.datachar15 as JM0030,
            misyukko.datachar16 as JM0031,
            misyukko.datachar21 as JM0038,
            misyukko.datachar22 as JM0039,
            misyukko.yoteimeter as JM0040
            from
                orderhenkan
                join tuhanorder on tuhanorder.orderbango=orderhenkan.bango
                join misyukko on misyukko.orderbango=orderhenkan.bango
            where
                orderhenkan.datachar02 in ('U120','U122','U123')
                and misyukko.dataint05>0
                and substring(misyukko.datachar22,1,1)='0'
            union
            --受注_仕入
            select
            'V150' as JU0000,
            orderhenkan.kokyakuorderbango as JU0001,
            orderhenkan.ordertypebango2 as JU0002,
            orderhenkan.datachar01 as JU0003,
            orderhenkan.datachar02 as JU0004,
            orderhenkan.datachar05 as JU0008,
            tuhanorder.information1 as JU0009,
            tuhanorder.information3 as JU0011,
            tuhanorder.chumonbango as JU0031,
            orderhenkan.synchroorderbango as JU0038,
            misyukko.syouhinid as JM0001,
            misyukko.syouhinsyu as JM0002,
            misyukko.hantei as JM0003,
            misyukko.dataint01 as JM0004,
            misyukko.kawasename as JM0007,
            misyukko.syouhinname as JM0008,
            misyukko.datachar14 as JM0009,
            left(misyukko.barcode,10) as JM0010,
            substring(misyukko.barcode,12,length(misyukko.barcode)-12) as JM0011,
            misyukko.syukkasu as JM0012,
            misyukko.codename as JM0013,
            misyukko.dataint04 as JM0014,
            misyukko.dataint05 as JM0015,
            misyukko.dataint08 as JM0018,
            misyukko.datachar02 as JM0020,
            misyukko.datachar03 as JM0021,
            misyukko.datachar04 as JM0022,
            misyukko.datachar05 as JM0023,
            misyukko.dataint09 as JM0024,
            misyukko.dataint10 as JM0025,
            misyukko.datachar06 as JM0026,
            misyukko.datachar07 as JM0027,
            misyukko.datachar09 as JM0029,
            misyukko.datachar15 as JM0030,
            misyukko.datachar16 as JM0031,
            misyukko.datachar21 as JM0038,
            misyukko.datachar22 as JM0039,
            misyukko.yoteimeter as JM0040
            from
                orderhenkan
                join tuhanorder on tuhanorder.orderbango=orderhenkan.bango
                join misyukko on misyukko.orderbango=orderhenkan.bango
            where
                orderhenkan.datachar02 in ('U120','U122','U123')
                and misyukko.dataint08>0
                and substring(misyukko.datachar22,4,1)='0'
            order by JU0001, JU0002, JM0002, JM0003, JU0000 
            ");
        return $orderEntryData;
    }
    public static function getHatchuData($JU0004, $idoutanabango, $yoteimeter, $nyukometer)
    {
        $count = QueryHelper::fetchSingleResult("select count(syouhinid) as total_row from minyuko where idoutanabango = '$idoutanabango' and yoteimeter = '$yoteimeter' and nyukometer = '$nyukometer'")->total_row;
        // dd($count);
        // dd(collect($hatchuData)->count());
        // dd($JU0004, $idoutanabango, $yoteimeter, $nyukometer);
        $sql_condition = " where minyuko.datachar01 in ('V120', 'V150') ";
        if($JU0004 == 'U120'){
            $sql_condition .= "and orderhenkan.datachar02 = 'V420' ";
        }else if($JU0004 == 'U122'){
            $sql_condition .= "and orderhenkan.datachar02 = 'V422' ";
        }else if($JU0004 == 'U123'){
            $sql_condition .= "and orderhenkan.datachar02 = 'V423' ";
        }
        $sql_condition .= "and minyuko.idoutanabango = '$idoutanabango' and minyuko.yoteimeter = '$yoteimeter' and minyuko.nyukometer = '$nyukometer' ";
        
        // $hatchuData = QueryHelper::fetchResult("
        QueryHelper::runQuery("DROP TABLE IF EXISTS hatchu_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE hatchu_temp as
            select distinct
            orderhenkan.kokyakuorderbango as HC0001,
            orderhenkan.ordertypebango2 as HC0002,
            orderhenkan.orderuserbango as HC0003,
            orderhenkan.datachar01 as HC0004,
            orderhenkan.datachar02 as HC0005,
            orderhenkan.intorder04 as HC0006,
            orderhenkan.datachar08 as HC0007,
            orderhenkan.date as HC0008,
            orderhenkan.datachar09 as HC0009,
            orderhenkan.datachar10 as HC0010,
            orderhenkan.datachar11 as HC0011,
            orderhenkan.intorder01 as HC0012,
            orderhenkan.intorder02 as HC0013,
            orderhenkan.datachar04 as HC0014,
            orderhenkan.datachar05 as HC0015,
            orderhenkan.datachar06 as HC0016,
            orderhenkan.datachar07 as HC0017,
            orderhenkan.datatxt0147 as HC0018,
            orderhenkan.deletedate as HC0019,
            orderhenkan.date0012 as HC0020,
            orderhenkan.datachar12 as HC0021,
            orderhenkan.datachar13 as HC0022,
            orderhenkan.datachar14 as HC0023,
            orderhenkan.datachar15 as HC0024,
            orderhenkan.date0013 as HC0025,
            orderhenkan.date0014 as HC0026,
            orderhenkan.date0015 as HC0027,
            orderhenkan.datatxt0148 as HC0028,
            orderhenkan.datatxt0149 as HC0029,
            orderhenkan.datatxt0150 as HC0030,
            orderhenkan.datatxt0151 as HC0031,
            orderhenkan.intorder03 as HC0032,
            orderhenkan.datatxt0152 as HC0033,
            orderhenkan.synchroorderbango as HC0034,
            orderhenkan.date0018 as HC0035,
            orderhenkan.date0019 as HC0036,
            --orderhenkan.datatxt0144 as HC0037,
            orderhenkan.datatxt0154 as HC0038,
            orderhenkan.synchroorderbango2 as HC0039,
            orderhenkan.date0016 as HC0040,
            orderhenkan.date0016 as HC0041,
            orderhenkan.datatxt0155 as HC0044,
            orderhenkan.datatxt0156 as HC0045,
            orderhenkan.datatxt0157 as HC0046,
            orderhenkan.date0020 as HC0047,
            orderhenkan.datatxt0158 as HC0048,
            hikiatenyuko.syouhinid as HCF001,
            hikiatenyuko.syouhinsyu as HCF002,
            hikiatenyuko.hantei as HCF003,
            hikiatenyuko.dataint01 as HCF004,
            hikiatenyuko.dataint02 as HCF005,
            hikiatenyuko.dataint03 as HCF006,
            hikiatenyuko.dataint04 as HCF007,
            hikiatenyuko.dataint05 as HCF008,
            hikiatenyuko.datachar01 as HCF009,
            hikiatenyuko.dataint06 as HCF010,
            hikiatenyuko.dataint07 as HCF011,
            hikiatenyuko.dataint08 as HCF012,
            hikiatenyuko.dataint09 as HCF013,
            hikiatenyuko.datachar02 as HCF014,
            hikiatenyuko.datachar03 as HCF015,
            hikiatenyuko.datachar04 as HCF016,
            hikiatenyuko.datachar05 as HCF017,
            hikiatenyuko.yoteimeter as HCF018,
            hikiatenyuko.denpyohakkoubi as HCF019,
            hikiatenyuko.denpyohakkoubi as HCF020,
            hikiatenyuko.tantousyabango as HCF023,
            minyuko.syouhinid as HS0001,
            minyuko.syouhinsyu as HS0002,
            minyuko.hantei as HS0003,
            minyuko.zaikometer as HS0004,
            minyuko.idoutanabango as HS0005,
            minyuko.yoteimeter as HS0006,
            minyuko.nyukometer as HS0007,
            minyuko.datachar01 as HS0008,
            minyuko.yoteibi as HS0009,
            minyuko.kanryoubi as HS0010,
            minyuko.kaiinid as HS0011,
            minyuko.datachar02 as HS0012,
            minyuko.datachar03 as HS0013,
            minyuko.dataint20 as HS0014,
            minyuko.datachar04 as HS0015,
            minyuko.datachar05 as HS0016,
            minyuko.nyukosu as HS0017,
            minyuko.datachar06 as HS0018,
            minyuko.kingaku as HS0019,
            minyuko.genka as HS0020,
            minyuko.syouhizeiritu as HS0021,
            minyuko.datachar07 as HS0022,
            minyuko.datachar08 as HS0023,
            minyuko.datachar09 as HS0024,
            minyuko.datachar10 as HS0025,
            minyuko.datachar11 as HS0026,
            minyuko.datachar12 as HS0027,
            minyuko.datachar13 as HS0028,
            minyuko.datachar14 as HS0029,
            minyuko.dataint21 as HS0030,
            minyuko.dataint22 as HS0031,
            minyuko.dataint23 as HS0032,
            minyuko.season as HS0033,
            minyuko.nengetsu as HS0034,
            minyuko.datachar15 as HS0035,
            minyuko.datachar16 as HS0036,
            minyuko.denpyobango as HS0037,
            minyuko.denpyohakkoubi as HS0038,
            minyuko.denpyohakkoubi as HS0039,
            minyuko.tantousyabango as HS0042,
            minyuko.dataint24 as HS0043,
            minyuko.dataint25 as HS0044,
            minyuko.weeks as HS0045,
            minyuko.yoyakubi as HS0046,
            minyuko.datachar17 as HS0047,
            minyuko.datachar18 as HS0048,
            minyuko.soukobango as HS0049,
            minyuko.datachar19 as HS0050,
            juchusyukko2.syouhinid as HSF001,
            juchusyukko2.syouhinsyu as HSF002,
            juchusyukko2.hantei as HSF003,
            juchusyukko2.season as HSF004,
            juchusyukko2.nengetsu as HSF005,
            juchusyukko2.weeks as HSF006,
            juchusyukko2.datachar01 as HSF007,
            juchusyukko2.datachar02 as HSF008,
            juchusyukko2.datachar03 as HSF009,
            juchusyukko2.datachar04 as HSF010,
            juchusyukko2.yoteimeter as HSF011,
            juchusyukko2.denpyohakkoubi as HSF012,
            juchusyukko2.denpyohakkoubi as HSF013,
            juchusyukko2.tantousyabango as HSF016,
            juchusyukko2.day as HSF017,
            juchusyukko2.tanka as HSF018,
            juchusyukko2.barcode as HSF019,
            juchusyukko2.codename as HSF020
            FROM minyuko
            JOIN (Select syouhinid, syouhinsyu, hantei,
                    max(zaikometer) as zaikometer
                    FROM minyuko group by syouhinid, syouhinsyu, hantei)
                AS m_minyuko ON m_minyuko.syouhinid = minyuko.syouhinid
                AND m_minyuko.syouhinsyu = minyuko.syouhinsyu
                AND m_minyuko.hantei = minyuko.hantei
                AND m_minyuko.zaikometer = minyuko.zaikometer
            LEFT JOIN orderhenkan
                ON orderhenkan.kokyakuorderbango = minyuko.syouhinid 
                AND orderhenkan.ordertypebango2 = minyuko.zaikometer
            LEFT JOIN hikiatenyuko
                ON hikiatenyuko.syouhinid = minyuko.syouhinid
            LEFT JOIN juchusyukko2
                ON juchusyukko2.syouhinid = minyuko.syouhinid
                AND juchusyukko2.syouhinsyu = minyuko.syouhinsyu
                AND juchusyukko2.hantei = minyuko.hantei
            $sql_condition
            ");
        // dd("time");
        QueryHelper::runQuery("DROP TABLE IF EXISTS hatchu_temp_final");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE hatchu_temp_final as
            select 
            hc0001,
            sum(hs0021) as hs0021,
            sum(hs0049) as hs0049
            from
            hatchu_temp as hatchu
            -- Join (select hc0001, sum(hs0021) as sum_hs0021,
            --     sum(hs0049) as sum_hs0049
            --     from hatchu_temp group by hc0001) 
            --     as g_hatchu on g_hatchu.hc0001 = hatchu.hc0001
            group by hc0001
            "); 
        QueryHelper::runQuery("DROP TABLE IF EXISTS hatchu_temp_final_1");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE hatchu_temp_final_1 as
            select hatchu.*,
            g_hatchu.hs0021 as sum_hs0021,
            g_hatchu.hs0049 as sum_hs0049
            from 
            hatchu_temp as hatchu
            left join hatchu_temp_final as g_hatchu
            on g_hatchu.hc0001 = hatchu.hc0001
            order by 
                hc0005, hs0008, hs0005, hs0006, hs0007, hs0001, hs0002
            Limit $count
            ");


        $hatchuData = collect(QueryHelper::fetchResult("
            Select * 
            from hatchu_temp_final_1
            "));
        // dd($hatchuData);
        return $hatchuData;
        // echo "<pre>";
        // var_dump($hatchuData);
    }
    public static function create($bango, $orderEntryData)
    {
        $hatchuData = self::getHatchuData($orderEntryData->ju0004,
                                            $orderEntryData->jm0001,
                                            $orderEntryData->jm0002,
                                            $orderEntryData->jm0003);
        // dd($hatchuData);
        $orderHenkanData = $hatchuData->unique('hc0001');
        // if($orderHenkanData){
        //     dd($orderHenkanData);
        // }
        dd($orderHenkanData);
        foreach ($orderHenkanData as $data) {
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 05-09 Menu start\n";
            QueryHandler::logger($bango, $log_data);
            $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
            pg_query($conn, "BEGIN");
            try {
                $data = (object)$data;
                $minyukoData = $hatchuData->where('hc0001',$data->hc0001);
                // dd($data);
                // dd("minyuko", $minyukoData);
                $kokyakuorderbango = self::getKokyakuOrderBango();
                $datachar02 = null;
                if($orderEntryData->ju0004 == 'U120'){
                    $datachar02 = 'V420';
                }else if($orderEntryData->ju0004 == 'U122'){
                    $datachar02 = 'V422';
                }else if($orderEntryData->ju0004 == 'U123'){
                    $datachar02 = 'V423';
                }
                $orderhenkan = [
                    'kokyakuorderbango' => $kokyakuorderbango, //付番マスタのSheet：付番基準説明　より　付番する（発注番号）
                    'ordertypebango2' => 0, //ゼロ
                    'orderuserbango' => $orderEntryData->ju0001, //JU0001受注番号
                    'datachar01' => null,
                    'datachar02' => $datachar02, //U120の時、V420：保守通常 U122の時、V422：保守請求 U123の時、V423：保守計上
                    'kokyakubango' => 1, //1 新規
                    'datachar08' => $orderEntryData->jm0023, //JM0023仕入先
                    'date' => Helper::getDBFormattedDate($orderEntryData->jm0024), //JM0024発注日
                    'datachar09' => $orderEntryData->ju0008, //JU0008受注担当者
                    'datachar10' => $orderEntryData->ju0009, //JU0009受注先CD
                    'datachar11' => $orderEntryData->ju0011, //JU0011最終顧客CD
                    'intorder01' => $data->sum_hs0021, //HS0021発注明細金額
                    'intorder02' => $data->sum_hs0049, //HS0049発注明細消費税額
                    'datachar04' => null,
                    'datachar05' => null,
                    'datachar06' => null,
                    'datachar07' => null,
                    'datatxt0147' => null,
                    'deletedate' => null,
                    'date0012' => null,
                    'datachar12' => null,
                    'datachar13' => null,
                    'datachar14' => null,
                    'datachar15' => null,
                    'date0013' => null,
                    'date0014' => null,
                    'date0015' => null,
                    'datatxt0148' => null,
                    'datatxt0149' => null,
                    'datatxt0150' => null,
                    'datatxt0151' => null,
                    'intorder03' => null,
                    'datatxt0152' => null,
                    'synchroorderbango' => null,
                    'date0018' => null,
                    'date0019' => null,
                    // 'datatxt0144' => null,
                    'datatxt0154' => null,
                    'synchroorderbango2' => 0,
                    'date0016' => Carbon::now()->format('Y-m-d H:i:s'), //システム日付・時分秒　共通仕様C35
                    'date0017' => null,
                    'datatxt0155' => '0999',
                    'datatxt0156' => 'U810',
                    'datatxt0157' => null,
                    'date0020' => null,
                    'datatxt0158' => null, //U123のみ※HC0047 それ以外null,
                ];
                // dd($orderhenkan);
                $orderhenkan = QueryHelper::insertData('orderhenkan', $orderhenkan, 'bango', true, $bango, __CLASS__, __FUNCTION__, __LINE__);

                $hikiatenyuko = [
                    'orderbango' => $orderhenkan->bango,
                    'syouhinid' => $orderhenkan->kokyakuorderbango, // HC0001発注番号
                    'syouhinsyu' => 2,
                    'hantei' => null,
                    'dataint01' => null,
                    'dataint02' => 2,
                    'dataint03' => 2,
                    'dataint04' => 2,
                    'dataint05' => 2,
                    'datachar01' => null,
                    'dataint06' => 2,
                    'dataint07' => 2,
                    'dataint08' => null,
                    'dataint09' => null,
                    'datachar02' => null,
                    'datachar03' => null,
                    'datachar04' => null,
                    'datachar05' => null,
                    'yoteimeter' => 0,
                    'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'),
                    'denpyoshimebi' => null,
                    'tantousyabango' => "0999",
                ];
                QueryHelper::insertData('hikiatenyuko', $hikiatenyuko, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                $datachar01 = null;
                $genka = 0;
                if($orderEntryData->jm0018 != 0){
                    $datachar01 = 'V150';
                    $genka = $orderEntryData->jm0018;
                }else if($orderEntryData->jm0015 != 0){
                    $datachar01 = 'V120';
                    $genka = $orderEntryData->jm0015;
                }
                $syouhinsyu = 0;
                foreach ($minyukoData as $minyukoValues) {
                    $minyukoValues = (object)$minyukoValues;
                    $syouhinsyu++;
                    $kanryoubi = $orderEntryData->jm0025 - 2;
                    $syouhizeiritu = $minyukoValues->hs0017 * $minyukoValues->hs0020;
                    list($datachar18, $soukobango) = self::taxRateCalculation($minyukoValues->hc0007,$syouhizeiritu);
                    $minyuko = [
                        'orderbango' => $orderhenkan->bango,
                        'syouhinid' => $orderhenkan->kokyakuorderbango, //HC0001発注番号
                        'syouhinsyu' => $syouhinsyu, //HC0001発注番号　毎の連番
                        'hantei' => 0,
                        'zaikometer' => 0,
                        'idoutanabango' => $orderEntryData->jm0001, //JM0001受注番号
                        'yoteimeter' => $orderEntryData->jm0002, //JM0002受注行番号
                        'nyukometer' => $orderEntryData->jm0003, //JM0003受注行番号枝番
                        'datachar01' => $datachar01, //JM0018仕入単価<>0 の場合 V150：仕入 JM0015仕切（SE）<>0の場合 V120：SE
                        'yoteibi' => Helper::getDBFormattedDate($orderEntryData->jm0025), //JM0025個別納期
                        'kanryoubi' => Helper::getDBFormattedDate($kanryoubi), //JM0025　－　２日
                        'kaiinid' => $orderEntryData->jm0026, //JM0026納品先CD
                        'datachar02' => $orderEntryData->jm0007, //JM0007商品CD
                        'datachar03' => $orderEntryData->jm0008, //JM0008商品名
                        'dataint20' => $orderEntryData->jm0009, //JM0009商品サブ区分
                        'datachar04' => $orderEntryData->jm0010, //JM0010商品サブCD
                        'datachar05' => $orderEntryData->jm0011, //JM0011商品サブ名称
                        'nyukosu' => $orderEntryData->jm0012, //JM0012数量
                        'datachar06' => $orderEntryData->jm0013, //JM0013単位
                        'kingaku' => $orderEntryData->jm0014, //JM0014販売単価
                        'genka' => $genka, //JM0018仕入単価<>0 の場合 JM0018仕入単価 JM0015仕切（SE）<>0の場合 JM0015仕切（SE）単価
                        'syouhizeiritu' => $syouhizeiritu, //HS0017発注数量×HS0020発注単価
                        'datachar07' => $orderEntryData->jm0021, //JM0021メーカー品番
                        'datachar08' => $orderEntryData->jm0022, //JM0022メーカー品名
                        'datachar09' => $orderEntryData->jm0027, //JM0027発注出荷指示備考
                        'datachar10' => $orderEntryData->jm0029, //JM0029納品方法（G3）
                        'datachar11' => null,
                        'datachar12' => null,
                        'datachar13' => $orderEntryData->jm0015 != 0 ? $orderEntryData->jm0020 : null, //JM0015仕切（SE）<>0の場合 JM0020SE粗利担当 それ以外null,
                        'datachar14' => null,
                        'dataint21' => null,
                        'dataint22' => null,
                        'dataint23' => null,
                        'season' => null,
                        'nengetsu' => null,
                        'datachar15' => null,
                        'datachar16' => null,
                        'denpyobango' => 0,
                        'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'), //システム日付・年月日　共通仕様C35
                        'denpyoshimebi' => null,
                        'tantousyabango' => '0999',
                        'dataint24' => $orderEntryData->jm0030, //JM0030継続区分
                        'dataint25' => $orderEntryData->jm0031, //JM0031新規バージョンＵＰ区分
                        'weeks' => null,
                        'yoyakubi' => null,
                        'datachar17'  => null,
                        'datachar18' => $minyukoValues->hc0007, //HC0007仕入先ＣＤより支払課税区分（共通仕様K16）
                        'soukobango' => $soukobango, //HS0021発注明細金額×消費税率（HS0048支払課税区分） 端数処理（HC0007仕入先CDより支払税端数区分（共通仕様K16））
                        'datachar19' => null,
                    ];
                    $minyuko = QueryHelper::insertData('minyuko', $minyuko, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                    
                    $juchusyukko2 = [
                        'orderbango' => $orderhenkan->bango,
                        'syouhinid' => $minyuko->syouhinid, //HM0001発注番号
                        'syouhinsyu' => $minyuko->syouhinsyu, //HM0002発注行番号
                        'hantei' => $minyuko->hantei, //HM0003発注行番号枝番
                        'season' => 1,
                        'nengetsu' => null,
                        'weeks' => null,
                        'datachar01' => null,
                        'datachar02' => null,
                        'datachar03' => null,
                        'datachar04' => null,
                        'yoteimeter' => 0,
                        'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'), //システム日付・年月日　共通仕様C35
                        'denpyoshimebi' => null,
                        'tantousyabango' => '0999',
                        'day' =>  2,
                        'tanka' =>  2,
                        'barcode' => null,
                        'codename' => null,
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
                CreateHatchuDetails::data($bango,$kokyakuorderbango,0,1,'05-09');

                // $result['status'] = 'ok';
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 05-09 Menu end\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "COMMIT");
                // session()->flash('success_msg', "発注番号" . $kokyakuorderbango . "で登録しました。");

            }catch (\Exception $e) {
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "ROLLBACK");
                // session()->flash('success_msg', "something" . $kokyakuorderbango . "went wrong");
                // $result['status'] = 'ng';
                // $result['exception'] = $e->getMessage();
            }
            // dd($orderhenkan, $hikiatenyuko,$minyuko,$juchusyukko2);
        }
    }

    public static function update($bango, $orderEntryData)
    {
        $hatchuData = self::getHatchuData($orderEntryData->ju0004,
                                            $orderEntryData->jm0001,
                                            $orderEntryData->jm0002,
                                            $orderEntryData->jm0003);
        $orderHenkanData = $hatchuData->unique('hc0001');
        // if($orderHenkanData){
        //     dd($orderHenkanData);
        // }
        foreach ($orderHenkanData as $data) {
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 05-09 Menu start\n";
            QueryHandler::logger($bango, $log_data);
            $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
            pg_query($conn, "BEGIN");
            try {
                $data = (object)$data;
                $minyukoData = $hatchuData->where('hc0001',$data->hc0001);
                // dd($data);
                // dd("minyuko", $minyukoData);
                $kokyakuorderbango = $data->hc0001;
                $ordertypebango2 = $data->hc0002 + 1;
                $datachar02 = null;
                if($orderEntryData->ju0004 == 'U120'){
                    $datachar02 = 'V420';
                }else if($orderEntryData->ju0004 == 'U122'){
                    $datachar02 = 'V422';
                }else if($orderEntryData->ju0004 == 'U123'){
                    $datachar02 = 'V423';
                }
                $orderhenkan = [
                    'kokyakuorderbango' => $kokyakuorderbango, //（元の値を保持）
                    'ordertypebango2' => $ordertypebango2, //前回値＋１
                    'orderuserbango' => $orderEntryData->ju0001, //（元の値を保持）
                    'datachar01' => null,
                    'datachar02' => $datachar02, //U120の時、V420：保守通常 U122の時、V422：保守請求 U123の時、V423：保守計上
                    'kokyakubango' => 2, //2 訂正
                    'datachar08' => $orderEntryData->jm0023, //JM0023仕入先
                    'date' => Helper::getDBFormattedDate($orderEntryData->jm0024), //JM0024発注日
                    'datachar09' => $orderEntryData->ju0008, //JU0008受注担当者
                    'datachar10' => $orderEntryData->ju0009, //JU0009受注先CD
                    'datachar11' => $orderEntryData->ju0011, //JU0011最終顧客CD
                    'intorder01' => $data->sum_hs0021, //HS0021発注明細金額
                    'intorder02' => $data->sum_hs0049, //HS0049発注明細消費税額
                    'datachar04' => null,
                    'datachar05' => null,
                    'datachar06' => null,
                    'datachar07' => null,
                    'datatxt0147' => null,
                    'deletedate' => null,
                    'date0012' => null,
                    'datachar12' => null,
                    'datachar13' => null,
                    'datachar14' => null,
                    'datachar15' => null,
                    'date0013' => null,
                    'date0014' => null,
                    'date0015' => null,
                    'datatxt0148' => null,
                    'datatxt0149' => null,
                    'datatxt0150' => null,
                    'datatxt0151' => null,
                    'intorder03' => null,
                    'datatxt0152' => null,
                    'synchroorderbango' => null,
                    'date0018' => null,
                    'date0019' => null,
                    // 'datatxt0144' => null,
                    'datatxt0154' => null,
                    'synchroorderbango2' => 0,
                    'date0016' => $data->hc0041, //（元の値を保持）
                    'date0017' => Carbon::now()->format('Y-m-d H:i:s'),
                    'datatxt0155' => '0999',
                    'datatxt0156' => 'U810',
                    'datatxt0157' => null,
                    'date0020' => null,
                    'datatxt0158' => null, //U123のみ※HC0047 それ以外null,
                ];
                // dd($orderhenkan);
                $orderhenkan = QueryHelper::insertData('orderhenkan', $orderhenkan, 'bango', true, $bango, __CLASS__, __FUNCTION__, __LINE__);

                $hikiatenyuko = [
                    'orderbango' => $orderhenkan->bango,
                    'syouhinid' => $orderhenkan->kokyakuorderbango, // HC0001発注番号
                    'syouhinsyu' => 2,
                    'hantei' => null,
                    'dataint01' => null,
                    'dataint02' => 2,
                    'dataint03' => 2,
                    'dataint04' => 2,
                    'dataint05' => 2,
                    'datachar01' => null,
                    'dataint06' => 2,
                    'dataint07' => 2,
                    'dataint08' => null,
                    'dataint09' => null,
                    'datachar02' => null,
                    'datachar03' => null,
                    'datachar04' => null,
                    'datachar05' => null,
                    'yoteimeter' => 0,
                    // 'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'),
                    'denpyoshimebi' => Carbon::now()->format('Y-m-d H:i:s'),
                    'tantousyabango' => "0999",
                ];
                QueryHelper::updateData('hikiatenyuko', $hikiatenyuko, 'syouhinid',$bango, __CLASS__, __FUNCTION__, __LINE__);
                $datachar01 = null;
                $genka = 0;
                $datchar22 = null;
                if($orderEntryData->jm0018 != 0){
                    $datachar01 = 'V150';
                    $genka = $orderEntryData->jm0018;
                    $datchar22 = 1;
                }else if($orderEntryData->jm0015 != 0){
                    $datachar01 = 'V120';
                    $genka = $orderEntryData->jm0015;
                    $datchar22 = 1;
                }
                $syouhinsyu = 0;
                foreach ($minyukoData as $minyukoValues) {
                    $minyukoValues = (object)$minyukoValues;
                    $syouhinsyu++;
                    $kanryoubi = $orderEntryData->jm0025 - 2;
                    $syouhizeiritu = $minyukoValues->hs0017 * $minyukoValues->hs0020;
                    list($datachar18, $soukobango) = self::taxRateCalculation($minyukoValues->hc0007,$syouhizeiritu);
                    $minyuko = [
                        'orderbango' => $orderhenkan->bango,
                        'syouhinid' => $orderhenkan->kokyakuorderbango, //HC0001発注番号
                        'syouhinsyu' => $minyukoValues->hs0002, //HC0001発注番号　毎の連番
                        'hantei' => $minyukoValues->hs0003,
                        'zaikometer' => $minyukoValues->hs0004 + 1,
                        'idoutanabango' => $orderEntryData->jm0001, //JM0001受注番号
                        'yoteimeter' => $orderEntryData->jm0002, //JM0002受注行番号
                        'nyukometer' => $orderEntryData->jm0003, //JM0003受注行番号枝番
                        'datachar01' => $datachar01, //JM0018仕入単価<>0 の場合 V150：仕入 JM0015仕切（SE）<>0の場合 V120：SE
                        'yoteibi' => Helper::getDBFormattedDate($orderEntryData->jm0025), //JM0025個別納期
                        'kanryoubi' => Helper::getDBFormattedDate($kanryoubi), //JM0025　－　２日
                        'kaiinid' => $orderEntryData->jm0026, //JM0026納品先CD
                        'datachar02' => $orderEntryData->jm0007, //JM0007商品CD
                        'datachar03' => $orderEntryData->jm0008, //JM0008商品名
                        'dataint20' => $orderEntryData->jm0009, //JM0009商品サブ区分
                        'datachar04' => $orderEntryData->jm0010, //JM0010商品サブCD
                        'datachar05' => $orderEntryData->jm0011, //JM0011商品サブ名称
                        'nyukosu' => $orderEntryData->jm0012, //JM0012数量
                        'datachar06' => $orderEntryData->jm0013, //JM0013単位
                        'kingaku' => $orderEntryData->jm0014, //JM0014販売単価
                        'genka' => $genka, //JM0018仕入単価<>0 の場合 JM0018仕入単価 JM0015仕切（SE）<>0の場合 JM0015仕切（SE）単価
                        'syouhizeiritu' => $syouhizeiritu, //HS0017発注数量×HS0020発注単価
                        'datachar07' => $orderEntryData->jm0021, //JM0021メーカー品番
                        'datachar08' => $orderEntryData->jm0022, //JM0022メーカー品名
                        'datachar09' => $orderEntryData->jm0027, //JM0027発注出荷指示備考
                        'datachar10' => $orderEntryData->jm0029, //JM0029納品方法（G3）
                        'datachar11' => null,
                        'datachar12' => null,
                        'datachar13' => $orderEntryData->jm0015 != 0 ? $orderEntryData->jm0020 : null, //JM0015仕切（SE）<>0の場合 JM0020SE粗利担当 それ以外null,
                        'datachar14' => null,
                        'dataint21' => null,
                        'dataint22' => null,
                        'dataint23' => null,
                        'season' => null,
                        'nengetsu' => null,
                        'datachar15' => null,
                        'datachar16' => null,
                        'denpyobango' => 0,
                        'denpyohakkoubi' => $minyukoValues->hs0038,
                        'denpyoshimebi' => Carbon::now()->format('Y-m-d H:i:s'),
                        'tantousyabango' => '0999',
                        'dataint24' => $orderEntryData->jm0030, //JM0030継続区分
                        'dataint25' => $orderEntryData->jm0031, //JM0031新規バージョンＵＰ区分
                        'weeks' => null,
                        'yoyakubi' => null,
                        'datachar17'  => null,
                        'datachar18' => $minyukoValues->hc0007, //HC0007仕入先ＣＤより支払課税区分（共通仕様K16）
                        'soukobango' => $soukobango, //HS0021発注明細金額×消費税率（HS0048支払課税区分） 端数処理（HC0007仕入先CDより支払税端数区分（共通仕様K16））
                        'datachar19' => null,
                    ];
                    $minyuko = QueryHelper::insertData('minyuko', $minyuko, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                    
                    $juchusyukko2 = [
                        'orderbango' => $orderhenkan->bango,
                        'syouhinid' => $minyuko->syouhinid, //HM0001発注番号
                        'syouhinsyu' => $minyuko->syouhinsyu, //HM0002発注行番号
                        'hantei' => $minyuko->hantei, //HM0003発注行番号枝番
                        'season' => 1,
                        'nengetsu' => null,
                        'weeks' => null,
                        'datachar01' => null,
                        'datachar02' => null,
                        'datachar03' => null,
                        'datachar04' => null,
                        'yoteimeter' => 0,
                        // 'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'),
                        'denpyoshimebi' => Carbon::now()->format('Y-m-d H:i:s'),
                        'tantousyabango' => '0999',
                        'day' =>  2,
                        'tanka' =>  2,
                        'barcode' => null,
                        'codename' => null,
                    ];
                    QueryHelper::updateData('juchusyukko2', $juchusyukko2, ['syouhinid' => $minyuko->syouhinid,'syouhinsyu' => $minyukoValues->hs0002, 'hantei' => $minyukoValues->hs0003], $bango, __CLASS__, __FUNCTION__, __LINE__);
                }
                
                // $misyukko = [
                //     // 'tantousyabango' => $bango,
                //     'datachar22' => $datachar22,
                // ];
                // QueryHelper::updateData('misyukko', $misyukko, ['syouhinid' => $orderEntryData->jm0001, 'syouhinsyu' => $orderEntryData->jm0002, 'hantei' => $orderEntryData->jm0003], $bango, __CLASS__, __FUNCTION__, __LINE__);

                //inserting into rireki
                CreateHatchuDetails::data($bango,$kokyakuorderbango, $ordertypebango2,2,'05-09');

                // $result['status'] = 'ok';
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 05-09 Menu end\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "COMMIT");
                // session()->flash('success_msg', "発注番号" . $kokyakuorderbango . "で登録しました。");

            }catch (\Exception $e) {
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "ROLLBACK");
                // session()->flash('success_msg', "something" . $kokyakuorderbango . "went wrong");
                // $result['status'] = 'ng';
                // $result['exception'] = $e->getMessage();
            }
            // dd($orderhenkan, $hikiatenyuko,$minyuko,$juchusyukko2);
        }
    }

    public static function delete($bango, $orderEntryData)
    {
        $hatchuData = self::getHatchuData($orderEntryData->ju0004,
                                            $orderEntryData->jm0001,
                                            $orderEntryData->jm0002,
                                            $orderEntryData->jm0003);
        $orderHenkanData = $hatchuData->unique('hc0001');
        // if($orderHenkanData){
        //     dd($orderHenkanData);
        // }
        foreach ($orderHenkanData as $data) {
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 05-09 Menu start\n";
            QueryHandler::logger($bango, $log_data);
            $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
            pg_query($conn, "BEGIN");
            try {
                $data = (object)$data;
                $minyukoData = $hatchuData->where('hc0001',$data->hc0001);
                // dd($data);
                // dd("minyuko", $minyukoData);
                $kokyakuorderbango = $data->hc0001;
                $ordertypebango2 = $data->hc0002 + 1;
                $datachar02 = null;
                if($orderEntryData->ju0004 == 'U120'){
                    $datachar02 = 'V420';
                }else if($orderEntryData->ju0004 == 'U122'){
                    $datachar02 = 'V422';
                }else if($orderEntryData->ju0004 == 'U123'){
                    $datachar02 = 'V423';
                }
                $orderhenkan = [
                    'kokyakuorderbango' => $kokyakuorderbango, //（元の値を保持）
                    'ordertypebango2' => $ordertypebango2, //前回値＋１
                    'orderuserbango' => $orderEntryData->ju0001, //（元の値を保持）
                    'datachar01' => null,
                    'datachar02' => $datachar02, //U120の時、V420：保守通常 U122の時、V422：保守請求 U123の時、V423：保守計上
                    'kokyakubango' => 2, //2 訂正
                    'datachar08' => $orderEntryData->jm0023, //JM0023仕入先
                    'date' => Helper::getDBFormattedDate($orderEntryData->jm0024), //JM0024発注日
                    'datachar09' => $orderEntryData->ju0008, //JU0008受注担当者
                    'datachar10' => $orderEntryData->ju0009, //JU0009受注先CD
                    'datachar11' => $orderEntryData->ju0011, //JU0011最終顧客CD
                    'intorder01' => $data->sum_hs0021, //HS0021発注明細金額
                    'intorder02' => $data->sum_hs0049, //HS0049発注明細消費税額
                    'datachar04' => null,
                    'datachar05' => null,
                    'datachar06' => null,
                    'datachar07' => null,
                    'datatxt0147' => null,
                    'deletedate' => null,
                    'date0012' => null,
                    'datachar12' => null,
                    'datachar13' => null,
                    'datachar14' => null,
                    'datachar15' => null,
                    'date0013' => null,
                    'date0014' => null,
                    'date0015' => null,
                    'datatxt0148' => null,
                    'datatxt0149' => null,
                    'datatxt0150' => null,
                    'datatxt0151' => null,
                    'intorder03' => null,
                    'datatxt0152' => null,
                    'synchroorderbango' => null,
                    'date0018' => null,
                    'date0019' => null,
                    // 'datatxt0144' => null,
                    'datatxt0154' => null,
                    'synchroorderbango2' => 1,
                    'date0016' => $data->hc0041, //（元の値を保持）
                    'date0017' => Carbon::now()->format('Y-m-d H:i:s'),
                    'datatxt0155' => '0999',
                    'datatxt0156' => 'U810',
                    'datatxt0157' => null,
                    'date0020' => null,
                    'datatxt0158' => null, //U123のみ※HC0047 それ以外null,
                ];
                // dd($orderhenkan);
                $orderhenkan = QueryHelper::insertData('orderhenkan', $orderhenkan, 'bango', true, $bango, __CLASS__, __FUNCTION__, __LINE__);

                $hikiatenyuko = [
                    'orderbango' => $orderhenkan->bango,
                    'syouhinid' => $orderhenkan->kokyakuorderbango, // HC0001発注番号
                    'syouhinsyu' => 2,
                    'hantei' => null,
                    'dataint01' => null,
                    'dataint02' => 2,
                    'dataint03' => 2,
                    'dataint04' => 2,
                    'dataint05' => 2,
                    'datachar01' => null,
                    'dataint06' => 2,
                    'dataint07' => 2,
                    'dataint08' => null,
                    'dataint09' => null,
                    'datachar02' => null,
                    'datachar03' => null,
                    'datachar04' => null,
                    'datachar05' => null,
                    'yoteimeter' => 1,
                    // 'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'),
                    'denpyoshimebi' => Carbon::now()->format('Y-m-d H:i:s'),
                    'tantousyabango' => "0999",
                ];
                QueryHelper::updateData('hikiatenyuko', $hikiatenyuko, 'syouhinid',$bango, __CLASS__, __FUNCTION__, __LINE__);
                $datachar01 = null;
                $genka = 0;
                $datchar22 = null;
                if($orderEntryData->jm0018 != 0){
                    $datachar01 = 'V150';
                    $genka = $orderEntryData->jm0018;
                    $datchar22 = 1;
                }else if($orderEntryData->jm0015 != 0){
                    $datachar01 = 'V120';
                    $genka = $orderEntryData->jm0015;
                    $datchar22 = 1;
                }
                $syouhinsyu = 0;
                foreach ($minyukoData as $minyukoValues) {
                    $minyukoValues = (object)$minyukoValues;
                    $syouhinsyu++;
                    $kanryoubi = $orderEntryData->jm0025 - 2;
                    $syouhizeiritu = $minyukoValues->hs0017 * $minyukoValues->hs0020;
                    list($datachar18, $soukobango) = self::taxRateCalculation($minyukoValues->hc0007,$syouhizeiritu);
                    $minyuko = [
                        'orderbango' => $orderhenkan->bango,
                        'syouhinid' => $orderhenkan->kokyakuorderbango, //HC0001発注番号
                        'syouhinsyu' => $minyukoValues->hs0002, //HC0001発注番号　毎の連番
                        'hantei' => $minyukoValues->hs0003,
                        'zaikometer' => $minyukoValues->hs0004 + 1,
                        'idoutanabango' => $orderEntryData->jm0001, //JM0001受注番号
                        'yoteimeter' => $orderEntryData->jm0002, //JM0002受注行番号
                        'nyukometer' => $orderEntryData->jm0003, //JM0003受注行番号枝番
                        'datachar01' => $datachar01, //JM0018仕入単価<>0 の場合 V150：仕入 JM0015仕切（SE）<>0の場合 V120：SE
                        'yoteibi' => Helper::getDBFormattedDate($orderEntryData->jm0025), //JM0025個別納期
                        'kanryoubi' => Helper::getDBFormattedDate($kanryoubi), //JM0025　－　２日
                        'kaiinid' => $orderEntryData->jm0026, //JM0026納品先CD
                        'datachar02' => $orderEntryData->jm0007, //JM0007商品CD
                        'datachar03' => $orderEntryData->jm0008, //JM0008商品名
                        'dataint20' => $orderEntryData->jm0009, //JM0009商品サブ区分
                        'datachar04' => $orderEntryData->jm0010, //JM0010商品サブCD
                        'datachar05' => $orderEntryData->jm0011, //JM0011商品サブ名称
                        'nyukosu' => $orderEntryData->jm0012, //JM0012数量
                        'datachar06' => $orderEntryData->jm0013, //JM0013単位
                        'kingaku' => $orderEntryData->jm0014, //JM0014販売単価
                        'genka' => $genka, //JM0018仕入単価<>0 の場合 JM0018仕入単価 JM0015仕切（SE）<>0の場合 JM0015仕切（SE）単価
                        'syouhizeiritu' => $syouhizeiritu, //HS0017発注数量×HS0020発注単価
                        'datachar07' => $orderEntryData->jm0021, //JM0021メーカー品番
                        'datachar08' => $orderEntryData->jm0022, //JM0022メーカー品名
                        'datachar09' => $orderEntryData->jm0027, //JM0027発注出荷指示備考
                        'datachar10' => $orderEntryData->jm0029, //JM0029納品方法（G3）
                        'datachar11' => null,
                        'datachar12' => null,
                        'datachar13' => $orderEntryData->jm0015 != 0 ? $orderEntryData->jm0020 : null, //JM0015仕切（SE）<>0の場合 JM0020SE粗利担当 それ以外null,
                        'datachar14' => null,
                        'dataint21' => null,
                        'dataint22' => null,
                        'dataint23' => null,
                        'season' => null,
                        'nengetsu' => null,
                        'datachar15' => null,
                        'datachar16' => null,
                        'denpyobango' => 1,
                        'denpyohakkoubi' => $minyukoValues->hs0038,
                        'denpyoshimebi' => Carbon::now()->format('Y-m-d H:i:s'),
                        'tantousyabango' => '0999',
                        'dataint24' => $orderEntryData->jm0030, //JM0030継続区分
                        'dataint25' => $orderEntryData->jm0031, //JM0031新規バージョンＵＰ区分
                        'weeks' => null,
                        'yoyakubi' => null,
                        'datachar17'  => null,
                        'datachar18' => $minyukoValues->hc0007, //HC0007仕入先ＣＤより支払課税区分（共通仕様K16）
                        'soukobango' => $soukobango, //HS0021発注明細金額×消費税率（HS0048支払課税区分） 端数処理（HC0007仕入先CDより支払税端数区分（共通仕様K16））
                        'datachar19' => null,
                    ];
                    $minyuko = QueryHelper::insertData('minyuko', $minyuko, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                    
                    $juchusyukko2 = [
                        'orderbango' => $orderhenkan->bango,
                        'syouhinid' => $minyuko->syouhinid, //HM0001発注番号
                        'syouhinsyu' => $minyuko->syouhinsyu, //HM0002発注行番号
                        'hantei' => $minyuko->hantei, //HM0003発注行番号枝番
                        'season' => 1,
                        'nengetsu' => null,
                        'weeks' => null,
                        'datachar01' => null,
                        'datachar02' => null,
                        'datachar03' => null,
                        'datachar04' => null,
                        'yoteimeter' => 0,
                        // 'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'),
                        'denpyoshimebi' => Carbon::now()->format('Y-m-d H:i:s'),
                        'tantousyabango' => '0999',
                        'day' =>  2,
                        'tanka' =>  2,
                        'barcode' => null,
                        'codename' => null,
                    ];
                    QueryHelper::updateData('juchusyukko2', $juchusyukko2, ['syouhinid' => $minyuko->syouhinid,'syouhinsyu' => $minyukoValues->hs0002, 'hantei' => $minyukoValues->hs0003], $bango, __CLASS__, __FUNCTION__, __LINE__);
                }
                
                // $misyukko = [
                //     // 'tantousyabango' => $bango,
                //     'datachar22' => $datachar22,
                // ];
                // QueryHelper::updateData('misyukko', $misyukko, ['syouhinid' => $orderEntryData->jm0001, 'syouhinsyu' => $orderEntryData->jm0002, 'hantei' => $orderEntryData->jm0003], $bango, __CLASS__, __FUNCTION__, __LINE__);

                //inserting into rireki
                CreateHatchuDetails::data($bango,$kokyakuorderbango, $ordertypebango2,3,'05-09');

                // $result['status'] = 'ok';
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 05-09 Menu end\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "COMMIT");
                // session()->flash('success_msg', "発注番号" . $kokyakuorderbango . "で登録しました。");

            }catch (\Exception $e) {
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "ROLLBACK");
                // session()->flash('success_msg', "something" . $kokyakuorderbango . "went wrong");
                // $result['status'] = 'ng';
                // $result['exception'] = $e->getMessage();
            }
            // dd($orderhenkan, $hikiatenyuko,$minyuko,$juchusyukko2);
        }
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

    public static function taxRateCalculation($contractorId,  $soukobango)
    {
        $yobi12 = substr($contractorId, 0, 6);
        $torihikisakibango = substr($contractorId, 6, 2);
        $haisou = QueryHelper::fetchSingleResult("select * from haisou where torihikisakibango = '$torihikisakibango' and shikibetsucode = '$yobi12'  and kounyusu = 0 ");
        $companyData = QueryHelper::fetchSingleResult("select * from kokyaku1 where yobi12 = '$yobi12' and denpyosaiban = 0 ");
        $haisouBango = $haisou->bango ?? null;
        $companyBango = $companyData->bango ?? null;
        $datachar18 = null;
        $format = null;
        $other1 = null;
        if ($haisouBango) {
            $other2 = QueryHelper::fetchSingleResult("select * from others2 where otherInt1 = $haisouBango");
            $other1 = $other2->other1 ?? null;
            if ($other1) {
                if ($other1 == '1 会社M') {
                    $haisoujouhou = QueryHelper::fetchSingleResult("select * from haisoujouhou where syukei1 = $companyBango");
                    $bunrui4 = $haisoujouhou->bunrui4 ?? null;
                    $bunrui5 = $haisoujouhou->bunrui5 ?? null;
                } elseif ($other1 == '2 事業所M') {
                    $bunrui4 = $other2->other33 ?? null;
                    $bunrui5 = $other2->other35 ?? null;
                }
            }
            if($bunrui4){
                $c1 = substr($bunrui4, 0, 2);
                $c2 = substr($bunrui4, 2, 4);
                $cat = QueryHelper::fetchSingleResult("select concat(category1, category2) as tax, substring(patternsub2,1,2) as cat5 from categorykanri where category1 = '$c1' and category2 = '$c2' ORDER BY category2 ASC");
                $datachar18 = $cat->tax;
                 $soukobango = ( $soukobango * (int)$cat->cat5)/100;   
            }
            if($bunrui5 == 'E21'){
                 $soukobango = round( $soukobango);
            }else if($bunrui5 == 'E22'){
                 $soukobango = floor( $soukobango);
            }else if($bunrui5 == 'E23'){
                 $soukobango = ceil( $soukobango);
            }
        }
        // dd($datachar18,  $soukobango);
        return [$datachar18,  $soukobango];
    }
    public static function getCurrentTime()
    {
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        return str_replace(" ", "", $mytime);
    }
}