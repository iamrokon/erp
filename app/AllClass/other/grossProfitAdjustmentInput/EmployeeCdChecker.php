<?php
namespace App\AllClass\other\grossProfitAdjustmentInput;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\Helpers\Helper;
use Illuminate\Contracts\Validation\Rule;
use \Carbon\Carbon;

class EmployeeCdChecker implements Rule
{
    public function passes($attribute, $value)
    {
        $status = true;
        $method = !is_null(request("order_category")) ?  request("order_category") : null;
        // dd($value, $method, $attribute, request($attribute));
        if($method == "V130"){
            $status =  $value == '0020' ? false : true;
        }
        if($method == "V140"){
            $status =  $value == '0970' ? false : true;
        }
        return  $status;
    }

    public function message()
    {
        return "登録できない担当です";
    }
}
