<?php

namespace App\AllClass\purchase\paymentSchedule;
use DB;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

class PdfData
{
    public static function readData($bango, $allRequest)
    {

//        dd($allRequest);
        try {
            if (!empty($allRequest['dateDeadLine'])) {
                $req_date_dead_line = str_replace('/', '', $allRequest['dateDeadLine']);
            }
//        dd($allRequest);
            if (!empty($allRequest['information1_short'])) {
                $req_information1_short = $allRequest['information1_short'];
            } else {
                $req_information1_short = null;
            }

            if (!empty($allRequest['information2_short'])) {
                $req_information2_short = $allRequest['information2_short'];
            } else {
                $req_information2_short = null;
            }

            $req_payment_date_from=(int)str_replace('/','',$allRequest['paymentDateFrom']);
            $req_payment_date_to=(int)str_replace('/','',$allRequest['paymentDateTo']);


            if (!empty($allRequest['paymentMethod'])) {
                $req_payment_method = $allRequest['paymentMethod'];
                $req_payment_method_flag = '1';
            } else {
                $req_payment_method = null;
                $req_payment_method_flag = '0';
            }

            $radio_1 = !empty($allRequest['rd1']) ? $allRequest['rd1'] : null;

            //sql where condition creating


            $time_sql1 = '';
            if ($req_date_dead_line) {
                $time_sql1 .= "where substring(replace(shiharaizandaka.sz0001::text,'-',''),1,8)  = '$req_date_dead_line'";
            }

            $information_sql = '';
            if ($req_information1_short != '' && $req_information2_short != '' && ($req_information1_short != $req_information2_short)) {
                $information_sql .= " and others2_temp_before.foreign_key2::int between '$req_information1_short' and  '$req_information2_short' ";
            } else if ($req_information1_short != '') {
                $information_sql .=  "  and others2_temp_before.foreign_key2  = '$req_information1_short'";
            }else if ($req_information2_short != '') {
                $information_sql .=  "  and others2_temp_before.foreign_key2  = '$req_information2_short'";
            }

            //after 303 query
            $time_sql2 = '';
            if ($req_payment_date_from < $req_payment_date_to) {
                $time_sql2 .= " where others2_temp_before.payment_date_sort::bigint between '$req_payment_date_from' and '$req_payment_date_to'";
            }
            elseif($req_payment_date_from == $req_payment_date_to){
                $time_sql2 .= " where others2_temp_before.payment_date_sort::bigint = '$req_payment_date_from'";
            }
//        dd($time_sql1,$time_sql2);

            /*$payment_method_sql = '';
            if ($req_payment_method) {
                $payment_method_sql .= "  and shiharaizandaka.sz0025 = '$req_payment_method'";

            }*/
//        dd($datatxt0003_sql,$datatxt0004_sql,$datatxt0005_sql,$datachar05_sql);


            QueryHelper::runQuery("DROP TABLE IF EXISTS v_torihikisaki_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE v_torihikisaki_temp AS
        SELECT DISTINCT ON (v_torihikisaki.torihikisaki_cd)
            v_torihikisaki.*
            FROM v_torihikisaki
        --where v_torihikisaki.torihikisaki_cd like '00014301001'
            ");

            //deadline date search
            QueryHelper::runQuery("DROP TABLE IF EXISTS others2_temp_before");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE others2_temp_before AS
                select distinct on (shiharaizandaka.sz0001,shiharaizandaka.sz0002)
                    substring(others2.other1,1,1) as other1,
                    others2.other20,
                    others2.other21,
                    haisoujouhou.mail,
                    haisoujouhou.sex,
                    case
                    when substring(others2.other1,1,1)='1'
                    then left (haisoujouhou.mail,1)
                    when substring(others2.other1,1,1)='2'
                    then left (others2.other20,1)
                    end as payment_month,

                    case
                    when substring(others2.other1,1,1)='1'
                    then right (haisoujouhou.sex,2)
                    when substring(others2.other1,1,1)='2'
                    then right (others2.other21,2)
                    end as payment_day,
                    case
                         when substring(others2.other1,1,1)='1'
                         then
                             case
                                 when cast(substring (((date_trunc('MONTH', (left ((date (shiharaizandaka.sz0001) + (left (haisoujouhou.mail,1)||' month')::INTERVAL)::text,8) || '20 00:00:00')::date) + INTERVAL '1 MONTH - 1 day')::date)::text,9,2) as int ) < cast(right (haisoujouhou.sex,2) as int)
                                 then (REPLACE(((date_trunc('MONTH', (left ((date (shiharaizandaka.sz0001) + (left (haisoujouhou.mail,1)||' month')::INTERVAL)::text,8) || '20 00:00:00')::date) + INTERVAL '1 MONTH - 1 day')::date)::text,'-',''))::int
                                 else (left (REPLACE((date (shiharaizandaka.sz0001) + (left (haisoujouhou.mail,1)||' month')::INTERVAL)::text,'-',''),6) || right (haisoujouhou.sex,2))::int
                             end
                         when substring(others2.other1,1,1)='2'
                         then
                             case
                                 when cast(substring (((date_trunc('MONTH', (left ((date (shiharaizandaka.sz0001) + (left (others2.other20,1)||' month')::INTERVAL)::text,8) || '20 00:00:00')::date) + INTERVAL '1 MONTH - 1 day')::date)::text,9,2) as int ) < cast(right (others2.other21,2) as int)
                                 then (REPLACE(((date_trunc('MONTH', (left ((date (shiharaizandaka.sz0001) + (left (others2.other20,1)||' month')::INTERVAL)::text,8) || '20 00:00:00')::date) + INTERVAL '1 MONTH - 1 day')::date)::text,'-',''))::int
                                 else (left (REPLACE((date (shiharaizandaka.sz0001) + (left (others2.other20,1)||' month')::INTERVAL)::text,'-',''),6) || right (others2.other21,2))::int
                             end
                         end as payment_date_sort,
                    case
                         when substring(others2.other1,1,1)='1'
                         then
                             case
                                 when cast(substring (((date_trunc('MONTH', (left ((date (shiharaizandaka.sz0001) + (left (haisoujouhou.mail,1)||' month')::INTERVAL)::text,8) || '20 00:00:00')::date) + INTERVAL '1 MONTH - 1 day')::date)::text,9,2) as int ) < cast(right (haisoujouhou.sex,2) as int)
                                 then REPLACE(((date_trunc('MONTH', (left ((date (shiharaizandaka.sz0001) + (left (haisoujouhou.mail,1)||' month')::INTERVAL)::text,8) || '20 00:00:00')::date) + INTERVAL '1 MONTH - 1 day')::date)::text,'-','/')
                                 else left (REPLACE((date (shiharaizandaka.sz0001) + (left (haisoujouhou.mail,1)||' month')::INTERVAL)::text,'-','/'),8) || right (haisoujouhou.sex,2)
                             end
                         when substring(others2.other1,1,1)='2'
                         then
                             case
                                 when cast(substring (((date_trunc('MONTH', (left ((date (shiharaizandaka.sz0001) + (left (others2.other20,1)||' month')::INTERVAL)::text,8) || '20 00:00:00')::date) + INTERVAL '1 MONTH - 1 day')::date)::text,9,2) as int ) < cast(right (others2.other21,2) as int)
                                 then REPLACE(((date_trunc('MONTH', (left ((date (shiharaizandaka.sz0001) + (left (others2.other20,1)||' month')::INTERVAL)::text,8) || '20 00:00:00')::date) + INTERVAL '1 MONTH - 1 day')::date)::text,'-','/')
                                 else left (REPLACE((date (shiharaizandaka.sz0001) + (left (others2.other20,1)||' month')::INTERVAL)::text,'-','/'),8) || right (others2.other21,2)
                             end
                         end as payment_date,

                    --(date_trunc('MONTH', (left ((date (shiharaizandaka.sz0001) + (left (haisoujouhou.mail,1)||' month')::INTERVAL)::text,8) || '20 00:00:00')::date) + INTERVAL '1 MONTH - 1 day')::date as test_last_date,
                    --substring (((date_trunc('MONTH', (left ((date (shiharaizandaka.sz0001) + (left (haisoujouhou.mail,1)||' month')::INTERVAL)::text,8) || '20 00:00:00')::date) + INTERVAL '1 MONTH - 1 day')::date)::text,9,2) as test_last_date1,
                    --date (shiharaizandaka.sz0001) + (left (others2.other20,1)||' month')::INTERVAL as test_date,
                    --COALESCE(substring(REPLACE(substring(CAST(shiharaizandaka.sz0001 AS text),1,10),'-',''),5,2)::int,0) + COALESCE(substring(others2.other1,1,1)::int,0) as test_old_way,

                    shiharaizandaka.sz0001 as foreign_key1,
                    shiharaizandaka.sz0002 as foreign_key2

                    from haisou
                    join shiharaizandaka
                    on left (shiharaizandaka.sz0002,6) = haisou.shikibetsucode
                    and right (shiharaizandaka.sz0002,2) = haisou.torihikisakibango
                    join kokyaku1 on kokyaku1.bango = haisou.kokyakubango
                    left join haisoujouhou on haisoujouhou.syukei1 = kokyaku1.bango
                    join others2 as others2
                    on others2.otherint1 = haisou.bango
                    $time_sql1
            ");

            //payment date,company,master search
            QueryHelper::runQuery("DROP TABLE IF EXISTS others2_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE others2_temp AS
                select * from others2_temp_before $time_sql2 $information_sql
            ");

//        dd(QueryHelper::fetchResult("select * from others2_temp"),$time_sql2);

            QueryHelper::runQuery("DROP TABLE IF EXISTS payment_schedule_temp_before");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE payment_schedule_temp_before as
                select distinct on (others2_temp.payment_date_sort,shiharaizandaka.sz0001,shiharaizandaka.sz0002)
                v_torihikisaki_contractor.r16cd as  vendor,
                shiharaizandaka.sz0001,
                shiharaizandaka.sz0002,
                case
                    when '$radio_1'='1'
                    then COALESCE(shiharaizandaka.sz0038::bigint,0)
                    when '$radio_1'='2'
                    then COALESCE(shiharaizandaka.sz0039::bigint,0)
                    when '$radio_1'='3'
                    then COALESCE(shiharaizandaka.sz0038::bigint,0) + COALESCE(shiharaizandaka.sz0039::bigint,0) else null end as current_month_balance_sort,
                case
                    when '$radio_1'='1'
                    then to_char(shiharaizandaka.sz0038,'FM99,999,999,999,999')
                    when '$radio_1'='2'
                    then to_char(shiharaizandaka.sz0039,'FM99,999,999,999,999')
                    when '$radio_1'='3'
                    then to_char(COALESCE(shiharaizandaka.sz0038::bigint,0) + COALESCE(shiharaizandaka.sz0039::bigint,0),'FM99,999,999,999,999') else null end as current_month_balance,
                others2_temp.payment_date_sort,
                others2_temp.payment_date,
                --(date_trunc('MONTH', others2_temp.payment_date_format::date) + INTERVAL '1 MONTH - 1 day')::date as payment_last_date,


                '$req_payment_method' as method_test,
                shiharaizandaka.sz0025,
                shiharaizandaka.sz0027,
                shiharaizandaka.sz0029,
                shiharaizandaka.sz0031,
                shiharaizandaka.sz0033,
                shiharaizandaka.sz0035,

                case
                when '$req_payment_method_flag' = '1'
                then case
                        when shiharaizandaka.sz0025 = '$req_payment_method'
                        then categorykanri_payment_method1.category2 ||' '|| categorykanri_payment_method1.category4
                        else null end
                when '$req_payment_method_flag' = '0'
                then categorykanri_payment_method1.category2 ||' '|| categorykanri_payment_method1.category4
                end as  purchase_payment_method1,

                case
                when '$req_payment_method_flag' = '1'
                then case
                        when shiharaizandaka.sz0025 = '$req_payment_method'
                        then shiharaizandaka.sz0026::bigint
                        else null end
                when '$req_payment_method_flag' = '0'
                then shiharaizandaka.sz0026::bigint
                end as  purchase_payment_amount1_sort,

                case
                when '$req_payment_method_flag' = '1'
                then case
                        when shiharaizandaka.sz0025 = '$req_payment_method'
                        then to_char(shiharaizandaka.sz0026,'FM99,999,999,999,999')
                        else null end
                when '$req_payment_method_flag' = '0'
                then case
                        when (categorykanri_payment_method1.category2 ||' '|| categorykanri_payment_method1.category4 = '') is not false
                        then null
                        else to_char(shiharaizandaka.sz0026,'FM99,999,999,999,999') end
                end as  purchase_payment_amount1,

                case
                when '$req_payment_method_flag' = '1'
                then case
                        when shiharaizandaka.sz0027 = '$req_payment_method'
                        then categorykanri_payment_method2.category2 ||' '|| categorykanri_payment_method2.category4
                        else null end
                when '$req_payment_method_flag' = '0'
                then categorykanri_payment_method2.category2 ||' '|| categorykanri_payment_method2.category4
                end as  purchase_payment_method2,

                case
                when '$req_payment_method_flag' = '1'
                then case
                        when shiharaizandaka.sz0027 = '$req_payment_method'
                        then shiharaizandaka.sz0028::bigint
                        else null end
                when '$req_payment_method_flag' = '0'
                then shiharaizandaka.sz0028::bigint
                end as  purchase_payment_amount2_sort,

                case
                when '$req_payment_method_flag' = '1'
                then case
                        when shiharaizandaka.sz0027 = '$req_payment_method'
                        then to_char(shiharaizandaka.sz0028,'FM99,999,999,999,999')
                        else null end
                when '$req_payment_method_flag' = '0'
                then case
                        when (categorykanri_payment_method2.category2 ||' '|| categorykanri_payment_method2.category4 = '') is not false
                        then null
                        else to_char(shiharaizandaka.sz0028,'FM99,999,999,999,999') end
                end as  purchase_payment_amount2,


                case
                when '$req_payment_method_flag' = '1'
                then case
                        when shiharaizandaka.sz0029 = '$req_payment_method'
                        then categorykanri_payment_method3.category2 ||' '|| categorykanri_payment_method3.category4
                        else null end
                when '$req_payment_method_flag' = '0'
                then categorykanri_payment_method3.category2 ||' '|| categorykanri_payment_method3.category4
                end as  purchase_payment_method3,

                case
                when '$req_payment_method_flag' = '1'
                then case
                        when shiharaizandaka.sz0029 = '$req_payment_method'
                        then shiharaizandaka.sz0030::bigint
                        else null end
                when '$req_payment_method_flag' = '0'
                then shiharaizandaka.sz0030::bigint
                end as  purchase_payment_amount3_sort,

                case
                when '$req_payment_method_flag' = '1'
                then case
                        when shiharaizandaka.sz0029 = '$req_payment_method'
                        then to_char(shiharaizandaka.sz0030,'FM99,999,999,999,999')
                        else null end
                when '$req_payment_method_flag' = '0'
                then case
                        when (categorykanri_payment_method3.category2 ||' '|| categorykanri_payment_method3.category4 = '') is not false
                        then null
                        else to_char(shiharaizandaka.sz0030,'FM99,999,999,999,999') end
                end as  purchase_payment_amount3,

                case
                when '$req_payment_method_flag' = '1'
                then case
                        when shiharaizandaka.sz0031 = '$req_payment_method'
                        then categorykanri_payment_method1_1.category2 ||' '|| categorykanri_payment_method1_1.category4
                        else null end
                when '$req_payment_method_flag' = '0'
                then categorykanri_payment_method1_1.category2 ||' '|| categorykanri_payment_method1_1.category4
                end as  purchase_payment_method1_1,

                case
                when '$req_payment_method_flag' = '1'
                then case
                        when shiharaizandaka.sz0031 = '$req_payment_method'
                        then shiharaizandaka.sz0032::bigint
                        else null end
                when '$req_payment_method_flag' = '0'
                then shiharaizandaka.sz0032::bigint
                end as  purchase_payment_amount1_1_sort,

                case
                when '$req_payment_method_flag' = '1'
                then case
                        when shiharaizandaka.sz0031 = '$req_payment_method'
                        then to_char(shiharaizandaka.sz0032,'FM99,999,999,999,999')
                        else null end
                when '$req_payment_method_flag' = '0'
                then case
                        when (categorykanri_payment_method1_1.category2 ||' '|| categorykanri_payment_method1_1.category4 = '') is not false
                        then null
                        else to_char(shiharaizandaka.sz0032,'FM99,999,999,999,999') end
                end as  purchase_payment_amount1_1,

                case
                when '$req_payment_method_flag' = '1'
                then case
                        when shiharaizandaka.sz0033 = '$req_payment_method'
                        then categorykanri_payment_method2_1.category2 ||' '|| categorykanri_payment_method2_1.category4
                        else null end
                when '$req_payment_method_flag' = '0'
                then categorykanri_payment_method2_1.category2 ||' '|| categorykanri_payment_method2_1.category4
                end as  purchase_payment_method2_1,

                case
                when '$req_payment_method_flag' = '1'
                then case
                        when shiharaizandaka.sz0033 = '$req_payment_method'
                        then shiharaizandaka.sz0034::bigint
                        else null end
                when '$req_payment_method_flag' = '0'
                then shiharaizandaka.sz0034::bigint
                end as  purchase_payment_amount2_1_sort,

                case
                when '$req_payment_method_flag' = '1'
                then case
                        when shiharaizandaka.sz0033 = '$req_payment_method'
                        then to_char(shiharaizandaka.sz0034,'FM99,999,999,999,999')
                        else null end
                when '$req_payment_method_flag' = '0'
                then case
                        when (categorykanri_payment_method2_1.category2 ||' '|| categorykanri_payment_method2_1.category4 = '') is not false
                        then null
                        else to_char(shiharaizandaka.sz0034,'FM99,999,999,999,999') end
                end as  purchase_payment_amount2_1,

                case
                when '$req_payment_method_flag' = '1'
                then case
                        when shiharaizandaka.sz0035 = '$req_payment_method'
                        then categorykanri_payment_method3_1.category2 ||' '|| categorykanri_payment_method3_1.category4
                        else null end
                when '$req_payment_method_flag' = '0'
                then categorykanri_payment_method3_1.category2 ||' '|| categorykanri_payment_method3_1.category4
                end as  purchase_payment_method3_1,

                case
                when '$req_payment_method_flag' = '1'
                then case
                        when shiharaizandaka.sz0035 = '$req_payment_method'
                        then shiharaizandaka.sz0036::bigint
                        else null end
                when '$req_payment_method_flag' = '0'
                then shiharaizandaka.sz0036::bigint
                end as  purchase_payment_amount3_1_sort,

                case
                when '$req_payment_method_flag' = '1'
                then case
                        when shiharaizandaka.sz0035 = '$req_payment_method'
                        then to_char(shiharaizandaka.sz0036,'FM99,999,999,999,999')
                        else null end
                when '$req_payment_method_flag' = '0'
                then case
                        when (categorykanri_payment_method3_1.category2 ||' '|| categorykanri_payment_method3_1.category4 = '') is not false
                        then null
                        else to_char(shiharaizandaka.sz0036,'FM99,999,999,999,999') end
                end as  purchase_payment_amount3_1,

                null::bigint as difference_sort,
                null as difference,
                --(COALESCE(shiharaizandaka.sz0038::bigint,0) + COALESCE(shiharaizandaka.sz0039::bigint,0)) as sum_of_38_39,
                --COALESCE(shiharaizandaka.sz0038::bigint,0) as sum_of_38,
                --COALESCE(shiharaizandaka.sz0039::bigint,0) as sum_of_39,
                --COALESCE(shiharaizandaka.sz0026::bigint,0) + COALESCE(shiharaizandaka.sz0028::bigint,0) + COALESCE(shiharaizandaka.sz0030::bigint,0) + COALESCE(shiharaizandaka.sz0032::bigint,0) + COALESCE(shiharaizandaka.sz0034::bigint,0) + COALESCE(shiharaizandaka.sz0036::bigint,0) as sum_of_right,
                REPLACE(substring(CAST(shiharaizandaka.sz0037 AS text),1,10),'-','')::int as bill_due_date_sort,
                REPLACE(substring(CAST(shiharaizandaka.sz0037 AS text),1,10),'-','/') as bill_due_date,
                --others2_temp.payment_method,
                --others2_temp.amount_sort,
                --others2_temp.amount,
                null as payment_method,
                null as amount_sort,
                null as amount

                from shiharaizandaka

                --left join others2_temp
                --on others2_temp.foreign_key = shiharaizandaka.sz0025
                join others2_temp
                on others2_temp.foreign_key1 = shiharaizandaka.sz0001
                and others2_temp.foreign_key2 = shiharaizandaka.sz0002

                left join v_torihikisaki_temp as  v_torihikisaki_contractor
                on substring (v_torihikisaki_contractor.torihikisaki_cd,1,8) = shiharaizandaka.sz0002

                left join categorykanri as categorykanri_payment_method1
                on categorykanri_payment_method1.category1||categorykanri_payment_method1.category2 = shiharaizandaka.sz0025

                left join categorykanri as categorykanri_payment_method2
                on categorykanri_payment_method2.category1||categorykanri_payment_method2.category2 = shiharaizandaka.sz0027

                left join categorykanri as categorykanri_payment_method3
                on categorykanri_payment_method3.category1||categorykanri_payment_method3.category2 = shiharaizandaka.sz0029

                left join categorykanri as categorykanri_payment_method1_1
                on categorykanri_payment_method1_1.category1||categorykanri_payment_method1_1.category2 = shiharaizandaka.sz0031

                left join categorykanri as categorykanri_payment_method2_1
                on categorykanri_payment_method2_1.category1||categorykanri_payment_method2_1.category2 = shiharaizandaka.sz0033

                left join categorykanri as categorykanri_payment_method3_1
                on categorykanri_payment_method3_1.category1||categorykanri_payment_method3_1.category2 = shiharaizandaka.sz0035

                order by others2_temp.payment_date_sort,shiharaizandaka.sz0001,shiharaizandaka.sz0002
                ");

            //for bug testing $time_sql2
//        dd(QueryHelper::fetchResult("select * from payment_schedule_temp_before"),$time_sql1,$time_sql2,$information_sql,$req_payment_method,$radio_1);

//        creating extra row for payment method

            $paymentSchedules = QueryHelper::fetchResult("select * from payment_schedule_temp_before");

            if (count($paymentSchedules)>0){
                //calculating 413
                QueryHelper::runQuery("DROP TABLE IF EXISTS payment_schedule_temp");
                $col_names='vendor VARCHAR(100),sz0001 VARCHAR(100),sz0002 VARCHAR(100),current_month_balance_sort VARCHAR(100), current_month_balance VARCHAR(100),payment_date_sort VARCHAR(100),payment_date VARCHAR(100),method_test VARCHAR(100),
                    sz0025 VARCHAR(100),sz0027 VARCHAR(100), sz0029 VARCHAR(100), sz0031 VARCHAR(100),sz0033 VARCHAR(100), sz0035 VARCHAR(100), purchase_payment_method1 VARCHAR(100), purchase_payment_amount1_sort VARCHAR(100),
                    purchase_payment_amount1 VARCHAR(100),purchase_payment_method2 VARCHAR(100),purchase_payment_amount2_sort VARCHAR(100), purchase_payment_amount2 VARCHAR(100),purchase_payment_method3 VARCHAR(100),purchase_payment_amount3_sort VARCHAR(100),purchase_payment_amount3 VARCHAR(100),
                    purchase_payment_method1_1 VARCHAR(100),purchase_payment_amount1_1_sort VARCHAR(100), purchase_payment_amount1_1 VARCHAR(100), purchase_payment_method2_1 VARCHAR(100),purchase_payment_amount2_1_sort VARCHAR(100), purchase_payment_amount2_1 VARCHAR(100), purchase_payment_method3_1 VARCHAR(100), purchase_payment_amount3_1_sort VARCHAR(100),
                    purchase_payment_amount3_1 VARCHAR(100),difference_sort VARCHAR(100),difference VARCHAR(100), bill_due_date_sort VARCHAR(100),bill_due_date VARCHAR(100),payment_method VARCHAR(100),amount_sort VARCHAR(100),
                    amount VARCHAR(100)';
                QueryHelper::runQuery("CREATE TEMPORARY TABLE payment_schedule_temp( $col_names )");

                foreach ($paymentSchedules as $paymentSchedule){
                    $val_302=$paymentSchedule->current_month_balance_sort;
                    $val_402_412=(int)$paymentSchedule->purchase_payment_amount1_sort+(int)$paymentSchedule->purchase_payment_amount2_sort+(int)$paymentSchedule->purchase_payment_amount3_sort
                        +(int)$paymentSchedule->purchase_payment_amount1_1_sort+(int)$paymentSchedule->purchase_payment_amount2_1_sort+(int)$paymentSchedule->purchase_payment_amount3_1_sort;

//                dd($val_302,$val_402_412);
                    QueryHelper::runQuery("DROP TABLE IF EXISTS payment_schedule_row_temp");
                    QueryHelper::runQuery("CREATE TEMPORARY TABLE payment_schedule_row_temp AS
                    SELECT DISTINCT
                    '$paymentSchedule->vendor' AS vendor,
                    '$paymentSchedule->sz0001' AS sz0001,
                    '$paymentSchedule->sz0002' AS sz0002,
                    '$paymentSchedule->current_month_balance_sort' AS current_month_balance_sort,
                    '$paymentSchedule->current_month_balance' AS current_month_balance,
                    '$paymentSchedule->payment_date_sort' AS payment_date_sort,
                    '$paymentSchedule->payment_date' AS payment_date,
                    '$paymentSchedule->method_test' AS method_test,
                    '$paymentSchedule->sz0025' AS sz0025,
                    '$paymentSchedule->sz0027' AS sz0027,
                    '$paymentSchedule->sz0029' AS sz0029,
                    '$paymentSchedule->sz0031' AS sz0031,
                    '$paymentSchedule->sz0033' AS sz0033,
                    '$paymentSchedule->sz0035' AS sz0035,

                    '$paymentSchedule->purchase_payment_method1' AS purchase_payment_method1,
                    '$paymentSchedule->purchase_payment_amount1_sort' AS purchase_payment_amount1_sort,
                    '$paymentSchedule->purchase_payment_amount1' AS purchase_payment_amount1,
                    '$paymentSchedule->purchase_payment_method2' AS purchase_payment_method2,
                    '$paymentSchedule->purchase_payment_amount2_sort' AS purchase_payment_amount2_sort,
                    '$paymentSchedule->purchase_payment_amount2' AS purchase_payment_amount2,
                    '$paymentSchedule->purchase_payment_method3' AS purchase_payment_method3,
                    '$paymentSchedule->purchase_payment_amount3_sort' AS purchase_payment_amount3_sort,
                    '$paymentSchedule->purchase_payment_amount3' AS purchase_payment_amount3,
                    '$paymentSchedule->purchase_payment_method1_1' AS purchase_payment_method1_1,
                    '$paymentSchedule->purchase_payment_amount1_1_sort' AS purchase_payment_amount1_1_sort,
                    '$paymentSchedule->purchase_payment_amount1_1' AS purchase_payment_amount1_1,
                    '$paymentSchedule->purchase_payment_method2_1' AS purchase_payment_method2_1,
                    '$paymentSchedule->purchase_payment_amount2_1_sort' AS purchase_payment_amount2_1_sort,
                    '$paymentSchedule->purchase_payment_amount2_1' AS purchase_payment_amount2_1,
                    '$paymentSchedule->purchase_payment_method3_1' AS purchase_payment_method3_1,
                    '$paymentSchedule->purchase_payment_amount3_1_sort' AS purchase_payment_amount3_1_sort,
                    '$paymentSchedule->purchase_payment_amount3_1' AS purchase_payment_amount3_1,
                    '$paymentSchedule->difference_sort' AS difference_sort,
                    case
                        when ('$val_302'::bigint) = ('$val_402_412'::bigint)
                        then null
                        else '*' end as difference,
                     --null as   difference,
                    '$paymentSchedule->bill_due_date_sort' AS bill_due_date_sort,
                    '$paymentSchedule->bill_due_date' AS bill_due_date,
                    '$paymentSchedule->payment_method' AS payment_method,
                    '$paymentSchedule->amount_sort' AS amount_sort,
                    '$paymentSchedule->amount' AS amount
                    FROM shiharaizandaka");
                    QueryHelper::runQuery("INSERT INTO payment_schedule_temp SELECT * FROM payment_schedule_row_temp");
                }
//            dd(QueryHelper::fetchResult("select * from payment_schedule_temp_before"),QueryHelper::fetchResult("select * from payment_schedule_temp"));
                //method of payment
                $data104 = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'D9' ");
                $paymentMethodIdArr=[];
                $paymentMethodNameArr=[];
                $initialPresentPMIdArr=[];
                $initialPresentPMNameArr=[];
                $finalPresentPMIdArr=[];
                $finalPresentPMNameArr=[];
                $singlePaymentMethodSum=null;
                $singlePaymentMethodName=null;

                foreach ($data104 as $data104_val){
                    array_push($paymentMethodIdArr,$data104_val->category1 . $data104_val->category2);
                    array_push($paymentMethodNameArr,$data104_val->category2 . ' ' . $data104_val->category4);
                }
//            dd($paymentMethodIdArr,$paymentMethodNameArr);

                foreach ($paymentSchedules as $paymentSchedule){
                    if ($req_payment_method_flag=='1'){
                        if ($radio_1==1){
                            if ($paymentSchedule->sz0025==$req_payment_method){
                                $singlePaymentMethodName=$paymentSchedule->purchase_payment_method1;
                                $singlePaymentMethodSum=$singlePaymentMethodSum+$paymentSchedule->purchase_payment_amount1_sort;
                                //for used payment method only
                                if (!in_array($paymentSchedule->sz0025,$initialPresentPMIdArr)){
                                    array_push($initialPresentPMIdArr,$paymentSchedule->sz0025);
                                    array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method1);
                                }
                            }
                            if ($paymentSchedule->sz0027==$req_payment_method){
                                $singlePaymentMethodName=$paymentSchedule->purchase_payment_method2;
                                $singlePaymentMethodSum=$singlePaymentMethodSum+$paymentSchedule->purchase_payment_amount2_sort;
                                //for used payment method only
                                if (!in_array($paymentSchedule->sz0027,$initialPresentPMIdArr)){
                                    array_push($initialPresentPMIdArr,$paymentSchedule->sz0027);
                                    array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method2);
                                }
                            }
                            if ($paymentSchedule->sz0029==$req_payment_method){
                                $singlePaymentMethodName=$paymentSchedule->purchase_payment_method3;
                                $singlePaymentMethodSum=$singlePaymentMethodSum+$paymentSchedule->purchase_payment_amount3_sort;
                                //for used payment method only
                                if (!in_array($paymentSchedule->sz0029,$initialPresentPMIdArr)){
                                    array_push($initialPresentPMIdArr,$paymentSchedule->sz0029);
                                    array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method3);
                                }
                            }
                            /*if ($paymentSchedule->sz0031==$req_payment_method){
                                $singlePaymentMethodName=$paymentSchedule->purchase_payment_method1_1;
                                $singlePaymentMethodSum=$singlePaymentMethodSum+$paymentSchedule->purchase_payment_amount1_1_sort;
                                //for used payment method only
                                if (!in_array($paymentSchedule->sz0031,$initialPresentPMIdArr)){
                                    array_push($initialPresentPMIdArr,$paymentSchedule->sz0031);
                                    array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method1_1);
                                }
                            }
                            if ($paymentSchedule->sz0033==$req_payment_method){
                                $singlePaymentMethodName=$paymentSchedule->purchase_payment_method2_1;
                                $singlePaymentMethodSum=$singlePaymentMethodSum+$paymentSchedule->purchase_payment_amount2_1_sort;
                                //for used payment method only
                                if (!in_array($paymentSchedule->sz0033,$initialPresentPMIdArr)){
                                    array_push($initialPresentPMIdArr,$paymentSchedule->sz0033);
                                    array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method2_1);
                                }
                            }
                            if ($paymentSchedule->sz0035==$req_payment_method){
                                $singlePaymentMethodName=$paymentSchedule->purchase_payment_method3_1;
                                $singlePaymentMethodSum=$singlePaymentMethodSum+$paymentSchedule->purchase_payment_amount3_1_sort;
                                //for used payment method only
                                if (!in_array($paymentSchedule->sz0035,$initialPresentPMIdArr)){
                                    array_push($initialPresentPMIdArr,$paymentSchedule->sz0035);
                                    array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method3_1);
                                }
                            }*/
                        }
                        elseif ($radio_1==2){
                            /*if ($paymentSchedule->sz0025==$req_payment_method){
                                $singlePaymentMethodName=$paymentSchedule->purchase_payment_method1;
                                $singlePaymentMethodSum=$singlePaymentMethodSum+$paymentSchedule->purchase_payment_amount1_sort;
                                //for used payment method only
                                if (!in_array($paymentSchedule->sz0025,$initialPresentPMIdArr)){
                                    array_push($initialPresentPMIdArr,$paymentSchedule->sz0025);
                                    array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method1);
                                }
                            }
                            if ($paymentSchedule->sz0027==$req_payment_method){
                                $singlePaymentMethodName=$paymentSchedule->purchase_payment_method2;
                                $singlePaymentMethodSum=$singlePaymentMethodSum+$paymentSchedule->purchase_payment_amount2_sort;
                                //for used payment method only
                                if (!in_array($paymentSchedule->sz0027,$initialPresentPMIdArr)){
                                    array_push($initialPresentPMIdArr,$paymentSchedule->sz0027);
                                    array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method2);
                                }
                            }
                            if ($paymentSchedule->sz0029==$req_payment_method){
                                $singlePaymentMethodName=$paymentSchedule->purchase_payment_method3;
                                $singlePaymentMethodSum=$singlePaymentMethodSum+$paymentSchedule->purchase_payment_amount3_sort;
                                //for used payment method only
                                if (!in_array($paymentSchedule->sz0029,$initialPresentPMIdArr)){
                                    array_push($initialPresentPMIdArr,$paymentSchedule->sz0029);
                                    array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method3);
                                }
                            }*/
                            if ($paymentSchedule->sz0031==$req_payment_method){
                                $singlePaymentMethodName=$paymentSchedule->purchase_payment_method1_1;
                                $singlePaymentMethodSum=$singlePaymentMethodSum+$paymentSchedule->purchase_payment_amount1_1_sort;
                                //for used payment method only
                                if (!in_array($paymentSchedule->sz0031,$initialPresentPMIdArr)){
                                    array_push($initialPresentPMIdArr,$paymentSchedule->sz0031);
                                    array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method1_1);
                                }
                            }
                            if ($paymentSchedule->sz0033==$req_payment_method){
                                $singlePaymentMethodName=$paymentSchedule->purchase_payment_method2_1;
                                $singlePaymentMethodSum=$singlePaymentMethodSum+$paymentSchedule->purchase_payment_amount2_1_sort;
                                //for used payment method only
                                if (!in_array($paymentSchedule->sz0033,$initialPresentPMIdArr)){
                                    array_push($initialPresentPMIdArr,$paymentSchedule->sz0033);
                                    array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method2_1);
                                }
                            }
                            if ($paymentSchedule->sz0035==$req_payment_method){
                                $singlePaymentMethodName=$paymentSchedule->purchase_payment_method3_1;
                                $singlePaymentMethodSum=$singlePaymentMethodSum+$paymentSchedule->purchase_payment_amount3_1_sort;
                                //for used payment method only
                                if (!in_array($paymentSchedule->sz0035,$initialPresentPMIdArr)){
                                    array_push($initialPresentPMIdArr,$paymentSchedule->sz0035);
                                    array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method3_1);
                                }
                            }
                        }
                        elseif ($radio_1==3){
                            if ($paymentSchedule->sz0025==$req_payment_method){
                                $singlePaymentMethodName=$paymentSchedule->purchase_payment_method1;
                                $singlePaymentMethodSum=$singlePaymentMethodSum+$paymentSchedule->purchase_payment_amount1_sort;
                                //for used payment method only
                                if (!in_array($paymentSchedule->sz0025,$initialPresentPMIdArr)){
                                    array_push($initialPresentPMIdArr,$paymentSchedule->sz0025);
                                    array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method1);
                                }
                            }
                            if ($paymentSchedule->sz0027==$req_payment_method){
                                $singlePaymentMethodName=$paymentSchedule->purchase_payment_method2;
                                $singlePaymentMethodSum=$singlePaymentMethodSum+$paymentSchedule->purchase_payment_amount2_sort;
                                //for used payment method only
                                if (!in_array($paymentSchedule->sz0027,$initialPresentPMIdArr)){
                                    array_push($initialPresentPMIdArr,$paymentSchedule->sz0027);
                                    array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method2);
                                }
                            }
                            if ($paymentSchedule->sz0029==$req_payment_method){
                                $singlePaymentMethodName=$paymentSchedule->purchase_payment_method3;
                                $singlePaymentMethodSum=$singlePaymentMethodSum+$paymentSchedule->purchase_payment_amount3_sort;
                                //for used payment method only
                                if (!in_array($paymentSchedule->sz0029,$initialPresentPMIdArr)){
                                    array_push($initialPresentPMIdArr,$paymentSchedule->sz0029);
                                    array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method3);
                                }
                            }
                            if ($paymentSchedule->sz0031==$req_payment_method){
                                $singlePaymentMethodName=$paymentSchedule->purchase_payment_method1_1;
                                $singlePaymentMethodSum=$singlePaymentMethodSum+$paymentSchedule->purchase_payment_amount1_1_sort;
                                //for used payment method only
                                if (!in_array($paymentSchedule->sz0031,$initialPresentPMIdArr)){
                                    array_push($initialPresentPMIdArr,$paymentSchedule->sz0031);
                                    array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method1_1);
                                }
                            }
                            if ($paymentSchedule->sz0033==$req_payment_method){
                                $singlePaymentMethodName=$paymentSchedule->purchase_payment_method2_1;
                                $singlePaymentMethodSum=$singlePaymentMethodSum+$paymentSchedule->purchase_payment_amount2_1_sort;
                                //for used payment method only
                                if (!in_array($paymentSchedule->sz0033,$initialPresentPMIdArr)){
                                    array_push($initialPresentPMIdArr,$paymentSchedule->sz0033);
                                    array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method2_1);
                                }
                            }
                            if ($paymentSchedule->sz0035==$req_payment_method){
                                $singlePaymentMethodName=$paymentSchedule->purchase_payment_method3_1;
                                $singlePaymentMethodSum=$singlePaymentMethodSum+$paymentSchedule->purchase_payment_amount3_1_sort;
                                //for used payment method only
                                if (!in_array($paymentSchedule->sz0035,$initialPresentPMIdArr)){
                                    array_push($initialPresentPMIdArr,$paymentSchedule->sz0035);
                                    array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method3_1);
                                }
                            }
                        }

                    }
                    else{
                        if ($radio_1==1){
                            if (!in_array($paymentSchedule->sz0025,$initialPresentPMIdArr)){
                                array_push($initialPresentPMIdArr,$paymentSchedule->sz0025);
                                array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method1);
                            }
                            if (!in_array($paymentSchedule->sz0027,$initialPresentPMIdArr)){
                                array_push($initialPresentPMIdArr,$paymentSchedule->sz0027);
                                array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method2);
                            }
                            if (!in_array($paymentSchedule->sz0029,$initialPresentPMIdArr)){
                                array_push($initialPresentPMIdArr,$paymentSchedule->sz0029);
                                array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method3);
                            }
                            /*if (!in_array($paymentSchedule->sz0031,$initialPresentPMIdArr)){
                                array_push($initialPresentPMIdArr,$paymentSchedule->sz0031);
                                array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method1_1);
                            }
                            if (!in_array($paymentSchedule->sz0033,$initialPresentPMIdArr)){
                                array_push($initialPresentPMIdArr,$paymentSchedule->sz0033);
                                array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method2_1);
                            }
                            if (!in_array($paymentSchedule->sz0035,$initialPresentPMIdArr)){
                                array_push($initialPresentPMIdArr,$paymentSchedule->sz0035);
                                array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method3_1);
                            }*/
                        }
                        elseif ($radio_1==2){
                            /*if (!in_array($paymentSchedule->sz0025,$initialPresentPMIdArr)){
                                array_push($initialPresentPMIdArr,$paymentSchedule->sz0025);
                                array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method1);
                            }
                            if (!in_array($paymentSchedule->sz0027,$initialPresentPMIdArr)){
                                array_push($initialPresentPMIdArr,$paymentSchedule->sz0027);
                                array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method2);
                            }
                            if (!in_array($paymentSchedule->sz0029,$initialPresentPMIdArr)){
                                array_push($initialPresentPMIdArr,$paymentSchedule->sz0029);
                                array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method3);
                            }*/
                            if (!in_array($paymentSchedule->sz0031,$initialPresentPMIdArr)){
                                array_push($initialPresentPMIdArr,$paymentSchedule->sz0031);
                                array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method1_1);
                            }
                            if (!in_array($paymentSchedule->sz0033,$initialPresentPMIdArr)){
                                array_push($initialPresentPMIdArr,$paymentSchedule->sz0033);
                                array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method2_1);
                            }
                            if (!in_array($paymentSchedule->sz0035,$initialPresentPMIdArr)){
                                array_push($initialPresentPMIdArr,$paymentSchedule->sz0035);
                                array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method3_1);
                            }
                        }
                        elseif ($radio_1==3){
                            if (!in_array($paymentSchedule->sz0025,$initialPresentPMIdArr)){
                                array_push($initialPresentPMIdArr,$paymentSchedule->sz0025);
                                array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method1);
                            }
                            if (!in_array($paymentSchedule->sz0027,$initialPresentPMIdArr)){
                                array_push($initialPresentPMIdArr,$paymentSchedule->sz0027);
                                array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method2);
                            }
                            if (!in_array($paymentSchedule->sz0029,$initialPresentPMIdArr)){
                                array_push($initialPresentPMIdArr,$paymentSchedule->sz0029);
                                array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method3);
                            }
                            if (!in_array($paymentSchedule->sz0031,$initialPresentPMIdArr)){
                                array_push($initialPresentPMIdArr,$paymentSchedule->sz0031);
                                array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method1_1);
                            }
                            if (!in_array($paymentSchedule->sz0033,$initialPresentPMIdArr)){
                                array_push($initialPresentPMIdArr,$paymentSchedule->sz0033);
                                array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method2_1);
                            }
                            if (!in_array($paymentSchedule->sz0035,$initialPresentPMIdArr)){
                                array_push($initialPresentPMIdArr,$paymentSchedule->sz0035);
                                array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method3_1);
                            }
                        }
                    }
                }

                //for selected payment method which is not used
                if ($initialPresentPMIdArr==null){
                    array_push($initialPresentPMIdArr,$req_payment_method);
                    $key = array_search ($req_payment_method, $paymentMethodIdArr);
                    array_push($initialPresentPMNameArr,$paymentMethodNameArr[$key]);
                }

                foreach ($paymentMethodIdArr as $key=>$paymentMethodId){
                    //for used payment method only
                    if (in_array($paymentMethodId,$initialPresentPMIdArr)){
                        array_push($finalPresentPMIdArr,$paymentMethodId);
                        array_push($finalPresentPMNameArr,$paymentMethodNameArr[$key]);
                    }
                    //for all payment method (after spec understands)
                    /*array_push($finalPresentPMIdArr,$paymentMethodId);
                    array_push($finalPresentPMNameArr,$paymentMethodNameArr[$key]);*/
                }

//            dd($paymentMethodIdArr,$paymentMethodNameArr,$initialPresentPMIdArr,$finalPresentPMIdArr,$initialPresentPMNameArr,$finalPresentPMNameArr);

                //inserting extra row calculation starts here
                $finalPaymentAmountArr=[];

                foreach ($finalPresentPMIdArr as $finalPresentPMId){
                    $iniPaymentAmount=null;
                    foreach ($paymentSchedules as $paymentSchedule){
                        if ($radio_1==1){
                            if ($paymentSchedule->sz0025==$finalPresentPMId){
                                $iniPaymentAmount=$iniPaymentAmount+$paymentSchedule->purchase_payment_amount1_sort;
                            }
                            if ($paymentSchedule->sz0027==$finalPresentPMId){
                                $iniPaymentAmount=$iniPaymentAmount+$paymentSchedule->purchase_payment_amount2_sort;
                            }
                            if ($paymentSchedule->sz0029==$finalPresentPMId){
                                $iniPaymentAmount=$iniPaymentAmount+$paymentSchedule->purchase_payment_amount3_sort;
                            }
                            /*if ($paymentSchedule->sz0031==$finalPresentPMId){
                                $iniPaymentAmount=$iniPaymentAmount+$paymentSchedule->purchase_payment_amount1_1_sort;
                            }
                            if ($paymentSchedule->sz0033==$finalPresentPMId){
                                $iniPaymentAmount=$iniPaymentAmount+$paymentSchedule->purchase_payment_amount2_1_sort;
                            }
                            if ($paymentSchedule->sz0035==$finalPresentPMId){
                                $iniPaymentAmount=$iniPaymentAmount+$paymentSchedule->purchase_payment_amount3_1_sort;
                            }*/
                        }
                        elseif ($radio_1==2){
                            /*if ($paymentSchedule->sz0025==$finalPresentPMId){
                                $iniPaymentAmount=$iniPaymentAmount+$paymentSchedule->purchase_payment_amount1_sort;
                            }
                            if ($paymentSchedule->sz0027==$finalPresentPMId){
                                $iniPaymentAmount=$iniPaymentAmount+$paymentSchedule->purchase_payment_amount2_sort;
                            }
                            if ($paymentSchedule->sz0029==$finalPresentPMId){
                                $iniPaymentAmount=$iniPaymentAmount+$paymentSchedule->purchase_payment_amount3_sort;
                            }*/
                            if ($paymentSchedule->sz0031==$finalPresentPMId){
                                $iniPaymentAmount=$iniPaymentAmount+$paymentSchedule->purchase_payment_amount1_1_sort;
                            }
                            if ($paymentSchedule->sz0033==$finalPresentPMId){
                                $iniPaymentAmount=$iniPaymentAmount+$paymentSchedule->purchase_payment_amount2_1_sort;
                            }
                            if ($paymentSchedule->sz0035==$finalPresentPMId){
                                $iniPaymentAmount=$iniPaymentAmount+$paymentSchedule->purchase_payment_amount3_1_sort;
                            }
                        }
                        elseif ($radio_1==3){
                            if ($paymentSchedule->sz0025==$finalPresentPMId){
                                $iniPaymentAmount=$iniPaymentAmount+$paymentSchedule->purchase_payment_amount1_sort;
                            }
                            if ($paymentSchedule->sz0027==$finalPresentPMId){
                                $iniPaymentAmount=$iniPaymentAmount+$paymentSchedule->purchase_payment_amount2_sort;
                            }
                            if ($paymentSchedule->sz0029==$finalPresentPMId){
                                $iniPaymentAmount=$iniPaymentAmount+$paymentSchedule->purchase_payment_amount3_sort;
                            }
                            if ($paymentSchedule->sz0031==$finalPresentPMId){
                                $iniPaymentAmount=$iniPaymentAmount+$paymentSchedule->purchase_payment_amount1_1_sort;
                            }
                            if ($paymentSchedule->sz0033==$finalPresentPMId){
                                $iniPaymentAmount=$iniPaymentAmount+$paymentSchedule->purchase_payment_amount2_1_sort;
                            }
                            if ($paymentSchedule->sz0035==$finalPresentPMId){
                                $iniPaymentAmount=$iniPaymentAmount+$paymentSchedule->purchase_payment_amount3_1_sort;
                            }
                        }

                    }
                    $iniPaymentAmountNum= number_format($iniPaymentAmount);
                    array_push($finalPaymentAmountArr,$iniPaymentAmountNum);
                }

                //for selected payment method which is not used
                if ($finalPaymentAmountArr==null){
                    $finalPaymentAmountArr[0]=0;
                    $finalPaymentAmountArr[1]=0;
                }

                //counting sum
                $total_sum=null;
                foreach ($finalPaymentAmountArr as $finalPaymentAmount){
                    $total_sum=(int)$total_sum+(int)str_replace(',','',$finalPaymentAmount);
                }
                $final_sum=number_format($total_sum);
                //inserting extra row for each payment method
//                dd($finalPresentPMIdArr);
                foreach ($finalPresentPMIdArr as $key=>$finalPresentPMId){
                    if ($key==0){
                        //inserting total row
                        QueryHelper::runQuery("DROP TABLE IF EXISTS shiharaizandaka_extra_row_temp");
                        QueryHelper::runQuery("CREATE TEMPORARY TABLE shiharaizandaka_extra_row_temp AS
                            SELECT DISTINCT
                            NULL AS vendor,
                            NULL AS sz0001,
                            NULL AS sz0002,
                            NULL AS current_month_balance_sort,
                            NULL AS current_month_balance,
                            NULL AS payment_date_sort,
                            NULL AS payment_date,
                            NULL AS method_test,
                            NULL AS sz0025,
                            NULL AS sz0027,
                            NULL AS sz0029,
                            NULL AS sz0031,
                            NULL AS sz0033,
                            NULL AS sz0035,

                            NULL AS purchase_payment_method1,
                            NULL AS purchase_payment_amount1_sort,
                            NULL AS purchase_payment_amount1,
                            NULL AS purchase_payment_method2,
                            NULL AS purchase_payment_amount2_sort,
                            NULL AS purchase_payment_amount2,
                            NULL AS purchase_payment_method3,
                            NULL AS purchase_payment_amount3_sort,
                            NULL AS purchase_payment_amount3,
                            NULL AS purchase_payment_method1_1,
                            NULL AS purchase_payment_amount1_1_sort,
                            NULL AS purchase_payment_amount1_1,
                            NULL AS purchase_payment_method2_1,
                            NULL AS purchase_payment_amount2_1_sort,
                            NULL AS purchase_payment_amount2_1,
                            NULL AS purchase_payment_method3_1,
                            NULL AS purchase_payment_amount3_1_sort,
                            NULL AS purchase_payment_amount3_1,
                            NULL AS difference_sort,
                            NULL AS difference,
                            NULL AS bill_due_date_sort,
                            NULL AS bill_due_date,
                            '総計' AS payment_method,
                            NULL AS amount_sort,
                            '$final_sum' AS amount
                            FROM shiharaizandaka");
                        QueryHelper::runQuery("INSERT INTO payment_schedule_temp SELECT * FROM shiharaizandaka_extra_row_temp");

                        //inserting each payment method's sum row
                        QueryHelper::runQuery("DROP TABLE IF EXISTS shiharaizandaka_extra_row_temp");
                        QueryHelper::runQuery("CREATE TEMPORARY TABLE shiharaizandaka_extra_row_temp AS
                            SELECT DISTINCT
                            NULL AS vendor,
                            NULL AS sz0001,
                            NULL AS sz0002,
                            NULL AS current_month_balance_sort,
                            NULL AS current_month_balance,
                            NULL AS payment_date_sort,
                            NULL AS payment_date,
                            NULL AS method_test,
                            NULL AS sz0025,
                            NULL AS sz0027,
                            NULL AS sz0029,
                            NULL AS sz0031,
                            NULL AS sz0033,
                            NULL AS sz0035,

                            NULL AS purchase_payment_method1,
                            NULL AS purchase_payment_amount1_sort,
                            NULL AS purchase_payment_amount1,
                            NULL AS purchase_payment_method2,
                            NULL AS purchase_payment_amount2_sort,
                            NULL AS purchase_payment_amount2,
                            NULL AS purchase_payment_method3,
                            NULL AS purchase_payment_amount3_sort,
                            NULL AS purchase_payment_amount3,
                            NULL AS purchase_payment_method1_1,
                            NULL AS purchase_payment_amount1_1_sort,
                            NULL AS purchase_payment_amount1_1,
                            NULL AS purchase_payment_method2_1,
                            NULL AS purchase_payment_amount2_1_sort,
                            NULL AS purchase_payment_amount2_1,
                            NULL AS purchase_payment_method3_1,
                            NULL AS purchase_payment_amount3_1_sort,
                            NULL AS purchase_payment_amount3_1,
                            NULL AS difference_sort,
                            NULL AS difference,
                            NULL AS bill_due_date_sort,
                            NULL AS bill_due_date,
                            '$finalPresentPMNameArr[$key]' AS payment_method,
                            NULL AS amount_sort,
                            '$finalPaymentAmountArr[$key]' AS amount
                            FROM shiharaizandaka");
                        QueryHelper::runQuery("INSERT INTO payment_schedule_temp SELECT * FROM shiharaizandaka_extra_row_temp");
                    }
                    else{
                        //inserting each payment method's sum row
                        QueryHelper::runQuery("DROP TABLE IF EXISTS shiharaizandaka_extra_row_temp");
                        QueryHelper::runQuery("CREATE TEMPORARY TABLE shiharaizandaka_extra_row_temp AS
                            SELECT DISTINCT
                            NULL AS vendor,
                            NULL AS sz0001,
                            NULL AS sz0002,
                            NULL AS current_month_balance_sort,
                            NULL AS current_month_balance,
                            NULL AS payment_date_sort,
                            NULL AS payment_date,
                            NULL AS method_test,
                            NULL AS sz0025,
                            NULL AS sz0027,
                            NULL AS sz0029,
                            NULL AS sz0031,
                            NULL AS sz0033,
                            NULL AS sz0035,

                            NULL AS purchase_payment_method1,
                            NULL AS purchase_payment_amount1_sort,
                            NULL AS purchase_payment_amount1,
                            NULL AS purchase_payment_method2,
                            NULL AS purchase_payment_amount2_sort,
                            NULL AS purchase_payment_amount2,
                            NULL AS purchase_payment_method3,
                            NULL AS purchase_payment_amount3_sort,
                            NULL AS purchase_payment_amount3,
                            NULL AS purchase_payment_method1_1,
                            NULL AS purchase_payment_amount1_1_sort,
                            NULL AS purchase_payment_amount1_1,
                            NULL AS purchase_payment_method2_1,
                            NULL AS purchase_payment_amount2_1_sort,
                            NULL AS purchase_payment_amount2_1,
                            NULL AS purchase_payment_method3_1,
                            NULL AS purchase_payment_amount3_1_sort,
                            NULL AS purchase_payment_amount3_1,
                            NULL AS difference_sort,
                            NULL AS difference,
                            NULL AS bill_due_date_sort,
                            NULL AS bill_due_date,
                            '$finalPresentPMNameArr[$key]' AS payment_method,
                            NULL AS amount_sort,
                            '$finalPaymentAmountArr[$key]' AS amount
                            FROM shiharaizandaka");
                        QueryHelper::runQuery("INSERT INTO payment_schedule_temp SELECT * FROM shiharaizandaka_extra_row_temp");
                    }
                }
            }
            /*$sql = "DELETE FROM shiharaizandaka where sz0001::text LIKE '%2022-01-21 00:00:00%' and sz0002::text LIKE '%00010001%'";
            QueryHelper::runQuery($sql);*/
//            dd(QueryHelper::fetchResult("select * from payment_schedule_temp"),$time_sql1,$time_sql2,$information_sql,$req_payment_method);



            QueryHelper::fetchResult("select * from payment_schedule_temp");
            $search_sql = DB::table('payment_schedule_temp')->toSql();
//            dd('hlw');
        } catch (\Exception $e) {
            return 'ng';
//            dd($e);
        }
        return $search_sql;

    }
}
