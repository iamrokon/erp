<?php

namespace App\AllClass\master\productMaster;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\kengen;
use App\syouhin1;
use App\syouhin2;
use App\Kakaku;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class allProduct{
  public static function data($bango,$deleted_item=2)
  {
//   if(Schema::hasTable('product_temp'))
//    {
//        Schema::drop('product_temp');
//    }
    /*$users=DB::select(DB::raw(
                 "select *,CONCAT(id1,' ',company_name1) as company_1,CONCAT(id2,' ',company_name2) as company_2,CONCAT(id3,' ',company_name3) as company_3 from tantousya
left join ( select CONCAT(category1,category2) as id1 , category4 as company_name1 from categorykanri )  categorykanri_1 on tantousya.datatxt0003=categorykanri_1.id1
left join ( select CONCAT(category1,category2) as id2 , category4 as company_name2 from categorykanri )  categorykanri_2 on tantousya.datatxt0004=categorykanri_2.id2
left join ( select CONCAT(category1,category2) as id3 , category4 as company_name3 from categorykanri )  categorykanri_3 on tantousya.datatxt0005=categorykanri_3.id3
    where deleteflag=null or deleteflag=0"));*/

      QueryHelper::runQuery("DROP TABLE IF EXISTS product_temp");

      QueryHelper::runQuery(
                 "CREATE TEMPORARY TABLE product_temp as
select distinct
syouhin1.bango,

syouhin1.kokyakusyouhinbango as kokyakusyouhinbango,
CASE
    WHEN syouhin1.kokyakusyouhinbango is null or syouhin1.kokyakusyouhinbango='' THEN NULL
    ELSE syouhin1.kokyakusyouhinbango  END as product_kokyakusyouhinbango,
    
syouhin1.name,
syouhin1.jouhou ,
syouhin1.koyuujouhou,
syouhin1.color,
syouhin1.bumon,
syouhin1.yoyaku,
syouhin1.data20 as product_data20,
CASE
    WHEN trim(syouhin1.data20 || ' ' || categorykanriYoyaku.category4) = '' THEN NULL
    ELSE trim(syouhin1.data20 || ' ' || categorykanriYoyaku.category4) END as yoyaku_detail,
syouhin1.data21,
syouhin1.tokuchou,
syouhin1.data22,
syouhin1.data23,
syouhin1.data24,

syouhin1.season,
CASE
    WHEN syouhin1.season is null or syouhin1.season='' THEN NULL
    ELSE syouhin1.season  END as product_season,
    
syouhin1.size,
syouhin1.kakaku,
to_char(syouhin1.kakaku,'FM99,999,999,999,999') as formatted_kakaku,
syouhin1.data25,
syouhin1.data52,
syouhin1.data53,
syouhin1.data54,
syouhin1.data100,
syouhin1.data50,
syouhin1.data51,
syouhin1.meker,
syouhin1.synchrosyouhinbango,
syouhin1.endtime,
syouhin1.data26,
syouhin1.data27,
syouhin1.data28,
syouhin1.data29,
CASE
    WHEN trim(syouhin1.data29 || ' ' || categorykanriData29.category4) = '' THEN NULL
    ELSE trim(syouhin1.data29 || ' ' || categorykanriData29.category4) END as data29_detail,
syouhin1.data101,
CASE
    WHEN trim(syouhin1.data101 || ' ' || categorykanriData101.category4) = '' THEN NULL
    ELSE trim(syouhin1.data101 || ' ' || categorykanriData101.category4) END as data101_detail,
syouhin1.data102,
syouhin1.data103,
syouhin1.name2,
syouhin1.url,
CASE
    WHEN trim(syouhin1.url || ' ' || categorykanriUrl.category4) = '' THEN NULL
    ELSE trim(syouhin1.url || ' ' || categorykanriUrl.category4) END as url_detail,
syouhin1.url_mobile,
CASE
    WHEN trim(syouhin1.url_mobile) = '' THEN NULL
    ELSE trim(syouhin1.url_mobile || ' ' || s1.name) END as url_mobile_detail,
syouhin1.kongouritsu as product_kongouritsu,
syouhin1.mdjouhou,

syouhin1.data104,
CASE
    WHEN syouhin1.data104 is null or syouhin1.data104='' THEN NULL
    ELSE syouhin1.data104 END as product_data104,
    
syouhin1.kokyakubango,
syouhin1.isuriage,
syouhin1.code1,
syouhin1.code2,
syouhin1.code3,
CASE
    WHEN trim(syouhin1.jouhou || ' ' || categorykanriJouhou.category4) = '' THEN NULL
    ELSE trim(syouhin1.jouhou || ' ' || categorykanriJouhou.category4) END as jouhou_detail,
CASE
    WHEN trim(syouhin1.koyuujouhou || ' ' || categorykanriKoyuujouhou.category4) = '' THEN NULL
    ELSE trim(syouhin1.koyuujouhou || ' ' || categorykanriKoyuujouhou.category4) END as koyuujouhou_detail,
CASE
    WHEN trim(syouhin1.color || ' ' || categorykanriColor.category4) = '' THEN NULL
    ELSE trim(syouhin1.color || ' ' || categorykanriColor.category4) END as color_detail,
CASE
    WHEN trim(syouhin1.bumon || ' ' || categorykanriBumon.category4) = '' THEN NULL
    ELSE trim(syouhin1.bumon || ' ' || categorykanriBumon.category4) END as bumon_detail,
CASE
    WHEN trim(syouhin1.data26 || ' ' || categorykanriData26.category4) = '' THEN NULL
    ELSE trim(syouhin1.data26 || ' ' || categorykanriData26.category4) END as data26_detail,
CASE
    WHEN trim(syouhin1.data52 || ' ' || categorykanriData52.category4) = '' THEN NULL
    ELSE trim(syouhin1.data52 || ' ' || categorykanriData52.category4) END as data52_detail,
CASE
    WHEN trim(syouhin1.data53 || ' ' || categorykanriData53.category4) = '' THEN NULL
    ELSE trim(syouhin1.data53 || ' ' || categorykanriData53.category4) END as data53_detail,
CASE
    WHEN trim(syouhin1.data54 || ' ' || categorykanriData54.category4) = '' THEN NULL
    ELSE trim(syouhin1.data54 || ' ' || categorykanriData54.category4) END as data54_detail,
CASE
    WHEN trim(syouhin1.data100 || ' ' || categorykanriData100.category4) = '' THEN NULL
    ELSE trim(syouhin1.data100 || ' ' || categorykanriData100.category4) END as data100_detail,
CASE
    WHEN trim(syouhin1.data28 || ' ' || categorykanriData28.category4) = '' THEN NULL
    ELSE trim(syouhin1.data28 || ' ' || categorykanriData28.category4) END as data28_detail,

kakaku.hanbaisu,
to_char(kakaku.hanbaisu,'FM99,999,999,999,999') as formatted_hanbaisu,
kakaku.jyougensu,
to_char(kakaku.jyougensu,'FM99,999,999,999,999') as formatted_jyougensu,
kakaku.yoyaku as kakaku_yoyaku,
to_char(kakaku.yoyaku,'FM99,999,999,999,999') as formatted_kakaku_yoyaku,
kakaku.yoyakusu,
to_char(kakaku.yoyakusu,'FM99,999,999,999,999') as formatted_yoyakusu,
kakaku.yoyakukanousu,
to_char(kakaku.yoyakukanousu,'FM99,999,999,999,999') as formatted_yoyakukanousu,
kakaku.sortbango,
to_char(kakaku.sortbango,'FM99,999,999,999,999') as formatted_sortbango,
kakaku.dataint01,
to_char(kakaku.dataint01,'FM99,999,999,999,999') as formatted_dataint01,
kakaku.syutenjyouken,
kakaku.syouhinbango,
syouhin2.jouhou2,
CASE
    WHEN trim(syouhin2.jouhou2 || ' ' || categorykanriJouhou2.category4) = '' THEN NULL
    ELSE trim(syouhin2.jouhou2 || ' ' || categorykanriJouhou2.category4) END as jouhou2_detail,
    
syouhin2.konpoumei,
syouhin2.catalogbango,

syouhin4.chardata4,
CASE
    WHEN syouhin4.chardata4 is null or syouhin4.chardata4='' THEN NULL
    ELSE syouhin4.chardata4 END as product_chardata4,
    
syouhin4.dspbango,
CASE
    WHEN trim(syouhin4.dspbango || ' ' || categorykanriDspbango.category4) = '' THEN NULL
    ELSE trim(syouhin4.dspbango || ' ' || categorykanriDspbango.category4) END as dspbango_detail,
syouhin4.color as s4_color,
CASE
    WHEN trim(syouhin4.color || ' ' || categorykanriS4Color.category4) = '' THEN NULL
    ELSE trim(syouhin4.color || ' ' || categorykanriS4Color.category4) END as s4_color_detail,
syouhin4.size as s4_size,
CASE
    WHEN trim(syouhin4.size || ' ' || categorykanriS4Size.category4) = '' THEN NULL
    ELSE trim(syouhin4.size || ' ' || categorykanriS4Size.category4) END as s4_size_detail,

syouhin4.syouhingroup,
CASE
    WHEN trim(syouhin4.syouhingroup || ' ' || categorykanriSyouhingroup.category4) = '' THEN NULL
    ELSE trim(syouhin4.syouhingroup || ' ' || categorykanriSyouhingroup.category4) END as syouhingroup_detail,

syouhin4.ruijihinbango,
CASE
    WHEN trim(syouhin4.ruijihinbango || ' ' || categorykanriRuijihinbango.category4) = '' THEN NULL
    ELSE trim(syouhin4.ruijihinbango || ' ' || categorykanriRuijihinbango.category4) END as ruijihinbango_detail,

syouhin4.chardata1,
CASE
    WHEN trim(syouhin4.chardata1 || ' ' || categorykanriChardata1.category4) = '' THEN NULL
    ELSE trim(syouhin4.chardata1 || ' ' || categorykanriChardata1.category4) END as chardata1_detail,

syouhin4.chardata2,
CASE
    WHEN trim(syouhin4.chardata2 || ' ' || categorykanriChardata2.category4) = '' THEN NULL
    ELSE trim(syouhin4.chardata2 || ' ' || categorykanriChardata2.category4) END as chardata2_detail,

tantousya.name as user_name,

CASE
    WHEN syouhin1.synchrosyouhinbango is null THEN NULL
ELSE concat(substring(CAST(syouhin1.synchrosyouhinbango as varchar(100)),1,4),'/',
substring(CAST(syouhin1.synchrosyouhinbango as varchar(100)),5,2),'/',
substring(CAST(syouhin1.synchrosyouhinbango as varchar(100)),7,2)) END as synchrosyouhinbango_detail ,

CASE
    WHEN syouhin1.endtime is null THEN NULL
ELSE concat_ws('/',substring(CAST(syouhin1.endtime as varchar(100)),1,4),
substring(CAST(syouhin1.endtime as varchar(100)),5,2),
substring(CAST(syouhin1.endtime as varchar(100)),7,2)) END as endtime_detail ,

CASE
    WHEN syouhin1.code1 is null THEN NULL
ELSE concat_ws('/',substring(syouhin1.code1,1,4),
substring(syouhin1.code1,5,2),
substring(syouhin1.code1,7,2)) END as created_date ,

CASE
    WHEN syouhin1.code1 is null THEN NULL
ELSE concat_ws(':',substring(syouhin1.code1,9,2),
substring(syouhin1.code1,11,2),
substring(syouhin1.code1,13,2)) END as created_time,

CASE
    WHEN syouhin1.code2 is null THEN NULL
ELSE concat_ws('/',substring(syouhin1.code2,1,4),
substring(syouhin1.code2,5,2),
substring(syouhin1.code2,7,2)) END as edited_date,

CASE
    WHEN syouhin1.code2 is null THEN NULL
ELSE concat_ws(':',substring(syouhin1.code2,9,2),
substring(syouhin1.code2,11,2),
substring(syouhin1.code2,13,2)) END as edited_time

from syouhin1

    join kakaku on kakaku.syouhinbango = syouhin1.bango
    join syouhin2 on syouhin2.bango = syouhin1.bango
    join syouhin4 on syouhin4.bango = syouhin1.bango

    left join categorykanri as categorykanriJouhou
    on substring(syouhin1.jouhou,1,2) = categorykanriJouhou.category1
    and substring(syouhin1.jouhou,3,4) = categorykanriJouhou.category2

   left join categorykanri as categorykanriKoyuujouhou
   on substring(syouhin1.koyuujouhou,1,2) = categorykanriKoyuujouhou.category1
    and substring(syouhin1.koyuujouhou,3,6) = categorykanriKoyuujouhou.category2
    
   left join categorykanri as categorykanriJouhou2
   on substring(syouhin2.jouhou2,1,2) = categorykanriJouhou2.category1
    and substring(syouhin2.jouhou2,3,8) = categorykanriJouhou2.category2

   left join categorykanri as categorykanriColor
   on substring(syouhin1.color,1,2) = categorykanriColor.category1
    and substring(syouhin1.color,3,9) = categorykanriColor.category2

   left join categorykanri as categorykanriBumon
    on substring(syouhin1.bumon,1,2) = categorykanriBumon.category1
    and substring(syouhin1.bumon,3,5) = categorykanriBumon.category2

    left join categorykanri as categorykanriYoyaku
    on substring(syouhin1.data20,1,2) = categorykanriYoyaku.category1
     and substring(syouhin1.data20,3,8) = categorykanriYoyaku.category2

    left join categorykanri as categorykanriData26
    on substring(syouhin1.data26,1,2) = categorykanriData26.category1
      and substring(syouhin1.data26,3,4) = categorykanriData26.category2

    left join categorykanri as categorykanriData29
    on substring(syouhin1.data29,1,2) = categorykanriData29.category1
      and substring(syouhin1.data29,3,5) = categorykanriData29.category2

    left join categorykanri as categorykanriData101
    on substring(syouhin1.data101,1,2) = categorykanriData101.category1
      and substring(syouhin1.data101,3,4) = categorykanriData101.category2

    left join categorykanri as categorykanriUrl
    on substring(syouhin1.url,1,2) = categorykanriUrl.category1
      and substring(syouhin1.url,3,5) = categorykanriUrl.category2

    left join categorykanri as categorykanriData52
   on substring(syouhin1.data52,1,2) = categorykanriData52.category1
    and substring(syouhin1.data52,3,4) = categorykanriData52.category2

    left join categorykanri as categorykanriData53
   on substring(syouhin1.data53,1,2) = categorykanriData53.category1
    and substring(syouhin1.data53,3,4) = categorykanriData53.category2

   left join categorykanri as categorykanriData54
   on substring(syouhin1.data54,1,2) = categorykanriData54.category1
    and substring(syouhin1.data54,3,4) = categorykanriData54.category2

   left join categorykanri as categorykanriData100
   on substring(syouhin1.data100,1,2) = categorykanriData100.category1
    and substring(syouhin1.data100,3,4) = categorykanriData100.category2

   left join categorykanri as categorykanriData28
   on substring(syouhin1.data28,1,2) = categorykanriData28.category1
    and substring(syouhin1.data28,3,4) = categorykanriData28.category2

    left join categorykanri as categorykanriDspbango
    on substring(syouhin4.dspbango,1,2) = categorykanriDspbango.category1
     and substring(syouhin4.dspbango,3,4) = categorykanriDspbango.category2

    left join categorykanri as categorykanriS4Color
    on substring(syouhin4.color,1,2) = categorykanriS4Color.category1
     and substring(syouhin4.color,3,4) = categorykanriS4Color.category2

    left join categorykanri as categorykanriS4Size
    on substring(syouhin4.size,1,2) = categorykanriS4Size.category1
     and substring(syouhin4.size,3,4) = categorykanriS4Size.category2

    left join categorykanri as categorykanriSyouhingroup
    on substring(syouhin4.syouhingroup,1,2) = categorykanriSyouhingroup.category1
     and substring(syouhin4.syouhingroup,3,4) = categorykanriSyouhingroup.category2

    left join categorykanri as categorykanriRuijihinbango
    on substring(syouhin4.ruijihinbango,1,2) = categorykanriRuijihinbango.category1
     and substring(syouhin4.ruijihinbango,3,4) = categorykanriRuijihinbango.category2

    left join categorykanri as categorykanriChardata1
    on substring(syouhin4.chardata1,1,2) = categorykanriChardata1.category1
     and substring(syouhin4.chardata1,3,4) = categorykanriChardata1.category2

    left join categorykanri as categorykanriChardata2
    on substring(syouhin4.chardata2,1,2) = categorykanriChardata2.category1
     and substring(syouhin4.chardata2,3,4) = categorykanriChardata2.category2

    left join tantousya on tantousya.bango = syouhin2.catalogbango
    
    left join syouhin1 as s1 on syouhin1.url_mobile = s1.kokyakusyouhinbango
    
    where kakaku.syutenjyouken is null

    ORDER BY syouhin1.bango ");

    //dd(DB::table('product_temp')->get());


    $data=DB::table('product_temp');

    if ($deleted_item==1) {
        $data=DB::table('product_temp')->whereRaw('isuriage = ' . 1);
    }elseif($deleted_item==0){
        $data=DB::table('product_temp')->whereRaw('isuriage = ' . 0);
    }else if ($deleted_item === '*') {
        $data = DB::table('product_temp');
    }else{
        $data=DB::table('product_temp');
    }

    return $data;
  }
}
