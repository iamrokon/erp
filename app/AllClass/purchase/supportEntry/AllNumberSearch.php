<?php


namespace App\AllClass\purchase\supportEntry;


use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
class AllNumberSearch{

    // When pulldown value is 1 and subscreen selection 1st button
    public static function creation_1_data($bango, $from = false, Request $request = null){
        //     $columns = Schema::getColumnListing('v_torihikisaki');

        // echo "<pre>";
        // print_r($columns);
        // exit();

      //  $result = DB::select(DB::raw("update misyukko set datachar22 = '0000' where syouhinid='0151011079'"));

        //exit();
       

       // $condition_sql = "where orderhenkan.datachar05 = '$bango'";
        $condition_sql = "where tantousya.bango = '$bango'";
        if ($from) {
            $condition_sql = "";
        }


        # search condition bango wise
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_temp  as
                               select bango, kokyakuorderbango, datachar02, datachar05, intorder03 from orderhenkan where datachar02='U110' and datachar02 not in ('U123', 'U150', 'U160') and kokyakuorderbango not in (select orderuserbango from orderhenkan where datachar02='V413' and datachar02 not in ('U110', 'U123', 'U150', 'U160'))");

        // QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_temp2 ");
        // QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_temp2  as
        //                        select bango, kokyakuorderbango, datachar02, datachar05, intorder03 from orderhenkan where datachar02='V413'");

       

        QueryHelper::runQuery("DROP TABLE IF EXISTS misyukko_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE misyukko_temp  as
                               select distinct
                               syouhinid,
                               orderbango,
                               min(datachar02) as datachar02,
                               -- max(dataint01) as dataint01,
                               sum(syukkasu*dataint05) as orders
                               from misyukko where 
                               dataint05>0 and 
                               datachar13='1' and 
                               datachar13 !='2' and 
                               substring(datachar22, 1, 1) = '0' and 
                               yoteimeter = 0 group by 
                               syouhinid, orderbango");

        QueryHelper::runQuery("DROP TABLE IF EXISTS final_misyukko_temp ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE final_misyukko_temp  as
                               select
                               misyukko_temp.orderbango as orderbango,
                               misyukko_temp.syouhinid,
                               misyukko_temp.orders as orders,
                               tantousya.name as person_name,
                               tantousya.bango 
                               from misyukko_temp
                               left join tantousya on tantousya.bango = misyukko_temp.datachar02
                               $condition_sql");


        //  $query = DB::table('final_misyukko_temp')->toSql();
        // var_dump(collect(QueryHelper::fetchResult($query)));

        # column mapping
        QueryHelper::runQuery("DROP TABLE IF EXISTS all_number_search_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_number_search_temp  as
                    select
                    orderhenkan.kokyakuorderbango as order_number,
                    final_misyukko_temp.person_name as person_name,
                    tuhanorder.information1 as information1,
                    tuhanorder.information3 as information3,
                    final_misyukko_temp.orders as orders,
                    case
                        when length(tuhanorder.juchukubun1) > 11 then concat(substring(tuhanorder.juchukubun1, 1, 11), '・・・')
                        else tuhanorder.juchukubun1
                    end as orders_subject,
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
                    end as estimate_date,
                    orderhenkan.intorder03
                    FROM orderhenkan_temp as orderhenkan
                    join final_misyukko_temp on final_misyukko_temp.orderbango = orderhenkan.bango
                    left join tuhanorder on orderhenkan.bango  = tuhanorder.orderbango
                    order by orderhenkan.intorder03 desc
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

        
        return DB::table('all_number_search_temp_final');
    }



    // When pulldown value is 1 and subscreen selection 2nd button
    public static function edit_2_data($bango, $from = false, Request $request = null){

        // $condition_sql = "where orderhenkan.datachar05 = '$bango'";
        $condition_sql = "where tantousya.bango = '$bango'";
        if ($from) {
            $condition_sql = "";
        }


        /*QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_temp as
        select distinct bango, kokyakuorderbango, orderuserbango, datachar09, datachar10, datachar05, intorder01, date, intorder03, max(ordertypebango2) as maxval
        from orderhenkan
        where intorder04 in(1, 2) and 
        datachar02 = 'V413' and 
        synchroorderbango2 = 0 
        group by bango, kokyakuorderbango, orderuserbango, datachar09, datachar10, datachar05");*/

        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_m");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_m as
        select distinct 
        kokyakuorderbango, max(ordertypebango2) as maxval
        from orderhenkan
        where synchroorderbango2 =0 and kokyakuorderbango not in(select kokyakuorderbango from orderhenkan where synchroorderbango2 = 1)
        group by kokyakuorderbango");



        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_temp as
        select distinct bango, kokyakuorderbango, orderuserbango, datachar09,datachar12,datachar10, datachar05, intorder01, date, intorder03, ordertypebango2 as maxval
        from orderhenkan
        where intorder04 in(1, 2) and 
        datachar02 = 'V413' and 
        synchroorderbango2 = 0 
        group by bango, kokyakuorderbango, orderuserbango, datachar09, datachar10, datachar05");

        // $query = DB::table('orderhenkan_temp')->toSql();
        // var_dump(collect(QueryHelper::fetchResult($query)));    

        QueryHelper::runQuery("DROP TABLE IF EXISTS all_number_search_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE all_number_search_temp  as
                    select distinct
                    orderhenkan.kokyakuorderbango as order_number,
                    --tantousya.name as person_name,
                    orderhenkan.datachar12 as person_name,
                    orderhenkan.datachar10 as information1,
                    tuhanorder.information3 as information3,
                    orderhenkan.intorder01 as orders,
                    -- minyuko.datachar03 as orders_subject,
                     case
                        when length(minyuko.datachar03) > 11 then concat(substring(minyuko.datachar03, 1, 11), '・・・')
                        else minyuko.datachar03
                    end as orders_subject,
                    replace(substring(orderhenkan.date::text,1,10),'-','/') as estimate_date,
                    orderhenkan.date,
                    orderhenkan.intorder03
                    FROM orderhenkan_temp as orderhenkan
                    join orderhenkan_m on
                            orderhenkan_m.kokyakuorderbango=orderhenkan.kokyakuorderbango
                            and orderhenkan_m.maxval=orderhenkan.maxval
                    join minyuko on orderhenkan.bango=minyuko.orderbango and minyuko.syouhinsyu = 1
                    left join tantousya on orderhenkan.datachar09 = tantousya.bango
                    left join tuhanorder on orderhenkan.orderuserbango  = tuhanorder.juchubango
                    $condition_sql order by orderhenkan.intorder03 desc
                    ");


        //  $query = DB::table('all_number_search_temp')->toSql();
        // var_dump(collect(QueryHelper::fetchResult($query)));    

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

        // $query = DB::table('all_number_search_temp')->toSql();
        // var_dump(collect(QueryHelper::fetchResult($query)));       

        return DB::table('all_number_search_temp_final');
    }
}
