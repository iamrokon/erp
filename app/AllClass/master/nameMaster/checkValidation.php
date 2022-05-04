<?php

namespace App\AllClass\master\nameMaster;

use Illuminate\Contracts\Validation\Rule;

class checkValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $customValue;
    protected $msg;

    public function __construct()
    {
        //$this->customValue = $customValue;
        //$this->customValue2 = $customValue2;
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
      if($value)
      {
          $len = strlen($value);
          $mblen = mb_strlen($value) * 3;
          if($len == $mblen) {
            $this->msg = '【:attribute】 半角数字以外は使用できません。';
            return false;
          }elseif($value=='0' || $value=='1' || $value=='2' || $value=='3' || $value=='4' || $value=='5' || $value=='6' || $value=='7' || $value=='8' || $value=='9' ) {
            return true;
          }else{
            if(is_numeric($value)){
              $this->msg = '';
            }else {
              $this->msg = '【:attribute】 半角数字以外は使用できません。';
            }
            return false;
          }
          // else {
          //   $this->msg = '【:attribute】 に「1」、「２」以外の数字が入力できない。';
          //   return false;
          // }
      }

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->msg;
    }
}
