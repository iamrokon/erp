<?php

namespace App\AllClass\master\companyMaster;
use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use App\AllClass\master\CSVLogger;
use DB;
use App\haisoujouhou;
use App\Kakaku;
use App\kokyaku1;
use App\haisou;
use App\requestTable;
Use \Carbon\Carbon;
use Illuminate\Http\Request;
use File;
Use App\AllClass\master\csvRecordInsert;
use App\tantousya;
use Illuminate\Support\Facades\Input;
use App\Helpers\Helper;

Class createCompanyMaster{
  public static function create($request,$bango,$file,$headers)
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
    $validator = validateCompanyMaster::validate($request,$bango);

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
            $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 会社マスタ start\n";
            QueryHandler::logger($bango,$log_data);

            $conn = pg_connect("host=".env("DB_HOST")." port=".env("DB_PORT")."  dbname=".env("DB_DATABASE")." user=".env("DB_USERNAME")." password=".env("DB_PASSWORD"));
            pg_query($conn,mb_convert_encoding("BEGIN", "CP51932"));

            try{
                //$maxYobi12 = DB::select( DB::raw("SELECT max(yobi12) as yobi12 FROM kokyaku1 WHERE LENGTH(yobi12) = 6") );
                //if($maxYobi12){
                //    $yobi12_old = $maxYobi12[0]->yobi12 + 1;
                //    $yobi12 = str_pad($yobi12_old, 6, '0', STR_PAD_LEFT);
                //}else{
                //    $yobi12 = '000001';
                //}
                
                //find missing number in sorted order or find max_yobi12 starts here
                $temp_kokyaku1 = QueryHelper::fetchSingleResult("
                    select yobi12
                        from (
                            select generate_series (1, (select max(yobi12::int) from kokyaku1)) as yobi12
                            except
                            select yobi12::int
                            from kokyaku1
                        ) temp_kokyaku1
                        order by yobi12 limit 1
                    ");
                if(count((array) $temp_kokyaku1)>0){
                    $yobi12 = sprintf('%06d', $temp_kokyaku1->yobi12);
                }else{
                    $kokyaku1Data = DB::select( DB::raw("SELECT max(CAST(yobi12 as integer)) as max_yobi12 FROM kokyaku1") );
                    if($kokyaku1Data){
                        $yobi12 = $kokyaku1Data[0]->max_yobi12 + 1;
                        $yobi12 = sprintf('%06d', $yobi12);
                    }else{
                       $yobi12 = '000001'; 
                    }
                }
                //find missing number in sorted order or find max_yobi12 ends here
                
                //modified filename
                if($file != ""){
                    $filenameWithExtension = $file->getClientOriginalName();
                    $fileExtension = '.' . $file->getClientOriginalExtension();
                    $filename = explode($fileExtension, $filenameWithExtension);
                    $filename = $filename[0] . '¶' . $yobi12."01001" . '_' . static::getCurrentTime() . $fileExtension;
                }else{
                    $filename = null;
                }

                $company_arr1 = [
                    'yobi12' => $yobi12,
                    'name' => trim(request('name')),
                    'address' => trim(request('address')),
                    'furigana' => trim(request('furigana')),
                    'yubinbango' => request('yubinbango'),
                    //'yobi13' => request('yobi13'),
                    'yobi13' => $filename,
                    'tel' => request('tel'),
                    'fax' => trim(request('fax')),
                    'torihikisakibango' => trim(request('torihikisakibango')),
                    'tantousya' => request('tantousya'),
                    'kcode1' => request('kcode1'),
                    'kcode2' => request('kcode2'),
                    'stoiawsestart' => request('stoiawsestart'),
                    'stoiawseend' => request('stoiawseend'),
                    'stoiawsesaiban' => request('stoiawsesaiban'),
                    'kensakukey' => trim(request('kensakukey')),
                    'yekessaihouhou' => $mytime,
                    'denpyosaiban' => 0,
                  //  'sekessaihouhou' => Helper::getSystemIP(),
                    'pointterm' => $bango,
                ];

                //second tab start here
                if((trim(request('syukeituki'))==2 && trim(request('syukeikikijun'))==2) || (trim(request('syukeituki'))==2 && trim(request('syukeikikijun'))==1)){
                   $company_arr2 = [
                       'kcode3' => NULL,
                       'ytoiawsestart' => NULL,
                       'ytoiawseend' => NULL,
                       'ytoiawsesaiban' => NULL,
                       'yetoiawsestart' => NULL,
                       'yetoiawseend' => NULL,
                       'yetoiawsesaiban' => NULL,
                       'mail_soushin' => NULL,
                       'mail_jyushin' => NULL,
                       'mail_nouhin' => NULL,
                       'mail_toiawase' => NULL,
                       'mail_soushin_mb' => NULL,
                       'mail_jyushin_mb' => NULL,
                       'mail_nouhin_mb' => NULL,
                       'mail_toiawase_mb' => NULL,
                       'mallsoukobango1' => NULL,
                       'mallsoukobango2' => NULL,
                       'mallsoukobango3' => NULL,
                       'domain' => NULL,
                       'domain2' => NULL,
                       'denpyostart' => NULL,
                       'kcode4' => NULL,
                       'kcode5' => NULL,
                   ];


                }else{
                    $company_arr2 = [
                        'kcode3' => self::getJouhouData(trim(request('kcode3')),'0801即時区分'),
                        'ytoiawsestart' => request('ytoiawsestart'),
                        'ytoiawseend' => request('ytoiawseend'),
                        'ytoiawsesaiban' => self::getJouhouData(trim(request('ytoiawsesaiban')),'0801入金月'),
                        'yetoiawsestart' => request('yetoiawsestart'),
                        'yetoiawseend' => self::getJouhouData(trim(request('yetoiawseend')),'0801入金日休日設定'),
                        'yetoiawsesaiban' => self::getJouhouData(trim(request('yetoiawsesaiban')),'0801入金振込手数料設定'),
                        'mail_soushin' => request('mail_soushin').'|'.request('mail_soushin_extra'),
                        'mail_jyushin' => trim(request('mail_jyushin')),
                        'mail_nouhin' => self::getJouhouData(trim(request('mail_nouhin')),'0801請求書メール区分'),
                        'mail_toiawase' => trim(request('mail_toiawase')),
                        'mail_soushin_mb' => self::getJouhouData(trim(request('mail_soushin_mb')),'0801請求書UIS'),
                        'mail_jyushin_mb' => self::getJouhouData(trim(request('mail_jyushin_mb')),'0801請求書郵送'),
                        'mail_nouhin_mb' => request('mail_nouhin_mb').'|'.request('mail_nouhin_mb_extra'),
                        'mail_toiawase_mb' => request('mail_toiawase_mb'),
                        'mallsoukobango1' => request('mallsoukobango1'),
                        'mallsoukobango2' => self::getJouhouData(trim(request('mallsoukobango2')),'0801専伝区分'),
                        'mallsoukobango3' => trim(request('mallsoukobango3')),
                        'domain' => request('domain'),
                        'domain2' => request('domain2'),
                        'denpyostart' => str_replace(",","",request('denpyostart')),
                        'kcode4' => request('kcode4'),
                        'kcode5' => request('kcode5'),
                    ];

                }
                //second tab end here

                $insert_data = array_merge($company_arr1,$company_arr2);
                $companyInfo = QueryHelper::insertData('kokyaku1',$insert_data,'bango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);

                if($companyInfo){
                    if($file != ""){
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

                    $kokyaku1bango = $companyInfo->bango;

                    $haisoujouhou_arr1 = [
                        'syukei1' => $kokyaku1bango,
                        'kounyusu' => request('kounyusu'),
                        'datatxt0050' => trim(request('datatxt0050')),
                        'syukeitukikijun' => trim(request('syukeitukikijun')),
                        'syukeinen' => trim(request('syukeinen')),
                        'syukeituki' => self::getJouhouData(trim(request('syukeituki')),'0801売上区分'),
                        'syukeikikijun' => self::getJouhouData(trim(request('syukeikikijun')),'0801仕入区分'),
                        'bunrui6' => trim(request('bunrui6'))
                    ];


                   //second tab start here
                   if((trim(request('syukeituki'))==2 && trim(request('syukeikikijun'))==2) || (trim(request('syukeituki'))==2 && trim(request('syukeikikijun'))==1)){
                        $haisoujouhou_arr2 = [
                           'datatxt0051' => NULL,
                           'netusername' => NULL,
                           'netuserpasswd' => NULL,
                           'netlogin' => NULL,
                           'address' => NULL,
                           'kaiinbango' => NULL,
                           'zokugara' => NULL,
                           'name' => NULL,
                           'yubinbango' => NULL,
                           'datatxt0058' => NULL,
                           'datatxt0059' => NULL,
                           'datatxt0060' => NULL,
                           'datatxt0061' => NULL,
                        ];

                   }else{
                       $haisoujouhou_arr2 = [
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
                           'datatxt0061' => request('datatxt0061')
                       ];

                   }
                   //second tab end here

                   //third tab start here
                   if((trim(request('syukeituki'))==2 && trim(request('syukeikikijun'))==2) || (trim(request('syukeituki'))==1 && trim(request('syukeikikijun'))==2)){
                        $haisoujouhou_arr3 = [
                                'tel' => NULL,
                                'mail' => NULL,
                                'sex' => NULL,
                                'bunrui1' => NULL,
                                'bunrui2' => NULL,
                                'syukeinenkijun' => NULL,
                                'bunrui3' => NULL,
                                'datatxt0054' => NULL,
                                'datatxt0055' => NULL,
                                'endtime' => NULL,
                                'datatxt0056' => NULL,
                                'datatxt0057' => NULL,
                                'syukei3' => NULL,
                                'syukeiki' => NULL,
                                'datatxt0053' => NULL,
                                'bunrui4' => NULL,
                                'bunrui5' => NULL,
                                'syukei2' => NULL,
                                'bunrui9' => NULL,
                                'bunrui10' => NULL,
                                'datatxt0052' => NULL
                        ];

                   }else{
                        $haisoujouhou_arr3 = [
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

                   }
                  //third tab end here

                   //$haisoujouhou->save();
                   $haisoujouhou_insert_data = array_merge($haisoujouhou_arr1,$haisoujouhou_arr2,$haisoujouhou_arr3);

                   $haisoujouhou = QueryHelper::insertData('haisoujouhou',$haisoujouhou_insert_data,'syukei1',false,$bango,__CLASS__,__FUNCTION__,__LINE__);
                }

                $result['status'] = "ok";
                $result['change_id'] = $kokyaku1bango;

                //insert data record
                $query = allCompany::data($bango, 0, $kokyaku1bango);
                $data = QueryHelper::fetchSingleResult($query);
                $headers['データ有効区分']='denpyosaiban';
                CSVLogger::putData('会社マスタ.csv', 'kokyaku1', $data, $data, $bangoName, $headers, 1);

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
