<?php

namespace App\AllClass\purchase\purchaseBalanceList;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class AllPurchaseBalanceList{
    public static function data($login_bango,$deleted_item=2,$req_data=null){

        //QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_m");
        //QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_m as
        //select distinct 
        //kokyakuorderbango, max(ordertypebango2) as maxval
        //from orderhenkan
        //--where synchroorderbango = 0 
        //group by kokyakuorderbango");
        
        $kk0001 = $req_data['kk0001'];
        $kk0002_start = (int) $req_data['db_kk0002_start'];
        $kk0002_end = (int) $req_data['db_kk0002_end'];
        $sql = "WHERE to_char(kk0001, 'YYYY/MM') = '$kk0001'";
        if($kk0002_start != "" && $kk0002_end != ""){
            $sql .= " AND (kk0002::int >= $kk0002_start AND kk0002::int <= $kk0002_end) ";
        }else if($kk0002_start != "" && $kk0002_end == ""){
            $sql .= " AND (kk0002::int >= $kk0002_start) ";
        }else if($kk0002_start == "" && $kk0002_end != ""){
            $sql .= " AND (kk0002::int <= $kk0002_end) ";
        }
        
        if($req_data['rd'] == 'rd_2'){
            $sql .= " AND kk0003 = '2' ";
        }else{
            $sql .= " AND kk0003 = '1' ";
        }
       
        QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_balance_list_temp");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE purchase_balance_list_temp as
        select distinct 
        to_char(kk0001, 'YYYY/MM') as kk0001,
        date(kaikakezandaka.kk0001) display_kk0001,
        kaikakezandaka.kk0002,
        kk0002Detail.r16 as supplier_name,
        kaikakezandaka.kk0004,
        to_char(kaikakezandaka.kk0004,'FM99,999,999,999,999') as formatted_kk0004,
        kaikakezandaka.kk0005,
        to_char(kaikakezandaka.kk0005,'FM99,999,999,999,999') as formatted_kk0005,
        (COALESCE(kaikakezandaka.kk0006,0) + COALESCE(kaikakezandaka.kk0007,0) + COALESCE(kaikakezandaka.kk0008,0)) as purchase_discount,
        to_char((COALESCE(kaikakezandaka.kk0006,0) + COALESCE(kaikakezandaka.kk0007,0) + COALESCE(kaikakezandaka.kk0008,0)),'FM99,999,999,999,999') as formatted_purchase_discount,
        kaikakezandaka.kk0009,
        to_char(kaikakezandaka.kk0009,'FM99,999,999,999,999') as formatted_kk0009,
        kaikakezandaka.kk0010,
        to_char(kaikakezandaka.kk0010,'FM99,999,999,999,999') as formatted_kk0010,
        kaikakezandaka.kk0011,
        to_char(kaikakezandaka.kk0011,'FM99,999,999,999,999') as formatted_kk0011,
        (COALESCE(kaikakezandaka.kk0012,0) + COALESCE(kaikakezandaka.kk0013,0) + COALESCE(kaikakezandaka.kk0014,0)) as payment_discount,
        to_char((COALESCE(kaikakezandaka.kk0012,0) + COALESCE(kaikakezandaka.kk0013,0) + COALESCE(kaikakezandaka.kk0014,0)),'FM99,999,999,999,999') as formatted_payment_discount,
        kaikakezandaka.kk0015,
        to_char(kaikakezandaka.kk0015,'FM99,999,999,999,999') as formatted_kk0015,
        kaikakezandaka.kk0016,
        to_char(kaikakezandaka.kk0016,'FM99,999,999,999,999') as formatted_kk0016,
        kaikakezandaka.kk0017,
        to_char(kaikakezandaka.kk0017,'FM99,999,999,999,999') as formatted_kk0017,
        kaikakezandaka.kk0018,
        to_char(kaikakezandaka.kk0018,'FM99,999,999,999,999') as formatted_kk0018,
        kaikakezandaka.kk0019,
        to_char(kaikakezandaka.kk0019,'FM99,999,999,999,999') as formatted_kk0019,
        kaikakezandaka.kk0020,
        to_char(kaikakezandaka.kk0020,'FM99,999,999,999,999') as formatted_kk0020,
        (COALESCE(kaikakezandaka.kk0021,0) + COALESCE(kaikakezandaka.kk0022,0) + COALESCE(kaikakezandaka.kk0023,0)) as prepaid_payment_discount,
        to_char((COALESCE(kaikakezandaka.kk0021,0) + COALESCE(kaikakezandaka.kk0022,0) + COALESCE(kaikakezandaka.kk0023,0)),'FM99,999,999,999,999') as formatted_prepaid_payment_discount,
        kaikakezandaka.kk0024,
        to_char(kaikakezandaka.kk0024,'FM99,999,999,999,999') as formatted_kk0024
        
        from kaikakezandaka
        
        left join v_torihikisaki as kk0002Detail on substring(kk0002Detail.torihikisaki_cd,1,8) = kaikakezandaka.kk0002
        AND substring(kk0002Detail.torihikisaki_cd,9,3) = '001'
        
        $sql
        
        order by kk0002
        ");

        
        $data = DB::table('purchase_balance_list_temp');

        return $data;
        
    }
}
