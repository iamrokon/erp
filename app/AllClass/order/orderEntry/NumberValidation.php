<?php


namespace App\AllClass\order\orderEntry;


use Illuminate\Contracts\Validation\Rule;

class NumberValidation implements Rule
{
    public $digit_number = 8;

    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        $new_value = str_replace("-","",$value);
        if(strlen($new_value) <= 8){
            return true;
        }
        return false;
    }

    public function message(): string
    {
        return "【:attribute】".$this->digit_number."桁以下で入力してください。";
    }
}
