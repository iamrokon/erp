<?php


namespace App\AllClass\purchase\purchaseConfirmation;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AllBacklogData
{
    public static function data($bango, $input)
    {
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS v_torihikisaki_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE v_torihikisaki_temp as
        select *
        from v_torihikisaki
        ");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_m");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_m as
        select distinct 
        kokyakuorderbango, max(ordertypebango2) as maxval
        from orderhenkan
        --where datachar02 != 'U150' 
        --and kokyakuorderbango != datachar06
        --where ordertypebango2 != 0
        group by kokyakuorderbango");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_m_ju");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_m_ju as
        select distinct 
        kokyakuorderbango, max(ordertypebango2) as maxval, max(bango) as max_bango
        from (select * from orderhenkan where kokyakuorderbango not in('datachar06')) as orderhenkan
        where datachar02 != 'U150' 
        group by kokyakuorderbango");
        
        //$temp_backlog_data = QueryHelper::fetchResult("select * from orderhenkan_m_ju");
        //dd($temp_backlog_data);
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS misyukko_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE misyukko_temp as
        select distinct 
        misyukko.syouhinid,
        sum(misyukko.dataint05 + misyukko.dataint06 + misyukko.dataint07 + misyukko.dataint08) as planned_purchase_amount
        from misyukko
        join minyuko on minyuko.syouhinid = misyukko.syouhinid
        group by minyuko.idoutanabango,misyukko.syouhinid");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS nyukoold_m");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE nyukoold_m as
        select distinct 
        idoutanabango, yoteimeter,syouhinid
        from nyukoold
        group by idoutanabango,yoteimeter,syouhinid");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS backlog_data ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE backlog_data  as
        --select distinct on (nyukoold.idoutanabango)
        select 
        orderhenkan.kokyakuorderbango,
        orderhenkan.ordertypebango2,
        orderhenkan.datachar02,
        concat(categorykanriDatachar02.category2,' ',categorykanriDatachar02.category4) as datachar02_detail,
        to_char(orderhenkan.date, 'YYYY/MM/DD') as date,
        orderhenkan.datachar10,
        datachar10Detail.r17_4 as datachar10_detail,
        orderhenkan.datachar11,
        datachar11Detail.r17_4 as datachar11_detail,
        orderhenkan.synchroorderbango2,
        orderhenkan.orderuserbango,
        orderhenkan.datachar08,
        tuhanorder.information2,
        information2Detail.r17_4 as information2_detail,
        tuhanorder.money10,
        to_char(tuhanorder.money10,'FM99,999,999,999,999') as formatted_money10,
        minyuko.datachar07,
        minyuko.datachar08 as minyuko_datachar08,
        minyuko.nyukosu,
        to_char(minyuko.nyukosu,'FM99,999,999,999,999') as formatted_nyukosu,
        minyuko.genka,
        to_char(minyuko.genka,'FM99,999,999,999,999') as formatted_genka,
        minyuko.syouhizeiritu,
        to_char(minyuko.syouhizeiritu,'FM99,999,999,999,999') as formatted_syouhizeiritu,
        minyuko.soukobango,
        to_char(minyuko.soukobango,'FM99,999,999,999,999') as formatted_soukobango,
        minyuko.syouhinid,
        minyuko.syouhinsyu,
        to_char(minyuko.yoteibi, 'YYYY/MM/DD') as yoteibi,
        hikiatenyuko.syouhinsyu as hikiatenyuko_syouhinsyu,
        hikiatenyuko.datachar06 as hikiatenyuko_datachar06,
        hikiatenyuko.datachar07 as hikiatenyuko_datachar07,
        COALESCE(misyukko_temp.planned_purchase_amount,0) as planned_purchase_amount,
        
        COALESCE(CASE
            WHEN hikiatenyuko.datachar07 != null THEN (select sum(temp_nyukoold.syouhizeiritu) from nyukoold as temp_nyukoold 
                join minyuko on minyuko.syouhinid = nyukoold.idoutanabango and minyuko.syouhinsyu = nyukoold.yoteimeter
                where temp_nyukoold.syouhinid = nyukoold.syouhinid and temp_nyukoold.yoteimeter = nyukoold.yoteimeter
                group by minyuko.idoutanabango
                )
            ELSE 0 END,0) as sum_of_syouhizeiritu,
            
        COALESCE(CASE
            WHEN hikiatenyuko.datachar06 != null AND hikiatenyuko.datachar07 = null THEN (select sum(temp_nyukoold.syouhizeiritu) from nyukoold as temp_nyukoold 
                join minyuko on minyuko.syouhinid = nyukoold.idoutanabango and minyuko.syouhinsyu = nyukoold.yoteimeter
                where temp_nyukoold.syouhinid = nyukoold.syouhinid and temp_nyukoold.yoteimeter = nyukoold.yoteimeter
                group by minyuko.idoutanabango
                )
            ELSE 0 END,0) as sum_of_syouhizeiritu_2
        
        from minyuko
        
        join orderhenkan on orderhenkan.kokyakuorderbango = minyuko.syouhinid
        
        join orderhenkan_m on orderhenkan_m.kokyakuorderbango = orderhenkan.kokyakuorderbango
        AND orderhenkan_m.maxval = orderhenkan.ordertypebango2
        
        join orderhenkan_m_ju on orderhenkan_m_ju.kokyakuorderbango = orderhenkan.orderuserbango
        --AND orderhenkan_m_ju.maxval = orderhenkan.ordertypebango2
        
        join tuhanorder on tuhanorder.juchubango = orderhenkan.orderuserbango
        and tuhanorder.orderbango = orderhenkan_m_ju.max_bango

        left join hikiatenyuko on hikiatenyuko.syouhinid = orderhenkan.kokyakuorderbango
        
        --left join nyukoold on nyukoold.idoutanabango = minyuko.syouhinid and nyukoold.yoteimeter = minyuko.syouhinsyu
        left join nyukoold_m as nyukoold on nyukoold.idoutanabango = minyuko.syouhinid and nyukoold.yoteimeter = minyuko.syouhinsyu
        
        left join misyukko_temp on misyukko_temp.syouhinid = minyuko.syouhinid 
        
        left join categorykanri as categorykanriDatachar02
        on substring(orderhenkan.datachar02,1,2) = categorykanriDatachar02.category1
        and substring(orderhenkan.datachar02,3,2) = categorykanriDatachar02.category2
        
        --datachar10
        left join v_torihikisaki_temp as datachar10Detail on
        datachar10Detail.torihikisaki_cd = orderhenkan.datachar10
        --datachar10 end
        
        --datachar11
        left join v_torihikisaki_temp as datachar11Detail on
        datachar11Detail.torihikisaki_cd = orderhenkan.datachar11
        --datachar11 end
        
        --information2
        left join v_torihikisaki_temp as information2Detail on
        information2Detail.torihikisaki_cd = tuhanorder.information2
        --information2 end
            
        ");
        
        $sql = "";
        $datachar08 = $input['datachar08'];
        $datachar08_short = substr($datachar08,0,6);
        if(isset($input['datachar10']) && $input['datachar10'] != ""){
            $datachar10 = $input['datachar10'];
            $sql .= " substring(datachar10,1,6) = '$datachar10' ";
        }
        if(isset($input['information2']) && $input['information2'] != ""){
            $information2 = $input['information2'];
            if(strlen($sql) > 0 ){
                $sql .= " and substring(information2,1,6) = '$information2' ";
            }else{
                $sql .= "substring(information2,1,6) = '$information2' ";
            }
        }
        if(isset($input['datachar11']) && $input['datachar11'] != ""){
            $datachar11 = $input['datachar11'];
            if(strlen($sql) > 0 ){
                $sql .= " and substring(datachar11,1,6) = '$datachar11' ";
            }else{
                $sql .= "substring(datachar11,1,6) = '$datachar11' ";
            }
        }
        
        if(strlen($sql) > 0 ){
            //$data = DB::table('backlog_data')->whereRaw("$sql and synchroorderbango2 = 0 and hikiatenyuko_syouhinsyu = 2 and substring(datachar08,1,8) = '$datachar08' ");
            //$data = DB::table('backlog_data')->whereRaw("$sql and synchroorderbango2 = 0 and hikiatenyuko_syouhinsyu != 1 and substring(datachar08,1,8) = '$datachar08' ");
            $data = DB::table('backlog_data')->whereRaw("$sql and synchroorderbango2 = 0 and hikiatenyuko_syouhinsyu != 1 and substring(datachar08,1,6) = '$datachar08_short' ");
        }else{
            //$data = DB::table('backlog_data')->whereRaw("synchroorderbango2 = 0 and hikiatenyuko_syouhinsyu = 2 and substring(datachar08,1,8) = '$datachar08'");
            //$data = DB::table('backlog_data')->whereRaw("synchroorderbango2 = 0 and hikiatenyuko_syouhinsyu != 1 and substring(datachar08,1,8) = '$datachar08'");
            $data = DB::table('backlog_data')->whereRaw("synchroorderbango2 = 0 and hikiatenyuko_syouhinsyu != 1 and substring(datachar08,1,6) = '$datachar08_short'");
        }
        
        return $data;
        
    }
}
