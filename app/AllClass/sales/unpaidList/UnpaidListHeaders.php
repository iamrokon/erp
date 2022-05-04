<?php

namespace App\AllClass\sales\unpaidList;

use App\AllClass\TableSetting;
use DB;
use App\tantousya;
use App\kengen;

Class UnpaidListHeaders
{
    public static $page_no = '04-12';

    public static function headers($bango,$type=null)
    {
        $headers = [
            '売上番号	' => 'datachar10',
            '売上区分	' => 'datachar02_detail',
            '受注番号' => 'kokyakuorderbango',
            '受注先' => 'information1_detail',
            '受注件名' => 'juchukubun1_short',
            '最終顧客' => 'information3_detail',
            '担当' => 'user_name',
            '売上日' => 'v_intorder03',
            '入金予定日' => 'intorder05_input',
            '実入金日' => 'v_intorder05',
            '前受' => 'unsoutesuryou',
            '入金済' => 'req_dataint01',
            '売上金額' => 'unpaidlist_sales_amount',
            '入金額' => 'unpaidlist_sum_of_nyukingaku',
            '入金残' => 'unpaidlist_deposit_balance',
            '売上請求先' => 'information2_detail',
            '入金消込番号' => 'max_old_shinkurokokyakuorderbango',
            '入金消込行番号' => 'max_moneymax',
            '売掛残高更新フラグ' => 'req_soufusakiname',
            '請求残高更新フラグ' => 'req_soufusakiyubinbango',
        ];

        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);
    }
}
