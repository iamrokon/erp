<?php


namespace App\AllClass\sales\DepositApplication;


use App\AllClass\sales\DeliveryNote\DateCheckLessThan;
use Illuminate\Support\Facades\Validator;

class DepositApplication
{
    /***
     * @param $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validate($request)
    {

        $rules['sales_date_start'] = ['nullable', 'max:10', new DateCheckLessThan('sales_date_end')];
        $rules['billing_address'] = ['required'];
        $message['required'] = '【:attribute】必須項目に入力がありません。';
        $message['max'] = '【:attribute】:max桁以下で入力してください。';
        $attributes = [
            'order_category' => '受注区分',
            'creation_category' => '作成区分'
        ];
        return Validator::make($request, $rules, $message, $attributes);

    }
}
