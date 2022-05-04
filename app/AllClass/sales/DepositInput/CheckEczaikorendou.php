<?php


namespace App\AllClass\sales\DepositInput;


use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Contracts\Validation\Rule;

class CheckEczaikorendou implements Rule
{

    public function passes($attribute, $value)
    {
        $sitename = request($attribute);
        $eczaikorendou = QueryHelper::fetchSingleResult("select rendoumail,tsuchimail from eczaikorendou where sitename = '$sitename'");
        $rendoumail = $eczaikorendou->rendoumail;
        $tsuchimail = $eczaikorendou->tsuchimail;
        if ($rendoumail == 1 || $tsuchimail == 1) {
            return false;
        }
        return true;
    }

    public function message()
    {
        return "【:attribute】すでに確定済のため、入金情報の訂正はできません。";
    }
}
