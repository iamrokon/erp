<?php
namespace App\AllClass\purchase\paymentInput;

use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Contracts\Validation\Rule;

class ReviewOrderBangoCheck implements Rule
{


    public function passes($attribute, $value)
    {
        $orderBango = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7504'")->orderbango ?? null;
        // dd($orderBango);
        return $value > $orderBango;
    }

    public function message()
    {
        return "支払日が確定済の日付です。";
    }
}
