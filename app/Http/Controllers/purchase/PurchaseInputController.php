<?php
namespace App\Http\Controllers\purchase;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\tantousya;
use Exception;
use Illuminate\Support\Facades\Session;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\purchase\purchaseInput\AllNumberSearch;
use App\AllClass\purchase\purchaseInput\orderDetail;
use App\AllClass\purchase\purchaseInput\PurchaseInputValidation;
use App\AllClass\purchase\purchaseInput\PurchaseInputDataEntry;
use App\AllClass\purchase\purchaseInput\BacklogData;
use App\AllClass\purchase\purchaseInput\DateCalculator;
use App\AllClass\order\orderEntry\OrderEntry;

class PurchaseInputController extends Controller
{
    public function index(){
        $bango = request('userId');
        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $ztanka = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7501'")->orderbango;
        $name = QueryHelper::select(['name'])->from('tantousya')->where("DeleteFlag = '0' ")->where("mail5 != '' ")->where("ztanka = '$ztanka' ")->orderBy("bango asc")->get()->execute();
        $categorykanriesU1 = QueryHelper::fetchResult("select category1,category2,category4 from categorykanri where category1 = 'U6' and category2 != '22' ORDER BY category2 ASC");
        $color = '0603作成区分';
        $request1s = QueryHelper::select(['syouhinbango', 'jouhou'])->from('request')->where("color = '0603作成区分'")->orderBy("bango asc")->get()->execute();
        $U2Data = QueryHelper::fetchResult("select category1,category2,category4 from categorykanri where category1 = 'D9' ORDER BY category2 ASC");
        $data309 = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'E1' and suchi2 = 0 order by suchi1 ASC "); 
        $data310 = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'J1' and suchi2 = 0 order by suchi1 ASC "); 
        $data311 = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'J2' and suchi2 = 0 order by suchi1 ASC ");  
        $c4Categorykanries = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'C4' and suchi2 = 0 order by suchi1 ASC ");
        return view('purchase.purchaseInput.mainPurchaseInput',compact('bango', 'tantousya', 'name', 'categorykanriesU1','request1s', 'U2Data', 'c4Categorykanries', 'data309', 'data310', 'data311'));
    }
    public function save(Request $request, $bango)
    {
        // $validator = PurchaseInputValidation::handleSubmit(request()->all());
        // $errors = $validator->errors();
        // if ($errors->any()) {
        //     $error = $errors->all();
        //     return ['err_field' => $errors, 'err_msg' => $error];
        // } 
        // elseif (!$errors->any() && $request->confirm_status == 0) {
        //     $result['status'] = 'confirm';
        //     return $result;
        // } else if ($request->confirm_status == 1 && !$errors->any()) {
        //     $result['status'] = 'done';
        //     return $result;
        // }
        if (request('creation_category') == '1') {

            $insert = PurchaseInputDataEntry::create($request, $bango);
            if (is_array($insert) && $insert['status'] == 'ok') {
                //                Session::flash('success_msg', 'Order inserted successfully');
                return $insert;
            } else if (is_array($insert) && $insert['status'] == 'confirm') {
                return $insert;
            } else if (is_array($insert) && $insert['status'] == 'ng') {
                return $insert;
            } else {
                $errors = $insert['errors']->all();
                if($insert['checkStatus']=='no'){
                    array_push($errors,'会計科目の仕入区分が混在しています。仕入区分を統一してください。');
                    // dd($errors);
                }
                return ['err_field' => $insert['errors'], 'err_msg' => $errors, 'checkStatus'=>$insert['checkStatus']];
            }
        }
        if (request('creation_category') == '2') {

            $update = PurchaseInputDataEntry::edit($request, $bango);

            if (is_array($update) && $update['status'] == 'ok') {
                //                Session::flash('success_msg', 'Order updated successfully ');
                return $update;
            } else if (is_array($update) && $update['status'] == 'confirm') {
                return $update;
            } else if (is_array($update) && $update['status'] == 'ng') {
                return $update;
            } else {
                $errors = $update['errors']->all();
                if($update['checkStatus']=='no'){
                    array_push($errors,'会計科目の仕入区分が混在しています。仕入区分を統一してください。');
                    // dd($errors);
                }
                return ['err_field' => $update['errors'], 'err_msg' => $errors, 'checkStatus'=>$update['checkStatus'],'type_message' => "受注番号が選択されていません。"];
                // return ['err_field' => $update, 'err_msg' => $errors, 'type_message' => "受注番号が選択されていません。"];
            }
        }
        if (request('creation_category') == '3') {

            $update = PurchaseInputDataEntry::deleteOrder($request, $bango);

            if (is_array($update) && $update['status'] == 'ok') {
                //                Session::flash('success_msg', 'Order deleted successfully ');
                return $update;
            } else if (is_array($update) && $update['status'] == 'confirm') {
                return $update;
            } else if (is_array($update) && $update['status'] == 'ng') {
                return $update;
            } else {
                $errors = $update['errors']->all();
                if($update['checkStatus']=='no'){
                    array_push($errors,'会計科目の仕入区分が混在しています。仕入区分を統一してください。');
                    // dd($errors);
                }
                return ['err_field' => $update['errors'], 'err_msg' => $errors, 'checkStatus'=>$update['checkStatus'],'type_message' => "受注番号が選択されていません。"];
                // return ['err_field' => $update, 'err_msg' => $errors, 'type_message' => "受注番号が選択されていません。"];
            }
        }  
    }
    public function getOrderBacklogData(Request $request, $bango){
        $validator = PurchaseInputValidation::handle(request()->all());
        $errors = $validator->errors();
        if ($errors->any()) {
            $error = $errors->all();
            return ['err_field' => $errors, 'err_msg' => $error];
        } 
        // elseif (!$errors->any() && $request->confirm_status == 0) {
        //     $result['status'] = 'confirm';
        //     return $result;
        // } else if ($request->confirm_status == 1 && !$errors->any()) {
        //     $result['status'] = 'done';
        //     return $result;
        // }
        else {
            // $query = BacklogData::data($bango, 'ref', $request)->toSql();
            // $data = QueryHelper::fetchResult($query);
            // return response()->json(["status" => "ok", "html" => $data]);
            try {
                $bango = $request->bango;
                $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
                $query = BacklogData::data($bango, '', $request)->toSql();
                $data = collect(QueryHelper::fetchResult($query));
                // $data = $this->filterByMisyukko($data);
                // $data = $this->getFilteredQuery($data, 10);
                $hasData = $data->count();
                $html = view('purchase.purchaseInput.purchaseInputMainContentPart1', compact('data', 'bango', 'tantousya'))->render();
                return response()->json(["status" => "ok", "html" => $html, "hasData" => $hasData]);
            } catch (Exception $e) {
                dd($e);
            }
        }     
    }

    public function handleNumberSearch(Request $request)
    {
        $bango = request('userId');
        $tantousya = null;
        $data_from_view = $request->all();
        $data_from_view_session = $request->all();
        session()->put('oldInput' . $bango, $data_from_view_session);
        $pagination = 10;
        $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'rd1', 'category_kanri_def', 'request_def'];
        $query = AllNumberSearch::data($bango, '', $request)->toSql();
        $temp_table = "all_number_search_temp";
        if (!empty($data_from_view['Button']) && $data_from_view['Button'] == 'refresh') {
            session()->forget('oldInput' . $bango);
            $query = AllNumberSearch::data($bango, 'refresh', $request)->toSql();
            $numberSearches = collect(QueryHelper::fetchResult($query))->paginate($pagination);
            $html = view('purchase.purchaseInput.include.numberSearch.partial', compact('numberSearches', 'bango', 'tantousya'))->render();
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
            $html = view('purchase.purchaseInput.include.numberSearch.partial', compact('numberSearches', 'bango', 'tantousya'))->render();
            return response()->json(["status" => "view rendered", "html" => $html]);
        }
        $numberSearches = collect(QueryHelper::fetchResult($query))->paginate($pagination);
        $html = view('purchase.purchaseInput.include.numberSearch.partial', compact('numberSearches', 'bango', 'tantousya'))->render();
        return response()->json(["status" => "view rendered", "html" => $html]);
    }

    public function numberSearchModalOpen(Request $request, $bango)
    {
        session()->forget('oldInput' . $bango);
        try {
            $bango = $request->bango;
            $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
            $query = AllNumberSearch::data($bango, '', $request)->toSql();

            $numberSearches = collect(QueryHelper::fetchResult($query))->paginate(10);
            // dd($numberSearches);
            // $numberSearches = $this->filterByMisyukko($numberSearches);
            // $numberSearches = $this->getFilteredQuery($numberSearches, 10);
            $html = view('purchase.purchaseInput.include.numberSearch.partial', compact('numberSearches', 'bango', 'tantousya'))->render();
            return response()->json(["status" => "view rendered", "html" => $html]);
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function orderDetailRead(Request $request, $bango)
    {
        $orderId = request('order_id');
        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $query = orderDetail::data($bango, $orderId);
        $orderDetail = QueryHelper::fetchSingleResult($query);
        // dd($orderDetail);
        $zaikoMeter = QueryHelper::fetchSingleResult("select max(zaikometer) from nyukoold where syouhinid = '$orderId'")->max ?? 0;
        $products = QueryHelper::fetchResult("select
            distinct
            nyukoold.*,
            CASE 
                WHEN LENGTH(nyukoold.yoteimeter::text)=2 
                THEN concat_ws('0', nyukoold.idoutanabango, nyukoold.syouhinsyu)
                WHEN LENGTH(nyukoold.yoteimeter::text)=1 
                THEN concat_ws('00', nyukoold.idoutanabango, nyukoold.yoteimeter)
                ELSE concat_ws('', nyukoold.idoutanabango, nyukoold.yoteimeter)
            END AS orderNumber,
            v_torihikisaki.r17_4 as orderhenkan_datachar10,
            orderhenkan.datachar10 as contractor
            from nyukoold
            left join orderhenkan on orderhenkan.kokyakuorderbango = nyukoold.idoutanabango
            left join v_torihikisaki on orderhenkan.datachar10 = v_torihikisaki.torihikisaki_cd
            where syouhinid = '$orderId'  and denpyobango != '1' and zaikometer = '$zaikoMeter'  order by syouhinsyu");
        // dd($orderDetail, $products);
        $data309 = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'E1' and suchi2 = 0 order by suchi1 ASC "); 
        $data310 = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'J1' and suchi2 = 0 order by suchi1 ASC "); 
        $data311 = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'J2' and suchi2 = 0 order by suchi1 ASC ");  
        $html = view('purchase.purchaseInput.purchaseInputMainContentPart2', compact('products', 'bango', 'tantousya', 'data309', 'data310', 'data311'))->render();
        $errorMessage = array();
        if($orderDetail && $orderDetail->syouhinsyu == 1){
            array_push($errorMessage, "支払データ作成済です。");
        }
        if($orderDetail && $orderDetail->hantei == 1){
            array_push($errorMessage, "買掛残高更新済のデータです");
        }
        if($orderDetail && $orderDetail->dataint01 == 1){
            array_push($errorMessage, "会計データ作成済です。");
        }
        if($orderDetail && !$orderDetail->datachar06 && !$orderDetail->datachar07){
            array_push($errorMessage, "仕入購入指示済です。");
        }
        if($orderDetail){
            $reviewOrderBango = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7504'")->orderbango ?? null;
            $purchase_date = PurchaseInputDataEntry::stringDataConvertedToIntegerFormat($orderDetail->purchase_date);
            if($reviewOrderBango >= $purchase_date){
                array_push($errorMessage, "仕入確定済です。");
            }
        }
        if($orderDetail){
            $reviewOrderBango1 = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7402'")->orderbango ?? null;
            if($reviewOrderBango1 && ($reviewOrderBango1 <= $orderDetail->datanum0013)){
                array_push($errorMessage, "訂正回数が上限値".$reviewOrderBango1."回に達しました。");
            }
            // dd($reviewOrderBango, $reviewOrderBango1, $orderDetail->datanum0013);
        }
        // dd($reviewOrderBango1, $orderDetail->datanum0013);
        $orderDetail = collect($orderDetail);
        $hasOrderDetail = $orderDetail->count();
        return (['orderDetail' => $orderDetail, 'errorMessage' => $errorMessage, 'html' => $html, 'products' => $products, 'hasOrder' => $hasOrderDetail]);
    }

    public function handleCategoriKanries(Request $request)
    {
        $categoryType = request('category_type') ? trim(\request('category_type')) : null;
        $categoryValue = request('category_value') ? trim(\request('category_value')) : null;
        if ($categoryType == "C4") {
            $C5html = static::renderCategoryKanri(2, $categoryValue, 'C5');
            $C6html = static::renderCategoryKanri(2, $categoryValue, 'maljabena');
            $E7html = static::renderCategoryKanri(2, $categoryValue, 'E7');
            $E6html = static::renderCategoryKanri(2, $categoryValue, 'E6');
            return response()->json(["status" => "view rendered", "html" => ['C5html' => $C5html, 'C6html' => $C6html, 'E7html' => $E7html, 'E6html' => $E6html]]);
        } elseif ($categoryType == "C6") {
        } elseif ($categoryType == "C5") {
            $C6html = static::renderCategoryKanri(4, $categoryValue, 'C6');
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
        $html = view('purchase.purchaseInput.include.product.partial', compact('syouhin1s'))->render();
        return response()->json(['status' => 'view render', 'html' => $html, 'syouhin1s' => $syouhin1s]);
    }
    public function getOrderDetailTableData(Request $request, $bango){
        $orderNumber = $request->orderNumber;
        $orderIdPart1 = substr($orderNumber, 0, 10);
        $orderIdPart2 = substr($orderNumber, 10, 3);
        // $conditions = "where minyuko.syouhinid = '$orderIdPart1' and minyuko.syouhinsyu = '$orderIdPart2'"
        $zaikoMeter = QueryHelper::fetchSingleResult("select max(zaikometer) from minyuko where syouhinid = '$orderIdPart1' and syouhinsyu = '$orderIdPart2'")->max ?? 0;
        $data = QueryHelper::fetchSingleResult("select 
            distinct
            juchusyukko2.tanka as juchusyukko2_tanka,
            juchusyukko2.day as juchusyukko2_day,
            hikiatesyukko.datachar16 as hikiatesyukko_datachar16,
            minyuko.datachar01,
            minyuko.datachar02,
            minyuko.datachar08,
            minyuko.datachar18,
            minyuko.datachar11,
            minyuko.syouhinid,
            minyuko.syouhinsyu,
            minyuko.idoutanabango,
            minyuko.nyukosu,
            minyuko.genka,
            minyuko.syouhizeiritu,
            minyuko.soukobango,
            orderhenkan_1.kokyakuorderbango,
            orderhenkan_1.ordertypebango2,
            orderhenkan_1.datachar02 as orderhenkan_datachar02,
            v_torihikisaki.r17_4 as orderhenkan_datachar10,
            orderhenkan.datachar10 as contractor
            from minyuko
            left join orderhenkan 
                on minyuko.syouhinid = orderhenkan.kokyakuorderbango    
            left join juchusyukko2
                on juchusyukko2.syouhinid = minyuko.syouhinid
                and juchusyukko2.syouhinsyu = minyuko.syouhinsyu
            left join orderhenkan as orderhenkan_1
                on minyuko.idoutanabango = orderhenkan_1.kokyakuorderbango
                and orderhenkan_1.ordertypebango2 = (select max(ordertypebango2) from orderhenkan where kokyakuorderbango = orderhenkan_1.kokyakuorderbango)
            left join hikiatesyukko
                on hikiatesyukko.syouhinid = orderhenkan_1.kokyakuorderbango
            left join v_torihikisaki on orderhenkan.datachar10 = v_torihikisaki.torihikisaki_cd
            where minyuko.syouhinid = '$orderIdPart1' and minyuko.syouhinsyu = '$orderIdPart2' and minyuko.zaikometer = $zaikoMeter");
            // $data = collect($data); 
            //and minyuko.idoutanabango = orderhenkan.datatxt0152

            //edit query

            $hasOrderDetail = collect($data)->count();
            $kokyakuorderbango = $data->kokyakuorderbango ?? null;
            $datachar02 = $data->orderhenkan_datachar02 ?? null;
            $checkResult = true;
            if($datachar02 == 'U150'){
                $checkResult = false;
            }
            if($kokyakuorderbango){
                $flag = QueryHelper::fetchSingleResult("select * from orderhenkan where kokyakuorderbango = '$kokyakuorderbango' and kokyakuorderbango in (select distinct datachar06 from orderhenkan)");
                if($flag){
                    $checkResult = false;
                }
            }
            return (['orderDetail' => $data, 'hasOrder' => $hasOrderDetail, 'checkResult' => $checkResult]);
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
    //calculate tax rate
    public function calculateTaxRate(Request $request,$bango){
        $info2 = $request->info2;
        $otodoketime = $request->otodoketime;
        $money10 = $request->money10;
        $kokyakuCode = substr($info2, 0,6);
        $haisouCode = substr($info2, 6,2);
        $kokyaku = QueryHelper::select(['bango,mallsoukobango1'])->from('kokyaku1')->where("yobi12 = '$kokyakuCode' ")->get()->first();
        $haisoujouhou = QueryHelper::select(['bunrui5'])->from('haisoujouhou')->where("syukei1 = '$kokyaku->bango' ")->get()->first();
        $others2 = QueryHelper::fetchResult("select other1,other35 from others2 where otherint1 = (select bango from haisou where haisou.shikibetsucode = '$kokyakuCode' and haisou.torihikisakibango = '$haisouCode')");
        $category1 = substr($otodoketime,0,2);
        $category2 = substr($otodoketime,2,2);
        $categorykanri = QueryHelper::fetchSingleResult("select substring(patternsub2,1,2) as category5 from categorykanri where category1 = '$category1' AND category2 = '$category2' ");
        $category5 = (int) $categorykanri->category5;
        if(explode(' ', $others2[0]->other1)[0] == '1'){
            $format_status = $haisoujouhou->bunrui5;
        }else{
            $format_status = $others2[0]->other35;
        }
        $numeric4 = ($money10*$category5)/100;
        //check tax rate for round,floor or selling
        if($format_status == 'E21'){
            $numeric4 = round($numeric4);
        }else if($format_status == 'E22'){
            $numeric4 = floor($numeric4);
        }else if($format_status == 'E23'){
            $numeric4 = ceil($numeric4);
        }
        return $numeric4;
    }
    public function purchaseWisePaymentDate()
    {
        $salesDate = strpos(\request('paymentDate'), '/') ? str_replace('/', '', \request('paymentDate')) : \request('paymentDate');
        $billingDestination = strpos(\request('billingDestination'), '/') ? str_replace('/', '', \request('billingDestination')) : \request('billingDestination');
        list($day, $month, $holidaySetting, $paymentMethod) = DateCalculator::calculateBillingDates($billingDestination);;
        if ($salesDate){
            if ($month !== null && $day !== null && $holidaySetting !== null) {
                $day = (int)substr($day, 2, 4);
                $isForward = substr($holidaySetting, 0,1) == '1' ? true : false;
                $saleYear = (int) substr($salesDate, 0, 4);
                $saleMonth = (int) substr($salesDate, 4, 2);
                $saleDay =  (int) substr($salesDate, 6, 2);
                $saleDate = Carbon::createFromDate($saleYear, $saleMonth, $saleDay);
                // $closingDate =  $this->getClosingDate($addDayForSystemDate);
                // if ($saleDate->greaterThan($closingDate)) {
                //     $saleMonth += 1;
                // }
                $saleMonth += (int)$month;
                $paymentDate = $this->getCalculatePaymentDate($saleMonth, $day, $saleYear, $isForward);
                // dd($paymentDate);
                if ($paymentDate instanceof Carbon) {
                    $paymentDate = $this->calculateDateHolidayWise($paymentDate, $isForward);
                    $paymentDate = Carbon::parse($paymentDate)->format("Ymd");
                } else {
                    $paymentDate = Carbon::parse($paymentDate)->format("Ymd");
                }
                return response()->json(['paymentDate' => $paymentDate, 'paymentMethod' => $paymentMethod]);
            } else {
                if ($month == null) {
                    $msg = "入金月が空欄のため、入金日の計算ができませんでした。";
                } else if ($day == null) {
                    $msg = "入金日が空欄のため、入金日の計算ができませんでした。";
                } elseif ($isForward == null) {
                    $msg = "入金日休日設定が空欄のため、入金日の計算ができませんでした。";
                } elseif ($addDayForSystemDate == null) {
                    $msg = "請求締め日が空欄のため、入金日の計算ができませんでした。 ";
                } else if ($month == null or $day == null or $isForward == null or $addDayForSystemDate == null) {
                    $msg = "入金日が空欄のため、入金日の計算ができませんでした。";
                }
                return response()->json(['errormsg' => $msg, 'paymentMethod' => $paymentMethod]);
            }
        }else {
            return response()->json(['paymentMethod' => $paymentMethod]);
        }
    }
    /**
     * @param $addDayForSystemDate
     * @return Carbon|\Illuminate\Support\Carbon
     */
    public function getClosingDate($addDayForSystemDate)
    {
        if (!checkdate(now()->month, $addDayForSystemDate, now()->year)) {
            $closingDate = now()->endOfMonth();
        } else {
            $closingDate = Carbon::createFromDate(now()->year, now()->month, $addDayForSystemDate);
        }
        return $closingDate;
    }

    /**
     * @param Carbon $paymentDate
     * @param bool $isForward
     * @return Carbon
     */
    public function calculateDateHolidayWise(Carbon $paymentDate, bool $isForward = false): Carbon
    {
        $paymentDate = $this->excludeSaturdayAndSunday($paymentDate, $isForward);
        if (($paymentDate->month == 12 and $paymentDate->day == 31) or ($paymentDate->month == 1 and $paymentDate->day == 1) or ($paymentDate->month == 1 and $paymentDate->day == 2) or ($paymentDate->month == 1 and $paymentDate->day == 3)) {
            if ($isForward) {
                $modifiedDate = Carbon::createFromDate($paymentDate->year + 1, 1, 4);
            } else {
                if ($paymentDate->month == 12) {
                    $modifiedDate = Carbon::createFromDate($paymentDate->year, 12, 30);
                } else {
                    $modifiedDate = Carbon::createFromDate($paymentDate->year - 1, 12, 30);
                }
            }
            $paymentDate = $this->excludeSaturdayAndSunday($modifiedDate, $isForward);
        }
        return $paymentDate;
    }

    /**
     * @param Carbon $paymentDate
     * @param bool $isForward
     * @return Carbon
     */
    public function excludeSaturdayAndSunday(Carbon $paymentDate, bool $isForward = false): Carbon
    {
        if ($paymentDate->isSaturday()) {
            $paymentDate = $isForward ? $paymentDate->addDays(2) : $paymentDate->subDays(1);
        } elseif ($paymentDate->isSunday()) {
            $paymentDate = $isForward ? $paymentDate->addDays(1) : $paymentDate->subDays(2);
        }
        return $paymentDate;
    }

    /**
     * @param int $currYear
     * @param int $currMonth
     * @return array
     */
    public function calculateDateForInvalidDate(int $currYear, int $currMonth): string
    {
        $paymentDate = Carbon::createFromDate($currYear, $currMonth, 01)->endOfMonth();
        $paymentDate = $this->excludeSaturdayAndSunday($paymentDate);
        return str_replace('-', '', $paymentDate->toDateString());
    }

    /**
     * @param int $saleMonth
     * @param int $saleDay
     * @param int $saleYear
     * @return Carbon|\Illuminate\Http\JsonResponse
     */
    public function getCalculatePaymentDate($saleMonth, $saleDay, $saleYear, bool $isForward = false)
    {
        $currentMonth = $saleMonth > 12 ? 12 : $saleMonth;
        $leftMonth = $saleMonth > 12 ? $saleMonth - 12 : 0;
        $calYear = (int) ceil($leftMonth / 12);
        $calYear = $saleYear + $calYear;
        // $t = checkdate($saleMonth, $saleDay, $calYear);
        // dd(['s' => $currentMonth, 'l' => $leftMonth, 'c' => $calYear, 'd' => $saleDay, 'm' => $saleMonth, 't' => $t]);
        if (!checkdate($saleMonth, $saleDay, $calYear)) {
            if ($leftMonth) {
                if (!checkdate($leftMonth, $saleDay, $calYear)) {
                    return $this->calculateDateForInvalidDate($calYear, $leftMonth);
                }
                $paymentDate = Carbon::createFromDate($saleYear, $currentMonth, $saleDay)->addMonths($leftMonth);
                // dd($paymentDate);
            } else {
                $paymentDate = Carbon::createFromDate($calYear, $saleMonth, 01)->endOfMonth();
            }
            $paymentDate = $this->excludeSaturdayAndSunday($paymentDate, $isForward);
            return str_replace('-', '', $paymentDate->toDateString());
        }
        return Carbon::createFromDate($saleYear, $currentMonth, $saleDay);
    }
    public static function renderCategoryKanri($length_limit, $categoryValue, $categoryType)
    {
        $categories = QueryHelper::fetchResult("select * from categorykanri where category1 = '$categoryType' and suchi2 = 0 and substring (category2,1,$length_limit) = '$categoryValue' order by suchi1 ASC") ?? null;
        $default_name = ['C5' => "選択なし", 'C6' => "選択なし", 'E7' => "選択なし", 'E6' => "選択なし", 'maljabena' => "選択なし"];
        $html = '<option data-categoryType="null" data-categoryValue="' . $categoryType . '"  value="">' . $default_name[$categoryType] . '</option>';
        if (isset($categories)) {
            foreach ($categories as $category) {
                $html .= "<option data-categoryType=" . $category->category1 . " data-categoryValue=" . $category->category2 . " value=" . $category->category1 . $category->category2 . ">" . substr($category->category2, $length_limit) . " " . $category->category4 . "</option>";
            }
            return $html;
        } else {
            return $html;
        }
    }
}