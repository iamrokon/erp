<?php

namespace App\AllClass\purchase\paymentInput;

use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use App\AllClass\master\CSVLogger;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;
use App\tantousya;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Helper;
use Exception;

class PaymentInputDataEntry
{
    public static function create($request, $bango)
    {
        list($orderRequest, $orderDetailRequests) = static::getProcessedRequests();
        $bangoName = tantousya::find($bango)->name;
        foreach ($orderRequest as $key => $value) {
            if ($key == '_token' || $key == 'type') {
                unset($orderRequest[$key]);
            }
            if ($value == "") {
                $orderRequest[$key] = null;
            }
        }
        $orderRequest = (object)$orderRequest;
        $validator = PaymentInputValidation::handle(request()->all());

        $errors = $validator->errors();
        if ($errors->any()) {
            return $errors;
        } elseif (!$errors->any() && $request->confirm_status == 0) {
            $result['status'] = 'confirm';
            return $result;
        } else if ($request->confirm_status == 1 && !$errors->any()) {
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### order_entry start\n";
            QueryHandler::logger($bango, $log_data);
            $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
            pg_query($conn, "BEGIN");
            try {
                $syouhinid = static::getSyouhinId();
                // dd($syouhinid);
                
                $nyuko = [
                    'syouhinid' =>  $syouhinid ?? null,
                    'denpyohakkoubi' => $orderRequest->payment_date ?? null,
                    'kaiinid' => $orderRequest->supplier ?? null,
                    'denpyobango' => 0,
                    // 'yoteibi' => static::getCurrentTime(),
                    'yoteibi' => Carbon::now()->format('Y-m-d H:i:s'),
                    'tantousyabango' => $bango,
                    'kingaku' => static::stringDataConvertedToIntegerFormat($orderRequest->total_amount, 'comma')?? null,
                    'season' => $orderRequest->payment_classification ?? null,
                    'yoyakubi' => $orderRequest->slip_date ?? null,       
                ];
                $nyuko = QueryHelper::insertData('nyuko', $nyuko, 'syouhinid', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                // after create orderhenkan
                $hikiatenyuko = [
                    'syouhinid' => $nyuko->syouhinid ?? null,
                    'syouhinsyu' => 2,
                    'hantei' => 2,
                    'dataint02' => 2, 
                    'yoteimeter' => 0,
                    // 'denpyoshimebi' => Carbon::now()->format('Y-m-d H:i:s'),
                    'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'),
                    'tantousyabango' => $bango
                ];
                QueryHelper::insertData('hikiatenyuko', $hikiatenyuko, 'syouhinid', false, $bango, __CLASS__, __FUNCTION__, __LINE__);
                foreach ($orderDetailRequests as $request) {
                    $request = (object)$request;
                    $hikiatesyukko2 = [
                        'orderbango' => null,
                        'syouhinid' => $syouhinid ?? null,
                        'syouhinsyu' => $request->line ?? null,
                        'syouhizeiritu' => static::stringDataConvertedToIntegerFormat($request->payment_amount, 'comma') ?? null,
                        'datachar01' => $request->payment_method ?? null,
                        'datachar02' => $request->bank ?? null,
                        'datachar03' => $request->branch_store ?? null,                       
                        'datachar11' => $request->remarks ?? null,                       
                        'denpyobango' => 0,
                        'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'),
                        'tantousyabango' => $bango,
                        'kanryoubi' => $request->due_date ?? null,
                    ];
                    $hikiatesyukko2 = QueryHelper::insertDataWithNullField('hikiatesyukko2', $hikiatesyukko2, 'syouhinid', false, $bango, __CLASS__, __FUNCTION__, __LINE__);                   
                }
                $review = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7071'");
                $orderBango = $review->orderbango;
                $orderBango = (int)$orderBango + 1;
                $review = [
                    'kokyakusyouhinbango' => 'D7071',
                    'orderbango' => $orderBango,
                    'jouhou' => static::getCurrentTime(),
                    'color' => static::getCurrentTime(),
                    'size' => request()->ip(),
                    'nickname' => $bango,
                ];
                QueryHelper::updateData('review', $review, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);

                $result['status'] = 'ok';
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### order_entry end\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "COMMIT");
                session()->flash('success_msg', "支払番号" . $syouhinid . "で登録しました。");
                $session_order_bango = $nyuko->syouhinid;
                $result['session_order_bango'] = $session_order_bango;
                $result['session_company_code'] = $orderRequest->supplier;
            }catch (\Exception $e) {
                // dd($e);
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "ROLLBACK");
                session()->flash('success_msg', "something" . $syouhinid . "went wrong");
                $result['status'] = 'ng';
                $result['exception'] = $e->getMessage();
            }
            return $result;
        }
    }
    public static function stringDataConvertedToIntegerFormat($value, $type = null)
    {
        $indicator = $type ? "," : "/";
        if (mb_strpos($value, $indicator)) {
            return str_replace($indicator, "", $value);
        }

        return $value;
    }

    public static function getSyouhinId()
    {
        $kokyakubango1stPart = "19";
        $kokyakubango2ndPart = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7501' ")->orderbango ?? null;
        $repeat = QueryHelper::fetchSingleResult("select review.mobile_flag from review where kokyakusyouhinbango = 'D7071' ")->mobile_flag ?? null;
        $kokyakubango3rdPart = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7071' ")->orderbango ?? null;
        $kokyakubango3rdPart = (int)$kokyakubango3rdPart + 1;
        $kokyakubango3rdPart = sprintf('%0' . $repeat . 'd', $kokyakubango3rdPart);
        return $kokyakubango1stPart . '' . $kokyakubango2ndPart . '' . $kokyakubango3rdPart;
    }

    public static function getProcessedRequests()
    {
        $orderDetailRequestInput = ['line', 'payment_method', 'bank', 'branch_store', 'payment_amount', 'due_date', 'remarks'];
        $orderRequest = request()->except($orderDetailRequestInput);
        $orderDetailRequests = request()->only($orderDetailRequestInput);
        try {
            if (count($orderDetailRequests['line']) > 1) {
                foreach ($orderDetailRequests as $key => $value) {
                    foreach ($value as $newKey => $val) {
                        if ($key == 'line') {
                            if (!$value[$newKey]) {
                                foreach ($orderDetailRequestInput as $rkey) {
                                    unset($orderDetailRequests[$rkey][$newKey]);
                                }
                            }
                        }
                    }
                }
            }
            $orderDetailRequests = static::formatMulDimForm($orderDetailRequests);
        } catch (\Exception $e) {
            dd($e, $orderDetailRequests);
        }
        return [$orderRequest, $orderDetailRequests];
    }

    public static function convertNumberToString($digits, $type = null)
    {
        if ($digits) {
            $key = $type ? $type : 'r17_3cd';
            return QueryHelper::fetchSingleResult("select  $key from v_torihikisaki where torihikisaki_cd  = '$digits'")->$key ?? "";
        }
        return '';
    }
    public static function formatMulDimForm($rows): array
    {
        if (!count($rows)) {
            return [];
        }
        $data = [];
        $keys = collect($rows)->keys()->toArray();
        $iters = $rows[$keys[0]];
        foreach ($iters as $idx => $iter) {
            foreach ($keys as $key) {
                $data[$idx][$key] = $rows[$key][$idx];
            }
        }
        return $data;
    }
    public static function getCurrentTime()
    {
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        return str_replace(" ", "", $mytime);
    }
    public static function getEmployeeId($name){
        if($name){
            $employeId = QueryHelper::fetchSingleResult("select bango from tantousya where name = '$name' ")->bango ?? "";
            return $employeId;
        }
        return "";
    }
}