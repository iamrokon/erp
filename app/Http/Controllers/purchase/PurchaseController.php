<?php

namespace App\Http\Controllers\purchase;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\master\productDescription\AllProductDescription;
use App\AllClass\master\productMaster\allProduct;
use App\AllClass\master\productSubMaster\allOthers;
use App\AllClass\purchase\hatchuNyuryoku\AllNumberSearch;
use App\AllClass\order\orderEntry\AllOrderProductSubs;
use App\AllClass\order\orderEntry\OrderEntry;
use App\AllClass\purchase\hatchuNyuryoku\orderDetail;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\AllClass\order\orderEntry\searchCompany;
use App\AllClass\order\orderEntry\searchCompany2;
use App\AllClass\order\orderEntry\searchCompany3;
use App\tantousya;
use Exception;
use Illuminate\Support\Facades\Session;
use mysql_xdevapi\Collection;
use Illuminate\Support\Facades\Validator;
use App\AllClass\purchase\hatchuNyuryoku\PurchaseCreateValidation;
use App\AllClass\purchase\hatchuNyuryoku\PurchaseEntry;
// use App\AllClass\common\CreateOrderEntryAndHatchuData;

class PurchaseController extends Controller
{
    public function index(){
        $bango = request('userId');
        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $ztanka = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7501'")->orderbango;
        $name = QueryHelper::select(['name'])->from('tantousya')->where("DeleteFlag = '0' ")->where("mail5 != '' ")->where("ztanka = '$ztanka' ")->orderBy("bango asc")->get()->execute();
        // $name = QueryHelper::select(['name'])->from('tantousya')->where("DeleteFlag = '0' ")->orderBy("bango asc")->get()->execute();
        $categorykanriesU1 = DB::table('categorykanri')->where('category1', 'V4')
            ->whereIn('category2', ['10','40','60','70'])
            ->select('category1', 'category2', 'category4')
            ->orderBy('suchi1')
            ->get();
        $color = '0502作成区分';
        $request1s = QueryHelper::select(['syouhinbango', 'jouhou'])->from('request')->where("color = '0502作成区分'")->orderBy("bango asc")->get()->execute();
        $A9Data = QueryHelper::fetchResult("select category1,category2,category4 from categorykanri where category1 = 'U8' and suchi2 = 0 ORDER BY category2 ASC");
        $U2Data = QueryHelper::fetchResult("select category1,category2,category4 from categorykanri where category1 = 'D9' and suchi2 = 0 ORDER BY category2 ASC");
        $U3Data = QueryHelper::fetchResult("select category1,category2,category4 from categorykanri where category1 = 'D8' and suchi2 = 0 ORDER BY category2 ASC");
        
        $c4Categorykanries = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'C4' and suchi2 = 0 order by suchi1 ASC ");
        $siharaikazeikubun = QueryHelper::fetchResult("select category1,category2,category4 from categorykanri where category1 = 'E1'");
        // $name = DB::table('tantousya')->where('deleteflag', '0')->select('name')->get();
        // return $name;
        //$categorykanries = QueryHelper::select(['category2', 'category4'])->from('categorykanri')->where("category1='V4'")->get()->execute();
        // return $tantousya;
        
        return view('purchase.hatchuNyuryoku.mainHatchuNyuryoku',compact('bango', 'tantousya', 'name', 'categorykanriesU1','request1s', 'A9Data', 'U2Data', 'U3Data','c4Categorykanries', 'siharaikazeikubun'));
    }

    public function handleCategoriKanries(Request $request)
    {
        $categoryType = request('category_type') ? trim(\request('category_type')) : null;
        $categoryValue = request('category_value') ? trim(\request('category_value')) : null;
        if ($categoryType == "C4") {
            $C5html = OrderEntry::renderCategoryKanri(2, $categoryValue, 'C5');
            $C6html = OrderEntry::renderCategoryKanri(2, $categoryValue, 'maljabena');
            $E7html = OrderEntry::renderCategoryKanri(2, $categoryValue, 'E7');
            $E6html = OrderEntry::renderCategoryKanri(2, $categoryValue, 'E6');
            return response()->json(["status" => "view rendered", "html" => ['C5html' => $C5html, 'C6html' => $C6html, 'E7html' => $E7html, 'E6html' => $E6html]]);
        } elseif ($categoryType == "C6") {
        } elseif ($categoryType == "C5") {
            $C6html = OrderEntry::renderCategoryKanri(4, $categoryValue, 'C6');
            return response()->json(["status" => "view rendered", "html" => ['C6html' => $C6html]]);
        }
    }

    public function generateCategoryWiseTable(Request $request)
    {
        $newRequest = $request->all();
        foreach ($newRequest as $key => $val) {
            if ($val == "" || $val == "null" || $val == null) {
                $newRequest[$key] = null;
            }
        }
        $newRequest = (object)$newRequest;
        //dd($newRequest);
        $jouhou = str_replace(' ', '', $newRequest->jouhou);
        $koyuujouhou = str_replace(' ', '', $newRequest->koyuujouhou);
        $color = str_replace(' ', '', $newRequest->color);
        $bumon = str_replace(' ', '', $newRequest->bumon);
        $jouhou2 = str_replace(' ', '', $newRequest->jouhou2);
        $reg_sold_to = substr($newRequest->reg_sold_to, 0, 6);


        $querystring = " select distinct syouhin1.*, syouhin2.jouhou2 as newjouou2, syouhin4.color as newcolor4
                        from syouhin1
                        join syouhin2 on syouhin2.bango = syouhin1.bango
                        join syouhin4 on syouhin4.bango = syouhin1.bango where syouhin1.jouhou = '$jouhou' ";
        if ($koyuujouhou) {
            $querystring .= " and syouhin1.koyuujouhou = '$koyuujouhou' ";
        }
        if ($color) {
            $querystring .= " and syouhin1.color = '$color' ";
        }

        if ($bumon) {
            $querystring .= " and syouhin1.bumon = '$bumon'  ";
        }

        if ($jouhou2) {
            $querystring .= " and syouhin2.jouhou2 = '$jouhou2' ";
        }
        $companyExistQuery = " select bango from syouhin1 where syouhin1.data20 = '$reg_sold_to'";
        if (count(QueryHelper::fetchResult($companyExistQuery))) {
            $querystring .= "  and (syouhin1.data20 = '$reg_sold_to' or syouhin1.data20 IS NULL)";
        } else {
            $querystring .= " and syouhin1.data20 is null";
        }
        $querystring .= " and syouhin1.data29 != 'F62' and syouhin1.data52 != 'C710' and syouhin1.isuriage = 0 order by syouhin1.kokyakusyouhinbango limit 30 ";

        //$querystring .= " and syouhin1.data29 = 'F61'  and  syouhin1.isuriage = 0 order by syouhin1.kokyakusyouhinbango limit 30 ";


        $syouhinDatas = QueryHelper::fetchResult($querystring);

        //        $syouhins = array_map(function ($item) {
        //            $category1 = mb_substr($item->url, 0, 2);
        //            $category2 = mb_substr($item->url, 2, 1);
        //            $url = QueryHelper::fetchSingleResult("select * from categorykanri where category1 = '$category1'  and category2 = '$category2' and suchi2 = 0 ");
        //            //$url = QueryHelper::fetchSingleResult("select category1,category2,suchi2,category4 from categorykanri where category1 = '$category1'  and category2 = '$category2' and suchi2 = 0 ");
        //            $item->url = $url ? $url->category2 . " " . $url->category4 : '';
        //            return $item;
        //        }, $syouhinDatas);

        $syouhin1s = array_map(function ($item) {
            $data100 = QueryHelper::fetchSingleResult("select data100 from syouhin1 where bango = '$item->bango' ")->data100 ?? null;
            if ($data100 == "D160") {
                //$syouhin4 = QueryHelper::fetchResult("select bango from syouhin4 where chardata4 = '$item->bango' and dspbango is not null") ?? [];
                $syouhin4 = QueryHelper::fetchResult("select bango from syouhin4 where chardata4 = '$item->kokyakusyouhinbango' and dspbango is not null") ?? [];
                if ($syouhin4) {
                    $syouhin4Data = [];
                    array_map(function ($item) use (&$syouhin4Data) {
                        array_push($syouhin4Data, $item->bango);
                    }, $syouhin4);
                    $syouhin4 = implode(',', $syouhin4Data);
                    $expected_result = QueryHelper::fetchResult("select syouhin1.kokyakusyouhinbango, syouhin1.name, syouhin1.tokuchou ,syouhin1.data22,syouhin1.data51,syouhin1.url,syouhin1.kongouritsu,syouhin1.mdjouhou,syouhin4.dspbango,syouhin4.color as newcolor4 from syouhin1,syouhin4 where syouhin1.bango in ($syouhin4) and syouhin1.bango=syouhin4.bango ") ?? [];
                    //$countExpectedResult = QueryHelper::fetchSingleResult("select count(syouhin1.bango) from syouhin1,syouhin4 where syouhin1.bango in ($syouhin4) and syouhin1.bango=syouhin4.bango")->count ?? 0;
                    $countExpectedResult = QueryHelper::fetchSingleResult("select count(syouhin1.*) from syouhin1,syouhin4 where syouhin1.bango in ($syouhin4) and syouhin1.bango=syouhin4.bango")->count ?? 0;
                    //                    $expected_result = collect($expected_result)->map(function ($item, $key) {
                    //                        $category1 = mb_substr($item->url, 0, 2);
                    //                        $category2 = mb_substr($item->url, 2, 1);
                    //                        //$url = QueryHelper::fetchSingleResult("select  category1,category2,suchi2,category4 from categorykanri where category1 = '$category1'  and category2 = '$category2' and suchi2 = 0 ");
                    //                        $url = QueryHelper::fetchSingleResult("select * from categorykanri where category1 = '$category1'  and category2 = '$category2' and suchi2 = 0 ");
                    //                        $item->url = $url ? $url->category2 . " " . $url->category4 : null;
                    //                        return $item;
                    //                    })->toArray();
                    $item->set_product_data = json_encode($expected_result, JSON_UNESCAPED_UNICODE);
                    $item->countChild = $countExpectedResult;
                    $item->status = "parent_with_dsbango";
                } else {
                    $item->set_product_data = null;
                    $item->countChild = 0;
                    $item->status = "parent_without_dsbango";
                }
            } else {
                $item->set_product_data = null;
                $item->countChild = 0;
                $item->status = "normal_product";
            }
            return $item;
        }, $syouhinDatas);

        $html = view('purchase.hatchuNyuryoku.include.product.partial', compact('syouhin1s'))->render();
        return response()->json(['status' => 'view render', 'html' => $html, 'syouhin1s' => $syouhin1s]);
    }

    public function save(Request $request, $bango)
    {   
        // CreateOrderEntryAndHatchuData::data();
        // $file = $request->file('filename');
        // return PurchaseEntry::create($request, $bango, $file);  
        // start from here
        $file = $request->file('purchase_order');
        if (request('creation_category') == '1') {

            $insert = PurchaseEntry::create($request, $bango, $file);
            if (is_array($insert) && $insert['status'] == 'ok') {
                //                Session::flash('success_msg', 'Order inserted successfully');
                return $insert;
            } else if (is_array($insert) && $insert['status'] == 'confirm') {
                return $insert;
            } else if (is_array($insert) && $insert['status'] == 'ng') {
                return $insert;
            } else {
                $errors = $insert->all();
                return ['err_field' => $insert, 'err_msg' => $errors];
            }
        }
        if (request('creation_category') == '2') {

            $update = PurchaseEntry::edit($request, $bango, $file);

            if (is_array($update) && $update['status'] == 'ok') {
                //                Session::flash('success_msg', 'Order updated successfully ');
                return $update;
            } else if (is_array($update) && $update['status'] == 'confirm') {
                return $update;
            } else if (is_array($update) && $update['status'] == 'ng') {
                return $update;
            } else {
                $errors = $update->all();
                return ['err_field' => $update, 'err_msg' => $errors, 'type_message' => "受注番号が選択されていません。"];
            }
        }
        if (request('creation_category') == '3') {

            $update = PurchaseEntry::deleteOrder($request, $bango, $file);

            if (is_array($update) && $update['status'] == 'ok') {
                //                Session::flash('success_msg', 'Order deleted successfully ');
                return $update;
            } else if (is_array($update) && $update['status'] == 'confirm') {
                return $update;
            } else if (is_array($update) && $update['status'] == 'ng') {
                return $update;
            } else {
                $errors = $update->all();
                return ['err_field' => $update, 'err_msg' => $errors, 'type_message' => "受注番号が選択されていません。"];
            }
        }     
    }
    public function handleNumberSearch(Request $request)
    {
        $bango = request('userId');
        $tantousya = null;
        $radioButton = $request->rd1 ?? null;
        //QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        if($radioButton == 'rd1'){
            $data_from_view = $request->all();
            $data_from_view_session = $request->all();
            session()->put('oldInput' . $bango, $data_from_view_session);
            $pagination = 10;
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'rd1', 'category_kanri_def', 'request_def', 'contractor_id', 'supplier_id', 'reg_end_customer_db'];
            $query = AllNumberSearch::data($bango, '', $request)->toSql();
            //return response()->json(["status" => $query]);
            $temp_table = "all_number_search_temp";
            if (!empty($data_from_view['Button']) && $data_from_view['Button'] == 'refresh') {
                session()->forget('oldInput' . $bango);
                $query = AllNumberSearch::data($bango, 'refresh', $request)->toSql();
                $numberSearches = collect(QueryHelper::fetchResult($query));
                $numberSearches = $this->filterByMisyukko($numberSearches);
                $numberSearches = $this->getFilteredQuery($numberSearches, $pagination);
                $html = view('purchase.hatchuNyuryoku.include.number_search.partial', compact('numberSearches', 'bango', 'tantousya'))->render();
                return response()->json(["status" => "view rendered", "html" => $html, "numberSearches" => $numberSearches]);
            }
            if (!empty($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort')) {
                try {
                    $query = AllNumberSearch::data($bango, 'search', $request)->toSql();
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);
                    $numberSearches = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'order_entry');
                    $numberSearches = $this->filterByMisyukko($numberSearches);
                    $numberSearches = $this->getFilteredQuery($numberSearches, $pagination);
                    if ($numberSearches->items() == null && $numberSearches->currentPage() != 1) {
                        $currentPage = ($numberSearches->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $numberSearches = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'order_entry');
                        $numberSearches = $this->filterByMisyukko($numberSearches);
                        $numberSearches = $this->getFilteredQuery($numberSearches, $pagination);
                    }
                } catch (\Exception $e) {
                    dd($e);
                }
                $html = view('purchase.hatchuNyuryoku.include.number_search.partial', compact('numberSearches', 'bango', 'tantousya'))->render();
                return response()->json(["status" => "view rendered", "html" => $html, "numberSearches" => $numberSearches]);
            }
            $numberSearches = collect(QueryHelper::fetchResult($query));
            $numberSearches = $this->filterByMisyukko($numberSearches);
            $numberSearches = $this->getFilteredQuery($numberSearches, $pagination);
            $html = view('purchase.hatchuNyuryoku.include.number_search.partial', compact('numberSearches', 'bango', 'tantousya'))->render();
            return response()->json(["status" => "view rendered", "html" => $html, "numberSearches" => $numberSearches]);
            
        }else if($radioButton == 'rd2'){
            $data_from_view = $request->all();
            $data_from_view_session = $request->all();
            session()->put('oldInput' . $bango, $data_from_view_session);
            $pagination = 10;
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'rd1', 'category_kanri_def', 'request_def','contractor_id', 'supplier_id', 'reg_end_customer_db'];
            $query = AllNumberSearch::dataForRadioButton($bango, '', $request)->toSql();
            //return response()->json(["status" => $query]);
            $temp_table = "all_number_search_temp";
            if (!empty($data_from_view['Button']) && $data_from_view['Button'] == 'refresh') {
                session()->forget('oldInput' . $bango);
                $query = AllNumberSearch::dataForRadioButton($bango, 'refresh', $request)->toSql();
                $numberSearches = collect(QueryHelper::fetchResult($query));
                // $numberSearches = $this->filterByMisyukko($numberSearches);
                $numberSearches = $this->getFilteredQuery($numberSearches, $pagination);
                $html = view('purchase.hatchuNyuryoku.include.number_search.partial', compact('numberSearches', 'bango', 'tantousya'))->render();
                return response()->json(["status" => "view rendered", "html" => $html]);
            }
            if (!empty($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort')) {
                try {
                    $query = AllNumberSearch::dataForRadioButton($bango, 'search', $request)->toSql();
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);
                    $numberSearches = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'order_entry');
                    // $numberSearches = $this->filterByMisyukko($numberSearches);
                    $numberSearches = $this->getFilteredQuery($numberSearches, $pagination);
                    if ($numberSearches->items() == null && $numberSearches->currentPage() != 1) {
                        $currentPage = ($numberSearches->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $numberSearches = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'order_entry');
                        // $numberSearches = $this->filterByMisyukko($numberSearches);
                        $numberSearches = $this->getFilteredQuery($numberSearches, $pagination);
                    }
                } catch (\Exception $e) {
                    dd($e);
                }
                $html = view('purchase.hatchuNyuryoku.include.number_search.partial', compact('numberSearches', 'bango', 'tantousya'))->render();
                return response()->json(["status" => "view rendered", "html" => $html]);
            }
            $numberSearches = collect(QueryHelper::fetchResult($query));
            // $numberSearches = $this->filterByMisyukko($numberSearches);
            $numberSearches = $this->getFilteredQuery($numberSearches, $pagination);
            $html = view('purchase.hatchuNyuryoku.include.number_search.partial', compact('numberSearches', 'bango', 'tantousya'))->render();
            return response()->json(["status" => "view rendered", "html" => $html]);
        }
    }

    public function numberSearchModalOpen(Request $request, $bango)
    {   
        $supplierName = $request->supplier ?? null;
        session()->forget('oldInput' . $bango);
        try {
            $bango = $request->bango;
            $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();           
            if(($request->data102 == "1 新規作成" && $request->request_def == "1" && $request->category_kanri_def != "V470")){
                $query = AllNumberSearch::data($bango, '', $request)->toSql();
                $numberSearches = collect(QueryHelper::fetchResult($query));
                $numberSearches = $this->filterByMisyukko($numberSearches);
                $numberSearches = $this->getFilteredQuery($numberSearches, 10);
            } else{
                $query = AllNumberSearch::dataForRadioButton($bango, '', $request)->toSql();
                $numberSearches = collect(QueryHelper::fetchResult($query));
                //$numberSearches = $this->filterByMisyukko($numberSearches);
                $numberSearches = $this->getFilteredQuery($numberSearches, 10);
            } 
            //For checking Misyukko tabale condition Just
            // $query1 = AllNumberSearch::dataTest($bango, '', $request)->toSql();
            // $Datas = QueryHelper::fetchResult($query1);
            $html = view('purchase.hatchuNyuryoku.include.number_search.partial', compact('numberSearches', 'bango', 'tantousya', 'supplierName'))->render();
            return response()->json(["status" => "view rendered", "html" => $html]);
        } catch (Exception $e) {
            dd($e);
        }
    }
    public function orderDetailRead(Request $request, $bango)
    {

        $orderId = request('order_id');
        $supplierId = request('supplier_id') ?? null;
        $orderIdFlag = substr($orderId, 0, 2);
        // $review = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7501'")->orderbango ?? null;
        // $check4digit = "01" . $review;
        // $check4digit2 = "03" . $review;
        if ($orderIdFlag == "01"){
            $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
            $query = orderDetail::data($bango, $orderId);
            $dataint01 = QueryHelper::fetchSingleResult("select max(dataint01) from misyukko where syouhinid = '$orderId' ")->max ?? 0;
            $bango = $bango;
            $orderDetail = collect(QueryHelper::fetchSingleResult($query));
            $condition = "where misyukko.syouhinid = '$orderId'  and misyukko.yoteimeter = '0' and misyukko.datachar13 != '2' and (misyukko.datachar22 is null or misyukko.datachar22 like '___0') and misyukko.dataint01 = '$dataint01'";
            if($supplierId){
                $condition .= "and misyukko.datachar05 = '$supplierId'";
            }
            $products = QueryHelper::fetchResult("select
                distinct
                juchusyukko.datachar03 as juchusyukko_check,
                misyukko.*,
                syouhin1.data24 as syouhin1Data24,
                syouhin1.kakaku as syouhin1Kakaku,
                to_char(misyukko.dataint11,'FM999,999,999') as dataint11,
                to_char(misyukko.dataint12,'FM999,999,999') as dataint12,
                misyukko.datachar03 as  boss,
                CASE
                WHEN misyukko.dataint09 IS NULL THEN NULL
                ELSE
                concat_ws('/',substring(CAST(misyukko.dataint09 as text),1,4),
                substring(CAST(misyukko.dataint09 as text),5,2),
                substring(CAST(misyukko.dataint09 as text),7,2))
                END as dataint09 ,
                CASE
                WHEN misyukko.dataint10 IS NULL THEN NULL
                ELSE
                concat_ws('/',substring(CAST(misyukko.dataint10 as text),1,4),
                substring(CAST(misyukko.dataint10 as text),5,2),
                substring(CAST(misyukko.dataint10 as text),7,2))
                END as yoteibi,
                misyukko.dataint08 as partitionUnitPrice,
                misyukko.datachar07 as comment


                from misyukko

                left join juchusyukko
                    on juchusyukko.syouhinid=misyukko.syouhinid
                    and juchusyukko.syouhinsyu=misyukko.syouhinsyu
                    and juchusyukko.hantei=misyukko.hantei
                left join syouhin1
                    on syouhin1.kokyakusyouhinbango = misyukko.kawasename
                $condition order by misyukko.dataint02");

            $ztanka = QueryHelper::fetchSingleResult("select kokyakusyouhinbango,orderbango from review where  kokyakusyouhinbango = 'D7501'")->orderbango ?? 0;
            $tantoushaQuery = "select bango,name,deleteflag,ztanka,innerlevel from tantousya where deleteflag = 0 and innerlevel >= 10 and innerlevel <= 20  ";
            $ztanka = (int) $ztanka;
            $tantoushaQuery .= $ztanka ? "and  ztanka = $ztanka " : " ";
            $tantoushaQuery .= "order by bango";
            $sales = QueryHelper::fetchResult($tantoushaQuery);
            $ses = QueryHelper::fetchResult($tantoushaQuery);
            $maintains = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'E9' and  suchi2 = '0'   order by bango  ");
            $siharaikazeikubun = QueryHelper::fetchResult("select category1, category2,category4 from categorykanri where category1 = 'E1'");
            $html = view('purchase.hatchuNyuryoku.hatchuNyuryokuMainContent', compact('products', 'sales', 'ses', 'bango', 'tantousya', 'maintains', 'siharaikazeikubun'))->render();
            $hasOrderDetail = $orderDetail->count();
            return (['orderDetail' => $orderDetail, 'html' => $html, 'products' => $products, 'hasOrder' => $hasOrderDetail]);
        } else if($orderIdFlag == "03"){
            $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
            $query = orderDetail::dataForRadioButton($bango, $orderId);

            $bango = $bango;
            $orderDetail = collect(QueryHelper::fetchSingleResult($query));
            $zaikoMeter = QueryHelper::fetchSingleResult("select max(zaikometer) from minyuko where syouhinid = '$orderId' ")->max ?? 0;
            $products = QueryHelper::fetchResult("select
                distinct
                juchusyukko2.datachar03 as juchusyukko_check,
                minyuko.*,
                minyuko.datachar02 as kawasename,
                minyuko.kingaku as syouhin1Kakaku,
                to_char(minyuko.yoteibi,'YYYY/MM/DD') as yoteibi,
                to_char(minyuko.kanryoubi,'YYYY/MM/DD') as kanryoubi,
                minyuko.datachar03 as  datachar04,
                minyuko.datachar07 as datachar03,
                minyuko.nyukosu as syukkasu,
                minyuko.kaiinid as datachar06,
                minyuko.yoteimeter as syouhinsyu,
                minyuko.nyukometer as hantei,
                minyuko.idoutanabango as syouhinid,
                minyuko.datachar12 as genchoujikan,
                minyuko.datachar11 as comment,
                minyuko.genka as partitionUnitPrice,
                tantousya.name as houseEntry
                from minyuko
                left join tantousya on minyuko.datachar14 = tantousya.bango
                left join juchusyukko2
                    on juchusyukko2.syouhinid=minyuko.syouhinid
                    and juchusyukko2.syouhinsyu=minyuko.syouhinsyu
                    and juchusyukko2.hantei=minyuko.hantei
                where minyuko.syouhinid = '$orderId'  and minyuko.zaikometer = '$zaikoMeter'  order by minyuko.dataint02");

            $ztanka = QueryHelper::fetchSingleResult("select kokyakusyouhinbango,orderbango from review where  kokyakusyouhinbango = 'D7501'")->orderbango ?? 0;
            $tantoushaQuery = "select bango,name,deleteflag,ztanka,innerlevel from tantousya where deleteflag = 0 and innerlevel >= 10 and innerlevel <= 20  ";
            $ztanka = (int) $ztanka;
            $tantoushaQuery .= $ztanka ? "and  ztanka = $ztanka " : " ";
            $tantoushaQuery .= "order by bango";
            $sales = QueryHelper::fetchResult($tantoushaQuery);
            $ses = QueryHelper::fetchResult($tantoushaQuery);
            $maintains = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'E9' and  suchi2 = '0'   order by bango  ");
            $siharaikazeikubun = QueryHelper::fetchResult("select category1, category2,category4 from categorykanri where category1 = 'E1'");
            $html = view('purchase.hatchuNyuryoku.hatchuNyuryokuMainContent', compact('products', 'sales', 'ses', 'bango', 'tantousya', 'maintains', 'siharaikazeikubun'))->render();
            $hasOrderDetail = $orderDetail->count();
            return (['orderDetail' => $orderDetail, 'html' => $html, 'products' => $products, 'hasOrder' => $hasOrderDetail]);
        }
    }

    // Support Number Search
    public function handleSupportNumberSearch(Request $request)
    {
        $bango = request('userId');
        $tantousya = null;
        $data_from_view = $request->all();
        $data_from_view_session = $request->all();
        session()->put('oldInput' . $bango, $data_from_view_session);
        $pagination = 10;
        $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'rd1', 'category_kanri_def', 'request_def','contractor_id', 'supplier_id', 'reg_end_customer_db'];
        $query = AllNumberSearch::dataForSupport($bango, '', $request)->toSql();
        $temp_table = "all_number_search_temp";
        if (!empty($data_from_view['Button']) && $data_from_view['Button'] == 'refresh') {
            session()->forget('oldInput' . $bango);
            $query = AllNumberSearch::dataForSupport($bango, 'refresh', $request)->toSql();
            $numberSearches = collect(QueryHelper::fetchResult($query))->paginate($pagination);
            $html = view('purchase.hatchuNyuryoku.include.supportNumberSearch.partial', compact('numberSearches', 'bango', 'tantousya'))->render();
            return response()->json(["status" => "view rendered", "html" => $html]);
        }
        if (!empty($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort')) {
            try {
                $query = AllNumberSearch::dataForSupport($bango, 'search', $request)->toSql();

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
            $html = view('purchase.hatchuNyuryoku.include.supportNumberSearch.partial', compact('numberSearches', 'bango', 'tantousya'))->render();
            return response()->json(["status" => "view rendered", "html" => $html]);
        }
        $numberSearches = collect(QueryHelper::fetchResult($query))->paginate($pagination);
        $html = view('purchase.hatchuNyuryoku.include.supportNumberSearch.partial', compact('numberSearches', 'bango', 'tantousya'))->render();
        return response()->json(["status" => "view rendered", "html" => $html]);
    }

    public function supportNumberSearchModalOpen(Request $request, $bango)
    {
        session()->forget('oldInput' . $bango);
        try {
            $bango = $request->bango;
            $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
            $query = AllNumberSearch::dataForSupport($bango, '', $request)->toSql();

            $numberSearches = collect(QueryHelper::fetchResult($query));
            // $numberSearches = $this->filterByMisyukko($numberSearches);
            $numberSearches = $this->getFilteredQuery($numberSearches, 10);
            $html = view('purchase.hatchuNyuryoku.include.supportNumberSearch.partial', compact('numberSearches', 'bango', 'tantousya'))->render();
            return response()->json(["status" => "view rendered", "html" => $html, "numberSearches" => $numberSearches]);
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function supportOrderDetailRead(Request $request, $bango)
    {

        $orderId = request('order_id');
        $syouhinid = substr($orderId, 0, 10);
        $syouhinsyu =substr($orderId, 10, 3);
        // dd($syouhinid, $syouhinsyu);
        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $query = orderDetail::dataForSupport($bango, $syouhinid, $orderId);
        $orderDetail = collect(QueryHelper::fetchSingleResult($query));
        $zaikoMeter = QueryHelper::fetchSingleResult("select max(zaikometer) from minyuko where syouhinid = '$syouhinid' and syouhinsyu = '$syouhinsyu' ")->max ?? 0;
        $products = QueryHelper::fetchResult("select
            distinct
            juchusyukko2.datachar03 as juchusyukko_check,
            minyuko.*,
            minyuko.datachar02 as kawasename,
            minyuko.kingaku as syouhin1Kakaku,
            to_char(minyuko.yoteibi,'YYYY/MM/DD') as yoteibi,
            to_char(minyuko.kanryoubi,'YYYY/MM/DD') as kanryoubi,
            minyuko.datachar07 as datachar03,
            minyuko.datachar08 as datachar04,
            minyuko.nyukosu as syukkasu,
            minyuko.kaiinid as datachar06,
            minyuko.yoteimeter as syouhinsyu,
            minyuko.nyukometer as hantei,
            minyuko.idoutanabango as syouhinid,
            minyuko.datachar12 as genchoujikan,
            minyuko.datachar09 as comment,
            minyuko.genka as partitionUnitPrice,
            tantousya.name as houseEntry
            from minyuko
            left join tantousya on minyuko.datachar14 = tantousya.bango
            left join juchusyukko2
                on juchusyukko2.syouhinid=minyuko.syouhinid
                and juchusyukko2.syouhinsyu=minyuko.syouhinsyu
                and juchusyukko2.hantei=minyuko.hantei
            where minyuko.syouhinid = '$syouhinid' and minyuko.syouhinsyu = '$syouhinsyu'  and minyuko.zaikometer = '$zaikoMeter' and minyuko.denpyobango = 0 order by minyuko.dataint02");
        $maintains = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'E9' and  suchi2 = '0'   order by bango  ");
        $siharaikazeikubun = QueryHelper::fetchResult("select category1, category2,category4 from categorykanri where category1 = 'E1'");
        $html = view('purchase.hatchuNyuryoku.hatchuNyuryokuMainContent', compact('products', 'bango', 'tantousya', 'maintains', 'siharaikazeikubun'))->render();
        $hasOrderDetail = $orderDetail->count();
        return (['orderDetail' => $orderDetail, 'html' => $html, 'products' => $products, 'hasOrder' => $hasOrderDetail]);
    }

    // Transaction 
    public function contractWiseTradingCondition($bango)
    {
        $contractorId = \request('contractorId');
        $yobi12 = substr($contractorId, 0, 6);
        $torihikisakibango = substr($contractorId, 6, 2);
        $haisou = QueryHelper::fetchSingleResult("select * from haisou where torihikisakibango = '$torihikisakibango' and shikibetsucode = '$yobi12'  and kounyusu = 0 ");
        $companyData = QueryHelper::fetchSingleResult("select * from kokyaku1 where yobi12 = '$yobi12' and denpyosaiban = 0 ");
        $haisouBango = $haisou->bango ?? null;
        $companyBango = $companyData->bango ?? null;
        $paymentMethod = null;
        $immediateClassification = null;
        $acceptanceConditions = null;
        $mail = null;
        $siharaikazeikubun = null;
        $siharaizeihasuukubun = null;
        $other1 = null;
        if ($haisouBango) {
            $other2 = QueryHelper::fetchSingleResult("select * from others2 where otherInt1 = $haisouBango");
            $other1 = $other2->other1 ?? null;
            if ($other1) {
                if ($other1 == '1 会社M') {
                    // $paymentMethod = $companyData->ytoiawseend ?? null;
                    // $immediateClassification = explode(' ', $companyData->kcode3)[0] ?? null;
                    $haisoujouhou = QueryHelper::fetchSingleResult("select * from haisoujouhou where syukei1 = $companyBango");
                    $bunrui3 = $haisoujouhou->bunrui3 ?? null;
                    $tel = $haisoujouhou->tel ?? null;
                    $sex = $haisoujouhou->sex ?? null;
                    $mail= $haisoujouhou->mail ?? null;
                    $bunrui4 = $haisoujouhou->bunrui4 ?? null;
                    $bunrui5 = $haisoujouhou->bunrui5 ?? null;

                } elseif ($other1 == '2 事業所M') {
                    // $paymentMethod = $other2->other4 ?? null;
                    // $immediateClassification = explode(' ', $other2->other2)[0] ?? null;
                    $bunrui3 = $other2->other24 ?? null;
                    $tel = $other2->other19 ?? null;
                    $sex = $other2->other21 ?? null;
                    $mail = $other2->other20 ?? null;
                    $bunrui4 = $other2->other33 ?? null;
                    $bunrui5 = $other2->other35 ?? null;

                }
            }
            if($bunrui3){
                $c1 = substr($bunrui3, 0, 2);
                $c2 = substr($bunrui3, 2, 4);
                $paymentMethod = QueryHelper::fetchResult("select category1, category2,category4 from categorykanri where category1 = '$c1' and category2 = '$c2' ORDER BY category2 ASC");
            }
            if($tel){
                $c1 = substr($tel, 0, 2);
                $c2 = substr($tel, 2, 4);
                $acceptanceConditions = QueryHelper::fetchResult("select category1, category2,category4 from categorykanri where category1 = '$c1' and category2 = '$c2' ORDER BY category2 ASC");
            }
            if($sex){
                $c1 = substr($sex, 0, 2);
                $c2 = substr($sex, 2, 4);
                $immediateClassification = QueryHelper::fetchResult("select category1, category2,category4 from categorykanri where category1 = '$c1' and category2 = '$c2' ORDER BY category2 ASC");
            }
            if($bunrui4){
                $c1 = substr($bunrui4, 0, 2);
                $c2 = substr($bunrui4, 2, 4);
                $siharaikazeikubun = QueryHelper::fetchResult("select category1, category2,category4 from categorykanri where category1 = '$c1' and category2 = '$c2' ORDER BY category2 ASC");
            }
            if($bunrui5){
                $c1 = substr($bunrui5, 0, 2);
                $c2 = substr($bunrui5, 2, 4);
                $siharaizeihasuukubun = QueryHelper::fetchResult("select category1, category2,category4 from categorykanri where category1 = '$c1' and category2 = '$c2' ORDER BY category2 ASC");
            }
        }
        // if ($companyBango) {
        //     $haisoujouhou = QueryHelper::fetchSingleResult("select * from haisoujouhou where syukei1 = $companyBango");
        //     $acceptanceConditions = $haisoujouhou->netlogin ?? null;
        // }

        return response()->json(['other1'=>$other1,'paymentMethod' => $paymentMethod, 'immediateClassification' => $immediateClassification, 'acceptanceConditions' => $acceptanceConditions, 'saleStandard' => $mail, 'siharaikazeikubun' => $siharaikazeikubun, 'siharaizeihasuukubun' => $siharaizeihasuukubun]);
    }

    public function digitConversion($bango, $digits)
    {
        return OrderEntry::convertNumberToString($digits);
    }

    public function filterByMisyukko($collection)
    {
        foreach ($collection as $key => $value) {
            $order_id = $value->order_number;
            $checkYoteimeter = QueryHelper::fetchSingleResult("select syouhinid from misyukko where syouhinid='$order_id' and yoteimeter = '2'");
            if (!empty($checkYoteimeter)) {
                $value->contain_deleted_item = true;
            } else {
                $value->contain_deleted_item = false;
            }
        }
        return $collection;
    }

    public function getFilteredQuery($collection, $paginate)
    {
        return $collection->filter(function ($item) {
            $orderBangoType2 = QueryHelper::fetchSingleResult("select max(ordertypebango2) from orderhenkan where kokyakuorderbango = '$item->order_number'")->max;
            return $item->ordertypebango2 == $orderBangoType2;
        })->paginate($paginate);
    }
    public function productDetails(Request $request)
    {
        $productCd = $request->productCd;
        $syouhin1Data = QueryHelper::fetchSingleResult("select * from syouhin1 where kokyakusyouhinbango = '$productCd'") ?? null;
        $syouhinbango = $syouhin1Data->bango;
        $companyCd = $request->companyCd;
        $result = array();
        // $kakakuData = QueryHelper::fetchSingleResult("select * from kakaku where syouhinbango = '$syouhinbango' AND syutenjyouken ='$companyCd'") ?? null;
        // if (!$kakakuData) {
        $kakakuData = QueryHelper::fetchSingleResult("select * from kakaku where syouhinbango = '$syouhinbango' AND syutenjyouken is null") ?? null;
        //}
        $result = array();
        $result['status'] = "ok";
        $result['yoyakusu'] = $kakakuData->yoyakusu;
        $result['product'] = $syouhin1Data;     
        return $result;
    }

    public function orderHanteiConfirm(Request $request, $bango){
        
        $result['status'] = "ok";
        $requestData = $request->data;
        // $index = 1;
        foreach( $requestData as $data ){
            $data = (object)$data;
            $order = $data->order ?? null;
            $branch = $data->branch ?? null;
            $line = $data->line ?? null;
            $id = $data->id ?? null;
            $condition = "syouhinid = '$order'";
            if($branch){
                $condition .= "AND syouhinsyu = '$branch'";
            }
            if($line){
                $condition .= "AND hantei = '$line'";
            }
            $dbData = QueryHelper::fetchSingleResult("select * from juchusyukko where $condition") ?? null;
            if($dbData){
                $result[$id] = true;
            }else {
                $result[$id] = false;
            }
            // $index++;
        }
        return $result;
    }
    public function supportOrderNumberValidation(Request $request, $bango){
        $result = array();
        $supportNumber = $request->supportNumber;
        $syouhinid = substr($supportNumber, 0, 10);
        $syouhinsyu =substr($supportNumber, 10, 3);
        $sales = $request->salesAmount;
        $data214 = $request->data214 ?? null;
        $dbData = QueryHelper::fetchSingleResult("select * from minyuko where syouhinid = '$syouhinid' and syouhinsyu = '$syouhinsyu'") ?? null;
        // dd($supportNumber,$syouhinid, $syouhinsyu, $dbData);
        if($dbData){
            $result["firstCheck"] = true;
        }else {
            $result["firstCheck"] = false;
        }
        //3rd check
        $zaikoMeter = QueryHelper::fetchSingleResult("select max(zaikometer) from minyuko where syouhinid = '$syouhinid' and syouhinsyu = '$syouhinsyu' ")->max ?? 0;
        $ordertypebango2 = QueryHelper::fetchSingleResult("select max(ordertypebango2) from orderhenkan where kokyakuorderbango = '$syouhinid' ")->max ?? 0;
        $minyukoSum = QueryHelper::fetchSingleResult("select SUM(nyukosu * kingaku) as res from minyuko where syouhinid = '$syouhinid' and syouhinsyu = '$syouhinsyu' and zaikometer = '$zaikoMeter' and denpyobango = 0")->res ?? 0;
        $orderhenKanSum = QueryHelper::fetchSingleResult("select intorder01 as res from orderhenkan where datatxt0152 = '$syouhinid' and ordertypebango2 = '$ordertypebango2'")->res ?? 0;
        $SumB = $orderhenKanSum + $sales;
        // dd(['a' => $minyukoSum, 'b'=> $SumB, 'o'=>$orderhenKanSum, 'm' => $minyukoSum]);
        if($minyukoSum < $SumB){
            $result["thirdCheck"] = false;
        }else {
            $result["thirdCheck"] = true;
        }
        //2nd check
        $dbData1 = QueryHelper::fetchSingleResult("select o.orderuserbango from orderhenkan o join minyuko m on o.kokyakuorderbango = m.syouhinid where o.orderuserbango = '$data214'") ?? null;
        if($dbData1){
            $result["secondCheck"] = true;
        }else {
            $result["secondCheck"] = false;
        }
        // $index++;
        return $result;
    }
    public function checkNumberSearchStatus($bango, $orderId)
    {
        $syouhinid = substr($orderId, 0, 10);
        $syouhinsyu = substr($orderId, 10, 3);
        $query = "select * from minyuko where syouhinid = '$syouhinid'" ;
        if($syouhinsyu){
            $query .= "and syouhinsyu = '$syouhinsyu'";
        }
        $dbData = QueryHelper::fetchSingleResult($query) ?? null;
        if($dbData){
            $contain_item = true;
        }else {
            $contain_item = false;
        }
        return response()->json(['checkStatus' => $contain_item]);
    }

}