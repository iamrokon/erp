<?php


namespace App\AllClass\purchase\purchaseConfirmation;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AllPurchaseData
{
    public static function data($bango, $input)
    {
       
        $current_purchase_number = $input['current_purchase_number'];
        $value_type = $input['value_type'];
        $start_date = $input['touchakudate_start'];
        $end_date = $input['touchakudate_end'];
        $sql = " (date(touchakudate) between '$start_date' and '$end_date') AND toiawasebango.datachar03 = '0' ";
        if(isset($input['touchakutime']) && $input['touchakutime'] != ""){
            $touchakutime = $input['touchakutime'];
            $sql .= " AND touchakutime = '$touchakutime'";            
        } 
        
        if($current_purchase_number != "" && $value_type != ""){
            if($value_type == "next"){
                $sql .= " AND unsoumei::int > '$current_purchase_number'"; 
            }else{
                $sql .= " AND unsoumei::int < '$current_purchase_number'"; 
            }
        }
        
        if(isset($input['rd1']) && $input['rd1']=="rd1_1"){
            $sql .= " AND datachar06 is null and syouhinsyu = 2"; 
        }
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_con_v_torihikisaki ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_con_v_torihikisaki as
        select *
        from v_torihikisaki
        ");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_m");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_m as
        select distinct 
        kokyakuorderbango, max(ordertypebango2) as maxval
        from orderhenkan
        where synchroorderbango2 = 0 
        group by kokyakuorderbango");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_m_tmp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_m_tmp as
        select distinct 
        orderhenkan.*
        from orderhenkan
        join orderhenkan_m on orderhenkan_m.kokyakuorderbango = orderhenkan.kokyakuorderbango and orderhenkan_m.maxval = orderhenkan.ordertypebango2
        ");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS temp_purchase_data");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE temp_purchase_data as
        select distinct 
        --max(toiawasebango.datanum0013) as max_datanum0013,
        min(toiawasebango.unsoumei) as min_unsoumei
        from toiawasebango
        join hikiatenyuko on hikiatenyuko.syouhinid = toiawasebango.unsoumei
        where $sql
        ");
        
        //$temp_purchase_data = QueryHelper::fetchResult("select * from temp_purchase_data");
        //dd($temp_purchase_data);
        
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_data_m");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_data_m as
        select distinct 
        toiawasebango.unsoumei,
        max(toiawasebango.datanum0013) as max_datanum0013
        from toiawasebango
        group by unsoumei
        ");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS nyukoold_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE nyukoold_temp as
        select distinct 
        nyukoold.syouhinid,
        max(nyukoold.zaikometer) as max_zaikometer
        from nyukoold
        group by syouhinid
        ");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS minyuko_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE minyuko_temp as
        select distinct 
        minyuko.syouhinid,
        max(minyuko.zaikometer) as minyuko_max_zaikometer
        from minyuko
        group by syouhinid
        ");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS minyuko_m_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE minyuko_m_temp as
        select distinct 
        minyuko.*
        from minyuko
        join minyuko_temp on minyuko_temp.syouhinid = minyuko.syouhinid and minyuko_temp.minyuko_max_zaikometer = minyuko.zaikometer
        ");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_data ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_data  as
        select 
        toiawasebango.unsoumei,
        to_char(toiawasebango.touchakudate, 'YYYY/MM/DD') as touchakudate,
        toiawasebango.touchakutime,
        toiawasebango.bikou1,
        bikou1Detail.r17_3cd as bikou1_detail,
        toiawasebango.toiawasebango,
        concat(categorykanriToiawasebango.category2,' ',categorykanriToiawasebango.category4) as toiawasebango_detail,
        CASE
            WHEN toiawasebango.dataint01::text is null THEN NULL
            ELSE concat_ws('/',substring(toiawasebango.dataint01::text,1,4),
            substring(toiawasebango.dataint01::text,5,2),
            substring(toiawasebango.dataint01::text,7,2)) END as dataint01,
        toiawasebango.denpyoname,
        toiawasebango.dataint03,
        toiawasebango.datanum0001,
        toiawasebango.datachar03,
        (toiawasebango.dataint03 + toiawasebango.datanum0001) as sum_of_dataint03_datanum0001,
        nyukoold.datachar08,
        nyukoold.nyukosu,
        nyukoold.kingaku,
        to_char(nyukoold.kingaku,'FM99,999,999,999,999') as formatted_kingaku,
        nyukoold.syouhizeiritu,
        to_char(nyukoold.syouhizeiritu,'FM99,999,999,999,999') as formatted_syouhizeiritu,
        nyukoold.datachar18,
        concat(categorykanriDatachar18.category2,' ',categorykanriDatachar18.category4) as datachar18_detail,
        nyukoold.barcode,
        nyukoold.codename,
        nyukoold.idoutanabango,
        nyukoold.yoteimeter,
        orderhenkan.datachar10,
        datachar10Detail.r17_4cd as datachar10_detail,
        orderhenkan.orderuserbango,
        nyukoold.syouhinsyu,
        hikiatenyuko.syouhinsyu as hikiatenyuko_syouhinsyu,
        hikiatenyuko.datachar06,
        substr(replace(replace(tantousya.name,' ',''),'　',''),1,3) as datachar06_tan_name_short,
        hikiatenyuko.datachar07,
        substr(replace(replace(datachar07Tantousya.name,' ',''),'　',''),1,3) as datachar07_tan_name_short
        
        from toiawasebango
        
        join temp_purchase_data on temp_purchase_data.min_unsoumei = toiawasebango.unsoumei
        --AND temp_purchase_data.max_datanum0013 = toiawasebango.datanum0013
        
        join hikiatenyuko on hikiatenyuko.syouhinid = toiawasebango.unsoumei
        
        join purchase_data_m on purchase_data_m.unsoumei = toiawasebango.unsoumei
        AND purchase_data_m.max_datanum0013 = toiawasebango.datanum0013
        
        join nyukoold on nyukoold.syouhinid = toiawasebango.unsoumei
        
        join nyukoold_temp on nyukoold_temp.syouhinid = nyukoold.syouhinid
        AND nyukoold_temp.max_zaikometer = nyukoold.zaikometer
        
        --left join minyuko on minyuko.syouhinid = nyukoold.idoutanabango and minyuko.syouhinsyu = nyukoold.yoteimeter
        left join minyuko_m_temp on minyuko_m_temp.syouhinid = nyukoold.idoutanabango and minyuko_m_temp.syouhinsyu = nyukoold.yoteimeter
        
        --left join minyuko_temp on minyuko_temp.syouhinid = minyuko.syouhinid
        --AND minyuko_temp.minyuko_max_zaikometer = minyuko.zaikometer

        --left join orderhenkan on orderhenkan.kokyakuorderbango = minyuko.syouhinid 
        left join orderhenkan_m_tmp as orderhenkan on orderhenkan.kokyakuorderbango = minyuko_m_temp.syouhinid 
        
        --left join orderhenkan_m on
        --orderhenkan_m.kokyakuorderbango = orderhenkan.kokyakuorderbango
        --and orderhenkan_m.maxval = orderhenkan.ordertypebango2
        
        
        left join categorykanri as categorykanriToiawasebango
        on substring(toiawasebango.toiawasebango,1,2) = categorykanriToiawasebango.category1
        and substring(toiawasebango.toiawasebango,3,2) = categorykanriToiawasebango.category2
        
        left join categorykanri as categorykanriDatachar18
        on substring(nyukoold.datachar18,1,2) = categorykanriDatachar18.category1
        and substring(nyukoold.datachar18,3,2) = categorykanriDatachar18.category2
        
        --datachar10
        left join purchase_con_v_torihikisaki as datachar10Detail on
        datachar10Detail.torihikisaki_cd = orderhenkan.datachar10
        --datachar10 end
        
        --bikou1
        left join purchase_con_v_torihikisaki as bikou1Detail on
        substring(bikou1Detail.torihikisaki_cd,1,8) = toiawasebango.bikou1
        --bikou1 end
        
        left join tantousya on hikiatenyuko.datachar06 = tantousya.bango
        
        left join tantousya as datachar07Tantousya on datachar07Tantousya.bango = hikiatenyuko.datachar07
            
        ");
        
        
        $sql_2 = "";
        if(isset($input['rd1']) && $input['rd1']=="rd1_1"){
            $sql_2 .= "datachar06 is null and hikiatenyuko_syouhinsyu = 2"; 
        }else{
            $sql_2 .= "hikiatenyuko_syouhinsyu = 2"; 
        }
        
        return DB::table('purchase_data')->whereRaw("$sql_2");
        
    }
}
