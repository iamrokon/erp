<?php


namespace App\AllClass\master\productDescription;


use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Contracts\Validation\Rule;

class CheckForProductOrProductSub implements Rule
{
    public $valueOfProductOrProductSub;

    public function __construct($value)
    {
        $this->valueOfProductOrProductSub = $value;
    }

    /**
     * @inheritDoc
     */
    public function passes($attribute, $value)
    {
        if ($this->valueOfProductOrProductSub == '商品') {
            $hasValue = QueryHelper::fetchSingleResult("select count(*) from syouhin1 where kokyakusyouhinbango = '$value'")->count;
            if ($hasValue) {
                return true;
            }
        } elseif ($this->valueOfProductOrProductSub == '商品サブ') {
            $hasValue = QueryHelper::fetchSingleResult("select count(*) from others where other2 = '$value'")->count;
            if ($hasValue) {
                return true;
            }
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function message()
    {
//        if ($this->valueOfProductOrProductSub == '商品') {
//            return "【:attribute】「商品」を選択した場合は5桁 ";
//        } elseif ($this->valueOfProductOrProductSub == '商品サブ') {
//            return "【:attribute】「商品サブ」を選択した場合は10桁";
//        }
        return "【:attribute】該当するデータがありません。";
    }
}
