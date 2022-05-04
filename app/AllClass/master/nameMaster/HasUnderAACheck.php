<?php

namespace App\AllClass\master\nameMaster;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Contracts\Validation\Rule;
use App\categorykanri;

class HasUnderAACheck implements Rule
{
    public $symbolError;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $arrSymbol = [",", "'", '"', "!", "%", "&", "address", "*","¥","\\","+","="];

        if (!empty($value)) {
            foreach ($arrSymbol as $arr) {
                if (strpos($value, $arr) !== false) {
                    $this->symbolError = true;
                    return false;
                }
            }
            $checkExistence = QueryHelper::fetchSingleResult("select * from categorykanri where category1 = 'AA' and category2 = '$value'");
            if ($checkExistence != null) {
                return true;
            } elseif ($value == "AA") {
                return true;
            } else return false;
        }

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if ($this->symbolError){
            return '【:attribute】[,][*][=][\'][".\'"][!][¥][+][&][%]は使用できません。';
        }
        return '【:attribute】not match with aa';
    }
}
