<?php


namespace App\AllClass\support\manPowerManagementDataCreation;


use Illuminate\Contracts\Validation\Rule;

class DateCheckLessThan implements Rule
{
    public  $startDate;
    public  $attr;
    public function __construct($startDate, $attr)
    {
        $this->startDate = $startDate;
        $this->attr = $attr;
    }

    public function passes($attribute, $value)
    {
        if ($value < $this->startDate) {
            return false;
        }
        return  true;
    }

    public function message()
    {
        return '【' . $this->attr . '】正しい年月日を入力してください。';
    }
}
