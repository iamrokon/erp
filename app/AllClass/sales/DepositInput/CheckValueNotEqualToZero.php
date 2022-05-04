<?php


namespace App\AllClass\sales\DepositInput;


use Illuminate\Contracts\Validation\Rule;

class CheckValueNotEqualToZero implements Rule
{

    public function passes($attribute, $value)
    {
        if (!is_null($value) && $value == 0){
            return false;
        }
        return true;
    }

    public function message()
    {
        return "【:attribute】正しい金額を入力してください。";
    }
}
