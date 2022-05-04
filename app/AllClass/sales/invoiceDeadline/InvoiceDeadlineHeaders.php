<?php

namespace App\AllClass\sales\invoiceDeadline;

use App\AllClass\TableSetting;
use DB;
use App\tantousya;
use App\kengen;

Class InvoiceDeadlineHeaders
{
    public static $page_no = '04-07';

    public static function headers($bango,$type=null)
    {
        $headers = [
            '売上請求先CD' => 'invoice_deadline_datatxt0142',
            '売上請求先' => 'kokyaku1name',
            '現金入金額' => 'sum_1',
            '手形入金' => 'sum_2',
            '今回値引他' => 'sum_3',
            '今回繰越額' => 'datanum0051',
            '今回売上額' => 'sum_4',
            '今回消費税' => 'sum_5',
            '今回請求額' => 'billedamount',
            '即時請求額' => 'sum_6',
            '請求書PDF' => 'datatxt0144',
            'tick_mark' => 'checkbox',
            '請求書番号' => 'invoice_deadline_text3',
            '発行者' => 'issuer_name',
            '郵送' => 'mailing',
            '印刷済' => 'dataint09',
            'メール' => 'email',
            'メール済' => 'dataint08',
            '前回請求額' => 'formatted_datanum0051',
            '今回売上額2' => 'formatted_datanum0052',
            '今回返品額' => 'formatted_datanum0053',
            '今回値引額' => 'formatted_datanum0054',
            '今回他売上額' => 'formatted_datanum0055',
            '今回消費税額' => 'formatted_datanum0056',
            '今回即時請求額' => 'formatted_datanum0057',
            '今回即時請求消費税額' => 'formatted_datanum0058',
            '今回現金入金額' => 'formatted_datanum0059',
            '今回手形入金額' => 'formatted_datanum0060',
            '今回相殺額' => 'formatted_datanum0061',
            '今回入金値引額' => 'formatted_datanum0062',
            '今回他入金額' => 'formatted_datanum0063',
            '今回請求残高' => 'formatted_datanum0064',
            '前回末前受請求額' => 'formatted_datanum0065',
            '今回前受請求額' => 'formatted_datanum0066',
            '今回前受消費税額' => 'formatted_datanum0067',
            '今回前受即時請求額' => 'formatted_datanum0068',
            '今回前受即時請求消費税額' => 'formatted_datanum0069',
            '今回前受現金入金額' => 'formatted_datanum0070',
            '今回前受手形入金額' => 'formatted_datanum0071',
            '今回前受相殺額' => 'formatted_datanum0072',
            '今回前受入金値引額' => 'formatted_datanum0073',
            '今回前受他入金額' => 'formatted_datanum0074',
            '今回末前受請求残高' => 'formatted_datanum0075',
            '今回即時現金入金額' => 'formatted_datanum0076',
            '今回即時手形入金額' => 'formatted_datanum0077',
            '今回即時相殺額' => 'formatted_datanum0078',
            '今回即時入金値引額' => 'formatted_datanum0079',
            '今回即時他入金額' => 'formatted_datanum0080',
            '今回即時前受現金入金額' => 'formatted_datanum0081',
            '今回即時前受手形入金額' => 'formatted_datanum0082',
            '今回即時前受相殺額' => 'formatted_datanum0083',
            '今回即時前受入金値引額' => 'formatted_datanum0084',
            '今回即時前受他入金額' => 'formatted_datanum0085',
            '登録年月日' => 'formatted_date0010',
            '登録時刻' => 'date0010_time',
            '更新年月日' => 'date0011',
            '更新時刻' => 'date0011_time',
            '更新者' => 'datatxt0143',
    ];

        $pageNo= static::$page_no;
        if($type){
            return TableSetting::getHeaders($bango,$pageNo,$headers,$type);
        }
        return TableSetting::getHeaders($bango,$pageNo,$headers);



    }
}
