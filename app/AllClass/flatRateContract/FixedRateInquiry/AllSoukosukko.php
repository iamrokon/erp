<?php


namespace App\AllClass\flatRateContract\FixedRateInquiry;


use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;

class AllSoukosukko
{
    public static function data($datachar07)
    {
        QueryHelper::runQuery("DROP TABLE IF EXISTS all_fixed_rate_inquiry_soukosukko_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_fixed_rate_inquiry_soukosukko_temp as
        select distinct
        soukosyukko.hanbaibukacd,
        soukosyukko.orderbango,
        soukosyukko.syouhinbango as line,
        soukosyukko.yoteisu as branch,
        soukosyukko.datachar29 as target_month,
        to_char(soukosyukko.kanryoubi,'YYYY/MM/DD') as sales_date,
        soukosyukko.syouhizeiritu as sales_amount,
        soukosyukko.soukobango as consumption_tax,
        soukosyukko.syukkomotobango as gross_operating_profit,
        soukosyukko.syukkameter as se,
        soukosyukko.zaikometer as laboratory,
        soukosyukko.seikyubango as call_1,
        soukosyukko.denpyobango as purchase_amount,
        soukosyukko.syouhinid as order_number,
        -- concat( request_1.syouhinbango, ' ', request_1.jouhou) as orders_received,
        -- concat( request_2.syouhinbango, ' ', request_2.jouhou) as earnings,
        -- concat( request_3.syouhinbango, ' ', request_3.jouhou) as payment,
        concat( request_1.jouhou) as orders_received,
        concat( request_2.jouhou) as earnings,
        concat( request_3.jouhou) as payment,
        soukosyukko.datachar08 as details_remark
        from soukosyukko
        left join juchusyukko on juchusyukko.orderbango = soukosyukko.orderbango
        AND juchusyukko.hanbaibukacd = soukosyukko.hanbaibukacd
        AND juchusyukko.dataint18 = soukosyukko.syouhinbango
        AND juchusyukko.dataint19 = soukosyukko.yoteisu
        left join request as request_1 on request_1.color = '0302受注データ作成フラグ' and request_1.syouhinbango =  juchusyukko.datachar24::int
        left join request as request_2 on request_2.color = '0302伝票作成フラグ' and request_2.syouhinbango = juchusyukko.datachar25::int
        left join request as request_3 on request_3.color = '0302入金フラグ' and request_3.syouhinbango =  juchusyukko.datachar26::int
        WHERE soukosyukko.hanbaibukacd = '$datachar07' order by  soukosyukko.syouhinbango , soukosyukko.yoteisu asc
        ");
        return  DB::table('all_fixed_rate_inquiry_soukosukko_temp');
    }
}
