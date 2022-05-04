<?php


namespace App\Http\Controllers\sales;


use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\sales\DepositApplication\AllPaymentDetails;
use App\AllClass\sales\DepositApplication\AllSalesSubject;
use App\AllClass\sales\DepositApplication\DepositApplication;
use App\AllClass\sales\DepositApplication\validateDepositApplication;
use App\AllClass\sales\DepositApplication\DepositApplicationAmount;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\AllClass\db\QueryHandler;

class DepositApplicationController extends Controller
{

    protected $json_data=[

    "juchubango",
    "juchukubun2",
    "unsoutesuryou",
    "unsoudaibikitesuryou",
    "numeric3_val",
    "dataint01",
    "orderbango",
    "kingaku",
    "hanbaibukacd",
    "dataint18",
    "dataint19",
    "dataint20",
    "shinkurokokyakuname",
    "payment_number",
    "serial",
    "tantousya_name",
    "request_sokuji_name",
    "intorder03",
    "intorder03_val",
    "datachar10",
    "intorder05",
    "intorder05_val",
    "juchukubun1",
    "information1",
    "information1_detail_show",
    "max",
    "housoukubun",
    "unsoutesuryou_val",
    "unsoudaibikitesuryou_val",
    "applied_amount",
    "not_payment_amount",
    "difference_payment",
    "request_maeuke_name",
    "torikomidate",
    "request_urizumi_name"
  ];

    public function index()
    {
   
        exec('php artisan config:cache');
        exec('php artisan config:clear');
        exec('php artisan route:cache');
        exec('php artisan route:clear');
 

        // $date0009 = QueryHelper::fetchSingleResult("SELECT max(replace(substring(seikyuzandaka.date0009::text,1,10),'-','')) as date0009 FROM seikyuzandaka where datatxt0142 = '00501101' ")->date0009 ?? 0;
        // dd($date0009);
        $bango = request('userId');
        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        return view('sales.depositApplication.main', compact('bango', 'tantousya'));
    }

    public function getBillingWiseData(Request $request)
    {

        $chumonsyaname = $request->chumonsyaname ? substr($request->chumonsyaname, 0, 8) : null;
        list($payment_details, $totalApplicableAmount) = AllPaymentDetails::data($chumonsyaname);
        
        $cn = 0;
        $date0009 = (int) QueryHelper::fetchSingleResult("SELECT max(replace(substring(seikyuzandaka.date0009::text,1,10),'-','')) as date0009 FROM seikyuzandaka where datatxt0142 = '$chumonsyaname' ")->date0009 ?? 0;
        foreach($payment_details as $k=>$v){
            $payment_day = (int) str_replace("/","",$v->payment_day);
            if($payment_day < $date0009){
               $cn++; 
            }
        }
        
        $res['payment_details_view'] = view('sales.depositApplication.payment-details', compact('payment_details'))->render();
        $res['deposit_amount'] = DepositApplicationAmount::calculate($chumonsyaname);
        $res['payment_details'] = $payment_details;
        $res['applicable_amount'] = $totalApplicableAmount;
        $res['payment_day_err'] = $cn;
        return $res;

    }

    public function salesSubject(Request $request)
    {

        $processRequest = $request->all();
        foreach ($processRequest as $key => $value) {
            if ($key == '_token') {
                unset($processRequest[$key]);
            }
            if ($key == 'sales_date_end' || $key == 'sales_date_start') {
                $processRequest[$key] = Helper::replaceSpecificString($value, '/');
            }
            if (!$value) {
                $processRequest[$key] = null;
            }
        }


        $color_array = array();

        $color_array =
            [
                'housoukubun' => '0419即時区分' ,
                'unsoutesuryou' => '0419前受区分' ,
                'unsoudaibikitesuryou' => '0419売済区分' ,
            ];
    
            if ($request->billing_address == '0') {

              
              $komoku = $this->json_data;
              $depositApplicationInfo=[];
              foreach($komoku as $key=>$val){
                 if ($val=='juchubango' OR $val== 'juchukubun2') {
    
                    $depositApplicationInfo[0][$val]='0000000000';
                 }else{

                    $depositApplicationInfo[0][$val]=null;
                 }
                 
              }
              $depositApplicationInfo = json_decode(json_encode($depositApplicationInfo), FALSE);
              
              $res['sales_subject_view'] = view('sales.depositApplication.sales-subject', compact('depositApplicationInfo'))->render();
              return $res;
            }
            else if ($processRequest['billing_address']) {

              $depositApplicationInfo = AllSalesSubject::data($processRequest,$color_array);
    
              $res['sales_subject_view'] = view('sales.depositApplication.sales-subject', compact('depositApplicationInfo'))->render();
              return $res;
            }
            
            return "";
    }

    public function update(Request $request)
    {

        $bango = $request->userId;
        $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
       
        if($request->ajax()){
            $validator = validateDepositApplication::validate($request,$bango);
            $errors = $validator->errors();
            if($errors->any()){
               $err_msg = $errors->all();
               return ['err_field'=>$errors,'err_msg'=>$err_msg];
            }
        }
        // QueryHelper::fetchResult("delete from daikinseisanold");
        // return "s";
        $count = $request->count;
        $fiscal_year = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7501'");
        

        $applicable_amount=$request['applicable_amount'];

        if ($request['complete_status']=='1') {
           self::updateForMinus($request->all(),$fiscal_year,$bango,$conn);
           return 'ok';
        }else{
        ///// loop start payment calculation///// 

        try{
          pg_query($conn, "BEGIN");  
          $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7062'");
          //$shinkurokokyakuorderbango = "05".$fiscal_year->orderbango.sprintf("%06d",$reviewData->orderbango);
          $moneymax=1;
 
        foreach ($request['depositAmount'] as $key => $value) {
          $pay_amount= str_replace(',', '', $value);
        
          $i=0;

          if ($pay_amount>0 OR $pay_amount<0) {
            
            for($j=0;$j<count($applicable_amount);$j++){
                if ((int) $applicable_amount[$j] <> 0) {
                    $i=$j;
                    break;
                }
            }
            $cut_from= (int) $applicable_amount[$i];
          
   
            //while ($cut_from>0) {
              //review data
             while ($cut_from<>0) { 
        
              if($cut_from=='0'){
                break;
              }
              else{
                
                $cut_from_check=$cut_from;
                $pay_amount_check=$pay_amount;

              if ($cut_from>=$pay_amount && $cut_from>0) {
                $depositAmount =(int)$pay_amount;  
                $applicable_amount[$i]=(int)$cut_from-(int)$pay_amount;
                $difference=(int)$cut_from-(int)$pay_amount;
                $cut_from=(int)$cut_from-(int)$pay_amount;

                $pay_amount=0;
                
              }
              else if($cut_from<$pay_amount && $cut_from>0){
                
                $difference=(int)$pay_amount-(int)$cut_from;
                $pay_amount=(int)$pay_amount-(int)$cut_from;
                $depositAmount =(int)$cut_from;
                $applicable_amount[$i]=0;
                $cut_from=0;
               
              }else{
                $depositAmount =(int)$pay_amount;
                $applicable_amount[$i]=(int)$cut_from-(int)$pay_amount;  
                //$applicable_amount[$i]=(int)$cut_from-(int)$pay_amount;
                $difference=(int)$cut_from-(int)$pay_amount;
                $cut_from=(int)$cut_from-(int)$pay_amount;

                $pay_amount=0;
              }
 
              $shinkurokokyakuname=$request['shinkurokokyakuname'][$i];
              $shinkurokokyakugroup=$request['shinkurokokyakugroup'][$i];
              $otodoketime=$request['juchukubun2'][$key];
             // $moneymax=$request['shinkurokokyakugroup'][$i];

              //$depositAmount = str_replace(',', '', $value);
              $deposit_row = QueryHelper::fetchResult("select * from daikinseisanold where shinkurokokyakuname = '$shinkurokokyakuname' and shinkurokokyakugroup = '$shinkurokokyakugroup' and otodoketime = '$otodoketime'");
              } 
 
              if(!empty($deposit_row)){
                $where_array=['shinkurokokyakuname'=>$shinkurokokyakuname,
                               'shinkurokokyakugroup'=>$shinkurokokyakugroup,
                               'otodoketime'=>$otodoketime];
                $depositAmountTotal = $deposit_row[0]->nyukingaku + $depositAmount;
                $update_array =
                    [
                      'nyukingaku' => $depositAmountTotal,
                    ];
 
                QueryHelper::updateData('daikinseisanold',$update_array,$where_array,$bango, __CLASS__, __FUNCTION__, __LINE__);

                $shinkurokokyakuorderbango=$deposit_row[0]->shinkurokokyakuorderbango;

              }else{
                $shinkurokokyakuorderbango = "05".$fiscal_year->orderbango.sprintf("%06d",$reviewData->orderbango+1);
                $daikinseisanold = [
                      'shinkurokokyakuname' => $shinkurokokyakuname,
                      'shinkurokokyakuorderbango' => $shinkurokokyakuorderbango,
                      'moneymax' => $moneymax,
                      'shinkurokokyakugroup' => $shinkurokokyakugroup,
                      'otodoketime' => $otodoketime,
                      'soufusakiname' => '2',
                      'soufusakiyubinbango' => '2',
                      'unsoumei' => null,
                      'nyukingaku' => $depositAmount,
                      //'nyukingaku' => $applied_amount,
                      'toiawasebango' => null,
                      'seisanunsoumei' => null,
                      'seisankokyakucode' => null,
                      'seisankokyakucode2' => null,
                      'seisanbi' => null,
                      'hassoubi' => null,
                      'nyukinbi' => now()->format('Y-m-d H:i:s'),
                      'shiharaikubun' => $bango,
                      'henpinbi' => null,
                      'unsoudaibikitesuryou'=>'0'
                  ];
                  $moneymax++;
                  QueryHelper::insertData('daikinseisanold', $daikinseisanold, 'shinkurokokyakuname', true, $bango, __CLASS__, __FUNCTION__, __LINE__);

                  //// update review table
                  $text3 = $reviewData->orderbango+1;
                  $review_update_data = [
                      'kokyakusyouhinbango' => 'D7062',
                      'orderbango' => $text3,
                      'check_flag' => 0,
                      'color' => static::getCurrentTime(),
                      'nickname' => $bango,
                  ];
                  $reviewUpdate = QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
              }

              $unsoutesuryou = $request['unsoutesuryou'][$key];
              $unsoudaibikitesuryou = $request['unsoudaibikitesuryou'][$key];
              $intorder03 = $request['intorder03'][$key];
              $torikomidate = $request['torikomidate_val'][$i];
              $dataint01 = $request['dataint01'][$key];

              $where_array = ['datachar10'=>$otodoketime];
              if ($request['juchukubun2'][0]!='0000000000') {
                $check_parent_child=array_values($this->check_parent_child($otodoketime)); 

              }

              if($pay_amount==0 AND $request['juchukubun2'][0]!='0000000000' AND $check_parent_child[0]!='parent_order'){
              
                if($unsoutesuryou == '2' && $unsoudaibikitesuryou == '2'){
                  $update_array_orderhenkan =
                      [
                          'intorder05' => $intorder03,
                      ];
                  QueryHelper::updateData('orderhenkan',$update_array_orderhenkan,$where_array,$bango, __CLASS__, __FUNCTION__, __LINE__);
                }else {
                  $update_array_orderhenkan =
                      [
                          'intorder05' => $torikomidate,
                      ];
                  QueryHelper::updateData('orderhenkan',$update_array_orderhenkan,$where_array,$bango, __CLASS__, __FUNCTION__, __LINE__);
                }
              }else if ($pay_amount==0 AND $request['juchukubun2'][0]!='0000000000' AND $check_parent_child[0]=='parent_order') {
                  $update_array_orderhenkan =
                      [
                          'intorder05' => $torikomidate,
                      ];
                  QueryHelper::updateData('orderhenkan',$update_array_orderhenkan,$where_array,$bango, __CLASS__, __FUNCTION__, __LINE__);
              }
              
              
              $orderbango = $request['orderbango'][$key];
              $numeric3_val = $request['numeric3_val'][$key];

              $where_array = ['orderbango'=>$orderbango];
              $update_array =
                  [
                      'dataint01' => 1,
                      'idoutanabango' => static::getCurrentTime(),
                      'tantousyabango' => $bango,
                  ];

              if ($request['juchukubun2'][0]!='0000000000') {
                $check_parent_child=array_values($this->check_parent_child($otodoketime));   
              }

   
              if ($pay_amount==0 AND $request['juchukubun2'][0]!='0000000000' AND (int)$request['not_payment'][$key] == (int)str_replace(',', '', $request['depositAmount'][$key]) ) {

                if ($check_parent_child[0]=='parent_order' AND $check_parent_child[1]==true AND $check_parent_child[2]!=null) {
    
                  QueryHelper::updateData('hikiatesyukko',$update_array,$where_array,$bango, __CLASS__, __FUNCTION__, __LINE__);
                }elseif($check_parent_child[0]=='child_order'){
   
                    QueryHelper::updateData('hikiatesyukko',$update_array,$where_array,$bango, __CLASS__, __FUNCTION__, __LINE__);
                    //var_dump($check_parent_child);
                  if ($check_parent_child[1]==true AND $check_parent_child[2]!=null) {
                    
                    $where_array = ['orderbango'=>$check_parent_child[2]];
                    QueryHelper::updateData('hikiatesyukko',$update_array,$where_array,$bango, __CLASS__, __FUNCTION__, __LINE__);
                  }
  
                  $where_array = ['datachar10'=>$check_parent_child[3]];
                  $update_array_orderhenkan =
                      [
                          'intorder05' => $torikomidate,
                      ];
                  QueryHelper::updateData('orderhenkan',$update_array_orderhenkan,$where_array,$bango, __CLASS__, __FUNCTION__, __LINE__);
                }elseif($check_parent_child[0]=='normal_order'){
                    QueryHelper::updateData('hikiatesyukko',$update_array,$where_array,$bango, __CLASS__, __FUNCTION__, __LINE__);
                }
               
              }else{
                   /*$where_array = ['orderbango'=>$orderbango];
                   $update_array =
                       [
                           'idoutanabango' => static::getCurrentTime(),
                           'tantousyabango' => $bango,
                       ];*/

                //  QueryHelper::updateData('hikiatesyukko',$update_array,$where_array,$bango, __CLASS__, __FUNCTION__, __LINE__);    
              }
              
              $update_array =
                  [
                      'rendoumail' => 1,
                      'apitime01' => Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString(),
                      'apiid01' => $bango,
                  ];
              if ($applicable_amount[$i]==0) {
                QueryHelper::updateData('eczaikorendou', $update_array, ['sitename' => $shinkurokokyakuname, 'yukouflag' => $shinkurokokyakugroup], $bango, __CLASS__, __FUNCTION__, __LINE__);
              }else{
                $update_array =
                  [
                      'apitime01' => Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString(),
                      'apiid01' => $bango,
                  ];
                QueryHelper::updateData('eczaikorendou', $update_array, ['sitename' => $shinkurokokyakuname, 'yukouflag' => $shinkurokokyakugroup], $bango, __CLASS__, __FUNCTION__, __LINE__);
              }
              
              
              $kingaku = $request['kingaku'][$key];
              $hanbaibukacd = $request['hanbaibukacd'][$key];
              $dataint18 = $request['dataint18'][$key];
              $dataint19 = $request['dataint19'][$key];
              $dataint20 = $request['dataint20'][$key];
              //if($kingaku AND $request['juchukubun2'][0]!='0000000000'){
              if($pay_amount==0 AND $request['juchukubun2'][0]!='0000000000'){
                $where_array = ['hanbaibukacd'=>$hanbaibukacd,'dataint18'=>$dataint18,'dataint19'=>$dataint19,'dataint20'=>$dataint20];
                $update_array =
                    [
                        'datachar26' => 1,
                        'tankano' => static::getCurrentTime(),
                        'syouhinbukacd' => $bango,
                    ];

                QueryHelper::updateData('juchusyukko',$update_array,$where_array,$bango, __CLASS__, __FUNCTION__, __LINE__);
              }
              //success message///
             
              $msg='入金消込番号'.$shinkurokokyakuorderbango.'で登録しました。';
              session()->forget('success_msg_keshikomu');
              session()->put('success_msg_keshikomu', $msg);

              
  
              if ((int)$cut_from_check>= (int)$pay_amount_check OR (int)$cut_from_check<0) {
            
                /*if ($key < array_key_last($request['depositAmount'])) {
                   $key++;
                 } */
                break;
              }
                $i++; //// next payable amount 
                
                if (isset($applicable_amount[$i]) && (int) $applicable_amount[$i]<>0) {
                  $cut_from= (int) $applicable_amount[$i];
                }else{
                  $cut_from= 0;
                }
              
            }
          }

        }

        $result['status'] = 'ok';
        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### deposite-Application end\n";
        QueryHandler::logger($bango, $log_data);
        //dd('vai thamen');
         pg_query($conn,"COMMIT");


      }catch(\Exception $e){
        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
      
        QueryHandler::logger($bango, $log_data);
        pg_query($conn, "ROLLBACK"); 
       
      }

      }
      ///// payment calculation end////
      
      
      return 'ok';
    }
    protected static function check_parent_child($sales_id)
    {
      $orderhenkan= \DB::table('orderhenkan')
                        ->where('datachar10',$sales_id)
                        ->first();

      $tuhanorder=\DB::table('tuhanorder')   
                      ->where('juchubango',$orderhenkan->kokyakuorderbango)    
                      ->where('juchukubun2',$sales_id) 
                      ->first();    

      $order_type=null;
      $last_child=false;
      $parent_paied=null;

      if ($tuhanorder->datatxt0130!=null && $tuhanorder->juchukubun2!=$tuhanorder->datatxt0130) {
          $order_type='child_order';
          $parent_or_normal=\DB::table('tuhanorder')   
                      ->where('datatxt0130',$tuhanorder->datatxt0130) 
                      ->whereNotNull('chumonbango')   
                      ->get()->toArray();

          $sql_arr=[];
          $str='(';
          foreach ($parent_or_normal as $key => $value) {
            
            // array_push($sql_arr, $value->juchukubun2);
             if ($key == (array_key_last($parent_or_normal))) {
                $str=$str."'". $value->juchukubun2."'".')';
             }else{
                $str=$str."'". $value->juchukubun2."'".',';
             }
             
          }
            
              $not_paid_childs=QueryHelper::fetchResult("select * from hikiatesyukko where dataint01 = 1 AND kaiinid IN $str ");
           
            // dd(self::temp_query($tuhanorder->datatxt0130),$check_parent_paid);

                if(count($parent_or_normal) - count($not_paid_childs) == 1){
                    $last_child=true;
                } 

                $not_paid_parent=\DB::table('hikiatesyukko')
                                     ->where('kaiinid',$tuhanorder->datatxt0130)
                                     ->first();
                $total_kingaku= self::temp_query($tuhanorder->datatxt0130); 
                $paid_kingaku= QueryHelper::fetchResult("select
                                              sum(nyukingaku) as amount
                                           from daikinseisanold
                                           where otodoketime='$tuhanorder->datatxt0130'
                                           group by otodoketime");   

                 
                if(!empty($paid_kingaku)){
                  $parent_paid_kingaku=$paid_kingaku[0]->amount;
                }else{
                  $parent_paid_kingaku=null;
                }

                if ($total_kingaku == $parent_paid_kingaku) {
                  
                    $parent_paied=$not_paid_parent->orderbango;
                }             

      }else{
          $parent_or_normal=\DB::table('tuhanorder')   
                      ->where('datatxt0130',$orderhenkan->datachar10)    
                      ->get()->toArray();
          if(count($parent_or_normal)>1){
               $order_type='parent_order';
               $sql_arr=[];
               $str='(';
               foreach ($parent_or_normal as $key => $value) {
                 
                  //array_push($sql_arr, $value->juchukubun2);
                if ($key == (array_key_last($parent_or_normal))) {
                   $str=$str."'". $value->juchukubun2."'".')';
                }else{
                   $str=$str."'". $value->juchukubun2."'".',';
                }
                  
               }
   
               $not_paid_childs= QueryHelper::fetchResult("select * from hikiatesyukko where dataint01 = 1 AND  kaiinid IN $str ");

               $var=$tuhanorder->datatxt0130;
               $not_paid_parent=QueryHelper::fetchSingleResult("select * from hikiatesyukko  where kaiinid = '$var'");
                                                                            
                if(count($parent_or_normal) - count($not_paid_childs) == 1){
                    $last_child=true;
                } 
                
                $total_kingaku= self::temp_query($orderhenkan->datachar10); 
                $paid_kingaku= QueryHelper::fetchResult("select
                                              sum(nyukingaku) as amount
                                           from daikinseisanold
                                           where otodoketime='$orderhenkan->datachar10'
                                           group by otodoketime");   

                 
                if(!empty($paid_kingaku)){
                  $parent_paid_kingaku=$paid_kingaku[0]->amount;
                }else{
                  $parent_paid_kingaku=null;
                }

                if ($total_kingaku == $parent_paid_kingaku) {
                    $parent_paied=$not_paid_parent->orderbango;
                }                                 
          }else{
               $order_type='normal_order';
          }
      }

      return  array('order_type' => $order_type,'last_child' => $last_child,'parent_paied' => $parent_paied,'parent_uriage'=>$tuhanorder->datatxt0130);
    }
    
    protected static function temp_query($uriage_bango){

      QueryHelper::runQuery("DROP TABLE IF EXISTS applied_amount_temp ");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE applied_amount_temp as
            SELECT DISTINCT 
            URIAGE_TOTAL.juchubango, 
            (URIAGE_TOTAL.amount - coalesce(MAINTENANCE.amount,0)) as amount, 
            URIAGE_TOTAL.juchukubun2, 
            MAINTENANCE.kaiinid
          from
                ( select
                   juchukubun2, 
                   (numeric3 +  coalesce(numeric4,0))  as amount,
                   juchubango as juchubango
                from tuhanorder
                group by juchukubun2,(numeric3 + coalesce(numeric4,0)),juchubango
                ) URIAGE_TOTAL
          left join
          ( select 
            kaiinid,
            sum(syukkasu * dataint04) + sum(datachar20::integer) as amount

              from syukkoold
              where datachar13 = '3' 
              group by kaiinid
             ) MAINTENANCE on  URIAGE_TOTAL.juchukubun2 = MAINTENANCE.kaiinid");

            $data=QueryHelper::fetchSingleResult("select * from applied_amount_temp where applied_amount_temp.juchukubun2 ='$uriage_bango'")->amount;
            
            return $data;

    }
    public static function updateForMinus($request,$fiscal_year,$bango,$conn)
    {

       $applicable_amount=$request['applicable_amount'];
       try{
          pg_query($conn, "BEGIN");  
          $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7062'");
          $shinkurokokyakuorderbango = "05".$fiscal_year->orderbango.sprintf("%06d",$reviewData->orderbango+1);
          $moneymax=1;

        foreach ($request['depositAmount'] as $key => $value) {
          $pay_amount= str_replace(',', '', $value);

          $i=0;
          if ($pay_amount<0) {
            
            for($j=0;$j<count($applicable_amount);$j++){
                if ((int) $applicable_amount[$j] < 0) {
                    $i=$j;
                    break;
                }
            }
            $cut_from= (int) $applicable_amount[$i];
       

            while ($cut_from<0) {
              //review data
             
            
              if($cut_from=='0'){
                break;
              }
              else{
                
                $cut_from_check=$cut_from;
                $pay_amount_check=$pay_amount;


    
                $applicable_amount[$i]=(int)$cut_from-(int)$pay_amount;
               
                $cut_from=(int)$cut_from-(int)$pay_amount;

                
                $pay_amount=0;
                
     
   
              $shinkurokokyakuname=$request['shinkurokokyakuname'][$i];
              $shinkurokokyakugroup=$request['shinkurokokyakugroup'][$i];
              $otodoketime=$request['juchukubun2'][$key];
             

              //$depositAmount = str_replace(',', '', $value);
              $deposit_row = QueryHelper::fetchResult("select * from daikinseisanold where shinkurokokyakuname = '$shinkurokokyakuname' and shinkurokokyakugroup = '$shinkurokokyakugroup' and otodoketime = '$otodoketime'");
              } 
 
                $daikinseisanold = [
                      'shinkurokokyakuname' => $shinkurokokyakuname,
                      'shinkurokokyakuorderbango' => $shinkurokokyakuorderbango,
                      'moneymax' => $moneymax,
                      'shinkurokokyakugroup' => $shinkurokokyakugroup,
                      'otodoketime' => $otodoketime,
                      'soufusakiname' => '2',
                      'soufusakiyubinbango' => '2',
                      'unsoumei' => null,
                      'nyukingaku' => $pay_amount_check,
                      //'nyukingaku' => $applied_amount,
                      'toiawasebango' => null,
                      'seisanunsoumei' => null,
                      'seisankokyakucode' => null,
                      'seisankokyakucode2' => null,
                      'seisanbi' => null,
                      'hassoubi' => null,
                      'nyukinbi' => now()->format('Y-m-d H:i:s'),
                      'shiharaikubun' => $bango,
                      'henpinbi' => null,
                      'unsoudaibikitesuryou'=>'0'
                  ];
 
                  $moneymax++;
                  QueryHelper::insertData('daikinseisanold', $daikinseisanold, 'shinkurokokyakuname', true, $bango, __CLASS__, __FUNCTION__, __LINE__);
        

              $unsoutesuryou = $request['unsoutesuryou'][$key];
              $unsoudaibikitesuryou = $request['unsoudaibikitesuryou'][$key];
              $intorder03 = $request['intorder03'][$key];
              $torikomidate = $request['torikomidate_val'][$i];
              $dataint01 = $request['dataint01'][$key];

              $where_array = ['datachar10'=>$otodoketime];
            

                  $update_array_orderhenkan =
                      [
                          'intorder05' => null,
                      ];
                  QueryHelper::updateData('orderhenkan',$update_array_orderhenkan,$where_array,$bango, __CLASS__, __FUNCTION__, __LINE__);
               

              //// update review table
              $text3 = $reviewData->orderbango+1;
              $review_update_data = [
                  'kokyakusyouhinbango' => 'D7062',
                  'orderbango' => $text3,
                  'check_flag' => 0,
                  'color' => static::getCurrentTime(),
                  'nickname' => $bango,
              ];
              $reviewUpdate = QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
              
              $orderbango = $request['orderbango'][$key];
              $numeric3_val = $request['numeric3_val'][$key];
              $where_array = ['orderbango'=>$orderbango];
              
              $update_array =
                  [
                      'dataint01' => 2,
                      'idoutanabango' => static::getCurrentTime(),
                      'tantousyabango' => $bango,
                  ];

              QueryHelper::updateData('hikiatesyukko',$update_array,$where_array,$bango, __CLASS__, __FUNCTION__, __LINE__);
         
           
              $update_array =
                  [
                      'rendoumail' => 1,
                      'apitime01' => Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString(),
                      'apiid01' => $bango,
                  ];
                      
              if ($applicable_amount[$i]==0) {
                QueryHelper::updateData('eczaikorendou', $update_array, ['sitename' => $shinkurokokyakuname, 'yukouflag' => $shinkurokokyakugroup], $bango, __CLASS__, __FUNCTION__, __LINE__);
              }else{

                 $update_array =
                  [
                      'apitime01' => Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString(),
                      'apiid01' => $bango,
                  ];

                  QueryHelper::updateData('eczaikorendou', $update_array, ['sitename' => $shinkurokokyakuname, 'yukouflag' => $shinkurokokyakugroup], $bango, __CLASS__, __FUNCTION__, __LINE__);
              }
              
              
              $kingaku = $request['kingaku'][$key];
              $hanbaibukacd = $request['hanbaibukacd'][$key];
              $dataint18 = $request['dataint18'][$key];
              $dataint19 = $request['dataint19'][$key];
              $dataint20 = $request['dataint20'][$key];
              //if($kingaku AND $request['juchukubun2'][0]!='0000000000'){
              $update_array =
                    [
                        'datachar26' => 2,
                        'tankano' => static::getCurrentTime(),
                        'syouhinbukacd' => $bango,
                    ];
              if($pay_amount==0){
                $where_array = ['hanbaibukacd'=>$hanbaibukacd,'dataint18'=>$dataint18,'dataint19'=>$dataint19,'dataint20'=>$dataint20];
             
                QueryHelper::updateData('juchusyukko',$update_array,$where_array,$bango, __CLASS__, __FUNCTION__, __LINE__);
              }else{
                 $update_array =
                    [
                        'tankano' => static::getCurrentTime(),
                        'syouhinbukacd' => $bango,
                    ];

                  $where_array = ['hanbaibukacd'=>$hanbaibukacd,'dataint18'=>$dataint18,'dataint19'=>$dataint19,'dataint20'=>$dataint20];
             
                  QueryHelper::updateData('juchusyukko',$update_array,$where_array,$bango, __CLASS__, __FUNCTION__, __LINE__);  
              }

              //success message///
              
              

              if ((int)$cut_from_check>= (int)$pay_amount_check) {
            
                /*if ($key < array_key_last($request['depositAmount'])) {
                   $key++;
                 } */
                break;
              }
                $i++; //// next payable amount 
                
                if (isset($applicable_amount[$i])) {
                  $cut_from= (int) $applicable_amount[$i];
                }else{
                  $cut_from= 0;
                }
             
              
            }
          }

        }
        
        $msg='入金消込番号'.$shinkurokokyakuorderbango.'で登録しました。';
        session()->put('success_msg', $msg);

        $result['status'] = 'ok';
        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### deposite-Application end\n";
        QueryHandler::logger($bango, $log_data);
        //dd('vai thamen');
        pg_query($conn,"COMMIT");


      }catch(\Exception $e){
        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";

        QueryHandler::logger($bango, $log_data);

        pg_query($conn, "ROLLBACK"); 
 
      }

      return 'ok';
    }
    public static function getCurrentTime(){
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        return str_replace(" ", "", $mytime);
    }
    
    

}
