<?php

namespace App\AllClass\master\creditMaster;

use DB;
use Auth;
use App\syouhin1;
use Illuminate\Support\Facades\Validator;


Class CreditJoinQuery{
  public static function getJoinQuery($name, $dateTimeFrom, $dateTimeTo)
  {
    $creditDatas = DB::table('kaiin')
        ->join('kokyaku1','kaiin.kokyakubango','=','kokyaku1.bango')
        ->select('kaiin.*','kokyaku1.name as kokyaku1Name','kokyaku1.denpyostart')
        ->whereIn('kokyaku1.name', $name)
        ->where('kaiin.mail','>=', $dateTimeFrom)
        ->where('kaiin.mail','<=', $dateTimeTo);
    return $creditDatas;

  }
}
