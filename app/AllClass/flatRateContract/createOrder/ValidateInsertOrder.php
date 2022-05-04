<?php

namespace App\AllClass\flatRateContract\createOrder;

use DB;
use Illuminate\Support\Facades\Validator;
use App\AllClass\specialCharValidation;
use App\AllClass\Mobile;
use App\AllClass\zenkaku;
use Illuminate\Support\Facades\Input;

Class ValidateInsertOrder{
  public static function validate($request,$bango)
  { 
    $rules=[];
    
    $rules['kanryoubi_start'] = ['required'];
    $rules['kanryoubi_end'] = ['required'];
    $request['kanryoubi'] = request('kanryoubi_start');
    if(str_replace('/', '', request('kanryoubi_start')) > str_replace('/', '', request('kanryoubi_end'))){
       $rules['kanryoubi'] = ['before:kanryoubi_end'];
    }
    $rules['information2_start'] = ['nullable'];
    $rules['information2_end'] = ['nullable'];

    $message=[];    
    $message['required']='【:attribute】必須項目に入力がありません。';
    $message['max']='【:attribute】:max桁以下で入力してください。';
    $message['min']='【:attribute】の入力は:min文字以上必要です。';
    $message['regex']='【:attribute】半角数字以外は使用できません。';
    $message['numeric']='【:attribute】入力形式が間違っています。';
    $message['email']='【:attribute】の入力形式が間違っています。';
    $message['date']='【:attribute】入力形式が間違っています。';
    $message['date_format']='【:attribute】yyyy/mm/ddの形式で入力してください。';
    $message['before']='【:attribute】正しい年月日を入力してください。';
    $message['after']='【:attribute】開始年月より過去の年月は設定できません。';
    

    $attributes = [
        'kanryoubi' => '売上日',
        'kanryoubi_start' => '売上日1',
        'kanryoubi_end' => '売上日2',
        'information2_start' => '売上請求先1',
        'information2_end' => '売上請求先2',
    ];
    

    $validator = Validator::make($request,$rules,$message,$attributes);    

    return $validator;
  }   
} 
