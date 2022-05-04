<?php


namespace App\AllClass\flatRateContract\ChangeInChargeOfInHouseWorkWithFixedRateContracts; 


use App\AllClass\TableSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChangeInChargeOfInHouseWorkWithFixedRateContract
{
    public static $pageNo = '0306';
    public static function headers($bango, $type = null)
    {
        $headers = [
            '契約担当' => 'formatted_contractor',
            '定期定額契約番号' => 'contract_number',
            '契約回数' => 'formatted_no_of_contracts',
            '売上先' => 'formatted_sales_destination_r17',
            '受注先' => 'formatted_contractor_r17',
            '最終顧客' => 'formatted_end_customer_r17',
            '新担当' => 'formatted_new_charge',
            '契約金額' => 'formatted_contract_amount',
            '商品名' => 'product_name',
            '伝票備考' => 'voucher_remarks',
            '定期サブスク区分' => 'formatted_regular_subscription_classification',
            '元受注番号' => 'order_number',
            '元受注行番号' => 'order_line_number',
            '元受注行番号枝番' => 'order_branch_number',
            '社内備考' => 'in_house_remarks',
            '有償開始日' => 'paid_start_date',
            '有償終了日' => 'paid_end_date',
            '契約金額消費税' => 'formatted_consumption_tax',
            '伝票統合' => 'slip_integration',
            '発注出荷指示備考' => 'order_shipping_instructions_remarks',
            'プロジェクト番号' => 'project_number',
            '契約指示・検印フェーズ' => 'stamping_phase',
            '自動継続フラグ' => 'auto_continuation_flag',
            '自動売上フラグ' => 'auto_sales_flag',
            '請求済フラグ' => 'billed_flag',
            '支払済フラグ' => 'paid_flag',
            '訂正フラグ' => 'correction_flag',
            '登録年月日・時刻' => 'registration_date_time',
            '更新年月日・時刻' => 'update_date_time',
            '更新者' => 'formatted_updater',
            '契約状態' => 'formatted_contract_status',
            '契約期間開始日' => 'contract_period_start_date',
            '契約期間終了日' => 'contract_period_end_date',
        ];
        $pageNo = self::$pageNo;
        if ($type) {
            return TableSetting::getHeaders($bango, $pageNo, $headers, $type);
        }
        return TableSetting::getHeaders($bango, $pageNo, $headers);


    }
    public static function validate($request) {
        $rules = [];
        $rules['incharge'] = ['required'];
        //$rules['creation_category'] = ['required'];

        $messages = [];
        $messages['required'] = '【:attribute】必須項目に入力がありません。';
        $messages['max'] = '【:attribute】:max桁以下で入力してください。';
        $messages['lte'] = '【:attribute】日付の入力が適切ではありません。';

        $attributes = [
            'incharge' => '内作担当'
            ];
        return Validator::make($request->all(), $rules, $messages, $attributes);
    }

}
