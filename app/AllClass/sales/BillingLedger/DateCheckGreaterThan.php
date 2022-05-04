<?php


namespace App\AllClass\sales\BillingLedger;


use Illuminate\Contracts\Validation\Rule;

class DateCheckGreaterThan implements Rule
{
    public  $endDate;
    public  $attr;
    public function __construct($endDate, $attr)
    {
        $this->endDate = $endDate;
        $this->attr = $attr;
    }

    public function passes($attribute, $value)
    {
        if ($value > $this->endDate) {
            return false;
        }
        return  true;
    }

    public function message()
    {
        return '【' . $this->attr . '】正しい年月日を入力してください。';
    }
}
