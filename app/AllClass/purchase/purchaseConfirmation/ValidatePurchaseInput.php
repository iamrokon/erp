<?php

namespace App\AllClass\purchase\purchaseConfirmation;

use DB;
use Illuminate\Support\Facades\Validator;
use App\AllClass\specialCharValidation;
use App\AllClass\zenkaku;
use Illuminate\Support\Facades\Input;

Class ValidatePurchaseInput{
  public static function validate($request,$bango)
  { 
    $request = $request->all();
    $rules=[];
     
    if(str_replace('/', '', request('touchakudate_start')) > str_replace('/', '', request('touchakudate_end'))){
       $request['touchakudate'] = request('touchakudate_start');
       $rules['touchakudate'] = ['before:touchakudate_end'];
    }else{
        $rules['touchakudate_start'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
        $rules['touchakudate_end'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
    }
    
    $message=[];    
    $message['required']='【:attribute】必須項目に入力がありません。';
    $message['max']='【:attribute】:max桁以下で入力してください。';
    $message['min']='【:attribute】の入力は:min文字以上必要です。';
    $message['regex']='【:attribute】半角数字以外は使用できません。';
    $message['date']='【:attribute】入力形式が間違っています。';
    $message['date_format']='【:attribute】yyyy/mm/ddの形式で入力してください。';
    $message['before']='【:attribute】正しい年月日を入力してください。';
    $message['after']='【:attribute】上市開始日より過去の日付は設定できません。';
    $message['touchakudate.before']='【:attribute】正しい年月日を入力してください。';
    
    $attributes = [
        'touchakudate' => '仕入日',
        'touchakudate_start' => '仕入日1',
        'touchakudate_end' => '仕入日2',
    ];
    

    $validator = Validator::make($request,$rules,$message,$attributes);    

    return $validator;
  }   
} 
