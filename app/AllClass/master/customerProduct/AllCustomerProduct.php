<?php


namespace App\AllClass\master\customerProduct;


use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;

class AllCustomerProduct
{
    public static function data($bango, $deleted_item = 2)
    {
        QueryHelper::runQuery("DROP TABLE IF EXISTS customer_product_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE customer_product_temp as
        select distinct
        concat_ws('|',kakaku.syutenjyouken,kakaku.syutenbi,kakaku.icon) as uuid,
        kakaku.syouhinbango,
        kakaku.syutenbi,
        kakaku.syutenjyouken,
        kakaku.pointritu,
        kakaku.icon as edit_icon,
        CASE
        WHEN trim(CONCAT(kakaku.syutenjyouken,' ',kokyaku1.name)) = '' THEN NULL
        ELSE trim(CONCAT(kakaku.syutenjyouken,' ',kokyaku1.name)) END as company_name,
        CASE
        WHEN trim(kakaku.syutenjyouken) = '' THEN NULL
        ELSE cast(kakaku.syutenjyouken as integer ) END as company_search_sort,
        CASE
        WHEN trim(CONCAT(kakaku.syutenbi,' ',syouhin1.name)) = '' THEN NULL
        ELSE trim(CONCAT(kakaku.syutenbi,' ',syouhin1.name)) END as product_name,
        CASE
        WHEN trim(kakaku.syutenbi) = '' THEN NULL
        ELSE cast(kakaku.syutenbi as integer) END as product_search_sort,
        CASE
        WHEN trim(CONCAT(kakaku.icon,' ',categorykanri.category4)) = '' THEN NULL
        ELSE trim(CONCAT(kakaku.icon,' ',categorykanri.category4)) END as icon,
        CASE
        WHEN kakaku.kakaku is null THEN NULL
        ELSE kakaku.kakaku END,
        to_char(kakaku.kakaku,'FM99,999,999,999,999') as formatted_kakaku,
        CASE
        WHEN kakaku.hanbaisu is null THEN NULL
        ELSE kakaku.hanbaisu END,
        to_char(kakaku.hanbaisu,'FM99,999,999,999,999') as formatted_hanbaisu,
        CASE
        WHEN kakaku.jyougensu is null THEN NULL
        ELSE kakaku.jyougensu END,
        to_char(kakaku.jyougensu,'FM99,999,999,999,999') as formatted_jyougensu,
        CASE
        WHEN kakaku.yoyaku is null THEN NULL
        ELSE kakaku.yoyaku END,
        to_char(kakaku.yoyaku,'FM99,999,999,999,999') as formatted_yoyaku,
        CASE
        WHEN kakaku.yoyakusu is null THEN NULL
        ELSE kakaku.yoyakusu END,
        to_char(kakaku.yoyakusu,'FM99,999,999,999,999') as formatted_yoyakusu,
        CASE
        WHEN kakaku.yoyakukanousu is null THEN NULL
        ELSE kakaku.yoyakukanousu END,
        to_char(kakaku.yoyakukanousu,'FM99,999,999,999,999') as formatted_yoyakukanousu,
        CASE
        WHEN kakaku.sortbango is null THEN NULL
        ELSE kakaku.sortbango END,
        to_char(kakaku.sortbango,'FM99,999,999,999,999') as formatted_sortbango,
        kakaku.dataint01,
        to_char(kakaku.dataint01,'FM99,999,999,999,999') as formatted_dataint01,
        CASE
        WHEN kakaku.datachar01 is null THEN NULL
        WHEN trim(kakaku.datachar01) = '' THEN NULL
        ELSE kakaku.datachar01 END,
        CASE
        WHEN kakaku.datachar02 is null THEN NULL
        WHEN trim(kakaku.datachar02) = '' THEN NULL
        ELSE kakaku.datachar02 END,
        kakaku.datachar03,
        CASE
        WHEN trim(kakaku.datachar03) is null THEN NULL
        ELSE concat_ws('/',substring(kakaku.datachar03,1,4),
            substring(kakaku.datachar03,5,2),
            substring(kakaku.datachar03,7,2)) END as created_date,
        CASE
        WHEN trim(kakaku.datachar03) is null THEN NULL
        ELSE concat_ws(':',substring(kakaku.datachar03,9,2),
            substring(kakaku.datachar03,11,2),
            substring(kakaku.datachar03,13,2)) END as created_time,
        CASE
        WHEN trim(kakaku.datatxt0080) is null THEN NULL
            ELSE  concat_ws('/',substring(kakaku.datatxt0080,1,4),
            substring(kakaku.datatxt0080,5,2),
            substring(kakaku.datatxt0080,7,2)) END as edited_date,
        CASE
        WHEN trim(kakaku.datatxt0080) is null THEN NULL
            ELSE  concat_ws(':',substring(kakaku.datatxt0080,9,2),
            substring(kakaku.datatxt0080,11,2),
            substring(kakaku.datatxt0080,13,2) )  END as edited_time,
        kakaku.datatxt0080,
        kakaku.datatxt0081,
        kokyaku1.bango as kokyaku1bango,
        syouhin1.bango as syouhin1bango,
        cast(kakaku.datatxt0082 as varchar(100)),
        tantousya.name as created_by
        from kakaku
        left join syouhin1
           on  kakaku.syouhinbango = syouhin1.bango
        left join  tantousya
            on  cast(kakaku.datatxt0082 as varchar(100)) = cast(tantousya.bango as varchar(100))
        left join kokyaku1
           on kakaku.syutenjyouken = kokyaku1.yobi12
        left join categorykanri
              on substring(kakaku.icon,1,2) = categorykanri.category1
                  and substring(kakaku.icon,3,2) = categorykanri.category2
                         and categorykanri.suchi2 = 0
        order by kokyaku1bango, syouhin1bango ");

        if ($deleted_item == 1) {
            $data = DB::table('customer_product_temp')->whereRaw("pointritu = 1");
        } elseif ($deleted_item == 0) {
            $data = DB::table('customer_product_temp')->whereRaw("pointritu = 0");
        } else {
            $data = DB::table('customer_product_temp');
        }

        return $data->toSql();
    }

}
