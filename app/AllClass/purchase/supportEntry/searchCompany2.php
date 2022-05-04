<?php

namespace App\AllClass\purchase\supportEntry;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\kengen;
use App\kokyaku1;
use App\haisoujouhou;

//where haisoujouhou.syukeituki == 1
Class searchCompany2
{
    public static function data($bango, $deleted_item = 2, $userId = null)
    {

        QueryHelper::runQuery("DROP TABLE IF EXISTS company_temp");

        QueryHelper::runQuery(
            "CREATE TEMPORARY TABLE company_temp as
select distinct
kokyaku1.bango,
kokyaku1.yobi12,
CAST(kokyaku1.yobi12 as integer) as yobi12_search_sort,
kokyaku1.name,
kokyaku1.address,
kokyaku1.furigana,
kokyaku1.yubinbango,
kokyaku1.yobi13,

CASE
    WHEN kokyaku1.tel is null THEN NULL
    WHEN trim(kokyaku1.tel) = '' THEN NULL
    ELSE concat_ws('/',substring(kokyaku1.tel,1,4),
    substring(kokyaku1.tel,5,2),
    substring(kokyaku1.tel,7,2)) END as tel ,

kokyaku1.fax,
kokyaku1.torihikisakibango,
kokyaku1.tantousya,
CASE
    WHEN trim(kokyaku1.tantousya || ' ' || categorykanriTantousya.category4) = '' THEN NULL
    ELSE trim(kokyaku1.tantousya || ' ' || categorykanriTantousya.category4) END as tantousya_detail,

kokyaku1.kcode1,
CASE
    WHEN trim(kokyaku1.kcode1 || ' ' || categorykanriKcode1.category4) = '' THEN NULL
    ELSE trim(kokyaku1.kcode1 || ' ' || categorykanriKcode1.category4) END as kcode1_detail,

kokyaku1.kcode2,
CASE
    WHEN trim(kokyaku1.kcode2 || ' ' || categorykanriKcode2.category4) = '' THEN NULL
    ELSE trim(kokyaku1.kcode2 || ' ' || categorykanriKcode2.category4) END as kcode2_detail,

kokyaku1.stoiawsestart,
CASE
    WHEN trim(kokyaku1.stoiawsestart || ' ' || categorykanriStoiawsestart.category4) = '' THEN NULL
    ELSE trim(kokyaku1.stoiawsestart || ' ' || categorykanriStoiawsestart.category4) END as stoiawsestart_detail,

kokyaku1.stoiawseend,
CASE
    WHEN trim(kokyaku1.stoiawseend || ' ' || categorykanriStoiawseend.category4) = '' THEN NULL
    ELSE trim(kokyaku1.stoiawseend || ' ' || categorykanriStoiawseend.category4) END as stoiawseend_detail,

kokyaku1.stoiawsesaiban,
CASE
    WHEN trim(kokyaku1.stoiawsesaiban || ' ' || categorykanriStoiawsesaiban.category4) = '' THEN NULL
    ELSE trim(kokyaku1.stoiawsesaiban || ' ' || categorykanriStoiawsesaiban.category4) END as stoiawsesaiban_detail,

kokyaku1.kensakukey,
kokyaku1.kcode3,
kokyaku1.ytoiawsestart,
CASE
    WHEN trim(kokyaku1.ytoiawsestart || ' ' || categorykanriYtoiawsestart.category4) = '' THEN NULL
    ELSE trim(kokyaku1.ytoiawsestart || ' ' || categorykanriYtoiawsestart.category4) END as ytoiawsestart_detail,
CASE
    WHEN trim(categorykanriYtoiawsestart.category4) = '' THEN NULL
    ELSE trim(categorykanriYtoiawsestart.category4) END as ytoiawsestart_supplier,
kokyaku1.ytoiawseend,
CASE
    WHEN trim(kokyaku1.ytoiawseend || ' ' || categorykanriYtoiawseend.category4) = '' THEN NULL
    ELSE trim(kokyaku1.ytoiawseend || ' ' || categorykanriYtoiawseend.category4) END as ytoiawseend_detail,

kokyaku1.ytoiawsesaiban,
SPLIT_PART(kokyaku1.ytoiawsesaiban,' ',2) as ytoiawsesaiban_detail,
CASE 
    WHEN kokyaku1.yetoiawsestart = '31' THEN '末'
    ELSE kokyaku1.yetoiawsestart END as yetoiawsestart,
kokyaku1.yetoiawseend,
kokyaku1.yetoiawsesaiban,
kokyaku1.denpyostart,

SPLIT_PART(kokyaku1.mail_soushin,'|',1) as mail_soushin,
CASE
    WHEN SPLIT_PART(kokyaku1.mail_soushin,'|',1) is null or SPLIT_PART(kokyaku1.mail_soushin,'|',1)='' THEN NULL
    ELSE CAST(SPLIT_PART(kokyaku1.mail_soushin,'|',1) as bigint) END as mail_soushin_search_sort,
SPLIT_PART(kokyaku1.mail_soushin,'|',2) as mail_soushin_extra,

kokyaku1.mail_jyushin,
kokyaku1.mail_nouhin,
kokyaku1.mail_toiawase,
kokyaku1.mail_soushin_mb,
kokyaku1.mail_jyushin_mb,

SPLIT_PART(kokyaku1.mail_nouhin_mb,'|',1) as mail_nouhin_mb,
CASE
    WHEN SPLIT_PART(kokyaku1.mail_nouhin_mb,'|',1) is null or SPLIT_PART(kokyaku1.mail_nouhin_mb,'|',1)='' THEN NULL
    ELSE CAST(SPLIT_PART(kokyaku1.mail_nouhin_mb,'|',1) as bigint) END as mail_nouhin_mb_search_sort,
SPLIT_PART(kokyaku1.mail_nouhin_mb,'|',2) as mail_nouhin_mb_extra,

kokyaku1.mail_toiawase_mb,
CASE
    WHEN trim(kokyaku1.mail_toiawase_mb || ' ' || categorykanriMail_toiawase_mb.category4) = '' THEN NULL
    ELSE trim(kokyaku1.mail_toiawase_mb || ' ' || categorykanriMail_toiawase_mb.category4) END as mail_toiawase_mb_detail,

kokyaku1.mallsoukobango1,
CASE
    WHEN trim(kokyaku1.mallsoukobango1 || ' ' || categorykanriMallsoukobango1.category4) = '' THEN NULL
    ELSE trim(kokyaku1.mallsoukobango1 || ' ' || categorykanriMallsoukobango1.category4) END as mallsoukobango1_detail,

kokyaku1.mallsoukobango2,

kokyaku1.mallsoukobango3,
CASE
    WHEN kokyaku1.mallsoukobango3 is null or kokyaku1.mallsoukobango3='' THEN NULL
    ELSE CAST(kokyaku1.mallsoukobango3 as integer) END as mallsoukobango3_search_sort,

kokyaku1.kcode4,
kokyaku1.kcode5,
CASE
    WHEN trim(kokyaku1.kcode5 || ' ' || categorykanriKcode5.category4) = '' THEN NULL
    ELSE trim(kokyaku1.kcode5 || ' ' || categorykanriKcode5.category4) END as kcode5_detail,

kokyaku1.domain,
CASE
    WHEN trim(kokyaku1.domain || ' ' || categorykanriDomain.category4) = '' THEN NULL
    ELSE trim(kokyaku1.domain || ' ' || categorykanriDomain.category4) END as domain_detail,

kokyaku1.domain2,
CASE
    WHEN trim(kokyaku1.domain2 || ' ' || categorykanriDomain2.category4) = '' THEN NULL
    ELSE trim(kokyaku1.domain2 || ' ' || categorykanriDomain2.category4) END as domain2_detail,

kokyaku1.yekessaihouhou,
kokyaku1.sekessaihouhou,
kokyaku1.pointterm,
kokyaku1.denpyosaiban,


CASE
    WHEN haisoujouhou.kaiinbango is null THEN NULL
     WHEN trim(haisoujouhou.kaiinbango) = '' THEN NULL
    ELSE concat_ws('/',substring(haisoujouhou.kaiinbango,1,4),
    substring(haisoujouhou.kaiinbango,5,2),
    substring(haisoujouhou.kaiinbango,7,2)) END as kaiinbango ,

CASE
    WHEN haisoujouhou.zokugara is null THEN NULL
    WHEN trim(haisoujouhou.zokugara) = '' THEN NULL
    ELSE concat_ws('/',substring(haisoujouhou.zokugara,1,4),
    substring(haisoujouhou.zokugara,5,2),
    substring(haisoujouhou.zokugara,7,2)) END as zokugara ,

CASE
    WHEN haisoujouhou.name is null THEN NULL
    WHEN trim(haisoujouhou.name) = '' THEN NULL
    ELSE concat_ws('/',substring(haisoujouhou.name,1,4),
    substring(haisoujouhou.name,5,2),
    substring(haisoujouhou.name,7,2)) END as haisoujouhou_name ,

haisoujouhou.address as haisoujouhou_address,
CASE
    WHEN trim(haisoujouhou.address || ' ' || categorykanriHaisoujouhou_address.category4) = '' THEN NULL
    ELSE trim(haisoujouhou.address || ' ' || categorykanriHaisoujouhou_address.category4) END as haisoujouhou_address_detail,

CASE
    WHEN haisoujouhou.yubinbango is null THEN NULL
     WHEN trim(haisoujouhou.yubinbango) = '' THEN NULL
    ELSE concat_ws('/',substring(haisoujouhou.yubinbango,1,4),
    substring(haisoujouhou.yubinbango,5,2),
    substring(haisoujouhou.yubinbango,7,2)) END as haisoujouhou_yubinbango ,

haisoujouhou.tel as haisoujouhou_tel,
CASE
    WHEN trim(haisoujouhou.tel || ' ' || categorykanriHaisoujouhou_tel.category4) = '' THEN NULL
    ELSE trim(haisoujouhou.tel || ' ' || categorykanriHaisoujouhou_tel.category4) END as haisoujouhou_tel_detail,

haisoujouhou.mail,
haisoujouhou.sex,
CASE
    WHEN trim(haisoujouhou.sex || ' ' || categorykanriSex.category4) = '' THEN NULL
    ELSE trim(haisoujouhou.sex || ' ' || categorykanriSex.category4) END as sex_detail,

haisoujouhou.bunrui1,
haisoujouhou.bunrui2,
haisoujouhou.syukeinenkijun,
CASE
    WHEN trim(haisoujouhou.syukeinenkijun || ' ' || categorykanriSyukeinenkijun.category4) = '' THEN NULL
    ELSE trim(haisoujouhou.syukeinenkijun || ' ' || categorykanriSyukeinenkijun.category4) END as syukeinenkijun_detail,

haisoujouhou.bunrui3,
CASE
    WHEN trim(haisoujouhou.bunrui3 || ' ' || categorykanriBunrui3.category4) = '' THEN NULL
    ELSE trim(haisoujouhou.bunrui3 || ' ' || categorykanriBunrui3.category4) END as bunrui3_detail,

haisoujouhou.syukeiki,
CASE
    WHEN trim(haisoujouhou.syukeiki || ' ' || categorykanriSyukeiki.category4) = '' THEN NULL
    ELSE trim(haisoujouhou.syukeiki || ' ' || categorykanriSyukeiki.category4) END as syukeiki_detail,

haisoujouhou.datatxt0053,
CASE
    WHEN trim(haisoujouhou.datatxt0053 || ' ' || categorykanriDatatxt0053.category4) = '' THEN NULL
    ELSE trim(haisoujouhou.datatxt0053 || ' ' || categorykanriDatatxt0053.category4) END as datatxt0053_detail,

haisoujouhou.bunrui4,
CASE
    WHEN trim(haisoujouhou.bunrui4 || ' ' || categorykanriBunrui4.category4) = '' THEN NULL
    ELSE trim(haisoujouhou.bunrui4 || ' ' || categorykanriBunrui4.category4) END as bunrui4_detail,

haisoujouhou.bunrui5,
CASE
    WHEN trim(haisoujouhou.bunrui5 || ' ' || categorykanriBunrui5.category4) = '' THEN NULL
    ELSE trim(haisoujouhou.bunrui5 || ' ' || categorykanriBunrui5.category4) END as bunrui5_detail,

haisoujouhou.bunrui9,
haisoujouhou.bunrui10,
haisoujouhou.netusername,
CASE
    WHEN trim(haisoujouhou.netusername || ' ' || categorykanriNetusername.category4) = '' THEN NULL
    ELSE trim(haisoujouhou.netusername || ' ' || categorykanriNetusername.category4) END as netusername_detail,

haisoujouhou.netuserpasswd,
CASE
    WHEN trim(haisoujouhou.netuserpasswd || ' ' || categorykanriNetuserpasswd.category4) = '' THEN NULL
    ELSE trim(haisoujouhou.netuserpasswd || ' ' || categorykanriNetuserpasswd.category4) END as netuserpasswd_detail,

haisoujouhou.netlogin,
CASE
    WHEN trim(haisoujouhou.netlogin || ' ' || categorykanriNetlogin.category4) = '' THEN NULL
    ELSE trim(haisoujouhou.netlogin || ' ' || categorykanriNetlogin.category4) END as netlogin_detail,

haisoujouhou.kounyusu,
haisoujouhou.syukeitukikijun,

haisoujouhou.syukeinen,
CASE
    WHEN haisoujouhou.syukeinen is null or haisoujouhou.syukeinen='' THEN NULL
    ELSE CAST(haisoujouhou.syukeinen as integer) END as syukeinen_search_sort,

haisoujouhou.syukeituki,
haisoujouhou.syukeikikijun,
haisoujouhou.datatxt0050,
haisoujouhou.datatxt0051,
haisoujouhou.datatxt0052,
haisoujouhou.datatxt0054,
haisoujouhou.datatxt0055,
haisoujouhou.endtime,
haisoujouhou.datatxt0056,
haisoujouhou.datatxt0057,
haisoujouhou.syukei3,
haisoujouhou.syukei2,
haisoujouhou.point,

tantousya.name as user_name,

CASE
    WHEN kokyaku1.yekessaihouhou is null THEN NULL
    ELSE concat_ws('/',substring(kokyaku1.yekessaihouhou,1,4),
    substring(kokyaku1.yekessaihouhou,5,2),
    substring(kokyaku1.yekessaihouhou,7,2)) END as created_date ,

CASE
    WHEN kokyaku1.yekessaihouhou is null THEN NULL
    ELSE concat_ws(':',substring(kokyaku1.yekessaihouhou,9,2),
    substring(kokyaku1.yekessaihouhou,11,2),
    substring(kokyaku1.yekessaihouhou,13,2)) END as created_time,

CASE
    WHEN kokyaku1.sokurijyouhinmei is null THEN NULL
    ELSE concat_ws('/',substring(kokyaku1.sokurijyouhinmei,1,4),
    substring(kokyaku1.sokurijyouhinmei,5,2),
    substring(kokyaku1.sokurijyouhinmei,7,2)) END as edited_date,

CASE
    WHEN kokyaku1.sokurijyouhinmei is null THEN NULL
    ELSE concat_ws(':',substring(kokyaku1.sokurijyouhinmei,9,2),
    substring(kokyaku1.sokurijyouhinmei,11,2),
    substring(kokyaku1.sokurijyouhinmei,13,2)) END as edited_time


from kokyaku1

    join haisoujouhou on haisoujouhou.syukei1 = kokyaku1.bango

    left join categorykanri as categorykanriTantousya
    on substring(kokyaku1.tantousya,1,2) = categorykanriTantousya.category1
    and substring(kokyaku1.tantousya,3,4) = categorykanriTantousya.category2

    left join categorykanri as categorykanriKcode1
    on substring(kokyaku1.kcode1,1,2) = categorykanriKcode1.category1
    and substring(kokyaku1.kcode1,3,4) = categorykanriKcode1.category2

    left join categorykanri as categorykanriKcode2
    on substring(kokyaku1.kcode2,1,2) = categorykanriKcode2.category1
    and substring(kokyaku1.kcode2,3,4) = categorykanriKcode2.category2

    left join categorykanri as categorykanriStoiawsestart
    on substring(kokyaku1.stoiawsestart,1,2) = categorykanriStoiawsestart.category1
    and substring(kokyaku1.stoiawsestart,3,4) = categorykanriStoiawsestart.category2

    left join categorykanri as categorykanriStoiawseend
    on substring(kokyaku1.stoiawseend,1,2) = categorykanriStoiawseend.category1
    and substring(kokyaku1.stoiawseend,3,4) = categorykanriStoiawseend.category2

    left join categorykanri as categorykanriStoiawsesaiban
    on substring(kokyaku1.stoiawsesaiban,1,2) = categorykanriStoiawsesaiban.category1
    and substring(kokyaku1.stoiawsesaiban,3,4) = categorykanriStoiawsesaiban.category2

    left join categorykanri as categorykanriYtoiawsestart
    on substring(kokyaku1.ytoiawsestart,1,2) = categorykanriYtoiawsestart.category1
    and substring(kokyaku1.ytoiawsestart,3,4) = categorykanriYtoiawsestart.category2

    left join categorykanri as categorykanriYtoiawseend
    on substring(kokyaku1.ytoiawseend,1,2) = categorykanriYtoiawseend.category1
    and substring(kokyaku1.ytoiawseend,3,4) = categorykanriYtoiawseend.category2

    left join categorykanri as categorykanriNetusername
    on substring(haisoujouhou.netusername,1,2) = categorykanriNetusername.category1
    and substring(haisoujouhou.netusername,3,4) = categorykanriNetusername.category2

    left join categorykanri as categorykanriNetuserpasswd
    on substring(haisoujouhou.netuserpasswd,1,2) = categorykanriNetuserpasswd.category1
    and substring(haisoujouhou.netuserpasswd,3,4) = categorykanriNetuserpasswd.category2

    left join categorykanri as categorykanriNetlogin
    on substring(haisoujouhou.netlogin,1,2) = categorykanriNetlogin.category1
    and substring(haisoujouhou.netlogin,3,4) = categorykanriNetlogin.category2

    left join categorykanri as categorykanriMail_toiawase_mb
    on substring(kokyaku1.mail_toiawase_mb,1,2) = categorykanriMail_toiawase_mb.category1
    and substring(kokyaku1.mail_toiawase_mb,3,4) = categorykanriMail_toiawase_mb.category2

    left join categorykanri as categorykanriMallsoukobango1
    on substring(kokyaku1.mallsoukobango1,1,2) = categorykanriMallsoukobango1.category1
    and substring(kokyaku1.mallsoukobango1,3,4) = categorykanriMallsoukobango1.category2

    left join categorykanri as categorykanriDomain
    on substring(kokyaku1.domain,1,2) = categorykanriDomain.category1
    and substring(kokyaku1.domain,3,4) = categorykanriDomain.category2

    left join categorykanri as categorykanriDomain2
    on substring(kokyaku1.domain2,1,2) = categorykanriDomain2.category1
    and substring(kokyaku1.domain2,3,4) = categorykanriDomain2.category2

    left join categorykanri as categorykanriHaisoujouhou_address
    on substring(haisoujouhou.address,1,2) = categorykanriHaisoujouhou_address.category1
    and substring(haisoujouhou.address,3,4) = categorykanriHaisoujouhou_address.category2

    left join categorykanri as categorykanriKcode5
    on substring(kokyaku1.kcode5,1,2) = categorykanriKcode5.category1
    and substring(kokyaku1.kcode5,3,4) = categorykanriKcode5.category2

    left join categorykanri as categorykanriHaisoujouhou_tel
    on substring(haisoujouhou.tel,1,2) = categorykanriHaisoujouhou_tel.category1
    and substring(haisoujouhou.tel,3,4) = categorykanriHaisoujouhou_tel.category2

    left join categorykanri as categorykanriSex
    on substring(haisoujouhou.sex,1,2) = categorykanriSex.category1
    and substring(haisoujouhou.sex,3,4) = categorykanriSex.category2

    left join categorykanri as categorykanriSyukeinenkijun
    on substring(haisoujouhou.syukeinenkijun,1,2) = categorykanriSyukeinenkijun.category1
    and substring(haisoujouhou.syukeinenkijun,3,4) = categorykanriSyukeinenkijun.category2

    left join categorykanri as categorykanriBunrui3
    on substring(haisoujouhou.bunrui3,1,2) = categorykanriBunrui3.category1
    and substring(haisoujouhou.bunrui3,3,4) = categorykanriBunrui3.category2

    left join categorykanri as categorykanriSyukeiki
    on substring(haisoujouhou.syukeiki,1,2) = categorykanriSyukeiki.category1
    and substring(haisoujouhou.syukeiki,3,4) = categorykanriSyukeiki.category2

    left join categorykanri as categorykanriDatatxt0053
    on substring(haisoujouhou.datatxt0053,1,2) = categorykanriDatatxt0053.category1
    and substring(haisoujouhou.datatxt0053,3,4) = categorykanriDatatxt0053.category2

    left join categorykanri as categorykanriBunrui4
    on substring(haisoujouhou.bunrui4,1,2) = categorykanriBunrui4.category1
    and substring(haisoujouhou.bunrui4,3,4) = categorykanriBunrui4.category2

    left join categorykanri as categorykanriBunrui5
    on substring(haisoujouhou.bunrui5,1,2) = categorykanriBunrui5.category1
    and substring(haisoujouhou.bunrui5,3,4) = categorykanriBunrui5.category2

    left join tantousya on tantousya.bango = kokyaku1.pointterm

    where substring(haisoujouhou.syukeituki,1,1)::int = 1

    ORDER BY kokyaku1.name ");

        //dd(DB::table('product_temp')->get());


        $data = DB::table('company_temp');

        if ($deleted_item == 1) {
            $data = DB::table('company_temp')->whereRaw('denpyosaiban = ' . 1);
        } elseif ($deleted_item === 0) {
            $data = DB::table('company_temp')->whereRaw("denpyosaiban = " . 0);
        } else if ($deleted_item === '*') {
            $data = DB::table('company_temp');
        } else {
            $data = DB::table('company_temp');
        }

        if ($userId) {
            $data = $data->whereRaw("bango = '$userId'");
        } else {
            $data = $data;
        }

        return $data->toSql();
    }
}
