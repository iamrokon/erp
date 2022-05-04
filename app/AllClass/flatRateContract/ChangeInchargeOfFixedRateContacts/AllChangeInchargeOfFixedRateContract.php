<?php


namespace App\AllClass\flatRateContract\ChangeInchargeOfFixedRateContacts;


use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;

class AllChangeInchargeOfFixedRateContract
{

    public static function data($login_bango,$req_data=null)
    {

        $req_incharge = isset($req_data['incharge']) ? substr($req_data['incharge'],0,4): null;
       //dd($req_incharge);
        $search_sql = " where orderhenkan.datachar05 = '$req_incharge' AND tuhanorder.datatxt0122 NOT IN ('J320' ,'J330')";    
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS temp_v_torihikisaki");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE temp_v_torihikisaki as
        select  *
        from v_torihikisaki
        ");
        
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS all_change_incharge_of_fixed_rate_contract_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_change_incharge_of_fixed_rate_contract_temp as
            select distinct
            soukosyukko.datachar02 as contractor,	
            tantousya_contractor.name as formatted_contractor,							
            orderhenkan.datachar07 as contract_number,
            tuhanorder.numeric5 as no_of_contracts,
            LPAD(tuhanorder.numeric5::text,3,'0') as formatted_no_of_contracts,				
            tuhanorder.information2 as sales_destination_r17,
            v_torihikisaki_1.r17_4 as formatted_sales_destination_r17,
            tuhanorder.information1 as contractor_r17,
            v_torihikisaki_2.r17_4 as formatted_contractor_r17,
            tuhanorder.information3 as end_customer_r17,      
            v_torihikisaki_3.r17_4 as formatted_end_customer_r17,
            concat(tantousya_contractor.bango,' ',substring(replace(tantousya_contractor.name,' ',''),1,3)) as formatted_new_charge,
            tuhanorder.money2 as contract_amount,
            to_char(tuhanorder.money2,'FM99,999,999,999,999') as formatted_contract_amount,
            soukosyukko.syouhinname as product_name,
            tuhanorder.datatxt0119 as voucher_remarks,
            tuhanorder.datatxt0112 as regular_subscription_classification,
            concat(categorykanri_g1.category2,' ',categorykanri_g1.category4) as formatted_regular_subscription_classification,
            tuhanorder.datatxt0113 as order_number,
            tuhanorder.numeric6 as order_line_number,
            tuhanorder.numeric7 as order_branch_number,
            tuhanorder.datatxt0118 as in_house_remarks,
            tuhanorder.date0004,
            to_char(tuhanorder.date0004,'YYYY/MM/DD') as paid_start_date,
            tuhanorder.date0005,
            to_char(tuhanorder.date0005,'YYYY/MM/DD') as paid_end_date,           
            tuhanorder.money3 as consumption_tax,
            to_char(tuhanorder.money3,'FM99,999,999,999,999') as formatted_consumption_tax,          
            tuhanorder.datatxt0125 as slip_integration,
            soukosyukko.datachar07 as order_shipping_instructions_remarks,
            soukosyukko.datachar02,
            tuhanorder.datatxt0129 as project_number,
            hikiatesyukko.hanbaibukacd as stamping_phase,
            hikiatesyukko.datachar26 as auto_continuation_flag,	
            hikiatesyukko.datachar27 as auto_sales_flag,
            hikiatesyukko.datachar28 as billed_flag,
            hikiatesyukko.datachar29 as paid_flag,	
            hikiatesyukko.syouhizeiritu as correction_flag,
            tuhanorder.date0006,
            concat(replace(substring(tuhanorder.date0006::text,1,10),'-','/'),' ',substring(tuhanorder.date0006::text,12,8)) as registration_date_time,
            tuhanorder.date0007,
            concat(replace(substring(tuhanorder.date0007::text,1,10),'-','/'),' ',substring(tuhanorder.date0007::text,12,8)) as update_date_time,	
            tuhanorder.datatxt0128 as updater,
            tantousya_updater.name as formatted_updater,
            tuhanorder.datatxt0122 as contract_status,	
            concat(categorykanri_j3.category2,' ',categorykanri_j3.category4) as formatted_contract_status,
            replace(substring(tuhanorder.date0002::text,1,10),'-','/') as contract_period_start_date,
            replace(substring(tuhanorder.date0003::text,1,10),'-','/') as contract_period_end_date

            FROM orderhenkan
            
            join hikiatesyukko on hikiatesyukko.hanbaibukacd = orderhenkan.datachar07	
            
            join tuhanorder on orderhenkan.datachar07 = tuhanorder.datatxt0110

            join soukosyukko on soukosyukko.orderbango = tuhanorder.orderbango 
            and tuhanorder.datatxt0110 = soukosyukko.hanbaibukacd															
            
            left join temp_v_torihikisaki as v_torihikisaki_1 on v_torihikisaki_1.torihikisaki_cd = tuhanorder.information2
            
            left join temp_v_torihikisaki as v_torihikisaki_2 on v_torihikisaki_2.torihikisaki_cd = tuhanorder.information1
            
            left join temp_v_torihikisaki as v_torihikisaki_3 on v_torihikisaki_3.torihikisaki_cd = tuhanorder.information3
            
            left join tantousya as tantousya_contractor on tantousya_contractor.bango = soukosyukko.datachar02 

            left join tantousya as tantousya_updater on tantousya_updater.bango = tuhanorder.datatxt0128								

            left join categorykanri as categorykanri_g1 on categorykanri_g1.category1 = 'G1' and concat(categorykanri_g1.category1,categorykanri_g1.category2) = tuhanorder.datatxt0112
          
            left join categorykanri as categorykanri_j3 on categorykanri_j3.category1 = 'J3' and concat(categorykanri_j3.category1,categorykanri_j3.category2) = tuhanorder.datatxt0122

            $search_sql 

            order by formatted_sales_destination_r17,formatted_contractor_r17,contract_number asc

            ");
         //$display_data = QueryHelper::fetchResult("select * from all_change_incharge_of_fixed_rate_contract_temp");
         //dd($display_data);
         return DB::table('all_change_incharge_of_fixed_rate_contract_temp');
    }
}
