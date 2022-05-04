<?php

namespace App\AllClass\sales\BillingLedger;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AllBillingLedgerSale
{
    public static function data($request = [])
    {
        $ledger_year_start =  str_replace('/', '', $request['ledger_year_start']);
        $ledger_year_end =  str_replace('/', '', $request['ledger_year_end']);

        /*$ledger_year_start = $ledger_year_start . '01';
        $ledger_year_end = Carbon::createFromDate(substr($ledger_year_end, 0, 4), substr($ledger_year_end, 4, 6), 01)->endOfMonth()->format('Ymd');*/
        $billing_address = $request['billing_address'];
        $billing_address_part1 = substr($request['billing_address'],0,6);
        $billing_address_part2 = substr($request['billing_address'],6,2);

        $fetchSeikyuzandakaResult=QueryHelper::fetchResult("select
                                            seikyuzandaka.date0009,
                                            seikyuzandaka.datanum0064::int
                                            from seikyuzandaka
                                            where datatxt0142::text LIKE '%$billing_address%'
                                            and to_char(seikyuzandaka.date0009,'YYYYMM') < '$ledger_year_start'
                                            order by seikyuzandaka.date0009 desc limit 1");
//        dd($fetchSeikyuzandakaResult,count($fetchSeikyuzandakaResult),$fetchSeikyuzandakaResult[0]->datanum0064,$ledger_year_start);
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

        $search_sql = " where orderhenkan.intorder03::text between '$ledger_year_start' and '$ledger_year_end'
            and tuhanorder.information2 like '$billing_address%' and syukkoold.hantei = 0 and syukkoold.yoteimeter = 0  and tuhanorder.text1 not in ('U523', 'U560') and tuhanorder.unsoudaibikitesuryou = 1 and tuhanorder.juchukubun2 IS NOT NULL and orderhenkan.datachar01 IS NOT NULL";

        QueryHelper::runQuery("DROP TABLE IF EXISTS all_billing_ledger_consumption_tax_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_billing_ledger_consumption_tax_temp  as
        select distinct on (tuhanorder.information2)
        case
            when left(others2.other1,1) = '1' then left(haisoujouhou.datatxt0051,1)
            when left(others2.other1,1) = '2' then left(others2.other17,1)
        end as consumption_temp,
        tuhanorder.information2 as tuhan_temp,
        -- haisoujouhou.datatxt0051,
        -- haisoujouhou.syukei1,
        -- others2.otherint1,
        left(others2.other17,1) as other17
        -- others2.other1
        from tuhanorder
        left join kokyaku1 on kokyaku1.yobi12 = substring(tuhanorder.information2,1,6)
        left join haisoujouhou on haisoujouhou.syukei1 =  kokyaku1.bango
        --left join haisou on  haisou.shikibetsucode = kokyaku1.yobi12
        left join haisou on  haisou.shikibetsucode = '$billing_address_part1' and haisou.torihikisakibango = '$billing_address_part2'
        left join others2 on others2.otherint1 = haisou.bango
        WHERE  substring(tuhanorder.information2,1,8) = '$billing_address'");

//        dd(QueryHelper::fetchResult(DB::table('all_billing_ledger_consumption_tax_temp')->toSql()));

        QueryHelper::runQuery("DROP TABLE IF EXISTS v_torihikisaki_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE v_torihikisaki_temp AS
        SELECT DISTINCT ON (v_torihikisaki.torihikisaki_cd)
            v_torihikisaki.torihikisaki_cd,
            v_torihikisaki.R17_4
            FROM v_torihikisaki
            ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS all_billing_ledger_sale_temp_before ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_billing_ledger_sale_temp_before  as
        select distinct
        orderhenkan.intorder03::text as dates,
        cast (concat_ws('/',SUBSTRING (CAST(orderhenkan.intorder03 as text),1,4),SUBSTRING (CAST(orderhenkan.intorder03 AS text),5,2),SUBSTRING (CAST(orderhenkan.intorder03 AS text),7,2)) AS text) AS dates_xls,
        concat (categorykanri.category2,' ',categorykanri.category4) as classification,
        syukkoold.kaiinid as  slip_number,
        syukkoold.syouhinsyu::text as lines,
        syukkoold.syouhinname as product_name,
        syukkoold.syukkasu::text as numbers,
        cast (to_char(syukkoold.dataint04,'FM99,999,999,999,999') as text) as unit_price,
        cast (to_char((syukkoold.syukkasu * syukkoold.dataint04),'FM99,999,999,999,999') as text) as sales_amount,
        CASE v_consumption.consumption_temp
        when '1' then to_char(tuhanorder.numeric4,'FM99,999,999,999,999')
        when '2' then to_char(syukkoold.datachar20::bigint,'FM99,999,999,999,999')
        when '3' then to_char(seikyuzandaka.datanum0064,'FM99,999,999,999,999')
        end as consumption_tax,
        v_consumption.consumption_temp,
        '' as deposit_amount,
        cast (syukkoold.dataint04 as text) as unit_price_xls,
        cast (syukkoold.syukkasu * syukkoold.dataint04 as text) as sales_amount_xls,
        CASE v_consumption.consumption_temp
        when '1' then tuhanorder.numeric4::text
        when '2' then syukkoold.datachar20::text
        when '3' then seikyuzandaka.datanum0064::text
        end as consumption_tax_xls,
        '' as deposit_amount_xls,
        ''::text as balance,
        ''::text as balance_xls,
        syukkoold.syouhinid as order_slip_number,
        syukkoold.syouhinsyu::text as order_line,
        syukkoold.datachar08 as remarks,
        tuhanorder.information1,
        tuhanorder.information2,
        v_consumption.tuhan_temp,
        tuhanorder.information3,
        tuhanorder.information8 as voucher_remarks,
        orderhenkan.datachar04 as customer_note_number,
        categorykanri1.category2 as classification1,
        CONCAT(tantousya.bango, ' ', tantousya.name) as user_name,
        'b' as serial_data
        FROM syukkoold
        left join orderhenkan on orderhenkan.bango =  syukkoold.orderbango
        left join tantousya on tantousya.bango = orderhenkan.datachar05
        left join tuhanorder on tuhanorder.orderbango = orderhenkan.bango
        left join categorykanri  on categorykanri.category1 = 'U5' and concat(categorykanri.category1,categorykanri.category2) = tuhanorder.text1
        left join categorykanri as categorykanri1  on categorykanri1.category1 = 'C1' and concat(categorykanri1.category1,categorykanri1.category2) = tantousya.datatxt0004
        left join seikyuzandaka on seikyuzandaka.datatxt0142 = substr(tuhanorder.information2, 1,8)
            and seikyuzandaka.date0009 = tuhanorder.chumondate
        left join all_billing_ledger_consumption_tax_temp as v_consumption on  v_consumption.tuhan_temp = tuhanorder.information2
        left join syouhin1 on syouhin1.kokyakusyouhinbango =  syukkoold.kawasename
        $search_sql
        AND LEFT(syouhin1.color,2) = 'C6'  AND  RIGHT(syouhin1.color,5) != '90002' 
        ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS all_billing_ledger_sale_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_billing_ledger_sale_temp AS
        SELECT
            all_billing_ledger_sale_temp_before.*,
            v_torihikisaki_temp_1.r17_4 as  contractor,
            v_torihikisaki_temp_1.torihikisaki_cd as  contractor_db,
            v_torihikisaki_temp_3.r17_4 as  end_customer,
            v_torihikisaki_temp_3.torihikisaki_cd as  end_customer_db

            FROM all_billing_ledger_sale_temp_before

            LEFT JOIN v_torihikisaki_temp AS v_torihikisaki_temp_1
            ON v_torihikisaki_temp_1.torihikisaki_cd=all_billing_ledger_sale_temp_before.information1
            LEFT JOIN v_torihikisaki_temp AS v_torihikisaki_temp_3
            ON v_torihikisaki_temp_3.torihikisaki_cd=all_billing_ledger_sale_temp_before.information3
            ");
        //dd(QueryHelper::fetchResult("select * from all_billing_ledger_sale_temp_before"));
//        dd(QueryHelper::fetchResult(DB::table('all_billing_ledger_sale_temp')->toSql()),$datanum0064_val);
        return  DB::table('all_billing_ledger_sale_temp')->toSql();
    }
}
