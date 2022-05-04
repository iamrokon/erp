<?php

namespace App\AllClass\purchase\purchaseHistory;

use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AllPurchaseHistory
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

        $req_input_date_from=str_replace('/','',$allRequest['inputDateFrom']);
        $req_input_date_to=str_replace('/','',$allRequest['inputDateTo']);

        $req_purchase_date_from=str_replace('/','',$allRequest['purchaseDateFrom']);
        $req_purchase_date_to=str_replace('/','',$allRequest['purchaseDateTo']);

        if (!empty($allRequest['purchaseNoFrom'])) {
            $req_purchase_no_from = $allRequest['purchaseNoFrom'];
        } else {
            $req_purchase_no_from = null;
        }

        if (!empty($allRequest['purchaseNoTo'])) {
            $req_purchase_no_to = $allRequest['purchaseNoTo'];
        } else {
            $req_purchase_no_to = null;
        }

        if (!empty($allRequest['accountingSub'])) {
            $req_accounting_sub = $allRequest['accountingSub'];
        } else {
            $req_accounting_sub = null;
        }

        $radio_1 = !empty($allRequest['rd1']) ? $allRequest['rd1'] : null;
        $radio_2 = !empty($allRequest['rd2']) ? $allRequest['rd2'] : null;
        $radio_3 = !empty($allRequest['rd3']) ? $allRequest['rd3'] : null;

        //sql where condition creating

        $time_sql1 = '';
        if ($req_input_date_from == $req_input_date_to) {
            $time_sql1 .= " substring(toiawasebango_temp.datanum0012::text,1,8)  = '$req_input_date_from'";
        } elseif ($req_input_date_from < $req_input_date_to) {
            $time_sql1 .= " substring(toiawasebango_temp.datanum0012::text,1,8)::int between '$req_input_date_from' and '$req_input_date_to'";
        }

        $time_sql2 = '';
        if ($req_purchase_date_from == $req_purchase_date_to) {
            $time_sql2 .= " and substring(replace(toiawasebango_temp.touchakudate::text,'-',''),1,8)  = '$req_purchase_date_from'";
        } elseif ($req_purchase_date_from < $req_purchase_date_to) {
            $time_sql2 .= " and substring(replace(toiawasebango_temp.touchakudate::text,'-',''),1,8)::int between '$req_purchase_date_from' and '$req_purchase_date_to'";
        }
        //dd($time_sql1,$req_input_date_from,$req_input_date_to);
        $datatxt0003_sql = '';
        if ($req_division_start != '' && $req_division_end != '' && ($req_division_start != $req_division_end)) {

            $datatxt0003_sql .= " and substring(toiawasebango_temp.datatxt0003::text,1,2)='B9' AND right(toiawasebango_temp.datatxt0003::text,2) between '$req_division_start' and  '$req_division_end' ";
        } else {

            $datatxt0003_sql .= " and substring(toiawasebango_temp.datatxt0003::text,1,2)='B9' AND right(toiawasebango_temp.datatxt0003::text,2) = '$req_division_start'";
        }

        $datatxt0004_sql = '';
        if ($req_department_start != '' && $req_department_end != '' && ($req_department_start != $req_department_end)) {

            $datatxt0004_sql .= "  and substring(toiawasebango_temp.datatxt0004::text,1,2)='C1' AND right(toiawasebango_temp.datatxt0004::text,3) between '$req_department_start' and '$req_department_end'";
        } else if ($req_department_start != '') {

            $datatxt0004_sql .= "  and substring(toiawasebango_temp.datatxt0004::text,1,2)='C1' AND right(toiawasebango_temp.datatxt0004::text,3) = '$req_department_start'";
        }
        $datatxt0005_sql = '';
        if ($req_t_group_start != '' && $req_t_group_end != '' && ($req_t_group_start != $req_t_group_end)) {

            $datatxt0005_sql .= "  and substring(toiawasebango_temp.datatxt0005::text,1,2)='C2' AND right(toiawasebango_temp.datatxt0005::text ,4) between '$req_t_group_start' and '$req_t_group_end'";
        } else if ($req_t_group_start != '') {

            $datatxt0005_sql .= "  and substring(toiawasebango_temp.datatxt0005::text,1,2)='C2' AND right(toiawasebango_temp.datatxt0005::text ,4) = '$req_t_group_start'";
        }

        $datachar05_sql = '';
        if ($datachar05) {
            $datachar05_sql .= "  and toiawasebango_temp.touchakutime = '$datachar05'";

        }
        //dd($datatxt0003_sql,$datatxt0004_sql,$datatxt0005_sql,$datachar05_sql);
        $information_sql = '';
        if ($req_information1_short != '' && $req_information2_short != '' && ($req_information1_short != $req_information2_short)) {

            $information_sql .= " and toiawasebango_temp.bikou1::int between '$req_information1_short' and  '$req_information2_short' ";
        } else if ($req_information1_short != '') {

            $information_sql .=  "  and toiawasebango_temp.bikou1  = '$req_information1_short'";
        }else if ($req_information2_short != '') {

            $information_sql .=  "  and toiawasebango_temp.bikou1  = '$req_information2_short'";
        }

        $purchase_no_sql = '';
        if ($req_purchase_no_from != '' && $req_purchase_no_to != '' && ($req_purchase_no_from != $req_purchase_no_to)) {

            $purchase_no_sql .= " and toiawasebango_temp.unsoumei::bigint between '$req_purchase_no_from' and  '$req_purchase_no_to' ";
        } else if ($req_purchase_no_from != '') {

            $purchase_no_sql .=  "  and toiawasebango_temp.unsoumei::bigint  = '$req_purchase_no_from'";
        }else if ($req_purchase_no_to != '') {

            $purchase_no_sql .=  "  and toiawasebango_temp.unsoumei::bigint  = '$req_purchase_no_to'";
        }

        $accounting_sub_sql = '';
        if ($req_accounting_sub) {
            $accounting_sub_sql .= "  and nyukoold.barcode = '$req_accounting_sub'";

        }


        $radio_1_sql = '';
        $radio_2_sql = '';
        $radio_3_sql = '';
        if ($radio_1) {
            if ($radio_1=='1'){
                $radio_1_sql .= "  and toiawasebango_temp.datachar03 = '0'";
            }
            elseif($radio_1=='2'){
                $radio_1_sql .= "  and toiawasebango_temp.konpousu != 1 and toiawasebango_temp.datachar03 = '0'";
            }
            elseif($radio_1=='3'){
                $radio_1_sql .= " and toiawasebango_temp.datachar03 = '0'";
            }
        }
        if ($radio_2) {
            if ($radio_2=='1'){
                $radio_2_sql .= "  and  hikiatenyuko.datachar06 is null and hikiatenyuko.datachar07 is null";
            }
            elseif($radio_2=='2'){
                $radio_2_sql .= "  and hikiatenyuko.datachar06 is not null and hikiatenyuko.datachar07 is null";
            }
            elseif($radio_2=='3'){
                $radio_2_sql .= "  and hikiatenyuko.datachar07 is null";
            }
            elseif($radio_2=='4'){
                $radio_2_sql .= "  and hikiatenyuko.datachar07 is not null";
            }
        }
        if ($radio_3) {
            if ($radio_3=='1'){
                $radio_3_sql .= "  and toiawasebango_temp.toiawasebango not in  ('U670')";
            }
            elseif($radio_3=='2'){
                $radio_3_sql .= "  and toiawasebango_temp.toiawasebango = 'U670'";
            }
        }

        //dd($radio_1_sql,$radio_1);

        /*-----------------For aditional data information starts----------------*/

        QueryHelper::runQuery("DROP TABLE IF EXISTS v_torihikisaki_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE v_torihikisaki_temp AS
        SELECT DISTINCT ON (v_torihikisaki.torihikisaki_cd)
            v_torihikisaki.*
            FROM v_torihikisaki
        --where v_torihikisaki.torihikisaki_cd like '00014301001'
            ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS valid_request_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE valid_request_temp AS
            select distinct
            request.syouhinbango||' '||request.jouhou as data_valid,
            request.syouhinbango
            from request
            where color='0604データ有効区分'
            ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS purchased_request_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE purchased_request_temp AS
            select distinct
            request.syouhinbango||' '||request.jouhou as purchased_seg,
            request.syouhinbango
            from request
            where color='0604仕入済区分'
            ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS payment_request_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE payment_request_temp AS
            select distinct
            request.syouhinbango||' '||request.jouhou as payment_seg,
            request.syouhinbango
            from request
            where color='0604前払区分'
            ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS payment_flag_request_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE payment_flag_request_temp AS
            select distinct
            request.syouhinbango||' '||request.jouhou as payment_flag,
            request.syouhinbango
            from request
            where color='0604支払データ作成フラグ'
            ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS account_payable_flag_request_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE account_payable_flag_request_temp AS
            select distinct
            request.syouhinbango||' '||request.jouhou as account_payable,
            request.syouhinbango
            from request
            where color='0604買掛残高更新フラグ'
            ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_creation_request_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_creation_request_temp AS
            select distinct
            request.syouhinbango||' '||request.jouhou as purchase_creation,
            request.syouhinbango
            from request
            where color='0604仕入会計データ作成フェーズ'
            ");

        //dd(QueryHelper::fetchResult("select * from valid_request_temp"));

        /*-----------------For aditional data information ends----------------*/

        /*-------for orderhenkan.datachar10,orderhenkan.datachar11 starts-------*/

        /*-------for new way of fetching orderhenkan.datachar10,orderhenkan.datachar11 starts-------*/
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_temp_max");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_temp_max AS SELECT DISTINCT kokyakuorderbango, max (ordertypebango2) as max_orderhenkan_ordertypebango2 FROM orderhenkan WHERE synchroorderbango2='0' group by kokyakuorderbango order by kokyakuorderbango");

        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_temp1");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_temp1 AS
        select distinct
        orderhenkan.*
        from orderhenkan
        join orderhenkan_temp_max
        on orderhenkan_temp_max.kokyakuorderbango = orderhenkan.kokyakuorderbango
        and orderhenkan_temp_max.max_orderhenkan_ordertypebango2 = orderhenkan.ordertypebango2
        ");

         /*-------for new way of fetching orderhenkan.datachar10,orderhenkan.datachar11 ends-------*/

        QueryHelper::runQuery("DROP TABLE IF EXISTS nyukoold_temp1");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE nyukoold_temp1 AS
            select distinct
            nyukoold.*,
            orderhenkan.kokyakuorderbango,
            orderhenkan.orderuserbango,
            orderhenkan.ordertypebango2
            from nyukoold
            join orderhenkan
            on orderhenkan.kokyakuorderbango=nyukoold.idoutanabango
            ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_temp AS
            select distinct
            orderhenkan.*,
            nyukoold_temp1.idoutanabango,
            nyukoold_temp1.syouhinid
            from orderhenkan
            join nyukoold_temp1
            on nyukoold_temp1.orderuserbango=orderhenkan.kokyakuorderbango
            --where orderhenkan.datachar11 is not null
            ");
        //dd(QueryHelper::fetchResult("select * from orderhenkan_temp "));

        /*--------for orderhenkan.datachar10,orderhenkan.datachar11 ends---------*/

        /*--------------------for toiawasebango data starts----------------------*/
        if ($radio_1) {
            if ($radio_1=='1'){
                QueryHelper::runQuery("DROP TABLE IF EXISTS v_orderhenkan_shiirei_max_temp");
                QueryHelper::runQuery("CREATE TEMPORARY TABLE v_orderhenkan_shiirei_max_temp AS
                    select
                    unsoumei,
                    max(v_orderhenkan_shiirei.datanum0013) as max_datanum0013
                    from v_orderhenkan_shiirei
                    --where v_orderhenkan_shiirei.unsoumei = '0851000210'
                    group by unsoumei
                    order by v_orderhenkan_shiirei.unsoumei
                    ");
//                dd(QueryHelper::fetchResult("select * from v_orderhenkan_shiirei_max_temp "));
                QueryHelper::runQuery("DROP TABLE IF EXISTS toiawasebango_temp");
                QueryHelper::runQuery("CREATE TEMPORARY TABLE toiawasebango_temp AS
            select distinct on (v_orderhenkan_shiirei.unsoumei)
            v_orderhenkan_shiirei.*,
            orderhenkan_temp.datachar10,
            orderhenkan_temp.datachar11

            from v_orderhenkan_shiirei
            join v_orderhenkan_shiirei_max_temp
            on v_orderhenkan_shiirei_max_temp.unsoumei =  v_orderhenkan_shiirei.unsoumei
            and v_orderhenkan_shiirei_max_temp.max_datanum0013 =  v_orderhenkan_shiirei.datanum0013
            join orderhenkan_temp
            on orderhenkan_temp.syouhinid = v_orderhenkan_shiirei.unsoumei
            --where v_orderhenkan_shiirei.unsoumei = '0851000210'
            order by v_orderhenkan_shiirei.unsoumei
            ");
            }
            else if ($radio_1=='2'){
                QueryHelper::runQuery("DROP TABLE IF EXISTS toiawasebango_temp");
                QueryHelper::runQuery("CREATE TEMPORARY TABLE toiawasebango_temp AS
                select
                v_orderhenkan_shiirei.*,
                orderhenkan_temp.datachar10,
                orderhenkan_temp.datachar11

                from v_orderhenkan_shiirei
                join orderhenkan_temp
                on orderhenkan_temp.syouhinid = v_orderhenkan_shiirei.unsoumei
                order by v_orderhenkan_shiirei.unsoumei
                ");
            }
            else{
                QueryHelper::runQuery("DROP TABLE IF EXISTS nyukoold_temp");
                QueryHelper::runQuery("CREATE TEMPORARY TABLE nyukoold_temp AS
                --SELECT DISTINCT ON (nyukoold.syouhinid,nyukoold.syouhinsyu,hantei)
                SELECT
                    nyukoold.*
                    FROM nyukoold
                --where nyukoold.syouhinid like '0851000304'
                    ");
                QueryHelper::runQuery("DROP TABLE IF EXISTS toiawasebango_temp");
                QueryHelper::runQuery("CREATE TEMPORARY TABLE toiawasebango_temp AS
                    select distinct on (v_orderhenkan_shiirei.unsoumei,v_orderhenkan_shiirei.datanum0013)
                    v_orderhenkan_shiirei.*,
                    orderhenkan_temp.kokyakuorderbango as orderhenkan_kokyakuorderbango,
                    orderhenkan_temp.datachar10,
                    orderhenkan_temp.datachar11

                    from v_orderhenkan_shiirei
                    join orderhenkan_temp
                    on orderhenkan_temp.syouhinid = v_orderhenkan_shiirei.unsoumei
                    --where v_orderhenkan_shiirei.unsoumei = '0851000582'
                    order by v_orderhenkan_shiirei.unsoumei,v_orderhenkan_shiirei.datanum0013
                    ");
            }
        }
        //dd($radio_1,QueryHelper::fetchResult("select * from nyukoold_temp "),QueryHelper::fetchResult("select * from toiawasebango_temp "));

        /*--------------------for toiawasebango data ends----------------------*/


        /*--------------------searched data fetching starts----------------------*/
        if ($radio_1=='1' || $radio_1=='2'){
            QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_history_temp1");
            QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_history_temp");
            /*QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_history_temp as
                select distinct on (nyukoold.syouhinid,nyukoold.syouhinsyu)
                --nyukoold.syouhinsyu::int as line_no,
                toiawasebango_temp.bikou1 as supplier_cd,
                --v_torihikisaki_contractor.r16cd as  supplier,
                --categorykanri_classification.category2 ||' '|| categorykanri_classification.category4 as classification,
                toiawasebango_temp.unsoumei as purchase_no,
                --REPLACE(substring(CAST(toiawasebango_temp.touchakudate AS text),1,10),'-','/') as purchase_date,
                --substring(replace(toiawasebango_temp.touchakudate::text,'-',''),1,8)::int as  purchase_date_sort,
                toiawasebango_temp.touchakudate as purchase_date_time,
                --case
                    --when (hikiatenyuko.datachar06 is null and hikiatenyuko.datachar07 is null )
                    --then '仮引当'
                    --when (hikiatenyuko.datachar06 is not null and hikiatenyuko.datachar07 is null)
                    --then '指示済'
                    --when (hikiatenyuko.datachar06 is not null and hikiatenyuko.datachar07 is not null)
                    --then '検印済' else null end as finger_test_information,
                --case
                    --when (hikiatenyuko.datachar06 is null and hikiatenyuko.datachar07 is null )
                    --then '1'
                    --when (hikiatenyuko.datachar06 is not null and hikiatenyuko.datachar07 is null)
                    --then '2'
                    --when (hikiatenyuko.datachar06 is not null and hikiatenyuko.datachar07 is not null)
                    --then '3' else null end as finger_test_information_condition,

                --hikiatenyuko.datachar06 as instructions_check,
                --hikiatenyuko.datachar07 as stamp_check,

                toiawasebango_temp.dataint03 as purchase_history_amount_sort,
                to_char(toiawasebango_temp.dataint03,'FM99,999,999,999,999') as purchase_history_amount,
                --nyukoold.idoutanabango as order_number,
                toiawasebango_temp.datachar10 as order_to_cd,
                --v_torihikisaki_orderTo.r17_4cd as order_to,
                toiawasebango_temp.datachar11 as end_customer_cd,
                --v_torihikisaki_endCustomer.r17_4cd as end_customer,
                --nyukoold.barcode as accounting_subject_CD,
                --categorykanri_accounting.category2 ||' '|| categorykanri_accounting.category4 as accounting_subject,
                --nyukoold.codename as breakdown_CD,
                --categorykanri_breakdown.category2 ||' '|| categorykanri_breakdown.category4 as breakdown,

                toiawasebango_temp.toiawasebango as purchase_category_CD,
                --categorykanri_purchase_category.category2 ||' '|| categorykanri_purchase_category.category4 as purchase_category,
                toiawasebango_temp.konpousu as creation_division,
                toiawasebango_temp.touchakutime as purchaser_CD,
                --tantousya_puchaser.bango ||' '|| tantousya_puchaser.name as purchaser,
                toiawasebango_temp.denpyoname as invoice_number,
                toiawasebango_temp.dataint01 as invoice_date_sort,
                --concat_ws('/',substring(CAST(toiawasebango_temp.dataint01 as text),1,4),substring(CAST(toiawasebango_temp.dataint01 as text),5,2),substring(CAST(toiawasebango_temp.dataint01 as text),7,2)) as invoice_date,
                toiawasebango_temp.bikou2 as slip_remarks,
                toiawasebango_temp.dataint02 as payment_date_sort,
                --concat_ws('/',substring(CAST(toiawasebango_temp.dataint02 as text),1,4),substring(CAST(toiawasebango_temp.dataint02 as text),5,2),substring(CAST(toiawasebango_temp.dataint02 as text),7,2)) as payment_date,
                toiawasebango_temp.datanum0001 as purchase_consumption_tax_amount_sort,
                to_char(toiawasebango_temp.datanum0001,'FM99,999,999,999,999') as purchase_consumption_tax_amount,
                toiawasebango_temp.datanum0002 as purchase_history_creation_flag,
                toiawasebango_temp.datanum0008 as spare1,
                toiawasebango_temp.datanum0009 as spare2,
                toiawasebango_temp.datanum0010 as spare3,
                toiawasebango_temp.datanum0011 as spare4,
                toiawasebango_temp.datachar01 as spare5,
                toiawasebango_temp.datachar02 as spare6,
                --valid_request_temp.data_valid as data_valid_segment,
                substring (cast(toiawasebango_temp.datanum0012 as text),1,8)::int as registration_date_sort,
                concat_ws('/',substring(CAST(toiawasebango_temp.datanum0012 as text),1,4),substring(CAST(toiawasebango_temp.datanum0012 as text),5,2),substring(CAST(toiawasebango_temp.datanum0012 as text),7,2)) as registration_date,
                --substring (cast(toiawasebango_temp.datanum0012 as text),9,6)::int as registration_time_sort,
                concat_ws(':',substring(CAST(toiawasebango_temp.datanum0012 as text),9,2),substring(CAST(toiawasebango_temp.datanum0012 as text),11,2),substring(CAST(toiawasebango_temp.datanum0012 as text),13,2)) as registration_time,
                toiawasebango_temp.datatxt0001 as updater_bango,
                --tantousya_updater.bango ||' '|| tantousya_updater.name as updater,
                toiawasebango_temp.datanum0013 as number_of_corrections,
                case
                    when toiawasebango_temp.datanum0014 is not null
                    then concat_ws('/',substring(CAST(toiawasebango_temp.datanum0014 as text),1,4),substring(CAST(toiawasebango_temp.datanum0014 as text),5,2),substring(CAST(toiawasebango_temp.datanum0014 as text),7,2))
                    else null end as payment_closing_date,
                toiawasebango_temp.datanum0014 as payment_closing_date_sort,
                toiawasebango_temp.datanum0015 as consumption_tax_paid_sort,
                to_char(toiawasebango_temp.datanum0015,'FM99,999,999,999,999') as consumption_tax_paid,
                --purchased_request_temp.purchased_seg as purchased_segment,
                --payment_request_temp.payment_seg as prepayment_segment,
                case
                    when toiawasebango_temp.datanum0016 is not null
                    then concat_ws('/',substring(CAST(toiawasebango_temp.datanum0016 as text),1,4),substring(CAST(toiawasebango_temp.datanum0016 as text),5,2),substring(CAST(toiawasebango_temp.datanum0016 as text),7,2))
                    else null end as provisional_purchase_date,
                substring(toiawasebango_temp.datanum0016::text,1,8)::int as provisional_purchase_date_sort
                --payment_flag_request_temp.payment_flag as payment_data_creation_flag,
                --account_payable_flag_request_temp.account_payable as accounts_payable_update_flag,
                --hikiatenyuko.datachar06 as purchase_orderer_bango,
                --tantousya_orderer.bango ||' '|| tantousya_orderer.name as purchase_orderer,
                --tantousya_seal_holder.bango ||' '|| tantousya_seal_holder.name as purchase_seal_holder,
                --hikiatenyuko.datachar07 as purchase_seal_holder_bango,
                --purchase_creation_request_temp.purchase_creation as accounting_data_creation_phase,
                --hikiatenyuko.dataint02 as flag_reserve1


                from toiawasebango_temp

                join nyukoold
                on nyukoold.syouhinid = toiawasebango_temp.unsoumei

                left join hikiatenyuko
                on hikiatenyuko.syouhinid =  nyukoold.syouhinid

                --left join v_torihikisaki_temp as  v_torihikisaki_contractor
                --on substring (v_torihikisaki_contractor.torihikisaki_cd,1,8) = toiawasebango_temp.bikou1

                --left join v_torihikisaki_temp as  v_torihikisaki_orderTo
                --on v_torihikisaki_orderTo.torihikisaki_cd = toiawasebango_temp.datachar10

                --left join v_torihikisaki_temp as  v_torihikisaki_endCustomer
                --on v_torihikisaki_endCustomer.torihikisaki_cd = toiawasebango_temp.datachar11

                --left join categorykanri as categorykanri_classification
                --on categorykanri_classification.category1||categorykanri_classification.category2 = toiawasebango_temp.toiawasebango

                --left join categorykanri as categorykanri_accounting
                --on categorykanri_accounting.category1||categorykanri_accounting.category2 = nyukoold.barcode

                --left join categorykanri as categorykanri_breakdown
                --on categorykanri_breakdown.category1||categorykanri_breakdown.category2 = nyukoold.codename

                --left join categorykanri as categorykanri_purchase_category
                --on categorykanri_purchase_category.category1||categorykanri_purchase_category.category2 = toiawasebango_temp.toiawasebango

                --left join tantousya as tantousya_puchaser
                --on tantousya_puchaser.bango = toiawasebango_temp.touchakutime

                --left join tantousya as tantousya_updater
                --on tantousya_updater.bango = toiawasebango_temp.datatxt0001

                --left join tantousya as tantousya_orderer
                --on tantousya_orderer.bango = hikiatenyuko.datachar06

                --left join tantousya as tantousya_seal_holder
                --on tantousya_seal_holder.bango = hikiatenyuko.datachar07

                --left join valid_request_temp
                --on valid_request_temp.syouhinbango = toiawasebango_temp.datachar03::int

                --left join purchased_request_temp
                --on purchased_request_temp.syouhinbango = toiawasebango_temp.datatxt0002::int

                --left join payment_request_temp
                --on payment_request_temp.syouhinbango = toiawasebango_temp.datatxt0019::int

                --left join payment_flag_request_temp
                --on payment_flag_request_temp.syouhinbango = hikiatenyuko.syouhinsyu

                --left join account_payable_flag_request_temp
                --on account_payable_flag_request_temp.syouhinbango = hikiatenyuko.hantei

                --left join purchase_creation_request_temp
                --on purchase_creation_request_temp.syouhinbango = hikiatenyuko.dataint01

                where toiawasebango_temp.unsoumei = '0851000210' and  $time_sql1 $time_sql2 $datatxt0003_sql $datatxt0004_sql $datatxt0005_sql $datachar05_sql $information_sql $purchase_no_sql $accounting_sub_sql $radio_1_sql $radio_2_sql $radio_3_sql

                --order by nyukoold.syouhinid,nyukoold.syouhinsyu
                ");*/
            QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_history_temp1 as
                select distinct on (nyukoold.syouhinid,nyukoold.syouhinsyu)
                nyukoold.syouhinsyu::int as line_no,
                toiawasebango_temp.bikou1 as supplier_cd,
                v_torihikisaki_contractor.r16cd as  supplier,
                categorykanri_classification.category2 ||' '|| categorykanri_classification.category4 as classification,
                toiawasebango_temp.unsoumei as purchase_no,
                REPLACE(substring(CAST(toiawasebango_temp.touchakudate AS text),1,10),'-','/') as purchase_date,
                substring(replace(toiawasebango_temp.touchakudate::text,'-',''),1,8)::int as  purchase_date_sort,
                toiawasebango_temp.touchakudate as purchase_date_time,
                case
                    when (hikiatenyuko.datachar06 is null and hikiatenyuko.datachar07 is null )
                    then '仮引当'
                    when (hikiatenyuko.datachar06 is not null and hikiatenyuko.datachar07 is null)
                    then '指示済'
                    when (hikiatenyuko.datachar06 is not null and hikiatenyuko.datachar07 is not null)
                    then '検印済' else null end as finger_test_information,
                case
                    when (hikiatenyuko.datachar06 is null and hikiatenyuko.datachar07 is null )
                    then '1'
                    when (hikiatenyuko.datachar06 is not null and hikiatenyuko.datachar07 is null)
                    then '2'
                    when (hikiatenyuko.datachar06 is not null and hikiatenyuko.datachar07 is not null)
                    then '3' else null end as finger_test_information_condition,

                hikiatenyuko.datachar06 as instructions_check,
                hikiatenyuko.datachar07 as stamp_check,

                toiawasebango_temp.dataint03 as purchase_history_amount_sort,
                to_char(toiawasebango_temp.dataint03,'FM99,999,999,999,999') as purchase_history_amount,
                nyukoold.idoutanabango as order_number,
                --toiawasebango_temp.datachar10 as order_to_cd,
                --toiawasebango_temp.datachar11 as end_customer_cd,
                --v_torihikisaki_orderTo.r17_4cd as order_to,
                --v_torihikisaki_endCustomer.r17_4cd as end_customer,
                orderhenkan_temp1.datachar10 as order_to_cd,
                orderhenkan_temp1.datachar11 as end_customer_cd,
                nyukoold.barcode as accounting_subject_CD,
                categorykanri_accounting.category2 ||' '|| categorykanri_accounting.category4 as accounting_subject,
                nyukoold.codename as breakdown_CD,
                categorykanri_breakdown.category2 ||' '|| categorykanri_breakdown.category4 as breakdown,

                toiawasebango_temp.toiawasebango as purchase_category_CD,
                categorykanri_purchase_category.category2 ||' '|| categorykanri_purchase_category.category4 as purchase_category,
                toiawasebango_temp.konpousu as creation_division,
                toiawasebango_temp.touchakutime as purchaser_CD,
                tantousya_puchaser.bango ||' '|| tantousya_puchaser.name as purchaser,
                toiawasebango_temp.denpyoname as invoice_number,
                toiawasebango_temp.dataint01 as invoice_date_sort,
                concat_ws('/',substring(CAST(toiawasebango_temp.dataint01 as text),1,4),substring(CAST(toiawasebango_temp.dataint01 as text),5,2),substring(CAST(toiawasebango_temp.dataint01 as text),7,2)) as invoice_date,
                toiawasebango_temp.bikou2 as slip_remarks,
                toiawasebango_temp.dataint02 as payment_date_sort,
                concat_ws('/',substring(CAST(toiawasebango_temp.dataint02 as text),1,4),substring(CAST(toiawasebango_temp.dataint02 as text),5,2),substring(CAST(toiawasebango_temp.dataint02 as text),7,2)) as payment_date,
                toiawasebango_temp.datanum0001 as purchase_consumption_tax_amount_sort,
                to_char(toiawasebango_temp.datanum0001,'FM99,999,999,999,999') as purchase_consumption_tax_amount,
                toiawasebango_temp.datanum0002 as purchase_history_creation_flag,
                toiawasebango_temp.datanum0008 as spare1,
                toiawasebango_temp.datanum0009 as spare2,
                toiawasebango_temp.datanum0010 as spare3,
                toiawasebango_temp.datanum0011 as spare4,
                toiawasebango_temp.datachar01 as spare5,
                toiawasebango_temp.datachar02 as spare6,
                valid_request_temp.data_valid as data_valid_segment,
                substring (cast(toiawasebango_temp.datanum0012 as text),1,8)::int as registration_date_sort,
                concat_ws('/',substring(CAST(toiawasebango_temp.datanum0012 as text),1,4),substring(CAST(toiawasebango_temp.datanum0012 as text),5,2),substring(CAST(toiawasebango_temp.datanum0012 as text),7,2)) as registration_date,
                substring (cast(toiawasebango_temp.datanum0012 as text),9,6)::int as registration_time_sort,
                concat_ws(':',substring(CAST(toiawasebango_temp.datanum0012 as text),9,2),substring(CAST(toiawasebango_temp.datanum0012 as text),11,2),substring(CAST(toiawasebango_temp.datanum0012 as text),13,2)) as registration_time,
                toiawasebango_temp.datatxt0001 as updater_bango,
                tantousya_updater.bango ||' '|| tantousya_updater.name as updater,
                toiawasebango_temp.datanum0013 as number_of_corrections,
                case
                    when toiawasebango_temp.datanum0014 is not null
                    then concat_ws('/',substring(CAST(toiawasebango_temp.datanum0014 as text),1,4),substring(CAST(toiawasebango_temp.datanum0014 as text),5,2),substring(CAST(toiawasebango_temp.datanum0014 as text),7,2))
                    else null end as payment_closing_date,
                toiawasebango_temp.datanum0014 as payment_closing_date_sort,
                toiawasebango_temp.datanum0015 as consumption_tax_paid_sort,
                to_char(toiawasebango_temp.datanum0015,'FM99,999,999,999,999') as consumption_tax_paid,
                purchased_request_temp.purchased_seg as purchased_segment,
                payment_request_temp.payment_seg as prepayment_segment,
                case
                    when toiawasebango_temp.datanum0016 is not null
                    then concat_ws('/',substring(CAST(toiawasebango_temp.datanum0016 as text),1,4),substring(CAST(toiawasebango_temp.datanum0016 as text),5,2),substring(CAST(toiawasebango_temp.datanum0016 as text),7,2))
                    else null end as provisional_purchase_date,
                substring(toiawasebango_temp.datanum0016::text,1,8)::int as provisional_purchase_date_sort,
                payment_flag_request_temp.payment_flag as payment_data_creation_flag,
                account_payable_flag_request_temp.account_payable as accounts_payable_update_flag,
                hikiatenyuko.datachar06 as purchase_orderer_bango,
                tantousya_orderer.bango ||' '|| tantousya_orderer.name as purchase_orderer,
                tantousya_seal_holder.bango ||' '|| tantousya_seal_holder.name as purchase_seal_holder,
                hikiatenyuko.datachar07 as purchase_seal_holder_bango,
                purchase_creation_request_temp.purchase_creation as accounting_data_creation_phase,
                hikiatenyuko.dataint02 as flag_reserve1


                from toiawasebango_temp

                join nyukoold
                on nyukoold.syouhinid = toiawasebango_temp.unsoumei

                --left join hikiatenyuko
                --on hikiatenyuko.syouhinid =  nyukoold.syouhinid

                join hikiatenyuko
                on hikiatenyuko.syouhinid =  nyukoold.syouhinid

                left join v_torihikisaki_temp as  v_torihikisaki_contractor
                on substring (v_torihikisaki_contractor.torihikisaki_cd,1,8) = toiawasebango_temp.bikou1

                --left join v_torihikisaki_temp as  v_torihikisaki_orderTo
                --on v_torihikisaki_orderTo.torihikisaki_cd = toiawasebango_temp.datachar10

                --left join v_torihikisaki_temp as  v_torihikisaki_endCustomer
                --on v_torihikisaki_endCustomer.torihikisaki_cd = toiawasebango_temp.datachar11

                left join categorykanri as categorykanri_classification
                on categorykanri_classification.category1||categorykanri_classification.category2 = toiawasebango_temp.toiawasebango

                left join categorykanri as categorykanri_accounting
                on categorykanri_accounting.category1||categorykanri_accounting.category2 = nyukoold.barcode

                left join categorykanri as categorykanri_breakdown
                on categorykanri_breakdown.category1||categorykanri_breakdown.category2 = nyukoold.codename

                left join categorykanri as categorykanri_purchase_category
                on categorykanri_purchase_category.category1||categorykanri_purchase_category.category2 = toiawasebango_temp.toiawasebango

                left join tantousya as tantousya_puchaser
                on tantousya_puchaser.bango = toiawasebango_temp.touchakutime

                left join tantousya as tantousya_updater
                on tantousya_updater.bango = toiawasebango_temp.datatxt0001

                left join tantousya as tantousya_orderer
                on tantousya_orderer.bango = hikiatenyuko.datachar06

                left join tantousya as tantousya_seal_holder
                on tantousya_seal_holder.bango = hikiatenyuko.datachar07

                left join valid_request_temp
                on valid_request_temp.syouhinbango = toiawasebango_temp.datachar03::int

                left join purchased_request_temp
                on purchased_request_temp.syouhinbango = toiawasebango_temp.datatxt0002::int

                left join payment_request_temp
                on payment_request_temp.syouhinbango = toiawasebango_temp.datatxt0019::int

                left join payment_flag_request_temp
                on payment_flag_request_temp.syouhinbango = hikiatenyuko.syouhinsyu

                left join account_payable_flag_request_temp
                on account_payable_flag_request_temp.syouhinbango = hikiatenyuko.hantei

                left join purchase_creation_request_temp
                on purchase_creation_request_temp.syouhinbango = hikiatenyuko.dataint01

                left join orderhenkan_temp1
                on orderhenkan_temp1.kokyakuorderbango = nyukoold.idoutanabango

                where  $time_sql1 $time_sql2 $datatxt0003_sql $datatxt0004_sql $datatxt0005_sql $datachar05_sql $information_sql $purchase_no_sql $accounting_sub_sql $radio_1_sql $radio_2_sql $radio_3_sql

                order by nyukoold.syouhinid,nyukoold.syouhinsyu
                ");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_history_temp as
                select
                purchase_history_temp1.*,
                v_torihikisaki_orderTo.r17_4cd as order_to,
                v_torihikisaki_endCustomer.r17_4cd as end_customer

                from purchase_history_temp1

                left join v_torihikisaki_temp as  v_torihikisaki_orderTo
                on v_torihikisaki_orderTo.torihikisaki_cd = purchase_history_temp1.order_to_cd

                left join v_torihikisaki_temp as  v_torihikisaki_endCustomer
                on v_torihikisaki_endCustomer.torihikisaki_cd = purchase_history_temp1.end_customer_cd

                ");
        }
        else{
            QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_history_temp_before");
            QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_history_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_history_temp_before as
                --select distinct on (nyukoold_temp.syouhinid,nyukoold_temp.syouhinsyu)
                select
                nyukoold_temp.syouhinid,
                nyukoold_temp.syouhinsyu::int as line_no,
                toiawasebango_temp.datanum0013 as number_of_corrections,
                toiawasebango_temp.bikou1 as supplier_cd,
                toiawasebango_temp.unsoumei as purchase_no,
                REPLACE(substring(CAST(toiawasebango_temp.touchakudate AS text),1,10),'-','/') as purchase_date,
                substring(replace(toiawasebango_temp.touchakudate::text,'-',''),1,8)::int as  purchase_date_sort,
                toiawasebango_temp.touchakudate as purchase_date_time,
                case
                    when (hikiatenyuko.datachar06 is null and hikiatenyuko.datachar07 is null )
                    then '仮引当'
                    when (hikiatenyuko.datachar06 is not null and hikiatenyuko.datachar07 is null)
                    then '指示済'
                    when (hikiatenyuko.datachar06 is not null and hikiatenyuko.datachar07 is not null)
                    then '検印済' else null end as finger_test_information,
                case
                    when (hikiatenyuko.datachar06 is null and hikiatenyuko.datachar07 is null )
                    then '1'
                    when (hikiatenyuko.datachar06 is not null and hikiatenyuko.datachar07 is null)
                    then '2'
                    when (hikiatenyuko.datachar06 is not null and hikiatenyuko.datachar07 is not null)
                    then '3' else null end as finger_test_information_condition,

                hikiatenyuko.datachar06 as instructions_check,
                hikiatenyuko.datachar07 as stamp_check,

                toiawasebango_temp.dataint03 as purchase_history_amount_sort,
                to_char(toiawasebango_temp.dataint03,'FM99,999,999,999,999') as purchase_history_amount,
                nyukoold_temp.idoutanabango as order_number,
                toiawasebango_temp.orderhenkan_kokyakuorderbango,
                --toiawasebango_temp.datachar10 as order_to_cd,
                --toiawasebango_temp.datachar11 as end_customer_cd,
                orderhenkan_temp1.datachar10 as order_to_cd,
                orderhenkan_temp1.datachar11 as end_customer_cd,
                nyukoold_temp.barcode as accounting_subject_CD,
                nyukoold_temp.codename as breakdown_CD,

                toiawasebango_temp.toiawasebango as purchase_category_CD,
                toiawasebango_temp.konpousu as creation_division,
                toiawasebango_temp.touchakutime as purchaser_CD,
                toiawasebango_temp.denpyoname as invoice_number,
                toiawasebango_temp.dataint01 as invoice_date_sort,
                concat_ws('/',substring(CAST(toiawasebango_temp.dataint01 as text),1,4),substring(CAST(toiawasebango_temp.dataint01 as text),5,2),substring(CAST(toiawasebango_temp.dataint01 as text),7,2)) as invoice_date,
                toiawasebango_temp.bikou2 as slip_remarks,
                toiawasebango_temp.dataint02 as payment_date_sort,
                concat_ws('/',substring(CAST(toiawasebango_temp.dataint02 as text),1,4),substring(CAST(toiawasebango_temp.dataint02 as text),5,2),substring(CAST(toiawasebango_temp.dataint02 as text),7,2)) as payment_date,
                toiawasebango_temp.datanum0001 as purchase_consumption_tax_amount_sort,
                to_char(toiawasebango_temp.datanum0001,'FM99,999,999,999,999') as purchase_consumption_tax_amount,
                toiawasebango_temp.datanum0002 as purchase_history_creation_flag,
                toiawasebango_temp.datanum0008 as spare1,
                toiawasebango_temp.datanum0009 as spare2,
                toiawasebango_temp.datanum0010 as spare3,
                toiawasebango_temp.datanum0011 as spare4,
                toiawasebango_temp.datachar01 as spare5,
                toiawasebango_temp.datachar02 as spare6,
                substring (cast(toiawasebango_temp.datanum0012 as text),1,8)::int as registration_date_sort,
                concat_ws('/',substring(CAST(toiawasebango_temp.datanum0012 as text),1,4),substring(CAST(toiawasebango_temp.datanum0012 as text),5,2),substring(CAST(toiawasebango_temp.datanum0012 as text),7,2)) as registration_date,
                substring (cast(toiawasebango_temp.datanum0012 as text),9,6)::int as registration_time_sort,
                concat_ws(':',substring(CAST(toiawasebango_temp.datanum0012 as text),9,2),substring(CAST(toiawasebango_temp.datanum0012 as text),11,2),substring(CAST(toiawasebango_temp.datanum0012 as text),13,2)) as registration_time,
                toiawasebango_temp.datatxt0001 as updater_bango,
                case
                    when toiawasebango_temp.datanum0014 is not null
                    then concat_ws('/',substring(CAST(toiawasebango_temp.datanum0014 as text),1,4),substring(CAST(toiawasebango_temp.datanum0014 as text),5,2),substring(CAST(toiawasebango_temp.datanum0014 as text),7,2))
                    else null end as payment_closing_date,
                toiawasebango_temp.datanum0014 as payment_closing_date_sort,
                toiawasebango_temp.datanum0015 as consumption_tax_paid_sort,
                to_char(toiawasebango_temp.datanum0015,'FM99,999,999,999,999') as consumption_tax_paid,
                case
                    when toiawasebango_temp.datanum0016 is not null
                    then concat_ws('/',substring(CAST(toiawasebango_temp.datanum0016 as text),1,4),substring(CAST(toiawasebango_temp.datanum0016 as text),5,2),substring(CAST(toiawasebango_temp.datanum0016 as text),7,2))
                    else null end as provisional_purchase_date,
                substring(toiawasebango_temp.datanum0016::text,1,8)::int as provisional_purchase_date_sort,
                hikiatenyuko.datachar06 as purchase_orderer_bango,
                hikiatenyuko.datachar07 as purchase_seal_holder_bango,
                toiawasebango_temp.datachar03::int as toiawasebango_temp_datachar03,
                toiawasebango_temp.datatxt0002::int as toiawasebango_temp_datatxt0002,
                toiawasebango_temp.datatxt0019::int as toiawasebango_temp_datatxt0019,
                hikiatenyuko.syouhinsyu as hikiatenyuko_syouhinsyu,
                hikiatenyuko.hantei as hikiatenyuko_hantei,
                hikiatenyuko.dataint01 as hikiatenyuko_dataint01,
                hikiatenyuko.dataint02 as flag_reserve1


                from toiawasebango_temp

                right join nyukoold_temp
                on nyukoold_temp.syouhinid = toiawasebango_temp.unsoumei
                and nyukoold_temp.zaikometer = toiawasebango_temp.datanum0013

                join hikiatenyuko
                on hikiatenyuko.syouhinid =  nyukoold_temp.syouhinid

                left join orderhenkan_temp1
                on orderhenkan_temp1.kokyakuorderbango = nyukoold_temp.idoutanabango

                where  $time_sql1 $time_sql2 $datatxt0003_sql $datatxt0004_sql $datatxt0005_sql $datachar05_sql $information_sql $purchase_no_sql $accounting_sub_sql $radio_1_sql $radio_2_sql $radio_3_sql


                order by nyukoold_temp.syouhinid,nyukoold_temp.syouhinsyu
                ");
            //dd(QueryHelper::fetchResult("select * from purchase_history_temp_before"),QueryHelper::fetchResult("select * from v_torihikisaki_temp"),$time_sql1, $time_sql2, $datatxt0003_sql, $datatxt0004_sql, $datatxt0005_sql, $datachar05_sql, $information_sql, $purchase_no_sql, $accounting_sub_sql, $radio_1_sql, $radio_2_sql, $radio_3_sql);
            QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_history_temp as
                select
                purchase_history_temp_before.*,
                v_torihikisaki_contractor.r16cd as  supplier,
                v_torihikisaki_orderTo.r17_4cd as order_to,
                v_torihikisaki_endCustomer.r17_4cd as end_customer,
                categorykanri_classification.category2 ||' '|| categorykanri_classification.category4 as classification,
                categorykanri_accounting.category2 ||' '|| categorykanri_accounting.category4 as accounting_subject,
                categorykanri_breakdown.category2 ||' '|| categorykanri_breakdown.category4 as breakdown,
                categorykanri_purchase_category.category2 ||' '|| categorykanri_purchase_category.category4 as purchase_category,
                tantousya_puchaser.bango ||' '|| tantousya_puchaser.name as purchaser,
                tantousya_updater.bango ||' '|| tantousya_updater.name as updater,
                tantousya_orderer.bango ||' '|| tantousya_orderer.name as purchase_orderer,
                tantousya_seal_holder.bango ||' '|| tantousya_seal_holder.name as purchase_seal_holder,
                valid_request_temp.data_valid as data_valid_segment,
                purchased_request_temp.purchased_seg as purchased_segment,
                payment_request_temp.payment_seg as prepayment_segment,
                payment_flag_request_temp.payment_flag as payment_data_creation_flag,
                account_payable_flag_request_temp.account_payable as accounts_payable_update_flag,
                purchase_creation_request_temp.purchase_creation as accounting_data_creation_phase


                from purchase_history_temp_before

                left join v_torihikisaki_temp as  v_torihikisaki_contractor
                on substring (v_torihikisaki_contractor.torihikisaki_cd,1,8) = purchase_history_temp_before.supplier_cd

                left join v_torihikisaki_temp as  v_torihikisaki_orderTo
                on v_torihikisaki_orderTo.torihikisaki_cd = purchase_history_temp_before.order_to_cd

                left join v_torihikisaki_temp as  v_torihikisaki_endCustomer
                on v_torihikisaki_endCustomer.torihikisaki_cd = purchase_history_temp_before.end_customer_cd

                left join categorykanri as categorykanri_classification
                on categorykanri_classification.category1||categorykanri_classification.category2 = purchase_history_temp_before.purchase_category_CD

                left join categorykanri as categorykanri_accounting
                on categorykanri_accounting.category1||categorykanri_accounting.category2 = purchase_history_temp_before.accounting_subject_CD

                left join categorykanri as categorykanri_breakdown
                on categorykanri_breakdown.category1||categorykanri_breakdown.category2 = purchase_history_temp_before.breakdown_CD

                left join categorykanri as categorykanri_purchase_category
                on categorykanri_purchase_category.category1||categorykanri_purchase_category.category2 = purchase_history_temp_before.purchase_category_CD

                left join tantousya as tantousya_puchaser
                on tantousya_puchaser.bango = purchase_history_temp_before.purchaser_CD

                left join tantousya as tantousya_updater
                on tantousya_updater.bango = purchase_history_temp_before.updater_bango

                left join tantousya as tantousya_orderer
                on tantousya_orderer.bango = purchase_history_temp_before.purchase_orderer_bango

                left join tantousya as tantousya_seal_holder
                on tantousya_seal_holder.bango = purchase_history_temp_before.purchase_seal_holder_bango

                left join valid_request_temp
                on valid_request_temp.syouhinbango = purchase_history_temp_before.toiawasebango_temp_datachar03

                left join purchased_request_temp
                on purchased_request_temp.syouhinbango = purchase_history_temp_before.toiawasebango_temp_datatxt0002

                left join payment_request_temp
                on payment_request_temp.syouhinbango = purchase_history_temp_before.toiawasebango_temp_datatxt0019

                left join payment_flag_request_temp
                on payment_flag_request_temp.syouhinbango = purchase_history_temp_before.hikiatenyuko_syouhinsyu

                left join account_payable_flag_request_temp
                on account_payable_flag_request_temp.syouhinbango = purchase_history_temp_before.hikiatenyuko_hantei

                left join purchase_creation_request_temp
                on purchase_creation_request_temp.syouhinbango = purchase_history_temp_before.hikiatenyuko_dataint01

                order by purchase_history_temp_before.syouhinid,purchase_history_temp_before.line_no
                ");
        }
        /*--------------------searched data fetching ends----------------------*/

        //$time_sql1 $time_sql2 $datatxt0003_sql $datatxt0004_sql $datatxt0005_sql $datachar05_sql $information_sql $purchase_no_sql $accounting_sub_sql $radio_1_sql $radio_2_sql $radio_3_sql
        //dd(QueryHelper::fetchResult("select * from purchase_history_temp"),$time_sql1, $time_sql2, $datatxt0003_sql, $datatxt0004_sql, $datatxt0005_sql, $datachar05_sql, $information_sql, $purchase_no_sql, $accounting_sub_sql, $radio_1_sql, $radio_2_sql, $radio_3_sql);
        //dd(QueryHelper::fetchResult("select * from v_orderhenkan where v_orderhenkan.datachar02 in ('V410', 'V420', 'V422', 'V440', 'V460') "));
        //dd(/*$req_input_date_from,$req_input_date_to,$req_purchase_date_from,$req_purchase_date_to,$datatxt0003_sql ,$datatxt0004_sql ,$datatxt0005_sql,$datachar05_sql,$purchase_no_sql,$accounting_sub_sql,$information_sql,$radio_1_sql,$radio_1,$radio_2_sql,$radio_2,$radio_3_sql,$radio_3,$req_information1_short,$req_information2_short,*//*QueryHelper::fetchResult("select * from v_torihikisaki_temp"),*/QueryHelper::fetchResult("select * from purchase_history_temp "));


            QueryHelper::fetchResult("select * from purchase_history_temp");
            //dd(QueryHelper::fetchResult("select * from purchase_history_temp"));
            $search_sql = DB::table('purchase_history_temp')->toSql();
        } catch (\Exception $e) {
            //dd($e);
            return 'ng';
        }
        return $search_sql;

    }
}
