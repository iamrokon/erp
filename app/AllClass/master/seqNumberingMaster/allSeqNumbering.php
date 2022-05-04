<?php

namespace App\AllClass\master\seqNumberingMaster;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\kengen;
use App\Review;
use App\AllClass\db\QueryHelperFacade as QueryHelper;


Class allSeqNumbering{ 
  public static function data($bango,$deleted_item=2)
  {

      QueryHelper::runQuery("DROP TABLE IF EXISTS review_temp");
    /*$users=DB::select(DB::raw(
                 "select *,CONCAT(id1,' ',company_name1) as company_1,CONCAT(id2,' ',company_name2) as company_2,CONCAT(id3,' ',company_name3) as company_3 from tantousya 
left join ( select CONCAT(category1,category2) as id1 , category4 as company_name1 from categorykanri )  categorykanri_1 on tantousya.datatxt0003=categorykanri_1.id1 
left join ( select CONCAT(category1,category2) as id2 , category4 as company_name2 from categorykanri )  categorykanri_2 on tantousya.datatxt0004=categorykanri_2.id2
left join ( select CONCAT(category1,category2) as id3 , category4 as company_name3 from categorykanri )  categorykanri_3 on tantousya.datatxt0005=categorykanri_3.id3
    where deleteflag=null or deleteflag=0"));*/
      QueryHelper::runQuery(
"CREATE TEMPORARY TABLE review_temp as
select distinct
review.bango,
review.kokyakusyouhinbango,
CASE
    WHEN trim(review.kokyakusyouhinbango || ' ' || categorykanriKokyakusyouhinbango.category4) = '' THEN NULL
    ELSE trim(review.kokyakusyouhinbango || ' ' || categorykanriKokyakusyouhinbango.category4) END as kokyakusyouhinbango_detail,
review.orderbango,
review.mobile_flag,
review.jouhou,
review.color,
review.size,
review.nickname,
review.check_flag,
tantousya.name as user_name,

CASE
    WHEN review.jouhou is null THEN NULL 
    ELSE concat_ws('/',substring(review.jouhou,1,4),
    substring(review.jouhou,5,2),
    substring(review.jouhou,7,2)) END as created_date ,

CASE
    WHEN review.jouhou is null THEN NULL 
    ELSE concat_ws(':',substring(review.jouhou,9,2),
    substring(review.jouhou,11,2),
    substring(review.jouhou,13,2)) END as created_time,

CASE
    WHEN review.color is null THEN NULL 
    ELSE concat_ws('/',substring(review.color,1,4),
    substring(review.color,5,2),
    substring(review.color,7,2)) END as edited_date,

CASE
    WHEN review.color is null THEN NULL 
    ELSE concat_ws(':',substring(review.color,9,2),
    substring(review.color,11,2),
    substring(review.color,13,2)) END as edited_time

from review

    left join tantousya on tantousya.bango = review.nickname   
    
    left join categorykanri as categorykanriKokyakusyouhinbango
    on substring(review.kokyakusyouhinbango,1,2) = categorykanriKokyakusyouhinbango.category1
    and substring(review.kokyakusyouhinbango,3,5) = categorykanriKokyakusyouhinbango.category2
    
    ORDER BY review.bango");

    //dd(DB::table('review_temp')->get());
   
                
    $data=DB::table('review_temp');   
    
    if ($deleted_item==1) 
    {
       $data=DB::table('review_temp')->whereRaw('check_flag =1');
    }
    elseif($deleted_item==0)
    {
       $data=DB::table('review_temp')->whereRaw('check_flag =0');
    }
    else
    {
        $data=DB::table('review_temp');
    }  
    
    return $data;
  }   
} 
