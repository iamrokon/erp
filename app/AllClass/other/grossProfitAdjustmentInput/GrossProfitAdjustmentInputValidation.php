<?php


namespace App\AllClass\other\grossProfitAdjustmentInput;


use App\AllClass\specialCharValidation;
use App\AllClass\zenkaku;
use App\AllClass\ZenkakuNew;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\AllClass\purchase\hatchuNyuryoku\DateCheckLessThan;
use App\AllClass\purchase\hatchuNyuryoku\PurchaseEntry;
// use App\AllClass\order\orderEntry\OrderEntry;

class GrossProfitAdjustmentInputValidation
{
    public static function handle($request)
    {
        $processRequest = $request;
        $reqToChange = ['order_date'];
        foreach ($processRequest as $key => $value) {
            if (in_array($key, $reqToChange)) {
                $processRequest[$key] = PurchaseEntry::stringDataConvertedToIntegerFormat($value);
            }
        }    
        $commaToIntegerChangeArray = ['productQuantity', 'productUnitPrice', 'productAmount'];
        foreach ($processRequest as $key => $value) {
            if (in_array($key, $commaToIntegerChangeArray)) {
                foreach ($value as $newKey => $val) {
                    $processRequest[$key][$newKey] = PurchaseEntry::stringDataConvertedToIntegerFormat($val, 'comma');
                }
            }
        }
        if (count($processRequest['productNumber']) > 1) {
            $unsetReqKey = ['productNumber'];
            $reqKeys = ['productNumber', 'productName', 'productQuantity', 'productUnitPrice', 'productAmount', 'orderAmountClassification', 'responsiblePerson'];
            foreach ($processRequest as $key => $value) {
                if (in_array($key, $unsetReqKey) && is_array($value)) {
                    foreach ($value as $newKey => $val) {
                        if ($key == 'orderNumber') {
                            if (!$value[$newKey]) {
                                foreach ($reqKeys as $rkey) {
                                    unset($processRequest[$rkey][$newKey]);
                                }
                            }
                        }
                    }
                }
            }
        }
        $rules = [];
        $rules['order_category'] = ['required'];
        $rules['order_number'] = ['nullable', 'numeric', 'digits_between:0,10'];  
        $rules['order_date'] = ['required', 'digits_between:1,8',new CheckDate($request['order_date'])];
        $rules['employee_cd'] = ['required'];
        if(request('order_number')){
            $rules['order_amount'] = ['nullable',new OrderAmountChecker()];
        }
        $rules['productNumber.*'] = ['required', new specialCharValidation()];
        $rules['productName.*'] = ['nullable', new specialCharValidation()];
        $rules['productQuantity.*'] = ['required', new specialCharValidation()];
        $rules['productUnitPrice.*'] = ['required', new specialCharValidation()];
        $rules['productAmount.*'] = ['required', new specialCharValidation()];
        $rules['orderAmountClassification.*'] = ['required', new specialCharValidation()];
        $rules['responsiblePerson.*'] = ['required', new specialCharValidation()];
        $rules['houseRemarks'] = ['nullable', 'text' => 'max:40', new specialCharValidation()];
        $rules['voucherRemarks'] = ['nullable', 'text' => 'max:40', new specialCharValidation()];
        // $rules['totalSales'] = ['numeric', 'min:-999999999', 'max:999999999'];
        // $rules['salesTax'] = ['numeric', 'min:-999999999', 'max:999999999'];

        $message = [];
        $message['required'] = '???:attribute?????????????????????????????????????????????';
        $message['numeric'] = '???:attribute????????????????????????????????????????????????';
        $message['digits_between'] = '???:attribute???:max???????????????????????????????????????';
        $message['max'] = '???:attribute???:max???????????????????????????????????????';
        $message['mimes'] = '???:attribute???pdf zip ??????OK???';
        $message['lte'] = '???:attribute???????????????????????????????????????????????????';
        $message['gte'] = '???:attribute???????????????????????????????????????????????????';
        // $message['totalSales.max'] = '???:attribute????????????????????????????????????????????????';
        // $message['salesTax.max'] = '???:attribute????????????????????????????????????????????????';

        $attributes = [
            'order_category' => '??????????????????',
            'order_number' => '????????????',
            'employee_cd' => '??????',
            'order_date' => '?????????',
            'productNumber.*' => '??????CD',
            'productName.*' => '?????????',
            'productQuantity.*' => '??????',
            'productUnitPrice.*' => '??????',
            'productAmount.*' => '??????',
            'orderAmountClassification.*' => '??????????????????',
            'responsiblePerson.*' => '??????',
            'houseRemarks' => '	????????????',
            'voucherRemarks.*' => '????????????'
        ];
        return Validator::make($processRequest, $rules, $message, $attributes);
    }
}
