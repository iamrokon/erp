<?php

namespace App\AllClass\order\backOrder;

use DB;
use Illuminate\Support\Facades\Validator;
use App\AllClass\specialCharValidation;
use App\AllClass\zenkaku;
use Illuminate\Support\Facades\Input;
use App\AllClass\order\orderHistory2\CheckOrderbangoRange;
use Carbon\Carbon;

Class validateBackOrderUpdate{
  public static function validate($request,$check,$bango)
  {

    $updateArr=[];
    $rules=[];
  // dd($check);
    foreach ($request as $key => $value) {
       $updateArr[explode('_', $key)[1]][explode('_', $key)[0]]=$value;
    }

    $variable=[];
    foreach ($updateArr as $key => $value)  {

        $date_05 = Carbon::parse(date($value['intorder03']))->addMonth(5)->subDays(1)->format('Y/m/d');

        //dd(Carbon::parse($today)->addMonth(5)->format('Y/m/d'));
        //$rules['intorder01_'.$key] = ['required','date'];
        if (array_key_exists('intorder04_'.explode('%', $key)[1], $check) || array_key_exists('intorder03_'.explode('%', $key)[1], $check) || array_key_exists('intorder05_'.explode('%', $key)[1], $check)) {
            $rules['intorder04_'.$key] = ['required','date','after_or_equal:'.'intorder01_'.$key,'before_or_equal:'.'intorder03_'.$key];

        //if (array_key_exists('intorder03_'.explode('%', $key)[1], $check)) {
            $rules['intorder03_'.$key] = ['required','date','after_or_equal:'.'intorder04_'.$key];
        //}
        //if (array_key_exists('intorder05_'.explode('%', $key)[1], $check)) {
            $rules['intorder05_'.$key] = ['required','date','after_or_equal:'.$value['intorder03'],'before_or_equal:'.$date_05];
        //}

        }




        $variable['intorder01_'.$key]=$value['intorder01'];
        $variable['intorder04_'.$key]=$value['intorder04'];
        $variable['intorder03_'.$key]=$value['intorder03'];
        $variable['intorder05_'.$key]=$value['intorder05'];
    }

    $attributes=[];

    foreach ($rules as $key => $value) {
//    	dd(str_contains($key,'intorder03'));
        if (str_contains($key,'intorder01') ) {
            $attributes[$key]='【受注日】';
        }
        if (str_contains($key,'intorder03') ) {
            $attributes[$key]='【売上日】';
        }
        if (str_contains($key,'intorder04') ) {
            $attributes[$key]='【検収日】';
        }
        if (str_contains($key,'intorder05') ) {
            $attributes[$key]='【入金日】';
        }

    }


    $message=[];
    $message['required']=':attribute必須項目が入力されていません。';
    $message['date']=':attribute必須項目が入力されていません。';
    $message['after_or_equal']=':attribute日付の入力が適切ではありません。';
    $message['before_or_equal']=':attribute日付の入力が適切ではありません。';

    $validator = Validator::make($variable,$rules,$message,$attributes);
//dd($validator->errors());
    return [$validator,$variable];

  }
}
