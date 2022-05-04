<?php

namespace App\AllClass\purchase\purchaseSlip;
use App\AllClass\TableSetting;
class PurchaseSlipHeaders
{
    public static $page_no = '06-29';
    public static function headers($bango,$type = null)
    {
        $headers = [
            '行' => 'line_number',
            '表示順' => 'display_order',
            'グループ' => 'group',
            '受注先' => 'order_to',
            '仕入担当' => 'incharge_purchasing',
            '商品' => 'product_cd',
            '仕入数量' => 'purchase_quantity',
            '仕入単価' => 'purchase_unit_price',
            '仕入明細金額' => 'purchase_line_amount',
            '仕入明細消費額' => 'purchase_consumption_amount',
            '会計科目' => 'accounting_subject',
            '会計内訳' => 'accounting_breakdown',
            '明細備考' => 'remarks',
            '保留' => 'retain',
            '最終作成日時' => 'last_datetime',
        ];
        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);


    }
}
