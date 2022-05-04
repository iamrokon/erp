<?php

namespace App\AllClass\master\seqNumberingMaster;
use DB;
use App\Review;
Use \Carbon\Carbon;
Use App\AllClass\master\seqNumberingMaster\validateSeqNumberingEditMaster;
Use App\AllClass\master\csvRecordEdit;
use App\tantousya;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use Illuminate\Support\Facades\Input;
use App\Helpers\Helper;

Class editSeqNumberingMaster{
  public static function edit($request,$bango,$headers)
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

    $validator=validateSeqNumberingEditMaster::validate($request,$bango);

    $errors = $validator->errors();

        if($errors->any() || Input::has('field')){
            return $errors;
        }else if(!$errors->any() && request('submit_confirmation') == ""){
            return "confirmation";
        } else{
            $result = array();

            $mytime=str_replace(":","",$mytime);
            $mytime=str_replace("-","",$mytime);
            $mytime=str_replace(" ","",$mytime);

            //start log query
            $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### SEQ番号付番マスタ start\n";
            QueryHandler::logger($bango,$log_data);

            $updateBefore = allSeqNumbering::data(request('bango'))->whereRaw("bango=".$request['review_bango'])->toSql();
            $updateBefore = (object)collect(QueryHelper::fetchSingleResult($updateBefore))->toArray();

//            Review::where('bango', request('review_bango'))->update([
            $review = [
               'bango' =>request('review_bango'),
               'kokyakusyouhinbango' =>request('kokyakusyouhinbango'),
               'orderbango' =>request('orderbango'),
               'mobile_flag' =>request('mobile_flag'),
               'check_flag' =>0,
               'color' =>$mytime,
               'nickname' =>$bango,
           //    'size' => Helper::getSystemIP(),
            ];
            QueryHelper::updateData('review',$review,'bango',$bango,__CLASS__,__FUNCTION__,__LINE__);

            $result['status'] = "ok";
            $result['change_id'] = $request['review_bango'];

            $updateAfter = allSeqNumbering::data(request('bango'))->whereRaw("bango=".$request['review_bango'])->toSql();
            $updateAfter = (object)collect(QueryHelper::fetchSingleResult($updateAfter))->toArray();
            $headers['データ有効区分']='check_flag';
            csvRecordEdit::putData('seqNumberingMaster.csv','review',$updateBefore,$updateAfter,$bangoName,$headers);

            //end log query
            $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### SEQ番号付番マスタ end\n";
            QueryHandler::logger($bango,$log_data);

            return $result;
        }
  }
}

