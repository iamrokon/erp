<?php


namespace App\AllClass\master\productDescription;


use Illuminate\Contracts\Validation\Rule;

class CheckMaxLengthAfterRemoveNewLine implements Rule
{
    public $maxLength;

    public function __construct($maxLength)
    {
        $this->maxLength = $maxLength;
    }

    public function passes($attribute, $value)
    {
        if (!empty($value)) {
            $lineBreakLen = count(explode("\r\n",$value));
            if (strpos($value, "\r\n")) {
                $value = str_replace(array("\n", "\r"), '', $value);
            }
            $len = (strlen($value) / 3) + $lineBreakLen;
            return $len < $this->maxLength;
        }
        return  true;
    }

    public function message()
    {
        return "【:attribute】$this->maxLength 桁以下で入力してください。";

    }
}
