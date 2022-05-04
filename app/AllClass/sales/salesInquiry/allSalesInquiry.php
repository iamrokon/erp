<?php

namespace App\AllClass\sales\salesInquiry;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\kengen;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class allSalesInquiry{
    public static function data($bango,$deleted_item=2,$kokyakuorderbango=null,$ordertypebango2=null,$table_name){

        QueryHelper::runQuery("DROP TABLE IF EXISTS sales_inquiry_temp");

        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE sales_inquiry_temp as
        select distinct kawasename,
        orderhenkan.bango,
        orderhenkan.kokyakuorderbango,
        orderhenkan.datachar05,
        orderhenkan.ordertypebango2,
        tuhanorder.information7,
        tuhanorder.information8,
        tuhanorder.information9,
        tuhanorder.kessaihouhou,
        CASE
            WHEN tuhanorder.kessaihouhou is null THEN NULL
            ELSE concat(categorykanriKessaihouhou.category2,' ',categorykanriKessaihouhou.category4) END as kessaihouhou_detail,
        tuhanorder.chumonsyajouhou,
        CASE
            WHEN tuhanorder.chumonsyajouhou is null THEN NULL
            ELSE concat(categorykanriChumonsyajouhou.category2,' ',categorykanriChumonsyajouhou.category4) END as chumonsyajouhou_detail,
        tuhanorder.soufusakijouhou,
        CASE
            WHEN tuhanorder.soufusakijouhou is null THEN NULL
            ELSE concat(categorykanriSoufusakijouhou.category2,' ',categorykanriSoufusakijouhou.category4) END as soufusakijouhou_detail,
        tuhanorder.housoukubun,
        concat_ws(' ',substring(tuhanorder.housoukubun,1,2),housoukubunRequest.jouhou) as housoukubun_detail,
        syukkoold.syouhinid,
        syukkoold.syouhinsyu,
        syukkoold.hantei,
        syukkoold.syouhinname,
        CASE
            WHEN syukkoold.dataint09::text is null THEN NULL
            ELSE concat_ws('/',substring(syukkoold.dataint09::text,1,4),
            substring(syukkoold.dataint09::text,5,2),
            substring(syukkoold.dataint09::text,7,2)) END as dataint09,
        CASE
            WHEN syukkoold.dataint10::text is null THEN NULL
            ELSE concat_ws('/',substring(syukkoold.dataint10::text,1,4),
            substring(syukkoold.dataint10::text,5,2),
            substring(syukkoold.dataint10::text,7,2)) END as dataint10,
        concat_ws('／',kokyaku1Datachar5.address,haisouDatachar5.haisoumoji1,etsuransyaDatachar5.mail4) as datachar05_detail,
        syukkoold.datachar06,
        concat_ws('／',kokyaku1Datachar6.address,haisouDatachar6.haisoumoji1,etsuransyaDatachar6.mail4) as datachar06_detail,
        syukkoold.codename,
        syukkoold.syukkasu,
        syukkoold.yoteimeter,
        syukkoold.dataint01,
        syukkoold.dataint02,
        syukkoold.dataint04,
        syukkoold.dataint04 as s_dataint04,
        syukkoold.dataint05,
        syukkoold.dataint06,
        syukkoold.dataint07,
        syukkoold.dataint08,
        syukkoold.dataint11,
        ( SELECT SUM(syukkoold.dataint11)
            FROM syukkoold
            where syouhinid='$kokyakuorderbango'
        ) AS dataint11_amount,
        syukkoold.dataint12,
        ( SELECT SUM(syukkoold.dataint12)
            FROM syukkoold
            where syouhinid='$kokyakuorderbango'
        ) AS dataint12_amount,
        CASE
            WHEN tantousyaDtchar01.bango is null THEN NULL
            ELSE tantousyaDtchar01.name
            END as tuhan_datachar01,
        CASE
            WHEN tantousyaDtchar02.bango is null THEN NULL
            ELSE tantousyaDtchar02.name
            END as tuhan_datachar02,
        syukkoold.barcode,
        syukkoold.datachar07,
        syukkoold.datachar08,
        --substring(SPLIT_PART(syukkoold.datachar09,' ',2),1,2) as datachar09,
        concat_ws(' ',categorykanriDatachar09.category2,categorykanriDatachar09.category4) as datachar09,
        --substring(SPLIT_PART(syukkoold.datachar15,' ',2),1,2) as datachar15,
        concat(syukkoold.datachar15,' ',datachar15Request.jouhou) as datachar15,
        --concat_ws('／',substring(syukkoold.datachar07,1,2),substring(SPLIT_PART(syukkoold.datachar09,' ',2),1,2),substring(SPLIT_PART(syukkoold.datachar15,' ',2),1,2)) as shipping_instruction,
        concat_ws('／',substring(syukkoold.datachar07,1,2),substring(categorykanriDatachar09.category4,1,2),substring(datachar15Request.jouhou,1,2)) as shipping_instruction,
        concat(syukkoold.datachar16,' ',datachar16Request.jouhou) as datachar16,
        concat(syukkoold.datachar17,' ',datachar17Request.jouhou) as datachar17,
        --syukkoold.datachar12 as datachar12_detail,

        CASE
            WHEN syukkoold.datachar12 is null THEN NULL
            ELSE concat(categorykanriDatachar12.category2,' ',categorykanriDatachar12.category4) END as datachar12_detail,

        CONCAT(
            RIGHT(categorykanri5.category2, 2) ,' ',categorykanri5.category4) as category_detail2,

        categorykanri4.category4 as category_detail1,
        syukkoold.datachar03 as manufacturer_part_num,
        syukkoold.datachar04 as manufacturer_product_name

        from syukkoold

        left join orderhenkan on orderhenkan.bango = syukkoold.orderbango
        AND orderhenkan.kokyakuorderbango = syukkoold.syouhinid

        left join tuhanorder on tuhanorder.orderbango = orderhenkan.bango
        AND tuhanorder.juchubango = orderhenkan.kokyakuorderbango

        left join request as housoukubunRequest on housoukubunRequest.syouhinbango = substring(tuhanorder.housoukubun,1,1)::int
        AND housoukubunRequest.color = '0201即時区分'

        left join tantousya as tantousyaDtchar01 on tantousyaDtchar01.bango = syukkoold.datachar01

        left join tantousya as tantousyaDtchar02 on tantousyaDtchar02.bango = syukkoold.datachar02

        left join categorykanri as categorykanriDatachar09
        on substring(syukkoold.datachar09,1,2) = categorykanriDatachar09.category1
        and substring(syukkoold.datachar09,3,2) = categorykanriDatachar09.category2

        left join categorykanri as categorykanriDatachar12
        on substring(syukkoold.datachar12,1,2) = categorykanriDatachar12.category1
        and substring(syukkoold.datachar12,3,2) = categorykanriDatachar12.category2

        left join syouhin1 on syukkoold.kawasename = syouhin1.kokyakusyouhinbango
        left join categorykanri as categorykanri4 on categorykanri4.category1='C5' AND syouhin1.koyuujouhou = CONCAT(categorykanri4.category1,categorykanri4.category2)
        left join categorykanri as categorykanri5 on categorykanri5.category1='C8' AND syouhin1.data53 = CONCAT(categorykanri5.category1,categorykanri5.category2)

        left join request as datachar15Request on datachar15Request.syouhinbango = substring(syukkoold.datachar15,1,1)::int
        AND datachar15Request.color = '0201継続区分'

        left join request as datachar16Request on datachar16Request.syouhinbango = substring(syukkoold.datachar16,1,1)::int
        AND datachar16Request.color = '0201新規VUP'

        left join request as datachar17Request on datachar17Request.syouhinbango = substring(syukkoold.datachar17,1,1)::int
        AND datachar17Request.color = '0201VUP区分'

        left join categorykanri as categorykanriKessaihouhou
        on substring(tuhanorder.kessaihouhou,1,2) = categorykanriKessaihouhou.category1
        and substring(tuhanorder.kessaihouhou,3,2) = categorykanriKessaihouhou.category2

        left join categorykanri as categorykanriChumonsyajouhou
        on substring(tuhanorder.chumonsyajouhou,1,2) = categorykanriChumonsyajouhou.category1
        and substring(tuhanorder.chumonsyajouhou,3,2) = categorykanriChumonsyajouhou.category2

        left join categorykanri as categorykanriSoufusakijouhou
        on substring(tuhanorder.soufusakijouhou,1,2) = categorykanriSoufusakijouhou.category1
        and substring(tuhanorder.soufusakijouhou,3,1) = categorykanriSoufusakijouhou.category2

        --datachar05
        left join kokyaku1 as kokyaku1Datachar5
        on substring(syukkoold.datachar05,1,6) = kokyaku1Datachar5.yobi12

        left join haisou as haisouDatachar5
        on substring(syukkoold.datachar05,7,2) = haisouDatachar5.torihikisakibango
        and kokyaku1Datachar5.bango = haisouDatachar5.kokyakubango

        left join etsuransya as etsuransyaDatachar5
        on substring(syukkoold.datachar05,9,3) = etsuransyaDatachar5.datatxt0049
        and haisouDatachar5.bango::text = etsuransyaDatachar5.datanum0018::text
        --datachar05 end

        --datachar06
        left join kokyaku1 as kokyaku1Datachar6
        on substring(syukkoold.datachar06,1,6) = kokyaku1Datachar6.yobi12

        left join haisou as haisouDatachar6
        on substring(syukkoold.datachar06,7,2) = haisouDatachar6.torihikisakibango
        and kokyaku1Datachar6.bango = haisouDatachar6.kokyakubango

        left join etsuransya as etsuransyaDatachar6
        on substring(syukkoold.datachar06,9,3) = etsuransyaDatachar6.datatxt0049
        and haisouDatachar6.bango::text = etsuransyaDatachar6.datanum0018::text
        --datachar06 end

        order by dataint02 asc");


        $data=DB::table('sales_inquiry_temp')->whereRaw('syouhinid = ' . "'$kokyakuorderbango'");


        return $data;

    }
}
