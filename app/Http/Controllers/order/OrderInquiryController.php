<?php

namespace App\Http\Controllers\order;
use Illuminate\Http\Request;
use App\tantousya;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\order\orderInquiry\allOrderInquiry;
use App\AllClass\order\orderInquiry\OrderInquiryFirstPart;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;

class OrderInquiryController extends Controller{

    //order inquiry start here
    public function postOrderInquiry(Request $request){
        $bango = request('userId');
        $kokyakuorderbango = request('kokyakuorderbango');
        $ordertypebango2 = request('ordertypebango2');
        $req_type = request('req_type');
        $tantousya = tantousya::find($bango);
        
        $misyukkoInfo = QueryHelper::fetchResult("select orderbango,syouhinid,dataint01 from misyukko where syouhinid = '$kokyakuorderbango'  AND dataint01 = '$ordertypebango2' ");

        if(count($misyukkoInfo)>0){
            $table_name = "misyukko";
        }else{
            $table_name = "syukko";
        }
        
        if($req_type == 'sales_data'){
            $table_name = "syukkoold";
        }

        $deleted_item = 0;
        //first part data
        $query = OrderInquiryFirstPart::data($bango, $deleted_item,$kokyakuorderbango,$ordertypebango2,$req_type)->toSql();
        $orderInquiryFirstPart = QueryHelper::fetchResult($query);

        //second part data
        $query1 = allOrderInquiry::data($bango, $deleted_item,$kokyakuorderbango,$ordertypebango2,$table_name,$req_type)->toSql();
        $orderInquiryInfo = QueryHelper::fetchResult($query1);
        return view('order.orderInquiry.mainOrderInquiry',compact('bango','tantousya','orderInquiryInfo','orderInquiryFirstPart'));
    }

}
