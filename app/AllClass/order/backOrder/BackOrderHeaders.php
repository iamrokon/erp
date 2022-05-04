<?php

namespace App\AllClass\order\backOrder;

use App\AllClass\TableSetting;
use DB;
use App\tantousya;
use App\kengen;

Class BackOrderHeaders
{
    public static $page_no = '02-08';

    public static function headers($bango,$type=null)
    {
        $headers = [
            /*'行' => 'id',*/
            '受注番号' => 'order_id',
            '担当' => 'created_username',
            '受注先' => 'information1_detail_show',
            '受注件名' => 'juchukubun1',
            '受注日' => 'intorder01',
            '検収日' => 'intorder04',
            '売上日' => 'intorder03',
            '入金日' => 'intorder05',
            '受注金額' => 'money10',
            '仕切（SE）単価' => 's1',
            '仕切（研究所）単価' => 's2',
            '仕切（出荷C）単価' => 's3',
            '粗利' => 'moneymax',
            '売上請求先' => 'information2_detail_show',
            '最終顧客' => 'information3_detail_show',
            '入金方法' => 'cat_1',
            '即時区分' => 'housoukubun',
            '検収条件' => 'cat_2',
            '売上基準' => 'cat_3',
            '社内備考' => 'information7',
            '伝票備考' => 'information8',
            '請求課税区分' => 'cat_4',
            '注文書PDF' => 'information9',
            '注文書書類保管番号' => 'orderhenkan_data08',
        ];

        $pageNo= static::$page_no;

        if(!empty($type['rd2'])){
            $pageNo=$pageNo."-0".$type['rd2'];

            return TableSetting::getHeaders($bango,$pageNo,$headers);
        }else{
            $pageNo=$pageNo."-01";
            return TableSetting::getHeaders($bango,$pageNo,$headers);
        }



    }
}
