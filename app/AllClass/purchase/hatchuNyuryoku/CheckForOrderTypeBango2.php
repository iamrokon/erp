<?php


namespace App\AllClass\purchase\hatchuNyuryoku;

use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Contracts\Validation\Rule;

class CheckForOrderTypeBango2 implements Rule
{

    public $orderNumber;
    public $orderBango;
    public function __construct($orderNumber)
    {
        $this->orderNumber = $orderNumber;
    }
    public function passes($attribute, $value)
    {
        $orderTypeBango =  $this->orderNumber  ?? 0;
        $maxOrderTypeBango = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7402'")->orderbango ?? 0;
        $this->orderBango = $maxOrderTypeBango;
        if ($orderTypeBango >= $maxOrderTypeBango) {
            return false;
        }
        return true;
    }

    public function message()
    {
        return "訂正回数が上限値".$this->orderBango."回に達しました。";
    }
}
