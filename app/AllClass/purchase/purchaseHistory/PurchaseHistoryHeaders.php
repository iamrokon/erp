<?php

namespace App\AllClass\purchase\purchaseHistory;

use App\AllClass\TableSetting;

class PurchaseHistoryHeaders
{
    public static $page_no = '06-04';
    public static function headers($bango,$type = null)
    {
        $headers = [
            '行' => 'line_no',
            '仕入先' => 'supplier',
            '区分' => 'classification',
            /*'仕入番号' => 'purchase_no',*/
            '仕入日' => 'purchase_date',
            '指検状態' => 'finger_test_information',
            '指示' => 'instructions_check',
            '検印' => 'stamp_check',
            '金額' => 'purchase_history_amount',
            '発注番号' => 'order_number',
            '受注先' => 'order_to',
            '最終顧客' => 'end_customer',
            '会計科目CD' => 'accounting_subject',
            '内訳CD' => 'breakdown',
            '仕入購入区分' => 'purchase_category',

            '作成区分' => 'creation_division',
            '仕入担当者' => 'purchaser',
            '納品書番号' => 'invoice_number',
            '納品書日付' => 'invoice_date',
            '伝票備考' => 'slip_remarks',
            '支払日' => 'payment_date',
            '仕入消費税額' => 'purchase_consumption_tax_amount',
            '仕入履歴作成フラグ' => 'purchase_history_creation_flag',
            '予備1' => 'spare1',
            '予備2' => 'spare2',
            '予備3' => 'spare3',
            '予備4' => 'spare4',
            '予備5' => 'spare5',
            '予備6' => 'spare6',
            'データ有効区分' => 'data_valid_segment',
            '登録年月日' => 'registration_date',

            '登録時刻' => 'registration_time',
            '更新者' => 'updater',
            '訂正回数' => 'number_of_corrections',
            '支払締め日' => 'payment_closing_date',
            '支払一括消費税額' => 'consumption_tax_paid',
            '仕入済区分' => 'purchased_segment',
            '前払区分' => 'prepayment_segment',
            '仮払仕入日' => 'provisional_purchase_date',
            '支払データ作成フラグ' => 'payment_data_creation_flag',
            '買掛残高更新フラグ' => 'accounts_payable_update_flag',
            '仕入購入指示者' => 'purchase_orderer',
            '仕入購入検印者' => 'purchase_seal_holder',
            '仕入会計データ作成フェーズ' => 'accounting_data_creation_phase',
            'フラグ予備1' => 'flag_reserve1'
        ];
        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);


    }
}
