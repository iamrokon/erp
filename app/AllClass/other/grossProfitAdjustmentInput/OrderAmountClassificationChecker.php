<?php
namespace App\AllClass\other\grossProfitAdjustmentInput;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\Helpers\Helper;
use Illuminate\Contracts\Validation\Rule;
use \Carbon\Carbon;

class OrderAmountClassificationChecker implements Rule
{
    public function passes($attribute, $value)
    {
        $status = true;
        $position = !is_null(explode('.',$attribute)[1]) ? explode('.',$attribute)[1] : null;
        $method = !is_null($position) ?  request("orderAmountClassification.".$position) : null;
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
