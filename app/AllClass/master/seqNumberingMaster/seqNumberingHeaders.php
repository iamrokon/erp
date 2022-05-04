<?php

namespace App\AllClass\master\seqNumberingMaster;

use App\AllClass\TableSetting;
use DB;
use App\tantousya;
use App\kengen;


Class seqNumberingHeaders
{
    public static $page_no = '08-10';
    public static function headers($bango,$type=null)
    {
        $headers = [
            '番号区分' => 'kokyakusyouhinbango_detail',
            '番号' => 'orderbango',
            '番号総桁数' => 'mobile_flag',
            '登録年月日' => 'created_date',
            '登録時刻' => 'created_time',
            '更新年月日' => 'edited_date',
            '更新時刻' => 'edited_time',
          //  '更新時端末IP' => 'size',
            '更新者' => 'user_name',
        ];

        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);
    }
}
