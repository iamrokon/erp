<?php


namespace App\AllClass\sales\DepositInput;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use DB;
class DepositInputAmount
{

     public static function calculate($information2, $intorder05)
    {
        try {
            $search_sql = '';
            $search_sql .= $information2 ? " and  tuhanorder.information2 like '" . $information2 . "%'" : "";
            // $search_sql .= $intorder05 ? " and orderhenkan.intorder05 <= " . $intorder05 : "";
            QueryHelper::runQuery("DROP TABLE IF EXISTS deposit_amount_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE deposit_amount_temp AS SELECT DISTINCT
            tuhanorder.text1,
            tuhanorder.orderbango,
            tuhanorder.information2,
            tuhanorder.juchukubun2,
            tuhanorder.numeric3,
            tuhanorder.numeric4,
            case
                when daikinseisanold.nyukingaku is null
                    then 0
                else daikinseisanold.nyukingaku end as nyukingaku ,
            orderhenkan.intorder05,
            orderhenkan.bango as orderhenkanBango,
            hikiatesyukko.dataint01,
            hikiatesyukko.orderbango as hikiatesyukkobango,
            syukkoold.yoteimeter,
            syukkoold.orderbango as syukkooldbango,
            (coalesce(tuhanorder.numeric3::bigint,0) + coalesce(tuhanorder.numeric4::bigint,0))  as tuhan_sum_numeric,
            (coalesce(syukkoold.syukkasu::bigint,0) * coalesce(syukkoold.dataint04::bigint,0))  as syukkoold_sum_numeric1,
            (coalesce(syukkoold.datachar20::bigint,0))  as syukkoold_sum_numeric2
            from tuhanorder
            inner join orderhenkan on tuhanorder.orderbango =  orderhenkan.bango
            inner join hikiatesyukko on tuhanorder.orderbango = hikiatesyukko.orderbango
            inner join syukkoold on tuhanorder.orderbango = syukkoold.orderbango and tuhanorder.juchukubun2=syukkoold.kaiinid
            left join daikinseisanold on syukkoold.kaiinid = daikinseisanold.otodoketime
            where tuhanorder.text1 <> 'U560'  and   tuhanorder.juchukubun2 is not null
             $search_sql
            and syukkoold.yoteimeter = 0 and   hikiatesyukko.dataint01 = 2 and syukkoold.datachar13='3'");

            /*echo "<pre>";
            $query = DB::table('deposit_amount_temp')->toSql();
            var_dump(collect(QueryHelper::fetchResult($query)));  */

            $numeric_sum = QueryHelper::fetchSingleResult("select
            sum(tuhan_sum_numeric) as tuhanorder_sum,
            SUM(syukkoold_sum_numeric1) as syukkoold_sum_numeric1,
            SUM(syukkoold_sum_numeric2) as syukkoold_sum_numeric2,
            SUM(nyukingaku) as daikinseisanold_sum
            from deposit_amount_temp");

           // var_dump($numeric_sum);

            return ($numeric_sum->tuhanorder_sum - $numeric_sum->syukkoold_sum_numeric1 - $numeric_sum->syukkoold_sum_numeric2 - $numeric_sum->daikinseisanold_sum);


       } catch (\Exception $e) {
           return null;
       }
    }


    public static function calculate_20220210($information2, $intorder05)
    {
        try {
            $search_sql = '';
            $search_sql .= $information2 ? " and  tuhanorder.information2 like '" . $information2 . "%'" : "";
            // $search_sql .= $intorder05 ? " and orderhenkan.intorder05 <= " . $intorder05 : "";
            QueryHelper::runQuery("DROP TABLE IF EXISTS deposit_amount_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE deposit_amount_temp AS SELECT DISTINCT
            tuhanorder.text1,
            tuhanorder.orderbango,
            tuhanorder.information2,
            tuhanorder.juchukubun2,
            tuhanorder.numeric3,
            tuhanorder.numeric4,
            case
                when daikinseisanold.nyukingaku is null
                    then 0
                else daikinseisanold.nyukingaku end as nyukingaku ,
            orderhenkan.intorder05,
            orderhenkan.bango as orderhenkanBango,
            hikiatesyukko.dataint01,
            hikiatesyukko.orderbango as hikiatesyukkobango,
            syukkoold.yoteimeter,
            syukkoold.orderbango as syukkooldbango,
            (coalesce(tuhanorder.numeric3::bigint,0) + coalesce(tuhanorder.numeric4::bigint,0))  as tuhan_sum_numeric
            from tuhanorder
            inner join orderhenkan on tuhanorder.orderbango =  orderhenkan.bango
            inner join hikiatesyukko on tuhanorder.orderbango = hikiatesyukko.orderbango
            inner join syukkoold on tuhanorder.orderbango = syukkoold.orderbango
            left join daikinseisanold on syukkoold.kaiinid = daikinseisanold.otodoketime
            where tuhanorder.text1 <> 'U560' and  tuhanorder.text1 <> 'U523'   and   tuhanorder.juchukubun2 is not null
             $search_sql
            and syukkoold.yoteimeter = 0 and   hikiatesyukko.dataint01 = 2
            ");

            $numeric_sum = QueryHelper::fetchSingleResult("select
            SUM(tuhan_sum_numeric) as tuhanorder_sum,
            SUM(nyukingaku) as daikinseisanold_sum
            from deposit_amount_temp");
            return ($numeric_sum->tuhanorder_sum - $numeric_sum->daikinseisanold_sum);
        } catch (\Exception $e) {
            return null;
        }
    }
}
