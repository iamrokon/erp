<?php


namespace App\AllClass;


use Illuminate\Contracts\Validation\Rule;

class CheckValueLessThan implements Rule
{
    private $basic_setting;
    private $pb_sales;

    public function __construct($request)
    {
        $this->basic_setting = $request['basic_selling'];
        $this->pb_sales = $request['pb_sales'];
    }

    /**
     * @inheritDoc
     */
    public function passes($attribute, $value)
    {
      if($value > $this->basic_setting || $value > $this->pb_sales){
          return false;
      }
      return true;
    }

    /**
     * @inheritDoc
     */
    public function message()
    {
       return '【:attribute】合計金額がPB販売価格を上回っています。';
    }
}
