<?php

namespace App\AllClass\order\orderHistory;

use DB;
use Illuminate\Support\Facades\Validator;
use App\AllClass\specialCharValidation;
use App\AllClass\zenkaku;
use Illuminate\Support\Facades\Input;

Class validateOrderHistory{
  public static function validate($request,$bango)
  { 
    $request = $request->all();
    $rules=[];
     
    $rules['division_datachar05_start'] = ['required']; 
    $rules['division_datachar05_end'] = ['required']; 
    
    if(str_replace('/', '', request('intorder01_start')) > str_replace('/', '', request('intorder01_end'))){
       $request['intorder01'] = request('intorder01_start');
       $rules['intorder01'] = ['before:intorder01_end'];
    }else{
        $rules['intorder01_start'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
        $rules['intorder01_end'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
        
    
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
    
    
    $rules['kokyakuorderbango_start'] = ['nullable','regex:/^[0-9]+$/',new CheckOrderbangoRange(request('kokyakuorderbango_start'),request('kokyakuorderbango_end'))];
    if(request('kokyakuorderbango_start') == ""){
        $rules['kokyakuorderbango_end'] = ['nullable','regex:/^[0-9]+$/',new CheckOrderbangoRange(request('kokyakuorderbango_start'),request('kokyakuorderbango_end'))];
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
    $message['intorder01.before']='【:attribute】正しい年月日を入力してください。';
    

    $attributes = [
        'division_datachar05_start' => '事業部1',
        'division_datachar05_end' => '事業部2',
        'intorder01' => '受注日',
        'intorder01_start' => '受注日1',
        'intorder01_end' => '受注日2',
        'kokyakuorderbango_end' => '受注番号',
        'kokyakuorderbango_start' => '受注番号',
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
