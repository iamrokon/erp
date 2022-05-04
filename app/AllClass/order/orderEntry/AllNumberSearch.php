<?php


namespace App\AllClass\order\orderEntry;


use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AllNumberSearch
{
    public static function data($bango, $from = false, Request $request = null)
    {

        $condition_sql = "where orderhenkan.datachar05 = '$bango'";
        if ($from) {
            $condition_sql = "";
        }

        if ($request && $request->category_kanri_def == 'U150') {
        
            $prefix_sql =  Str::contains($condition_sql, 'where') ? ' and ' : ' where ';
            $condition_sql .=  "$prefix_sql hikiatesyukko.datachar04 = '1' and orderhenkan.datachar02 in ('U110','U120') ";
        }
        $condition_sql .= Str::contains($condition_sql, 'where') ? ' and ' : ' where ';
        $condition_sql .= " substring(orderhenkan.kokyakuorderbango::text, 1, 2) = '01' ";

        $condition_sql .= Str::contains($condition_sql, 'where') ? ' and ' : ' where ';
        $condition_sql .= " orderhenkan.datachar02  != 'U123' ";

        QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_tantousha_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_tantousha_temp  as
        select distinct bango, name from tantousya");

        QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_hikiatesyukko_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_hikiatesyukko_temp  as
        select distinct orderbango,datachar04 from hikiatesyukko");

        QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_v_orderinfo_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_v_orderinfo_temp  as
        select distinct bango, juchubango, r15 from v_orderinfo");

        /*QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_v_torihikisaki_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_v_torihikisaki_temp  as
        select distinct torihikisaki_cd, r17_4 from v_torihikisaki");*/

        QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_tuhanorder_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_tuhanorder_temp  as
        select distinct
        orderbango,
        money10,
        information1,
        information3,
        juchubango
        from tuhanorder");

        QueryHelper::runQuery("DROP TABLE IF EXISTS all_number_search_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_number_search_temp  as
        select distinct
        orderhenkan.kokyakuorderbango as order_number,
        substring (tantousya.name,1,3) as responsible_person,
        tantousya.name as person_name,
        (case when misyukko.yoteimeter IS NOT NULL then TRUE
             else FALSE end) as contain_deleted_item,
        tuhanorder.money10 as orders,
        v_orderinfo.r15 as orders_subject,
        case
        when orderhenkan.intorder03  is not null then
        concat(
            substring( cast (orderhenkan.intorder03 as varchar(100)),1,4),
            '/',
            substring(cast (orderhenkan.intorder03  as varchar(100)),5,2),
            '/',
            substring(cast (orderhenkan.intorder03  as varchar(100)),7,2)
            )
        else null
        end as estimate_date,
        orderhenkan.synchroorderbango,
        orderhenkan.intorder03,
        orderhenkan.datachar05,
        tuhanorder.information1,
        tuhanorder.information3,
        orderhenkan.ordertypebango2
        FROM orderhenkan
        left join number_search_tantousha_temp as tantousya on orderhenkan.datachar05 = tantousya.bango
        left join number_search_hikiatesyukko_temp as hikiatesyukko on  orderhenkan.bango = hikiatesyukko.orderbango
        left join number_search_tuhanorder_temp as tuhanorder on orderhenkan.bango  = tuhanorder.orderbango
        left join  number_search_v_orderinfo_temp as v_orderinfo
        on v_orderinfo.bango = tuhanorder.orderbango and v_orderinfo.juchubango = tuhanorder.juchubango
        left join misyukko
        on misyukko.orderbango=orderhenkan.bango 
        and misyukko.yoteimeter = '2'
        
        $condition_sql and orderhenkan.synchroorderbango = 0 and (orderhenkan.kokyakuorderbango,orderhenkan.ordertypebango2) IN 
        ( SELECT kokyakuorderbango,max(ordertypebango2)
        from orderhenkan
        GROUP BY kokyakuorderbango
        ) order by  orderhenkan.intorder03 desc
        ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS all_number_search_temp_final ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_number_search_temp_final  as
            select distinct
            all_number_search_temp.*,
            sold_for.r17_4 as sold_to,
            end_customer_for.r17_4 as end_customer

            from all_number_search_temp

            left join v_torihikisaki as sold_for
            on sold_for.torihikisaki_cd = all_number_search_temp.information1
            left join v_torihikisaki as end_customer_for
            on end_customer_for.torihikisaki_cd = all_number_search_temp.information3
            ");
     
        return DB::table('all_number_search_temp_final');
    }
}
