<?php


namespace App\AllClass\order\orderEntry;


use Illuminate\Contracts\Validation\Rule;

class CheckForOrderTypeBango2 implements Rule
{

    public $orderNumber;

    public function __construct($orderNumber)
    {
        $this->orderNumber = $orderNumber;
    }
    public function passes($attribute, $value)
    {
        $orderTypeBango =  $this->orderNumber  ?? 0;
        if ($orderTypeBango >= 90) {
            return false;
        }
        return true;
    }

    public function message()
    {
        return "訂正回数が最大値を超えます。";
    }
}
