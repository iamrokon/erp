<?php

namespace App\Http\Controllers\master;

use App\AllClass\db\QueryHandler;
use App\AllClass\master\csvRecordDelete;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AllClass\master\nameMaster\nameheaders;
use App\categorykanri;
use App\kengen;
use App\tantousya;
use \Carbon\Carbon;
use App\AllClass\master\nameMaster\createNameMaster;
use App\AllClass\master\nameMaster\editNameMaster;
use App\AllClass\master\employeeMaster\TantousyaSearch;
use App\AllClass\master\employeeMaster\TantousyaSort;
use App\AllClass\master\nameMaster\allCategorykanri;
use App\AllClass\master\excelDownload;
use Illuminate\Pagination\Paginator;
use App\AllClass\TableSetting;
use Session;
use Excel;
use App\AllClass\master\ExcelReportDownload;
use App\AllClass\master\employeeMaster\ButtonMsg;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\Helpers\Helper;

class NameMasterController extends Controller
{
    private $headers = [
        '名称CD' => 'category1',
        '分類CD' => 'category2',
        '名称名' => 'category3',
        '分類名' => 'category4',
        '名称名略称' => 'category5',
        '分類名略称' => 'groupbango',
        '分類コード桁数' => 'osusume',
        '表示順' => 'suchi1',
        '変更可否' => 'changed',
        '予備1' => 'spare_one',
        '予備2' => 'spare_two',
        '予備3' => 'spare_three',
        '登録年月日' => 'created_date',
        '登録時刻' => 'created_time',
        '更新年月日' => 'edited_date',
        '更新時刻' => 'edited_time',
        //  '更新時端末IP' => 'image3',
        '更新者' => 'user_name',// old name ->kokyakubango
    ];

    public function postNameMaster(Request $request)
    {
        //QueryHelper::runQuery("DELETE FROM kengensettei  WHERE kengenchar01 = 'col' and kengenchar05 = '08-06'");
        $bango = request('userId');
        $tantousya = tantousya::where('bango', $bango)->first();
        $headers = nameheaders::headers($bango);
        $table_headers = nameheaders::headers($bango, 'table_headers');
        $page_no = nameheaders::$page_no;
        $route = 'nameMasterTableSetting';
        $redirect_path = 'nameMasterReload';
        $data_from_view = $request->all();
        session()->put('oldInputName' . $bango, $data_from_view);
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
        $buttonMessage = ButtonMsg::read($bango);
        $temp_table = "categorykanri_temp";
        if (isset($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls')) {
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp'];
            $query = allCategorykanri::data($bango, $deleted_item)->toSql();

            try {
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort') {
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);
                    $categorykanris = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);

//                    $categorykanris=TantousyaSearch::search(allCategorykanri::data($bango,$deleted_item),$data_from_view,$bango,'categorykanri_temp')->paginate($pagination);

                    if ($categorykanris->items() == null) {

                        $currentPage = ($categorykanris->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $categorykanris = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
//                    $categorykanris= TantousyaSearch::search(allCategorykanri::data($bango,$deleted_item),$data_from_view,$bango,'categorykanri_temp')->paginate($pagination);
                    }
                    if ($categorykanris->total() == 0) {
                        $exceedUser = '該当するデータがありません。';
                    } else {
                        $exceedUser = '';
                    }
                } else if ($data_from_view['Button'] == 'xls') {
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);
                    $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                    $headers = $this->headers;
                    $excelName = '名称マスタ.xlsx';
                    return $this->excelDownload($headers, $searched, $excelName);
                }
            } catch (\Exception $e) {
                $exceedUser = '検索形式が間違っています。';
                $categorykanris = QueryHelper::fetchResult($query);
                $categorykanris = collect($categorykanris)->paginate($pagination);
//                     $categorykanris=allCategorykanri::data($bango,$deleted_item)->paginate($pagination);
                return view('master.nameMaster.name', compact('tantousya', 'bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'categorykanris', 'deleted_item', 'exceedUser', 'buttonMessage'));

            }
            return view('master.nameMaster.name', compact('tantousya', 'bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'categorykanris', 'deleted_item', 'exceedUser', 'buttonMessage'));
        }

        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;
        if (request('change_id')) {
            $query = allCategorykanri::data($bango, $deleted_item)->whereRaw("bango = '" . request('change_id') . "'")->toSql();
        } else {
            $query = allCategorykanri::data($bango, $deleted_item)->toSql();
        }
        $categorykanris = QueryHelper::fetchResult($query);
        $categorykanris = collect($categorykanris)->paginate($pagi);
        session()->forget('oldInputName' . $bango);
        return view('master.nameMaster.name', compact('tantousya', 'bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'categorykanris', 'deleted_item', 'pagi', 'buttonMessage'));
    }

    public function postEditNameMaster(Request $request, $bango)
    {
        if (request('type') == 'create') {
            $insert = createNameMaster::create($request->all(), $bango, $this->headers,request('validate_only'));
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

            $insert = editNameMaster::edit($request->all(), $bango, $this->headers,request('validate_only'));
            if (is_array($insert) && $insert['status'] == 'ok') {
                if (request('validate_only') != '1') Session::flash('success_msg', '名称CD ' . $request['category1'] . ' 変更完了しました。');
                return $insert;
                //名称CD　XX 変更完了しました
            } elseif (is_array($insert) && $insert['status'] == 'ng') {
                if (request('validate_only') != '1') Session::flash('failure_msg', '間違えました。');
                return $insert;
            } elseif($insert == 'confirmation'){
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
        $splitId = explode(" ", $request['id']);
        $data = allCategorykanri::data($bango)->whereRaw("bango = '" . $id . "'")->toSql();
        $data = collect(QueryHelper::fetchSingleResult($data))->toArray();
        $array = [];
        foreach ($data as $key => $value) {
            $array[$key] = $value;
        }
        return $array;
    }

    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = nameheaders::$page_no;
        return $Setting = TableSetting::setting($this->headers, $id, $pageNo);

    }

    public function tableSettingSave(Request $request, $id, $type = null)
    {

        $pageNo = nameheaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '名称マスタ', $type);
    }

    public function clearTableSetting(Request $request, $bango, $type = null)
    {
        $bangoName = tantousya::find($bango)->name;
        $mytime = Carbon::now()->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        $mytime = str_replace(" ", "", $mytime);
        $id = $request->all();
        $kesuId = array_keys($id)[0];
        $query = allCategorykanri::data($kesuId)->toSql();
        $deleteBefore = QueryHelper::fetchSingleResult("$query where bango = $kesuId");
        $condition = ['bango' => $kesuId];
        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 名称マスタ start\n";
        QueryHandler::logger($bango, $log_data);
        if ($type == 1) {
            $updateData = [
                'suchi2' => 0,
                'image2' => $mytime,
                // 'image3' => Helper::getSystemIP(),
                'kokyakubango' => $bango,
            ];
            QueryHelper::updateData('categorykanri', $updateData, $condition, $bango, __CLASS__, __FUNCTION__, __LINE__);
        } else {
            $updateData = [
                'suchi2' => 1,
                'image2' => $mytime,
                // 'image3' => Helper::getSystemIP(),
                'kokyakubango' => $bango,
            ];
            QueryHelper::updateData('categorykanri', $updateData, $condition, $bango, __CLASS__, __FUNCTION__, __LINE__);
        }
        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 名称マスタ end\n";
        QueryHandler::logger($bango, $log_data);
        $query = allCategorykanri::data($kesuId)->toSql();
        $deleteAfter = QueryHelper::fetchSingleResult("$query where bango = $kesuId");
        $headers = $this->headers;
        $headers['データ有効区分'] = 'suchi2';
        csvRecordDelete::putData('nameMaster.csv', 'categorykanri', $deleteBefore, $deleteAfter, $bangoName, $headers);


        return 'ok';
    }

    public function nameApi(Request $request, $id)
    {

        $firstData = $request['firstData'];

        $category2 = QueryHelper::select(['*'])->from('categorykanri')->where("category2 = '" . $firstData . "'")
            ->where("category1 = 'AA'")
            ->get()->execute();

        if (isset($category2[0]) && $category2[0] != null) {
            $modifiedArray = [];
            $modifiedArray['category3'] = $category2[0]->category4;
            $modifiedArray['category5'] = $category2[0]->groupbango;

            return $modifiedArray;
        } else {
            $data = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = '" . $firstData . "'")
                ->get()->execute();

            if (isset($data[0]) && $data[0] != null) {
                $data[0] = (array)$data[0];
                return $data[0];
            } else {
                return 'ok';
            }
        }

    }
}
