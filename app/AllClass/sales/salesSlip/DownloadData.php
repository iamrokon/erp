<?php

namespace App\AllClass\sales\salesSlip;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\kengen;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class DownloadData{
    public static function data($bango,$deleted_item=2,$kokyakuorderbango=null){

        QueryHelper::runQuery("DROP TABLE IF EXISTS downloaded_pdf");

        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE downloaded_pdf as
        select 
        orderhenkan.datachar10,
        tuhanorder.juchubango,
        tuhanorder.information2,
        LEFT(tuhanorder.information2,8) as information2_short,
        kokyaku1Information2.name as company_name,
        kokyaku1Information2.address as company_address,
        haisouInformation2.haisoumoji1 as office_haisoumoji1,
        tuhanorder.juchukubun2

        from tuhanorder
        
        join orderhenkan on orderhenkan.bango = tuhanorder.orderbango
        
        --information2
        left join kokyaku1 as kokyaku1Information2
        on substring(tuhanorder.information2,1,6) = kokyaku1Information2.yobi12
        
        left join haisou as haisouInformation2
        on substring(tuhanorder.information2,7,2) = haisouInformation2.torihikisakibango
        and kokyaku1Information2.bango = haisouInformation2.kokyakubango
        
        left join etsuransya as etsuransyaInformation2
        on substring(tuhanorder.information2,9,3) = etsuransyaInformation2.datatxt0049
        and haisouInformation2.bango::text = etsuransyaInformation2.datanum0018::text
        --information2 end
        
        where juchubango = '$kokyakuorderbango' AND orderhenkan.datachar10 IS NOT NULL
        
        ");

        $data=DB::table('downloaded_pdf');

        return $data;
        
    }
}
