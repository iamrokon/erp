<?php

namespace App\AllClass\purchase\paymentSchedule;

use App\AllClass\TableSetting;

class PaymentScheduleHeaders
{
    public static $page_no = '06-11';
    public static function headers($bango,$type = null)
    {
        $headers = [
            '支払方法' => 'payment_method',
            '金額計' => 'amount',
            '仕入先' => 'vendor',
            '当月残高' => 'current_month_balance',
            '支払日' => 'payment_date',
            '仕入支払方法1' => 'purchase_payment_method1',
            '仕入支払金額1' => 'purchase_payment_amount1',
            '仕入支払方法2' => 'purchase_payment_method2',
            '仕入支払金額2' => 'purchase_payment_amount2',
            '仕入支払方法3' => 'purchase_payment_method3',
            '仕入支払金額3' => 'purchase_payment_amount3',
            '購入支払方法1' => 'purchase_payment_method1_1',
            '購入支払金額1' => 'purchase_payment_amount1_1',
            '購入支払方法2' => 'purchase_payment_method2_1',
            '購入支払金額2' => 'purchase_payment_amount2_1',
            '購入支払方法3' => 'purchase_payment_method3_1',
            '購入支払金額3' => 'purchase_payment_amount3_1',
            '(差異)' => 'difference',
            '手形期日' => 'bill_due_date'
        ];
        $pageNo= static::$page_no;

        if(!empty($type['rd1'])){
            $pageNo=$pageNo."-0".$type['rd1'];

            return TableSetting::getHeaders($bango,$pageNo,$headers);
        }else{
            $pageNo=$pageNo."-01";
            return TableSetting::getHeaders($bango,$pageNo,$headers);
        }


    }
}
