<?php

namespace App\AllClass\purchase\purchaseRecordTransfer;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class validatePurchaseRecordTransfer1
{
    public static function validate($request,$bango)
    {
        $request = $request->all();
        $rules = [];
      
        $rules['order_number_101'] = ['required', 'numeric', 'digits_between:0,10','max:10'];  
        $rules['data_102'] = ['required'];  
        $rules['data_103'] = ['required'];  

        $message = [];
        $message['required'] = '【:attribute】必須項目に入力がありません。';
        $message['numeric'] = '【:attribute】半角数字以外は使用できません。';
        $message['digits_between'] = '【:attribute】:max桁以下で入力してください。';
        $message['max'] = '【:attribute】:max桁以下で入力してください。';

        $attributes = [
            
            'order_number_101' => '振替元受注番号',
            'data_102' => '受注先',
            'data_103' => '受注担当'
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
        return Validator::make($processRequest, $rules, $message, $attributes);
    }
}
