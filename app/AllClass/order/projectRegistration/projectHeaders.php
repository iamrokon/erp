<?php

namespace App\AllClass\order\projectRegistration;

use App\AllClass\TableSetting;
use DB;
use App\tantousya;
use App\kengen;

Class projectHeaders
{
    public static $page_no = '02-02';

    public static function headers($bango,$type=null)
    {
        $headers = [
            'プロジェクト番号' => 'project_url',
            'プロジェクト名称' => 'urlsm',
            '受注先' => 'catchsm_address',
            '最終顧客' => 'caption_address',
            '営業' => 'setumei_name',
            'SE' => 'catch_name',
            '開始年月' => 'mbcatch_date',
            '終了年月' => 'mbcatchsm_date',
            '備考' => 'mbcaption',
            '登録年月日' => 'created_date',
            '登録時刻' => 'created_time',
            '更新年月日' => 'edited_date',
            '更新時刻' => 'edited_time',
            //'更新時端末IP' => 'datatxt0099',
            '更新者' => 'user_name',             
        ];

        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);


    }
}
