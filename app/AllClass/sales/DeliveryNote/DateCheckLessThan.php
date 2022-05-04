<?php


namespace App\AllClass\sales\DeliveryNote;


use Illuminate\Contracts\Validation\Rule;

class DateCheckLessThan implements Rule
{

    public $field;
    public $type;

    public function __construct($field, $type = 'number')
    {
        $this->field = $field;
        $this->type = $type;
    }

    public function passes($attribute, $value)
    {
        $value = $value ? $value : 0;
        $field = strpos(request($this->field), '/') ? str_replace('/', '', request($this->field)) : request($this->field);
        $field = $field ? $field : 0;
        return $value <= $field;
    }

    public function message()
    {
        if ($this->type == 'date') {
            return "【:attribute】正しい年月日を入力してください。";
        } else {
            return "【:attribute】正しい番号を入力してください。";
        }
    }
}
