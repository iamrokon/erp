<?php

namespace App\AllClass\purchase\paymentScheduleCal;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class AllPaymentBalance{
    public static function data($login_bango,$req_data=null){

        //part1
        $payment_deadline = $req_data['payment_deadline'];
        $payment_date = (int) str_replace("/","",$req_data['payment_date']);
        $deadline = $req_data['deadline'];
        $temp_deadline = str_replace("/","-",$deadline)." 00:00:00";
        //$sql = "where  toiawasebango.dataint02 = $payment_date AND date(toiawasebango.touchakudate) <= '$deadline' AND hikiatenyuko.datachar07 IS NOT NULL ";
        $sql = "where  toiawasebango.dataint02 = $payment_date AND date(toiawasebango.touchakudate) <= '$deadline' ";
        if($req_data['bikou1'] != ""){
            $bikou1 = substr($req_data['bikou1'],0,8);
            $sql .= " AND toiawasebango.bikou1 = '$bikou1' ";
        }
        
        //$shiharaizandaka_prev_data = QueryHelper::fetchSingleResult("
        //    select 
        //    MAX(sz0001) as max_sz0001
        //    from shiharaizandaka
        //    group by sz0002
        //    ");
        //if($shiharaizandaka_prev_data){
        //    $max_sz0001 = $shiharaizandaka_prev_data->max_sz0001;
        //    $sql .= " AND toiawasebango.touchakudate > '$max_sz0001' ";
        //}
        
        $sql .= " AND 
            CASE 
            WHEN (select count(sz0002) from shiharaizandaka as tmp_shiharaizandaka where tmp_shiharaizandaka.sz0002 = toiawasebango.bikou1) > 0 
            THEN  toiawasebango.touchakudate > (select MAX(sz0001) as max_sz0001 from shiharaizandaka as tmp2_shiharaizandaka where tmp2_shiharaizandaka.sz0002 = toiawasebango.bikou1 and tmp2_shiharaizandaka.sz0001 != '$temp_deadline'  group by sz0002)
            ELSE true END
            ";
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS payment_balance_temp1");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE payment_balance_temp1 as
        select distinct
        toiawasebango.unsoumei as purchase_number,
        RIGHT(toiawasebango.toiawasebango,2) as sr0002,
        toiawasebango.dataint02,
        toiawasebango.dataint03 as sr0011,
        toiawasebango.datanum0001 as sr0012,
        0 as sm0003,
        'none'::text as datachar01,
        0 as datachar01_d901_count,
        0 as sh0017,
        toiawasebango.bikou1 as company_code,
        toiawasebango.touchakudate  as checking_date,
        hikiatenyuko.datachar07,
        haisoujouhou.tel,
        haisoujouhou.bunrui3 as hj0055,
        haisoujouhou.syukei3 as hj0087,
        others2.other24 as jg0053,
        others2.otherfloat2 as jg0054,
        others2.other1
        --'toiawasebango' as table_name
        
        from toiawasebango
        
        join hikiatenyuko on hikiatenyuko.syouhinid = toiawasebango.unsoumei
        
        left join kokyaku1 on kokyaku1.yobi12 = substring(toiawasebango.bikou1,1,6)
        
        left join haisoujouhou on haisoujouhou.syukei1 = kokyaku1.bango
        
        left join haisou on haisou.shikibetsucode = substring(toiawasebango.bikou1,1,6) AND haisou.torihikisakibango = substring(toiawasebango.bikou1,7,2)
        
        left join others2 on others2.otherint1 = haisou.bango 
        
        $sql
        AND (CASE
                WHEN substring(others2.other1,1,1) = '1' THEN haisoujouhou.tel = '$payment_deadline'
                ELSE others2.other19 = '$payment_deadline' END)
        
        ");
        
        //$temp_purchase_data = QueryHelper::fetchResult("select * from payment_balance_temp1");
        //dd($temp_purchase_data);
        
        
        //part2
        $sql2 = "where date(nyuko.denpyohakkoubi) <= '$deadline' ";
        if($req_data['bikou1'] != ""){
            $bikou1 = substr($req_data['bikou1'],0,8);
            $sql2 .= " AND nyuko.kaiinid = '$bikou1' ";
        }
        //if($shiharaizandaka_prev_data){
        //    $max_sz0001 = $shiharaizandaka_prev_data->max_sz0001;
        //    $sql2 .= " AND nyuko.denpyohakkoubi > '$max_sz0001' ";
        //}
        
        $sql2 .= " AND 
            CASE 
            WHEN (select count(sz0002) from shiharaizandaka as tmp_shiharaizandaka3 where tmp_shiharaizandaka3.sz0002 = nyuko.kaiinid) > 0 
            THEN  nyuko.denpyohakkoubi > (select MAX(sz0001) as max_sz0001 from shiharaizandaka as tmp4_shiharaizandaka where tmp4_shiharaizandaka.sz0002 = nyuko.kaiinid and tmp4_shiharaizandaka.sz0001 != '$temp_deadline'  group by sz0002)
            ELSE true END
            ";
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS payment_balance_temp2");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE payment_balance_temp2 as
        select  
        nyuko.syouhinid as purchase_number,
        '70'::text as sr0002,
        nyuko.denpyohakkoubi  as checking_date,
        nyuko.kaiinid as company_code,
        0 as sr0011,
        0 as sr0012,
        hikiatesyukko2.syouhizeiritu as sm0003,
        substring(hikiatesyukko2.datachar01,3,2) as datachar01,
        (select count(datachar01) from hikiatesyukko2 where hikiatesyukko2.syouhinid = nyuko.syouhinid AND datachar01 = 'D901') as datachar01_d901_count,
        nyuko.season as sh0017,
        haisoujouhou.tel,
        haisoujouhou.bunrui3 as hj0055,
        haisoujouhou.syukei3 as hj0087,
        others2.other24 as jg0053,
        others2.otherfloat2 as jg0054,
        others2.other1
        --'nyuko' as table_name
        
        from nyuko
        
        left join hikiatesyukko2 on hikiatesyukko2.syouhinid = nyuko.syouhinid

        left join kokyaku1 on kokyaku1.yobi12 = substring(nyuko.kaiinid,1,6)
        
        left join haisoujouhou on haisoujouhou.syukei1 = kokyaku1.bango
        
        left join haisou on haisou.shikibetsucode = substring(nyuko.kaiinid,1,6) AND haisou.torihikisakibango = substring(nyuko.kaiinid,7,2)
        
        left join others2 on others2.otherint1 = haisou.bango 
        
        $sql2
        AND (CASE
                WHEN substring(others2.other1,1,1) = '1' THEN haisoujouhou.tel = '$payment_deadline'
                ELSE others2.other19 = '$payment_deadline' END)
        
        ");
        
        //$temp_purchase_data = QueryHelper::fetchResult("select * from payment_balance_temp2");
        //dd($temp_purchase_data);
        
        $merge_column = "purchase_number,sr0002,sr0011,sr0012,sm0003,datachar01,datachar01_d901_count,other1,hj0055,jg0053,hj0087,jg0054,sh0017,company_code,checking_date";
        QueryHelper::runQuery("DROP TABLE IF EXISTS payment_balance_final");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE payment_balance_final as
            select $merge_column,'toiawasebango' as table_name
            from payment_balance_temp1
            union
            select $merge_column,'nyuko' as table_name
            from payment_balance_temp2
            ");
        $data = DB::table('payment_balance_final');
        return $data;
        
    }
}
