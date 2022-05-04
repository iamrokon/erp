<?php

namespace App\AllClass\sales\salesHistory;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\kengen;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Str;

Class allSalesHistory{
    public static function data($logged_in_bango,$deleted_item=2,$color_array=null,$fsearch_bangos=null,$req_data=null,$first_search_result=null)
    {
        QueryHelper::runQuery("DROP TABLE IF EXISTS sales_history_temp");
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_m");
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_delete_check");
        QueryHelper::runQuery("DROP TABLE IF EXISTS v_orderhenkan_temp");
        QueryHelper::runQuery("DROP TABLE IF EXISTS before_sales_history_temp");

        /*QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_m as
            select distinct
            kokyakuorderbango, max(ordertypebango2) as maxval
            from orderhenkan
            where synchroorderbango = 0
            group by kokyakuorderbango");*/

        //deleted kokyakuorderbango
        /*QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_delete_check as
        select
        kokyakuorderbango
        from orderhenkan
        where synchroorderbango = 1
        ");
*/
        $sql = "";

        if(!empty($fsearch_bangos)){
            $bango = implode(',', $fsearch_bangos);
        }elseif($first_search_result == "no_data"){
            $bango = 0;
        }else{
            $bango = 0;
        }

        if($fsearch_bangos!=null){
            $sql = " where v_orderhenkan.bango IN ($bango)";
        }elseif($first_search_result == "no_data"){
            $sql = " where v_orderhenkan.bango IN ($bango)";
        }else{

            if(isset($req_data['division_datachar05_start']) && ($req_data['division_datachar05_start']!="" && $req_data['division_datachar05_end']!="")){
                if(strlen($sql)>0){
                    $division_start_date = @end(explode('B9',$req_data['division_datachar05_start']));
                    $division_end_date = @end(explode('B9',$req_data['division_datachar05_end']));
                    $sql .= "AND substring(v_orderhenkan.datatxt0003::text,1,2)='B9' AND SPLIT_PART(v_orderhenkan.datatxt0003::text,'B9',2) between '$division_start_date' and '$division_end_date' ";
                }else{
                    $division_start_date = @end(explode('B9',$req_data['division_datachar05_start']));
                    $division_end_date = @end(explode('B9',$req_data['division_datachar05_end']));
                    $sql .= " where substring(v_orderhenkan.datatxt0003::text,1,2)='B9' AND SPLIT_PART(v_orderhenkan.datatxt0003::text,'B9',2) between '$division_start_date' and '$division_end_date' ";
                }
            }

            if(isset($req_data['date_start']) && ($req_data['date_start']!="" && $req_data['date_end']!="")){
                $start_date = str_replace('/','-',$req_data['date_start']);
                $end_date = str_replace('/','-',$req_data['date_end']);
                $sql .= " and substring(v_orderhenkan.date::text,1,10) between '$start_date' and '$end_date' ";
            }
            if(isset($req_data['intorder03_start']) && ($req_data['intorder03_start']!="" && $req_data['intorder03_end']!="")){
                $start_date = str_replace('/','',$req_data['intorder03_start']);
                $end_date = str_replace('/','',$req_data['intorder03_end']);
                $sql .= " and v_orderhenkan.intorder03::text between '$start_date' and '$end_date' ";
            }

            if(isset($req_data['juchukubun_start']) && ($req_data['juchukubun_start']!="" && $req_data['juchukubun_end']!="")){
                $start_value = $req_data['juchukubun_start'];
                $end_value = $req_data['juchukubun_end'];
                $sql .= " and tuhanorder.juchukubun2 between '$start_value' and '$end_value' ";
            }

            if(isset($req_data['department_datachar05_start']) && ($req_data['department_datachar05_start']!="" && $req_data['department_datachar05_end']!="")){
                if(strlen($sql)>0){
                    $department_start_date = @end(explode('C1',$req_data['department_datachar05_start']));
                    $department_end_date = @end(explode('C1',$req_data['department_datachar05_end']));
                    $sql .= "AND substring(v_orderhenkan.datatxt0004::text,1,2)='C1' AND SPLIT_PART(v_orderhenkan.datatxt0004::text,'C1',2) between '$department_start_date' and '$department_end_date' ";
                }else{
                    $department_start_date = @end(explode('C1',$req_data['department_datachar05_start']));
                    $department_end_date = @end(explode('C1',$req_data['department_datachar05_end']));
                    $sql .= " where substring(v_orderhenkan.datatxt0004::text,1,2)='C1' AND SPLIT_PART(v_orderhenkan.datatxt0004::text,'C1',2) between '$department_start_date' and '$department_end_date' ";
                }
            }

            if(isset($req_data['group_datachar05_start']) && ($req_data['group_datachar05_start']!="" && $req_data['group_datachar05_end']!="")){
                if(strlen($sql)>0){
                    $group_start_date = @end(explode('C2',$req_data['group_datachar05_start']));
                    $group_end_date = @end(explode('C2',$req_data['group_datachar05_end']));
                    $sql .= "AND substring(v_orderhenkan.datatxt0005::text,1,2)='C2' AND SPLIT_PART(v_orderhenkan.datatxt0005::text,'C2',2) between '$group_start_date' and '$group_end_date' ";
                }else{
                    $group_start_date = @end(explode('C2',$req_data['group_datachar05_start']));
                    $group_end_date = @end(explode('C2',$req_data['group_datachar05_end']));
                    $sql .= " where substring(v_orderhenkan.datatxt0005::text,1,2)='C2' AND SPLIT_PART(v_orderhenkan.datatxt0005::text,'C2',2) between '$group_start_date' and '$group_end_date' ";
                }
            }
            if(isset($req_data['text1']) && ($req_data['text1']!="")){
                if(strlen($sql)>0){
                    $text1 = $req_data['text1'];
                    $sql .= "AND tuhanorder.text1='$text1' ";
                }else{
                    $text1 = $req_data['text1'];
                    $sql .= " where tuhanorder.text1='$text1' ";
                }
            }
            $sql .= Str::contains($sql, 'where') ? ' and ' : ' where ';
            $sql .= " tuhanorder.unsoudaibikitesuryou = 1 ";
        }

        if($color_array){
            $fields = "";
            $i = 1;
            foreach($color_array as $dataint=>$color)
            {
                if($dataint == "dataint01_val"){
                    $fields .= "(select CONCAT(syouhinbango,' ',jouhou) from request where color='$color' and syouhinbango=hikiatesyukko.dataint01 LIMIT 1) as dataint01_val,";
                }elseif ($dataint == "dataint02_val") {
                    $fields .= "(select CONCAT(syouhinbango,' ',jouhou) from request where color='$color' and syouhinbango=hikiatesyukko.dataint02 LIMIT 1) as dataint02_val,";
                }elseif ($dataint == "dataint03_val") {
                    $fields .= "(select CONCAT(syouhinbango,' ',jouhou) from request where color='$color' and syouhinbango=hikiatesyukko.dataint03 LIMIT 1) as dataint03_val,";
                }elseif ($dataint == "dataint04_val") {
                    $fields .= "(select CONCAT(syouhinbango,' ',jouhou) from request where color='$color' and syouhinbango=hikiatesyukko.dataint04 LIMIT 1) as dataint04_val,";
                }elseif ($dataint == "dataint05_val") {
                    $fields .= "(select CONCAT(syouhinbango,' ',jouhou) from request where color='$color' and syouhinbango=hikiatesyukko.dataint05 LIMIT 1) as dataint05_val,";
                }elseif ($dataint == "dataint06_val") {
                    $fields .= "(select CONCAT(syouhinbango,' ',jouhou) from request where color='$color' and syouhinbango=hikiatesyukko.dataint06 LIMIT 1) as dataint06_val,";
                }elseif ($dataint == "dataint07_val") {
                    $fields .= "(select CONCAT(syouhinbango,' ',jouhou) from request where color='$color' and syouhinbango=hikiatesyukko.dataint07 LIMIT 1) as dataint07_val,";
                }elseif ($dataint == "dataint08_val") {
                    $fields .= "(select CONCAT(syouhinbango,' ',jouhou) from request where color='$color' and syouhinbango=hikiatesyukko.dataint08 LIMIT 1) as dataint08_val,";
                }elseif ($dataint == "dataint09_val") {
                    $fields .= "(select CONCAT(syouhinbango,' ',jouhou) from request where color='$color' and syouhinbango=hikiatesyukko.dataint09 LIMIT 1) as dataint09_val,";
                }
                $i++;
            }
            $fields .= "(select CONCAT(syouhinbango,' ',jouhou) from request where color='0802即時区分' and syouhinbango::text=tuhanorder.housoukubun LIMIT 1) as housoukubun_val,";
        }

        QueryHelper::runQuery("CREATE TEMPORARY TABLE v_orderhenkan_temp as
            select distinct
            v_orderhenkan.*,
            tuhanorder.kessaihouhou,
            tuhanorder.information6,
            tuhanorder.information7,
            tuhanorder.information8,
            tuhanorder.juchukubun2,
            tuhanorder.juchukubun1,
            tuhanorder.numeric3,
            tuhanorder.text3,
            tuhanorder.moneymax,
            tuhanorder.chumondate,
            tuhanorder.information1,
            tuhanorder.information2,
            tuhanorder.information3,
            tuhanorder.text4,
            tuhanorder.text1,
            tuhanorder.housoukubun ,
            tuhanorder.otodoketime ,
            tuhanorder.youbou ,
            hikiatesyukko.dataint01,
            hikiatesyukko.dataint02,
            hikiatesyukko.dataint03,
            hikiatesyukko.dataint04,
            hikiatesyukko.dataint05,
            hikiatesyukko.dataint06,
            hikiatesyukko.dataint07,
            hikiatesyukko.datachar12 as h_datachar12,
            hikiatesyukko.tantousyabango,
            hikiatesyukko.tanabango,
            hikiatesyukko.idoutanabango,
            hikiatesyukko.dataint08,
            v_orderinfo.r15,
            $fields
            hikiatesyukko.dataint09,
            tantousyaTantousyabango.name as updated_user1,
            replace(tantousyaTantousyabango.name,' ','') as updated_user1_search,
            substring(replace(tantousyaTantousyabango.name,' ',''),1,3) as updated_user1_short,
            
            tantousyaOrderuserbango.name as updated_user,
            replace(tantousyaOrderuserbango.name,' ','') as updated_user_search,
            substring(replace(tantousyaOrderuserbango.name,' ',''),1,3) as updated_user_short
            

            from
            (select distinct
            kokyakuorderbango, max(bango) as maxval
            from orderhenkan
            where synchroorderbango = 0 and datachar10 is not null
            group by kokyakuorderbango) as orderhenkan

            JOIN v_orderhenkan
            ON v_orderhenkan.kokyakuorderbango = orderhenkan.kokyakuorderbango
            AND v_orderhenkan.bango = orderhenkan.maxval

            join tuhanorder 
            on tuhanorder.orderbango = v_orderhenkan.bango
            AND tuhanorder.juchubango = v_orderhenkan.kokyakuorderbango

            join v_orderinfo 
            on v_orderinfo.bango = tuhanorder.orderbango
            AND v_orderinfo.juchubango = tuhanorder.juchubango

            join hikiatesyukko 
            on  hikiatesyukko.orderbango = v_orderhenkan.bango
            AND hikiatesyukko.syouhinid = v_orderhenkan.kokyakuorderbango
            
            left join tantousya as tantousyaOrderuserbango on tantousyaOrderuserbango.bango = v_orderhenkan.orderuserbango
            left join tantousya as tantousyaTantousyabango on tantousyaTantousyabango.bango = hikiatesyukko.tantousyabango
    
            $sql
            ");


        $v_orderhenkan_temp=QueryHelper::fetchResult("select * from v_orderhenkan_temp");
        $str='(';
        $sql_torihiki='';
        foreach ($v_orderhenkan_temp as $key => $value) {
            
            if ($key == (array_key_last($v_orderhenkan_temp))) {
               $str=$str."'".$value->bango."'".')';
            }else{
               $str=$str."'".$value->bango."'".',';
            }
            $sql_torihiki ="where  tuhanorder.orderbango IN ".$str;
        }

        QueryHelper::runQuery("CREATE TEMPORARY TABLE before_sales_history_temp as
            select distinct
            tuhanorder.orderbango,
            tuhanorder.juchubango,
            v_torihikisaki_1.R17_4 as information1_detail_show,
            v_torihikisaki_2.R17_4 as information2_detail_show,
            v_torihikisaki_3.R17_4 as information3_detail_show,
            v_torihikisaki_6.R17_4 as information6_detail_show

            from tuhanorder

            left join v_torihikisaki as v_torihikisaki_1
            on tuhanorder.information1=v_torihikisaki_1.torihikisaki_cd
            left join v_torihikisaki as v_torihikisaki_2
            on v_torihikisaki_2.torihikisaki_cd=tuhanorder.information2
            left join v_torihikisaki as v_torihikisaki_3
            on v_torihikisaki_3.torihikisaki_cd=tuhanorder.information3
            left join v_torihikisaki as v_torihikisaki_6
            on v_torihikisaki_6.torihikisaki_cd=tuhanorder.information6

            $sql_torihiki
            ");
        
   //dd(QueryHelper::fetchResult("select * from before_sales_history_temp"));
        QueryHelper::runQuery(
            "CREATE TEMPORARY TABLE sales_history_temp as
        select distinct
        v_orderhenkan_temp.bango as bango,
        v_orderhenkan_temp.ordertypebango2 as updated_times,
        CASE
            WHEN v_orderhenkan_temp.date::text is null THEN NULL
            ELSE replace(substring(v_orderhenkan_temp.date::text,1,10),'-','/') END as date,
        CASE
            WHEN v_orderhenkan_temp.date::text is null THEN NULL
            ELSE replace(substring(v_orderhenkan_temp.date::text,12,19),'-','/') END as time,
        --v_orderhenkan_temp.maxval as maxval,
        v_orderhenkan_temp.datachar05 as datachar05,
        v_orderhenkan_temp.datachar05 as orderuserbango,
        v_orderhenkan_temp.datachar10 as datachar10,
        CASE
            WHEN v_orderhenkan_temp.intorder01::text is null THEN NULL
            ELSE concat_ws('/',substring(v_orderhenkan_temp.intorder01::text,1,4),
            substring(v_orderhenkan_temp.intorder01::text,5,2),
            substring(v_orderhenkan_temp.intorder01::text,7,2)) END as intorder01,
        CASE
            WHEN v_orderhenkan_temp.intorder03::text is null THEN NULL
            ELSE concat_ws('/',substring(v_orderhenkan_temp.intorder03::text,1,4),
            substring(v_orderhenkan_temp.intorder03::text,5,2),
            substring(v_orderhenkan_temp.intorder03::text,7,2)) END as intorder03,
        v_orderhenkan_temp.juchukubun2 as sales_history_juchukubun2,
        CASE
        	WHEN v_orderhenkan_temp.chumondate is null THEN NULL
        	ELSE concat_ws('/',substring(CAST(v_orderhenkan_temp.chumondate as text),1,4),
        	substring(CAST(v_orderhenkan_temp.chumondate as text),6,2),
        	substring(CAST(v_orderhenkan_temp.chumondate as text),9,2)) END as chumondate,
        -- categorykanri1.groupbango as text1,
        v_orderhenkan_temp.kokyakuorderbango as kokyakuorderbango,
        v_orderhenkan_temp.ordertypebango2 as ordertypebango2,
        v_orderhenkan_temp.ordertypebango2 as order_inquiry_ordertypebango2,
        v_orderhenkan_temp.synchroorderbango as synchroorderbango,
        --CASE
        --    WHEN v_orderhenkan_temp.maxval IS NULL THEN NULL
        --    ELSE 1 END as active_order_flag,
        -- substring(replace(tantousya.name, ' ', ''),1,3) as name,
        tantousya.name as user_name,
        replace(tantousya.name,' ','') as user_name_search,
        substring(replace(tantousya.name,' ',''),1,3) as user_name_short,
        CONCAT(tantousya.bango, ' ', tantousya.name) as name_with_id,
        --concat_ws('/',substring(v_orderhenkan_temp.information1,1,8),kokyaku1Information1.address,haisouInformation1.haisoumoji1) as information1_detail,
        substring(v_orderhenkan_temp.information1,1,8) as information1_db,
        before_sales_history_temp.information1_detail_show as information1_detail_show,
        v_orderhenkan_temp.juchukubun1 as juchukubun1,
        v_orderhenkan_temp.r15 as juchukubun1_short,
        CASE
            WHEN v_orderhenkan_temp.intorder05::text is null THEN NULL
            ELSE concat_ws('/',substring(v_orderhenkan_temp.intorder05::text,1,4),
            substring(v_orderhenkan_temp.intorder05::text,5,2),
            substring(v_orderhenkan_temp.intorder05::text,7,2)) END as intorder05,
        cast(v_orderhenkan_temp.numeric3 as bigint) as numeric3,
        to_char(v_orderhenkan_temp.numeric3,'FM99,999,999,999,999') as formatted_numeric3,
        v_orderhenkan_temp.text3 as text3,
        cast(v_orderhenkan_temp.moneymax as bigint) as moneymax,
        to_char(v_orderhenkan_temp.moneymax,'FM99,999,999,999,999') as formatted_moneymax,
        before_sales_history_temp.information2_detail_show as information2_detail,
        substring(v_orderhenkan_temp.information2,1,8) as information2_db,
        before_sales_history_temp.information2_detail_show as information2_detail_show,
        before_sales_history_temp.information3_detail_show as information3_detail,
        substring(v_orderhenkan_temp.information3,1,8) as information3_db,
        before_sales_history_temp.information3_detail_show as information3_detail_show,
        before_sales_history_temp.information6_detail_show as information6_detail_show,
        v_orderhenkan_temp.dataint01,
        v_orderhenkan_temp.dataint02,
        v_orderhenkan_temp.dataint03,
        v_orderhenkan_temp.dataint04,
        v_orderhenkan_temp.dataint05,
        v_orderhenkan_temp.dataint06,
        v_orderhenkan_temp.dataint07,
        v_orderhenkan_temp.h_datachar12 as datachar12,
        v_orderhenkan_temp.dataint01_val,
        v_orderhenkan_temp.dataint02_val,
        v_orderhenkan_temp.dataint03_val,
        v_orderhenkan_temp.dataint04_val,
        v_orderhenkan_temp.dataint05_val,
        v_orderhenkan_temp.dataint06_val,
        v_orderhenkan_temp.dataint07_val,
        v_orderhenkan_temp.dataint08_val,
        v_orderhenkan_temp.dataint09_val,
        v_orderhenkan_temp.housoukubun_val,
        v_orderhenkan_temp.tantousyabango,
        v_orderhenkan_temp.tanabango as date1_time1,
        --substring(v_orderhenkan_temp.tanabango::text,9,2) as updated_date_time,
        CASE
            WHEN v_orderhenkan_temp.tanabango::text is null THEN NULL
            ELSE concat_ws('/',substring(v_orderhenkan_temp.tanabango::text,1,4),
            substring(v_orderhenkan_temp.tanabango::text,5,2),
            substring(v_orderhenkan_temp.tanabango::text,7,2)) END as date1,
        CASE
            WHEN v_orderhenkan_temp.tanabango::text is null THEN NULL
            ELSE concat_ws(':',substring(v_orderhenkan_temp.tanabango::text,9,2),
            substring(v_orderhenkan_temp.tanabango::text,11,2),
            substring(v_orderhenkan_temp.tanabango::text,13,2)) END as time1,

        CASE
            WHEN v_orderhenkan_temp.idoutanabango::text is null THEN NULL
            ELSE concat_ws('/',substring(v_orderhenkan_temp.idoutanabango::text,1,4),
            substring(v_orderhenkan_temp.idoutanabango::text,5,2),
            substring(v_orderhenkan_temp.idoutanabango::text,7,2)) END as updated_date,
        CASE
            WHEN v_orderhenkan_temp.idoutanabango::text is null THEN NULL
            ELSE concat_ws(':',substring(v_orderhenkan_temp.idoutanabango::text,9,2),
            substring(v_orderhenkan_temp.idoutanabango::text,11,2),
            substring(v_orderhenkan_temp.idoutanabango::text,13,2)) END as updated_time,

        --substring(replace(tantousya2.name, ' ', ''),1,3) as user_name2,
        tantousya2.name as user_name2,
        replace(tantousya2.name,' ','') as user_name_search2,
        substring(replace(tantousya2.name,' ',''),1,3) as user_name_short2,

        --tantousya.name as updated_user,
        v_orderhenkan_temp.updated_user,
        --replace(tantousya.name,' ','') as updated_user_search,
        v_orderhenkan_temp.updated_user_search,
        --substring(replace(tantousya.name,' ',''),1,3) as updated_user_short,
        v_orderhenkan_temp.updated_user_short,

        --tantousya.name as updated_user1,
        v_orderhenkan_temp.updated_user1,
        --replace(tantousya.name,' ','') as updated_user1_search,
        v_orderhenkan_temp.updated_user1_search,
        --substring(replace(tantousya.name,' ',''),1,3) as updated_user1_short,
        v_orderhenkan_temp.updated_user1_short,


        v_orderhenkan_temp.dataint08 as dataint08,
        v_orderhenkan_temp.dataint09 as dataint09,
        v_orderhenkan_temp.datachar03 as sales_history_datachar03,
        v_orderhenkan_temp.datachar01 as datachar01,
        CASE
            WHEN v_orderhenkan_temp.text4 is null THEN NULL
            ELSE concat(split_part(v_orderhenkan_temp.text4, '¶', 1),RIGHT(v_orderhenkan_temp.text4,4))END as text4,
        v_orderhenkan_temp.text4 as text4_display,
        v_orderhenkan_temp.text1 as text1,
        v_orderhenkan_temp.housoukubun as housoukubun,
        v_orderhenkan_temp.youbou as sales_history_youbou,
        CASE
            WHEN categorykanri1.category2 is null THEN NULL
            ELSE CONCAT(RIGHT(categorykanri1.category2, 2) ,' ',categorykanri1.category4)END as text1_val,
        CONCAT(
            RIGHT(categorykanri2.category1, 2) ,' ',categorykanri2.category4) as category,
        CONCAT(
            RIGHT(categorykanri2.category2, 2) ,' ',categorykanri2.category4) as kessaihouhou_val,
        CONCAT(
            RIGHT(categorykanri3.category2, 2) ,' ',categorykanri3.category4) as category_new,
        v_orderhenkan_temp.kessaihouhou as kessaihouhou,
        v_orderhenkan_temp.information7 as information7,
        v_orderhenkan_temp.information8 as information8

        from v_orderhenkan_temp

        join before_sales_history_temp
        on before_sales_history_temp.orderbango=v_orderhenkan_temp.bango

        left join categorykanri as categorykanri1 on substring(v_orderhenkan_temp.text1,1,2) = categorykanri1.category1
        and substring(v_orderhenkan_temp.text1,3,2) = categorykanri1.category2
         left join tantousya as tantousya on tantousya.bango = v_orderhenkan_temp.datachar05
        left join tantousya as tantousya2 on tantousya2.bango = v_orderhenkan_temp.h_datachar12
        left join categorykanri as categorykanri2 on categorykanri2.category1='A9' AND v_orderhenkan_temp.kessaihouhou = CONCAT(categorykanri2.category1,categorykanri2.category2)
        left join categorykanri as categorykanri3 on categorykanri3.category1='B1' AND v_orderhenkan_temp.otodoketime = CONCAT(categorykanri3.category1,categorykanri3.category2)

        ORDER BY sales_history_juchukubun2 ASC
        ");

        $data = DB::table('sales_history_temp');
        //dd(QueryHelper::fetchResult('select * from sales_history_temp'));
        return $data;
    }
}
