<?php

namespace App\AllClass\master\productSubMaster;

use App\AllClass\TableSetting;
use DB;
use App\tantousya;
use App\kengen;


Class productSubMasterheaders
{
    public static $page_no = '08-14';
    public static function headers($bango,$type = null)
    {

        $headers = [
            'サブ区分' => 'other1',
            '商品サブCD' => 'other2',
            '取引先' => 'other3_detail',
            'データ種' => 'other4_detail',
            'バージョン区分' => 'other25_detail',
            '商品サブ名称' => 'other21',
            '商品サブ名称カナ名' => 'other5',
            '商品サブ分類1' => 'other6',
            '商品サブ分類2' => 'other7',
            '商品サブ分類3' => 'other8',
            '作成事業部' => 'other9',
            '作成部' => 'other10',
            '作成グループ' => 'other11',
            '作成者' => 'other12_detail',
            'データ区分' => 'other13_original',
            '作成ステータス' => 'other14_original',
            '上市開始日' => 'other15_modified',
            '終売日' => 'other16_modified',
            '入力区分' => 'other17_original',
            'サブCD桁数' => 'other18',
            '対応バージョン' => 'other20',
//            '小売業会社名' => 'other21',
            '小売業略称' => 'other22',
            '小売業部門' => 'other23',
            '小売業メッセージ種' => 'other24',
            '登録年月日' => 'created_date',
            '登録時刻' => 'created_time',
            '更新年月日' => 'edited_date',
            '更新時刻' => 'edited_time',
           // '更新時端末IP' => 'other28',
            '更新者' => 'other29',
        ];
        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);
    }
}
