<?php

namespace App\AllClass\flatRateContract\createOrder;
use DB;
Use \Carbon\Carbon;
Use App\AllClass\master\csvRecordInsert;
use App\tantousya;
use App\AllClass\common\CreateOrderDetails;
// use App\AllClass\common\CreateOrderEntryAndHatchuData;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use App\AllClass\master\CSVLogger;
use Illuminate\Support\Facades\Input;
use File;
use App\Helpers\Helper;
use Session;

Class InsertOrder{ 
  public static function insert($request,$bango){ 

    session()->forget('normal_intorder05');
    session()->forget('group_intorder05');
    $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
    $bangoName=tantousya::find($bango)->name;
    $ck_orderbango = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7503'")->orderbango??null;

    foreach ($request as $key => $value){
        if ($key=='_token'||$key=='type') 
        {
          unset($request[$key]);
        }
    }
     
    $validator = ValidateInsertOrder::validate($request,$bango);
    
    $errors = $validator->errors();
        
    if($errors->any() || Input::has('field')){ 
        return $errors;  
    }else if(!$errors->any() && request('submit_confirmation') == ""){
       return "confirmation";
    }else{
        $kanryoubi_end = str_replace("/", "",substr(request('kanryoubi_end'),0,7));
        
        $query = AllCreateOrder::data($bango,$request)->toSql();
        $createOrderInfo = QueryHelper::fetchResult($query);
        
        //check date range
        $last_key = array_key_last($createOrderInfo);
        foreach($createOrderInfo as $tmp_key=>$tmp_val){
            if(strpos($tmp_val->datachar29,'～') !== false){
                $soukosyukkoData = QueryHelper::fetchResult("
                    select soukosyukko.*,substring(replace(soukosyukko.kanryoubi::text,'-',''),1,6) as modified_kanryoubi,
                    juchusyukko.datachar24,juchusyukko.dataint18,juchusyukko.dataint19  
                    from soukosyukko 
                    left join juchusyukko on juchusyukko.orderbango = soukosyukko.orderbango 
                        AND juchusyukko.hanbaibukacd = soukosyukko.hanbaibukacd
                        AND juchusyukko.dataint18 = soukosyukko.syouhinbango
                        AND juchusyukko.dataint19 = soukosyukko.yoteisu 
                    where soukosyukko.hanbaibukacd = '$tmp_val->hanbaibukacd' AND soukosyukko.syouhinbango = $tmp_val->syouhinbango and soukosyukko.syouhinid is null");
                foreach($soukosyukkoData as $souko_key=>$souko_val){
                    $modified_kanryoubi = $souko_val->modified_kanryoubi;
                    if($modified_kanryoubi>$kanryoubi_end){
                        $last_key++;
                        $createOrderInfo[$last_key] = (object)[
                            "bango" => $tmp_val->bango,
                            "datachar07" => $tmp_val->datachar07,
                            "datachar05" => $tmp_val->datachar05,
                            "intorder01" => $tmp_val->intorder01,
                            "datatxt0109" => $tmp_val->datatxt0109,
                            "datatxt0110" => $tmp_val->datatxt0110,
                            "numeric5" => $tmp_val->numeric5,
                            "datatxt0111" => $tmp_val->datatxt0111,
                            "datatxt0112" => $tmp_val->datatxt0112,
                            "datatxt0113" => $tmp_val->datatxt0113,
                            "numeric6" => $tmp_val->numeric6,
                            "numeric7" => $tmp_val->numeric7,
                            "information1" => $tmp_val->information1,
                            "information1_detail" => $tmp_val->information1_detail,
                            "information2" => $tmp_val->information2,
                            "information2_detail" => $tmp_val->information2_detail,
                            "information3" => $tmp_val->information3,
                            "information3_detail" => $tmp_val->information3_detail,
                            "information6" => $tmp_val->information6,
                            "information6_detail" => $tmp_val->information6_detail,
                            "information8" => $tmp_val->information8,
                            "datatxt0114" => $tmp_val->datatxt0114,
                            "datatxt0115" => $tmp_val->datatxt0115,
                            "kessaihouhou" => $tmp_val->kessaihouhou,
                            "datatxt0116" => $tmp_val->datatxt0116,
                            "datatxt0117" => $tmp_val->datatxt0117,
                            "housoukubun" => $tmp_val->housoukubun,
                            "otodoketime" => $tmp_val->otodoketime,
                            "date0001" => $tmp_val->date0001,
                            "datatxt0118" => $tmp_val->datatxt0118,
                            "datatxt0119" => $tmp_val->datatxt0119,
                            "datatxt0124" => $tmp_val->datatxt0124,
                            "datatxt0124_detail" => $tmp_val->datatxt0124_detail,
                            "numericmax" => $tmp_val->numericmax,
                            "datatxt0123" => $tmp_val->datatxt0123,
                            "datatxt0123_detail" => $tmp_val->datatxt0123_detail,
                            "datatxt0120" => $tmp_val->datatxt0120,
                            "numeric1" => $tmp_val->numeric1,
                            "numeric8" => $tmp_val->numeric8,
                            "numeric9" => $tmp_val->numeric9,
                            "numeric10" => $tmp_val->numeric10,
                            "datatxt0121" => $tmp_val->datatxt0121,
                            "datatxt0122" => $tmp_val->datatxt0122,
                            "datatxt0122_detail" => $tmp_val->datatxt0122_detail,
                            "date0002" => $tmp_val->date0002,
                            "date0003" => $tmp_val->date0003,
                            "date0004" => $tmp_val->date0004,
                            "date0005" => $tmp_val->date0005,
                            "money1" => $tmp_val->money1,
                            "money2" => $tmp_val->money2,
                            "money3" => $tmp_val->money3,
                            "money4" => $tmp_val->money4,
                            "money5" => $tmp_val->money5,
                            "money6" => $tmp_val->money6,
                            "money7" => $tmp_val->money7,
                            "money8" => $tmp_val->money8,
                            "datatxt0125" => $tmp_val->datatxt0125,
                            "datatxt0129" => $tmp_val->datatxt0129,
                            "orderbango" => $souko_val->orderbango,
                            "hanbaibukacd" => $souko_val->hanbaibukacd,
                            "kawasename" => $souko_val->kawasename,
                            "syouhinname" => $souko_val->syouhinname,
                            "kaiinid" => $souko_val->kaiinid,
                            "syukkasu" => $souko_val->syukkasu,
                            "datachar02" => $souko_val->datachar02,
                            "datachar03" => $souko_val->datachar03,
                            "datachar04" => $souko_val->datachar04,
                            "dataint09" => $souko_val->dataint09,
                            "dataint10" => $souko_val->dataint10,
                            "soukosyukko_datachar05" => $tmp_val->soukosyukko_datachar05,
                            "datachar05_detail" => $tmp_val->datachar05_detail,
                            "datachar06" => $souko_val->datachar06,
                            "datachar06_detail" => $tmp_val->datachar06_detail,
                            "soukosyukko_datachar07" => $tmp_val->soukosyukko_datachar07,
                            "datachar08" => $souko_val->datachar08,
                            "datachar09" => $souko_val->datachar09,
                            "syouhinbango" => $souko_val->syouhinbango,
                            "yoteisu" => $souko_val->yoteisu,
                            "count_yoteisu" => $tmp_val->count_yoteisu,
                            "datachar29" => $souko_val->datachar29,
                            "genka" => $souko_val->genka,
                            "season" => $souko_val->season,
                            "syouhinid" => $souko_val->syouhinid,
                            "syouhizeiritu" => $souko_val->syouhizeiritu,
                            "syukkomotobango" => $souko_val->syukkomotobango,
                            "syukkosakibango" => $souko_val->syukkosakibango,
                            "syukkosoukobango" => $souko_val->syukkosoukobango,
                            "syukkameter" => $souko_val->syukkameter,
                            "zaikometer" => $souko_val->zaikometer,
                            "codename" => $souko_val->codename,
                            "seikyubango" => $souko_val->seikyubango,
                            "denpyobango" => $souko_val->denpyobango,
                            "kanryoubi" => str_replace("-","/",substr($souko_val->kanryoubi,0,10)),
                            "soukobango" => $souko_val->soukobango,
                            "denpyoshimebi" => $souko_val->denpyoshimebi,
                            "syouhinbukacd" => $souko_val->syouhinbukacd,
                            "datachar26" => $tmp_val->datachar26,
                            "datachar27" => $tmp_val->datachar27,
                            "soukonyuko_datachar09" => $tmp_val->soukonyuko_datachar09,
                            "datachar09_detail" => $tmp_val->datachar09_detail,
                            "datachar24" => $souko_val->datachar24,
                            "dataint18" => $souko_val->dataint18,
                            "dataint19" => $souko_val->dataint19
                        ];
                    }
                }
            }
        }
        //$createOrderInfo = collect($createOrderInfo)->sortBy('hanbaibukacd')->sortBy('date0004')->sortBy('syouhinbango')->toArray();
        
        //check order will be created or not created
        $order_create_status = 0;
        foreach($createOrderInfo as $ck_key=>$ck_val){
            $ck_kanryoubi = (int) str_replace("/","",$ck_val->kanryoubi);
            $ck_datatxt0110 = $ck_val->datatxt0110;
            if($ck_kanryoubi <= $ck_orderbango){
                $no_order_create_msg[] = "定期定額契約番号=".$ck_datatxt0110;
                $order_create_status++;
            }
        }
        
        $query2 = AllCreateOrderGrouping::data($bango,$request)->toSql();
        $createOrderGroupingInfo = QueryHelper::fetchResult($query2);
        
        //check date range for grouping data
        $grp_last_key = array_key_last($createOrderGroupingInfo);
        foreach($createOrderGroupingInfo as $grp_tmp_key=>$grp_tmp_val){
            if(strpos($grp_tmp_val->datachar29,'～') !== false){
                $soukosyukkoGrpData = QueryHelper::fetchResult("select soukosyukko.*,substring(replace(soukosyukko.kanryoubi::text,'-',''),1,6) as modified_kanryoubi,
                    juchusyukko.datachar24,juchusyukko.dataint18,juchusyukko.dataint19 
                    from soukosyukko 
                    left join juchusyukko on juchusyukko.orderbango = soukosyukko.orderbango 
                        AND juchusyukko.hanbaibukacd = soukosyukko.hanbaibukacd
                        AND juchusyukko.dataint18 = soukosyukko.syouhinbango
                        AND juchusyukko.dataint19 = soukosyukko.yoteisu 
                    where soukosyukko.hanbaibukacd = '$grp_tmp_val->hanbaibukacd' AND soukosyukko.syouhinbango = $grp_tmp_val->syouhinbango and soukosyukko.syouhinid is null");
                foreach($soukosyukkoGrpData as $souko_grp_key=>$souko_grp_val){
                    $modified_grp_kanryoubi = $souko_grp_val->modified_kanryoubi;
                    
                    if($modified_grp_kanryoubi > $kanryoubi_end){
                        $grp_last_key++;
                        $createOrderGroupingInfo[$grp_last_key] = (object)[
                            "bango" => $grp_tmp_val->bango,
                            "datachar07" => $grp_tmp_val->datachar07,
                            "datachar05" => $grp_tmp_val->datachar05,
                            "intorder01" => $grp_tmp_val->intorder01,
                            "datatxt0109" => $grp_tmp_val->datatxt0109,
                            "datatxt0110" => $grp_tmp_val->datatxt0110,
                            "numeric5" => $grp_tmp_val->numeric5,
                            "datatxt0111" => $grp_tmp_val->datatxt0111,
                            "datatxt0112" => $grp_tmp_val->datatxt0112,
                            "datatxt0113" => $grp_tmp_val->datatxt0113,
                            "numeric6" => $grp_tmp_val->numeric6,
                            "numeric7" => $grp_tmp_val->numeric7,
                            "information1" => $grp_tmp_val->information1,
                            "information1_detail" => $grp_tmp_val->information1_detail,
                            "information2" => $grp_tmp_val->information2,
                            "information2_detail" => $grp_tmp_val->information2_detail,
                            "information3" => $grp_tmp_val->information3,
                            "information3_detail" => $grp_tmp_val->information3_detail,
                            "information6" => $grp_tmp_val->information6,
                            "information6_detail" => $grp_tmp_val->information6_detail,
                            "datatxt0114" => $grp_tmp_val->datatxt0114,
                            "datatxt0115" => $grp_tmp_val->datatxt0115,
                            "kessaihouhou" => $grp_tmp_val->kessaihouhou,
                            "datatxt0116" => $grp_tmp_val->datatxt0116,
                            "datatxt0117" => $grp_tmp_val->datatxt0117,
                            "housoukubun" => $grp_tmp_val->housoukubun,
                            "otodoketime" => $grp_tmp_val->otodoketime,
                            "date0001" => $grp_tmp_val->date0001,
                            "datatxt0118" => $grp_tmp_val->datatxt0118,
                            "datatxt0119" => $grp_tmp_val->datatxt0119,
                            "datatxt0124" => $grp_tmp_val->datatxt0124,
                            "datatxt0124_detail" => $grp_tmp_val->datatxt0124_detail,
                            "numericmax" => $grp_tmp_val->numericmax,
                            "datatxt0123" => $grp_tmp_val->datatxt0123,
                            "datatxt0123_detail" => $grp_tmp_val->datatxt0123_detail,
                            "datatxt0120" => $grp_tmp_val->datatxt0120,
                            "numeric1" => $grp_tmp_val->numeric1,
                            "numeric8" => $grp_tmp_val->numeric8,
                            "numeric9" => $grp_tmp_val->numeric9,
                            "numeric10" => $grp_tmp_val->numeric10,
                            "datatxt0121" => $grp_tmp_val->datatxt0121,
                            "datatxt0122" => $grp_tmp_val->datatxt0122,
                            "datatxt0122_detail" => $grp_tmp_val->datatxt0122_detail,
                            "date0002" => $grp_tmp_val->date0002,
                            "date0003" => $grp_tmp_val->date0003,
                            "date0004" => $grp_tmp_val->date0004,
                            "date0005" => $grp_tmp_val->date0005,
                            "money1" => $grp_tmp_val->money1,
                            "money2" => $grp_tmp_val->money2,
                            "money3" => $grp_tmp_val->money3,
                            "money4" => $grp_tmp_val->money4,
                            "money5" => $grp_tmp_val->money5,
                            "money6" => $grp_tmp_val->money6,
                            "money7" => $grp_tmp_val->money7,
                            "money8" => $grp_tmp_val->money8,
                            "datatxt0125" => $grp_tmp_val->datatxt0125,
                            "datatxt0129" => $grp_tmp_val->datatxt0129,
                            "orderbango" => $souko_grp_val->orderbango,
                            "hanbaibukacd" => $souko_grp_val->hanbaibukacd,
                            "kawasename" => $souko_grp_val->kawasename,
                            "syouhinname" => $souko_grp_val->syouhinname,
                            "kaiinid" => $souko_grp_val->kaiinid,
                            "syukkasu" => $souko_grp_val->syukkasu,
                            "datachar02" => $souko_grp_val->datachar02,
                            "datachar03" => $souko_grp_val->datachar03,
                            "datachar04" => $souko_grp_val->datachar04,
                            "dataint09" => $souko_grp_val->dataint09,
                            "dataint10" => $souko_grp_val->dataint10,
                            "soukosyukko_datachar05" => $grp_tmp_val->soukosyukko_datachar05,
                            "datachar05_detail" => $grp_tmp_val->datachar05_detail,
                            "datachar06" => $souko_grp_val->datachar06,
                            "datachar06_detail" => $grp_tmp_val->datachar06_detail,
                            "soukosyukko_datachar07" => $grp_tmp_val->soukosyukko_datachar07,
                            "datachar08" => $souko_grp_val->datachar08,
                            "datachar09" => $souko_grp_val->datachar09,
                            "syouhinbango" => $souko_grp_val->syouhinbango,
                            "yoteisu" => $souko_grp_val->yoteisu,
                            "count_yoteisu" => $grp_tmp_val->count_yoteisu,
                            "datachar29" => $souko_grp_val->datachar29,
                            "genka" => $souko_grp_val->genka,
                            "season" => $souko_grp_val->season,
                            "syouhinid" => $souko_grp_val->syouhinid,
                            "syouhizeiritu" => $souko_grp_val->syouhizeiritu,
                            "syukkomotobango" => $souko_grp_val->syukkomotobango,
                            "syukkosakibango" => $souko_grp_val->syukkosakibango,
                            "syukkosoukobango" => $souko_grp_val->syukkosoukobango,
                            "syukkameter" => $souko_grp_val->syukkameter,
                            "zaikometer" => $souko_grp_val->zaikometer,
                            "codename" => $souko_grp_val->codename,
                            "seikyubango" => $souko_grp_val->seikyubango,
                            "denpyobango" => $souko_grp_val->denpyobango,
                            "kanryoubi" => str_replace("-","/",substr($souko_grp_val->kanryoubi,0,10)),
                            "soukobango" => $souko_grp_val->soukobango,
                            "denpyoshimebi" => $souko_grp_val->denpyoshimebi,
                            "syouhinbukacd" => $souko_grp_val->syouhinbukacd,
                            "datachar26" => $grp_tmp_val->datachar26,
                            "datachar27" => $grp_tmp_val->datachar27,
                            "soukonyuko_datachar09" => $grp_tmp_val->soukonyuko_datachar09,
                            "datachar09_detail" => $grp_tmp_val->datachar09_detail,
                            "datachar24" => $souko_grp_val->datachar24,
                            "dataint18" => $souko_grp_val->dataint18,
                            "dataint19" => $souko_grp_val->dataint19
                        ];
                    }
                }
            }
        }
        //$createOrderGroupingInfo = collect($createOrderGroupingInfo)->sortBy('hanbaibukacd')->sortBy('date0004')->sortBy('syouhinbango')->toArray();
        
        //check order will be created or not created
        foreach($createOrderGroupingInfo as $ck_grp_key=>$ck_grp_val){
            $ck_grp_kanryoubi = (int) str_replace("/","",$ck_grp_val->kanryoubi);
            $ck_grp_datatxt0110 = $ck_grp_val->datatxt0110;
            if($ck_grp_kanryoubi <= $ck_orderbango){
                $no_order_create_msg[] = "定期定額契約番号=".$ck_grp_datatxt0110;
                $order_create_status++;
            }
        }
        
        
        //error check
        if($order_create_status != 0){
            Session::flash('no_order_create_msg', $no_order_create_msg);
            $result['status'] = "ng";
            return $result;
        }
       
        
        $arr = [];
        $misyukko_arr = [];
        $parent_grp_arr = [];
        foreach($createOrderGroupingInfo as $key=>$value){
            $kaiinid = $value->kaiinid;
            $datatxt0112 = $value->datatxt0112;
            $kanryoubi = $value->kanryoubi;
            $information1 = $value->information1;
            $information2 = $value->information2;
            $information3 = $value->information3;
            $otodoketime = $value->otodoketime;
            $datatxt0125 = substr($value->datatxt0125,0,1);
            $kessaihouhou = $value->kessaihouhou;
            $information6 = $value->information6;
            $datachar05 = $value->datachar05;
            $housoukubun = $value->housoukubun;
            $count = 0;
            $syukkomotobango =$value->syukkomotobango;
            $syouhizeiritu =$value->syouhizeiritu;
          
            foreach($createOrderGroupingInfo as $sub_key=>$sub_value){
                if($kaiinid == $sub_value->kaiinid && $datatxt0112 == $sub_value->datatxt0112 && 
                    $kanryoubi == $sub_value->kanryoubi &&
                    $information1 == $sub_value->information1 &&
                    $information2 == $sub_value->information2 &&
                    $information3 == $sub_value->information3 &&
                    $otodoketime == $sub_value->otodoketime &&
                    $datatxt0125 == substr($sub_value->datatxt0125,0,1) &&
                    $kessaihouhou == $sub_value->kessaihouhou &&
                    $information6 == $sub_value->information6 &&
                    $datachar05 == $sub_value->datachar05 &&
                    $housoukubun == $sub_value->housoukubun &&
                    $sub_value->kaiinid != "U123"
                ){
                    
                    if($count != 0){
                        $syukkomotobango = $syukkomotobango + $sub_value->syukkomotobango;
                        $syouhizeiritu = $syouhizeiritu + $sub_value->syouhizeiritu;
                    }
                    $count++;
                }
            }
            
            if($count>1){
                if(strpos($value->datachar29,'～') !== false){
                    $parent_grp_arr[] = $value->hanbaibukacd.'_' . $value->syouhinbango;
                }
                $value->syukkomotobango = $syukkomotobango;
                $value->syouhizeiritu = $syouhizeiritu;
                $arr[$kanryoubi.'-'.$kaiinid] = $value;
                $misyukko_arr[$kanryoubi.'-'.$kaiinid][] = $value;
            }else{
                //$arr[$kanryoubi] = $value;
                //$misyukko_arr[$kanryoubi][] = $value;
                if(strpos($value->datachar29,'～') !== false){
                    $parent_grp_arr[] = $value->hanbaibukacd.'_' . $value->syouhinbango;
                }
                $arr[] = $value;
                $misyukko_arr[][]= $value;
            }
            
        }
       
        $mytime=str_replace(":","",$mytime);  
        $mytime=str_replace("-","",$mytime);  
        $mytime=str_replace(" ","",$mytime);

        $result = array();
        $success_msg = [];
        
        //start log query
        $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 定期定額→受注データ作成 start\n";
        QueryHandler::logger($bango,$log_data);
        
        $conn = pg_connect("host=".env("DB_HOST")." port=".env("DB_PORT")."  dbname=".env("DB_DATABASE")." user=".env("DB_USERNAME")." password=".env("DB_PASSWORD"));
        pg_query($conn,mb_convert_encoding("BEGIN", "CP51932"));
        try{
            $i = 1;
            $datachar02 = "";
            $parent_check_arr = [];
            foreach($createOrderInfo as $key=>$val){
                if($val->datatxt0125 == null){
                    $orderInfo = self::getOrderBango();
                    $kokyakuorderbango = $orderInfo['kokyakuorderbango'];
                    $review_orderbango = $orderInfo['review_orderbango'];
                    
                    //parent check
                    if(strpos($val->datachar29,'～') !== false){
                        session()->put($val->hanbaibukacd.'_' . $val->syouhinbango, $kokyakuorderbango);
                        $parent_check_arr[] = $val->hanbaibukacd.'_' . $val->syouhinbango;
                    }
                    
                    $parent_session_name = $val->hanbaibukacd.'_' . $val->syouhinbango;
                    if(session()->has($parent_session_name)){
                        $datatxt0109 = session()->get($parent_session_name);
                    }else{
                        $datatxt0109 = $kokyakuorderbango;
                    }
                    
                    $count_yoteisu = (int) $val->count_yoteisu;
                    $numeric10 = (int) $val->numeric10;
                    if($count_yoteisu > 0 && $numeric10 > 1 && $val->yoteisu == 0){
                        $hikiatesyukko_datachar02 = 'not_parent';
                        $hikiatesyukko_datachar03 = null;
                        $datachar01 = '2';
                        $datachar02 = 'U122';
                        $datachar04 = 2;
                        //$datachar08 = 2;
                        $datachar08 = 1;
                        $datachar09 = 2;
                        $datachar10 = 2;
                        $dataint17 = 2;
                    }else if($count_yoteisu > 0 && $numeric10 > 1 && $val->yoteisu > 0){
                        $hikiatesyukkoData = QueryHelper::fetchSingleResult("select datachar02,datachar03 from hikiatesyukko where syouhinid = '$datatxt0109'");
                        if($hikiatesyukkoData){
                            $hikiatesyukko_datachar02 = $hikiatesyukkoData->datachar02;
                            $hikiatesyukko_datachar03 = $hikiatesyukkoData->datachar03;
                        }else{
                            $hikiatesyukko_datachar02 = null;
                            $hikiatesyukko_datachar03 = null;
                        }
                        $datachar01 = '3';
                        $datachar02 = 'U123';
                        $datachar04 = 2;
                        $datachar08 = 2;
                        $datachar09 = 1;
                        $datachar10 = 1;
                        $dataint17 = 1;
                    }else{
                        $hikiatesyukko_datachar02 = 'not_parent';
                        $hikiatesyukko_datachar03 = null;
                        $datachar01 = '2';
                        $datachar02 = 'U120';
                        $datachar04 = 2;
                        $datachar08 = 2;
                        $datachar09 = 2;
                        $datachar10 = 2;
                        $dataint17 = 1;
                    }
                    
                    //calculate date
                    $information2 = substr($createOrderInfo[$key]->information2,0,8); 
                    $date = $val->kanryoubi;
                    //$date = substr($date,0,8).str_pad($val->datatxt0117,2,0,STR_PAD_LEFT);
                    $add_day = $val->datatxt0117;
                    $add_month = $val->datatxt0116;
                    
                    //check intorder05 value
                    if(session()->has('normal_intorder05')){
                        $normal_intorder05_arr = session()->get('normal_intorder05');
                        $normal_search_val = $val->hanbaibukacd.'_'.$val->syouhinbango;
                        if (array_search($normal_search_val, $normal_intorder05_arr)){
                            $normal_prev_val = array_search($normal_search_val, $normal_intorder05_arr);
                            $intorder05 = $normal_prev_val;
                        }else{
                            $intorder05 = self::getCalculatedDate($date,$add_month,$add_day,$information2);
                        }
                    }else{
                        $intorder05 = self::getCalculatedDate($date,$add_month,$add_day,$information2);
                    }
                    $normal_intorder05[$intorder05] = $val->hanbaibukacd.'_'.$val->syouhinbango;
                    session()->put("normal_intorder05", $normal_intorder05);
                    //check intorder05 end
                    
                    //insert data in orderhenkan table
                    if($val->datatxt0113 != null){
                        $datatxt0113 = $val->datatxt0113;
                        $temp_data = QueryHelper::fetchSingleResult("select max(ordertypebango2) as max_ordertypebango2, intorder01 from orderhenkan where kokyakuorderbango = '$datatxt0113' group by intorder01");
                        if(isset($temp_data->intorder01)){
                            $intorder01 = $temp_data->intorder01;
                        }else{
                            $intorder01 = str_replace('/','',$val->kanryoubi);
                        }
                    }else{
                        $intorder01 = str_replace('/','',$val->kanryoubi);
                    }
                    $orderhenkan_insert_data = [
                        'kokyakuorderbango' => $kokyakuorderbango,
                        'ordertypebango' => 2,
                        'ordertypebango2' => 0,
                        'datachar01' => 1,
                        'datachar02' => $datachar02,
                        'datachar06' => 0,
                        'datachar05' => $val->datachar05,
                        //'intorder01' => str_replace('/','',$val->kanryoubi),
                        'intorder01' => $intorder01,
                        'intorder02' => str_replace('/','',$val->kanryoubi),
                        'intorder03' => str_replace('/','',$val->kanryoubi),
                        'intorder04' => str_replace('/','',$val->kanryoubi),
                        'intorder05' => $intorder05,
                        'synchroorderbango' => 0,
                        'date' => Carbon::now()->format('Y-m-d H:i:s'),
                        'orderuserbango' => $bango,
                    ];
                    $orderhenkan = QueryHelper::insertData('orderhenkan',$orderhenkan_insert_data,'bango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                    
                    //$information7 = $val->datatxt0118;
                    //$information8 = $val->datatxt0119;
                    if($val->datatxt0125 == null){
                        $information7 = $val->datachar29;
                        $information8 = $val->datachar08;
                    }else{
                        $information7 = null;
                        $information8 = null;
                    }
                    
                    //insert data in tuhanorder table
                    $tuhanorder_insert_data = [
                        'juchubango' => $kokyakuorderbango,
                        'datatxt0109' => $datatxt0109,
                        'orderbango' => $orderhenkan->bango,
                        'information1' => $val->information1,
                        'information2' => $val->information2,
                        'information3' => $val->information3,
                        'information6' => $val->information6,
                        'information7' => $information7,
                        'information8' => $information8,
                        'kessaihouhou' => $val->kessaihouhou,
                        'housoukubun' => $val->housoukubun,
                        'chumonsyajouhou' => 'U27',
                        'soufusakijouhou' => 'U34',
                        //'information7' => $val->datatxt0118,
                        //'information8' => $val->datatxt0119,
                        'otodoketime' => $val->otodoketime,
                        'money10' => $val->syouhizeiritu,
                        'moneymax' => $val->syukkomotobango,
                        'juchukubun1' => $val->syouhinname,
                    ];
                    $tuhanorder = QueryHelper::insertData('tuhanorder',$tuhanorder_insert_data,'datatxt0110',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                    
                    //insert data in hikiatesyukko table
                    if($hikiatesyukko_datachar02 == 'not_parent'){
                        $hikiatesyukko_datachar02 = $orderhenkan->datachar05;
                    }
                    $hikiatesyukko_insert_data = [
                        'syouhinid' => $kokyakuorderbango,
                        'orderbango' => $orderhenkan->bango,
                        //'datachar01' => 2,
                        'datachar01' => $datachar01,
                        //'datachar02' => $orderhenkan->datachar05,
                        'datachar02' => $hikiatesyukko_datachar02,
                        'datachar03' => $hikiatesyukko_datachar03,
                        //'datachar04' => 2,
                        'datachar04' => $datachar04,
                        //'datachar06' => 3,
                        'datachar06' => 2,
                        'yoteimeter' => 0,
                        'tanabango' => static::getCurrentTime(),
                        'tantousyabango' => $bango,
                        //'datachar08' => $datachar08,
                        'datachar08' => null,
                        'datachar09' => $datachar09,
                        'datachar10' => $datachar10,
                        'datachar16' => 2,
                        'datachar17' => null,
                        'datachar18' => null,
                    ];
                    $hikiatesyukko = QueryHelper::insertData('hikiatesyukko',$hikiatesyukko_insert_data,'hanbaibukacd',true,$bango,__CLASS__,__FUNCTION__,__LINE__);

                    if($val->kaiinid == 'U122'){
                        $datachar13 = 3;
                    }else{
                        $datachar13 = 1;
                    }
                    
                    //insert data in misyukko table
                    $misyukko_insert_data = [
                        'orderbango' => $orderhenkan->bango,
                        'syouhinid' => $kokyakuorderbango,
                        //'syouhinsyu' => $i,
                        'syouhinsyu' => 1,
                        'hantei' => 0,
                        'dataint01' => 0,
                        //'dataint02' => $i,
                        'dataint02' => 1,
                        'datachar13' => $datachar13,
                        'kawasename' => $val->kawasename,
                        'syouhinname' => $val->syouhinname,
                        'syukkasu' => $val->syukkasu,
                        'codename' => $val->codename,
                        'dataint04' => round($val->syouhizeiritu / $val->syukkasu),
                        'dataint05' => round($val->syukkameter / $val->syukkasu),
                        'dataint06' => round($val->zaikometer / $val->syukkasu),
                        'dataint07' => round($val->seikyubango / $val->syukkasu),
                        'dataint08' => round($val->denpyobango / $val->syukkasu),
                        'dataint16' => 0,
                        'dataint17' => $dataint17,
                        'dataint18' => $val->syouhizeiritu,
                        'datachar01' => $orderhenkan->datachar05,
                        'datachar02' => $val->datachar02,
                        'datachar03' => $val->datachar03,
                        'datachar04' => $val->datachar04,
                        'datachar05' => $val->soukosyukko_datachar05,
                        'dataint09' => str_replace('/','',$val->dataint09),
                        'dataint10' => str_replace('/','',$val->dataint10),
                        'datachar06' => $val->datachar06,
                        'datachar07' => $val->soukosyukko_datachar07,
                        'datachar08' => $val->datachar08,
                        'datachar09' => $val->datachar09,
                        'datachar15' => $val->numeric5,
                        'datachar21' => $val->hanbaibukacd,
                        'datachar22' => '0000',
                        'yoteimeter' => 0,
                        'tanabango' => Carbon::now()->format('Y-m-d H:i:s'),
                        'tantousyabango' => $bango,
                        'datachar12' => 'E92',
                    ];
                    $misyukko_insert = QueryHelper::insertData('misyukko',$misyukko_insert_data,'orderbango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                    $misyukko = QueryHelper::fetchSingleResult("select  syouhinid,syouhinsyu,hantei from misyukko where orderbango = '$orderhenkan->bango' AND syouhinid = '$kokyakuorderbango'");
                    
                    //update tuhanorder data
                    $tuhanorder_update_data = [
                        'juchubango' => $kokyakuorderbango,
                        'orderbango' => $orderhenkan->bango,
                        'chumonbango' => $val->hanbaibukacd,
                    ];
                    QueryHelper::updateData('tuhanorder', $tuhanorder_update_data, ['juchubango' => $kokyakuorderbango,'orderbango'=>$orderhenkan->bango], $bango, __CLASS__, __FUNCTION__, __LINE__);
                    
                    //insert data in juchusyukko table
                    $juchusyukko_insert_data = [
                        'syouhinid' => $kokyakuorderbango,
                        'orderbango' => $orderhenkan->bango,
                        'syouhinsyu' => $misyukko->syouhinsyu,
                        'hantei' => $misyukko->hantei,
                        'datachar01' => 1,
                        'datachar03' => 2,
                        'yoteimeter' => 0,
                        'datachar24' => null,
                        'datachar25' => null,
                        'datachar26' => null,
                        'datachar27' => null,
                        'tanabango' => Carbon::now()->format('Y-m-d H:i:s'),
                        'tantousyabango' => $bango,
                    ];
                    $juchusyukko = QueryHelper::insertData('juchusyukko',$juchusyukko_insert_data,'syouhinid',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                    
                    //update soukosyukko data
                    $soukosyukko_update_data = [
                        'hanbaibukacd' => $val->hanbaibukacd,
                        'syouhinbango' => $val->syouhinbango,
                        'yoteisu' => $val->yoteisu,
                        'syouhinid' => $misyukko->syouhinid,
                        'syouhinsyu' => $misyukko->syouhinsyu,
                        'hantei' => $misyukko->hantei,
                    ];
                    QueryHelper::updateData('soukosyukko', $soukosyukko_update_data, ['hanbaibukacd' => $val->hanbaibukacd,'syouhinbango'=>$val->syouhinbango,'yoteisu'=>$val->yoteisu], $bango, __CLASS__, __FUNCTION__, __LINE__);
                    
                    //update juchusyukko data
                    $juchusyukko_update_data = [
                        'hanbaibukacd' => $val->hanbaibukacd,
                        'dataint18' => $val->dataint18,
                        'dataint19' => $val->dataint19,
                        'datachar24' => 1,
                    ];
                    QueryHelper::updateData('juchusyukko', $juchusyukko_update_data, ['hanbaibukacd' => $val->hanbaibukacd,'dataint18'=>$val->dataint18,'dataint19'=>$val->dataint19], $bango, __CLASS__, __FUNCTION__, __LINE__);
                    
                    //update review data
                    $review_update_data = [
                        'kokyakusyouhinbango' => 'D7011',
                        'orderbango' => $review_orderbango,
                        'check_flag' => 0,
                        'color' => static::getCurrentTime(),
                        'nickname' => $bango,
                    ];
                    QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                    
                    //create history details => CreateOrderDetails::data($bango,$kokyakuorderbango, $ordertypebango2,$datachar01)
                    CreateOrderDetails::data($bango,$kokyakuorderbango, 0,1,'03-04');
                    
                    //Create 05-09 menu data
                    // CreateOrderEntryAndHatchuData::data($bango);

                    $success_msg[] = "受注番号 $kokyakuorderbango で登録しました。";
                    //Session::flash('success_msg', $success_msg);
                    
                    $i++;
                }
            }
            
            foreach($parent_check_arr as $p_key=>$p_val){
                session()->forget($p_val);
            }
            
            if(count($arr)>0){
                $grp_parent_check_arr = [];
                foreach($arr as $key=>$val){
                    $orderInfo = self::getOrderBango();
                    $kokyakuorderbango = $orderInfo['kokyakuorderbango'];
                    $review_orderbango = $orderInfo['review_orderbango'];
                    
                    //parent check
                    $grp_parent_session_name = $val->hanbaibukacd.'_' . $val->syouhinbango;
                    foreach($parent_grp_arr as $p_grp_key=>$p_grp_val){
                        if($p_grp_val == $grp_parent_session_name){
                            if(!session()->has($grp_parent_session_name)){ 
                            session()->put($p_grp_val, $kokyakuorderbango);
                            $grp_parent_check_arr[] = $p_grp_val;
                            }
                        }
                    }
                    
                    if(session()->has($grp_parent_session_name)){ 
                        $datatxt0109 = session()->get($grp_parent_session_name);
                    }else{
                        $datatxt0109 = $kokyakuorderbango;
                    }
                    
                    $count_yoteisu = (int) $val->count_yoteisu;
                    $numeric10 = (int) $val->numeric10;
                    if($count_yoteisu > 0 && $numeric10 > 1 && $val->yoteisu == 0){
                        $hikiatesyukko_datachar02 = 'not_parent';
                        $hikiatesyukko_datachar03 = null;
                        $datachar01 = '2';
                        $datachar02 = 'U122';
                        $datachar04 = 2;
                        //$datachar08 = 2;
                        $datachar08 = 1;
                        $datachar09 = 2;
                        $datachar10 = 2;
                        $dataint17 = 2;
                    }else if($count_yoteisu > 0 && $numeric10 > 1 && $val->yoteisu > 0){
                        $hikiatesyukkoData = QueryHelper::fetchSingleResult("select datachar02,datachar03 from hikiatesyukko where syouhinid = '$datatxt0109'");
                        if($hikiatesyukkoData){
                            $hikiatesyukko_datachar02 = $hikiatesyukkoData->datachar02;
                            $hikiatesyukko_datachar03 = $hikiatesyukkoData->datachar03;
                        }else{
                            $hikiatesyukko_datachar02 = null;
                            $hikiatesyukko_datachar03 = null;
                        }
                        $datachar01 = '3';
                        $datachar02 = 'U123';
                        $datachar04 = 2;
                        $datachar08 = 2;
                        $datachar09 = 1;
                        $datachar10 = 1;
                        $dataint17 = 1;
                    }else{
                        $hikiatesyukko_datachar02 = 'not_parent';
                        $hikiatesyukko_datachar03 = null;
                        $datachar01 = '2';
                        $datachar02 = 'U120';
                        $datachar04 = 2;
                        $datachar08 = 2;
                        $datachar09 = 2;
                        $datachar10 = 2;
                        $dataint17 = 1;
                    }
                    
                    //calculate date
                    $information2 = substr($arr[$key]->information2,0,8);
                    $date = $val->kanryoubi;
                    //$date = substr($date,0,8).str_pad($val->datatxt0117,2,0,STR_PAD_LEFT);
                    $add_day = $val->datatxt0117;
                    $add_month = $val->datatxt0116;
                    //$intorder05 = self::getCalculatedDate($date,$add_month,$add_day,$information2);
                    
                    //check intorder05 value
                    if(session()->has('group_intorder05')){
                        $group_intorder05_arr = session()->get('group_intorder05');
                        $group_search_val = $val->hanbaibukacd.'_'.$val->syouhinbango;
                        if (array_search($group_search_val, $group_intorder05_arr)){
                            $group_prev_val = array_search($group_search_val, $group_intorder05_arr);
                            $intorder05 = $group_prev_val;
                        }else{
                            $intorder05 = self::getCalculatedDate($date,$add_month,$add_day,$information2);
                        }
                    }else{
                        $intorder05 = self::getCalculatedDate($date,$add_month,$add_day,$information2);
                    }
                    $group_intorder05[$intorder05] = $val->hanbaibukacd.'_'.$val->syouhinbango;
                    session()->put("group_intorder05", $group_intorder05);
                    //check intorder05 end
                    
                    //insert data in orderhenkan table
                    if($val->datatxt0113 != null){
                        $datatxt0113 = $val->datatxt0113;
                        $temp_data = QueryHelper::fetchSingleResult("select max(ordertypebango2) as max_ordertypebango2, intorder01 from orderhenkan where kokyakuorderbango = '$datatxt0113' group by intorder01");
                        if(isset($temp_data->intorder01)){
                            $intorder01 = $temp_data->intorder01;
                        }else{
                            $intorder01 = str_replace('/','',$val->kanryoubi);
                        }
                    }else{
                        $intorder01 = str_replace('/','',$val->kanryoubi);
                    }
                    $orderhenkan_insert_data = [
                        'kokyakuorderbango' => $kokyakuorderbango,
                        'ordertypebango' => 2,
                        'ordertypebango2' => 0,
                        'datachar01' => 1,
                        'datachar02' => $datachar02,
                        'datachar06' => 0,
                        'datachar05' => $val->datachar05,
                        //'intorder01' => str_replace('/','',$val->kanryoubi),
                        'intorder01' => $intorder01,
                        'intorder02' => str_replace('/','',$val->kanryoubi),
                        'intorder03' => str_replace('/','',$val->kanryoubi),
                        'intorder04' => str_replace('/','',$val->kanryoubi),
                        'intorder05' => $intorder05,
                        'synchroorderbango' => 0,
                        'date' => Carbon::now()->format('Y-m-d H:i:s'),
                        'orderuserbango' => $bango,
                    ];
                    $orderhenkan = QueryHelper::insertData('orderhenkan',$orderhenkan_insert_data,'bango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);

                    //grouping check
                    //if(strpos($key, '-') !== false){
                    //    $information7 = null;
                    //    $information8 = null;
                    //}else{
                    //    $information7 = $val->datatxt0118;
                    //    $information8 = $val->datatxt0119;
                    //}
                    
                    if($val->datatxt0125 == null){
                        $information7 = $val->datachar29;
                        $information8 = $val->datachar08;
                    }else{
                        $information7 = null;
                        $information8 = null;
                    }
                    
                    //insert data in tuhanorder table
                    $tuhanorder_insert_data = [
                        'juchubango' => $kokyakuorderbango,
                        'orderbango' => $orderhenkan->bango,
                        'datatxt0109' => $datatxt0109,
                        'information1' => $val->information1,
                        'information2' => $val->information2,
                        'information3' => $val->information3,
                        'information6' => $val->information6,
                        'kessaihouhou' => $val->kessaihouhou,
                        'housoukubun' => $val->housoukubun,
                        'chumonsyajouhou' => 'U27',
                        'soufusakijouhou' => 'U34',
                        //'information7' => $val->datatxt0118,
                        'information7' => $information7,
                        //'information8' => $val->datatxt0119,
                        'information8' => $information8,
                        'otodoketime' => $val->otodoketime,
                        'money10' => $val->syouhizeiritu,
                        'moneymax' => $val->syukkomotobango,
                        'juchukubun1' => $val->syouhinname,
                    ];
                    $tuhanorder = QueryHelper::insertData('tuhanorder',$tuhanorder_insert_data,'datatxt0110',true,$bango,__CLASS__,__FUNCTION__,__LINE__);

                    //insert data in hikiatesyukko table
                    if($hikiatesyukko_datachar02 == 'not_parent'){
                        $hikiatesyukko_datachar02 = $orderhenkan->datachar05;
                    }
                    $hikiatesyukko_insert_data = [
                        'syouhinid' => $kokyakuorderbango,
                        'orderbango' => $orderhenkan->bango,
                        //'datachar01' => 2,
                        'datachar01' => $datachar01,
                        //'datachar02' => $orderhenkan->datachar05,
                        'datachar02' => $hikiatesyukko_datachar02,
                        'datachar03' => $hikiatesyukko_datachar03,
                        //'datachar04' => 2,
                        'datachar04' => $datachar04,
                        //'datachar06' => 3,
                        'datachar06' => 2,
                        'yoteimeter' => 0,
                        'tanabango' => static::getCurrentTime(),
                        'tantousyabango' => $bango,
                        //'datachar08' => $datachar08,
                        'datachar08' => null,
                        'datachar09' => $datachar09,
                        'datachar10' => $datachar10,
                        'datachar16' => 2,
                        'datachar17' => null,
                        'datachar18' => null,
                    ];
                    $hikiatesyukko = QueryHelper::insertData('hikiatesyukko',$hikiatesyukko_insert_data,'hanbaibukacd',true,$bango,__CLASS__,__FUNCTION__,__LINE__);

                    $j = 1;
                    foreach($misyukko_arr as $misyukko_key=>$misyukko_val){
                        if($key == $misyukko_key){
                            $syohnsyu = 1;
                            foreach($misyukko_val as $temp_key=>$temp_val){
                                if($temp_val->kaiinid == 'U122'){
                                    $datachar13 = 3;
                                }else{
                                    $datachar13 = 1;
                                }

                                //insert data in misyukko table
                                $misyukko_insert_data = [
                                    'orderbango' => $orderhenkan->bango,
                                    'syouhinid' => $kokyakuorderbango,
                                    //'syouhinsyu' => $j,
                                    'syouhinsyu' => $syohnsyu,
                                    'hantei' => 0,
                                    'dataint01' => 0,
                                    //'dataint02' => $j,
                                    'dataint02' => $syohnsyu,
                                    'datachar13' => $datachar13,
                                    'kawasename' => $temp_val->kawasename,
                                    'syouhinname' => $temp_val->syouhinname,
                                    'syukkasu' => $temp_val->syukkasu,
                                    'codename' => $temp_val->codename,
                                    'dataint04' => round($temp_val->syouhizeiritu / $temp_val->syukkasu),
                                    'dataint05' => round($temp_val->syukkameter / $temp_val->syukkasu),
                                    'dataint06' => round($temp_val->zaikometer / $temp_val->syukkasu),
                                    'dataint07' => round($temp_val->seikyubango / $temp_val->syukkasu),
                                    'dataint08' => round($temp_val->denpyobango / $temp_val->syukkasu),
                                    'datachar01' => $orderhenkan->datachar05,
                                    'datachar02' => $temp_val->datachar02,
                                    'datachar03' => $temp_val->datachar03,
                                    'datachar04' => $temp_val->datachar04,
                                    'datachar05' => $temp_val->soukosyukko_datachar05,
                                    'dataint09' => str_replace('/','',$temp_val->dataint09),
                                    'dataint10' => str_replace('/','',$temp_val->dataint10),
                                    'dataint16' => 0,
                                    'dataint17' => $dataint17,
                                    'dataint18' => $temp_val->syouhizeiritu,
                                    'datachar06' => $temp_val->datachar06,
                                    'datachar07' => $temp_val->soukosyukko_datachar07,
                                    'datachar08' => $temp_val->datachar08,
                                    'datachar09' => $temp_val->datachar09,
                                    'datachar15' => $temp_val->numeric5,
                                    'datachar21' => $temp_val->hanbaibukacd,
                                    'yoteimeter' => 0,
                                    'tanabango' => Carbon::now()->format('Y-m-d H:i:s'),
                                    'tantousyabango' => $bango,
                                    'datachar12' => 'E92',
                                    'datachar22' => '0000',
                                ];
                                $misyukko_insert = QueryHelper::insertData('misyukko',$misyukko_insert_data,'orderbango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                                $misyukko = QueryHelper::fetchSingleResult("select  syouhinid,syouhinsyu,hantei from misyukko where orderbango = '$orderhenkan->bango' AND syouhinid = '$kokyakuorderbango'");
                                
                                //update tuhanorder data
                                $tuhanorder_update_data = [
                                    'juchubango' => $kokyakuorderbango,
                                    'orderbango' => $orderhenkan->bango,
                                    'chumonbango' => $temp_val->hanbaibukacd,
                                ];
                                QueryHelper::updateData('tuhanorder', $tuhanorder_update_data, ['juchubango' => $kokyakuorderbango,'orderbango'=>$orderhenkan->bango], $bango, __CLASS__, __FUNCTION__, __LINE__);
                                
                                //insert data in juchusyukko table
                                $juchusyukko_insert_data = [
                                    'syouhinid' => $kokyakuorderbango,
                                    'orderbango' => $orderhenkan->bango,
                                    //'syouhinsyu' => $j,
                                    'syouhinsyu' => $syohnsyu,
                                    'hantei' => 0,
                                    'datachar01' => 1,
                                    'datachar03' => 2,
                                    'yoteimeter' => 0,
                                    'datachar24' => null,
                                    'datachar25' => null,
                                    'datachar26' => null,
                                    'datachar27' => null,
                                    'tanabango' => Carbon::now()->format('Y-m-d H:i:s'),
                                    'tantousyabango' => $bango,
                                ];
                                $juchusyukko = QueryHelper::insertData('juchusyukko',$juchusyukko_insert_data,'syouhinid',true,$bango,__CLASS__,__FUNCTION__,__LINE__);

                                //update soukosyukko data
                                $soukosyukko_update_data = [
                                    'hanbaibukacd' => $temp_val->hanbaibukacd,
                                    'syouhinbango' => $temp_val->syouhinbango,
                                    'yoteisu' => $temp_val->yoteisu,
                                    'syouhinid' => $misyukko->syouhinid,
                                    //'syouhinsyu' => $j,
                                    'syouhinsyu' => $syohnsyu,
                                    'hantei' => 0,
                                ];
                                QueryHelper::updateData('soukosyukko', $soukosyukko_update_data, ['hanbaibukacd' => $temp_val->hanbaibukacd,'syouhinbango'=>$temp_val->syouhinbango,'yoteisu'=>$temp_val->yoteisu], $bango, __CLASS__, __FUNCTION__, __LINE__);

                                //update juchusyukko data
                                $juchusyukko_update_data = [
                                    'hanbaibukacd' => $temp_val->hanbaibukacd,
                                    'dataint18' => $temp_val->dataint18,
                                    'dataint19' => $temp_val->dataint19,
                                    'datachar24' => 1,
                                ];
                                QueryHelper::updateData('juchusyukko', $juchusyukko_update_data, ['hanbaibukacd' => $temp_val->hanbaibukacd,'dataint18'=>$temp_val->dataint18,'dataint19'=>$temp_val->dataint19], $bango, __CLASS__, __FUNCTION__, __LINE__);
                                $syohnsyu++;
                                $j++;
                            }
                        }
                    }
                    
                    //update review data
                    $review_update_data = [
                        'kokyakusyouhinbango' => 'D7011',
                        'orderbango' => $review_orderbango,
                        'check_flag' => 0,
                        'color' => static::getCurrentTime(),
                        'nickname' => $bango,
                    ];
                    QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);

                    //create history details => CreateOrderDetails::data($bango,$kokyakuorderbango, $ordertypebango2,$datachar01)
                    CreateOrderDetails::data($bango,$kokyakuorderbango, 0,1,'03-04');
                    
                    //Create 05-09 menu data
                    // CreateOrderEntryAndHatchuData::data($bango);

                    $success_msg[] = "受注番号 $kokyakuorderbango で登録しました。";
                    //Session::flash('success_msg', $success_msg);

                    
                }
                //parent session destroy
                foreach($grp_parent_check_arr as $grp_p_key=>$grp_p_val){
                    session()->forget($grp_p_val);
                }
            }
            
           $msg = "";
            if(count($success_msg)>0){
                //Session::flash('success_msg', $success_msg);
                $total = count($success_msg);
                //$msg[] = "正常に処理が終了しました（".$total."）";
                $msg = "正常に処理が終了しました（".$total."）";
                //Session::flash('success_msg', $msg);
            }else{
                //end log query
                $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 定期定額→受注データ作成 end\n";
                QueryHandler::logger($bango,$log_data);

                $no_data_msg = "検索結果に該当するデータがありません。";
                //Session::flash('no_data_msg', $no_data_msg);
                $result['status'] = "ng";
                
                pg_query($conn,mb_convert_encoding("COMMIT", "CP51932"));
                return $result;
            }
           
            $result['status'] = "ok";
            $result['success_msg'] = $msg;

            //end log query
            $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 定期定額→受注データ作成 end\n";
            QueryHandler::logger($bango,$log_data);

            pg_query($conn,mb_convert_encoding("COMMIT", "CP51932"));
            return $result;
        } catch (\Exception $e) {
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
            QueryHandler::logger($bango, $log_data);
            
            pg_query($conn,mb_convert_encoding("ROLLBACK", "CP51932"));
            $result['status'] = "ng";
            $result['change_id'] = "";
            return $result;
        }
        
    }
  }   
  
    public static function getOrderBango(){
        $fiscal_year = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7501' ")->orderbango ?? null;
        $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7011'");
        if($reviewData){
            $orderbango = $reviewData->orderbango + 1;
            $mobile_flag = $reviewData->mobile_flag ;
        }else{
            $orderbango = "";
            $mobile_flag = "";
        }
        $kokyakuorderbango = "01".$fiscal_year.str_pad($orderbango,$mobile_flag,'0',STR_PAD_LEFT );
        return ['kokyakuorderbango'=>$kokyakuorderbango,'review_orderbango'=>$orderbango];
    }
    
    public static function getCalculatedDate($date,$add_month,$add_day,$information2){
        $effectiveDate = strtotime("+$add_month months", strtotime($date));
        $effectiveDate = strftime ( '%Y%m%d' , $effectiveDate );
        
        //check valid/invalid date
        $last_day = cal_days_in_month(CAL_GREGORIAN, substr($effectiveDate,4,2), substr($effectiveDate,0,4)); 
        if($add_day > $last_day){ 
            $effectiveDate = substr($effectiveDate,0,6).$last_day;
            $effectiveDate = self::beforeDateValidation($effectiveDate);
        }else{ 
            $effectiveDate = substr($effectiveDate,0,6).str_pad($add_day,2,0,STR_PAD_LEFT);
            //$effectiveDate = self::beforeDateValidation($effectiveDate);
        }

        $system_date = date('Ymd');
        $kokyakuCode = substr($information2, 0,6);
        $haisouCode = substr($information2, 6,2);
        $kokyaku = QueryHelper::select(['bango,ytoiawsestart,yetoiawseend'])->from('kokyaku1')->where("yobi12 = '$kokyakuCode' ")->get()->first();
        $others2 = QueryHelper::fetchResult("select other1,other3 from others2 where otherint1 = (select bango from haisou where haisou.shikibetsucode = '$kokyakuCode' and haisou.torihikisakibango = '$haisouCode')");
        if(substr($others2[0]->other1,0,1) == '1'){
            $request_date = substr($kokyaku->ytoiawsestart,2,2);
        }else if(substr($others2[0]->other1,0,1) == '2'){
            $request_date = substr($others2[0]->other3,2,2);
        }
        $modified_system_date = strtotime("+$request_date days", strtotime($system_date));
        $modified_system_date = strftime ( '%Y%m%d' , $modified_system_date );
       
        if($effectiveDate <= $modified_system_date){
            $payment_date = strtotime("+1 days", strtotime($effectiveDate));
            $payment_date = strftime ( '%Y%m%d' , $payment_date );
            
            //check valid/invalid date
            $temp_last_day = substr($payment_date,6,2);
            $last_day = cal_days_in_month(CAL_GREGORIAN, substr($payment_date,4,2), substr($payment_date,0,4)); 
            if($temp_last_day > $last_day){
                $payment_date = substr($payment_date,0,6).$last_day;
                $payment_date = self::beforeDateValidation($payment_date);
            }
            
            if(substr($kokyaku->yetoiawseend,0,1) == 1){ 
                return self::getAfterDate($payment_date);
            }else if(substr($kokyaku->yetoiawseend,0,1) == 2){
                return self::getBeforeDate($payment_date);
            }
        }else{
            if(substr($kokyaku->yetoiawseend,0,1) == 1){ 
                return self::getAfterDate($effectiveDate);
            }else if(substr($kokyaku->yetoiawseend,0,1) == 2){
                return self::getBeforeDate($effectiveDate);
            }
        }
    }
    
    public static function getAfterDate($payment_date){
        $specific_date = substr($payment_date,4,4); 
        if($specific_date == '1231'){
            $payment_date = strtotime("+4 days", strtotime($payment_date));
            $payment_date = strftime ( '%Y%m%d' , $payment_date );
            return self::afterDateValidation($payment_date);
        }else if($specific_date == '0101'){
            $payment_date = strtotime("+3 days", strtotime($payment_date));
            $payment_date = strftime ( '%Y%m%d' , $payment_date );
            return self::afterDateValidation($payment_date);
        }else if($specific_date == '0102'){
            $payment_date = strtotime("+2 days", strtotime($payment_date));
            $payment_date = strftime ( '%Y%m%d' , $payment_date );
            return self::afterDateValidation($payment_date);
        }else if($specific_date == '0103'){
            $payment_date = strtotime("+1 days", strtotime($payment_date));
            $payment_date = strftime ( '%Y%m%d' , $payment_date );
            return self::afterDateValidation($payment_date);
        }else{
            return self::afterDateValidation($payment_date);
        }
    }
    
    public static function getBeforeDate($payment_date){
        $specific_date = substr($payment_date,4,4); 
        if($specific_date == '1231'){
            $payment_date = strtotime("-1 days", strtotime($payment_date));
            $payment_date = strftime ( '%Y%m%d' , $payment_date );
            return self::beforeDateValidation($payment_date);
        }else if($specific_date == '0101'){
            $payment_date = strtotime("-2 days", strtotime($payment_date));
            $payment_date = strftime ( '%Y%m%d' , $payment_date );
            return self::beforeDateValidation($payment_date);
        }else if($specific_date == '0102'){
            $payment_date = strtotime("-3 days", strtotime($payment_date));
            $payment_date = strftime ( '%Y%m%d' , $payment_date );
            return self::beforeDateValidation($payment_date);
        }else if($specific_date == '0103'){
            $payment_date = strtotime("-4 days", strtotime($payment_date));
            $payment_date = strftime ( '%Y%m%d' , $payment_date );
            return self::beforeDateValidation($payment_date);
        }else{
            return self::beforeDateValidation($payment_date);
        }
    }
    
    public static function afterDateValidation($payment_date){
        $day = date('l', strtotime($payment_date));
        if($day == 'Saturday'){
            $payment_date = strtotime("+2 days", strtotime($payment_date));
            $payment_date = strftime ( '%Y%m%d' , $payment_date );
            return $payment_date;
        }else if($day == 'Sunday'){
            $payment_date = strtotime("+1 days", strtotime($payment_date));
            $payment_date = strftime ( '%Y%m%d' , $payment_date );
            return $payment_date;
        }else{
            return $payment_date;
        }
    }
    
    public static function beforeDateValidation($payment_date){
        $day = date('l', strtotime($payment_date));
        if($day == 'Saturday'){
            $payment_date = strtotime("-1 days", strtotime($payment_date));
            $payment_date = strftime ( '%Y%m%d' , $payment_date );
            return $payment_date;
        }else if($day == 'Sunday'){
            $payment_date = strtotime("-2 days", strtotime($payment_date));
            $payment_date = strftime ( '%Y%m%d' , $payment_date );
            return $payment_date;
        }else{
            return $payment_date;
        }
    }
    
    public static function getCurrentTime()
    {
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        return str_replace(" ", "", $mytime);
    }
    
  
} 
