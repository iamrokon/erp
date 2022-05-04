<?php

namespace App\AllClass\flatRateContract\flatRateEntry;
use DB;
Use \Carbon\Carbon;
Use App\AllClass\master\csvRecordInsert;
use App\tantousya;
use App\AllClass\Converter;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use App\AllClass\master\CSVLogger;
use Illuminate\Support\Facades\Input;
use File;
use App\Helpers\Helper;

Class editFlatRateEntry{
  public static function edit($request,$bango,$file=null){

    $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
    $bangoName=tantousya::find($bango)->name;

    foreach ($request as $key => $value){
        if ($key=='_token'||$key=='type')
        {
          unset($request[$key]);
        }
    }

    $validator = validateFlatRateEntry::validate($request,$bango);

    $errors = $validator->errors();

    if($errors->any() || Input::has('field')){
        return $errors;
    }else if(!$errors->any() && request('submit_confirmation') == ""){
            return "confirmation";
    }else{
        $mytime=str_replace(":","",$mytime);
        $mytime=str_replace("-","",$mytime);
        $mytime=str_replace(" ","",$mytime);

        $result = array();

        //start log query
        $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 定期定額契約入力 start\n";
        QueryHandler::logger($bango,$log_data);

        $conn = pg_connect("host=".env("DB_HOST")." port=".env("DB_PORT")."  dbname=".env("DB_DATABASE")." user=".env("DB_USERNAME")." password=".env("DB_PASSWORD"));
        pg_query($conn,"BEGIN");
        try{
            //$contractInfo = self::getFlatRateContractNumber();
            //$contract_number = $contractInfo['contract_number'];
            //$review_orderbango = $contractInfo['review_orderbango'];

            $contract_number = request('datatxt0110');
            $lbook_bango = "";

            if ($file != "") {
                $filenameWithExtension = $file->getClientOriginalName();
                $filename = explode('.', $filenameWithExtension);
                $newFileName = $filename[0].'¶_'.$contract_number.'_'.$mytime.'.'.$filename[1];
            }else if(request('hidden_filename') != ""){
                $newFileName = request('hidden_filename');
                $lbook_bango = request('hidden_lbook_bango');
            }else{
                $newFileName = request('hidden_filename');
            }

            //insert data in orderhenkan table
            $orderhenkan_update_data = [
                'datachar07' => $contract_number,
                'datachar05' => request('datachar05'),
                //'datachar02' => 0,
            ];
            $orderhenkan = QueryHelper::updateData('orderhenkan',$orderhenkan_update_data,'datachar07',$bango,__CLASS__,__FUNCTION__,__LINE__);


            //insert data in tuhanorder table
            $tuhanorder_update_data = [
                'datatxt0110' => $contract_number,
                'orderbango' => request('orderhenkan_bango'),
                'numeric5' => 1,
                'datatxt0111' => request('datatxt0111'),
                'datatxt0112' => "G1".request('datatxt0112'),
                'datatxt0113' => trim(request('datatxt0113')),
                'numeric6' => trim(request('numeric6')),
                'numeric7' => trim(request('numeric7')),
                'information1' => request('db_information1'),
                'information2' => request('db_information2'),
                'information3' => request('db_information3'),
                'information6' => request('db_information6'),
                'datatxt0114' => request('datatxt0114'),
                'datatxt0115' => $lbook_bango,
                'kessaihouhou' => request('kessaihouhou'),
                'datatxt0116' => request('datatxt0116'),
                'datatxt0117' => request('datatxt0117'),
                'housoukubun' => request('housoukubun'),
                'otodoketime' => request('otodoketime'),
                'datatxt0118' => trim(request('datatxt0118')),
                'datatxt0119' => trim(request('datatxt0119')),
                'numeric1' => request('numeric1'),
                'datatxt0124' => request('datatxt0124'),
                'numericmax' => request('numericmax'),
                'datatxt0123' => request('datatxt0123'),
                'datatxt0120' => request('datatxt0120'),

                'numeric8' => trim(request('numeric8')),
                'numeric9' => trim(request('numeric9')),
                'numeric10' => request('numeric10'),
                'datatxt0121' => 'J4'.request('datatxt0121'),
                'datatxt0122' => "J310",
                'date0002' => trim(request('date0002')),
                'date0003' => trim(request('date0003')),
                'date0004' => trim(request('date0004')),
                'date0005' => trim(request('date0005')),

                'money1' => str_replace(",","",request('money1')),
                'money2' => str_replace(",","",request('money2')),
                'money3' => request('money3'),
                'money4' => str_replace(",","",request('money4')),
                'money5' => str_replace(",","",request('money5')),
                'money6' => str_replace(",","",request('money6')),
                'money7' => str_replace(",","",request('money7')),
                'money8' => str_replace(",","",request('money8')),
                'datatxt0125' => trim(request('datatxt0125')),
                'datatxt0129' => request('datatxt0129'),
                'datatxt0124' => request('db_datatxt0124'),
                'numericmax' => request('numericmax'),
                'datatxt0123' => request('db_datatxt0123'),
                'datatxt0120' => request('datatxt0120'),
                'syukei5' => 0,
                'date0007' => Carbon::now()->format('Y-m-d H:i:s'),
                //'datatxt0099' => !empty($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:null,
                'datatxt0128' => $bango,
            ];
            $tuhanorder = QueryHelper::updateData('tuhanorder',$tuhanorder_update_data,'datatxt0110',$bango,__CLASS__,__FUNCTION__,__LINE__);

            if($tuhanorder && $file != ""){
                //get generated lbook bango
                $lbookInfo = self::getLBookBango();

                if (!file_exists('uploads/flat_rate_entry')) {
                    mkdir('uploads/flat_rate_entry', 0777, true);
                 }
                $file->move(public_path('uploads/flat_rate_entry'), $newFileName);

                //============== L-Book reg start here ==================//
                $soukonyuko_insert_data = [
                    'orderbango' => request('orderhenkan_bango'),
                    'datachar01' => $lbookInfo['lbook_bango'],
                    'datachar02' => request('db_information1'),
                    'datachar03' => request('db_information2'),
                    'datachar04' => request('db_information3'),
                    'datachar05' => trim(request('datatxt0113')),
                    'datachar06' => $bango,
                    'datachar07' => request('datatxt0114'),
                    'datachar08' => '（定期定額）'.mb_substr(request('syouhinname'),0,8),
                    'datachar09' => $newFileName,
                    'datachar10' => 'H920',
                    'dataint25' => 0,
                    'datachar11' => static::getCurrentTime(),
                    'datachar13' => $bango,
                ];
                $soukonyuko = QueryHelper::insertData('soukonyuko', $soukonyuko_insert_data, 'datachar01', true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                if ($soukonyuko && $file != "") {
                    \File::copy(public_path('uploads/flat_rate_entry/') . $newFileName, public_path('uploads/lbook/') . $newFileName);
                }

                //update review data
                $review_update_data = [
                    'kokyakusyouhinbango' => 'D7301',
                    'orderbango' => $lbookInfo['orderbango'],
                    'check_flag' => 0,
                    'color' => static::getCurrentTime(),
                    'nickname' => $bango,
                ];
                QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                //============== L-Book reg end here ==================//

                //update data in tuhanorder table
                $tuhanorder_update_data = [
                    'datatxt0110' => $contract_number,
                    'orderbango' => request('orderhenkan_bango'),
                    'datatxt0115' => $lbookInfo['lbook_bango'],
                ];
                $update_tuhanorder = QueryHelper::updateData('tuhanorder',$tuhanorder_update_data,'datatxt0110',$bango,__CLASS__,__FUNCTION__,__LINE__);
            }

            //insert data in hikiatesyukko table
            $hikiatesyukko_update_data = [
                'hanbaibukacd' => $contract_number,
                'orderbango' => request('orderhenkan_bango'),
                'genka' => 1,
                'datachar26' => request('datachar26'),
                'datachar27' => request('datachar27'),
                'nengetsu' => 0,
                'datachar23' => 1,
                'datachar24' => request('datachar05'),
                'datachar28' => 2,
                'datachar29' => 2,
                'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'),
                'syouhinbukacd' => $bango,
            ];
            $hikiatesyukko = QueryHelper::updateData('hikiatesyukko',$hikiatesyukko_update_data,'hanbaibukacd',$bango,__CLASS__,__FUNCTION__,__LINE__);

            //insert in soukosyukko table
            $deleteSoukosyukko = QueryHelper::fetchResult("delete from soukosyukko where hanbaibukacd='$contract_number'");
            $syouhinbango_arr = $request['syouhinbango'];
            $check_range = "";
            for($i=0;$i<count($syouhinbango_arr);$i++){
                $syouhinbango = $syouhinbango_arr[$i];
                $yoteisu = $request['yoteisu'][$i];
                $datachar29 = $request['datachar29'][$i];
                if(strpos($datachar29, "～") !== false){
                    $check_range = 1;
                    $temp_datachar29 = explode("～", $datachar29);
                    $genka = str_replace("/","", $temp_datachar29[0]);
                    $season = str_replace("/","", $temp_datachar29[1]);
                }
                //else if($check_range = 1){
                //    $genka = "";
                //    $season = str_replace("/","", $datachar29);
                //}
                else{
                    $genka = str_replace("/","", $datachar29);
                    $season = str_replace("/","", $datachar29);
                }
                $syouhinid = $request['syouhinid'][$i];
                $syouhizeiritu = $request['syouhizeiritu'][$i];
                $kanryoubi = $request['kanryoubi'][$i];
                $soukobango = $request['soukobango'][$i];
                $syukkomotobango = $request['syukkomotobango'][$i];
                $syukkameter = $request['syukkameter'][$i];
                $zaikometer = $request['zaikometer'][$i];
                $seikyubango = $request['seikyubango'][$i];
                $denpyobango = $request['denpyobango'][$i];
                $datachar08 = $request['datachar08'][$i];

                $numeric10 = request('numeric10');
                if($numeric10 > 1 && $yoteisu == 0){
                    $kaiinid = 'U122';
                }else if($numeric10 > 1 && $yoteisu > 0){
                    $kaiinid = 'U123';
                }else{
                    $kaiinid = 'U120';
                }

                $soukosyukko_insert_data = [
                    'orderbango' => request('orderhenkan_bango'),
                    'hanbaibukacd' => $contract_number,
                    'kawasename' => request('kawasename'),
                    'syouhinname' => request('syouhinname'),
                    'kaiinid' => $kaiinid,
                    'syukkasu' => request('syukkasu'),
                    'datachar02' => request('datachar02'),
                    'datachar03' => request('datachar03'),
                    'datachar04' => request('datachar04'),
                    'datachar05' => request('db_supplier'),
                    'dataint09' => str_replace("/","", request('dataint09')),
                    'dataint10' => str_replace("/","", request('dataint10')),
                    'datachar06' => request('db_datachar06'),
                    'datachar07' => request('datachar07'),
                    'datachar09' => request('datachar09'),
                    'syouhinbango' => $syouhinbango,
                    'yoteisu' => $yoteisu,
                    'kingaku' => 1,
                    'datachar29' => Converter::to_zenkaku($datachar29),
                    'genka' => $genka,
                    'season' => $season,
                    'syouhinid' => $syouhinid,
                    'syouhizeiritu' => $syouhizeiritu,
                    'kanryoubi' => $kanryoubi,
                    'soukobango' => $soukobango,
                    'syukkomotobango' => $syukkomotobango,
                    'syukkameter' => $syukkameter,
                    'zaikometer' => $zaikometer,
                    'seikyubango' => $seikyubango,
                    'denpyobango' => $denpyobango,
                    'datachar08' => $datachar08,
                    'yoteimeter' => 0,
                    'yoyakubi' => Carbon::now()->format('Y-m-d H:i:s'),
                    'syouhinbukacd' => $bango,
                ];
                $soukosyukko = QueryHelper::insertData('soukosyukko', $soukosyukko_insert_data, 'hanbaibukacd', true, $bango, __CLASS__, __FUNCTION__, __LINE__);
            }


            //insert in juchusyukko table
            $deleteJuchusyukko = QueryHelper::fetchResult("delete from juchusyukko where hanbaibukacd='$contract_number'");
            $syouhinbango_arr = $request['syouhinbango'];
            for($i=0;$i<count($syouhinbango_arr);$i++){
                $syouhinbango = $syouhinbango_arr[$i];
                $yoteisu = $request['yoteisu'][$i];
                $syouhinid = $request['syouhinid'][$i];

                $juchusyukko_insert_data = [
                    'orderbango' => request('orderhenkan_bango'),
                    'hanbaibukacd' => $contract_number,
                    'dataint18' => $syouhinbango,
                    'dataint19' => $yoteisu,
                    'dataint20' => 1,
                    'datachar24' => $request['juchusyukko_datachar24'][$i],
                    'datachar25' => $request['juchusyukko_datachar25'][$i],
                    'datachar26' => $request['juchusyukko_datachar26'][$i],
                    'datachar27' => 2,
                    'dataint25' => 0,
                    'tankano' => Carbon::now()->format('Y-m-d H:i:s'),
                    'syouhinbukacd' => $bango,
                ];
                $juchusyukko = QueryHelper::insertData('juchusyukko', $juchusyukko_insert_data, 'hanbaibukacd', true, $bango, __CLASS__, __FUNCTION__, __LINE__);
            }

            $result['status'] = "ok";
            $result['change_id'] = $contract_number;
            //$result['success_msg'] = 'Contract Number '.$contract_number.' で登録されました。';

            //end log query
            $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 定期定額契約入力 end\n";
            QueryHandler::logger($bango,$log_data);

            pg_query($conn,"COMMIT");
            return $result;
        } catch (\Exception $e) {
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
            QueryHandler::logger($bango, $log_data);

            pg_query($conn,"ROLLBACK");
            $result['status'] = "ng";
            $result['change_id'] = "";
            return $result;
        }

    }
  }

    public static function getFlatRateContractNumber(){
        $fiscal_year = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7501' ")->orderbango ?? null;
        $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7111'");
        if($reviewData){
            $orderbango = $reviewData->orderbango + 1;
            $mobile_flag = $reviewData->mobile_flag ;
        }else{
            $orderbango = "";
            $mobile_flag = "";
        }
        $contract_number = "06".$fiscal_year.str_pad($orderbango,$mobile_flag,'0',STR_PAD_LEFT );
        return ['contract_number'=>$contract_number,'review_orderbango'=>$orderbango];
    }

    public static function getLBookBango(){
        $result = array();
        $reviewData1 = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7301'");
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
        $modified_orderbango = "21" . $orderbango2 . str_pad($orderbango, $mobile_flag, '0', STR_PAD_LEFT);
        $result['lbook_bango'] = $modified_orderbango;
        $result['orderbango'] = $orderbango;
        return $result;
    }

    public static function getCurrentTime()
    {
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        return str_replace(" ", "", $mytime);
    }


}
