<?php


namespace App\AllClass\purchase\purchaseSlip;


use App\AllClass\specialCharValidation;
use App\AllClass\zenkaku;
use App\AllClass\AlphanumericKatakanaSymbolValidation;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\AllClass\NumberValidation;


class PurchaseSlipValidation
{
    public static function handle($request)
    {
        $processRequest = $request;
        $commaToIntegerChangeArray = ['purchase_quantity', 'purchase_unit_price', 'purchase_line_amount', 'purchase_consumption_amount'];
        foreach ($processRequest as $key => $value) {
            if (in_array($key, $commaToIntegerChangeArray)) {
                foreach ($value as $newKey => $val) {
                    $processRequest[$key][$newKey] = PurchaseSlip::stringDataConvertedToIntegerFormat($val, 'comma');
                }
            }
        }

        //dd($processRequest);

        $rules = [];

        $rules['display_order.*'] = ['required', 'numeric', new NumberValidation('display_order',3)];
        $rules['group.*'] = ['required', 'numeric', new NumberValidation('group',2)];
        $rules['incharge_purchasing.*'] = ['required'];
        $rules['productCd.*'] = ['required'];
        $rules['productName.*'] = ['required', 'max:40', new specialCharValidation()];
        $rules['purchase_quantity.*'] = ['required', new NumberValidation('purchase_quantity',5)];
        $rules['purchase_unit_price.*'] = ['required', new NumberValidation('purchase_unit_price',5)];
        $rules['purchase_line_amount.*'] = ['required', new NumberValidation('purchase_line_amount',9)];
        $rules['purchase_consumption_amount.*'] = ['required', new NumberValidation('purchase_consumption_amount',9)];
        $rules['accounting_subject.*'] = ['required'];
        $rules['accounting_breakdown.*'] = ['required'];
        $rules['remarks.*'] = ['max:40', new specialCharValidation()];

        $message = [];
        $message['required'] = '【:attribute】必須項目に入力がありません。';
        $message['max'] = '【:attribute】:max桁以下で入力してください。';
        $message['numeric'] = '【:attribute】半角数字以外は使用できません。';



        $attributes = [
            'display_order.*' => '表示順',
            'group.*' => 'グループ',
            'incharge_purchasing.*' => '仕入担当',
            'productCd.*' => '商品',
            'productName.*' => '商品',
            'purchase_quantity.*' => '仕入数量',
            'purchase_unit_price.*' => '仕入単価',
            'purchase_line_amount.*' => '仕入明細金額',
            'purchase_consumption_amount.*' => '仕入明細消費額',
            'accounting_subject.*' => '会計科目',
            'accounting_breakdown.*' => '会計内訳',
            'remarks.*' => '明細備考',
        ];

        return Validator::make($processRequest, $rules, $message, $attributes);
    }

    public static function validate($request)
    {
        $rules = [];
        $rules['group_first'] = ['required'];
        $rules['group_last'] = ['required'];
        $rules['purchase_date'] = ['required'];

        $message = [];
        $message['required'] = '【:attribute】必須項目に入力がありません。';
        $message['max'] = '【:attribute】:max桁以下で入力してください。';
        $message['numeric'] = '【:attribute】半角数字以外は使用できません。';



        $attributes = [
            'group_first' => 'グループ（自）',
            'group_last' => 'グループ（至）',
            'purchase_date' => '仕入日付',
        ];

        return Validator::make($request, $rules, $message, $attributes);
    }
}
