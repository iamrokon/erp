<?php

namespace App\AllClass\purchase\paymentScheduleCal;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class AllAccountsPayable{
    public static function data($login_bango,$req_data=null){

        //part1
        $payment_deadline = $req_data['payment_deadline'];
        $start_date = str_replace("/","-",substr($req_data['deadline'],0,8)."01");
        $lastday = date('t',strtotime($start_date));
        $end_date = substr($start_date,0,8).$lastday;
        $sql = "where (date(toiawasebango.touchakudate) >= '$start_date' AND date(toiawasebango.touchakudate) <= '$end_date') AND hikiatenyuko.datachar07 IS NOT NULL ";
        if($req_data['bikou1'] != ""){
            $bikou1 = $req_data['bikou1'];
            $sql .= " AND toiawasebango.bikou1 = '$bikou1' ";
        }
        QueryHelper::runQuery("DROP TABLE IF EXISTS accounts_payable_temp1");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE accounts_payable_temp1 as
        select distinct
        toiawasebango.unsoumei as purchase_number,
        RIGHT(toiawasebango.toiawasebango,2) as sr0002,
        toiawasebango.dataint02,
        toiawasebango.dataint03 as sr0011,
        toiawasebango.datanum0001 as sr0012,
        0 as sm0003,
        'none'::text as datachar01,
        0 as sh0017,
        toiawasebango.bikou1 as company_code,
        toiawasebango.touchakudate,
        hikiatenyuko.datachar07,
        haisoujouhou.tel,
        others2.other1,
        others2.other19
        
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
        
        //$temp_purchase_data = QueryHelper::fetchResult("select * from accounts_payable_temp1");
        //dd($temp_purchase_data);
        
        //part2
        $sql2 = "where (date(nyuko.denpyohakkoubi) >= '$start_date' AND date(nyuko.denpyohakkoubi) <= '$end_date') ";
        if($req_data['bikou1'] != ""){
            $bikou1 = $req_data['bikou1'];
            $sql2 .= " AND nyuko.kaiinid = '$bikou1' ";
        }
        QueryHelper::runQuery("DROP TABLE IF EXISTS accounts_payable_temp2");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE accounts_payable_temp2 as
        select  
        nyuko.syouhinid as purchase_number,
        '70'::text as sr0002,
        nyuko.denpyohakkoubi,
        nyuko.kaiinid as company_code,
        0 as sr0011,
        0 as sr0012,
        hikiatesyukko2.syouhizeiritu as sm0003,
        substring(hikiatesyukko2.datachar01,3,2) as datachar01,
        nyuko.season as sh0017,
        haisoujouhou.tel,
        others2.other1,
        others2.other19
        
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

        $merge_column = "purchase_number,sr0002,sr0011,sr0012,sm0003,datachar01,other1,sh0017,company_code";
        QueryHelper::runQuery("DROP TABLE IF EXISTS accounts_payable_final");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE accounts_payable_final as
            select $merge_column,'toiawasebango' as table_name
            from accounts_payable_temp1
            union
            select $merge_column,'nyuko' as table_name
            from accounts_payable_temp2
            ");
        $data = DB::table('accounts_payable_final');

        return $data;
        
    }
}
