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
use App\AllClass\purchase\purchaseRecordTransfer\AllPurchaseRecordTransfer1;
use App\AllClass\purchase\purchaseRecordTransfer\AllPurchaseRecordTransfer2;
use App\AllClass\purchase\purchaseRecordTransfer\validatePurchaseRecordTransfer1;
use App\AllClass\purchase\purchaseRecordTransfer\validatePurchaseRecordTransfer2;
use App\AllClass\purchase\purchaseRecordTransfer\AllSourceOrderData;
use App\AllClass\purchase\purchaseRecordTransfer\AllDestinationOrderData;
use App\AllClass\order\orderEntry\OrderEntry;

class PurchaseRecordTransferController extends Controller
{
    public function postPurchaseRecordTransfer(Request $request){
        $bango = request('userId');
         //check validation for first search
         if($request->ajax()){
            $validator = validatePurchaseRecordTransfer1::validate($request,$bango);
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
       
        $color = '0605仕入実績振替';
        $request1s = QueryHelper::select(['syouhinbango', 'jouhou'])->from('request')->where("color = '0605仕入実績振替'")->orderBy("bango asc")->get()->execute();
        return view('purchase.purchaseRecordTransfer.mainPurchaseRecordTransfer',compact('bango', 'tantousya','request1s'));
    }
    public function sourceOrderData(Request $request)
    {
        
        try {
            $bango = $request->bango;
            
            $validator = validatePurchaseRecordTransfer1::validate($request,$bango);
            $errors = $validator->errors();
            if($errors->any()){
               $err_msg = $errors->all();
               return ['err_field'=>$errors,'err_msg'=>$err_msg];
            }
            
            $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
            $query = AllPurchaseSourceOrderData::data($bango, $request->all())->toSql();
            $purchaseSourceOrderData = QueryHelper::fetchResult($query);
            $data_count = count($purchaseSourceOrderData);
          
            $body_html = view('purchase.purchaseRecordTransfer.purchaseRecordTransferMainContent1', compact('purchaseSourceOrderData', 'bango', 'tantousya'))->render();
            return response()->json(["status" => "ok", "purchaseSourceOrderData" => $purchaseSourceOrderData, "data_count"=>$data_count, "body_html" => $body_html]);
        } catch (Exception $e) {
            dd($e);
        }
    }
    public function destinationOrderData(Request $request)
    {
        try {
            $bango = $request->bango;
            
            $validator = validatePurchaseRecordTransfer2::validate($request,$bango);
            $errors = $validator->errors();
            if($errors->any()){
               $err_msg = $errors->all();
               return ['err_field'=>$errors,'err_msg'=>$err_msg];
            }
            
            $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
            $query = AllDestinationOrderData::data($bango, $request->all())->toSql();
            $purchaseDestinationOrderData = QueryHelper::fetchResult($query);
            $data_count = count($purchaseDestinationOrderData);
            //dd($backlogData);
            $body_html = view('purchase.purchaseRecordTransfer.purchaseRecordTransferMainContent2', compact('purchaseDestinationOrderData', 'bango', 'tantousya'))->render();
            return response()->json(["status" => "ok", "purchaseDestinationOrderData" => $purchaseDestinationOrderData, "data_count" => $data_count, "body_html" => $body_html]);
        } catch (Exception $e) {
            dd($e);
        }
    }

    //sourceOrderDetails 
    public function sourceOrderDetails(Request $request, $bango)
    {
        $orderId = $request->orderId;
        $query = AllPurchaseRecordTransfer1::data($bango, $orderId);
        $orderDetail = QueryHelper::fetchSingleResult($query);
        // $ordertypebango2 = QueryHelper::fetchSingleResult("select max(ordertypebango2) from orderhenkan where kokyakuorderbango = '$orderId' ")->max ?? 0;
        // $salesDetail = QueryHelper::fetchSingleResult("Select * from orderhenkan where synchroorderbango = '0' and kokyakuorderbango = '$orderId' and ordertypebango2 = $ordertypebango2");
        // // dd($orderDetail);
        //$errorMessage = array();
        // if($orderDetail && ($orderDetail->datachar02 == 'U122' || $orderDetail->datachar02 == 'U160')){
        //     array_push($errorMessage, "粗利調整できない受注データです。");
        // }
        // dd(empty($orderDetail));
        if(empty($orderDetail)){
            $errorMessage = "該当するデータがありません。";
        }

        $orderDetail = collect($orderDetail);
        $hasOrderDetail = $orderDetail->count();
        return (['orderDetails' => $orderDetail, 'errorMessage' => $errorMessage, 'hasOrder' => $hasOrderDetail]);
    }
      //destinationOrderDetails 
      public function destinationOrderDetails(Request $request, $bango)
      {
          $orderId = $request->orderId;
          $query = AllPurchaseRecordTransfer2::data($bango, $orderId);
          $orderDetail = QueryHelper::fetchSingleResult($query);
        //   $ordertypebango2 = QueryHelper::fetchSingleResult("select max(ordertypebango2) from orderhenkan where kokyakuorderbango = '$orderId' ")->max ?? 0;
        //   $salesDetail = QueryHelper::fetchSingleResult("Select * from orderhenkan where synchroorderbango = '0' and kokyakuorderbango = '$orderId' and ordertypebango2 = $ordertypebango2");
          // dd($orderDetail);
          // $errorMessage = array();
          // if($orderDetail && ($orderDetail->datachar02 == 'U122' || $orderDetail->datachar02 == 'U160')){
          //     array_push($errorMessage, "粗利調整できない受注データです。");
          // }
          // dd(empty($orderDetail));
          if(empty($orderDetail)){
              $errorMessage = "該当するデータがありません。";
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
  
   
}