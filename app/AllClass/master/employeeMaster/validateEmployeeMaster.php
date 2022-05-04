<?php

namespace App\AllClass\master\employeeMaster;

use App\AllClass\CheckDuplicateBango;
use App\AllClass\CheckInnerLevel;
use App\tantousya;
use DB;
use App\AllClass\Mobile;
use App\AllClass\zenkaku;
use App\AllClass\specialCharValidation;
use App\AllClass\imageFormatValidator;
use App\AllClass\imageFormatValidator2;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class validateEmployeeMaster
{
    public static function validate($request, $bango)
    {
        $innerLevel = tantousya::innerLevel($bango);

        $rules = [];


        if (Input::has("field")) {
            $rules['ztanka'] = ['required', 'regex:/^([0-9])*$/', 'max:2'];
            $rules['bango'] = ['required', 'regex:/^([0-9])*$/', 'max:4', 'min:1'];
            $rules['name1'] = ['required', 'max:8'];
            $rules['name2'] = ['required', 'max:8'];
            $rules['htanka'] = ['nullable', 'regex:/^([0-9])*$/', 'max:5', 'min:1'];
            $rules['datatxt0003'] = ['required', 'max:50'];
            $rules['datatxt0004'] = ['nullable', 'max:50'];
            $rules['datatxt0005'] = ['nullable', 'max:50'];
            $rules['syozoku'] = ['required', 'max:50'];
            $rules['passwd'] = ['required', 'max:8', 'regex:/^([a-z0-9])*$/'];
            $rules['mail4'] = ['required', 'max:50'];
            $rules['mail2'] = ['nullable', 'regex:/^([0-9])*$/', 'max:11'];
            $rules['mail3'] = ['nullable', 'regex:/^([0-9])*$/', 'max:11'];
            $rules['mail'] = ['required', 'max:70', 'regex:/^[a-zA-z0-9-._@]+$/'];
        } else {
            $rules['ztanka'] = ['required', 'regex:/^([0-9])*$/', 'max:2'];
            $rules['bango'] = ['required', 'regex:/^([0-9])*$/', 'max:4', 'min:1', new CheckDuplicateBango];
            $rules['name1'] = ['required', 'max:8', new specialCharValidation];
            $rules['name2'] = ['required', 'max:8', new specialCharValidation];
            $rules['htanka'] = ['nullable', 'regex:/^([0-9])*$/', 'max:5', 'min:1'];
            $rules['datatxt0003'] = ['required', 'max:50', new specialCharValidation];
            $rules['datatxt0004'] = ['nullable', 'max:50', new specialCharValidation];
            $rules['datatxt0005'] = ['nullable', 'max:50', new specialCharValidation];
            $rules['syozoku'] = ['required', 'max:50', new specialCharValidation];
            $rules['passwd'] = ['required', 'max:8', 'regex:/^([a-z0-9])*$/', new specialCharValidation, 'confirmed'];
            $rules['mail4'] = ['required', 'max:50', new specialCharValidation];
            $rules['mail2'] = ['nullable', 'regex:/^([0-9])*$/', 'max:11'];
            $rules['mail3'] = ['nullable', 'regex:/^([0-9])*$/', 'max:11'];
            $rules['mail'] = ['required', 'unique:tantousya', 'email', 'max:70', 'regex:/^[a-zA-z0-9-._@]+$/', 'confirmed', new specialCharValidation];
            $rules['datatxt0030'] = ['nullable', 'max:50', new specialCharValidation];
            $rules['datatxt0031'] = ['nullable', 'max:50', new specialCharValidation];
            $rules['datatxt0032'] = ['nullable', 'max:50', new specialCharValidation];
            $rules['datatxt0033'] = ['nullable', 'max:50', new specialCharValidation];
            $rules['datatxt0034'] = ['nullable', 'max:50', new specialCharValidation];
            $rules['datatxt0035'] = ['nullable', 'max:50', new specialCharValidation];
            $rules['datatxt0036'] = ['nullable', 'max:50', new specialCharValidation];
            $rules['datatxt0037'] = ['nullable', 'max:50', new specialCharValidation];
            $rules['datatxt0029'] = ['nullable', 'max:100000', 'mimes:jpeg,jpg,png,gif,bmp,pdf'];
            $rules['syounin'] = ['nullable', 'max:100000', 'mimes:jpeg,jpg,png,gif,bmp'];
//            $rules['inpemp1'] = ['bail', 'nullable', new specialCharValidation, 'max:60', 'string', new imageFormatValidator, 'unique:tantousya,datatxt0029'];   //regex:/^(([a-zA-Z0-9.])+.(?:jpe?g|png|gif|bmp))$/
//            $rules['inpemp3'] = ['bail', 'nullable', new specialCharValidation, 'max:60', 'string', new imageFormatValidator2, 'unique:tantousya,syounin'];
            $rules['inpemp1'] = ['bail', 'nullable', new specialCharValidation, 'max:60', 'string', new imageFormatValidator];   //regex:/^(([a-zA-Z0-9.])+.(?:jpe?g|png|gif|bmp))$/
            $rules['inpemp3'] = ['bail', 'nullable', new specialCharValidation, 'max:60', 'string', new imageFormatValidator2];
            $rules['innerlevel'] = ['required', 'regex:/^([0-9])*$/', 'numeric', 'between:10,20', function ($attribute, $value, $fail) use ($innerLevel) {
                if ($value < $innerLevel) {
                    $fail("【権限レベル】 この権限レベルは登録できません。");
                }
            }];
        }
        $message = [];
        $message['required'] = '【:attribute】必須項目に入力がありません。';
        $message['unique'] = '【:attribute】同:attributeが存在します。';
        $message['max'] = '【:attribute】:max桁以下で入力してください。';
        $message['mail.confirmed'] = '【:attribute(確認用)】とメールアドレスが一致しません。';
        $message['mail.regex'] = '【:attribute】半角英数字以外は使用できません。';
        $message['passwd.confirmed'] = '【:attribute(確認用)】が一致しません。';
        $message['passwd.regex'] = '【パスワード】半角英小文字または半角数字以外は使用できません。';
        $message['passwd_confirmation.regex'] = '【パスワード(確認用)】半角英小文字または半角数字以外は使用できません。';
        $message['min'] = '【:attribute】入力は:min文字以上必要です。';
        $message['min'] = '【:attribute】入力は:min文字以上必要です。';
        $message['regex'] = '【:attribute】半角数字以外は使用できません。';
        $message['numeric'] = '【:attribute】半角数字以外は使用できません。';
        $message['email'] = '【:attribute】入力されたメールアドレスの形式はご登録いただけません。';
        $message['datatxt0029.mimes'] = '';
        $message['syounin.mimes'] = '';

//        $message['datatxt0029.mimes'] = '【:attribute】jpeg  jpg  gif  png  bmp  pdf のみOK。';
        $message['inpemp1.regex'] = '【:attribute】半角英数字および"-"以外は使用できません。';
        $message['inpemp3.regex'] = '【:attribute】半角英数字および"-"以外は使用できません。';

        $message['between'] = '【:attribute】10～20　までの数字しか入力できません。';
        $attributes = [
            'ztanka' => '事業年度(期)',
            'bango' => '社員CD',
            'name1' => '社員名(姓)',
            'name2' => '社員名(名)',
            'htanka' => '給与CD',
            'datatxt0003' => '事業部',
            'datatxt0004' => '部',
            'datatxt0005' => 'グループ',
            'syozoku' => '事業所CD',
            'passwd' => 'パスワード',
            'passwd_confirmation' => 'パスワード(確認用)',
            'mail4' => '権限CD',
            'mail2' => '電話番号',
            'mail3' => '内線番号',
            'mail' => 'メールアドレス',
            'mail_confirmation' => 'メールアドレス(確認用)',
            'datatxt0030' => '入力者1',
            'datatxt0031' => '入力者2',
            'datatxt0032' => '入力者3',
            'datatxt0033' => '入力者4',
            'datatxt0034' => '決裁者1',
            'datatxt0035' => '決裁者2',
            'datatxt0036' => '決裁者3',
            'datatxt0037' => '決裁者4',
            'datatxt0029' => '社員印影',
            'syounin'=> '写真',
            'inpemp1' => '社員印影',
            'inpemp3' => '写真',
            'innerlevel' => '権限レベル'
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
