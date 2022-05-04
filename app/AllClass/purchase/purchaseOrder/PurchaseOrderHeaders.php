<?php

namespace App\AllClass\purchase\purchaseOrder;

use App\AllClass\TableSetting;

class PurchaseOrderHeaders

{
    public static $page_no = '05-03';
    public static function headers($bango,$type = null)
    {
        $headers = [
        '発注番号' => 'order_number1',
        '発注訂正回数' => 'correction_orders',
        '受注番号' => 'order_number2',
        '発注日' => 'date',
        '受注先' => 'contractor',
        '仕入先' => 'supplier',
        '担当' => 'user_name',
        '✓' => 'check_tik',
        /*'(チェックボックス)' => '',*/
        '検印' => 'seal',
        '発注書書類保管番号' => 'storage_number',
        /*'発注書PDF' => 'purchase_order_pdf',*/
        'メール済' => 'emailed',
        '仕入先見積番号' => 'supplier_quotation_number',
        '発注総額' => 'total_order_amount',
        '発注消費税総額' => 'purchase_consumption_tax',
        '最終顧客' => 'end_customer',
        '発注履歴作成フラグ' => 'order_history_creation_flag',
        '検印者' => 'checker'
    ];
        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);


    }
}
