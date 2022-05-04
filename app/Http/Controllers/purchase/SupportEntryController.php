<?php
namespace App\Http\Controllers\purchase;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\master\productDescription\AllProductDescription;
use App\AllClass\master\productMaster\allProduct;
use App\AllClass\master\productSubMaster\allOthers;
use App\AllClass\purchase\supportEntry\AllNumberSearch;
use App\AllClass\purchase\supportEntry\AllOrderProductSubs;
use App\AllClass\purchase\supportEntry\SupportEntry;
use App\AllClass\purchase\supportEntry\SupportDetail;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\AllClass\purchase\supportEntry\searchCompany;
use App\AllClass\purchase\supportEntry\searchCompany2;
use App\AllClass\purchase\supportEntry\searchCompany3;
use App\tantousya;
use Exception;
use Illuminate\Support\Facades\Session;
use mysql_xdevapi\Collection;

class SupportEntryController extends Controller{
    public function index(){
        $bango = request('userId');
        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        // 101
        $request1s = QueryHelper::select(['syouhinbango', 'jouhou', 'color', 'bango'])->from('request')->where("color = '0506作成区分'")->orderBy("bango asc")->get()->execute();

        $u2Data214 = QueryHelper::fetchResult("select category1, category2, category4, suchi1 from categorykanri where category1 = 'U2' order by suchi1 asc");
        $c1Data216 = QueryHelper::fetchResult("select category1, category2, category4, suchi1 from categorykanri where category1 = 'C1' order by suchi1 asc");

        // temp
        //get categorykanri data
        //get request data
        $color = '0201即時区分';
        $housoukubun = QueryHelper::select(['syouhinbango', 'jouhou', 'color', 'bango'])->from('request')->where(" color = '$color'")->orderBy("syouhinbango asc")->get()->execute();
        


        $innerLevelc = tantousya::innerLevel($bango);
        if ($innerLevelc <= 14) {
            $cat2 = [10, 20, 22, 23, 50, 60];
        } else {
            $cat2 = [10, 20, 50, 60];
        }

        // $categorykanriesU1 = QueryHelper::fetchResult("select category1,category2,category4,suchi2 from categorykanri where suchi2 = '0' and category1 = 'U1' and category2 in ($cat2) order by category1 asc ");
        $categorykanriesU1 = DB::table('categorykanri')->where('suchi2', 0)
            ->where('category1', 'U1')
            ->whereIn('category2', $cat2)
            ->select('category1', 'category2', 'category4', 'suchi2')
            ->orderBy('suchi1')
            ->get();

        $requests = QueryHelper::select(['syouhinbango', 'jouhou', 'color', 'bango'])->from('request')->orderBy("bango asc")->get()->execute();
        $categorykanries = QueryHelper::select(['category1', 'category2', 'category4', 'suchi2'])->from('categorykanri')->where("suchi2 = 0")->get()->execute();
        //$c4Categorykanries = QueryHelper::select(['category1', 'category2', 'category4', 'suchi2'])->from('categorykanri')->where(" category1 = 'C4'")->where("suchi2 = 0")->get()->execute();
        $c4Categorykanries = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'C4' and suchi2 = 0 order by suchi1 ASC ");
        $e7Categorykanries = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'E7' and suchi2 = 0 and substring (category2,1,2) = '01' order by bango ");
        $deliveryMethods = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'G3' and suchi2 = 0 order by  bango");
        $continutionCategories = QueryHelper::select(['syouhinbango', 'jouhou', 'color', 'bango'])->from('request')->where("color = '0201継続区分'")->orderBy("bango asc")->get()->execute();
        $newVups = QueryHelper::select(['syouhinbango', 'jouhou', 'color', 'bango'])->from('request')->where("color = '0201新規VUP'")->orderBy("bango asc")->get()->execute();
        $vupCategories = QueryHelper::select(['syouhinbango', 'jouhou', 'color', 'bango'])->from('request')->where("color = '0201VUP区分'")->orderBy("bango asc")->get()->execute();
        $pjs = QueryHelper::fetchResult("select url,urlsm,datatxt0096 from gazou2 order by datatxt0096 desc ");
        $ztanka = QueryHelper::fetchSingleResult("select kokyakusyouhinbango,orderbango from review where  kokyakusyouhinbango = 'D7501'")->orderbango ?? 0;
        $tantoushaQuery = "select bango,name,deleteflag,ztanka,innerlevel from tantousya where deleteflag = 0 and innerlevel >= 10 and innerlevel <= 20  ";
        $ztanka = (int)$ztanka;
        $tantoushaQuery .= $ztanka ? "and  ztanka = $ztanka " : " ";
        $tantoushaQuery .= "order by bango";
        $sales = QueryHelper::fetchResult($tantoushaQuery);
        $ses = QueryHelper::fetchResult($tantoushaQuery);
        $maintains = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'E9' and  suchi2 = '0'   order by bango  ");
        $kokyakubango = SupportEntry::getKokyakuOrderBango();
       // return view('order.order-entry.index', compact('bango', 'tantousya', 'requests', 'categorykanries', 'A9Data', 'U2Data', 'U3Data', 'housoukubun', 'c4Categorykanries', 'categorykanriesU1', 'request1s', 'e7Categorykanries', 'deliveryMethods', 'continutionCategories', 'newVups', 'vupCategories', 'pjs', 'sales', 'ses', 'maintains', 'kokyakubango'));
        return view('purchase.supportEntry.mainSupportEntry',compact('bango', 'tantousya', 'request1s', 'u2Data214', 'c1Data216'));
    }


    public function checkOrderNumberExist($bango, $orderId){
        $orderhenkan_data = QueryHelper::fetchSingleResult("select kokyakuorderbango from orderhenkan where kokyakuorderbango='$orderId' and datachar02 = 'V413'");

        if (!empty($orderhenkan_data)) {
            $duplicate_data_status = true;
            $duplicate_error_data_message = "指定された受注番号でのサポート入力は既に行われています。";
        } else {
            $duplicate_data_status = false;
            $duplicate_error_data_message = "";
        }

        return response()->json(['duplicate_data_status' => $duplicate_data_status, "duplicate_error_data_message" => $duplicate_error_data_message]);
    }

    // call by 102child screen list button
    public function handleNumberSearch(Request $request){
        $bango = request('userId');
        $syouhinbango_jouhou = $request->syouhinbango_jouhou;
        $tantousya = null;
        $data_from_view = $request->all();
        $data_from_view_session = $request->all();
        session()->put('oldInput' . $bango, $data_from_view_session);
        $pagination = 10;
        $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'rd1', 'category_kanri_def', 'request_def', 'syouhinbango_jouhou'];

        //$query = AllNumberSearch::data($bango, '', $request)->toSql();
        $temp_table = "all_number_search_temp";
        if (!empty($data_from_view['Button']) && $data_from_view['Button'] == 'refresh') {
            session()->forget('oldInput' . $bango);

            if($syouhinbango_jouhou == 2 || $syouhinbango_jouhou == 3){
                $query = AllNumberSearch::edit_2_data($bango, 'refresh', $request)->toSql();
            }else{
                if($syouhinbango_jouhou == 1){
                    $query = AllNumberSearch::creation_1_data($bango, 'refresh', $request)->toSql();
                }
            }
            
            $numberSearches = collect(QueryHelper::fetchResult($query));
           // $numberSearches = $this->filterByMisyukko($numberSearches);
            $numberSearches = $this->getFilteredQuery($numberSearches, $pagination);
            $html = view('purchase.supportEntry.include.number_search.partial', compact('numberSearches', 'bango', 'tantousya', 'syouhinbango_jouhou'))->render();
            return response()->json(["status" => "view rendered", "html" => $html]);
        }
        if (!empty($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort')) {
            try {

                if($syouhinbango_jouhou == 2 || $syouhinbango_jouhou == 3){
                        $query = AllNumberSearch::edit_2_data($bango, 'search', $request)->toSql();
                }else{
                    if($syouhinbango_jouhou == 1){
                        $query = AllNumberSearch::creation_1_data($bango, 'search', $request)->toSql();
                    }
                }

                
                $data = $this->removeDataFromView($data_from_view, $removeKeys);
                $numberSearches = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'support_entry');
               // $numberSearches = $this->filterByMisyukko($numberSearches);
                $numberSearches = $this->getFilteredQuery($numberSearches, $pagination);
                if ($numberSearches->items() == null && $numberSearches->currentPage() != 1) {
                    $currentPage = ($numberSearches->lastPage());
                    Paginator::currentPageResolver(function () use ($currentPage) {
                        return $currentPage;
                    });
                    $numberSearches = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'support_entry');
                   // $numberSearches = $this->filterByMisyukko($numberSearches);
                    $numberSearches = $this->getFilteredQuery($numberSearches, $pagination);
                }
            } catch (\Exception $e) {
                dd($e);
            }
            $html = view('purchase.supportEntry.include.number_search.partial', compact('numberSearches', 'bango', 'tantousya', 'syouhinbango_jouhou'))->render();
            return response()->json(["status" => "view rendered", "html" => $html]);
        }
        $numberSearches = collect(QueryHelper::fetchResult($query));
     //   $numberSearches = $this->filterByMisyukko($numberSearches);
        $numberSearches = $this->getFilteredQuery($numberSearches, $pagination);
        $html = view('purchase.supportEntry.include.number_search.partial', compact('numberSearches', 'bango', 'tantousya', 'syouhinbango_jouhou'))->render();
        return response()->json(["status" => "view rendered", "html" => $html]);
    }


    // Call by 102child screen open
    public function numberSearchModalOpen(Request $request, $bango){
        session()->forget('oldInput' . $bango);
        try {
            $bango = $request->bango;
            $syouhinbango_jouhou = $request->syouhinbango_jouhou;
            $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
            if($syouhinbango_jouhou == 1){
                $query = AllNumberSearch::creation_1_data($bango, '', $request)->toSql();
            }else{
                if($syouhinbango_jouhou == 2 || $syouhinbango_jouhou == 3){
                    $query = AllNumberSearch::edit_2_data($bango, '', $request)->toSql();
                }
            }

            $numberSearches = collect(QueryHelper::fetchResult($query));
           // $numberSearches = $this->filterByMisyukko($numberSearches);
            $numberSearches = $this->getFilteredQuery($numberSearches, 10);
            $html = view('purchase.supportEntry.include.number_search.partial', compact('numberSearches', 'bango', 'tantousya', 'syouhinbango_jouhou'))->render();
            return response()->json(["status" => "view rendered", "html" => $html]);
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function handleCategoriKanries(Request $request)
    {

        $categoryType = request('category_type') ? trim(\request('category_type')) : null;
        $categoryValue = request('category_value') ? trim(\request('category_value')) : null;
        if ($categoryType == "C4") {
            $C5html = SupportEntry::renderCategoryKanri(2, $categoryValue, 'C5');
            $C6html = SupportEntry::renderCategoryKanri(2, $categoryValue, 'maljabena');
            $E7html = SupportEntry::renderCategoryKanri(2, $categoryValue, 'E7');
            $E6html = SupportEntry::renderCategoryKanri(2, $categoryValue, 'E6');
            return response()->json(["status" => "view rendered", "html" => ['C5html' => $C5html, 'C6html' => $C6html, 'E7html' => $E7html, 'E6html' => $E6html]]);
        } elseif ($categoryType == "C6") {
        } elseif ($categoryType == "C5") {
            $C6html = SupportEntry::renderCategoryKanri(4, $categoryValue, 'C6');
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
        $querystring .= " and syouhin1.data29 = 'F61' and syouhin1.isuriage = 0 order by syouhin1.kokyakusyouhinbango limit 30 ";

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

        $html = view('order.order-entry.include.product.partial', compact('syouhin1s'))->render();
        return response()->json(['status' => 'view render', 'html' => $html, 'syouhin1s' => $syouhin1s]);
    }

    public function generateProductSubData(Request $request)
    {
        $productCd = $request->productCd;
        $syouhin1Data = QueryHelper::fetchSingleResult("select * from syouhin1 where kokyakusyouhinbango = '$productCd'");
        if ($syouhin1Data) {
            $data23 = $syouhin1Data->data23;
            $sql = "where other1='$data23'";
            $search_sql = "AND other1='$data23'";
        } else {
            $data23 = "";
            $sql = "";
            $search_sql = "";
        }

        $other_id = $request->product_sub_value ?? null;
        $other_name = $request->order_name ?? false;
        $other_alt_id = $request->order_id ?? false;
        $type = $request->type ?? false;
        $default = $request->default == 1 ? $request->default : false;
        $bango = request('userId');
        $query = AllOrderProductSubs::data($bango);
        if ($type) {
            $query .= " where product_sub_cd = '$other_alt_id' and product_sub_name = '$other_name'";
        } else if ($default) {
            $query .= $sql;
        } else {
            $query .= " where (product_sub_cd = '$other_id' or product_sub_name like '%$other_id%') $search_sql";
        }

        if ($type) {
            $other = QueryHelper::fetchSingleResult($query);
            return response()->json($other);
            //$html = view('order.order-entry.include.product_sub.product_sub_detail', compact('other'))->render();
        } else if ($default) {
            $others = QueryHelper::fetchResult($query);
            $html = view('order.order-entry.include.product_sub.product_sub', compact('others'))->render();
        } else {
            $others = QueryHelper::fetchResult($query);
            $html = view('order.order-entry.include.product_sub.product_sub', compact('others'))->render();
        }

        return response()->json(['status' => 'view render', 'html' => $html, 'data' => $others]);
    }



    public function save(Request $request, $bango){
        
        // echo "<pre>";
        // var_dump($request->all());
        $file = $request->file('proposal_file');
        if ($request->syouhinbango_jouhou == 1) {
            if($this->checkOrderNumberExist($bango, $request->number_search)->getOriginalContent()["duplicate_data_status"] == false){
                $insert = SupportEntry::create($request, $bango, $file);
                if (is_array($insert) && $insert['status'] == 'ok') {
                    return $insert;
                } else if (is_array($insert) && $insert['status'] == 'confirm') {
                    return "confirm";
                } else if (is_array($insert) && $insert['status'] == 'ng') {
                    return $insert;
                } else {
                    $errors = $insert->all();
                    return ['err_field' => $insert, 'err_msg' => $errors];
                }
            }else{
                $d = $duplicate_error_msg = $this->checkOrderNumberExist($bango, $request->number_search)->getOriginalContent()["duplicate_error_data_message"];
                return ['duplicate_error_data_message' => $d];
            }
        }


        // update
        if ($request->syouhinbango_jouhou == 2) {
           // echo $request->orderhenkan_ordertypebango2_maxval;
           // echo "update";
                $file = $request->file('proposal_file');
                $update = SupportEntry::update($request, $bango, $file);
                if (is_array($update) && $update['status'] == 'ok') {
                    return $update;
                } else if (is_array($update) && $update['status'] == 'confirm') {
                    return "confirm";
                } else if (is_array($update) && $update['status'] == 'ng') {
                    return $update;
                } else {
                    $errors = $update->all();
                    return ['err_field' => $update, 'err_msg' => $errors];
                }
        }


         // delete
        if ($request->syouhinbango_jouhou == 3) {
                $file = $request->file('proposal_file');
                $delete = SupportEntry::delete($request, $bango, $file);
                if (is_array($delete) && $delete['status'] == 'ok') {
                    return $delete;
                } else if (is_array($delete) && $delete['status'] == 'confirm') {
                    return "confirm";
                } else if (is_array($delete) && $delete['status'] == 'ng') {
                    return $delete;
                } else {
                    $errors = $delete->all();
                    return ['err_field' => $delete, 'err_msg' => $errors];
                }
        }
    }



    public function order_detail_read(Request $request, $bango){
        $order_number = request('order_number');
        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        
        $syouhinbango_jouhou = $request->syouhinbango_jouhou;

        if($syouhinbango_jouhou == 2 || $syouhinbango_jouhou == 3){
             $query = SupportDetail::edit_2_data($bango, $order_number);
        }else{
            if($syouhinbango_jouhou == 1){
                 $query = SupportDetail::creation_1_data($bango, $order_number);
            }
        }
       

        $bango = $bango;
        $supportDetail = collect(QueryHelper::fetchSingleResult($query));

        $hasSupportDetail = $supportDetail->count();
        return (['supportDetail' => $supportDetail, 'hasOrder' => $hasSupportDetail]);
    }

    public function openProductModal(Request $request, $bango)
    {
        $id = \request('kokyakusouhinBango');
        $query = AllProductDescription::data($bango);
        $query .= " where urlsm = '$id'";
        $data['gazou'] = QueryHelper::fetchSingleResult($query);
        return $data;
    }

    public function openProductSubModal(Request $request, $bango)
    {
        $product_sub_cd = $request->product_sub_cd;
        $product_sub_name = $request->product_sub_name;
        $data = allOthers::data($bango)
            ->whereRaw("other2_original ='" . $product_sub_cd . "'")
            ->whereRaw("other21 ='" . $product_sub_name . "'")->toSql();

        $data = collect(QueryHelper::fetchSingleResult($data))->toArray();

        if (isset($data['other3'])) {
            $categorykanris1 = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'E4'")->where("category2 = '" . $data['other3'] . "'")->get()->execute();
            $data['other3cat4'] = $categorykanris1[0]->category4;
            $categorykanris2 = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'E5'")->where("category2 = '" . $data['other4'] . "'")->get()->execute();
            $data['other4cat4'] = $categorykanris2[0]->category4;
            $categorykanris3 = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'E8'")->where("category2 = '" . $data['other25'] . "'")->get()->execute();
            $data['other25cat4'] = $categorykanris3[0]->category4;
        }

        $array = [];
        foreach ($data as $key => $value) {
            $array[$key] = $value;
        }

        return $array;
    }

    public function digitConversion($bango, $digits)
    {
        return SupportEntry::convertNumberToString($digits);
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
        /*return $collection->filter(function ($item) {
            $orderBangoType2 = QueryHelper::fetchSingleResult("select max(ordertypebango2) from orderhenkan where kokyakuorderbango = '$item->order_number'")->max;
            return $item->ordertypebango2 == $orderBangoType2;
        })->paginate($paginate);*/

        return $collection->paginate($paginate);
    }

    public function productDetails(Request $request)
    {
        $productCd = $request->productCd;
        $syouhin1Data = QueryHelper::fetchSingleResult("
                select syouhin1.*,syouhin4.dspbango,syouhin4.color,syouhin2.konpoumei as s2konpoumei,
                v_torihikisaki.r17_3 as season_detail
                from syouhin1
                join syouhin4 on syouhin4.bango=syouhin1.bango
                left join v_torihikisaki
                on syouhin1.season = v_torihikisaki.torihikisaki_cd
                left join syouhin2 on  syouhin1.bango = syouhin2.bango
                where kokyakusyouhinbango = '$productCd'
                ") ?? null;

        if ($syouhin1Data) {
            $syouhinbangoData24 = $syouhin1Data->data24;
            $syouhinbango = $syouhin1Data->bango;
            $dspbango = $syouhin1Data->dspbango;
            $color = $syouhin1Data->color;
            $season = $syouhin1Data->season;
            $season_detail = $syouhin1Data->season_detail;
            $syouhin2konpoumei = $syouhin1Data->s2konpoumei;
            $childCount = QueryHelper::fetchSingleResult("select count( bango) from syouhin4 where chardata4 = '$productCd' and dspbango is not null")->count;
            $childCount = $childCount ? $childCount : null;
            $data100 = $syouhin1Data->data100 ?? null;
            if ($syouhin1Data->data100 == "D160") {
                $datatype = "parent";
            } else {
                $datatype = "child";
            }
        } else {
            $syouhinbango = "";
            $dspbango = "";
            $color = "";
            $season = "";
            $season_detail = "";
            $datatype = "";
            $syouhinbangoData24 = "";
            $syouhin2konpoumei = "";
            $childCount = "";
            $data100 = "";
        }

        $companyCd = $request->companyCd;
        $kokyaku1Data = QueryHelper::fetchSingleResult("select * from kokyaku1 where yobi12 = '$companyCd'") ?? null;
        if ($kokyaku1Data) {
            //$kcode4 = substr($kokyaku1Data->kcode4, 0, 1);
            $kokyaku1_bango = $kokyaku1Data->bango;
            $haisoujouhouData = QueryHelper::fetchSingleResult("select * from haisoujouhou where syukei1 = '$kokyaku1_bango'") ?? null;
            if ($haisoujouhouData) {
                $address = $haisoujouhouData->address;
            } else {
                $address = "";
            }
        } else {
            //$kcode4 = "";
            $address = "";
        }

        $result = array();
        $kakakuData = QueryHelper::fetchSingleResult("select * from kakaku where syouhinbango = '$syouhinbango' AND syutenjyouken='$companyCd'") ?? null;
        if (!$kakakuData) {
            $kakakuData = QueryHelper::fetchSingleResult("select * from kakaku where syouhinbango = '$syouhinbango' AND syutenjyouken is null") ?? null;
        }

        if ($kakakuData && $address == 'D602') {
            $result['status'] = "ok";
            $result['hanbaisu'] = $kakakuData->hanbaisu;
            $result['yoyakukanousu'] = $kakakuData->yoyakukanousu;
            $result['sortbango'] = $kakakuData->sortbango;
            $result['dataint01'] = $kakakuData->dataint01;
            $result['yoyakusu'] = $kakakuData->yoyakusu;
            $result['dspbango'] = $dspbango;
            $result['color'] = $color;
            $result['season'] = $season;
            $result['season_detail'] = $season_detail;
            $result['datatype'] = $datatype;
            $result['data24'] = $syouhinbangoData24;
            $result['konpoumei'] = $syouhin2konpoumei;
            $result['childCount'] = $childCount;
            $result['data100'] = $data100;
        } else if ($kakakuData && $address == 'D601') {
            $result['status'] = "ok";
            $result['hanbaisu'] = $kakakuData->kakaku;
            $result['yoyakukanousu'] = $kakakuData->yoyakukanousu;
            $result['sortbango'] = $kakakuData->sortbango;
            $result['dataint01'] = $kakakuData->dataint01;
            $result['yoyakusu'] = $kakakuData->yoyakusu;
            $result['dspbango'] = $dspbango;
            $result['color'] = $color;
            $result['season'] = $season;
            $result['season_detail'] = $season_detail;
            $result['datatype'] = $datatype;
            $result['data24'] = $syouhinbangoData24;
            $result['konpoumei'] = $syouhin2konpoumei;
            $result['childCount'] = $childCount;
            $result['data100'] = $data100;
        } else {
            //$result['status'] = "not_ok";
            $result['status'] = "ok";
            $result['hanbaisu'] = $kakakuData->kakaku;
            $result['yoyakukanousu'] = $kakakuData->yoyakukanousu;
            $result['sortbango'] = $kakakuData->sortbango;
            $result['dataint01'] = $kakakuData->dataint01;
            $result['yoyakusu'] = $kakakuData->yoyakusu;
            $result['dspbango'] = $dspbango;
            $result['color'] = $color;
            $result['season'] = $season;
            $result['season_detail'] = $season_detail;
            //$result['datatype'] = $datatype;
            $result['data24'] = $syouhinbangoData24;
            $result['konpoumei'] = $syouhin2konpoumei;
        }

        return $result;
    }

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
        if ($haisouBango) {
            $other2 = QueryHelper::fetchSingleResult("select * from others2 where otherInt1 = $haisouBango");
            $other1 = $other2->other1 ?? null;
            if ($other1) {
                if ($other1 == '1 会社M') {
                    $paymentMethod = $companyData->ytoiawseend ?? null;
                    $immediateClassification = explode(' ', $companyData->kcode3)[0] ?? null;
                } elseif ($other1 == '2 事業所M') {
                    $paymentMethod = $other2->other4 ?? null;
                    $immediateClassification = explode(' ', $other2->other2)[0] ?? null;
                }
            }
        }
        if ($companyBango) {
            $haisoujouhou = QueryHelper::fetchSingleResult("select * from haisoujouhou where syukei1 = $companyBango");
            $acceptanceConditions = $haisoujouhou->netlogin ?? null;
        }

        return response()->json(['paymentMethod' => $paymentMethod, 'immediateClassification' => $immediateClassification, 'acceptanceConditions' => $acceptanceConditions]);
    }

    public function soldWisePj($bango)
    {
        $catchsm = \request('catchsm');
        $pjs = QueryHelper::fetchResult("select * from gazou2 where catchsm = '$catchsm' order by datatxt0096 desc ");
        $html = "<option value=" . null . ">プロジェクトを選択してください</option>";
        if (isset($pjs)) {
            foreach ($pjs as $pj) {
                $html .= "<option value=" . $pj->url . " >" . $pj->urlsm . "</option>";
            }
        }
        return $html;
    }
    public function checkYoteimeterStatus($bango, $orderId)
    {
        $checkYoteimeter = QueryHelper::fetchSingleResult("select syouhinid from misyukko where syouhinid='$orderId' and yoteimeter = '2'");
        $hikiatesyukko = QueryHelper::fetchSingleResult("select datachar04 from hikiatesyukko where syouhinid='$orderId'")->datachar04 ?? null;
        if (!empty($checkYoteimeter)) {
            $contain_deleted_item = true;
        } else {
            $contain_deleted_item = false;
        }

        return response()->json(['delStatus' => $contain_deleted_item, 'hikiatesyukko' => $hikiatesyukko]);
    }

    public function billingWisePaymentDate()
    {
        $salesDate = strpos(\request('paymentDate'), '/') ? str_replace('/', '', \request('paymentDate')) : \request('paymentDate');
        $billingDestination = strpos(\request('billingDestination'), '/') ? str_replace('/', '', \request('billingDestination')) : \request('billingDestination');
        list($day, $month, $isForward, $addDayForSystemDate) = SupportEntry::calculateBillingDates($billingDestination);;

        if ($month !== null && $day !== null && $isForward !== null && $addDayForSystemDate !== null) {
            $isForward = $isForward == '1 翌営業日' ? true : false;
            $saleYear = (int) substr($salesDate, 0, 4);
            $saleMonth = (int) substr($salesDate, 4, 2);
            $saleDay =  (int) substr($salesDate, 6, 2);
            $saleDate = Carbon::createFromDate($saleYear, $saleMonth, $saleDay);
            $closingDate =  $this->getClosingDate($addDayForSystemDate);
            if ($saleDate->greaterThan($closingDate)) {
                $saleMonth += 1;
            }
            $saleMonth += $month;
            $paymentDate = $this->getCalculatePaymentDate($saleMonth, $day, $saleYear);
            if ($paymentDate instanceof Carbon) {
                $paymentDate = $this->calculateDateHolidayWise($paymentDate, $isForward);
                $paymentDate = Carbon::parse($paymentDate)->format("Ymd");
            } else {
                $paymentDate = Carbon::parse($paymentDate)->format("Ymd");
            }
            return response()->json(['paymentDate' => $paymentDate]);
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
            return response()->json(['errormsg' => $msg]);
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
    public function getCalculatePaymentDate($saleMonth, $saleDay, $saleYear)
    {
        $currentMonth = $saleMonth > 12 ? 12 : $saleMonth;
        $leftMonth = $saleMonth > 12 ? $saleMonth - 12 : 0;
        $calYear = (int) ceil($leftMonth / 12);
        $calYear = $saleYear + $calYear;
        if (!checkdate($saleMonth, $saleDay, $calYear)) {
            if ($leftMonth) {
                if (!checkdate($leftMonth, $saleDay, $calYear)) {
                    return $this->calculateDateForInvalidDate($calYear, $leftMonth);
                }
                $paymentDate = Carbon::createFromDate($saleYear, $currentMonth, $saleDay)->addMonths($leftMonth);
            } else {
                $paymentDate = Carbon::createFromDate($calYear, $saleMonth, 01)->endOfMonth();
            }
            $paymentDate = $this->excludeSaturdayAndSunday($paymentDate);
            return str_replace('-', '', $paymentDate->toDateString());
        }
        return Carbon::createFromDate($saleYear, $currentMonth, $saleDay);
    }
}
