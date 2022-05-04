<?php

namespace App\AllClass\purchase\supportReqConfirmation;

use DB;
use Illuminate\Support\Facades\Validator;
use App\AllClass\specialCharValidation;
use App\AllClass\zenkaku;
use Illuminate\Support\Facades\Input;

Class ValidateSupportReqConfirmation{
  public static function validate($request,$bango)
  { 
    $request = $request->all();
    $rules=[];
     
    $rules['datatxt0003'] = ['required']; 
    
    if(request('rd1') == 20){
        $rules['datatxt0004'] = ['required']; 
    }
    
    if(str_replace('/', '', request('start_date')) > str_replace('/', '', request('end_date'))){
       $request['date'] = request('start_date');
       $rules['date'] = ['before:end_date'];
    }else{
        $rules['start_date'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
        $rules['end_date'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
        
    
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
    
    $rules['creation_category'] = ['required']; 
    if(isset($request['seal_classification'])){
        $rules['seal_classification'] = ['required']; 
    }
    
    
    $message=[];    
    $message['required']='【:attribute】必須項目に入力がありません。';
    $message['max']='【:attribute】:max桁以下で入力してください。';
    $message['min']='【:attribute】の入力は:min文字以上必要です。';
    $message['regex']='【:attribute】半角数字以外は使用できません。';
    $message['date']='【:attribute】入力形式が間違っています。';
    $message['date_format']='【:attribute】yyyy/mm/ddの形式で入力してください。';
    $message['before']='【:attribute】正しい年月日を入力してください。';
    $message['after']='【:attribute】上市開始日より過去の日付は設定できません。';
    $message['intorder01.before']='【:attribute】正しい年月日を入力してください。';
    

    $attributes = [
        'datatxt0003' => '事業部',
        'datatxt0004' => '部',
        'date' => '依頼日',
        'start_date' => '依頼日1',
        'end_date' => '依頼日2',
        'creation_category' => '作成区分',
        'seal_classification' => '検印区分',
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
