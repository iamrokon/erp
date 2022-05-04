<?php

namespace App\Http\Controllers\other;
use Illuminate\Http\Request;
use App\tantousya;
use App\kengen;
use App\requestTable;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\other\specifyOrderEntry\validateSpecifyOrderEntry;
use App\AllClass\order\orderHistory\allOrderHistory;
use App\AllClass\order\orderEntry\searchCompany2;
use App\AllClass\order\orderEntry\searchCompany4;
use App\AllClass\ButtonMsg;
use Illuminate\Pagination\Paginator;
use App\AllClass\master\excelDownload;
use App\kokyaku1;
use App\AllClass\TableSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Excel;
use App\AllClass\master\ExcelReportDownload;
use Carbon\Carbon;
use App\AllClass\master\CSVLogger;
use App\AllClass\newExcelExport;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;

class SpecifyOrderEntryController extends Controller
{
    public function postSpecifyOrderEntry(Request $request)
    {
        $bango = request('userId');
        $input = $request->all();

        //check validation for first search
        if($request->ajax()){
            $validator = validateSpecifyOrderEntry::validate($request,$bango);
            $errors = $validator->errors();
            if($errors->any()){
               $err_msg = $errors->all();
               return ['err_field'=>$errors,'err_msg'=>$err_msg];
            }else if(!$errors->any() && request('submit_confirmation') == ""){
                return "confirmation_msg";
            }else{
                //start log query
                $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 受注入力可否指定 start\n";
                QueryHandler::logger($bango,$log_data);

                $conn = pg_connect("host=".env("DB_HOST")." port=".env("DB_PORT")."  dbname=".env("DB_DATABASE")." user=".env("DB_USERNAME")." password=".env("DB_PASSWORD"));
                pg_query($conn,"BEGIN");
                try{
                    if(isset($input['req_type']) && $input['req_type'] == 'on'){
                        $kengensetteiData = QueryHelper::fetchSingleResult("select * from kengensettei where kengenchar01 = 'user' and kengenchar03 = 'user_def'");  
                        if($kengensetteiData){
                            $kengenchar04 = $kengensetteiData->kengenchar04;
                            if(strpos($kengenchar04,'02-01=GO¶') !== false){
                                //nothing to change
                                
                                //$kengenchar04 = str_replace('02-01=GO¶', '', $kengenchar04);
                                //$kengensettei_update_data = [
                                //    'kengenchar01' => 'user',
                                //    'kengenchar04' => $kengenchar04,
                                //];
                                //$kengensettei = QueryHelper::updateData('kengensettei', $kengensettei_update_data, ['kengenchar01' => 'user'], true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                            }elseif(strpos($kengenchar04,'02-01=NG¶') !== false){
                                $kengenchar04 = str_replace('02-01=NG¶', '02-01=GO¶', $kengenchar04);
                                $kengensettei_update_data = [
                                    'kengenchar01' => 'user',
                                    //'kengenchar03' => 'user_def',
                                    'kengenchar04' => $kengenchar04,
                                ];
                                //$kengensettei = QueryHelper::updateData('kengensettei', $kengensettei_update_data, ['kengenchar01' => 'user', 'kengenchar03'=> 'user_def'], true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                                $kengensettei = QueryHelper::updateData('kengensettei', $kengensettei_update_data, ['kengenchar01' => 'user'], true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                            }else{
                                $kengenchar04Arr = explode("¶",$kengenchar04);
                                $temp_check = "01";
                                $kengenchar04 = "";
                                $insert_status = 1;
                                $temp_count = 0;
                                foreach($kengenchar04Arr as $key => $val){
                                    $temp_count++;
                                    if(substr($val,0,2) != $temp_check && $insert_status == 1){
                                        if(count($kengenchar04Arr) == $temp_count){
                                            $kengenchar04 .= '02-01=GO¶'.$val;
                                        }else{
                                            $kengenchar04 .= '02-01=GO¶'.$val."¶";
                                        }
                                        $insert_status = 0;
                                    }else{
                                        if(count($kengenchar04Arr) == $temp_count){
                                            $kengenchar04 .= $val;
                                        }else{
                                            $kengenchar04 .= $val."¶";
                                        }
                                    }
                                }
                                $kengensettei_update_data = [
                                    'kengenchar01' => 'user',
                                    //'kengenchar03' => 'user_def',
                                    'kengenchar04' => $kengenchar04,
                                ];
                                //$kengensettei = QueryHelper::updateData('kengensettei', $kengensettei_update_data, ['kengenchar01' => 'user', 'kengenchar03'=> 'user_def'], true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                                $kengensettei = QueryHelper::updateData('kengensettei', $kengensettei_update_data, ['kengenchar01' => 'user'], true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                            }
                        }
                    }else{
                        $bango1 = $input['bango1'];
                        $bango2 = $input['bango2'];
                        $bango3 = $input['bango3'];
                        
                        //initialy deactive all
                        $tempBangoData = QueryHelper::fetchSingleResult("select * from kengensettei where kengenchar01 = 'user' and kengenchar03 = 'user_def'");
                        if($tempBangoData){
                            $temp_kengenchar04 = $tempBangoData->kengenchar04;
                            $temp_kengenchar04 = str_replace('02-01=GO¶', '', $temp_kengenchar04);
                            $temp_kengenchar04 = str_replace('02-01=NG¶', '', $temp_kengenchar04);
                            $kengensettei_update_data = [
                                'kengenchar01' => 'user',
                                'kengenchar04' => $temp_kengenchar04,
                            ];
                            $kengensettei = QueryHelper::updateData('kengensettei', $kengensettei_update_data, ['kengenchar01' => 'user'], true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                        }
                        //initialy deactive all
                        
                        if($bango1 != ""){
                            self::dataInsertion($bango1,$bango);
                        }
                        if($bango2 != ""){
                            self::dataInsertion($bango2,$bango);
                        }
                        if($bango3 != ""){
                            self::dataInsertion($bango3,$bango);
                        }
                        //$success_msg = "処理が正常に終了しました。";
                        //Session::flash('success_msg', $success_msg);
                        //return "ok";
                    }
                
                    //end log query
                    $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 受注入力可否指定 end\n";
                    QueryHandler::logger($bango,$log_data);
                    
                    pg_query($conn, "COMMIT");
                    
                    $success_msg = "処理が正常に終了しました。";
                    Session::flash('success_msg', $success_msg);
                    return "ok";
                } catch (\Exception $e) {
                    $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                    QueryHandler::logger($bango, $log_data);
                    pg_query($conn,"ROLLBACK");
                }
            }
        }
        
        $tantousya = tantousya::find($bango);
        return view('other.specifyOrderEntry.mainSpecifyOrderEntry', compact('bango', 'tantousya'));
    }
    
    public function dataInsertion($tantousya_bango,$bango){
            $bangoData = QueryHelper::fetchSingleResult("select * from kengensettei where kengenchar01 = 'user' and kengenchar03 = '$tantousya_bango'");
            if($bangoData){
                $kengenchar04 = $bangoData->kengenchar04;
                if(strpos($kengenchar04,'02-01=GO¶') !== false){
                    //nothing to change
                }elseif(strpos($kengenchar04,'02-01=NG¶') !== false){
                    $kengenchar04 = str_replace('02-01=NG¶', '02-01=GO¶', $kengenchar04);
                    $kengensettei_update_data = [
                        'kengenchar01' => 'user',
                        'kengenchar03' => $tantousya_bango,
                        'kengenchar04' => $kengenchar04,
                    ];
                    $kengensettei = QueryHelper::updateData('kengensettei', $kengensettei_update_data, ['kengenchar01' => 'user', 'kengenchar03'=> $tantousya_bango], true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                }else{
                    $kengenchar04Arr = explode("¶",$kengenchar04);
                    $temp_check = "01";
                    $kengenchar04 = "";
                    $insert_status = 1;
                    $temp_count = 0;
                    foreach($kengenchar04Arr as $key => $val){
                        $temp_count++;
                        if(substr($val,0,2) != $temp_check && $insert_status == 1){
                            if(count($kengenchar04Arr) == $temp_count){
                                $kengenchar04 .= '02-01=GO¶'.$val;
                            }else{
                                $kengenchar04 .= '02-01=GO¶'.$val."¶";
                            }
                            $insert_status = 0;
                        }else{
                            if(count($kengenchar04Arr) == $temp_count){
                                $kengenchar04 .= $val;
                            }else{
                                $kengenchar04 .= $val."¶";
                            }
                        }
                    }
                    $kengensettei_update_data = [
                        'kengenchar01' => 'user',
                        'kengenchar03' => $tantousya_bango,
                        'kengenchar04' => $kengenchar04,
                    ];
                    $kengensettei = QueryHelper::updateData('kengensettei', $kengensettei_update_data, ['kengenchar01' => 'user', 'kengenchar03'=> $tantousya_bango], true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                }
            }else{
                $userDefData = QueryHelper::fetchSingleResult("select * from kengensettei where kengenchar01 = 'user' and kengenchar03 = 'user_def'");
                if($userDefData){
                    $kengenchar04 = $userDefData->kengenchar04;
                    if(strpos($kengenchar04,'02-01=GO¶') !== false){
                    //nothing to change
                    }elseif(strpos($kengenchar04,'02-01=NG¶') !== false){
                        $kengenchar04= str_replace('02-01=NG¶', '02-01=GO¶', $kengenchar04);
                    }else{
                        $kengenchar04Arr = explode("¶",$kengenchar04);
                        $temp_check = "01";
                        $kengenchar04 = "";
                        $insert_status = 1;
                        $temp_count = 0;
                        foreach($kengenchar04Arr as $key => $val){
                            $temp_count++;
                            if(substr($val,0,2) != $temp_check && $insert_status == 1){
                                if(count($kengenchar04Arr) == $temp_count){
                                    $kengenchar04 .= '02-01=GO¶'.$val;
                                }else{
                                    $kengenchar04 .= '02-01=GO¶'.$val."¶";
                                }
                                $insert_status = 0;
                            }else{
                                if(count($kengenchar04Arr) == $temp_count){
                                    $kengenchar04 .= $val;
                                }else{
                                    $kengenchar04 .= $val."¶";
                                }
                            }
                        }
                    }

                    $kengensettei_insert_data = [
                        'kengenchar01' => $userDefData->kengenchar01,
                        'kengenchar02' => $userDefData->kengenchar02,
                        'kengenchar03' => $tantousya_bango,
                        'kengenchar04' => $kengenchar04,
                        'kengenchar05' => $userDefData->kengenchar05,
                        'kengenchar06' => $userDefData->kengenchar06,
                        'kengenchar06' => $userDefData->kengenchar06,
                        'kengenchar07' => $userDefData->kengenchar07,
                        'kengendate01' => $userDefData->kengendate01,
                        'kengendate02' => $userDefData->kengendate02,
                        'kengendate03' => $userDefData->kengendate03,
                        'kengenint01' => $userDefData->kengenint01,
                        'kengenint02' => $userDefData->kengenint02,
                        'kengenint03' => $userDefData->kengenint03,
                        'kengenint04' => $userDefData->kengenint04,
                        'kengenint05' => $userDefData->kengenint05,
                        'kengenint06' => $userDefData->kengenint06,
                        'kengenint07' => $userDefData->kengenint07,
                        'kengenint08' => $userDefData->kengenint08,
                        'kengenint09' => $userDefData->kengenint09,
                        'kengenint10' => $userDefData->kengenint10,
                    ];
                    $kengensettei = QueryHelper::insertData('kengensettei',$kengensettei_insert_data,'kengenchar01',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                } else {
                    return "no_data";
                }
            }
       
    }

}
