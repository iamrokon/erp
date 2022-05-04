<?php

namespace App\AllClass;

use Illuminate\Contracts\Validation\Rule;

class CheckNumberHypen implements Rule
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
        //if(!empty($value))
        if($value != "")
        {
            if (preg_match('/^[0-9 \-]+$/', $value)) {
                return true;
            }           
            else return false;
        }
       
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '【:attribute】半角数字または半角のマイナス以外は使用できません。';
    }
}
