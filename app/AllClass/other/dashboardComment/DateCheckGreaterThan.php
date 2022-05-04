<?php


namespace App\AllClass\other\dashboardComment;


use Illuminate\Contracts\Validation\Rule;

class DateCheckGreaterThan implements Rule
{
    public $field;

    public function __construct($field)
    {
        $this->field = $field;
    }

    public function passes($attribute, $value)
    {
        $date = date('Y/m/d');
        $n_date = str_replace('/','',$date);
        $position =isset(explode('.',$attribute)[1])  ? explode('.',$attribute)[1] : null;
        $field  =  $position !== null ? request($this->field . '.'.$position) : request($this->field);
        return ($value >= $n_date) && ($value >= (strpos($field, '/') ? str_replace('/', '', $field) : $field));
    }

    public function message()
    {
        return "【:attribute】正しい年月日を入力してください。";
    }
}
