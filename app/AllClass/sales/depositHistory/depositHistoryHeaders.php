<?php

namespace App\AllClass\sales\depositHistory;

use App\AllClass\TableSetting;
use DB;
use App\tantousya;
use App\kengen;

class depositHistoryHeaders
{
    public static $page_no = '04-11';

    public static function headers($bango, $type = null)
    {
        $headers = [
            '入金日'  =>  'torikomidate',
            '入金番号'  =>  'deposit_history_shinkurokokyakuname',
            '行'  =>  'deposit_history_shinkurokokyakugroup',
            '訂正回数'  =>  'shinkurokokyakuorderbango',
            '入金方法'  =>  'soufusakiname_val',
            '売上請求先'  =>  'information1_detail_show',
            '入金額'  =>  'deposit_history_nyukingaku',
            '手形決済日'  =>  'chumondate',
            '入金銀行'  =>  'soufusaki_val',
            '入金支店'  =>  'unsoumei_val',
            '備考'  =>  'toiawasebango',
            '入金会計データ作成フラグ'  =>  'tsuchimail',
            '入金消込完了フラグ'  =>  'rendoumail',
            '入金T登録年月日' => 'registration_date',
            '入金T登録時刻' => 'registration_time',
            '入金T更新年月日' => 'update_date',
            '入金T更新時刻' => 'update_time',
            '入金T更新者' => 'changer',
            '入金T訂正回数' => 'num_of_cor',
            '入金F登録年月日' => 'registration_date_2',
            '入金F登録時刻' => 'registration_time_2',
            '入金F更新年月日' => 'update_date_2',
            '入金F更新時刻' => 'update_time_2',
            '入金F更新者' => 'changer_2'
        ];

        $pageNo = static::$page_no;
        if ($type) {
            return TableSetting::getHeaders($bango, $pageNo, $headers, $type);
        }
        return TableSetting::getHeaders($bango, $pageNo, $headers);
    }
}
