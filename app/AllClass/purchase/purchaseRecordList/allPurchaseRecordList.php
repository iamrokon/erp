<?php

namespace App\AllClass\purchase\purchaseRecordList;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\kengen;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class allPurchaseRecordList{
    public static function data($login_bango,$deleted_item=2,$req_data=null){

        if(!empty($req_data['division_datachar05_start'])){
            $req_division_start  = substr($req_data['division_datachar05_start'], 4,2) ;
        }else{
            $req_division_start = null;
        }

        if(!empty($req_data['division_datachar05_end'])){
            $req_division_end  = substr($req_data['division_datachar05_end'], 4,2);
        }else{
            $req_division_end = null;
        }

        if(!empty($req_data['department_datachar05_start'])){
            $req_department_start =  substr($req_data['department_datachar05_start'], 4,3);
        }else{
            $req_department_start = null;
        }

        if(!empty($req_data['department_datachar05_end'])){
            $req_department_end = substr($req_data['department_datachar05_end'], 4,3);
        }else{
            $req_department_end = null;
        }

        if(!empty($req_data['group_datachar05_start'])){
            $req_t_group_start = substr($req_data['group_datachar05_start'], 4,4);
        }else{
            $req_t_group_start = null;
        }

        if(!empty($req_data['group_datachar05_end'])){
            $req_t_group_end = substr($req_data['group_datachar05_end'], 4,4);
        }else{
            $req_t_group_end = null;
        }

        if(!empty($req_data['datachar05'])){
            $datachar05 = $req_data['datachar05'];
        }else{
            $datachar05 = null;
        }


        $sql ="";
        if ($req_division_start != '' && $req_division_end != '' && ($req_division_start != $req_division_end)) {

            $sql.= " where substring(tantousya2.datatxt0003::text,1,2)='B9' AND right(tantousya2.datatxt0003::text,2) between '$req_division_start' and  '$req_division_end'";
        } else {

            $sql.= " where substring(tantousya2.datatxt0003::text,1,2)='B9' AND right(tantousya2.datatxt0003::text,2) = '$req_division_start'";
        }

        if ($req_department_start != '' && $req_department_end != '' && ($req_department_start != $req_department_end)) {

            $sql.= " and substring(tantousya2.datatxt0004::text,1,2)='C1' AND right(tantousya2.datatxt0004::text,3) between '$req_department_start' and '$req_department_end'";
        } else if ($req_department_start != '') {

            $sql.= " and substring(tantousya2.datatxt0004::text,1,2)='C1' AND right(tantousya2.datatxt0004::text,3) = '$req_department_start'";
        }

        if ($req_t_group_start != '' && $req_t_group_end != '' && ($req_t_group_start != $req_t_group_end)) {

            $sql.= " and substring(tantousya2.datatxt0005::text,1,2)='C2' AND right(tantousya2.datatxt0005::text ,4) between '$req_t_group_start' and '$req_t_group_end'";
        } else if ($req_t_group_start != '') {

            $sql.= " and substring(tantousya2.datatxt0005::text,1,2)='C2' AND right(tantousya2.datatxt0005::text ,4) = '$req_t_group_start'";
        }
        
        $rd=!empty($req_data['rd1'])?$req_data['rd1']:null;  

        if($rd){
            if(isset($rd) && $rd =="rd_1"){
                $sql.=" and hikiatesyukko.datachar17 IS NULL";
            }
            else if($rd =="rd_2"){
                $sql.=" and hikiatesyukko.datachar17 IS NOT NULL AND hikiatesyukko.datachar18 IS NULL";
            }
            else if($rd =="rd_3"){
                $sql.=" and hikiatesyukko.datachar18 IS NOT NULL";
            }
            //else if($rd =="rd_4"){
            //   $sql.=" and hikiatesyukko.datachar16 != '1' AND hikiatesyukko.datachar18 IS NOT NULL";
            //}
            else if($rd =="rd_4"){
                //$sql.=" and hikiatesyukko.datachar16 = '1' OR (syukko.dataint05 != 0 AND syukko.dataint06 != 0 AND syukko.dataint07 != 0 AND syukko.dataint08 != 0)";
                $sql.=" and hikiatesyukko.datachar16 = '1' OR (misyukko_temp.sum_of_dataint05 != 0 AND misyukko_temp.sum_of_dataint06 != 0 AND misyukko_temp.sum_of_dataint07 != 0 AND misyukko_temp.sum_of_dataint08 != 0)";
            }
           
        }
        
        if ($datachar05) {
            $sql.= " and orderhenkan_inner_data.datachar05 = '$datachar05'";
        }
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS v_torihikisaki_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE v_torihikisaki_temp as
        select *
        from v_torihikisaki
        ");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_self");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_self as
        select distinct 
        kokyakuorderbango, max(ordertypebango2) as maxval
        from orderhenkan
        where synchroorderbango2 = 0 
        group by kokyakuorderbango");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_inner_data");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_inner_data as
        select distinct 
        kokyakuorderbango, max(ordertypebango2) as maxval,intorder01,intorder03,datachar05,datachar14
        from orderhenkan
        where synchroorderbango = 0 and datachar10 is null
        group by kokyakuorderbango,intorder01,intorder03,datachar05,datachar14");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_temp1");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_temp1 as
        select distinct 
        kokyakuorderbango, max(ordertypebango2) as maxval,intorder03
        from orderhenkan
        where datachar10 is null
        --and synchroorderbango = 0 
        group by kokyakuorderbango,intorder03");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_temp2");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_temp2 as
        select distinct 
        kokyakuorderbango, max(ordertypebango2) as maxval,intorder03
        from orderhenkan
        where datachar10 is not null
        --and synchroorderbango = 0 
        --and kokyakuorderbango = '0151013292'
        group by kokyakuorderbango,intorder03");
        //$temp_purchase_data = QueryHelper::fetchResult("select * from orderhenkan_temp2");
        //dd($temp_purchase_data);
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS misyukko_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE misyukko_temp as
        select 
        orderhenkan.bango,
        orderhenkan.kokyakuorderbango as misyukko_syouhinid,
        sum(misyukko.dataint05) as sum_of_dataint05,
        sum(misyukko.dataint06) as sum_of_dataint06,
        sum(misyukko.dataint07) as sum_of_dataint07,
        sum(misyukko.dataint08) as sum_of_dataint08,
        sum(misyukko.syukkasu * misyukko.dataint08) as sum_of_syukkasu_dataint08,
        sum((misyukko.syukkasu * misyukko.dataint05) + (misyukko.syukkasu * misyukko.dataint06) + (misyukko.syukkasu * misyukko.dataint07)) as scheduled_to_work,
        sum((misyukko.syukkasu * misyukko.dataint05) + (misyukko.syukkasu * misyukko.dataint06) + (misyukko.syukkasu * misyukko.dataint07)) as scheduled_work_result,
        misyukko.datachar21
        from misyukko
        join orderhenkan on orderhenkan.kokyakuorderbango = misyukko.syouhinid
            AND orderhenkan.bango = misyukko.orderbango
        --where misyukko.yoteimeter != 2 
        --where orderhenkan.kokyakuorderbango = '0151016842'
        group by misyukko_syouhinid,bango,misyukko.datachar21
        ");
        //$temp_purchase_data = QueryHelper::fetchResult("select * from misyukko_temp");
        //dd($temp_purchase_data);
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS minyuko_m");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE minyuko_m as
        select distinct 
        syouhinid,
        max(zaikometer) as max_zaikometer
        from minyuko
        group by syouhinid");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS nyukoold_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE nyukoold_temp as
        select distinct 
        nyukoold.syouhinid,
        max(nyukoold.zaikometer) as max_zaikometer,
        sum(nyukoold.syouhizeiritu) as sum_of_syouhizeiritu
        from nyukoold
        join minyuko on minyuko.syouhinid = nyukoold.idoutanabango
            and minyuko.syouhinsyu = nyukoold.yoteimeter
            and minyuko.hantei =  nyukoold.nyukometer
        join minyuko_m on minyuko_m.syouhinid = minyuko.syouhinid and minyuko_m.max_zaikometer = minyuko.zaikometer
        join hikiatenyuko on hikiatenyuko.syouhinid = nyukoold.syouhinid
        where minyuko.datachar01 = 'V150' and hikiatenyuko.datachar07 is not null
        -- and nyukoold.idoutanabango = '0351000610'
        group by nyukoold.syouhinid
        ");
        //$temp_purchase_data = QueryHelper::fetchResult("select * from nyukoold_temp");
        //dd($temp_purchase_data);
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_record_list_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_record_list_temp as
          select distinct on (orderhenkan.kokyakuorderbango)
          orderhenkan.bango,
          orderhenkan.kokyakuorderbango,
          orderhenkan.orderuserbango,
          orderhenkan_inner_data.kokyakuorderbango as inner_kokyakuorderbango,
          orderhenkan_temp1.intorder03 as temp1_intorder03,
          orderhenkan_temp2.intorder03 as temp2_intorder03,
          CASE
            WHEN hikiatesyukko.datachar04 = '2' THEN orderhenkan_temp1.intorder03
            ELSE orderhenkan_temp2.intorder03 END as search_intorder03,
          orderhenkan.ordertypebango2,
          orderhenkan.intorder03,
          --orderhenkan_inner_data.datachar14,
          CASE
            WHEN orderhenkan_inner_data.datachar14 is null THEN NULL
            ELSE concat_ws('/',substring(orderhenkan_inner_data.datachar14,1,4),
            substring(orderhenkan_inner_data.datachar14,5,2),
            substring(orderhenkan_inner_data.datachar14,7,2)) END as datachar14,
          tuhanorder.information1,
          information1Detail.r17_4 as information1_detail,
          tuhanorder.information3,
          information3Detail.r17_4 as information3_detail,
          tuhanorder.money10,
          tuhanorder.money10 as money10_search,
          minyuko.syouhinid,
          minyuko.syouhinsyu,
          minyuko.hantei,
          concat_ws(' ',substring(hikiatesyukko.datachar04,1,1),datachar04Request.jouhou) as datachar04,
          --hikiatesyukko.datachar16,
          concat_ws(' ',substring(hikiatesyukko.datachar16,1,1),dataChar16Request.jouhou) as datachar16,
          hikiatesyukko.datachar17,
          hikiatesyukko.datachar18,
          CASE
            WHEN hikiatesyukko.datachar18 IS NOT Null AND hikiatesyukko.datachar16 = '1' THEN 4
            WHEN hikiatesyukko.datachar18 IS NOT Null THEN 3
            WHEN hikiatesyukko.datachar17 IS NOT Null THEN 2
            ELSE 1 END as completion_finger,
          misyukko_temp.sum_of_dataint05,
          misyukko_temp.sum_of_dataint06,
          misyukko_temp.sum_of_dataint07,
          misyukko_temp.sum_of_dataint08,
          misyukko_temp.sum_of_syukkasu_dataint08,
          misyukko_temp.sum_of_syukkasu_dataint08 as sum_of_syukkasu_dataint08_search,
          COALESCE(misyukko_temp.scheduled_to_work,0)as scheduled_to_work,
          COALESCE(misyukko_temp.scheduled_to_work,0) as scheduled_to_work_search,
          --misyukko_temp.scheduled_work_result,
          --misyukko_temp.scheduled_work_result as scheduled_work_result_search,
          CASE
            WHEN hikiatesyukko.datachar16 = '2' THEN 0
            ELSE COALESCE(misyukko_temp.scheduled_work_result,0) END as scheduled_work_result,
          CASE
            WHEN hikiatesyukko.datachar16 = '2' THEN 0
            ELSE COALESCE(misyukko_temp.scheduled_work_result,0) END as scheduled_work_result_search,
          misyukko_temp.datachar21 as m_datachar21,
          nyukoold_temp.sum_of_syouhizeiritu,
          nyukoold_temp.sum_of_syouhizeiritu as sum_of_syouhizeiritu_search,
          (nyukoold_temp.sum_of_syouhizeiritu + misyukko_temp.scheduled_work_result) as purchase_sum,
          (misyukko_temp.sum_of_syukkasu_dataint08 - nyukoold_temp.sum_of_syouhizeiritu) as purchase_difference,
          toiawasebango.unsoumei,
          orderhenkan_inner_data.datachar05,
          tantousya2.datatxt0003 as data101,
          tantousya2.datatxt0004 as data102,
          tantousya2.datatxt0005 as data103,
          tantousya2.datatxt0003,
          tantousya2.datatxt0004,
          tantousya2.datatxt0005
          
          from orderhenkan
          
          join orderhenkan_self on orderhenkan_self.kokyakuorderbango = orderhenkan.kokyakuorderbango
          AND orderhenkan_self.maxval = orderhenkan.ordertypebango2
          
          join orderhenkan_inner_data on orderhenkan_inner_data.kokyakuorderbango = orderhenkan.orderuserbango
          
          join tuhanorder on tuhanorder.juchubango = orderhenkan_inner_data.kokyakuorderbango
          
          left join orderhenkan_temp1 on orderhenkan_temp1.kokyakuorderbango = orderhenkan_inner_data.kokyakuorderbango
          
          left join orderhenkan_temp2 on orderhenkan_temp2.kokyakuorderbango = orderhenkan_inner_data.kokyakuorderbango
          
          join minyuko ON orderhenkan.kokyakuorderbango = minyuko.syouhinid
          
          join juchusyukko2 on minyuko.syouhinid = juchusyukko2.syouhinid
          AND minyuko.syouhinsyu = juchusyukko2.syouhinsyu
          AND minyuko.hantei = juchusyukko2.hantei
          
          join nyukoold on nyukoold.idoutanabango = minyuko.syouhinid
          and nyukoold.yoteimeter = minyuko.syouhinsyu 
          and nyukoold.nyukometer = minyuko.hantei 
          
          join nyukoold_temp on nyukoold_temp.syouhinid = nyukoold.syouhinid
          AND nyukoold_temp.max_zaikometer = nyukoold.zaikometer
          
          join toiawasebango on toiawasebango.unsoumei = nyukoold.syouhinid
          
          join hikiatenyuko on toiawasebango.unsoumei = hikiatenyuko.syouhinid
          
          left join hikiatenyuko as hikiatenyukoInner on orderhenkan_inner_data.kokyakuorderbango = hikiatenyukoInner.syouhinid
          
          --left join misyukko on misyukko.syouhinid = orderhenkan.kokyakuorderbango
          left join misyukko_temp on misyukko_temp.misyukko_syouhinid = orderhenkan_inner_data.kokyakuorderbango
          
          left join hikiatesyukko on hikiatesyukko.syouhinid = orderhenkan_inner_data.kokyakuorderbango
          
          join tantousya2 on tantousya2.bango = orderhenkan_inner_data.datachar05
          
          --information1
          left join v_torihikisaki_temp as information1Detail on
          information1Detail.torihikisaki_cd = tuhanorder.information1
          --information1 end
          
          --information3
          left join v_torihikisaki_temp as information3Detail on
          information3Detail.torihikisaki_cd = tuhanorder.information3
          --information3 end
          
          left join request as datachar04Request on datachar04Request.syouhinbango = substring(hikiatesyukko.datachar04,1,1)::int
          AND datachar04Request.color = '0201伝票作成フラグ'
          
          left join request as dataChar16Request on dataChar16Request.syouhinbango = substring(hikiatesyukko.dataChar16,1,1)::int
          AND dataChar16Request.color = '0201仕入完了フラグ'
          
          --left join syukko on syukko.syouhinid = orderhenkan.kokyakuorderbango
          
          $sql 
              
          ORDER BY orderhenkan.kokyakuorderbango,tantousya2.datatxt0003,tantousya2.datatxt0004,tantousya2.datatxt0005,orderhenkan.orderuserbango ASC  
       
        ");
        
        $sql2 = "";
        $salesDate_start = null;
        $salesDate_end = null;
        if(!empty($req_data['intorder01_start']) && !empty($req_data['intorder01_end'])){
            $salesDate_start = (int) str_replace('/','',$req_data['intorder01_start']);
            $salesDate_end = (int) str_replace('/','',$req_data['intorder01_end']);
            $sql2.= " where (search_intorder03 >= $salesDate_start AND search_intorder03 <= $salesDate_end)";
        }
        
        if(!empty($req_data['intorder02_start']) && !empty($req_data['intorder02_end']) && ($req_data['rd1'] =='rd_4' || $req_data['rd1'] == 'rd_5')){
            $intorder02_start = $req_data['intorder02_start'];
            $intorder02_end = $req_data['intorder02_end'];
            if(strlen($sql2)>0){
                $sql2.= " 
                    and
                    CASE 
                        WHEN sum_of_syukkasu_dataint08 > 0 THEN (datachar14 >= '$intorder02_start' AND datachar14 <= '$intorder02_end')
                        ELSE true END
                    ";
            }else{
                $sql2.= " 
                    where 
                    CASE 
                        WHEN sum_of_syukkasu_dataint08 > 0 THEN (datachar14 >= '$intorder02_start' AND datachar14 <= '$intorder02_end')
                        ELSE true END
                    ";
            }
        }
        
        if($sql2 != ""){
            if ($datachar05) {
                $sql2.= " and datachar05 = '$datachar05'";
            }
        }
        
        // months difference check start
//        $date1 = strtotime($salesDate_start);
//        $date2 = strtotime($salesDate_end);
//        $diff = abs($date2 - $date1);
//        $years = floor($diff / (365*60*60*24));
//        $months = floor(($diff - $years * 365*60*60*24)/(30*60*60*24));
         // months difference check end
    
        QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_record_list_final");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_record_list_final as
          select 
          purchase_record_list_temp.*,
          purchase_record_list_temp.purchase_sum as purchase_sum_search,
          purchase_record_list_temp.purchase_difference as purchase_difference_search,
        --   to_char(purchase_record_list_temp.search_intorder03,'YYYY/MM/DD') as formatted_search_intorder03,
        CASE
            WHEN purchase_record_list_temp.search_intorder03::text is null THEN NULL
            ELSE concat_ws('/',substring(purchase_record_list_temp.search_intorder03::text,1,4),
            substring(purchase_record_list_temp.search_intorder03::text,5,2),
            substring(purchase_record_list_temp.search_intorder03::text,7,2)) 
        END as formatted_search_intorder03,
        CASE
            WHEN purchase_record_list_temp.m_datachar21::text is null THEN NULL
            ELSE concat_ws('/',substring(purchase_record_list_temp.m_datachar21::text,1,4),
            substring(purchase_record_list_temp.m_datachar21::text,5,2),
            substring(purchase_record_list_temp.m_datachar21::text,7,2)) 
        END as datachar21,
          to_char(purchase_record_list_temp.money10,'FM99,999,999,999,999') as formatted_money10,
          to_char(purchase_record_list_temp.sum_of_syukkasu_dataint08,'FM99,999,999,999,999') as formatted_sum_of_syukkasu_dataint08, 
          to_char(purchase_record_list_temp.scheduled_to_work,'FM99,999,999,999,999') as formatted_scheduled_to_work,
          to_char(purchase_record_list_temp.scheduled_work_result,'FM99,999,999,999,999') as formatted_scheduled_work_result,
          to_char(purchase_record_list_temp.sum_of_syouhizeiritu,'FM99,999,999,999,999') as formatted_sum_of_syouhizeiritu,
          to_char(purchase_record_list_temp.purchase_sum,'FM99,999,999,999,999') as formatted_purchase_sum,  
          to_char(purchase_record_list_temp.purchase_difference,'FM99,999,999,999,999') as formatted_purchase_difference
          from purchase_record_list_temp
          $sql2
        ");
        
        // $temp_purchase_data = QueryHelper::fetchResult("select * from purchase_record_list_final");
        // dd($temp_purchase_data);

        $data= DB::table('purchase_record_list_final')->toSql();

        return $data;
        
    }
}
