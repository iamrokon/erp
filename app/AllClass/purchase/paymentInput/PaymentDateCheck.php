<?php
namespace App\AllClass\purchase\paymentInput;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\Helpers\Helper;
use Illuminate\Contracts\Validation\Rule;
use \Carbon\Carbon;

class PaymentDateCheck implements Rule
{

    public function passes($attribute, $value)
    {
        $slip_date = $value;
        $prev_90_days = static::getDateTime(-90);
        $post_90_days = static::getDateTime(90);        
        return $prev_90_days <= $slip_date &&  $slip_date <= $post_90_days;
    }

    public function message()
    {
        return "【:attribute】誤った範囲が指定されています。正しい範囲を入力してください。";
    }
    public static function getDateTime($days)
    {
        $mytime = Carbon::now()->addDays($days)->setTimezone("Asia/Tokyo")->format('Y-m-d');
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        return str_replace(" ", "", $mytime);
    }
}
