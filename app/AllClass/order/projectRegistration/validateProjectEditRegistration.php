<?php

namespace App\AllClass\order\projectRegistration;

use DB;
use App\AllClass\Mobile;
use App\AllClass\specialCharValidation;
use Illuminate\Support\Facades\Validator;
use App\AllClass\zenkaku;
use App\AllClass\master\productMaster\ValidateRange;
use Illuminate\Support\Facades\Input;

Class validateProjectEditRegistration{ 
  public static function validate($request,$bango)
  { 
    $rules=[];

    $rules['url'] = ['required','max:7','regex:/^[0-9]+$/'];
    
    if(Input::has('field')){
        $rules['urlsm'] = ['required','max:50',new zenkaku];
    }else{
        $rules['urlsm'] = ['required','max:50',new specialCharValidation,new zenkaku];
    }
   
    $rules['catchsm'] = ['required'];
    $rules['setumei'] = ['required'];
    
    $request['mbcatch'] = str_replace("/","",$request['mbcatch']);
    $request['mbcatchsm'] = str_replace("/","",$request['mbcatchsm']);
    
    if($request['mbcatch'] == $request['mbcatchsm']){
        $rules['mbcatch'] = ['nullable','max:7'];
    }else if($request['mbcatch'] == "" & $request['mbcatchsm'] != ""){
        $rules['mbcatch'] = ['required'];
    }else{
        $rules['mbcatch'] = ['nullable','max:7','before:mbcatchsm'];
    }
    
    //$rules['mbcatchsm'] = ['nullable','max:6','regex:/^[0-9]{4}[0]{1}[0-9]{1}|[0-9]{4}[1]{1}[0-2]{1}+$/','after:mbcatch'];
    if($request['mbcatch'] == $request['mbcatchsm']){
        $rules['mbcatchsm'] = ['nullable','max:7'];
    }else{
        $rules['mbcatchsm'] = ['nullable','max:7','after:mbcatch'];
    }
    
    if(Input::has('field')){
        $rules['mbcaption'] = ['nullable','max:50',new zenkaku];
    }else{
        $rules['mbcaption'] = ['nullable','max:50',new specialCharValidation,new zenkaku];
    }
    
    $message=[];    
    $message['required']='【:attribute】必須項目に入力がありません。';
    $message['unique']='【:attribute】の入力が重複しています。';
    $message['max']='【:attribute】:max桁以下で入力してください。';
    $message['min']='【:attribute】の入力は:min文字以上必要です。';
    $message['innerlevel.max']='【:attribute】の入力形式が間違っています。';
    $message['regex']='【:attribute】半角英数字以外は使用できません。';
    $message['numeric']='【:attribute】入力形式が間違っています。';
    $message['email']='【:attribute】の入力形式が間違っています。';
    $message['date']='【:attribute】入力形式が間違っています。';
    $message['mbcatch.regex']='【:attribute】入力形式が間違っています。';
    $message['mbcatchsm.regex']='【:attribute】入力形式が間違っています。';
    $message['date_format']='【:attribute】yyyy/mm/ddの形式で入力してください。';
    $message['before']='【:attribute】終売日より未来の日付は設定できません。';
    $message['after']='【:attribute】開始年月より過去の年月は設定できません。';
    $message['url.regex']='【:attribute】半角数字以外は使用できません。';
    $message['mbcatch.date_format']='【:attribute】入力形式が間違っています。';
    $message['mbcatchsm.date_format']='【:attribute】入力形式が間違っています。';

    $attributes = [
        'url' => 'プロジェクト番号',
        'urlsm' => 'プロジェクト名称',
        'catchsm' => '受注先',
        'setumei' => '営業',
        'mbcatch' => '開始年月',
        'mbcatchsm' => '終了年月',
        'mbcaption' => '備考',
    ];
    
    //check front validation
    if(Input::has('field')){
        $front_field = explode(",",request('field'));
        foreach($rules as $key=>$val){
            if(!in_array($key, $front_field)){
                unset($rules[$key]);
            }
        }
    }

    $validator = Validator::make($request,$rules,$message,$attributes);    

    return $validator;
  }   
} 
