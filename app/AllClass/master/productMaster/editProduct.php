<?php

namespace App\AllClass\master\productMaster;
use DB;
use App\syouhin1;
use App\syouhin2;
use App\Kakaku;
use App\kokyaku1;
Use \Carbon\Carbon;
Use App\AllClass\master\csvRecordEdit;
use App\AllClass\master\CSVLogger;
use App\tantousya;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use Illuminate\Support\Facades\Input;
use App\Helpers\Helper;

Class editProduct{
  public static function edit($request,$bango,$headers)
  { 

    $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
    $bangoName=tantousya::find($bango)->name;

    foreach ($request as $key => $value){
        if ($key=='_token'||$key=='type'){
          unset($request[$key]);
        }
    }
    $validator=validateProductEdit::validate($request,$bango);
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
        $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 商品マスタ start\n";
        QueryHandler::logger($bango,$log_data);

        $conn = pg_connect("host=".env("DB_HOST")." port=".env("DB_PORT")."  dbname=".env("DB_DATABASE")." user=".env("DB_USERNAME")." password=".env("DB_PASSWORD"));
        pg_query($conn,mb_convert_encoding("BEGIN", "CP51932"));
        try{
            $updateBefore = allProduct::data(request('bango'))->whereRaw("bango = '".$request['bango']."'")->toSql();
            $updateBefore = (object)collect(QueryHelper::fetchSingleResult($updateBefore))->toArray();

            //get kokyakubango
            $season = request('season');
            $sub_season = substr($season,0,6);
            //$kokyakuInfo= kokyaku1::where('yobi12','=',$sub_season)->first();
            $kokyakuInfo =  QueryHelper::select(['*'])->from('kokyaku1')->where("yobi12 = '$sub_season' ")->get()->first();
            if($kokyakuInfo){
                $kokyakubango = $kokyakuInfo->bango;
            }else{
                $kokyakubango =null;
            }

            $syouhin1_update_data = [
                'bango' => trim(request('bango')),
                'kokyakusyouhinbango' => trim(request('kokyakusyouhinbango')),
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
                'code2' => $mytime,
                'kokyakubango' => $kokyakubango,
              //  'code3' => Helper::getSystemIP(),
            ];
            $syouhin1Update = QueryHelper::updateData('syouhin1',$syouhin1_update_data,'bango',$bango,__CLASS__,__FUNCTION__,__LINE__);

            if($syouhin1Update){
                $kakaku_update_data = [
                   'syouhinbango' => request('bango'),
                   'kakaku' => request('kakaku'),
                   'hanbaisu' => request('hanbaisu'),
                   'jyougensu' =>request('jyougensu'),
                   'yoyaku' => request('kakaku_yoyaku'),
                   'yoyakusu' => request('yoyakusu'),
                   'yoyakukanousu' => request('yoyakukanousu'),
                   'sortbango' => request('sortbango'),
                   'dataint01' => request('dataint01'),
                ];
                $kakakuUpdate = QueryHelper::updateData('kakaku',$kakaku_update_data,['syouhinbango' => request('bango'),'syutenjyouken' => null],$bango,__CLASS__,__FUNCTION__,__LINE__);

                $syouhin2_update_data = [
                    'bango' => request('bango'),
                    //'jouhou2' => request('jouhou2'),
                    'jouhou2' => request('yoyaku'),
                    'konpoumei' => trim(request('konpoumei')),
                    'catalogbango' => $bango,
                ];
                $syouhin2Update = QueryHelper::updateData('syouhin2',$syouhin2_update_data,'bango',$bango,__CLASS__,__FUNCTION__,__LINE__);

                $syouhin4_update_data = [
                    'bango' => request('bango'),
                    'chardata4' => trim(request('chardata4')),
                    'dspbango' => request('dspbango'),
                    'color' => request('syouhin4_color'),
                    'size' => request('syouhin4_size'),
                    'syouhingroup' => request('syouhingroup'),
                    'ruijihinbango' => request('ruijihinbango'),
                    'chardata1' => request('chardata1'),
                    'chardata2' => request('chardata2'),
                ];
                $syouhin4Update = QueryHelper::updateData('syouhin4',$syouhin4_update_data,'bango',$bango,__CLASS__,__FUNCTION__,__LINE__);
            }

            $result['status'] = "ok";
            $result['change_id'] = $request['bango'];

            $updateAfter = allProduct::data(request('bango'))->whereRaw("bango = '".$request['bango']."'")->toSql();
            $updateAfter = (object)collect(QueryHelper::fetchSingleResult($updateAfter))->toArray();
            $headers['データ有効区分']='isuriage';
            CSVLogger::putData('productMaster.csv', 'syouhin1', $updateBefore, $updateAfter, $bangoName, $headers, 2);

            //end log query
            $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 商品マスタ end\n";
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
