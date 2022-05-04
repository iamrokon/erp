<?php


namespace App\AllClass\purchase\supportEntry;


use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\AllClass\zenkaku;


class SupportEntryCreateValidation{
    public static function handle($request){
        $rules = [];
        // 101
        $rules['syouhinbango_jouhou'] = ['required'];
        // 102
        $rules['number_search'] = ['required', 'numeric', 'digits_between:0,10'];

        // 121
        if($request['syouhinbango_jouhou'] == 1){
            $rules['hidden_se_profit_meter'] = ['required'];
        }

        // 202A
        $rules['datepicker11_oen'] = ['required'];

        // 204
        $rules['include_place'] = ['nullable', 'max:40', new zenkaku];
        // 205
        $rules['model_name'] = ['nullable', 'max:40', new zenkaku];
        // 206
        $rules['juchukubun1_business_name'] = ['nullable', 'max:40', new zenkaku];
        // 207
        $rules['os'] = ['nullable', 'max:40', new zenkaku];    
        $rules['acceptance_condition'] = ['nullable', new zenkaku];    

        // 208
        $rules['information7_in_house_remarks'] = ['nullable', new zenkaku];
        
        // 209 not required
        $rules['order_shipping_remarks_209'] = ['nullable', new zenkaku];

        // 210
        //$rules['order_summary_remarks'] = ['required'];
        $rules['order_summary_remarks'] = ['required', new zenkaku];

        // 214
        $rules['chumonsyajouhou_214'] = ['required'];
        // 216
        $rules['datatxt0004_216'] = ['required'];

        $rules['consultation_person_name'] = ['nullable', 'max:40'];

        
        $message = [];
        $message['required'] = '【:attribute】必須項目に入力がありません。';
        $message['number_search.required'] = '【:attribute】必須項目に入力がありません。10文字以下で入力してください。';
        $message['numeric'] = '【:attribute】半角数字以外は使用できません。';
        $message['digits_between'] = '【:attribute】:max桁以下で入力してください。';
        $message['max'] = '【:attribute】:max桁以下で入力してください。';
        $message['mimes'] = '【:attribute】pdf zip のみOK。';
        $message['lte'] = '【:attribute】日付の入力が適切ではありません。';
        $message['gte'] = '【:attribute】日付の入力が適切ではありません。';
        $message['sales_amount_total.max'] = ' 販売金額計が桁あふれしています。';
        $message['sales_amount_total.min'] = ' 販売金額計が桁あふれしています。';

        $attributes = [
            'syouhinbango_jouhou' => '作成区分',
            'number_search' => '番号検索',
            'hidden_se_profit_meter' => 'SE粗利計',
            'datepicker11_oen' => 'サポート納期',
            'include_place' => '納入場所',
            'model_name' => '機種名',
            'juchukubun1_business_name' => '業務名',
            'os' => 'OS',
            'information7_in_house_remarks' => '社内備考',
            'order_shipping_remarks_209' => '発注出荷備考',
            'order_summary_remarks' => '受注概要や留意点',
            'chumonsyajouhou_214' => '検収条件',
            'datatxt0004_216' => 'サポート部門',
            'acceptance_condition' => '検収条件',
            'consultation_person_name'=> '相談SE',
        ];

        return Validator::make($request, $rules, $message, $attributes);
    }
}
