<?php


namespace App\AllClass\sales\DepositApplication;


use App\AllClass\db\QueryHelperFacade as QueryHelper;

class AllPaymentDetails
{

    public static function data($information2)
    {
        $payment_details = [];
        $total_applicable_amount = 0;
        try {
            $search_sql = '';
            $search_sql .= $information2 ? " where daikinseisan.chumonsyaname like '" . $information2 . "%'" : "";
            QueryHelper::runQuery("DROP TABLE IF EXISTS daikinseisan_temp2");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE daikinseisan_temp2 AS SELECT DISTINCT
            daikinseisan.shinkurokokyakuname,
            daikinseisan.shinkurokokyakugroup,
            daikinseisan.torikomidate,
            replace(substring(daikinseisan.torikomidate::text,1,10),'-','') as torikomidate_val,
           case
            when daikinseisan.nyukingaku is null
                then 0
            else daikinseisan.nyukingaku end as nyukingaku ,
            daikinseisan.toiawasebango,
            daikinseisan.soufusakiname,
            daikinseisan.chumonsyaname,
            daikinseisan.nyukinbi2,
            daikinseisan.dataint01,
            eczaikorendou.rendoumail
            from daikinseisan
            left join eczaikorendou
                on daikinseisan.shinkurokokyakuname = eczaikorendou.sitename
                and daikinseisan.shinkurokokyakugroup = eczaikorendou.yukouflag::text
            " . $search_sql . "
            and    daikinseisan.dataint01 = 0
            and    eczaikorendou.rendoumail = '2'
        ");
            QueryHelper::runQuery("DROP TABLE IF EXISTS daikinseisanold_temp2");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE daikinseisanold_temp2 AS SELECT DISTINCT
            shinkurokokyakuname as shinkurokokyakunameold,
            shinkurokokyakugroup as shinkurokokyakugroupold,
            sum(coalesce(nyukingaku,0)) as clearingtotal
            from daikinseisanold
            group by shinkurokokyakuname, shinkurokokyakugroup
            ");
                $payment_details = QueryHelper::fetchResult("SELECT
                DISTINCT daikinseisan_temp2.shinkurokokyakuname as deposit_number,
                         daikinseisan_temp2.shinkurokokyakugroup as line,
                         daikinseisan_temp2.torikomidate_val as torikomidate_val,
                         daikinseisan_temp2.nyukinbi2,
                         daikinseisan_temp2.torikomidate_val,
                         daikinseisan_temp2.soufusakiname,
                         substring(daikinseisan_temp2.soufusakiname,1,2),
                         CASE
                             WHEN daikinseisan_temp2.soufusakiname ='A909'  THEN 1
                             ELSE 2 END as serial_int,
                         CASE
                             WHEN daikinseisan_temp2.torikomidate::text is null THEN NULL
                             ELSE concat_ws('/',substring(daikinseisan_temp2.torikomidate::text,1,4),
                             substring(daikinseisan_temp2.torikomidate::text,6,2),
                             substring(daikinseisan_temp2.torikomidate::text,9,2)) END as payment_day,
                         CASE
                         WHEN trim(categorykanri.category2 || ' ' || categorykanri.category4) = '' THEN NULL
                         ELSE (categorykanri.category2 || ' ' || categorykanri.category4) END as payment_method,
                         daikinseisan_temp2.nyukingaku as deposit_amount,
                         daikinseisan_temp2.toiawasebango as remarks,
                         (daikinseisan_temp2.nyukingaku - coalesce(daikinseisanold_temp2.clearingtotal,0)) as applicable_amount
                         FROM daikinseisan_temp2
                         LEFT JOIN daikinseisanold_temp2
                            ON daikinseisan_temp2.shinkurokokyakuname = daikinseisanold_temp2.shinkurokokyakunameold
                            AND  daikinseisan_temp2.shinkurokokyakugroup = daikinseisanold_temp2.shinkurokokyakugroupold
                         LEFT JOIN categorykanri
                         ON substring(daikinseisan_temp2.soufusakiname,1,2) = categorykanri.category1
                         AND substring(daikinseisan_temp2.soufusakiname,3,length(categorykanri.category2)) = categorykanri.category2
                         
                         ORDER BY daikinseisan_temp2.torikomidate_val,serial_int,daikinseisan_temp2.soufusakiname,daikinseisan_temp2.nyukinbi2 
                       ") ?? [];

                       $date0009 = QueryHelper::fetchSingleResult("SELECT max(replace(substring(seikyuzandaka.date0009::text,1,10),'-','')) as date0009 FROM seikyuzandaka where datatxt0142 LIKE '" . $information2 . "%' ")->date0009 ?? 0;
                       //dd($date0009);
            $total_applicable_amount = QueryHelper::fetchSingleResult("SELECT
                     sum((daikinseisan_temp2.nyukingaku - coalesce(daikinseisanold_temp2.clearingtotal,0))) as applicable_amount
                     -- replace(substring(seikyuzandaka.date0009::text,1,10),'-','') as date0009
                     FROM daikinseisan_temp2
                     LEFT JOIN daikinseisanold_temp2
                        ON daikinseisan_temp2.shinkurokokyakuname = daikinseisanold_temp2.shinkurokokyakunameold
                        AND  daikinseisan_temp2.shinkurokokyakugroup = daikinseisanold_temp2.shinkurokokyakugroupold
                     -- LEFT JOIN seikyuzandaka
                     --    ON daikinseisan_temp2.chumonsyaname = seikyuzandaka.datatxt0142
                     WHERE  daikinseisan_temp2.chumonsyaname LIKE '" . $information2 . "%' and daikinseisan_temp2.torikomidate_val::integer > $date0009 ")->applicable_amount ?? 0;

               return [$payment_details, $total_applicable_amount];
        } catch (\Exception $e) {
  
            return [$payment_details, $total_applicable_amount];
        }


    }

}
