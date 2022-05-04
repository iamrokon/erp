<?php

namespace App\AllClass\master\productSubMaster;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\others;
use App\kengen;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

class allOthers
{
    public static function data($bango, $deleted_item = 2)
    {
        QueryHelper::runQuery("DROP TABLE IF EXISTS categorykanriE4_temp");
        QueryHelper::runQuery("DROP TABLE IF EXISTS categorykanriE5_temp");
        QueryHelper::runQuery("DROP TABLE IF EXISTS categorykanriE8_temp");
        QueryHelper::runQuery("DROP TABLE IF EXISTS categorykanriother6");
        QueryHelper::runQuery("DROP TABLE IF EXISTS categorykanriother7");
        QueryHelper::runQuery("DROP TABLE IF EXISTS categorykanriother8");
        QueryHelper::runQuery("DROP TABLE IF EXISTS others_temp");


        QueryHelper::runQuery(
            "CREATE TEMPORARY TABLE categorykanriE4_temp AS
          select distinct
          category1,
          category2,
          category4

      FROM categorykanri
      WHERE category1 = 'E4'
      "
        );
        QueryHelper::runQuery(
            "CREATE TEMPORARY TABLE categorykanriE5_temp AS
          select distinct
          category1,
          category2,
          category4

      FROM categorykanri
      WHERE category1 = 'E5'
      "
        );
        QueryHelper::runQuery(
            "CREATE TEMPORARY TABLE categorykanriE8_temp AS
          select distinct
          category1,
          category2,
          category4

      FROM categorykanri
      WHERE category1 = 'E8'
      "
        );

        QueryHelper::runQuery(
            "CREATE TEMPORARY TABLE categorykanriother6 AS
          select distinct
          categorykanri.category1 || categorykanri.category2 as catother,
          category4

      FROM categorykanri
      	"
        );

        QueryHelper::runQuery(
            "CREATE TEMPORARY TABLE categorykanriother7 AS
          select distinct
          categorykanri.category1 || categorykanri.category2 as catother1,
          category4
      FROM categorykanri
      "
        );

        QueryHelper::runQuery(
            "CREATE TEMPORARY TABLE categorykanriother8 AS
          select distinct
          categorykanri.category1 || categorykanri.category2 as catother2,
          category4

      FROM categorykanri
      "
        );

        try {
            QueryHelper::runQuery(
                "CREATE TEMPORARY TABLE others_temp as
select distinct
-- CASE
--     WHEN trim(concat(other26,'%%',other27)) = '%%' then null
--     ELSE concat(other26,'%%',other27) END as primarykey
others.other25 as primarykey,
others.other1 as other1,
--CASE
   -- WHEN others.other1 is null OR others.other1 = '' then null
   -- ELSE concat_ws(' ',others.other1, (select distinct  request.jouhou from request  where cast(others.other1 as int) = request.syouhinbango AND request.color= '0814サブ区分' limit 1) )
   -- END as other1_detail,
others.other2 as other2_original,
CASE
    WHEN others.other2 is null OR others.other2 = '' then null
    ELSE concat(others.other2,' ',categorykanriE4_temp.category4,'/',categorykanriE5_temp.category4,'/',categorykanriE8_temp.category4)
    END as other2,
others.other3 as other3,
CASE
    WHEN others.other3 is null OR others.other3 = '' then null
    ELSE concat_ws(' ',substring(others.other3,3,5), categorykanriE4_temp.category4) END as other3_detail,

others.other4 as other4,
CASE
    WHEN others.other4 is null OR others.other4 = '' then null
    ELSE concat_ws(' ',substring(others.other4,3,8), categorykanriE5_temp.category4) END as other4_detail,
others.other5 as other5,
CASE
    WHEN others.other6 is null OR others.other6 = '' then null
    ELSE concat_ws(' ',others.other6, categorykanriother6.category4) END as other6,
CASE
    WHEN others.other7 is null OR others.other7 = '' then null
    ELSE concat_ws(' ',others.other7, categorykanriother7.category4) END as other7,
CASE
    WHEN others.other8 is null OR others.other8 = '' then null
    ELSE concat_ws(' ',others.other8, categorykanriother8.category4) END as other8,
others.other6 as other6_original,
others.other7 as other7_original,
others.other8 as other8_original,
CASE
    WHEN others.other9 is null OR others.other9 = '' then null
    ELSE concat_ws(' ', REPLACE(others.other9,'B9',''),categorykanri1.category4) END as other9,
CASE
    WHEN others.other10 is null OR others.other10 = '' then null
    ELSE concat_ws(' ', REPLACE(others.other10,'C1',''),categorykanri2.category4) END as other10,
CASE
    WHEN others.other11 is null OR others.other11 = '' then null
    ELSE concat_ws(' ', REPLACE(others.other11,'C2',''), categorykanri3.category4) END as other11,

others.other9 as other9_original,
others.other10 as other10_original,
others.other11 as other11_original,
others.other12 as other12,
CASE
    WHEN others.other12 is null OR others.other12 = '' then null
    ELSE concat_ws(' ',others.other12, tantousya2.name) END as other12_detail,

others.other13 as other13_original,
others.other14 as other14_original,
others.other17 as other17_original,

--CASE
--    WHEN others.other13 is null OR others.other13 = '' then null
--    ELSE concat_ws(' ',others.other13, (select distinct  request.jouhou from request  where cast(others.other13 as int) = request.syouhinbango AND request.color= '0814データ区分' limit 1) ) END as other13,
--CASE
--    WHEN others.other14 is null OR others.other14 = '' then null
--    ELSE concat_ws(' ',others.other14, (select distinct  request.jouhou from request  where cast(others.other14 as int) = request.syouhinbango AND request.color= '0814作成ステータス' limit 1) ) END as other14,
others.other15 as other15,
others.other16 as other16,
--CASE
--    WHEN others.other17 is null OR others.other17 = '' then null
--    ELSE concat_ws(' ',others.other17, (select distinct  request.jouhou from request  where cast(others.other17 as int) = request.syouhinbango AND request.color= '0814入力区分' limit 1) ) END as other17,
others.other18 as other18,
others.other19 as other19,
CAST(others.other20 AS INTEGER) as other20,
others.other21 as other21,
others.other22 as other22,
others.other23 as other23,
others.other24 as other24,
others.other25 as other25,

CASE
    WHEN others.other25 is null OR others.other25 = '' then null
    ELSE concat_ws(' ',substring(others.other25,3,10), categorykanriE8_temp.category4) END as other25_detail,
CASE
    WHEN others.other26 is null OR others.other26 = '' then null
    ELSE others.other26 END as other26,
CASE
    WHEN others.other27 is null OR others.other27 = '' then null
    ELSE others.other27 END as other27,
others.other28 as other28,
others.other29 as other29_original,
others.other30 as other30,

tantousya1.name as other29,
CASE
    WHEN others.other26 is null THEN NULL
    ELSE concat_ws('/',substring(others.other26,1,4),
    substring(others.other26,5,2),
    substring(others.other26,7,2)) END as created_date ,

CASE
    WHEN others.other26 is null THEN NULL
    ELSE concat_ws(':',substring(others.other26,9,2),
    substring(others.other26,11,2),
    substring(others.other26,13,2)) END as created_time,

CASE
    WHEN others.other27 is null THEN NULL
    ELSE concat_ws('/',substring(others.other27,1,4),
    substring(others.other27,5,2),
    substring(others.other27,7,2)) END as edited_date,

CASE
    WHEN others.other27 is null THEN NULL
    ELSE concat_ws(':',substring(others.other27,9,2),
    substring(others.other27,11,2),
    substring(others.other27,13,2)) END as edited_time,

CASE
    WHEN others.other15 is null OR others.other15 = '' THEN NULL
    ELSE concat_ws('/',substring(others.other15,1,4),substring(others.other15,5,2),
    substring(others.other15,7,2)) END as other15_modified ,

CASE
    WHEN others.other16 is null OR others.other16 = '' THEN NULL
    ELSE concat_ws('/',substring(others.other16,1,4),substring(others.other16,5,2),
    substring(others.other16,7,2)) END as other16_modified

from others

left join categorykanri as categorykanri1
  on concat(categorykanri1.category1,categorykanri1.category2) = others.other9
left join categorykanri as categorykanri2
  on concat(categorykanri2.category1,categorykanri2.category2) = others.other10
left join categorykanri as categorykanri3
  on concat(categorykanri3.category1,categorykanri3.category2) = others.other11
left join categorykanriother6
  on catother = others.other6
left join categorykanriother7
  on catother1 = others.other7
left join categorykanriother8
  on catother2 = others.other8

left join request as request1
  on cast(request1.syouhinbango as varchar) = others.other25 and request1.color = '0814バージョン区分'
left join tantousya as tantousya2
  on others.other12 = tantousya2.bango
left join tantousya as tantousya1
  on others.other29 = tantousya1.bango

left join categorykanriE4_temp
  on categorykanriE4_temp.category1 = 'E4'
  and categorykanriE4_temp.category2 = substring(others.other3,3,5)
left join categorykanriE5_temp
  on categorykanriE5_temp.category1 = 'E5'
  and categorykanriE5_temp.category2 = substring(others.other4,3,8)
left join categorykanriE8_temp
  on categorykanriE8_temp.category1 = 'E8'
  and categorykanriE8_temp.category2 = substring(others.other25,3,10)

ORDER BY other1 ASC
/*left join request
   on cast(others.other1 as int) = request.syouhinbango*/

   "
            );
        } catch (\Exception $ex) {
            dd($ex);
        }

        //dd($data=DB::table('others_temp')->get());
        if ($deleted_item == 1) {
            $data = DB::table('others_temp')->whereRaw("other19 = '1'");
        } elseif ($deleted_item == 0) {
            $data = DB::table('others_temp')->whereRaw("other19 ='0'");
        } else {
            $data = DB::table('others_temp');
        }

        return $data;
    }
}
