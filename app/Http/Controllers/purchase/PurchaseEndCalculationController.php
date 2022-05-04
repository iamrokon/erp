<?php

namespace App\Http\Controllers\purchase;

use App\Http\Controllers\Controller;
use App\AllClass\ButtonMsg;
use App\AllClass\db\QueryHandler;
use App\AllClass\purchase\paymentSchedule\AllPaymentSchedule;
use App\kengen;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\tantousya;
use PDF;
use ZipArchive;
use File;
use Exception;
use DateTime;
use Illuminate\Support\Facades\Session;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

class PurchaseEndCalculationController extends Controller
{
    public function index(Request $request)
    {
        /*$bango = request('userId');
        $tantousya = tantousya::find($bango);
        return view('flatRateContract.createData2.mainFlatRateDataCreation',compact('bango','tantousya'));*/

        $bango = request('userId');
        $tantousya = tantousya::find($bango);
        session()->put('userId',$bango);

        //pull option selection starts here
        $data003=substr($tantousya->datatxt0003, 2,4);
        $data003_left=substr($tantousya->datatxt0003, 2,4);
        $data003_right=substr($tantousya->datatxt0003, 2,4);
        if (isset($data_from_view['division_datachar05_start'])) {
            $data003_left=substr($data_from_view['division_datachar05_start'], 2,4);
        }else if (isset($data_from_view['division_datachar05_startReqVal'])) {
            $data003_left=substr($data_from_view['division_datachar05_startReqVal'], 2,4);
        }
        if (isset($data_from_view['division_datachar05_end'])) {
            $data003_right=substr($data_from_view['division_datachar05_end'], 2,4);
        }if (isset($data_from_view['division_datachar05_endReqVal'])) {
        $data003_right=substr($data_from_view['division_datachar05_endReqVal'], 2,4);
    }
        $data004=substr($tantousya->datatxt0004, 2,5);
        $data005=substr($tantousya->datatxt0005, 2,6);
        $personal_datatxt0003=QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'B9' ")->where("category2 = '$data003' ")->get()->first();
        $personal_datatxt0004=QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C1' ")->where("category2 = '$data004' ")->get()->first();
        $personal_datatxt0005=QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("category2 = '$data005' ")->get()->first();
        //pull option selection ends here

        //review data
        $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7501'");
        $review_orderbango = $reviewData->orderbango;

        //get categorykanri data
        $B9Data_left = QueryHelper::fetchResult("select *,RIGHT(category2, 2) as category2_show from categorykanri where category1 = 'B9' and (suchi2 = 0 or suchi2 is null) and left(category2, 2) ='$review_orderbango' ORDER BY category2 ASC");
        $B9Data_right = QueryHelper::fetchResult("select *,RIGHT(category2, 2) as category2_show from categorykanri where category1 = 'B9' and (suchi2 = 0 or suchi2 is null) and left(category2, 2) ='$review_orderbango' ORDER BY category2 ASC");
        $C1Data_left = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C1' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_left%' ")->get()->execute();
        $C1Data_right = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C1' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_right%' ")->get()->execute();
        $C2Data_left = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_left%' ")->get()->execute();
        $C2Data_right = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_right%' ")->get()->execute();
        //get tantousya data
        $datachar05 = QueryHelper::fetchResult("select * from tantousya where deleteflag = 0 and ztanka='$review_orderbango' order by bango");

        return view('purchase.purchaseEndCal.mainPurchaseEndCal', compact('bango', 'tantousya', 'B9Data_left','B9Data_right','C1Data_left','C1Data_right','C2Data_left','C2Data_right','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','datachar05'));

    }

    public static function orderValidation(Request $request)
    {
//        dd(Request()->all());
        try {
            if (!empty(request('division_datachar05_start'))) {
                $req_division_start = substr(request('division_datachar05_start'), 4, 2);
            } else {
                $req_division_start = null;
            }
            if (!empty(request('division_datachar05_end'))) {
                $req_division_end = substr(request('division_datachar05_end'), 4, 2);
            } else {
                $req_division_end = null;
            }

            if (!empty(request('department_datachar05_start'))) {
                $req_department_start = substr(request('department_datachar05_start'), 4, 3);
            } else {
                $req_department_start = null;
            }
            if (!empty(request('department_datachar05_end'))) {
                $req_department_end = substr(request('department_datachar05_end'), 4, 3);
            } else {
                $req_department_end = null;
            }

            if (!empty(request('group_datachar05_start'))) {
                $req_t_group_start = substr(request('group_datachar05_start'), 4, 4);
            } else {
                $req_t_group_start = null;
            }
            if (!empty(request('group_datachar05_end'))) {
                $req_t_group_end = substr(request('group_datachar05_end'), 4, 4);
            } else {
                $req_t_group_end = null;
            }


            if (!empty(request('purchase_completion_date'))) {
                $purchase_completion_date = str_replace('/','',request('purchase_completion_date'));
            } else {
                $purchase_completion_date = null;
            }

            if (!empty(request('order_no'))) {
                $orderEntry = request('order_no');
            } else {
                $orderEntry = null;
            }

            $datatxt0003_sql = '';
            if ($req_division_start != '' && $req_division_end != '' && ($req_division_start != $req_division_end)) {

                $datatxt0003_sql .= " and substring(v_orderhenkan.datatxt0003::text,1,2)='B9' AND right(v_orderhenkan.datatxt0003::text,2) between '$req_division_start' and  '$req_division_end' ";
            } else {

                $datatxt0003_sql .= " and substring(v_orderhenkan.datatxt0003::text,1,2)='B9' AND right(v_orderhenkan.datatxt0003::text,2) = '$req_division_start'";
            }

            $datatxt0004_sql = '';
            if ($req_department_start != '' && $req_department_end != '' && ($req_department_start != $req_department_end)) {

                $datatxt0004_sql .= "  and substring(v_orderhenkan.datatxt0004::text,1,2)='C1' AND right(v_orderhenkan.datatxt0004::text,3) between '$req_department_start' and '$req_department_end'";
            } else if ($req_department_start != '') {

                $datatxt0004_sql .= "  and substring(v_orderhenkan.datatxt0004::text,1,2)='C1' AND right(v_orderhenkan.datatxt0004::text,3) = '$req_department_start'";
            }
            $datatxt0005_sql = '';
            if ($req_t_group_start != '' && $req_t_group_end != '' && ($req_t_group_start != $req_t_group_end)) {

                $datatxt0005_sql .= "  and substring(v_orderhenkan.datatxt0005::text,1,2)='C2' AND right(v_orderhenkan.datatxt0005::text ,4) between '$req_t_group_start' and '$req_t_group_end'";
            } else if ($req_t_group_start != '') {

                $datatxt0005_sql .= "  and substring(v_orderhenkan.datatxt0005::text,1,2)='C2' AND right(v_orderhenkan.datatxt0005::text ,4) = '$req_t_group_start'";
            }

            $order_no_sql_before='';
            $order_no_sql='';
            $order_no_sales_v160_sql='';
            $order_no_sales_v150_sql='';
            if ($orderEntry==null){
                $order_no_sql .= "  where hikiatesyukko.datachar16 = '2' and hikiatesyukko.datachar17 is not null and hikiatesyukko.datachar18 is not null";
                $order_no_sales_v160_sql .= "  where lower(minyuko_temp.datachar01) = 'v160' and juchusyukko2.barcode is not null and juchusyukko2.codename is not null and juchusyukko2.tanka = '2'";
                $order_no_sales_v150_sql .= "  where lower(minyuko_temp.datachar01) = 'v150'";
            }
            else{
                $order_no_sql_before .= "  where v_orderhenkan.kokyakuorderbango  = '$orderEntry'  and hikiatesyukko.datachar16 = '1'";
                $order_no_sql .= "  where v_orderhenkan.kokyakuorderbango  = '$orderEntry'  and hikiatesyukko.datachar16 = '2' and hikiatesyukko.datachar17 is not null and hikiatesyukko.datachar18 is not null";
                $order_no_sales_v160_sql .= "  where v_orderhenkan.kokyakuorderbango  = '$orderEntry' and lower(minyuko_temp.datachar01) = 'v120' and juchusyukko2.barcode is not null and juchusyukko2.codename is not null and juchusyukko2.tanka = '2'";
                $order_no_sales_v150_sql .= "  where v_orderhenkan.kokyakuorderbango  = '$orderEntry'  and lower(minyuko_temp.datachar01) = 'v150'";
            }

            QueryHelper::runQuery("DROP TABLE IF EXISTS v_orderhenkan_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE v_orderhenkan_temp AS SELECT DISTINCT kokyakuorderbango, max (ordertypebango2) as max_v_orderhenkan_ordertypebango2 FROM v_orderhenkan where synchroorderbango='0' group by kokyakuorderbango order by kokyakuorderbango");
            QueryHelper::runQuery("DROP TABLE IF EXISTS v_orderhenkan_temp2");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE v_orderhenkan_temp2 AS SELECT DISTINCT kokyakuorderbango, max (ordertypebango2) as max_v_orderhenkan_ordertypebango2 FROM v_orderhenkan where synchroorderbango2='0' group by kokyakuorderbango order by kokyakuorderbango");
            QueryHelper::runQuery("DROP TABLE IF EXISTS tuhanorder_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE tuhanorder_temp AS SELECT DISTINCT tuhanorder.* FROM tuhanorder WHERE tuhanorder.juchukubun2 is null");
            QueryHelper::runQuery("DROP TABLE IF EXISTS misyukko_temp_before");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE misyukko_temp_before AS SELECT
                                               misyukko.syouhinid,
                                               misyukko.syouhinsyu,
                                               misyukko.hantei
                                               FROM misyukko
                                               WHERE yoteimeter='0'
                                               group by misyukko.syouhinid,misyukko.syouhinsyu,misyukko.hantei");
            QueryHelper::runQuery("DROP TABLE IF EXISTS misyukko_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE misyukko_temp AS SELECT
                                               misyukko.syouhinid as misyukko_syouhinid,
                                               misyukko.syouhinsyu as misyukko_syouhinsyu,
                                               misyukko.hantei as misyukko_hantei,
                                               misyukko.syukkasu as misyukko_syukkasu,
                                               misyukko.dataint08 as misyukko_dataint08,
                                               misyukko.dataint07 as misyukko_dataint07,
                                               misyukko.dataint06 as misyukko_dataint06,
                                               misyukko.dataint05 as misyukko_dataint05
                                               from misyukko
                                               left join misyukko_temp_before
                                               on misyukko_temp_before.syouhinid = misyukko.syouhinid
                                               and misyukko_temp_before.syouhinsyu = misyukko.syouhinsyu
                                               and misyukko_temp_before.hantei = misyukko.hantei");
            QueryHelper::runQuery("DROP TABLE IF EXISTS minyuko_max_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE minyuko_max_temp AS SELECT syouhinid,  max (zaikometer) as max_minyuko_zaikometer FROM minyuko group by syouhinid");
            QueryHelper::runQuery("DROP TABLE IF EXISTS minyuko_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE minyuko_temp AS
                                                SELECT DISTINCT
                                                minyuko.*
                                                FROM minyuko
                                                join minyuko_max_temp
                                                on minyuko_max_temp.syouhinid = minyuko.syouhinid
                                                and minyuko_max_temp.max_minyuko_zaikometer = minyuko.zaikometer
                                                --where minyuko.idoutanabango = '0151017198'
                                                order by minyuko.syouhinid");
            QueryHelper::runQuery("DROP TABLE IF EXISTS nyukoold_max_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE nyukoold_max_temp AS
                                                SELECT
                                                syouhinid, max (zaikometer) as max_nyukoold_zaikometer
                                                FROM nyukoold
                                                group by syouhinid
                                                order by syouhinid");
            QueryHelper::runQuery("DROP TABLE IF EXISTS nyukoold_max_temp2");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE nyukoold_max_temp2 AS
                                                SELECT
                                                idoutanabango,
                                                yoteimeter,
                                                max (zaikometer) as max_nyukoold_zaikometer,
                                                sum (syouhizeiritu) as sum_nyukoold_syouhizeiritu
                                                FROM nyukoold
                                                group by idoutanabango,yoteimeter
                                                order by idoutanabango,yoteimeter");
            //dd(QueryHelper::fetchResult("select * from nyukoold_max_temp2 where idoutanabango='0351000911'"));
            QueryHelper::runQuery("DROP TABLE IF EXISTS nyukoold_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE nyukoold_temp AS
                                                SELECT DISTINCT
                                                nyukoold.*
                                                FROM nyukoold
                                                join nyukoold_max_temp
                                                on nyukoold_max_temp.syouhinid = nyukoold.syouhinid
                                                and nyukoold_max_temp.max_nyukoold_zaikometer = nyukoold.zaikometer
                                                order by nyukoold.idoutanabango");

            QueryHelper::runQuery("DROP TABLE IF EXISTS nyukoold_temp2");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE nyukoold_temp2 AS
                                                SELECT DISTINCT
                                                nyukoold.*,
                                                nyukoold_max_temp2.sum_nyukoold_syouhizeiritu,
                                                nyukoold_max_temp2.max_nyukoold_zaikometer
                                                FROM nyukoold
                                                join nyukoold_max_temp2
                                                on nyukoold_max_temp2.idoutanabango = nyukoold.idoutanabango
                                                and nyukoold_max_temp2.yoteimeter = nyukoold.yoteimeter
                                                and nyukoold_max_temp2.max_nyukoold_zaikometer = nyukoold.zaikometer
                                                order by nyukoold.idoutanabango");
            //dd(QueryHelper::fetchResult("select * from v_orderhenkan_temp where kokyakuorderbango='0351000909'"));

            if ($orderEntry==null){
                $status='ng';
                $msg='1st condition omitted due to no orderNo';
                return response()->json( [$status,$msg] );
            }

            $checkOrderExistenceBefore=QueryHelper::fetchResult("select distinct
                                                            v_orderhenkan.*,
                                                            hikiatesyukko.syouhinid,
                                                            hikiatesyukko.datachar16,
                                                            hikiatesyukko.datachar17,
                                                            hikiatesyukko.datachar18
                                                            from v_orderhenkan
                                                            join v_orderhenkan_temp
                                                            on v_orderhenkan_temp.kokyakuorderbango =  v_orderhenkan.kokyakuorderbango
                                                            and v_orderhenkan_temp.max_v_orderhenkan_ordertypebango2 =  v_orderhenkan.ordertypebango2
                                                            join hikiatesyukko
                                                            on  hikiatesyukko.syouhinid = v_orderhenkan.kokyakuorderbango
                                                            $order_no_sql_before ");


            if (!empty($checkOrderExistenceBefore) && $orderEntry){
                $status='ng1';
                $msg='Purchase completed and calculated';
                return response()->json( [$status,$msg] );
            }

            $checkOrderExistence=QueryHelper::fetchResult("select distinct
                                                            v_orderhenkan.*,
                                                            hikiatesyukko.syouhinid,
                                                            hikiatesyukko.datachar16,
                                                            hikiatesyukko.datachar17,
                                                            hikiatesyukko.datachar18
                                                            from v_orderhenkan
                                                            join v_orderhenkan_temp
                                                            on v_orderhenkan_temp.kokyakuorderbango =  v_orderhenkan.kokyakuorderbango
                                                            and v_orderhenkan_temp.max_v_orderhenkan_ordertypebango2 =  v_orderhenkan.ordertypebango2
                                                            join hikiatesyukko
                                                            on  hikiatesyukko.syouhinid = v_orderhenkan.kokyakuorderbango
                                                            $order_no_sql $datatxt0003_sql $datatxt0004_sql $datatxt0005_sql");

            //dd($checkOrderExistenceBefore,$checkOrderExistence,$order_no_sql,$datatxt0003_sql, $datatxt0004_sql, $datatxt0005_sql);

            if (count($checkOrderExistence)>0){

                $checkSaleV160Existence=QueryHelper::fetchResult("select distinct on (minyuko_temp2.syouhinid,minyuko_temp2.syouhinsyu)
                                                            v_orderhenkan.kokyakuorderbango as v_orderhenkan_kokyakuorderbango,
                                                            v_orderhenkan.ordertypebango2 as v_orderhenkan_ordertypebango2,
                                                            orderhenkan.kokyakuorderbango as v_orderhenkan_v160_kokyakuorderbango,
                                                            orderhenkan.ordertypebango2 as orderhenkan_ordertypebango2,
                                                            tuhanorder_temp.information2 as tuhanorder_temp_information2,
                                                            tuhanorder_temp.otodoketime as tuhanorder_temp_otodoketime,
                                                            misyukko_temp.misyukko_syouhinid,
                                                            misyukko_temp.misyukko_syouhinsyu,
                                                            misyukko_temp.misyukko_hantei,
                                                            lower (minyuko_temp2.datachar01) as minyuko_temp_datachar01,
                                                            minyuko_temp2.idoutanabango as minyuko_temp_idoutanabango,
                                                            minyuko_temp2.syouhinid as minyuko_temp_syouhinid,
                                                            minyuko_temp2.syouhinsyu as minyuko_temp_syouhinsyu,
                                                            minyuko_temp2.hantei as minyuko_temp_hantei,
                                                            minyuko_temp2.zaikometer as minyuko_temp_zaikometer,
                                                            minyuko_temp2.syouhizeiritu as minyuko_temp_syouhizeiritu,
                                                            cast (COALESCE(nyukoold_temp2.sum_nyukoold_syouhizeiritu,0)  AS bigint) as sum_nyukoold_syouhizeiritu,
                                                            cast (COALESCE(minyuko_temp2.syouhizeiritu,0) - COALESCE(nyukoold_temp2.sum_nyukoold_syouhizeiritu,0)  AS bigint) as sub_syouhizeiritu,
                                                            cast (COALESCE(nyukoold_temp2.sum_nyukoold_syouhizeiritu,0)  AS bigint) as nyukoold_temp_single_syouhizeiritu,
                                                            nyukoold_temp2.idoutanabango as nyukoold_temp_idoutanabango,
                                                            nyukoold_temp2.syouhinid as nyukoold_temp_syouhinid,
                                                            nyukoold_temp2.syouhinsyu as nyukoold_temp_syouhinsyu,
                                                            nyukoold_temp2.hantei as nyukoold_temp_hantei,
                                                            juchusyukko2.syouhinid as juchusyukko2_syouhinid,
                                                            juchusyukko2.syouhinsyu as juchusyukko2_syouhinsyu,
                                                            juchusyukko2.hantei as juchusyukko2_hantei,
                                                            juchusyukko2.barcode as juchusyukko2_barcode,
                                                            juchusyukko2.codename as juchusyukko2_codename,
                                                            juchusyukko2.orderbango as juchusyukko2_orderbango,
                                                            juchusyukko2.tanka as juchusyukko2_tanka


                                                            from v_orderhenkan
                                                            join v_orderhenkan_temp
                                                            on v_orderhenkan_temp.kokyakuorderbango =  v_orderhenkan.kokyakuorderbango
                                                            and v_orderhenkan_temp.max_v_orderhenkan_ordertypebango2 =  v_orderhenkan.ordertypebango2
                                                            join misyukko_temp
                                                            on misyukko_temp.misyukko_syouhinid = v_orderhenkan.kokyakuorderbango
                                                            join minyuko_temp
                                                            on minyuko_temp.idoutanabango = misyukko_temp.misyukko_syouhinid
                                                            and  minyuko_temp.yoteimeter = misyukko_temp.misyukko_syouhinsyu
                                                            and minyuko_temp.nyukometer = misyukko_temp.misyukko_hantei
                                                            join juchusyukko2
                                                            on  juchusyukko2.syouhinid = minyuko_temp.syouhinid
                                                            and juchusyukko2.syouhinsyu = minyuko_temp.syouhinsyu
                                                            and juchusyukko2.hantei = minyuko_temp.hantei
                                                            join orderhenkan
                                                            ON CASE WHEN length(minyuko_temp.syouhinsyu::text) = 1
                                                                  THEN minyuko_temp.syouhinid || '00' || minyuko_temp.syouhinsyu =  orderhenkan.datatxt0152
                                                                  WHEN length(minyuko_temp.syouhinsyu::text) = 2
                                                                  THEN minyuko_temp.syouhinid || '0' || minyuko_temp.syouhinsyu =  orderhenkan.datatxt0152
                                                                  ElSE minyuko_temp.syouhinid || minyuko_temp.syouhinsyu =  orderhenkan.datatxt0152 END
                                                            join v_orderhenkan_temp2
                                                            on v_orderhenkan_temp2.kokyakuorderbango =  orderhenkan.kokyakuorderbango
                                                            and v_orderhenkan_temp2.max_v_orderhenkan_ordertypebango2 =  orderhenkan.ordertypebango2
                                                            join minyuko_temp as minyuko_temp2
                                                            on minyuko_temp2.syouhinid = orderhenkan.kokyakuorderbango
                                                            left join nyukoold_temp2
                                                            on  nyukoold_temp2.idoutanabango = minyuko_temp2.syouhinid
                                                            and nyukoold_temp2.yoteimeter = minyuko_temp2.syouhinsyu
                                                            and nyukoold_temp2.nyukometer = minyuko_temp2.hantei
                                                            left join tuhanorder_temp
                                                            on tuhanorder_temp.juchubango =  v_orderhenkan.kokyakuorderbango

                                                            $order_no_sales_v160_sql $datatxt0003_sql $datatxt0004_sql $datatxt0005_sql

                                                            order by minyuko_temp2.syouhinid,minyuko_temp2.syouhinsyu");


                //dd($checkSaleV160Existence);


                $checkSaleV150Existence=QueryHelper::fetchResult("select distinct
                                                            v_orderhenkan.kokyakuorderbango as v_orderhenkan_kokyakuorderbango,
                                                            v_orderhenkan.ordertypebango2 as v_orderhenkan_ordertypebango2,
                                                            tuhanorder_temp.information2 as tuhanorder_temp_information2,
                                                            tuhanorder_temp.otodoketime as tuhanorder_temp_otodoketime,
                                                            misyukko_temp.misyukko_syouhinid,
                                                            misyukko_temp.misyukko_syouhinsyu,
                                                            misyukko_temp.misyukko_hantei,
                                                            misyukko_temp.misyukko_syukkasu,
                                                            lower (minyuko_temp.datachar01) as minyuko_temp_datachar01,
                                                            minyuko_temp.idoutanabango as minyuko_temp_idoutanabango,
                                                            minyuko_temp.syouhinid as minyuko_temp_syouhinid,
                                                            minyuko_temp.syouhinsyu as minyuko_temp_syouhinsyu,
                                                            minyuko_temp.hantei as minyuko_temp_hantei,
                                                            minyuko_temp.zaikometer as minyuko_temp_zaikometer,
                                                            misyukko_temp.misyukko_dataint08,
                                                            nyukoold_temp.syouhizeiritu as nyukoold_temp_single_syouhizeiritu,
                                                            nyukoold_temp.idoutanabango as nyukoold_temp_idoutanabango,
                                                            nyukoold_temp.syouhinid as nyukoold_temp_syouhinid,
                                                            nyukoold_temp.syouhinsyu as nyukoold_temp_syouhinsyu,
                                                            nyukoold_temp.hantei as nyukoold_temp_hantei,
                                                            nyukoold_temp.zaikometer as nyukoold_temp_zaikometer,
                                                            juchusyukko.orderbango as juchusyukko_orderbango,
                                                            juchusyukko.syouhinid as juchusyukko_syouhinid,
                                                            juchusyukko.syouhinsyu as juchusyukko_syouhinsyu,
                                                            juchusyukko.hantei as juchusyukko_hantei


                                                            from v_orderhenkan
                                                            join v_orderhenkan_temp
                                                            on v_orderhenkan_temp.kokyakuorderbango =  v_orderhenkan.kokyakuorderbango
                                                            and v_orderhenkan_temp.max_v_orderhenkan_ordertypebango2 =  v_orderhenkan.ordertypebango2
                                                            join misyukko_temp
                                                            on misyukko_temp.misyukko_syouhinid = v_orderhenkan.kokyakuorderbango
                                                            join minyuko_temp
                                                            on minyuko_temp.idoutanabango = misyukko_temp.misyukko_syouhinid
                                                            and  minyuko_temp.yoteimeter = misyukko_temp.misyukko_syouhinsyu
                                                            and minyuko_temp.nyukometer = misyukko_temp.misyukko_hantei
                                                            join juchusyukko
                                                            on  juchusyukko.syouhinid = misyukko_temp.misyukko_syouhinid
                                                            and juchusyukko.syouhinsyu = misyukko_temp.misyukko_syouhinsyu
                                                            and juchusyukko.hantei = misyukko_temp.misyukko_hantei
                                                            join nyukoold_temp
                                                            on  nyukoold_temp.idoutanabango = minyuko_temp.syouhinid
                                                            and nyukoold_temp.yoteimeter = minyuko_temp.syouhinsyu
                                                            and nyukoold_temp.nyukometer = minyuko_temp.hantei
                                                            left join tuhanorder_temp
                                                            on tuhanorder_temp.juchubango =  v_orderhenkan.kokyakuorderbango

                                                            $order_no_sales_v150_sql $datatxt0003_sql $datatxt0004_sql $datatxt0005_sql
                                                            order by minyuko_temp.syouhinid");
                //dd($checkSaleV150Existence);
                $sum_nyukoold_syouhizeiritu=0;

                if (!empty($checkSaleV150Existence)){

                    foreach ($checkSaleV150Existence as $checkSaleV150){
                        if ($checkSaleV150->nyukoold_temp_idoutanabango!=null){
                            $sum_nyukoold_syouhizeiritu=$sum_nyukoold_syouhizeiritu+$checkSaleV150->nyukoold_temp_single_syouhizeiritu;
                        }
                    }
                }

                $checkSaleV150Existence=QueryHelper::fetchResult("select distinct
                                                            v_orderhenkan.kokyakuorderbango as v_orderhenkan_kokyakuorderbango,
                                                            v_orderhenkan.ordertypebango2 as v_orderhenkan_ordertypebango2,
                                                            tuhanorder_temp.information2 as tuhanorder_temp_information2,
                                                            tuhanorder_temp.otodoketime as tuhanorder_temp_otodoketime,
                                                            misyukko_temp.misyukko_syouhinid,
                                                            misyukko_temp.misyukko_syouhinsyu,
                                                            misyukko_temp.misyukko_hantei,
                                                            misyukko_temp.misyukko_syukkasu,
                                                            lower (minyuko_temp.datachar01) as minyuko_temp_datachar01,
                                                            minyuko_temp.idoutanabango as minyuko_temp_idoutanabango,
                                                            minyuko_temp.syouhinid as minyuko_temp_syouhinid,
                                                            minyuko_temp.syouhinsyu as minyuko_temp_syouhinsyu,
                                                            minyuko_temp.hantei as minyuko_temp_hantei,
                                                            minyuko_temp.zaikometer as minyuko_temp_zaikometer,
                                                            misyukko_temp.misyukko_dataint08,
                                                            cast (COALESCE('$sum_nyukoold_syouhizeiritu',0)  AS bigint) as sum_nyukoold_syouhizeiritu,
                                                            cast (COALESCE('$sum_nyukoold_syouhizeiritu',0) - COALESCE(misyukko_dataint08,0)  AS bigint) as sub_syouhizeiritu,
                                                            cast (COALESCE('$sum_nyukoold_syouhizeiritu',0) - (COALESCE(misyukko_dataint08,0) * COALESCE(misyukko_syukkasu,0))  AS bigint) as insert_misyukko_dataint16,
                                                            cast (COALESCE(tuhanorder_temp.money10,0) - ((COALESCE(misyukko_syukkasu,0) * (COALESCE(misyukko_dataint05,0) + COALESCE(misyukko_dataint06,0) + COALESCE(misyukko_dataint07,0) + COALESCE(misyukko_dataint08,0)) - cast (COALESCE('$sum_nyukoold_syouhizeiritu',0) - (COALESCE(misyukko_dataint08,0) * COALESCE(misyukko_syukkasu,0))  AS bigint) ))  AS bigint) as update_tuhanorder_moneymax,
                                                            nyukoold_temp.syouhizeiritu as nyukoold_temp_single_syouhizeiritu,
                                                            nyukoold_temp.idoutanabango as nyukoold_temp_idoutanabango,
                                                            nyukoold_temp.syouhinid as nyukoold_temp_syouhinid,
                                                            nyukoold_temp.syouhinsyu as nyukoold_temp_syouhinsyu,
                                                            nyukoold_temp.hantei as nyukoold_temp_hantei,
                                                            nyukoold_temp.zaikometer as nyukoold_temp_zaikometer,
                                                            juchusyukko.orderbango as juchusyukko_orderbango,
                                                            juchusyukko.syouhinid as juchusyukko_syouhinid,
                                                            juchusyukko.syouhinsyu as juchusyukko_syouhinsyu,
                                                            juchusyukko.hantei as juchusyukko_hantei


                                                            from v_orderhenkan
                                                            join v_orderhenkan_temp
                                                            on v_orderhenkan_temp.kokyakuorderbango =  v_orderhenkan.kokyakuorderbango
                                                            and v_orderhenkan_temp.max_v_orderhenkan_ordertypebango2 =  v_orderhenkan.ordertypebango2
                                                            join misyukko_temp
                                                            on misyukko_temp.misyukko_syouhinid = v_orderhenkan.kokyakuorderbango
                                                            join minyuko_temp
                                                            on minyuko_temp.idoutanabango = misyukko_temp.misyukko_syouhinid
                                                            and  minyuko_temp.yoteimeter = misyukko_temp.misyukko_syouhinsyu
                                                            and minyuko_temp.nyukometer = misyukko_temp.misyukko_hantei
                                                            join juchusyukko
                                                            on  juchusyukko.syouhinid = misyukko_temp.misyukko_syouhinid
                                                            and juchusyukko.syouhinsyu = misyukko_temp.misyukko_syouhinsyu
                                                            and juchusyukko.hantei = misyukko_temp.misyukko_hantei
                                                            join nyukoold_temp
                                                            on  nyukoold_temp.idoutanabango = minyuko_temp.syouhinid
                                                            and nyukoold_temp.yoteimeter = minyuko_temp.syouhinsyu
                                                            and nyukoold_temp.nyukometer = minyuko_temp.hantei
                                                            left join tuhanorder_temp
                                                            on tuhanorder_temp.juchubango =  v_orderhenkan.kokyakuorderbango

                                                            $order_no_sales_v150_sql $datatxt0003_sql $datatxt0004_sql $datatxt0005_sql
                                                            order by minyuko_temp.syouhinid");
                //dd($checkSaleV150Existence);
                $status='ok';
                $msg='hatchu data arimasu';

                //dd($checkSaleV160Existence,$checkSaleV150Existence,$order_no_sales_v150_sql,$datatxt0003_sql, $datatxt0004_sql, $datatxt0005_sql);
            }
            else{
                $status='ng';
                $msg='hatchu data arimasen';
            }
            //dd($status,$msg);
            return response()->json( [$status,$msg] );

        }catch (\Exception $e) {
            $status='ng';
            $msg='something went wrong!!';
            //return response()->json( [$status,$msg] );
            dd($e);
        }
    }

    public static function save(Request $request)
    {
        //dd(Request()->all());
        try {
            $bango=session()->get('userId');

            if (!empty(request('division_datachar05_start'))) {
                $req_division_start = substr(request('division_datachar05_start'), 4, 2);
            } else {
                $req_division_start = null;
            }
            if (!empty(request('division_datachar05_end'))) {
                $req_division_end = substr(request('division_datachar05_end'), 4, 2);
            } else {
                $req_division_end = null;
            }

            if (!empty(request('department_datachar05_start'))) {
                $req_department_start = substr(request('department_datachar05_start'), 4, 3);
            } else {
                $req_department_start = null;
            }
            if (!empty(request('department_datachar05_end'))) {
                $req_department_end = substr(request('department_datachar05_end'), 4, 3);
            } else {
                $req_department_end = null;
            }

            if (!empty(request('group_datachar05_start'))) {
                $req_t_group_start = substr(request('group_datachar05_start'), 4, 4);
            } else {
                $req_t_group_start = null;
            }
            if (!empty(request('group_datachar05_end'))) {
                $req_t_group_end = substr(request('group_datachar05_end'), 4, 4);
            } else {
                $req_t_group_end = null;
            }


            if (!empty(request('purchase_completion_date'))) {
                $purchase_completion_date = str_replace('/','',request('purchase_completion_date'));
            } else {
                $purchase_completion_date = null;
            }

            if (!empty(request('order_no'))) {
                $orderEntry = request('order_no');
            } else {
                $orderEntry = null;
            }

            $datatxt0003_sql = '';
            if ($req_division_start != '' && $req_division_end != '' && ($req_division_start != $req_division_end)) {

                $datatxt0003_sql .= " and substring(v_orderhenkan.datatxt0003::text,1,2)='B9' AND right(v_orderhenkan.datatxt0003::text,2) between '$req_division_start' and  '$req_division_end' ";
            } else {

                $datatxt0003_sql .= " and substring(v_orderhenkan.datatxt0003::text,1,2)='B9' AND right(v_orderhenkan.datatxt0003::text,2) = '$req_division_start'";
            }

            $datatxt0004_sql = '';
            if ($req_department_start != '' && $req_department_end != '' && ($req_department_start != $req_department_end)) {

                $datatxt0004_sql .= "  and substring(v_orderhenkan.datatxt0004::text,1,2)='C1' AND right(v_orderhenkan.datatxt0004::text,3) between '$req_department_start' and '$req_department_end'";
            } else if ($req_department_start != '') {

                $datatxt0004_sql .= "  and substring(v_orderhenkan.datatxt0004::text,1,2)='C1' AND right(v_orderhenkan.datatxt0004::text,3) = '$req_department_start'";
            }
            $datatxt0005_sql = '';
            if ($req_t_group_start != '' && $req_t_group_end != '' && ($req_t_group_start != $req_t_group_end)) {

                $datatxt0005_sql .= "  and substring(v_orderhenkan.datatxt0005::text,1,2)='C2' AND right(v_orderhenkan.datatxt0005::text ,4) between '$req_t_group_start' and '$req_t_group_end'";
            } else if ($req_t_group_start != '') {

                $datatxt0005_sql .= "  and substring(v_orderhenkan.datatxt0005::text,1,2)='C2' AND right(v_orderhenkan.datatxt0005::text ,4) = '$req_t_group_start'";
            }

            $order_no_sql_before='';
            $order_no_sql='';
            $order_no_sales_v160_sql='';
            $order_no_sales_v150_sql='';
            if ($orderEntry==null){
                $order_no_sql .= "  where hikiatesyukko.datachar16 = '2' and hikiatesyukko.datachar17 is not null and hikiatesyukko.datachar18 is not null";
                $order_no_sales_v160_sql .= "  where lower(minyuko_temp.datachar01) = 'v160' and juchusyukko2.barcode is not null and juchusyukko2.codename is not null and juchusyukko2.tanka = '2'";
                $order_no_sales_v150_sql .= "  where lower(minyuko_temp.datachar01) = 'v150'";
            }
            else{
                $order_no_sql_before .= "  where v_orderhenkan.kokyakuorderbango  = '$orderEntry'  and hikiatesyukko.datachar16 = '1'";
                $order_no_sql .= "  where v_orderhenkan.kokyakuorderbango  = '$orderEntry' and hikiatesyukko.datachar16 = '2' and hikiatesyukko.datachar17 is not null and hikiatesyukko.datachar18 is not null";
                $order_no_sales_v160_sql .= "  where v_orderhenkan.kokyakuorderbango  = '$orderEntry' and lower(minyuko_temp.datachar01) = 'v120' and juchusyukko2.barcode is not null and juchusyukko2.codename is not null and juchusyukko2.tanka = '2'";
                $order_no_sales_v150_sql .= "  where v_orderhenkan.kokyakuorderbango  = '$orderEntry' and lower(minyuko_temp.datachar01) = 'v150'";
            }

            QueryHelper::runQuery("DROP TABLE IF EXISTS v_orderhenkan_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE v_orderhenkan_temp AS SELECT DISTINCT kokyakuorderbango, max (ordertypebango2) as max_v_orderhenkan_ordertypebango2 FROM v_orderhenkan WHERE synchroorderbango='0' group by kokyakuorderbango order by kokyakuorderbango");
            QueryHelper::runQuery("DROP TABLE IF EXISTS v_orderhenkan_temp2");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE v_orderhenkan_temp2 AS SELECT DISTINCT kokyakuorderbango, max (ordertypebango2) as max_v_orderhenkan_ordertypebango2 FROM v_orderhenkan where synchroorderbango2='0' group by kokyakuorderbango order by kokyakuorderbango");
            QueryHelper::runQuery("DROP TABLE IF EXISTS tuhanorder_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE tuhanorder_temp AS SELECT DISTINCT tuhanorder.* FROM tuhanorder WHERE tuhanorder.juchukubun2 is null");
            QueryHelper::runQuery("DROP TABLE IF EXISTS misyukko_temp_before");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE misyukko_temp_before AS SELECT
                                               misyukko.syouhinid,
                                               misyukko.syouhinsyu,
                                               misyukko.hantei
                                               FROM misyukko
                                               WHERE yoteimeter='0'
                                               group by misyukko.syouhinid,misyukko.syouhinsyu,misyukko.hantei");
            QueryHelper::runQuery("DROP TABLE IF EXISTS misyukko_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE misyukko_temp AS SELECT
                                               misyukko.syouhinid as misyukko_syouhinid,
                                               misyukko.syouhinsyu as misyukko_syouhinsyu,
                                               misyukko.hantei as misyukko_hantei,
                                               misyukko.syukkasu as misyukko_syukkasu,
                                               misyukko.dataint08 as misyukko_dataint08,
                                               misyukko.dataint07 as misyukko_dataint07,
                                               misyukko.dataint06 as misyukko_dataint06,
                                               misyukko.dataint05 as misyukko_dataint05
                                               from misyukko
                                               left join misyukko_temp_before
                                               on misyukko_temp_before.syouhinid = misyukko.syouhinid
                                               and misyukko_temp_before.syouhinsyu = misyukko.syouhinsyu
                                               and misyukko_temp_before.hantei = misyukko.hantei");
            QueryHelper::runQuery("DROP TABLE IF EXISTS minyuko_max_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE minyuko_max_temp AS SELECT syouhinid,  max (zaikometer) as max_minyuko_zaikometer FROM minyuko group by syouhinid");
            QueryHelper::runQuery("DROP TABLE IF EXISTS minyuko_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE minyuko_temp AS
                                                SELECT DISTINCT
                                                minyuko.*
                                                FROM minyuko
                                                join minyuko_max_temp
                                                on minyuko_max_temp.syouhinid = minyuko.syouhinid
                                                and minyuko_max_temp.max_minyuko_zaikometer = minyuko.zaikometer
                                                --where minyuko.idoutanabango = '0151017198'
                                                order by minyuko.syouhinid");
            QueryHelper::runQuery("DROP TABLE IF EXISTS nyukoold_max_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE nyukoold_max_temp AS
                                                SELECT
                                                syouhinid, max (zaikometer) as max_nyukoold_zaikometer
                                                FROM nyukoold
                                                group by syouhinid
                                                order by syouhinid");
            QueryHelper::runQuery("DROP TABLE IF EXISTS nyukoold_max_temp2");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE nyukoold_max_temp2 AS
                                                SELECT
                                                idoutanabango,
                                                yoteimeter,
                                                max (zaikometer) as max_nyukoold_zaikometer,
                                                sum (syouhizeiritu) as sum_nyukoold_syouhizeiritu
                                                FROM nyukoold
                                                group by idoutanabango,yoteimeter
                                                order by idoutanabango,yoteimeter");
            QueryHelper::runQuery("DROP TABLE IF EXISTS nyukoold_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE nyukoold_temp AS
                                                SELECT DISTINCT
                                                nyukoold.*
                                                FROM nyukoold
                                                join nyukoold_max_temp
                                                on nyukoold_max_temp.syouhinid = nyukoold.syouhinid
                                                and nyukoold_max_temp.max_nyukoold_zaikometer = nyukoold.zaikometer
                                                order by nyukoold.idoutanabango");
            QueryHelper::runQuery("DROP TABLE IF EXISTS nyukoold_temp2");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE nyukoold_temp2 AS
                                                SELECT DISTINCT
                                                nyukoold.*,
                                                nyukoold_max_temp2.sum_nyukoold_syouhizeiritu,
                                                nyukoold_max_temp2.max_nyukoold_zaikometer
                                                FROM nyukoold
                                                join nyukoold_max_temp2
                                                on nyukoold_max_temp2.idoutanabango = nyukoold.idoutanabango
                                                and nyukoold_max_temp2.yoteimeter = nyukoold.yoteimeter
                                                and nyukoold_max_temp2.max_nyukoold_zaikometer = nyukoold.zaikometer
                                                order by nyukoold.idoutanabango");
            //dd(QueryHelper::fetchResult("select * from nyukoold_temp"));

            if ($orderEntry==null){
                $status='ng';
                $msg='1st condition omitted due to no orderNo';
                return response()->json( [$status,$msg] );
            }

            $checkOrderExistenceBefore=QueryHelper::fetchResult("select distinct
                                                            v_orderhenkan.*,
                                                            hikiatesyukko.syouhinid,
                                                            hikiatesyukko.datachar16,
                                                            hikiatesyukko.datachar17,
                                                            hikiatesyukko.datachar18
                                                            from v_orderhenkan
                                                            join v_orderhenkan_temp
                                                            on v_orderhenkan_temp.kokyakuorderbango =  v_orderhenkan.kokyakuorderbango
                                                            and v_orderhenkan_temp.max_v_orderhenkan_ordertypebango2 =  v_orderhenkan.ordertypebango2
                                                            join hikiatesyukko
                                                            on  hikiatesyukko.syouhinid = v_orderhenkan.kokyakuorderbango
                                                            $order_no_sql_before ");


            if (!empty($checkOrderExistenceBefore) && $orderEntry){
                $status='ng1';
                $msg='Purchase completed and calculated';
                return response()->json( [$status,$msg] );
            }

            $checkOrderExistence=QueryHelper::fetchResult("select
                                                            v_orderhenkan.*,
                                                            hikiatesyukko.syouhinid,
                                                            hikiatesyukko.datachar16,
                                                            hikiatesyukko.datachar17,
                                                            hikiatesyukko.datachar18
                                                            from v_orderhenkan
                                                            join v_orderhenkan_temp
                                                            on v_orderhenkan_temp.kokyakuorderbango =  v_orderhenkan.kokyakuorderbango
                                                            and v_orderhenkan_temp.max_v_orderhenkan_ordertypebango2 =  v_orderhenkan.ordertypebango2
                                                            join hikiatesyukko
                                                            on  hikiatesyukko.syouhinid = v_orderhenkan.kokyakuorderbango
                                                            $order_no_sql $datatxt0003_sql $datatxt0004_sql $datatxt0005_sql");

            //dd($checkOrderExistence,$order_no_sql);

            if (count($checkOrderExistence)>0){

                $checkSaleV160Existence=QueryHelper::fetchResult("select distinct on (minyuko_temp2.syouhinid,minyuko_temp2.syouhinsyu)
                                                            v_orderhenkan.kokyakuorderbango as v_orderhenkan_kokyakuorderbango,
                                                            v_orderhenkan.ordertypebango2 as v_orderhenkan_ordertypebango2,
                                                            orderhenkan.kokyakuorderbango as v_orderhenkan_v160_kokyakuorderbango,
                                                            orderhenkan.ordertypebango2 as orderhenkan_ordertypebango2,
                                                            tuhanorder_temp.information2 as tuhanorder_temp_information2,
                                                            tuhanorder_temp.otodoketime as tuhanorder_temp_otodoketime,
                                                            misyukko_temp.misyukko_syouhinid,
                                                            misyukko_temp.misyukko_syouhinsyu,
                                                            misyukko_temp.misyukko_hantei,
                                                            lower (minyuko_temp2.datachar01) as minyuko_temp_datachar01,
                                                            minyuko_temp2.idoutanabango as minyuko_temp_idoutanabango,
                                                            minyuko_temp2.syouhinid as minyuko_temp_syouhinid,
                                                            minyuko_temp2.syouhinsyu as minyuko_temp_syouhinsyu,
                                                            minyuko_temp2.hantei as minyuko_temp_hantei,
                                                            minyuko_temp2.zaikometer as minyuko_temp_zaikometer,
                                                            minyuko_temp2.syouhizeiritu as minyuko_temp_syouhizeiritu,
                                                            cast (COALESCE(nyukoold_temp2.sum_nyukoold_syouhizeiritu,0)  AS bigint) as sum_nyukoold_syouhizeiritu,
                                                            cast (COALESCE(minyuko_temp2.syouhizeiritu,0) - COALESCE(nyukoold_temp2.sum_nyukoold_syouhizeiritu,0)  AS bigint) as sub_syouhizeiritu,
                                                            cast (COALESCE(nyukoold_temp2.sum_nyukoold_syouhizeiritu,0)  AS bigint) as nyukoold_temp_single_syouhizeiritu,
                                                            nyukoold_temp2.idoutanabango as nyukoold_temp_idoutanabango,
                                                            nyukoold_temp2.syouhinid as nyukoold_temp_syouhinid,
                                                            nyukoold_temp2.syouhinsyu as nyukoold_temp_syouhinsyu,
                                                            nyukoold_temp2.hantei as nyukoold_temp_hantei,
                                                            juchusyukko2.syouhinid as juchusyukko2_syouhinid,
                                                            juchusyukko2.syouhinsyu as juchusyukko2_syouhinsyu,
                                                            juchusyukko2.hantei as juchusyukko2_hantei,
                                                            juchusyukko2.barcode as juchusyukko2_barcode,
                                                            juchusyukko2.codename as juchusyukko2_codename,
                                                            juchusyukko2.orderbango as juchusyukko2_orderbango,
                                                            juchusyukko2.tanka as juchusyukko2_tanka


                                                            from v_orderhenkan
                                                            join v_orderhenkan_temp
                                                            on v_orderhenkan_temp.kokyakuorderbango =  v_orderhenkan.kokyakuorderbango
                                                            and v_orderhenkan_temp.max_v_orderhenkan_ordertypebango2 =  v_orderhenkan.ordertypebango2
                                                            join misyukko_temp
                                                            on misyukko_temp.misyukko_syouhinid = v_orderhenkan.kokyakuorderbango
                                                            join minyuko_temp
                                                            on minyuko_temp.idoutanabango = misyukko_temp.misyukko_syouhinid
                                                            and  minyuko_temp.yoteimeter = misyukko_temp.misyukko_syouhinsyu
                                                            and minyuko_temp.nyukometer = misyukko_temp.misyukko_hantei
                                                            join juchusyukko2
                                                            on  juchusyukko2.syouhinid = minyuko_temp.syouhinid
                                                            and juchusyukko2.syouhinsyu = minyuko_temp.syouhinsyu
                                                            and juchusyukko2.hantei = minyuko_temp.hantei
                                                            join orderhenkan
                                                            ON CASE WHEN length(minyuko_temp.syouhinsyu::text) = 1
                                                                  THEN minyuko_temp.syouhinid || '00' || minyuko_temp.syouhinsyu =  orderhenkan.datatxt0152
                                                                  WHEN length(minyuko_temp.syouhinsyu::text) = 2
                                                                  THEN minyuko_temp.syouhinid || '0' || minyuko_temp.syouhinsyu =  orderhenkan.datatxt0152
                                                                  ElSE minyuko_temp.syouhinid || minyuko_temp.syouhinsyu =  orderhenkan.datatxt0152 END
                                                            join v_orderhenkan_temp2
                                                            on v_orderhenkan_temp2.kokyakuorderbango =  orderhenkan.kokyakuorderbango
                                                            and v_orderhenkan_temp2.max_v_orderhenkan_ordertypebango2 =  orderhenkan.ordertypebango2
                                                            join minyuko_temp as minyuko_temp2
                                                            on minyuko_temp2.syouhinid = orderhenkan.kokyakuorderbango
                                                            left join nyukoold_temp2
                                                            on  nyukoold_temp2.idoutanabango = minyuko_temp2.syouhinid
                                                            and nyukoold_temp2.yoteimeter = minyuko_temp2.syouhinsyu
                                                            and nyukoold_temp2.nyukometer = minyuko_temp2.hantei
                                                            left join tuhanorder_temp
                                                            on tuhanorder_temp.juchubango =  v_orderhenkan.kokyakuorderbango

                                                            $order_no_sales_v160_sql $datatxt0003_sql $datatxt0004_sql $datatxt0005_sql

                                                            order by minyuko_temp2.syouhinid,minyuko_temp2.syouhinsyu");

                //dd($checkSaleV160Existence,$order_no_sales_v160_sql,$datatxt0003_sql, $datatxt0004_sql, $datatxt0005_sql);

                $checkSaleV150Existence=QueryHelper::fetchResult("select distinct
                                                            v_orderhenkan.kokyakuorderbango as v_orderhenkan_kokyakuorderbango,
                                                            v_orderhenkan.ordertypebango2 as v_orderhenkan_ordertypebango2,
                                                            tuhanorder_temp.information2 as tuhanorder_temp_information2,
                                                            tuhanorder_temp.otodoketime as tuhanorder_temp_otodoketime,
                                                            misyukko_temp.misyukko_syouhinid,
                                                            misyukko_temp.misyukko_syouhinsyu,
                                                            misyukko_temp.misyukko_hantei,
                                                            misyukko_temp.misyukko_syukkasu,
                                                            lower (minyuko_temp.datachar01) as minyuko_temp_datachar01,
                                                            minyuko_temp.idoutanabango as minyuko_temp_idoutanabango,
                                                            minyuko_temp.syouhinid as minyuko_temp_syouhinid,
                                                            minyuko_temp.syouhinsyu as minyuko_temp_syouhinsyu,
                                                            minyuko_temp.hantei as minyuko_temp_hantei,
                                                            minyuko_temp.zaikometer as minyuko_temp_zaikometer,
                                                            misyukko_temp.misyukko_dataint08,
                                                            nyukoold_temp.syouhizeiritu as nyukoold_temp_single_syouhizeiritu,
                                                            nyukoold_temp.idoutanabango as nyukoold_temp_idoutanabango,
                                                            nyukoold_temp.syouhinid as nyukoold_temp_syouhinid,
                                                            nyukoold_temp.syouhinsyu as nyukoold_temp_syouhinsyu,
                                                            nyukoold_temp.hantei as nyukoold_temp_hantei,
                                                            juchusyukko.orderbango as juchusyukko_orderbango,
                                                            juchusyukko.syouhinid as juchusyukko_syouhinid,
                                                            juchusyukko.syouhinsyu as juchusyukko_syouhinsyu,
                                                            juchusyukko.hantei as juchusyukko_hantei


                                                            from v_orderhenkan
                                                            join v_orderhenkan_temp
                                                            on v_orderhenkan_temp.kokyakuorderbango =  v_orderhenkan.kokyakuorderbango
                                                            and v_orderhenkan_temp.max_v_orderhenkan_ordertypebango2 =  v_orderhenkan.ordertypebango2
                                                            join misyukko_temp
                                                            on misyukko_temp.misyukko_syouhinid = v_orderhenkan.kokyakuorderbango
                                                            join minyuko_temp
                                                            on minyuko_temp.idoutanabango = misyukko_temp.misyukko_syouhinid
                                                            and  minyuko_temp.yoteimeter = misyukko_temp.misyukko_syouhinsyu
                                                            and minyuko_temp.nyukometer = misyukko_temp.misyukko_hantei
                                                            join juchusyukko
                                                            on  juchusyukko.syouhinid = misyukko_temp.misyukko_syouhinid
                                                            and juchusyukko.syouhinsyu = misyukko_temp.misyukko_syouhinsyu
                                                            and juchusyukko.hantei = misyukko_temp.misyukko_hantei
                                                            join nyukoold_temp
                                                            on  nyukoold_temp.idoutanabango = minyuko_temp.syouhinid
                                                            and nyukoold_temp.yoteimeter = minyuko_temp.syouhinsyu
                                                            and nyukoold_temp.nyukometer = minyuko_temp.hantei
                                                            left join tuhanorder_temp
                                                            on tuhanorder_temp.juchubango =  v_orderhenkan.kokyakuorderbango
                                                            $order_no_sales_v150_sql $datatxt0003_sql $datatxt0004_sql $datatxt0005_sql
                                                            order by minyuko_temp.syouhinid");


                $sum_nyukoold_syouhizeiritu=0;

                if (!empty($checkSaleV150Existence)){

                    foreach ($checkSaleV150Existence as $checkSaleV150){
                        if ($checkSaleV150->nyukoold_temp_idoutanabango!=null){
                            $sum_nyukoold_syouhizeiritu=$sum_nyukoold_syouhizeiritu+$checkSaleV150->nyukoold_temp_single_syouhizeiritu;
                        }
                    }
                }

                $checkSaleV150Existence=QueryHelper::fetchResult("select distinct
                                                            v_orderhenkan.kokyakuorderbango as v_orderhenkan_kokyakuorderbango,
                                                            v_orderhenkan.ordertypebango2 as v_orderhenkan_ordertypebango2,
                                                            tuhanorder_temp.information2 as tuhanorder_temp_information2,
                                                            tuhanorder_temp.otodoketime as tuhanorder_temp_otodoketime,
                                                            misyukko_temp.misyukko_syouhinid,
                                                            misyukko_temp.misyukko_syouhinsyu,
                                                            misyukko_temp.misyukko_hantei,
                                                            misyukko_temp.misyukko_syukkasu,
                                                            lower (minyuko_temp.datachar01) as minyuko_temp_datachar01,
                                                            minyuko_temp.idoutanabango as minyuko_temp_idoutanabango,
                                                            minyuko_temp.syouhinid as minyuko_temp_syouhinid,
                                                            minyuko_temp.syouhinsyu as minyuko_temp_syouhinsyu,
                                                            minyuko_temp.hantei as minyuko_temp_hantei,
                                                            minyuko_temp.zaikometer as minyuko_temp_zaikometer,
                                                            misyukko_temp.misyukko_dataint08,
                                                            cast (COALESCE('$sum_nyukoold_syouhizeiritu',0)AS bigint) as sum_nyukoold_syouhizeiritu,
                                                            cast (COALESCE('$sum_nyukoold_syouhizeiritu',0) - COALESCE(misyukko_dataint08,0)  AS bigint) as sub_syouhizeiritu,
                                                            cast (COALESCE('$sum_nyukoold_syouhizeiritu',0) - (COALESCE(misyukko_dataint08,0) * COALESCE(misyukko_syukkasu,0))  AS bigint) as insert_misyukko_dataint16,
                                                            cast (COALESCE(tuhanorder_temp.money10,0) - ((COALESCE(misyukko_syukkasu,0) * (COALESCE(misyukko_dataint05,0) + COALESCE(misyukko_dataint06,0) + COALESCE(misyukko_dataint07,0) + COALESCE(misyukko_dataint08,0)) - cast (COALESCE('$sum_nyukoold_syouhizeiritu',0) - (COALESCE(misyukko_dataint08,0) * COALESCE(misyukko_syukkasu,0))  AS bigint) ))  AS bigint) as update_tuhanorder_moneymax,
                                                            nyukoold_temp.syouhizeiritu as nyukoold_temp_single_syouhizeiritu,
                                                            nyukoold_temp.idoutanabango as nyukoold_temp_idoutanabango,
                                                            nyukoold_temp.syouhinid as nyukoold_temp_syouhinid,
                                                            nyukoold_temp.syouhinsyu as nyukoold_temp_syouhinsyu,
                                                            nyukoold_temp.hantei as nyukoold_temp_hantei,
                                                            juchusyukko.orderbango as juchusyukko_orderbango,
                                                            juchusyukko.syouhinid as juchusyukko_syouhinid,
                                                            juchusyukko.syouhinsyu as juchusyukko_syouhinsyu,
                                                            juchusyukko.hantei as juchusyukko_hantei


                                                            from v_orderhenkan
                                                            join v_orderhenkan_temp
                                                            on v_orderhenkan_temp.kokyakuorderbango =  v_orderhenkan.kokyakuorderbango
                                                            and v_orderhenkan_temp.max_v_orderhenkan_ordertypebango2 =  v_orderhenkan.ordertypebango2
                                                            join misyukko_temp
                                                            on misyukko_temp.misyukko_syouhinid = v_orderhenkan.kokyakuorderbango
                                                            join minyuko_temp
                                                            on minyuko_temp.idoutanabango = misyukko_temp.misyukko_syouhinid
                                                            and  minyuko_temp.yoteimeter = misyukko_temp.misyukko_syouhinsyu
                                                            and minyuko_temp.nyukometer = misyukko_temp.misyukko_hantei
                                                            join juchusyukko
                                                            on  juchusyukko.syouhinid = misyukko_temp.misyukko_syouhinid
                                                            and juchusyukko.syouhinsyu = misyukko_temp.misyukko_syouhinsyu
                                                            and juchusyukko.hantei = misyukko_temp.misyukko_hantei
                                                            join nyukoold_temp
                                                            on  nyukoold_temp.idoutanabango = minyuko_temp.syouhinid
                                                            and nyukoold_temp.yoteimeter = minyuko_temp.syouhinsyu
                                                            and nyukoold_temp.nyukometer = minyuko_temp.hantei
                                                            left join tuhanorder_temp
                                                            on tuhanorder_temp.juchubango =  v_orderhenkan.kokyakuorderbango
                                                            $order_no_sales_v150_sql $datatxt0003_sql $datatxt0004_sql $datatxt0005_sql
                                                            order by minyuko_temp.syouhinid");

                //dd($checkSaleV160Existence,$order_no_sales_v160_sql,$checkSaleV150Existence,$order_no_sales_v150_sql);
                $v160QcCheck=[];
                $v150QcCheck=[];

                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### purchaseEndCalculation start\n";
                QueryHandler::logger($bango, $log_data);
                $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
                pg_query($conn, 'BEGIN');

                try {

                    /*------------------executing v160-----------------*/
                    if (count($checkSaleV160Existence)>0){

                        $minyuko_inserted_row_arr=[];
                        $minyuko_updated_row_arr=[];
                        $juchusyukko2_inserted_row_arr=[];
                        $juchusyukko2_updated_row_arr=[];
                        $juchusyukko2_updated_row_arr_difference0=[];
                        $orderHenkan_inserted_row_arr=[];
                        $hikiatenyuko_updated_row_arr=[];
                        $tax_rate_arr=[];
                        $orderhenkanKokyakuorderbangoArr=[];
                        $orderHenkan=null;

                        /*------------------for testing tax-rate(minyuko.soukobango)-----------------*/
                        /*foreach ($checkSaleV160Existence as $key=>$value){
                            $tax_rate_for_update_data = (int)self::calculateTaxRate($value->tuhanorder_temp_information2,$value->sum_nyukoold_syouhizeiritu,$value->tuhanorder_temp_otodoketime,$value->v_orderhenkan_kokyakuorderbango,$bango);
                            $tax_rate_for_insert_data = (int)self::calculateTaxRate($value->tuhanorder_temp_information2,$value->sub_syouhizeiritu,$value->tuhanorder_temp_otodoketime,$value->v_orderhenkan_kokyakuorderbango,$bango);
                            $tax_rate_arr1=[$tax_rate_for_update_data,$tax_rate_for_insert_data];
                            array_push($tax_rate_arr,$tax_rate_arr1);
                        }
                        dd($checkSaleV160Existence,$tax_rate_arr,$order_no_sales_v160_sql,$datatxt0003_sql, $datatxt0004_sql, $datatxt0005_sql);*/

                        foreach ($checkSaleV160Existence as $key=>$value){

                            if ($value->sub_syouhizeiritu==0){

                                /*------------------update juchusyukko2 for difference 0-----------------*/
                                $juchusyukko2_update=[
                                    'orderbango' =>  $value->juchusyukko2_orderbango,
                                    'syouhinid'=> $value->juchusyukko2_syouhinid,
                                    'syouhinsyu'=> $value->juchusyukko2_syouhinsyu,
                                    'hantei'=> $value->juchusyukko2_hantei,
                                    'tanka'=> 1,
                                    'denpyoshimebi'=>date('Y-m-d H:i:s'),
                                    'tantousyabango'=>$bango
                                ];
                                QueryHelper::updateData('juchusyukko2', $juchusyukko2_update, ['orderbango' =>  $value->juchusyukko2_orderbango,'syouhinid' => $value->juchusyukko2_syouhinid, 'syouhinsyu' => $value->juchusyukko2_syouhinsyu, 'hantei' => $value->juchusyukko2_hantei, 'tanka' => $value->juchusyukko2_tanka ], $bango, __CLASS__, __FUNCTION__, __LINE__);

                                $check_properties=[
                                    'syouhinid'=> $value->juchusyukko2_syouhinid,
                                    'syouhinsyu'=> $value->juchusyukko2_syouhinsyu,
                                    'hantei'=> $value->juchusyukko2_hantei,
                                    'tantousyabango'=> $bango
                                ];
                                array_push($juchusyukko2_updated_row_arr_difference0,$check_properties);

                            }
                            else{
                                /*------------------update juchusyukko2 for difference something but not 0-----------------*/

                                /*------------------copy data-----------------*/
                                $minyuko_copy_data_sql="  where minyuko.idoutanabango  = '$value->minyuko_temp_idoutanabango' and minyuko.syouhinid  = '$value->minyuko_temp_syouhinid' and minyuko.syouhinsyu  = '$value->minyuko_temp_syouhinsyu' and minyuko.hantei  = '$value->minyuko_temp_hantei' and minyuko.zaikometer  = '$value->minyuko_temp_zaikometer'";
                                $minyuko_copy_data=QueryHelper::fetchSingleResult("select * from minyuko  $minyuko_copy_data_sql");

                                $juchusyukko2_copy_data_sql="  where juchusyukko2.syouhinid  = '$value->juchusyukko2_syouhinid' and juchusyukko2.syouhinsyu  = '$value->juchusyukko2_syouhinsyu' and juchusyukko2.hantei  = '$value->juchusyukko2_hantei' and juchusyukko2.tanka  = '$value->juchusyukko2_tanka' and juchusyukko2.barcode  = '$value->juchusyukko2_barcode' and juchusyukko2.codename  = '$value->juchusyukko2_codename'";
                                $juchusyukko2_copy_data=QueryHelper::fetchSingleResult("select * from juchusyukko2  $juchusyukko2_copy_data_sql");

                                $minyuko_syouhinid=$value->minyuko_temp_syouhinid;
                                QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_temp");
                                QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_temp AS SELECT DISTINCT kokyakuorderbango, max (ordertypebango2) as max_orderhenkan_ordertypebango2 FROM orderhenkan group by kokyakuorderbango order by kokyakuorderbango");
                                $orderhenkan_copy_data_sql="  where orderhenkan.kokyakuorderbango  = '$minyuko_syouhinid' ";
                                $orderhenkan_copy_data=QueryHelper::fetchSingleResult("select * from orderhenkan  join orderhenkan_temp on orderhenkan_temp.kokyakuorderbango = orderhenkan.kokyakuorderbango and orderhenkan_temp.max_orderhenkan_ordertypebango2 = orderhenkan.ordertypebango2 $orderhenkan_copy_data_sql");

                                $hikiatenyuko_copy_data_sql="  where hikiatenyuko.syouhinid  = '$value->minyuko_temp_syouhinid'";
                                $hikiatenyuko_copy_data=QueryHelper::fetchSingleResult("select * from hikiatenyuko  $hikiatenyuko_copy_data_sql");

//                                dd($checkSaleV160Existence,$minyuko_copy_data,$juchusyukko2_copy_data);
                                /*------------------tax-rate calculation-----------------*/
                                $tax_rate_for_update_data = (int)self::calculateTaxRate($value->tuhanorder_temp_information2,$value->sum_nyukoold_syouhizeiritu,$value->tuhanorder_temp_otodoketime,$value->v_orderhenkan_kokyakuorderbango,$bango);
                                $tax_rate_for_insert_data = (int)self::calculateTaxRate($value->tuhanorder_temp_information2,$value->sub_syouhizeiritu,$value->tuhanorder_temp_otodoketime,$value->v_orderhenkan_kokyakuorderbango,$bango);
                                $tax_rate_arr1=[$tax_rate_for_update_data,$tax_rate_for_insert_data];
                                array_push($tax_rate_arr,$tax_rate_arr1);

                                /*------------------This minyuko_insert_data stands for both insert and update start-----------------*/
                                $minyuko_insert_data = [
                                    'orderbango' => $minyuko_copy_data->orderbango,
                                    'syouhinbango' => $minyuko_copy_data->syouhinbango,
                                    'yoteisu' => $minyuko_copy_data->yoteisu,
                                    'yoteibi' => $minyuko_copy_data->yoteibi,
                                    'nyukosu' => $minyuko_copy_data->nyukosu,
                                    'kanryoubi' => $minyuko_copy_data->kanryoubi,
                                    'kingaku' => $minyuko_copy_data->kingaku,
                                    'genka' => $minyuko_copy_data->genka,
                                    'syouhizeiritu' => $value->sum_nyukoold_syouhizeiritu,
                                    'soukobango' => $tax_rate_for_update_data,

                                    'tanabango' => $minyuko_copy_data->tanabango,
                                    'tantousyabango' => $bango,
                                    'denpyobango' => 0,
                                    'denpyohakkoubi' => $minyuko_copy_data->denpyohakkoubi,
                                    'season' => $minyuko_copy_data->season,
                                    'nengetsu' => $purchase_completion_date,
                                    'weeks' => $minyuko_copy_data->weeks,
                                    'day' => $minyuko_copy_data->day,
                                    'tanka' => $minyuko_copy_data->tanka,
                                    'zaiko' => $minyuko_copy_data->zaiko,

                                    'idoutanabango' => $minyuko_copy_data->idoutanabango,
                                    'yoteimeter' => $minyuko_copy_data->yoteimeter,
                                    'nyukometer' => $minyuko_copy_data->nyukometer,
                                    'zaikometer' => $minyuko_copy_data->zaikometer+1,
                                    'barcode' => $minyuko_copy_data->barcode,
                                    'codename' => $minyuko_copy_data->codename,
                                    'denpyoshimebi' => date('Y-m-d H:i:s'),
                                    'kawaserate' => $minyuko_copy_data->kawaserate,
                                    'kawasename' => $minyuko_copy_data->kawasename,
                                    'syouhizeikubun' => $minyuko_copy_data->syouhizeikubun,

                                    'syouhinname' => $minyuko_copy_data->syouhinname,
                                    'yoyakubi' => $minyuko_copy_data->yoyakubi,
                                    'kaiinid' => $minyuko_copy_data->kaiinid,
                                    'syouhinid' => $minyuko_copy_data->syouhinid,
                                    'syouhinsyu' => $minyuko_copy_data->syouhinsyu,
                                    'hantei' => $minyuko_copy_data->hantei,
                                    'recordnumber' => $minyuko_copy_data->recordnumber,

                                    'dataint01' => $minyuko_copy_data->dataint01,
                                    'dataint02' => $minyuko_copy_data->dataint02,
                                    'dataint03' => $minyuko_copy_data->dataint03,
                                    'dataint04' => $minyuko_copy_data->dataint04,
                                    'dataint05' => $minyuko_copy_data->dataint05,
                                    'dataint06' => $minyuko_copy_data->dataint06,
                                    'dataint07' => $minyuko_copy_data->dataint07,
                                    'dataint08' => $minyuko_copy_data->dataint08,
                                    'dataint09' => $minyuko_copy_data->dataint09,
                                    'dataint10' => $minyuko_copy_data->dataint10,

                                    'datachar01' => $minyuko_copy_data->datachar01,
                                    'datachar02' => $minyuko_copy_data->datachar02,
                                    'datachar03' => $minyuko_copy_data->datachar03,
                                    'datachar04' => $minyuko_copy_data->datachar04,
                                    'datachar05' => $minyuko_copy_data->datachar05,
                                    'datachar06' => $minyuko_copy_data->datachar06,
                                    'datachar07' => $minyuko_copy_data->datachar07,
                                    'datachar08' => $minyuko_copy_data->datachar08,
                                    'datachar09' => $minyuko_copy_data->datachar09,
                                    'datachar10' => $minyuko_copy_data->datachar10,

                                    'tankano' => $minyuko_copy_data->tankano,
                                    'syouhinbukacd' => $minyuko_copy_data->syouhinbukacd,
                                    'hanbaibukacd' => $minyuko_copy_data->hanbaibukacd,
                                    'dataint11' => $minyuko_copy_data->dataint11,
                                    'dataint12' => $minyuko_copy_data->dataint12,
                                    'dataint13' => $minyuko_copy_data->dataint13,
                                    'dataint14' => $minyuko_copy_data->dataint14,
                                    'dataint15' => $minyuko_copy_data->dataint15,

                                    'datachar11' => $minyuko_copy_data->datachar11,
                                    'datachar12' => $minyuko_copy_data->datachar12,
                                    'datachar13' => $minyuko_copy_data->datachar13,
                                    'datachar14' => $minyuko_copy_data->datachar14,
                                    'datachar15' => $minyuko_copy_data->datachar15,

                                    'dataint16' => $minyuko_copy_data->dataint16,
                                    'dataint17' => $minyuko_copy_data->dataint17,
                                    'dataint18' => $minyuko_copy_data->dataint18,
                                    'dataint19' => $minyuko_copy_data->dataint19,
                                    'dataint20' => $minyuko_copy_data->dataint20,

                                    'datachar16' => $minyuko_copy_data->datachar16,
                                    'datachar17' => $minyuko_copy_data->datachar17,
                                    'datachar18' => $minyuko_copy_data->datachar18,
                                    'datachar19' => $minyuko_copy_data->datachar19,
                                    'datachar20' => $minyuko_copy_data->datachar20,

                                    'dataint21' => $minyuko_copy_data->dataint21,
                                    'dataint22' => $minyuko_copy_data->dataint22,
                                    'dataint23' => $minyuko_copy_data->dataint23,
                                    'dataint24' => $minyuko_copy_data->dataint24,
                                    'dataint25' => $minyuko_copy_data->dataint25,
                                    'dataint26' => $minyuko_copy_data->dataint26,
                                    'dataint27' => $minyuko_copy_data->dataint27,
                                    'dataint28' => $minyuko_copy_data->dataint28,
                                    'dataint29' => $minyuko_copy_data->dataint29,
                                    'dataint30' => $minyuko_copy_data->dataint30,

                                    'datachar21' => $minyuko_copy_data->datachar21,
                                    'datachar22' => $minyuko_copy_data->datachar22,
                                    'datachar23' => $minyuko_copy_data->datachar23,
                                    'datachar24' => $minyuko_copy_data->datachar24,
                                    'datachar25' => $minyuko_copy_data->datachar25,
                                    'datachar26' => $minyuko_copy_data->datachar26,
                                    'datachar27' => $minyuko_copy_data->datachar27,
                                    'datachar28' => $minyuko_copy_data->datachar28,
                                    'datachar29' => $minyuko_copy_data->datachar29,
                                    'datachar30' => $minyuko_copy_data->datachar30,

                                ];
                                $minyuko = QueryHelper::insertData('minyuko', $minyuko_insert_data, 'orderbango', true, $bango, __CLASS__, __FUNCTION__, __LINE__);

                                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### PurchaseEndCalculation minyukoInsert end\n";
                                QueryHandler::logger($bango, $log_data);
                                pg_query($conn, 'COMMIT');

                                array_push($minyuko_updated_row_arr,$minyuko_insert_data);

                                /*------------------This minyuko_insert_data stands for insert-----------------*/

                                $syouhin_val=QueryHelper::fetchSingleResult("select syouhin1.*,syouhin2.konpoumei as syouhin2_konpoumei  from syouhin1  join syouhin2 on syouhin2.bango=syouhin1.bango where kokyakusyouhinbango = '01306'");

                                if (strlen(strval($value->minyuko_temp_syouhinsyu))==1){
                                    $minyuko_datachar16_val=$value->minyuko_temp_syouhinid.'00'.$value->minyuko_temp_syouhinsyu.$value->minyuko_temp_hantei;
                                }elseif (strlen(strval($value->minyuko_temp_syouhinsyu))==2){
                                    $minyuko_datachar16_val=$value->minyuko_temp_syouhinid.'0'.$value->minyuko_temp_syouhinsyu.$value->minyuko_temp_hantei;
                                }else{
                                    $minyuko_datachar16_val=$value->minyuko_temp_syouhinid.$value->minyuko_temp_syouhinsyu.$value->minyuko_temp_hantei;
                                }

                                $minyuko_insert_data = [
                                    'orderbango' => $minyuko_copy_data->orderbango,
                                    'syouhinbango' => $minyuko_copy_data->syouhinbango,
                                    'yoteisu' => $minyuko_copy_data->yoteisu,
                                    'yoteibi' => $minyuko_copy_data->yoteibi,
                                    'nyukosu' => 1,
                                    'kanryoubi' => $minyuko_copy_data->kanryoubi,
                                    'kingaku' => 0,
                                    'genka' => $value->sub_syouhizeiritu,
                                    'syouhizeiritu' => $value->sub_syouhizeiritu,
                                    'soukobango' => $tax_rate_for_insert_data,

                                    'tanabango' => $minyuko_copy_data->tanabango,
                                    'tantousyabango' => $bango,
                                    'denpyobango' => 0,
                                    'denpyohakkoubi' => $minyuko_copy_data->denpyohakkoubi,
                                    'season' => $minyuko_copy_data->season,
                                    'nengetsu' => $purchase_completion_date,
                                    'weeks' => $minyuko_copy_data->weeks,
                                    'day' => $minyuko_copy_data->day,
                                    'tanka' => $minyuko_copy_data->tanka,
                                    'zaiko' => $minyuko_copy_data->zaiko,

                                    'idoutanabango' => $minyuko_copy_data->idoutanabango,
                                    'yoteimeter' => $minyuko_copy_data->yoteimeter,
                                    'nyukometer' => $minyuko_copy_data->nyukometer,
                                    'zaikometer' => $minyuko_copy_data->zaikometer+1,
                                    'barcode' => $minyuko_copy_data->barcode,
                                    'codename' => $minyuko_copy_data->codename,
                                    'denpyoshimebi' => date('Y-m-d H:i:s'),
                                    'kawaserate' => $minyuko_copy_data->kawaserate,
                                    'kawasename' => $minyuko_copy_data->kawasename,
                                    'syouhizeikubun' => $minyuko_copy_data->syouhizeikubun,

                                    'syouhinname' => $minyuko_copy_data->syouhinname,
                                    'yoyakubi' => $minyuko_copy_data->yoyakubi,
                                    'kaiinid' => $minyuko_copy_data->kaiinid,
                                    'syouhinid' => $minyuko_copy_data->syouhinid,
                                    'syouhinsyu' => (int)$value->minyuko_temp_syouhinsyu+1,
                                    'hantei' => $minyuko_copy_data->hantei,
                                    'recordnumber' => $minyuko_copy_data->recordnumber,

                                    'dataint01' => $minyuko_copy_data->dataint01,
                                    'dataint02' => $minyuko_copy_data->dataint02,
                                    'dataint03' => $minyuko_copy_data->dataint03,
                                    'dataint04' => $minyuko_copy_data->dataint04,
                                    'dataint05' => $minyuko_copy_data->dataint05,
                                    'dataint06' => $minyuko_copy_data->dataint06,
                                    'dataint07' => $minyuko_copy_data->dataint07,
                                    'dataint08' => $minyuko_copy_data->dataint08,
                                    'dataint09' => $minyuko_copy_data->dataint09,
                                    'dataint10' => $minyuko_copy_data->dataint10,

                                    'datachar01' => 'V120',
                                    'datachar02' => '01306',
                                    'datachar03' => $syouhin_val->jouhou,
                                    'datachar04' => $minyuko_copy_data->datachar04,
                                    'datachar05' => $minyuko_copy_data->datachar05,
                                    'datachar06' => $syouhin_val->syouhin2_konpoumei,
                                    'datachar07' => $syouhin_val->kongouritsu,
                                    'datachar08' => $syouhin_val->mdjouhou,
                                    'datachar09' => $minyuko_copy_data->datachar09,
                                    'datachar10' => $minyuko_copy_data->datachar10,

                                    'tankano' => $minyuko_copy_data->tankano,
                                    'syouhinbukacd' => $minyuko_copy_data->syouhinbukacd,
                                    'hanbaibukacd' => $minyuko_copy_data->hanbaibukacd,
                                    'dataint11' => $minyuko_copy_data->dataint11,
                                    'dataint12' => $minyuko_copy_data->dataint12,
                                    'dataint13' => $minyuko_copy_data->dataint13,
                                    'dataint14' => $minyuko_copy_data->dataint14,
                                    'dataint15' => $minyuko_copy_data->dataint15,

                                    'datachar11' => $minyuko_copy_data->datachar11,
                                    'datachar12' => $minyuko_copy_data->datachar12,
                                    'datachar13' => $minyuko_copy_data->datachar13,
                                    'datachar14' => $minyuko_copy_data->datachar14,
                                    'datachar15' => $minyuko_copy_data->datachar15,

                                    'dataint16' => $minyuko_copy_data->dataint16,
                                    'dataint17' => $minyuko_copy_data->dataint17,
                                    'dataint18' => $minyuko_copy_data->dataint18,
                                    'dataint19' => $minyuko_copy_data->dataint19,
                                    'dataint20' => $syouhin_val->data23,

                                    'datachar16' => $minyuko_datachar16_val,
                                    'datachar17' => $minyuko_copy_data->datachar17,
                                    'datachar18' => $minyuko_copy_data->datachar18,
                                    'datachar19' => $minyuko_copy_data->datachar19,
                                    'datachar20' => $minyuko_copy_data->datachar20,

                                    'dataint21' => $minyuko_copy_data->dataint21,
                                    'dataint22' => $minyuko_copy_data->dataint22,
                                    'dataint23' => $minyuko_copy_data->dataint23,
                                    'dataint24' => $minyuko_copy_data->dataint24,
                                    'dataint25' => $minyuko_copy_data->dataint25,
                                    'dataint26' => $minyuko_copy_data->dataint26,
                                    'dataint27' => $minyuko_copy_data->dataint27,
                                    'dataint28' => $minyuko_copy_data->dataint28,
                                    'dataint29' => $minyuko_copy_data->dataint29,
                                    'dataint30' => $minyuko_copy_data->dataint30,

                                    'datachar21' => $minyuko_copy_data->datachar21,
                                    'datachar22' => $minyuko_copy_data->datachar22,
                                    'datachar23' => $minyuko_copy_data->datachar23,
                                    'datachar24' => $minyuko_copy_data->datachar24,
                                    'datachar25' => $minyuko_copy_data->datachar25,
                                    'datachar26' => $minyuko_copy_data->datachar26,
                                    'datachar27' => $minyuko_copy_data->datachar27,
                                    'datachar28' => $minyuko_copy_data->datachar28,
                                    'datachar29' => $minyuko_copy_data->datachar29,
                                    'datachar30' => $minyuko_copy_data->datachar30,

                                ];
                                $minyuko = QueryHelper::insertData('minyuko', $minyuko_insert_data, 'orderbango', true, $bango, __CLASS__, __FUNCTION__, __LINE__);

                                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### PurchaseEndCalculation minyukoInsert end\n";
                                QueryHandler::logger($bango, $log_data);
                                pg_query($conn, 'COMMIT');

                                array_push($minyuko_inserted_row_arr,$minyuko_insert_data);

                                /*------------------insert orderhenkan-----------------*/
                                if (!in_array($value->v_orderhenkan_kokyakuorderbango,$orderhenkanKokyakuorderbangoArr)) {
                                    array_push($orderhenkanKokyakuorderbangoArr,$value->v_orderhenkan_kokyakuorderbango);
                                    $orderHenkan_insert_data=[
                                        'kokyakuorderbango' => $orderhenkan_copy_data->kokyakuorderbango,
                                        'ordertypebango2' => $orderhenkan_copy_data->ordertypebango2+1,
                                        'orderuserbango' => $orderhenkan_copy_data->orderuserbango,
                                        'datachar01' => $orderhenkan_copy_data->datachar01,
                                        'datachar02' => $orderhenkan_copy_data->datachar02,
                                        'intorder04' => $orderhenkan_copy_data->intorder04,
                                        'datachar08' => $orderhenkan_copy_data->datachar08,
                                        'date' => $orderhenkan_copy_data->date,
                                        'datachar09' => $orderhenkan_copy_data->datachar09,
                                        'datachar10' => $orderhenkan_copy_data->datachar10,
                                        'datachar11' => $orderhenkan_copy_data->datachar11,
                                        'intorder01' => $orderhenkan_copy_data->intorder01,
                                        'intorder02' => $orderhenkan_copy_data->intorder02,

                                        'datachar04' => $orderhenkan_copy_data->datachar04,
                                        'datachar05' => $orderhenkan_copy_data->datachar05,
                                        'datachar06' => $orderhenkan_copy_data->datachar06,
                                        'datachar07' => $orderhenkan_copy_data->datachar07,
                                        'datatxt0147' => $orderhenkan_copy_data->datatxt0147,
                                        'deletedate' => $orderhenkan_copy_data->deletedate,
                                        'date0012' => $orderhenkan_copy_data->date0012,
                                        'datachar12' => $orderhenkan_copy_data->datachar12,
                                        'datachar13' => $orderhenkan_copy_data->datachar13,
                                        'datachar14' => $orderhenkan_copy_data->datachar14,
                                        'datachar15' => $orderhenkan_copy_data->datachar15,

                                        'date0013' => $orderhenkan_copy_data->date0013,
                                        'date0014' => $orderhenkan_copy_data->date0014,
                                        'date0015' => $orderhenkan_copy_data->date0015,
                                        'datatxt0148' => $orderhenkan_copy_data->datatxt0148,
                                        'datatxt0149' => $orderhenkan_copy_data->datatxt0149,
                                        'datatxt0150' => $orderhenkan_copy_data->datatxt0150,
                                        'datatxt0151' => $orderhenkan_copy_data->datatxt0151,
                                        'intorder03' => 2,
                                        'datatxt0152' => $orderhenkan_copy_data->datatxt0152,
                                        'synchroorderbango' => $orderhenkan_copy_data->synchroorderbango,
                                        'date0018' => $orderhenkan_copy_data->date0018,

                                        'date0019' => $orderhenkan_copy_data->date0019,
                                        'datatxt0153' => $orderhenkan_copy_data->datatxt0153,
                                        'datatxt0154' => $orderhenkan_copy_data->datatxt0154,
                                        'synchroorderbango2' => $orderhenkan_copy_data->synchroorderbango2,
                                        'date0016' => $orderhenkan_copy_data->date0016,
                                        'date0017' => date('Y-m-d H:i:s'),
                                        'datatxt0155' => $bango,
                                        'datatxt0156' => $orderhenkan_copy_data->datatxt0156,
                                        'datatxt0157' => $orderhenkan_copy_data->datatxt0157,
                                        'date0020' => $orderhenkan_copy_data->date0020,
                                        'datatxt0158' => $orderhenkan_copy_data->datatxt0158
                                    ];
                                    $orderHenkan = QueryHelper::insertData('orderhenkan', $orderHenkan_insert_data, 'bango', true, $bango, __CLASS__, __FUNCTION__, __LINE__);

                                    $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### PurchaseEndCalculation orderhenkanInsert end\n";
                                    QueryHandler::logger($bango, $log_data);
                                    pg_query($conn, 'COMMIT');

                                    array_push($orderHenkan_inserted_row_arr,$orderHenkan_insert_data);

                                    /*------------------insert hikiatenyuko-----------------*/
                                    $hikiatenyuko_update_data=[
                                        'orderbango' => $hikiatenyuko_copy_data->orderbango,
                                        'syouhinid' => $hikiatenyuko_copy_data->syouhinid,
                                        'syouhinsyu' => $hikiatenyuko_copy_data->syouhinsyu,
                                        'hantei' => $hikiatenyuko_copy_data->hantei,
                                        'dataint01' => $hikiatenyuko_copy_data->dataint01,
                                        'dataint02' => $hikiatenyuko_copy_data->dataint02,
                                        'dataint03' => $hikiatenyuko_copy_data->dataint03,
                                        'dataint04' => $hikiatenyuko_copy_data->dataint04,
                                        'dataint05' => $hikiatenyuko_copy_data->dataint05,
                                        'datachar01' => $hikiatenyuko_copy_data->datachar01,
                                        'dataint06' => $hikiatenyuko_copy_data->dataint06,
                                        'dataint07' => $hikiatenyuko_copy_data->dataint07,
                                        'dataint08' => $hikiatenyuko_copy_data->dataint08,
                                        'dataint09' => $hikiatenyuko_copy_data->dataint09,

                                        'datachar02' => $hikiatenyuko_copy_data->datachar02,
                                        'datachar03' => $hikiatenyuko_copy_data->datachar03,
                                        'datachar04' => $hikiatenyuko_copy_data->datachar04,
                                        'datachar05' => $hikiatenyuko_copy_data->datachar05,
                                        'yoteimeter' => $hikiatenyuko_copy_data->yoteimeter,
                                        'denpyohakkoubi' => $hikiatenyuko_copy_data->denpyohakkoubi,
                                        'denpyoshimebi' => date('Y-m-d H:i:s'),
                                        'tantousyabango' => $bango
                                    ];
                                    QueryHelper::updateData('hikiatenyuko', $hikiatenyuko_update_data, ['orderbango' => $hikiatenyuko_copy_data->orderbango,'syouhinid' => $hikiatenyuko_copy_data->syouhinid ], $bango, __CLASS__, __FUNCTION__, __LINE__);
                                    array_push($hikiatenyuko_updated_row_arr,$hikiatenyuko_copy_data->orderbango);
                                }

                                /*------------------update && insert juchusyukko2 -----------------*/
                                $juchusyukko2_update=[
                                    'orderbango' =>  $value->juchusyukko2_orderbango,
                                    'syouhinid'=> $value->juchusyukko2_syouhinid,
                                    'syouhinsyu'=> $value->juchusyukko2_syouhinsyu,
                                    'hantei'=> $value->juchusyukko2_hantei,
                                    'tanka'=> 1,
                                    'denpyoshimebi'=>date('Y-m-d H:i:s'),
                                    'tantousyabango'=>$bango
                                ];
                                QueryHelper::updateData('juchusyukko2', $juchusyukko2_update, ['orderbango' =>  $value->juchusyukko2_orderbango,'syouhinid' => $value->juchusyukko2_syouhinid, 'syouhinsyu' => $value->juchusyukko2_syouhinsyu, 'hantei' => $value->juchusyukko2_hantei, 'tanka' => $value->juchusyukko2_tanka ], $bango, __CLASS__, __FUNCTION__, __LINE__);
                                $check_properties=[
                                    'syouhinid'=> $value->juchusyukko2_syouhinid,
                                    'syouhinsyu'=> $value->juchusyukko2_syouhinsyu,
                                    'hantei'=> $value->juchusyukko2_hantei,
                                    'tantousyabango'=> $bango,
                                    'tanka' => $value->juchusyukko2_tanka
                                ];
                                array_push($juchusyukko2_updated_row_arr,$check_properties);

                                $juchusyukko2_insert_data = [
                                    'orderbango' => $orderHenkan->bango,
                                    'syouhinbango' => $juchusyukko2_copy_data->syouhinbango,
                                    'yoteisu' => $juchusyukko2_copy_data->yoteisu,
                                    'yoteibi' => $juchusyukko2_copy_data->yoteibi,
                                    'kanryoubi' => $juchusyukko2_copy_data->kanryoubi,
                                    'kingaku' => $juchusyukko2_copy_data->kingaku,
                                    'genka' => $juchusyukko2_copy_data->genka,
                                    'syouhizeiritu' => $juchusyukko2_copy_data->syouhizeiritu,
                                    'soukobango' => $juchusyukko2_copy_data->soukobango,

                                    'tanabango' => $juchusyukko2_copy_data->tanabango,
                                    'tantousyabango' => $bango,
                                    'denpyobango' => $juchusyukko2_copy_data->denpyobango,
                                    'denpyohakkoubi' => date('Y-m-d H:i:s'),
                                    'season' => 1,
                                    'nengetsu' => $juchusyukko2_copy_data->nengetsu,
                                    'weeks' => $juchusyukko2_copy_data->weeks,
                                    'day' => 2,
                                    'tanka' => 2,
                                    'zaiko' => $juchusyukko2_copy_data->zaiko,

                                    'idoutanabango' => $juchusyukko2_copy_data->idoutanabango,
                                    'yoteimeter' => 0,
                                    'zaikometer' => $juchusyukko2_copy_data->zaikometer,
                                    'barcode' => $juchusyukko2_copy_data->barcode,
                                    'codename' => $juchusyukko2_copy_data->codename,
                                    'denpyoshimebi' => null,
                                    'kawaserate' => $juchusyukko2_copy_data->kawaserate,
                                    'kawasename' => $juchusyukko2_copy_data->kawasename,
                                    'syouhizeikubun' => $juchusyukko2_copy_data->syouhizeikubun,

                                    'syouhinname' => $juchusyukko2_copy_data->syouhinname,
                                    'yoyakubi' => $juchusyukko2_copy_data->yoyakubi,
                                    'kaiinid' => $juchusyukko2_copy_data->kaiinid,
                                    'syouhinid' => $juchusyukko2_copy_data->syouhinid,
                                    'syouhinsyu' => (int)$value->minyuko_temp_syouhinsyu+1,
                                    'hantei' => $juchusyukko2_copy_data->hantei,
                                    'recordnumber' => $juchusyukko2_copy_data->recordnumber,

                                    'dataint01' => $juchusyukko2_copy_data->dataint01,
                                    'dataint02' => $juchusyukko2_copy_data->dataint02,
                                    'dataint03' => $juchusyukko2_copy_data->dataint03,
                                    'dataint04' => $juchusyukko2_copy_data->dataint04,
                                    'dataint05' => $juchusyukko2_copy_data->dataint05,
                                    'dataint06' => $juchusyukko2_copy_data->dataint06,
                                    'dataint07' => $juchusyukko2_copy_data->dataint07,
                                    'dataint08' => $juchusyukko2_copy_data->dataint08,
                                    'dataint09' => $juchusyukko2_copy_data->dataint09,
                                    'dataint10' => $juchusyukko2_copy_data->dataint10,

                                    'datachar01' => $juchusyukko2_copy_data->datachar01,
                                    'datachar02' => $juchusyukko2_copy_data->datachar02,
                                    'datachar03' => $juchusyukko2_copy_data->datachar03,
                                    'datachar04' => $juchusyukko2_copy_data->datachar04,
                                    'datachar05' => $juchusyukko2_copy_data->datachar05,
                                    'datachar06' => $juchusyukko2_copy_data->datachar06,
                                    'datachar07' => $juchusyukko2_copy_data->datachar07,
                                    'datachar08' => $juchusyukko2_copy_data->datachar08,
                                    'datachar09' => $juchusyukko2_copy_data->datachar09,
                                    'datachar10' => $juchusyukko2_copy_data->datachar10,

                                    'tankano' => $juchusyukko2_copy_data->tankano,
                                    'syouhinbukacd' => $juchusyukko2_copy_data->syouhinbukacd,
                                    'hanbaibukacd' => $juchusyukko2_copy_data->hanbaibukacd,
                                    'dataint11' => $juchusyukko2_copy_data->dataint11,
                                    'dataint12' => $juchusyukko2_copy_data->dataint12,
                                    'dataint13' => $juchusyukko2_copy_data->dataint13,
                                    'dataint14' => $juchusyukko2_copy_data->dataint14,
                                    'dataint15' => $juchusyukko2_copy_data->dataint15,

                                    'datachar11' => $juchusyukko2_copy_data->datachar11,
                                    'datachar12' => $juchusyukko2_copy_data->datachar12,
                                    'datachar13' => $juchusyukko2_copy_data->datachar13,
                                    'datachar14' => $juchusyukko2_copy_data->datachar14,
                                    'datachar15' => $juchusyukko2_copy_data->datachar15,

                                    'dataint16' => $juchusyukko2_copy_data->dataint16,
                                    'dataint17' => $juchusyukko2_copy_data->dataint17,
                                    'dataint18' => $juchusyukko2_copy_data->dataint18,
                                    'dataint19' => $juchusyukko2_copy_data->dataint19,
                                    'dataint20' => $juchusyukko2_copy_data->dataint20,

                                    'datachar16' => $juchusyukko2_copy_data->datachar16,
                                    'datachar17' => $juchusyukko2_copy_data->datachar17,
                                    'datachar18' => $juchusyukko2_copy_data->datachar18,
                                    'datachar19' => $juchusyukko2_copy_data->datachar19,
                                    'datachar20' => $juchusyukko2_copy_data->datachar20,

                                    'dataint21' => $juchusyukko2_copy_data->dataint21,
                                    'dataint22' => $juchusyukko2_copy_data->dataint22,
                                    'dataint23' => $juchusyukko2_copy_data->dataint23,
                                    'dataint24' => $juchusyukko2_copy_data->dataint24,
                                    'dataint25' => $juchusyukko2_copy_data->dataint25,
                                    'dataint26' => $juchusyukko2_copy_data->dataint26,
                                    'dataint27' => $juchusyukko2_copy_data->dataint27,
                                    'dataint28' => $juchusyukko2_copy_data->dataint28,
                                    'dataint29' => $juchusyukko2_copy_data->dataint29,
                                    'dataint30' => $juchusyukko2_copy_data->dataint30,

                                    'datachar21' => $juchusyukko2_copy_data->datachar21,
                                    'datachar22' => $juchusyukko2_copy_data->datachar22,
                                    'datachar23' => $juchusyukko2_copy_data->datachar23,
                                    'datachar24' => $juchusyukko2_copy_data->datachar24,
                                    'datachar25' => $juchusyukko2_copy_data->datachar25,
                                    'datachar26' => $juchusyukko2_copy_data->datachar26,
                                    'datachar27' => $juchusyukko2_copy_data->datachar27,
                                    'datachar28' => $juchusyukko2_copy_data->datachar28,
                                    'datachar29' => $juchusyukko2_copy_data->datachar29,
                                    'datachar30' => $juchusyukko2_copy_data->datachar30

                                ];
                                $juchusyukko2 = QueryHelper::insertData('juchusyukko2', $juchusyukko2_insert_data, 'orderbango', true, $bango, __CLASS__, __FUNCTION__, __LINE__);

                                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### PurchaseEndCalculation juchusyukko2Insert end\n";
                                QueryHandler::logger($bango, $log_data);
                                pg_query($conn, 'COMMIT');

                                $check_properties=[
                                    'orderbango' => $orderHenkan->bango,
                                    'syouhinid'=> $value->juchusyukko2_syouhinid,
                                    'syouhinsyu'=> $value->juchusyukko2_syouhinsyu,
                                    'hantei'=> $value->juchusyukko2_hantei,
                                    'tantousyabango'=> $bango,
                                    'tanka' => $value->juchusyukko2_tanka
                                ];
                                array_push($juchusyukko2_inserted_row_arr,$check_properties);

                            }

                        }
                        /*------------------V160 qccheck-----------------*/
                        $v160QcCheck=[
                            'v160_all_searched_data' =>$checkSaleV160Existence,
                            'minyuko_inserted_row_arr'=>$minyuko_inserted_row_arr,
                            'minyuko_updated_row_arr'=>$minyuko_updated_row_arr,
                            'juchusyukko2_inserted_row_arr'=>$juchusyukko2_inserted_row_arr,
                            'juchusyukko2_updated_row_arr'=>$juchusyukko2_updated_row_arr,
                            'juchusyukko2_updated_row_arr_difference0'=>$juchusyukko2_updated_row_arr_difference0,
                            'orderHenkan_inserted_row_arr'=>$orderHenkan_inserted_row_arr,
                            'hikiatenyuko_inserted_row_arr' => $hikiatenyuko_updated_row_arr
                        ];

                    }

                    /*------------------executing v150-----------------*/
                    if (count($checkSaleV150Existence)>0){
                        if ($orderEntry==null){
                            $again_order_no_sales_v160_sql= "  where lower(minyuko_temp.datachar01) = 'v160' and juchusyukko2.tanka = '2'";
                        }
                        else{
                            $again_order_no_sales_v160_sql= "  where v_orderhenkan.kokyakuorderbango  = '$orderEntry' and lower(minyuko_temp.datachar01) = 'v160' and juchusyukko2.tanka = '2'";
                        }

                        $againCheckSaleV160Existence=QueryHelper::fetchResult("select
                                                            v_orderhenkan.kokyakuorderbango as v_orderhenkan_kokyakuorderbango,
                                                            v_orderhenkan.ordertypebango2 as v_orderhenkan_ordertypebango2,
                                                            misyukko_temp.misyukko_syouhinid,
                                                            misyukko_temp.misyukko_syouhinsyu,
                                                            misyukko_temp.misyukko_hantei,
                                                            lower (minyuko_temp.datachar01) as minyuko_temp_datachar01,
                                                            minyuko_temp.idoutanabango as minyuko_temp_idoutanabango,
                                                            minyuko_temp.syouhinid as minyuko_temp_syouhinid,
                                                            minyuko_temp.syouhinsyu as minyuko_temp_syouhinsyu,
                                                            minyuko_temp.hantei as minyuko_temp_hantei,
                                                            minyuko_temp.zaikometer as minyuko_temp_zaikometer,
                                                            minyuko_temp.syouhizeiritu as minyuko_temp_syouhizeiritu,
                                                            juchusyukko2.syouhinid as juchusyukko2_syouhinid,
                                                            juchusyukko2.syouhinsyu as juchusyukko2_syouhinsyu,
                                                            juchusyukko2.hantei as juchusyukko2_hantei,
                                                            juchusyukko2.barcode as juchusyukko2_barcode,
                                                            juchusyukko2.codename as juchusyukko2_codename,
                                                            juchusyukko2.orderbango as juchusyukko2_orderbango,
                                                            juchusyukko2.tanka as juchusyukko2_tanka


                                                            from v_orderhenkan
                                                            join v_orderhenkan_temp
                                                            on v_orderhenkan_temp.kokyakuorderbango =  v_orderhenkan.kokyakuorderbango
                                                            and v_orderhenkan_temp.max_v_orderhenkan_ordertypebango2 =  v_orderhenkan.ordertypebango2
                                                            join misyukko_temp
                                                            on misyukko_temp.misyukko_syouhinid = v_orderhenkan.kokyakuorderbango
                                                            join minyuko_temp
                                                            on minyuko_temp.idoutanabango = misyukko_temp.misyukko_syouhinid
                                                            and  minyuko_temp.yoteimeter = misyukko_temp.misyukko_syouhinsyu
                                                            and minyuko_temp.nyukometer = misyukko_temp.misyukko_hantei
                                                            join juchusyukko2
                                                            on  juchusyukko2.syouhinid = minyuko_temp.syouhinid
                                                            and juchusyukko2.syouhinsyu = minyuko_temp.syouhinsyu
                                                            and juchusyukko2.hantei = minyuko_temp.hantei

                                                            $again_order_no_sales_v160_sql

                                                            order by minyuko_temp.syouhinid");
                        //dd($checkSaleV160Existence,$againCheckSaleV160Existence);
                        //dd($againCheckSaleV160Existence);
                        if (count($againCheckSaleV160Existence)>0){
                            $status='ng2';
                            $msg='Outsourced purchase incomplete';
                        }
                        else{
                            $checkSubVal0=0;
                            foreach ($checkSaleV150Existence as $k=>$v){
                                if ($v->sub_syouhizeiritu!=0){
                                    $checkSubVal0=1;
                                    break;
                                }
                            }

                            if ($checkSubVal0==1){
                                $misyukko_updated_row_arr=[];
                                $syukko_inserted_row_arr=[];
                                $juchusyukko_updated_row_arr=[];
                                $orderHenkan_inserted_row_arr=[];
                                $tuhanorder_inserted_row_arr=[];
                                $hikiatesyukko_updated_row_arr=[];
                                $syukkoold_inserted_row_arr=[];

                                foreach ($checkSaleV150Existence as $key=>$value){
                                    if ($value->sub_syouhizeiritu!=0){

                                        /*------------------ for order data-----------------*/

                                        $misyukko_copy_data_sql="  where misyukko.syouhinid  = '$value->misyukko_syouhinid' and misyukko.syouhinsyu  = '$value->misyukko_syouhinsyu' and misyukko.hantei  = '$value->misyukko_hantei'";
                                        $misyukko_copy_data=QueryHelper::fetchSingleResult("select * from misyukko  $misyukko_copy_data_sql");

                                        $orderhenkan_copy_data_sql="  where orderhenkan.kokyakuorderbango  = '$value->v_orderhenkan_kokyakuorderbango' and orderhenkan.ordertypebango2  = '$value->v_orderhenkan_ordertypebango2'";
                                        $orderhenkan_copy_data=QueryHelper::fetchSingleResult("select * from orderhenkan  $orderhenkan_copy_data_sql");

                                        $tuhanorder_copy_data_sql="  where tuhanorder.juchubango  = '$value->v_orderhenkan_kokyakuorderbango' and tuhanorder.juchukubun2 is null";
                                        $tuhanorder_copy_data=QueryHelper::fetchSingleResult("select * from tuhanorder  $tuhanorder_copy_data_sql");

                                        $hikiatesyukko_copy_data_sql="  where hikiatesyukko.syouhinid  = '$value->v_orderhenkan_kokyakuorderbango'";
                                        $hikiatesyukko_copy_data=QueryHelper::fetchSingleResult("select * from hikiatesyukko  $hikiatesyukko_copy_data_sql");

                                        /*------------------insert orderhenkan-----------------*/
                                        $orderHenkan_insert_data=[
                                            'kokyakuorderbango' => $orderhenkan_copy_data->kokyakuorderbango,
                                            'ordertypebango2' => $orderhenkan_copy_data->ordertypebango2+1,
                                            'ordertypebango' => 2,
                                            'orderuserbango' => $bango,
                                            'datachar01' => $orderhenkan_copy_data->datachar01,
                                            'datachar02' => $orderhenkan_copy_data->datachar02,
                                            'intorder04' => $orderhenkan_copy_data->intorder04,
                                            'datachar08' => $orderhenkan_copy_data->datachar08,
                                            'date' => date('Y-m-d H:i:s'),
                                            'datachar09' => $orderhenkan_copy_data->datachar09,
                                            'datachar10' => $orderhenkan_copy_data->datachar10,
                                            'datachar11' => $orderhenkan_copy_data->datachar11,
                                            'intorder01' => $orderhenkan_copy_data->intorder01,
                                            'intorder02' => $orderhenkan_copy_data->intorder02,

                                            'datachar04' => $orderhenkan_copy_data->datachar04,
                                            'datachar05' => $orderhenkan_copy_data->datachar05,
                                            'datachar06' => $orderhenkan_copy_data->datachar06,
                                            'datachar07' => $orderhenkan_copy_data->datachar07,
                                            'datatxt0147' => $orderhenkan_copy_data->datatxt0147,
                                            'deletedate' => $orderhenkan_copy_data->deletedate,
                                            'date0012' => $orderhenkan_copy_data->date0012,
                                            'datachar12' => $orderhenkan_copy_data->datachar12,
                                            'datachar13' => $orderhenkan_copy_data->datachar13,
                                            'datachar14' => strval(date('Ymd')),
                                            'datachar15' => $orderhenkan_copy_data->datachar15,

                                            'date0013' => $orderhenkan_copy_data->date0013,
                                            'date0014' => $orderhenkan_copy_data->date0014,
                                            'date0015' => $orderhenkan_copy_data->date0015,
                                            'datatxt0148' => $orderhenkan_copy_data->datatxt0148,
                                            'datatxt0149' => $orderhenkan_copy_data->datatxt0149,
                                            'datatxt0150' => $orderhenkan_copy_data->datatxt0150,
                                            'datatxt0151' => $orderhenkan_copy_data->datatxt0151,
                                            'intorder03' => 2,
                                            'datatxt0152' => $orderhenkan_copy_data->datatxt0152,
                                            'synchroorderbango' => $orderhenkan_copy_data->synchroorderbango,
                                            'date0018' => $orderhenkan_copy_data->date0018,

                                            'date0019' => $orderhenkan_copy_data->date0019,
                                            'datatxt0153' => $orderhenkan_copy_data->datatxt0153,
                                            'datatxt0154' => $orderhenkan_copy_data->datatxt0154,
                                            'synchroorderbango2' => $orderhenkan_copy_data->synchroorderbango2,
                                            'date0016' => $orderhenkan_copy_data->date0016,
                                            'date0017' => date('Y-m-d H:i:s'),
                                            'datatxt0155' => $bango,
                                            'datatxt0156' => $orderhenkan_copy_data->datatxt0156,
                                            'datatxt0157' => $orderhenkan_copy_data->datatxt0157,
                                            'date0020' => $orderhenkan_copy_data->date0020,
                                            'datatxt0158' => $orderhenkan_copy_data->datatxt0158
                                        ];
                                        $orderHenkan = QueryHelper::insertData('orderhenkan', $orderHenkan_insert_data, 'bango', true, $bango, __CLASS__, __FUNCTION__, __LINE__);

                                        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### PurchaseEndCalculation orderhenkanInsert end\n";
                                        QueryHandler::logger($bango, $log_data);
                                        pg_query($conn, 'COMMIT');

                                        array_push($orderHenkan_inserted_row_arr,$orderHenkan->bango);

                                        /*------------------ insert tuhanorder -----------------*/
                                        $tuhanorder_insert_data = [
                                            'orderbango' => $orderHenkan->bango,
                                            'juchubango' => $tuhanorder_copy_data->juchubango,
                                            'chumonbango' => $tuhanorder_copy_data->chumonbango,
                                            'juchukubun1' => $tuhanorder_copy_data->juchukubun1,
                                            'juchukubun2' => $tuhanorder_copy_data->juchukubun2,
                                            'datatxt0130' => $tuhanorder_copy_data->datatxt0130,
                                            'chumondate' => $tuhanorder_copy_data->chumondate,
                                            'otodokedate' => $tuhanorder_copy_data->otodokedate,
                                            'otodoketime' => $tuhanorder_copy_data->otodoketime,
                                            'chumonsyabango' => $tuhanorder_copy_data->chumonsyabango,
                                            'soufusakibango' => $tuhanorder_copy_data->soufusakibango,
                                            'kessaihouhou' => $tuhanorder_copy_data->kessaihouhou,
                                            'housoukubun' => $tuhanorder_copy_data->housoukubun,
                                            'chumonsyajouhou' => $tuhanorder_copy_data->chumonsyajouhou,
                                            'soufusakijouhou' => $tuhanorder_copy_data->soufusakijouhou,
                                            'numeric1' => $tuhanorder_copy_data->numeric1,
                                            'numeric2' => (int)date('Ymd'),
                                            'numeric3' => $tuhanorder_copy_data->money10,
                                            'numeric4' => null,
                                            'numeric5' => $tuhanorder_copy_data->numeric5,
                                            'numericmax' => $tuhanorder_copy_data->numericmax,
                                            'money1' => $tuhanorder_copy_data->money1,
                                            'money2' => $tuhanorder_copy_data->money2,
                                            'money3' => $tuhanorder_copy_data->money3,
                                            'money4' => $tuhanorder_copy_data->money4,
                                            'money5' => $tuhanorder_copy_data->money5,
                                            'moneymax' => $value->update_tuhanorder_moneymax,
                                            'information1' => $tuhanorder_copy_data->information1,
                                            'information2' => $tuhanorder_copy_data->information2,
                                            'information3' => $tuhanorder_copy_data->information3,
                                            'information4' => $tuhanorder_copy_data->information4,
                                            'information5' => $tuhanorder_copy_data->information5,
                                            'nyukingaku' => $tuhanorder_copy_data->nyukingaku,
                                            'unsoudaibikitesuryou' => $tuhanorder_copy_data->unsoudaibikitesuryou,
                                            'unsoutesuryou' => $tuhanorder_copy_data->unsoutesuryou,
                                            'unsouinchigaku' => $tuhanorder_copy_data->unsouinchigaku,
                                            'unsousplittesuryou' => $tuhanorder_copy_data->unsousplittesuryou,
                                            'youbou' => $tuhanorder_copy_data->youbou,
                                            'affbango' => $tuhanorder_copy_data->affbango,
                                            'syukei1' => $tuhanorder_copy_data->syukei1,
                                            'syukei2' => $tuhanorder_copy_data->syukei2,
                                            'syukei3' => $tuhanorder_copy_data->syukei3,
                                            'syukei4' => $tuhanorder_copy_data->syukei4,
                                            'syukei5' => $tuhanorder_copy_data->syukei5,
                                            'text1' => $tuhanorder_copy_data->text1,
                                            'text2' => $orderHenkan->datachar05,
                                            'text3' => $tuhanorder_copy_data->text3,
                                            'text4' => $tuhanorder_copy_data->text4,
                                            'text5' => '2',
                                            'numeric6' => $tuhanorder_copy_data->numeric6,
                                            'numeric7' => $tuhanorder_copy_data->numeric7,
                                            'numeric8' => $tuhanorder_copy_data->numeric8,
                                            'numeric9' => $tuhanorder_copy_data->numeric9,
                                            'numeric10' => $tuhanorder_copy_data->numeric10,
                                            'money6' => $tuhanorder_copy_data->money6,
                                            'money7' => $tuhanorder_copy_data->money7,
                                            'money8' => $tuhanorder_copy_data->money8,
                                            'money9' => $tuhanorder_copy_data->money9,
                                            'money10' => $tuhanorder_copy_data->money10,
                                            'information6' => $tuhanorder_copy_data->information6,
                                            'information7' => $tuhanorder_copy_data->information7,
                                            'information8' => $tuhanorder_copy_data->information8,
                                            'information9' => $tuhanorder_copy_data->information9,
                                            'information10' => $tuhanorder_copy_data->information10,
                                        ];
                                        $tuhanorder = QueryHelper::insertData('tuhanorder',$tuhanorder_insert_data,'orderbango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);

                                        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### PurchaseEndCalculation tuhanorderInsert end\n";
                                        QueryHandler::logger($bango, $log_data);
                                        pg_query($conn, 'COMMIT');

                                        $check_properties=[
                                            'orderbango' => $tuhanorder->orderbango,
                                            'juchubango' =>  $tuhanorder->juchubango,
                                            'juchukubun2'=> $tuhanorder->juchukubun2,
                                        ];
                                        array_push($tuhanorder_inserted_row_arr,$check_properties);

                                        /*------------------update misyukko-----------------*/
                                        /*$misyukko_insert_data = [
                                            'orderbango' => $orderHenkan->bango,
                                            'syouhinid' => $misyukko_copy_data->syouhinid,
                                            'syouhinsyu' => $misyukko_copy_data->syouhinsyu,
                                            'hantei' => $misyukko_copy_data->hantei,
                                            'dataint01' => $misyukko_copy_data->dataint01+1,
                                            'dataint02' => $misyukko_copy_data->dataint02,
                                            'datachar13' => $misyukko_copy_data->datachar13,
                                            'kawasename' => $misyukko_copy_data->kawasename,
                                            'syouhinname' => $misyukko_copy_data->syouhinname,
                                            'datachar14' => $misyukko_copy_data->datachar14,

                                            'barcode' => $misyukko_copy_data->barcode,
                                            'codename' => $misyukko_copy_data->codename,
                                            'syukkasu' => $misyukko_copy_data->syukkasu,
                                            'dataint04' => $misyukko_copy_data->dataint04,
                                            'dataint05' => $misyukko_copy_data->dataint05,
                                            'dataint06' => $misyukko_copy_data->dataint06,
                                            'dataint07' => $misyukko_copy_data->dataint07,
                                            'dataint08' => $misyukko_copy_data->dataint08,
                                            'datachar01' => $misyukko_copy_data->datachar01,
                                            'datachar02' => $misyukko_copy_data->datachar02,

                                            'datachar03' => $misyukko_copy_data->datachar03,
                                            'datachar04' => $misyukko_copy_data->datachar04,
                                            'datachar05' => $misyukko_copy_data->datachar05,
                                            'dataint09' => $misyukko_copy_data->dataint09,
                                            'dataint10' => $misyukko_copy_data->dataint10,
                                            'datachar06' => $misyukko_copy_data->datachar06,
                                            'datachar07' => $misyukko_copy_data->datachar07,
                                            'datachar08' => $misyukko_copy_data->datachar08,
                                            'datachar09' => $misyukko_copy_data->datachar09,
                                            'datachar15' => $misyukko_copy_data->datachar15,

                                            'datachar16' => $misyukko_copy_data->datachar16,
                                            'datachar17' => $misyukko_copy_data->datachar17,
                                            'dataint16' => $value->insert_misyukko_dataint16,
                                            'dataint17' => $misyukko_copy_data->dataint17,
                                            'dataint18' => $misyukko_copy_data->dataint18,
                                            'dataint19' => $misyukko_copy_data->dataint19,
                                            'dataint20' => $misyukko_copy_data->dataint20,

                                            'datachar21' => $misyukko_copy_data->datachar21,
                                            'datachar22' => $misyukko_copy_data->datachar22,
                                            'yoteimeter' => $misyukko_copy_data->yoteimeter,
                                            'tanabango' => strval(date('YmdHis')),
                                            'tantousyabango' => $bango,
                                            'datachar12' => $misyukko_copy_data->datachar12

                                        ];*/
                                        $misyukko_update_data = [
                                            'orderbango' => $orderHenkan->bango,
                                            'syouhinid' => $misyukko_copy_data->syouhinid,
                                            'syouhinsyu' => $misyukko_copy_data->syouhinsyu,
                                            'hantei' => $misyukko_copy_data->hantei,
                                            'dataint01' => $misyukko_copy_data->dataint01+1,
                                            'dataint16' => $value->insert_misyukko_dataint16,
                                            'tanabango' => strval(date('YmdHis')),
                                            'tantousyabango' => $bango
                                        ];
                                        QueryHelper::updateData('misyukko', $misyukko_update_data, ['orderbango' =>  $misyukko_copy_data->orderbango,'syouhinid' => $misyukko_copy_data->syouhinid, 'syouhinsyu' => $misyukko_copy_data->syouhinsyu, 'hantei' => $misyukko_copy_data->hantei ], $bango, __CLASS__, __FUNCTION__, __LINE__);
                                        $check_properties=[
                                            'orderbango' => $orderHenkan->bango,
                                            'syouhinid'=> $misyukko_copy_data->syouhinid,
                                            'syouhinsyu'=> $misyukko_copy_data->syouhinsyu,
                                            'hantei'=> $misyukko_copy_data->hantei
                                        ];
                                        array_push($misyukko_updated_row_arr,$check_properties);

                                        /*------------------insert syukko-----------------*/
                                        $syukko_insert_data = [
                                            'orderbango' => $misyukko_copy_data->orderbango,
                                            'syouhinid' => $misyukko_copy_data->syouhinid,
                                            'syouhinsyu' => $misyukko_copy_data->syouhinsyu,
                                            'hantei' => $misyukko_copy_data->hantei,
                                            'dataint01' => $misyukko_copy_data->dataint01,
                                            'dataint02' => $misyukko_copy_data->dataint02,
                                            'datachar13' => $misyukko_copy_data->datachar13,
                                            'kawasename' => $misyukko_copy_data->kawasename,
                                            'syouhinname' => $misyukko_copy_data->syouhinname,
                                            'datachar14' => $misyukko_copy_data->datachar14,

                                            'barcode' => $misyukko_copy_data->barcode,
                                            'codename' => $misyukko_copy_data->codename,
                                            'syukkasu' => $misyukko_copy_data->syukkasu,
                                            'dataint04' => $misyukko_copy_data->dataint04,
                                            'dataint05' => $misyukko_copy_data->dataint05,
                                            'dataint06' => $misyukko_copy_data->dataint06,
                                            'dataint07' => $misyukko_copy_data->dataint07,
                                            'dataint08' => $misyukko_copy_data->dataint08,
                                            'datachar01' => $misyukko_copy_data->datachar01,
                                            'datachar02' => $misyukko_copy_data->datachar02,

                                            'datachar03' => $misyukko_copy_data->datachar03,
                                            'datachar04' => $misyukko_copy_data->datachar04,
                                            'datachar05' => $misyukko_copy_data->datachar05,
                                            'dataint09' => $misyukko_copy_data->dataint09,
                                            'dataint10' => $misyukko_copy_data->dataint10,
                                            'datachar06' => $misyukko_copy_data->datachar06,
                                            'datachar07' => $misyukko_copy_data->datachar07,
                                            'datachar08' => $misyukko_copy_data->datachar08,
                                            'datachar09' => $misyukko_copy_data->datachar09,
                                            'datachar15' => $misyukko_copy_data->datachar15,

                                            'datachar16' => $misyukko_copy_data->datachar16,
                                            'datachar17' => $misyukko_copy_data->datachar17,
                                            'dataint16' => $misyukko_copy_data->dataint16,
                                            'dataint17' => $misyukko_copy_data->dataint17,
                                            'dataint18' => $misyukko_copy_data->dataint18,
                                            'dataint19' => $misyukko_copy_data->dataint19,
                                            'dataint20' => $misyukko_copy_data->dataint20,

                                            'datachar21' => $misyukko_copy_data->datachar21,
                                            'datachar22' => $misyukko_copy_data->datachar22,
                                            'yoteimeter' => $misyukko_copy_data->yoteimeter,
                                            'tanabango' => $misyukko_copy_data->tanabango,
                                            'tantousyabango' => $misyukko_copy_data->tantousyabango,
                                            'datachar12' => $misyukko_copy_data->datachar12

                                        ];
                                        $syukko = QueryHelper::insertData('syukko', $syukko_insert_data, 'orderbango', true, $bango, __CLASS__, __FUNCTION__, __LINE__);

                                        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### PurchaseEndCalculation syukkoInsert end\n";
                                        QueryHandler::logger($bango, $log_data);
                                        pg_query($conn, 'COMMIT');

                                        $check_properties=[
                                            'orderbango' => $misyukko_copy_data->orderbango,
                                            'syouhinid'=> $misyukko_copy_data->syouhinid,
                                            'syouhinsyu'=> $misyukko_copy_data->syouhinsyu,
                                            'hantei'=> $misyukko_copy_data->hantei
                                        ];
                                        array_push($syukko_inserted_row_arr,$check_properties);

                                        /*------------------update juchusyukko-----------------*/
                                        $juchusyukko_update=[
                                            'orderbango' =>  $orderHenkan->bango,
                                            'syouhinid'=> $value->juchusyukko_syouhinid,
                                            'syouhinsyu'=> $value->juchusyukko_syouhinsyu,
                                            'hantei'=> $value->juchusyukko_hantei,
                                            'idoutanabango'=> strval(date('YmdHis')),
                                            'tantousyabango'=>$bango
                                        ];
                                        QueryHelper::updateData('juchusyukko', $juchusyukko_update, ['orderbango' =>  $value->juchusyukko_orderbango,'syouhinid' => $value->juchusyukko_syouhinid, 'syouhinsyu' => $value->juchusyukko_syouhinsyu, 'hantei' => $value->juchusyukko_hantei ], $bango, __CLASS__, __FUNCTION__, __LINE__);
                                        $check_properties=[
                                            'orderbango' => $value->juchusyukko_orderbango,
                                            'syouhinid'=> $value->juchusyukko_syouhinid,
                                            'syouhinsyu'=> $value->juchusyukko_syouhinsyu,
                                            'hantei'=> $value->juchusyukko_hantei,
                                            'tantousyabango'=> $bango,
                                        ];
                                        array_push($juchusyukko_updated_row_arr,$check_properties);

                                        /*------------------update hikiatesyukko-----------------*/
                                        $hikiatesyukko_update=[
                                            'orderbango' => $orderHenkan->bango,
                                            'syouhinid' =>  $hikiatesyukko_copy_data->syouhinid,
                                            'kaiinid'=> $hikiatesyukko_copy_data->kaiinid,
                                            'idoutanabango'=> strval(date('YmdHis')),
                                            'tantousyabango'=> $bango
                                        ];
                                        QueryHelper::updateData('hikiatesyukko', $hikiatesyukko_update, ['orderbango' =>  $hikiatesyukko_copy_data->orderbango,'syouhinid' => $hikiatesyukko_copy_data->syouhinid, 'kaiinid' =>  $hikiatesyukko_copy_data->kaiinid ], $bango, __CLASS__, __FUNCTION__, __LINE__);
                                        $check_properties=[
                                            'orderbango' => $hikiatesyukko_copy_data->orderbango,
                                            'syouhinid' =>  $hikiatesyukko_copy_data->syouhinid,
                                            'kaiinid'=> $hikiatesyukko_copy_data->kaiinid,
                                        ];
                                        array_push($hikiatesyukko_updated_row_arr,$check_properties);

                                        /*------------------ for order data end -----------------*/


                                        /*------------------ for sales data-----------------*/
                                        $max_orderhenkan_sales = QueryHelper::fetchSingleResult("SELECT DISTINCT kokyakuorderbango, max (ordertypebango2) as max_ordertypebango2 FROM v_orderhenkan WHERE synchroorderbango='0' and kokyakuorderbango='$value->v_orderhenkan_kokyakuorderbango' and datachar10 is not null  group by kokyakuorderbango order by kokyakuorderbango");
                                        //dd($max_orderhenkan_sales);
                                        if (!empty($max_orderhenkan_sales)){
                                            $orderhenkan_copy_data_sql = "  where orderhenkan.kokyakuorderbango  = '$value->v_orderhenkan_kokyakuorderbango' and orderhenkan.ordertypebango2  = '$max_orderhenkan_sales->max_ordertypebango2' and orderhenkan.datachar10 is not null";
                                            $orderhenkan_copy_data = QueryHelper::fetchSingleResult("select * from orderhenkan  $orderhenkan_copy_data_sql");

                                            $tuhanorder_copy_data_sql="  where tuhanorder.juchubango  = '$value->v_orderhenkan_kokyakuorderbango' and tuhanorder.juchukubun2 is null";
                                            $tuhanorder_copy_data=QueryHelper::fetchSingleResult("select * from tuhanorder  $tuhanorder_copy_data_sql");

                                            $syukkoold_copy_data_sql="  where syukkoold.syouhinid  = '$value->misyukko_syouhinid' and syukkoold.syouhinsyu  = '$value->misyukko_syouhinsyu' and syukkoold.hantei  = '$value->misyukko_hantei'";
                                            $syukkoold_copy_data=QueryHelper::fetchSingleResult("select * from syukkoold  $syukkoold_copy_data_sql");

                                            if (!empty($syukkoold_copy_data)){
                                                /*------------------insert orderhenkan-----------------*/
                                                $orderHenkan_insert_data=[
                                                    'kokyakuorderbango' => $orderhenkan_copy_data->kokyakuorderbango,
                                                    'ordertypebango2' => $orderhenkan_copy_data->ordertypebango2+1,
                                                    'ordertypebango' => 2,
                                                    'orderuserbango' => $bango,
                                                    'datachar01' => $orderhenkan_copy_data->datachar01,
                                                    'datachar02' => $orderhenkan_copy_data->datachar02,
                                                    'intorder04' => $orderhenkan_copy_data->intorder04,
                                                    'datachar08' => $orderhenkan_copy_data->datachar08,
                                                    'date' => date('Y-m-d H:i:s'),
                                                    'datachar09' => $orderhenkan_copy_data->datachar09,
                                                    'datachar10' => $orderhenkan_copy_data->datachar10,
                                                    'datachar11' => $orderhenkan_copy_data->datachar11,
                                                    'intorder01' => $orderhenkan_copy_data->intorder01,
                                                    'intorder02' => $orderhenkan_copy_data->intorder02,

                                                    'datachar04' => $orderhenkan_copy_data->datachar04,
                                                    'datachar05' => $orderhenkan_copy_data->datachar05,
                                                    'datachar06' => $orderhenkan_copy_data->datachar06,
                                                    'datachar07' => $orderhenkan_copy_data->datachar07,
                                                    'datatxt0147' => $orderhenkan_copy_data->datatxt0147,
                                                    'deletedate' => $orderhenkan_copy_data->deletedate,
                                                    'date0012' => $orderhenkan_copy_data->date0012,
                                                    'datachar12' => $orderhenkan_copy_data->datachar12,
                                                    'datachar13' => $orderhenkan_copy_data->datachar13,
                                                    'datachar14' => strval(date('Ymd')),
                                                    'datachar15' => $orderhenkan_copy_data->datachar15,
                                                    'date0013' => $orderhenkan_copy_data->date0013,
                                                    'date0014' => $orderhenkan_copy_data->date0014,
                                                    'date0015' => $orderhenkan_copy_data->date0015,
                                                    'datatxt0148' => $orderhenkan_copy_data->datatxt0148,
                                                    'datatxt0149' => $orderhenkan_copy_data->datatxt0149,
                                                    'datatxt0150' => $orderhenkan_copy_data->datatxt0150,
                                                    'datatxt0151' => $orderhenkan_copy_data->datatxt0151,
                                                    'intorder03' => 2,
                                                    'datatxt0152' => $orderhenkan_copy_data->datatxt0152,
                                                    'synchroorderbango' => $orderhenkan_copy_data->synchroorderbango,
                                                    'date0018' => $orderhenkan_copy_data->date0018,

                                                    'date0019' => $orderhenkan_copy_data->date0019,
                                                    'datatxt0153' => $orderhenkan_copy_data->datatxt0153,
                                                    'datatxt0154' => $orderhenkan_copy_data->datatxt0154,
                                                    'synchroorderbango2' => $orderhenkan_copy_data->synchroorderbango2,
                                                    'date0016' => $orderhenkan_copy_data->date0016,
                                                    'date0017' => date('Y-m-d H:i:s'),
                                                    'datatxt0155' => $bango,
                                                    'datatxt0156' => $orderhenkan_copy_data->datatxt0156,
                                                    'datatxt0157' => $orderhenkan_copy_data->datatxt0157,
                                                    'date0020' => $orderhenkan_copy_data->date0020,
                                                    'datatxt0158' => $orderhenkan_copy_data->datatxt0158
                                                ];
                                                $orderHenkan = QueryHelper::insertData('orderhenkan', $orderHenkan_insert_data, 'bango', true, $bango, __CLASS__, __FUNCTION__, __LINE__);

                                                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### PurchaseEndCalculation orderhenkanInsert end\n";
                                                QueryHandler::logger($bango, $log_data);
                                                pg_query($conn, 'COMMIT');

                                                array_push($orderHenkan_inserted_row_arr,$orderHenkan->bango);

                                                /*------------------ insert tuhanorder -----------------*/
                                                $tuhanorder_insert_data = [
                                                    'orderbango' => $orderHenkan->bango,
                                                    'juchubango' => $tuhanorder_copy_data->juchubango,
                                                    'chumonbango' => $tuhanorder_copy_data->chumonbango,
                                                    'juchukubun1' => $tuhanorder_copy_data->juchukubun1,
                                                    'juchukubun2' => $tuhanorder_copy_data->juchukubun2,
                                                    'datatxt0130' => $tuhanorder_copy_data->datatxt0130,
                                                    'chumondate' => $tuhanorder_copy_data->chumondate,
                                                    'otodokedate' => $tuhanorder_copy_data->otodokedate,
                                                    'otodoketime' => $tuhanorder_copy_data->otodoketime,
                                                    'chumonsyabango' => $tuhanorder_copy_data->chumonsyabango,
                                                    'soufusakibango' => $tuhanorder_copy_data->soufusakibango,
                                                    'kessaihouhou' => $tuhanorder_copy_data->kessaihouhou,
                                                    'housoukubun' => $tuhanorder_copy_data->housoukubun,
                                                    'chumonsyajouhou' => $tuhanorder_copy_data->chumonsyajouhou,
                                                    'soufusakijouhou' => $tuhanorder_copy_data->soufusakijouhou,
                                                    'numeric1' => $tuhanorder_copy_data->numeric1,
                                                    'numeric2' => $tuhanorder_copy_data->numeric2,
                                                    'numeric3' => $tuhanorder_copy_data->money10,
                                                    'numeric4' => null,
                                                    'numeric5' => $tuhanorder_copy_data->numeric5,
                                                    'numericmax' => $tuhanorder_copy_data->numericmax,
                                                    'money1' => $tuhanorder_copy_data->money1,
                                                    'money2' => $tuhanorder_copy_data->money2,
                                                    'money3' => $tuhanorder_copy_data->money3,
                                                    'money4' => $tuhanorder_copy_data->money4,
                                                    'money5' => $tuhanorder_copy_data->money5,
                                                    'moneymax' => $tuhanorder_copy_data->money10 - $value->insert_misyukko_dataint16,
                                                    'information1' => $tuhanorder_copy_data->information1,
                                                    'information2' => $tuhanorder_copy_data->information2,
                                                    'information3' => $tuhanorder_copy_data->information3,
                                                    'information4' => $tuhanorder_copy_data->information4,
                                                    'information5' => $tuhanorder_copy_data->information5,
                                                    'nyukingaku' => $tuhanorder_copy_data->nyukingaku,
                                                    'unsoudaibikitesuryou' => $tuhanorder_copy_data->unsoudaibikitesuryou,
                                                    'unsoutesuryou' => $tuhanorder_copy_data->unsoutesuryou,
                                                    'unsouinchigaku' => $tuhanorder_copy_data->unsouinchigaku,
                                                    'unsousplittesuryou' => $tuhanorder_copy_data->unsousplittesuryou,
                                                    'youbou' => $tuhanorder_copy_data->youbou,
                                                    'affbango' => $tuhanorder_copy_data->affbango,
                                                    'syukei1' => $tuhanorder_copy_data->syukei1,
                                                    'syukei2' => $tuhanorder_copy_data->syukei2,
                                                    'syukei3' => $tuhanorder_copy_data->syukei3,
                                                    'syukei4' => $tuhanorder_copy_data->syukei4,
                                                    'syukei5' => $tuhanorder_copy_data->syukei5,
                                                    'text1' => $tuhanorder_copy_data->text1,
                                                    'text2' => $orderHenkan->datachar05,
                                                    'text3' => $tuhanorder_copy_data->text3,
                                                    'text4' => $tuhanorder_copy_data->text4,
                                                    'text5' => $tuhanorder_copy_data->text5,
                                                    'numeric6' => $tuhanorder_copy_data->numeric6,
                                                    'numeric7' => $tuhanorder_copy_data->numeric7,
                                                    'numeric8' => $tuhanorder_copy_data->numeric8,
                                                    'numeric9' => $tuhanorder_copy_data->numeric9,
                                                    'numeric10' => $tuhanorder_copy_data->numeric10,
                                                    'money6' => $tuhanorder_copy_data->money6,
                                                    'money7' => $tuhanorder_copy_data->money7,
                                                    'money8' => $tuhanorder_copy_data->money8,
                                                    'money9' => $tuhanorder_copy_data->money9,
                                                    'money10' => $tuhanorder_copy_data->money10,
                                                    'information6' => $tuhanorder_copy_data->information6,
                                                    'information7' => $tuhanorder_copy_data->information7,
                                                    'information8' => $tuhanorder_copy_data->information8,
                                                    'information9' => $tuhanorder_copy_data->information9,
                                                    'information10' => $tuhanorder_copy_data->information10,
                                                ];
                                                $tuhanorder = QueryHelper::insertData('tuhanorder',$tuhanorder_insert_data,'orderbango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);

                                                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### PurchaseEndCalculation tuhanorderInsert end\n";
                                                QueryHandler::logger($bango, $log_data);
                                                pg_query($conn, 'COMMIT');

                                                $check_properties=[
                                                    'orderbango' => $tuhanorder->orderbango,
                                                    'juchubango' =>  $tuhanorder->juchubango,
                                                    'juchukubun2'=> $tuhanorder->juchukubun2,
                                                ];
                                                array_push($tuhanorder_inserted_row_arr,$check_properties);

                                                /*------------------insert syukkoold-----------------*/
                                                $syukkoold_insert_data = [
                                                    'orderbango' => $orderHenkan->bango,
                                                    'kaiinid' => $syukkoold_copy_data->kaiinid,
                                                    'syouhinsyu' => $syukkoold_copy_data->syouhinsyu,
                                                    'hantei' => $syukkoold_copy_data->hantei,
                                                    'dataint01' => $syukkoold_copy_data->dataint01+1,
                                                    'dataint02' => $syukkoold_copy_data->dataint02,
                                                    'datachar13' => $syukkoold_copy_data->datachar13,
                                                    'syouhinid' => $syukkoold_copy_data->syouhinid,
                                                    'kawasename' => $syukkoold_copy_data->kawasename,
                                                    'syouhinname' => $syukkoold_copy_data->syouhinname,
                                                    'syukkasu' => $syukkoold_copy_data->syukkasu,
                                                    'codename' => $syukkoold_copy_data->codename,
                                                    'dataint04' => $syukkoold_copy_data->dataint04,
                                                    'datachar08' => $syukkoold_copy_data->datachar08,
                                                    'dataint14' => $syukkoold_copy_data->dataint14,
                                                    'dataint15' => $syukkoold_copy_data->dataint15,
                                                    'dataint18' => $syukkoold_copy_data->dataint18,
                                                    'dataint19' => $syukkoold_copy_data->dataint19,
                                                    'dataint20' => $syukkoold_copy_data->dataint20,
                                                    'datachar11' => $syukkoold_copy_data->datachar11,
                                                    'yoteimeter' => $syukkoold_copy_data->yoteimeter,
                                                    'tanabango' => $syukkoold_copy_data->tanabango,
                                                    'tantousyabango' => $bango,
                                                ];
                                                $syukkoold = QueryHelper::insertData('syukkoold', $syukkoold_insert_data, 'orderbango', true, $bango, __CLASS__, __FUNCTION__, __LINE__);

                                                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### PurchaseEndCalculation syukkooldInsert end\n";
                                                QueryHandler::logger($bango, $log_data);
                                                pg_query($conn, 'COMMIT');

                                                $check_properties=[
                                                    'orderbango' => $syukkoold_copy_data->orderbango,
                                                    'syouhinid'=> $syukkoold_copy_data->syouhinid,
                                                    'syouhinsyu'=> $syukkoold_copy_data->syouhinsyu,
                                                    'hantei'=> $syukkoold_copy_data->hantei
                                                ];
                                                array_push($syukkoold_inserted_row_arr,$check_properties);
                                            }
                                        }
                                        /*------------------ for sales data end -----------------*/
                                    }
                                }

                                /*------------------V150 qccheck-----------------*/
                                $v150QcCheck=[
                                    'v150_all_searched_data' =>$checkSaleV150Existence,
                                    'misyukko_updated_row_arr'=>$misyukko_updated_row_arr,
                                    'syukko_inserted_row_arr'=>$syukko_inserted_row_arr,
                                    'juchusyukko_updated_row_arr'=>$juchusyukko_updated_row_arr,
                                    'orderHenkan_inserted_row_arr'=>$orderHenkan_inserted_row_arr,
                                    'tuhanorder_inserted_row_arr'=>$tuhanorder_inserted_row_arr,
                                    'hikiatesyukko_updated_row_arr'=>$hikiatesyukko_updated_row_arr,
                                    'syukkoold_inserted_row_arr' => $syukkoold_inserted_row_arr
                                ];
                            }

                        }

                    }

                    /*------------------executing condition4-----------------*/

                    if ($orderEntry==null){
                        $condition4_sql="";
                        $datatxt0003_sql = substr($datatxt0003_sql,4);
                    }
                    else{
                        $condition4_sql="v_orderhenkan.kokyakuorderbango  = '$orderEntry'";
                    }
                    $checkCondition4=QueryHelper::fetchResult("select distinct
                                                            v_orderhenkan.kokyakuorderbango as v_orderhenkan_kokyakuorderbango,
                                                            v_orderhenkan.ordertypebango2 as v_orderhenkan_ordertypebango2,
                                                            misyukko_temp.misyukko_syouhinid,
                                                            misyukko_temp.misyukko_syouhinsyu,
                                                            misyukko_temp.misyukko_hantei,
                                                            misyukko_temp.misyukko_syukkasu,
                                                            minyuko_temp.idoutanabango as minyuko_temp_idoutanabango,
                                                            minyuko_temp.syouhinid as minyuko_temp_syouhinid,
                                                            minyuko_temp.syouhinsyu as minyuko_temp_syouhinsyu,
                                                            minyuko_temp.hantei as minyuko_temp_hantei,
                                                            minyuko_temp.zaikometer as minyuko_temp_zaikometer,
                                                            juchusyukko.orderbango as juchusyukko_orderbango,
                                                            juchusyukko.syouhinid as juchusyukko_syouhinid,
                                                            juchusyukko.syouhinsyu as juchusyukko_syouhinsyu,
                                                            juchusyukko.hantei as juchusyukko_hantei


                                                            from v_orderhenkan
                                                            join v_orderhenkan_temp
                                                            on v_orderhenkan_temp.kokyakuorderbango =  v_orderhenkan.kokyakuorderbango
                                                            and v_orderhenkan_temp.max_v_orderhenkan_ordertypebango2 =  v_orderhenkan.ordertypebango2
                                                            join misyukko_temp
                                                            on misyukko_temp.misyukko_syouhinid = v_orderhenkan.kokyakuorderbango
                                                            left join minyuko_temp
                                                            on minyuko_temp.idoutanabango = misyukko_temp.misyukko_syouhinid
                                                            and  minyuko_temp.yoteimeter = misyukko_temp.misyukko_syouhinsyu
                                                            and minyuko_temp.nyukometer = misyukko_temp.misyukko_hantei
                                                            join juchusyukko
                                                            on  juchusyukko.syouhinid = misyukko_temp.misyukko_syouhinid
                                                            and juchusyukko.syouhinsyu = misyukko_temp.misyukko_syouhinsyu
                                                            and juchusyukko.hantei = misyukko_temp.misyukko_hantei

                                                            where $condition4_sql $datatxt0003_sql $datatxt0004_sql $datatxt0005_sql
                                                            order by minyuko_temp.syouhinid");
                    if (!empty($checkCondition4)){
                        foreach ($checkCondition4 as $key=>$value){
                            if ($value->minyuko_temp_idoutanabango==null){
                                /*------------------update hikiatesyukko-----------------*/
                                $hikiatesyukko_update=[
                                    'syouhinid' =>  $value->v_orderhenkan_kokyakuorderbango,
                                    'idoutanabango'=> strval(date('YmdHis')),
                                    'tantousyabango'=> $bango,
                                    'datachar16' => '1'
                                ];
                                QueryHelper::updateData('hikiatesyukko', $hikiatesyukko_update, ['syouhinid' => $value->v_orderhenkan_kokyakuorderbango], $bango, __CLASS__, __FUNCTION__, __LINE__);
                            }
                        }
                    }

                    $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### PurchaseEndCalculation end\n";
                    QueryHandler::logger($bango, $log_data);
                    pg_query($conn, 'COMMIT');

                    $status='ok';
                    $msg='procedure completed for v160,v150,condition4';

                }
                catch (\Exception $e) {
                    pg_query($conn, "ROLLBACK");
                    $status='ng';
                    $msg='something went wrong when insert and update data!!';
                    //return response()->json( [$status,$msg] );
                    dd($e);
                }
            }
            else{
                $status='ng';
                $msg='hatchu data arimasen';
            }

            return response()->json( [$status,$msg,$v160QcCheck,$v150QcCheck] );

        }catch (\Exception $e) {
            $status='ng';
            $msg='something went wrong!!';
            //return response()->json( [$status,$msg] );
            dd($e);
        }

    }

    //calculate tax rate
    public static function calculateTaxRate($info2,$money10,$otodoketime,$syouhinid,$bango){
        $kokyakuCode = substr($info2, 0,6);
        $haisouCode = substr($info2, 6,2);
        $kokyaku = QueryHelper::select(['bango,mallsoukobango1'])->from('kokyaku1')->where("yobi12 = '$kokyakuCode' ")->get()->first();
        //dd($info2,$money10,$otodoketime,$syouhinid,$bango);
        $haisoujouhou = QueryHelper::select(['datatxt0051'])->from('haisoujouhou')->where("syukei1 = '$kokyaku->bango' ")->get()->first();
        $others2 = QueryHelper::fetchResult("select other1,other17,other18 from others2 where otherint1 = (select bango from haisou where haisou.shikibetsucode = '$kokyakuCode' and haisou.torihikisakibango = '$haisouCode')");

        $category1 = substr($otodoketime,0,2);
        $category2 = substr($otodoketime,2,2);
        $categorykanri = QueryHelper::fetchSingleResult("select substring(category5,1,2) as category5 from categorykanri where category1 = '$category1' AND category2 = '$category2' ");
        $category5 = (int) $categorykanri->category5;

        $mallsoukobango1 = $kokyaku->mallsoukobango1;

        if(explode(' ', $others2[0]->other1)[0] == '1'){
            $format_status = substr($mallsoukobango1,2,1);
            $data_status = explode(' ', $haisoujouhou->datatxt0051)[0];
        }else{
            $format_status = substr($others2[0]->other18,2,1);
            $data_status = explode(' ', $others2[0]->other17)[0];
        }

        if ($data_status == '1') {

            $numeric4 = ($money10*$category5)/100;

            //check tax rate for round,floor or selling
            if($format_status == '1'){
                $numeric4 = round($numeric4);
            }else if($format_status == '2'){
                $numeric4 = floor($numeric4);
            }else if($format_status == '3'){
                $numeric4 = ceil($numeric4);
            }

            return $numeric4;

            //update tuhanorder data
            //$tuhanorder_update_data = [
            //    'juchukubun2' => $kaiinid,
            //    'numeric4' => $numeric4,
            //];
            //$tuhanorderUpdate = QueryHelper::updateData('tuhanorder', $tuhanorder_update_data, 'juchukubun2', $bango, __CLASS__, __FUNCTION__, __LINE__);

        }else if($data_status == '2'){
            //$syukkoold = QueryHelper::fetchResult("select syukkasu,hantei,dataint04 from syukkoold where kaiinid = '$kaiinid' AND hantei = 0 ");
            $misyukko = QueryHelper::fetchResult("select syukkasu,hantei,dataint04 from misyukko where syouhinid = '$syouhinid' AND hantei = 0 ");
            $numeric4 = 0;
            foreach($misyukko as $key=>$value){
                $numeric4 = $numeric4 + ($misyukko[$key]->syukkasu*$misyukko[$key]->dataint04*$category5)/100;
            }

            //check tax rate for round,floor or selling
            if($format_status == '1'){
                $numeric4 = round($numeric4);
            }else if($format_status == '2'){
                $numeric4 = floor($numeric4);
            }else if($format_status == '3'){
                $numeric4 = ceil($numeric4);
            }

            return $numeric4;

        }else{
            return null;
        }
    }
}
