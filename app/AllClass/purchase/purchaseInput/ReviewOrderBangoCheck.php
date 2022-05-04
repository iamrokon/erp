<?php
namespace App\AllClass\purchase\purchaseInput;

use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Contracts\Validation\Rule;

class ReviewOrderBangoCheck implements Rule
{

    public function __construct()
    {
        
    }

    public function passes($attribute, $value)
    {
        $orderBango = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7504'")->orderbango ?? null;
        return $value > $orderBango;
    }

    public function message()
    {
        return "【:attribute】仕入日が仕入確定済です。";
    }
}
