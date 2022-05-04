<?php

namespace App\AllClass;

use Illuminate\Contracts\Validation\Rule;

class hankaku implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //half-width alphanumeric, hankaku katakana & symbol validation
        $regex = "/^[a-zA-Z0-9゠ｧ-ﾝ]+$/";
        if(!empty($value) && mb_strlen($value) == strlen($value))
        {
            return true;
        }else if(!empty($value) && mb_strlen($value) != strlen($value) && preg_match($regex, $value)){
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '【:attribute】 半角英数字・ｶﾅ・記号以外は使用できません。';
    }
}
