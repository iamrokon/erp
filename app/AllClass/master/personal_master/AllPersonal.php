<?php


namespace App\AllClass\master\personal_master;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;

class AllPersonal
{
    public static function data($bango, $deleted_item = 2, $officeId = false)
    {
        QueryHelper::runQuery("DROP TABLE IF EXISTS personal_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE personal_temp as
        select distinct
        CASE
        WHEN trim(kokyaku1.yobi12) = '' THEN NULL
        ELSE trim(kokyaku1.yobi12) END as personal_company_cd,
        CASE
        WHEN trim(kokyaku1.yobi12) = '' THEN NULL
        ELSE cast(kokyaku1.yobi12 as integer) END as company_cd_search_sort,

        CASE
        WHEN trim(kokyaku1.name) = '' THEN NULL
        ELSE trim(kokyaku1.name) END as company_name,
        CASE
        WHEN trim(haisou.torihikisakibango) = '' THEN NULL
        ELSE trim(haisou.torihikisakibango) END as personal_office_cd,
        CASE
        WHEN trim(haisou.torihikisakibango) = '' THEN NULL
        ELSE cast(haisou.torihikisakibango as integer) END as office_cd_search_sort,

        CASE
        WHEN trim(haisou.name) = '' THEN NULL
        ELSE trim(haisou.name) END as office_name,
        etsuransya.datatxt0014 as personal_datatxt0014,
        etsuransya.datatxt0015 as personal_datatxt0015,
        CASE
        WHEN trim(etsuransya.datatxt0049) = '' THEN NULL
        ELSE etsuransya.datatxt0049 END as personal_datatxt0049,
        CASE
        WHEN trim(etsuransya.datatxt0049) = '' THEN NULL
        ELSE cast( etsuransya.datatxt0049 as integer) END as datatxt0049_search_sort,

        CASE
        WHEN trim(etsuransya.mail2) = '' THEN NULL
        ELSE etsuransya.mail2 END as mail2,
        CASE
        WHEN trim(etsuransya.mail3) = '' THEN NULL
        ELSE etsuransya.mail3 END as mail3,
        CASE
        WHEN trim(etsuransya.tantousya) = '' THEN NULL
        ELSE etsuransya.tantousya END as tantousya,
        CASE
        WHEN trim(etsuransya.mail4) = '' THEN NULL
        ELSE etsuransya.mail4 END as mail4,
        CASE
        WHEN trim(etsuransya.mail5) = '' THEN NULL
        ELSE etsuransya.mail5 END as mail5,
        CASE
        WHEN trim(etsuransya.mail1) = '' THEN NULL
        ELSE etsuransya.mail1 END as mail1,
        CASE
        WHEN trim(etsuransya.datatxt0016) = '' THEN NULL
        ELSE etsuransya.datatxt0016 END as personal_datatxt0016,
        CASE
        WHEN trim( etsuransya.datatxt0017) = '' THEN NULL
        ELSE  etsuransya.datatxt0017 END as personal_datatxt0017,
        CASE
        WHEN trim( etsuransya.datatxt0018) = '' THEN NULL
        ELSE  etsuransya.datatxt0018 END as datatxt0018,
        CASE
        WHEN trim( etsuransya.datatxt0040) = '' THEN NULL
        ELSE  etsuransya.datatxt0040 END as datatxt0040,
        CASE
        WHEN trim( etsuransya.datatxt0041) = '' THEN NULL
        ELSE  etsuransya.datatxt0041 END as datatxt0041,
        CASE
        WHEN trim( etsuransya.datatxt0042) = '' THEN NULL
        ELSE  etsuransya.datatxt0042 END as datatxt0042,
        CASE
        WHEN trim( etsuransya.datatxt0043) = '' THEN NULL
        ELSE  etsuransya.datatxt0043 END as datatxt0043,
        CASE
        WHEN trim( etsuransya.datatxt0044) = '' THEN NULL
        ELSE  etsuransya.datatxt0044 END as datatxt0044,
        CASE
        WHEN trim( etsuransya.datatxt0045) = '' THEN NULL
        ELSE  etsuransya.datatxt0045 END as datatxt0045,
        etsuransya.datanum0018,
        CASE
        WHEN  trim(etsuransya.datatxt0046) is null THEN NULL
        ELSE concat_ws('/',substring(etsuransya.datatxt0046,1,4),
        substring(etsuransya.datatxt0046,5,2),
        substring(etsuransya.datatxt0046,7,2)) END as created_date,
        CASE
        WHEN trim(etsuransya.datatxt0046) is null THEN NULL
        ELSE concat_ws(':',substring(etsuransya.datatxt0046,9,2),
        substring(etsuransya.datatxt0046,11,2),
        substring(etsuransya.datatxt0046,13,2))  END as created_time,
        CASE
        WHEN trim(etsuransya.datatxt0047) is null THEN NULL
        ELSE  concat_ws('/',substring(etsuransya.datatxt0047,1,4),
        substring(etsuransya.datatxt0047,5,2),
        substring(etsuransya.datatxt0047,7,2)) END as edited_date,
        CASE
        WHEN trim(etsuransya.datatxt0047) is null THEN NULL
        ELSE  concat_ws(':',substring(etsuransya.datatxt0047,9,2),
        substring(etsuransya.datatxt0047,11,2),
        substring(etsuransya.datatxt0047,13,2)) END as edited_time,
       etsuransya.datatxt0048,
        cast(etsuransya.datatxt0090 as varchar(100)),
        etsuransya.bango,
        tantousya.name as created_by,
        etsuransya.deleteflag,
        kokyaku1.bango as kokyaku1bango,
        haisou.bango as haisoubango
        from etsuransya
        left join kokyaku1
           on etsuransya.datatxt0014 = kokyaku1.yobi12
        left join  tantousya
            on  cast(etsuransya.datatxt0090 as varchar(100)) = cast(tantousya.bango as varchar(100))
        left join haisou
           on etsuransya.datanum0018 = haisou.bango  order by kokyaku1bango, haisoubango");

        if ($deleted_item == 1) {
            $data = DB::table('personal_temp')->whereRaw("deleteflag = 1");
        } elseif ($deleted_item == 0) {
            $data = DB::table('personal_temp')->whereRaw("deleteflag = 0");
        } else {
            $data = DB::table('personal_temp');
        }
        if ($officeId) {
            $data = $data->whereRaw("datanum0018 = $officeId");
        }
        return $data->toSql();
    }

}
