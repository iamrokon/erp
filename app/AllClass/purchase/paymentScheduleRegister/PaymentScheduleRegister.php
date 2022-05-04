<?php

namespace App\AllClass\purchase\paymentScheduleRegister;

use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use App\AllClass\master\CSVLogger;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;
use App\tantousya;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Helper;
use Exception;

class PaymentScheduleRegister{


    public static function create($request, $bango){

        $validator = PaymentScheduleRegistrationCreateValidation::handle(request()->all());


        $errors = $validator->errors();

        if ($errors->any()) {
            return $errors;
        }elseif(!$errors->any() && $request->submit_confirmation == ""){
            $result["status"] = "confirm";
            return $result;
        }else if (!$errors->any()) {
            // $result["status"] = "ok";
            // session()->flash('success_msg', "登録しました。");
            // $result['success_msg'] = "登録しました。";
            // return $result;

            // log
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 0610 payment schedule registration start\n";
            QueryHandler::logger($bango, $log_data);

            // connection for pg_query
            $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));

            pg_query($conn, "BEGIN");

            try{

                // data extracking for sz0003, sz0004
                // https://colgis-bd.backlog.com/view/USAC002-480
                // @202220426
                
                $purchase_payment_schedule_reg_102_temp = substr($request->purchase_payment_schedule_reg_102, 0, 8);
                $shiharaizandaka_data_temp = QueryHelper::fetchSingleResult("select * from shiharaizandaka where sz0002 = '$purchase_payment_schedule_reg_102_temp' order by sz0001 desc limit 1");
                $sz0003_temp_data = 0;
                $sz0004_temp_data = 0;
                 if(count((array)$shiharaizandaka_data_temp) > 0){
                    $sz0003_temp_data = $shiharaizandaka_data_temp->sz0003;
                    $sz0004_temp_data = $shiharaizandaka_data_temp->sz0004;
                }
                // ./data extracking for sz0003, sz0004

                $shiharaizandaka_insertable_data = [
                    'sz0001' => date("Y-m-d 00:00:00", strtotime($request->purchase_payment_schedule_reg_101)),
                    'sz0002' => substr($request->purchase_payment_schedule_reg_102, 0, 8),
                    'sz0003' => $sz0003_temp_data,
                    'sz0004' => $sz0004_temp_data,
                    'sz0005' => 0,
                    'sz0006' => 0,
                    'sz0007' => 0,
                    'sz0008' => 0,
                    'sz0009' => 0,
                    'sz0010' => 0,
                    'sz0011' => 0,
                    'sz0012' => 0,
                    'sz0013' => 0,
                    'sz0014' => 0,
                    'sz0015' => 0,
                    'sz0016' => 0,
                    'sz0017' => 0,
                    'sz0018' => 0,
                    'sz0019' => 0,
                    'sz0020' => 0,
                    'sz0021' => 0,
                    'sz0022' => 0,
                    'sz0023' => 0,
                    'sz0024' => 0,
                    'sz0025' => $request->purchase_payment_schedule_reg_211,
                    'sz0026' => (int)str_replace(',', '', $request->purchase_payment_schedule_reg_212),
                    'sz0027' => $request->purchase_payment_schedule_reg_213,
                    'sz0028' => (int)str_replace(',', '', $request->purchase_payment_schedule_reg_214),
                    'sz0029' => $request->purchase_payment_schedule_reg_215,
                    'sz0030' => (int)str_replace(',', '', $request->purchase_payment_schedule_reg_216),
                    'sz0031' => $request->purchase_payment_schedule_reg_221,
                    'sz0032' => (int)str_replace(',', '', $request->purchase_payment_schedule_reg_222),
                    'sz0033' => $request->purchase_payment_schedule_reg_223,
                    'sz0034' => (int)str_replace(',', '', $request->purchase_payment_schedule_reg_224),
                    'sz0035' => $request->purchase_payment_schedule_reg_225,
                    'sz0036' => (int)str_replace(',', '', $request->purchase_payment_schedule_reg_226),
                    'sz0037' => date("Y-m-d 00:00:00", strtotime($request->purchase_payment_schedule_reg_231)),
                    //'sz0038' => $sz0038,
                    //'sz0039' => $sz0039,
                ];

                $shiharaizandaka_result = QueryHelper::insertData('shiharaizandaka',$shiharaizandaka_insertable_data,'sz0002',true, $bango, __CLASS__, __FUNCTION__, __LINE__);


                $result['status'] = 'ok';
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 0610 payment schedule registration end\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "COMMIT");

                // successfull msg
                session()->flash('success_msg', "登録しました。");
                $result['success_msg'] = "登録しました。";

            }catch(Exception $e){
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "ROLLBACK");
                session()->flash('success_msg', "something went wrong");
                $result['status'] = 'ng';
                $result['error_msg'] = "something went wrong";
                $result['exception'] = $e->getMessage();
            } // ./end catch
        } // ./end else if

        return $result;
    } // ./ end create function

    public static function update($request, $bango){

        $validator = PaymentScheduleRegistrationCreateValidation::handle(request()->all());


        $errors = $validator->errors();

        if ($errors->any()) {
            return $errors;
        }elseif(!$errors->any() && $request->submit_confirmation == ""){
            $result["status"] = "confirm";
            return $result;
        }else if (!$errors->any()) {
            // $result["status"] = "ok";
            // session()->flash('success_msg', "登録しました。");
            // $result['success_msg'] = "登録しました。";
            // return $result;

            // log
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 0610 payment schedule registration update start\n";
            QueryHandler::logger($bango, $log_data);

            // connection for pg_query
            $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));

            pg_query($conn, "BEGIN");

            try{

                // get data from table with sz0001 and sz0002
                $purchase_payment_schedule_reg_101 = date("Y-m-d 00:00:00", strtotime($request->purchase_payment_schedule_reg_101));
                $purchase_payment_schedule_reg_102 = $request->purchase_payment_schedule_reg_102;
                $purchase_payment_schedule_reg_102 = substr($purchase_payment_schedule_reg_102, 0, 8);

                // $shiharaizandaka_data = DB::table("shiharaizandaka")
                //                                 ->select("*")
                //                                 ->where("date(sz0001)", "=", '$purchase_payment_schedule_reg_101')
                //                                 ->where("sz0002", "=", '$purchase_payment_schedule_reg_102')
                //                                 ->take(1)
                //                                 ->get();
                $shiharaizandaka_data = QueryHelper::fetchSingleResult("select * from shiharaizandaka where date(sz0001) = '$purchase_payment_schedule_reg_101' and sz0002 = '$purchase_payment_schedule_reg_102' limit 1");

//                dd($shiharaizandaka_data);
                if(count(array($shiharaizandaka_data)) > 0){
                    $shiharaizandaka_updatable_data = [
                        'sz0001' => $shiharaizandaka_data->sz0001,
                        'sz0002' => $shiharaizandaka_data->sz0002,
                        'sz0003' => (int)$shiharaizandaka_data->sz0003,
                        'sz0004' => (int)$shiharaizandaka_data->sz0004,
                        'sz0005' => (int)$shiharaizandaka_data->sz0005,
                        'sz0006' => (int)$shiharaizandaka_data->sz0006,
                        'sz0007' => (int)$shiharaizandaka_data->sz0007,
                        'sz0008' => (int)$shiharaizandaka_data->sz0008,
                        'sz0009' => (int)$shiharaizandaka_data->sz0009,
                        'sz0010' => (int)$shiharaizandaka_data->sz0010,
                        'sz0011' => (int)$shiharaizandaka_data->sz0011,
                        'sz0012' => (int)$shiharaizandaka_data->sz0012,
                        'sz0013' => (int)$shiharaizandaka_data->sz0013,
                        'sz0014' => (int)$shiharaizandaka_data->sz0014,
                        'sz0015' => (int)$shiharaizandaka_data->sz0015,
                        'sz0016' => (int)$shiharaizandaka_data->sz0016,
                        'sz0017' => (int)$shiharaizandaka_data->sz0017,
                        'sz0018' => (int)$shiharaizandaka_data->sz0018,
                        'sz0019' => (int)$shiharaizandaka_data->sz0019,
                        'sz0020' => (int)$shiharaizandaka_data->sz0020,
                        'sz0021' => (int)$shiharaizandaka_data->sz0021,
                        'sz0022' => (int)$shiharaizandaka_data->sz0022,
                        'sz0023' => (int)$shiharaizandaka_data->sz0023,
                        'sz0024' => (int)$shiharaizandaka_data->sz0024,

                        'sz0025' => $request->purchase_payment_schedule_reg_211,
                        'sz0026' => (int)str_replace(',', '', $request->purchase_payment_schedule_reg_212),
                        'sz0027' => $request->purchase_payment_schedule_reg_213,
                        'sz0028' => (int)str_replace(',', '', $request->purchase_payment_schedule_reg_214),
                        'sz0029' => $request->purchase_payment_schedule_reg_215,
                        'sz0030' => (int)str_replace(',', '', $request->purchase_payment_schedule_reg_216),
                        'sz0031' => $request->purchase_payment_schedule_reg_221,
                        'sz0032' => (int)str_replace(',', '', $request->purchase_payment_schedule_reg_222),
                        'sz0033' => $request->purchase_payment_schedule_reg_223,
                        'sz0034' => (int)str_replace(',', '', $request->purchase_payment_schedule_reg_224),
                        'sz0035' => $request->purchase_payment_schedule_reg_225,
                        'sz0036' => (int)str_replace(',', '', $request->purchase_payment_schedule_reg_226),
                        'sz0037' => date("Y-m-d 00:00:00", strtotime($request->purchase_payment_schedule_reg_231)),
                        'sz0038' => (int)$shiharaizandaka_data->sz0038,
                        'sz0039' => (int)$shiharaizandaka_data->sz0039
                    ];

//                    dd($shiharaizandaka_updatable_data);

//                    dd($purchase_payment_schedule_reg_101,$purchase_payment_schedule_reg_102);
                    $shiharaizandaka_result = DB::table('shiharaizandaka')
                                      ->where('sz0001', $purchase_payment_schedule_reg_101)
                                      ->where('sz0002', $purchase_payment_schedule_reg_102)
                                      ->update($shiharaizandaka_updatable_data);

                    //$shiharaizandaka_result = QueryHelper::updateData('shiharaizandaka',$shiharaizandaka_updatable_data,'sz0002',true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                }else{

                    // data extracking for sz0003, sz0004
                    // https://colgis-bd.backlog.com/view/USAC002-480
                    // @202220426
                    
                    $purchase_payment_schedule_reg_102_temp = substr($request->purchase_payment_schedule_reg_102, 0, 8);
                    $shiharaizandaka_data_temp = QueryHelper::fetchSingleResult("select * from shiharaizandaka where sz0002 = '$purchase_payment_schedule_reg_102_temp' order by sz0001 desc limit 1");
                    $sz0003_temp_data = 0;
                    $sz0004_temp_data = 0;
                     if(count((array)$shiharaizandaka_data_temp) > 0){
                        $sz0003_temp_data = $shiharaizandaka_data_temp->sz0003;
                        $sz0004_temp_data = $shiharaizandaka_data_temp->sz0004;
                    }
                    // ./data extracking for sz0003, sz0004

                     $shiharaizandaka_insertable_data = [
                        'sz0001' => date("Y-m-d 00:00:00", strtotime($request->purchase_payment_schedule_reg_101)),
                        'sz0002' => substr($request->purchase_payment_schedule_reg_102, 0, 8),
                         'sz0003' => $sz0003_temp_data,
                         'sz0004' => $sz0004_temp_data,
                        'sz0005' => 0,
                        'sz0006' => 0,
                        'sz0007' => 0,
                        'sz0008' => 0,
                        'sz0009' => 0,
                        'sz0010' => 0,
                        'sz0011' => 0,
                        'sz0012' => 0,
                        'sz0013' => 0,
                        'sz0014' => 0,
                        'sz0015' => 0,
                        'sz0016' => 0,
                        'sz0017' => 0,
                        'sz0018' => 0,
                        'sz0019' => 0,
                        'sz0020' => 0,
                        'sz0021' => 0,
                        'sz0022' => 0,
                        'sz0023' => 0,
                        'sz0024' => 0,
                        'sz0025' => $request->purchase_payment_schedule_reg_211,
                        'sz0026' => (int)str_replace(',', '', $request->purchase_payment_schedule_reg_212),
                        'sz0027' => $request->purchase_payment_schedule_reg_213,
                        'sz0028' => (int)str_replace(',', '', $request->purchase_payment_schedule_reg_214),
                        'sz0029' => $request->purchase_payment_schedule_reg_215,
                        'sz0030' => (int)str_replace(',', '', $request->purchase_payment_schedule_reg_216),
                        'sz0031' => $request->purchase_payment_schedule_reg_221,
                        'sz0032' => (int)str_replace(',', '', $request->purchase_payment_schedule_reg_222),
                        'sz0033' => $request->purchase_payment_schedule_reg_223,
                        'sz0034' => (int)str_replace(',', '', $request->purchase_payment_schedule_reg_224),
                        'sz0035' => $request->purchase_payment_schedule_reg_225,
                        'sz0036' => (int)str_replace(',', '', $request->purchase_payment_schedule_reg_226),
                        'sz0037' => date("Y-m-d 00:00:00", strtotime($request->purchase_payment_schedule_reg_231)),
                        //'sz0038' => $sz0038,
                        //'sz0039' => $sz0039,
                    ];

                    $shiharaizandaka_result = QueryHelper::insertData('shiharaizandaka',$shiharaizandaka_insertable_data,'sz0002',true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                }


                $result['status'] = 'ok';
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 0610 payment schedule registration update end\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "COMMIT");

                // successfull msg
                session()->flash('success_msg', "登録しました。");
                $result['success_msg'] = "登録しました。";

            }catch(Exception $e){
//                dd($e);
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "ROLLBACK");
                session()->flash('success_msg', "something went wrong");
                $result['status'] = 'ng';
                $result['error_msg'] = "something went wrong";
                $result['exception'] = $e->getMessage();
            } // ./end catch
        } // ./end else if
//        dd($result);
        return $result;
    }
}
