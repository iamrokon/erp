<?php

namespace App\AllClass\sales\depositAccountDataCreation;

use DB;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class allData{
    public static function data($date_start,$date_end,$flag)
    {
        $date_start_with_hour = $date_start;
        $date_end_with_hour = $date_end." 23:59:59";

        if($flag=='new') $mail_flag = "eczaikorendou.tsuchimail = '2'";
        else $mail_flag = "eczaikorendou.tsuchimail IN ('1','2')";

        QueryHelper::runQuery("DROP TABLE IF EXISTS all_data1");
        QueryHelper::runQuery("DROP TABLE IF EXISTS all_data2");


        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_data1 as
            select distinct
            max(daikinseisan.shinkurokokyakuname) as CK0001,
            -- daikinseisan.shinkurokokyakugroup as CK0002,
            daikinseisan.soufusakiname as CK0003,
            -- CASE
            --     WHEN daikinseisan.soufusakiname='A907' THEN daikinseisanold.otodoketime
            --     ELSE NULL
            -- END as CK0004,
            sum(daikinseisanold.nyukingaku) as CK0005,
            SUBSTRING(daikinseisan.torikomidate::TEXT,1,10) as CK0006,
            -- daikinseisan.chumonsyaname as CK0007,
            max(daikinseisan.soufusakiyubinbango) as CK0008,
            daikinseisan.unsoumei as CK0009,
            sum(daikinseisan.nyukingaku) as CK0010,
            TO_CHAR(daikinseisan.chumondate, 'YYYY-MM-DD') as CK0011,
            MAX(CASE
                WHEN daikinseisanold.otodoketime IS NULL OR daikinseisanold.otodoketime = '0000000000' THEN 'U510'
                ELSE tuhanorder.text1
            END) as CK0012,
            MAX(CASE
                --WHEN daikinseisanold.otodoketime IS NULL OR daikinseisanold.otodoketime LIKE '^0+$' THEN '1'
                WHEN daikinseisanold.otodoketime IS NULL OR daikinseisanold.otodoketime = '0000000000' THEN '1'
                ELSE tuhanorder.unsoudaibikitesuryou
            END) as CK0013,

            max(tuhanorder.unsoudaibikitesuryou) as unsoudaibikitesuryou

            from daikinseisanold

            join daikinseisan on daikinseisanold.shinkurokokyakugroup = daikinseisan.shinkurokokyakugroup AND daikinseisanold.shinkurokokyakuname = daikinseisan.shinkurokokyakuname

            join eczaikorendou on daikinseisanold.shinkurokokyakugroup::INTEGER = eczaikorendou.yukouflag AND daikinseisanold.shinkurokokyakuname = eczaikorendou.sitename

            left join orderhenkan on daikinseisanold.otodoketime = orderhenkan.datachar10

            left join tuhanorder on tuhanorder.orderbango = orderhenkan.bango

            left join hikiatesyukko on hikiatesyukko.orderbango = orderhenkan.bango

            where
            daikinseisan.torikomidate>=TO_TIMESTAMP('$date_start_with_hour', 'YYYY/MM/DD HH24:MI:SS')
            AND daikinseisan.torikomidate<=TO_TIMESTAMP('$date_end_with_hour', 'YYYY/MM/DD HH24:MI:SS')
            AND $mail_flag
            AND (CASE
                WHEN daikinseisanold.otodoketime = '0000000000' THEN true
                ELSE hikiatesyukko.yoteimeter = '0' END)
            --AND hikiatesyukko.yoteimeter = '0'
            AND daikinseisan.dataint01 = '0'
            --AND daikinseisan.soufusakiname not in ('A907', 'A908', 'A910')
            AND daikinseisan.soufusakiname not in ('A908', 'A910')

            --group by CK0003,CK0006,CK0009,CK0011,CK0012,CK0013
            group by CK0003,CK0006,CK0009,CK0011
            ");
        
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_data2 as
            select distinct
            max(daikinseisan.shinkurokokyakuname) as CK0001,
            -- daikinseisan.shinkurokokyakugroup as CK0002,
            daikinseisan.soufusakiname as CK0003,
            -- daikinseisan.otodoketime as CK0004,
            sum(daikinseisan.nyukingaku) as CK0005,
            SUBSTRING(daikinseisan.torikomidate::TEXT,1,10) as CK0006,
            -- daikinseisan.chumonsyaname as CK0007,
            max(daikinseisan.soufusakiyubinbango) as CK0008,
            daikinseisan.unsoumei as CK0009,
            sum(daikinseisan.nyukingaku) as CK0010,
            CASE
                WHEN daikinseisan.soufusakiname='A907' THEN NULL
                ELSE TO_CHAR(daikinseisan.chumondate, 'YYYY-MM-DD')
            END as CK0011,
            NULL as CK0012,
            NULL::FLOAT as CK0013,
            max(tuhanorder.unsoudaibikitesuryou) as unsoudaibikitesuryou

            from daikinseisan

            left join eczaikorendou on daikinseisan.shinkurokokyakugroup::INTEGER = eczaikorendou.yukouflag AND daikinseisan.shinkurokokyakuname = eczaikorendou.sitename

            left join daikinseisanold on daikinseisanold.shinkurokokyakugroup = daikinseisan.shinkurokokyakugroup AND daikinseisanold.shinkurokokyakuname = daikinseisan.shinkurokokyakuname

            left join orderhenkan on daikinseisanold.otodoketime = orderhenkan.datachar10

            left join tuhanorder on tuhanorder.orderbango = orderhenkan.bango

           where
            daikinseisan.torikomidate>=TO_TIMESTAMP('$date_start_with_hour', 'YYYY/MM/DD HH24:MI:SS')
            AND daikinseisan.torikomidate<=TO_TIMESTAMP('$date_end_with_hour', 'YYYY/MM/DD HH24:MI:SS')
            AND $mail_flag
            AND daikinseisan.soufusakiname = 'A907'
            AND daikinseisan.dataint01 = '0'

            group by CK0003,CK0006,CK0009,CK0011,CK0012,CK0013
            ");

        $sql = "
            SELECT * FROM all_data1
            UNION ALL
            SELECT * FROM all_data2
            ORDER BY CK0006, CK0003, CK0009, CK0011, CK0012, CK0013";
        
        return $sql;
    }
    public static function flag_raise($query_result, $flag, $bango, $current_date)
    {
        foreach($query_result as $query)
        {
            QueryHelper::runQuery("
                UPDATE eczaikorendou
                    SET tsuchimail = '$flag',apitime01 = '$current_date', apiid01 = '$bango'
                    WHERE 
                        sitename = $query->ck0001::TEXT
                ");
        }
    }
}
