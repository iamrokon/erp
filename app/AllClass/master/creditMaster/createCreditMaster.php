<?php

namespace App\AllClass\master\creditMaster;


use DB;
use App\tantousya;
Use \Carbon\Carbon;
Use App\AllClass\master\creditMaster\validateCreditMaster;
use App\Helpers\Helper;

Class createCreditMaster{
  public static function create($request,$bango)
  {

    $mytime = Carbon::now()->toDateTimeString();

    foreach ($request as $key => $value)
    {
        if ($key=='_token'||$key=='type')
        {
          unset($request[$key]);
        }
    }

    $validator=validateEmployeeMaster::validate($request,$bango);

    $errors = $validator->errors();

        if($errors->any())
        {
            return $errors;
        }

        else
        {

            $p= $request['passwd'];
            $x= uniqid(rand());
            $x= substr($x,0,5);
            $passwd =  substr(($x.md5($x.$p)),0,32);


            $user= new tantousya;

            $user->ztanka =request('ztanka');
            $user->bango =request('bango');
            $user->name =request('name1')." ".request('name2');
            $user->htanka =request('htanka');
            $user->datatxt0003 =request('datatxt0003');
            $user->datatxt0004 =request('datatxt0004');
            $user->datatxt0005 =request('datatxt0005');
            $user->syozoku =request('syozoku');
            $user->passwd =$passwd;
            $user->mail4 =request('mail4');
            $user->mail2 =request('mail2');
            $user->mail3 =request('mail3');
            $user->mail =request('mail');
            $user->datatxt0030 =request('datatxt0030');
            $user->datatxt0031 =request('datatxt0031');
            $user->datatxt0032 =request('datatxt0032');
            $user->datatxt0033 =request('datatxt0033');
            $user->datatxt0034 =request('datatxt0034');
            $user->datatxt0035 =request('datatxt0035');
            $user->datatxt0036 =request('datatxt0036');
            $user->datatxt0037 =request('datatxt0037');
            $user->datatxt0029 =request('datatxt0029');
            $user->deleteflag =0;
            $user->datatxt0038 =$mytime;
           // $user->datatxt0039 =request('datatxt0029');
           // $user->syounin =$_SERVER['HTTP_X_FORWARDED_FOR'];
            $user->mail5 =$bango;

            $user->save();

            return 'ok';
        }
  }
}
