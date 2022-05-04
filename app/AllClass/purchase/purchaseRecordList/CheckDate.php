<?php

namespace App\AllClass\purchase\purchaseRecordList;

use Illuminate\Contracts\Validation\Rule;

class CheckDate implements Rule
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
        $date1 = strtotime($this->customValue);
        $date2 = strtotime($this->customValue2);
        $diff = abs($date2 - $date1);
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24)/(30*60*60*24));

        if($years == 0)
        {
            if($months >= 6)
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        return false;
       
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '【:attribute】システム負荷著しく高くなり他のユーザーに悪影響を与えてしまいます。';
    }
}
