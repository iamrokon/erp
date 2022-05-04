<?php

namespace App\AllClass\sales\accountList;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

Class validateAccountList
{
    public static function validate($request,$bango)
    { 
        $request = $request->all();
        $rules = [];

        $rules['date'] = ['required','regex:/^[0-9\/]+$/','date_format:Y/m'];

        $message = [];    
        $message['required'] = '【:attribute】YYYYMMで入力してください。';
        $message['regex'] = '【:attribute】半角数字以外は使用できません。';
        $message['date_format'] = '【:attribute】YYYYMMで入力してください。';

        $attributes = [
            'date' => '年月'
        ];

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
