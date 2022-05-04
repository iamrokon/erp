<?php

namespace App\AllClass\purchase\paymentHistory;

use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AllPaymentHistory
{
    public static function readData($bango, $allRequest)
    {

       //dd($allRequest);


        if (!empty($allRequest['syouhinid_start'])) {
            $syouhinid_start = $allRequest['syouhinid_start'];
        } else {
            $syouhinid_start = null;
        }

        if (!empty($allRequest['syouhinid_end'])) {
            $syouhinid_end = $allRequest['syouhinid_end'];
        } else {
            $syouhinid_end = null;
        }

        if (!empty($allRequest['datachar01_start'])) {
            $datachar01_start = substr($allRequest['datachar01_start'], 2, 3);
        } else {
            $datachar01_start = null;
        }

        if (!empty($allRequest['datachar01_end'])) {
            $datachar01_end = substr($allRequest['datachar01_end'], 2, 3);
        } else {
            $datachar01_end = null;
        }

        if (!empty($allRequest['yoteibi_start'])) {
            $yoteibi_start=str_replace('/','',$allRequest['yoteibi_start']);
        } else {
            $yoteibi_start = null;
        }

        if (!empty($allRequest['yoteibi_end'])) {
            $yoteibi_end=str_replace('/','',$allRequest['yoteibi_end']);
        } else {
            $yoteibi_end = null;
        }

        if (!empty($allRequest['denpyohakkoubi_start'])) {
            $denpyohakkoubi_start=str_replace('/','',$allRequest['denpyohakkoubi_start']);
        } else {
            $denpyohakkoubi_start = null;
        }

        if (!empty($allRequest['denpyohakkoubi_end'])) {
            $denpyohakkoubi_end=str_replace('/','',$allRequest['denpyohakkoubi_end']);
        } else {
            $denpyohakkoubi_end = null;
        }

        $radio_1 = !empty($allRequest['rd1']) ? $allRequest['rd1'] : null;

        //sql where condition creating

        $sql = '';
        if ($yoteibi_start == $yoteibi_end) {
            $sql .= " where substring(replace(nyuko.yoteibi::text,'-',''),1,8) = '$yoteibi_start'";
        } elseif ($yoteibi_start < $yoteibi_end) {
            $sql .= " where substring(replace(nyuko.yoteibi::text,'-',''),1,8)::int between '$yoteibi_start' and '$yoteibi_end'";
        }

        // //$time_sql2 = '';
        if (isset($allRequest['denpyohakkoubi_start']) && ($denpyohakkoubi_start == $denpyohakkoubi_end)) {
            $sql .= " and substring(replace(nyuko.denpyohakkoubi::text,'-',''),1,8)  = '$denpyohakkoubi_start'";
        } elseif ($denpyohakkoubi_start < $denpyohakkoubi_end) {
            $sql .= " and substring(replace(nyuko.denpyohakkoubi::text,'-',''),1,8)::int between '$denpyohakkoubi_start' and '$denpyohakkoubi_end'";
        }

        //$syouhinid_sql = '';
        if(isset($allRequest['syouhinid_start']) && isset($allRequest['syouhinid_end'])){
            if ($syouhinid_start == $syouhinid_end) {
                $sql .= " and cast(nyuko.syouhinid as bigint) = '$syouhinid_start'";
            } elseif($syouhinid_start < $syouhinid_end) {
                $sql .= " and cast(nyuko.syouhinid as bigint) between '$syouhinid_start' and '$syouhinid_end'";
            }
        }elseif(isset($allRequest['syouhinid_start']) && !isset($allRequest['syouhinid_end'])) {
            $sql .= " and cast(nyuko.syouhinid as bigint) >= '$syouhinid_start'";
        }elseif(!isset($allRequest['syouhinid_start']) && isset($allRequest['syouhinid_end'])) {
            $sql .= " and cast(nyuko.syouhinid as bigint) <= '$syouhinid_end'";
        }

        // //$datatxt0004_sql = '';
        // if ($datachar01_start != '' && $datachar01_end != '' && ($datachar01_start != $datachar01_end)) {
        //     $sql .= " and hikiatesyukko2.datachar01::text between '$datachar01_start' and '$datachar01_end'";
        // } else if ($datachar01_start != '') {
        //     $sql .= " and hikiatesyukko2.datachar01::text = '$datachar01_start'";
        // }
        if(isset($allRequest['datachar01_start']) && isset($allRequest['datachar01_end'])){
            if ($datachar01_start < $datachar01_end) {
                $sql .= " and substring(hikiatesyukko2.datachar01::text,1,2)='D9' AND right(hikiatesyukko2.datachar01::text,2) between '$datachar01_start' and '$datachar01_end'";
            } elseif($datachar01_start == $datachar01_end) {
                $sql .= " and substring(hikiatesyukko2.datachar01::text,1,2)='D9' AND right(hikiatesyukko2.datachar01::text,2) = '$datachar01_start'";
            }
        }elseif(isset($allRequest['datachar01_start']) && !isset($allRequest['datachar01_end'])){
            $sql .= " and substring(hikiatesyukko2.datachar01::text,1,2)='D9' AND right(hikiatesyukko2.datachar01::text,2) >= '$datachar01_start'";
        }elseif(!isset($allRequest['datachar01_start']) && isset($allRequest['datachar01_end'])){
            $sql .= " and substring(hikiatesyukko2.datachar01::text,1,2)='D9' AND right(hikiatesyukko2.datachar01::text,2) <= '$datachar01_end'";
        }
        
        if ($radio_1) {
            if ($radio_1=='1'){
                $sql .= " and nyuko.season = '1'";
            }
            elseif($radio_1=='2'){
                $sql .= " and nyuko.season = '2'";
            }
        }

        //dd($sql);

        QueryHelper::runQuery("DROP TABLE IF EXISTS valid_request_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE valid_request_temp AS
            select distinct
            request.syouhinbango||' '||request.jouhou as data_valid,
            request.syouhinbango
            from request
            where color='0614買掛区分'
            ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS purchased_request_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE purchased_request_temp AS
            select distinct
            request.syouhinbango||' '||request.jouhou as purchased_seg,
            request.syouhinbango
            from request
            where color='0614支払会計データ作成フラグ'
            ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS payment_request_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE payment_request_temp AS
            select distinct
            request.syouhinbango||' '||request.jouhou as payment_seg,
            request.syouhinbango
            from request
            where color='0614買掛残高更新フラグ'
            ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS payment_flag_request_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE payment_flag_request_temp AS
            select distinct
            request.syouhinbango||' '||request.jouhou as payment_flag,
            request.syouhinbango
            from request
            where color='0614支払残高更新フラグ'
            ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS payment_history_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE payment_history_temp as
            --select distinct on (hikiatesyukko2.syouhinid,hikiatesyukko2.syouhinsyu)
            select distinct
            nyuko.denpyohakkoubi as denpyohakkoubi,
            REPLACE(substring(CAST(nyuko.denpyohakkoubi AS text),1,10),'-','/') as payment_date,
            nyuko.syouhinid as payment_no,
            nyuko.kaiinid as kaiinid,
            v_torihikisaki1.r16cd as payment_destination,
            nyuko.yoteibi as yoteibi,
            replace(nyuko.yoteibi::text,'-','/') as payment_registration_date_time,
            substring(replace(nyuko.yoteibi::text,'-',''),1,8)::int as  payment_registration_date_time_sort,
            nyuko.season as season,
            valid_request_temp.data_valid as accounts_payable_segment,
            nyuko.yoyakubi as yoyakubi,
            REPLACE(substring(CAST(nyuko.yoyakubi AS text),1,10),'-','/') as fiscal_voucher_date,
            cast(hikiatesyukko2.syouhizeiritu as bigint) as payment_amount_sort,
            to_char(hikiatesyukko2.syouhizeiritu,'FM99,999,999,999,999') as payment_amount,
            hikiatesyukko2.kanryoubi as kanryoubi,
            REPLACE(substring(CAST(hikiatesyukko2.kanryoubi AS text),1,10),'-','/') as payment_due_date,
            concat_ws(' ',CONCAT(RIGHT(categorykanri2.category2, 2), ' ', categorykanri2.category4),CONCAT(RIGHT(categorykanri3.category2, 2), ' ', categorykanri3.category4)) as bank,
            CONCAT(
                RIGHT(categorykanri1.category2, 2), ' ', categorykanri1.category4) as payment_method,
            CONCAT(
                RIGHT(categorykanri2.category2, 2), ' ', categorykanri2.category4) as datachar02_val,
            CONCAT(
                RIGHT(categorykanri3.category2, 2), ' ', categorykanri3.category4) as datachar03_val,
            hikiatesyukko2.datachar01 as datachar01,
            hikiatesyukko2.datachar02 as datachar02,
            hikiatesyukko2.datachar03 as datachar03,
            hikiatesyukko2.datachar11 as remarks,
            hikiatesyukko2.barcode as accounting_subject,
            hikiatesyukko2.codename as accounting_breakdown,
            replace(hikiatesyukko2.denpyohakkoubi::text,'-','/') as payment_item_registration_flag,
            haisoujouhou1.kounyusu as corporate_no,
            hikiatenyuko.syouhinsyu as syouhinsyu,
            purchased_request_temp.purchased_seg as payment_data_creation_flag,
            hikiatenyuko.hantei as hantei,
            payment_request_temp.payment_seg as accounts_payable_update_flag,
            hikiatenyuko.dataint02 as dataint02,
            payment_flag_request_temp.payment_flag as payment_balance_update_flag,
            substring(replace(tantousya_puchaser.name::text,' ',''),1,3) as payment_table_updater,
            tantousya_puchaser.name as payment_table_updater_fullname,
            substring(replace(tantousya_updater.name::text,' ',''),1,3) as payment_flag_updater,
            tantousya_updater.name as payment_flag_updater_fullname,
            substring(replace(tantousya_orderer.name::text,' ',''),1,3) as payment_line_updater,
            tantousya_orderer.name as payment_line_updater_fullname,
            hikiatenyuko.denpyohakkoubi as denpyohakkoubi_n,
            substring(replace(hikiatenyuko.denpyohakkoubi::text,'-',''),1,8)::int as  payment_flag_registration_date_time_sort,
            replace(hikiatenyuko.denpyohakkoubi::text,'-','/') as payment_flag_registration_date_time
            from nyuko
            
            left join hikiatesyukko2
            on hikiatesyukko2.syouhinid = nyuko.syouhinid

            left join hikiatenyuko
            on hikiatenyuko.syouhinid = nyuko.syouhinid

            left join categorykanri as categorykanri1 on categorykanri1.category1='D9' AND hikiatesyukko2.datachar01 = CONCAT(categorykanri1.category1,categorykanri1.category2)
            left join categorykanri as categorykanri2 on categorykanri2.category1='H2' AND hikiatesyukko2.datachar02 = CONCAT(categorykanri2.category1,categorykanri2.category2)
            left join categorykanri as categorykanri3 on categorykanri3.category1='H3' AND hikiatesyukko2.datachar03 = CONCAT(categorykanri3.category1,categorykanri3.category2)
            
            left join valid_request_temp
            on valid_request_temp.syouhinbango = nyuko.season::int

            left join purchased_request_temp
            on purchased_request_temp.syouhinbango = hikiatenyuko.syouhinsyu::int

            left join payment_request_temp
            on payment_request_temp.syouhinbango = hikiatenyuko.hantei::int

            left join payment_flag_request_temp
            on payment_flag_request_temp.syouhinbango = hikiatenyuko.dataint02

            left join tantousya as tantousya_puchaser
            on tantousya_puchaser.bango = nyuko.tantousyabango

            left join tantousya as tantousya_updater
            on tantousya_updater.bango = hikiatenyuko.tantousyabango

            left join tantousya as tantousya_orderer
            on tantousya_orderer.bango = hikiatesyukko2.tantousyabango
            
            left join v_torihikisaki as v_torihikisaki1 on nyuko.kaiinid = substring(v_torihikisaki1.torihikisaki_cd,1,8)
            
            left join haisou as haisou1
            on substring(nyuko.kaiinid,1,6) = haisou1.shikibetsucode and substring(nyuko.kaiinid,7,2) = haisou1.torihikisakibango

            left join haisoujouhou as haisoujouhou1
            on haisou1.kokyakubango = haisoujouhou1.syukei1
            $sql
            
            ORDER BY payment_date,payment_no,payment_method ASC
            ");
        try {
        QueryHelper::fetchResult("select * from payment_history_temp");
        $search_sql = DB::table('payment_history_temp')->toSql();
        } catch (\Exception $e) {
            return 'ng';
        }
        
        return $search_sql;

    }
}
