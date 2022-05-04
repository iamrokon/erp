<?php

namespace App\AllClass\sales\billingBalanceList;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

Class validateBillingBalanceList
{
    public static function validate($request,$bango)
    { 
        $request = $request->all();
        $rules = [];

        $rules['categorykanri'] = ['required'];
        $rules['print_date'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];

        $message = [];   

        $message['required'] = '【:attribute】必須項目に入力がありません。';
        $message['max']='【:attribute】:max桁以下で入力してください';
        $message['regex'] = '【:attribute】半角数字以外は使用できません。';
        $message['date']='【:attribute】入力形式が間違っています。';
        $message['date_format']='【:attribute】yyyy/mm/ddの形式で入力してください。';

        $attributes = [
            'categorykanri' => '締め日',
            'print_date' => '請求日'
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
