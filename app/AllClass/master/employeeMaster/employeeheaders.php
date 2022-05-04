<?php

namespace App\AllClass\master\employeeMaster;

use App\AllClass\TableSetting;
use DB;
use App\tantousya;
use App\kengen;


Class employeeheaders
{
    public static $page_no = '08-05';
    public static function headers($bango,$type = null)
    {
        $headers =  [
            '社員CD' => 'employee_bango',
        '社員名' => 'name',
        '給与社員CD' => 'htanka',
        '事業年度（期）' => 'ztanka',
        '事業部' => 'company_1',
        '部' => 'company_2',
        'グループ' => 'company_3',
        '事業所' => 'syozoku',
        'パスワード' => 'passwd',
        '権限CD' => 'mail4',
        '電話番号' => 'employee_mail2',
        '携帯番号' => 'mail3',
        'メールアドレス' => 'mail',
        '入力者１' => 'datatxt0030',
        '入力者2' => 'datatxt0031',
        '入力者3' => 'datatxt0032',
        '入力者4' => 'datatxt0033',
        '決裁者1' => 'datatxt0034',
        '決裁者２' => 'datatxt0035',
        '決裁者３' => 'datatxt0036',
        '決裁者４' => 'datatxt0037',
        '社員印影' => 'datatxt0029',
        '承認部門' => 'recog_dept',
        '権限レベル' => 'innerlevel',
        '写真' => 'syounin',
        '登録年月日' => 'created_date',
        '登録時刻' => 'created_time',
        '更新年月日' => 'edited_date',
        '更新時刻' => 'edited_time',
        // '更新時端末IP' => 'employee_syounin',
        '更新者' => 'user_name'
        ];
        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);


    }
}
