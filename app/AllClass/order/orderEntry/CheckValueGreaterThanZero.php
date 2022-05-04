<?php


namespace App\AllClass\order\orderEntry;


use Illuminate\Contracts\Validation\Rule;

class CheckValueGreaterThanZero implements Rule
{
    public $fieldValue;
    public $checkWith;

    /**
     * CheckValueGreaterThanZero constructor.
     * @param $fieldValue
     * @param $checkWith
     */
    public function __construct($fieldValue, $checkWith)
    {
        $this->fieldValue = $fieldValue;
        $this->checkWith = $checkWith;
        dd($fieldValue,$checkWith);
    }

    public function passes($attribute, $value)
    {
        // TODO: Implement passes() method.
    }

    public function message()
    {
        // TODO: Implement message() method.
    }
}
