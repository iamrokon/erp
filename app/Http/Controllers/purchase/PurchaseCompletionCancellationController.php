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
use App\AllClass\purchase\purchaseCompletionCancellation\AllPurchaseCompletionCancellation;
use App\AllClass\purchase\purchaseCompletionCancellation\validatePurchaseCompletionCancellation;
use App\AllClass\order\orderEntry\OrderEntry;

class PurchaseCompletionCancellationController extends Controller
{
    public function postPurchaseCompletionCancellation(Request $request){
        $bango = request('userId');
         //check validation for first search
         if($request->ajax()){
            $validator = validatePurchaseCompletionCancellation::validate($request,$bango);
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

        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $ztanka = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7501'")->orderbango;
        $name = QueryHelper::select(['bango','name'])->from('tantousya')->where("DeleteFlag = '0' ")->where("mail4 = 'C310' ")->where("mail5 != '' ")->where("ztanka = '$ztanka' ")->orderBy("bango asc")->get()->execute();
        // $bangos = $name->bango;
        $isSelected = null;
        foreach($name as $key => $val){
            if($val->bango == $bango){
                $isSelected = $bango;
            }
        }
        // dd($isSelected);
        $categorykanriesU1 = QueryHelper::fetchResult("select category1,category2,category4 from categorykanri where category1 = 'V1' and suchi2 = 0 and category2 not in ('50','60') order by suchi1 ASC ");
        $color = '0630仕入完了取消画面';
        $request1s = QueryHelper::select(['syouhinbango', 'jouhou'])->from('request')->where("color = '0630仕入完了取消画面'")->orderBy("bango asc")->get()->execute();
        $U2Data = QueryHelper::fetchResult("select category1,category2,category4 from categorykanri where category1 = 'D9' ORDER BY category2 ASC");
        $data309 = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'E1' and suchi2 = 0 order by suchi1 ASC "); 
        $data310 = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'J1' and suchi2 = 0 order by suchi1 ASC "); 
        $data311 = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'J2' and suchi2 = 0 order by suchi1 ASC ");  
        $c4Categorykanries = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'C4' and suchi2 = 0 order by suchi1 ASC ");
        return view('purchase.purchaseCompletionCancellation.mainPurchaseCompletionCancellation',compact('bango', 'tantousya', 'name', 'categorykanriesU1','request1s', 'U2Data', 'c4Categorykanries', 'data309', 'data310', 'data311', 'isSelected'));
    }
    public function getEmployeeCD(Request $request, $bango)
    {
        $category = $request->category;
        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $ztanka = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7501'")->orderbango;
        $name = QueryHelper::select(['bango','name'])->from('tantousya')->where("DeleteFlag = '0' ")->where("mail4 = '$category' ")->where("mail5 != '' ")->where("ztanka = '$ztanka' ")->orderBy("bango asc")->get()->execute();
        // $bangos = $name->bango;
        $isSelected = null;
        $html = "<option value>-</option>";
        foreach($name as $key => $val){
            if($val->bango == $bango){
                $isSelected = $bango;
                $html .= "<option selected value=" . $val->bango . ">" .$val->bango." ". $val->name . "</option>";
            }else{
                $html .= "<option value=" . $val->bango . ">" .$val->bango." ". $val->name . "</option>";
            }
        }
        return (['names' => $name, 'isSelected' => $isSelected, 'html' => $html]);
    }
    public function orderDetails(Request $request, $bango)
    {
        $orderId = $request->orderId;
        $query = AllPurchaseCompletionCancellation::data($bango, $orderId);
        $orderDetail = QueryHelper::fetchSingleResult($query);
        $ordertypebango2 = QueryHelper::fetchSingleResult("select max(ordertypebango2) from orderhenkan where kokyakuorderbango = '$orderId' ")->max ?? 0;
        $salesDetail = QueryHelper::fetchSingleResult("Select * from orderhenkan where synchroorderbango = '0' and kokyakuorderbango = '$orderId' and ordertypebango2 = $ordertypebango2");
        // dd($orderDetail);
        $errorMessage = array();
        // if($orderDetail && ($orderDetail->datachar02 == 'U122' || $orderDetail->datachar02 == 'U160')){
        //     array_push($errorMessage, "粗利調整できない受注データです。");
        // }
        // dd(empty($orderDetail));
        if(empty($orderDetail)){
            array_push($errorMessage, "該当するデータがありません。");
        }
        if($orderDetail && $orderDetail->datachar16 == '2'){
            array_push($errorMessage, "仕入完了計算を行っていない受注です。");
        }
        if(is_null($salesDetail)){
            array_push($errorMessage, "仕入完了計算を行っていない受注です。");
        }
        $orderDetail = collect($orderDetail);
        $hasOrderDetail = $orderDetail->count();
        return (['orderDetails' => $orderDetail, 'errorMessage' => $errorMessage, 'hasOrder' => $hasOrderDetail]);
    }
    public function save(Request $request, $bango)
    {
        $insert = GrossProfitAdjustmentInputDataEntry::create($request, $bango);
        if (is_array($insert) && $insert['status'] == 'ok') {
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
        // $querystring .= " and syouhin1.data29 != 'F62' and syouhin1.data52 != 'C710' and syouhin1.isuriage = 0 order by syouhin1.kokyakusyouhinbango limit 30 ";
        $querystring .= " and syouhin1.koyuujouhou LIKE 'C5__90'";
        $querystring .= " and syouhin1.color LIKE 'C6__90002' ";
        $querystring .= " and syouhin1.data29 != 'F62' and  syouhin1.isuriage = 0 order by syouhin1.kokyakusyouhinbango limit 30 ";
        $syouhinDatas = QueryHelper::fetchResult($querystring);
        $syouhin1s = array_map(function ($item) {
            $data100 = QueryHelper::fetchSingleResult("select data100 from syouhin1 where bango = '$item->bango' ")->data100 ?? null;
            if ($data100 == "D160") {
                $syouhin4 = QueryHelper::fetchResult("select bango from syouhin4 where chardata4 = '$item->kokyakusyouhinbango' and dspbango is not null") ?? [];
                if ($syouhin4) {
                    $syouhin4Data = [];
                    array_map(function ($item) use (&$syouhin4Data) {
                        array_push($syouhin4Data, $item->bango);
                    }, $syouhin4);
                    $syouhin4 = implode(',', $syouhin4Data);
                    $expected_result = QueryHelper::fetchResult("select syouhin1.kokyakusyouhinbango, syouhin1.name, syouhin1.tokuchou ,syouhin1.data22,syouhin1.data51,syouhin1.url,syouhin1.kongouritsu,syouhin1.mdjouhou,syouhin4.dspbango,syouhin4.color as newcolor4 from syouhin1,syouhin4 where syouhin1.bango in ($syouhin4) and syouhin1.bango=syouhin4.bango ") ?? [];
                    $countExpectedResult = QueryHelper::fetchSingleResult("select count(syouhin1.*) from syouhin1,syouhin4 where syouhin1.bango in ($syouhin4) and syouhin1.bango=syouhin4.bango")->count ?? 0;
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
        $html = view('other.grossProfitAdjustmentInput.product.partial', compact('syouhin1s'))->render();
        return response()->json(['status' => 'view render','syouhinDatas'=>$syouhinDatas, 'html' => $html, 'syouhin1s' => $syouhin1s]);
    }
    public function productDetails(Request $request)
    {
        $productCd = $request->productCd;
        $syouhin1Data = QueryHelper::fetchSingleResult("select * from syouhin1 where kokyakusyouhinbango = '$productCd'") ?? null;
        $syouhinbango = $syouhin1Data->bango;
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