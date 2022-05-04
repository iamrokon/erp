<?php


namespace App\AllClass\purchase\accountBalanceUpdate;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AllAccountBalanceUpdate
{
    public static function data($bango, $input, $effectiveDate)
    {
//        $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7504'");
//        $date = $reviewData->orderbango;
//        $effectiveDate = strtotime("+1 months", strtotime($date));
//        $effectiveDate = strftime ( '%Y%m%d' , $effectiveDate );
        $start_date = substr($effectiveDate,0,4)."-".substr($effectiveDate,4,2)."-01"." 00:00:00";
        $lastday = date('t',strtotime($start_date));
        $end_date = substr($effectiveDate,0,4)."-".substr($effectiveDate,4,2)."-".$lastday." 00:00:00";
        //$end_date = '2021-12-12 00:00:00';
        $sql = "where (toiawasebango.touchakudate >= '$start_date' AND toiawasebango.touchakudate <= '$end_date') AND hikiatenyuko.datachar07 IS NOT NULL AND toiawasebango.datachar03 = '0'";
       
        QueryHelper::runQuery("DROP TABLE IF EXISTS toiawasebango_m");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE toiawasebango_m as
        select distinct 
        unsoumei,
        max(datanum0013) as max_datanum0013
        from toiawasebango
        group by unsoumei");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS account_balance_hikiatenyuko_update");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE account_balance_hikiatenyuko_update  as
        select 
        toiawasebango.unsoumei as purchase_number,
        toiawasebango.bikou1 as company_code
        from toiawasebango
        join toiawasebango_m on toiawasebango_m.unsoumei = toiawasebango.unsoumei and toiawasebango_m.max_datanum0013 = toiawasebango.datanum0013
        join hikiatenyuko on hikiatenyuko.syouhinid = toiawasebango.unsoumei
        $sql 
            --AND RIGHT(toiawasebango.toiawasebango,2) = '70'
        ");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS account_balance_update_temp1 ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE account_balance_update_temp1  as
        select 
        --toiawasebango.unsoumei as purchase_number,
        toiawasebango.bikou1 as company_code,
        --MAX(RIGHT(toiawasebango.toiawasebango,2)) as sr0002,
        MAX('70') as sr0002,
        SUM(toiawasebango.dataint03) as sr0011,
        SUM(toiawasebango.datanum0001) as sr0012
        --0 as sm0003,
        --hikiatenyuko.datachar07
        from toiawasebango
        join toiawasebango_m on toiawasebango_m.unsoumei = toiawasebango.unsoumei and toiawasebango_m.max_datanum0013 = toiawasebango.datanum0013
        join hikiatenyuko on hikiatenyuko.syouhinid = toiawasebango.unsoumei
        $sql 
            AND RIGHT(toiawasebango.toiawasebango,2) = '70'
        group by company_code
        ");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS account_balance_update_temp2 ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE account_balance_update_temp2  as
        select 
        --toiawasebango.unsoumei as purchase_number,
        toiawasebango.bikou1 as company_code,
        --MAX(RIGHT(toiawasebango.toiawasebango,2)) as sr0002,
        MAX('not_70') as sr0002,
        SUM(toiawasebango.dataint03) as sr0011,
        SUM(toiawasebango.datanum0001) as sr0012
        --0 as sm0003,
        --hikiatenyuko.datachar07
        from toiawasebango
        join toiawasebango_m on toiawasebango_m.unsoumei = toiawasebango.unsoumei and toiawasebango_m.max_datanum0013 = toiawasebango.datanum0013
        join hikiatenyuko on hikiatenyuko.syouhinid = toiawasebango.unsoumei
        $sql 
            AND RIGHT(toiawasebango.toiawasebango,2) != '70'
        group by company_code
        ");
        $merge_column = "company_code,sr0002,sr0011,sr0012";
        QueryHelper::runQuery("DROP TABLE IF EXISTS account_balance_update1");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE account_balance_update1 as
            select $merge_column,0 as sm0003,0 as kk0010,0 as kk0011,0 as kk0012,0 as kk0014,'toiawasebango' as table_name
            from account_balance_update_temp1
            union
            select $merge_column,0 as sm0003,0 as kk0010,0 as kk0011,0 as kk0012,0 as kk0014,'toiawasebango' as table_name
            from account_balance_update_temp2
            ");
        //$temp_purchase_data = QueryHelper::fetchResult("select * from account_balance_update1");
        //dd($temp_purchase_data);
        
        $sql2 = "where (nyuko.denpyohakkoubi >= '$start_date' AND nyuko.denpyohakkoubi <= '$end_date') AND nyuko.denpyobango = '0'";
        QueryHelper::runQuery("DROP TABLE IF EXISTS account_balance_update_temp3 ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE account_balance_update_temp3  as
        select 
        --nyuko.syouhinid as purchase_number,
        nyuko.kaiinid as company_code,
        --MAX(nyuko.season::text) as sr0002,
        --'70' as sr0002,
        'not_70' as sr0002,
        --nyuko.season,
        0 as sr0011,
        0 as sr0012,
        substring(hikiatesyukko2.datachar01,3,2) as datachar01,
        --SUM(hikiatesyukko2.syouhizeiritu) as sm0003
        hikiatesyukko2.syouhizeiritu as sm0003
        from nyuko
        left join hikiatesyukko2 on hikiatesyukko2.syouhinid = nyuko.syouhinid
        $sql2 
            AND nyuko.season = 1
        --group by company_code
        ");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS account_balance_update_temp3_1 ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE account_balance_update_temp3_1  as
        select 
        company_code,
        --MAX(nyuko.season::text) as sr0002,
        --MAX('70') as sr0002,
        MAX('not_70') as sr0002,
        MAX(0) as sr0011,
        MAX(0) as sr0012,
        --MAX(datachar01) as datachar01,
        --SUM(hikiatesyukko2.syouhizeiritu) as sm0003
        (select SUM(sm0003) from account_balance_update_temp3 as tmp1 where tmp1.company_code = account_balance_update_temp3.company_code and datachar01 IN('01','02','04','05','08','10')) as kk0010,
        (select SUM(sm0003) from account_balance_update_temp3 as tmp1 where tmp1.company_code = account_balance_update_temp3.company_code and datachar01 IN('03')) as kk0011,
        (select SUM(sm0003) from account_balance_update_temp3 as tmp1 where tmp1.company_code = account_balance_update_temp3.company_code and datachar01 IN('09')) as kk0012,
        (select SUM(sm0003) from account_balance_update_temp3 as tmp1 where tmp1.company_code = account_balance_update_temp3.company_code and datachar01 IN('01','02','03','04','05','08','09','10')) as kk0014
        from account_balance_update_temp3
        group by company_code
        ");
        //$temp_purchase_data = QueryHelper::fetchResult("select * from account_balance_update_temp33");
        //dd($temp_purchase_data,"d");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS account_balance_update_temp4 ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE account_balance_update_temp4  as
        select 
        --nyuko.syouhinid as purchase_number,
        nyuko.kaiinid as company_code,
        --MAX(nyuko.season::text) as sr0002,
        --'not_70' as sr0002,
        '70' as sr0002,
        --nyuko.season,
        0 as sr0011,
        0 as sr0012,
        substring(hikiatesyukko2.datachar01,3,2) as datachar01,
        hikiatesyukko2.syouhizeiritu as sm0003
        from nyuko
        left join hikiatesyukko2 on hikiatesyukko2.syouhinid = nyuko.syouhinid
        $sql2 
            AND nyuko.season != 1
        --group by company_code
        ");
        QueryHelper::runQuery("DROP TABLE IF EXISTS account_balance_update_temp4_1 ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE account_balance_update_temp4_1  as
        select 
        company_code,
        --MAX(nyuko.season::text) as sr0002,
        --MAX('not_70') as sr0002,
        MAX('70') as sr0002,
        MAX(0) as sr0011,
        MAX(0) as sr0012,
        --MAX(datachar01) as datachar01,
        --SUM(hikiatesyukko2.syouhizeiritu) as sm0003
        (select SUM(sm0003) from account_balance_update_temp4 as tmp2 where tmp2.company_code = account_balance_update_temp4.company_code and datachar01 IN('01','02','04','05','08','10')) as kk0010,
        (select SUM(sm0003) from account_balance_update_temp4 as tmp2 where tmp2.company_code = account_balance_update_temp4.company_code and datachar01 IN('03')) as kk0011,
        (select SUM(sm0003) from account_balance_update_temp4 as tmp2 where tmp2.company_code = account_balance_update_temp4.company_code and datachar01 IN('09')) as kk0012,
        (select SUM(sm0003) from account_balance_update_temp4 as tmp2 where tmp2.company_code = account_balance_update_temp4.company_code and datachar01 IN('01','02','03','04','05','08','09','10')) as kk0014
        from account_balance_update_temp4
        group by company_code
        ");
        //$temp_purchase_data = QueryHelper::fetchResult("select * from account_balance_update_temp43");
        //dd($temp_purchase_data,"d5");
        
        $merge_column2 = "company_code,sr0002,sr0011,sr0012,kk0010,kk0011,kk0012,kk0014";
        QueryHelper::runQuery("DROP TABLE IF EXISTS account_balance_update2");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE account_balance_update2 as
            select $merge_column2,'nyuko' as table_name
            from account_balance_update_temp3_1
            union
            select $merge_column2,'nyuko' as table_name
            from account_balance_update_temp4_1
            ");
        //$temp_purchase_data = QueryHelper::fetchResult("select * from account_balance_update2");
        //dd($temp_purchase_data,"d");
        
        $merge_column3 = "company_code,sr0002,sr0011,sr0012,kk0010,kk0011,kk0012,kk0014,table_name";
        QueryHelper::runQuery("DROP TABLE IF EXISTS account_balance_update");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE account_balance_update as
            select $merge_column3
            from account_balance_update1
            union
            select $merge_column3
            from account_balance_update2
            order by company_code,sr0002
            ");
        //$temp_purchase_data = QueryHelper::fetchResult("select * from account_balance_update");
        //dd($temp_purchase_data);
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS account_balance_update_final");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE account_balance_update_final as
            select 
            account_balance_update.company_code,
            account_balance_update.sr0002,
            MAX(account_balance_update.sr0011::bigint) as sr0011,
            MAX(account_balance_update.sr0012) as sr0012,
            --MAX(account_balance_update.sm0003) as sm0003
            MAX(account_balance_update.kk0010) as kk0010,
            --MAX(CASE
            --    WHEN account_balance_update.sr0002 = '70' THEN (select account_balance_update_temp3_1.kk0010 from account_balance_update_temp3_1 where account_balance_update_temp3_1.company_code = account_balance_update.company_code and account_balance_update_temp3_1.sr0002 = '70')
            --    ELSE (select account_balance_update_temp4_1.kk0010 from account_balance_update_temp4_1 where account_balance_update_temp4_1.company_code = account_balance_update.company_code and account_balance_update_temp4_1.sr0002 = 'not_70') 
            --    END) as kk0010,
            MAX(account_balance_update.kk0011) as kk0011,
            MAX(account_balance_update.kk0012) as kk0012,
            MAX(account_balance_update.kk0014) as kk0014
            from account_balance_update
            group by company_code,sr0002
            order by company_code,sr0002
            ");
        //$temp_purchase_data = QueryHelper::fetchResult("select * from account_balance_update_final");
        //dd($temp_purchase_data);
        
        return DB::table('account_balance_update_final');
        
    }
}
