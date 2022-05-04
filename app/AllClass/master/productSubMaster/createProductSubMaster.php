<?php

namespace App\AllClass\master\productSubMaster;

use DB;
use App\others;
use \Carbon\Carbon;
use App\tantousya;
use App\AllClass\master\productSubMaster\validateProductSubMaster;
use App\AllClass\master\csvRecordInsert;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use App\AllClass\master\CSVLogger;
use Illuminate\Support\Facades\Input;
use App\Helpers\Helper;
use function Couchbase\defaultDecoder;

class createProductSubMaster
{
    public static function create($request, $bango, $headers, $validate_only = 0)
    {
        $bangoName = tantousya::find($bango)->name;
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

        $validator = validateProductSubMaster::validate($request, $bango);

        $errors = $validator->errors();

        if ($errors->any() || Input::has('field')) {
            return $errors;
        } else {
            if ($validate_only != '1') {
                $mytime = str_replace(":", "", $mytime);
                $mytime = str_replace("-", "", $mytime);
                $mytime = str_replace(" ", "", $mytime);

                $result = array();

                //start log query
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 商品サブマスタ start\n";
                QueryHandler::logger($bango, $log_data);

                $insert_data = [
                    'other1' => $request['other1'],
                    'other2' => $request['other2'],
                    'other3' => $request['other3'],
                    'other4' => $request['other4'],
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
                    //                'other18' => ($request['other18'])?trim($request['other18']):null,
                    'other19' => 0,
                    'other20' => trim($request['other20']),
                    'other21' => trim($request['other21']),
                    'other22' => trim($request['other22']),
                    'other23' => trim($request['other23']),
                    'other24' => trim($request['other24']),
                    'other18' => trim($request['other18']),
                    'other25' => $request['other25'],
                    'other26' => $mytime,
                    // 'other28' => Helper::getSystemIP(),
                    'other29' => $bango
                ];

                $others = QueryHelper::insertData('others', $insert_data, 'other25', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                $data = allOthers::data($bango)->whereRaw("other25 = '" . $others->other25 . "'")->toSql();
                $data = QueryHelper::fetchSingleResult($data);
                $headers['データ有効区分'] = 'other19';
                CSVLogger::putData('productsubMaster.csv', 'others', $data, $data, $bangoName, $headers, 1);

                //end log query
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 商品サブマスタ end\n";
                QueryHandler::logger($bango, $log_data);
            }
            $result['status'] = "ok";
            $result['change_id'] = $request['other25'];
            $result['other2'] = $request['other2'];
            return $result;
        }
    }
}
