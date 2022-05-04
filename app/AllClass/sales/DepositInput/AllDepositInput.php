<?php


namespace App\AllClass\sales\DepositInput;

use App\AllClass\sales\DepositInput\DepositInputAmount as DepositAmount;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\Helpers\Helper;

class AllDepositInput
{
    public static function data($sitename)
    {
        $deposit_input = QueryHelper::fetchSingleResult("select shinkurokokyakuname, dataint02,dataint01,
                concat(substring( cast (torikomidate as varchar(100)),1,4),
                substring(cast (torikomidate  as varchar(100)),6,2),
                substring(cast (torikomidate  as varchar(100)),9,2)) as torikomidate,  chumonsyaname from daikinseisan  where shinkurokokyakuname = '$sitename' and dataint01 = 0
                ");
        $deposit_input_shinkuroKokyakuGroup = QueryHelper::fetchResult("select  shinkuroKokyakuGroup from daikinseisan  where shinkurokokyakuname = '$sitename' ") ?? null;
        $deposit_input_shinkuroKokyakuGroup_json = [];
        if ($deposit_input_shinkuroKokyakuGroup) {
            array_map(function ($item) use (&$deposit_input_shinkuroKokyakuGroup_json) {
                array_push($deposit_input_shinkuroKokyakuGroup_json, $item->shinkurokokyakugroup);
            }, $deposit_input_shinkuroKokyakuGroup);
        }
        $deposit_input_details = QueryHelper::fetchResult("select *,
                concat(substring( cast (chumondate as varchar(100)),1,4),
                substring(cast (chumondate  as varchar(100)),6,2),
                substring(cast (chumondate  as varchar(100)),9,2)) as  chumondate1 from daikinseisan  where shinkurokokyakuname = '$sitename' and dataint01 = 0 order by cast(shinkuroKokyakuGroup as integer)");
        if ($deposit_input && $deposit_input_details) {
            $creation_category = QueryHelper::fetchSingleResult("select * from request where color = '0410入金会計データ作成フラグ' and syouhinbango = $deposit_input->dataint02") ?? null;
            $billing_address_db = $deposit_input->chumonsyaname ?? null;
            $billing_address = $billing_address_db ? self::getBillingAddress($deposit_input->chumonsyaname) : null;
            $payment_date = $deposit_input->torikomidate ?? null;
            $deposit_input_details_additionalInfo = QueryHelper::fetchSingleResult("select sum(nyukingaku) as total_deposit_amount,count(shinkurokokyakugroup) as total_deposit_input  from daikinseisan  where shinkurokokyakuname = '$sitename' and dataint01 = 0");
            $deposit_inpt['total_deposit_amount'] = $deposit_input_details_additionalInfo->total_deposit_amount ?? 0;
            $deposit_inpt['count_of_deposit_input'] = $deposit_input_details_additionalInfo->total_deposit_input ?? 0;
            $deposit_inpt['all_shinkuroKokyakugroup'] = count($deposit_input_shinkuroKokyakuGroup_json) ? json_encode($deposit_input_shinkuroKokyakuGroup_json) : null;
            $deposit_inpt['payment_date'] = $payment_date;
            $deposit_inpt['creation_category'] = $creation_category ? $creation_category->syouhinbango . ' ' . $creation_category->jouhou : "";
            $deposit_inpt['billing_address'] = $billing_address;
            $deposit_inpt['billing_address_db'] = $billing_address_db;
            $deposit_inpt['delivery_number'] = $deposit_input->shinkurokokyakuname ?? null;
            $deposit_inpt['expected_deposit_amount'] = self::getExpectedDepositAmount($payment_date, $billing_address_db);
            $has_deposit_input = true;
            return [$deposit_inpt, $deposit_input_details, $has_deposit_input];
        } elseif (!$deposit_input && !$deposit_input_details) {
            $deposit_inpt = [];
            $deposit_input_details = [];
            $has_deposit_input = false;
            return [$deposit_inpt, $deposit_input_details, $has_deposit_input];
        }
        return false;
    }

    public static function getBillingAddress($digits)
    {
        if ($digits) {
            $key = 'r16cd';
            return QueryHelper::fetchSingleResult("select  $key from v_torihikisaki where torihikisaki_cd  like '$digits%'")->$key ?? null;
        }
        return null;

    }

    public static function getExpectedDepositAmount($payment_date, $billing_address_db)
    {
        $payment_date = Helper::replaceSpecificString($payment_date, '/');
        return DepositAmount::calculate($billing_address_db, $payment_date);
    }

    public static function hasError($eczaikorendou, $paymentDate, $billingDestination)
    {
        $billingDestination = substr($billingDestination, 0, 8);
        $date009 = QueryHelper::fetchSingleResult("select max(date0009) from seikyuzandaka")->max ?? null;
        $date009 = $date009 ? str_replace('-', '', explode(' ', $date009)[0]) : null;
        $datatxt0142 = QueryHelper::fetchSingleResult("select count(*) from seikyuzandaka where datatxt0142 = '$billingDestination'")->count ?? null;
        if (!$date009 || $datatxt0142) {
            return false;
        } else {
            $rendoumail = $eczaikorendou->rendoumail;
            $tsuchimail = $eczaikorendou->tsuchimail;
            if (!$datatxt0142 && ($paymentDate <= $date009 || $rendoumail == 1 && $tsuchimail == 1)) {
                return [true, 'all'];
            }
            if ($rendoumail == 1 && $tsuchimail == 1 || ($paymentDate <= $date009)) {
                return [true, 'eczaikorendou'];
            }

            if (!$datatxt0142) {
                return [true, 'seikyuzandaka'];
            }

            return false;
        }
    }

}
