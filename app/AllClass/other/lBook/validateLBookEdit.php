<?php

namespace App\AllClass\other\lBook;

use DB;
use Illuminate\Support\Facades\Validator;
use App\AllClass\specialCharValidation;
use App\AllClass\Mobile;
use App\AllClass\zenkaku;
use Illuminate\Support\Facades\Input;

Class validateLBookEdit{
  public static function validate($request,$bango)
  { 
    $rules=[];
    
    $rules['datachar01'] = ['required'];
    $rules['datachar02'] = ['required'];
    $rules['datachar06'] = ['required'];
    $rules['datachar07'] = ['required'];
    $rules['datachar08'] = ['required','max:40',new specialCharValidation,new zenkaku];
    $rules['datachar09'] = ['required'];
    $rules['filename'] = ['mimes:pdf,zip'];
    $rules['datachar10'] = ['required'];
    
    $message=[];    
    $message['required']='【:attribute】必須項目に入力がありません。';
    $message['unique']='【:attribute】の入力が重複しています。';
    $message['max']='【:attribute】:max桁以下で入力してください。';
    $message['datachar08.max']='【:attribute】:max文字以下で入力してください。';
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
    $message['mimes'] = '【:attribute】pdf zip のみOK。';

    $attributes = [
        'datachar01' => '書類保管番号',
        'datachar02' => '受注先',
        'datachar06' => '担当',
        'datachar07' => '文書種類',
        'datachar08' => '文書名',
        'datachar09' => '保管ファイル',
        'filename' => '保管ファイル',
        'datachar10' => '共有レベル',
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
