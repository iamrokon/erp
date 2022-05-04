<?php


namespace App\AllClass\master\productDescription;


use Illuminate\Contracts\Validation\Rule;

class CheckForProductCdInputCategory implements Rule
{

    /**
     * @inheritDoc
     */
    public function passes($attribute, $value)
    {
       if(!preg_match("/^[0-1]+$/",$value) && strlen($value) == 1){
           return false;
       }
       return true;
    }

    /**
     * @inheritDoc
     */
    public function message()
    {
        return "【:attribute】 1桁以下で入力してください。";

    }
}
