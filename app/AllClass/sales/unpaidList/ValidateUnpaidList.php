<?php

namespace App\AllClass\sales\unpaidList;

use DB;
use Illuminate\Support\Facades\Validator;
use App\AllClass\specialCharValidation;
use App\AllClass\zenkaku;
use Illuminate\Support\Facades\Input;

Class ValidateUnpaidList{
  public static function validate($request,$bango)
  { 
    $request = $request->all();
    $rules=[];
     
    $rules['division_datachar05_start'] = ['required']; 
    $rules['division_datachar05_end'] = ['required']; 
    $rules['datachar05'] = ['nullable']; 
    
    if((request('intorder05_start') == "" && request('intorder05_end') == "") && (request('intorder03_start') == "" && request('intorder03_end') == "") ){
        $rules['intorder05_intorder03'] = ['required'];
    }else{
        if(request('intorder03_start') != "" && request('intorder03_end') != ""){
            if(str_replace('/', '', request('intorder05_start')) > str_replace('/', '', request('intorder05_end'))){
                $request['intorder05'] = request('intorder05_start');
                $rules['intorder05'] = ['before:intorder05_end'];
            }else{
                $rules['intorder05_start'] = ['nullable','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
                $rules['intorder05_end'] = ['nullable','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];   
            }
        }else{
            if(str_replace('/', '', request('intorder05_start')) > str_replace('/', '', request('intorder05_end'))){
                $request['intorder05'] = request('intorder05_start');
                $rules['intorder05'] = ['before:intorder05_end'];
            }else{
                $rules['intorder05_start'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
                $rules['intorder05_end'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];   
            } 
        }


        if(request('intorder05_start') != "" && request('intorder05_end') != ""){
            if(str_replace('/', '', request('intorder03_start')) > str_replace('/', '', request('intorder03_end'))){
                $request['intorder03'] = request('intorder03_start');
                $rules['intorder03'] = ['before:intorder03_end'];
            }else{
                $rules['intorder03_start'] = ['nullable','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
                $rules['intorder03_end'] = ['nullable','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];   
            }
        }else{
            if(str_replace('/', '', request('intorder03_start')) > str_replace('/', '', request('intorder03_end'))){
                $request['intorder03'] = request('intorder03_start');
                $rules['intorder03'] = ['before:intorder03_end'];
            }else{
                $rules['intorder03_start'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
                $rules['intorder03_end'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];   
            }
        }
    }
    
    
    $message=[];    
    $message['required']='【:attribute】必須項目に入力がありません。';
    $message['intorder05_intorder03.required']='入金予定日、売上日のいずれかを指定してください。';
    $message['max']='【:attribute】:max桁以下で入力してください。';
    $message['min']='【:attribute】の入力は:min文字以上必要です。';
    $message['regex']='【:attribute】半角数字以外は使用できません。';
    $message['date']='【:attribute】入力形式が間違っています。';
    $message['date_format']='【:attribute】yyyy/mm/ddの形式で入力してください。';
    $message['before']='【:attribute】終売日より未来の日付は設定できません。';
    $message['after']='【:attribute】上市開始日より過去の日付は設定できません。';
    $message['intorder05.before']='【:attribute】正しい年月日を入力してください。';
    $message['intorder03.before']='【:attribute】正しい年月日を入力してください。';
    

    $attributes = [
        'division_datachar05_start' => '事業部1',
        'division_datachar05_end' => '事業部2',
        'datachar05' => '担当',
        'intorder05' => '入金予定日',
        'intorder05_start' => '入金予定日1',
        'intorder05_end' => '入金予定日2',
        'intorder03' => '売上日',
        'intorder03_start' => '売上日1',
        'intorder03_end' => '売上日2',
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
