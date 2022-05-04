<?php

namespace App\AllClass\order\projectRegistration;
use DB;
Use \Carbon\Carbon;
Use App\AllClass\master\csvRecordEdit;
use App\AllClass\master\CSVLogger;
use App\tantousya;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use Illuminate\Support\Facades\Input;
use App\Helpers\Helper;

Class editProjectRegistration{ 
  public static function edit($request,$bango,$headers)
  {

    $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
    $bangoName=tantousya::find($bango)->name;

    foreach ($request as $key => $value) 
    {
        if ($key=='_token'||$key=='type') 
        {
          unset($request[$key]);
        }
        
    }
    $validator=validateProjectEditRegistration::validate($request,$bango);
    $errors = $validator->errors();
        
    if($errors->any() || Input::has('field')){ 
        return $errors;  
    }else if(!$errors->any() && request('submit_confirmation') == ""){
        return "confirmation";
    }else{
        $result = array();

        $mytime=str_replace(":","",$mytime);  
        $mytime=str_replace("-","",$mytime);  
        $mytime=str_replace(" ","",$mytime);
        
        //start log query
        $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### プロジェクト登録 start\n";
        QueryHandler::logger($bango,$log_data);
        
        $conn = pg_connect("host=".env("DB_HOST")." port=".env("DB_PORT")."  dbname=".env("DB_DATABASE")." user=".env("DB_USERNAME")." password=".env("DB_PASSWORD"));
        pg_query($conn,mb_convert_encoding("BEGIN", "CP51932"));
        try{
            $updateBefore = allProject::data(request('bango'))->whereRaw("url = '".$request['url']."'")->toSql();
            $updateBefore = (object)collect(QueryHelper::fetchSingleResult($updateBefore))->toArray();


            $gazou2_update_data = [
                'url' => trim(request('url')),
                'urlsm' => trim(request('urlsm')),
                'catchsm' => trim(request('catchsm')),
                'caption' => trim(request('caption')),
                'setumei' => request('setumei'),
                'catch' => request('catch'),
                'mbcatch' => str_replace('/','',trim(request('mbcatch'))),
                'mbcatchsm' => str_replace('/','',trim(request('mbcatchsm'))),
                'mbcaption' => trim(request('mbcaption')),
                'hyouji' => 0,
                'datatxt0097' => $mytime,
                //'datatxt0099' => Helper::getSystemIP(),
                'datatxt0098' => $bango,
            ];
            $gazou2Update = QueryHelper::updateData('gazou2',$gazou2_update_data,'url',$bango,__CLASS__,__FUNCTION__,__LINE__);

            $result['status'] = "ok";
            $result['change_id'] = $request['url'];

            $updateAfter = allProject::data(request('bango'))->whereRaw("url = '".$request['url']."'")->toSql();
            $updateAfter = (object)collect(QueryHelper::fetchSingleResult($updateAfter))->toArray();
            $headers['データ有効区分']='hyouji';
            CSVLogger::putData('プロジェクト登録.csv', 'gazou2', $updateBefore, $updateAfter, $bangoName, $headers, 2);
            
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
} 
