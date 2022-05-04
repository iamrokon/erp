<?php

namespace App\AllClass\other\lBook;

use DB;
use Illuminate\Support\Facades\Validator;
use App\AllClass\specialCharValidation;
use App\AllClass\zenkaku;
use Illuminate\Support\Facades\Input;

Class validateLBookTopSearch{
  public static function validate($request,$bango)
  { 
    $request = $request->all();
    $rules=[];
    
    if($request['datachar02_detail'] == "" &&  $request['datachar03_detail'] == ""){
        $rules['datachar02_detail'] = ['required']; 
    }else{
        $rules['datachar02_detail'] = ['nullable']; 
    }
    
    //$rules['datachar02_detail'] = ['nullable']; 
    
    if(request('created_date_end') != ""){
        $created_date_start = str_replace('/', '', request('created_date_start'));
        $created_date_end = str_replace('/', '', request('created_date_end'));
        if($created_date_start != "" && $created_date_start > $created_date_end){
            $request['created_date'] = request('created_date_start');
            $rules['created_date'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d','before_or_equal:created_date_end'];
        }else{
            $rules['created_date_start'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
        }    
    }else{
        $rules['created_date_start'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
    }
    
    if(request('created_date_start') != ""){
        $rules['created_date_end'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
    }else{
        $rules['created_date_end'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
    }
    
    if(request('datachar05_end') != ""){
        $datachar05_start = str_replace('/', '', request('datachar05_start'));
        $datachar05_end = str_replace('/', '', request('datachar05_end'));
        if($datachar05_start != "" && $datachar05_start > $datachar05_end){
            $request['datachar05'] = request('datachar05_start');
            $rules['datachar05'] = ['nullable','max:10','regex:/^[0-9]+$/','required_with:datachar05_end',new CheckBefore(request('datachar05_start'),request('datachar05_end'))];
        }else{
            $rules['datachar05_start'] = ['nullable','max:10','regex:/^[0-9]+$/','required_with:datachar05_end'];
        }
    }else{
        $rules['datachar05_start'] = ['nullable','max:10','regex:/^[0-9]+$/'];
    }
    
    if(request('datachar05_start') != ""){
        //$rules['datachar05_end'] = ['nullable','max:10','regex:/^[0-9]+$/','required_with:datachar05_start',new CheckBefore(request('datachar05_start'),request('datachar05_end'))];
        $rules['datachar05_end'] = ['nullable','max:10','regex:/^[0-9]+$/','required_with:datachar05_start'];
    }else{
        $rules['datachar05_end'] = ['nullable','max:10','regex:/^[0-9]+$/'];
    }
    
    $rules['datachar07'] = ['nullable']; 
    $rules['datachar06'] = ['nullable']; 
        
    $message=[];    
    $message['required']='【:attribute】必須項目に入力がありません。';
    $message['datachar02_detail.required']='【受注先】【売上請求先】必須項目に入力がありません。';
    $message['max']='【:attribute】:max桁以下で入力してください。';
    $message['min']='【:attribute】の入力は:min文字以上必要です。';
    $message['regex']='【:attribute】半角数字以外は使用できません。';
    $message['date']='【:attribute】入力形式が間違っています。';
    $message['date_format']='【:attribute】yyyymmddの形式で入力してください。';
    $message['before']='【:attribute】登録日2より未来の日付は設定できません。';
    $message['before_or_equal']='【:attribute】登録日2より未来の日付は設定できません。';
    $message['after']='【:attribute】登録日1より過去の日付は設定できません。';
    $message['after_or_equal']='【:attribute】登録日1より過去の日付は設定できません。';
    
    $message['created_date.before_or_equal']='【:attribute】正しい年月日を入力してください。';

    $attributes = [
        'datachar02_detail' => '受注先',
        'created_date_start' => '登録日1',
        'created_date' => '登録日',
        'created_date_end' => '登録日2',
        'datachar05' => '受注番号',
        'datachar05_start' => '受注番号1',
        'datachar05_end' => '受注番号2',
        'datachar07' => '種類',
        'datachar06' => '担当',
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
