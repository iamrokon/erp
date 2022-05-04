<?php

namespace App\AllClass\sales\invoiceDeadline;

use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use App\AllClass\master\CSVLogger;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;
use App\tantousya;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Helper;

class AllInvoiceDeadline
{

    public static function readData($bango,$allRequest,$categorykanri_date,$print_date){
        $print_date  = $allRequest['print_date'];
        $categorykanri  = $allRequest['categorykanri'];
        $request_data01_107  = substr($allRequest['request_data01'],0,1);
        $request_data02_108  = substr($allRequest['request_data02'],0,1);
        $request_data03_109  = substr($allRequest['request_data03'],0,1);

//        dd(substr($invoiceDeadlineSupplier1_db,0,6) < substr($invoiceDeadlineSupplier2_db,0,6));
        if ($allRequest['invoiceDeadlineSupplier1_db'] <= $allRequest['invoiceDeadlineSupplier2_db']){
            $supplier1_dbRange=$allRequest['invoiceDeadlineSupplier1_db'];
            $supplier2_dbRange=$allRequest['invoiceDeadlineSupplier2_db'];
        }
        else{
            $supplier1_dbRange=$allRequest['invoiceDeadlineSupplier2_db'];
            $supplier2_dbRange=$allRequest['invoiceDeadlineSupplier1_db'];
        }
//        dd($supplier1_dbRange,$supplier2_dbRange);
        /*for checking purpose*/
        /*$supplier1_dbRange='002016';
        $supplier2_dbRange='006002';*/



        try {

            QueryHelper::runQuery("DROP TABLE IF EXISTS others2_invoice_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE others2_invoice_temp as
               select distinct
             tuhanorder.information2,
             concat_ws('/',kokyaku1.name,haisou.name) as kokyaku1haisouname,
             others2.otherint1,
             others2.other1,
             others2.other3,
             others2.other11,
             others2.other14,
             CASE
               WHEN substring(others2.other1,1,1)='1' THEN kokyaku1.ytoiawsestart
               ELSE others2.other3 END as deadline,
             CASE
               WHEN substring(others2.other1,1,1)='1' THEN kokyaku1.mail_jyushin_mb
               ELSE others2.other14 END as mailing,
             CASE
               WHEN substring(others2.other1,1,1)='1' THEN kokyaku1.mail_nouhin
               ELSE others2.other11 END as email,
             substr(tuhanorder.information2, 1,8)  as foregin_key

             from tuhanorder

                 left join kokyaku1
                 on substring(tuhanorder.information2,1,6) = kokyaku1.yobi12
                 and kokyaku1.denpyosaiban = 0

                 left join haisou
                 on substring(tuhanorder.information2,7,2) = haisou.torihikisakibango
                 and haisou.kounyusu = 0
                 and haisou.shikibetsucode = substring(tuhanorder.information2,1,6)

                 left join others2
                 on others2.otherint1=haisou.bango

                 /*where (substring (tuhanorder.information2,1,6) >= substring ('$supplier1_dbRange',1,6))
                   and (substring (tuhanorder.information2,1,6) <= substring ('$supplier2_dbRange',1,6))
                   and tuhanorder.housoukubun= '2 締日'
                   and tuhanorder.text1 != '23 売上計上(保守)'*/

                 ");


                QueryHelper::runQuery("DROP TABLE IF EXISTS seikyuzandaka_invoice_temp");
                QueryHelper::runQuery("CREATE TEMPORARY TABLE seikyuzandaka_invoice_temp as
                  select distinct on (tuhanorder.juchukubun2,invoice_deadline_datatxt0142)
                  seikyuzandaka.datatxt0142 as invoice_deadline_datatxt0142,
                  seikyuzandaka.date0009,
                  seikyuzandaka.date0010,
                  to_char(seikyuzandaka.date0010,'YYYY/MM/DD') as formatted_date0010,
                  substring(seikyuzandaka.date0010::text,12,8) as date0010_time,
                  to_char(seikyuzandaka.date0011,'YYYY/MM/DD') as date0011,
                  substring(seikyuzandaka.date0011::text,12,8) as date0011_time,
                  --seikyuzandaka.date0011,
                  CASE
                  WHEN length(information2Torihikisaki.r16) > 11
                    THEN LEFT(information2Torihikisaki.r16,10)||'...'
                    ELSE information2Torihikisaki.r16 END as kokyaku1name,
                  to_char(cast(COALESCE(seikyuzandaka.datanum0059,0) + COALESCE(seikyuzandaka.datanum0076,0)  as bigint),'FM99,999,999,999') as sum_1,
                  to_char(cast(COALESCE(seikyuzandaka.datanum0060,0) + COALESCE(seikyuzandaka.datanum0077,0)as bigint),'FM99,999,999,999') as sum_2,
                  to_char(cast(COALESCE(seikyuzandaka.datanum0061,0) + COALESCE(seikyuzandaka.datanum0062,0) + COALESCE(seikyuzandaka.datanum0063,0) + COALESCE(seikyuzandaka.datanum0078,0) + COALESCE(seikyuzandaka.datanum0079,0) + COALESCE(seikyuzandaka.datanum0080,0) as bigint),'FM99,999,999,999') as sum_3,
                  to_char(cast(COALESCE(seikyuzandaka.datanum0051,0) - COALESCE(seikyuzandaka.datanum0059,0) -COALESCE(seikyuzandaka.datanum0076,0) - COALESCE(seikyuzandaka.datanum0060,0) - COALESCE(seikyuzandaka.datanum0077,0) - COALESCE(seikyuzandaka.datanum0061,0) - COALESCE(seikyuzandaka.datanum0062,0) - COALESCE(seikyuzandaka.datanum0063,0) - COALESCE(seikyuzandaka.datanum0078,0) - COALESCE(seikyuzandaka.datanum0079,0) - COALESCE(seikyuzandaka.datanum0080,0) as bigint),'FM99,999,999,999') as datanum0051,
                  to_char(cast(COALESCE(seikyuzandaka.datanum0052,0) + COALESCE(seikyuzandaka.datanum0053,0) - COALESCE(seikyuzandaka.datanum0054,0) - COALESCE(seikyuzandaka.datanum0055,0) as bigint),'FM99,999,999,999') as sum_4,
                  to_char(cast(COALESCE(seikyuzandaka.datanum0056,0) + COALESCE(seikyuzandaka.datanum0058,0) as bigint),'FM99,999,999,999') as sum_5,
                  to_char(cast(COALESCE(seikyuzandaka.datanum0051,0) - COALESCE(seikyuzandaka.datanum0059,0) -COALESCE(seikyuzandaka.datanum0076,0) - COALESCE(seikyuzandaka.datanum0060,0) - COALESCE(seikyuzandaka.datanum0077,0) - COALESCE(seikyuzandaka.datanum0061,0) - COALESCE(seikyuzandaka.datanum0062,0) - COALESCE(seikyuzandaka.datanum0063,0) - COALESCE(seikyuzandaka.datanum0078,0) - COALESCE(seikyuzandaka.datanum0079,0) - COALESCE(seikyuzandaka.datanum0080,0) + COALESCE(seikyuzandaka.datanum0052,0) + COALESCE(seikyuzandaka.datanum0053,0) - COALESCE(seikyuzandaka.datanum0054,0) - COALESCE(seikyuzandaka.datanum0055,0) + COALESCE(seikyuzandaka.datanum0056,0) + COALESCE(seikyuzandaka.datanum0058,0) as bigint),'FM99,999,999,999') as billedamount,
                  to_char(cast(COALESCE(seikyuzandaka.datanum0057,0) + COALESCE(seikyuzandaka.datanum0058,0) as bigint),'FM99,999,999,999') as sum_6,
                  --seikyuzandaka.datatxt0143,
                  tantousyaDatatxt0143.name as datatxt0143,
                  replace(replace(tantousyaDatatxt0143.name,' ',''),'　','') as datatxt0143_search,
                  substring(replace(replace(tantousyaDatatxt0143.name,' ',''),'　',''),1,3) as datatxt0143_short,
                  seikyuzandaka.datatxt0144,
                  CASE 
                    WHEN seikyuzandaka.datatxt0144 is null THEN NULL
                    WHEN LENGTH(SPLIT_PART(seikyuzandaka.datatxt0144::text,'.',1))>20 THEN concat(substring(seikyuzandaka.datatxt0144,1,19),'...',SPLIT_PART(seikyuzandaka.datatxt0144::text,'.',2))
                    ELSE seikyuzandaka.datatxt0144
                    END as datatxt0144_short,
                  to_char(seikyuzandaka.datanum0051,'FM99,999,999,999,999') as formatted_datanum0051,
                  seikyuzandaka.datanum0052,
                  to_char(seikyuzandaka.datanum0052,'FM99,999,999,999,999') as formatted_datanum0052,
                  seikyuzandaka.datanum0053,
                  to_char(seikyuzandaka.datanum0053,'FM99,999,999,999,999') as formatted_datanum0053,
                  seikyuzandaka.datanum0054,
                  to_char(seikyuzandaka.datanum0054,'FM99,999,999,999,999') as formatted_datanum0054,
                  seikyuzandaka.datanum0055,
                  to_char(seikyuzandaka.datanum0055,'FM99,999,999,999,999') as formatted_datanum0055,
                  seikyuzandaka.datanum0056,
                  to_char(seikyuzandaka.datanum0056,'FM99,999,999,999,999') as formatted_datanum0056,
                  seikyuzandaka.datanum0057,
                  to_char(seikyuzandaka.datanum0057,'FM99,999,999,999,999') as formatted_datanum0057,
                  seikyuzandaka.datanum0058,
                  to_char(seikyuzandaka.datanum0058,'FM99,999,999,999,999') as formatted_datanum0058,
                  seikyuzandaka.datanum0059,
                  to_char(seikyuzandaka.datanum0059,'FM99,999,999,999,999') as formatted_datanum0059,
                  seikyuzandaka.datanum0060,
                  to_char(seikyuzandaka.datanum0060,'FM99,999,999,999,999') as formatted_datanum0060,
                  seikyuzandaka.datanum0061,
                  to_char(seikyuzandaka.datanum0061,'FM99,999,999,999,999') as formatted_datanum0061,
                  seikyuzandaka.datanum0062,
                  to_char(seikyuzandaka.datanum0062,'FM99,999,999,999,999') as formatted_datanum0062,
                  seikyuzandaka.datanum0063,
                  to_char(seikyuzandaka.datanum0063,'FM99,999,999,999,999') as formatted_datanum0063,
                  seikyuzandaka.datanum0064,
                  to_char(seikyuzandaka.datanum0064,'FM99,999,999,999,999') as formatted_datanum0064,
                  seikyuzandaka.datanum0065,
                  to_char(seikyuzandaka.datanum0065,'FM99,999,999,999,999') as formatted_datanum0065,
                  seikyuzandaka.datanum0066,
                  to_char(seikyuzandaka.datanum0066,'FM99,999,999,999,999') as formatted_datanum0066,
                  seikyuzandaka.datanum0067,
                  to_char(seikyuzandaka.datanum0067,'FM99,999,999,999,999') as formatted_datanum0067,
                  seikyuzandaka.datanum0068,
                  to_char(seikyuzandaka.datanum0068,'FM99,999,999,999,999') as formatted_datanum0068,
                  seikyuzandaka.datanum0069,
                  to_char(seikyuzandaka.datanum0069,'FM99,999,999,999,999') as formatted_datanum0069,
                  seikyuzandaka.datanum0070,
                  to_char(seikyuzandaka.datanum0070,'FM99,999,999,999,999') as formatted_datanum0070,
                  seikyuzandaka.datanum0071,
                  to_char(seikyuzandaka.datanum0071,'FM99,999,999,999,999') as formatted_datanum0071,
                  seikyuzandaka.datanum0072,
                  to_char(seikyuzandaka.datanum0072,'FM99,999,999,999,999') as formatted_datanum0072,
                  seikyuzandaka.datanum0073,
                  to_char(seikyuzandaka.datanum0073,'FM99,999,999,999,999') as formatted_datanum0073,
                  seikyuzandaka.datanum0074,
                  to_char(seikyuzandaka.datanum0074,'FM99,999,999,999,999') as formatted_datanum0074,
                  seikyuzandaka.datanum0075,
                  to_char(seikyuzandaka.datanum0075,'FM99,999,999,999,999') as formatted_datanum0075,
                  seikyuzandaka.datanum0076,
                  to_char(seikyuzandaka.datanum0076,'FM99,999,999,999,999') as formatted_datanum0076,
                  seikyuzandaka.datanum0077,
                  to_char(seikyuzandaka.datanum0077,'FM99,999,999,999,999') as formatted_datanum0077,
                  seikyuzandaka.datanum0078,
                  to_char(seikyuzandaka.datanum0078,'FM99,999,999,999,999') as formatted_datanum0078,
                  seikyuzandaka.datanum0079,
                  to_char(seikyuzandaka.datanum0079,'FM99,999,999,999,999') as formatted_datanum0079,
                  seikyuzandaka.datanum0080,
                  to_char(seikyuzandaka.datanum0080,'FM99,999,999,999,999') as formatted_datanum0080,
                  seikyuzandaka.datanum0081,
                  to_char(seikyuzandaka.datanum0081,'FM99,999,999,999,999') as formatted_datanum0081,
                  seikyuzandaka.datanum0082,
                  to_char(seikyuzandaka.datanum0082,'FM99,999,999,999,999') as formatted_datanum0082,
                  seikyuzandaka.datanum0083,
                  to_char(seikyuzandaka.datanum0083,'FM99,999,999,999,999') as formatted_datanum0083,
                  seikyuzandaka.datanum0084,
                  to_char(seikyuzandaka.datanum0084,'FM99,999,999,999,999') as formatted_datanum0084,
                  seikyuzandaka.datanum0085,
                  to_char(seikyuzandaka.datanum0085,'FM99,999,999,999,999') as formatted_datanum0085,
                  tuhanorder.information2,
                  tuhanorder.text3 as invoice_deadline_text3,
                  --substring(tantousyaName.name, 1, 3) as invoice_deadline_datachar12,
                  tantousyaName.name as issuer_name,
                  replace(replace(tantousyaName.name,' ',''),'　','') as issuer_name_search,
                  substring(replace(replace(tantousyaName.name,' ',''),'　',''),1,3) as issuer_name_short,
                  --kokyaku1.mail_jyushin_mb as invoice_deadline_mail_jyushin_mb,
                  hikiatesyukko.dataint09 ||' '|| req_2.jouhou as dataint09,
                  hikiatesyukko.dataint02 as checkdataint02,
                  kokyaku1.mail_nouhin,
                  others2_invoice_temp.deadline,
                  others2_invoice_temp.mailing,
                  others2_invoice_temp.email,
                  hikiatesyukko.dataint08 ||' '|| req_4.jouhou as dataint08


                  from seikyuzandaka

                  join tuhanorder
                  on seikyuzandaka.datatxt0142= substr(tuhanorder.information2, 1,8)
                  and seikyuzandaka.date0009=tuhanorder.chumondate
                  
                  --information2
                  left join v_torihikisaki as information2Torihikisaki on
                  information2Torihikisaki.torihikisaki_cd = tuhanorder.information2
                  --information2 end

                  join (select
                           distinct
                           substr(tuhanorder.information2, 1,8) as t_info2,
                           max(tuhanorder.juchukubun2) as salesid

                           from tuhanorder
                           join hikiatesyukko
                           on tuhanorder.juchukubun2 = hikiatesyukko.kaiinid

                          where substr(tuhanorder.housoukubun, 1,1) = '2'
                          and tuhanorder.text1 <> 'U523' and tuhanorder.chumondate::text LIKE '%$categorykanri_date%'
                          group by substr(tuhanorder.information2, 1,8)
                        ) as t_tuhanorder
                  on substr(tuhanorder.information2, 1,8) = t_tuhanorder.t_info2
                  and tuhanorder.juchukubun2 = t_tuhanorder.salesid

                  join hikiatesyukko
                  on hikiatesyukko.orderbango= tuhanorder.orderbango

                  left join  others2_invoice_temp
                  on others2_invoice_temp.foregin_key=seikyuzandaka.datatxt0142

                  join kokyaku1
                  on substr(seikyuzandaka.datatxt0142, 1,6)=kokyaku1.yobi12

                  left join request as req_1
                  on req_1.color = '0407請求書郵送'
                  and cast(req_1.syouhinbango as text)=kokyaku1.mail_jyushin_mb

                  left join request as req_2
                  on req_2.color =  '0407請求書作成フラグ'
                  and req_2.syouhinbango =hikiatesyukko.dataint09

                  left join request as req_3
                  on req_3.color =  '0407請求書メール区分'
                  and cast(req_3.syouhinbango as text)=kokyaku1.mail_nouhin

                  left join request as req_4
                  on req_4.color =  '0407請求書メール送信フラグ'
                  and cast(req_4.syouhinbango as text)=cast(hikiatesyukko.dataint08 as text)

                left join tantousya as tantousyaDatatxt0143
                on tantousyaDatatxt0143.bango = seikyuzandaka.datatxt0143
                
                left join tantousya as tantousyaName
                on tantousyaName.bango = hikiatesyukko.datachar12

                  --where  seikyuzandaka.date0009::text LIKE '%$categorykanri_date%'
                ORDER BY invoice_deadline_datatxt0142 ASC
                ");

            $search_sql= DB::table('seikyuzandaka_invoice_temp')->toSql();

            $search_sql .=' where ';

            if ($supplier1_dbRange != $supplier2_dbRange) {
                $search_sql .= " invoice_deadline_datatxt0142 between '$supplier1_dbRange' and  '$supplier2_dbRange' ";
            } else {
                $search_sql .= " invoice_deadline_datatxt0142 like '%$supplier1_dbRange%'";
            }
            
            if ($request_data03_109 == 3) {
                $search_sql .= "  and (checkdataint02 = '1' OR checkdataint02 = '2') ";
            }else{
                $search_sql .= "  and checkdataint02 = '$request_data03_109'";
            }
            
            if ($request_data01_107 == 5) {
                $search_sql .= "  and (substring(mailing,1,1) = '1' OR substring(mailing,1,1) = '4') ";
            }else{
                $search_sql .= "  and substring(mailing,1,1) = '$request_data01_107'";
            }
            
            if ($request_data02_108 == 3) {
                $search_sql .= "  and (substring(email,1,1) = '1' OR  substring(email,1,1) = '2') ";
            }else{
                $search_sql .= "  and substring(email,1,1) = '$request_data02_108'";
            }

            return $search_sql;


        } catch (\Exception $e) {
          dd($e);
            return $e;

        }


    }

}
