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


Class AllCompany
{
    public static function data($bango, $deleted_item = 2, $condition,$userId = null)
    {
        if($condition == 1){
            $sql = 'where substring(haisoujouhou.syukeituki,1,1)::int = 1';
        }elseif($condition == 2){
            $sql = 'where substring(haisoujouhou.syukeikikijun,1,1)::int = 1';
        }elseif($condition == 3){
            $sql = 'where substring(haisoujouhou.syukeituki,1,1)::int = 1 OR substring(haisoujouhou.syukeituki,1,1)::int = 2';
        }else{
            $sql = "";
        }

        QueryHelper::runQuery("DROP TABLE IF EXISTS company_temp");

        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE company_temp as
        select distinct
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
        --CASE
        --    WHEN trim(kokyaku1.ytoiawsestart || ' ' || categorykanriYtoiawsestart.category4) = '' THEN NULL
        --    ELSE trim(kokyaku1.ytoiawsestart || ' ' || categorykanriYtoiawsestart.category4) END as ytoiawsestart_detail,
        --CASE
        --    WHEN trim(categorykanriYtoiawsestart.category4) = '' THEN NULL
        --    ELSE trim(categorykanriYtoiawsestart.category4) END as ytoiawsestart_supplier,
        kokyaku1.ytoiawsesaiban,
        --SPLIT_PART(kokyaku1.ytoiawsesaiban,' ',2) as ytoiawsesaiban_detail,
        --CASE 
        --    WHEN kokyaku1.yetoiawsestart = '31' THEN '末'
        --    ELSE kokyaku1.yetoiawsestart END as yetoiawsestart,
        kokyaku1.denpyostart,
        kokyaku1.mail_jyushin,
        --kokyaku1.mail_nouhin,
        --kokyaku1.mail_jyushin_mb,
        kokyaku1.pointterm,
        kokyaku1.denpyosaiban,
        haisoujouhou.mail,
        haisoujouhou.kounyusu,
        haisoujouhou.syukeitukikijun,
        haisoujouhou.syukeituki,
        haisoujouhou.syukeikikijun,
        tantousya.name as user_name

        from kokyaku1

        left join haisoujouhou on haisoujouhou.syukei1 = kokyaku1.bango

        --left join categorykanri as categorykanriYtoiawsestart
        --on substring(kokyaku1.ytoiawsestart,1,2) = categorykanriYtoiawsestart.category1
        --and substring(kokyaku1.ytoiawsestart,3,4) = categorykanriYtoiawsestart.category2

        left join categorykanri as categorykanriMail_toiawase_mb
        on substring(kokyaku1.mail_toiawase_mb,1,2) = categorykanriMail_toiawase_mb.category1
        and substring(kokyaku1.mail_toiawase_mb,3,4) = categorykanriMail_toiawase_mb.category2

        left join tantousya on tantousya.bango = kokyaku1.pointterm

        $sql

        ORDER BY kokyaku1.name ");


        $data = DB::table('company_temp');

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

        return $data->toSql();
    }
}
