<?php

namespace App\AllClass\master\companyMaster;

use App\AllClass\TableSetting;
use DB;
use App\tantousya;
use App\kengen;


Class companyHeaders
{
    public static $page_no = '08-01';

    public static function headers($bango,$type = null)
    {
        $headers = [
            '会社CD' => 'yobi12',
            '会社名' => 'name',
            '会社名略称' => 'address',
            '会社名カナ' => 'furigana',
            '入力区分' => 'yubinbango',
            '帝国ﾃﾞｰﾀﾊﾞﾝｸ信用録PDF' => 'yobi13_short',
            '信用録書類保管番号' => 'bunrui6',
            '帝国ﾃﾞｰﾀﾊﾞﾝｸ取得年月日' => 'tel',
            '帝国ﾃﾞｰﾀﾊﾞﾝｸ企業CD' => 'fax',
            '帝国ﾃﾞｰﾀﾊﾞﾝｸ評点' => 'torihikisakibango',
            '経済産業省業種区分1' => 'tantousya_detail',
            '経済産業省業種区分2' => 'kcode1_detail',
            '基本業種' => 'kcode2_detail',
            '備考' => 'kensakukey',
            '即時区分' => 'kcode3',
            '請求締め日' => 'ytoiawsestart_detail',
            '入金方法' => 'ytoiawseend_detail',
            '入金月' => 'ytoiawsesaiban',
            '入金日' => 'yetoiawsestart',
            '入金日休日設定' => 'yetoiawseend',
            '入金振込手数料設定' => 'yetoiawsesaiban',
            '与信限度額' => 'formatted_denpyostart',
            '請求先CD' => 'mail_soushin',
            '請求書送付日' => 'mail_jyushin',
            '請求書メール区分' => 'mail_nouhin',
            '請求書メール宛先' => 'mail_toiawase',
            '請求書UIS' => 'mail_soushin_mb',
            '請求書郵送' => 'mail_jyushin_mb',
            '請求書郵送先CD' => 'mail_nouhin_mb',
            '請求課税区分' => 'mail_toiawase_mb_detail',
            '請求税端数区分' => 'mallsoukobango1_detail',
            '専伝区分' => 'mallsoukobango2',
            '指定納品書帳票CD' => 'mallsoukobango3',
            'ユーザー区分' => 'kcode4',
            'データソース' => 'kcode5_detail',
            '販売ランク' => 'domain_detail',
            '顧客深耕層別化' => 'domain2_detail',
            '得意先分類3'=>'datatxt0058_detail',
            '得意先分類4'=>'datatxt0059_detail',
            '得意先分類5'=>'datatxt0060_detail',
            '得意先分類6'=>'datatxt0061_detail',
            '年商' => 'stoiawsestart_detail',
            '従業員' => 'stoiawseend_detail',
            '資本金' => 'stoiawsesaiban_detail',
            '取引開始日 東直' => 'kaiinbango',
            '取引開始日 東流' => 'zokugara',
            '取引開始日 西直' => 'haisoujouhou_name',
            '取引開始日 西流' => 'haisoujouhou_yubinbango',
            '単価設定区分' => 'haisoujouhou_address_detail',
            '支払締め日' => 'haisoujouhou_tel_detail',
            '支払月' => 'mail',
            '支払日' => 'sex_detail',
            '支払日休日設定' => 'bunrui1',
            '支払振込手数料設定' => 'bunrui2',
            '支払振込手数料区分'=>'syukeinenkijun_detail',
            '支払方法' => 'bunrui3_detail',
            '振込銀行'=>'datatxt0054',
            '振込支店'=>'datatxt0055',
            '預金種別'=>'endtime',
            '口座番号'=>'datatxt0056',
            '口座名義人'=>'datatxt0057',
            '支払手形サイト'=>'syukei3',
            '仕向銀行' => 'syukeiki_detail',
            '仕向支店'=>'datatxt0053_detail',
            '支払課税区分' => 'bunrui4_detail',
            '支払税端数区分' => 'bunrui5_detail',
            '源泉税率' => 'syukei2',
            '手形決済月' => 'bunrui9',
            '手形決済日' => 'bunrui10',
            '保守更新案内有無' => 'netusername_detail',
            'ライセンス証書有無' => 'netuserpasswd_detail',
            '検収条件' => 'netlogin_detail',
            '法人マイナンバー' => 'kounyusu',
            '会計取引先CD' => 'syukeitukikijun',
            '旧取引先CD' => 'syukeinen',
            '売上区分' => 'syukeituki',
            '仕入区分' => 'syukeikikijun',
            '会社名カナ入金消込用' => 'datatxt0050',
            '請求消費税計算区分' => 'datatxt0051',
            '支払消費税計算区分' => 'datatxt0052',
            '登録年月日' => 'created_date',
            '登録時刻' => 'created_time',
            '更新年月日' => 'edited_date',
            '更新時刻' => 'edited_time',
        //    '更新時端末IP' => 'sekessaihouhou',
            '更新者' => 'user_name',
        ];

        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);


    }
}
