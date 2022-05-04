<?php

namespace App\AllClass\order\backlogList2;

use App\AllClass\TableSetting;
use DB;
use App\tantousya;
use App\kengen;

Class BacklogList2Headers
{
    public static $page_no = '02-10';

    public static function headers($bango,$type=null)
    {
        $headers = [
            '番号' => 'jhvw001',
            '担当' => 'user_name',
            '受注先' => 'jhvw022_detail',
            '受注内容' => 'jhvw053',
            '受注日' => 'jhvw030',
            '納期' => 'jhvw031',
            '検収日' => 'jhvw033',
            '売上予定日' => 'jhvw032',
            '入金予定日' => 'jhvw034',
            '分類明細金額' => 'jhvw049',
            '粗利額' => 'jhvw048',
            '売上先' => 'jhvw023_detail',
            '最終顧客' => 'jhvw024_detail',
            '定期定額契約番号' => 'jhvw007',
            '受注番号' => 'order_number',
            '代理店1CD' => 'jhvw025_detail',
            '代理店2CD' => 'jhvw026_detail',
            '発注金額分類' => 'jhvw043',
            '事業部' => 'jhvw050',
            '部' => 'jhvw051',
        ];

        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);
    }
}
