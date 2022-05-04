<?php

namespace App\AllClass\purchase\purchaseBalanceList;

use App\AllClass\TableSetting;
use DB;
use App\tantousya;
use App\kengen;

Class PurchaseBalanceListHeaders
{
    public static $page_no = '06-06';

    public static function headers($bango,$type=null)
    {
        $headers = [
            '仕入先CD' => 'kk0002',
            '仕入先名' => 'supplier_name',
            '前月買掛残' => 'formatted_kk0004',
            '当月買掛額' => 'formatted_kk0005',
            '仕入値引他' => 'formatted_purchase_discount',
            '当月消費税' => 'formatted_kk0009',
            '現金振込' => 'formatted_kk0010',
            '手形' => 'formatted_kk0011',
            '支払値引他' => 'formatted_payment_discount',
            '当月買掛残' => 'formatted_kk0015',
            '前月末前払残高' => 'formatted_kk0016',
            '当月前払額' => 'formatted_kk0017',
            '当月前払消費税額' => 'formatted_kk0018',
            '当月前払現金支払額' => 'formatted_kk0019',
            '当月前払手形支払額' => 'formatted_kk0020',
            '前払支払値引他' => 'formatted_prepaid_payment_discount',
            '当月末前払残高' => 'formatted_kk0024',
        ];

        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);
    }
    
    //when rd = rd_2
    public static function headers_2($bango,$type=null)
    {
        $headers = [
            '購入先CD' => 'kk0002',
            '購入先名' => 'supplier_name',
            '前月未払残' => 'formatted_kk0004',
            '当月未払額' => 'formatted_kk0005',
            '購入値引他' => 'formatted_purchase_discount',
            '当月消費税' => 'formatted_kk0009',
            '現金振込' => 'formatted_kk0010',
            '手形' => 'formatted_kk0011',
            '支払値引他' => 'formatted_payment_discount',
            '当月未払残' => 'formatted_kk0015',
            '前月末前払残高' => 'formatted_kk0016',
            '当月前払額' => 'formatted_kk0017',
            '当月前払消費税額' => 'formatted_kk0018',
            '当月前払現金支払額' => 'formatted_kk0019',
            '当月前払手形支払額' => 'formatted_kk0020',
            '前払支払値引他' => 'formatted_prepaid_payment_discount',
            '当月末前払残高' => 'formatted_kk0024',
        ];

        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);
    }
    
    public static function headers_3()
    {
        $headers = [
            '仕入先CD' => 'kk0002',
            '仕入先' => 'supplier_name',
            '前月買掛未払残' => 'formatted_kk0004',
            '当月買掛未払額' => 'formatted_kk0005',
            '仕入購入値引等' => 'formatted_purchase_discount',
            '当月消費税' => 'formatted_kk0009',
            '現金振込' => 'formatted_kk0010',
            '手形' => 'formatted_kk0011',
            '支払値引他' => 'formatted_payment_discount',
            '当月買掛未払残' => 'formatted_kk0015',
            '前月末前払残高' => 'formatted_kk0016',
            '当月前払額' => 'formatted_kk0017',
            '当月前払消費税額' => 'formatted_kk0018',
            '当月前払現金支払額' => 'formatted_kk0019',
            '当月前払手形支払額' => 'formatted_kk0020',
            '前払支払値引他' => 'formatted_prepaid_payment_discount',
            '当月末前払残高' => 'formatted_kk0024',
        ];
        return $headers;
    }
    
}
