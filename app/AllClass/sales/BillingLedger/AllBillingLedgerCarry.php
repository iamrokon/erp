<?php

namespace App\AllClass\sales\BillingLedger;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AllBillingLedgerCarry
{
    public static function data($request = [])
    {
        $ledger_year_start =  str_replace('/', '', $request['ledger_year_start']);
        $ledger_year_end =  str_replace('/', '', $request['ledger_year_end']);
        $billing_address = $request['billing_address'];

        $fetchSeikyuzandakaResult=QueryHelper::fetchResult("select
                                            seikyuzandaka.date0009
                                            from seikyuzandaka
                                            where datatxt0142::text LIKE '%$billing_address%'
                                            and to_char(seikyuzandaka.date0009,'YYYYMM') < '$ledger_year_start'
                                            order by seikyuzandaka.date0009 desc limit 1");
//        dd(count($fetchSeikyuzandakaResult));
        if (count($fetchSeikyuzandakaResult)==1){
            $search_sql = "where datatxt0142::text LIKE '%$billing_address%' and to_char(seikyuzandaka.date0009,'YYYYMM') < '$ledger_year_start'";

            QueryHelper::runQuery("DROP TABLE IF EXISTS all_billing_ledger_carry_temp ");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE all_billing_ledger_carry_temp  as
                select distinct
                to_char( date0009,'YYYYMMDD') as dates,
                to_char( date0009,'YYYY/MM/DD') as dates_xls,
                '' as classification,
                '' as  slip_number,
                '' as lines,
                '前回繰越額' as product_name,
                '' as numbers,
                '' as unit_price,
                '' as sales_amount,
                '' as consumption_tax,
                '' as consumption_temp,
                '' as deposit_amount,
                cast (to_char(cast(datanum0064  AS bigint),'FM99,999,999,999,999') AS text)AS balance,
                '' as unit_price_xls,
                '' as sales_amount_xls,
                '' as consumption_tax_xls,
                '' as deposit_amount_xls,
                datanum0064::text AS balance_xls,
                '' as order_slip_number,
                '' as voucher_remarks,
                '' as customer_note_number,
                '' as order_line,
                '' as remarks,
                '' as  contractor,
                '' as  contractor_db,
                '' as  end_customer,
                '' as  end_customer_db,
                datatxt0142,
                '' as classification1,
                '' as user_name,
                'a' as serial_data
                from
                seikyuzandaka
                $search_sql
                order by dates desc limit 1");
//            dd('hlw',QueryHelper::fetchResult(DB::table('all_billing_ledger_carry_temp')->toSql()));
        }
        else{
            QueryHelper::runQuery("DROP TABLE IF EXISTS all_billing_ledger_carry_temp ");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE all_billing_ledger_carry_temp  as
                select distinct
                '-' as dates,
                '-' as dates_xls,
                '' as classification,
                '' as  slip_number,
                '' as lines,
                '前回繰越額' as product_name,
                '' as numbers,
                '' as unit_price,
                '' as sales_amount,
                '' as consumption_tax,
                '' as consumption_temp,
                '' as deposit_amount,
                '0' as balance,
                '' as unit_price_xls,
                '' as sales_amount_xls,
                '' as consumption_tax_xls,
                '' as deposit_amount_xls,
                '0' AS balance_xls,
                '' as order_slip_number,
                '' as voucher_remarks,
                '' as customer_note_number,
                '' as order_line,
                '' as remarks,
                '' as  contractor,
                '' as  contractor_db,
                '' as  end_customer,
                '' as  end_customer_db,
                datatxt0142,
                '' as classification1,
                '' as user_name,
                'a' as serial_data
                from
                seikyuzandaka
                order by dates desc limit 1");
        }


//        dd(QueryHelper::fetchResult(DB::table('all_billing_ledger_carry_temp')->toSql()),$ledger_year_start);
        return  DB::table('all_billing_ledger_carry_temp')->toSql();
    }
}
