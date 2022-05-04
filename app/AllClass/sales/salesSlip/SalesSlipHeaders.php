<?php

namespace App\AllClass\sales\salesSlip;

use App\AllClass\TableSetting;
use DB;
use App\tantousya;
use App\kengen;

Class SalesSlipHeaders
{
    public static $page_no = '04-03';

    public static function headers($bango,$type=null)
    {
        $headers = [
            '受注番号' => 'kokyakuorderbango',
            '受注件名' => 'juchukubun1',
            '受注先' => 'information1_detail',
            '売上請求先' => 'information2_detail',
            '最終顧客' => 'information3_detail',
            '担当' => 'user_name',
            '売上日' => 'intorder03',
            '受注金額' => 'formatted_money10',
            '売上伝票PDF' => 'text4',
            'tick_mark' => 'checkbox',
            '売上番号' => 'sales_slip_juchukubun2',
            '発行者' => 'hktsyukko_datachar05_detail',
            '郵送' => 'information2_mail_jyushin_mb',
            '印刷済' => 'hktsyukko_datachar10',
            'メール' => 'information2_mail_nouhin',
            'メール済' => 'hktsyukko_datachar09',
            '請求書送付先CD' => 'information6',
            '請求書送付先' => 'information6_detail',
        ];

        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);


    }
}
