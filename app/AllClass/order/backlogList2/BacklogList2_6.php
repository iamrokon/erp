<?php

namespace App\AllClass\order\backlogList2;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class BacklogList2_6{
    public static function data($login_bango,$deleted_item=2,$req_data=null){
        if(isset($req_data['rd2']) && $req_data['rd2']=="rd2_1"){
            $order_by = " order by jhvw050,jhvw021,jhvw032";
            $group_by = " group by jhvw001,jhvw050,jhvw021,jhvw032";
            //$group_by = " group by jhvw001";
            $grpby_col=",UNIONALL.jhvw021 as  jhvw021";
        }else{
            $order_by = " order by jhvw032,jhvw050";
            $group_by = " group by jhvw001,jhvw032,jhvw050";
            $grpby_col=",MAX(UNIONALL.jhvw021) as  jhvw021";
            //$group_by = " group by jhvw001";
        }
     
        if (isset($req_data['rd1']) && $req_data['rd1']=="rd1_1") {
            $sql_1= "where (JHVW008 IN ('U110', 'U111', 'U150', 'U180', 'U181' ) AND  JHVW006 <> '3') OR JHVW008 in ('U120', 'U121', 'U123')";
        }elseif(isset($req_data['rd1']) && $req_data['rd1']=="rd1_2"){
            $sql_1= "where (JHVW008 IN ('U110', 'U111', 'U150', 'U180', 'U181' ) AND  JHVW006 <> '3') OR JHVW008 in ('U121')";
        }elseif(isset($req_data['rd1']) && $req_data['rd1']=="rd1_3"){
            $sql_1= "where  JHVW008 in ('U120', 'U123')";
        }elseif(isset($req_data['rd1']) && $req_data['rd1']=="rd1_2"){
            $sql_1= "where  JHVW008 in ('U121')";
        }else{
            $sql_1 = "";
        }

        $division_start_date = substr($req_data['division_datachar05_start'], 4,2);
        $division_end_date = substr($req_data['division_datachar05_end'], 4,2);
        $sql = "";
        //$sql .= " substring(tantousya.datatxt0003::text,1,2)='B9' AND right(tantousya.datatxt0003::text,2) between '$division_start_date' and '$division_end_date' ";
        $sql .= " substring(datatxt0003::text,1,2)='B9' AND right(datatxt0003::text,2) between '$division_start_date' and '$division_end_date' ";
        if(isset($req_data['department_datachar05_start']) && ($req_data['department_datachar05_start']!="" && $req_data['department_datachar05_end']!="")){
            $department_start_date =substr($req_data['department_datachar05_start'], 4,3);
            $department_end_date = substr($req_data['department_datachar05_end'], 4,3);
            //$sql .= "AND substring(tantousya.datatxt0004::text,1,2)='C1' AND right(tantousya.datatxt0004::text,3) between '$department_start_date' and '$department_end_date' ";
            $sql .= "AND substring(datatxt0004::text,1,2)='C1' AND right(datatxt0004::text,3) between '$department_start_date' and '$department_end_date' ";
        }

        QueryHelper::runQuery("DROP TABLE IF EXISTS backloglist2_6_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE backloglist2_6_temp AS 

                    SELECT                                                              
                    distinct                                       
                            v4.JM0001 as JHVW001                                                                                            
                    ,   v4.JM0002 as JHVW002
                    ,   v4.JU0002 as ordertypebango2
                    ,   v4.JM0003 as JHVW003                                                                                                    
                    ,   v4.JM0004 AS JHVW004                                                                                                
                    ,   v4.JM0005 AS JHVW005                                                                                                
                    ,   (CASE WHEN v4.JM0006 = '1' THEN '対象'
                             WHEN v4.JM0006 = '2' THEN '対象外'
                             ELSE '保守へ計上' END)
                         AS JHVW006                                                                                           
                    ,   v4.JU0031 AS JHVW007                                                                                                
                    ,   v4.JU0004 AS JHVW008                                                                                                    
                    ,   (CASE WHEN v4.JU0003 = '1' THEN '新規'
                                  WHEN v4.JU0003 = '2' THEN '訂正'
                             ELSE '削除' END)  AS JHVW009                                                                                         
                    ,   v4.JU0005  AS JHVW010                                                                                                   
                    ,   v4.HS0001 AS JHVW011                                                                                                
                    ,   v4.HS0002 AS JHVW012                                                                                                    
                    ,   v4.HS0003 AS JHVW013                                                                                                
                    ,   v4.HS0004 AS JHVW014                                                                                    
                    ,   (CASE WHEN v4.HC0005 = '10' THEN '仕入'
                                  WHEN v4.HC0005 = '11' THEN 'UIS'
                                  WHEN v4.HC0005 = '12' THEN '出荷'
                                  WHEN v4.HC0005 = '13' THEN 'サポート'
                                  WHEN v4.HC0005 = '20' THEN '購入'
                                  WHEN v4.HC0005 = '30' THEN 'オフライン'
                              ELSE '外注' END)  AS JHVW015                                                                                                
                    ,   v4.JU0008 AS JHVW016                                                                                                
                    ,   v4.HC0009 AS JHVW017                                                                                            
                    ,   v4.JM0019 AS JHVW018                                                                                        
                    ,   v4.JM0020 AS JHVW019                                                                                            
                    ,   v4.HS0028 AS JHVW020                                                                                            
                    ,   v4.明細担当 AS JHVW021                                                                                              
                    ,   v4.JU0009 AS JHVW022                                                                                                    
                    ,   v4.JU0010 AS JHVW023                                                                                                
                    ,   v4.JU0011 AS JHVW024                                                                                                
                    ,   v4.JU0012 AS JHVW025                                                                                                    
                    ,   v4.JU0013 AS JHVW026                                                                                                    
                    ,   v4.JU0015 AS JU0015                                                                                                    
                    ,   v4.HC0007 AS JHVW027                                                                                                    
                    ,   (CASE WHEN v4.JMF006 <> '1' THEN v4.JM0026
                             ELSE v4.HS0011 END)  AS JHVW028                                                                                                    
                    ,   v4.HS0050 AS JHVW029                                                                                                    
                    ,   v4.JU0016 AS JHVW030                                                                                                    
                    ,   v4.JU0017 AS JHVW031                                                                                                    
                    ,   (CASE WHEN v4.JUF005 <> '1' THEN v4.UR0012_JU0018
                             ELSE v4.UR0012_JU0018 END)  AS JHVW032                                                                                             
                    ,   v4.JU0019 AS JHVW033                                                                                                    
                    ,   (CASE WHEN v4.UR0014_JU0020 <> '1' THEN v4.UR0012_JU0018
                             ELSE v4.UR0014_JU0020 END) AS JHVW034                                                                                                  
                    ,   v4.JU0027 AS JHVW035                                                                                                
                    ,   (CASE WHEN v4.JUF005 = '2' OR v4.UR0025 ='2' THEN '1'
                             ELSE Null END) AS JHVW036                                                                                                          
                    ,   (CASE WHEN v4.UR0025 = '1' THEN '済'
                                  WHEN v4.UR0025 = '2' THEN '未'
                             ELSE NULL END)  AS JHVW037                                                                                                 
                    ,   (CASE WHEN v4.UR0026 = '1' THEN '通常'
                                  WHEN v4.UR0026 = '2' THEN '前受'
                             ELSE NULL END)  AS JHVW038                                                                                                 
                    ,   (CASE WHEN v4.JUF018 = '1' THEN '済'
                             ELSE '未' END) AS JHVW039                                                                                                   
                    ,   (CASE WHEN v4.URF002 = '1' THEN '済'
                                  WHEN v4.URF002 = '2' THEN '未'
                                  WHEN v4.URF002 = '3' THEN '前受'
                             ELSE '対象外' END)  AS JHVW040                                                                                                    
                    ,   (CASE WHEN v4.JMF006 = '1' THEN '済'
                             ELSE '未' END) AS JHVW041                                                                                                   
                    ,   v4.JM0039 AS JHVW042                                                                                                
                    ,   v4.HS0008 AS JHVW043                                                                                                    
                    ,   v4.商品ＣＤ_v4 AS JHVW044                                                                                                   
                    ,   v4.商品名_v4    AS JHVW045                                                                                             
                    ,   v4.分類数量_v4 AS JHVW046                                                                                                   
                    ,   v4.分類粗利単価_v4 AS JHVW047                                                                                             
                    ,   v4.分類粗利額 AS JHVW048                                                                                             
                    ,   (CASE WHEN v4.JM0003 = '0' AND v4.HS0008='V110' THEN v4.JM0035
                             ELSE '0' END) AS JHVW049 
                    ,v4.JU0015 AS JHVW053
                    FROM backloglist2_4_temp as v4                                                                                                      

                    


            "); 

      /*dd(QueryHelper::fetchResult("SELECT backloglist2_6_temp.*
            ,tantousya.bango AS tantousya_bango
            ,tantousya.datatxt0003
            ,tantousya.datatxt0004
         FROM backloglist2_6_temp 
         join tantousya 
         ON backloglist2_6_temp.JHVW021 = tantousya.bango
         $sql_1 and $sql and JHVW048 <> 0"));*/
        //only for qc purpose
        QueryHelper::runQuery("DROP TABLE IF EXISTS backlog2_6");
        QueryHelper::runQuery("CREATE TABLE backlog2_6
        AS (SELECT backloglist2_6_temp.*
            ,tantousya.bango AS tantousya_bango
            ,tantousya.datatxt0003
            ,tantousya.datatxt0004
         FROM backloglist2_6_temp 
         join tantousya 
         ON backloglist2_6_temp.JHVW021 = tantousya.bango
         $sql_1 and $sql )");
         
    

        QueryHelper::runQuery("DROP TABLE IF EXISTS backloglist2_final_temp");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE backloglist2_final_temp as
        SELECT  
          
            
            (case 
                when MAX(UNIONALL.jhvw043)='V110' THEN UNIONALL.jhvw001
                          else  
                            (
                                case when MAX(UNIONALL.jhvw011) IS NOT NULL then MAX(UNIONALL.jhvw011)
                                else UNIONALL.jhvw001 end
                                )
                             end) as  jhvw001           
            ,MAX(UNIONALL.jhvw002) as  jhvw002           
            ,MAX(UNIONALL.ordertypebango2) as  ordertypebango2           
            ,MAX(UNIONALL.jhvw003) as  jhvw003
            ,MAX(UNIONALL.jhvw004) as  jhvw004
            ,MAX(UNIONALL.jhvw005) as  jhvw005
            ,MAX(UNIONALL.jhvw006) as  jhvw006
            ,MAX(UNIONALL.jhvw007) as  jhvw007
            ,MAX(UNIONALL.jhvw008) as  jhvw008
            ,MAX(UNIONALL.jhvw009) as  jhvw009
            ,MAX(UNIONALL.jhvw010) as  jhvw010
            ,MAX(UNIONALL.jhvw011) as  jhvw011
            ,MAX(UNIONALL.jhvw012) as  jhvw012
            ,MAX(UNIONALL.jhvw013) as  jhvw013
            ,MAX(UNIONALL.jhvw014) as  jhvw014
            ,MAX(UNIONALL.jhvw015) as  jhvw015
            ,MAX(UNIONALL.jhvw016) as  jhvw016
            ,MAX(UNIONALL.jhvw017) as  jhvw017
            ,MAX(UNIONALL.jhvw018) as  jhvw018
            ,MAX(UNIONALL.jhvw019) as  jhvw019
            ,MAX(UNIONALL.jhvw020) as  jhvw020
            $grpby_col
            ,MAX(tantousya.name) as user_name
            ,replace(replace(MAX(tantousya.name),' ',''),'　','') as user_name_search
            ,substring(replace(replace(MAX(tantousya.name),' ',''),'　',''),1,3) as user_name_short
            ,MAX(UNIONALL.jhvw022) as  jhvw022
            ,MAX(jhvw022Detail.r17_4) as jhvw022_detail
            ,MAX(UNIONALL.jhvw023) as  jhvw023
            ,MAX(jhvw023Detail.r17_4) as jhvw023_detail
            ,MAX(UNIONALL.jhvw024) as  jhvw024
            ,MAX(jhvw024Detail.r17_4) as jhvw024_detail
            ,MAX(UNIONALL.jhvw025) as  jhvw025
            ,MAX(jhvw025Detail.r17_4) as jhvw025_detail
            ,MAX(UNIONALL.jhvw026) as  jhvw026
            ,MAX(jhvw026Detail.r17_4) as jhvw026_detail
            ,MAX(UNIONALL.jhvw027) as  jhvw027
            ,MAX(UNIONALL.jhvw028) as  jhvw028
            ,MAX(UNIONALL.jhvw029) as  jhvw029
            ,CASE
                WHEN MAX(UNIONALL.jhvw030)::text is null THEN NULL
                ELSE concat_ws('/',substring(MAX(UNIONALL.jhvw030)::text,1,4),
                substring(MAX(UNIONALL.jhvw030)::text,5,2),
                substring(MAX(UNIONALL.jhvw030)::text,7,2)) END as jhvw030
            ,CASE
                WHEN MAX(UNIONALL.jhvw031)::text is null THEN NULL
                ELSE concat_ws('/',substring(MAX(UNIONALL.jhvw031)::text,1,4),
                substring(MAX(UNIONALL.jhvw031)::text,5,2),
                substring(MAX(UNIONALL.jhvw031)::text,7,2)) END as jhvw031
            ,CASE
                WHEN UNIONALL.jhvw032::text is null THEN NULL
                ELSE concat_ws('/',substring(UNIONALL.jhvw032::text,1,4),
                substring(UNIONALL.jhvw032::text,5,2)) END as jhvw032
            ,CASE
                WHEN UNIONALL.jhvw032::text is null THEN NULL
                ELSE concat_ws('/',substring(UNIONALL.jhvw032::text,1,4),
                substring(UNIONALL.jhvw032::text,5,2),
                substring(UNIONALL.jhvw032::text,7,2)) END as display_jhvw032
            ,CASE
                WHEN MAX(UNIONALL.jhvw033)::text is null THEN NULL
                ELSE concat_ws('/',substring(MAX(UNIONALL.jhvw033)::text,1,4),
                substring(MAX(UNIONALL.jhvw033)::text,5,2),
                substring(MAX(UNIONALL.jhvw033)::text,7,2)) END as jhvw033
            ,CASE
                WHEN MAX(UNIONALL.jhvw034)::text is null THEN NULL
                ELSE concat_ws('/',substring(MAX(UNIONALL.jhvw034)::text,1,4),
                substring(MAX(UNIONALL.jhvw034)::text,5,2),
                substring(MAX(UNIONALL.jhvw034)::text,7,2)) END as jhvw034
            ,MAX(UNIONALL.jhvw035) as  jhvw035
            ,MAX(UNIONALL.jhvw036) as  jhvw036
            ,MAX(UNIONALL.jhvw037) as  jhvw037
            ,MAX(UNIONALL.jhvw038) as  jhvw038
            ,MAX(UNIONALL.jhvw039) as  jhvw039
            ,MAX(UNIONALL.jhvw040) as  jhvw040
            ,MAX(UNIONALL.jhvw041) as  jhvw041
            ,MAX(UNIONALL.jhvw042) as  jhvw042
            --,MAX(UNIONALL.jhvw043) as  jhvw043
            ,MAX(concat(categorykanriJhvw043.category2,' ',categorykanriJhvw043.category4)) as  jhvw043
            ,CASE
                WHEN MAX(UNIONALL.jhvw043) = 'V110' THEN null
                ELSE UNIONALL.jhvw001 END as order_number
            ,MAX(UNIONALL.jhvw044) as  jhvw044
            ,MAX(UNIONALL.jhvw045) as  jhvw045
            ,MAX(UNIONALL.jhvw046) as  jhvw046
            ,MAX(UNIONALL.jhvw047) as  jhvw047
            --,SUM(COALESCE(UNIONALL.jhvw048,0)) as  jhvw048
            ,to_char(SUM(COALESCE(UNIONALL.jhvw048,0)),'FM99,999,999,999,999') as jhvw048
            ,SUM(COALESCE(UNIONALL.jhvw049,0)) as jhvw049  
            ,to_char(SUM(COALESCE(UNIONALL.jhvw049,0)),'FM99,999,999,999,999') as formatted_jhvw049
            ,MAX(tantousya.bango) AS tantousya_bango    
            ,MAX(tantousya.datatxt0003) as datatxt0003
            ,MAX(tantousya.datatxt0004) as datatxt0004
            ,SUBSTRING(tantousya.datatxt0003,3,4) AS JHVW050                                                                                                        
            ,MAX(categorykanriJhvw050.category4) AS jhvw050_detail                                                                                                      
            ,SUBSTRING(MAX(tantousya.datatxt0004),3,5) AS JHVW051
            ,MAX(categorykanriJhvw051.category4) AS jhvw051_detail
            ,SUBSTRING(MAX(tantousya.datatxt0005),3,6) AS JHVW052 
            ,MAX(UNIONALL.JHVW053) as  JHVW053
            FROM (SELECT backloglist2_6_temp.*
            ,tantousya.bango AS tantousya_bango
            ,tantousya.datatxt0003
            ,tantousya.datatxt0004
            FROM backloglist2_6_temp 
            join tantousya 
            ON backloglist2_6_temp.JHVW021 = tantousya.bango

            $sql_1 and $sql 
            --AND JHVW048 <> 0
            ) AS UNIONALL                                                                                                           

            LEFT JOIN tantousya                                                                                                         
            ON UNIONALL.JHVW021 = tantousya.bango
            
            --jhvw022
            left join v_torihikisaki as jhvw022Detail on
            jhvw022Detail.torihikisaki_cd = UNIONALL.jhvw022
            --jhvw022 end
            
            --jhvw023
            left join v_torihikisaki as jhvw023Detail on
            jhvw023Detail.torihikisaki_cd = UNIONALL.jhvw023
            --jhvw023 end
            
            --jhvw024
            left join v_torihikisaki as jhvw024Detail on
            jhvw024Detail.torihikisaki_cd = UNIONALL.jhvw024
            --jhvw024 end
            
            --jhvw025
            left join v_torihikisaki as jhvw025Detail on
            jhvw025Detail.torihikisaki_cd = UNIONALL.jhvw025
            --jhvw025 end
            
            --jhvw026
            left join v_torihikisaki as jhvw026Detail on
            jhvw026Detail.torihikisaki_cd = UNIONALL.jhvw026
            --jhvw026 end
            
            left join categorykanri as categorykanriJhvw050
            on substring(tantousya.datatxt0003,1,2) = categorykanriJhvw050.category1
            and substring(tantousya.datatxt0003,3,4) = categorykanriJhvw050.category2
            
            left join categorykanri as categorykanriJhvw051
            on substring(tantousya.datatxt0004,1,2) = categorykanriJhvw051.category1
            and substring(tantousya.datatxt0004,3,5) = categorykanriJhvw051.category2
            
            --jhvw043
            left join categorykanri as categorykanriJhvw043
            on substring(UNIONALL.jhvw043,1,2) = categorykanriJhvw043.category1
            and substring(UNIONALL.jhvw043,3,2) = categorykanriJhvw043.category2
            --jhvw043
            
            --WHERE JHVW048 <> 0
   
            $group_by
            $order_by
        ");
         //dd(QueryHelper::fetchResult("SELECT * FROM backloglist2_6_temp"));
        
        
       // dd($sql,QueryHelper::fetchResult("SELECT * FROM backloglist2_final_temp where jhvw011='0351000273' AND $sql"));
        //$data=DB::table('backloglist2_6_temp')->whereRaw("JHVW049 <> 0 AND $sql");
        $data=DB::table('backloglist2_final_temp')->whereRaw($sql);
       
        
        
        return $data;
        
    }
}