<?php


namespace App\AllClass\order\orderEntry;


use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;

class AllOrderProductSubs
{

    public static function data($bango, $order_id = null)
    {
        QueryHelper::runQuery("DROP TABLE IF EXISTS all_order_product_sub");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_order_product_sub as
        select distinct
             others.other1,
             others.other2 as product_sub_cd,
             others.other21 as product_sub_name,
             concat(categorykanri1.category2,' ',categorykanri1.category4) as suppliers,
             concat(substring(categorykanri2.category2,6,8),' ',categorykanri2.category4) as data_type,
             concat(substring(categorykanri3.category2,9,10),' ',categorykanri3.category4) as version,
            others.other26 as create_date,
            others.other27 as update_date,
            others.other3,
            others.other4,
            others.other25
        from others
        left join categorykanri as categorykanri1 on substring(others.other3,1,2) = categorykanri1.category1 and substring(others.other3,3,7) = categorykanri1.category2 and categorykanri1.category1 = 'E4'
        left join categorykanri as categorykanri2 on substring(others.other4,1,2) = categorykanri2.category1 and substring(others.other4,3,10) = categorykanri2.category2 and categorykanri2.category1 = 'E5'
        left join categorykanri as categorykanri3 on substring(others.other25,1,2) = categorykanri3.category1 and substring(others.other25,3,12) = categorykanri3.category2 and categorykanri3.category1 = 'E8'
        ORDER BY product_sub_cd ");

        return DB::table('all_order_product_sub')->toSql();
    }

}
