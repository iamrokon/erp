<?php


namespace App\AllClass\sales\DeliveryNote;

use Illuminate\Support\Facades\Validator;

class DeliveryNote
{
    public static function validate($request)
    {
        $rules = [];
        $rules['division_datachar05_start'] = ['required'];
        //  $rules['department_datachar05_start'] = ['required'];
        if (request('order_date_end')) {
            $rules['order_date_start'] = ['required', 'max:8', new DateCheckLessThan('order_date_end', 'date')];
        } else {
            $rules['order_date_start'] = ['max:8', new DateCheckLessThan('order_date_end', 'date')];
        }
        $rules['order_date_end'] = ['max:8', new DateCheckGreaterThan('order_date_start')];
        if (request('sales_slip_number_end')) {
            $rules['sales_slip_number_start'] = ['required', 'max:10', new DateCheckLessThan('sales_slip_number_end')];
        } else {
            $rules['sales_slip_number_start'] = ['max:10', new DateCheckLessThan('sales_slip_number_end')];
        }
        $rules['sales_slip_number_end'] = ['max:10', new DateCheckGreaterThan('sales_slip_number_start')];

        $messages = [];
        $messages['required'] = '【:attribute】必須項目に入力がありません。';
        $messages['max'] = '【:attribute】:max桁以下で入力してください。';
        $messages['lte'] = '【:attribute】日付の入力が適切ではありません。';


        $attributes = [
            'division_datachar05_start' => '事業部',
            'department_datachar05_start' => '部',
            'order_date_start' => '売上日',
            'order_date_end' => '売上日',
            'sales_slip_number_start' => '売上伝票番号',
            'sales_slip_number_end' => '売上伝票番号'
        ];
        return Validator::make($request, $rules, $messages, $attributes);
    }
}
