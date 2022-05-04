<?php


namespace App\AllClass\purchase\paymentInput;

use \Carbon\Carbon;
use App\AllClass\specialCharValidation;
use App\AllClass\zenkaku;
use App\AllClass\ZenkakuNew;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\AllClass\purchase\hatchuNyuryoku\DateCheckLessThan;
use App\AllClass\purchase\hatchuNyuryoku\PurchaseEntry;
use App\AllClass\order\orderEntry\OrderEntry;
use App\AllClass\purchase\paymentInput\PaymentDateCheck;
use App\AllClass\purchase\paymentInput\PaymentSlipDateCheck;
use App\AllClass\purchase\paymentInput\CheckForPaymentMethodValue;
use App\AllClass\purchase\paymentInput\CheckPaymentDate;

class PaymentInputValidation
{
    public static function handle($request)
    {
        $processRequest = $request;
        $reqToChange = ['slip_date', 'payment_date'];
        foreach ($processRequest as $key => $value) {
            if (in_array($key, $reqToChange)) {
                $processRequest[$key] = PurchaseEntry::stringDataConvertedToIntegerFormat($value);
            }
        } 
        $reqToChangeArray = ['due_date'];
        foreach ($processRequest as $key => $value) {
            if (in_array($key, $reqToChangeArray)) {
                foreach ($value as $newKey => $val) {
                    $processRequest[$key][$newKey] = OrderEntry::stringDataConvertedToIntegerFormat($val);
                }
            }
        }
        $commaToIntegerChangeArray = ['payment_amount'];   
        foreach ($processRequest as $key => $value) {
            if (in_array($key, $commaToIntegerChangeArray)) {
                foreach ($value as $newKey => $val) {
                    $processRequest[$key][$newKey] = OrderEntry::stringDataConvertedToIntegerFormat($val, 'comma');
                }
            }
        }
        $rules = [];
        $rules['payment_classification'] = ['required'];
        $rules['supplier'] = ['required'];
        $rules['payment_date'] = ['required', 'digits_between:1,8', new ReviewOrderBangoCheck(), new CheckPaymentDate()];
        if(request('payment_date')){
            $rules['slip_date'] = ['required', 'digits_between:1,8', new PaymentDateCheck(), new PaymentSlipDateCheck('payment_date')];
        }else{
            $rules['slip_date'] = ['required', 'digits_between:1,8', new PaymentDateCheck()];
        }
        $rules['payment_method.*'] = ['required'];
        $rules['payment_amount.*'] = ['nullable', new specialCharValidation()];
        $rules['remarks.*'] = ['nullable', new specialCharValidation()];
        $rules['due_date.*'] = [new CheckForPaymentMethodValue()];
        // if(in_array("D903", $request['payment_method'])){
        //     $rules['due_date.*'] = ['required'];
        // }
        // $date = static::getCurrentTime(-10);
        // dd($date); 
        $message = [];
        $message['required'] = '【:attribute】必須項目に入力がありません。';
        // $message['number_search.required'] = '【:attribute】 オーダーを選択後、受注訂正してください。';
        $message['numeric'] = '【:attribute】半角数字以外は使用できません。';
        $message['digits_between'] = '【:attribute】:max桁以下で入力してください。';
        $message['max'] = '【:attribute】:max桁以下で入力してください。';
        $message['mimes'] = '【:attribute】pdf zip のみOK。';
        $message['lte'] = '【:attribute】日付の入力が適切ではありません。';
        $message['gte'] = '【:attribute】日付の入力が適切ではありません。';

        $attributes = [
            'payment_classification' => '買掛区分',
            'supplier' => '仕入先',
            'slip_date' => '会計伝票日',
            'payment_date' => '支払日',
            'payment_method.*' => '支払方法',
            'payment_amount.*' => '支払金額',
            'due_date.*' => '手形期日',
            'remarks.*' => '備考'
        ];
        return Validator::make($processRequest, $rules, $message, $attributes);
    }
    // public static function getCurrentTime($days)
    // {
    //     $mytime = Carbon::today()->addDays($days)->setTimezone("Asia/Tokyo")->format('Y-m-d');
    //     $mytime = str_replace(":", "", $mytime);
    //     $mytime = str_replace("-", "", $mytime);
    //     return str_replace(" ", "", $mytime);
    // }
}