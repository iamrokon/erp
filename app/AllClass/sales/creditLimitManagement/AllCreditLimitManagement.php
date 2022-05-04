<?php

namespace App\AllClass\sales\creditLimitManagement;

use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AllCreditLimitManagement
{
    public static function readData($bango, $allRequest)
    {
        //dd($allRequest);

        try {

                if (!empty($allRequest['division_datachar05_start'])) {
                    $req_division_start = substr($allRequest['division_datachar05_start'], 4, 2);
                } else {
                    $req_division_start = null;
                }
                if (!empty($allRequest['division_datachar05_end'])) {
                    $req_division_end = substr($allRequest['division_datachar05_end'], 4, 2);
                } else {
                    $req_division_end = null;
                }

                if (!empty($allRequest['department_datachar05_start'])) {
                    $req_department_start = substr($allRequest['department_datachar05_start'], 4, 3);
                } else {
                    $req_department_start = null;
                }
                if (!empty($allRequest['department_datachar05_end'])) {
                    $req_department_end = substr($allRequest['department_datachar05_end'], 4, 3);
                } else {
                    $req_department_end = null;
                }

                if (!empty($allRequest['group_datachar05_start'])) {
                    $req_t_group_start = substr($allRequest['group_datachar05_start'], 4, 4);
                } else {
                    $req_t_group_start = null;
                }
                if (!empty($allRequest['group_datachar05_end'])) {
                    $req_t_group_end = substr($allRequest['group_datachar05_end'], 4, 4);
                } else {
                    $req_t_group_end = null;
                }

                if (!empty($allRequest['datachar05'])) {
                    $datachar05 = $allRequest['datachar05'];
                } else {
                    $datachar05 = null;
                }

                //dd($req_division_start,$req_division_end,$req_department_start,$req_department_end,$req_t_group_start,$req_t_group_end,$datachar05);

                $condition_sql=" where left(haisoujouhou.syukeituki,1) = '1' ";


                $datachar05_sql = '';
                if ($datachar05) {
                    $datachar05_sql .= "  and haisou.syukeitukikijun = '$datachar05'";

                }


                $datatxt0003_sql = '';
                if ($req_division_start != '' && $req_division_end != '' && ($req_division_start != $req_division_end)) {

                    $datatxt0003_sql .= " and substring(tantousya.datatxt0003::text,1,2)='B9' AND right(tantousya.datatxt0003::text,2) between '$req_division_start' and  '$req_division_end' ";
                } else {

                    $datatxt0003_sql .= "  and substring(tantousya.datatxt0003::text,1,2)='B9' AND right(tantousya.datatxt0003::text,2) = '$req_division_start'";
                }

                $datatxt0004_sql = '';
                if ($req_department_start != '' && $req_department_end != '' && ($req_department_start != $req_department_end)) {

                    $datatxt0004_sql .= "  and substring(tantousya.datatxt0004::text,1,2)='C1' AND right(tantousya.datatxt0004::text,3) between '$req_department_start' and '$req_department_end'";
                } else if ($req_department_start != '') {

                    $datatxt0004_sql .= "  and substring(tantousya.datatxt0004::text,1,2)='C1' AND right(tantousya.datatxt0004::text,3) = '$req_department_start'";
                }

                $datatxt0005_sql = '';
                if ($req_t_group_start != '' && $req_t_group_end != '' && ($req_t_group_start != $req_t_group_end)) {

                    $datatxt0005_sql .= "  and substring(tantousya.datatxt0005::text,1,2)='C2' AND right(tantousya.datatxt0005::text ,4) between '$req_t_group_start' and '$req_t_group_end'";
                } else if ($req_t_group_start != '') {

                    $datatxt0005_sql .= "  and substring(tantousya.datatxt0005::text,1,2)='C2' AND right(tantousya.datatxt0005::text ,4) = '$req_t_group_start'";
                }

                //dd($order_segment_sql ,$time_sql);

                QueryHelper::runQuery("DROP TABLE IF EXISTS v_torihikisaki_temp");
                QueryHelper::runQuery("CREATE TEMPORARY TABLE v_torihikisaki_temp AS
                                        SELECT DISTINCT ON (v_torihikisaki.torihikisaki_cd)
                                            v_torihikisaki.*
                                            FROM v_torihikisaki
                                        --where v_torihikisaki.torihikisaki_cd like '00014301001'
                                            ");
                QueryHelper::runQuery("DROP TABLE IF EXISTS tuhanorder_temp");
                QueryHelper::runQuery("CREATE TEMPORARY TABLE tuhanorder_temp AS SELECT * FROM tuhanorder WHERE tuhanorder.text1 NOT IN ('U523','U560') AND tuhanorder.juchukubun2 IS NOT NULL ");
                QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_temp");
                QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_temp AS SELECT * FROM orderhenkan WHERE orderhenkan.datachar10 IS NOT NULL");
                //dd(QueryHelper::fetchResult("select * from orderhenkan_temp ")/*,date('Ymd')*/);

                /*------------------fetching 2a-----------------*/
                QueryHelper::runQuery("DROP TABLE IF EXISTS seikyuzandaka_datanum0064_temp_before");
                QueryHelper::runQuery("CREATE TEMPORARY TABLE seikyuzandaka_datanum0064_temp_before AS
                select
                REPLACE(substring(CAST(max(seikyuzandaka.date0009) AS text),1,10),'-','')::int as max1a_date0009,
                max(seikyuzandaka.date0009) as date0009,
                left(datatxt0142,6) as datatxt0142,
                sum (datanum0064) as sum1a_datanum0064
                from seikyuzandaka
                where REPLACE(substring(CAST(seikyuzandaka.date0009 AS text),1,10),'-','')::int < replace(CURRENT_DATE::text,'-','')::int
                or REPLACE(substring(CAST(seikyuzandaka.date0009 AS text),1,10),'-','')::int = replace(CURRENT_DATE::text,'-','')::int
                group by left(datatxt0142,6)
                order by datatxt0142
                ");
                QueryHelper::runQuery("DROP TABLE IF EXISTS seikyuzandaka_temp");
                QueryHelper::runQuery("CREATE TEMPORARY TABLE seikyuzandaka_temp AS
                    select distinct on (left(seikyuzandaka.datatxt0142,6))
                    seikyuzandaka.*
                    from seikyuzandaka
                    where REPLACE(substring(CAST(seikyuzandaka.date0009 AS text),1,10),'-','')::int < replace(CURRENT_DATE::text,'-','')::int
                    or REPLACE(substring(CAST(seikyuzandaka.date0009 AS text),1,10),'-','')::int = replace(CURRENT_DATE::text,'-','')::int
                    order by left(seikyuzandaka.datatxt0142,6)
                    ");
//                dd(QueryHelper::fetchResult("select * from seikyuzandaka_temp "));
                QueryHelper::runQuery("DROP TABLE IF EXISTS seikyuzandaka_datanum0064_temp");
                QueryHelper::runQuery("CREATE TEMPORARY TABLE seikyuzandaka_datanum0064_temp AS
                    select
                    seikyuzandaka_datanum0064_temp_before.max1a_date0009,
                    seikyuzandaka_datanum0064_temp_before.datatxt0142,
                    seikyuzandaka_temp.datanum0064,
                    seikyuzandaka_datanum0064_temp_before.sum1a_datanum0064
                    from seikyuzandaka_datanum0064_temp_before
                    left join seikyuzandaka_temp
                    on left(seikyuzandaka_temp.datatxt0142,6) = seikyuzandaka_datanum0064_temp_before.datatxt0142
                    and seikyuzandaka_temp.date0009 = seikyuzandaka_datanum0064_temp_before.date0009
                    order by seikyuzandaka_datanum0064_temp_before.datatxt0142
                    ");
//                dd(QueryHelper::fetchResult("select * from seikyuzandaka_datanum0064_temp "));
                QueryHelper::runQuery("DROP TABLE IF EXISTS daikinseisan_temp01");
                QueryHelper::runQuery("CREATE TEMPORARY TABLE daikinseisan_temp01 AS
                        select
                        daikinseisan.*
                        from daikinseisan
                        left join seikyuzandaka_datanum0064_temp
                        on seikyuzandaka_datanum0064_temp.datatxt0142 = left(daikinseisan.chumonsyaname,6)
                        where REPLACE(substring(CAST(daikinseisan.torikomidate AS text),1,10),'-','')::int > seikyuzandaka_datanum0064_temp.max1a_date0009
                        and daikinseisan.soufusakiname <> 'A907'
                        order by chumonsyaname
                        ");
                //dd(QueryHelper::fetchResult("select * from daikinseisan_temp01 "));
                QueryHelper::runQuery("DROP TABLE IF EXISTS daikinseisan_nyukingaku_temp01");
                QueryHelper::runQuery("CREATE TEMPORARY TABLE daikinseisan_nyukingaku_temp01 AS
                    select
                    left(daikinseisan_temp01.chumonsyaname,6) as chumonsyaname,
                    --REPLACE(substring(CAST(max(daikinseisan.torikomidate) AS text),1,10),'-','')::int as max1a_date0009,
                    sum (nyukingaku) as sum1a_nyukingaku
                    from daikinseisan_temp01
                    group by left(chumonsyaname,6)
                    order by chumonsyaname
                    ");
                //dd(QueryHelper::fetchResult("select * from daikinseisan_nyukingaku_temp01 "),QueryHelper::fetchResult("select * from seikyuzandaka_datanum0064_temp "));

                /*------------------fetching 2b && 2c start-----------------*/

                /*QueryHelper::runQuery("DROP TABLE IF EXISTS urikakezandaka_datanum0033_temp");
                QueryHelper::runQuery("CREATE TEMPORARY TABLE urikakezandaka_datanum0033_temp AS
                    select
                    (REPLACE(substring(CAST(max(urikakezandaka.date0008) AS text),1,8),'-','')||'01')::int as max2a_date0008,
                    left(datatxt0138,6) as datatxt0138,
                    sum (datanum0033) as sum2a_datanum0033
                    from urikakezandaka
                    where REPLACE(substring(CAST(urikakezandaka.date0008 AS text),1,10),'-','')::int < replace(CURRENT_DATE::text,'-','')::int
                    or REPLACE(substring(CAST(urikakezandaka.date0008 AS text),1,10),'-','')::int = replace(CURRENT_DATE::text,'-','')::int
                    group by left(datatxt0138,6)
                    order by datatxt0138
                    ");*/
                QueryHelper::runQuery("DROP TABLE IF EXISTS urikakezandaka_datanum0033_temp_before");
                QueryHelper::runQuery("CREATE TEMPORARY TABLE urikakezandaka_datanum0033_temp_before AS
                        select
                        (REPLACE(substring(CAST(max(urikakezandaka.date0008) AS text),1,8),'-','')||'01')::int as max2a_date0008,
                        max(urikakezandaka.date0008) as date0008,
                        left(datatxt0138,6) as datatxt0138,
                        sum (datanum0033) as sum2a_datanum0033
                        from urikakezandaka
                        where REPLACE(substring(CAST(urikakezandaka.date0008 AS text),1,10),'-','')::int < replace(CURRENT_DATE::text,'-','')::int
                        or REPLACE(substring(CAST(urikakezandaka.date0008 AS text),1,10),'-','')::int = replace(CURRENT_DATE::text,'-','')::int
                        group by left(datatxt0138,6)
                        order by datatxt0138
                        ");
                QueryHelper::runQuery("DROP TABLE IF EXISTS urikakezandaka_temp");
                QueryHelper::runQuery("CREATE TEMPORARY TABLE urikakezandaka_temp AS
                        select distinct on (left(urikakezandaka.datatxt0138,6))
                        urikakezandaka.*
                        from urikakezandaka
                        where REPLACE(substring(CAST(urikakezandaka.date0008 AS text),1,10),'-','')::int < replace(CURRENT_DATE::text,'-','')::int
                        or REPLACE(substring(CAST(urikakezandaka.date0008 AS text),1,10),'-','')::int = replace(CURRENT_DATE::text,'-','')::int
                        order by left(urikakezandaka.datatxt0138,6)
                        ");
                QueryHelper::runQuery("DROP TABLE IF EXISTS urikakezandaka_datanum0033_temp");
                QueryHelper::runQuery("CREATE TEMPORARY TABLE urikakezandaka_datanum0033_temp AS
                        select
                        urikakezandaka_datanum0033_temp_before.max2a_date0008,
                        urikakezandaka_datanum0033_temp_before.datatxt0138,
                        urikakezandaka_temp.datanum0033,
                        urikakezandaka_datanum0033_temp_before.sum2a_datanum0033
                        from urikakezandaka_datanum0033_temp_before
                        left join urikakezandaka_temp
                        on left(urikakezandaka_temp.datatxt0138,6) = urikakezandaka_datanum0033_temp_before.datatxt0138
                        and urikakezandaka_temp.date0008 = urikakezandaka_datanum0033_temp_before.date0008
                        order by urikakezandaka_datanum0033_temp_before.datatxt0138
                        ");
//                dd(QueryHelper::fetchResult("select * from urikakezandaka_datanum0033_temp "));

                /*------------------fetching 2b starts-----------------*/

                QueryHelper::runQuery("DROP TABLE IF EXISTS daikinseisan_temp02b");
                QueryHelper::runQuery("CREATE TEMPORARY TABLE daikinseisan_temp02b AS
                            select
                            daikinseisan.*
                            from daikinseisan
                            left join urikakezandaka_datanum0033_temp
                            on urikakezandaka_datanum0033_temp.datatxt0138 = left(daikinseisan.chumonsyaname,6)
                            where REPLACE(substring(CAST(daikinseisan.torikomidate AS text),1,10),'-','')::int > urikakezandaka_datanum0033_temp.max2a_date0008
                            or REPLACE(substring(CAST(daikinseisan.torikomidate AS text),1,10),'-','')::int = urikakezandaka_datanum0033_temp.max2a_date0008
                            and daikinseisan.soufusakiname = 'A905'
                            order by chumonsyaname
                            ");
                //dd(QueryHelper::fetchResult("select * from daikinseisan_temp02b "));
                QueryHelper::runQuery("DROP TABLE IF EXISTS daikinseisan_nyukingaku_temp02b");
                QueryHelper::runQuery("CREATE TEMPORARY TABLE daikinseisan_nyukingaku_temp02b AS
                        select
                        left(daikinseisan_temp02b.chumonsyaname,6) as chumonsyaname,
                        --REPLACE(substring(CAST(max(daikinseisan.torikomidate) AS text),1,10),'-','')::int as max1a_date0009,
                        sum (nyukingaku) as sum2b_nyukingaku
                        from daikinseisan_temp02b
                        group by left(chumonsyaname,6)
                        order by chumonsyaname
                        ");
                //dd(QueryHelper::fetchResult("select * from daikinseisan_nyukingaku_temp02b "),QueryHelper::fetchResult("select * from urikakezandaka_datanum0033_temp "));

                /*------------------fetching 2b ends-----------------*/

                /*------------------fetching 2c starts-----------------*/

                QueryHelper::runQuery("DROP TABLE IF EXISTS daikinseisan_temp02c");
                QueryHelper::runQuery("CREATE TEMPORARY TABLE daikinseisan_temp02c AS
                                select
                                daikinseisan.*
                                from daikinseisan
                                left join urikakezandaka_datanum0033_temp
                                on urikakezandaka_datanum0033_temp.datatxt0138 = left(daikinseisan.chumonsyaname,6)
                                where REPLACE(substring(CAST(daikinseisan.torikomidate AS text),1,10),'-','')::int > urikakezandaka_datanum0033_temp.max2a_date0008
                                or REPLACE(substring(CAST(daikinseisan.torikomidate AS text),1,10),'-','')::int = urikakezandaka_datanum0033_temp.max2a_date0008
                                and daikinseisan.soufusakiname = 'A907'
                                order by chumonsyaname
                                ");
                //dd(QueryHelper::fetchResult("select * from daikinseisan_temp02c "));
                QueryHelper::runQuery("DROP TABLE IF EXISTS daikinseisan_nyukingaku_temp02c");
                QueryHelper::runQuery("CREATE TEMPORARY TABLE daikinseisan_nyukingaku_temp02c AS
                            select
                            left(daikinseisan_temp02c.chumonsyaname,6) as chumonsyaname,
                            --REPLACE(substring(CAST(max(daikinseisan.torikomidate) AS text),1,10),'-','')::int as max1a_date0009,
                            sum (nyukingaku) as sum2c_nyukingaku
                            from daikinseisan_temp02c
                            group by left(chumonsyaname,6)
                            order by chumonsyaname
                            ");

                /*------------------fetching 2c ends-----------------*/

                /*------------------fetching 2b && 2c end-----------------*/


                QueryHelper::runQuery("DROP TABLE IF EXISTS haisou_temp");
                QueryHelper::runQuery("CREATE TEMPORARY TABLE haisou_temp AS
                    select distinct on (tantousya.datatxt0005,haisou.shikibetsucode,tantousya.bango,orderhenkan.kokyakuorderbango)
                    haisou.shikibetsucode,
                    haisou.torihikisakibango,
                    haisou.syukeitukikijun,
                    haisoujouhou.syukeituki,
                    kokyaku1.yobi12,
                    left(categorykanri_2.patternsub2::text,2)::int as tax_rate,
                    --(date_trunc('month', current_date - interval '1' month))::date as date_from,
                    --(current_date)::date as date_from_new,
                    --REPLACE(CAST((date_trunc('month', current_date - interval '1' month))::date AS text),'-','')::int as date_from_int,
                    --REPLACE(CAST((current_date)::date AS text),'-','')::int as date_from_int_new,
                    --(date_trunc('month', now()) + interval '2 month - 1 day')::date as date_to,
                    --(date_trunc('month', now()) + interval '3 month - 1 day')::date as date_to_new,
                    --REPLACE(CAST((date_trunc('month', now()) + interval '2 month - 1 day')::date AS text),'-','')::int as date_to_int,
                    --REPLACE(CAST((date_trunc('month', now()) + interval '3 month - 1 day')::date AS text),'-','')::int as date_to_int_new,
                    --orderhenkan.intorder03,
                    --tuhanorder.money10,
                    --hikiatesyukko.datachar04,
                    --seikyuzandaka_datanum0064_temp.sum1a_datanum0064,
                    --daikinseisan_nyukingaku_temp01.sum1a_nyukingaku,
                    right (tantousya.datatxt0005,6) as datatxt0005,
                    left(tuhanorder.information2,6) as information2,
                    tuhanorder.juchubango,
                    right (tantousya.datatxt0005,6) as tantousya_datatxt0005_group,
                    CONCAT(tantousya.bango, ' ', tantousya.name) as manager,
                    --kokyaku1.address as sales_billing_destination,
                    v_torihikisaki_temp2.r20cd as sales_billing_destination,
                    to_char(kokyaku1.denpyostart,'FM99,999,999,999,999') as clm_credit_limits,
                    case
                        when (orderhenkan.intorder03 > seikyuzandaka_datanum0064_temp.max1a_date0009)
                        then to_char((COALESCE(seikyuzandaka_datanum0064_temp.datanum0064::bigint,0) + COALESCE(tuhanorder.numeric3::bigint,0) + COALESCE(tuhanorder.numeric4::bigint,0)) - (COALESCE(daikinseisan_nyukingaku_temp01.sum1a_nyukingaku::bigint,0)),'FM99,999,999,999,999')
                        else null end as clm_total_amounts,
                    --null as clm_total_amounts,
                    case
                        when ((COALESCE(urikakezandaka_datanum0033_temp.datatxt0138::bigint,0) + COALESCE(daikinseisan_nyukingaku_temp02b.sum2b_nyukingaku::bigint,0)) - (COALESCE(daikinseisan_nyukingaku_temp02c.sum2c_nyukingaku::bigint,0))!=0)
                        then to_char((COALESCE(urikakezandaka_datanum0033_temp.datatxt0138::bigint,0) + COALESCE(daikinseisan_nyukingaku_temp02b.sum2b_nyukingaku::bigint,0)) - (COALESCE(daikinseisan_nyukingaku_temp02c.sum2c_nyukingaku::bigint,0)),'FM99,999,999,999,999')
                        else null end as clm_maintenance_schedule,
                    --null as clm_maintenance_schedule,
                    case
                        when (((orderhenkan.datachar02 = 'U120') or (orderhenkan.datachar02 = 'U122'))
                        and (hikiatesyukko.datachar04='2')
                        and (orderhenkan.intorder03 between REPLACE(CAST((current_date)::date AS text),'-','')::int AND REPLACE(CAST((date_trunc('month', now()) + interval '3 month - 1 day')::date AS text),'-','')::int))
                        --)
                        then to_char(round(((COALESCE(tuhanorder.money10::bigint,0) * COALESCE(left(categorykanri_2.patternsub2::text,2)::int,0)) / 100)),'FM99,999,999,999,999')
                        else null end as clm_note_remaining_schedule,
                    --null as clm_note_remaining_schedule,
                    case
                        when ((orderhenkan.datachar02 = 'U110')
                        and (hikiatesyukko.datachar04='2')
                        and (orderhenkan.intorder03 between REPLACE(CAST((current_date)::date AS text),'-','')::int AND REPLACE(CAST((date_trunc('month', now()) + interval '3 month - 1 day')::date AS text),'-','')::int))
                        --)
                        then to_char(round(((COALESCE(tuhanorder.money10::bigint,0) * COALESCE(left(categorykanri_2.patternsub2::text,2)::int,0)) / 100)),'FM99,999,999,999,999')
                        else null end as clm_scheduled_balance,
                    --null as clm_scheduled_balance,
                    orderhenkan.kokyakuorderbango as order_no,
                    --null as  contractor,
                    v_torihikisaki_temp.r16 as contractor,
                    null as clm_order_amount,
                    concat_ws('/',substring(CAST(orderhenkan.intorder03 as text),1,4),substring(CAST(orderhenkan.intorder03 as text),5,2),substring(CAST(orderhenkan.intorder03 as text),7,2)) as clm_sales_schedule

                    from haisou
                    left join seikyuzandaka_datanum0064_temp
                    on seikyuzandaka_datanum0064_temp.datatxt0142 = haisou.shikibetsucode
                    left join daikinseisan_nyukingaku_temp01
                    on daikinseisan_nyukingaku_temp01.chumonsyaname = haisou.shikibetsucode
                    left join urikakezandaka_datanum0033_temp
                    on urikakezandaka_datanum0033_temp.datatxt0138 = haisou.shikibetsucode
                    left join daikinseisan_nyukingaku_temp02b
                    on daikinseisan_nyukingaku_temp02b.chumonsyaname = haisou.shikibetsucode
                    left join daikinseisan_nyukingaku_temp02c
                    on daikinseisan_nyukingaku_temp02c.chumonsyaname = haisou.shikibetsucode
                    left join kokyaku1 on kokyaku1.yobi12 = haisou.shikibetsucode
                    left join haisoujouhou on haisoujouhou.syukei1 = kokyaku1.bango
                    left join others2 on others2.otherint1 = haisou.bango
                    left join tantousya on tantousya.bango = haisou.syukeitukikijun
                    left join categorykanri as categorykanri_2
                    on case when substring(others2.other1,1,1) = '1'
                    then categorykanri_2.category1||categorykanri_2.category2 =  kokyaku1.mail_toiawase_mb
                    when substring(others2.other1,1,1) ='2'
                    then categorykanri_2.category1||categorykanri_2.category2 = others2.other16 END
                    join tuhanorder_temp as tuhanorder
                    on left(tuhanorder.information2,6) = haisou.shikibetsucode
                    join orderhenkan_temp as orderhenkan
                    on  orderhenkan.kokyakuorderbango =  tuhanorder.juchubango
                    join hikiatesyukko
                    on  hikiatesyukko.syouhinid =  tuhanorder.juchubango
                    left join v_torihikisaki_temp
                    on substring (v_torihikisaki_temp.torihikisaki_cd,1,8) = left(tuhanorder.information1,8)
                    left join v_torihikisaki_temp as v_torihikisaki_temp2
                    on substring (v_torihikisaki_temp2.torihikisaki_cd,1,6) = kokyaku1.yobi12

                    $condition_sql $datachar05_sql $datatxt0003_sql $datatxt0004_sql $datatxt0005_sql
                    AND tuhanorder.juchubango IS NOT NULL
                    AND hikiatesyukko.kaiinid IS NOT NULL
                    --AND haisou.shikibetsucode = '000010'
                    order by tantousya.datatxt0005,haisou.shikibetsucode,tantousya.bango,orderhenkan.kokyakuorderbango asc
                    ");

                $haisou_temp_data=QueryHelper::fetchResult("select * from haisou_temp ");

//                dd(count($haisou_temp_data),QueryHelper::fetchResult("select * from haisou_temp "));

                /*----------calculation starts-------*/

                QueryHelper::runQuery("DROP TABLE IF EXISTS credit_management_temp");
                $col_names='shikibetsucode VARCHAR(20), torihikisakibango VARCHAR(50),syukeitukikijun VARCHAR(50),syukeituki VARCHAR(50), yobi12 VARCHAR(10),datatxt0005 VARCHAR(50),tax_rate VARCHAR(20),information2 VARCHAR(50),juchubango VARCHAR(50),
                        tantousya_datatxt0005_group VARCHAR(50),manager VARCHAR(100), sales_billing_destination VARCHAR(100), clm_credit_limits VARCHAR(100),clm_total_amounts VARCHAR(100), clm_maintenance_schedule VARCHAR(100), clm_note_remaining_schedule VARCHAR(100), clm_scheduled_balance VARCHAR(100),
                        order_no VARCHAR(20), contractor VARCHAR(100), clm_order_amount VARCHAR(100), clm_sales_schedule VARCHAR(20)';
                QueryHelper::runQuery("CREATE TEMPORARY TABLE credit_management_temp( $col_names )");

                if (count($haisou_temp_data)>0){
                    $pre_tantousya_datatxt0005_group='';
                    $pre_shikibetsucode='';
                    $pre_tantousya_bango='';
                    $pre_yobi12='';

                    foreach ($haisou_temp_data as $key=>$val){


                        $torihikisakibango=$val->torihikisakibango;
                        $syukeitukikijun=$val->syukeitukikijun;
                        $syukeituki=$val->syukeituki;
                        $tax_rate=$val->tax_rate;
                        $datatxt0005=$val->datatxt0005;
                        $information2=$val->information2;
                        $juchubango=$val->juchubango;

                        if ($pre_tantousya_datatxt0005_group!=$val->tantousya_datatxt0005_group){
                            $tantousya_datatxt0005_group=$val->tantousya_datatxt0005_group;
                        }
                        else{
                            $tantousya_datatxt0005_group='';
                        }

                        if (($pre_tantousya_bango!=substr($val->manager,0,4)) || ($pre_tantousya_datatxt0005_group!=$val->tantousya_datatxt0005_group)){
                            $manager=$val->manager;
                        }
                        else{
                            $manager='';
                        }

                        if (($pre_yobi12!=$val->yobi12) || ($pre_tantousya_datatxt0005_group!=$val->tantousya_datatxt0005_group)){
                            $yobi12=$val->yobi12;
                            $sales_billing_destination=$val->sales_billing_destination;
                        }
                        else{
                            $yobi12='';
                            $sales_billing_destination='';
                        }

                        if (($pre_shikibetsucode!=$val->shikibetsucode) || ($pre_tantousya_datatxt0005_group!=$val->tantousya_datatxt0005_group)){
                            $shikibetsucode=$val->shikibetsucode;
                            $clm_credit_limits=$val->clm_credit_limits;
                            $clm_total_amounts=$val->clm_total_amounts;
                            $clm_maintenance_schedule=$val->clm_maintenance_schedule;
                            $clm_credit_limits_val=(int)str_replace(array(',',''),'',$val->clm_credit_limits);
                            $clm_total_amounts_val=(int)str_replace(array(',',''),'',$val->clm_total_amounts);
                            $clm_maintenance_schedule_val=(int)str_replace(array(',',''),'',$val->clm_maintenance_schedule);
                            $clm_note_remaining_schedule=$val->clm_note_remaining_schedule;
                            if (($clm_total_amounts==null) && ($clm_maintenance_schedule==null) && ($clm_note_remaining_schedule==null)){
                                $clm_scheduled_balance=null;
                            }
                            else{
                                $clm_scheduled_balance= number_format($clm_credit_limits_val+$clm_total_amounts_val+$clm_maintenance_schedule_val);
                            }
                        }
                        else{
                            $shikibetsucode='';
                            $clm_credit_limits='';
                            $clm_total_amounts='';
                            $clm_maintenance_schedule='';
                            $clm_note_remaining_schedule='';
                            $clm_scheduled_balance='';

                        }

                        $order_no=$val->order_no;
                        $contractor=$val->contractor;
                        $clm_order_amount=$val->clm_order_amount;
                        $clm_sales_schedule=$val->clm_sales_schedule;

                        $pre_tantousya_datatxt0005_group=$val->tantousya_datatxt0005_group;
                        $pre_shikibetsucode=$val->shikibetsucode;
                        $pre_tantousya_bango=substr($val->manager,0,4);
                        $pre_yobi12=$val->yobi12;
                        /*if (($val->order_no=='0151001645')){
                            dd($clm_total_amounts,$clm_maintenance_schedule,$clm_note_remaining_schedule,$clm_scheduled_balance);
                        }*/
                        QueryHelper::runQuery("DROP TABLE IF EXISTS credit_management_temp_calc");
                        QueryHelper::runQuery("CREATE TEMPORARY TABLE credit_management_temp_calc AS
                     SELECT DISTINCT
                     '$shikibetsucode' AS shikibetsucode,
                     '$torihikisakibango' AS torihikisakibango,
                     '$syukeitukikijun' AS syukeitukikijun,
                     '$syukeituki' AS syukeituki,
                     '$yobi12' AS yobi12,
                     '$tax_rate' AS tax_rate,
                     '$datatxt0005' AS datatxt0005,
                     '$information2' AS information2,
                     '$juchubango' AS juchubango,
                     '$tantousya_datatxt0005_group' AS tantousya_datatxt0005_group,
                     '$manager' AS manager,
                     '$sales_billing_destination' AS sales_billing_destination,
                     '$clm_credit_limits' AS clm_credit_limits,
                     '$clm_total_amounts' AS clm_total_amounts,
                     '$clm_maintenance_schedule' AS clm_maintenance_schedule,
                     '$clm_note_remaining_schedule' AS clm_note_remaining_schedule,
                     '$clm_scheduled_balance' AS clm_scheduled_balance,
                     '$order_no' AS order_no,
                     '$contractor' AS contractor,
                     '$clm_order_amount' AS clm_order_amount,
                     '$clm_sales_schedule' AS clm_sales_schedule
                    FROM haisou");
                        QueryHelper::runQuery("INSERT INTO credit_management_temp SELECT * FROM credit_management_temp_calc");
                    }

                }

//                dd(QueryHelper::fetchResult("select * from credit_management_temp "));

                /*----------calculation ends-------*/

                QueryHelper::fetchResult("select * from credit_management_temp");
                $search_sql = DB::table('credit_management_temp')->toSql();


        }
        catch (\Exception $e) {
            return 'ng';
//            dd($e);
        }
        return $search_sql;
    }
}
