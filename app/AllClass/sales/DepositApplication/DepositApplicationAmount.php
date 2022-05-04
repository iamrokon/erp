<?php


namespace App\AllClass\sales\DepositApplication;


use App\AllClass\db\QueryHelperFacade as QueryHelper;

class DepositApplicationAmount
{
    public static function calculate($information2)
    {
        try {
            $search_sql = '';
            $search_sql .= $information2 ? " and  tuhanorder.information2 like '" . $information2 . "%'" : "";
            QueryHelper::runQuery("DROP TABLE IF EXISTS tuhanorder_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE tuhanorder_temp AS SELECT DISTINCT

            orderhenkan.bango as orderhenkanBango,
            hikiatesyukko.dataint01,
            (coalesce(tuhanorder.numeric3::bigint,0) + coalesce(tuhanorder.numeric4::bigint,0))  as tuhan_sum_numeric
            from tuhanorder
            inner join orderhenkan on tuhanorder.orderbango =  orderhenkan.bango
            inner join hikiatesyukko on tuhanorder.orderbango = hikiatesyukko.orderbango

            where tuhanorder.text1 <> 'U560' and tuhanorder.unsoudaibikitesuryou='1'   and   tuhanorder.juchukubun2 is not null
             $search_sql
            and    hikiatesyukko.dataint01 = 2
            ");
            $numeric_sum_tuhanorder = QueryHelper::fetchSingleResult("select
            SUM(tuhan_sum_numeric) as tuhanorder_sum
            from tuhanorder_temp");

            QueryHelper::runQuery("DROP TABLE IF EXISTS daikinseisanold_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE daikinseisanold_temp AS SELECT DISTINCT
                tuhanorder.numeric4,
            case
                when daikinseisanold.nyukingaku is null
                    then 0
                else daikinseisanold.nyukingaku end as nyukingaku ,
            orderhenkan.intorder05,
            orderhenkan.bango as orderhenkanBango,
            hikiatesyukko.dataint01,
            hikiatesyukko.orderbango as hikiatesyukkobango,
            (coalesce(tuhanorder.numeric3::bigint,0) + coalesce(tuhanorder.numeric4::bigint,0))  as tuhan_sum_numeric
            from tuhanorder
            inner join orderhenkan on tuhanorder.orderbango =  orderhenkan.bango
            inner join hikiatesyukko on tuhanorder.orderbango = hikiatesyukko.orderbango
            inner join daikinseisanold on tuhanorder.juchukubun2 = daikinseisanold.otodoketime
                                       and daikinseisanold.unsoudaibikitesuryou='0'
            where tuhanorder.text1 <> 'U560' and  tuhanorder.text1 <> 'U523'  and  tuhanorder.juchukubun2 is not null
             $search_sql
            and    hikiatesyukko.dataint01 = 2
                ");

            $numeric_sum_daikinseisanold = QueryHelper::fetchSingleResult("select
            SUM(nyukingaku) as daikinseisanold_sum
            from daikinseisanold_temp");

            return ($numeric_sum_tuhanorder->tuhanorder_sum - $numeric_sum_daikinseisanold->daikinseisanold_sum);
        } catch (\Exception $e) {

            return 0;
        }

    }

}
