<?php
namespace App\Http\Controllers\purchase;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\tantousya;
use App\Helpers\Helper;
use Exception;
use Illuminate\Support\Facades\Session;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\purchase\paymentInput\PaymentInputValidation;
use App\AllClass\purchase\paymentInput\PaymentInputDataEntry;


class PaymentInputController extends Controller
{
    public function index(){
        $bango = request('userId');
        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $name = QueryHelper::select(['name'])->from('tantousya')->where("DeleteFlag = '0' ")->orderBy("bango asc")->get()->execute();
        $categorykanriesU1 = QueryHelper::fetchResult("select category1,category2,category4 from categorykanri where category1 = 'U6' and category2 != '22' ORDER BY category2 ASC");
        $color = '0603作成区分';
        $request1s = QueryHelper::select(['syouhinbango', 'jouhou'])->from('request')->where("color = '0603作成区分'")->orderBy("bango asc")->get()->execute();
        $U2Data = QueryHelper::fetchResult("select category1,category2,category4 from categorykanri where category1 = 'D9' ORDER BY category2 ASC");
        $data201 = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'D9' and suchi2 = 0 order by suchi1 ASC "); 
        $data202 = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'H2' and suchi2 = 0 order by suchi1 ASC "); 
        $data203 = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'H3' and suchi2 = 0 order by suchi1 ASC ");  
        $c4Categorykanries = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'U9' and suchi2 = 0 order by suchi1 ASC ");
        return view('purchase.paymentInput.mainPaymentInput',compact('bango', 'tantousya', 'name', 'categorykanriesU1','request1s', 'U2Data', 'c4Categorykanries', 'data201', 'data202', 'data203'));
    }
    public function save(Request $request, $bango)
    {
        $insert = PaymentInputDataEntry::create($request, $bango);
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
    public function getExpectedPayAbleAmount(Request $request, $bango)
    {   
        $contractor = $request->company;
        $field = $request->payment_classification == "U91" ? "sz0038" : "sz0039";
        $date = (int)Helper::replaceSpecificString($request->payment_date, '/');
        $maxSZ0001 =  QueryHelper::fetchSingleResult("select max(sz0001) as count from shiharaizandaka where sz0002 = '$contractor'")->count ?? null;
        $maxSZ = (int)explode(" ",Helper::replaceSpecificString($maxSZ0001, '-'))[0];
        // dd($maxSZ, $date);
        if ($maxSZ0001 and $maxSZ <= $date){
            $data = QueryHelper::fetchSingleResult("select $field as res from shiharaizandaka where sz0002 = '$contractor' and sz0001 = '$maxSZ0001'")->res ?? 0;
            // dd($data);
            $result["balance"] = $data;
        }
        else {
            $result["balance"] = 0;
        }
        return $result;
    }
}