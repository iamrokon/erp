<?php

namespace App\Http\Controllers\other;
use App\AllClass\master\nameMaster\allCategorykanri;
use Illuminate\Http\Request;
use App\tantousya;
use App\kengen;
use App\categorykanri;
use App\requestTable;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\other\lBook\createLBookRegistration;
use App\AllClass\other\lBook\editLBook;
use App\AllClass\other\lBook\lBookHeaders;
use App\AllClass\other\lBook\validateLBookTopSearch;
use App\AllClass\other\lBook\allLBook;
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

class LBookController extends Controller
{ 
    private $headers = [
        '書類番号' => 'datachar01',
        '受注先' => 'datachar02_detail',
        '売上請求先' => 'datachar03_detail',
        '最終顧客' => 'datachar04_detail',
        '登録日' => 'created_date',
        '文書種類' => 'datachar07_detail',
        '文書名' => 'datachar08',
        '担当' => 'datachar06_detail',
        '受注番号' => 'lbook_datachar05',
        '受注日' => 'intorder01_date',
        '受注件名' => 'juchukubun1',
        '保管ファイル' => 'datachar09',
        '共有レベル' => 'datachar10_detail',
    ];


    public function postLBook(Request $request)
    { 
        $bango = request('userId');
        
        //check validation for first search
        if($request->ajax() && (request('type')!="create" && request('type')!="edit")){
            $validator = validateLBookTopSearch::validate($request,$bango);
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
        
        $tantousya = tantousya::find($bango);
        $buttonMessage = ButtonMsg::read($bango);

        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 20;
        }
        
        $default_content_setumei = $bango;
        $check_tan = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango'")->where("mail4 = 'C310'")->get()->execute();

        //get categorykanri data
        $h1Data = QueryHelper::fetchResult("select * from categorykanri where category1 = 'H1' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");
        $h9Data = QueryHelper::fetchResult("select * from categorykanri where category1 = 'H9' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");
        
        //check orderbango 
        $reviewData1 = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7301'");
        if($reviewData1){
            $orderbango = $reviewData1->orderbango+1;
            $mobile_flag = $reviewData1->mobile_flag ;
        }else{
            $orderbango = "";
            $mobile_flag = "";
        }
        
        //get datachar06 pulldown data depend on orderbango from review table
        $reviewData2 = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7501'");
        if($reviewData2){
            $orderbango2 = $reviewData2->orderbango ;
            $datachar06 = QueryHelper::fetchResult("select * from tantousya where ztanka = '$orderbango2' and deleteflag = 0 and innerlevel >= 10 and innerlevel <= 20 ORDER BY bango ASC");
        }else{
            $datachar06 = "";
        }
        
        $datachar01 = "21".$orderbango2.str_pad($orderbango,$mobile_flag,'0',STR_PAD_LEFT );
        
        //get tantousya data
        $datachar05 = QueryHelper::fetchResult("select * from tantousya where deleteflag = 0  order by bango");
        
        if (!empty($data_from_view['chkboxinp'])) {
            $deleted_item = $data_from_view['chkboxinp'];
        } else {
            $deleted_item = 0;
        }

        $headers = lBookHeaders::headers($bango);
        $table_headers = lBookHeaders::headers($bango, 'table_headers');
        $page_no = lBookHeaders::$page_no;
        $route = 'lBookTableSetting';
        $redirect_path = 'lBookReload';
        
        $temp_table = 'l_book_temp';
        
        //show page start here
        if (isset($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh')) {
            $fsRemoveKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp'];
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp','created_date_start','created_date_end','datachar05_start','datachar05_end','datachar02_detail','datachar03_detail','datachar04_detail'];

            try {
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh') {
                    //clear bottom search request data
                    if($data_from_view['Button'] == 'refresh'){
                        $data_from_view = self::clearBottomReqData($data_from_view);
                    }
                    
                    $fs_req_data = $this->removeDataFromView($data_from_view, $fsRemoveKeys);
                    foreach ($fs_req_data as $key => $value) {
                        if (strpos($key, 'ReqVal') !== false) {
                            $fs_req_data[str_replace('ReqVal', '', $key)] = $value;
                            unset($fs_req_data[$key]);
                        }
                    }
                    
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);
                    
                    //check first search or default search
                    if($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort'){
                        $default_req_data = $data;
                    }else{
                       $default_req_data = ""; 
                    }
                    
                    //first search req data
                    $fsReqData = [];
                    $bangos = [];
                    foreach ($data as $key => $value) {
                        if (strpos($key, 'ReqVal') !== false) {
                            $fsReqData[str_replace('ReqVal', '', $key)] = $value;
                            unset($data[$key]);
                        }
                    }
                    
                    //to search full text
                    if(isset($data['datachar06_search'])){
                        $data['datachar06_search'] = str_replace('　','',str_replace(' ','',$data['datachar06_search']));
                    }
                   
                    //first search bangos
                    $first_search_res = "";
                    if(!empty($fsReqData)){ 
                        $search_removeKeys = ['created_date_start','created_date_end','datachar05_start','datachar05_end','datachar02_detail','datachar03_detail','datachar04_detail'];
                        $reqData = $this->removeDataFromView($fsReqData, $search_removeKeys);
                        $query = allLBook::data($bango, $deleted_item,$bangos,$fsReqData)->toSql();
                        //$lBookInfo = $this->searchDataFetch($query, $reqData, $bango, $temp_table, $pagination);
                        $lBookInfo = $this->searchDataFetch($query, $reqData, $bango, $temp_table);
                        foreach($lBookInfo as $key=>$val){
                            foreach($val as $k=>$v){
                                if($k=="datachar01"){
                                    array_push($bangos,$v);
                                }
                            }
                        }
                        if(count($bangos)<1){
                            $first_search_res = "no_data";
                        }
                    }else if(($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'refresh') && empty($fsReqData)){
                        $pagi = 20;
                        return view('other.lBook.mainLBook', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'pagi', 'deleted_item', 'buttonMessage','h1Data','h9Data','datachar06','orderbango','datachar01'));
                    }
                   
                    $query = allLBook::data($bango, $deleted_item,$bangos,$fs_req_data,$first_search_res)->toSql();
                    $lBookInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    if ($lBookInfo->items() == null && $lBookInfo->currentPage() != 1) {
                        $currentPage = ($lBookInfo->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $lBookInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    }
                    if ($lBookInfo->total() == 0) {
                        $exceedUser = '該当するデータがありません。';
                    } else {
                        $exceedUser = '';
                    }
                    
                    if($data_from_view['Button'] == 'FirstSearch'){
                        $fsReqData = $fs_req_data; //fsReqData=first search request data
                    }
                    
                    //export excel
                    if ($data_from_view['Button'] == 'xls') {
                        $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                        $headers = $this->headers;
                        $excelName = '書類保管L-BOOK.xlsx';
                        return $this->excelDownload($headers, $searched, $excelName);
                    }
                    
                } 
            } catch (\Illuminate\Database\QueryException $ex) {
                $exceedUser = '検索形式が間違っています。';
                $lBookInfo = QueryHelper::fetchResult($query);
                $lBookInfo = collect($lBookInfo)->paginate($pagination);
                return view('order.orderHistory.mainOrderHistory', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'lBookInfo', 'tantousya', 'deleted_item', 'exceedUser', 'buttonMessage','h1Data','h9Data','datachar06','orderbango','datachar01','default_req_data','fsReqData'));
            }

            return view('other.lBook.mainLBook', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'lBookInfo', 'tantousya', 'deleted_item', 'exceedUser', 'buttonMessage','h1Data','h9Data','datachar06','orderbango','datachar01','default_req_data','fsReqData'));
        }

        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;
        if (request('change_id')) {
            $query = allLBook::data($bango, $deleted_item)->whereRaw("datachar01 = '" . request('change_id') . "'")->toSql();
            $lBookInfo = QueryHelper::fetchResult($query);
            $lBookInfo = collect($lBookInfo)->paginate($pagi);
            
            session()->forget('oldInput' . $bango);
            return view('other.lBook.mainLBook', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'lBookInfo', 'tantousya', 'pagi', 'deleted_item', 'buttonMessage','h1Data','h9Data','datachar06','orderbango','datachar01'));
        } else {
            $query = allLBook::data($bango, $deleted_item)->toSql();
            session()->forget('oldInput' . $bango);
            return view('other.lBook.mainLBook', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'pagi', 'deleted_item', 'buttonMessage','h1Data','h9Data','datachar06','orderbango','datachar01'));
        }
        //$lBookInfo = QueryHelper::fetchResult($query);
        //$lBookInfo = collect($lBookInfo)->paginate($pagi);
        //session()->forget('oldInput' . $bango);
        //return view('other.lBook.mainLBook', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'lBookInfo', 'tantousya', 'pagi', 'deleted_item', 'buttonMessage','h1Data','h9Data','datachar06','orderbango','datachar01'));
    }

    public function postEditLBookRegistration(Request $request, $bango){
        $inherited_data = $this->postLBook($request);
        $headers = $inherited_data->headers;
        $table_headers = $inherited_data->table_headers;
        $page_no = $inherited_data->page_no;
        $route = $inherited_data->route;
        $redirect_path = $inherited_data->redirect_path;
        $tantousya =  $tantousya = tantousya::find($bango);
        $pagi = $inherited_data->pagi;
        $deleted_item = $inherited_data->deleted_item;
        $buttonMessage = $inherited_data->buttonMessage;
        //$popUpData = $inherited_data->popUpData;
        $h1Data = $inherited_data->h1Data;
        $h9Data = $inherited_data->h9Data;
        $datachar06 = $inherited_data->datachar06;
        $orderbango = $inherited_data->orderbango;
        
        //create & edit start here
        if (request('type') == 'create') {
            $file = $request->file('filename');
            $insert = createLBookRegistration::create($request->all(), $bango, $this->headers,$file);
            if (is_array($insert) && $insert['status'] == 'ok') {
                $lbook_id = $insert['lbook_id'];
                //$query = allLBook::data($bango)->whereRaw("datachar01 = '$lbook_id'")->toSql();
                //$lBookInfo = QueryHelper::fetchResult($query);
                //$lBookInfo = collect($lBookInfo)->paginate($pagi);
                //$view = view('other.lBook.lBookMainContent', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'lBookInfo', 'tantousya', 'pagi', 'deleted_item', 'buttonMessage','h1Data','h9Data','datachar06','orderbango'))->render();
                //$insert['view'] =  $view;
                $success_msg = '書類番号'.$lbook_id.'で登録されました。';
                Session::flash('success_msg',$success_msg);
           
                return $insert;
            }else if($insert == 'confirmation'){
                return "confirmation_msg"; 
            }else {
                $errors = $insert->all();
                return ['err_field' => $insert, 'err_msg' => $errors];
            }
        } elseif (request('type') == 'edit') {
            $file = $request->file('filename');
            $insert = editLBook::edit($request->all(), $bango, $this->headers,$file);
            if (is_array($insert) && $insert['status'] == 'ok') {
                $lbook_id = $insert['lbook_id'];
                //$query = allLBook::data($bango)->whereRaw("datachar01 = '$lbook_id'")->toSql();
                //$lBookInfo = QueryHelper::fetchResult($query);
                //$lBookInfo = collect($lBookInfo)->paginate($pagi);
                //$view = view('other.lBook.lBookMainContent', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'lBookInfo', 'tantousya', 'pagi', 'deleted_item', 'buttonMessage','h1Data','h9Data','datachar06','orderbango'))->render();
                //$insert['view'] =  $view;
                $success_msg = '書類番号'.$lbook_id.'で登録されました。';
                Session::flash('success_msg',$success_msg);
                
                return $insert;
            }else if($insert == 'confirmation'){
                return "confirmation_msg"; 
            }elseif(is_array($insert) && $insert['status'] == 'ng'){
               Session::flash('failure_msg','間違えました。');
               return $insert;
            } else {
                $errors = $insert->all();
                return ['err_field' => $insert, 'err_msg' => $errors];
            }
        }
        //create & edit end here
    }
    
    public function lBookDetail (Request $request, $bango)
    { 
        $datachar01 = $request['id'];
        $lBook = allLBook::data($bango)->whereRaw("datachar01 ='" . $datachar01 . "'")->toSql();
        $lBook = collect(QueryHelper::fetchSingleResult($lBook))->toArray();
        return response()->json($lBook);
    }

    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = lBookHeaders::$page_no;
        return $Setting = TableSetting::setting($this->headers, $id, $pageNo);

    }

    public function tableSettingSave(Request $request, $id, $type = null)
    {
        $pageNo = lBookHeaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '書類保管L-BOOK', $type);
    }

    
    public function deleteOrReturnLBook(Request $request, $bango, $type = null){
        $bangoName = tantousya::find($bango)->name;

        $id = $request->all();
        $kesuId = array_keys($id)[0];

        $mytime = Carbon::now()->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        $mytime = str_replace(" ", "", $mytime);

        $query = allLBook::data($bango)->whereRaw("datachar01 ='" . $kesuId . "'")->toSql();
        $deleteBefore = QueryHelper::fetchSingleResult($query);
        
        //start log query
        $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 書類保管L-BOOK start\n";
        QueryHandler::logger($bango,$log_data);

        if ($type == 1) {
            $update_data = [
               'datachar01' => strval($kesuId),
               'dataint25' => 0,
               'datachar11' => $mytime,
               //'datatxt0099' => !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : null,
            ];
            QueryHelper::updateData('soukonyuko',$update_data,'datachar01',$bango,__CLASS__,__FUNCTION__,__LINE__);
        } else {
            $update_data = [
               'datachar01' => strval($kesuId),
               'dataint25' => 1,
               'datachar11' => $mytime,
               //'datatxt0099' => !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : null,
            ];
            QueryHelper::updateData('soukonyuko',$update_data,'datachar01',$bango,__CLASS__,__FUNCTION__,__LINE__);
            $delete_msg = '書類番号'.$kesuId.'は削除されました。';
            Session::flash('delete_msg',$delete_msg);
        }

        //end log query
        $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 書類保管L-BOOK end\n";
        QueryHandler::logger($bango,$log_data);

        $deleted_item = 1;
        $query = allLBook::data($bango,$deleted_item)->whereRaw("datachar01 ='" . $kesuId . "'")->toSql();
        $deleteAfter = QueryHelper::fetchSingleResult($query);

        $headers = $this->headers;
        $headers['データ有効区分'] = 'dataint25';
        if ($type == 1) {
            CSVLogger::putData('書類保管L-BOOK.csv', 'soukonyuko', $deleteBefore, $deleteAfter, $bangoName, $headers, 3);
        } else {
            CSVLogger::putData('書類保管L-BOOK.csv', 'soukonyuko', $deleteBefore, $deleteAfter, $bangoName, $headers, 0);
        }
        return 'ok';
    }

    public function ApiReadCompanyDetail(Request $request, $id, $num){
        $companyData = QueryHelper::fetchSingleResult("select * from kokyaku1 where bango = '$num' and denpyosaiban = 0");
        $companyData = json_decode(json_encode($companyData),true);
        
        $array = [];
        foreach ($companyData as $key => $value) {
            $array[$key] = $value;
        }

        return $array;
    }

    public function clearBottomReqData($request_data){
        $headers = [
            '書類番号' => 'datachar01',
            '受注先' => 'datachar02_detail',
            '売上請求先' => 'datachar03_detail',
            '最終顧客' => 'datachar04_detail',
            '登録日' => 'created_date',
            '文書種類' => 'datachar07_detail',
            '文書名' => 'datachar08',
            '担当' => 'datachar06_search',
            '受注番号' => 'lbook_datachar05',
            '受注日' => 'intorder01_date',
            '受注件名' => 'juchukubun1',
            '保管ファイル' => 'datachar09',
            '共有レベル' => 'datachar10_detail',
        ];
        foreach($request_data as $key=>$val){
            if (in_array($key, $headers)){
                $request_data[$key] = null;
            }
        }
        return $request_data;
    }

    //open pdf with original name
    public function lBookFileDownload(){
        $file = 'uploads/lbook/'.request('file');
        $extention = explode(".",request('file'))[1];
        if($extention == 'pdf'){
            $filename = explode("¶",request('file'))[0].".".$extention;
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="' . $filename . '"');
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . filesize($file));
            header('Accept-Ranges: bytes');

            @readfile($file);

            exit();
        }else{
            $filename = basename($file);
            header("Content-Type: application/zip");
            header("Content-Disposition: attachment; filename=$filename");
            header("Content-Length: " . filesize($file));

            readfile($file);
            exit();
        }
    }
    
}
