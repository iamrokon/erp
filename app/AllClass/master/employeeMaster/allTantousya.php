<?php

namespace App\AllClass\master\employeeMaster;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\tantousya;
use App\kengen;


Class allTantousya
{

    public static function data($bango, $deleted_item = 2, $userId = null, $from = false)
    {
        $innerlevel = tantousya::innerLevel($bango);
        QueryHelper::runQuery("DROP TABLE IF EXISTS tantousya_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE tantousya_temp as
        select distinct
        bangoTantousya.bango as employee_bango,
        CASE
            WHEN tantousya.datatxt0030 = '' THEN NULL
            ELSE cast(tantousya.datatxt0030 as integer) END as datatxt0030_search_sort,
        CASE
            WHEN tantousya.datatxt0031 = '' THEN NULL
           ELSE cast(tantousya.datatxt0031 as integer) END as datatxt0031_search_sort,
        CASE
            WHEN tantousya.datatxt0032 = '' THEN NULL
           ELSE cast(tantousya.datatxt0032 as integer) END as datatxt0032_search_sort,
        CASE
            WHEN tantousya.datatxt0033 = '' THEN NULL
           ELSE cast(tantousya.datatxt0033 as integer) END as datatxt0033_search_sort,
          CASE
            WHEN tantousya.datatxt0034 = '' THEN NULL
           ELSE cast(tantousya.datatxt0034 as integer) END as datatxt0034_search_sort,
          CASE
            WHEN tantousya.datatxt0035 = '' THEN NULL
           ELSE cast(tantousya.datatxt0035 as integer) END as datatxt0035_search_sort,
          CASE
            WHEN split_part(tantousya.datatxt0036,'¶',1) = '' THEN NULL
           ELSE cast(split_part(tantousya.datatxt0036,'¶',1) as integer) END as datatxt0036_search_sort,
          CASE
            WHEN split_part(tantousya.datatxt0036,'¶',2) = '' THEN NULL
           ELSE cast(split_part(tantousya.datatxt0036,'¶',2) as integer) END as datatxt0037_search_sort,
        tantousya.bango,
        tantousya.deleteflag,
        tantousya.syounin as employee_syounin,
        tantousya.datatxt0029 as employee_datatxt0029,
         CASE
            WHEN tantousya.syounin is null THEN NULL
            WHEN trim(tantousya.syounin) = '' THEN NULL
            WHEN POSITION('¶' IN tantousya.syounin) != 0
            THEN split_part(tantousya.syounin,'¶',2)
            ELSE tantousya.syounin
        END as syounin,
        tantousya.mail5,
        tantousya.mail4 as employee_mail4,
        CASE
            WHEN tantousya.datatxt0029 is null THEN NULL
            WHEN trim(tantousya.datatxt0029) = '' THEN NULL
            WHEN POSITION('¶' IN tantousya.datatxt0029) != 0
            THEN split_part(tantousya.datatxt0029,'¶',2)
            ELSE tantousya.datatxt0029
        END as datatxt0029,
        CASE
            WHEN tantousya.datatxt0030 is null THEN NULL
            WHEN trim(tantousya.datatxt0030) = '' THEN NULL
            ELSE concat_ws(' ',tantousya.datatxt0030, (select tantousya1.name  where tantousya1.bango=tantousya.datatxt0030) ) END as datatxt0030,
        CASE
            WHEN tantousya.datatxt0031 is null THEN NULL
            WHEN trim(tantousya.datatxt0031) = '' THEN NULL
            ELSE concat_ws(' ',tantousya.datatxt0031, (select tantousya2.name  where tantousya2.bango=tantousya.datatxt0031) ) END as datatxt0031,
        CASE
            WHEN tantousya.datatxt0032 is null THEN NULL
             WHEN trim(tantousya.datatxt0032) = '' THEN NULL
            ELSE concat_ws(' ',tantousya.datatxt0032, (select tantousya3.name  where tantousya3.bango=tantousya.datatxt0032) )END as datatxt0032,
        CASE
            WHEN tantousya.datatxt0033 is null THEN NULL
            WHEN trim(tantousya.datatxt0033) = '' THEN NULL
            ELSE concat_ws(' ',tantousya.datatxt0033, (select tantousya4.name  where tantousya4.bango=tantousya.datatxt0033) ) END as datatxt0033,
        CASE
            WHEN tantousya.datatxt0034 is null THEN NULL
            WHEN trim(tantousya.datatxt0034) = '' THEN NULL
            ELSE concat_ws(' ',tantousya.datatxt0034, (select tantousya5.name  where tantousya5.bango=tantousya.datatxt0034) ) END as datatxt0034,
        CASE
            WHEN tantousya.datatxt0035 is null THEN NULL
            WHEN trim(tantousya.datatxt0035) = '' THEN NULL
            ELSE concat_ws(' ',tantousya.datatxt0035, (select tantousya6.name  where tantousya6.bango=tantousya.datatxt0035) ) END as datatxt0035,
        CASE
            WHEN split_part(tantousya.datatxt0036,'¶',1) is null THEN NULL
            WHEN trim(split_part(tantousya.datatxt0036,'¶',1)) = '' THEN NULL
            ELSE concat_ws(' ',split_part(tantousya.datatxt0036,'¶',1), (select tantousya7.name  where tantousya7.bango = split_part(tantousya.datatxt0036,'¶',1) ) ) END as datatxt0036,
        CASE
            WHEN split_part(tantousya.datatxt0036,'¶',2) is null THEN NULL
            WHEN trim(split_part(tantousya.datatxt0036,'¶',2)) = '' THEN NULL
            ELSE concat_ws(' ',split_part(tantousya.datatxt0036,'¶',2), (select tantousya8.name  where tantousya8.bango=split_part(tantousya.datatxt0036,'¶',2)) )END as datatxt0037,
        tantousya.datatxt0030 as  datatxt0030_edit,
        tantousya.datatxt0031 as  datatxt0031_edit,
        tantousya.datatxt0032 as  datatxt0032_edit,
        tantousya.datatxt0033 as  datatxt0033_edit,
        tantousya.datatxt0034 as  datatxt0034_edit,
        tantousya.datatxt0035 as  datatxt0035_edit,
        split_part(tantousya.datatxt0036,'¶',1) as  datatxt0036_edit,
        split_part(tantousya.datatxt0036,'¶',2) as  datatxt0037_edit,
        tantousya.datatxt0038,
        tantousya.datatxt0039,
        CASE
        WHEN tantousya.name is null THEN NULL
        WHEN trim(tantousya.name) = '' THEN NULL
        ELSE tantousya.name END,
        tantousya.datatxt0003,
        tantousya.datatxt0004,
        tantousya.datatxt0005,
        tantousya.htanka,
        tantousya.ztanka,
        tantousya.innerlevel,
        CAST(CASE
             WHEN trim(tantousya.datatxt0003 || ' ' || categorykanri3.category4) = '' THEN NULL
             ELSE (tantousya.datatxt0003 || ' ' || categorykanri3.category4) END as varchar(100)) as company_1,
        CAST(CASE
            WHEN trim(tantousya.datatxt0004 || ' ' || categorykanri4.category4) = '' THEN NULL
                 ELSE (tantousya.datatxt0004 || ' ' || categorykanri4.category4) END as varchar(100)) as company_2,
        CAST(CASE
            WHEN trim(tantousya.datatxt0005 || ' ' || categorykanri5.category4) = '' THEN NULL
                 ELSE (tantousya.datatxt0005 || ' ' || categorykanri5.category4) END as varchar(100)) as company_3,
        CASE
            WHEN tantousya.syozoku is null THEN NULL
            WHEN trim(tantousya.syozoku) = '' THEN NULL
            ELSE tantousya.syozoku END,
        REPEAT('*',CHAR_LENGTH (tantousya.passwd))  as passwd,
        tantousya.passwd AS password,
        CASE
            WHEN trim(tantousya.mail4 || ' ' || categorykanrik.category4) is null THEN NULL
            WHEN trim(tantousya.mail4 || ' ' || categorykanrik.category4) = '' THEN NULL
            ELSE (tantousya.mail4 || ' ' || categorykanrik.category4) END as mail4,
        CASE
            WHEN trim(categorykanri7.category2 || ' ' || categorykanri7.category4) = '' THEN NULL
            ELSE (categorykanri7.category2 || ' ' || categorykanri7.category4) END as recog_dept,
        CASE
            WHEN trim(categorykanri7.category1  || categorykanri7.category2) = '' THEN NULL
            ELSE (categorykanri7.category1  || categorykanri7.category2)  END as edit_recog_dept,
        CASE
            WHEN trim(tantousya.mail2) = '' THEN NULL
            ELSE tantousya.mail2 END as employee_mail2,
        CASE
            WHEN trim( tantousya.mail3) = '' THEN NULL
            ELSE  tantousya.mail3 END,
        tantousya.mail,
        tantousyaOld.name as user_name,
        CASE
            WHEN trim(tantousya.datatxt0038) = '' THEN NULL
            ELSE concat_ws('/',substring(tantousya.datatxt0038,1,4),
            substring(tantousya.datatxt0038,5,2),
            substring(tantousya.datatxt0038,7,2)) END as created_date ,

        CASE
            WHEN trim(tantousya.datatxt0038) = '' THEN NULL
            ELSE concat_ws(':',substring(tantousya.datatxt0038,9,2),
            substring(tantousya.datatxt0038,11,2),
            substring(tantousya.datatxt0038,13,2)) END as created_time,

        CASE
            WHEN trim(tantousya.datatxt0039) = '' THEN NULL
            WHEN trim(tantousya.datatxt0039) is null THEN NULL
            ELSE concat_ws('/',substring(tantousya.datatxt0039,1,4),
            substring(tantousya.datatxt0039,5,2),
            substring(tantousya.datatxt0039,7,2)) END as edited_date,
        CASE
            WHEN trim(tantousya.datatxt0039) = '' THEN NULL
             WHEN trim(tantousya.datatxt0039) is null THEN NULL
            ELSE concat_ws(':',substring(tantousya.datatxt0039,9,2),
            substring(tantousya.datatxt0039,11,2),
            substring(tantousya.datatxt0039,13,2)) END as edited_time
        from tantousya
            left join categorykanri as categorykanri3
              on substring(tantousya.datatxt0003,1,2) = categorykanri3.category1
                  and substring(tantousya.datatxt0003,3,length(categorykanri3.category2)) = categorykanri3.category2
                         and categorykanri3.suchi2 = 0
            left join categorykanri as categorykanri4
                on substring(tantousya.datatxt0004,1,2) = categorykanri4.category1
                       and substring(tantousya.datatxt0004,3,length(categorykanri4.category2)) = categorykanri4.category2
                            and categorykanri4.suchi2 = 0
            left join categorykanri as categorykanri5
                on substring(tantousya.datatxt0005,1,2) = categorykanri5.category1
                       and substring(tantousya.datatxt0005,3,length(categorykanri5.category2)) = categorykanri5.category2
                        and categorykanri5.suchi2 = 0
            left join categorykanri as categorykanrik
                on substring(tantousya.mail4,1,2) = categorykanrik.category1
                       and substring(tantousya.mail4,3,2) = categorykanrik.category2
                        and categorykanrik.suchi2 = 0
            left join categorykanri as categorykanri7
                on substring(tantousya.datatxt0037,1,2) = categorykanri7.category1
                    and substring(tantousya.datatxt0037,3,length(categorykanri7.category2)) = categorykanri7.category2
                    and categorykanri7.suchi2 = 0
            left join tantousya as tantousya1
                on tantousya.datatxt0030 = tantousya1.bango
            left join tantousya as bangoTantousya
                on tantousya.bango = bangoTantousya.bango and tantousya.innerlevel >= $innerlevel --and tantousya.deleteflag = 0
            left join tantousya as tantousya2
                on tantousya.datatxt0031 = tantousya2.bango
            left join tantousya as tantousya3
                on tantousya.datatxt0032 = tantousya3.bango
            left join tantousya as tantousya4
                on tantousya.datatxt0033 = tantousya4.bango
            left join tantousya as tantousya5
                on tantousya.datatxt0034 = tantousya5.bango
            left join tantousya as tantousya6
                on tantousya.datatxt0035 = tantousya6.bango
            left join tantousya as tantousya7
                on split_part(tantousya.datatxt0036,'¶',1) = tantousya7.bango
            left join tantousya as tantousya8
                on split_part(tantousya.datatxt0036,'¶',2) = tantousya8.bango
            left join tantousya tantousyaOld on tantousyaOld.bango = CAST(tantousya.mail5 as varchar(100))

        ORDER BY bango
        ");
        if ($deleted_item == 1) {
            $data = DB::table('tantousya_temp')->whereRaw('deleteflag = ' . 1);
        } else if ($deleted_item === 0) {
            $data = DB::table('tantousya_temp')->whereRaw('deleteflag = ' . 0);
        } else if ($deleted_item === '*') {
            $data = DB::table('tantousya_temp');
        }
        if (!$from) {
            $data = $data->whereRaw("innerlevel >= " . $innerlevel);
        }
        if ($userId) {
            $data = $data->whereRaw("bango = '$userId'")->toSql();
        } else {
            $data = $data->toSql();
        }
        return $data;
    }
}

