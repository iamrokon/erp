<?php
namespace App\AllClass\flatRateContract\FixedRateInquiry;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;

class AllFixedRateInquiry{
    public static function data($datachar07 = null){
        $searchSql = "where orderhenkan.datachar07 is not null";
        if ($datachar07){
            $searchSql .= " and orderhenkan.datachar07 = '$datachar07'";
        }
        QueryHelper::runQuery("DROP TABLE IF EXISTS all_fixed_rate_inquiry_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_fixed_rate_inquiry_temp  as
            select distinct
            tuhanorder.orderbango as t_orderbango,
            orderhenkan.datachar07,
            concat(categorykanri_g1.category2,' ',categorykanri_g1.category4) as subscription_classification,
            concat(request_3.syouhinbango,' ',request_3.jouhou) as creation_category,
            orderhenkan.datachar07 as flat_rate_contract_number,
            tuhanorder.numeric5 as number_of_contracts,
            tuhanorder.datatxt0113 as order_number,
            tuhanorder.numeric6 as line,
            tuhanorder.numeric7 as branch,
            concat(categorykanri_j3.category2,' ',categorykanri_j3.category4) as contract_status,
            v_torihikisaki_2.r17_3cd as billing_address,
            v_torihikisaki_1.r17_3cd as contractor,
            v_torihikisaki_3.r17_3cd as end_customer,
            v_torihikisaki_8.r17_3cd as end_to,
            tuhanorder.datatxt0129 as pj,
            concat(categorykanri_h1.category2,' ',categorykanri_h1.category4) as document_type,
            concat(tantousya.bango,' ',tantousya.name) as in_charge,
            concat(categorykanri_a9.category2,' ',categorykanri_a9.category4) as payment_method,
            tuhanorder.datatxt0116 as deposit_month,
            tuhanorder.datatxt0117 as payment_day,
            concat(request_4.syouhinbango,' ',request_4.jouhou) as immediate_classification,
            concat(categorykanri_b1.category2,' ',categorykanri_b1.category4) as billing_tax_classification,
            case
            when cast(strpos(soukonyuko.datachar09,'¶') as boolean)  and length(split_part(soukonyuko.datachar09,'¶',1)) < 10
                then split_part(soukonyuko.datachar09,'¶',1) || '.'||RIGHT(soukonyuko.datachar09, 3)
            when cast(strpos(soukonyuko.datachar09,'¶') as boolean)
                then LEFT(split_part(soukonyuko.datachar09,'¶',1), 10)||'...'||RIGHT(soukonyuko.datachar09, 3)
            else  LEFT(soukonyuko.datachar09, 10)||'...'||RIGHT(soukonyuko.datachar09, 3) end as contract_pdf,
            soukonyuko.datachar09 as contract_pdf_show,
            soukosyukko.kawasename as product_cd,
            soukosyukko.syouhinname as product_name,
            soukosyukko.syukkasu as quantity,
            tuhanorder.money1 as unit_price,
            tuhanorder.money2 as contract_amount,
            to_char(tuhanorder.date0002,'YYYY/MM/DD') as contract_period_start,
            tuhanorder.numeric8 as contract_month,
            to_char(tuhanorder.date0003,'YYYY/MM/DD') as contract_period_end,
            concat(request_1.syouhinbango,' ',request_1.jouhou) as automatic_continution,
            v_torihikisaki_6.r17_3cd as maintenance_window,
            tuhanorder.numericmax as number_of_windows,
            v_torihikisaki_5.r17_3cd as maintenance_company,
            tuhanorder.datatxt0120 as warranty_number,
            tantousya2.name as se,
            tuhanorder.numeric9 as free_period_months,
            tuhanorder.numeric10 as billing_cycle,
            concat(categorykanri_j4.category2,' ',categorykanri_j4.category4)   as  billing_month,
            tuhanorder.datatxt0125 as  voucher_registration,
            soukosyukko.datachar03 as  manufacture_part_number,
            soukosyukko.datachar04 as  manufacture_part_name,
            v_torihikisaki_4.r17_3cd   as  supplier,
            soukosyukko.dataint09   as  order_date,
            soukosyukko.dataint10   as  individual_delivery_date,
            v_torihikisaki_7.r17_3cd   as  delivery_destination,
            soukosyukko.datachar07  as  order_shipping_remarks,
            concat(categorykanri_g3.category2,' ',categorykanri_g3.category4)   as  delivery_method,
            to_char(tuhanorder.date0004,'YYYY/MM/DD') as  paid_period_start,
            to_char(tuhanorder.date0005,'YYYY/MM/DD') as  paid_period_end,
            tuhanorder.numeric1 as  accounting_date,
            concat(request_2.syouhinbango,' ',request_2.jouhou) as  automatic_sales,
            tuhanorder.datatxt0119 as  voucher_remarks,
            tuhanorder.datatxt0118 as  in_house_remarks,
            tuhanorder.money4 as  gross_operating_profits,
            tuhanorder.money5 as  se_1,
            tuhanorder.money6 as  laboratory,
            tuhanorder.money7 as  call_1,
            tuhanorder.money8 as purchase_amount
            FROM tuhanorder
            left join v_orderhenkan as orderhenkan on orderhenkan.bango = tuhanorder.orderbango
            left join tantousya on tantousya.bango = orderhenkan.datachar05
            left join hikiatesyukko on hikiatesyukko.orderbango = orderhenkan.bango
            left join soukonyuko on  soukonyuko.datachar01 = tuhanorder.datatxt0115
            left join soukosyukko on soukosyukko.orderbango = tuhanorder.orderbango and tuhanorder.datatxt0110 = soukosyukko.hanbaibukacd
            left join tantousya as tantousya2  on tantousya2.bango =  soukosyukko.datachar02
            left join v_torihikisaki as v_torihikisaki_1 on v_torihikisaki_1.torihikisaki_cd = tuhanorder.information1
            left join v_torihikisaki as v_torihikisaki_2 on v_torihikisaki_2.torihikisaki_cd = tuhanorder.information2
            left join v_torihikisaki as v_torihikisaki_3 on v_torihikisaki_3.torihikisaki_cd = tuhanorder.information3
            left join v_torihikisaki as v_torihikisaki_4 on v_torihikisaki_4.torihikisaki_cd = soukosyukko.datachar05
            left join v_torihikisaki as v_torihikisaki_5 on v_torihikisaki_5.torihikisaki_cd = tuhanorder.datatxt0123
            left join v_torihikisaki as v_torihikisaki_6 on v_torihikisaki_6.torihikisaki_cd = tuhanorder.datatxt0124
            left join v_torihikisaki as v_torihikisaki_7 on v_torihikisaki_7.torihikisaki_cd = soukosyukko.datachar06
            left join v_torihikisaki as v_torihikisaki_8 on v_torihikisaki_8.torihikisaki_cd = tuhanorder.information6
            left join categorykanri as categorykanri_g1 on categorykanri_g1.category1 = 'G1' and concat(categorykanri_g1.category1,categorykanri_g1.category2) = tuhanorder.datatxt0112
            left join categorykanri as categorykanri_j3 on categorykanri_j3.category1 = 'J3' and concat(categorykanri_j3.category1,categorykanri_j3.category2) = tuhanorder.datatxt0122
            left join categorykanri as categorykanri_h1 on categorykanri_h1.category1 = 'H1' and concat(categorykanri_h1.category1,categorykanri_h1.category2) = tuhanorder.datatxt0114
            left join categorykanri as categorykanri_a9 on categorykanri_a9.category1 = 'A9' and concat(categorykanri_a9.category1,categorykanri_a9.category2) = tuhanorder.kessaihouhou
            left join categorykanri as categorykanri_b1 on categorykanri_b1.category1 = 'B1' and concat(categorykanri_b1.category1,categorykanri_b1.category2) =  tuhanorder.otodoketime
            left join categorykanri as categorykanri_j4 on categorykanri_j4.category1 = 'J4' and concat(categorykanri_j4.category1,categorykanri_j4.category2) = tuhanorder.datatxt0121
            left join categorykanri as categorykanri_g3 on categorykanri_g3.category1 = 'G3' and concat(categorykanri_g3.category1,categorykanri_g3.category2) = soukosyukko.datachar09
            left join request as request_1 on request_1.color = '0302自動継続フラグ' and request_1.syouhinbango = hikiatesyukko.datachar26::int
            left join request as request_2 on request_2.color = '0302自動売上フラグ' and request_2.syouhinbango = hikiatesyukko.datachar27::int
            left join request as request_3 on request_3.color = '0302作成区分' and request_3.syouhinbango = tuhanorder.datatxt0111::int
            left join request as request_4 on request_4.color = '0302即時区分' and request_4.syouhinbango = tuhanorder.datatxt0111::int
            $searchSql");
//      dd( QueryHelper::fetchResult(DB::table('all_fixed_rate_contract_temp')->toSql()));
        return  DB::table('all_fixed_rate_inquiry_temp');
    }
}
