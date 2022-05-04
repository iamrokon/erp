<?php


namespace App\Http\Controllers\flatRateContract;


use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\flatRateContract\FixedRateInquiry\AllFixedRateInquiry;
use App\AllClass\flatRateContract\FixedRateInquiry\AllSoukosukko;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FixedRateInquiryController extends Controller
{
    public function index(Request  $request){
        $datachar07 = $request->datachar07;
        $bango = request('userId');
        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $query = AllFixedRateInquiry::data($datachar07)->toSql();
        $fixed_rate_inquiry = QueryHelper::fetchSingleResult($query);
        $query2 = AllSoukosukko::data($datachar07)->toSql();
        $all_soukosukkos = QueryHelper::fetchResult($query2);
        return view('flatRateContract.fixedRateInquiry.index',compact('bango','fixed_rate_inquiry','all_soukosukkos','tantousya'));
    }

}
