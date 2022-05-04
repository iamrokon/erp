<?php


namespace App\AllClass\other\allAccountingDataCreation;;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AllPurchaseData
{
    public static function data($bango, $input)
    {
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS temp_purchase_data");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE temp_purchase_data as
        select distinct 
        max(datanum0013) as max_datanum0013,
        unsoumei
        from toiawasebango
        group by unsoumei
        ");
       
        QueryHelper::runQuery("DROP TABLE IF EXISTS nyukoold_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE nyukoold_temp as
        select distinct 
        max(toiawasebango.unsoumei) as unsoumei,
        toiawasebango.touchakudate,
        toiawasebango.toiawasebango,
        nyukoold.barcode,
        max(nyukoold.codename) as codename,
        max(nyukoold.datachar11) as datachar11,
        nyukoold.datachar18,
        --nyukoold.syouhinid,
        sum(nyukoold.syouhizeiritu) as sum_of_syouhizeiritu,
        sum(nyukoold.soukobango) as sum_of_soukobango
        from nyukoold
        join toiawasebango on toiawasebango.unsoumei = nyukoold.syouhinid
        join temp_purchase_data on temp_purchase_data.unsoumei = toiawasebango.unsoumei
            AND temp_purchase_data.max_datanum0013 = toiawasebango.datanum0013
        --group by toiawasebango.unsoumei,toiawasebango.touchakudate,nyukoold.barcode,nyukoold.datachar18
        group by toiawasebango.toiawasebango,toiawasebango.touchakudate,nyukoold.barcode,nyukoold.datachar18
        ");
       // $purchase_data = QueryHelper::fetchResult("select * from nyukoold_temp");
       // dd($purchase_data);
        
        $start_date = $input['intorder03_start'];
        $end_date = $input['intorder03_end'];
        if($input['rd2'] == 'rd2_1'){
            $sql = "where (date(toiawasebango.touchakudate) between '$start_date' and '$end_date') AND hikiatenyuko.dataint01 = 2 AND hikiatenyuko.datachar07 IS NOT NULL ";
        }else{
            $sql = "where hikiatenyuko.dataint01 = 3";
        }
        
       
        QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_data ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_data  as
        select 
        toiawasebango.unsoumei,
        concat(LEFT(toiawasebango.unsoumei,2),RIGHT(toiawasebango.unsoumei,6)) as sw0004,
        to_char(toiawasebango.touchakudate, 'YYYY/MM/DD') as touchakudate,
        to_char(toiawasebango.touchakudate, 'YYYYMMDD') as touchakudate_display,
        toiawasebango.touchakutime,
        toiawasebango.toiawasebango,
        substring(toiawasebango.toiawasebango,3,2) as purchase_category,
        categorykanriToiawasebango.groupbango,
        concat(categorykanriToiawasebango.category2,' ',categorykanriToiawasebango.category4) as toiawasebango_detail,
        hikiatenyuko.syouhinid,
        hikiatenyuko.dataint01,
        nyukoold_temp.barcode,
        RIGHT(nyukoold_temp.barcode,5) as barcode_short,
        RIGHT(nyukoold_temp.barcode,6) as barcode_short_display,
        nyukoold_temp.datachar11,
        nyukoold_temp.datachar18,
        substring(nyukoold_temp.datachar18,3,2) as datachar18_short,
        --nyukoold.syouhizeiritu,
        nyukoold_temp.codename,
        RIGHT(nyukoold_temp.codename,4) as codename_short,
        nyukoold_temp.sum_of_syouhizeiritu,
        nyukoold_temp.sum_of_soukobango,
        concat(categorykanriDatachar18.category1,categorykanriDatachar18.category2,'：',categorykanriDatachar18.category4) as datachar18_detail,
        lpad(LEFT(categorykanriDatatxt0003.text,2),4,'0') as datatxt0003_text,
        tantousya.datatxt0003,
        RIGHT(categorykanriDatatxt0005.patternsub2,2) as treasury_division_cd
        
        from toiawasebango
        
        join temp_purchase_data on temp_purchase_data.unsoumei = toiawasebango.unsoumei
        AND temp_purchase_data.max_datanum0013 = toiawasebango.datanum0013
        
        join hikiatenyuko on hikiatenyuko.syouhinid = toiawasebango.unsoumei
        
        --join nyukoold on nyukoold.syouhinid = toiawasebango.unsoumei

        join nyukoold_temp on nyukoold_temp.unsoumei = toiawasebango.unsoumei and nyukoold_temp.touchakudate = toiawasebango.touchakudate 
        --AND nyukoold_temp.barcode = nyukoold.barcode AND nyukoold_temp.datachar18 = nyukoold.datachar18
        
        left join categorykanri as categorykanriToiawasebango
        on substring(toiawasebango.toiawasebango,1,2) = categorykanriToiawasebango.category1
        and substring(toiawasebango.toiawasebango,3,2) = categorykanriToiawasebango.category2

        left join categorykanri as categorykanriDatachar18
        on substring(nyukoold_temp.datachar18,1,2) = categorykanriDatachar18.category1
        and substring(nyukoold_temp.datachar18,3,2) = categorykanriDatachar18.category2
        
        left join tantousya on toiawasebango.touchakutime = tantousya.bango
        
        left join categorykanri as categorykanriDatatxt0003
        on substring(tantousya.datatxt0003,1,2) = categorykanriDatatxt0003.category1
        and substring(tantousya.datatxt0003,3,4) = categorykanriDatatxt0003.category2
        
        left join categorykanri as categorykanriDatatxt0005
        on substring(tantousya.datatxt0005,1,2) = categorykanriDatatxt0005.category1
        and substring(tantousya.datatxt0005,3,6) = categorykanriDatatxt0005.category2
        
        $sql
        order by toiawasebango.touchakudate,toiawasebango.unsoumei
        ");
        
        return DB::table('purchase_data');
        
    }
}
