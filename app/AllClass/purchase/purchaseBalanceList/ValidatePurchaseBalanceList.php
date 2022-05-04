<?php

namespace App\AllClass\purchase\purchaseBalanceList;

use DB;
use Illuminate\Support\Facades\Validator;
use App\AllClass\specialCharValidation;
use App\AllClass\zenkaku;
use Illuminate\Support\Facades\Input;

Class ValidatePurchaseBalanceList{
  public static function validate($request,$bango)
  { 
    $request = $request->all();
    $rules=[];
     
    $rules['kk0001'] = ['required']; 
    
    $message=[];    
    $message['required']='【:attribute】必須項目に入力がありません。';
    $message['max']='【:attribute】:max桁以下で入力してください。';
    $message['min']='【:attribute】の入力は:min文字以上必要です。';
    

    $attributes = [
        'kk0001' => '年月',
    ];
    
    $validator = Validator::make($request,$rules,$message,$attributes);    
    return $validator;
  }   
} 
