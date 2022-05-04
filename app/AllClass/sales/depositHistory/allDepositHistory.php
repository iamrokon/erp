<?php

namespace App\AllClass\sales\depositHistory;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\kengen;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

class allDepositHistory
{
    public static function data($logged_in_bango, $deleted_item = 2, $req_data = null, $color_array = null, $shinkurokokyakuname = null, $shinkurokokyakugroup = null)
    {
        QueryHelper::runQuery("DROP TABLE IF EXISTS deposit_history_temp");
        //QueryHelper::runQuery("DROP TABLE IF EXISTS daikinseisan_m");

        // QueryHelper::runQuery("CREATE TEMPORARY TABLE daikinseisan_m as
        //     select distinct
        //     shinkurokokyakuname
        //     from daikinseisan
        //     group by shinkurokokyakuname");

        // QueryHelper::runQuery("CREATE TEMPORARY TABLE daikinseisan_m as
        //     select distinct on (shinkurokokyakuname,shinkurokokyakugroup)
        //     daikinseisan.shinkurokokyakuname as shinkurokokyakuname,
        //     daikinseisan.shinkurokokyakugroup as shinkurokokyakugroup
        //     from daikinseisan
        //     order by shinkurokokyakuname,shinkurokokyakugroup");

        $sql = "";
        if (!empty($shinkurokokyakuname)) {
            $all_shinkurokokyakuname = implode(',', $shinkurokokyakuname);
            $all_shinkurokokyakugroup = implode(',', $shinkurokokyakugroup);
        } else {
            $all_shinkurokokyakuname = 0;
        }

        if ($all_shinkurokokyakuname != 0) {
            $sql = " where daikinseisan.shinkurokokyakuname::bigint IN ($all_shinkurokokyakuname) and daikinseisan.shinkurokokyakugroup::integer IN ($all_shinkurokokyakugroup)";
        } else {
            //

            // if(isset($req_data['unsoutesuryou']) && ($req_data['unsoutesuryou']!="")){
            //   if($req_data['unsoutesuryou'] == 1){
            //     $sql .= " where tuhanorder.unsoutesuryou = 1 ";
            //   }elseif ($req_data['unsoutesuryou'] == 2) {
            //     $sql .= " where tuhanorder.unsoutesuryou = 2 and tuhanorder.unsoudaibikitesuryou = 2 ";
            //   }else {
            //     $sql .= " where tuhanorder.unsoutesuryou = 2 and tuhanorder.unsoudaibikitesuryou = 1 ";
            //   }
            // }
            // if(isset($req_data['shinkurokokyakuorderbango']) && ($req_data['shinkurokokyakuorderbango']!="")){
            //   if($req_data['shinkurokokyakuorderbango'] == 1){
            //     $sql .= " and daikinseisan.shinkurokokyakuorderbango = '0' ";
            //   }elseif ($req_data['shinkurokokyakuorderbango'] == 2) {
            //     $sql .= " and daikinseisan.shinkurokokyakuorderbango::integer > 0 ";
            //   }
            // }
            if (isset($req_data['torikomidate_start']) && ($req_data['torikomidate_start'] != "" && $req_data['torikomidate_end'] != "")) {
                $start_date = str_replace('/', '-', $req_data['torikomidate_start']);
                $end_date = str_replace('/', '-', $req_data['torikomidate_end']);
                $sql .= " where substring(daikinseisan.torikomidate::text,1,10) between '$start_date' and '$end_date' ";
            }
            if (isset($req_data['nyukinbi2_start']) && ($req_data['nyukinbi2_start'] != "" && $req_data['nyukinbi2_end'] != "")) {
                $start_date = str_replace('/', '-', $req_data['nyukinbi2_start']);
                $end_date = str_replace('/', '-', $req_data['nyukinbi2_end']);
                $sql .= " and substring(daikinseisan.nyukinbi2::text,1,10) between '$start_date' and '$end_date' ";
            }
        }

        // $group_by = "";
        // if(isset($req_data['unsoutesuryou']) && ($req_data['unsoutesuryou']!="")){
        //   if($req_data['unsoutesuryou'] == 2 || $req_data['unsoutesuryou'] == 3){
        //     $group_by .= " group by daikinseisanold.shinkurokokyakuname, daikinseisan.shinkurokokyakugroup, tuhanorder.unsoutesuryou, tuhanorder.unsoudaibikitesuryou ";
        //   }else {
        //     $group_by .= " group by daikinseisanold.shinkurokokyakuname, daikinseisan.shinkurokokyakugroup, tuhanorder.unsoutesuryou, tuhanorder.unsoudaibikitesuryou ";
        //   }
        // }
        // QueryHelper::runQuery("CREATE TEMPORARY TABLE daikinseisan_m as
        // select distinct on (shinkurokokyakuname, shinkurokokyakugroup)
        // shinkurokokyakuname,
        // shinkurokokyakugroup,
        // from daikinseisan
        // order by shinkurokokyakuname, shinkurokokyakugroup asc");
        $fields = "";
        if ($color_array) {
            foreach ($color_array as $field => $color) {
                if ($field == "tsuchimail") {
                    $fields .= "(select CONCAT(syouhinbango,' ',jouhou) from request where color='$color' and syouhinbango::text=max(eczaikorendou.tsuchimail) LIMIT 1) as tsuchimail,";
                } elseif ($field == "rendoumail") {
                    $fields .= "(select CONCAT(syouhinbango,' ',jouhou) from request where color='$color' and syouhinbango::text=max(eczaikorendou.rendoumail) LIMIT 1) as rendoumail,";
                }
            }
        }

        QueryHelper::runQuery(
            "CREATE TEMPORARY TABLE deposit_history_temp as
        select
        -- * from (
        -- select distinct on (deposit_history_shinkurokokyakuname, deposit_history_shinkurokokyakugroup)
        max(daikinseisan.kokyakubango) as kokyakubango,
        CASE
            WHEN max(daikinseisan.torikomidate::text) is null THEN NULL
            ELSE replace(substring(max(daikinseisan.torikomidate::text),1,10),'-','/') END as torikomidate,
        CASE
            WHEN max(daikinseisan.nyukinbi2::text) is null THEN NULL
            ELSE replace(substring(max(daikinseisan.nyukinbi2::text),1,10),'-','/') END as nyukinbi2,
        daikinseisan.shinkurokokyakuname::bigint as deposit_history_shinkurokokyakuname,
        daikinseisan.shinkurokokyakugroup::integer as deposit_history_shinkurokokyakugroup,
        max(daikinseisan.shinkurokokyakuorderbango) as shinkurokokyakuorderbango,
        max(daikinseisan.soufusakiname) as soufusakiname,
        max(daikinseisan.chumonsyaname) as information1_db,
        max(daikinseisan.nyukingaku) as deposit_history_nyukingaku,
        CASE
            WHEN max(daikinseisan.chumondate::text) is null THEN NULL
            ELSE replace(substring(max(daikinseisan.chumondate::text),1,10),'-','/') END as chumondate,
        max(daikinseisan.soufusakiyubinbango) as soufusakiyubinbango,
        max(daikinseisan.unsoumei) as unsoumei,
        max(daikinseisan.toiawasebango) as toiawasebango,
        max(daikinseisan.dataint01) as dataint01,
        concat_ws('/',max(kokyaku1Information1.address),max(haisouInformation1.haisoumoji1)) as information1_detail_show,
        -- concat_ws('/',substring(replace(kokyaku1Information1.address,'　',''),1,5),substring(replace(haisouInformation1.haisoumoji1,'　',''),1,3)) as information1_detail_show,
        max(tuhanorder.unsoutesuryou) as unsoutesuryou,
        max(tuhanorder.unsoudaibikitesuryou) as unsoudaibikitesuryou,
        -- CASE
        --     WHEN eczaikorendou.tsuchimail='1' THEN concat_ws('：',eczaikorendou.tsuchimail,'済')
        --     WHEN eczaikorendou.tsuchimail='2' THEN concat_ws('：',eczaikorendou.tsuchimail,'未')
        --     ELSE eczaikorendou.tsuchimail END as tsuchimail,
        -- CASE
        --     WHEN eczaikorendou.rendoumail='1' THEN concat_ws('：',eczaikorendou.rendoumail,'済')
        --     WHEN eczaikorendou.rendoumail='2' THEN concat_ws('：',eczaikorendou.rendoumail,'未')
        --     ELSE eczaikorendou.rendoumail END as rendoumail,
        $fields
        CASE
            WHEN max(categorykanri1.category2) is null THEN NULL
            ELSE CONCAT(RIGHT(max(categorykanri1.category2), 2) ,' ',max(categorykanri1.category4))END as soufusaki_val,
        CASE
            WHEN max(categorykanri2.category2) is null THEN NULL
            ELSE CONCAT(RIGHT(max(categorykanri2.category2), 2) ,' ',max(categorykanri2.category4))END as unsoumei_val,
        CASE
            WHEN max(categorykanri3.category2) is null THEN NULL
            ELSE CONCAT(RIGHT(max(categorykanri3.category2), 2) ,' ',max(categorykanri3.category4))END as soufusakiname_val,
        max(daikinseisanold.nyukingaku) as nyukingaku_o,
        --to_char(daikinseisanold.nyukinbi,'YYYY-MM-DD')
        --to_char(daikinseisanold.nyukinbi,'HH24:MI:SS')
        to_char(  max(daikinseisan.nyukinbi2),'YYYY-MM-DD') as registration_date,
        to_char(  max(daikinseisan.nyukinbi2),'HH24:MI:SS') as registration_time,
        to_char(  max(daikinseisan.henpinbi),'YYYY-MM-DD') as update_date,
        to_char(  max(daikinseisan.henpinbi),'HH24:MI:SS') as update_time,
          --max(daikinseisan.henpindenpyobango) as changer,
          (select name from tantousya where bango = max(daikinseisan.henpindenpyobango)) as changer,
          (select LEFT(REPLACE(name,' ',''),3) from tantousya where bango = max(daikinseisan.henpindenpyobango)) as changer_short,
          max(daikinseisan.shinkurokokyakuorderbango) as  num_of_cor,
        to_char(max(eczaikorendou.apichecktime),'YYYY-MM-DD') as registration_date_2,
        to_char(max(eczaikorendou.apichecktime),'HH24:MI:SS') as registration_time_2,
        to_char(max(eczaikorendou.apitime01),'YYYY-MM-DD') as update_date_2,
        to_char(max(eczaikorendou.apitime01),'HH24:MI:SS')  as update_time_2,
        max(t1.name) as changer_2,
        LEFT(REPLACE(max(t1.name),' ',''),3) as changer_2_short

        from daikinseisan

        -- join daikinseisan_m on
        -- daikinseisan_m.shinkurokokyakuname=daikinseisan.shinkurokokyakuname
        -- and daikinseisan_m.shinkurokokyakugroup=daikinseisan.shinkurokokyakugroup

        left join tuhanorder
            on daikinseisan.chumonsyaname=substr(tuhanorder.information2,1,8)

        left join daikinseisanold
            on daikinseisanold.shinkurokokyakuname = daikinseisan.shinkurokokyakuname
            and daikinseisanold.shinkurokokyakugroup = daikinseisan.shinkurokokyakugroup
        left join eczaikorendou
            on daikinseisan.shinkurokokyakuname = eczaikorendou.sitename
            and daikinseisan.shinkurokokyakugroup = eczaikorendou.yukouflag::text
        left join tantousya as t1
            on eczaikorendou.apiid01 = t1.bango
        --information1
        left join kokyaku1 as kokyaku1Information1
        on substring(daikinseisan.chumonsyaname,1,6) = kokyaku1Information1.yobi12

        left join haisou as haisouInformation1
        on substring(daikinseisan.chumonsyaname,1,6) = haisouInformation1.shikibetsucode
        and substring(daikinseisan.chumonsyaname::text,7,2) = haisouInformation1.torihikisakibango

        left join categorykanri as categorykanri1 on substring(daikinseisan.soufusakiyubinbango,1,2) = categorykanri1.category1
        and substring(daikinseisan.soufusakiyubinbango,3,2) = categorykanri1.category2

        --left join categorykanri as categorykanri2 on substring(daikinseisan.unsoumei,1,2) = categorykanri2.category1
        --and substring(daikinseisan.unsoumei,3,LENGTH(daikinseisan.unsoumei)-2) = categorykanri2.category2
        left join categorykanri as categorykanri2 on substring(daikinseisan.unsoumei,1,2) = categorykanri2.category1
        and substring(daikinseisan.unsoumei,3,1) = categorykanri2.category2

        left join categorykanri as categorykanri3 on substring(daikinseisan.soufusakiname,1,2) = categorykanri3.category1
        and substring(daikinseisan.soufusakiname,3,2) = categorykanri3.category2

        $sql
        -- order by deposit_history_shinkurokokyakuname, deposit_history_shinkurokokyakugroup asc) p
        group by deposit_history_shinkurokokyakuname,deposit_history_shinkurokokyakugroup
        ORDER BY torikomidate, deposit_history_shinkurokokyakuname, soufusakiname, deposit_history_shinkurokokyakugroup asc
        "
        );
        $data = DB::table('deposit_history_temp');
        if ($deleted_item == 2) {
            $data = DB::table('deposit_history_temp')->whereRaw('dataint01 != ' . 2);
        } else {
            $data = DB::table('deposit_history_temp');
        }
        return $data;
    }
}
