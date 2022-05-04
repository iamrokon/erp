<?php

namespace App\AllClass\master\creditMaster;

use DB;
use App\syouhin1;
use App\Kakaku;


Class CreditSort{
  public static function sort($tableName, $request, $bango)
  {
//dd($request);
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
//dd($request);
        $data=$tableName->where(function($q) use($request){
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
                        if ($value != null && (preg_match('/[\'><>*=+]/', $value) == false) ) {
                            $p->where($key,'LIKE', "%$value%");
                        }
                   }
               })->orderBy($field, $order);

      /*  if ($field !== null) {
          session()->put('sortField'.$bango,$field);
        }
        if ($order !== null) {
          session()->put('sortType'.$bango,$order);
        } */

         return $data;
  }
}
