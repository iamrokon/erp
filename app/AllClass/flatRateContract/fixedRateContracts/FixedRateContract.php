<?php


namespace App\AllClass\flatRateContract\FixedRateContracts;


use App\AllClass\TableSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FixedRateContract
{
    public static $pageNo = '0330';
    public static function headers($bango, $type = null)
    {
        $headers = [
            '契約状態' => 'contract_status',
            '担当' => 'in_charge',
            '契約番号' => 'contract_number',
            '商品名' => 'product_name',
            '売上請求先' => 'billing_address_r17',
            '受注先' => 'contractor_r17',
            '最終顧客' => 'end_customer_r17',
            '契約金額' => 'contract_amount',
            '契約開始日' => 'contract_start_date',
            '契約月数' => 'contract_months',
            '無償期間' => 'free_period',
            '請求サイクル' => 'billing_cycle',
            '請求月度' => 'billing_month',
            '自動継続' => 'automatic_continuation',
            '自動売上' => 'automatic_sales',
            '伝票統合' => 'voucher_integration',
            '入金方法' => 'payment_method',
            '契約回数' => 'number_of_contracts',
            '作成区分' => 'creation_category_temp',
            '定期サブスク区分' => 'subscription_classification',
            '元受注番号' => 'order_number',
            '元受注行番号' => 'line_number',
            '元受注行番号枝番' => 'branch_number',
            '書類保管番号' => 'storage_number',
            '保証書番号' => 'warranty_number',
            '契約期間終了日' => 'contract_end_number',
            '有償開始日' => 'paid_start_date',
            '有償終了日' => 'paid_end_date',
            '仕入先CD' => 'supplier_cd',
            '保守会社CD' => 'company_cd',
            '窓口数' => 'number_of_windows',
            '保守窓口CD' => 'maintenance_window_cd',
            '数量' => 'quantity',
            '単位' => 'unit',
            '単価' => 'unit_price',
            '契約金額消費税額' => 'consumption_tax',
            '営業粗利' => 'gross_operating_profit',
            'SE粗利' => 'se_gross_profit',
            '研究所粗利' => 'lab_gross_profit',
            '出荷SC粗利' => 'sc_gross_profit',
            '仕入金額' => 'purchase_amount',
            '納品方法' => 'delivery_method',
            '定期T登録年月日' => 'registration_date',
            '定期T登録時刻' => 'registration_time',
            '定期T更新年月日' => 'update_date',
            '定期T更新時刻' => 'update_time',
            '定期T更新者' => 'changer',
            '定期F登録年月日' => 'registration_date_2',
            '定期F登録時刻' => 'registration_time_2',
            '定期F更新年月日' => 'update_date_2',
            '定期F更新時刻' => 'update_time_2',
            '定期F更新者' => 'changer_2',
        ];
        $pageNo = self::$pageNo;
        if ($type) {
            return TableSetting::getHeaders($bango, $pageNo, $headers, $type);
        }
        return TableSetting::getHeaders($bango, $pageNo, $headers);


    }
    public static function validate($request) {
        $rules = [];
//        $rules['division_datachar05_start'] = ['required'];
        $rules['creation_category'] = ['required'];

        $messages = [];
        $messages['required'] = '【:attribute】必須項目に入力がありません。';
        $messages['max'] = '【:attribute】:max桁以下で入力してください。';
        $messages['lte'] = '【:attribute】日付の入力が適切ではありません。';

        $attributes = [
//            'division_datachar05_start' => '事業部',
            'creation_category' => '表示内容'
            ];
        return Validator::make($request->all(), $rules, $messages, $attributes);
    }

}
