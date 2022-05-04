<?php

namespace App\AllClass\purchase\inventoryList;

use App\AllClass\TableSetting;
use DB;
use App\tantousya;
use App\kengen;

Class InventoryListHeaders
{
    public static $page_no = '06-08';

    public static function headers($bango,$type=null)
    {
        $headers = [
            '部' => 'department',
            'グループ' => 'grouped_1',
            '仕入日' => 'purchase_date',
            '受注先' => 'contractor',
            '商品CD' => 'product_cd',
            '商品名' => 'product_name',
            '仕入金額' => 'formatted_inventory_purchase_amount',
            '売上予定日' => 'sales_date',
            '受注番号' => 'order_number',
            '受注区分' => 'order_classification_1',
            '発注区分' => 'order_classification_2',
            '仕入担当者' => 'purchase_person',
            '仕入番号' => 'purchase_number',
            '仕入行番号' => 'purchase_line_number',
            '仕入数量' => 'formatted_inventory_purchase_quantity',
            '仕入単価' => 'formatted_inventory_purchase_unit_price',
            '仕入先名' => 'supplier_name',
            '事業部' => 'division',
            '発注番号' => 'order_number_1',
            '発注行番号' => 'order_line_number',
            '会計科目' => 'accounting_subject',
            '会計内訳' => 'accounting_item',
            '支払課税区分' => 'payment_tax_classification',
            '仕入明細消費税額' => 'formatted_inventory_tax_amount',
            '明細備考' => 'detailed_remarks',
            '発注金額分類' => 'order_amount_classification',
            '仕入購入区分' => 'purchase_category'
        ];

        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);
    }
}