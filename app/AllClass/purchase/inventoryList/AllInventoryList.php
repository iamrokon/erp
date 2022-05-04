<?php

namespace App\AllClass\purchase\inventoryList;

use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AllInventoryList
{
    public static function readData($bango, $allRequest)
    {
        // QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_temp");
        // QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_temp as
        //     select distinct * 
        //     from orderhenkan 
        //     ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS inventory_list_temp_1");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE inventory_list_temp_1 as
            select distinct
            CASE
                WHEN toiawasebango.datatxt0004 is null THEN NULL 
                ELSE concat(RIGHT(categorykanri_1.category2, 1), ' ' ,categorykanri_1.category4)
            END as department,
            CASE
                WHEN toiawasebango.datatxt0005 is null THEN NULL
                ELSE concat(RIGHT(categorykanri_2.category2, 1), ' ' ,categorykanri_2.category4)
            END AS grouped_1,
            -- concat(RIGHT(categorykanri_2.category2, 1), ' ' ,categorykanri_2.category4) AS grouped_1,
            to_char(toiawasebango.touchakudate, 'YYYY/MM/DD') as purchase_date,
            v_torihikisaki_1.r17_4 as contractor,
            nyukoold.datachar07 as product_cd,
            nyukoold.datachar08 as product_name,
            nyukoold.syouhizeiritu as inventory_purchase_amount,
            to_char(nyukoold.syouhizeiritu,'FM99,999,999,999,999') as formatted_inventory_purchase_amount,
            CASE
                WHEN toiawasebango.dataint01 IS NULL THEN NULL
                ELSE
                    concat_ws('/',substring(CAST(orderhenkan_JU.intorder03 as text),1,4),
                    substring(CAST(orderhenkan_JU.intorder03 as text),5,2),
                    substring(CAST(orderhenkan_JU.intorder03 as text),7,2))
            END as sales_date,
            orderhenkan_JU.kokyakuorderbango as order_number,
            -- concat(categorykanri_4.category2, ' ' ,categorykanri_4.category4) AS order_classification_1,
            -- concat(categorykanri_5.category2, ' ' ,categorykanri_5.category4) AS order_classification_2,
            CASE
                WHEN orderhenkan_JU.datachar02 is null THEN NULL
                ELSE concat(categorykanri_4.category2, ' ' ,categorykanri_4.category4)
            END AS order_classification_1,
            CASE
                WHEN orderhenkan_HC.datachar02 is null THEN NULL
                ELSE concat(categorykanri_5.category2, ' ' ,categorykanri_5.category4)
            END AS order_classification_2,
            toiawasebango.name as purchase_person,
            substr(replace(replace(toiawasebango.name,' ',''),'　',''),1,3) as purchase_person_short,
            nyukoold.syouhinid as purchase_number,
            nyukoold.syouhinsyu as purchase_line_number,
            nyukoold.nyukosu as inventory_purchase_quantity,
            to_char(nyukoold.nyukosu,'FM99,999,999,999,999') as formatted_inventory_purchase_quantity,
            nyukoold.kingaku as inventory_purchase_unit_price,
            to_char(nyukoold.kingaku,'FM99,999,999,999,999') as formatted_inventory_purchase_unit_price,
            v_torihikisaki_2.r16cd as supplier_name,
            -- concat(RIGHT(categorykanri_3.category2, 2), ' ' ,categorykanri_3.category4) AS division,
            CASE
                WHEN toiawasebango.datatxt0003 is null THEN NULL
                ELSE concat(RIGHT(categorykanri_3.category2, 2), ' ' ,categorykanri_3.category4)
            END AS division,
            nyukoold.idoutanabango as order_number_1,
            nyukoold.yoteimeter as order_line_number,
            -- concat(categorykanri_6.category2, ' ' ,categorykanri_6.category4)
            -- AS accounting_subject,
            -- concat(categorykanri_7.category2, ' ' ,categorykanri_7.category4)
            -- AS accounting_item,
            -- concat(categorykanri_8.category2, ' ' ,categorykanri_8.category4)
            -- AS payment_tax_classification,
            CASE
                WHEN nyukoold.barcode is null THEN NULL
                ELSE concat(categorykanri_6.category2, ' ' ,categorykanri_6.category4)
            END AS accounting_subject,
            CASE
                WHEN nyukoold.codename is null THEN NULL
                ELSE concat(categorykanri_7.category2, ' ' ,categorykanri_7.category4)
            END AS accounting_item,
            CASE
                WHEN nyukoold.datachar18 is null THEN NULL
                ELSE concat(categorykanri_8.category2, ' ' ,categorykanri_8.category4)
            END AS payment_tax_classification,
            nyukoold.soukobango as inventory_tax_amount,
            to_char(nyukoold.soukobango,'FM99,999,999,999,999') as formatted_inventory_tax_amount,
            nyukoold.datachar11 as detailed_remarks,
            -- concat(categorykanri_9.category2, ' ' ,categorykanri_9.category4)
            -- AS order_amount_classification,
            -- concat(categorykanri_10.category2, ' ' ,categorykanri_10.category4)
            -- AS purchase_category
            CASE
                WHEN minyuko.datachar01 is null THEN NULL
                ELSE concat(categorykanri_9.category2, ' ' ,categorykanri_9.category4)
            END AS order_amount_classification,
            CASE
                WHEN toiawasebango.toiawasebango is null THEN NULL
                ELSE concat(categorykanri_10.category2, ' ' ,categorykanri_10.category4)
            END AS purchase_category
            from
            V_Orderhenkan_shiirei as toiawasebango
            left join hikiatenyuko on hikiatenyuko.syouhinid=toiawasebango.unsoumei
            --仕入購入明細
            left join nyukoold on nyukoold.syouhinid=toiawasebango.unsoumei
            --発注
            left join orderhenkan as orderhenkan_HC on orderhenkan_HC.kokyakuorderbango=nyukoold.idoutanabango
            --発注明細
            left join minyuko on minyuko.syouhinid=nyukoold.idoutanabango and minyuko.syouhinsyu=nyukoold.yoteimeter
            --受注
            left join orderhenkan as orderhenkan_JU 
                on orderhenkan_JU.kokyakuorderbango=minyuko.idoutanabango
                AND orderhenkan_JU.ordertypebango2 = (select max(ordertypebango2) from orderhenkan where kokyakuorderbango = orderhenkan_JU.kokyakuorderbango)
            left join tuhanorder as tuhanorder_JU on tuhanorder_JU.orderbango=orderhenkan_JU.bango
            --受注関連フラグ
            left join hikiatesyukko on hikiatesyukko.syouhinid=minyuko.idoutanabango
            --受注明細
            left join misyukko
                on misyukko.syouhinid=minyuko.idoutanabango
                and misyukko.syouhinsyu=minyuko.yoteimeter
                and misyukko.hantei=minyuko.nyukometer
            --売上請求
            left join (
                select
                *
                from
                orderhenkan
                where
                datachar10 like '09%'
                ) orderhenkan_UR on orderhenkan_UR.kokyakuorderbango=orderhenkan_JU.kokyakuorderbango
            left join tuhanorder as tuhanorder_UR on tuhanorder_UR.orderbango=orderhenkan_UR.bango
            --担当者
            --join tantousya on tantousya.bango=toiawasebango.touchakutime
            left join v_torihikisaki as v_torihikisaki_1 on v_torihikisaki_1.torihikisaki_cd = tuhanorder_JU.information1
            left join v_torihikisaki as v_torihikisaki_2 on substring(v_torihikisaki_2.torihikisaki_cd, 1, 8) = toiawasebango.bikou1
            left join categorykanri as categorykanri_1
                on substring(toiawasebango.datatxt0004,1,2) = categorykanri_1.category1
                and substring(toiawasebango.datatxt0004,3) = categorykanri_1.category2
            left join categorykanri as categorykanri_2
                on substring(toiawasebango.datatxt0005,1,2) = categorykanri_2.category1
                and substring(toiawasebango.datatxt0005,3) = categorykanri_2.category2
            left join categorykanri as categorykanri_3
                on substring(toiawasebango.datatxt0003,1,2) = categorykanri_3.category1
                and substring(toiawasebango.datatxt0003,3) = categorykanri_3.category2
            left join categorykanri as categorykanri_4
                on substring(orderhenkan_JU.datachar02,1,2) = categorykanri_4.category1
                and substring(orderhenkan_JU.datachar02,3) = categorykanri_4.category2
            left join categorykanri as categorykanri_5
                on substring(orderhenkan_HC.datachar02,1,2) = categorykanri_5.category1
                and substring(orderhenkan_HC.datachar02,3) = categorykanri_5.category2
            left join categorykanri as categorykanri_6
                on substring(nyukoold.barcode,1,2) = categorykanri_6.category1
                and substring(nyukoold.barcode,3) = categorykanri_6.category2
            left join categorykanri as categorykanri_7
                on substring(nyukoold.codename,1,2) = categorykanri_7.category1
                and substring(nyukoold.codename,3) = categorykanri_7.category2
            left join categorykanri as categorykanri_8
                on substring(nyukoold.datachar18,1,2) = categorykanri_8.category1
                and substring(nyukoold.datachar18,3) = categorykanri_8.category2
            left join categorykanri as categorykanri_9
                on substring(minyuko.datachar01,1,2) = categorykanri_9.category1
                and substring(minyuko.datachar01,3) = categorykanri_9.category2
            left join categorykanri as categorykanri_10
                on substring(toiawasebango.toiawasebango,1,2) = categorykanri_10.category1
                and substring(toiawasebango.toiawasebango,3) = categorykanri_10.category2
            where
            toiawasebango.toiawasebango='U610'
            and hikiatenyuko.datachar07 is not null
            and orderhenkan_HC.datachar02 not in ('V440','V470')
            and (
                hikiatesyukko.datachar04='2'
                or (hikiatesyukko.datachar04='1' and tuhanorder_UR.unsoudaibikitesuryou=2)
            )
            and orderhenkan_JU.datachar02!='U160'
            and toiawasebango.datachar03='0'
            ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS inventory_list_temp_2");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE inventory_list_temp_2 as 
            select distinct
            CASE
                WHEN toiawasebango.datatxt0004 is null THEN NULL 
                ELSE concat(RIGHT(categorykanri_1.category2, 1), ' ' ,categorykanri_1.category4)
            END as department,
            CASE
                WHEN toiawasebango.datatxt0005 is null THEN NULL
                ELSE concat(RIGHT(categorykanri_2.category2, 1), ' ' ,categorykanri_2.category4)
            END AS grouped_1,
            -- concat(RIGHT(categorykanri_2.category2, 1), ' ' ,categorykanri_2.category4) AS grouped_1,
            to_char(toiawasebango.touchakudate, 'YYYY/MM/DD') as purchase_date,
            v_torihikisaki_1.r17_4 as contractor,
            nyukoold.datachar07 as product_cd,
            nyukoold.datachar08 as product_name,
            nyukoold.syouhizeiritu as inventory_purchase_amount,
            to_char(nyukoold.syouhizeiritu,'FM99,999,999,999,999') as formatted_inventory_purchase_amount,
            CASE
                WHEN toiawasebango.dataint01 IS NULL THEN NULL
                ELSE
                    concat_ws('/',substring(CAST(orderhenkan_JU.intorder03 as text),1,4),
                    substring(CAST(orderhenkan_JU.intorder03 as text),5,2),
                    substring(CAST(orderhenkan_JU.intorder03 as text),7,2))
            END as sales_date,
            orderhenkan_JU.kokyakuorderbango as order_number,
            -- concat(categorykanri_4.category2, ' ' ,categorykanri_4.category4) AS order_classification_1,
            -- concat(categorykanri_5.category2, ' ' ,categorykanri_5.category4) AS order_classification_2,
            CASE
                WHEN orderhenkan_JU.datachar02 is null THEN NULL
                ELSE concat(categorykanri_4.category2, ' ' ,categorykanri_4.category4)
            END AS order_classification_1,
            CASE
                WHEN orderhenkan_HC.datachar02 is null THEN NULL
                ELSE concat(categorykanri_5.category2, ' ' ,categorykanri_5.category4)
            END AS order_classification_2,
            toiawasebango.name as purchase_person,
            substr(replace(replace(toiawasebango.name,' ',''),'　',''),1,3) as purchase_person_short,
            nyukoold.syouhinid as purchase_number,
            nyukoold.syouhinsyu as purchase_line_number,
            nyukoold.nyukosu as inventory_purchase_quantity,
            to_char(nyukoold.nyukosu,'FM99,999,999,999,999') as formatted_inventory_purchase_quantity,
            nyukoold.kingaku as inventory_purchase_unit_price,
            to_char(nyukoold.kingaku,'FM99,999,999,999,999') as formatted_inventory_purchase_unit_price,
            v_torihikisaki_2.r16cd as supplier_name,
            -- concat(RIGHT(categorykanri_3.category2, 2), ' ' ,categorykanri_3.category4) AS division,
            CASE
                WHEN toiawasebango.datatxt0003 is null THEN NULL
                ELSE concat(RIGHT(categorykanri_3.category2, 2), ' ' ,categorykanri_3.category4)
            END AS division,
            nyukoold.idoutanabango as order_number_1,
            nyukoold.yoteimeter as order_line_number,
            -- concat(categorykanri_6.category2, ' ' ,categorykanri_6.category4)
            -- AS accounting_subject,
            -- concat(categorykanri_7.category2, ' ' ,categorykanri_7.category4)
            -- AS accounting_item,
            -- concat(categorykanri_8.category2, ' ' ,categorykanri_8.category4)
            -- AS payment_tax_classification,
            CASE
                WHEN nyukoold.barcode is null THEN NULL
                ELSE concat(categorykanri_6.category2, ' ' ,categorykanri_6.category4)
            END AS accounting_subject,
            CASE
                WHEN nyukoold.codename is null THEN NULL
                ELSE concat(categorykanri_7.category2, ' ' ,categorykanri_7.category4)
            END AS accounting_item,
            CASE
                WHEN nyukoold.datachar18 is null THEN NULL
                ELSE concat(categorykanri_8.category2, ' ' ,categorykanri_8.category4)
            END AS payment_tax_classification,
            nyukoold.soukobango as inventory_tax_amount,
            to_char(nyukoold.soukobango,'FM99,999,999,999,999') as formatted_inventory_tax_amount,
            nyukoold.datachar11 as detailed_remarks,
            -- concat(categorykanri_9.category2, ' ' ,categorykanri_9.category4)
            -- AS order_amount_classification,
            -- concat(categorykanri_10.category2, ' ' ,categorykanri_10.category4)
            -- AS purchase_category
            CASE
                WHEN minyuko.datachar01 is null THEN NULL
                ELSE concat(categorykanri_9.category2, ' ' ,categorykanri_9.category4)
            END AS order_amount_classification,
            CASE
                WHEN toiawasebango.toiawasebango is null THEN NULL
                ELSE concat(categorykanri_10.category2, ' ' ,categorykanri_10.category4)
            END AS purchase_category
            from
            --仕入購入
            V_Orderhenkan_shiirei as toiawasebango
            --仕入購入関連フラグ
            left join hikiatenyuko on hikiatenyuko.syouhinid=toiawasebango.unsoumei
            --仕入購入明細
            left join nyukoold on nyukoold.syouhinid=toiawasebango.unsoumei
            --発注
            left join orderhenkan as orderhenkan_HC on orderhenkan_HC.kokyakuorderbango=nyukoold.idoutanabango
            --発注明細
            left join minyuko on minyuko.syouhinid=nyukoold.idoutanabango and minyuko.syouhinsyu=nyukoold.yoteimeter
            --受注
            left join orderhenkan as orderhenkan_JU 
                on orderhenkan_JU.kokyakuorderbango=minyuko.idoutanabango
                AND orderhenkan_JU.ordertypebango2 = (select max(ordertypebango2) from orderhenkan where kokyakuorderbango = orderhenkan_JU.kokyakuorderbango)
            left join tuhanorder as tuhanorder_JU on tuhanorder_JU.orderbango=orderhenkan_JU.bango
            --受注関連フラグ
            left join hikiatesyukko on hikiatesyukko.syouhinid=minyuko.idoutanabango
            --受注明細
            left join misyukko
                on misyukko.syouhinid=minyuko.idoutanabango
                and misyukko.syouhinsyu=minyuko.yoteimeter
                and misyukko.hantei=minyuko.nyukometer
            --売上請求
            left join (
                select
                *
                from
                orderhenkan
                ) orderhenkan_UR on orderhenkan_UR.kokyakuorderbango=orderhenkan_JU.kokyakuorderbango
            left join tuhanorder as tuhanorder_UR on tuhanorder_UR.orderbango=orderhenkan_UR.bango
            --担当者
            --join tantousya on tantousya.bango=toiawasebango.touchakutime
            left join v_torihikisaki as v_torihikisaki_1 on v_torihikisaki_1.torihikisaki_cd = tuhanorder_JU.information1
            left join v_torihikisaki as v_torihikisaki_2 on substring(v_torihikisaki_2.torihikisaki_cd, 1, 8) = toiawasebango.bikou1
            left join categorykanri as categorykanri_1
                on substring(toiawasebango.datatxt0004,1,2) = categorykanri_1.category1
                and substring(toiawasebango.datatxt0004,3) = categorykanri_1.category2
            left join categorykanri as categorykanri_2
                on substring(toiawasebango.datatxt0005,1,2) = categorykanri_2.category1
                and substring(toiawasebango.datatxt0005,3) = categorykanri_2.category2
            left join categorykanri as categorykanri_3
                on substring(toiawasebango.datatxt0003,1,2) = categorykanri_3.category1
                and substring(toiawasebango.datatxt0003,3) = categorykanri_3.category2
            left join categorykanri as categorykanri_4
                on substring(orderhenkan_JU.datachar02,1,2) = categorykanri_4.category1
                and substring(orderhenkan_JU.datachar02,3) = categorykanri_4.category2
            left join categorykanri as categorykanri_5
                on substring(orderhenkan_HC.datachar02,1,2) = categorykanri_5.category1
                and substring(orderhenkan_HC.datachar02,3) = categorykanri_5.category2
            left join categorykanri as categorykanri_6
                on substring(nyukoold.barcode,1,2) = categorykanri_6.category1
                and substring(nyukoold.barcode,3) = categorykanri_6.category2
            left join categorykanri as categorykanri_7
                on substring(nyukoold.codename,1,2) = categorykanri_7.category1
                and substring(nyukoold.codename,3) = categorykanri_7.category2
            left join categorykanri as categorykanri_8
                on substring(nyukoold.datachar18,1,2) = categorykanri_8.category1
                and substring(nyukoold.datachar18,3) = categorykanri_8.category2
            left join categorykanri as categorykanri_9
                on substring(minyuko.datachar01,1,2) = categorykanri_9.category1
                and substring(minyuko.datachar01,3) = categorykanri_9.category2
            left join categorykanri as categorykanri_10
                on substring(toiawasebango.toiawasebango,1,2) = categorykanri_10.category1
                and substring(toiawasebango.toiawasebango,3) = categorykanri_10.category2
            where
            toiawasebango.toiawasebango='U640'
            and hikiatenyuko.datachar07 is not null
            and orderhenkan_HC.datachar02 = 'V440'
            and (
                hikiatesyukko.datachar04='2'
                or (hikiatesyukko.datachar04='1' and tuhanorder_UR.unsoudaibikitesuryou=2)
            )
            and orderhenkan_JU.datachar02!='U160'
            and toiawasebango.datachar03='0'
            ");  
        QueryHelper::runQuery("DROP TABLE IF EXISTS inventory_list_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE inventory_list_temp as
            SELECT *
            -- CASE
            --     When department is null THEN NULL
            --     ELSE department 
            -- End AS department,
            -- CASE
            --     When grouped_1 is null THEN NULL
            --     ELSE grouped_1 
            -- End AS grouped_1,
            -- purchase_date,
            -- contractor,
            -- product_cd,
            -- product_name,
            -- inventory_purchase_amount,
            -- sales_date,
            -- order_number,
            -- CASE
            --     When order_classification_1 is null THEN NULL
            --     ELSE order_classification_1 
            -- End AS order_classification_1,
            -- CASE
            --     When order_classification_2 is null THEN NULL
            --     ELSE order_classification_2 
            -- End AS order_classification_2,
            -- purchase_person,
            -- purchase_number,
            -- purchase_line_number,
            -- inventory_purchase_quantity,
            -- inventory_purchase_unit_price,
            -- supplier_name,
            -- CASE
            --     When division is null THEN NULL
            --     ELSE division 
            -- End AS division,
            -- order_number_1,
            -- order_line_number,
            -- CASE
            --     When accounting_subject is null THEN NULL
            --     ELSE accounting_subject 
            -- End AS accounting_subject,
            -- CASE
            --     When accounting_item is null THEN NULL
            --     ELSE accounting_item
            -- END AS accounting_item,
            -- CASE
            --     When payment_tax_classification is null THEN NULL
            --     ELSE payment_tax_classification 
            -- End AS payment_tax_classification,
            -- inventory_tax_amount,
            -- detailed_remarks,
            -- CASE
            --     When order_amount_classification is null THEN NULL
            --     ELSE order_amount_classification 
            -- END AS order_amount_classification,
            -- CASE
            --     When purchase_category is null THEN NULL
            --     ELSE purchase_category
            -- END AS purchase_category
            from 
            (select * from inventory_list_temp_1
            UNION
            select * from inventory_list_temp_2) as inventory
            order by 
                inventory.department ASC,
                inventory.grouped_1 ASC,
                inventory.purchase_date ASC,
                inventory.order_number ASC
            ");
        $search_sql = DB::table('inventory_list_temp')->toSql();
        return $search_sql;
    }
}
