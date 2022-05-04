<?php

namespace App\AllClass\other\lBook;
use DB;
Use \Carbon\Carbon;
Use App\AllClass\master\csvRecordEdit;
use App\AllClass\master\CSVLogger;
use App\tantousya;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use Illuminate\Support\Facades\Input;
use File;

Class editLBook{ 
  public static function edit($request,$bango,$headers,$file)
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
    $validator = validateLBookEdit::validate($request,$bango);
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
        $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 書類保管L-BOOK start\n";
        QueryHandler::logger($bango,$log_data);
        
        $conn = pg_connect("host=".env("DB_HOST")." port=".env("DB_PORT")."  dbname=".env("DB_DATABASE")." user=".env("DB_USERNAME")." password=".env("DB_PASSWORD"));
        pg_query($conn,mb_convert_encoding("BEGIN", "CP51932"));
        try{
            $updateBefore = allLBook::data(request('bango'))->whereRaw("datachar01 = '".$request['datachar01']."'")->toSql();
            $updateBefore = (object)collect(QueryHelper::fetchSingleResult($updateBefore))->toArray();

            $datachar01 = trim(request('datachar01'));
            $new_datachar09 = request('datachar09');
            $old_datachar09 = request('old_datachar09');
            $modified_old_datachar09 = request('modified_old_datachar09');
            
            if($new_datachar09 == $modified_old_datachar09){
                $datachar09 = $old_datachar09;
            }else{
                $filenameWithExtension = $file->getClientOriginalName();
                $filename = explode('.', $filenameWithExtension);
                $newFileName = $filename[0].'¶_'.$datachar01.'_'.$mytime.'.'.$filename[1];
                $datachar09 = $newFileName;
            }
                
            $soukonyuko_update_data = [
                'datachar01' => $datachar01,
                'datachar02' => trim(request('datachar02')),
                'datachar03' => trim(request('datachar03')),
                'datachar04' => trim(request('datachar04')),
                'datachar05' => trim(request('datachar05')),
                'datachar06' => request('datachar06'),
                'datachar07' => request('datachar07'),
                'datachar08' => trim(request('datachar08')),
                'datachar09' => $datachar09,
                'datachar10' => trim(request('datachar10')),
                'dataint25' => 0,
                'datachar12' => $mytime,
                //'datatxt0099' => !empty($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:null,
                'datachar13' => $bango,
            ];
            $soukonyukoUpdate = QueryHelper::updateData('soukonyuko',$soukonyuko_update_data,'datachar01',$bango,__CLASS__,__FUNCTION__,__LINE__);

            if($soukonyukoUpdate){
                if($new_datachar09 != $modified_old_datachar09){
                    $file_path = public_path().'\uploads/lbook/'.$old_datachar09;
                    File::delete($file_path);
                    $file->move(public_path('uploads/lbook'), $newFileName);
                }
            }
            
            $result['status'] = "ok";
            $result['change_id'] = $request['datachar01'];
            $result['lbook_id'] = $datachar01;
            $result['success_msg'] = '書類番号 '.$datachar01.' で登録されました。';

            $updateAfter = allLBook::data(request('bango'))->whereRaw("datachar01 = '".$request['datachar01']."'")->toSql();
            $updateAfter = (object)collect(QueryHelper::fetchSingleResult($updateAfter))->toArray();
            $headers['データ有効区分']='dataint25';
            CSVLogger::putData('書類保管L-BOOK.csv', 'gazou2', $updateBefore, $updateAfter, $bangoName, $headers, 2);
            
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
