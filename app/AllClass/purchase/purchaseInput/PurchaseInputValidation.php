<?php


namespace App\AllClass\purchase\purchaseInput;


use App\AllClass\specialCharValidation;
use App\AllClass\zenkaku;
use App\AllClass\ZenkakuNew;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\AllClass\purchase\hatchuNyuryoku\DateCheckLessThan;
use App\AllClass\purchase\hatchuNyuryoku\PurchaseEntry;
use App\AllClass\order\orderEntry\OrderEntry;

class PurchaseInputValidation
{
    public static function handle($request)
    {
        $processRequest = $request;
        $reqToChange = ['purchase_date', 'payment_date'];
        foreach ($processRequest as $key => $value) {
            if (in_array($key, $reqToChange)) {
                $processRequest[$key] = PurchaseEntry::stringDataConvertedToIntegerFormat($value);
            }
        }    

        $rules = [];
        $rules['order_category'] = ['nullable'];
        $rules['creation_category'] = ['required'];
        $rules['number_search'] = ['nullable', 'numeric', 'digits_between:0,10'];  
        $rules['supplier'] = ['required'];
        $rules['support_number_search']=['nullable', 'numeric', 'min:10','max:12'];
        $rules['purchase_date'] = ['required', 'digits_between:1,8'];
        $rules['payment_date'] = ['required', 'digits_between:1,8'];
        $rules['tantou'] = ['required'];
        // $rules['sold_to'] = ['required'];
        // $rules['end_customer'] = ['required'];       
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
            'order_category' => '仕入購入区分',
            'creation_category' => '作成区分',
            'number_search' => '番号検索',
            'order_number' => '受注番号',
            'supplier' => '仕入先',
            'purchase_date' => '仕入日',
            'tantou' => '担当',
            'payment_date' => '支払日'
        ];
        return Validator::make($processRequest, $rules, $message, $attributes);
    }
    public static function handleSubmit($request)
    {
        $processRequest = $request;
        // dd($request['accountingSubject']);
        $reqToChange = ['purchase_date', 'payment_date'];
        foreach ($processRequest as $key => $value) {
            if (in_array($key, $reqToChange)) {
                $processRequest[$key] = PurchaseEntry::stringDataConvertedToIntegerFormat($value);
            }
        }    
        $commaToIntegerChangeArray = ['productQuantity', 'productUnitPrice', 'productAmount', 'productTax'];
        foreach ($processRequest as $key => $value) {
            if (in_array($key, $commaToIntegerChangeArray)) {
                foreach ($value as $newKey => $val) {
                    $processRequest[$key][$newKey] = OrderEntry::stringDataConvertedToIntegerFormat($val, 'comma');
                }
            }
        }
        if (count($processRequest['line']) > 1) {
            $unsetReqKey = ['line'];
            $reqKeys = ['orderNumber', 'productNumber', 'productName', 'productQuantity', 'productUnitPrice', 'productAmount', 'productTax', 'taxation', 'accountingSubject', 'accountingItems', 'detailedRemarks'];
            foreach ($processRequest as $key => $value) {
                if (in_array($key, $unsetReqKey) && is_array($value)) {
                    foreach ($value as $newKey => $val) {
                        if ($key == 'line') {
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
        $rules['order_category'] = ['nullable'];
        $rules['creation_category'] = ['required'];
        $rules['number_search'] = ['nullable', 'numeric', 'digits_between:0,10'];  
        $rules['supplier'] = ['required'];
        $rules['support_number_search']=['nullable', 'numeric', 'min:10','max:12'];
        $rules['purchase_date'] = ['required', 'digits_between:1,8', new ReviewOrderBangoCheck()];
        $rules['payment_date'] = ['required', 'digits_between:1,8'];
        $rules['tantou'] = ['required'];
        $rules['delivery_note'] = ['nullable','max:20',new specialCharValidation()];
        // $rules['end_customer'] = ['required'];
        $rules['orderNumber.*'] = ['nullable','max:13', new specialCharValidation(),new OrderNumberCheck()];
        // $rules['orderNumber.*'] = ['required','max:13', new specialCharValidation()];
        $rules['productNumber.*'] = ['nullable', new specialCharValidation()];
        $rules['productName.*'] = ['required', new specialCharValidation()];
        $rules['productQuantity.*'] = ['required', new specialCharValidation()];
        $rules['productUnitPrice.*'] = ['required', new specialCharValidation()];
        $rules['productAmount.*'] = ['required', new specialCharValidation()];
        $rules['productTax.*'] = ['required', new specialCharValidation()];
        $rules['taxation.*'] = ['required', new specialCharValidation()];
        if ($request['inspector']){
            $rules['accountingSubject.*'] = ['required'];
            $rules['accountingItems.*'] = ['required'];
        }
        $rules['comments'] = ['nullable', 'text' => 'max:40', new specialCharValidation()];
        $rules['detailedRemarks.*'] = ['nullable', new specialCharValidation()];
        $rules['totalSales'] = ['numeric', 'min:-999999999', 'max:999999999'];
        $rules['salesTax'] = ['numeric', 'min:-999999999', 'max:999999999'];

        $message = [];
        $message['required'] = '【:attribute】必須項目に入力がありません。';
        // $message['number_search.required'] = '【:attribute】 オーダーを選択後、受注訂正してください。';
        $message['numeric'] = '【:attribute】半角数字以外は使用できません。';
        $message['digits_between'] = '【:attribute】:max桁以下で入力してください。';
        $message['max'] = '【:attribute】:max桁以下で入力してください。';
        $message['mimes'] = '【:attribute】pdf zip のみOK。';
        $message['lte'] = '【:attribute】日付の入力が適切ではありません。';
        $message['gte'] = '【:attribute】日付の入力が適切ではありません。';
        $message['totalSales.max'] = '【:attribute】入力数が最大長を超えています。';
        $message['salesTax.max'] = '【:attribute】入力数が最大長を超えています。';
        // $message['orderNumber.*.required'] = '発注番号行番号が未入力です。';

        $attributes = [
            'order_category' => '仕入購入区分',
            'creation_category' => '作成区分',
            'number_search' => '番号検索',
            'order_number' => '受注番号',
            'supplier' => '仕入先',
            'purchase_date' => '仕入日',
            'tantou' => '担当',
            'delivery_note' => '納品書番号',
            'payment_date' => '支払日',
            'productName.*' => '品名',
            'productQuantity.*' => '数量',
            'productUnitPrice.*' => '単価',
            'productAmount.*' => '金額',
            'productTax.*' => '消費税',
            'taxation.*' => '課税',
            'accountingSubject.*' => '会計科目',
            'accountingItems.*' => '会計科目内訳',
            'comments' => '伝票備考',
            'detailedRemarks.*' => '明細備考',
            'orderNumber.*' => '発注番号行番号',
            'productNumber.*' => '品番',
            'totalSales' => '合計',
            'salesTax' => '消費税'
        ];
        return Validator::make($processRequest, $rules, $message, $attributes);
    }
}
