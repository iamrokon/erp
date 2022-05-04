<?php

namespace App\AllClass\purchase\supportInquiry;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class AllSupportInquiry{
    public static function data($login_bango,$support_number,$ordertypebango2){

        QueryHelper::runQuery("DROP TABLE IF EXISTS temp_v_torihikisaki");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE temp_v_torihikisaki as
        select *
        from v_torihikisaki
        ");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_m");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_m as
        select distinct 
        kokyakuorderbango, max(ordertypebango2) as maxval
        from orderhenkan
        --where synchroorderbango = 0 
        group by kokyakuorderbango");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_inner_data");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_inner_data as
        select distinct 
        orderhenkan.kokyakuorderbango,
        temp_orderhenkan.maxval,
        orderhenkan.intorder01,
        orderhenkan.intorder02,
        orderhenkan.intorder03,
        orderhenkan.intorder04,
        orderhenkan.intorder05
        from (select max(ordertypebango2) as maxval,kokyakuorderbango from orderhenkan where synchroorderbango = 0 group by kokyakuorderbango) as temp_orderhenkan
        --where synchroorderbango = 0 and datachar10 is null
        join orderhenkan on orderhenkan.kokyakuorderbango = temp_orderhenkan.kokyakuorderbango and orderhenkan.ordertypebango2 = temp_orderhenkan.maxval
        --group by kokyakuorderbango,intorder01,intorder02,intorder03,intorder04
        ");
          
        QueryHelper::runQuery("DROP TABLE IF EXISTS support_req_confirmation_temp");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE support_req_confirmation_temp as
        select distinct 
        --on (orderhenkan.kokyakuorderbango)
        orderhenkan.bango,
        orderhenkan.kokyakuorderbango,
        orderhenkan.kokyakuorderbango as support_number,
        orderhenkan.orderuserbango,
        orderhenkan.ordertypebango2,
        CASE
            WHEN orderhenkan_inner_data.intorder03::text is null THEN NULL
            ELSE concat_ws('/',substring(orderhenkan_inner_data.intorder03::text,1,4),
            substring(orderhenkan_inner_data.intorder03::text,5,2),
            substring(orderhenkan_inner_data.intorder03::text,7,2)) END as intorder03,
        CASE
            WHEN orderhenkan_inner_data.intorder04::text is null THEN NULL
            ELSE concat_ws('/',substring(orderhenkan_inner_data.intorder04::text,1,4),
            substring(orderhenkan_inner_data.intorder04::text,5,2),
            substring(orderhenkan_inner_data.intorder04::text,7,2)) END as intorder04,
        CASE
            WHEN orderhenkan_inner_data.intorder05::text is null THEN NULL
            ELSE concat_ws('/',substring(orderhenkan_inner_data.intorder05::text,1,4),
            substring(orderhenkan_inner_data.intorder05::text,5,2),
            substring(orderhenkan_inner_data.intorder05::text,7,2)) END as intorder05,
        CASE
            WHEN orderhenkan.date::text is null THEN NULL
            ELSE concat_ws('/',substring(date(orderhenkan.date)::text,1,4),
            substring(date(orderhenkan.date)::text,6,2),
            substring(date(orderhenkan.date)::text,9,2)) END as date,
        orderhenkan.datachar02,
        orderhenkan.datachar10,
        datachar10Detail.r17_4 as datachar10_detail,
        orderhenkan.datachar11,
        datachar11Detail.r17_4 as datachar11_detail,
        orderhenkan.datachar13,
        --CASE
        --    WHEN LENGTH(orderhenkan.datachar13) > 11 THEN concat(substring(orderhenkan.datachar13,0,10),'...')
        --    ELSE orderhenkan.datachar13 END as datachar13,
        orderhenkan.datachar09,
        datachar09Tantousya.name as user_name,
        replace(replace(datachar09Tantousya.name,' ',''),'　','') as user_name_search,
        substring(replace(replace(datachar09Tantousya.name,' ',''),'　',''),1,3) as user_name_short,
        temp_minyuko.sum_of_syouhizeiritu,
        to_char(temp_minyuko.sum_of_syouhizeiritu,'FM99,999,999,999,999') as formatted_sum_of_syouhizeiritu,
        temp_minyuko.minyuko_datachar11,
        temp_minyuko.minyuko_datachar09,
        to_char(orderhenkan.deletedate, 'YYYY/MM/DD') as deletedate,
        to_char(orderhenkan.date0012, 'YYYY/MM/DD') as date0012,
        CASE
            WHEN orderhenkan_inner_data.intorder01::text is null THEN NULL
            ELSE concat_ws('/',substring(orderhenkan_inner_data.intorder01::text,1,4),
            substring(orderhenkan_inner_data.intorder01::text,5,2),
            substring(orderhenkan_inner_data.intorder01::text,7,2)) END as intorder01,
        CASE
            WHEN orderhenkan_inner_data.intorder02::text is null THEN NULL
            ELSE concat_ws('/',substring(orderhenkan_inner_data.intorder02::text,1,4),
            substring(orderhenkan_inner_data.intorder02::text,5,2),
            substring(orderhenkan_inner_data.intorder02::text,7,2)) END as intorder02,
        orderhenkan.datachar12,
        orderhenkan.datachar14,
        orderhenkan.datachar15,
        to_char(orderhenkan.date0013, 'YYYY/MM/DD') as date0013,
        to_char(orderhenkan.date0014, 'YYYY/MM/DD') as date0014,
        to_char(orderhenkan.date0015, 'YYYY/MM/DD') as date0015,
        to_char(orderhenkan.date0020, 'YYYY/MM/DD') as date0020,
        orderhenkan.datatxt0147,
        orderhenkan.datatxt0148,
        orderhenkan.datatxt0149,
        orderhenkan.datatxt0150,
        orderhenkan.datatxt0151,
        concat(intorder04Request.syouhinbango,' ',intorder04Request.jouhou) as intorder04_detail,
        soukonyuko.datachar09 as soukonyuko_datachar09,
        CASE 
            WHEN soukonyuko.datachar09::text is null THEN NULL
            WHEN strpos(soukonyuko.datachar09::text,'¶')<1 THEN soukonyuko.datachar09
            WHEN LENGTH(SPLIT_PART(soukonyuko.datachar09::text,'¶',1))>11 THEN concat(substring(SPLIT_PART(soukonyuko.datachar09::text,'¶',1),1,10),'...',SPLIT_PART(soukonyuko.datachar09::text,'.',2))
            ELSE concat(SPLIT_PART(soukonyuko.datachar09::text,'¶',1),'.',SPLIT_PART(soukonyuko.datachar09::text,'.',2))
            END as datachar09_short,
        orderhenkan.datatxt0157,
        CASE
            WHEN orderhenkan.datatxt0149 is null THEN NULL
            ELSE concat(categorykanriDatatxt0149.category2,' ',categorykanriDatatxt0149.category4) END as datatxt0149_detail,
        --orderhenkan.date0016,
        to_char(orderhenkan.date0016, 'YYYY/MM/DD') as date0016,
        to_char(orderhenkan.date0017, 'YYYY/MM/DD') as date0017,
        --orderhenkan.datatxt0155,
        datatxt0155Tantousya.name as changer_name,
        replace(replace(datatxt0155Tantousya.name,' ',''),'　','') as changer_name_search,
        substring(replace(replace(datatxt0155Tantousya.name,' ',''),'　',''),1,3) as changer_name_short,
        tuhanorder.information1,
        tuhanorder.information3,
        tuhanorder.chumonsyajouhou,
        categorykanriChumonsyajouhou.category4 as chumonsyajouhou_detail,
        hikiatenyuko.dataint03,
        concat(dataint03Request.syouhinbango,' ',dataint03Request.jouhou) as dataint03_detail,
        hikiatenyuko.dataint04,
        concat(dataint04Request.syouhinbango,' ',dataint04Request.jouhou) as dataint04_detail,
        hikiatenyuko.datachar01,
        datachar01Tantousya.name as inspector_name,
        replace(replace(datachar01Tantousya.name,' ',''),'　','') as inspector_name_search,
        substring(replace(replace(datachar01Tantousya.name,' ',''),'　',''),1,3) as inspector_name_short,
        hikiatenyuko.dataint06,
        --concat(dataint06Request.syouhinbango,' ',dataint06Request.jouhou) as dataint06_detail,
        datachar09Tantousya.datatxt0003,
        datachar09Tantousya.datatxt0004,
        datachar09Tantousya.mail4
        --datatxt0004Tantousya.datatxt0003 as datatxt0003_2,
        --datatxt0004Tantousya.datatxt0004 as datatxt0004_2,
        --datatxt0004Tantousya.mail4 as mail4_2
        
        from (select max(orderbango) as orderbango,max(datachar11) as minyuko_datachar11,max(datachar09) as minyuko_datachar09, syouhinid, sum(syouhizeiritu) as sum_of_syouhizeiritu from minyuko group by syouhinid) as temp_minyuko
        
        join orderhenkan on orderhenkan.kokyakuorderbango = temp_minyuko.syouhinid
        
        join orderhenkan_m on orderhenkan_m.kokyakuorderbango = orderhenkan.kokyakuorderbango
        AND orderhenkan_m.maxval = orderhenkan.ordertypebango2
        
        join tuhanorder on tuhanorder.juchubango = orderhenkan.orderuserbango
        --AND tuhanorder.juchubango = orderhenkan.kokyakuorderbango
        
        join hikiatenyuko on hikiatenyuko.syouhinid = orderhenkan.kokyakuorderbango
        
        join orderhenkan_inner_data on orderhenkan_inner_data.kokyakuorderbango = orderhenkan.orderuserbango
        
        left join tantousya as datachar09Tantousya on datachar09Tantousya.bango = orderhenkan.datachar09
        --left join tantousya as datatxt0004Tantousya on datatxt0004Tantousya.datatxt0004 = orderhenkan.datatxt0149
        
        left join tantousya as datatxt0155Tantousya on datatxt0155Tantousya.bango = orderhenkan.datatxt0155
        
        left join tantousya as datachar01Tantousya on datachar01Tantousya.bango = hikiatenyuko.datachar01
        
        left join soukonyuko as soukonyuko on soukonyuko.orderbango = orderhenkan.bango
        --and soukonyuko.datachar01 = orderhenkan.datatxt0150
        
        left join categorykanri as categorykanriDatatxt0149
        on substring(orderhenkan.datatxt0149,1,2) = categorykanriDatatxt0149.category1
        and substring(orderhenkan.datatxt0149,3,5) = categorykanriDatatxt0149.category2
        
        left join categorykanri as categorykanriChumonsyajouhou
        on substring(tuhanorder.chumonsyajouhou,1,2) = categorykanriChumonsyajouhou.category1
        and substring(tuhanorder.chumonsyajouhou,3,4) = categorykanriChumonsyajouhou.category2
        
        --datachar10
        left join temp_v_torihikisaki as datachar10Detail on
        datachar10Detail.torihikisaki_cd = orderhenkan.datachar10
        --datachar10 end
        
        --datachar11
        left join temp_v_torihikisaki as datachar11Detail on
        datachar11Detail.torihikisaki_cd = orderhenkan.datachar11
        --datachar11 end
        
        left join request as dataint03Request on dataint03Request.syouhinbango = hikiatenyuko.dataint03
        AND dataint03Request.color = '0507PDF作成フラグ'
        
        left join request as dataint04Request on dataint04Request.syouhinbango = hikiatenyuko.dataint04
        AND dataint04Request.color = '0507PDFダウンロードフラグ'
        
        --left join request as dataint06Request on dataint06Request.syouhinbango = hikiatenyuko.dataint06
        --AND dataint06Request.color = '0507検印フラグ'
        
        left join request as intorder04Request on intorder04Request.syouhinbango = orderhenkan.intorder04
        AND intorder04Request.color = '0506作成区分'
        
        where orderhenkan.kokyakuorderbango = '$support_number' and orderhenkan.ordertypebango2 = '$ordertypebango2'
        
        ");

        
        $data=DB::table('support_req_confirmation_temp');

        return $data;
        
    }
}
