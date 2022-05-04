<?php
namespace App\AllClass\other\grossProfitAdjustmentInput;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\Helpers\Helper;
use Illuminate\Contracts\Validation\Rule;
use \Carbon\Carbon;

class CheckDate implements Rule
{
    public $date;
    public function __construct($date)
    {
        $this->date = $date;
    }
    public function passes($attribute, $value)
    {
        $date = $this->date;
        $isInThisMonth = Carbon::createFromFormat('Y/m/d',$date, "Asia/Tokyo")->isCurrentMonth();     
        $orderBango = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7503'")->orderbango ?? null;
        // dd($date, $isInThisMonth, $orderBango);
        return ($isInThisMonth && $value > $orderBango);
    }

    public function message()
    {
        return "【:attribute】日付の入力が適切ではありません";
    }
}
