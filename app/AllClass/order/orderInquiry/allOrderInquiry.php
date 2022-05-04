<?php

namespace App\AllClass\order\orderInquiry;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\kengen;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class allOrderInquiry{
    public static function data($bango,$deleted_item=2,$kokyakuorderbango=null,$ordertypebango2=null,$table_name,$req_type=null){

        QueryHelper::runQuery("DROP TABLE IF EXISTS v_torihikisaki_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE v_torihikisaki_temp as
        select *
        from v_torihikisaki
        ");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS order_inquiry_temp");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE order_inquiry_temp as
        select 
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
        misyukko.syouhinid,
        misyukko.syouhinsyu,
        misyukko.hantei,
        misyukko.kawasename,
        misyukko.syouhinname,
        CASE
            WHEN misyukko.dataint09::text is null THEN NULL
            ELSE concat_ws('/',substring(misyukko.dataint09::text,1,4),
            substring(misyukko.dataint09::text,5,2),
            substring(misyukko.dataint09::text,7,2)) END as dataint09,
        CASE
            WHEN misyukko.dataint10::text is null THEN NULL
            ELSE concat_ws('/',substring(misyukko.dataint10::text,1,4),
            substring(misyukko.dataint10::text,5,2),
            substring(misyukko.dataint10::text,7,2)) END as dataint10,
        --concat_ws('／',kokyaku1Datachar5.address,haisouDatachar5.haisoumoji1,etsuransyaDatachar5.mail4) as datachar05_detail,
        torihikisakiDatachar05.r17_3 as datachar05_detail,
        misyukko.datachar06,
        --concat_ws('／',kokyaku1Datachar6.address,haisouDatachar6.haisoumoji1,etsuransyaDatachar6.mail4) as datachar06_detail,
        torihikisakiDatachar06.r17_3 as datachar06_detail,
        misyukko.codename,    
        misyukko.syukkasu,    
        misyukko.yoteimeter,    
        misyukko.dataint01,    
        misyukko.dataint02,    
        misyukko.dataint04,    
        misyukko.dataint05,    
        misyukko.dataint06,    
        misyukko.dataint07,    
        misyukko.dataint08,
        misyukko.dataint11,
        ( SELECT SUM(misyukko.dataint11) 
            FROM misyukko 
            where syouhinid='$kokyakuorderbango'
        ) AS dataint11_amount,
        misyukko.dataint12,
        ( SELECT SUM(misyukko.dataint12) 
            FROM misyukko 
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
        misyukko.barcode,
        misyukko.datachar07,
        misyukko.datachar08,
        --substring(SPLIT_PART(misyukko.datachar09,' ',2),1,2) as datachar09,
        concat_ws(' ',categorykanriDatachar09.category2,categorykanriDatachar09.category4) as datachar09,
        --substring(SPLIT_PART(misyukko.datachar15,' ',2),1,2) as datachar15,
        concat(misyukko.datachar15,' ',datachar15Request.jouhou) as datachar15,
        --concat_ws('／',substring(misyukko.datachar07,1,2),substring(SPLIT_PART(misyukko.datachar09,' ',2),1,2),substring(SPLIT_PART(misyukko.datachar15,' ',2),1,2)) as shipping_instruction,
        concat_ws('／',substring(misyukko.datachar07,1,2),substring(categorykanriDatachar09.category4,1,2),substring(datachar15Request.jouhou,1,2)) as shipping_instruction,
        concat(misyukko.datachar16,' ',datachar16Request.jouhou) as datachar16,
        concat(misyukko.datachar17,' ',datachar17Request.jouhou) as datachar17,
        misyukko.datachar21,
        --misyukko.datachar12 as datachar12_detail,
        
        CASE
            WHEN misyukko.datachar12 is null THEN NULL
            ELSE concat(categorykanriDatachar12.category2,' ',categorykanriDatachar12.category4) END as datachar12_detail,
            
        misyukko.datachar03 as manufacturer_part_num,
        misyukko.datachar04 as manufacturer_product_name,

        case 
           WHEN syouhin1.data100 ='D131' THEN '1 有'
           ELSE '2 無' end as breakdown_maintenance,

        case 
           WHEN syouhin1.data100 ='D131'  
             THEN  case
              WHEN  substring(juchusyukko.datachar01,1,1)  = '1' THEN '1 済'
              ELSE '2 未' END
           ELSE null end as maintenance_creation

        from $table_name as misyukko
        
        left join orderhenkan on orderhenkan.bango = misyukko.orderbango
        AND orderhenkan.kokyakuorderbango = misyukko.syouhinid
        
        left join tuhanorder on tuhanorder.orderbango = orderhenkan.bango
        AND tuhanorder.juchubango = orderhenkan.kokyakuorderbango
        
        left join request as housoukubunRequest on housoukubunRequest.syouhinbango = substring(tuhanorder.housoukubun,1,1)::int
        AND housoukubunRequest.color = '0201即時区分'
        
        left join tantousya as tantousyaDtchar01 on tantousyaDtchar01.bango = misyukko.datachar01
        
        left join tantousya as tantousyaDtchar02 on tantousyaDtchar02.bango = misyukko.datachar02

        left join categorykanri as categorykanriDatachar09
        on substring(misyukko.datachar09,1,2) = categorykanriDatachar09.category1
        and substring(misyukko.datachar09,3,2) = categorykanriDatachar09.category2
        
        left join categorykanri as categorykanriDatachar12
        on substring(misyukko.datachar12,1,2) = categorykanriDatachar12.category1
        and substring(misyukko.datachar12,3,2) = categorykanriDatachar12.category2
        
        left join request as datachar15Request on datachar15Request.syouhinbango = substring(misyukko.datachar15,1,1)::int
        AND datachar15Request.color = '0201継続区分'
        
        left join request as datachar16Request on datachar16Request.syouhinbango = substring(misyukko.datachar16,1,1)::int
        AND datachar16Request.color = '0201新規VUP'
        
        left join request as datachar17Request on datachar17Request.syouhinbango = substring(misyukko.datachar17,1,1)::int
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
        left join v_torihikisaki_temp as torihikisakiDatachar05
        on torihikisakiDatachar05.torihikisaki_cd = misyukko.datachar05
        --datachar05 end
        
        --datachar06
        left join v_torihikisaki_temp as torihikisakiDatachar06
        on torihikisakiDatachar06.torihikisaki_cd = misyukko.datachar06
        --datachar06 end
        
        join syouhin1
        on misyukko.kawasename=syouhin1.kokyakusyouhinbango

        join juchusyukko
        on misyukko.syouhinid = juchusyukko.syouhinid
        AND misyukko.syouhinsyu = juchusyukko.syouhinsyu
        AND misyukko.hantei = juchusyukko.hantei

        order by dataint02 asc");

        if($req_type == 'sales_data'){
            $data=DB::table('order_inquiry_temp')->whereRaw('syouhinid = ' . "'$kokyakuorderbango'" );
        }else{
           $data=DB::table('order_inquiry_temp')->whereRaw('syouhinid = ' . "'$kokyakuorderbango'" . ' AND dataint01 = ' . "'$ordertypebango2'"); 
        }

        return $data;
        
    }
}
