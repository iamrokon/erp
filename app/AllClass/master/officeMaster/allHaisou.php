<?php

namespace App\AllClass\master\officeMaster;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\requestTable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\haisou;


Class allHaisou
{
    public static function data($bango, $deleted_item = 2, $haisouId = false, $com_yobi12 = null)
    {
        QueryHelper::runQuery("DROP TABLE IF EXISTS haisou_temp");

    QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE haisou_temp as
select distinct
CASE
    WHEN trim(haisou.shikibetsucode) = '' THEN NULL
    ELSE trim(haisou.shikibetsucode) END as office_shikibetsucode,
CASE
    WHEN haisou.shikibetsucode is null or haisou.shikibetsucode='' THEN NULL
    ELSE CAST(haisou.shikibetsucode as integer) END as shikibetsucode,
    
LPAD(CAST(haisou.torihikisakibango as integer)::text, 2, '0') as office_torihikisakibango,
CAST(haisou.torihikisakibango as integer) as torihikisakibango,
haisou.kokyakubango,
haisou.name,
haisou.haisoumoji1,
haisou.haisoumoji2,
haisou.torihikisakirank1,

haisou.syukeitukikijun,
CASE
    WHEN haisou.syukeitukikijun is null or haisou.syukeitukikijun='' THEN NULL
    ELSE CAST(haisou.syukeitukikijun as integer) END as syukeitukikijun_search_sort,
    
haisou.syukeituki,
CASE
    WHEN haisou.syukeituki is null or haisou.syukeituki='' THEN NULL
    ELSE CAST(haisou.syukeituki as integer) END as syukeituki_search_sort,

haisou.syukeikikijun,
CASE
    WHEN haisou.syukeikikijun is null or haisou.syukeikikijun='' THEN NULL
    ELSE CAST(haisou.syukeikikijun as integer) END as syukeikikijun_search_sort,

haisou.syukeinenkijun,
CASE
    WHEN haisou.syukeinenkijun is null or haisou.syukeinenkijun='' THEN NULL
    ELSE CAST(haisou.syukeinenkijun as integer) END as syukeinenkijun_search_sort,

CASE
    WHEN trim(haisou.yubinbango) = '' THEN NULL
    ELSE haisou.yubinbango END as office_yubinbango,
CASE
    WHEN trim(haisou.address) = '' THEN NULL
    ELSE haisou.address END as address,
CASE
    WHEN trim(haisou.tel) = '' THEN NULL
    ELSE haisou.tel END as office_tel,
CASE
    WHEN trim(haisou.torihikisakirank2) = '' THEN NULL
    ELSE haisou.torihikisakirank2 END as office_torihikisakirank2,
CASE
    WHEN trim(haisou.yobi1) = '' THEN NULL
    ELSE haisou.yobi1 END as office_yobi1,
CASE
    WHEN trim(haisou.mail) = '' THEN NULL
    ELSE haisou.mail END as mail,
haisou.kounyusu,
haisou.syukeiki,
haisou.netlogin,
kokyaku1.name as endtime,
CASE
    WHEN trim(kokyaku.name) = '' THEN NULL
    ELSE trim(kokyaku.name) END as gaishamei,
CASE
    WHEN trim(CONCAT(haisou.torihikisakirank1,' ',request.jouhou)) = '' THEN NULL
    ELSE trim(CONCAT(haisou.torihikisakirank1,' ',request.jouhou)) END as torihikisakirank1jouhou,
CASE
    WHEN trim(CONCAT(haisou.syukeitukikijun,' ',tantousya2.name)) = '' THEN NULL
    ELSE trim(CONCAT(haisou.syukeitukikijun,' ',tantousya2.name)) END as syukeitukikijunwithname,
CASE
    WHEN trim(CONCAT(haisou.syukeituki,' ',tantousya3.name)) = '' THEN NULL
    ELSE trim(CONCAT(haisou.syukeituki,' ',tantousya3.name)) END as syukeitukiwithname,
CASE
    WHEN trim(CONCAT(haisou.syukeikikijun,' ',tantousya4.name)) = '' THEN NULL
    ELSE trim(CONCAT(haisou.syukeikikijun,' ',tantousya4.name)) END as syukeikikijunwithname,
CASE
    WHEN trim(CONCAT(haisou.syukeinenkijun,' ',tantousya1.name))  = '' THEN NULL
    ELSE trim(CONCAT(haisou.syukeinenkijun,' ',tantousya1.name)) END as syukeinenkijunwithname,
haisou.netusername,
haisou.netuserpasswd,
haisou.bango as bango,
CASE
    WHEN haisou.netusername is null THEN NULL
    ELSE concat_ws('/',substring(haisou.netusername,1,4),
    substring(haisou.netusername,5,2),
    substring(haisou.netusername,7,2)) END as created_date,
CASE
    WHEN haisou.netusername is null THEN NULL
    ELSE concat_ws(':',substring(haisou.netusername,9,2),
    substring(haisou.netusername,11,2),
    substring(haisou.netusername,13,2)) END as created_time,

CASE
    WHEN haisou.netuserpasswd is null THEN NULL
    ELSE concat_ws('/',substring(haisou.netuserpasswd,1,4),
    substring(haisou.netuserpasswd,5,2),
    substring(haisou.netuserpasswd,7,2)) END as updated_date,
CASE
    WHEN haisou.netuserpasswd is null THEN NULL
    ELSE concat_ws(':',substring(haisou.netuserpasswd,9,2),
    substring(haisou.netuserpasswd,11,2),
    substring(haisou.netuserpasswd,13,2)) END as updated_time,

substring(haisou.yubinbango,1,3) as zip1,
substring(haisou.yubinbango,4,4) as zip2,

others2.other1 as other1,
others2.other2 as other2,

others2.other3,
CASE
    WHEN trim(others2.other3 || ' ' || categorykanriOther3.category4) = '' THEN NULL
    ELSE trim(others2.other3 || ' ' || categorykanriOther3.category4) END as other3_detail,

others2.other4,
CASE
    WHEN trim(others2.other4 || ' ' || categorykanriOther4.category4) = '' THEN NULL
    ELSE trim(others2.other4 || ' ' || categorykanriOther4.category4) END as other4_detail,

others2.other5,
others2.other6::int as office_other6,
others2.other7,
others2.other8,
others2.otherfloat1,
to_char(others2.otherfloat1,'FM99,999,999,999,999') as formatted_otherfloat1,
others2.other9 as office_other9,
CASE
    WHEN others2.other9 is null or others2.other9='' THEN NULL
    ELSE CAST(others2.other9 as bigint) END as other9_search_sort,

others2.other10::int as office_other10,
others2.other11,
others2.other12,
others2.other13,
others2.other14,

others2.other15 as office_other15,
CASE
    WHEN others2.other15 is null or others2.other15='' THEN NULL
    ELSE CAST(others2.other15 as bigint) END as other15_search_sort,

others2.other16,
CASE
    WHEN trim(others2.other16 || ' ' || categorykanriOther16.category4) = '' THEN NULL
    ELSE trim(others2.other16 || ' ' || categorykanriOther16.category4) END as other16_detail,

others2.other17,

others2.other18,
CASE
    WHEN trim(others2.other18 || ' ' || categorykanriOther18.category4) = '' THEN NULL
    ELSE trim(others2.other18 || ' ' || categorykanriOther18.category4) END as other18_detail,

others2.other19 as other19,
CASE
    WHEN trim(others2.other19 || ' ' || categorykanriOther19.category4) = '' THEN NULL
    ELSE trim(others2.other19 || ' ' || categorykanriOther19.category4) END as other19_detail,

others2.other20,
others2.other21,
CASE
    WHEN trim(others2.other21 || ' ' || categorykanriOther21.category4) = '' THEN NULL
    ELSE trim(others2.other21 || ' ' || categorykanriOther21.category4) END as other21_detail,

others2.other22,
others2.other23,

others2.other24,
CASE
    WHEN trim(others2.other24 || ' ' || categorykanriOther24.category4) = '' THEN NULL
    ELSE trim(others2.other24 || ' ' || categorykanriOther24.category4) END as other24_detail,

others2.otherfloat2,

others2.other30,
CASE
    WHEN trim(others2.other30 || ' ' || categorykanriOther30.category4) = '' THEN NULL
    ELSE trim(others2.other30 || ' ' || categorykanriOther30.category4) END as other30_detail,

others2.other25 as office_other25,
others2.other26 as office_other26,
others2.otherfloat4,
others2.other27 as office_other27,
others2.other28,

others2.other31,
CASE
    WHEN trim(others2.other31 || ' ' || categorykanriOther31.category4) = '' THEN NULL
    ELSE trim(others2.other31 || ' ' || categorykanriOther31.category4) END as other31_detail,

others2.other32,
CASE
    WHEN trim(others2.other32 || ' ' || categorykanriOther32.category4) = '' THEN NULL
    ELSE trim(others2.other32 || ' ' || categorykanriOther32.category4) END as other32_detail,

others2.other33,
CASE
    WHEN trim(others2.other33 || ' ' || categorykanriOther33.category4) = '' THEN NULL
    ELSE trim(others2.other33 || ' ' || categorykanriOther33.category4) END as other33_detail,

others2.other34,

others2.other35,
CASE
    WHEN trim(others2.other35 || ' ' || categorykanriOther35.category4) = '' THEN NULL
    ELSE trim(others2.other35 || ' ' || categorykanriOther35.category4) END as other35_detail,

others2.otherfloat3,
others2.other36,
CASE
    WHEN others2.other36 is null or others2.other36='' THEN NULL
    ELSE others2.other36 END as office_other36,
    
others2.other37,
others2.other38::int as office_other38,
others2.other39,
others2.other40 as office_other40,
CASE
    WHEN others2.other40 is null or others2.other40='' THEN NULL
    ELSE CAST(others2.other40 as integer) END as other40_search_sort,

kokyaku1.name as kokyakuname,
tantousya.name as user_name,
tantousya1.name as syukeinenkijunname,
tantousya2.name as syukeitukikijunname,
tantousya3.name as syukeitukiname,
tantousya4.name as syukeikikijunname,
request.jouhou as jouhou,

CASE
    WHEN split_part(haisou.address, ' ', 1) = '' THEN NULL
    ELSE split_part(haisou.address, ' ', 1) END as address1,
CASE
    WHEN trim(haisou.address) = '' THEN NULL
    ELSE split_part(haisou.address, ' ', 2) END as address2,
CASE
    WHEN trim(haisou.address) = '' THEN NULL
    ELSE split_part(haisou.address, ' ', 3) END as address3,
CASE
    WHEN trim(haisou.address) = '' THEN NULL
    ELSE split_part(haisou.address, ' ', 4) END as address4

from haisou

  join others2 on others2.otherint1 = haisou.bango

    left join categorykanri as categorykanriOther3
    on substring(others2.other3,1,2) = categorykanriOther3.category1
    and substring(others2.other3,3,4) = categorykanriOther3.category2

    left join categorykanri as categorykanriOther4
    on substring(others2.other4,1,2) = categorykanriOther4.category1
    and substring(others2.other4,3,4) = categorykanriOther4.category2

    left join categorykanri as categorykanriOther16
    on substring(others2.other16,1,2) = categorykanriOther16.category1
    and substring(others2.other16,3,4) = categorykanriOther16.category2

    left join categorykanri as categorykanriOther18
    on substring(others2.other18,1,2) = categorykanriOther18.category1
    and substring(others2.other18,3,4) = categorykanriOther18.category2

    left join categorykanri as categorykanriOther19
    on substring(others2.other19,1,2) = categorykanriOther19.category1
    and substring(others2.other19,3,4) = categorykanriOther19.category2
    
    left join categorykanri as categorykanriOther21
    on substring(others2.other21,1,2) = categorykanriOther21.category1
    and substring(others2.other21,3,4) = categorykanriOther21.category2

    left join categorykanri as categorykanriOther24
    on substring(others2.other24,1,2) = categorykanriOther24.category1
    and substring(others2.other24,3,4) = categorykanriOther24.category2

    left join categorykanri as categorykanriOther30
    on substring(others2.other30,1,2) = categorykanriOther30.category1
    and substring(others2.other30,3,4) = categorykanriOther30.category2

    left join categorykanri as categorykanriOther31
    on substring(others2.other31,1,2) = categorykanriOther31.category1
    and substring(others2.other31,3,4) = categorykanriOther31.category2

    left join categorykanri as categorykanriOther32
    on substring(others2.other32,1,2) = categorykanriOther32.category1
    and substring(others2.other32,3,4) = categorykanriOther32.category2

    left join categorykanri as categorykanriOther33
    on substring(others2.other33,1,2) = categorykanriOther33.category1
    and substring(others2.other33,3,4) = categorykanriOther33.category2

    left join categorykanri as categorykanriOther35
    on substring(others2.other35,1,2) = categorykanriOther35.category1
    and substring(others2.other35,3,4) = categorykanriOther35.category2

  left join kokyaku1
   on haisou.shikibetsucode = CAST(kokyaku1.bango as varchar(100))
   left join kokyaku1 kokyaku
   on haisou.kokyakubango = kokyaku.bango
   left join tantousya tantousya1 on tantousya1.bango = CAST(haisou.syukeinenkijun as varchar(100))
   left join tantousya tantousya2 on tantousya2.bango = CAST(haisou.syukeitukikijun as varchar(100))
   left join tantousya tantousya3 on tantousya3.bango = CAST(haisou.syukeituki as varchar(100))
   left join tantousya tantousya4 on tantousya4.bango = CAST(haisou.syukeikikijun as varchar(100))
   left join request on CAST(request.syouhinbango as varchar(100)) = haisou.torihikisakirank1 AND request.color = '0802入力区分'
   left join tantousya on tantousya.bango = CAST(haisou.syukeinen as varchar(100))
    ORDER BY haisou.bango");

        if ($deleted_item == 1) {
            $data = DB::table('haisou_temp')->whereRaw('kounyusu = '. 1);
        } elseif ($deleted_item === 0) {
            $data = DB::table('haisou_temp')->whereRaw('kounyusu = '. 0);
        } else if ($deleted_item === '*') {
            $data=DB::table('haisou_temp');
        }else {
            $data = DB::table('haisou_temp');
        }

        if ($haisouId) {
            $data = $data->whereRaw("bango = '$haisouId'");
        } else {
            $data = $data;
        }

        if ($com_yobi12 != null) {
            $data = $data->whereRaw("shikibetsucode = '$com_yobi12'");
        } else {
            $data = $data;
        }

        return $data->toSql();
    }
}
