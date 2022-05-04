<?php

namespace App\Http\Controllers\other;

use App\AllClass\db\QueryHandler;
use App\AllClass\master\CSVLogger;
use Illuminate\Http\Request;
use App\tantousya;
use App\categorykanri;
use App\requestTable;
use \Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\AllClass\other\dashboardComment\createDashboardComment;
use App\AllClass\other\dashboardComment\editDashboardComment;
use App\AllClass\other\dashboardComment\allDashboardComment;
use App\AllClass\SearchAndSortClass;
use App\AllClass\TableSetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Session;
use Excel;
use App\AllClass\master\ExcelReportDownload;
use URL;
use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\Helpers\Helper;
use App\AllClass\ButtonMsg;
use App\AllClass\order\orderEntry\searchCompany;
use App\AllClass\other\dashboardComment\dashboardCommentHeaders;


class DashboardCommentController extends Controller
{
    private $headers = [
      '行番号' => 'syouhinbango',
      'タイトル' => 'sitesyubetsu',
      '掲載開始日' => 'created_date',
      '掲載終了日' => 'edited_date',
      '内容' => 'status',
      '作成日' => 'submit_date',
      '作成時刻' => 'submit_time',
      '入力担当者' => 'user_name',
      'LAMU/その他' => 'notice',
    ];

    public function postDashboardComment(Request $request)
    {
        /*$sql = "DELETE FROM kengensettei where kengenchar05::text LIKE '%11-04%' and kengenchar01::text LIKE '%col%'";
                        QueryHelper::runQuery($sql);*/
        ///git test/////
        ///
        $first_data="";
        $last_data="";
        $lastPage="";
        $bango = request('userId');
        $h1Data = QueryHelper::fetchResult("select * from categorykanri where category1 = 'H1' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");
        $reviewData2 = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7501'");
        $datachar06 = array();
        $query = searchCompany::data($bango, 0);
        $popUpData['kokyaku1'] = QueryHelper::fetchResult($query);
        $route = 'dashboardCommentTableSetting';
        $redirect_path = 'dashboardCommentReload';
        $headers = dashboardCommentHeaders::headers($bango);
        $table_headers = dashboardCommentHeaders::headers($bango, 'table_headers');

        $buttonMessage = ButtonMsg::read($bango);
        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $total  = 0;
        $data_from_view = $request->all();
        $data_from_view_session = $request->all();
        session()->put('oldInput' . $bango, $data_from_view_session);
        // //string to int conversion search, check leading zeroes, lzc=leading zero check
        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 20;
        }
        //
        if (!empty($data_from_view['chkboxinp'])) {
            $deleted_item = $data_from_view['chkboxinp'];
        } else {
            $deleted_item = 0;
        }
        $page_no = dashboardCommentHeaders::$page_no;
        if (!empty($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls')) {
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp'];
            $query = allDashboardComment::data($bango, $deleted_item);
            $temp_table = 'ecsyouhinjyouhou_temp';
            try {
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort') {
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);

                    if (isset($data['submit_date']) && $data['submit_date']!=null){
                        $data['submit_date']=str_replace('/','',$data['submit_date']);
                    }
                    if (isset($data['status']) && $data['status']!=null){
                        $data['status_without_tag']=$data['status'];
                        unset($data['status']);
                    }
//dd($data);
                    $dashboardCommentInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);

//                    dd($dashboardCommentInfo);
                    if ($dashboardCommentInfo->items() == null && $dashboardCommentInfo->currentPage() != 1) {
                        $currentPage = ($dashboardCommentInfo->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $dashboardCommentInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);

                    }
                    if ($dashboardCommentInfo->total() == 0) {
                        $exceedUser = '該当するデータがありません。';
                    } else {
                        $exceedUser = '';
                    }
                } else
                    if ($data_from_view['Button'] == 'xls') {
                        $data = $this->removeDataFromView($data_from_view, $removeKeys);
                        if (isset($data['submit_date']) && $data['submit_date']!=null){
                            $data['submit_date']=str_replace('/','',$data['submit_date']);
                        }
                        if (isset($data['status']) && $data['status']!=null){
                            $data['status_without_tag']=$data['status'];
                            unset($data['status']);
                        }
//                        dd($data);
                        $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                        foreach ($searched as $key => $searched_data) {
                            $new_searched_data = str_replace("&nbsp;"," ",strip_tags($searched_data->status));
                            $new_searched_data2 = str_replace("&amp;","&",strip_tags($new_searched_data));
                            $searched_data->status = $new_searched_data2;
                            //$searched_data->status = strip_tags($searched_data->status);
                        }
                        //dd($searched);
                        $headers = [
                          '行番号' => 'syouhinbango',
                          'タイトル' => 'sitesyubetsu',
                          '掲載開始日' => 'created_date',
                          '掲載終了日' => 'edited_date',
                          '内容' => 'status',
                          '作成日' => 'submit_date_xls',
                          '作成時刻' => 'submit_time',
                          '入力担当者' => 'user_name',
                          'LAMU/その他' => 'notice',
                        ];
                        $excelName = 'インフォメーション.xlsx';
                        return $this->excelDownload($headers, $searched, $excelName);
                    }
            } catch (\Exception $e) {
//                dd($e);
                $exceedUser = '検索形式が間違っています。';
                $dashboardCommentInfo = QueryHelper::fetchResult($query);
                $dashboardCommentInfo = collect($dashboardCommentInfo)->paginate($pagination);
            }
//            dd($exceedUser);
            return view('other.dashboardcomment.mainDashBoardComment', compact('bango', 'tantousya', 'h1Data', 'datachar06', 'popUpData', 'route', 'table_headers', 'page_no', 'headers','redirect_path','buttonMessage','dashboardCommentInfo', 'deleted_item','exceedUser'));
        }
        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;
        try {
            if (request('change_id')) {
                $query = allDashboardComment::data($bango, $deleted_item, request('change_id'));
            } else {
                $query = allDashboardComment::data($bango, $deleted_item);
            }
            $dashboardCommentInfo = QueryHelper::fetchResult($query);
            $dashboardCommentInfo = collect($dashboardCommentInfo)->paginate($pagi);
            session()->forget('oldInput'. $bango);
            return view('other.dashboardcomment.mainDashBoardComment', compact('bango', 'tantousya', 'h1Data', 'datachar06', 'popUpData', 'route', 'headers', 'table_headers', 'page_no', 'redirect_path', 'buttonMessage', 'dashboardCommentInfo', 'deleted_item', 'pagi'));
        }catch (\Exception $e){
            $deleted_item = 0;
            $order_by_date = 1;
            $query = allDashboardComment::data($bango, $deleted_item, '', '', '', '', $order_by_date);
            $dashboardComment = QueryHelper::fetchResult($query);
            return view('dashboard',compact('bango','tantousya','dashboardComment'));
        }

    }

    function changeExcelData($v)
    {
      return $v;
    }

    public function postEditDashboardComment(Request $request, $bango)
    {
        if (request('type') == 'create') {
            $file = $request->file('filename');
            $insert = createDashboardComment::create($request->all(), $bango, $file, $this->headers);
            //dd($insert['status']);
            if (is_array($insert) && $insert['status'] == 'ok') {
                Session::flash('success_msg', '行番号   ' . $insert['change_id'] . ' 登録 完了しました。');
                return $insert;
            }else if($insert == 'confirmation'){
                return "confirmation_msg";
            }else {
                $errors = $insert->all();
                return ['err_field' => $insert, 'err_msg' => array_unique($errors)];//sending unique error msg
            }
        }
        elseif (request('type') == 'edit') {
            $file = $request->file('filename');
            $insert = editDashboardComment::edit($request->all(), $bango, $file, $this->headers);
            //return $insert;
            if (is_array($insert) && $insert['status'] == 'ok') {
                Session::flash('success_msg', '行番号 ' . $insert['change_id'] . ' 変更完了しました。');
                return $insert;
            }else if($insert == 'confirmation'){
                return "confirmation_msg";
            }else {
                $errors = $insert->all();
                return ['err_field' => $insert, 'err_msg' => array_unique($errors)];//sending unique error msg
            }
        }
    }

    public function dashboardCommentDetail(Request $request, $bango)
    {
        $id = $request['id'];
        $query = allDashboardComment::data($bango, '*', $id);
        $data = collect(QueryHelper::fetchSingleResult($query))->toArray();
        $array = [];
        foreach ($data as $key => $value) {
            $array[$key] = $value;
        }
        $array['base_url'] = URL::to('/');
//        dd($array);
        return $array;
    }

    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = dashboardCommentHeaders::$page_no;
        return $Setting = TableSetting::setting($this->headers, $id, $pageNo);
    }

    public function tableSettingSave(Request $request, $id, $type = null)
    {
        $pageNo = dashboardCommentHeaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, 'インフォメーション', $type);
    }

    public function clearTableSetting(Request $request, $bango, $type = null)
    {
        //return "zz";
        $bangoName = tantousya::find($bango)->name;

        $mytime = Carbon::now()->toDateTimeString();

        $id = $request->all();
        $kesuId = array_keys($id)[0];
        $query = allDashboardComment::data($bango, '*', $kesuId);
        $deleteBefore = QueryHelper::fetchSingleResult($query);
        $condition = ['syouhinbango' => "$kesuId"];
        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### インフォメーション start\n";
        QueryHandler::logger($bango, $log_data);
        if ($type == 1) {
            $updateData = [
                'jidoujuchuflag' => 0,
                'saisinjikoku' => $mytime,
                'bunpaipercent' => $bango
            ];
            QueryHelper::updateData('ecsyouhinjyouhou', $updateData, $condition, $bango, __CLASS__, __FUNCTION__, __LINE__);
        } else {
            $updateData = [
                'jidoujuchuflag' => 1,
                'saisinjikoku' => $mytime,
                'bunpaipercent' => $bango
            ];
            //return $updateData;
            QueryHelper::updateData('ecsyouhinjyouhou', $updateData, $condition, $bango, __CLASS__, __FUNCTION__, __LINE__);
        }
        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### インフォメーション end\n";
        QueryHandler::logger($bango, $log_data);
        $query = allDashboardComment::data($bango, '*', $kesuId);
        $deleteAfter = QueryHelper::fetchSingleResult($query);
        $headers = $this->headers;
        $headers['データ有効区分'] = 'jidoujuchuflag';
        if ($type == 1) {
            CSVLogger::putData('dashboardComment.csv', 'ecsyouhinjyouhou', $deleteBefore, $deleteAfter, $bangoName, $headers, 3);
        } else {
            CSVLogger::putData('dashboardComment.csv', 'ecsyouhinjyouhou', $deleteBefore, $deleteAfter, $bangoName, $headers, 0);
        }
        return 'ok';
    }


}
