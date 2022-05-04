<?php

namespace App\AllClass\sales\BillingLedger;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;

class BillingLedgerMerge
{
    public static function data($request = [])
    {
        $billing_address = $request['billing_address'];

        $merge_key = "dates,dates_xls,classification,slip_number,lines,product_name,numbers,unit_price,sales_amount,consumption_tax,consumption_temp,deposit_amount,balance,unit_price_xls,sales_amount_xls,consumption_tax_xls,deposit_amount_xls,balance_xls,order_slip_number,order_line,remarks,contractor,end_customer,serial_data,classification1,user_name,voucher_remarks,customer_note_number";
        QueryHelper::runQuery("DROP TABLE IF EXISTS all_billing_ledger_merge_temp_before ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_billing_ledger_merge_temp_before  as
        --select $merge_key from all_billing_ledger_carry_temp
        --union
        select $merge_key from all_billing_ledger_sale_temp
        union
        select $merge_key from all_billing_ledger_payment_temp
        order by dates,classification,slip_number,lines,serial_data");

        /*---------------creating extra row--------------*/

        $extra_row_condition=QueryHelper::fetchSingleResult("
        select
        case left(others2.other1,1)
            when '1' then left(haisoujouhou.datatxt0051,1)
            when '2' then left(others2.other17,1)
        end as consumption_temp,
        tuhanorder.information2 as tuhan_temp

        from tuhanorder
        left join kokyaku1 on kokyaku1.yobi12 = substring(tuhanorder.information2,1,6)
        left join haisoujouhou on haisoujouhou.syukei1 =  kokyaku1.bango
        left join haisou on  haisou.shikibetsucode = kokyaku1.yobi12
        left join others2 on others2.otherint1 = haisou.bango
        WHERE  substring(tuhanorder.information2,1,8) = '$billing_address'");
        if (!empty($extra_row_condition)){
            if ($extra_row_condition->consumption_temp=='3'){
                $fetchTuhanorderInfos=QueryHelper::fetchResult("select distinct on (tuhanorder.chumondate)
                                                                REPLACE(substring(tuhanorder.chumondate::text,1,10),'-','/') as chumondate,
                                                                substring(tuhanorder.information2,1,8) as information2
                                                                FROM tuhanorder
                                                                Where substring(tuhanorder.information2,1,8) = '$billing_address'
                                                                and tuhanorder.chumondate IS NOT NULL");
//                dd($fetchTuhanorderInfos,$billing_address);
                if (!empty($fetchTuhanorderInfos)){
                    foreach ($fetchTuhanorderInfos as $fetchTuhanorderInfo){
                        $chumondate=$fetchTuhanorderInfo->chumondate;
                        $information2=$fetchTuhanorderInfo->information2;
                        $fetchSeikyuzandakadataDatanum0064=QueryHelper::fetchResult("select
                                                                                seikyuzandaka.datanum0064
                                                                                FROM seikyuzandaka
                                                                                Where REPLACE(substring(CAST(seikyuzandaka.date0009 AS text),1,10),'-','/') = '$chumondate'
                                                                                AND seikyuzandaka.datatxt0142 = '$information2' limit 1");
//                        dd($fetchSeikyuzandakadataDatanum0064,$information2);
                        if (!empty($fetchSeikyuzandakadataDatanum0064)){
                            $datanum0064_val=$fetchSeikyuzandakadataDatanum0064[0]->datanum0064;
//                            dd($datanum0064_val);
                            QueryHelper::runQuery("DROP TABLE IF EXISTS seikyuzandaka_last_billing_temp");
                            QueryHelper::runQuery("CREATE TEMPORARY TABLE seikyuzandaka_last_billing_temp AS
                        SELECT DISTINCT
                        REPLACE ('$chumondate', '/', '') AS dates,
                        '$chumondate' AS dates_xls,
                        '' as classification,
                        '' as  slip_number,
                        '' as lines,
                        '消費税額' as product_name,
                        '' as numbers,
                        '' as unit_price,
                        '' as sales_amount,
                        CAST (to_char('$datanum0064_val'::bigint ,'FM99,999,999,999,999') AS text) as consumption_tax,
                        '' as consumption_temp,
                        '' as deposit_amount,
                        '' AS balance,
                        '' as unit_price_xls,
                        '' as sales_amount_xls,
                        '$datanum0064_val' as consumption_tax_xls,
                        '' as deposit_amount_xls,
                        '' AS balance_xls,
                        '' as order_slip_number,
                        '' as order_line,
                        '' as remarks,
                        '' as  contractor,
                        '' as  end_customer,
                        'd' as serial_data,
                        '' as classification1,
                        '' as user_name,
                        '' as voucher_remarks,
                        '' as customer_note_number
                        FROM seikyuzandaka");
//                            dd(QueryHelper::fetchResult("select * from seikyuzandaka_last_billing_temp "));
                            QueryHelper::runQuery("INSERT INTO all_billing_ledger_merge_temp_before SELECT * FROM seikyuzandaka_last_billing_temp");
                        }
                    }
                }
            }
        }
//        dd(QueryHelper::fetchResult("select * from all_billing_ledger_merge_temp_before"));
        /*---------------balance calculation--------------*/

        QueryHelper::runQuery("DROP TABLE IF EXISTS all_billing_ledger_merge_temp");
        $col_names='dates VARCHAR(100),dates_xls VARCHAR(100),classification VARCHAR(100),slip_number VARCHAR(100), lines VARCHAR(100),
                    product_name VARCHAR(100),numbers VARCHAR(100),unit_price VARCHAR(100),sales_amount VARCHAR(100),consumption_tax VARCHAR(100),
                    consumption_temp VARCHAR(100),deposit_amount VARCHAR(100), balance VARCHAR(100),unit_price_xls VARCHAR(100),sales_amount_xls VARCHAR(100),
                    consumption_tax_xls VARCHAR(100),deposit_amount_xls VARCHAR(100),balance_xls VARCHAR(100), order_slip_number VARCHAR(100), order_line VARCHAR(100),
                    remarks VARCHAR(100), contractor VARCHAR(100),end_customer VARCHAR(100), serial_data VARCHAR(100),classification1 VARCHAR(100), user_name VARCHAR(100), voucher_remarks VARCHAR(100), customer_note_number VARCHAR(100)';
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_billing_ledger_merge_temp( $col_names )");
//        dd($col_names,QueryHelper::fetchResult("select * from all_billing_ledger_merge_temp"));
//        $fetch_merge_temp_before=QueryHelper::fetchResult("select * from all_billing_ledger_merge_temp_before ");
        QueryHelper::runQuery("DROP TABLE IF EXISTS all_billing_ledger_merge_temp_after");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_billing_ledger_merge_temp_after  as
        select * from all_billing_ledger_merge_temp_before
        order by dates,classification,slip_number,lines,serial_data");
        $fetch_merge_temp_before=QueryHelper::fetchResult("select * from all_billing_ledger_merge_temp_after ");
//        dd($fetch_merge_temp_before,QueryHelper::fetchResult("select * from all_billing_ledger_merge_temp_before"));
        $old_balance='';
        $pre_balance='';
        $temp_slip_number="";
        $check_carry=QueryHelper::fetchResult("select * from all_billing_ledger_carry_temp ");
        //dd($check_carry);
        if (!empty($check_carry)){
            QueryHelper::runQuery("INSERT INTO all_billing_ledger_merge_temp SELECT distinct $merge_key FROM all_billing_ledger_carry_temp");
            $old_balance=(int)str_replace(',','', QueryHelper::fetchSingleResult("select balance from all_billing_ledger_carry_temp ")->balance);
        }
        if (!empty($fetch_merge_temp_before)){
            foreach ($fetch_merge_temp_before as $key=>$temp_before){
                if ($key==0){
                    $dates=$temp_before->dates;
                    $dates_xls=$temp_before->dates_xls;
                    $classification=$temp_before->classification;
                    $slip_number=$temp_before->slip_number;
                    $lines=$temp_before->lines;


                    $product_name=$temp_before->product_name;
                    $numbers=$temp_before->numbers;
                    $unit_price=$temp_before->unit_price;
                    $sales_amount=$temp_before->sales_amount;
                    $sales_amount_calc=(int)str_replace(',','', $temp_before->sales_amount);
                    if($temp_before->consumption_temp=='3' && $temp_before->serial_data=='b'){
                        $consumption_tax='';
                        $consumption_tax_calc=0;
                        $consumption_tax_xls='';
                    }
                    elseif($temp_before->slip_number == $temp_slip_number && $temp_before->slip_number!='' && $temp_before->consumption_temp=='1' && $temp_before->serial_data=='b'){
                        $consumption_tax='';
                        $consumption_tax_calc=0;
                        $consumption_tax_xls='';
                    }
                    elseif($temp_before->slip_number == $temp_slip_number && $temp_before->slip_number!='' && $temp_before->serial_data=='c'){
                        $consumption_tax='';
                        $consumption_tax_calc=0;
                        $consumption_tax_xls='';
                    }
                    else{
                        $consumption_tax=$temp_before->consumption_tax;
                        $consumption_tax_calc=(int)str_replace(',','', $temp_before->consumption_tax);
                        $consumption_tax_xls=$temp_before->consumption_tax_xls;
                    }


                    $consumption_temp=$temp_before->consumption_temp;
                    $deposit_amount=$temp_before->deposit_amount;
                    $deposit_amount_calc=(int)str_replace(',','', $temp_before->deposit_amount);
                    $balance=($old_balance+$sales_amount_calc+$consumption_tax_calc)-$deposit_amount_calc;
                    $unit_price_xls=$temp_before->unit_price_xls;

                    $sales_amount_xls=$temp_before->sales_amount_xls;
                    $deposit_amount_xls=$temp_before->deposit_amount_xls;
                    $balance_xls=($old_balance+$sales_amount_calc+$consumption_tax_calc)-$deposit_amount_calc;
                    $order_slip_number=$temp_before->order_slip_number;
                    $order_line=$temp_before->order_line;
                    $remarks=$temp_before->remarks;
                    $contractor=$temp_before->contractor;
                    $end_customer=$temp_before->end_customer;
                    $serial_data=$temp_before->serial_data;
                    $classification1=$temp_before->classification1;
                    $user_name=$temp_before->user_name;
                    $voucher_remarks=$temp_before->voucher_remarks;
                    $customer_note_number=$temp_before->customer_note_number;

                    $pre_balance=$balance;
                    QueryHelper::runQuery("DROP TABLE IF EXISTS all_billing_ledger_merge_temp_calc");
                    QueryHelper::runQuery("CREATE TEMPORARY TABLE all_billing_ledger_merge_temp_calc AS
                     SELECT DISTINCT
                     '$dates' AS dates,
                     '$dates_xls' AS dates_xls,
                     '$classification' AS classification,
                     '$slip_number' AS slip_number,
                     '$lines' AS lines,
                     '$product_name' AS product_name,
                     '$numbers' AS numbers,
                     '$unit_price' AS unit_price,
                     CASE
                        WHEN '$sales_amount'=null THEN  ''
                        WHEN '$sales_amount'='' THEN  ''
                        ELSE '$sales_amount'
                        END AS sales_amount,
                     CASE
                        WHEN '$consumption_tax'=null THEN  ''
                        WHEN '$consumption_tax'='' THEN  ''
                        ELSE '$consumption_tax'
                        END AS consumption_tax,
                      '$consumption_temp' as consumption_temp,
                      CASE
                        WHEN '$deposit_amount'=null THEN  ''
                        WHEN '$deposit_amount'='' THEN  ''
                        ELSE '$deposit_amount'
                        END AS deposit_amount,
                      CAST (to_char('$balance'::bigint ,'FM99,999,999,999,999') AS text) AS balance,
                     '$unit_price_xls' AS unit_price_xls,
                     '$sales_amount_xls' AS sales_amount_xls,
                     '$consumption_tax_xls' AS consumption_tax_xls,
                     '$deposit_amount_xls' AS  deposit_amount_xls,
                     '$balance_xls' AS balance_xls,
                     '$order_slip_number' AS order_slip_number,
                     '$order_line' AS order_line,
                     '$remarks' AS remarks,
                     '$contractor' AS contractor,
                     '$end_customer' AS end_customer,
                     '$serial_data' AS serial_data,
                     '$classification1' AS classification1,
                     '$user_name' AS user_name,
                     '$voucher_remarks' AS voucher_remarks,
                     '$customer_note_number' AS customer_note_number
                    FROM seikyuzandaka");
                    QueryHelper::runQuery("INSERT INTO all_billing_ledger_merge_temp SELECT * FROM all_billing_ledger_merge_temp_calc");
                }
                else{
                    $dates=$temp_before->dates;
                    $dates_xls=$temp_before->dates_xls;
                    $classification=$temp_before->classification;
                    $slip_number=$temp_before->slip_number;
                    $lines=$temp_before->lines;

                    $product_name=$temp_before->product_name;
                    $numbers=$temp_before->numbers;
                    $unit_price=$temp_before->unit_price;
                    $sales_amount=$temp_before->sales_amount;
                    $sales_amount_calc=(int)str_replace(',','', $temp_before->sales_amount);
                    if($temp_before->consumption_temp=='3' && $temp_before->serial_data=='b'){
                        $consumption_tax='';
                        $consumption_tax_calc=0;
                        $consumption_tax_xls='';
                    }
                    elseif($temp_before->slip_number == $temp_slip_number && $temp_before->slip_number!='' && $temp_before->consumption_temp=='1' && $temp_before->serial_data=='b'){
                        $consumption_tax='';
                        $consumption_tax_calc=0;
                        $consumption_tax_xls='';
                    }
                    elseif($temp_before->slip_number == $temp_slip_number && $temp_before->slip_number!='' && $temp_before->serial_data=='c'){
                        $consumption_tax='';
                        $consumption_tax_calc=0;
                        $consumption_tax_xls='';
                    }
                    else{
                        $consumption_tax=$temp_before->consumption_tax;
                        $consumption_tax_calc=(int)str_replace(',','', $temp_before->consumption_tax);
                        $consumption_tax_xls=$temp_before->consumption_tax_xls;
                    }

                    $consumption_temp=$temp_before->consumption_temp;
                    $deposit_amount=$temp_before->deposit_amount;
                    $deposit_amount_calc=(int)str_replace(',','', $temp_before->deposit_amount);
                    $balance=($pre_balance+$sales_amount_calc+$consumption_tax_calc)-$deposit_amount_calc;
                    $unit_price_xls=$temp_before->unit_price_xls;

                    $sales_amount_xls=$temp_before->sales_amount_xls;
                    $deposit_amount_xls=$temp_before->deposit_amount_xls;
                    $balance_xls=($pre_balance+$sales_amount_calc+$consumption_tax_calc)-$deposit_amount_calc;
                    $order_slip_number=$temp_before->order_slip_number;
                    $order_line=$temp_before->order_line;
                    $remarks=$temp_before->remarks;
                    $contractor=$temp_before->contractor;
                    $end_customer=$temp_before->end_customer;
                    $serial_data=$temp_before->serial_data;
                    $classification1=$temp_before->classification1;
                    $user_name=$temp_before->user_name;
                    $voucher_remarks=$temp_before->voucher_remarks;
                    $customer_note_number=$temp_before->customer_note_number;
                    $pre_balance=$balance;
                    QueryHelper::runQuery("DROP TABLE IF EXISTS all_billing_ledger_merge_temp_calc");
                    QueryHelper::runQuery("CREATE TEMPORARY TABLE all_billing_ledger_merge_temp_calc AS
                     SELECT DISTINCT
                     '$dates' AS dates,
                     '$dates_xls' AS dates_xls,
                     '$classification' AS classification,
                     '$slip_number' AS slip_number,
                     '$lines' AS lines,
                     '$product_name' AS product_name,
                     '$numbers' AS numbers,
                     '$unit_price' AS unit_price,
                     CASE
                        WHEN '$sales_amount'=null THEN  ''
                        WHEN '$sales_amount'='' THEN  ''
                        ELSE '$sales_amount'
                        END AS sales_amount,

                      CASE
                        WHEN '$consumption_tax'=null THEN  ''
                        WHEN '$consumption_tax'='' THEN  ''
                        ELSE '$consumption_tax'
                        END AS consumption_tax,

                     '$consumption_temp' as consumption_temp,
                     CASE
                        WHEN '$deposit_amount'=null THEN  ''
                        WHEN '$deposit_amount'='' THEN  ''
                        ELSE '$deposit_amount'
                        END AS deposit_amount,
                      CAST (to_char('$balance'::bigint ,'FM99,999,999,999,999') AS text) AS balance,
                     '$unit_price_xls' AS unit_price_xls,
                     '$sales_amount_xls' AS sales_amount_xls,
                     '$consumption_tax_xls' AS consumption_tax_xls,
                     '$deposit_amount_xls' AS  deposit_amount_xls,
                     '$balance_xls' AS balance_xls,
                     '$order_slip_number' AS order_slip_number,
                     '$order_line' AS order_line,
                     '$remarks' AS remarks,
                     '$contractor' AS contractor,
                     '$end_customer' AS end_customer,
                     '$serial_data' AS serial_data,
                     '$classification1' AS classification1,
                     '$user_name' AS user_name,
                     '$voucher_remarks' AS voucher_remarks,
                     '$customer_note_number' AS customer_note_number
                    FROM seikyuzandaka");
                    QueryHelper::runQuery("INSERT INTO all_billing_ledger_merge_temp SELECT * FROM all_billing_ledger_merge_temp_calc");
                }
                $temp_slip_number = $temp_before->slip_number;
            }
        }
        //dd($fetch_merge_temp_before,QueryHelper::fetchResult("select * from all_billing_ledger_merge_temp"));
        return  DB::table('all_billing_ledger_merge_temp');
    }
}
