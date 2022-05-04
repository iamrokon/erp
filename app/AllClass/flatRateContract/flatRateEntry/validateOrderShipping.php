<?php

namespace App\AllClass\flatRateContract\flatRateEntry;

use DB;
use Illuminate\Support\Facades\Validator;
use App\AllClass\specialCharValidation;
use App\AllClass\flatRateContract\flatRateEntry\specialCharValidation2;
use App\AllClass\Mobile;
use App\AllClass\zenkaku;
use App\AllClass\AlphanumericKatakanaSymbolValidation;
use Illuminate\Support\Facades\Input;

Class validateOrderShipping{
  public static function validate($request,$bango)
  { 
    $rules=[];
    $data52 = $request['syouhin1_data52'];
    
    //$rules['datachar03'] = ['nullable','max:13','regex:/^[a-zA-Z0-9]+$/'];
    $rules['datachar03'] = ['nullable','max:13',new specialCharValidation2,new AlphanumericKatakanaSymbolValidation];
    $rules['datachar04'] = ['nullable','max:40',new zenkaku];
    if($data52 == 'C720' || $data52 == 'C730'){
       $rules['supplier'] = ['required']; 
    }
    $rules['dataint09'] = ['required'];
    $rules['dataint10'] = ['required'];
    $rules['datachar06'] = ['required'];
    $rules['datachar07'] = ['nullable','max:60',new zenkaku];

    $message=[];    
    $message['required']='【:attribute】正しく入力されていません。';
    $message['dataint09.required']='【:attribute】正しく入力されていません。';
    $message['dataint10.required']='【:attribute】正しく入力されていません。';
    $message['max']='【:attribute】:max桁以下で入力してください。';
    $message['min']='【:attribute】の入力は:min文字以上必要です。';
    $message['regex']='【:attribute】半角数字以外は使用できません。';
    $message['numeric']='【:attribute】入力形式が間違っています。';
    $message['email']='【:attribute】の入力形式が間違っています。';
    $message['date']='【:attribute】入力形式が間違っています。';
    $message['date_format']='【:attribute】yyyy/mm/ddの形式で入力してください。';
    $message['before']='【:attribute】終売日より未来の日付は設定できません。';
    $message['after']='【:attribute】開始年月より過去の年月は設定できません。';
    

    $attributes = [
        'datachar03' => 'メーカー品番',
        'datachar04' => 'メーカー品名',
        'supplier' => '仕入先',
        'dataint09' => '発注日',
        'dataint10' => '個別納期',
        'datachar06' => '納品先',
        'datachar07' => '発注出荷指示備考',
    ];
    
    $validator = Validator::make($request,$rules,$message,$attributes);    

    return $validator;
  }   
  
} 
