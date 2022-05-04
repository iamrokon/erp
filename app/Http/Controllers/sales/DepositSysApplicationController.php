<?php


namespace App\Http\Controllers\sales;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\AllClass\master\CSVLogger;
use App\AllClass\db\QueryHandler;
use App\Helpers\Helper;
Use \Carbon\Carbon;

class DepositSysApplicationController extends Controller
{
    public function index(){
        $bango = request('userId');
        $tantousya = QueryHelper::select(['bango','name'])->from('tantousya')->where("bango = '$bango' ")->get()->first();

        return view('sales.depositSysApplication.index',compact('bango','tantousya'));
    }
    
    public function importCSV(Request $request){
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $bango = request('userId');
        $tantousya = QueryHelper::select(['bango','name'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $request_data = $request->all();
        
        $rules=[];
        $rules['filename'] = ['required','mimes:csv,txt'];
        
        $message=[];    
        $message['required']='必須項目に入力がありません。';
        $message['mimes']='取込ファイルを確認してください。';

        $attributes = [
            'filename' => 'ファイル',
        ];
        
        $validator = Validator::make($request_data,$rules,$message,$attributes); 
        $errors = $validator->errors();
        if($errors->any()){ 
            $error_msgs = $errors->all();
            return ['err_field' => $errors, 'err_msg' => $error_msgs];
        }else if(!$errors->any() && request('submit_confirmation') == ""){
            return "confirmation_msg";
        }else{
            $jhead = [
                "処理番号" => "processing_number",
                "顧客番号" => "customer_number",
                "顧客名" => "customer_name",
                "請求部門コード" => "billing_department_code",
                "請求番号" => "billing_number",
                "請求方法コード" => "billing_method_code",
                "請求方法名" => "billing_method_name",
                "請求日" => "billing_date",
                "締日" => "closing_date",
                "入金予定日" => "planned_deposit_date",
                "請求額" => "billing_amount",
                "請求汎用数値項目０１" => "billing_gp_numeric_item_01",
                "請求汎用数値項目０２" => "billing_gp_numeric_item_02",
                "請求汎用数値項目０３" => "billing_gp_numeric_item_03",
                "請求汎用数値項目０４" => "billing_gp_numeric_item_04",
                "請求汎用数値項目０５" => "billing_gp_numeric_item_05",
                "請求汎用文字項目０１" => "billing_gc_item_01",
                "請求汎用文字項目０２" => "billing_gc_item_02",
                "請求汎用文字項目０３" => "billing_gc_item_03",
                "請求汎用文字項目０４" => "billing_gc_item_04",
                "請求汎用文字項目０５" => "billing_gc_item_05",
                "請求汎用日付項目０１" => "billing_general_date_item_01",
                "請求汎用日付項目０２" => "billing_general_date_item_02",
                "請求汎用日付項目０３" => "billing_general_date_item_03",
                "請求汎用日付項目０４" => "billing_general_date_item_04",
                "請求汎用日付項目０５" => "billing_general_date_item_05",
                "入金日" => "torikomidate",
                "入金顧客番号" => "deposit_cus_number",
                "入金顧客名" => "deposit_customer_name",
                "入金部門コード" => "deposit_department_code",
                "入金番号" => "deposit_number",
                "入金方法コード" => "deposit_method_code",
                "入金方法名" => "deposit_method_name",
                "入金金額" => "deposit_amount",
                "依頼人コード" => "client_code",
                "依頼人名" => "client_name",
                "仕向銀行名" => "destination_bank_name",
                "仕向支店名" => "destination_branch_name",
                "備考１" => "remark1",
                "備考２" => "remark2",
                "備考３" => "remark3",
                "備考４" => "remark4",
                "手形番号" => "bill_number",
                "手形銀行コード" => "bill_bank_code",
                "形支店コード" => "form_branch_code",
                "期日" => "due_date",
                "振出日" => "draw_date",
                "振出人" => "drawer",
                "消込日" => "application_date",
                "消込金額" => "application_amount",
                "消込メモ" => "application_memo",
                "消込実行者" => "applyer",
            ];
            
            //remove empty line, total header column 52
            try {
                $path = $request->file('filename')->getRealPath();
                $data = array_map('str_getcsv', file($path));        
                $csv_data = array_slice($data, 1, count($data));
                $result = array();
                $len = count($data);
                $data[0] = self::replaceJapaneseHead($data[0], $jhead);
                for ($i = 1; $i < $len; $i++) {
                    $result[] = array_combine($data[0], $data[$i]);
                }
            
                $count = 0;
                foreach ($result as $key=>$val) {
                    foreach ($jhead as $key1=>$val1) {
                        if($val[$val1] == ""){
                         $count++;   
                        }
                        
                        //check double quotation for every cell
                        //if(strpos($val[$val1],'“') !== false){
                        //    $result[$key][$val1] = str_replace('”',"",str_replace('“',"",$val[$val1]));
                        //}else{
                        //    return 'invalid_csv';
                        //}
                        
                    }
                    if($count == 52){
                        unset($result[$key]);
                    }
                    $count = 0;
                }

                if(count($result) < 1){
                    return "no_data";
                }
            } catch (\Exception $e) {
                return 'invalid_csv';
            }

            $errors = null;
            $status = "not ok";
            $import_status = "";

            $input = request()->all();
            $len = count($result);
            $status = $this->csvValidator($result);

            if ($status == "ok") {
                if(request('submit_confirmation') == ""){
                    return "confirmation_msg";
                }
            } else {
                $errors = $status;
                return $errors;
            }
            
            $temp_result = collect($result)->sortBy('billing_general_date_item_02');
            
            //convert utf-8 to shift-jis
            $result = array();
            foreach($temp_result as $temp_key=>$temp_val){
                foreach($temp_val as $temp_key2=>$temp_val2){
                    $result[$temp_key][$temp_key2] = mb_convert_encoding($temp_val2, "UTF-8", "SJIS");
                }
            }
            
            $temp_datachar10 = "";
            $temp_deposit_number = "";
            $temp_datachar10_2 = "";
            $temp_deposit_method_code = "";
            $temp_group_val = "";
            $condition_status = "";
            $shinkurokokyakugroup = 0;
            $moneymax = 1;
            $temp_modified_orderbango = "";
            $review_update = "";
            $total = 0;

            if ($status == "ok") {
                //start log query
                $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 入金消込SYS消込データ取込 start\n";
                QueryHandler::logger($bango,$log_data);

                $conn = pg_connect("host=".env("DB_HOST")." port=".env("DB_PORT")."  dbname=".env("DB_DATABASE")." user=".env("DB_USERNAME")." password=".env("DB_PASSWORD"));
                pg_query($conn,"BEGIN");
                try {
                    foreach ($result as $row) {
                        $input = $row;
                        //$input=TableHeaders::defineInput($input);
                        
                        //$datachar10 = $input['billing_general_date_item_02'];
                        $datachar10 = $input['billing_gc_item_04'];
                        $col020 = $input['billing_gc_item_04'];
                        $col031 = $input['deposit_number'];
                        $orderhenkanData = QueryHelper::fetchSingleResult("select count(bango) from orderhenkan where datachar10 = '$datachar10'");
                        $daikinseisanoldData = QueryHelper::fetchSingleResult("select count(otodoketime) as count_otodoketime from daikinseisanold where otodoketime = '$datachar10'");
                       
                        //$customer_number = str_pad($input['customer_number'],5,'0',STR_PAD_LEFT);
                        $customer_number = $input['customer_number'];
                        $isvalid_companay_code = 'yes';
                        if(strlen($customer_number) == 8){
                           $chumonsyaname = $input['customer_number']; 
                           $shikibetsucode = substr($chumonsyaname,0,6);
                           $torihikisakibango = substr($chumonsyaname,6,2);
                           $haisouData = QueryHelper::fetchSingleResult("select count(bango) as count_haisoubango from haisou where shikibetsucode = '$shikibetsucode' AND torihikisakibango = '$torihikisakibango'");
                           if($haisouData && $haisouData->count_haisoubango > 0){
                               //$condition_status = "ok";
                               $isvalid_companay_code = 'yes';
                           }else{
                               //$condition_status = "not_ok";
                               $isvalid_companay_code = 'no';
                           }
                           
                        }else{
                            $temp_chumonsyaname = QueryHelper::fetchResult("
                                select concat(haisou.shikibetsucode,haisou.torihikisakibango) as cus_number
                                from haisou
                                join others2 on others2.otherint1 = haisou.bango
                                where others2.other36 = '$customer_number'
                                order by cus_number
                                ");
                            if(count($temp_chumonsyaname) > 1){
                                //$chumonsyaname = QueryHelper::fetchSingleResult("
                                //select concat(kokyaku1.yobi12,'01') as cus_number
                                //from kokyaku1
                                //join haisoujouhou on haisoujouhou.syukei1 = kokyaku1.bango
                                //where haisoujouhou.syukeinen = '$customer_number'
                                //")->cus_number?? null;
                                $chumonsyaname = $temp_chumonsyaname[0]->cus_number;
                            }else if(count($temp_chumonsyaname) == 1){
                                $chumonsyaname = $temp_chumonsyaname[0]->cus_number;
                            }else{
                                $chumonsyaname = null;
                            }
                        }
                        
                        $categorykanriPatternsub2 = QueryHelper::fetchSingleResult("
                                select count(patternsub2) as count_patternsub2
                                from categorykanri
                                where categorykanri.category1 = 'A9' AND patternsub2 IN('50','51','55','56')
                                ");
                        
                        //check deposit_method_code as a group of 52 and 57 for same datachar10
                        if($input['billing_gc_item_04'] == $temp_datachar10_2){
                            //$current_group_val = $input['processing_number'].$input['customer_number'].$input['torikomidate'].$input['deposit_cus_number'];
                            $current_group_val = $input['processing_number'].$chumonsyaname.$input['torikomidate'].$input['deposit_cus_number'];
                            $count_deposit_method_code = count(collect($result)->where('billing_gc_item_04',$temp_datachar10_2)->whereNotIn('deposit_method_code',array(52, 57)));
                            if($temp_group_val == $current_group_val && $count_deposit_method_code == 0){
                                if($orderhenkanData->count > 0 && $chumonsyaname != null && $categorykanriPatternsub2->count_patternsub2 < 1){
                                    $condition_status = "ok";
                                }else{
                                    $condition_status = "not_ok";
                                }
                            }else{
                               if($orderhenkanData->count > 0 && $daikinseisanoldData->count_otodoketime < 1 && $chumonsyaname != null && $categorykanriPatternsub2->count_patternsub2 < 1){
                                    $condition_status = "ok";
                                }else{
                                    $condition_status = "not_ok";
                                } 
                            }
                        }else{
                            $temp_datachar10_2 = $input['billing_gc_item_04'];
                            $temp_deposit_method_code = $input['deposit_method_code'];
                            //$temp_group_val = $input['processing_number'].$input['customer_number'].$input['torikomidate'].$input['deposit_cus_number'];
                            $temp_group_val = $input['processing_number'].$chumonsyaname.$input['torikomidate'].$input['deposit_cus_number'];
                            if($orderhenkanData->count > 0 && $daikinseisanoldData->count_otodoketime < 1 && $chumonsyaname != null && $categorykanriPatternsub2->count_patternsub2 < 1){
                                $condition_status = "ok";
                            }else{
                                $condition_status = "not_ok";
                            }
                        }
                        
                        if($condition_status == "ok" && $isvalid_companay_code == "yes")
                            {
                            //orderbango
                            $reviewData = QueryHelper::fetchSingleResult("select orderbango,mobile_flag from review where kokyakusyouhinbango = 'D7061'");
                            if($reviewData){
                                $orderbango = $reviewData->orderbango ;
                                $mobile_flag = $reviewData->mobile_flag ;
                            }else{
                                $orderbango = "";
                                $mobile_flag = "";
                            }
                            $reviewData2 = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7501'");
                            if($reviewData2){
                                $temp_orderbango = $reviewData2->orderbango ;
                            }else{
                                $temp_orderbango = "";
                            }
                            $modified_orderbango = "18".$temp_orderbango.str_pad($orderbango+1,$mobile_flag,'0',STR_PAD_LEFT );

                            $deposit_method_code = $input['deposit_method_code'];
                            $soufusakiname = QueryHelper::fetchSingleResult("
                                select concat(categorykanri.category1,categorykanri.category2) as deposit_method_code
                                from categorykanri
                                where categorykanri.category1 = 'A9' AND categorykanri.patternsub2 = '$deposit_method_code'
                                ")->deposit_method_code?? null;

                            $destination_bank = $input['destination_bank_name'];
                            $soufusakiyubinbango = QueryHelper::fetchSingleResult("
                                select concat(categorykanri.category1,categorykanri.category2) as destination_bank
                                from categorykanri
                                where categorykanri.category1 = 'H2' AND categorykanri.patternsub2 = '$destination_bank'
                                ")->destination_bank?? null;
                            if($soufusakiyubinbango == 'H201'){
                               $unsoumei = 'H31'; 
                            }elseif($soufusakiyubinbango == 'H202'){
                               $unsoumei = 'H32'; 
                            }elseif($soufusakiyubinbango == 'H203'){
                               $unsoumei = 'H33'; 
                            }elseif($soufusakiyubinbango == 'H204'){
                               $unsoumei = 'H34'; 
                            }else{
                                $unsoumei = null; 
                            }


                            if($input['deposit_number'] == $temp_deposit_number){
                                $shinkurokokyakugroup = $shinkurokokyakugroup + 1;
                                $modified_orderbango = $temp_modified_orderbango;
                                $review_update = "not_ok";
                            }else{
                                $shinkurokokyakugroup = 1;
                                $temp_deposit_number = $input['deposit_number'];
                                $temp_modified_orderbango = $modified_orderbango;
                                $review_update = "ok";
                            }

                            $daikinseisan_insert_data = [
                                'shinkurokokyakuname' => $modified_orderbango,
                                'shinkurokokyakugroup' => $shinkurokokyakugroup,
                                'shinkurokokyakuorderbango' => 0,
                                'torikomidate' => $input['torikomidate'],
                                'chumonsyaname' => $chumonsyaname,
                                'soufusakiname' => $soufusakiname,
                                'soufusakiyubinbango' => $soufusakiyubinbango,
                                'unsoumei' => $unsoumei,
                                'unsoudaibikitesuryou' => null,
                                'nyukingaku' => $input['application_amount'],
                                'chumondate' => str_replace("/","-",$input['due_date']),
                                'toiawasebango' => null,
                                'seisanunsoumei' => $bango,
                                'dataint02' => 1,
                                'dataint03' => null,
                                'datachar01' => null,
                                'datachar02' => null,
                                'datachar03' => null,
                                'dataint01' => 0,
                                'nyukinbi2' => Carbon::now()->setTimezone("Asia/Tokyo")->format('Y-m-d H:i:s'),
                                'henpinbi' => Carbon::now()->setTimezone("Asia/Tokyo")->format('Y-m-d H:i:s'),
                                'henpindenpyobango' => $bango,
                            ];
                            $daikinseisan = QueryHelper::insertData('daikinseisan',$daikinseisan_insert_data,'shinkurokokyakuname',true,$bango,__CLASS__,__FUNCTION__,__LINE__);


                            $eczaikorendou_insert_data = [
                                'sitename' => $modified_orderbango,
                                'yukouflag' => 1,
                                'tsuchimail' => 2,
                                'rendoumail' => 1,
                                'siterank' => null,
                                'sitesyubetsu' => null,
                                'ftphost' => null,
                                'ftpid' => null,
                                'ftppw' => null,
                                'ftpport' => null,
                                'check01' => 0,
                                'apichecktime' => Carbon::now()->setTimezone("Asia/Tokyo")->format('Y-m-d H:i:s'),
                                'apitime01' => Carbon::now()->setTimezone("Asia/Tokyo")->format('Y-m-d H:i:s'),
                                'apiid01' => $bango,
                            ];
                            $eczaikorendou = QueryHelper::insertData('eczaikorendou',$eczaikorendou_insert_data,'sitename',true,$bango,__CLASS__,__FUNCTION__,__LINE__);

                            //orderbango2
                            $reviewData2 = QueryHelper::fetchSingleResult("select orderbango,mobile_flag from review where kokyakusyouhinbango = 'D7062'");
                            if($reviewData2){
                                $orderbango2 = $reviewData2->orderbango ;
                                $mobile_flag2 = $reviewData2->mobile_flag ;
                            }else{
                                $orderbango2 = "";
                                $mobile_flag2 = "";
                            }
                            $reviewData3 = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7501'");
                            if($reviewData3){
                                $temp_orderbango2 = $reviewData3->orderbango ;
                            }else{
                                $temp_orderbango2 = "";
                            }
                            
                            $modified_orderbango2 = "05".$temp_orderbango2.str_pad($orderbango2+1,$mobile_flag2,'0',STR_PAD_LEFT );
                            $daikinseisanold_insert_data = [
                                'shinkurokokyakuorderbango' => $modified_orderbango2,
                                'shinkurokokyakuname' => $modified_orderbango,
                                'shinkurokokyakugroup' => $shinkurokokyakugroup,
                                'otodoketime' => $col020,
                                'moneymax' => $moneymax,
                                'nyukingaku' => $input['application_amount'],
                                'soufusakiname' => 2,
                                'soufusakiyubinbango' => 2,
                                'unsoudaibikitesuryou' => 0,
                                'nyukinbi' => Carbon::now()->setTimezone("Asia/Tokyo")->format('Y-m-d H:i:s'),
                                'shiharaikubun' => $bango,

                            ];
                            $daikinseisanold = QueryHelper::insertData('daikinseisanold',$daikinseisanold_insert_data,'shinkurokokyakuname',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                            $moneymax++;
                            $total++;
                            
                            //update review data
                            if($review_update == "ok"){
                            $review_update_data = [
                                'kokyakusyouhinbango' => 'D7061',
                                'orderbango' => $orderbango+1,
                                'check_flag' => 0,
                                'color' => $mytime,
                                'size' => Helper::getSystemIP(),
                                'nickname' => $bango,
                            ];
                            $reviewUpdate = QueryHelper::updateData('review',$review_update_data,'kokyakusyouhinbango',$bango,__CLASS__,__FUNCTION__,__LINE__);
                            }
                            
                            //hikiatesyukko update starts
                            $temp_daikinseisanold = QueryHelper::fetchSingleResult("
                                select 
                                COALESCE(sum(daikinseisanold.nyukingaku),0) as sum_of_nyukingaku,
                                --COALESCE(sum(syukkoold.syukkasu*syukkoold.dataint04),0) as sum_of_nyukin,
                                --COALESCE(sum(syukkoold.datachar20::int),0) as sum_of_tax,
                                tuhanorder.orderbango,
                                tuhanorder.numeric3,
                                tuhanorder.numeric4
                                from daikinseisanold
                                join tuhanorder on tuhanorder.juchukubun2 = daikinseisanold.otodoketime
                                --join syukkoold on  syukkoold.kaiinid = daikinseisanold.otodoketime
                                join hikiatesyukko on  hikiatesyukko.orderbango = tuhanorder.orderbango
                                where daikinseisanold.otodoketime = '$datachar10' 
                                --and substring(syukkoold.datachar13,1,1) = '3'
                                group by tuhanorder.orderbango
                                ");
                            
                           $temp_syukkoold = QueryHelper::fetchSingleResult("
                                select 
                                COALESCE(sum(syukkoold.syukkasu*syukkoold.dataint04),0) as sum_of_nyukin,
                                COALESCE(sum(syukkoold.datachar20::int),0) as sum_of_tax
                                from daikinseisanold
                                join syukkoold on  syukkoold.kaiinid = daikinseisanold.otodoketime
                                where daikinseisanold.otodoketime = '$datachar10' 
                                and substring(syukkoold.datachar13,1,1) = '3'
                                ");
                           
                            if($temp_daikinseisanold){
                                $orderbango = $temp_daikinseisanold->orderbango;
                                $sum_of_nyukingaku = $temp_daikinseisanold->sum_of_nyukingaku;
                                $sum_of_nyukin = $temp_syukkoold->sum_of_nyukin;
                                $sum_of_tax = $temp_syukkoold->sum_of_tax;
                                $numeric3 = $temp_daikinseisanold->numeric3;
                                $numeric4 = $temp_daikinseisanold->numeric4;
                                if($sum_of_nyukingaku == ($numeric3+$numeric4-$sum_of_nyukin-$sum_of_tax)){
                                    $hikiatesyukko_update_data = [
                                        'orderbango' => $orderbango,
                                        'dataint01' => 1,
                                        'idoutanabango' => static::getCurrentTime(),
                                        'tantousyabango' => $bango,
                                        'datachar05' => $bango
                                    ];
                                    $hikiatesyukko = QueryHelper::updateData('hikiatesyukko', $hikiatesyukko_update_data, ['orderbango' => $orderbango], true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                                }
                            }
                            //hikiatesyukko update ends
                            
                            //update orderhenkan data
                            $orderhenkanTempData = QueryHelper::fetchSingleResult("select orderhenkan.bango,orderhenkan.intorder03,tuhanorder.unsoudaibikitesuryou,tuhanorder.unsoutesuryou from orderhenkan join tuhanorder on tuhanorder.orderbango = orderhenkan.bango where datachar10 = '$datachar10' ");
                            if($orderhenkanTempData && ($orderhenkanTempData->unsoudaibikitesuryou == '2' && $orderhenkanTempData->unsoutesuryou == '2')){
                                $orderhenkan_update_data = [
                                    'bango' => $orderhenkanTempData->bango,
                                    'intorder05' => $orderhenkanTempData->intorder03,
                                ];
                                $orderhenkanUpdate = QueryHelper::updateData('orderhenkan', $orderhenkan_update_data, 'bango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                            }else{
                                $orderhenkan_update_data = [
                                    'bango' => $orderhenkanTempData->bango,
                                    'intorder05' => str_replace("/", "", $input['torikomidate']),
                                ];
                                $orderhenkanUpdate = QueryHelper::updateData('orderhenkan', $orderhenkan_update_data, 'bango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                            }
                            
                            $import_status = "ok";
                            
                        }else{
                            pg_query($conn,"ROLLBACK");
                            if($orderhenkanData->count < 1){
                                $err_msg[] = "消込対象の売上データが存在しないため、処理を終了します。";
                                $err_msg[] = "UTOPIA入金番号 $col031  売上番号 $col020";
                                session()->flash("err_msg",$err_msg);
                            }
                            if($daikinseisanoldData->count_otodoketime > 0){
                                $err_msg2[] = "消込対象の売上番号は入金消込済のため、処理を終了します。";
                                $err_msg2[] = "UTOPIA入金番号 $col031  売上番号 $col020";
                                session()->flash("err_msg2",$err_msg2);
                            }
                            if($chumonsyaname == null){
                                $err_msg3[] = "顧客番号が存在しないため、処理を終了します。";
                                //$err_msg3[] = "UTOPIA入金番号 $col031  売上番号 $col020";
                                $err_msg3[] = "UTOPIA入金番号 $col031  顧客番号 $customer_number";
                                session()->flash("err_msg3",$err_msg3);
                            }
                            if($categorykanriPatternsub2->count_patternsub2 > 0){
                                $err_msg4[] = "入金方法を確認してください。";
                                $err_msg4[] = "UTOPIA入金番号 $col031  売上番号 $col020";
                                session()->flash("err_msg4",$err_msg4);
                            }
                            if($isvalid_companay_code == 'no'){
                                $err_msg5[] = "顧客番号が存在しないため、処理を終了します。";
                                //$err_msg5[] = "UTOPIA入金番号 $col031  顧客番号 $customer_number";
                                $err_msg5[] = "UTOPIA入金番号 $col031  顧客番号 $customer_number";
                                session()->flash("err_msg5",$err_msg5);
                            }
                            return "ng";
                        }
                    }

                    if(isset($orderbango2)){
                        //update review data
                        $review_update_data2 = [
                            'kokyakusyouhinbango' => 'D7062',
                            'orderbango' => $orderbango2+1,
                            'check_flag' => 0,
                            'color' => $mytime,
                            'size' => Helper::getSystemIP(),
                            'nickname' => $bango,
                        ];
                        $reviewUpdate2 = QueryHelper::updateData('review',$review_update_data2,'kokyakusyouhinbango',$bango,__CLASS__,__FUNCTION__,__LINE__);
                    }

                    //end log query
                    $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 入金消込SYS消込データ取込 end\n";
                    QueryHandler::logger($bango,$log_data);

                    pg_query($conn, "COMMIT");
                    if($import_status == 'ok'){
                        $msg = "正常に終了しました。（".$total."件）";
                        session()->flash("success_msg",$msg);
                    }else{
                        session()->flash("success_msg","Something went wrong!");
                    }
                    return "ok";

                } catch (\Exception $e) {
                    $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                    QueryHandler::logger($bango, $log_data);
                    pg_query($conn,"ROLLBACK");
                    return 'invalid_csv';
                }

            } else {
                dd("err");
            }
        }
    }
    
    
    public static function replaceJapaneseHead($data , $jhead){
        $len = count($data);
        for ($i = 0; $i < $len; $i++) {
            $data[$i]= trim($data[$i],"﻿﻿﻿﻿") ;
        }
        
        for ($i = 0; $i < $len; $i++) {
            try {
                $data[$i] = array_values($jhead)[$i];
            }
            catch (\Exception $e){

            }
        }
        return $data;
    }
    
    public function csvValidator($row){
        $rules=[];
        //$rules['*.processing_number'] = ['bail','required','max:20'];
        //$rules['*.customer_number'] = ['bail','required','max:20'];
        //$rules['*.billing_gc_item_04'] = ['bail','required'];
        //$rules['*.torikomidate'] = ['bail','required','max:10','date'];
        //$rules['*.deposit_cus_number'] = ['bail','required','max:20'];
        //$rules['*.deposit_number'] = ['bail','required','max:12','regex:/^[0-9]+$/'];
        //$rules['*.deposit_method_code'] = ['bail','required','max:2','regex:/^[0-9]+$/'];
        //$rules['*.due_date'] = ['bail','nullable','max:10','date'];
        //$rules['*.application_amount'] = ['bail','nullable','max:12','regex:/^[0-9]+$/'];
        foreach ($row as $key => $value) {
            $rules[$key.'.'.'processing_number'] = ['bail','required','max:20'];
            $rules[$key.'.'.'customer_number'] = ['bail','required','max:20'];
            $rules[$key.'.'.'billing_gc_item_04'] = ['bail','required'];
            $rules[$key.'.'.'torikomidate'] = ['bail','required','max:10','date'];
            $rules[$key.'.'.'deposit_cus_number'] = ['bail','required','max:20'];
            $rules[$key.'.'.'deposit_number'] = ['bail','required','max:12','regex:/^[0-9]+$/'];
            $rules[$key.'.'.'deposit_method_code'] = ['bail','required','max:2','regex:/^[0-9]+$/'];
            $rules[$key.'.'.'due_date'] = ['bail','nullable','max:10','date'];
            $rules[$key.'.'.'application_amount'] = ['bail','nullable','max:12','regex:/^[0-9]+$/'];
        }
        
        $message=[];    
        //$message['*.required'] = '取込ファイルを確認してください。(:attribute)';
        //$message['*.max'] = '取込ファイルを確認してください。(:attribute)';
        //$message['*.regex'] = '取込ファイルを確認してください。(:attribute)';
        //$message['*.date'] = '取込ファイルを確認してください。(:attribute)';
        foreach ($row as $key => $value) {
            $temp_key = $key + 1;
            $message[$key.'.'.'processing_number'.'.'.'required'] = "取込ファイルを確認してください。【".$temp_key.".処理番号】";
            $message[$key.'.'.'processing_number'.'.'.'max'] = "取込ファイルを確認してください。【".$temp_key.".処理番号】";
            
            $message[$key.'.'.'customer_number'.'.'.'required'] = "取込ファイルを確認してください。【".$temp_key.".顧客番号】";
            $message[$key.'.'.'customer_number'.'.'.'max'] = "取込ファイルを確認してください。【".$temp_key.".顧客番号】";
            
            $message[$key.'.'.'billing_gc_item_04'.'.'.'required'] = "取込ファイルを確認してください。【".$temp_key.".請求汎用文字項目０４】";
            
            $message[$key.'.'.'torikomidate'.'.'.'required'] = "取込ファイルを確認してください。【".$temp_key.".入金日】";
            $message[$key.'.'.'torikomidate'.'.'.'max'] = "取込ファイルを確認してください。【".$temp_key.".入金日】";
            $message[$key.'.'.'torikomidate'.'.'.'date'] = "取込ファイルを確認してください。【".$temp_key.".入金日】";
            
            $message[$key.'.'.'deposit_cus_number'.'.'.'required'] = "取込ファイルを確認してください。【".$temp_key.".入金顧客番号】";
            $message[$key.'.'.'deposit_cus_number'.'.'.'max'] = "取込ファイルを確認してください。【".$temp_key.".入金顧客番号】";
            
            $message[$key.'.'.'deposit_number'.'.'.'required'] = "取込ファイルを確認してください。【".$temp_key.".入金番号】";
            $message[$key.'.'.'deposit_number'.'.'.'max'] = "取込ファイルを確認してください。【".$temp_key.".入金番号】";
            $message[$key.'.'.'deposit_number'.'.'.'regex'] = "取込ファイルを確認してください。【".$temp_key.".入金番号】";
            
            $message[$key.'.'.'deposit_method_code'.'.'.'required'] = "取込ファイルを確認してください。【".$temp_key.".入金方法コード】";
            $message[$key.'.'.'deposit_method_code'.'.'.'max'] = "取込ファイルを確認してください。【".$temp_key.".入金方法コード】";
            $message[$key.'.'.'deposit_method_code'.'.'.'regex'] = "取込ファイルを確認してください。【".$temp_key.".入金方法コード】";
            
            $message[$key.'.'.'due_date'.'.'.'max'] = "取込ファイルを確認してください。【".$temp_key.".期日】";
            $message[$key.'.'.'due_date'.'.'.'date'] = "取込ファイルを確認してください。【".$temp_key.".期日】";
            
            $message[$key.'.'.'application_amount'.'.'.'max'] = "取込ファイルを確認してください。【".$temp_key.".消込金額】";
            $message[$key.'.'.'application_amount'.'.'.'regex'] = "取込ファイルを確認してください。【".$temp_key.".消込金額】";
        }
        
        $validation = \Validator::make($row,$rules,$message);

        if ($validation->passes()) {
            return "ok";
        } else {
            $errors = $validation->errors();
            $error_msgs = $validation->errors()->all();
            return ['err_field' => $errors, 'err_msg' => $error_msgs];
        }
    }
    
    public static function defineInput($input){
        !empty($input["shinkurokokyakuname"])?$input["shinkurokokyakuname"]:$input["shinkurokokyakuname"]=""; //=sprintf('%04d', $input["code"])
        //!empty($input["name1"])?:$input["name1"]="";
        return $input;
    }
    
    public static function getCurrentTime(){
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        return str_replace(" ", "", $mytime);
    }
    

}
