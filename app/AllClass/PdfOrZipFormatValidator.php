<?php


namespace App\AllClass;


use Illuminate\Contracts\Validation\Rule;

class PdfOrZipFormatValidator implements Rule
{

    /**
     * @inheritDoc
     */
    public function passes($attribute, $value)
    {
        if (preg_match('/\.(zip|pdf)$/i',$value))
        {
            return true;
        }
        else
            return false;
    }

    /**
     * @inheritDoc
     */
    public function message()
    {
        return "【:attribute】 zip pdf のみOK。";
    }
}
