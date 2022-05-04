<?php

namespace App\AllClass\purchase\purchaseRecordTransfer;

use App\tantousya;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AllPurchaseRecordTransfer1
{
    public static function data($bango, $kokyakuorderbango)
    {
        
        $condition_sql = "where orderhenkan.kokyakuorderbango ='$kokyakuorderbango' and (orderhenkan.datachar02 != 'U160' OR orderhenkan.datachar02 != 'U150') 
        and orderhenkan.kokyakuorderbango not in (select distinct orderhenkan.datachar06 from orderhenkan) OR (orderhenkan2.datachar02 = 'V410' and orderhenkan2.datachar02 = 'V440' and minyuko.datachar01 = 'V160' )";
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS v_torihikisaki_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE v_torihikisaki_temp as
        select *
        from v_torihikisaki
        ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_order_data_temp1");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_order_data_temp1 as
        select distinct
        orderhenkan.kokyakuorderbango,
        orderhenkan.datachar02,
        orderhenkan.datachar06,
        orderhenkan2.datachar02 as dtchar02,
        minyuko.datachar01,
        v_torihikisaki_temp.r17_3 as data_102,
        tantousya.name as data_103
        FROM orderhenkan
        -- p13
        join tantousya on orderhenkan.datachar05 = tantousya.bango
        join tuhanorder on orderhenkan.kokyakuorderbango = tuhanorder.juchubango and orderhenkan.bango = tuhanorder.orderbango
        join minyuko on orderhenkan.kokyakuorderbango = minyuko.syouhinid
        join orderhenkan2 on orderhenkan2.kokyakuorderbango = orderhenkan.kokyakuorderbango 
        -- r17_3
        left join v_torihikisaki_temp on v_torihikisaki_temp.torihikisaki_cd = tuhanorder.information1
        $condition_sql
        ");
        //$temp_purchase_data = QueryHelper::fetchResult("select * from purchase_order_data_temp1");
        //dd($temp_purchase_data);
        return DB::table('purchase_order_data_temp1')->toSql();
    }
}
