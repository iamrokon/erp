<?php

namespace App\AllClass\order\orderInquiry;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\kengen;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class OrderInquiryFirstPart{
    public static function data($bango,$deleted_item=2,$kokyakuorderbango=null,$ordertypebango2=null,$req_type=null){

        QueryHelper::runQuery("DROP TABLE IF EXISTS order_inquiry_first_part");

        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE order_inquiry_first_part as
        select
        orderhenkan.bango,
        orderhenkan.kokyakuorderbango,
        orderhenkan.datachar01,
        orderhenkan.datachar02,
        orderhenkan.datachar10,
        CASE
            WHEN orderhenkan.datachar02 is null THEN NULL
            ELSE concat(categorykanriDatachar2.category2,' ',categorykanriDatachar2.category4) END as datachar02_detail,
        orderhenkan.datachar03,
        CASE
            WHEN orderhenkan.datachar03 is null THEN NULL
            ELSE concat(orderhenkan.datachar03,' ',gazou2.urlsm) END as datachar03_detail,
        orderhenkan.datachar04,
        orderhenkan.datachar05,
        orderhenkan.ordertypebango2,
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
        CASE
            WHEN tuhanorder.kessaihouhou is null THEN NULL
            ELSE concat(categorykanriKessaihouhou.category2,' ',categorykanriKessaihouhou.category4) END as kessaihouhou_detail,
        tuhanorder.housoukubun,
        soukonyuko.datachar09 as file_name,
        --LEFT (soukonyuko.datachar09, 10)||'...'||RIGHT (soukonyuko.datachar09, 3) as file_name_short
        CASE
            WHEN soukonyuko.datachar09 is null THEN NULL
            WHEN strpos(soukonyuko.datachar09::text,'¶')<1 THEN soukonyuko.datachar09
            WHEN LENGTH(SPLIT_PART(soukonyuko.datachar09::text,'¶',1))>11 THEN concat(substring(SPLIT_PART(soukonyuko.datachar09::text,'¶',1),1,10),'...',SPLIT_PART(soukonyuko.datachar09::text,'.',2))
            ELSE concat(SPLIT_PART(soukonyuko.datachar09::text,'¶',1),'.',SPLIT_PART(soukonyuko.datachar09::text,'.',2))
            END as file_name_short,
        hikiatesyukko.datachar04 as hikiatesyukko_datachar04

        from orderhenkan

        left join tuhanorder on tuhanorder.orderbango = orderhenkan.bango
            AND tuhanorder.juchubango = orderhenkan.kokyakuorderbango

        left join soukonyuko on soukonyuko.datachar01  = orderhenkan.datachar08

        left join hikiatesyukko on hikiatesyukko.orderbango  = orderhenkan.bango

        left join gazou2 on gazou2.url = orderhenkan.datachar03

        left join categorykanri as categorykanriDatachar2
        on substring(orderhenkan.datachar02,1,2) = categorykanriDatachar2.category1
        and substring(orderhenkan.datachar02,3,3) = categorykanriDatachar2.category2

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

        ");

        if($req_type == 'sales_data'){
            $data=DB::table('order_inquiry_first_part')->whereRaw('kokyakuorderbango = ' . "'$kokyakuorderbango'" . ' AND ordertypebango2 = ' . "'$ordertypebango2'" ." ");
        }else{
            $data=DB::table('order_inquiry_first_part')->whereRaw('kokyakuorderbango = ' . "'$kokyakuorderbango'" . ' AND ordertypebango2 = ' . "'$ordertypebango2'" ." AND datachar10 IS NULL");
        }

        return $data;

    }
}
