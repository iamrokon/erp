<?php

namespace App\AllClass\order\backlogList2;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class BacklogList2_1{
    public static function data($login_bango,$deleted_item=2,$req_data=null){
       
        $start_date =(int) str_replace("/",'',$req_data['sales_date_start']);
        $end_date =(int) str_replace("/",'',$req_data['sales_date_end']);
        
        if(isset($req_data['rd1']) && $req_data['rd1']=="rd1_1"){
            $datachar02 = " AND ((backloglist2_view1.datachar02 IN('U110', 'U111', 'U150', 'U180', 'U181') AND backloglist2_view1.datachar13 != '3') OR backloglist2_view1.datachar02 IN('U120', 'U121', 'U123'))";
        }elseif(isset($req_data['rd1']) && $req_data['rd1']=="rd1_2"){
            $datachar02 = " AND ((backloglist2_view1.datachar02 IN('U110', 'U111', 'U150', 'U180', 'U181') AND backloglist2_view1.datachar13 != '3') OR backloglist2_view1.datachar02 IN('U121'))";
        }elseif(isset($req_data['rd1']) && $req_data['rd1']=="rd1_3"){
            $datachar02 = " AND backloglist2_view1.datachar02 IN('U120', 'U123')"; 
        }elseif(isset($req_data['rd1']) && $req_data['rd1']=="rd1_4"){
            $datachar02 = " AND backloglist2_view1.datachar02 IN('U121')"; 
        }else{
            $datachar02 = "";
        }
        /*$sql = "(CAST(substring((CASE 
              WHEN COALESCE(backloglist2_view1f.datachar04,  '2' ) = '1' THEN UR.intorder03
              ELSE backloglist2_view1.intorder03 END)::text,1,6) as integer) between $start_date and $end_date) $datachar02";*/
        $sql = "substring(backloglist2_view1.intorder03::text,1,6) between  '$start_date' and '$end_date' $datachar02";     
        
        /*QueryHelper::runQuery("DROP TABLE IF EXISTS initial_temp1");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE initial_temp1 as
         SELECT J.*,T.*                                                 
             FROM orderhenkan AS J,(SELECT orderhenkan.kokyakuorderbango, MAX(orderhenkan.ordertypebango2 ) AS  ordertypebango2  FROM orderhenkan where substring(orderhenkan.intorder03::text,1,6) between '$start_date' and '$end_date' GROUP BY orderhenkan.kokyakuorderbango) AS D11JC ,tuhanorder as T             
             WHERE                                                                        J.kokyakuorderbango = D11JC.kokyakuorderbango 
                 AND J.ordertypebango2  = D11JC.ordertypebango2 
                 AND T.orderbango=J.bango
        ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS initial_temp2");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE initial_temp2 as
         SELECT M.*                                                               
            FROM misyukko AS M
            ,(SELECT misyukko.syouhinid, misyukko.syouhinsyu, misyukko.hantei, MAX(misyukko.dataint01 ) AS dataint01  FROM misyukko GROUP BY misyukko.syouhinid, misyukko.syouhinsyu, misyukko.hantei) AS D11JM
            ,(SELECT orderhenkan.kokyakuorderbango, MAX(orderhenkan.ordertypebango2 ) AS  ordertypebango2  FROM orderhenkan where substring(orderhenkan.intorder03::text,1,6) between '$start_date' and '$end_date' GROUP BY orderhenkan.kokyakuorderbango) AS D11JC             

             WHERE 
                M.syouhinid = D11JM.syouhinid 
                AND M.syouhinsyu = D11JM.syouhinsyu 
                AND M.hantei = D11JM.hantei 
                AND M.dataint01  = D11JM.dataint01 
                AND D11JC.kokyakuorderbango=M.syouhinid 
                AND M.yoteimeter <> 1
        ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS initial_temp3");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE initial_temp3 as
         SELECT U.*,T1.* 
           FROM orderhenkan AS U                                             
            ,(SELECT orderhenkan.datachar10, MAX(orderhenkan.ordertypebango2 ) AS ordertypebango2  FROM orderhenkan where substring(orderhenkan.intorder03::text,1,6) between '$start_date' and '$end_date'
                        GROUP BY orderhenkan.datachar10) AS D11U        
            ,tuhanorder as T1                                                         

        WHERE                        
           U.datachar10 = D11U.datachar10 
           AND U.ordertypebango2  = D11U.ordertypebango2   
           AND T1.orderbango=U.bango
        ");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS initial_temp4");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE initial_temp4 as
         SELECT M.*                                                                       FROM syukkoold AS M
            ,(SELECT kaiinid, syouhinsyu, hantei, MAX(dataint01) AS dataint01  FROM syukkoold GROUP BY kaiinid, syouhinsyu, hantei) AS D11UM  
            ,(SELECT orderhenkan.datachar10, MAX(orderhenkan.ordertypebango2 ) AS ordertypebango2  FROM orderhenkan where substring(orderhenkan.intorder03::text,1,6) between '$start_date' and '$end_date'
                        GROUP BY orderhenkan.datachar10) AS D11U            
            WHERE 
                M.kaiinid = D11UM.kaiinid 
                AND M.syouhinsyu = D11UM.syouhinsyu 
                AND M.hantei = D11UM.hantei 
                AND M.dataint01  = D11UM.dataint01   
                AND D11U.datachar10=M.kaiinid                                                                                                                   
        ");*/

//dd(QueryHelper::fetchResult('select*from initial_temp4'));
        QueryHelper::runQuery("DROP TABLE IF EXISTS backloglist2_1_temp");
        /*QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE backloglist2_1_temp as
        SELECT distinct
        JC.kokyakuorderbango AS JU0001,
        JC.ordertypebango2 AS JU0002,
        JC.datachar01 AS JU0003,
        JC.datachar02  AS JU0004,
        JC.datachar06 AS JU0005,
        JC.datachar05 AS JU0008,
        JC.information1 AS JU0009,
        JC.information2 AS JU0010,
        JC.information3 AS JU0011,
        JC.information4 AS JU0012,
        JC.information5 AS JU0013,
        JC.juchukubun1 AS JU0015,
        JC.intorder01 AS JU0016,
        JC.intorder02 AS JU0017,
        JC.intorder04 AS JU0019,
        JC.money10 AS JU0027,
        JC.chumonbango AS JU0031,
        COALESCE(JCF.datachar04,  '2' ) AS JUF005,
        JCF.datachar16 AS JUF018,	
        JM.syouhinid AS JM0001,
        JM.syouhinsyu AS JM0002,
        JM.hantei AS JM0003,
        JM.dataint01 AS JM0004,
        JM.dataint02 AS JM0005,
        JM.datachar13 AS JM0006,
        JM.syouhinname AS JM0008,
        JM.syukkasu AS JM0012,
        JM.dataint04 AS JM0014,
        JM.dataint05 AS JM0015,
        JM.dataint06 AS JM0016,
        JM.dataint07 AS JM0017,
        JM.dataint08 AS JM0018,
        JM.datachar01 AS JM0019,
        JM.datachar02 AS JM0020,
        JM.datachar06 AS JM0026,
        JM.dataint16 AS JM0033,
        JM.datachar22 AS JM0039,
        JM.kawasename AS JM0007,
        JM.dataint18 AS JM0035,
        JMF.datachar03 AS JMF006,
        COALESCE(UR.unsoudaibikitesuryou,  '2' ) AS UR0025,
        UR.unsoutesuryou AS UR0026,
        URF.dataint01 AS URF002,
        (CASE 
              WHEN COALESCE(JCF.datachar04,  '2' ) = '1' THEN UR.intorder03
              ELSE JC.intorder03 END) AS UR0012_JU0018,
        (CASE 
              WHEN COALESCE(JCF.datachar04,  '2' ) = '1' THEN UR.intorder05 
              ELSE JC.intorder05 END) AS UR0014_JU0020	

        from (SELECT J.*,T.*                                                 
             FROM orderhenkan AS J,(SELECT orderhenkan.kokyakuorderbango, MAX(orderhenkan.ordertypebango2 ) AS  ordertypebango2  FROM orderhenkan where substring(orderhenkan.intorder03::text,1,6) between '$start_date' and '$end_date' GROUP BY orderhenkan.kokyakuorderbango) AS D11JC ,tuhanorder as T             
             WHERE                                                                        J.kokyakuorderbango = D11JC.kokyakuorderbango 
                 AND J.ordertypebango2  = D11JC.ordertypebango2 
                 AND T.orderbango=J.bango) AS JC	

        LEFT JOIN  hikiatesyukko AS JCF
        ON JC.kokyakuorderbango = JCF.syouhinid 
        AND JCF.yoteimeter <> 1			

        LEFT JOIN (SELECT M.*                                                               
            FROM misyukko AS M
            ,(SELECT misyukko.syouhinid, misyukko.syouhinsyu, misyukko.hantei, MAX(misyukko.dataint01 ) AS dataint01  FROM misyukko GROUP BY misyukko.syouhinid, misyukko.syouhinsyu, misyukko.hantei) AS D11JM
            ,(SELECT orderhenkan.kokyakuorderbango, MAX(orderhenkan.ordertypebango2 ) AS  ordertypebango2  FROM orderhenkan where substring(orderhenkan.intorder03::text,1,6) between '$start_date' and '$end_date' GROUP BY orderhenkan.kokyakuorderbango) AS D11JC             

             WHERE 
                M.syouhinid = D11JM.syouhinid 
                AND M.syouhinsyu = D11JM.syouhinsyu 
                AND M.hantei = D11JM.hantei 
                AND M.dataint01  = D11JM.dataint01 
                AND D11JC.kokyakuorderbango=M.syouhinid 
                AND M.yoteimeter <> 1) AS JM			
          ON JC.kokyakuorderbango = JM.syouhinid 
          AND JM.yoteimeter <> 1

        LEFT JOIN  juchusyukko AS JMF						
          ON JM.syouhinid = JMF.syouhinid 
          AND JM.syouhinsyu = JMF.syouhinsyu 
          AND JM.hantei = JMF.hantei
          AND JMF.yoteimeter <> 1	

        LEFT JOIN (SELECT U.*,T1.* 
           FROM orderhenkan AS U                                             
            ,(SELECT orderhenkan.datachar10, MAX(orderhenkan.ordertypebango2 ) AS ordertypebango2  FROM orderhenkan where substring(orderhenkan.intorder03::text,1,6) between '$start_date' and '$end_date'
                        GROUP BY orderhenkan.datachar10) AS D11U        
            ,tuhanorder as T1                                                         

        WHERE                        
           U.datachar10 = D11U.datachar10 
           AND U.ordertypebango2  = D11U.ordertypebango2   
           AND T1.orderbango=U.bango) AS UR	
          ON JC.kokyakuorderbango = UR.kokyakuorderbango 
          AND UR.synchroorderbango <> 1

        LEFT JOIN hikiatesyukko AS URF	
          ON UR.datachar10 = URF.kaiinid 
          AND URF.yoteimeter  <> 1					

        LEFT JOIN (SELECT M.*                                                                       FROM syukkoold AS M
            ,(SELECT kaiinid, syouhinsyu, hantei, MAX(dataint01) AS dataint01  FROM syukkoold GROUP BY kaiinid, syouhinsyu, hantei) AS D11UM  
            ,(SELECT orderhenkan.datachar10, MAX(orderhenkan.ordertypebango2 ) AS ordertypebango2  FROM orderhenkan where substring(orderhenkan.intorder03::text,1,6) between '$start_date' and '$end_date'
                        GROUP BY orderhenkan.datachar10) AS D11U            
            WHERE 
                M.kaiinid = D11UM.kaiinid 
                AND M.syouhinsyu = D11UM.syouhinsyu 
                AND M.hantei = D11UM.hantei 
                AND M.dataint01  = D11UM.dataint01   
                AND D11U.datachar10=M.kaiinid ) AS UM						
          ON UR.datachar10 = UM.kaiinid 
          AND JC.kokyakuorderbango = UM.syouhinid 
          AND UM.yoteimeter <> 1						

        WHERE JC.synchroorderbango <> 1	AND ( COALESCE( JCF.datachar04 ,  '2') = '2' OR COALESCE( UR.unsoudaibikitesuryou  , '2') = '2' ) AND $sql
        ");
        */
        QueryHelper::runQuery("CREATE TEMPORARY TABLE backloglist2_1_temp as
                    select * from backloglist2_view1 where $sql");
/*dd($sql,QueryHelper::fetchResult("
                    select * from backloglist2_1_temp where ju0001='0151014854'"));*/
        //only for qc purpose
        QueryHelper::runQuery("DROP TABLE IF EXISTS backlog2_1");
        QueryHelper::runQuery("CREATE TABLE backlog2_1
        AS (SELECT * FROM backloglist2_1_temp)");
        
        //$data=DB::table('backloglist2_1_temp');
        //return $data;
        
    }
}
