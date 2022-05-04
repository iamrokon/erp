<?php

namespace App\Http\Controllers\sales;
use App\AllClass\master\nameMaster\allCategorykanri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\tantousya;
use App\kengen;
use App\requestTable;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\order\backOrder\BackOrderHeaders;
use App\AllClass\order\backOrder\allTantousya;
use App\AllClass\sales\billingCancellation\searchCompany;
use App\AllClass\common\CreateOrderDetails;
use App\AllClass\ButtonMsg;
use Illuminate\Pagination\Paginator;
use Excel;
use App\AllClass\master\ExcelReportDownload;
use Carbon\Carbon;
use App\AllClass\master\CSVLogger;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;

class SalesDataCreationController extends Controller
{

    public function index(Request $request)
    {
        //dd($request->all());
        $bango = request('userId');
        $tantousya = tantousya::find($bango);
        return view('sales.salesDataCreation.index',compact('bango','tantousya'));
    }

    public function crud(Request $request)
    {
      

        $start_time=Carbon::now()->format('Y-m-d H:i:s');
        $num_ok=0;
        $num_ng=0;
        $bango =$request['bango'];
        
        QueryHelper::runQuery("CREATE TEMPORARY TABLE others_temp as
           select distinct
         others2.other1,
         others2.otherint1,
         others2.other18,
         others2.other17,
         tuhanorder.information2,
         CASE
           WHEN substring(others2.other1,1,1)='1' THEN kokyaku1.ytoiawsestart
           ELSE others2.other3 END as flag_check0,
         
         CASE
           WHEN substring(others2.other1,1,1)='1' THEN haisoujouhou.datatxt0051
           ELSE others2.other17 END as flag_check1,

         CASE
           WHEN substring(others2.other1,1,1)='1' THEN kokyaku1.mallsoukobango1
           ELSE others2.other18 END as roundingPattern,
         kokyaku1.mallsoukobango1,
         tuhanorder.information2 as foregin_key

         from tuhanorder

             left join kokyaku1
             on substring(tuhanorder.information2,1,6) = kokyaku1.yobi12
             and kokyaku1.denpyosaiban = 0

             left join haisou
             on substring(tuhanorder.information2,7,2) = haisou.torihikisakibango
             and haisou.kounyusu = 0
             and haisou.shikibetsucode = substring(tuhanorder.information2,1,6)

             left join others2
             on others2.otherint1=haisou.bango

             left join haisoujouhou
             on haisoujouhou.syukei1=kokyaku1.bango");
        
        $data1=QueryHelper::fetchResult("select distinct
        tuhanorder.juchukubun2 as t_juchukubun2,
        orderhenkan.datachar10 as o_datachar10,
        orderhenkan.datachar02 as o_datachar02,
        orderhenkan.datachar03 as o_datachar03,
        orderhenkan.datachar04 as o_datachar04,
        orderhenkan.datachar05 as o_datachar05,
        orderhenkan.datachar06 as o_datachar06,
        orderhenkan.datachar08 as o_datachar08,
        orderhenkan.datachar09 as o_datachar09,
        orderhenkan.datachar11 as o_datachar11,
        orderhenkan.datachar12 as o_datachar12,
        orderhenkan.datachar13 as o_datachar13,
        orderhenkan.datachar14 as o_datachar14,
        orderhenkan.bango as o_bango,
        orderhenkan.ordertypebango2 as o_ordertypebango2,
        orderhenkan.ordertypebango as o_ordertypebango,
        orderhenkan.datachar01 as o_datachar01,
        tuhanorder.text1 as t_text1,
        orderhenkan.kokyakuorderbango as o_kokyakuorderbango,
        tuhanorder.text2 as t_text2,
        tuhanorder.juchukubun1  as t_juchukubun1,
        tuhanorder.information1 as t_information1,
        tuhanorder.information2 as t_information2,
        tuhanorder.information6 as t_information6,
        tuhanorder.information3 as t_information3,
        orderhenkan.intorder01 as o_intorder01,
        orderhenkan.intorder02 as o_intorder02,
        orderhenkan.intorder04 as o_intorder04,
        orderhenkan.intorder03 as o_intorder03,
        tuhanorder.numeric2 as t_numeric2,
        tuhanorder.juchubango as t_juchubango,
        orderhenkan.intorder05 as o_intorder05,
        tuhanorder.chumonbango as t_chumonbango,
        tuhanorder.money10 as t_money10,
        tuhanorder.moneymax as t_moneymax,
        tuhanorder.chumonsyajouhou as t_chumonsyajouhou,
        tuhanorder.soufusakijouhou as t_soufusakijouhou,
        tuhanorder.kessaihouhou as t_kessaihouhou,
        tuhanorder.housoukubun as t_housoukubun,
        tuhanorder.information4 as t_information4,
        tuhanorder.datatxt0109 as t_datatxt0109,
        tuhanorder.information5 as t_information5,
        tuhanorder.information7 as t_information7,
        tuhanorder.information8 as t_information8,
        tuhanorder.information9 as t_information9,
        tuhanorder.numeric3 as t_numeric3,
        tuhanorder.numeric4 as t_numeric4,
        tuhanorder.datatxt0130 as t_datatxt0130,
        tuhanorder.text3 as t_text3,
        tuhanorder.otodoketime as t_otodoketime,
        tuhanorder.chumondate as t_chumondate,
        tuhanorder.unsoudaibikitesuryou as t_unsoudaibikitesuryou,
        tuhanorder.unsoutesuryou as t_unsoutesuryou,
        tuhanorder.text4 as t_text4,
        tuhanorder.text5 as t_text5,
        tuhanorder.youbou as t_youbou,
        tuhanorder.affbango as t_affbango,
        tuhanorder.money10 as money10,
        orderhenkan.synchroorderbango as o_synchroorderbango,
        orderhenkan.date as o_date,
        orderhenkan.orderuserbango as o_orderuserbango,
        hikiatesyukko.kaiinid as h_kaiinid,
        hikiatesyukko.syouhinid as h_syouhinid,
        hikiatesyukko.dataint01 as h_dataint01,
        hikiatesyukko.dataint02 as h_dataint02,
        hikiatesyukko.dataint03 as h_dataint03,
        hikiatesyukko.dataint04 as h_dataint04,
        hikiatesyukko.dataint05 as h_dataint05,
        hikiatesyukko.dataint06 as h_dataint06,
        hikiatesyukko.dataint07 as h_dataint07,
        hikiatesyukko.datachar01 as h_datachar01,
        hikiatesyukko.datachar02 as h_datachar02,
        hikiatesyukko.datachar03 as h_datachar03,
        hikiatesyukko.datachar04 as h_datachar04,
        hikiatesyukko.datachar05 as h_datachar05,
        hikiatesyukko.datachar06 as h_datachar06,
        hikiatesyukko.datachar07 as h_datachar07,
        hikiatesyukko.datachar08 as h_datachar08,
        hikiatesyukko.datachar09 as h_datachar09,
        hikiatesyukko.datachar10 as h_datachar10,
        hikiatesyukko.datachar11 as h_datachar11,
        hikiatesyukko.datachar12 as h_datachar12,
        hikiatesyukko.datachar13 as h_datachar13,
        hikiatesyukko.datachar14 as h_datachar14,
        hikiatesyukko.datachar15 as h_datachar15,
        hikiatesyukko.yoteimeter as h_yoteimeter,
        hikiatesyukko.tanabango as h_tanabango,
        others_temp.flag_check1 as flag_check1,
        hikiatesyukko.idoutanabango as h_idoutanabango, 
        hikiatesyukko.tantousyabango as h_tantousyabango,
        hikiatesyukko.dataint08 as h_dataint08,
        hikiatesyukko.dataint09 as h_dataint09,
        cast(substr(get_tax_rate.patternsub2, 1, 2) as int) as tax,
        get_rounding_pattern.category2 as rounding_pattern,
        CASE
          WHEN get_rounding_pattern.category2 = '1' THEN round(
            tuhanorder.money10 * cast(substr(get_tax_rate.patternsub2, 1, 2) as int) / 100
          )
          WHEN get_rounding_pattern.category2 = '2' THEN floor(
            tuhanorder.money10 * cast(substr(get_tax_rate.patternsub2, 1, 2) as int) / 100
          )
          WHEN get_rounding_pattern.category2 = '3' THEN ceil(
            tuhanorder.money10 * cast(substr(get_tax_rate.patternsub2, 1, 2) as int) / 100
          )
        END as tax_after_rounding
      

        from (select distinct
                      kokyakuorderbango, max(ordertypebango2) as maxval
                      from orderhenkan 
                      where datachar10 IS NULL group by
                      kokyakuorderbango) as orderhenkan_m

        JOIN orderhenkan AS orderhenkan
        ON orderhenkan.kokyakuorderbango = orderhenkan_m.kokyakuorderbango
        AND orderhenkan.ordertypebango2 = orderhenkan_m.maxval

        inner join hikiatesyukko
        on hikiatesyukko.syouhinid=orderhenkan.kokyakuorderbango
        and hikiatesyukko.orderbango =orderhenkan.bango

        join tuhanorder
        on tuhanorder.juchubango=orderhenkan.kokyakuorderbango
        and tuhanorder.orderbango =orderhenkan.bango

        join categorykanri as get_tax_rate on (get_tax_rate.category1 ||     get_tax_rate.category2) = tuhanorder.otodoketime
        
        join others_temp
        on others_temp.information2=tuhanorder.information2

        join categorykanri as get_rounding_pattern on (    get_rounding_pattern.category1 || get_rounding_pattern.category2) = others_temp.roundingPattern
        

        where orderhenkan.datachar02 = 'U123' and hikiatesyukko.datachar04 = '2' and hikiatesyukko.datachar01 = '3' and orderhenkan.synchroorderbango = '0' and orderhenkan.datachar10 IS NULL 
        order by orderhenkan.kokyakuorderbango
        ");

        if (!$data1) { 
            return json_encode(['empty'=>'ok']);
        }

        foreach ($data1 as $key => $value) {
            $reviewData1 = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7051'");
            if ($reviewData1) {
                $orderbango = $reviewData1->orderbango + 1;
                $mobile_flag = $reviewData1->mobile_flag;
            } else {
                $orderbango = "";
                $mobile_flag = "";
            }

            $reviewData2 = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7501'");
            if ($reviewData2) {
                $orderbango2 = $reviewData2->orderbango;
            } else {
                $orderbango2 = "";
            }
            $modified_orderbango = "09" . $orderbango2 . str_pad($orderbango, $mobile_flag, '0', STR_PAD_LEFT);

            
           $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### sales_data_creation start\n";
           QueryHandler::logger($bango, $log_data);
           $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
           pg_query($conn,  "BEGIN" );

           try {
            
            $orderhenkan=[
            'datachar10'=> $modified_orderbango,
            'ordertypebango2'=> 0,
            'ordertypebango'=>$value->o_ordertypebango,
            'ordertypebango'=>$value->o_ordertypebango,
            'datachar03'=>$value->o_datachar03,
            'datachar04'=>$value->o_datachar04,
            'datachar05'=>$value->o_datachar05,
            'datachar06'=>$value->o_datachar06,
            'datachar08'=>$value->o_datachar08,
            'datachar09'=>$value->o_datachar09,
            'datachar11'=>$value->o_datachar11,
            'datachar12'=>$value->o_datachar12,
            'datachar13'=>$value->o_datachar13,
            'datachar14'=>$value->o_datachar14,
            'intorder02'=>$value->o_intorder02,
            'intorder04'=>$value->o_intorder04,
            'datachar01'=> '1',
            'datachar02'=>$value->o_datachar02,
            'kokyakuorderbango'=> $value->o_kokyakuorderbango,
            'intorder01'=> $value->o_intorder01,
            'intorder03'=> $value->o_intorder03,
            'intorder05'=> $value->o_intorder05,
            'synchroorderbango'=> 0,
            'date'=> Carbon::now()->format('Y-m-d H:i:s'),
            'orderuserbango'=> $bango
            ];

            ////orderhenkan insert
            $new_orderhenkan=QueryHelper::insertData('orderhenkan', $orderhenkan, 'bango',true, $bango, __CLASS__, __FUNCTION__, __LINE__);
            $order_id=$value->t_juchubango;
            $parent_datatext0130=QueryHelper::fetchSingleResult("select orderhenkan.datachar10
              from tuhanorder
              join orderhenkan
              on orderhenkan.kokyakuorderbango=tuhanorder.datatxt0109
              where tuhanorder.juchubango='$order_id'
              ");
           
            
           // if($key == 't_text1'){
                $text1 = $data1[$key]->t_text1;
                $intorder03 = $data1[$key]->o_intorder03;
                $juchukubun2 = $data1[$key]->t_juchukubun2;
                $current_date = date("Ymd");
                $prev_date = date("Ym", strtotime("-1 months")).'01';
                if($text1 == 'U523' && ($prev_date < $intorder03 && $intorder03<= $current_date) && $juchukubun2 != null){
                    $unsoudaibikitesuryou = 1;
                }else{
                    $unsoudaibikitesuryou = 2;
                }
            //}
            
            $tuhanorder=[
              'juchukubun2'=> $modified_orderbango,
              'juchukubun1'=>$value->t_juchukubun1,
              'juchubango'=>$value->o_kokyakuorderbango,
              'text1'=> 'U523',
              'orderbango'=>$new_orderhenkan->bango,
              'text2'=> $value->o_datachar05,
              'information1'=> $value->t_information1,
              'information2'=> $value->t_information2,
              'information6'=> $value->t_information6,
              'information3'=> $value->t_information3,
              'numeric2'=> null,
              'kessaihouhou'=> $value->t_kessaihouhou,
              'housoukubun'=> $value->t_housoukubun,
              'information7'=> $value->t_information7,
              'information8'=> $value->t_information8,
              'numeric3'=> $value->money10,
              'numeric4'=> $value->tax_after_rounding,
              'text3'=> null,
              'otodoketime'=> $value->t_otodoketime,
              'datatxt0109'=> $value->t_datatxt0109,
              'chumondate'=> $value->t_chumondate,
              //'unsoudaibikitesuryou'=> 2,
              'unsoudaibikitesuryou'=> $unsoudaibikitesuryou,
              'unsoutesuryou'=> 2,
              'text4'=> null,
              'text5'=> '2000',
              'youbou'=> null,
              'affbango'=> null,
              'juchubango'=> $value->t_juchubango,
              'chumonbango'=> $value->t_chumonbango,
              'juchukubun1'=> $value->t_juchukubun1,
              'chumonsyajouhou'=> $value->t_chumonsyajouhou,
              'soufusakijouhou'=> $value->t_soufusakijouhou,
              'moneymax'=> $value->t_moneymax,
              'money10'=> $value->t_money10,
              'information4'=> $value->t_information4,
              'information5'=> $value->t_information5,
              'information9'=> $value->t_information9,
              'datatxt0130'=>($parent_datatext0130)?$parent_datatext0130->datachar10:null,
           ];

           $hikiatesyukko=[
            'kaiinid'=>$modified_orderbango,
            'syouhinid'=>$value->o_kokyakuorderbango,
            'orderbango'=>$new_orderhenkan->bango,
            'dataint01'=>2,
            'dataint02'=>3,
            'dataint03'=>2,
            'dataint04'=>1,
            'dataint05'=>null,
            'dataint06'=>1,
            'dataint07'=>2,
            'datachar11'=>null,
            'datachar12'=>null,
            'datachar13'=>null,
            'datachar14'=>null,
            'datachar15'=>null,
            'yoteimeter'=>0,
            'tanabango'=>static::getCurrentTime(),
            'idoutanabango'=>null,
            'tantousyabango'=>$bango,
            'dataint08'=>2,
            'dataint09'=>2,
            'syouhinid'=>$value->h_syouhinid,
            'datachar01'=>$value->h_datachar01,
            'datachar02'=>$value->h_datachar02,
            'datachar03'=>$value->h_datachar03,
            'datachar04'=>'1',
            //'datachar04'=>$value->h_datachar04,
            'datachar05'=>$value->h_datachar05,
            'datachar06'=>$value->h_datachar06,
            'datachar07'=>$value->h_datachar07,
            'datachar08'=>$value->h_datachar08,
            'datachar09'=>$value->h_datachar09,
            'datachar10'=>$value->h_datachar10
           ];
      
           ////tuhanorder insert
            QueryHelper::insertData('tuhanorder', $tuhanorder, 'juchubango', $bango,'orderbango',false, __CLASS__, __FUNCTION__, __LINE__);
            ////hikiatesyukko insert
            QueryHelper::insertData('hikiatesyukko', $hikiatesyukko, 'syouhinid', $bango, 'orderbango',false,__CLASS__, __FUNCTION__, __LINE__);

           $m_data=QueryHelper::fetchResult("select * from misyukko where misyukko.syouhinid = '$value->o_kokyakuorderbango' AND misyukko.orderbango='$value->o_bango' order by syouhinsyu, hantei");
           $tax_except_2=0;
    

           foreach ($m_data as $k => $val) {
            
            
            $tax=($val->syukkasu*$val->dataint04)*$value->tax/100;
            if ($value->rounding_pattern=='1') {
               $tax_modified=round($tax);
            }else if($value->rounding_pattern=='2'){
               $tax_modified=floor($tax);
            }else{
               $tax_modified=ceil($tax);
            }

   
            if ($val->datachar13!='2') {
               $tax_except_2+=$tax_modified;
            }

            
               $syukkoold=[
                  'kaiinid'=>$modified_orderbango,
                  'syouhinsyu'=>$val->syouhinsyu,
                  'orderbango'=>$new_orderhenkan->bango,
                  'hantei'=>$val->hantei,
                  'dataint01'=>$value->o_ordertypebango2,
                  'dataint02'=>$val->dataint02,
                  'datachar13'=>$val->datachar13,
                  'syouhinid'=>$val->syouhinid,
                  'kawasename'=>$val->kawasename,
                  'syouhinname'=>$val->syouhinname,
                  'syukkasu'=>$val->syukkasu,
                  'codename'=>$val->codename,
                  'dataint04'=>$val->dataint04,
                  'datachar08'=>$val->datachar08,
                  'dataint14'=>null,
                  'dataint15'=>null,
                  'datachar18'=>null,
                  'datachar20'=>$tax_modified,
                  'datachar10'=>null,
                  'yoteimeter'=>0,
                  'tanabango'=>static::getCurrentTime(),
                  'tantousyabango'=>$bango,
                  'idoutanabango'=>$val->idoutanabango,
                  'barcode'=>$val->barcode,
                  'dataint05'=>$val->dataint05,
                  'dataint06'=>$val->dataint06,
                  'dataint07'=>$val->dataint07,
                  'dataint08'=>$val->dataint08,
                  'dataint09'=>$val->dataint09,
                  'dataint10'=>$val->dataint10,
                  'dataint11'=>$val->dataint11,
                  'dataint12'=>$val->dataint12,
                  'dataint11'=>$val->dataint11,
                  'dataint12'=>$val->dataint12,
                  'dataint16'=>$val->dataint16,
                  'dataint17'=>$val->dataint17,
                  'dataint18'=>$val->dataint18,
                  'dataint19'=>$val->dataint19,
                  'dataint20'=>$val->dataint20,
                  'datachar01'=>$val->datachar01,
                  'datachar02'=>$val->datachar02,
                  'datachar03'=>$val->datachar03,
                  'datachar04'=>$val->datachar04,
                  'datachar05'=>$val->datachar05,
                  'datachar06'=>$val->datachar06,
                  'datachar07'=>$val->datachar07,
                  'datachar09'=>$val->datachar09,
                  'datachar12'=>$val->datachar12,
                  'datachar14'=>$val->datachar14,
                  'datachar15'=>$val->datachar15,
                  'datachar16'=>$val->datachar16,
                  'datachar17'=>$val->datachar17,
                  'datachar19'=>(int)($val->syukkasu)*(int)$val->dataint04,
                  'datachar21'=>$val->datachar21,
                  'datachar22'=>$val->datachar22

               ];

               ////syukkoold insert
              $syukkoold_last= QueryHelper::insertData('syukkoold', $syukkoold, 'kaiinid', $bango,false, __CLASS__, __FUNCTION__, __LINE__);
           }

           $text3 = $reviewData1->orderbango + 1;

                                //update review data
           $review_update_data = [
               'kokyakusyouhinbango' => 'D7051',
               'orderbango' => $text3,
               'check_flag' => 0,
               'color' => static::getCurrentTime(),
               'nickname' => $bango,
           ];

        
            //update review table
            $reviewUpdate = QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
            //change flags
            $tuhanorder_m = [
                'orderbango'=>$new_orderhenkan->bango,
                'juchukubun2'=> $modified_orderbango,
            ];
            $start = new Carbon('first day of last month');
            $pre_start=$start->format('Ymd');

            if ($pre_start<$value->o_intorder03 AND $value->o_intorder03<= substr(static::getCurrentTime(), 0,8)) {
              $tuhanorder_m['unsoudaibikitesuryou']=1;
            } 
   
            $hikiatesyukko_m = [
                'orderbango'=>$value->o_bango,
                'datachar04'=> 1,
                'kaiinid'=> $value->t_juchukubun2,
            ];

            $juchusyukko_m = [
                //'orderbango'=>$value->o_bango,
                'datachar25'=> 1,
                //'kaiinid'=> $value->t_juchukubun2,
            ];
            $order_id_ju=$value->o_kokyakuorderbango;
          $juchu_condition= QueryHelper::fetchSingleResult("select juchusyukko.hanbaibukacd,
            juchusyukko.dataint18,
            juchusyukko.dataint19
            
            from juchusyukko
            
            join soukosyukko
            on soukosyukko.hanbaibukacd = juchusyukko.hanbaibukacd
            AND soukosyukko.syouhinbango = juchusyukko.dataint18
            AND soukosyukko.yoteisu = juchusyukko.dataint19
            
            join misyukko
            on soukosyukko.syouhinid= misyukko.syouhinid
            AND soukosyukko.syouhinsyu= misyukko.syouhinsyu
            AND soukosyukko.hantei= misyukko.hantei
            
            join orderhenkan
            on orderhenkan.kokyakuorderbango=misyukko.syouhinid
            
            where orderhenkan.kokyakuorderbango= '$order_id_ju'");
            
            QueryHelper::updateData('tuhanorder', $tuhanorder_m, ['juchukubun2'=> $modified_orderbango,'orderbango'=>$new_orderhenkan->bango], $bango, __CLASS__, __FUNCTION__, __LINE__);

            QueryHelper::updateData('hikiatesyukko', $hikiatesyukko_m, ['kaiinid'=> $value->t_juchukubun2,'orderbango'=>$value->o_bango], $bango, __CLASS__, __FUNCTION__, __LINE__);

            QueryHelper::updateData('juchusyukko', $juchusyukko_m, ['hanbaibukacd'=> $juchu_condition->hanbaibukacd,'dataint18'=>$juchu_condition->dataint18,'dataint19'=>$juchu_condition->dataint19], $bango, __CLASS__, __FUNCTION__, __LINE__);
            
            //create history details => CreateOrderDetails::data($bango,$kokyakuorderbango, $ordertypebango2,$datachar01)
            $tmp_kokyakuorderbango = $value->o_kokyakuorderbango;
            CreateOrderDetails::data($bango,$tmp_kokyakuorderbango, 0,1,'04-01','sales_data',$modified_orderbango);
             
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### sales_data_creation end\n";
            QueryHandler::logger($bango, $log_data);
            pg_query($conn, "COMMIT");
            $num_ok++;
        }catch(\Exception $e){
          pg_query($conn,"ROLLBACK");
          $num_ng++; 
           
         
        }
 
        //////update previous orders//////////////
        pg_query($conn,  "BEGIN" );
        try{
        $today=substr(static::getCurrentTime(), 0,8);
        $remaind_orders=QueryHelper::fetchResult("select datachar10 from orderhenkan join tuhanorder on tuhanorder.orderbango= orderhenkan.bango where '$pre_start'< intorder03 AND intorder03<= '$today' AND datachar10 is not null AND tuhanorder.text1='U523' AND unsoudaibikitesuryou <> '1'");
        
        foreach($remaind_orders as $key=>$val){

            ///update for previous data
            $tuhanorder_prev = [
                'unsoudaibikitesuryou'=>1,
                'juchukubun2'=> $val->datachar10,
                'text1'=>'U523'
            ];
          
            QueryHelper::updateData('tuhanorder', $tuhanorder_prev, ['juchukubun2'=> $val->datachar10,'text1'=>'U523'], $bango, __CLASS__, __FUNCTION__, __LINE__);
         }
         pg_query($conn, "COMMIT");
        }catch(\Exception $e){
            pg_query($conn,"ROLLBACK");

           
        }
        //////ends here///////////////////////////
      }
    
        $var=[
             'start'=>$start_time,
             'end'=>Carbon::now()->format('Y-m-d H:i:s'),
             'ok'=>$num_ok,
             'ng'=>$num_ng,
             'target'=>($num_ok+$num_ng),
             'empty'=>'ng'
          ];

        return json_encode($var);  
    }
    
    public static function getCurrentTime()
    {
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        return str_replace(" ", "", $mytime);
    }
}
