<?php


namespace App\AllClass\purchase\purchaseSlip;

use App\AllClass\db\QueryHandler;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\zenkaku;
use App\Helpers\Helper;
use Illuminate\Support\Carbon;


class HolidayCalculation
{
    public static function getExactDate($company_data, $date, $bango)
    {
        
        $salesDate = strpos($date, '/') ? str_replace('/', '', $date) : $date;
        $billingDestination = strpos($company_data, '/') ? str_replace('/', '', $company_data) : $company_data;
        list($day, $month, $isForward, $addDayForSystemDate) = static::calculateBillingDates($billingDestination);
        if ($month !== null && $day !== null && $isForward !== null) {
            $isForward = $isForward == '1 翌営業日' ? true : false;
            $saleYear = (int) substr($salesDate, 0, 4);
            $saleMonth = (int) substr($salesDate, 4, 2);
            $saleDay =  (int) substr($salesDate, 6, 2);
            $saleDate = Carbon::createFromDate($saleYear, $saleMonth, $saleDay);
            $saleMonth += $month;
            $paymentDate = self::getCalculatePaymentDate($saleMonth, $day, $saleYear);
            //dd($paymentDate, $saleMonth, $day, $saleYear, $paymentDate instanceof Carbon);
            if ($paymentDate instanceof Carbon) {
                $paymentDate = self::calculateDateHolidayWise($paymentDate, $isForward);
                //dd($salesDate, $paymentDate);
                $paymentDate = Carbon::parse($paymentDate)->format("Ymd");
            } else {
                $paymentDate = Carbon::parse($paymentDate)->format("Ymd");
            }
            return $paymentDate;
        } else {
            return $salesDate;
        }
    }
    
    public static function calculateBillingDates($billingDestination)
    {
        $yobi12 = substr($billingDestination, 0, 6);
        $torihikisakibango = substr($billingDestination, 6, 2);
        $haisou = QueryHelper::fetchSingleResult("select * from haisou where shikibetsucode = '$yobi12'  and kounyusu = 0 and torihikisakibango = '$torihikisakibango'");
        $companyData = QueryHelper::fetchSingleResult("select * from kokyaku1 where yobi12 = '$yobi12' and denpyosaiban = 0 ");
        $haisoujouhou = QueryHelper::select(['bunrui4,bunrui5,mail,sex,bunrui1'])->from('haisoujouhou')->where("syukei1 = '$companyData->bango' ")->get()->first();
        $haisouBango = $haisou->bango ?? null;
        $day = null;
        $month = null;
        $isForward = null;
        $addDayForSystemDate = null;
        //dd($billingDestination);
        if ($haisouBango) {
            $other2 = QueryHelper::fetchSingleResult("select * from others2 where otherint1 = '$haisouBango'");
            $other1 = $other2->other1 ?? null;
            if ($other1) {
                if (explode(" ", $other1)[0] == '1') {
                    $month = !is_null($haisoujouhou->mail) ? (int)$haisoujouhou->mail : null;
                    $sex_data = $haisoujouhou->sex ?? null;
                    $day = substr($sex_data,2,2) ?? null;
                    $isForward = $haisoujouhou->bunrui1 ? $haisoujouhou->bunrui1 : null;
                    $addDayForSystemDate = null;
                    return [$day, $month, $isForward, $addDayForSystemDate];
                } elseif (explode(" ", $other1)[0] == '2') {
                    //$month = !is_null($other2[0]->other20) ? (int) $other2[0]->other20 : null;
                    $month = !is_null($other2->other20) ? (int) $other2->other20 : null;
                    //$other21_data = $other2[0]->other21 ?? null;
                    $other21_data = $other2->other21 ?? null;
                    $day = substr($other21_data,2,2) ?? null;
                    //$isForward = $other2[0]->other22 ? $other2[0]->other22 : null;
                    $isForward = $other2->other22 ? $other2->other22 : null;
                    $addDayForSystemDate = null;
                }
            }
        }
        return [$day, $month, $isForward, $addDayForSystemDate];
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
                    return self::calculateDateForInvalidDate($calYear, $leftMonth);
                }
                $paymentDate = Carbon::createFromDate($saleYear, $currentMonth, $saleDay)->addMonths($leftMonth);
            } else {
                $paymentDate = Carbon::createFromDate($calYear, $saleMonth, 01)->endOfMonth();
            }
            $paymentDate = self::excludeSaturdayAndSunday($paymentDate);
            return str_replace('-', '', $paymentDate->toDateString());
        }
        return Carbon::createFromDate($saleYear, $currentMonth, $saleDay);
    }

    public static function calculateDateHolidayWise(Carbon $paymentDate, bool $isForward = false): Carbon
    {
        $paymentDate = self::excludeSaturdayAndSunday($paymentDate, $isForward);
        if (($paymentDate->month == 12 and $paymentDate->day == 31) or ($paymentDate->month == 1 and $paymentDate->day == 1) or ($paymentDate->month == 1 and $paymentDate->day == 2) or ($paymentDate->month == 1 and $paymentDate->day == 3)) {
            if ($isForward) {
                $modifiedDate = Carbon::createFromDate($paymentDate->year + 1, 1, 4);
            } else {
                if ($paymentDate->month == 12) {
                    $modifiedDate = Carbon::createFromDate($paymentDate->year, 12, 30);
                } else {
                    $modifiedDate = Carbon::createFromDate($paymentDate->year - 1, 12, 30);
                }
            }
            $paymentDate = self::excludeSaturdayAndSunday($modifiedDate, $isForward);
        }
        return $paymentDate;
    }
    
    public static function calculateDateForInvalidDate(int $currYear, int $currMonth): string
    {
        $paymentDate = Carbon::createFromDate($currYear, $currMonth, 01)->endOfMonth();
        $paymentDate = self::excludeSaturdayAndSunday($paymentDate);
        return str_replace('-', '', $paymentDate->toDateString());
    }

    public static function excludeSaturdayAndSunday(Carbon $paymentDate, bool $isForward = false): Carbon
    {
        if ($paymentDate->isSaturday()) {
            $paymentDate = $isForward ? $paymentDate->addDays(2) : $paymentDate->subDays(1);
        } elseif ($paymentDate->isSunday()) {
            $paymentDate = $isForward ? $paymentDate->addDays(1) : $paymentDate->subDays(2);
        }
        return $paymentDate;
    }
    
}
