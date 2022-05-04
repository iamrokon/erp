<?php

namespace App\AllClass\sales\accountList;

use DB;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class allData
{
    public static function read_data($req_data, $bangos = [], $first_search_res = NULL)
    {
        $conditions = [];
        $conditions_zero = [];
        if(!empty($bangos))
        {
            $conditions[] = " urikakezandaka.datatxt0138::bigint IN (". implode(',', $bangos).")";
        }
        else if(count($bangos)===0 && $first_search_res=="no_data")
        {
            $conditions[] = " urikakezandaka.datatxt0138::bigint IN (0)";
        }

        if(isset($req_data['date']))
        {
            $date = str_replace('/', '-', $req_data['date']).'-01 00:00:00';
            $conditions[] = " urikakezandaka.date0008 = '$date'";
            $conditions[] = " length(urikakezandaka.datatxt0138) = '8' ";
        }
        if(isset($req_data['information2_1_short']) && isset($req_data['information2_2_short'])){
            if($req_data['information2_1_short']!=null && $req_data['information2_2_short']!=null)
            {
                $temp_query_1 = $req_data['information2_1_short'].'::bigint';
                $temp_query_2 = $req_data['information2_2_short'].'::bigint';
                $conditions[] = " urikakezandaka.datatxt0138::bigint >= $temp_query_1 ";
                $conditions[] = " urikakezandaka.datatxt0138::bigint <= $temp_query_2 ";
            }
            elseif ($req_data['information2_1_short']==null && $req_data['information2_2_short']!=null)
            {
                $temp_query_2 = $req_data['information2_2_short'].'::bigint';
                $conditions[] = " urikakezandaka.datatxt0138::bigint <= $temp_query_2 ";

            }
            elseif ($req_data['information2_2_short']==null && $req_data['information2_1_short']!=null)
            {
                $temp_query_1 = $req_data['information2_1_short'].'::bigint';
                $conditions[] = " urikakezandaka.datatxt0138::bigint >= $temp_query_1 ";
            }
        }
        
        $conditions_zero[] = " prev_receivable != 0 ";
        $conditions_zero[] = " sales != 0 ";
        $conditions_zero[] = " discount != 0 ";
        $conditions_zero[] = " consumption_tax != 0 ";
        $conditions_zero[] = " cash != 0 ";
        $conditions_zero[] = " bills != 0 ";
        $conditions_zero[] = " other_deposit != 0 ";
        $conditions_zero[] = " rem_recievable != 0 ";
        $conditions_zero[] = " loan_balance != 0 ";
        $conditions_zero[] = " cred_balance != 0 ";

        if(count($conditions_zero) > 0) $where_string_zero = " WHERE ". implode(' OR ', $conditions_zero);
        else $where_string_zero = "";

        if(count($conditions) > 0) $where_string = " WHERE ". implode(' AND ', $conditions);
        else $where_string = "";
//        dd($where_string);
        try {
            QueryHelper::runQuery("DROP TABLE IF EXISTS account_list_v_torihikisaki ");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE account_list_v_torihikisaki as
            select *
            from v_torihikisaki
            ");
        
            QueryHelper::runQuery("DROP TABLE IF EXISTS A_L_Temp1");
            QueryHelper::runQuery("DROP TABLE IF EXISTS A_L_Temp2_Sum");
            //QueryHelper::runQuery("DROP TABLE IF EXISTS A_L_Temp3_Sum");
            QueryHelper::runQuery("DROP TABLE IF EXISTS all_accounts_temp_total");
            QueryHelper::runQuery("DROP TABLE IF EXISTS A_L_Temp2");
            QueryHelper::runQuery("DROP TABLE IF EXISTS all_accounts_temp");

            QueryHelper::runQuery("CREATE TEMPORARY TABLE A_L_Temp1 as
            select  distinct urikakezandaka.datatxt0138 as sales_billing_cd,
                    urikakezandaka.date0008 as db_date,
                    v_torihikisaki_1.r16 as sales_billing_name,
                    --trim(trailing '/' || reverse(split_part(reverse(v_torihikisaki_1.r17_3), '/', 1)) from v_torihikisaki_1.r17_3) as sales_billing_name_xls,
                    --'/' || reverse(split_part(reverse(v_torihikisaki_1.r17_3), '/', 1)) as test,
                    --reverse(split_part(reverse(v_torihikisaki_1.r17_3), '/', 1)) as test1,
                    COALESCE(urikakezandaka.datanum0021,0) as prev_receivable,
                    to_char(COALESCE(urikakezandaka.datanum0021,0) , 'FM999,999,999,999') as prev_receivable_commafied,
                    COALESCE(urikakezandaka.datanum0022,0) as sales,
                    to_char(COALESCE(urikakezandaka.datanum0022,0) , 'FM999,999,999,999') as sales_commafied,
                    COALESCE(urikakezandaka.datanum0023,0) + COALESCE(urikakezandaka.datanum0024,0) + COALESCE(urikakezandaka.datanum0025,0) as discount,
                    to_char(COALESCE(urikakezandaka.datanum0023,0) + COALESCE(urikakezandaka.datanum0024,0) + COALESCE(urikakezandaka.datanum0025,0) , 'FM999,999,999,999') as discount_commafied,
                    COALESCE(urikakezandaka.datanum0026,0) as consumption_tax,
                    to_char(COALESCE(urikakezandaka.datanum0026,0) , 'FM999,999,999,999') as consumption_tax_commafied,
                    COALESCE(urikakezandaka.datanum0027,0) as cash,
                    to_char(COALESCE(urikakezandaka.datanum0027,0) , 'FM999,999,999,999') as cash_commafied,
                    COALESCE(urikakezandaka.datanum0028,0) as bills,
                    to_char(COALESCE(urikakezandaka.datanum0028,0) , 'FM999,999,999,999') as bills_commafied,
                    COALESCE(urikakezandaka.datanum0029,0) + COALESCE(urikakezandaka.datanum0030,0) + COALESCE(urikakezandaka.datanum0031,0) as other_deposit,
                    to_char(COALESCE(urikakezandaka.datanum0029,0) + COALESCE(urikakezandaka.datanum0030,0) + COALESCE(urikakezandaka.datanum0031,0) , 'FM999,999,999,999') as other_deposit_commafied,
                    COALESCE(urikakezandaka.datanum0021,0) + COALESCE(urikakezandaka.datanum0022,0) + COALESCE(urikakezandaka.datanum0023,0) + COALESCE(urikakezandaka.datanum0024,0) + COALESCE(urikakezandaka.datanum0025,0) + COALESCE(urikakezandaka.datanum0026,0) - COALESCE(urikakezandaka.datanum0027,0) - COALESCE(urikakezandaka.datanum0028,0) - COALESCE(urikakezandaka.datanum0029,0) - COALESCE(urikakezandaka.datanum0030,0) - COALESCE(urikakezandaka.datanum0031,0) as rem_recievable,
                    to_char(COALESCE(urikakezandaka.datanum0021,0) + COALESCE(urikakezandaka.datanum0022,0) + COALESCE(urikakezandaka.datanum0023,0) + COALESCE(urikakezandaka.datanum0024,0) + COALESCE(urikakezandaka.datanum0025,0) + COALESCE(urikakezandaka.datanum0026,0) - COALESCE(urikakezandaka.datanum0027,0) - COALESCE(urikakezandaka.datanum0028,0) - COALESCE(urikakezandaka.datanum0029,0) - COALESCE(urikakezandaka.datanum0030,0) - COALESCE(urikakezandaka.datanum0031,0) , 'FM999,999,999,999') as rem_recievable_commafied,
                    COALESCE(urikakezandaka.datanum0032,0) + COALESCE(urikakezandaka.datanum0035,0) + COALESCE(urikakezandaka.datanum0044,0) as loan_balance,
                    to_char(COALESCE(urikakezandaka.datanum0032,0) + COALESCE(urikakezandaka.datanum0035,0) + COALESCE(urikakezandaka.datanum0044,0) , 'FM999,999,999,999') as loan_balance_commafied,
                    COALESCE(urikakezandaka.datanum0021::bigint,0) + COALESCE(urikakezandaka.datanum0022,0) + (COALESCE(urikakezandaka.datanum0023,0) + COALESCE(urikakezandaka.datanum0024,0) + COALESCE(urikakezandaka.datanum0025,0)) +
                    COALESCE(urikakezandaka.datanum0026,0) + COALESCE(urikakezandaka.datanum0027,0) + COALESCE(urikakezandaka.datanum0028,0) + (COALESCE(urikakezandaka.datanum0029,0) + COALESCE(urikakezandaka.datanum0030,0) + COALESCE(urikakezandaka.datanum0031,0)) + 
                    (COALESCE(urikakezandaka.datanum0021,0) + COALESCE(urikakezandaka.datanum0022,0) + COALESCE(urikakezandaka.datanum0023,0) + COALESCE(urikakezandaka.datanum0024,0) + COALESCE(urikakezandaka.datanum0025,0) + COALESCE(urikakezandaka.datanum0026,0) - COALESCE(urikakezandaka.datanum0027,0) - COALESCE(urikakezandaka.datanum0028,0) - COALESCE(urikakezandaka.datanum0029,0) - COALESCE(urikakezandaka.datanum0030,0) - COALESCE(urikakezandaka.datanum0031,0)) + COALESCE(urikakezandaka.datanum0032,0) + (COALESCE(urikakezandaka.datanum0035,0) + COALESCE(urikakezandaka.datanum0044,0)) as row_total,
                    to_char(COALESCE(urikakezandaka.datanum0021::bigint,0) + COALESCE(urikakezandaka.datanum0022,0) + (COALESCE(urikakezandaka.datanum0023,0) + COALESCE(urikakezandaka.datanum0024,0) + COALESCE(urikakezandaka.datanum0025,0)) +
                    COALESCE(urikakezandaka.datanum0026,0) + COALESCE(urikakezandaka.datanum0027,0) + COALESCE(urikakezandaka.datanum0028,0) + (COALESCE(urikakezandaka.datanum0029,0) + COALESCE(urikakezandaka.datanum0030,0) + COALESCE(urikakezandaka.datanum0031,0)) + 
                    (COALESCE(urikakezandaka.datanum0021,0) + COALESCE(urikakezandaka.datanum0022,0) + COALESCE(urikakezandaka.datanum0023,0) + COALESCE(urikakezandaka.datanum0024,0) + COALESCE(urikakezandaka.datanum0025,0) + COALESCE(urikakezandaka.datanum0026,0) - COALESCE(urikakezandaka.datanum0027,0) - COALESCE(urikakezandaka.datanum0028,0) - COALESCE(urikakezandaka.datanum0029,0) - COALESCE(urikakezandaka.datanum0030,0) - COALESCE(urikakezandaka.datanum0031,0)) + COALESCE(urikakezandaka.datanum0032,0) + (COALESCE(urikakezandaka.datanum0035,0) + COALESCE(urikakezandaka.datanum0044,0)) , 'FM999,999,999,999') as row_total_commafied,
                    --COALESCE(kokyaku1.denpyostart,0 ) -  COALESCE(urikakezandaka.datanum0032,0) - COALESCE(urikakezandaka.datanum0035,0) - COALESCE(urikakezandaka.datanum0044,0) as cred_balance,
                    null::bigint as cred_balance,
                    --to_char((COALESCE(kokyaku1.denpyostart,0 ) -  COALESCE(urikakezandaka.datanum0032,0) - COALESCE(urikakezandaka.datanum0035,0) - COALESCE(urikakezandaka.datanum0044,0)), 'FM999,999,999,999') as cred_balance_commafied,
                    null as cred_balance_commafied,
                    --NULL::text as cred_class,
                    CASE
                        WHEN COALESCE(kokyaku1.denpyostart,0) = 0 THEN 'ＥＲＲ'
                        ELSE (((COALESCE(urikakezandaka.datanum0032,0) - COALESCE(urikakezandaka.datanum0035,0) - COALESCE(urikakezandaka.datanum0044,0))::decimal / COALESCE(kokyaku1.denpyostart,0)) * 100)::text END as cred_class,
                    1 as is_company,
                    COALESCE(urikakezandaka.datanum0021,0) as balance_at_the_end_of_month_before,
                    to_char(COALESCE(urikakezandaka.datanum0021,0) , 'FM999,999,999,999') as balance_at_the_end_of_month_before_commafied,
                    COALESCE(urikakezandaka.datanum0022,0) as net_sales_curr_month,
                    to_char(COALESCE(urikakezandaka.datanum0022,0) , 'FM999,999,999,999') as net_sales_curr_month_commafied,
                    COALESCE(urikakezandaka.datanum0023,0) as return_curr_month,
                    to_char(COALESCE(urikakezandaka.datanum0023,0) , 'FM999,999,999,999') as return_curr_month_commafied,
                    COALESCE(urikakezandaka.datanum0024,0) as discount_curr_month,
                    to_char(COALESCE(urikakezandaka.datanum0024,0) , 'FM999,999,999,999') as discount_curr_month_commafied,
                    COALESCE(urikakezandaka.datanum0025,0) as sales_curr_month_others,
                    to_char(COALESCE(urikakezandaka.datanum0025,0) , 'FM999,999,999,999') as sales_curr_month_others_commafied,
                    COALESCE(urikakezandaka.datanum0026,0) as tax_curr_month,
                    to_char(COALESCE(urikakezandaka.datanum0026,0) , 'FM999,999,999,999') as tax_curr_month_commafied,
                    COALESCE(urikakezandaka.datanum0027,0) as cash_deposit_curr_month,
                    to_char(COALESCE(urikakezandaka.datanum0027,0) , 'FM999,999,999,999') as cash_deposit_curr_month_commafied,
                    COALESCE(urikakezandaka.datanum0028,0) as bill_receipt_curr_month,
                    to_char(COALESCE(urikakezandaka.datanum0028,0) , 'FM999,999,999,999') as bill_receipt_curr_month_commafied,
                    COALESCE(urikakezandaka.datanum0029,0) as offset_amount_curr_month,
                    to_char(COALESCE(urikakezandaka.datanum0029,0) , 'FM999,999,999,999') as offset_amount_curr_month_commafied,
                    COALESCE(urikakezandaka.datanum0030,0) as curr_deposit_discount,
                    to_char(COALESCE(urikakezandaka.datanum0030,0) , 'FM999,999,999,999') as curr_deposit_discount_commafied,
                    COALESCE(urikakezandaka.datanum0031,0) as reposited_that_month,
                    to_char(COALESCE(urikakezandaka.datanum0031,0) , 'FM999,999,999,999') as reposited_that_month_commafied,
                    COALESCE(urikakezandaka.datanum0032,0) as balance_at_the_end_of_month,
                    to_char(COALESCE(urikakezandaka.datanum0032,0) , 'FM999,999,999,999') as balance_at_the_end_of_month_commafied,
                    COALESCE(urikakezandaka.datanum0033,0) as balance_of_bill_before,
                    to_char(COALESCE(urikakezandaka.datanum0033,0) , 'FM999,999,999,999') as balance_of_bill_before_commafied,
                    COALESCE(urikakezandaka.datanum0034,0) as bill_settlement_amount,
                    to_char(COALESCE(urikakezandaka.datanum0034,0) , 'FM999,999,999,999') as bill_settlement_amount_commafied,
                    COALESCE(urikakezandaka.datanum0035,0) as balance_of_bill,
                    to_char(COALESCE(urikakezandaka.datanum0035,0) , 'FM999,999,999,999') as balance_of_bill_commafied,
                    COALESCE(urikakezandaka.datanum0036,0) as balance_of_advance_before,
                    to_char(COALESCE(urikakezandaka.datanum0036,0) , 'FM999,999,999,999') as balance_of_advance_before_commafied,
                    COALESCE(urikakezandaka.datanum0037,0) as invoice_amount_before,
                    to_char(COALESCE(urikakezandaka.datanum0037,0) , 'FM999,999,999,999') as invoice_amount_before_commafied,
                    COALESCE(urikakezandaka.datanum0038,0) as consumption_tax_before,
                    to_char(COALESCE(urikakezandaka.datanum0038,0) , 'FM999,999,999,999') as consumption_tax_before_commafied,
                    COALESCE(urikakezandaka.datanum0039,0) as cash_deposit_before,
                    to_char(COALESCE(urikakezandaka.datanum0039,0) , 'FM999,999,999,999') as cash_deposit_before_commafied,
                    COALESCE(urikakezandaka.datanum0040,0) as receipt_amount_before_current,
                    to_char(COALESCE(urikakezandaka.datanum0040,0) , 'FM999,999,999,999') as receipt_amount_before_current_commafied,
                    COALESCE(urikakezandaka.datanum0041,0) as offset_amount_before,
                    to_char(COALESCE(urikakezandaka.datanum0041,0) , 'FM999,999,999,999') as offset_amount_before_commafied,
                    COALESCE(urikakezandaka.datanum0042,0) as deposit_discount_before,
                    to_char(COALESCE(urikakezandaka.datanum0042,0) , 'FM999,999,999,999') as deposit_discount_before_commafied,
                    COALESCE(urikakezandaka.datanum0043,0) as receipt_amount_before,
                    to_char(COALESCE(urikakezandaka.datanum0043,0) , 'FM999,999,999,999') as receipt_amount_before_commafied,
                    COALESCE(urikakezandaka.datanum0044,0) as balance_of_receipt_before,
                    to_char(COALESCE(urikakezandaka.datanum0044,0) , 'FM999,999,999,999') as balance_of_receipt_before_commafied
            from urikakezandaka
            join account_list_v_torihikisaki as v_torihikisaki_1
            on cast (urikakezandaka.datatxt0138 as text) = substring(CAST(v_torihikisaki_1.torihikisaki_cd as text),1,8)

            LEFT JOIN kokyaku1 on kokyaku1.yobi12 = substr(urikakezandaka.datatxt0138, 1, 6)

            $where_string

            ");
//            dd(QueryHelper::fetchResult('select * from A_L_Temp1'));

            QueryHelper::runQuery("CREATE TEMPORARY TABLE A_L_Temp2_Sum as
            select  distinct substr(urikakezandaka.datatxt0138, 1, 6) as sales_billing_cd,
                    urikakezandaka.date0008 as db_date,
                    COALESCE( sum(urikakezandaka.datanum0021),0 ) as prev_receivable,
                    COALESCE( sum(urikakezandaka.datanum0022),0 ) as sales,
                    COALESCE( sum(urikakezandaka.datanum0023),0 ) + COALESCE( sum(urikakezandaka.datanum0024),0 ) + COALESCE( sum(urikakezandaka.datanum0025),0 ) as discount,
                    COALESCE( sum(urikakezandaka.datanum0026),0 ) as consumption_tax,
                    COALESCE( sum(urikakezandaka.datanum0027),0 ) as cash,
                    COALESCE( sum(urikakezandaka.datanum0028),0 ) as bills,
                    COALESCE( sum(urikakezandaka.datanum0029),0 ) + COALESCE(sum(urikakezandaka.datanum0030),0 ) + COALESCE( sum(urikakezandaka.datanum0031),0 ) as other_deposit,
                    COALESCE( sum(urikakezandaka.datanum0021),0 ) + COALESCE(sum(urikakezandaka.datanum0022),0 ) + COALESCE( sum(urikakezandaka.datanum0023),0 ) + COALESCE( sum(urikakezandaka.datanum0024),0 ) + COALESCE(sum(urikakezandaka.datanum0025),0 ) + COALESCE( sum(urikakezandaka.datanum0026),0 ) - COALESCE( sum(urikakezandaka.datanum0027),0 ) - COALESCE(sum(urikakezandaka.datanum0028),0 ) - COALESCE( sum(urikakezandaka.datanum0029),0 ) - COALESCE(sum(urikakezandaka.datanum0030),0 ) - COALESCE( sum(urikakezandaka.datanum0031),0 ) as rem_recievable,
                    COALESCE( sum(urikakezandaka.datanum0032),0 ) + COALESCE(sum(urikakezandaka.datanum0035),0 ) + COALESCE( sum(urikakezandaka.datanum0044),0 ) as loan_balance,
                    COALESCE(kokyaku1.denpyostart,0 ) - COALESCE( sum(urikakezandaka.datanum0032),0 ) - COALESCE( sum(urikakezandaka.datanum0035),0 ) - COALESCE( sum(urikakezandaka.datanum0044),0 ) as cred_balance,
                    CASE
                        WHEN COALESCE(kokyaku1.denpyostart,0) = 0 THEN 'ＥＲＲ'
                        ELSE (((COALESCE( sum(urikakezandaka.datanum0032),0 ) - COALESCE( sum(urikakezandaka.datanum0035),0 ) - COALESCE( sum(urikakezandaka.datanum0044),0 ))::decimal / COALESCE(kokyaku1.denpyostart,0)) * 100)::text END as cred_class,
                    COALESCE( sum(urikakezandaka.datanum0021),0 ) as balance_at_the_end_of_month_before,
                    COALESCE( sum(urikakezandaka.datanum0022),0 ) as net_sales_curr_month,
                    COALESCE( sum(urikakezandaka.datanum0023),0 ) as return_curr_month,
                    COALESCE( sum(urikakezandaka.datanum0024),0 ) as discount_curr_month,
                    COALESCE( sum(urikakezandaka.datanum0025),0 ) as sales_curr_month_others,
                    COALESCE( sum(urikakezandaka.datanum0026),0 ) as tax_curr_month,
                    COALESCE( sum(urikakezandaka.datanum0027),0 ) as cash_deposit_curr_month,
                    COALESCE( sum(urikakezandaka.datanum0028),0 ) as bill_receipt_curr_month,
                    COALESCE( sum(urikakezandaka.datanum0029),0 ) as offset_amount_curr_month,
                    COALESCE( sum(urikakezandaka.datanum0030),0 ) as curr_deposit_discount,
                    COALESCE( sum(urikakezandaka.datanum0031),0 ) as reposited_that_month,
                    COALESCE( sum(urikakezandaka.datanum0032),0 ) as balance_at_the_end_of_month,
                    COALESCE( sum(urikakezandaka.datanum0033),0 ) as balance_of_bill_before,
                    COALESCE( sum(urikakezandaka.datanum0034),0 ) as bill_settlement_amount,
                    COALESCE( sum(urikakezandaka.datanum0035),0 ) as balance_of_bill,
                    COALESCE( sum(urikakezandaka.datanum0036),0 ) as balance_of_advance_before,
                    COALESCE( sum(urikakezandaka.datanum0037),0 ) as invoice_amount_before,
                    COALESCE( sum(urikakezandaka.datanum0038),0 ) as consumption_tax_before,
                    COALESCE( sum(urikakezandaka.datanum0039),0 ) as cash_deposit_before,
                    COALESCE( sum(urikakezandaka.datanum0040),0 ) as receipt_amount_before_current,
                    COALESCE( sum(urikakezandaka.datanum0041),0 ) as offset_amount_before,
                    COALESCE( sum(urikakezandaka.datanum0042),0 ) as deposit_discount_before,
                    COALESCE( sum(urikakezandaka.datanum0043),0 ) as receipt_amount_before,
                    COALESCE( sum(urikakezandaka.datanum0044),0 ) as balance_of_receipt_before,
                    COALESCE( sum(urikakezandaka.datanum0021::bigint),0 ) + COALESCE( sum(urikakezandaka.datanum0022),0 ) + (COALESCE( sum(urikakezandaka.datanum0023),0 ) + COALESCE( sum(urikakezandaka.datanum0024),0 ) + COALESCE( sum(urikakezandaka.datanum0025),0 )) +
                    COALESCE( sum(urikakezandaka.datanum0026),0 ) + COALESCE( sum(urikakezandaka.datanum0027),0 ) + COALESCE( sum(urikakezandaka.datanum0028),0 ) + (COALESCE( sum(urikakezandaka.datanum0029),0 ) + COALESCE( sum(urikakezandaka.datanum0030),0 ) + COALESCE( sum(urikakezandaka.datanum0031),0 )) + 
                    (COALESCE( sum(urikakezandaka.datanum0021),0 ) + COALESCE( sum(urikakezandaka.datanum0022),0 ) + COALESCE( sum(urikakezandaka.datanum0023),0 ) + COALESCE( sum(urikakezandaka.datanum0024),0 ) + COALESCE( sum(urikakezandaka.datanum0025),0 ) + COALESCE( sum(urikakezandaka.datanum0026),0 ) - COALESCE( sum(urikakezandaka.datanum0027),0 ) - COALESCE( sum(urikakezandaka.datanum0028),0 ) - COALESCE( sum(urikakezandaka.datanum0029),0 ) - COALESCE( sum(urikakezandaka.datanum0030),0 ) - COALESCE( sum(urikakezandaka.datanum0031),0 )) + COALESCE( sum(urikakezandaka.datanum0032),0 ) + (COALESCE( sum(urikakezandaka.datanum0035),0 ) + COALESCE( sum(urikakezandaka.datanum0044),0 )) as row_total
            FROM urikakezandaka
            LEFT JOIN kokyaku1 on kokyaku1.yobi12 = substr(urikakezandaka.datatxt0138, 1, 6)
            $where_string
            GROUP BY substr(urikakezandaka.datatxt0138, 1, 6),urikakezandaka.date0008,kokyaku1.denpyostart
            ");

//            dd(QueryHelper::fetchResult('select * from A_L_Temp2_Sum'));
            QueryHelper::runQuery("CREATE TEMPORARY TABLE A_L_Temp2 as
            select  distinct A_L_Temp2_Sum.sales_billing_cd,
                    A_L_Temp2_Sum.db_date,
                    kokyaku1.address || '/計' as sales_billing_name,
                    --kokyaku1.address || '／計' as sales_billing_name_xls,
                    A_L_Temp2_Sum.prev_receivable,
                    to_char(A_L_Temp2_Sum.prev_receivable , 'FM999,999,999,999') as prev_receivable_commafied,
                    A_L_Temp2_Sum.sales,
                    to_char(A_L_Temp2_Sum.sales , 'FM999,999,999,999') as sales_commafied,
                    A_L_Temp2_Sum.discount,
                    to_char(A_L_Temp2_Sum.discount, 'FM999,999,999,999') as discount_commafied,
                    A_L_Temp2_Sum.consumption_tax,
                    to_char(A_L_Temp2_Sum.consumption_tax , 'FM999,999,999,999') as consumption_tax_commafied,
                    A_L_Temp2_Sum.cash,
                    to_char(A_L_Temp2_Sum.cash , 'FM999,999,999,999') as cash_commafied,
                    A_L_Temp2_Sum.bills,
                    to_char(A_L_Temp2_Sum.bills , 'FM999,999,999,999') as bills_commafied,
                    A_L_Temp2_Sum.other_deposit,
                    to_char(A_L_Temp2_Sum.other_deposit , 'FM999,999,999,999') as other_deposit_commafied,
                    A_L_Temp2_Sum.rem_recievable,
                    to_char(A_L_Temp2_Sum.rem_recievable , 'FM999,999,999,999') as rem_recievable_commafied,
                    A_L_Temp2_Sum.loan_balance,
                    to_char(A_L_Temp2_Sum.loan_balance, 'FM999,999,999,999') as loan_balance_commafied,
                    A_L_Temp2_Sum.cred_balance,
                    to_char(A_L_Temp2_Sum.cred_balance , 'FM999,999,999,999') as cred_balance_commafied,
                    A_L_Temp2_Sum.cred_class,
                    0 as is_company,
                    A_L_Temp2_Sum.row_total,
                    to_char(A_L_Temp2_Sum.row_total, 'FM999,999,999,999') as row_total_commafied,
                    A_L_Temp2_Sum.balance_at_the_end_of_month_before,
                    to_char(A_L_Temp2_Sum.balance_at_the_end_of_month_before , 'FM999,999,999,999') as balance_at_the_end_of_month_before_commafied,
                    A_L_Temp2_Sum.net_sales_curr_month,
                    to_char(A_L_Temp2_Sum.net_sales_curr_month , 'FM999,999,999,999') as net_sales_curr_month_commafied,
                    A_L_Temp2_Sum.return_curr_month,
                    to_char(A_L_Temp2_Sum.return_curr_month , 'FM999,999,999,999') as return_curr_month_commafied,
                    A_L_Temp2_Sum.discount_curr_month,
                    to_char(A_L_Temp2_Sum.discount_curr_month , 'FM999,999,999,999') as discount_curr_month_commafied,
                    A_L_Temp2_Sum.sales_curr_month_others,
                    to_char(A_L_Temp2_Sum.sales_curr_month_others , 'FM999,999,999,999') as sales_curr_month_others_commafied,
                    A_L_Temp2_Sum.tax_curr_month,
                    to_char(A_L_Temp2_Sum.tax_curr_month , 'FM999,999,999,999') as tax_curr_month_commafied,
                    A_L_Temp2_Sum.cash_deposit_curr_month,
                    to_char(A_L_Temp2_Sum.cash_deposit_curr_month , 'FM999,999,999,999') as cash_deposit_curr_month_commafied,
                    A_L_Temp2_Sum.bill_receipt_curr_month,
                    to_char(A_L_Temp2_Sum.bill_receipt_curr_month , 'FM999,999,999,999') as bill_receipt_curr_month_commafied,
                    A_L_Temp2_Sum.offset_amount_curr_month,
                    to_char(A_L_Temp2_Sum.offset_amount_curr_month , 'FM999,999,999,999') as offset_amount_curr_month_commafied,
                    A_L_Temp2_Sum.curr_deposit_discount,
                    to_char(A_L_Temp2_Sum.curr_deposit_discount , 'FM999,999,999,999') as curr_deposit_discount_commafied,
                    A_L_Temp2_Sum.reposited_that_month,
                    to_char(A_L_Temp2_Sum.reposited_that_month , 'FM999,999,999,999') as reposited_that_month_commafied,
                    A_L_Temp2_Sum.balance_at_the_end_of_month,
                    to_char(A_L_Temp2_Sum.balance_at_the_end_of_month , 'FM999,999,999,999') as balance_at_the_end_of_month_commafied,
                    A_L_Temp2_Sum.balance_of_bill_before,
                    to_char(A_L_Temp2_Sum.balance_of_bill_before, 'FM999,999,999,999') as balance_of_bill_before_commafied,
                    A_L_Temp2_Sum.bill_settlement_amount,
                    to_char(A_L_Temp2_Sum.bill_settlement_amount, 'FM999,999,999,999') as bill_settlement_amount_commafied,
                    A_L_Temp2_Sum.balance_of_bill,
                    to_char(A_L_Temp2_Sum.balance_of_bill, 'FM999,999,999,999') as balance_of_bill_commafied,
                    A_L_Temp2_Sum.balance_of_advance_before,
                    to_char(A_L_Temp2_Sum.balance_of_advance_before, 'FM999,999,999,999') as balance_of_advance_before_commafied,
                    A_L_Temp2_Sum.invoice_amount_before,
                    to_char(A_L_Temp2_Sum.invoice_amount_before, 'FM999,999,999,999') as invoice_amount_before_commafied,
                    A_L_Temp2_Sum.consumption_tax_before,
                    to_char(A_L_Temp2_Sum.consumption_tax_before, 'FM999,999,999,999') as consumption_tax_before_commafied,
                    A_L_Temp2_Sum.cash_deposit_before,
                    to_char(A_L_Temp2_Sum.cash_deposit_before, 'FM999,999,999,999') as cash_deposit_before_commafied,
                    A_L_Temp2_Sum.receipt_amount_before_current,
                    to_char(A_L_Temp2_Sum.receipt_amount_before_current, 'FM999,999,999,999') as receipt_amount_before_current_commafied,
                    A_L_Temp2_Sum.offset_amount_before,
                    to_char(A_L_Temp2_Sum.offset_amount_before, 'FM999,999,999,999') as offset_amount_before_commafied,
                    A_L_Temp2_Sum.deposit_discount_before,
                    to_char(A_L_Temp2_Sum.deposit_discount_before, 'FM999,999,999,999') as deposit_discount_before_commafied,
                    A_L_Temp2_Sum.receipt_amount_before,
                    to_char(A_L_Temp2_Sum.receipt_amount_before, 'FM999,999,999,999') as receipt_amount_before_commafied,
                    A_L_Temp2_Sum.balance_of_receipt_before,
                    to_char(A_L_Temp2_Sum.balance_of_receipt_before, 'FM999,999,999,999') as balance_of_receipt_before_commafied
            FROM A_L_Temp2_Sum

            JOIN kokyaku1 on kokyaku1.yobi12 = A_L_Temp2_Sum.sales_billing_cd

            ");

            
            QueryHelper::runQuery("CREATE TEMPORARY TABLE all_accounts_temp_total as
            select
            null::text as sales_billing_cd,
            null::text as db_date,
            '【合計】'::text as sales_billing_name,
            COALESCE( sum(urikakezandaka.datanum0021),0 ) as prev_receivable,
            to_char(COALESCE( sum(urikakezandaka.datanum0021),0 ), 'FM999,999,999,999') as prev_receivable_commafied,
            COALESCE( sum(urikakezandaka.datanum0022),0 ) as sales,
            to_char(COALESCE( sum(urikakezandaka.datanum0022),0 ), 'FM999,999,999,999') as sales_commafied,
            COALESCE( sum(urikakezandaka.datanum0023),0 ) + COALESCE( sum(urikakezandaka.datanum0024),0 ) + COALESCE( sum(urikakezandaka.datanum0025),0 ) as discount,
            to_char(COALESCE( sum(urikakezandaka.datanum0023),0 ) + COALESCE( sum(urikakezandaka.datanum0024),0 ) + COALESCE( sum(urikakezandaka.datanum0025),0 ), 'FM999,999,999,999') as discount_commafied,
            COALESCE( sum(urikakezandaka.datanum0026),0 ) as consumption_tax,
            to_char(COALESCE( sum(urikakezandaka.datanum0026),0 ), 'FM999,999,999,999') as consumption_tax_commafied,
            COALESCE( sum(urikakezandaka.datanum0027),0 ) as cash,
            to_char(COALESCE( sum(urikakezandaka.datanum0027),0 ), 'FM999,999,999,999') as cash_commafied,
            COALESCE( sum(urikakezandaka.datanum0028),0 ) as bills,
            to_char(COALESCE( sum(urikakezandaka.datanum0028),0 ), 'FM999,999,999,999') as bills_commafied,
            COALESCE( sum(urikakezandaka.datanum0029),0 ) + COALESCE(sum(urikakezandaka.datanum0030),0 ) + COALESCE( sum(urikakezandaka.datanum0031),0 ) as other_deposit,
            to_char(COALESCE( sum(urikakezandaka.datanum0029),0 ) + COALESCE(sum(urikakezandaka.datanum0030),0 ) + COALESCE( sum(urikakezandaka.datanum0031),0 ), 'FM999,999,999,999') as other_deposit_commafied,
            COALESCE( sum(urikakezandaka.datanum0021),0 ) + COALESCE(sum(urikakezandaka.datanum0022),0 ) + COALESCE( sum(urikakezandaka.datanum0023),0 ) + COALESCE( sum(urikakezandaka.datanum0024),0 ) + COALESCE(sum(urikakezandaka.datanum0025),0 ) + COALESCE( sum(urikakezandaka.datanum0026),0 ) - COALESCE( sum(urikakezandaka.datanum0027),0 ) - COALESCE(sum(urikakezandaka.datanum0028),0 ) - COALESCE( sum(urikakezandaka.datanum0029),0 ) - COALESCE(sum(urikakezandaka.datanum0030),0 ) - COALESCE( sum(urikakezandaka.datanum0031),0 ) as rem_recievable,
            to_char(COALESCE( sum(urikakezandaka.datanum0021),0 ) + COALESCE(sum(urikakezandaka.datanum0022),0 ) + COALESCE( sum(urikakezandaka.datanum0023),0 ) + COALESCE( sum(urikakezandaka.datanum0024),0 ) + COALESCE(sum(urikakezandaka.datanum0025),0 ) + COALESCE( sum(urikakezandaka.datanum0026),0 ) - COALESCE( sum(urikakezandaka.datanum0027),0 ) - COALESCE(sum(urikakezandaka.datanum0028),0 ) - COALESCE( sum(urikakezandaka.datanum0029),0 ) - COALESCE(sum(urikakezandaka.datanum0030),0 ) - COALESCE( sum(urikakezandaka.datanum0031),0 ), 'FM999,999,999,999') as rem_recievable_commafied,
            COALESCE( sum(urikakezandaka.datanum0032),0 ) + COALESCE(sum(urikakezandaka.datanum0035),0 ) + COALESCE( sum(urikakezandaka.datanum0044),0 ) as loan_balance,
            to_char(COALESCE( sum(urikakezandaka.datanum0032),0 ) + COALESCE(sum(urikakezandaka.datanum0035),0 ) + COALESCE( sum(urikakezandaka.datanum0044),0 ), 'FM999,999,999,999') as loan_balance_commafied,
            null::bigint as cred_balance,
            null as cred_balance_commafied,
            null::text as cred_class,
            null::int as is_company,
            null::int as row_total,
            null::text as row_total_commafied,
            null::int as balance_at_the_end_of_month_before,
            null::text as balance_at_the_end_of_month_before_commafied,
            null::int as net_sales_curr_month,
            null::text as net_sales_curr_month_commafied,
            null::int as return_curr_month,
            null::text as return_curr_month_commafied,
            null::int as discount_curr_month,
            null::text as discount_curr_month_commafied,
            null::int as sales_curr_month_others,
            null::text as sales_curr_month_others_commafied,
            null::int as tax_curr_month,
            null::text as tax_curr_month_commafied,
            null::int as cash_deposit_curr_month,
            null::text as cash_deposit_curr_month_commafied,
            null::int as bill_receipt_curr_month,
            null::text as bill_receipt_curr_month_commafied,
            null::int as offset_amount_curr_month,
            null::text as offset_amount_curr_month_commafied,
            null::int as curr_deposit_discount,
            null::text as curr_deposit_discount_commafied,
            null::int as reposited_that_month,
            null::text as reposited_that_month_commafied,
            null::int as balance_at_the_end_of_month,
            null::text as balance_at_the_end_of_month_commafied,
            null::int as balance_of_bill_before,
            null::text as balance_of_bill_before_commafied,
            null::int as bill_settlement_amount,
            null::text as bill_settlement_amount_commafied,
            null::int as balance_of_bill,
            null::text as balance_of_bill_commafied,
            null::int as balance_of_advance_before,
            null as balance_of_advance_before_commafied,
            null::int as invoice_amount_before,
            null as invoice_amount_before_commafied,
            null::int as consumption_tax_before,
            null as consumption_tax_before_commafied,
            null::int as cash_deposit_before,
            null as cash_deposit_before_commafied,
            null::int as receipt_amount_before_current,
            null as receipt_amount_before_current_commafied,
            null::int as offset_amount_before,
            null as offset_amount_before_commafied,
            null::int as deposit_discount_before,
            null as deposit_discount_before_commafied,
            null::int as receipt_amount_before,
            null as receipt_amount_before_commafied,
            null::int as balance_of_receipt_before,
            null as balance_of_receipt_before_commafied,
            null as cred_class_final
            FROM urikakezandaka
            LEFT JOIN kokyaku1 on kokyaku1.yobi12 = substr(urikakezandaka.datatxt0138, 1, 6)
            $where_string
            ");

//            dd(QueryHelper::fetchResult('select * from A_L_Temp2'),QueryHelper::fetchResult('select * from A_L_Temp1'));

            $merge_key = "db_date , sales_billing_name , prev_receivable , prev_receivable_commafied , sales , sales_commafied , discount , discount_commafied , consumption_tax , consumption_tax_commafied , cash , cash_commafied , bills , bills_commafied , other_deposit , other_deposit_commafied , rem_recievable , rem_recievable_commafied , loan_balance , loan_balance_commafied , cred_balance , cred_balance_commafied, cred_class , is_company, row_total, row_total_commafied, balance_at_the_end_of_month_before, balance_at_the_end_of_month_before_commafied, net_sales_curr_month, net_sales_curr_month_commafied, return_curr_month, return_curr_month_commafied, discount_curr_month, discount_curr_month_commafied, sales_curr_month_others, sales_curr_month_others_commafied, tax_curr_month, tax_curr_month_commafied, cash_deposit_curr_month, cash_deposit_curr_month_commafied, offset_amount_curr_month, offset_amount_curr_month_commafied, curr_deposit_discount, curr_deposit_discount_commafied, reposited_that_month, reposited_that_month_commafied, 
            balance_at_the_end_of_month, balance_at_the_end_of_month_commafied, bill_receipt_curr_month, bill_receipt_curr_month_commafied, balance_of_bill_before, balance_of_bill_before_commafied, bill_settlement_amount, bill_settlement_amount_commafied,
            balance_of_bill, balance_of_bill_commafied, balance_of_advance_before, balance_of_advance_before_commafied, invoice_amount_before, invoice_amount_before_commafied, consumption_tax_before, consumption_tax_before_commafied, cash_deposit_before, cash_deposit_before_commafied, receipt_amount_before_current, receipt_amount_before_current_commafied, offset_amount_before, offset_amount_before_commafied, deposit_discount_before, deposit_discount_before_commafied, receipt_amount_before, receipt_amount_before_commafied, balance_of_receipt_before, balance_of_receipt_before_commafied";

            QueryHelper::runQuery("CREATE TEMPORARY TABLE all_accounts_temp as
            select distinct on (sales_billing_cd) sales_billing_cd,
            $merge_key,
            --CASE
            --    WHEN A_L_Temp1.cred_class = 'ＥＲＲ' THEN 'ＥＲＲ'
            --    WHEN A_L_Temp1.cred_class::decimal < 70 THEN NULL
            --    WHEN A_L_Temp1.cred_class::decimal >= 70 AND A_L_Temp1.cred_class::decimal <= 89 THEN '７０％超'
            --    WHEN A_L_Temp1.cred_class::decimal >= 90 AND A_L_Temp1.cred_class::decimal <= 99 THEN '９０％超'
            --    WHEN A_L_Temp1.cred_class::decimal >= 100 AND A_L_Temp1.cred_class::decimal <= 149 THEN '１００％超'
            --    ELSE '１５０％超' END as cred_class_final
            null as cred_class_final
            from A_L_Temp1
            $where_string_zero
            union
            select distinct on (sales_billing_cd) sales_billing_cd,
            $merge_key,
            CASE
                WHEN A_L_Temp2.cred_class = 'ＥＲＲ' THEN 'ＥＲＲ'
                WHEN A_L_Temp2.cred_class::decimal < 70 THEN NULL
                WHEN A_L_Temp2.cred_class::decimal >= 70 AND A_L_Temp2.cred_class::decimal <= 89 THEN '７０％超'
                WHEN A_L_Temp2.cred_class::decimal >= 90 AND A_L_Temp2.cred_class::decimal <= 99 THEN '９０％超'
                WHEN A_L_Temp2.cred_class::decimal >= 100 AND A_L_Temp2.cred_class::decimal <= 149 THEN '１００％超'
                ELSE '１５０％超' END as cred_class_final
            from A_L_Temp2
            $where_string_zero
            order by sales_billing_cd
            ");

//            dd(QueryHelper::fetchResult('select * from all_accounts_temp'));

            $sql = "SELECT * FROM all_accounts_temp";
            $sql2 = "SELECT * FROM all_accounts_temp_total";
            $acc_list_arr = array();
            array_push($acc_list_arr,$sql,$sql2);

            return $acc_list_arr;

        } catch (\Exception $e) {
            dd($e);
            return $e;
        }
    }
}
