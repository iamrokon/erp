<?php

namespace App\AllClass\master\nameMaster;

use App\AllClass\zenkaku;
use DB;
use App\AllClass\Mobile;
use App\AllClass\specialCharValidation;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\AllClass\master\nameMaster\checkValidation;

Class validateNameEditMaster{
  public static function validate($request,$bango)
  {
    $rules=[];

      if(Input::has('field')){
          $rules['category1'] = ['required', 'regex:/^([a-zA-Z0-9])*$/', 'max:2'];
          $rules['category2'] = ['required', 'max:16'];
          $rules['category3'] = ['required', 'max:20', new zenkaku];
          $rules['category4'] = ['required', 'max:20', new zenkaku];
          $rules['category5'] = ['required', 'max:10']; // 'required',
          $rules['groupbango'] = ['required', 'max:10', new zenkaku];//'required',
          $rules['osusume'] = ['required', 'numeric', 'max:99'];
          $rules['suchi1'] = ['required', 'max:999', 'numeric']; // 'required',
          $rules['spare_one'] = ['nullable','max:1',new checkValidation];
          $rules['spare_two'] = ['nullable','max:30','regex:/^([a-zA-Z0-9])*$/'];
          $rules['spare_three'] = ['nullable','max:30','regex:/^([a-zA-Z0-9])*$/'];
      }else {
          $rules['category1'] = ['required', 'regex:/^([a-zA-Z0-9])*$/', 'max:2', new specialCharValidation];
          $rules['category2'] = ['required',  'max:16', new specialCharValidation];
          $rules['category3'] = ['required', 'max:20', new specialCharValidation, new zenkaku];
          $rules['category4'] = ['required', 'max:20', new specialCharValidation, new zenkaku];
          $rules['category5'] = ['required', 'max:10', new specialCharValidation]; // 'required',
          $rules['groupbango'] = ['required', 'max:10', new zenkaku, new specialCharValidation];//'required',
          $rules['osusume'] = ['bail','required', 'numeric', 'max:99', new specialCharValidation];
          $rules['suchi1'] = ['bail','required', 'max:999', 'numeric', new specialCharValidation]; // 'required',
          $rules['spare_one'] = ['nullable','max:1',new checkValidation,new specialCharValidation];
          $rules['spare_two'] = ['nullable','max:30','regex:/^([a-zA-Z0-9])*$/',new specialCharValidation];
          $rules['spare_three'] = ['nullable','max:30','regex:/^([a-zA-Z0-9])*$/',new specialCharValidation];
      }

    $message=[];
    $message['required']='【:attribute】 必須項目に入力がありません。';
    $message['unique']='【:attribute】 入力が重複しています。';
    $message['max']='【:attribute】 :max桁以下で入力してください。';
    $message['min']='【:attribute】 入力は:min文字以上必要です。';
    $message['regex']='【:attribute】 半角英数字以外は使用できません。';
    $message['numeric']='【:attribute】 半角数字以外は使用できません。';
    $message['osusume.max']='【:attribute】 2桁以下で入力してください。';
    $message['suchi1.max']='【:attribute】 3桁以下で入力してください。';

        $attributes = [
            'category1' => '名称CD',
            'category2' => '分類CD',
            'category3' => '名称名',
            'category4' => '分類名',
            'category5' => '名称名略称',
            'groupbango' => '分類名略称',
            'osusume' => '分類CD桁数',
            'suchi1' => '表示順',
            'spare_one' => '予備 1',
            'spare_two' => '予備 2',
            'spare_three' => '予備 3',

        ];
      if(Input::has('field')){
          $front_field = explode(",",request('field'));
          foreach($rules as $key=>$val){
              if(!in_array($key, $front_field)){
                  unset($rules[$key]);
              }
          }
      }

        $validator = Validator::make($request, $rules, $message, $attributes);

        return $validator;
    }
}
