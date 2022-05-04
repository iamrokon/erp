<?php

namespace App\AllClass\purchase\paymentDataCreation;

use App\AllClass\db\QueryHandler;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\zenkaku;
use App\Helpers\Helper;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;


class PaymentDataCreation
{
  public static function validate($request)
  {
    $rules = [];
    $rules['payment_deadline'] = ['required','date_format:Y/m/d'];
    $rules['payment_date'] = ['required','date_format:Y/m/d'];
    $rules['voucher_date'] = ['required','date_format:Y/m/d'];
    // dd($request);
    $message = [];
    $message['required'] = '【:attribute】必須項目に入力がありません。';
    $message['date_format'] = '【:attribute】日付が正しくありません。';
    $message['numeric'] = '【:attribute】半角数字以外は使用できません。';

    $attributes = [
      'payment_deadline' => '締切日',
      'payment_date' => '支払日',
      'voucher_date' => '伝票日'
      ];
      
      return Validator::make($request, $rules, $message, $attributes);
    }
    public static function search($request, $bango)
    {
        $requestData = $request;
        foreach ($request as $key => $value) {
            if ($key == 'payment_date') {
                $request[$key] = Helper::replaceSpecificString($value, '/');
            }
        }
        foreach ($request as $key => $value) {
            if ($key == 'payment_deadline') {
                $request[$key] = Helper::replaceSpecificString($value, '/');
            }
        }
        foreach ($request as $key => $value) {
            if ($key == 'voucher_date') {
                $request[$key] = Helper::replaceSpecificString($value, '/');
            }
        }

        $validator = static::validate($requestData);
        $errors = $validator->errors();
        $result = [];
        if ($errors->any()) {
            $result['status'] = 'ng';
            $result['err_msg'] = $errors->all();
            $result['err_field'] = $errors->keys();
        } elseif (!$errors->any() && $request['confirm_status'] == 0) {
            $data = static::searchForData($requestData['payment_deadline'], $requestData['payment_date']);
            $result['status'] = 'confirm';
            $result['data'] = $data;
            return $result;
        }
        //  else if ($request['confirm_status'] == 1 && !$errors->any()) {
            
        //     $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### deposit_input start\n";
        //     QueryHandler::logger($bango, $log_data);
        //     $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
        //     pg_query($conn, "BEGIN");
        //     try {
        //         $creation_category = $request['creation_category'];
        //         $review = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7061'");
        //         $payment_number = self::getPaymentNumber();
        //         $deposit_number = $request['deposit_number'];
        //         $payment_date = $request['payment_date'];
        //         $billing_address = $request['billing_address'];
        //         list($deposit_input, $deposit_input_details) = self::getProcessedRequest();
        //         foreach ($deposit_input_details as $req) {
        //             $payment_method = $req['payment_method'];
        //             $deposit_bank = $req['deposit_bank'];
        //             $deposit_branch = $req['deposit_branch'];
        //             $deposit_amount = Helper::replaceSpecificString($req['deposit_amount'], ',');
        //             $bill_settlement_date = $req['bill_settlement_date'];
        //             $remarks = $req['remarks'];
        //             $serial = $req['serial'];
        //             $eczaikorendou = [
        //                 'sitename' => $payment_number,
        //                 'yukouflag' => $serial,
        //                 'tsuchimail' => '2',
        //                 'rendoumail' => '2',
        //                 'siterank' => null,
        //                 'sitesyubetsu' => null,
        //                 'ftphost' => null,
        //                 'ftpid' => null,
        //                 'ftppw' => null,
        //                 'ftpport' => null,
        //                 'check01' => 0,
        //                 'apichecktime' => now()->format('Y-m-d H:i:s'),
        //                 //'apitime01' => now()->format('Y-m-d H:i:s'),
        //                 'apiid01' => $bango,
        //             ];
        //             QueryHelper::insertData('eczaikorendou', $eczaikorendou, 'sitename', true, $bango, __CLASS__, __FUNCTION__, __LINE__);
        //             $daikinseisan = [
        //                 'shinkurokokyakuname' => $payment_number,
        //                 'shinkurokokyakugroup' => $serial,
        //                 'shinkurokokyakuorderbango' => 0,
        //                 'torikomidate' => Helper::getDBFormattedDate($payment_date),
        //                 'chumonsyaname' => $billing_address,
        //                 'soufusakiname' => $payment_method,
        //                 'soufusakiyubinbango' => $deposit_bank,
        //                 'unsoumei' => $deposit_branch,
        //                 'nyukingaku' => $deposit_amount,
        //                 'unsoudaibikitesuryou' => null,
        //                 'chumondate' => Helper::getDBFormattedDate($bill_settlement_date),
        //                 'toiawasebango' => $remarks,
        //                 'seisanunsoumei' => $bango,
        //                 'dataint02' => intval($creation_category),
        //                 'dataint03' => null,
        //                 'datachar01' => null,
        //                 'datachar02' => null,
        //                 'datachar03' => null,
        //                 'dataint01' => 0,
        //                 'nyukinbi2' => now()->format('Y-m-d H:i:s'),
        //                 //'henpinbi' => now()->format('Y-m-d H:i:s'),
        //                 'henpindenpyobango' => $bango,
        //             ];
        //             QueryHelper::insertData('daikinseisan', $daikinseisan, 'shinkurokokyakuname', true, $bango, __CLASS__, __FUNCTION__, __LINE__);
        //         }

        //         if ($review) {
        //             $update_orderbango = (int)$review->orderbango + 1;
        //             $review_up = [
        //                 'kokyakusyouhinbango' => 'D7061',
        //                 'orderbango' => $update_orderbango,
        //                 'color' => Helper::getCurrentTime(),
        //                 'nickname' => $bango
        //             ];
        //             QueryHelper::updateData('review', $review_up, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
        //         }

        //         $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### deposit_input end\n";
        //         QueryHandler::logger($bango, $log_data);
        //         pg_query($conn, "COMMIT");
        //         session()->flash('success_msg', "入金番号" . $payment_number . "で登録しました。");
        //         $result['status'] = 'ok';
        //     } catch (\Exception $e) {
        //         $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
        //         QueryHandler::logger($bango, $log_data);
        //         pg_query($conn, "ROLLBACK");
        //         session()->flash('success_msg', "something went wrong");
        //         $result['msg'] = $e->getMessage();
        //         $result['status'] = 'not_ok';
        //     }
        // }
        return $result;
    }

    public static function searchForData($searchDate, $checkDate){
        // Carbon::createFromFormat('Y-m-d H:i:s', $request->date)->format('d-m-Y')
        $searchDate1 = Carbon::createFromFormat('Y/m/d', $searchDate)->format('Y-m-d 00:00:00');
        $checkDate = Carbon::createFromFormat('Y/m/d', $checkDate)->format('Y-m-d 00:00:00');
        $szDatas = QueryHelper::fetchResult("select * from shiharaizandaka where sz0001 = '$searchDate'");
        $datas = array_map(function ($item) use($searchDate, $checkDate) {
            list($day, $month) = static::calculateDates($item->sz0002);
            if($day && $month){
                $newYear = (int) substr($searchDate, 0, 4);
                $newMonth = (int) substr($searchDate, 5, 2);
                $newDay =  (int) substr($searchDate, 6, 2);
                $day = (int)substr($day, 2, 4);
                $month = (int)$month;
                $newMonth = $newMonth + $month;
                // $item->day = $day;
                // $item->month = $month;
                $date = static::getCalculatePaymentDate($newMonth, $day, $newYear)->format('Y-m-d 00:00:00');
                $item->newDate = $date;
                if($checkDate == $date){
                    return $item;
                }    
            }
            // return $item;
        }, $szDatas);
        $datas = array_values(array_filter($datas));
        // dd($searchDate, $szDatas, $searchDate1, $datas, gettype($datas));
        return $datas;
    }

    public static function calculateDates($supplierID)
    {
        $yobi12 = substr($supplierID, 0, 6);
        $torihikisakibango = substr($supplierID, 6, 2);
        $haisou = QueryHelper::fetchSingleResult("select * from haisou where shikibetsucode = '$yobi12'  and kounyusu = 0 and torihikisakibango = '$torihikisakibango'");
        $companyData = QueryHelper::fetchSingleResult("select * from kokyaku1 where yobi12 = '$yobi12' and denpyosaiban = 0 ");
        $haisouBango = $haisou->bango ?? null;
        $companyBango = $companyData->bango ?? null;
        $day = null;
        $month = null;
        if ($haisouBango) {
            $other2 = QueryHelper::fetchSingleResult("select * from others2 where otherint1 = '$haisouBango'");
            $other1 = $other2->other1 ?? null;
            if ($other1) {
                if (explode(" ", $other1)[0] == '1') {
                    $haisoujouhou = QueryHelper::fetchSingleResult("select * from haisoujouhou where syukei1 = $companyBango");
                    $day = $haisoujouhou->sex ?? null;
                    $month = $haisoujouhou->mail ?? null;
                    return [$day, $month];
                } elseif (explode(" ", $other1)[0] == '2') {
                    $day = $other2->other21 ?? null;
                    $month = $other2->other20 ?? null;
                    return [$day, $month];
                }
            }
        }
        return [$day, $month];
    }
    public static function getCalculatePaymentDate($saleMonth, $saleDay, $saleYear)
    {
        $currentMonth = $saleMonth > 12 ? 12 : $saleMonth;
        $leftMonth = $saleMonth > 12 ? $saleMonth - 12 : 0;
        $calYear = (int) ceil($leftMonth / 12);
        $calYear = $saleYear + $calYear;
        if (!checkdate($saleMonth, $saleDay, $calYear)) {
            if ($leftMonth) {
                if (!checkdate($leftMonth, $saleDay, $calYear)) {
                    // return $this->calculateDateForInvalidDate($calYear, $leftMonth);
                    $paymentDate = Carbon::createFromDate($calYear,  $leftMonth, 01)->endOfMonth();
                }
                $paymentDate = Carbon::createFromDate($saleYear, $currentMonth, $saleDay)->addMonths($leftMonth);
                // dd($paymentDate);
            } else {
                $paymentDate = Carbon::createFromDate($calYear, $saleMonth, 01)->endOfMonth();
            }
            return $paymentDate;
        }
        return Carbon::createFromDate($saleYear, $currentMonth, $saleDay);
    }
}