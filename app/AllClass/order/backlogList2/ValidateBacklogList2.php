<?php

namespace App\AllClass\order\backlogList2;

use DB;
use Illuminate\Support\Facades\Validator;
use App\AllClass\specialCharValidation;
use App\AllClass\zenkaku;
use Illuminate\Support\Facades\Input;

Class ValidateBacklogList2{
  public static function validate($request,$bango)
  { 
    $request = $request->all();
    $rules=[];
     
    $rules['division_datachar05_start'] = ['required']; 
    $rules['division_datachar05_end'] = ['required']; 
    
    if(str_replace('/', '', request('sales_date_start')) > str_replace('/', '', request('sales_date_end'))){
       $request['sales_date'] = request('sales_date_start');
       $rules['sales_date'] = ['before:sales_date_end'];
    }else{
        $rules['sales_date_start'] = ['required','max:10','regex:/^[0-9\/]+$/','date_format:Y/m'];
        $rules['sales_date_end'] = ['required','max:10','regex:/^[0-9\/]+$/','date_format:Y/m'];
    }
    
    
    $message=[];    
    $message['required']='【:attribute】必須項目に入力がありません。';
    $message['max']='【:attribute】:max桁以下で入力してください。';
    $message['min']='【:attribute】の入力は:min文字以上必要です。';
    $message['regex']='【:attribute】半角数字以外は使用できません。';
    $message['date']='【:attribute】入力形式が間違っています。';
    $message['date_format']='【:attribute】yyyy/mm/ddの形式で入力してください。';
    $message['before']='【:attribute】終売日より未来の日付は設定できません。';
    $message['after']='【:attribute】上市開始日より過去の日付は設定できません。';
    $message['sales_date.before']='【:attribute】正しい年月日を入力してください。';
    

    $attributes = [
        'sales_date_start' => '売上年月1',
        'sales_date_end' => '売上年月2',
        'sales_date' => '売上年月',
    ];
    
    $validator = Validator::make($request,$rules,$message,$attributes);    

    return $validator;
  }   
} 
