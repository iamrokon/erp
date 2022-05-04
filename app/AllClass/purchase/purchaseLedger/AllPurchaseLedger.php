<?php

namespace App\AllClass\purchase\purchaseLedger;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class AllPurchaseLedger{
    public static function data($login_bango,$req_data = null){

        $contractor = substr($req_data['bikou1'], 0, 8);
        $contractor_part1 = substr($req_data['bikou1'],0,6);
        $contractor_part2 = substr($req_data['bikou1'],6,2);
        $start_date =  str_replace('/', '', $req_data['touchakudate_start']);
        $end_date =  str_replace('/', '', $req_data['touchakudate_end']);
        $kk=QueryHelper::fetchSingleResult("select
                                            kk0015::int
                                            from kaikakezandaka
                                            where kk0002 = '$contractor'
                                            and to_char(kk0001,'YYYYMM') < '$start_date'
                                            and kk0003 = 2
                                            order by kk0001 desc limit 1")->kk0015 ?? 0;
        // dd($kk);
        // $consumption_temp = 1;
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

        QueryHelper::runQuery("DROP TABLE IF EXISTS V_Orderhenkan_shiirei_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE V_Orderhenkan_shiirei_temp as
        select distinct 
        *
        from V_Orderhenkan_shiirei
        ");
        QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_ledger_temp_1");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_ledger_temp_1 as
            select distinct
            to_char(toiawasebango.touchakudate, 'YYYY/MM/DD') as touchakudate,
            CASE
                WHEN toiawasebango.toiawasebango is null THEN NULL 
                ELSE concat(categorykanri_1.category2, ' ' ,categorykanri_1.category4)
            END as toiawasebango,
            nyukoold.datachar08 as datachar08,
            nyukoold.syouhizeiritu::text as purchase_ledger_syouhizeiritu,
            to_char(nyukoold.syouhizeiritu,'FM99,999,999,999,999') as formatted_purchase_ledger_syouhizeiritu,
            nyukoold.syouhinid as syouhinid,
            CASE 
                WHEN LENGTH(nyukoold.syouhinsyu::text)=2 
                    THEN concat('0', nyukoold.syouhinsyu)
                WHEN LENGTH(nyukoold.syouhinsyu::text)=1 
                    THEN concat('00', nyukoold.syouhinsyu)
                ELSE concat('', nyukoold.syouhinsyu)
            END as syouhinsyu,
            nyukoold.nyukosu::text as purchase_ledger_nyukosu,
            to_char(nyukoold.nyukosu,'FM99,999,999,999,999') as formatted_purchase_ledger_nyukosu,
            nyukoold.kingaku::text as purchase_ledger_kingaku,
            to_char(nyukoold.kingaku,'FM99,999,999,999,999') as formatted_purchase_ledger_kingaku,
            '' as formatted_purchase_ledger_payment_amount,
            '' as purchase_ledger_payment_amount,
            CASE
                WHEN nyukoold.barcode is null THEN NULL 
                ELSE concat(categorykanri_2.category2, ' ' ,categorykanri_2.category4)
            END as barcode,
            CASE
                WHEN nyukoold.codename is null THEN NULL 
                ELSE concat(categorykanri_3.category2, ' ' ,categorykanri_3.category4)
            END as codename,
            -- nyukoold.barcode as barcode,
            -- nyukoold.codename as codename,
            nyukoold.datachar11 as datachar11
            from
            V_Orderhenkan_shiirei_temp as toiawasebango
            left join nyukoold on nyukoold.syouhinid=toiawasebango.unsoumei
            left join categorykanri as categorykanri_1
                on substring(toiawasebango.toiawasebango,1,2) = categorykanri_1.category1
                and substring(toiawasebango.toiawasebango,3) = categorykanri_1.category2
            left join categorykanri as categorykanri_2
                on substring(nyukoold.barcode,1,2) = categorykanri_2.category1
                and substring(nyukoold.barcode,3) = categorykanri_2.category2
            left join categorykanri as categorykanri_3
                on substring(nyukoold.codename,1,2) = categorykanri_3.category1
                and substring(nyukoold.codename,3) = categorykanri_3.category2
            where
            to_char(toiawasebango.touchakudate,'YYYYMM') between '$start_date' and '$end_date'
            and toiawasebango.toiawasebango in ('U670')
            and toiawasebango.bikou1 = '$contractor'
            and toiawasebango.datachar03='0'
            and toiawasebango.datanum0013 = (select max(datanum0013) from V_Orderhenkan_shiirei where unsoumei = toiawasebango.unsoumei)
            ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_ledger_temp_2");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_ledger_temp_2 as 
            select distinct
            to_char(nyuko.denpyohakkoubi, 'YYYY/MM/DD') as touchakudate,
            '支払' as toiawasebango,
            CASE
                WHEN hikiatesyukko2.datachar01 is null THEN NULL 
                ELSE concat(categorykanri_1.category2, ' ' ,categorykanri_1.category4)
            END as datachar08,
            '' as purchase_ledger_syouhizeiritu,
            '' as formatted_purchase_ledger_syouhizeiritu,
            nyuko.syouhinid as syouhinid,
            CASE 
                WHEN LENGTH(hikiatesyukko2.syouhinsyu::text)=2 
                    THEN concat('0', hikiatesyukko2.syouhinsyu)
                WHEN LENGTH(hikiatesyukko2.syouhinsyu::text)=1 
                    THEN concat('00', hikiatesyukko2.syouhinsyu)
                ELSE concat('', hikiatesyukko2.syouhinsyu)
            END as syouhinsyu,
            '' as purchase_ledger_nyukosu,
            '' as formatted_purchase_ledger_nyukosu,
            '' as purchase_ledger_kingaku,
            '' as formatted_purchase_ledger_kingaku,
            to_char(hikiatesyukko2.syouhizeiritu,'FM99,999,999,999,999') as formatted_purchase_ledger_payment_amount,
            hikiatesyukko2.syouhizeiritu::text as purchase_ledger_payment_amount,
            hikiatesyukko2.barcode as barcode,
            hikiatesyukko2.codename as codename,
            hikiatesyukko2.datachar11 as datachar11
            from
            nyuko
            left join
            hikiatesyukko2 on hikiatesyukko2.syouhinid = nyuko.syouhinid
            left join categorykanri as categorykanri_1
                on substring(hikiatesyukko2.datachar01,1,2) = categorykanri_1.category1
                and substring(hikiatesyukko2.datachar01,3) = categorykanri_1.category2
            where 
            to_char(nyuko.denpyohakkoubi,'YYYYMM') between '$start_date' and '$end_date'
            and nyuko.kaiinid = '$contractor'
            and nyuko.season = 2
            and nyuko.denpyobango = 0
            ");

        // Table for purchase-sales-tax 
        QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_ledger_temp_3");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_ledger_temp_3 as
            select distinct on (m.syouhinid, m.syouhinsyu)
            *
            From
            (select distinct
            to_char(toiawasebango.touchakudate, 'YYYY/MM/DD') as touchakudate,
            CASE
                WHEN toiawasebango.toiawasebango is null THEN NULL 
                ELSE concat(categorykanri_1.category2, ' ' ,categorykanri_1.category4)
            END as toiawasebango,
            '仮払消費税（購入）' as datachar08,
            CASE $consumption_temp
                WHEN '1' THEN toiawasebango.datanum0001::text
                ELSE nyukoold.soukobango::text
            END as purchase_ledger_syouhizeiritu,
            CASE $consumption_temp
                WHEN '1' THEN to_char(toiawasebango.datanum0001,'FM99,999,999,999,999')
                ELSE to_char(nyukoold.soukobango,'FM99,999,999,999,999')
            END as formatted_purchase_ledger_syouhizeiritu,
            nyukoold.syouhinid as syouhinid,
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
            END as syouhinsyu,
            '' as purchase_ledger_nyukosu,
            '' as formatted_purchase_ledger_nyukosu,
            '' as purchase_ledger_kingaku,
            '' as formatted_purchase_ledger_kingaku,
            '' as formatted_purchase_ledger_payment_amount,
            '' as purchase_ledger_payment_amount,
            '001318' as barcode,
            '' as codename,
            '' as datachar11
            from
            V_Orderhenkan_shiirei_temp as toiawasebango
            left join nyukoold on nyukoold.syouhinid=toiawasebango.unsoumei
            left join categorykanri as categorykanri_1
                on substring(toiawasebango.toiawasebango,1,2) = categorykanri_1.category1
                and substring(toiawasebango.toiawasebango,3) = categorykanri_1.category2
            where
            to_char(toiawasebango.touchakudate,'YYYYMM') between '$start_date' and '$end_date'
            and toiawasebango.toiawasebango in ('U670')
            and toiawasebango.bikou1 = '$contractor'
            and toiawasebango.datachar03='0'
            and toiawasebango.datanum0013 = (select max(datanum0013) from V_Orderhenkan_shiirei where unsoumei = toiawasebango.unsoumei)
            and nyukoold.datachar18 != 'E110')
            as m
            ");

        // Merging Table
        // QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_ledger_temp");
        // QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_ledger_temp as
        //     SELECT *
        //     from 
        //     (select * from purchase_ledger_temp_1
        //     UNION
        //     select * from purchase_ledger_temp_2
        //     UNION
        //     select * from purchase_ledger_temp_3) as purchase_temp
        //     order by 
        //         purchase_temp.touchakudate ASC,
        //         purchase_temp.syouhinid ASC,
        //         purchase_temp.syouhinsyu ASC
        //     ");
        QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_ledger_temp_before");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_ledger_temp_before as
            SELECT *,
            -- row_number() OVER () as serial_no_1,
            CASE 
                WHEN ledger.purchase_ledger_syouhizeiritu = ''
                THEN 0
                WHEN ledger.purchase_ledger_syouhizeiritu is null
                THEN 0
                ELSE ledger.purchase_ledger_syouhizeiritu::int
            END as field_208,
            CASE 
                WHEN ledger.purchase_ledger_payment_amount = ''
                THEN 0
                WHEN ledger.purchase_ledger_payment_amount is null
                THEN 0
                ELSE ledger.purchase_ledger_payment_amount::int
            END as field_209
            from 
            (select * from purchase_ledger_temp_1
            UNION
            select * from purchase_ledger_temp_2
            UNION
            select * from purchase_ledger_temp_3) as ledger
            order by 
                ledger.touchakudate,
                ledger.syouhinid,
                ledger.syouhinsyu,
                CASE $consumption_temp
                    WHEN '2' THEN ledger.purchase_ledger_syouhizeiritu
                    END DESC
            ");
        // Calculation 
        QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_ledger_temp_final");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_ledger_temp_final as
            SELECT *,
            row_number() OVER () as serial_no,
            (field_208 - field_209) as accounts_payable
            FROM 
            purchase_ledger_temp_before
            ");
        QueryHelper::runQuery("UPDATE purchase_ledger_temp_final
            SET accounts_payable = (accounts_payable + $kk)
            WHERE serial_no = 1
            ");
        QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_ledger_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_ledger_temp as
            SELECT 
            *,
            SUM(accounts_payable) OVER (ORDER BY serial_no) as purchase_ledger_accounts_payable,
            to_char(SUM(accounts_payable) OVER (ORDER BY serial_no),'FM99,999,999,999,999') as formatted_purchase_ledger_accounts_payable
            FROM
            purchase_ledger_temp_final
            ");

        // $temp_purchase_data = QueryHelper::fetchResult("select * from purchase_ledger_temp");
        // dd($temp_purchase_data);        
        return DB::table('purchase_ledger_temp');    
    }
}
// $start_date = str_replace("/","-",$req_data['touchakudate_start']);
//         $end_date = str_replace("/","-",$req_data['touchakudate_end']);
//         $bikou1 = $req_data['bikou1'];
//         $sql = "where (to_char(touchakudate, 'YYYY-MM') between '$start_date' and '$end_date') 
//             AND toiawasebango.bikou1 = '$bikou1' 
//             AND toiawasebango.toiawasebango in ('U670')
//             AND toiawasebango.datachar03 = '0'
//             ";
       
//         QueryHelper::runQuery("DROP TABLE IF EXISTS v_torihikisaki_temp");
//         QueryHelper::runQuery("CREATE TEMPORARY TABLE v_torihikisaki_temp as
//         select *
//         from v_torihikisaki
//         ");
        
//         QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_m");
//         QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_m as
//         select distinct 
//         kokyakuorderbango, max(ordertypebango2) as maxval
//         from orderhenkan
//         where synchroorderbango2 = 0 
//         group by kokyakuorderbango");
        
        
//         QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_data_m");
//         QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_data_m as
//         select distinct 
//         toiawasebango.unsoumei,
//         max(toiawasebango.datanum0013) as max_datanum0013
//         from toiawasebango
//         group by unsoumei
//         ");
//         //$temp_purchase_data = QueryHelper::fetchResult("select * from purchase_data_m");
//         //dd($temp_purchase_data);
        
//         QueryHelper::runQuery("DROP TABLE IF EXISTS nyukoold_temp");
//         QueryHelper::runQuery("CREATE TEMPORARY TABLE nyukoold_temp as
//         select distinct 
//         nyukoold.syouhinid,
//         SUM(nyukoold.syouhizeiritu) as sum_of_syouhizeiritu
//         from nyukoold
//         group by syouhinid
//         ");
        
//         QueryHelper::runQuery("DROP TABLE IF EXISTS minyuko_temp");
//         QueryHelper::runQuery("CREATE TEMPORARY TABLE minyuko_temp as
//         select distinct 
//         minyuko.syouhinid,
//         max(minyuko.zaikometer) as minyuko_max_zaikometer
//         from minyuko
//         group by syouhinid
//         ");
        
//         QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_data");
//         QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_data  as
//         select 
//         toiawasebango.unsoumei,
//         toiawasebango.bikou1,
//         toiawasebango.toiawasebango,
//         to_char(toiawasebango.touchakudate, 'YYYY/MM/DD') as touchakudate
        
//         from toiawasebango
        
//         join purchase_data_m on purchase_data_m.unsoumei = toiawasebango.unsoumei
//         AND purchase_data_m.max_datanum0013 = toiawasebango.datanum0013
        
//         join nyukoold on nyukoold.syouhinid = toiawasebango.unsoumei
        
//         --join nyukoold_temp on nyukoold_temp.syouhinid = nyukoold.syouhinid
//         --AND nyukoold_temp.max_zaikometer = nyukoold.zaikometer
        
//         $sql   
//         ");