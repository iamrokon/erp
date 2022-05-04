<?php

namespace App\AllClass;

use Illuminate\Contracts\Validation\Rule;

class Mobile implements Rule
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
        if(!empty($value))
        {
            if (preg_match('/^\d{2}-\d{4}-\d{4}$/', $value)) {
                return true;
            }

            else if (preg_match('/^\d{3}-\d{3}-\d{4}$/', $value)) {
               return true;
            }
            else if (preg_match('/^\d{4}-\d{2}-\d{4}$/', $value)) {
               return true;
            }
            else if ( preg_match('/^[0-9]+$/', $value)) {
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
        return ':attributeの入力形式が間違っています。';
    }
}
