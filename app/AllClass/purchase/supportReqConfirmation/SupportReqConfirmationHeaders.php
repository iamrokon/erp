<?php

namespace App\AllClass\purchase\supportReqConfirmation;

use App\AllClass\TableSetting;
use DB;
use App\tantousya;
use App\kengen;

Class SupportReqConfirmationHeaders
{
    public static $page_no = '05-07';

    public static function headers($bango,$type=null)
    {
        $headers = [
            '受注番号' => 'orderuserbango',
            '売上日' => 'intorder03',
            '検収日' => 'intorder04',
            'サポート番号' => 'support_number',
            '依頼日' => 'date',
            '受注先' => 'datachar10_detail',
            '最終顧客' => 'datachar11_detail',
            '業務名' => 'datachar13',
            '担当' => 'user_name',
            'サポート金額' => 'formatted_support_amount',
            'tick_mark' => 'checkbox',
            'サポート依頼兼請書PDF' => 'datatxt0151',
            '引継希望日' => 'deletedate',
            '初回訪問日' => 'date0012',
            '受注日' => 'intorder01',
            '相談SE' => 'datachar12',
            '基本設計終了日' => 'date0013',
            'セットアップ開始日' => 'date0014',
            '本稼働開始日' => 'date0015',
            '検収条件' => 'datatxt0148',
            'サポート部門' => 'datatxt0149_detail',
            '登録年月日' => 'date0016',
            '更新年月日' => 'date0017',
            '更新者' => 'changer_name',
            'PDF作成フラグ' => 'dataint03_detail',
            'PDFダウンロードフラグ' => 'dataint04_detail',
            '検印者' => 'inspector_name',
            '検印フラグ' => 'dataint06_detail',
        ];

        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);
    }
}
