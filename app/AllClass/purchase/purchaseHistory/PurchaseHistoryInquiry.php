<?php
namespace App\AllClass\purchase\purchaseHistory;
use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class PurchaseHistoryInquiry
{
    public static function readData($bango, $purchase_no, $correction_no,$line_no)
    {
//        dd($bango,$purchase_no,$correction_no,$line_no);

        //sql where condition creating
        /*$purchase_no_sql = " toiawasebango_temp.unsoumei = '$purchase_no' and toiawasebango_temp.datanum0013 =  '$correction_no' and nyukoold.syouhinsyu::text = '$line_no' ";*/
        $purchase_no_sql = " toiawasebango_temp.unsoumei = '$purchase_no' and toiawasebango_temp.datanum0013 =  '$correction_no'";
        QueryHelper::runQuery("DROP TABLE IF EXISTS V_Orderhenkan_hatsu_max");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE V_Orderhenkan_hatsu_max AS
            select
            kokyakuorderbango,
            max (V_Orderhenkan_hatsu.ordertypebango2) as ordertypebango2
            from V_Orderhenkan_hatsu
            group by  kokyakuorderbango
            ");
        QueryHelper::runQuery("DROP TABLE IF EXISTS V_Orderhenkan_hatsu_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE V_Orderhenkan_hatsu_temp AS
            select
            V_Orderhenkan_hatsu.kokyakuorderbango,
            V_Orderhenkan_hatsu.ordertypebango2,
            V_Orderhenkan_hatsu.datachar10,
            V_Orderhenkan_hatsu.datachar11,
            V_Orderhenkan_hatsu.datatxt0155,
            V_Orderhenkan_hatsu.datatxt0003,
            V_Orderhenkan_hatsu.datatxt0004,
            V_Orderhenkan_hatsu.datatxt0005
            from V_Orderhenkan_hatsu
            join V_Orderhenkan_hatsu_max
            on V_Orderhenkan_hatsu_max.kokyakuorderbango=V_Orderhenkan_hatsu.kokyakuorderbango
            and V_Orderhenkan_hatsu_max.ordertypebango2=V_Orderhenkan_hatsu.ordertypebango2
            ");
        QueryHelper::runQuery("DROP TABLE IF EXISTS toiawasebango_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE toiawasebango_temp AS
            select
            toiawasebango.*,
            V_Orderhenkan_hatsu_temp.kokyakuorderbango,
            V_Orderhenkan_hatsu_temp.ordertypebango2,
            V_Orderhenkan_hatsu_temp.datachar10,
            V_Orderhenkan_hatsu_temp.datachar11,
            V_Orderhenkan_hatsu_temp.datatxt0155,
            V_Orderhenkan_hatsu_temp.datatxt0003,
            V_Orderhenkan_hatsu_temp.datatxt0004,
            V_Orderhenkan_hatsu_temp.datatxt0005
            from toiawasebango
            left join V_Orderhenkan_hatsu_temp
            on V_Orderhenkan_hatsu_temp.datatxt0155=toiawasebango.touchakutime
            order by toiawasebango.unsoumei
            ");
        QueryHelper::runQuery("DROP TABLE IF EXISTS v_torihikisaki_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE v_torihikisaki_temp AS
        SELECT DISTINCT ON (v_torihikisaki.torihikisaki_cd)
            v_torihikisaki.*
            FROM v_torihikisaki
        --where v_torihikisaki.torihikisaki_cd like '00014301001'
            ");
        QueryHelper::runQuery("DROP TABLE IF EXISTS creating_division_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE creating_division_temp AS
            select distinct
            request.syouhinbango||' '||request.jouhou as creating_division,
            request.syouhinbango
            from request
            where color='0604_2作成区分'
            ");

        QueryHelper::runQuery("DROP TABLE IF EXISTS haisou_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE haisou_temp AS
            select
            haisou.bango,
            haisou.shikibetsucode,
            haisou.TorihikisakiBango,
            haisou.address,
            others2.other1,
            categorykanri_2.category2 || ' ' || categorykanri_2.category4 as payment_method


            from haisou
            join kokyaku1 on kokyaku1.bango = haisou.kokyakubango
            left join haisoujouhou on haisoujouhou.syukei1 = kokyaku1.bango
            join others2 on others2.otherint1 = haisou.bango
            left join categorykanri as categorykanri_2
            on CASE WHEN substring(others2.other1,1,1) = '1'
                  THEN categorykanri_2.category1||categorykanri_2.category2 =  haisoujouhou.bunrui3
                  WHEN substring(others2.other1,1,1) ='2'
                  THEN categorykanri_2.category1||categorykanri_2.category2 = others2.other24 END

            ");

//        dd(QueryHelper::fetchResult("select * from haisou_temp"),$purchase_no,$correction_no);

        QueryHelper::runQuery("CREATE TEMPORARY TABLE nyukoold_max_temp AS
                                                SELECT
                                                syouhinid, max (zaikometer) as max_nyukoold_zaikometer
                                                FROM nyukoold
                                                group by syouhinid
                                                order by syouhinid");

        QueryHelper::runQuery("DROP TABLE IF EXISTS purchase_inquery_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE purchase_inquery_temp as
                select distinct on (nyukoold.syouhinid,nyukoold.syouhinsyu)
                nyukoold.zaikometer,
                categorykanri_classification.category2 ||' '|| categorykanri_classification.category4 as purchase_segment,
                creating_division_temp.creating_division,
                toiawasebango_temp.datanum0013,
                toiawasebango_temp.unsoumei as purchase_no_searched,
                toiawasebango_temp.unsoumei as purchase_no,
                replace(substring(CAST(toiawasebango_temp.touchakudate AS text),1,10),'-','/') as purchase_date,
                v_torihikisaki_contractor.r16cd as  supplier,
                tantousya_puchaser.name as purchaser,
                toiawasebango_temp.denpyoname as invoice_number,
                concat_ws('/',substring(CAST(toiawasebango_temp.dataint01 as text),1,4),substring(CAST(toiawasebango_temp.dataint01 as text),5,2),substring(CAST(toiawasebango_temp.dataint01 as text),7,2)) as invoice_date,
                haisou_temp.payment_method,
                concat_ws('/',substring(CAST(toiawasebango_temp.dataint02 as text),1,4),substring(CAST(toiawasebango_temp.dataint02 as text),5,2),substring(CAST(toiawasebango_temp.dataint02 as text),7,2)) as payment_date,
                toiawasebango_temp.datachar10 as order_to_cd,
                v_torihikisaki_orderTo.r17_4cd as order_to1,
                toiawasebango_temp.datachar11 as end_customer_cd,
                v_torihikisaki_endCustomer.r17_4cd as end_customer,
                substring (replace(tantousya_indicator.name,' ',''),1,3) as indicator_name,
                substring (replace(tantousya_checker.name,' ',''),1,3) as checker,
                nyukoold.syouhinsyu::int as line_no,
                case
                    when length(nyukoold.yoteimeter::text) = 1
                        then nyukoold.idoutanabango ||'00'|| nyukoold.yoteimeter
                    when length(nyukoold.yoteimeter::text) = 2
                        then nyukoold.idoutanabango ||'0'|| nyukoold.yoteimeter
                        else nyukoold.idoutanabango || nyukoold.yoteimeter
                        end as order_number_line,
                --nyukoold.idoutanabango || '-' || nyukoold.yoteimeter  as order_number_line,
                nyukoold.datachar07 as part_no,
                nyukoold.datachar08 as part_name,
                to_char(nyukoold.nyukosu,'FM99,999,999,999,999') as quantity,
                to_char(nyukoold.kingaku,'FM99,999,999,999,999') as unite_price,
                to_char(nyukoold.syouhizeiritu,'FM99,999,999,999,999') as amount,
                to_char(nyukoold.soukobango,'FM99,999,999,999,999') as consumption_tax,
                categorykanri_accounting.category2 ||' '|| categorykanri_accounting.category4 as accounting,
                categorykanri_breakdown.category2 ||' '|| categorykanri_breakdown.category4 as breakdown,
                categorykanri_taxation.category2 ||' '|| categorykanri_taxation.category4 as taxation,
                v_torihikisaki_orderTo.r17_4 as order_to2,
                nyukoold.datachar11 as remarks,
                to_char(nyukoold.syouhizeiritu,'FM99,999,999,999,999') as amount_total,
                to_char(nyukoold.soukobango,'FM99,999,999,999,999') as consumption_tax_total,
                COALESCE(nyukoold.syouhizeiritu::int,0) + COALESCE(nyukoold.soukobango::int,0) as total_including_tax,
                toiawasebango_temp.bikou2 as voucher_remarks
                from toiawasebango_temp
                join nyukoold
                on nyukoold.syouhinid = toiawasebango_temp.unsoumei
                join nyukoold_max_temp
                on nyukoold_max_temp.syouhinid = nyukoold.syouhinid
                and nyukoold_max_temp.max_nyukoold_zaikometer = nyukoold.zaikometer
                join hikiatenyuko
                on hikiatenyuko.syouhinid =  nyukoold.syouhinid
                left join creating_division_temp
                on creating_division_temp.syouhinbango = toiawasebango_temp.konpousu
                left join v_torihikisaki_temp as  v_torihikisaki_contractor
                on substring (v_torihikisaki_contractor.torihikisaki_cd,1,8) = toiawasebango_temp.bikou1
                left join categorykanri as categorykanri_classification
                on categorykanri_classification.category1||categorykanri_classification.category2 = toiawasebango_temp.toiawasebango
                left join categorykanri as categorykanri_taxation
                on categorykanri_taxation.category1||categorykanri_taxation.category2 = nyukoold.datachar18
                left join categorykanri as categorykanri_accounting
                on categorykanri_accounting.category1||categorykanri_accounting.category2 = nyukoold.barcode
                left join categorykanri as categorykanri_breakdown
                on categorykanri_breakdown.category1||categorykanri_breakdown.category2 = nyukoold.codename
                left join tantousya as tantousya_puchaser
                on tantousya_puchaser.bango = toiawasebango_temp.touchakutime

                left join haisou_temp
                on haisou_temp.shikibetsucode = left(toiawasebango_temp.Bikou1::text,6)
                and haisou_temp.TorihikisakiBango = right (toiawasebango_temp.Bikou1::text,2)
                left join v_torihikisaki_temp as  v_torihikisaki_orderTo
                on v_torihikisaki_orderTo.torihikisaki_cd = toiawasebango_temp.datachar10
                left join v_torihikisaki_temp as  v_torihikisaki_endCustomer
                on v_torihikisaki_endCustomer.torihikisaki_cd = toiawasebango_temp.datachar11
                left join tantousya as tantousya_indicator
                on tantousya_indicator.bango = hikiatenyuko.datachar06
                left join tantousya as tantousya_checker
                on tantousya_checker.bango = hikiatenyuko.datachar07
                where $purchase_no_sql
                ");
        //dd(QueryHelper::fetchResult("select * from purchase_inquery_temp"),$purchase_no,$correction_no,$line_no);
        $search_sql = DB::table('purchase_inquery_temp')->toSql();
        return $search_sql;
    }
}
