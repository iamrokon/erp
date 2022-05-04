<?php

namespace App\AllClass\other\lBook;
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

Class createLBookRegistration{ 
  public static function create($request,$bango,$headers,$file=null){ 

    $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
    $bangoName=tantousya::find($bango)->name;

    foreach ($request as $key => $value){
        if ($key=='_token'||$key=='type') 
        {
          unset($request[$key]);
        }
    }
    
    $validator = validateLBookRegistration::validate($request,$bango);
    
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
        $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 書類保管L-BOOK start\n";
        QueryHandler::logger($bango,$log_data);
        
        $conn = pg_connect("host=".env("DB_HOST")." port=".env("DB_PORT")."  dbname=".env("DB_DATABASE")." user=".env("DB_USERNAME")." password=".env("DB_PASSWORD"));
        pg_query($conn,mb_convert_encoding("BEGIN", "CP51932"));
        try{
            $hidden_orderbango = trim(request('hidden_orderbango'));
            $datachar01 = trim(request('datachar01'));
            
            $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7301'");
            if($reviewData){
                $mobile_flag = $reviewData->mobile_flag ;
            }else{
                $mobile_flag = "";
            }
            
            $reviewData2 = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7501'");
            if($reviewData2){
                $orderbango = $reviewData2->orderbango ;
            }else{
                $orderbango = "";
            }
            
            $modified_hidden_orderbango = "21".$orderbango.str_pad($hidden_orderbango+1,$mobile_flag,'0',STR_PAD_LEFT );
            
            //check kokyakuorderbango empty or not empty
            $datachar05 = trim(request('datachar05'));
            $orderhen_bango = null;
            if($datachar05 != ""){
                $orderhenkanInfo = QueryHelper::fetchSingleResult("select * from orderhenkan where kokyakuorderbango = '$datachar05' order by ordertypebango2 desc");
                if($orderhenkanInfo){
                    $orderhen_bango = $orderhenkanInfo->bango;
                }
            }else{
                $datachar05 = null;
            }
            
            
            $filenameWithExtension = $file->getClientOriginalName();
            $filename = explode('.', $filenameWithExtension);
            $newFileName = $filename[0].'¶_'.$datachar01.'_'.$mytime.'.'.$filename[1];
           
            //$datachar01 = trim(request('datachar01'))+1;
            $soukonyuko_insert_data = [
                'orderbango' => $orderhen_bango,
                'datachar01' => $datachar01,
                'datachar02' => trim(request('datachar02')),
                'datachar03' => trim(request('datachar03')),
                'datachar04' => trim(request('datachar04')),
                'datachar05' => $datachar05,
                'datachar06' => request('datachar06'),
                'datachar07' => request('datachar07'),
                'datachar08' => trim(request('datachar08')),
                'datachar09' => $newFileName,
                'datachar10' => trim(request('datachar10')),
                'dataint25' => 0,
                'datachar11' => $mytime,
                //'datatxt0099' => !empty($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:null,
                'datachar13' => $bango,
            ];

            $soukonyuko = QueryHelper::insertData('soukonyuko',$soukonyuko_insert_data,'datachar01',true,$bango,__CLASS__,__FUNCTION__,__LINE__);

            if($soukonyuko){
                if($file != ""){
                    $file->move(public_path('uploads/lbook'),$newFileName);
                }
            }
            
            //update orderhenkan data
            $orderhenkan_update_data = [
                'kokyakuorderbango' => $datachar05,
                'datachar08' => $datachar01,
            ];
            $orderhenkanUpdate = QueryHelper::updateData('orderhenkan',$orderhenkan_update_data,'kokyakuorderbango',$bango,__CLASS__,__FUNCTION__,__LINE__);
            
            //update review data
            $review_update_data = [
                'kokyakusyouhinbango' => 'D7301',
                'orderbango' => $hidden_orderbango,
                'check_flag' => 0,
                'color' => $mytime,
                'size' => Helper::getSystemIP(),
                'nickname' => $bango,
            ];
            $reviewUpdate = QueryHelper::updateData('review',$review_update_data,'kokyakusyouhinbango',$bango,__CLASS__,__FUNCTION__,__LINE__);
            
            $result['status'] = "ok";
            $result['new_lbook_bango'] = $modified_hidden_orderbango;
            $result['change_id'] = $hidden_orderbango+1;
            $result['lbook_id'] = $datachar01;
            $result['success_msg'] = '書類番号 '.$datachar01.' で登録されました。';

            //insert data record
            $data=allLBook::data(request('bango'))->whereRaw("datachar01 = '".$datachar01."'")->toSql();
            $data = (object)collect(QueryHelper::fetchSingleResult($data))->toArray();
            $headers['データ有効区分']='dataint25';
            CSVLogger::putData('書類保管L-BOOK.csv', 'soukonyuko', $data, $data, $bangoName, $headers, 1);

            //end log query
            $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 書類保管L-BOOK end\n";
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
