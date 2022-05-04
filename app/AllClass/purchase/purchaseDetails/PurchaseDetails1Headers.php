<?php

namespace App\AllClass\purchase\purchaseDetails;
use App\AllClass\TableSetting;

class PurchaseDetails1Headers
{
    public static $page_no = '06-23-1';
    public static function headers($bango,$type = null)
    {
        $headers = [
            '発注予定日' => 'order_date',
            '個別納期' => 'delivery_date',
            '仕入先' => 'vendor',
            '品名' => 'name',
            '数量' => 'purchase_details1_quantity',
            '単価' => 'purchase_details1_unit_price',
            '金額' => 'purchase_details1_amount',
            '発注作成' => 'create_order',
            '受注番号行番号枝番' => 'order_line_branch_no'
        ];
        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);


    }
}
