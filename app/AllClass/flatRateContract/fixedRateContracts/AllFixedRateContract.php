<?php


namespace App\AllClass\flatRateContract\FixedRateContracts;


use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;

class AllFixedRateContract
{

    public static function data($login_bango,$req_data=null)
    {
        $req_division_start = isset($req_data['division_datachar05_start']) ?  $req_data['division_datachar05_start'] : '';
        $req_division_end = isset($req_data['division_datachar05_end']) ?  $req_data['division_datachar05_end'] : '';
        $req_department_start = isset($req_data['department_datachar05_start']) ? $req_data['department_datachar05_start'] : '';
        $req_department_end = isset($req_data['department_datachar05_end']) ? $req_data['department_datachar05_end'] : '';
        $req_t_group_start = isset($req_data['group_datachar05_start']) ? $req_data['group_datachar05_start'] : '';
        $req_t_group_end = isset($req_data['group_datachar05_end']) ? $req_data['group_datachar05_end'] : '';
        //        if(!empty($fsearch_bangos)){
        //            $bango = implode(',', $fsearch_bangos);
        //        }elseif($first_search_result == "no_data"){
        //            $bango = 0;
        //        }else{
        //            $bango = 0;
        //        }
        //        if($fsearch_bangos!=null){
        //            $search_sql = " where orderhenkan.bango IN ($bango)";
        //        }elseif($first_search_result == "no_data"){
        //            $search_sql = " where orderhenkan.bango IN ($bango)";
        //        }else{
        $search_sql = "where orderhenkan.datachar07 is not null";
        if ($req_division_start != '' && $req_division_end != '' && ($req_division_start != $req_division_end)) {
            $search_sql .= "  and  orderhenkan.datatxt0003 between '$req_division_start' and  '$req_division_end' ";
        } else if ($req_division_start != '') {
            $search_sql .= "  and orderhenkan.datatxt0003 like '%$req_division_start%'";
        }
        if ($req_department_start != '' && $req_department_end != '' && ($req_department_start != $req_department_end)) {
            $search_sql .= "  and orderhenkan.datatxt0004 between '$req_department_start' and '$req_department_end'";
        } else if ($req_department_start != '') {
            $search_sql .= "  and orderhenkan.datatxt0004 like '%$req_department_start%'";
        }
        if ($req_t_group_start != '' && $req_t_group_end != '' && ($req_t_group_start != $req_t_group_end)) {
            $search_sql .= "  and orderhenkan.datatxt0005 between '$req_t_group_start' and '$req_t_group_end'";
        } else if ($req_t_group_start != '') {
            $search_sql .= "  and orderhenkan.datatxt0005 like '%$req_t_group_start%'";
        }
        if (isset($req_data['incharge'])) {
            $incharge = $req_data['incharge'];
            $search_sql .= " AND orderhenkan.datachar05 like '%$incharge%'";
        }
        if (isset($req_data['creation_category'])) {
            $creation_cat = $req_data['creation_category'];
            $search_sql .= " AND tuhanorder.datatxt0122 like '%$creation_cat%'";
        }
        if (isset($req_data['contractor'])) {
            $contractor = $req_data['contractor'];
            $search_sql .= " AND tuhanorder.information1 like '%$contractor%'";
        }
        if (isset($req_data['billing_address'])) {
            $billingAddress = $req_data['billing_address'];
            $search_sql .= " AND tuhanorder.information2 like '%$billingAddress%'";
        }

        if (isset($req_data['end_customer'])) {
            $endCustomer = $req_data['end_customer'];
            $search_sql .= " AND tuhanorder.information3 like '%$endCustomer%'";
        }


        //        }
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS temp_v_torihikisaki");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE temp_v_torihikisaki as
        select  *
        from v_torihikisaki
        ");
        
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS all_fixed_rate_contract_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_fixed_rate_contract_temp  as
            select distinct
            orderhenkan.datachar07,
            orderhenkan.bango,
            hikiatesyukko.datachar26,
            hikiatesyukko.datachar27,
            soukosyukko.datachar09,
            soukosyukko.datachar05 as soukosyukko_datachar05 ,
            soukosyukko.hanbaibukacd,
            tuhanorder.information2 as billing_address,
            tuhanorder.information1 as contractor,
            tuhanorder.information3 as end_customer,
            tuhanorder.orderbango,
            tuhanorder.datatxt0110,
            tuhanorder.datatxt0121,
            tuhanorder.kessaihouhou,
            tuhanorder.datatxt0112,
            tuhanorder.datatxt0111,
            tuhanorder.datatxt0123,
            tuhanorder.datatxt0124,
            tuhanorder.datatxt0122,
            replace(substring(tuhanorder.date0006::text,1,10),'-','/') as registration_date,
            substring(tuhanorder.date0006::text,12,8) as registration_time,
            replace(substring(tuhanorder.date0007::text,1,10),'-','/') as update_date,
            substring(tuhanorder.date0007::text,12,8) as update_time,
            substring(replace(replace(datatxt0128Tantousya.name,'　',''),' ',''),1,3) as changer,
            orderhenkan.datatxt0003,
            orderhenkan.datatxt0004,
            orderhenkan.datatxt0005 ,
            orderhenkan.datachar05,
            orderhenkan.datachar05 as incharge,
            left(categorykanri_j3.groupbango,4) as contract_status,
            concat(tantousya.bango,' ',left(trim(tantousya.name),3)) as in_charge,
            orderhenkan.datachar07 as contract_number,
            CASE
                when length(soukosyukko.syouhinname) >= 22
                then concat(left(soukosyukko.syouhinname,20),'...')
                else soukosyukko.syouhinname end
             as product_name,
            v_torihikisaki_1.r17_4 as billing_address_r17,
            v_torihikisaki_2.r17_4 as contractor_r17,
            v_torihikisaki_3.r17_4 as end_customer_r17,
            to_char(tuhanorder.money2,'FM99,999,999,999,999') as contract_amount,
            to_char(tuhanorder.date0002,'YYYY/MM/DD') as contract_start_date,
            to_char(tuhanorder.numeric8,'FM99,999,999,999,999') as contract_months,
            to_char(tuhanorder.numeric9,'FM99,999,999,999,999') as free_period,
            to_char(tuhanorder.numeric10,'FM99,999,999,999,999') as billing_cycle,
            left(categorykanri_j4.groupbango,4) as billing_month,
            concat(request_1.syouhinbango,' ',request_1.jouhou) as automatic_continuation,
            concat(request_2.syouhinbango,' ',request_2.jouhou) as automatic_sales,
            upper(left(tuhanorder.datatxt0125,2)) as voucher_integration,
            left(categorykanri_a9.groupbango,4) as payment_method,
            tuhanorder.numeric5 as number_of_contracts,
            concat(request_3.syouhinbango,' ',request_3.jouhou) as creation_category_temp,
            left(categorykanri_g1.groupbango,4) as subscription_classification,
            tuhanorder.datatxt0113 as order_number,
            tuhanorder.numeric6 as line_number,
            tuhanorder.numeric7 as branch_number,
            tuhanorder.datatxt0115 as storage_number,
            tuhanorder.datatxt0120 as warranty_number,
            to_char(tuhanorder.date0003,'YYYY/MM/DD') as contract_end_number,
            to_char(tuhanorder.date0004,'YYYY/MM/DD') as paid_start_date,
            to_char(tuhanorder.date0005,'YYYY/MM/DD') as paid_end_date,
            v_torihikisaki_4.r17_4   as supplier_cd,
            v_torihikisaki_5.r17_4  as company_cd,
            tuhanorder.numericmax  as  number_of_windows,
            v_torihikisaki_6.r17_4  as  maintenance_window_cd,
            to_char(soukosyukko.syukkasu,'FM99,999,999,999,999') as quantity,
            soukosyukko.codename as unit,
            to_char(tuhanorder.money1,'FM99,999,999,999,999') as unit_price,
            to_char(tuhanorder.money3,'FM99,999,999,999,999') as consumption_tax,
            to_char(tuhanorder.money4,'FM99,999,999,999,999') as gross_operating_profit,
            to_char(tuhanorder.money5,'FM99,999,999,999,999') as se_gross_profit,
            to_char(tuhanorder.money6,'FM99,999,999,999,999') as lab_gross_profit,
            to_char(tuhanorder.money7,'FM99,999,999,999,999') as sc_gross_profit,
            to_char(tuhanorder.money8,'FM99,999,999,999,999') as purchase_amount,
            concat(categorykanri_g3.category2,' ',categorykanri_g3.category4) as delivery_method,
            
            replace(substring(hikiatesyukko.kanryoubi::text,1,10),'-','/') as registration_date_2,
            substring(hikiatesyukko.kanryoubi::text,12,8) as registration_time_2,
            replace(substring(hikiatesyukko.denpyohakkoubi::text,1,10),'-','/') as update_date_2,
            substring(hikiatesyukko.denpyohakkoubi::text,12,8) as update_time_2,
            substring(replace(replace(syouhinbukacdTantousya.name,'　',''),' ',''),1,3) as changer_2
            
            FROM tuhanorder
            left join v_orderhenkan as orderhenkan on orderhenkan.bango = tuhanorder.orderbango
            left join tantousya on tantousya.bango = orderhenkan.datachar05
            left join hikiatesyukko on hikiatesyukko.orderbango = orderhenkan.bango
            left join temp_v_torihikisaki as v_torihikisaki_1 on v_torihikisaki_1.torihikisaki_cd = tuhanorder.information2
            left join temp_v_torihikisaki as v_torihikisaki_2 on v_torihikisaki_2.torihikisaki_cd = tuhanorder.information1
            left join temp_v_torihikisaki as v_torihikisaki_3 on v_torihikisaki_3.torihikisaki_cd = tuhanorder.information3
            left join soukosyukko on soukosyukko.orderbango = tuhanorder.orderbango and tuhanorder.datatxt0110 = soukosyukko.hanbaibukacd
            left join categorykanri as categorykanri_j3 on categorykanri_j3.category1 = 'J3' and concat(categorykanri_j3.category1,categorykanri_j3.category2) = tuhanorder.datatxt0122
            left join categorykanri as categorykanri_j4 on categorykanri_j4.category1 = 'J4' and concat(categorykanri_j4.category1,categorykanri_j4.category2) = tuhanorder.datatxt0121
            left join categorykanri as categorykanri_a9 on categorykanri_a9.category1 = 'A9' and concat(categorykanri_a9.category1,categorykanri_a9.category2) = tuhanorder.kessaihouhou
            left join categorykanri as categorykanri_g1 on categorykanri_g1.category1 = 'G1' and concat(categorykanri_g1.category1,categorykanri_g1.category2) = tuhanorder.datatxt0112
            left join categorykanri as categorykanri_g3 on categorykanri_g3.category1 = 'G3' and concat(categorykanri_g3.category1,categorykanri_g3.category2) = soukosyukko.datachar09
            left join request as request_1 on request_1.color = '0302自動継続フラグ' and request_1.syouhinbango = hikiatesyukko.datachar26::int
            left join request as request_2 on request_2.color = '0302自動売上フラグ' and request_2.syouhinbango = hikiatesyukko.datachar27::int
            left join request as request_3 on request_3.color = '0302作成区分' and request_3.syouhinbango = tuhanorder.datatxt0111::int
            left join temp_v_torihikisaki as v_torihikisaki_4 on v_torihikisaki_4.torihikisaki_cd = soukosyukko.datachar05
            left join temp_v_torihikisaki as v_torihikisaki_5 on v_torihikisaki_5.torihikisaki_cd = tuhanorder.datatxt0123
            left join temp_v_torihikisaki as v_torihikisaki_6 on v_torihikisaki_6.torihikisaki_cd = tuhanorder.datatxt0124
            left join tantousya as datatxt0128Tantousya on datatxt0128Tantousya.bango = tuhanorder.datatxt0128
            left join tantousya as syouhinbukacdTantousya on syouhinbukacdTantousya.bango = hikiatesyukko.syouhinbukacd
            $search_sql
            order by orderhenkan.datachar05, orderhenkan.datachar07 asc
            ");
        //      dd( QueryHelper::fetchResult(DB::table('all_fixed_rate_contract_temp')->toSql()));
        return  DB::table('all_fixed_rate_contract_temp');
    }
}
