<?php

namespace App\AllClass\master\seqNumberingMaster;
use DB;
use App\Review;
Use \Carbon\Carbon;
Use App\AllClass\master\seqNumberingMaster\validateSeqNumberingMaster;
Use App\AllClass\master\csvRecordInsert;
use App\tantousya;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use Illuminate\Support\Facades\Input;
use App\Helpers\Helper;

Class createSeqNumberingMaster{
  public static function create($request,$bango,$headers)
  {

    $mytime = Carbon::now()->toDateTimeString();
    $bangoName=tantousya::find($bango)->name;

    foreach ($request as $key => $value)
    {
        if ($key=='_token'||$key=='type')
        {
          unset($request[$key]);
        }
    }

    $validator=validateSeqNumberingMaster::validate($request,$bango);

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
            $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### SEQ番号付番マスタ start\n";
            QueryHandler::logger($bango,$log_data);
            
            $temp_review = QueryHelper::fetchSingleResult("select MAX(bango) as bango from review");
            $max_bango = $temp_review->bango+1;

            $reviewData = [
              'bango'=>$max_bango,
              'kokyakusyouhinbango'=>request('kokyakusyouhinbango'),
              'orderbango'=>request('orderbango'),
              'mobile_flag'=>request('mobile_flag'),
              'check_flag'=>0,
              'jouhou'=>$mytime,
              'nickname'=>$bango,
             // 'size'=> Helper::getSystemIP(),
            ];
            $review = QueryHelper::insertData('review',$reviewData,'bango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);

            if($review){
                $reviewInfo = DB::table('review')->orderBy('bango', 'DESC')->first();
                if($reviewInfo){
                    $reviewbango = $reviewInfo->bango;
                }else{
                    $reviewbango = "";
                }
            }

            $result['status'] = "ok";
            $result['change_id'] = $reviewbango;

            //insert data record
            $data=allSeqNumbering::data(request('bango'))->whereRaw("bango ='".$reviewInfo->bango."'")->toSql();
            $data = (object)collect(QueryHelper::fetchSingleResult($data))->toArray();
            $headers['データ有効区分']='check_flag';
            csvRecordInsert::putData('seqNumberingMaster.csv','review',$data,$bangoName,$headers);

            //end log query
            $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### SEQ番号付番マスタ end\n";
            QueryHandler::logger($bango,$log_data);

            return $result;
        }
  }
}
