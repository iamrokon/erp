<?php

namespace App\Http\Controllers\order;
use App\AllClass\master\nameMaster\allCategorykanri;
use Illuminate\Http\Request;
use App\tantousya;
use App\kengen;
use App\categorykanri;
use App\requestTable;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\order\projectRegistration\createProjectRegistration;
use App\AllClass\ButtonMsg;
use App\AllClass\order\projectRegistration\projectHeaders;
use App\AllClass\order\projectRegistration\editProjectRegistration;
use App\AllClass\order\orderEntry\searchCompany2;
use Illuminate\Pagination\Paginator;
use App\AllClass\master\excelDownload;
use App\AllClass\order\projectRegistration\allProject;
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

class ProjectRegistrationController extends Controller
{
    private $headers = [
        'プロジェクト番号' => 'project_url',
        'プロジェクト名称' => 'urlsm',
        '受注先' => 'catchsm_address',
        '最終顧客' => 'caption_address',
        '営業' => 'setumei_name',
        'SE' => 'catch_name',
        '開始年月' => 'mbcatch_date',
        '終了年月' => 'mbcatchsm_date',
        '備考' => 'mbcaption',
        '登録年月日' => 'created_date',
        '登録時刻' => 'created_time',
        '更新年月日' => 'edited_date',
        '更新時刻' => 'edited_time',
        //'更新時端末IP' => 'datatxt0099',
        '更新者' => 'user_name',
    ];


    public function postProjectRegistration(Request $request)
    {
        $bango = request('userId');

        $data_from_view = $request->all();
        $data_from_view_session = $request->all();
        //clear bottom search request data
        if(isset($data_from_view['Button']) && $data_from_view['Button'] == 'refresh'){
            $data_from_view = self::clearBottomReqData($data_from_view);
        }
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

        $setumei = QueryHelper::select(['*'])->from('tantousya')->where("innerlevel >= 10")->where("innerlevel <= 20")->where("deleteflag = 0")->where("mail4 = 'C310'")->orderBy("bango asc")->get()->execute();
        $se = QueryHelper::select(['*'])->from('tantousya')->where("innerlevel >= 10")->where("innerlevel <= 20")->where("deleteflag = 0")->where("mail4 = 'C320'")->orderBy("bango asc")->get()->execute();

        if (!empty($data_from_view['chkboxinp'])) {
            $deleted_item = $data_from_view['chkboxinp'];
        } else {
            $deleted_item = 0;
        }

        $headers = projectHeaders::headers($bango);
        $table_headers = projectHeaders::headers($bango, 'table_headers');
        $page_no = projectHeaders::$page_no;
        $route = 'projectRegistrationTableSetting';
        $redirect_path = 'projectRegistrationReload';

        $categorykanri = QueryHelper::select(["*", "CONCAT(categorykanri.category1,'',categorykanri.category2) as oid"])->from('categorykanri')->get()->execute();

        $temp_table = 'project_temp';

        //show page start here
        if (isset($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh')) {
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp'];
            $query = allProject::data($bango, $deleted_item)->toSql();

            try {
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'refresh') {
                    //check content_setumei as all show
                    if($data_from_view['content_setumei'] == "all"){
                        unset($data_from_view['content_setumei']);
                    }

                    if(isset($data_from_view['content_show_catchsm'])){
                        unset($data_from_view['content_show_catchsm']);
                    }

                    $data = $this->removeDataFromView($data_from_view, $removeKeys);
                    $projectInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    if ($projectInfo->items() == null && $projectInfo->currentPage() != 1) {
                        $currentPage = ($projectInfo->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $projectInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    }
                    if ($projectInfo->total() == 0) {
                        $exceedUser = '該当するデータがありません。';
                    } else {
                        $exceedUser = '';
                    }
                } else if ($data_from_view['Button'] == 'xls') {
                    //check content_setumei as all show
                    if($data_from_view['content_setumei'] == "all"){
                        unset($data_from_view['content_setumei']);
                    }

                    $data = $this->removeDataFromView($data_from_view, $removeKeys);
                    $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                    $headers = $this->headers;
                    $excelName = 'プロジェクト登録.xlsx';
                    return $this->excelDownload($headers, $searched, $excelName);
                }
            } catch (\Exception $e) {
                $exceedUser = '検索形式が間違っています。';
                $projectInfo = QueryHelper::fetchResult($query);
                $projectInfo = collect($projectInfo)->paginate($pagination);
                return view('order.projectRegistration.mainProject', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'projectInfo', 'categorykanri', 'tantousya', 'deleted_item', 'exceedUser', 'buttonMessage','setumei','se'));
            }

            return view('order.projectRegistration.mainProject', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'projectInfo', 'categorykanri', 'tantousya', 'deleted_item', 'exceedUser', 'buttonMessage','setumei','se'));
        }

        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;
        if (request('change_id')) {
            $query = allProject::data($bango, $deleted_item)->whereRaw("url = '" . request('change_id') . "'")->toSql();
        } else {
            if(count($check_tan)<1){
                $query = allProject::data($bango, $deleted_item)->toSql();
            }else{
                $query = allProject::data($bango, $deleted_item)->whereRaw("content_setumei = '" . $default_content_setumei . "'")->toSql();
            }
        }
        $projectInfo = QueryHelper::fetchResult($query);
        $projectInfo = collect($projectInfo)->paginate($pagi);
        session()->forget('oldInput' . $bango);
        return view('order.projectRegistration.mainProject', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'projectInfo', 'categorykanri', 'tantousya', 'pagi', 'deleted_item', 'buttonMessage','setumei','se'));

    }

    public function postEditProjectRegistration(Request $request, $bango)
    {
        //create & edit start here
        if (request('type') == 'create') {
            $insert = createProjectRegistration::create($request->all(), $bango, $this->headers);
            if (is_array($insert) && $insert['status'] == 'ok') {
                $last_inserted_url = $insert['change_id'];
                Session::flash('success_msg', 'プロジェクト番号　' . $last_inserted_url . ' 登録完了しました。');

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
        } elseif (request('type') == 'edit') {
            //$bango = $request['bango'];
            $insert = editProjectRegistration::edit($request->all(), $bango, $this->headers);
            if (is_array($insert) && $insert['status'] == 'ok') {
                $project_info_url = $request['url'];
                Session::flash('success_msg', 'プロジェクト番号 ' . $project_info_url . ' 変更完了しました。');

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
        //create & edit end here
    }

    public function projectRegistrationDetail (Request $request, $bango)
    {
        $url = $request['id'];
        $project = allProject::data($bango)->whereRaw("url ='" . $url . "'")->toSql();
        $project = collect(QueryHelper::fetchSingleResult($project))->toArray();
        return response()->json($project);
    }

    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = projectHeaders::$page_no;
        return $Setting = TableSetting::setting($this->headers, $id, $pageNo);

    }

    public function tableSettingSave(Request $request, $id, $type = null)
    {
        $pageNo = projectHeaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, 'プロジェクト登録', $type);
    }


    public function deleteOrReturnProject(Request $request, $bango, $type = null)
    {
        $bangoName = tantousya::find($bango)->name;

        $id = $request->all();
        $kesuId = array_keys($id)[0];

        $mytime = Carbon::now()->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        $mytime = str_replace(" ", "", $mytime);

        $query = allProject::data($bango)->whereRaw("url ='" . $kesuId . "'")->toSql();
        $deleteBefore = QueryHelper::fetchSingleResult($query);

        //start log query
        $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### プロジェクト登録 start\n";
        QueryHandler::logger($bango,$log_data);

        if ($type == 1) {
            $update_data = [
               'url' => strval($kesuId),
               'hyouji' => 0,
               'datatxt0097' => $mytime,
               'datatxt0099' => !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : null,
            ];
            QueryHelper::updateData('gazou2',$update_data,'url',$bango,__CLASS__,__FUNCTION__,__LINE__);
        } else {
            $update_data = [
               'url' => strval($kesuId),
               'hyouji' => 1,
               'datatxt0097' => $mytime,
               'datatxt0099' => !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : null,
            ];
            QueryHelper::updateData('gazou2',$update_data,'url',$bango,__CLASS__,__FUNCTION__,__LINE__);
        }

        //end log query
        $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### プロジェクト登録 end\n";
        QueryHandler::logger($bango,$log_data);

        $query = allProject::data($bango)->whereRaw("url ='" . $kesuId . "'")->toSql();
        $deleteAfter = QueryHelper::fetchSingleResult($query);

        $headers = $this->headers;
        $headers['データ有効区分'] = 'hyouji';
        if ($type == 1) {
            CSVLogger::putData('プロジェクト登録.csv', 'gazou2', $deleteBefore, $deleteAfter, $bangoName, $headers, 3);
        } else {
            CSVLogger::putData('プロジェクト登録.csv', 'gazou2', $deleteBefore, $deleteAfter, $bangoName, $headers, 0);
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
        $headers = $this->headers;
        foreach($request_data as $key=>$val){
            if (in_array($key, $headers)){
                $request_data[$key] = null;
            }
        }
        return $request_data;
    }


}
