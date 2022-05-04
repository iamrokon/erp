<?php


namespace App\AllClass\sales\DepositInput;


use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Contracts\Validation\Rule;

class CheckBillingAddress implements Rule{

    public function passes($attribute, $value)
    {
        $billing_address = request($attribute);
        $datatxt0142 = QueryHelper::fetchSingleResult("select count(*) from seikyuzandaka where datatxt0142 = '$billing_address'")->count ?? null;
        if($datatxt0142){
            return false;
        }
        return true;
    }

    public function message()
    {
        return "【:attribute】締日処理済の日付のため、登録できません。";
    }
}
