<?php

namespace App\AllClass\purchase\purchaseLedger;

use DB;
use Illuminate\Support\Facades\Validator;
use App\AllClass\specialCharValidation;
use App\AllClass\zenkaku;
use Illuminate\Support\Facades\Input;

Class ValidatePurchaseLedger{
  public static function validate($request,$bango)
  { 
    $request = $request->all();
    $rules=[];
     
    
    if(str_replace('/', '', request('touchakudate_start')) > str_replace('/', '', request('touchakudate_end'))){
       $request['touchakudate'] = request('touchakudate_start');
       $rules['touchakudate'] = ['before:touchakudate_end'];
    }else{
        $rules['touchakudate_start'] = ['required','max:7','regex:/^[0-9\/]+$/','date_format:Y/m'];
        $rules['touchakudate_end'] = ['required','max:7','regex:/^[0-9\/]+$/','date_format:Y/m'];
        
    
    //    if(request('intorder01_end') != ""){
    //        $rules['intorder01_start'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d','before:intorder01_end'];
    //    }else{
    //        $rules['intorder01_start'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
    //    }
    //    
    //    if(request('intorder01_start') != ""){
    //        $rules['intorder01_end'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d','after:intorder01_start'];
    //    }else{
    //        $rules['intorder01_end'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
    //    }
    }
    
    $rules['bikou1'] = ['required'];
    
        
    $message=[];    
    $message['required']='【:attribute】必須項目に入力がありません。';
    $message['max']='【:attribute】:max桁以下で入力してください。';
    $message['min']='【:attribute】の入力は:min文字以上必要です。';
    $message['regex']='【:attribute】半角数字以外は使用できません。';
    //$message['date']='【:attribute】入力形式が間違っています。';
    //$message['date_format']='【:attribute】yyyy/mmの形式で入力してください。';
    $message['date_format']='【:attribute】日付の入力が適切ではありません。';
    $message['before']='【:attribute】終売日より未来の日付は設定できません。';
    $message['after']='【:attribute】上市開始日より過去の日付は設定できません。';
    $message['touchakudate.before']='【:attribute】正しい年月を入力してください。';
    

    $attributes = [
        'touchakudate_start' => '年月1',
        'touchakudate_end' => '年月2',
        'touchakudate' => '年月',
        'bikou1' => '購入先',
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
