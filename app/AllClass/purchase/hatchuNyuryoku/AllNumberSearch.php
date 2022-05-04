<?php


namespace App\AllClass\purchase\hatchuNyuryoku;


use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AllNumberSearch
{
    public static function data($bango, $from = false, Request $request = null)
    {
        $supplier_id = $request->supplier_id ?? null;
        $contractor_id = $request->contractor_id?? null;
        $end_customer = $request->reg_end_customer_db ?? null;
        $condition_sql = "where orderhenkan.datachar05 = '$bango'";
        if ($from) {
            $condition_sql = "";
        }
        // if ($request && $request->category_kanri_def == 'U150' && $request->request_def == 'V410') {
        //     $prefix_sql =  Str::contains($condition_sql, 'where') ? ' and ' : ' where ';
        //     $condition_sql .=  "$prefix_sql hikiatesyukko.datachar04 = '2' and orderhenkan.datachar02 in ('U110', 'U111', 'U120', 'U121', 'U122') ";
        // }
        $prefix_sql =  Str::contains($condition_sql, 'where') ? ' and ' : ' where ';
        $condition_sql .=  "$prefix_sql hikiatesyukko.datachar04 = '2' and orderhenkan.datachar02 in ('U110', 'U111', 'U120', 'U121', 'U122') ";
        // $condition_sql .= Str::contains($condition_sql, 'where') ? ' and ' : ' where ';
        // $condition_sql .= " orderhenkan.datachar02  != 'U123' ";
        $condition_sql .= " AND orderhenkan.synchroorderbango = '0'";
        if($supplier_id){
            $condition_sql .= "AND misyukko.datachar05 = '$supplier_id'";
        }
        if($contractor_id){
            $condition_sql .= "AND tuhanorder.information1 = '$contractor_id'";
        }
        if($end_customer){
            $condition_sql .= "AND tuhanorder.information3 = '$end_customer'";
        }
        QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_tantousha_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_tantousha_temp  as
        select distinct bango, name from tantousya");

        QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_hikiatesyukko_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_hikiatesyukko_temp  as
        select distinct orderbango,datachar04 from hikiatesyukko");

        QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_v_orderinfo_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_v_orderinfo_temp  as
        select distinct bango, juchubango, r15 from v_orderinfo");

        QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_v_torihikisaki_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_v_torihikisaki_temp  as
        select distinct torihikisaki_cd, r17_4, r17 from v_torihikisaki");

        QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_tuhanorder_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_tuhanorder_temp  as
        select distinct
        orderbango,
        money10,
        information1,
        information3,
        juchubango,
        juchukubun1
        from tuhanorder");

        QueryHelper::runQuery("DROP TABLE IF EXISTS misyukko_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE misyukko_temp  as
        select distinct 
        m.kawasename,
        m.syouhinid,
        m.orderbango, 
        m.datachar05, 
        m.datachar09,
        m.datachar22,
        k.kingaku1 
        From 
        (Select syouhinid,datachar05,SUM(dataint08*syukkasu) as kingaku1  
        from misyukko WHERE  (datachar09 != 'G330' and datachar09 not like 'G31_') 
        and datachar13 = '1' and (datachar22 is null or datachar22 not like '___1%')
        group by syouhinid, datachar05) k JOIN misyukko as m on m.syouhinid = k.syouhinid
        and m.datachar05 = k.datachar05");

        // QueryHelper::runQuery("DROP TABLE IF EXISTS misyukko_temp ");
        // QueryHelper::runQuery("CREATE TEMPORARY TABLE misyukko_temp  as
        // select distinct
        // syouhinid,
        // datachar05,
        // kawasename,       
        // datachar09,
        // datachar22,
        // -- sum(syukkasu*dataint08) as kingaku1
        // dataint08 as kingaku1,
        // orderbango 
        // -- from misyukko
        // from misyukko 
        // where
        // (datachar09 != 'G330' and datachar09 not like 'G31_')
        // and datachar13 ='1' and (datachar22 is null or datachar22 not like '___1%')");

        QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_misyukko_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_misyukko_temp  as
        select distinct
        misyukko_temp.kawasename, 
        misyukko_temp.syouhinid,
        misyukko_temp.orderbango, 
        misyukko_temp.datachar05, 
        misyukko_temp.datachar09,
        misyukko_temp.kingaku1,
        syouhin1.kokyakusyouhinbango,
        syouhin1.data52 
        from misyukko_temp 
        join syouhin1
        on misyukko_temp.kawasename = syouhin1.kokyakusyouhinbango
        where syouhin1.data52 In ('C720', 'C730')");
        //where syouhin1.data52 In ('C720', 'C730')
        QueryHelper::runQuery("DROP TABLE IF EXISTS all_number_search_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_number_search_temp  as
        select distinct
        orderhenkan.kokyakuorderbango as order_number,
        substring (tantousya.name,1,3) as responsible_person,
        sold_for.r17_4 as sold_to,
        end_customer_for.r17 as end_customer,
        tantousya.name as person_name,
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
        -- tuhanorder.information1,
        -- tuhanorder.information3,
        tuhanorder.juchukubun1,
        orderhenkan.ordertypebango2,
        supplier.r17 as misyukkodatachar05,
        misyukko.datachar05 as supplier_id,
        misyukko.kingaku1
        FROM orderhenkan
        left join number_search_tantousha_temp as tantousya on orderhenkan.datachar05 = tantousya.bango
        left join number_search_hikiatesyukko_temp as hikiatesyukko on  orderhenkan.bango = hikiatesyukko.orderbango
        left join number_search_tuhanorder_temp as tuhanorder on orderhenkan.bango  = tuhanorder.orderbango
        Inner join number_search_misyukko_temp as misyukko 
        on orderhenkan.bango = misyukko.orderbango AND orderhenkan.kokyakuorderbango = misyukko.syouhinid
        left join  number_search_v_orderinfo_temp as v_orderinfo
        on v_orderinfo.bango = tuhanorder.orderbango and v_orderinfo.juchubango = tuhanorder.juchubango
        left join number_search_v_torihikisaki_temp as sold_for
        on sold_for.torihikisaki_cd = tuhanorder.information1
        left join number_search_v_torihikisaki_temp as end_customer_for
        on end_customer_for.torihikisaki_cd = tuhanorder.information3
        left join number_search_v_torihikisaki_temp as supplier
        on supplier.torihikisaki_cd = misyukko.datachar05
        $condition_sql order by  orderhenkan.intorder03 desc
        ");
        return DB::table('all_number_search_temp');
    }
    public static function dataForRadioButton($bango, $from = false, Request $request = null)
    {
        $supplier_id = $request->supplier_id ?? null;
        $contractor_id = $request->contractor_id ?? null;
        $end_customer = $request->reg_end_customer_db ?? null;
        $condition_sql = "where orderhenkan.datachar09 = '$bango'";
        if ($from) {
            $condition_sql = "";
        }
        // if ($request && $request->category_kanri_def == 'U150' && $request->request_def == 'V410') {
        //     $prefix_sql =  Str::contains($condition_sql, 'where') ? ' and ' : ' where ';
        //     $condition_sql .=  "$prefix_sql hikiatesyukko.datachar04 = '2' and orderhenkan.datachar02 in ('U110', 'U111', 'U120', 'U121', 'U122') ";
        // }
        $prefix_sql =  Str::contains($condition_sql, 'where') ? ' and ' : ' where ';
        $condition_sql .=  "$prefix_sql orderhenkan.datachar02 in ('V410', 'V440', 'V420', 'V460', 'V422') ";
        // $condition_sql .= Str::contains($condition_sql, 'where') ? ' and ' : ' where ';
        $condition_sql .= " AND orderhenkan.synchroorderbango2 = '0'";
        if($supplier_id){
            $condition_sql .= "AND orderhenkan.datachar08 = '$supplier_id'";
        }
        if($contractor_id){
            $condition_sql .= "AND orderhenkan.datachar10 = '$contractor_id'";
        }
        if($end_customer){
            $condition_sql .= "AND orderhenkan.datachar11 = '$end_customer'";
        }
        QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_tantousha_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_tantousha_temp  as
        select distinct bango, name from tantousya");

        QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_v_torihikisaki_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_v_torihikisaki_temp  as
        select distinct torihikisaki_cd, r17_4, r17 from v_torihikisaki");

        QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_minyuko_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_minyuko_temp  as
        select distinct on
        (orderbango,
        syouhinid)
        orderbango,
        syouhinid,
        datachar03
        from minyuko");

        // QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_minyuko_temp ");
        // QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_minyuko_temp  as
        // select distinct on
        // (m.orderbango,
        // m.syouhinid)
        // m.orderbango,
        // m.syouhinid,
        // m.datachar03,
        // m.syouhinsyu,
        // k.total_amount
        // from 
        // (Select syouhinid,zaikometer, sum(syouhizeiritu) as total_amount from minyuko group by syouhinid, zaikometer) k JOIN minyuko as m on m.syouhinid = k.syouhinid
        // and k.zaikometer = (select max(zaikometer) from minyuko where syouhinid = m.syouhinid)");

        QueryHelper::runQuery("DROP TABLE IF EXISTS all_number_search_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_number_search_temp  as
        select distinct
        orderhenkan.kokyakuorderbango as order_number,
        substring (tantousya.name,1,3) as responsible_person,
        tantousya.name as person_name,
        sold_for.r17_4 as sold_to,
        end_customer_for.r17 as misyukkodatachar05,
        to_char(orderhenkan.date, 'YYYY/MM/DD') as estimate_date,
        orderhenkan.synchroorderbango2,
        orderhenkan.intorder01 as orders,
        -- minyuko.total_amount as orders,
        orderhenkan.datachar05,
        orderhenkan.datachar09,
        orderhenkan.datachar10,
        orderhenkan.datachar08 as supplier_id,
        orderhenkan.ordertypebango2,
        orderhenkan.date,
        minyuko.datachar03 as juchukubun1,
        minyuko.orderbango
        FROM orderhenkan
        left join number_search_tantousha_temp as tantousya on orderhenkan.datachar09 = tantousya.bango
        inner join number_search_minyuko_temp as minyuko 
        on orderhenkan.bango = minyuko.orderbango AND orderhenkan.kokyakuorderbango = minyuko.syouhinid
        left join number_search_v_torihikisaki_temp as sold_for
        on sold_for.torihikisaki_cd = orderhenkan.datachar10
        left join number_search_v_torihikisaki_temp as end_customer_for
        on end_customer_for.torihikisaki_cd = orderhenkan.datachar08
        $condition_sql order by  orderhenkan.kokyakuorderbango desc
        ");
        return DB::table('all_number_search_temp');
    }
    
    public static function dataForSupport($bango, $from = false, Request $request = null)
    {
        $supplier_id = $request->supplier_id ?? null;
        $contractor_id = $request->contractor_id ?? null;
        $end_customer = $request->reg_end_customer_db ?? null;
        $condition_sql = "where orderhenkan.datachar09 = '$bango'";
        if ($from) {
            $condition_sql = "";
        }
        $prefix_sql =  Str::contains($condition_sql, 'where') ? ' and ' : ' where ';
        $condition_sql .=  "$prefix_sql orderhenkan.datachar02 = 'V413' ";
        $condition_sql .= " AND orderhenkan.synchroorderbango2 = '0' AND hikiatesyukko.datachar17 is null ";
        if($supplier_id){
            $condition_sql .= "AND orderhenkan.datachar08 = '$supplier_id'";
        }
        if($contractor_id){
            $condition_sql .= "AND orderhenkan.datachar10 = '$contractor_id'";
        }
        if($end_customer){
            $condition_sql .= "AND orderhenkan.datachar11 = '$end_customer'";
        }
        QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_tantousha_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_tantousha_temp  as
        select distinct bango, name from tantousya");

        QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_v_torihikisaki_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_v_torihikisaki_temp  as
        select distinct torihikisaki_cd, r17_4, r17 from v_torihikisaki");

        QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_minyuko_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_minyuko_temp  as
        select distinct
        m.orderbango,
        m.syouhinid,
        m.datachar03,
        m.syouhinsyu,
        m.syouhizeiritu
        from 
        (Select syouhinid, syouhinsyu from minyuko group by syouhinid, syouhinsyu) k JOIN minyuko as m on m.syouhinid = k.syouhinid
        and m.syouhinsyu = k.syouhinsyu");

        QueryHelper::runQuery("DROP TABLE IF EXISTS all_number_search_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_number_search_temp  as
        select distinct
        orderhenkan.kokyakuorderbango as order_number,
        substring (tantousya.name,1,3) as responsible_person,
        tantousya.name as person_name,
        sold_for.r17_4 as sold_to,
        end_customer_for.r17 as misyukkodatachar05,
        to_char(orderhenkan.date, 'YYYY/MM/DD') as estimate_date,
        orderhenkan.synchroorderbango2,
        minyuko.syouhizeiritu as orders,
        orderhenkan.datachar05,
        orderhenkan.datachar09,
        orderhenkan.datachar10,
        orderhenkan.datachar08 as supplier_id,
        orderhenkan.ordertypebango2,
        orderhenkan.date,
        minyuko.datachar03 as juchukubun1,
        minyuko.orderbango,
        CASE 
            WHEN LENGTH(minyuko.syouhinsyu::text)=2 
            THEN concat_ws('0', minyuko.syouhinid, minyuko.syouhinsyu)
            WHEN LENGTH(minyuko.syouhinsyu::text)=1 
            THEN concat_ws('00', minyuko.syouhinid, minyuko.syouhinsyu)
            ELSE concat_ws('', minyuko.syouhinid, minyuko.syouhinsyu)
        END AS support_number
        FROM orderhenkan
        join (select kokyakuorderbango,max(ordertypebango2) as maxval from orderhenkan group by kokyakuorderbango) as orderhenkan_m
        on orderhenkan_m.maxval = orderhenkan.ordertypebango2
        and orderhenkan_m.kokyakuorderbango = orderhenkan.kokyakuorderbango
        left join number_search_tantousha_temp as tantousya on orderhenkan.datachar09 = tantousya.bango
        left join hikiatesyukko on  orderhenkan.bango = hikiatesyukko.orderbango
        inner join number_search_minyuko_temp as minyuko 
        on orderhenkan.bango = minyuko.orderbango AND orderhenkan.kokyakuorderbango = minyuko.syouhinid
        left join number_search_v_torihikisaki_temp as sold_for
        on sold_for.torihikisaki_cd = orderhenkan.datachar10
        left join number_search_v_torihikisaki_temp as end_customer_for
        on end_customer_for.torihikisaki_cd = orderhenkan.datachar08
        $condition_sql order by  orderhenkan.date desc
        ");
        return DB::table('all_number_search_temp');
    }

    // //for checking data
    // public static function dataTest($bango, $from = false, Request $request = null){
    //     QueryHelper::runQuery("DROP TABLE IF EXISTS misyukko_temp ");
    //     QueryHelper::runQuery("CREATE TEMPORARY TABLE misyukko_temp  as
    //     select distinct 
    //     m.kawasename,
    //     m.syouhinid,
    //     m.orderbango, 
    //     m.datachar05, 
    //     m.datachar09,
    //     m.datachar22,
    //     k.kingaku1 
    //     From 
    //     (Select syouhinid,datachar05, SUM(dataint08*syukkasu) as kingaku1  
    //     from misyukko WHERE  (datachar09 != 'G330' and datachar09 not like 'G31_') 
    //     and datachar13 = '1' and (datachar22 is null or datachar22 not like '___1%')
    //     group by syouhinid, datachar05) k JOIN misyukko as m on m.syouhinid = k.syouhinid and m.datachar05 = k.datachar05
    //     ");
    //     QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_misyukko_temp ");
    //     QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_misyukko_temp  as
    //     select distinct
    //     misyukko_temp.kawasename, 
    //     misyukko_temp.syouhinid,
    //     misyukko_temp.orderbango, 
    //     misyukko_temp.datachar05, 
    //     misyukko_temp.datachar09,
    //     misyukko_temp.kingaku1,
    //     syouhin1.kokyakusyouhinbango,
    //     syouhin1.data52 
    //     from misyukko_temp 
    //     join syouhin1
    //     on misyukko_temp.kawasename = syouhin1.kokyakusyouhinbango
    //     and syouhin1.data52 In ('C720', 'C730')");
    //     return DB::table('number_search_misyukko_temp');
    // }
    // public static function data($bango, $from = false, Request $request = null)
    // {

    //     $condition_sql = "where orderhenkan.datachar05 = '$bango'";
    //     if ($from) {
    //         $condition_sql = "";
    //     }
    //     if ($request && $request->category_kanri_def == 'U150' && $request->request_def == '1 新規作成') {
    //         $prefix_sql =  Str::contains($condition_sql, 'where') ? ' and ' : ' where ';
    //         $condition_sql .=  "$prefix_sql hikiatesyukko.datachar04 = '2' and orderhenkan.datachar02 in ('U110', 'U111', 'U120', 'U121', 'U122') ";
    //     }
    //     $condition_sql .= Str::contains($condition_sql, 'where') ? ' and ' : ' where ';
    //     $condition_sql .= " orderhenkan.datachar02  != 'U123' ";

    //     QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_tantousha_temp ");
    //     QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_tantousha_temp  as
    //     select distinct bango, name from tantousya");

    //     QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_hikiatesyukko_temp ");
    //     QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_hikiatesyukko_temp  as
    //     select distinct orderbango,datachar04 from hikiatesyukko");

    //     QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_v_orderinfo_temp ");
    //     QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_v_orderinfo_temp  as
    //     select distinct bango, juchubango, r15 from v_orderinfo");

    //     QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_v_torihikisaki_temp ");
    //     QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_v_torihikisaki_temp  as
    //     select distinct torihikisaki_cd, r17_4 from v_torihikisaki");

    //     QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_tuhanorder_temp ");
    //     QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_tuhanorder_temp  as
    //     select distinct
    //     orderbango,
    //     money10,
    //     information1,
    //     information3,
    //     juchubango
    //     from tuhanorder");

    //     QueryHelper::runQuery("DROP TABLE IF EXISTS all_number_search_temp ");
    //     QueryHelper::runQuery("CREATE TEMPORARY TABLE all_number_search_temp  as
    //     select distinct
    //     orderhenkan.kokyakuorderbango as order_number,
    //     substring (tantousya.name,1,3) as responsible_person,
    //     tantousya.name as person_name,
    //     sold_for.r17_4 as sold_to,
    //     end_customer_for.r17_4 as end_customer,
    //     tuhanorder.money10 as orders,
    //     v_orderinfo.r15 as orders_subject,
    //     case
    //     when orderhenkan.intorder03  is not null then
    //     concat(
    //         substring( cast (orderhenkan.intorder03 as varchar(100)),1,4),
    //         '/',
    //         substring(cast (orderhenkan.intorder03  as varchar(100)),5,2),
    //         '/',
    //         substring(cast (orderhenkan.intorder03  as varchar(100)),7,2)
    //         )
    //     else null
    //     end as estimate_date,
    //     orderhenkan.synchroorderbango,
    //     orderhenkan.intorder03,
    //     orderhenkan.datachar05,
    //     tuhanorder.information1,
    //     tuhanorder.information3,
    //     orderhenkan.ordertypebango2
    //     FROM orderhenkan
    //     left join number_search_tantousha_temp as tantousya on orderhenkan.datachar05 = tantousya.bango
    //     left join number_search_hikiatesyukko_temp as hikiatesyukko on  orderhenkan.bango = hikiatesyukko.orderbango
    //     left join number_search_tuhanorder_temp as tuhanorder on orderhenkan.bango  = tuhanorder.orderbango
    //     left join  number_search_v_orderinfo_temp as v_orderinfo
    //     on v_orderinfo.bango = tuhanorder.orderbango and v_orderinfo.juchubango = tuhanorder.juchubango
    //     left join number_search_v_torihikisaki_temp as sold_for
    //     on sold_for.torihikisaki_cd = tuhanorder.information1
    //     left join number_search_v_torihikisaki_temp as end_customer_for
    //     on end_customer_for.torihikisaki_cd = tuhanorder.information3
    //     $condition_sql order by  orderhenkan.intorder03 desc
    //     ");
    //     return DB::table('all_number_search_temp')->whereRaw('synchroorderbango = ' . 0);
    // }
}
