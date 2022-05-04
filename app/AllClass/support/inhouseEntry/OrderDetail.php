<?php


namespace App\AllClass\support\inhouseEntry;


use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;

class OrderDetail
{
    public static function data($bango, $orderId)
    {
        QueryHelper::runQuery("DROP TABLE IF EXISTS inhouse_entr_v_torihikisaki_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE inhouse_entr_v_torihikisaki_temp as
        select *
        from v_torihikisaki
        ");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS misyukko_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE misyukko_temp as
        select 
        max(minyuko.orderbango) as minyuko_orderbango,
        sum(misyukko.dataint05*misyukko.syukkasu) as support_amount
        from misyukko 
        join minyuko on minyuko.idoutanabango = misyukko.syouhinid AND minyuko.yoteimeter = misyukko.syouhinsyu
        AND minyuko.nyukometer = misyukko.hantei
        group by misyukko.syouhinid
        ");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_m");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_m as
        select distinct 
        kokyakuorderbango, max(ordertypebango2) as maxval
        from orderhenkan
        where synchroorderbango2 = 0 
        group by kokyakuorderbango");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_delete_check ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_delete_check as
        select  
        kokyakuorderbango
        from orderhenkan
        where synchroorderbango2 = 1 
        ");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_inner_data");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_inner_data as
        select distinct 
        kokyakuorderbango, max(ordertypebango2) as maxval,intorder01,intorder03,intorder04
        from orderhenkan
        where synchroorderbango = 0 and datachar10 is null
        group by kokyakuorderbango,intorder01,intorder03,intorder04");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS inhouse_entry_temp");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE inhouse_entry_temp as
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
            WHEN orderhenkan.date::text is null THEN NULL
            ELSE concat_ws('/',substring(date(orderhenkan.date)::text,1,4),
            substring(date(orderhenkan.date)::text,6,2),
            substring(date(orderhenkan.date)::text,9,2)) END as date,
        orderhenkan.datachar02,
        orderhenkan.datachar10,
        --datachar10Detail.r17_4 as datachar10_detail,
        orderhenkan.datachar11,
        --datachar11Detail.r17_4 as datachar11_detail,
        --orderhenkan.datachar13,
        CASE
            WHEN LENGTH(orderhenkan.datachar13) > 11 THEN concat(substring(orderhenkan.datachar13,0,10),'...')
            ELSE orderhenkan.datachar13 END as datachar13,
        orderhenkan.datachar09,
        datachar09Tantousya.name as user_name,
        replace(replace(datachar09Tantousya.name,' ',''),'　','') as user_name_search,
        substring(replace(replace(datachar09Tantousya.name,' ',''),'　',''),1,3) as user_name_short,
        misyukko_temp.support_amount,
        to_char(misyukko_temp.support_amount,'FM99,999,999,999,999') as formatted_support_amount,
        orderhenkan.datatxt0151,
        to_char(orderhenkan.deletedate, 'YYYY/MM/DD') as deletedate,
        to_char(orderhenkan.date0012, 'YYYY/MM/DD') as date0012,
        CASE
            WHEN orderhenkan_inner_data.intorder01::text is null THEN NULL
            ELSE concat_ws('/',substring(orderhenkan_inner_data.intorder01::text,1,4),
            substring(orderhenkan_inner_data.intorder01::text,5,2),
            substring(orderhenkan_inner_data.intorder01::text,7,2)) END as intorder01,
        orderhenkan.datachar12,
        to_char(orderhenkan.date0013, 'YYYY/MM/DD') as date0013,
        to_char(orderhenkan.date0014, 'YYYY/MM/DD') as date0014,
        to_char(orderhenkan.date0015, 'YYYY/MM/DD') as date0015,
        orderhenkan.datatxt0148,
        orderhenkan.datatxt0149,
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
        information1Detail.r17_3 as information1_detail,
        tuhanorder.information3,
        information3Detail.r17_3 as information3_detail,
        hikiatenyuko.dataint03,
        concat(dataint03Request.syouhinbango,' ',dataint03Request.jouhou) as dataint03_detail,
        hikiatenyuko.dataint04,
        concat(dataint04Request.syouhinbango,' ',dataint04Request.jouhou) as dataint04_detail,
        hikiatenyuko.datachar01,
        datachar01Tantousya.name as inspector_name,
        replace(replace(datachar01Tantousya.name,' ',''),'　','') as inspector_name_search,
        substring(replace(replace(datachar01Tantousya.name,' ',''),'　',''),1,3) as inspector_name_short,
        hikiatenyuko.dataint06,
        concat(dataint06Request.syouhinbango,' ',dataint06Request.jouhou) as dataint06_detail,
        datachar09Tantousya.datatxt0003,
        datachar09Tantousya.datatxt0004,
        datachar09Tantousya.mail4,
        --datatxt0004Tantousya.datatxt0003 as datatxt0003_2,
        --datatxt0004Tantousya.datatxt0004 as datatxt0004_2,
        --datatxt0004Tantousya.mail4 as mail4_2,
        minyuko.yoteimeter,
        minyuko.nyukometer,
        minyuko.syouhinsyu,
        minyuko.syouhinsyu as minyuko_syouhinsyu,
        minyuko.datachar02 as minyuko_datachar02,
        minyuko.datachar03 as minyuko_datachar03,
        minyuko.nyukosu as minyuko_nyukosu,
        minyuko.genka as minyuko_genka,
        to_char(minyuko.genka,'FM99,999,999,999,999') as formatted_minyuko_genka,
        minyuko.syouhizeiritu as minyuko_syouhizeiritu,
        to_char(minyuko.syouhizeiritu,'FM99,999,999,999,999') as formatted_minyuko_syouhizeiritu,
        minyuko.datachar01 as minyuko_datachar01,
        minyuko.datachar13 as minyuko_datachar13,
        minyuko.datachar19 as minyuko_datachar19,
        minyuko.denpyobango as minyuko_denpyobango,
        minyuko.idoutanabango as minyuko_idoutanabango,
        minyuko.yoteimeter as minyuko_yoteimeter,
        minyuko.nyukometer as minyuko_nyukometer,
        --(select misyukko.dataint05*misyukko.syukkasu from misyukko where misyukko.syouhinid = minyuko.idoutanabango and misyukko.syouhinsyu = minyuko.yoteimeter and misyukko.hantei = minyuko.nyukometer) as se_checking_amount
        (select sum(misyukko.dataint05*misyukko.syukkasu) from misyukko where misyukko.syouhinid = minyuko.idoutanabango) as se_checking_amount
        
        --from (select max(orderbango) as orderbango, syouhinid, sum(dataint05*syukkasu) as support_amount from misyukko group by syouhinid) as temp_misyukko
        from minyuko
        
        --join orderhenkan on orderhenkan.bango = temp_misyukko.orderbango
        --AND orderhenkan.kokyakuorderbango = temp_misyukko.syouhinid
        
        join orderhenkan on orderhenkan.kokyakuorderbango = minyuko.syouhinid
        AND orderhenkan.bango = minyuko.orderbango
        
        join orderhenkan_m on orderhenkan_m.kokyakuorderbango = orderhenkan.kokyakuorderbango
        AND orderhenkan_m.maxval = orderhenkan.ordertypebango2
        
        join tuhanorder on tuhanorder.juchubango = orderhenkan.orderuserbango
        --AND tuhanorder.juchubango = orderhenkan.kokyakuorderbango
        
        join hikiatenyuko on hikiatenyuko.syouhinid = orderhenkan.kokyakuorderbango
        
        join orderhenkan_inner_data on orderhenkan_inner_data.kokyakuorderbango = orderhenkan.orderuserbango
        
        left join orderhenkan_delete_check on
        orderhenkan_delete_check.kokyakuorderbango = orderhenkan.kokyakuorderbango
        
        left join misyukko_temp on misyukko_temp.minyuko_orderbango = minyuko.orderbango
        
        left join tantousya as datachar09Tantousya on datachar09Tantousya.bango = orderhenkan.datachar09
        --left join tantousya as datatxt0004Tantousya on datatxt0004Tantousya.datatxt0004 = orderhenkan.datatxt0149
        
        left join tantousya as datatxt0155Tantousya on datatxt0155Tantousya.bango = orderhenkan.datatxt0155
        
        left join tantousya as datachar01Tantousya on datachar01Tantousya.bango = hikiatenyuko.datachar01
        
        left join categorykanri as categorykanriDatatxt0149
        on substring(orderhenkan.datatxt0149,1,2) = categorykanriDatatxt0149.category1
        and substring(orderhenkan.datatxt0149,3,5) = categorykanriDatatxt0149.category2
        
        --information1
        left join inhouse_entr_v_torihikisaki_temp as information1Detail on
        information1Detail.torihikisaki_cd = tuhanorder.information1
        --information1 end
        
        --information3
        left join inhouse_entr_v_torihikisaki_temp as information3Detail on
        information3Detail.torihikisaki_cd = tuhanorder.information3
        --information1 end

        --datachar10
        --left join inhouse_entr_v_torihikisaki_temp as datachar10Detail on
        --datachar10Detail.torihikisaki_cd = orderhenkan.datachar10
        --datachar10 end
        
        --datachar11
        --left join inhouse_entr_v_torihikisaki_temp as datachar11Detail on
        --datachar11Detail.torihikisaki_cd = orderhenkan.datachar11
        --datachar11 end
        
        left join request as dataint03Request on dataint03Request.syouhinbango = hikiatenyuko.dataint03
        AND dataint03Request.color = '0507PDF作成フラグ'
        
        left join request as dataint04Request on dataint04Request.syouhinbango = hikiatenyuko.dataint04
        AND dataint04Request.color = '0507PDFダウンロードフラグ'
        
        left join request as dataint06Request on dataint06Request.syouhinbango = hikiatenyuko.dataint06
        AND dataint06Request.color = '0507検印フラグ'
        
        where orderhenkan.kokyakuorderbango='$orderId' and orderhenkan.datachar02 = 'V413'
        and orderhenkan.synchroorderbango2 = 0
        AND hikiatenyuko.dataint03 = 1 
        AND minyuko.denpyobango = 0
        AND orderhenkan_delete_check.kokyakuorderbango IS NULL
        
        order by minyuko.yoteimeter,minyuko.nyukometer,minyuko.syouhinsyu
        ");
        
        //$inhouse_entry_temp = QueryHelper::fetchResult("select * from inhouse_entry_temp");
        //dd($inhouse_entry_temp);
        
        $data = DB::table('inhouse_entry_temp')->toSql();
        return $data;
        
    }

}
