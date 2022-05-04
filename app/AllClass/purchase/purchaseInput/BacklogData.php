<?php


namespace App\AllClass\purchase\purchaseInput;

use App\tantousya;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BacklogData
{
    public static function data($bango, $from = false, Request $request = null)
    {
        $systemDate = Carbon::now()->format('Y-m-d H:i:s');
        $previousDate = Carbon::now()->subYear()->format('Y-m-d H:i:s');
        // $ordertypebango2 = QueryHelper::fetchSingleResult("select max(ordertypebango2) from orderhenkan where kokyakuorderbango = '$orderId' ")->max ?? 0;
        $condition_sql = "where orderhenkan.synchroorderbango2 = '0'
        and (orderhenkan.datachar02 != 'U150' or orderhenkan.kokyakuorderbango not in (select distinct datachar06 from orderhenkan))";
        // if($request->order_category){
        //     $order_category = "V4" . substr($request->order_category, 2, 2);
        //     $condition_sql .= " and orderhenkan.datachar02 = '$order_category'";
        // }
        $condition_sql .= " and orderhenkan.datachar02 not in ('V411','V412','V413','V460')";
        if($request->tantou){
            $employeeBango = QueryHelper::fetchSingleResult("select bango from tantousya where name = '$request->tantou' ")->bango ?? "";
            $condition_sql .= " and orderhenkan.datachar09 = '$employeeBango'";
        }
        if($request->supplier){
            $condition_sql .= " and SUBSTRING(orderhenkan.datachar08, 1, 8)  = '$request->supplier'"; 
        }
        if($request->sold_to){
            $condition_sql .= " and SUBSTRING(orderhenkan.datachar10, 1, 8)  = '$request->sold_to'"; 
        }
        if($request->end_customer){
            $condition_sql .= " and SUBSTRING(orderhenkan.datachar11, 1, 8)  = '$request->end_customer'"; 
        }

        
        QueryHelper::runQuery("DROP TABLE IF EXISTS order_detail_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE order_detail_temp as
        select distinct
        orderhenkan.kokyakuorderbango as order_number,
        orderhenkan.datachar10 as reg_sold_to_db,
        orderhenkan.datachar11 as reg_end_customer_db,
        orderhenkan.ordertypebango2,
        v_torihikisaki_1.r17_3cd as reg_sold_to,
        v_torihikisaki_2.r17_3cd as reg_end_customer,
        minyuko.datachar02,
        minyuko.datachar08,
        minyuko.nyukosu,
        minyuko.genka,
        minyuko.syouhizeiritu,
        CASE 
            WHEN LENGTH(minyuko.syouhinsyu::text)=2 
            THEN concat_ws('0', minyuko.syouhinid, minyuko.syouhinsyu)
            WHEN LENGTH(minyuko.syouhinsyu::text)=1 
            THEN concat_ws('00', minyuko.syouhinid, minyuko.syouhinsyu)
            ELSE concat_ws('', minyuko.syouhinid, minyuko.syouhinsyu)
        END AS data206,
        -- minyuko.soukobango,
        to_char(minyuko.yoteibi, 'YYYY/MM/DD') as yoteibi
        FROM orderhenkan
        join (Select kokyakuorderbango,max(ordertypebango2) as ordertypebango2 from orderhenkan group by kokyakuorderbango )
            as m_orderhenkan on m_orderhenkan.kokyakuorderbango = orderhenkan.kokyakuorderbango
            and m_orderhenkan.ordertypebango2 = orderhenkan.ordertypebango2
        inner join minyuko on orderhenkan.kokyakuorderbango = minyuko.syouhinid and orderhenkan.bango = minyuko.orderbango
        left join juchusyukko2 on  orderhenkan.kokyakuorderbango = juchusyukko2.syouhinid and orderhenkan.bango = juchusyukko2.orderbango
        left join v_torihikisaki as v_torihikisaki_1 on v_torihikisaki_1.torihikisaki_cd = orderhenkan.datachar10
        left join v_torihikisaki as v_torihikisaki_2 on v_torihikisaki_2.torihikisaki_cd = orderhenkan.datachar11
        $condition_sql and juchusyukko2.day = 2 
        -- and (juchusyukko2.denpyoshimebi >='$previousDate' and juchusyukko2.denpyoshimebi <='$systemDate')
        ");
        return DB::table('order_detail_temp');
    }
    // and juchusyukko2.day = 2 and juchusyukko2.denpyoshimebi between '$previousDate' and '$systemDate'
}
