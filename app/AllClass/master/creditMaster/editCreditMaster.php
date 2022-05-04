<?php

namespace App\AllClass\master\creditMaster;

use App\kaiin;
use DB;
use App\tantousya;
Use \Carbon\Carbon;
Use App\AllClass\master\creditMaster\validateCreditEditMaster;
use App\Helpers\Helper;

Class editCreditMaster{
  public static function edit($request,$bango)
  {
    $mytime = Carbon::now()->toDateTimeString();
//     $dateTime =  explode(" ",$mytime);
    $date = str_replace(["-", "–"], '', $mytime);
    $dateTime = str_replace(":", '', $date);
    $dateTime = str_replace(" ", '', $dateTime);
    foreach ($request as $key => $value)
    {
        if ($key=='_token'||$key=='type')
        {
          unset($request[$key]);
        }
    }
    $validator=validateCreditEditMaster::validate($request,$bango);

    $errors = $validator->errors();

        if($errors->any())
        {
            return $errors;
        }

        else
        {
            kaiin::where('bango', request('editCreditBango1'))->update([
               'kounyusu' =>request('editCreditKounyusu'),
               'syukei4' =>request('editCreditSyukei4'),
               'mail2' =>$dateTime,
               'mailflagu' =>0,
               'kaka' =>$bango,
              // 'name' => Helper::getSystemIP()
            ]);


            return 'ok';
        }
  }
}
