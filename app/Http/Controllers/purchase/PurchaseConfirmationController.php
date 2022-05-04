<?php

namespace App\Http\Controllers\purchase;
use Illuminate\Http\Request;
use App\tantousya;
use App\kengen;
use App\requestTable;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\purchase\purchaseConfirmation\ValidatePurchaseInput;
use App\AllClass\purchase\purchaseConfirmation\ValidateBacklogInput;
use App\AllClass\purchase\purchaseConfirmation\AllPurchaseData;
use App\AllClass\purchase\purchaseConfirmation\AllBacklogData;
use Illuminate\Support\Facades\Validator;
use App\AllClass\ButtonMsg;
use Illuminate\Pagination\Paginator;
use App\AllClass\master\excelDownload;
use App\AllClass\TableSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Excel;
use Illuminate\Validation\Rule;
use App\AllClass\master\ExcelReportDownload;
use Carbon\Carbon;
use App\AllClass\master\CSVLogger;
use App\AllClass\newExcelExport;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use App\AllClass\common\CreateHatchuDetails;

class PurchaseConfirmationController extends Controller
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


    public function postPurchaseConfirmation(Request $request)
    {
        $bango = request('userId');
        $tantousya = tantousya::find($bango);
        $touchakutime = QueryHelper::fetchResult("select * from tantousya where innerlevel >= 10 order by bango");
        $classification = QueryHelper::fetchResult("select syouhinbango,jouhou from request where color = '0620チェック区分' ");
        return view('purchase.purchaseConfirmation.mainPurchaseConfirmation', compact('bango', 'tantousya', 'touchakutime', 'classification'));
    }
    
    
    public function purchaseData(Request $request)
    {
        
        try {
            $bango = $request->bango;
            $input = $request->all();
            $validator = ValidatePurchaseInput::validate($request,$bango);
            $errors = $validator->errors();
            if($errors->any()){
               $err_msg = $errors->all();
               return ['err_field'=>$errors,'err_msg'=>$err_msg];
            }
            
            $barcode = QueryHelper::fetchResult("select category1,category2,category4 from categorykanri where category1 = 'J1' order by category2");
            $codename = QueryHelper::fetchResult("select category1,category2,category4 from categorykanri where category1 = 'J2' order by category2");
            $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
            $query = AllPurchaseData::data($bango, $request->all())->toSql();
            $purchaseData = QueryHelper::fetchResult($query);
            $data_count = count($purchaseData);
            
            //count number of unsoumei
            $current_index = '';
            $number_of_unsoumei = 0;
            if($data_count > 0){
                $unsoumei = $purchaseData[0]->unsoumei;
                $start_date = $input['touchakudate_start'];
                $end_date = $input['touchakudate_end'];
                $sql = " (date(touchakudate) between '$start_date' and '$end_date') AND toiawasebango.datachar03 = '0' ";
                if(isset($input['touchakutime']) && $input['touchakutime'] != ""){
                    $touchakutime = $input['touchakutime'];
                    $sql .= " AND touchakutime = '$touchakutime'";            
                } 
                if(isset($input['rd1']) && $input['rd1']=="rd1_1"){
                    $sql .= " AND datachar06 is null and syouhinsyu = 2"; 
                }else{
                    $sql .= "AND syouhinsyu = 2"; 
                }
                QueryHelper::runQuery("DROP TABLE IF EXISTS temp_purchase_data");
                QueryHelper::runQuery("CREATE TEMPORARY TABLE temp_purchase_data as
                select distinct 
                toiawasebango.unsoumei
                from toiawasebango
                join hikiatenyuko on hikiatenyuko.syouhinid = toiawasebango.unsoumei
                where $sql
                ");
                $data = QueryHelper::fetchResult("select * from temp_purchase_data");
                $current_index = array_search($unsoumei, array_column($data, 'unsoumei')) + 1;
                $number_of_unsoumei = collect($data)->count();
            }
          
            $header_html = view('purchase.purchaseConfirmation.purchaseConfirmationHeaderPart', compact('purchaseData', 'bango', 'tantousya'))->render();
            $body_html = view('purchase.purchaseConfirmation.purchaseConfirmationBodyPart', compact('purchaseData', 'bango', 'tantousya','barcode','codename'))->render();
            return response()->json(["status" => "ok", "purchaseData" => $purchaseData, "header_html" => $header_html, "data_count"=>$data_count, "current_index"=>$current_index, "number_of_unsoumei"=>$number_of_unsoumei, "body_html" => $body_html]);
        } catch (Exception $e) {
            dd($e);
        }
    }
    
    public function backlogData(Request $request)
    {
        try {
            $bango = $request->bango;
            
            $validator = ValidateBacklogInput::validate($request,$bango);
            $errors = $validator->errors();
            if($errors->any()){
               $err_msg = $errors->all();
               return ['err_field'=>$errors,'err_msg'=>$err_msg];
            }
            
            $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
            $query = AllBacklogData::data($bango, $request->all())->toSql();
            $backlogData = QueryHelper::fetchResult($query);
            $backlogdata_count = count($backlogData);
            //dd($backlogData);
            $backlog_html = view('purchase.purchaseConfirmation.purchaseConfirmationBottomContent', compact('backlogData', 'bango', 'tantousya'))->render();
            return response()->json(["status" => "ok", "backlogdata_count"=>$backlogdata_count, "backlog_html" => $backlog_html]);
        } catch (Exception $e) {
            dd($e);
        }
    }
    

    public function registerPurchaseConfirmation(Request $request,$bango){
        $input = $request->all();
        //$bango = $input['userId'];
        $barcode = $input['barcode'];
        $codename = $input['codename'];
        $order_ln_number = $input['order_ln_number'];
        $order_number = $input['order_number'];
        $idoutanabango = $input['idoutanabango'];
        $yoteimeter = $input['yoteimeter'];
        
        
        //error check
        $tmp_barcode = array_diff($barcode, array(null));
        foreach($tmp_barcode as $key=>$val){
            $cat2[] = "'".substr($val,2)."'";
        }
        if(isset($cat2)){
            $cat2 = implode(",",$cat2);
            $categorykanri = QueryHelper::fetchResult("select category1,category2,category4,patternsub2 from categorykanri where category1 = 'J1' AND category2 IN($cat2)");
            $data = collect($categorykanri)->where('patternsub2','!=',null);
            $data2 = collect($data)->groupBy('patternsub2');
            if(count($data2) > 1){
                return "pattern_mismatch";
            }
        }
        
      
        $rules=[];
        //$rules['barcode.*'] = ['required'];
        //$rules['codename.*'] = ['required'];
        $rules['order_ln_number.*'] = ['nullable','min:13','max:13','regex:/^[0-9\/]+$/'];
        
        foreach ($idoutanabango as $idoutan_key => $idoutan_value) {
            if($order_ln_number[$idoutan_key] != ""){
                $yoteimeter_temp_val = $yoteimeter[$idoutan_key];
                $temp_idoutan_key = $idoutan_key + 1;
                $rules['idoutanabango'.'.'.$idoutan_key] = ['nullable',  function($attribute, $value, $fail) use ($idoutan_value,$yoteimeter_temp_val,$temp_idoutan_key) {
                    $Complaint = DB::table('minyuko')->join('juchusyukko2', function($join){
                            $join->on('juchusyukko2.syouhinid', '=', 'minyuko.syouhinid')
                                 ->on('juchusyukko2.syouhinsyu', '=', 'minyuko.syouhinsyu');
                        })
                        ->where('minyuko.syouhinid', $idoutan_value)
                        ->where('minyuko.syouhinsyu', $yoteimeter_temp_val)
                        ->where('juchusyukko2.day', 2)
                        ->count();
                    $msg = "【".$temp_idoutan_key.".発注行番号】"."発注データが存在しません。";
                    if($Complaint <= 0)
                        $fail($msg);
                }];
            }
        }
        
        foreach ($order_number as $ord_key => $ord_value5) {
            if($order_ln_number[$ord_key] != ""){
                $temp_data = QueryHelper::fetchSingleResult("SELECT MAX(ordertypebango2) as max_ordertypebango2
                    FROM orderhenkan where kokyakuorderbango ='$ord_value5'");
                if($temp_data){
                    $max_ordertypebango2 = $temp_data->max_ordertypebango2;
                }else{
                    $max_ordertypebango2 = 0;
                }

                $temp_ord_key = $ord_key + 1;
                $rules['order_number'.'.'.$ord_key] = [Rule::exists('orderhenkan','kokyakuorderbango')->where(function ($query) use($ord_value5,$max_ordertypebango2) {
                    return $query->where('datachar02',"!=", 'U150')
                    ->whereNull('datachar06')
                    ->whereNotNull('kokyakuorderbango')
                    ->where('kokyakuorderbango', $ord_value5)
                    ->where('ordertypebango2',$max_ordertypebango2);
                })];
            }
        }
       
        $message=[];  
        //foreach ($barcode as $key => $value) {
        //    $temp_key = $key + 1;
        //    $message['barcode'.'.'.$key.'.'.'required'] = "【".$temp_key.".会計科目】"."取込ファイルを確認してください。";
        //}
        
        //foreach ($codename as $key2 => $value2) {
        //    $temp_key2 = $key2 + 1;
        //    $message['codename'.'.'.$key2.'.'.'required'] = "【".$temp_key2.".会計科目内訳】"."取込ファイルを確認してください。";
        //}
        
        foreach ($order_ln_number as $min_key3 => $min_value3) {
            $temp_min_key3 = $min_key3 + 1;
            $message['order_ln_number'.'.'.$min_key3.'.'.'min'] = "【".$temp_min_key3.".発注行番号】".":min文字以内で指定してください。";
        }
        
        foreach ($order_ln_number as $key3 => $value3) {
            $temp_key3 = $key3 + 1;
            $message['order_ln_number'.'.'.$key3.'.'.'max'] = "【".$temp_key3.".発注行番号】".":max文字以内で指定してください。";
        }
        
         foreach ($order_ln_number as $key4 => $value4) {
            $temp_key4 = $key4 + 1;
            $message['order_ln_number'.'.'.$key4.'.'.'regex'] = "【".$temp_key4.".発注行番号】"."半角数値以外は使用できません。";
        }
        
        foreach ($order_number as $key5 => $value5) {
            if($order_ln_number[$key5] == ""){
                //return "order_number_err";
            }else{
                $temp_key5 = $key5 + 1;
                $message['order_number'.'.'.$key5.'.'.'exists'] = "【".$temp_key5.".発注行番号】"."受注キャンセルのデータです。";
            }
        }
       
        $validator = Validator::make($input,$rules,$message);  
        $errors = $validator->errors();
        if($errors->any()){
            $err_msg = $errors->all();
            return ['err_field' => $errors, 'err_msg' => $err_msg];
        }else if(!$errors->any() && request('submit_confirmation') == ""){
            $index = $input['td-rd1'][0];
            $tmp_order_number = $input['order_number'][$index];
            $temp_hikiatesyukko_data = QueryHelper::fetchSingleResult("SELECT * FROM hikiatesyukko where syouhinid ='$tmp_order_number' AND substring(datachar16,1,1) = '1'");
            if($temp_hikiatesyukko_data){
               return "confirmation_msg"; 
            }
        }
        
       //dd($input);

        //start log query
        $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 仕入購入確認 start\n";
        QueryHandler::logger($bango,$log_data);

        $conn = pg_connect("host=".env("DB_HOST")." port=".env("DB_PORT")."  dbname=".env("DB_DATABASE")." user=".env("DB_USERNAME")." password=".env("DB_PASSWORD"));
        pg_query($conn,"BEGIN");
        try{
            $unsoumei = $input['unsoumei'];
            $toiawasebango_previous_data = QueryHelper::fetchSingleResult("
            select 
            toiawasebango.*
            from (select MAX(datanum0013) as max_datanum0013,unsoumei from toiawasebango where unsoumei = '$unsoumei' group by unsoumei) as temp_toiawasebango
            join toiawasebango on toiawasebango.unsoumei = temp_toiawasebango.unsoumei
            AND toiawasebango.datanum0013 = temp_toiawasebango.max_datanum0013
            ");

            $toiawasebango_insert_data = [
                'orderbango' => $toiawasebango_previous_data->orderbango,
                'syukkosakibango' => $toiawasebango_previous_data->syukkosakibango,
                'unsoumei' => $unsoumei,
                //'toiawasebango' => $toiawasebango_previous_data->toiawasebango,
                'toiawasebango' => $input['toiawasebango'],
                'konpousu' => 2,
                'touchakudate' => $toiawasebango_previous_data->touchakudate,
                'touchakutime' => $toiawasebango_previous_data->touchakutime,
                'bikou1' => $toiawasebango_previous_data->bikou1,
                'bikou2' => $toiawasebango_previous_data->bikou2,
                'denpyoname' => $toiawasebango_previous_data->denpyoname,
                'dataint01' => $toiawasebango_previous_data->dataint01,
                'dataint02' => $toiawasebango_previous_data->dataint02,
                'dataint03' => $toiawasebango_previous_data->dataint03,
                'datachar01' => $toiawasebango_previous_data->datachar01,
                'datachar02' => $toiawasebango_previous_data->datachar02,
                'datachar03' => $toiawasebango_previous_data->datachar03,
                'datanum0001' => $toiawasebango_previous_data->datanum0001,
                'datanum0002' => $toiawasebango_previous_data->datanum0002,
                'datatxt0001' => $bango,
                'datatxt0002' => $toiawasebango_previous_data->datatxt0002,
                'datanum0008' => $toiawasebango_previous_data->datanum0008,
                'datanum0009' => $toiawasebango_previous_data->datanum0009,
                'datanum0010' => $toiawasebango_previous_data->datanum0010,
                'datanum0011' => $toiawasebango_previous_data->datanum0011,
                'datanum0012' => Carbon::now()->setTimezone("Asia/Tokyo")->format('YmdHis'),
                'datanum0013' => $toiawasebango_previous_data->datanum0013+1,
                'datanum0014' => $toiawasebango_previous_data->datanum0014,
                'datanum0015' => $toiawasebango_previous_data->datanum0015,
                'datanum0016' => $toiawasebango_previous_data->datanum0016,
                'datanum0017' => $toiawasebango_previous_data->datanum0017,
                'datatxt0019' => $toiawasebango_previous_data->datatxt0019,
                'datatxt0020' => $toiawasebango_previous_data->datatxt0020,
                'datatxt0021' => $toiawasebango_previous_data->datatxt0021,
                'datatxt0022' => $toiawasebango_previous_data->datatxt0022,
                'datatxt0023' => $toiawasebango_previous_data->datatxt0023,
                'datatxt0024' => $toiawasebango_previous_data->datatxt0024,
                'datatxt0025' => $toiawasebango_previous_data->datatxt0025,
                'datatxt0026' => $toiawasebango_previous_data->datatxt0026,
                'datatxt0027' => $toiawasebango_previous_data->datatxt0027,
                'datatxt0028' => $toiawasebango_previous_data->datatxt0028,
            ];
            $toiawasebango = QueryHelper::insertData('toiawasebango',$toiawasebango_insert_data,'unsoumei',true,$bango,__CLASS__,__FUNCTION__,__LINE__);

            $datachar06 = $input['datachar06_hidden'];
            
            if($input['datachar06'] != null){
                //update hikiatenyuko data
                $hikiatenyuko_update_data = [
                        'syouhinid' => $unsoumei,
                        'datachar06' => $datachar06,
                        'denpyoshimebi' => Carbon::now()->setTimezone("Asia/Tokyo")->format('Y-m-d H:i:s'),
                        'tantousyabango' => $bango,
                ];
                QueryHelper::updateData('hikiatenyuko', $hikiatenyuko_update_data, ['syouhinid' => $unsoumei], $bango, __CLASS__, __FUNCTION__, __LINE__);
            }
            
            $codename = $input['codename'];
            $idoutanabango = $input['idoutanabango'];
            $yoteimeter = $input['yoteimeter'];
            $nyukoold_zaikometer_data = QueryHelper::fetchSingleResult("
            select 
            nyukoold.*
            from nyukoold
            where syouhinid = '$unsoumei' 
            order by zaikometer desc
            ");
            foreach($barcode as $key=>$val){    
                $previous_syouhinsyu = $barcode[$key];
                $previous_nyukoold_data = QueryHelper::fetchSingleResult("
                select 
                nyukoold.*
                from nyukoold
                where syouhinid = '$unsoumei' 
                --and syouhinsyu = '$previous_syouhinsyu'
                 order by zaikometer desc
                ");


                $nyukoold_insert_data = [
                    'orderbango' => $previous_nyukoold_data->orderbango,
                    'syouhinbango' => $previous_nyukoold_data->syouhinbango,
                    'yoteisu' => $previous_nyukoold_data->yoteisu,
                    'yoteibi' => $previous_nyukoold_data->yoteibi,
                    'nyukosu' => $previous_nyukoold_data->nyukosu,
                    'kanryoubi' => $previous_nyukoold_data->kanryoubi,
                    'kingaku' => $previous_nyukoold_data->kingaku,
                    'genka' => $previous_nyukoold_data->genka,
                    'syouhizeiritu' => $previous_nyukoold_data->syouhizeiritu,
                    'soukobango' => $previous_nyukoold_data->soukobango,
                    'ukeiremotobango' => $previous_nyukoold_data->ukeiremotobango,
                    'ukeiresakibango' => $previous_nyukoold_data->ukeiresakibango,
                    'nyukosoukobango' => $previous_nyukoold_data->nyukosoukobango,
                    'tanabango' => $previous_nyukoold_data->tanabango,
                    'tantousyabango' => $bango,
                    'shiharaibango' => $previous_nyukoold_data->shiharaibango,
                    'denpyobango' => $previous_nyukoold_data->denpyobango,
                    'denpyohakkoubi' => Carbon::now()->setTimezone("Asia/Tokyo")->format('Y-m-d H:i:s'),
                    'season' => $previous_nyukoold_data->season,
                    'nengetsu' => $previous_nyukoold_data->nengetsu,
                    'weeks' => $previous_nyukoold_data->weeks,
                    'day' => $previous_nyukoold_data->day,
                    'tanka' => $previous_nyukoold_data->tanka,
                    'zaiko' => $previous_nyukoold_data->zaiko,
                    'idoutanabango' => $idoutanabango[$key],
                    'yoteimeter' => $yoteimeter[$key],
                    'nyukometer' => $previous_nyukoold_data->nyukometer,
                    'zaikometer' => $nyukoold_zaikometer_data->zaikometer+1,
                    'barcode' => $val,
                    'codename' => $codename[$key],
                    'denpyoshimebi' => $previous_nyukoold_data->denpyoshimebi,
                    'kawaserate' => $previous_nyukoold_data->kawaserate,
                    'kawasename' => $previous_nyukoold_data->kawasename,
                    'syouhizeikubun' => $previous_nyukoold_data->syouhizeikubun,
                    'syouhinname' => $previous_nyukoold_data->syouhinname,
                    'yoyakubi' => $previous_nyukoold_data->yoyakubi,
                    'kaiinid' => $previous_nyukoold_data->kaiinid,
                    'syouhinid' => $previous_nyukoold_data->syouhinid,
                    'syouhinsyu' => $previous_nyukoold_data->syouhinsyu,
                    'hantei' => $previous_nyukoold_data->hantei,
                    'recordnumber' => $previous_nyukoold_data->recordnumber,
                    'dataint01' => $previous_nyukoold_data->dataint01,
                    'dataint02' => $previous_nyukoold_data->dataint02,
                    'dataint03' => $previous_nyukoold_data->dataint03,
                    'dataint04' => $previous_nyukoold_data->dataint04,
                    'dataint05' => $previous_nyukoold_data->dataint05,
                    'dataint06' => $previous_nyukoold_data->dataint06,
                    'dataint07' => $previous_nyukoold_data->dataint07,
                    'dataint08' => $previous_nyukoold_data->dataint08,
                    'dataint09' => $previous_nyukoold_data->dataint09,
                    'dataint10' => $previous_nyukoold_data->dataint10,
                    'datachar01' => $previous_nyukoold_data->datachar01,
                    'datachar02' => $previous_nyukoold_data->datachar02,
                    'datachar03' => $previous_nyukoold_data->datachar03,
                    'datachar04' => $previous_nyukoold_data->datachar04,
                    'datachar05' => $previous_nyukoold_data->datachar05,
                    'datachar06' => $previous_nyukoold_data->datachar06,
                    'datachar07' => $previous_nyukoold_data->datachar07,
                    'datachar08' => $previous_nyukoold_data->datachar08,
                    'datachar09' => $previous_nyukoold_data->datachar09,
                    'datachar10' => $previous_nyukoold_data->datachar10,
                    'tankano' => $previous_nyukoold_data->tankano,
                    'syouhinbukacd' => $previous_nyukoold_data->syouhinbukacd,
                    'hanbaibukacd' => $previous_nyukoold_data->hanbaibukacd,
                    'dataint11' => $previous_nyukoold_data->dataint11,
                    'dataint12' => $previous_nyukoold_data->dataint12,
                    'dataint13' => $previous_nyukoold_data->dataint13,
                    'dataint14' => $previous_nyukoold_data->dataint14,
                    'datachar11' => $previous_nyukoold_data->datachar11,
                    'datachar12' => $previous_nyukoold_data->datachar12,
                    'datachar13' => $previous_nyukoold_data->datachar13,
                    'datachar14' => $previous_nyukoold_data->datachar14,
                    'datachar15' => $previous_nyukoold_data->datachar15,
                    'dataint16' => $previous_nyukoold_data->dataint16,
                    'dataint17' => $previous_nyukoold_data->dataint17,
                    'dataint18' => $previous_nyukoold_data->dataint18,
                    'dataint19' => $previous_nyukoold_data->dataint19,
                    'dataint20' => $previous_nyukoold_data->dataint20,
                    'datachar16' => $previous_nyukoold_data->datachar16,
                    'datachar17' => $previous_nyukoold_data->datachar17,
                    'datachar18' => $previous_nyukoold_data->datachar18,
                    'datachar19' => $previous_nyukoold_data->datachar19,
                    'datachar20' => $previous_nyukoold_data->datachar20,
                    'dataint21' => $previous_nyukoold_data->dataint21,
                    'dataint22' => $previous_nyukoold_data->dataint22,
                    'dataint23' => $previous_nyukoold_data->dataint23,
                    'dataint24' => $previous_nyukoold_data->dataint24,
                    'dataint25' => $previous_nyukoold_data->dataint25,
                    'dataint26' => $previous_nyukoold_data->dataint26,
                    'dataint27' => $previous_nyukoold_data->dataint27,
                    'dataint28' => $previous_nyukoold_data->dataint28,
                    'dataint29' => $previous_nyukoold_data->dataint29,
                    'dataint30' => $previous_nyukoold_data->dataint30,
                    'datachar21' => $previous_nyukoold_data->datachar21,
                    'datachar22' => $previous_nyukoold_data->datachar22,
                    'datachar23' => $previous_nyukoold_data->datachar23,
                    'datachar24' => $previous_nyukoold_data->datachar24,
                    'datachar25' => $previous_nyukoold_data->datachar25,
                    'datachar26' => $previous_nyukoold_data->datachar26,
                    'datachar27' => $previous_nyukoold_data->datachar27,
                    'datachar28' => $previous_nyukoold_data->datachar28,
                    'datachar29' => $previous_nyukoold_data->datachar29,
                    'datachar30' => $previous_nyukoold_data->datachar30,
                ];
                $nyukoold = QueryHelper::insertData('nyukoold',$nyukoold_insert_data,'syouhinid',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                   
            }
            
            //update hikiatesyukko data
            $hikiatesyukko_update_data = [
                    'syouhinid' => $unsoumei,
                    'datachar16' => 2,
            ];
            //QueryHelper::updateData('hikiatesyukko', $hikiatesyukko_update_data, ['syouhinid' => $unsoumei], $bango, __CLASS__, __FUNCTION__, __LINE__);

            //inserting into rireki
            $tmp_kokyakuorderbango = $unsoumei;
            $tmp_ordertypebango2 = $toiawasebango_previous_data->datanum0013+1;
            CreateHatchuDetails::data($bango,$tmp_kokyakuorderbango, $tmp_ordertypebango2,2,'06-20','purchase_input');

            //end log query
            $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 仕入購入確認 end\n";
            QueryHandler::logger($bango,$log_data);
            
            $success_msg = "仕入番号".$unsoumei."を指示済で登録しました。";
            Session::flash('success_msg', $success_msg);

            pg_query($conn, "COMMIT");
            return "ok";

            } catch (\Exception $e) {
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                QueryHandler::logger($bango, $log_data);
                pg_query($conn,"ROLLBACK");
                return "ng";
            }
		
    }
    
    public function getPurchaseCategoryData(Request $request){
        $input = $request->all();
        $barcode = $input['barcode'];
        $barcode = array_diff($barcode, array(null));
        foreach($barcode as $key=>$val){
            $cat2[] = "'".substr($val,2)."'";
        }
        if(isset($cat2)){
            $cat2 = implode(",",$cat2);
            $categorykanri = QueryHelper::fetchResult("select category1,category2,category4,patternsub2 from categorykanri where category1 = 'J1' AND category2 IN($cat2)");
            $data = collect($categorykanri)->whereIn('patternsub2',['10','70'])->where('patternsub2','!=',null);
            if(count($data) > 0){
                $patternsub2 = $data->max('patternsub2');
                //$tmp_data = $data->where('patternsub2',$patternsub2)->first();
                $category4 = QueryHelper::fetchSingleResult("select category4 from categorykanri where category1 = 'U6' AND category2 ='$patternsub2'")->category4 ?? null;
                $toiawasebango = "U6".$patternsub2;
                $toiawasebango_detail = $patternsub2.' '.$category4;
                $result['status'] = 'ok';
                $result['toiawasebango'] = $toiawasebango;
                $result['toiawasebango_detail'] = $toiawasebango_detail; 
            }else{
                $result['status'] = 'ok';
                $result['toiawasebango'] = null;
                $result['toiawasebango_detail'] = null; 
            }
            return $result;
        }else{
            $result['status'] = 'ok';
            $result['toiawasebango'] = null;
            $result['toiawasebango_detail'] = null;
            return $result;
        }
    }
    
    public static function getCurrentTime(){
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        return str_replace(" ", "", $mytime);
    }

}
