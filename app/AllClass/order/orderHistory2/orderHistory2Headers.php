<?php

namespace App\AllClass\order\orderHistory2;

use App\AllClass\TableSetting;
use DB;
use App\tantousya;
use App\kengen;

Class orderHistory2Headers
{
    public static $page_no = '02-07';

    public static function headers($bango,$type=null,$temp_page_no=null)
    {
        $headers = [
            '受注区分' => 'datachar02_detail',
            '作成区分' => 'datachar01',
            '担当' => 'user_name',
            '受注番号' => 'kokyakuorderbango',
            '訂正回数' => 'ordertypebango2',
            '受注件名' => 'juchukubun1',
            '受注先' => 'information1_detail',
            '売上請求先' => 'information2_detail',
            '最終顧客' => 'information3_detail',
            //'売上請求先担当者名' => 'information2_mail4',
            '受注金額' => 'formatted_money10',
            'SE@' => 'sum_of_dataint05',
            '研究所@' => 'sum_of_dataint06',
            '出荷C@' => 'sum_of_dataint07',
            //'粗利' => 'moneymax',
            '受注日' => 'intorder01',
            '売上日' => 'intorder03',
            '入金日' => 'intorder05',
            '[最終顧客]データソース' => 'end_cus_source',
            '[最終顧客]ユーザー' => 'end_cus_user',
            '[最終顧客]取引開始日' => 'trading_start_date',
            '[受注先]取引開始日' => 'trading_end_date',
            'プロジェクト番号' => 'order_history_datachar03',
            '客先注番' => 'order_history_datachar04',
            '代理店1' => 'information4_detail',
            '代理店2' => 'information5_detail',
            '請求書送付先' => 'information6_detail',
            '入金方法' => 'kessaihouhou_detail',
            '即時区分' => 'housoukubun',
            '検収条件' => 'chumonsyajouhou_detail',
            '注文書書類保管番号' => 'order_history_datachar08',
            '検収確認書書類保管番号' => 'order_history_datachar09',
            '売上指示・検印フェーズ' => 'hktsyukko_datachar01_detail',
            '売上指示者' => 'datachar02_tan_name',
            '売上検印者' => 'datachar03_tan_name',
            '伝票作成フラグ' => 'hktsyukko_datachar04_detail',
            '伝票作成者' => 'datachar05_tan_name',
            '検収書確認フラグ' => 'hktsyukko_datachar06_detail',
            '検収書確認者' => 'datachar07_tan_name',
            '受注実績作成フラグ' => 'hktsyukko_datachar08_detail',
            '売上伝票メール送信フラグ' => 'hktsyukko_datachar09_detail',
            '売上伝票PDFダウンロードフラグ' => 'hktsyukko_datachar10_detail',
            '最終顧客／販売ランク' => 'koyk1_domain',
            '最終顧客／顧客深耕層別化' => 'koyk1_domain2',
        ];

        $pageNo= static::$page_no.$temp_page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);
    }
}
