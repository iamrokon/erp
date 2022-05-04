<?php

namespace App\AllClass\support\purchaseResultList;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;
use DB;
use App\tantousya;
use App\kengen;
use App\AllClass\db\QueryHelperFacade as QueryHelper;


Class AllPurchaseResultList{
    public static function data($login_bango,$req_data=null){
        $datachar05 = $req_data['datachar05'];
        $start_date = str_replace('/','',$req_data['purchaseDateFrom']);
        $end_date = str_replace('/','',$req_data['purchaseDateTo']);
        $payresd1 = $req_data['payresd1'];
        $sales_start_date = str_replace('/','',$req_data['salesDateFrom']);
        $sales_end_date = str_replace('/','',$req_data['salesDateTo']);
        // dd($payresd1);
        $division_start_date = substr($req_data['division_datachar05_start'], 4,2);
        $division_end_date = substr($req_data['division_datachar05_end'], 4,2);
        $sql = " where substring(minyuko.datatxt0003::text,1,2)='B9' AND right(datatxt0003::text,2) between '$division_start_date' and '$division_end_date' ";
        $sql .= "AND orderhenkan.datachar02 = 'V413' AND minyuko.datachar01 in ('V120','V160')";
        if($datachar05){
            $sql .= " and minyuko.datachar13 = '$datachar05' ";
        }
        if(isset($req_data['department_datachar05_start']) && ($req_data['department_datachar05_start']!="" && $req_data['department_datachar05_end']!="")){
            $department_start_date =substr($req_data['department_datachar05_start'], 4,3);
            $department_end_date = substr($req_data['department_datachar05_end'], 4,3);
            $sql .= "AND substring(minyuko.datatxt0004::text,1,2)='C1' AND right(minyuko.datatxt0004::text,3) between '$department_start_date' and '$department_end_date' ";
        }
        if(isset($req_data['group_datachar05_start']) && ($req_data['group_datachar05_start']!="" && $req_data['group_datachar05_end']!="")){
            $group_start_date = substr($req_data['group_datachar05_start'], 4,4);
            $group_end_date = substr($req_data['group_datachar05_end'], 4,4);
            $sql .= "AND substring(minyuko.datatxt0005::text,1,2)='C2' AND right(minyuko.datatxt0005::text ,4) between '$group_start_date' and '$group_end_date' ";            
        }
        if($payresd1 == 1){
            $sql .= "AND juchusyukko2.barcode is null AND juchusyukko2.codename is null";            
        }
        else if($payresd1 == 2){
            $sql .= "AND juchusyukko2.barcode is not null AND juchusyukko2.codename is null";            
        }
        else if($payresd1 == 3){
            $sql .= "AND juchusyukko2.barcode is not null AND juchusyukko2.codename is not null";            
        }
        else if($payresd1 == 4){
            $sql .= "AND juchusyukko2.tanka = 1";            
        }
        // else{
        //     $sql .= "AND juchusyukko2.barcode is null AND juchusyukko2.codename is null ";
        //     $sql .= "AND juchusyukko2.barcode is not null AND juchusyukko2.codename is null ";
        //     $sql .= "AND juchusyukko2.barcode is not null AND juchusyukko2.codename is not null ";
        //     $sql .= "AND juchusyukko2.tanka = 1";
        // }
        
        // dd($req_data, $datachar05, $sql);
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_m");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_m as
        select distinct 
        kokyakuorderbango, max(ordertypebango2) as maxval
        from orderhenkan
        where synchroorderbango2 =0 
        group by kokyakuorderbango");

        QueryHelper::runQuery("DROP TABLE IF EXISTS minyuko_m");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE minyuko_m as
        select distinct 
        syouhinid,syouhinsyu, max(zaikometer) as maxval
        from minyuko
        where denpyobango =0 
        group by syouhinid, syouhinsyu");

        QueryHelper::runQuery("DROP TABLE IF EXISTS v_torihikisaki_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE v_torihikisaki_temp as
        select *
        from v_torihikisaki
        ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS V_tantousya_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE V_tantousya_temp as
        select *
        from V_tantousya
        ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS V_Orderhenkan_hatsu_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE V_Orderhenkan_hatsu_temp as
        SELECT
        -- orderhenkan.*,
        minyuko.*,
        V_tantousya.name,
        V_tantousya.ztanka,
        V_tantousya.ktanka,
        V_tantousya.datatxt0003,
        V_tantousya.datatxt0004,
        V_tantousya.datatxt0005,
        V_tantousya.yobi1,
        V_tantousya.yobi2,
        V_tantousya.deleteflag
        from minyuko
        -- left join orderhenkan on orderhenkan.kokyakuorderbango = minyuko.syouhinid
        left join V_tantousya_temp as V_tantousya
        on minyuko.datachar13 = V_tantousya.bango
        and cast(substr(minyuko.syouhinid,3,2) as integer) = V_tantousya.ztanka
        and REPLACE(substring(minyuko.denpyohakkoubi::text,1,10),'-','') >= V_tantousya.yobi1::text
        and REPLACE(substring(minyuko.denpyohakkoubi::text,1,10),'-','') <  V_tantousya.yobi2::text
        where minyuko.datachar13 is not null
        order by minyuko.syouhinid
        ");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_result_list_temp_1");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_result_list_temp_1 as
        select  distinct
        minyuko.syouhinid,
        minyuko.syouhinsyu,
        minyuko.datachar13,
        minyuko.datachar01,
        minyuko.zaikometer,
        minyuko.syouhizeiritu,
        CASE 
            WHEN LENGTH(minyuko.syouhinsyu::text)=2 
            THEN concat_ws('0', minyuko.syouhinid, minyuko.syouhinsyu)
            WHEN LENGTH(minyuko.syouhinsyu::text)=1 
            THEN concat_ws('00', minyuko.syouhinid, minyuko.syouhinsyu)
            ELSE concat_ws('', minyuko.syouhinid, minyuko.syouhinsyu)
        END AS support_number,
        minyuko.season,
        orderhenkan.datachar10,
        v_torihikisaki_1.r17_4 as contractor,
        orderhenkan.datachar11,
        v_torihikisaki_2.r17_4 as end_customer,
        orderhenkan.orderuserbango as order_number,
        orderhenkan.intorder03,
        juchusyukko2.tanka,
        juchusyukko2.barcode,
        juchusyukko2.codename,
        orderhenkan.ordertypebango2,
        orderhenkan.datachar04,
        orderhenkan.datachar02
        -- CASE
        --     WHEN hikiatesyukko.datachar04 = '1'
        --     THEN orderhenkan_1.intorder03
        --     ELSE orderhenkan_2.intorder03
        -- END as ju_intorder03,
        -- orderhenkan_JU.kokyakuorderbango as ju_kokyakuorderbango,
        -- hikiatesyukko.datachar04 as hc_datachar04
        from V_Orderhenkan_hatsu_temp as minyuko
        JOIN orderhenkan
            ON minyuko.syouhinid = orderhenkan.kokyakuorderbango
            and orderhenkan.synchroorderbango2 = 0
        -- left JOIN orderhenkan as orderhenkan_JU
        --     ON orderhenkan.orderuserbango = orderhenkan_JU.kokyakuorderbango
        -- left JOIN hikiatesyukko_temp as orderhenkan_JU
        --     ON orderhenkan.kokyakuorderbango = orderhenkan_JU.kokyakuorderbango
            -- and orderhenkan.orderbango = orderhenkan_JU.bango
        left join juchusyukko2 
            on juchusyukko2.syouhinid = minyuko.syouhinid and juchusyukko2.syouhinsyu = minyuko.syouhinsyu
        join orderhenkan_m on
            orderhenkan_m.kokyakuorderbango=orderhenkan.kokyakuorderbango
            and orderhenkan_m.maxval=orderhenkan.ordertypebango2
        join minyuko_m on
            minyuko_m.syouhinid=minyuko.syouhinid
            and minyuko_m.syouhinsyu = minyuko.syouhinsyu
            and minyuko_m.maxval= minyuko.zaikometer
        left join v_torihikisaki_temp as v_torihikisaki_1 on v_torihikisaki_1.torihikisaki_cd = orderhenkan.datachar10
        left join v_torihikisaki_temp as v_torihikisaki_2 on v_torihikisaki_2.torihikisaki_cd = orderhenkan.datachar11
        -- left JOIN orderhenkan as orderhenkan_1
        --     ON orderhenkan_1.kokyakuorderbango = orderhenkan_JU.kokyakuorderbango
        --     and orderhenkan_1.datachar10 is not null
        -- left JOIN orderhenkan as orderhenkan_2
        --     ON orderhenkan_2.kokyakuorderbango = orderhenkan_JU.kokyakuorderbango
        --     and orderhenkan_2.datachar10 is null
        --     and orderhenkan_2.ordertypebango2 = (select max(ordertypebango2) from orderhenkan where kokyakuorderbango = orderhenkan_2.kokyakuorderbango)
        $sql
        ");
        // $temp_purchase_data = QueryHelper::fetchResult("select * from purchase_result_list_temp_1");
        // dd($temp_purchase_data);
        $fsql = "where orderhenkan.datachar02 = 'V440' AND minyuko.datachar01 = 'V160' ";
        $dsql = '';
        if($start_date && $end_date){
            $prefix_sql =  Str::contains($dsql, 'where') ? ' and ' : ' where ';
            $dsql .= "$prefix_sql (purchase.ju_intorder03::text between '$start_date' and '$end_date') ";
        }
        if($sales_start_date && $sales_end_date){
            $prefix_sql =  Str::contains($dsql, 'where') ? ' and ' : ' where ';
            $dsql .= "$prefix_sql (purchase.season::text between '$sales_start_date' and '$sales_end_date') ";
        }
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_temp as
        SELECT DISTINCT
            orderhenkan.datatxt0152,
            SUM(orderhenkan.intorder01) as intorder01,
            orderhenkan.ordertypebango2
        FROM
            orderhenkan
        join 
            orderhenkan_m on
            orderhenkan_m.kokyakuorderbango=orderhenkan.kokyakuorderbango
            and orderhenkan_m.maxval=orderhenkan.ordertypebango2
        where orderhenkan.synchroorderbango2 =0
        GROUP BY orderhenkan.datatxt0152, orderhenkan.ordertypebango2            
        ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_temp as
        SELECT DISTINCT
            n.idoutanabango,
            n.yoteimeter,
            SUM(n.nyukosu * n.kingaku) as purchase_amount
        FROM
            nyukoold as n
        where denpyobango =0 
            and zaikometer = 
                (select max(zaikometer) 
                from nyukoold
                where n.syouhinid = nyukoold.syouhinid and n.syouhinsyu = nyukoold.syouhinsyu)
        GROUP BY idoutanabango, yoteimeter            
        ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_result_list_temp_main");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_result_list_temp_main as
        select  distinct
        purchase.*,
        -- CASE
        --     WHEN purchase.ju_intorder03::text is null THEN NULL
        --     ELSE concat_ws('/',substring(purchase.ju_intorder03::text,1,4),
        --     substring(purchase.ju_intorder03::text,5,2),
        --     substring(purchase.ju_intorder03::text,7,2)) 
        -- END as sales_date,
        CASE
            WHEN purchase.season::text is null THEN NULL
            ELSE concat_ws('/',substring(purchase.season::text,1,4),
            substring(purchase.season::text,5,2),
            substring(purchase.season::text,7,2)) 
        END as purchase_date,
        -- CASE 
        --     WHEN purchase.hc_datachar04::int = 1
        --     THEN '1 済'
        --     WHEN purchase.hc_datachar04::int = 2
        --     THEN '2 未'
        --     ELSE '3 対象外'
        -- END as sell,
        orderhenkan.datatxt0152,
        -- orderhenkan.datachar02 as p_datachar02,
        -- minyuko.syouhinid as p_syouinid,
        -- minyuko.syouhinsyu as p_syouhinsyu,
        -- minyuko.datachar01 as p_datachar01,
        -- minyuko.zaikometer as p_zaikometer,
        orderhenkan_temp.intorder01 as purchase_Result_list_amount,
        purchase.syouhizeiritu as purchase_Result_list_schedule,
        to_char(purchase.syouhizeiritu,'FM99,999,999,999,999') as formatted_schedule,
        to_char(orderhenkan_temp.intorder01,'FM99,999,999,999,999') as formatted_amount,
        -- to_char(purchase_temp.purchase_amount,'FM99,999,999,999,999') as formatted_results,
        -- purchase_temp.purchase_amount as purchase_Result_list_results,
        purchase_temp.idoutanabango,
        purchase_temp.yoteimeter,
        purchase_temp.nyukosu,
        purchase_temp.kingaku,
        CASE
            WHEN purchase.barcode is null 
                and purchase.codename is null 
                and purchase.tanka = 2
            THEN 1
            WHEN purchase.barcode is not null 
                and purchase.codename is null 
                and purchase.tanka = 2
            THEN 2
            WHEN purchase.barcode is not null 
                and purchase.codename is not null 
                and purchase.tanka = 2
            THEN 3
            ELSE 4
        END as inspection,
        -- CASE
        --     WHEN purchase.barcode is null 
        --         and purchase.codename is null 
        --         and purchase.tanka = 2
        --     THEN '1 未'
        --     WHEN purchase.barcode is not null 
        --         and purchase.codename is null 
        --         and purchase.tanka = 2
        --     THEN '2 指示'
        --     WHEN purchase.barcode is not null 
        --         and purchase.codename is not null 
        --         and purchase.tanka = 2
        --     THEN '3 検印'
        --     ELSE '4 完了'
        -- END as purchase_flag
        concat(request.syouhinbango,' ',request.jouhou) as purchase_flag
        -- orderhenkan.intorder01 - purchase_temp.purchase_amount as purchase_Result_list_difference,
        -- to_char(orderhenkan.intorder01 - purchase_temp.purchase_amount,'FM99,999,999,999,999') as formatted_purchase_difference
        From
        purchase_result_list_temp_1 as purchase
        left join 
            orderhenkan_temp
            on orderhenkan_temp.datatxt0152 = purchase.support_number
        left join
            orderhenkan
            on orderhenkan.datatxt0152 = purchase.support_number
            -- and orderhenkan.datachar02 = 'V440'
        left join minyuko
            on minyuko.syouhinid = orderhenkan.kokyakuorderbango
        -- join minyuko_m on
        --     minyuko_m.syouhinid=minyuko.syouhinid
        --     and minyuko_m.syouhinsyu = minyuko.syouhinsyu
        --     and minyuko_m.maxval= minyuko.zaikometer
        -- left join purchase_temp 
        left join nyukoold as purchase_temp 
            on purchase_temp.idoutanabango = minyuko.syouhinid
            and purchase_temp.yoteimeter = minyuko.syouhinsyu
            -- and purchase_temp.purchase_amount is not null
        left join request 
            on request.syouhinbango = purchase.tanka 
            and request.color = '0502外注仕入完了計算フラグ'
        $fsql 
        -- and purchase_temp.purchase_amount is not null
        ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_result_list_temp_main_1");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_result_list_temp_main_1 as
        select  distinct
        purchase.*,
        CASE
            WHEN hikiatesyukko.datachar04 = '1'
            THEN orderhenkan_1.intorder03
            ELSE orderhenkan_2.intorder03
        END as ju_intorder03,
        hikiatesyukko.datachar04 as hc_datachar04
        from purchase_result_list_temp_main as purchase
        left JOIN hikiatesyukko
            ON hikiatesyukko.syouhinid = purchase.order_number
        left JOIN orderhenkan as orderhenkan_1
            ON orderhenkan_1.kokyakuorderbango = purchase.order_number
            and orderhenkan_1.datachar10 is not null
            and orderhenkan_1.ordertypebango2 = (select max(ordertypebango2) from orderhenkan where kokyakuorderbango = orderhenkan_1.kokyakuorderbango)
        left JOIN orderhenkan as orderhenkan_2
            ON orderhenkan_2.kokyakuorderbango = purchase.order_number
            and orderhenkan_2.datachar10 is null
            and orderhenkan_2.ordertypebango2 = (select max(ordertypebango2) from orderhenkan where kokyakuorderbango = orderhenkan_2.kokyakuorderbango)
        ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_result_list_temp_main_2");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_result_list_temp_main_2 as
        select  distinct
        purchase.*,
        -- CASE 
        --     WHEN purchase.hc_datachar04::int = 1
        --     THEN '1 済'
        --     WHEN purchase.hc_datachar04::int = 2
        --     THEN '2 未'
        --     ELSE '3 対象外'
        -- END as sell,
        concat(request.syouhinbango,' ',request.jouhou) as sell,
        CASE
            WHEN purchase.ju_intorder03::text is null THEN NULL
            ELSE concat_ws('/',substring(purchase.ju_intorder03::text,1,4),
            substring(purchase.ju_intorder03::text,5,2),
            substring(purchase.ju_intorder03::text,7,2)) 
        END as sales_date
        from purchase_result_list_temp_main_1 as purchase
        left join request 
            on request.syouhinbango = purchase.hc_datachar04::int
            and request.color = '0201伝票作成フラグ'
        $dsql
        ");
        // $temp_purchase_data = QueryHelper::fetchResult("select * from purchase_result_list_temp_main_2");
        // dd($temp_purchase_data);

        QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_result_list_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_result_list_temp as
        select distinct on (final_purchase.support_number)
        final_purchase.*,
        -- m.purchase_amount,
        to_char(m.purchase_amount,'FM99,999,999,999,999') as formatted_results,
        m.purchase_amount as purchase_Result_list_results,
        final_purchase.purchase_Result_list_amount - m.purchase_amount as purchase_Result_list_difference,
        to_char(final_purchase.purchase_Result_list_amount - m.purchase_amount,'FM99,999,999,999,999') as formatted_purchase_difference
        FROM 
        (select  distinct
        support_number,
        SUM(nyukosu * kingaku) as purchase_amount
        FROM
        purchase_result_list_temp_main_2
        Group by support_number)
        as m 
        left join purchase_result_list_temp_main_2 as final_purchase
        on m.support_number = final_purchase.support_number
        ");

        // $temp_purchase_data = QueryHelper::fetchResult("select * from purchase_result_list_temp");
        // dd($temp_purchase_data);

        // return $data;
        return DB::table('purchase_result_list_temp');
    }
}
