<?php

namespace App\AllClass;

use DB;

Class TableSettHeaderMsg {

    public static function msg($bango) {
        $headersMsg = [
            '登録年月日' => 'データを登録した年月日を表示します。',
            '登録時刻' => 'データを登録した時刻を表示します。',
            '更新年月日' => 'データを更新した年月日を表示します。',
            '更新時刻' => 'データを更新した時刻を表示します。',
            '更新時端末IP' => '',
            '更新者' => '最終更新者を表示します。',
        ];
        
        return $headersMsg;
    }

}
