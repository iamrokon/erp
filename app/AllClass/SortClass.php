<?php

namespace App\AllClass;

use DB;
use App\tantousya;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

Class SortClass{ 
  public static function sort($tableName, $request, $bango,$temp_table)
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
$test=DB::select(DB::raw("select column_name, data_type from information_schema.columns
 where table_name='$temp_table';"));
$columnArray=[];
foreach ($test as $key => $value) 
{
    $columnArray[$value->column_name]=$value->data_type;
}
        $data=$tableName->where(function($q) use($request,$columnArray){
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
                        
                            if($columnArray[$key] == 'integer' OR $columnArray[$key] == 'smallint' OR $columnArray[$key] == 'double precision')
                            {
                              if ($values=="" OR $values== null) 
                              {
                                  $q->Where($key,null);
                              }
                              else
                              {
                                  $q->where($key,$values);
                              }  
                              
                            }
                            elseif ($columnArray[$key] == 'text' || $columnArray[$key] == 'character varying' || $columnArray[$key] == 'character' || $columnArray[$key] == 'string')
                            {

                              if ($values=="" OR $values== null) 
                              {
                                  $q->Where($key,null);
                              }
                              else
                              {
                                  $q->where($key,$values);

                              }
                               
                            } 
                            else
                            {

                              if ($values=="" OR $values== null) 
                              {
                                
                                  $q->Where($key,null);

                              }
                              else
                              {
                                  $q->where($key,$values);
                              }
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

                      if($columnArray[$key] == 'integer' OR $columnArray[$key] == 'smallint' OR $columnArray[$key] == 'double precision')
                      {
                          if ($values[1] == "" or $values[1] == null)
                          {
                              $q->where($key,'<>',null);
                          }
                          else
                          {
                              $q->where($key,'<>',$values[1]);
                          }

                      }
                      elseif ($columnArray[$key] == 'text' || $columnArray[$key] == 'character varying' || $columnArray[$key] == 'character' || $columnArray[$key] == 'string')
                      {
                          if ($values[1] == "" or $values[1] == null)
                          {
                              $q->where($key,'<>',null);
                          }
                          else
                          {
                              $q->where($key,'<>',$values[1]);
                          }

                      }
                      else
                      {
                          if ($values[1] == "" or $values[1] == null)
                          {
                              $q->where($key,'<>',null);
                          }
                          else
                          {
                              $q->where($key,'<>',$values[1]);
                          }

                      }
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
                        if ($value != null && (preg_match('/[\'><>*=+]/', $value) == false) && $key != 'passwd') {
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
