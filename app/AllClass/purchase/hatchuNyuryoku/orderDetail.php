<?php


namespace App\AllClass\purchase\hatchuNyuryoku;


use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;

class orderDetail
{
    public static function data($bango, $orderId)
    {
        $ordertypebango2 = QueryHelper::fetchSingleResult("select max(ordertypebango2) from orderhenkan where kokyakuorderbango = '$orderId' ")->max ?? 0;
        QueryHelper::runQuery("DROP TABLE IF EXISTS order_detail_misyukko_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE order_detail_misyukko_temp as
        select distinct 
        orderhenkan.*, 
        misyukko.datachar05 as supplier_id
        from orderhenkan 
        left join misyukko 
        on orderhenkan.bango = misyukko.orderbango AND orderhenkan.kokyakuorderbango = misyukko.syouhinid ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS order_detail_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE order_detail_temp as
        select distinct
        orderhenkan.datachar08 as datachar08,
        orderhenkan.bango as orderhenkanbango,
        orderhenkan.kokyakuorderbango as order_number,
        orderhenkan.datachar02 as order_classification,
        --orderhenkan.datachar02 as categorikanri,
        --orderhenkan.datachar01 as request,
        orderhenkan.kokyakuorderbango as number_search,
        tuhanorder.information1 as reg_sold_to_db,
        tuhanorder.information2 as reg_sales_billing_destination_db,
        tuhanorder.information3 as reg_end_customer_db,
        tuhanorder.information4 as reg_agency_1_db,
        tuhanorder.information5 as reg_agency_2_db,
        orderhenkan.supplier_id as supplier_db,
        v_torihikisaki_1.r17_3cd as reg_sold_to,
        v_torihikisaki_2.r17_3cd as reg_sales_billing_destination,
        v_torihikisaki_3.r17_3cd as reg_end_customer,
        v_torihikisaki_4.r17_3cd as reg_agency_1,
        v_torihikisaki_5.r17_3cd as reg_agency_2,
        v_torihikisaki_6.r17 as supplier_v2,

        CASE
            WHEN orderhenkan.intorder01 IS NULL THEN NULL
            ELSE
            concat_ws('/',substring(CAST(orderhenkan.intorder01 as text),1,4),
            substring(CAST(orderhenkan.intorder01 as text),5,2),
            substring(CAST(orderhenkan.intorder01 as text),7,2))
            END as orderentry_datepicker1,
        CASE
            WHEN orderhenkan.intorder02 IS NULL THEN NULL
            ELSE
            concat_ws('/',substring(CAST(orderhenkan.intorder02 as text),1,4),
            substring(CAST(orderhenkan.intorder02 as text),5,2),
            substring(CAST(orderhenkan.intorder02 as text),7,2))
            END as datepicker2_oen ,
        CASE
            WHEN orderhenkan.intorder04 IS NULL THEN NULL
            ELSE
            concat_ws('/',substring(CAST(orderhenkan.intorder04 as text),1,4),
            substring(CAST(orderhenkan.intorder04 as text),5,2),
            substring(CAST(orderhenkan.intorder04 as text),7,2))
            END as datepicker3_oen ,
        CASE
            WHEN orderhenkan.intorder03 IS NULL THEN NULL
            ELSE
            concat_ws('/',substring(CAST(orderhenkan.intorder03 as text),1,4),
            substring(CAST(orderhenkan.intorder03 as text),5,2),
            substring(CAST(orderhenkan.intorder03 as text),7,2))
            END as datepicker4_oen ,
        CASE
            WHEN orderhenkan.intorder05 IS NULL THEN NULL
            ELSE
            concat_ws('/',substring(CAST(orderhenkan.intorder05 as text),1,4),
            substring(CAST(orderhenkan.intorder05 as text),5,2),
            substring(CAST(orderhenkan.intorder05 as text),7,2))
            END as datepicker5_oen ,
        tuhanorder.juchukubun1 as order_subject,
        orderhenkan.datachar03 as pj,
        tuhanorder.information8 as voucher_remarks,
        tuhanorder.information7 as in_house_remarks,
       case
        when cast(strpos(soukonyuko.datachar09,'¶') as boolean)  then
            split_part(soukonyuko.datachar09,'¶',1) || '.'||RIGHT(soukonyuko.datachar09, 3)
        else soukonyuko.datachar09 end as customFile,
       case
       when cast(strpos(soukonyuko.datachar09,'¶') as boolean)  and length(split_part(soukonyuko.datachar09,'¶',1)) < 10
                then split_part(soukonyuko.datachar09,'¶',1) || '.'||RIGHT(soukonyuko.datachar09, 3)
        when cast(strpos(soukonyuko.datachar09,'¶') as boolean)
            then LEFT(split_part(soukonyuko.datachar09,'¶',1), 10)||'...'||RIGHT(soukonyuko.datachar09, 3)
        else  LEFT(soukonyuko.datachar09, 10)||'...'||RIGHT(soukonyuko.datachar09, 3) end as custom_file_short,
        orderhenkan.datachar04 as customer_order_number,
        tuhanorder.money10  as money10,
        tuhanorder.moneymax as moneymax,
        tuhanorder.kessaihouhou as kessaihouhou,
        tuhanorder.chumonsyajouhou as chumonsyajouhou,
        tuhanorder.soufusakijouhou as soufusakijouhou,
        case
            when cast(strpos(tuhanorder.housoukubun,' ') as boolean)
            then split_part(tuhanorder.housoukubun,' ',1)
            else  tuhanorder.housoukubun end as housoukubun,
        orderhenkan.ordertypebango2 as ordertypebango2,
        case
            when cast(strpos(hikiatesyukko.datachar01,' ') as boolean)
            then split_part(hikiatesyukko.datachar01,' ',1)
            else  hikiatesyukko.datachar01 end as hikiatesyukkoDatachar01,
        case
            when cast(strpos(hikiatesyukko.datachar04,' ') as boolean)
            then split_part(hikiatesyukko.datachar04,' ',1)
            else  hikiatesyukko.datachar04 end  as hikiatesyukkoDatachar04
        FROM order_detail_misyukko_temp as orderhenkan
        left join tantousya on orderhenkan.datachar05 = tantousya.bango
        left join hikiatesyukko on  orderhenkan.kokyakuorderbango = hikiatesyukko.syouhinid
        left join tuhanorder on orderhenkan.bango  = tuhanorder.orderbango
        --left join soukonyuko on orderhenkan.bango  = soukonyuko.orderbango
        left join v_torihikisaki as v_torihikisaki_1 on v_torihikisaki_1.torihikisaki_cd = tuhanorder.information1
        left join v_torihikisaki as v_torihikisaki_2 on v_torihikisaki_2.torihikisaki_cd = tuhanorder.information2
        left join v_torihikisaki as v_torihikisaki_3 on v_torihikisaki_3.torihikisaki_cd = tuhanorder.information3
        left join v_torihikisaki as v_torihikisaki_4 on v_torihikisaki_4.torihikisaki_cd = tuhanorder.information4
        left join v_torihikisaki as v_torihikisaki_5 on v_torihikisaki_5.torihikisaki_cd = tuhanorder.information5
        left join v_torihikisaki as v_torihikisaki_6 on v_torihikisaki_6.torihikisaki_cd = orderhenkan.supplier_id
        left join soukonyuko on soukonyuko.datachar01  = orderhenkan.datachar08
        where orderhenkan.synchroorderbango = 0 and orderhenkan.kokyakuorderbango='$orderId' and orderhenkan.ordertypebango2  = $ordertypebango2 and orderhenkan.datachar02 not in ('U123', 'U160')
        ");
//        orderhenkan.datachar05 = '$bango'
        return DB::table('order_detail_temp')->toSql();

    }
    public static function dataForRadioButton($bango, $orderId)
    {
        $ordertypebango2 = QueryHelper::fetchSingleResult("select max(ordertypebango2) from orderhenkan where kokyakuorderbango = '$orderId' ")->max ?? 0;
        QueryHelper::runQuery("DROP TABLE IF EXISTS order_detail_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE order_detail_temp as
        select distinct
        tantousya.name as employee_name,
        orderhenkan.datachar08 as datachar08,
        orderhenkan.bango as orderhenkanbango,
        orderhenkan.kokyakuorderbango as order_number,
        orderhenkan.datachar02 as order_classification,
        --orderhenkan.datachar02 as categorikanri,
        --orderhenkan.datachar01 as request,
        orderhenkan.kokyakuorderbango as number_search,
        orderhenkan.datachar08 as supplier_db,
        orderhenkan.datachar10 as reg_sold_to_db,
        orderhenkan.datachar11 as reg_end_customer_db,
        v_torihikisaki_1.r17 as supplier_v2,
        v_torihikisaki_2.r17_3cd as reg_sold_to,
        v_torihikisaki_3.r17_3cd as reg_end_customer,
        to_char(orderhenkan.date, 'YYYY/MM/DD') as datepicker1_oen ,
        orderhenkan.intorder01 as intorder01,
        orderhenkan.intorder02 as total_tax,
        orderhenkan.datachar04 as hacchu_bikou1,
        orderhenkan.datachar05 as hacchu_bikou2,
        orderhenkan.datachar06 as hacchu_bikou3,
        orderhenkan.datachar01 as siiresakimitumori,
        orderhenkan.datatxt0150 as datatxt0150,
        orderhenkan.datatxt0152 as support_number_search,
        orderhenkan.date0016 as date0016,
        orderhenkan.datatxt0156 as payment_criteria,
       case
        when cast(strpos(soukonyuko.datachar09,'¶') as boolean)  then
            split_part(soukonyuko.datachar09,'¶',1) || '.'||RIGHT(soukonyuko.datachar09, 3)
        else soukonyuko.datachar09 end as customFile,
       case
       when cast(strpos(soukonyuko.datachar09,'¶') as boolean)  and length(split_part(soukonyuko.datachar09,'¶',1)) < 10
                then split_part(soukonyuko.datachar09,'¶',1) || '.'||RIGHT(soukonyuko.datachar09, 3)
        when cast(strpos(soukonyuko.datachar09,'¶') as boolean)
            then LEFT(split_part(soukonyuko.datachar09,'¶',1), 10)||'...'||RIGHT(soukonyuko.datachar09, 3)
        else  LEFT(soukonyuko.datachar09, 10)||'...'||RIGHT(soukonyuko.datachar09, 3) end as custom_file_short,
        orderhenkan.datachar04 as customer_order_number,
        orderhenkan.ordertypebango2 as ordertypebango2,
        hikiatenyuko.dataint07 as checkbox
        -- case
        --     when cast(strpos(hikiatesyukko.datachar01,' ') as boolean)
        --     then split_part(hikiatesyukko.datachar01,' ',1)
        --     else  hikiatesyukko.datachar01 end as hikiatesyukkoDatachar01,
        -- case
        --     when cast(strpos(hikiatesyukko.datachar04,' ') as boolean)
        --     then split_part(hikiatesyukko.datachar04,' ',1)
        --     else  hikiatesyukko.datachar04 end  as hikiatesyukkoDatachar04
        FROM orderhenkan
        left join tantousya on orderhenkan.datachar09 = tantousya.bango
        left join hikiatenyuko on  orderhenkan.kokyakuorderbango = hikiatenyuko.syouhinid and orderhenkan.bango = hikiatenyuko.orderbango
        -- left join tuhanorder on orderhenkan.bango  = tuhanorder.orderbango
        --left join soukonyuko on orderhenkan.bango  = soukonyuko.orderbango
        left join v_torihikisaki as v_torihikisaki_1 on v_torihikisaki_1.torihikisaki_cd = orderhenkan.datachar08
        left join v_torihikisaki as v_torihikisaki_2 on v_torihikisaki_2.torihikisaki_cd = orderhenkan.datachar10
        left join v_torihikisaki as v_torihikisaki_3 on v_torihikisaki_3.torihikisaki_cd = orderhenkan.datachar11
        left join soukonyuko on soukonyuko.datachar01  = orderhenkan.datatxt0150
        where orderhenkan.synchroorderbango2 = 0 and orderhenkan.kokyakuorderbango='$orderId' and orderhenkan.ordertypebango2  = $ordertypebango2 and orderhenkan.datachar10 is not null
        ");
//        orderhenkan.datachar05 = '$bango'
        return DB::table('order_detail_temp')->toSql();

    }

    public static function dataForSupport($bango, $orderId, $supportNumber)
    {
        $ordertypebango2 = QueryHelper::fetchSingleResult("select max(ordertypebango2) from orderhenkan where kokyakuorderbango = '$orderId' ")->max ?? 0;
        QueryHelper::runQuery("DROP TABLE IF EXISTS order_detail_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE order_detail_temp as
        select distinct
        tantousya.name as employee_name,
        orderhenkan.datachar08 as datachar08,
        orderhenkan.bango as orderhenkanbango,
        orderhenkan.kokyakuorderbango as order_number,
        orderhenkan.datachar02 as order_classification,
        --orderhenkan.datachar02 as categorikanri,
        --orderhenkan.datachar01 as request,
        '$supportNumber' as number_search,
        orderhenkan.datachar08 as supplier_db,
        orderhenkan.datachar10 as reg_sold_to_db,
        orderhenkan.datachar11 as reg_end_customer_db,
        v_torihikisaki_1.r17 as supplier_v2,
        v_torihikisaki_2.r17_3cd as reg_sold_to,
        v_torihikisaki_3.r17_3cd as reg_end_customer,
        to_char(orderhenkan.date, 'YYYY/MM/DD') as datepicker1_oen ,
        orderhenkan.intorder01 as intorder01,
        orderhenkan.intorder02 as total_tax,
        orderhenkan.datachar04 as hacchu_bikou1,
        orderhenkan.datachar05 as hacchu_bikou2,
        orderhenkan.datachar06 as hacchu_bikou3,
        orderhenkan.datachar01 as siiresakimitumori,
        orderhenkan.datatxt0150 as datatxt0150,
        orderhenkan.date0016 as date0016,
        orderhenkan.datatxt0156 as payment_criteria,
       case
        when cast(strpos(soukonyuko.datachar09,'¶') as boolean)  then
            split_part(soukonyuko.datachar09,'¶',1) || '.'||RIGHT(soukonyuko.datachar09, 3)
        else soukonyuko.datachar09 end as customFile,
       case
       when cast(strpos(soukonyuko.datachar09,'¶') as boolean)  and length(split_part(soukonyuko.datachar09,'¶',1)) < 10
                then split_part(soukonyuko.datachar09,'¶',1) || '.'||RIGHT(soukonyuko.datachar09, 3)
        when cast(strpos(soukonyuko.datachar09,'¶') as boolean)
            then LEFT(split_part(soukonyuko.datachar09,'¶',1), 10)||'...'||RIGHT(soukonyuko.datachar09, 3)
        else  LEFT(soukonyuko.datachar09, 10)||'...'||RIGHT(soukonyuko.datachar09, 3) end as custom_file_short,
        orderhenkan.datachar04 as customer_order_number,
        orderhenkan.ordertypebango2 as ordertypebango2,
        hikiatenyuko.dataint07 as checkbox
        FROM orderhenkan
        left join tantousya on orderhenkan.datachar09 = tantousya.bango
        left join hikiatenyuko on  orderhenkan.kokyakuorderbango = hikiatenyuko.syouhinid and orderhenkan.bango = hikiatenyuko.orderbango
        -- left join tuhanorder on orderhenkan.bango  = tuhanorder.orderbango
        --left join soukonyuko on orderhenkan.bango  = soukonyuko.orderbango
        left join v_torihikisaki as v_torihikisaki_1 on v_torihikisaki_1.torihikisaki_cd = orderhenkan.datachar08
        left join v_torihikisaki as v_torihikisaki_2 on v_torihikisaki_2.torihikisaki_cd = orderhenkan.datachar10
        left join v_torihikisaki as v_torihikisaki_3 on v_torihikisaki_3.torihikisaki_cd = orderhenkan.datachar11
        left join soukonyuko on soukonyuko.datachar01  = orderhenkan.datatxt0150
        where orderhenkan.synchroorderbango2 = 0 and orderhenkan.kokyakuorderbango='$orderId' and orderhenkan.ordertypebango2  = $ordertypebango2 and orderhenkan.datachar02 = 'V413'
        ");
        return DB::table('order_detail_temp')->toSql();

    }

}
