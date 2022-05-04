<?php


namespace App\AllClass\sales\customerLedger;


use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class AllCustomerLedger
{
    public static function readData($bango,$allRequest){
//dd($allRequest);
        if(!empty($allRequest['start_date'])){
            //date modify for 2-2 search
            $start_date2_2 = (int)str_replace('/','',$allRequest['start_date']);
//            dd($start_date2_2);
            //date modify for 2-1 search
            $presentMonth=explode('/',$allRequest['start_date']);
            $m=$presentMonth[1]-1;
            if (strlen($m)==1){
                $m='0'.$m;
            }
            if ($presentMonth[1]==1){
                $req_start_date=$presentMonth[0]-1 . '-' . '12' /*. '-' . '01'*/;
            }
            else{
                $req_start_date=(int)$presentMonth[0] . '-' .$m/*. '-' . '01'*/;
            }
//            dd($req_start_date);
        }else{
            $req_start_date = null;
            $start_date2_2='190001';
        }
//        dd($req_start_date);
        if(!empty($allRequest['end_date'])){
            //date modify for 2-2 search
            $systemDate = (int)static::getCurrentTime();
            $end_date2_2  = (int)str_replace('/','',$allRequest['end_date']);
            if ($systemDate<$end_date2_2){
                $end_date2_2 =$systemDate;
            }
//            dd($systemDate,$end_date2_2);

        }else{
            $end_date2_2 ='190001';
        }
        /*$start_date2_2=202101;
        $end_date2_2=202102;*/

        if(!empty($allRequest['customerLedgerSupplier_db'])){
            $req_billing_address = $allRequest['customerLedgerSupplier_db'];
        }else{
            $req_billing_address = null;
        }

        $modify_req_start_date=str_replace('-','/',$req_start_date).'/01';
        $last_billing_dates_before=[];
        $last_billing_dates=[];
        $datanum0026_val_Arr=[];

        $extra_row_condition=QueryHelper::fetchSingleResult("
               SELECT DISTINCT
             tuhanorder.information2,
             CASE
               WHEN substring(others2.other1,1,1)='1' THEN  substring(haisoujouhou.datatxt0051,1,1)
               WHEN substring(others2.other1,1,1)='2' THEN  substring(others2.other17,1,1)
               END AS flag1,
             substr(tuhanorder.information2, 1,8)  AS foregin_key

             FROM tuhanorder

                 LEFT JOIN kokyaku1
                 ON substring(tuhanorder.information2,1,6) = kokyaku1.yobi12
                 AND kokyaku1.denpyosaiban = 0

                 LEFT JOIN haisoujouhou
                 ON kokyaku1.bango=haisoujouhou.syukei1

                 LEFT JOIN haisou
                 ON substring(tuhanorder.information2,7,2) = haisou.torihikisakibango
                 AND haisou.kounyusu = 0
                 AND haisou.shikibetsucode = substring(tuhanorder.information2,1,6)

                 LEFT JOIN others2
                 ON others2.otherint1=haisou.bango

                 WHERE  substring(tuhanorder.information2,1,8) = '$req_billing_address'
                 ");

//dd($req_billing_address,$req_start_date,$start_date2_2,$end_date2_2);

        /*-------------s2-1 data show(carry data)-------------*/

        $fetchUrikakezandakaResult=QueryHelper::fetchResult("select
                                            urikakezandaka.date0008,
                                            CAST (urikakezandaka.datanum0032 AS bigint),
                                            CAST (urikakezandaka.datanum0026 AS bigint)
                                            FROM urikakezandaka
                                            Where substring(CAST(urikakezandaka.date0008 AS text),1,7) = '$req_start_date'
                                            AND urikakezandaka.datatxt0138 = '$req_billing_address' limit 1");
//        dd($fetchUrikakezandakaResult,$req_start_date);
        QueryHelper::runQuery("DROP TABLE IF EXISTS urikakezandaka_customerLedger_temp");
        if (count($fetchUrikakezandakaResult)==1){
            $datanum0032_val=$fetchUrikakezandakaResult[0]->datanum0032;
//            $datanum0026_val=$fetchUrikakezandakaResult[0]->datanum0026;
            QueryHelper::runQuery("CREATE TEMPORARY TABLE urikakezandaka_customerLedger_temp AS
         SELECT DISTINCT
         Replace(substring(cast (date_trunc('month', urikakezandaka.date0008::timestamp) + interval '1 month' - interval '1 day' as text),1,10),'-','/')  AS s1date0008_s2intorder03_s3torikomidate,
         NULL AS s1_s2searched1_s3,
         NULL AS s1_s2kaiinid_s3shinkurokokyakuname,
         NULL AS s1_s2syouhinsyu_s3shinkurokokyakugroup,
         '前回繰越額' AS s1_s2syouhinname_s3searched2,
         NULL AS s1_s2syukkasu_s3,
         NULL AS s1_s2dataint04_s3chumondate,
         NULL AS s1_s2dataint04_s3chumondate_show,
         NULL AS s1_s2dataint04_s3chumondate_xls,
         NULL AS s1_s2searched3_s3_show,
         NULL::bigint AS s1_s2searched3_s3,
         NULL::bigint AS s1_s2searched3_s3_xls,
         NULL AS s1_s2searched4_s3_show,
         NULL::bigint AS s1_s2searched4_s3,
         NULL::bigint AS s1_s2searched4_s3_xls,
         NULL AS s1_s2_s3nyukingaku_show,
         NULL::bigint AS s1_s2_s3nyukingaku,
         NULL::bigint AS s1_s2_s3nyukingaku_xls,
         cast (to_char(cast(urikakezandaka.datanum0032  AS bigint),'FM99,999,999,999,999') AS text)AS s1datanum0032_s2_s3,
         NULL AS s1datanum0032_s2_s3_xls,
         NULL AS s1_s2syouhinid_s3syouhinid,
         NULL AS s1_s2syouhinsyu_s3syouhinsyu,
         NULL AS s1_s2datachar08_s3toiawasebango,
         NULL AS s1_s2R17_4_1_s3R17_4_1,
         NULL AS s1_s2R17_4_2_s3R17_4_2,
         NULL AS classification,
         NULL AS user_name
        FROM urikakezandaka
        WHERE
        substring(CAST(urikakezandaka.date0008 AS text),1,7) = '$req_start_date' AND urikakezandaka.datatxt0138 = '$req_billing_address' limit 1");
        }
        else{
            $datanum0032_val=0;
//            $datanum0026_val=0;
            QueryHelper::runQuery("CREATE TEMPORARY TABLE urikakezandaka_customerLedger_temp AS
         SELECT DISTINCT
         '-' AS s1date0008_s2intorder03_s3torikomidate,
         --'$modify_req_start_date' AS  s1date0008_s2intorder03_s3torikomidate,
         NULL AS s1_s2searched1_s3,
         NULL AS s1_s2kaiinid_s3shinkurokokyakuname,
         NULL AS s1_s2syouhinsyu_s3shinkurokokyakugroup,
         '前回繰越額' AS s1_s2syouhinname_s3searched2,
         NULL AS s1_s2syukkasu_s3,
         NULL AS s1_s2dataint04_s3chumondate,
         NULL AS s1_s2dataint04_s3chumondate_show,
         NULL AS s1_s2dataint04_s3chumondate_xls,
         NULL AS s1_s2searched3_s3_show,
         NULL::bigint AS s1_s2searched3_s3,
         NULL::bigint AS s1_s2searched3_s3_xls,
         NULL AS s1_s2searched4_s3_show,
         NULL::bigint AS s1_s2searched4_s3,
         NULL::bigint AS s1_s2searched4_s3_xls,
         NULL AS s1_s2_s3nyukingaku_show,
         NULL::bigint AS s1_s2_s3nyukingaku,
         NULL::bigint AS s1_s2_s3nyukingaku_xls,
         '0' AS s1datanum0032_s2_s3,
         '0' AS s1datanum0032_s2_s3_xls,
         NULL AS s1_s2syouhinid_s3syouhinid,
         NULL AS s1_s2syouhinsyu_s3syouhinsyu,
         NULL AS s1_s2datachar08_s3toiawasebango,
         NULL AS s1_s2R17_4_1_s3R17_4_1,
         NULL AS s1_s2R17_4_2_s3R17_4_2,
         NULL AS classification,
         NULL AS user_name
        FROM urikakezandaka
        ");
        }

//        dd(QueryHelper::fetchResult('select * from urikakezandaka_customerLedger_temp'),$req_start_date,$req_billing_address);


        /*-------------s2-2 data show(sales data)-------------*/

        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_m");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_m AS
        SELECT DISTINCT
        kokyakuorderbango, max(ordertypebango2) as maxval
        FROM orderhenkan
        WHERE synchroorderbango =0
        AND substring(CAST (intorder03 AS text),1,6) between '$start_date2_2' AND '$end_date2_2'
        --WHERE kokyakuorderbango='0151000028'
        GROUP BY kokyakuorderbango
        --order by kokyakuorderbango ASC ");
        //dd(QueryHelper::fetchResult("select datachar21 from syukkoold as syukkoold_t where syukkoold_t.kaiinid='0950000566'  and syukkoold_t.syouhinsyu='1' and syukkoold_t.datachar21 IS NOT NULL"));

        QueryHelper::runQuery("DROP TABLE IF EXISTS syukkoold_customerLedger_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE syukkoold_customerLedger_temp AS
        SELECT
        syukkoold.orderbango,
        syukkoold.kaiinid,
        syukkoold.syouhinsyu,
        syukkoold.hantei,
        syukkoold.yoteimeter,
        syukkoold.syouhinname,
        syukkoold.syukkasu,
        syukkoold.dataint04,
        syukkoold.datachar20,
        syukkoold.syouhinid,
        syukkoold.datachar08,
        syukkoold.dataint02,
        syukkoold.datachar21,
        cast (COALESCE(syukkoold.syukkasu,0) * COALESCE(syukkoold.dataint04,0)  AS bigint) as sub_ex,
        
        ((select COALESCE(sum(sold.datachar20::int),0 ) from syukkoold as sold where sold.kaiinid=syukkoold.kaiinid and sold.syouhinsyu=syukkoold.syouhinsyu and sold.hantei=0 group by sold.kaiinid,sold.syouhinsyu) - (select COALESCE((select sum(sold.datachar20::int) from syukkoold as sold where  sold.datachar13='3'  and sold.kaiinid=syukkoold.kaiinid and sold.hantei<>0 and sold.syouhinsyu=syukkoold.syouhinsyu group by sold.kaiinid,sold.syouhinsyu),0))) as datachar20_2,

        ((select datachar21 from syukkoold as syukkoold_t where syukkoold_t.kaiinid=syukkoold.kaiinid and syukkoold_t.syouhinsyu=syukkoold.syouhinsyu and syukkoold_t.datachar21 IS NOT NULL limit 1) IS NOT NULL) as boss,
        CASE
            
            WHEN ((select datachar21 from syukkoold as syukkoold_t where syukkoold_t.kaiinid=syukkoold.kaiinid and syukkoold_t.syouhinsyu=syukkoold.syouhinsyu and syukkoold_t.datachar21 IS  NULL  limit 1) IS  NULL) = 't' 
                THEN (select distinct on (syukkoold.kaiinid) cast(COALESCE(syukkoold1.datachar19::int,0) AS bigint)
                      from syukkoold as syukkoold1
                      where syukkoold1.kaiinid = syukkoold.kaiinid
                      and syukkoold1.syouhinsyu = syukkoold.syouhinsyu
                      and syukkoold1.hantei='0')
                 - (select distinct on (syukkoold.kaiinid) COALESCE(SUM(cast (COALESCE(syukkoold2.datachar19::int,0)  AS bigint)),0)
                    from syukkoold as syukkoold2
                    where syukkoold2.kaiinid = syukkoold.kaiinid
                    and syukkoold2.syouhinsyu = syukkoold.syouhinsyu
                    and syukkoold2.datachar13 IN ('3'))
            ELSE cast (COALESCE(syukkoold.syukkasu,0) * COALESCE(syukkoold.dataint04,0)  AS bigint)
        END as sub


        FROM syukkoold

       
        ");
      // dd(QueryHelper::fetchResult("select * from syukkoold_customerLedger_temp where kaiinid='0951006793'"));
       $consumption_tax_cal_by_kaiinid_2_3=QueryHelper::fetchResult("(select kaiinid,SUM(syukkoold.datachar20::bigint)  from syukkoold   where (datachar13 = '3') and hantei <> '0' group by kaiinid)");
       $consumption_tax_cal_by_kaiinid=QueryHelper::fetchResult("(select kaiinid,SUM(syukkoold.datachar20::bigint)  from syukkoold where hantei <> '0'   group by kaiinid)");
       
       $consumption_arr=[];
       $consumption_arr_2_3=[];
       foreach ($consumption_tax_cal_by_kaiinid_2_3 as $key => $value) {
           $consumption_arr_2_3[$value->kaiinid]=$value->sum;
       }
       foreach ($consumption_tax_cal_by_kaiinid as $key => $value) {
           $consumption_arr[$value->kaiinid]=$value->sum;
       }
      
        QueryHelper::runQuery("DROP TABLE IF EXISTS others2_customerLedger_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE others2_customerLedger_temp as
               SELECT DISTINCT
             tuhanorder.information2,
             CASE
               WHEN substring(others2.other1,1,1)='1' THEN  substring(haisoujouhou.datatxt0051,1,1)
               WHEN substring(others2.other1,1,1)='2' THEN  substring(others2.other17,1,1)
               END AS flag1,
             substr(tuhanorder.information2, 1,8)  AS foregin_key

             FROM tuhanorder

                 LEFT JOIN kokyaku1
                 ON substring(tuhanorder.information2,1,6) = kokyaku1.yobi12
                 AND kokyaku1.denpyosaiban = 0

                 LEFT JOIN haisoujouhou
                 ON kokyaku1.bango=haisoujouhou.syukei1

                 LEFT JOIN haisou
                 ON substring(tuhanorder.information2,7,2) = haisou.torihikisakibango
                 AND haisou.kounyusu = 0
                 AND haisou.shikibetsucode = substring(tuhanorder.information2,1,6)

                 LEFT JOIN others2
                 ON others2.otherint1=haisou.bango

                 ");
//        dd(QueryHelper::fetchResult('select * from others2_customerLedger_temp'));
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_customerLedger_temp_before");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_customerLedger_temp_before AS
        SELECT DISTINCT
            cast (concat_ws('/',SUBSTRING (CAST(orderhenkan.intorder03 as text),1,4),SUBSTRING (CAST(orderhenkan.intorder03 AS text),5,2),SUBSTRING (CAST(orderhenkan.intorder03 AS text),7,2)) AS text) AS s1date0008_s2intorder03_s3torikomidate,
            --to_char(orderhenkan.intorder03,'YYYYMMDD') as torikomidate_order,
            CONCAT (categorykanriData.category2, ' ', categorykanriData.category4) AS s1_s2searched1_s3,
            syukkoold_customerLedger_temp.kaiinid AS s1_s2kaiinid_s3shinkurokokyakuname,
            syukkoold_customerLedger_temp.syouhinsyu::text AS s1_s2syouhinsyu_s3shinkurokokyakugroup,
            others2_customerLedger_temp.flag1 as flag1,
            tuhanorder.orderbango,
            tuhanorder.numeric3,
            tuhanorder.numeric4,
           CASE
             WHEN LENGTH (syukkoold_customerLedger_temp.syouhinname) > 11
                THEN cast (LEFT(syukkoold_customerLedger_temp.syouhinname,10)||'...' AS text)
                ELSE cast ((syukkoold_customerLedger_temp.syouhinname) AS text) END AS s1_s2syouhinname_s3searched2,
            cast (syukkoold_customerLedger_temp.syukkasu AS text) AS s1_s2syukkasu_s3,
            cast (to_char(CAST (ROUND(case when tuhanorder.text1='U523' then syukkoold_customerLedger_temp.sub_ex else syukkoold_customerLedger_temp.sub end/syukkoold_customerLedger_temp.syukkasu)  AS bigint),'FM99,999,999,999,999') AS text ) AS s1_s2dataint04_s3chumondate_show,
            cast (CAST (ROUND(case when tuhanorder.text1='U523' then syukkoold_customerLedger_temp.sub_ex else syukkoold_customerLedger_temp.sub end/syukkoold_customerLedger_temp.syukkasu)  AS bigint) AS text ) AS s1_s2dataint04_s3chumondate_xls,
            cast (ROUND(case when tuhanorder.text1='U523' then syukkoold_customerLedger_temp.sub_ex else syukkoold_customerLedger_temp.sub end/syukkoold_customerLedger_temp.syukkasu)  AS text ) AS s1_s2dataint04_s3chumondate,
            cast (to_char(CAST (case when tuhanorder.text1='U523' then syukkoold_customerLedger_temp.sub_ex else syukkoold_customerLedger_temp.sub end  AS bigint),'FM99,999,999,999') AS text) AS s1_s2searched3_s3_show,
            cast (case when tuhanorder.text1='U523' then syukkoold_customerLedger_temp.sub_ex else syukkoold_customerLedger_temp.sub end  AS bigint) AS s1_s2searched3_s3,
            cast (case when tuhanorder.text1='U523' then syukkoold_customerLedger_temp.sub_ex else syukkoold_customerLedger_temp.sub end  AS bigint) AS s1_s2searched3_s3_xls,
            CASE
                WHEN CAST (others2_customerLedger_temp.flag1 AS INT ) =1
                    THEN cast (to_char(CAST (tuhanorder.numeric4  AS bigint),'FM99,999,999,999,999') AS text)
                WHEN CAST (others2_customerLedger_temp.flag1 AS INT ) =2
                    THEN CAST (to_char(CAST (syukkoold_customerLedger_temp.datachar20_2  AS bigint),'FM99,999,999,999,999') AS text)
                WHEN CAST (others2_customerLedger_temp.flag1 AS INT ) =3
                    THEN null
                ELSE null
            END AS s1_s2searched4_s3_show,
            CASE
                WHEN CAST (others2_customerLedger_temp.flag1 AS INT ) =1
                    THEN CAST (tuhanorder.numeric4  AS bigint)
                WHEN CAST (others2_customerLedger_temp.flag1 AS INT ) =2
                    THEN CAST (syukkoold_customerLedger_temp.datachar20_2  AS bigint)
                WHEN CAST (others2_customerLedger_temp.flag1 AS INT ) =3
                    THEN NULL
                ELSE null
            END AS s1_s2searched4_s3,
            CASE
                WHEN CAST (others2_customerLedger_temp.flag1 AS INT ) =1
                    THEN CAST (tuhanorder.numeric4  AS bigint)
                WHEN CAST (others2_customerLedger_temp.flag1 AS INT ) =2
                    THEN CAST (syukkoold_customerLedger_temp.datachar20_2  AS bigint)
                WHEN CAST (others2_customerLedger_temp.flag1 AS INT ) =3
                    THEN NULL
                ELSE null
            END AS s1_s2searched4_s3_xls,
            NULL AS s1_s2_s3nyukingaku_show,
            '0'::bigint AS s1_s2_s3nyukingaku,
            NULL::bigint AS s1_s2_s3nyukingaku_xls,
            NULL AS s1datanum0032_s2_s3,
            NULL AS s1datanum0032_s2_s3_xls,
            cast (syukkoold_customerLedger_temp.syouhinid AS text) AS s1_s2syouhinid_s3syouhinid,
            cast (syukkoold_customerLedger_temp.syouhinsyu AS text) AS s1_s2syouhinsyu_s3syouhinsyu,
            cast (syukkoold_customerLedger_temp.datachar08 AS text) AS s1_s2datachar08_s3toiawasebango,
            categorykanri1.category2 AS classification,
            tuhanorder.information1,
            tuhanorder.information3,
            CONCAT(tantousya.bango, ' ', tantousya.name) AS user_name

            FROM orderhenkan

            LEFT JOIN tantousya ON tantousya.bango = orderhenkan.datachar05
            LEFT JOIN categorykanri AS categorykanri1  ON categorykanri1.category1 = 'C1'
            AND concat(categorykanri1.category1,categorykanri1.category2) = tantousya.datatxt0004
            LEFT JOIN syukkoold_customerLedger_temp ON syukkoold_customerLedger_temp.orderbango = orderhenkan.bango

            LEFT JOIN orderhenkan_m ON
            orderhenkan_m.kokyakuorderbango=orderhenkan.kokyakuorderbango
            AND orderhenkan_m.maxval=orderhenkan.ordertypebango2

            JOIN tuhanorder
            ON tuhanorder.juchubango=orderhenkan.kokyakuorderbango
            AND tuhanorder.orderbango =orderhenkan.bango
            AND tuhanorder.juchubango = syukkoold_customerLedger_temp.syouhinid
            AND tuhanorder.juchukubun2 = syukkoold_customerLedger_temp.kaiinid

            LEFT JOIN categorykanri AS categorykanriData
            ON tuhanorder.text1 = concat(categorykanriData.category1,categorykanriData.category2)

            LEFT JOIN  others2_customerLedger_temp
            ON others2_customerLedger_temp.foregin_key= SUBSTRING (tuhanorder.information2,1,8)
            
            LEFT JOIN urikakezandaka
            on urikakezandaka.datatxt0138= SUBSTRING(tuhanorder.information2,1,8) 

            WHERE syukkoold_customerLedger_temp.hantei = 0
            AND syukkoold_customerLedger_temp.yoteimeter = 0
            AND  categorykanriData.category1 = 'U5'
            AND tuhanorder.unsoudaibikitesuryou = 1
            AND tuhanorder.text1 NOT IN ('U522', 'U560')
            AND SUBSTRING (tuhanorder.information2,1,8) = '$req_billing_address'
            AND CAST (SUBSTRING (orderhenkan.intorder03::text,1,6) AS INTEGER )
            BETWEEN '$start_date2_2' AND '$end_date2_2'");
        $data_for_uriage_json= QueryHelper::fetchResult('select * from orderhenkan_customerLedger_temp_before');
  
        foreach ($data_for_uriage_json as $key => $value) {
            $uriage_id=$value->s1_s2kaiinid_s3shinkurokokyakuname;
            $line=$value->s1_s2syouhinsyu_s3shinkurokokyakugroup;

            if ($value->flag1=='1' AND $value->s1_s2syouhinsyu_s3shinkurokokyakugroup=='1') {
                try{
                  
                  $val_tax=isset($consumption_arr_2_3[$value->s1_s2kaiinid_s3shinkurokokyakuname]) ? $consumption_arr_2_3[$value->s1_s2kaiinid_s3shinkurokokyakuname] : 0;
                }catch(Exception $ex){
                  $val_tax=0;
                }
                $with_comma = number_format($value->numeric4 - $val_tax);

                $without_comma = $value->numeric4 - $val_tax;
              

              QueryHelper::runQuery("update orderhenkan_customerLedger_temp_before set s1_s2searched4_s3_show='$with_comma', s1_s2searched4_s3='$without_comma', s1_s2searched4_s3_xls='$without_comma'  where s1_s2kaiinid_s3shinkurokokyakuname='$uriage_id' AND s1_s2syouhinsyu_s3shinkurokokyakugroup='$line'");
            }elseif($value->flag1=='1' AND $value->s1_s2syouhinsyu_s3shinkurokokyakugroup!='1'){
              QueryHelper::runQuery("update orderhenkan_customerLedger_temp_before set s1_s2searched4_s3_show=NULL, s1_s2searched4_s3=NULL, s1_s2searched4_s3_xls=NULL where s1_s2kaiinid_s3shinkurokokyakuname='$uriage_id' AND s1_s2syouhinsyu_s3shinkurokokyakugroup='$line'");
            }

            if ($value->flag1=='2') {
                
            
                /*$tax_branch_wise= (QueryHelper::fetchSingleResult("select MAX(syukkoold.datachar20::bigint)  from syukkoold  where kaiinid='$value->s1_s2kaiinid_s3shinkurokokyakuname' and hantei='0' and syouhinsyu='$line'  group by kaiinid ")->max??0) - (QueryHelper::fetchSingleResult("select SUM(syukkoold.datachar20::bigint)  from syukkoold  where kaiinid='$value->s1_s2kaiinid_s3shinkurokokyakuname' AND syouhinsyu='$value->s1_s2syouhinsyu_s3shinkurokokyakugroup' AND (datachar13 = '2' OR datachar13 = '3') and hantei <> '0' group by kaiinid ")->sum??0);
                $with_comma_2 = number_format($tax_branch_wise);
                $without_comma_2 = $tax_branch_wise;*/
                
                $val_1=$value->s1_s2searched4_s3_show??0;
                $val_2=$value->s1_s2searched4_s3??0;
                $val_3=$value->s1_s2searched4_s3_xls??0;
                QueryHelper::runQuery("update orderhenkan_customerLedger_temp_before set s1_s2searched4_s3_show='$val_1', s1_s2searched4_s3='$val_2', s1_s2searched4_s3_xls='$val_3'  where s1_s2kaiinid_s3shinkurokokyakuname='$uriage_id' AND s1_s2syouhinsyu_s3shinkurokokyakugroup='$line'");
            }
           
        }
 //dd(QueryHelper::fetchResult('select * from orderhenkan_customerLedger_temp_before'));
        QueryHelper::runQuery("DROP TABLE IF EXISTS v_torihikisaki_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE v_torihikisaki_temp AS
        SELECT DISTINCT ON (v_torihikisaki.torihikisaki_cd)
            v_torihikisaki.torihikisaki_cd,
            v_torihikisaki.R17_4

            FROM v_torihikisaki
            ");
//        dd(QueryHelper::fetchResult("select * from v_torihikisaki_temp"));
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_customerLedger_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_customerLedger_temp AS
        SELECT
            orderhenkan_customerLedger_temp_before.*,
            cast (v_torihikisaki_temp_1.R17_4 AS text) AS s1_s2R17_4_1_s3R17_4_1,
            cast (v_torihikisaki_temp_3.R17_4 AS text) AS s1_s2R17_4_2_s3R17_4_2

            FROM orderhenkan_customerLedger_temp_before

            LEFT JOIN v_torihikisaki_temp AS v_torihikisaki_temp_1
            ON v_torihikisaki_temp_1.torihikisaki_cd=orderhenkan_customerLedger_temp_before.information1
            LEFT JOIN v_torihikisaki_temp AS v_torihikisaki_temp_3
            ON v_torihikisaki_temp_3.torihikisaki_cd=orderhenkan_customerLedger_temp_before.information3
            ");
 //dd(QueryHelper::fetchResult('select * from orderhenkan_customerLedger_temp'));
        /*dd(QueryHelper::fetchResult('select * from v_torihikisaki'));*/
//        dd(QueryHelper::fetchResult('select * from orderhenkan_customerLedger_temp'),$extra_row_condition->flag1);

        if (!empty($extra_row_condition)){
            if ($extra_row_condition->flag1=='3'){
                $fetch_sales_billing_dates=QueryHelper::fetchResult('select
                                                                 --substring (REPLACE(s1date0008_s2intorder03_s3torikomidate,\'/\',\'\'),1,6) as sales_date
                                                                 substring (s1date0008_s2intorder03_s3torikomidate,1,7) as sales_date
                                                                 from orderhenkan_customerLedger_temp
                                                                 group by substring (s1date0008_s2intorder03_s3torikomidate,1,7)');
                foreach ($fetch_sales_billing_dates as $fetch_sales_billing_date){
                    if (!in_array($fetch_sales_billing_date->sales_date,$last_billing_dates_before)){
                        $lastDate=static::getLastDate($fetch_sales_billing_date->sales_date);
                        array_push($last_billing_dates,$lastDate);
                        array_push($last_billing_dates_before,$fetch_sales_billing_date->sales_date);
                        $modify_last_date=substr(str_replace("/", "-", $lastDate),0,7);
                        $fetchUrikakezandakadataDatanum0026=QueryHelper::fetchResult("select
                                                                                urikakezandaka.datanum0026
                                                                                FROM urikakezandaka
                                                                                Where substring(CAST(urikakezandaka.date0008 AS text),1,7) = '$modify_last_date'
                                                                                AND urikakezandaka.datatxt0138 = '$req_billing_address' limit 1");
                        if (count($fetchUrikakezandakadataDatanum0026)>0){
                            if ($fetchUrikakezandakadataDatanum0026[0]->datanum0026==null){
                                array_push($datanum0026_val_Arr,0);
                            }
                            else{
                                array_push($datanum0026_val_Arr,$fetchUrikakezandakadataDatanum0026[0]->datanum0026);
                            }
                        }
                        else{
                            array_push($datanum0026_val_Arr,0);
                        }
//                dd($fetchUrikakezandakadataDatanum0026,$modify_last_date,$req_billing_address);
                    }
                }
            }
        }
//        dd($fetch_sales_billing_dates,$last_billing_dates);
        /*---------------s2-3 data show(deposit data)--------------*/
 
        $search_sql = " where  
         case when daikinseisanold_cl_sum.otodoketime::text <> '0000000000' 
            then (substring(orderhenkan.intorder05::text,1,6) between '$start_date2_2' and '$end_date2_2'  and tuhanorder.information2 like '$req_billing_address%' and daikinseisan.dataint01 = 0 and daikinseisan.chumonsyaname like '$req_billing_address%')
        else (substring(to_char(daikinseisan.torikomidate,'YYYYMMDD'),1,6) between '$start_date2_2' and '$end_date2_2'  and daikinseisan.dataint01 = 0 and daikinseisan.chumonsyaname like '$req_billing_address%' )
         end
        ";
        //dd($search_sql,$start_date2_2,$end_date2_2);
        QueryHelper::runQuery("DROP TABLE IF EXISTS daikinseisanold_cl_sum");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE daikinseisanold_cl_sum AS
        SELECT distinct daikinseisanold.shinkurokokyakuname,
               --daikinseisanold.shinkurokokyakugroup,
                SUM(daikinseisanold.nyukingaku) AS nyukingaku ,
                daikinseisanold.otodoketime,
                daikinseisan.soufusakiname
                
                FROM daikinseisanold

                 join daikinseisan 
                 on daikinseisan.shinkurokokyakuname=daikinseisanold.shinkurokokyakuname
                 and daikinseisan.shinkurokokyakugroup=daikinseisanold.shinkurokokyakugroup

                 GROUP BY daikinseisanold.shinkurokokyakuname,daikinseisanold.otodoketime,daikinseisan.soufusakiname");
        //dd(QueryHelper::fetchResult("select * from daikinseisanold_cl_sum "));
        QueryHelper::runQuery("DROP TABLE IF EXISTS all_customer_ledger_payment ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_customer_ledger_payment  as
        select distinct
        case 
          when daikinseisanold_cl_sum.otodoketime <>'0000000000' THEN
           concat_ws('/',substring(CAST(MAX(orderhenkan.intorder05) as text),1,4),substring(CAST(MAX(orderhenkan.intorder05) as text),5,2),substring(CAST(MAX(orderhenkan.intorder05) as text),7,2))
           ELSE
           cast (concat_ws('/',SUBSTRING (max(to_char(daikinseisan.torikomidate,'YYYYMMDD')),1,4),SUBSTRING (max(to_char(daikinseisan.torikomidate,'YYYYMMDD')),5,2),SUBSTRING (max(to_char(daikinseisan.torikomidate,'YYYYMMDD')),7,2)) AS text) END AS s1date0008_s2intorder03_s3torikomidate,
        max(to_char(daikinseisan.torikomidate,'YYYYMMDD')) as torikomidate_order,
        '入金' as s1_s2searched1_s3,
        daikinseisanold_cl_sum.shinkurokokyakuname as  s1_s2kaiinid_s3shinkurokokyakuname,
        --MAX(daikinseisan.shinkurokokyakubango) as shinkurokokyakubango,
        MAX(daikinseisan.shinkurokokyakugroup) as s1_s2syouhinsyu_s3syouhinsyu,
        NULL as s1_s2syouhinsyu_s3shinkurokokyakugroup,
        daikinseisan.soufusakiname,
        daikinseisanold_cl_sum.otodoketime as dOtodoketime,
        max(concat (categorykanri.category2,' ',categorykanri.category4)) as s1_s2syouhinname_s3searched2,
        '' as s1_s2syukkasu_s3,
        max(to_char(daikinseisan.chumondate,'YYYY/MM/DD')) as s1_s2dataint04_s3chumondate,
        max(to_char(daikinseisan.chumondate,'YYYY/MM/DD')) as s1_s2dataint04_s3chumondate_show,
        max(to_char(daikinseisan.chumondate,'YYYY/MM/DD')) as s1_s2dataint04_s3chumondate_xls,
        NULL AS s1_s2searched3_s3_show,
        '0'::bigint AS s1_s2searched3_s3,
        
        NULL::bigint AS s1_s2searched3_s3_xls,
        NULL AS s1_s2searched4_s3_show,
        '0'::bigint AS s1_s2searched4_s3,
        NULL::bigint AS s1_s2searched4_s3_xls,
        daikinseisanold_cl_sum.nyukingaku as s1_s2_s3nyukingaku,
        null as s1datanum0032_s2_s3,
        null as s1datanum0032_s2_s3_xls,
        CASE
            WHEN daikinseisanold_cl_sum.otodoketime<>'0000000000' THEN  daikinseisanold_cl_sum.otodoketime
            WHEN daikinseisanold_cl_sum.otodoketime='0000000000' THEN  null
            END AS s1_s2syouhinid_s3syouhinid,
       
        --CASE
        --    WHEN daikinseisanold_cl_sum.otodoketime<>'0000000000' THEN  max(syukkoold.syouhinsyu)::text
        --    WHEN daikinseisanold_cl_sum.otodoketime='0000000000' THEN  null
        --    END AS s1_s2syouhinsyu_s3syouhinsyu,
        CASE
            WHEN daikinseisanold_cl_sum.otodoketime<>'0000000000' THEN  max(daikinseisan.toiawasebango)
            WHEN daikinseisanold_cl_sum.otodoketime='0000000000' THEN  null
            END AS s1_s2datachar08_s3toiawasebango,
        CASE
            WHEN daikinseisanold_cl_sum.otodoketime<>'0000000000' THEN  max(v_torihikisaki.r17_4)
            WHEN daikinseisanold_cl_sum.otodoketime='0000000000' THEN  null
            END AS s1_s2r17_4_1_s3r17_4_1,
        CASE
            WHEN daikinseisanold_cl_sum.otodoketime<>'0000000000' THEN  max(v_torihikisaki.r17_4)
            WHEN daikinseisanold_cl_sum.otodoketime='0000000000' THEN  null
            END AS s1_s2r17_4_2_s3r17_4_2,
        null as classification,
        null as user_name
        from daikinseisan
        join  daikinseisanold_cl_sum 
        on daikinseisanold_cl_sum.shinkurokokyakuname = daikinseisan.shinkurokokyakuname
        --and daikinseisanold_cl_sum.shinkurokokyakugroup = daikinseisan.shinkurokokyakugroup
        AND (daikinseisanold_cl_sum.soufusakiname = daikinseisan.soufusakiname
       
        or daikinseisanold_cl_sum.otodoketime = '0000000000')

        left join orderhenkan on  orderhenkan.datachar10 = daikinseisanold_cl_sum.otodoketime
        
        left join syukkoold on  syukkoold.orderbango = orderhenkan.bango
        left join tuhanorder on tuhanorder.orderbango = orderhenkan.bango
        left join categorykanri  on categorykanri.category1 = 'A9' and concat(categorykanri.category1,categorykanri.category2) = daikinseisan.soufusakiname
        left join v_torihikisaki on v_torihikisaki.torihikisaki_cd = tuhanorder.information1
        left join v_torihikisaki as v_torihikisaki2 on v_torihikisaki2.torihikisaki_cd = tuhanorder.information3
        
        $search_sql
        
        group by daikinseisan.soufusakiname,daikinseisanold_cl_sum.shinkurokokyakuname,daikinseisanold_cl_sum.otodoketime,daikinseisanold_cl_sum.nyukingaku");

    //dd(QueryHelper::fetchResult("select * from all_customer_ledger_payment"));
        QueryHelper::runQuery("DROP TABLE IF EXISTS all_customer_ledger_payment_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_customer_ledger_payment_temp  as
        select
        s1date0008_s2intorder03_s3torikomidate,
        --torikomidate_order,
        s1_s2searched1_s3,
        s1_s2kaiinid_s3shinkurokokyakuname,
        s1_s2syouhinsyu_s3shinkurokokyakugroup,
        dOtodoketime,
        s1_s2syouhinname_s3searched2,
        s1_s2syukkasu_s3,
        s1_s2dataint04_s3chumondate,
        s1_s2dataint04_s3chumondate_show,
        s1_s2dataint04_s3chumondate_xls,
        s1_s2searched3_s3_show,
        s1_s2searched3_s3,
        s1_s2searched3_s3_xls,
        s1_s2searched4_s3_show,
        s1_s2searched4_s3,
        s1_s2searched4_s3_xls,
        cast (to_char(s1_s2_s3nyukingaku,'FM99,999,999,999,999') as text) as deposit_amount,
        cast (to_char(s1_s2_s3nyukingaku,'FM99,999,999,999,999') AS text) AS s1_s2_s3nyukingaku_show,
        cast (s1_s2_s3nyukingaku AS bigint) AS s1_s2_s3nyukingaku,
        cast (s1_s2_s3nyukingaku AS bigint) AS s1_s2_s3nyukingaku_xls,
        s1datanum0032_s2_s3,
        s1datanum0032_s2_s3_xls,
        s1_s2syouhinid_s3syouhinid,
        s1_s2syouhinsyu_s3syouhinsyu,
        s1_s2datachar08_s3toiawasebango,
        s1_s2r17_4_1_s3r17_4_1,
        s1_s2r17_4_2_s3r17_4_2,
        classification,
        user_name
        from all_customer_ledger_payment
    
         ");
       //dd(QueryHelper::fetchResult("select*from all_customer_ledger_payment_temp"));

        if (!empty($extra_row_condition)){
            if ($extra_row_condition->flag1=='3'){
                $fetch_payment_billing_dates=QueryHelper::fetchResult('select
                                                                 --substring (REPLACE(s1date0008_s2intorder03_s3torikomidate,\'/\',\'\'),1,6) as sales_date
                                                                 substring (s1date0008_s2intorder03_s3torikomidate,1,7) as sales_date
                                                                 from all_customer_ledger_payment_temp
                                                                 group by substring (s1date0008_s2intorder03_s3torikomidate,1,7)');
                foreach ($fetch_payment_billing_dates as $fetch_payment_billing_date){
                    if (!in_array($fetch_payment_billing_date->sales_date,$last_billing_dates_before)){
                        $lastDate=static::getLastDate($fetch_payment_billing_date->sales_date);
                        array_push($last_billing_dates,$lastDate);
                        array_push($last_billing_dates_before,$fetch_payment_billing_date->sales_date);
                        $modify_last_date=substr(str_replace("/", "-", $lastDate),0,7);
                        $fetchUrikakezandakadataDatanum0026=QueryHelper::fetchResult("select
                                                                                urikakezandaka.datanum0026
                                                                                FROM urikakezandaka
                                                                                Where substring(CAST(urikakezandaka.date0008 AS text),1,7) = '$modify_last_date'
                                                                                AND urikakezandaka.datatxt0138 = '$req_billing_address' limit 1");
                        if (count($fetchUrikakezandakadataDatanum0026)>0){
                            if ($fetchUrikakezandakadataDatanum0026[0]->datanum0026==null){
                                array_push($datanum0026_val_Arr,0);
                            }
                            else{
                                array_push($datanum0026_val_Arr,$fetchUrikakezandakadataDatanum0026[0]->datanum0026);
                            }
                        }
                        else{
                            array_push($datanum0026_val_Arr,0);
                        }
                    }
                }
            }
        }
        //dd(QueryHelper::fetchResult('select * from orderhenkan_customerLedger_temp'));
//        dd($fetch_sales_billing_dates,$fetch_payment_billing_dates,$last_billing_dates_before,$last_billing_dates,$datanum0026_val_Arr);
        $merge_key = "s1date0008_s2intorder03_s3torikomidate,s1_s2searched1_s3,s1_s2kaiinid_s3shinkurokokyakuname,s1_s2syouhinsyu_s3shinkurokokyakugroup,s1_s2syouhinname_s3searched2,s1_s2syukkasu_s3,s1_s2dataint04_s3chumondate,s1_s2dataint04_s3chumondate_show,
                      s1_s2dataint04_s3chumondate_xls,s1_s2searched3_s3_show,s1_s2searched3_s3,s1_s2searched3_s3_xls,s1_s2searched4_s3_show,s1_s2searched4_s3,s1_s2searched4_s3_xls,s1_s2_s3nyukingaku_show,s1_s2_s3nyukingaku,s1_s2_s3nyukingaku_xls,
                      s1datanum0032_s2_s3,s1datanum0032_s2_s3_xls,s1_s2syouhinid_s3syouhinid,s1_s2syouhinsyu_s3syouhinsyu,s1_s2datachar08_s3toiawasebango,s1_s2r17_4_1_s3r17_4_1,s1_s2r17_4_2_s3r17_4_2,classification,user_name";
        QueryHelper::runQuery("DROP TABLE IF EXISTS all_customer_ledger_merge_temp_before ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_customer_ledger_merge_temp_before  as
        select $merge_key from urikakezandaka_customerLedger_temp
        union
        select $merge_key from orderhenkan_customerLedger_temp
        union
        select $merge_key from all_customer_ledger_payment_temp
        order by s1date0008_s2intorder03_s3torikomidate,s1_s2searched1_s3,s1_s2kaiinid_s3shinkurokokyakuname,s1_s2syouhinsyu_s3shinkurokokyakugroup");
//        dd($last_billing_dates_before,$last_billing_dates,$datanum0026_val_Arr);
        /*---------------creating extra row--------------*/
//dd(QueryHelper::fetchResult('select * from all_customer_ledger_merge_temp_before'));
        if (!empty($extra_row_condition)){
            if ($extra_row_condition->flag1=='3'){
                foreach ($last_billing_dates as $key=>$last_billing_date){
           // dd($last_billing_date);
                    if($datanum0026_val_Arr[$key] != 0)
                    {
                        QueryHelper::runQuery("DROP TABLE IF EXISTS urikakezandaka_last_billing_temp");
                        QueryHelper::runQuery("CREATE TEMPORARY TABLE urikakezandaka_last_billing_temp AS
                SELECT DISTINCT
                 '$last_billing_date' AS s1date0008_s2intorder03_s3torikomidate,
                NULL AS s1_s2searched1_s3,
                NULL AS s1_s2kaiinid_s3shinkurokokyakuname,
                NULL AS s1_s2syouhinsyu_s3shinkurokokyakugroup,
                '消費税額' AS s1_s2syouhinname_s3searched2,
                NULL AS s1_s2syukkasu_s3,
                NULL AS s1_s2dataint04_s3chumondate,
                NULL AS s1_s2dataint04_s3chumondate_show,
                NULL AS s1_s2dataint04_s3chumondate_xls,
                NULL AS s1_s2searched3_s3_show,
                NULL::bigint AS s1_s2searched3_s3,
                NULL::bigint AS s1_s2searched3_s3_xls,
                CAST (to_char('$datanum0026_val_Arr[$key]'::bigint ,'FM99,999,999,999,999') AS text) AS s1_s2searched4_s3_show,
                '$datanum0026_val_Arr[$key]'::bigint AS s1_s2searched4_s3,
                '$datanum0026_val_Arr[$key]'::bigint AS s1_s2searched4_s3_xls,
                NULL AS s1_s2_s3nyukingaku_show,
                NULL::bigint AS s1_s2_s3nyukingaku,
                NULL::bigint AS s1_s2_s3nyukingaku_xls,
                NULL AS s1datanum0032_s2_s3,
                NULL AS s1datanum0032_s2_s3_xls,
                NULL AS s1_s2syouhinid_s3syouhinid,
                NULL AS s1_s2syouhinsyu_s3syouhinsyu,
                NULL AS s1_s2datachar08_s3toiawasebango,
                NULL AS s1_s2R17_4_1_s3R17_4_1,
                NULL AS s1_s2R17_4_2_s3R17_4_2,
                NULL AS classification,
                NULL AS user_name
                FROM urikakezandaka");
                        QueryHelper::runQuery("INSERT INTO all_customer_ledger_merge_temp_before SELECT * FROM urikakezandaka_last_billing_temp");
                    }
                }
            }
        }
        //dd(QueryHelper::fetchResult('select * from all_customer_ledger_merge_temp_before'));
        /*---------------balance calculation--------------*/

        QueryHelper::runQuery("DROP TABLE IF EXISTS all_customer_ledger_merge_temp");
        $col_names='s1date0008_s2intorder03_s3torikomidate VARCHAR(50),s1_s2searched1_s3 VARCHAR(50),s1_s2kaiinid_s3shinkurokokyakuname VARCHAR(100), s1_s2syouhinsyu_s3shinkurokokyakugroup VARCHAR(10),s1_s2syouhinname_s3searched2 VARCHAR(50),s1_s2syukkasu_s3 VARCHAR(50),s1_s2dataint04_s3chumondate VARCHAR(50),
                    s1_s2dataint04_s3chumondate_show VARCHAR(100),s1_s2dataint04_s3chumondate_xls VARCHAR(100), s1_s2searched3_s3_show VARCHAR(100), s1_s2searched3_s3 VARCHAR(100),s1_s2searched3_s3_xls VARCHAR(100), s1_s2searched4_s3_show VARCHAR(100), s1_s2searched4_s3 VARCHAR(100), s1_s2searched4_s3_xls VARCHAR(100),
                    s1_s2_s3nyukingaku_show VARCHAR(100), s1_s2_s3nyukingaku VARCHAR(100), s1_s2_s3nyukingaku_xls VARCHAR(100), s1datanum0032_s2_s3 VARCHAR(100), s1datanum0032_s2_s3_xls VARCHAR(100), s1_s2syouhinid_s3syouhinid VARCHAR(50), s1_s2syouhinsyu_s3syouhinsyu VARCHAR(10), s1_s2datachar08_s3toiawasebango VARCHAR(100) , s1_s2R17_4_1_s3R17_4_1 VARCHAR(100),
                    s1_s2R17_4_2_s3R17_4_2 VARCHAR(100), classification VARCHAR(100), user_name VARCHAR(100)';
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_customer_ledger_merge_temp( $col_names )");

//        $fetch_merge_temp_before=QueryHelper::fetchResult("select * from all_customer_ledger_merge_temp_before ");
        QueryHelper::runQuery("DROP TABLE IF EXISTS all_customer_ledger_merge_temp_after");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_customer_ledger_merge_temp_after  as
        select * from all_customer_ledger_merge_temp_before
        order by s1date0008_s2intorder03_s3torikomidate,s1_s2searched1_s3,s1_s2kaiinid_s3shinkurokokyakuname,s1_s2syouhinsyu_s3shinkurokokyakugroup");
        $fetch_merge_temp_before=QueryHelper::fetchResult("select * from all_customer_ledger_merge_temp_after ");
        //dd($fetch_merge_temp_before);
        $pre_s1datanum0032_s2_s3='';
        //dd(QueryHelper::fetchResult('select * from all_customer_ledger_merge_temp_after'));
        if (count($fetch_merge_temp_before)>0){
            foreach ($fetch_merge_temp_before as $key=>$temp_before){
                if ($key==0){
                    QueryHelper::runQuery("INSERT INTO all_customer_ledger_merge_temp SELECT distinct * FROM urikakezandaka_customerLedger_temp");
                }

                elseif ($key==1){
                    $s1date0008_s2intorder03_s3torikomidate=$temp_before->s1date0008_s2intorder03_s3torikomidate;
                    $s1_s2searched1_s3=$temp_before->s1_s2searched1_s3;
                    $s1_s2kaiinid_s3shinkurokokyakuname=$temp_before->s1_s2kaiinid_s3shinkurokokyakuname;
                    $s1_s2syouhinsyu_s3shinkurokokyakugroup=$temp_before->s1_s2syouhinsyu_s3shinkurokokyakugroup;
                    $s1_s2syouhinname_s3searched2=$temp_before->s1_s2syouhinname_s3searched2;
                    $s1_s2syukkasu_s3=$temp_before->s1_s2syukkasu_s3;
                    $s1_s2dataint04_s3chumondate=$temp_before->s1_s2dataint04_s3chumondate;
                    $s1_s2dataint04_s3chumondate_show=$temp_before->s1_s2dataint04_s3chumondate_show;
                    $s1_s2dataint04_s3chumondate_xls=$temp_before->s1_s2dataint04_s3chumondate_xls;
                    $s1_s2searched3_s3_show=$temp_before->s1_s2searched3_s3_show;
                    $s1_s2searched3_s3=$temp_before->s1_s2searched3_s3;
                    $s1_s2searched3_s3_xls=$temp_before->s1_s2searched3_s3_xls;
                    $s1_s2searched4_s3_show=$temp_before->s1_s2searched4_s3_show;
                    $s1_s2searched4_s3=$temp_before->s1_s2searched4_s3;
                    $s1_s2searched4_s3_xls=$temp_before->s1_s2searched4_s3_xls;
                    $s1_s2_s3nyukingaku_show=$temp_before->s1_s2_s3nyukingaku_show;
                    $s1_s2_s3nyukingaku=$temp_before->s1_s2_s3nyukingaku;
                    $s1_s2_s3nyukingaku_xls=$temp_before->s1_s2_s3nyukingaku_xls;
                    $s1datanum0032_s2_s3=((int)$datanum0032_val+(int)$temp_before->s1_s2searched3_s3+(int)$temp_before->s1_s2searched4_s3)-(int)$temp_before->s1_s2_s3nyukingaku;
                    $s1datanum0032_s2_s3_xls=((int)$datanum0032_val+(int)$temp_before->s1_s2searched3_s3+(int)$temp_before->s1_s2searched4_s3)-(int)$temp_before->s1_s2_s3nyukingaku;
                    $pre_s1datanum0032_s2_s3=$s1datanum0032_s2_s3;
                    $s1_s2syouhinid_s3syouhinid=$temp_before->s1_s2syouhinid_s3syouhinid;
                    $s1_s2syouhinsyu_s3syouhinsyu=$temp_before->s1_s2syouhinsyu_s3syouhinsyu;
                    $s1_s2datachar08_s3toiawasebango=$temp_before->s1_s2datachar08_s3toiawasebango;
                    $s1_s2r17_4_1_s3r17_4_1=$temp_before->s1_s2r17_4_1_s3r17_4_1;
                    $s1_s2r17_4_2_s3r17_4_2=$temp_before->s1_s2r17_4_2_s3r17_4_2;
                    $classification=$temp_before->classification;
                    $user_name=$temp_before->user_name;
                    QueryHelper::runQuery("DROP TABLE IF EXISTS all_customer_ledger_merge_temp_calc");
                    QueryHelper::runQuery("CREATE TEMPORARY TABLE all_customer_ledger_merge_temp_calc AS
                     SELECT DISTINCT
                     '$s1date0008_s2intorder03_s3torikomidate' AS s1date0008_s2intorder03_s3torikomidate,
                     '$s1_s2searched1_s3' AS s1_s2searched1_s3,
                     '$s1_s2kaiinid_s3shinkurokokyakuname' AS s1_s2kaiinid_s3shinkurokokyakuname,
                     '$s1_s2syouhinsyu_s3shinkurokokyakugroup' AS s1_s2syouhinsyu_s3shinkurokokyakugroup,
                     '$s1_s2syouhinname_s3searched2' AS s1_s2syouhinname_s3searched2,
                     '$s1_s2syukkasu_s3' AS s1_s2syukkasu_s3,
                     '$s1_s2dataint04_s3chumondate' AS s1_s2dataint04_s3chumondate,
                     '$s1_s2dataint04_s3chumondate_show' AS s1_s2dataint04_s3chumondate_show,
                     '$s1_s2dataint04_s3chumondate_xls' AS s1_s2dataint04_s3chumondate_xls,
                     '$s1_s2searched3_s3_show' AS s1_s2searched3_s3_show,
                     '$s1_s2searched3_s3' AS s1_s2searched3_s3,
                     '$s1_s2searched3_s3_xls' AS s1_s2searched3_s3_xls,
                     '$s1_s2searched4_s3_show' AS s1_s2searched4_s3_show,
                     '$s1_s2searched4_s3' AS s1_s2searched4_s3,
                     '$s1_s2searched4_s3_xls' AS s1_s2searched4_s3_xls,
                     '$s1_s2_s3nyukingaku_show' AS s1_s2_s3nyukingaku_show,
                     '$s1_s2_s3nyukingaku' AS s1_s2_s3nyukingaku,
                     '$s1_s2_s3nyukingaku_xls' AS s1_s2_s3nyukingaku_xls,
                      cast (to_char(CAST ('$s1datanum0032_s2_s3'  AS bigint),'FM99,999,999,999,999') AS text ) AS s1datanum0032_s2_s3,
                     '$s1datanum0032_s2_s3_xls' AS s1datanum0032_s2_s3_xls,
                     '$s1_s2syouhinid_s3syouhinid' AS s1_s2syouhinid_s3syouhinid,
                     '$s1_s2syouhinsyu_s3syouhinsyu' AS s1_s2syouhinsyu_s3syouhinsyu,
                     '$s1_s2datachar08_s3toiawasebango' AS s1_s2datachar08_s3toiawasebango,
                     '$s1_s2r17_4_1_s3r17_4_1' AS s1_s2R17_4_1_s3R17_4_1,
                     '$s1_s2r17_4_2_s3r17_4_2' AS s1_s2R17_4_2_s3R17_4_2,
                     '$classification' AS classification,
                     '$user_name' AS user_name
                    FROM urikakezandaka");
                    QueryHelper::runQuery("INSERT INTO all_customer_ledger_merge_temp SELECT * FROM all_customer_ledger_merge_temp_calc");

                }
                else{
                    $s1date0008_s2intorder03_s3torikomidate=$temp_before->s1date0008_s2intorder03_s3torikomidate;
                    $s1_s2searched1_s3=$temp_before->s1_s2searched1_s3;
                    $s1_s2kaiinid_s3shinkurokokyakuname=$temp_before->s1_s2kaiinid_s3shinkurokokyakuname;
                    $s1_s2syouhinsyu_s3shinkurokokyakugroup=$temp_before->s1_s2syouhinsyu_s3shinkurokokyakugroup;
                    $s1_s2syouhinname_s3searched2=$temp_before->s1_s2syouhinname_s3searched2;
                    $s1_s2syukkasu_s3=$temp_before->s1_s2syukkasu_s3;
                    $s1_s2dataint04_s3chumondate=$temp_before->s1_s2dataint04_s3chumondate;
                    $s1_s2dataint04_s3chumondate_show=$temp_before->s1_s2dataint04_s3chumondate_show;
                    $s1_s2dataint04_s3chumondate_xls=$temp_before->s1_s2dataint04_s3chumondate_xls;
                    $s1_s2searched3_s3_show=$temp_before->s1_s2searched3_s3_show;
                    $s1_s2searched3_s3=$temp_before->s1_s2searched3_s3;
                    $s1_s2searched3_s3_xls=$temp_before->s1_s2searched3_s3_xls;
                    $s1_s2searched4_s3_show=$temp_before->s1_s2searched4_s3_show;
                    $s1_s2searched4_s3=$temp_before->s1_s2searched4_s3;
                    $s1_s2searched4_s3_xls=$temp_before->s1_s2searched4_s3_xls;
                    $s1_s2_s3nyukingaku_show=$temp_before->s1_s2_s3nyukingaku_show;
                    $s1_s2_s3nyukingaku=$temp_before->s1_s2_s3nyukingaku;
                    $s1_s2_s3nyukingaku_xls=$temp_before->s1_s2_s3nyukingaku_xls;
                    $s1datanum0032_s2_s3=((int)$pre_s1datanum0032_s2_s3+(int)$temp_before->s1_s2searched3_s3+(int)$temp_before->s1_s2searched4_s3)-(int)$temp_before->s1_s2_s3nyukingaku;
                    $s1datanum0032_s2_s3_xls=((int)$pre_s1datanum0032_s2_s3+(int)$temp_before->s1_s2searched3_s3+(int)$temp_before->s1_s2searched4_s3)-(int)$temp_before->s1_s2_s3nyukingaku;
                    $pre_s1datanum0032_s2_s3=$s1datanum0032_s2_s3;
                    $s1_s2syouhinid_s3syouhinid=$temp_before->s1_s2syouhinid_s3syouhinid;
                    $s1_s2syouhinsyu_s3syouhinsyu=$temp_before->s1_s2syouhinsyu_s3syouhinsyu;
                    $s1_s2datachar08_s3toiawasebango=$temp_before->s1_s2datachar08_s3toiawasebango;
                    $s1_s2r17_4_1_s3r17_4_1=$temp_before->s1_s2r17_4_1_s3r17_4_1;
                    $s1_s2r17_4_2_s3r17_4_2=$temp_before->s1_s2r17_4_2_s3r17_4_2;
                    $classification=$temp_before->classification;
                    $user_name=$temp_before->user_name;
                    QueryHelper::runQuery("DROP TABLE IF EXISTS all_customer_ledger_merge_temp_calc");
                    QueryHelper::runQuery("CREATE TEMPORARY TABLE all_customer_ledger_merge_temp_calc AS
                     SELECT DISTINCT
                     '$s1date0008_s2intorder03_s3torikomidate' AS s1date0008_s2intorder03_s3torikomidate,
                     '$s1_s2searched1_s3' AS s1_s2searched1_s3,
                     '$s1_s2kaiinid_s3shinkurokokyakuname' AS s1_s2kaiinid_s3shinkurokokyakuname,
                     '$s1_s2syouhinsyu_s3shinkurokokyakugroup' AS s1_s2syouhinsyu_s3shinkurokokyakugroup,
                     '$s1_s2syouhinname_s3searched2' AS s1_s2syouhinname_s3searched2,
                     '$s1_s2syukkasu_s3' AS s1_s2syukkasu_s3,
                     '$s1_s2dataint04_s3chumondate' AS s1_s2dataint04_s3chumondate,
                     '$s1_s2dataint04_s3chumondate_show' AS s1_s2dataint04_s3chumondate_show,
                     '$s1_s2dataint04_s3chumondate_xls' AS s1_s2dataint04_s3chumondate_xls,
                     '$s1_s2searched3_s3_show' AS s1_s2searched3_s3_show,
                     '$s1_s2searched3_s3' AS s1_s2searched3_s3,
                     '$s1_s2searched3_s3_xls' AS s1_s2searched3_s3_xls,
                     '$s1_s2searched4_s3_show' AS s1_s2searched4_s3_show,
                     '$s1_s2searched4_s3' AS s1_s2searched4_s3,
                     '$s1_s2searched4_s3_xls' AS s1_s2searched4_s3_xls,
                     '$s1_s2_s3nyukingaku_show' AS s1_s2_s3nyukingaku_show,
                     '$s1_s2_s3nyukingaku' AS s1_s2_s3nyukingaku,
                     '$s1_s2_s3nyukingaku_xls' AS s1_s2_s3nyukingaku_xls,
                      cast (to_char(CAST ('$s1datanum0032_s2_s3'  AS bigint),'FM99,999,999,999,999') AS text ) AS s1datanum0032_s2_s3,
                     '$s1datanum0032_s2_s3_xls' AS s1datanum0032_s2_s3_xls,
                     '$s1_s2syouhinid_s3syouhinid' AS s1_s2syouhinid_s3syouhinid,
                     '$s1_s2syouhinsyu_s3syouhinsyu' AS s1_s2syouhinsyu_s3syouhinsyu,
                     '$s1_s2datachar08_s3toiawasebango' AS s1_s2datachar08_s3toiawasebango,
                     '$s1_s2r17_4_1_s3r17_4_1' AS s1_s2R17_4_1_s3R17_4_1,
                     '$s1_s2r17_4_2_s3r17_4_2' AS s1_s2R17_4_2_s3R17_4_2,
                     '$classification' AS classification,
                     '$user_name' AS user_name
                    FROM urikakezandaka");
                    QueryHelper::runQuery("INSERT INTO all_customer_ledger_merge_temp SELECT * FROM all_customer_ledger_merge_temp_calc");
                }
            }
        }
        //dd(QueryHelper::fetchResult("select * from all_customer_ledger_merge_temp "));
        $search_sql='select * from all_customer_ledger_merge_temp';
        return $search_sql;
    }

    public static function getCurrentTime()
    {
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        $mytime = str_replace(" ", "", $mytime);
        return substr($mytime,0,6);
    }
    public static function getLastDate($year_month)
    {
        $date=$year_month . '/01';
        return date("Y/m/t", strtotime($date));
    }
}
