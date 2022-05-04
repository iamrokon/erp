<?php

namespace App\AllClass\purchase\purchaseLedger;

use App\AllClass\TableSetting;
use DB;
use App\tantousya;
use App\kengen;

Class PurchaseLedgerHeaders
{
    public static $page_no = '06-15';

    public static function headers($bango,$type=null)
    {
        $headers = [
            '日付' => 'touchakudate',
            '区分' => 'toiawasebango',
            '伝票番号' => 'syouhinid',
            '行' => 'syouhinsyu',
            '品名・備考' => 'datachar08',
            '数' => 'formatted_purchase_ledger_nyukosu',
            '単価/期日' => 'formatted_purchase_ledger_kingaku',
            '金額' => 'formatted_purchase_ledger_syouhizeiritu',
            '支払額' => 'formatted_purchase_ledger_payment_amount',
            '買掛残高' => 'formatted_purchase_ledger_accounts_payable',
            '会計科目CD' => 'barcode',
            '会計内訳CD' => 'codename',
            '明細備考' => 'datachar11',
        ];

        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);
    }
}
