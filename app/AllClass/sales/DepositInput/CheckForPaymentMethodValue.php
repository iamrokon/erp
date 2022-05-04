<?php


namespace App\AllClass\sales\DepositInput;


use Illuminate\Contracts\Validation\Rule;

class CheckForPaymentMethodValue implements Rule
{

    public function passes($attribute, $value)
    {
        $status = true;
        $payment_method_val['type1'] = ['A901', 'A902', 'A903', 'A904'];
        $payment_method_val['type2'] = ['A905'];
        $position = ! is_null(explode('.',$attribute)[1]) ? explode('.',$attribute)[1] : null;
        $current_attribute_type = ( explode('.',$attribute)[0] == 'deposit_bank' ||  explode('.',$attribute)[0] == 'deposit_branch') ?  'type1' : 'type2';
        $payment_method = !is_null($position) ?  request("payment_method.".$position) : null;
        $condition = $payment_method_val[$current_attribute_type];
        if(in_array($payment_method,$condition)){
            $status =  is_null(request($attribute)) ? false : true;
        }
        return  $status;
    }

    public function message()
    {
        return "【:attribute】必須項目に入力がありません。";
    }
}
