<?php

namespace App\Http\Controllers\sales;
use Illuminate\Http\Request;
use App\tantousya;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\ButtonMsg;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\AllClass\specialCharValidation;
use Illuminate\Support\Facades\Validator;
use App\AllClass\common\CreateOrderDetails;
use App\AllClass\sales\salesCancellation\PdfData;
use PDF;
use ZipArchive;
use Carbon\Carbon;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;

class SalesCancellationController extends Controller
{
    public function index(Request $request)
    {
        $bango = request('userId');
        $input = $request->all();
        $orderbango = QueryHelper::fetchSingleResult("select 
            CASE
            WHEN orderbango::text is null THEN NULL
            ELSE concat_ws('/',substring(orderbango::text,1,4),
            substring(orderbango::text,5,2),
            substring(orderbango::text,7,2)) END as orderbango 
            from review 
            where kokyakusyouhinbango = 'D7503'")->orderbango ?? null;
        
        if($orderbango != null){
            $start_date = str_replace("/","",$orderbango);
            $lastday = date('t',strtotime($orderbango));
            $end_date = substr($start_date,0,6).$lastday;
        }else{
            $start_date = null;
            $end_date = null;
        }

        //check validation for first search
        if($request->ajax()){
            $rules=[];
            $rules['datachar10'] = ['required','max:10','regex:/^[0-9\/]+$/'];
            $rules['date0009'] = ['required','max:10','date','regex:/^[0-9\/]+$/'];
            $rules['information8'] = ['nullable',new specialCharValidation];
            $rules['information7'] = ['nullable',new specialCharValidation];

            $message=[];  
            $message['required']='【:attribute】必須項目に入力がありません。';
            $message['max']='【:attribute】:max桁以下で入力してください。';
            $message['min']='【:attribute】の入力は:min文字以上必要です。';
            $message['regex']='【:attribute】半角数字以外は使用できません。';
            $message['date']='【:attribute】日付の入力が適切ではありません。';
            $message['date_format']='【:attribute】yyyy/mm/ddの形式で入力してください。';

            $attributes = [
                'datachar10' => '売上番号',
                'date0009' => '取消日',
                'information8' => '伝票備考',
                'information7' => '社内備考',
            ];

            $date0009 = str_replace("/","",$input['date0009']);
            $info2_short = substr($input['information2_db'],0,8);
            $max_date0009 = QueryHelper::fetchSingleResult("
            select 
            to_char(max(date0009),'YYYYMMDD') as max_date0009
            from seikyuzandaka 
            where datatxt0142 = '$info2_short'
            ")->max_date0009 ?? "";
            
            $datachar10 = $input['datachar10'];
            $sum_of_nyukingaku = QueryHelper::fetchSingleResult("
            select 
            sum(nyukingaku) as sum_of_nyukingaku
            from daikinseisanold 
            where otodoketime = '$datachar10'
            ")->sum_of_nyukingaku ?? 0;
            
            $validator = Validator::make($input,$rules,$message,$attributes);  
            $errors = $validator->errors();
            if($errors->any()){
                $err_msg = $errors->all();
                return ['err_field' => $errors, 'err_msg' => $err_msg];
            }else if($date0009 != "" && $max_date0009 != ""){
                if((int) $date0009 <= (int) $max_date0009){
                    return "date0009_err";
                }else{
                    if(!$errors->any() && request('submit_confirmation') == ""){
                        return "confirmation_msg";
                    }
                }
            }else if($sum_of_nyukingaku <> 0){
                return "sum_of_nyukingaku_err";
            }else if(!$errors->any() && request('submit_confirmation') == ""){
                return "confirmation_msg";
            }
            
            //start log query
            $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 売上取消 start\n";
            QueryHandler::logger($bango,$log_data);

            $conn = pg_connect("host=".env("DB_HOST")." port=".env("DB_PORT")."  dbname=".env("DB_DATABASE")." user=".env("DB_USERNAME")." password=".env("DB_PASSWORD"));
            pg_query($conn,"BEGIN");
            try{
                //check orderbango
                $reviewData1 = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7051'");
                if ($reviewData1) {
                    $orderbango = $reviewData1->orderbango + 1;
                    $mobile_flag = $reviewData1->mobile_flag;
                } else {
                    $orderbango = "";
                    $mobile_flag = "";
                }
                $reviewData2 = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7501'");
                if ($reviewData2) {
                    $orderbango2 = $reviewData2->orderbango;
                } else {
                    $orderbango2 = "";
                }
                $modified_orderbango = "09" . $orderbango2 . str_pad($orderbango, $mobile_flag, '0', STR_PAD_LEFT);

                $prev_data = QueryHelper::fetchSingleResult("
                select 
                orderhenkan.kokyakuorderbango,
                orderhenkan.intorder01,
                tuhanorder.information1,
                tuhanorder.information2,
                tuhanorder.information3,
                tuhanorder.juchukubun1,
                tuhanorder.money10,
                tuhanorder.information6,
                tuhanorder.information7,
                tuhanorder.information8,
                tuhanorder.text1,
                tuhanorder.text2,
                tuhanorder.numeric2,
                tuhanorder.kessaihouhou,
                tuhanorder.housoukubun,
                tuhanorder.numeric3,
                tuhanorder.numeric4,
                tuhanorder.otodoketime,
                tuhanorder.unsoudaibikitesuryou,
                tuhanorder.unsoutesuryou,
                tuhanorder.youbou,
                tuhanorder.affbango,
                tuhanorder.numeric5
                from orderhenkan 
                join tuhanorder on tuhanorder.orderbango = orderhenkan.bango AND tuhanorder.juchubango = orderhenkan.kokyakuorderbango
                where datachar10 = '$datachar10'
                ");

                $orderhenkan_insert_data = [
                    'kokyakuorderbango' => $prev_data->kokyakuorderbango,
                    'ordertypebango2' => 0,
                    'synchroorderbango' => 0,
                    'datachar01' => 1,
                    'datachar10' => $modified_orderbango,
                    'intorder01' => $date0009,
                    'intorder03' => $date0009,
                    'intorder05' => $date0009,
                    'date' => Carbon::now()->format('Y-m-d H:i:s'),
                    'orderuserbango' => $bango,
                ];
                $orderhenkan = QueryHelper::insertData('orderhenkan',$orderhenkan_insert_data,'bango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                   
                $tuhanorder_insert_data = [
                    'orderbango' => $orderhenkan->bango,
                    'juchubango' => $orderhenkan->kokyakuorderbango,
                    'juchukubun2' => $modified_orderbango,
                    'text1' => 'U550',
                    'text2' => $prev_data->text2,
                    'information1' => $prev_data->information1,
                    'information2' => $prev_data->information2,
                    'information6' => $prev_data->information6,
                    'information3' => $prev_data->information3,
                    'numeric2' => $prev_data->numeric2,
                    'kessaihouhou' => $prev_data->kessaihouhou,
                    'housoukubun' => $prev_data->housoukubun,
                    'information7' => $input['information7'],
                    'information8' => $input['information8'],
                    'numeric3' => -$prev_data->numeric3,
                    'numeric4' => -$prev_data->numeric4,
                    'text3' => null,
                    'otodoketime' => $prev_data->otodoketime,
                    'chumondate' => null,
                    'unsoudaibikitesuryou' => $prev_data->unsoudaibikitesuryou,
                    'unsoutesuryou' => $prev_data->unsoutesuryou,
                    'text4' => null,
                    'text5' => 2,
                    'youbou' => $prev_data->youbou,
                    'affbango' => $prev_data->affbango,
                    'numeric5' => $prev_data->numeric5,
                ];
                $tuhanorder = QueryHelper::insertData('tuhanorder',$tuhanorder_insert_data,'orderbango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                
                //hikiatesyukko insert start here
                $hikiatesyukkoInfo = QueryHelper::fetchSingleResult("select * from hikiatesyukko where syouhinid = '$orderhenkan->kokyakuorderbango'");
                $hikiatesyukko_insert_data = [
                    'orderbango' => $orderhenkan->bango,
                    'kaiinid' => $modified_orderbango,
                    'syouhinid' => $orderhenkan->kokyakuorderbango,
                    'dataint01' => 1,
                    'dataint02' => 2,
                    'dataint03' => 2,
                    'dataint04' => 1,
                    'dataint05' => null,
                    'dataint06' => 1,
                    'dataint07' => 2,
                    'datachar11' => $hikiatesyukkoInfo->datachar11,
                    'datachar12' => null,
                    'datachar13' => $hikiatesyukkoInfo->datachar13,
                    'datachar14' => $hikiatesyukkoInfo->datachar14,
                    'datachar15' => $hikiatesyukkoInfo->datachar15,
                    'yoteimeter' => 0,
                    'tanabango' => static::getCurrentTime(),
                    'idoutanabango' => null,
                    'tantousyabango' => $bango,
                    'dataint08' => 2,
                    'dataint09' => 2,
                ];
                $hikiatesyukko_insert = QueryHelper::insertData('hikiatesyukko',$hikiatesyukko_insert_data,'orderbango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
 
                //hikiatesyukko update start here
                $hikiatesyukko_update_data = [
                    'orderbango' => $orderhenkan->bango,
                    'syouhinid' => $orderhenkan->kokyakuorderbango,
                    'kaiinid' => $datachar10,
                    'dataint01' => 1,
                    'idoutanabango' => static::getCurrentTime(),
                ];
                $hikiatesyukko = QueryHelper::updateData('hikiatesyukko', $hikiatesyukko_update_data, ['orderbango' => $orderhenkan->bango,'syouhinid'=>$orderhenkan->kokyakuorderbango,'kaiinid'=>$datachar10], true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                
                
                //hikiatesyukko update start here
                $hikiatesyukkoInfo = QueryHelper::fetchSingleResult("select * from hikiatesyukko where syouhinid = '$prev_data->kokyakuorderbango' AND kaiinid is null ");
                $hikiatesyukko_update_data_2 = [
                    'orderbango' => $hikiatesyukkoInfo->orderbango,
                    'syouhinid' => $prev_data->kokyakuorderbango,
                    'datachar01' => 1,
                    'datachar02' => null,
                    'datachar03' => null,
                    'datachar04' => 2,
                    'datachar05' => null,
                    'datachar06' => 2,
                    'datachar07' => null,
                    'idoutanabango' => static::getCurrentTime(),
                    'tantousyabango' => $bango,
                    'datachar09' => 2,
                    'datachar10' => 2,
                    'datachar16' => 2,
                    'datachar17' => null,
                    'datachar18' => null,
                ];
                $hikiatesyukko_2 = QueryHelper::updateData('hikiatesyukko', $hikiatesyukko_update_data_2, ['orderbango' => $hikiatesyukkoInfo->orderbango,'syouhinid'=>$prev_data->kokyakuorderbango], true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                
                //syukkoold insert start here
                $syukkooldInfo = QueryHelper::fetchResult("select * from syukkoold where syouhinid = '$prev_data->kokyakuorderbango' AND kaiinid = '$datachar10' ");
                foreach($syukkooldInfo as $key => $val){
                    $syukkoold_insert_data = [
                        'orderbango' => $orderhenkan->bango,
                        'kaiinid' => $modified_orderbango,
                        'syouhinsyu' => $val->syouhinsyu,
                        'hantei' => $val->hantei,
                        'dataint01' => 0,
                        'dataint02' => $val->dataint02,
                        'dataint13' => $val->dataint13,
                        'syouhinid' => $val->syouhinid,
                        'kawasename' => $val->kawasename,
                        'syouhinname' => $val->syouhinname,
                        'syukkasu' => -$val->syukkasu,
                        'codename' => $val->codename,
                        'dataint04' => $val->dataint04,
                        'datachar08' => $val->datachar08,
                        'dataint14' => $val->dataint14,
                        'dataint15' => $val->dataint15,
                        'datachar18' => $val->datachar18,
                        'datachar19' => -$val->datachar19,
                        'datachar20' => -$val->datachar20,
                        'datachar10' => $val->datachar10,
                        'yoteimeter' => 0,
                        'tanabango' => static::getCurrentTime(),
                        'tantousyabango' => $bango,
                    ];
                    $syukkoold = QueryHelper::insertData('syukkoold',$syukkoold_insert_data,'orderbango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);

                    //update juchusyukko data
                    $soukosyukkoData = QueryHelper::fetchSingleResult("select hanbaibukacd,syouhinbango,yoteisu from soukosyukko where syouhinid = '$val->syouhinid' AND syouhinsyu = '$val->syouhinsyu' AND hantei = '$val->hantei' ");
                    if($soukosyukkoData){
                        $juchusyukko_update_data = [
                            'hanbaibukacd'=>$soukosyukkoData->hanbaibukacd,
                            'dataint18'=>$soukosyukkoData->syouhinbango,
                            'dataint19'=>$soukosyukkoData->yoteisu,
                            'datachar25'=> 2,
                            'tankano'=> static::getCurrentTime(),
                            'syouhinbukacd'=> $bango,
                        ];
                        QueryHelper::updateData('juchusyukko', $juchusyukko_update_data, ['hanbaibukacd'=>$soukosyukkoData->hanbaibukacd,'dataint18'=>$soukosyukkoData->syouhinbango,'dataint19'=>$soukosyukkoData->yoteisu], $bango, __CLASS__, __FUNCTION__, __LINE__);
                    }
                }
                
                $deleted_item = 0;
                $kokyakuorderbango = $orderhenkan->kokyakuorderbango;
                $query = PdfData::data($bango, $deleted_item,$kokyakuorderbango,$modified_orderbango)->toSql();
                $voucherData = QueryHelper::fetchResult($query);
                $voucherData = collect($voucherData);

                //pdf create start here
                $pdf = PDF::loadView('sales.salesSlip.voucherCreation.pdf',['data'=>$voucherData]);
                if (!file_exists('pdf/salesSlip')) {
                    mkdir('pdf/salesSlip', 0777, true);
                }
                $pdf_name = $voucherData[0]->juchukubun2."_".$voucherData[0]->information2_short."_".$voucherData[0]->company_address."_".$voucherData[0]->office_haisoumoji1."_uri.pdf";
                $destination = public_path('pdf/salesSlip/'.$pdf_name);
                file_put_contents($destination, $pdf->output());
                //pdf create end here

                //update tuhanorder data
                $tuhanorder_update_data = [
                    'orderbango' => $tuhanorder->orderbango,
                    'text4' => $pdf_name,
                ];
                $tuhanorderUpdate = QueryHelper::updateData('tuhanorder', $tuhanorder_update_data, 'orderbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                
                //update review data
                $review_update_data = [
                    'kokyakusyouhinbango' => 'D7051',
                    'orderbango' => $orderbango,
                    'check_flag' => 0,
                    'color' => static::getCurrentTime(),
                    //'size' => Helper::getSystemIP(),
                    'nickname' => $bango,
                ];
                $reviewUpdate = QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                
                //create history details => CreateOrderDetails::data($bango,$kokyakuorderbango, $ordertypebango2,$datachar01)
                CreateOrderDetails::data($bango,$kokyakuorderbango, 1,3,'04-17','sales_data',$datachar10);
                
                //end log query
                $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 売上取消 end\n";
                QueryHandler::logger($bango,$log_data);

                pg_query($conn, "COMMIT");
                $msg = "売上番号(*1)".$datachar10."(*2)".$modified_orderbango."で取消しました。";
                Session::flash('success_msg', $msg);
                return "ok";
                    
            } catch (\Exception $e) {
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn,"ROLLBACK");
                return "ng";
            }
            
        }

        $data_from_view = $request->all();
        $data_from_view_session = $request->all();
        session()->put('oldInput' . $bango, $data_from_view);
        $tantousya = tantousya::find($bango);
        $buttonMessage = ButtonMsg::read($bango);

        session()->forget('oldInput' . $bango);
        return view('sales.salesCancellation.mainSalesCancellation', compact('bango', 'tantousya', 'buttonMessage', 'orderbango', 'start_date', 'end_date'));
    }

    public function loadSalesData(Request $request)
    {
        $datachar10 = request('datachar10');
        QueryHelper::runQuery("DROP TABLE IF EXISTS sales_cen_v_torihikisaki ");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE sales_cen_v_torihikisaki as
        select *
        from v_torihikisaki
        ");
        $data = QueryHelper::fetchSingleResult("
            select 
            tuhanorder.information1,
            information1Detail.r17_3 as information1_detail,
            tuhanorder.information2,
            information2Detail.r17_3 as information2_detail,
            tuhanorder.juchukubun1,
            tuhanorder.money10,
            tuhanorder.information7,
            tuhanorder.information8,
            tuhanorder.text1
            from orderhenkan 
            join tuhanorder on tuhanorder.orderbango = orderhenkan.bango AND tuhanorder.juchubango = orderhenkan.kokyakuorderbango
            left join sales_cen_v_torihikisaki as information1Detail on information1Detail.torihikisaki_cd = tuhanorder.information1
            left join sales_cen_v_torihikisaki as information2Detail on information2Detail.torihikisaki_cd = tuhanorder.information2
            where datachar10 = '$datachar10'
            ");
        if($data && $data->text1 == 'U523'){
            $result = [
                "status" => "U523_err",
                "data" => $data
            ];
            return $result;
        }elseif($data){
            $result = [
                "status" => "ok",
                "data" => $data
            ];
            return $result;
        }else{
           $result = [
                "status" => "no_data",
                "data" => ""
            ];
            return $result;
        }
        
    }
    
    public static function getCurrentTime()
    {
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        return str_replace(" ", "", $mytime);
    }

}
