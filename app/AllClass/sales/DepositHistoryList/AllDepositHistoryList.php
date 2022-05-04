<?php

namespace App\AllClass\sales\DepositHistoryList;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;

class AllDepositHistoryList
{
    public static function data($bango = null, $bangos = [], $req_data = [])
    {

        $search_sql = "";

        // $payment_day_start = $req_data['payment_day_start'];
        // $payment_day_end = $req_data['payment_day_end'];
        // $disposal_day_start = $req_data['disposal_day_start'];
        // $disposal_day_end = $req_data['disposal_day_end'];
        // $information2 = $req_data['billing_address'];
        // $unsoutesuryo = $req_data['unsoutesuryou'];


        if (isset($req_data['payment_day_start']) && isset($req_data['payment_day_end'])) {
            $payment_day_start = str_replace('/', '', $req_data['payment_day_start']);
            $payment_day_end = str_replace('/', '', $req_data['payment_day_end']);
            $search_sql .= " WHERE to_char(daikinseisan.torikomidate,'YYYYMMDD')   between '$payment_day_start' and '$payment_day_end'";
        }
        if (isset($req_data['disposal_day_start']) && isset($req_data['disposal_day_end'])) {
            $disposal_day_start = str_replace('/', '', $req_data['disposal_day_start']);
            $disposal_day_end = str_replace('/', '',  $req_data['disposal_day_end']);
            $search_sql .= " AND to_char(daikinseisanold.nyukinbi,'YYYYMMDD') between '$disposal_day_start' and '$disposal_day_end'";
        }
        
        //if (isset($req_data['top_billing_address'])) {
        //    $search_sql .= " AND (tuhanorder.information2 like '" . $req_data['top_billing_address'] . "%' OR tuhanorder.information2 IS NULL)";
        //}

        if (isset($req_data['unsoutesuryou'])) {
            if ($req_data['unsoutesuryou'] == 1) {
                //$search_sql .= " AND tuhanorder.unsoutesuryou='1' AND daikinseisanold.otodoketime IS NOT NULL AND daikinseisanold.otodoketime != '0' ";
                $search_sql .= " AND (tuhanorder.unsoutesuryou='1' OR daikinseisanold.otodoketime = '0000000000') ";
            } elseif ($req_data['unsoutesuryou'] == 2) {
                $search_sql .= " AND tuhanorder.unsoutesuryou ='2' and tuhanorder.unsoudaibikitesuryou = '2' ";
            } elseif ($req_data['unsoutesuryou'] == 3) {
                $search_sql .= " AND tuhanorder.unsoutesuryou ='2' and tuhanorder.unsoudaibikitesuryou = '1' ";
            }
        }

        QueryHelper::runQuery("DROP TABLE IF EXISTS deposit_history_list_before_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE deposit_history_list_before_temp as
        SELECT DISTINCT
        daikinseisanold.shinkurokokyakuorderbango,
        daikinseisanold.moneymax,
        daikinseisanold.otodoketime,
        daikinseisanold.shinkurokokyakuname,
        daikinseisanold.shinkurokokyakugroup,
        daikinseisan.torikomidate,
        daikinseisanold.nyukinbi,
        tuhanorder.orderbango,
        tuhanorder.information1,
        tuhanorder.information2,
        tuhanorder.unsoutesuryou,
        tuhanorder.unsoudaibikitesuryou,
        to_char(daikinseisanold.nyukinbi,'YYYY/MM/DD') as disposal_day,
        daikinseisanold.shinkurokokyakuorderbango as application_number ,
        daikinseisanold.moneymax as dhl_apply_line_number,
        --CASE
        --    WHEN orderhenkan.intorder05 is null THEN NULL
        --    ELSE concat_ws('/',substring(orderhenkan.intorder05::text,1,4), substring(orderhenkan.intorder05::text,5,2),substring(orderhenkan.intorder05::text,7,2))  END as payment_day,
        CASE
            WHEN daikinseisan.torikomidate is null THEN NULL
            ELSE concat_ws('/',substring(daikinseisan.torikomidate::text,1,4), substring(daikinseisan.torikomidate::text,6,2),substring(daikinseisan.torikomidate::text,9,2))  END as payment_day,
        daikinseisanold.otodoketime as sales_number,
       
        daikinseisanold.nyukingaku as dhl_deposit_application,
        to_char(daikinseisanold.nyukingaku,'FM99,999,999,999,999') as formatted_dhl_deposit_application,
        REPLACE(tantousya.name,' ','') as in_charge,
        orderhenkan.kokyakuorderbango as order_number,
       CASE
        WHEN orderhenkan.intorder03 is null THEN NULL
        ELSE concat_ws('/',substring(orderhenkan.intorder03::text,1,4),
        substring(orderhenkan.intorder03::text,5,2),
        substring(orderhenkan.intorder03::text,7,2)) END as sales_date,
        daikinseisan.shinkurokokyakuname as deposit_number,
        daikinseisan.shinkurokokyakugroup as deposit_line_number,
        daikinseisan.chumonsyaname,
        concat(categorykanri.category2,' ',categorykanri.category4) as payment_method,
        concat(request_1.syouhinbango,' ',request_1.jouhou) as receivable_flag,
        concat(request_2.syouhinbango,' ',request_2.jouhou) as billing_flag,
        concat(request_3.syouhinbango,' ',request_3.jouhou) as advance_classification,
        concat(request_4.syouhinbango,' ',request_4.jouhou) as sold_category,
        to_char(daikinseisanold.nyukinbi,'YYYY-MM-DD') as registration_date,
        to_char(daikinseisanold.nyukinbi,'HH24:MI:SS') as registration_time,
        t1.name as changer,
        LEFT(REPLACE(t1.name,' ',''),3) as changer_short
        FROM daikinseisanold
        left join tantousya as t1 on daikinseisanold.shiharaikubun = t1.bango
        left join daikinseisan on daikinseisanold.shinkurokokyakuname = daikinseisan.shinkurokokyakuname and daikinseisanold.shinkurokokyakugroup = daikinseisan.shinkurokokyakugroup
        left join orderhenkan on daikinseisanold.otodoketime = orderhenkan.datachar10
        left join tuhanorder on orderhenkan.bango = tuhanorder.orderbango
        left join tantousya on tuhanorder.text2 = tantousya.bango
        left join categorykanri as categorykanri on categorykanri.category1 = 'A9' and concat(categorykanri.category1,categorykanri.category2) = daikinseisan.soufusakiname
        left join request as request_1 on request_1.color = '0422売掛残高更新フラグ' and request_1.syouhinbango = daikinseisanold.soufusakiname::int
        left join request as request_2 on request_2.color = '0422請求残高更新フラグ' and request_2.syouhinbango = daikinseisanold.soufusakiyubinbango::int
        left join request as request_3 on request_3.color = '0422前受区分' and request_3.syouhinbango = tuhanorder.unsoutesuryou::int
        left join request as request_4 on request_4.color = '0422売済区分' and request_4.syouhinbango = tuhanorder.unsoudaibikitesuryou::int
        $search_sql
        order by daikinseisanold.shinkurokokyakuorderbango,daikinseisanold.moneymax,daikinseisanold.otodoketime,daikinseisanold.shinkurokokyakuname,daikinseisanold.shinkurokokyakugroup
        ");
        
        $search_sql2 = "";
        if (isset($req_data['top_billing_address'])) {
            $top_billing_address = $req_data['top_billing_address'];
            $search_sql2 .= " where chumonsyaname = '$top_billing_address' OR chumonsyaname IS NULL";
        }
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS deposit_history_list_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE deposit_history_list_temp as
        SELECT deposit_history_list_before_temp.*,
        v_torihikisaki1.r16cd as billing_address,
        v_torihikisaki2.r17_4cd as contractor,
        case when length(v_orderinfo.r15) >= 12
             then concat(left(v_orderinfo.r15,10),'...')
        else v_orderinfo.r15 end as order_subject
        
        FROM deposit_history_list_before_temp
        left join v_orderinfo on deposit_history_list_before_temp.orderbango = v_orderinfo.bango
        --left join v_torihikisaki as v_torihikisaki1 on deposit_history_list_before_temp.information2 = v_torihikisaki1.torihikisaki_cd
        left join v_torihikisaki as v_torihikisaki1 on deposit_history_list_before_temp.chumonsyaname = substring(v_torihikisaki1.torihikisaki_cd,1,8)
        left join v_torihikisaki as v_torihikisaki2 on deposit_history_list_before_temp.information1 = v_torihikisaki2.torihikisaki_cd
        $search_sql2
        ");
        
        //$query = DB::table('deposit_history_list_temp')->toSql();
        //$data = QueryHelper::fetchResult($query);
        //dd($data);
        
        return  DB::table('deposit_history_list_temp');
    }
}
