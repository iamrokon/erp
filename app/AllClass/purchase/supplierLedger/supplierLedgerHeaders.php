<?php

namespace App\AllClass\purchase\supplierLedger;

use App\AllClass\TableSetting;
use DB;
use App\tantousya;
use App\kengen;

Class SupplierLedgerHeaders
{
    public static $page_no = '06-07';

    public static function headers($bango,$type=null)
    {
        $headers = [
            '日付' => 'ledger_date',
            '区分' => 'classification',
            '伝票番号' => 'slip_number',
            '行' => 'line_number',
            '品名・備考' => 'product_name',
            '数' => 'formatted_ledger_number',
            '単価/期日' => 'formatted_ledger_unit_price',
            '金額' => 'formatted_ledger_amount',
            '支払額' => 'formatted_ledger_payment_amount',
            '買掛残高' => 'formatted_ledger_accounts_payable',
            '受注番号' => 'order_number',
            '受注先' => 'contractor',
            '件名' => 'ledger_subject'
        ];

        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);
    }
}