<?php

namespace App\AllClass\purchase\supplierLedger;

use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AllSupplierLedger
{
    public static function readData($bango, $allRequest)
    {
        $contractor = substr($allRequest['supplier'], 0, 8);
        $contractor_part1 = substr($allRequest['supplier'],0,6);
        $contractor_part2 = substr($allRequest['supplier'],6,2);
        $start_date =  str_replace('/', '', $allRequest['start_date']);
        $end_date =  str_replace('/', '', $allRequest['end_date']);
        $kk=QueryHelper::fetchSingleResult("select
                                            kk0015::int
                                            from kaikakezandaka
                                            where kk0002 = '$contractor'
                                            and to_char(kk0001,'YYYYMM') < '$start_date'
                                            and kk0003 = 1
                                            order by kk0001 desc limit 1")->kk0015 ?? 0;
        // dd($kk);
        $consumption_temp = QueryHelper::fetchSingleResult("
            select
            case left(others2.other1,1)
                when '1' then left(haisoujouhou.datatxt0052,1)
                when '2' then left(others2.other34,1)
            end as consumption_temp
            from kokyaku1
            left join haisoujouhou on haisoujouhou.syukei1 =  kokyaku1.bango
            left join haisou on  haisou.shikibetsucode = '$contractor_part1' and haisou.torihikisakibango = '$contractor_part2'
            left join others2 on others2.otherint1 = haisou.bango
            where kokyaku1.yobi12 = '$contractor_part1'
            ")->consumption_temp;
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS nyukoold_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE nyukoold_temp as
        select distinct 
        *
        from nyukoold
        ");
        QueryHelper::runQuery("DROP TABLE IF EXISTS V_Orderhenkan_shiirei_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE V_Orderhenkan_shiirei_temp as
        select distinct 
        *
        from V_Orderhenkan_shiirei
        ");
        QueryHelper::runQuery("DROP TABLE IF EXISTS v_orderinfo_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE v_orderinfo_temp as
        select distinct 
        bango,
        juchubango,
        r15
        from v_orderinfo
        ");
        // QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_temp");
        // QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_temp as
        // select distinct 
        // *
        // from orderhenkan
        // ");
        // QueryHelper::runQuery("DROP TABLE IF EXISTS tuhanorder_temp");
        // QueryHelper::runQuery("CREATE TEMPORARY TABLE tuhanorder_temp as
        // select distinct 
        // *
        // from tuhanorder
        // ");
        // QueryHelper::runQuery("DROP TABLE IF EXISTS v_torihikisaki_temp");
        // QueryHelper::runQuery("CREATE TEMPORARY TABLE v_torihikisaki_temp as
        // select distinct 
        // *
        // from v_torihikisaki
        // ");
        // QueryHelper::runQuery("DROP TABLE IF EXISTS categorykanri_temp");
        // QueryHelper::runQuery("CREATE TEMPORARY TABLE categorykanri_temp as
        // select distinct 
        // *
        // from categorykanri
        // ");
        QueryHelper::runQuery("DROP TABLE IF EXISTS nyuko_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE nyuko_temp as
        select distinct 
        *
        from nyuko
        ");
        QueryHelper::runQuery("DROP TABLE IF EXISTS hikiatesyukko2_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE hikiatesyukko2_temp as
        select distinct 
        *
        from hikiatesyukko2
        ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS supplier_ledger_temp_1");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE supplier_ledger_temp_1 as
            select distinct
            to_char(toiawasebango.touchakudate, 'YYYY/MM/DD') as ledger_date,
            CASE
                WHEN toiawasebango.toiawasebango is null THEN NULL 
                ELSE concat(categorykanri_1.category2, ' ' ,categorykanri_1.category4)
            END as classification,
            v_torihikisaki_1.r17_3 as contractor,
            nyukoold.datachar08 as product_name,
            nyukoold.syouhizeiritu::text as ledger_amount,
            to_char(nyukoold.syouhizeiritu,'FM99,999,999,999,999') as formatted_ledger_amount,
            orderhenkan_JU.kokyakuorderbango as order_number,
            nyukoold.syouhinid as slip_number,
            CASE 
                WHEN LENGTH(nyukoold.syouhinsyu::text)=2 
                    THEN concat('0', nyukoold.syouhinsyu)
                WHEN LENGTH(nyukoold.syouhinsyu::text)=1 
                    THEN concat('00', nyukoold.syouhinsyu)
                ELSE concat('', nyukoold.syouhinsyu)
            END as line_number,
            nyukoold.nyukosu::text as ledger_number,
            to_char(nyukoold.nyukosu,'FM99,999,999,999,999') as formatted_ledger_number,
            nyukoold.kingaku::text as ledger_unit_price,
            to_char(nyukoold.kingaku,'FM99,999,999,999,999') as formatted_ledger_unit_price,
            -- substring(tuhanorder_JU.juchukubun1, 1, 11) as ledger_subject,
            v_orderinfo.r15 as ledger_subject,
            '' as formatted_ledger_payment_amount,
            '' as ledger_payment_amount
            from
            V_Orderhenkan_shiirei_temp as toiawasebango
            left join nyukoold_temp as nyukoold on nyukoold.syouhinid=toiawasebango.unsoumei
            --発注
            left join orderhenkan as orderhenkan_HC on 
                orderhenkan_HC.kokyakuorderbango=nyukoold.idoutanabango
                AND orderhenkan_HC.ordertypebango2 = (select max(ordertypebango2) from orderhenkan where kokyakuorderbango = orderhenkan_HC.kokyakuorderbango)
            left join orderhenkan as orderhenkan_JU 
                on orderhenkan_JU.kokyakuorderbango=orderhenkan_HC.orderuserbango
                AND orderhenkan_JU.ordertypebango2 = (select max(ordertypebango2) from orderhenkan where kokyakuorderbango = orderhenkan_JU.kokyakuorderbango)
            left join tuhanorder as tuhanorder_JU on tuhanorder_JU.orderbango=orderhenkan_JU.bango
            left join v_torihikisaki as v_torihikisaki_1 on v_torihikisaki_1.torihikisaki_cd = tuhanorder_JU.information1
            left join v_orderinfo_temp as v_orderinfo 
                on v_orderinfo.juchubango = tuhanorder_JU.juchubango
            -- left join v_torihikisaki as v_torihikisaki_2 on substring(v_torihikisaki_2.torihikisaki_cd, 1, 8) = toiawasebango.bikou1
            left join categorykanri as categorykanri_1
                on substring(toiawasebango.toiawasebango,1,2) = categorykanri_1.category1
                and substring(toiawasebango.toiawasebango,3) = categorykanri_1.category2
            where
            to_char(toiawasebango.touchakudate,'YYYYMM') between '$start_date' and '$end_date'
            and toiawasebango.toiawasebango in ('U610','U620','U622','U623','U640')
            and toiawasebango.bikou1 = '$contractor'
            and toiawasebango.datachar03='0'
            and toiawasebango.datanum0013 = (select max(datanum0013) from V_Orderhenkan_shiirei_temp where unsoumei = toiawasebango.unsoumei)
            ");

        QueryHelper::runQuery("UPDATE supplier_ledger_temp_1
        SET contractor = NULL,
            order_number = NULL,
            ledger_subject = NULL
        WHERE line_number::int >1 and line_number != '999' and classification != '支払'
        ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS supplier_ledger_temp_2");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE supplier_ledger_temp_2 as 
            select distinct
            to_char(nyuko.denpyohakkoubi, 'YYYY/MM/DD') as ledger_date,
            '支払' as classification,
            '' as contractor,
            CASE
                WHEN hikiatesyukko2.datachar01 is null THEN NULL 
                ELSE concat(categorykanri_1.category2, ' ' ,categorykanri_1.category4)
            END as product_name,
            '' as ledger_amount,
            '' as formatted_ledger_amount,
            '' as order_number,
            nyuko.syouhinid as slip_number,
            CASE 
                WHEN LENGTH(hikiatesyukko2.syouhinsyu::text)=2 
                    THEN concat('0', hikiatesyukko2.syouhinsyu)
                WHEN LENGTH(hikiatesyukko2.syouhinsyu::text)=1 
                    THEN concat('00', hikiatesyukko2.syouhinsyu)
                ELSE concat('', hikiatesyukko2.syouhinsyu)
            END as line_number,
            '' as ledger_number,
            '' as formatted_ledger_number,
            '' as ledger_unit_price,
            to_char(hikiatesyukko2.kanryoubi, 'YYYY/MM/DD') as formatted_ledger_unit_price,
            '' as ledger_subject,
            to_char(hikiatesyukko2.syouhizeiritu,'FM99,999,999,999,999') as formatted_ledger_payment_amount,
            hikiatesyukko2.syouhizeiritu::text as ledger_payment_amount
            from
            nyuko_temp as nyuko
            left join
            hikiatesyukko2_temp as hikiatesyukko2 on hikiatesyukko2.syouhinid = nyuko.syouhinid
            left join categorykanri as categorykanri_1
                on substring(hikiatesyukko2.datachar01,1,2) = categorykanri_1.category1
                and substring(hikiatesyukko2.datachar01,3) = categorykanri_1.category2
            where 
            to_char(nyuko.denpyohakkoubi,'YYYYMM') between '$start_date' and '$end_date'
            and nyuko.kaiinid = '$contractor'
            and nyuko.season = 1
            and nyuko.denpyobango = 0
            ");

        // Table for purchase-sales-tax 
        QueryHelper::runQuery("DROP TABLE IF EXISTS supplier_ledger_temp_3");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE supplier_ledger_temp_3 as
            select distinct on (m.slip_number, m.line_number)
            *
            From
            (select distinct
            to_char(toiawasebango.touchakudate, 'YYYY/MM/DD') as ledger_date,
            CASE
                WHEN toiawasebango.toiawasebango is null THEN NULL 
                ELSE concat(categorykanri_1.category2, ' ' ,categorykanri_1.category4)
            END as classification,
            '' as contractor,
            '仮払消費税（仕入）' as product_name,
            CASE $consumption_temp
                WHEN '1' THEN toiawasebango.datanum0001::text
                ELSE nyukoold.soukobango::text
            END as ledger_amount,
            CASE $consumption_temp
                WHEN '1' THEN to_char(toiawasebango.datanum0001,'FM99,999,999,999,999')
                ELSE to_char(nyukoold.soukobango,'FM99,999,999,999,999')
            END as formatted_ledger_amount,
            '' as order_number,
            nyukoold.syouhinid as slip_number,
            CASE $consumption_temp
                WHEN '1' THEN '999'
                ElSE
                CASE
                    WHEN LENGTH(nyukoold.syouhinsyu::text)=2 
                        THEN concat('0', nyukoold.syouhinsyu)
                    WHEN LENGTH(nyukoold.syouhinsyu::text)=1 
                        THEN concat('00', nyukoold.syouhinsyu)
                    ELSE concat('', nyukoold.syouhinsyu)
                END
            END as line_number,
            '' as ledger_number,
            '' as formatted_ledger_number,
            '' as ledger_unit_price,
            '' as formatted_ledger_unit_price,
            '' as ledger_subject,
            '' as formatted_ledger_payment_amount,
            '' as ledger_payment_amount
            from
            V_Orderhenkan_shiirei_temp as toiawasebango
            left join nyukoold_temp as nyukoold on nyukoold.syouhinid=toiawasebango.unsoumei
            --発注
            left join orderhenkan as orderhenkan_HC on
                orderhenkan_HC.kokyakuorderbango=nyukoold.idoutanabango
                AND orderhenkan_HC.ordertypebango2 = (select max(ordertypebango2) from orderhenkan where kokyakuorderbango = orderhenkan_HC.kokyakuorderbango)
            left join orderhenkan as orderhenkan_JU 
                on orderhenkan_JU.kokyakuorderbango=orderhenkan_HC.orderuserbango
                AND orderhenkan_JU.ordertypebango2 = (select max(ordertypebango2) from orderhenkan where kokyakuorderbango = orderhenkan_JU.kokyakuorderbango)
            left join tuhanorder as tuhanorder_JU on tuhanorder_JU.orderbango=orderhenkan_JU.bango
            left join v_torihikisaki as v_torihikisaki_1 on v_torihikisaki_1.torihikisaki_cd = tuhanorder_JU.information1
            left join categorykanri as categorykanri_1
                on substring(toiawasebango.toiawasebango,1,2) = categorykanri_1.category1
                and substring(toiawasebango.toiawasebango,3) = categorykanri_1.category2
            where
            to_char(toiawasebango.touchakudate,'YYYYMM') between '$start_date' and '$end_date'
            and toiawasebango.toiawasebango in ('U610','U620','U622','U623','U640')
            and toiawasebango.bikou1 = '$contractor'
            and toiawasebango.datachar03='0'
            and toiawasebango.datanum0013 = (select max(datanum0013) from V_Orderhenkan_shiirei_temp where unsoumei = toiawasebango.unsoumei)
            and nyukoold.datachar18 != 'E110')
            as m
            ");

        // Merging Table
        QueryHelper::runQuery("DROP TABLE IF EXISTS supplier_ledger_temp_before");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE supplier_ledger_temp_before as
            SELECT *,
            -- row_number() OVER () as serial_no_1,
            CASE 
                WHEN ledger.ledger_amount = ''
                THEN 0
                WHEN ledger.ledger_amount is null
                THEN 0
                ELSE ledger.ledger_amount::int
            END as field_208,
            CASE 
                WHEN ledger.ledger_payment_amount = ''
                THEN 0
                WHEN ledger.ledger_payment_amount is null
                THEN 0
                ELSE ledger.ledger_payment_amount::int
            END as field_209
            from 
            (select * from supplier_ledger_temp_1
            UNION
            select * from supplier_ledger_temp_2
            UNION
            select * from supplier_ledger_temp_3) as ledger
            order by 
                ledger.ledger_date,
                ledger.slip_number,
                ledger.line_number,
                CASE $consumption_temp
                    WHEN '2' THEN ledger.ledger_amount
                    END DESC
            ");
        // Calculation 
        QueryHelper::runQuery("DROP TABLE IF EXISTS supplier_ledger_temp_final");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE supplier_ledger_temp_final as
            SELECT *,
            row_number() OVER () as serial_no,
            (field_208 - field_209) as accounts_payable
            FROM 
            supplier_ledger_temp_before
            ");
        QueryHelper::runQuery("UPDATE supplier_ledger_temp_final
            SET accounts_payable = (accounts_payable + $kk)
            WHERE serial_no = 1
            ");
        QueryHelper::runQuery("DROP TABLE IF EXISTS supplier_ledger_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE supplier_ledger_temp as
            SELECT 
            *,
            SUM(accounts_payable) OVER (ORDER BY serial_no) as ledger_accounts_payable,
            to_char(SUM(accounts_payable) OVER (ORDER BY serial_no),'FM99,999,999,999,999') as formatted_ledger_accounts_payable
            FROM
            supplier_ledger_temp_final
            ");
        // if($consumption_temp == 2){
        //     QueryHelper::runQuery("UPDATE supplier_ledger_temp
        //     SET line_number = NULL
        //     WHERE line_number != '999' and product_name = '仮払消費税（仕入）' order by serial_no
        //     ");
        // }
        // $temp_purchase_data = QueryHelper::fetchResult("select * from supplier_ledger_temp");
        // dd($temp_purchase_data); 
        $query = DB::table('supplier_ledger_temp')->toSql();
        return [$query,$kk];
    }
}
