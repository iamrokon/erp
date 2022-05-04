<?php

namespace App\AllClass\other\dashboardComment;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\kengen;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class allDashboardComment{
  public static function data($bango = null, $deleted_item = 2, $id = null, $from = false, $yukouflag = null, $get_year = null, $order_by_date = null, $get_lower_data = null)
  {
      QueryHelper::runQuery("DROP TABLE IF EXISTS ecsyouhinjyouhou_temp");
      QueryHelper::runQuery("CREATE TEMPORARY TABLE ecsyouhinjyouhou_temp as
        select
        syouhinbango,
        sitesyubetsu,
        sitehinban,
        yukouflag,
        CASE
        	WHEN yukouflag = 1 THEN '1：LAMU'
        	ELSE '2：その他の' END as notice ,

        bunpaipercent,
        (select name from tantousya where bango = ecsyouhinjyouhou.bunpaipercent) as user_name,
        CASE
        	WHEN kinsyousu = 0 THEN NULL
        	ELSE concat_ws('/',substring(CAST(kinsyousu as text),1,4),
        	substring(CAST(kinsyousu as text),5,2),
        	substring(CAST(kinsyousu as text),7,2)) END as created_date ,

        CASE
        	WHEN kinsyousu = 0 THEN NULL
        	ELSE concat_ws('/',substring(CAST(kinsyousu as text),1,4)) END as year ,

        CASE
        	WHEN kinsyousetteisu = 0 THEN NULL
        	WHEN kinsyousetteisu is null THEN NULL
        	ELSE concat_ws('/',substring(CAST(kinsyousetteisu as text),1,4),
        	substring(CAST(kinsyousetteisu as text),5,2),
        	substring(CAST(kinsyousetteisu as text),7,2)) END as edited_date,

        CASE
        	WHEN saisinjikoku is null THEN NULL
        	ELSE REPLACE(substring(CAST(saisinjikoku AS text),1,10),'-','') END as submit_date,
        CASE
        	WHEN saisinjikoku is null THEN NULL
        	ELSE REPLACE(substring(CAST(saisinjikoku AS text),1,10),'-','/') END as submit_date_xls,
        CASE
        	WHEN saisinjikoku is null THEN NULL
        	ELSE substring(CAST(saisinjikoku as text),12,8) END as submit_time,
        kinsyousu,
        kinsyousetteisu,
        saisinjikoku,
        kousinzaikosu,
        status,
        --TRIM(regexp_replace(status, E'<[^>]+>', '', 'gi')) as status_without_tag,
        CASE
         WHEN length(TRIM(regexp_replace(status, E'<[^>]+>', '', 'gi'))) > 11
            THEN LEFT(TRIM(regexp_replace(status, E'<[^>]+>', '', 'gi')),10)||'...'
            ELSE TRIM(regexp_replace(status, E'<[^>]+>', '', 'gi')) END as status_without_tag,
        check01,
        kakuhosu,
        leadtime,
        jidoujuchuflag,
        yoyakuflag,
        yoyakusaidaisu,
        yoyakuhanbaisu,
        hanbaimode,
        syouhinzokusei
        from ecsyouhinjyouhou
        --ORDER BY syouhinbango
        ORDER BY created_date DESC,sitesyubetsu DESC
      ");
      //$data = DB::table('ecsyouhinjyouhou_temp');
      if ($deleted_item == 1) {
          $data = DB::table('ecsyouhinjyouhou_temp')->whereRaw('jidoujuchuflag = ' . 1);
      } else if ($deleted_item === 0) {
          $data = DB::table('ecsyouhinjyouhou_temp')->whereRaw('jidoujuchuflag = ' . 0);
      } else if ($deleted_item === '*') {
          $data = DB::table('ecsyouhinjyouhou_temp');
      }

      if ($yukouflag) {
          $data = $data->whereRaw("yukouflag = '$yukouflag'");
      }
      if ($get_year) {
          //$data =  QueryHelper::fetchResult("select DISTINCT year from ecsyouhinjyouhou_temp where yukouflag = '$yukouflag' and DATE(created_date) <= DATE(NOW()) and DATE(edited_date) >= DATE(NOW()) ORDER BY year DESC");
          $data =  QueryHelper::fetchResult("select DISTINCT year from ecsyouhinjyouhou_temp where yukouflag = '$yukouflag' and DATE(created_date) <= DATE(NOW()) ORDER BY year DESC");
          return $data;
      }
      if ($id) {
          $data = $data->whereRaw("syouhinbango = '$id'")->toSql();
      } else {
          $data = $data->toSql();
      }
      if ($get_lower_data) {
          //$data = $data." and kinsyousu <= '$get_lower_data' and DATE(created_date) <= DATE(NOW()) and DATE(edited_date) >= DATE(NOW()) order by created_date DESC,syouhinbango DESC";
          $data = $data." and kinsyousu <= '$get_lower_data' and DATE(created_date) <= DATE(NOW()) order by created_date DESC,syouhinbango DESC";
      }
      if ($order_by_date) {
          //$data = $data." and DATE(created_date) <= DATE(NOW()) and DATE(edited_date) >= DATE(NOW()) order by created_date DESC,syouhinbango DESC";
          $data = $data." and DATE(created_date) <= DATE(NOW()) order by created_date DESC,syouhinbango DESC";
      }
//      dd(QueryHelper::fetchResult('select * from ecsyouhinjyouhou_temp'));
      return $data;
  }
}
