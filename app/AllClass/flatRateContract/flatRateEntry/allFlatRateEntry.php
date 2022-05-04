<?php

namespace App\AllClass\flatRateContract\flatRateEntry;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\kengen;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class allFlatRateEntry{
    public static function data($bango,$contract_number=null){

        QueryHelper::runQuery("DROP TABLE IF EXISTS flat_rate_entry");
        //QueryHelper::runQuery("DROP TABLE IF EXISTS temp_soukosyukko");
        
        //QueryHelper::runQuery("CREATE TEMPORARY TABLE temp_soukosyukko as
        //select 
        //orderbango,hanbaibukacd,count(syouhinid) as count_syouhinid
        //from soukosyukko
        //where syouhinid IS NOT NULL 
        //group by hanbaibukacd,orderbango");

        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE flat_rate_entry as
        select distinct
        orderhenkan.bango,
        CURRENT_DATE as current_date,
        orderhenkan.datachar07,
        orderhenkan.datachar05,
        tuhanorder.datatxt0110,
        tuhanorder.numeric5,
        tuhanorder.datatxt0111,
        tuhanorder.datatxt0112,
        tuhanorder.datatxt0113,
        tuhanorder.numeric6,
        tuhanorder.numeric7,
        tuhanorder.information1,
        information1Torihikisaki.r17_3cd as information1_detail,
        tuhanorder.information2,
        information2Torihikisaki.r17_3cd as information2_detail,
        tuhanorder.information3,
        information3Torihikisaki.r17_3cd as information3_detail,
        tuhanorder.information6,
        information6Torihikisaki.r17_3cd as information6_detail,
        tuhanorder.datatxt0114,
        tuhanorder.datatxt0115,
        --CASE 
        --    WHEN tuhanorder.datatxt0115 is null THEN NULL
        --    ELSE concat(SPLIT_PART(tuhanorder.datatxt0115::text,'¶',1),'.',SPLIT_PART(tuhanorder.datatxt0115::text,'.',2))
        --    END as datatxt0115_detail,
        tuhanorder.kessaihouhou,
        tuhanorder.datatxt0116,
        tuhanorder.datatxt0117,
        tuhanorder.housoukubun,
        tuhanorder.otodoketime,
        tuhanorder.date0001,
        tuhanorder.datatxt0118,
        tuhanorder.datatxt0119,
        tuhanorder.datatxt0124,
        datatxt0124Torihikisaki.r17_3cd as datatxt0124_detail,
        tuhanorder.numericmax,
        tuhanorder.datatxt0123,
        datatxt0123Torihikisaki.r17_3cd as datatxt0123_detail,
        tuhanorder.datatxt0120,
        tuhanorder.numeric1,
        tuhanorder.numeric8,
        tuhanorder.numeric9,
        tuhanorder.numeric10,
        substring(tuhanorder.datatxt0121,3,LENGTH(tuhanorder.datatxt0121)) as datatxt0121,
        tuhanorder.datatxt0122,
        CASE
            WHEN tuhanorder.datatxt0122 is null THEN NULL
            ELSE concat(categorykanriDatatxt0122.category2,' ',categorykanriDatatxt0122.category4) END as datatxt0122_detail,
        replace(substring(tuhanorder.date0002::text,1,10),'-','/') as date0002,
        replace(substring(tuhanorder.date0003::text,1,10),'-','/') as date0003,
        replace(substring(tuhanorder.date0004::text,1,10),'-','/') as date0004,
        replace(substring(tuhanorder.date0005::text,1,10),'-','/') as date0005,
        tuhanorder.money1,
        tuhanorder.money2,
        tuhanorder.money3,
        tuhanorder.money4,
        tuhanorder.money5,
        tuhanorder.money6,
        tuhanorder.money7,
        tuhanorder.money8,
        tuhanorder.datatxt0125,
        tuhanorder.datatxt0129,
        soukosyukko.orderbango,
        soukosyukko.hanbaibukacd,
        soukosyukko.kawasename,
        soukosyukko.syouhinname,
        soukosyukko.syukkasu,
        soukosyukko.datachar02,
        soukosyukko.datachar03,
        soukosyukko.datachar04,
        CASE
            WHEN soukosyukko.dataint09 is null THEN NULL
            ELSE concat(substring(soukosyukko.dataint09::text,1,4),'/',substring(soukosyukko.dataint09::text,5,2),'/',substring(soukosyukko.dataint09::text,7,2)) 
            END as dataint09,
        CASE
            WHEN soukosyukko.dataint10 is null THEN NULL
            ELSE concat(substring(soukosyukko.dataint10::text,1,4),'/',substring(soukosyukko.dataint10::text,5,2),'/',substring(soukosyukko.dataint10::text,7,2)) 
            END as dataint10,
        soukosyukko.datachar05 as soukosyukko_datachar05,
        datachar05Torihikisaki.r17_3cd as datachar05_detail,
        soukosyukko.datachar06,
        datachar06Torihikisaki.r17_3cd as datachar06_detail,
        soukosyukko.datachar07 as soukosyukko_datachar07,
        soukosyukko.datachar08,
        soukosyukko.datachar09,
        soukosyukko.syouhinbango,
        soukosyukko.yoteisu,
        soukosyukko.datachar29,
        soukosyukko.genka,
        soukosyukko.season,
        soukosyukko.syouhinid,
        --temp_soukosyukko.count_syouhinid,
        soukosyukko.syouhizeiritu,
        soukosyukko.syukkomotobango,
        soukosyukko.syukkameter,
        soukosyukko.zaikometer,
        soukosyukko.seikyubango,
        soukosyukko.denpyobango,
        replace(substring(soukosyukko.kanryoubi::text,1,10),'-','/') as kanryoubi,
        soukosyukko.soukobango,
        soukosyukko.denpyoshimebi,
        soukosyukko.syouhinbukacd,
        syouhin1.data100,
        syouhin1.data52,
        hikiatesyukko.datachar26, 
        hikiatesyukko.datachar27,
        soukonyuko.datachar09 as soukonyuko_datachar09,
        CASE 
            WHEN soukonyuko.datachar09 is null THEN NULL
            WHEN LENGTH(SPLIT_PART(soukonyuko.datachar09::text,'¶',1))>10 THEN concat(substring(SPLIT_PART(soukonyuko.datachar09::text,'¶',1),1,10),'...',SPLIT_PART(soukonyuko.datachar09::text,'.',2))
            ELSE concat(SPLIT_PART(soukonyuko.datachar09::text,'¶',1),'.',SPLIT_PART(soukonyuko.datachar09::text,'.',2))
            END as datachar09_detail,
        juchusyukko.datachar24 as juchusyukko_datachar24,
        datachar24Request.jouhou as juchusyukko_dtchar24_detail,
        juchusyukko.datachar25 as juchusyukko_datachar25,
        datachar25Request.jouhou as juchusyukko_dtchar25_detail,
        juchusyukko.datachar26 as juchusyukko_datachar26,
        datachar26Request.jouhou as juchusyukko_dtchar26_detail,
        (select category4 from categorykanri where category1 = 'J3' and category2='10') as contract_status_10,
        (select category4 from categorykanri where category1 = 'J3' and category2='20') as contract_status_20,
        (select category4 from categorykanri where category1 = 'J3' and category2='30') as contract_status_30,
        (select COUNT(syouhinbango) from soukosyukko where hanbaibukacd = '$contract_number') as count_syouhinbango, 
        (select COUNT(syouhinid) from soukosyukko where hanbaibukacd = '$contract_number' and syouhinid IS NOT NULL) as count_syouhinid 

        from soukosyukko
        
        --left join temp_soukosyukko on temp_soukosyukko.orderbango = soukosyukko.orderbango 
        --AND temp_soukosyukko.hanbaibukacd = soukosyukko.hanbaibukacd
        
        left join juchusyukko on juchusyukko.orderbango = soukosyukko.orderbango 
        AND juchusyukko.hanbaibukacd = soukosyukko.hanbaibukacd
        AND juchusyukko.dataint18 = soukosyukko.syouhinbango
        AND juchusyukko.dataint19 = soukosyukko.yoteisu
        
        left join orderhenkan on orderhenkan.bango = soukosyukko.orderbango 
        AND orderhenkan.datachar07 = soukosyukko.hanbaibukacd
        
        left join tuhanorder on tuhanorder.orderbango = soukosyukko.orderbango 
        AND tuhanorder.datatxt0110 = soukosyukko.hanbaibukacd
        
        left join hikiatesyukko on hikiatesyukko.orderbango = soukosyukko.orderbango 
        AND hikiatesyukko.hanbaibukacd = soukosyukko.hanbaibukacd
        
        left join soukonyuko on soukonyuko.orderbango  = orderhenkan.bango
        AND soukonyuko.datachar01 = tuhanorder.datatxt0115
        
        left join syouhin1 on syouhin1.kokyakusyouhinbango  = soukosyukko.kawasename
        
        left join request as datachar24Request on datachar24Request.syouhinbango = juchusyukko.datachar24::int
        AND datachar24Request.color = '0302受注データ作成フラグ'
        
        left join request as datachar25Request on datachar25Request.syouhinbango = juchusyukko.datachar25::int
        AND datachar25Request.color = '0302伝票作成フラグ'
        
        left join request as datachar26Request on datachar26Request.syouhinbango = juchusyukko.datachar26::int
        AND datachar26Request.color = '0302伝票作成フラグ'
        
        left join categorykanri as categorykanriDatatxt0122
        on substring(tuhanorder.datatxt0122,1,2) = categorykanriDatatxt0122.category1
        and substring(tuhanorder.datatxt0122,3,4) = categorykanriDatatxt0122.category2
        
        --information1
        left join v_torihikisaki as information1Torihikisaki on
        information1Torihikisaki.torihikisaki_cd = tuhanorder.information1
        --information1 end
        
        --information2
        left join v_torihikisaki as information2Torihikisaki on
        information2Torihikisaki.torihikisaki_cd = tuhanorder.information2
        --information2 end
        
        --information3
        left join v_torihikisaki as information3Torihikisaki on
        information3Torihikisaki.torihikisaki_cd = tuhanorder.information3
        --information3 end
        
        --information6
        left join v_torihikisaki as information6Torihikisaki on
        information6Torihikisaki.torihikisaki_cd = tuhanorder.information6
        --information6 end
        
        --datatxt0124
        left join v_torihikisaki as datatxt0124Torihikisaki on
        datatxt0124Torihikisaki.torihikisaki_cd = tuhanorder.datatxt0124
        --datatxt0124 end
        
        --datatxt0123
        left join v_torihikisaki as datatxt0123Torihikisaki on
        datatxt0123Torihikisaki.torihikisaki_cd = tuhanorder.datatxt0123
        --datatxt0123 end
        
        --datachar05
        left join v_torihikisaki as datachar05Torihikisaki on
        datachar05Torihikisaki.torihikisaki_cd = soukosyukko.datachar05
        --datachar05 end
        
        --datachar06
        left join v_torihikisaki as datachar06Torihikisaki on
        datachar06Torihikisaki.torihikisaki_cd = soukosyukko.datachar06
        --datachar06 end
        
        order by soukosyukko.syouhinbango,soukosyukko.yoteisu asc");

        $data=DB::table('flat_rate_entry')->whereRaw("datachar07= '$contract_number'" . " AND datatxt0122='J310'");

        return $data;
        
    }
}
