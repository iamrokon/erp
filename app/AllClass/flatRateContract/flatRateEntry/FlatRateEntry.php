<?php

namespace App\AllClass\flatRateContract\flatRateEntry;

use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;
use App\tantousya;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use App\Helpers\Helper;

class FlatRateEntry
{

    public static function renderCategoryKanri($length_limit, $categoryValue, $categoryType){
       $categories = QueryHelper::fetchResult("select * from categorykanri where category1 = '$categoryType' and suchi2 = 0 and substring (category2,1,$length_limit) = '$categoryValue' order by suchi1 ASC") ?? null;
       $default_name = ['C5' => "選択無し", 'C6' => "選択無し", 'E7' => "選択無し", 'E6' => "選択無し", 'maljabena' => "選択無し"];
       $html = '<option data-categoryType="null" data-categoryValue="' . $categoryType . '"  value="">' . $default_name[$categoryType] . '</option>';
       if (isset($categories)) {
           foreach ($categories as $category) {
               $html .= "<option data-categoryType=" . $category->category1 . " data-categoryValue=" . $category->category2 . " value=" . $category->category1 . $category->category2 . ">" . substr($category->category2, $length_limit) . " " . $category->category4 . "</option>";
           }
           return $html;
       } else {
           return $html;
       }
   }
   
    
}
