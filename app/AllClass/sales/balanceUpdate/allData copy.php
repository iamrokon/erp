<?php

namespace App\AllClass\sales\balanceUpdate;

use DB;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class allData
{
    public static function sales_data($first_date,$last_date)
    {
        QueryHelper::runQuery("DROP TABLE IF EXISTS syukkoold_sum");
        QueryHelper::runQuery("DROP TABLE IF EXISTS sales_data");

        QueryHelper::runQuery("CREATE TEMPORARY TABLE syukkoold_sum as
            select  orderbango,kaiinid,
                    sum(syukkasu::INTEGER*dataint04::INTEGER) as syukkasu_sum, 
                    sum(datachar20::INTEGER) as datachar20,
                    datachar13 as datachar13
            from syukkoold
            where datachar13 <> '2' AND yoteimeter = 0
            group by orderbango,kaiinid,datachar13");

        QueryHelper::runQuery("CREATE TEMPORARY TABLE sales_data as
            select distinct
                orderhenkan.bango as orderhenkan_bango,
                orderhenkan.kokyakuorderbango as kokyakuorderbango,
                TO_TIMESTAMP(to_char(orderhenkan.intorder03, '9999-99-99'), 'YYYY-MM-01') as intorder03, 
                tuhanorder.text1 as text1,
                left(tuhanorder.information2,8) as information2,
                hikiatesyukko.dataint01 as dataint01,
                syukkoold_sum.syukkasu_sum as syukkasu_sum,
                syukkoold_sum.datachar20 as datachar20,
                syukkoold_sum.datachar13 as datachar13

                from 
                orderhenkan
                
                join tuhanorder on tuhanorder.orderbango = orderhenkan.bango
                AND tuhanorder.juchukubun2 = orderhenkan.datachar10 

                join hikiatesyukko on  hikiatesyukko.orderbango = orderhenkan.bango
                AND hikiatesyukko.kaiinid = orderhenkan.datachar10 

                left join syukkoold_sum on syukkoold_sum.kaiinid = orderhenkan.datachar10
                AND syukkoold_sum.orderbango = orderhenkan.bango

                where tuhanorder.text1 <> 'U560'
                    AND hikiatesyukko.dataint04 = 1
                    AND hikiatesyukko.datachar04 = '1'
                    AND tuhanorder.unsoudaibikitesuryou = 1
                    AND orderhenkan.intorder03 >= $first_date
                    AND orderhenkan.intorder03 <= $last_date

                group by orderhenkan.bango, orderhenkan.kokyakuorderbango, syukkoold_sum.syukkasu_sum, syukkoold_sum.datachar20, syukkoold_sum.datachar13, tuhanorder.text1, tuhanorder.information2, hikiatesyukko.dataint01, orderhenkan.datachar10
                
                order by hikiatesyukko.dataint01 desc

            ");

        $sql = "SELECT * FROM sales_data";

        // dd(QueryHelper::fetchResult("SELECT * FROM sales_data"));

        return $sql;
    }

    public static function deposit_data1($first_date,$last_date)
    {
        QueryHelper::runQuery("DROP TABLE IF EXISTS deposit_data1");

        QueryHelper::runQuery("CREATE TEMPORARY TABLE deposit_data1 as
            select distinct
                orderhenkan.bango as orderhenkan_bango,
                daikinseisanold.nyukingaku as nyukingaku,
                daikinseisanold.otodoketime as otodoketime,
                tuhanorder.text1 as text1,
                daikinseisan.soufusakiname as soufusakiname,
                tuhanorder.unsoudaibikitesuryou as unsoudaibikitesuryou,
                TO_CHAR( daikinseisan.torikomidate, 'YYYY-MM-01' ) as torikomidate,
                LEFT(daikinseisan.chumonsyaname, 8)  as chumonsyaname

                from 
                orderhenkan
                
                join tuhanorder on tuhanorder.orderbango = orderhenkan.bango
                AND tuhanorder.juchubango = orderhenkan.kokyakuorderbango

                join daikinseisanold on daikinseisanold.otodoketime = orderhenkan.datachar10
                
                join daikinseisan on daikinseisanold.shinkurokokyakuname = daikinseisan.shinkurokokyakuname

                join syukkoold on syukkoold.syouhinid = orderhenkan.kokyakuorderbango
                AND syukkoold.orderbango = orderhenkan.bango

                where daikinseisanold.soufusakiname = '2'
                    AND cast(to_char((daikinseisan.torikomidate),'yyyymmdd') as BigInt) >= $first_date
                    AND cast(to_char((daikinseisan.torikomidate),'yyyymmdd') as BigInt) <= $last_date
                    AND syukkoold.datachar13 = '1' 
                    AND syukkoold.yoteimeter = 0

                group by orderhenkan.bango,daikinseisanold.nyukingaku,daikinseisanold.otodoketime,tuhanorder.text1,daikinseisan.soufusakiname,tuhanorder.unsoudaibikitesuryou,daikinseisan.torikomidate,daikinseisan.chumonsyaname
            ");
        

        $sql = "SELECT * FROM deposit_data1";

        return $sql;
    }

    public static function deposit_data2($first_date,$last_date)
    {
        QueryHelper::runQuery("DROP TABLE IF EXISTS deposit_data2");

        QueryHelper::runQuery("CREATE TEMPORARY TABLE deposit_data2 as
            select distinct
                daikinseisanold.shinkurokokyakuname as shinkurokokyakuname,
                daikinseisanold.nyukingaku as nyukingaku,
                daikinseisanold.otodoketime as otodoketime,
                daikinseisan.soufusakiname as soufusakiname,
                TO_CHAR( daikinseisan.torikomidate, 'YYYY-MM-01' ) as torikomidate,
                LEFT(daikinseisan.chumonsyaname, 8)  as chumonsyaname

                from 
                daikinseisanold
                
                join daikinseisan on daikinseisanold.shinkurokokyakuname = daikinseisan.shinkurokokyakuname

                where daikinseisanold.soufusakiname = '2'
                    AND cast(to_char((daikinseisan.torikomidate),'yyyymmdd') as BigInt) >= $first_date
                    AND cast(to_char((daikinseisan.torikomidate),'yyyymmdd') as BigInt) <= $last_date
                    AND daikinseisanold.otodoketime = '0000000000'

                group by daikinseisanold.shinkurokokyakuname,daikinseisanold.nyukingaku,daikinseisanold.otodoketime,daikinseisan.soufusakiname,daikinseisan.torikomidate,daikinseisan.chumonsyaname
            ");
        

        $sql = "SELECT * FROM deposit_data2";

        return $sql;
    }

    public static function note_data($first_date,$last_date)
    {
        QueryHelper::runQuery("DROP TABLE IF EXISTS temp_try");
        QueryHelper::runQuery("DROP TABLE IF EXISTS note_data");

        QueryHelper::runQuery("CREATE TEMPORARY TABLE temp_try as
            select distinct
                orderhenkan.bango as orderhenkan_bango,
                daikinseisan.torikomidate as torikomidate,
                daikinseisan.chumonsyaname as chumonsyaname,
                daikinseisan.nyukingaku as nyukingaku,
                daikinseisan.shinkurokokyakuname as shinkurokokyakuname

                from 
                orderhenkan
                
                join daikinseisanold on daikinseisanold.otodoketime = orderhenkan.datachar10
                
                join daikinseisan on daikinseisanold.shinkurokokyakuname = daikinseisan.shinkurokokyakuname
                
                join eczaikorendou on eczaikorendou.sitename = daikinseisan.shinkurokokyakuname

                where eczaikorendou.siterank IS NULL
                    AND cast(to_char((daikinseisan.torikomidate),'yyyymmdd') as BigInt) >= $first_date
                    AND cast(to_char((daikinseisan.torikomidate),'yyyymmdd') as BigInt) <= $last_date 
                    AND daikinseisan.soufusakiname = 'A907'
                    AND daikinseisan.dataint01 = 0  


                group by orderhenkan.bango,daikinseisan.torikomidate,daikinseisan.chumonsyaname,daikinseisan.nyukingaku,daikinseisan.shinkurokokyakuname
            ");
        
        QueryHelper::runQuery("CREATE TEMPORARY TABLE note_data as
            select distinct
                temp_try.shinkurokokyakuname as shinkurokokyakuname,
                TO_CHAR( temp_try.torikomidate, 'YYYY-MM-01' ) as torikomidate,
                LEFT(temp_try.chumonsyaname, 8)  as chumonsyaname,
                --sum(temp_try.nyukingaku) as nyukingaku
                temp_try.nyukingaku as nyukingaku

                from 
                temp_try

                --group by temp_try.shinkurokokyakuname,temp_try.torikomidate,temp_try.chumonsyaname
                group by temp_try.shinkurokokyakuname,temp_try.torikomidate,temp_try.chumonsyaname,temp_try.nyukingaku

                order by nyukingaku ASC 
            ");
        

        $sql = "SELECT * FROM note_data";

        return $sql;
    }
}
