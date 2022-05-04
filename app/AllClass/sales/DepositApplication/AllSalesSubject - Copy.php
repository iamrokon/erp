<?php


namespace App\AllClass\sales\DepositApplication;


use App\AllClass\db\QueryHelperFacade as QueryHelper;

class AllSalesSubject
{
    public static function data($request,$color_array=null)
    {
        try {
            $req_order_date_start = $request['sales_date_start'];
            $req_order_date_end = $request['sales_date_end'];
            $req_billing_address = substr($request['billing_address'],0,8);
            $req_checked_status = $request['complete_status'];
            QueryHelper::runQuery("DROP TABLE IF EXISTS applied_amount_temp ");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE applied_amount_temp as
            SELECT DISTINCT 
            URIAGE_TOTAL.juchubango, 
            (URIAGE_TOTAL.amount - MAINTENANCE.amount) as amount, 
            URIAGE_TOTAL.juchukubun2, 
            MAINTENANCE.kaiinid
	        from
                ( select
                   juchukubun2, 
                   (numeric3 +  numeric4)  as amount, 
                   juchubango as juchubango
                from tuhanorder
                group by juchukubun2
                ) URIAGE_TOTAL
          join
          ( select 
            kaiinid,
            sum(syukkasu * dataint04) + sum(datachar20::integer) as amount

              from syukkoold
              where datachar13 != '3'
              group by kaiinid
             ) MAINTENANCE on  URIAGE_TOTAL.juchukubun2 = MAINTENANCE.kaiinid");

            QueryHelper::runQuery("DROP TABLE IF EXISTS not_payment_temp ");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE not_payment_temp as
              select
        	     otodoketime,
        	     sum(nyukingaku) as amount
        	  from daikinseisanold
        	  group by otodoketime");

            QueryHelper::runQuery("DROP TABLE IF EXISTS torikomidate_temp ");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE torikomidate_temp as
            select
              daikinseisan.shinkurokokyakuname,
              max(daikinseisan.torikomidate) as torikomidate,
              max(daikinseisanold.otodoketime) as otodoketime
            from daikinseisanold
            left join orderhenkan
            on daikinseisanold.otodoketime = orderhenkan.datachar10
            left join daikinseisan
            on daikinseisanold.shinkurokokyakuname = daikinseisan.shinkurokokyakuname
            and daikinseisanold.shinkurokokyakugroup = daikinseisan.shinkurokokyakugroup
            group by daikinseisan.shinkurokokyakuname");



            $fields = "";
            if($color_array){
              foreach($color_array as $field=>$color)
              {
                if($field == "housoukubun"){
                  $fields .= "(select CONCAT(syouhinbango,' ',jouhou) from request where color='$color' and syouhinbango::text=max(tuhanorder.housoukubun) LIMIT 1) as housoukubun,";
                }elseif($field == "unsoutesuryou"){
                  $fields .= "(select CONCAT(syouhinbango,' ',jouhou) from request where color='$color' and syouhinbango=max(tuhanorder.unsoutesuryou) LIMIT 1) as unsoutesuryou_val,";
                }elseif ($field == "unsoudaibikitesuryou") {
                  $fields .= "(select CONCAT(syouhinbango,' ',jouhou) from request where color='$color' and syouhinbango=max(tuhanorder.unsoudaibikitesuryou) LIMIT 1) as unsoudaibikitesuryou_val,";
                }
              }
            }

            $search_sql = "SELECT DISTINCT
            tuhanorder.juchubango as juchubango,
		    max(tuhanorder.juchukubun2) as juchukubun2,
		    max(tuhanorder.unsoutesuryou) as unsoutesuryou,
		    max(tuhanorder.unsoudaibikitesuryou) as unsoudaibikitesuryou,
        CASE
            WHEN max(tuhanorder.numeric3) = max(daikinseisanold.nyukingaku) THEN 1
            ELSE 2 END as numeric3_val,
		    -- max(tuhanorder.numeric3) as numeric3,
		    -- max(daikinseisanold.nyukingaku) as nyukingaku,
		    max(hikiatesyukko.dataint01) as dataint01,
		    max(orderhenkan.bango) as orderbango,
		    max(soukosyukko.kingaku) as kingaku,
		    max(juchusyukko.hanbaibukacd) as hanbaibukacd,
		    max(juchusyukko.dataint18) as dataint18,
		    max(juchusyukko.dataint19) as dataint19,
		    max(juchusyukko.dataint20) as dataint20,
        max(daikinseisan.shinkurokokyakuname) as shinkurokokyakuname,
        max(eczaikorendou.sitename) as payment_number,
        max(eczaikorendou.yukouflag) as serial,
		    max(tantousya.name) as tantousya_name,
		    max(REQUEST_SOKUJI.name) as request_sokuji_name,
		    max(orderhenkan.intorder03) as intorder03,
        CASE
            WHEN max(orderhenkan.intorder03::text) is null THEN NULL
            ELSE concat_ws('/',substring(max(orderhenkan.intorder03::text),1,4),
            substring(max(orderhenkan.intorder03::text),5,2),
            substring(max(orderhenkan.intorder03::text),7,2)) END as intorder03_val,
		    max(orderhenkan.datachar10) as datachar10,
        max(orderhenkan.intorder05) as intorder05,
        CASE
            WHEN max(orderhenkan.intorder05::text) is null THEN NULL
            ELSE concat_ws('/',substring(max(orderhenkan.intorder05::text),1,4),
            substring(max(orderhenkan.intorder05::text),5,2),
            substring(max(orderhenkan.intorder05::text),7,2)) END as intorder05_val,
		    max(tuhanorder.juchukubun1) as juchukubun1,
		    max(tuhanorder.information1) as information1,
        concat_ws('/',max(tuhanorder.information1::text),substring(replace(max(kokyaku1Information1.address),'　',''),1,5),substring(replace(max(haisouInformation1.haisoumoji1),'　',''),1,3),substring(replace(max(etsuransyaInformation1.mail4),'　',''),1,3)) as information1_detail_show,
        $fields
        max(applied_amount_temp.amount) as applied_amount,
        max(not_payment_temp.amount) as not_payment_amount,
		    max(REQUEST_MAEUKE.name) as REQUEST_MAEUKE_NAME,
        replace(substring(max(torikomidate_temp.torikomidate::text),1,10),'-','') as torikomidate,
		    max(REQUEST_URIZUMI.name) as REQUEST_URIZUMI_NAME
            from tuhanorder
            left join orderhenkan
            on tuhanorder.orderbango = orderhenkan.bango
            left join hikiatesyukko
            on tuhanorder.orderbango = hikiatesyukko.orderbango
            left join syukkoold
            on tuhanorder.orderbango = syukkoold.orderbango
            left join tantousya
            on tuhanorder.text2 = tantousya.bango
            left join applied_amount_temp
            on tuhanorder.juchubango = applied_amount_temp.juchubango
            left join daikinseisan
              on daikinseisan.chumonsyaname=substr(tuhanorder.information2,1,8)
            left join not_payment_temp
              on not_payment_temp.otodoketime = tuhanorder.juchukubun2
            left join torikomidate_temp
              on torikomidate_temp.shinkurokokyakuname = daikinseisan.shinkurokokyakuname
              and torikomidate_temp.otodoketime = tuhanorder.juchukubun2
            left join daikinseisanold
              on tuhanorder.juchukubun2 = daikinseisanold.otodoketime
            left join eczaikorendou
              on daikinseisan.shinkurokokyakuname = eczaikorendou.sitename
              and daikinseisan.shinkurokokyakugroup = eczaikorendou.yukouflag::text
            left join orderhenkan as orderhenkan2
            on tuhanorder.juchukubun2 = orderhenkan2.datachar10
            left join soukosyukko
            on soukosyukko.syouhinid = orderhenkan2.kokyakuorderbango
            left join juchusyukko
            on soukosyukko.hanbaibukacd = juchusyukko.hanbaibukacd
            and soukosyukko.syouhinbango = juchusyukko.dataint18
            and soukosyukko.yoteisu = juchusyukko.dataint19
            and soukosyukko.kingaku = juchusyukko.dataint20

            --information1
            left join kokyaku1 as kokyaku1Information1
            on substring(tuhanorder.information1,1,6) = kokyaku1Information1.yobi12

            left join haisou as haisouInformation1
            on substring(tuhanorder.information1,1,6) = haisouInformation1.shikibetsucode
            and substring(tuhanorder.information1::text,7,2) = haisouInformation1.torihikisakibango


            left join etsuransya as etsuransyaInformation1
            on etsuransyaInformation1.datatxt0014=SUBSTRING (tuhanorder.information1,1, 6)
            and etsuransyaInformation1.datatxt0015=SUBSTRING (tuhanorder.information1,7,2)
            and etsuransyaInformation1.datatxt0049=SUBSTRING (tuhanorder.information1,9,3)
            --information1 end

            left join
             (select syouhinbango as cd,syouhinbango || ' ' || jouhou  as name
                from   request
              where  color = '0419即時区分') REQUEST_SOKUJI
		    on cast( REQUEST_SOKUJI.cd  as varchar(20) ) =  cast( tuhanorder.housoukubun as varchar(20))
            left join
             (select syouhinbango as cd, syouhinbango || ' ' || jouhou  as name
                    from   request
                where  color = '0419前受区分') REQUEST_MAEUKE
		    on cast( REQUEST_MAEUKE.cd  as varchar(20) ) = cast( tuhanorder.unsoutesuryou as varchar(20))
            left join
             (select
            	syouhinbango as cd,
            	syouhinbango || ' ' || jouhou  as name
              from   request
              where  color = '0419売済区分') REQUEST_URIZUMI
            on REQUEST_URIZUMI.cd = tuhanorder.unsoudaibikitesuryou
        where tuhanorder.juchukubun2 is not null
		    and tuhanorder.text1 <> 'U522'
		    and tuhanorder.text1 <> 'U560'
            and syukkoold.yoteimeter = 0
            and syukkoold.dataint01 = 0
            and syukkoold.datachar13 != '3'
            ";
            if ($req_order_date_start && $req_order_date_end && $req_order_date_start == $req_order_date_end) {
                $search_sql .= "  and cast(orderhenkan.intorder03 as bigint)  = $req_order_date_start";
            } elseif ($req_order_date_start && $req_order_date_end && $req_order_date_start < $req_order_date_end) {
                $search_sql .= "  and cast(orderhenkan.intorder03 as bigint) between $req_order_date_start and $req_order_date_end";
            } elseif ($req_order_date_start && $req_order_date_end == '') {
                $search_sql .= "  and cast(orderhenkan.intorder03 as bigint)  > $req_order_date_start";
            } elseif ($req_order_date_end && $req_order_date_start == '') {
                $search_sql .= "  and cast(orderhenkan.intorder03 as bigint)  < $req_order_date_end";
            }
            if ($req_billing_address) {
                $search_sql .= "  and tuhanorder.information2 like '$req_billing_address%'";
            }
            if ($req_checked_status) {
                $search_sql .= " and  hikiatesyukko.dataint01 = $req_checked_status";
            }
            $search_sql .= " group by tuhanorder.juchubango ";
            $search_sql .= " order by intorder05, intorder03, juchukubun2";
            QueryHelper::runQuery("DROP TABLE IF EXISTS all_sales_subject_temp ");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE all_sales_subject_temp  as  $search_sql");
            $res = QueryHelper::fetchResult("select * from all_sales_subject_temp");
            //dd($res);
            return $res;
        } catch (\Exception $e) {
            return $e;
            //dd($e);
        }
    }

}
