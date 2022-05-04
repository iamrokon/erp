<?php

namespace App\AllClass\order\orderHistory2;

use Illuminate\Contracts\Validation\Rule;

class CheckOrderbangoRange implements Rule
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
        
        if($this->customValue > $this->customValue2)
        {
            return false;
        }else if($this->customValue == "" && $this->customValue2 != ""){
            return false;
        }else if($this->customValue != "" && $this->customValue2 == ""){
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
        return '【:attribute】受注番号2は受注番号1より大きい番号を入力してください。';
    }
}
