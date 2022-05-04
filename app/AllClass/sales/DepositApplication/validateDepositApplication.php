<?php

namespace App\AllClass\sales\DepositApplication;

use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

Class validateDepositApplication{
  public static function validate($request,$bango)
  {
    $request = $request->all();
    $rules=[];
    $sales_number = request('sales_number');
    for($i = 1; $i <= $sales_number; $i++){
      if(request('depositAmount_'.$i) > request('not_payment_'.$i)){
        $rules['depositAmount_'.$i] = ['before:not_payment_'.$i];
      }
    }

    // if(str_replace('/', '', request('intorder03_start')) > str_replace('/', '', request('intorder03_end'))){
    //   $request['intorder03'] = request('intorder03_start');
    //   $rules['intorder03'] = ['before:intorder03_end'];
    // }else{
    //   $rules['intorder03_start'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
    //   $rules['intorder03_end'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
    // }

    // $message['required']='【:attribute】必須項目に入力がありません。';
    // $message['max']='【:attribute】:max桁以下で入力してください。';
    // $message['min']='【:attribute】の入力は:min文字以上必要です。';
    // $message['regex']='【:attribute】半角数字以外は使用できません。';
    // $message['date']='【:attribute】入力形式が間違っています。';
    // $message['date_format']='【:attribute】yyyy/mm/ddの形式で入力してください。';
    $message['before']='【:attribute】終売日より未来の日付は設定できません。';
    // $message['intorder03.before']='【:attribute】正しい年月日を入力してください。';
    //$message['after']='【:attribute】上市開始日より過去の日付は設定できません。';
    // $message['date.before']='【:attribute】正しい年月日を入力してください。';

    for($i = 1; $i <= $sales_number; $i++){
      $attributes['depositAmount_'.$i] = '入金金額';
    }

    // $attributes = [
    //     'division_datachar05_start' => '事業部1',
    //     'date' => $attr2,
    // ];

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
