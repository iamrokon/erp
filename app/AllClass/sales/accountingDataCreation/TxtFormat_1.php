<?php

namespace App\AllClass\sales\accountingDataCreation;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class TxtFormat_1{
    public static function data($bango,$input = null){
        
        $start_date = str_replace("/", "", $input['intorder03_start']);
        $end_date = str_replace("/", "", $input['intorder03_end']);
        
        $sql = "";
        $rd2 = $input['rd2'];
        if($rd2 == 'rd2_1'){
           $sql = " AND hikiatesyukko.dataint03 = 2"; 
        }elseif($rd2 == 'rd2_2'){
           $sql = " AND hikiatesyukko.dataint03 = 3"; 
        }
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS temp_txt_format_1");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE temp_txt_format_1 as
            select distinct 
            max(orderhenkan.bango) as bango,
            sum(syukkoold.datachar19::int) as sum_of_datachar19,
            sum(syukkoold.dataint04) as sum_of_dataint04,
            sum(syukkoold.datachar20::int) as sum_of_datachar20,
            max(hikiatesyukko.dataint01) as dataint01,
            categorykanriText2.patternsub2,
            max(categorykanriOtodoketime.patternsub2) as checking_patternsub2,
            max(categorykanriOtodoketime.category5) as category5
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
            AND hikiatesyukko.datachar04 = '1'  AND text1 not in('U522','U560')
            AND syukkoold.datachar13 = '1' AND syukkoold.yoteimeter = 0
            AND hikiatesyukko.dataint01 != 1 -- skip this condition if exists in fotmat 4
            $sql

            group by intorder03,otodoketime,categorykanriText2.patternsub2
        ");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS txt_format_1");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE txt_format_1 as
        select distinct
        orderhenkan.bango,
        orderhenkan.datachar10,
        orderhenkan.intorder03,
        tuhanorder.otodoketime,
        tuhanorder.text1,
        tuhanorder.unsoudaibikitesuryou,
        tuhanorder.unsoutesuryou,
        temp_txt_format_1.dataint01,
        temp_txt_format_1.sum_of_datachar19,
        temp_txt_format_1.sum_of_dataint04,
        temp_txt_format_1.sum_of_datachar20,
        temp_txt_format_1.patternsub2,
        temp_txt_format_1.checking_patternsub2,
        left((substring(temp_txt_format_1.category5,1,2)::decimal/100)::text,8) as category5

        from orderhenkan
        
        join temp_txt_format_1 on temp_txt_format_1.bango = orderhenkan.bango
        
        join tuhanorder on tuhanorder.orderbango = orderhenkan.bango
        
        where checking_patternsub2 != '000'
        order by intorder03
        ");

        //$data=DB::table('txt_format_1')->whereRaw("intorder03 >= '$start_date'  AND intorder03 <= '$end_date'" . " AND datachar04 = '1'" . " AND text1 not in('U522','U560')");
        $data=DB::table('txt_format_1');

        return $data;
        
    }
}
