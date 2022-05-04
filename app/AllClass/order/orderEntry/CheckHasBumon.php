<?php


namespace App\AllClass\order\orderEntry;


use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Contracts\Validation\Rule;

class CheckHasBumon implements Rule
{
    public $errorMessage;

    public function passes($attribute, $value)
    {
        $shyohin = QueryHelper::fetchSingleResult("select data100,bumon  from syouhin1 where kokyakusyouhinbango='$value'  ");
        if (!$shyohin) {
            return  true;
        }
        $data100 = $shyohin->data100 ?? null;
        if ($data100 != 'D131') {
            return true;
        }
        $bumon = $shyohin->bumon ?? null;
        $category1 = $bumon ? substr($bumon, 0, 2) : null;
        $category2 = $bumon ? substr($bumon, 2, strlen($bumon)) : null;
        $patternsub2 = ($category2 && $category2) ?  QueryHelper::fetchSingleResult("select * from categorykanri where category1 like '%$category1%' and category2 like '%$category2%'")->patternsub2 ?? null : null;
        //dd($category1, $category2, $bumon, $patternsub2);

    
        // if (!is_null($bumon) && is_null($patternsub2) &&  is_null($category1) && is_null($category2)) {
        //     $this->errorMessage = "商品マスタ：販売形態の名称マスタ：予備２が取得できません。";
        //     return false;
        // }
        if (!is_null($bumon) && !is_null($category1) && !is_null($category2) && is_null($patternsub2)) {
            $this->errorMessage = "商品マスタ：販売形態の名称マスタ：予備２が取得できません。";
            return false;
        }
        if (!is_null($bumon) && !is_null($category1) && !is_null($category2) &&  !is_numeric($patternsub2)) {
            $this->errorMessage = "商品マスタ：販売形態の名称マスタ：予備２が取得できません。";
            return false;
        }

        return true;
    }

    public function message()
    {
        return "【:attribute】$this->errorMessage";
    }
}
