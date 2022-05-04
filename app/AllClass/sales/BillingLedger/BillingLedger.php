<?php

namespace App\AllClass\sales\BillingLedger;

use App\AllClass\TableSetting;
use Illuminate\Support\Facades\Validator;

class BillingLedger
{
    public static $pageNo = '04-08';
    public static function headers($bango, $type = null)
    {
        $headers = [
            '日付' => 'dates',
            '区分' => 'classification',
            '伝票番号' => 'slip_number',
            '行' => 'lines',
            '品名' => 'product_name',
            '数' => 'numbers',
            '単価/期日' => 'unit_price',
            '売上金額' => 'sales_amount',
            '消費税額' => 'consumption_tax',
            '入金金額' => 'deposit_amount',
            '残高' => 'balance',
            '受注伝票番号' => 'order_slip_number',
            '受注行' => 'order_line',
            '備考' => 'remarks',
            '受注先' => 'contractor',
            '最終顧客' => 'end_customer',
            '受注担当部署CD' => 'classification1',
            '受注担当者' => 'user_name',
            '伝票備考'=>'voucher_remarks',
            '客先注番'=>'customer_note_number',
        ];
        $pageNo = self::$pageNo;
        if ($type) {
            return TableSetting::getHeaders($bango, $pageNo, $headers, $type);
        }
        return TableSetting::getHeaders($bango, $pageNo, $headers);
    }
    public static function validate($request)
    {
        $newRequest = $request->all();
        $reqToChange = ['ledger_year_start', 'ledger_year_end'];
        foreach ($newRequest as $key => $value) {
            if (in_array($key, $reqToChange)) {
                $newRequest[$key] = str_replace('/', '', $value);
            }
        }
        $rules = [];
        $rules['ledger_year_start'] = ['required', 'max:6', new DateCheckGreaterThan($newRequest['ledger_year_end'], '年月')];
        $rules['ledger_year_end'] =  ['required', 'max:6', new DateCheckLessThan($newRequest['ledger_year_start'], '年月')];
        $rules['billing_address_text'] = ['required'];


        $messages = [];
        $messages['required'] = '【:attribute】必須項目に入力がありません。';
        $messages['max'] = '【:attribute】:max桁以下で入力してください。';

        $attributes = [
            'ledger_year_start' => '年月1',
            'ledger_year_end' => '年月2',
            'billing_address_text' => '売上請求先'
        ];
        return Validator::make($newRequest, $rules, $messages, $attributes);
    }
}
