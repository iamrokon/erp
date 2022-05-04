<?php

namespace App\AllClass\master\employeeMaster;


use App\AllClass\db\QueryHandler;
use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\master\CSVLogger;
use DB;
use App\tantousya;
use \Carbon\Carbon;
use App\AllClass\master\csvRecordInsert;
use App\AllClass\master\employeeMaster\validateEmployeeMaster;
use App\AllClass\master\employeeMaster\allTantousya;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;
use App\Helpers\Helper;

class createEmployeeMaster
{

    public static function create($request, $bango, $headers, $validate_only = 0)
    {
        $t = date("Y-m-d H:i:s");
        $file_test = fopen('insert_e.txt','a');
        fwrite($file_test,"initial\n".$t."\n");
        fclose($file_test);

        $mytime = Carbon::now()->toDateTimeString();
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
        $t = date("Y-m-d H:i:s");
        $file_test = fopen('insert_e.txt','a');
        fwrite($file_test,"before validation\n".$t."\n");
        fclose($file_test);
        $validator = validateEmployeeMaster::validate($request, $bango);
        $errors = $validator->errors();
        $t = date("Y-m-d H:i:s");
        $file_test = fopen('insert_e.txt','a');
        fwrite($file_test,"after validation\n".$t."\n");
        fclose($file_test);
        if ($errors->any() || Input::has('field')) {
            return $errors;
        } else {
            if ($validate_only != '1') {
                $mytime = str_replace(":", "", $mytime);
                $mytime = str_replace("-", "", $mytime);
                $mytime = str_replace(" ", "", $mytime);
                /*$p= $request['passwd'];
                $x= uniqid(rand());
                $x= substr($x,0,5);
                $passwd =  substr(($x.md5($x.$p)),0,32);
               */
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 社員マスタ start\n";
                QueryHandler::logger($bango, $log_data);
                $result = [
                    'ztanka' => request('ztanka'),
                    'bango' => trim(sprintf("%04d", request('bango'))),
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
                    'yobi1'=> substr($mytime, 0,8),
                    'datatxt0030' => trim(request('datatxt0030')),
                    'datatxt0031' => trim(request('datatxt0031')),
                    'datatxt0032' => trim(request('datatxt0032')),
                    'datatxt0033' => trim(request('datatxt0033')),
                    'datatxt0034' => trim(request('datatxt0034')),
                    'datatxt0035' => trim(request('datatxt0035')),
                    'datatxt0036' => trim(request('datatxt0036')) . '¶' . trim(request('datatxt0037')),
                    'datatxt0037' => trim(request('recog_dept')),
                    'datatxt0029' => request('inpemp1') ? $bango.'¶'.trim(request('inpemp1')) : null,
                    'innerlevel' => trim(request('innerlevel')),
                    'deleteflag' => 0,
                    'datatxt0038' => $mytime,
                    // 'syounin' => Helper::getSystemIP(),
                    'syounin' => request('inpemp3') ? $bango.'¶'.trim(request('inpemp3')) : null,
                    'mail5' => $bango
                ];

                $user = QueryHelper::insertData('tantousya', $result, 'bango', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
        $t = date("Y-m-d H:i:s");
        $file_test = fopen('insert_e.txt','a');
        fwrite($file_test,"after insert\n".$t."\n");
        fclose($file_test);
                if ($user) {
                    if (!file_exists('uploads')) {
                        mkdir('uploads', 0777, true);
                    }
                    if (!file_exists('uploads/employee_master')) {
                        mkdir('uploads/employee_master', 0777, true);
                    }
                    if ($file != "") {
                        $file->move(public_path('uploads/employee_master'),$bango.'¶'. $file->getClientOriginalName());
                    }
                    if ($file2 != "") {
                        $file2->move(public_path('uploads/employee_master'),$bango.'¶'. $file2->getClientOriginalName());
                    }

                    if (strlen($user->bango) < 4) {
                        $userBango = sprintf("%04d", $user->bango);
                    } else {
                        $userBango = $user->bango;
                    }
                }
                $result['change_id'] = $userBango;
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 社員マスタ end\n";
                QueryHandler::logger($bango, $log_data);
                $query = allTantousya::data($bango, 0, $userBango);
                $data = QueryHelper::fetchSingleResult($query);
                $headers['データ有効区分'] = 'deleteflag';
                CSVLogger::putData('shainMaster.csv', 'tantousya', $data, $data, $bangoName, $headers, 1);
            }
            $result['status'] = "ok";
            return $result;
        }
    }
}
