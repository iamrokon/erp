<?php

namespace App\Http\Controllers\sales;

use App\AllClass\ButtonMsg;
use App\AllClass\db\QueryHandler;
use App\AllClass\sales\creditLimitManagement\AllCreditLimitManagement;
use App\AllClass\sales\creditLimitManagement\CreditLimitManagementHeaders;
use App\AllClass\TableSetting;
use App\Http\Controllers\Controller;
use App\kengen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\tantousya;
use Exception;
use DateTime;
use Illuminate\Support\Facades\Session;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

class CreditLimitManagementController extends Controller
{
    private $headers = [
        'グループ' => 'tantousya_datatxt0005_group',
        '担当者' => 'manager',
        '売上請求先' => 'sales_billing_destination',
        '与信限度' => 'clm_credit_limits',
        '売掛総債権残高' => 'clm_total_amounts',
        '保守予定' => 'clm_maintenance_schedule',
        '注残予定' => 'clm_note_remaining_schedule',
        '予定残高' => 'clm_scheduled_balance',
        '受注番号' => 'order_no',
        '受注先' => 'contractor',
        '税込金額' => 'clm_order_amount',
        '売上予定' => 'clm_sales_schedule'
    ];

    public function postCreditLimitManagement(Request $request)
    {
        /*$sql = "DELETE FROM kengensettei where kengenchar05::text LIKE '%04-26%' and kengenchar01::text LIKE '%col%'";
                        QueryHelper::runQuery($sql);*/
        $bango = request('userId');
        $data_from_view = $request->all();
//        dd($data_from_view);
        session()->put('oldInput' . $bango, $data_from_view);
        $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7501'");
        $review_orderbango = $reviewData->orderbango;
        $tantousya = tantousya::find($bango);
        $data003=substr($tantousya->datatxt0003, 2,4);
        $data003_left=substr($tantousya->datatxt0003, 2,4);
        $data003_right=substr($tantousya->datatxt0003, 2,4);
        if (isset($data_from_view['division_datachar05_start'])) {
            $data003_left=substr($data_from_view['division_datachar05_start'], 2,4);
        }
        if (isset($data_from_view['division_datachar05_end'])) {
            $data003_right=substr($data_from_view['division_datachar05_end'], 2,4);
        }
        $data004 = substr($tantousya->datatxt0004, 2,5);
        $data005 = substr($tantousya->datatxt0005, 2,6);

        $personal_datatxt0003 = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'B9' ")->where("category2 = '$data003' ")->get()->first();

        $personal_datatxt0004 = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C1' ")->where("category2 = '$data004' ")->get()->first();

        $personal_datatxt0005 = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("category2 = '$data005' ")->get()->first();


        //get categorykanri data
        $B9Data_left = QueryHelper::fetchResult("select *,RIGHT(category2, 2) as category2_show from categorykanri where category1 = 'B9' and (suchi2 = 0 or suchi2 is null) and left(category2, 2) ='$review_orderbango' ORDER BY category2 ASC");
        $B9Data_right = QueryHelper::fetchResult("select *,RIGHT(category2, 2) as category2_show from categorykanri where category1 = 'B9' and (suchi2 = 0 or suchi2 is null) and left(category2, 2) ='$review_orderbango' ORDER BY category2 ASC");
        $C1Data_left = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C1' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_left%' ")->get()->execute();
        $C1Data_right = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C1' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_right%' ")->get()->execute();

        if (isset($data_from_view['department_datachar05_start'])) {
            $data003_left = substr($data_from_view['department_datachar05_start'],2,5);
            $data003_right = substr($data_from_view['department_datachar05_start'],2,5);
        }
        if (isset($data_from_view['group_datachar05_start'])) {
            $data003_short = substr($data_from_view['group_datachar05_start'],2,5);
            $data003 = substr($data_from_view['group_datachar05_start'],2,6);
            $C2Data_left = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_short%' ")->get()->execute();
            $C2Data_right = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_short%' ")->where("CAST(category2 as integer) >= $data003 ")->get()->execute();
        }else{
            $C2Data_left = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_left%' ")->get()->execute();
            $C2Data_right = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_right%' ")->get()->execute();
        }

//        dd($C1Data_left);
        //get tantousya data
        $datachar05 = QueryHelper::fetchResult("select * from tantousya where deleteflag = 0 and ztanka='$review_orderbango' order by bango");

        $headers = CreditLimitManagementHeaders::headers($bango);
        $table_headers = CreditLimitManagementHeaders::headers($bango, 'table_headers');
        $route = 'creditLimitManagementTableSetting';
        $redirect_path = 'creditLimitManagementReload';

        /*$initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $bango)->where('kengenchar05', '06-04')->get()->count();
        if($initial_header == 0){
            unset($headers['仕入購入区分']);
            unset($headers['作成区分']);
            unset($headers['仕入担当者']);
            unset($headers['納品書番号']);
            unset($headers['納品書日付']);
            unset($headers['伝票備考']);
            unset($headers['支払日']);
            unset($headers['仕入消費税額']);
            unset($headers['仕入履歴作成フラグ']);
            unset($headers['予備1']);
            unset($headers['予備2']);
            unset($headers['予備3']);
            unset($headers['予備4']);
            unset($headers['予備5']);
            unset($headers['予備6']);
            unset($headers['データ有効区分']);
            unset($headers['登録年月日']);
            unset($headers['登録時刻']);
            unset($headers['更新者']);
            unset($headers['訂正回数']);
            unset($headers['支払締め日']);
            unset($headers['支払一括消費税額']);
            unset($headers['仕入済区分']);
            unset($headers['前払区分']);
            unset($headers['仮払仕入日']);
            unset($headers['支払データ作成フラグ']);
            unset($headers['買掛残高更新フラグ']);
            unset($headers['仕入購入指示者']);
            unset($headers['仕入購入検印者']);
            unset($headers['仕入会計データ作成フェーズ']);
            unset($headers['フラグ予備1']);
        }*/

        $buttonMessage = ButtonMsg::read($bango);
        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 20;
        }
        $old = $request->all();
        $creditLimitManagementError='';
        $creditLimitManagementSuccess='';

        if (!empty($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' )) {
//            dd($request->all());
            $fsRemoveTableKeys=['tantousya_datatxt0005_group', 'manager', 'sales_billing_destination', 'clm_credit_limits', 'clm_credit_limits_sort', 'clm_total_amounts', 'clm_total_amounts_sort','clm_maintenance_schedule','clm_maintenance_schedule_sort', 'clm_note_remaining_schedule', 'clm_note_remaining_schedule_sort',
                                'clm_scheduled_balance', 'clm_scheduled_balance_sort','clm_order_amount','clm_order_amount_sort','clm_sales_schedule','clm_sales_schedule_sort','order_no','contractor','sortField','sortType'];
            $fsReqData= $this->removeDataFromView($data_from_view, $fsRemoveTableKeys);
//            dd($fsReqData);
            $temp_table= "credit_management_temp";

            try {
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort') {

//                    dd($data_from_view);
                    $formatted_int_fields=['clm_credit_limits_sort','clm_total_amounts_sort','clm_maintenance_schedule_sort','clm_note_remaining_schedule_sort','clm_order_amount_sort'];
                    $formatted_date_fields=['clm_sales_schedule_sort'];
                    $allTableRequest = $this->modifyBladeData($data_from_view, $fsRemoveTableKeys);
//                    dd($allTableRequest);

                    foreach ($allTableRequest as $key => $value) {
                        if ((in_array($key, $formatted_date_fields) || in_array($key, $formatted_int_fields)) && $value!=null) {
//                            dd($value);
                            $allTableRequest[$key] = str_replace(array('/', ':',',',' '),'',$value);
                        }

                    }
//                    dd($allTableRequest,'hlw');
                    $query= AllCreditLimitManagement::readData($bango,$fsReqData);

//                    dd($allTableRequest);

                    $creditLimitManagementInfos = $this->searchDataFetch($query, $allTableRequest, $bango, $temp_table, $pagination);
                    if ($creditLimitManagementInfos->items() == null && $creditLimitManagementInfos->currentPage() != 1) {
                        $currentPage = ($creditLimitManagementInfos->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $creditLimitManagementInfos = $this->searchDataFetch($query, $allTableRequest, $bango, $temp_table, $pagination);
                    }
//                    dd($purchaseOrderInfos->total());
                    if ($creditLimitManagementInfos->total() == 0) {
                        if(Session::has('defaultSrc')){
                            if (Session::get('defaultSrc')=='1'){
                                $creditLimitManagementError = '該当するデータがありません。';
                            }
                            else{
                                $creditLimitManagementError = '';
                            }
                        }
                        else{
                            $creditLimitManagementError = '';
                        }
                    } else {
                        $creditLimitManagementError = '';
                    }
                }
                else if ($data_from_view['Button'] == 'xls') {
//                    dd('are ruko jara...sabar karo');
                    $query= AllCreditLimitManagement::readData($bango,$fsReqData);

                    $allTableRequest = $this->modifyBladeData($data_from_view, $fsRemoveTableKeys);

                    $searched = $this->searchDataFetch($query, $allTableRequest, $bango, $temp_table, $pagination, 'xls');
//                        dd($searched);
                    $headers = $this->headers;
                    /*$headers['発注消費税総額']='purchase_consumption_tax_show';
                    $headers['発注総額']='total_order_amount_show';*/
//                    dd($allTableRequest,$searched,$headers);
                    $excelName = '与信限度チェック管理表.xlsx';
                    return $this->excelDownload($headers, $searched, $excelName);
                }
            } catch (\Exception $e) {
//                dd($e);
                $creditLimitManagementInfos = collect([])->paginate($pagination);
                if ($creditLimitManagementInfos->total() == 0) {
                    if(Session::has('defaultSrc')){
                        if (Session::get('defaultSrc')=='1'){
                            $creditLimitManagementError = '該当するデータがありません。';
                        }
                        else{
                            $creditLimitManagementError = '';
                        }
                    }
                    else{
                        $creditLimitManagementError = '';
                    }
                } else {
                    $creditLimitManagementError = '';
                }
            }

            return view('sales.creditLimitManagement.mainCreditLimitManagement',compact('bango','tantousya','B9Data_left','C1Data_left','C2Data_left','B9Data_right','C1Data_right','C2Data_right','datachar05','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','creditLimitManagementInfos','fsReqData','headers','buttonMessage','route','redirect_path','table_headers','creditLimitManagementError','old'));
        }

        else if (!empty(request('firstButton')) && request('firstButton')== 'topSearch' || !empty(request('Button')) && request('Button') == 'refresh')
        {
//            dd($request->all());
            $old=[];
            $fsReqData= $request->all();
//            dd($data_from_view,$bango);
            $query= AllCreditLimitManagement::readData($bango,$data_from_view);
//            dd($query);
            if ($query=='ng'){
                $creditLimitManagementError = '該当するデータがありません。';
                session()->put('defaultSrc', '0');
                $creditLimitManagementInfos=collect([])->paginate(20);
            }
            else{
                if (count(QueryHelper::fetchResult($query))==0){
                    $creditLimitManagementError = '該当するデータがありません。';
                    session()->put('defaultSrc', '0');
                }
                else{
                    $creditLimitManagementError = '';
                    session()->put('defaultSrc', '1');
                }
                $creditLimitManagementInfos = collect(QueryHelper::fetchResult($query))->paginate(20);/*collect([])->paginate(20);*/
            }
            return view('sales.creditLimitManagement.mainCreditLimitManagement',compact('bango','tantousya','B9Data_left','C1Data_left','C2Data_left','B9Data_right','C1Data_right','C2Data_right','datachar05','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','creditLimitManagementInfos','old','fsReqData','headers','buttonMessage','route','redirect_path','table_headers','creditLimitManagementError','creditLimitManagementSuccess'));
        }


        $old=null;
        session()->put('defaultSrc', '0');
        $creditLimitManagementInfos =collect([])->paginate(20);
        return view('sales.creditLimitManagement.mainCreditLimitManagement',compact('bango','tantousya','B9Data_left','C1Data_left','C2Data_left','B9Data_right','C1Data_right','C2Data_right','datachar05','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','creditLimitManagementInfos','old','headers','buttonMessage','route','redirect_path','table_headers','creditLimitManagementError','creditLimitManagementSuccess'));
    }

    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = CreditLimitManagementHeaders::$page_no;
        return $Setting = TableSetting::setting($this->headers, $id, $pageNo);
        /*$initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $id)->where('kengenchar05', '06-04')->get()->count();
        $Setting = TableSetting::setting($this->headers, $id, $pageNo);
        if($initial_header == 0){
            $Setting['purchase_category'] = "";
            $Setting['creation_division'] = "";
            $Setting['purchaser'] = "";
            $Setting['invoice_number'] = "";
            $Setting['invoice_date'] = "";
            $Setting['slip_remarks'] = "";
            $Setting['payment_date'] = "";
            $Setting['purchase_consumption_tax_amount'] = "";
            $Setting['purchase_history_creation_flag'] = "";
            $Setting['spare1'] = "";
            $Setting['spare2'] = "";
            $Setting['spare3'] = "";
            $Setting['spare4'] = "";
            $Setting['spare5'] = "";
            $Setting['spare6'] = "";
            $Setting['data_valid_segment'] = "";
            $Setting['registration_date'] = "";
            $Setting['registration_time'] = "";
            $Setting['updater'] = "";
            $Setting['number_of_corrections'] = "";
            $Setting['payment_closing_date'] = "";
            $Setting['consumption_tax_paid'] = "";
            $Setting['purchased_segment'] = "";
            $Setting['prepayment_segment'] = "";
            $Setting['provisional_purchase_date'] = "";
            $Setting['payment_data_creation_flag'] = "";
            $Setting['accounts_payable_update_flag'] = "";
            $Setting['purchase_orderer'] = "";
            $Setting['purchase_seal_holder'] = "";
            $Setting['accounting_data_creation_phase'] = "";
            $Setting['flag_reserve1'] = "";
        }
        return $Setting;*/
    }

    public function tableSettingSave(Request $request, $id, $bango, $type = null)
    {
        $pageNo = CreditLimitManagementHeaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '仕入購入履歴一覧・仕入照会', $type);
    }

    private function modifyBladeData($alldata,$index){
        $newArr=[];

        foreach ($index as $key => $value) {
            $newArr[$value]=!empty($alldata[$value])?$alldata[$value]:null;
        }
        return $newArr;
    }
}
