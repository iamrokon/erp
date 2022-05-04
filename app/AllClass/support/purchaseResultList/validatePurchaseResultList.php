<?php

namespace App\AllClass\support\purchaseResultList;

use DB;
use Illuminate\Support\Facades\Validator;
use App\AllClass\specialCharValidation;
use App\AllClass\zenkaku;
use Illuminate\Support\Facades\Input;

Class validatePurchaseResultList{
  public static function validate($request,$bango)
  { 
    $request = $request->all();
    $rules=[];
     
    $rules['division_datachar05_start'] = ['required']; 
    $rules['division_datachar05_end'] = ['required']; 
    // dd(request('salesDateForm'));
    if(request('salesDateFrom')){
        $rules['purchaseDateFrom'] = ['nullable','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
        $rules['purchaseDateTo'] = ['nullable','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
    }
    else {
        if(str_replace('/', '', request('purchaseDateFrom')) > str_replace('/', '', request('purchaseDateTo'))){
        $request['intorder01'] = request('purchaseDateFrom');
        $rules['intorder01'] = ['before:purchaseDateTo'];
        }else{
            $rules['purchaseDateFrom'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
            $rules['purchaseDateTo'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
    }  
    
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
    
    
    // $rules['salesDateFrom'] = ['nullable','regex:/^[0-9]+$/',new CheckOrderbangoRange(request('kokyakuorderbango_start'),request('kokyakuorderbango_end'))];
    // if(request('salesDateFrom') == ""){
    //     $rules['salesDateTo'] = ['nullable','regex:/^[0-9]+$/',new CheckOrderbangoRange(request('kokyakuorderbango_start'),request('kokyakuorderbango_end'))];
    // }
        
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
        'intorder01' => '売上日',
        'purchaseDateFrom' => '売上日1',
        'purchaseDateTo' => '売上日2',
        'salesDateFrom' => '外注仕入完了日1',
        'salesDateTo' => '外注仕入完了日2',
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
  public static function validateUpdateData($request,$bango)
  { 
    $request = $request->all();
    $rules=[];
    $rules['tanka.*'] = ['required']; 
    
    $message=[];    
    $message['required']='【:attribute】必須項目に入力がありません。';
    $message['date']='【:attribute】入力形式が間違っています。';
    $message['date_format']='【:attribute】yyyy/mm/ddの形式で入力してください。';
    

    $attributes = [
        'tanka.*' => '入金予定日',
    ];
    

    $validator = Validator::make($request,$rules,$message,$attributes);    

    return $validator;
  }  
} 
