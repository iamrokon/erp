<?php

namespace App\AllClass\sales\BillingLedger;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AllBillingLedgerPayment
{
    public static function data($request = [])
    {
        //dd($request['ledger_year_start']);
        $ledger_year_start =  str_replace('/', '', $request['ledger_year_start']);
        $ledger_year_end =  str_replace('/', '', $request['ledger_year_end']);
        $billing_address = $request['billing_address'];

        $fetchSeikyuzandakaResult=QueryHelper::fetchResult("select
                                            seikyuzandaka.date0009,
                                            seikyuzandaka.datanum0064::int
                                            from seikyuzandaka
                                            where datatxt0142::text LIKE '%$billing_address%'
                                            and to_char(seikyuzandaka.date0009,'YYYYMM') < '$ledger_year_start'
                                            order by seikyuzandaka.date0009 desc limit 1");
//        dd(count($fetchSeikyuzandakaResult));

        if (count($fetchSeikyuzandakaResult)>0){
            $ledger_year_start=date('Ymd', strtotime('+1 day', strtotime($fetchSeikyuzandakaResult[0]->date0009)));
            $datanum0064_val=$fetchSeikyuzandakaResult[0]->datanum0064;
        }
        else{
            $ledger_year_start = $ledger_year_start . '01';
            $datanum0064_val=0;
        }

        $systemDate= date('Ymd');

        if ($ledger_year_end > substr($systemDate,0,6) || $ledger_year_end==substr($systemDate,0,6)){
            $ledger_year_end=$systemDate;
        }
        else{
            $ledger_year_end = Carbon::createFromDate(substr($ledger_year_end, 0, 4), substr($ledger_year_end, 4, 6), 01)->endOfMonth()->format('Ymd');
        }

        $search_sql = " where  to_char(daikinseisan.torikomidate,'YYYYMMDD') between '$ledger_year_start' and '$ledger_year_end'
        and daikinseisan.dataint01 = 0 and daikinseisan.chumonsyaname like '$billing_address%' and daikinseisan.soufusakiname <>'A907'";

        QueryHelper::runQuery("DROP TABLE IF EXISTS all_billing_ledger_payment_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_billing_ledger_payment_temp  as
        select distinct
        to_char(daikinseisan.torikomidate,'YYYYMMDD') as dates,
        to_char(daikinseisan.torikomidate,'YYYY/MM/DD') as dates_xls,
        '入金' as classification,
        daikinseisan.shinkurokokyakubango as shinkurokokyakubango,
        daikinseisan.shinkurokokyakuname as  slip_number,
        daikinseisan.shinkurokokyakugroup as lines,
        concat (categorykanri.category2,' ',categorykanri.category4) as product_name,
        '' as numbers,
        CASE
            WHEN to_char(daikinseisan.chumondate,'YYYYMMDD')=null THEN  null
            ELSE to_char(daikinseisan.chumondate,'YYYY/MM/DD')
            END AS unit_price,
        CASE
            WHEN to_char(daikinseisan.chumondate,'YYYYMMDD')=null THEN  null
            ELSE to_char(daikinseisan.chumondate,'YYYY/MM/DD')
            END AS unit_price_xls,
        '' as sales_amount,
        '' as sales_amount_xls,
        '' as consumption_tax,
        '' as consumption_tax_xls,
        '' as consumption_temp,
        cast (to_char(daikinseisan.nyukingaku,'FM99,999,999,999,999') as text)  as deposit_amount,
        daikinseisan.nyukingaku::text  as deposit_amount_xls,
        '' as balance,
        ''::text as balance_xls,
        '' as order_slip_number,
        '' as voucher_remarks,
        '' as customer_note_number,
        '' as order_line,
        daikinseisan.toiawasebango as  remarks,
        '' as contractor,
        '' as end_customer,
        '' as classification1,
        '' as user_name,
        'c' as serial_data
        from (select distinct
                       shinkurokokyakuname,
                       shinkurokokyakugroup,
                       max(shinkurokokyakuorderbango) as maxval
                       from daikinseisan
                       where daikinseisan.dataint01 = 0
                       group by shinkurokokyakuname,shinkurokokyakugroup) as daikinseisan_m
        join daikinseisan
        on daikinseisan.shinkurokokyakuname=daikinseisan_m.shinkurokokyakuname
        and daikinseisan.shinkurokokyakugroup=daikinseisan_m.shinkurokokyakugroup
        and daikinseisan.shinkurokokyakuorderbango=daikinseisan_m.maxval
        left join categorykanri  on categorykanri.category1 = 'A9' and concat(categorykanri.category1,categorykanri.category2) = daikinseisan.soufusakiname
        $search_sql
         ");
//        dd(QueryHelper::fetchResult("select * from all_billing_ledger_payment_temp"),$ledger_year_start,$ledger_year_end,$billing_address);
        return  DB::table('all_billing_ledger_payment_temp')->toSql();
    }
}
