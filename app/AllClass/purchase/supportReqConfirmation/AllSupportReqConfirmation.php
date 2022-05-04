<?php

namespace App\AllClass\purchase\supportReqConfirmation;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;
use App\tantousya;
use App\kengen;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class AllSupportReqConfirmation{
    public static function data($login_bango,$deleted_item=2,$req_data=null){

        $tmp_datatxt0003 = $req_data['datatxt0003'];
        $tmp_datatxt0004 = $req_data['datatxt0004'];
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_m");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_m as
        select distinct 
        kokyakuorderbango, max(ordertypebango2) as maxval
        from orderhenkan
        --where synchroorderbango = 0 
        group by kokyakuorderbango");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS orderhenkan_inner_data");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE orderhenkan_inner_data as
        select distinct 
        kokyakuorderbango, max(ordertypebango2) as maxval,intorder01,intorder03,intorder04
        from orderhenkan
        where synchroorderbango = 0 and datachar10 is null
        group by kokyakuorderbango,intorder01,intorder03,intorder04");
        
        QueryHelper::runQuery("DROP TABLE IF EXISTS support_req_confirmation_temp");
        QueryHelper::runQuery(
        "CREATE TEMPORARY TABLE support_req_confirmation_temp as
        select distinct 
        --on (orderhenkan.kokyakuorderbango)
        orderhenkan.bango,
        orderhenkan.kokyakuorderbango,
        orderhenkan.kokyakuorderbango as support_number,
        orderhenkan.orderuserbango,
        orderhenkan.ordertypebango2,
        CASE
            WHEN orderhenkan_inner_data.intorder03::text is null THEN NULL
            ELSE concat_ws('/',substring(orderhenkan_inner_data.intorder03::text,1,4),
            substring(orderhenkan_inner_data.intorder03::text,5,2),
            substring(orderhenkan_inner_data.intorder03::text,7,2)) END as intorder03,
        CASE
            WHEN orderhenkan_inner_data.intorder04::text is null THEN NULL
            ELSE concat_ws('/',substring(orderhenkan_inner_data.intorder04::text,1,4),
            substring(orderhenkan_inner_data.intorder04::text,5,2),
            substring(orderhenkan_inner_data.intorder04::text,7,2)) END as intorder04,
        CASE
            WHEN orderhenkan.date::text is null THEN NULL
            ELSE concat_ws('/',substring(date(orderhenkan.date)::text,1,4),
            substring(date(orderhenkan.date)::text,6,2),
            substring(date(orderhenkan.date)::text,9,2)) END as date,
        orderhenkan.datachar02,
        orderhenkan.datachar10,
        datachar10Detail.r17_4 as datachar10_detail,
        orderhenkan.datachar11,
        datachar11Detail.r17_4 as datachar11_detail,
        --orderhenkan.datachar13,
        convert_full_to_half(CASE
            WHEN LENGTH(orderhenkan.datachar13) > 11 THEN concat(substring(orderhenkan.datachar13,1,10),'...')
            ELSE orderhenkan.datachar13 END) as datachar13,
        orderhenkan.datachar09,
        datachar09Tantousya.name as user_name,
        replace(replace(datachar09Tantousya.name,' ',''),'　','') as user_name_search,
        substring(replace(replace(datachar09Tantousya.name,' ',''),'　',''),1,3) as user_name_short,
        temp_misyukko.support_amount,
        to_char(temp_misyukko.support_amount,'FM99,999,999,999,999') as formatted_support_amount,
        orderhenkan.datatxt0151,
        CASE
            WHEN orderhenkan.datatxt0151 is null then NULL
            WHEN LENGTH(orderhenkan.datatxt0151) > 18 THEN concat(substring(orderhenkan.datatxt0151,1,18),'...','pdf')
            ELSE orderhenkan.datatxt0151 END as datatxt0151_short,
        to_char(orderhenkan.deletedate, 'YYYY/MM/DD') as deletedate,
        to_char(orderhenkan.date0012, 'YYYY/MM/DD') as date0012,
        CASE
            WHEN orderhenkan_inner_data.intorder01::text is null THEN NULL
            ELSE concat_ws('/',substring(orderhenkan_inner_data.intorder01::text,1,4),
            substring(orderhenkan_inner_data.intorder01::text,5,2),
            substring(orderhenkan_inner_data.intorder01::text,7,2)) END as intorder01,
        orderhenkan.datachar12,
        to_char(orderhenkan.date0013, 'YYYY/MM/DD') as date0013,
        to_char(orderhenkan.date0014, 'YYYY/MM/DD') as date0014,
        to_char(orderhenkan.date0015, 'YYYY/MM/DD') as date0015,
        orderhenkan.datatxt0148,
        orderhenkan.datatxt0149,
        CASE
            WHEN orderhenkan.datatxt0149 is null THEN NULL
            ELSE concat(categorykanriDatatxt0149.category2,' ',categorykanriDatatxt0149.category4) END as datatxt0149_detail,
        --orderhenkan.date0016,
        to_char(orderhenkan.date0016, 'YYYY/MM/DD') as date0016,
        to_char(orderhenkan.date0017, 'YYYY/MM/DD') as date0017,
        --orderhenkan.datatxt0155,
        datatxt0155Tantousya.name as changer_name,
        replace(replace(datatxt0155Tantousya.name,' ',''),'　','') as changer_name_search,
        substring(replace(replace(datatxt0155Tantousya.name,' ',''),'　',''),1,3) as changer_name_short,
        tuhanorder.information1,
        tuhanorder.information3,
        hikiatenyuko.dataint03,
        concat(dataint03Request.syouhinbango,' ',dataint03Request.jouhou) as dataint03_detail,
        hikiatenyuko.dataint04,
        concat(dataint04Request.syouhinbango,' ',dataint04Request.jouhou) as dataint04_detail,
        hikiatenyuko.datachar01,
        datachar01Tantousya.name as inspector_name,
        replace(replace(datachar01Tantousya.name,' ',''),'　','') as inspector_name_search,
        substring(replace(replace(datachar01Tantousya.name,' ',''),'　',''),1,3) as inspector_name_short,
        hikiatenyuko.dataint06,
        concat(dataint06Request.syouhinbango,' ',dataint06Request.jouhou) as dataint06_detail,
        datachar09Tantousya.datatxt0003,
        datachar09Tantousya.datatxt0004,
        datachar09Tantousya.mail4,
        (select count(*) from tantousya as tmp_tantousya where tmp_tantousya.datatxt0004 = orderhenkan.datatxt0149 AND tmp_tantousya.datatxt0003 = '$tmp_datatxt0003' AND tmp_tantousya.datatxt0004 = '$tmp_datatxt0004' and mail4 = 'C320') as valid_order_count
        --datatxt0004Tantousya.datatxt0003 as datatxt0003_2,
        --datatxt0004Tantousya.datatxt0004 as datatxt0004_2,
        --datatxt0004Tantousya.mail4 as mail4_2
        
        from (select max(orderbango) as orderbango, syouhinid, sum(dataint05*syukkasu) as support_amount from misyukko group by syouhinid) as temp_misyukko
        
        --join orderhenkan on orderhenkan.bango = temp_misyukko.orderbango
        --AND orderhenkan.kokyakuorderbango = temp_misyukko.syouhinid
        
        join orderhenkan on orderhenkan.orderuserbango = temp_misyukko.syouhinid
        
        join orderhenkan_m on orderhenkan_m.kokyakuorderbango = orderhenkan.kokyakuorderbango
        AND orderhenkan_m.maxval = orderhenkan.ordertypebango2
        
        join tuhanorder on tuhanorder.juchubango = orderhenkan.orderuserbango
        --AND tuhanorder.juchubango = orderhenkan.kokyakuorderbango
        
        join hikiatenyuko on hikiatenyuko.syouhinid = orderhenkan.kokyakuorderbango
        
        join orderhenkan_inner_data on orderhenkan_inner_data.kokyakuorderbango = orderhenkan.orderuserbango
        
        left join tantousya as datachar09Tantousya on datachar09Tantousya.bango = orderhenkan.datachar09
        --left join tantousya as datatxt0004Tantousya on datatxt0004Tantousya.datatxt0004 = orderhenkan.datatxt0149
        
        left join tantousya as datatxt0155Tantousya on datatxt0155Tantousya.bango = orderhenkan.datatxt0155
        
        left join tantousya as datachar01Tantousya on datachar01Tantousya.bango = hikiatenyuko.datachar01
        
        left join categorykanri as categorykanriDatatxt0149
        on substring(orderhenkan.datatxt0149,1,2) = categorykanriDatatxt0149.category1
        and substring(orderhenkan.datatxt0149,3,5) = categorykanriDatatxt0149.category2
        
        --datachar10
        left join v_torihikisaki as datachar10Detail on
        datachar10Detail.torihikisaki_cd = orderhenkan.datachar10
        --datachar10 end
        
        --datachar11
        left join v_torihikisaki as datachar11Detail on
        datachar11Detail.torihikisaki_cd = orderhenkan.datachar11
        --datachar11 end
        
        left join request as dataint03Request on dataint03Request.syouhinbango = hikiatenyuko.dataint03
        AND dataint03Request.color = '0507PDF作成フラグ'
        
        left join request as dataint04Request on dataint04Request.syouhinbango = hikiatenyuko.dataint04
        AND dataint04Request.color = '0507PDFダウンロードフラグ'
        
        left join request as dataint06Request on dataint06Request.syouhinbango = hikiatenyuko.dataint06
        AND dataint06Request.color = '0507検印フラグ'
        
        ");

        $start_date = $req_data['start_date'];
        $end_date = $req_data['end_date'];
        $sql = " (date(date) between '$start_date' and '$end_date') AND datachar02 = 'V413' ";
        
        if(isset($req_data['information1']) && $req_data['information1'] != ""){
            $information1 = substr($req_data['information1'], 0,6);
            $sql .= " AND substring(information1,1,6) = '$information1'";            
        } 
        
        if(isset($req_data['information3']) && $req_data['information3'] != ""){
            $information3 = substr($req_data['information3'], 0,6);
            $sql .= " AND substring(information3,1,6) = '$information3'";            
        } 
        
        if(isset($req_data['creation_category']) && $req_data['creation_category'] != ""){
            $creation_category = $req_data['creation_category'];
            if($creation_category == 1){
                $sql .= " AND dataint03 = 1";
            }else if($creation_category == 2){
                $sql .= " AND dataint03 = 2";
            }else if($creation_category == 3){
                $sql .= " AND (dataint03 = 1 or dataint03 = 2)";
            }
        } 
        
        if(isset($req_data['seal_classification']) && $req_data['seal_classification'] != ""){
            $seal_classification = $req_data['seal_classification'];
            if($seal_classification == 1){
                $sql .= " AND dataint06 = 1";
            }else if($seal_classification == 2){
                $sql .= " AND dataint06 = 2";
            }else if($seal_classification == 3){
                $sql .= " AND (dataint06 = 1 or dataint06 = 2)";
            }
        } 
        
        if(isset($req_data['rd1'])){
            $rd1 = $req_data['rd1'];
            $datatxt0003 = $req_data['datatxt0003'];
            $datatxt0004 = $req_data['datatxt0004'];
            if($rd1 == 10){
                if($datatxt0004 != ""){
                    $sql .= " AND datatxt0003 = '$datatxt0003' AND datatxt0004 = '$datatxt0004' AND mail4 = 'C310'";
                }else{
                    $sql .= " AND datatxt0003 = '$datatxt0003' AND mail4 = 'C310'";
                }
                
            }else if($rd1 == 20){
                if($datatxt0004 != ""){
                    //$sql .= " AND datatxt0003_2 = '$datatxt0003' AND datatxt0004_2 = '$datatxt0004' AND mail4_2 = 'C320'";
                    //$sql .= " AND datatxt0003 = '$datatxt0003' AND datatxt0004 = '$datatxt0004' AND mail4 = 'C320'";
                    $sql .= " AND datatxt0003 = '$datatxt0003' AND valid_order_count > 0";
                }else{
                    //$sql .= " AND datatxt0003_2 = '$datatxt0003' AND mail4_2 = 'C310'";
                    $sql .= " AND datatxt0003 = '$datatxt0003' AND mail4 = 'C310'";
                }
                
            }
        } 
        
        $data=DB::table('support_req_confirmation_temp')->whereRaw($sql);

        return $data;
        
    }
}
