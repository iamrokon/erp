<?php

namespace App\AllClass\master\officeMaster;
use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use App\AllClass\master\CSVLogger;
use DB;
use App\haisou;
use App\kokyaku1;
use App\tantousya;
use App\AllClass\master\csvRecordInsert;
Use \Carbon\Carbon;
Use App\AllClass\master\officeMaster\validateOfficeMaster;
use Illuminate\Support\Facades\Input;
use App\Helpers\Helper;

Class createOfficeMaster{
  public static function create($request,$bango, $headers)
  {
    $bangoName=tantousya::find($bango)->name;
    $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();

    foreach ($request as $key => $value){
        if ($key=='_token'||$key=='type'){
          unset($request[$key]);
        }
    }

    $validator=validateOfficeMaster::validate($request,$bango);

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
            $hshikibetsucode = request('shikibetsucode');
            //$maxId = QueryHelper::select(['*'])->from('haisou')->where("shikibetsucode = '$hshikibetsucode'")->get()->execute();
            //$max = count($maxId)+1;
            //if($max<10){
            //    $max = '0'.$max;
            //}
            
            $shikibetsucode = request('shikibetsucode');
            $kokyaku = QueryHelper::select(['*'])->from('kokyaku1')->where("yobi12 = '$shikibetsucode'")->get()->first();
            
            //find missing number in sorted order or find max_yobi12 starts here
            $temp_haisou = QueryHelper::fetchSingleResult("
                select torihikisakibango
                    from (
                        select generate_series (1, (select max(torihikisakibango::int) from haisou  where shikibetsucode ='$shikibetsucode')) as torihikisakibango
                        except
                        select torihikisakibango::int
                        from haisou
                         where shikibetsucode ='$shikibetsucode'
                    ) temp_haisou
                   
                    order by torihikisakibango limit 1
                ");
            if(count((array) $temp_haisou)>0){
                $torihikisakibango = sprintf('%02d', $temp_haisou->torihikisakibango);
            }else{
                $haisouData = DB::select( DB::raw("SELECT max(CAST(torihikisakibango as integer)) as max_torihikisakibango FROM haisou where shikibetsucode ='$shikibetsucode'") );
                if($haisouData){
                    $torihikisakibango = $haisouData[0]->max_torihikisakibango + 1;
                    $torihikisakibango = sprintf('%02d', $torihikisakibango);
                }else{
                   $torihikisakibango = '01'; 
                }
            }
            //find missing number in sorted order or find max_yobi12 ends here


            $insert_data = [
                'kokyakubango' => $kokyaku->bango,
                'shikibetsucode' => trim(request('shikibetsucode')),
                'torihikisakibango' => $torihikisakibango,
                'name' => trim(request('name')),
                'haisoumoji1' => request('haisoumoji1'),
                'torihikisakirank1' => request('torihikisakirank1'),
                'syukeitukikijun' => trim(request('syukeitukikijun')),
                'syukeituki' => trim(request('syukeituki')),
                'syukeikikijun' => trim(request('syukeikikijun')),
                'syukeinenkijun' => trim(request('syukeinenkijun')),
                'yubinbango' => trim(request('zip1').request('zip2')),
                'address' => trim(request('address1').' '.request('address2').' '.request('address3').' '.request('address4')),
                'tel' => trim(request('tel')),
                'torihikisakirank2' => trim(request('torihikisakirank2')),
                'yobi1' => trim(request('yobi1')),
                'mail' => trim(request('mail')),
                'haisoumoji2' => self::getJouhouData(trim(request('haisoumoji2')),'0801売上区分'),
                'syukeiki' => self::getJouhouData(trim(request('syukeiki')),'0801仕入区分'),
                'netusername' => $mytime,
                'kounyusu' => 0,
               // 'netlogin' => Helper::getSystemIP(),
                'syukeinen' => $bango
            ];


            $haisou = QueryHelper::insertData('haisou',$insert_data,'bango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
            if($haisou){
                $haisouBango = $haisou->bango;
                $torihikisakibango = $haisou->torihikisakibango;

                //second tab start here
                if((trim(request('haisoumoji2'))==2 && trim(request('syukeiki'))==2) || (trim(request('haisoumoji2'))==2 && trim(request('syukeiki'))==1)){
                    $other_insert_data1 = [
                     'otherint1' => $haisouBango,
                     'other1' => self::getJouhouData(trim(request('other1')),'0802事業所口座使用区分'),
                     'other36' => trim(request('other36')),
                     'other2' => NULL,
                     'other3' => NULL,
                     'other4' => NULL,
                     'other5' => NULL,
                     'other6' => NULL,
                     'other7' => NULL,
                     'other8' => NULL,
                     'otherfloat1' => NULL,
                     'other9' => NULL,
                     'other10' => NULL,
                     'other11' => NULL,
                     'other12' => NULL,
                     'other13' => NULL,
                     'other14' => NULL,
                     'other15' => NULL,
                     'other16' => NULL,
                     'other18' => NULL,
                     'other17' => NULL,
                     'other39' => NULL,
                     'other40' => NULL,
                    ];
                }else{
                    $other_insert_data1 = [
                     'otherint1' => $haisouBango,
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
                    ];
                }//second tab end here

                //third tab start here
                if((trim(request('haisoumoji2'))==2 && trim(request('syukeiki'))==2) || (trim(request('haisoumoji2'))==1 && trim(request('syukeiki'))==2)){
                    $other_insert_data2 = [
                        'otherint1' => $haisouBango,
                        'other1' => self::getJouhouData(trim(request('other1')),'0802事業所口座使用区分'),
                        'other36' => trim(request('other36')),
                        'other19' => NULL,
                        'other20' => NULL,
                        'other21' => NULL,
                        'other22' => NULL,
                        'other23' => NULL,
                        'other24' => NULL,
                        'otherfloat2' => NULL,
                        'other30' => NULL,
                        'other25' => NULL,
                        'other26' => NULL,
                        'otherfloat4' => NULL,
                        'other27' => NULL,
                        'other28' => NULL,
                        'other31' => NULL,
                        'other32' => NULL,
                        'other33' => NULL,
                        'other34' => NULL,
                        'other35' => NULL,
                        'otherfloat3' => NULL,
                        'other37' => NULL,
                        'other38' => NULL,
                    ];
                }else{
                    $other_insert_data2 = [
                        'otherint1' => $haisouBango,
                        'other1' => self::getJouhouData(trim(request('other1')),'0802事業所口座使用区分'),
                        'other36' => trim(request('other36')),
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
                }//third tab end here

                $other_insert_data = array_merge($other_insert_data1,$other_insert_data2);

                $others = QueryHelper::insertData('others2',$other_insert_data,'otherint1',false,$bango,__CLASS__,__FUNCTION__,__LINE__);

            }else{
                $haisouBango = "";
                $torihikisakibango = "";
            }

            $result['status'] = 'ok';
            $result['torihikisakibango'] = $torihikisakibango;
            $result['change_id'] = $haisouBango;

            $query = allHaisou::data($bango, 0);
            $query .= " and bango = $haisouBango ";
            $data = QueryHelper::fetchSingleResult($query);
            $headers['データ有効区分'] = 'kounyusu';
            CSVLogger::putData('事業所マスタ.csv', 'haisou', $data, $data, $bangoName, $headers, 1);

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
            //$requestInfo = requestTable::where('color',$color)->where('syouhinbango',$request_data)->first();
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
