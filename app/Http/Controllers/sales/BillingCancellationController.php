<?php

namespace App\Http\Controllers\sales;
use App\AllClass\master\nameMaster\allCategorykanri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\tantousya;
use App\kengen;
use App\requestTable;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\order\backOrder\BackOrderHeaders;
use App\AllClass\order\backOrder\allTantousya;
use App\AllClass\sales\billingCancellation\searchCompany;
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

class BillingCancellationController extends Controller
{

    public function postBillingCancellation(Request $request)
    {
        $bango = request('userId');
        $tantousya = tantousya::find($bango);
        $query = DB::table('categorykanri')
            ->whereRaw('category1=\'A8\'')
            ->selectRaw("*")
            ->orderByRaw('suchi1')
            ->toSql();
        $categorykanri = QueryHelper::fetchResult($query);
        return view('sales.billingCancellation.mainBillingCancellation',compact('bango','tantousya','categorykanri'));
    }


    public function makeBillingCancellation(Request $request)
    {
        $status='';
        $ErrorMsg='';
        $SuccessMsg='';
        $billingCancellationSupplier_db=request('billingCancellationSupplier_db');
        $drop_down101=request('categorykanri');
        $bango=request('bango');
        $billingDate=str_replace('/','-', request('billingDate')).' 00:00:00' ;

//      dd($billingCancellationSupplier_db,$drop_down101,$bango,$billingDate);
        /*$fetchdaikinseisanoldResult =QueryHelper::fetchResult("select * from daikinseisanold");
        dd(count($fetchdaikinseisanoldResult));*/
        /*$billingCancellationSupplier_db='00000302';*/
        /*$billingDate='2021-06-10 00:00:00';*/
        /*$fetchSeikyuzandakaResult=QueryHelper::fetchResult("select
                                                        max (date0009),datatxt0142
                                                        from seikyuzandaka
                                                        where  datatxt0142='$billingCancellationSupplier_db'
                                                        group by seikyuzandaka.datatxt0142");
        if (substr(str_replace('-','',$fetchSeikyuzandakaResult[0]->max),0,8)==str_replace('/','', request('billingDate'))){
            dd(substr(str_replace('-','',$fetchSeikyuzandakaResult[0]->max),0,8),str_replace('/','', request('billingDate')),'maxdate');
        }
        else if (substr(str_replace('-','',$fetchSeikyuzandakaResult[0]->max),0,8)!=str_replace('/','', request('billingDate'))){
            dd(substr(str_replace('-','',$fetchSeikyuzandakaResult[0]->max),0,8),str_replace('/','', request('billingDate')),'can be deleted');
        }*/

//        return Response::json();
        /*$fetchSeikyuzandakaResult=QueryHelper::fetchResult("select date0009,datatxt0142 from seikyuzandaka where date0009='$billingDate' and datatxt0142='$billingCancellationSupplier_db'");

            dd($fetchSeikyuzandakaResult);*/
        try {

            $fetchSeikyuzandakaResult=QueryHelper::fetchResult("select date0009,datatxt0142 from seikyuzandaka where date0009='$billingDate' and datatxt0142='$billingCancellationSupplier_db'");

//            dd($fetchSeikyuzandakaResult);
            if (count($fetchSeikyuzandakaResult)>0){
                $seikyuzandakaMaxResult=QueryHelper::fetchResult("select
                                                        max (date0009),datatxt0142
                                                        from seikyuzandaka
                                                        where  datatxt0142='$billingCancellationSupplier_db'
                                                        group by seikyuzandaka.datatxt0142");
               /* dd(substr(str_replace('-','',$fetchSeikyuzandakaResult[0]->max),0,8),
                    substr(str_replace('-','',$seikyuzandakaMaxResult[0]->max),0,8)==str_replace('/','', request('billingDate')));*/
                if (substr(str_replace('-','',$seikyuzandakaMaxResult[0]->max),0,8)==str_replace('/','', request('billingDate'))){
                    $fetchTuhanorderResult= QueryHelper::fetchResult("select distinct orderbango,information2,juchubango from tuhanorder where chumondate='$billingDate' and substr(information2, 1,8)='$billingCancellationSupplier_db'");
                    //dd($fetchTuhanorderResult);
//
                    $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### billing_cancellation_processing start\n";
                    QueryHandler::logger($bango, $log_data);
                    $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
                    pg_query($conn, 'BEGIN');

//                dd($fetchSeikyuzandakaResult);
                    try {
                        ///update tuhanorder hikiatesyukko daikinseisanold///
                        foreach ($fetchTuhanorderResult as $key =>$val){
//                        dd($val);
                            $tuhanorder=[
                                'orderbango'=>$val->orderbango,
                                'information2'=>$val->information2,
                                'chumondate'=>'',
                                'text3'=>'',
                                'numeric5'=>null,
                            ];

                            $hikiatesyukko=[
                                'orderbango'=>$val->orderbango,
                                'syouhinid' =>$val->juchubango,
                                'dataint06' =>1,
                                'dataint02' =>2,
                                'datachar12' =>'',
                                'dataint08' =>2,
                                'dataint09' =>2,
                            ];

                            ///update tuhanorder///
                            QueryHelper::updateData('tuhanorder', $tuhanorder, ['information2' => $val->information2, 'orderbango' => $val->orderbango], $bango, __CLASS__, __FUNCTION__, __LINE__);
                            ///update hikiatesyukko///
                            QueryHelper::updateData('hikiatesyukko', $hikiatesyukko, ['orderbango'=>$val->orderbango,  'syouhinid' =>$val->juchubango ], $bango, __CLASS__, __FUNCTION__, __LINE__);

                            $fetchdaikinseisanoldResult =QueryHelper::fetchResult("select * from daikinseisanold");

                            if (count($fetchdaikinseisanoldResult)>0){
//                            dd($val->information2);
                                $daikinseisanoldData= QueryHelper::fetchResult(
                                    "select
                                daikinseisanold.soufusakiyubinbango,
                                daikinseisanold.henpinbi,
                                daikinseisan.shinkurokokyakuname,
                                daikinseisan.shinkurokokyakugroup,
                                daikinseisan.chumonsyaname
                                from daikinseisanold
                                join daikinseisan
                                on daikinseisanold.shinkurokokyakuname = daikinseisan.shinkurokokyakuname
                                and daikinseisanold.shinkurokokyakugroup = daikinseisan.shinkurokokyakugroup

                                where daikinseisan.chumonsyaname=substring('$val->information2',1,8)

                                ");

                                if (!empty($daikinseisanoldData)){
//                               dd($daikinseisanoldData);
                                    foreach ($daikinseisanoldData as $k=>$v){

                                        $daikinseisanold=[
                                            'shinkurokokyakuname'=>$v->shinkurokokyakuname,
                                            'shinkurokokyakugroup' =>$v->shinkurokokyakugroup,
                                            'soufusakiyubinbango'=>2,
                                            'henpinbi' =>'',
                                        ];
//                                    dd($daikinseisanold);
                                        ///update daikinseisanold///
                                        QueryHelper::updateData('daikinseisanold', $daikinseisanold, ['shinkurokokyakuname'=>$v->shinkurokokyakuname, 'shinkurokokyakugroup' =>$v->shinkurokokyakugroup], $bango, __CLASS__, __FUNCTION__, __LINE__);
                                    }
                                }
                                else{
                                    $status='ng';
                                }

                            }

                        }
                        ///delete Seikyuzandaka///
                        foreach ($fetchSeikyuzandakaResult as $key =>$val){
                            $deleteSeikyuzandaka=[
                                'date0009' =>$val->date0009,
                                'datatxt0142' =>$val->datatxt0142
                            ];
                            QueryHelper::deleteData('seikyuzandaka', $deleteSeikyuzandaka, ['date0009' =>$val->date0009, 'datatxt0142' =>$val->datatxt0142], $bango, __CLASS__, __FUNCTION__, __LINE__);

                        }

                        pg_query($conn, 'COMMIT');
                        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### billing_cancellation_processing end\n";
                        QueryHandler::logger($bango, $log_data);
                        $status='ok';


                    } catch (Exception $e) {
                        pg_query($conn, 'ROLLBACK');
                        $status=$e;
                    }

                    if ($status=='ok'){
                        $SuccessMsg = '正常に終了しました';
                        return Response::json(array('successMessage' => $SuccessMsg));
                    }
                    elseif ($status=='ng'){
                        $ErrorMsg = '対象のデータがありませんでした';
                        return Response::json(array('errorMessage' => $ErrorMsg));
                    }
                    else{
                        $ErrorMsg = '対象のデータがありませんでした';
                        return Response::json(array('errorMessage' => $ErrorMsg));
                    }
                }
                else if (substr(str_replace('-','',$seikyuzandakaMaxResult[0]->max),0,8)!=str_replace('/','', request('billingDate'))){
                    $ErrorMsg = '取消しようとする請求日以降の日付で、請求締日処理がされています。';
                    return Response::json(array('errorMessage' => $ErrorMsg));
                }
            }
            else{
                $ErrorMsg = '対象のデータがありませんでした';
                return Response::json(array('errorMessage' => $ErrorMsg));
            }
        } catch (\Exception $e) {
            dd($e);
            $ErrorMsg = '対象のデータがありませんでした';
            return response()->json($ErrorMsg);

        }

    }

    public function findBillingCancellationMaxDate(Request $request){
        $lastDayDate=$request['lastDayDate'].' 00:00:00';
        $companyCode=$request['companyCode'];
        if ($request['lastDayDate']=='31'){
            $fetchSeikyuzandakaResult=QueryHelper::fetchResult("select seikyuzandaka.date0009 from seikyuzandaka where seikyuzandaka.datatxt0142::text LIKE '%$companyCode%' order by seikyuzandaka.date0009 desc limit 1");
        }
        else{
            $fetchSeikyuzandakaResult=QueryHelper::fetchResult("select seikyuzandaka.date0009 from seikyuzandaka where date0009::text LIKE '%$lastDayDate%' and datatxt0142::text LIKE '%$companyCode%' order by seikyuzandaka.date0009 desc limit 1");
        }
        return response()->json($fetchSeikyuzandakaResult);
    }

}
