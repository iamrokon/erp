<?php

namespace App\AllClass\master\employeeMaster;

use App\AllClass\db\QueryHandler;
use App\AllClass\master\CSVLogger;
use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use DB;
use App\AllClass\master\csvRecordEdit;
use App\tantousya;
use \Carbon\Carbon;
use App\AllClass\master\employeeMaster\validateEmployeeEditMaster;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Session;

class editEmployeeMaster
{
    public static function edit($request, $bango,  $headers, $validate_only=0,$sql=null,$uniqid=null)
    {
        $ztanka = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7501'")->orderbango ?? null;
        $mytime = Carbon::now()->toDateTimeString();

        $yesterday =Carbon::yesterday()->toDateTimeString();
        $yesterday = str_replace(":", "", $yesterday);
        $yesterday = str_replace("-", "", $yesterday);
        $yesterday = str_replace(" ", "", $yesterday);

        //$ip = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : null;
        $tantousha = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $bangoName = $tantousha->name ?? null;
        $file = $request->file('datatxt0029') ?? null;
        $file2 = $request->file('syounin') ?? null;
        $request = $request->all();
        foreach ($request as $key => $value) {
            if ($key == '_token' || $key == 'type') {
                unset($request[$key]);
            }
            if ($value == "") {
                $request[$key] = null;
            }

        }


        $validator = validateEmployeeEditMaster::validate($request, $bango);

        $errors = $validator->errors();

        if ($errors->any() || Input::has('field')) {
            return $errors;
        } else {
            $result = [];
            if($validate_only != '1'){
                $mytime = str_replace(":", "", $mytime);
                $mytime = str_replace("-", "", $mytime);
                $mytime = str_replace(" ", "", $mytime);


                $new_inpemp2 = request('inpemp2');
                $old_inpemp2 = request('old_inpemp2');
                if ($old_inpemp2 == $new_inpemp2) {
                    $inpemp2 = $old_inpemp2;
                } else {
                    $inpemp2 = $new_inpemp2;
                }
                $new_inpemp4 = request('inpemp4');
                $old_inpemp4 = request('old_inpemp4');
                if ($old_inpemp4 == $new_inpemp4) {
                    $inpemp4 = $old_inpemp4;
                } else {
                    $inpemp4 = $new_inpemp4;
                }


                $query = allTantousya::data($bango, 0, request('bango'));
                $req_bango=request('bango');
                $updateBefore = QueryHelper::fetchSingleResult("select * from tantousya where  bango='$req_bango'");
                $check_tanto2=QueryHelper::fetchSingleResult("select max(ktanka) from tantousya2 where ztanka='$ztanka' and bango='$req_bango'");
                $ktanka=$check_tanto2->max==null?0:$check_tanto2->max+1;

                $tantousya2=[];
                foreach ($updateBefore as $key => $value) {
                    $tantousya2[$key]=$value;
                }
                $tantousya2['datatxt0039']=$mytime;
                $tantousya2['ktanka']=$ktanka;
                $tantousya2['yobi2']=substr($yesterday, 0,8) ;
                $dBefore=$updateBefore;
                $updateBefore = QueryHelper::fetchSingleResult($query);
                $user_id = request('bango');
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 社員マスタ start\n";
                QueryHandler::logger($bango, $log_data);
                $data = [
                    'ztanka' => request('ztanka'),
                    
                    'bango' => trim(request('bango')),
                    'name' => trim(request('name1') . " " . request('name2')),
                    'htanka' => request('htanka'),
                    'datatxt0003' => trim(request('datatxt0003')),
                    'datatxt0004' => trim(request('datatxt0004')),
                    'datatxt0005' => trim(request('datatxt0005')),
                    'syozoku' => trim(request('syozoku')),
                    'passwd' => trim(request('passwd')),
                    'mail4' => trim(request('mail4')),
                    'mail2' => trim(request('mail2')),
                    'mail3' => trim(request('mail3')),
                    'mail' => trim(request('mail')),
                    'datatxt0030' => trim(request('datatxt0030')),
                    'datatxt0031' => trim(request('datatxt0031')),
                    'datatxt0032' => trim(request('datatxt0032')),
                    'datatxt0033' => trim(request('datatxt0033')),
                    'datatxt0034' => trim(request('datatxt0034')),
                    'datatxt0035' => trim(request('datatxt0035')),
                    'datatxt0036' => trim(request('datatxt0036')) . '¶' . trim(request('datatxt0037')),
                    'datatxt0037' => trim(request('recog_dept')),
                    'datatxt0039' => $mytime,
                    'datatxt0029' => $inpemp2 ?  $bango.'¶'.trim($inpemp2) : null,
                    'innerlevel' => trim(request('innerlevel')),
                    'deleteflag' => 0,
                    //'datatxt0039' => $mytime,
                    //   'syounin' => Helper::getSystemIP(),
                    'syounin' => $inpemp4 ? $bango.'¶'.trim($inpemp4) : null,
                    'mail5' => $bango

                ];
                $check=0;
                if ($tantousya2['datatxt0003'] != $data['datatxt0003'] || $tantousya2['datatxt0004'] != $data['datatxt0004'] || $tantousya2['datatxt0005'] != $data['datatxt0005']) {

                    //if (substr($dBefore->datatxt0039, 0,8)!= substr($tantousya2['datatxt0039'], 0,8)) {
                       $check=1;
                    //}
                   $data['yobi1']= substr($mytime, 0,8);
                }
                $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
                pg_query($conn, "BEGIN");

                try {

                    $dataUpdate = QueryHelper::updateData('tantousya', $data, 'bango', $bango, __CLASS__, __FUNCTION__, __LINE__,null,null,null);

                    if ($dataUpdate=='ng') {
                        return 'ng';
                    }
                    if ($check==1) {
                        QueryHelper::insertData('tantousya2', $tantousya2, 'bango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                    }

                    //QueryHelper::insertData('ecsyouhinjyouhou',$result,'syouhinbango',false,$bango,__CLASS__,__FUNCTION__,__LINE__);
                if ($dataUpdate) {
                    if (!file_exists('uploads')) {
                        mkdir('uploads', 0777, true);
                    }
                    if (!file_exists('uploads/employee_master')) {
                        mkdir('uploads/employee_master', 0777, true);
                    }
                    if ($old_inpemp2 != $new_inpemp2) {
                        $file_path = public_path() . '/uploads/employee_master/' . $old_inpemp2;
                        \File::delete($file_path);
                        $file->move(public_path('/uploads/employee_master/'), $bango.'¶'.$file->getClientOriginalName());
                    }
                    if ($old_inpemp4 != $new_inpemp4) {
                        $file_path = public_path() . '/uploads/employee_master/' . $old_inpemp4;
                        \File::delete($file_path);
                        $file2->move(public_path('/uploads/employee_master/'), $bango.'¶'.$file2->getClientOriginalName());
                    }

                  }
                  $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 社員マスタ end\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "COMMIT");
                //return "xx";
                $updateAfter = QueryHelper::fetchSingleResult($query);
                //return "xx";
                $userBango = request('bango');
                $result['change_id'] = $userBango;
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 社員マスタ end\n";
                QueryHandler::logger($bango, $log_data);
                $headers['データ有効区分'] = 'deleteflag';
                CSVLogger::putData('shainMaster.csv', 'tantousya', $updateBefore, $updateAfter, $bangoName, $headers, 2);
                Session::flash('success_msg', '社員CD ' . $userBango . '  変更完了しました。');
                $result['status'] = "ok";

                } catch (Exception $e) {

                    $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                    QueryHandler::logger($bango, $log_data);
                    pg_query($conn, "ROLLBACK");
                    $result['status'] = "ng";
                }

            }

        }
        $result['status'] = "ok";
        return  $result;
    }
}
