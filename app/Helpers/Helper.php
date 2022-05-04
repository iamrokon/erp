<?php
namespace App\Helpers;

use App\tantousya;
use App\kengen;
use Carbon\Carbon;

class Helper
{
    public static function getSystemIP()
    {
        $ip = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : null;
        $modifiedIP = explode(',', $ip);
        $finalIP = $modifiedIP[array_key_last($modifiedIP)];
        return $finalIP;
    }

    //get parent menu  access
    public static function getRootMenuAccessStatus($bango, $page_no)
    {
        $rootMenus = session()->has('root-menu-'.$bango) ? session()->get('root-menu-'.$bango) :  [];
        if (!session()->has('root-menu-'.$bango)){
            $tantousya = tantousya::find($bango);
            $kengens = kengen::where('kengenchar01', "menu-g")->where('kengenint06','>=',$tantousya->innerlevel)->get();
            foreach ($kengens as $kengen){
                array_push($rootMenus,$kengen->kengenchar05);
            }
            session()->put('root-menu-'.$bango,$rootMenus);
        }
        return in_array($page_no,$rootMenus);

    }

    //get child menu access
    

   /* public static function getChildMenuAccessStatus($bango, $page_no)
    {
        $childMenus = session()->has('child-menu-'.$bango) ? session()->get('child-menu-'.$bango) :  [];
        if (!session()->has('child-menu-'.$bango)) {
            $tantousya = tantousya::find($bango);
            $kengen = kengen::where('kengenchar01', "user")->where('kengenchar03', $bango)->first();
            if (!$kengen) {
                $kengen_default = kengen::where('kengenchar01', "user")->where('kengenchar03', 'user_def')->first();
                if ($kengen_default && strpos($kengen_default->kengenchar04, $page_no . "=GO") !== false) {
                    $kengens = kengen::where('kengenchar01', "menu")->where('kengenint06', '>=', $tantousya->innerlevel)->get();
                    foreach ($kengens as $kengen) {
                        array_push($childMenus, $kengen->kengenchar05);
                    }
                }

            } else if (strpos($kengen->kengenchar04, $page_no . "=GO") !== false) {
                $kengens = kengen::where('kengenchar01', "menu")->where('kengenint06', '>=', $tantousya->innerlevel)->get();
                foreach ($kengens as $kengen) {
                    array_push($childMenus, $kengen->kengenchar05);
                }
            }
            session()->put('child-menu-'.$bango, $childMenus);
        }
        return in_array($page_no,$childMenus);

    }*/
    
    public static function getChildMenuAccessStatus($bango)
    {
        $kengen = kengen::where('kengenchar01', "user")->where('kengenchar03', $bango)->first();
        if (empty($kengen)) {
            $kengen = kengen::where('kengenchar01', "user")->where('kengenchar03', 'user_def')->first();
        }
        $setting=[];

        $explode=explode('¶', $kengen->kengenchar04);
      
        foreach ($explode as $key => $value) {
            if ($value!="") {
                $setting[explode('=', $value)[0]]=explode('=', $value)[1];
            }
            
        }
        return $setting;

    }
    public static function getCurrentTime()
    {
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        return str_replace(" ", "", $mytime);
    }

    public static function formatMulDimForm($rows): array
    {
        if (!count($rows)) {
            return [];
        }

        $data = [];

        $keys = collect($rows)->keys()->toArray();

        $iters = $rows[$keys[0]];

        foreach ($iters as $idx => $iter) {
            foreach ($keys as $key) {
                $data[$idx][$key] = $rows[$key][$idx];
            }
        }

        return $data;
    }

    public static function replaceSpecificString($subject, $search, $replace = '')
    {
        if (mb_strpos($subject, $search)) {
            return str_replace($search, $replace, $subject);
        }
        return $subject;
    }

    //validate kanji
    public static function validateKanji($value)
    {
        $str = str_replace('　', '', $value);
        $str = str_replace(' ', '', $str);
        if (preg_match("/^[一-龥]+$/", $str)) {
            return true;
        } else {
            return false;
        }
    }

    //is exist kanji
    public static function isExistKanji($value)
    {
        $str = str_replace('　', '', $value);
        $str = str_replace(' ', '', $str);
        $arr = str_split($str);
        foreach ($arr as $key => $val) {
            if (preg_match("/^[一-龥]+$/", $val)) {
                return true;
            }
        }
    }

    //byte wise substring
    public static function byteWiseSubStr($value)
    {
        $str = str_replace('　', '', $value);
        $str = str_replace(' ', '', $str);
        $str = mb_convert_kana($str, "rnaskhc");
        $mod_str = mb_str_split($str);
        $sub_len = 0;
        $cn = 0;
        $temp_check = 0;
        $res = array();
        foreach ($mod_str as $key => $val) {
            if ($cn < 10) {
                if (preg_match("/^[一-龥]+$/", $val)) {
                    $sub_len = $sub_len + 1;
                    $cn = $cn + 1;
                } else {
                    $temp_check = $temp_check + 1;
                    $sub_len = $sub_len + 1;
                    if ($temp_check == 2) {
                        $cn = $cn + 1;
                        $temp_check = 0;
                    }

                }
            }
        }

        $sub_len2 = 0;
        $cn2 = 0;
        $temp_check2 = 0;
        for ($i = $sub_len; $i < count($mod_str); $i++) {
            if ($cn2 < 10) {
                if (preg_match("/^[一-龥]+$/", $mod_str[$i])) {
                    $sub_len2 = $sub_len2 + 1;
                    $cn2 = $cn2 + 1;
                } else {
                    $temp_check2 = $temp_check2 + 1;
                    $sub_len2 = $sub_len2 + 1;
                    if ($temp_check2 == 2) {
                        $cn2 = $cn2 + 1;
                        $temp_check2 = 0;
                    }

                }
            }

        }

        $res['part1'] = mb_substr($str, 0, $sub_len);
        $res['part2'] = mb_substr($str, $sub_len, $sub_len2);
        return $res;
    }

    public static function getDBFormattedDate($date)
    {
        if ($date) {
            $date = Helper::replaceSpecificString($date, '/');
            return \Illuminate\Support\Carbon::create(substr($date, 0, 4), substr($date, 4, 2), substr($date, 6, 2))->format('Y-m-d H:i:s');

        }
        return  null;
    }
    
    //get tantousya name
    public static function getTantousyaName($bango,$substring = null){
        if($substring != null){
            $tantousya_name = QueryHelper::fetchSingleResult("select substring(name,1,$substring) as name from tantousya where bango = '$bango' ")->name??null;
            return $tantousya_name;
        }else{
            $tantousya_name = QueryHelper::fetchSingleResult("select name from tantousya where bango = '$bango' ")->name??null;
            return $tantousya_name;
        }
    }

}

?>
