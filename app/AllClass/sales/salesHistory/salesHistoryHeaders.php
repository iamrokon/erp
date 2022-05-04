<?php

namespace App\AllClass\sales\salesHistory;

use App\AllClass\TableSetting;
use DB;
use App\tantousya;
use App\kengen;

Class salesHistoryHeaders
{
    public static $page_no = '04-04';

    public static function headers($bango,$type=null)
    {
        $headers = [
            '売上日'  =>  'intorder03',
            '売上番号'  =>  'sales_history_juchukubun2',
            '売上区分'  =>  'text1_val',
            '受注番号'  =>  'kokyakuorderbango',
            '担当'  =>  'user_name',
            '受注先'  =>  'information1_detail_show',
            '受注件名'  =>  'juchukubun1',
            '入金日'  =>  'intorder05',
            '売上金額'  =>  'numeric3',
            '粗利'  =>  'moneymax',
            '売上請求先'  =>  'information2_detail_show',
            '入金完了フラグ'  =>  'dataint01_val',
            '請求書発行フラグ'  =>  'dataint02_val',
            '売上会計データ作成フラグ'  =>  'dataint03_val',
            '売掛残高更新フェーズ'  =>  'dataint04_val',
            '売上履歴作成フラグ'  =>  'dataint05_val',
            '請求残高更新フェーズ'  =>  'dataint06_val',
            '指定納品書作成フラグ'  =>  'dataint07_val',
            '請求書発行者'  =>  'user_name2',
            '請求書メール送信フラグ'  =>  'dataint08_val',
            '請求書PDFダウンロードフラグ'  =>  'dataint09_val',
            'プロジェクト番号'  =>  'sales_history_datachar03',
            '入金番号'  =>  'sales_history_youbou',
            '即時区分'  =>  'housoukubun_val',
            '入金方法'  =>  'kessaihouhou_val',

            '売上T登録年月日'  =>  'date',
            '売上T登録時刻'  =>  'time',
            '売上T更新者'  =>  'updated_user',
            '売上T訂正回数'  =>  'updated_times',
            '売上F登録年月日'  =>  'date1',
            '売上F登録時刻'  =>  'time1',
            '売上F更新年月日'  =>  'updated_date',
            '売上F更新時刻'  =>  'updated_time',
            '売上F更新者'  =>  'updated_user1',
        ];

        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);
    }
}
