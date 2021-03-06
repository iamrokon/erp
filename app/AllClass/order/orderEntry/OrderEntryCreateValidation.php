<?php


namespace App\AllClass\order\orderEntry;


use App\AllClass\specialCharValidation;
use App\AllClass\zenkaku;
use App\AllClass\AlphanumericKatakanaSymbolValidation;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\AllClass\order\orderEntry\NumberValidation;


class OrderEntryCreateValidation
{
    public static function handle($request)
    {
        $processRequest = $request;
        $reqToChange = ['order_date', 'delivery_date', 'inspection_date', 'sales_date', 'payment_date'];
        foreach ($processRequest as $key => $value) {
            if (in_array($key, $reqToChange)) {
                $processRequest[$key] = OrderEntry::stringDataConvertedToIntegerFormat($value);
            }
        }

        $reqToChangeArray = ['orderDate', 'individualDeliveryDate'];
        foreach ($processRequest as $key => $value) {
            if (in_array($key, $reqToChangeArray)) {
                foreach ($value as $newKey => $val) {
                    $processRequest[$key][$newKey] = OrderEntry::stringDataConvertedToIntegerFormat($val);
                }
            }
        }
        $commaToIntegerChangeArray = ['quantity', 'unitSellingPrice', 'se', 'institute', 'ship', 'purchase'];
        foreach ($processRequest as $key => $value) {
            if (in_array($key, $commaToIntegerChangeArray)) {
                foreach ($value as $newKey => $val) {
                    $processRequest[$key][$newKey] = OrderEntry::stringDataConvertedToIntegerFormat($val, 'comma');
                }
            }
        }
        if (count($processRequest['productCd']) > 1) {
            $unsetReqKey = ['productCd', 'deletedProduct'];
            $reqKeys = ['productCd', 'productName', 'orderDate', 'individualDeliveryDate', 'deliveryDestination', 'unit', 'quantity', 'unitSellingPrice', 'se', 'institute', 'ship', 'purchase', 'sales', 'se2', 'productSubCd', 'shippingInstruction', 'maintenance', 'supplier', 'manufacturePartNumber', 'manufactureProductName', 'issueNote', 'deliveryMethod', 'continutionCategory', 'newVup', 'vupCategory', 'statementRemarks', 'line', 'branch', 'serial', 'productSubName', 'price', 'grossProfit', 'setcode', 'percentage', 'deletedProduct'];
            foreach ($processRequest as $key => $value) {
                if (in_array($key, $unsetReqKey) && is_array($value)) {
                    foreach ($value as $newKey => $val) {
                        if ($key == 'productCd') {
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
            $rules['order_number'] = ['required', 'numeric', 'digits_between:0,10', new CheckSameTimeRequest($request['ordertypebango2'], $request['order_number'])];
            $rules['ordertypebango2'] =  [new CheckForOrderTypeBango2($request['ordertypebango2'])];
        } else {
            $rules['order_number'] = ['nullable', 'numeric', 'digits_between:0,10', new CheckSameTimeRequest($request['ordertypebango2'], $request['order_number'])];
        }

        $rules['sold_to'] = ['required'];
        $rules['sales_billing_destination'] = ['required'];
        $rules['end_customer'] = ['required'];
        $rules['bill_to'] = ['required'];
        $rules['order_date'] = ['required', 'digits_between:1,8', new DateCheckLessThan('sales_date'), new DateCheckLessThan('payment_date')];
        $rules['delivery_date'] = ['required', 'digits_between:1,8'];
        $rules['inspection_date'] = ['required', 'digits_between:1,8'];
        $rules['sales_date'] = ['required', 'digits_between:1,8', new DateCheckGreaterThan('order_date')];
        $rules['payment_date'] = ['required', 'digits_between:1,8', new DateCheckGreaterThan('order_date'), new DateCheckGreaterThan('sales_date')];
        $rules['order_subject'] = ['required', 'max:40', new specialCharValidation(), new zenkaku()];
        $rules['voucher_remarks'] = ['nullable', 'max:40', new specialCharValidation()];
        $rules['in_house_remarks'] = ['nullable', 'max:40', new specialCharValidation()];
        $rules['purchase_order'] = ["nullable", "mimes:zip,pdf"];
        $rules['customer_order_number'] = ['nullable', 'max:20', new specialCharValidation(), new zenkaku()];
        $rules['sales_amount_total'] = ['numeric', 'min:-999999999', 'max:999999999'];
        $rules['gross_profit_margin'] = ['numeric'];
        $rules['productCd.*'] = ['required', new CheckHasBumon()];
        $rules['productName.*'] = ['nullable', new specialCharValidation(), 'max:40'];
        $rules['orderDate.*'] = ['required', 'digits_between:1,8', new DateCheckLessThan('individualDeliveryDate')];
        $rules['individualDeliveryDate.*'] = ['required', 'digits_between:1,8', new DateCheckGreaterThan('orderDate')];
        $rules['deliveryDestination.*'] = ['required'];
        $rules['unit.*'] = ['nullable', 'max:2', new specialCharValidation(), new zenkaku()];
        $rules['quantity.*'] = ['required', 'numeric', 'min:-999999999', 'max:999999999'];
        $rules['unitSellingPrice.*'] = ['required', 'numeric', 'min:-999999999', 'max:999999999'];
        if ($request['creation_category'] == '1' && $request['order_category'] == 'U150') {
            //$rules['se.*'] = ['nullable', 'numeric', 'min:-999999999', 'max:999999999'];
            //$rules['institute.*'] = ['nullable', 'numeric', 'min:-999999999', 'max:999999999'];
            //$rules['ship.*'] = ['nullable', 'numeric', 'min:-999999999', 'max:999999999'];
            //$rules['purchase.*'] = ['nullable', 'numeric', 'min:-999999999', 'max:999999999'];
            
            $rules['se.*'] = ['nullable', 'numeric', new NumberValidation()];
            $rules['institute.*'] = ['nullable', 'numeric', new NumberValidation()];
            $rules['ship.*'] = ['nullable', 'numeric', new NumberValidation()];
            $rules['purchase.*'] = ['nullable', 'numeric', new NumberValidation()];

        } else {

            $rules['se.*'] = ['nullable', 'numeric', new NumberValidation()];
            $rules['institute.*'] = ['nullable', 'numeric', new NumberValidation()];
            $rules['ship.*'] = ['nullable', 'numeric', new NumberValidation()];
            $rules['purchase.*'] = ['nullable', 'numeric', new NumberValidation()];
            
            //$rules['se.*'] = ['nullable', 'numeric', 'min:-999999999', 'max:999999999'];
            //$rules['institute.*'] = ['nullable', 'numeric', 'min:-999999999', 'max:999999999'];
            //$rules['ship.*'] = ['nullable', 'numeric', 'min:-999999999', 'max:999999999'];
            //$rules['purchase.*'] = ['nullable', 'numeric', 'min:-999999999', 'max:999999999'];

        }
        $rules['sales.*'] = ['nullable', 'numeric', 'digits_between:0,4'];
        $rules['se2.*'] = [new FieldRequiredWhenGreaterThanZero('se')];
        $rules['manufacturePartNumber.*'] = ['nullable', 'max:13', new specialCharValidation(), new AlphanumericKatakanaSymbolValidation()];
        $rules['manufactureProductName.*'] = ['nullable', 'max:40', new specialCharValidation(), new zenkaku()];
        $rules['line.*'] = [new CheckForNullDelivery()];
        $message = [];
        $message['required'] = '???:attribute?????????????????????????????????????????????';
        $message['number_search.required'] = '???:attribute??? ????????????????????????????????????????????????????????????';
        $message['numeric'] = '???:attribute????????????????????????????????????????????????';
        $message['digits_between'] = '???:attribute???:max???????????????????????????????????????';
        $message['max'] = '???:attribute???:max???????????????????????????????????????';
        $message['mimes'] = '???:attribute???pdf zip ??????OK???';
        $message['lte'] = '???:attribute???????????????????????????????????????????????????';
        $message['gte'] = '???:attribute???????????????????????????????????????????????????';
        $message['sales_amount_total.max'] = ' ????????????????????????????????????????????????';
        $message['sales_amount_total.min'] = ' ????????????????????????????????????????????????';

        $attributes = [
            'order_category' => '????????????',
            'creation_category' => '????????????',
            'number_search' => '????????????',
            'order_number' => '????????????',
            'sold_to' => '?????????',
            'sales_billing_destination' => '???????????????',
            'end_customer' => '????????????',
            'bill_to' => '??????????????????',
            'order_date' => '?????????',
            'delivery_date' => '??????',
            'inspection_date' => '?????????',
            'sales_date' => '?????????',
            'payment_date' => '?????????',
            'order_subject' => '????????????',
            'voucher_remarks' => '????????????',
            'in_house_remarks' => '????????????',
            'purchase_order' => '?????????',
            'customer_order_number' => '????????????',
            'sales_amount_total' => '???????????????',
            'gross_profit_margin' => '???????????????',
            'productCd.*' => '??????CD',
            'productName.*' => '?????????',
            'orderDate.*' => '?????????',
            'individualDeliveryDate.*' => '????????????',
            'deliveryDestination.*' => '?????????',
            'unit.*' => '??? ???',
            'quantity.*' => '??????',
            'unitSellingPrice.*' => '????????????',
            'se.*' => 'SE@',
            'institute.*' => '?????????@',
            'ship.*' => '??????C@',
            'purchase.*' => '??????@',
            'sales.*' => '??? ???',
            'se2.*' => 'S E',
            'manufacturePartNumber.*' => '??????????????????',
            'manufactureProductName.*' => '??????????????????',

        ];
        return Validator::make($processRequest, $rules, $message, $attributes);
    }
}
