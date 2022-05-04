<?php

namespace App\AllClass\sales\salesSlip;
/*
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;*/
use DB;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class salesCategoriFilter{
    public static function filter($data){

       $var=[];
       $searchOn=$data['filterOn'];
       $filterKey=$data['filterKey'];
       $whichOne=$data['whichOne'];
       
       if ($filterKey == 'B9' AND $whichOne=='hidari0003') {
           $value1= self::filter0003($searchOn);
           $value2= self::filter0004($searchOn);
           $value3= self::greaterThan003($searchOn);

       }
       if ($filterKey == 'C1' AND $whichOne=='hidari0004') {
           $value1= self::filter0004($searchOn);
           $value2= self::greaterThan004($searchOn);
       }
       if ($filterKey == 'C2' AND $whichOne=='hidari0005') {
           $value1= self::greaterThan005($searchOn);
       }
       if ($filterKey == 'B9' AND $whichOne=='migi0003') {
           $value1= self::filter0003($searchOn);
           $value2= self::filter0004($searchOn);
       }
       if ($filterKey == 'C1' AND $whichOne=='migi0004') {
           $value1= self::filter0004($searchOn);
       }

      
        $var=[
              'value1'=>$value1??null,
              'value2'=>$value2??null,
              'value3'=>$value3??null
          ];
        
        return $var;
    }

    private static function filter0003($searchOn){
        $categorykanri = QueryHelper::select(['category1,category2,category4'])->from('categorykanri')->where(" category1 = 'C1'")
              ->where(" category2::text LIKE '$searchOn%'")
              ->where("suchi2 = 0")
              ->orderBy("bango asc")
              ->get()->execute();

        $categoryhtml="<option value=''>なし</option>\n";

        foreach ($categorykanri as $value) 
        {
            $categoryhtml .="<option value='".$value->category2."'>".substr($value->category2,-1)." ".$value->category4."</option>\n";
        }

        return $categoryhtml;
    }

    private static function filter0004($searchOn){
        $categorykanri = QueryHelper::select(['category1,category2,category4'])->from('categorykanri')->where(" category1 = 'C2'")
              ->where(" category2::text LIKE '$searchOn%'")
              ->where("suchi2 = 0")
              ->orderBy("bango asc")
              ->get()->execute();

        $categoryhtml="<option value=''>なし</option>\n";

        foreach ($categorykanri as $value) 
        {
            $categoryhtml .="<option value='".$value->category2."'>".substr($value->category2,-1)." ".$value->category4."</option>\n";
        }

        return $categoryhtml;        
    }

    private static function greaterThan003($searchOn){
        $categorykanri = QueryHelper::select(['category1,category2,category4'])->from('categorykanri')->where(" category1 = 'B9'")
              ->where(" category2::text > '$searchOn%'")
              ->where("suchi2 = 0")
              ->orderBy("bango asc")
              ->get()->execute();

        $categoryhtml="<option value=''>なし</option>\n";

        foreach ($categorykanri as $value) 
        {
            $categoryhtml .="<option value='".$value->category2."'>".substr($value->category2,-2)." ".$value->category4."</option>\n";
        }

        return $categoryhtml;        
    }
    private static function greaterThan004($searchOn){
        $categorykanri = QueryHelper::select(['category1,category2,category4'])->from('categorykanri')->where(" category1 = 'C1'")
              ->where(" category2::text > '$searchOn%'")
              ->where("suchi2 = 0")
              ->orderBy("bango asc")
              ->get()->execute();

        $categoryhtml="<option value=''>なし</option>\n";

        foreach ($categorykanri as $value) 
        {
            $categoryhtml .="<option value='".$value->category2."'>".substr($value->category2,-1)." ".$value->category4."</option>\n";
        }

        return $categoryhtml;        
    }
    private static function greaterThan005($searchOn){
        $categorykanri = QueryHelper::select(['category1,category2,category4'])->from('categorykanri')->where(" category1 = 'C2'")
              ->where(" category2::text > '$searchOn%'")
              ->where("suchi2 = 0")
              ->orderBy("bango asc")
              ->get()->execute();

        $categoryhtml="<option value=''>なし</option>\n";

        foreach ($categorykanri as $value) 
        {
            $categoryhtml .="<option value='".$value->category2."'>".substr($value->category2,-1)." ".$value->category4."</option>\n";
        }

        return $categoryhtml;        
    }

}
