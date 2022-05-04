<?php


namespace App\AllClass\sales\DepositInput;

use App\AllClass\db\QueryHandler;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\zenkaku;
use App\Helpers\Helper;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;


class DepositInput
{
    public static function validate($request)
    {
        $rules = [];
        if ($request['creation_category'] == '2 訂正') {
            $rules['deposit_number'] = ['required', 'regex:/^[0-9]+$/', 'max:10', new CheckEczaikorendou];
            $rules['billing_address'] = ['required'];
            $rules['payment_date'] = ['required', new CheckPaymentDate];
        } else {
            $rules['billing_address'] = ['required'];
            $rules['payment_date'] = ['required', new CheckPaymentDate];
        }

        $rules['payment_method.*'] = ['required'];
        $rules['deposit_bank.*'] = [new CheckForPaymentMethodValue];
        $rules['deposit_branch.*'] = [new CheckForPaymentMethodValue];
        $rules['deposit_amount.*'] = ['required', 'numeric', 'max:999999999', new CheckValueNotEqualToZero];
        $rules['bill_settlement_date.*'] = [new CheckForPaymentMethodValue];
        $rules['remarks.*'] = ['nullable', 'max:40', new CheckDoubleByte];

        $message = [];
        $message['required'] = '【:attribute】必須項目に入力がありません。';
        $message['deposit_amount.*.max'] = '【:attribute】9桁以下で入力してください。';
        $message['remarks.*.max'] = '【:attribute】:max桁以下で入力してください。';
        $message['numeric'] = '【:attribute】半角数字以外は使用できません。';



        $attributes = [
            'deposit_number' => '入金番号',
            'payment_date' => '入金日',
            'billing_address' => '売上請求先',
            'payment_method.*' => '入金方法',
            'deposit_bank.*' => '入金銀行',
            'deposit_branch.*' => '入金支店',
            'deposit_amount.*' => '入金金額',
            'bill_settlement_date.*' => '手形決済日',
            'remarks.*' => '備考'
        ];

        return Validator::make($request, $rules, $message, $attributes);
    }

    public static function create($request, $bango)
    {
        foreach ($request as $key => $value) {
            if ($key == 'payment_date') {
                $request[$key] = Helper::replaceSpecificString($value, '/');
            }
        }
        foreach ($request as $key => $value) {
            if ($key == 'bill_settlement_date') {
                foreach ($value as $newKey => $val) {
                    $request[$key][$newKey] = Helper::replaceSpecificString($val, '/');
                }
            }
            if ($key == 'deposit_amount') {
                foreach ($value as $newKey => $val) {
                    $request[$key][$newKey] = Helper::replaceSpecificString($val, ',');
                }
            }
        }

        $validator = static::validate($request);
        $errors = $validator->errors();
        $result = [];
        if ($errors->any()) {
            $result['status'] = 'ng';
            $result['err_msg'] = $errors->all();
            $result['err_field'] = $errors->keys();
        } elseif (!$errors->any() && $request['confirm_status'] == 0) {
            $result['status'] = 'confirm';
            return $result;
        } else if ($request['confirm_status'] == 1 && !$errors->any()) {
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### deposit_input start\n";
            QueryHandler::logger($bango, $log_data);
            $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
            pg_query($conn, "BEGIN");
            try {
                $creation_category = $request['creation_category'];
                $review = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7061'");
                $payment_number = self::getPaymentNumber();
                $deposit_number = $request['deposit_number'];
                $payment_date = $request['payment_date'];
                $billing_address = $request['billing_address'];
                list($deposit_input, $deposit_input_details) = self::getProcessedRequest();
                foreach ($deposit_input_details as $req) {
                    $payment_method = $req['payment_method'];
                    $deposit_bank = $req['deposit_bank'];
                    $deposit_branch = $req['deposit_branch'];
                    $deposit_amount = Helper::replaceSpecificString($req['deposit_amount'], ',');
                    $bill_settlement_date = $req['bill_settlement_date'];
                    $remarks = $req['remarks'];
                    $serial = $req['serial'];
                    $eczaikorendou = [
                        'sitename' => $payment_number,
                        'yukouflag' => $serial,
                        'tsuchimail' => '2',
                        'rendoumail' => '2',
                        'siterank' => null,
                        'sitesyubetsu' => null,
                        'ftphost' => null,
                        'ftpid' => null,
                        'ftppw' => null,
                        'ftpport' => null,
                        'check01' => 0,
                        'apichecktime' => now()->format('Y-m-d H:i:s'),
                        //'apitime01' => now()->format('Y-m-d H:i:s'),
                        'apiid01' => $bango,
                    ];
                    QueryHelper::insertData('eczaikorendou', $eczaikorendou, 'sitename', true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                    $daikinseisan = [
                        'shinkurokokyakuname' => $payment_number,
                        'shinkurokokyakugroup' => $serial,
                        'shinkurokokyakuorderbango' => 0,
                        'torikomidate' => Helper::getDBFormattedDate($payment_date),
                        'chumonsyaname' => $billing_address,
                        'soufusakiname' => $payment_method,
                        'soufusakiyubinbango' => $deposit_bank,
                        'unsoumei' => $deposit_branch,
                        'nyukingaku' => $deposit_amount,
                        'unsoudaibikitesuryou' => null,
                        'chumondate' => Helper::getDBFormattedDate($bill_settlement_date),
                        'toiawasebango' => $remarks,
                        'seisanunsoumei' => $bango,
                        'dataint02' => intval($creation_category),
                        'dataint03' => null,
                        'datachar01' => null,
                        'datachar02' => null,
                        'datachar03' => null,
                        'dataint01' => 0,
                        'nyukinbi2' => now()->format('Y-m-d H:i:s'),
                        //'henpinbi' => now()->format('Y-m-d H:i:s'),
                        'henpindenpyobango' => $bango,
                    ];
                    QueryHelper::insertData('daikinseisan', $daikinseisan, 'shinkurokokyakuname', true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                }

                if ($review) {
                    $update_orderbango = (int)$review->orderbango + 1;
                    $review_up = [
                        'kokyakusyouhinbango' => 'D7061',
                        'orderbango' => $update_orderbango,
                        'color' => Helper::getCurrentTime(),
                        'nickname' => $bango
                    ];
                    QueryHelper::updateData('review', $review_up, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                }

                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### deposit_input end\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "COMMIT");
                session()->flash('success_msg', "入金番号" . $payment_number . "で登録しました。");
                $result['status'] = 'ok';
            } catch (\Exception $e) {
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "ROLLBACK");
                session()->flash('success_msg', "something went wrong");
                $result['msg'] = $e->getMessage();
                $result['status'] = 'not_ok';
            }
        }
        return $result;
    }

    public static function edit($request, $bango)
    {
        foreach ($request as $key => $value) {
            if ($key == 'payment_date') {
                $request[$key] = Helper::replaceSpecificString($value, '/');
            }
        }
        foreach ($request as $key => $value) {
            if ($key == 'bill_settlement_date') {
                foreach ($value as $newKey => $val) {
                    $request[$key][$newKey] = Helper::replaceSpecificString($val, '/');
                }
            }
            if ($key == 'deposit_amount') {
                foreach ($value as $newKey => $val) {
                    $request[$key][$newKey] = Helper::replaceSpecificString($val, ',');
                }
            }
        }
        $payment_number = $request['deposit_number'];
        $serial=$request['serial'][0];
        $checkDaikinseisanShinkurokokyakuorderbango = QueryHelper::fetchSingleResult("select shinkurokokyakuorderbango from daikinseisan where shinkurokokyakuname = '$payment_number' and shinkurokokyakugroup = '$serial' and dataint01 = 0");
//        dd(count($checkDaikinseisanShinkurokokyakuorderbango),$payment_number,$serial,$payment_number!=null);
        if ($payment_number!=null && $serial!=null){
            if ($checkDaikinseisanShinkurokokyakuorderbango->shinkurokokyakuorderbango >=89){
                $result['status'] = 'error90';
                return $result;
            }
        }

        $validator = static::validate($request);
        $errors = $validator->errors();
        $result = [];
        if ($errors->any()) {
            $result['status'] = 'ng';
            $result['err_msg'] = $errors->all();
            $result['err_field'] = $errors->keys();
        } elseif (!$errors->any() && $request['confirm_status'] == 0) {
            $result['status'] = 'confirm';
            return $result;
        } else if ($request['confirm_status'] == 1 && !$errors->any()) {
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### deposit_input start\n";
            QueryHandler::logger($bango, $log_data);
            $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
            pg_query($conn, "BEGIN");
            try {

                $creation_category = $request['creation_category'];
                //                $review = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7061'");
                $payment_number = $request['deposit_number'];
                static::deleteLine($payment_number, request('deleteLine'), $bango);
                $payment_date = $request['payment_date'];
                $billing_address = $request['billing_address'];
                list($deposit_input, $deposit_input_details) = self::getProcessedRequest();
                $shinkurokokyakuorderbango = self::getshinkurokokyakuorderbango($payment_number);
//                dd($deposit_input_details);
                foreach ($deposit_input_details as $req) {
                    $payment_method = $req['payment_method'];
                    $deposit_bank = $req['deposit_bank'];
                    $deposit_branch = $req['deposit_branch'];
                    $deposit_amount = Helper::replaceSpecificString($req['deposit_amount'], ',');
                    $bill_settlement_date = $req['bill_settlement_date'];
                    $remarks = $req['remarks'];
                    $serial = $req['serial'];
                    $daikinseisan = [
                        'shinkurokokyakuname' => $payment_number,
                        'shinkurokokyakugroup' => $serial,
                        'shinkurokokyakuorderbango' => $shinkurokokyakuorderbango,
                        'torikomidate' => Helper::getDBFormattedDate($payment_date),
                        'chumonsyaname' => $billing_address,
                        'soufusakiname' => $payment_method,
                        'soufusakiyubinbango' => $deposit_bank,
                        'unsoumei' => $deposit_branch,
                        'nyukingaku' => $deposit_amount,
                        'unsoudaibikitesuryou' => null,
                        'chumondate' => Helper::getDBFormattedDate($bill_settlement_date),
                        'toiawasebango' => $remarks,
                        'seisanunsoumei' => $bango,
                        'dataint02' => intval($creation_category),
                        'dataint03' => null,
                        'datachar01' => null,
                        'datachar02' => null,
                        'datachar03' => null,
                        'dataint01' => 0,
                        // 'nyukinbi2' => now()->format('Y-m-d H:i:s'),
                        // 'henpinbi' => now()->format('Y-m-d H:i:s'),
                        'henpindenpyobango' => $bango,
                    ];
                    $eczaikorendou = [
                        'sitename' => $payment_number,
                        'yukouflag' => $serial,
                        'tsuchimail' => '2',
                        'rendoumail' => '2',
                        'siterank' => null,
                        'sitesyubetsu' => null,
                        'ftphost' => null,
                        'ftpid' => null,
                        'ftppw' => null,
                        'ftpport' => null,
                        'check01' => 0,
                        //'apichecktime' => now()->format('Y-m-d H:i:s'),
                        //'apitime01' => now()->format('Y-m-d H:i:s'),
                        'apiid01' => $bango,
                    ];
                    $isExistsDaikinseisan = QueryHelper::fetchSingleResult("select count(shinkurokokyakuname) from daikinseisan where shinkurokokyakuname = '$payment_number' and shinkurokokyakugroup = '$serial' and dataint01 = 0")->count ?? null;
                    if ($isExistsDaikinseisan) {
                        $daikinseisan['henpinbi'] = now()->format('Y-m-d H:i:s');
                        $eczaikorendou['apitime01'] = now()->format('Y-m-d H:i:s');
                        QueryHelper::updateData('daikinseisan', $daikinseisan, ['shinkurokokyakuname' => $payment_number, 'shinkurokokyakugroup' => $serial, 'dataint01' => 0], $bango, __CLASS__, __FUNCTION__, __LINE__);
                        QueryHelper::updateData('eczaikorendou', $eczaikorendou, ['sitename' => $payment_number, 'yukouflag' => $serial], $bango, __CLASS__, __FUNCTION__, __LINE__);
                    } else {
                        $daikinseisan['nyukinbi2'] = now()->format('Y-m-d H:i:s');
                        $eczaikorendou['apichecktime'] = now()->format('Y-m-d H:i:s');
                        QueryHelper::insertData('daikinseisan', $daikinseisan, 'shinkurokokyakuname', true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                        QueryHelper::insertData('eczaikorendou', $eczaikorendou, 'sitename', true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                    }
                }
                self::updateSerialForDeletedData($payment_number, $shinkurokokyakuorderbango, $bango);

                //                if ($review) {
                //                    $update_orderbango = (int)$review->orderbango + 1;
                //                    $review_up = [
                //                        'kokyakusyouhinbango' => 'D7061',
                //                        'orderbango' => $update_orderbango,
                //                        'mobile_flag' => null,
                //                        'check_flag' => null,
                //                        'jouhou' => null,
                //                        'color' => Helper::getCurrentTime(),
                //                        'nickname' => $bango
                //                    ];
                //                    QueryHelper::updateData('review', $review_up, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                //                }

                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### deposit_input end\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "COMMIT");
                session()->flash('success_msg', "入金番号" . $payment_number . "で登録しました。");
                $result['status'] = 'ok';
            } catch (\Exception $e) {
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "ROLLBACK");
                session()->flash('success_msg', "something" . $request['deposit_number'] . "went wrong");
                $result['status'] = 'not_ok';
                $result['msg'] = $e->getMessage();
            }
        }
        return $result;
    }

    public static function getProcessedRequest()
    {
        $input_element = ['payment_method', 'deposit_bank', 'deposit_branch', 'deposit_amount', 'remarks', 'bill_settlement_date', 'serial'];
        $deposit_input = request()->except($input_element);
        $deposit_input_details = request()->only($input_element);
        $deposit_input_details = Helper::formatMulDimForm($deposit_input_details);
        return [$deposit_input, $deposit_input_details];
    }

    public static function getPaymentNumber()
    {
        $kokyakubango1stPart = "18";
        $kokyakubango2ndPart = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7501' ")->orderbango ?? null;
        $repeat = QueryHelper::fetchSingleResult("select review.mobile_flag from review where kokyakusyouhinbango = 'D7061' ")->mobile_flag;
        $kokyakubango3rdPart = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7061' ")->orderbango ?? null;
        $kokyakubango3rdPart = (int)$kokyakubango3rdPart + 1;
        if ($repeat!=null && $repeat>strlen($kokyakubango3rdPart)){
            $kokyakubango3rdPart = sprintf('%0' . $repeat . 'd', $kokyakubango3rdPart);
        }
//        dd(strlen((string)$kokyakubango3rdPart),(string)$kokyakubango3rdPart,$repeat,$kokyakubango1stPart . '' . $kokyakubango2ndPart . '' . $kokyakubango3rdPart);
        return $kokyakubango1stPart . '' . $kokyakubango2ndPart . '' . $kokyakubango3rdPart;
    }

    public static function getshinkurokokyakuorderbango($payment_number)
    {
        $shinkurokokyakuorderbango = QueryHelper::fetchSingleResult("select max(shinkurokokyakuorderbango) as count from daikinseisan where shinkurokokyakuname = '$payment_number'  and dataint01 = 0 ")->count ?? 0;
        return (int)$shinkurokokyakuorderbango + 1;
    }

    public static function getCategoriesKey($billing_address)
    {
        $yobi12 = substr($billing_address, 0, 6);
        $torihikisakibango = substr($billing_address, 6, 2);
        $haisoubango = QueryHelper::fetchSingleResult("select bango from haisou where torihikisakibango = '$torihikisakibango' and shikibetsucode = '$yobi12'  ")->bango ?? null;
        $result = [];
        if ($haisoubango) {
            $other = QueryHelper::fetchSingleResult("select * from others2 where otherint1 = $haisoubango");
            $other1 = $other->other1 ?? null;
            if ($other1) {
                $other1 = substr($other1, 0, 1);
                if ($other1 == '1') {
                    $kokyakubango = QueryHelper::fetchSingleResult("select bango,yobi12,denpyosaiban from kokyaku1 where yobi12 = '$yobi12'")->bango ?? null;
                    if ($kokyakubango) {
                        $query = QueryHelper::fetchSingleResult("select syukeiki,datatxt0053,syukeikikijun,haisoujouhou from haisoujouhou where syukei1 = $kokyakubango");
                        $result['deposit_bank'] = $query->syukeiki ?? null;
                        $result['deposit_branch'] = $query->datatxt0053 ?? null;
                        $is_showed =  $query->syukeikikijun ?? null;
                        $is_showed = $is_showed ? substr($is_showed, 0, 1) : null;
                        $result['val'] = $is_showed;
                        $result['showed'] = $is_showed == 2 ? true : false;
                        return $result;
                    }
                } elseif ($other1 == '2') {
                    $result['deposit_bank'] = $other->other31 ?? null;
                    $result['deposit_branch'] = $other->other32 ?? null;
                    $is_showed = QueryHelper::fetchSingleResult("select syukeiki from haisou where bango = $haisoubango")->syukeiki ?? null;
                    $is_showed = $is_showed ? substr($is_showed, 0, 1) : null;
                    $result['val'] = $is_showed;
                    $result['showed'] = $is_showed == 2 ? true : false;
                    return $result;
                }
            }
            return $result;
        }
        return $result;
    }

    public static function deleteLine($payment_number, $serials, $bango)
    {
        $serials = json_decode($serials) ?? [];
        $shinkurokokyakuorderbango = self::getshinkurokokyakuorderbango($payment_number);
        foreach ($serials as $serial) {
            $data = [
                'shinkurokokyakuname' => $payment_number,
                'shinkurokokyakugroup' => $serial,
                'dataint01' => 2,
                'dataint02' => 2,
                'shinkurokokyakuorderbango' => $shinkurokokyakuorderbango,
                'henpinbi' => now()->format('Y-m-d H:i:s')
            ];
            $condition = [
                'shinkurokokyakuname' => $payment_number,
                'shinkurokokyakugroup' => $serial,
                'dataint01' => 0
            ];
            QueryHelper::updateData('daikinseisan', $data, $condition, $bango, __CLASS__, __FUNCTION__, __LINE__);
        }
    }

    public static function updateSerialForDeletedData($payment_number, $shinkurokokyakuorderbango, $bango)
    {
        $datas = QueryHelper::fetchResult("select * from daikinseisan where shinkurokokyakuname = '$payment_number' and  dataint01 = 2");
        if ($datas) {
            foreach ($datas as $data) {
                $daikinseisan = [
                    'shinkurokokyakuname' => $payment_number,
                    'shinkurokokyakugroup' => $data->shinkurokokyakugroup,
                    'shinkurokokyakuorderbango' => $shinkurokokyakuorderbango,
                    'dataint01' => 2
                ];
                QueryHelper::updateData('daikinseisan', $daikinseisan, ['shinkurokokyakuname' => $payment_number, 'shinkurokokyakugroup' => $data->shinkurokokyakugroup, 'dataint01' => 2], $bango, __CLASS__, __FUNCTION__, __LINE__);
            }
        }
    }

    public static function checkForRendoMail($sitename)
    {
        $rendomails = QueryHelper::fetchResult("select rendoumail from eczaikorendou where sitename = '$sitename'");
        $storeRendomail = [];
        foreach ($rendomails as  $rendomail) {
            array_push($storeRendomail, $rendomail->rendoumail);
        }
        return in_array('1', $storeRendomail);
    }
}
