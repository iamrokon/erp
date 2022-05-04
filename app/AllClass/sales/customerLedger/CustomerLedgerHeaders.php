<?php


namespace App\AllClass\sales\customerLedger;
use App\AllClass\TableSetting;

class CustomerLedgerHeaders
{
    public static $page_no = '04-13';

    public static function headers($bango,$type=null)
    {
        $headers = [
            '日付' => 's1date0008_s2intorder03_s3torikomidate',
            '区分' => 's1_s2searched1_s3',
            '伝票番号' => 's1_s2kaiinid_s3shinkurokokyakuname',
            //'伝票行' => 's1_s2syouhinsyu_s3shinkurokokyakugroup',
            '伝票行' => 's1_s2syouhinsyu_s3syouhinsyu',
            '品名' => 's1_s2syouhinname_s3searched2',
            '数' => 's1_s2syukkasu_s3',
            '単価/期日' => 's1_s2dataint04_s3chumondate',
            '売上金額' => 's1_s2searched3_s3',
            '消費税額' => 's1_s2searched4_s3',
            '入金金額' => 's1_s2_s3nyukingaku',
            '残高' => 's1datanum0032_s2_s3',
            '番号' => 's1_s2syouhinid_s3syouhinid',
            '行' =>'s1_s2syouhinsyu_s3shinkurokokyakugroup',
            //'行' => 's1_s2syouhinsyu_s3syouhinsyu',
            '備考' => 's1_s2datachar08_s3toiawasebango',
            '受注先' => 's1_s2r17_4_1_s3r17_4_1',
            '最終顧客' => 's1_s2r17_4_2_s3r17_4_2',
            '受注担当部署CD' => 'classification',
            '受注担当者' => 'user_name'
        ];

        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);
    }
}
