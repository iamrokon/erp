<?php

namespace App\AllClass\master\productSubMaster;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Contracts\Validation\Rule;

class CheckUniqueOther2 implements Rule
{

    public function passes($attribute, $value)
    {
        $result = QueryHelper::fetchSingleResult("select count(*) from others where other2 = '$value'")->count;
        return !(bool) $result;
    }

    public function message()
    {
        return '【商品サブCD】このCDは既に登録されています。';
    }
}
