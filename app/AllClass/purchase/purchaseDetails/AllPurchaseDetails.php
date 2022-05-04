<?php

namespace App\AllClass\purchase\purchaseDetails;

use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AllPurchaseDetails
{
    public static function readData($bango, $allRequest)
    {

//        dd($bango,$allRequest);
        try {
            if (!empty($allRequest['order_no'])) {
                $req_order_no = $allRequest['order_no'];
            } else {
                $req_order_no = null;
            }

            //sql where condition creating

            $purchase_details_sql = '';
            $purchase_details1_sql = '';
            $purchase_details2_sql = '';
            if ($req_order_no) {
                $purchase_details_sql .= "  where orderhenkan.datachar02 not in ('U160') and hikiatesyukko.kaiinid is null";
                $purchase_details1_sql .= "  where orderhenkan.datachar02 not in ('U160') and misyukko.dataint08 > 0 and misyukko.datachar13 not in ('2') and misyukko.yoteimeter = '0'";
                $purchase_details2_sql .= "  where minyuko.datachar01 not in ('v160') and toiawasebango_temp.unsoumei is not null";
                /*$purchase_details2_sql .= "  where minyuko.datachar01 not in ('v160') and juchusyukko2.codename is not null and toiawasebango_temp.unsoumei is not null";*/
            }
//        dd($sql);


            QueryHelper::runQuery("DROP TABLE IF EXISTS v_torihikisaki_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE v_torihikisaki_temp AS
            SELECT DISTINCT ON (v_torihikisaki.torihikisaki_cd)
            v_torihikisaki.*
            FROM v_torihikisaki
            --where v_torihikisaki.torihikisaki_cd like '00014301001'
            ");

            QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_m");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_m AS
            SELECT DISTINCT
            kokyakuorderbango, max(ordertypebango2) as maxval
            FROM orderhenkan
            WHERE synchroorderbango =0
            AND datachar10 IS NULL
            AND kokyakuorderbango='$req_order_no'
            GROUP BY kokyakuorderbango ");

            QueryHelper::runQuery("DROP TABLE IF EXISTS sales_slip_flag_request_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE sales_slip_flag_request_temp AS
            select distinct
            request.syouhinbango||' '||request.jouhou as sales_slip_flag,
            request.syouhinbango
            from request
            where color='0604支払データ作成フラグ'
            ");

            //purchase details data
            QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_details_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_details_temp AS
            select distinct
            CONCAT(tantousya.bango, ' ', tantousya.name) AS responsible_name,
            v_torihikisaki.R17_4 as contractor,
            tuhanorder.juchukubun1 as order_sub,
            cast (concat_ws('/',substring (cast(orderhenkan.intorder03 as text),1,4),substring (cast(orderhenkan.intorder03 AS text),5,2),substring (cast(orderhenkan.intorder03 AS text),7,2)) AS text) as sales_date,
            sales_slip_flag_request_temp.sales_slip_flag,
            to_char(tuhanorder.money10,'FM99,999,999,999,999') as money10,
            hikiatesyukko.datachar16,
            hikiatesyukko.datachar18,
            tantousya1.bango as  instructor_bango,
            substring(replace(tantousya1.name,' ',''),1,3) as instructor,
            tantousya2.bango as  inspector_bango,
            substring(replace(tantousya2.name,' ',''),1,3) as inspector,
            tuhanorder.juchubango,
            hikiatesyukko.idoutanabango,
            hikiatesyukko.syouhinid

            from orderhenkan
            join orderhenkan_m
            on orderhenkan_m.kokyakuorderbango=orderhenkan.kokyakuorderbango
            and orderhenkan_m.maxval=orderhenkan.ordertypebango2
            join tuhanorder
            on tuhanorder.juchubango=orderhenkan.kokyakuorderbango
            and tuhanorder.orderbango=orderhenkan.bango
            join hikiatesyukko
            on hikiatesyukko.syouhinid=orderhenkan.kokyakuorderbango
            left join tantousya on tantousya.bango = orderhenkan.datachar05
            left join tantousya as tantousya1 on tantousya1.bango = hikiatesyukko.datachar17
            left join tantousya as tantousya2 on tantousya2.bango = hikiatesyukko.datachar18
            left join v_torihikisaki on v_torihikisaki.torihikisaki_cd = tuhanorder.information1
            left join sales_slip_flag_request_temp
            on sales_slip_flag_request_temp.syouhinbango::text = hikiatesyukko.datachar04

            $purchase_details_sql
            limit 1");

            //purchase details1 data
            QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_details1_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_details1_temp AS
            select distinct
            misyukko.syukkasu,
            misyukko.dataint05,
            misyukko.dataint06,
            misyukko.dataint07,
            (misyukko.syukkasu*misyukko.dataint05) as syukkasu_multi_dataint05,
            (misyukko.syukkasu*misyukko.dataint06) as syukkasu_multi_dataint06,
            (misyukko.syukkasu*misyukko.dataint07) as syukkasu_multi_dataint07,
            misyukko.dataint09 as order_date_sort,
            cast (concat_ws('/',substring (cast(misyukko.dataint09 as text),1,4),substring (cast(misyukko.dataint09 AS text),5,2),substring (cast(misyukko.dataint09 AS text),7,2)) AS text) as order_date,
            misyukko.dataint10 as delivery_date_sort,
            cast (concat_ws('/',substring (cast(misyukko.dataint10 as text),1,4),substring (cast(misyukko.dataint10 AS text),5,2),substring (cast(misyukko.dataint10 AS text),7,2)) AS text) as delivery_date,
            v_torihikisaki.R17_4 as vendor,
            misyukko.datachar04 as name,
            misyukko.syukkasu as purchase_details1_quantity_sort,
            to_char(misyukko.syukkasu,'FM99,999,999,999,999') as purchase_details1_quantity,
            misyukko.dataint08 as purchase_details1_unit_price_sort,
            to_char(misyukko.dataint08,'FM99,999,999,999,999') as  purchase_details1_unit_price,
            (misyukko.syukkasu*misyukko.dataint08) as purchase_details1_amount_sort,
            to_char((misyukko.syukkasu*misyukko.dataint08),'FM99,999,999,999,999') as purchase_details1_amount,
            substring (misyukko.datachar22,4) as create_order,
            CASE
             WHEN length(misyukko.syouhinsyu::text) = 1
                THEN misyukko.syouhinid ||'00'|| misyukko.syouhinsyu || misyukko.hantei
             WHEN length(misyukko.syouhinsyu::text) = 2
                THEN misyukko.syouhinid ||'0'|| misyukko.syouhinsyu || misyukko.hantei
             ELSE misyukko.syouhinid||misyukko.syouhinsyu||misyukko.hantei
                END as order_line_branch_no

            from orderhenkan
            join orderhenkan_m
            on orderhenkan_m.kokyakuorderbango=orderhenkan.kokyakuorderbango
            and orderhenkan_m.maxval=orderhenkan.ordertypebango2
            right join misyukko
            on misyukko.syouhinid=orderhenkan.kokyakuorderbango
            left join v_torihikisaki on v_torihikisaki.torihikisaki_cd = misyukko.datachar05
            $purchase_details1_sql");


            //purchase details2 data

            QueryHelper::runQuery("DROP TABLE IF EXISTS categorykanri_classification_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE categorykanri_classification_temp AS
            select category1,category2,category4,bango,suchi2 from categorykanri");

            QueryHelper::runQuery("DROP TABLE IF EXISTS minyuko_m");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE minyuko_m AS
            SELECT DISTINCT
            idoutanabango,
            syouhinid,
            max(zaikometer) as zmaxval
            FROM minyuko
            where idoutanabango='$req_order_no'
            GROUP BY idoutanabango,syouhinid ");

            QueryHelper::runQuery("DROP TABLE IF EXISTS toiawasebango_m");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE toiawasebango_m AS
            SELECT DISTINCT
            unsoumei,
            max(datanum0013) as Dmaxval
            FROM toiawasebango
            GROUP BY unsoumei ");

            QueryHelper::runQuery("DROP TABLE IF EXISTS toiawasebango_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE toiawasebango_temp AS
            SELECT
            toiawasebango.*
            FROM toiawasebango
            JOIN toiawasebango_m
            ON toiawasebango_m.unsoumei=toiawasebango.unsoumei
            AND toiawasebango_m.Dmaxval=toiawasebango.datanum0013
            ");

            QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_m2");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_m2 AS
            SELECT DISTINCT
            kokyakuorderbango, max(ordertypebango2) as maxval
            FROM orderhenkan
            WHERE datachar02='V413'
            AND synchroorderbango2 =0
            GROUP BY kokyakuorderbango
            order by kokyakuorderbango");

            QueryHelper::runQuery("DROP TABLE IF EXISTS minyuko_m_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE minyuko_m_temp AS
            SELECT DISTINCT
            orderhenkan_m2.kokyakuorderbango,
            orderhenkan_m2.maxval ,
            minyuko_m.idoutanabango,
            minyuko_m.syouhinid,
            minyuko_m.zmaxval
            FROM orderhenkan_m2
            join minyuko_m
            on minyuko_m.syouhinid = orderhenkan_m2.kokyakuorderbango
            ");
//            dd(QueryHelper::fetchResult("select * from minyuko_m_temp"));
            QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_details2_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_details2_temp AS
            select distinct
            minyuko_m_temp.kokyakuorderbango,
            minyuko_m_temp.maxval as ordertypebango2,
            minyuko.syouhinid,
            minyuko.datachar01,
            toiawasebango_temp.unsoumei,
            toiawasebango_temp.bikou1,
            CASE
             WHEN length(nyukoold.syouhinsyu::text) = 1
                THEN nyukoold.syouhinid ||'00'|| nyukoold.syouhinsyu
             WHEN length(nyukoold.syouhinsyu::text) = 2
                THEN nyukoold.syouhinid ||'0'|| nyukoold.syouhinsyu
             ELSE nyukoold.syouhinid||nyukoold.syouhinsyu
                END as line_no,
            substring(replace(toiawasebango_temp.touchakudate::text,'-',''),1,8)::int as  purchase_date_sort,
            REPLACE(substring(CAST(toiawasebango_temp.touchakudate AS text),1,10),'-','/') as purchase_date,
            v_torihikisaki.R16 as vendor2,
            toiawasebango_temp.denpyoname as invoice_no,
            nyukoold.datachar08 as name2,
            nyukoold.nyukosu::bigint as purchase_details2_quantity2_sort,
            to_char(nyukoold.nyukosu,'FM99,999,999,999,999') as purchase_details2_quantity2,
            nyukoold.kingaku::bigint as purchase_details2_unit_price2_sort,
            to_char(nyukoold.kingaku,'FM99,999,999,999,999') as purchase_details2_unit_price2,
            nyukoold.syouhizeiritu::bigint as purchase_details2_amount2_sort,
            to_char(nyukoold.syouhizeiritu,'FM99,999,999,999,999') as purchase_details2_amount2,
            CASE
             WHEN length(nyukoold.yoteimeter::text) = 1
                THEN nyukoold.idoutanabango ||'00'|| nyukoold.yoteimeter
             WHEN length(nyukoold.yoteimeter::text) = 2
                THEN nyukoold.idoutanabango ||'0'|| nyukoold.yoteimeter
             ELSE nyukoold.idoutanabango||nyukoold.yoteimeter
                END as order_line_no,
            categorykanri_classification.category2 ||' '|| categorykanri_classification.category4 as classification

            from minyuko
            join minyuko_m_temp
            on minyuko_m_temp.idoutanabango=minyuko.idoutanabango
            and minyuko_m_temp.syouhinid=minyuko.syouhinid
            and minyuko_m_temp.zmaxval=minyuko.zaikometer
            left join nyukoold
            on  nyukoold.idoutanabango=minyuko.syouhinid
            left join toiawasebango_temp
            on toiawasebango_temp.unsoumei=nyukoold.syouhinid
            left join juchusyukko2
            on juchusyukko2.syouhinid=toiawasebango_temp.unsoumei
            left join v_torihikisaki on left (v_torihikisaki.torihikisaki_cd,8) = toiawasebango_temp.bikou1
            left join categorykanri_classification_temp as categorykanri_classification
            on categorykanri_classification.category1||categorykanri_classification.category2 = minyuko.datachar01
            $purchase_details2_sql
            --where minyuko.datachar01 not in ('v160')
            ");
                //minyuko.datachar01 not in ('v160')  and  juchusyukko2.codename is not null and categorykanri_classification.category1='D9' and toiawasebango_temp.unsoumei is not null

//        dd(QueryHelper::fetchResult("select * from purchase_details2_temp"),QueryHelper::fetchResult("select * from v_torihikisaki_temp"),$req_order_no);

            QueryHelper::fetchResult("select * from purchase_details_temp");
            QueryHelper::fetchResult("select * from purchase_details1_temp");
            QueryHelper::fetchResult("select * from purchase_details2_temp");
            $search_sql_arr=[];
            array_push($search_sql_arr,DB::table('purchase_details_temp')->toSql());
            array_push($search_sql_arr,DB::table('purchase_details1_temp')->toSql());
            array_push($search_sql_arr,DB::table('purchase_details2_temp')->toSql());
//            dd('hlw');
        } catch (\Exception $e) {
//            $search_sql_arr[0]='ng';
            dd($e);
        }
        return $search_sql_arr;

    }
}
