<?php
namespace App\AllClass\purchase\purchaseInput;

use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Contracts\Validation\Rule;

class OrderNumberCheck implements Rule
{

    public function __construct()
    {
        
    }

    public function passes($attribute, $value)
    {
        // $orderNumber = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7504'")->orderbango ?? null;
        // return $value > $orderBango;
        $value = (string)$value;
        if(strlen($value) < 13){
            return false;
        }
        else {
            $syouhinid = substr($value, 0, 10);
            $syouhinsyu = substr($value, 10, 3);
            $query = "select * from minyuko where syouhinid = '$syouhinid' and syouhinsyu = '$syouhinsyu'" ;
            $orderNumber= QueryHelper::fetchSingleResult($query) ?? null;
            if($orderNumber){
                return true;
            }else {
                return false;
            }
        }
    }

    public function message()
    {
        // return "【:attribute】仕入日が仕入確定済です。";
        return "該当するデータがありません。";
    }
}
