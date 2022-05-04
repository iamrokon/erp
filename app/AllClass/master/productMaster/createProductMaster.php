<?php

namespace App\AllClass\master\productMaster;
use DB;
use App\syouhin1;
use App\syouhin2;
use App\syouhin3;
use App\Kakaku;
use App\kokyaku1;
Use \Carbon\Carbon;
Use App\AllClass\master\csvRecordInsert;
use App\tantousya;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use App\AllClass\master\CSVLogger;
use Illuminate\Support\Facades\Input;
use App\Helpers\Helper;

Class createProductMaster{
  public static function create($request,$bango,$headers)
  {

    $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
    $bangoName=tantousya::find($bango)->name;

    foreach ($request as $key => $value){
        if ($key=='_token'||$key=='type'){
          unset($request[$key]);
        }
    }
    $validator = validateProductMaster::validate($request,$bango);

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
        $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 商品マスタ start\n";
        QueryHandler::logger($bango,$log_data);

        $conn = pg_connect("host=".env("DB_HOST")." port=".env("DB_PORT")."  dbname=".env("DB_DATABASE")." user=".env("DB_USERNAME")." password=".env("DB_PASSWORD"));
        pg_query($conn,mb_convert_encoding("BEGIN", "CP51932"));
        try{
            //get kokyakubango
            $season = request('season');
            $sub_season = substr($season,0,6);
            $kokyakuInfo =  QueryHelper::select(['*'])->from('kokyaku1')->where("yobi12 = '$sub_season' ")->get()->first();
            if($kokyakuInfo){
                $kokyakubango = $kokyakuInfo->bango;
            }else{
                $kokyakubango =null;
            }
            
            //find missing number in sorted order or find max_kokyakusyouhinbango starts here
            $syouhin1Data = DB::select( DB::raw("SELECT max(CAST(kokyakusyouhinbango as integer)) as max_kokyakusyouhinbango FROM syouhin1") );

            if($syouhin1Data){
                $syouhin1TempData = DB::select( DB::raw("SELECT CAST(kokyakusyouhinbango as integer) as kokyakusyouhinbango FROM syouhin1 order by kokyakusyouhinbango asc") );
          
                $temp_kokyakusyouhinbango = "";
                for($i=0;$i<count($syouhin1TempData)-1;$i++){
                    $temp_kokyakusyouhinbango = $syouhin1TempData[$i]->kokyakusyouhinbango + 1;
              
                        $temp_kokyakusyouhinbango_2 = $syouhin1TempData[$i+1]->kokyakusyouhinbango;
                        //if($temp_kokyakusyouhinbango != $temp_kokyakusyouhinbango_2){
                        if($temp_kokyakusyouhinbango < $temp_kokyakusyouhinbango_2){
                           break;
                        } 
                    
                }
               
                if($temp_kokyakusyouhinbango != ""){
                    $kokyakusyouhinbango = $temp_kokyakusyouhinbango;
                }else{
                    $kokyakusyouhinbango = $syouhin1Data[0]->max_kokyakusyouhinbango + 1;
                }
                $kokyakusyouhinbango = str_pad($kokyakusyouhinbango, 5, '0', STR_PAD_LEFT);
            }else{
                $kokyakusyouhinbango = '00001';
            }
            //find missing number in sorted order or find max_kokyakusyouhinbango ends here

            $syouhin1_insert_data = [
                'kokyakusyouhinbango' => $kokyakusyouhinbango,
                'name' => trim(request('name')),
                'jouhou' => request('jouhou'),
                'koyuujouhou' => request('koyuujouhou'),
                'color' => request('color'),
                'bumon' => request('bumon'),
                'url_mobile' => request('url_mobile'),
                //'data20' => request('yoyaku'),
                'data20' => trim(request('jouhou2')),
                'data21' => request('data21'),
                'tokuchou' => request('tokuchou'),
                'data22' => request('data22'),
                'data23' => request('data23'),
                'data24' => request('data24'),
                'season' => request('season'),
                'size' => request('size'),
                'kakaku' => request('kakaku'),
                'data25' => request('data25'),
                'data52' => request('data52'),
                'data53' => request('data53'),
                'data54' => request('data54'),
                'data100' => request('data100'),
                'data50' => request('data50'),
                'data51' => request('data51'),
                'meker' => request('meker'),
                'data101' => request('data101'),
                'synchrosyouhinbango' => request('synchrosyouhinbango'),
                'endtime' => request('endtime'),
                'data26' => request('data26'),
                'data27' => request('data27'),
                'data28' => request('data28'),
                'data29' => request('data29'),
                'url' => request('url'),
                'kongouritsu' => trim(request('kongouritsu')),
                'mdjouhou' => trim(request('mdjouhou')),
                'data104' => request('data104'),
                'isuriage' => 0,
                'code1' => $mytime,
                'kokyakubango' => $kokyakubango,
              //  'code3' => Helper::getSystemIP(),
            ];

            $product = QueryHelper::insertData('syouhin1',$syouhin1_insert_data,'bango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);

            if($product){
                $syouhinbango = $product->bango;
                $kakaku_insert_data = [
                    'syouhinbango' => $syouhinbango,
                    'kakaku' => request('kakaku'),
                    'hanbaisu' => request('hanbaisu'),
                    'jyougensu' => request('jyougensu'),
                    'yoyaku' => request('kakaku_yoyaku'),
                    'yoyakusu' => request('yoyakusu'),
                    'yoyakukanousu' => request('yoyakukanousu'),
                    'sortbango' => request('sortbango'),
                    'dataint01' => request('dataint01'),
                ];
                $kakaku = QueryHelper::insertData('kakaku',$kakaku_insert_data,'syouhinbango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);


                $syouhin2_insert_data = [
                    'bango' => $syouhinbango,
                    'catalogbango' => $bango,
                    //'jouhou2' => trim(request('jouhou2')),
                    'jouhou2' => request('yoyaku'),
                    'konpoumei' => trim(request('konpoumei')),
                ];
                $syouhin2 = QueryHelper::insertData('syouhin2',$syouhin2_insert_data,'bango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);


                $syouhin3_insert_data = [
                    'bango' => $syouhinbango,
                ];
                $syouhin3 = QueryHelper::insertData('syouhin3',$syouhin3_insert_data,'bango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);

                $syouhin4_insert_data = [
                    'bango' => $syouhinbango,
                    'chardata4' => trim(request('chardata4')),
                    'dspbango' => request('dspbango'),
                    'color' => request('syouhin4_color'),
                    'size' => request('syouhin4_size'),
                    'syouhingroup' => request('syouhingroup'),
                    'ruijihinbango' => request('ruijihinbango'),
                    'chardata1' => request('chardata1'),
                    'chardata2' => request('chardata2'),
                ];
                $syouhin4 = QueryHelper::insertData('syouhin4',$syouhin4_insert_data,'bango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
            }

            $result['status'] = "ok";
            $result['change_id'] = $syouhinbango;

            //insert data record
            $data=allProduct::data(request('bango'))->whereRaw("bango = '".$syouhinbango."'")->toSql();
            $data = (object)collect(QueryHelper::fetchSingleResult($data))->toArray();
            $headers['データ有効区分']='isuriage';
            CSVLogger::putData('productMaster.csv', 'syouhin1', $data, $data, $bangoName, $headers, 1);

            //end log query
            $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 商品マスタ end\n";
            QueryHandler::logger($bango,$log_data);

            pg_query($conn,mb_convert_encoding("COMMIT", "CP51932"));
            return $result;
        } catch (\Exception $e) {
           dd( $e);
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
            QueryHandler::logger($bango, $log_data);

            pg_query($conn,mb_convert_encoding("ROLLBACK", "CP51932"));
            $result['status'] = "ng";
            $result['change_id'] = "";
            return $result;
        }
    }
  }
}
