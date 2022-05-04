<?php

namespace App\AllClass\master\companyMaster;

use Illuminate\Contracts\Validation\Rule;

class CheckSameValue implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $customValue;
    protected $customValue2;

    public function __construct($customValue,$customValue2)
    {
        $this->customValue = $customValue;
        $this->customValue2 = $customValue2;
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
        if($this->customValue==1 && $this->customValue2==1)
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
        return '【:attribute】入力が間違っています。';
    }
}
