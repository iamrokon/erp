<?php

namespace App\Http\Controllers\order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use PDF;
use ZipArchive;
use Mail;
use App\Mail\mailZip;
use App\Mail\mailPasswordsalesAccpt;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Session;


class SaleAcceptanceController extends Controller
{


    public function index(Request $request){

    	$bango = request('userId');
        $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7501'");
        $review_orderbango = $reviewData->orderbango;
    	$datatxt0003 = QueryHelper::fetchResult("select *,RIGHT(category2, 2) as category2_show from categorykanri where category1 = 'B9' and (suchi2 = 0 or suchi2 is null) and left(category2, 2) ='$review_orderbango' ORDER BY category2 ASC");
        
    	$tantousya = QueryHelper::select(['bango','name','datatxt0003','datatxt0004','datatxt0005','innerlevel'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        
    	$review = QueryHelper::fetchResult("select orderbango from review where kokyakusyouhinbango = 'D7501'");
        
        $review_date = QueryHelper::fetchResult("select orderbango from review where kokyakusyouhinbango = 'D7503'");
        $review_date =$review_date[0]->orderbango;

    	$review= $review[0]->orderbango;  
        //$self_datatxt0003=$tantousya->datatxt0003;  
    	//$tantousyas = QueryHelper::fetchResult("select bango,name from tantousya where  datatxt0003 ='$self_datatxt0003' and ztanka='$review_orderbango' and deleteflag = 0 and innerlevel > 9 order by bango asc");
    	$tantousyas = QueryHelper::fetchResult("select * from tantousya where deleteflag = 0 and ztanka='$review_orderbango' and innerlevel >= 10 and innerlevel <= 20 order by bango");
        
        $data003=substr($tantousya->datatxt0003, 2,4);      
        $data004=substr($tantousya->datatxt0004, 2,5);
        $data005=substr($tantousya->datatxt0005, 2,6);
    
        $personal_datatxt0003=QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'B9' ")->where("category2 = '$data003' ")->get()->first();
        

        $datatxt0004 = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C1' ")->where("category2 LIKE '%$data003%' ")->get()->execute();
        
        $datatxt0005 = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("category2 LIKE '%$data003%' ")->get()->execute();
        

        if (request('action') == 'update') {

        	$allData= $request->all();
        	unset($allData['_token']);
            unset($allData['action']);
            unset($allData['userId']);


            $modifiedArr=[];
            foreach ($allData as $key => $value) {
                foreach ($value as $k => $val) {
                    $modifiedArr[$k][$key]=$val;
                }
            }
            $returnerr=$this->validateOrders($modifiedArr,$bango);

            foreach ($returnerr as $key => $value) {
                if ($value->any()) {
                    return $returnerr;
                }
            }

        	$status=$this->changeOrder($modifiedArr,$bango);
            return $status;

        }
        
    	return view('order.salesAcceptance.main',compact("bango",'tantousya','datatxt0003','datatxt0004','datatxt0005','tantousyas','personal_datatxt0003','review_date'));
    }

    public function getAllOrders(Request $request){

        $bango=request('userId');
        $status=request('status');
        $tantousya = QueryHelper::select(['bango','name','datatxt0003','datatxt0004','datatxt0005','innerlevel'])->from('tantousya')->where("bango = '$bango' ")->get()->first();

    	if (request('_token')) {
    		$result= collect($this->searchOrder($request->all()))->paginate(20);

            if ($result->items() == null && $result->currentPage() != 1) 
            {
                $currentPage = ($result->lastPage());
                Paginator::currentPageResolver(function () use ($currentPage)
                {
                    return $currentPage;
                });
                $result = collect($this->searchOrder($request->all()))->paginate(20);

            } 
            $current_page=$result->currentPage();
            $per_page=$result->perPage();
            $serial=($current_page - 1)*$per_page+1;

            $length=$result->total()==0?0:1;
         
    		$html = view('order.salesAcceptance.orderDetail',compact("result","serial","tantousya"))->render();

        return response()->json(["status" => $status, "html" => $html, "length" => $length,'result'=>$result]);
    	}
    }

    private function changeOrder($modifiedArr,$bango){
  
    
        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### order_data_change start\n";
        QueryHandler::logger($bango, $log_data);
        $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));

        
        pg_query($conn, "BEGIN");
        try{
        
        foreach ($modifiedArr as $key => $value) {
            $date_check=$value['date_check'];
        	$order_id=$value['oderid'];
        	$file = isset($value['filename'])?$value['filename']:'';
    		$orderhenkan=[
                'bango' => $value['primary_bango'],
    		    'kokyakuorderbango'=> $value['oderid'],
    		    'intorder04'=>static::stringDataConvertedToIntegerFormat($value['intorder04'])??null,
    		    'intorder03'=>static::stringDataConvertedToIntegerFormat($value['intorder03'])??null,
    		    'intorder05'=>static::stringDataConvertedToIntegerFormat($value['intorder05'])??null,
                
    	    ];
            if (isset($value['filedelete'])&&$value['filedelete']=='1') {
                $orderhenkan['datachar09']=null;
         
            }

    	    $tuhanorder=[
    	    	'juchubango'=>$value['oderid'],
                'housoukubun'=>isset($value['housoukubun'])?'1':'2'
    	    ];

            $datachar07 = isset($value['datachar06'])?null:$bango;
    	    $hikiatesyukko=[
                'syouhinid'=>$value['oderid'],
                'datachar01'=>$value['datachar01'],
                'datachar06'=>isset($value['datachar06'])?'2':'1',
                'datachar07'=>$datachar07,
                'idoutanabango'=> static::getCurrentTime(),
                'tantousyabango'=>$bango
            ];
            if ($value['datachar01']=='2') {
                $hikiatesyukko['datachar02']=$bango;
            }else if($value['datachar01']=='3'){
                $hikiatesyukko['datachar03']=$bango;
            }else{
                $hikiatesyukko['datachar02'] = null;
                $hikiatesyukko['datachar03'] = null;
            }
        
            if(isset($file) && $file != ""){

                if($file != ""){
                    $filenameWithExtension=$file->getClientOriginalName();
                    $filenameWithoutExtension=explode('.', $filenameWithExtension);
                    $finalFileName=$filenameWithoutExtension[0].'¶'.$order_id."_".static::getCurrentTime().".".$filenameWithoutExtension[1];

                    $file->move(public_path('uploads/lbook'),$finalFileName);
                }
            }
            
            if ($file != "" && $file->getClientOriginalName() != "") {
                # code...

            $reviewbango = QueryHelper::select(['orderbango','mobile_flag'])->from('review')->where("kokyakusyouhinbango = 'D7301' ")->get()->first();
            $reviewbango2 = QueryHelper::select(['orderbango'])->from('review')->where("kokyakusyouhinbango = 'D7501' ")->get()->first();
            $datachar01 = "21".$reviewbango2->orderbango.str_pad(($reviewbango->orderbango+1),$reviewbango->mobile_flag,'0',STR_PAD_LEFT );

            $orderhenkan=[
                'bango' => $value['primary_bango'],
                'kokyakuorderbango'=> $value['oderid'],
                'intorder04'=>static::stringDataConvertedToIntegerFormat($value['intorder04'])??null,
                'intorder03'=>static::stringDataConvertedToIntegerFormat($value['intorder03'])??null,
                'intorder05'=>static::stringDataConvertedToIntegerFormat($value['intorder05'])??null,
                'datachar09'=>$datachar01
            ];

    	    $soukonyuko=[
                'orderbango' => $value['primary_bango'],
    	    	'datachar01' => $datachar01,
    	    	'datachar02' => $value['information1'],
    	    	'datachar03' => $value['information2'],
    	    	'datachar04' => $value['information3'],
                'datachar05' => $value['oderid'],
                'datachar06' => $bango,
                'datachar07' => 'H112',
                'datachar08' => $value['acceptedname']??null,
                'datachar09' => $finalFileName ?? null,
                'datachar10' => 'H920',
                'dataint25' => 0,
                'datachar11' => static::getCurrentTime(),
                'datachar13' => $bango,
            ];

            $review=[
                'kokyakusyouhinbango'=>'D7301',
                'orderbango'=> ((int) $reviewbango->orderbango)+1
            ];



            QueryHelper::updateData('review', $review, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
            QueryHelper::insertData('soukonyuko', $soukonyuko, 'datachar05', $bango, __CLASS__, __FUNCTION__, __LINE__);

        }
            
               ////orderhenkan update
            QueryHelper::updateData('orderhenkan', $orderhenkan, 'bango', $bango, __CLASS__, __FUNCTION__, __LINE__);
       
        	
            ////tuhanorder update
            QueryHelper::updateData('tuhanorder', $tuhanorder, 'juchubango', $bango, __CLASS__, __FUNCTION__, __LINE__);
            ////hikiatesyukko update
            $check=QueryHelper::updateData('hikiatesyukko', $hikiatesyukko, 'syouhinid', $bango, __CLASS__, __FUNCTION__, __LINE__,null,null,null,$date_check,'idoutanabango');

            if (gettype($check)!='Object' && $check=='check_ng') {
                pg_query($conn, "ROLLBACK");
                return 'check_ng';
            }
        ///////code for flat rate order flag change depeneds on several conditions///////
        $check=self::check_and_update($value['primary_bango'],$value['oderid'],$hikiatesyukko,$bango,$tuhanorder,$datachar07);
        
        ////////end of flag change/////////////////////////////////////////////////////// 

        }

            pg_query($conn, "COMMIT");
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### order_entry end\n";
            QueryHandler::logger($bango, $log_data);
            $status='ok';
        }catch(\Exception $e){
          pg_query($conn, "ROLLBACK");
          $status=$e;
        }


            return $status;

    }
    
    public static function check_and_update($bango,$orderId,$hikiatesyukko,$user_id,$tuhanorder_p,$datachar07){
      $orderhenkan=\DB::table('orderhenkan')->where('bango',$bango)->first();
      if ($orderhenkan->datachar02=='U122') {
       
         $misyukko=\DB::table('misyukko')
                       ->select('misyukko.kawasename','misyukko.orderbango','misyukko.datachar21','misyukko.syouhinid')
                       ->where('orderbango',$bango)
                       ->whereRaw('misyukko.datachar21 IS NOT NULL')
                       ->get();

      }
      else{
            $misyukko=\DB::table('misyukko')
                          ->select('syouhin1.data100','misyukko.kawasename','misyukko.orderbango','misyukko.datachar21','misyukko.syouhinid')
                          ->join('syouhin1','syouhin1.kokyakusyouhinbango','=','misyukko.kawasename')
                          ->where('orderbango',$bango)
                          ->where('syouhin1.data100','D131')
                          ->where('syouhinid',$orderId)
                          ->whereRaw('misyukko.datachar21 IS NOT NULL')
                          ->get();

        }

          foreach ($misyukko as $key => $value) {
            $tuhanorder= \DB::table('tuhanorder')
                             ->select('orderbango','juchubango')
                             ->where('tuhanorder.chumonbango',$value->datachar21)
                             ->get();
             foreach ($tuhanorder as $k => $val) {
                  
                  $tuhanorder_p['orderbango']=$val->orderbango;
                  $tuhanorder_p['juchubango']=$val->juchubango;
                  ////hikiatesyukko update
                  QueryHelper::updateData('tuhanorder', $tuhanorder_p, 'orderbango', $user_id, __CLASS__, __FUNCTION__, __LINE__);

                  $hikiatesyukko['idoutanabango']=static::getCurrentTime();
                  $hikiatesyukko['syouhinid']=$val->juchubango;
                  $hikiatesyukko['datachar07']=$datachar07;

                  ////hikiatesyukko update
                  QueryHelper::updateData('hikiatesyukko', $hikiatesyukko, 'syouhinid', $user_id, __CLASS__, __FUNCTION__, __LINE__);
             }            
             
          }
      return 'ok';
    }
    private function validateOrders($data,$bango){

        $errArr=[];

        foreach ($data as $key => $value) {
            $rules = [];
            $rules['intorder04'] = ['nullable'];
            $rules['intorder03'] = ['nullable'];
            $rules['intorder05'] = ['nullable'];

            $message = [];
            $message['nullable'] = '【:attribute】必須項目に入力がありません。';

            $attributes = [
            'intorder04' => '検収日',
            'intorder03' => '売上日',
            'intorder05' => '入金日'
             ];

            $errArr[$key]=Validator::make($value, $rules, $message, $attributes)->errors();
        }

        return $errArr;
    }

    public function makePdfZip(Request $request){

        $orderId=request('orderId');
        $intorder01=request('intorder01');
        $tantousya=request('tantousya');
        $bango=request('bango');
        $information3=substr(request('information3'), 0,6);
        $others2Code=substr(request('kokyaku'), 6,2);
        $kokyakuCode=substr(request('kokyaku'), 0,6);

        $kokyaku = QueryHelper::select(['*'])->from('kokyaku1')->where("yobi12 = '$kokyakuCode' ")->get()->first();

        $kokyaku_information3 = QueryHelper::select(['*'])->from('kokyaku1')->where("yobi12 = '$information3' ")->get()->first();
        $others2 = QueryHelper::fetchResult("select * from others2 where otherint1 = (select bango from haisou where haisou.shikibetsucode = '$kokyakuCode' and haisou.torihikisakibango = '$others2Code')");

        if (strpos($others2[0]->other1, '1')===false) {
            $password = $others2[0]->other12;
        }else{
            $password = $kokyaku->mail_toiawase;
        }
        $review=QueryHelper::select(['*'])->from('review')->where("kokyakusyouhinbango = 'D7501' ")->get()->first();
        $year= Carbon::now()->Format('Y');
        $yrFromView=substr($intorder01, 0,4);

        $diffYear=((int)($review->orderbango)) - ((int)$year-(int)$yrFromView);

        if (explode(' ', $others2[0]->other1)[0] == '2') {
        	$pointCal=$others2[0]->other18;
        	$taxCal=$others2[0]->other16;
        }else{
        	$pointCal=$kokyaku->mallsoukobango1;
        	$taxCal=$kokyaku->mail_toiawase_mb;
        }

        $taxCal1=substr($taxCal,0,2);
        $taxCal2=substr($taxCal,2,2);

        $category5 = QueryHelper::fetchResult("select category5 from categorykanri where category1 ='B1' AND category2='$taxCal2'");

        $taxCal=$category5[0]->category5??0;
        $tax=substr($taxCal,0,2);

        $pointCal1=substr($pointCal, 0,2);
        $pointCal2=substr($pointCal, 2,1);
        
        $category4_pointCal = QueryHelper::fetchResult("select category4 from categorykanri where category1 ='B2' AND category2='$pointCal2'");

        $orderhenkanSql= "select
        bango,
        kokyakuorderbango,
        datachar02,
        datachar04,
        datachar05,
        datachar06,
        concat_ws('/',substring(CAST(orderhenkan.intorder01 as text),1,4),substring(CAST(orderhenkan.intorder01 as text),5,2),substring(CAST(orderhenkan.intorder01 as text),7,2)) as intorder01,
        concat_ws('/',substring(CAST(orderhenkan.intorder02 as text),1,4),substring(CAST(orderhenkan.intorder02 as text),5,2),substring(CAST(orderhenkan.intorder02 as text),7,2)),
        concat_ws('/',substring(CAST(orderhenkan.intorder03 as text),1,4),substring(CAST(orderhenkan.intorder03 as text),5,2),substring(CAST(orderhenkan.intorder03 as text),7,2)),
        concat_ws('/',substring(CAST(orderhenkan.intorder04 as text),1,4),substring(CAST(orderhenkan.intorder04 as text),5,2),substring(CAST(orderhenkan.intorder04 as text),7,2)) as intorder04,
        concat_ws('/',substring(CAST(orderhenkan.intorder05 as text),1,4),substring(CAST(orderhenkan.intorder05 as text),5,2),substring(CAST(orderhenkan.intorder05 as text),7,2)) as intorder05

        from orderhenkan where orderhenkan.synchroorderbango = 0 and orderhenkan.kokyakuorderbango='$orderId'  and orderhenkan.ordertypebango2 = (SELECT MAX(orderhenkan.ordertypebango2) FROM orderhenkan where orderhenkan.synchroorderbango = 0 and orderhenkan.kokyakuorderbango='$orderId')";
        $orderhenkan = QueryHelper::fetchResult($orderhenkanSql);
    	$orderhenkan= $orderhenkan[0]??collect([]);

    	$tantousya = QueryHelper::select(['*'])->from('tantousya')
                              ->where("bango = '$orderhenkan->datachar05' ")
                              ->where("ztanka = '$diffYear' ")
                              ->get()
                              ->first();

        if (isset($tantousya->datatxt0004) && $tantousya->datatxt0004 != '') {
        	$cat1=substr($tantousya->datatxt0004, 0,2);
            $cat2=substr($tantousya->datatxt0004, 2,5);
            $categorykanri = QueryHelper::select(['*'])->from('categorykanri')
                              ->where("category1 = '$cat1' ")
                              ->where("category2 = '$cat2' ")
                              ->get()
                              ->first();

            $categorikanriname= $categorykanri->category4??null;
        }else{
            $categorikanriname= null;
        }


    	$misyukkoSql="select
    	kawasename,
    	syouhinname,
    	to_char(syukkasu,'FM99,999,999,999') as syukkasu,
    	to_char(dataint04,'FM99,999,999,999') as dataint04,
    	to_char((syukkasu * dataint04),'FM999,999,999') as cost,
    	(syukkasu * dataint04) as totalPrice
    	from misyukko
    	where syouhinid = '$orderId' and hantei=0 and yoteimeter = 0
        order by misyukko.dataint02 asc
    	";
    	$misyukko = QueryHelper::fetchResult($misyukkoSql);

        $collect_empty=[
          "kawasename"=>null,
          "syouhinname"=>null,
          "syukkasu"=>null,
          "dataint04"=>null,
          "cost"=>null,
          "totalprice"=>null,
          'flag'=>1
        ];

        if (sizeof($misyukko) < 18) {
            for ($i=sizeof($misyukko); $i <18 ; $i++) { 
        
                $misyukko[$i]=$collect_empty;
            }
        }
        $misyukko =json_decode(json_encode($misyukko), FALSE);

    	$totalCostWithoutTax=0;

    	foreach ($misyukko as  $value) {
    		$totalCostWithoutTax += $value->totalprice;
    	}


    	$taxCalculateOfCost= $totalCostWithoutTax*($tax/100);

    	$totalpriceWithTax=$taxCalculateOfCost+$totalCostWithoutTax;

        if ($category4_pointCal[0]->category4=='四捨五入') {
            $totalpriceWithTax=number_format(round($totalpriceWithTax));

        }elseif($category4_pointCal[0]->category4=='切り捨て'){
        	$totalpriceWithTax=number_format(floor($totalpriceWithTax));
        }elseif($category4_pointCal[0]->category4=='切り上げ') {
            $totalpriceWithTax=number_format(ceil($totalpriceWithTax));
        }
        $taxCalculateOfCost=number_format($taxCalculateOfCost);

    	//$html = view('order.salesAcceptance.pdf',compact("misyukko","orderhenkan","tantousya","taxCalculateOfCost","totalpriceWithTax","kokyaku"))->render();

        $data=[
        	'misyukko'=>$misyukko,
        	'orderhenkan'=>$orderhenkan,
        	'tantousya'=>$tantousya,
        	'totalCostWithoutTax'=>number_format($totalCostWithoutTax),
        	'taxCalculateOfCost'=>$taxCalculateOfCost,
        	'totalpriceWithTax'=>$totalpriceWithTax,
        	'kokyaku'=>$kokyaku,
            'information3'=>$kokyaku_information3,
        	'categorikanriname'=>$categorikanriname
        ];
        
        $pdf=PDF::loadView('order.salesAcceptance.pdf',$data);

        $filename=$orderId.'ken.pdf';
        //$finalPdf=$pdf->stream('pdfview.pdf');
        if (!file_exists('pdf')) {
           mkdir('pdf', 0777, true);
        }
        $pdfdirectory='pdf/'.$filename;
        file_put_contents($pdfdirectory, $pdf->output());
        //file_put_contents($pdfdirectory, $finalPdf);
        //return $pdf->stream('pdfview.pdf');

        //password check///
        if ($password == null OR $password == '') {
            return ['pdffile'=>$pdfdirectory,'zipfile'=>'passwordempty'];
        }

        /////zip///

        $zip = new ZipArchive;

        if (!file_exists('zip')) {
           mkdir('zip', 0777, true);
        }

        $zipFileName='zip/'.$orderId.'ken.zip';
        if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE)
        {
        	
            if (!$zip->setPassword($password)) {
               throw new RuntimeException('Set password failed');
            }
            // compress file
            $fileName = 'pdf/'.$filename;
            $baseName = basename($fileName);
            if (!$zip->addFile($fileName, $baseName)) {
                throw new RuntimeException(sprintf('Add file failed: %s', $fileName));
            }

            if (!$zip->setEncryptionName($baseName, ZipArchive::EM_AES_128)) {
                throw new RuntimeException(sprintf('Set encryption failed: %s', $baseName));
            }
     
            $zip->close();

            /*$fileName = 'pdf/'.$filename;
            $zip->addFile($fileName);
            $zip->close();*/
        } else {
            echo 'failed';
        }

        return ['pdffile'=>$pdfdirectory,'zipfile'=>$zipFileName];
    }

    public function sendMail(Request $request){

    	$number=request('number');
    	$datatxt0014= substr($number, 0,6);
    	$datatxt0015= substr($number, 6,2);
    	$datatxt0049= substr($number, 8,3);
        $selectedUser=request('selectedUser');
        $orderId=request('orderId');

        $kokyaku = QueryHelper::select(['*,substring(address,1,5) as address'])->from('kokyaku1')->where("yobi12 = '$datatxt0014' ")->get()->first();

        $haisou = QueryHelper::select(['*,substring(haisoumoji1,1,3) as haisoumoji1'])->from('haisou')->where("shikibetsucode = '$datatxt0014' ")->where("torihikisakibango = '$datatxt0015' ")->get()->first();

        $others2 = QueryHelper::fetchResult("select * from others2 where otherint1 = (select bango from haisou where haisou.shikibetsucode = '$datatxt0014' and haisou.torihikisakibango = '$datatxt0015')");
        if (strpos($others2[0]->other1, '1')===false) {
            $password = $others2[0]->other12;
        }else{
            $password = $kokyaku->mail_toiawase;
        }
        $etsuransya = QueryHelper::fetchResult("select mail1,mail2,substring(mail4,1,3) as mail4,tantousya from etsuransya where datatxt0014= '$datatxt0014' and datatxt0015= '$datatxt0015' and datatxt0049= '$datatxt0049'");
      

        $fullnamewithslash=$kokyaku->address.'/'.$haisou->haisoumoji1.'/'.$etsuransya[0]->mail4.' '.$etsuransya[0]->mail1;

        $orderhenkan = QueryHelper::fetchResult("select orderhenkan.datachar05,orderhenkan.bango from (select distinct
                      kokyakuorderbango, max(ordertypebango2) as maxval
                      from orderhenkan 
                      where datachar10 IS NULL group by
                      kokyakuorderbango) as orderhenkan_m
            JOIN orderhenkan AS orderhenkan
                  ON orderhenkan.kokyakuorderbango = orderhenkan_m.kokyakuorderbango
                 AND orderhenkan.ordertypebango2 = orderhenkan_m.maxval  
              

             where  orderhenkan.kokyakuorderbango='$orderId'        
                      ")[0];
        $id=$orderhenkan->datachar05;
        $tantousya=QueryHelper::select(['*'])->from('tantousya')->where("bango = '$id' ")->get()->first();

        $misyukkos=QueryHelper::fetchResult("select orderbango, datachar01,datachar02 from misyukko where syouhinid = '$orderId' and dataint02='1'");
       
        $tuhanorder=QueryHelper::fetchSingleResult("select * from tuhanorder where juchubango = '$orderId'");
        $misyukko=QueryHelper::fetchResult("select tantousya.name,tantousya.mail,tantousya.mail3 from misyukko 
            join tantousya
            on tantousya.bango=misyukko.datachar02
            where syouhinid = '$orderId' and datachar02 is not null order by dataint02");
        if (!empty($misyukko)) {
            $misyukko=$misyukko[0];
        }

        $ccArr= array();
        foreach ($misyukkos as $key => $value) {
            $temp=$value->datachar02;

            $ccmail=QueryHelper::select(['bango,mail'])->from('tantousya')->where("bango = '$temp' ")->get()->first();

            if (isset($ccmail->mail) && $ccmail->mail != null) {
               if ($ccmail->mail !=null && !filter_var($ccmail->mail, FILTER_VALIDATE_EMAIL)) {
                 return ['mailnai',$fullnamewithslash];
               } 
               array_push($ccArr, $ccmail->mail);
            }

        }

        array_push($ccArr, $tantousya->mail??null);
        if (isset($tantousya->mail)&&$tantousya->mail !=null && !filter_var($tantousya->mail, FILTER_VALIDATE_EMAIL)) {
            
            return ['mailnai',$fullnamewithslash];
        } 
        $fromMail=env('MAIL_FROM');
        $mailFlag=env('MAIL_SEND_CONTROL','NONE');
        $zipPack='zip/'.request('orderId').'ken.zip';
        $toMial=($etsuransya[0]->mail1)?$etsuransya[0]->mail1:null;
        if (!filter_var($toMial, FILTER_VALIDATE_EMAIL)) {
                 return ['mailnai',$fullnamewithslash];
        }
        $ccMail=$ccArr;

        if ($toMial == null OR empty($ccMail)) {
            return ['mailnai',$fullnamewithslash];
        }
       // dd($toMial,$ccMail,$fromMail);
        if ($kokyaku->mail_toiawase == null OR $kokyaku->mail_toiawase =="") {
           return ['ng',$fullnamewithslash];
        }else{
        if ($mailFlag == "NONE") {
        	return ['ng',$fullnamewithslash];
        }elseif($mailFlag == "COLGIS" and $toMial != null){

              if (strpos($toMial, 'colgis') !== false) {
                Mail::send(new mailZip($tuhanorder,$tantousya,$misyukko,$kokyaku,$haisou,$etsuransya,$toMial,$ccMail,$zipPack,$fromMail));
             
                /*if (count(Mail::failures()) > 0) {
                   return (Mail::failures());
                 };*/
                 sleep(1);
                Mail::send(new mailPasswordsalesAccpt($password,$kokyaku,$haisou,$etsuransya,$toMial,$ccMail,$zipPack,$fromMail));
                /*if (count(Mail::failures()) > 0) {
                   return (Mail::failures());
                 };*/
              }
              else{
              	return ['ng',$fullnamewithslash];
              }
        }elseif ($mailFlag == "ALL" and $toMial != null) {
        	 Mail::send(new mailZip($tuhanorder,$tantousya,$misyukko,$kokyaku,$haisou,$etsuransya,$toMial,$ccMail,$zipPack,$fromMail));
             if (count(Mail::failures()) > 0) {
                   return (Mail::failures());
                 };
              sleep(1);   
             Mail::send(new mailPasswordsalesAccpt($password,$kokyaku,$haisou,$etsuransya,$toMial,$ccMail,$zipPack,$fromMail));
             if (count(Mail::failures()) > 0) {
                   return (Mail::failures());
                 };
        }
    }

        return ['ok',$fullnamewithslash];
    }
    private function searchOrder($data){

    $bango=$data['userId'];
    $sortTanto="select bango from tantousya where";
    if ($data['datatxt0003'] != null) {
        $sortTanto .= " datatxt0003 = '".$data['datatxt0003']."'";
    }
    if ($data['datatxt0004'] != null) {
        $sortTanto .= "AND datatxt0004 = '".$data['datatxt0004']."'";
    }
    if ($data['datatxt0005'] != null) {
        $sortTanto .= "AND datatxt0005 = '".$data['datatxt0005']."'";
    }
    $sorteTanto=QueryHelper::fetchResult($sortTanto);
    
    $tantousya_str=null;
    foreach ($sorteTanto as $key => $value) {

        if (end($sorteTanto)->bango == $value->bango) {
           $tantousya_str.= "'".$value->bango."'";
        }else{
           $tantousya_str.= "'".$value->bango."'".',';
        }
        
    }
    //// sql queries /////////////
    $sql='';
    if ($data['datatxt0003'] != "") {
                $datatxt0003 = $data['datatxt0003'];
                $sql = self::getStartSql($sql);
                $sql.=" v_orderhenkan.datatxt0003 = '".$datatxt0003."' ) ";
            }
            if ($data['datatxt0004'] != "") {
                $datatxt0004 = $data['datatxt0004'];
                $sql = self::getStartSql($sql);
                $sql.=" v_orderhenkan.datatxt0004 = '".$datatxt0004."' ) ";
            }
            if ($data['datatxt0005'] != "") {
                $datatxt0005 = $data['datatxt0005'];
                $sql = self::getStartSql($sql);
                $sql.=" v_orderhenkan.datatxt0005 = '".$datatxt0005."' ) ";
            }
            foreach ($data as $key => $value) {
                if ($value !="" && $key=='employee') {
                    $sql = self::getStartSql($sql);
                    $sql.=" v_orderhenkan.datachar05 = '".$value."' )";
                }
                if ($value !="" && $key=='datachar02') {
                    $sql = self::getStartSql($sql);
                    $arr=explode('/', $value);
                    $numItems = count($arr);
                    $i = 0;
                    foreach ($arr as $key => $val) {
                        if(++$i === $numItems) {
                          $sql.=" v_orderhenkan.datachar02 = '".$val."' )";
                        }else{
                          $sql.=" v_orderhenkan.datachar02 = '".$val."' OR";
                        }
                    }

                }
                if ($value !="" && $key=='salesDateFrom') {
                    $sql = self::getStartSql($sql);
                    $from = str_replace('/', '', $value).'01';
                    $sql.=" v_orderhenkan.intorder03 >= '".$from."' )";
                }
                if ($value !="" && $key=='salesDateTo') {
                    $sql = self::getStartSql($sql);
                    $to = str_replace('/', '', $value).'31';
                    $sql.=" v_orderhenkan.intorder03 <= '".$to."' )";
                }
                if ($value !="" && $key=='status') {
                    $sql = self::getStartSql($sql);
                    $sql.=" hikiatesyukko.datachar01::text = '".$value."' )";
                }
                if ($value !="" && $key=='managementConfirm') {
                    $sql = self::getStartSql($sql);
                    $sql.=" hikiatesyukko.datachar06::text = '".$value."' )";
                }
            }
            $sql.=" ORDER BY tuhanorder.information1 ASC, v_orderhenkan.kokyakuorderbango ASC";

    QueryHelper::runQuery("DROP TABLE IF EXISTS v_orderhenkan_temp");
    QueryHelper::runQuery("DROP TABLE IF EXISTS before_salesacceptance_temp");
    QueryHelper::runQuery("DROP TABLE IF EXISTS after_salesacceptance_temp");
    
    QueryHelper::runQuery("CREATE TEMPORARY TABLE v_orderhenkan_temp as
        select distinct
            v_orderhenkan.*,
            tuhanorder.information1,
            tuhanorder.information2,
            tuhanorder.information3,
            tuhanorder.housoukubun,
            hikiatesyukko.datachar01 as h_datachar01,
            hikiatesyukko.datachar06 as h_datachar06,
            hikiatesyukko.idoutanabango,
            tuhanorder.money10,
            tuhanorder.moneymax

            from (select distinct
                      kokyakuorderbango, max(ordertypebango2) as maxval
                      from orderhenkan 
                      where datachar10 IS NULL group by
                      kokyakuorderbango) as orderhenkan_m

            JOIN v_orderhenkan AS v_orderhenkan
                ON v_orderhenkan.kokyakuorderbango = orderhenkan_m.kokyakuorderbango
                AND v_orderhenkan.ordertypebango2 = orderhenkan_m.maxval
            inner join hikiatesyukko
                on hikiatesyukko.syouhinid=v_orderhenkan.kokyakuorderbango
                and hikiatesyukko.orderbango =v_orderhenkan.bango
            join tuhanorder
                on tuhanorder.juchubango=v_orderhenkan.kokyakuorderbango
                and tuhanorder.orderbango =v_orderhenkan.bango
            
            where v_orderhenkan.synchroorderbango = '0' AND hikiatesyukko.datachar04 = '2'
            $sql
        ");
//dd(QueryHelper::fetchResult('select*from v_orderhenkan_temp'));
        QueryHelper::runQuery("CREATE TEMPORARY TABLE before_salesacceptance_temp as
            select distinct
            v_orderhenkan_temp.*,
            v_1.R17_4 as information1_detail,
            v_2.R17_4 as information2_detail,
            v_3.R17_4 as information3_detail

            from v_orderhenkan_temp
            
            join v_torihikisaki as v_1
                on v_1.Torihikisaki_cd=v_orderhenkan_temp.information1

            join v_torihikisaki as v_2
                on v_2.Torihikisaki_cd=v_orderhenkan_temp.information2

            join v_torihikisaki as v_3
                on v_3.Torihikisaki_cd=v_orderhenkan_temp.information3

            ");
   //dd(QueryHelper::fetchResult("select * from before_salesacceptance_temp"));
        $sql= "select distinct
                before_salesacceptance_temp.kokyakuorderbango,
                before_salesacceptance_temp.datachar02,
                before_salesacceptance_temp.bango as primary_bango,
                before_salesacceptance_temp.datachar05 as created_user,
                before_salesacceptance_temp.information1,
                before_salesacceptance_temp.information2,
                before_salesacceptance_temp.information3,
                before_salesacceptance_temp.information1_detail,
                before_salesacceptance_temp.information2_detail,
                before_salesacceptance_temp.information3_detail,
                v_orderinfo.R15 as juchukubun1,
                before_salesacceptance_temp.datachar09,
                before_salesacceptance_temp.housoukubun,
                kokyaku1_2.bango as k_bango,
                before_salesacceptance_temp.h_datachar01 as datachar01,
                soukonyuko.datachar01 as test1,
                soukonyuko.orderbango as test2,
                before_salesacceptance_temp.bango as test3, 
                CASE
                WHEN tantousya.datatxt0034 = '$bango' THEN 'ok'
                WHEN tantousya.datatxt0035 = '$bango' THEN 'ok'
                WHEN split_part(tantousya.datatxt0036,'¶',1) = '$bango' THEN 'ok'
                WHEN split_part(tantousya.datatxt0036,'¶',2) = '$bango' THEN 'ok'
                ELSE 'ng' END as check_editable,
                CASE
                WHEN length(split_part(soukonyuko.datachar09,'¶',1)) > 11 THEN LEFT(split_part(soukonyuko.datachar09,'¶',1),10)||'...'||split_part(soukonyuko.datachar09,'.',2)
                ELSE split_part(soukonyuko.datachar09,'¶',1)||'.'||split_part(soukonyuko.datachar09,'.',2) END as pdf,
                soukonyuko.datachar09 as pdf_full_name,
                before_salesacceptance_temp.h_datachar06 as datachar06,
                before_salesacceptance_temp.idoutanabango,
                before_salesacceptance_temp.money10 as checkmoneyrange,
                to_char(before_salesacceptance_temp.money10,'FM999,999,999') as money10,
                to_char(before_salesacceptance_temp.moneymax,'FM999,999,999') as moneymax,

                concat_ws('/',substring(CAST(before_salesacceptance_temp.intorder01 as text),1,4),substring(CAST(before_salesacceptance_temp.intorder01 as text),5,2),substring(CAST(before_salesacceptance_temp.intorder01 as text),7,2)) as intorder01,
                concat_ws('/',substring(CAST(before_salesacceptance_temp.intorder02 as text),1,4),substring(CAST(before_salesacceptance_temp.intorder02 as text),5,2),substring(CAST(before_salesacceptance_temp.intorder02 as text),7,2)) as intorder02,
                concat_ws('/',substring(CAST(before_salesacceptance_temp.intorder03 as text),1,4),substring(CAST(before_salesacceptance_temp.intorder03 as text),5,2),substring(CAST(before_salesacceptance_temp.intorder03 as text),7,2)) as intorder03,
                concat_ws('/',substring(CAST(before_salesacceptance_temp.intorder04 as text),1,4),substring(CAST(before_salesacceptance_temp.intorder04 as text),5,2),substring(CAST(before_salesacceptance_temp.intorder04 as text),7,2)) as intorder04,
                concat_ws('/',substring(CAST(before_salesacceptance_temp.intorder05 as text),1,4),substring(CAST(before_salesacceptance_temp.intorder05 as text),5,2),substring(CAST(before_salesacceptance_temp.intorder05 as text),7,2)) as intorder05

                from  before_salesacceptance_temp
                 
                join v_orderinfo
                on v_orderinfo.Juchubango=before_salesacceptance_temp.kokyakuorderbango
                and v_orderinfo.bango=before_salesacceptance_temp.bango

                left join soukonyuko
                on soukonyuko.datachar01=before_salesacceptance_temp.datachar09
                and soukonyuko.orderbango =before_salesacceptance_temp.bango

                join tantousya
                on tantousya.bango=before_salesacceptance_temp.datachar05
                
                left join kokyaku1 as kokyaku1_2
                on kokyaku1_2.yobi12=LEFT (before_salesacceptance_temp.information2, 6)


                ";
            
            
            $result=QueryHelper::fetchResult($sql);

            foreach ($result as $key => $value) {
               $k_bango=$value->k_bango;
               $haisoujouhou=QueryHelper::select(['datatxt0060'])->from('haisoujouhou')->where("syukei1= '$k_bango' ")->get()->first();

               if ($haisoujouhou->datatxt0060=='B820') {
                   $value->color_flag=1;
               
               }else if (($haisoujouhou->datatxt0060=='B810' || $haisoujouhou->datatxt0060==null) AND ($value->datachar02 =='U120' OR $value->datachar02 =='U122' OR $value->datachar02 =='U150' OR $value->datachar02 =='U160') ) {
                   $value->color_flag=2;
               
               }else if (($haisoujouhou->datatxt0060=='B810'  || $haisoujouhou->datatxt0060==null) AND ($value->datachar02 !='U120' OR $value->datachar02 !='U122' OR $value->datachar02 !='U150' OR $value->datachar02 !='U160') AND( $value->checkmoneyrange == 500000 OR  $value->checkmoneyrange > 500000)) {
                   $value->color_flag=1;
               }else{
                   $value->color_flag=2;
               }

            }

            return $result;

    }

    private static function getStartSql($sql): string
    {
        if (substr($sql, strrpos($sql, ' ') + 1) == "AND" or substr($sql, strrpos($sql, ' ') + 1) == "OR" or substr($sql, strrpos($sql, ' ') + 1) == "where") {
            $sql .= '(';
        } else {
            $sql .= ' AND (';
        }
        return $sql;
    }
    public static function stringDataConvertedToIntegerFormat($value, $type = null)
    {
        $indicator = $type ? "," : "/";
        if (mb_strpos($value, $indicator)) {
            return str_replace($indicator, "", $value);
        }

        return $value;
    }
    public static function getCurrentTime()
    {
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        return str_replace(" ", "", $mytime);
    }

    public static function filterCategory(Request $request)
    {

    	$filterOn=request('filterOn');
    	$searchOn= substr($filterOn,2);
    	$category1= substr($filterOn,0,2);

    	$filterKey=request('filterKey');

        $categorykanri2 = QueryHelper::select(['category1,category2,category4'])->from('categorykanri')->where(" category1 = 'C1'")
              ->where(" category2::text LIKE '$searchOn%'")
              ->where("suchi2 = 0")
              ->orderBy("bango asc")
              ->get()->execute();

        $categoryhtml2="<option value=''>-</option>\n";

        foreach ($categorykanri2 as $value)
        {
            $categoryhtml2 .="<option value='".$value->category1.$value->category2."'>".substr($value->category2,-1)." ".$value->category4."</option>\n";
        }

        $categorykanri3 = QueryHelper::select(['category1,category2,category4'])->from('categorykanri')->where(" category1 = 'C2'")
              ->where(" category2::text LIKE '$searchOn%'")
              ->where("suchi2 = 0")
              ->orderBy("bango asc")
              ->get()->execute();

        $categoryhtml3="<option value=''>-</option>\n";

        foreach ($categorykanri3 as $value)
        {
            $categoryhtml3 .="<option value='".$value->category1.$value->category2."'>".substr($value->category2,-1)." ".$value->category4."</option>\n";
        }

        if($category1 == 'B9'){
        	$field='datatxt0003';
        }if($category1 == 'C1'){
        	$field='datatxt0004';
        }if($category1 == 'C2'){
        	$field='datatxt0005';
        }


        $tantousyas = QueryHelper::select(['name, bango'])->from('tantousya')
              ->where($field. " = '$filterOn'")
              ->where("deleteflag = 0")
              ->orderBy("bango asc")
              ->get()->execute();

        $tantousyahtml="<option value=''>-</option>\n";
        foreach ($tantousyas as $value)
        {
            $tantousyahtml .="<option value='".$value->bango."'>".$value->bango." ".$value->name."</option>\n";
        }

        $var=[
             'categoryhtml2'=>$categoryhtml2,
              'categoryhtml3'=>$categoryhtml3,
              'tantousyahtml'=>$tantousyahtml
          ];

        return json_encode($var);
    }
    
    public static function filterCategoryForMultiRow(Request $request)
    {

        $filterOn=request('filterOn');
        $searchOn= substr($filterOn,2);
        $datachar03= substr($searchOn,0,4);
        $datachar04= substr($searchOn,0,5);
        
        $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7501'");
        $review_orderbango = $reviewData->orderbango;

        $categorykanri2 = QueryHelper::select(['category1,category2,category4'])->from('categorykanri')->where(" category1 = 'C1'")
              ->where(" category2::text LIKE '$searchOn%'")
              ->where("suchi2 = 0")
              ->where("left(category2, 2) = '$review_orderbango'")
              ->orderBy("bango asc")
              ->get()->execute();

        $categoryhtml2="<option class='null' value='' >- </option>\n";

        foreach ($categorykanri2 as $value)
        {
            $categoryhtml2 .="<option value='".$value->category1.$value->category2."'>".substr($value->category2,-1)." ".$value->category4."</option>\n";
        }


        $categoryhtml3="<option class='null' value='' > - </option>\n";
        
        if (strlen($searchOn) > 4) {
            $categorykanri3 = QueryHelper::select(['category1,category2,category4'])->from('categorykanri')->where(" category1 = 'C2'")
              ->where(" category2::text LIKE '$searchOn%'")
              ->where("suchi2 = 0")
              ->where("left(category2, 2) = '$review_orderbango'")
              ->orderBy("bango asc")
              ->get()->execute();
            foreach ($categorykanri3 as $value)
            {
                $categoryhtml3 .="<option value='".$value->category1.$value->category2."'>".substr($value->category2,-1)." ".$value->category4."</option>\n";
            }
        }
        

        $categorykanri1 = QueryHelper::select(['category1,category2,category4'])->from('categorykanri')->where(" category1 = 'B9'")
              ->where(" category2 >= '$datachar03'")
              ->where("suchi2 = 0")
              ->where("left(category2, 2) = '$review_orderbango'")
              ->orderBy("bango asc")
              ->get()->execute();

        $categoryhtml1_right="";
        foreach ($categorykanri1 as $value)
        {
            $categoryhtml1_right .="<option value='".$value->category1.$value->category2."'>".substr($value->category2,-2)." ".$value->category4."</option>\n";
        }
        
        $categorykanri2_other = QueryHelper::select(['category1,category2,category4'])->from('categorykanri')->where(" category1 = 'C1'")
              ->where(" category2 >= '$searchOn'")
              ->where(" category2::text LIKE '$datachar03%'")
              ->where("left(category2, 2) = '$review_orderbango'")
              ->where("suchi2 = 0")
              ->orderBy("bango asc")
              ->get()->execute();

        $categoryhtml2_other="<option class='null' value='' >-</option>\n";

        foreach ($categorykanri2_other as $value)
        {
            $categoryhtml2_other .="<option value='".$value->category1.$value->category2."'>".substr($value->category2,-1)." ".$value->category4."</option>\n";
        }
        
        $categoryhtml3_other="<option class='null' value='' >-</option>\n";
        if (strlen($datachar04) > 4) {
            $categorykanri3_other = QueryHelper::select(['category1,category2,category4'])->from('categorykanri')->where(" category1 = 'C2'")
              ->where(" category2 >= '$searchOn'")
              ->where(" category2::text LIKE '$datachar04%'")
              ->where("left(category2, 2) = '$review_orderbango'")
              ->where("suchi2 = 0")
              ->orderBy("bango asc")
              ->get()->execute();

            foreach ($categorykanri3_other as $value)
            {
                $categoryhtml3_other .="<option value='".$value->category1.$value->category2."'>".substr($value->category2,-1)." ".$value->category4."</option>\n";
            }
        }
        

        $var=[
             'categoryhtml2'=>$categoryhtml2,
             'categoryhtml3'=>$categoryhtml3,
             'categoryhtml1_right'=>$categoryhtml1_right,
             'categoryhtml2_other'=>$categoryhtml2_other,
             'categoryhtml3_other'=>$categoryhtml3_other
          ];

        return json_encode($var);
    }

    public static function filtertantousya(Request $request){
        $to=substr(request('to'),2);
        $from=substr(request('from'),2);
        $field=request('field');
   
        if ($field=='1' OR $field=='2') {
           $tantousyas = QueryHelper::select(['*'])
                          ->from('tantousya')
                          ->where(" substring(tantousya.datatxt0003,3,4) >= '$from'")
                          ->where(" substring(tantousya.datatxt0003,3,4) <= '$to'")
                          ->where("deleteflag = '0'")
                          ->orderBy("bango asc")
                          ->get()->execute();

        }

        if ($field=='3' OR $field=='4') {
           $tantousyas = QueryHelper::select(['*'])
                          ->from('tantousya')
                          ->where(" substring(tantousya.datatxt0004,3,5) >= '$from'")
                          ->where(" substring(tantousya.datatxt0004,3,5) <= '$to'")
                          ->where("deleteflag = '0'")
                          ->orderBy("bango asc")
                          ->get()->execute();

        }

        if ($field=='5' OR $field=='6') {
           $tantousyas = QueryHelper::select(['*'])
                          ->from('tantousya')
                          ->where(" substring(tantousya.datatxt0005,3,6) >= '$from'")
                          ->where(" substring(tantousya.datatxt0005,3,6) <= '$to'")
                          ->where("deleteflag = '0'")
                          ->orderBy("bango asc")
                          ->get()->execute();

        }
        
        $tantousya_html="<option class='null' value='' >-</option>\n";

        foreach ($tantousyas as $value)
        {
            $tantousya_html .="<option value='".$value->bango."'>".$value->bango." ".$value->name."</option>\n";
        }

        return json_encode($tantousya_html);
    }
}
