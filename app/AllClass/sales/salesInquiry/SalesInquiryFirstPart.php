<?php

namespace App\AllClass\sales\salesInquiry;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\kengen;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class SalesInquiryFirstPart{
    public static function data($bango,$deleted_item=2,$kokyakuorderbango=null,$ordertypebango2=null){

        QueryHelper::runQuery("DROP TABLE IF EXISTS sales_inquiry_first_part");
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_m");

        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_m as
            select distinct
            kokyakuorderbango, max(ordertypebango2) as maxval
            from orderhenkan
            where synchroorderbango =0
            group by kokyakuorderbango");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_m3");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_m3 as
            select distinct
            kokyakuorderbango, max(ordertypebango2) as maxval
            from orderhenkan
            where synchroorderbango = 0 and datachar10 is not null
            group by kokyakuorderbango");

        $fields = "";
        $color = "0404作成区分";
        $fields .= "(select CONCAT(syouhinbango,' ',jouhou) from request where color='$color' and syouhinbango::text=substring(orderhenkan.datachar01,1,1) LIMIT 1) as datachar01_val,";

        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE sales_inquiry_first_part as
        select
        orderhenkan.bango,
        orderhenkan.kokyakuorderbango,
        orderhenkan.datachar01,
        orderhenkan.datachar02,
        orderhenkan.datachar10,
        CASE
            WHEN orderhenkan.datachar02 is null THEN NULL
            ELSE concat(categorykanriDatachar2.category2,' ',categorykanriDatachar2.category4) END as datachar02_detail,

        CONCAT(
            RIGHT(categorykanri1.category2, 2) ,' ',categorykanri1.category4) as text1,

        CONCAT(
            RIGHT(categorykanri3.category2, 2) ,' ',categorykanri3.category4) as category_new,
        orderhenkan.datachar03,
        CASE
            WHEN orderhenkan.datachar03 is null THEN NULL
            ELSE concat(orderhenkan.datachar03,' ',gazou2.urlsm) END as datachar03_detail,
        orderhenkan.datachar04,
        orderhenkan.datachar05,
        orderhenkan.ordertypebango2,
        (select max(ordertypebango2) from orderhenkan where orderhenkan.kokyakuorderbango = orderhenkan_m2.kokyakuorderbango and orderhenkan.datachar10 IS NULL) as order_inquiry_ordertypebango2,
        CASE
            WHEN orderhenkan.intorder01::text is null THEN NULL
            ELSE concat_ws('/',substring(orderhenkan.intorder01::text,1,4),
            substring(orderhenkan.intorder01::text,5,2),
            substring(orderhenkan.intorder01::text,7,2)) END as intorder01,
        CASE
            WHEN orderhenkan.intorder02::text is null THEN NULL
            ELSE concat_ws('/',substring(orderhenkan.intorder02::text,1,4),
            substring(orderhenkan.intorder02::text,5,2),
            substring(orderhenkan.intorder02::text,7,2)) END as intorder02,
        CASE
            WHEN orderhenkan.intorder03::text is null THEN NULL
            ELSE concat_ws('/',substring(orderhenkan.intorder03::text,1,4),
            substring(orderhenkan.intorder03::text,5,2),
            substring(orderhenkan.intorder03::text,7,2)) END as intorder03,
        CASE
            WHEN orderhenkan.intorder04::text is null THEN NULL
            ELSE concat_ws('/',substring(orderhenkan.intorder04::text,1,4),
            substring(orderhenkan.intorder04::text,5,2),
            substring(orderhenkan.intorder04::text,7,2)) END as intorder04,
        CASE
            WHEN orderhenkan.intorder05::text is null THEN NULL
            ELSE concat_ws('/',substring(orderhenkan.intorder05::text,1,4),
            substring(orderhenkan.intorder05::text,5,2),
            substring(orderhenkan.intorder05::text,7,2)) END as intorder05,
        tuhanorder.juchukubun1,
        tuhanorder.juchukubun2 as juchukubun2,
        tuhanorder.information1,
        torihikisakiInformation1.r17_3cd as information1_detail,
        tuhanorder.information2,
        torihikisakiInformation2.r17_3cd as information2_detail,
        tuhanorder.information3,
        torihikisakiInformation3.r17_3cd as information3_detail,
        tuhanorder.information4,
        torihikisakiInformation4.r17_3cd as information4_detail,
        tuhanorder.information5,
        torihikisakiInformation5.r17_3cd as information5_detail,
        tuhanorder.information6,
        torihikisakiInformation6.r17_3cd as information6_detail,
        tuhanorder.information7,
        tuhanorder.information8,
        tuhanorder.information9,
        tuhanorder.kessaihouhou,
        tuhanorder.money10,
        tuhanorder.moneymax,
        tuhanorder.text3 as text3,
        CASE
            WHEN tuhanorder.kessaihouhou is null THEN NULL
            ELSE concat(categorykanriKessaihouhou.category2,' ',categorykanriKessaihouhou.category4) END as kessaihouhou_detail,
        tuhanorder.housoukubun,
        CASE
        	WHEN tuhanorder.chumondate is null THEN NULL
        	ELSE concat_ws('/',substring(CAST(tuhanorder.chumondate as text),1,4),
        	substring(CAST(tuhanorder.chumondate as text),6,2),
        	substring(CAST(tuhanorder.chumondate as text),9,2)) END as chumondate,

        CONCAT(tantousya.bango, ' ', tantousya.name) as name_with_id,
        substring(replace(tantousya2.name, ' ', ''),1,3) as name2,
        hikiatesyukko.dataint01 as dataint01,
        hikiatesyukko.dataint03 as dataint03,
        hikiatesyukko.dataint06 as dataint06,
        hikiatesyukko.dataint07 as dataint07,
        hikiatesyukko.dataint08 as dataint08,
        soukonyuko.datachar09 as file_name,
        $fields
        LEFT (soukonyuko.datachar09, 10)||'...'||RIGHT (soukonyuko.datachar09, 3) as file_name_short

        from orderhenkan
        
        join orderhenkan_m3 on orderhenkan_m3.kokyakuorderbango = orderhenkan.kokyakuorderbango
        AND orderhenkan_m3.maxval = orderhenkan.ordertypebango2

        left join tuhanorder on tuhanorder.orderbango = orderhenkan.bango
            AND tuhanorder.juchubango = orderhenkan.kokyakuorderbango

        --left join soukonyuko on soukonyuko.orderbango = orderhenkan.bango
        --    AND soukonyuko.datachar05 = orderhenkan.kokyakuorderbango

        left join soukonyuko on soukonyuko.datachar01  = orderhenkan.datachar08

        left join gazou2 on gazou2.url = orderhenkan.datachar03

        left join categorykanri as categorykanriDatachar2
        on substring(orderhenkan.datachar02,1,2) = categorykanriDatachar2.category1
        and substring(orderhenkan.datachar02,3,3) = categorykanriDatachar2.category2

        left join categorykanri as categorykanri1 on substring(tuhanorder.text1,1,2) = categorykanri1.category1
        and substring(tuhanorder.text1,3,2) = categorykanri1.category2

        left join categorykanri as categorykanri2 on categorykanri2.category1='A9' AND tuhanorder.kessaihouhou = CONCAT(categorykanri2.category1,categorykanri2.category2)
        left join categorykanri as categorykanri3 on categorykanri3.category1='B1' AND tuhanorder.otodoketime = CONCAT(categorykanri3.category1,categorykanri3.category2)

        left join categorykanri as categorykanriKessaihouhou
        on substring(tuhanorder.kessaihouhou,1,2) = categorykanriKessaihouhou.category1
        and substring(tuhanorder.kessaihouhou,3,2) = categorykanriKessaihouhou.category2

        --information1
        left join v_torihikisaki as torihikisakiInformation1
        on torihikisakiInformation1.torihikisaki_cd = tuhanorder.information1
        --information1 end

        --information2
        left join v_torihikisaki as torihikisakiInformation2
        on torihikisakiInformation2.torihikisaki_cd = tuhanorder.information2
        --information2 end

        --information3
        left join v_torihikisaki as torihikisakiInformation3
        on torihikisakiInformation3.torihikisaki_cd = tuhanorder.information3
        --information3 end

        --information4
        left join v_torihikisaki as torihikisakiInformation4
        on torihikisakiInformation4.torihikisaki_cd = tuhanorder.information4
        --information4 end

        --information5
        left join v_torihikisaki as torihikisakiInformation5
        on torihikisakiInformation5.torihikisaki_cd = tuhanorder.information5
        --information5 end

        --information6
        left join v_torihikisaki as torihikisakiInformation6
        on torihikisakiInformation6.torihikisaki_cd = tuhanorder.information6
        --information6 end

        left join tantousya on tantousya.bango = orderhenkan.datachar05

        left join hikiatesyukko on  hikiatesyukko.orderbango = orderhenkan.bango
        AND hikiatesyukko.syouhinid = orderhenkan.kokyakuorderbango
        left join tantousya as tantousya2 on tantousya2.bango = hikiatesyukko.datachar27

        left join orderhenkan_m as orderhenkan_m2
        on orderhenkan_m2.kokyakuorderbango=orderhenkan.kokyakuorderbango

        ");

        //$data=DB::table('sales_inquiry_first_part')->whereRaw('kokyakuorderbango = ' . "'$kokyakuorderbango'" . ' AND ordertypebango2 = ' . "'$ordertypebango2'" ." AND datachar10 IS NOT NULL");
        $data=DB::table('sales_inquiry_first_part')->whereRaw('kokyakuorderbango = ' . "'$kokyakuorderbango'" ." AND datachar10 IS NOT NULL");

        return $data;

    }
}
