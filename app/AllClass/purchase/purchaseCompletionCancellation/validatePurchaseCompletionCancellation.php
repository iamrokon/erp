<?php

namespace App\AllClass\purchase\purchaseCompletionCancellation;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class validatePurchaseCompletionCancellation
{
    public static function validate($request,$bango)
    {
        $request = $request->all();
        $rules = [];
      
        $rules['order_number'] = ['required', 'numeric', 'digits_between:0,10','max:10'];  

        $message = [];
        $message['required'] = '【:attribute】必須項目に入力がありません。';
        $message['numeric'] = '【:attribute】半角数字以外は使用できません。';
        $message['digits_between'] = '【:attribute】:max桁以下で入力してください。';
        $message['max'] = '【:attribute】:max桁以下で入力してください。';

        $attributes = [
            
            'order_number' => '受注番号'
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
