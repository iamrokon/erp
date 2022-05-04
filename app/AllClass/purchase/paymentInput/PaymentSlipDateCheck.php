<?php
namespace App\AllClass\purchase\paymentInput;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\Helpers\Helper;
use Illuminate\Contracts\Validation\Rule;
use \Carbon\Carbon;

class PaymentSlipDateCheck implements Rule
{   
    public $field;
    public function __construct($field)
    {
        $this->field = $field;
    }
    public function passes($attribute, $value)
    {   
        $value = (int)$value;
        $position =isset(explode('.',$attribute)[1])  ? explode('.',$attribute)[1] : null;
        $field  =  $position !== null ? request($this->field . '.'.$position) : request($this->field);
        // dd($value, $attribute, $position, $field);
        // $payment_date = strpos($field, '/') ? str_replace('/', '', $field) : $field;
        $prev = Carbon::createFromFormat('Y/m/d', $field)->subDays(10);
        $post = Carbon::createFromFormat('Y/m/d', $field)->addDays(10);
        // dd($date->addDays(10));
        $prev = (int)static::getDateTime($prev);
        $post = (int)static::getDateTime($post);
        // dd($prev, $value, $post);
        return $prev <= $value && $value <= $post; 
    }
    public function message()
    {
        return "会計日を適正に入力してください。";
    }
    public static function getDateTime($date)
    {
        $mytime = $date->format('Y-m-d');
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        return str_replace(" ", "", $mytime);
    }
}
