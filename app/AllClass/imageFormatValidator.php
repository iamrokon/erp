<?php

namespace App\AllClass;

use Illuminate\Contracts\Validation\Rule;

class imageFormatValidator implements Rule
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

        if (preg_match('/\.(jpe?g|png|gif|bmp|pdf)$/i',$value))
        {
            return true;
        }
        else
            return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "【:attribute】jpeg  jpg  gif  png  bmp  pdf のみOK。";
    }
}
