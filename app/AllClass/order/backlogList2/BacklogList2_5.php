<?php

namespace App\AllClass\order\backlogList2;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class BacklogList2_5{
    public static function data($login_bango,$deleted_item=2,$req_data=null){
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS temp_backloglist2_3_temp");
        QueryHelper::runQuery("SELECT * INTO temp_backloglist2_3_temp FROM backloglist2_3_temp");
        QueryHelper::runQuery("ALTER TABLE temp_backloglist2_3_temp DROP COLUMN 分類粗利単価");
        QueryHelper::runQuery("ALTER TABLE temp_backloglist2_3_temp DROP COLUMN 分類粗利額");
//dd(QueryHelper::fetchResult('select*from temp_backloglist2_3_temp limit 1'),QueryHelper::fetchResult('select*from backloglist2_3_temp limit 1'));
        QueryHelper::runQuery("DROP TABLE IF EXISTS backloglist2_5_temp");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE backloglist2_5_temp as
        SELECT																		
           distinct															
            J.*

            --,backloglist2_4_temp.HS0001
            --,backloglist2_4_temp.HS0002
            --,backloglist2_4_temp.HS0003
            --,backloglist2_4_temp.HS0004
            --,backloglist2_4_temp.HC0009
            --,backloglist2_4_temp.HC0005
            --,backloglist2_4_temp.HS0028
            --,backloglist2_4_temp.HS0011
            --,backloglist2_4_temp.HS0050
            --,backloglist2_4_temp.HS0008			
            --,backloglist2_4_temp.HC0007																	            											
            , J.受注残判定 AS 受注残判定_v5																																
            , J.納品先ＣＤ AS 納品先ＣＤ_v5																																
            , J.商品ＣＤ AS 商品ＣＤ_v5																																
            , J.商品名 AS 商品名_v5																																
            , 1 AS 分類数量_v5																																
            , J.発注金額分類 AS 発注金額分類_v5																																
            , J.分類明細金額 分類明細金額_v5																																
            , J.明細担当 AS 明細担当_v5																																
            --,(J.分類明細金額 - ( HG.発注粗利合計 + JG.受注粗利合計 ) - J.JM0033	) AS 分類粗利単価_v5															

            ,(J.分類明細金額 - J.JM0033   ) AS 分類粗利単価_v5
            ,(J.分類明細金額 - J.JM0033   ) AS 分類粗利額_v5								


            from (
                select
                J1.*
                ,(J1.分類明細金額 - ( HG1.発注粗利合計 + (J1.JM0018 * J1.JM0012) )) AS 分類粗利単価
                ,(J1.分類明細金額 - ( HG1.発注粗利合計 + (J1.JM0018 * J1.JM0012) )) AS 分類粗利額  
                                                                   

                from (select * from temp_backloglist2_3_temp where 発注金額分類 ='V110')    AS J1
                , (SELECT JU0001,  JU0002, MIN(JM0003) AS MIN枝番 FROM backloglist2_3_temp WHERE 発注金額分類 = 'V150' GROUP BY JU0001, JU0002 HAVING COUNT(JM0003)>1) AS JG1
                , (SELECT JU0001, JU0002, (SUM(分類粗利額) + SUM(JM0018 * JM0012) ) AS 発注粗利合計 FROM backloglist2_4_temp GROUP BY JU0001, JU0002) AS HG1

                WHERE J1.JU0001 = HG1.JU0001 AND J1.JU0001 = JG1.JU0001 AND J1.JU0002 = HG1.JU0002 AND J1.JU0002 = JG1.JU0002 AND J1.JM0003 =  JG1.MIN枝番

               
                UNION ALL                                                                                                                   
                                                                                                    
                 SELECT                                                                                                                  
                    J2.*                                                                                                               
                 FROM                                                                                                                   
                   (SELECT * FROM backloglist2_3_temp WHERE 発注金額分類 = 'V110') AS J2                        
                   ,(SELECT JU0001,  JU0002, MIN(JM0003) AS MIN枝番 FROM backloglist2_3_temp WHERE 発注金額分類 = 'V110' GROUP BY JU0001, JU0002 HAVING COUNT(JM0003)>1) AS JG2                                                                                                              
                 WHERE J2.JU0001 = JG2.JU0001 AND J2.JU0002 = JG2.JU0002 AND J2.JM0003 > JG2.MIN枝番                                                                

                UNION ALL                                                       
                   SELECT                                                              
                    J0.*                                                                                                   
                   FROM                                                                                                       
                   (SELECT * FROM backloglist2_3_temp WHERE 発注金額分類 = 'V110') AS J0   
                   ,(SELECT JU0001,  JU0002, MIN(JM0003) AS MIN枝番 FROM backloglist2_3_temp WHERE 発注金額分類 = 'V110' GROUP BY JU0001, JU0002 HAVING COUNT(JM0003)=1) AS JG0                                                                                                  
                   WHERE J0.JU0001 = JG0.JU0001 AND J0.JU0002 = JG0.JU0002 AND J0.JM0003 =  JG0.MIN枝番                                                                                                 
                                               


            )	AS J				
                    
		
        ");
         //dd(QueryHelper::fetchResult('SELECT * FROM backloglist2_5_temp'));
        //only for qc purpose
        QueryHelper::runQuery("DROP TABLE IF EXISTS backlog2_5");
        QueryHelper::runQuery("CREATE TABLE backlog2_5
        AS (SELECT * FROM backloglist2_5_temp)");
        
        //$data=DB::table('backloglist2_5_temp');
        //return $data;
        
    }
}
