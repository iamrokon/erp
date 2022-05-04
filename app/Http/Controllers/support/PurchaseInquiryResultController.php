<?php

namespace App\Http\Controllers\support;
use App\AllClass\master\nameMaster\allCategorykanri;
use Illuminate\Http\Request;
use App\tantousya;
use App\kengen;
//use App\categorykanri;
use App\requestTable;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\support\purchaseInquiryResult\AllPurchaseInquiryResult;
use App\AllClass\support\purchaseInquiryResult\purchaseInquiryResultHeaders;
use App\AllClass\support\purchaseResultList\validatePurchaseResultList;
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
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;

class PurchaseInquiryResultController extends Controller
{
    private $headers = [
        '仕入伝票番号行番号' => 'purchase_slip_number',
        '発注番号行番号' => 'order_number',
        '仕入日付' => 'purchase_date',
        '仕入先' => 'supplier',
        '納品書番号' => 'delivery_note_number',
        '品名' => 'product_name',
        '数量' => 'purchase_inquiry_formatted_quantity',
        '単価' => 'purchase_inquiry_formatted_unit_price',
        '金額' => 'purchase_inquiry_formatted_amount'
    ];


    public function postPurchaseInquiryResult(Request $request)
    {
        $bango = request('userId');
        $support_number = request('support_number');
        // dd($request->all());
        //check validation for first search
        if($request->ajax()){
            $validator = validatePurchaseResultList::validate($request,$bango);
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

        

        $buttonMessage = ButtonMsg::read($bango);

        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 20;
        }

        // Start Top Search Data
        $kokyakuorderbango = QueryHelper::fetchSingleResult("select max(kokyakuorderbango) as bango from orderhenkan where datatxt0152 = '$support_number'")->bango;
        $orderhenkanData = QueryHelper::fetchSingleResult("select 
                            orderhenkan.*,
                            v_torihikisaki.r17_3cd as contractor,
                            concat(tantousya.bango, ' ',tantousya.name) as name
                            from orderhenkan
                            left join tantousya on tantousya.bango = orderhenkan.datachar09
                            left join v_torihikisaki on v_torihikisaki.torihikisaki_cd = orderhenkan.datachar10
                            where kokyakuorderbango = '$kokyakuorderbango' and synchroorderbango2 = 0 order by ordertypebango2 desc limit 1");
        // dd($orderhenkanData);
        $orderuserbango = QueryHelper::fetchSingleResult("select orderuserbango from orderhenkan where kokyakuorderbango = substring('$support_number',1,10)")->orderuserbango;
        $ordertypebango2 = QueryHelper::fetchSingleResult("select max(ordertypebango2) as maxnum from orderhenkan where kokyakuorderbango = '$orderuserbango'")->maxnumber ?? 0;
        $hikiatesyukko_datachar04 = QueryHelper::fetchSingleResult("select datachar04 from hikiatesyukko where syouhinid = '$orderuserbango'")->datachar04;
        if($hikiatesyukko_datachar04 == '2'){
            $intorder03 = QueryHelper::fetchSingleResult("select 
            CASE
                WHEN intorder03::text is null THEN NULL
                ELSE concat_ws('/',substring(intorder03::text,1,4),substring(intorder03::text,5,2),substring(intorder03::text,7,2)) 
            END as sales_date from orderhenkan where kokyakuorderbango = '$orderuserbango' and datachar10 is null and ordertypebango2 = $ordertypebango2")->sales_date;
        }
        else if($hikiatesyukko_datachar04 == '1'){
            $intorder03 = QueryHelper::fetchSingleResult("select 
            CASE
                WHEN intorder03::text is null THEN NULL
                ELSE concat_ws('/',substring(intorder03::text,1,4),substring(intorder03::text,5,2),substring(intorder03::text,7,2)) 
            END as sales_date from orderhenkan where kokyakuorderbango = '$orderuserbango' and datachar10 is not null")->sales_date;
        }
        $juchukubun1 = QueryHelper::fetchSingleResult("select r15 from v_orderinfo where juchubango = '$orderuserbango' and  ordertypebango2 = $ordertypebango2")->r15 ?? null;
        $purchase_flag = QueryHelper::fetchSingleResult("select 
                            CASE
                                WHEN barcode is null 
                                    and codename is null 
                                    and tanka = 2
                                THEN 1
                                WHEN barcode is not null 
                                    and codename is null 
                                    and tanka = 2
                                THEN 2
                                WHEN barcode is not null 
                                    and codename is not null 
                                    and tanka = 2
                                THEN 3
                                ELSE 4
                            END as inspection
                        from  juchusyukko2 where syouhinid = substring('$support_number',1,10) and syouhinsyu = substring('$support_number',11,3)::int")->inspection;
        // dd($ordertypebango2, $orderuserbango, $hikiatesyukko_datachar04, $intorder03, $juchukubun1, $purchase_flag);
        // End Top Search Data

        $headers = purchaseInquiryResultHeaders::headers($bango);
        $table_headers = purchaseInquiryResultHeaders::headers($bango, 'table_headers');
        $page_no = purchaseInquiryResultHeaders::$page_no;
        $route = 'purchaseInquiryResultTableSetting';
        $redirect_path = 'purchaseInquiryResultReload';

        $temp_table = 'purchase_inquiry_result_temp';

        //show page start here
        if (isset($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh')) {
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId','support_number'];
            try {
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh') {
                    //clear bottom search request data
                    if($data_from_view['Button'] == 'refresh'){
                        $data_from_view = self::clearBottomReqData($data_from_view);
                        $data_from_view["pagination"] = 20;
                        // $old = $data_from_view;
                    }   
                    $req_data = $data_from_view;                
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);                 
                    
                    if(isset($data['inventory_purchase_amount'])){
                        $data['inventory_purchase_amount'] = str_replace(',', '', $data['inventory_purchase_amount']);
                    }
                    if(isset($data['inventory_purchase_quantity'])){
                        $data['inventory_purchase_quantity'] = str_replace(',', '', $data['inventory_purchase_quantity']);
                    }
                    if(isset($data['inventory_purchase_unit_price'])){
                        $data['inventory_purchase_unit_price'] = str_replace(',', '', $data['inventory_purchase_unit_price']);
                    }
                    if(isset($data['inventory_tax_amount'])){
                        $data['inventory_tax_amount'] = str_replace(',', '', $data['inventory_tax_amount']);
                    }
                    
                    $query = AllPurchaseInquiryResult::data($bango, $support_number, $kokyakuorderbango)->toSql();
                    $purchaseInquiryResultData = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    $purchaseInquiryResultData2 = $this->searchDataFetch($query, $data, $bango, $temp_table);
                    // dd($data, $purchaseInquiryResultData);
                    if ($purchaseInquiryResultData->items() == null && $purchaseInquiryResultData->currentPage() != 1) {
                        $currentPage = ($purchaseInquiryResultData->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $purchaseInquiryResultData = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                        $purchaseInquiryResultData2 = $this->searchDataFetch($query, $data, $bango, $temp_table);
                    }                    
                    
                    if ($purchaseInquiryResultData->total() == 0) {
                        $exceedUser = '該当するデータがありません。';
                    } else {
                        $exceedUser = '';
                    }

                    //export excel
                    if ($data_from_view['Button'] == 'xls') {
                        $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                        $headers = $this->headers;
                        $excelName = '外注仕入実績照会.xlsx';
                        return $this->excelDownload($headers, $searched, $excelName);
                    }
                }
            } catch (\Exception $e) {
                // dd($e);
                $exceedUser = '該当するデータがありません。';
                $purchaseInquiryResultData = collect();
                $order_amount  = $purchaseInquiryResultData->sum('purchase_inquiry_amount');
                $purchaseInquiryResultData = $purchaseInquiryResultData->paginate($pagination);                
                return view('support.purchaseInquiryResult.mainPurchaseInquiryResult', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'buttonMessage','support_number','kokyakuorderbango','orderhenkanData', 'intorder03', 'juchukubun1', 'purchase_flag','purchaseInquiryResultData','exceedUser','req_data','order_amount'));
            }
            $order_amount  = $purchaseInquiryResultData2->sum('purchase_inquiry_amount');
            // dd($purchaseInquiryResultData);
            return view('support.purchaseInquiryResult.mainPurchaseInquiryResult', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'buttonMessage','support_number','kokyakuorderbango','orderhenkanData', 'intorder03', 'juchukubun1', 'purchase_flag','purchaseInquiryResultData','exceedUser','req_data', 'order_amount'));
        }
        // initial data
        $removeKeys = ['support_number', '_token', 'userId'];
        $data = $this->removeDataFromView($data_from_view, $removeKeys);
        $query = AllPurchaseInquiryResult::data($bango, $support_number, $kokyakuorderbango)->toSql();
        $purchaseInquiryResultData = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
        $purchaseInquiryResultData2 = $this->searchDataFetch($query, $data, $bango, $temp_table);
        $order_amount  = $purchaseInquiryResultData2->sum('purchase_inquiry_amount');
        // if ($purchaseInquiryResultData->total() == 0) {
        //     $exceedUser = '該当するデータがありません。';
        // } else {
        //     $exceedUser = '';
        // }
        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;
        session()->forget('oldInput' . $bango);
        return view('support.purchaseInquiryResult.mainPurchaseInquiryResult', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'pagi', 'buttonMessage','support_number','kokyakuorderbango','orderhenkanData', 'intorder03', 'juchukubun1', 'purchase_flag','purchaseInquiryResultData', 'order_amount'));
    }

    // updatePurchaseResultList
    public function updatePurchaseInquiryResult(Request $request){       
        // dd($request->all());
        $bango = request('userId');
        $support_number = $request->support_number;
        $prev = $request->prev_inspection;
        $update = $request->selected_inspection;
        $juchusyukko2 = QueryHelper::fetchSingleResult("select barcode, codename, tanka from juchusyukko2 where syouhinid = substring('$support_number',1,10) and syouhinsyu = substring('$support_number',11,3)::int") ?? null;
        $tanka = $juchusyukko2->tanka;
        $codename = $juchusyukko2->codename;
        $barcode = $juchusyukko2->barcode;
        // list($status, $errors) = $this->validator($request);
        if($tanka == 1){
            $status = true;
        }elseif($tanka == 2){
            $status = false;
        }
        
        if($status){
        //    $err_msg = $errors->all();
           return ['err_status'=>true];
        }else if(!$status && request('submit_confirmation') == ""){
            return "confirmation_msg";
        }else{
            
            if($prev != $update){
                $syouhinid = substr($support_number, 0, 10);
                $syouhinsyu = substr($support_number, 10, 3);
                $tanka_value = $tanka;
                $barcode_value = $barcode;
                $codename_value = $codename;
                if($prev==1 && $update==2){
                    $tanka_value = 2;
                    $barcode_value = $bango;
                    $codename_value = null;
                }
                else if($prev==2 && $update==1){
                    $tanka_value = 2;
                    $barcode_value = null;
                    $codename_value = null;
                }
                else if($prev==2 && $update==3){
                    $tanka_value = 2;
                    // $barcode_value = null;
                    $codename_value = $bango;
                }
                else if($prev==3 && $update==1){
                    $tanka_value = 2;
                    $barcode_value = null;
                    $codename_value = null;
                }
                else if($prev==3 && $update==2){
                    $tanka_value = 2;
                    // $barcode_value = null;
                    $codename_value = null;
                }
                else if($prev==3 && $update==4){
                    $tanka_value = 1;
                    // $barcode_value = null;
                    // $codename_value = null;
                }

                //update juchusyukko2 data
                $juchusyukko2_update_data = [
                        'tanka' => $tanka_value,
                        'barcode' => $barcode_value,
                        'codename' => $codename_value,
                        'denpyoshimebi' => Carbon::now()->format('Y-m-d H:i:s'),
                        'tantousyabango' => $bango,
                    ];
                // dd($juchusyukko2_update_data);
                $juchusyukko2Update = QueryHelper::updateData('juchusyukko2', $juchusyukko2_update_data, ['syouhinid' => $syouhinid, 'syouhinsyu' => $syouhinsyu], $bango, __CLASS__, __FUNCTION__, __LINE__);

                $update_msg = "登録しました";
                Session::flash('success_msg',$update_msg);
            }
            return "ok";
        }
    }


    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = purchaseInquiryResultHeaders::$page_no;
        return $Setting = TableSetting::setting($this->headers, $id, $pageNo);
    }
    public function tableSettingSave(Request $request, $id, $bango, $type = null)
    {
        $pageNo = purchaseInquiryResultHeaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '外注仕入実績一覧', $type);
    }
    public function clearBottomReqData($request_data){
        $headers = [
            '仕入伝票番号行番号' => 'purchase_slip_number',
            '発注番号行番号' => 'order_number',
            '仕入日付' => 'purchase_date',
            '仕入先' => 'supplier',
            '納品書番号' => 'delivery_note_number',
            '品名' => 'product_name',
            '数量' => 'purchase_inquiry_quantity',
            '単価' => 'purchase_inquiry_unit_price',
            '金額' => 'purchase_inquiry_amount'
        ];
        foreach($request_data as $key=>$val){
            if (in_array($key, $headers)){
                $request_data[$key] = null;
            }
        }
        return $request_data;
    }
    
}