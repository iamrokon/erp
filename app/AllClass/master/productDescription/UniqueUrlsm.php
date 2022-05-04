<?php


namespace App\AllClass\master\productDescription;


use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Contracts\Validation\Rule;

class UniqueUrlsm implements Rule
{
    public $urlsm;
    public function __construct($urlsm)
    {
        $this->urlsm = $urlsm;

    }

    public function passes($attribute, $value)
    {
        $urlsm = $this->urlsm;
        $res = (bool) QueryHelper::fetchSingleResult("select count(urlsm) from gazou where urlsm = '".$urlsm."' and hyouji = 0 ")->count ?? 0;
        return ! $res;
    }

    public function message()
    {
        return '【:attribute】このCDは既に登録されています。';

    }
}
