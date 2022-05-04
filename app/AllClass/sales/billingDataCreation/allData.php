<?php

namespace App\AllClass\sales\billingDataCreation;

use DB;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class allData{
    public static function data($date_start,$date_end,$is_validating=false)
    {
        $sql = "";
        $date_start_without_slash = str_replace("/", "", $date_start);
        $date_end_without_slash = str_replace("/", "", $date_end);

        if($date_start_without_slash != "" && $date_end_without_slash != ""){
            $sql = "where (orderhenkan.intorder05>=$date_start_without_slash AND orderhenkan.intorder05<=$date_end_without_slash) ";
        }else{
           $sql = "where "; 
        }

        if($is_validating)
        {
            $extra_validation =  
            "AND left(tuhanorder.information2, 8) = concat(haisou.shikibetsucode , haisou.torihikisakibango)
            AND RIGHT(others2.otherfloat1::TEXT, 1)='1'
            AND others2.other36 IS NULL";
        }
        else $extra_validation = "";
       
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_m");
        QueryHelper::runQuery("DROP TABLE IF EXISTS syukkoold_sum");
        QueryHelper::runQuery("DROP TABLE IF EXISTS all_data");

        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_m as
            select distinct
            kokyakuorderbango, max(ordertypebango2) as maxval
            from orderhenkan
            where synchroorderbango = 0
            group by kokyakuorderbango");

        QueryHelper::runQuery("CREATE TEMPORARY TABLE syukkoold_sum as
            select orderbango,syouhinid,sum(syukkasu::INTEGER*dataint04::INTEGER) as syukkasu_sum, sum(datachar20::INTEGER) as datachar20
            from syukkoold
            where datachar13 = '3'
            group by orderbango,syouhinid");

        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_data as
            select distinct
            tuhanorder.information2 as dummy,
            --SUBSTRING(tuhanorder.information2,1,8) as information2,
            CASE
                WHEN RIGHT(others2.otherfloat1::TEXT, 1)='1' THEN others2.other36
                ELSE SUBSTRING(tuhanorder.information2,1,8) END as information2,
            --CASE
            --    WHEN others2.other36 is not null THEN others2.other36
            --    ELSE SUBSTRING(tuhanorder.information2,1,8) END as information2,
            orderhenkan.intorder03 as intorder03,
            orderhenkan.intorder05 as intorder05,
            (tuhanorder.numeric3::INTEGER + tuhanorder.numeric4::INTEGER) - (coalesce(syukkoold_sum.syukkasu_sum,0)  + coalesce(syukkoold_sum.datachar20::INTEGER,0)) as billing_amount,
            CASE
                WHEN tuhanorder.kessaihouhou = 'A903' THEN 1
                ELSE 0
            END as kessaihouhou,
            tuhanorder.juchukubun1 as juchukubun1,
            tuhanorder.information8 as information8,
            orderhenkan.datachar10 as datachar10,
            substring(concat(kokyaku1.name,' ',haisou.name),1,40) as name,
            haisoujouhou.datatxt0050 as datatxt0050,
            CASE
               WHEN substring(others2.other1,1,1)='1' THEN RIGHT(kokyaku1.ytoiawsestart,2)
               ELSE RIGHT(others2.other3,2) END as flag_check3,
            CASE
               WHEN substring(others2.other1,1,1)='1' THEN kokyaku1.ytoiawsesaiban
               ELSE others2.other5 END as flag_check5,
            CASE
               WHEN substring(others2.other1,1,1)='1' THEN RIGHT(kokyaku1.ytoiawsestart,2)
               ELSE RIGHT(others2.other6,2) END as flag_check6,
            CASE
               WHEN substring(others2.other1,1,1)='1' THEN kokyaku1.yetoiawsesaiban
               ELSE others2.other8 END as flag_check8

            from orderhenkan

            --join orderhenkan_m on
            --orderhenkan_m.kokyakuorderbango = orderhenkan.kokyakuorderbango
            --AND orderhenkan_m.maxval = orderhenkan.ordertypebango2

            join tuhanorder on tuhanorder.orderbango = orderhenkan.bango
            AND tuhanorder.juchubango = orderhenkan.kokyakuorderbango

            join hikiatesyukko on  hikiatesyukko.orderbango = orderhenkan.bango
            AND hikiatesyukko.syouhinid = orderhenkan.kokyakuorderbango

            left join haisou
            on substring(tuhanorder.information2,7,2) = haisou.torihikisakibango
            and haisou.kounyusu = 0
            and haisou.shikibetsucode = substring(tuhanorder.information2,1,6)

            left join others2
            on others2.otherint1=haisou.bango

            left join kokyaku1
            on substring(tuhanorder.information2,1,6) = kokyaku1.yobi12
            and kokyaku1.denpyosaiban = 0

            left join haisoujouhou
            on haisoujouhou.syukei1=kokyaku1.bango

            left join syukkoold_sum on syukkoold_sum.syouhinid = orderhenkan.kokyakuorderbango
            AND syukkoold_sum.orderbango = orderhenkan.bango

            $sql
            AND orderhenkan.datachar10 is not null

            AND hikiatesyukko.dataint01 = 2
            --AND (tuhanorder.text1 = 'U522' or tuhanorder.text1 = 'U560')
            AND tuhanorder.text1 NOT IN('U522','U560')
            $extra_validation
            --group by orderhenkan.kokyakuorderbango,orderhenkan.bango,tuhanorder.information2,tuhanorder.juchukubun1,tuhanorder.kessaihouhou,tuhanorder.information8,haisou.name,tuhanorder.numeric3,tuhanorder.numeric4,syukkoold_sum.syukkasu,syukkoold_sum.dataint04,syukkoold_sum.datachar20,haisoujouhou.datatxt0050,kokyaku1.name,others2.other1,kokyaku1.ytoiawsestart,others2.other3,others2.other5,others2.other6,others2.other8

            order by orderhenkan.intorder05 ASC, tuhanorder.information2 ASC,orderhenkan.datachar10 ASC
            ");

        $data = DB::table('all_data');
        return $data;
    }
}
