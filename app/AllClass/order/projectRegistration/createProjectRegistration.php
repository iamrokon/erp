<?php

namespace App\AllClass\order\projectRegistration;
use DB;
Use \Carbon\Carbon;
Use App\AllClass\master\csvRecordInsert;
use App\tantousya;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use App\AllClass\master\CSVLogger;
use Illuminate\Support\Facades\Input;
use App\Helpers\Helper;

Class createProjectRegistration{ 
  public static function create($request,$bango,$headers)
  { 

    $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
    $bangoName=tantousya::find($bango)->name;

    foreach ($request as $key => $value){
        if ($key=='_token'||$key=='type') 
        {
          unset($request[$key]);
        }
    }
    
    $validator = validateProjectRegistration::validate($request,$bango);
    
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
        $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### プロジェクト登録 start\n";
        QueryHandler::logger($bango,$log_data);
        
        $conn = pg_connect("host=".env("DB_HOST")." port=".env("DB_PORT")."  dbname=".env("DB_DATABASE")." user=".env("DB_USERNAME")." password=".env("DB_PASSWORD"));
        pg_query($conn,mb_convert_encoding("BEGIN", "CP51932"));
        try{
            //$url = trim(request('url'));
            $projectInfo = self::getProjectBango();
            $url = $projectInfo['projectbango'];
            $review_orderbango = $projectInfo['review_orderbango'];
            $gazou2_insert_data = [
                'url' => $url,
                'urlsm' => trim(request('urlsm')),
                'catchsm' => trim(request('catchsm')),
                'caption' => trim(request('caption')),
                'setumei' => request('setumei'),
                'catch' => request('catch'),
                'mbcatch' => str_replace('/','',trim(request('mbcatch'))),
                'mbcatchsm' => str_replace('/','',trim(request('mbcatchsm'))),
                'mbcaption' => trim(request('mbcaption')),
                'hyouji' => 0,
                'datatxt0096' => $mytime,
                //'datatxt0099' => Helper::getSystemIP(),
                'datatxt0098' => $bango,
            ];
            $gazou2 = QueryHelper::insertData('gazou2',$gazou2_insert_data,'url',true,$bango,__CLASS__,__FUNCTION__,__LINE__);

            //update review data
            $review_update_data = [
                'kokyakusyouhinbango' => 'D7251',
                'orderbango' => $review_orderbango,
                'check_flag' => 0,
                'color' => $mytime,
                'nickname' => $bango,
            ];
            QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);

            
            $result['status'] = "ok";
            $result['change_id'] = $url;

            //insert data record
            $data=allProject::data(request('bango'))->whereRaw("url = '".$url."'")->toSql();
            $data = (object)collect(QueryHelper::fetchSingleResult($data))->toArray();
            $headers['データ有効区分']='hyouji';
            CSVLogger::putData('プロジェクト登録.csv', 'gazou2', $data, $data, $bangoName, $headers, 1);
            
            //end log query
            $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### プロジェクト登録 end\n";
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
  
    public static function getProjectBango(){
        $fiscal_year = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7501' ")->orderbango ?? null;
        $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7251'");
        if($reviewData){
            $orderbango = $reviewData->orderbango + 1;
            $mobile_flag = $reviewData->mobile_flag ;
        }else{
            $orderbango = "";
            $mobile_flag = "";
        }
        $projectbango = "10".$fiscal_year.str_pad($orderbango,$mobile_flag,'0',STR_PAD_LEFT );
        return ['projectbango'=>$projectbango,'review_orderbango'=>$orderbango];
    }
  
} 
