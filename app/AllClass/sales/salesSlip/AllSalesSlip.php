<?php

namespace App\AllClass\sales\salesSlip;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\kengen;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
Use \Carbon\Carbon;

Class AllSalesSlip{
    public static function data($bango,$deleted_item=2,$req_data=null){
        
        $sql1='';
        $sql_kokyaku1="";

        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->format('Ymd');
        $end_date = str_replace('/','',$req_data['intorder03_end']);
        //get data where datachar10 is not null to union anither set data start here
        $set_data = QueryHelper::fetchResult("select kokyakuorderbango from orderhenkan where synchroorderbango = 0 AND datachar10 is not null");
        $res = [];
        foreach($set_data as $key=>$val){
            if($val->kokyakuorderbango != null){
                $res[] = "'".$val->kokyakuorderbango."'";
            }
        }
        if(count($res)>0){
            $res = implode(',', $res);
        }else{
            $res = "'no_data'"; 
        }
        //get data where datachar10 is not null to union anither set data end here
        $TempTableArr='';
        
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
            $sql = "";
            $sql1='';
            $sql_kokyaku1="";
            if(isset($req_data['intorder03_start']) && ($req_data['intorder03_start']!="" && $req_data['intorder03_end']!="")){
                $start_date = str_replace('/','',$req_data['intorder03_start']);
                if(isset($req_data['information2_short']) && $req_data['information2_short'] != ""){
                    $information2 = $req_data['information2_short'];
                    $kokyakuCode = substr($information2, 0,6);
                    $haisouCode = substr($information2, 6,2);
                    $kokyaku = QueryHelper::select(['bango,ytoiawsestart,mail_jyushin'])->from('kokyaku1')->where("yobi12 = '$kokyakuCode' ")->get()->first();
                    $others2 = QueryHelper::fetchResult("select other1,other10 from others2 where otherint1 = (select bango from haisou where haisou.shikibetsucode = '$kokyakuCode' and haisou.torihikisakibango = '$haisouCode')");
                    if(substr($others2[0]->other1,0,1) == '1'){
                        $request_date = $kokyaku->mail_jyushin;
                    }else if(substr($others2[0]->other1,0,1) == '2'){
                        $request_date = $others2[0]->other10;
                    }
                    $end_date = str_replace('/','',$req_data['intorder03_end']);
                    //$end_date = strtotime("-$request_date days", strtotime($end_date));
                    //$end_date = strftime ( '%Y%m%d' , $end_date );
                    $sql_kokyaku1 .= "where orderhenkan.intorder03 between '$start_date' and $end_date ";
                    //dd($sql);
                }else{

                    $end_date = str_replace('/','',$req_data['intorder03_end']);
                    $sql_kokyaku1 .= "where orderhenkan.intorder03 between '$start_date' and $end_date ";
                }

            }
        
            if(isset($req_data['division_datachar05_start']) && ($req_data['division_datachar05_start']!="" && $req_data['division_datachar05_end']!="")){
                $division_start_date = substr($req_data['division_datachar05_start'], 4,2);
                $division_end_date = substr($req_data['division_datachar05_end'], 4,2);
                if(strlen($sql)>0){
                    $sql .= "where substring(orderhenkan.datatxt0003::text,1,2)='B9' AND right(orderhenkan.datatxt0003::text,2) between '$division_start_date' and '$division_end_date' ";
                }else{
                    $sql .= " where substring(orderhenkan.datatxt0003::text,1,2)='B9' AND right(orderhenkan.datatxt0003::text,2) between '$division_start_date' and '$division_end_date' ";
                }
            }
            
            if(isset($req_data['department_datachar05_start']) && ($req_data['department_datachar05_start']!="" && $req_data['department_datachar05_end']!="")){
                $department_start_date =substr($req_data['department_datachar05_start'], 4,3);
                $department_end_date = substr($req_data['department_datachar05_end'], 4,3);
                if(strlen($sql)>0){
                    $sql .= "AND substring(orderhenkan.datatxt0004::text,1,2)='C1' AND right(orderhenkan.datatxt0004::text,3) between '$department_start_date' and '$department_end_date' ";
                }else{
                    $sql .= " where substring(orderhenkan.datatxt0004::text,1,2)='C1' AND right(orderhenkan.datatxt0004::text,3) between '$department_start_date' and '$department_end_date' ";
                }
            }
            
            if(isset($req_data['group_datachar05_start']) && ($req_data['group_datachar05_start']!="" && $req_data['group_datachar05_end']!="")){
                $group_start_date = substr($req_data['group_datachar05_start'], 4,4);
                $group_end_date = substr($req_data['group_datachar05_end'], 4,4);
                if(strlen($sql)>0){
                    $sql .= "AND substring(orderhenkan.datatxt0005::text,1,2)='C2' AND right(orderhenkan.datatxt0005::text ,4) between '$group_start_date' and '$group_end_date' ";
                }else{
                    $sql .= " where substring(orderhenkan.datatxt0005::text,1,2)='C2' AND right(orderhenkan.datatxt0005::text ,4) between '$group_start_date' and '$group_end_date' ";
                }
            }
            
            $drop_down2=$req_data["datachar02"];
            if (isset($req_data["hktsyukko_datachar04"])) {
                $drop_down3=$req_data["hktsyukko_datachar04"];
            }
            
         
            if(strlen($sql)>0){
                    $sql .= "AND orderhenkan.synchroorderbango = 0  AND orderhenkan.datachar02 = '$drop_down2' and orderhenkan.intorder03 is not null ";
                }else{
                    $sql .= " orderhenkan.synchroorderbango = 0  AND orderhenkan.datachar02 = '$drop_down2'  and orderhenkan.intorder03 is not null ";
                }
            
            if (isset($req_data["hktsyukko_datachar04"]) && $req_data["hktsyukko_datachar04"] != 3) {
                $sql1.="where substring(hikiatesyukko.datachar01,1,1)::int = 3 AND hikiatesyukko.datachar04 =  '$drop_down3'";
            }else{
                $sql1.="where substring(hikiatesyukko.datachar01,1,1)::int = 3";
            }
       
        //}

        QueryHelper::runQuery("DROP TABLE IF EXISTS kokyaku1_temp");

        $datapick=QueryHelper::fetchResult(
        "
        select distinct
        tuhanorder.juchubango,
        tuhanorder.information2,
        orderhenkan.intorder03,
        CASE
           WHEN substring(others2.other1,1,1)='1' THEN kokyaku1.mail_jyushin
           ELSE others2.other10 END as date_addition
        from tuhanorder
        join orderhenkan
        on orderhenkan.bango=tuhanorder.orderbango
        join kokyaku1 
            on kokyaku1.yobi12= substr(tuhanorder.information2, 1,6)  
        join haisou
            on substring(tuhanorder.information2,7,2) = haisou.torihikisakibango
            and haisou.kounyusu = 0
            and haisou.shikibetsucode = substring(tuhanorder.information2,1,6) 
        join others2 
            on others2.otherint1=haisou.bango
        $sql_kokyaku1
        ");
    
        foreach ($datapick as $key => $value) {
            $intorder03_final = new \Carbon\Carbon($value->intorder03);
           
            $intorder03_final = $intorder03_final->addDays($value->date_addition);
          

            $TempTableArr.='( '. $intorder03_final->format('Ymd').", '".$value->information2."', '".$value->juchubango."'),";

        }
        $TempTableArr=substr($TempTableArr, 0, -1);

        QueryHelper::runQuery("DROP TABLE IF EXISTS kokyaku1_temp");
        $sql2=QueryHelper::runQuery("CREATE TEMPORARY TABLE kokyaku1_temp (intorder03 INT, information2 VARCHAR(50), juchubango VARCHAR(50))");

        if ($TempTableArr != "") {
            $sql3=QueryHelper::runQuery("INSERT INTO kokyaku1_temp (intorder03, information2,juchubango) VALUES $TempTableArr");
        }
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS sales_slip_before_temp");
        QueryHelper::runQuery("DROP TABLE IF EXISTS v_orderhenkan_temp");

        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE v_orderhenkan_temp as
         select distinct 
         orderhenkan.*,
         tuhanorder.information1,
         tuhanorder.information2,
         tuhanorder.information3,
         tuhanorder.information6,
         tuhanorder.housoukubun,
         tuhanorder.juchubango,
         tuhanorder.money10,
         tuhanorder.juchukubun2,
         tuhanorder.moneymax,
         tuhanorder.text3,
         tuhanorder.text4,
         v_orderinfo.juchukubun1 as juchukubun1,
         v_orderinfo.r15 as juchukubun1_short,
         tuhanorder.text4 as s_pdf,
         tuhanorder.juchukubun2 as sales_slip_juchukubun2
        
         from (select distinct
            kokyakuorderbango, max(bango) as max_bango
            from orderhenkan
            where synchroorderbango =0
            group by kokyakuorderbango
            ) as orderhenkan_temp

        
        JOIN v_orderhenkan AS orderhenkan
            ON orderhenkan.kokyakuorderbango = orderhenkan_temp.kokyakuorderbango
            AND orderhenkan.bango = orderhenkan_temp.max_bango

         join tuhanorder 
         on tuhanorder.orderbango = orderhenkan.bango
 
         join kokyaku1_temp
         on kokyaku1_temp.juchubango= tuhanorder.juchubango
         
         join v_orderinfo 
         on v_orderinfo.bango = tuhanorder.orderbango
         AND v_orderinfo.juchubango = tuhanorder.juchubango

        $sql
        ");

        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE sales_slip_before_temp as
        select 
        v_orderhenkan_temp.*,
        information1Torihikisaki.r17_4 as information1_detail,
        information2Torihikisaki.r17_4 as information2_detail,
        information3Torihikisaki.r17_4 as information3_detail,
        information6Torihikisaki.r17_4 as information6_detail

        from v_orderhenkan_temp

        join v_torihikisaki as information1Torihikisaki on
        v_orderhenkan_temp.information1 = information1Torihikisaki.torihikisaki_cd 

        join v_torihikisaki as information2Torihikisaki on
        information2Torihikisaki.torihikisaki_cd = v_orderhenkan_temp.information2
  
        join v_torihikisaki as information3Torihikisaki on
        information3Torihikisaki.torihikisaki_cd = v_orderhenkan_temp.information3
  
        join v_torihikisaki as information6Torihikisaki on
        information6Torihikisaki.torihikisaki_cd = v_orderhenkan_temp.information6

        ");
   // dd(QueryHelper::fetchResult("select * from sales_slip_before_temp where kokyakuorderbango='0151011303'"), $sql1);   
  // dd(QueryHelper::fetchResult('select * from sales_slip_before_temp'));
       
        QueryHelper::runQuery("DROP TABLE IF EXISTS sales_slip_after_temp");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE sales_slip_after_temp as
        select distinct 
        sales_slip_before_temp.bango,
        sales_slip_before_temp.datachar02,
        CASE
            WHEN trim(sales_slip_before_temp.datachar02) = '' THEN NULL
            ELSE trim(categorykanriDatachar02.category4) END as datachar02_detail,
        sales_slip_before_temp.datachar05,
        sales_slip_before_temp.name as user_name,
        replace(replace(sales_slip_before_temp.name,' ',''),'　','') as user_name_search,
        substring(replace(replace(sales_slip_before_temp.name,' ',''),'　',''),1,3) as user_name_short,
        sales_slip_before_temp.kokyakuorderbango,
        CAST(sales_slip_before_temp.kokyakuorderbango as integer) as kokyakuorderbango_search_sort,
        sales_slip_before_temp.ordertypebango2,
        sales_slip_before_temp.datachar01,
        sales_slip_before_temp.datachar03,
        sales_slip_before_temp.datachar04,
        sales_slip_before_temp.datachar08,
        sales_slip_before_temp.datachar09,
        sales_slip_before_temp.datachar10,
        sales_slip_before_temp.synchroorderbango,
        CASE
            WHEN sales_slip_before_temp.intorder01::text is null THEN NULL
            ELSE concat_ws('/',substring(sales_slip_before_temp.intorder01::text,1,4),
            substring(sales_slip_before_temp.intorder01::text,5,2),
            substring(sales_slip_before_temp.intorder01::text,7,2)) END as intorder01 ,
        CASE
            WHEN sales_slip_before_temp.intorder03::text is null THEN NULL
            ELSE concat_ws('/',substring(sales_slip_before_temp.intorder03::text,1,4),
            substring(sales_slip_before_temp.intorder03::text,5,2),
            substring(sales_slip_before_temp.intorder03::text,7,2)) END as intorder03 ,
        CASE
            WHEN sales_slip_before_temp.intorder05::text is null THEN NULL
            ELSE concat_ws('/',substring(sales_slip_before_temp.intorder05::text,1,4),
            substring(sales_slip_before_temp.intorder05::text,5,2),
            substring(sales_slip_before_temp.intorder05::text,7,2)) END as intorder05, 
        sales_slip_before_temp.datatxt0003,    
        sales_slip_before_temp.datatxt0004,    
        sales_slip_before_temp.datatxt0005,   
        sales_slip_before_temp.juchukubun1 as juchukubun1,
        sales_slip_before_temp.juchukubun1 as juchukubun1_short,
        sales_slip_before_temp.information1,
        substring(sales_slip_before_temp.information1,1,8) as information1_short,
        sales_slip_before_temp.information1_detail as information1_detail,
        sales_slip_before_temp.information2,
        substring(sales_slip_before_temp.information2,1,8) as information2_short,
        kokyaku1Information2.mail_jyushin as information2_mail_jyushin,
        CASE
            WHEN substring(kokyaku1Information2.mail_jyushin_mb,1,1)='1' THEN '1 有'
            WHEN substring(kokyaku1Information2.mail_jyushin_mb,1,1)='4' THEN '2 無'
            ELSE kokyaku1Information2.mail_jyushin_mb END as information2_mail_jyushin_mb,
        CASE
            WHEN substring(kokyaku1Information2.mail_nouhin,1,1)='1' THEN '1 有'
            WHEN substring(kokyaku1Information2.mail_nouhin,1,1)='2' THEN '2 無'
            ELSE kokyaku1Information2.mail_nouhin END as information2_mail_nouhin,
        sales_slip_before_temp.information2_detail as information2_detail,
        sales_slip_before_temp.information3,
        sales_slip_before_temp.information3_detail as information3_detail,
        sales_slip_before_temp.information6,
        sales_slip_before_temp.information6_detail as information6_detail,
        sales_slip_before_temp.housoukubun,
        sales_slip_before_temp.money10,
        to_char(sales_slip_before_temp.money10,'FM99,999,999,999,999') as formatted_money10,
        sales_slip_before_temp.moneymax,
        sales_slip_before_temp.text3,
        sales_slip_before_temp.text4,
        sales_slip_before_temp.juchukubun2 as sales_slip_juchukubun2,
        hikiatesyukko.datachar01 as hktsyukko_datachar01,
        hikiatesyukko.datachar04 as hktsyukko_datachar04,
        hikiatesyukko.datachar05 as hktsyukko_datachar05,
        hikiatesyukkoTantousya.name as hktsyukko_datachar05_detail,
        replace(replace(hikiatesyukkoTantousya.name,' ',''),'　','') as hktsyukko_datachar05_detail_search,
        substring(replace(replace(hikiatesyukkoTantousya.name,' ',''),'　',''),1,3) as hktsyukko_datachar05_detail_short,
        hikiatesyukko.datachar06 as hktsyukko_datachar06,
        hikiatesyukko.datachar08 as hktsyukko_datachar08,
        
        CASE
            WHEN hikiatesyukko.datachar09='1' THEN '1 済' 
            WHEN hikiatesyukko.datachar09='2' THEN '2 未' 
            ELSE hikiatesyukko.datachar09 END as hktsyukko_datachar09,
        
        CASE
            WHEN hikiatesyukko.datachar10='1' THEN '1 済'
            WHEN hikiatesyukko.datachar10='2' THEN '2 未'
            ELSE hikiatesyukko.datachar10 END as hktsyukko_datachar10
            
        from sales_slip_before_temp 
        
        join hikiatesyukko 
        --on  hikiatesyukko.syouhinid = sales_slip_before_temp.kokyakuorderbango
        on hikiatesyukko.orderbango = sales_slip_before_temp.bango
        
        
        left join tantousya as hikiatesyukkoTantousya on hikiatesyukko.datachar05 = hikiatesyukkoTantousya.bango
        
        left join kokyaku1 as kokyaku1Information2
        on substring(sales_slip_before_temp.information2,1,6) = kokyaku1Information2.yobi12

        join haisou
        on haisou.shikibetsucode = substring(sales_slip_before_temp.information2,1,6)
        and haisou.torihikisakibango = substring(sales_slip_before_temp.information2,7,2)
        
        join others2 on others2.otherint1 = haisou.bango
        
        join categorykanri as categorykanriDatachar02
        on substring(sales_slip_before_temp.datachar02,1,2) = categorykanriDatachar02.category1
        and substring(sales_slip_before_temp.datachar02,3,4) = categorykanriDatachar02.category2
        
        $sql1
        ORDER BY datatxt0003,datatxt0004,datatxt0005,intorder03,information2,kokyakuorderbango asc

        ");

       //dd(QueryHelper::fetchResult('select * from sales_slip_after_temp'));
     
        //dd(QueryHelper::fetchResult("select * from sales_slip_after_temp where kokyakuorderbango='0151011303'"),$sql1);
 
        $data=DB::table('sales_slip_after_temp');
        return $data;
        
    }
}
