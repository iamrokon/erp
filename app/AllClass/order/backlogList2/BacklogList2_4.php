<?php

namespace App\AllClass\order\backlogList2;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class BacklogList2_4{
    public static function data($login_bango,$deleted_item=2,$req_data=null){
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS backloglist2_4_temp");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE backloglist2_4_temp as
        SELECT									
        distinct															
		J.*															
		, H.*																																
		, J.受注残判定 as 受注残判定_v4																																
		, (CASE WHEN J.JMF006 = '1' THEN J.JM0026 ELSE H.HS0011 END) AS 納品先ＣＤ_v4																																
		--, (CASE WHEN H.HS0001 IS NULL THEN J.商品ＣＤ ELSE H.HS0022 END) AS 商品ＣＤ_v4																																
		, (CASE WHEN H.HS0001 IS NULL THEN J.商品ＣＤ ELSE H.HS0012 END) AS 商品ＣＤ_v4																																
		--, (CASE WHEN J.発注金額分類 = 'V120' THEN J.JU0015 ELSE H.HS0023 END) AS 商品名_v4
                , (CASE WHEN H.HS0001 IS NULL THEN J.商品名 ELSE H.HS0013 END) AS 商品名_v4
		, (CASE WHEN H.HS0001 IS NULL THEN J.分類数量 ELSE H.HS0017 END) AS 分類数量_v4																																
		, (CASE WHEN H.HS0001 IS NULL THEN J.発注金額分類 ELSE H.HS0008 END) AS 発注金額分類_v4																																
		--, J.分類明細金額 as 分類明細金額_v4																																
		, 0 as 分類明細金額_v4																																
		, (CASE WHEN H.HS0001 IS NULL THEN J.明細担当 ELSE H.HS0028 END) AS 明細担当_v4																																
		, (CASE WHEN H.HS0001 IS NULL THEN J.分類粗利単価 ELSE H.HS0020 END) AS 分類粗利単価_v4																																
		, (CASE WHEN H.HS0001 IS NULL THEN J.分類粗利額 ELSE (H.HS0020 * H.HS0017) END) AS 分類粗利額_v4																																
	FROM backloglist2_3_temp AS J 

	LEFT JOIN backloglist2_2_temp AS H ON 																																	
	J.JM0001 = H.HS0005 AND																																	
	J.JM0002 = H.HS0006 AND																																	
	J.JM0003 = H.HS0007 AND																																	
	J.発注金額分類 = H.HS0008							
	WHERE																																	
		J.発注金額分類 <> 'V110'
		
        ");
       
        //only for qc purpose
        QueryHelper::runQuery("DROP TABLE IF EXISTS backlog2_4");
        QueryHelper::runQuery("CREATE TABLE backlog2_4
        AS (SELECT * FROM backloglist2_4_temp)");
        
        //$data=DB::table('backloglist2_4_temp');
        //return $data;
        
    }
}
