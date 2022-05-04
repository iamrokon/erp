<?php

namespace App\AllClass\master\officeMaster;
use DB;
use App\haisou;
use App\kokyaku1;
use App\tantousya;
Use \Carbon\Carbon;
Use App\AllClass\master\officeMaster\validateEditOfficeMaster;
use App\AllClass\master\csvRecordEdit;
use App\AllClass\master\CSVLogger;
use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use Illuminate\Support\Facades\Input;
use App\Helpers\Helper;

Class editOfficeMaster{
  public static function edit($request,$bango,$headers)
  {
    $bangoName=tantousya::find($bango)->name;
    $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();

    foreach ($request as $key => $value){
        if ($key=='_token'||$key=='type'){
          unset($request[$key]);
        }
    }

    $validator=validateEditOfficeMaster::validate($request,$bango);

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
        $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 事業所マスタ start\n";
        QueryHandler::logger($bango,$log_data);

        $conn = pg_connect("host=".env("DB_HOST")." port=".env("DB_PORT")."  dbname=".env("DB_DATABASE")." user=".env("DB_USERNAME")." password=".env("DB_PASSWORD"));
        pg_query($conn,mb_convert_encoding("BEGIN", "CP51932"));
        try{
            $maxId= haisou::whereNotNull('torihikisakibango')->max('torihikisakibango');
            //$kokyaku=kokyaku1::where('yobi12',request('shikibetsucode'))->first();
            $shikibetsucode = request('shikibetsucode');
            $kokyaku = QueryHelper::select(['*'])->from('kokyaku1')->where("yobi12 = '$shikibetsucode'")->get()->first();

            $hbango = request('bango');
            $oldData = QueryHelper::select(['*'])->from('haisou')->where("bango = '$hbango'")->get()->execute();

            //if($oldData[0]->shikibetsucode != request('shikibetsucode') ){
            //    $hshikibetsucode = request('shikibetsucode');
                //$maxId = QueryHelper::select(['*'])->from('haisou')->where("shikibetsucode = '$hshikibetsucode'")->get()->execute();
                //$max = count($maxId)+1;
            //    $torihikisakibango = QueryHelper::fetchSingleResult("SELECT min(unused) AS unused
            //    FROM (
            //        SELECT MIN(t1.torihikisakibango::int)+1 as unused
            //        FROM haisou  AS t1
            //        WHERE NOT EXISTS (SELECT * FROM haisou AS t2 WHERE t2.torihikisakibango::int = t1.torihikisakibango::int+1 and t2.shikibetsucode::int=".$hshikibetsucode." )

            //    ) as subquery")->unused ?? 1;
            //    $torihikisakibango = sprintf('%02d', $torihikisakibango);
            //}else{
            //    $torihikisakibango = request('torihikisakibango');
            //}

            $torihikisakibango = request('torihikisakibango');
            
            $query = allHaisou::data($bango, 0, request('bango'));
            $updateBefore = QueryHelper::fetchSingleResult($query);

            $haisou_update_data = [
                'bango' => trim(request('bango')),
                'kokyakubango' => $kokyaku->bango,
                'shikibetsucode' =>trim(request('shikibetsucode')),
                'torihikisakibango'=>$torihikisakibango,
                'name' =>trim(request('name')),
                'haisoumoji1' =>request('haisoumoji1'),
                'syukeitukikijun' =>trim(request('syukeitukikijun')),
                'syukeituki' =>trim(request('syukeituki')),
                'syukeikikijun' =>trim(request('syukeikikijun')),
                'syukeinenkijun' =>trim(request('syukeinenkijun')),
                'torihikisakirank1' =>request('torihikisakirank1'),
                'yubinbango' =>trim(request('zip1').request('zip2')),
                'address' =>trim(request('address1').' '.request('address2').' '.request('address3').' '.request('address4')),
                'mail' =>trim(request('mail')),
                'tel' =>trim(request('tel')),
                'torihikisakirank2' =>trim(request('torihikisakirank2')),
                'yobi1' =>trim(request('yobi1')),
                'haisoumoji2' => self::getJouhouData(trim(request('haisoumoji2')),'0801売上区分'),
                'syukeiki' => self::getJouhouData(trim(request('syukeiki')),'0801仕入区分'),
                'netuserpasswd'=>$mytime,
                'kounyusu'=>0,
               // 'netlogin'=> Helper::getSystemIP(),
                'syukeinen'=>$bango
            ];

            $dataUpdate = QueryHelper::updateData('haisou',$haisou_update_data,'bango',$bango,__CLASS__,__FUNCTION__,__LINE__);

            if($dataUpdate){
                $others_update_data = [
                    'otherint1' => trim(request('bango')),
                    'other1' => self::getJouhouData(trim(request('other1')),'0802事業所口座使用区分'),
                    'other36' => trim(request('other36')),
                    'other2' => self::getJouhouData(trim(request('other2')),'0801即時区分'),
                    'other3' => request('other3'),
                    'other4' => request('other4'),
                    'other5' => self::getJouhouData(trim(request('other5')),'0802入金月'),
                    'other6' => request('other6'),
                    'other7' => self::getJouhouData(trim(request('other7')),'0801入金日休日設定'),
                    'other8' => self::getJouhouData(trim(request('other8')),'0801入金振込手数料設定'),
                    'otherfloat1' => str_replace(",","",trim(request('otherfloat1'))),
                    'other9' => trim(request('other9')),
                    'other10' => trim(request('other10')),
                    'other11' => self::getJouhouData(trim(request('other11')),'0801請求書メール区分'),
                    'other12' => trim(request('other12')),
                    'other13' => self::getJouhouData(trim(request('other13')),'0801請求書UIS'),
                    'other14' => self::getJouhouData(trim(request('other14')),'0801請求書郵送'),
                    'other15' => trim(request('other15')),
                    'other16' => request('other16'),
                    'other18' => request('other18'),
                    'other17' => self::getJouhouData(trim(request('other17')),'0801請求消費税計算区分'),
                    'other39' => self::getJouhouData(trim(request('other39')),'0801専伝区分'),
                    'other40' => trim(request('other40')),
                    'other19' => request('other19'),
                    'other20' => self::getJouhouData(trim(request('other20')),'0802入金月'),
                    'other21' => request('other21'),
                    'other22' => self::getJouhouData(trim(request('other22')),'0801支払日休日設定'),
                    'other23' => self::getJouhouData(trim(request('other23')),'0801支払振込手数料設定'),
                    'other24' => request('other24'),
                    'otherfloat2' => trim(request('otherfloat2')),
                    'other30' => request('other30'),
                    'other25' => trim(request('other25')),
                    'other26' => trim(request('other26')),
                    'otherfloat4' => request('otherfloat4'),
                    'other27' => trim(request('other27')),
                    'other28' => trim(request('other28')),
                    'other31' => trim(request('other31')),
                    'other32' => trim(request('other32')),
                    'other33' => request('other33'),
                    'other34' => self::getJouhouData(trim(request('other34')),'0801支払消費税計算区分'),
                    'other35' => request('other35'),
                    'otherfloat3' => trim(request('otherfloat3')),
                    'other37' => self::getJouhouData(trim(request('other37')),'0801手形決済月'),
                    'other38' => trim(request('other38')),
                ];

                $dataUpdate = QueryHelper::updateData('others2',$others_update_data,'otherint1',$bango,__CLASS__,__FUNCTION__,__LINE__);
            }

            $result['status'] = 'ok';
            $result['torihikisakibango'] = $torihikisakibango;
            $result['change_id'] = request('bango');

            $query = allHaisou::data($bango, 0, request('bango'));
            $updateAfter = QueryHelper::fetchSingleResult($query);
            $headers['データ有効区分']='kounyusu';
            CSVLogger::putData('事業所マスタ.csv', 'haisou', $updateBefore, $updateAfter, $bangoName, $headers, 2);

            //end log query
            $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 事業所マスタ end\n";
            QueryHandler::logger($bango,$log_data);

            pg_query($conn,mb_convert_encoding("COMMIT", "CP51932"));
            return $result;
        } catch (\Exception $e) {
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
            QueryHandler::logger($bango, $log_data);

            pg_query($conn,mb_convert_encoding("ROLLBACK", "CP51932"));
            $result['status'] = 'ng';
            $result['torihikisakibango'] = "";
            $result['change_id'] = "";
            return $result;
        }
    }
}

    //get jouhou data from request table
    public static function getJouhouData($request_data,$color){
        if($request_data!=""){
            $requestInfo =  QueryHelper::fetchSingleResult("select * from request where color = '$color' and syouhinbango = $request_data");
            if($requestInfo){
                return $request_data.' '.$requestInfo->jouhou;
            }else{
                return NULL;
            }
        }else{
            return NULL;
        }
    }


}


