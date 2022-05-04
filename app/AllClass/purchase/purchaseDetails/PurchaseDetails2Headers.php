<?php

namespace App\AllClass\purchase\purchaseDetails;
use App\AllClass\TableSetting;

class PurchaseDetails2Headers
{
    public static $page_no = '06-23-2';
    public static function headers($bango,$type = null)
    {
        $headers = [
            '仕入番号行番号' => 'line_no',
            '仕入日' => 'purchase_date',
            '仕入先' => 'vendor2',
            '納品書番号' => 'invoice_no',
            '品名' => 'name2',
            '数量' => 'purchase_details2_quantity2',
            '単価' => 'purchase_details2_unit_price2',
            '金額' => 'purchase_details2_amount2',
            '発注番号行番号' => 'order_line_no',
            '発注金額分類' => 'classification'
        ];
        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);


    }
}
