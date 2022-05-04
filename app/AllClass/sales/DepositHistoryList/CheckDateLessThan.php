<?php


namespace App\AllClass\sales\DepositHistoryList;


use Illuminate\Contracts\Validation\Rule;

class CheckDateLessThan implements  Rule
{
    public  $startDate;
    public  $attr;
    public function __construct($startDate,$attr)
    {
        $this->startDate = $startDate;
        $this->attr = $attr;
    }

    public function passes($attribute, $value)
    {
        if ($value < $this->startDate){
            return false;
        }
        return  true;

    }

    public function message()
    {
        return '【'.$this->attr.'】正しい年月日を入力してください。';

    }
}
