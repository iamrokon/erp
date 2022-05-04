<?php

namespace App\AllClass\purchase\supportReqConfirmation;

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
        orderhenkan.datatxt0151

        from orderhenkan
        
        where kokyakuorderbango = '$kokyakuorderbango' AND orderhenkan.datatxt0151 IS NOT NULL
        
        ");

        $data=DB::table('downloaded_pdf');

        return $data;
        
    }
}
