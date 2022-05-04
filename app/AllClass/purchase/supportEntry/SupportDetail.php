<?php


namespace App\AllClass\purchase\supportEntry;


use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;

class SupportDetail{

    // When pulldown value is 1 and subscreen selection 1st button
    public static function creation_1_data($bango, $order_number){
         # search condition bango wise
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_temp ");
        // QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_temp  as
        //                        select bango, kokyakuorderbango, datachar02, datachar05, intorder01, intorder02, intorder03, intorder04, intorder05 from orderhenkan where datachar02='U110' and datachar02 not in ('U123', 'U150', 'U160') and orderhenkan.kokyakuorderbango='$order_number'");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_temp  as
                               select bango, kokyakuorderbango, datachar02, datachar05, intorder01, intorder02, intorder03, intorder04, intorder05 from orderhenkan where datachar02='U110' and datachar02 not in ('U123', 'U150', 'U160') and kokyakuorderbango not in (select orderuserbango from orderhenkan where datachar02='V413' and datachar02 not in ('U110', 'U123', 'U150', 'U160')) and orderhenkan.kokyakuorderbango='$order_number'");



        QueryHelper::runQuery("DROP TABLE IF EXISTS misyukko_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE misyukko_temp  as
                               select
                               orderbango,
                               datachar07,
                               min(datachar02) as datachar02,
                              /* max(dataint01) as dataint01,*/
                               sum(syukkasu*dataint05) as orders
                               from misyukko 
                               where 
                               dataint05>0 and 
                               datachar13='1' and 
                               datachar13 !='2' and 
                               yoteimeter = 0 and
                               substring(datachar22, 1, 1) = '0'
                                group by orderbango, datachar07");

        // $query = DB::table('misyukko_temp')->toSql();
        // var_dump(collect(QueryHelper::fetchResult($query)));
         

        QueryHelper::runQuery("DROP TABLE IF EXISTS final_misyukko_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE final_misyukko_temp  as
                               select
                               misyukko_temp.orderbango,
                               misyukko_temp.datachar07,
                               misyukko_temp.datachar02,
                               misyukko_temp.orders,
                               substring (tantousya.name,1,3) as person_name,
                               tantousya.datatxt0004 as datatxt0004
                               from misyukko_temp
                               left join tantousya on tantousya.bango = misyukko_temp.datachar02");



        QueryHelper::runQuery("DROP TABLE IF EXISTS order_detail_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE order_detail_temp  as
                    select distinct
                    orderhenkan.kokyakuorderbango as order_number,
                    final_misyukko_temp.person_name as person_name,
                    tuhanorder.information1 as information1,
                    tuhanorder.information2 as information2,
                    tuhanorder.information3 as information3,
                    final_misyukko_temp.orders as orders,
                    tuhanorder.juchukubun1,
                    tuhanorder.information7 as information7,
                    final_misyukko_temp.datachar07 as datachar07,
                    tuhanorder.chumonsyajouhou as chumonsyajouhou,
                    final_misyukko_temp.datatxt0004 as datatxt0004,
                    case
                    when orderhenkan.intorder01  is not null then
                    concat(
                        substring( cast (orderhenkan.intorder01 as varchar(100)),1,4),
                        '/',
                        substring(cast (orderhenkan.intorder01  as varchar(100)),5,2),
                        '/',
                        substring(cast (orderhenkan.intorder01  as varchar(100)),7,2)
                        )
                    else null
                    end as intorder01,
                    case
                    when orderhenkan.intorder02  is not null then
                    concat(
                        substring( cast (orderhenkan.intorder02 as varchar(100)),1,4),
                        '/',
                        substring(cast (orderhenkan.intorder02  as varchar(100)),5,2),
                        '/',
                        substring(cast (orderhenkan.intorder02  as varchar(100)),7,2)
                        )
                    else null
                    end as intorder02,
                    case
                    when orderhenkan.intorder03  is not null then
                    concat(
                        substring( cast (orderhenkan.intorder03 as varchar(100)),1,4),
                        '/',
                        substring(cast (orderhenkan.intorder03  as varchar(100)),5,2),
                        '/',
                        substring(cast (orderhenkan.intorder03  as varchar(100)),7,2)
                        )
                    else null
                    end as intorder03,
                    case
                    when orderhenkan.intorder04  is not null then
                    concat(
                        substring( cast (orderhenkan.intorder04 as varchar(100)),1,4),
                        '/',
                        substring(cast (orderhenkan.intorder04  as varchar(100)),5,2),
                        '/',
                        substring(cast (orderhenkan.intorder04  as varchar(100)),7,2)
                        )
                    else null
                    end as intorder04,
                    case
                    when orderhenkan.intorder05  is not null then
                    concat(
                        substring( cast (orderhenkan.intorder05 as varchar(100)),1,4),
                        '/',
                        substring(cast (orderhenkan.intorder05  as varchar(100)),5,2),
                        '/',
                        substring(cast (orderhenkan.intorder05  as varchar(100)),7,2)
                        )
                    else null
                    end as intorder05,
                  /*  final_misyukko_temp.syouhinsyu as misyukko_syouhinsyu_jm0002,*/
                    tuhanorder.otodoketime as tuhanorder_otodoketime_ju0029,
                    orderhenkan.datachar05 as datachar05_ju0008,
                    tuhanorder.juchukubun1 as tuhanorder_juchukubun1_orders_subject
                    FROM orderhenkan_temp as orderhenkan
                    join final_misyukko_temp on final_misyukko_temp.orderbango = orderhenkan.bango
                    left join tuhanorder on orderhenkan.bango  = tuhanorder.orderbango and orderhenkan.kokyakuorderbango='$order_number' limit 1
                    ");
    
     // FROM orderhenkan_temp as orderhenkan
     //                inner join misyukko_temp as misyukko on misyukko.orderbango=orderhenkan.bango 
     //                left join tantousya on orderhenkan.datachar05 = tantousya.bango and misyukko.datachar02=tantousya.bango
     //                left join tuhanorder on orderhenkan.bango  = tuhanorder.orderbango and orderhenkan.kokyakuorderbango='$order_number' limit 1

         # common spec
        QueryHelper::runQuery("DROP TABLE IF EXISTS order_detail_temp_final ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE order_detail_temp_final  as
                            select distinct
                            order_detail_temp.*,
                            sold_for.r17_3 as sold_to,
                            end_customer_for.r17_3 as end_customer

                            from order_detail_temp

                            left join v_torihikisaki as sold_for
                            on sold_for.torihikisaki_cd = order_detail_temp.information1
                            left join v_torihikisaki as end_customer_for
                            on end_customer_for.torihikisaki_cd = order_detail_temp.information3
                            order by order_detail_temp.intorder03 desc
                            ");

        return DB::table('order_detail_temp_final')->toSql();
    }



    // don't show delete data in edit mode: kokyakuorderbango not in (select kokyakuorderbango from orderhenkan where synchroorderbango2 = 1) 
    public static function edit_2_data($bango, $order_number){
        // get most orderhenkan. All row is same of orderhenkan where datachar02=V413
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_temp as
                                select bango, kokyakuorderbango, orderuserbango, datachar10, datachar12,datachar05, datachar11, intorder01, intorder02, intorder03, intorder04, intorder05, deletedate, date0012, date0020, datatxt0157, datachar14, datachar15, datatxt0147, date0013, date0014, date0015, datatxt0148,datatxt0149,datatxt0150, datachar09, date0016, ordertypebango2 as orderhenkan_ordertypebango2_maxval
                                from orderhenkan
                                where intorder04 in(1, 2) and 
                                datachar02 = 'V413' and 
                                synchroorderbango2 = 0 and 
                                kokyakuorderbango not in (select kokyakuorderbango from orderhenkan where synchroorderbango2 = 1) and 
                                kokyakuorderbango='$order_number'
                                order by bango desc limit 1");

      

        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_inner_data");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_inner_data as
                select distinct 
                kokyakuorderbango, intorder01, intorder02, intorder04, intorder03, intorder05
                from orderhenkan
                where datachar02 = 'U110'
                group by kokyakuorderbango, intorder01, intorder02, intorder04, intorder03, intorder05");



        QueryHelper::runQuery("DROP TABLE IF EXISTS soukonyuko_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE soukonyuko_temp as
                select orderbango, datachar01 as lbook_kokyakuorderbango, datachar09 as lbook_file,
                translate(datachar09,'０１２３４５６７８９ＡＢＣＤＥＦＧＨＩＪＫＬＭＮＯＰＱＲＳＴＵＶＷＸＹＺａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ','0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz') as lbook_short_file
                from soukonyuko");


      // $query = DB::table('orderhenkan_inner_data')->toSql();
      // var_dump(collect(QueryHelper::fetchResult($query)));


        QueryHelper::runQuery("DROP TABLE IF EXISTS minyuko_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE minyuko_temp  as
                              select minyuko.orderbango, minyuko.datachar07, minyuko.datachar13, minyuko.datachar11, minyuko.datachar09, sum(syouhizeiritu) as syouhizeiritu
                              from minyuko
                              join orderhenkan_temp on 
                              orderhenkan_temp.bango=minyuko.orderbango and minyuko.syouhinsyu = 1
                              group by minyuko.orderbango, minyuko.datachar07, minyuko.datachar13, minyuko.datachar11, minyuko.datachar09
                              ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS tuhanorder_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE tuhanorder_temp  as
                              select juchubango, juchukubun1, information7, chumonsyajouhou, otodoketime, information2
                              from tuhanorder
                              join orderhenkan_temp on 
                              orderhenkan_temp.orderuserbango  = tuhanorder.juchubango
                              ");

      //      $query = DB::table('orderhenkan_temp')->toSql();
      // var_dump(collect(QueryHelper::fetchResult($query)));

        QueryHelper::runQuery("DROP TABLE IF EXISTS all_number_search_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_number_search_temp  as
                    select
                    orderhenkan.bango as orderhenkan_bango,
                    orderhenkan.kokyakuorderbango as order_number,
                    --substring (tantousya.name,1,3) as person_name,
                    orderhenkan.datachar12 as person_name,
                    orderhenkan.datachar10 as information1,
                    tuhanorder.information2 as information2,
                    orderhenkan.datachar11 as information3,
                    minyuko.syouhizeiritu as orders,
                    -- @20220408 https://colgis-bd.backlog.com/view/USAC002-354#comment-145596826
                    -- case
                    --     when length(tuhanorder.juchukubun1) > 11 then concat(substring(tuhanorder.juchukubun1, 1, 11), '…')
                    --     else tuhanorder.juchukubun1
                    -- end as juchukubun1,
                    tuhanorder.juchukubun1,
                    tuhanorder.information7 as information7,
                    minyuko.datachar07 as datachar07,
                    tuhanorder.chumonsyajouhou as chumonsyajouhou,
                    tantousya.datatxt0004 as datatxt0004,
                    case
                        when length(tuhanorder.juchukubun1) > 11 then concat(substring(tuhanorder.juchukubun1, 1, 11), '…')
                        else tuhanorder.juchukubun1
                    end as orders_subject,
                    case
                    when orderhenkan_inner_data.intorder01  is not null then
                    concat(
                        substring( cast (orderhenkan_inner_data.intorder01 as varchar(100)),1,4),
                        '/',
                        substring(cast (orderhenkan_inner_data.intorder01  as varchar(100)),5,2),
                        '/',
                        substring(cast (orderhenkan_inner_data.intorder01  as varchar(100)),7,2)
                        )
                    else null
                    end as intorder01,
                    case
                    when orderhenkan_inner_data.intorder02  is not null then
                    concat(
                        substring( cast (orderhenkan_inner_data.intorder02 as varchar(100)),1,4),
                        '/',
                        substring(cast (orderhenkan_inner_data.intorder02  as varchar(100)),5,2),
                        '/',
                        substring(cast (orderhenkan_inner_data.intorder02  as varchar(100)),7,2)
                        )
                    else null
                    end as intorder02,
                    case
                    when orderhenkan_inner_data.intorder03  is not null then
                    concat(
                        substring( cast (orderhenkan_inner_data.intorder03 as varchar(100)),1,4),
                        '/',
                        substring(cast (orderhenkan_inner_data.intorder03  as varchar(100)),5,2),
                        '/',
                        substring(cast (orderhenkan_inner_data.intorder03  as varchar(100)),7,2)
                        )
                    else null
                    end as intorder03,
                    case
                    when orderhenkan_inner_data.intorder04  is not null then
                    concat(
                        substring( cast (orderhenkan_inner_data.intorder04 as varchar(100)),1,4),
                        '/',
                        substring(cast (orderhenkan_inner_data.intorder04  as varchar(100)),5,2),
                        '/',
                        substring(cast (orderhenkan_inner_data.intorder04  as varchar(100)),7,2)
                        )
                    else null
                    end as intorder04,
                    case
                    when orderhenkan_inner_data.intorder05  is not null then
                    concat(
                        substring( cast (orderhenkan_inner_data.intorder05 as varchar(100)),1,4),
                        '/',
                        substring(cast (orderhenkan_inner_data.intorder05  as varchar(100)),5,2),
                        '/',
                        substring(cast (orderhenkan_inner_data.intorder05  as varchar(100)),7,2)
                        )
                    else null
                    end as intorder05,
                    to_char(orderhenkan.deletedate, 'YYYY/MM/DD') as deletedate,
                    to_char(orderhenkan.date0012, 'YYYY/MM/DD') as date0012,
                    to_char(orderhenkan.date0020, 'YYYY/MM/DD') as date0020,
                    orderhenkan.datatxt0157 as include_place,
                    orderhenkan.datachar14 as model_name,
                    orderhenkan.datachar15 as os,
                    minyuko.datachar13,
                    minyuko.datachar11,
                    minyuko.datachar09,
                    orderhenkan.datatxt0147,
                    to_char(orderhenkan.date0013, 'YYYY/MM/DD') as date0013,
                    to_char(orderhenkan.date0014, 'YYYY/MM/DD') as date0014,
                    to_char(orderhenkan.date0015, 'YYYY/MM/DD') as date0015,
                    orderhenkan.datatxt0148,
                    orderhenkan.datatxt0149,
                    orderhenkan.datatxt0150,
                    orderhenkan.orderuserbango,
                    orderhenkan.datachar09 as datachar05_ju0008,
                    tuhanorder.otodoketime as tuhanorder_otodoketime_ju0029,
                    orderhenkan.orderhenkan_ordertypebango2_maxval as orderhenkan_ordertypebango2_maxval,
                    orderhenkan.date0016 as orderhenkan_date0016,
                    soukonyuko_temp.lbook_file as lbook_file,


                    CASE 
                    WHEN strpos(soukonyuko_temp.lbook_short_file::text,'¶')<1 THEN soukonyuko_temp.lbook_short_file
                    WHEN LENGTH(SPLIT_PART(soukonyuko_temp.lbook_short_file::text,'¶',1))>10 THEN concat(substring(SPLIT_PART(soukonyuko_temp.lbook_short_file::text,'¶',1),1,10),'...',SPLIT_PART(soukonyuko_temp.lbook_short_file::text,'.',2))
                    ELSE concat(SPLIT_PART(soukonyuko_temp.lbook_short_file::text,'¶',1),'.',SPLIT_PART(soukonyuko_temp.lbook_short_file::text,'.',2))
                    END as lbook_file_short,

                    
                    soukonyuko_temp.lbook_kokyakuorderbango as lbook_kokyakuorderbango
                    FROM orderhenkan_temp as orderhenkan
                    join minyuko_temp as minyuko on orderhenkan.bango=minyuko.orderbango
                    join orderhenkan_inner_data on orderhenkan_inner_data.kokyakuorderbango = orderhenkan.orderuserbango
                    left join tuhanorder_temp as tuhanorder on orderhenkan.orderuserbango  = tuhanorder.juchubango
                    left join tantousya on orderhenkan.datachar09 = tantousya.bango
                    left join soukonyuko_temp on soukonyuko_temp.orderbango=orderhenkan.bango 
                    limit 1
                    ");



        // $query = DB::table('all_number_search_temp')->toSql();
        // var_dump(collect(QueryHelper::fetchResult($query)));   


        # common spec
        QueryHelper::runQuery("DROP TABLE IF EXISTS all_number_search_temp_final ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_number_search_temp_final  as
                            select distinct
                            all_number_search_temp.*,
                            sold_for.r17_4 as sold_to,
                            end_customer_for.r17_4 as end_customer

                            from all_number_search_temp

                            left join v_torihikisaki as sold_for
                            on sold_for.torihikisaki_cd = all_number_search_temp.information1
                            left join v_torihikisaki as end_customer_for
                            on end_customer_for.torihikisaki_cd = all_number_search_temp.information3
                            ");

        
        return DB::table('all_number_search_temp_final')->toSql();
    }


    public static function edit_2_data_20211130($bango, $order_number){
        QueryHelper::runQuery("DROP TABLE IF EXISTS all_number_search_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_number_search_temp  as
                    select distinct
                    orderhenkan.kokyakuorderbango as order_number,
                    --tantousya.name as person_name,
                    orderhenkan.datachar12 as person_name,
                    orderhenkan.datachar10 as information1,
                    orderhenkan.datachar11 as information3,
                    minyuko.syouhizeiritu as orders,
                    case
                        when length(tuhanorder.juchukubun1) > 11 then concat(substring(tuhanorder.juchukubun1, 1, 11), '…')
                        else tuhanorder.juchukubun1
                    end as juchukubun1,
                    tuhanorder.information7 as information7,
                    minyuko.datachar07 as datachar07,
                    tuhanorder.chumonsyajouhou as chumonsyajouhou,
                    tantousya.datatxt0004 as datatxt0004,
                    case
                        when length(tuhanorder.juchukubun1) > 11 then concat(substring(tuhanorder.juchukubun1, 1, 11), '…')
                        else tuhanorder.juchukubun1
                    end as orders_subject,
                    case
                    when orderhenkan.intorder01  is not null then
                    concat(
                        substring( cast (orderhenkan.intorder01 as varchar(100)),1,4),
                        '/',
                        substring(cast (orderhenkan.intorder01  as varchar(100)),5,2),
                        '/',
                        substring(cast (orderhenkan.intorder01  as varchar(100)),7,2)
                        )
                    else null
                    end as intorder01,
                    case
                    when orderhenkan.intorder02  is not null then
                    concat(
                        substring( cast (orderhenkan.intorder02 as varchar(100)),1,4),
                        '/',
                        substring(cast (orderhenkan.intorder02  as varchar(100)),5,2),
                        '/',
                        substring(cast (orderhenkan.intorder02  as varchar(100)),7,2)
                        )
                    else null
                    end as intorder02,
                    case
                    when orderhenkan.intorder03  is not null then
                    concat(
                        substring( cast (orderhenkan.intorder03 as varchar(100)),1,4),
                        '/',
                        substring(cast (orderhenkan.intorder03  as varchar(100)),5,2),
                        '/',
                        substring(cast (orderhenkan.intorder03  as varchar(100)),7,2)
                        )
                    else null
                    end as intorder03,
                    case
                    when orderhenkan.intorder04  is not null then
                    concat(
                        substring( cast (orderhenkan.intorder04 as varchar(100)),1,4),
                        '/',
                        substring(cast (orderhenkan.intorder04  as varchar(100)),5,2),
                        '/',
                        substring(cast (orderhenkan.intorder04  as varchar(100)),7,2)
                        )
                    else null
                    end as intorder04,
                    case
                    when orderhenkan.intorder05  is not null then
                    concat(
                        substring( cast (orderhenkan.intorder05 as varchar(100)),1,4),
                        '/',
                        substring(cast (orderhenkan.intorder05  as varchar(100)),5,2),
                        '/',
                        substring(cast (orderhenkan.intorder05  as varchar(100)),7,2)
                        )
                    else null
                    end as intorder05,
                    orderhenkan.deletedate,
                    orderhenkan.date0012,
                    orderhenkan.date0020,
                    orderhenkan.datatxt0157 as include_place,
                    orderhenkan.datachar14 as model_name,
                    orderhenkan.datachar15 as os,
                    minyuko.datachar13,
                    minyuko.datachar09,
                    orderhenkan.datatxt0147,
                    orderhenkan.date0013,
                    orderhenkan.date0014,
                    orderhenkan.date0015,
                    orderhenkan.datatxt0148,
                    orderhenkan.datatxt0149,
                    orderhenkan.datatxt0150
                    FROM orderhenkan
                    join minyuko on orderhenkan.bango=minyuko.orderbango
                    left join tantousya on orderhenkan.datachar09 = tantousya.bango
                    left join tuhanorder on orderhenkan.orderuserbango  = tuhanorder.juchubango
                    and orderhenkan.datachar02='V413' and orderhenkan.kokyakuorderbango='$order_number'
                    limit 1
                    ");



        # common spec
        QueryHelper::runQuery("DROP TABLE IF EXISTS all_number_search_temp_final ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_number_search_temp_final  as
                            select distinct
                            all_number_search_temp.*,
                            sold_for.r17_4 as sold_to,
                            end_customer_for.r17_4 as end_customer

                            from all_number_search_temp

                            left join v_torihikisaki as sold_for
                            on sold_for.torihikisaki_cd = all_number_search_temp.information1
                            left join v_torihikisaki as end_customer_for
                            on end_customer_for.torihikisaki_cd = all_number_search_temp.information3
                            ");

        
        return DB::table('all_number_search_temp_final')->toSql();
    }
}
