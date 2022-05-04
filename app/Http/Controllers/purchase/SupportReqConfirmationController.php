<?php

namespace App\Http\Controllers\purchase;
use Illuminate\Http\Request;
use App\tantousya;
use App\kengen;
use App\requestTable;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\purchase\supportReqConfirmation\SupportReqConfirmationHeaders;
use App\AllClass\purchase\supportReqConfirmation\ValidateSupportReqConfirmation;
use App\AllClass\purchase\supportReqConfirmation\AllSupportReqConfirmation;
use App\AllClass\purchase\supportReqConfirmation\PdfData;
use App\AllClass\purchase\supportReqConfirmation\DownloadData;
use App\AllClass\ButtonMsg;
use Illuminate\Pagination\Paginator;
use App\AllClass\master\excelDownload;
use App\kokyaku1;
use App\AllClass\TableSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use PDF;
use ZipArchive;
use Excel;
use App\AllClass\master\ExcelReportDownload;
use Carbon\Carbon;
use App\AllClass\master\CSVLogger;
use App\AllClass\newExcelExport;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;

class SupportReqConfirmationController extends Controller
{
    private $headers = [
        '受注番号' => 'orderuserbango',
        '売上日' => 'intorder03',
        '検収日' => 'intorder04',
        'サポート番号' => 'support_number',
        '依頼日' => 'date',
        '受注先' => 'datachar10_detail',
        '最終顧客' => 'datachar11_detail',
        '業務名' => 'datachar13',
        '担当' => 'user_name',
        'サポート金額' => 'formatted_support_amount',
        'tick_mark' => 'checkbox',
        'サポート依頼兼請書PDF' => 'datatxt0151',
        '引継希望日' => 'deletedate',
        '初回訪問日' => 'date0012',
        '受注日' => 'intorder01',
        '相談SE' => 'datachar12',
        '基本設計終了日' => 'date0013',
        'セットアップ開始日' => 'date0014',
        '本稼働開始日' => 'date0015',
        '検収条件' => 'datatxt0148',
        'サポート部門' => 'datatxt0149_detail',
        '登録年月日' => 'date0016',
        '更新年月日' => 'date0017',
        '更新者' => 'changer_name',
        'PDF作成フラグ' => 'dataint03_detail',
        'PDFダウンロードフラグ' => 'dataint04_detail',
        '検印者' => 'inspector_name',
        '検印フラグ' => 'dataint06_detail',
    ];


    public function postSupportReqConfirmation(Request $request)
    {
        $bango = request('userId');
        
        $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7501'");
        $review_orderbango = $reviewData->orderbango;

        //clear pdf creation session data
        session()->forget('generatedSupportPdfCount');

        //check validation for first search
        if($request->ajax()){
            $validator = validateSupportReqConfirmation::validate($request,$bango);
            $errors = $validator->errors();
            if($errors->any()){
               $err_msg = $errors->all();
               return ['err_field'=>$errors,'err_msg'=>$err_msg];
            }else{
                return "ok";
            }
        } 

        $data_from_view = $request->all();
        if(isset($data_from_view['selected_item'])){
            $selected_item = $data_from_view['selected_item'];
            session()->put("supportReqConfirmation_selected_item",$selected_item);
        }
        $data_from_view_session = $request->all();
        session()->put('oldInput' . $bango, $data_from_view);

        $tantousya = tantousya::find($bango);
        $data003 = substr($tantousya->datatxt0003, 2,4);
        $datatxt0003 = QueryHelper::fetchResult("select category1,category2,right(category2,2) as category2_display,category4 from categorykanri where category1 = 'B9' and left(category2, 2) ='$review_orderbango' order by category2 ");
        if(isset($data_from_view['datatxt0003']) && $data_from_view['datatxt0003'] != ""){
            $data003 = (int) substr($data_from_view['datatxt0003'],2,4);
            $datatxt0004 = QueryHelper::fetchResult("select category1,category2,right(category2,1) as category2_display,category4 from categorykanri where category1 = 'C1' and substring(category2,1,4) = '$data003' and left(category2, 2) ='$review_orderbango' order by category2 ");
        }else{
            $datatxt0004 = QueryHelper::fetchResult("select category1,category2,right(category2,1) as category2_display,category4 from categorykanri where category1 = 'C1' and substring(category2,1,4) = '$data003' and left(category2, 2) ='$review_orderbango' order by category2 ");
        }
        $mail4 = QueryHelper::fetchResult("select syouhinbango,jouhou from request where color = '0507営業/SE' ");
        $creation_category = QueryHelper::fetchResult("select syouhinbango,jouhou from request where color = '0507作成区分' ");
        $seal_classification = QueryHelper::fetchResult("select syouhinbango,jouhou from request where color = '0507検印区分' order by syouhinbango");

        $buttonMessage = ButtonMsg::read($bango);

        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 20;
        }

        $default_content_setumei = $bango;
        $check_tan = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango'")->where("mail4 = 'C310'")->get()->execute();

        if (!empty($data_from_view['chkboxinp'])) {
            $deleted_item = $data_from_view['chkboxinp'];
        } else {
            $deleted_item = 0;
        }

        $headers = SupportReqConfirmationHeaders::headers($bango);
        $table_headers = SupportReqConfirmationHeaders::headers($bango, 'table_headers');
        $page_no = SupportReqConfirmationHeaders::$page_no;
        $route = 'supportReqConfirmationTableSetting';
        $redirect_path = 'supportReqConfirmationReload';
        
        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $bango)->where('kengenchar05', '05-07')->get()->count();
        if($initial_header == 0){
            unset($headers['相談SE']);
            unset($headers['基本設計終了日']);
            unset($headers['セットアップ開始日']);
            unset($headers['本稼働開始日']);
            unset($headers['検収条件']);
            unset($headers['サポート部門']);
            unset($headers['登録年月日']);
            unset($headers['更新年月日']);
            unset($headers['更新者']);
            unset($headers['PDF作成フラグ']);
            unset($headers['PDFダウンロードフラグ']);
            unset($headers['検印者']);
            unset($headers['検印フラグ']);
            
        }
        
        $temp_table = 'support_req_confirmation_temp';

        //show page start here
        if (isset($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh')) {
            $fsRemoveKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp'];
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp','start_date','end_date','datatxt0003','datatxt0004','rd1','information1','information1_text','information3','information3_text','creation_category','seal_classification','selected_item'];

            try {
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh') {
                    //clear bottom search request data
                    if($data_from_view['Button'] == 'refresh'){
                        $data_from_view = self::clearBottomReqData($data_from_view);
                    }
                    
                    //default req data
                    $default_data =  $data_from_view;

                    //formatted first search data
                    $defalut_check = 0;
                    $req_data = $this->removeDataFromView($data_from_view, $fsRemoveKeys);
                    foreach ($req_data as $key => $value) {
                        if (strpos($key, 'ReqVal') !== false) {
                            $defalut_check++;
                            $req_data[str_replace('ReqVal', '', $key)] = $value;
                            unset($req_data[$key]);
                        }
                    }
                    
                    //remove comma from formatted value
                    $str_to_int = ['support_amount'];
                    foreach ($data_from_view as $key => $value) {
                        if (in_array($key, $str_to_int)) {
                            $data_from_view[$key] = str_replace(',', '', $data_from_view[$key]);
                        }
                    }

                    $data = $this->removeDataFromView($data_from_view, $removeKeys);


                    //first search req data
                    $fsReqData = [];
                    $bangos = [];
                   
                    foreach ($data as $key => $value) {
                        if (strpos($key, 'ReqVal') !== false) {
                            
                            $fsReqData[str_replace('ReqVal', '', $key)] = $value;
                            $data[str_replace('ReqVal', '', $key)] = $value;
                            unset($data[$key]);
                        }
                    }
                   
                    $data = $this->removeDataFromView($data, $removeKeys);

                    if($data_from_view['Button'] == 'FirstSearch'){
                        $fsReqData = $req_data; //fsReqData = first search request data
                    }
                    
                    //to search full text
                    //if(isset($data['user_name_search'])){
                    //    $data['user_name_search'] = str_replace('　','',str_replace(' ','',$data['user_name_search']));
                    //}
                    
                    if(($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'refresh') && $defalut_check == 0){
                        $pagi = 20;
                        return view('purchase.supportReqConfirmation.mainSupportReqConfirmation', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'pagi', 'deleted_item', 'buttonMessage', 'datatxt0003', 'datatxt0004', 'mail4', 'creation_category', 'seal_classification'));
                    }

                    $query = AllSupportReqConfirmation::data($bango, $deleted_item,$req_data)->toSql();
                    $checkData = QueryHelper::fetchResult($query);
                    $supportReqConfirmationInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    if ($supportReqConfirmationInfo->items() == null && $supportReqConfirmationInfo->currentPage() != 1) {
                        $currentPage = ($supportReqConfirmationInfo->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $supportReqConfirmationInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    }
                    if ($supportReqConfirmationInfo->total() == 0) {
                        $exceedUser = '対象のデータがありませんでした。';
                    } else {
                        $exceedUser = '';
                    }

                    //export excel
                    if ($data_from_view['Button'] == 'xls') {
                        $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                        $headers = $this->headers;
                        unset($headers['tick_mark']);
                        $excelName = 'サポート一覧・サポート依頼兼請書.xlsx';
                        return $this->excelDownload($headers, $searched, $excelName);
                    }


                }
            } catch (\Exception $e) {
                $exceedUser = '検索形式が間違っています。';
                //$supportReqConfirmationInfo = QueryHelper::fetchResult($query);
                $supportReqConfirmationInfo = collect();
                $supportReqConfirmationInfo = $supportReqConfirmationInfo->paginate($pagination);

                return view('purchase.supportReqConfirmation.mainSupportReqConfirmation', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'supportReqConfirmationInfo', 'tantousya', 'deleted_item','exceedUser', 'buttonMessage','fsReqData', 'datatxt0003', 'datatxt0004', 'mail4', 'creation_category', 'seal_classification'));
            }

            return view('purchase.supportReqConfirmation.mainSupportReqConfirmation', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'supportReqConfirmationInfo', 'tantousya', 'deleted_item','exceedUser', 'buttonMessage','req_data','fsReqData', 'datatxt0003', 'datatxt0004', 'mail4', 'creation_category', 'seal_classification'));
        }

        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;
        session()->forget('supportReqConfirmation_selected_item');
        session()->forget('oldInput' . $bango);
        return view('purchase.supportReqConfirmation.mainSupportReqConfirmation', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'pagi', 'deleted_item', 'buttonMessage', 'datatxt0003', 'datatxt0004', 'mail4', 'creation_category', 'seal_classification'));
    }


    public function pdfCreation(Request $request){
        $bango = request('userId');
        $selected_item = $request->selected_item;
        $count_no_of_generated_pdf = 0;
        session()->put("supportReqConfirmation_selected_item",$selected_item);
        
        $temp_selected_item = [];
        foreach($selected_item as $temp_key => $temp_kokyakuorderbango){
            //$hikiatenyukoInfo = QueryHelper::fetchSingleResult("select dataint03 from hikiatenyuko where syouhinid = '$temp_kokyakuorderbango'");
            $hikiatenyukoInfo = QueryHelper::fetchSingleResult("select dataint06 from hikiatenyuko where syouhinid = '$temp_kokyakuorderbango' and dataint03 != 1");
            if($hikiatenyukoInfo && $hikiatenyukoInfo->dataint06 == 1){
                $temp_selected_item[$temp_key] = $temp_kokyakuorderbango;
            }else{
                unset($selected_item[$temp_key]);
            }
        }
        
        if(count($selected_item) < 1){
            $pdf_err_msg[0] = "該当するデータがありません。";
            Session::flash('pdf_err_msg', $pdf_err_msg);
            return "ng";
        }
       
        foreach($selected_item as $key=>$kokyakuorderbango){
            //$orderhenkanInfo = QueryHelper::fetchSingleResult("select * from orderhenkan where kokyakuorderbango = '$kokyakuorderbango' AND datachar10 IS NULL order by bango desc");
            //if($orderhenkanInfo){
            //    $orderhenkan_bango = $orderhenkanInfo->bango;
            //    $intorder03 = $orderhenkanInfo->intorder03;
            //}else{
            //    $orderhenkan_bango = "";
            //    $intorder03 = "";
            //}

            $hikiatenyukoInfo = QueryHelper::fetchSingleResult("select dataint06 from hikiatenyuko where syouhinid = '$kokyakuorderbango' and dataint03 != 1");

            //get end key
            //$end_kokyakuorderbango = $selected_item[array_key_last($selected_item)];
            //$end_key_status = self::getEndKeyStatus($end_kokyakuorderbango);
            //$end_key = -10;
            //if($end_key_status != 1){
            //    $end_key = array_key_last($selected_item)-1;
            //}
            $end_key = array_key_last($temp_selected_item);
            
            
            if($hikiatenyukoInfo && $hikiatenyukoInfo->dataint06 == 1 )
            {
                $count_no_of_generated_pdf++;
                //start log query
                $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### サポート一覧・サポート依頼兼請書 start\n";
                QueryHandler::logger($bango,$log_data);

                $conn = pg_connect("host=".env("DB_HOST")." port=".env("DB_PORT")."  dbname=".env("DB_DATABASE")." user=".env("DB_USERNAME")." password=".env("DB_PASSWORD"));
                pg_query($conn,"BEGIN");
                try{
                    //check orderbango
                    //$reviewData1 = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7051'");
                    //if ($reviewData1) {
                    //    $orderbango = $reviewData1->orderbango + 1;
                    //    $mobile_flag = $reviewData1->mobile_flag;
                    //} else {
                    //    $orderbango = "";
                    //    $mobile_flag = "";
                    //}


                        $deleted_item = 0;
                       // $kokyakuorderbango = $orderhenkan->kokyakuorderbango;

                        $query = PdfData::data($bango, $deleted_item,$kokyakuorderbango)->toSql();
                        $pdfData = QueryHelper::fetchResult($query);
                        $pdfData = collect($pdfData);
                        //dd($pdfData);

                        if(count($pdfData) > 0){
                            //pdf create start here
                            $pdf = PDF::loadView('purchase.supportReqConfirmation.pdf.pdf',['data'=>$pdfData]);
                            if (!file_exists('pdf/supportReqConfirmation')) {
                                mkdir('pdf/supportReqConfirmation', 0777, true);
                            }
                            $pdf_name = $pdfData[0]->support_number.$pdfData[0]->ordertypebango2."_".$pdfData[0]->datachar11_short.$pdfData[0]->company_address."_spt.pdf";
                            $destination = public_path('pdf/supportReqConfirmation/'.$pdf_name);
                            file_put_contents($destination, $pdf->output());
                            //pdf create end here

                            //============== L-Book reg starts here ==================//
                                $reviewData1 = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7301'");
                                if ($reviewData1) {
                                    $orderbango = $reviewData1->orderbango + 1;
                                    $mobile_flag = $reviewData1->mobile_flag;
                                } else {
                                    $orderbango = "";
                                    $mobile_flag = "";
                                }
                                $reviewData2 = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7501'");
                                if ($reviewData2) {
                                    $orderbango2 = $reviewData2->orderbango;
                                } else {
                                    $orderbango2 = "";
                                }
                                $modified_orderbango = "21" . $orderbango2 . str_pad($orderbango, $mobile_flag, '0', STR_PAD_LEFT);

                                $soukonyuko_insert_data = [
                                    'orderbango' => $pdfData[0]->bango,
                                    'datachar01' => $modified_orderbango,
                                    'datachar02' => $pdfData[0]->datachar10,
                                    'datachar03' => $pdfData[0]->information2,
                                    'datachar04' => $pdfData[0]->datachar11,
                                    'datachar05' => $pdfData[0]->orderuserbango,
                                    'datachar06' => $bango,
                                    'datachar07' => 'H116',
                                    'datachar08' => $pdfData[0]->juchukubun1,
                                    'datachar09' => $pdf_name,
                                    'datachar10' => 'H910',
                                    'dataint25' => 0,
                                    'datachar11' => static::getCurrentTime(),
                                    'datachar12' => null,
                                    'datachar13' => $bango,
                                ];
                                $soukonyuko = QueryHelper::insertData('soukonyuko', $soukonyuko_insert_data, 'datachar01', true, $bango, __CLASS__, __FUNCTION__, __LINE__);

                                //update orderhenkan data
                                //$orderhenkan_update_data = [
                                //    'bango' => $pdfData[0]->bango,
                                //    'datatxt0151' => $modified_orderbango,
                                //];
                                //QueryHelper::updateData('orderhenkan', $orderhenkan_update_data, 'bango', $bango, __CLASS__, __FUNCTION__, __LINE__);

                                //update review data
                                $review_update_data = [
                                    'kokyakusyouhinbango' => 'D7301',
                                    'orderbango' => $orderbango,
                                    'check_flag' => 0,
                                    'color' => static::getCurrentTime(),
                                    //'size' => Helper::getSystemIP(),
                                    'nickname' => $bango,
                                ];
                                QueryHelper::updateData('review', $review_update_data, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                            //============== L-Book reg ends here ==================//

                            //orderhenkan update start here
                            $orderhenkan_update_data = [
                                'kokyakuorderbango' => $kokyakuorderbango,
                                'datatxt0151' => $pdf_name,
                                'date0017' => Carbon::now()->setTimezone("Asia/Tokyo")->format('Y-m-d H:i:s'),
                                'datatxt0155' => $bango,
                            ];
                            $orderhenkanUpdate = QueryHelper::updateData('orderhenkan', $orderhenkan_update_data, ['kokyakuorderbango'=>$kokyakuorderbango], true, $bango, __CLASS__, __FUNCTION__, __LINE__);

                            //hikiatenyuko update start here
                            $hikiatenyuko_update_data = [
                                'syouhinid' => $kokyakuorderbango,
                                'dataint03' => 1,
                                //'dataint06' => 1,
                                'denpyoshimebi' => Carbon::now()->setTimezone("Asia/Tokyo")->format('Y-m-d H:i:s'),
                                'tantousyabango' => $bango,
                            ];
                            $hikiatenyuko = QueryHelper::updateData('hikiatenyuko', $hikiatenyuko_update_data, ['syouhinid'=>$kokyakuorderbango], true, $bango, __CLASS__, __FUNCTION__, __LINE__);


                        //end log query
                        $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### サポート一覧・サポート依頼兼請書 end\n";
                        QueryHandler::logger($bango,$log_data);

                        session()->put('tempPdfCount', 1);
                        pg_query($conn, "COMMIT");
                    }else{
                        $no_data_found = "該当するデータがありません。";
                        Session::flash('no_data_found', $no_data_found);
                    }
                    
                } catch (\Exception $e) {
                    $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                    QueryHandler::logger($bango, $log_data);
              
                    pg_query($conn,"ROLLBACK");
                }
                
                if (($key == array_key_last($selected_item)) || ($end_key == $key)) {
                    //send mail

                    //self::sendMail($request,1);
                    
                    if(session()->has('generatedSupportPdfCount')){
                        $generatedSupportPdfCount = session()->get('generatedSupportPdfCount');
                        $generatedSupportPdfCount = $generatedSupportPdfCount + 1;
                        $count = count($selected_item);
                        //$pdf_msg[] = $generatedSupportPdfCount.'/'.$count." PDFを作成しました。";
                        $pdf_msg[] = "サポート依頼兼請書発行処理が完了しました。";
                    }else{
                        if(session()->has('tempPdfCount')){
                            //$pdf_msg[] = "1/1 PDFを作成しました。";
                            $pdf_msg[] = "サポート依頼兼請書発行処理が完了しました。";
                        }else{
                            $pdf_msg = [];
                        }
                    }

                    Session::flash('pdf_msg', $pdf_msg);

                   return ['end',now(),$kokyakuorderbango];
                }else{
                    if(session()->has('generatedSupportPdfCount')){
                        $generatedSupportPdfCount = session()->get('generatedSupportPdfCount');
                        $generatedSupportPdfCount = $generatedSupportPdfCount + 1;
                        session()->put('generatedSupportPdfCount', $generatedSupportPdfCount); 
                    }else{
                      session()->put('generatedSupportPdfCount', 1);  
                    }
                    
                    return ['going',now(),$kokyakuorderbango];
                }

            }else{
                //$pdf_err_msg[] = "PDFはすでに作成済みです。(".$kokyakuorderbango.")";
                $pdf_err_msg[0] = "該当するデータがありません。";
                Session::flash('pdf_err_msg', $pdf_err_msg);  
            }
            
        }
        
       
        return "ng";
                
    }
    
    //get end key status
    public function getEndKeyStatus($end_kokyakuorderbango){
       // $orderhenkanInfo = QueryHelper::fetchSingleResult("select * from orderhenkan where kokyakuorderbango = '$end_kokyakuorderbango' AND datachar10 IS NULL order by bango desc");
       // if($orderhenkanInfo){
       //     $orderhenkan_bango = $orderhenkanInfo->bango;
       // }else{
       //     $orderhenkan_bango = "";
       // }
        $hikiatenyukoInfo = QueryHelper::fetchSingleResult("select dataint03 from hikiatenyuko where syouhinid = '$end_kokyakuorderbango'");
        if(!empty($hikiatenyukoInfo)){
            return $hikiatenyukoInfo->dataint03;
        }
        return null;
    }
    
    //download pdf of selected item
    public function downloadPDF(Request $request){
        $bango = request('userId');
        $selected_item = $request->selected_item;
        $item_list = array();
        foreach($selected_item as $key=>$kokyakuorderbango){
            $deleted_item = 0;
            $query = DownloadData::data($bango, $deleted_item,$kokyakuorderbango)->toSql();
            $pdfData = QueryHelper::fetchResult($query);
            $pdfData = collect($pdfData);

            if(count($pdfData)>0){
                //$pdf_name = $pdfData[0]->juchukubun2."_".$pdfData[0]->information2_short."_".$pdfData[0]->company_address."_".$pdfData[0]->office_haisoumoji1."_uri.pdf";
                $pdf_name = $pdfData[0]->datatxt0151;
                if(file_exists(public_path('pdf/supportReqConfirmation/'.$pdf_name))){
                    $item_list[] = 'pdf/supportReqConfirmation/'.$pdf_name;
   
                    //update hikiatenyuko
                    $hikiatenyuko_update_data = [
                        'syouhinid' => $kokyakuorderbango,
                        'idoutanabango' => static::getCurrentTime(),
                        'tantousyabango' => $bango,
                        'dataint04' => 1,
                    ];
                   $hikiatenyuko = QueryHelper::updateData('hikiatenyuko', $hikiatenyuko_update_data, ['syouhinid'=>$kokyakuorderbango], true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                } 
            }

        }

        $no_of_download = array();
        if(!empty($item_list)){
            $modifier = 1;
            //$new_item_list = array_chunk($item_list, 2);
            $new_item_list = $item_list;
            
            $date_time = static::getCurrentTime();
            //$zip_name = $date_time."(".$modifier.")"."_spt";
            $zip_name = $date_time."_spt";
            $zip = new ZipArchive;
            if(!file_exists('zip/supportReqConfirmation/downloadedZip')){
                mkdir('zip/supportReqConfirmation/downloadedZip',0777,true);
            }
            $zipFileName = 'zip/supportReqConfirmation/downloadedZip/'.$zip_name.'.zip';
            
            foreach ($new_item_list as $key => $value) {
                if ($zip->open(public_path($zipFileName), ZipArchive::CREATE) === TRUE){
                    // compress file
                    //foreach ($value as $k => $val) {
                        //$fileName = $val;
                        $fileName = $value;
                        $baseName = basename($fileName);

                        if (!$zip->addFile($fileName, $baseName)) {
                            throw new \RuntimeException(sprintf('Add file failed: %s', $fileName));
                        }
                 
                    //}
                    $zip->close();

                    $modifier++;
                    //$no_of_download[]= URL($zipFileName);

                } else {
                    echo ['failed',$n];
                }

            }
            $no_of_download[]= URL($zipFileName);
            return $no_of_download;
        }else{
            return "not_ok";
        }
    }
    
    public function updateSelectedSupportReqCon(Request $request){
        $bango = request('userId');
        $selected_item = $request->selected_item;
       
        if(request('submit_confirmation') == ""){
            return "confirmation_msg";
        }else{
            try{
                //start log query
                $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### サポート一覧・サポート依頼兼請書 start\n";
                QueryHandler::logger($bango,$log_data);
                
                $count = 0;
                foreach($selected_item as $key=>$val){
                    $dataint06 = QueryHelper::fetchSingleResult("select dataint06 from hikiatenyuko where syouhinid = '$val'")->dataint06??null;
                    if($dataint06 == 2){
                        //update hikiatenyuko data
                        $hikiatenyuko_update_data = [
                                'syouhinid' => $val,
                                'dataint06' => 1,
                                'denpyoshimebi' => Carbon::now()->format('Y-m-d H:i:s'),
                                'datachar01' => $bango,
                                'tantousyabango' => $bango,
                            ];
                        $hikiatenyukoUpdate = QueryHelper::updateData('hikiatenyuko', $hikiatenyuko_update_data, 'syouhinid', $bango, __CLASS__, __FUNCTION__, __LINE__);
                        $count++;
                    }
                }
                
                if($count > 0){
                    $update_msg = "処理が完了しました。";
                    Session::flash('update_msg',$update_msg);
                }else{
                    $update_err_msg = "該当するデータがありません。";
                    Session::flash('update_err_msg',$update_err_msg);
                }
                
                //end log query
                $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### サポート一覧・サポート依頼兼請書 end\n";
                QueryHandler::logger($bango,$log_data);

                return "ok";
            } catch (\Exception $e) {
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                QueryHandler::logger($bango, $log_data);
                return "ng";
            }
        }

    }
    
    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $initial_header = kengen::where('kengenchar01', 'col')->where('kengenchar03', $id)->where('kengenchar05', '05-07')->get()->count();
        $pageNo = SupportReqConfirmationHeaders::$page_no;
        $Setting = TableSetting::setting($this->headers, $id, $pageNo);
        if($initial_header == 0){
            $Setting['datachar12'] = "";
            $Setting['date0013'] = "";
            $Setting['date0014'] = "";
            $Setting['date0015'] = "";
            $Setting['datatxt0148'] = "";
            $Setting['datatxt0149_detail'] = "";
            $Setting['date0016'] = "";
            $Setting['date0017'] = "";
            $Setting['changer_name'] = "";
            $Setting['dataint03_detail'] = "";
            $Setting['dataint04_detail'] = "";
            $Setting['inspector_name'] = "";
            $Setting['dataint06_detail'] = "";
        }
        return $Setting;

    }

    public function tableSettingSave(Request $request, $id, $type = null)
    {
        $pageNo = SupportReqConfirmationHeaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, 'サポート一覧・サポート依頼兼請書', $type);
    }

    public function clearBottomReqData($request_data){
        $headers = [
            '受注番号' => 'orderuserbango',
            '売上日' => 'intorder03',
            '検収日' => 'intorder04',
            'サポート番号' => 'support_number',
            '依頼日' => 'date',
            '受注先' => 'datachar10_detail',
            '最終顧客' => 'datachar11_detail',
            '業務名' => 'datachar13',
            '担当' => 'user_name',
            'サポート金額' => 'formatted_support_amount',
            'サポート依頼兼請書PDF' => 'datatxt0151',
            '引継希望日' => 'deletedate',
            '初回訪問日' => 'date0012',
            '受注日' => 'intorder01',
            '相談SE' => 'datachar12',
            '基本設計終了日' => 'date0013',
            'セットアップ開始日' => 'date0014',
            '本稼働開始日' => 'date0015',
            '検収条件' => 'datatxt0148',
            'サポート部門' => 'datatxt0149_detail',
            '登録年月日' => 'date0016',
            '更新年月日' => 'date0017',
            '更新者' => 'changer_name',
            'PDF作成フラグ' => 'dataint03_detail',
            'PDFダウンロードフラグ' => 'dataint04_detail',
            '検印者' => 'inspector_name',
            '検印フラグ' => 'dataint06_detail',
        ];
        foreach($request_data as $key=>$val){
            if (in_array($key, $headers)){
                $request_data[$key] = null;
            }
        }
        return $request_data;
    }
    
    public static function getCurrentTime(){
        $mytime = Carbon::now()->setTimezone("Asia/Tokyo")->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        return str_replace(" ", "", $mytime);
    }

}
