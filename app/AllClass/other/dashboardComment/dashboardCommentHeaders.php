<?php

namespace App\AllClass\other\dashboardComment;

use App\AllClass\TableSetting;
use DB;
use App\tantousya;
use App\kengen;

Class dashboardCommentHeaders{
    public static $page_no = '11-04';

    public static function headers($bango,$type=null){
        $headers = [
          '行番号' => 'syouhinbango',
          'タイトル' => 'sitesyubetsu',
          '掲載開始日' => 'created_date',
          '掲載終了日' => 'edited_date',
          '内容' => 'status',
          '作成日' => 'submit_date',
          '作成時刻' => 'submit_time',
          '入力担当者' => 'user_name',
          'LAMU/その他' => 'notice',
        ];

        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);

    }
}
