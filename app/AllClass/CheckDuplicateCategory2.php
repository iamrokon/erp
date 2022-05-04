<?php

namespace App\AllClass;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Contracts\Validation\Rule;
use DB;

class CheckDuplicateCategory2 implements Rule
{
    public $symbolError;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $cat1;
    protected $cat2;


    public function __construct($cat1, $cat2)
    {
        $this->cat1 = $cat1;
        $this->cat2 = $cat2;
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
        $arrSymbol = [",", "'", '"', "!", "%", "&", "aname_error_dataEditress", "*", "¥", "\\", "+", "="];
        foreach ($arrSymbol as $arr) {
            if (strpos($value, $arr) !== false) {
                $this->symbolError = true;
                return false;
            }
        }

        $cat1 = $this->cat1;
        $cat2 = $this->cat2;

        if ($cat2 != '') {

            $category_data = QueryHelper::fetchSingleResult("select count (*) from categorykanri where category1 = '$cat1' and category2 = '$cat2'")->count;
            //DB::table('categorykanri')->where('category1',$cat1 )->where('category2', $cat2)->get();
            if ($category_data > 0) {
                return false;
            } else {
                return true;
            }


        } else {
            return false;
        }

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if ($this->symbolError) {
            return '【:attribute】[,][*][=][\'][".\'"][!][¥][+][&][%]は使用できません。';
        }
        return '【:attribute】すでに登録されているコードです。';
    }
}
