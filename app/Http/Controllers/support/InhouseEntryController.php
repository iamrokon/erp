<?php

namespace App\Http\Controllers\support;
use Illuminate\Http\Request;
use App\tantousya;
use App\kengen;
use App\requestTable;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\support\inhouseEntry\AllNumberSearch;
use App\AllClass\support\inhouseEntry\OrderDetail;
use App\AllClass\common\CreateHatchuDetails;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;
use App\kokyaku1;
use App\AllClass\TableSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Excel;
use Carbon\Carbon;
use App\AllClass\master\CSVLogger;
use App\AllClass\newExcelExport;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;

class InhouseEntryController extends Controller
{

    public function postInhouseEntry(Request $request)
    {
        $bango = request('userId');
        $tantousya = tantousya::find($bango);
        $reviewData = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7402'");
        $review_orderbango = $reviewData->orderbango;
        
        $categorykanriData = QueryHelper::fetchSingleResult("select patternsub2 from categorykanri where category1 = 'J5' AND category2 = '03'");
        $patternsub2 = $categorykanriData->patternsub2;
        
        return view('support.inhouseEntry.mainInhouseEntry', compact('bango', 'tantousya','review_orderbango','patternsub2'));
    }
    
    
    public function numberSearchModalData(Request $request, $bango)
    {
        session()->forget('oldInput' . $bango);
        try {
            $bango = $request->bango;
            $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
            $query = AllNumberSearch::data($bango, '', $request)->toSql();
            
            $numberSearches = collect(QueryHelper::fetchResult($query))->paginate(10);
            $html = view('support.inhouseEntry.number_search.content', compact('numberSearches', 'bango', 'tantousya'))->render();
            return response()->json(["status" => "view rendered", "html" => $html]);
        } catch (Exception $e) {
            dd($e);
        }
    }
    
    public function handleNumberSearch(Request $request)
    {
        $bango = request('userId');
        $tantousya = null;
     
        //QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $data_from_view = $request->all();
        $data_from_view_session = $request->all();
        session()->put('oldInput' . $bango, $data_from_view_session);
        $pagination = 10;
        $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'rd1', 'category_kanri_def', 'request_def'];
        $query = AllNumberSearch::data($bango, '', $request)->toSql();
        $temp_table = "inhouse_entry_number_search";
        
        if (!empty($data_from_view['Button']) && $data_from_view['Button'] == 'refresh') {
            session()->forget('oldInput' . $bango);
            $query = AllNumberSearch::data($bango, 'refresh', $request)->toSql();
            $numberSearches = collect(QueryHelper::fetchResult($query))->paginate($pagination);
            $html = view('support.inhouseEntry.number_search.content', compact('numberSearches', 'bango', 'tantousya'))->render();
            return response()->json(["status" => "view rendered", "html" => $html]);
        }
        if (!empty($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort')) {
            try {
                $query = AllNumberSearch::data($bango, 'search', $request)->toSql();
                $data = $this->removeDataFromView($data_from_view, $removeKeys);
                $numberSearches = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'order_entry')->paginate($pagination);
                
                if ($numberSearches->items() == null && $numberSearches->currentPage() != 1) {
                    $currentPage = ($numberSearches->lastPage());
                    Paginator::currentPageResolver(function () use ($currentPage) {
                        return $currentPage;
                    });
                    $numberSearches = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'order_entry')->paginate($pagination);
                }
            } catch (\Exception $e) {
                dd($e);
            }
            $html = view('support.inhouseEntry.number_search.content', compact('numberSearches', 'bango', 'tantousya'))->render();
            return response()->json(["status" => "view rendered", "html" => $html]);
        }
        
        $numberSearches = collect(QueryHelper::fetchResult($query))->paginate($pagination);
        $html = view('support.inhouseEntry.number_search.content', compact('numberSearches', 'bango', 'tantousya'))->render();
        return response()->json(["status" => "view rendered", "html" => $html]);
    }

    
    public function orderDetailRead(Request $request, $bango)
    {

        $orderId = request('order_id');
        $req_type = request('req_type');
        if($req_type == "input"){
            $hikiatenyukoInfo = QueryHelper::fetchSingleResult("select dataint03 from hikiatenyuko where syouhinid = '$orderId'");
            if($hikiatenyukoInfo && $hikiatenyukoInfo->dataint03 == 2){
                return "hikiatenyuko_dataint03_err";
            }
            
            $juchusyukko2Info = QueryHelper::fetchSingleResult("select count(orderbango) from juchusyukko2 where syouhinid = '$orderId' and codename is not null");
            if($juchusyukko2Info && $juchusyukko2Info->count > 0){
                return "juchusyukko2_codename_err";
            }
        }
        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $query = OrderDetail::data($bango, $orderId);

        $bango = $bango;
        $orderDetail = collect(QueryHelper::fetchResult($query));
        $total_row = count($orderDetail);
        $count_deleted_item = $orderDetail->where('minyuko_denpyobango',"=",1)->count();
        
        $temp_data = $orderDetail->where('minyuko_denpyobango',"!=",1)->groupBy('minyuko_idoutanabango','minyuko_yoteimeter','minyuko_nyukometer');
        $sum_of_205 = 0;
        foreach($temp_data as $key=>$val){
            foreach($val as $key2=>$val2){
                $sum_of_205 = $sum_of_205 + $val2->minyuko_syouhizeiritu;
            }
        }
       
        $sum_of_minyuko_syouhizeiritu = $orderDetail->where('minyuko_denpyobango',"!=",1)->sum('minyuko_syouhizeiritu');
        $formatted_sum_of_minyuko_syouhizeiritu = '¥ '.number_format($orderDetail->where('minyuko_denpyobango',"!=",1)->sum('minyuko_syouhizeiritu'));
        $max_minyuko_syouhinsyu = $orderDetail->max('minyuko_syouhinsyu');
		
        $datachar01 = QueryHelper::fetchResult("select category1,category2,right(category2,2) as category2_display,category4 from categorykanri where category1 = 'V1' and category2 not in('10','50') order by category2 ");
        //$datachar01 = QueryHelper::fetchResult("select category1,category2,right(category2,2) as category2_display,category4 from categorykanri where category1 = 'V1' order by category2 ");
	$datachar13 = QueryHelper::select(['bango','name'])->from('tantousya')->where("mail4 = 'C320'")->where("deleteflag = 0")->orderBy('bango')->get()->execute();
	//$datachar13 = QueryHelper::select(['bango','name','mail4'])->from('tantousya')->get()->execute();
       
        $html = view('support.inhouseEntry.adjustmentDetails', compact('orderDetail','datachar01','datachar13'))->render();
//        $hasOrderDetail = $orderDetail->count();
        return (['orderDetail' => $orderDetail, 'total_row' => $total_row,'sum_of_minyuko_syouhizeiritu' => $sum_of_minyuko_syouhizeiritu, 'formatted_sum_of_minyuko_syouhizeiritu' => $formatted_sum_of_minyuko_syouhizeiritu,'max_minyuko_syouhinsyu' => $max_minyuko_syouhinsyu, 'sum_of_205' => $sum_of_205, 'count_deleted_item' => $count_deleted_item, 'html' => $html]);
    }
    
    public function registerInhouseEntry(Request $request){
        $input = $request->all();
        $bango = $input['userId'];
        $syouhinid = $input['number_search'];
        $datachar01 = $input['datachar01'];
        $minyuko_nyukosu = $input['minyuko_nyukosu'];
        $minyuko_genka = $input['minyuko_genka'];
        $datachar13 = $input['datachar13'];
        $minyuko_bango = $input['minyuko_bango'];
        $minyuko_syouhinsyu = $input['minyuko_syouhinsyu'];
        $current_minyuko_syouhinsyu = $input['current_minyuko_syouhinsyu'];
        $is_new = $input['is_new'];
        $is_deleted = $input['is_deleted'];
        $hidden_minyuko_syouhizeiritu = $input['hidden_minyuko_syouhizeiritu'];
        
        //cost exceed check
        $patternsub2 = $input['patternsub2'];
        $minyuko_syouhizeiritu_limit = $input['minyuko_syouhizeiritu_limit'];
        if($minyuko_syouhizeiritu_limit >= $patternsub2){
            $err_msg = "外注費が".$patternsub2."以上は、稟議事項です。確認してください。";
            $arr = [
                "msg" => $err_msg,
                "status" => "cost_exceed_err"
            ];
            return $arr;
        }
        
        $rules=[];
        $rules['number_search'] = ['required','min:10','max:10','regex:/^[0-9\/]+$/'];
        $rules['datachar01.*'] = ['required'];
        $rules['minyuko_nyukosu.*'] = ['required'];
        $rules['minyuko_genka.*'] = ['required'];
        
        $message=[]; 
        $message['number_search.required']='【番号検索】必須項目に入力がありません。';
        $message['number_search.max']='【番号検索】:max桁以下で入力してください。';
        $message['number_search.min']='【番号検索】の入力は:min文字以上必要です。';
        $message['number_search.regex']='【番号検索】半角数字以外は使用できません。';
        
        foreach ($datachar01 as $key => $value) {
            $temp_key = $key + 1;
            $message['datachar01'.'.'.$key.'.'.'required'] = "取込ファイルを確認してください。(".$temp_key.".発注金額分類)";
        }
        
        foreach ($minyuko_nyukosu as $key => $value) {
            $temp_key = $key + 1;
            $message['minyuko_nyukosu'.'.'.$key.'.'.'required'] = "取込ファイルを確認してください。(".$temp_key.".数量)";
        }
        
        foreach ($minyuko_genka as $key => $value) {
            $temp_key = $key + 1;
            $message['minyuko_genka'.'.'.$key.'.'.'required'] = "取込ファイルを確認してください。(".$temp_key.".単価)";
        }
       
        $validator = Validator::make($input,$rules,$message);  
        $errors = $validator->errors();
        if($errors->any()){
            $err_msg = $errors->all();
            return ['err_field' => $errors, 'err_msg' => $err_msg];
        }else if(!$errors->any() && request('submit_confirmation') == ""){
            return "confirmation_msg";
        }
        
        //check idoutanabango_yoteimeter_nyukometer
        $idoutanabango_yoteimeter_nyukometer = $input['idoutanabango_yoteimeter_nyukometer'];
        $mod_arr  = [];
        $unique = array_unique($idoutanabango_yoteimeter_nyukometer);
        foreach($unique as $search) {
            $found = array_keys($idoutanabango_yoteimeter_nyukometer, $search);
            if(count($found) > 0) {
                $mod_arr[strtoupper($search)] = $found;
            }
        }
        foreach($mod_arr as $tmp_key=>$tmp_val){
            $idoutanabango = explode("_",$tmp_key)[0];
            $yoteimeter = explode("_",$tmp_key)[1];
            $nyukometer = explode("_",$tmp_key)[2];
            $sum = 0;
            foreach($tmp_val as $k=>$v){
                if($is_deleted[$v] == 'no'){
                $sum = $sum + (int) str_replace(',', '', $minyuko_genka[$v]);
                }
     
            }
            $misyukko_data = QueryHelper::fetchSingleResult("
            select 
            SUM(misyukko.dataint05) as sum_of_dataint05
            from (select max(orderbango) as max_orderbango from misyukko
                where syouhinid = '$idoutanabango' and syouhinsyu = '$yoteimeter' and hantei = '$nyukometer') as tmp_minyuko
            join misyukko on misyukko.orderbango =  tmp_minyuko.max_orderbango
            where syouhinid = '$idoutanabango' and syouhinsyu = '$yoteimeter' and hantei = '$nyukometer'
            ");
            if($misyukko_data && ($sum > $misyukko_data->sum_of_dataint05)){
                return "not_ok";
            }
        }
        //check idoutanabango_yoteimeter_nyukometer
        
            $kokyakuorderbango = $input['number_search'];
            $orderhenkan_data = QueryHelper::fetchSingleResult("
            select 
            orderhenkan.*
            from (select MAX(ordertypebango2) as max_ordertypebango2,MAX(bango) as bango from orderhenkan where kokyakuorderbango = '$kokyakuorderbango' group by kokyakuorderbango) as temp_orderhenkan
            join orderhenkan on orderhenkan.bango = temp_orderhenkan.bango
            ");
            
            $juchusyukko2_prvious_orderbango = QueryHelper::fetchSingleResult("
                select 
                juchusyukko2.orderbango
                from juchusyukko2
                where syouhinid = '$kokyakuorderbango'
                ")->orderbango ?? "";

            //start log query
            $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 内作調整入力 start\n";
            QueryHandler::logger($bango,$log_data);
            
            $conn = pg_connect("host=".env("DB_HOST")." port=".env("DB_PORT")."  dbname=".env("DB_DATABASE")." user=".env("DB_USERNAME")." password=".env("DB_PASSWORD"));
            pg_query($conn,"BEGIN");
            try{
                
                $orderhenkan_insert_data = [
                        'kokyakuorderbango' => $orderhenkan_data->kokyakuorderbango,
                        'ordertypebango2' => $orderhenkan_data->ordertypebango2+1,
                        'orderuserbango' => $orderhenkan_data->orderuserbango,
                        'datachar01' => $orderhenkan_data->datachar01,
                        'datachar02' => $orderhenkan_data->datachar02,
                        //'kokyakubango' => 2,
                        'datachar08' => $orderhenkan_data->datachar08,
                        'date' => $orderhenkan_data->date,
                        'datachar09' => $orderhenkan_data->datachar09,
                        'datachar10' => $orderhenkan_data->datachar10,
                        'datachar11' => $orderhenkan_data->datachar11,
                        'intorder01' => $orderhenkan_data->intorder01,
                        'intorder02' => $orderhenkan_data->intorder02,
                        'intorder04' => 2,
                        'datachar04' => $orderhenkan_data->datachar04,
                        'datachar05' => $orderhenkan_data->datachar05,
                        'datachar06' => $orderhenkan_data->datachar06,
                        'datachar07' => $orderhenkan_data->datachar07,
                        'datatxt0147' => $orderhenkan_data->datatxt0147,
                        'deletedate' => $orderhenkan_data->deletedate,
                        'date0012' => $orderhenkan_data->date0012,
                        'datachar12' => $orderhenkan_data->datachar12,
                        'datachar13' => $orderhenkan_data->datachar13,
                        'datachar14' => $orderhenkan_data->datachar14,
                        'datachar15' => $orderhenkan_data->datachar15,
                        'date0013' => $orderhenkan_data->date0013,
                        'date0014' => $orderhenkan_data->date0014,
                        'date0015' => $orderhenkan_data->date0015,
                        'datatxt0148' => $orderhenkan_data->datatxt0148,
                        'datatxt0149' => $orderhenkan_data->datatxt0149,
                        'datatxt0150' => $orderhenkan_data->datatxt0150,
                        'datatxt0151' => $orderhenkan_data->datatxt0151,
                        'intorder03' => $orderhenkan_data->intorder03,
                        'datatxt0152' => $orderhenkan_data->datatxt0152,
                        'synchroorderbango' => $orderhenkan_data->synchroorderbango,
                        'date0018' => $orderhenkan_data->date0018,
                        'date0019' => $orderhenkan_data->date0019,
                        //'datatxt0144' => $orderhenkan_data->datatxt0144,
                        'datatxt0154' => $orderhenkan_data->datatxt0154,
                        'synchroorderbango2' => $orderhenkan_data->synchroorderbango2,
                        'date0016' => $orderhenkan_data->date0016,
                        'date0017' => Carbon::now()->format('Y-m-d H:i:s'),
                        //'datatxt0155' => $bango,
                        'datatxt0156' => $orderhenkan_data->datatxt0156,
                        'datatxt0157' => $orderhenkan_data->datatxt0157,
                        'date0020' => $orderhenkan_data->date0020,
                        'datatxt0158' => $orderhenkan_data->datatxt0158,			
                ];
                $orderhenkan = QueryHelper::insertData('orderhenkan',$orderhenkan_insert_data,'bango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);

//                $previous_hikiatenyuko_data = QueryHelper::fetchSingleResult("
//                select 
//                hikiatenyuko.*
//                from hikiatenyuko
//                where syouhinid = '$kokyakuorderbango'
//                ");
//                $hikiatenyuko_insert_data = [
//                    'orderbango' => $orderhenkan->bango,
//                    'syouhinid' => $previous_hikiatenyuko_data->syouhinid,
//                    'syouhinsyu' => $previous_hikiatenyuko_data->syouhinsyu,
//                    'hantei' => 2,
//                    'dataint01' => 2,
//                    'dataint02' => $previous_hikiatenyuko_data->dataint02,
//                    'dataint03' => $previous_hikiatenyuko_data->dataint03,
//                    'dataint04' => $previous_hikiatenyuko_data->dataint04,
//                    'dataint05' => $previous_hikiatenyuko_data->dataint05,
//                    'datachar01' => $previous_hikiatenyuko_data->datachar01,
//                    'dataint06' => $previous_hikiatenyuko_data->dataint06,
//                    'dataint07' => $previous_hikiatenyuko_data->dataint07,
//                    'dataint08' => $previous_hikiatenyuko_data->dataint08,
//                    'dataint09' => $previous_hikiatenyuko_data->dataint09,
//                    'datachar02' => $previous_hikiatenyuko_data->datachar02,
//                    'datachar03' => $previous_hikiatenyuko_data->datachar03,
//                    'datachar04' => $previous_hikiatenyuko_data->datachar04,
//                    'datachar05' => $previous_hikiatenyuko_data->datachar05,
//                    'yoteimeter' => $previous_hikiatenyuko_data->yoteimeter,
//                    'denpyohakkoubi' => $previous_hikiatenyuko_data->denpyohakkoubi,
//                    'denpyoshimebi' => Carbon::now()->setTimezone("Asia/Tokyo")->format('Y-m-d H:i:s'),
//                    'tantousyabango' => $bango,
//                ];
//                $hikiatenyuko = QueryHelper::insertData('hikiatenyuko',$hikiatenyuko_insert_data,'syouhinid',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                //$hikiatenyuko_delete = QueryHelper::fetchSingleResult("
                //delete
                //from hikiatenyuko
                //where orderbango = '$minyuko_bango'
                //");
                
                //hikiatenyuko update start here
                $hikiatenyuko_update_data = [
                    'syouhinid' => $kokyakuorderbango,
                    'hantei' => 2,
                    'dataint01' => 2,
                    'denpyoshimebi' => Carbon::now()->setTimezone("Asia/Tokyo")->format('Y-m-d H:i:s'),
                    'tantousyabango' => $bango,
                ];
                $hikiatenyuko = QueryHelper::updateData('hikiatenyuko', $hikiatenyuko_update_data, ['syouhinid'=>$kokyakuorderbango], true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                
                
                foreach($datachar01 as $key=>$val){    
//                    if($is_new[$key] == 'no'){
//                    //update minyuko data
//                    $minyuko_update_data = [
//                            'syouhinid' => $syouhinid,
//                            'syouhinsyu' => $minyuko_syouhinsyu[$key],
//                            'datachar01' => $val,
//                            'datachar13' => $datachar13[$key],
//                            //'denpyoshimebi' => Carbon::now()->setTimezone("Asia/Tokyo")-->format('Y-m-d H:i:s'),
//                            'tantousyabango' => $bango,
//                    ];
//                    QueryHelper::updateData('minyuko', $minyuko_update_data, ['syouhinid' => $syouhinid], $bango, __CLASS__, __FUNCTION__, __LINE__);
//
//                    //update juchusyukko2 data
//                    $juchusyukko2_update_data = [
//                            'syouhinid' => $syouhinid,
//                            'syouhinsyu' => $minyuko_syouhinsyu[$key],
//                            'denpyoshimebi' => Carbon::now()->setTimezone("Asia/Tokyo")->format('Y-m-d H:i:s'),
//                            'tantousyabango' => $bango,
//                    ];
//                    //QueryHelper::updateData('juchusyukko2', $juchusyukko2_update_data, ['syouhinid' => $syouhinid], $bango, __CLASS__, __FUNCTION__, __LINE__);
//                    }else{
                        $previous_syouhinsyu = $minyuko_syouhinsyu[$key];
                        //$previous_minyuko_data = QueryHelper::fetchSingleResult("
                        //select 
                        //minyuko.*
                        //from minyuko
                        //where syouhinid = '$kokyakuorderbango' and syouhinsyu = '$previous_syouhinsyu'
                        //");
                        $previous_minyuko_data = QueryHelper::fetchSingleResult("
                        select 
                        minyuko.*
                        from (select syouhinid,syouhinsyu,max(zaikometer) as max_zaikometer from minyuko where syouhinid = '$kokyakuorderbango' and syouhinsyu = '$previous_syouhinsyu' group by syouhinid,syouhinsyu) as temp_minyuko
                        join minyuko on minyuko.syouhinid = temp_minyuko.syouhinid and minyuko.syouhinsyu = temp_minyuko.syouhinsyu
                        and minyuko.zaikometer = temp_minyuko.max_zaikometer
                        --where syouhinid = '$kokyakuorderbango' and syouhinsyu = '$previous_syouhinsyu'
                        ");
                        
                        if($is_new[$key] == 'yes'){
                            $syouhinsyu = $current_minyuko_syouhinsyu[$key];
                        }else{
                            $denpyobango = $previous_minyuko_data->denpyobango;
                            $syouhinsyu = $minyuko_syouhinsyu[$key];
                        }
                        
                        if($is_deleted[$key] == 'yes'){
                            $denpyobango = 1;
                        }else{
                            //$denpyobango = 0;
                            $denpyobango = $previous_minyuko_data->denpyobango;
                        }
                        
                        $minyuko_insert_data = [
                            'orderbango' => $orderhenkan->bango,
                            'syouhinid' => $previous_minyuko_data->syouhinid,
                            'syouhinsyu' => $syouhinsyu,
                            'hantei' => 0,
                            'zaikometer' => $orderhenkan_data->ordertypebango2+1,
                            'idoutanabango' => $previous_minyuko_data->idoutanabango,
                            'yoteimeter' => $previous_minyuko_data->yoteimeter,
                            'nyukometer' => $previous_minyuko_data->nyukometer,
                            'datachar01' => $val,
                            'yoteibi' => $previous_minyuko_data->yoteibi,
                            'kanryoubi' => $previous_minyuko_data->kanryoubi,
                            'kaiinid' => $previous_minyuko_data->kaiinid,
                            'datachar02' => $previous_minyuko_data->datachar02,
                            'datachar03' => $previous_minyuko_data->datachar03,
                            'dataint20' => $previous_minyuko_data->dataint20,
                            'datachar04' => $previous_minyuko_data->datachar04,
                            'datachar05' => $previous_minyuko_data->datachar05,
                            'nyukosu' => str_replace(',', '', $minyuko_nyukosu[$key]),
                            'kingaku' => str_replace(',', '', $minyuko_genka[$key]),
                            //'genka' => $previous_minyuko_data->genka,
                            'genka' => str_replace(',', '', $minyuko_genka[$key]),
                            'syouhizeiritu' => $hidden_minyuko_syouhizeiritu[$key],
                            'datachar07' => $previous_minyuko_data->datachar07,
                            'datachar08' => $previous_minyuko_data->datachar08,
                            'datachar09' => $previous_minyuko_data->datachar09,
                            'datachar10' => $previous_minyuko_data->datachar10,
                            'datachar11' => $previous_minyuko_data->datachar11,
                            'datachar12' => $previous_minyuko_data->datachar12,
                            //'datachar13' => $previous_minyuko_data->datachar13,
                            'datachar13' => $datachar13[$key],
                            'datachar14' => $previous_minyuko_data->datachar14,
                            'dataint21' => $previous_minyuko_data->dataint21,
                            'dataint22' => $previous_minyuko_data->dataint22,
                            'dataint23' => $previous_minyuko_data->dataint23,
                            'season' => $previous_minyuko_data->season,
                            'nengetsu' => $previous_minyuko_data->nengetsu,
                            'datachar15' => $previous_minyuko_data->datachar15,
                            'datachar16' => $previous_minyuko_data->datachar16,
                            'denpyobango' => $denpyobango,
                            'denpyohakkoubi' => Carbon::now()->setTimezone("Asia/Tokyo")->format('Y-m-d H:i:s'),
                            'denpyoshimebi' => $previous_minyuko_data->denpyoshimebi,
                            'tantousyabango' => $bango,
                            'dataint24' => $previous_minyuko_data->dataint24,
                            'dataint25' => $previous_minyuko_data->dataint25,
                            'weeks' => $previous_minyuko_data->weeks,
                            'yoyakubi' => $previous_minyuko_data->yoyakubi,
                            'datachar17' => $previous_minyuko_data->datachar17,
                            'datachar18' => $previous_minyuko_data->datachar18,
                            'soukobango' => $previous_minyuko_data->soukobango,
                            'datachar19' => $previous_minyuko_data->datachar19,
                        ];
                        $minyuko = QueryHelper::insertData('minyuko',$minyuko_insert_data,'syouhinid',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                        //$minyuko_delete = QueryHelper::fetchSingleResult("
                        //delete
                        //from minyuko
                        //where orderbango = '$minyuko_bango'
                        //");
                        
                        
                        $prvious_juchusyukko2_data = QueryHelper::fetchSingleResult("
                        select 
                        juchusyukko2.*
                        from juchusyukko2
                        where syouhinid = '$kokyakuorderbango' and syouhinsyu = '$previous_syouhinsyu'
                        ");
                        
                        $juchusyukko2_insert_data = [
                            'orderbango' => $orderhenkan->bango,
                            'syouhinid' => $prvious_juchusyukko2_data->syouhinid,
                            'syouhinsyu' => $current_minyuko_syouhinsyu[$key],
                            'hantei' => 0,
                            'season' => 1,
                            'nengetsu' => $prvious_juchusyukko2_data->nengetsu,
                            'weeks' => $prvious_juchusyukko2_data->weeks,
                            'datachar01' => $prvious_juchusyukko2_data->datachar01,
                            'datachar02' => $prvious_juchusyukko2_data->datachar02,
                            'datachar03' => $prvious_juchusyukko2_data->datachar03,
                            'datachar04' => $prvious_juchusyukko2_data->datachar04,
                            'yoteimeter' => $prvious_juchusyukko2_data->yoteimeter,
                            'denpyohakkoubi' => Carbon::now()->setTimezone("Asia/Tokyo")->format('Y-m-d H:i:s'),
                            'denpyoshimebi' => $prvious_juchusyukko2_data->denpyoshimebi,
                            'tantousyabango' => $bango,
                            'day' => $prvious_juchusyukko2_data->day,
                            'tanka' => $prvious_juchusyukko2_data->tanka,
                            'barcode' => $prvious_juchusyukko2_data->barcode,
                            'codename' => $prvious_juchusyukko2_data->codename,
                        ];
                        $juchusyukko2 = QueryHelper::insertData('juchusyukko2',$juchusyukko2_insert_data,'syouhinid',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                        //$juchusyukko2_delete = QueryHelper::fetchSingleResult("
                        //delete
                        //from juchusyukko2
                        //where orderbango = '$minyuko_bango'
                        //");
                    //}
                }
                
                $prvious_juchusyukko2_delete = QueryHelper::fetchSingleResult("
                delete 
                from juchusyukko2
                where orderbango = '$juchusyukko2_prvious_orderbango'
                ");
                
                //inserting in rreriki
                $tmp_ordertypebango2 = $orderhenkan_data->ordertypebango2+1;
                CreateHatchuDetails::data($bango,$kokyakuorderbango, $tmp_ordertypebango2,2,'10-01');
                //end log query
                $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 内作調整入力 end\n";
                QueryHandler::logger($bango,$log_data);
                
                $success_msg = "サポート番号".$kokyakuorderbango."で登録しました。";
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
    
    public static function getCurrentTime(){
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        return str_replace(" ", "", $mytime);
    }

}
