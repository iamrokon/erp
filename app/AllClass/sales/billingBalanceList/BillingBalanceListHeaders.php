<?php

namespace App\AllClass\sales\billingBalanceList;

use App\AllClass\TableSetting;
use DB;
use App\tantousya;
use App\kengen;

Class billingBalanceListHeaders
{
    public static $page_no = '04-06';

    public static function headers($bango,$type=null)
    {
        $headers = [
            '売上請求先CD' => 'datatxt201',
            '売上請求先' => 'formatted_data202',
            '前回請求額' => 'formatted_data203',
            '現金入金額' => 'formatted_data204',
            '手形入金' => 'formatted_data205',
            '今回値引他' => 'formatted_data206',
            '今回繰越額' => 'formatted_data207',
            '今回売上額' => 'formatted_data208',
            '今回消費税' => 'formatted_data209',
            '今回請求額' => 'formatted_data210',
            '即時請求額' => 'formatted_data211',
            '即時請求税' => 'formatted_data212',
            '請求書PDF' => 'data251',
            '前受前回請求額' => 'formatted_data252',
            '前受現金入金額' => 'formatted_data253',
            '前受手形入金' => 'formatted_data254',
            '前受今回値引他' => 'formatted_data255',
            '前受今回繰越額' => 'formatted_data256',         
            '前受今回売上額' => 'formatted_data257',
            '前受今回消費税' => 'formatted_data258',
            '前受即時請求額' => 'formatted_data259',
            '前受即時請求税' => 'formatted_data260',
            '登録年月日' => 'formatted_data261',
            '登録時刻' => 'formatted_data262',
            '更新年月日' => 'formatted_data263',
            '更新時刻' => 'formatted_data264',
            '更新者' => 'formatted_data265', 
    ];

        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);



    }
}
