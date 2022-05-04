<?php

namespace App\AllClass\master\productDescription;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;

class AllProductDescription
{
    public static function data($bango, $deleted_item = 2)
    {
        QueryHelper::runQuery("DROP TABLE IF EXISTS product_desc_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE product_desc_temp as
        select distinct
        CASE
        WHEN trim(gazou.url) = '' THEN NULL
        ELSE  gazou.url END,
        CASE
        WHEN trim( gazou.urlsm) = '' THEN NULL
        ELSE  gazou.urlsm END,
        CASE
        WHEN trim( gazou.urlsm) = '' THEN NULL
        ELSE  gazou.urlsm  END as product_des_urlsm,
        gazou.hantei  AS supplementary_explanation,
        CASE
            When length(gazou.urlsm) = 5 THEN
                syouhin1.name
            ELSE
                others.other21
            END as shohin1_name ,
        CASE
        WHEN trim(gazou.mbcatch) = '' THEN NULL
        ELSE gazou.mbcatch END,
        CASE
        WHEN trim(gazou.setumei) = '' THEN NULL
        ELSE gazou.setumei END,
        CASE
        WHEN trim(gazou.catch) = '' THEN NULL
        ELSE gazou.catch END,
        CASE
        WHEN trim(gazou.caption) = '' THEN NULL
        ELSE gazou.caption END,
        CASE
        WHEN trim(gazou.catchsm) = '' THEN NULL
        ELSE gazou.catchsm END,
        CASE
        WHEN trim(gazou.mbcatchsm) = '' THEN NULL
        ELSE gazou.mbcatchsm END,
        CASE
        WHEN trim(gazou.mbcaption) = '' THEN NULL
        ELSE gazou.mbcaption END,
        CASE
        WHEN  trim(gazou.datatxt0098) is null THEN NULL
        ELSE concat_ws('/',substring(gazou.datatxt0098,1,4),
        substring(gazou.datatxt0098,5,2),
        substring(gazou.datatxt0098,7,2)) END as created_date,
        CASE
        WHEN trim(gazou.datatxt0098) is null THEN NULL
        ELSE concat_ws(':',substring(gazou.datatxt0098,9,2),
        substring(gazou.datatxt0098,11,2),
        substring(gazou.datatxt0098,13,2))  END as created_time,
        CASE
        WHEN trim(gazou.datatxt0099) is null THEN NULL
        ELSE  concat_ws('/',substring(gazou.datatxt0099,1,4),
        substring(gazou.datatxt0099,5,2),
        substring(gazou.datatxt0099,7,2)) END as edited_date,
        CASE
        WHEN trim(gazou.datatxt0099) is null THEN NULL
        ELSE  concat_ws(':',substring(gazou.datatxt0099,9,2),
        substring(gazou.datatxt0099,11,2),
        substring(gazou.datatxt0099,13,2)) END as edited_time,
        CASE
        WHEN trim(gazou.datatxt0100) = '' THEN NULL
        ELSE  gazou.datatxt0100 END as ip_address,
        CASE
        WHEN trim(tantousya.name) = '' THEN NULL
        ELSE  tantousya.name END as created_by,
        gazou.datatxt0098,
        gazou.hyouji,
        gazou.datatxt0096,
        CONCAT(request.syouhinbango,' ',request.jouhou) as datatxt0096_view
        from gazou
        left join syouhin1
           on gazou.urlsm = syouhin1.kokyakusyouhinbango
        left join others
            on cast(gazou.urlsm as varchar(100)) = cast(others.other2 as varchar(100))
        left join tantousya
            on  cast(gazou.datatxt0101 as varchar(100)) = cast(tantousya.bango as varchar(100))
        left join  request
            on cast(gazou.datatxt0096 as varchar(20)) = cast(request.syouhinbango as varchar(20)) and request.color = '0815入力区分'
        ");

        if ($deleted_item == 1) {
            $data = DB::table('product_desc_temp')->whereRaw("hyouji = 1");
        } elseif ($deleted_item == 0) {
            $data = DB::table('product_desc_temp')->whereRaw("hyouji = 0");
        } else {
            $data = DB::table('product_desc_temp');
        }
        return $data->toSql();
    }

}
