<?php


namespace App\AllClass\purchase\purchaseOrder;

use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AllPurchaseOrder
{

    public static function readData($bango, $allRequest)
    {

//        dd($allRequest);

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

        if (isset($allRequest['correction_checkbox_h'])){
            $req_correction_checkbox_h = $allRequest['correction_checkbox_h'];
        } else {
            $req_correction_checkbox_h = '0';
        }

        if (!empty($allRequest['datachar05'])) {
            $datachar05 = $allRequest['datachar05'];
        } else {
            $datachar05 = null;
        }

        $req_order_date_from=str_replace('/','-',$allRequest['orderDateFrom']). ' 00:00:00';
        $req_order_date_to=str_replace('/','-',$allRequest['orderDateTo']). ' 00:00:00';

        if (!empty($allRequest['orderNo'])) {
            $req_order_no = $allRequest['orderNo'];
        } else {
            $req_order_no = null;
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

        if (!empty($allRequest['information3_short'])) {
            $req_information3_short = $allRequest['information3_short'];
        } else {
            $req_information3_short = null;
        }



        $radio_1 = !empty($allRequest['rd1']) ? $allRequest['rd1'] : null;
        $radio_2 = !empty($allRequest['rd2']) ? $allRequest['rd2'] : null;


        $order_segment_sql="where orderhenkan_initial_temp_before.datachar02 in ('V410', 'V420', 'V422', 'V440', 'V460')";


        $datachar05_sql = '';
        if ($datachar05) {
            $datachar05_sql .= "  and orderhenkan_initial_temp_before.datachar09 = '$datachar05'";

        }

        $time_sql = '';
        if ($req_order_date_from == $req_order_date_to) {
            /*$time_sql .= "  and orderhenkan.date::text  = '$req_order_date_from'";*/
            $time_sql .= " and orderhenkan_initial_temp_before.date::text  = '$req_order_date_from'";
        } elseif ($req_order_date_from < $req_order_date_to) {
            /*$time_sql .= "  and  orderhenkan.date::text between '$req_order_date_from' and '$req_order_date_to'";*/
            $time_sql .= " and orderhenkan_initial_temp_before.date::text between '$req_order_date_from' and '$req_order_date_to'";
        }

        $order_no_sql='';

        if ($req_order_no){
            $order_no_sql .= "  and orderhenkan_initial_temp_before.kokyakuorderbango  = '$req_order_no'";
        }

        $information_sql='';
        if ($req_information1_short) {
            $information_sql .= "  and left(orderhenkan_initial_temp_before.datachar08, 8) = '$req_information1_short'";

        }
        if ($req_information2_short) {
            $information_sql .= "  and left(orderhenkan_initial_temp_before.datachar10, 8)  = '$req_information2_short'";

        }

        if ($req_information3_short) {
            $information_sql .= "  and left(orderhenkan_initial_temp_before.datachar11, 8)  = '$req_information3_short'";

        }

        $radio_1_sql = '';
        $radio_2_sql = '';
        if ($radio_1) {
            $radio_1_sql .= "  and hikiatenyuko.dataint03::text  = '$radio_1'";
        }
        if ($radio_2) {
            $radio_2_sql .= "  and hikiatenyuko.dataint06::text  = '$radio_2'";
        }

        $datatxt0003_sql = '';
        if ($req_division_start != '' && $req_division_end != '' && ($req_division_start != $req_division_end)) {

            $datatxt0003_sql .= " and substring(orderhenkan_initial_temp_before.datatxt0003::text,1,2)='B9' AND right(orderhenkan_initial_temp_before.datatxt0003::text,2) between '$req_division_start' and  '$req_division_end' ";
        } else {

            $datatxt0003_sql .= "  and substring(orderhenkan_initial_temp_before.datatxt0003::text,1,2)='B9' AND right(orderhenkan_initial_temp_before.datatxt0003::text,2) = '$req_division_start'";
        }

        $datatxt0004_sql = '';
        if ($req_department_start != '' && $req_department_end != '' && ($req_department_start != $req_department_end)) {

            $datatxt0004_sql .= "  and substring(orderhenkan_initial_temp_before.datatxt0004::text,1,2)='C1' AND right(orderhenkan_initial_temp_before.datatxt0004::text,3) between '$req_department_start' and '$req_department_end'";
        } else if ($req_department_start != '') {

            $datatxt0004_sql .= "  and substring(orderhenkan_initial_temp_before.datatxt0004::text,1,2)='C1' AND right(orderhenkan_initial_temp_before.datatxt0004::text,3) = '$req_department_start'";
        }
        $datatxt0005_sql = '';
        if ($req_t_group_start != '' && $req_t_group_end != '' && ($req_t_group_start != $req_t_group_end)) {

            $datatxt0005_sql .= "  and substring(orderhenkan_initial_temp_before.datatxt0005::text,1,2)='C2' AND right(orderhenkan_initial_temp_before.datatxt0005::text ,4) between '$req_t_group_start' and '$req_t_group_end'";
        } else if ($req_t_group_start != '') {

            $datatxt0005_sql .= "  and substring(orderhenkan_initial_temp_before.datatxt0005::text,1,2)='C2' AND right(orderhenkan_initial_temp_before.datatxt0005::text ,4) = '$req_t_group_start'";
        }

//        dd($order_segment_sql ,$time_sql);


        /*$v_orderinfo_data = QueryHelper::fetchResult("select * from v_orderhenkan ");
        dd($v_orderinfo_data);*/

        QueryHelper::runQuery("DROP TABLE IF EXISTS v_torihikisaki_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE v_torihikisaki_temp AS
        SELECT DISTINCT ON (v_torihikisaki.torihikisaki_cd)
            v_torihikisaki.torihikisaki_cd,
            v_torihikisaki.R16
            FROM v_torihikisaki
            ");
//        dd(QueryHelper::fetchResult("select * from v_torihikisaki "));
        QueryHelper::runQuery("DROP TABLE IF EXISTS seal_request_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE seal_request_temp AS
            select distinct
            request.syouhinbango||' '||request.jouhou as seal,
            request.syouhinbango
            from request
            where color='0503検印フラグ'
            ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS emailed_request_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE emailed_request_temp AS
            select distinct
            request.syouhinbango||' '||request.jouhou as emailed,
            request.syouhinbango
            from request
            where color='0503メール送信フラグ'
            ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS order_history_request_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE order_history_request_temp AS
            select distinct
            request.syouhinbango||' '||request.jouhou as order_history_creation_flag,
            request.syouhinbango
            from request
            where color='0503発注履歴作成フラグ'
            ");

//        dd(QueryHelper::fetchResult("select * from seal_request_temp "),QueryHelper::fetchResult("select * from emailed_request_temp "),QueryHelper::fetchResult("select * from order_history_request_temp "));
        if ($req_correction_checkbox_h=='0'){
            //before loading data form V_Orderhenkan_hatsu starts
            /*QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_initial_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_initial_temp as
                select distinct
                       kokyakuorderbango, max(ordertypebango2) as maxval
                       from orderhenkan
                       where orderhenkan.synchroorderbango2 = '0'  group by kokyakuorderbango
                ");*/
//            dd(QueryHelper::fetchResult("select * from orderhenkan_initial_temp "));
            /*QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_initial_temp_before");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_initial_temp_before as
                select
                orderhenkan.bango,
                orderhenkan.kokyakuorderbango,
                orderhenkan.ordertypebango2,
                orderhenkan.orderuserbango,
                orderhenkan.date,
                orderhenkan.datachar10,
                orderhenkan.datachar08,
                orderhenkan.datachar09,
                orderhenkan.datatxt0151,
                orderhenkan.datachar01,
                orderhenkan.intorder01,
                orderhenkan.intorder02,
                orderhenkan.datachar11,
                orderhenkan.intorder03,
                orderhenkan.datachar02
                from orderhenkan
                join orderhenkan_initial_temp
                on orderhenkan_initial_temp.kokyakuorderbango = orderhenkan.kokyakuorderbango
                and orderhenkan_initial_temp.maxval = orderhenkan.ordertypebango2
                ");*/
//            dd(QueryHelper::fetchResult("select * from orderhenkan_initial_temp_before "));
            //before loading data form V_Orderhenkan_hatsu ends
            QueryHelper::runQuery("DROP TABLE IF EXISTS V_Orderhenkan_hatsu_max");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE V_Orderhenkan_hatsu_max AS
            select
            kokyakuorderbango,
            max (V_Orderhenkan_hatsu.ordertypebango2) as ordertypebango2
            from V_Orderhenkan_hatsu
            group by  kokyakuorderbango
            ");

            QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_initial_temp_before");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_initial_temp_before AS
            select V_Orderhenkan_hatsu.*
            from V_Orderhenkan_hatsu
            join V_Orderhenkan_hatsu_max
            on V_Orderhenkan_hatsu_max.kokyakuorderbango=V_Orderhenkan_hatsu.kokyakuorderbango
            and V_Orderhenkan_hatsu_max.ordertypebango2=V_Orderhenkan_hatsu.ordertypebango2
            --where V_Orderhenkan_hatsu.kokyakuorderbango='0350000009'
            ");
//            dd(QueryHelper::fetchResult("select * from orderhenkan_initial_temp_before "));
        }
        elseif ($req_correction_checkbox_h=='1'){
            //before loading data form V_Orderhenkan_hatsu starts
            /*QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_initial_temp_before");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_initial_temp_before as
                select
                orderhenkan.bango,
                orderhenkan.kokyakuorderbango,
                orderhenkan.ordertypebango2,
                orderhenkan.orderuserbango,
                orderhenkan.date,
                orderhenkan.datachar10,
                orderhenkan.datachar08,
                orderhenkan.datachar09,
                orderhenkan.datatxt0151,
                orderhenkan.datachar01,
                orderhenkan.intorder01,
                orderhenkan.intorder02,
                orderhenkan.datachar11,
                orderhenkan.intorder03,
                orderhenkan.datachar02
                from orderhenkan
                ");*/
            //before loading data form V_Orderhenkan_hatsu ends
            QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_initial_temp_before");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_initial_temp_before AS
            select *
            from V_Orderhenkan_hatsu
            ");
        }
//        dd(QueryHelper::fetchResult("select * from orderhenkan_initial_temp_before "));
//        dd(QueryHelper::fetchResult("select * from v_orderhenkan "));
        QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_order_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_order_temp as
                select distinct on (orderhenkan_initial_temp_before.kokyakuorderbango,orderhenkan_initial_temp_before.ordertypebango2)
                orderhenkan_initial_temp_before.kokyakuorderbango as order_number1,
                orderhenkan_initial_temp_before.ordertypebango2 as correction_orders,
                orderhenkan_initial_temp_before.orderuserbango as order_number2,
                REPLACE(substring(CAST(orderhenkan_initial_temp_before.date AS text),1,10),'-','/') AS date,
                v_torihikisaki_order.R16 as contractor,
                v_torihikisaki_supplier.R16 as supplier,
                orderhenkan_initial_temp_before.name as user_name,
                lower(orderhenkan_initial_temp_before.name) as user_name_sort,
                '' as check_tik,
                seal_request_temp.seal,
                orderhenkan_initial_temp_before.datatxt0151 as storage_number,
                soukonyuko.datachar09 as purchase_order_pdf,
                emailed_request_temp.emailed,
                orderhenkan_initial_temp_before.datachar01 as supplier_quotation_number,
                orderhenkan_initial_temp_before.intorder01::int as total_order_amount,
                to_char(orderhenkan_initial_temp_before.intorder01,'FM99,999,999,999,999') as total_order_amount_show,
                orderhenkan_initial_temp_before.intorder02::int as purchase_consumption_tax,
                to_char(orderhenkan_initial_temp_before.intorder02,'FM99,999,999,999,999') as purchase_consumption_tax_show,
                v_torihikisaki_end_customer.R16 as end_customer,
                order_history_request_temp.order_history_creation_flag,
                orderhenkan_initial_temp_before.datatxt0003,
                orderhenkan_initial_temp_before.datatxt0004,
                orderhenkan_initial_temp_before.datatxt0005,
                hikiatenyuko.denpyoshimebi,
                checker_tantousya.name as checker

                from orderhenkan_initial_temp_before

                left join soukonyuko
                on soukonyuko.syouhinid =  orderhenkan_initial_temp_before.kokyakuorderbango

                join hikiatenyuko
                on hikiatenyuko.syouhinid = orderhenkan_initial_temp_before.kokyakuorderbango

                left join tantousya as checker_tantousya
                on checker_tantousya.bango = hikiatenyuko.datachar01

                left join seal_request_temp
                on seal_request_temp.syouhinbango = hikiatenyuko.dataint06

                left join emailed_request_temp
                on emailed_request_temp.syouhinbango = hikiatenyuko.dataint05

                left join order_history_request_temp
                on order_history_request_temp.syouhinbango = hikiatenyuko.hantei

                left join v_torihikisaki_temp as  v_torihikisaki_order
                on v_torihikisaki_order.torihikisaki_cd = orderhenkan_initial_temp_before.datachar10

                left join v_torihikisaki_temp as  v_torihikisaki_supplier
                on v_torihikisaki_supplier.torihikisaki_cd = orderhenkan_initial_temp_before.datachar08

                left join v_torihikisaki_temp as  v_torihikisaki_end_customer
                on v_torihikisaki_end_customer.torihikisaki_cd = orderhenkan_initial_temp_before.datachar11


                --where orderhenkan_initial_temp_before.kokyakuorderbango='0351000119'
                $order_segment_sql $datatxt0003_sql $datatxt0004_sql $datatxt0005_sql $time_sql $datachar05_sql $radio_1_sql $radio_2_sql $information_sql $order_no_sql
                ");
        //$order_segment_sql $datatxt0003_sql $datatxt0004_sql $datatxt0005_sql $time_sql $datachar05_sql $radio_1_sql $radio_2_sql $information_sql $order_no_sql
//        dd(QueryHelper::fetchResult("select * from v_orderhenkan"));
//        dd(QueryHelper::fetchResult("select * from v_orderhenkan where v_orderhenkan.datachar02 in ('V410', 'V420', 'V422', 'V440', 'V460') "));
//        dd(QueryHelper::fetchResult("select * from orderhenkan_initial_temp_before "),QueryHelper::fetchResult("select * from purchase_order_temp ")/*,$datatxt0003_sql ,$datatxt0004_sql ,$datatxt0005_sql,$datachar05_sql,$datachar05*/);
        /*$datatxt0003_sql $datatxt0004_sql $datatxt0005_sql */
        /*and v_orderhenkan.datatxt0003 is not null and v_orderhenkan.datatxt0004 is not null and v_orderhenkan.datatxt0005 is not null */
                $search_sql = DB::table('purchase_order_temp')->toSql();

                return $search_sql;

    }

}

