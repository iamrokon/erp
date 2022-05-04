<?php

namespace App\AllClass\order\orderHistory;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\kengen;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class allOrderHistory{
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
        //    $sql = " where orderhenkan.bango IN ($bango)";
        //}else{
            //$sql = "";
            //if(isset($req_data['intorder01_start']) && ($req_data['intorder01_start']!="" && $req_data['intorder01_end']!="")){
            //    $start_date = str_replace('/','',$req_data['intorder01_start']);
            //    $end_date = str_replace('/','',$req_data['intorder01_end']);
            //    $sql .= " where orderhenkan.intorder01::text between '$start_date' and '$end_date' ";
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
            
            //if(isset($req_data['kokyakuorderbango_start']) && ($req_data['kokyakuorderbango_start']!="" && $req_data['kokyakuorderbango_end']!="")){
            //    $kokyakuorderbango_start = $req_data['kokyakuorderbango_start'];
            //    $kokyakuorderbango_end = $req_data['kokyakuorderbango_end'];
            //    if(strlen($sql)>0){
            //        $sql .= "AND orderhenkan.kokyakuorderbango >= '$kokyakuorderbango_start' and orderhenkan.kokyakuorderbango <= '$kokyakuorderbango_end' ";
            //    }else{
            //        $sql .= "where orderhenkan.kokyakuorderbango >= '$kokyakuorderbango_start' and orderhenkan.kokyakuorderbango <= '$kokyakuorderbango_end' ";
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
            
            //if(isset($req_data['rd2']) && $req_data['rd2']=="rd2_1"){
            //    $datachar02 = "10,11,22,50";
            //    if(strlen($sql)>0){
            //        $sql .= " AND CAST(SPLIT_PART(orderhenkan.datachar02,'U1',2) as integer) IN ($datachar02) ";
            //    }else{
            //        $sql .= " where CAST(SPLIT_PART(orderhenkan.datachar02,'U1',2) as integer) IN ($datachar02) ";
            //    }
            //}
            
            //if(isset($req_data['rd2']) && $req_data['rd2']=="rd2_2"){
            //    $datachar02 = "10,11,50,60,70,80,81";
            //    if(strlen($sql)>0){
            //        $sql .= " AND CAST(SPLIT_PART(orderhenkan.datachar02,'U1',2) as integer) IN ($datachar02) ";
            //    }else{
            //        $sql .= " where CAST(SPLIT_PART(orderhenkan.datachar02,'U1',2) as integer) IN ($datachar02) ";
            //    }
            //}
            
            //if(isset($req_data['rd2']) && $req_data['rd2']=="rd2_3"){
            //    $datachar02 = "20,23";
            //    if(strlen($sql)>0){
            //        $sql .= " AND CAST(SPLIT_PART(orderhenkan.datachar02,'U1',2) as integer) IN ($datachar02) ";
            //    }else{
            //        $sql .= " where CAST(SPLIT_PART(orderhenkan.datachar02,'U1',2) as integer) IN ($datachar02) ";
            //    }
            //}
            
            //if(isset($req_data['rd2']) && $req_data['rd2']=="rd2_4"){
            //    $datachar02 = "21";
            //    if(strlen($sql)>0){
            //        $sql .= " AND CAST(SPLIT_PART(orderhenkan.datachar02,'U1',2) as integer) IN ($datachar02) ";
            //    }else{
            //        $sql .= " where CAST(SPLIT_PART(orderhenkan.datachar02,'U1',2) as integer) IN ($datachar02) ";
            //    }
            //}
            
            //$sql .= "AND orderhenkan.bango NOT IN (select bango from orderhenkan where kokyakuorderbango IN (select kokyakuorderbango from orderhenkan where synchroorderbango = 1))";
        //}

        QueryHelper::runQuery("DROP TABLE IF EXISTS order_history_temp");
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_m");
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_delete_check");
        QueryHelper::runQuery("DROP TABLE IF EXISTS order_history_before_temp");
        
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_m as
        select distinct 
        kokyakuorderbango, max(ordertypebango2) as maxval
        from orderhenkan
        where synchroorderbango =0 
        group by kokyakuorderbango");
        
        //deleted kokyakuorderbango
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_delete_check as
        select  
        kokyakuorderbango
        from orderhenkan
        where synchroorderbango = 1 
        ");
        
        QueryHelper::runQuery("CREATE TEMPORARY TABLE order_history_before_temp as
        select  
        orderhenkan.bango,
        v_orderhenkan.datachar05,
        v_orderhenkan.datatxt0003,
        v_orderhenkan.datatxt0004,
        v_orderhenkan.datatxt0005
        from orderhenkan
        JOIN v_orderhenkan
            ON v_orderhenkan.kokyakuorderbango = orderhenkan.kokyakuorderbango
            AND v_orderhenkan.bango = orderhenkan.bango            
        ");
        

        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE order_history_temp as
        select distinct 
        --on (orderhenkan.kokyakuorderbango)
        orderhenkan.bango,
        orderhenkan.datachar02,
        CASE
            WHEN trim(orderhenkan.datachar02) = '' THEN NULL
            ELSE trim(categorykanriDatachar02.category4) END as datachar02_detail,
        order_history_before_temp.datachar05,
        order_history_before_temp.datatxt0003,
        order_history_before_temp.datatxt0004,
        order_history_before_temp.datatxt0005,
        tantousya.name as user_name,
        replace(replace(tantousya.name,' ',''),'　','') as user_name_search,
        substring(replace(replace(tantousya.name,' ',''),'　',''),1,3) as user_name_short,
        orderhenkan.kokyakuorderbango,
        orderhenkan.ordertypebango2,
        orderhenkan.ordertypebango2 as initial_ordertypebango2,
        concat_ws(' ',substring(orderhenkan.datachar01,1,1),orderhenkanDtchar01Request.jouhou) as datachar01,
        orderhenkan.datachar03 as order_history_datachar03,
        orderhenkan.datachar04 as order_history_datachar04,
        orderhenkan.datachar08 as order_history_datachar08,
        orderhenkan.datachar09 as order_history_datachar09,
        orderhenkan.datachar10,
        orderhenkan.synchroorderbango,
        CASE
            WHEN orderhenkan.intorder01::text is null THEN NULL
            ELSE concat_ws('/',substring(orderhenkan.intorder01::text,1,4),
            substring(orderhenkan.intorder01::text,5,2),
            substring(orderhenkan.intorder01::text,7,2)) END as intorder01 ,
        CASE
            WHEN orderhenkan.intorder03::text is null THEN NULL
            ELSE concat_ws('/',substring(orderhenkan.intorder03::text,1,4),
            substring(orderhenkan.intorder03::text,5,2),
            substring(orderhenkan.intorder03::text,7,2)) END as intorder03 ,
        CASE
            WHEN orderhenkan.intorder04::text is null THEN NULL
            ELSE concat_ws('/',substring(orderhenkan.intorder04::text,1,4),
            substring(orderhenkan.intorder04::text,5,2),
            substring(orderhenkan.intorder04::text,7,2)) END as intorder04 ,
        CASE
            WHEN orderhenkan.intorder05::text is null THEN NULL
            ELSE concat_ws('/',substring(orderhenkan.intorder05::text,1,4),
            substring(orderhenkan.intorder05::text,5,2),
            substring(orderhenkan.intorder05::text,7,2)) END as intorder05, 
        replace(substring(orderhenkan.date::text,1,10),'-','/') as registration_date,
        substring(orderhenkan.date::text,12,8) as registration_time,
        orderuserbangoTantousya.name as changer,
        substr(replace(replace(orderuserbangoTantousya.name,' ',''),'　',''),1,3) as changer_short,
            
        v_orderinfo.juchukubun1 as juchukubun1,
        v_orderinfo.r15 as juchukubun1_short,
        tuhanorder.chumonbango,
        tuhanorder.information1,
        information1Detail.r17_4 as information1_detail,
        --concat_ws('/',kokyaku1Information1.address,haisouInformation1.haisoumoji1,etsuransyaInformation1.mail4) as information1_detail,
        tuhanorder.information2,
        information2Detail.r17_4 as information2_detail,
        tuhanorder.information3,
        information3Detail.r17_4 as information3_detail,
        tuhanorder.information4,
        information4Detail.r17_4 as information4_detail,
        tuhanorder.information5,
        information5Detail.r17_4 as information5_detail,
        tuhanorder.information6,
        information6Detail.r17_4 as information6_detail,
        CASE
            WHEN trim(tuhanorder.kessaihouhou) = '' THEN NULL
            ELSE trim(categorykanriKessaihouhou.category2 || ' ' || categorykanriKessaihouhou.category4) END as kessaihouhou_detail,
        orderhenkan_m.maxval,
        CASE
            WHEN orderhenkan_m.maxval IS NULL THEN NULL
            ELSE 1 END as active_order_flag,  
        CASE
            WHEN orderhenkan_delete_check.kokyakuorderbango IS NULL THEN NULL
            ELSE 2 END as delete_status, 
        concat_ws(' ',substring(tuhanorder.housoukubun,1,1),housoukubunRequest.jouhou)  as housoukubun,
        CASE
            WHEN trim(tuhanorder.chumonsyajouhou) = '' THEN NULL
            ELSE concat(categorykanriChumonsyajouhou.category2 ,' ',categorykanriChumonsyajouhou.category4) END as chumonsyajouhou_detail,
        categorykanriEndCusSource.groupbango as end_cus_source,
        requestEndCusUser.jouhou as end_cus_user,
        tuhanorder.money10,
        to_char(tuhanorder.money10,'FM99,999,999,999,999') as formatted_money10,
        
        --( SELECT SUM(tuhanorder.money10) 
        --    FROM orderhenkan 
        --    JOIN tuhanorder 
        --    ON tuhanorder.orderbango = orderhenkan.bango
        --) AS order_amount,
        
        tuhanorder.moneymax,
        to_char(tuhanorder.moneymax,'FM99,999,999,999,999') as formatted_moneymax,
        CASE
            WHEN substring(kokyaku1Information3.kcode4,1,1)::int=4 AND substring(tantousya.syozoku,1,1)::int=1 THEN 
                CASE
                WHEN haisoujouhou.name is null THEN NULL
                ELSE concat_ws('/',substring(haisoujouhou.name,1,4),
                substring(haisoujouhou.name,5,2),
                substring(haisoujouhou.name,7,2))
                END
            WHEN substring(kokyaku1Information3.kcode4,1,1)::int=4 AND substring(tantousya.syozoku,1,1)::int=2 THEN 
                CASE
                WHEN haisoujouhou.kaiinbango is null THEN NULL
                ELSE concat_ws('/',substring(haisoujouhou.kaiinbango,1,4),
                substring(haisoujouhou.kaiinbango,5,2),
                substring(haisoujouhou.kaiinbango,7,2))
                END
            WHEN substring(kokyaku1Information3.kcode4,1,1)::int!=4 AND substring(tantousya.syozoku,1,1)::int=1 THEN 
                CASE
                WHEN haisoujouhou.yubinbango is null THEN NULL
                ELSE concat_ws('/',substring(haisoujouhou.yubinbango,1,4),
                substring(haisoujouhou.yubinbango,5,2),
                substring(haisoujouhou.yubinbango,7,2))
                END
            WHEN substring(kokyaku1Information3.kcode4,1,1)::int!=4 AND substring(tantousya.syozoku,1,1)::int=2 THEN 
                CASE
                WHEN haisoujouhou.zokugara is null THEN NULL
                ELSE concat_ws('/',substring(haisoujouhou.zokugara,1,4),
                substring(haisoujouhou.zokugara,5,2),
                substring(haisoujouhou.zokugara,7,2))
                END
        END
            as trading_start_date,
        CASE
            WHEN substring(kokyaku1Information1.kcode4,1,1)::int=4 AND substring(tantousya.syozoku,1,1)::int=1 THEN 
                CASE
                WHEN haisoujouhouInfo1.name is null THEN NULL
                ELSE concat_ws('/',substring(haisoujouhouInfo1.name,1,4),
                substring(haisoujouhouInfo1.name,5,2),
                substring(haisoujouhouInfo1.name,7,2))
                END
            WHEN substring(kokyaku1Information1.kcode4,1,1)::int=4 AND substring(tantousya.syozoku,1,1)::int=2 THEN 
                CASE
                WHEN haisoujouhouInfo1.kaiinbango is null THEN NULL
                ELSE concat_ws('/',substring(haisoujouhouInfo1.kaiinbango,1,4),
                substring(haisoujouhouInfo1.kaiinbango,5,2),
                substring(haisoujouhouInfo1.kaiinbango,7,2))
                END
            WHEN substring(kokyaku1Information1.kcode4,1,1)::int!=4 AND substring(tantousya.syozoku,1,1)::int=1 THEN 
                CASE
                WHEN haisoujouhouInfo1.yubinbango is null THEN NULL
                ELSE concat_ws('/',substring(haisoujouhouInfo1.yubinbango,1,4),
                substring(haisoujouhouInfo1.yubinbango,5,2),
                substring(haisoujouhouInfo1.yubinbango,7,2))
                END
            WHEN substring(kokyaku1Information1.kcode4,1,1)::int!=4 AND substring(tantousya.syozoku,1,1)::int=2 THEN 
                CASE
                WHEN haisoujouhouInfo1.zokugara is null THEN NULL
                ELSE concat_ws('/',substring(haisoujouhouInfo1.zokugara,1,4),
                substring(haisoujouhouInfo1.zokugara,5,2),
                substring(haisoujouhouInfo1.zokugara,7,2))
                END
        END
            as trading_end_date,
        
        hikiatesyukko.datachar01  as hktsyukko_datachar01,
        concat_ws(' ',substring(hikiatesyukko.datachar01,1,1),datachar01Request.jouhou) as hktsyukko_datachar01_detail,
        hikiatesyukko.datachar04 as hktsyukko_datachar04,
        concat_ws(' ',substring(hikiatesyukko.datachar04,1,1),datachar04Request.jouhou)  as hktsyukko_datachar04_detail,
        hikiatesyukko.datachar06 as hktsyukko_datachar06,
        concat_ws(' ',substring(hikiatesyukko.datachar06,1,1),datachar06Request.jouhou) as hktsyukko_datachar06_detail,
        hikiatesyukko.datachar08 as hktsyukko_datachar08,
        concat_ws(' ',substring(hikiatesyukko.datachar08,1,1),datachar08Request.jouhou)  as hktsyukko_datachar08_detail,
        concat_ws(' ',substring(hikiatesyukko.datachar09,1,1),datachar09Request.jouhou)  as hktsyukko_datachar09_detail,
        concat_ws(' ',substring(hikiatesyukko.datachar10,1,1),datachar10Request.jouhou)  as hktsyukko_datachar10_detail,
        hikiatesyukko.datachar09 as hktsyukko_datachar09,
        hikiatesyukko.datachar10 as hktsyukko_datachar10,
        CASE
            WHEN hikiatesyukko.datachar16 = '1' THEN '1 済'
            WHEN hikiatesyukko.datachar16 = '2' THEN '2 未'
            ELSE hikiatesyukko.datachar16 END as datachar16,
        datachar17Tantousya.name as datachar17_tan_name,
        replace(replace(datachar17Tantousya.name,' ',''),'　','') as datachar17_tan_name_search,
        substr(replace(replace(datachar17Tantousya.name,' ',''),'　',''),1,3) as datachar17_tan_name_short,
        datachar18Tantousya.name as datachar18_tan_name,
        replace(replace(datachar18Tantousya.name,' ',''),'　','') as datachar18_tan_name_search,
        substr(replace(replace(datachar18Tantousya.name,' ',''),'　',''),1,3) as datachar18_tan_name_short,
        datachar02Tantousya.name as datachar02_tan_name,
        replace(replace(datachar02Tantousya.name,' ',''),'　','') as datachar02_tan_name_search,
        substr(replace(replace(datachar02Tantousya.name,' ',''),'　',''),1,3) as datachar02_tan_name_short,
        datachar03Tantousya.name as datachar03_tan_name,
        replace(replace(datachar03Tantousya.name,' ',''),'　','') as datachar03_tan_name_search,
        substr(replace(replace(datachar03Tantousya.name,' ',''),'　',''),1,3) as datachar03_tan_name_short,
        datachar05Tantousya.name as datachar05_tan_name,
        replace(replace(datachar05Tantousya.name,' ',''),'　','') as datachar05_tan_name_search,
        substr(replace(replace(datachar05Tantousya.name,' ',''),'　',''),1,3) as datachar05_tan_name_short,
        datachar07Tantousya.name as datachar07_tan_name,
        replace(replace(datachar07Tantousya.name,' ',''),'　','') as datachar07_tan_name_search,
        substr(replace(replace(datachar07Tantousya.name,' ',''),'　',''),1,3) as datachar07_tan_name_short,
        CASE
            WHEN trim(tuhanorder.information3) = '' THEN NULL
            ELSE trim(categorykanriTOinformation3.category2 || ' ' || categorykanriTOinformation3.category4) END as koyk1_domain,
        CASE
            WHEN trim(tuhanorder.information3) = '' THEN NULL
            ELSE trim(categorykanriTOinfo3Dom2.category2 || ' ' || categorykanriTOinfo3Dom2.category4) END as koyk1_domain2,
        CASE
            WHEN hikiatesyukko.tanabango is null THEN NULL
            ELSE concat_ws('/',substring(hikiatesyukko.tanabango,1,4),
            substring(hikiatesyukko.tanabango,5,2),
            substring(hikiatesyukko.tanabango,7,2)) END as tanabango_date,
        CASE
            WHEN hikiatesyukko.tanabango is null THEN NULL
            ELSE concat_ws(':',substring(hikiatesyukko.tanabango,9,2),
            substring(hikiatesyukko.tanabango,11,2),
            substring(hikiatesyukko.tanabango,13,2)) END as tanabango_time,
        CASE
            WHEN hikiatesyukko.idoutanabango is null THEN NULL
            ELSE concat_ws('/',substring(hikiatesyukko.idoutanabango,1,4),
            substring(hikiatesyukko.idoutanabango,5,2),
            substring(hikiatesyukko.idoutanabango,7,2)) END as update_date,

        CASE
            WHEN hikiatesyukko.idoutanabango is null THEN NULL
            ELSE concat_ws(':',substring(hikiatesyukko.idoutanabango,9,2),
            substring(hikiatesyukko.idoutanabango,11,2),
            substring(hikiatesyukko.idoutanabango,13,2)) END as update_time,
        tantousyabangoTantousya.name as tantousyabango,
        substr(replace(replace(tantousyabangoTantousya.name,' ',''),'　',''),1,3) as tantousyabango_short
            
        from orderhenkan
        
        join order_history_before_temp ON order_history_before_temp.bango = orderhenkan.bango
        
        left join tuhanorder on tuhanorder.orderbango = orderhenkan.bango
        AND tuhanorder.juchubango = orderhenkan.kokyakuorderbango
        
        left join v_orderinfo on v_orderinfo.bango = tuhanorder.orderbango
        AND v_orderinfo.juchubango = tuhanorder.juchubango
        
        --left join hikiatesyukko on  hikiatesyukko.orderbango = orderhenkan.bango
        left join hikiatesyukko on  hikiatesyukko.syouhinid = orderhenkan.kokyakuorderbango
        AND hikiatesyukko.orderbango = orderhenkan.bango
        
        left join tantousya on order_history_before_temp.datachar05 = tantousya.bango
        
        left join tantousya as orderuserbangoTantousya on orderuserbangoTantousya.bango = orderhenkan.orderuserbango
        
        left join tantousya as datachar02Tantousya on datachar02Tantousya.bango = hikiatesyukko.datachar02
        
        left join tantousya as datachar03Tantousya on datachar03Tantousya.bango = hikiatesyukko.datachar03
        
        left join tantousya as datachar17Tantousya on datachar17Tantousya.bango = hikiatesyukko.datachar17
        
        left join tantousya as datachar18Tantousya on datachar18Tantousya.bango = hikiatesyukko.datachar18
        
        left join tantousya as tantousyabangoTantousya on tantousyabangoTantousya.bango = hikiatesyukko.tantousyabango

        left join request as orderhenkanDtchar01Request on orderhenkanDtchar01Request.syouhinbango::text = substring(orderhenkan.datachar01,1,1)
        AND orderhenkanDtchar01Request.color = '0201作成区分'

        left join request as datachar01Request on datachar01Request.syouhinbango = substring(hikiatesyukko.datachar01,1,1)::int
        AND datachar01Request.color = '0201売上・検印フェーズ'

        left join request as datachar04Request on datachar04Request.syouhinbango = substring(hikiatesyukko.datachar04,1,1)::int
        AND datachar04Request.color = '0201伝票作成フラグ'
        
        left join tantousya as datachar05Tantousya on datachar05Tantousya.bango = hikiatesyukko.datachar05
        
        left join request as datachar06Request on datachar06Request.syouhinbango = substring(hikiatesyukko.datachar06,1,1)::int
        AND datachar06Request.color = '0201検収書確認フラグ'
        
        left join tantousya as datachar07Tantousya on datachar07Tantousya.bango = hikiatesyukko.datachar07
        
        left join request as datachar08Request on datachar08Request.syouhinbango = substring(hikiatesyukko.datachar08,1,1)::int
        AND datachar08Request.color = '0201受注実績作成フラグ'
        
        left join request as datachar09Request on datachar09Request.syouhinbango = substring(hikiatesyukko.datachar09,1,1)::int
        AND datachar09Request.color = '0201売上伝票メール送信フラグ'
        
        left join request as datachar10Request on datachar10Request.syouhinbango = substring(hikiatesyukko.datachar10,1,1)::int
        AND datachar10Request.color = '0201売上伝票PDFダウンロードフラグ'
        
        left join request as housoukubunRequest on housoukubunRequest.syouhinbango = substring(tuhanorder.housoukubun,1,1)::int
        AND housoukubunRequest.color = '0201即時区分'

        left join orderhenkan_m on
        orderhenkan_m.kokyakuorderbango=orderhenkan.kokyakuorderbango
        and orderhenkan_m.maxval=orderhenkan.ordertypebango2
        
        left join orderhenkan_delete_check on
        orderhenkan_delete_check.kokyakuorderbango = orderhenkan.kokyakuorderbango
        
        
        left join categorykanri as categorykanriDatachar02
        on substring(orderhenkan.datachar02,1,2) = categorykanriDatachar02.category1
        and substring(orderhenkan.datachar02,3,4) = categorykanriDatachar02.category2
        
        --information1
        left join kokyaku1 as kokyaku1Information1
        on substring(tuhanorder.information1,1,6) = kokyaku1Information1.yobi12
        
        left join v_torihikisaki as information1Detail on
        information1Detail.torihikisaki_cd = tuhanorder.information1
        --information1 end
        
        --information2
        left join v_torihikisaki as information2Detail on
        information2Detail.torihikisaki_cd = tuhanorder.information2
        --information2 end
        
        --information3
        left join kokyaku1 as kokyaku1Information3
        on substring(tuhanorder.information3,1,6) = kokyaku1Information3.yobi12
        
        left join v_torihikisaki as information3Detail on
        information3Detail.torihikisaki_cd = tuhanorder.information3
        --information3 end
        
        --information4
        left join v_torihikisaki as information4Detail on
        information4Detail.torihikisaki_cd = tuhanorder.information4
        --information4 end
        
        --information5
        left join v_torihikisaki as information5Detail on
        information5Detail.torihikisaki_cd = tuhanorder.information5
        --information5 end
        
        --information6
        left join v_torihikisaki as information6Detail on
        information6Detail.torihikisaki_cd = tuhanorder.information6
        --information6 end
        
        --tuhanorder information3 koyaku1 domain
        left join categorykanri as categorykanriTOinformation3
        on substring(kokyaku1Information3.domain,1,2) = categorykanriTOinformation3.category1
        and substring(kokyaku1Information3.domain,3,2) = categorykanriTOinformation3.category2
        --tuhanorder information3 koyaku1 domain end
        
        --tuhanorder information3 koyaku1 domain2
        left join categorykanri as categorykanriTOinfo3Dom2
        on substring(kokyaku1Information3.domain2,1,2) = categorykanriTOinfo3Dom2.category1
        and substring(kokyaku1Information3.domain2,3,2) = categorykanriTOinfo3Dom2.category2
        --tuhanorder information3 koyaku1 domain2 end
        
        left join categorykanri as categorykanriKessaihouhou
        on substring(tuhanorder.kessaihouhou,1,2) = categorykanriKessaihouhou.category1
        and substring(tuhanorder.kessaihouhou,3,2) = categorykanriKessaihouhou.category2
        
        left join categorykanri as categorykanriChumonsyajouhou
        on substring(tuhanorder.chumonsyajouhou,1,2) = categorykanriChumonsyajouhou.category1
        and substring(tuhanorder.chumonsyajouhou,3,1) = categorykanriChumonsyajouhou.category2
        
        left join categorykanri as categorykanriEndCusSource
        on substring(kokyaku1Information3.kcode5,1,2) = categorykanriEndCusSource.category1
        and substring(kokyaku1Information3.kcode5,3,4) = categorykanriEndCusSource.category2
        
        left join request as requestEndCusUser
        on CAST(SPLIT_PART(kokyaku1Information3.kcode4,' ',1) as integer) = requestEndCusUser.syouhinbango
        and SPLIT_PART(kokyaku1Information3.kcode4,' ',2) = requestEndCusUser.jouhou
        
        left join haisoujouhou on haisoujouhou.syukei1 = kokyaku1Information3.bango
        
        left join haisoujouhou as haisoujouhouInfo1 on haisoujouhouInfo1.syukei1 = kokyaku1Information1.bango
                   
        ORDER BY user_name,datachar02_detail,kokyakuorderbango,ordertypebango2 ASC
        ");

        if(isset($req_data['rd2']) && $req_data['rd2']=="rd2_1"){
            $datachar02 = "10,11,22,50";
        }elseif(isset($req_data['rd2']) && $req_data['rd2']=="rd2_2"){
            $datachar02 = "10,11,50,60,70,80,81";
        }elseif(isset($req_data['rd2']) && $req_data['rd2']=="rd2_3"){
            $datachar02 = "20,23";  
        }elseif(isset($req_data['rd2']) && $req_data['rd2']=="rd2_4"){
            $datachar02 = "21";
        }
        $start_date = $req_data['intorder01_start'];
        $end_date = $req_data['intorder01_end'];
        $division_start_date = substr($req_data['division_datachar05_start'], 4,2);
        $division_end_date = substr($req_data['division_datachar05_end'], 4,2);
        //$sql = "CAST(SPLIT_PART(datachar02,'U1',2) as integer) IN ($datachar02) AND (intorder01::text between '$start_date' and '$end_date') AND substring(datatxt0003::text,1,2)='B9' AND right(datatxt0003::text,2) between '$division_start_date' and '$division_end_date'";
        $sql = "substring(datachar02,1,2) = 'U1' AND CAST(SPLIT_PART(datachar02,'U1',2) as integer) IN ($datachar02) AND (intorder01::text between '$start_date' and '$end_date') AND substring(datatxt0003::text,1,2)='B9' AND right(datatxt0003::text,2) between '$division_start_date' and '$division_end_date'";
        if(isset($req_data['kokyakuorderbango_start']) && ($req_data['kokyakuorderbango_start']!="" && $req_data['kokyakuorderbango_end']!="")){
            $kokyakuorderbango_start = $req_data['kokyakuorderbango_start'];
            $kokyakuorderbango_end = $req_data['kokyakuorderbango_end'];
            $sql .= "AND kokyakuorderbango >= '$kokyakuorderbango_start' and kokyakuorderbango <= '$kokyakuorderbango_end' ";
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
            //$data=DB::table('order_history_temp')->whereRaw('maxval = ' . 0 ." AND datachar10 IS NULL AND synchroorderbango != 1 AND substring(datachar01,1,1) = '1' AND $sql ");
            $data=DB::table('order_history_temp')->whereRaw("ordertypebango2 = maxval AND datachar10 IS NULL AND synchroorderbango != 1 AND $sql ");
            //$data=DB::table('order_history_temp')->whereRaw("ordertypebango2 = 0 AND datachar10 IS NULL AND synchroorderbango != 1 AND $sql ");
        }elseif(isset($req_data['rd1']) && $req_data['rd1']=="rd1_2"){ 
            $data=DB::table('order_history_temp')->whereRaw('ordertypebango2 != ' . 0 ." AND datachar10 IS NULL AND substring(datachar01,1,1) != '1' AND $sql ");
        }elseif(isset($req_data['rd1']) && $req_data['rd1']=="rd1_3"){ 
            $data=DB::table('order_history_temp')->whereRaw("datachar10 IS NULL AND $sql ");
        }else{
            //cal date
            $year = date('Y');
            $month = date('m');
            $last_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $start_dt = $year.'/'.$month.'/'.'01';
            $end_dt = $year.'/'.$month.'/'.$last_day;
            
            $data=DB::table('order_history_temp')->whereRaw('datachar10 IS NULL' . " AND datachar05 = '$login_bango'" . " AND ordertypebango2 = 0" . " AND intorder01::text between '$start_dt' and '$end_dt' ");
        }

        return $data;
        
    }
}
