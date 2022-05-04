<?php

namespace App\AllClass\master\personal_master;

use Illuminate\Contracts\Validation\Rule;

class CustomEmailValidator implements Rule
{
    public function passes($attribute, $value)
    {
        $email_values = explode(',', $value);
        $email_check_pattern = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";
        if (is_array($email_values)) {
            $unique_email_values = array_unique($email_values);
            if (count($email_values) != count($unique_email_values)) {
                return false;
            }
            foreach ($email_values as $email) {
                if (!preg_match($email_check_pattern, $email)) {
                    return false;
                }
            }
        } else {
            if (!preg_match($email_check_pattern, $value)) {
                return false;
            }
        }
        return true;
    }

    public function message()
    {
        return '【:attribute】入力されたメールアドレスの形式はご登録いただけません。';
    }
}
