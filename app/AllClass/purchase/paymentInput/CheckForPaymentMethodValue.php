<?php


namespace App\AllClass\purchase\paymentInput;


use Illuminate\Contracts\Validation\Rule;

class CheckForPaymentMethodValue implements Rule
{

    public function passes($attribute, $value)
    {
        $status = true;
        $position = ! is_null(explode('.',$attribute)[1]) ? explode('.',$attribute)[1] : null;
        $payment_method = !is_null($position) ?  request("payment_method.".$position) : null;
        if($payment_method == "D903"){
            $status =  is_null(request($attribute)) ? false : true;
        }
        return  $status;
    }

    public function message()
    {
        return "【:attribute】必須項目に入力がありません。";
    }
}
