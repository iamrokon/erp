<?php

namespace App\AllClass\master\creditMaster;

use App\AllClass\TableSetting;
use DB;
use App\tantousya;
use App\kengen;


Class creditheaders
{
    public static $page_no = '08-11';

    public static function headers($bango,$type=null)
    {


        $headers = [
            '会社CD' => 'point',
            '会社名' => 'kokyaku1_name',
            '年月' => 'kounyusu',
            '与信限度額' => 'denpyostart',
            '前月与信残高金額' => 'syukei1',
            '当月受注金額' => 'syukei2',
            '当月売上金額' => 'syukei3',
            '当月入金金額' => 'syukei4',
            '当月与信残高金額' => 'syukei5',
            '登録年月日' => 'mail11',
            '登録時刻' => 'mail12',
            '更新年月日' => 'mail21',
            '更新時刻' => 'mail22',
           // '更新時端末IP' => 'name',
            '更新者' => 'kaka',
        ];
        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);


    }
}
