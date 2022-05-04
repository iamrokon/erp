<?php

namespace App\AllClass\support\purchaseResultList;

use App\AllClass\TableSetting;
use DB;
use App\tantousya;
use App\kengen;

Class purchaseResultListHeaders
{
    public static $page_no = '10-02';

    public static function headers($bango,$type=null)
    {
        $headers = [
            'サポート番号行' => 'support_number',
            '受注先' => 'contractor',
            '最終顧客' => 'end_customer',
            '受注番号' => 'order_number',
            '売上日' => 'sales_date',
            '売' => 'sell',
            '外注予定' => 'formatted_schedule',
            '外注発注' => 'formatted_amount',
            '外注実績' => 'formatted_results',
            '完了指検' => 'inspection',
            '差異' => 'formatted_purchase_difference',
            '外注仕入完了日' => 'purchase_date',
            '外注仕入完了計算フラグ' => 'purchase_flag'
        ];

        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);
    }
}