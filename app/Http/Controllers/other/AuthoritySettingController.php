<?php

namespace App\Http\Controllers\other;

use App\Http\Controllers\Controller;
use App\tantousya;
use App\kengen;
use App\AllClass\menuSetting;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

class AuthoritySettingController extends Controller
{
    public function gotoPage()
    {
      //dd(request('search_val'));
    	$bango = request('userId');
        
        $user_def_menus = self::default_menus();
        $selected_user = request('user');
        $tantousya = tantousya::find($bango);
        $level = $tantousya->innerlevel;
        $search_val = request('search_val');
        if($search_val){
          $users = QueryHelper::fetchResult("select * from tantousya where innerlevel >= 10 and innerlevel >= $level and name LIKE '%$search_val%' and deleteflag=0");
        }else {
          $users = QueryHelper::fetchResult("select * from tantousya where innerlevel >= 10 and innerlevel >= $level and deleteflag=0");
        }


        if (request('saveButton') == 'save' && $selected_user!=NULL)
        {
            $all_menu_ids = self::all_menus();
            $settings = '';
            foreach ($all_menu_ids as $key => $value)
            {
                if (request($value)!=NULL) {
                    $settings.= $value.'=GO¶';
                }
                else{
                    $settings.= $value.'=NG¶';
                }
            }

            $data_exists = kengen::where('kengenchar01','user')
                          ->where('kengenchar03',request('user'))
                          ->first();


            if ($data_exists == NULL)
            {
                $menuset = new kengen;
                $menuset->kengenchar01 = 'user';
                $menuset->kengenchar03 = request('user');
                $menuset->kengenchar04 = $settings;
                $menuset->save();
            }
            else
                kengen::where('kengenchar01','user')
                          ->where('kengenchar03',request('user'))
                          ->update([
                          'kengenchar04' => $settings]);
        }
        $menus = menuSetting::setting($selected_user,$bango);

        // $menus = self::selected_menus($selected_user);
        return view('others.authority_setting',compact('bango','user_def_menus','tantousya','menus','users','selected_user','search_val'));

    }


    private static function all_menus()
    {
        $array = kengen::where('kengenchar01','menu')
                             ->orderby('kengenchar05','ASC')
                             ->pluck('kengenchar05')
                             ->toArray();
        return $array;
    }
    private static function default_menus()
    {
        $user_def = kengen::where('kengenchar01','user')
                      ->where('kengenchar03','user_def')
                      ->pluck('kengenchar04')
                      ->first();
        $return_array = array();
        $temp_array = explode("¶", $user_def);
        foreach($temp_array as $value)
        {
            if(strpos($value, "=GO")!==false)
            {
                $return_array[] = explode("=GO", $value)[0];
            }
        }
        return $return_array;
    }

    // private static function selected_menus($selected_user)
    // {
    //     $user_setting=kengen::where('kengenchar01','user')
    //                       ->where('kengenchar03',$selected_user)
    //                       ->pluck('kengenchar04')
    //                       ->first();
    //     if($user_setting==NULL)
    //         $user_setting=kengen::where('kengenchar01','user')
    //                       ->where('kengenchar03','user_def')
    //                       ->pluck('kengenchar04')
    //                       ->first();
    //     $masterMenus = kengen::where('kengenchar01','menu-g')
    //                          ->orderby('kengenchar05','ASC')
    //                          ->pluck('kengenchar02','kengenchar05')
    //                          ->toArray();

    //     foreach ($masterMenus as $key => $value)
    //     {
    //         $menu_list = kengen::whereRaw('kengenchar01 = \'menu\'')
    //                             ->whereRaw('kengenchar05 LIKE \''.$key.'-%\'')
    //                             ->orderby('kengenchar05','ASC')
    //                             ->pluck('kengenchar02','kengenchar05')
    //                             ->toArray();
    //         foreach($menu_list as $k=>$v)
    //         {
    //             if($selected_user!=NULL&&strpos($user_setting, $k.'=GO')!==false)
    //                 $arr[$value.','.$key][$k] = $v.',GO';
    //             else $arr[$value.','.$key][$k] = $v.',NG';
    //         }
    //     }
    //     return $arr;
    // }
}
