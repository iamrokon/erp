<?php


namespace App\AllClass\master\customerProduct;


use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Contracts\Validation\Rule;

class UniqueCustomerProduct implements Rule{

    public $syutenjyouken;
    public $syutenbi;
    public $icon;

    /**
     * UniqueCustomerProduct constructor.
     * @param $syutenjyouken
     * @param $syutenbi
     * @param $icon
     */
    public function __construct($syutenjyouken, $syutenbi, $icon)
    {
        $this->syutenjyouken = $syutenjyouken;
        $this->syutenbi = $syutenbi;
        $this->icon = $icon;
    }

    public function passes($attribute, $value)
    {
        return ! (bool) QueryHelper::fetchSingleResult("select count(*) from kakaku where syutenjyouken = '$this->syutenjyouken' and syutenbi = '$this->syutenbi' and icon = '$this->icon' ")->count ;
    }

    public function message()
    {
        return "「 同じ会社CD、商品CD,単価区分の価格が登録済みです。変更画面から変更してください。」";

    }
}
