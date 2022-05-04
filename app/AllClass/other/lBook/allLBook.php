<?php

namespace App\AllClass\other\lBook;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\kengen;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class allLBook{
    public static function data($bango,$deleted_item=2,$fsearch_bangos=null,$req_data=null,$first_search_result=null){
        if(!empty($fsearch_bangos)){
            $bango = implode(',', $fsearch_bangos);
        }elseif($first_search_result == "no_data"){
            $bango = 0;
        }else{
            $bango = 0;
        }
        if($fsearch_bangos!=null){
            $sql = " where soukonyuko.datachar01::bigint IN ($bango)";
        }elseif($first_search_result == "no_data"){
            $sql = " where soukonyuko.datachar01::bigint IN ($bango)";
        }else{
            $sql = "";
            if(isset($req_data['created_date_start']) && ($req_data['created_date_start']!="" && $req_data['created_date_end']!="")){
                $start_date = str_replace("/","",$req_data['created_date_start']).'000000';
                $end_date = str_replace("/","",$req_data['created_date_end']).'246060';
                //$sql .= " where substring(soukonyuko.datachar11,0,8)::text between '$start_date' and '$end_date' ";
                $sql .= " where soukonyuko.datachar11 between '$start_date' and '$end_date' ";
            }
            
            if(isset($req_data['datachar05_start']) && ($req_data['datachar05_start']!="" && $req_data['datachar05_end']!="")){
                $datachar05_start = $req_data['datachar05_start'];
                $datachar05_end = $req_data['datachar05_end'];
                if(strlen($sql)>0){
                    $sql .= "AND soukonyuko.datachar05 >= '$datachar05_start' and soukonyuko.datachar05 <= '$datachar05_end' ";
                }else{
                    $sql .= "where soukonyuko.datachar05 >= '$datachar05_start' and soukonyuko.datachar05 <= '$datachar05_end' ";
                }
            }
            
        }

        QueryHelper::runQuery("DROP TABLE IF EXISTS l_book_temp");

        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE l_book_temp as
        select distinct
        soukonyuko.datachar01::bigint,
        soukonyuko.datachar02,
        datachar02Torihikisaki.r17_3cd as datachar02_text,
        datachar02Torihikisaki.r17_4 as datachar02_detail,
        --concat_ws('／',substring(kokyaku1DtChar2.address,1,5),substring(haisouDtChar2.haisoumoji1,1,3),substring(etsuransyaDtChar2.mail4,1,3)) as datachar02_detail,
        soukonyuko.datachar03,
        datachar03Torihikisaki.r17_3cd as datachar03_text,
        datachar03Torihikisaki.r17_4 as datachar03_detail,
        soukonyuko.datachar04,
        datachar04Torihikisaki.r17_3cd as datachar04_text,
        datachar04Torihikisaki.r17_4 as datachar04_detail,
        soukonyuko.datachar05 as lbook_datachar05,
        soukonyuko.datachar06,
        tantousyaDtchar6.name as datachar06_detail,
        replace(replace(tantousyaDtchar6.name,' ',''),'　','') as datachar06_search,
        substring(replace(replace(tantousyaDtchar6.name,' ',''),'　',''),1,3) as datachar06_short,
        soukonyuko.datachar07,
        CASE
            WHEN trim(soukonyuko.datachar07) is null THEN NULL
            ELSE concat_ws(' ',categorykanriDtchar7.category2,categorykanriDtchar7.category4) END as datachar07_detail,
        soukonyuko.datachar08,
        CASE
            WHEN LENGTH(soukonyuko.datachar08)>11 THEN concat(substring(soukonyuko.datachar08,1,10),'...')
            ELSE soukonyuko.datachar08 END as datachar08_short,
        soukonyuko.datachar09,
        CASE 
            WHEN strpos(soukonyuko.datachar09::text,'¶')<1 THEN soukonyuko.datachar09
            WHEN LENGTH(SPLIT_PART(soukonyuko.datachar09::text,'¶',1))>11 THEN concat(substring(SPLIT_PART(soukonyuko.datachar09::text,'¶',1),1,10),'...',SPLIT_PART(soukonyuko.datachar09::text,'.',2))
            ELSE concat(SPLIT_PART(soukonyuko.datachar09::text,'¶',1),'.',SPLIT_PART(soukonyuko.datachar09::text,'.',2))
            END as datachar09_short,
        soukonyuko.datachar10,
        CASE
            WHEN trim(soukonyuko.datachar10) is null THEN NULL
            ELSE concat_ws(' ',categorykanriDtchar10.category2,categorykanriDtchar10.category4) END as datachar10_detail,
        soukonyuko.dataint25,
        CASE
            WHEN soukonyuko.datachar11::text is null THEN NULL
            ELSE concat_ws('/',substring(soukonyuko.datachar11::text,1,4),
            substring(soukonyuko.datachar11::text,5,2),
            substring(soukonyuko.datachar11::text,7,2)) END as datachar11 ,
        CASE
            WHEN soukonyuko.datachar11 is null THEN NULL
            ELSE concat_ws('/',substring(soukonyuko.datachar11,1,4),
            substring(soukonyuko.datachar11,5,2),
            substring(soukonyuko.datachar11,7,2)) END as created_date ,

        CASE
            WHEN soukonyuko.datachar11 is null THEN NULL
            ELSE concat_ws(':',substring(soukonyuko.datachar11,9,2),
            substring(soukonyuko.datachar11,11,2),
            substring(soukonyuko.datachar11,13,2)) END as created_time,
        soukonyuko.datachar12,
        CASE
            WHEN soukonyuko.datachar12 is null THEN NULL
            ELSE concat_ws('/',substring(soukonyuko.datachar12,1,4),
            substring(soukonyuko.datachar12,5,2),
            substring(soukonyuko.datachar12,7,2)) END as edited_date,

        CASE
            WHEN soukonyuko.datachar12 is null THEN NULL
            ELSE concat_ws(':',substring(soukonyuko.datachar12,9,2),
            substring(soukonyuko.datachar12,11,2),
            substring(soukonyuko.datachar12,13,2)) END as edited_time,
        CASE
            WHEN orderhenkan.intorder01 is null THEN NULL
            ELSE concat_ws('/',substring(orderhenkan.intorder01::text,1,4),
            substring(orderhenkan.intorder01::text,5,2),
            substring(orderhenkan.intorder01::text,7,2)) END as intorder01_date ,
        --tuhanorder.juchukubun1 as juchukubun1,
        v_orderinfo.juchukubun1 as juchukubun1,
        v_orderinfo.r15 as juchukubun1_short,
        tantousya.name as user_name
        
        from soukonyuko

        left join orderhenkan on orderhenkan.kokyakuorderbango = soukonyuko.datachar05
        
        left join tuhanorder on tuhanorder.orderbango = orderhenkan.bango
        
        left join tantousya on tantousya.bango = soukonyuko.datachar13
        
        left join tantousya as tantousyaDtchar6 on tantousyaDtchar6.bango = soukonyuko.datachar06
        
        left join v_orderinfo on v_orderinfo.bango = tuhanorder.orderbango
        AND v_orderinfo.juchubango = tuhanorder.juchubango
        
        left join categorykanri as categorykanriDtchar7
        on substring(soukonyuko.datachar07,1,2) = categorykanriDtchar7.category1
        and substring(soukonyuko.datachar07,3,5) = categorykanriDtchar7.category2
        
        left join categorykanri as categorykanriDtchar10
        on substring(soukonyuko.datachar10,1,2) = categorykanriDtchar10.category1
        and substring(soukonyuko.datachar10,3,5) = categorykanriDtchar10.category2

        --datachar02
        left join v_torihikisaki as datachar02Torihikisaki on
        datachar02Torihikisaki.torihikisaki_cd = soukonyuko.datachar02
        --datachar02 end
        
        --datachar03
        left join v_torihikisaki as datachar03Torihikisaki on
        datachar03Torihikisaki.torihikisaki_cd = soukonyuko.datachar03
        --datachar03 end
        
        --datachar04
        left join v_torihikisaki as datachar04Torihikisaki on
        datachar04Torihikisaki.torihikisaki_cd = soukonyuko.datachar04
        --datachar04 end
        
        $sql

        ORDER BY datachar01 ");


        if(isset($deleted_item) && $deleted_item==1){
            $data=DB::table('l_book_temp')->whereRaw('dataint25 = ' . 1);
        }else{
            $data=DB::table('l_book_temp')->whereRaw('dataint25 = ' . 0);
        }

        return $data;
        
    }
}
