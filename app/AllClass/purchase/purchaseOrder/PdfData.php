<?php

namespace App\AllClass\purchase\purchaseOrder;
use DB;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

class PdfData
{
    public static function data($bango,$kokyakuorderbango=null,$correctionOrders=null){

        /*QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_pdf_data_temp");*/

        $tantousyaName=QueryHelper::fetchSingleResult("
        select distinct
        substring (tantousya.name,1,16) as name
        from tantousya
        where tantousya.bango='$bango'
       ");
        $tantousyaName=$tantousyaName->name;


        $tantousyadatatxt0004=QueryHelper::fetchSingleResult("
        select distinct on(orderhenkan.kokyakuorderbango,orderhenkan.ordertypebango2)
        orderhenkan.kokyakuorderbango,
        orderhenkan.ordertypebango2,
        left(tantousya.datatxt0004,2) as datatxt0004_temp1,
        right(tantousya.datatxt0004,5) as datatxt0004_temp2
        from V_Orderhenkan_hatsu as orderhenkan
        join tantousya
        on tantousya.bango = orderhenkan.datachar09
        where orderhenkan.kokyakuorderbango='$kokyakuorderbango'
        and orderhenkan.ordertypebango2='$correctionOrders'
        limit 1
       ");
//        dd($orderhenkan);

        $categorykanricategory4=QueryHelper::fetchSingleResult("
                                select distinct
                                categorykanri.category4
                                from categorykanri
                                where categorykanri.category1='$tantousyadatatxt0004->datatxt0004_temp1'
                                and categorykanri.category2='$tantousyadatatxt0004->datatxt0004_temp2'
                                limit 1
       ");
        /*dd(!empty($categorykanricategory4),$categorykanricategory4);*/
        if (!empty($categorykanricategory4)){
            $categorykanricategory4=$categorykanricategory4->category4;
        }
        else{
            $categorykanricategory4='';
        }

        $approverData=QueryHelper::fetchSingleResult("
                                select distinct
                                substring (tantousya.name,1,16) as approverName
                                from tantousya
                                left join hikiatenyuko
                                on hikiatenyuko.datachar01= tantousya.bango
                                where hikiatenyuko.syouhinid='$kokyakuorderbango'
                                limit 1
       ");

        if (!empty($approverData)){
            $approverData=$approverData->approvername;
        }
        else{
            $approverData=null;
        }
//        dd($approverData,$kokyakuorderbango);

        QueryHelper::runQuery("DROP TABLE IF EXISTS minyuko_max_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE minyuko_max_temp as
        select distinct
        syouhinid, max(zaikometer) as maxval
        from minyuko
        group by syouhinid
        ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS minyuko_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE minyuko_temp as
        select minyuko.*
        from minyuko
        join minyuko_max_temp
        on minyuko_max_temp.syouhinid = minyuko.syouhinid
        and minyuko_max_temp.maxval = minyuko.zaikometer
        ");
//        dd(QueryHelper::fetchResult("select * from minyuko_temp"));
        QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_pdf_data_temp");

        QueryHelper::runQuery(
            "CREATE TEMPORARY TABLE purchase_pdf_data_temp as
        select
        '発注書' as heading,
        substring (kokyaku11.name,1,30) as company_name1,
        substring (etsuransya.mail2,1,30) as department_name1,
        substring (etsuransya.tantousya,1,15) as personal_name1,
        substring (etsuransya.datatxt0016,1,11) as phone_number1,
        etsuransya.mail1 as mail_address4,
        '下記の通り、注文いたします' as para1,
        substring (orderhenkan.datachar01,1,15) as quotation_number,
        substring (categorykanri.category4,1,10) as purchase_criteria,
        --categorykanri.category4 as terms_of_payment,
        CASE
            WHEN substring(others2_temp.other1,1,1) = '1' THEN
                        concat(
                        CASE
                            WHEN trim(categorykanribunrui3.category4) = '' THEN NULL
                            ELSE trim(categorykanribunrui3.category4) END,
                        ' ',
                        CASE
                            WHEN trim(categorykanritel.category4) = '' THEN NULL
                            ELSE trim(categorykanritel.category4) END,

                        CASE
                            WHEN substring (haisoujouhou_temp.mail,1,1)= '' THEN NULL
                            WHEN substring (haisoujouhou_temp.mail,1,1)= '0' THEN '当月'
                            WHEN substring (haisoujouhou_temp.mail,1,1)= '1' THEN '翌月'
                            WHEN substring (haisoujouhou_temp.mail,1,1)= '2' THEN '翌々月'
                            WHEN substring (haisoujouhou_temp.mail,1,1)= '3' THEN '3ヶ月'
                            WHEN substring (haisoujouhou_temp.mail,1,1)= '4' THEN '4ヶ月'
                            ELSE null END,

                        CASE
                            WHEN haisoujouhou_temp.sex= '' THEN NULL
                            WHEN haisoujouhou_temp.sex= 'F910' THEN '10日'
                            WHEN haisoujouhou_temp.sex= 'F925' THEN '25日'
                            WHEN haisoujouhou_temp.sex= 'F931' THEN '末日'
                            ELSE null END
                        )
            WHEN substring(others2_temp.other1,1,1) = '2' THEN
                    concat(
                        CASE
                            WHEN trim(categorykanriother24.category4) = '' THEN NULL
                            ELSE trim(categorykanriother24.category4) END,
                        ' ',
                        CASE
                            WHEN trim(categorykanriother19.category4) = '' THEN NULL
                            ELSE trim(categorykanriother19.category4) END,

                        CASE
                            WHEN substring (others2_temp.other20,1,1)= '' THEN NULL
                            WHEN substring (others2_temp.other20,1,1)= '0' THEN '当月'
                            WHEN substring (others2_temp.other20,1,1)= '1' THEN '翌月'
                            WHEN substring (others2_temp.other20,1,1)= '2' THEN '翌々月'
                            WHEN substring (others2_temp.other20,1,1)= '3' THEN '3ヶ月'
                            WHEN substring (others2_temp.other20,1,1)= '4' THEN '4ヶ月'
                            ELSE null END,

                        CASE
                            WHEN others2_temp.other21= '' THEN NULL
                            --WHEN others2_temp.other21= 'F910' THEN '10日'
                            --WHEN others2_temp.other21= 'F925' THEN '25日'
                            --WHEN others2_temp.other21= 'F931' THEN '末日'
                            ELSE categorykanriother21.category4 END
                        )
            ELSE '' END as terms_of_payment,
        REPLACE(substring (orderhenkan.date::text,0,11),'-','/') as order_date,
        CASE
         WHEN length(orderhenkan.ordertypebango2::text) = 1
            THEN orderhenkan.kokyakuorderbango || '-'||'0'|| orderhenkan.ordertypebango2
            ELSE orderhenkan.kokyakuorderbango || '-' || orderhenkan.ordertypebango2
            END as order_number,
        orderhenkan.kokyakuorderbango || '-' || orderhenkan.ordertypebango2 as  order_number_update,
        null as page_no,
        null as logo,
        '$categorykanricategory4' as department_name2,
        tantousya1.mail2 as phone_number2,
        tantousya1.mail as mail_address3,
        substring (tantousya1.bango::text || tantousya1.name,1,16) as orderer,
        '$approverData' as Approver,
        '$tantousyaName' as logger,

        substring (minyuko.syouhinsyu::text,1,3) as yes,
        substring (minyuko.datachar07,1,13) as part_number,
        substring (minyuko.datachar08,1,40) as body_name,
        CASE
         WHEN minyuko.dataint21 = 2
            THEN REPLACE(substring (minyuko.yoteibi::text,0,11),'-','/')
        WHEN minyuko.dataint21 = 1
            THEN '最短'
         END as delivery_date,
        REPLACE(substring (minyuko.kanryoubi::text,0,11),'-','/') as day_adjust,
        substring (minyuko.datachar12,1,4) as tuning_time,
        substring (to_char(minyuko.nyukosu,'FM99,999,999,999,999'),1,5) as quantity,
        to_char( Cast(substring (Cast(minyuko.genka as text),1,8) as DOUBLE PRECISION),'FM99,999,999,999,999') as unit_price,
        --substring (to_char(minyuko.genka,'FM99,999,999,999,999'),1,8) as unit_price,
        to_char( Cast(substring (Cast(minyuko.syouhizeiritu as text),1,9) as DOUBLE PRECISION),'FM99,999,999,999,999') as amount,
        --substring (to_char(minyuko.syouhizeiritu,'FM99,999,999,999,999'),1,9) as amount,
        to_char( Cast(substring (Cast(minyuko.soukobango as text),1,9) as DOUBLE PRECISION),'FM99,999,999,999,999') as consumption_tax1,
        --substring (to_char(minyuko.soukobango,'FM99,999,999,999,999'),1,9) as consumption_tax1,
        substring (minyuko.datachar11,1,60) as detail_remarks,
        substring (haisou_temp.yubinbango,1,11) as address5_1,
        substring (SPLIT_PART(haisou_temp.address, ' ', 1) || SPLIT_PART(haisou_temp.address, ' ', 2) || SPLIT_PART(haisou_temp.address, ' ', 3),1,35) as address5_2,
        substring (SPLIT_PART(haisou_temp.address, ' ', 4) || SPLIT_PART(haisou_temp.address, ' ', 5),1,40) as address5_3,
        kokyaku11.name as company_name2,
        etsuransya.datatxt0016 as phone_number3,
        case
            when minyuko.datachar14 is null
            then substring (etsuransya2.mail2 || ' ' || etsuransya2.tantousya,1,45) || ' ' || '様宛'
            when minyuko.datachar14 is not null
            then substring (tantousya2.datatxt0004 || ' ' || tantousya2.name,1,45)
            else null end as personal_name2,
        minyuko.datachar14 as personal_name2_3,
        substring (tantousya2.datatxt0004 || ' ' || tantousya2.name,1,45) as personal_name2_1,
        substring (etsuransya2.mail2 || ' ' || etsuransya2.tantousya,1,45) || ' ' || '様宛' as personal_name2_2,
        '-' as delivery_response,

        '最終顧客 ' || kokyaku12.name as end_customer,
        substring (orderhenkan.datachar04,1,60) as summary,
        substring (orderhenkan.datachar05,1,60) as slip_remarks2,
        substring (orderhenkan.datachar06,1,60) as slip_remarks3,
        '貴社、弊社間で締結された基本契約および個別取引条件によるものとします。' as para2,
        to_char( Cast(substring (Cast(orderhenkan.intorder01 as text),1,9) as DOUBLE PRECISION),'FM99,999,999,999,999') as summation,
        --substring (to_char(orderhenkan.intorder01,'FM99,999,999,999,999'),1,9) as  summation,
        to_char( Cast(substring (Cast(orderhenkan.intorder02 as text),1,9) as DOUBLE PRECISION),'FM99,999,999,999,999') as consumption_tax2,
        --substring (to_char(orderhenkan.intorder02,'FM99,999,999,999,999'),1,9) as consumption_tax2,
        minyuko.zaikometer,
        case
            when orderhenkan.datatxt0152 is not null
            then substring (orderhenkan.datatxt0152,1,13)
            when orderhenkan.orderuserbango is not null
            then substring (orderhenkan.orderuserbango,1,13)
            else null end as order_no
        --orderhenkan.datatxt0152 as  order_no_1,
        --orderhenkan.orderuserbango as  order_no_2


        from V_Orderhenkan_hatsu as orderhenkan
        left join minyuko_temp as minyuko
        --left join minyuko
        on minyuko.syouhinid = orderhenkan.kokyakuorderbango
        left join kokyaku1 as kokyaku11
        on kokyaku11.yobi12 = left (orderhenkan.datachar08,6)
        left join kokyaku1 as kokyaku12
        on kokyaku12.yobi12 = left (orderhenkan.datachar11,6)
        left join etsuransya
        on etsuransya.datatxt0014||etsuransya.datatxt0015||etsuransya.datatxt0049 = orderhenkan.datachar08
        left join categorykanri
        on categorykanri.category1||categorykanri.category2 = orderhenkan.datatxt0156
        left join tantousya as tantousya1
        on tantousya1.bango = orderhenkan.datachar09
        left join tantousya as tantousya2
        on tantousya2.bango = minyuko.datachar14
        left join etsuransya as etsuransya2
        on etsuransya2.datatxt0014||etsuransya2.datatxt0015||etsuransya2.datatxt0049 = minyuko.kaiinid

        left join haisou as haisou_temp
        on haisou_temp.shikibetsucode = left(orderhenkan.datachar10,6)
        and haisou_temp.torihikisakibango = substring (orderhenkan.datachar10,7,2)

        join kokyaku1 as kokyaku1_temp
        on kokyaku1_temp.bango = haisou_temp.kokyakubango
        left join haisoujouhou as haisoujouhou_temp
        on haisoujouhou_temp.syukei1 = kokyaku1_temp.bango
        join others2 as others2_temp
        on others2_temp.otherint1 = haisou_temp.bango

        left join categorykanri as categorykanribunrui3
            on substring(haisoujouhou_temp.bunrui3,1,2) = categorykanribunrui3.category1
            and substring(haisoujouhou_temp.bunrui3,3,4) = categorykanribunrui3.category2
        left join categorykanri as categorykanritel
            on substring(haisoujouhou_temp.tel,1,2) = categorykanritel.category1
            and substring(haisoujouhou_temp.tel,3,4) = categorykanritel.category2
        left join categorykanri as categorykanriother24
            on substring(others2_temp.other24,1,2) = categorykanriother24.category1
            and substring(others2_temp.other24,3,4) = categorykanriother24.category2
        left join categorykanri as categorykanriother19
            on substring(others2_temp.other19,1,2) = categorykanriother19.category1
            and substring(others2_temp.other19,3,4) = categorykanriother19.category2
        left join categorykanri as categorykanriother21
            on substring(others2_temp.other21,1,2) = categorykanriother21.category1
            and substring(others2_temp.other21,3,4) = categorykanriother21.category2

        where orderhenkan.kokyakuorderbango='$kokyakuorderbango'
        and orderhenkan.ordertypebango2='$correctionOrders'
        order by minyuko.syouhinsyu
       ");

//      dd(/*QueryHelper::fetchResult("select * from v_orderhenkan"),*/QueryHelper::fetchResult("select * from purchase_pdf_data_temp"));

        $data=DB::table('purchase_pdf_data_temp');


        return $data;

    }
}
