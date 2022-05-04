<?php


namespace App\AllClass\purchase\purchaseSlip;

use App\AllClass\db\QueryHandler;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\zenkaku;
use App\Helpers\Helper;
use Illuminate\Support\Carbon;
use App\AllClass\purchase\purchaseSlip\PurchaseSlipValidation;
use App\AllClass\purchase\purchaseSlip\HolidayCalculation;


class PurchaseSlip
{   
    public static $line;
    public static $supplier_cd;
    public static function createEdit($request, $bango)
    {
        $validator = PurchaseSlipValidation::handle(request()->all());
        $errors = $validator->errors();
        //dd(abs($request['price_tax_total']) > 2147483647);
        $result = [];
        if ($errors->any()) {
            $result['status'] = 'ng';
            $result['err_msg'] = $errors->all();
            $result['err_field'] = $errors->keys();
        }elseif (!$errors->any() && (abs($request['total_price']) > 2147483647 || abs($request['total_tax']) > 2147483647 || abs($request['price_tax_total']) > 2147483647)) {
                $result['status'] = 'error_int_limit_exceed';
                if(abs($request['total_price']) > 2147483647){
                    $result['total_price_error'] = 1;
                }else{
                    $result['total_price_error'] = 0;
                }
                if(abs($request['total_tax']) > 2147483647){
                    $result['total_tax_error'] = 1;
                }else{
                    $result['total_tax_error'] = 0;
                }
                if(abs($request['price_tax_total']) > 2147483647){
                    $result['price_tax_total_error'] = 1;
                }else{
                    $result['price_tax_total_error'] = 0;
                }
                return $result;
        }elseif (!$errors->any() && $request['confirm_status'] == 0) {
            $result['status'] = 'confirm';
            return $result;
        } else if ($request['confirm_status'] == 1 && !$errors->any()) {
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### purchase_slip start\n";
            QueryHandler::logger($bango, $log_data);
            $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
            pg_query($conn, "BEGIN");
            try {
                $request = (object)$request;
                $company_data = $request->reg_sold_to;
                self::$supplier_cd = $company_data;
                $input_person = $request->input_person;
                $deletion_status = $request->deletion_status;
                $kokyakuCode = substr($company_data, 0,6);
                $haisouCode = substr($company_data, 6,2);
                $kokyaku = QueryHelper::select(['bango,mallsoukobango1'])->from('kokyaku1')->where("yobi12 = '$kokyakuCode' ")->get()->first();
                $haisoujouhou = QueryHelper::select(['bunrui4,bunrui5'])->from('haisoujouhou')->where("syukei1 = '$kokyaku->bango' ")->get()->first();
                $others2 = QueryHelper::fetchResult("select other1,other33,other35 from others2 where otherint1 = (select bango from haisou where haisou.shikibetsucode = '$kokyakuCode' and haisou.torihikisakibango = '$haisouCode')");
                if(count($others2)>0){
                    if(explode(' ', $others2[0]->other1)[0] == '1'){
                        $data_status = $haisoujouhou->bunrui4;
                    }else{
                        $data_status = $others2[0]->other33;
                    }
                }else{
                    $data_status = "";
                }
                //dd($request);
                $all_id = "";
                list($purchase_slip_input, $purchase_slip_details) = self::getProcessedRequest();
                //dd($purchase_slip_details);
                $sorted_array = self::sortValue($purchase_slip_details);
                // dd($sorted_array);
                $old_display_order = array();

                foreach ($purchase_slip_details as $req) {
                    $id = $req['id'];
                    $line_number = $req['line_number'];
                    $display_order = $req['display_order'];

                    foreach ($sorted_array as $key=>$val) {
                        if($val == $display_order){
                            if(in_array($key,$old_display_order))
                                continue;
                            $display_order = $key;
                            // $display_order++;
                            break;
                        }
                    }
                    array_push($old_display_order,$display_order);

                    $group = $req['group'];
                    $incharge_purchasing = $req['incharge_purchasing'];
                    $purchase_quantity = $req['purchase_quantity'];
                    $purchase_unit_price = $req['purchase_unit_price'];
                    $purchase_line_amount = $req['purchase_line_amount'];
                    $purchase_consumption_amount = $req['purchase_consumption_amount'];
                    $accounting_subject = $req['accounting_subject'];
                    $accounting_breakdown = $req['accounting_breakdown'];
                    $remarks = $req['remarks'];
                    $productCd = $req['productCd'];
                    $productName = $req['productName'];
                    $last_datetime = $req['last_datetime'];
                    $retain = $req['retain'];
                    $order_to = $req['order_to'];
                    if($req['order_to_full'] && str_contains($req['order_to_full'], "/")){
                        $order_name = explode('/',$req['order_to_full'])[1];
                    }else{
                        $order_name = "";
                    }
                    if($deletion_status == '1'){
                        $line_number_modified = "";
                    }else{
                        $line_number_modified = $line_number;
                    }

                    $syouhinData = QueryHelper::fetchSingleResult("select kongouritsu, name from syouhin1 where kokyakusyouhinbango = '$productCd' ");
                       

                    if($id){
                        self::$line = $line_number;
                        $kaiin = [
                            'bango' => $id,
                            'mail' => $company_data,
                            'syukei3' => $line_number,
                            'syukei4' => $display_order,
                            'syukei5' => $group,
                            'mail2' => $order_to,
                            'name' => $order_name,
                            'kaka' => $incharge_purchasing,
                            'sex' => $productCd,
                            'address' => $productName,
                            'kokyakubango' => static::stringDataConvertedToIntegerFormat($purchase_quantity, 'comma') ?? null,
                            'pointlimit' => static::stringDataConvertedToIntegerFormat($purchase_unit_price, 'comma') ?? null,
                            'lastusepoint' => static::stringDataConvertedToIntegerFormat($purchase_line_amount, 'comma') ?? null,
                            'lastbuy' => static::stringDataConvertedToIntegerFormat($purchase_consumption_amount, 'comma') ?? null,
                            'yubinbango' => $data_status ?? null,
                            'kenadd' => $accounting_subject,
                            'ciadd' => $accounting_breakdown,
                            'cyouadd' => $syouhinData->kongouritsu ?? null,
                            'biladd' => $syouhinData->name ?? null,
                            'nickname' => $remarks,
                            'syukeikikijun' => $retain,
                            'syukeituki' => null,
                            'passwd' => null,
                            'syukeiki' => $last_datetime,
                            'syukeitukikijun' => 0,
                            'birthday' => Carbon::now()->format('Y-m-d H:i:s'),
                            'tel' => $bango,
                            'starttime' => 0,
                            'endtime' => 0,
                            'model' => null,
                            'carrier' => null,
                            'bunrui1' => null,
                            'bunrui2' => null,
                            'syukei1' => 0,
                            'syukei2' => 0,
                            'terminal' => $input_person,
                        ];
                        $kaiinData = QueryHelper::updateData('kaiin', $kaiin, 'bango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                        $all_id .= $kaiinData->bango.",";
                        //array_push($all_id,$last);
                    }else{
                        self::$line = $line_number_modified;
                        $kaiin = [
                            'mail' => $company_data,
                            'syukei3' => $line_number_modified,
                            'syukei4' => $display_order,
                            'syukei5' => $group,
                            'mail2' => $order_to,
                            'name' => $order_name,
                            'kaka' => $incharge_purchasing,
                            'sex' => $productCd,
                            'address' => $productName,
                            'kokyakubango' => static::stringDataConvertedToIntegerFormat($purchase_quantity, 'comma') ?? null,
                            'pointlimit' => static::stringDataConvertedToIntegerFormat($purchase_unit_price, 'comma') ?? null,
                            'lastusepoint' => static::stringDataConvertedToIntegerFormat($purchase_line_amount, 'comma') ?? null,
                            'lastbuy' => static::stringDataConvertedToIntegerFormat($purchase_consumption_amount, 'comma') ?? null,
                            'yubinbango' => $data_status ?? null,
                            'kenadd' => $accounting_subject,
                            'ciadd' => $accounting_breakdown,
                            'cyouadd' => $syouhinData->kongouritsu ?? null,
                            'biladd' => $syouhinData->name ?? null,
                            'nickname' => $remarks,
                            'syukeikikijun' => $retain,
                            'syukeituki' => null,
                            'passwd' => null,
                            'syukeiki' => Carbon::now()->format('Y-m-d H:i:s'),
                            'syukeitukikijun' => 0,
                            'birthday' => Carbon::now()->format('Y-m-d H:i:s'),
                            'tel' => $bango,
                            'starttime' => 0,
                            'endtime' => 0,
                            'model' => null,
                            'carrier' => null,
                            'bunrui1' => null,
                            'bunrui2' => null,
                            'syukei1' => 0,
                            'syukei2' => 0,
                            'terminal' => $input_person,
                        ];
                        $kaiinData = QueryHelper::insertData('kaiin', $kaiin, 'bango', true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                        $all_id .= $kaiinData->bango.",";
                        //array_push($all_id,$last);
                        
                    }
                    
                }
                static::deleteLine(request('deleteLine'), $bango);

                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### purchase_slip end\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "COMMIT");
                session()->flash('success_msg', "登録しました。");
                $result['status'] = 'ok';
                $all_id = rtrim($all_id,",");
                session()->flash('all_id', $all_id);
                $result['all_id'] = $all_id;
            } catch (\Exception $e) {
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "ROLLBACK");
                $msgg = "仕入先ＣＤ".self::$supplier_cd."行番号".self::$line."の本登録に失敗しました";
                session()->flash('success_msg', $msgg);
                session()->flash('all_id', "null");
                $result['msg'] = $e->getMessage();
                $result['status'] = 'not_ok';
                $result['all_id'] = 'null';
            }
        }
        
        return $result;
    }

    public static function sortValue($purchase_slip_details)
    {
        $array_for_sort = array();
        $j = 1;
        foreach ($purchase_slip_details as $req) {
            $key = $req['id'];
            $array_for_sort[$j++] = $req['display_order'];
        }
        //dd($array_for_sort);
        asort($array_for_sort);
        //dd($array_for_sort);
        $sorted_array = array();
        $i = 1;
        foreach ($array_for_sort as $key=>$val) {
            $sorted_array[$i++] = $val; 
            // $sorted_array[$key] = $i++; 
        }
        //dd($sorted_array);
        return $sorted_array;
    }

    public static function dataCreate($request, $bango)
    {
        $validator = PurchaseSlipValidation::validate(request()->all());
        $errors = $validator->errors();
        $result = [];
        if ($errors->any()) {
            $result['status'] = 'ng';
            $result['err_msg'] = $errors->all();
            $result['err_field'] = $errors->keys();
        }elseif (!$errors->any() && (abs($request['total_price']) > 2147483647 || abs($request['total_tax']) > 2147483647 || abs($request['price_tax_total']) > 2147483647)) {
            $result['status'] = 'error_int_limit_exceed';
            if(abs($request['total_price']) > 2147483647){
                $result['total_price_error'] = 1;
            }else{
                $result['total_price_error'] = 0;
            }
            if(abs($request['total_tax']) > 2147483647){
                $result['total_tax_error'] = 1;
            }else{
                $result['total_tax_error'] = 0;
            }
            if(abs($request['price_tax_total']) > 2147483647){
                $result['price_tax_total_error'] = 1;
            }else{
                $result['price_tax_total_error'] = 0;
            }
            return $result;
        }elseif (!$errors->any()) {
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### purchase_slip dataCreate start\n";
            QueryHandler::logger($bango, $log_data);
            $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
            pg_query($conn, "BEGIN");
            try {
                //dd($request);
                $request = (object)$request;
                $company_data = $request->reg_sold_to;
                $input_person = $request->input_person;
                $group_first = $request->group_first;
                $group_last = $request->group_last;
                $purchase_date = date('Y-m-d H:i:s',strtotime($request->purchase_date));
                $kokyakuCode = substr($company_data, 0,6);
                $haisouCode = substr($company_data, 6,2);
                $kokyaku = QueryHelper::select(['bango,mallsoukobango1'])->from('kokyaku1')->where("yobi12 = '$kokyakuCode' ")->get()->first();
                
                
                $payment_date = HolidayCalculation::getExactDate($company_data, $request->purchase_date, $bango);

                //dd($payment_date);
                $all_id = $request->all_id;
                if($all_id){
                    $all_id = explode(",",$all_id);
                    $ids = array();
                    for($i=0;$i<sizeof($all_id);$i++){
                        array_push($ids, (int)$all_id[$i]);
                    }
                    $ids = implode(",",$ids);
                    $allKaiinData = Queryhelper::fetchResult("select syukei5, mail2, kaka, sum(lastusepoint) as purchase_total, sum(lastbuy) as consumption_total from kaiin where bango IN ($ids) group by syukei5, mail2, kaka ");
                    //dd($allKaiinData);
                }
                $haisoujouhou = QueryHelper::select(['bunrui4,bunrui5'])->from('haisoujouhou')->where("syukei1 = '$kokyaku->bango' ")->get()->first();
                $others2 = QueryHelper::fetchResult("select other1,other33,other35 from others2 where otherint1 = (select bango from haisou where haisou.shikibetsucode = '$kokyakuCode' and haisou.torihikisakibango = '$haisouCode')");
                
                if(count($others2)>0){
                    if(explode(' ', $others2[0]->other1)[0] == '1'){
                        $data_status = $haisoujouhou->bunrui4;
                    }else{
                        $data_status = $others2[0]->other33;
                    }
                }else{
                    $data_status = "";
                }
                list($purchase_slip_input, $purchase_slip_details) = self::getProcessedRequest();
                $all_unsoumei = array();
                $x = 0;
                foreach ($allKaiinData as $allKaiinDataInfo) {
                    if($group_first != "" && $group_last != ""){
                        if(!($allKaiinDataInfo->syukei5 >= $group_first && $allKaiinDataInfo->syukei5 <= $group_last)){
                            continue;
                        }
                    }elseif($group_first != ""){
                        if(!($allKaiinDataInfo->syukei5 >= $group_first)){
                            continue;
                        }
                    }elseif($group_last != ""){
                        if(!($allKaiinDataInfo->syukei5 <= $group_last)){
                            continue;
                        }
                    }
                    $x++;


                    $unsoumei = static::getUnsoumei($bango);
                    foreach ($purchase_slip_details as $req) {
                        if($allKaiinDataInfo->syukei5 == $req['group'] && $allKaiinDataInfo->mail2 == $req['order_to'] && $allKaiinDataInfo->kaka == $req['incharge_purchasing']){
                            $id = $req['id'];
                            $all_unsoumei[$id] = $unsoumei;
                            $line_number = $req['line_number'];
                            $display_order = $req['display_order'];
                            $group = $req['group'];
                            $incharge_purchasing = $req['incharge_purchasing'];
                            $purchase_quantity = $req['purchase_quantity'];
                            $purchase_unit_price = $req['purchase_unit_price'];
                            $purchase_line_amount = $req['purchase_line_amount'];
                            $purchase_consumption_amount = $req['purchase_consumption_amount'];
                            $accounting_subject = $req['accounting_subject'];
                            $accounting_breakdown = $req['accounting_breakdown'];
                            $remarks = $req['remarks'];
                            if(isset($req['retain'])){
                                $retain = $req['retain'];
                            }else{
                                $retain = 2;
                            }
                            $order_to = $req['order_to'];
                            if($req['order_to_full'] && str_contains($req['order_to_full'], "/")){
                                $order_name = explode('/',$req['order_to_full'])[1];
                            }else{
                                $order_name = "";
                            }
                            
                        }
                    }

                    $toiawasebango = [
                        'unsoumei' => $unsoumei ?? null,
                        'toiawasebango' => 'U620',
                        'konpousu' => 1,
                        'touchakutime' => $incharge_purchasing,
                        'bikou1' => $company_data ?? null,
                        'touchakudate' => $purchase_date,
                        'denpyoname' => null,
                        'dataint01' => null,
                        'bikou2' => $order_name ?? null,
                        'dataint02' => static::stringDataConvertedToIntegerFormat($payment_date) ?? null,
                        'dataint03' => $allKaiinDataInfo->purchase_total ?? null,
                        'datanum0001' => $allKaiinDataInfo->consumption_total ?? null,
                        'datanum0002' => 2,
                        'datanum0008' => 0,
                        'datanum0009' => 0,
                        'datanum0010' => null,
                        'datanum0011' => null,
                        'datachar01' => null,
                        'datachar02' => null,
                        'datachar03' => '0',
                        'datanum0012' => static::getCurrentTime(),
                        'datatxt0001' => $bango,
                        'datanum0013' => 0,
                        'datanum0014' => null,
                        'datanum0015' => 0,
                        'datatxt0002' => '2',
                        'datatxt0019' => '1',
                        'datanum0016' => null
                    ];
                    QueryHelper::insertData('toiawasebango', $toiawasebango, 'unsoumei', true, $bango, __CLASS__, __FUNCTION__, __LINE__);

                    $hikiatenyuko = [
                        'syouhinid' => $unsoumei ?? null,
                        'syouhinsyu' => 2,
                        'hantei' => 2,
                        'datachar06' => null,
                        'datachar07' => null,
                        'dataint01' => 2,
                        'dataint02' => 0,
                        'dataint03' => 0,
                        'dataint04' => 0,
                        'datachar02' => null,
                        'datachar03' => null,
                        'datachar04' => 0,
                        'datachar05' => 0,
                        'yoteimeter' => 0,
                        'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'),
                        'denpyoshimebi' => null,
                        'tantousyabango' => $bango,
                    ];
                    QueryHelper::insertData('hikiatenyuko', $hikiatenyuko, 'syouhinid', true, $bango, __CLASS__, __FUNCTION__, __LINE__);

                }
                $no_of_unsumei = $x;
                $all_unsoumei = (object)$all_unsoumei;
                //dd($all_unsoumei);
                foreach ($purchase_slip_details as $req) {
                    if($group_first != "" && $group_last != ""){
                        if(!($allKaiinDataInfo->syukei5 >= $group_first && $allKaiinDataInfo->syukei5 <= $group_last)){
                            continue;
                        }
                    }elseif($group_first != ""){
                        if(!($allKaiinDataInfo->syukei5 >= $group_first)){
                            continue;
                        }
                    }elseif($group_last != ""){
                        if(!($allKaiinDataInfo->syukei5 <= $group_last)){
                            continue;
                        }
                    }
                    $id = $req['id'];
                    $line_number = $req['line_number'];
                    $company_data = $request->reg_sold_to;
                    $display_order = $req['display_order'];
                    $group = $req['group'];
                    $incharge_purchasing = $req['incharge_purchasing'];
                    $purchase_quantity = $req['purchase_quantity'];
                    $purchase_unit_price = $req['purchase_unit_price'];
                    $purchase_line_amount = $req['purchase_line_amount'];
                    $purchase_consumption_amount = $req['purchase_consumption_amount'];
                    $accounting_subject = $req['accounting_subject'];
                    $accounting_breakdown = $req['accounting_breakdown'];
                    $remarks = $req['remarks'];
                    $productCd = $req['productCd'];
                    $productName = $req['productName'];
                    $purchase_date = date('Y-m-d H:i:s',strtotime($request->purchase_date));
                    //if(isset($req['retain'])){
                    $retain = $req['retain'];
                    //}else{
                        //$retain = 2;
                    //}
                    $order_to = $req['order_to'];
                    if($req['order_to_full'] && str_contains($req['order_to_full'], "/")){
                        $order_name = explode('/',$req['order_to_full'])[1];
                    }else{
                        $order_name = "";
                    }
                    $syouhinid = "";
                    foreach($all_unsoumei as $key=>$value){
                        if($id == $key){
                            $syouhinid = $value;
                        }
                    }
                    

                    $nyukoold = [
                        'syouhinid' => $syouhinid ?? null,
                        'syouhinsyu' => $line_number ?? null,
                        'hantei' => 00,
                        'idoutanabango' => 0,
                        'yoteimeter' => 0,
                        'nyukometer' => 0,
                        'datachar07' => $productCd ?? null,
                        'datachar08' => $productName ?? null,
                        'nyukosu' => static::stringDataConvertedToIntegerFormat($purchase_quantity, 'comma') ?? null, 
                        'kingaku' => static::stringDataConvertedToIntegerFormat($purchase_unit_price, 'comma') ?? null, 
                        'datachar11' => $remarks ?? null, 
                        'datachar18' => $data_status ?? null,
                        'barcode' => $accounting_subject ?? null,
                        'codename' => $accounting_breakdown ?? null,
                        'dataint21' => 0,
                        'dataint22' => 0,
                        'dataint23' => 0,                   
                        'season' => null,
                        'nengetsu' => null,
                        'datachar15' => null,
                        'datachar16' => null,                    
                        'denpyobango' => 0,
                        'denpyohakkoubi' => Carbon::now()->format('Y-m-d H:i:s'),
                        'tantousyabango' => $bango,
                        'zaikometer' => 0,      
                        'syouhizeiritu' => static::stringDataConvertedToIntegerFormat($purchase_line_amount, 'comma') ?? null,
                        'soukobango' => static::stringDataConvertedToIntegerFormat($purchase_consumption_amount, 'comma') ?? null,  
                    ];
                    $nyukoold = QueryHelper::insertData('nyukoold', $nyukoold, 'syouhinid', false, $bango, __CLASS__, __FUNCTION__, __LINE__);

                }


                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### purchase_slip dataCreate end\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "COMMIT");
                $result['status'] = 'ok';
                $result['no_of_unsumei'] = $no_of_unsumei;
            } catch (\Exception $e) {
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn, "ROLLBACK");
                session()->flash('success_msg', "something went wrong");
                $result['msg'] = $e->getMessage();
                $result['status'] = 'not_ok';
                $result['no_of_unsumei'] = "";
            }
        }
        return $result;
    }
    
    public static function stringDataConvertedToIntegerFormat($value, $type = null)
    {
        $indicator = $type ? "," : "/";
        if (mb_strpos($value, $indicator)) {
            return str_replace($indicator, "", $value);
        }

        return $value;
    }

    public static function getUnsoumei($bango)
    {
        $kokyakubango1stPart = "08";
        $kokyakubango2ndPart = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7501' ")->orderbango ?? null;
        $repeat = QueryHelper::fetchSingleResult("select review.mobile_flag from review where kokyakusyouhinbango = 'D7031' ")->mobile_flag ?? null;
        $kokyakubango3rdPart = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7031' ")->orderbango ?? null;
        $kokyakubango3rdPart = (int)$kokyakubango3rdPart + 1;
        $kokyakubango3rdPart = sprintf('%0' . $repeat . 'd', $kokyakubango3rdPart);

        //update review data
        $review = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7031'");
        $orderBango = $review->orderbango;
        $orderBango = (int)$orderBango + 1;
        $review_update_data = [
            'kokyakusyouhinbango' => 'D7031',
            'orderbango' => $orderBango,
            'check_flag' => 0,
            'color' => Carbon::now()->setTimezone("Asia/Tokyo")->format('YmdHis'),
            'size' => Helper::getSystemIP(),
            'nickname' => $bango,
        ];
        QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
        
        return $kokyakubango1stPart . '' . $kokyakubango2ndPart . '' . $kokyakubango3rdPart;
    }

    public static function getCurrentTime()
    {
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        return str_replace(" ", "", $mytime);
    }

    public static function getProcessedRequest()
    {
        $input_element = ['id','line_number','display_order','group','incharge_purchasing','purchase_quantity','purchase_unit_price','purchase_line_amount','purchase_consumption_amount','accounting_subject','accounting_breakdown','remarks','productCd','productName','retain','order_to','order_to_full','last_datetime'];
        $purchase_slip_input = request()->except($input_element);
        $purchase_slip_details = request()->only($input_element);
        $purchase_slip_details = Helper::formatMulDimForm($purchase_slip_details);
        return [$purchase_slip_input, $purchase_slip_details];
    }

    public static function deleteLine($serials, $bango)
    {
        $serials = json_decode($serials) ?? [];
        //dd($serials);
        foreach ($serials as $serial) {
            QueryHelper::runQuery("delete from kaiin where bango='$serial' ");
        }
    }
    
    public static function renderCategoryKanri($length_limit, $categoryValue, $categoryType)
    {
        $categories = QueryHelper::fetchResult("select * from categorykanri where category1 = '$categoryType' and suchi2 = 0 and substring (category2,1,$length_limit) = '$categoryValue' order by suchi1 ASC") ?? null;
        $default_name = ['C5' => "選択無し", 'C6' => "選択無し", 'E7' => "選択無し", 'E6' => "選択無し", 'maljabena' => "選択無し"];
        $html = '<option data-categoryType="null" data-categoryValue="' . $categoryType . '"  value="">' . $default_name[$categoryType] . '</option>';
        if (isset($categories)) {
            foreach ($categories as $category) {
                $html .= "<option data-categoryType=" . $category->category1 . " data-categoryValue=" . $category->category2 . " value=" . $category->category1 . $category->category2 . ">" . substr($category->category2, $length_limit) . " " . $category->category4 . "</option>";
            }
            return $html;
        } else {
            return $html;
        }
    }
}
