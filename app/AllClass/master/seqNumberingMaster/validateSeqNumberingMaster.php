<?php

namespace App\AllClass\master\seqNumberingMaster;

use DB;
use App\AllClass\Mobile;
use App\AllClass\specialCharValidation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

Class validateSeqNumberingMaster{ 
  public static function validate($request,$bango)
  { 
    $rules=[];

    $rules['kokyakusyouhinbango'] = ['required','unique:review,kokyakusyouhinbango'];
    
    $rules['orderbango'] = ['required','max:8','regex:/^[0-9]+$/'];
    
    $rules['mobile_flag'] = ['required','max:2','regex:/^[0-9]+$/'];
    

    $message=[];    
    $message['required']='【:attribute】必須項目に入力がありません。';
    $message['unique']='【:attribute】番号区分が重複しています。';
    $message['max']='【:attribute】:max桁以下で入力してください。';
    $message['regex']='【:attribute】に半角英数字以外は使用できません。';
    $message['orderbango.regex']='【:attribute】半角数字以外は使用できません。';
    $message['mobile_flag.regex']='【:attribute】半角数字以外は使用できません。';

    $attributes = [
        'kokyakusyouhinbango' => '番号区分',
        'orderbango' => '番号',
        'mobile_flag' => '番号総桁数',
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
