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
    $message['required']='???:attribute??? ??????????????????????????????????????????';
    $message['unique']='???:attribute??? ?????????????????????????????????';
    $message['max']='???:attribute??? :max???????????????????????????????????????';
    $message['min']='???:attribute??? ?????????:min???????????????????????????';
    $message['regex']='???:attribute??? ????????????????????????????????????????????????';
    $message['numeric']='???:attribute??? ?????????????????????????????????????????????';
    $message['osusume.max']='???:attribute??? 2???????????????????????????????????????';
    $message['suchi1.max']='???:attribute??? 3???????????????????????????????????????';

        $attributes = [
            'category1' => '??????CD',
            'category2' => '??????CD',
            'category3' => '?????????',
            'category4' => '?????????',
            'category5' => '???????????????',
            'groupbango' => '???????????????',
            'osusume' => '??????CD??????',
            'suchi1' => '?????????',
            'spare_one' => '?????? 1',
            'spare_two' => '?????? 2',
            'spare_three' => '?????? 3',

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
