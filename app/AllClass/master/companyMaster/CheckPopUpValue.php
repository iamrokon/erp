<?php

namespace App\AllClass\master\companyMaster;

use Illuminate\Contracts\Validation\Rule;

class CheckPopUpValue implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $customValue;

    public function __construct($customValue)
    {
        $this->customValue = $customValue;
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
		
	   
	  // echo $this->customValue;exit;
        if($this->customValue=="")
        {
            return false;
        }else{
            return true;
        }
       
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '【:attribute】Invalid Input Data。';
    }
}
