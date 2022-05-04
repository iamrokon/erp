<?php


namespace App\AllClass\purchase\purchaseInput;


use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;

class orderDetail
{
    public static function data($bango, $orderId)
    {
        $datanum0013 = QueryHelper::fetchSingleResult("select max(datanum0013) from toiawasebango where unsoumei = '$orderId' ")->max ?? 0;
        QueryHelper::runQuery("DROP TABLE IF EXISTS order_detail_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE order_detail_temp as
        select distinct
        toiawasebango.bikou1 as supplier_db,
        toiawasebango.bikou2 as comments,
        toiawasebango.unsoumei as purchase_number,
        toiawasebango.toiawasebango as order_classification,
        toiawasebango.unsoumei as number_search,
        to_char(toiawasebango.touchakudate, 'YYYY/MM/DD') as purchase_date,
        toiawasebango.denpyoname as delivery_note,
        v_torihikisaki_1.r16cd as supplier,
        -- v_torihikisaki_2.r17_3cd as reg_sales_billing_destination,
        -- v_torihikisaki_3.r17_3cd as reg_end_customer,
        CASE
            WHEN toiawasebango.dataint01 IS NULL THEN NULL
            ELSE
            concat_ws('/',substring(CAST(toiawasebango.dataint01 as text),1,4),
            substring(CAST(toiawasebango.dataint01 as text),5,2),
            substring(CAST(toiawasebango.dataint01 as text),7,2))
        END as delivery_date, 
        CASE
            WHEN toiawasebango.dataint02 IS NULL THEN NULL
            ELSE
            concat_ws('/',substring(CAST(toiawasebango.dataint02 as text),1,4),
            substring(CAST(toiawasebango.dataint02 as text),5,2),
            substring(CAST(toiawasebango.dataint02 as text),7,2))
        END as payment_date,       
        tantousya.name as employee_name,
        tantousya_1.name as instructor,
        tantousya_2.name as inspector,    
        toiawasebango.datanum0013 as datanum0013,
        hikiatenyuko.syouhinsyu,
        hikiatenyuko.hantei,
        hikiatenyuko.dataint01,
        hikiatenyuko.datachar06,
        hikiatenyuko.datachar07 
        FROM toiawasebango
        left join tantousya on toiawasebango.touchakutime = tantousya.bango
        left join hikiatenyuko on  toiawasebango.unsoumei = hikiatenyuko.syouhinid
        left join tantousya as tantousya_1 on hikiatenyuko.datachar06 = tantousya_1.bango
        left join tantousya as tantousya_2 on hikiatenyuko.datachar07 = tantousya_2.bango
        -- left join tuhanorder on orderhenkan.bango  = tuhanorder.orderbango
        --left join soukonyuko on orderhenkan.bango  = soukonyuko.orderbango
        left join v_torihikisaki as v_torihikisaki_1 on toiawasebango.bikou1  = substring(v_torihikisaki_1.torihikisaki_cd, 1, 8)
        -- left join v_torihikisaki as v_torihikisaki_2 on v_torihikisaki_2.torihikisaki_cd = tuhanorder.information2 
        where toiawasebango.unsoumei ='$orderId' and toiawasebango.datanum0013  = $datanum0013 and toiawasebango.datachar03 != '1'
        ");
//        orderhenkan.datachar05 = '$bango'
        return DB::table('order_detail_temp')->toSql();

    }

}
