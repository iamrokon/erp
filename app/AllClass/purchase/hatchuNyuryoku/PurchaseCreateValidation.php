<?php


namespace App\AllClass\purchase\hatchuNyuryoku;


use App\AllClass\specialCharValidation;
use App\AllClass\zenkaku;
use App\AllClass\ZenkakuNew;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\AllClass\order\orderEntry\OrderEntry;
use App\AllClass\purchase\hatchuNyuryoku\DateCheckLessThan;

class PurchaseCreateValidation
{
    public static function handle($request)
    {
        $processRequest = $request;
        $reqToChange = ['order_date', 'order_entry_date'];
        foreach ($processRequest as $key => $value) {
            if (in_array($key, $reqToChange)) {
                $processRequest[$key] = OrderEntry::stringDataConvertedToIntegerFormat($value);
            }
        }

        // $reqToChangeArray = ['hacchubi'];
        // foreach ($processRequest as $key => $value) {
        //     if (in_array($key, $reqToChangeArray)) {
        //         foreach ($value as $newKey => $val) {
        //             $processRequest[$key][$newKey] = OrderEntry::stringDataConvertedToIntegerFormat($val);
        //         }
        //     }
        // } 
        $commaToIntegerChangeArray = ['quantity', 'price', 'rate', 'partitionUnitPrice', 'orderAmount', 'syouhizei'];
        foreach ($processRequest as $key => $value) {
            if (in_array($key, $commaToIntegerChangeArray)) {
                foreach ($value as $newKey => $val) {
                    $processRequest[$key][$newKey] = OrderEntry::stringDataConvertedToIntegerFormat($val, 'comma');
                }
            }
        }
        if (count($processRequest['syouhincd']) > 1) {
            $unsetReqKey = ['syouhincd', 'deletedProduct'];
            $reqKeys = ['syouhincd', 'productName', 'quantity', 'price', 'rate', 'juchubangou', 'juchubangougyou', 'juchubangougyoueda','comment', 'syouhizei', 'orderAmount', 'partitionUnitPrice'];
            foreach ($processRequest as $key => $value) {
                if (in_array($key, $unsetReqKey) && is_array($value)) {
                    foreach ($value as $newKey => $val) {
                        if ($key == 'syouhincd') {
                            if (!$value[$newKey]) {
                                foreach ($reqKeys as $rkey) {
                                    unset($processRequest[$rkey][$newKey]);
                                }
                            }
                        } else if ($key == 'deletedProduct') {
                            if ($value[$newKey] == 2) {
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
        //$rules['order_number'] = [new CheckSameTimeRequest($request['ordertypebango2'],$request['order_number'])];
        $rules['creation_category'] = ['required'];
        $rules['number_search'] = ['nullable', 'numeric', 'digits_between:0,10'];
        if ($request['creation_category'] == '2') {
            // $rules['order_number'] = ['required', 'numeric', 'digits_between:0,13'];
            $rules['order_number'] =  [new CheckForOrderTypeBango2($request['ordertypebango2'])];
        }
        // else {
        //     $rules['order_number'] = ['nullable', 'numeric', 'digits_between:0,13'];
        // }
        if ($request['order_category'] == 'V440') {
            $rules['number_search'] = ['nullable', 'numeric', 'digits_between:0,10'];
            $rules['support_number_search']=['required', 'numeric', 'digits_between:0,13'];
        } else {
            $rules['number_search'] = ['required', 'numeric', 'digits_between:0,10'];
            $rules['support_number_search']=['nullable', 'numeric', 'digits_between:0,13'];
        }
        if ($request['creation_category'] == 1) {
            $rules['number_search'] = ['nullable', 'numeric', 'digits_between:0,10'];
        }
        
        $rules['supplier'] = ['required'];
        //rules not set サポート番号行番号
        
        if ($request['order_entry_date']) {
            $rules['order_date'] = ['required', 'digits_between:1,8', new DateCheckGreaterThan('order_entry_date')];
        }else {
            $rules['order_date'] = ['required', 'digits_between:1,8'];
        }
        $rules['tantou'] = ['required'];
        if ($request['order_category'] == 'V410') {
            $rules['sold_to'] = ['required'];
        }else{
            $rules['sold_to'] = ['nullable'];
        }
        // $rules['end_customer'] = ['required'];
        $rules['siiresakimitumori'] = ['nullable', new specialCharValidation()];
        $rules['hacchu_bikou1'] = ['nullable', 'text' => 'max:60', new specialCharValidation()];
        $rules['hacchu_bikou2'] = ['nullable', 'text' => 'max:60', new specialCharValidation()];
        $rules['hacchu_bikou3'] = ['nullable', 'text' => 'max:60', new specialCharValidation()];
        $rules['purchase_order'] = ["nullable", "mimes:zip,pdf"];
        
        $rules['syouhincd.*'] = ['required'];
        $rules['me_ka_hinban.*'] = ['nullable', 'numeric', 'min:-9999999999999', 'max:9999999999999'];
        $rules['productName.*'] = ['required', 'max:40', new ZenkakuNew(), new specialCharValidation()];
        //$rules['suu'] = ['required', 'max:5', new specialCharValidation(), new zenkaku()];
        $rules['quantity.*'] = ['required', 'max:5', new specialCharValidation()];
        $rules['price.*'] = ['required', 'max:8', new specialCharValidation()];
        $rules['rate.*'] = ['nullable', 'numeric','between:0,100', new specialCharValidation()];
        // $rules['price.*'] = ['required', 'numeric', 'min:-999999999', 'max:999999999'];
        // $rules['rate.*'] = ['required', 'numeric', 'min:-999999999', 'max:999999999'];
        $rules['partitionUnitPrice.*'] = ['nullable', 'max:8'];
        $rules['orderAmount.*'] = ['nullable', 'max:9'];
        $rules['syouhizei.*'] = ['nullable', 'max:9'];
        $rules['genchoujikan.*'] = ['nullable', new specialCharValidation()];
        $rules['deliveryDestination.*'] = ['required', 'max:11', new specialCharValidation()];
        $rules['juchubangou.*'] = ['nullable', 'max:10', new specialCharValidation()];
        $rules['juchubangougyou.*'] = ['nullable', 'max:3', new specialCharValidation()];
        $rules['juchubangougyoueda.*'] = ['nullable', 'max:3', new specialCharValidation()];
        $rules['siharaizeihasuukubun.*'] = ['nullable', new specialCharValidation()];
        $rules['comment.*'] = ['nullable', new specialCharValidation()];

        $message = [];
        $message['required'] = '【:attribute】必須項目に入力がありません。';
        // $message['number_search.required'] = '【:attribute】 オーダーを選択後、受注訂正してください。';
        $message['numeric'] = '【:attribute】半角数字以外は使用できません。';
        $message['digits_between'] = '【:attribute】:max桁以下で入力してください。';
        $message['max'] = '【:attribute】:max桁以下で入力してください。';
        $message['mimes'] = '【:attribute】pdf zip のみOK。';
        $message['lte'] = '【:attribute】日付の入力が適切ではありません。';
        $message['gte'] = '【:attribute】日付の入力が適切ではありません。';
        $message['rate.*.between'] = '【:attribute】0〜100の数字を入力してください。';
        $message['sales_amount_total.max'] = ' 販売金額計が桁あふれしています。';
        $message['sales_amount_total.min'] = ' 販売金額計が桁あふれしています。';
        $message['orderAmount.*.max'] = '【:attribute】入力数が最大長を超えています。';
        $message['partitionUnitPrice.*.max'] = '【:attribute】入力数が最大長を超えています。';
        $message['syouhizei.*.max'] = '【:attribute】入力数が最大長を超えています。';
        $message['me_ka_hinban.*.max'] = '【:attribute】:13桁以下で入力してください。';

        $attributes = [
            'order_category' => '受注区分',
            'creation_category' => '作成区分',
            'number_search' => '番号検索',
            'order_number' => '受注番号',
            'support_number_search' => 'サポート番号行番号',
            'supplier' => '仕入先',
            'order_date' => '発注日',
            'tantou' => '担当',
            'sold_to' => '受注先',
            'end_customer' => '最終顧客',
            'siiresakimitumori' => '仕入先見積番号',
            'hacchu_bikou1' => '発注備考1',
            'hacchu_bikou2' => '発注備考2',
            'hacchu_bikou3' => '発注備考3',
            'syouhincd.*' => '商品CD',
            'me_ka_hinban.*' => 'メーカー品番',
            'productName.*' => '品名',
            'quantity.*' => '数量',
            'price.*' => '単価',
            'rate.*' => '率',
            'partitionUnitPrice.*' => '仕切単価',
            'orderAmount.*' => '発注金額',
            'genchoujikan.*' => '現調時間',
            'deliveryDestination.*' => '納品先',
            'juchubangou.*' => '受注番号行番号',
            'juchubangougyou.*' => '受注番号行番号枝番',
            'juchubangougyoueda.*' => '納品先',
            'siharaizeihasuukubun.*' => '支払税端数区分',   
            'comment.*' => '明細備考',
            'syouhizei.*' => '消費税',
            'purchase_order'=> '仕入見積書PDFアップロード'
        ];
        if (!in_array($request['order_category'],['V410','V470','V460']) && ($request['creation_category'] == '2' || $request['creation_category'] == '3')) {
            return Validator::make($processRequest, [], $message, $attributes);
        }else{
            return Validator::make($processRequest, $rules, $message, $attributes);
        }
    }
}
