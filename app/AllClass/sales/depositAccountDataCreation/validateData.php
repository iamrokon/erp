<?php

namespace App\AllClass\sales\depositAccountDataCreation;

use Illuminate\Support\Facades\Validator;

Class validateData{
    public static function validate($request)
    {
        $rules = [];

        if($request['date_start']!=NULL && $request['date_end']!=NULL && str_replace('/', '', $request['date_start']) >= str_replace('/', '', $request['date_end']))
        {
            $request['date'] = $request['date_start'];
            $rules['date'] = ['before_or_equal:date_end'];
        }
        $rules['date_start'] = ['required','date_format:Y/m/d'];
        $rules['date_end'] = ['required','date_format:Y/m/d'];

        $message = [];
        $message['required'] = '【:attribute】必須項目に入力がありません。';
        $message['date_format'] = '【:attribute】yyyy/mm/ddの形式で入力してください。';
        $message['before_or_equal'] = '【:attribute】正しい年月日を入力してください。';

        $attributes = [
            'date_start' => '入金日1',
            'date_end' => '入金日2',
            'date' => '入金日'
        ];

        $validator = Validator::make($request,$rules,$message,$attributes);

        return $validator;
    }
}