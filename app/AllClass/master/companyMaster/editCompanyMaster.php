<?php

namespace App\AllClass\master\companyMaster;

use DB;
use App\syouhin1;
use App\Kakaku;
use App\kokyaku1;
use App\haisoujouhou;
use App\requestTable;
Use \Carbon\Carbon;
use File;
Use App\AllClass\master\csvRecordEdit;
use App\AllClass\master\CSVLogger;
use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use App\tantousya;
use Illuminate\Support\Facades\Input;
use App\Helpers\Helper;

Class editCompanyMaster{
  public static function edit($request,$bango,$file,$headers)
  {

    $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
    $bangoName=tantousya::find($bango)->name;

    foreach ($request as $key => $value){
        if ($key=='_token'||$key=='type'){
          unset($request[$key]);
        }
    }

    $validator=validateCompanyEditMaster::validate($request,$bango);
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
            $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 会社マスタ start\n";
            QueryHandler::logger($bango,$log_data);

            $conn = pg_connect("host=".env("DB_HOST")." port=".env("DB_PORT")."  dbname=".env("DB_DATABASE")." user=".env("DB_USERNAME")." password=".env("DB_PASSWORD"));
            pg_query($conn,mb_convert_encoding("BEGIN", "CP51932"));

            try{
                $query = allCompany::data($bango, 0, request('bango'));
                $updateBefore = QueryHelper::fetchSingleResult($query);

                $yobi12 = request('yobi12');
                $new_yobi13 = request('yobi13');
                $old_yobi13 = request('old_yobi13');
                $old_yobi13_short = request('old_yobi13_short');
                if($old_yobi13_short == $new_yobi13){
                    $filename = $old_yobi13;
                }else{
                    $filenameWithExtension = $file->getClientOriginalName();
                    $fileExtension = '.' . $file->getClientOriginalExtension();
                    $filename = explode($fileExtension, $filenameWithExtension);
                    $filename = $filename[0] . '¶' . $yobi12."01001" . '_' . static::getCurrentTime() . $fileExtension;
                }

                $kokyaku_update_data = [
                   'bango' => trim(request('bango')),
                   'name' =>trim(request('name')),
                   'address' =>trim(request('address')),
                   'furigana' =>trim(request('furigana')),
                   'yubinbango' =>request('yubinbango'),
                   'yobi13' =>$filename,
                   'tel' =>request('tel'),
                   'fax' =>trim(request('fax')),
                   'torihikisakibango' =>trim(request('torihikisakibango')),
                   'tantousya' =>request('tantousya'),
                   'kcode1' =>request('kcode1'),
                   'kcode2' =>request('kcode2'),
                   'stoiawsestart' =>request('stoiawsestart'),
                   'stoiawseend' =>request('stoiawseend'),
                   'stoiawsesaiban' =>request('stoiawsesaiban'),
                   'kensakukey' =>trim(request('kensakukey')),
                   'kcode3' => self::getJouhouData(trim(request('kcode3')),'0801即時区分'),
                   'ytoiawsestart' =>request('ytoiawsestart'),
                   'ytoiawseend' =>request('ytoiawseend'),
                   'ytoiawsesaiban' => self::getJouhouData(trim(request('ytoiawsesaiban')),'0801入金月'),
                   'yetoiawsestart' =>request('yetoiawsestart'),
                   'yetoiawseend' => self::getJouhouData(trim(request('yetoiawseend')),'0801入金日休日設定'),
                   'yetoiawsesaiban' => self::getJouhouData(trim(request('yetoiawsesaiban')),'0801入金振込手数料設定'),
                   'mail_soushin' =>request('mail_soushin').'|'.request('mail_soushin_extra'),
                   'mail_jyushin' =>trim(request('mail_jyushin')),
                   'mail_nouhin' => self::getJouhouData(trim(request('mail_nouhin')),'0801請求書メール区分'),
                   'mail_toiawase' =>trim(request('mail_toiawase')),
                   'mail_soushin_mb' => self::getJouhouData(trim(request('mail_soushin_mb')),'0801請求書UIS'),
                   'mail_jyushin_mb' => self::getJouhouData(trim(request('mail_jyushin_mb')),'0801請求書郵送'),
                   'mail_nouhin_mb' =>request('mail_nouhin_mb').'|'.request('mail_nouhin_mb_extra'),
                   'mail_toiawase_mb' =>request('mail_toiawase_mb'),
                   'mallsoukobango1' =>request('mallsoukobango1'),
                   'mallsoukobango2' => self::getJouhouData(trim(request('mallsoukobango2')),'0801専伝区分'),
                   'mallsoukobango3' =>trim(request('mallsoukobango3')),
                   'denpyostart' => str_replace(",","",request('denpyostart')),
                   'domain' =>request('domain'),
                   'domain2' =>request('domain2'),
                   'kcode4' =>request('kcode4'),
                   'kcode5' =>request('kcode5'),
                   'sokurijyouhinmei' =>$mytime,
                   'pointterm' =>$bango,
                  // 'sekessaihouhou' => Helper::getSystemIP(),
                ];

                $kokyaku1Update = QueryHelper::updateData('kokyaku1',$kokyaku_update_data,'bango',$bango,__CLASS__,__FUNCTION__,__LINE__);

                if($kokyaku1Update){

                    if($old_yobi13_short != $new_yobi13){
                        $file_path = public_path().'\uploads//company_master\\'.$old_yobi13;
                        File::delete($file_path);
                        //$file_path2 = public_path().'\uploads//lbook\\'.$old_yobi13;
                        //File::delete($file_path2);
                        $file->move(public_path('uploads/company_master'), $filename);
                        
                         //check orderbango
                        $reviewData1 = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7301'");
                        if ($reviewData1) {
                            $orderbango = $reviewData1->orderbango + 1;
                            $mobile_flag = $reviewData1->mobile_flag;
                        } else {
                            $orderbango = "";
                            $mobile_flag = "";
                        }

                        $reviewData2 = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7501'");
                        if ($reviewData2) {
                            $orderbango2 = $reviewData2->orderbango;
                        } else {
                            $orderbango2 = "";
                        }
                        $modified_orderbango = "21" . $orderbango2 . str_pad($orderbango, $mobile_flag, '0', STR_PAD_LEFT);
                        
                        //============== L-Book reg start here ==================//
                        $soukonyuko_insert_data = [
                            'datachar01' => $modified_orderbango,
                            'datachar02' => $yobi12."01001",
                            'datachar03' => null,
                            'datachar04' => null,
                            'datachar05' => null,
                            'datachar06' => $bango,
                            'datachar07' => 'H123',
                            'datachar08' => '（信用録）'.trim(request('name')),
                            'datachar09' => $filename,
                            'datachar10' => 'H910',
                            'dataint25' => 0,
                            'datachar11' => static::getCurrentTime(),
                            'datachar13' => $bango,
                        ];
                        $soukonyuko = QueryHelper::insertData('soukonyuko', $soukonyuko_insert_data, 'datachar01', true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                        if ($soukonyuko && $file != "") {
                            \File::copy(public_path('uploads/company_master/') . $filename, public_path('uploads/lbook/') . $filename);
                        }

                        //update review data
                        $review_update_data = [
                            'kokyakusyouhinbango' => 'D7301',
                            'orderbango' => $orderbango,
                            'check_flag' => 0,
                            'color' => static::getCurrentTime(),
                            'size' => Helper::getSystemIP(),
                            'nickname' => $bango,
                        ];
                        QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                        //============== L-Book reg end here ==================//
                    }

                   $haisoujouhou_update_data = [
                       'syukei1' => trim(request('bango')),
                       'kounyusu' => request('kounyusu'),
                       'datatxt0050' => request('datatxt0050'),
                       'syukeitukikijun' => request('syukeitukikijun'),
                       'syukeinen' => request('syukeinen'),
                       'syukeituki' => self::getJouhouData(trim(request('syukeituki')),'0801売上区分'),
                       'syukeikikijun' => self::getJouhouData(trim(request('syukeikikijun')),'0801仕入区分'),
                       'bunrui6' => request('bunrui6'),
                       'datatxt0051' => self::getJouhouData(trim(request('datatxt0051')),'0801請求消費税計算区分'),
                       'netusername' => request('netusername'),
                       'netuserpasswd' => request('netuserpasswd'),
                       'netlogin' => request('netlogin'),
                       'address' => request('haisoujouhou_address'),
                       'kaiinbango' => request('kaiinbango'),
                       'zokugara' => request('zokugara'),
                       'name' => request('haisoujouhou_name'),
                       'yubinbango' => request('haisoujouhou_yubinbango'),
                       'datatxt0058' => request('datatxt0058'),
                       'datatxt0059' => request('datatxt0059'),
                       'datatxt0060' => request('datatxt0060'),
                       'datatxt0061' => request('datatxt0061'),
                       'tel' => request('haisoujouhou_tel'),
                       'mail' => self::getJouhouData(trim(request('mail')),'0801支払月'),
                       'sex' => request('sex'),
                       'bunrui1' => self::getJouhouData(trim(request('bunrui1')),'0801支払日休日設定'),
                       'bunrui2' => self::getJouhouData(trim(request('bunrui2')),'0801支払振込手数料設定'),
                       'syukeinenkijun' => request('syukeinenkijun'),
                       'bunrui3' => request('bunrui3'),
                       'datatxt0054' => trim(request('datatxt0054')),
                       'datatxt0055' => trim(request('datatxt0055')),
                       'endtime' => request('endtime'),
                       'datatxt0056' => trim(request('datatxt0056')),
                       'datatxt0057' => trim(request('datatxt0057')),
                       'syukei3' => trim(request('syukei3')),
                       'syukeiki' => request('syukeiki'),
                       'datatxt0053' => request('datatxt0053'),
                       'bunrui4' => request('bunrui4'),
                       'bunrui5' => request('bunrui5'),
                       'syukei2' => trim(request('syukei2')),
                       'bunrui9' => self::getJouhouData(trim(request('bunrui9')),'0801手形決済月'),
                       'bunrui10' => request('bunrui10'),
                       'datatxt0052' => self::getJouhouData(trim(request('datatxt0052')),'0801支払消費税計算区分'),
                   ];
                   $dataUpdate = QueryHelper::updateData('haisoujouhou',$haisoujouhou_update_data,'syukei1',$bango,__CLASS__,__FUNCTION__,__LINE__);
                }

                $result['status'] = "ok";
                $result['change_id'] = $request['bango'];

                $query = allCompany::data($bango, 0, request('bango'));
                $updateAfter = QueryHelper::fetchSingleResult($query);
                $headers['データ有効区分']='denpyosaiban';
                CSVLogger::putData('会社マスタ.csv', 'kokyaku1', $updateBefore, $updateAfter, $bangoName, $headers, 2);

                //end log query
                $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 会社マスタ end\n";
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
    
    public static function getCurrentTime()
    {
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        return str_replace(" ", "", $mytime);
    }


}
