<?php

namespace App\AllClass\purchase\purchaseRecordList;

use App\AllClass\TableSetting;
use DB;
use App\tantousya;
use App\kengen;

Class purchaseRecordListHeaders
{
    public static $page_no = '06-18';

    public static function headers($bango,$type=null)
    {
        $headers = [
        '受注番号' => 'orderuserbango',
        '受注先' => 'information1_detail',
        '最終顧客' => 'information3_detail',
        '受注金額' => 'formatted_money10',
        '売上日' => 'formatted_search_intorder03',
        '売' => 'datachar04',
        '仕入予定' => 'formatted_sum_of_syukkasu_dataint08',
        '仕入実績' => 'formatted_sum_of_syouhizeiritu',
        '内作予定' => 'formatted_scheduled_to_work',
        '内作実績' => 'formatted_scheduled_work_result',
        '実績合計' => 'formatted_purchase_sum',
        '仕入差額' => 'formatted_purchase_difference',
        '完了指検' => 'completion_finger',
        '仕入完了日' => 'datachar14',
        '仕入完了計算フラグ' => 'datachar16'
        ];

        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);
    }
}
