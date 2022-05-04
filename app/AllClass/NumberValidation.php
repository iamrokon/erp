<?php


namespace App\AllClass;


use Illuminate\Contracts\Validation\Rule;

class NumberValidation implements Rule
{
    public $field;
    protected $digits;

    public function __construct($field, $allowed_digits)
    {
        $this->field = $field;
        $this->digits = $allowed_digits;
    }

    public function passes($attribute, $value)
    {
        $position =isset(explode('.',$attribute)[1])  ? explode('.',$attribute)[1] : null;
        $value  =  $position !== null ? request($this->field . '.'.$position) : request($this->field);
        // return $value >= (strpos($field, '/') ? str_replace('/', '', $field) : $field);

        $new_value = str_replace(",","",$value);
        if(strlen($new_value) <= $this->digits){
            return true;
        }
        return false;
    }

    public function message(): string
    {
        return "【:attribute】".$this->digits."桁以下で入力してください。";
    }
}
