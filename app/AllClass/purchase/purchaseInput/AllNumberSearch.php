<?php


namespace App\AllClass\purchase\purchaseInput;


use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AllNumberSearch
{
    public static function data($bango, $from = false, Request $request = null)
    {

        $condition_sql = "where toiawasebango.touchakutime = '$bango'";
        if ($from) {
            $condition_sql = "";
        }
        $condition_sql .= Str::contains($condition_sql, 'where') ? ' and ' : ' where ';
        $condition_sql .= "hikiatenyuko.syouhinsyu != 1 and toiawasebango.datachar03 != '1' ";

        QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_tantousha_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_tantousha_temp  as
        select distinct bango, name from tantousya");

        QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_hikiatenyuko_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_hikiatenyuko_temp  as
        select distinct syouhinid, syouhinsyu from hikiatenyuko");

        QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_v_orderinfo_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_v_orderinfo_temp  as
        select distinct bango, juchubango, r15 from v_orderinfo");

        QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_v_torihikisaki_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_v_torihikisaki_temp  as
        select distinct torihikisaki_cd, r17_4, r16cd from v_torihikisaki");

        QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_nyukoold_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_nyukoold_temp  as
        select distinct on(syouhinid)syouhinid, syouhinsyu, datachar07, datachar08, denpyobango from nyukoold Order by syouhinid, syouhinsyu");

        QueryHelper::runQuery("DROP TABLE IF EXISTS number_search_syouhin1_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE number_search_syouhin1_temp  as
        select distinct syouhin1.data100, nyukoold.syouhinid, nyukoold.syouhinsyu from number_search_nyukoold_temp as nyukoold join syouhin1 on syouhin1.kongouritsu = nyukoold.datachar07 where nyukoold.denpyobango=0 ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS all_number_search_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_number_search_temp  as
        select distinct
        toiawasebango.unsoumei as order_number,
        substring (tantousya.name,1,3) as responsible_person,
        tantousya.name as person_name,
        toiawasebango.dataint03 as orders,
        to_char(toiawasebango.touchakudate, 'YYYY/MM/DD') as estimate_date,
        v_torihikisaki_1.r16cd as sold_to,
        syouhin1.data100 as end_customer,
        nyukoold.datachar08 as orders_subject,
        toiawasebango.touchakudate
        FROM toiawasebango
        left join number_search_tantousha_temp as tantousya on toiawasebango.touchakutime = tantousya.bango
        left join number_search_hikiatenyuko_temp as hikiatenyuko on  toiawasebango.unsoumei = hikiatenyuko.syouhinid
        left join number_search_v_torihikisaki_temp as v_torihikisaki_1 on toiawasebango.bikou1  = substring(v_torihikisaki_1.torihikisaki_cd, 1, 8)
        left join number_search_nyukoold_temp as nyukoold on toiawasebango.unsoumei = nyukoold.syouhinid
        left join number_search_syouhin1_temp as syouhin1 on toiawasebango.unsoumei = syouhin1.syouhinid  
        $condition_sql order by  toiawasebango.touchakudate desc
        ");    
        return DB::table('all_number_search_temp');
    }
}
