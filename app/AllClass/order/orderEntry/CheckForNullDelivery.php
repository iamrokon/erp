<?php


namespace App\AllClass\order\orderEntry;


use Illuminate\Contracts\Validation\Rule;

class CheckForNullDelivery implements Rule
{

    public $line;
    public $branch;
    public $msg;

    public function passes($attribute, $value)
    {

        $position = isset(explode('.', $attribute)[1])  ? explode('.', $attribute)[1] : null;
        $line = request("line.$position");
        $this->line = $line;
        $branch = request("branch.$position");
        $this->branch = $branch;
        $shyohinColor =  request("shoyin_color.$position");
        $deliveryMethod =  request("deliveryMethod.$position");
        $se = str_replace(',', '', request("se.$position"));
        $institute = str_replace(',', '', request("institute.$position"));
        $ship = str_replace(',', '', request("ship.$position"));
        //dd($position, $line, $branch, $shyohinColor, $deliveryMethod, $se, $institute, $ship);
        //G300
        // dd($this->branch, $this->line);
        $isNullDelivery =  $deliveryMethod == 'G300' || is_null($deliveryMethod);
        // $nullCheckQuantity = ($se > 0 || $institute > 0 || $ship > 0);
        // || ($isNullDelivery && $nullCheckQuantity)
        if (($shyohinColor == 'G310' && $isNullDelivery)) {
            if ($shyohinColor == 'G310' && $isNullDelivery) {
                $this->msg = "の納品方法は必須です";
            }
            // else {
            //     $this->msg = "の納品方法が（空欄）ですが、よろしいですか？";
            // }
            return false;
        }
        return true;
    }

    public function message()
    {
        return "【" . $this->line . " - " . $this->branch . "】" . $this->msg;
    }
}
