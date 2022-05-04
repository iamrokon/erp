<?php

namespace App\AllClass\sales\accountList;

use App\AllClass\TableSetting;

Class AccountListHeaders 
{
    public static $page_no = '04-20';

    public static $base_headers = [
            '売上請求先CD' => 'sales_billing_cd',
            '売上請求先名' => 'sales_billing_name',
            '前月売掛残' => 'prev_receivable',
            '当月総売上額' => 'sales',
            '売上値引等' => 'discount',
            '当月消費税' => 'consumption_tax',
            '現金・振込' => 'cash',
            '手形' => 'bills',
            '他入金' => 'other_deposit',
            '当月売掛残' => 'rem_recievable',
            '総債権残高' => 'loan_balance',
            '与信残高' => 'cred_balance',
            '与信区分' => 'cred_class_final',

            '前月末残高' => 'balance_at_the_end_of_month_before',
            '当月売上額' => 'net_sales_curr_month',
            '当月返品額' => 'return_curr_month',
            '当月値引額' => 'discount_curr_month',
            '当月他売上額' => 'sales_curr_month_others',
            '当月消費税額' => 'tax_curr_month',
            '当月現金入金額' => 'cash_deposit_curr_month',
            '当月手形入金額' => 'bill_receipt_curr_month',
            '当月相殺額' => 'offset_amount_curr_month',
            '当月入金値引額' => 'curr_deposit_discount',
            '当月他入金額' => 'reposited_that_month',
            '当月末残高' => 'balance_at_the_end_of_month',
            '前月末手形残高' => 'balance_of_bill_before',
            '当月手形決済額' => 'bill_settlement_amount',
            '当月末手形残高' => 'balance_of_bill',
            '前月末前受残高' => 'balance_of_advance_before',
            '当月前受請求額' => 'invoice_amount_before',
            '当月前受消費税額' => 'consumption_tax_before',
            '当月前受現金入金額' => 'cash_deposit_before',
            '当月前受手形入金額' => 'receipt_amount_before_current',
            '当月前受相殺額' => 'offset_amount_before',
            '当月前受入金値引額' => 'deposit_discount_before',
            '当月前受他入金額' => 'receipt_amount_before',
            '当月末前受残高' => 'balance_of_receipt_before',
            // '総合計' => 'row_total',
        ];

    public static $excel_headers = [
            '売上請求先CD' => 'sales_billing_cd',
            '売上請求先名' => 'sales_billing_name',
            '前月売掛残' => 'prev_receivable_commafied',
            '当月総売上額' => 'sales_commafied',
            '売上値引等' => 'discount_commafied',
            '当月消費税' => 'consumption_tax_commafied',
            '現金・振込' => 'cash_commafied',
            '手形' => 'bills_commafied',
            '他入金' => 'other_deposit_commafied',
            '当月売掛残' => 'rem_recievable_commafied',
            '総債権残高' => 'loan_balance_commafied',
            '与信残高' => 'cred_balance',
            '与信区分' => 'cred_class_final',
            
            '前月末残高' => 'balance_at_the_end_of_month_before_commafied',
            '当月売上額' => 'net_sales_curr_month_commafied',
            '当月返品額' => 'return_curr_month_commafied',
            '当月値引額' => 'discount_curr_month_commafied',
            '当月他売上額' => 'sales_curr_month_others_commafied',
            '当月消費税額' => 'tax_curr_month_commafied',
            '当月現金入金額' => 'cash_deposit_curr_month_commafied',
            '当月手形入金額' => 'bill_receipt_curr_month_commafied',
            '当月手形入金額' => 'bill_receipt_curr_month_commafied',
            '当月相殺額' => 'offset_amount_curr_month_commafied',
            '当月入金値引額' => 'curr_deposit_discount_commafied',
            '当月他入金額' => 'reposited_that_month_commafied',
            '当月末残高' => 'balance_at_the_end_of_month_commafied',
            '前月末手形残高' => 'balance_of_bill_before_commafied',
            '当月手形決済額' => 'bill_settlement_amount_commafied',
            '当月末手形残高' => 'balance_of_bill_commafied',
            '前月末前受残高' => 'balance_of_advance_before_commafied',
            '当月前受請求額' => 'invoice_amount_before_commafied',
            '当月前受消費税額' => 'consumption_tax_before_commafied',
            '当月前受現金入金額' => 'cash_deposit_before_commafied',
            '当月前受手形入金額' => 'receipt_amount_before_current_commafied',
            '当月前受相殺額' => 'offset_amount_before_commafied',
            '当月前受入金値引額' => 'deposit_discount_before_commafied',
            '当月前受他入金額' => 'receipt_amount_before_commafied',
            '当月末前受残高' => 'balance_of_receipt_before_commafied',
            // '総合計' => 'row_total_commafied',
        ];        

    public static function get_headers($bango,$type=null)
    {
        $headers = static::$base_headers;

        $pageNo = static::$page_no;
        if($type)
        {
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);

    }
}
