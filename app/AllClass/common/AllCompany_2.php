<?php

namespace App\AllClass\common;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\kengen;
use App\kokyaku1;
use App\haisoujouhou;

class AllCompany_2
{
    public static function data($bango, $deleted_item = 2, $condition,$userId = null)
    {

        QueryHelper::runQuery("DROP TABLE IF EXISTS hasiso_temp");

        QueryHelper::runQuery(
            "CREATE TEMPORARY TABLE hasiso_temp as
        select 
        --distinct on(kokyaku1.yobi12)
        haisou.bango,
        kokyaku1.yobi12,
        haisou.shikibetsucode,
        others2.other1,
        others2.other19,
        others2.other20,
        others2.other21,
        others2.other24,
        haisou.syukeiki

        from haisou
        left join kokyaku1 on kokyaku1.yobi12=haisou.shikibetsucode
        left join others2 on others2.otherint1 = haisou.bango
        --where haisou.shikibetsucode='003057'
        --and haisou.bango='754'
         ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS company_temp_before");
        QueryHelper::runQuery(
            "CREATE TEMPORARY TABLE company_temp_before as
        select distinct on(kokyaku1.yobi12)
        --distinct
        kokyaku1.bango,
        kokyaku1.yobi12,
        kokyaku1.name,
        kokyaku1.address,
        kokyaku1.yobi13,
        CASE
            WHEN kokyaku1.yobi13 is null THEN NULL
            WHEN strpos(kokyaku1.yobi13,'¶')<1 THEN kokyaku1.yobi13
            ELSE concat(SPLIT_PART(kokyaku1.yobi13::text,'¶',1),'.',SPLIT_PART(kokyaku1.yobi13::text,'.',2))
            END as yobi13_short,
        kokyaku1.torihikisakibango,
        kokyaku1.kensakukey,
        kokyaku1.ytoiawsestart,
        kokyaku1.ytoiawsesaiban,
        kokyaku1.denpyostart,
        kokyaku1.mail_jyushin,
        kokyaku1.pointterm,
        kokyaku1.denpyosaiban,
        haisoujouhou.mail,
        haisoujouhou.kounyusu,
        haisoujouhou.syukeitukikijun,
        haisoujouhou.syukeituki,
        haisoujouhou.syukeikikijun,
        substring(hasiso_temp.other1,1,1) as other1,
        hasiso_temp.syukeiki,
        tantousya.name as user_name

        from kokyaku1

        left join haisoujouhou on haisoujouhou.syukei1 = kokyaku1.bango
        left join hasiso_temp on hasiso_temp.shikibetsucode = kokyaku1.yobi12
        left join tantousya on tantousya.bango = kokyaku1.pointterm

        where
              CASE WHEN substring(hasiso_temp.other1,1,1) = '1'
                  THEN substring(haisoujouhou.syukeikikijun,1,1) = '1'
                  WHEN substring(hasiso_temp.other1,1,1) ='2'
                  THEN substring(hasiso_temp.syukeiki,1,1) = '1' END
        --ORDER BY kokyaku1.name
        ");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS company_temp");
        QueryHelper::runQuery(
            "CREATE TEMPORARY TABLE company_temp as
            select *
            from company_temp_before
            ORDER BY name ");


        $data = DB::table('company_temp');
//        dd(print_r($data));
        if ($deleted_item == 1) {
            $data = DB::table('company_temp')->whereRaw('denpyosaiban = ' . 1);
        } elseif ($deleted_item === 0) {
            $data = DB::table('company_temp')->whereRaw("denpyosaiban = " . 0);
        } else if ($deleted_item === '*') {
            $data = DB::table('company_temp');
        } else {
            $data = DB::table('company_temp');
        }

        if ($userId) {
            $data = $data->whereRaw("bango = '$userId'");
        } else {
            $data = $data;
        }
//        dd($data);
//        $data = DB::table('hasiso_temp');
        return $data->toSql();
    }
}
