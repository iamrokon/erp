<?php

namespace App\AllClass;

Class Converter
{
    public static function to_zenkaku($str)
    {
        $search = ['1','2','3','4','5','6','7','8','9','0','/'];
        $replace = ['１','２','３','４','５','６','７','８','９','０','／'];
        return str_replace($search , $replace , $str);
    }
}
