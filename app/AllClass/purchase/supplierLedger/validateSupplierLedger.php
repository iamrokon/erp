<?php

namespace App\AllClass\purchase\supplierLedger;

use DB;
use Illuminate\Support\Facades\Validator;
use App\AllClass\specialCharValidation;
use App\AllClass\zenkaku;
use Illuminate\Support\Facades\Input;

Class validateSupplierLedger{
  public static function validate($request,$bango)
  { 
    $request = $request->all();
    $rules=[];
     
    $rules['supplier'] = ['required']; 
    
    if(str_replace('/', '', request('start_date')) > str_replace('/', '', request('end_date'))){
       $request['intorder01'] = request('start_date');
       $rules['intorder01'] = ['before:end_date'];
    }else{
        $rules['start_date'] = ['required','max:7','regex:/^[0-9\/]+$/','date_format:Y/m'];
        $rules['end_date'] = ['required','max:7','regex:/^[0-9\/]+$/','date_format:Y/m'];
    }
        
    $message=[];    
    $message['required']='【:attribute】必須項目に入力がありません。';
    $message['max']='【:attribute】:6文字以内で指定してください。';
    $message['min']='【:attribute】の入力は:min文字以上必要です。';
    $message['regex']='【:attribute】日付の入力が適切ではありません。';
    $message['date']='【:attribute】日付の入力が適切ではありません。';
    $message['date_format']='【:attribute】日付の入力が適切ではありません。';
    $message['before']='【:attribute】正しい年月を入力してください。';
    $message['after']='【:attribute】上市開始日より過去の日付は設定できません。';
    $message['intorder01.before']='【:attribute】正しい年月を入力してください。';
    

    $attributes = [
        'start_date' => '年月1',
        'end_date' => '年月2',
        'supplier' => '仕入先',
        'intorder01' => '年月'
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
