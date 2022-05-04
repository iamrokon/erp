<?php

namespace App\AllClass\master\productMaster;

use App\AllClass\TableSetting;
use DB;
use App\tantousya;
use App\kengen;


Class productHeaders
{
    public static $page_no = '08-04';

    public static function headers($bango,$type=null)
    {
        $headers = [
            '商品CD' => 'product_kokyakusyouhinbango',
            '商品名' => 'name',
            '品目群' => 'jouhou_detail',
            '製品区分' => 'koyuujouhou_detail',
            '品目区分' => 'color_detail',
            '販売形態' => 'bumon_detail',
            'バージョン' => 'jouhou2_detail',
            '保守区分' => 'data21',
            '継続区分' => 'tokuchou',
            '新規VUP区分' => 'data22',
            'サブ区分' => 'data23',
            '商品名略称' => 'size',
            '入力区分1' => 'data24',
            '仕入先CD' => 'product_season',
            '基本販売価格' => 'formatted_kakaku',
            'PB販売価格' => 'formatted_hanbaisu',
            '営業粗利' => 'formatted_jyougensu',
            'PB営業粗利' => 'formatted_kakaku_yoyaku',
            '仕入価格' => 'formatted_yoyakusu',
            '仕切(SE)' => 'formatted_yoyakukanousu',
            '仕切(研究所)' => 'formatted_sortbango',
            '仕切(出荷センター)' => 'formatted_dataint01',
            '入力区分2' => 'data25',
            '製品仕入品区分' => 'data52_detail',
            '事業分類' => 'data53_detail',
            '保守サブスク区分' => 'data54_detail',
            '商品分類3' => 'data100_detail',
            'ﾎﾞﾘｭｰﾑﾗｲｾﾝｽ区分' => 'data50',
            'ﾊﾞｰｼﾞｮﾝｱｯﾌﾟ区分' => 'data51',
            '上市開始日' => 'synchrosyouhinbango_detail',
            '終売日' => 'endtime_detail',
            '最新ﾊﾞｰｼﾞｮﾝ区分' => 'data26_detail',
            '前受請求区分' => 'data27',
            '請求課税区分' => 'data28_detail',
            '販売可能' => 'data29_detail',
            '単価区分' => 'data101_detail',
            '保守作成区分' => 'url_detail',
            '受注先限定' => 'product_data20',
            '保守商品CD' => 'url_mobile_detail',
            'セット商品上位CD' => 'product_chardata4',
            'メーカー品番' => 'product_kongouritsu',
            'メーカー品名' => 'mdjouhou',
            '価格設定区分' => 'meker',
            '単位' => 'konpoumei',
            '保守会社CD' => 'product_data104',
            '内訳製品粗利比率' => 'dspbango_detail',
            'UIS対象商品' => 's4_color_detail',
            '納品方法' => 's4_size_detail',
            '予備4' => 'syouhingroup_detail',
            '予備5' => 'ruijihinbango_detail',
            '予備6' => 'chardata1_detail',
            '予備7' => 'chardata2_detail',
            '登録年月日' => 'created_date',
            '登録時刻' => 'created_time',
            '更新年月日' => 'edited_date',
            '更新時刻' => 'edited_time',
           // '更新時端末IP' => 'code3',
            '更新者' => 'user_name',
        ];

        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);


    }
}
