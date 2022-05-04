<?php


namespace App\AllClass\master\productMaster;


use App\tantousya;
use Illuminate\Contracts\Validation\Rule;

class ValidateRange implements Rule
{

    protected $val;
    protected $field;


    public function __construct($val, $field)
    {
        $this->val = $val;
        $this->field = $field;
    }
    public function passes($attribute, $value)
    {

        if($this->val<0){
            return false;
        }else{
            return true;
        }

    }

    /**
     * @inheritDoc
     */
    public function message()
    {
        return $this->field.'より大きい金額は入力できません。';

    }
}
