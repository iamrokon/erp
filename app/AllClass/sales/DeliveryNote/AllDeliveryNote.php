<?php


namespace App\AllClass\sales\DeliveryNote;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;

class AllDeliveryNote
{
    public static function data($request, $bango = false)
    {

        $req_division_start = $request['division_datachar05_start'];
        $req_division_end = $request['division_datachar05_end'];
        $req_department_start = isset($request['department_datachar05_start']) ? $request['department_datachar05_start'] : '';
        $req_department_end = isset($request['department_datachar05_end']) ? $request['department_datachar05_end'] : '';
        $req_t_group_start = isset($request['group_datachar05_start']) ? $request['group_datachar05_start'] : '';
        $req_t_group_end = isset($request['group_datachar05_end']) ? $request['group_datachar05_end'] : '';
        $req_order_date_start = $request['order_date_start'];
        $req_order_date_end = $request['order_date_end'];
        $req_contractor = $request['contractor_db'];
        $req_billing_address = $request['billing_address_db'];
        $req_sales_category = $request['creation_category'];
        $req_insurance_classification = $request['issuance_classification'];
        $req_slip_number_start = (int)$request['sales_slip_number_start'];
        $req_slip_number_end = (int)$request['sales_slip_number_end'];

        QueryHelper::runQuery("DROP TABLE IF EXISTS haisou_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE haisou_temp as
            select distinct
            haisou.bango,
            haisou.name,
            haisou.address,
            haisou.tel,
            haisou.yubinbango,
            haisou.torihikisakirank2,
            haisou.torihikisakibango,
            haisou.kounyusu,
            others2.other1,
            others2.other40,
            haisou.shikibetsucode,
            left(others2.other39, 1) other39,
            CASE
               When  LEFT(others2.other1, 1) = '1' THEN
               1
               ELSE
              2 end as check_other
            from haisou
            left join others2 on haisou.bango = others2.otherint1");
        QueryHelper::runQuery("DROP TABLE IF EXISTS kokyaku1_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE kokyaku1_temp  as
        select
           kokyaku1.denpyosaiban,
           kokyaku1.yobi12,
           --kokyaku1.mallsoukobango2,
           --others2.other39,
           --others2.other1,
           case when LEFT(others2.other1, 1) = '1'
		       then kokyaku1.mallsoukobango2
		       else others2.other39
           end as sendenkubun,
           haisou.torihikisakibango as haisoutorihikisakibango
	    from kokyaku1
	    left join haisou on kokyaku1.yobi12 = haisou.shikibetsucode
	    left join others2 on haisou.bango = others2.otherint1 order by kokyaku1.yobi12");

        $search_sql = "select distinct
        concat(substring( cast (orderhenkan.intorder03 as varchar(100)),1,4),
        substring(cast (orderhenkan.intorder03  as varchar(100)),5,2),
        substring(cast (orderhenkan.intorder03  as varchar(100)),7,2)) as estimate_date,
        orderhenkan.kokyakuorderbango as orderid,
        orderhenkan.bango as orderhenkanbango,
        orderhenkan.synchroorderbango,
        orderhenkan.intorder03,
        orderhenkan.datachar05,
        orderhenkan.ordertypebango2,
        orderhenkan.datachar10,
        orderhenkan.datachar04 as customer_order_number,
        tuhanorder.information1,
        tuhanorder.information2,
        tuhanorder.information3,
        h1.bango,
        h1.other1 as other1,
        h1.other39 as other39,
        h1.other40 as other40,
        syukkoold.hantei as syukkooldHantei,
        syukkoold.hantei,
        syukkoold.dataint02,
        hikiatesyukko.datachar04,
        hikiatesyukko.datachar01,
        kokyaku1.name as k2Name,
        kokyaku1.mallsoukobango2 as k2Mallsoukobango2,
        orderhenkan.datatxt0003 as division,
        orderhenkan.datatxt0004 as department,
        orderhenkan.datatxt0005 as t_group,
        orderhenkan.intorder03 as order_date,
        tuhanorder.information1 as contractor,
        tuhanorder.information2 as billing_address,
        tuhanorder.text1 as sales_category,
        hikiatesyukko.dataint07 as insurance_classification,
        orderhenkan.datachar10 as sales_slip_number,
        orderhenkan.datachar10 as sales_number,
        orderhenkan.ordertypebango2 as number_of_correction,
        cast( orderhenkan.kokyakuorderbango as varchar(100)) as order_number,
        tuhanorder.information2 as sales_billing_cd,
        tuhanorder.information3 as last_customer_cd,
        orderhenkan.intorder03 as sales_date,
        tuhanorder.housoukubun as immediate_classification,
        tuhanorder.information8 as voucher_remark,
        tuhanorder.numeric3 as sales_amount,
        tuhanorder.numeric4 as consumption_tax_amount,
        REPLACE(SUBSTRING(tuhanorder.chumondate::text,1,10),'-','')  as billing_confirmation_date,
        syukkoold.dataint02 as display_order,
        syukkoold.kawasename as product_cd,
        syukkoold.syouhinname as product_name,
        syukkoold.syukkasu as quantity,
        syukkoold.codename as unit,
        syukkoold.dataint04 as unit_sales_price,
        syukkoold.datachar08 as details_remark,
        -- @20220211, USAC002-246
        syukkoold.datachar19 as sales_statement_amount,
        -- @20220211, USAC002-246
        syukkoold.datachar20 as sales_details_consumption_tax_amount,
        hikiatesyukko.dataint07 as issued_flag,
        kokyaku1.name as billing_commpany_name,
        h1.name as office_name,
        h1.bango as h1bango,
        e1.mail2 as billing_department,
        e1.mail3 as billing_position,
        e1.tantousya as personal_name,
        h1.yubinbango as billing_zipcode,
        split_part(h1.address,' ',1) as billing_destination_name,
        split_part(h1.address,' ',2) as billing_city_name,
        split_part(h1.address,' ',3) as billing_area_name,
        split_part(h1.address,' ',4) as billing_building_name,
        h1.tel as billing_tel,
        h1.torihikisakirank2 as billing_fax,
        kokyaku2.name as last_customer_company_name,
        CASE
            When  check_other = '1' THEN
                   kokyaku1.mallsoukobango3
            ELSE
                h1.other40
             END as delivery_code,
        left(kokyaku3.sendenkubun,1) as download_status
        FROM v_orderhenkan as orderhenkan
        --left join tantousya on orderhenkan.datachar05 = tantousya.bango
        inner join hikiatesyukko
        on hikiatesyukko.syouhinid=orderhenkan.kokyakuorderbango
        and hikiatesyukko.orderbango =orderhenkan.bango


        inner join syukkoold
        on syukkoold.syouhinid=orderhenkan.kokyakuorderbango
        and syukkoold.orderbango =orderhenkan.bango
        
        inner join syouhin1
        on syouhin1.kokyakusyouhinbango=syukkoold.kawasename
        and (substring(syouhin1.koyuujouhou,5,2)<>'90'
        OR substring(syouhin1.color,5,5)<>'90002')
        -- @202202 USAC002-253
        and (left(syouhin1.koyuujouhou, 2) != 'C5' or right(syouhin1.koyuujouhou, 2) != '90') 
        and (left(syouhin1.color, 2) != 'C6' or right(syouhin1.color, 5) != '90002')
 
        left join tuhanorder
        on tuhanorder.juchubango=orderhenkan.kokyakuorderbango
        and tuhanorder.orderbango =orderhenkan.bango

        left join kokyaku1 as kokyaku1 on substring(tuhanorder.information2,1,6) = kokyaku1.yobi12 and kokyaku1.denpyosaiban = 0
        left join kokyaku1_temp as kokyaku3 on substring(tuhanorder.information2,1,6) = kokyaku3.yobi12 and substring(tuhanorder.information2,7,2) = kokyaku3.haisoutorihikisakibango and kokyaku3.denpyosaiban = 0
        left join kokyaku1 as kokyaku2 on substring(tuhanorder.information3,1,6) = kokyaku2.yobi12 and kokyaku2.denpyosaiban = 0
        left join haisou_temp as h1 on substring(tuhanorder.information2,7,2) = h1.torihikisakibango and h1.kounyusu = 0 and h1.shikibetsucode = substring(tuhanorder.information2,1,6)
        left join etsuransya as e1 on substring(tuhanorder.information2,9,3) = e1.datatxt0049 and e1.deleteflag = 0 and  e1.datatxt0014 = substring(tuhanorder.information2,1,6) and e1.datatxt0015 = substring(tuhanorder.information2,7,2)
        where orderhenkan.ordertypebango2 = '0' and  orderhenkan.synchroorderbango = 0 and orderhenkan.datachar10 is not null and syukkoold.hantei = '0' and hikiatesyukko.datachar04='1'
        ";


        if ($req_division_start != '' && $req_division_end != '' && ($req_division_start != $req_division_end)) {
            $search_sql .= "  and  orderhenkan.datatxt0003 between '$req_division_start' and  '$req_division_end' ";
        } else {
            $search_sql .= "  and orderhenkan.datatxt0003 like '%$req_division_start%'";
        }

        if ($req_department_start != '' && $req_department_end != '' && ($req_department_start != $req_department_end)) {
            $search_sql .= "  and orderhenkan.datatxt0004 between '$req_department_start' and '$req_department_end'";
        } else if ($req_department_start != '') {
            $search_sql .= "  and orderhenkan.datatxt0004 like '%$req_department_start%'";
        }

        if ($req_t_group_start != '' && $req_t_group_end != '' && ($req_t_group_start != $req_t_group_end)) {
            $search_sql .= "  and orderhenkan.datatxt0005 between '$req_t_group_start' and '$req_t_group_end'";
        } else if ($req_t_group_start != '') {
            $search_sql .= "  and orderhenkan.datatxt0005 like '%$req_t_group_start%'";
        }

        if ($req_order_date_start && $req_order_date_end && $req_order_date_start == $req_order_date_end) {
            $search_sql .= "  and cast(orderhenkan.intorder03 as bigint)  = $req_order_date_start";
        } elseif ($req_order_date_start && $req_order_date_end && $req_order_date_start < $req_order_date_end) {
            $search_sql .= "  and  cast(orderhenkan.intorder03 as bigint) between $req_order_date_start and $req_order_date_end";
        } elseif ($req_order_date_start && $req_order_date_end == '') {
            $search_sql .= "  and cast(orderhenkan.intorder03 as bigint)  > $req_order_date_start";
        } elseif ($req_order_date_end && $req_order_date_start == '') {
            $search_sql .= "  and cast(orderhenkan.intorder03 as bigint)  < $req_order_date_end";
        }

        if ($req_contractor) {
            $search_sql .= "  and substring(tuhanorder.information1,1,8) like '%$req_contractor%'";
        }
        if ($req_billing_address) {
            $search_sql .= "  and substring(tuhanorder.information2,1,8) like '%$req_billing_address%'";
        }

        if ($req_sales_category) {
            $search_sql .= " and tuhanorder.text1 = '$req_sales_category'";
        }

        if ($req_insurance_classification && $req_insurance_classification != 3) {
            $search_sql .= " and hikiatesyukko.dataint07 = $req_insurance_classification";
        }

        if ($req_slip_number_start && $req_slip_number_end && $req_slip_number_start == $req_slip_number_end) {
            $search_sql .= "  and cast(orderhenkan.datachar10 as bigint) = $req_slip_number_start";
        } elseif ($req_slip_number_start && $req_slip_number_end == '') {
            $search_sql .= "  and cast(orderhenkan.datachar10 as bigint) > $req_slip_number_start";
        } elseif ($req_slip_number_end && $req_slip_number_start == '') {
            $search_sql .= "  and cast(orderhenkan.datachar10 as bigint) < $req_slip_number_end";
        } elseif ($req_slip_number_start && $req_slip_number_end && $req_slip_number_start < $req_slip_number_end) {
            $search_sql .= "  and cast(orderhenkan.datachar10 as bigint) between $req_slip_number_start and $req_slip_number_end";
        }

        $search_sql .= " order by orderhenkan.datachar10,syukkoold.dataint02 ";

        QueryHelper::runQuery("DROP TABLE IF EXISTS all_delivery_note_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_delivery_note_temp  as  $search_sql");

        $sql = DB::table('all_delivery_note_temp')
            ->whereRaw("download_status = '1'")
            ->toSql();
        // dd(QueryHelper::fetchResult($sql));

        return $sql;
    }
}
