<?php


namespace App\AllClass\other\allAccountingDataCreation;;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AllPaymentData
{
    public static function data($bango, $input)
    {
        
        $start_date = $input['intorder03_start'];
        $end_date = $input['intorder03_end'];
        if($input['rd2'] == 'rd2_1'){
            $sql = "where (date(nyuko.denpyohakkoubi) between '$start_date' and '$end_date') AND hikiatenyuko.syouhinsyu = 2";
        }else{
            $sql = "where hikiatenyuko.syouhinsyu = 3";
        }
       
        QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_data ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_data  as
        select 
        nyuko.syouhinid,
        concat(LEFT(nyuko.syouhinid,2),RIGHT(nyuko.syouhinid,6)) as sw0004,
        to_char(nyuko.denpyohakkoubi, 'YYYY/MM/DD') as denpyohakkoubi,
        to_char(nyuko.denpyohakkoubi, 'YYYYMMDD') as denpyohakkoubi_display,
        nyuko.season,
        nyuko.kaiinid,
        hikiatenyuko.syouhinid as hikiatenyuko_syouhinid,
        hikiatenyuko.syouhinsyu,
        hikiatesyukko2.syouhizeiritu,
        hikiatesyukko2.datachar01,
        substring(hikiatesyukko2.datachar01,3,2) as datachar01_right,
        hikiatesyukko2.datachar02,
        substring(hikiatesyukko2.datachar02,3,2) as datachar02_right,
        lpad(categorykanriDatachar02.patternsub2,6,'0') as patternsub2,
        lpad(d910Patternsub2.patternsub2,6,'0') as d910_patternsub2,
        haisou.shikibetsucode,
        others2.other36,
        RIGHT(others2.otherfloat1::text,1) as otherfloat1
        
        from nyuko
        
        join hikiatenyuko on hikiatenyuko.syouhinid = nyuko.syouhinid
               
        join hikiatesyukko2 on hikiatesyukko2.syouhinid = nyuko.syouhinid
        
        join kokyaku1 on substring(nyuko.kaiinid,1,6) = kokyaku1.yobi12
        join haisou on substring(nyuko.kaiinid,7,2) = haisou.torihikisakibango and kokyaku1.bango = haisou.kokyakubango
        join others2 on others2.otherint1 = haisou.bango
        
        left join categorykanri as categorykanriDatachar02
        on substring(hikiatesyukko2.datachar02,1,2) = categorykanriDatachar02.category1
        and substring(hikiatesyukko2.datachar02,3,4) = categorykanriDatachar02.category2
        
        left join categorykanri as d910Patternsub2
        on 'D9' = d910Patternsub2.category1
        and '10' = d910Patternsub2.category2

        $sql
        order by nyuko.denpyohakkoubi,nyuko.syouhinid
        ");
        
        return DB::table('purchase_data');
        
    }
}
