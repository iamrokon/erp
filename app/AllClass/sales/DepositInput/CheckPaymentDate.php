<?php


namespace App\AllClass\sales\DepositInput;


use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\Helpers\Helper;
use Illuminate\Contracts\Validation\Rule;

class CheckPaymentDate implements Rule
{

    public function passes($attribute, $value)
    {
        $payment_date = Helper::replaceSpecificString($value, '/');
        $billing_address = request('billing_address');
        $date009 = QueryHelper::fetchSingleResult("select max(date0009) from seikyuzandaka where datatxt0142 like '$billing_address'")->max ?? null;
        $date009 = $date009 ? str_replace('-', '', explode(' ', $date009)[0]) : 0;
        if ($payment_date && $date009 && ($payment_date <= $date009)) {
            return false;
        }
        return true;
    }

    public function message()
    {
        return "【:attribute】締日処理済の日付のため、登録できません。";
    }
}
