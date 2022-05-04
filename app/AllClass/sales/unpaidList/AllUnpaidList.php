<?php

namespace App\AllClass\sales\unpaidList;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\kengen;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class AllUnpaidList{
    public static function data($login_bango,$deleted_item=2,$req_data=null){
        //if(!empty($fsearch_bangos)){
        //    $bango = implode(',', $fsearch_bangos);
        //}elseif($first_search_result == "no_data"){
        //    $bango = 0;
        //}else{
        //    $bango = 0;
        //}
        //if($fsearch_bangos!=null){
        //    $sql = " where orderhenkan.bango IN ($bango)";
        //}elseif($first_search_result == "no_data"){
         //   $sql = " where orderhenkan.bango IN ($bango)";
        //}else{
            //$sql = "";
            //if(isset($req_data['intorder05_start']) && ($req_data['intorder05_start']!="" && $req_data['intorder05_end']!="")){
            //    $start_date = str_replace('/','',$req_data['intorder05_start']);
            //    $end_date = str_replace('/','',$req_data['intorder05_end']);
            //    $sql .= " where orderhenkan.intorder05::text between '$start_date' and '$end_date' ";
            //}

            //if(isset($req_data['intorder03_start']) && ($req_data['intorder03_start']!="" && $req_data['intorder03_end']!="")){
            //    $intorder03_start_date = str_replace('/','',$req_data['intorder03_start']);
            //    $intorder03_end_date = str_replace('/','',$req_data['intorder03_end']);
            //    if(strlen($sql)>0){
            //        $sql .= " AND orderhenkan.intorder03::text between '$intorder03_start_date' and '$intorder03_end_date' ";
            //    }else{
            //        $sql .= " where orderhenkan.intorder03::text between '$intorder03_start_date' and '$intorder03_end_date' ";
            //    }
            //}

            //if(isset($req_data['division_datachar05_start']) && ($req_data['division_datachar05_start']!="" && $req_data['division_datachar05_end']!="")){
            //    $division_start_date = substr($req_data['division_datachar05_start'], 4,2);
            //    $division_end_date = substr($req_data['division_datachar05_end'], 4,2);
            //    if(strlen($sql)>0){
            //        $sql .= "AND substring(v_orderhenkan.datatxt0003::text,1,2)='B9' AND right(v_orderhenkan.datatxt0003::text,2) between '$division_start_date' and '$division_end_date' ";
            //    }else{
            //        $sql .= " where substring(v_orderhenkan.datatxt0003::text,1,2)='B9' AND right(v_orderhenkan.datatxt0003::text,2) between '$division_start_date' and '$division_end_date' ";
            //    }
            //}

            //if(isset($req_data['department_datachar05_start']) && ($req_data['department_datachar05_start']!="" && $req_data['department_datachar05_end']!="")){
            //    $department_start_date =substr($req_data['department_datachar05_start'], 4,3);
            //    $department_end_date = substr($req_data['department_datachar05_end'], 4,3);
            //    if(strlen($sql)>0){
            //        $sql .= "AND substring(v_orderhenkan.datatxt0004::text,1,2)='C1' AND right(v_orderhenkan.datatxt0004::text,3) between '$department_start_date' and '$department_end_date' ";
            //    }else{
            //        $sql .= " where substring(v_orderhenkan.datatxt0004::text,1,2)='C1' AND right(v_orderhenkan.datatxt0004::text,3) between '$department_start_date' and '$department_end_date' ";
            //    }
            //}

            //if(isset($req_data['group_datachar05_start']) && ($req_data['group_datachar05_start']!="" && $req_data['group_datachar05_end']!="")){
            //    $group_start_date = substr($req_data['group_datachar05_start'], 4,4);
            //    $group_end_date = substr($req_data['group_datachar05_end'], 4,4);
            //    if(strlen($sql)>0){
            //        $sql .= "AND substring(v_orderhenkan.datatxt0005::text,1,2)='C2' AND right(v_orderhenkan.datatxt0005::text ,4) between '$group_start_date' and '$group_end_date' ";
            //    }else{
            //        $sql .= " where substring(v_orderhenkan.datatxt0005::text,1,2)='C2' AND right(v_orderhenkan.datatxt0005::text ,4) between '$group_start_date' and '$group_end_date' ";
            //    }
            //}

            //if(isset($req_data['rd1']) && ($req_data['rd1']=="rd1_1" || $req_data['rd1']=="rd1_2")){
            //    if(strlen($sql)>0){
            //        $sql .= " AND  temp_tuhanorder.unsoudaibikitesuryou = 1 ";
            //    }else{
            //        $sql .= " where temp_tuhanorder.unsoudaibikitesuryou = 1 ";
            //    }
            //}else{
            //    if(strlen($sql)>0){
            //        $sql .= " AND hikiatesyukko.dataint01 = 2 ";
            //    }else{
            //        $sql .= " where hikiatesyukko.dataint01 = 2 ";
            //    }
            //}

            //if(isset($req_data['rd2']) && $req_data['rd2'] == "rd2_1"){
            //    $sql .= " ORDER BY orderhenkan.intorder03 asc ";
            //}else if(isset($req_data['rd2']) && $req_data['rd2'] == "rd2_2"){
            //    $sql .= " ORDER BY orderhenkan.intorder05 asc ";
            //}else{
            //    $sql .= " ORDER BY v_orderhenkan.datachar05 asc ";
            //}

       // }

        QueryHelper::runQuery("DROP TABLE IF EXISTS temp_orderhenkan");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE temp_orderhenkan as
            select distinct on (v_orderhenkan.datachar10)
            v_orderhenkan.bango,
            v_orderhenkan.datachar10,
            temp_daikinseisanold.soufusakiname as old_soufusakiname,
            temp_daikinseisanold.soufusakiyubinbango as old_soufusakiyubinbango,
            max(daikinseisan.soufusakiname) as soufusakiname,
            --sum(daikinseisan.nyukingaku) as sum_of_nyukingaku,
            max(temp_daikinseisanold.shinkurokokyakuorderbango) as max_old_shinkurokokyakuorderbango,
            max(daikinseisan.shinkurokokyakuorderbango) as max_shinkurokokyakuorderbango,
            temp_daikinseisanold.otodoketime,
            (select max(daikinseisanold.moneymax) from daikinseisanold where daikinseisanold.shinkurokokyakuorderbango = max(temp_daikinseisanold.shinkurokokyakuorderbango) and daikinseisanold.otodoketime = temp_daikinseisanold.otodoketime) as max_moneymax

            from v_orderhenkan

            --join daikinseisanold as temp_daikinseisanold on  temp_daikinseisanold.otodoketime = v_orderhenkan.datachar10
            left join daikinseisanold as temp_daikinseisanold on  temp_daikinseisanold.otodoketime = v_orderhenkan.datachar10

            --join daikinseisan on  daikinseisan.shinkurokokyakuname = temp_daikinseisanold.shinkurokokyakuname AND daikinseisan.shinkurokokyakugroup = temp_daikinseisanold.shinkurokokyakugroup
            left join daikinseisan on  daikinseisan.shinkurokokyakuname = temp_daikinseisanold.shinkurokokyakuname AND daikinseisan.shinkurokokyakugroup = temp_daikinseisanold.shinkurokokyakugroup

            group by v_orderhenkan.bango,v_orderhenkan.datachar10,old_soufusakiname,old_soufusakiyubinbango,temp_daikinseisanold.otodoketime
        ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS unpaid_list_temp");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE unpaid_list_temp as
        select distinct
        orderhenkan.bango,
        orderhenkan.intorder03,
        orderhenkan.intorder05,
        orderhenkan.datachar02,
        CASE
            WHEN trim(orderhenkan.datachar02) = '' THEN NULL
            ELSE concat(categorykanriDatachar02.category2,' ',categorykanriDatachar02.category4) END as datachar02_detail,
        v_orderhenkan.datachar10,
        v_orderhenkan.kokyakuorderbango,
        v_orderhenkan.datachar05,
        v_orderhenkan.datatxt0003,
        v_orderhenkan.name as user_name,
        replace(replace(v_orderhenkan.name,' ',''),'　','') as user_name_search,
        substring(replace(replace(v_orderhenkan.name,' ',''),'　',''),1,3) as user_name_short,
        CASE
            WHEN v_orderhenkan.intorder03::text is null THEN NULL
            ELSE concat_ws('/',substring(v_orderhenkan.intorder03::text,1,4),
            substring(v_orderhenkan.intorder03::text,5,2),
            substring(v_orderhenkan.intorder03::text,7,2)) END as v_intorder03,
        CASE
            WHEN hikiatesyukko.dataint01 = 2 THEN NULL
            ELSE
                (CASE
                WHEN v_orderhenkan.intorder05::text is null THEN NULL
                ELSE concat_ws('/',substring(v_orderhenkan.intorder05::text,1,4),
                substring(v_orderhenkan.intorder05::text,5,2),
                substring(v_orderhenkan.intorder05::text,7,2)) END)
            END as v_intorder05,
        CASE
            WHEN v_orderhenkan.intorder05::text is null THEN NULL
            ELSE concat_ws('/',substring(v_orderhenkan.intorder05::text,1,4),
            substring(v_orderhenkan.intorder05::text,5,2),
            substring(v_orderhenkan.intorder05::text,7,2)) END as intorder05_input,
        temp_tuhanorder.information1,
        temp_tuhanorder.unsoudaibikitesuryou,
        information1Detail.r17_4cd as information1_detail,
        information2Detail.r17_4cd as information2_detail,
        v_orderinfo.juchukubun1 as juchukubun1,
        --v_orderinfo.r15 as juchukubun1_short,
        v_orderinfo.r25 as juchukubun1_short,
        temp_tuhanorder.information3,
        information3Detail.r17_4cd as information3_detail,
        --CAST((COALESCE(temp_tuhanorder.numeric3,0) + COALESCE(temp_tuhanorder.numeric4,0)) as integer) as unpaidlist_sales_amount,
        to_char((COALESCE(temp_tuhanorder.numeric3,0) + COALESCE(temp_tuhanorder.numeric4,0)),'FM99,999,999,999,999') as formatted_sales_amount,
        CASE
            WHEN temp_tuhanorder.unsoutesuryou is null THEN NULL
            ELSE concat_ws(' ',unsoutesuryouRequest.syouhinbango,unsoutesuryouRequest.jouhou) END  as unsoutesuryou,
        CASE
            WHEN hikiatesyukko.dataint01 is null THEN NULL
            ELSE concat_ws(' ',dataint01Request.syouhinbango,dataint01Request.jouhou) END  as req_dataint01,
        hikiatesyukko.dataint01,
        CASE
            WHEN temp_orderhenkan.soufusakiname is null THEN NULL
            ELSE concat(categorykanriSoufusakiname.category2,' ',categorykanriSoufusakiname.category4) END as soufusakiname,
        --to_char(temp_orderhenkan.sum_of_nyukingaku,'FM99,999,999,999,999') as sum_of_nyukingaku,

        --COALESCE(CASE
        --    WHEN (select SUM(daikinseisanold.nyukingaku) from daikinseisanold where daikinseisanold.otodoketime IN(select juchukubun2 from tuhanorder as temp_tuhanorder_1 where temp_tuhanorder_1.datatxt0130 = temp_tuhanorder.juchukubun2)) IS NOT NULL THEN (select SUM(daikinseisanold.nyukingaku) from daikinseisanold where daikinseisanold.otodoketime IN(select juchukubun2 from tuhanorder as temp_tuhanorder_2 where temp_tuhanorder_2.datatxt0130 = temp_tuhanorder.juchukubun2))
        --    ELSE (select SUM(daikinseisanold.nyukingaku) from daikinseisanold where daikinseisanold.otodoketime IN(select juchukubun2 from tuhanorder as temp_tuhanorder_3 where temp_tuhanorder_3.juchukubun2 = temp_tuhanorder.juchukubun2))
        --    END,0) as unpaidlist_sum_of_nyukingaku,

        temp_tuhanorder.juchukubun2,
        temp_tuhanorder.text1,
        COALESCE(temp_tuhanorder.numeric3,0) as numeric3,
        COALESCE(temp_tuhanorder.numeric4,0) as numeric4,

        --(select SUM(daikinseisanold.nyukingaku) as temp1_sum_of_nyukingaku from tuhanorder
        --left join daikinseisanold on daikinseisanold.otodoketime = tuhanorder.juchukubun2
        --where tuhanorder.datatxt0130 = temp_tuhanorder.juchukubun2
        --),
        --(select SUM(daikinseisanold.nyukingaku) as temp2_sum_of_nyukingaku from tuhanorder
        --left join daikinseisanold on daikinseisanold.otodoketime = tuhanorder.juchukubun2
        --where tuhanorder.juchukubun2 = temp_tuhanorder.juchukubun2
        --),

        --(COALESCE(temp_tuhanorder.numeric3,0) + COALESCE(temp_tuhanorder.numeric4,0)) -
        --COALESCE(CASE
        --    WHEN (select SUM(daikinseisanold.nyukingaku) from daikinseisanold where daikinseisanold.otodoketime IN(select juchukubun2 from tuhanorder as temp_tuhanorder_1 where temp_tuhanorder_1.datatxt0130 = temp_tuhanorder.juchukubun2)) IS NOT NULL THEN (select SUM(daikinseisanold.nyukingaku) from daikinseisanold where daikinseisanold.otodoketime IN(select juchukubun2 from tuhanorder as temp_tuhanorder_2 where temp_tuhanorder_2.datatxt0130 = temp_tuhanorder.juchukubun2))
        --    ELSE (select SUM(daikinseisanold.nyukingaku) from daikinseisanold where daikinseisanold.otodoketime IN(select juchukubun2 from tuhanorder as temp_tuhanorder_3 where temp_tuhanorder_3.juchukubun2 = temp_tuhanorder.juchukubun2))
        --    END,0) as unpaidlist_deposit_balance,

        temp_orderhenkan.max_moneymax,
        temp_orderhenkan.max_old_shinkurokokyakuorderbango,
        concat_ws(' ',soufusakinameRequest.syouhinbango,soufusakinameRequest.jouhou)  as req_soufusakiname,
        concat_ws(' ',soufusakiyubinbangoRequest.syouhinbango,soufusakiyubinbangoRequest.jouhou)  as req_soufusakiyubinbango

        from v_orderhenkan

        join temp_orderhenkan ON temp_orderhenkan.bango = v_orderhenkan.bango

        join orderhenkan on orderhenkan.bango = temp_orderhenkan.bango

        join tuhanorder as temp_tuhanorder on temp_tuhanorder.orderbango = temp_orderhenkan.bango

        join hikiatesyukko on  hikiatesyukko.orderbango = temp_orderhenkan.bango

        left join v_orderinfo on v_orderinfo.bango = temp_tuhanorder.orderbango
        AND v_orderinfo.juchubango = temp_tuhanorder.juchubango

        left join request as unsoutesuryouRequest on unsoutesuryouRequest.syouhinbango = temp_tuhanorder.unsoutesuryou
        AND unsoutesuryouRequest.color = '0412前受区分'

        left join request as dataint01Request on dataint01Request.syouhinbango = hikiatesyukko.dataint01
        AND dataint01Request.color = '0412入金完了フラグ'

        left join categorykanri as categorykanriSoufusakiname
        on substring(temp_orderhenkan.soufusakiname,1,2) = categorykanriSoufusakiname.category1
        and substring(temp_orderhenkan.soufusakiname,3,2) = categorykanriSoufusakiname.category2

        left join request as soufusakinameRequest on soufusakinameRequest.syouhinbango = temp_orderhenkan.old_soufusakiname::int
        AND soufusakinameRequest.color = '0412売掛残高更新フラグ'

        left join request as soufusakiyubinbangoRequest on soufusakiyubinbangoRequest.syouhinbango = temp_orderhenkan.old_soufusakiyubinbango::int
        AND soufusakiyubinbangoRequest.color = '0412請求残高更新フラグ'

        left join categorykanri as categorykanriDatachar02
        on substring(orderhenkan.datachar02,1,2) = categorykanriDatachar02.category1
        and substring(orderhenkan.datachar02,3,2) = categorykanriDatachar02.category2

        --information1
        left join v_torihikisaki as information1Detail on
        information1Detail.torihikisaki_cd = temp_tuhanorder.information1
        --information1 end

        --information2
        left join v_torihikisaki as information2Detail on
        information2Detail.torihikisaki_cd = temp_tuhanorder.information2
        --information2 end

        --information3
        left join v_torihikisaki as information3Detail on
        information3Detail.torihikisaki_cd = temp_tuhanorder.information3
        --information3 end

        ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS unpaid_list_parent_sum_of_numeric3_numeric4");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE unpaid_list_parent_sum_of_numeric3_numeric4 as
        select
        MAX(unpaid_list_temp.bango) as bango,
        MAX(unpaid_list_temp.bango) as parent_bango,
        --COALESCE(SUM(tuhanorder.numeric3+tuhanorder.numeric4),0) as sum_of_numeric3_numeric4,
        SUM(COALESCE(tuhanorder.numeric3,0)+COALESCE(tuhanorder.numeric4,0)) as sum_of_numeric3_numeric4,
        COALESCE(SUM(daikinseisanold.nyukingaku),0) as sum_of_nyukingaku
        from tuhanorder
        join unpaid_list_temp on unpaid_list_temp.juchukubun2 = tuhanorder.datatxt0130
        left join daikinseisanold on daikinseisanold.otodoketime = tuhanorder.datatxt0130
        where unpaid_list_temp.text1 = 'U510'
        group by datatxt0130
        ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS unpaid_list_parent_sum_of_numeric3_numeric4_2");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE unpaid_list_parent_sum_of_numeric3_numeric4_2 as
        select
        MAX(unpaid_list_temp.bango) as bango,
        COALESCE(SUM(daikinseisanold.nyukingaku),0) as sum_of_nyukingaku
        from tuhanorder
        join unpaid_list_temp on unpaid_list_temp.juchukubun2 = tuhanorder.datatxt0130
        left join daikinseisanold on daikinseisanold.otodoketime = tuhanorder.juchukubun2
        where unpaid_list_temp.text1 = 'U510'
        group by datatxt0130
        ");
        //$reviewData = QueryHelper::fetchResult("select * from unpaid_list_parent_sum_of_numeric3_numeric4_2");
        //dd($reviewData);

        QueryHelper::runQuery("DROP TABLE IF EXISTS unpaid_list_child_sum_of_numeric3_numeric4");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE unpaid_list_child_sum_of_numeric3_numeric4 as
        select
        unpaid_list_temp.bango as bango,
        unpaid_list_temp.bango as child_bango,
        --COALESCE(SUM(tuhanorder.numeric3+tuhanorder.numeric4),0) as sum_of_numeric3_numeric4
        --COALESCE(tuhanorder.numeric3+tuhanorder.numeric4,0) as sum_of_numeric3_numeric4,
        (COALESCE(tuhanorder.numeric3,0)+COALESCE(tuhanorder.numeric4,0)) as sum_of_numeric3_numeric4,
        (select COALESCE(SUM(temp_daknseisanold.nyukingaku),0) from daikinseisanold as temp_daknseisanold where temp_daknseisanold.otodoketime = tuhanorder.juchukubun2 group by temp_daknseisanold.otodoketime) as sum_of_nyukingaku
        from tuhanorder
        join unpaid_list_temp on unpaid_list_temp.bango = tuhanorder.orderbango
        where unpaid_list_temp.text1 != 'U510'
        --group by datatxt0130
        ");
       // $reviewData = QueryHelper::fetchResult("select * from unpaid_list_child_sum_of_numeric3_numeric4");
      //  dd($reviewData);

//        QueryHelper::runQuery("DROP TABLE IF EXISTS unpaid_list_temp2");
//        QueryHelper::runQuery(
//        "CREATE TEMPORARY TABLE unpaid_list_temp2 as
//        select
//        unpaid_list_temp.bango,
//        tuhanorder.datatxt0130,
//        SUM(daikinseisanold.nyukingaku) as temp1_sum_of_nyukingaku
//        from tuhanorder
//        join unpaid_list_temp on unpaid_list_temp.bango = tuhanorder.orderbango
//        left join daikinseisanold on daikinseisanold.otodoketime = tuhanorder.juchukubun2
//        where tuhanorder.datatxt0130 = unpaid_list_temp.juchukubun2
//        group by bango,datatxt0130
//        ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS unpaid_list_temp2");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE unpaid_list_temp2 as
        select
        MAX(unpaid_list_temp.bango) as bango,
        --tuhanorder.datatxt0130,
        COALESCE(SUM(daikinseisanold.nyukingaku),0) as temp1_sum_of_nyukingaku
        from tuhanorder
        join unpaid_list_temp on unpaid_list_temp.bango = tuhanorder.orderbango
        left join daikinseisanold on daikinseisanold.otodoketime = tuhanorder.juchukubun2
        where
            CASE
              WHEN tuhanorder.text1 != 'U523' THEN  tuhanorder.datatxt0130 = unpaid_list_temp.juchukubun2
              ELSE tuhanorder.juchukubun2 = unpaid_list_temp.juchukubun2 END
        group by
            CASE
                WHEN tuhanorder.text1 != 'U523' THEN  daikinseisanold.otodoketime
                ELSE datatxt0130 END
        ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS unpaid_list_temp3");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE unpaid_list_temp3 as
        select
        unpaid_list_temp.bango,
        tuhanorder.juchukubun2,
        SUM(daikinseisanold.nyukingaku) as temp2_sum_of_nyukingaku

        from tuhanorder
        join unpaid_list_temp on unpaid_list_temp.bango = tuhanorder.orderbango
        left join daikinseisanold on daikinseisanold.otodoketime = tuhanorder.juchukubun2
        where tuhanorder.juchukubun2 = unpaid_list_temp.juchukubun2 AND datatxt0130 IS NULL
        group by bango,tuhanorder.juchukubun2
        ");

        $orderBy = "";
        if(isset($req_data['rd2']) && $req_data['rd2'] == "rd2_1"){
            $orderBy .= " ORDER BY intorder03 asc ";
        }else if(isset($req_data['rd2']) && $req_data['rd2'] == "rd2_2"){
            $orderBy .= " ORDER BY intorder05 asc ";
        }else{
            $orderBy .= " ORDER BY datachar05 asc ";
        }

        QueryHelper::runQuery("DROP TABLE IF EXISTS unpaid_list");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE unpaid_list as
        select
        unpaid_list_temp.*,
        unpaid_list_parent_sum_of_numeric3_numeric4.parent_bango,
        unpaid_list_parent_sum_of_numeric3_numeric4.sum_of_nyukingaku as parent_sum_of_nyukingaku,
        unpaid_list_child_sum_of_numeric3_numeric4.child_bango,
        unpaid_list_child_sum_of_numeric3_numeric4.sum_of_nyukingaku,
        CASE
            WHEN unpaid_list_parent_sum_of_numeric3_numeric4.parent_bango is not null THEN (unpaid_list_parent_sum_of_numeric3_numeric4.sum_of_numeric3_numeric4)
            ELSE (unpaid_list_child_sum_of_numeric3_numeric4.sum_of_numeric3_numeric4) END as unpaidlist_sales_amount,
        --COALESCE(CASE
        --    WHEN unpaid_list_temp2.temp1_sum_of_nyukingaku IS NOT NULL THEN unpaid_list_temp2.temp1_sum_of_nyukingaku
        --    ELSE unpaid_list_temp3.temp2_sum_of_nyukingaku END,0) as unpaidlist_sum_of_nyukingaku,

        COALESCE(CASE
                WHEN unpaid_list_parent_sum_of_numeric3_numeric4.parent_bango is not null THEN unpaid_list_parent_sum_of_numeric3_numeric4_2.sum_of_nyukingaku
                ELSE unpaid_list_child_sum_of_numeric3_numeric4.sum_of_nyukingaku END,0) as unpaidlist_sum_of_nyukingaku,

        --((unpaid_list_temp.numeric3 + unpaid_list_temp.numeric4) -
        --COALESCE(CASE
        --    WHEN unpaid_list_temp2.temp1_sum_of_nyukingaku IS NOT NULL THEN unpaid_list_temp2.temp1_sum_of_nyukingaku
        --    ELSE unpaid_list_temp3.temp2_sum_of_nyukingaku END,0)
        --    ) as unpaidlist_deposit_balance

        --COALESCE(unpaid_list_parent_sum_of_numeric3_numeric4.sum_of_numeric3_numeric4 - COALESCE(unpaid_list_temp2.temp1_sum_of_nyukingaku,0),0) as unpaidlist_deposit_balance
        COALESCE(
        CASE
            WHEN unpaid_list_parent_sum_of_numeric3_numeric4.parent_bango is not null THEN (unpaid_list_parent_sum_of_numeric3_numeric4.sum_of_numeric3_numeric4)
            ELSE (unpaid_list_child_sum_of_numeric3_numeric4.sum_of_numeric3_numeric4) END
            -
            COALESCE(
            CASE
                WHEN unpaid_list_parent_sum_of_numeric3_numeric4.parent_bango is not null THEN unpaid_list_parent_sum_of_numeric3_numeric4_2.sum_of_nyukingaku
                ELSE unpaid_list_child_sum_of_numeric3_numeric4.sum_of_nyukingaku END
            ,0)
        ,0) as unpaidlist_deposit_balance

        from unpaid_list_temp
        --left join unpaid_list_temp2 on unpaid_list_temp2.bango = unpaid_list_temp.bango
        --left join unpaid_list_temp3 on unpaid_list_temp3.bango = unpaid_list_temp.bango
        left join unpaid_list_parent_sum_of_numeric3_numeric4 on unpaid_list_parent_sum_of_numeric3_numeric4.bango = unpaid_list_temp.bango
        left join unpaid_list_parent_sum_of_numeric3_numeric4_2 on unpaid_list_parent_sum_of_numeric3_numeric4_2.bango = unpaid_list_temp.bango
        left join unpaid_list_child_sum_of_numeric3_numeric4 on unpaid_list_child_sum_of_numeric3_numeric4.bango = unpaid_list_temp.bango
        $orderBy
        ");

        $sql = "";
        if(isset($req_data['intorder05_start']) && ($req_data['intorder05_start']!="" && $req_data['intorder05_end']!="")){
            $start_date = str_replace('/','',$req_data['intorder05_start']);
            $end_date = str_replace('/','',$req_data['intorder05_end']);
            $sql .= " AND intorder05::text between '$start_date' and '$end_date' ";
        }

        if(isset($req_data['intorder03_start']) && ($req_data['intorder03_start']!="" && $req_data['intorder03_end']!="")){
            $intorder03_start_date = str_replace('/','',$req_data['intorder03_start']);
            $intorder03_end_date = str_replace('/','',$req_data['intorder03_end']);
            $sql .= " AND intorder03::text between '$intorder03_start_date' and '$intorder03_end_date' ";

        }

        if(isset($req_data['division_datachar05_start']) && ($req_data['division_datachar05_start']!="" && $req_data['division_datachar05_end']!="")){
            $division_start_date = substr($req_data['division_datachar05_start'], 4,2);
            $division_end_date = substr($req_data['division_datachar05_end'], 4,2);
            $sql .= "AND substring(datatxt0003::text,1,2)='B9' AND right(datatxt0003::text,2) between '$division_start_date' and '$division_end_date' ";
        }

        if(isset($req_data['department_datachar05_start']) && ($req_data['department_datachar05_start']!="" && $req_data['department_datachar05_end']!="")){
            $department_start_date =substr($req_data['department_datachar05_start'], 4,3);
            $department_end_date = substr($req_data['department_datachar05_end'], 4,3);
            $sql .= "AND substring(datatxt0004::text,1,2)='C1' AND right(datatxt0004::text,3) between '$department_start_date' and '$department_end_date' ";
        }

        if(isset($req_data['group_datachar05_start']) && ($req_data['group_datachar05_start']!="" && $req_data['group_datachar05_end']!="")){
            $group_start_date = substr($req_data['group_datachar05_start'], 4,4);
            $group_end_date = substr($req_data['group_datachar05_end'], 4,4);
            $sql .= "AND substring(datatxt0005::text,1,2)='C2' AND right(datatxt0005::text ,4) between '$group_start_date' and '$group_end_date' ";
        }

        if(isset($req_data['rd1']) && $req_data['rd1']=="rd1_1"){
            //$data=DB::table('unpaid_list')->whereRaw("unsoudaibikitesuryou = 1 AND dataint01 = 2 $sql");
            $data=DB::table('unpaid_list')->whereRaw("dataint01 = 2 $sql");
        }else{
           //$data=DB::table('unpaid_list')->whereRaw("unsoudaibikitesuryou = 1 $sql");
           $sql = ltrim($sql, ' AND');
           $data=DB::table('unpaid_list')->whereRaw("$sql");
        }

        return $data;

    }
}
