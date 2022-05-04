<?php

namespace App\AllClass\sales\creditLimitManagement;
use App\AllClass\TableSetting;

class CreditLimitManagementHeaders
{

    public static $page_no = '04-26';
    public static function headers($bango,$type = null)
    {
        $headers = [
            'グループ' => 'tantousya_datatxt0005_group',
            '担当者' => 'manager',
            '売上請求先' => 'sales_billing_destination',
            '与信限度' => 'clm_credit_limits',
            '売掛総債権残高' => 'clm_total_amounts',
            '保守予定' => 'clm_maintenance_schedule',
            '注残予定' => 'clm_note_remaining_schedule',
            '予定残高' => 'clm_scheduled_balance',
            '受注番号' => 'order_no',
            '受注先' => 'contractor',
            '税込金額' => 'clm_order_amount',
            '売上予定' => 'clm_sales_schedule'
        ];
        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);


    }
}
