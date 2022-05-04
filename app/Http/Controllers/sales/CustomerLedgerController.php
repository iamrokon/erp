<?php

namespace App\Http\Controllers\sales;
use App\AllClass\sales\customerLedger\AllCustomerLedger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\tantousya;
use App\kengen;
use App\requestTable;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\sales\customerLedger\CustomerLedgerHeaders;
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

class CustomerLedgerController extends Controller
{
    private $headers = [
        '日付' => 's1date0008_s2intorder03_s3torikomidate',
        '区分' => 's1_s2searched1_s3',
        '伝票番号' => 's1_s2kaiinid_s3shinkurokokyakuname',
        //'伝票行' => 's1_s2syouhinsyu_s3shinkurokokyakugroup',
        '伝票行' => 's1_s2syouhinsyu_s3syouhinsyu',
        '品名' => 's1_s2syouhinname_s3searched2',
        '数' => 's1_s2syukkasu_s3',
        '単価/期日' => 's1_s2dataint04_s3chumondate',
        '売上金額' => 's1_s2searched3_s3',
        '消費税額' => 's1_s2searched4_s3',
        '入金金額' => 's1_s2_s3nyukingaku',
        '残高' => 's1datanum0032_s2_s3',
        '番号' => 's1_s2syouhinid_s3syouhinid',
        '行' =>'s1_s2syouhinsyu_s3shinkurokokyakugroup',
        //'行' => 's1_s2syouhinsyu_s3syouhinsyu',
        '備考' => 's1_s2datachar08_s3toiawasebango',
        '受注先' => 's1_s2r17_4_1_s3r17_4_1',
        '最終顧客' => 's1_s2r17_4_2_s3r17_4_2',
        '受注担当部署CD' => 'classification',
        '受注担当者' => 'user_name'
    ];

    public function index(Request $request)
    {
        /*$sql = "DELETE FROM kengensettei where kengenchar05::text LIKE '%04-13%' and kengenchar01::text LIKE '%col%'";
        QueryHelper::runQuery($sql);*/
        /*QueryHelper::runQuery("INSERT INTO urikakezandaka (date0008, datatxt0138)
                                   VALUES ('2021-04-01 00:00:00','00003602'),('2021-03-01 00:00:00','00600203')");
        dd(QueryHelper::fetchResult('select * from urikakezandaka '));*/
        $thismonth=Carbon::now()->format('Y/m');
//        $prevmonth=Carbon::now()->subMonth(2)->format('Y/m');
        $prevmonth=$this->previousMonth($thismonth);
        $bango = request('userId');
        $tantousya = tantousya::find($bango);
        $buttonMessage = ButtonMsg::read($bango);
//        dd($thismonth,$prevmonth,$buttonMessage);
        $data_from_view=$request->all();
        session()->put('oldInput' . $bango, $data_from_view);

        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 20;
        }

        $fsReqData=$request->all();
        $old = $request->all();
        $headers = CustomerLedgerHeaders::headers($bango);
        $table_headers = CustomerLedgerHeaders::headers($bango, 'table_headers');
//dd($table_headers);
        $route = 'customerLedgerTableSetting';
        $redirect_path = 'customerLedgerReload';
        $customerLedgerError=null;

        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $bango)->where('kengenchar05', '04-13')->get()->count();
        if($initial_header == 0){
            unset($headers['受注担当部署CD']);
            unset($headers['受注担当者']);
        }

        if (!empty($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' )) {
            $fsRemoveTableKeys=['s1date0008_s2intorder03_s3torikomidate', 's1_s2searched1_s3', 's1_s2kaiinid_s3shinkurokokyakuname', 's1_s2syouhinsyu_s3shinkurokokyakugroup', 's1_s2syouhinname_s3searched2','s1_s2syukkasu_s3', 's1_s2dataint04_s3chumondate', 's1_s2searched3_s3', 's1_s2searched4_s3', 's1_s2_s3nyukingaku', 's1datanum0032_s2_s3','s1_s2syouhinid_s3syouhinid','s1_s2syouhinsyu_s3syouhinsyu','s1_s2datachar08_s3toiawasebango','s1_s2r17_4_1_s3r17_4_1','s1_s2r17_4_2_s3r17_4_2','classification','user_name','sortField','sortType'];
            $fsReqData= $this->removeDataFromView($data_from_view, $fsRemoveTableKeys);

            $temp_table= "all_customer_ledger_merge_temp";
            try {
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort') {

//                    dd($data_from_view);

                    $allTableRequest = $this->modifyBladeData($data_from_view, $fsRemoveTableKeys);
//                    dd($allTableRequest);
                    $query= AllCustomerLedger::readData($bango,$fsReqData);

                    $customerLedgerInfo = $this->searchDataFetch($query, $allTableRequest, $bango, $temp_table, $pagination);
                    if ($customerLedgerInfo->items() == null && $customerLedgerInfo->currentPage() != 1) {
                        $currentPage = ($customerLedgerInfo->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $customerLedgerInfo = $this->searchDataFetch($query, $allTableRequest, $bango, $temp_table, $pagination);
                    }
                    if ($customerLedgerInfo->total() == 0) {
                        $customerLedgerError = '該当するデータがありません。';
                    } else {
                        $customerLedgerError = '';
                    }
                }
                else if ($data_from_view['Button'] == 'xls') {
                    $query= AllCustomerLedger::readData($bango,$fsReqData);

                    $allTableRequest = $this->modifyBladeData($data_from_view, $fsRemoveTableKeys);

                    $searched = $this->searchDataFetch($query, $allTableRequest, $bango, $temp_table, $pagination, 'xls');
//                        dd($searched);
                    $headers=[
                            '日付' => 's1date0008_s2intorder03_s3torikomidate',
                            '区分' => 's1_s2searched1_s3',
                            '伝票番号' => 's1_s2kaiinid_s3shinkurokokyakuname',
                            //'伝票行' => 's1_s2syouhinsyu_s3shinkurokokyakugroup',
                            '伝票行' => 's1_s2syouhinsyu_s3syouhinsyu',
                            '品名' => 's1_s2syouhinname_s3searched2',
                            '数' => 's1_s2syukkasu_s3',
                            '単価/期日' => 's1_s2dataint04_s3chumondate_xls',
                            '売上金額' => 's1_s2searched3_s3_xls',
                            '消費税額' => 's1_s2searched4_s3_xls',
                            '入金金額' => 's1_s2_s3nyukingaku_xls',
                            '残高' => 's1datanum0032_s2_s3_xls',
                            '番号' => 's1_s2syouhinid_s3syouhinid',
                            //'行' =>'s1_s2syouhinsyu_s3shinkurokokyakugroup',
                            '行' => 's1_s2syouhinsyu_s3syouhinsyu',
                            '備考' => 's1_s2datachar08_s3toiawasebango',
                            '受注先' => 's1_s2r17_4_1_s3r17_4_1',
                            '最終顧客' => 's1_s2r17_4_2_s3r17_4_2',
                            '受注担当部署CD' => 'classification',
                            '受注担当者' => 'user_name'
                        ];
//                    dd($allTableRequest,$searched,$headers);
                    $excelName = '得意先元帳（社内）.xlsx';
                    return $this->excelDownload($headers, $searched, $excelName);
                }
            } catch (\Exception $e) {
                dd($e);
                $customerLedgerError = '検索形式が間違っています。';
                $customerLedgerInfo = collect([])->paginate($pagination);
            }

            return view('sales.customerLedger.mainCustomerLedger',compact('bango','tantousya','customerLedgerInfo','fsReqData','headers','buttonMessage','route','redirect_path','table_headers','customerLedgerError','old'));
        }
        else if (!empty(request('firstButton')) && request('firstButton')== 'topSearch' || !empty(request('Button')) && request('Button') == 'refresh'){
//dd('topSearch',$fsReqData);
            $old=[];
            $query= AllCustomerLedger::readData($bango,$fsReqData);

            if (count(QueryHelper::fetchResult($query))==0){
                $customerLedgerError = '該当するデータがありません。';
            }
            else{
                $customerLedgerError = '';
            }
            $customerLedgerInfo = collect(QueryHelper::fetchResult($query))->paginate(20);
        }
        else{
            $old=null;
            $customerLedgerInfo = collect([])->paginate(20);

        }
        return view('sales.customerLedger.mainCustomerLedger',compact('bango','tantousya','buttonMessage','thismonth','prevmonth','customerLedgerInfo','fsReqData','headers','route','redirect_path','table_headers','old','customerLedgerError'));

    }

    public function tableSetting($id, $user_default = null)
    {
        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $id)->where('kengenchar05', '04-13')->get()->count();
        $id = $user_default ? $user_default : $id;
        $pageNo = CustomerLedgerHeaders::$page_no;
        $Setting = TableSetting::setting($this->headers, $id, $pageNo);
        if($initial_header == 0){
            $Setting['classification'] = "";
            $Setting['user_name'] = "";
        }
        return $Setting;

    }

    public function tableSettingSave(Request $request, $id, $type = null)
    {
        $pageNo = CustomerLedgerHeaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '請求書発行 締日', $type);
    }

    public function previousMonth($presentMonth){
        $presentMonth=explode('/',$presentMonth);
        $m=$presentMonth[1]-1;
        if (strlen($m)==1){
            $m='0'.$m;
        }
        if ($presentMonth[1]==1){
            $previousMonth=$presentMonth[0]-1 . '/' . '12';
        }
        else{
            $previousMonth=(int)$presentMonth[0] . '/' .$m;
        }
        return $previousMonth;
    }

    private function modifyBladeData($alldata,$index){
        $newArr=[];

        foreach ($index as $key => $value) {
            $newArr[$value]=!empty($alldata[$value])?$alldata[$value]:null;
        }
        return $newArr;
    }



}
