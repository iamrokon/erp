<?php

namespace App\AllClass\flatRateContract\createOrder;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\kengen;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class AllCreateOrder{
    public static function data($bango,$request=null){
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS temp_soukosyukko");
        
        QueryHelper::runQuery("CREATE TEMPORARY TABLE temp_soukosyukko as
        select 
        orderbango,hanbaibukacd,count(yoteisu) as count_yoteisu
        from soukosyukko
        where yoteisu>0
        group by hanbaibukacd,orderbango");
        
        $sql = "";

        $start_date = $request['kanryoubi_start'];
        $end_date = $request['kanryoubi_end'];
        
        $start_information2 = $request['db_information2_start'];
        $end_information2 = $request['db_information2_end'];

        if(isset($request['division_datachar05_start']) && ($request['division_datachar05_start']!="" && $request['division_datachar05_end']!="")){
            if(strlen($sql)>0){ 
                $division_start_date = @end(explode('B9',$request['division_datachar05_start']));
                $division_end_date = @end(explode('B9',$request['division_datachar05_end']));
                $sql .= "AND substring(tantousya.datatxt0003::text,1,2)='B9' AND SPLIT_PART(tantousya.datatxt0003::text,'B9',2) between '$division_start_date' and '$division_end_date' ";
            }else{
                $division_start_date = @end(explode('B9',$request['division_datachar05_start']));
                $division_end_date = @end(explode('B9',$request['division_datachar05_end']));
                $sql .= " where substring(tantousya.datatxt0003::text,1,2)='B9' AND SPLIT_PART(tantousya.datatxt0003::text,'B9',2) between '$division_start_date' and '$division_end_date' ";
            }
        }

        if(isset($request['department_datachar05_start']) && ($request['department_datachar05_start']!="" && $request['department_datachar05_end']!="")){
            if(strlen($sql)>0){
                $department_start_date = @end(explode('C1',$request['department_datachar05_start']));
                $department_end_date = @end(explode('C1',$request['department_datachar05_end']));
                $sql .= "AND substring(tantousya.datatxt0004::text,1,2)='C1' AND SPLIT_PART(tantousya.datatxt0004::text,'C1',2) between '$department_start_date' and '$department_end_date' ";
            }else{
                $department_start_date = @end(explode('C1',$request['department_datachar05_start']));
                $department_end_date = @end(explode('C1',$request['department_datachar05_end']));
                $sql .= " where substring(tantousya.datatxt0004::text,1,2)='C1' AND SPLIT_PART(tantousya.datatxt0004::text,'C1',2) between '$department_start_date' and '$department_end_date' ";
            }
        }

        if(isset($request['group_datachar05_start']) && ($request['group_datachar05_start']!="" && $request['group_datachar05_end']!="")){
            if(strlen($sql)>0){
                $group_start_date = @end(explode('C2',$request['group_datachar05_start']));
                $group_end_date = @end(explode('C2',$request['group_datachar05_end']));
                $sql .= "AND substring(tantousya.datatxt0005::text,1,2)='C2' AND SPLIT_PART(tantousya.datatxt0005::text,'C2',2) between '$group_start_date' and '$group_end_date' ";
            }else{
                $group_start_date = @end(explode('C2',$request['group_datachar05_start']));
                $group_end_date = @end(explode('C2',$request['group_datachar05_end']));
                $sql .= " where substring(tantousya.datatxt0005::text,1,2)='C2' AND SPLIT_PART(tantousya.datatxt0005::text,'C2',2) between '$group_start_date' and '$group_end_date' ";
            }
        }

        QueryHelper::runQuery("DROP TABLE IF EXISTS create_order");
        
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE create_order as
        select distinct
        orderhenkan.bango,
        orderhenkan.datachar07,
        orderhenkan.datachar05,
        orderhenkan.intorder01,
        tuhanorder.datatxt0109,
        tuhanorder.datatxt0110,
        tuhanorder.numeric5,
        tuhanorder.datatxt0111,
        tuhanorder.datatxt0112,
        tuhanorder.datatxt0113,
        tuhanorder.numeric6,
        tuhanorder.numeric7,
        tuhanorder.information1,
        concat_ws('／',kokyaku1Information1.address,haisouInformation1.haisoumoji1,etsuransyaInformation1.mail4) as information1_detail,
        tuhanorder.information2,
        concat_ws('／',kokyaku1Information2.address,haisouInformation2.haisoumoji1,etsuransyaInformation2.mail4) as information2_detail,
        tuhanorder.information3,
        concat_ws('／',kokyaku1Information3.address,haisouInformation3.haisoumoji1,etsuransyaInformation3.mail4) as information3_detail,
        tuhanorder.information6,
        concat_ws('／',kokyaku1Information6.address,haisouInformation6.haisoumoji1,etsuransyaInformation6.mail4) as information6_detail,
        tuhanorder.information8,
        tuhanorder.datatxt0114,
        tuhanorder.datatxt0115,
        tuhanorder.kessaihouhou,
        tuhanorder.datatxt0116,
        tuhanorder.datatxt0117,
        tuhanorder.housoukubun,
        tuhanorder.otodoketime,
        tuhanorder.date0001,
        tuhanorder.datatxt0118,
        tuhanorder.datatxt0119,
        tuhanorder.datatxt0124,
        concat_ws('／',kokyaku1Datatxt0124.address,haisouDatatxt0124.haisoumoji1,etsuransyaDatatxt0124.mail4) as datatxt0124_detail,
        tuhanorder.numericmax,
        tuhanorder.datatxt0123,
        concat_ws('／',kokyaku1Datatxt0123.address,haisouDatatxt0123.haisoumoji1,etsuransyaDatatxt0123.mail4) as datatxt0123_detail,
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
        soukosyukko.kaiinid,
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
        concat_ws('／',kokyaku1Datachar05.address,haisouDatachar05.haisoumoji1,etsuransyaDatachar05.mail4) as datachar05_detail,
        soukosyukko.datachar06,
        concat_ws('／',kokyaku1Datachar06.address,haisouDatachar06.haisoumoji1,etsuransyaDatachar06.mail4) as datachar06_detail,
        soukosyukko.datachar07 as soukosyukko_datachar07,
        soukosyukko.datachar08,
        soukosyukko.datachar09,
        soukosyukko.syouhinbango,
        soukosyukko.yoteisu,
        temp_soukosyukko.count_yoteisu,
        soukosyukko.datachar29,
        soukosyukko.genka,
        soukosyukko.season,
        soukosyukko.syouhinid,
        soukosyukko.syouhizeiritu,
        soukosyukko.syukkomotobango,
        soukosyukko.syukkosakibango,
        soukosyukko.syukkosoukobango,
        soukosyukko.syukkameter,
        soukosyukko.zaikometer,
        soukosyukko.codename,
        soukosyukko.seikyubango,
        soukosyukko.denpyobango,
        replace(substring(soukosyukko.kanryoubi::text,1,10),'-','/') as kanryoubi,
        soukosyukko.soukobango,
        soukosyukko.denpyoshimebi,
        soukosyukko.syouhinbukacd,
        hikiatesyukko.datachar26, 
        hikiatesyukko.datachar27,
        soukonyuko.datachar09 as soukonyuko_datachar09,
        CASE 
            WHEN soukonyuko.datachar09 is null THEN NULL
            ELSE concat(SPLIT_PART(soukonyuko.datachar09::text,'¶',1),'.',SPLIT_PART(soukonyuko.datachar09::text,'.',2))
            END as datachar09_detail,
        juchusyukko.datachar24,
        juchusyukko.dataint18,
        juchusyukko.dataint19

        from soukosyukko
        
        left join temp_soukosyukko on temp_soukosyukko.orderbango = soukosyukko.orderbango 
        AND temp_soukosyukko.hanbaibukacd = soukosyukko.hanbaibukacd
        
        left join orderhenkan on orderhenkan.bango = soukosyukko.orderbango 
        AND orderhenkan.datachar07 = soukosyukko.hanbaibukacd
        
        left join juchusyukko on juchusyukko.orderbango = soukosyukko.orderbango 
        AND juchusyukko.hanbaibukacd = soukosyukko.hanbaibukacd
        AND juchusyukko.dataint18 = soukosyukko.syouhinbango
        AND juchusyukko.dataint19 = soukosyukko.yoteisu
        
        left join tantousya on orderhenkan.datachar05 = tantousya.bango
        
        left join tuhanorder on tuhanorder.orderbango = soukosyukko.orderbango 
        AND tuhanorder.datatxt0110 = soukosyukko.hanbaibukacd
        
        left join hikiatesyukko on hikiatesyukko.orderbango = soukosyukko.orderbango 
        AND hikiatesyukko.hanbaibukacd = soukosyukko.hanbaibukacd
        
        left join soukonyuko on soukonyuko.orderbango  = orderhenkan.bango
        AND soukonyuko.datachar01 = tuhanorder.datatxt0115
        
        left join categorykanri as categorykanriDatatxt0122
        on substring(tuhanorder.datatxt0122,1,2) = categorykanriDatatxt0122.category1
        and substring(tuhanorder.datatxt0122,3,4) = categorykanriDatatxt0122.category2
        
        --information1
        left join kokyaku1 as kokyaku1Information1
        on substring(tuhanorder.information1,1,6) = kokyaku1Information1.yobi12
        
        left join haisou as haisouInformation1
        on substring(tuhanorder.information1,7,2) = haisouInformation1.torihikisakibango
        and kokyaku1Information1.bango = haisouInformation1.kokyakubango
        
        left join etsuransya as etsuransyaInformation1
        on substring(tuhanorder.information1,9,3) = etsuransyaInformation1.datatxt0049
        and haisouInformation1.bango::text = etsuransyaInformation1.datanum0018::text
        --information1 end
        
        --information2
        left join kokyaku1 as kokyaku1Information2
        on substring(tuhanorder.information2,1,6) = kokyaku1Information2.yobi12
        
        left join haisou as haisouInformation2
        on substring(tuhanorder.information2,7,2) = haisouInformation2.torihikisakibango
        and kokyaku1Information2.bango = haisouInformation2.kokyakubango
        
        left join etsuransya as etsuransyaInformation2
        on substring(tuhanorder.information2,9,3) = etsuransyaInformation2.datatxt0049
        and haisouInformation2.bango::text = etsuransyaInformation2.datanum0018::text
        --information2 end
        
        --information3
        left join kokyaku1 as kokyaku1Information3
        on substring(tuhanorder.information3,1,6) = kokyaku1Information3.yobi12
        
        left join haisou as haisouInformation3
        on substring(tuhanorder.information3,7,2) = haisouInformation3.torihikisakibango
        and kokyaku1Information3.bango = haisouInformation3.kokyakubango
        
        left join etsuransya as etsuransyaInformation3
        on substring(tuhanorder.information3,9,3) = etsuransyaInformation3.datatxt0049
        and haisouInformation3.bango::text = etsuransyaInformation3.datanum0018::text
        --information3 end
        
        --information6
        left join kokyaku1 as kokyaku1Information6
        on substring(tuhanorder.information6,1,6) = kokyaku1Information6.yobi12
        
        left join haisou as haisouInformation6
        on substring(tuhanorder.information6,7,2) = haisouInformation6.torihikisakibango
        and kokyaku1Information6.bango = haisouInformation6.kokyakubango
        
        left join etsuransya as etsuransyaInformation6
        on substring(tuhanorder.information6,9,3) = etsuransyaInformation6.datatxt0049
        and haisouInformation6.bango::text = etsuransyaInformation6.datanum0018::text
        --information6 end
        
        --datatxt0124
        left join kokyaku1 as kokyaku1Datatxt0124
        on substring(tuhanorder.datatxt0124,1,6) = kokyaku1Datatxt0124.yobi12
        
        left join haisou as haisouDatatxt0124
        on substring(tuhanorder.datatxt0124,7,2) = haisouDatatxt0124.torihikisakibango
        and kokyaku1Datatxt0124.bango = haisouDatatxt0124.kokyakubango
        
        left join etsuransya as etsuransyaDatatxt0124
        on substring(tuhanorder.datatxt0124,9,3) = etsuransyaDatatxt0124.datatxt0049
        and haisouDatatxt0124.bango::text = etsuransyaDatatxt0124.datanum0018::text
        --datatxt0124 end
        
        --datatxt0123
        left join kokyaku1 as kokyaku1Datatxt0123
        on substring(tuhanorder.datatxt0123,1,6) = kokyaku1Datatxt0123.yobi12
        
        left join haisou as haisouDatatxt0123
        on substring(tuhanorder.datatxt0123,7,2) = haisouDatatxt0123.torihikisakibango
        and kokyaku1Datatxt0123.bango = haisouDatatxt0123.kokyakubango
        
        left join etsuransya as etsuransyaDatatxt0123
        on substring(tuhanorder.datatxt0123,9,3) = etsuransyaDatatxt0123.datatxt0049
        and haisouDatatxt0123.bango::text = etsuransyaDatatxt0123.datanum0018::text
        --datatxt0123 end
        
        --datachar05
        left join kokyaku1 as kokyaku1Datachar05
        on substring(soukosyukko.datachar05,1,6) = kokyaku1Datachar05.yobi12
        
        left join haisou as haisouDatachar05
        on substring(soukosyukko.datachar05,7,2) = haisouDatachar05.torihikisakibango
        and kokyaku1Datachar05.bango = haisouDatachar05.kokyakubango
        
        left join etsuransya as etsuransyaDatachar05
        on substring(soukosyukko.datachar05,9,3) = etsuransyaDatachar05.datatxt0049
        and haisouDatachar05.bango::text = etsuransyaDatachar05.datanum0018::text
        --datachar05 end
        
        --datachar06
        left join kokyaku1 as kokyaku1Datachar06
        on substring(soukosyukko.datachar06,1,6) = kokyaku1Datachar06.yobi12
        
        left join haisou as haisouDatachar06
        on substring(soukosyukko.datachar06,7,2) = haisouDatachar06.torihikisakibango
        and kokyaku1Datachar06.bango = haisouDatachar06.kokyakubango
        
        left join etsuransya as etsuransyaDatachar06
        on substring(soukosyukko.datachar06,9,3) = etsuransyaDatachar06.datatxt0049
        and haisouDatachar06.bango::text = etsuransyaDatachar06.datanum0018::text
        --datachar06 end
        
        $sql
        
        --order by soukosyukko.hanbaibukacd,soukosyukko.syouhinbango asc
        order by soukosyukko.hanbaibukacd,date0004,syouhinbango asc 

        ");

        if($start_information2 != "" && $end_information2 != ""){
            $data=DB::table('create_order')->whereRaw("kanryoubi >= '$start_date'  AND kanryoubi <= '$end_date'" . " AND substring(information2,1,8) >= '$start_information2'  AND substring(information2,1,8) <= '$end_information2'" . " AND datatxt0122='J310'" . " AND datatxt0125 IS NULL" . " AND datachar24 = '2'");
        }else{
            $data=DB::table('create_order')->whereRaw("kanryoubi >= '$start_date'  AND kanryoubi <= '$end_date'" . " AND datatxt0122='J310'" . " AND datatxt0125 IS NULL" . " AND datachar24 = '2'");
        }

        return $data;
        
    }
}
