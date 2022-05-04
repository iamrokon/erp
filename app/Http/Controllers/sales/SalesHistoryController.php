<?php

namespace App\Http\Controllers\sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\tantousya;
use App\kengen;
use App\AllClass\ButtonMsg;
use App\AllClass\TableSetting;
use Illuminate\Pagination\Paginator;
use App\AllClass\sales\salesHistory\allSalesHistory;
use App\AllClass\sales\salesInquiry\allSalesInquiry;
use App\AllClass\sales\salesInquiry\SalesInquiryFirstPart;
use App\AllClass\sales\salesHistory\validateSalesHistory;
use App\AllClass\sales\salesHistory\salesHistoryHeaders;
use App\AllClass\order\orderEntry\searchCompany2;
use App\AllClass\order\orderEntry\searchCompany4;
use App\AllClass\common\CreateOrderDetails;
use DB;
use Session;
use App\AllClass\db\QueryHandler;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
Use \Carbon\Carbon;


class SalesHistoryController extends Controller
{
    private $headers = [
        '売上日'  =>  'intorder03',
        '売上番号'  =>  'sales_history_juchukubun2',
        '売上区分'  =>  'text1_val',
        '受注番号'  =>  'kokyakuorderbango',
        '担当'  =>  'user_name',
        '受注先'  =>  'information1_detail_show',
        '受注件名'  =>  'juchukubun1',
        '入金日'  =>  'intorder05',
        '売上金額'  =>  'numeric3',
        '粗利'  =>  'moneymax',
        '売上請求先'  =>  'information2_detail_show',
        '入金完了フラグ'  =>  'dataint01_val',
        '請求書発行フラグ'  =>  'dataint02_val',
        '売上会計データ作成フラグ'  =>  'dataint03_val',
        '売掛残高更新フェーズ'  =>  'dataint04_val',
        '売上履歴作成フラグ'  =>  'dataint05_val',
        '請求残高更新フェーズ'  =>  'dataint06_val',
        '指定納品書作成フラグ'  =>  'dataint07_val',
        '請求書発行者'  =>  'user_name2',
        '請求書メール送信フラグ'  =>  'dataint08_val',
        '請求書PDFダウンロードフラグ'  =>  'dataint09_val',
        'プロジェクト番号'  =>  'sales_history_datachar03',
        '入金番号'  =>  'sales_history_youbou',
        '即時区分'  =>  'housoukubun_val',
        '入金方法'  =>  'kessaihouhou_val',

        '売上T登録年月日'  =>  'date',
        '売上T登録時刻'  =>  'time',
        '売上T更新者'  =>  'updated_user',
        '売上T訂正回数'  =>  'updated_times',
        '売上F登録年月日'  =>  'date1',
        '売上F登録時刻'  =>  'time1',
        '売上F更新年月日'  =>  'updated_date',
        '売上F更新時刻'  =>  'updated_time',
        '売上F更新者'  =>  'updated_user1',
    ];

    public function postSalesHistory(Request $request)
    {
        $bango = request('userId');

        if($request->ajax()){
            $validator = validateSalesHistory::validate($request,$bango);
            $errors = $validator->errors();
            if($errors->any()){
                $err_msg = $errors->all();
                return ['err_field'=>$errors,'err_msg'=>$err_msg];
            }else{
                return "ok";
            }
        }

        $data_from_view = $request->all();
        $data_from_view_session = $request->all();
        session()->put('oldInput' . $bango, $data_from_view);

        $route = 'salesHistoryTableSetting';
        $redirect_path = 'salesHistoryReload';
        $tantousya = tantousya::find($bango);

        //pull option selection starts here
        $data003=substr($tantousya->datatxt0003, 2,4);
        $data003_left=substr($tantousya->datatxt0003, 2,4);
        $data003_right=substr($tantousya->datatxt0003, 2,4);
        if (isset($data_from_view['division_datachar05_start'])) {
            $data003_left=substr($data_from_view['division_datachar05_start'], 2,4);
        }else if (isset($data_from_view['division_datachar05_startReqVal'])) {
            $data003_left=substr($data_from_view['division_datachar05_startReqVal'], 2,4);
        }
        if (isset($data_from_view['division_datachar05_end'])) {
            $data003_right=substr($data_from_view['division_datachar05_end'], 2,4);
        }if (isset($data_from_view['division_datachar05_endReqVal'])) {
        $data003_right=substr($data_from_view['division_datachar05_endReqVal'], 2,4);
    }
        $data004 = substr($tantousya->datatxt0004, 2,5);
        $data005 = substr($tantousya->datatxt0005, 2,6);

        $personal_datatxt0003 = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'B9' ")->where("category2 = '$data003' ")->get()->first();

        $personal_datatxt0004 = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C1' ")->where("category2 = '$data004' ")->get()->first();

        $personal_datatxt0005 = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("category2 = '$data005' ")->get()->first();

        if($tantousya->innerlevel<=12) $privileged_user = true;
        else $privileged_user = false;
        $buttonMessage = ButtonMsg::read($bango);

        $dataint_dropdown = array();
        $category_dropdown = array();
        $housoukubun_dropdown = array();
        $color_array =
            [
                'dataint01_val' => '0404入金完了フラグ' ,
                'dataint02_val' => '0404請求書作成フラグ' ,
                'dataint03_val' => '0404売上会計データ作成フラグ' ,
                'dataint04_val' => '0404売掛残高更新フェーズ' ,
                'dataint05_val' => '0404売上履歴作成フラグ' ,
                'dataint06_val' => '0404請求残高更新フェーズ' ,
                'dataint07_val' => '0404指定納品書作成フラグ' ,
                'dataint08_val' => '0404請求書メール送信フラグ' ,
                'dataint09_val' => '0404請求書PDFダウンロードフラグ',
            ];

        foreach($color_array as $dataint=>$color)
        {
            $query = DB::table('request')
                ->whereRaw('color=\''.$color.'\'')
                ->selectRaw("syouhinbango, CONCAT(syouhinbango,' ',jouhou) as flag")
                ->toSql();
            $temp_array = QueryHelper::fetchResult($query);
            foreach($temp_array as $temp)
            {
                if($dataint == 'dataint01_val'){
                    if($temp->syouhinbango == '3' || $temp->syouhinbango == '4'){
                        continue;
                    }
                }
                $dataint_dropdown[$dataint][$temp->syouhinbango] = $temp->flag;
            }
        }

        //dd($dataint_dropdown);
        $query = DB::table('request')
            ->whereRaw('color=\'0404即時区分\'')
            ->selectRaw("*")
            ->toSql();
        $temp_array = QueryHelper::fetchResult($query);

        foreach($temp_array as $temp)
        {
            $housoukubun_dropdown[$temp->syouhinbango] = $temp->syouhinbango.' '.$temp->jouhou;
        }
        // if($privileged_user)
        // {

        $query = DB::table('categorykanri')
            ->whereRaw('category1=\'A9\'')
            ->selectRaw("*")
            ->orderByRaw('suchi1')
            ->toSql();
        $temp_array = QueryHelper::fetchResult($query);

        foreach($temp_array as $temp)
        {
            $category_dropdown[$temp->category1.$temp->category2] = $temp->category2.' '.$temp->category4;
        }
        //}

        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 20;
        }

        $query = searchCompany2::data($bango, 0);

        // dump($query);
        $popUpData['kokyaku1'] = QueryHelper::fetchResult($query);

        $query2 = searchCompany4::data($bango, 0);

        $popUpData['kokyaku1_2'] = QueryHelper::fetchResult($query2);


        //review data
        $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7501'");

        $review_orderbango = $reviewData->orderbango;

        //get categorykanri data
        $B9Data_left = QueryHelper::fetchResult("select *,RIGHT(category2, 2) as category2_show from categorykanri where category1 = 'B9' and (suchi2 = 0 or suchi2 is null) and left(category2, 2) ='$review_orderbango' ORDER BY category2 ASC");

        $B9Data_right = QueryHelper::fetchResult("select *,RIGHT(category2, 2) as category2_show from categorykanri where category1 = 'B9' and (suchi2 = 0 or suchi2 is null) and left(category2, 2) ='$review_orderbango' ORDER BY category2 ASC");

        $C1Data_left = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C1' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_left%' ")->get()->execute();

        $C1Data_right = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C1' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_right%' ")->get()->execute();

        $C2Data_left = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_left%' ")->get()->execute();

        $C2Data_right = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_right%' ")->get()->execute();

        //dd($C1Data_left);
        $datachar05 = QueryHelper::fetchResult("select * from tantousya where ztanka = '$review_orderbango' and deleteflag = 0  order by bango");
        $datachar05 = QueryHelper::fetchResult("select * from tantousya where deleteflag = 0 and ztanka='$review_orderbango' and innerlevel >= 10 and innerlevel <= 20 order by bango");

        $text1s = QueryHelper::fetchResult(
            DB::table('categorykanri')
                ->whereRaw("category1='U5'")
                ->selectRaw("CONCAT(category2,' ',category4) as option, CONCAT(category1,category2) as value")
                ->orderByRaw('suchi1')
                ->toSql()
        );

        if (!empty($data_from_view['chkboxinp'])) {
            $deleted_item = $data_from_view['chkboxinp'];
        } else {
            $deleted_item = 0;
        }

        $headers = salesHistoryHeaders::headers($bango);
        $table_headers = salesHistoryHeaders::headers($bango, 'table_headers');
        $page_no = salesHistoryHeaders::$page_no;
        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $bango)->where('kengenchar05', '04-04')->get()->count();
        if($initial_header == 0){
            unset($headers['売上T登録年月日']);
            unset($headers['売上T登録時刻']);
            unset($headers['売上T更新者']);
            unset($headers['売上T訂正回数']);
            unset($headers['売上F登録年月日']);
            unset($headers['売上F登録時刻']);
            unset($headers['売上F更新年月日']);
            unset($headers['売上F更新時刻']);
            unset($headers['売上F更新者']);
        }

        $temp_table = 'sales_history_temp';

        if (isset($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh')) {
            $fsRemoveKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp','update'];
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp','update','division_datachar05_start','division_datachar05_end','department_datachar05_start','department_datachar05_end','group_datachar05_start','group_datachar05_end','date_start','date_end','intorder03_start','intorder03_end','rd1','rd2','kokyakuorderbango_start','kokyakuorderbango_end','information1_detail','information2_detail','information3_detail','juchukubun_start','juchukubun_end','dataint06','dropdown_change_status_1','dropdown_change_status_2'];
            
            try {
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh') {
                    //default req data
                    $default_data =  $data_from_view;

                    //check number format
                    $str_to_int = ['numeric3', 'moneymax'];
                    foreach ($data_from_view as $key => $value) {
                        if (in_array($key, $str_to_int) && strpos($value, ',') == true) {
                            $data_from_view[$key] = str_replace(',','',$value);;
                        }
                    }

                    $fs_req_data = $this->removeDataFromView($data_from_view, $fsRemoveKeys);
                    foreach ($fs_req_data as $key => $value) {
                        if (strpos($key, 'ReqVal') !== false) {
                            $fs_req_data[str_replace('ReqVal', '', $key)] = $value;
                            unset($fs_req_data[$key]);
                        }
                    }

                    $data = $this->removeDataFromView($data_from_view, $removeKeys);
                    if($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort'){
                        $default_req_data = $default_data;
                    }else{
                        $default_req_data = "";
                    }
                    
                    //first search req data
                    $fsReqData = [];
                    $bangos = [];
                    foreach ($data as $key => $value) {
                        if (strpos($key, 'ReqVal') !== false) {
                            $fsReqData[str_replace('ReqVal', '', $key)] = $value;
                            unset($data[$key]);
                        }
                    }
                    $first_search_res = "";
                    if(!empty($fsReqData)){
                        $search_removeKeys = ['division_datachar05_start','division_datachar05_end','department_datachar05_start','department_datachar05_end','group_datachar05_start','group_datachar05_end','date_start','date_end','intorder03_start','intorder03_end','rd1','rd2','kokyakuorderbango_start','kokyakuorderbango_end','information1_detail','information2_detail','information3_detail','juchukubun_start','juchukubun_end'];
                        $reqData = $this->removeDataFromView($fsReqData, $search_removeKeys);
                        $first_search_result = "";
                        $query = allSalesHistory::data($bango, $deleted_item,$color_array,$bangos,$fsReqData,$first_search_result)->toSql();
                        $salesHistoryInfo = $this->searchDataFetch($query, $reqData, $bango, $temp_table);
//                        $salesHistoryInfo = $this->searchDataFetch($query, $data, $bango, $temp_table);

                        foreach($salesHistoryInfo as $key=>$val){
                            foreach($val as $k=>$v){
                                if($k=="bango"){
                                    array_push($bangos,$v);
                                }
                            }
                        }
                        if(count($bangos)<1){
                            $first_search_res = "no_data";
                        }
                    }
                    if($data_from_view['Button'] == 'refresh'){
                        $data = array();
                    }
                    $first_search_result = "";
                    $query = allSalesHistory::data($bango, $deleted_item,$color_array,$bangos,$fs_req_data)->toSql();
                    $salesHistoryInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
//                    $salesHistoryInfo = $this->searchDataFetch($query, $reqData, $bango, $temp_table, $pagination);
                    if ($salesHistoryInfo->items() == null && $salesHistoryInfo->currentPage() != 1) {
                        $currentPage = ($salesHistoryInfo->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $salesHistoryInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
//                        $salesHistoryInfo = $this->searchDataFetch($query, $reqData, $bango, $temp_table, $pagination);
                    }

                    if ($salesHistoryInfo->total() == 0) {
                        $exceedUser = '該当するデータがありません。';
                    } else {
                        $exceedUser = '';
                    }

                    if($data_from_view['Button'] == 'FirstSearch'){
                        $fsReqData = $fs_req_data; //fsReqData=first search request data
                    }
                    if ($data_from_view['Button'] == 'xls') {
                        $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                        $excelName = '売上履歴一覧.xlsx';
                        $headers = [
                            '売上日'  =>  'intorder03',
                            '売上番号'  =>  'sales_history_juchukubun2',
                            '売上区分'  =>  'text1_val',
                            '受注番号'  =>  'kokyakuorderbango',
                            '担当'  =>  'user_name',
                            '受注先'  =>  'information1_detail_show',
                            '受注件名'  =>  'juchukubun1',
                            '入金日'  =>  'intorder05',
                            '売上金額'  =>  'numeric3',
                            '粗利'  =>  'moneymax',
                            '売上請求先'  =>  'information2_detail_show',
                            '入金完了フラグ'  =>  'dataint01_val',
                            '請求書発行フラグ'  =>  'dataint02_val',
                            '売上会計データ作成フラグ'  =>  'dataint03_val',
                            '売掛残高更新フェーズ'  =>  'dataint04_val',
                            '売上履歴作成フラグ'  =>  'dataint05_val',
                            '請求残高更新フェーズ'  =>  'dataint06_val',
                            '指定納品書作成フラグ'  =>  'dataint07_val',
                            '請求書発行者'  =>  'user_name2',
                            '請求書メール送信フラグ'  =>  'dataint08_val',
                            '請求書PDFダウンロードフラグ'  =>  'dataint09_val',
                            'プロジェクト番号'  =>  'sales_history_datachar03',
                            '入金番号'  =>  'sales_history_youbou',
                            '即時区分'  =>  'housoukubun_val',
                            '入金方法'  =>  'kessaihouhou_val',

                            '売上T登録年月日'  =>  'date',
                            '売上T登録時刻'  =>  'time',
                            '売上T更新者'  =>  'updated_user',
                            '売上T訂正回数'  =>  'updated_times',
                            '売上F登録年月日'  =>  'date1',
                            '売上F登録時刻'  =>  'time1',
                            '売上F更新年月日'  =>  'updated_date',
                            '売上F更新時刻'  =>  'updated_time',
                            '売上F更新者'  =>  'updated_user1',
                        ];
                        return $this->excelDownload($headers, $searched, $excelName);
                    }
                }
            } catch (\Exception $e) {
//                dd($e);
                $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;
                $exceedUser = '検索形式が間違っています。';
                $salesHistoryInfo = QueryHelper::fetchResult($query);
                $salesHistoryInfo = collect($salesHistoryInfo);
                $total_sales  = $salesHistoryInfo->sum('numeric3');
                $gross_profit  = $salesHistoryInfo->sum('moneymax');
                $salesHistoryInfo = $salesHistoryInfo->paginate($pagi);
                return view('sales.salesHistory.mainSalesHistory', compact('bango', 'headers', 'table_headers', 'page_no','salesHistoryInfo','tantousya','privileged_user','dataint_dropdown','category_dropdown','housoukubun_dropdown','exceedUser','buttonMessage','popUpData','B9Data_left','C1Data_left','C2Data_left','B9Data_right','C1Data_right','C2Data_right','default_req_data','fsReqData','datachar05','text1s','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','data_from_view','total_sales','gross_profit','route','redirect_path'));
            }
            $total_sales  = $salesHistoryInfo->sum('numeric3');
            $gross_profit  = $salesHistoryInfo->sum('moneymax');
            //dd($salesHistoryInfo);
            //dd($C1Data_left);
            return view('sales.salesHistory.mainSalesHistory', compact('bango', 'headers', 'table_headers', 'page_no','salesHistoryInfo','tantousya','privileged_user','dataint_dropdown','category_dropdown','housoukubun_dropdown','exceedUser','buttonMessage','popUpData','B9Data_left','C1Data_left','C2Data_left','B9Data_right','C1Data_right','C2Data_right','default_req_data','fsReqData','datachar05','text1s','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','data_from_view','total_sales','gross_profit','route','redirect_path'));
        }

        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;

        //$query = allSalesHistory::data($bango, $deleted_item,$color_array)->whereRaw('bango = 0')->toSql();

        //$salesHistoryInfo = QueryHelper::fetchResult($query);

        $salesHistoryInfo = collect([]);
        $total_sales  = $salesHistoryInfo->sum('numeric3');
        $gross_profit  = $salesHistoryInfo->sum('moneymax');
        $salesHistoryInfo = $salesHistoryInfo->paginate($pagi);

        return view('sales.salesHistory.mainSalesHistory', compact('bango', 'headers', 'table_headers', 'page_no','salesHistoryInfo','tantousya','privileged_user','dataint_dropdown','category_dropdown','housoukubun_dropdown','pagi','buttonMessage','popUpData','B9Data_left','C1Data_left','C2Data_left','B9Data_right','C1Data_right','C2Data_right','datachar05','text1s','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','data_from_view','total_sales','gross_profit','route','redirect_path'));
    }


    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $id)->where('kengenchar05', '04-04')->get()->count();
        $pageNo = salesHistoryHeaders::$page_no;
        //return $Setting = TableSetting::setting($this->headers, $id, $pageNo);
        $Setting = TableSetting::setting($this->headers, $id, $pageNo);
        if($initial_header == 0){
            $Setting['date'] = "";
            $Setting['time'] = "";
            $Setting['updated_user'] = "";
            $Setting['updated_times'] = "";
            $Setting['date1'] = "";
            $Setting['time1'] = "";
            $Setting['updated_date'] = "";
            $Setting['updated_time'] = "";
            $Setting['updated_user1'] = "";
        }
        return $Setting;
    }

    public function tableSettingSave(Request $request, $id, $type = null)
    {
        $pageNo = salesHistoryHeaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '受注履歴一覧・受注照会', $type);
    }

    public function update()
    {
        $id = request('userId');
        $update_array = request('update');
        $date = date("Y-m-d H:i:s");
        $date_formatted = str_replace(" ","",str_replace(":","",str_replace("-","",$date)));
//        dd($date_formatted);
//        return $update_array;
        
        //start log query
        $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 売上履歴一覧・売上照会 start\n";
        QueryHandler::logger($id,$log_data);

        $conn = pg_connect("host=".env("DB_HOST")." port=".env("DB_PORT")."  dbname=".env("DB_DATABASE")." user=".env("DB_USERNAME")." password=".env("DB_PASSWORD"));
        pg_query($conn,"BEGIN");
        try{
            foreach($update_array as $bango=>$value_array)
            {
                $tmp_kokyakuorderbango = $value_array['kokyakuorderbango'];
                $tmp_housoukubun = $value_array['housoukubun_val'];
                $tmp_kessaihouhou = $value_array['kessaihouhou_val'];
                $tmp_dataint01 = $value_array['dataint01_val'];
                $tmp_intorder05 = str_replace("/","",$value_array['intorder05']);
                $orderhenkanData = QueryHelper::fetchSingleResult("
                    select bango,kokyakuorderbango,ordertypebango2,intorder05,datachar10,tuhanorder.housoukubun,tuhanorder.kessaihouhou 
                    from orderhenkan 
                    join tuhanorder on tuhanorder.orderbango = orderhenkan.bango
                    where kokyakuorderbango = '$tmp_kokyakuorderbango' 
                    and datachar10 is not null 
                    order by ordertypebango2 desc LIMIT 1");
                
                if($orderhenkanData && ($orderhenkanData->intorder05 != $tmp_intorder05 || $orderhenkanData->housoukubun != $tmp_housoukubun || $orderhenkanData->kessaihouhou != $tmp_kessaihouhou)){
                    $current_date = Carbon::now()->format('Y-m-d H:i:s');
                    $tmp_ordertypebango2 = $orderhenkanData->ordertypebango2 + 1;
                    $orderhenkanInfo = QueryHelper::fetchSingleResult("
                        SELECT * FROM orderhenkan 
                        WHERE kokyakuorderbango = '$orderhenkanData->kokyakuorderbango'
                        AND ordertypebango2 = $orderhenkanData->ordertypebango2
                        AND datachar10 = '$orderhenkanData->datachar10'
                        ");
                    $orderhenkan_insert_data = collect($orderhenkanInfo)->toArray();
                    unset($orderhenkan_insert_data['bango']);
                    $orderhenkan_insert_data['ordertypebango2'] = $tmp_ordertypebango2;
                    $orderhenkan_insert_data['intorder05'] = $tmp_intorder05;
                    $orderhenkan_insert_data['datachar01'] = 2;
                    $orderhenkan_insert_data['date'] = $current_date;
                    $orderhenkan_insert_data['orderuserbango'] = $id;
                    $orderhenkan = QueryHelper::insertData('orderhenkan',$orderhenkan_insert_data,'bango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                    
                    //tuhanorder starts
                    $tuhanorderInfo = QueryHelper::fetchSingleResult("
                        SELECT * FROM tuhanorder 
                        WHERE orderbango = '$orderhenkanInfo->bango'
                        ");
                    $tuhanorder_insert_data = collect($tuhanorderInfo)->toArray();
                    unset($tuhanorder_insert_data['orderbango']);
                    $tuhanorder_insert_data['orderbango'] = $orderhenkan->bango;
                    $tuhanorder_insert_data['housoukubun'] = $tmp_housoukubun;
                    $tuhanorder_insert_data['kessaihouhou'] = $tmp_kessaihouhou;
                    $tuhanorder_insert_data['text5'] = '4000';
                    $tuhanorder = QueryHelper::insertData('tuhanorder',$tuhanorder_insert_data,'orderbango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                    
                    //hikiatesyukko starts
                    $hikiatesyukkoInfo = QueryHelper::fetchSingleResult("
                        SELECT * FROM hikiatesyukko 
                        WHERE orderbango = '$orderhenkanInfo->bango'
                        ");
                    $hikiatesyukko_insert_data = collect($hikiatesyukkoInfo)->toArray();
                    unset($hikiatesyukko_insert_data['orderbango']);
                    $hikiatesyukko_insert_data['orderbango'] = $orderhenkan->bango;
                    $hikiatesyukko_insert_data['dataint01'] = $tmp_dataint01;
                    $hikiatesyukko_insert_data['idoutanabango'] = $date_formatted;
                    $hikiatesyukko_insert_data['tantousyabango'] = $bango;
                    $hikiatesyukko = QueryHelper::insertData('hikiatesyukko',$hikiatesyukko_insert_data,'orderbango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                    
                    //syukkoold starts
                    $syukkooldInfo = QueryHelper::fetchResult("
                        SELECT * FROM syukkoold 
                        WHERE orderbango = '$orderhenkanInfo->bango'
                        ");
                    foreach($syukkooldInfo as $tmp_key=>$tmp_val){
                        $syukkoold_insert_data = collect($tmp_val)->toArray();
                        unset($syukkoold_insert_data['orderbango']);
                        $syukkoold_insert_data['orderbango'] = $orderhenkan->bango;
                        $syukkoold_insert_data['dataint01'] = $orderhenkan->ordertypebango2;
                        $syukkoold_insert_data['tanabango'] = $date_formatted;
                        $syukkoold_insert_data['tantousyabango'] = $id;
                        $syukkoold = QueryHelper::insertData('syukkoold',$syukkoold_insert_data,'orderbango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                    }
                    
                    //create history details => CreateOrderDetails::data($bango,$kokyakuorderbango, $ordertypebango2,$datachar01)
                    $tmp_kokyakuorderbango = $orderhenkanData->kokyakuorderbango;
                    $datachar10 = $orderhenkanData->datachar10;
                    CreateOrderDetails::data($bango,$tmp_kokyakuorderbango, $tmp_ordertypebango2,2,'04-04-01','sales_data',$datachar10);
                    
                    
                    //$max_bango = QueryHelper::fetchSingleResult("select max(bango) as max_bango from orderhenkan")->max_bango + 1;
                    //orderhenkan starts
//                    QueryHelper::runQuery("CREATE TEMPORARY TABLE sales_history_temp_orderhenkan as
//                    SELECT * FROM orderhenkan 
//                    WHERE kokyakuorderbango = '$orderhenkanData->kokyakuorderbango'
//                    AND ordertypebango2 = $orderhenkanData->ordertypebango2
//                    AND datachar10 = '$orderhenkanData->datachar10'
//                    ");
//                    QueryHelper::runQuery("UPDATE sales_history_temp_orderhenkan SET 
//                        bango = $max_bango, 
//                        ordertypebango2 = $tmp_ordertypebango2, 
//                        intorder05 = $tmp_intorder05,
//                        datachar01 = 2,
//                        date = '$current_date',
//                        orderuserbango = $id
//                        ");
//                    $orderhenkan_insert_data = QueryHelper::runQuery("INSERT INTO orderhenkan SELECT * FROM sales_history_temp_orderhenkan");
//                    QueryHelper::runQuery("DROP TABLE IF EXISTS sales_history_temp_orderhenkan");
                    //orderhenkan ends

                    //tuhanorder starts
//                    QueryHelper::runQuery("CREATE TEMPORARY TABLE sales_history_temp_tuhanorder as
//                    SELECT * FROM tuhanorder 
//                    WHERE orderbango = '$orderhenkanData->bango'
//                    ");
//                    $data = QueryHelper::fetchSingleResult("select orderbango,text5 from sales_history_temp_tuhanorder");
//                    //if($data->text5 != null){
//                    //    $text5 = $data->text5;
//                    //    $text5[0] = "2";           
//                    //}else{
//                    //    $text5 = null;
//                    //}
//                    QueryHelper::runQuery("UPDATE sales_history_temp_tuhanorder SET 
//                        orderbango = $max_bango, 
//                        housoukubun = '$tmp_housoukubun', 
//                        kessaihouhou = '$tmp_kessaihouhou', 
//                        text5 = '4000'
//                        ");
//                    QueryHelper::runQuery("INSERT INTO tuhanorder SELECT * FROM sales_history_temp_tuhanorder");
//                    QueryHelper::runQuery("DROP TABLE IF EXISTS sales_history_temp_tuhanorder");
                    //tuhanorder ends

                    //hikiatesyukko starts
//                    QueryHelper::runQuery("CREATE TEMPORARY TABLE sales_history_temp_hikiatesyukko as
//                    SELECT * FROM hikiatesyukko 
//                    WHERE orderbango = '$orderhenkanData->bango'
//                    ");
//                    QueryHelper::runQuery("UPDATE sales_history_temp_hikiatesyukko SET 
//                        orderbango = $max_bango, 
//                        dataint01 = $tmp_dataint01,
//                        idoutanabango = '$date_formatted',
//                        tantousyabango = $id
//                        ");
//                    QueryHelper::runQuery("INSERT INTO hikiatesyukko SELECT * FROM sales_history_temp_hikiatesyukko");
//                    QueryHelper::runQuery("delete from hikiatesyukko where orderbango = '$orderhenkanData->bango'");
//                    QueryHelper::runQuery("DROP TABLE IF EXISTS sales_history_temp_hikiatesyukko");
                    //hikiatesyukko ends
                    
                    //syukkoold starts
//                    QueryHelper::runQuery("CREATE TEMPORARY TABLE sales_history_temp_syukkoold as
//                    SELECT * FROM syukkoold 
//                    WHERE orderbango = '$orderhenkanData->bango'
//                    ");
//                    $syukkoold_data = QueryHelper::fetchSingleResult("select dataint01 from sales_history_temp_syukkoold");
//                    QueryHelper::runQuery("UPDATE sales_history_temp_syukkoold SET 
//                        orderbango = $max_bango,
//                        dataint01 = $syukkoold_data->dataint01+1,
//                        tantousyabango = $id,
//                        tanabango = $date_formatted
//                        ");
//                    QueryHelper::runQuery("INSERT INTO syukkoold SELECT * FROM sales_history_temp_syukkoold");
//                    //QueryHelper::runQuery("delete from syukkoold where orderbango = '$orderhenkanData->bango'");
//                    QueryHelper::runQuery("DROP TABLE IF EXISTS sales_history_temp_syukkoold");
                    //syukkoold ends
                    
                    
                    //============== create order data starts ===================
                    $orderhenkanInfo = QueryHelper::fetchSingleResult("
                        select 
                        orderhenkan.* 
                        from (select max(ordertypebango2) as max_ordertypebango2,kokyakuorderbango from orderhenkan WHERE kokyakuorderbango = '$orderhenkanData->kokyakuorderbango' AND datachar10 is null group by kokyakuorderbango) as tmp_orderhenkan
                        join orderhenkan on orderhenkan.kokyakuorderbango = tmp_orderhenkan.kokyakuorderbango
                        AND orderhenkan.ordertypebango2 = tmp_orderhenkan.max_ordertypebango2
                        ");
                    $orderhenkan_insert_data = collect($orderhenkanInfo)->toArray();
                    unset($orderhenkan_insert_data['bango']);
                    $orderhenkan_insert_data['ordertypebango2'] = $orderhenkan_insert_data['ordertypebango2'] + 1;
                    $orderhenkan_insert_data['datachar01'] = 2;
                    $orderhenkan_insert_data['date'] = $current_date;
                    $orderhenkan_insert_data['orderuserbango'] = $id;
                    $orderhenkan = QueryHelper::insertData('orderhenkan',$orderhenkan_insert_data,'bango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                    
                    //tuhanorder starts
                    $tuhanorderInfo = QueryHelper::fetchSingleResult("
                        SELECT * FROM tuhanorder 
                        WHERE orderbango = '$orderhenkanInfo->bango'
                        ");
                    $tuhanorder_insert_data = collect($tuhanorderInfo)->toArray();
                    unset($tuhanorder_insert_data['orderbango']);
                    $tuhanorder_insert_data['orderbango'] = $orderhenkan->bango;
                    $tuhanorder = QueryHelper::insertData('tuhanorder',$tuhanorder_insert_data,'orderbango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                    
                    //hikiatesyukko starts
                    $hikiatesyukkoInfo = QueryHelper::fetchSingleResult("
                        SELECT * FROM hikiatesyukko 
                        WHERE orderbango = '$orderhenkanInfo->bango'
                        ");
                    $hikiatesyukko_insert_data = collect($hikiatesyukkoInfo)->toArray();
                    unset($hikiatesyukko_insert_data['orderbango']);
                    $hikiatesyukko_insert_data['idoutanabango'] = $date_formatted;
                    $hikiatesyukko_insert_data['tantousyabango'] = $bango;
                    $hikiatesyukko_insert_data['orderbango'] = $orderhenkan->bango;
                    $hikiatesyukko = QueryHelper::insertData('hikiatesyukko',$hikiatesyukko_insert_data,'orderbango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                    
                    //misyukko starts
                    $misyukkoInfo = QueryHelper::fetchResult("
                        SELECT * FROM misyukko 
                        WHERE orderbango = '$orderhenkanInfo->bango'
                        ");
                    foreach($misyukkoInfo as $tmp_key=>$tmp_val){
                        $misyukko_insert_data = collect($tmp_val)->toArray();
                        unset($misyukko_insert_data['orderbango']);
                        $misyukko_insert_data['orderbango'] = $orderhenkan->bango;
                        $misyukko_insert_data['dataint01'] = $orderhenkan->ordertypebango2;
                        $misyukko_insert_data['tanabango'] = $date_formatted;
                        $misyukko_insert_data['tantousyabango'] = $id;
                        $misyukko = QueryHelper::insertData('misyukko',$misyukko_insert_data,'orderbango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                    }
                    
                    //create history details => CreateOrderDetails::data($bango,$kokyakuorderbango, $ordertypebango2,$datachar01)
                    CreateOrderDetails::data($bango,$orderhenkanData->kokyakuorderbango, 0,1,'04-04');
                    //============== create order data ends ===================
                    
                    $status_msg = "登録しました。";
                    Session::flash('status_msg',$status_msg);

                }else{
                    $value_array['intorder05']=str_replace('/','',$value_array['intorder05']);
                    $where_array = ['orderbango'=>$bango];
                    $kokyakuorderbango = $value_array['kokyakuorderbango'];
                    unset($value_array['kokyakuorderbango']);
                    $orderhenkan_db = QueryHelper::fetchResult("select bango,kokyakuorderbango,intorder05 from orderhenkan where kokyakuorderbango = '$kokyakuorderbango' order by ordertypebango2 desc LIMIT 1");
                    $tuhanorder_db = QueryHelper::fetchResult("select orderbango,housoukubun,kessaihouhou from tuhanorder where orderbango = '$bango' LIMIT 1");
                    $hikiatesyukko_db = QueryHelper::fetchResult("select orderbango,dataint01 from hikiatesyukko where orderbango = '$bango' LIMIT 1");

                    $pre_val_array=[
                        '0'=>$orderhenkan_db[0]->intorder05,
                        '1'=>$hikiatesyukko_db[0]->dataint01,
                        '2'=>$tuhanorder_db[0]->housoukubun,
                        '3'=>$tuhanorder_db[0]->kessaihouhou,
                    ];
        //            dd($pre_val_array,$orderhenkan_db[0],$tuhanorder_db[0],$hikiatesyukko_db[0],$bango,$value_array) ;

                    $flag=false;
                    $i=0;
                    foreach ($value_array as $val){
                        if ($val!=$pre_val_array[$i]){
                            $flag=true;
                            break;
                        }
                        $i++;
                    }
        //            dd($flag);

                    if ($flag==true){
                        $update_array =
                            [
                                /*'tanabango' => $date_formatted,*/
                                'dataint01' => $value_array['dataint01_val'],
                                'tantousyabango' => $id,
                                'idoutanabango' => $date_formatted,
                            ];

                        QueryHelper::updateData('hikiatesyukko',$update_array,$where_array,$id, __CLASS__, __FUNCTION__, __LINE__);

                        $update_array =
                            [
                                'housoukubun' => $value_array['housoukubun_val'],
                                'kessaihouhou' => $value_array['kessaihouhou_val'],
                                //'otodokedate' => $date,
                            ];

                        QueryHelper::updateData('tuhanorder',$update_array,$where_array,$id, __CLASS__, __FUNCTION__, __LINE__);

                        $where_array = ['bango'=>$bango];
                        $update_array =
                            [
                                'intorder05' => str_replace('/','',$value_array['intorder05']),
                                /*'date' => $date,*/
                                'orderuserbango' => $id,
                                /*'ordertypebango2' => (int)$order_row[0]->ordertypebango2 + 1,*/
                            ];
                        QueryHelper::updateData('orderhenkan',$update_array,$where_array,$id, __CLASS__, __FUNCTION__, __LINE__);

                        $where_array = ['bango'=>$orderhenkan_db[0]->bango];
                        $update_array =
                            [
                                'intorder05' => str_replace('/','',$value_array['intorder05']),
                                /*'date' => $date,*/
                                'orderuserbango' => $id,
                            ];
                        QueryHelper::updateData('orderhenkan',$update_array,$where_array,$id, __CLASS__, __FUNCTION__, __LINE__);
                        $status_msg = "登録しました。";
                        Session::flash('status_msg',$status_msg);
                    }
                }
            }
            //end log query
            $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 売上履歴一覧・売上照会 end\n";
            QueryHandler::logger($id,$log_data);
            pg_query($conn,mb_convert_encoding("COMMIT", "CP51932"));
        } catch (\Exception $e) {
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
            QueryHandler::logger($id, $log_data);
            pg_query($conn,mb_convert_encoding("ROLLBACK", "CP51932"));
            $result['status'] = "ng";
            return $result;
        }
        
        return 'ok';
    }
    //sales inquiry start here

    public function postSalesInquiry(Request $request){
        $bango = request('userId');
        $kokyakuorderbango = request('s_kokyakuorderbango');
        $ordertypebango2 = intval(request('s_ordertypebango2'));
        $tantousya = tantousya::find($bango);

        if($tantousya->innerlevel>=10 && $tantousya->innerlevel<=14) $privileged_user = true;
        else $privileged_user = false;

        $category_dropdown = array();
        $query = DB::table('categorykanri')
            ->whereRaw('category1=\'A9\'')
            ->selectRaw("*")
            ->orderByRaw('suchi1')
            ->toSql();
        $temp_array = QueryHelper::fetchResult($query);
        foreach($temp_array as $temp)
        {
            $category_dropdown[$temp->category1.$temp->category2] = $temp->category2.' '.$temp->category4;
        }

        $housoukubun_dropdown = array();
        $query = DB::table('request')
            ->whereRaw('color=\'0404即時区分\'')
            ->selectRaw("*")
            ->toSql();
        $temp_array = QueryHelper::fetchResult($query);
        foreach($temp_array as $temp)
        {
            $housoukubun_dropdown[$temp->syouhinbango] = $temp->syouhinbango.' '.$temp->jouhou;
        }

        $color_array =
            [
                'dataint01' => '0404入金完了フラグ' ,
                'dataint02' => '0404請求書作成フラグ' ,
                'dataint03' => '0404売上会計データ作成フラグ' ,
                'dataint04' => '0404売掛残高更新フェーズ' ,
                'dataint05' => '0404売上履歴作成フラグ' ,
                'dataint06' => '0404請求残高更新フェーズ' ,
                'dataint07' => '0404指定納品書作成フラグ' ,
                'dataint08' => '0404請求書メール送信フラグ' ,
                'dataint09' => '0404請求書PDFダウンロードフラグ',
            ];
        $dataint_dropdown = array();

        foreach($color_array as $dataint=>$color)
        {
            $query = DB::table('request')
                ->whereRaw('color=\''.$color.'\'')
                ->selectRaw("syouhinbango, CONCAT(syouhinbango,' ',jouhou) as flag")
                ->toSql();
            $temp_array = QueryHelper::fetchResult($query);
            foreach($temp_array as $temp)
            {
                $dataint_dropdown[$dataint][$temp->syouhinbango] = $temp->flag;
            }
        }
        $table_name = "syukkoold";

        $deleted_item = 0;
        //first part data
        $query = SalesInquiryFirstPart::data($bango, $deleted_item,$kokyakuorderbango,$ordertypebango2)->toSql();
        $salesInquiryFirstPart = QueryHelper::fetchResult($query);

        //dd($salesInquiryFirstPart);
        //second part data
        $query1 = allSalesInquiry::data($bango, $deleted_item,$kokyakuorderbango,$ordertypebango2,$table_name)->toSql();
        $salesInquiryInfo = QueryHelper::fetchResult($query1);
        return view('sales.salesHistory.salesInquiry.mainSalesInquiry',compact('bango','tantousya','salesInquiryInfo','salesInquiryFirstPart','privileged_user','category_dropdown','housoukubun_dropdown','dataint_dropdown'));
    }

    public function updateSalesInquiry(Request $request)
    {
        //$id = intval(request('userId'));
        $id = request('userId');
        $bango = request('userId');
        $date = date("Y-m-d h:i:s");
        $date_formatted = str_replace(" ","",str_replace(":","",str_replace("-","",$date)));
        $tantousya = tantousya::find($id);
        
        //start log query
        $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 売上履歴一覧・売上照会 start\n";
        QueryHandler::logger($id,$log_data);

        $conn = pg_connect("host=".env("DB_HOST")." port=".env("DB_PORT")."  dbname=".env("DB_DATABASE")." user=".env("DB_USERNAME")." password=".env("DB_PASSWORD"));
        pg_query($conn,"BEGIN");
        try{
            $tmp_kokyakuorderbango = request('kokyakuorderbango');
            $tmp_housoukubun = request('update_housoukubun');
            $tmp_kessaihouhou = request('update_kessaihouhou');
            //$tmp_dataint01 = $value_array['dataint01_val'];
            //$tmp_intorder05 = str_replace("/","",$value_array['intorder05']);
            $orderhenkanData = QueryHelper::fetchSingleResult("
                select bango,kokyakuorderbango,ordertypebango2,intorder05,datachar10,tuhanorder.housoukubun,tuhanorder.kessaihouhou 
                from orderhenkan 
                join tuhanorder on tuhanorder.orderbango = orderhenkan.bango
                where kokyakuorderbango = '$tmp_kokyakuorderbango' 
                and datachar10 is not null 
                order by ordertypebango2 desc LIMIT 1");

            if($orderhenkanData && ($orderhenkanData->housoukubun != $tmp_housoukubun || $orderhenkanData->kessaihouhou != $tmp_kessaihouhou)){
                $current_date = Carbon::now()->format('Y-m-d H:i:s');
                $tmp_ordertypebango2 = $orderhenkanData->ordertypebango2 + 1;
                $max_bango = QueryHelper::fetchSingleResult("select max(bango) as max_bango from orderhenkan")->max_bango + 1;
                //orderhenkan starts
                QueryHelper::runQuery("CREATE TEMPORARY TABLE sales_history_temp_orderhenkan as
                SELECT * FROM orderhenkan 
                WHERE kokyakuorderbango = '$orderhenkanData->kokyakuorderbango'
                AND ordertypebango2 = $orderhenkanData->ordertypebango2
                AND datachar10 = '$orderhenkanData->datachar10'
                ");
                QueryHelper::runQuery("UPDATE sales_history_temp_orderhenkan SET 
                    bango = $max_bango, 
                    ordertypebango2 = $tmp_ordertypebango2, 
                    date = '$current_date',
                    orderuserbango = $id
                    ");
                $orderhenkan_insert_data = QueryHelper::runQuery("INSERT INTO orderhenkan SELECT * FROM sales_history_temp_orderhenkan");
                QueryHelper::runQuery("DROP TABLE IF EXISTS sales_history_temp_orderhenkan");
                //orderhenkan ends

                //tuhanorder starts
                QueryHelper::runQuery("CREATE TEMPORARY TABLE sales_history_temp_tuhanorder as
                SELECT * FROM tuhanorder 
                WHERE orderbango = '$orderhenkanData->bango'
                ");
                $data = QueryHelper::fetchSingleResult("select orderbango,text5 from sales_history_temp_tuhanorder");
                if($data->text5 != null){
                    $text5 = $data->text5;
                    $text5[0] = "2";           
                }else{
                    $text5 = null;
                }
                //$otodokedate = '$date',
                QueryHelper::runQuery("UPDATE sales_history_temp_tuhanorder SET 
                    orderbango = $max_bango, 
                    housoukubun = '$tmp_housoukubun', 
                    kessaihouhou = '$tmp_kessaihouhou', 
                    text5 = '$text5'
                    ");
                QueryHelper::runQuery("INSERT INTO tuhanorder SELECT * FROM sales_history_temp_tuhanorder");
                QueryHelper::runQuery("DROP TABLE IF EXISTS sales_history_temp_tuhanorder");
                //tuhanorder ends

                //hikiatesyukko starts
                QueryHelper::runQuery("CREATE TEMPORARY TABLE sales_history_temp_hikiatesyukko as
                SELECT * FROM hikiatesyukko 
                WHERE orderbango = '$orderhenkanData->bango'
                ");
                QueryHelper::runQuery("UPDATE sales_history_temp_hikiatesyukko SET 
                    orderbango = $max_bango, 
                    idoutanabango = '$date_formatted',
                    tantousyabango = $id
                    ");
                QueryHelper::runQuery("INSERT INTO hikiatesyukko SELECT * FROM sales_history_temp_hikiatesyukko");
                QueryHelper::runQuery("delete from hikiatesyukko where orderbango = '$orderhenkanData->bango'");
                QueryHelper::runQuery("DROP TABLE IF EXISTS sales_history_temp_hikiatesyukko");
                //hikiatesyukko ends

                //syukkoold starts
                QueryHelper::runQuery("CREATE TEMPORARY TABLE sales_history_temp_syukkoold as
                SELECT * FROM syukkoold 
                WHERE orderbango = '$orderhenkanData->bango'
                ");
                $syukkoold_data = QueryHelper::fetchSingleResult("select dataint01 from sales_history_temp_syukkoold");
                QueryHelper::runQuery("UPDATE sales_history_temp_syukkoold SET 
                    orderbango = $max_bango,
                    dataint01 = $syukkoold_data->dataint01+1,
                    tantousyabango = $id,
                    tanabango = $date_formatted
                    ");
                QueryHelper::runQuery("INSERT INTO syukkoold SELECT * FROM sales_history_temp_syukkoold");
                QueryHelper::runQuery("delete from syukkoold where orderbango = '$orderhenkanData->bango'");
                QueryHelper::runQuery("DROP TABLE IF EXISTS sales_history_temp_syukkoold");
                //syukkoold ends
                
                //create history details => CreateOrderDetails::data($bango,$kokyakuorderbango, $ordertypebango2,$datachar01)
                $tmp_kokyakuorderbango = $orderhenkanData->kokyakuorderbango;
                $datachar10 = $orderhenkanData->datachar10;
                $bango = $id;
                CreateOrderDetails::data($bango,$tmp_kokyakuorderbango, $tmp_ordertypebango2,2,'04-04-02','sales_data',$datachar10);

                
                //============== create order data starts ===================
                $orderhenkanInfo = QueryHelper::fetchSingleResult("
                    select 
                    orderhenkan.* 
                    from (select max(ordertypebango2) as max_ordertypebango2,kokyakuorderbango from orderhenkan WHERE kokyakuorderbango = '$orderhenkanData->kokyakuorderbango' AND datachar10 is null group by kokyakuorderbango) as tmp_orderhenkan
                    join orderhenkan on orderhenkan.kokyakuorderbango = tmp_orderhenkan.kokyakuorderbango
                    AND orderhenkan.ordertypebango2 = tmp_orderhenkan.max_ordertypebango2
                    ");
                $orderhenkan_insert_data = collect($orderhenkanInfo)->toArray();
                unset($orderhenkan_insert_data['bango']);
                $orderhenkan_insert_data['ordertypebango2'] = $orderhenkan_insert_data['ordertypebango2'] + 1;
                $orderhenkan_insert_data['datachar01'] = 2;
                $orderhenkan_insert_data['date'] = $current_date;
                $orderhenkan_insert_data['orderuserbango'] = $id;
                $orderhenkan = QueryHelper::insertData('orderhenkan',$orderhenkan_insert_data,'bango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);

                //tuhanorder starts
                $tuhanorderInfo = QueryHelper::fetchSingleResult("
                    SELECT * FROM tuhanorder 
                    WHERE orderbango = '$orderhenkanInfo->bango'
                    ");
                $tuhanorder_insert_data = collect($tuhanorderInfo)->toArray();
                unset($tuhanorder_insert_data['orderbango']);
                $tuhanorder_insert_data['orderbango'] = $orderhenkan->bango;
                $tuhanorder = QueryHelper::insertData('tuhanorder',$tuhanorder_insert_data,'orderbango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);

                //hikiatesyukko starts
                $hikiatesyukkoInfo = QueryHelper::fetchSingleResult("
                    SELECT * FROM hikiatesyukko 
                    WHERE orderbango = '$orderhenkanInfo->bango'
                    ");
                $hikiatesyukko_insert_data = collect($hikiatesyukkoInfo)->toArray();
                unset($hikiatesyukko_insert_data['orderbango']);
                $hikiatesyukko_insert_data['idoutanabango'] = $date_formatted;
                $hikiatesyukko_insert_data['tantousyabango'] = $bango;
                $hikiatesyukko_insert_data['orderbango'] = $orderhenkan->bango;
                $hikiatesyukko = QueryHelper::insertData('hikiatesyukko',$hikiatesyukko_insert_data,'orderbango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);

                //misyukko starts
                $misyukkoInfo = QueryHelper::fetchResult("
                    SELECT * FROM misyukko 
                    WHERE orderbango = '$orderhenkanInfo->bango'
                    ");
                foreach($misyukkoInfo as $tmp_key=>$tmp_val){
                    $misyukko_insert_data = collect($tmp_val)->toArray();
                    unset($misyukko_insert_data['orderbango']);
                    $misyukko_insert_data['orderbango'] = $orderhenkan->bango;
                    $misyukko_insert_data['dataint01'] = $orderhenkan->ordertypebango2;
                    $misyukko_insert_data['tanabango'] = $date_formatted;
                    $misyukko_insert_data['tantousyabango'] = $id;
                    $misyukko = QueryHelper::insertData('misyukko',$misyukko_insert_data,'orderbango',true,$bango,__CLASS__,__FUNCTION__,__LINE__);
                }

                //create history details => CreateOrderDetails::data($bango,$kokyakuorderbango, $ordertypebango2,$datachar01)
                CreateOrderDetails::data($bango,$orderhenkanData->kokyakuorderbango, 0,1,'04-04');
                //============== create order data ends ===================
                
                //$status_msg = "売上番号".request('kokyakuorderbango')."を更新しました。";
                $status_msg = "登録しました。";
                Session::flash('status_msg',$status_msg);

                //return 'ok';
            }else{
                $where_array = ['orderbango'=>request('orderbango')];
                $update_array =
                    [
                        'housoukubun' => request('update_housoukubun'),
                        'kessaihouhou' => request('update_kessaihouhou'),
                        'otodokedate' => $date,
                    ];
                $dataUpdate = QueryHelper::updateData('tuhanorder',$update_array,$where_array,$id, __CLASS__, __FUNCTION__, __LINE__);

                $where_array = ['bango'=>request('orderbango')];
                $update_array =
                    [
                        'date' => $date,
                        'orderuserbango' => $id,
                    ];
                QueryHelper::updateData('orderhenkan',$update_array,$where_array,$id, __CLASS__, __FUNCTION__, __LINE__);

                $status_msg = "売上番号".request('kokyakuorderbango')."を更新しました。";
                Session::flash('status_msg',$status_msg);

            }
            //end log query
            $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 売上履歴一覧・売上照会 end\n";
            QueryHandler::logger($id,$log_data);
            pg_query($conn,mb_convert_encoding("COMMIT", "CP51932"));
            return 'ok';
            
        } catch (\Exception $e) {
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
            QueryHandler::logger($id, $log_data);
            pg_query($conn,mb_convert_encoding("ROLLBACK", "CP51932"));
            $result['status'] = "ng";
            return $result;
        }
        
    }
}
