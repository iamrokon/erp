<?php


namespace App\Http\Controllers\flatRateContract;

use App\AllClass\ButtonMsg;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\flatRateContract\FixedRateContracts\AllFixedRateContract;
use App\AllClass\flatRateContract\FixedRateContracts\FixedRateContract;
use App\AllClass\TableSetting;
use App\Http\Controllers\Controller;
use App\kengen;
use App\tantousya;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class FixedRateContractController extends Controller
{
    public $headers = [
        '契約状態' => 'contract_status',
        '担当' => 'in_charge',
        '契約番号' => 'contract_number',
        '商品名' => 'product_name',
        '売上請求先' => 'billing_address_r17',
        '受注先' => 'contractor_r17',
        '最終顧客' => 'end_customer_r17',
        '契約金額' => 'contract_amount',
        '契約開始日' => 'contract_start_date',
        '契約月数' => 'contract_months',
        '無償期間' => 'free_period',
        '請求サイクル' => 'billing_cycle',
        '請求月度' => 'billing_month',
        '自動継続' => 'automatic_continuation',
        '自動売上' => 'automatic_sales',
        '伝票統合' => 'voucher_integration',
        '入金方法' => 'payment_method',
        '契約回数' => 'number_of_contracts',
        '作成区分' => 'creation_category_temp',
        '定期サブスク区分' => 'subscription_classification',
        '元受注番号' => 'order_number',
        '元受注行番号' => 'line_number',
        '元受注行番号枝番' => 'branch_number',
        '書類保管番号' => 'storage_number',
        '保証書番号' => 'warranty_number',
        '契約期間終了日' => 'contract_end_number',
        '有償開始日' => 'paid_start_date',
        '有償終了日' => 'paid_end_date',
        '仕入先CD' => 'supplier_cd',
        '保守会社CD' => 'company_cd',
        '窓口数' => 'number_of_windows',
        '保守窓口CD' => 'maintenance_window_cd',
        '数量' => 'quantity',
        '単位' => 'unit',
        '単価' => 'unit_price',
        '契約金額消費税額' => 'consumption_tax',
        '営業粗利' => 'gross_operating_profit',
        'SE粗利' => 'se_gross_profit',
        '研究所粗利' => 'lab_gross_profit',
        '出荷SC粗利' => 'sc_gross_profit',
        '仕入金額' => 'purchase_amount',
        '納品方法' => 'delivery_method',
        '定期T登録年月日' => 'registration_date',
        '定期T登録時刻' => 'registration_time',
        '定期T更新年月日' => 'update_date',
        '定期T更新時刻' => 'update_time',
        '定期T更新者' => 'changer',
        '定期F登録年月日' => 'registration_date_2',
        '定期F登録時刻' => 'registration_time_2',
        '定期F更新年月日' => 'update_date_2',
        '定期F更新時刻' => 'update_time_2',
        '定期F更新者' => 'changer_2',
    ];
    public function index(Request $request)
    {
        $bango = request('userId');
        if ($request->ajax()) {
            $validator = FixedRateContract::validate($request, $bango);
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
        $headers = FixedRateContract::headers($bango);
        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $bango)->where('kengenchar05', '0330')->get()->count();
        if($initial_header == 0){
            unset($headers['定期T登録年月日']);
            unset($headers['定期T登録時刻']);
            unset($headers['定期T更新年月日']);
            unset($headers['定期T更新時刻']);
            unset($headers['定期T更新者']);
            unset($headers['定期F登録年月日']);
            unset($headers['定期F登録時刻']);
            unset($headers['定期F更新年月日']);
            unset($headers['定期F更新時刻']);
            unset($headers['定期F更新者']);
        }
        
        $table_headers = FixedRateContract::headers($bango, 'table_headers');
        $page_no = FixedRateContract::$pageNo;
        $route = 'fixedRateTableSetting';
        $redirect_path = 'fixedRateContractReload';
        $temp_table = 'all_fixed_rate_contract_temp';
        $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7501'");
        $review_orderbango = $reviewData->orderbango;
        $data003 = substr($tantousya->datatxt0003, 2, 4);
        $data004 = substr($tantousya->datatxt0004, 2, 5);
        $data005 = substr($tantousya->datatxt0005, 2, 6);
        $data003_left = substr($tantousya->datatxt0003, 2, 4);
        $data003_right = substr($tantousya->datatxt0003, 2, 4);
        $personal_datatxt0003 = QueryHelper::select(['category1', 'category2', 'category4'])->from('categorykanri')->where("category1 = 'B9' ")->where("category2 = '$data003' ")->get()->first();
        $personal_datatxt0004 = QueryHelper::select(['category1', 'category2', 'category4'])->from('categorykanri')->where("category1 = 'C1' ")->where("category2 = '$data004' ")->get()->first();
        $personal_datatxt0005 = QueryHelper::select(['category1', 'category2', 'category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("category2 = '$data005' ")->get()->first();
        $B9Data_left = QueryHelper::fetchResult("select *,RIGHT(category2, 2) as category2_show from categorykanri where category1 = 'B9' and (suchi2 = 0 or suchi2 is null) and left(category2, 2) ='$review_orderbango' ORDER BY category2 ASC");
        $C1Data_left = QueryHelper::select(['category1', 'category2', 'category4'])->from('categorykanri')->where("category1 = 'C1' ")->where("category2 LIKE '%$data003_left%' ")->where("left(category2, 2) ='$review_orderbango'")->get()->execute();
        $B9Data_right = QueryHelper::fetchResult("select *,RIGHT(category2, 2) as category2_show from categorykanri where category1 = 'B9' and (suchi2 = 0 or suchi2 is null) and left(category2, 2) ='$review_orderbango' ORDER BY category2 ASC");
        $C1Data_right = QueryHelper::select(['category1', 'category2', 'category4'])->from('categorykanri')->where("left(category2, 2) ='$review_orderbango'")->where("category1 = 'C1' ")->where("category2 LIKE '%$data003_right%' ")->get()->execute();
        if (isset($data_from_view['department_datachar05_start'])) {
            $data003_left = substr($data_from_view['department_datachar05_start'], 2, 5);
            $data003_right = substr($data_from_view['department_datachar05_start'], 2, 5);
        }
        if (isset($data_from_view['group_datachar05_start'])) {
            $data003_short = substr($data_from_view['group_datachar05_start'], 2, 5);
            $data003 = substr($data_from_view['group_datachar05_start'], 2, 6);
            $C2Data_left = QueryHelper::select(['category1', 'category2', 'category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_short%' ")->get()->execute();
            $C2Data_right = QueryHelper::select(['category1', 'category2', 'category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_short%' ")->where("CAST(category2 as integer) >= $data003 ")->get()->execute();
        } else {
            $C2Data_left = QueryHelper::select(['category1', 'category2', 'category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_left%' ")->get()->execute();
            $C2Data_right = QueryHelper::select(['category1', 'category2', 'category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_right%' ")->get()->execute();
        }
        $categorykanriesJ3 = QueryHelper::fetchResult("select category1,category2,category4,suchi2,suchi1 from categorykanri where category1 = 'J3' and (suchi2 = 0 or suchi2 is null)  ORDER BY suchi1 ASC");
        $incharges = QueryHelper::fetchResult("select * from tantousya where deleteflag = 0 and ztanka='$review_orderbango' order by bango");
        $data_from_view = $request->all();
        session()->put('oldInput' . $bango, $data_from_view);
        if (isset($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh')) {
            $fsRemoveKeys = ['page', 'Button', 'pagination', '_token', 'userId',];
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'division_datachar05_start', 'division_datachar05_end', 'department_datachar05_start', 'department_datachar05_end', 'group_datachar05_start', 'group_datachar05_end', 'datachar05', 'creation_category', 'contractor_text', 'billing_address_text', 'end_customer_text'];

           // try {
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
                  
                    
                    if(($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'refresh') && $defalut_check == 0){
                        $pagi = 20;
                        return view('flatRateContract.fixedRateContract.index', compact('bango', 'tantousya', 'pagi', 'categorykanriesJ3', 'B9Data_left', 'C1Data_left', 'C2Data_left', 'B9Data_right', 'C1Data_right', 'C2Data_right', 'incharges', 'personal_datatxt0003', 'personal_datatxt0004', 'personal_datatxt0005', 'data_from_view', 'buttonMessage',  'headers', 'table_headers', 'redirect_path', 'page_no', 'route'));
                    }

                    $query = AllFixedRateContract::data($bango, $req_data)->toSql();
                    $allFixedRateContract = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    if ($allFixedRateContract->items() == null && $allFixedRateContract->currentPage() != 1) {
                        $currentPage = ($allFixedRateContract->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $allFixedRateContract = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    }

                    if ($allFixedRateContract->total() == 0) {
                        $exceedFixedRateContact = '該当するデータがありません。';
                    } else {
                        $exceedFixedRateContact = '';
                    }

                    if ($data_from_view['Button'] == 'FirstSearch') {
                        $fsReqData = $req_data; //fsReqData=first search request data
                    }

                    //export excel
                    if ($data_from_view['Button'] == 'xls') {
                        $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                        $headers = $this->headers;
                        $excelName = '定期定額契約一覧・照会.xlsx';
                        return $this->excelDownload($headers, $searched, $excelName);
                    }
                }
//            } catch (\Exception $e) {
//                $exceedFixedRateContact = '検索形式が間違っています。';
//                $allFixedRateContract = [];
//                $allFixedRateContract = collect($allFixedRateContract);
//                $allFixedRateContract = $allFixedRateContract->paginate($pagination);
//
//                return view('flatRateContract.fixedRateContract.index', compact('bango', 'tantousya',  'categorykanriesJ3', 'B9Data_left', 'C1Data_left', 'C2Data_left', 'B9Data_right', 'C1Data_right', 'C2Data_right', 'incharges', 'personal_datatxt0003', 'personal_datatxt0004', 'personal_datatxt0005', 'data_from_view', 'buttonMessage',  'headers', 'table_headers', 'redirect_path', 'page_no', 'route', 'fsReqData', 'allFixedRateContract', 'exceedFixedRateContact'));;
//            }

            return view('flatRateContract.fixedRateContract.index', compact('bango', 'tantousya',  'categorykanriesJ3', 'B9Data_left', 'C1Data_left', 'C2Data_left', 'B9Data_right', 'C1Data_right', 'C2Data_right', 'incharges', 'personal_datatxt0003', 'personal_datatxt0004', 'personal_datatxt0005', 'data_from_view', 'buttonMessage',  'headers', 'table_headers', 'redirect_path', 'page_no', 'route', 'req_data', 'fsReqData', 'allFixedRateContract', 'exceedFixedRateContact'));
        }

        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;
        //        if (request('change_id')) {
        //            $query = allOrderHistory::data($bango, $deleted_item)->whereRaw("bango = '" . request('change_id') . "'")->toSql();
        //        } else {
        //            $query = allOrderHistory::data($bango, $deleted_item)->toSql();
        //        }
        session()->forget('oldInput' . $bango);
        return view('flatRateContract.fixedRateContract.index', compact('bango', 'tantousya', 'pagi', 'categorykanriesJ3', 'B9Data_left', 'C1Data_left', 'C2Data_left', 'B9Data_right', 'C1Data_right', 'C2Data_right', 'incharges', 'personal_datatxt0003', 'personal_datatxt0004', 'personal_datatxt0005', 'data_from_view', 'buttonMessage',  'headers', 'table_headers', 'redirect_path', 'page_no', 'route'));
    }

    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $id)->where('kengenchar05', '0330')->get()->count();
        $pageNo = FixedRateContract::$pageNo;
        //return  TableSetting::setting($this->headers, $id, $pageNo);
        $Setting =  TableSetting::setting($this->headers, $id, $pageNo);
        if($initial_header == 0){
            $Setting['registration_date'] = "";
            $Setting['registration_time'] = "";
            $Setting['update_date'] = "";
            $Setting['update_time'] = "";
            $Setting['changer'] = "";
            $Setting['registration_date_2'] = "";
            $Setting['registration_time_2'] = "";
            $Setting['update_date_2'] = "";
            $Setting['update_time_2'] = "";
            $Setting['changer_2'] = "";
        }
        return $Setting;
    }

    public function tableSettingSave(Request $request, $id, $type = null)
    {

        $pageNo = FixedRateContract::$pageNo;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '定期定額契約一覧・照会', $type);
    }
    public function clearBottomReqData($request_data)
    {
        $headers = [
            '契約状態' => 'contract_status',
            '担当' => 'in_charge',
            '契約番号' => 'contract_number',
            '商品名' => 'product_name',
            '売上請求先' => 'billing_address_r17',
            '受注先' => 'contractor_r17',
            '最終顧客' => 'end_customer_r17',
            '契約金額' => 'contract_amount',
            '契約開始日' => 'contract_start_date',
            '契約月数' => 'contract_months',
            '無償期間' => 'free_period',
            '請求サイクル' => 'billing_cycle',
            '請求月度' => 'billing_month',
            '自動継続' => 'automatic_continuation',
            '自動売上' => 'automatic_sales',
            '伝票統合' => 'voucher_integration',
            '入金方法' => 'payment_method',
            '契約回数' => 'number_of_contracts',
            '作成区分' => 'creation_category_temp',
            '定期サブスク区分' => 'subscription_classification',
            '元受注番号' => 'order_number',
            '元受注行番号' => 'line_number',
            '元受注行番号枝番' => 'branch_number',
            '書類保管番号' => 'storage_number',
            '保証書番号' => 'warranty_number',
            '契約期間終了日' => 'contract_end_number',
            '有償開始日' => 'paid_start_date',
            '有償終了日' => 'paid_end_date',
            '仕入先CD' => 'supplier_cd',
            '保守会社CD' => 'company_cd',
            '窓口数' => 'number_of_windows',
            '保守窓口CD' => 'maintenance_window_cd',
            '数量' => 'quantity',
            '単位' => 'unit',
            '単価' => 'unit_price',
            '契約金額消費税額' => 'consumption_tax',
            '営業粗利' => 'gross_operating_profit',
            'SE粗利' => 'se_gross_profit',
            '研究所粗利' => 'lab_gross_profit',
            '出荷SC粗利' => 'sc_gross_profit',
            '仕入金額' => 'purchase_amount',
            '納品方法' => 'delivery_method',
            '定期T登録年月日' => 'registration_date',
            '定期T登録時刻' => 'registration_time',
            '定期T更新年月日' => 'update_date',
            '定期T更新時刻' => 'update_time',
            '定期T更新者' => 'changer',
            '定期F登録年月日' => 'registration_date_2',
            '定期F登録時刻' => 'registration_time_2',
            '定期F更新年月日' => 'update_date_2',
            '定期F更新時刻' => 'update_time_2',
            '定期F更新者' => 'changer_2',
        ];
        foreach ($request_data as $key => $val) {
            if (in_array($key, $headers)) {
                $request_data[$key] = null;
            }
        }
        return $request_data;
    }
}
