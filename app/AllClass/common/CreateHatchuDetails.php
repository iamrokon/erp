<?php

namespace App\AllClass\common;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use Carbon\Carbon;
use App\Helpers\Helper;

Class CreateHatchuDetails
{
    public static function data($bango, $kokyakuorderbango, $ordertypebango2, $datachar01, $page_no, $type = null)
    {   
        // dd($kokyakuorderbango, $ordertypebango2,$type);
        $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7401'");
        $review_orderbango = $reviewData->orderbango + 1;
        $orderNumber = STR_PAD($review_orderbango,10,'0',STR_PAD_LEFT);
        
        if($type == 'purchase_input'){
            $nyukooldData = QueryHelper::fetchResult("
            select nyukoold.*
            from nyukoold 
            where syouhinid = '$kokyakuorderbango' AND zaikometer = $ordertypebango2
            ");
            // dd($nyukooldData);
            if($datachar01 == 2){
                //set 1, red data=>copy
                $tmp_ordertypebango2 = $ordertypebango2 - 1;
                $rirekiData = QueryHelper::fetchResult("select * from rireki where kr0002 = '$kokyakuorderbango' AND kr0005 = '$tmp_ordertypebango2'");
                self::createRedData($bango,$orderNumber,$kokyakuorderbango,$tmp_ordertypebango2,$rirekiData,'purchase_input');
                //set 2, black data=>create
                $review_orderbango = $review_orderbango + 1;
                $orderNumber = STR_PAD($review_orderbango,10,'0',STR_PAD_LEFT);
                $ordertypebango2 = $ordertypebango2;
                $kr0006 = 1;
                foreach($nyukooldData as $key=>$val){
                    self::insertPurchaseHistoryDetails($bango,$orderNumber,$kokyakuorderbango,$ordertypebango2,$val,$kr0006);
                }

                //update review data
                $review_update_data = [
                    'kokyakusyouhinbango' => 'D7401',
                    'orderbango' => $review_orderbango,
                    'check_flag' => 0,
                    'color' => Carbon::now()->setTimezone("Asia/Tokyo")->format('YmdHis'),
                    'size' => Helper::getSystemIP(),
                    'nickname' => $bango,
                ];
                QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);

            }else{
                $ordertypebango2 = $ordertypebango2;
                $kr0006 = ($datachar01 == 3 ? 2 : 1);
                foreach($nyukooldData as $key=>$val){
                    self::insertPurchaseHistoryDetails($bango,$orderNumber,$kokyakuorderbango,$ordertypebango2,$val,$kr0006);
                }

                //update review data
                $review_update_data = [
                    'kokyakusyouhinbango' => 'D7401',
                    'orderbango' => $review_orderbango,
                    'check_flag' => 0,
                    'color' => Carbon::now()->setTimezone("Asia/Tokyo")->format('YmdHis'),
                    'size' => Helper::getSystemIP(),
                    'nickname' => $bango,
                ];
                QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
            }
        }else{
            $minyukoData = QueryHelper::fetchResult("
            select minyuko.*
            from minyuko 
            where syouhinid = '$kokyakuorderbango' AND zaikometer = $ordertypebango2
            ");
            if($datachar01 == 2){
                //set 1, red data=>copy
                $tmp_ordertypebango2 = $ordertypebango2 - 1;
                $rirekiData = QueryHelper::fetchResult("select * from rireki where kr0002 = '$kokyakuorderbango' AND kr0005 = '$tmp_ordertypebango2'");
                self::createRedData($bango,$orderNumber,$kokyakuorderbango,$tmp_ordertypebango2,$rirekiData);
                //set 2, black data=>create
                $review_orderbango = $review_orderbango + 1;
                $orderNumber = STR_PAD($review_orderbango,10,'0',STR_PAD_LEFT);
                $ordertypebango2 = $ordertypebango2;
                $kr0006 = 1;
                foreach($minyukoData as $key=>$val){
                    self::insertHistoryDetails($bango,$orderNumber,$kokyakuorderbango,$ordertypebango2,$val,$kr0006);
                }

                //update review data
                $review_update_data = [
                    'kokyakusyouhinbango' => 'D7401',
                    'orderbango' => $review_orderbango,
                    'check_flag' => 0,
                    'color' => Carbon::now()->setTimezone("Asia/Tokyo")->format('YmdHis'),
                    'size' => Helper::getSystemIP(),
                    'nickname' => $bango,
                ];
                QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                self::createActualDataHistory($bango,$page_no);
            }else{
                $ordertypebango2 = $ordertypebango2;
                $kr0006 = ($datachar01 == 3 ? 2 : 1);
                // $arr = [];
                foreach($minyukoData as $key=>$val){
                    self::insertHistoryDetails($bango,$orderNumber,$kokyakuorderbango,$ordertypebango2,$val,$kr0006);
                    // array_push($arr,$v);
                }
                // dd("x");
                //update review data
                $review_update_data = [
                    'kokyakusyouhinbango' => 'D7401',
                    'orderbango' => $review_orderbango,
                    'check_flag' => 0,
                    'color' => Carbon::now()->setTimezone("Asia/Tokyo")->format('YmdHis'),
                    'size' => Helper::getSystemIP(),
                    'nickname' => $bango,
                ];
                QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                
                // if($datachar01 == 1 && ($page_no == '05-02' || $page_no == '05-06')){
                //     //create actual data history
                //     self::createActualDataHistory($bango,$page_no);
                // }
                self::createActualDataHistory($bango,$page_no);
            }
        }   
    }
    
    public static function insertHistoryDetails($bango,$orderNumber,$kokyakuorderbango,$ordertypebango2,$val,$kr0006){
        
        $orderhenkanData = QueryHelper::fetchSingleResult("
            select 
            orderhenkan.*
            from (select kokyakuorderbango,max(ordertypebango2) as max_ordertypebango2 from orderhenkan group by kokyakuorderbango) as tmp_orderhenkan
            join orderhenkan on orderhenkan.kokyakuorderbango = tmp_orderhenkan.kokyakuorderbango and orderhenkan.ordertypebango2 = tmp_orderhenkan.max_ordertypebango2
            where orderhenkan.kokyakuorderbango = '$kokyakuorderbango' 
            --AND ordertypebango2 = $ordertypebango2
            ");
        // dd($orderhenkanData,$ordertypebango2,$kokyakuorderbango);
        $idoutanabango = $val->idoutanabango ?? null;
        $yoteimeter = (int)$val->yoteimeter ?? null;
        $hantei = (int)$val->nyukometer ?? null;
        // dd($idoutanabango, !is_null($hantei));
        if(!is_null($idoutanabango) && !is_null($yoteimeter) && !is_null($hantei)){
            $maxOrdertypebango2 = QueryHelper::fetchSingleResult("
                select max(dataint01) as maxdataint01
                from misyukko
                where syouhinid = '$idoutanabango' and syouhinsyu = '$yoteimeter' and hantei = '$hantei'   
                ")->maxdataint01 ?? 0;
            $misyukkoData = QueryHelper::fetchSingleResult("
                select 
                --orderhenkan.kokyakuorderbango,
                --orderhenkan.ordertypebango2,
                misyukko.datachar13,
                misyukko.dataint17
                from misyukko
                where syouhinid = '$idoutanabango' and syouhinsyu = '$yoteimeter' and hantei = '$hantei' and dataint01 = $maxOrdertypebango2
                ");
            // dd($misyukkoData, $maxOrdertypebango2, $idoutanabango, $yoteimeter, $hantei);
            $datachar13 = $misyukkoData->datachar13;
            $dataint17 = $misyukkoData->dataint17;
        }else{
            $datachar13 = null;
            $dataint17 = null;
            $maxOrdertypebango2 = null;
        }
        $productId = $val->datachar02;
        $productData = QueryHelper::fetchSingleResult("select   
                        syouhin1.*,
                        syouhin2.jouhou2,
                        syouhin4.syouhingroup,
                        syouhin4.ruijihinbango
                        from syouhin1 
                        join syouhin2 on syouhin2.bango = syouhin1.bango
                        join syouhin4 on syouhin4.bango = syouhin1.bango
                        where kokyakusyouhinbango = '$productId'");
        //dd("testing cholche..",$productData);
        if($productData){
            $kr0093 = $productData->jouhou;
            $kr0095 = $productData->koyuujouhou;
            $kr0097 = $productData->color;
            $kr0099 = $productData->bumon;
            $kr0101 = $productData->jouhou2;
            $kr0103 = substr($productData->data23,0,1) ?? null;
            $kr0105 = $productData->data52;
            $kr0107 = $productData->data53;
            $kr0109 = $productData->data54;
            $kr0111 = $productData->data100;
            $kr0113 = $productData->synchrosyouhinbango;
            $kr0114 = $productData->data26;
            $kr0116 = $productData->syouhingroup;
            $kr0117 = $productData->ruijihinbango;
            if($kr0103 == '1'){
                $kr0104 = '運送会社';
            }else if($kr0103 == '2'){
                $kr0104 = '小売業';
            }else if($kr0103 == '3'){
                $kr0104 = 'プロテクタ';
            }else{
                $kr0104 = null;
            }
        }else{
            $kr0093 = null;
            $kr0095 = null;
            $kr0097 = null;
            $kr0099 = null;
            $kr0101 = null;
            $kr0103 = null;
            $kr0104 = null;
            $kr0105 = null;
            $kr0107 = null;
            $kr0109 = null;
            $kr0111 = null;
            $kr0113 = null;
            $kr0114 = null;
            $kr0116 = null;
            $kr0117 = null;
        }
        $datachar01 = $val->datachar01;
        // dd($orderhenkanData);
        $kr0028 = ($datachar01 == 'V120' || $datachar01 == 'V130' || $datachar01 == 'V140' || $datachar01 == 'V160') ? $val->datachar13 : $orderhenkanData->datachar09;
        $kr0085 = self::getTantousyaData($kr0028,'datatxt0003');
        $kr0087 = self::getTantousyaData($kr0028,'datatxt0004');
        $kr0089 = self::getTantousyaData($kr0028,'datatxt0005');
        $kr0091 = self::getTantousyaData($kr0028,'syozoku');
        $cat1 = substr($kr0089,0,2);
        $cat2 = substr($kr0089,2);
        $kr0092 = QueryHelper::fetchSingleResult("
            select   
            substring(categorykanri.patternsub2,1,2) as pattern
            from categorykanri 
            where category1 = '$cat1' and category2 = '$cat2'
            ")->pattern ?? null;
        if($orderhenkanData->datachar08){
            $kokyakuCode = substr($orderhenkanData->datachar08, 0,6);
            $haisouCode = substr($orderhenkanData->datachar08, 6,2);
            $kokyaku = QueryHelper::select(['bango,mallsoukobango1'])->from('kokyaku1')->where("yobi12 = '$kokyakuCode' ")->get()->first();
            $haisoujouhou = QueryHelper::select(['bunrui3'])->from('haisoujouhou')->where("syukei1 = '$kokyaku->bango' ")->get()->first();
            $others2 = QueryHelper::fetchResult("select other1,other24 from others2 where otherint1 = (select bango from haisou where haisou.shikibetsucode = '$kokyakuCode' and haisou.torihikisakibango = '$haisouCode')");
            if(explode(' ', $others2[0]->other1)[0] == '1'){
                $kr0042 = $haisoujouhou->bunrui3;
            }else{
                $kr0042 = $others2[0]->other24;
                // dd($others2, $kr0042);
            }
        }else{
            $kr0042 = null;
        }
        $rireki_insert_data = [
            'kr0000' => $orderNumber,
            'kr0001' => 'V830',
            'kr0002' => $kokyakuorderbango,
            'kr0003' => $val->syouhinsyu,
            'kr0004' => 0,
            'kr0005' => $ordertypebango2,
            'kr0006' => $kr0006,
            'kr0007' => $val->datachar01,
            'kr0008' => $orderhenkanData->datachar02,
            'kr0009' => $datachar13,
            'kr0010' => $orderhenkanData->datachar09,
            'kr0011' => $orderhenkanData->datachar10,
            'kr0012' => null,
            'kr0013' => $orderhenkanData->datachar11,
            'kr0014' => null,
            'kr0015' => null,
            'kr0016' => $orderhenkanData->datachar08,
            'kr0017' => $val->datachar02,
            'kr0018' => $val->datachar03,
            'kr0019' => $val->dataint20,
            'kr0020' => $val->datachar04,
            'kr0021' => $val->datachar05,
            'kr0022' => $val->datachar07,
            'kr0023' => $val->datachar08,
            'kr0024' => $val->kingaku,
            'kr0025' => $kr0006==2 ? (-1)*$val->nyukosu : $val->nyukosu,
            'kr0026' => $val->datachar06,
            'kr0027' => $kr0006==2 ? (-1)*$val->syouhizeiritu : $val->syouhizeiritu,
            'kr0028' => $kr0028,
            'kr0029' => $val->genka,
            'kr0030' => $kr0006==2 ? (-1)*$val->syouhizeiritu : $val->syouhizeiritu,
            'kr0031' => $val->datachar18,
            'kr0032' => $kr0006==2 ? (-1)*$val->soukobango : $val->soukobango,
            'kr0033' => $kr0006==2 ? (-1)*$orderhenkanData->intorder01 : $orderhenkanData->intorder01,
            'kr0034' => $kr0006==2 ? (-1)*$orderhenkanData->intorder02 : $orderhenkanData->intorder02,
            'kr0035' => Carbon::now()->format('Y-m-d H:i:s'),
            'kr0036' => null,
            'kr0037' => $orderhenkanData->date,
            'kr0038' => $val->yoteibi,
            'kr0039' => null,
            'kr0040' => null,
            'kr0041' => null,
            'kr0042' => $kr0042,
            'kr0043' => null,
            'kr0044' => $val->datachar10,
            'kr0045' => null,
            'kr0046' => null,
            'kr0047' => null,
            'kr0048' => null,
            'kr0049' => null,
            'kr0050' => null,
            'kr0051' => null,
            'kr0052' => null,
            'kr0053' => null,
            'kr0054' => null,
            'kr0055' => null,
            'kr0056' => null,
            'kr0057' => $val->idoutanabango,
            'kr0058' => $val->yoteimeter,
            'kr0059' => $val->nyukometer,
            'kr0060' => $maxOrdertypebango2,
            'kr0061' => null,
            'kr0062' => null,
            'kr0063' => null,
            'kr0064' => null,
            'kr0065' => null,
            'kr0066' => null,
            'kr0067' => null,
            'kr0068' => null,
            'kr0069' => (($orderhenkanData->intorder04 == 1 && $orderhenkanData->datachar02 == 'V413') || ($val->datachar01 == 'V150' || $val->datachar01 == 'V160')) ? 9 : 2,
            // 'kr0069' => 2,
            'kr0070' => 0,
            'kr0071' => ($orderhenkanData->intorder04 == 1 && $orderhenkanData->datachar02 == 'V413') ? 9 : 2,
            // 'kr0071' => 2,
            'kr0072' => $orderhenkanData->synchroorderbango2,
            'kr0073' => $dataint17,
            // 'kr0073' => 1,
            'kr0074' => null,
            'kr0075' => null,
            'kr0076' => null,
            'kr0077' => null,
            'kr0078' => null,
            'kr0079' => null,
            'kr0080' => null,
            'kr0081' => null,
            'kr0082' => Carbon::now()->format('Y-m-d H:i:s'),
            'kr0083' => $orderhenkanData->datatxt0155,
            'kr0084' => substr($kokyakuorderbango,2,2) ?? null,
            'kr0085' => $kr0085,
            'kr0086' => self::getCategoryData($kr0085),
            'kr0087' => $kr0087,
            'kr0088' => self::getCategoryData($kr0087),
            'kr0089' => $kr0089,
            'kr0090' => self::getCategoryData($kr0089),
            'kr0091' => $kr0091,
            'kr0092' => $kr0092,
            'kr0093' => $kr0093,
            'kr0094' => self::getCategoryData($kr0093),
            'kr0095' => $kr0095,
            'kr0096' => self::getCategoryData($kr0095),
            'kr0097' => $kr0097,
            'kr0098' => self::getCategoryData($kr0097),
            'kr0099' => $kr0099,
            'kr0100' => self::getCategoryData($kr0099),
            'kr0101' => $kr0101,
            'kr0102' => self::getCategoryData($kr0101),
            'kr0103' => $kr0103,
            'kr0104' => $kr0104,
            'kr0105' => $kr0105,
            'kr0106' => self::getCategoryData($kr0105),
            'kr0107' => $kr0107,
            'kr0108' => self::getCategoryData($kr0107),
            'kr0109' => $kr0109,
            'kr0110' => self::getCategoryData($kr0109),
            'kr0111' => $kr0111,
            'kr0112' => self::getCategoryData($kr0111),
            'kr0113' => $kr0113,
            'kr0114' => $kr0114,
            'kr0115' => self::getCategoryData($kr0114),
            'kr0116' => $kr0116,
            'kr0117' => $kr0117,
            'kr0118' => $orderhenkanData->intorder04,
        ];
        // return $rireki_insert_data;
        // echo "<pre>";
        // var_dump($rireki_insert_data);
        $rireki = QueryHelper::insertData('rireki',$rireki_insert_data,'kr0000',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
    }
    
    public static function insertPurchaseHistoryDetails($bango,$orderNumber,$kokyakuorderbango,$ordertypebango2,$val,$kr0006){
        
        $toiawasebangoData = QueryHelper::fetchSingleResult("
            select 
            toiawasebango.*,
            hikiatenyuko.dataint02 as hk_dataint02
            from (select unsoumei,max(datanum0013) as max_datanum0013 from toiawasebango group by unsoumei) as tmp_toiawasebango
            join toiawasebango on toiawasebango.unsoumei = tmp_toiawasebango.unsoumei and toiawasebango.datanum0013 = tmp_toiawasebango.max_datanum0013
            join hikiatenyuko on hikiatenyuko.syouhinid = toiawasebango.unsoumei
            where toiawasebango.unsoumei = '$kokyakuorderbango' 
            ");

        $idoutanabango = $val->idoutanabango ?? null;
        $yoteimeter = $val->yoteimeter ? (int)$val->yoteimeter : null;
        $hantei = (int)$val->nyukometer ?? null;
        if(!is_null($idoutanabango) && !is_null($yoteimeter) && !is_null($hantei)){
            if($toiawasebangoData->toiawasebango != 'U640'){
                $kr0064 = QueryHelper::fetchSingleResult("
                select max(zaikometer) as zaikometer
                from minyuko
                where syouhinid = '$idoutanabango' and syouhinsyu = '$yoteimeter' and hantei = '$hantei'   
                ")->zaikometer ?? 0;
                $misyukkoData = QueryHelper::fetchSingleResult("
                select 
                minyuko.idoutanabango,
                minyuko.yoteimeter,
                minyuko.nyukometer,
                orderhenkan.ordertypebango2
                from minyuko
                left join (select kokyakuorderbango,max(ordertypebango2) as ordertypebango2 from orderhenkan group by kokyakuorderbango) 
                    as orderhenkan on orderhenkan.kokyakuorderbango = minyuko.idoutanabango
                where syouhinid = '$idoutanabango' and syouhinsyu = '$yoteimeter' and hantei = '$hantei' and zaikometer = $kr0064
                ");
                $idoutanabango = $misyukkoData->idoutanabango ?? null;
                $yoteimeter = $misyukkoData->yoteimeter ?? null;
                $hantei = $misyukkoData->nyukometer ?? null;
                $kr0060 = $misyukkoData->ordertypebango2 ?? null;
                // dd($toiawasebangoData->toiawasebango,$misyukkoData, $idoutanabango, $yoteimeter, $hantei,$kr0060,$kr0064);
            }else{
                $kr0064 = QueryHelper::fetchSingleResult("
                select max(ordertypebango2) as maxdataint01
                from orderhenkan
                where kokyakuorderbango = '$idoutanabango'   
                ")->maxdataint01 ?? 0;
                $kr0060 = $kr0064;
            }
            // dd($toiawasebangoData->toiawasebango,$idoutanabango, $yoteimeter, $hantei,$kr0060,$kr0064);
        }else{
            $kr0060 = null;
            $kr0064 = null;
        }
        // dd('no');
        $kawasename = $val->datachar07;
        $productData = QueryHelper::fetchSingleResult("select   
                        syouhin1.*,
                        syouhin2.jouhou2,
                        syouhin2.konpoumei,
                        syouhin4.syouhingroup,
                        syouhin4.ruijihinbango
                        from syouhin1 
                        join syouhin2 on syouhin2.bango = syouhin1.bango
                        join syouhin4 on syouhin4.bango = syouhin1.bango
                        where kokyakusyouhinbango = '$kawasename'");
        //dd("testing cholche..",$productData);
        if($productData){
            $kr0017 = $productData->kokyakusyouhinbango;
            $kr0018 = $productData->name;
            $kr0026 = $productData->konpoumei;
            $kr0093 = $productData->jouhou;
            $kr0095 = $productData->koyuujouhou;
            $kr0097 = $productData->color;
            $kr0099 = $productData->bumon;
            $kr0101 = $productData->jouhou2;
            // $kr0103 = $productData->data23;
            $kr0103 = substr($productData->data23,0,1) ?? null;
            $kr0105 = $productData->data52;
            $kr0107 = $productData->data53;
            $kr0109 = $productData->data54;
            $kr0111 = $productData->data100;
            $kr0113 = $productData->synchrosyouhinbango;
            $kr0114 = $productData->data26;
            $kr0116 = $productData->syouhingroup;
            $kr0117 = $productData->ruijihinbango;
            if($kr0103 == '1'){
                $kr0104 = '運送会社';
            }else if($kr0103 == '2'){
                $kr0104 = '小売業';
            }else if($kr0103 == '3'){
                $kr0104 = 'プロテクタ';
            }else{
                $kr0104 = null;
            }
        }else{
            $kr0017 = null;
            $kr0018 = null;
            $kr0026 = null;
            $kr0093 = null;
            $kr0095 = null;
            $kr0097 = null;
            $kr0099 = null;
            $kr0101 = null;
            $kr0103 = null;
            $kr0104 = null;
            $kr0105 = null;
            $kr0107 = null;
            $kr0109 = null;
            $kr0111 = null;
            $kr0113 = null;
            $kr0114 = null;
            $kr0116 = null;
            $kr0117 = null;
        }
        $kr0007 = $toiawasebangoData->toiawasebango == 'U640' ? 'V160' : 'V150';
        $kr0028 = $kr0007 == 'V150'? $toiawasebangoData->touchakutime : $toiawasebangoData->touchakutime;
        $kr0085 = self::getTantousyaData($kr0028,'datatxt0003');
        $kr0087 = self::getTantousyaData($kr0028,'datatxt0004');
        $kr0089 = self::getTantousyaData($kr0028,'datatxt0005');
        $kr0091 = self::getTantousyaData($kr0028,'syozoku');
        $cat1 = substr($kr0089,0,2);
        $cat2 = substr($kr0089,2);
        $kr0092 = QueryHelper::fetchSingleResult("
            select   
            substring(categorykanri.patternsub2,1,2) as pattern
            from categorykanri 
            where category1 = '$cat1' and category2 = '$cat2'
            ")->pattern ?? null;
        if($toiawasebangoData->bikou1){
            $kokyakuCode = substr($toiawasebangoData->bikou1, 0,6);
            $haisouCode = substr($toiawasebangoData->bikou1, 6,2);
            $kokyaku = QueryHelper::select(['bango,mallsoukobango1'])->from('kokyaku1')->where("yobi12 = '$kokyakuCode' ")->get()->first();
            $haisoujouhou = QueryHelper::select(['bunrui3'])->from('haisoujouhou')->where("syukei1 = '$kokyaku->bango' ")->get()->first();
            $others2 = QueryHelper::fetchResult("select other1,other24 from others2 where otherint1 = (select bango from haisou where haisou.shikibetsucode = '$kokyakuCode' and haisou.torihikisakibango = '$haisouCode')");
            if(explode(' ', $others2[0]->other1)[0] == '1'){
                $kr0042 = $haisoujouhou->bunrui3;
            }else{
                $kr0042 = $others2[0]->other24;
                // dd($others2, $kr0042);
            }
        }else{
            $kr0042 = null;
        }
        $rireki_insert_data = [
            'kr0000' => $orderNumber,
            'kr0001' => 'V840',
            'kr0002' => $kokyakuorderbango,
            'kr0003' => $val->syouhinsyu,
            'kr0004' => '000',
            'kr0005' => $ordertypebango2,
            'kr0006' => $kr0006,
            'kr0007' => $kr0007,
            'kr0008' => $toiawasebangoData->toiawasebango,
            'kr0009' => 0,
            'kr0010' => $toiawasebangoData->touchakutime,
            'kr0011' => null,
            'kr0012' => null,
            'kr0013' => null,
            'kr0014' => null,
            'kr0015' => null,
            'kr0016' => $toiawasebangoData->bikou1,
            'kr0017' => $kr0017,
            'kr0018' => $kr0018,
            'kr0019' => null,
            'kr0020' => null,
            'kr0021' => null,
            'kr0022' => $val->datachar07,
            'kr0023' => $val->datachar08,
            'kr0024' => $val->kingaku,
            'kr0025' => $kr0006==2 ? (-1)*$val->nyukosu : $val->nyukosu,
            'kr0026' => $kr0026,
            'kr0027' => $kr0006==2 ? (-1)*$val->syouhizeiritu : $val->syouhizeiritu,
            'kr0028' => $kr0028,
            'kr0029' => $val->kingaku, //$kr0006==2 ? (-1)*$val->kingaku : $val->kingaku,
            'kr0030' => $kr0006==2 ? (-1)*$val->syouhizeiritu : $val->syouhizeiritu,
            'kr0031' => $val->datachar18,
            'kr0032' => $kr0006==2 ? (-1)*$val->soukobango : $val->soukobango,
            'kr0033' => $kr0006==2 ? (-1)*$toiawasebangoData->dataint03 : $toiawasebangoData->dataint03,
            'kr0034' => $kr0006==2 ? (-1)*$toiawasebangoData->datanum0001 : $toiawasebangoData->datanum0001,
            'kr0035' => Carbon::now()->format('Y-m-d H:i:s'),
            'kr0036' => null,
            'kr0037' => null,
            'kr0038' => $toiawasebangoData->dataint01 == null ? null : strftime ( '%Y-%m-%d' , strtotime($toiawasebangoData->dataint01))." 00:00:00",
            'kr0039' => null,
            'kr0040' => $toiawasebangoData->touchakudate,
            'kr0041' => $toiawasebangoData->dataint02 == null ? null : strftime ( '%Y-%m-%d' , strtotime($toiawasebangoData->dataint02))." 00:00:00",
            'kr0042' => $kr0042,
            'kr0043' => null,
            'kr0044' => null,
            'kr0045' => null,
            'kr0046' => null,
            'kr0047' => null,
            'kr0048' => null,
            'kr0049' => null,
            'kr0050' => null,
            'kr0051' => null,
            'kr0052' => null,
            'kr0053' => $toiawasebangoData->datatxt0019,
            'kr0054' => $toiawasebangoData->datatxt0002,
            'kr0055' => $val->barcode,
            'kr0056' => $val->codename,
            'kr0057' => $idoutanabango,//need to add
            'kr0058' => $yoteimeter,//need to add
            'kr0059' => $hantei,//need to add
            'kr0060' => $kr0060,//need to add
            'kr0061' => $val->idoutanabango,
            'kr0062' => $val->yoteimeter,
            'kr0063' => $val->nyukometer,
            'kr0064' => $kr0064,
            'kr0065' => null,
            'kr0066' => null,
            'kr0067' => null,
            'kr0068' => null,
            'kr0069' => 9,
            'kr0070' => $toiawasebangoData->hk_dataint02,
            'kr0071' => 2,
            'kr0072' => $toiawasebangoData->datachar03,
            'kr0073' => 2,
            'kr0074' => null,
            'kr0075' => null,
            'kr0076' => null,
            'kr0077' => null,
            'kr0078' => null,
            'kr0079' => null,
            'kr0080' => null,
            'kr0081' => null,
            'kr0082' => Carbon::now()->format('Y-m-d H:i:s'),
            'kr0083' => $toiawasebangoData->datatxt0001,
            'kr0084' => substr($kokyakuorderbango,2,2) ?? null,
            'kr0085' => $kr0085,
            'kr0086' => self::getCategoryData($kr0085),
            'kr0087' => $kr0087,
            'kr0088' => self::getCategoryData($kr0087),
            'kr0089' => $kr0089,
            'kr0090' => self::getCategoryData($kr0089),
            'kr0091' => $kr0091,
            'kr0092' => $kr0092,
            'kr0093' => $kr0093,
            'kr0094' => self::getCategoryData($kr0093),
            'kr0095' => $kr0095,
            'kr0096' => self::getCategoryData($kr0095),
            'kr0097' => $kr0097,
            'kr0098' => self::getCategoryData($kr0097),
            'kr0099' => $kr0099,
            'kr0100' => self::getCategoryData($kr0099),
            'kr0101' => $kr0101,
            'kr0102' => self::getCategoryData($kr0101),
            'kr0103' => $kr0103,
            'kr0104' => $kr0104,
            'kr0105' => $kr0105,
            'kr0106' => self::getCategoryData($kr0105),
            'kr0107' => $kr0107,
            'kr0108' => self::getCategoryData($kr0107),
            'kr0109' => $kr0109,
            'kr0110' => self::getCategoryData($kr0109),
            'kr0111' => $kr0111,
            'kr0112' => self::getCategoryData($kr0111),
            'kr0113' => $kr0113,
            'kr0114' => $kr0114,
            'kr0115' => self::getCategoryData($kr0114),
            'kr0116' => $kr0116,
            'kr0117' => $kr0117,
            'kr0118' => $toiawasebangoData->konpousu,
        ];
        $rireki = QueryHelper::insertData('rireki',$rireki_insert_data,'kr0000',true,$bango,__CLASS__,__FUNCTION__,__LINE__);

    }
    
    public static function createRedData($bango,$orderNumber,$kokyakuorderbango,$ordertypebango2,$rirekiData, $type = null){
        if($type == 'purchase_input'){
            foreach($rirekiData as $key=>$val){
                $rireki_insert_data = [
                    'kr0000' => $orderNumber,
                    'kr0001' => $val->kr0001,
                    'kr0002' => $val->kr0002,
                    'kr0003' => $val->kr0003,
                    'kr0004' => $val->kr0004,
                    'kr0005' => $ordertypebango2,
                    'kr0006' => 2,
                    'kr0007' => $val->kr0007,
                    'kr0008' => $val->kr0008,
                    'kr0009' => $val->kr0009,
                    'kr0010' => $val->kr0010,
                    'kr0011' => $val->kr0011,
                    'kr0012' => $val->kr0012,
                    'kr0013' => $val->kr0013,
                    'kr0014' => $val->kr0014,
                    'kr0015' => $val->kr0015,
                    'kr0016' => $val->kr0016,
                    'kr0017' => $val->kr0017,
                    'kr0018' => $val->kr0018,
                    'kr0019' => $val->kr0019,
                    'kr0020' => $val->kr0020,
                    'kr0021' => $val->kr0021,
                    'kr0022' => $val->kr0022,
                    'kr0023' => $val->kr0023,
                    'kr0024' => $val->kr0024,
                    'kr0025' => (-1)*$val->kr0025,
                    'kr0026' => $val->kr0026,
                    'kr0027' => (-1)*$val->kr0027,
                    'kr0028' => $val->kr0028,
                    'kr0029' => $val->kr0029,
                    'kr0030' => (-1)*$val->kr0030,
                    'kr0031' => $val->kr0031,
                    'kr0032' => (-1)*$val->kr0032,
                    'kr0033' => (-1)*$val->kr0033,
                    'kr0034' => (-1)*$val->kr0034,
                    'kr0035' => $val->kr0035,
                    'kr0036' => $val->kr0036,
                    'kr0037' => $val->kr0037,
                    'kr0038' => $val->kr0038,
                    'kr0039' => $val->kr0039,
                    'kr0040' => $val->kr0040,
                    'kr0041' => $val->kr0041,
                    'kr0042' => $val->kr0042,
                    'kr0043' => $val->kr0043,
                    'kr0044' => $val->kr0044,
                    'kr0045' => $val->kr0045,
                    'kr0046' => $val->kr0046,
                    'kr0047' => $val->kr0047,
                    'kr0048' => $val->kr0048,
                    'kr0049' => $val->kr0049,
                    'kr0050' => $val->kr0050,
                    'kr0051' => $val->kr0051,
                    'kr0052' => $val->kr0052,
                    'kr0053' => $val->kr0053,
                    'kr0054' => $val->kr0054,
                    'kr0055' => $val->kr0055,
                    'kr0056' => $val->kr0056,
                    'kr0057' => $val->kr0057,
                    'kr0058' => $val->kr0058,
                    'kr0059' => $val->kr0059,
                    'kr0060' => $val->kr0060,
                    'kr0061' => $val->kr0061,
                    'kr0062' => $val->kr0062,
                    'kr0063' => $val->kr0063,
                    'kr0064' => $val->kr0064,
                    'kr0065' => $val->kr0065,
                    'kr0066' => $val->kr0066,
                    'kr0067' => $val->kr0067,
                    'kr0068' => $val->kr0068,
                    'kr0069' => $val->kr0069,
                    'kr0070' => $val->kr0070,
                    'kr0071' => $val->kr0071,
                    'kr0072' => $val->kr0072,
                    'kr0073' => $val->kr0073,
                    'kr0074' => $val->kr0074,
                    'kr0075' => $val->kr0075,
                    'kr0076' => $val->kr0076,
                    'kr0077' => $val->kr0077,
                    'kr0078' => $val->kr0078,
                    'kr0079' => $val->kr0079,
                    'kr0080' => $val->kr0080,
                    'kr0081' => $val->kr0081,
                    'kr0082' => Carbon::now()->format('Y-m-d H:i:s'),
                    'kr0083' => $val->kr0083,
                    'kr0084' => $val->kr0084,
                    'kr0085' => $val->kr0085,
                    'kr0086' => $val->kr0086,
                    'kr0087' => $val->kr0087,
                    'kr0088' => $val->kr0088,
                    'kr0089' => $val->kr0089,
                    'kr0090' => $val->kr0090,
                    'kr0091' => $val->kr0091,
                    'kr0092' => $val->kr0092,
                    'kr0093' => $val->kr0093,
                    'kr0094' => $val->kr0094,
                    'kr0095' => $val->kr0095,
                    'kr0096' => $val->kr0096,
                    'kr0097' => $val->kr0097,
                    'kr0098' => $val->kr0098,
                    'kr0099' => $val->kr0099,
                    'kr0100' => $val->kr0100,
                    'kr0101' => $val->kr0101,
                    'kr0102' => $val->kr0102,
                    'kr0103' => $val->kr0103,
                    'kr0104' => $val->kr0104,
                    'kr0105' => $val->kr0105,
                    'kr0106' => $val->kr0106,
                    'kr0107' => $val->kr0107,
                    'kr0108' => $val->kr0108,
                    'kr0109' => $val->kr0109,
                    'kr0110' => $val->kr0110,
                    'kr0111' => $val->kr0111,
                    'kr0112' => $val->kr0112,
                    'kr0113' => $val->kr0113,
                    'kr0114' => $val->kr0114,
                    'kr0115' => $val->kr0115,
                    'kr0116' => $val->kr0116,
                    'kr0117' => $val->kr0117,
                    'kr0118' => $val->kr0118,
                ];
                // foreach ($value as $k => $val) {
                //     $rireki_insert_data[$k] = $val;
                // }
                // $rireki_insert_data['kr0000'] = $orderNumber;
                // $rireki_insert_data['kr0005'] = $ordertypebango2;
                // $rireki_insert_data['kr0006'] = 2;
                // $rireki_insert_data['kr0082'] = Carbon::now()->format('Y-m-d H:i:s');
                $rireki = QueryHelper::insertData('rireki',$rireki_insert_data,'kr0000',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
            }
        }
        else{
            foreach($rirekiData as $key=>$val){
                $rireki_insert_data = [
                    'kr0000' => $orderNumber,
                    'kr0001' => $val->kr0001,
                    'kr0002' => $val->kr0002,
                    'kr0003' => $val->kr0003,
                    'kr0004' => $val->kr0004,
                    'kr0005' => $ordertypebango2,
                    'kr0006' => 2,
                    'kr0007' => $val->kr0007,
                    'kr0008' => $val->kr0008,
                    'kr0009' => $val->kr0009,
                    'kr0010' => $val->kr0010,
                    'kr0011' => $val->kr0011,
                    'kr0012' => $val->kr0012,
                    'kr0013' => $val->kr0013,
                    'kr0014' => $val->kr0014,
                    'kr0015' => $val->kr0015,
                    'kr0016' => $val->kr0016,
                    'kr0017' => $val->kr0017,
                    'kr0018' => $val->kr0018,
                    'kr0019' => $val->kr0019,
                    'kr0020' => $val->kr0020,
                    'kr0021' => $val->kr0021,
                    'kr0022' => $val->kr0022,
                    'kr0023' => $val->kr0023,
                    'kr0024' => $val->kr0024,
                    'kr0025' => (-1)*$val->kr0025,
                    'kr0026' => $val->kr0026,
                    'kr0027' => (-1)*$val->kr0027,
                    'kr0028' => $val->kr0028,
                    'kr0029' => $val->kr0029,
                    'kr0030' => (-1)*$val->kr0030,
                    'kr0031' => $val->kr0031,
                    'kr0032' => (-1)*$val->kr0032,
                    'kr0033' => (-1)*$val->kr0033,
                    'kr0034' => (-1)*$val->kr0034,
                    'kr0035' => $val->kr0035,
                    'kr0036' => $val->kr0036,
                    'kr0037' => $val->kr0037,
                    'kr0038' => $val->kr0038,
                    'kr0039' => $val->kr0039,
                    'kr0040' => $val->kr0040,
                    'kr0041' => $val->kr0041,
                    'kr0042' => $val->kr0042,
                    'kr0043' => $val->kr0043,
                    'kr0044' => $val->kr0044,
                    'kr0045' => $val->kr0045,
                    'kr0046' => $val->kr0046,
                    'kr0047' => $val->kr0047,
                    'kr0048' => $val->kr0048,
                    'kr0049' => $val->kr0049,
                    'kr0050' => $val->kr0050,
                    'kr0051' => $val->kr0051,
                    'kr0052' => $val->kr0052,
                    'kr0053' => $val->kr0053,
                    'kr0054' => $val->kr0054,
                    'kr0055' => $val->kr0055,
                    'kr0056' => $val->kr0056,
                    'kr0057' => $val->kr0057,
                    'kr0058' => $val->kr0058,
                    'kr0059' => $val->kr0059,
                    'kr0060' => $val->kr0060,
                    'kr0061' => $val->kr0061,
                    'kr0062' => $val->kr0062,
                    'kr0063' => $val->kr0063,
                    'kr0064' => $val->kr0064,
                    'kr0065' => $val->kr0065,
                    'kr0066' => $val->kr0066,
                    'kr0067' => $val->kr0067,
                    'kr0068' => $val->kr0068,
                    'kr0069' => $val->kr0069,
                    'kr0070' => $val->kr0070,
                    'kr0071' => $val->kr0071,
                    'kr0072' => $val->kr0072,
                    'kr0073' => $val->kr0073,
                    'kr0074' => $val->kr0074,
                    'kr0075' => $val->kr0075,
                    'kr0076' => $val->kr0076,
                    'kr0077' => $val->kr0077,
                    'kr0078' => $val->kr0078,
                    'kr0079' => $val->kr0079,
                    'kr0080' => $val->kr0080,
                    'kr0081' => $val->kr0081,
                    'kr0082' => Carbon::now()->format('Y-m-d H:i:s'),
                    'kr0083' => $val->kr0083,
                    'kr0084' => $val->kr0084,
                    'kr0085' => $val->kr0085,
                    'kr0086' => $val->kr0086,
                    'kr0087' => $val->kr0087,
                    'kr0088' => $val->kr0088,
                    'kr0089' => $val->kr0089,
                    'kr0090' => $val->kr0090,
                    'kr0091' => $val->kr0091,
                    'kr0092' => $val->kr0092,
                    'kr0093' => $val->kr0093,
                    'kr0094' => $val->kr0094,
                    'kr0095' => $val->kr0095,
                    'kr0096' => $val->kr0096,
                    'kr0097' => $val->kr0097,
                    'kr0098' => $val->kr0098,
                    'kr0099' => $val->kr0099,
                    'kr0100' => $val->kr0100,
                    'kr0101' => $val->kr0101,
                    'kr0102' => $val->kr0102,
                    'kr0103' => $val->kr0103,
                    'kr0104' => $val->kr0104,
                    'kr0105' => $val->kr0105,
                    'kr0106' => $val->kr0106,
                    'kr0107' => $val->kr0107,
                    'kr0108' => $val->kr0108,
                    'kr0109' => $val->kr0109,
                    'kr0110' => $val->kr0110,
                    'kr0111' => $val->kr0111,
                    'kr0112' => $val->kr0112,
                    'kr0113' => $val->kr0113,
                    'kr0114' => $val->kr0114,
                    'kr0115' => $val->kr0115,
                    'kr0116' => $val->kr0116,
                    'kr0117' => $val->kr0117,
                    'kr0118' => $val->kr0118,
                ];
                $rireki = QueryHelper::insertData('rireki',$rireki_insert_data,'kr0000',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
            }
        }
    }
    
    public static function createActualDataHistory($bango,$page_no){
        $rireki = QueryHelper::fetchResult("
            select * 
            from rireki
            where kr0001 IN('V810','V830')
            and kr0001 NOT IN('V150','V160')
            and kr0073 = 1
            and kr0069 = 2
            and kr0071 != 9
            ");
        // dd("05-06", $rireki);
        $rireki2 = QueryHelper::fetchResult("
            select * 
            from rireki
            where kr0001 IN('V820')
            and kr0001 NOT IN('V150','V160')
            and kr0009 = 1
            and kr0052 = 1
            and kr0069 = 2
            and kr0071 != 9
            ");
        $mergedData = collect($rireki)->merge(collect($rireki2));
        foreach($mergedData as $key=>$val){
            $ys0011 = null;
            $ys0013 = null;
            $ys0028 = null;
            $ys0030 = null;
            $ys0032 = null;
            $ys0017_u2 = null;
            $ys0019_u2 = null;
            $ys0021_u2 = null;
            $ys0036_u2 = null;
            $ys0038_u2 = null;
            $ys0040_u2 = null;
            if($val->kr0007 == 'V110'){
                $ys0011 = $val->kr0030;
                $ys0013 = $val->kr0027;
                $ys0028 = $val->kr0025;
                $ys0030 = $val->kr0030;
                $ys0032 = $val->kr0027;
                $ys0017_u2 = $val->kr0025;
                $ys0019_u2 = $val->kr0030;
                $ys0021_u2 = $val->kr0027;
                $ys0036_u2 = $val->kr0025;
                $ys0038_u2 = $val->kr0030;
                $ys0040_u2 = $val->kr0027;
            }elseif($val->kr0007 == 'V120'){
                $ys0011 = $val->kr0030;
                $ys0013 = 0;
                $ys0028 = 0;
                $ys0030 = $val->kr0030;
                $ys0032 = 0;
                $ys0017_u2 = 0;
                $ys0019_u2 = $val->kr0030;
                $ys0021_u2 = 0;
                $ys0036_u2 = 0;
                $ys0038_u2 = $val->kr0030;
                $ys0040_u2 = 0;
            }elseif($val->kr0007 == 'V130'){
                $ys0011 = $val->kr0030;
                $ys0013 = 0;
                $ys0028 = 0;
                $ys0030 = $val->kr0030;
                $ys0032 = 0;
                $ys0017_u2 = 0;
                $ys0019_u2 = $val->kr0030;
                $ys0021_u2 = 0;
                $ys0036_u2 = 0;
                $ys0038_u2 = $val->kr0030;
                $ys0040_u2 = 0;
            }elseif($val->kr0007 == 'V140'){
                $ys0011 = $val->kr0030;
                $ys0013 = 0;
                $ys0028 = 0;
                $ys0030 = $val->kr0030;
                $ys0032 = 0;
                $ys0017_u2 = 0;
                $ys0019_u2 = $val->kr0030;
                $ys0021_u2 = 0;
                $ys0036_u2 = 0;
                $ys0038_u2 = $val->kr0030;
                $ys0040_u2 = 0;
            }
            $useful1_insert_data = [
                'useful1' => $val->kr0001 == 'V820' ? 'V920' : 'V910',
                'useful2' => 1,
                'useful3' => $val->kr0084,
                'useful4' => $val->kr0085,
                'useful5' => $val->kr0087,
                'useful6' => $val->kr0089,
                'useful7' => $val->kr0028,
                'useful8' => $val->kr0035,
                'useful9' => $val->kr0007,
                'useful10' => 0,
                'useful11' => $ys0011,
                'useful12' => 0,
                'useful13' => $ys0013,
                'useful14' => 0,
                'useful15' => 0,
                'useful16' => null,
                'useful17' => null,
                'useful18' => null,
                'useful19' => null,
                'useful20' => 0,
                'useful21' => 0,
                'useful22' => 0,
                'useful23' => Carbon::now()->format("Y-m-d H:i:s"),
                'useful24' => null,
                'useful25' => '0999',
                'useful26' => 1,
                'useful27' => 0,
                'useful28' => $ys0028,
                'useful29' => 0,
                'useful30' => $ys0030,
                'useful31' => 0,
                'useful32' => $ys0032,
                ];
            $useful1 = QueryHelper::insertData('useful1',$useful1_insert_data,'useful1',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
            
            $useful2_insert_data = [
                'useful1' => $val->kr0001 == 'V820' ? 'V920' : 'V910',
                'useful2' => 1,
                'useful3' => $val->kr0084,
                'useful4' => $val->kr0035,
                'useful5' => $val->kr0085,
                'useful6' => $val->kr0087,
                'useful7' => $val->kr0089,
                'useful8' => $val->kr0107,
                'useful9' => $val->kr0093,
                'useful10' => $val->kr0045,
                'useful11' => null,
                'useful12' => null,
                'useful13' => null,
                'useful14' => null,
                'useful15' => null,
                'useful16' => 0,
                'useful17' => $ys0017_u2,
                'useful18' => 0,
                'useful19' => $ys0019_u2,
                'useful20' => 0,
                'useful21' => $ys0021_u2,
                'useful22' => 0,
                'useful23' => 0,
                'useful24' => 0,
                'useful25' => null,
                'useful26' => null,
                'useful27' => null,
                'useful28' => 0,
                'useful29' => 0,
                'useful30' => 0,
                'useful31' => Carbon::now()->format("Y-m-d H:i:s"),
                'useful32' => null,
                'useful33' => '0999',
                'useful34' => 1,
                'useful35' => 0,
                'useful36' => $ys0036_u2,
                'useful37' => 0,
                'useful38' => $ys0038_u2,
                'useful39' => 0,
                'useful40' => $ys0040_u2,
                ];
            $useful2 = QueryHelper::insertData('useful2',$useful2_insert_data,'useful1',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
            
            //update review data
            $kr0000 = $val->kr0000;
            $kr0001 = $val->kr0001;
            $kr0002 = $val->kr0002;
            $kr0069 = $val->kr0069;
            $rireki_update_data = [
                'kr0000' => $kr0000,
                'kr0002' => $kr0002,
                'kr0069' => 1,
            ];
            QueryHelper::updateData('rireki', $rireki_update_data, ['kr0000'=>$kr0000,'kr0001'=>$kr0001,'kr0002'=>$kr0002,'kr0069'=>$kr0069], $bango, __CLASS__, __FUNCTION__, __LINE__);
        }
    }

    public static function getTantousyaData($search_val,$field_name){
        $tantousyaData = QueryHelper::fetchSingleResult("
            select   
            *
            from tantousya 
            where bango = '$search_val'
            ");
        if($tantousyaData){
            return $tantousyaData->$field_name;
        }else{
           return null;  
        }
    }
    
    public static function getCategoryData($search_val){
        if($search_val == null){
           return null; 
        }else{
            $cat1 = substr($search_val,0,2);
            $cat2 = substr($search_val,2);
            $categorykanriData = QueryHelper::fetchSingleResult("
                select   
                categorykanri.category4
                from categorykanri 
                where category1 = '$cat1' and category2 = '$cat2'
                ");
            if($categorykanriData){
                return $categorykanriData->category4;
            }else{
               return null;  
            }
        }
    }
    
}
