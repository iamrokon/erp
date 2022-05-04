<?php

namespace App\AllClass\master\nameMaster;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\categorykanri;
use App\kengen;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class allCategorykanri{
  public static function data($bango,$deleted_item=2)
  {

      QueryHelper::runQuery("DROP TABLE IF EXISTS categorykanri_temp");

QueryHelper::runQuery(
"CREATE TEMPORARY TABLE categorykanri_temp as
select distinct
categorykanri.category1,
categorykanri.category2,
categorykanri.category3 ,
categorykanri.category4,
categorykanri.image3 as changed,
categorykanri.patternsub1 as spare_one,
categorykanri.patternsub2 as spare_two,
categorykanri.text as spare_three,

CASE
    WHEN categorykanri.category5 = '' THEN NULL
 ELSE categorykanri.category5 END,
CASE
    WHEN categorykanri.groupbango = '' THEN NULL
ELSE categorykanri.groupbango END,
CAST(categorykanri.osusume AS float),
CAST(categorykanri.suchi1 AS float),
categorykanri.suchi2,
categorykanri.image1,
categorykanri.image2,
categorykanri.image3,
categorykanri.zokusei,
categorykanri.bango,
CASE
    WHEN categorykanri.image1 is null THEN NULL
    ELSE concat_ws('/',substring(categorykanri.image1,1,4),
    substring(categorykanri.image1,5,2),
    substring(categorykanri.image1,7,2)) END as created_date ,

CASE
    WHEN categorykanri.image1 is null THEN NULL
    ELSE concat_ws(':',substring(categorykanri.image1,9,2),
    substring(categorykanri.image1,11,2),
    substring(categorykanri.image1,13,2)) END as created_time,

CASE
    WHEN categorykanri.image2 is null THEN NULL
    ELSE concat_ws('/',substring(categorykanri.image2,1,4),
    substring(categorykanri.image2,5,2),
    substring(categorykanri.image2,7,2)) END as edited_date,

CASE
    WHEN categorykanri.image2 is null THEN NULL
    ELSE concat_ws(':',substring(categorykanri.image2,9,2),
    substring(categorykanri.image2,11,2),
    substring(categorykanri.image2,13,2)) END as edited_time,
tantousya.name as user_name

from categorykanri
left join tantousya on tantousya.bango = CAST(categorykanri.zokusei as varchar(100))

ORDER BY bango ASC
");

   if ($deleted_item==1)
    {
       $data=DB::table('categorykanri_temp')->whereRaw("suchi2 = '1'");
    }
    elseif($deleted_item==0)
    {
       $data=DB::table('categorykanri_temp')->whereRaw("suchi2 = '0'");
    }
    else
    {
        $data=DB::table('categorykanri_temp');
    }


    return $data;
  }
}
