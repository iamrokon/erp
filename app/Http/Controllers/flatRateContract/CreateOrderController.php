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
use App\AllClass\flatRateContract\createOrder\AllCreateOrder;
use App\AllClass\flatRateContract\createOrder\InsertOrder;
use App\AllClass\flatRateContract\createOrder\ValidateInsertOrder;
use App\AllClass\order\orderEntry\searchCompany2;
use App\AllClass\ButtonMsg;
use Illuminate\Pagination\Paginator;
use App\kokyaku1;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;
use App\AllClass\master\CSVLogger;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
// use App\AllClass\common\CreateOrderEntryAndHatchuData;

class CreateOrderController extends Controller
{

    public function index(Request $request){
        $bango = request('userId');
        $tantousya = tantousya::find($bango);
        
        //pull option selection starts here
        $data003=substr($tantousya->datatxt0003, 2,4);
        $data003_left=substr($tantousya->datatxt0003, 2,4);
        $data003_right=substr($tantousya->datatxt0003, 2,4);
        if (isset($data_from_view['division_datachar05_start'])) {
           $data003_left=substr($data_from_view['division_datachar05_start'], 2,4);
        }else if (isset($data_from_view['division_datachar05_startReqVal'])) {
           $data003_left=substr($data_from_view['division_datachar05_startReqVal'], 2,4);
        }
        if (isset($data_from_view['division_datachar05_end'])) {
           $data003_right=substr($data_from_view['division_datachar05_end'], 2,4);
        }if (isset($data_from_view['division_datachar05_endReqVal'])) {
           $data003_right=substr($data_from_view['division_datachar05_endReqVal'], 2,4);
        }
        $data004=substr($tantousya->datatxt0004, 2,5);
        $data005=substr($tantousya->datatxt0005, 2,6);
        $personal_datatxt0003=QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'B9' ")->where("category2 = '$data003' ")->get()->first();
        $personal_datatxt0004=QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C1' ")->where("category2 = '$data004' ")->get()->first();
        $personal_datatxt0005=QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("category2 = '$data005' ")->get()->first();
        //pull option selection ends here
        
        //review data
        $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7501'");
        $review_orderbango = $reviewData->orderbango;
        
        //get categorykanri data
        $B9Data_left = QueryHelper::fetchResult("select *,RIGHT(category2, 2) as category2_show from categorykanri where category1 = 'B9' and (suchi2 = 0 or suchi2 is null) and left(category2, 2) ='$review_orderbango' ORDER BY category2 ASC");
        $B9Data_right = QueryHelper::fetchResult("select *,RIGHT(category2, 2) as category2_show from categorykanri where category1 = 'B9' and (suchi2 = 0 or suchi2 is null) and left(category2, 2) ='$review_orderbango' ORDER BY category2 ASC");
        $C1Data_left = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C1' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_left%' ")->get()->execute();
        $C1Data_right = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C1' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_right%' ")->get()->execute();
        $C2Data_left = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_left%' ")->get()->execute();
        $C2Data_right = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_right%' ")->get()->execute();
        
        return view('flatRateContract.createOrder.mainCreateOrder', compact('bango', 'tantousya', 'B9Data_left','B9Data_right','C1Data_left','C1Data_right','C2Data_left','C2Data_right','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005'));
    }

    public function save(Request $request, $bango){
        // CreateOrderEntryAndHatchuData::data($bango);
        $information2_start = (int) request('db_information2_start');
        $information2_end = (int) request('db_information2_end');
        if($information2_start !=0 && $information2_end !=0 && $information2_start > $information2_end){
            return "ng";
        }else{
            $insert = InsertOrder::insert($request->all(), $bango);
            if (is_array($insert) && $insert['status'] == 'ok') {
                //$kokyakuorderbango = $insert['change_id'];
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
        }
        
    }
    

}
