<?php

namespace App\AllClass\sales\salesSlip;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\kengen;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class AllVoucherCreation{
    public static function data($bango,$deleted_item=2,$kokyakuorderbango=null){

        QueryHelper::runQuery("DROP TABLE IF EXISTS voucher_creation_temp");

        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE voucher_creation_temp as
        select 
        orderhenkan.bango,
        orderhenkan.kokyakuorderbango,
        orderhenkan.datachar01,
        orderhenkan.datachar02,
        CASE
            WHEN orderhenkan.datachar02 is null THEN NULL
            ELSE concat(categorykanriDatachar2.category2,' ',categorykanriDatachar2.category4) END as datachar02_detail,
        orderhenkan.datachar03,
        CASE
            WHEN orderhenkan.datachar03 is null THEN NULL
            ELSE concat(orderhenkan.datachar03,' ',gazou2.urlsm) END as datachar03_detail,
        orderhenkan.datachar04,
        orderhenkan.datachar05,
        orderhenkan.ordertypebango2,
        CASE
            WHEN orderhenkan.intorder01::text is null THEN NULL
            ELSE concat_ws('/',substring(orderhenkan.intorder01::text,1,4),
            substring(orderhenkan.intorder01::text,5,2),
            substring(orderhenkan.intorder01::text,7,2)) END as intorder01,
        CASE
            WHEN orderhenkan.intorder02::text is null THEN NULL
            ELSE concat_ws('/',substring(orderhenkan.intorder02::text,1,4),
            substring(orderhenkan.intorder02::text,5,2),
            substring(orderhenkan.intorder02::text,7,2)) END as intorder02,
        CASE
            WHEN orderhenkan.intorder03::text is null THEN NULL
            ELSE concat_ws('/',substring(orderhenkan.intorder03::text,1,4),
            substring(orderhenkan.intorder03::text,5,2),
            substring(orderhenkan.intorder03::text,7,2)) END as intorder03,
        CASE
            WHEN orderhenkan.intorder04::text is null THEN NULL
            ELSE concat_ws('/',substring(orderhenkan.intorder04::text,1,4),
            substring(orderhenkan.intorder04::text,5,2),
            substring(orderhenkan.intorder04::text,7,2)) END as intorder04,
        CASE
            WHEN orderhenkan.intorder05::text is null THEN NULL
            ELSE concat_ws('/',substring(orderhenkan.intorder05::text,1,4),
            substring(orderhenkan.intorder05::text,5,2),
            substring(orderhenkan.intorder05::text,7,2)) END as intorder05, 
        tuhanorder.juchukubun1,
        tuhanorder.information1,
        concat_ws('／',kokyaku1Information1.address,haisouInformation1.haisoumoji1,etsuransyaInformation1.mail4) as information1_detail,
        tuhanorder.information2,
        LEFT(tuhanorder.information2,8) as information2_short,
        kokyaku1Information2.name as company_name,
        kokyaku1Information2.address as company_address,
        haisouInformation2.yubinbango as office_yubinbango,
        haisouInformation2.name as office_name,
        haisouInformation2.address as office_address,
        haisouInformation2.haisoumoji1 as office_haisoumoji1,
        substring(etsuransyaInformation2.mail2,1,27) as information2_mail2,
        --concat(etsuransyaInformation2.mail2,' ',etsuransyaInformation2.mail3,' ',etsuransyaInformation2.tantousya) as etsransa_detail,
        substring(etsuransyaInformation2.tantousya,1,27) as etsransainfo2_tantousya,
        concat_ws('／',kokyaku1Information2.address,haisouInformation2.haisoumoji1,etsuransyaInformation2.mail4) as information2_detail,
        etsuransyaInformation3.mail4 as information2_mail4,
        tuhanorder.information3,
        concat_ws('／',kokyaku1Information3.address,haisouInformation3.haisoumoji1,etsuransyaInformation3.mail4) as information3_detail,
        tuhanorder.information4,
        concat_ws('／',kokyaku1Information4.address,haisouInformation4.haisoumoji1,etsuransyaInformation4.mail4) as information4_detail,
        tuhanorder.information5,
        concat_ws('／',kokyaku1Information5.address,haisouInformation5.haisoumoji1,etsuransyaInformation5.mail4) as information5_detail,
        tuhanorder.information6,
        concat_ws('／',kokyaku1Information6.address,haisouInformation6.haisoumoji1,etsuransyaInformation6.mail4) as information6_detail,
        tuhanorder.information7,
        substring(tuhanorder.information8,1,40) as information8,
        tuhanorder.information9,
        CASE
            WHEN (substring(tuhanorder.information3,1,6) != substring(tuhanorder.information1,1,6)) AND (substring(tuhanorder.information3,1,6) != substring(tuhanorder.information2,1,6)) THEN concat('最終顧客：',substring(kokyaku1Information3.name,1,30),' ','様分')
            ELSE NULL END as end_customer,
        tuhanorder.kessaihouhou,
        tuhanorder.juchukubun2,
        tantousyaText2.mail as text2_mail,
        tuhanorder.text3,
        tuhanorder.numeric3,
        tuhanorder.numeric4,
        tuhanorder.otodoketime,
        CASE
            WHEN tuhanorder.kessaihouhou is null THEN NULL
            ELSE concat(tuhanorder.kessaihouhou,' ',categorykanriKessaihouhou.category4) END as kessaihouhou_detail,
        tuhanorder.chumonsyajouhou,
        CASE
            WHEN tuhanorder.chumonsyajouhou is null THEN NULL
            ELSE concat(tuhanorder.chumonsyajouhou,' ',categorykanriChumonsyajouhou.category4) END as chumonsyajouhou_detail,
        tuhanorder.soufusakijouhou,
        CASE
            WHEN tuhanorder.soufusakijouhou is null THEN NULL
            ELSE concat(tuhanorder.soufusakijouhou,' ',categorykanriSoufusakijouhou.category4) END as soufusakijouhou_detail,
        tuhanorder.text1,    
        CASE
            WHEN tuhanorder.text1 is null THEN NULL
            ELSE substring(categorykanriText1.category4,1,2) END as text1_detail,
        tuhanorder.housoukubun,
        syukkoold.syouhinid,
        syukkoold.syouhinsyu,
        syukkoold.hantei,
        syukkoold.kawasename,
        substring_byte(syukkoold.syouhinname,1,57) as syouhinname,
        --syukkoold.syouhinname,
        CASE
            WHEN syukkoold.dataint09::text is null THEN NULL
            ELSE concat_ws('/',substring(syukkoold.dataint09::text,1,4),
            substring(syukkoold.dataint09::text,5,2),
            substring(syukkoold.dataint09::text,7,2)) END as dataint09,
        CASE
            WHEN syukkoold.dataint10::text is null THEN NULL
            ELSE concat_ws('/',substring(syukkoold.dataint10::text,1,4),
            substring(syukkoold.dataint10::text,5,2),
            substring(syukkoold.dataint10::text,7,2)) END as dataint10,
        concat_ws('／',kokyaku1Datachar5.address,haisouDatachar5.haisoumoji1,etsuransyaDatachar5.mail4) as datachar05_detail,
        syukkoold.datachar06,
        concat_ws('／',kokyaku1Datachar6.address,haisouDatachar6.haisoumoji1,etsuransyaDatachar6.mail4) as datachar06_detail,
        syukkoold.codename,    
        syukkoold.syukkasu,    
        syukkoold.dataint04,    
        syukkoold.dataint05,    
        syukkoold.dataint06,    
        syukkoold.dataint07,    
        syukkoold.dataint08,
        syukkoold.dataint11,
        ( SELECT SUM(syukkoold.dataint11) 
            FROM syukkoold 
            where syouhinid='$kokyakuorderbango'
        ) AS dataint11_amount,
        syukkoold.dataint12,
        ( SELECT SUM(syukkoold.dataint12) 
            FROM syukkoold 
            where syouhinid='$kokyakuorderbango'
        ) AS dataint12_amount,
        CASE
            WHEN tantousyaDtchar01.bango is null THEN NULL
            ELSE tantousyaDtchar01.name
            END as tuhan_datachar01,
        CASE
            WHEN tantousyaDtchar02.bango is null THEN NULL
            ELSE tantousyaDtchar02.name
            END as tuhan_datachar02,
        substring_byte(syukkoold.barcode,1,57) as barcode,
        --syukkoold.barcode,
        syukkoold.datachar07,
        syukkoold.datachar08,
        syukkoold.datachar09,
        syukkoold.datachar15,
        concat_ws('／',syukkoold.datachar07,syukkoold.datachar09,syukkoold.datachar15) as shipping_instruction,
        syukkoold.datachar16,
        syukkoold.datachar17,
        syukkoold.datachar12 as datachar12_detail,
        
        --CASE
        --    WHEN syukkoold.datachar12 is null THEN NULL
        --    ELSE trim(categorykanriDatachar12.category4) END as datachar12_detail,
            
        syukkoold.datachar03 as manufacturer_part_num,
        syukkoold.datachar04 as manufacturer_product_name

        from syukkoold
        
        left join orderhenkan on orderhenkan.bango = syukkoold.orderbango
        
        left join tuhanorder on tuhanorder.orderbango = orderhenkan.bango
        
        left join tantousya as tantousyaText2 on tantousyaText2.bango = tuhanorder.text2
        
        left join tantousya as tantousyaDtchar01 on tantousyaDtchar01.bango = syukkoold.datachar01
        
        left join tantousya as tantousyaDtchar02 on tantousyaDtchar02.bango = syukkoold.datachar02

        left join gazou2 on gazou2.url = orderhenkan.datachar03

        left join categorykanri as categorykanriDatachar2
        on substring(orderhenkan.datachar02,1,2) = categorykanriDatachar2.category1
        and substring(orderhenkan.datachar02,3,3) = categorykanriDatachar2.category2
        
        left join categorykanri as categorykanriKessaihouhou
        on substring(tuhanorder.kessaihouhou,1,2) = categorykanriKessaihouhou.category1
        and substring(tuhanorder.kessaihouhou,3,2) = categorykanriKessaihouhou.category2
        
        left join categorykanri as categorykanriChumonsyajouhou
        on substring(tuhanorder.chumonsyajouhou,1,2) = categorykanriChumonsyajouhou.category1
        and substring(tuhanorder.chumonsyajouhou,3,2) = categorykanriChumonsyajouhou.category2
        
        left join categorykanri as categorykanriSoufusakijouhou
        on substring(tuhanorder.soufusakijouhou,1,2) = categorykanriSoufusakijouhou.category1
        and substring(tuhanorder.soufusakijouhou,3,1) = categorykanriSoufusakijouhou.category2
        
        left join categorykanri as categorykanriText1
        on substring(tuhanorder.text1,1,2) = categorykanriText1.category1
        and substring(tuhanorder.text1,3,2) = categorykanriText1.category2
        
        --left join categorykanri as categorykanriDatachar12
        --on substring(syukkoold.datachar12,1,2) = categorykanriDatachar12.category1
        --and substring(syukkoold.datachar12,3,3) = categorykanriDatachar12.category2
        
        --information1
        left join kokyaku1 as kokyaku1Information1
        on substring(tuhanorder.information1,1,6) = kokyaku1Information1.yobi12
        
        left join haisou as haisouInformation1
        on substring(tuhanorder.information1,7,2) = haisouInformation1.torihikisakibango
        and kokyaku1Information1.bango = haisouInformation1.kokyakubango
        
        left join etsuransya as etsuransyaInformation1
        on substring(tuhanorder.information1,9,3) = etsuransyaInformation1.datatxt0049
        and haisouInformation1.bango::text = etsuransyaInformation1.datanum0018::text
        --information1 end
        
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
        
        --information3
        left join kokyaku1 as kokyaku1Information3
        on substring(tuhanorder.information3,1,6) = kokyaku1Information3.yobi12
        
        left join haisou as haisouInformation3
        on substring(tuhanorder.information3,7,2) = haisouInformation3.torihikisakibango
        and kokyaku1Information3.bango = haisouInformation3.kokyakubango
        
        left join etsuransya as etsuransyaInformation3
        on substring(tuhanorder.information3,9,3) = etsuransyaInformation3.datatxt0049
        and haisouInformation3.bango::text = etsuransyaInformation3.datanum0018::text
        --information3 end
        
        --information4
        left join kokyaku1 as kokyaku1Information4
        on substring(tuhanorder.information4,1,6) = kokyaku1Information4.yobi12
        
        left join haisou as haisouInformation4
        on substring(tuhanorder.information4,7,2) = haisouInformation4.torihikisakibango
        and kokyaku1Information4.bango = haisouInformation4.kokyakubango
        
        left join etsuransya as etsuransyaInformation4
        on substring(tuhanorder.information4,9,3) = etsuransyaInformation4.datatxt0049
        and haisouInformation4.bango::text = etsuransyaInformation4.datanum0018::text
        --information4 end
        
        --information5
        left join kokyaku1 as kokyaku1Information5
        on substring(tuhanorder.information5,1,6) = kokyaku1Information5.yobi12
        
        left join haisou as haisouInformation5
        on substring(tuhanorder.information5,7,2) = haisouInformation5.torihikisakibango
        and kokyaku1Information5.bango = haisouInformation5.kokyakubango
        
        left join etsuransya as etsuransyaInformation5
        on substring(tuhanorder.information5,9,3) = etsuransyaInformation5.datatxt0049
        and haisouInformation5.bango::text = etsuransyaInformation5.datanum0018::text
        --information5 end
        
        --information6
        left join kokyaku1 as kokyaku1Information6
        on substring(tuhanorder.information6,1,6) = kokyaku1Information6.yobi12
        
        left join haisou as haisouInformation6
        on substring(tuhanorder.information6,7,2) = haisouInformation6.torihikisakibango
        and kokyaku1Information6.bango = haisouInformation6.kokyakubango
        
        left join etsuransya as etsuransyaInformation6
        on substring(tuhanorder.information6,9,3) = etsuransyaInformation6.datatxt0049
        and haisouInformation6.bango::text = etsuransyaInformation6.datanum0018::text
        --information6 end
        
        --datachar05
        left join kokyaku1 as kokyaku1Datachar5
        on substring(syukkoold.datachar05,1,6) = kokyaku1Datachar5.yobi12
        
        left join haisou as haisouDatachar5
        on substring(syukkoold.datachar05,7,2) = haisouDatachar5.torihikisakibango
        and kokyaku1Datachar5.bango = haisouDatachar5.kokyakubango
        
        left join etsuransya as etsuransyaDatachar5
        on substring(syukkoold.datachar05,9,3) = etsuransyaDatachar5.datatxt0049
        and haisouDatachar5.bango::text = etsuransyaDatachar5.datanum0018::text
        --datachar05 end
        
        --datachar06
        left join kokyaku1 as kokyaku1Datachar6
        on substring(syukkoold.datachar06,1,6) = kokyaku1Datachar6.yobi12
        
        left join haisou as haisouDatachar6
        on substring(syukkoold.datachar06,7,2) = haisouDatachar6.torihikisakibango
        and kokyaku1Datachar6.bango = haisouDatachar6.kokyakubango
        
        left join etsuransya as etsuransyaDatachar6
        on substring(syukkoold.datachar06,9,3) = etsuransyaDatachar6.datatxt0049
        and haisouDatachar6.bango::text = etsuransyaDatachar6.datanum0018::text
        --datachar06 end
        
        where syukkoold.syouhinid= '$kokyakuorderbango'
        ORDER BY syouhinsyu ASC");

        $data=DB::table('voucher_creation_temp');
        //$data=DB::table('voucher_creation_temp')->whereRaw('syouhinid = ' . "'$kokyakuorderbango'");
        

        return $data;
        
    }
}
