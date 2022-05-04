<?php

namespace App\AllClass;
use DB;
use App\kengen;
use App\tantousya;
use  App\AllClass\db\QueryHelperFacade as QueryHelper; 

Class menuSetting
{
  public static function setting($user,$bango)
  {

    $tantousya1 = tantousya::find($user);
    $tantousya2 = tantousya::find($bango);
    $masterMenus = kengen::where('kengenchar01','menu-g')
                        ->orderBy('kengenchar05')
                        ->pluck('kengenchar02','kengenchar05')
                        ->toArray();
    $user_def = kengen::where('kengenchar01','user')
                      ->where('kengenchar03','user_def')
                      ->pluck('kengenchar04')
                      ->first();

    $tanto_setting = kengen::where('kengenchar01','user')
                        ->where('kengenchar03',$user)
                        ->pluck('kengenchar04')
                        ->first();

    $user_setting = kengen::where('kengenchar01','user')
                        ->where('kengenchar03',$bango)
                        ->pluck('kengenchar04')
                        ->first();                    

    $accessMenus_tanto = array();
    $accessMenus_user = array();

    if(empty($user_setting)){
      $user_def_1=explode('¶', $user_def);
      foreach ($user_def_1 as $key => $value) {
       $def_setting[$key]=explode('=', $value);
      }
      foreach ($def_setting as $key => $value) {
        if (isset($value[1]) && $value[1]=="GO") {
          array_push($accessMenus_user, $value[0]);
        }
      }
    }else{
      $user_set=explode('¶', $user_setting);

      foreach ($user_set as $key => $value) {
        $def_setting[$key]=explode('=', $value);
      }
      foreach ($def_setting as $key => $value) {
        if (isset($value[1]) && $value[1]=="GO") {
          array_push($accessMenus_user, $value[0]);
        }
      }
    }

    if(empty($tanto_setting)){
      $user_def_2=explode('¶', $user_def);
      foreach ($user_def_2 as $key => $value) {
       $def_setting[$key]=explode('=', $value);
      }
      foreach ($def_setting as $key => $value) {
        if (isset($value[1]) && $value[1]=="GO") {
          array_push($accessMenus_tanto, $value[0]);
        }
      }
    }else{
      $user_set=explode('¶', $tanto_setting);

      foreach ($user_set as $key => $value) {
        $def_setting[$key]=explode('=', $value);
      }
      foreach ($def_setting as $key => $value) {
        if (isset($value[1]) && $value[1]=="GO") {
          array_push($accessMenus_tanto, $value[0]);
        }
      }
    }
//dd($accessMenus_user,$accessMenus_tanto);
    $str_user='(';
    foreach ($accessMenus_user as $key => $value) {
        if ($key == (array_key_last($accessMenus_user))) {
           $str_user=$str_user."'".$value."'".')';
        }else{
           $str_user=$str_user."'".$value."'".',';
        }
      }

    $str_tanto='(';
    foreach ($accessMenus_tanto as $key => $value) {
        if ($key == (array_key_last($accessMenus_tanto))) {
           $str_tanto=$str_tanto."'".$value."'".')';
        }else{
           $str_tanto=$str_tanto."'".$value."'".',';
        }
      }  
//dd($str_user,$str_tanto);
$menu_set=QueryHelper::fetchResult("select kengenchar02,kengenchar05 from kengensettei where  kengenchar01='menu-g'
    order by kengenchar05");
$menu_set_arr=[];
foreach ($menu_set as $key => $value) {
   $menu_set_arr[$value->kengenchar02]=$value->kengenchar05;
}
if($tantousya1){
  if (empty($tanto_setting)) {
  $tanto_set=QueryHelper::fetchResult("select kengenchar02,kengenchar05 from kengensettei where 
    kengenint06 >= '$tantousya1->innerlevel' 
    and kengenchar05 IN $str_tanto and kengenchar01='menu'
    order by kengenchar05");
}else{
  $tanto_set=QueryHelper::fetchResult("select kengenchar02,kengenchar05 from kengensettei 
    where kengenchar05 IN $str_tanto and kengenchar01='menu'
    order by kengenchar05");
}

$tanto_set_arr=array();
foreach ($tanto_set as $key => $value) {
   array_push($tanto_set_arr, $value->kengenchar05);

}
}else{
  $tanto_set_arr=array();
}



if (empty($user_setting)) {
  $user_set=QueryHelper::fetchResult("select kengenchar02,kengenchar05 from kengensettei where 
    kengenint06 >= '$tantousya2->innerlevel' and kengenchar05 IN $str_user and kengenchar01='menu'
    order by kengenchar05");
}else{
    if($tantousya2){
        $user_set=QueryHelper::fetchResult("select kengenchar02,kengenchar05 from kengensettei
        where kengenchar05 IN $str_user and kengenchar01='menu'
        and kengenint06 >= '$tantousya2->innerlevel'
        order by kengenchar05");
    }else{
        $user_set=QueryHelper::fetchResult("select kengenchar02,kengenchar05 from kengensettei
        where kengenchar05 IN $str_user and kengenchar01='menu'
        order by kengenchar05");
    }
}
$menus=[];
foreach ($menu_set_arr as $key => $value) {
   foreach ($user_set as $k => $val) {
      //dd($key,$value,$k,$val);
    if (explode('-', $val->kengenchar05)[0]==$value) {
      if(in_array($val->kengenchar05, $tanto_set_arr)){
        $menus[$key.','.$value][$val->kengenchar05]=$val->kengenchar02.','.'GO';
      }else{
        $menus[$key.','.$value][$val->kengenchar05]=$val->kengenchar02.','.'NG';
      }
    }
      
   }
}

    return $menus;
  }
}
