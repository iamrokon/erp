<?php

namespace App\AllClass\purchase\supportReqConfirmation;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\kengen;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class PdfData{
    public static function data($bango,$deleted_item=2,$kokyakuorderbango=null){

        
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
        kokyakuorderbango, max(ordertypebango2) as maxval,intorder01,intorder02,intorder03,intorder04,intorder05,max(bango) as bango
        from orderhenkan
        where synchroorderbango = 0 and datachar10 is null
        group by kokyakuorderbango,intorder01,intorder02,intorder03,intorder04,intorder05");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS minyuko_m");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE minyuko_m as
        select distinct 
        syouhinid,syouhinsyu, max(zaikometer) as max_zaikometer
        from minyuko
        group by syouhinid,syouhinsyu");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS support_req_confirmation_temp");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE support_req_confirmation_temp as
        select  
        --on (orderhenkan.kokyakuorderbango)
        orderhenkan.bango,
        orderhenkan.kokyakuorderbango,
        orderhenkan.kokyakubango,
        orderhenkan.ordertypebango2,
        orderhenkan.kokyakuorderbango as support_number,
        orderhenkan.orderuserbango,
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
        --CASE
        --    WHEN orderhenkan.deletedate::text is null THEN NULL
        --    ELSE concat_ws('/',substring(orderhenkan.deletedate::text,1,4),
        --    substring(orderhenkan.deletedate::text,6,2),
        --    substring(orderhenkan.deletedate::text,8,2)) END as deletedate,   
        to_char(orderhenkan.deletedate, 'YYYY/MM/DD') as deletedate,
        to_char(orderhenkan.date0012, 'YYYY/MM/DD') as date0012,
        CASE
            WHEN orderhenkan.date::text is null THEN NULL
            ELSE concat_ws('/',substring(date(orderhenkan.date)::text,1,4),
            substring(date(orderhenkan.date)::text,6,2),
            substring(date(orderhenkan.date)::text,9,2)) END as date,
        orderhenkan.datachar02,
        orderhenkan.datachar10,
        orderhenkan.datachar11,
        LEFT(orderhenkan.datachar11,8) as datachar11_short,
        LEFT(kokyaku1Datachar11.name,10) as company_name,
        LEFT(kokyaku1Datachar11.address,10) as company_address,
        orderhenkan.datachar09,
        --minyuko.support_amount,
        orderhenkan.datatxt0151,
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
        orderhenkan.datachar13,
        orderhenkan.datachar14,
        orderhenkan.datachar15,
        to_char(orderhenkan.date0013, 'YYYY/MM/DD') as date0013,
        to_char(orderhenkan.date0014, 'YYYY/MM/DD') as date0014,
        to_char(orderhenkan.date0015, 'YYYY/MM/DD') as date0015,
        orderhenkan.datatxt0148,
        orderhenkan.datatxt0149,
        categorykanriDatatxt0149.category4 as datatxt0149_detail,
        orderhenkan.date0016,
        orderhenkan.date0017,
        orderhenkan.datatxt0147,
        orderhenkan.datatxt0155,
        orderhenkan.datatxt0157,
        tuhanorder.juchukubun1,
        tuhanorder.information1,
        concat(information1Detail.r17_4,'様') as information1_detail,
        tuhanorder.information2,
        tuhanorder.information3,
        concat(information3Detail.r17_4,'様') as information3_detail,
        hikiatenyuko.dataint03,
        hikiatenyuko.dataint04,
        hikiatenyuko.datachar01,
        hikiatenyuko.dataint06,
        datachar09Tantousya.name as responsible_person,
        datachar12Tantousya.datatxt0003,
        datachar12Tantousya.datatxt0004,
        datachar12Tantousya.mail4,
        CASE
            WHEN hikiatenyuko.datachar01 is null THEN null
            ELSE concat('承認者',' ',datachar01Tantousya.name) END as authorizer,
        minyuko.datachar02 as minyuko_datachar02,
        --minyuko.datachar03 as minyuko_datachar03,
        CASE
            WHEN LENGTH(minyuko.datachar03) > 40 THEN concat(substring(minyuko.datachar03,0,40),'…')
            ELSE minyuko.datachar03 END as minyuko_datachar03,
        minyuko.datachar09 as minyuko_datachar09,
        minyuko.datachar11 as minyuko_datachar11,
        datachar13Tantousya.name as minyuko_datachar13_name,
        minyuko.nyukosu as minyuko_nyukosu,
        minyuko.genka as minyuko_genka,
        minyuko.syouhizeiritu as minyuko_syouhizeiritu,
        minyuko.kaiinid,
        minyuko.zaikometer,
        minyuko.denpyobango,
        concat(kaiinidDetail.r17_4,'様') as kaiinid_detail,
        haisouData.yubinbango as haisou_yubinbango,
        haisouData.address as haisou_address,
        haisouData.tel as haisou_tel,
        kokyaku1Data.name as kokyaku1_name,
        etsuransyaData.mail2 as etsuransya_mail2,
        etsuransyaData.tantousya as etsuransya_tantousya
        
        --from (select max(orderbango) as orderbango, syouhinid, sum(syouhizeiritu) as support_amount from minyuko group by syouhinid) as temp_minyuko
        from minyuko
        
        join minyuko_m on minyuko_m.syouhinid = minyuko.syouhinid AND minyuko_m.syouhinsyu = minyuko.syouhinsyu AND minyuko_m.max_zaikometer = minyuko.zaikometer
        
        join orderhenkan on orderhenkan.kokyakuorderbango = minyuko.syouhinid
        
        join orderhenkan_m on orderhenkan_m.kokyakuorderbango = orderhenkan.kokyakuorderbango
        AND orderhenkan_m.maxval = orderhenkan.ordertypebango2
        
        
        join hikiatenyuko on hikiatenyuko.syouhinid = orderhenkan.kokyakuorderbango
        
        join orderhenkan_inner_data on orderhenkan_inner_data.kokyakuorderbango = orderhenkan.orderuserbango
        --AND orderhenkan_inner_data.maxval = orderhenkan.ordertypebango2
        
        join tuhanorder on tuhanorder.juchubango = orderhenkan.orderuserbango AND tuhanorder.orderbango = orderhenkan_inner_data.bango
        
        left join tantousya as datachar09Tantousya on datachar09Tantousya.bango = orderhenkan.datachar09
        left join tantousya as datachar12Tantousya on datachar12Tantousya.bango = orderhenkan.datachar12
        left join tantousya as datachar01Tantousya on datachar01Tantousya.bango = hikiatenyuko.datachar01
        left join tantousya as datachar13Tantousya on datachar13Tantousya.bango = minyuko.datachar13
        
        --information1
        left join temp_v_torihikisaki as information1Detail on
        information1Detail.torihikisaki_cd = tuhanorder.information1
        --information1 end
        
        --information3
        left join temp_v_torihikisaki as information3Detail on
        information3Detail.torihikisaki_cd = tuhanorder.information3
        --information3 end
        
        --kaiinid
        left join temp_v_torihikisaki as kaiinidDetail on
        kaiinidDetail.torihikisaki_cd = minyuko.kaiinid
        --kaiinid end
        
        --datachar11
        left join kokyaku1 as kokyaku1Datachar11
        on substring(orderhenkan.datachar11,1,6) = kokyaku1Datachar11.yobi12
        --datachar11 end
        
        left join categorykanri as categorykanriDatatxt0149
        on substring(orderhenkan.datatxt0149,1,2) = categorykanriDatatxt0149.category1
        and substring(orderhenkan.datatxt0149,3,5) = categorykanriDatatxt0149.category2
        
        left join haisou as haisouData
        on substring(minyuko.kaiinid,1,6) = haisouData.shikibetsucode
        and substring(minyuko.kaiinid,7,2) = haisouData.torihikisakibango
        
        left join etsuransya as etsuransyaData
        on substring(minyuko.kaiinid,1,6) = etsuransyaData.datatxt0014
        and substring(minyuko.kaiinid,7,2) = etsuransyaData.datatxt0015
        and substring(minyuko.kaiinid,9,3) = etsuransyaData.datatxt0049
        
        left join kokyaku1 as kokyaku1Data
        on substring(minyuko.kaiinid,1,6) = kokyaku1Data.yobi12
        
        where minyuko.syouhinid = '$kokyakuorderbango'
        and minyuko.denpyobango != 1
        
        ");
        
        $data=DB::table('support_req_confirmation_temp');

        return $data;
        
    }
}
