<?php


namespace App\AllClass\order\orderEntry;


use Illuminate\Contracts\Validation\Rule;

class FieldRequiredWhenGreaterThanZero implements Rule
{
    public $fieldName;

    public function __construct($fieldName)
    {
        $this->fieldName = $fieldName;

    }

    public function passes($attribute, $value): bool
    {
        $index = explode('.', $attribute)[1];
        $fieldValue = (int) request($this->fieldName . '.' . $index);
        $status = !($fieldValue > 0 ) || request($attribute) != null;
        return $status;
    }

    public function message(): string
    {
        return "【:attribute】必須項目に入力がありません。";
    }
}
