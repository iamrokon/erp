<?php

namespace App\AllClass\master\creditMaster;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\kengen;
use App\syouhin1;
use App\Kakaku;


Class allCredit{
  public static function data($bango, $name, $fromDate, $toDate, $deleted_item=2)
  {
      $nameStr = implode("', '", $name);
        $kaiinInfos = DB::select(DB::raw(
            "CREATE TEMPORARY TABLE credit_temp as
select distinct
kaiin.bango,
kaiin.point,
Kokyaku1.name as kokyaku1_name,
kaiin.kounyusu ,
kokyaku1.denpyostart,
kaiin.syukei1,
kaiin.syukei2,
kaiin.syukei3,
kaiin.syukei4,
kaiin.syukei5,
kaiin.name,
kaiin.kaka,
kaiin.mailflagu,

CASE
    WHEN kaiin.mail is null THEN NULL
    ELSE concat(substring(kaiin.mail,1,4),'/',
    substring(kaiin.mail,5,2),'/',
    substring(kaiin.mail,7,2)) END as mail11 ,

CASE
    WHEN kaiin.mail is null THEN NULL
    ELSE concat(substring(kaiin.mail,9,2),':',
    substring(kaiin.mail,11,2),':',
    substring(kaiin.mail,13,2)) END as mail12,

CASE
    WHEN kaiin.mail2 is null THEN NULL
    ELSE concat(substring(kaiin.mail2,1,4),'/',
    substring(kaiin.mail2,5,2),'/',
    substring(kaiin.mail2,7,2)) END as mail21,

CASE
    WHEN kaiin.mail2 is null THEN NULL
    ELSE concat(substring(kaiin.mail2,9,2),':',
    substring(kaiin.mail2,11,2),':',
    substring(kaiin.mail2,13,2)) END as mail22

from kaiin

    join kokyaku1 on kokyaku1.bango = kaiin.kokyakubango
    where kokyaku1.bango = kaiin.kokyakubango
    AND kokyaku1.name IN ('".$nameStr."')
    AND kaiin.mail >= ('".$fromDate."')
    AND kaiin.mail2 < ('".$toDate."')
      "));

      if ($deleted_item==1)
      {
          $data=DB::table('credit_temp')->where('mailflagu',1);
      }
      elseif($deleted_item==0)
      {
          $data=DB::table('credit_temp')->where('mailflagu',0);
      }
      else
      {
          $data=DB::table('credit_temp');
      }

    return $data;
  }
}
