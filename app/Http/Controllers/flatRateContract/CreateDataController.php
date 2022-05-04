<?php

namespace App\Http\Controllers\flatRateContract;
use App\AllClass\master\nameMaster\allCategorykanri;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\tantousya;
use App\kengen;
use App\requestTable;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\order\backOrder\allTantousya;
use App\AllClass\ButtonMsg;
use Illuminate\Pagination\Paginator;
use App\AllClass\master\excelDownload;
use App\kokyaku1;
use App\AllClass\TableSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Excel;
use App\AllClass\master\ExcelReportDownload;
use Carbon\Carbon;
use App\AllClass\master\CSVLogger;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;

class CreateDataController extends Controller
{

    public function index($bango, $orderEntry,$company_code)
    {
        /*$sql = "DELETE FROM orderhenkan where bango::text LIKE '%6523%' and kokyakuorderbango::text LIKE '%0151002043%'";
        $sql2 = "DELETE FROM SoukoSyukko where orderbango::text LIKE '%6523%'";
        $sql3 = "DELETE FROM JuchuSyukko where orderbango::text LIKE '%6523%'";
        QueryHelper::runQuery($sql);
        QueryHelper::runQuery($sql2);
        QueryHelper::runQuery($sql3);
        dd('data delete hoic');*/
//        dd($bango, $orderId);
//        dd('please contact with hashmi for update');
        /*$bango='4557';
        $orderEntry= '0151005144';*/

//        dd(self::getKokyakuOrderBango2nd());
        QueryHelper::runQuery("DROP TABLE IF EXISTS flatrate_others_temp");

        QueryHelper::runQuery("CREATE TEMPORARY TABLE flatrate_others_temp as
           select distinct
         tuhanorder.orderbango,
         others2.other1,
         tuhanorder.juchubango,
         tuhanorder.information1,
         tuhanorder.information2,
         tuhanorder.information3,
         tuhanorder.information6,
         tuhanorder.kessaihouhou,
         tuhanorder.housoukubun,
         tuhanorder.otodoketime,
         tuhanorder.date0002,
         tuhanorder.date0003,
         kokyaku1.ytoiawsesaiban,
         kokyaku1.yetoiawsestart,
         CASE
           WHEN substring(others2.other1,1,1)='1' THEN kokyaku1.yetoiawseend
           ELSE others2.other7 END as flag_check0,
         CASE
           WHEN substring(others2.other1,1,1)='1' THEN kokyaku1.ytoiawsestart
           ELSE others2.other3 END as flag_check1,
         CASE
           WHEN substring(others2.other1,1,1)='1' THEN kokyaku1.mallsoukobango1
           ELSE others2.other18 END as roundingpattern,
         CASE
           WHEN substring(others2.other1,1,1)='1' THEN kokyaku1.mail_toiawase_mb
           ELSE others2.other16 END as taxpattern,
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

//        dd(QueryHelper::fetchResult("select * from flatrate_others_temp"));

            //finding the child product

            $misyukkoData=QueryHelper::fetchResult("select kawasename
                from misyukko
                where syouhinid = '$orderEntry'
                and idoutanabango is not null");
//                dd($misyukkoData);
            if (count($misyukkoData)>0){
                $str='(';
                foreach ($misyukkoData as $key => $value) {

                    if ($key == (array_key_last($misyukkoData))) {
                        $str=$str."'".$value->kawasename."'".')';
                    }else{
                        $str=$str."'".$value->kawasename."'".',';
                    }
                }
//            dd($str);
                $syouhin1Data= QueryHelper::fetchResult("select kokyakusyouhinbango
                from syouhin1
                where kokyakusyouhinbango in  $str
                and data100 = 'D131'");

                $str='(';
                foreach ($syouhin1Data as $key => $value) {

                    if ($key == (array_key_last($syouhin1Data))) {
                        $str=$str."'".$value->kokyakusyouhinbango."'".')';
                    }else{
                        $str=$str."'".$value->kokyakusyouhinbango."'".',';
                    }
                }

//            dd($syouhin1Data,$str);
                if (count($syouhin1Data)>0){
                    $misyukkoResult= QueryHelper::fetchResult("select syutenjyouken from kakaku where syutenjyouken = '005014'");
                    $misyukkoResult= QueryHelper::fetchResult("select distinct
                   misyukko.syouhinid,
                   misyukko.syouhinname,
                   misyukko.syouhinsyu,
                   misyukko.hantei,
                   misyukko.datachar02,
                   misyukko.datachar05 as misyukkodatachar05,
                   misyukko.syukkasu,
                   misyukko.codename,
                   misyukko.dataint04,
                   misyukko.datachar03 as misyukkodatachar03,
                   misyukko.datachar04,
                   misyukko.datachar08,
                   misyukko.dataint09,
                   misyukko.dataint10,
                   misyukko.datachar06,
                   misyukko.datachar07,
                   misyukko.datachar09,
                   misyukko.tantousyabango,
                   misyukko.kawasename,
                   misyukko.idoutanabango,
                   syouhin1.bumon,
                   syouhin1.data52,
                   syouhin1.data104,
                   orderhenkan.datachar03 orderhenkandatachar03,
                   orderhenkan.datachar05 as orderhenkandatachar05,
                   orderhenkan.intorder03,
                   flatrate_others_temp.other1,
                   flatrate_others_temp.juchubango,
                   flatrate_others_temp.flag_check0,
                   flatrate_others_temp.flag_check1,
                   flatrate_others_temp.roundingpattern,
                   flatrate_others_temp.taxpattern,
                   flatrate_others_temp.information1,
                   flatrate_others_temp.information2,
                   flatrate_others_temp.information3,
                   flatrate_others_temp.information6,
                   flatrate_others_temp.kessaihouhou,
                   flatrate_others_temp.housoukubun,
                   flatrate_others_temp.otodoketime,
                   flatrate_others_temp.date0002,
                   flatrate_others_temp.date0003,
                   flatrate_others_temp.ytoiawsesaiban,
                   flatrate_others_temp.yetoiawsestart,
                   kakaku.yoyakukanousu,
                   kakaku.sortbango,
                   kakaku.dataint01,
                   kakaku.yoyakusu,
                   kakaku.syutenjyouken
                   from misyukko
                   join juchusyukko
                   on misyukko.syouhinid = juchusyukko.syouhinid
                   join syouhin1
                   on misyukko.kawasename = syouhin1.kokyakusyouhinbango
                   join flatrate_others_temp
                   on flatrate_others_temp.juchubango = misyukko.syouhinid
                   join kakaku
                   on syouhin1.bango = kakaku.syouhinbango
                   and (kakaku.syutenjyouken=substr(flatrate_others_temp.information2,1,6) or kakaku.syutenjyouken is null)
                   join orderhenkan
                   on orderhenkan.kokyakuorderbango = misyukko.syouhinid

                   where misyukko.kawasename in  $str
                   and juchusyukko.datachar01 = '2'
                   and syouhin1.data100 = 'D131'
                   and misyukko.syouhinid = '$orderEntry'
                   and misyukko.idoutanabango is not null");

                $company_code = substr($company_code,0,6);
                if(collect($misyukkoResult)->where('syutenjyouken',$company_code)->count() > 0){
                    $misyukkoResult = collect($misyukkoResult)->where('syutenjyouken',$company_code);
                }else{
                    $misyukkoResult = collect($misyukkoResult)->where('syutenjyouken', '=', NULL);
                }

                    //for testing purpose
                    $orderHenkanBangoArr=[];//juchu to teiki bango
                    $orderHenkanBangoArr2=[];//teiki to juchu bango
                    $soukosyukkoIndertDataArr=[];
                    //for testing purpose

                    $bummonNullFlag=false;
                    $patternsub2NullFlag=false;
                    for ($x = 0; $x <= count($misyukkoResult) - 1; $x++) {
                        if($misyukkoResult[$x]->bumon == null){
                            $bummonNullFlag=true;
                        }
                        else{
                            $bumon1stpart= substr($misyukkoResult[$x]->bumon,0,2);
                            $bumon2ndtpart= substr($misyukkoResult[$x]->bumon,2);

                            $patternsub2_val=QueryHelper::fetchSingleResult("select distinct
                            patternsub2
                            from categorykanri
                            where category1::text like '%$bumon1stpart%'
                            and category2::text like '%$bumon2ndtpart%'");

                            if ($patternsub2_val->patternsub2 == null){
                                $patternsub2NullFlag=true;
                            }
                        }
                    }
//dd($bummonNullFlag,$patternsub2NullFlag,count($misyukkoResult),$misyukkoResult);
                    if ($bummonNullFlag==false && $patternsub2NullFlag==false){

                        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### flat_rate_dataCreate_processing start\n";
                        QueryHandler::logger($bango, $log_data);
                        $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
                        pg_query($conn, 'BEGIN');

                        try {
                            //child product loop
                            for ($x=0;$x<= count($misyukkoResult)-1;$x++){
//                    order entry to flat rate (juchu to teiki)

                                $kokyakuorderbango = static::getKokyakuOrderBango();

                                $orderHenkan_insert_data = [
                                    'datachar05' => $misyukkoResult[$x]->orderhenkandatachar05,
                                    'datachar07' => $kokyakuorderbango
                                ];

                                $orderHenkan = QueryHelper::insertData('orderhenkan', $orderHenkan_insert_data, 'bango', true, $bango, __CLASS__, __FUNCTION__, __LINE__);

                                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### flatrateCreateDataOrderhenkanDataInstert end\n";
                                QueryHandler::logger($bango, $log_data);
                                pg_query($conn, 'COMMIT');
//            dd('data insert hoic');

                                $reviewData1 = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7111'");
                                $orderbango = $reviewData1->orderbango + 1;


                                $review_update_data = [
                                    'kokyakusyouhinbango' => 'D7111',
                                    'orderbango' => $orderbango,
                                    'check_flag' => 0,
                                    'color' => static::getCurrentTime(),
                                    'size' => Helper::getSystemIP(),
                                    'nickname' => $bango,
                                ];
                                QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);



                                $money2_val= $misyukkoResult[$x]->syukkasu * $misyukkoResult[$x]->dataint04;

                                $money5_val= $misyukkoResult[$x]->yoyakukanousu * $misyukkoResult[$x]->syukkasu ;

                                $money6_val= $misyukkoResult[$x]->sortbango * $misyukkoResult[$x]->syukkasu ;

                                $money7_val= $misyukkoResult[$x]->dataint01 * $misyukkoResult[$x]->syukkasu ;

                                $money8_val= $misyukkoResult[$x]->yoyakusu * $misyukkoResult[$x]->syukkasu ;

                                $money4_val= $money2_val - ($money5_val + $money6_val + $money7_val + $money8_val);

//        dd($money2_val,$money4_val,$money5_val,$money6_val,$money7_val,$money8_val);


                                //rounding pattern fetch
                                $lengthOfRoundingPattern = strlen($misyukkoResult[$x]->roundingpattern);
                                $lastCharPosition = $lengthOfRoundingPattern-1;

                                $roundingPattern1stPart= substr($misyukkoResult[$x]->roundingpattern, 0, -1);
                                $roundingPattern2ndPart= $misyukkoResult[$x]->roundingpattern[$lastCharPosition];
//dd($roundingPattern1stPart,$roundingPattern2ndPart);
                                $finalRoundingPattern=QueryHelper::fetchSingleResult("select distinct
                            category2
                            from categorykanri
                            where category1::text like '%$roundingPattern1stPart%'
                            and category2::text like '%$roundingPattern2ndPart%'");

                                //tax pattern fetch
                                $taxPattern1stPart = substr($misyukkoResult[$x]->taxpattern,0,2);
                                $taxPattern2ndPart = substr($misyukkoResult[$x]->taxpattern,2);
                                $taxRatePatternsub2=QueryHelper::fetchSingleResult("select distinct
                            patternsub2
                            from categorykanri
                            where category1::text like '%$taxPattern1stPart%'
                            and category2::text like '%$taxPattern2ndPart%'");
//        dd($taxRatePatternsub2);

                                $priceWithTax =(substr(str_replace('.','',number_format((float)$taxRatePatternsub2->patternsub2/100, 2, '.', '')),0,2)/100) * $money2_val;
//                            dd($priceWithTax);
//        $priceWithTax= 2400.4;
                                if (is_float($priceWithTax)==true){
                                    if ($finalRoundingPattern->category2==1){
                                        $priceWithTax_val= intval(round($priceWithTax));
//                dd("round",$priceWithTax_val);
                                    }
                                    elseif ($finalRoundingPattern->category2==2){
                                        $priceWithTax_val= intval(floor($priceWithTax));
//                dd("floor",$priceWithTax_val);
                                    }
                                    elseif ($finalRoundingPattern->category2==3){
                                        $priceWithTax_val = intval(ceil($priceWithTax)) ;
//                dd("ceil",$priceWithTax_val);
                                    }
                                }
                                else{
                                    $priceWithTax_val=$priceWithTax;
//                                dd($priceWithTax_val,$priceWithTax);
                                }

//        dd($priceWithTax_val,$priceWithTax,$finalRoundingPattern->category2);
                                $sDT = Carbon::now();
                                $systemDateTime_val=$sDT->toDateString().' '.$sDT->toTimeString();

//dd($systemDateTime_val,static::getCurrentTime());

//dd($systemDateTime);
                                $orderhenkandatachar05=$misyukkoResult[$x]->orderhenkandatachar05;
                                $tantousyaSyozoku= QueryHelper::fetchSingleResult("select distinct
                            syozoku
                            from tantousya
                            where bango::text like '%$orderhenkandatachar05%'");

                                if ($misyukkoResult[$x]->data52!='C710'){
                                    $datatxt0123_val=$misyukkoResult[$x]->data104;
                                }elseif (substr($tantousyaSyozoku->syozoku,0,1)=='1'){
                                    $datatxt0123_val='00000101001';
                                }else{
                                    $datatxt0123_val='00000102001';
                                }

                                $bumon1stpart= substr($misyukkoResult[$x]->bumon,0,2);
                                $bumon2ndtpart= substr($misyukkoResult[$x]->bumon,2);
//        dd($bumon1stpart,$bumon2ndtpart);
                                $patternsub2_val=QueryHelper::fetchSingleResult("select distinct
                            patternsub2
                            from categorykanri
                            where category1::text like '%$bumon1stpart%'
                            and category2::text like '%$bumon2ndtpart%'");
//dd($patternsub2_val);

                                if ($patternsub2_val->patternsub2=='0'){
                                    $patternsub2_val=12;
                                }else{
                                    $patternsub2_val=$patternsub2_val->patternsub2;
                                }

                                $subIntorder03= substr($misyukkoResult[$x]->intorder03,4,2);

                                if ($subIntorder03==12){
                                    $modifiedIntorder03_val=substr($misyukkoResult[$x]->intorder03,0,4).'-01-'.'01'.' 00:00:00';
                                }else{
                                    $monthPuls1=$subIntorder03+1;
                                    if (strlen($monthPuls1)==1)
                                    {
                                        $monthPuls1='0' . $monthPuls1;
                                    }
                                    else{
                                        $monthPuls1=$subIntorder03+1;
                                    }

                                    $modifiedIntorder03_val=substr($misyukkoResult[$x]->intorder03,0,4).'-'.$monthPuls1.'-'.'01'.' 00:00:00';
                                }
//                            dd($subIntorder03,$misyukkoResult[$x]->intorder03,$modifiedIntorder03_val);
                                $modifydate0003 = date('Y-m-d', strtotime("+".$patternsub2_val." months", strtotime($modifiedIntorder03_val)));
                                $date0003_val=date('Y-m-d', strtotime("-1 day", strtotime($modifydate0003))).' 00:00:00';
//            dd($subIntorder03,$modifiedIntorder03_val,strlen($subIntorder03+1),$monthPuls1);

                                //juchusyukko update data(juchu to teiki)

                                $juchusyukko_update=[
                                    'hantei'=> $misyukkoResult[$x]->hantei,
                                    'syouhinsyu'=> $misyukkoResult[$x]->syouhinsyu,
                                    'syouhinid'=> $orderEntry,
                                    'datachar01'=> 1
                                ];

                                $misyukko_update=[
                                    'kawasename'=> $misyukkoResult[$x]->kawasename,
                                    'idoutanabango'=> $misyukkoResult[$x]->idoutanabango,
                                    'syouhinid'=> $orderEntry,
                                    'datachar21'=> $kokyakuorderbango
                                ];

//                dd($juchusyukko_update);
                                QueryHelper::updateData('juchusyukko', $juchusyukko_update, ['syouhinid' => $orderEntry, 'syouhinsyu' => $misyukkoResult[$x]->syouhinsyu, 'hantei' => $misyukkoResult[$x]->hantei], $bango, __CLASS__, __FUNCTION__, __LINE__);
                                QueryHelper::updateData('misyukko', $misyukko_update, ['kawasename' => $misyukkoResult[$x]->kawasename, 'idoutanabango' => $misyukkoResult[$x]->idoutanabango, 'syouhinid' => $orderEntry], $bango, __CLASS__, __FUNCTION__, __LINE__);

                                //kanryoubi val
                                $kanryoubi_val=self::getMonthPlusOneVal($patternsub2_val,$modifiedIntorder03_val,null,null,0);

                                /*$date0002='2020-11-01 00:00:00';
                                $date0003='2021-10-31 00:00:00';*/
                                //datachar29_val
//            $datachar29_val=self::getMonthPlusOneVal($patternsub2_val,null,$date0002,$date0003,1);
                                $datachar29_val=self::getMonthPlusOneVal($patternsub2_val,null,$modifiedIntorder03_val,$date0003_val,1);
//dd($datachar29_val);
                                //datachar08_val
//            $datachar08_val=self::getMonthPlusOneVal($patternsub2_val,null,$date0002,$date0003,2);
                                $datachar08_val=self::getMonthPlusOneVal($patternsub2_val,null,$modifiedIntorder03_val,$date0003_val,2);

                                //genka_val
//            $genka_val=self::getMonthPlusOneVal($patternsub2_val,null,$date0002,null,3);
                                $genka_val=self::getMonthPlusOneVal($patternsub2_val,null,$modifiedIntorder03_val,null,3);
//dd($modifiedIntorder03_val,$genka_val[0]);
                                //season_val
//            $season_val=self::getMonthPlusOneVal($patternsub2_val,null,$date0002,$date0003,4);
                                $season_val=self::getMonthPlusOneVal($patternsub2_val,null,$modifiedIntorder03_val,$date0003_val,4);

//            dd($kanryoubi_val,$datachar29_val,$datachar08_val,$genka_val,$season_val);
                                //$datachar29_val,$datachar08_val


                                //money2 syouhizeiritu val
                                $money2_val_syouhizeiritu=self::getSoukosyukkoMoneyVal($money2_val,$patternsub2_val,$misyukkoResult[$x]->syukkasu);
                                $money2_val_2nd_condition=explode('.',$money2_val_syouhizeiritu[0])[0];
                                $money2_val_2nd_final=explode('.',$money2_val_syouhizeiritu[1])[0];
//                dd($money2_val_2nd_condition,$money2_val_2nd_final);

                                //money3(priceWithTax_val) soukobango val
                                $priceWithTax_val_2nd_condition = $priceWithTax_val /  $patternsub2_val;
//                dd($priceWithTax_val_soukobango_1st);
                                if (is_float($priceWithTax_val_2nd_condition)==true){
                                    if ($finalRoundingPattern->category2==1){
                                        $priceWithTax_val_2nd_condition = intval(round($priceWithTax_val_2nd_condition));
//                dd("round",$priceWithTax_val_soukobango);
                                    }
                                    elseif ($finalRoundingPattern->category2==2){
                                        $priceWithTax_val_2nd_condition= intval(floor($priceWithTax_val_2nd_condition));
//                dd("floor",$priceWithTax_val_soukobango);
                                    }
                                    elseif ($finalRoundingPattern->category2==3){
                                        $priceWithTax_val_2nd_condition = intval(ceil($priceWithTax_val_2nd_condition)) ;
//                dd("ceil",$priceWithTax_val_soukobango);
                                    }
                                }
                                $priceWithTax_val_2nd_final= $priceWithTax_val -  (($patternsub2_val - 1) * $priceWithTax_val_2nd_condition);
//                dd($priceWithTax_val_soukobango_1st,$priceWithTax_val_soukobango_final);

                                //money4 syukkomotobango val
                                $money4_val_syukkomotobango=self::getSoukosyukkoMoneyVal($money4_val,$patternsub2_val,$misyukkoResult[$x]->syukkasu);
                                $money4_val_2nd_condition=explode('.',$money4_val_syukkomotobango[0])[0];
                                $money4_val_2nd_final=explode('.',$money4_val_syukkomotobango[1])[0];
//                dd($money4_val,$money4_val_2nd_condition,$money4_val_2nd_final);
                                //money5 syukkameter val
                                $money5_val_syukkameter=self::getSoukosyukkoMoneyVal($money5_val,$patternsub2_val,$misyukkoResult[$x]->syukkasu);
                                $money5_val_2nd_condition=explode('.',$money5_val_syukkameter[0])[0];
                                $money5_val_2nd_final=explode('.',$money5_val_syukkameter[1])[0];
//                dd($money5_val,$money5_val_2nd_condition,$money5_val_2nd_final);

                                //money6 zaikometer val
                                $money6_val_zaikometer=self::getSoukosyukkoMoneyVal($money6_val,$patternsub2_val,$misyukkoResult[$x]->syukkasu);
                                $money6_val_2nd_condition=explode('.',$money6_val_zaikometer[0])[0];
                                $money6_val_2nd_final=explode('.',$money6_val_zaikometer[1])[0];
//                dd($money6_val,$money6_val_2nd_condition,$money6_val_2nd_final);

                                //money7 seikyubango val
                                $money7_val_seikyubango=self::getSoukosyukkoMoneyVal($money7_val,$patternsub2_val,$misyukkoResult[$x]->syukkasu);
                                $money7_val_2nd_condition=explode('.',$money7_val_seikyubango[0])[0];
                                $money7_val_2nd_final=explode('.',$money7_val_seikyubango[1])[0];
//                dd($money7_val,$money7_val_2nd_condition,$money7_val_2nd_final);

                                //money8 denpyobango val
                                $money8_val_denpyobango=self::getSoukosyukkoMoneyVal($money8_val,$patternsub2_val,$misyukkoResult[$x]->syukkasu);
                                $money8_val_2nd_condition=explode('.',$money8_val_denpyobango[0])[0];
                                $money8_val_2nd_final=explode('.',$money8_val_denpyobango[1])[0];
//                dd($money8_val,$money8_val_2nd_condition,$money8_val_2nd_final);

//            dd($kanryoubi_val);

                                for ($n = 0; $n <= $patternsub2_val + 1; $n++) {


                                    if ($n==0 || $n==1){
//                    echo('1');

                                        if ($n==0){
                                            $soukosyukko_insert_data=[
                                                'orderbango' => $orderHenkan->bango,
                                                'datachar02' => $misyukkoResult[$x]->datachar02,
                                                'kawasename' => $misyukkoResult[$x]->kawasename,
                                                'datachar05' => $misyukkoResult[$x]->misyukkodatachar05,
                                                'syukkasu' => $misyukkoResult[$x]->syukkasu,
                                                'codename' => $misyukkoResult[$x]->codename,
                                                'datachar03' => $misyukkoResult[$x]->misyukkodatachar03,
                                                'datachar04' => $misyukkoResult[$x]->datachar04,
                                                'dataint09' => $misyukkoResult[$x]->dataint09,
                                                'dataint10' => $misyukkoResult[$x]->dataint10,
                                                'datachar06' => $misyukkoResult[$x]->datachar06,
                                                'datachar07' => $misyukkoResult[$x]->datachar07,
                                                'datachar09' => $misyukkoResult[$x]->datachar09,

                                                'hanbaibukacd' => $kokyakuorderbango,
                                                'syouhinname' => $misyukkoResult[$x]->syouhinname,
                                                'syouhinbango' => 1,
                                                'yoteisu' => $n,
                                                'kingaku' => 1,
                                                'genka' => $genka_val[$n],
                                                'kanryoubi' => $kanryoubi_val[$n],
                                                'syouhinid' => null,
                                                'syouhinsyu' => null,
                                                'hantei' => null,
                                                'denpyohakkoubi' => $kanryoubi_val[$n],
                                                'syouhizeiritu' => $money2_val,
                                                'soukobango' => $priceWithTax_val,
                                                'syukkomotobango' => $money4_val,
                                                'syukkameter' => $money5_val,
                                                'zaikometer' => $money6_val,
                                                'seikyubango' => $money7_val,
                                                'denpyobango' => $money8_val,
                                                'datachar08' => $datachar08_val[$n],
                                                'season' => $season_val[$n],
                                                'datachar29' => $datachar29_val[$n],
                                                'nengetsu' => null,
                                                'weeks' => null,
                                                'recordnumber' => null,
                                                'tankano' => null,
                                                'day' => null,

                                                'tanka' => null,
                                                'yoteimeter' => 0,
                                                'denpyoshimebi' => $systemDateTime_val,
                                                'yoyakubi' => null,
                                                'syouhinbukacd' => $misyukkoResult[$x]->tantousyabango,
                                                'kaiinid' => 'U122'
                                            ];
                                        }
                                        elseif ($n==1){
                                            $soukosyukko_insert_data=[
                                                'orderbango' => $orderHenkan->bango,
                                                'datachar02' => $misyukkoResult[$x]->datachar02,
                                                'kawasename' => $misyukkoResult[$x]->kawasename,
                                                'datachar05' => $misyukkoResult[$x]->misyukkodatachar05,
                                                'syukkasu' => $misyukkoResult[$x]->syukkasu,
                                                'codename' => $misyukkoResult[$x]->codename,
                                                'datachar03' => $misyukkoResult[$x]->misyukkodatachar03,
                                                'datachar04' => $misyukkoResult[$x]->datachar04,
                                                'dataint09' => $misyukkoResult[$x]->dataint09,
                                                'dataint10' => $misyukkoResult[$x]->dataint10,
                                                'datachar06' => $misyukkoResult[$x]->datachar06,
                                                'datachar07' => $misyukkoResult[$x]->datachar07,
                                                'datachar09' => $misyukkoResult[$x]->datachar09,

                                                'hanbaibukacd' => $kokyakuorderbango,
                                                'syouhinname' => $misyukkoResult[$x]->syouhinname,
                                                'syouhinbango' => 1,
                                                'yoteisu' => $n,
                                                'kingaku' => 1,
                                                'genka' => $genka_val[$n],
                                                'kanryoubi' => $kanryoubi_val[$n],
                                                'syouhinid' => null,
                                                'syouhinsyu' => null,
                                                'hantei' => null,
                                                'denpyohakkoubi' => $kanryoubi_val[$n],
                                                'syouhizeiritu' => $money2_val_2nd_condition,
                                                'soukobango' => $priceWithTax_val_2nd_condition,
                                                'syukkomotobango' => $money4_val_2nd_condition,
                                                'syukkameter' => $money5_val_2nd_condition,
                                                'zaikometer' => $money6_val_2nd_condition,
                                                'seikyubango' => $money7_val_2nd_condition,
                                                'denpyobango' => $money8_val_2nd_condition,
                                                'datachar08' => $datachar08_val[$n],
                                                'season' => $season_val[$n],
                                                'datachar29' => $datachar29_val[$n],
                                                'nengetsu' => null,
                                                'weeks' => null,
                                                'recordnumber' => null,
                                                'tankano' => null,
                                                'day' => null,

                                                'tanka' => null,
                                                'yoteimeter' => 0,
                                                'denpyoshimebi' => $systemDateTime_val,
                                                'yoyakubi' => null,
                                                'syouhinbukacd' => $misyukkoResult[$x]->tantousyabango,
                                                'kaiinid' => 'U123'
                                            ];
                                        }
                                        array_push($soukosyukkoIndertDataArr,$soukosyukko_insert_data);
                                        $soukosyukko = QueryHelper::insertData('soukosyukko',$soukosyukko_insert_data,'orderbango',false,$bango,__CLASS__,__FUNCTION__,__LINE__);
                                        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### flatrateCreateDataSoukosyukkoDataInstert \n";
                                        QueryHandler::logger($bango, $log_data);
                                        pg_query($conn, 'COMMIT');
                                    }
                                    else if ($n<$patternsub2_val){
//                    echo('2');

                                        $soukosyukko_insert_data=[
                                            'orderbango' => $orderHenkan->bango,
                                            'datachar02' => $misyukkoResult[$x]->datachar02,
                                            'kawasename' => $misyukkoResult[$x]->kawasename,
                                            'datachar05' => $misyukkoResult[$x]->misyukkodatachar05,
                                            'syukkasu' => $misyukkoResult[$x]->syukkasu,
                                            'codename' => $misyukkoResult[$x]->codename,
                                            'datachar03' => $misyukkoResult[$x]->misyukkodatachar03,
                                            'datachar04' => $misyukkoResult[$x]->datachar04,
                                            'dataint09' => $misyukkoResult[$x]->dataint09,
                                            'dataint10' => $misyukkoResult[$x]->dataint10,
                                            'datachar06' => $misyukkoResult[$x]->datachar06,
                                            'datachar07' => $misyukkoResult[$x]->datachar07,
                                            'datachar09' => $misyukkoResult[$x]->datachar09,

                                            'hanbaibukacd' => $kokyakuorderbango,
                                            'syouhinname' => $misyukkoResult[$x]->syouhinname,
                                            'syouhinbango' => 1,
                                            'yoteisu' => $n,
                                            'kingaku' => 1,
                                            'genka' => $genka_val[$n],
                                            'kanryoubi' => $kanryoubi_val[$n],
                                            'syouhinid' => null,
                                            'syouhinsyu' => null,
                                            'hantei' => null,
                                            'denpyohakkoubi' => $kanryoubi_val[$n],
                                            'syouhizeiritu' => $money2_val_2nd_condition,
                                            'soukobango' => $priceWithTax_val_2nd_condition,
                                            'syukkomotobango' => $money4_val_2nd_condition,
                                            'syukkameter' => $money5_val_2nd_condition,
                                            'zaikometer' => $money6_val_2nd_condition,
                                            'seikyubango' => $money7_val_2nd_condition,
                                            'denpyobango' => $money8_val_2nd_condition,
                                            'datachar08' => $datachar08_val[$n],
                                            'season' => $season_val[$n],
                                            'datachar29' => $datachar29_val[$n],
                                            'nengetsu' => null,
                                            'weeks' => null,
                                            'recordnumber' => null,
                                            'tankano' => null,
                                            'day' => null,

                                            'tanka' => null,
                                            'yoteimeter' => 0,
                                            'denpyoshimebi' => $systemDateTime_val,
                                            'yoyakubi' => null,
                                            'syouhinbukacd' => $misyukkoResult[$x]->tantousyabango,
                                            'kaiinid' => 'U123'
                                        ];
                                        array_push($soukosyukkoIndertDataArr,$soukosyukko_insert_data);
                                        $soukosyukko = QueryHelper::insertData('soukosyukko',$soukosyukko_insert_data,'orderbango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                                        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### flatrateCreateDataSoukosyukkoDataInstert \n";
                                        QueryHandler::logger($bango, $log_data);
                                        pg_query($conn, 'COMMIT');
                                    }
                                    else if ($n<$patternsub2_val + 1){
//                    echo('3');
                                        $soukosyukko_insert_data=[
                                            'orderbango' => $orderHenkan->bango,
                                            'datachar02' => $misyukkoResult[$x]->datachar02,
                                            'kawasename' => $misyukkoResult[$x]->kawasename,
                                            'datachar05' => $misyukkoResult[$x]->misyukkodatachar05,
                                            'syukkasu' => $misyukkoResult[$x]->syukkasu,
                                            'codename' => $misyukkoResult[$x]->codename,
                                            'datachar03' => $misyukkoResult[$x]->misyukkodatachar03,
                                            'datachar04' => $misyukkoResult[$x]->datachar04,
                                            'dataint09' => $misyukkoResult[$x]->dataint09,
                                            'dataint10' => $misyukkoResult[$x]->dataint10,
                                            'datachar06' => $misyukkoResult[$x]->datachar06,
                                            'datachar07' => $misyukkoResult[$x]->datachar07,
                                            'datachar09' => $misyukkoResult[$x]->datachar09,

                                            'hanbaibukacd' => $kokyakuorderbango,
                                            'syouhinname' => $misyukkoResult[$x]->syouhinname,
                                            'syouhinbango' => 1,
                                            'yoteisu' => $n,
                                            'kingaku' => 1,
                                            'genka' => $genka_val[$n],
                                            'kanryoubi' => $kanryoubi_val[$n],
                                            'syouhinid' => null,
                                            'syouhinsyu' => null,
                                            'hantei' => null,
                                            'denpyohakkoubi' => $kanryoubi_val[$n],
                                            'syouhizeiritu' => $money2_val_2nd_final,
                                            'soukobango' => $priceWithTax_val_2nd_final,
                                            'syukkomotobango' => $money4_val_2nd_final,
                                            'syukkameter' => $money5_val_2nd_final,
                                            'zaikometer' => $money6_val_2nd_final,
                                            'seikyubango' => $money7_val_2nd_final,
                                            'denpyobango' => $money8_val_2nd_final,
                                            'datachar08' => $datachar08_val[$n],
                                            'season' => $season_val[$n],
                                            'datachar29' => $datachar29_val[$n],
                                            'nengetsu' => null,
                                            'weeks' => null,
                                            'recordnumber' => null,
                                            'tankano' => null,
                                            'day' => null,

                                            'tanka' => null,
                                            'yoteimeter' => 0,
                                            'denpyoshimebi' => $systemDateTime_val,
                                            'yoyakubi' => null,
                                            'syouhinbukacd' => $misyukkoResult[$x]->tantousyabango,
                                            'kaiinid' => 'U123'
                                        ];
                                        array_push($soukosyukkoIndertDataArr,$soukosyukko_insert_data);
                                        $soukosyukko = QueryHelper::insertData('soukosyukko',$soukosyukko_insert_data,'orderbango',false,$bango,__CLASS__,__FUNCTION__,__LINE__);
                                        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### flatrateCreateDataSoukosyukkoDataInstert\n";
                                        QueryHandler::logger($bango, $log_data);
                                        pg_query($conn, 'COMMIT');
                                    }
                                }

                                for ($n = 0; $n <= $patternsub2_val; $n++){
                                    if ($n==0){
                                        $juchusyukko_insert_data=[
                                            'orderbango' => $orderHenkan->bango,
                                            'hanbaibukacd' => $kokyakuorderbango,
                                            'dataint18' => 1,
                                            'dataint19' => $n,
                                            'dataint20' => 1,
                                            'datachar24' => 1,
                                            'datachar25' => 2,
                                            'datachar26' => 2,
                                            'datachar27' => 2,
                                            'dataint21' => null,
                                            'dataint22' => null,
                                            'datachar28' => null,
                                            'datachar29' => null,

                                            'dataint23' => null,
                                            'dataint24' => null,
                                            'dataint25' => 0,
                                            'recordnumber' => $systemDateTime_val,
                                            'tankano' => null,
                                            'syouhinbukacd' => $misyukkoResult[$x]->tantousyabango,
                                        ];
                                        $juchusyukko = QueryHelper::insertData('juchusyukko',$juchusyukko_insert_data,'orderbango',false,$bango,__CLASS__,__FUNCTION__,__LINE__);
                                        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### flatrateCreateDatajuchusyukkoDataInstert \n";
                                        QueryHandler::logger($bango, $log_data);
                                        pg_query($conn, 'COMMIT');
                                    }
                                    else{
                                        $juchusyukko_insert_data=[
                                            'orderbango' => $orderHenkan->bango,
                                            'hanbaibukacd' => $kokyakuorderbango,
                                            'dataint18' => 1,
                                            'dataint19' => $n,
                                            'dataint20' => 1,
                                            'datachar24' => 1,
                                            'datachar25' => 2,
                                            'datachar26' => 2,
                                            'datachar27' => 2,
                                            'dataint21' => null,
                                            'dataint22' => null,
                                            'datachar28' => null,
                                            'datachar29' => null,

                                            'dataint23' => null,
                                            'dataint24' => null,
                                            'dataint25' => 0,
                                            'recordnumber' => $systemDateTime_val,
                                            'tankano' => null,
                                            'syouhinbukacd' => $misyukkoResult[$x]->tantousyabango,
                                        ];
                                        $juchusyukko = QueryHelper::insertData('juchusyukko',$juchusyukko_insert_data,'orderbango',false,$bango,__CLASS__,__FUNCTION__,__LINE__);
                                        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### flatrateCreateDatajuchusyukkoDataInstert \n";
                                        QueryHandler::logger($bango, $log_data);
                                        pg_query($conn, 'COMMIT');
                                    }
                                }

                                $tuhanorder_insert_data = [
                                    'orderbango' => $orderHenkan->bango,
                                    'datatxt0110' => $kokyakuorderbango,
                                    'numeric5' => 1,
                                    'datatxt0111' => 1,
                                    'datatxt0112' => 'G110',
                                    'datatxt0113' => $misyukkoResult[$x]->syouhinid,
                                    'numeric6' => $misyukkoResult[$x]->syouhinsyu,
                                    'numeric7' => $misyukkoResult[$x]->hantei,
                                    'information1' => $misyukkoResult[$x]->information1,
                                    'information2' => $misyukkoResult[$x]->information2,
                                    'information3' => $misyukkoResult[$x]->information3,
                                    'information6' => $misyukkoResult[$x]->information6,
                                    'datatxt0114' => null,
                                    'datatxt0115' => null,
                                    'datatxt0116' => $misyukkoResult[$x]->ytoiawsesaiban,
                                    'datatxt0117' => $misyukkoResult[$x]->yetoiawsestart,
                                    'kessaihouhou' => $misyukkoResult[$x]->kessaihouhou,
                                    'housoukubun' => $misyukkoResult[$x]->housoukubun,
                                    'numeric1' => '01',
                                    'otodoketime' => $misyukkoResult[$x]->otodoketime,
                                    'datatxt0118' => null,
                                    'datatxt0119' => null,
                                    'datatxt0120' => null,
                                    'numeric8' => $patternsub2_val,
                                    'numeric9' => 0,
                                    'numeric10' => $patternsub2_val,
                                    'datatxt0121' => 'J410',
                                    'datatxt0122' => 'J310',
                                    'date0002' => $modifiedIntorder03_val,
                                    'date0003' => $date0003_val,
                                    'date0004' => $modifiedIntorder03_val,
                                    'date0005' => $date0003_val,
                                    'datatxt0123' => $datatxt0123_val,
                                    'numericmax' => 1,
                                    'datatxt0124' => $misyukkoResult[$x]->information1,
                                    'money1' => $misyukkoResult[$x]->dataint04,
                                    'money2' => $money2_val,
                                    'money3' => $priceWithTax_val,
                                    'money4' => $money4_val,
                                    'money5' => $money5_val,
                                    'money6' => $money6_val,
                                    'money7' => $money7_val,
                                    'money8' => $money8_val,
                                    'datatxt0125' => null,
                                    'syukei1' => null,
                                    'syukei2' => null,
                                    'datatxt0126' => null,
                                    'datatxt0127' => null,
                                    'syukei3' => null,
                                    'syukei4' => null,
                                    'syukei5' => 0,
                                    'date0006' => $systemDateTime_val,
                                    'date0007' => null,
                                    'datatxt0128' => $misyukkoResult[$x]->tantousyabango,
                                    'datatxt0129' => $misyukkoResult[$x]->orderhenkandatachar03,
                                    /*'datatxt0109' => $orderEntry,*/
                                ];

//            dd($tuhanorder_insert_data);
                                $hikiatesyukko_insert_data=[
                                    'orderbango' => $orderHenkan->bango,
                                    'hanbaibukacd' => $kokyakuorderbango,
                                    'genka' => 1,
                                    'datachar23' => 3,
                                    'datachar24' => null,
                                    'datachar25' => null,
                                    'datachar26' => 2,
                                    'datachar27' => 1,
                                    'datachar28' => 1,
                                    'datachar29' => 2,
                                    'syouhizeiritu' => 2,
                                    'soukobango' => null,
                                    'recordnumber' => null,
                                    'tankano' => null,
                                    'syukkomotobango' => null,
                                    'syukkosakibango' => null,
                                    'nengetsu' => 0,
                                    'kanryoubi' => $systemDateTime_val,
                                    'denpyohakkoubi' => null,
                                    'syouhinbukacd' => $misyukkoResult[$x]->tantousyabango,
                                ];


                                $hikiatesyukko = QueryHelper::insertData('hikiatesyukko', $hikiatesyukko_insert_data, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                                $tuhanorder = QueryHelper::insertData('tuhanorder',$tuhanorder_insert_data,'orderbango',false,$bango,__CLASS__,__FUNCTION__,__LINE__);

                                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### juchu to teiki end end\n";
                                QueryHandler::logger($bango, $log_data);
                                pg_query($conn, 'COMMIT');
                                array_push($orderHenkanBangoArr,$orderHenkan->bango);

                                $tuhanorder_datatxt0113=QueryHelper::fetchResult("select distinct datatxt0113
                                from tuhanorder
                                where orderbango = '$orderHenkan->bango'");
                                /*dd($tuhanorder_datatxt0113);*/
                                $orderHenkan_intorder01_flag_arr=[];
                                if ($tuhanorder_datatxt0113[0]->datatxt0113 != null){
                                    $orderHenkanSyouhinid=$misyukkoResult[$x]->syouhinid;
                                    $orderHenkan_intorder01=QueryHelper::fetchResult("select distinct intorder01
                                    from orderhenkan
                                    where kokyakuorderbango = '$orderHenkanSyouhinid'");
//                                    dd($orderHenkan_intorder01[0]->intorder01);
                                    if ($orderHenkan_intorder01[0]->intorder01 != null){
                                        array_push($orderHenkan_intorder01_flag_arr,1);
                                        array_push($orderHenkan_intorder01_flag_arr,$orderHenkan_intorder01[0]->intorder01);
                                    }
                                    else{
                                        array_push($orderHenkan_intorder01_flag_arr,0);
                                    }
                                }
//                                dd($orderHenkan_intorder01_flag_arr);

//                    flat rate to order entry (teiki to juchu)

                                if($patternsub2_val>1){

                                    $misyukko_dataint11_val= $misyukkoResult[$x]->syukkasu * intval(round($money2_val/$misyukkoResult[$x]->syukkasu));

                                    $misyukko_dataint12_val= $misyukko_dataint11_val - (intval(round($money5_val/$misyukkoResult[$x]->syukkasu)) + intval(round($money6_val/$misyukkoResult[$x]->syukkasu)) + intval(round($money7_val/$misyukkoResult[$x]->syukkasu)) + intval(round($money8_val/$misyukkoResult[$x]->syukkasu))) * $misyukkoResult[$x]->syukkasu;


                                    for ($n = 0; $n <= $patternsub2_val; $n++) {

                                        $intorder05_val = self::getIntorder05Val($kanryoubi_val[$n], $misyukkoResult[$x]->flag_check0, $misyukkoResult[$x]->flag_check1,$misyukkoResult[$x]->ytoiawsesaiban, $misyukkoResult[$x]->yetoiawsestart);



                                        if ($n>0){
                                            $kokyakuorderbango2nd=self::getKokyakuOrderBango2nd();
                                        }


                                        /*if ($n==0){

                                            $orderHenkan_insert_data = [
                                                'kokyakuorderbango' => $kokyakuorderbango2nd,
                                                'ordertypebango2' => 0,
                                                'datachar01' => 1,
                                                'datachar02' => 'U122',
                                                'datachar06' => 0,
                                                'datachar03' => null,
                                                'datachar04' => null,
                                                'datachar05' => $misyukkoResult[$x]->orderhenkandatachar05,
                                                'intorder01' => substr(str_replace('-','',$kanryoubi_val[$n]),0,8),
                                                'intorder02' => null,
                                                'intorder03' => substr(str_replace('-','',$kanryoubi_val[$n]),0,8),
                                                'intorder04' => substr(str_replace('-','',$kanryoubi_val[$n]),0,8),
                                                'intorder05' => $intorder05_val,//complex date calculation
                                                'ordertypebango' => null,
                                                'synchroorderbango2' => null,
                                                'datachar14' => null,
                                                'datachar11' => null,
                                                'datachar12' => null,
                                                'datachar13' => null,
                                                'synchroorderbango' => 0,
                                                'date' => $systemDateTime_val,
                                                'orderuserbango' => $bango,
                                                'datachar08' => null,
                                                'datachar09' => null,
                                            ];


                                        }*/
                                        if($n>0){

                                            //if orderHenkan intorder01 value exist
                                            if ($orderHenkan_intorder01_flag_arr == null){
                                                $orderHenkan_insert_data = [

                                                    'kokyakuorderbango' => $kokyakuorderbango2nd,
                                                    'ordertypebango2' => 0,
                                                    'datachar01' => 1,
                                                    'datachar02' => 'U123',
                                                    'datachar06' => 0,
                                                    'datachar03' => null,
                                                    'datachar04' => null,
                                                    'datachar05' => $misyukkoResult[$x]->orderhenkandatachar05,
                                                    'intorder01' => substr(str_replace('-','',$kanryoubi_val[$n]),0,8),
                                                    'intorder02' => substr(str_replace('-','',$kanryoubi_val[$n]),0,8),
                                                    'intorder03' => substr(str_replace('-','',$kanryoubi_val[$n]),0,8),
                                                    'intorder04' => substr(str_replace('-','',$kanryoubi_val[$n]),0,8),
                                                    'intorder05' => $intorder05_val,//complex date calculation
                                                    'ordertypebango' => null,
                                                    'synchroorderbango2' => null,
                                                    'datachar14' => null,
                                                    'datachar11' => null,
                                                    'datachar12' => null,
                                                    'datachar13' => null,
                                                    'synchroorderbango' => 0,
                                                    'date' => $systemDateTime_val,
                                                    'orderuserbango' => $bango,
                                                    'datachar08' => null,
                                                    'datachar09' => null,

                                                ];
                                            }
                                            else{
                                                if ($orderHenkan_intorder01_flag_arr[0]==1){
                                                    $orderHenkan_insert_data = [

                                                        'kokyakuorderbango' => $kokyakuorderbango2nd,
                                                        'ordertypebango2' => 0,
                                                        'datachar01' => 1,
                                                        'datachar02' => 'U123',
                                                        'datachar06' => 0,
                                                        'datachar03' => null,
                                                        'datachar04' => null,
                                                        'datachar05' => $misyukkoResult[$x]->orderhenkandatachar05,
                                                        'intorder01' => $orderHenkan_intorder01_flag_arr[1],
                                                        'intorder02' => substr(str_replace('-','',$kanryoubi_val[$n]),0,8),
                                                        'intorder03' => substr(str_replace('-','',$kanryoubi_val[$n]),0,8),
                                                        'intorder04' => substr(str_replace('-','',$kanryoubi_val[$n]),0,8),
                                                        'intorder05' => $intorder05_val,//complex date calculation
                                                        'ordertypebango' => null,
                                                        'synchroorderbango2' => null,
                                                        'datachar14' => null,
                                                        'datachar11' => null,
                                                        'datachar12' => null,
                                                        'datachar13' => null,
                                                        'synchroorderbango' => 0,
                                                        'date' => $systemDateTime_val,
                                                        'orderuserbango' => $bango,
                                                        'datachar08' => null,
                                                        'datachar09' => null,

                                                    ];
                                                }
                                                elseif($orderHenkan_intorder01_flag_arr[0]==0){
                                                    $orderHenkan_insert_data = [

                                                        'kokyakuorderbango' => $kokyakuorderbango2nd,
                                                        'ordertypebango2' => 0,
                                                        'datachar01' => 1,
                                                        'datachar02' => 'U123',
                                                        'datachar06' => 0,
                                                        'datachar03' => null,
                                                        'datachar04' => null,
                                                        'datachar05' => $misyukkoResult[$x]->orderhenkandatachar05,
                                                        'intorder01' => substr(str_replace('-','',$kanryoubi_val[$n]),0,8),
                                                        'intorder02' => substr(str_replace('-','',$kanryoubi_val[$n]),0,8),
                                                        'intorder03' => substr(str_replace('-','',$kanryoubi_val[$n]),0,8),
                                                        'intorder04' => substr(str_replace('-','',$kanryoubi_val[$n]),0,8),
                                                        'intorder05' => $intorder05_val,//complex date calculation
                                                        'ordertypebango' => null,
                                                        'synchroorderbango2' => null,
                                                        'datachar14' => null,
                                                        'datachar11' => null,
                                                        'datachar12' => null,
                                                        'datachar13' => null,
                                                        'synchroorderbango' => 0,
                                                        'date' => $systemDateTime_val,
                                                        'orderuserbango' => $bango,
                                                        'datachar08' => null,
                                                        'datachar09' => null,

                                                    ];
                                                }
                                            }



                                        $orderHenkan = QueryHelper::insertData('orderhenkan', $orderHenkan_insert_data, 'bango', true, $bango, __CLASS__, __FUNCTION__, __LINE__);

                                        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### orderHenkan_insert_data for teiki to juchu \n";
                                        QueryHandler::logger($bango, $log_data);
                                        pg_query($conn, 'COMMIT');


                                        $reviewData2 = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7011'");
                                        $orderbango = $reviewData2->orderbango + 1;


                                        $review_update_data = [
                                            'kokyakusyouhinbango' => 'D7011',
                                            'orderbango' => $orderbango,
                                            'check_flag' => 0,
                                            'color' => static::getCurrentTime(),
                                            'size' => Helper::getSystemIP(),
                                            'nickname' => $bango,
                                        ];
                                        QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);

                                        }

                                        if ($n==0 || $n==1){
                                            /*if ($n==0){
                                                $tuhanorder_insert_data = [
                                                    'orderbango' => $orderHenkan->bango,
                                                    'juchubango' => $kokyakuorderbango2nd,
                                                    'information1' => $misyukkoResult[$x]->information1,
                                                    'information2' => $misyukkoResult[$x]->information2,
                                                    'information3' => $misyukkoResult[$x]->information3,
                                                    'information4' => null,
                                                    'information5' => null,
                                                    'information6' => $misyukkoResult[$x]->information6,
                                                    'juchukubun1' => $misyukkoResult[$x]->syouhinname,
                                                    'kessaihouhou' => $misyukkoResult[$x]->kessaihouhou,
                                                    'housoukubun' => $misyukkoResult[$x]->housoukubun,
                                                    'chumonsyajouhou' => 'U27',
                                                    'soufusakijouhou' => 'U34',
                                                    'information7' => null,
                                                    'information8' => null,
                                                    'money10' => $money2_val,
                                                    'moneymax' => $money4_val,
                                                    'otodoketime' => $misyukkoResult[$x]->otodoketime,
                                                    'chumonbango' => $kokyakuorderbango,
                                                ];
                                                $hikiatesyukko_insert_data=[
                                                    'orderbango' => $orderHenkan->bango,
                                                    'syouhinid' => $kokyakuorderbango2nd,
                                                    'datachar01' => 2,
                                                    'datachar02' => $misyukkoResult[$x]->orderhenkandatachar05,
                                                    'datachar03' => null,
                                                    'datachar04' => 2,
                                                    'datachar05' => null,
                                                    'datachar06' => 3,
                                                    'datachar07' => null,
                                                    'datachar08' => 1,
                                                    'datachar09' => 2,
                                                    'datachar10' => 2,
                                                    'yoteimeter' => 0,
                                                    'tanabango' => $systemDateTime_val,
                                                    'idoutanabango' => null,
                                                    'tantousyabango' => $bango
                                                ];
                                                $juchusyukko_insert_data=[
                                                    'orderbango' => $orderHenkan->bango,
                                                    'hanbaibukacd' => $kokyakuorderbango,
                                                    'syouhinid' => $kokyakuorderbango2nd,
                                                    'syouhinsyu' => 1,
                                                    'hantei' => 0,
                                                    'datachar01' => 1,
                                                    'datachar02' => null,
                                                    'datachar03' => 2,
                                                    'datachar04' => null,
                                                    'yoteimeter' => 0,
                                                    'tanabango' => $systemDateTime_val,
                                                    'idoutanabango' => null,
                                                    'tantousyabango' => $bango,
                                                ];
                                                $misyukko_insert_data=[
                                                    'orderbango' => $orderHenkan->bango,
                                                    'syouhinid' => $kokyakuorderbango2nd,
                                                    'hanbaibukacd' => $kokyakuorderbango,
                                                    'syouhinbango' => 1,
                                                    'yoteisu' => $n,
                                                    'syouhinsyu' => 1,
                                                    'hantei' => 0,
                                                    'dataint01' => 0,
                                                    'dataint02' => 1,
                                                    'datachar13' => 2,
                                                    'kawasename' => $misyukkoResult[$x]->kawasename,
                                                    'syouhinname' => $misyukkoResult[$x]->syouhinname,
                                                    'datachar14' => null,
                                                    'barcode' => null,
                                                    'syukkasu' => $misyukkoResult[$x]->syukkasu,
                                                    'codename' => $misyukkoResult[$x]->codename,
                                                    'dataint04' => intval(round($money2_val/$misyukkoResult[$x]->syukkasu)),
                                                    'dataint05' => intval(round($money5_val/$misyukkoResult[$x]->syukkasu)),
                                                    'dataint06' => intval(round($money6_val/$misyukkoResult[$x]->syukkasu)),
                                                    'dataint07' => intval(round($money7_val/$misyukkoResult[$x]->syukkasu)),
                                                    'dataint08' => intval(round($money8_val/$misyukkoResult[$x]->syukkasu)),

                                                    'dataint09' => $misyukkoResult[$x]->dataint09,
                                                    'dataint10' => $misyukkoResult[$x]->dataint10,
                                                    'dataint11' => $misyukko_dataint11_val,
                                                    'dataint12' => $misyukko_dataint12_val,
                                                    'datachar01' => $misyukkoResult[$x]->orderhenkandatachar05,
                                                    'datachar02' => $misyukkoResult[$x]->datachar02,
                                                    'datachar03' => $misyukkoResult[$x]->misyukkodatachar03,
                                                    'datachar04' => $misyukkoResult[$x]->datachar04,
                                                    'datachar05' => $misyukkoResult[$x]->misyukkodatachar05,
                                                    'datachar06' => $misyukkoResult[$x]->datachar06,
                                                    'datachar07' => $misyukkoResult[$x]->datachar07,
                                                    'datachar08' => $datachar08_val[$n],
                                                    'datachar09' => $misyukkoResult[$x]->datachar09,
                                                    'datachar15' => 1,
                                                    'datachar16' => null,
                                                    'datachar17' => null,
                                                    'dataint16' => null,
                                                    'dataint17' => null,

                                                    'dataint18' => null,
                                                    'dataint19' => null,
                                                    'dataint20' => null,
                                                    'datachar21' => $kokyakuorderbango,
                                                    'datachar22' => null,
                                                    'yoteimeter' => 0,
                                                    'tanabango' => $systemDateTime_val,
                                                    'tantousyabango' => $bango,
                                                    'datachar12' => 'E９２',
                                                ];
                                            }*/
                                            if ($n==1){
                                                $tuhanorder_insert_data = [
                                                    'orderbango' => $orderHenkan->bango,
                                                    'juchubango' => $kokyakuorderbango2nd,
                                                    'information1' => $misyukkoResult[$x]->information1,
                                                    'information2' => $misyukkoResult[$x]->information2,
                                                    'information3' => $misyukkoResult[$x]->information3,
                                                    'information4' => null,
                                                    'information5' => null,
                                                    'information6' => $misyukkoResult[$x]->information6,
                                                    'juchukubun1' => $misyukkoResult[$x]->syouhinname,
                                                    'kessaihouhou' => $misyukkoResult[$x]->kessaihouhou,
                                                    'housoukubun' => $misyukkoResult[$x]->housoukubun,
                                                    'chumonsyajouhou' => 'U27',
                                                    'soufusakijouhou' => 'U34',
                                                    'information7' => null,
                                                    'information8' => null,
                                                    'money10' => $money2_val_2nd_condition,
                                                    'moneymax' => $money4_val_2nd_condition,
                                                    'otodoketime' => $misyukkoResult[$x]->otodoketime,
                                                    'chumonbango' => $kokyakuorderbango,
                                                    'datatxt0109' => $orderEntry,

                                                ];
                                                $hikiatesyukko_insert_data=[
                                                    'orderbango' => $orderHenkan->bango,
                                                    'syouhinid' => $kokyakuorderbango2nd,
                                                    'datachar01' => 2,
                                                    'datachar02' => $misyukkoResult[$x]->orderhenkandatachar05,
                                                    'datachar03' => null,
                                                    'datachar04' => 2,
                                                    'datachar05' => null,
                                                    'datachar06' => 2,
                                                    'datachar07' => null,
                                                    'datachar08' => 2,
                                                    'datachar09' => 1,
                                                    'datachar10' => 1,
                                                    'datachar16' => 2,
                                                    'datachar17' => null,
                                                    'datachar18' => null,
                                                    'yoteimeter' => 0,
                                                    'tanabango' => $systemDateTime_val,
                                                    'idoutanabango' => null,
                                                    'tantousyabango' => $bango,

                                                ];
                                                $juchusyukko_insert_data=[
                                                    'orderbango' => $orderHenkan->bango,
                                                    /*'hanbaibukacd' => $kokyakuorderbango,*/
                                                    'syouhinid' => $kokyakuorderbango2nd,
                                                    'syouhinsyu' => 1,
                                                    'hantei' => 0,
                                                    'datachar01' => 1,
                                                    'datachar02' => null,
                                                    'datachar03' => 2,
                                                    'datachar04' => null,
                                                    'yoteimeter' => 0,
                                                    'tanabango' => $systemDateTime_val,
                                                    'idoutanabango' => null,
                                                    'tantousyabango' => $bango,
                                                ];
                                                $misyukko_insert_data=[
                                                    'orderbango' => $orderHenkan->bango,
                                                    'syouhinid' => $kokyakuorderbango2nd,
                                                    'hanbaibukacd' => $kokyakuorderbango,
                                                    'syouhinbango' => 1,
                                                    'yoteisu' => $n,
                                                    'syouhinsyu' => 1,
                                                    'hantei' => 0,
                                                    'dataint01' => 0,
                                                    'dataint02' => 1,
                                                    'datachar13' => 1,
                                                    'kawasename' => $misyukkoResult[$x]->kawasename,
                                                    'syouhinname' => $misyukkoResult[$x]->syouhinname,
                                                    'datachar14' => null,
                                                    'barcode' => null,
                                                    'syukkasu' => $misyukkoResult[$x]->syukkasu,
                                                    'codename' => $misyukkoResult[$x]->codename,
                                                    'dataint04' => intval(round($money2_val_2nd_condition/$misyukkoResult[$x]->syukkasu)),
                                                    'dataint05' => intval(round($money5_val_2nd_condition/$misyukkoResult[$x]->syukkasu)),
                                                    'dataint06' => intval(round($money6_val_2nd_condition/$misyukkoResult[$x]->syukkasu)),
                                                    'dataint07' => intval(round($money7_val_2nd_condition/$misyukkoResult[$x]->syukkasu)),
                                                    'dataint08' => intval(round($money8_val_2nd_condition/$misyukkoResult[$x]->syukkasu)),

                                                    'dataint09' => $misyukkoResult[$x]->dataint09,
                                                    'dataint10' => $misyukkoResult[$x]->dataint10,
                                                    'dataint11' => $misyukko_dataint11_val,
                                                    'dataint12' => $misyukko_dataint12_val,
                                                    'datachar01' => $misyukkoResult[$x]->orderhenkandatachar05,
                                                    'datachar02' => $misyukkoResult[$x]->datachar02,
                                                    'datachar03' => $misyukkoResult[$x]->misyukkodatachar03,
                                                    'datachar04' => $misyukkoResult[$x]->datachar04,
                                                    'datachar05' => $misyukkoResult[$x]->misyukkodatachar05,
                                                    'datachar06' => $misyukkoResult[$x]->datachar06,
                                                    'datachar07' => $misyukkoResult[$x]->datachar07,
                                                    'datachar08' => $datachar08_val[$n],
                                                    'datachar09' => $misyukkoResult[$x]->datachar09,
                                                    'datachar15' => 1,
                                                    'datachar16' => null,
                                                    'datachar17' => null,
                                                    'dataint16' => null,
                                                    'dataint17' => null,

                                                    'dataint18' => null,
                                                    'dataint19' => null,
                                                    'dataint20' => null,
                                                    'datachar21' => $kokyakuorderbango,
                                                    'datachar22' => null,
                                                    'yoteimeter' => 0,
                                                    'tanabango' => static::getCurrentTime(),
                                                    'tantousyabango' => $bango,
                                                    'datachar12' => 'E９２',

                                                ];
                                            }
                                        }
                                        else if ($n!=0 && $n<$patternsub2_val){
                                            $tuhanorder_insert_data = [
                                                'orderbango' => $orderHenkan->bango,
                                                'juchubango' => $kokyakuorderbango2nd,
                                                'information1' => $misyukkoResult[$x]->information1,
                                                'information2' => $misyukkoResult[$x]->information2,
                                                'information3' => $misyukkoResult[$x]->information3,
                                                'information4' => null,
                                                'information5' => null,
                                                'information6' => $misyukkoResult[$x]->information6,
                                                'juchukubun1' => $misyukkoResult[$x]->syouhinname,
                                                'kessaihouhou' => $misyukkoResult[$x]->kessaihouhou,
                                                'housoukubun' => $misyukkoResult[$x]->housoukubun,
                                                'chumonsyajouhou' => 'U27',
                                                'soufusakijouhou' => 'U34',
                                                'information7' => null,
                                                'information8' => null,
                                                'money10' => $money2_val_2nd_condition,
                                                'moneymax' => $money4_val_2nd_condition,
                                                'otodoketime' => $misyukkoResult[$x]->otodoketime,
                                                'chumonbango' => $kokyakuorderbango,
                                                'datatxt0109' => $orderEntry,

                                            ];
                                            $hikiatesyukko_insert_data=[
                                                'orderbango' => $orderHenkan->bango,
                                                'syouhinid' => $kokyakuorderbango2nd,
                                                'datachar01' => 2,
                                                'datachar02' => $misyukkoResult[$x]->orderhenkandatachar05,
                                                'datachar03' => null,
                                                'datachar04' => 2,
                                                'datachar05' => null,
                                                'datachar06' => 2,
                                                'datachar07' => null,
                                                'datachar08' => 2,
                                                'datachar09' => 1,
                                                'datachar10' => 1,
                                                'datachar16' => 2,
                                                'datachar17' => null,
                                                'datachar18' => null,
                                                'yoteimeter' => 0,
                                                'tanabango' => $systemDateTime_val,
                                                'idoutanabango' => null,
                                                'tantousyabango' => $bango,

                                            ];
                                            $juchusyukko_insert_data=[
                                                'orderbango' => $orderHenkan->bango,
                                                /*'hanbaibukacd' => $kokyakuorderbango,*/
                                                'syouhinid' => $kokyakuorderbango2nd,
                                                'syouhinsyu' => 1,
                                                'hantei' => 0,
                                                'datachar01' => 1,
                                                'datachar02' => null,
                                                'datachar03' => 2,
                                                'datachar04' => null,
                                                'yoteimeter' => 0,
                                                'tanabango' => $systemDateTime_val,
                                                'idoutanabango' => null,
                                                'tantousyabango' => $bango,
                                            ];
                                            $misyukko_insert_data=[
                                                'orderbango' => $orderHenkan->bango,
                                                'syouhinid' => $kokyakuorderbango2nd,
                                                'hanbaibukacd' => $kokyakuorderbango,
                                                'syouhinbango' => 1,
                                                'yoteisu' => $n,
                                                'syouhinsyu' => 1,
                                                'hantei' => 0,
                                                'dataint01' => 0,
                                                'dataint02' => 1,
                                                'datachar13' => 1,
                                                'kawasename' => $misyukkoResult[$x]->kawasename,
                                                'syouhinname' => $misyukkoResult[$x]->syouhinname,
                                                'datachar14' => null,
                                                'barcode' => null,
                                                'syukkasu' => $misyukkoResult[$x]->syukkasu,
                                                'codename' => $misyukkoResult[$x]->codename,
                                                'dataint04' => intval(round($money2_val_2nd_condition/$misyukkoResult[$x]->syukkasu)),
                                                'dataint05' => intval(round($money5_val_2nd_condition/$misyukkoResult[$x]->syukkasu)),
                                                'dataint06' => intval(round($money6_val_2nd_condition/$misyukkoResult[$x]->syukkasu)),
                                                'dataint07' => intval(round($money7_val_2nd_condition/$misyukkoResult[$x]->syukkasu)),
                                                'dataint08' => intval(round($money8_val_2nd_condition/$misyukkoResult[$x]->syukkasu)),

                                                'dataint09' => $misyukkoResult[$x]->dataint09,
                                                'dataint10' => $misyukkoResult[$x]->dataint10,
                                                'dataint11' => $misyukko_dataint11_val,
                                                'dataint12' => $misyukko_dataint12_val,
                                                'datachar01' => $misyukkoResult[$x]->orderhenkandatachar05,
                                                'datachar02' => $misyukkoResult[$x]->datachar02,
                                                'datachar03' => $misyukkoResult[$x]->misyukkodatachar03,
                                                'datachar04' => $misyukkoResult[$x]->datachar04,
                                                'datachar05' => $misyukkoResult[$x]->misyukkodatachar05,
                                                'datachar06' => $misyukkoResult[$x]->datachar06,
                                                'datachar07' => $misyukkoResult[$x]->datachar07,
                                                'datachar08' => $datachar08_val[$n],
                                                'datachar09' => $misyukkoResult[$x]->datachar09,
                                                'datachar15' => 1,
                                                'datachar16' => null,
                                                'datachar17' => null,
                                                'dataint16' => null,
                                                'dataint17' => null,

                                                'dataint18' => null,
                                                'dataint19' => null,
                                                'dataint20' => null,
                                                'datachar21' => $kokyakuorderbango,
                                                'datachar22' => null,
                                                'yoteimeter' => 0,
                                                'tanabango' => static::getCurrentTime(),
                                                'tantousyabango' => $bango,
                                                'datachar12' => 'E９２',
                                                /*'idoutanabango' => 2,*/

                                            ];
                                        }
                                        else if ($n!=0 && $n<$patternsub2_val + 1){
                                            $tuhanorder_insert_data = [
                                                'orderbango' => $orderHenkan->bango,
                                                'juchubango' => $kokyakuorderbango2nd,
                                                'information1' => $misyukkoResult[$x]->information1,
                                                'information2' => $misyukkoResult[$x]->information2,
                                                'information3' => $misyukkoResult[$x]->information3,
                                                'information4' => null,
                                                'information5' => null,
                                                'information6' => $misyukkoResult[$x]->information6,
                                                'juchukubun1' => $misyukkoResult[$x]->syouhinname,
                                                'kessaihouhou' => $misyukkoResult[$x]->kessaihouhou,
                                                'housoukubun' => $misyukkoResult[$x]->housoukubun,
                                                'chumonsyajouhou' => 'U27',
                                                'soufusakijouhou' => 'U34',
                                                'information7' => null,
                                                'information8' => null,
                                                'money10' => $money2_val_2nd_final,
                                                'moneymax' => $money4_val_2nd_final,
                                                'otodoketime' => $misyukkoResult[$x]->otodoketime,
                                                'chumonbango' => $kokyakuorderbango,
                                                'datatxt0109' => $orderEntry,

                                            ];
                                            $hikiatesyukko_insert_data=[
                                                'orderbango' => $orderHenkan->bango,
                                                'syouhinid' => $kokyakuorderbango2nd,
                                                'datachar01' => 2,
                                                'datachar02' => $misyukkoResult[$x]->orderhenkandatachar05,
                                                'datachar03' => null,
                                                'datachar04' => 2,
                                                'datachar05' => null,
                                                'datachar06' => 2,
                                                'datachar07' => null,
                                                'datachar08' => 2,
                                                'datachar09' => 1,
                                                'datachar10' => 1,
                                                'datachar16' => 2,
                                                'datachar17' => null,
                                                'datachar18' => null,
                                                'yoteimeter' => 0,
                                                'tanabango' => $systemDateTime_val,
                                                'idoutanabango' => null,
                                                'tantousyabango' => $bango,

                                            ];
                                            $juchusyukko_insert_data=[
                                                'orderbango' => $orderHenkan->bango,
                                                /*'hanbaibukacd' => $kokyakuorderbango,*/
                                                'syouhinid' => $kokyakuorderbango2nd,
                                                'syouhinsyu' => 1,
                                                'hantei' => 0,
                                                'datachar01' => 1,
                                                'datachar02' => null,
                                                'datachar03' => 2,
                                                'datachar04' => null,
                                                'yoteimeter' => 0,
                                                'tanabango' => $systemDateTime_val,
                                                'idoutanabango' => null,
                                                'tantousyabango' => $bango,
                                            ];
                                            $misyukko_insert_data=[
                                                'orderbango' => $orderHenkan->bango,
                                                'syouhinid' => $kokyakuorderbango2nd,
                                                'hanbaibukacd' => $kokyakuorderbango,
                                                'syouhinbango' => 1,
                                                'yoteisu' => $n,
                                                'syouhinsyu' => 1,
                                                'hantei' => 0,
                                                'dataint01' => 0,
                                                'dataint02' => 1,
                                                'datachar13' => 1,
                                                'kawasename' => $misyukkoResult[$x]->kawasename,
                                                'syouhinname' => $misyukkoResult[$x]->syouhinname,
                                                'datachar14' => null,
                                                'barcode' => null,
                                                'syukkasu' => $misyukkoResult[$x]->syukkasu,
                                                'codename' => $misyukkoResult[$x]->codename,
                                                'dataint04' => intval(round($money2_val_2nd_final/$misyukkoResult[$x]->syukkasu)),
                                                'dataint05' => intval(round($money5_val_2nd_final/$misyukkoResult[$x]->syukkasu)),
                                                'dataint06' => intval(round($money6_val_2nd_final/$misyukkoResult[$x]->syukkasu)),
                                                'dataint07' => intval(round($money7_val_2nd_final/$misyukkoResult[$x]->syukkasu)),
                                                'dataint08' => intval(round($money8_val_2nd_final/$misyukkoResult[$x]->syukkasu)),

                                                'dataint09' => $misyukkoResult[$x]->dataint09,
                                                'dataint10' => $misyukkoResult[$x]->dataint10,
                                                'dataint11' => $misyukko_dataint11_val,
                                                'dataint12' => $misyukko_dataint12_val,
                                                'datachar01' => $misyukkoResult[$x]->orderhenkandatachar05,
                                                'datachar02' => $misyukkoResult[$x]->datachar02,
                                                'datachar03' => $misyukkoResult[$x]->misyukkodatachar03,
                                                'datachar04' => $misyukkoResult[$x]->datachar04,
                                                'datachar05' => $misyukkoResult[$x]->misyukkodatachar05,
                                                'datachar06' => $misyukkoResult[$x]->datachar06,
                                                'datachar07' => $misyukkoResult[$x]->datachar07,
                                                'datachar08' => $datachar08_val[$n],
                                                'datachar09' => $misyukkoResult[$x]->datachar09,
                                                'datachar15' => 1,
                                                'datachar16' => null,
                                                'datachar17' => null,
                                                'dataint16' => null,
                                                'dataint17' => null,

                                                'dataint18' => null,
                                                'dataint19' => null,
                                                'dataint20' => null,
                                                'datachar21' => $kokyakuorderbango,
                                                'datachar22' => null,
                                                'yoteimeter' => 0,
                                                'tanabango' => static::getCurrentTime(),
                                                'tantousyabango' => $bango,
                                                'datachar12' => 'E９２',
                                                /*'idoutanabango' => 2,*/

                                            ];
                                        }

                                        if ($n>0){
                                            $tuhanorder = QueryHelper::insertData('tuhanorder',$tuhanorder_insert_data,'orderbango',false,$bango,__CLASS__,__FUNCTION__,__LINE__);
                                            $hikiatesyukko = QueryHelper::insertData('hikiatesyukko', $hikiatesyukko_insert_data, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                                            $misyukko = QueryHelper::insertData('misyukko', $misyukko_insert_data, 'orderbango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                                            $juchusyukko = QueryHelper::insertData('juchusyukko',$juchusyukko_insert_data,'orderbango',false,$bango,__CLASS__,__FUNCTION__,__LINE__);
                                            array_push($orderHenkanBangoArr2,$orderHenkan->bango);

                                            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### tuhanorder_insert_data for teiki to juchu \n";
                                            QueryHandler::logger($bango, $log_data);
                                            pg_query($conn, 'COMMIT');

                                            $soukosyukko_update_data=[
                                                'hanbaibukacd' => $kokyakuorderbango,
                                                'syouhinbango' => 1,
                                                'yoteisu' => $n,
                                                'syouhinid' => $kokyakuorderbango2nd,
                                                'syouhinsyu' => 1,
                                                'hantei' => 0,
                                            ];
                                            QueryHelper::updateData('soukosyukko', $soukosyukko_update_data, ['hanbaibukacd' => $kokyakuorderbango, 'syouhinbango' => 1, 'yoteisu' => $n], $bango, __CLASS__, __FUNCTION__, __LINE__);
                                            $juchusyukko_update_data=[
                                                'orderbango' => $juchusyukko->orderbango,
                                                'dataint18' => null,
                                                'dataint19' => null,
                                                'datachar24' => null,
                                            ];
                                            QueryHelper::updateData('juchusyukko', $juchusyukko_update_data, ['orderbango' => $juchusyukko->orderbango, 'dataint18' => null, 'dataint19' => null], $bango, __CLASS__, __FUNCTION__, __LINE__);
                                        }

                                    }

                                }
                                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### create_data end\n";
                                QueryHandler::logger($bango, $log_data);
                                pg_query($conn, 'COMMIT');

                            }


                        } catch (Exception $e) {
                            dd($e);
                            pg_query($conn, 'ROLLBACK');
                            $status=$e;
                        }
                        $status='ok';
                        $totalCreatedOrderSuccessMsg=
                            '<div class="col-12">' .
                            '<div class="alert alert-primary alert-dismissible">' .
                            '<button type="button" class="close dismissMe" data-dismiss="alert" autofocus' . 'style="background-color: white;"' . ' onclick="$(\'#categorikanri\')'.'.'.'focus()'.';'.'">' .
                            '&times;' .
                            '</button>' .
                            '<strong>正常に処理が終了しました（作成件数='. count($orderHenkanBangoArr2) . '件' . '）'.'</strong>' .
                            '</div>
                          </div>' ;
                        return [$status,$totalCreatedOrderSuccessMsg,$orderHenkanBangoArr,$orderHenkanBangoArr2];
//                    dd('data insert hoic',$orderHenkanBangoArr,$orderHenkanBangoArr2);

                    }
                    else{
                        $status='ng';
                        $errorMsg='<div><p style="color:red;font-size: 12px;margin-bottom: 8px;padding-left: 10px;">販売形態がnullの商品は登録できません。</p></div>';
                        return [$status,$errorMsg];
                    }


                }
                else{
                    dd('no child product exist for',$orderEntry);
                }


            }else{
                dd('misyukko.kawasename did not find for',$orderEntry);
            }

//        dd(QueryHelper::fetchResult("select * from flatrate_misyukko_temp"));

    }

    public static function getKokyakuOrderBango()
    {
        $kokyakubango1stPart = "06";
        $kokyakubango2ndPart = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7501' ")->orderbango ?? null;
        $repeat = QueryHelper::fetchSingleResult("select review.mobile_flag from review where kokyakusyouhinbango = 'D7111' ")->mobile_flag ?? null;
        $kokyakubango3rdPart = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7111' ")->orderbango ?? null;
        $kokyakubango3rdPart = (int)$kokyakubango3rdPart + 1;
        $kokyakubango3rdPart = sprintf('%0' . $repeat . 'd', $kokyakubango3rdPart);
        return $kokyakubango1stPart . '' . $kokyakubango2ndPart . '' . $kokyakubango3rdPart;
    }

    public static function getKokyakuOrderBango2nd()
    {
        $kokyakubango1stPart = "01";
        $kokyakubango2ndPart = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7501' ")->orderbango ?? null;
        $repeat = QueryHelper::fetchSingleResult("select review.mobile_flag from review where kokyakusyouhinbango = 'D7011' ")->mobile_flag ?? null;
        $kokyakubango3rdPart = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7011' ")->orderbango ?? null;
        $kokyakubango3rdPart = (int)$kokyakubango3rdPart + 1;
        $kokyakubango3rdPart = sprintf('%0' . $repeat . 'd', $kokyakubango3rdPart);
        return $kokyakubango1stPart . '' . $kokyakubango2ndPart . '' . $kokyakubango3rdPart;
    }

    public static function getCurrentTime()
    {
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        return str_replace(" ", "", $mytime);
    }

    public static function getSoukosyukkoMoneyVal($money_val,$patternsub2,$syukkasu)
    {
//        dd($patternsub2);
        $money_val_1st= round($money_val / $patternsub2) ;
        $money_val_2nd= round($money_val_1st / $syukkasu) ;
        $money_val_3rd= $money_val_2nd * $syukkasu ;
        $money_val_final= $money_val-(($patternsub2-1)*$money_val_3rd);
        return array($money_val_3rd,$money_val_final) ;
    }

    public static function getMonthPlusOneVal($patternsub2,$modifiedIntorder03_val,$date0002,$date0003,$flag)
    {
        $month_plus_one_val_arr=[];
        $month_plus_one_val_halfwidth_arr=[];
        if ($flag==0){
            for ($n = 0; $n <= $patternsub2 + 1; $n++) {
                if ($n == 0 || $n == 1) {
                    $month_plus_one_val = $modifiedIntorder03_val;
                    array_push($month_plus_one_val_arr, $month_plus_one_val);
                }
                else{
                    $month_plus_one_val = date('Y-m-d', strtotime("+1 month", strtotime($month_plus_one_val_arr[$n-1]))) . ' 00:00:00';
                    array_push($month_plus_one_val_arr, $month_plus_one_val);
                }
            }
        }
        elseif ($flag==1){
            if ($date0002!=null && $date0003!=null){
                //for half width
                for ($n = 0; $n <= $patternsub2 + 1; $n++) {
                    if ($n == 0) {
                        $datachar29_val= substr(str_replace('-','/',$date0002),0,7) . '～' . substr(str_replace('-','/',$date0003),0,7);
                        array_push($month_plus_one_val_arr, $datachar29_val);
                    }
                    elseif($n == 1){
                        $datachar29_val= substr(str_replace('-','/',$date0002),0,7);
                        array_push($month_plus_one_val_arr, $datachar29_val);
                    }
                    else{
//                        dd($month_plus_one_val_arr[$n-1].'/01');
                        $datachar29_val= date('Y/m', strtotime("+1 month", strtotime($month_plus_one_val_arr[$n-1].'/01')));
                        array_push($month_plus_one_val_arr, $datachar29_val);
                    }
                }
                //for full width
                /*for ($n = 0; $n <= $patternsub2 + 1; $n++) {
                    if ($n == 0) {
                        $datachar29_hlfVal = substr(str_replace('-','/',$date0002),0,7) . '~' . substr(str_replace('-','/',$date0003),0,7);
                        $datachar29_val = mb_convert_kana(substr(str_replace('-', '/', $date0002), 0, 7) . '~' . substr(str_replace('-', '/', $date0003), 0, 7), "KVA");
                        array_push($month_plus_one_val_halfwidth_arr, $datachar29_hlfVal);
                        array_push($month_plus_one_val_arr, $datachar29_val);
                    } elseif ($n == 1) {
                        $datachar29_hlfVal = substr(str_replace('-','/',$date0002),0,7);
                        $datachar29_val = mb_convert_kana(substr(str_replace('-', '/', $date0002), 0, 7), "KVA");
                        array_push($month_plus_one_val_halfwidth_arr, $datachar29_hlfVal);
                        array_push($month_plus_one_val_arr, $datachar29_val);
                    } else {
//                        dd($month_plus_one_val_arr[$n-1].'/01');
                        $datachar29_hlfVal= date('Y/m', strtotime("+1 month", strtotime($month_plus_one_val_halfwidth_arr[$n-1].'/01')));
                        $datachar29_val = mb_convert_kana($datachar29_hlfVal, "KVA");
                        array_push($month_plus_one_val_halfwidth_arr, $datachar29_hlfVal);
                        array_push($month_plus_one_val_arr, $datachar29_val);
                    }
                }*/
            }
            else{
                for ($n = 0; $n <= $patternsub2 + 1; $n++) {
                    $datachar29_val=null;
                    array_push($month_plus_one_val_arr, $datachar29_val);
                }
            }
        }
        elseif ($flag==2){
            if ($date0002!=null && $date0003!=null){
                //for half width
                /*for ($n = 0; $n <= $patternsub2 + 1; $n++) {
                    if ($n == 0) {
                        $datachar08_val= substr(str_replace('-','/',$date0002),0,7) . '~' . substr(str_replace('-','/',$date0003),0,7).'分';
//                        dd($datachar08_val);
                        array_push($month_plus_one_val_arr, $datachar08_val);
                    }
                    elseif($n == 1){
                        $datachar08_val= substr(str_replace('-','/',$date0002),0,7).'分';
//                        dd($datachar08_val);
                        array_push($month_plus_one_val_arr, $datachar08_val);
                    }
                    else{
//                        dd($month_plus_one_val_arr[$n-1].'/01');
                        $datachar08_val= date('Y/m', strtotime("+1 month", strtotime(substr($month_plus_one_val_arr[$n-1],0,7).'/01'))).'分';
                        array_push($month_plus_one_val_arr, $datachar08_val);
                    }
                }*/
                //for full width
                for ($n = 0; $n <= $patternsub2 + 1; $n++) {
                    if ($n == 0) {
                        $datachar08_hlfVal = substr(str_replace('-','/',$date0002),0,7) . '~' . substr(str_replace('-','/',$date0003),0,7).'分';
                        $datachar08_val= mb_convert_kana(substr(str_replace('-','/',$date0002),0,7) . '~' . substr(str_replace('-','/',$date0003),0,7).'分','KVA');
//                        dd($datachar08_val);
                        array_push($month_plus_one_val_halfwidth_arr, $datachar08_hlfVal);
                        array_push($month_plus_one_val_arr, $datachar08_val);
                    }
                    elseif($n == 1){
                        $datachar08_hlfVal = substr(str_replace('-','/',$date0002),0,7).'分';
                        $datachar08_val= mb_convert_kana(substr(str_replace('-','/',$date0002),0,7).'分','KVA');
//                        dd($datachar08_val);
                        array_push($month_plus_one_val_halfwidth_arr, $datachar08_hlfVal);
                        array_push($month_plus_one_val_arr, $datachar08_val);
                    }
                    else{
//                        dd($month_plus_one_val_arr[$n-1].'/01');
                        $datachar08_hlfVal = date('Y/m', strtotime("+1 month", strtotime(substr($month_plus_one_val_halfwidth_arr[$n-1],0,7).'/01'))).'分';
                        $datachar08_val = mb_convert_kana($datachar08_hlfVal, "KVA");
                        array_push($month_plus_one_val_halfwidth_arr, $datachar08_hlfVal);
                        array_push($month_plus_one_val_arr, $datachar08_val);
                    }
                }
            }
            else{
                for ($n = 0; $n <= $patternsub2 + 1; $n++) {
                    $datachar08_val=null;
                    array_push($month_plus_one_val_arr, $datachar08_val);
                }
            }
        }
        elseif ($flag==3){
            if ($date0002!=null){
                for ($n = 0; $n <= $patternsub2 + 1; $n++) {
                    /*$genka_val= substr(str_replace('-','',$date0002),0,6);
                    array_push($month_plus_one_val_arr, $genka_val);*/
                    if ($n == 0 || $n == 1) {
                        $genka_val= substr(str_replace('-','',$date0002),0,6);
                        array_push($month_plus_one_val_arr, $genka_val);
                    }
                    else{
                        $date_val= substr($month_plus_one_val_arr[$n-1],0,4) . '/' . substr($month_plus_one_val_arr[$n-1],4,2);
                        $genka_val_date= date('Y/m', strtotime("+1 month", strtotime($date_val.'/01')));
                        $genka_val=str_replace('/','',$genka_val_date);
                        array_push($month_plus_one_val_arr, $genka_val);
                    }
                }
            }
            else{
                for ($n = 0; $n <= $patternsub2 + 1; $n++) {
                    $genka_val=	null;
                    array_push($month_plus_one_val_arr, $genka_val);
                }
            }
        }
        elseif ($flag==4){
            if ($date0002!=null && $date0003!=null){
                for ($n = 0; $n <= $patternsub2 + 1; $n++) {
                    /*$season_val= substr(str_replace('-','',$date0003),0,6);
                    array_push($month_plus_one_val_arr, $season_val);*/
                    if ($n == 0) {
                        $season_val= substr(str_replace('-','',$date0003),0,6);
                        array_push($month_plus_one_val_arr, $season_val);
                    }
                    elseif ($n == 1){
                        $season_val= substr(str_replace('-','',$date0002),0,6);
                        array_push($month_plus_one_val_arr, $season_val);
                    }
                    else{
                        $date_val= substr($month_plus_one_val_arr[$n-1],0,4) . '/' . substr($month_plus_one_val_arr[$n-1],4,2);
                        $season_val_date= date('Y/m', strtotime("+1 month", strtotime($date_val.'/01')));
                        $season_val=str_replace('/','',$season_val_date);
                        array_push($month_plus_one_val_arr, $season_val);
                    }
                }
            }
            else{
                for ($n = 0; $n <= $patternsub2 + 1; $n++) {
                    $season_val=null;
                    array_push($month_plus_one_val_arr, $season_val);
                }
            }
        }
        return $month_plus_one_val_arr;
    }

    public static function getIntorder05Val($kanryoubi, $flag_check0, $flag_check1, $datatxt0116, $datatxt0117)
    {

        /*$datatxt0116='12 当月';*/
        $todaysDate = Carbon::now()->toDateString();
        $todaysYearMonth= substr($todaysDate,0,8);
        $closingDate=substr($todaysDate,0,8).substr($flag_check1,2,2);
//        dd($closingDate<$kanryoubi,$closingDate,$kanryoubi);
        if ($closingDate < $kanryoubi) {
//            dd('kanriobi ajker date thk boro',$todaysDate,'<',$kanryoubi);
            //1 month extra added
            $m = (int)substr($datatxt0116, 0, strrpos($datatxt0116, ' ')) + 1;
        } else {
//            dd('kanriobi ajker date thk choto',$todaysDate,'>',$kanryoubi);
            //no extra month added
            $m = substr($datatxt0116, 0, strrpos($datatxt0116, ' '));
        }
        $add_months = '+' . $m . 'months';
        $expectedDate = date('Y-m-', strtotime($add_months, strtotime($kanryoubi))) . $datatxt0117;
//        dd($expectedDate);


        $isDateExist = checkdate(substr($expectedDate, 5, 2), $datatxt0117, substr($expectedDate, 0, 4));
        $isDateExist=true;
        if ($isDateExist == true) {
            //valid date
//            dd($expectedDate);
            /*$expectedDate='2025-01-03';
            $others2=1;*/
            $holidayCheck= self::holidayCheck($expectedDate,$flag_check0);
//            dd($holidayCheck);
            if ($holidayCheck[1]==true) {

                //with loop start

                $intOrder05_val = '';
                for ($d = 1; $d <= 100; $d++) {
//                    dd(3%2);
                    if ($d % 2 == 1) {
                        $weekendCheck = self::weekendCheck($holidayCheck[0], $flag_check0);
                        if ($weekendCheck[1] == false) {
                            $intOrder05_val = date('Ymd', strtotime($weekendCheck[0]));
                            break;
                        }
                    } elseif ($d % 2 == 0) {
                        $holidayCheck = self::holidayCheck($weekendCheck[0], $flag_check0);
                        if ($holidayCheck[1] == false) {
                            $intOrder05_val = date('Ymd', strtotime($holidayCheck[0]));
                            break;
                        }
                    }

                }

                //with loop end

                //without loop start

//                $weekendCheck= self::weekendCheck($holidayCheck[0],$flag_check0);
//                if ($weekendCheck[1]==false){
//                    $intOrder05_val = date('Ymd',strtotime($weekendCheck[0]));
////                    return $intOrder05_val;
//                }
//                elseif ($weekendCheck[1]==true){
//                    $holidayCheck=self::holidayCheck($weekendCheck[0],$flag_check0);
//                    if ($holidayCheck[1]==true){
//                        $weekendCheck= self::weekendCheck($holidayCheck[0],$flag_check0);
//                        if ($weekendCheck[1]==false || false){
//                            $intOrder05_val = date('Ymd',strtotime($weekendCheck[0]));
////                            return $intOrder05_val;
//                        }
//                        /*elseif ($weekendCheck[1]==true){
//                            //exception
//
//                        }*/
//                    }
//                    elseif($holidayCheck[1]==false){
//                        $intOrder05_val = date('Ymd',strtotime($holidayCheck[0]));
////                    return $intOrder05_val;
//                    }
////                    dd($holidayCheck);
//                }
//            }
                //without loop end

                //without loop end
            }
            elseif($holidayCheck[1]==false){
                //without loop start

//                $weekendCheck= self::weekendCheck($holidayCheck[0],$flag_check0);
//                if ($weekendCheck[1]==false){
//                    $intOrder05_val = date('Ymd',strtotime($weekendCheck[0]));
////                    return $intOrder05_val;
//                }
//                elseif ($weekendCheck[1]==true){
//                    $holidayCheck=self::holidayCheck($weekendCheck[0],$flag_check0);
//                    if ($holidayCheck[1]==true){
//                        $weekendCheck= self::weekendCheck($holidayCheck[0],$flag_check0);
//                        if ($weekendCheck[1]==false || false){
//                            $intOrder05_val = date('Ymd',strtotime($weekendCheck[0]));
////                            return $intOrder05_val;
//                        }
//                        /*elseif ($weekendCheck[1]==true){
//                            //exception
//
//                        }*/
//                    }
//                    elseif($holidayCheck[1]==false){
//                        $intOrder05_val = date('Ymd',strtotime($holidayCheck[0]));
////                    return $intOrder05_val;
//                    }
////                    dd($holidayCheck);
//                }

                //without loop end

                //with loop start
                $intOrder05_val = '';

                for ($d = 1; $d <= 100; $d++) {
//                    dd(3%2);
                    if ($d % 2 == 1) {
                        $weekendCheck = self::weekendCheck($holidayCheck[0], $flag_check0);
                        if ($weekendCheck[1] == false) {
                            $intOrder05_val = date('Ymd', strtotime($weekendCheck[0]));
                            break;
                        }
                    } elseif ($d % 2 == 0) {
                        $holidayCheck = self::holidayCheck($weekendCheck[0], $flag_check0);
                        if ($holidayCheck[1] == false) {
                            $intOrder05_val = date('Ymd', strtotime($holidayCheck[0]));
                            break;
                        }
                    }

                }
                //with loop end
            }


        } else {
            //invalid date
//            $date='2021-05-08';
            $expectedDate= date('Y-m-d', strtotime("-1 day", strtotime($expectedDate)));
            $weekendCheck= self::weekendCheck($expectedDate,$flag_check0);
            $intOrder05_val= date('Ymd',strtotime($weekendCheck[0]));
//            dd($intOrder05_val);
        }

//        dd($expectedDate,$kanryoubi,$datatxt0116,$flag_check0,$flag_check1,$datatxt0117,$isDateExist);
        return $intOrder05_val;
    }

    public static function holidayCheck($date,$flag_check0){
        //valid date
        $holidayArr = ['12-31', '01-01', '01-02', '01-03'];
//        $exactDate='2021-12-31';
        $exDate = substr($date, 5, 5);
        $checkForHoliday = in_array($exDate, $holidayArr);
        if ($checkForHoliday==true){
            if (substr($flag_check0, 0, 1) == 1) {
                //day will be increased
                if ($exDate=='12-31'){
                    $expectedDate = (int)substr($date, 0, 4) + 1 . '-01-04';
                }
                else{
                    $expectedDate = substr($date, 0, 4) . '-01-04';
                }
                return [$expectedDate,true];
            } elseif (substr($flag_check0, 0, 1) == 2) {
                //day will be decreased
                if ($exDate=='12-31'){
                    $expectedDate = substr($date, 0, 4) . '-12-30';
                }
                else{
                    $expectedDate = (int)substr($date, 0, 4) - 1 . '-12-30';
                }
                return [$expectedDate,true];
            }

        }else{
            return [$date,false];
        }
    }

    public static function weekendCheck($date,$flag_check0){
        $day = date('D', strtotime($date));
//        dd($day);
        if ($day == 'Sat') {
            if (substr($flag_check0, 0, 1) == 1) {
                //day will be increased by two
                $expectedDate = date('Y-m-d', strtotime("+2 day", strtotime($date)));
            } elseif (substr($flag_check0, 0, 1) == 2) {
                //day will be decreased by one
                $expectedDate = date('Y-m-d', strtotime("-1 day", strtotime($date)));
            }
            return [$expectedDate,true];
        } elseif ($day == 'Sun') {
            if (substr($flag_check0, 0, 1) == 1) {
                //day will be increased by one
                $expectedDate = date('Y-m-d', strtotime("+1 day", strtotime($date)));
            } elseif (substr($flag_check0, 0, 1) == 2) {
                //day will be decreased by two
                $expectedDate = date('Y-m-d', strtotime("-2 day", strtotime($date)));
            }
            return [$expectedDate,true];

        }else{
            return [$date,false];
        }
    }


}
