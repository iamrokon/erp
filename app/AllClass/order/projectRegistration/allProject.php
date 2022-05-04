<?php

namespace App\AllClass\order\projectRegistration;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\kengen;
use App\syouhin2;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class allProject{
    public static function data($bango,$deleted_item=2){

        QueryHelper::runQuery("DROP TABLE IF EXISTS project_temp");

        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE project_temp as
        select distinct
        gazou2.url,
        gazou2.url as project_url,
        gazou2.urlsm,
        gazou2.catchsm,
        gazou2.catchsm as content_catchsm,
        catchsmKokyaku1.address as catchsm_address,
        gazou2.caption,
        captionKokyaku1.address as caption_address,
        gazou2.setumei,
        setumeiTantousya.name as setumei_name,
        gazou2.setumei as content_setumei,
        gazou2.catch,
        catchTantousya.name as catch_name,
        gazou2.mbcatch,
        CASE
            WHEN gazou2.mbcatch is null THEN NULL
            ELSE concat_ws('/',substring(gazou2.mbcatch,1,4),
            substring(gazou2.mbcatch,5,2)) END as mbcatch_date ,
        gazou2.mbcatchsm,
        CASE
            WHEN gazou2.mbcatchsm is null THEN NULL
            ELSE concat_ws('/',substring(gazou2.mbcatchsm,1,4),
            substring(gazou2.mbcatchsm,5,2)) END as mbcatchsm_date ,
        gazou2.mbcaption,
        gazou2.datatxt0096,
        gazou2.datatxt0097,
        gazou2.datatxt0098,
        gazou2.datatxt0099,
        gazou2.hyouji,
        tantousya.name as user_name,
        
        CASE
            WHEN gazou2.datatxt0096 is null THEN NULL
            ELSE concat_ws('/',substring(gazou2.datatxt0096,1,4),
            substring(gazou2.datatxt0096,5,2),
            substring(gazou2.datatxt0096,7,2)) END as created_date ,

        CASE
            WHEN gazou2.datatxt0096 is null THEN NULL
            ELSE concat_ws(':',substring(gazou2.datatxt0096,9,2),
            substring(gazou2.datatxt0096,11,2),
            substring(gazou2.datatxt0096,13,2)) END as created_time,
            
        CASE
            WHEN gazou2.datatxt0097 is null THEN NULL
            ELSE concat_ws('/',substring(gazou2.datatxt0097,1,4),
            substring(gazou2.datatxt0097,5,2),
            substring(gazou2.datatxt0097,7,2)) END as edited_date,

        CASE
            WHEN gazou2.datatxt0097 is null THEN NULL
            ELSE concat_ws(':',substring(gazou2.datatxt0097,9,2),
            substring(gazou2.datatxt0097,11,2),
            substring(gazou2.datatxt0097,13,2)) END as edited_time

        from gazou2
        
        left join tantousya on tantousya.bango = gazou2.datatxt0098
        
        left join tantousya as setumeiTantousya on setumeiTantousya.bango = gazou2.setumei
        
        left join tantousya as catchTantousya on catchTantousya.bango = gazou2.catch
        
        left join kokyaku1 as catchsmKokyaku1 on catchsmKokyaku1.yobi12 = gazou2.catchsm
        
        left join kokyaku1 as captionKokyaku1 on captionKokyaku1.yobi12 = gazou2.caption

        ORDER BY url ");



        $data=DB::table('project_temp');

        if ($deleted_item==1) {
            $data=DB::table('project_temp')->whereRaw('hyouji = ' . 1);
        }elseif($deleted_item==0){
            $data=DB::table('project_temp')->whereRaw('hyouji = ' . 0);
        }else if ($deleted_item === '*') {
            $data = DB::table('project_temp');
        }else{
            $data=DB::table('project_temp');
        }

        return $data;
        
    }
}
