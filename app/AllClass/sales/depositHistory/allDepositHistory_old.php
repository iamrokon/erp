<?php

namespace App\AllClass\sales\depositHistory;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\kengen;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class allDepositHistory{
    public static function data($logged_in_bango,$deleted_item=2,$req_data=null,$color_array=null,$shinkurokokyakuname=null,$shinkurokokyakugroup=null)
    {
        QueryHelper::runQuery("DROP TABLE IF EXISTS deposit_history_temp");
    //     QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_m");
    //
    //     QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_m as
    //         select distinct
    //         kokyakuorderbango, max(ordertypebango2) as maxval
    //         from orderhenkan
    //         where synchroorderbango =0
    //         group by kokyakuorderbango");
    //
        $sql = "";
        if(!empty($shinkurokokyakuname)){
            $all_shinkurokokyakuname = implode(',', $shinkurokokyakuname);
            $all_shinkurokokyakugroup = implode(',', $shinkurokokyakugroup);
        }
		else{
            $all_shinkurokokyakuname = 0;
        }

        if($all_shinkurokokyakuname!=0){
            $sql = " where daikinseisan.shinkurokokyakuname::integer IN ($all_shinkurokokyakuname) and daikinseisan.shinkurokokyakugroup::integer IN ($all_shinkurokokyakugroup)";
        }else{
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
          if(isset($req_data['torikomidate_start']) && ($req_data['torikomidate_start']!="" && $req_data['torikomidate_end']!="")){
              $start_date = str_replace('/','-',$req_data['torikomidate_start']);
              $end_date = str_replace('/','-',$req_data['torikomidate_end']);
              $sql .= " where substring(daikinseisan.torikomidate::text,1,10) between '$start_date' and '$end_date' ";
          }
          if(isset($req_data['nyukinbi2_start']) && ($req_data['nyukinbi2_start']!="" && $req_data['nyukinbi2_end']!="")){
              $start_date = str_replace('/','-',$req_data['nyukinbi2_start']);
              $end_date = str_replace('/','-',$req_data['nyukinbi2_end']);
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
        if($color_array){
          foreach($color_array as $field=>$color)
          {
            if($field == "tsuchimail"){
              $fields .= "(select CONCAT(syouhinbango,' ',jouhou) from request where color='$color' and syouhinbango::text=eczaikorendou.tsuchimail LIMIT 1) as tsuchimail,";
            }elseif ($field == "rendoumail") {
              $fields .= "(select CONCAT(syouhinbango,' ',jouhou) from request where color='$color' and syouhinbango::text=eczaikorendou.rendoumail LIMIT 1) as rendoumail,";
            }
          }
        }

        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE deposit_history_temp as
        select *
        from (select distinct on (deposit_history_shinkurokokyakuname, deposit_history_shinkurokokyakugroup)
        daikinseisan.kokyakubango as kokyakubango,
        CASE
            WHEN daikinseisan.torikomidate::text is null THEN NULL
            ELSE replace(substring(daikinseisan.torikomidate::text,1,10),'-','/') END as torikomidate,
        CASE
            WHEN daikinseisan.nyukinbi2::text is null THEN NULL
            ELSE replace(substring(daikinseisan.nyukinbi2::text,1,10),'-','/') END as nyukinbi2,
        daikinseisan.shinkurokokyakuname as deposit_history_shinkurokokyakuname,
        daikinseisan.shinkurokokyakugroup as deposit_history_shinkurokokyakugroup,
        daikinseisan.shinkurokokyakuorderbango as shinkurokokyakuorderbango,
        daikinseisan.soufusakiname as soufusakiname,
        daikinseisan.chumonsyaname as information1_db,
        daikinseisan.nyukingaku as deposit_history_nyukingaku,
        CASE
            WHEN daikinseisan.chumondate::text is null THEN NULL
            ELSE replace(substring(daikinseisan.chumondate::text,1,10),'-','/') END as chumondate,
        daikinseisan.soufusakiyubinbango as soufusakiyubinbango,
        daikinseisan.unsoumei as unsoumei,
        daikinseisan.toiawasebango as toiawasebango,
        daikinseisan.dataint01 as dataint01,
        concat_ws('/',kokyaku1Information1.address,haisouInformation1.haisoumoji1) as information1_detail_show,
        -- concat_ws('/',substring(replace(kokyaku1Information1.address,'　',''),1,5),substring(replace(haisouInformation1.haisoumoji1,'　',''),1,3)) as information1_detail_show,
        tuhanorder.unsoutesuryou as unsoutesuryou,
        tuhanorder.unsoudaibikitesuryou as unsoudaibikitesuryou,
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
            WHEN categorykanri1.category2 is null THEN NULL
            ELSE CONCAT(RIGHT(categorykanri1.category2, 2) ,' ',categorykanri1.category4)END as soufusaki_val,
        CASE
            WHEN categorykanri2.category2 is null THEN NULL
            ELSE CONCAT(RIGHT(categorykanri2.category2, 2) ,' ',categorykanri2.category4)END as unsoumei_val,
        CASE
            WHEN categorykanri3.category2 is null THEN NULL
            ELSE CONCAT(RIGHT(categorykanri3.category2, 2) ,' ',categorykanri3.category4)END as soufusakiname_val,
        daikinseisanold.nyukingaku as nyukingaku_o
        from daikinseisan
        left join tuhanorder
            on daikinseisan.chumonsyaname=substr(tuhanorder.information2,1,8)
        left join daikinseisanold
            on daikinseisanold.shinkurokokyakuname = daikinseisan.shinkurokokyakuname
            and daikinseisanold.shinkurokokyakugroup = daikinseisan.shinkurokokyakugroup
        left join eczaikorendou
            on daikinseisan.shinkurokokyakuname = eczaikorendou.sitename
            and daikinseisan.shinkurokokyakugroup = eczaikorendou.yukouflag::text
        --information1
        left join kokyaku1 as kokyaku1Information1
        on substring(daikinseisan.chumonsyaname,1,6) = kokyaku1Information1.yobi12

        left join haisou as haisouInformation1
        on substring(daikinseisan.chumonsyaname,1,6) = haisouInformation1.shikibetsucode
        and substring(daikinseisan.chumonsyaname::text,7,2) = haisouInformation1.torihikisakibango

        left join categorykanri as categorykanri1 on substring(daikinseisan.soufusakiyubinbango,1,2) = categorykanri1.category1
        and substring(daikinseisan.soufusakiyubinbango,3,2) = categorykanri1.category2

        left join categorykanri as categorykanri2 on substring(daikinseisan.unsoumei,1,2) = categorykanri2.category1
        and substring(daikinseisan.unsoumei,3,LENGTH(daikinseisan.unsoumei)-2) = categorykanri2.category2

        left join categorykanri as categorykanri3 on substring(daikinseisan.soufusakiname,1,2) = categorykanri3.category1
        and substring(daikinseisan.soufusakiname,3,2) = categorykanri3.category2
        $sql
        order by deposit_history_shinkurokokyakuname, deposit_history_shinkurokokyakugroup asc) p

        ORDER BY torikomidate, deposit_history_shinkurokokyakuname, soufusakiname, deposit_history_shinkurokokyakugroup asc
        ");
        $data = DB::table('deposit_history_temp');
        if ($deleted_item == 2) {
            $data = DB::table('deposit_history_temp')->whereRaw('dataint01 != ' . 2);
        } else {
            $data = DB::table('deposit_history_temp');
        }
        return $data;
    }
}
