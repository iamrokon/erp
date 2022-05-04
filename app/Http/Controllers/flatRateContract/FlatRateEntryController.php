<?php

namespace App\Http\Controllers\flatRateContract;
use App\AllClass\master\nameMaster\allCategorykanri;
use Illuminate\Http\Request;
use App\tantousya;
use App\kengen;
use App\requestTable;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\flatRateContract\flatRateEntry\allFlatRateEntry;
use App\AllClass\flatRateContract\flatRateEntry\FlatRateEntry;
use App\AllClass\flatRateContract\flatRateEntry\createFlatRateEntry;
use App\AllClass\flatRateContract\flatRateEntry\editFlatRateEntry;
use App\AllClass\flatRateContract\flatRateEntry\deleteFlatRateEntry;
use App\AllClass\flatRateContract\flatRateEntry\firstValidation;
use App\AllClass\flatRateContract\flatRateEntry\validateOrderShipping;
use App\AllClass\flatRateContract\flatRateEntry\validateMaintenance;
use App\AllClass\order\orderEntry\searchCompany;
use App\AllClass\order\orderEntry\searchCompany2;
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

class   FlatRateEntryController extends Controller
{

    public function index(Request $request)
    {
        $bango = request('userId');
        $flat_rate_number = request('flat_rate_number');
        $tantousya = tantousya::find($bango);

        //get categorykanri data
        $datatxt0112Data = QueryHelper::fetchResult("select category1,RIGHT(category2,2) as category2,category4,suchi1,suchi2 from categorykanri where category1 = 'G1' and (suchi2 = 0 or suchi2 is null) ORDER BY suchi1 ASC");
        $datatxt0114Data = QueryHelper::fetchResult("select category1,RIGHT(category2,2) as category2,category4,suchi1,suchi2 from categorykanri where category1 = 'H1' and (suchi2 = 0 or suchi2 is null) ORDER BY suchi1 ASC");
        $datatxt0121Data = QueryHelper::fetchResult("select category1,RIGHT(category2,2) as category2,category4,suchi1,suchi2 from categorykanri where category1 = 'J4' and (suchi2 = 0 or suchi2 is null) ORDER BY suchi1 ASC");
        $catB1Data = QueryHelper::fetchResult("select category1,RIGHT(category2,2) as category2,category4,bango,suchi2 from categorykanri where category1 = 'B1' and (suchi2 = 0 or suchi2 is null) order by suchi1 ASC ");
        $catG3Data = QueryHelper::fetchResult("select category1,RIGHT(category2,2) as category2,category4,bango,suchi2 from categorykanri where category1 = 'G3' and (suchi2 = 0 or suchi2 is null) order by suchi1 ASC ");
        $catC4Data = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'C4' and (suchi2 = 0 or suchi2 is null) order by suchi1 ASC ");
        $catA9Data = QueryHelper::fetchResult("select category1,category2,category4,suchi2 from categorykanri where category1 = 'A9' and (suchi2 = 0 or suchi2 is null) ORDER BY suchi1 ASC");
        $datatxt0122 = QueryHelper::fetchSingleResult("select category1,category2,category4 from categorykanri where category1 = 'J3' and category2='10'");

        //get request data
        $datatxt0111Color = '0302作成区分';
        $datatxt0111 = QueryHelper::select(['syouhinbango', 'jouhou', 'color', 'bango'])->from('request')->where(" color = '$datatxt0111Color'")->orderBy("syouhinbango asc")->get()->execute();
        $color = '0302即時区分';
        $housoukubun = QueryHelper::select(['syouhinbango', 'jouhou', 'color', 'bango'])->from('request')->where(" color = '$color'")->orderBy("syouhinbango asc")->get()->execute();
        $datachar26Color = '0302自動継続フラグ';
        $datachar26 = QueryHelper::select(['syouhinbango', 'jouhou', 'color', 'bango'])->from('request')->where(" color = '$datachar26Color'")->orderBy("syouhinbango asc")->get()->execute();
        $juchusyukko_datachar24Color = '0302受注データ作成フラグ';
        $juchusyukko_datachar24 = QueryHelper::select(['syouhinbango', 'jouhou', 'color', 'bango'])->from('request')->where(" syouhinbango = 2")->where(" color = '$juchusyukko_datachar24Color'")->get()->execute();
        $juchusyukko_datachar25Color = '0302伝票作成フラグ';
        $juchusyukko_datachar25 = QueryHelper::select(['syouhinbango', 'jouhou', 'color', 'bango'])->from('request')->where(" syouhinbango = 2")->where(" color = '$juchusyukko_datachar25Color'")->get()->execute();
        $juchusyukko_datachar26Color = '0302伝票作成フラグ';
        $juchusyukko_datachar26 = QueryHelper::select(['syouhinbango', 'jouhou', 'color', 'bango'])->from('request')->where(" syouhinbango = 2")->where(" color = '$juchusyukko_datachar26Color'")->get()->execute();

        //check orderbango, datachar05
        $reviewData = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7501'");
        if ($reviewData) {
            $orderbango = $reviewData->orderbango;
        } else {
            $orderbango = "";
        }
        $datachar05Info = QueryHelper::fetchResult("select bango,name from tantousya where ztanka = '$orderbango' and deleteflag = 0 order by bango");
        $datachar02Info = QueryHelper::fetchResult("select bango,name from tantousya where ztanka = '$orderbango' and deleteflag = 0 AND mail4 = 'C320' ");

        //check orderbango
        $reviewData2 = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7503'");
        if ($reviewData2) {
            $compare_contact_period = $reviewData2->orderbango;
        } else {
            $compare_contact_period = "";
        }
        
        return view('flatRateContract.flatRateEntry.mainFlatRateEntry', compact('bango', 'tantousya', 'datatxt0112Data', 'datatxt0111', 'datachar26', 'juchusyukko_datachar24', 'juchusyukko_datachar25', 'juchusyukko_datachar26','datatxt0114Data', 'datachar05Info', 'datachar02Info', 'datatxt0121Data', 'catB1Data', 'catG3Data' ,'catC4Data', 'catA9Data', 'datatxt0122', 'housoukubun','flat_rate_number', 'compare_contact_period'));
    }

    //first validation
    public function validateBeforeSubmit(Request $request,$bango){
        $validator = firstValidation::validate($request->all(),$bango);
        $errors = $validator->errors();
        if($errors->any()){
            $err_msg = $errors->all();
            return ['err_field' => $errors, 'err_msg' => $err_msg];
        }else{
            return "ok";
        }
    }

    //validate order shipping
    public function validateOrderShipping(Request $request,$bango){
        $validator = validateOrderShipping::validate($request->all(),$bango);
        $errors = $validator->errors();
        if($errors->any()){
            $err_msg = $errors->all();
            return ['err_field' => $errors, 'err_msg' => $err_msg];
        }else{
            return "ok";
        }
    }

    //validate maintenance popup data
    public function validateMaintenance(Request $request,$bango){
        $validator = validateMaintenance::validate($request->all(),$bango);
        $errors = $validator->errors();
        if($errors->any()){
            $err_msg = $errors->all();
            return ['err_field' => $errors, 'err_msg' => $err_msg];
        }else{
            return "ok";
        }
    }

    public function save(Request $request, $bango){
        $datatxt0111 = request('datatxt0111');
        $file = $request->file('filename');
        if($datatxt0111 == '1'){
            $insert = createFlatRateEntry::create($request->all(), $bango, $file);
            if (is_array($insert) && $insert['status'] == 'ok') {
                $contract_number = $insert['change_id'];
                if(request('datatxt0112') == 10){
                    Session::flash('success_msg', '10 保守 定期定額契約番号' . $contract_number . 'で登録しました。');
                }else if(request('datatxt0112') == 20){
                    Session::flash('success_msg', '20 サブスク 定期定額契約番号' . $contract_number . 'で登録しました。');
                }else if(request('datatxt0112') == 30){
                    Session::flash('success_msg', '30 サブスク（月額）定期定額契約番号' . $contract_number . 'で登録しました。');
                }
                return $insert;
            }elseif(is_array($insert) && $insert['status'] == 'ng'){
               Session::flash('failure_msg','間違えました。');
               return $insert;
            }else if($insert == 'confirmation'){
                return "confirmation_msg";
            } else {
                $errors = $insert->all();
                return ['err_field' => $insert, 'err_msg' => $errors];
            }
        }else if($datatxt0111 == '2'){
            $edit = editFlatRateEntry::edit($request->all(), $bango, $file);
            if (is_array($edit) && $edit['status'] == 'ok') {
                $contract_number = $edit['change_id'];
                if(request('datatxt0112') == 10){
                    Session::flash('success_msg', '10 保守 定期定額契約番号' . $contract_number . 'で登録しました。');
                }else if(request('datatxt0112') == 20){
                    Session::flash('success_msg', '20 サブスク 定期定額契約番号' . $contract_number . 'で登録しました。');
                }else if(request('datatxt0112') == 30){
                    Session::flash('success_msg', '30 サブスク（月額）定期定額契約番号' . $contract_number . 'で登録しました。');
                }
                return $edit;
            }elseif(is_array($edit) && $edit['status'] == 'ng'){
               Session::flash('failure_msg','間違えました。');
               return $edit;
            }else if($edit == 'confirmation'){
                return "confirmation_msg";
            } else {
                $errors = $edit->all();
                return ['err_field' => $edit, 'err_msg' => $errors];
            }
        }else if($datatxt0111 == '3'){
            $delete = deleteFlatRateEntry::delete($request->all(), $bango, $file);
            if (is_array($delete) && $delete['status'] == 'ok') {
                $contract_number = $delete['change_id'];
                if(request('datatxt0112') == 10){
                    Session::flash('success_msg', '10 保守 定期定額契約番号' . $contract_number . 'を削除しました。');
                }else if(request('datatxt0112') == 20){
                    Session::flash('success_msg', '20 サブスク 定期定額契約番号' . $contract_number . 'を削除しました。');
                }else if(request('datatxt0112') == 30){
                    Session::flash('success_msg', '30 サブスク（月額）定期定額契約番号' . $contract_number . 'を削除しました。');
                }
                return $delete;
            }elseif(is_array($delete) && $delete['status'] == 'ng'){
               Session::flash('failure_msg','間違えました。');
               return $delete;
            }else if($delete == 'confirmation'){
                return "confirmation_msg";
            } else {
                $errors = $delete->all();
                return ['err_field' => $delete, 'err_msg' => $errors];
            }
        }

    }

    public function loadRegisteredData(Request $request, $bango){
        $contract_number = request('contract_number');
        $query = allFlatRateEntry::data($bango,$contract_number)->toSql();
        $flatRateEntryInfo = QueryHelper::fetchResult($query);
       
        //product price info
        if(count($flatRateEntryInfo) > 0){
            $productCd = $flatRateEntryInfo[0]->kawasename;
            $companyCd = substr($flatRateEntryInfo[0]->information2,0,6);
            $syouhin1Data = QueryHelper::fetchSingleResult("select bango from syouhin1 where kokyakusyouhinbango = '$productCd' ") ?? null;
            if($syouhin1Data){
                $syouhinbango = $syouhin1Data->bango;
            }else{
                $syouhinbango = "";
            }
            $kakakuData = QueryHelper::fetchSingleResult("select * from kakaku where syouhinbango = '$syouhinbango' AND syutenjyouken='$companyCd'") ?? null;
            if (!$kakakuData) {
                $kakakuData = QueryHelper::fetchSingleResult("select * from kakaku where syouhinbango = '$syouhinbango' AND syutenjyouken is null") ?? null;
            }
            if ($kakakuData) {
                $product_price['yoyakukanousu'] = $kakakuData->yoyakukanousu;
                $product_price['sortbango'] = $kakakuData->sortbango;
                $product_price['dataint01'] = $kakakuData->dataint01;
                $product_price['yoyakusu'] = $kakakuData->yoyakusu;
            }else{
                $product_price['yoyakukanousu'] = 0;
                $product_price['sortbango'] = 0;
                $product_price['dataint01'] = 0;
                $product_price['yoyakusu'] = 0;
            }
        }else{
            $product_price['yoyakukanousu'] = 0;
            $product_price['sortbango'] = 0;
            $product_price['dataint01'] = 0;
            $product_price['yoyakusu'] = 0;
        }
        
        $lineInfo = view('flatRateContract.flatRateEntry.registeredLineData', compact('bango', 'flatRateEntryInfo'))->render();
        return (['flatRateEntryInfo' => $flatRateEntryInfo, 'lineInfo' => $lineInfo, 'product_price' => $product_price]);
    }

    public function filterProductModalData(Request $request){
        $categoryType = request('category_type') ? trim(\request('category_type')) : null;
        $categoryValue = request('category_value') ? trim(\request('category_value')) : null;
        if ($categoryType == "C4") {
            $C5html = FlatRateEntry::renderCategoryKanri(2, $categoryValue, 'C5');
            $C6html = FlatRateEntry::renderCategoryKanri(2, $categoryValue, 'maljabena');
            $E7html = FlatRateEntry::renderCategoryKanri(2, $categoryValue, 'E7');
            $E6html = FlatRateEntry::renderCategoryKanri(2, $categoryValue, 'E6');
            return response()->json(["status" => "view rendered", "html" => ['C5html' => $C5html, 'C6html' => $C6html, 'E7html' => $E7html, 'E6html' => $E6html]]);
        } elseif ($categoryType == "C6") {

        } elseif ($categoryType == "C5") {
            $C6html = FlatRateEntry::renderCategoryKanri(4, $categoryValue, 'C6');
            return response()->json(["status" => "view rendered", "html" => ['C6html' => $C6html]]);
        }
    }


    public function getProductDeatils(Request $request)
    {
        $newRequest = $request->all();
        foreach ($newRequest as $key => $val) {
            if ($val == "" || $val == "null" || $val == null) {
                $newRequest[$key] = null;
            }
        }
        $newRequest = (object)$newRequest;

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
        $querystring .= " and syouhin1.data29 = 'F61' and substring(syouhin1.data21,1,1) = '2' and syouhin1.isuriage = 0 order by syouhin1.kokyakusyouhinbango limit 30 ";

        $syouhinDatas = QueryHelper::fetchResult($querystring);

        $html = view('flatRateContract.flatRateEntry.product.partial', compact('syouhinDatas'))->render();
        return response()->json(['status' => 'view render', 'html' => $html, 'syouhin1s' => $syouhinDatas]);
    }


    public function getSelectedProductDeatils(Request $request)
    {
        $productCode = request('product_code');
        $companyCd = request('companyCd');
        $productInfo = QueryHelper::fetchResult("select syouhin1.bango,syouhin1.kokyakusyouhinbango, syouhin1.name, syouhin1.tokuchou ,syouhin1.data22,syouhin1.data51,syouhin1.data52,syouhin1.url,syouhin1.kongouritsu,syouhin1.mdjouhou,syouhin4.dspbango,syouhin4.color as newcolor4 from syouhin1 left join syouhin4 on syouhin4.bango = syouhin1.bango where kokyakusyouhinbango = '$productCode' ");

        if(count($productInfo)>0){
            $productBango = $productInfo[0]->bango;
            $productCode = $productInfo[0]->kokyakusyouhinbango;
        }else{
            $productBango = "";
            $productCode = "";
        }

        //get line details
        $temp_res = self::lineProductDetails($productCode,$companyCd);
        $rootInfo =(object) array_merge((array) $productInfo[0],$temp_res);
        $result = array();
        $result['rootInfo'] = $rootInfo;
        //$result['childInfo'] = $expected_result;
        return $result;

    }


    public function lineProductDetails($productCd,$companyCd)
    {
        //$productCd = $request->productCd;
        $syouhin1Data = QueryHelper::fetchSingleResult("
                select syouhin1.*,syouhin4.dspbango,syouhin2.konpoumei as s2konpoumei,
                --concat_ws('／',substring(kokyaku1Season.address,1,5),substring(haisouSeason.haisoumoji1,1,3),substring(etsuransyaSeason.mail4,1,3)) as season_detail
                torihikisakiSeason.r17_3cd as season_detail,
                torihikisakiData104.r17_3cd as data104_detail
                from syouhin1
                join syouhin4 on syouhin4.bango=syouhin1.bango

                --season
                left join kokyaku1 as kokyaku1Season
                on substring(syouhin1.season,1,6) = kokyaku1Season.yobi12

                left join haisou as haisouSeason
                on substring(syouhin1.season,7,2) = haisouSeason.torihikisakibango
                and kokyaku1Season.bango = haisouSeason.kokyakubango

                left join etsuransya as etsuransyaSeason
                on substring(syouhin1.season,9,3) = etsuransyaSeason.datatxt0049
                and haisouSeason.bango::text = etsuransyaSeason.datanum0018::text
                --season end

                left join v_torihikisaki as torihikisakiSeason
                on syouhin1.season = torihikisakiSeason.torihikisaki_cd

                left join v_torihikisaki as torihikisakiData104
                on syouhin1.data104 = torihikisakiData104.torihikisaki_cd

                left join syouhin2 on  syouhin1.bango = syouhin2.bango
                where kokyakusyouhinbango = '$productCd'
                ") ?? null;

        if ($syouhin1Data) {
            $syouhinbangoData24 = $syouhin1Data->data24;
            $syouhinbango = $syouhin1Data->bango;
            $dspbango = $syouhin1Data->dspbango;
            $season = $syouhin1Data->season;
            $season_detail = $syouhin1Data->season_detail;
            $data100 = $syouhin1Data->data100;
            $data104 = $syouhin1Data->data104;
            $data104_detail = $syouhin1Data->data104_detail;
            $syouhin2konpoumei = $syouhin1Data->s2konpoumei;
        } else {
            $syouhinbango = "";
            $dspbango = "";
            $season = "";
            $season_detail = "";
            $data100 = "";
            $data104 = "";
            $data104_detail = "";
            $syouhinbangoData24 = "";
            $syouhin2konpoumei = "";
        }

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
            $address = "";
        }

        $result = array();
        $kakakuData = QueryHelper::fetchSingleResult("select * from kakaku where syouhinbango = '$syouhinbango' AND syutenjyouken='$companyCd'") ?? null;
        if (!$kakakuData) {
            $kakakuData = QueryHelper::fetchSingleResult("select * from kakaku where syouhinbango = '$syouhinbango' AND syutenjyouken is null") ?? null;
        }

        if ($kakakuData && $address == 'D602') {
            //$result['status'] = "ok";
            $result['hanbaisu'] = $kakakuData->hanbaisu;
            $result['yoyakukanousu'] = $kakakuData->yoyakukanousu;
            $result['sortbango'] = $kakakuData->sortbango;
            $result['dataint01'] = $kakakuData->dataint01;
            $result['yoyakusu'] = $kakakuData->yoyakusu;
            $result['dspbango'] = $dspbango;
            $result['season'] = $season;
            $result['season_detail'] = $season_detail;
            $result['data100'] = $data100;
            $result['data104'] = $data104;
            $result['data104_detail'] = $data104_detail;
            $result['data24'] = $syouhinbangoData24;
            $result['konpoumei'] = $syouhin2konpoumei;
        } else if ($kakakuData && $address == 'D601') {
            //$result['status'] = "ok";
            $result['hanbaisu'] = $kakakuData->kakaku;
            $result['yoyakukanousu'] = $kakakuData->yoyakukanousu;
            $result['sortbango'] = $kakakuData->sortbango;
            $result['dataint01'] = $kakakuData->dataint01;
            $result['yoyakusu'] = $kakakuData->yoyakusu;
            $result['dspbango'] = $dspbango;
            $result['season'] = $season;
            $result['season_detail'] = $season_detail;
            $result['data100'] = $data100;
            $result['data104'] = $data104;
            $result['data104_detail'] = $data104_detail;
            $result['data24'] = $syouhinbangoData24;
            $result['konpoumei'] = $syouhin2konpoumei;
        } else {
            //$result['status'] = "not_ok";
            $result['hanbaisu'] = $kakakuData->kakaku;
            $result['yoyakukanousu'] = $kakakuData->yoyakukanousu;
            $result['sortbango'] = $kakakuData->sortbango;
            $result['dataint01'] = $kakakuData->dataint01;
            $result['yoyakusu'] = $kakakuData->yoyakusu;
            $result['dspbango'] = $dspbango;
            $result['season'] = $season;
            $result['season_detail'] = $season_detail;
            $result['data100'] = $data100;
            $result['data104'] = $data104;
            $result['data104_detail'] = $data104_detail;
            $result['data24'] = $syouhinbangoData24;
            $result['konpoumei'] = $syouhin2konpoumei;
        }

        return $result;
    }

    public function searchInitialValueFromOthers2(Request $request){
        $order_bango = request('order_bango');
        $kokyakuCode = substr($order_bango, 0,6);
        $haisouCode = substr($order_bango, 6,2);
        $kokyaku = QueryHelper::select(['bango,ytoiawseend,ytoiawsesaiban,yetoiawsestart,kcode3,mail_toiawase_mb'])->from('kokyaku1')->where("yobi12 = '$kokyakuCode' ")->get()->first();
        $haisoujouhou = QueryHelper::select(['datatxt0051'])->from('haisoujouhou')->where("syukei1 = '$kokyaku->bango' ")->get()->first();
        $others2 = QueryHelper::fetchSingleResult("select other1,other2,other4,other5,other6,other16 from others2 where otherint1 = (select bango from haisou where haisou.shikibetsucode = '$kokyakuCode' and haisou.torihikisakibango = '$haisouCode')");
        $result = array();
        if($others2){
            $other1 = substr($others2->other1,0,1);
            if($other1 == '2'){
                $result['payment_method'] = $others2->other4;
                $result['deposit_month'] = $others2->other5;
                $result['payment_day'] = $others2->other6;
                $result['housoukubun'] = $others2->other2;
                $result['billing_tax_classification'] = $others2->other16;
                return $result;
            }else{
                $result['payment_method'] = $kokyaku->ytoiawseend;
                $result['deposit_month'] = $kokyaku->ytoiawsesaiban;
                $result['payment_day'] = $kokyaku->yetoiawsestart;
                $result['housoukubun'] = $kokyaku->kcode3;
                $result['billing_tax_classification'] = $kokyaku->mail_toiawase_mb;
                return $result;
            }
        }
    }

    //calculate tax rate
    public function calculateTaxRate(Request $request,$bango){
        $billing_tax_classification = request('billing_tax_classification');
        $info2 = request('information1');
        $kokyakuCode = substr($info2, 0,6);
        $haisouCode = substr($info2, 6,2);
        $kokyaku = QueryHelper::select(['bango,mallsoukobango1,mail_toiawase_mb'])->from('kokyaku1')->where("yobi12 = '$kokyakuCode' ")->get()->first();
        $haisoujouhou = QueryHelper::select(['datatxt0051'])->from('haisoujouhou')->where("syukei1 = '$kokyaku->bango' ")->get()->first();
        $others2 = QueryHelper::fetchResult("select other1,other16,other17,other18 from others2 where otherint1 = (select bango from haisou where haisou.shikibetsucode = '$kokyakuCode' and haisou.torihikisakibango = '$haisouCode')");

        $mallsoukobango1 = $kokyaku->mallsoukobango1;
        $result = array();

        if (explode(' ', $others2[0]->other1)[0] == '2') {
            if($billing_tax_classification != ""){
                $category1 = substr($billing_tax_classification,0,2);
                $category2 = substr($billing_tax_classification,2,2);
            }else{
                $category1 = substr($others2[0]->other16,0,2);
                $category2 = substr($others2[0]->other16,2,2);
            }
            $categorykanri = QueryHelper::fetchSingleResult("select substring(category5,1,2) as category5 from categorykanri where category1 = '$category1' AND category2 = '$category2' ");
            $category5 = (int) $categorykanri->category5;
            $result['percentage'] = $category5;

            //check tax rate for round,floor or selling
            if(substr($others2[0]->other18,2,1) == '1'){
                $result['format_status'] = 'round';
            }else if(substr($others2[0]->other18,2,1) == '2'){
                $result['format_status'] = 'floor';
            }else if(substr($others2[0]->other18,2,1) == '3'){
                $result['format_status'] = 'ceil';
            }

            return $result;

        }else if(explode(' ', $others2[0]->other1)[0] == '1'){
            if($billing_tax_classification != ""){
                $category1 = substr($billing_tax_classification,0,2);
                $category2 = substr($billing_tax_classification,2,2);
            }else{
                $category1 = substr($kokyaku->mail_toiawase_mb,0,2);
                $category2 = substr($kokyaku->mail_toiawase_mb,2,2);
            }
            $categorykanri = QueryHelper::fetchSingleResult("select substring(category5,1,2) as category5 from categorykanri where category1 = '$category1' AND category2 = '$category2' ");
            $category5 = (int) $categorykanri->category5;
            $result['percentage'] = $category5;

            //check tax rate for round,floor or selling
            if(substr($mallsoukobango1,2,1) == '1'){
                $result['format_status'] = 'round';
            }else if(substr($mallsoukobango1,2,1) == '2'){
                $result['format_status'] = 'floor';
            }else if(substr($mallsoukobango1,2,1) == '3'){
                $result['format_status'] = 'ceil';
            }

            return $result;

        }else{
            return null;
        }
    }

}
