<?php

namespace App\AllClass\order\backOrder;

use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use App\AllClass\master\CSVLogger;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;
use App\tantousya;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Helper;

class AllBackOrder
{

    public static function readData($bango,$allRequest,$salesDate_start,$salesDate_end){

        if(!empty($allRequest['division_datachar05_start'])){
            $req_division_start  = substr($allRequest['division_datachar05_start'], 4,2) ;
        }else{
            $req_division_start = null;
        }
        if(!empty($allRequest['division_datachar05_end'])){
            $req_division_end  = substr($allRequest['division_datachar05_end'], 4,2);
        }else{
            $req_division_end = null;
        }

        if(!empty($allRequest['department_datachar05_start'])){
            $req_department_start =  substr($allRequest['department_datachar05_start'], 4,3);
        }else{
            $req_department_start = null;
        }
        if(!empty($allRequest['department_datachar05_end'])){
            $req_department_end = substr($allRequest['department_datachar05_end'], 4,3);
        }else{
            $req_department_end = null;
        }

        if(!empty($allRequest['group_datachar05_start'])){
            $req_t_group_start = substr($allRequest['group_datachar05_start'], 4,4);
        }else{
            $req_t_group_start = null;
        }
        if(!empty($allRequest['group_datachar05_end'])){
            $req_t_group_end = substr($allRequest['group_datachar05_end'], 4,4);
        }else{
            $req_t_group_end = null;
        }

        if(!empty($allRequest['datachar05'])){
            $datachar05 = $allRequest['datachar05'];
        }else{
            $datachar05 = null;
        }

        if(!empty($allRequest['backOrderSupplier_db'])){
            $req_billing_address = $allRequest['backOrderSupplier_db'];
        }else{
            $req_billing_address = null;
        }


        $radio_1=!empty($allRequest['rd1'])?$allRequest['rd1']:null;
        $radio_2=!empty($allRequest['rd2'])?$allRequest['rd2']:null;
        $radio_1_sql='';
        $radio_2_sql='';
        if ($radio_1) {
            if ($radio_1=='1') {
                $radio_1_sql .= "  and orderhenkan.datachar02 IN ('U110','U111','U120','U121','U123','U150','U180','U181')";
            }elseif ($radio_1=='2') {
                $radio_1_sql .= "  and orderhenkan.datachar02 IN ('U110','U111','U121','U150','U180','U181')";
            }elseif ($radio_1=='3') {
                $radio_1_sql .= "  and orderhenkan.datachar02 IN ('U120','U123')";
            }elseif ($radio_1=='4') {
                $radio_1_sql .= "  and orderhenkan.datachar02 IN ('U121')";
            }
        }
        if ($radio_2) {
            if ($radio_2=='1') {
                $radio_2_sql .= "  and misyukko_modified_temp.sumed_se <> 0";
            }elseif ($radio_2=='2') {
                $radio_2_sql .= "  and misyukko_modified_temp.sumed_se <> 0";
            }elseif ($radio_2=='3') {
                $radio_2_sql .= "  and misyukko_modified_temp.sumed_se <> 0";
            }elseif ($radio_2=='4') {
                $radio_2_sql .= "  and misyukko_modified_temp.sumed_se <> 0";
            }
        }

        $datatxt0003_sql ='';
        if ($req_division_start != '' && $req_division_end != '' && ($req_division_start != $req_division_end)) {

            $datatxt0003_sql .= " and substring(orderhenkan.datatxt0003::text,1,2)='B9' AND right(orderhenkan.datatxt0003::text,2) between '$req_division_start' and  '$req_division_end' ";
        } else {

            $datatxt0003_sql .= "  and substring(orderhenkan.datatxt0003::text,1,2)='B9' AND right(orderhenkan.datatxt0003::text,2) = '$req_division_start'";
        }

        $datatxt0004_sql='';
        if ($req_department_start != '' && $req_department_end != '' && ($req_department_start != $req_department_end)) {

            $datatxt0004_sql .= "  and substring(orderhenkan.datatxt0004::text,1,2)='C1' AND right(orderhenkan.datatxt0004::text,3) between '$req_department_start' and '$req_department_end'";
        } else if ($req_department_start != '') {

            $datatxt0004_sql .= "  and substring(orderhenkan.datatxt0004::text,1,2)='C1' AND right(orderhenkan.datatxt0004::text,3) = '$req_department_start'";
        }
        $datatxt0005_sql='';
        if ($req_t_group_start != '' && $req_t_group_end != '' && ($req_t_group_start != $req_t_group_end)) {

            $datatxt0005_sql .= "  and substring(orderhenkan.datatxt0005::text,1,2)='C2' AND right(orderhenkan.datatxt0005::text ,4) between '$req_t_group_start' and '$req_t_group_end'";
        } else if ($req_t_group_start != '') {

            $datatxt0005_sql .= "  and substring(orderhenkan.datatxt0005::text,1,2)='C2' AND right(orderhenkan.datatxt0005::text ,4) = '$req_t_group_start'";
        }

        $time_sql='';
        if ($salesDate_start == $salesDate_end) {
            $time_sql .= "  and substring(CAST(orderhenkan.intorder03 as text),1,6)  = '$salesDate_start'";
        } elseif ($salesDate_start < $salesDate_end) {
            $time_sql .= "  and  substring(CAST(orderhenkan.intorder03 as text),1,6) between '$salesDate_start' and '$salesDate_end'";
        }

        $billing_address_sql='';
        if ($req_billing_address) {
            $billing_address_sql .= "  and substring(tuhanorder.information1::text,1,8) = '$req_billing_address' ";
        }

        $datachar05_sql='';
        if ($datachar05) {
            $datachar05_sql .= "  and orderhenkan.datachar05 = '$datachar05'";

        }

        QueryHelper::runQuery("DROP TABLE IF EXISTS misyukko_temp");
        QueryHelper::runQuery("DROP TABLE IF EXISTS misyukko_modified_temp");
        QueryHelper::runQuery("DROP TABLE IF EXISTS after_backorder_temp");
        QueryHelper::runQuery("DROP TABLE IF EXISTS misyukko_tantoname_temp");

         QueryHelper::runQuery("CREATE TEMPORARY TABLE misyukko_tantoname_temp as
            select distinct

                  tantousya.name as assigned_name,
                  misyukko.syouhinid as orderid,
                  misyukko.orderbango as orderbango

                  from misyukko

                  left join tantousya
                  on tantousya.bango=misyukko.datachar02

                  where misyukko.dataint02=1

            ");

        QueryHelper::runQuery("CREATE TEMPORARY TABLE misyukko_temp as
         select
         misyukko_tantoname_temp.assigned_name as assigned_name,
         orderhenkan.kokyakuorderbango,
         misyukko.orderbango,
         misyukko.syouhinid,
         CASE
          WHEN $radio_2 ='1' THEN (misyukko.dataint04*misyukko.syukkasu-misyukko.dataint05*misyukko.syukkasu-misyukko.dataint06*misyukko.syukkasu-misyukko.dataint07*misyukko.syukkasu-misyukko.dataint08*misyukko.syukkasu)
          WHEN $radio_2 ='2' THEN (misyukko.dataint05*misyukko.syukkasu)
          WHEN $radio_2 ='3' THEN (misyukko.dataint06*misyukko.syukkasu)
          WHEN $radio_2 ='4' THEN (misyukko.dataint07*misyukko.syukkasu) END as se


        from orderhenkan

        inner join misyukko
        on misyukko.syouhinid=orderhenkan.kokyakuorderbango
        and misyukko.orderbango =orderhenkan.bango

        inner join misyukko_tantoname_temp
        on misyukko_tantoname_temp.orderid=orderhenkan.kokyakuorderbango
        and misyukko_tantoname_temp.orderbango =orderhenkan.bango

        inner join tuhanorder
        on tuhanorder.juchubango=orderhenkan.kokyakuorderbango
        and tuhanorder.orderbango =orderhenkan.bango

        where
        misyukko.yoteimeter <> 2 and
        CASE WHEN orderhenkan.datachar02 = 'U110' OR orderhenkan.datachar02 = 'U111' OR orderhenkan.datachar02 = 'U150' OR orderhenkan.datachar02 = 'U180' OR orderhenkan.datachar02 = 'U181' THEN misyukko.datachar13 IN ('1')
        ELSE
          misyukko.datachar13 IN ('1','3')
        END

        order by orderhenkan.kokyakuorderbango desc");
//dd(QueryHelper::fetchResult('select * from misyukko_temp'));
        QueryHelper::runQuery("CREATE TEMPORARY TABLE misyukko_modified_temp as
         select distinct
         --misyukko_temp.datachar13,
         misyukko_temp.assigned_name,
         misyukko_temp.kokyakuorderbango,
         misyukko_temp.orderbango,
         misyukko_temp.syouhinid,
         SUM(misyukko_temp.se) as sumed_se

         from misyukko_temp

         group by misyukko_temp.assigned_name,
         misyukko_temp.kokyakuorderbango,
         misyukko_temp.orderbango,
         misyukko_temp.syouhinid
        ");

        //dd(QueryHelper::fetchResult('select * from misyukko_modified_temp'));
        //dd(QueryHelper::fetchResult('select * from misyukko_temp order by kokyakuorderbango desc'));


        QueryHelper::runQuery("DROP TABLE IF EXISTS v_orderhenkan_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE v_orderhenkan_temp as
                select distinct
                orderhenkan.*,
                tuhanorder.kessaihouhou,
                tuhanorder.chumonsyajouhou,
                tuhanorder.soufusakijouhou,
                tuhanorder.otodoketime,
                v_orderinfo.R15 as juchukubun1,
                tuhanorder.juchubango,
                tuhanorder.information1,
                tuhanorder.information2,
                tuhanorder.information3,
                tuhanorder.information8,
                tuhanorder.information7,
                tuhanorder.money10,
                tuhanorder.housoukubun

                from (select distinct
                       kokyakuorderbango, max(ordertypebango2) as maxval
                       from orderhenkan
                       where orderhenkan.synchroorderbango = '0' AND datachar10 IS NULL  group by
                       kokyakuorderbango) as orderhenkan_m

                JOIN v_orderhenkan AS orderhenkan
                ON orderhenkan.kokyakuorderbango = orderhenkan_m.kokyakuorderbango
                AND orderhenkan.ordertypebango2 = orderhenkan_m.maxval

                join v_orderinfo
                on v_orderinfo.bango=orderhenkan.bango

                inner join hikiatesyukko
                on hikiatesyukko.syouhinid=orderhenkan.kokyakuorderbango
                and hikiatesyukko.orderbango =orderhenkan.bango

                join tuhanorder
                on tuhanorder.juchubango=orderhenkan.kokyakuorderbango
                and tuhanorder.orderbango =orderhenkan.bango



                where  hikiatesyukko.datachar04 = '2' $datatxt0003_sql $datatxt0004_sql $datatxt0005_sql $radio_1_sql  $time_sql $billing_address_sql $datachar05_sql
                ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS before_backorder_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE before_backorder_temp as
                select distinct
                v_orderhenkan_temp.*,
                v_torihikisaki_1.R17_4 as information1_detail_show,
                v_torihikisaki_2.R17_4 as information2_detail_show,
                v_torihikisaki_3.R17_4 as information3_detail_show

                from v_orderhenkan_temp

                join v_torihikisaki as v_torihikisaki_1
                on v_torihikisaki_1.torihikisaki_cd=v_orderhenkan_temp.information1
                join v_torihikisaki as v_torihikisaki_2
                on v_torihikisaki_2.torihikisaki_cd=v_orderhenkan_temp.information2
                join v_torihikisaki as v_torihikisaki_3
                on v_torihikisaki_3.torihikisaki_cd=v_orderhenkan_temp.information3

                ");


        //dd(QueryHelper::fetchResult('select * from before_backorder_temp'));
        QueryHelper::runQuery("CREATE TEMPORARY TABLE after_backorder_temp as
         select distinct
         before_backorder_temp.bango as primary_bango,
         before_backorder_temp.kokyakuorderbango as order_id,
         before_backorder_temp.information1_detail_show,
         before_backorder_temp.information2_detail_show,
         before_backorder_temp.information3_detail_show,
         before_backorder_temp.datachar05 as created_user,
         CASE
           WHEN $radio_2='2' THEN substring(REPLACE(misyukko_modified_temp.assigned_name,' ',''), 1, 3)
           WHEN $radio_2='3' THEN '研究所'
           WHEN $radio_2='4' THEN '出荷C'
           WHEN $radio_2='1' THEN substring(REPLACE(before_backorder_temp.name,' ',''), 1, 3)

         END as created_username,
         CASE
           WHEN $radio_2='2' THEN misyukko_modified_temp.assigned_name
           WHEN $radio_2='3' THEN '研究所'
           WHEN $radio_2='4' THEN '出荷C'
           WHEN $radio_2='1' THEN before_backorder_temp.name

         END as created_username_xls,
         before_backorder_temp.information1,
         before_backorder_temp.juchukubun1,
         before_backorder_temp.date,
         concat_ws('/',substring(CAST(before_backorder_temp.intorder05 as text),1,4),substring(CAST(before_backorder_temp.intorder05 as text),5,2),substring(CAST(before_backorder_temp.intorder05 as text),7,2)) as intorder05,
         concat_ws('/',substring(CAST(before_backorder_temp.intorder01 as text),1,4),substring(CAST(before_backorder_temp.intorder01 as text),5,2),substring(CAST(before_backorder_temp.intorder01 as text),7,2)) as intorder01,
         concat_ws('/',substring(CAST(before_backorder_temp.intorder02 as text),1,4),substring(CAST(before_backorder_temp.intorder02 as text),5,2),substring(CAST(before_backorder_temp.intorder02 as text),7,2)) as intorder02,
         concat_ws('/',substring(CAST(before_backorder_temp.intorder03 as text),1,4),substring(CAST(before_backorder_temp.intorder03 as text),5,2),substring(CAST(before_backorder_temp.intorder03 as text),7,2)) as intorder03,
         concat_ws('/',substring(CAST(before_backorder_temp.intorder04 as text),1,4),substring(CAST(before_backorder_temp.intorder04 as text),5,2),substring(CAST(before_backorder_temp.intorder04 as text),7,2)) as intorder04,
         to_char(before_backorder_temp.money10,'FM99,999,999,999,999') as money10,
         before_backorder_temp.money10::bigint as before_modified_money10,
         --substring(CAST(before_backorder_temp.intorder03 as text),1,6) as before_modify_intorder03,
         before_backorder_temp.intorder03 as sortkey,
         before_backorder_temp.intorder01 as before_modified_intorder01,
         before_backorder_temp.intorder02 as before_modified_intorder02,
         before_backorder_temp.intorder03 as before_modified_intorder03,
         before_backorder_temp.intorder04 as before_modified_intorder04,
         before_backorder_temp.intorder05 as before_modified_intorder05,
         before_backorder_temp.information3,
         before_backorder_temp.information2,
         before_backorder_temp.datachar02 as orderhenkan_datachar02,
         before_backorder_temp.datatxt0003 as datatxt0003,
         before_backorder_temp.datatxt0004 as datatxt0004,
         before_backorder_temp.datatxt0005 as datatxt0005,
         CASE
         WHEN length(before_backorder_temp.information7) > 11
            THEN LEFT(before_backorder_temp.information7,10)||'...'
            ELSE before_backorder_temp.information7 END as information7,
            CASE
         WHEN length(before_backorder_temp.information8) > 11
            THEN LEFT(before_backorder_temp.information8,10)||'...'
            ELSE before_backorder_temp.information8 END as information8,

         before_backorder_temp.datachar08 as orderhenkan_data08,
         CASE
         WHEN length((c1.category2 || ' ' || c1.category4)) > 11
            THEN LEFT((c1.category2 || ' ' || c1.category4),11)||'...'
            ELSE (c1.category2 || ' ' || c1.category4) END as cat_1,
         CASE
         WHEN length((c2.category2 || ' ' || c2.category4)) > 11
            THEN LEFT((c2.category2 || ' ' || c2.category4),11)||'...'
            ELSE (c2.category2 || ' ' || c2.category4) END as cat_2,
         CASE
         WHEN length((c3.category2 || ' ' || c3.category4)) > 11
            THEN LEFT((c3.category2 || ' ' || c3.category4),11)||'...'
            ELSE (c3.category2 || ' ' || c3.category4) END as cat_3,
         CASE
         WHEN length((c4.category2 || ' ' || c4.category4)) > 11
            THEN LEFT((c4.category2 || ' ' || c4.category4),11)||'...'
            ELSE (c4.category2 || ' ' || c4.category4) END as cat_4,

         request.syouhinbango || ' ' || request.jouhou as housoukubun,
         to_char(cast(misyukko_modified_temp.sumed_se as bigint),'FM99,999,999,999,999')  as moneymax,
         to_char(cast(misyukko_modified_temp.sumed_se as bigint),'FM99,999,999,999,999')  as s0,
         to_char(cast(misyukko_modified_temp.sumed_se as bigint),'FM99,999,999,999,999')  as s1,
         to_char(cast(misyukko_modified_temp.sumed_se as bigint),'FM99,999,999,999,999')  as s2,
         to_char(cast(misyukko_modified_temp.sumed_se as bigint),'FM99,999,999,999,999')  as s3,
         cast(misyukko_modified_temp.sumed_se as bigint) as before_modified_moneymax,
         cast(misyukko_modified_temp.sumed_se as bigint) as before_modified_s0,
         cast(misyukko_modified_temp.sumed_se as bigint) as before_modified_s1,
         cast(misyukko_modified_temp.sumed_se as bigint) as before_modified_s2,
         cast(misyukko_modified_temp.sumed_se as bigint) as before_modified_s3,
         CASE
          WHEN length(split_part(soukonyuko.datachar09,'_'||before_backorder_temp.kokyakuorderbango,1)) > 11 THEN LEFT(split_part(soukonyuko.datachar09,'¶',1),10)||'...'||split_part(soukonyuko.datachar09,'.',2)
          ELSE split_part(soukonyuko.datachar09,'¶',1)||'.'||split_part(soukonyuko.datachar09,'.',2) END as information9

        from before_backorder_temp

        join misyukko_modified_temp
        on misyukko_modified_temp.syouhinid=before_backorder_temp.kokyakuorderbango
        and misyukko_modified_temp.orderbango =before_backorder_temp.bango

        left join soukonyuko
        on soukonyuko.datachar01=before_backorder_temp.datachar08
        and soukonyuko.orderbango =before_backorder_temp.bango

        left join request
        on before_backorder_temp.housoukubun = cast(request.syouhinbango as text)
        and request.color='0209即時区分'


        left join categorykanri as c1
        on c1.category1='A9'
        and c1.category2=substring(before_backorder_temp.kessaihouhou,3,2)

        left join categorykanri as c2
        on c2.category1='U2'
        and c2.category2=substring(before_backorder_temp.chumonsyajouhou,3,1)

        left join categorykanri as c3
        on c3.category1='U3'
        and c3.category2=substring(before_backorder_temp.soufusakijouhou,3,1)

        left join categorykanri as c4
        on c4.category1='B1'
        and c4.category2=substring(before_backorder_temp.otodoketime,3,2)

        where before_backorder_temp.synchroorderbango = '0' $radio_2_sql order by sortkey asc");

//        dd(QueryHelper::fetchResult('select * from after_backorder_temp'));

        $search_sql= DB::table('after_backorder_temp')->toSql();

        return $search_sql;

    }

}
