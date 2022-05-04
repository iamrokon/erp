<?php

namespace App\AllClass\order\orderEntry;
use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use \Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class CheckSameTimeRequest implements Rule
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
        
	$orderhenkanData = QueryHelper::fetchSingleResult("select date,ordertypebango2 from orderhenkan where kokyakuorderbango = '$this->customValue2' ORDER BY bango DESC");
       
        if($orderhenkanData){
            $orderhenkan_date = $orderhenkanData->date;
            $ordertypebango2 = $orderhenkanData->ordertypebango2;
            $date = Carbon::now()->format('Y-m-d H:i:s');
            //$orderhenkan_date = $this->customValue;
            if($orderhenkan_date == $date || ((int)$ordertypebango2 == (int)($this->customValue) + 1) ){
                return false;
            }else{
                return true;
            }  
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
        return '当データは、既に他の方によって内容が変更されていますので、再度、データの選択からやり直してください。';
    }
}
