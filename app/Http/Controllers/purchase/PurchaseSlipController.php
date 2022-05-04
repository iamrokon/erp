<?php
namespace App\Http\Controllers\purchase;

use App\AllClass\ButtonMsg;
use App\AllClass\db\QueryHandler;
use App\AllClass\purchase\purchaseSlip\AllPurchaseSlip;
use App\AllClass\purchase\purchaseSlip\PurchaseSlipHeaders;
use App\AllClass\purchase\purchaseSlip\PurchaseSlip;
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

class PurchaseSlipController extends Controller
{
    private $headers = [
        '行' => 'line_number',
        '表示順' => 'display_order',
        'グループ' => 'group',
        '受注先' => 'order_to',
        '仕入担当' => 'incharge_purchasing',
        '商品' => 'product_cd',
        '仕入数量' => 'purchase_quantity',
        '仕入単価' => 'purchase_unit_price',
        '仕入明細金額' => 'purchase_line_amount',
        '仕入明細消費額' => 'purchase_consumption_amount',
        '会計科目' => 'accounting_subject',
        '会計内訳' => 'accounting_breakdown',
        '明細備考' => 'remarks',
        '保留' => 'retain',
        '最終作成日時' => 'last_datetime',

    ];
    public function postPurchaseSlip(Request $request)
    {
        
        $bango = request('userId');
        $data_from_view = $request->all();
        $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7501'");
        $review_orderbango = $reviewData->orderbango;
        $tantousya = tantousya::find($bango);
        $c4Categorykanries = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'C4' and suchi2 = 0 order by suchi1 ASC ");
        $incharge_purchasing = QueryHelper::fetchResult("select * from tantousya where deleteflag = 0 and ztanka='$review_orderbango' order by bango");
//         //accounting subject dropdown
        $accounting_subjects = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'J1' and suchi2 = 0 order by suchi1 ASC ");
        $accounting_breakdowns = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'J2' and suchi2 = 0 order by suchi1 ASC ");

        $headers = PurchaseSlipHeaders::headers($bango);
        $table_headers = PurchaseSlipHeaders::headers($bango, 'table_headers');
        $route = 'purchaseSlipTableSetting';
        $redirect_path = 'purchaseSlipReload';
        //dd($headers);
        $buttonMessage = ButtonMsg::read($bango);
        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 20;
        }
        $old = $request->all();
        if (!empty($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' )) {
        $fsRemoveTableKeys=[];
        $fsReqData= $this->removeDataFromView($data_from_view, $fsRemoveTableKeys);
            $temp_table= "purchase_slip_temp";

            try {
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort') {

                    $allTableRequest = $this->modifyBladeData($data_from_view, $fsRemoveTableKeys);

                    $query= AllPurchaseSlip::readData($bango,$fsReqData);
                    $tax_rate = self::calculateTaxRate($data_from_view['reg_sold_to'],$bango);

                    $purchaseSlipInfos = $this->searchDataFetch($query, $allTableRequest, $bango, $temp_table, $pagination);
                    // dd($fsReqData);
                    if ($purchaseSlipInfos->items() == null && $purchaseSlipInfos->currentPage() != 1) {
                        $currentPage = ($purchaseSlipInfos->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $purchaseSlipInfos = $this->searchDataFetch($query, $allTableRequest, $bango, $temp_table, $pagination);
                    }
//                    dd($purchaseOrderInfos->total());
                    if ($purchaseSlipInfos->total() == 0) {
                        if(Session::has('defaultSrc')){
                            if (Session::get('defaultSrc')=='1'){
                                $purchaseSlipError = '該当するデータがありません。';
                            }
                            else{
                                $purchaseSlipError = '';
                            }
                        }
                        else{
                            $purchaseSlipError = '';
                        }
                    } else {
                        $purchaseSlipError = '';
                    }
                }
                else if ($data_from_view['Button'] == 'xls') {
                   //dd('are ruko jara...sabar karo');
                    $query= AllPurchaseSlip::readData($bango,$fsReqData);
                    $allTableRequest = $this->modifyBladeData($data_from_view, $fsRemoveTableKeys);
                    $searched = $this->searchDataFetch($query, $allTableRequest, $bango, $temp_table, $pagination, 'xls');
                    $headers = $this->headers;
                    $excelName = '定期仕入伝票入力.xlsx';
                    return $this->excelDownload($headers, $searched, $excelName);
                }
            } catch (\Exception $e) {
                $purchaseSlipInfos = collect([])->paginate($pagination);
                if ($purchaseSlipInfos->total() == 0) {
                    if(Session::has('defaultSrc')){
                        if (Session::get('defaultSrc')=='1'){
                            $purchaseSlipError = '該当するデータがありません。';
                        }
                        else{
                            $purchaseSlipError = '';
                        }
                    }
                    else{
                        $purchaseSlipError = '';
                    }
                } else {
                    $purchaseSlipError = '';
                }
            }
            return view('purchase.purchaseSlip.mainPurchaseSlip',compact('bango','tantousya','purchaseSlipInfos','headers','buttonMessage','incharge_purchasing','accounting_subjects','accounting_breakdowns','fsReqData','old', 'c4Categorykanries', 'tax_rate','route','table_headers','redirect_path'));
        }

        else if (!empty(request('firstButton')) && request('firstButton')== 'topSearch' || !empty(request('Button')) && request('Button') == 'refresh')
        {
            $old=[];
            $fsReqData= $request->all();
            $query= AllPurchaseSlip::readData($bango,$data_from_view);
            $tax_rate = self::calculateTaxRate($data_from_view['reg_sold_to'],$bango);
            if ($query=='ng'){
                $purchaseSlipError = '該当するデータがありません。';
                session()->put('defaultSrc', '0');
                $purchaseSlipInfos=collect([])->paginate($pagination);
            }
            else{
                if (count(QueryHelper::fetchResult($query))==0){
                    $purchaseSlipError = '該当するデータがありません。';
                    session()->put('defaultSrc', '0');
                }
                else{
                    $purchaseSlipError = '';
                    session()->put('defaultSrc', '1');
                }
                $purchaseSlipInfos = collect(QueryHelper::fetchResult($query))->paginate($pagination);/*collect([])->paginate(20);*/
            }

            return view('purchase.purchaseSlip.mainPurchaseSlip',compact('bango','tantousya','purchaseSlipInfos','headers','buttonMessage','incharge_purchasing','accounting_subjects','accounting_breakdowns','fsReqData','old', 'c4Categorykanries', 'tax_rate','route','table_headers','redirect_path'));
        }

        $purchaseSlipInfos =collect([])->paginate(20);
        return view('purchase.purchaseSlip.mainPurchaseSlip',compact('bango','tantousya','purchaseSlipInfos','headers','buttonMessage','incharge_purchasing','accounting_subjects','accounting_breakdowns','old', 'c4Categorykanries','route','table_headers','redirect_path'));
    }

    public function handleCategoriKanries(Request $request)
    {
        //return "ggg";

        $categoryType = request('category_type') ? trim(\request('category_type')) : null;
        $categoryValue = request('category_value') ? trim(\request('category_value')) : null;
        if ($categoryType == "C4") {
            $C5html = PurchaseSlip::renderCategoryKanri(2, $categoryValue, 'C5');
            $C6html = PurchaseSlip::renderCategoryKanri(2, $categoryValue, 'maljabena');
            $E7html = PurchaseSlip::renderCategoryKanri(2, $categoryValue, 'E7');
            $E6html = PurchaseSlip::renderCategoryKanri(2, $categoryValue, 'E6');
            return response()->json(["status" => "view rendered", "html" => ['C5html' => $C5html, 'C6html' => $C6html, 'E7html' => $E7html, 'E6html' => $E6html]]);
        } elseif ($categoryType == "C6") {
        } elseif ($categoryType == "C5") {
            $C6html = PurchaseSlip::renderCategoryKanri(4, $categoryValue, 'C6');
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

        $html = view('order.order-entry.include.product.partial', compact('syouhin1s'))->render();
        return response()->json(['status' => 'view render', 'html' => $html, 'syouhin1s' => $syouhin1s]);
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
    
    public function save(Request $request, $bango)
    {
        return PurchaseSlip::createEdit($request->all(), $bango);
    }
    
    public function dataCreate(Request $request, $bango)
    {
        //return $request;
        return PurchaseSlip::dataCreate($request->all(), $bango);
    }

    //calculate tax rate
    public function calculateTaxRate($company_data,$bango){
        $kokyakuCode = substr($company_data, 0,6);
        $haisouCode = substr($company_data, 6,2);
        $kokyaku = QueryHelper::select(['bango,mallsoukobango1'])->from('kokyaku1')->where("yobi12 = '$kokyakuCode' ")->get()->first();
        $haisoujouhou = QueryHelper::select(['bunrui4,bunrui5'])->from('haisoujouhou')->where("syukei1 = '$kokyaku->bango' ")->get()->first();
        $others2 = QueryHelper::fetchResult("select other1,other33,other35 from others2 where otherint1 = (select bango from haisou where haisou.shikibetsucode = '$kokyakuCode' and haisou.torihikisakibango = '$haisouCode')");
        $mallsoukobango1 = $kokyaku->mallsoukobango1;
        if(explode(' ', $others2[0]->other1)[0] == '1'){
            $percentage['format'] = substr($haisoujouhou->bunrui5,2,1);
            $data_status = $haisoujouhou->bunrui4;
            $category1 = substr($data_status,0,2);
            $category2 = substr($data_status,2,2);
            $categorykanri = QueryHelper::fetchSingleResult("select substring(patternsub2,1,2) as patternsub2 from categorykanri where category1 = '$category1' AND category2 = '$category2' ");
            $percentage['value'] = (int) $categorykanri->patternsub2;
        }else{
            $percentage['format'] = substr($others2[0]->other35,2,1);
            $data_status = $others2[0]->other33;
            $category1 = substr($data_status,0,2);
            $category2 = substr($data_status,2,2);
            $categorykanri = QueryHelper::fetchSingleResult("select substring(patternsub2,1,2) as patternsub2 from categorykanri where category1 = '$category1' AND category2 = '$category2' ");
            $percentage['value'] = (int) $categorykanri->patternsub2;
        }
        return $percentage;
    }

    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = PurchaseSlipHeaders::$page_no;
        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $id)->where('kengenchar05', '06-29')->get()->count();
        $Setting = TableSetting::setting($this->headers, $id, $pageNo);
        
        return $Setting;
    }

    public function tableSettingSave(Request $request, $id, $bango, $type = null)
    {
        $pageNo = PurchaseSlipHeaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '定期仕入伝票入力', $type);
    }

    private function modifyBladeData($alldata,$index){
        $newArr=[];

        foreach ($index as $key => $value) {
            $newArr[$value]=!empty($alldata[$value])?$alldata[$value]:null;
        }
        return $newArr;
    }
}
