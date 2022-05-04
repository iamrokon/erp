<?php

namespace App\AllClass\master\nameMaster;

use App\AllClass\TableSetting;
use DB;
use App\tantousya;
use App\kengen;


Class nameheaders
{
    public static $page_no = '08-06';

    public static function headers($bango,$type=null)
    {
        $headers =  [
            '名称CD' => 'category1',
            '分類CD' => 'category2',
            '名称名' => 'category3',
            '分類名' => 'category4',
            '名称名略称' => 'category5',
            '分類名略称' => 'groupbango',
            '分類コード桁数' => 'osusume',
            '表示順' => 'suchi1',
            '変更可否' => 'changed',
            '予備1' => 'spare_one',
            '予備2' => 'spare_two',
            '予備3' => 'spare_three',
            '登録年月日' => 'created_date',
            '登録時刻' => 'created_time',
            '更新年月日' => 'edited_date',
            '更新時刻' => 'edited_time',
            //  '更新時端末IP' => 'image3',
            '更新者' => 'user_name',// old name ->kokyakubango
        ];

        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);


    }
}
