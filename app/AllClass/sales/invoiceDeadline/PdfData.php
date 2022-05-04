<?php

namespace App\AllClass\sales\invoiceDeadline;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\kengen;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class PdfData{
    public static function data($bango,$deleted_item = 2,$billing_cd,$billing_date = null){
        $temp_billing_date = str_replace('/','-', $billing_date).' 00:00:00';
        $con_billing_date = str_replace('/','', $billing_date);

        QueryHelper::runQuery("DROP TABLE IF EXISTS kokyaku1_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE kokyaku1_temp as
        select distinct
        tuhanorder.orderbango,
        tuhanorder.information2,
        info3_kokyaku1.name,
        kokyaku1.mallsoukobango1,
        haisoujouhou.datatxt0051,
        others2.other1,
        others2.other17,
        others2.other18
        from tuhanorder
        join kokyaku1
            on kokyaku1.yobi12= substr(tuhanorder.information2, 1,6)
        left join kokyaku1 as info3_kokyaku1
            on info3_kokyaku1.yobi12= substr(tuhanorder.information3, 1,6)
        join haisou
            on substring(tuhanorder.information2,7,2) = haisou.torihikisakibango
            and haisou.kounyusu = 0
            and haisou.shikibetsucode = substring(tuhanorder.information2,1,6)
        join haisoujouhou
            on haisoujouhou.syukei1 = kokyaku1.bango
        join others2
            on others2.otherint1=haisou.bango
        ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS datachar10_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE datachar10_temp as
        select orderhenkan.datachar10,count(orderhenkan.datachar10) as count_datachar10
        from syukkoold
        join tuhanorder on tuhanorder.orderbango = syukkoold.orderbango

        join seikyuzandaka on substring(tuhanorder.information2,1,8) = seikyuzandaka.datatxt0142
        AND tuhanorder.chumondate = seikyuzandaka.date0009

        left join orderhenkan on orderhenkan.bango = tuhanorder.orderbango
        where seikyuzandaka.datatxt0142 = '$billing_cd' and date0009 = '$billing_date'
        group by orderhenkan.datachar10
        ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS invoice_pdf_data_temp");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE invoice_pdf_data_temp as
        select
        seikyuzandaka.date0009,
        seikyuzandaka.datatxt0142,
        seikyuzandaka.datanum0051,
        seikyuzandaka.datanum0056,
        (COALESCE(seikyuzandaka.datanum0059,0)+COALESCE(seikyuzandaka.datanum0060,0)+COALESCE(seikyuzandaka.datanum0061,0)+COALESCE(seikyuzandaka.datanum0062,0)+COALESCE(seikyuzandaka.datanum0063,0)+COALESCE(seikyuzandaka.datanum0076,0)+COALESCE(seikyuzandaka.datanum0077,0)+COALESCE(seikyuzandaka.datanum0078,0)+COALESCE(seikyuzandaka.datanum0079,0)+COALESCE(seikyuzandaka.datanum0080,0)) as deposit_amount,
        (COALESCE(seikyuzandaka.datanum0052,0)+COALESCE(seikyuzandaka.datanum0053,0)+COALESCE(seikyuzandaka.datanum0054,0)+COALESCE(seikyuzandaka.datanum0055,0)) as purchase_amount,
        tuhanorder.orderbango,
        tuhanorder.otodoketime,
        tuhanorder.information2,
        LEFT(tuhanorder.information2,8) as information2_short,
        kokyaku1Information2.name as company_name,
        kokyaku1Information2.address as company_address,
        haisouInformation2.name as office_name,
        haisouInformation2.address as office_address,
        haisouInformation2.haisoumoji1 as office_haisoumoji1,
        haisouInformation2.yubinbango as office_yubinbango,
        tuhanorder.information6,
        substring(tuhanorder.information8,1,40) as information8,
        tuhanorder.housoukubun,
        tuhanorder.text3,
        tuhanorder.text1,
        substring(categorykanriText1.category4,1,2) as text1_detail,
        CASE
            WHEN categorykanriOtodoketime.patternsub2 is null THEN NULL
            ELSE substring(categorykanriOtodoketime.patternsub2,1,2) END as percentage,
        tuhanorder.numeric3,
        --(select sum(temp_tuhanorder.numeric3) from tuhanorder as temp_tuhanorder
        --    join tuhanorder on tuhanorder.orderbango = temp_tuhanorder.orderbango
        --    join seikyuzandaka on substring(tuhanorder.information2,1,8) = seikyuzandaka.datatxt0142
        --    AND tuhanorder.chumondate = seikyuzandaka.date0009
        --    where seikyuzandaka.datatxt0142 = '$billing_cd' and date0009 = '$billing_date'
        --) as sum_of_numeric3,
        tuhanorder.numeric4,
        --(select sum(temp_tuhanorder.numeric4) from tuhanorder as temp_tuhanorder
        --    join tuhanorder on tuhanorder.orderbango = temp_tuhanorder.orderbango
        --    join seikyuzandaka on substring(tuhanorder.information2,1,8) = seikyuzandaka.datatxt0142
        --    AND tuhanorder.chumondate = seikyuzandaka.date0009
        --    where seikyuzandaka.datatxt0142 = '$billing_cd' and date0009 = '$billing_date'
        --) as sum_of_numeric4,
        orderhenkan.intorder03,
        CASE
            WHEN orderhenkan.intorder03::text is null THEN NULL
            ELSE concat_ws('/',substring(orderhenkan.intorder03::text,1,4),
            substring(orderhenkan.intorder03::text,5,2),
            substring(orderhenkan.intorder03::text,7,2)) END as modified_intorder03,
        orderhenkan.datachar10,
        syukkoold.syouhinname,
        syukkoold.hantei,
        syukkoold.kawasename,
        syukkoold.dataint04,
        syukkoold.syukkasu,
        syukkoold.codename,
        syukkoold.dataint14,
        substring(syukkoold.datachar08,1,40) as datachar08,
        CASE
            WHEN (substring(tuhanorder.information1,1,6) = substring(tuhanorder.information2,1,6)) AND (substring(tuhanorder.information1,1,6) = substring(tuhanorder.information3,1,6)) AND (substring(tuhanorder.information2,1,6) = substring(tuhanorder.information3,1,6)) THEN NULL
            ELSE kokyaku1_temp.name END as kokyaku1_name,
        kokyaku1_temp.mallsoukobango1,
        kokyaku1_temp.datatxt0051,
        kokyaku1_temp.other1,
        kokyaku1_temp.other17,
        kokyaku1_temp.other18,
        datachar10_temp.count_datachar10,
        (select patternsub2 from categorykanri where substring(syouhin1.data28,1,2) = categorykanri.category1 and substring(syouhin1.data28,3,2) = categorykanri.category2),
        CASE
            WHEN '$temp_billing_date' <= (select seikyuzandaka.date0009 from seikyuzandaka where seikyuzandaka.datatxt0142 = substring(tuhanorder.information2,1,8) order by seikyuzandaka.date0009 asc limit 1) THEN 
                (select min(sub_temp2.intorder03) from seikyuzandaka 
                join tuhanorder as sub_temp1 on substring(sub_temp1.information2,1,8) = seikyuzandaka.datatxt0142 AND sub_temp1.chumondate = seikyuzandaka.date0009 
                left join orderhenkan as sub_temp2 on sub_temp2.bango = sub_temp1.orderbango
                where seikyuzandaka.datatxt0142 = substring(tuhanorder.information2,1,8)
                ) - 1
            ELSE (select replace(substring(date0009::text,1,10),'-','') as tt from seikyuzandaka where seikyuzandaka.datatxt0142 = substring(tuhanorder.information2,1,8) and seikyuzandaka.date0009 <= '$temp_billing_date'::date order by seikyuzandaka.date0009 desc limit 1 offset 1)::int
            END as temp_date0009

        from syukkoold

        join tuhanorder on tuhanorder.orderbango = syukkoold.orderbango

        join seikyuzandaka on substring(tuhanorder.information2,1,8) = seikyuzandaka.datatxt0142
        --AND tuhanorder.chumondate = seikyuzandaka.date0009

        left join orderhenkan on orderhenkan.bango = tuhanorder.orderbango

        left join datachar10_temp on datachar10_temp.datachar10 = orderhenkan.datachar10

        left join kokyaku1_temp on kokyaku1_temp.orderbango = tuhanorder.orderbango

        left join syouhin1 on syouhin1.kokyakusyouhinbango = syukkoold.kawasename

        left join categorykanri as categorykanriText1
        on substring(tuhanorder.text1,1,2) = categorykanriText1.category1
        and substring(tuhanorder.text1,3,2) = categorykanriText1.category2

        left join categorykanri as categorykanriOtodoketime
        on substring(tuhanorder.otodoketime,1,2) = categorykanriOtodoketime.category1
        and substring(tuhanorder.otodoketime,3,2) = categorykanriOtodoketime.category2

        --information2
        left join kokyaku1 as kokyaku1Information2
        on substring(tuhanorder.information2,1,6) = kokyaku1Information2.yobi12

        left join haisou as haisouInformation2
        on substring(tuhanorder.information2,7,2) = haisouInformation2.torihikisakibango
        and kokyaku1Information2.bango = haisouInformation2.kokyakubango
        --information2 end

        where seikyuzandaka.datatxt0142 = '$billing_cd' and date0009 = '$billing_date' and syukkoold.hantei = 0 and housoukubun LIKE '2%' and tuhanorder.text1 != 'U523' 
            and 
            (
            CASE
                WHEN '$temp_billing_date' <= (select seikyuzandaka.date0009 from seikyuzandaka where seikyuzandaka.datatxt0142 = substring(tuhanorder.information2,1,8) order by seikyuzandaka.date0009 asc limit 1) THEN 
                    (select min(sub_temp2.intorder03) from seikyuzandaka 
                    join tuhanorder as sub_temp1 on substring(sub_temp1.information2,1,8) = seikyuzandaka.datatxt0142 AND sub_temp1.chumondate = seikyuzandaka.date0009 
                    left join orderhenkan as sub_temp2 on sub_temp2.bango = sub_temp1.orderbango
                    where seikyuzandaka.datatxt0142 = substring(tuhanorder.information2,1,8)
                    ) - 1
                ELSE (select replace(substring(date0009::text,1,10),'-','') as tt from seikyuzandaka where seikyuzandaka.datatxt0142 = substring(tuhanorder.information2,1,8) and seikyuzandaka.date0009 <= '$temp_billing_date'::date order by seikyuzandaka.date0009 desc limit 1 offset 1)::int
                END < orderhenkan.intorder03
            and 
            orderhenkan.intorder03 <= CAST((select replace(substring(date0009::text,1,10),'-','') from seikyuzandaka where seikyuzandaka.datatxt0142 = substring(tuhanorder.information2,1,8) and seikyuzandaka.date0009 <= '$temp_billing_date'::date order by seikyuzandaka.date0009 desc limit 1) as integer)
            )
            AND LEFT(syouhin1.color,2) = 'C6'  AND  RIGHT(syouhin1.color,5) != '90002'
        ORDER BY orderhenkan.intorder03,orderhenkan.datachar10,syukkoold.dataint02 ASC
        
        ");

        $data=DB::table('invoice_pdf_data_temp');

        return $data;

    }
}
