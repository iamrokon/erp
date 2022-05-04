<?php

namespace App\AllClass\purchase\purchaseInput;

use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;
use App\tantousya;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Helper;
use Exception;

class DateCalculator
{

public static function calculateBillingDates($supplierID)
    {
        $yobi12 = substr($supplierID, 0, 6);
        $torihikisakibango = substr($supplierID, 6, 2);
        $haisou = QueryHelper::fetchSingleResult("select * from haisou where shikibetsucode = '$yobi12'  and kounyusu = 0 and torihikisakibango = '$torihikisakibango'");
        $companyData = QueryHelper::fetchSingleResult("select * from kokyaku1 where yobi12 = '$yobi12' and denpyosaiban = 0 ");
        $haisouBango = $haisou->bango ?? null;
        $companyBango = $companyData->bango ?? null;
        $day = null;
        $month = null;
        $holidaySetting = null;
        $paymentMethod = null;
        if ($haisouBango) {
            $other2 = QueryHelper::fetchSingleResult("select * from others2 where otherint1 = '$haisouBango'");
            $other1 = $other2->other1 ?? null;
            if ($other1) {
                if (explode(" ", $other1)[0] == '1') {
                    $haisoujouhou = QueryHelper::fetchSingleResult("select * from haisoujouhou where syukei1 = $companyBango");
                    $holidaySetting = $haisoujouhou->bunrui1 ?? null;
                    $day = $haisoujouhou->sex ?? null;
                    $month = $haisoujouhou->mail ?? null;
                    $paymentMethod = $haisoujouhou->bunrui3 ?? null;
                    // if($bunrui3){
                    //     $c1 = substr($bunrui3, 0, 2);
                    //     $c2 = substr($bunrui3, 2, 4);
                    //     $paymentMethod = QueryHelper::fetchResult("select category2,category4 from categorykanri where category1 = '$c1' and category2 = '$c2' ORDER BY category2 ASC");
                    // }
                    return [$day, $month, $holidaySetting, $paymentMethod];
                } elseif (explode(" ", $other1)[0] == '2') {
                    $day = $other2->other21 ?? null;
                    $month = $other2->other20 ?? null;
                    $holidaySetting = $other2->other22 ?? null;
                    $paymentMethod = $other2->other24 ?? null;
                    // if($bunrui3){
                    //     $c1 = substr($bunrui3, 0, 2);
                    //     $c2 = substr($bunrui3, 2, 4);
                    //     $paymentMethod = QueryHelper::fetchResult("select category2,category4 from categorykanri where category1 = '$c1' and category2 = '$c2' ORDER BY category2 ASC");
                    // }
                    return [$day, $month, $holidaySetting, $paymentMethod];
                }
            }
        }
        return [$day, $month, $holidaySetting, $paymentMethod];
    }
}