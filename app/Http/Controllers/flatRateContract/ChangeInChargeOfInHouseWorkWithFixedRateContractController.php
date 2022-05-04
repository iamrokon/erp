<?php


namespace App\Http\Controllers\flatRateContract;

use App\AllClass\ButtonMsg;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\flatRateContract\ChangeInChargeOfInHouseWorkWithFixedRateContracts\AllChangeInChargeOfInHouseWorkWithFixedRateContract; 
use App\AllClass\flatRateContract\ChangeInChargeOfInHouseWorkWithFixedRateContracts\ChangeInChargeOfInHouseWorkWithFixedRateContract;
use App\AllClass\TableSetting;
use App\Http\Controllers\Controller;
use App\kengen;
use App\tantousya;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use Session;

class ChangeInChargeOfInHouseWorkWithFixedRateContractController extends Controller
{
    public $headers = [
        '契約担当' => 'formatted_contractor',
        '定期定額契約番号' => 'contract_number',
        '契約回数' => 'formatted_no_of_contracts',
        '売上先' => 'formatted_sales_destination_r17',
        '受注先' => 'formatted_contractor_r17',
        '最終顧客' => 'formatted_end_customer_r17',
        '新担当' => 'formatted_new_charge',
        '契約金額' => 'formatted_contract_amount',
        '商品名' => 'product_name',
        '伝票備考' => 'voucher_remarks',
        '定期サブスク区分' => 'formatted_regular_subscription_classification',
        '元受注番号' => 'order_number',
        '元受注行番号' => 'order_line_number',
        '元受注行番号枝番' => 'order_branch_number',
        '社内備考' => 'in_house_remarks',
        '有償開始日' => 'paid_start_date',
        '有償終了日' => 'paid_end_date',
        '契約金額消費税' => 'formatted_consumption_tax',
        '伝票統合' => 'slip_integration',
        '発注出荷指示備考' => 'order_shipping_instructions_remarks',
        'プロジェクト番号' => 'project_number',
        '契約指示・検印フェーズ' => 'stamping_phase',
        '自動継続フラグ' => 'auto_continuation_flag',
        '自動売上フラグ' => 'auto_sales_flag',
        '請求済フラグ' => 'billed_flag',
        '支払済フラグ' => 'paid_flag',
        '訂正フラグ' => 'correction_flag',
        '登録年月日・時刻' => 'registration_date_time',
        '更新年月日・時刻' => 'update_date_time',
        '更新者' => 'formatted_updater',
        '契約状態' => 'formatted_contract_status',
        '契約期間開始日' => 'contract_period_start_date',
        '契約期間終了日' => 'contract_period_end_date',
    ];
    public function index(Request $request)
    {
        $bango = request('userId');
        if ($request->ajax()) {
            $validator = ChangeInChargeOfInHouseWorkWithFixedRateContract::validate($request, $bango);
            $errors = $validator->errors();
            if ($errors->any()) {
                $err_msg = $errors->all();
                return ['err_field' => $errors, 'err_msg' => $err_msg];
            } else {
                return 'ok';
            }
        }
        $buttonMessage = ButtonMsg::read($bango);
        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 20;
        }
        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $headers = ChangeInChargeOfInHouseWorkWithFixedRateContract::headers($bango);
        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $bango)->where('kengenchar05', '0306')->get()->count();
        if($initial_header == 0){
            unset($headers['定期サブスク区分']); 
            unset($headers['元受注番号']); 
            unset($headers['元受注行番号']); 
            unset($headers['元受注行番号枝番']); 
            unset($headers['社内備考']); 
            unset($headers['有償開始日']); 
            unset($headers['有償終了日']); 
            unset($headers['契約金額消費税']); 
            unset($headers['伝票統合']); 
            unset($headers['発注出荷指示備考']); 
            unset($headers['プロジェクト番号']); 
            unset($headers['契約指示・検印フェーズ']); 
            unset($headers['自動継続フラグ']); 
            unset($headers['自動売上フラグ']); 
            unset($headers['請求済フラグ']); 
            unset($headers['支払済フラグ']); 
            unset($headers['訂正フラグ']); 
            unset($headers['登録年月日・時刻']); 
            unset($headers['更新年月日・時刻']); 
            unset($headers['更新者']); 
            unset($headers['契約状態']); 
            unset($headers['契約期間開始日']); 
            unset($headers['契約期間終了日']); 
        }
        
        $table_headers = ChangeInChargeOfInHouseWorkWithFixedRateContract::headers($bango, 'table_headers');
        $page_no = ChangeInChargeOfInHouseWorkWithFixedRateContract::$pageNo;
        $route = 'changeInchargeOfInHouseWorkWithFixedRateContractTableSetting';
        $redirect_path = 'changeInchargeOfInHouseWorkWithFixedRateContractReload';
        $temp_table = 'all_change_incharge_of_in_house_work_with_fixed_rate_contract_temp';
        
        $incharges = QueryHelper::fetchResult("select * from tantousya where mail4='C320' order by bango");
        $data_from_view = $request->all();
        session()->put('oldInput' . $bango, $data_from_view);
        if (isset($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh')) {
            $fsRemoveKeys = ['page', 'Button', 'pagination', '_token', 'userId',];
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId','selected_new_charge','up_support_number','prev_new_charge','contractor_text','contractor_text_db', 'billing_address_text', 'billing_address_text_db','end_customer_text','end_customer_text_db','incharge','myAnchor'];

            try {
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh') {
                    //clear bottom search request data
                    if ($data_from_view['Button'] == 'refresh') {
                        $data_from_view = self::clearBottomReqData($data_from_view);
                    }

                    //default req data
                    $default_data =  $data_from_view;

                    //check number format
                    $formatted_fields = ['contract_amount', 'contract_months', 'free_period', 'billing_cycle', 'quantity', 'unit_price', 'consumption_tax', 'gross_operating_profit', 'se_gross_profit', 'lab_gross_profit', 'sc_gross_profit', 'purchase_amount'];
                    foreach ($data_from_view as $key => $value) {
                        if (in_array($key, $formatted_fields) && preg_match('/,/', $value) == false) {
                            $data_from_view[$key] = $data_from_view[$key] == "" ? null : $data_from_view[$key];
                        }
                    }

                    //formatted first search data
                    $defalut_check = 0;
                    $req_data = $this->removeDataFromView($data_from_view, $fsRemoveKeys);
                    foreach ($req_data as $key => $value) {
                        if (strpos($key, 'ReqVal') !== false) {
                            $defalut_check++;
                            $req_data[str_replace('ReqVal', '', $key)] = $value;
                            unset($req_data[$key]);
                        }
                    }

                    $data = $this->removeDataFromView($data_from_view, $removeKeys);

                    //check first search or default search
                    //if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort') {
                    //    $default_req_data = $default_data;
                    //} else {
                    //    $default_req_data = "";
                    //}

                    //first search req data
                    $fsReqData = [];
                    $bangos = [];
                    foreach ($data as $key => $value) {
                        if (strpos($key, 'ReqVal') !== false) {
                            $fsReqData[str_replace('ReqVal', '', $key)] = $value;
                            $data[str_replace('ReqVal', '', $key)] = $value;
                            unset($data[$key]);
                        }
                    }
                    $data = $this->removeDataFromView($data, $removeKeys);
                    
                    if($data_from_view['Button'] == 'FirstSearch'){
                        $fsReqData = $req_data; //fsReqData = first search request data
                    }

                    //to search full text
                    //                    if(isset($data['user_name_search'])){
                    //                        $data['user_name_search'] = str_replace('　','',str_replace(' ','',$data['user_name_search']));
                    //                    }
                    //                    if(isset($data['datachar02_tan_name_search'])){
                    //                        $data['datachar02_tan_name_search'] = str_replace('　','',str_replace(' ','',$data['datachar02_tan_name_search']));
                    //                    }
                    //                    if(isset($data['datachar03_tan_name_search'])){
                    //                        $data['datachar03_tan_name_search'] = str_replace('　','',str_replace(' ','',$data['datachar03_tan_name_search']));
                    //                    }
                    //                    if(isset($data['datachar05_tan_name_search'])){
                    //                        $data['datachar05_tan_name_search'] = str_replace('　','',str_replace(' ','',$data['datachar05_tan_name_search']));
                    //                    }
                    //                    if(isset($data['datachar07_tan_name_search'])){
                    //                        $data['datachar07_tan_name_search'] = str_replace('　','',str_replace(' ','',$data['datachar07_tan_name_search']));
                    //                    }

                    //first search bangos
                    //$first_search_res = "";
                    //if (!empty($fsReqData)) {
                    //    $search_removeKeys = ['division_datachar05_start', 'division_datachar05_end', 'department_datachar05_start', 'department_datachar05_end', 'group_datachar05_start', 'group_datachar05_end', 'datachar05', 'creation_category', 'contractor_text', 'billing_address_text', 'end_customer_text'];
                    //    $reqData = $this->removeDataFromView($fsReqData, $search_removeKeys);
                    //    $query = AllChangeInchargeOfFixedRateContract::data($bango, $bangos, $fsReqData)->toSql();
                    //    $allChangeInchargeOfFixedRateContract = $this->searchDataFetch($query, $reqData, $bango, $temp_table);
                    //    foreach ($allChangeInchargeOfFixedRateContract as $key => $val) {
                    //        foreach ($val as $k => $v) {
                    //            if ($k == "bango") {
                    //                array_push($bangos, $v);
                    //            }
                    //        }
                    //    }
                    //    if (count($bangos) < 1) {
                    //        $first_search_res = "no_data";
                    //    }
                    //} else if (($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort') && empty($fsReqData)) {
                    //    $pagi = 20;
                    //    return view('flatRateContract.changeInchargeOfInHouseWorkWithFixedRateContracts.mainChangeInchargeOfFixedRateContracts', compact('bango', 'tantousya', 'B9Data_left', 'C1Data_left', 'C2Data_left', 'B9Data_right', 'C1Data_right', 'C2Data_right', 'incharges', 'personal_datatxt0003', 'personal_datatxt0004', 'personal_datatxt0005', 'data_from_view', 'buttonMessage', 'headers', 'table_headers', 'redirect_path', 'page_no', 'route', 'pagi'));
                    //}
                    
                    if(($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'refresh') && $defalut_check == 0){
                        $pagi = 20;
                        return view('flatRateContract.changeInchargeOfInHouseWorkWithFixedRateContracts.mainChangeInchargeOfFixedRateContracts', compact('bango', 'tantousya', 'pagi', 'incharges','data_from_view', 'buttonMessage',  'headers', 'table_headers', 'redirect_path', 'page_no', 'route'));
                    }

                    $query = AllChangeInChargeOfInHouseWorkWithFixedRateContract::data($bango, $req_data)->toSql();
                    //dd($query,$data);
                    $allChangeInChargeOfInHouseWorkWithFixedRateContract = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    if ($allChangeInChargeOfInHouseWorkWithFixedRateContract->items() == null && $allChangeInChargeOfInHouseWorkWithFixedRateContract->currentPage() != 1) {
                        $currentPage = ($allChangeInChargeOfInHouseWorkWithFixedRateContract->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $allChangeInChargeOfInHouseWorkWithFixedRateContract = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    }
                   // dd($allChangeInchargeOfFixedRateContract);
                    if ($allChangeInChargeOfInHouseWorkWithFixedRateContract->total() == 0) {
                        $exceedChangeInChargeOfInHouseWorkWithFixedRateContract = '該当するデータがありません。';
                    } else {
                        $exceedChangeInChargeOfInHouseWorkWithFixedRateContract = '';
                    }

                    if ($data_from_view['Button'] == 'FirstSearch') {
                        $fsReqData = $req_data; //fsReqData=first search request data
                    }

                    //export excel
                    if ($data_from_view['Button'] == 'xls') {
                        $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                        $headers = $this->headers;
                        $excelName = '定期定額契約内作担当変更.xlsx';
                        return $this->excelDownload($headers, $searched, $excelName);
                    }
                }
           } catch (\Exception $e) {
               $exceedChangeInChargeOfInHouseWorkWithFixedRateContract = '検索形式が間違っています。';
               $allChangeInChargeOfInHouseWorkWithFixedRateContract = [];
               $allChangeInChargeOfInHouseWorkWithFixedRateContract = collect($allChangeInChargeOfInHouseWorkWithFixedRateContract);
               $allChangeInChargeOfInHouseWorkWithFixedRateContract = $allChangeInChargeOfInHouseWorkWithFixedRateContract->paginate($pagination);

               return view('flatRateContract.changeInchargeOfInHouseWorkWithFixedRateContracts.mainChangeInchargeOfFixedRateContracts', compact('bango', 'tantousya', 'incharges', 'data_from_view', 'buttonMessage',  'headers', 'table_headers', 'redirect_path', 'page_no', 'route', 'fsReqData', 'allChangeInChargeOfInHouseWorkWithFixedRateContract', 'exceedChangeInChargeOfInHouseWorkWithFixedRateContract'));;
           }
 
            return view('flatRateContract.changeInchargeOfInHouseWorkWithFixedRateContracts.mainChangeInchargeOfFixedRateContracts', compact('bango', 'tantousya', 'incharges', 'data_from_view', 'buttonMessage',  'headers', 'table_headers', 'redirect_path', 'page_no', 'route', 'req_data', 'fsReqData', 'allChangeInChargeOfInHouseWorkWithFixedRateContract', 'exceedChangeInChargeOfInHouseWorkWithFixedRateContract'));
        }

        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;
        //        if (request('change_id')) {
        //            $query = AllChangeInChargeOfInHouseWorkWithFixedRateContract::data($bango, $deleted_item)->whereRaw("bango = '" . request('change_id') . "'")->toSql();
        //        } else {
        //            $query = AllChangeInChargeOfInHouseWorkWithFixedRateContract::data($bango, $deleted_item)->toSql();
        //        }
        session()->forget('oldInput' . $bango);
        return view('flatRateContract.changeInchargeOfInHouseWorkWithFixedRateContracts.mainChangeInchargeOfFixedRateContracts', compact('bango', 'tantousya', 'pagi', 'incharges', 'data_from_view', 'buttonMessage',  'headers', 'table_headers', 'redirect_path', 'page_no', 'route'));
    }

    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $id)->where('kengenchar05', '0306')->get()->count();
        $pageNo = ChangeInChargeOfInHouseWorkWithFixedRateContract::$pageNo;
        //return  TableSetting::setting($this->headers, $id, $pageNo);
        $Setting =  TableSetting::setting($this->headers, $id, $pageNo);
        if($initial_header == 0){
            $Setting['formatted_regular_subscription_classification'] = "";
            $Setting['order_number'] = "";
            $Setting['order_line_number'] = "";
            $Setting['order_branch_number'] = "";
            $Setting['in_house_remarks'] = "";
            $Setting['paid_start_date'] = "";
            $Setting['paid_end_date'] = "";
            $Setting['formatted_consumption_tax'] = "";
            $Setting['slip_integration'] = "";
            $Setting['order_shipping_instructions_remarks'] = "";
            $Setting['project_number'] = "";
            $Setting['stamping_phase'] = "";
            $Setting['auto_continuation_flag'] = "";
            $Setting['auto_sales_flag'] = "";
            $Setting['billed_flag'] = "";
            $Setting['paid_flag'] = "";
            $Setting['correction_flag'] = "";
            $Setting['registration_date_time'] = "";
            $Setting['update_date_time'] = "";
            $Setting['formatted_updater'] = "";
            $Setting['formatted_contract_status'] = "";
            $Setting['contract_period_start_date'] = "";
            $Setting['contract_period_end_date'] = "";
        }
        return $Setting;
    }

    public function tableSettingSave(Request $request, $id, $type = null)
    {

        $pageNo = ChangeInChargeOfInHouseWorkWithFixedRateContract::$pageNo;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '定期定額契約内作担当変更', $type);
    }

    public function clearBottomReqData($request_data)
    {
        $headers = [
            '契約担当' => 'formatted_contractor',
            '定期定額契約番号' => 'contract_number',
            '契約回数' => 'formatted_no_of_contracts',
            '売上先' => 'formatted_sales_destination_r17',
            '受注先' => 'formatted_contractor_r17',
            '最終顧客' => 'formatted_end_customer_r17',
            '新担当' => 'formatted_new_charge',
            '契約金額' => 'formatted_contract_amount',
            '商品名' => 'product_name',
            '伝票備考' => 'voucher_remarks',
            '定期サブスク区分' => 'formatted_regular_subscription_classification',
            '元受注番号' => 'order_number',
            '元受注行番号' => 'order_line_number',
            '元受注行番号枝番' => 'order_branch_number',
            '社内備考' => 'in_house_remarks',
            '有償開始日' => 'paid_start_date',
            '有償終了日' => 'paid_end_date',
            '契約金額消費税' => 'formatted_consumption_tax',
            '伝票統合' => 'slip_integration',
            '発注出荷指示備考' => 'order_shipping_instructions_remarks',
            'プロジェクト番号' => 'project_number',
            '契約指示・検印フェーズ' => 'stamping_phase',
            '自動継続フラグ' => 'auto_continuation_flag',
            '自動売上フラグ' => 'auto_sales_flag',
            '請求済フラグ' => 'billed_flag',
            '支払済フラグ' => 'paid_flag',
            '訂正フラグ' => 'correction_flag',
            '登録年月日・時刻' => 'registration_date_time',
            '更新年月日・時刻' => 'update_date_time',
            '更新者' => 'formatted_updater',
            '契約状態' => 'formatted_contract_status',
            '契約期間開始日' => 'contract_period_start_date',
            '契約期間終了日' => 'contract_period_end_date',
        ];
        foreach ($request_data as $key => $val) {
            if (in_array($key, $headers)) {
                $request_data[$key] = null;
            }
        }
        return $request_data;
    }

    public function updateChangeInchargeOfInHouseWorkWithFixedRateContract(Request $request){
    
       // dd($request->all());
        $bango = request('userId');
        $support_numbers = $request->up_support_number;
        $prev_new_charge = $request->prev_new_charge;
        $update_new_charge = $request->selected_new_charge;
        
        // list($status, $errors) = $this->validator($request);
        // // $errors = $validator->errors();
        // if($status){
        // //    $err_msg = $errors->all();
        //     return ['err_status'=>true,'errors'=>$errors];
        // }else if(!$status && request('submit_confirmation') == ""){
        //     return "confirmation_msg";

        if(request('submit_confirmation') == ""){
            return "confirmation_msg";
        }else{
            $cn = 0;
            foreach($support_numbers as $key=>$val){
                $prev = $prev_new_charge[$key];
                $update = $update_new_charge[$key];
                if($prev != $update){
                    $hanbaibukacd = $val;
                    $datatxt0110 = $val;

                    //update soukosyukko data
                    $soukosyukko_update_data = [
                            'hanbaibukacd'=> $hanbaibukacd,
                            'datachar02' => $update,
                        ];
                       // dd($syouhinid,$update);
                   $soukosyukkoUpdate = QueryHelper::updateData('soukosyukko', $soukosyukko_update_data, ['hanbaibukacd' => $hanbaibukacd], $bango, __CLASS__, __FUNCTION__, __LINE__);
                   

                     //update tuhanorder data
                    $tuhanorder_update_data = [
                        'datatxt0110' => $datatxt0110,
                        'datatxt0128' => $bango ,
                        'date0007' => Carbon::now()->format('Y-m-d H:i:s'),
                    ];

                    
                    $tuhanorderUpdate = QueryHelper::updateData('tuhanorder', $tuhanorder_update_data, ['datatxt0110' => $datatxt0110], $bango, __CLASS__, __FUNCTION__, __LINE__);
                    $cn++;
                }
            }
            if($cn && $cn > 0){
                $update_msg[] = "内作担当者を更新しました。";
                Session::flash('update_msg',$update_msg); 
            }
            return "ok";
        }
    }
    
    public function checkChangeInchargeOfInHouseWorkWithFixedRateContractUpdateData(Request $request){
        $login_bango = request('login_bango');
        $tantousya = QueryHelper::fetchResult("select * from tantousya where '$login_bango' in(datatxt0034,datatxt0035,datatxt0036) ");
        if($tantousya && count($tantousya) > 0){
           return "valid";  
        }else{
           return "not_valid";  
        }
    }
}
