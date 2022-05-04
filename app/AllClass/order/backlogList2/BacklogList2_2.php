<?php

namespace App\AllClass\order\backlogList2;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class BacklogList2_2{
    public static function data($login_bango,$deleted_item=2,$req_data=null){
        
        $start_date =(int) str_replace("/",'',$req_data['sales_date_start']);
        $end_date =(int) str_replace("/",'',$req_data['sales_date_end']);
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS initial_temp5");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE initial_temp5 as
         SELECT H.*                                                             
           FROM orderhenkan AS H
           ,(SELECT orderhenkan.kokyakuorderbango, MAX(orderhenkan.ordertypebango2 ) AS ordertypebango2  FROM orderhenkan GROUP BY orderhenkan.kokyakuorderbango) AS D11HC   
           WHERE           
             H.kokyakuorderbango = D11HC.kokyakuorderbango 
             AND H.ordertypebango2  = D11HC.ordertypebango2 
             AND substring(REPLACE(H.date::text,'-',''),1,6) between '$start_date' and '$end_date'
        ");
      //  dd(QueryHelper::fetchResult('select*from initial_temp5'));
        QueryHelper::runQuery("DROP TABLE IF EXISTS backloglist2_2_temp");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE backloglist2_2_temp as
        SELECT	distinct											
	HC.datachar02 AS HC0005,
	HC.datachar08 AS HC0007,
	HC.datachar09 AS HC0009,
        HM.syouhinid AS HS0001,
        HM.syouhinsyu AS HS0002,
        HM.hantei AS HS0003,
        HM.zaikometer AS HS0004,
        --HM.zaikometer AS HC0002,
        HM.idoutanabango AS HS0005,
        HM.yoteimeter AS HS0006,
        HM.nyukometer AS HS0007,
        HM.datachar01 AS HS0008,
        HM.kaiinid AS HS0011,
        HM.datachar02 AS HS0012,
        HM.datachar03 AS HS0013,
        HM.nyukosu AS HS0017,
        HM.kingaku AS HS0019,
        HM.genka AS HS0020,
        HM.syouhizeiritu AS HS0021,
        HM.datachar07 AS HS0022,
        HM.datachar08 AS HS0023,
        HM.datachar13 AS HS0028,
        HM.datachar19 AS HS0050								
        FROM																																	

                        ( SELECT H.*																															
                        FROM orderhenkan AS H																															
                                ,(SELECT orderhenkan.kokyakuorderbango, MAX(orderhenkan.ordertypebango2 ) AS ordertypebango2  FROM orderhenkan GROUP BY orderhenkan.kokyakuorderbango) AS D11HC
                                ,backloglist2_1_temp 																			
                        WHERE																															
                                H.kokyakuorderbango = D11HC.kokyakuorderbango 
                                AND H.ordertypebango2  = D11HC.ordertypebango2 
                                AND backloglist2_1_temp.Ju0001::text=H.orderuserbango::text
                                																										
                ) AS HC																																
                 LEFT JOIN 																																
                ( SELECT * FROM hikiatenyuko																															
                        WHERE																															
                                hikiatenyuko.yoteimeter <> 1																														
                ) AS HCF																																
                ON HC.kokyakuorderbango = HCF.syouhinid																																
                LEFT JOIN 																																
                (	SELECT M.*																															
                        FROM minyuko AS M																															
                                ,(SELECT minyuko.syouhinid, minyuko.syouhinsyu, MAX(minyuko.zaikometer ) AS zaikometer  FROM minyuko GROUP BY minyuko.syouhinid, minyuko.syouhinsyu) AS D11HM																														
                        WHERE																															
                                M.syouhinid = D11HM.syouhinid 
                                AND M.syouhinsyu = D11HM.syouhinsyu 
                                AND M.zaikometer  = D11HM.zaikometer 																												
                ) AS HM																																
                ON HC.kokyakuorderbango = HM.syouhinid 
                AND HM.denpyobango <> 1																																
                LEFT JOIN 																																
                ( 	SELECT * FROM juchusyukko2																															
                        WHERE																															
                                yoteimeter <> 1																														
                ) AS HMF																																
                ON HM.syouhinid = HMF.syouhinid 
                AND HM.syouhinsyu = HMF.syouhinsyu																																
        WHERE																																	
                HC.synchroorderbango2 <> 1
                AND (HM.datachar01 NOT IN ('V150','V160') OR HM.datachar01 IS NULl)
        ");
        
        //only for qc purpose
      
        QueryHelper::runQuery("DROP TABLE IF EXISTS backlog2_2");
        QueryHelper::runQuery("CREATE TABLE backlog2_2
        AS (SELECT * FROM backloglist2_2_temp)");
        
        //$data=DB::table('backloglist2_2_temp');
        //return $data;
        
    }
}
