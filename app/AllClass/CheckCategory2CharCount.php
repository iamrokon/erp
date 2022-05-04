<?php

namespace App\AllClass;

use Illuminate\Contracts\Validation\Rule;
use DB;

class CheckCategory2CharCount implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $cat2;


    public function  __construct($cat2)
    {
        $this->cat2 = $cat2;
    }


    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $cat2=$this->cat2;

	   if($cat2 != '')
        {
            if(strlen($cat2) == $value || mb_strlen($cat2) == $value)
            {
                return true;
            }else{
                return false;
            }


        }else{
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
        return '【:attribute】入力した分類CDの桁数が分類CD桁数と一致しません。';
    }
}
