<?php

namespace App\AllClass\other\lBook;

use App\AllClass\TableSetting;
use DB;
use App\tantousya;
use App\kengen;

Class lBookHeaders{
    public static $page_no = '11-01';

    public static function headers($bango,$type=null){
        $headers = [
            '書類番号' => 'datachar01',
            '受注先' => 'datachar02_detail',
            '売上請求先' => 'datachar03_detail',
            '最終顧客' => 'datachar04_detail',
            '登録日' => 'created_date',
            '文書種類' => 'datachar07_detail',
            '文書名' => 'datachar08',
            '担当' => 'datachar06_detail',
            '受注番号' => 'lbook_datachar05',
            '受注日' => 'intorder01_date',
            '受注件名' => 'juchukubun1',
            '保管ファイル' => 'datachar09',
            '共有レベル' => 'datachar10_detail',
        ];

        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);

    }
}
