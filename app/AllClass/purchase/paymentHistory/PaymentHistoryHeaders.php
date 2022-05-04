<?php

namespace App\AllClass\purchase\paymentHistory;
use App\AllClass\TableSetting;
class PaymentHistoryHeaders
{
    public static $page_no = '06-14';
    public static function headers($bango,$type = null)
    {
        $headers = [
            '支払日' => 'payment_date',
            '支払番号' => 'payment_no',
            '支払方法' => 'payment_method',
            '法人マイナンバー' => 'corporate_no',
            '支払先' => 'payment_destination',
            '支払額' => 'payment_amount',
            '手形期日' => 'payment_due_date',
            '銀行' => 'bank',
            '備考' => 'remarks',

            '買掛区分' => 'accounts_payable_segment',
            '会計伝票日付' => 'fiscal_voucher_date',
            '会計科目CD' => 'accounting_subject',
            '会計内訳CD' => 'accounting_breakdown',
            '支払会計データ作成フラグ' => 'payment_data_creation_flag',
            '買掛残高更新フラグ' => 'accounts_payable_update_flag',
            '支払残高更新フラグ' => 'payment_balance_update_flag',
            '支払テーブル登録年月日時刻' => 'payment_registration_date_time',
            '支払テーブル更新者' => 'payment_table_updater',
            '支払関連フラグ登録年月日時刻' => 'payment_flag_registration_date_time',
            '支払関連フラグ更新者' => 'payment_flag_updater',
            '支払明細登録年月日時刻' => 'payment_item_registration_flag',
            '支払明細更新者' => 'payment_line_updater'
        ];
        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);


    }
}
