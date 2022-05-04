<?php
namespace App\AllClass\other\grossProfitAdjustmentInput;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\Helpers\Helper;
use Illuminate\Contracts\Validation\Rule;
use \Carbon\Carbon;

class OrderAmountChecker implements Rule
{
    public function passes($attribute, $value)
    {
        $status = true;
        $order_amount = !is_null($value) ? (int)Helper::replaceSpecificString($value,',') : 0;
        $amount = !is_null(request("total_order_amount")) ?  (int)Helper::replaceSpecificString(request("total_order_amount"),',') : 0;
        // dd($order_amount,$value, $amount);
        return  $order_amount >= $amount;
    }

    public function message()
    {
        return "入力された値は適切ではありません";
    }
}
