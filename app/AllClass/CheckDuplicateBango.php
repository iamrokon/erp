<?php


namespace App\AllClass;


use App\tantousya;
use Illuminate\Contracts\Validation\Rule;

class CheckDuplicateBango implements Rule
{

    /**
     * @inheritDoc
     */
    public function passes($attribute, $value)
    {

        if (strlen($value) < 4) {
        $value = sprintf("%04d", $value);
    }
        $bangoExist = tantousya::where('bango',$value)->get();
        if(count($bangoExist)){
            return false;
        }
        return true;

    }

    /**
     * @inheritDoc
     */
    public function message()
    {
        return '【:attribute】同:attributeが存在します。';

    }
}
