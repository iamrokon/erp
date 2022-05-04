<?php

namespace App\AllClass\master\productSubMaster;

use DB;
use App\AllClass\Mobile;
use App\AllClass\zenkaku;
use App\AllClass\specialCharValidation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class validateProductSubMaster
{
    public static function validate($request, $bango)
    {

        $rules = [];
        $rules['other1'] = ['required'];
        $rules['other12'] = ['required', 'regex:/^([0-9])*$/'];
        $rules['other2'] = ['required', 'regex:/^([0-9])*$/', new specialCharValidation, new CheckUniqueOther2];
        $rules['other3'] = ['required', new specialCharValidation];
        $rules['other4'] = ['required', new specialCharValidation];
        $rules['other5'] = ['nullable', 'max:30', new specialCharValidation];
        $rules['other22'] = ['nullable', 'max:15', new specialCharValidation];
        $rules['other23'] = ['nullable', 'max:8', new specialCharValidation];
        $rules['other24'] = ['nullable', 'max:8', new specialCharValidation];
        $rules['other25'] = ['required', new specialCharValidation];
        $rules['other21'] = ['required', 'max:25', new specialCharValidation];
        $rules['other22'] = ['nullable', 'max:15', new specialCharValidation];
        $rules['other23'] = ['nullable', 'max:8', new specialCharValidation];
        $rules['other24'] = ['nullable', 'max:8', new specialCharValidation];
        $rules['other18'] = ['nullable', 'max:2', 'regex:/^([0-9])*$/'];
        $rules['other15'] = ['bail', 'nullable', 'max:8', 'regex:/^([0-9])*$/', new specialCharValidation];
        $rules['other16'] = ['bail', 'nullable', 'max:8', 'regex:/^([0-9])*$/', new specialCharValidation];
        $rules['other18'] = ['bail', 'nullable', 'max:2', 'regex:/^([0-9])*$/', new specialCharValidation];
        $rules['other20'] = ['bail', 'nullable', 'max:4', 'regex:/^([0-9])*$/', new specialCharValidation];



        $message = [];
        $message['required'] = '【:attribute】必須項目に入力がありません。';
        $message['unique'] = '【:attribute】の入力が重複しています。';
        $message['max'] = '【:attribute】:max桁以下で入力してください。';
        $message['other15.digits_between'] = '【:attribute】8桁以下で入力してください。';
        $message['other16.digits_between'] = '【:attribute】8桁以下で入力してください。';
        $message['other18.digits_between'] = '【:attribute】4桁以下で入力してください。';
        $message['other20.digits_between'] = '【:attribute】4桁以下で入力してください。';
        $message['mail.confirmed'] = '【:attribute】(確認用)が一致しません。';
        $message['mail.regex'] = '【:attribute】半角英数字以外は使用できません。';
        $message['passwd.confirmed'] = '【:attribute】(確認用)が一致しません。';
        $message['min'] = '【:attribute】の入力は:min文字以上必要です。';
        $message['min'] = '【:attribute】の入力は:min文字以上必要です。';
        $message['regex'] = '【:attribute】半角数字以外は使用できません。';
        $message['numeric'] = '【:attribute】半角数字以外は使用できません。';
        $message['email'] = '【:attribute】の入力形式が間違っています。';

        $attributes = [
            'other1' => 'サブ区分',
            'other2' => '商品サブCD',
            'other3' => '取引先',
            'other4' => 'データ種',
            'other25' => 'バージョン区分',
            'other5' => '商品サブ名称カナ名',
            'other21' => '商品サブ名称',
            'other22' => '小売業略称',
            'other23' => '小売業部門',
            'other24' => '小売業メッセージ種',
            'other15' => '上市開始日',
            'other16' => '終売日',
            'other18' => 'サブCD桁数',
            'other20' => '対応バージョン',
            'other22' => '小売業略称',
            'other23' => '小売業部門',
            'other24' => '小売業メッセージ種',
            'other18' => 'サブCD桁数',
            'other12' => '作成者',
            'other9' => '作成事業部',
            'other10' => '作成部',
            'other11' => '作成課',
        ];

        //check front validation
        if (Input::has('field')) {
            $front_field = explode(",", request('field'));
            foreach ($rules as $key => $val) {
                if (!in_array($key, $front_field)) {
                    unset($rules[$key]);
                }
            }
        }

        $validator = Validator::make($request, $rules, $message, $attributes);

        return $validator;
    }
}
