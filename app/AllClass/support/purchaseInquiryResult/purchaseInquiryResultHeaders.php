<?php

namespace App\AllClass\support\purchaseInquiryResult;

use App\AllClass\TableSetting;
use DB;
use App\tantousya;
use App\kengen;

Class purchaseInquiryResultHeaders
{
    public static $page_no = '10-02-2';

    public static function headers($bango,$type=null)
    {
        $headers = [
            '仕入伝票番号行番号' => 'purchase_slip_number',
            '発注番号行番号' => 'order_number',
            '仕入日付' => 'purchase_date',
            '仕入先' => 'supplier',
            '納品書番号' => 'delivery_note_number',
            '品名' => 'product_name',
            '数量' => 'purchase_inquiry_formatted_quantity',
            '単価' => 'purchase_inquiry_formatted_unit_price',
            '金額' => 'purchase_inquiry_formatted_amount'
        ];

        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);
    }
}