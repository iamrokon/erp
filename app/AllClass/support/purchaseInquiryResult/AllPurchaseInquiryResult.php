<?php

namespace App\AllClass\support\purchaseInquiryResult;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\kengen;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class AllPurchaseInquiryResult{
    public static function data($login_bango,$support_number, $kokyakuorderbango){
        // dd($support_number, $kokyakuorderbango);

        QueryHelper::runQuery("DROP TABLE IF EXISTS minyuko_m");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE minyuko_m as
        select distinct 
        syouhinid,syouhinsyu, max(zaikometer) as maxval
        from minyuko
        where denpyobango =0 
        group by syouhinid, syouhinsyu");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_inquiry_result_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_inquiry_result_temp as
        select  distinct
        minyuko.syouhinid,
        minyuko.syouhinsyu,
        -- minyuko.datachar13,
        -- minyuko.datachar01,
        -- minyuko.zaikometer,
        -- minyuko.syouhizeiritu,
        -- juchusyukko2.tanka,
        -- juchusyukko2.barcode,
        -- juchusyukko2.codename,
        toiawasebango.unsoumei,
        CASE 
            WHEN LENGTH(nyukoold.syouhinsyu::text)=2 
            THEN concat_ws('0', nyukoold.syouhinid, nyukoold.syouhinsyu)
            WHEN LENGTH(nyukoold.syouhinsyu::text)=1 
            THEN concat_ws('00', nyukoold.syouhinid, nyukoold.syouhinsyu)
            ELSE concat_ws('', nyukoold.syouhinid, nyukoold.syouhinsyu)
        END AS purchase_slip_number,
        CASE 
            WHEN LENGTH(nyukoold.yoteimeter::text)=2 
            THEN concat_ws('0', nyukoold.idoutanabango, nyukoold.yoteimeter)
            WHEN LENGTH(nyukoold.yoteimeter::text)=1 
            THEN concat_ws('00', nyukoold.idoutanabango, nyukoold.yoteimeter)
            ELSE concat_ws('', nyukoold.idoutanabango, nyukoold.yoteimeter)
        END AS order_number,
        CASE
            WHEN toiawasebango.dataint01::text is null THEN NULL
            ELSE concat_ws('/',substring(toiawasebango.dataint01::text,1,4),
            substring(toiawasebango.dataint01::text,5,2),
            substring(toiawasebango.dataint01::text,7,2)) 
        END as purchase_date,
        v_torihikisaki_1.r16cd as supplier,
        toiawasebango.denpyoname as delivery_note_number,
        nyukoold.datachar08 as product_name,
        nyukoold.nyukosu as purchase_inquiry_quantity,
        to_char(nyukoold.nyukosu,'FM99,999,999,999,999') as purchase_inquiry_formatted_quantity,
        nyukoold.kingaku as purchase_inquiry_unit_price,
        to_char(nyukoold.kingaku,'FM99,999,999,999,999') as purchase_inquiry_formatted_unit_price,
        (nyukoold.nyukosu*nyukoold.kingaku) as purchase_inquiry_amount,
        to_char(nyukoold.nyukosu*nyukoold.kingaku,'FM99,999,999,999,999') as purchase_inquiry_formatted_amount
        from minyuko
        JOIN orderhenkan
            ON minyuko.syouhinid = orderhenkan.kokyakuorderbango
            and orderhenkan.synchroorderbango2 = 0
        left join juchusyukko2 
            on juchusyukko2.syouhinid = minyuko.syouhinid and juchusyukko2.syouhinsyu = minyuko.syouhinsyu
        join nyukoold 
            on nyukoold.idoutanabango = minyuko.syouhinid
            and nyukoold.yoteimeter = minyuko.syouhinsyu
            and nyukoold.denpyobango = 0
        left join toiawasebango on toiawasebango.unsoumei = nyukoold.syouhinid
        left join v_torihikisaki as v_torihikisaki_1 on substring(v_torihikisaki_1.torihikisaki_cd,1,8) = toiawasebango.bikou1
        join minyuko_m on
            minyuko_m.syouhinid=minyuko.syouhinid
            and minyuko_m.syouhinsyu = minyuko.syouhinsyu
            and minyuko_m.maxval= minyuko.zaikometer
        -- where minyuko.syouhinid = '$kokyakuorderbango'
        where orderhenkan.datatxt0152 = '$support_number'
        ");
        
        // $temp_purchase_data = QueryHelper::fetchResult("select * from purchase_inquiry_result_temp");
        // dd($temp_purchase_data);
        // return $data;
        return DB::table('purchase_inquiry_result_temp');
    }
}
