<?php

namespace App\AllClass\purchase\purchaseSlip;

use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AllPurchaseSlip
{
    public static function readData($bango, $allRequest)
    {

       //dd($allRequest);


        if (!empty($allRequest['reg_sold_to'])) {
            $reg_sold_to = $allRequest['reg_sold_to'];
        } else {
            $reg_sold_to = null;
        }

        if (!empty($allRequest['input_person'])) {
            $input_person = $allRequest['input_person'];
        } else {
            $input_person = null;
        }

        //sql where condition creating

        $sql = '';
        if ($reg_sold_to) {
            $sql .= " where kaiin.mail::text = '$reg_sold_to'";
        }
        if ($input_person) {
            $sql .= " and kaiin.terminal::text = '$input_person'";
        }

        QueryHelper::runQuery("DROP TABLE IF EXISTS temp_v_torihikisaki");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE temp_v_torihikisaki as
        select substring(torihikisaki_cd::text,1,8) as torihikisaki_cd_new, max(R20CD) as R20CD
        from v_torihikisaki group by torihikisaki_cd_new
        ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_slip_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_slip_temp as
            select
            kaiin.bango,
            kaiin.mail as reg_sold_to,
            kaiin.syukei3 as line_number,
            kaiin.syukei4 as display_order,
            kaiin.syukei5 as group,
            kaiin.mail2 as order_to,
            temp_v_torihikisaki.R20CD as order_to_full,
            kaiin.kaka as incharge_purchasing,
            kaiin.sex as product_cd,
            kaiin.address as product_name,
            kaiin.kokyakubango as purchase_quantity,
            kaiin.pointlimit as purchase_unit_price,
            kaiin.lastusepoint as purchase_line_amount,
            kaiin.lastbuy as purchase_consumption_amount,
            kaiin.kenadd as accounting_subject,
            kaiin.ciadd as accounting_breakdown,
            kaiin.nickname as remarks, 
            kaiin.syukeikikijun as retain,
            kaiin.syukeiki as last_datetime,
            kaiin.terminal as input_person
            from kaiin

            left join temp_v_torihikisaki
            on kaiin.mail2=temp_v_torihikisaki.torihikisaki_cd_new
            $sql

            ORDER BY kaiin.syukei4 ASC
            ");
        try {
        QueryHelper::fetchResult("select * from purchase_slip_temp");
        $search_sql = DB::table('purchase_slip_temp')->toSql();
        } catch (\Exception $e) {
            return 'ng';
        }
        
        return $search_sql;

    }
}
