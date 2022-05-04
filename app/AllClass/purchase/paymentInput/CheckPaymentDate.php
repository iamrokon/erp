<?php


namespace App\AllClass\purchase\paymentInput;


use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\Helpers\Helper;
use Illuminate\Contracts\Validation\Rule;

class CheckPaymentDate implements Rule
{

    public function passes($attribute, $value)
    {
        $payment_date = Helper::replaceSpecificString($value, '/');
        $billing_address = request('supplier');
        $date009 = QueryHelper::fetchSingleResult("select max(sz0001) from shiharaizandaka where sz0002 = '$billing_address'")->max ?? null;
        $date009 = $date009 ? str_replace('-', '', explode(' ', $date009)[0]) : 0;
        if ($payment_date && $date009 && ($payment_date <= $date009)) {
            return false;
        }
        return true;
    }

    public function message()
    {
        return "【:attribute】支払日が締切済の日付です。";
    }
}
