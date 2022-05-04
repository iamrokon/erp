<?php

namespace App\Http\Controllers\sales;
use App\AllClass\master\nameMaster\allCategorykanri;
use Illuminate\Http\Request;
use App\tantousya;
use App\kengen;
use App\requestTable;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\sales\billingBalanceList\billingBalanceListHeaders;
use App\AllClass\sales\billingBalanceList\validateBillingBalanceList;
use App\AllClass\sales\billingBalanceList\AllBillingBalanceList;
use App\AllClass\order\orderEntry\searchCompany2;
use App\AllClass\order\orderEntry\searchCompany4;
use App\AllClass\ButtonMsg;
use Illuminate\Pagination\Paginator;
use App\AllClass\master\excelDownload;
use App\kokyaku1;
use App\AllClass\TableSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Excel;
use App\AllClass\master\ExcelReportDownload;
use Carbon\Carbon;
use App\AllClass\master\CSVLogger;
use App\AllClass\newExcelExport;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;

class BillingBalanceListController extends Controller
{
    private $headers = [
        '売上請求先CD' => 'datatxt201',
        '売上請求先' => 'formatted_data202',
        '前回請求額' => 'formatted_data203',
        '現金入金額' => 'formatted_data204',
        '手形入金' => 'formatted_data205',
        '今回値引他' => 'formatted_data206',
        '今回繰越額' => 'formatted_data207',
        '今回売上額' => 'formatted_data208',
        '今回消費税' => 'formatted_data209',
        '今回請求額' => 'formatted_data210',
        '即時請求額' => 'formatted_data211',
        '即時請求税' => 'formatted_data212',
        '請求書PDF' => 'data251',
        '前受前回請求額' => 'formatted_data252',
        '前受現金入金額' => 'formatted_data253',
        '前受手形入金' => 'formatted_data254',
        '前受今回値引他' => 'formatted_data255',
        '前受今回繰越額' => 'formatted_data256',         
        '前受今回売上額' => 'formatted_data257',
        '前受今回消費税' => 'formatted_data258',
        '前受即時請求額' => 'formatted_data259',
        '前受即時請求税' => 'formatted_data260',
        '登録年月日' => 'formatted_data261',
        '登録時刻' => 'formatted_data262',
        '更新年月日' => 'formatted_data263',
        '更新時刻' => 'formatted_data264',
        '更新者' => 'formatted_data265', 
];

    public function postBillingBalanceList(Request $request)
    {
        $bango = request('userId');

        //check validation for first search
        if($request->ajax()){
            $validator = validateBillingBalanceList::validate($request,$bango);
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

        $tantousya = tantousya::find($bango);

        $query = DB::table('categorykanri')
        ->whereRaw('category1=\'A8\'')
        ->selectRaw("*")
        ->orderByRaw('suchi1')
        ->toSql();

        $categorykanri = QueryHelper::fetchResult($query);

        $buttonMessage = ButtonMsg::read($bango);

        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 20;
        }

        $default_content_setumei = $bango;
        $check_tan = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango'")->where("mail4 = 'C310'")->get()->execute();

        //review data
        $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7501'");
        $review_orderbango = $reviewData->orderbango;
        
        //get tantousya data
        $datachar05 = QueryHelper::fetchResult("select * from tantousya where deleteflag = 0 and ztanka='$review_orderbango' and innerlevel >= 10 and innerlevel <= 20 order by bango");

        if (!empty($data_from_view['chkboxinp'])) {
            $deleted_item = $data_from_view['chkboxinp'];
        } else {
            $deleted_item = 0;
        }

        $headers = billingBalanceListHeaders::headers($bango);
        $table_headers = billingBalanceListHeaders::headers($bango, 'table_headers');
        $page_no = billingBalanceListHeaders::$page_no;
        $route = 'billingBalanceListTableSetting';
        $redirect_path = 'billingBalanceListReload'; 
       
        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $bango)->where('kengenchar05', '04-06')->get()->count();
        if($initial_header == 0){
            unset($headers['請求書PDF']);
            unset($headers['前受前回請求額']);
            unset($headers['前受現金入金額']);
            unset($headers['前受手形入金']);
            unset($headers['前受今回値引他']);          
            unset($headers['前受今回繰越額']);
            unset($headers['前受今回売上額']);
            unset($headers['前受今回消費税']);
            unset($headers['前受即時請求額']);
            unset($headers['前受即時請求税']);
            unset($headers['登録年月日']);
            unset($headers['登録時刻']);
            unset($headers['更新年月日']);
            unset($headers['更新時刻']);
            unset($headers['更新者']);
        }
        
        $temp_table = 'billing_balance_list_temp_final';

        //show page start here
        if (isset($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh')) {
            $fsRemoveKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp'];
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp','categorykanri','print_date','sales_Billing_From','sales_Billing_From_db','sales_Billing_To','sales_Billing_To_db'];

            try {
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh') {
                    //clear bottom search request data
                    if($data_from_view['Button'] == 'refresh'){
                        $data_from_view = self::clearBottomReqData($data_from_view);
                    }
                    
                    //default req data
                    $default_data =  $data_from_view;

                    //formatted first search data
                    $defalut_check = 0;
                    $req_data = $this->removeDataFromView($data_from_view, $fsRemoveKeys);
                    foreach ($req_data as $key => $value) {
                        if (strpos($key, 'ReqVal') !== false) {
                            $defalut_check++;
                            $new_key = str_replace('ReqVal', '', $key);
                            if (array_key_exists($new_key,$req_data)){ //when pagination change
                                $req_data[$new_key] = $req_data[$new_key];
                            }else{
                                $req_data[$new_key] = $value;
                            }
                            unset($req_data[$key]);
                        }
                    }
                    
                    //remove comma from formatted value
                    $str_to_int = ['data204', 'formatted_data204'];
                    foreach ($data_from_view as $key => $value) {
                        if (in_array($key, $str_to_int)) {
                            $data_from_view[$key] = str_replace(',', '', $data_from_view[$key]);
                        }
                    }

                    $data = $this->removeDataFromView($data_from_view, $removeKeys);

                    //first search req data
                    $fsReqData = [];
                    $bangos = [];
                   
                    foreach ($data as $key => $value) {
                        if (strpos($key, 'ReqVal') !== false) {
                            $temp_new_key = str_replace('ReqVal', '', $key);
                            if (array_key_exists($temp_new_key,$data)){ //when pagination change
                                $data[$temp_new_key] = $data[$temp_new_key];
                                $fsReqData[$temp_new_key] = $data[$temp_new_key];
                            }else{
                                $fsReqData[$temp_new_key] = $value;
                                $data[$temp_new_key] = $value;
                            }
                            unset($data[$key]);
                        }
                    }
                   
                    $data = $this->removeDataFromView($data, $removeKeys);

                    if($data_from_view['Button'] == 'FirstSearch'){
                        $fsReqData = $req_data; //fsReqData = first search request data
                    }     
                    
                    if(($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'refresh') && $defalut_check == 0){
                        $pagi = 20;
                        return view('sales.billingBalanceList.mainBillingBalanceList', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'pagi', 'deleted_item', 'buttonMessage','categorykanri','datachar05'));
                    }

                    $query = AllBillingBalanceList::data($bango,$req_data)->toSql();
                    $billingBalanceListInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    $billingBalanceListInfo2 = $this->searchDataFetch($query, $data, $bango, $temp_table);
                    if ($billingBalanceListInfo->items() == null && $billingBalanceListInfo->currentPage() != 1) {
                        $currentPage = ($billingBalanceListInfo->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $billingBalanceListInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                        $billingBalanceListInfo2 = $this->searchDataFetch($query, $data, $bango, $temp_table);
                    }
                    //dd($billingBalanceListInfo);
                    if ($billingBalanceListInfo->total() == 0) {
                        $exceedUser = '該当するデータがありません。';
                    } else {
                        $exceedUser = '';
                    }

                    //export excel
                    if ($data_from_view['Button'] == 'xls') {
                        $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                        $headers = $this->headers;
                        $excelName = '請求残高一覧.xlsx';
                        //return newExcelExport::download($searched,$headers, $excelName);
                        return $this->excelDownload($headers, $searched, $excelName);
                    }


                }
            } catch (\Exception $e) {
                $exceedUser = '検索形式が間違っています。';
                //$orderHistoryInfo = QueryHelper::fetchResult($query);
                $billingBalanceListInfo = collect();
                // $order_amount  = $billingBalanceListInfo->sum('money10');
                // $gross_profit  = $billingBalanceListInfo->sum('moneymax');
                $billingBalanceListInfo = $billingBalanceListInfo->paginate($pagination);

                return view('sales.billingBalanceList.mainBillingBalanceList', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'billingBalanceListInfo', 'tantousya', 'deleted_item','exceedUser', 'buttonMessage','categorykanri','sales_Billing_From','sales_Billing_From_db','sales_Billing_To','sales_Billing_To_db','datachar05','fsReqData'));
            }

            $formatted_total203  = $billingBalanceListInfo2->sum('data203');
            $formatted_total204  = $billingBalanceListInfo2->sum('data204');
            $formatted_total205  = $billingBalanceListInfo2->sum('data205');
            $formatted_total206  = $billingBalanceListInfo2->sum('data206');
            $formatted_total207  = $billingBalanceListInfo2->sum('data207');
            $formatted_total208  = $billingBalanceListInfo2->sum('data208');
            $formatted_total209  = $billingBalanceListInfo2->sum('data209');
            $formatted_total210  = $billingBalanceListInfo2->sum('data210');
            $formatted_total211  = $billingBalanceListInfo2->sum('data211');
            $formatted_total212  = $billingBalanceListInfo2->sum('data212');
            $formatted_total252  = $billingBalanceListInfo2->sum('data252');
            $formatted_total253  = $billingBalanceListInfo2->sum('data253');
            $formatted_total254  = $billingBalanceListInfo2->sum('data254');
            $formatted_total255  = $billingBalanceListInfo2->sum('data255');
            $formatted_total256  = $billingBalanceListInfo2->sum('data256');
            $formatted_total257  = $billingBalanceListInfo2->sum('data257');
            $formatted_total258  = $billingBalanceListInfo2->sum('data258');
            $formatted_total259  = $billingBalanceListInfo2->sum('data259');
            $formatted_total260  = $billingBalanceListInfo2->sum('data260');

            return view('sales.billingBalanceList.mainBillingBalanceList', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'billingBalanceListInfo', 'tantousya', 'deleted_item','exceedUser', 'buttonMessage','categorykanri','datachar05','req_data','fsReqData','formatted_total203','formatted_total204','formatted_total205','formatted_total206','formatted_total207','formatted_total208','formatted_total209','formatted_total210','formatted_total211','formatted_total212','formatted_total252','formatted_total253','formatted_total254','formatted_total255','formatted_total256','formatted_total257','formatted_total258','formatted_total259','formatted_total260'));
        }

        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;

        session()->forget('oldInput' . $bango);
        //return view('order.orderHistory.mainOrderHistory', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'orderHistoryInfo', 'tantousya', 'pagi', 'deleted_item', 'buttonMessage','B9Data_left','B9Data_right','C1Data_left','C1Data_right','C2Data_left','C2Data_right','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','datachar05','order_amount','gross_profit'));
        return view('sales.billingBalanceList.mainBillingBalanceList', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'pagi', 'deleted_item', 'buttonMessage','categorykanri','datachar05'));
    }


    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $id)->where('kengenchar05', '04-06')->get()->count();
        $pageNo = billingBalanceListHeaders::$page_no;
        //return $Setting = TableSetting::setting($this->headers, $id, $pageNo);
        $Setting = TableSetting::setting($this->headers, $id, $pageNo);

        if($initial_header == 0){
            $Setting['data251'] = "";
            $Setting['formatted_data252'] = "";
            $Setting['formatted_data253'] = "";
            $Setting['formatted_data254'] = "";
            $Setting['formatted_data255'] = "";
            $Setting['formatted_data256'] = "";
            $Setting['formatted_data257'] = "";
            $Setting['formatted_data258'] = "";
            $Setting['formatted_data259'] = "";
            $Setting['formatted_data260'] = "";
            $Setting['formatted_data261'] = "";
            $Setting['formatted_data262'] = "";
            $Setting['formatted_data263'] = "";
            $Setting['formatted_data264'] = "";
            $Setting['formatted_data265'] = "";
        }
        return $Setting;
    }
    public function tableSettingSave(Request $request, $id, $type = null)
    {
        $pageNo = billingBalanceListHeaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '請求残高一覧', $type);
    }


    public function ApiReadCompanyDetail(Request $request, $id, $num){
        $companyData = QueryHelper::fetchSingleResult("select * from kokyaku1 where bango = '$num' and denpyosaiban = 0");
        $companyData = json_decode(json_encode($companyData),true);

        $array = [];
        foreach ($companyData as $key => $value) {
            $array[$key] = $value;
        }

        return $array;
    }

    public function clearBottomReqData($request_data){
        $headers = [
            '売上請求先CD' => 'datatxt201',
            '売上請求先' => 'data202',
            '前回請求額' => 'data203',
            '現金入金額' => 'data204',
            '手形入金' => 'data205',
            '今回値引他' => 'data206',
            '今回繰越額' => 'data207',
            '今回売上額' => 'data208',
            '今回消費税' => 'data209',
            '今回請求額' => 'data210',
            '即時請求額' => 'data211',
            '即時請求税' => 'data212',
            '請求書PDF' => 'data251',
            '前受前回請求額' => 'data252',
            '前受現金入金額' => 'data253',
            '前受手形入金' => 'data254',
            '前受今回値引他' => 'data255',
            '前受今回繰越額' => 'data256',         
            '前受今回売上額' => 'data257',
            '前受今回消費税' => 'data258',
            '前受即時請求額' => 'data259',
            '前受即時請求税' => 'data260',
            '登録年月日' => 'data261',
            '登録時刻' => 'data262',
            '更新年月日' => 'data263',
            '更新時刻' => 'data264',
            '更新者' => 'data265', 
    ];
        foreach($request_data as $key=>$val){
            if (in_array($key, $headers)){
                $request_data[$key] = null;
            }
        }
        return $request_data;
    }

}
