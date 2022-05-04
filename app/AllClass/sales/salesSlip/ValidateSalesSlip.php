<?php

namespace App\AllClass\sales\salesSlip;

use DB;
use Illuminate\Support\Facades\Validator;
use App\AllClass\specialCharValidation;
use App\AllClass\zenkaku;
use Illuminate\Support\Facades\Input;

Class ValidateSalesSlip{
  public static function validate($request,$bango)
  { 
    $request = $request->all();
    $rules=[];
     
    $rules['division_datachar05_start'] = ['required']; 
    $rules['division_datachar05_end'] = ['required']; 
    
    if(str_replace('/', '', request('intorder03_start')) > str_replace('/', '', request('intorder03_end'))){
       $request['intorder03'] = request('intorder03_start');
       $rules['intorder03'] = ['before:intorder03_end'];
    }else{
        $rules['intorder03_start'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
        $rules['intorder03_end'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
        
        //if(request('intorder03_end') != ""){
        //    $rules['intorder03_start'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d','before:intorder03_end'];
        //}else{
        //    $rules['intorder03_start'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
        //}
        //if(request('intorder03_start') != ""){
        //    $rules['intorder03_end'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d','after:intorder03_start'];
        //}else{
        //    $rules['intorder03_end'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
        //}
    }
    
    $rules['information1_detail'] = ['nullable']; 
    $rules['information2_detail'] = ['nullable']; 
    $rules['information3_detail'] = ['nullable']; 
    $rules['datachar02'] = ['required']; 
    $rules['hktsyukko_datachar04'] = ['required']; 
        
    $message=[];    
    $message['required']='【:attribute】必須項目に入力がありません。';
    $message['max']='【:attribute】:max桁以下で入力してください。';
    $message['min']='【:attribute】の入力は:min文字以上必要です。';
    $message['regex']='【:attribute】半角数字以外は使用できません。';
    $message['date']='【:attribute】入力形式が間違っています。';
    $message['date_format']='【:attribute】yyyy/mm/ddの形式で入力してください。';
    $message['before']='【:attribute】終売日より未来の日付は設定できません。';
    $message['after']='【:attribute】上市開始日より過去の日付は設定できません。';
    $message['intorder03.before']='【:attribute】正しい年月日を入力してください。';
    

    $attributes = [
        'division_datachar05_start' => '事業部1',
        'division_datachar05_end' => '事業部2',
        'information1_detail' => '受注先',
        'information2_detail' => '売上請求先',
        'information3_detail' => '最終顧客',
        'intorder03' => '受注日',
        'intorder03_start' => '売上日1',
        'intorder03_end' => '売上日2',
        'datachar02' => '受注区分',
        'hktsyukko_datachar04' => '発行区分',
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
