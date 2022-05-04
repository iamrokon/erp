<?php

namespace App\AllClass\master\productSubMaster;

use DB;
use App\others;
use \Carbon\Carbon;
use App\tantousya;
use App\AllClass\master\productSubMaster\validateProductSubEditMaster;
use App\AllClass\master\csvRecordEdit;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use App\AllClass\master\CSVLogger;
use Illuminate\Support\Facades\Input;
use App\Helpers\Helper;

class editProductSubMaster
{
    public static function edit($request, $bango, $headers, $validate_only = 0)
    {
        $bangoName = tantousya::find($bango)->name;
        $host = env('DB_HOST');
        $port = env('DB_PORT');
        $dbname = env('DB_DATABASE');
        $user = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $conn = pg_connect(sprintf("host=%s port=%s  dbname=%s user=%s password=%s", $host, $port, $dbname, $user, $password));

        $mytime = Carbon::now()->toDateTimeString();

        foreach ($request as $key => $value) {
            if ($key == '_token' || $key == 'type') {
                unset($request[$key]);
            }
            if ($value == "") {
                $request[$key] = null;
            }
        }
        $request['other15'] = str_replace("/", "", $request['other15']);
        $request['other16'] = str_replace("/", "", $request['other16']);

        // $primaryKey = $request['editId'];
        // $primaryArray = explode('%%', $primaryKey);
        $other25 = trim($request['other25']);
        $validator = validateProductSubEditMaster::validate($request, $bango);

        $errors = $validator->errors();

        if ($errors->any() || Input::has('field')) {
            return $errors;
        } else {
            if ($validate_only != '1') {
                $mytime = str_replace(":", "", $mytime);
                $mytime = str_replace("-", "", $mytime);
                $mytime = str_replace(" ", "", $mytime);

                //start log query
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 商品サブマスタ start\n";
                QueryHandler::logger($bango, $log_data);

                $updateBefore = allOthers::data($bango)->whereRaw("other25 ='" . $other25 . "'")->toSql();
                $updateBefore = QueryHelper::fetchSingleResult($updateBefore);

                //            others::where('other26',$primaryArray[0])
                //                    ->where('other27',!empty($primaryArray[1])?$primaryArray[1]:null)
                //                    ->update([
                $others = [
                    'other5' => trim($request['other5']),
                    'other6' => trim($request['other6']),
                    'other7' => trim($request['other7']),
                    'other8' => trim($request['other8']),
                    'other9' => trim($request['other9']),
                    'other10' => trim($request['other10']),
                    'other11' => trim($request['other11']),
                    'other12' => trim($request['other12']),
                    'other13' => trim($request['other13']),
                    'other14' => $request['other14'],
                    'other15' => trim($request['other15']),
                    'other16' => trim($request['other16']),
                    'other17' => $request['other17'],
                    //               'other18' =>($request['other18'])?trim($request['other18']):null,
                    'other20' => trim($request['other20']),
                    'other21' => trim($request['other21']),
                    'other22' => trim($request['other22']),
                    'other23' => trim($request['other23']),
                    'other24' => trim($request['other24']),
                    'other25' => trim($request['other25']),
                    'other18' => trim($request['other18']),
                    'other19' => 0,
                    'other27' => $mytime,
                    //  'other28' => Helper::getSystemIP(),
                    'other29' => $bango
                ];

                //            $mapData = array_map(function ($item) {
                //                return mb_convert_encoding($item, 'CP51932', 'utf-8');
                //            }, $others);
                //            $data = $mapData;
                $data = $others;
                // $condition = ['other26' => $primaryArray[0], 'other27' => !empty($primaryArray[1]) ? $primaryArray[1] : null];
                // pg_update($conn, 'others', $data, $condition);
                QueryHelper::updateData('others', $data, 'other25', $bango, __CLASS__, __FUNCTION__, __LINE__);
                $updateAfter = allOthers::data($bango)->whereRaw("other25 ='" . $other25 . "'")->toSql();


                $updateAfter = QueryHelper::fetchSingleResult($updateAfter);
                $headers['データ有効区分'] = 'other19';

                CSVLogger::putData('productsubMaster.csv', 'others',  $updateBefore, $updateAfter, $bangoName, $headers, 2);

                //end log query
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 商品サブマスタ end\n";
                QueryHandler::logger($bango, $log_data);
            }
            $result['status'] = "ok";
            $result['change_id'] = $other25;
            $result['other2'] = $request['other2'];

            return $result;
        }
    }
}
