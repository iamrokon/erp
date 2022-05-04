<?php

namespace App\AllClass\master\creditMaster;

use DB;
use App\AllClass\Mobile;
use App\AllClass\specialCharValidation;
use Illuminate\Support\Facades\Validator;

Class validateCreditEditMaster{
  public static function validate($request,$bango)
  {
    $rules=[];

      $rules['editCreditKounyusu'] = ['required','max:6', 'regex:/^[0-9]+$/'];
      $rules['editCreditSyukei4'] = ['nullable','max:9', 'regex:/^[0-9]+$/'];


    $message=[];
    $message['required']='【:attribute】必須項目に入力がありません。';
    $message['unique']='【:attribute】の入力が重複しています。';
    $message['max']='【:attribute】:max桁以下で入力してください。';
    $message['mail.confirmed']='(確認用)hmelaase';
    $message['min']='【:attribute】の入力は:min文字以上必要です。';
    $message['innerlevel.max']='【:attribute】の入力形式が間違っています。';
    $message['regex']='【:attribute】半角英数字以外は使用できません。';
    $message['numeric']='【:attribute】入力形式が間違っています。';
    $message['email']='【:attribute】の入力形式が間違っています。';

    $attributes = [
    'editCreditKounyusu' => '年月',
    'editCreditSyukei4' => '当月入金金額',
    ];

    $validator = Validator::make($request,$rules,$message,$attributes);

    return $validator;
  }
}
