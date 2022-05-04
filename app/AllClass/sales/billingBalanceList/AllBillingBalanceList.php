<?php

namespace App\AllClass\sales\billingBalanceList;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\kengen;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

class AllBillingBalanceList
{

    public static function data($login_bango,$req_data=null){
       
        if(!empty($req_data['categorykanri'])){
            $categorykanri = $req_data['categorykanri'];
        }else{
            $categorykanri = null;
        }

        //dd($categorykanri );

        if(!empty($req_data['print_date'])){
            $print_date = str_replace('/','-',$req_data['print_date']);
        }else{
            $print_date = null;
        }
        
        //d($print_date);

        if(!empty($req_data['sales_Billing_From_db'])){
            $sales_Billing_From_dbRange=$req_data['sales_Billing_From_db'];
        }else{
            $sales_Billing_From_dbRange = null;
        }

        if(!empty($req_data['sales_Billing_To_db'])){
            $sales_Billing_To_dbRange=$req_data['sales_Billing_To_db'];
        }else{
            $sales_Billing_To_dbRange = null;
        }

        //dd($sales_Billing_From_dbRange,$sales_Billing_To_dbRange);

        $search_sql = "";
        
        $search_sql .=" where (kokyaku1.ytoiawsestart = '$categorykanri' OR others2.other3 = '$categorykanri')";
        
        $search_sql .=" and seikyuzandaka.date0009::date = '$print_date'";
        
        if($sales_Billing_From_dbRange && $sales_Billing_To_dbRange){

            if ($sales_Billing_From_dbRange < $sales_Billing_To_dbRange) {

                $search_sql .= " and seikyuzandaka.datatxt0142 between '$sales_Billing_From_dbRange' and '$sales_Billing_To_dbRange'";
            } 
            else if($sales_Billing_From_dbRange > $sales_Billing_To_dbRange){
              
                $search_sql .= " and seikyuzandaka.datatxt0142 between '$sales_Billing_To_dbRange' and '$sales_Billing_From_dbRange'";
            }
            else{

                $search_sql .= " and seikyuzandaka.datatxt0142 like '%$sales_Billing_From_dbRange%'";
            }
        }
        else if($sales_Billing_From_dbRange && ! $sales_Billing_To_dbRange){
                $search_sql .= " and seikyuzandaka.datatxt0142 >= '$sales_Billing_From_dbRange'";
        }
        else if(! $sales_Billing_From_dbRange && $sales_Billing_To_dbRange){
            $search_sql .= " and seikyuzandaka.datatxt0142 <= '$sales_Billing_To_dbRange'";
        }

        $search_sql .=" and (seikyuzandaka.datanum0051 != 0 or seikyuzandaka.datanum0052 != 0 or seikyuzandaka.datanum0053 != 0 or seikyuzandaka.datanum0054 != 0 or seikyuzandaka.datanum0055 != 0 
        or seikyuzandaka.datanum0056 != 0 or seikyuzandaka.datanum0057 != 0 or seikyuzandaka.datanum0058 != 0 or seikyuzandaka.datanum0059 != 0 or seikyuzandaka.datanum0060 != 0 
        or seikyuzandaka.datanum0061 != 0 or seikyuzandaka.datanum0062 != 0 or seikyuzandaka.datanum0063 != 0 or seikyuzandaka.datanum0064 != 0 or seikyuzandaka.datanum0065 != 0 
        or seikyuzandaka.datanum0066 != 0 or seikyuzandaka.datanum0067 != 0 or seikyuzandaka.datanum0068 != 0 or seikyuzandaka.datanum0069 != 0 or seikyuzandaka.datanum0070 != 0 
        or seikyuzandaka.datanum0071 != 0 or seikyuzandaka.datanum0072 != 0 or seikyuzandaka.datanum0073 != 0 or seikyuzandaka.datanum0074 != 0 or seikyuzandaka.datanum0075 != 0 
        or seikyuzandaka.datanum0076 != 0 or seikyuzandaka.datanum0077 != 0 or seikyuzandaka.datanum0078 != 0 or seikyuzandaka.datanum0079 != 0 or seikyuzandaka.datanum0080 != 0 
        or seikyuzandaka.datanum0081 != 0 or seikyuzandaka.datanum0082 != 0 or seikyuzandaka.datanum0083 != 0 or seikyuzandaka.datanum0084 != 0 or seikyuzandaka.datanum0085 != 0) ";
                 
            QueryHelper::runQuery("DROP TABLE IF EXISTS billing_balance_list_temp1");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE billing_balance_list_temp1 as
             select distinct
             seikyuzandaka.datatxt0142,
             seikyuzandaka.datatxt0142 as data201,
             seikyuzandaka.datatxt0142 as data202,
            Case
                When LENGTH(v_torihikisaki.r16) >= 12
                Then concat(SUBSTRING(v_torihikisaki.torihikisaki_cd,1,11),'...')
                Else v_torihikisaki.r16
            End as formatted_data202, 
             --v_torihikisaki.r16 as formatted_data202,
             seikyuzandaka.datanum0051 as data203,
             cast(COALESCE(seikyuzandaka.datanum0059,0) + COALESCE(seikyuzandaka.datanum0076,0) as bigint) as data204,
             cast(COALESCE(seikyuzandaka.datanum0060,0) + COALESCE(seikyuzandaka.datanum0077,0)as bigint) as data205,
             cast(COALESCE(seikyuzandaka.datanum0061,0) + COALESCE(seikyuzandaka.datanum0062,0) + COALESCE(seikyuzandaka.datanum0063,0) + COALESCE(seikyuzandaka.datanum0078,0) + COALESCE(seikyuzandaka.datanum0079,0) + COALESCE(seikyuzandaka.datanum0080,0) as bigint) as data206, 
             cast(COALESCE(seikyuzandaka.datanum0051,0) - COALESCE(seikyuzandaka.datanum0059,0) - COALESCE(seikyuzandaka.datanum0076,0) - COALESCE(seikyuzandaka.datanum0060,0) - COALESCE(seikyuzandaka.datanum0077,0) - COALESCE(seikyuzandaka.datanum0061,0) - COALESCE(seikyuzandaka.datanum0062,0) - COALESCE(seikyuzandaka.datanum0063,0) - COALESCE(seikyuzandaka.datanum0078,0) - COALESCE(seikyuzandaka.datanum0079,0) - COALESCE(seikyuzandaka.datanum0080,0) as bigint) as data207,
             cast(COALESCE(seikyuzandaka.datanum0052,0) + COALESCE(seikyuzandaka.datanum0053,0) + COALESCE(seikyuzandaka.datanum0054,0) + COALESCE(seikyuzandaka.datanum0055,0) as bigint) as data208,
             seikyuzandaka.datanum0056 as data209,
             seikyuzandaka.datanum0064 as data210,
             seikyuzandaka.datanum0057 as data211,
             seikyuzandaka.datanum0058 as data212,
             seikyuzandaka.datatxt0144 as data251,
             seikyuzandaka.datanum0065 as data252,
             cast(COALESCE(seikyuzandaka.datanum0070,0) + COALESCE(seikyuzandaka.datanum0081,0) as bigint) as data253,
             cast(COALESCE(seikyuzandaka.datanum0071,0) + COALESCE(seikyuzandaka.datanum0082,0) as bigint) as data254,
             cast(COALESCE(seikyuzandaka.datanum0072,0) + COALESCE(seikyuzandaka.datanum0073,0) + COALESCE(seikyuzandaka.datanum0074,0) + COALESCE(seikyuzandaka.datanum0083,0) + COALESCE(seikyuzandaka.datanum0084,0) + COALESCE(seikyuzandaka.datanum0085,0) as bigint) as data255,
             cast(COALESCE(seikyuzandaka.datanum0065,0) - COALESCE(seikyuzandaka.datanum0070,0) - COALESCE(seikyuzandaka.datanum0081,0) - COALESCE(seikyuzandaka.datanum0071,0) - COALESCE(seikyuzandaka.datanum0082,0) - COALESCE(seikyuzandaka.datanum0072,0) - COALESCE(seikyuzandaka.datanum0073,0) - COALESCE(seikyuzandaka.datanum0074,0) - COALESCE(seikyuzandaka.datanum0083,0) - COALESCE(seikyuzandaka.datanum0084,0) - COALESCE(seikyuzandaka.datanum0085,0) as bigint) as data256,
             seikyuzandaka.datanum0066 as data257,
             seikyuzandaka.datanum0067 as data258,
             seikyuzandaka.datanum0068 as data259,
             seikyuzandaka.datanum0069 as data260,
             seikyuzandaka.date0009::date,
             (seikyuzandaka.date0010::date) as data261,
             (seikyuzandaka.date0010::time) as data262,
             (seikyuzandaka.date0011::date) as data263,
             (seikyuzandaka.date0011::time) as data264,
             seikyuzandaka.datatxt0143,
             --tantousya.name as data265,
             --substring(replace(replace(tantousya.name,' ',''),'　',''),1,3) as formatted_data265,              
             kokyaku1.ytoiawsestart,
             others2.other3
             
             from seikyuzandaka

                 left join kokyaku1
                 on substr(seikyuzandaka.datatxt0142,1,6) = kokyaku1.yobi12

                 left join haisou
                 on seikyuzandaka.datatxt0142 = concat(haisou.shikibetsucode,haisou.torihikisakibango)
                
                 --left join tuhanorder
                 --on seikyuzandaka.datatxt0142= substr(tuhanorder.information2,1,8)
                 --and seikyuzandaka.date0009=tuhanorder.chumondate
                
                 --left join v_orderinfo on v_orderinfo.bango = tuhanorder.orderbango
                 --and v_orderinfo.juchubango = tuhanorder.juchubango

                 left join v_torihikisaki
                 on seikyuzandaka.datatxt0142= substr(v_torihikisaki.torihikisaki_cd,1,8)

                 left join others2
                 on others2.otherint1=haisou.bango

                 --left join tantousya 
                 --on tantousya.bango = seikyuzandaka.datatxt0143

                 $search_sql

                 ");
        
             //$temp1_data = QueryHelper::fetchResult("select * from billing_balance_list_temp1");
             //dd($temp1_data);
        

            QueryHelper::runQuery("DROP TABLE IF EXISTS billing_balance_list_final");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE billing_balance_list_final as
             select distinct
             billing_balance_list_temp1.*,
             billing_balance_list_temp1.data201 as datatxt201,
             to_char(billing_balance_list_temp1.data203,'FM99,999,999,999,999') as formatted_data203,
             to_char(billing_balance_list_temp1.data204,'FM99,999,999,999,999') as formatted_data204,
             to_char(billing_balance_list_temp1.data205,'FM99,999,999,999,999') as formatted_data205,
             to_char(billing_balance_list_temp1.data206,'FM99,999,999,999,999') as formatted_data206,
             to_char(billing_balance_list_temp1.data207,'FM99,999,999,999,999') as formatted_data207,
             to_char(billing_balance_list_temp1.data208,'FM99,999,999,999,999') as formatted_data208,
             to_char(billing_balance_list_temp1.data209,'FM99,999,999,999,999') as formatted_data209,
             to_char(billing_balance_list_temp1.data210,'FM99,999,999,999,999') as formatted_data210,
             to_char(billing_balance_list_temp1.data211,'FM99,999,999,999,999') as formatted_data211,
             to_char(billing_balance_list_temp1.data212,'FM99,999,999,999,999') as formatted_data212,
             to_char(billing_balance_list_temp1.data252,'FM99,999,999,999,999') as formatted_data252,
             to_char(billing_balance_list_temp1.data253,'FM99,999,999,999,999') as formatted_data253,
             to_char(billing_balance_list_temp1.data254,'FM99,999,999,999,999') as formatted_data254,
             to_char(billing_balance_list_temp1.data255,'FM99,999,999,999,999') as formatted_data255,
             to_char(billing_balance_list_temp1.data256,'FM99,999,999,999,999') as formatted_data256,
             to_char(billing_balance_list_temp1.data257,'FM99,999,999,999,999') as formatted_data257,
             to_char(billing_balance_list_temp1.data258,'FM99,999,999,999,999') as formatted_data258,
             to_char(billing_balance_list_temp1.data259,'FM99,999,999,999,999') as formatted_data259,
             to_char(billing_balance_list_temp1.data260,'FM99,999,999,999,999') as formatted_data260,
             to_char(billing_balance_list_temp1.data261,'YYYY/MM/DD') as formatted_data261,
             to_char(billing_balance_list_temp1.data262,'HH:MI:SS') as formatted_data262,
             to_char(billing_balance_list_temp1.data263,'YYYY/MM/DD') as formatted_data263,
             to_char(billing_balance_list_temp1.data264,'HH:MI:SS') as formatted_data264,
             tantousya.name as data265,
             substring(replace(replace(tantousya.name,' ',''),'　',''),1,3) as formatted_data265

             from billing_balance_list_temp1
             left join tantousya on tantousya.bango =  billing_balance_list_temp1.datatxt0143
             ORDER BY formatted_data202,datatxt201 ASC
             "); 

             //$final_data = QueryHelper::fetchResult("select * from billing_balance_list_final");
             //dd($final_data); 

            $data= DB::table('billing_balance_list_final');
            //dd($data);

            return $data;


    }

}
