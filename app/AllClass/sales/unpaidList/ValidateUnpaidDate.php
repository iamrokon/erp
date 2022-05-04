<?php

namespace App\AllClass\sales\unpaidList;

use DB;
use Illuminate\Support\Facades\Validator;
use App\AllClass\specialCharValidation;
use App\AllClass\zenkaku;
use Illuminate\Support\Facades\Input;

Class ValidateUnpaidDate{
  public static function validate($request,$bango)
  { 
    $request = $request->all();
    $rules=[];
    $rules['temp_intorder05_input.*'] = ['required']; 
    
    $message=[];    
    $message['required']='【:attribute】必須項目に入力がありません。';
    $message['date']='【:attribute】入力形式が間違っています。';
    $message['date_format']='【:attribute】yyyy/mm/ddの形式で入力してください。';
    

    $attributes = [
        'temp_intorder05_input.*' => '入金予定日',
    ];
    

    $validator = Validator::make($request,$rules,$message,$attributes);    

    return $validator;
  }   
} 
