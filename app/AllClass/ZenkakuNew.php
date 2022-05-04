<?php

namespace App\AllClass;

use Illuminate\Contracts\Validation\Rule;

class ZenkakuNew implements Rule
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
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!empty($value)) {
            if (strpos($value, "\r\n")) {
                $value = str_replace(array("\n", "\r"), '', $value);
            }
            $len = strlen($value);
            $mblen = mb_strlen($value) * 3;
            if ($len == $mblen) {
                return true;
            }
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
        return '【:attribute】全角文字以外は使用できません。';
    }
}
