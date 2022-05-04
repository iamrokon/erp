<?php

namespace App\AllClass\other\specifyOrderEntry;

use DB;
use Illuminate\Support\Facades\Validator;
use App\AllClass\specialCharValidation;
use Illuminate\Support\Facades\Input;

Class validateSpecifyOrderEntry{
  public static function validate($request,$bango)
  { 
    $request = $request->all();
    $bango1 = $request['bango1'];
    $bango2 = $request['bango2'];
    $bango3 = $request['bango3'];
    $rules=[];
     
    $rules['bango1'] = ['nullable','max:4','exists:tantousya,bango']; 
    $rules['bango2'] = ['nullable','max:4','exists:tantousya,bango']; 
    $rules['bango3'] = ['nullable','max:4','exists:tantousya,bango']; 
    
    $message=[];    
    $message['max']='【:attribute】:max文字以内で指定してください。';
    $message['bango1.exists']="【:attribute】社員マスタの".$bango1."の値が存在しないため、処理できませんでした。";
    $message['bango2.exists']="【:attribute】社員マスタの".$bango2."の値が存在しないため、処理できませんでした。";
    $message['bango3.exists']="【:attribute】社員マスタの".$bango3."の値が存在しないため、処理できませんでした。";
    
    $attributes = [
        'bango1' => '除外社員1',
        'bango2' => '除外社員2',
        'bango3' => '除外社員3',
    ];

    $validator = Validator::make($request,$rules,$message,$attributes);    
    return $validator;
  }   
} 
