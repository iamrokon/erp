<?php

namespace App\AllClass\flatRateContract\flatRateEntry;

use DB;
use Illuminate\Support\Facades\Validator;
use App\AllClass\specialCharValidation;
use App\AllClass\Mobile;
use App\AllClass\zenkaku;
use Illuminate\Support\Facades\Input;

Class validateMaintenance{
  public static function validate($request,$bango)
  { 
    $rules=[];
 
    $rules['datatxt0124'] = ['required'];
    $rules['numericmax'] = ['required','max:3','regex:/^[0-9]+$/'];
    $rules['datatxt0123'] = ['nullable'];
    $rules['datatxt0120'] = ['nullable','max:20','regex:/^[a-zA-Z0-9 ]+$/'];
    
    $message=[];    
    $message['required']='【:attribute】該当するデータがありません。';
    $message['numericmax.required']='【:attribute】正しく入力されていません。';
    $message['datatxt0123.required']='【:attribute】正しく入力されていません。';
    $message['max']='【:attribute】:max桁以下で入力してください。';
    $message['min']='【:attribute】の入力は:min文字以上必要です。';
    $message['regex']='【:attribute】半角数字以外は使用できません。';
    $message['datatxt0120.regex']='【:attribute】半角英数字以外は使用できません。';
    $message['numeric']='【:attribute】入力形式が間違っています。';
    $message['email']='【:attribute】の入力形式が間違っています。';
    $message['date']='【:attribute】入力形式が間違っています。';
    $message['date_format']='【:attribute】yyyy/mm/ddの形式で入力してください。';
    $message['before']='【:attribute】終売日より未来の日付は設定できません。';
    $message['after']='【:attribute】開始年月より過去の年月は設定できません。';
    

    $attributes = [
        'datatxt0124' => '保守窓口',
        'numericmax' => '窓口数',
        'datatxt0123' => '保守会社',
        'datatxt0120' => '保証書番号',
    ];
    
    $validator = Validator::make($request,$rules,$message,$attributes);    

    return $validator;
  }   
  
} 
