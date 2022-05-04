<?php

namespace App\Http\Controllers\purchase;
use Illuminate\Http\Request;
use App\tantousya;
use App\kengen;
use App\requestTable;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\purchase\paymentScheduleCal\AllPaymentBalance;
use App\AllClass\purchase\paymentScheduleCal\AllAccountsPayable;
use Illuminate\Support\Facades\Validator;
use App\AllClass\ButtonMsg;
use Illuminate\Pagination\Paginator;
use App\AllClass\TableSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;
use App\AllClass\master\CSVLogger;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;

class PaymentScheduleCalController extends Controller
{
    private $headers = [
        '品名' => 'datachar08',
        '数量' => 'nyukosu',
        '単価' => 'kingaku',
        '金額' => 'syouhizeiritu',
        '課税' => 'datachar18',
        '会計科目' => 'barcode',
        '会計科目内訳' => 'codename',
    ];


    public function postPaymentScheduleCal(Request $request)
    {
        $bango = request('userId');
        $tantousya = tantousya::find($bango);
        $payment_deadline = QueryHelper::fetchResult("select category1,category2,category4 from categorykanri where category1 = 'D8' ORDER BY category2 ASC");
        return view('purchase.paymentScheduleCal.mainPaymentScheduleCal', compact('bango', 'tantousya', 'payment_deadline'));
    }
    

    public function registerPaymentScheduleCal(Request $request,$bango){
        $input = $request->all();
      
        $rules=[];
        $rules['payment_deadline'] = ['required'];
        $rules['payment_date'] = ['required','max:10','date','regex:/^[0-9\/]+$/'];
        $rules['deadline'] = ['required','max:10','date','regex:/^[0-9\/]+$/'];
        
        $message=[];  
        $message['required']='【:attribute】必須項目に入力がありません。';
        $message['max']='【:attribute】:max桁以下で入力してください。';
        $message['min']='【:attribute】の入力は:min文字以上必要です。';
        $message['regex']='【:attribute】半角数字以外は使用できません。';
        $message['date']='【:attribute】日付の入力が適切ではありません。';
        $message['date_format']='【:attribute】yyyy/mm/ddの形式で入力してください。';
        
        $attributes = [
            'payment_deadline' => '支払締め日',
            'payment_date' => '支払日',
            'deadline' => '締切日',
        ];

       
        $validator = Validator::make($input,$rules,$message,$attributes);  
        $errors = $validator->errors();
        if($errors->any()){
            $err_msg = $errors->all();
            return ['err_field' => $errors, 'err_msg' => $err_msg];
        }else if(!$errors->any() && request('submit_confirmation') == ""){
            return "confirmation_msg";
        }
        
        //payment confirmation check
        $reviewData = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7504'");
        $review_orderbango = $reviewData->orderbango;
        $temp_deadline = (int) str_replace("/","",$input['deadline']);
        if($temp_deadline <= $review_orderbango){
            return "payment_con_err";
        }
        //payment confirmation check end
        
        $query = AllPaymentBalance::data($bango, $request->all())->toSql();
        $paymentBalanceData = QueryHelper::fetchResult($query);
        //$query2 = AllAccountsPayable::data($bango, $request->all())->toSql();
        //$accountsPayableData = QueryHelper::fetchResult($query2);
        
        //dd($paymentBalanceData);

        //start log query
        $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 支払予定計算 start\n";
        QueryHandler::logger($bango,$log_data);

        $conn = pg_connect("host=".env("DB_HOST")." port=".env("DB_PORT")."  dbname=".env("DB_DATABASE")." user=".env("DB_USERNAME")." password=".env("DB_PASSWORD"));
        pg_query($conn,"BEGIN");
        //try{
            $deadline = $input['deadline'];
            $temp_deadline = str_replace("/","-",$deadline)." 00:00:00";
                
            if(count($paymentBalanceData) > 0){
                $tempBalanceData = collect($paymentBalanceData)->groupBy('company_code');
                
                //check error when deadlin < max(sz0001)
                $arr = array_keys($tempBalanceData->toArray());
                $company_list = "";
                foreach($arr as $k=>$v){
                   $company_list .=  "'".$v."'".",";
                }
                $company_list = rtrim($company_list,",");
                $checking_data = QueryHelper::fetchSingleResult("
                    select 
                    MAX(shiharaizandaka.sz0001) as temp_max_sz0001
                    from shiharaizandaka
                    where sz0002 in($company_list)
                    ");
                if($checking_data && $temp_deadline < $checking_data->temp_max_sz0001){
                    $no_insertion_msg = "該当するデータがありません。";
                    Session::flash('no_insertion_msg', $no_insertion_msg); 
                    return "ok";
                }
                //check error when deadlin < max(sz0001)
           
                foreach($tempBalanceData as $balance_key=>$balance_val){
                    $bikou1 = $balance_key;
                    $other1 = substr($balance_val[0]->other1,0,1);
                    $datachar01_d901_count = collect($balance_val)->where('datachar01_d901_count',">",0)->count();
                    
                    $shiharaizandaka_previous_data = QueryHelper::fetchSingleResult("
                    select 
                    shiharaizandaka.*
                    from shiharaizandaka
                    where sz0001 ='$temp_deadline' AND sz0002 = '$bikou1'
                    ");
                    
                    if(!$shiharaizandaka_previous_data){
                       $shiharaizandaka_previous_data = QueryHelper::fetchSingleResult("
                        select 
                        shiharaizandaka.*
                        from shiharaizandaka
                        where sz0002 = '$bikou1'
                        AND sz0001 <= '$temp_deadline'
                        order by sz0001 desc
                        "); 
                    }

                    //error check starts
                    $shiharaizandaka_temp_data = QueryHelper::fetchSingleResult("
                    select 
                    MAX(sz0001) as max_sz0001
                    from shiharaizandaka
                    where sz0001 < '$temp_deadline' AND sz0002 = '$bikou1'  
                    group by sz0002
                    ");
                    if($shiharaizandaka_temp_data){
                        $end_sz0001 = $shiharaizandaka_temp_data->max_sz0001;
                        $effectiveDate = strtotime("-3 months", strtotime($end_sz0001));
                        $start_sz0001 = strftime ( '%Y-%m-%d' , $effectiveDate )." 00:00:00";
//                        $toiawasebango_temp_data = QueryHelper::fetchSingleResult("
//                        select 
//                        toiawasebango.min_unsoumei,
//                        temp2_toiawasebango.datanum0014
//                        from (select MIN(unsoumei) as min_unsoumei from toiawasebango as temp_toiawasebango where temp_toiawasebango.touchakudate > '$start_sz0001' AND temp_toiawasebango.touchakudate < '$end_sz0001' AND bikou1 = '$bikou1') as toiawasebango
//                        join toiawasebango as temp2_toiawasebango on temp2_toiawasebango.unsoumei = toiawasebango.min_unsoumei
//                        ");
                        $toiawasebango_temp_data = QueryHelper::fetchResult("
                        select unsoumei,datanum0014 from toiawasebango as temp_toiawasebango 
                        where temp_toiawasebango.touchakudate > '$start_sz0001' AND temp_toiawasebango.touchakudate < '$end_sz0001'
                        AND bikou1 = '$bikou1'
                        ");
                        $min_unsoumei = collect($toiawasebango_temp_data)->min('unsoumei');
                        $data_count = collect($toiawasebango_temp_data)->where('unsoumei',"=",$min_unsoumei)->where('datanum0014',"=",null)->count();
                    }else{
                        $end_sz0001 = null;
                        $start_sz0001 = null;
                        $toiawasebango_temp_data = false;
                        $min_unsoumei = null;
                        $data_count = 0;
                    }

                    //if($toiawasebango_temp_data && ($toiawasebango_temp_data->datanum0014 == null || $toiawasebango_temp_data->datanum0014 == '')){
                    if($data_count > 0){
                        //$msg = "支払予定計算で集計漏れがあります。(仕入番号".$toiawasebango_temp_data->min_unsoumei.")";
                        $msg = "支払予定計算で集計漏れがあります。(仕入番号".$min_unsoumei.")";
                        $arr = [
                            "status" => 'data_check_err',
                            "msg" => $msg
                        ];
                        Session::forget('temp_success_msg');
                        pg_query($conn,"ROLLBACK");
                        return $arr;
                    }
                    //error check ends

                    if($shiharaizandaka_previous_data && ($shiharaizandaka_previous_data->sz0038 < 1 || $shiharaizandaka_previous_data->sz0039 < 1))
                    { 
                        //delete previous data
                        QueryHelper::fetchSingleResult(" DELETE from shiharaizandaka where sz0001 ='$temp_deadline' AND sz0002 = '$bikou1' ");

                        if($shiharaizandaka_previous_data){
                            $sz0003 = $shiharaizandaka_previous_data->sz0038;
                            $prev_sz0003 = $shiharaizandaka_previous_data->sz0003;
                            $sz0004 = $shiharaizandaka_previous_data->sz0039;
                            $prev_sz0004 = $shiharaizandaka_previous_data->sz0004;
                            $sz0006 = $shiharaizandaka_previous_data->sz0006;
                            $sz0007 = $shiharaizandaka_previous_data->sz0007;
                            $sz0008 = $shiharaizandaka_previous_data->sz0008;
                            $sz0011 = $shiharaizandaka_previous_data->sz0011;
                            $sz0012 = $shiharaizandaka_previous_data->sz0012;
                            $sz0013 = $shiharaizandaka_previous_data->sz0013;
                            $sz0018 = $shiharaizandaka_previous_data->sz0018;
                            $sz0023 = $shiharaizandaka_previous_data->sz0023;
                            $sz0027 = 'D906';
                            $sz0029 = 'D907';
                            $sz0033 = 'D906';
                            $sz0035 = 'D907';
                        }else{
                            $sz0003 = 0;
                            $prev_sz0003 = 0;
                            $sz0004 = 0;
                            $prev_sz0004 = 0;
                            $sz0006 = 0;
                            $sz0007 = 0;
                            $sz0008 = 0;
                            $sz0011 = 0;
                            $sz0012 = 0;
                            $sz0013 = 0;
                            $sz0018 = 0;
                            $sz0023 = 0;
                            $sz0027 = 'D906';
                            $sz0029 = 'D907';
                            $sz0033 = 'D906';
                            $sz0035 = 'D907';
                        }

                        if($other1 == 1){
                            $sz0025 = $balance_val[0]->hj0055;
                            $sz0031 = $balance_val[0]->hj0055;
                            if($balance_val[0]->hj0087 != null){
                                $hj0087 = $balance_val[0]->hj0087;
                                $temp_date = strtotime("+$hj0087 days", strtotime(str_replace("/","-",$deadline)));
                                $sz0037 = strftime ( '%Y-%m-%d' , $temp_date );
                                //$sz0037 = str_replace("/","-",$deadline).$balance_val[0]->hj0087;
                            }else{
                                $sz0037 = str_replace("/","-",$deadline)." 00:00:00";
                            }
                        }else{
                            $sz0025 = $balance_val[0]->jg0053;
                            $sz0031 = $balance_val[0]->jg0053;
                            if($balance_val[0]->jg0054 != null){
                                $jg0054 = $balance_val[0]->jg0054;
                                $temp_date = strtotime("+$jg0054 days", strtotime(str_replace("/","-",$deadline)));
                                $sz0037 = strftime ( '%Y-%m-%d' , $temp_date );
                                //$sz0037 = str_replace("/","-",$deadline).$balance_val[0]->jg0054;
                            }else{
                                $sz0037 = str_replace("/","-",$deadline)." 00:00:00";
                            }
                        }
                        $sum_of_sr0011 = collect($paymentBalanceData)->sum('sr0011');
                        $sum_of_sr0011_2 = collect($paymentBalanceData)->where('sr0002',"<>",'70')->sum('sr0011');
                        $sz0005 = $sum_of_sr0011_2;
                        $sum_of_sr0011_3 = collect($paymentBalanceData)->where('sr0002',"=",'70')->sum('sr0011');
                        $sz0010 = $sum_of_sr0011_3;
                        $sum_of_sr0012 = collect($paymentBalanceData)->sum('sr0012');
                        $sum_of_sr0012_2 = collect($paymentBalanceData)->where('sr0002',"<>",'70')->sum('sr0012');
                        $sz0009 = $sum_of_sr0012_2;
                        $sum_of_sr0012_3 = collect($paymentBalanceData)->where('sr0002',"=",'70')->sum('sr0012');
                        $sz0014 = $sum_of_sr0012_3;
                        $sum_of_sm0003 = collect($paymentBalanceData)->sum('sm0003');
                        $sz0015 = collect($paymentBalanceData)->where('sh0017',1)->whereIn('datachar01',['01','02','04','05','08','10'])->sum('sm0003');
                        $sz0016 = collect($paymentBalanceData)->where('sh0017',1)->whereIn('datachar01',['03'])->sum('sm0003');
                        $sz0017 = collect($paymentBalanceData)->where('sh0017',1)->whereIn('datachar01',['09'])->sum('sm0003');
                        $sz0019 = collect($paymentBalanceData)->where('sh0017',1)->whereNotIn('datachar01',['01','02','03','04','05','08','09','10'])->sum('sm0003');
                        $sz0020 = collect($paymentBalanceData)->where('sh0017',2)->whereIn('datachar01',['01','02','04','05','08','10'])->sum('sm0003');
                        $sz0021 = collect($paymentBalanceData)->where('sh0017',2)->whereIn('datachar01',['03'])->sum('sm0003');
                        $sz0022 = collect($paymentBalanceData)->where('sh0017',2)->whereIn('datachar01',['09'])->sum('sm0003');
                        $sz0024 = collect($paymentBalanceData)->where('sh0017',2)->whereNotIn('datachar01',['01','02','03','04','05','08','09','10'])->sum('sm0003');
                        //$sz0038 = $prev_sz0003 + ($sz0005 + $sz0006 + $sz0007 + $sz0008 + $sz0009) - ($sz0015 + $sz0016 + $sz0017 + $sz0018 + $sz0019);
                        $sz0038 = $sz0003 + ($sz0005 + $sz0006 + $sz0007 + $sz0008 + $sz0009) - ($sz0015 + $sz0016 + $sz0017 + $sz0018 + $sz0019);
                        //$sz0039 = $prev_sz0004 + ($sz0010 + $sz0011 + $sz0012 + $sz0013 + $sz0014) - ($sz0020 + $sz0021 + $sz0022 + $sz0023 + $sz0024);
                        $sz0039 = $sz0004 + ($sz0010 + $sz0011 + $sz0012 + $sz0013 + $sz0014) - ($sz0020 + $sz0021 + $sz0022 + $sz0023 + $sz0024);

                        if($bikou1 != null){
                            $sz0028 = self::paymentAmountCal($sz0038,$bikou1,$datachar01_d901_count);
                        }else{
                            $sz0028 = 0;
                        }
                        
                        if($bikou1 != null){
                            $sz0034 = self::paymentAmountCal($sz0039,$bikou1,$datachar01_d901_count);
                        }else{
                            $sz0034 = 0;
                        }
                        
                        //$sz0034 = $sz0028;
                        $temp_sz0026 = $sz0038 - $sz0028;
                        $temp_sz0032 = $sz0039 - $sz0034;
                        if($temp_sz0026 > 0){
                            $data = self::withholdingTaxCal($temp_sz0026,$sz0028,$sz0034,$sz0038,$sz0039,$sz0009,$sz0014,$bikou1);
                            $sz0026 = $data['temp_sz0026'];
                            $sz0030 = $data['sz0030'];
                            $sz0032 = $data['sz0032'];
                            $sz0036 = $data['sz0036'];
                            //$data2 = self::withholdingTaxCal($temp_sz0032,$sz0034,$sz0038,$sz0039,$sz0009,$sz0014,$bikou1);
                            //$sz0032 = $data['temp_sz0026'];
                        }else{
                            $sz0026 = $temp_sz0026;
                            $sz0030 = 0;
                            $sz0036 = 0;
                            $sz0032 = 0;
                        }
                        
                        if($sz0026 == 0){
                            $sz0025 = null;
                        }
                        if($sz0028 == 0){
                            $sz0027 = null;
                        }
                        if($sz0030 == 0){
                            $sz0029 = null;
                        }
                        if($sz0032 == 0){
                            $sz0031 = null;
                            $sz0035 = null;
                        }
                        if($sz0034 == 0){
                            $sz0033 = null;
                        }
                        
                        if(
                            ($sz0025 == null || $sz0025 == 0) && ($sz0026 == null || $sz0026 == 0) && ($sz0027 == null || $sz0027 == 0)
                            && ($sz0028 == null || $sz0028 == 0) && ($sz0029 == null || $sz0029 == 0) && ($sz0030 == null || $sz0030 == 0)
                            && ($sz0031 == null || $sz0031 == 0) && ($sz0032 == null || $sz0032 == 0) && ($sz0033 == null || $sz0033 == 0)
                            && ($sz0034 == null || $sz0034 == 0) && ($sz0035 == null || $sz0035 == 0) && ($sz0036 == null || $sz0036 == 0)
                        ){
                            $no_insertion_msg = "該当するデータがありません。";
                            Session::flash('no_insertion_msg', $no_insertion_msg);
                            pg_query($conn,"ROLLBACK");
                            return "ok";
                        }

                        $shiharaizandaka_insert_data = [
                            'sz0001' => $deadline,
                            'sz0002' => $bikou1,
                            'sz0003' => $sz0003,
                            'sz0004' => $sz0004,
                            'sz0005' => $sz0005,
                            'sz0006' => $sz0006,
                            'sz0007' => $sz0007,
                            'sz0008' => $sz0008,
                            'sz0009' => $sz0009,
                            'sz0010' => $sz0010,
                            'sz0011' => $sz0011,
                            'sz0012' => $sz0012,
                            'sz0014' => $sum_of_sr0012_3,
                            'sz0015' => $sz0015,
                            'sz0016' => $sz0016,
                            'sz0017' => $sz0017,
                            'sz0018' => $sz0018,
                            'sz0019' => $sz0019,
                            'sz0020' => $sz0020,
                            'sz0021' => $sz0021,
                            'sz0022' => $sz0022,
                            'sz0024' => $sz0024,
                            'sz0025' => $sz0025,
                            'sz0026' => $sz0026,
                            'sz0027' => $sz0027,
                            'sz0028' => $sz0028,
                            'sz0029' => $sz0029,
                            'sz0030' => $sz0030,
                            'sz0031' => $sz0031,
                            'sz0032' => $sz0032,
                            'sz0033' => $sz0033,
                            'sz0034' => $sz0034,
                            'sz0035' => $sz0035,
                            'sz0036' => $sz0036,
                            'sz0037' => $sz0037,
                            'sz0038' => $sz0038,
                            'sz0039' => $sz0039,
                        ];
                        $shiharaizandaka = QueryHelper::insertData('shiharaizandaka',$shiharaizandaka_insert_data,'sz0002',true,$bango,__CLASS__,__FUNCTION__,__LINE__);

                        $temp_success_msg[$bikou1] = "支払予定計算を行いました(".$bikou1."件)。";
                        Session::flash('temp_success_msg', $temp_success_msg);
                    }else if($temp_deadline != null && $bikou1 != null){
                        //delete previous data
                        QueryHelper::fetchSingleResult(" DELETE from shiharaizandaka where sz0001 ='$temp_deadline' AND sz0002 = '$bikou1' ");
                        
                        if($shiharaizandaka_previous_data){
                            $sz0003 = $shiharaizandaka_previous_data->sz0038;
                            $prev_sz0003 = $shiharaizandaka_previous_data->sz0003;
                            $sz0004 = $shiharaizandaka_previous_data->sz0039;
                            $prev_sz0004 = $shiharaizandaka_previous_data->sz0004;
                            $sz0006 = $shiharaizandaka_previous_data->sz0006;
                            $sz0007 = $shiharaizandaka_previous_data->sz0007;
                            $sz0008 = $shiharaizandaka_previous_data->sz0008;
                            $sz0011 = $shiharaizandaka_previous_data->sz0011;
                            $sz0012 = $shiharaizandaka_previous_data->sz0012;
                            $sz0013 = $shiharaizandaka_previous_data->sz0013;
                            $sz0018 = $shiharaizandaka_previous_data->sz0018;
                            $sz0023 = $shiharaizandaka_previous_data->sz0023;
                            $sz0027 = 'D906';
                            $sz0029 = 'D907';
                            $sz0033 = 'D906';
                            $sz0035 = 'D907';
                        }else{
                            $sz0003 = 0;
                            $prev_sz0003 = 0;
                            $sz0004 = 0;
                            $prev_sz0004 = 0;
                            $sz0006 = 0;
                            $sz0007 = 0;
                            $sz0008 = 0;
                            $sz0011 = 0;
                            $sz0012 = 0;
                            $sz0013 = 0;
                            $sz0018 = 0;
                            $sz0023 = 0;
                            $sz0027 = 'D906';
                            $sz0029 = 'D907';
                            $sz0033 = 'D906';
                            $sz0035 = 'D907';
                        }

                        if($other1 == 1){
                            $sz0025 = $balance_val[0]->hj0055;
                            $sz0031 = $balance_val[0]->hj0055;
                            if($balance_val[0]->hj0087 != null){
                                $hj0087 = $balance_val[0]->hj0087;
                                $temp_date = strtotime("+$hj0087 days", strtotime(str_replace("/","-",$deadline)));
                                $sz0037 = strftime ( '%Y-%m-%d' , $temp_date );
                                //$sz0037 = str_replace("/","-",$deadline).$balance_val[0]->hj0087;
                            }else{
                               $sz0037 = str_replace("/","-",$deadline)." 00:00:00"; 
                            }
                        }else{
                            $sz0025 = $balance_val[0]->jg0053;
                            $sz0031 = $balance_val[0]->jg0053;
                            if($balance_val[0]->jg0054 != null){
                                $jg0054 = $balance_val[0]->jg0054;
                                $temp_date = strtotime("+$jg0054 days", strtotime(str_replace("/","-",$deadline)));
                                $sz0037 = strftime ( '%Y-%m-%d' , $temp_date );
                                //$sz0037 = str_replace("/","-",$deadline).$balance_val[0]->jg0054;
                            }else{
                                $sz0037 = str_replace("/","-",$deadline)." 00:00:00";
                            }
                        }
                        
                        $sum_of_sr0011 = collect($paymentBalanceData)->sum('sr0011');
                        $sum_of_sr0011_2 = collect($paymentBalanceData)->where('sr0002',"<>",'70')->sum('sr0011');
                        $sz0005 = $sum_of_sr0011_2;
                        $sum_of_sr0011_3 = collect($paymentBalanceData)->where('sr0002',"=",'70')->sum('sr0011');
                        $sz0010 = $sum_of_sr0011_3;
                        $sum_of_sr0012 = collect($paymentBalanceData)->sum('sr0012');
                        $sum_of_sr0012_2 = collect($paymentBalanceData)->where('sr0002',"<>",'70')->sum('sr0012');
                        $sz0009 = $sum_of_sr0012_2;
                        $sum_of_sr0012_3 = collect($paymentBalanceData)->where('sr0002',"=",'70')->sum('sr0012');
                        $sz0014 = $sum_of_sr0012_3;
                        $sum_of_sm0003 = collect($paymentBalanceData)->sum('sm0003');
                        $sz0015 = collect($paymentBalanceData)->where('sh0017',1)->whereIn('datachar01',['01','02','04','05','08','10'])->sum('sm0003');
                        $sz0016 = collect($paymentBalanceData)->where('sh0017',1)->whereIn('datachar01',['03'])->sum('sm0003');
                        $sz0017 = collect($paymentBalanceData)->where('sh0017',1)->whereIn('datachar01',['09'])->sum('sm0003');
                        $sz0019 = collect($paymentBalanceData)->where('sh0017',1)->whereNotIn('datachar01',['01','02','03','04','05','08','09','10'])->sum('sm0003');
                        $sz0020 = collect($paymentBalanceData)->where('sh0017',2)->whereIn('datachar01',['01','02','04','05','08','10'])->sum('sm0003');
                        $sz0021 = collect($paymentBalanceData)->where('sh0017',2)->whereIn('datachar01',['03'])->sum('sm0003');
                        $sz0022 = collect($paymentBalanceData)->where('sh0017',2)->whereIn('datachar01',['09'])->sum('sm0003');
                        $sz0024 = collect($paymentBalanceData)->where('sh0017',2)->whereNotIn('datachar01',['01','02','03','04','05','08','09','10'])->sum('sm0003');
                        //$sz0038 = $prev_sz0003 + ($sz0005 + $sz0006 + $sz0007 + $sz0008 + $sz0009) - ($sz0015 + $sz0016 + $sz0017 + $sz0018 + $sz0019);
                        $sz0038 = $sz0003 + ($sz0005 + $sz0006 + $sz0007 + $sz0008 + $sz0009) - ($sz0015 + $sz0016 + $sz0017 + $sz0018 + $sz0019);
                        //$sz0039 = $prev_sz0004 + ($sz0010 + $sz0011 + $sz0012 + $sz0013 + $sz0014) - ($sz0020 + $sz0021 + $sz0022 + $sz0023 + $sz0024);
                        $sz0039 = $sz0004 + ($sz0010 + $sz0011 + $sz0012 + $sz0013 + $sz0014) - ($sz0020 + $sz0021 + $sz0022 + $sz0023 + $sz0024);

                        if($bikou1 != null){
                            $sz0028 = self::paymentAmountCal($sz0038,$bikou1,$datachar01_d901_count);
                        }else{
                            $sz0028 = 0;
                        }
                        if($bikou1 != null){
                            $sz0034 = self::paymentAmountCal($sz0039,$bikou1,$datachar01_d901_count);
                        }else{
                            $sz0034 = 0;
                        }
                        //$sz0034 = $sz0028;
                        $temp_sz0026 = $sz0038 - $sz0028;
                        $temp_sz0032 = $sz0039 - $sz0034;
                        if($temp_sz0026 > 0){
                            $data = self::withholdingTaxCal($temp_sz0026,$sz0028,$sz0034,$sz0038,$sz0039,$sz0009,$sz0014,$bikou1);
                            $sz0026 = $data['temp_sz0026'];
                            $sz0030 = $data['sz0030'];
                            $sz0032 = $data['sz0032'];
                            $sz0036 = $data['sz0036'];
                            //$data2 = self::withholdingTaxCal($temp_sz0032,$sz0034,$sz0038,$sz0039,$sz0009,$sz0014,$bikou1);
                            //$sz0032 = $data['temp_sz0026'];
                        }else{
                            $sz0026 = $temp_sz0026;
                            $sz0030 = 0;
                            $sz0036 = 0;
                            $sz0032 = 0;
                        }

                        if($sz0026 == 0){
                            $sz0025 = null;
                        }
                        if($sz0028 == 0){
                            $sz0027 = null;
                        }
                        if($sz0030 == 0){
                            $sz0029 = null;
                        }
                        if($sz0032 == 0){
                            $sz0031 = null;
                            $sz0035 = null;
                        }
                        if($sz0034 == 0){
                            $sz0033 = null;
                        }
                        
                        if(
                            ($sz0025 == null || $sz0025 == 0) && ($sz0026 == null || $sz0026 == 0) && ($sz0027 == null || $sz0027 == 0)
                            && ($sz0028 == null || $sz0028 == 0) && ($sz0029 == null || $sz0029 == 0) && ($sz0030 == null || $sz0030 == 0)
                            && ($sz0031 == null || $sz0031 == 0) && ($sz0032 == null || $sz0032 == 0) && ($sz0033 == null || $sz0033 == 0)
                            && ($sz0034 == null || $sz0034 == 0) && ($sz0035 == null || $sz0035 == 0) && ($sz0036 == null || $sz0036 == 0)
                        ){
                            $no_insertion_msg = "該当するデータがありません。";
                            Session::flash('no_insertion_msg', $no_insertion_msg);
                            pg_query($conn,"ROLLBACK");
                            return "ok";
                        }
                        
                        $shiharaizandaka_insert_data = [
                            'sz0001' => $deadline,
                            'sz0002' => $bikou1,
                            'sz0003' => $sz0003,
                            'sz0004' => $sz0004,
                            'sz0005' => $sz0005,
                            'sz0006' => $sz0006,
                            'sz0007' => $sz0007,
                            'sz0008' => $sz0008,
                            'sz0009' => $sz0009,
                            'sz0010' => $sz0010,
                            'sz0011' => $sz0011,
                            'sz0012' => $sz0012,
                            'sz0014' => $sum_of_sr0012_3,
                            'sz0015' => $sz0015,
                            'sz0016' => $sz0016,
                            'sz0017' => $sz0017,
                            'sz0018' => $sz0018,
                            'sz0019' => $sz0019,
                            'sz0020' => $sz0020,
                            'sz0021' => $sz0021,
                            'sz0022' => $sz0022,
                            'sz0024' => $sz0024,
                            'sz0025' => $sz0025,
                            'sz0026' => $sz0026,
                            'sz0027' => $sz0027,
                            'sz0028' => $sz0028,
                            'sz0029' => $sz0029,
                            'sz0030' => $sz0030,
                            'sz0031' => $sz0031,
                            'sz0032' => $sz0032,
                            'sz0033' => $sz0033,
                            'sz0034' => $sz0034,
                            'sz0035' => $sz0035,
                            'sz0036' => $sz0036,
                            'sz0037' => $sz0037,
                            'sz0038' => $sz0038,
                            'sz0039' => $sz0039,
                        ];
                        
                        $shiharaizandaka = QueryHelper::insertData('shiharaizandaka',$shiharaizandaka_insert_data,'sz0002',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                        $temp_success_msg[$bikou1] = "支払予定計算を行いました(".$bikou1."件)。";
                        Session::flash('temp_success_msg', $temp_success_msg);
                    }
                }
            }else{
                $bikou1 = substr($input['bikou1'],0,8);
                if($bikou1 != null){
                    $shiharaizandaka_previous_data = QueryHelper::fetchSingleResult("
                    select 
                    shiharaizandaka.*
                    from shiharaizandaka
                    where sz0001 ='$temp_deadline' AND sz0002 = '$bikou1'
                    ");
                    
                    if(!$shiharaizandaka_previous_data){
                       $shiharaizandaka_previous_data = QueryHelper::fetchSingleResult("
                        select 
                        shiharaizandaka.*
                        from shiharaizandaka
                        where sz0002 = '$bikou1'
                        AND sz0001 <= '$temp_deadline'
                        order by sz0001 desc
                        "); 
                    }
                }else{
                    $shiharaizandaka_previous_data = QueryHelper::fetchSingleResult("
                    select 
                    shiharaizandaka.*
                    from shiharaizandaka
                    where sz0001 ='$temp_deadline'
                    ");
                    if($shiharaizandaka_previous_data){
                    $bikou1 = $shiharaizandaka_previous_data->sz0002;
                    }
                }

                //error check starts
                $shiharaizandaka_temp_data = QueryHelper::fetchSingleResult("
                select 
                MAX(sz0001) as max_sz0001
                from shiharaizandaka
                where sz0001 < '$temp_deadline' AND sz0002 = '$bikou1'  
                group by sz0002
                ");
                if($shiharaizandaka_temp_data){
                    $end_sz0001 = $shiharaizandaka_temp_data->max_sz0001;
                    $effectiveDate = strtotime("-3 months", strtotime($end_sz0001));
                    $start_sz0001 = strftime ( '%Y-%m-%d' , $effectiveDate )." 00:00:00";
//                    $toiawasebango_temp_data = QueryHelper::fetchSingleResult("
//                    select 
//                    toiawasebango.min_unsoumei,
//                    temp2_toiawasebango.datanum0014
//                    from (select MIN(unsoumei) as min_unsoumei from toiawasebango as temp_toiawasebango where temp_toiawasebango.touchakudate > '$start_sz0001' AND temp_toiawasebango.touchakudate < '$end_sz0001' AND bikou1 = '$bikou1') as toiawasebango
//                    join toiawasebango as temp2_toiawasebango on temp2_toiawasebango.unsoumei = toiawasebango.min_unsoumei
//                    ");
                    $toiawasebango_temp_data = QueryHelper::fetchResult("
                    select unsoumei,datanum0014 from toiawasebango as temp_toiawasebango 
                    where temp_toiawasebango.touchakudate > '$start_sz0001' AND temp_toiawasebango.touchakudate < '$end_sz0001'
                    AND bikou1 = '$bikou1'
                    ");
                    $min_unsoumei = collect($toiawasebango_temp_data)->min('unsoumei');
                    $data_count = collect($toiawasebango_temp_data)->where('unsoumei',"=",$min_unsoumei)->where('datanum0014',"=",null)->count();
                }else{
                    $end_sz0001 = null;
                    $start_sz0001 = null;
                    $toiawasebango_temp_data = false;
                    $min_unsoumei = null;
                    $data_count = 0;
                }

                //if($toiawasebango_temp_data && $toiawasebango_temp_data->datanum0014 == null){
                if($data_count > 0){
                    //$msg = "支払予定計算で集計漏れがあります。(仕入番号".$toiawasebango_temp_data->min_unsoumei.")";
                    $msg = "支払予定計算で集計漏れがあります。(仕入番号".$min_unsoumei.")";
                    $arr = [
                        "status" => 'data_check_err',
                        "msg" => $msg
                    ];
                    Session::forget('temp_success_msg');
                    pg_query($conn,"ROLLBACK");
                    return $arr;
                }
                //error check ends
                

                if($shiharaizandaka_previous_data && ($shiharaizandaka_previous_data->sz0038 >= 1 || $shiharaizandaka_previous_data->sz0039 >= 1))
                { 
                    //delete previous data
                    QueryHelper::fetchSingleResult(" DELETE from shiharaizandaka where sz0001 ='$temp_deadline' AND sz0002 = '$bikou1' ");

                    if($shiharaizandaka_previous_data){
                        //$sz0003 = $shiharaizandaka_previous_data->sz0038;
                        $sz0003 = $shiharaizandaka_previous_data->sz0003;
                        $prev_sz0003 = $shiharaizandaka_previous_data->sz0003;
                        //$sz0004 = $shiharaizandaka_previous_data->sz0039;
                        $sz0004 = $shiharaizandaka_previous_data->sz0004;
                        $prev_sz0004 = $shiharaizandaka_previous_data->sz0004;
                        $sz0006 = $shiharaizandaka_previous_data->sz0006;
                        $sz0007 = $shiharaizandaka_previous_data->sz0007;
                        $sz0008 = $shiharaizandaka_previous_data->sz0008;
                        $sz0011 = $shiharaizandaka_previous_data->sz0011;
                        $sz0012 = $shiharaizandaka_previous_data->sz0012;
                        $sz0013 = $shiharaizandaka_previous_data->sz0013;
                        $sz0018 = $shiharaizandaka_previous_data->sz0018;
                        $sz0023 = $shiharaizandaka_previous_data->sz0023;
                        $sz0027 = 'D906';
                        $sz0029 = 'D907';
                        $sz0033 = 'D906';
                        $sz0035 = 'D907';
                        $sz0038 = $shiharaizandaka_previous_data->sz0038;
                        $sz0039 = $shiharaizandaka_previous_data->sz0039;
                    }else{
                        $sz0003 = 0;
                        $prev_sz0003 = 0;
                        $sz0004 = 0;
                        $prev_sz0004 = 0;
                        $sz0006 = 0;
                        $sz0007 = 0;
                        $sz0008 = 0;
                        $sz0011 = 0;
                        $sz0012 = 0;
                        $sz0013 = 0;
                        $sz0018 = 0;
                        $sz0023 = 0;
                        $sz0027 = 'D906';
                        $sz0029 = 'D907';
                        $sz0033 = 'D906';
                        $sz0035 = 'D907';
                        $sz0038 = 0;
                        $sz0039 = 0;
                    }

                    //cal $sz0025,$sz0031
//                    $kokyakuCode = substr($bikou1, 0,6);
//                    $haisouCode = substr($bikou1, 6,2);
//                    $kokyaku = QueryHelper::select(['bango'])->from('kokyaku1')->where("yobi12 = '$kokyakuCode' ")->get()->first();
//                    $haisoujouhou = QueryHelper::select(['bunrui3,datatxt0051'])->from('haisoujouhou')->where("syukei1 = '$kokyaku->bango' ")->get()->first();
//                    $others2 = QueryHelper::fetchResult("select substring(other1,1,1) as other1,other24 from others2 where otherint1 = (select bango from haisou where haisou.shikibetsucode = '$kokyakuCode' and haisou.torihikisakibango = '$haisouCode')");
//                    if($others2[0]->other1 == '1'){
//                        $sz0025 = $haisoujouhou->bunrui3;
//                        $sz0031 = $haisoujouhou->bunrui3;
//                    }else{
//                        $sz0025 = $others2[0]->other24;
//                        $sz0031 = $others2[0]->other24;
//                    }
                    
                    $sz0037 = null;
                    $sum_of_sr0011 = 0;
                    $sum_of_sr0011_2 = 0;
                    $sz0005 = 0;
                    $sum_of_sr0011_3 = 0;
                    $sz0010 = 0;
                    $sum_of_sr0012 = 0;
                    $sum_of_sr0012_2 = 0;
                    $sz0009 = 0;
                    $sum_of_sr0012_3 = 0;
                    $sz0014 = 0;
                    $sum_of_sm0003 = 0;
                    $sz0015 = 0;
                    $sz0016 = 0;
                    $sz0017 = 0;
                    $sz0019 = 0;
                    $sz0020 = 0;
                    $sz0021 = 0;
                    $sz0022 = 0;
                    $sz0024 = 0;

//                    if($bikou1 != null){
//                        $sz0028 = self::paymentAmountCal($sz0038,$bikou1,0);
//                    }else{
//                        $sz0028 = 0;
//                    }
//                    
//                    if($bikou1 != null){
//                        $sz0034 = self::paymentAmountCal($sz0039,$bikou1,0);
//                    }else{
//                        $sz0034 = 0;
//                    }
                    
//                    $temp_sz0026 = $sz0038 - $sz0028;
//                    $temp_sz0032 = $sz0039 - $sz0034;
//                    if($temp_sz0026 > 0){
//                        $data = self::withholdingTaxCal($temp_sz0026,$sz0028,$sz0034,$sz0038,$sz0039,$sz0009,$sz0014,$bikou1);
//                        $sz0026 = $data['temp_sz0026'];
//                        $sz0030 = $data['sz0030'];
//                        $sz0032 = $data['sz0032'];
//                        $sz0036 = $data['sz0036'];
//                        //$data2 = self::withholdingTaxCal($temp_sz0032,$sz0034,$sz0038,$sz0039,$sz0009,$sz0014,$bikou1);
//                    }else{
//                        $sz0026 = $temp_sz0026;
//                        $sz0030 = 0;
//                        $sz0036 = 0;
//                        $sz0032 = 0;
//                    }

                    //if($sz0026 == 0){
                     //   $sz0025 = null;
                   // }
                    //if($sz0028 == 0){
                    //    $sz0027 = null;
                   // }
                    //if($sz0030 == 0){
                    //    $sz0029 = null;
                    //}
                    //if($sz0032 == 0){
                    //    $sz0031 = null;
                    //    $sz0035 = null;
                   // }
                    //if($sz0034 == 0){
                     //   $sz0033 = null;
                    //}
                    
//                    if(
//                        ($sz0025 == null || $sz0025 == 0) && ($sz0026 == null || $sz0026 == 0) && ($sz0027 == null || $sz0027 == 0)
//                        && ($sz0028 == null || $sz0028 == 0) && ($sz0029 == null || $sz0029 == 0) && ($sz0030 == null || $sz0030 == 0)
//                        && ($sz0031 == null || $sz0031 == 0) && ($sz0032 == null || $sz0032 == 0) && ($sz0033 == null || $sz0033 == 0)
//                        && ($sz0034 == null || $sz0034 == 0) && ($sz0035 == null || $sz0035 == 0) && ($sz0036 == null || $sz0036 == 0)
//                    ){
//                        $no_insertion_msg = "該当するデータがありません。";
//                        Session::flash('no_insertion_msg', $no_insertion_msg);
//                        pg_query($conn,"ROLLBACK");
//                        return "ok";
//                    }
                    
                    $sz0025 = null;
                    $sz0026 = 0;
                    $sz0027 = null;
                    $sz0028 = 0;
                    $sz0029 = null;
                    $sz0030 = 0;
                    $sz0031 = null;
                    $sz0032 = 0;
                    $sz0033 = null;
                    $sz0034 = 0;
                    $sz0035 = null;
                    $sz0036 = 0;
                      
                    $shiharaizandaka_insert_data = [
                        'sz0001' => $deadline,
                        'sz0002' => $bikou1,
                        'sz0003' => $sz0003,
                        'sz0004' => $sz0004,
                        'sz0005' => $sz0005,
                        'sz0006' => $sz0006,
                        'sz0007' => $sz0007,
                        'sz0008' => $sz0008,
                        'sz0009' => $sz0009,
                        'sz0010' => $sz0010,
                        'sz0011' => $sz0011,
                        'sz0012' => $sz0012,
                        'sz0014' => $sum_of_sr0012_3,
                        'sz0015' => $sz0015,
                        'sz0016' => $sz0016,
                        'sz0017' => $sz0017,
                        'sz0018' => $sz0018,
                        'sz0019' => $sz0019,
                        'sz0020' => $sz0020,
                        'sz0021' => $sz0021,
                        'sz0022' => $sz0022,
                        'sz0024' => $sz0024,
                        'sz0025' => $sz0025,
                        'sz0026' => $sz0026,
                        'sz0027' => $sz0027,
                        'sz0028' => $sz0028,
                        'sz0029' => $sz0029,
                        'sz0030' => $sz0030,
                        'sz0031' => $sz0031,
                        'sz0032' => $sz0032,
                        'sz0033' => $sz0033,
                        'sz0034' => $sz0034,
                        'sz0035' => $sz0035,
                        'sz0036' => $sz0036,
                        'sz0037' => $sz0037,
                        'sz0038' => $sz0038,
                        'sz0039' => $sz0039,
                    ];
                    
                    $shiharaizandaka = QueryHelper::insertData('shiharaizandaka',$shiharaizandaka_insert_data,'sz0002',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                    $temp_success_msg[$shiharaizandaka_previous_data->sz0002] = "支払予定計算を行いました(".$shiharaizandaka_previous_data->sz0002."件)。";
                    Session::flash('temp_success_msg', $temp_success_msg);
                }else if($temp_deadline != null && $bikou1 != null){
                    //delete previous data
                    QueryHelper::fetchSingleResult(" DELETE from shiharaizandaka where sz0001 ='$temp_deadline' AND sz0002 = '$bikou1' ");
                        
                    if($shiharaizandaka_previous_data){
                        $sz0003 = $shiharaizandaka_previous_data->sz0038;
                        $prev_sz0003 = $shiharaizandaka_previous_data->sz0003;
                        $sz0004 = $shiharaizandaka_previous_data->sz0039;
                        $prev_sz0004 = $shiharaizandaka_previous_data->sz0004;
                        $sz0006 = $shiharaizandaka_previous_data->sz0006;
                        $sz0007 = $shiharaizandaka_previous_data->sz0007;
                        $sz0008 = $shiharaizandaka_previous_data->sz0008;
                        $sz0011 = $shiharaizandaka_previous_data->sz0011;
                        $sz0012 = $shiharaizandaka_previous_data->sz0012;
                        $sz0013 = $shiharaizandaka_previous_data->sz0013;
                        $sz0018 = $shiharaizandaka_previous_data->sz0018;
                        $sz0023 = $shiharaizandaka_previous_data->sz0023;
                        //$sz0027 = 'D906';
                        //$sz0029 = 'D907';
                        //$sz0033 = 'D906';
                        //$sz0035 = 'D907';
                    }else{
                        $sz0003 = 0;
                        $prev_sz0003 = 0;
                        $sz0004 = 0;
                        $prev_sz0004 = 0;
                        $sz0006 = 0;
                        $sz0007 = 0;
                        $sz0008 = 0;
                        $sz0011 = 0;
                        $sz0012 = 0;
                        $sz0013 = 0;
                        $sz0018 = 0;
                        $sz0023 = 0;
                        //$sz0027 = 'D906';
                        //$sz0029 = 'D907';
                        //$sz0033 = 'D906';
                        //$sz0035 = 'D907';
                    }

                    //$sz0025 = null;
                    //$sz0031 = null;
                    $sz0037 = null;
                    $sum_of_sr0011 = 0;
                    $sum_of_sr0011_2 = 0;
                    $sz0005 = 0;
                    $sum_of_sr0011_3 = 0;
                    $sz0010 = 0;
                    $sum_of_sr0012 = 0;
                    $sum_of_sr0012_2 = 0;
                    $sz0009 = 0;
                    $sum_of_sr0012_3 = 0;
                    $sz0014 = 0;
                    $sum_of_sm0003 = 0;
                    $sz0015 = 0;
                    $sz0016 = 0;
                    $sz0017 = 0;
                    $sz0019 = 0;
                    $sz0020 = 0;
                    $sz0021 = 0;
                    $sz0022 = 0;
                    $sz0024 = 0;
                    $sz0038 = $prev_sz0003;
                    $sz0039 = $prev_sz0004;

//                    if($bikou1 != null){
//                        $sz0028 = self::paymentAmountCal($sz0038,$bikou1,0);
//                    }else{
//                        $sz0028 = 0;
//                    }
                    
//                    if($bikou1 != null){
//                        $sz0034 = self::paymentAmountCal($sz0039,$bikou1,0);
//                    }else{
//                        $sz0034 = 0;
//                    }
                  
//                    $temp_sz0026 = $sz0038 - $sz0028;
//                    $temp_sz0032 = $sz0039 - $sz0034;
//                    if($temp_sz0026 > 0){
//                        $data = self::withholdingTaxCal($temp_sz0026,$sz0028,$sz0034,$sz0038,$sz0039,$sz0009,$sz0014,$bikou1);
//                        $sz0026 = $data['temp_sz0026'];
//                        $sz0030 = $data['sz0030'];
//                        $sz0032 = $data['sz0032'];
//                        $sz0036 = $data['sz0036'];
//                    }else{
//                        $sz0026 = $temp_sz0026;
//                        $sz0030 = 0;
//                        $sz0036 = 0;
//                        $sz0032 = 0;
//                    }
                    
//                    if($sz0026 == 0){
//                        $sz0025 = null;
//                    }
//                    if($sz0028 == 0){
//                        $sz0027 = null;
//                    }
//                    if($sz0030 == 0){
//                        $sz0029 = null;
//                    }
//                    if($sz0032 == 0){
//                        $sz0031 = null;
//                        $sz0035 = null;
//                    }
//                    if($sz0034 == 0){
//                        $sz0033 = null;
//                    }
                    
//                    if(
//                        ($sz0025 == null || $sz0025 == 0) && ($sz0026 == null || $sz0026 == 0) && ($sz0027 == null || $sz0027 == 0)
//                        && ($sz0028 == null || $sz0028 == 0) && ($sz0029 == null || $sz0029 == 0) && ($sz0030 == null || $sz0030 == 0)
//                        && ($sz0031 == null || $sz0031 == 0) && ($sz0032 == null || $sz0032 == 0) && ($sz0033 == null || $sz0033 == 0)
//                        && ($sz0034 == null || $sz0034 == 0) && ($sz0035 == null || $sz0035 == 0) && ($sz0036 == null || $sz0036 == 0)
//                    ){
//                        $no_insertion_msg = "該当するデータがありません。";
//                        Session::flash('no_insertion_msg', $no_insertion_msg);
//                        pg_query($conn,"ROLLBACK");
//                        return "ok";
//                    }
                    
                    $sz0025 = null;
                    $sz0026 = 0;
                    $sz0027 = null;
                    $sz0028 = 0;
                    $sz0029 = null;
                    $sz0030 = 0;
                    $sz0031 = null;
                    $sz0032 = 0;
                    $sz0033 = null;
                    $sz0034 = 0;
                    $sz0035 = null;
                    $sz0036 = 0;
                    
                    $shiharaizandaka_insert_data = [
                        'sz0001' => $deadline,
                        'sz0002' => $bikou1,
                        'sz0003' => $sz0003,
                        'sz0004' => $sz0004,
                        'sz0005' => $sz0005,
                        'sz0006' => $sz0006,
                        'sz0007' => $sz0007,
                        'sz0008' => $sz0008,
                        'sz0009' => $sz0009,
                        'sz0010' => $sz0010,
                        'sz0011' => $sz0011,
                        'sz0012' => $sz0012,
                        'sz0014' => $sum_of_sr0012_3,
                        'sz0015' => $sz0015,
                        'sz0016' => $sz0016,
                        'sz0017' => $sz0017,
                        'sz0018' => $sz0018,
                        'sz0019' => $sz0019,
                        'sz0020' => $sz0020,
                        'sz0021' => $sz0021,
                        'sz0022' => $sz0022,
                        'sz0024' => $sz0024,
                        'sz0025' => $sz0025,
                        'sz0026' => $sz0026,
                        'sz0027' => $sz0027,
                        'sz0028' => $sz0028,
                        'sz0029' => $sz0029,
                        'sz0030' => $sz0030,
                        'sz0031' => $sz0031,
                        'sz0032' => $sz0032,
                        'sz0033' => $sz0033,
                        'sz0034' => $sz0034,
                        'sz0035' => $sz0035,
                        'sz0036' => $sz0036,
                        'sz0037' => $sz0037,
                        'sz0038' => $sz0038,
                        'sz0039' => $sz0039,
                    ];
                    $shiharaizandaka = QueryHelper::insertData('shiharaizandaka',$shiharaizandaka_insert_data,'sz0002',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                    $temp_success_msg[$bikou1] = "支払予定計算を行いました(".$bikou1."件)。";
                    Session::flash('temp_success_msg', $temp_success_msg);
                }

            }
            
            if(count($paymentBalanceData) > 0){
                foreach($paymentBalanceData as $key=>$val){
                    if($val->table_name == 'toiawasebango'){
                        //update toiawasebango data
                        $purchase_number = $val->purchase_number;
                        $toiawasebango_update_data = [
                                'unsoumei' => $val->purchase_number,
                                'datanum0014' => str_replace("/","",$deadline),
                        ];
                        QueryHelper::updateData('toiawasebango', $toiawasebango_update_data, ['unsoumei' => $purchase_number], $bango, __CLASS__, __FUNCTION__, __LINE__);
                    }elseif($val->table_name == 'nyuko'){
                        //update nyuko data
                        $purchase_number = $val->purchase_number;
                        $nyuko_update_data = [
                            'syouhinid' => $purchase_number,
                            'denpyoshimebi' => $deadline,
                        ];
                        QueryHelper::updateData('nyuko', $nyuko_update_data, ['syouhinid' => $purchase_number], $bango, __CLASS__, __FUNCTION__, __LINE__);
                    }
                }
            }
            
//            //kaikakezandaka insertion starts here
//           
//            if(count($accountsPayableData) > 0){
//                $tempPayableData = collect($accountsPayableData)->groupBy('company_code');
//                foreach($tempPayableData as $pay_key=>$pay_val){
//                    $bikou1 = $pay_key;
//                    $other1 = substr($pay_val[0]->other1,0,1);
//                    $kaikakezandaka_previous_data = QueryHelper::fetchSingleResult("
//                    select 
//                    kaikakezandaka.*
//                    from kaikakezandaka
//                    where kk0001 ='$temp_deadline' AND kk0002 = '$bikou1'
//                    ");
//                    
//                    if($kaikakezandaka_previous_data && $kaikakezandaka_previous_data->kk0015 < 1)
//                    { 
//                    //delete previous data
//                    QueryHelper::fetchSingleResult(" DELETE from kaikakezandaka where kk0001 ='$temp_deadline' AND kk0002 = '$bikou1' ");
//
//                    if($kaikakezandaka_previous_data){
//                        $kk0004 = $kaikakezandaka_previous_data->kk0004;
//                        $kk0006 = $kaikakezandaka_previous_data->kk0006;
//                        $kk0007 = $kaikakezandaka_previous_data->kk0007;
//                        $kk0008 = $kaikakezandaka_previous_data->kk0008;
//                        $kk0013 = $kaikakezandaka_previous_data->kk0013;
//                    }else{
//                        $kk0004 = 0;
//                        $kk0006 = 0;
//                        $kk0007 = 0;
//                        $kk0008 = 0;
//                        $kk0013 = 0;
//                    }
//                    
//                    $sum_of_sr0011_acc = collect($accountsPayableData)->sum('sr0011');
//                    $sum_of_sr0011_acc_2 = collect($accountsPayableData)->where('sr0002',"<>",'70')->sum('sr0011');
//                    $kk0005 = $sum_of_sr0011_acc_2;
//                    $sum_of_sr0012_acc = collect($accountsPayableData)->sum('sr0012');
//                    $sum_of_sr0012_acc_2 = collect($accountsPayableData)->where('sr0002',"<>",'70')->sum('sr0012');
//                    $kk0009 = $sum_of_sr0012_acc_2;
//                    $sum_of_sm0003_2 = collect($accountsPayableData)->sum('sm0003');
//                    $kk0010 = collect($accountsPayableData)->where('sh0017',1)->whereIn('datachar01',['01','02','04','05','08'])->sum('sm0003');
//                    $kk0011 = collect($accountsPayableData)->where('sh0017',1)->whereIn('datachar01',['03'])->sum('sm0003');
//                    $kk0012 = collect($accountsPayableData)->where('sh0017',1)->whereIn('datachar01',['09'])->sum('sm0003');
//                    $kk0014 = collect($accountsPayableData)->where('sh0017',1)->whereIn('datachar01',['01','02','03','04','05','08','09'])->sum('sm0003');
//                    $kk0015 = $kk0004 + ($kk0005+$kk0006+$kk0007+$kk0008+$kk0009) - ($kk0010+$kk0011+$kk0012+$kk0013+$kk0014);
//                    
//                    //dd($kk0005,$kk0009,$kk0011,$kk0012,$kk0015);
//                     $kaikakezandaka_insert_arr1 = [
//                        'kk0001' => $deadline,
//                        'kk0002' => $bikou1,
//                    ];
//                    if($other1 == 1){
//                        $kaikakezandaka_insert_arr2 = [
//                            'kk0003' => 1,
//                            'kk0004' => $kk0004,
//                            'kk0005' => $kk0005,
//                            'kk0009' => $kk0009,
//                            'kk0010' => $kk0010,
//                            'kk0011' => $kk0011,
//                            'kk0012' => $kk0012,
//                            'kk0014' => $kk0014,
//                            'kk0015' => $kk0015,
//
//                        ];
//                    }else{
//                        $kaikakezandaka_insert_arr2 = [
//                            'kk0003' => 2,
//                            'kk0004' => $kk0004,
//                            'kk0005' => $kk0005,
//                            'kk0009' => $kk0009,
//                            'kk0010' => $kk0010,
//                            'kk0011' => $kk0011,
//                            'kk0012' => $kk0012,
//                            'kk0014' => $kk0014,
//                            'kk0015' => $kk0015,
//                        ];
//                    }
//                    $kaikakezandaka_insert_data = array_merge($kaikakezandaka_insert_arr1,$kaikakezandaka_insert_arr2);
//                    $kaikakezandaka = QueryHelper::insertData('kaikakezandaka',$kaikakezandaka_insert_data,'kk0002',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
//                    $success_msg[$bikou1] = "支払予定計算を行いました(".$bikou1."件)。";
//                     Session::flash('success_msg', $success_msg);
//                    }else if($temp_deadline != null && $bikou1 != null){
//                        //delete previous data
//                    QueryHelper::fetchSingleResult(" DELETE from kaikakezandaka where kk0001 ='$temp_deadline' AND kk0002 = '$bikou1' ");
//                    
//                        if($kaikakezandaka_previous_data){
//                            $kk0004 = $kaikakezandaka_previous_data->kk0004;
//                            $kk0006 = $kaikakezandaka_previous_data->kk0006;
//                            $kk0007 = $kaikakezandaka_previous_data->kk0007;
//                            $kk0008 = $kaikakezandaka_previous_data->kk0008;
//                            $kk0013 = $kaikakezandaka_previous_data->kk0013;
//                            $kk0015 = $kaikakezandaka_previous_data->kk0015;
//                        }else{
//                            $kk0004 = 0;
//                            $kk0006 = 0;
//                            $kk0007 = 0;
//                            $kk0008 = 0;
//                            $kk0013 = 0;
//                            $kk0015 = 0;
//                        }
//                        $kaikakezandaka_insert_data = [
//                            'kk0001' => $deadline,
//                            'kk0002' => $bikou1,
//                            'kk0004' => $kk0004,
//                            'kk0006' => $kk0006,
//                            'kk0007' => $kk0007,
//                            'kk0008' => $kk0008,
//                            'kk0013' => $kk0013,
//                            'kk0015' => $kk0015,
//                        ];
//                        $kaikakezandaka = QueryHelper::insertData('kaikakezandaka',$kaikakezandaka_insert_data,'kk0002',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
//                        $success_msg[$bikou1] = "支払予定計算を行いました(".$bikou1."件)。";
//                        Session::flash('success_msg', $success_msg);
//                    }
//                }
//            }else{
//                $bikou1 = $input['bikou1'];
//                
//                $sum_of_sr0011_acc = 0;
//                $sum_of_sr0011_acc_2 = 0;
//                $kk0005 = 0;
//                $sum_of_sr0012_acc = 0;
//                $sum_of_sr0012_acc_2 = 0;
//                $kk0009 = 0;
//                $sum_of_sm0003_2 = 0;
//                $kk0010 = 0;
//                $kk0011 = 0;
//                $kk0012 = 0;
//                $kk0014 = 0;
//                $kk0015 = 0;
//                
//                if($bikou1 != null){
//                    $kaikakezandaka_previous_data = QueryHelper::fetchSingleResult("
//                    select 
//                    kaikakezandaka.*
//                    from kaikakezandaka
//                    where kk0001 ='$temp_deadline' AND kk0002 = '$bikou1'
//                    ");
//                }else{
//                    $kaikakezandaka_previous_data = QueryHelper::fetchSingleResult("
//                    select 
//                    kaikakezandaka.*
//                    from kaikakezandaka
//                    where kk0001 ='$temp_deadline'
//                    ");
//                    if($kaikakezandaka_previous_data){
//                    $bikou1 = $kaikakezandaka_previous_data->kk0002;
//                    }
//                }
//
//                if($kaikakezandaka_previous_data && $kaikakezandaka_previous_data->kk0015 < 1)
//                { 
//                    //delete previous data
//                    QueryHelper::fetchSingleResult(" DELETE from kaikakezandaka where kk0001 ='$temp_deadline' AND kk0002 = '$bikou1' ");
//
//                    $kk0004 = $kaikakezandaka_previous_data->kk0004;
//                    $kk0006 = $kaikakezandaka_previous_data->kk0006;
//                    $kk0007 = $kaikakezandaka_previous_data->kk0007;
//                    $kk0008 = $kaikakezandaka_previous_data->kk0008;
//                    $kk0013 = $kaikakezandaka_previous_data->kk0013;
//                    $kk0015 = $kaikakezandaka_previous_data->kk0015;
//
//                    $kaikakezandaka_insert_data = [
//                        'kk0001' => $deadline,
//                        'kk0002' => $bikou1,
//                        'kk0004' => $kk0004,
//                        'kk0006' => $kk0006,
//                        'kk0007' => $kk0007,
//                        'kk0008' => $kk0008,
//                        'kk0013' => $kk0013,
//                        'kk0015' => $kk0015,
//                    ];
//                    $kaikakezandaka = QueryHelper::insertData('kaikakezandaka',$kaikakezandaka_insert_data,'kk0002',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
//                    $success_msg[$kaikakezandaka_previous_data->kk0002] = "支払予定計算を行いました(".$kaikakezandaka_previous_data->kk0002."件)。";
//                    Session::flash('success_msg', $success_msg);
//                }else if($temp_deadline != null && $bikou1 != null){
//                    //delete previous data
//                    QueryHelper::fetchSingleResult(" DELETE from kaikakezandaka where kk0001 ='$temp_deadline' AND kk0002 = '$bikou1' ");
//                    
//                    if($kaikakezandaka_previous_data){
//                        $kk0004 = $kaikakezandaka_previous_data->kk0004;
//                        $kk0006 = $kaikakezandaka_previous_data->kk0006;
//                        $kk0007 = $kaikakezandaka_previous_data->kk0007;
//                        $kk0008 = $kaikakezandaka_previous_data->kk0008;
//                        $kk0013 = $kaikakezandaka_previous_data->kk0013;
//                        $kk0015 = $kaikakezandaka_previous_data->kk0015;
//                    }else{
//                        $kk0004 = 0;
//                        $kk0006 = 0;
//                        $kk0007 = 0;
//                        $kk0008 = 0;
//                        $kk0013 = 0;
//                        $kk0015 = 0;
//                    }
//
//                    $kaikakezandaka_insert_data = [
//                        'kk0001' => $deadline,
//                        'kk0002' => $bikou1,
//                        'kk0004' => $kk0004,
//                        'kk0006' => $kk0006,
//                        'kk0007' => $kk0007,
//                        'kk0008' => $kk0008,
//                        'kk0013' => $kk0013,
//                        'kk0015' => $kk0015,
//                    ];
//                    $kaikakezandaka = QueryHelper::insertData('kaikakezandaka',$kaikakezandaka_insert_data,'kk0002',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
//                    $success_msg[$bikou1] = "支払予定計算を行いました(".$bikou1."件)。";
//                    Session::flash('success_msg', $success_msg);
//                }
//            }
            //kaikakezandaka insertion ends here
            
            //end log query
            $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 支払予定計算 end\n";
            QueryHandler::logger($bango,$log_data);
            
            if(session()->get('temp_success_msg') == null){
                $no_insertion_msg = "該当するデータがありません。";
                Session::flash('no_insertion_msg', $no_insertion_msg);
            }

            $no_of_creation = count(session()->get('temp_success_msg'));
            $success_msg[] = "支払予定計算を行いました(".$no_of_creation."件)。";
            Session::flash('success_msg', $success_msg);
            pg_query($conn, "COMMIT");
            return "ok";

//            } catch (\Exception $e) {
//                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
//                QueryHandler::logger($bango, $log_data);
//                pg_query($conn,"ROLLBACK");
//                return "ng";
//            }
		
    }
    
    public function withholdingTaxCal($temp_sz0026,$sz0028,$sz0034,$sz0038,$sz0039,$sz0009,$sz0014,$bikou1){
        $kokyakuCode = substr($bikou1, 0,6);
        $haisouCode = substr($bikou1, 6,2);
        $kokyaku = QueryHelper::select(['bango,mallsoukobango1'])->from('kokyaku1')->where("yobi12 = '$kokyakuCode' ")->get()->first();
        $haisoujouhou = QueryHelper::select(['datatxt0051,syukei2,syukeinenkijun'])->from('haisoujouhou')->where("syukei1 = '$kokyaku->bango' ")->get()->first();
        $others2 = QueryHelper::fetchResult("select other1,otherfloat3,other30 from others2 where otherint1 = (select bango from haisou where haisou.shikibetsucode = '$kokyakuCode' and haisou.torihikisakibango = '$haisouCode')");
        if(substr($others2[0]->other1,0,1) == '1'){
            $tax_rate = $haisoujouhou->syukei2;
        }else{
            $tax_rate = $others2[0]->otherfloat3;
        }
        
        if($tax_rate == null){
            $arr = [
                "temp_sz0026" => $temp_sz0026,
                "sz0030" => 0,
                "sz0032" => 0,
                "sz0036" => 0
            ];
            return $arr;
        }else{
            //$sz0030 = $sz0038 - $sz0009;
            //$sz0036 = $sz0039 - $sz0014;
            $temp_sz0030 = $sz0038 - $sz0009;
            $temp_sz0036 = $sz0039 - $sz0014;
            
            $sz0030 = floor(($temp_sz0030 * $tax_rate) / 100);
            $sz0036 = floor(($temp_sz0036 * $tax_rate) / 100);
            
            $temp_sz0026 = $sz0038 - $sz0030 - $sz0028;
            $sz0032 = $sz0039 - $sz0036;
            
            //$sum = $sz0030 + $sz0036;
            //$temp_sz0026 = floor((($sz0030 + $sz0036) * $tax_rate) / 100);
            //$sz0036 = $temp_sz0026;
            //if($sz0038 > $sz0039){
            //    $temp_sz0026 = $sz0038 - $temp_sz0026;
            //}
            //if($sz0038 < $sz0039){
                //$temp_sz0026 = $sum - $temp_sz0026;
            //    $temp_sz0026 = $sz0039 - $temp_sz0026;
            //}
            //if($sz0038 == $sz0039){
            //    $temp_sz0026 = $sz0038 - $temp_sz0026;
            //}
            
            //if($sz0034 > 0){
            //    $temp_sz0026 = $temp_sz0026 - $sz0034;
            //}
            
            $arr = [
                "temp_sz0026" => $temp_sz0026,
                "sz0030" => $sz0030,
                "sz0032" => $sz0032,
                "sz0036" => $sz0036
            ];
            
            return $arr;
        }
    }
    
    public function paymentAmountCal($checking_val,$bikou1,$datachar01_d901_count){
        $kokyakuCode = substr($bikou1, 0,6);
        $haisouCode = substr($bikou1, 6,2);
        $kokyaku = QueryHelper::select(['bango,mallsoukobango1'])->from('kokyaku1')->where("yobi12 = '$kokyakuCode' ")->get()->first();
        $haisoujouhou = QueryHelper::select(['datatxt0051,syukei2,syukeinenkijun'])->from('haisoujouhou')->where("syukei1 = '$kokyaku->bango' ")->get()->first();
        $others2 = QueryHelper::fetchResult("select other1,otherfloat3,other30 from others2 where otherint1 = (select bango from haisou where haisou.shikibetsucode = '$kokyakuCode' and haisou.torihikisakibango = '$haisouCode')");
		
        if(substr($others2[0]->other1,0,1) == '1'){
            //$temp_val = substr($others2[0]->other1,0,1);
            $syukeinenkijun = $haisoujouhou->syukeinenkijun;
			$temp_val = str_replace("F2","",$syukeinenkijun);
            if($datachar01_d901_count > 0){
                if($checking_val < 10000){
                    //$category2 = "00".$temp_val."01";
                    $category2 = $temp_val."01";
                }elseif($checking_val >= 10000 && $checking_val < 30000){
                    $category2 = $temp_val."02";
                }else{
                    $category2 = $temp_val."03";
                }
            }else{
                return 0;
            }
        }else{
			//$temp_val = substr($others2[0]->other1,0,1);
            $other30 = $others2[0]->other30;
			$temp_val = str_replace("F2","",$other30);
            if($datachar01_d901_count > 0){
                if($checking_val < 10000){
                    $category2 = $temp_val."01";
                }elseif($checking_val >= 10000 && $checking_val < 30000){
                    $category2 = $temp_val."02";
                }else{
                    $category2 = $temp_val."03";
                }
            }else{
                return 0;
            }
		}
		
//        else{
//            $temp_val = substr($others2[0]->other1,0,1);
//            $other30 = $others2[0]->other30;
//            if($other30 == 'D901'){
//                if($checking_val < 10000){
//                    $category2 = "00".$temp_val."01";
//                }elseif($checking_val >= 10000 && $checking_val < 30000){
//                    $category2 = "00".$temp_val."02";
//                }else{
//                    $category2 = "00".$temp_val."03";
//                }
//            }else{
//                return 0;
//            }
//        }
        
        $categorykanri_data = QueryHelper::fetchSingleResult("
            select patternsub2
            from categorykanri
            where category1 = 'F1' AND category2 = '$category2'
            ");
        
        if($categorykanri_data){
            $patternsub2 = mb_convert_kana($categorykanri_data->patternsub2,"rnask");
            return $patternsub2;
        }else{
            return 0;
        }
    }
    
    public static function getCurrentTime(){
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        return str_replace(" ", "", $mytime);
    }

}
