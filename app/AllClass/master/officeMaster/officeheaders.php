<?php

namespace App\AllClass\master\officeMaster;

use App\AllClass\TableSetting;
use DB;
use App\tantousya;
use App\kengen;


Class officeheaders
{
    public static $page_no = '08-02';

    public static function headers($bango,$type=null)
    {
        $headers = $headers = [
            '会社CD' => 'office_shikibetsucode',
        '会社名' => 'gaishamei',
        '事業所CD' => 'office_torihikisakibango',
        '事業所名' => 'name',
        '事業所名略称' => 'haisoumoji1',
        /*'事業所名カナ'=>'haisoumoji2',*/
        '入力区分' => 'torihikisakirank1',
        '担当SA1' => 'syukeitukikijunwithname',
        '担当SA2' => 'syukeitukiwithname',
        '担当SE1' => 'syukeikikijunwithname',
        '担当SE2' => 'syukeinenkijunwithname',
        '郵便番号' => 'office_yubinbango',
        '都道府県名' => 'address1',
        '市区町村名' => 'address2',
        '町域名' => 'address3',
        '番地・建物名' => 'address4',
        'TEL' => 'office_tel',
        'FAX' => 'office_torihikisakirank2',
        'JIS市区町村CD' => 'office_yobi1',
        'メールアドレス' => 'mail',
        '売上区分' => 'haisoumoji2',
        '仕入区分' => 'syukeiki',
        '事業所口座使用区分' => 'other1',
        '即時区分' => 'other2',
        '請求締め日' => 'other3_detail',
        '入金方法' => 'other4_detail',
        '入金月' => 'other5',
        '入金日' => 'office_other6',
        '入金日休日設定' => 'other7',
        '入金振込手数料設定' => 'other8',
        '与信限度額' => 'formatted_otherfloat1',
        '請求先CD' => 'office_other9',
        '請求書送付日' => 'office_other10',
        '請求書メール区分' => 'other11',
        '請求書メール宛先' => 'other12',
        '請求書UIS' => 'other13',
        '請求書郵送' => 'other14',
        '請求書郵送先CD' => 'office_other15',
        '請求課税区分' => 'other16_detail',
        '請求消費税計算区分' => 'other17',
        '請求税端数区分' => 'other18_detail',
        '支払締め日' => 'other19_detail',
        '支払月' => 'other20',
        '支払日' => 'other21_detail',
        '支払日休日設定' => 'other22',
        '支払振込手数料設定' => 'other23',
        '支払方法' => 'other24_detail',
        '支払手形サイト' => 'otherfloat2',
        '支払振込手数料区分' => 'other30_detail',
        '振込銀行' => 'office_other25',
        '振込支店' => 'office_other26',
        '預金種別' => 'otherfloat4',
        '口座番号' => 'office_other27',
        '口座名義人' => 'other28',
        '仕向銀行' => 'other31_detail',
        '仕向支店' => 'other32_detail',
        '支払課税区分' => 'other33_detail',
        '支払消費税計算区分' => 'other34',
        '支払税端数区分' => 'other35_detail',
        '源泉税率' => 'otherfloat3',
        '旧取引先CD' => 'office_other36',
        '手形決済月' => 'other37',
        '手形決済日' => 'office_other38',
        '専伝区分' => 'other39',
        '指定納品書帳票CD' => 'office_other40',
        '登録年月日' => 'created_date',
        '登録時刻' => 'created_time',
        '更新年月日' => 'updated_date',
        '更新時刻' => 'updated_time',
        //'更新時端末IP' => 'netlogin',
        '更新者' => 'user_name'
        ];

        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);


    }
}
