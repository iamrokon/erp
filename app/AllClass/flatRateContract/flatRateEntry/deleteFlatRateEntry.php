<?php

namespace App\AllClass\flatRateContract\flatRateEntry;
use DB;
Use \Carbon\Carbon;
Use App\AllClass\master\csvRecordInsert;
use App\tantousya;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use App\AllClass\master\CSVLogger;
use Illuminate\Support\Facades\Input;
use File;
use App\Helpers\Helper;

Class deleteFlatRateEntry{
  public static function delete($request,$bango,$file=null){

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

            $contract_number = request('datatxt0110');

            //update data in tuhanorder table
            $tuhanorder_update_data = [
                'datatxt0110' => $contract_number,
                'orderbango' => request('orderhenkan_bango'),
                'datatxt0111' => request('datatxt0111'),
                'datatxt0122' => "J320",
                'date0002' => trim(request('date0002')),
                'date0003' => trim(request('date0003')),
                'syukei5' => 0,
                'date0007' => Carbon::now()->format('Y-m-d H:i:s'),
                'datatxt0128' => $bango,
            ];
            $tuhanorder = QueryHelper::updateData('tuhanorder',$tuhanorder_update_data,'datatxt0110',$bango,__CLASS__,__FUNCTION__,__LINE__);


            //update data in hikiatesyukko table
            $hikiatesyukko_update_data = [
                'hanbaibukacd' => $contract_number,
                'orderbango' => request('orderhenkan_bango'),
                'nengetsu' => 1,
                'datachar23' => 1,
                'datachar28' => 2,
                'datachar29' => 2,
                'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'),
                'syouhinbukacd' => $bango,
            ];
            $hikiatesyukko = QueryHelper::updateData('hikiatesyukko',$hikiatesyukko_update_data,'hanbaibukacd',$bango,__CLASS__,__FUNCTION__,__LINE__);

            //update data in soukosyukko table
            $soukosyukko_update_data = [
                'hanbaibukacd' => $contract_number,
                'orderbango' => request('orderhenkan_bango'),
                //'syukkosoukobango' => 0,
                'yoyakubi' => Carbon::now()->format('Y-m-d H:i:s'),
                'syouhinbukacd' => $bango,
            ];
            $soukosyukko = QueryHelper::updateData('soukosyukko',$soukosyukko_update_data,'hanbaibukacd',$bango,__CLASS__,__FUNCTION__,__LINE__);

            //update data in juchusyukko table
            $juchusyukko_update_data = [
                'hanbaibukacd' => $contract_number,
                'orderbango' => request('orderhenkan_bango'),
                'dataint20' => 1,
                'dataint25' => 1,
                'tankano' => Carbon::now()->format('Y-m-d H:i:s'),
                'syouhinbukacd' => $bango,
            ];
            $juchusyukko = QueryHelper::updateData('juchusyukko',$juchusyukko_update_data,'hanbaibukacd',$bango,__CLASS__,__FUNCTION__,__LINE__);

            $result['status'] = "ok";
            $result['change_id'] = $contract_number;

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

    public static function getCurrentTime()
    {
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        return str_replace(" ", "", $mytime);
    }


}
