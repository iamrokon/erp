<?php

namespace App\AllClass\master\creditMaster;

use DB;
use App\tantousya;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

Class CreditSearch1{
  public static function search($tableName, $request, $bango)
  {

      foreach ($request as $key => $value) {
            if ($key == "sortField") {
            $field=$request[$key];
             unset ($request[$key]);
           }

        if ($key == "sortType") {
            $order=$request[$key];
            unset ($request[$key]);
           }
        }

        $data=$tableName->where(function($q) use($request,$bango){
            foreach ($request as $key => $value) {
                if (strpos($value, '=') === 0) {
                    if (strpos($value, '*') !== false) {
                        $value=str_replace("=", "", $value);
                        $values=explode("*",$value);
                        $q->where(function($s) use($values, $key){
                            foreach ($values as $k => $val) {
                                $s->orWhere($key,'LIKE', "%$val%");
                            }
                        });
                    }
                    else
                    {
                        $values=str_replace("=", "", $value);
                        if ($values=="" OR $values== null) {
                            $q->whereNull($key);
                        }
                        else{
                            $q->where($key, "$values");
                        }

                    }
                }

                elseif (strpos($value, '>=') !== false) {
                    $field=$key;
                    session()->put('storeinformationorder'.$bango,$field);
                    session()->put('storeinformationorder'.$bango,'DESC');

                    $values=explode(">=",$value,2);
                    if (strpos($value, '>=') === 0) {
                        $q->where($key,'>=', !empty($values[1])?$values[1]:0);
                    }
                    else
                        $q->where($key,'<=', $values[0])
                            ->where($key,'>=', $values[1]);

                }
                elseif (strpos($value, '<=') !== false) {
                    $field=$key;
                    session()->put('storeinformationfield'.$bango,$field);
                    session()->put('storeinformationorder'.$bango,'ASC');
                    $values=explode("<=",$value,2);
                    if (strpos($value, '<=') === 0) {
                        $q->where($key,'<=', !empty($values[1])?$values[1]:0);
                    }
                    else
                        $q->where($key,'>=', $values[0])
                            ->where($key,'<=', $values[1]);

                }
                elseif (strpos($value, '<>') === 0) {
                    $values=explode("<>",$value,2);
                    $q->where($key,'<>', !empty($values[1])?$values[1]:0);
                }
                elseif (strpos($value, '>') !== false) {
                    $field=$key;
                    session()->put('storeinformationfield'.$bango,$field);
                    session()->put('storeinformationorder'.$bango,'DESC');

                    $values=explode(">",$value,2);

                    if (strpos($value, '>') === 0) {
                        $q->where($key,'>', !empty($values[1])?$values[1]:0);
                    }
                    else
                        $q->where($key,'<', $values[0])
                            ->where($key,'>', $values[1]);
                }
                elseif (strpos($value, '<') !== false) {
                    $field=$key;
                    session()->put('storeinformationfield'.$bango,$field);
                    session()->put('storeinformationorder'.$bango,'ASC');
                    $values=explode("<",$value,2);

                    if (strpos($value, '<') === 0) {
                        $q->where($key,'<', !empty($values[1])?$values[1]:0);
                    }
                    else
                        $q->where($key,'>', $values[0])
                            ->where($key,'<', $values[1]);
                }
                elseif (strpos($value, '*') !== false) {
                    $values=explode("*",$value);
                    $q->where(function($s) use($values, $key){
                        foreach ($values as $k => $val) {
                            $s->orWhere($key,'LIKE', "%$val%");
                        }
                    });
                }
                elseif (strpos($value, '+') !== false) {
                    $values=explode("+",$value);
                    $q->where(function($s) use($values, $key){
                        foreach ($values as $k => $val) {
                            $s->where($key,'LIKE', "%$val%");
                        }
                    });
                }
            }
        })->where(function($p) use($request){
            foreach ($request as $key => $value) {
                if ($value != null && (preg_match('/[\'><>*=+]/', $value) == false)) {
                    $p->where($key,'LIKE', "%$value%");
                }
            }
        });

        ///////////////// sorting according to greater than less than/////////////////
        $tempfield=session()->pull('storeinformationfield'.$bango);
        $tempOrder=session()->pull('storeinformationorder'.$bango);
        if ($tempfield!=null) {
           $field=$tempfield;
        }
        if ($tempOrder!=null) {
           $order=$tempOrder;
        }


        if (isset($field) && isset($order)) {

           $dataSort=$data->orderBy($field, $order);
            return $dataSort;
        }
        else{

            return $data;
        }
  }
}
