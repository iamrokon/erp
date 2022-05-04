<?php


namespace App\AllClass\master\productDescription;


use Illuminate\Contracts\Validation\Rule;

class CheckProductionDescriptionCd implements Rule
{
    public $valueOfProductOrProductSub;

    public function __construct($value)
    {
        $this->valueOfProductOrProductSub = $value;
    }

    /**
     * @inheritDoc
     */
    public function passes($attribute, $value)
    {
        if ($this->valueOfProductOrProductSub == '商品') {
            if (strlen($value) != 5) {
                return false;
            }
        } elseif ($this->valueOfProductOrProductSub == '商品サブ') {
            if (strlen($value) != 10) {
                return false;
            }
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function message()
    {
        if ($this->valueOfProductOrProductSub == '商品') {
            return "【:attribute】5桁で入力してください。";
        } elseif ($this->valueOfProductOrProductSub == '商品サブ') {
            return "【:attribute】10桁で入力してください。";
        }
    }
}
