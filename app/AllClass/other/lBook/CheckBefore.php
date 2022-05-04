<?php

namespace App\AllClass\other\lBook;

use Illuminate\Contracts\Validation\Rule;

class CheckBefore implements Rule
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
        $this->customValue = (int)$customValue;
        $this->customValue2 = (int)$customValue2;
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
		
        if($this->customValue > $this->customValue2){
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
        return '【:attribute】正しい年月日を入力してください。';
    }
}
