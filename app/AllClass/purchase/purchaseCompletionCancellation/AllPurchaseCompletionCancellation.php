<?php

namespace App\AllClass\purchase\purchaseCompletionCancellation;

use App\tantousya;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AllPurchaseCompletionCancellation
{
    public static function data($bango, $kokyakuorderbango)
    {
        // if(!empty($req_data['order_number'])){
        //     $kokyakuorderbango = $req_data['order_number'];
        // }else{
        //     $kokyakuorderbango = null;
        // }
        
        $ordertypebango2 = QueryHelper::fetchSingleResult("select max(ordertypebango2) from orderhenkan where kokyakuorderbango = '$kokyakuorderbango' ")->max ?? 0;
        $condition_sql = "where orderhenkan.kokyakuorderbango = '$kokyakuorderbango' and orderhenkan.synchroorderbango = '0' and orderhenkan.ordertypebango2 = $ordertypebango2 ";
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_completion_cancellation_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_completion_cancellation_temp as
        select distinct
        orderhenkan.kokyakuorderbango,
        orderhenkan.ordertypebango2,
        orderhenkan.datachar02,
        tuhanorder.juchukubun1 as orders_subject,
        tantousya.name as person_name,
        orderhenkan.datachar05 as person_code,
        tuhanorder.money10,
        hikiatesyukko.datachar16
        FROM orderhenkan
        join tantousya on orderhenkan.datachar05 = tantousya.bango
        join tuhanorder on orderhenkan.kokyakuorderbango = tuhanorder.juchubango and orderhenkan.bango = tuhanorder.orderbango
        join hikiatesyukko on orderhenkan.kokyakuorderbango = hikiatesyukko.syouhinid and orderhenkan.bango = hikiatesyukko.orderbango
        $condition_sql
        ");
        return DB::table('purchase_completion_cancellation_temp')->toSql();
    }
}
