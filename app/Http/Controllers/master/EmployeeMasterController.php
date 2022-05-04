<?php

namespace App\Http\Controllers\master;

use App\AllClass\db\QueryHandler;
use App\AllClass\master\CSVLogger;
use Illuminate\Http\Request;
use App\tantousya;
use App\categorykanri;
use App\requestTable;
use \Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\AllClass\master\employeeMaster\createEmployeeMaster;
use App\AllClass\master\employeeMaster\ButtonMsg;
use App\AllClass\master\employeeMaster\employeeheaders;
use App\AllClass\master\employeeMaster\editEmployeeMaster;
use App\AllClass\other\dashboardComment\allDashboardComment;
use App\AllClass\SearchAndSortClass;
use App\AllClass\master\employeeMaster\allTantousya;
use App\AllClass\TableSetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Session;
use Excel;
use App\AllClass\master\ExcelReportDownload;
use URL;
use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\Helpers\Helper;


class EmployeeMasterController extends Controller
{
    public $headers = [
        '社員CD' => 'employee_bango',
        '社員名' => 'name',
        '給与社員CD' => 'htanka',
        '事業年度（期）' => 'ztanka',
        '事業部' => 'company_1',
        '部' => 'company_2',
        'グループ' => 'company_3',
        '事業所' => 'syozoku',
        'パスワード' => 'passwd',
        '権限CD' => 'mail4',
        '電話番号' => 'employee_mail2',
        '携帯番号' => 'mail3',
        'メールアドレス' => 'mail',
        '入力者１' => 'datatxt0030',
        '入力者2' => 'datatxt0031',
        '入力者3' => 'datatxt0032',
        '入力者4' => 'datatxt0033',
        '決裁者1' => 'datatxt0034',
        '決裁者２' => 'datatxt0035',
        '決裁者３' => 'datatxt0036',
        '決裁者４' => 'datatxt0037',
        '社員印影' => 'datatxt0029',
        '承認部門' => 'recog_dept',
        '権限レベル' => 'innerlevel',
        '写真' => 'syounin',
        '登録年月日' => 'created_date',
        '登録時刻' => 'created_time',
        '更新年月日' => 'edited_date',
        '更新時刻' => 'edited_time',
        // '更新時端末IP' => 'employee_syounin',
        '更新者' => 'user_name'
    ];




    public function postEmployeeMaster(Request $request)
    {
        //        QueryHelper::runQuery("DELETE FROM kengensettei  WHERE kengenchar01 = 'col' and kengenchar05 IN ( '08-01','08-11','08-13','08-05','08-06','08-02','08-03','08-15','08-04','08-14','08-10')");
        //        QueryHelper::runQuery("UPDATE tantousya SET  syounin = null ");
        $bango = request('userId');
        $has_permission = tantousya::innerLevel($bango) >= 15 && tantousya::innerLevel($bango) <= 20;
        $inner_level_change_permission = tantousya::innerLevel($bango) > 0 && tantousya::innerLevel($bango) <= 10;
        $ztanka = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7501'")->orderbango ?? null;

        //        $tantousyas = QueryHelper::select(['*'])->from('tantousya')->where('deleteflag = 0')->where('innerlevel >= 10')->where('innerlevel <= 20');
        //        if ($ztanka) {
        //            $tantousyas = $tantousyas->where("ztanka = $ztanka ");
        //        }
        //        $tantousyas = $tantousyas->orderBy('bango asc')->get()->execute();
        $tantousyas = QueryHelper::fetchResult("select * from tantousya where deleteflag = 0 and innerlevel >= 10 and innerlevel <= 20 and ztanka = $ztanka order by bango");
        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $buttonMessage = ButtonMsg::read($bango);
        $data_from_view = $request->all();
        $data_from_view_session = $request->all();
        session()->put('oldInput' . $bango, $data_from_view_session);
        //string to int conversion search, check leading zeroes, lzc=leading zero check
        $lzcKeys = ['bango_search_sort'];
        $data_from_view = $this->stringToIntSearch($data_from_view, $lzcKeys);
        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 20;
        }

        if (!empty($data_from_view['chkboxinp'])) {
            $deleted_item = $data_from_view['chkboxinp'];
        } else {
            $deleted_item = 0;
        }

        $headers = employeeheaders::headers($bango);
        $table_headers = employeeheaders::headers($bango, 'table_headers');
        $page_no = employeeheaders::$page_no;
        $route = 'employeeMasterTableSetting';
        $redirect_path = 'employeeMasterReload';
        $datatxt0003 = QueryHelper::select(['*'])->from('categorykanri')->where(" category1 = 'B9'")->where("left(category2, 2) ='$ztanka'")->where("suchi2 = 0")->orderBy("bango asc")->get()->execute();
        $datatxt0004 = QueryHelper::select(['*'])->from('categorykanri')->where(" category1 = 'C1'")->where("category2 like '%01%'")->where("left(category2, 2) ='$ztanka'")->where("suchi2 = 0")->orderBy("bango asc")->get()->execute();
        $datatxt0005 = QueryHelper::select(['*'])->from('categorykanri')->where(" category1 = 'C2'")->where("category2 like '%01%'")->where("left(category2, 2) ='$ztanka'")->where("suchi2 = 0")->orderBy("bango asc")->get()->execute();
        $recog_dept = QueryHelper::select(['*'])->from('categorykanri')->where(" category1 = 'C1'")->where("left(category2, 2) ='$ztanka'")->where("suchi2 = 0")->orderBy("bango asc")->get()->execute();
        //dd($datatxt0003,$datatxt0005);
        $color = '0805事業所コード';
        $category3 = '権限';
        $request = QueryHelper::select(['*'])->from('request')->where(" color = '$color'")->orderBy("bango asc")->get()->execute();
        $authority = QueryHelper::select(['*'])->from('categorykanri')->where(" category3 = '$category3'")->where("suchi2 = 0")->orderBy("bango asc")->get()->execute();
        $categorykanri = collect(QueryHelper::select(["*", "CONCAT(categorykanri.category1,'',categorykanri.category2) as oid"])->from('categorykanri')->get()->execute())->pluck('category4', 'oid')->toArray();
        if (!empty($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls')) {
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp'];
            $query = allTantousya::data($bango, $deleted_item);
            $temp_table = 'tantousya_temp';
            try {
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort') {
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);
                    $users = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    if ($users->items() == null && $users->currentPage() != 1) {
                        $currentPage = ($users->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $users = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    }
                    if ($users->total() == 0) {
                        $exceedUser = '該当するデータがありません。';
                    } else {
                        $exceedUser = '';
                    }
                } else
                    if ($data_from_view['Button'] == 'xls') {
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);
                    $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                    $headers = $this->headers;
                    $excelName = '社員マスタ.xlsx';
                    return $this->excelDownload($headers, $searched, $excelName);
                }
            } catch (\Exception $e) {
                $exceedUser = '検索形式が間違っています。';
                $users = QueryHelper::fetchResult($query);
                $users = collect($users)->paginate($pagination);
            }
            return view('master.employeemaster.mainEmployeeMaster', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'users', 'categorykanri', 'datatxt0003', 'datatxt0004', 'datatxt0005',  'request', 'deleted_item', 'tantousyas', 'authority', 'tantousya', 'exceedUser', 'buttonMessage', 'recog_dept', 'has_permission', 'inner_level_change_permission', 'ztanka'));
        }
        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;
        try {

            if (request('change_id')) {
                $query = allTantousya::data($bango, $deleted_item, request('change_id'));
            } else {

                $query = allTantousya::data($bango, $deleted_item);
            }
            $users = QueryHelper::fetchResult($query);
            $users = collect($users)->paginate($pagi);
            session()->forget('oldInput' . $bango);

            return view('master.employeemaster.mainEmployeeMaster', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'users', 'categorykanri', 'datatxt0003', 'datatxt0004', 'datatxt0005',  'request', 'deleted_item', 'tantousyas', 'authority', 'tantousya', 'pagi', 'buttonMessage', 'recog_dept', 'has_permission', 'inner_level_change_permission', 'ztanka'));
        } catch (\Exception $e) {

            $deleted_item = 0;
            $order_by_date = 1;
            $query = allDashboardComment::data($bango, $deleted_item, '', '', '', '', $order_by_date);
            $dashboardComment = QueryHelper::fetchResult($query);
            return view('dashboard', compact('bango', 'tantousya', 'dashboardComment'));
        }
    }

    public function postEditEmployeeMaster(Request $request, $bango)
    {
        $t = date("Y-m-d H:i:s");
        $file = fopen('e_master.txt','a');
        fwrite($file,"!!!enter!!!\n".$t."\n");
        fclose($file);
        if (request('type') == 'create') {

            $insert = createEmployeeMaster::create($request, $bango, $this->headers, request('validate_only'));
        $t = date("Y-m-d H:i:s");
        $file = fopen('e_master.txt','a');
        fwrite($file,"after_creation\n".$t."\n");
        fclose($file);
            if (is_array($insert) && $insert['status'] == 'ok') {
                if (request('validate_only') != '1') Session::flash('success_msg', '社員CD   ' . $insert['change_id'] . ' 登録 完了しました。');
        $t = date("Y-m-d H:i:s");
        $file = fopen('e_master.txt','a');
        fwrite($file,"end\n".$t."\n");
        fclose($file);
                return $insert;
            } else {
        $t = date("Y-m-d H:i:s");
        $file = fopen('e_master.txt','a');
        fwrite($file,"validation error\n".$t."\n");
        fclose($file);
                $errors = $insert->all();
                return ['err_field' => $insert, 'err_msg' => $errors];
            }
        } elseif (request('type') == 'edit') {
            $id = $request->bango;
            $query = allTantousya::data($bango, '*', $id);
            $insert = editEmployeeMaster::edit($request, $bango, $this->headers, request('validate_only'),$query,$id);

            if (is_array($insert) && $insert['status'] == 'ok') {
                return $insert;
            }else if($insert=='ng'){
                return ['status' => 'ng_p', 'err_msg' => null];
            }else {
                $errors = $insert->all();
                return ['err_field' => $insert, 'err_msg' => $errors];
            }
        }
    }
    public function postEditNameMaster(Request $request, $bango)
    {
        if (request('type') == 'create') {
            $insert = createNameMaster::create($request->all(), $bango, $this->headers, request('validate_only'));
            if (is_array($insert) && $insert['status'] == 'ok') {
                if (request('validate_only') != '1') Session::flash('success_msg', '名称CD ' . $request['category1'] . ' 登録 完了しました。');
                return $insert;
                //名称CD　XX  登録 完了しました。。
            } else {
                //var_dump($insert);
                $errors = $insert->all();
                return ['err_field' => $insert, 'err_msg' => $errors];
            }
        }

        if (request('type') == 'edit') {

            $insert = editNameMaster::edit($request->all(), $bango, $this->headers, request('validate_only'));
            if (is_array($insert) && $insert['status'] == 'ok') {
                if (request('validate_only') != '1') Session::flash('success_msg', '名称CD ' . $request['category1'] . ' 変更完了しました。');
                return $insert;
                //名称CD　XX 変更完了しました
            } elseif (is_array($insert) && $insert['status'] == 'ng') {
                if (request('validate_only') != '1') Session::flash('failure_msg', '間違えました。');
                return $insert;
            } elseif ($insert == 'confirmation') {
                return "confirmation_msg";
            } else {
                $errors = $insert->all();
                return ['err_field' => $insert, 'err_msg' => $errors];
            }
        }
    }

    public function masterDetail(Request $request, $bango)
    {
        $id = $request['id'];
        $query = allTantousya::data($bango, '*', $id);
        $data = collect(QueryHelper::fetchSingleResult($query,'ok','employeeMaster',$id,$bango))->toArray();
        $array = [];
        foreach ($data as $key => $value) {
            $array[$key] = $value;
        }
        $array['base_url'] = URL::to('/');
        $ztanka = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7501'")->orderbango ?? null;
        $tantousyas = QueryHelper::fetchResult("select * from tantousya where deleteflag = 0 and innerlevel >= 10 and innerlevel <= 20 and ztanka=$ztanka order by bango"); //$tantousyas=QueryHelper::select(['*'])->from('tantousya')->where('deleteflag = 0')->where('innerlevel > 10')->orderBy('bango asc')->get()->execute();
        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $datatxt0003 = QueryHelper::select(['*'])->from('categorykanri')->where(" category1 = 'B9'")->where("left(category2, 2) ='$ztanka'")->where("suchi2 = 0")->orderBy("bango asc")->get()->execute();
        $datatxt0004 = QueryHelper::select(['*'])->from('categorykanri')->where(" category1 = 'C1'")->where("category2 like '%01%'")->where("left(category2, 2) ='$ztanka'")->where("suchi2 = 0")->orderBy("bango asc")->get()->execute();
        $datatxt0005 = QueryHelper::select(['*'])->from('categorykanri')->where(" category1 = 'C2'")->where("category2 like '%01%'")->where("left(category2, 2) ='$ztanka'")->where("suchi2 = 0")->orderBy("bango asc")->get()->execute();
        $color = '0805事業所コード';
        $category3 = '権限';
        $recog_dept = QueryHelper::select(['*'])->from('categorykanri')->where(" category1 = 'C1'")->where("left(category2, 2) ='$ztanka'")->where("suchi2 = 0")->orderBy("bango asc")->get()->execute();
        $request = QueryHelper::select(['*'])->from('request')->where(" color = '$color'")->orderBy("bango asc")->get()->execute();
        $authority = QueryHelper::select(['*'])->from('categorykanri')->where(" category3 = '$category3'")->where("suchi2 = 0")->orderBy("bango asc")->get()->execute();
        $categorykanri = collect(QueryHelper::select(["*", "CONCAT(categorykanri.category1,'',categorykanri.category2) as oid"])->from('categorykanri')->get()->execute())->pluck('category4', 'oid')->toArray();
        $view = view('layout.user_detail.user-edit-modal-body', compact('tantousyas', 'tantousya', 'datatxt0003', 'datatxt0004', 'datatxt0005', 'recog_dept', 'request', 'authority', 'categorykanri', 'bango'))->render();
        $array['view'] = $view;
        return $array;
    }

    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = employeeheaders::$page_no;
        return $Setting = TableSetting::setting($this->headers, $id, $pageNo);
    }

    public function tableSettingSave(Request $request, $id, $bango, $type = null)
    {
        $pageNo = employeeheaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '社員マスタ', $type);
    }

    public function clearTableSetting(Request $request, $bango, $type = null)
    {
        $tantousha = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $bangoName = $tantousha->name ?? null;

        $mytime = Carbon::now()->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        $mytime = str_replace(" ", "", $mytime);

        $id = $request->all();
        $kesuId = array_keys($id)[0];
        $query = allTantousya::data($bango, '*', $kesuId);
        $deleteBefore = QueryHelper::fetchSingleResult($query);
        $condition = ['bango' => "$kesuId"];
        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 社員マスタ start\n";
        QueryHandler::logger($bango, $log_data);
        if ($type == 1) {
            $updateData = [
                'deleteflag' => 0,
                'datatxt0039' => $mytime,
                //  'syounin' => Helper::getSystemIP(),
                'mail5' => $bango
            ];
            QueryHelper::updateData('tantousya', $updateData, $condition, $bango, __CLASS__, __FUNCTION__, __LINE__);
        } else {
            $updateData = [
                'deleteflag' => 1,
                'datatxt0039' => $mytime,
                // 'syounin' => Helper::getSystemIP(),
                'mail5' => $bango
            ];
            QueryHelper::updateData('tantousya', $updateData, $condition, $bango, __CLASS__, __FUNCTION__, __LINE__);
        }
        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 社員マスタ end\n";
        QueryHandler::logger($bango, $log_data);
        $query = allTantousya::data($bango, '*', $kesuId);
        $deleteAfter = QueryHelper::fetchSingleResult($query);
        $headers = $this->headers;
        $headers['データ有効区分'] = 'deleteflag';
        if ($type == 1) {
            CSVLogger::putData('shainMaster.csv', 'tantousya', $deleteBefore, $deleteAfter, $bangoName, $headers, 3);
        } else {
            CSVLogger::putData('shainMaster.csv', 'tantousya', $deleteBefore, $deleteAfter, $bangoName, $headers, 0);
        }
        return 'ok';
    }

    public function categoryWiseCategory($bango)
    {
        $categoryType = request('category_type') ? trim(\request('category_type')) : null;
        $categoryValue = request('category_value') ? trim(\request('category_value')) : null;
        $currentCategory = '';
        $length = strlen($categoryValue);

        if ($categoryType == 'B9') {
            $currentCategory = 'C1';
            $categories = QueryHelper::fetchResult("select * from categorykanri where category1 = '$currentCategory' and suchi2 = 0 and substring (category2,1,$length) = '$categoryValue' order by bango");
            //$categories = DB::table('categorykanri')->where('category1', $currentCategory)->where('suchi2', 0)->whereRaw("substring(category2,1,$length) = ?", $categoryValue)->orderBy('bango', 'ASC')->get();
        } else if ($categoryType == 'C1') {
            $currentCategory = 'C2';
            $categories = QueryHelper::fetchResult("select * from categorykanri where category1 = '$currentCategory' and suchi2 = 0 and substring (category2,1,$length) = '$categoryValue' order by bango");
            // $categories = DB::table('categorykanri')->where('category1', $currentCategory)->where('suchi2', 0)->whereRaw("substring(category2,1,$length) = ?", $categoryValue)->orderBy('bango', 'ASC')->get();
        }

        $html = '';
        if (isset($categories)) {
            foreach ($categories as $category) {
                $html .= "<option data-categoryType=" . $category->category1 . " data-categoryValue=" . $category->category2 . " value=" . $category->category1 . $category->category2 . ">" . $category->category1 . $category->category2 . " " . $category->category4 . "</option>";
            }
            return $html;
        } else {
            return $html;
        }
    }
}
