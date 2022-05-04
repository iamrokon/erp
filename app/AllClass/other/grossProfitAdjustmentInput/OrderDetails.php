<?php


namespace App\AllClass\other\grossProfitAdjustmentInput;

use App\tantousya;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderDetails
{
    public static function data($bango, $kokyakuorderbango)
    {
        // $kokyakuorderbango = $request->kokyakuorderbango;
        $ordertypebango2 = QueryHelper::fetchSingleResult("select max(ordertypebango2) from orderhenkan where kokyakuorderbango = '$kokyakuorderbango' and datachar10 is null ")->max ?? 0;
        $condition_sql = "where orderhenkan.kokyakuorderbango = '$kokyakuorderbango' and orderhenkan.synchroorderbango = '0' and orderhenkan.ordertypebango2 = $ordertypebango2 and orderhenkan.datachar10 is null";

        QueryHelper::runQuery("DROP TABLE IF EXISTS v_orderinfo_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE v_orderinfo_temp  as
        select distinct bango, juchubango, r15 from v_orderinfo");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS order_detail_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE order_detail_temp as
        select distinct
        orderhenkan.kokyakuorderbango as order_number,
        orderhenkan.ordertypebango2,
        orderhenkan.datachar02,
        tantousya.name as person_name,
        tantousya.bango as person_code,
        tuhanorder.money10,
        v_orderinfo.r15,
        tuhanorder.juchukubun1 as orders_subject,
        hikiatesyukko.datachar04
        FROM orderhenkan
        left join tantousya on orderhenkan.datachar05 = tantousya.bango
        left join tuhanorder on orderhenkan.kokyakuorderbango  = tuhanorder.juchubango and orderhenkan.bango  = tuhanorder.orderbango
        left join v_orderinfo_temp as v_orderinfo on v_orderinfo.bango = tuhanorder.orderbango and v_orderinfo.juchubango = tuhanorder.juchubango
        left join hikiatesyukko on  orderhenkan.kokyakuorderbango = hikiatesyukko.syouhinid and orderhenkan.bango  = hikiatesyukko.orderbango
        $condition_sql
        ");
        return DB::table('order_detail_temp')->toSql();
    }
}
