<?php

namespace App\Http\Controllers\purchase;
use App\AllClass\master\nameMaster\allCategorykanri;
use Illuminate\Http\Request;
use App\tantousya;
use App\kengen;
//use App\categorykanri;
use App\requestTable;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\purchase\inventoryList\AllInventoryList;
use App\AllClass\purchase\inventoryList\inventoryListHeaders;
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

class InventoryListController extends Controller
{
    private $headers = [
        '部' => 'department',
        'グループ' => 'grouped_1',
        '仕入日' => 'purchase_date',
        '受注先' => 'contractor',
        '商品CD' => 'product_cd',
        '商品名' => 'product_name',
        '仕入金額' => 'formatted_inventory_purchase_amount',
        '売上予定日' => 'sales_date',
        '受注番号' => 'order_number',
        '受注区分' => 'order_classification_1',
        '発注区分' => 'order_classification_2',
        '仕入担当者' => 'purchase_person',
        '仕入番号' => 'purchase_number',
        '仕入行番号' => 'purchase_line_number',
        '仕入数量' => 'formatted_inventory_purchase_quantity',
        '仕入単価' => 'formatted_inventory_purchase_unit_price',
        '仕入先名' => 'supplier_name',
        '事業部' => 'division',
        '発注番号' => 'order_number_1',
        '発注行番号' => 'order_line_number',
        '会計科目' => 'accounting_subject',
        '会計内訳' => 'accounting_item',
        '支払課税区分' => 'payment_tax_classification',
        '仕入明細消費税額' => 'formatted_inventory_tax_amount',
        '明細備考' => 'detailed_remarks',
        '発注金額分類' => 'order_amount_classification',
        '仕入購入区分' => 'purchase_category'

    ];

    public function postInventoryList(Request $request)
    {
        
        $bango = request('userId');
        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $name = QueryHelper::select(['name'])->from('tantousya')->where("DeleteFlag = '0' ")->orderBy("bango asc")->get()->execute();       
        $buttonMessage = ButtonMsg::read($bango);
        $inventoryListData =collect([])->paginate(20);
        $headers = InventoryListHeaders::headers($bango);
        $table_headers = InventoryListHeaders::headers($bango, 'table_headers');
        $page_no = InventoryListHeaders::$page_no;
        $route = 'inventoryListTableSetting';
        $redirect_path = 'inventoryListReload';

        $data_from_view = $request->all();
        $data_from_view_session = $request->all();
        session()->put('oldInput' . $bango, $data_from_view);
        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 20;
        }
        $old = $request->all();
        $inventoryListError='';
        $inventoryListSuccess='';
        $temp_table = 'inventory_list_temp';
        // checking query
        // try {
        //     $query = AllInventoryList::readData($bango, $data_from_view);
        //     $data = collect(QueryHelper::fetchResult($query));
        //     dd($data);
        // }catch (Exception $e) {
        //     dd($e);
        // }
        // show page start here
        // $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;
        if (isset($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh')) {
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId'];
            try {
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh') {
                    //clear bottom search request data
                    if($data_from_view['Button'] == 'refresh'){
                        $data_from_view = self::clearBottomReqData($data_from_view);
                        $data_from_view["pagination"] = 20;
                        $old = $data_from_view;
                    }                    
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);
                    // if(($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'refresh') && $defalut_check == 0){
                    //     $pagi = 20;
                    //     $query = AllInventoryList::readData($bango, $data);
                    //     $inventoryListData = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    //     return view('sales.unpaidList.mainUnpaidList', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'pagi', 'deleted_item', 'buttonMessage','mode_selection', 'display_order','B9Data_left','B9Data_right','C1Data_left','C1Data_right','C2Data_left','C2Data_right','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','datachar05'));
                    // }                   
                    $query = AllInventoryList::readData($bango, $data);
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
                    $inventoryListData = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    // dd($data, $inventoryListData);
                    if ($inventoryListData->items() == null && $inventoryListData->currentPage() != 1) {
                        $currentPage = ($inventoryListData->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $inventoryListData = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    }                    
                    
                    if ($inventoryListData->total() == 0) {
                        $inventoryListError = '該当するデータがありません。';
                    } else {
                        $inventoryListError = '';
                    }

                    //export excel
                    if ($data_from_view['Button'] == 'xls') {
                        $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                        $headers = $this->headers;
                        $excelName = '在庫一覧.xlsx';
                        return $this->excelDownload($headers, $searched, $excelName);
                    }

                }
            } catch (\Exception $e) {
                // dd($e);
                $inventoryListError = '該当するデータがありません。';
                $inventoryListData = collect();
                $inventoryListData = $inventoryListData->paginate($pagination);                
                return view('purchase.inventoryList.mainInventoryList',compact('bango','headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'name', 'inventoryListData', 'buttonMessage', 'old', 'inventoryListError'));
            }
            // dd($inventoryListData);
            return view('purchase.inventoryList.mainInventoryList',compact('bango','headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'name', 'inventoryListData', 'buttonMessage', 'old', 'inventoryListError'));
        }
        // $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;
        // session()->forget('oldInput' . $bango);
        return view('purchase.inventoryList.mainInventoryList',compact('bango','headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'name', 'inventoryListData', 'buttonMessage', 'old', 'inventoryListError'));
    }
    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = InventoryListHeaders::$page_no;
        return $Setting = TableSetting::setting($this->headers, $id, $pageNo);
    }

    public function tableSettingSave(Request $request, $id, $bango, $type = null)
    {
        $pageNo = InventoryListHeaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '在庫一覧', $type);
    }
    public function clearBottomReqData($request_data){
        $headers = [
            '部' => 'department',
            'グループ' => 'grouped_1',
            '仕入日' => 'purchase_date',
            '受注先' => 'contractor',
            '商品CD' => 'product_cd',
            '商品名' => 'product_name',
            '仕入金額' => 'inventory_purchase_amount',
            '売上予定日' => 'sales_date',
            '受注番号' => 'order_number',
            '受注区分' => 'order_classification_1',
            '発注区分' => 'order_classification_2',
            '仕入担当者' => 'purchase_person',
            '仕入番号' => 'purchase_number',
            '仕入行番号' => 'purchase_line_number',
            '仕入数量' => 'inventory_purchase_quantity',
            '仕入単価' => 'inventory_purchase_unit_price',
            '仕入先名' => 'supplier_name',
            '事業部' => 'division',
            '発注番号' => 'order_number_1',
            '発注行番号' => 'order_line_number',
            '会計科目' => 'accounting_subject',
            '会計内訳' => 'accounting_item',
            '支払課税区分' => 'payment_tax_classification',
            '仕入明細消費税額' => 'inventory_tax_amount',
            '明細備考' => 'detailed_remarks',
            '発注金額分類' => 'order_amount_classification',
            '仕入購入区分' => 'purchase_category'
        ];
        foreach($request_data as $key=>$val){
            if (in_array($key, $headers)){
                $request_data[$key] = null;
            }
        }
        return $request_data;
    }
}