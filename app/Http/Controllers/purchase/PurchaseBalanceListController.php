<?php

namespace App\Http\Controllers\purchase;
use Illuminate\Http\Request;
use App\tantousya;
use App\kengen;
use App\requestTable;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\purchase\purchaseBalanceList\PurchaseBalanceListHeaders;
use App\AllClass\purchase\purchaseBalanceList\ValidatePurchaseBalanceList;
use App\AllClass\purchase\purchaseBalanceList\AllPurchaseBalanceList;
use App\AllClass\ButtonMsg;
use Illuminate\Pagination\Paginator;
use App\AllClass\master\excelDownload;
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

class PurchaseBalanceListController extends Controller
{
    private $headers = [
        '仕入先CD' => 'kk0002',
        '仕入先名' => 'supplier_name',
        '前月買掛残' => 'formatted_kk0004',
        '当月買掛額' => 'formatted_kk0005',
        '仕入値引他' => 'formatted_purchase_discount',
        '当月消費税' => 'formatted_kk0009',
        '現金振込' => 'formatted_kk0010',
        '手形' => 'formatted_kk0011',
        '支払値引他' => 'formatted_payment_discount',
        '当月買掛残' => 'formatted_kk0015',
        '前月末前払残高' => 'formatted_kk0016',
        '当月前払額' => 'formatted_kk0017',
        '当月前払消費税額' => 'formatted_kk0018',
        '当月前払現金支払額' => 'formatted_kk0019',
        '当月前払手形支払額' => 'formatted_kk0020',
        '前払支払値引他' => 'formatted_prepaid_payment_discount',
        '当月末前払残高' => 'formatted_kk0024',
    ];


    public function postPurchaseBalanceList(Request $request)
    {
        $bango = request('userId');
        
        //check validation for first search
        if($request->ajax()){
            $validator = ValidatePurchaseBalanceList::validate($request,$bango);
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
        
        if(isset($data_from_view_session['rd'])){
        session()->put('selected_radio_btn', $data_from_view_session['rd']);
        }

        $tantousya = tantousya::find($bango);
        $buttonMessage = ButtonMsg::read($bango);

        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 20;
        }


        if (!empty($data_from_view['chkboxinp'])) {
            $deleted_item = $data_from_view['chkboxinp'];
        } else {
            $deleted_item = 0;
        }

        $db_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $bango)->where('kengenchar05', '06-06')->get();
        if($db_header->count() < 1){
            if(request('rd') == 'rd_2'){
                $headers = PurchaseBalanceListHeaders::headers_2($bango);
                $table_headers = PurchaseBalanceListHeaders::headers_2($bango, 'table_headers');
            }else{
                $headers = PurchaseBalanceListHeaders::headers($bango);
                $table_headers = PurchaseBalanceListHeaders::headers($bango, 'table_headers');
            }
        }else{
            if(request('rd') == 'rd_2'){
                $kengenchar04 = $db_header[0]->kengenchar04;
                $kengenchar04Arr = explode("¶",$kengenchar04);
                $kengenchar04Arr[0] = '購入先CD'.'='.explode("=",$kengenchar04Arr[0])[1];
                $kengenchar04Arr[1] = '購入先名'.'='.explode("=",$kengenchar04Arr[1])[1];
                $kengenchar04Arr[2] = '前月未払残'.'='.explode("=",$kengenchar04Arr[2])[1];
                $kengenchar04Arr[3] = '当月未払額'.'='.explode("=",$kengenchar04Arr[3])[1];
                $kengenchar04Arr[4] = '購入値引他'.'='.explode("=",$kengenchar04Arr[4])[1];
                $kengenchar04Arr[5] = '当月消費税'.'='.explode("=",$kengenchar04Arr[5])[1];
                $kengenchar04Arr[6] = '現金振込'.'='.explode("=",$kengenchar04Arr[6])[1];
                $kengenchar04Arr[7] = '手形'.'='.explode("=",$kengenchar04Arr[7])[1];
                $kengenchar04Arr[8] = '支払値引他'.'='.explode("=",$kengenchar04Arr[8])[1];
                $kengenchar04Arr[9] = '当月未払残'.'='.explode("=",$kengenchar04Arr[9])[1];
                $kengenchar04 = implode("¶",$kengenchar04Arr);
                $updateKengensettei = QueryHelper::fetchSingleResult("update kengensettei set kengenchar04 = '$kengenchar04' where kengenchar01 = 'col' and kengenchar03 = '$bango' and kengenchar05 = '06-06'");
                $headers = PurchaseBalanceListHeaders::headers_2($bango);
                $table_headers = PurchaseBalanceListHeaders::headers_2($bango, 'table_headers');
            }else{
                $kengenchar04 = $db_header[0]->kengenchar04;
                $kengenchar04Arr = explode("¶",$kengenchar04);
                $kengenchar04Arr[0] = '仕入先CD'.'='.explode("=",$kengenchar04Arr[0])[1];
                $kengenchar04Arr[1] = '仕入先名'.'='.explode("=",$kengenchar04Arr[1])[1];
                $kengenchar04Arr[2] = '前月買掛残'.'='.explode("=",$kengenchar04Arr[2])[1];
                $kengenchar04Arr[3] = '当月買掛額'.'='.explode("=",$kengenchar04Arr[3])[1];
                $kengenchar04Arr[4] = '仕入値引他'.'='.explode("=",$kengenchar04Arr[4])[1];
                $kengenchar04Arr[5] = '当月消費税'.'='.explode("=",$kengenchar04Arr[5])[1];
                $kengenchar04Arr[6] = '現金振込'.'='.explode("=",$kengenchar04Arr[6])[1];
                $kengenchar04Arr[7] = '手形'.'='.explode("=",$kengenchar04Arr[7])[1];
                $kengenchar04Arr[8] = '支払値引他'.'='.explode("=",$kengenchar04Arr[8])[1];
                $kengenchar04Arr[9] = '当月買掛残'.'='.explode("=",$kengenchar04Arr[9])[1];
                $kengenchar04 = implode("¶",$kengenchar04Arr);
                $updateKengensettei = QueryHelper::fetchSingleResult("update kengensettei set kengenchar04 = '$kengenchar04' where kengenchar01 = 'col' and kengenchar03 = '$bango' and kengenchar05 = '06-06'");
                $headers = PurchaseBalanceListHeaders::headers($bango);
                $table_headers = PurchaseBalanceListHeaders::headers($bango, 'table_headers');
            }
        }
        
        $page_no = PurchaseBalanceListHeaders::$page_no;
        $route = 'purchaseBalanceListTableSetting';
        $redirect_path = 'purchaseBalanceListReload';
        $temp_table = 'purchase_balance_list_temp';
        
        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $bango)->where('kengenchar05', '06-06')->get()->count();
        if($initial_header == 0){
            unset($headers['前月末前払残高']);
            unset($headers['当月前払額']);
            unset($headers['当月前払消費税額']);
            unset($headers['当月前払現金支払額']);
            unset($headers['当月前払手形支払額']);
            unset($headers['前払支払値引他']);
            unset($headers['当月末前払残高']);
        }

        //show page start here
        if (isset($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh')) {
            $fsRemoveKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp'];
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp', 'kk0002_start', 'kk0002_end', 'db_kk0002_start', 'db_kk0002_end', 'rd'];

            try {
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh') 
                {
                    session()->forget('purchaseBalanceListInitialState');
                    
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
                            $req_data[str_replace('ReqVal', '', $key)] = $value;
                            unset($req_data[$key]);
                        }
                    }
                    
                    //remove comma from formatted value
                    //$str_to_int = ['support_amount'];
                    //foreach ($data_from_view as $key => $value) {
                    //    if (in_array($key, $str_to_int)) {
                    //        $data_from_view[$key] = str_replace(',', '', $data_from_view[$key]);
                    //    }
                    //}

                    $data = $this->removeDataFromView($data_from_view, $removeKeys);


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
                        return view('purchase.purchaseBalanceList.mainPurchaseBalanceList', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'pagi', 'deleted_item', 'buttonMessage'));
                    }

                    $query = AllPurchaseBalanceList::data($bango, $deleted_item,$req_data)->toSql();
                    //$data = QueryHelper::fetchResult($query);
                    //dd($data);
                    $purchaseBalanceListInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    if ($purchaseBalanceListInfo->items() == null && $purchaseBalanceListInfo->currentPage() != 1) {
                        $currentPage = ($purchaseBalanceListInfo->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $purchaseBalanceListInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    }
                    if ($purchaseBalanceListInfo->total() == 0) {
                        $exceedUser = '該当するデータがありません。';
                    } else {
                        $exceedUser = '';
                    }

                    //export excel
                    if ($data_from_view['Button'] == 'xls') {
                        $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                        $headers = $this->headers;
                        $excelName = '買掛・購入残高一覧.xlsx';
                        return $this->excelDownload($headers, $searched, $excelName);
                    }

                }
            } catch (\Exception $e) {
                $exceedUser = '検索形式が間違っています。';
                $purchaseBalanceListInfo = collect();
                $purchaseBalanceListInfo = $purchaseBalanceListInfo->paginate($pagination);
                return view('purchase.purchaseBalanceList.mainPurchaseBalanceList', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'purchaseBalanceListInfo', 'tantousya', 'deleted_item','exceedUser', 'buttonMessage','fsReqData'));
            }
            $sum_array['sum_of_kk0004'] = $purchaseBalanceListInfo->sum('kk0004');
            $sum_array['sum_of_kk0005'] = $purchaseBalanceListInfo->sum('kk0005');
            $sum_array['sum_of_purchase_discount'] = $purchaseBalanceListInfo->sum('purchase_discount');
            $sum_array['sum_of_kk0009'] = $purchaseBalanceListInfo->sum('kk0009');
            $sum_array['sum_of_kk0010'] = $purchaseBalanceListInfo->sum('kk0010');
            $sum_array['sum_of_kk0011'] = $purchaseBalanceListInfo->sum('kk0011');
            $sum_array['sum_of_payment_discount'] = $purchaseBalanceListInfo->sum('payment_discount');
            $sum_array['sum_of_kk0015'] = $purchaseBalanceListInfo->sum('kk0015');
            $sum_array['sum_of_kk0016'] = $purchaseBalanceListInfo->sum('kk0016');
            $sum_array['sum_of_kk0017'] = $purchaseBalanceListInfo->sum('kk0017');
            $sum_array['sum_of_kk0018'] = $purchaseBalanceListInfo->sum('kk0018');
            $sum_array['sum_of_kk0019'] = $purchaseBalanceListInfo->sum('kk0019');
            $sum_array['sum_of_kk0020'] = $purchaseBalanceListInfo->sum('kk0020');
            $sum_array['sum_of_prepaid_payment_discount'] = $purchaseBalanceListInfo->sum('prepaid_payment_discount');
            $sum_array['sum_of_kk0024'] = $purchaseBalanceListInfo->sum('kk0024');
            return view('purchase.purchaseBalanceList.mainPurchaseBalanceList', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'purchaseBalanceListInfo', 'tantousya', 'deleted_item','exceedUser', 'buttonMessage','req_data','fsReqData','sum_array'));
        }

        $headers = PurchaseBalanceListHeaders::headers_3();
        $table_headers = $headers;
        
        if($db_header->count() > 0){
            $kengenchar043 = $db_header[0]->kengenchar04;
            $kengenchar04Arr = explode("¶",$kengenchar04);
            foreach($kengenchar04Arr as $k=>$v){
                if($v != ""){
                    $tmp_k = explode("=",$kengenchar04Arr[$k])[0];
                    $tmp_v = explode("=",$kengenchar04Arr[$k])[1];
                    if($tmp_v == ""){
                        unset($headers[$tmp_k]);
                    }
                }
            }
        }
        
        if($initial_header == 0){
            unset($headers['前月末前払残高']);
            unset($headers['当月前払額']);
            unset($headers['当月前払消費税額']);
            unset($headers['当月前払現金支払額']);
            unset($headers['当月前払手形支払額']);
            unset($headers['前払支払値引他']);
            unset($headers['当月末前払残高']);
        }
        
        session()->put('purchaseBalanceListInitialState','yes');
        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;
        session()->forget('oldInput' . $bango);
        session()->forget('selected_radio_btn');
        return view('purchase.purchaseBalanceList.mainPurchaseBalanceList', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'pagi', 'deleted_item', 'buttonMessage'));
    }

    
    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $bango = $id;
        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $id)->where('kengenchar05', '06-06')->get()->count();
        $selected_radio_btn = session()->get('selected_radio_btn');
        $initial_status = session()->get('purchaseBalanceListInitialState');
        if($selected_radio_btn == 'rd_2'){
            $headers = [
                '購入先CD' => 'kk0002',
                '購入先名' => 'supplier_name',
                '前月未払残' => 'formatted_kk0004',
                '当月未払額' => 'formatted_kk0005',
                '購入値引他' => 'formatted_purchase_discount',
                '当月消費税' => 'formatted_kk0009',
                '現金振込' => 'formatted_kk0010',
                '手形' => 'formatted_kk0011',
                '支払値引他' => 'formatted_payment_discount',
                '当月未払残' => 'formatted_kk0015',
                '前月末前払残高' => 'formatted_kk0016',
                '当月前払額' => 'formatted_kk0017',
                '当月前払消費税額' => 'formatted_kk0018',
                '当月前払現金支払額' => 'formatted_kk0019',
                '当月前払手形支払額' => 'formatted_kk0020',
                '前払支払値引他' => 'formatted_prepaid_payment_discount',
                '当月末前払残高' => 'formatted_kk0024',
            ];
            $pageNo = PurchaseBalanceListHeaders::$page_no;
            $Setting = TableSetting::setting($headers, $id, $pageNo);
            if($initial_header == 0){
                $Setting['formatted_kk0016'] = "";
                $Setting['formatted_kk0017'] = "";
                $Setting['formatted_kk0018'] = "";
                $Setting['formatted_kk0019'] = "";
                $Setting['formatted_kk0020'] = "";
                $Setting['formatted_prepaid_payment_discount'] = "";
                $Setting['formatted_kk0024'] = "";
            }
            return $Setting;
        }elseif($initial_status == 'yes'){
            $db_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $bango)->where('kengenchar05', '06-06')->get();
            if($db_header->count() > 0){
                $kengenchar04 = $db_header[0]->kengenchar04;
                $kengenchar04Arr = explode("¶",$kengenchar04);
                $kengenchar04Arr[0] = '仕入先CD'.'='.explode("=",$kengenchar04Arr[0])[1];
                $kengenchar04Arr[1] = '仕入先'.'='.explode("=",$kengenchar04Arr[1])[1];
                $kengenchar04Arr[2] = '前月買掛未払残'.'='.explode("=",$kengenchar04Arr[2])[1];
                $kengenchar04Arr[3] = '当月買掛未払額'.'='.explode("=",$kengenchar04Arr[3])[1];
                $kengenchar04Arr[4] = '仕入購入値引等'.'='.explode("=",$kengenchar04Arr[4])[1];
                $kengenchar04Arr[5] = '当月消費税'.'='.explode("=",$kengenchar04Arr[5])[1];
                $kengenchar04Arr[6] = '現金振込'.'='.explode("=",$kengenchar04Arr[6])[1];
                $kengenchar04Arr[7] = '手形'.'='.explode("=",$kengenchar04Arr[7])[1];
                $kengenchar04Arr[8] = '支払値引他'.'='.explode("=",$kengenchar04Arr[8])[1];
                $kengenchar04Arr[9] = '当月買掛未払残'.'='.explode("=",$kengenchar04Arr[9])[1];
                $kengenchar04 = implode("¶",$kengenchar04Arr);
                $updateKengensettei = QueryHelper::fetchSingleResult("update kengensettei set kengenchar04 = '$kengenchar04' where kengenchar01 = 'col' and kengenchar03 = '$bango' and kengenchar05 = '06-06'");
                $headers = PurchaseBalanceListHeaders::headers_3();
            }else{
                $headers = PurchaseBalanceListHeaders::headers_3();
            }
            $pageNo = PurchaseBalanceListHeaders::$page_no;
            $Setting = TableSetting::setting($headers, $id, $pageNo);
            if($initial_header == 0){
                $Setting['formatted_kk0016'] = "";
                $Setting['formatted_kk0017'] = "";
                $Setting['formatted_kk0018'] = "";
                $Setting['formatted_kk0019'] = "";
                $Setting['formatted_kk0020'] = "";
                $Setting['formatted_prepaid_payment_discount'] = "";
                $Setting['formatted_kk0024'] = "";
            }
            return $Setting;
        }else{
            $pageNo = PurchaseBalanceListHeaders::$page_no;
            $Setting = TableSetting::setting($this->headers, $id, $pageNo);
            if($initial_header == 0){
                $Setting['formatted_kk0016'] = "";
                $Setting['formatted_kk0017'] = "";
                $Setting['formatted_kk0018'] = "";
                $Setting['formatted_kk0019'] = "";
                $Setting['formatted_kk0020'] = "";
                $Setting['formatted_prepaid_payment_discount'] = "";
                $Setting['formatted_kk0024'] = "";
            }
            return $Setting;
        }
    }

    public function tableSettingSave(Request $request, $id, $type = null)
    {
        $selected_radio_btn = session()->get('selected_radio_btn');
        $initial_status = session()->get('purchaseBalanceListInitialState');
        if($selected_radio_btn == 'rd_2'){
            $headers = [
                '購入先CD' => 'kk0002',
                '購入先名' => 'supplier_name',
                '前月未払残' => 'formatted_kk0004',
                '当月未払額' => 'formatted_kk0005',
                '購入値引他' => 'formatted_purchase_discount',
                '当月消費税' => 'formatted_kk0009',
                '現金振込' => 'formatted_kk0010',
                '手形' => 'formatted_kk0011',
                '支払値引他' => 'formatted_payment_discount',
                '当月未払残' => 'formatted_kk0015',
                '前月末前払残高' => 'formatted_kk0016',
                '当月前払額' => 'formatted_kk0017',
                '当月前払消費税額' => 'formatted_kk0018',
                '当月前払現金支払額' => 'formatted_kk0019',
                '当月前払手形支払額' => 'formatted_kk0020',
                '前払支払値引他' => 'formatted_prepaid_payment_discount',
                '当月末前払残高' => 'formatted_kk0024',
            ];
            $pageNo = PurchaseBalanceListHeaders::$page_no;
            TableSetting::settingSave($request, $id, $pageNo, $headers, '買掛・購入残高一覧', $type);
        }elseif($initial_status == 'yes'){
            $headers = PurchaseBalanceListHeaders::headers_3();
            $pageNo = PurchaseBalanceListHeaders::$page_no;
            TableSetting::settingSave($request, $id, $pageNo, $headers, '買掛・購入残高一覧', $type);
        }else{
            $pageNo = PurchaseBalanceListHeaders::$page_no;
            TableSetting::settingSave($request, $id, $pageNo, $this->headers, '買掛・購入残高一覧', $type);
        }
    }

    public function clearBottomReqData($request_data){
        $headers = [
            '仕入先CD' => 'kk0002',
            '仕入先名' => 'supplier_name',
            '前月買掛残' => 'formatted_kk0004',
            '当月買掛額' => 'formatted_kk0005',
            '仕入値引他' => 'formatted_purchase_discount',
            '当月消費税' => 'formatted_kk0009',
            '現金振込' => 'formatted_kk0010',
            '手形' => 'formatted_kk0011',
            '支払値引他' => 'formatted_payment_discount',
            '当月買掛残' => 'formatted_kk0015',
            '前月末前払残高' => 'formatted_kk0016',
            '当月前払額' => 'formatted_kk0017',
            '当月前払消費税額' => 'formatted_kk0018',
            '当月前払現金支払額' => 'formatted_kk0019',
            '当月前払手形支払額' => 'formatted_kk0020',
            '前払支払値引他' => 'formatted_prepaid_payment_discount',
            '当月末前払残高' => 'formatted_kk0024',
        ];
        foreach($request_data as $key=>$val){
            if (in_array($key, $headers)){
                $request_data[$key] = null;
            }
        }
        return $request_data;
    }
    
    public static function getCurrentTime(){
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        return str_replace(" ", "", $mytime);
    }

}
