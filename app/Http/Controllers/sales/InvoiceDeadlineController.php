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
use ZipArchive;
use Mail;
use App\AllClass\sales\invoiceDeadline\Mail\mailZip;
use App\AllClass\sales\invoiceDeadline\Mail\mailPasswordsalesAccpt;
use App\Http\Controllers\Controller;
use App\AllClass\sales\invoiceDeadline\AllInvoiceDeadline;
use App\AllClass\sales\invoiceDeadline\InvoiceDeadlineHeaders;
use App\AllClass\order\backOrder\allTantousya;
use App\AllClass\sales\invoiceDeadline\PdfData;
use App\AllClass\ButtonMsg;
use Illuminate\Pagination\Paginator;
use App\AllClass\master\excelDownload;
use App\kokyaku1;
use App\AllClass\TableSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Excel;
use PDF;
use App\AllClass\master\ExcelReportDownload;
use Carbon\Carbon;
use App\AllClass\master\CSVLogger;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;

class InvoiceDeadlineController extends Controller
{
    private $headers = [
        '売上請求先CD' => 'invoice_deadline_datatxt0142',
        '売上請求先' => 'kokyaku1name',
        '現金入金額' => 'sum_1',
        '手形入金' => 'sum_2',
        '今回値引他' => 'sum_3',
        '今回繰越額' => 'datanum0051',
        '今回売上額' => 'sum_4',
        '今回消費税' => 'sum_5',
        '今回請求額' => 'billedamount',
        '即時請求額' => 'sum_6',
        '請求書PDF' => 'datatxt0144',
        'tick_mark' => 'checkbox',
        '請求書番号' => 'invoice_deadline_text3',
        '発行者' => 'issuer_name',
        '郵送' => 'mailing',
        '印刷済' => 'dataint09',
        'メール' => 'email',
        'メール済' => 'dataint08',
        '前回請求額' => 'formatted_datanum0051',
        '今回売上額2' => 'formatted_datanum0052',
        '今回返品額' => 'formatted_datanum0053',
        '今回値引額' => 'formatted_datanum0054',
        '今回他売上額' => 'formatted_datanum0055',
        '今回消費税額' => 'formatted_datanum0056',
        '今回即時請求額' => 'formatted_datanum0057',
        '今回即時請求消費税額' => 'formatted_datanum0058',
        '今回現金入金額' => 'formatted_datanum0059',
        '今回手形入金額' => 'formatted_datanum0060',
        '今回相殺額' => 'formatted_datanum0061',
        '今回入金値引額' => 'formatted_datanum0062',
        '今回他入金額' => 'formatted_datanum0063',
        '今回請求残高' => 'formatted_datanum0064',
        '前回末前受請求額' => 'formatted_datanum0065',
        '今回前受請求額' => 'formatted_datanum0066',
        '今回前受消費税額' => 'formatted_datanum0067',
        '今回前受即時請求額' => 'formatted_datanum0068',
        '今回前受即時請求消費税額' => 'formatted_datanum0069',
        '今回前受現金入金額' => 'formatted_datanum0070',
        '今回前受手形入金額' => 'formatted_datanum0071',
        '今回前受相殺額' => 'formatted_datanum0072',
        '今回前受入金値引額' => 'formatted_datanum0073',
        '今回前受他入金額' => 'formatted_datanum0074',
        '今回末前受請求残高' => 'formatted_datanum0075',
        '今回即時現金入金額' => 'formatted_datanum0076',
        '今回即時手形入金額' => 'formatted_datanum0077',
        '今回即時相殺額' => 'formatted_datanum0078',
        '今回即時入金値引額' => 'formatted_datanum0079',
        '今回即時他入金額' => 'formatted_datanum0080',
        '今回即時前受現金入金額' => 'formatted_datanum0081',
        '今回即時前受手形入金額' => 'formatted_datanum0082',
        '今回即時前受相殺額' => 'formatted_datanum0083',
        '今回即時前受入金値引額' => 'formatted_datanum0084',
        '今回即時前受他入金額' => 'formatted_datanum0085',
        '登録年月日' => 'formatted_date0010',
        '登録時刻' => 'date0010_time',
        '更新年月日' => 'date0011',
        '更新時刻' => 'date0011_time',
        '更新者' => 'datatxt0143',

    ];

    public function postInvoiceDeadline(Request $request)
    {
        /*$sql = "DELETE FROM kengensettei where kengenchar05::text LIKE '%04-07%' and kengenchar01::text LIKE '%col%'";
        QueryHelper::runQuery($sql);*/
        $bango = request('userId');
        $tantousya = tantousya::find($bango);
        $old = $request->all();
        
        //clear pdf creation session data
        session()->forget('invoiceGeneratedPdfCount');
        
        $query = DB::table('categorykanri')
            ->whereRaw('category1=\'A8\'')
            ->selectRaw("*")
            ->orderByRaw('suchi1')
            ->toSql();
        $categorykanri = QueryHelper::fetchResult($query);

        $lastDayDate=$categorykanri[0]->category2.' 00:00:00';
        $fetchSeikyuzandakaResult=QueryHelper::fetchResult("select seikyuzandaka.date0009 from seikyuzandaka where date0009::text LIKE '%$lastDayDate%'  order by seikyuzandaka.date0009 desc limit 1");
        if($fetchSeikyuzandakaResult){
            $intialCategorykanriAndPrintDate= str_replace('-','/',substr($fetchSeikyuzandakaResult[0]->date0009,0,10));
        }else{
            $intialCategorykanriAndPrintDate = "";
        }

        $request1_pulldown = QueryHelper::fetchResult("select syouhinbango,jouhou from request where color='0407請求書郵送'");
        $request2_pulldown = QueryHelper::fetchResult("select syouhinbango,jouhou from request where color='0407請求書メール区分'");
        $request3_pulldown = QueryHelper::fetchResult("select syouhinbango,jouhou from request where color='0407発行状態'");
        $allRequest = $request->all();
        
        //to search full text
        if(isset($allRequest['issuer_name_search'])){
            $allRequest['issuer_name_search'] = str_replace('　','',str_replace(' ','',$allRequest['issuer_name_search']));
        }

        if (!empty(request('categorykanri_date'))){
            $categorykanri_date = str_replace('/','-', $request->categorykanri_date).' 00:00:00' ;
        }
        else{
            $categorykanri_date = null;
        }

        if (!empty(request('print_date'))){
            $print_date =str_replace('/', '-',$request->print_date).' 00:00:00' ;
        }
        else{
            $print_date =null;
        }

        $buttonMessage = ButtonMsg::read($bango);
        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 20;
        }

        $headers=InvoiceDeadlineHeaders::headers($bango);
        $table_headers = $this->headers;

        $route = 'invoiceDeadlineTableSetting';
        $redirect_path = 'invoiceDeadlineReload';

        session()->put('oldInput' . $bango, $allRequest);

        $invoiceDeadlineError=null;
        $invoiceDeadlineSuccess=null;
        if (!empty($allRequest['Button']) && ($allRequest['Button'] == 'Thesearch' || $allRequest['Button'] == 'sort' || $allRequest['Button'] == 'xls')) {
            $fsRemoveTopKeys = ['Button','categorykanri','print_date', 'categorykanri_date', 'invoiceDeadlineSupplier1', 'invoiceDeadlineSupplier1_db', 'invoiceDeadlineSupplier2', 'invoiceDeadlineSupplier2_db','request_data01','request_data02','request_data03','page','pagination','userId','_token'];
            $fsRemoveTableKeys=['invoice_deadline_datatxt0142', 'kokyaku1name', 'sum_1', 'sum_2', 'sum_3','datanum0051', 'sum_4', 'sum_5','checkbox','billedamount', 'sum_6', 'datatxt0144', 'invoice_deadline_text3','issuer_name_search','mailing','dataint09','email','dataint08','sortField','sortType','datanum0065','datanum0066','datanum0067','datanum0068','datanum0069','datanum0070','datanum0071','datanum0072','datanum0073','datanum0074','datanum0075'];


            $fsReqData= $this->removeDataFromView($allRequest, $fsRemoveTableKeys);

            $temp_table= "seikyuzandaka_invoice_temp";

            try {
                if ($allRequest['Button'] == 'Thesearch' || $allRequest['Button'] == 'sort') {

                    //remove comma from formatted value
                    $str_to_int = ['datanum0065'];
                    foreach ($allRequest as $key => $value) {
                        if (in_array($key, $str_to_int)) {
                            $allRequest[$key] = str_replace(',', '', $allRequest[$key]);
                        }
                    }
                    
                    $allTableRequest = $this->modifyBladeData($allRequest, $fsRemoveTableKeys);
                    $query= AllInvoiceDeadline::readData($bango,$allRequest,$categorykanri_date,$print_date);
                    $searchData = $this->searchDataFetch($query, $allTableRequest, $bango, $temp_table, $pagination);
                    if ($searchData->items() == null && $searchData->currentPage() != 1) {
                        $currentPage = ($searchData->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $searchData = $this->searchDataFetch($query, $allTableRequest, $bango, $temp_table, $pagination);
                    }
                    if ($searchData->total() == 0) {
                        $invoiceDeadlineError = '対象のデータがありませんでした。';
                    } else {
                        $invoiceDeadlineError = '';
                    }
                } else
                    if ($allRequest['Button'] == 'xls') {


                        $query= AllInvoiceDeadline::readData($bango,$allRequest,$categorykanri_date,$print_date);

                        $allTableRequest = $this->modifyBladeData($allRequest, $fsRemoveTableKeys);

                        $searched = $this->searchDataFetch($query, $allTableRequest, $bango, $temp_table, $pagination, 'xls');
                        $headers=$this->headers;
                        unset($headers['tick_mark']);
                        $excelName = '請求書発行 締日.xlsx';
                        return $this->excelDownload($headers, $searched, $excelName);
                    }
            } catch (\Exception $e) {
                $invoiceDeadlineError = '対象のデータがありませんでした。';
                $searchData = collect([])->paginate($pagination);
            }
            return view('sales.invoiceDeadline.mainInvoiceDeadline',compact('bango','tantousya','categorykanri','intialCategorykanriAndPrintDate','request1_pulldown','request2_pulldown','request3_pulldown','fsReqData','searchData','headers','table_headers','old','route','redirect_path','buttonMessage','pagination','invoiceDeadlineError'));
        }
        if (!empty(request('firstButton')) && request('firstButton')== 'topSearch' || !empty(request('Button')) && request('Button') == 'refresh'){
            $old=null;
            $fsReqData= $request->all();
            $query= AllInvoiceDeadline::readData($bango,$allRequest,$categorykanri_date,$print_date);
            $searchData=collect(QueryHelper::fetchResult($query))->paginate(20);
            if ($searchData->items() == null && $searchData->currentPage() != 1) {
                $currentPage = ($searchData->lastPage());
                Paginator::currentPageResolver(function () use ($currentPage) {
                    return $currentPage;
                });
                $searchData = AllInvoiceDeadline::readData($bango,$allRequest,$categorykanri_date,$print_date);
                if ($searchData->total() == 0) {
                    $invoiceDeadlineError = '対象のデータがありませんでした。';
                } else {
                    $invoiceDeadlineError = '';
                }
            }
            if ($searchData->total() == 0) {
                $invoiceDeadlineError = '対象のデータがありませんでした。';
            } else {
                $invoiceDeadlineError = '';
            }
//            return view('sales.invoiceDeadline.mainInvoiceDeadline',compact('bango','tantousya','categorykanri','request1_pulldown','request2_pulldown','request3_pulldown','fsReqData','searchData','headers','table_headers','old','route','redirect_path','buttonMessage'));
            return view('sales.invoiceDeadline.mainInvoiceDeadline',compact('bango','tantousya','categorykanri','intialCategorykanriAndPrintDate','request1_pulldown','request2_pulldown','request3_pulldown','fsReqData','searchData','headers','table_headers','old','route','redirect_path','buttonMessage','pagination','invoiceDeadlineSuccess','invoiceDeadlineError'));
        }
        else{
            $old=null;
            $searchData= collect([])->paginate(20);
            return view('sales.invoiceDeadline.mainInvoiceDeadline',compact('bango','tantousya','categorykanri','intialCategorykanriAndPrintDate','request1_pulldown','request2_pulldown','request3_pulldown','searchData','headers','table_headers','old','route','redirect_path','buttonMessage','pagination','invoiceDeadlineSuccess','invoiceDeadlineError'));
        }
        //return view('sales.invoiceDeadline.mainInvoiceDeadline',compact('bango','tantousya','categorykanri','intialCategorykanriAndPrintDate','request1_pulldown','request2_pulldown','request3_pulldown','fsReqData','searchData','headers','table_headers','old','route','redirect_path','buttonMessage','pagination','invoiceDeadlineSuccess','invoiceDeadlineError'));
    }

    private function modifyBladeData($alldata,$index){
        $newArr=[];
        foreach ($index as $key => $value) {
            $newArr[$value]=!empty($alldata[$value])?$alldata[$value]:null;
        }
        return $newArr;
    }

    public function invoiceVoucherCreation(Request $request){
        $bango = request('userId');
        $count_no_of_generated_pdf = 0;
        $selected_item = $request->selected_item;
      
        foreach($selected_item as $key=>$billing_cd){
            $billing_cd = explode("_",$billing_cd)[0];
            $temp_billing_date = str_replace('/','-', $request->billing_date).' 00:00:00';
            $seikyuzandakaData = QueryHelper::fetchSingleResult("select datatxt0144 from seikyuzandaka where datatxt0142 = '$billing_cd' AND date0009='$temp_billing_date' ");
            if($seikyuzandakaData && $seikyuzandakaData->datatxt0144 == null){
                $count_no_of_generated_pdf++;
            
                //start log query
                $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 請求書発行 締日 start\n";
                QueryHandler::logger($bango,$log_data);

                $conn = pg_connect("host=".env("DB_HOST")." port=".env("DB_PORT")."  dbname=".env("DB_DATABASE")." user=".env("DB_USERNAME")." password=".env("DB_PASSWORD"));
                pg_query($conn,'BEGIN');
                try{
                    //create invoice number
                    $fiscal_year = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7501' ")->orderbango ?? null;
                    $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7201'");
                    if($reviewData){
                        $orderbango = $reviewData->orderbango + 1;
                        $mobile_flag = $reviewData->mobile_flag ;
                    }else{
                        $orderbango = "";
                        $mobile_flag = "";
                    }
                    $invoice_number = "12".$fiscal_year.str_pad($orderbango,$mobile_flag,'0',STR_PAD_LEFT );
                    $invoice_list[] = $invoice_number;
                    
                    $deleted_item = 0;
                    $billing_date = $request->billing_date;
                    $print_date = $request->print_date;
                    $query = PdfData::data($bango, $deleted_item,$billing_cd,$billing_date)->toSql();
                    $voucherData = QueryHelper::fetchResult($query);
                    $voucherData = collect($voucherData);

                    if(count($voucherData) > 0){
                        $personalData = self::getPersonalDetails($billing_cd,$billing_date);
                        $personal_info2 = $personalData['personal_info2'];
                        $personal_name = $personalData['personal_name'];

                        //pdf create start here
                        $pdf = PDF::loadView('sales.invoiceDeadline.voucherCreation.pdf',['data'=>$voucherData,'print_date'=>$print_date,'invoice_number'=>$invoice_number,'personal_info2'=>$personal_info2,'personal_name'=>$personal_name]);
                        if (!file_exists('pdf/invoiceDeadline')) {
                            mkdir('pdf/invoiceDeadline', 0777, true);
                        }
                        $pdf_name = $invoice_number."_".$voucherData[0]->information2_short."_".$voucherData[0]->company_address."_".$voucherData[0]->office_haisoumoji1."_sei.pdf";
                        $destination = public_path('pdf/invoiceDeadline/'.$pdf_name);
                        file_put_contents($destination, $pdf->output());
                        //pdf create end here

                        foreach($voucherData as $k=>$val){
                            //update tuhanorder data
                            $tuhanorder_update_data = [
                                'orderbango' => $voucherData[$k]->orderbango,
                                'text3' => $invoice_number,
                            ];
                            QueryHelper::updateData('tuhanorder', $tuhanorder_update_data, 'orderbango', $bango, __CLASS__, __FUNCTION__, __LINE__);

                            //update hikiatesyukko data
                            $hikiatesyukko_update_data = [
                                'orderbango' => $voucherData[$k]->orderbango,
                                'dataint02' => 1,
                                //'dataint08' => 1,
                                'dataint09' => 2,
                                'datachar12' => $bango,
                            ];
                            QueryHelper::updateData('hikiatesyukko', $hikiatesyukko_update_data, 'orderbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                        }

                        //update seikyuzandaka data
                        $seikyuzandaka_update_data = [
                            'date0009' => $voucherData[0]->date0009,
                            'datatxt0142' => $voucherData[0]->datatxt0142,
                            'datatxt0144' => $pdf_name,
                        ];
                        QueryHelper::updateData('seikyuzandaka', $seikyuzandaka_update_data, ['date0009'=>$voucherData[0]->date0009,'datatxt0142'=>$voucherData[0]->datatxt0142], $bango, __CLASS__, __FUNCTION__, __LINE__);

                        //update review data
                        $review_update_data = [
                            'kokyakusyouhinbango' => 'D7201',
                            'orderbango' => $orderbango,
                            'check_flag' => 0,
                            'color' => static::getCurrentTime(),
                            'nickname' => $bango,
                        ];
                        QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);

                        //end log query
                        $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 請求書発行 締日 end\n";
                        QueryHandler::logger($bango,$log_data);

                        pg_query($conn,'COMMIT');
                    }else{
                        $not_pdf_msg[] = "Pdf not generated。(".$billing_cd.")";
                        Session::flash('not_pdf_msg', $not_pdf_msg);
                    }

                } catch (\Exception $e) {
                    $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                    QueryHandler::logger($bango, $log_data);
                    pg_query($conn,'ROLLBACK');
                }
            
                if (($key == array_key_last($selected_item))) {
                    //send mail
                    self::sendMail($request,1,$invoice_list);

                    if(session()->has('invoiceGeneratedPdfCount')){
                        $generatedPdfCount = session()->get('invoiceGeneratedPdfCount');
                        $generatedPdfCount = $generatedPdfCount + 1;
                        //session()->forget('invoiceGeneratedPdfCount');
                        $count = count($selected_item);
                        $pdf_msg = $generatedPdfCount.'/'.$count." PDFを作成しました。";
                    }else{
                        //session()->forget('invoiceGeneratedPdfCount');
                        $pdf_msg = "1/1 PDFを作成しました。";
                    }

                    Session::flash('pdf_msg', $pdf_msg);

                   return ['end',now(),$billing_cd];
                }else{
                    //self::sendMail($request,1);
                    if(session()->has('invoiceGeneratedPdfCount')){
                        $generatedPdfCount = session()->get('invoiceGeneratedPdfCount');
                        $generatedPdfCount = $generatedPdfCount + 1;
                        session()->put('invoiceGeneratedPdfCount', $generatedPdfCount);
                    }else{
                      session()->put('invoiceGeneratedPdfCount', 1);
                    }

                    return ['going',now(),$billing_cd];
                }
            
            }else{
                $pdf_err_msg[] = "PDFはすでに作成済みです。(".$billing_cd.")";
                Session::flash('pdf_err_msg', $pdf_err_msg);
            }

        }
        
        //if($count_no_of_generated_pdf > 0){
            //send mail
        //    self::sendMail($request,1);

        //    $count = count($selected_item);
        //    $pdf_msg = $count_no_of_generated_pdf.'/'.$count." PDFを作成しました。";
        //    Session::flash('pdf_msg', $pdf_msg);
        //    return "ok";
        //}else{
        //    return "ng";
        //}
        
        return "ng";
        
    }

    public static function getPersonalDetails($billing_cd,$billing_date){
        $personalData = QueryHelper::fetchSingleResult(
            "select
            orderbango,
            juchubango,
            information2,concat_ws(' ',etsuransyaJuchubango.mail2,etsuransyaJuchubango.mail3,etsuransyaJuchubango.tantousya,'様') as personal_name

            from tuhanorder

            --max_juchubango
            left join kokyaku1 as kokyaku1Juchubango
            on substring(tuhanorder.information2,1,6) = kokyaku1Juchubango.yobi12

            left join haisou as haisouJuchubango
            on substring(tuhanorder.information2,7,2) = haisouJuchubango.torihikisakibango
            and kokyaku1Juchubango.bango = haisouJuchubango.kokyakubango

            left join etsuransya as etsuransyaJuchubango
            on substring(tuhanorder.information2,9,3) = etsuransyaJuchubango.datatxt0049
            and haisouJuchubango.bango::text = etsuransyaJuchubango.datanum0018::text
            --max_juchubango end

            where juchubango in(select max(temp_tuhanorder.juchubango) as max_juchubango
            from tuhanorder as temp_tuhanorder
            join tuhanorder on tuhanorder.orderbango = temp_tuhanorder.orderbango
            join seikyuzandaka on substring(tuhanorder.information2,1,8) = seikyuzandaka.datatxt0142
            AND tuhanorder.chumondate = seikyuzandaka.date0009
            where seikyuzandaka.datatxt0142 = '$billing_cd' and date0009 = '$billing_date')

            ");
        $result['personal_info2'] = $personalData->information2;
        $result['personal_name'] = $personalData->personal_name;
        return $result;
    }

    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = InvoiceDeadlineHeaders::$page_no;
        return $Setting = TableSetting::setting($this->headers, $id, $pageNo);

    }

    public function tableSettingSave(Request $request, $id, $type = null)
    {
        $pageNo = InvoiceDeadlineHeaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '請求書発行 締日', $type);
    }


    public function findInvoiceDeadlineMaxDate(Request $request){
        $lastDayDate=$request['lastDayDate'].' 00:00:00';
        $fetchSeikyuzandakaResult=QueryHelper::fetchResult("select seikyuzandaka.date0009 from seikyuzandaka where date0009::text LIKE '%$lastDayDate%'  order by seikyuzandaka.date0009 desc limit 1");
        return response()->json($fetchSeikyuzandakaResult);
    }

    public static function getCurrentTime()
    {
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        return str_replace(" ", "", $mytime);
    }

    public function sendMail(Request $request,$req_from_pdf_generate = null,$invoice_list = null){

        $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
        $n = 0;
        
        //if($req_from_pdf_generate == 1){
        //    $info2 = $request['selected_item'][0];
        //    $categorykanri_date = str_replace('/','-', $request['billing_date']).' 00:00:00' ;
        //}else{
        //    $info2 = $request['selected_item'];
        //    $categorykanri_date = str_replace('/','-', $request['billing_date']).' 00:00:00' ;
        //}
       
        $bango = request('userId');
        $categorykanri_date = str_replace('/','-', $request['billing_date']).' 00:00:00' ;
        $selected_item = $request->selected_item;
        $inv_key = 0;
        $status = "";
        
        foreach ($selected_item as $key => $value) {
            $temp_info2 = $selected_item[$key];
            $info2 = explode("_",$temp_info2)[0];
            if(is_array($invoice_list)){
                $invoice_number = $invoice_list[$inv_key];
                $inv_key++;
            }else{
                $invoice_number = explode("_",$temp_info2)[1];
            }
            $seikyuzandakaData = QueryHelper::fetchSingleResult("select datatxt0144 from seikyuzandaka where datatxt0142 = '$info2' AND date0009='$categorykanri_date' ");
            if($seikyuzandakaData && $seikyuzandakaData->datatxt0144 != null){
                $data=QueryHelper::fetchSingleResult("select distinct
                    tuhanorder.orderbango,
                    tuhanorder.information1,
                    tuhanorder.information2,
                    substring(tuhanorder.information2,1,8) as modi_info2,
                    tuhanorder.information6,
                    substring(tuhanorder.information6,1,8) as modi_info6,
                    tuhanorder.text2,
                    tuhanorder.juchukubun2,
                    tuhanorder.juchubango,
                    tantousya.mail as cc,
                    kokyaku1.address,
                    substring(kokyaku1.address,1,5) as address_short,
                    kokyaku1.name,
                    substring(tuhanorder.housoukubun,1,1) as housoukubun,
                    CASE
                    WHEN substring(others2.other1,1,1) ='1' THEN substring(kokyaku1.mail_nouhin,1,1)
                    ELSE substring(other11,1,1)
                    END as status_check,
                    CASE
                    WHEN substring(others2.other1,1,1) ='1' THEN kokyaku1.mail_toiawase
                    ELSE other12
                    END as password,
                    haisou.haisoumoji1,
                    substring(haisou.haisoumoji1,1,3) as haisoumoji1_short,
                    haisou.name as h_name,
                    etsuransya.mail1,
                    etsuransya.mail2,
                    etsuransya.mail4,
                    tuhanorder.text3,
                    etsuransya.tantousya,
                    substring(etsuransya.mail4,1,3) as modified_mail4

                    from tuhanorder

                    join tantousya
                    on tuhanorder.text2=tantousya.bango

                    join kokyaku1
                    on substring(tuhanorder.information2,1,6) = kokyaku1.yobi12

                    join haisou
                    on substring(tuhanorder.information2,7,2)=haisou.torihikisakibango
                    and kokyaku1.bango = haisou.kokyakubango

                    join others2
                    on others2.otherint1 = haisou.bango

                    join etsuransya
                    on etsuransya.datatxt0014=substring(tuhanorder.information6,1,6)
                    and etsuransya.datatxt0015=substring(tuhanorder.information6,7,2)
                    and etsuransya.datatxt0049=substring(tuhanorder.information6,9,3)

                    where tuhanorder.information2 LIKE  '%$info2%' AND juchukubun2 IS NOT NULL AND text3 IS NOT NULL AND tuhanorder.chumondate::text LIKE '%$categorykanri_date%' AND tuhanorder.text3 = '$invoice_number' order by tuhanorder.juchukubun2 desc");

             
                $pdf_name = $data->text3."_".substr($data->information2, 0,8)."_".$data->address."_".$data->haisoumoji1."_sei.pdf";
                $password = $data->password;
                $to_mail = $data->mail1;
                $baseName = basename($pdf_name);
                $mail_send_status = $data->status_check;

                //////////create zip/////////////////////////
                //$zip_name = date('Ymd')."_".substr($data->information2, 0,8) ."_sei";
                $zip_name = date('YmdHms')."_sei";

                if(!file_exists('zip/invoiceDeadline')){
                    mkdir('zip/invoiceDeadline',0777,true);
                }
                $zipFileName = 'zip/invoiceDeadline/'.$zip_name.'.zip';

                if($req_from_pdf_generate == 1 && $mail_send_status != 1){
                    //no mail send
                }else if ($password == null) {
                    $no_pass_msg[] = $data->information2."のパスワードの入力がないため、メール送信できませんでした。";
                    Session::flash('no_pass_msg', $no_pass_msg);
                }

                if($req_from_pdf_generate == 1 && $mail_send_status != 1){
                    //no mail send
                }else if($to_mail == null || !filter_var($to_mail, FILTER_VALIDATE_EMAIL)){
                    //$invalid_email[] = $data->information2." Invalid email。";
                    $invalid_email[] = "対象：".$data->information2.' '.$data->address_short."/".$data->haisoumoji1_short."/".$data->modified_mail4.' メールアドレス。';
                    Session::flash('invalid_email', $invalid_email);
                }

                if($password != null && $to_mail !='' && filter_var($to_mail, FILTER_VALIDATE_EMAIL)){
                    $zip = new ZipArchive;


                    if (!file_exists('zip')) {
                       mkdir('zip', 0777, true);
                    }

                    if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE)
                    {
                        if (!$zip->setPassword($password)) {
                           throw new \RuntimeException('Set password failed');
                        }
                        // compress file
                        $fileName = 'pdf/invoiceDeadline/'.$pdf_name;
                        $baseName = basename($fileName);

                        if (!$zip->addFile($fileName, $baseName)) {
                            throw new \RuntimeException(sprintf('Add file failed: %s', $fileName));
                        }

                        if (!$zip->setEncryptionName($baseName, ZipArchive::EM_AES_256)) {
                            throw new \RuntimeException(sprintf('Set encryption failed: %s', $baseName));
                        }
                        $zip->close();

                    } else {
                        echo 'failed';
                    }

                    //send mail//
                    //$mail_send_status=$data->status_check;
                    if($req_from_pdf_generate == 1){
                        if($mail_send_status == 1){
                            $n++;
                            $status = $this->mailFunction($data,$zipFileName);
                            $success_email = " 請求書メールを　".$n."件　送信しました。";
                            Session::flash('success_email', $success_email);
                           // return $status;
                        }
                    }else{
                        $n++;
                        $status = $this->mailFunction($data,$zipFileName);
                        $success_email = " 請求書メールを　".$n."件　送信しました。";
                        Session::flash('success_email', $success_email);
                        //return $status;
                    }

                    if($status == "ok"){
                        //update hikiatesyukko
                        $tuhanorderTempData = QueryHelper::fetchResult("select orderbango from tuhanorder where tuhanorder.text3 = '$invoice_number' ");
                        foreach($tuhanorderTempData as $temp_key=>$tamp_val){
                        $hikiatesyukko_update_data = [
                            //'orderbango' => $data->orderbango,
                            'orderbango' => $tamp_val->orderbango,
                            'dataint08' => 1,
                        ];
                        QueryHelper::updateData('hikiatesyukko', $hikiatesyukko_update_data, 'orderbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                        }
                    }else{
                        $status = "";
                    }
                    
                }
                
            }else{
                $not_generated_pdf_msg[] = "対象：".$info2;
                Session::flash('not_generated_pdf_msg', $not_generated_pdf_msg);
            }

        }
        
        if(Session::has('not_generated_pdf_msg')){
            $not_generated_pdf_common_msg = "PDF未作成のデータでしたので、以下はメール未送信です。";
            Session::flash('not_generated_pdf_common_msg', $not_generated_pdf_common_msg);
        }
        if(Session::has('invalid_email')){
            $invalid_email_common_msg = "有効なメールアドレスではありませんでしたので、以下はメール未送信です。";
            Session::flash('invalid_email_common_msg', $invalid_email_common_msg);
        }
        return  "ok";
    }
    private function mailFunction($data,$zipPack)
    {
        $ccMail=$data->cc;
        $fromMail=env('MAIL_FROM');
        $mailFlag=env('MAIL_SEND_CONTROL','NONE');
        $to_mail=$data->mail1;

        if ($mailFlag == "NONE") {
            $ng_msg[] = "選択した宛先の個人項目「メールアドレス」 が入力されていないため、処理できません。マスタより登録後、再度処理を行ってください。";
            Session::flash('ng_msg', $ng_msg);
            return 'ng';
        }elseif($mailFlag == "COLGIS" and $to_mail != null){

            if (strpos($to_mail, 'colgis') !== false) {
                Mail::send(new mailZip($data,$to_mail,$ccMail,$zipPack,$fromMail));
                if (count(Mail::failures()) > 0) {
                    return (Mail::failures());
                };
                Mail::send(new mailPasswordsalesAccpt($data,$to_mail,$ccMail,$zipPack,$fromMail));
                if (count(Mail::failures()) > 0) {
                    return (Mail::failures());
                };
            }
            else{
                $ng_msg[] = "選択した宛先の個人項目「メールアドレス」 が入力されていないため、処理できません。マスタより登録後、再度処理を行ってください。";
                Session::flash('ng_msg', $ng_msg);
                return 'ng';
            }
        }elseif ($mailFlag == "ALL" and $to_mail != null) {
            Mail::send(new mailZip($data,$to_mail,$ccMail,$zipPack,$fromMail));
            if (count(Mail::failures()) > 0) {
                return (Mail::failures());
            };
            Mail::send(new mailPasswordsalesAccpt($data,$to_mail,$ccMail,$zipPack,$fromMail));
            if (count(Mail::failures()) > 0) {
                return (Mail::failures());
            };
        }
        return 'ok';
    }


    //download pdf of selected item
    public function downloadPDF(Request $request){
        $bango = request('userId');
        $selected_item = $request->selected_item;
        $categorykanri_date = str_replace('/','-', $request['billing_date']).' 00:00:00' ;
        $item_list = array();
        foreach($selected_item as $key=>$info){
            $info2 = explode("_",$info)[0];
            $invoice_number = explode("_",$info)[1];
            $data=QueryHelper::fetchSingleResult("select distinct
                    tuhanorder.orderbango,
                    tuhanorder.information2,
                    substring(tuhanorder.information2,1,8) as modi_info2,
                    tuhanorder.information6,
                    substring(tuhanorder.information6,1,8) as modi_info6,
                    tuhanorder.text2,
                    tuhanorder.juchukubun2,
                    tuhanorder.juchubango,
                    tantousya.mail as cc,
                    kokyaku1.address,
                    kokyaku1.name,
                    substring(tuhanorder.housoukubun,1,1) as housoukubun,
                    CASE
                    WHEN substring(others2.other1,1,1) ='1' THEN substring(kokyaku1.mail_nouhin,1,1)
                    ELSE substring(other11,1,1)
                    END as status_check,
                    CASE
                    WHEN substring(others2.other1,1,1) ='1' THEN kokyaku1.mail_toiawase
                    ELSE other12
                    END as password,
                    haisou.haisoumoji1,
                    haisou.name as h_name,
                    etsuransya.mail1,
                    etsuransya.mail2,
                    etsuransya.mail4,
                    tuhanorder.text3,
                    etsuransya.tantousya,
                    substring(etsuransya.mail4,1,3) as modified_mail4

                    from tuhanorder

                    join tantousya
                    on tuhanorder.text2=tantousya.bango

                    join kokyaku1
                    on substring(tuhanorder.information2,1,6) = kokyaku1.yobi12

                    join haisou
                    on substring(tuhanorder.information2,7,2)=haisou.torihikisakibango
                    and kokyaku1.bango = haisou.kokyakubango

                    join others2
                    on others2.otherint1 = haisou.bango

                    join etsuransya
                    on etsuransya.datatxt0014=substring(tuhanorder.information6,1,6)
                    and etsuransya.datatxt0015=substring(tuhanorder.information6,7,2)
                    and etsuransya.datatxt0049=substring(tuhanorder.information6,9,3)

                    where tuhanorder.information2 LIKE  '%$info2%' AND juchukubun2 IS NOT NULL AND tuhanorder.chumondate::text LIKE '%$categorykanri_date%' AND tuhanorder.text3 = '$invoice_number' order by tuhanorder.juchukubun2 desc");
            
            if($data){
                $pdf_name = $data->text3."_".substr($data->information2, 0,8)."_".$data->address."_".$data->haisoumoji1."_sei.pdf";
                $item_list[] = 'pdf/invoiceDeadline/'.$pdf_name;

                //update hikiatesyukko
                $tuhanorderTempData = QueryHelper::fetchResult("select orderbango from tuhanorder where tuhanorder.text3 = '$invoice_number' ");
                foreach($tuhanorderTempData as $temp_key=>$tamp_val){
                $hikiatesyukko_update_data = [
                    //'orderbango' => $data->orderbango,
                    'orderbango' => $tamp_val->orderbango,
                    'dataint09' => 1,
                ];
                QueryHelper::updateData('hikiatesyukko', $hikiatesyukko_update_data, 'orderbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                }

            }

        }

        $no_of_download = array();
        if(!empty($item_list)){
            $modifier = 1;
            $new_item_list = array_chunk($item_list, 150);
            foreach ($new_item_list as $key => $value) {
                $date_time = static::getCurrentTime();
                $zip_name = $date_time."(".$modifier.")"."_sei";
                $zip = new ZipArchive;
                if(!file_exists('zip/invoiceDeadline/downloadedZip')){
                    mkdir('zip/invoiceDeadline/downloadedZip',0777,true);
                }
                $zipFileName = 'zip/invoiceDeadline/downloadedZip/'.$zip_name.'.zip';

                if ($zip->open(public_path($zipFileName), ZipArchive::CREATE) === TRUE){
                    // compress file
                    foreach ($value as $k => $val) {
                        $fileName = $val;
                        $baseName = basename($fileName);

                        if (!$zip->addFile($fileName, $baseName)) {
                            throw new RuntimeException(sprintf('Add file failed: %s', $fileName));
                        }
                        /* if (!$zip->setEncryptionName($baseName, ZipArchive::EM_AES_256)) {
                           throw new RuntimeException(sprintf('Set encryption failed: %s', $baseName));
                         }*/
                    }
                    $zip->close();

                    $modifier++;
                    $no_of_download[]= URL($zipFileName);

                } else {
                    echo ['failed',$n];
                }

            }
            return $no_of_download;
        }else{
            return "not_ok";
        }
    }

}
