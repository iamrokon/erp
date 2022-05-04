<?php

namespace App\Http\Controllers\purchase;
use Illuminate\Http\Request;
use App\tantousya;
use App\kengen;
use App\requestTable;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\purchase\accountBalanceUpdate\AllAccountBalanceUpdate;
use Illuminate\Support\Facades\Validator;
use App\AllClass\ButtonMsg;
use Illuminate\Pagination\Paginator;
use App\AllClass\master\excelDownload;
use App\AllClass\TableSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Excel;
use Illuminate\Validation\Rule;
use App\AllClass\master\ExcelReportDownload;
use Carbon\Carbon;
use App\AllClass\master\CSVLogger;
use App\AllClass\newExcelExport;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;

class AccountBalanceUpdateController extends Controller
{

    public function postAccountBalanceUpdate(Request $request)
    {
        $bango = request('userId');
        $tantousya = tantousya::find($bango);
        if($request->ajax()){
            if(request('submit_confirmation') == ""){
                return "confirmation_msg"; 
            }
            
            $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7504'");
            $date = $reviewData->orderbango;
            if($date == null){
              return "no_date";   
            }elseif(strlen($date) < 8){
               return "invalid_date"; 
            }
            
            $tmp_date = substr($date,0,6)."01";
            $effectiveDate = strtotime("+1 months", strtotime($tmp_date));
            $effectiveDate = strftime ( '%Y%m%d' , $effectiveDate );
            $lastday = date('t',strtotime($effectiveDate));
            $kk0001 = substr($effectiveDate,0,4)."-".substr($effectiveDate,4,2)."-".$lastday." 00:00:00";
            
            $query = AllAccountBalanceUpdate::data($bango, $request->all(),$effectiveDate)->toSql();
            $accountBalanceData = QueryHelper::fetchResult($query);
            if(count($accountBalanceData) > 0){
                //start log query
                $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 買掛残高更新 start\n";
                QueryHandler::logger($bango,$log_data);
                $conn = pg_connect("host=".env("DB_HOST")." port=".env("DB_PORT")."  dbname=".env("DB_DATABASE")." user=".env("DB_USERNAME")." password=".env("DB_PASSWORD"));
                pg_query($conn,"BEGIN");
                try{
                    $cn = 0;
                    $kaikakezandakaData = QueryHelper::fetchSingleResult("select * from kaikakezandaka where kk0001 = '$kk0001'");
                    if($kaikakezandakaData){
                        $tmp_kk0001 = $kaikakezandakaData->kk0001;
                        QueryHelper::fetchSingleResult("DELETE FROM kaikakezandaka WHERE kk0001='$tmp_kk0001'");
                    }
                   
                    foreach($accountBalanceData as $key=>$val){
                        $company_code = $val->company_code;
                        $kaikakezandakaTmpData = QueryHelper::fetchSingleResult("select kk0015 from kaikakezandaka where kk0001 < '$kk0001' AND kk0002 = '$company_code' order by kk0001 desc");
                        if($kaikakezandakaTmpData){
                            $kk0004 = $kaikakezandakaTmpData->kk0015;
                        }else{
                           $kk0004 = 0; 
                        }
                        $company_code = $val->company_code;
                        $kk0004 = $kk0004;
                        $kk0003 = $val->sr0002 == 'not_70' ? 1 : 2;
                        $kk0005 = $val->sr0011;
                        $kk0006 = 0;
                        $kk0007 = 0;
                        $kk0008 = 0;
                        $kk0009 = $val->sr0012;
                        $kk0010 = $val->kk0010;
                        $kk0011 = $val->kk0011;
                        $kk0012 = $val->kk0012;
                        $kk0013 = 0;
                        $kk0014 = $val->kk0014;
                        $kk0015 = $kk0004 + ($kk0005 + $kk0006 + $kk0007 + $kk0008 + $kk0009) - ($kk0010 + $kk0011 + $kk0012 + $kk0013 + $kk0014);
                        $kaikakezandaka_insert_data = [
                            'kk0001' => $kk0001,
                            'kk0002' => $company_code,
                            'kk0003' => $kk0003,
                            'kk0004' => $kk0004,
                            'kk0005' => $kk0005,
                            'kk0006' => $kk0006,
                            'kk0007' => $kk0007,
                            'kk0008' => $kk0008,
                            'kk0009' => $kk0009,
                            'kk0010' => $kk0010,
                            'kk0011' => $kk0011,
                            'kk0012' => $kk0012,
                            'kk0013' => $kk0013,
                            'kk0014' => $kk0014,
                            'kk0015' => $kk0015,
                            'kk0016' => 0,
                            'kk0017' => 0,
                            'kk0018' => 0,
                            'kk0019' => 0,
                            'kk0020' => 0,
                            'kk0021' => 0,
                            'kk0022' => 0,
                            'kk0023' => 0,
                            'kk0024' => 0,

                        ];
                        $kaikakezandaka = QueryHelper::insertData('kaikakezandaka',$kaikakezandaka_insert_data,'kk0002',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                        $cn++;
                    }
                    
                    $updateData = QueryHelper::fetchResult("select * from account_balance_hikiatenyuko_update");
                    foreach($updateData as $tmp_key=>$tmp_val){
                        $purchase_number = $tmp_val->purchase_number;
                        $hikiatenyuko_update_data = [
                            'syouhinid' => $purchase_number,
                            'hantei' => 1,
                            'denpyoshimebi' => Carbon::now()->setTimezone("Asia/Tokyo")->format('Y-m-d H:i:s'),
                            'tantousyabango' => $bango,
                        ];
                        $reviewUpdate = QueryHelper::updateData('hikiatenyuko', $hikiatenyuko_update_data, 'syouhinid', $bango, __CLASS__, __FUNCTION__, __LINE__);
                    }
                    
                    //end log query
                    $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 買掛残高更新 end\n";
                    QueryHandler::logger($bango,$log_data);

                    if($cn > 0){
                        $success_msg = "正常に終了しました。";
                        Session::flash('success_msg', $success_msg);
                    }
                    
                    pg_query($conn, "COMMIT");
                    return "ok";
                } catch (\Exception $e) {
                    $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                    QueryHandler::logger($bango, $log_data);
                    pg_query($conn,"ROLLBACK");
                    return "ng";
                }
            }else{
                return "no_data_found";
            }
        }
        
        return view('purchase.accountBalanceUpdate.mainAccountBalanceUpdate', compact('bango', 'tantousya'));
    }
    
    public static function getCurrentTime()
    {
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        return str_replace(" ", "", $mytime);
    }

}
