<?php

namespace App\AllClass\sales\accountingDataCreation;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class TxtFormat_4_updateBangos{
    public static function data($bango,$input = null){
        
        $start_date = str_replace("/", "", $input['intorder03_start']);
        $end_date = str_replace("/", "", $input['intorder03_end']);
        
        $sql = "";
        $rd2 = $input['rd2'];
        if($rd2 == 'rd2_1'){
           $sql = " AND hikiatesyukko.dataint03 = 1"; 
        }elseif($rd2 == 'rd2_2'){
           $sql = " AND hikiatesyukko.dataint03 = 3"; 
        }
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS txt_format_4_updatedata");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE txt_format_4_updatedata as
            select distinct 
            orderhenkan.bango,
            orderhenkan.datachar10,
            categorykanriText2.patternsub2,
            categorykanriOtodoketime.patternsub2 as checking_patternsub2
            
            from orderhenkan

            join tuhanorder on tuhanorder.orderbango = orderhenkan.bango

            join hikiatesyukko on  hikiatesyukko.syouhinid = orderhenkan.kokyakuorderbango
            AND hikiatesyukko.orderbango = orderhenkan.bango

            join syukkoold on  syukkoold.orderbango = orderhenkan.bango

            left join tantousya on tantousya.bango = tuhanorder.text2

            left join categorykanri as categorykanriText2
            on substring(tantousya.datatxt0005,1,2) = categorykanriText2.category1
            and substring(tantousya.datatxt0005,3,6) = categorykanriText2.category2
            
            left join categorykanri as categorykanriOtodoketime
            on substring(tuhanorder.otodoketime,1,2) = categorykanriOtodoketime.category1
            and substring(tuhanorder.otodoketime,3,6) = categorykanriOtodoketime.category2

            where synchroorderbango = 0 AND orderhenkan.datachar10 IS NOT NULL
            AND intorder03 >= '$start_date'  AND intorder03 <= '$end_date'
            AND hikiatesyukko.datachar04 = '1' AND hikiatesyukko.dataint01 = 1 
            AND text1 = 'U523' AND tuhanorder.unsoutesuryou = 2 AND tuhanorder.unsoudaibikitesuryou = 1
            AND syukkoold.datachar13 = '1' AND syukkoold.yoteimeter = 0
            AND categorykanriOtodoketime.patternsub2 != '000'
            $sql
            
        ");
        
        $data=DB::table('txt_format_4_updatedata');

        return $data;
        
    }
}
