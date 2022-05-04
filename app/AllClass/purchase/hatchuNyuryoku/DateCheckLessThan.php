<?php


namespace App\AllClass\purchase\hatchuNyuryoku;


use Illuminate\Contracts\Validation\Rule;

class DateCheckLessThan implements Rule
{

    public $field;

    public function __construct($field)
    {
        $this->field = $field;
    }

    public function passes($attribute, $value)
    {

        $position =isset(explode('.',$attribute)[1])  ? explode('.',$attribute)[1] : null;
        $field  =  $position !== null ? request($this->field . '.'.$position) : request($this->field);
        return $value <= (strpos($field, '/') ? str_replace('/', '', $field) : $field);
    }

    public function message()
    {
        return "【:attribute】日付の入力が適切ではありません。";
    }
}
