<?php


namespace App\AllClass\support\inhouseEntry;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AllNumberSearch
{
    public static function data($bango, $from = false, Request $request = null)
    {
        QueryHelper::runQuery("DROP TABLE IF EXISTS inhouse_entry_v_torihikisaki_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE inhouse_entry_v_torihikisaki_temp as
        select *
        from v_torihikisaki
        ");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_v_orderinfo_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_v_orderinfo_temp  as
        select distinct bango, juchubango, r15 from v_orderinfo");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_m");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_m as
        select distinct 
        kokyakuorderbango, max(ordertypebango2) as maxval
        from orderhenkan
        where synchroorderbango2 = 0
        --and kokyakuorderbango = '0351000592'
        group by kokyakuorderbango
        ");
        //$data = QueryHelper::fetchResult("select * from orderhenkan_inner_data");
        //dd($data);
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_delete_check ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_delete_check as
        select  
        kokyakuorderbango
        from orderhenkan
        where synchroorderbango2 = 1 
        ");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_inner_data");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_inner_data as
        select distinct 
        kokyakuorderbango, max(ordertypebango2) as maxval
        from orderhenkan
        where synchroorderbango = 0 and datachar10 is null
        group by kokyakuorderbango");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS juchusyukko2_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE juchusyukko2_temp as
        select distinct 
        syouhinid,
        --codename,
        count(orderbango) as count_orderbango
        from juchusyukko2
        where codename is null
        group by syouhinid");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS inhouse_entry_number_search ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE inhouse_entry_number_search  as
        select distinct
        orderhenkan.kokyakuorderbango as order_number,
        substring (tantousya.name,1,3) as responsible_person,
        tantousya.name as person_name,
        --(case when misyukko.yoteimeter IS NOT NULL then TRUE
        --     else FALSE end) as contain_deleted_item,
        --tuhanorder.money10 as orders,
        orderhenkan.intorder01 as orders,
        v_orderinfo.r15 as orders_subject,
        case
        when inner_orderhenkan.intorder03  is not null then
        concat(
            substring( cast (inner_orderhenkan.intorder03 as varchar(100)),1,4),
            '/',
            substring(cast (inner_orderhenkan.intorder03  as varchar(100)),5,2),
            '/',
            substring(cast (inner_orderhenkan.intorder03  as varchar(100)),7,2)
            )
        else null
        end as estimate_date,
        orderhenkan.synchroorderbango,
        inner_orderhenkan.intorder03,
        inner_orderhenkan.datachar05,
        tuhanorder.information1,
        tuhanorder.information3,
        orderhenkan.ordertypebango2,
        sold_for.r17_4 as sold_to,
        end_customer_for.r17_4 as end_customer,
        juchusyukko2_temp.count_orderbango,
        --juchusyukko2_temp.codename,
        (select count(orderbango) from juchusyukko2 where juchusyukko2.syouhinid = orderhenkan.kokyakuorderbango and codename is not null) as codename_null_count
        
        from orderhenkan
        
        join orderhenkan_m on orderhenkan_m.kokyakuorderbango = orderhenkan.kokyakuorderbango
        AND orderhenkan_m.maxval = orderhenkan.ordertypebango2
        
        join orderhenkan as inner_orderhenkan on inner_orderhenkan.kokyakuorderbango = orderhenkan.orderuserbango
        
        join orderhenkan_inner_data on orderhenkan_inner_data.kokyakuorderbango = inner_orderhenkan.kokyakuorderbango
        AND orderhenkan_inner_data.maxval = inner_orderhenkan.ordertypebango2
        
        left join orderhenkan_delete_check on
        orderhenkan_delete_check.kokyakuorderbango = orderhenkan.kokyakuorderbango
        
        left join tantousya on inner_orderhenkan.datachar05 = tantousya.bango

        join tuhanorder on tuhanorder.juchubango = orderhenkan.orderuserbango
        
        left join  number_search_v_orderinfo_temp as v_orderinfo
            on v_orderinfo.bango = tuhanorder.orderbango and v_orderinfo.juchubango = tuhanorder.juchubango
            
        join hikiatenyuko on hikiatenyuko.syouhinid = orderhenkan.kokyakuorderbango
        
        left join inhouse_entry_v_torihikisaki_temp as sold_for on sold_for.torihikisaki_cd = tuhanorder.information1
        
        left join inhouse_entry_v_torihikisaki_temp as end_customer_for
            on end_customer_for.torihikisaki_cd = tuhanorder.information3
            
        left join juchusyukko2_temp on juchusyukko2_temp.syouhinid = orderhenkan.kokyakuorderbango
            
        where orderhenkan.datachar02 = 'V413' AND hikiatenyuko.dataint03 = 1 
        AND orderhenkan_delete_check.kokyakuorderbango IS NULL
        --AND count_orderbango is null
        ");
        
        if($from){
            return DB::table('inhouse_entry_number_search');
        }else{
            //return DB::table('inhouse_entry_number_search')->whereRaw("datachar05 = '$bango'");
            return DB::table('inhouse_entry_number_search');
        }
        
        
    }
}
