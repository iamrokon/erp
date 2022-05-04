<?php

namespace App\AllClass\order\backlogList2;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class BacklogList2_3{
    public static function data($login_bango,$deleted_item=2,$req_data=null){
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS backloglist2_3_temp");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE backloglist2_3_temp as
        SELECT * FROM (																																	
		SELECT 	distinct																															
			backloglist2_1_temp.*																															
			, '1' AS 受注残判定
			, JM0026 AS 納品先ＣＤ
			, CAST(JM0007 as character(13)) AS 商品ＣＤ
			, JM0008 AS 商品名
			, JM0012 AS 分類数量	
			, 'V110' AS 発注金額分類
			, JM0035 AS 分類明細金額	
			, JM0019 AS 明細担当	
			--, (JM0014 - JM0015 - JM0016 - JM0017 - JM0018) AS 分類粗利単価	
			, CASE
                            WHEN (JM0006 = '3' AND JM0038 IS NOT NULL) OR (JM0006 = '3' AND JM0038 IS NOT NULL) THEN 0
                            ELSE ROUND(((JM0035 -((JM0015 + JM0016 + JM0017 + JM0018) * JM0012) - JM0033) / JM0012)::decimal,0) END AS 分類粗利単価	
                            --ELSE (JM0035 -((JM0015 + JM0016 + JM0017 + JM0018) * JM0012) - JM0033) / JM0012 END AS 分類粗利単価	
			--, ((JM0014 - JM0015 - JM0016 - JM0017 - JM0018) * JM0012)AS 分類粗利額	
                        , CASE
                            WHEN (JM0006 = '3' AND JM0038 IS NOT NULL) OR (JM0006 = '3' AND JM0038 IS NOT NULL) THEN 0
                            ELSE (JM0035 - ((JM0015 + JM0016 + JM0017 + JM0018) * JM0012) - JM0033) END AS 分類粗利額
		FROM backloglist2_1_temp																													 																															
		UNION ALL																																
		SELECT 																																
			backloglist2_1_temp.*																															
			, '1' AS 受注残判定, JM0026 AS 納品先ＣＤ, CAST(JM0007 as character(13)) AS 商品ＣＤ, JU0015 AS 商品名, JM0012 AS 分類数量																															
			, 'V120' AS 発注金額分類																															
			, 0 AS 分類明細金額																															
			, JM0020 AS 明細担当																															
			--, JM0015 AS 分類粗利単価		
                        , CASE
                            WHEN (JM0006 = '3' AND JM0038 IS NOT NULL) THEN 0
                            ELSE JM0015 END AS 分類粗利単価
			--, (JM0015 * JM0012) AS 分類粗利額	
                        , CASE
                            WHEN (JM0006 = '3' AND JM0038 IS NOT NULL) THEN 0
                            ELSE (JM0015 * JM0012) END AS 分類粗利額
		FROM backloglist2_1_temp	
                    WHERE JM0015 <> 0
		UNION ALL																																
		SELECT 																																
			backloglist2_1_temp.*																															
			, '1' AS 受注残判定, JM0026 AS 納品先ＣＤ, CAST(JM0007 as character(13)) AS 商品ＣＤ, JM0008 AS 商品名, JM0012 AS 分類数量																															
			, 'V130' AS 発注金額分類																															
			, 0 AS 分類明細金額																															
			, '0020' AS 明細担当																															
			--, JM0016 AS 分類粗利単価	
                        , CASE
                            WHEN (JM0006 = '3' AND JM0038 IS NOT NULL) THEN 0
                            ELSE JM0016 END AS 分類粗利単価
			--, (JM0016 * JM0012) AS 分類粗利額
                        , CASE
                            WHEN (JM0006 = '3' AND JM0038 IS NOT NULL) THEN 0
                            ELSE (JM0016 * JM0012) END AS 分類粗利額
		FROM backloglist2_1_temp
                    WHERE JM0016 <> 0
		UNION ALL																																
		SELECT 																																
			backloglist2_1_temp.*																															
			, '1' AS 受注残判定, JM0026 AS 納品先ＣＤ, CAST(JM0007  as character(13)) AS 商品ＣＤ, JM0008  AS 商品名, JM0012 AS 分類数量																															
			, 'V140' AS 発注金額分類																															
			, 0 AS 分類明細金額																															
			, '0970' AS 明細担当																															
			--, JM0017 AS 分類粗利単価	
                        , CASE
                            WHEN (JM0006 = '3' AND JM0038 IS NOT NULL) THEN 0
                            ELSE JM0017 END AS 分類粗利単価
			--, (JM0017 * JM0012) AS 分類粗利額	
                        , CASE
                            WHEN (JM0006 = '3' AND JM0038 IS NOT NULL) THEN 0
                            ELSE (JM0017 * JM0012) END AS 分類粗利額
		FROM backloglist2_1_temp																																
                    WHERE JM0017 <> 0
	) UNIONJU
		
        ");
         
        //only for qc purpose
        QueryHelper::runQuery("DROP TABLE IF EXISTS backlog2_3");
        QueryHelper::runQuery("CREATE TABLE backlog2_3
        AS (SELECT * FROM backloglist2_3_temp)");
        
        //$data=DB::table('backloglist2_3_temp');
        //return $data;
        
    }
}
