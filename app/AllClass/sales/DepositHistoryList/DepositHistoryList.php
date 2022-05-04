<?php


namespace App\AllClass\sales\DepositHistoryList;


use App\AllClass\TableSetting;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Validator;

class DepositHistoryList
{
    public static $pageNo = '04-22';
    public static function headers($bango, $type = null)
    {
        $pageNo = static::$pageNo;
        $headers = [
            '処理日'  =>  'disposal_day',
            '消込番号'  =>  'application_number',
            '消込行番号'  =>  'dhl_apply_line_number',
            '入金日'  =>  'payment_day',
            '売上番号'  =>  'sales_number',
            '売上請求先'  =>  'billing_address',
            '入金消込額'  =>  'dhl_deposit_application',
            '担当'  =>  'in_charge',
            '受注番号'  =>  'order_number',
            '受注先'  =>  'contractor',
            '売上日'  =>  'sales_date',
            '受注件名'  =>  'order_subject',
            '入金番号'  =>  'deposit_number',
            '入金行番号' => 'deposit_line_number',
            '入金方法' => 'payment_method',
            '売掛残高更新フラグ' => 'receivable_flag',
            '請求残高更新フラグ' => 'billing_flag',
            '前受区分' => 'advance_classification',
            '売済区分' => 'sold_category',
            '売済区分' => 'sold_category',
            '入金消込Ｔ登録年月日' => 'registration_date',
            '入金消込Ｔ登録時刻' => 'registration_time',
            '入金消込Ｔ更新者' => 'changer'
        ];
        if ($type) {
            return TableSetting::getHeaders($bango, $pageNo, $headers, $type);
        }
        return TableSetting::getHeaders($bango, $pageNo, $headers);
    }
    public static function validate($newRequest)
    {
        $reqToChange = ['payment_day_start', 'payment_day_end', 'disposal_day_start', 'disposal_day_end'];
        foreach ($newRequest as $key => $value) {
            if (in_array($key, $reqToChange)) {
                $newRequest[$key] = str_replace('/', '', $value);
            }
        }
        $rules = [];
        $rules['payment_day_start'] = ['required', 'max:8', new DateCheckGreaterThan($newRequest['payment_day_end'], '入金日')];
        $rules['payment_day_end'] = ['required', 'max:8', new CheckDateLessThan($newRequest['payment_day_start'], '入金日')];
        $rules['disposal_day_start'] = ['required', 'max:8', new DateCheckGreaterThan($newRequest['disposal_day_end'], '処理日')];
        $rules['disposal_day_end'] = ['required', 'max:8', new CheckDateLessThan($newRequest['disposal_day_start'], '処理日')];
        $messages = [];
        $messages['required'] = '【:attribute】必須項目に入力がありません。';
        $messages['max'] = '【:attribute】:max桁以下で入力してください。';
        $attributes = [
            'payment_day_start' => '入金日1',
            'payment_day_end' => '入金日2',
            'disposal_day_start' => '処理日1',
            'disposal_day_end' => '処理日2',

        ];
        return Validator::make($newRequest, $rules, $messages, $attributes);
    }
}
