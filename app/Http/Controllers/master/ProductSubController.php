<?php

namespace App\Http\Controllers\master;

use App\AllClass\db\QueryHandler;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\tantousya;
use \Carbon\Carbon;
use App\others;
use App\requestTable;
use App\categorykanri;
use App\AllClass\SearchClass;
use App\AllClass\SortClass;
use App\AllClass\master\productSubMaster\allOthers;
use App\AllClass\master\productSubMaster\createProductSubMaster;
use App\AllClass\master\productSubMaster\editProductSubMaster;
use App\AllClass\master\productSubMaster\productSubMasterheaders;
use App\AllClass\master\csvRecordDelete;
use App\AllClass\master\excelDownload;
use Session;
use App\AllClass\master\employeeMaster\allTantousya;
use App\AllClass\TableSetting;
use Illuminate\Pagination\Paginator;
use Excel;
use App\AllClass\master\ExcelReportDownload;
use App\AllClass\master\employeeMaster\ButtonMsg;
use App\Helpers\Helper;

class ProductSubController extends Controller
{

    private $headers = [
        'サブ区分' => 'other1',
        '商品サブCD' => 'other2',
        '取引先' => 'other3_detail',
        'データ種' => 'other4_detail',
        'バージョン区分' => 'other25_detail',
        '商品サブ名称' => 'other21',
        '商品サブ名称カナ名' => 'other5',
        '商品サブ分類1' => 'other6',
        '商品サブ分類2' => 'other7',
        '商品サブ分類3' => 'other8',
        '作成事業部' => 'other9',
        '作成部' => 'other10',
        '作成グループ' => 'other11',
        '作成者' => 'other12_detail',
        'データ区分' => 'other13_original',
        '作成ステータス' => 'other13_original',
        '上市開始日' => 'other15_modified',
        '終売日' => 'other16_modified',
        '入力区分' => 'other13_original',
        'サブCD桁数' => 'other18',
        '対応バージョン' => 'other20',
        //        '小売業会社名' => 'other21',
        '小売業略称' => 'other22',
        '小売業部門' => 'other23',
        '小売業メッセージ種' => 'other24',
        '登録年月日' => 'created_date',
        '登録時刻' => 'created_time',
        '更新年月日' => 'edited_date',
        '更新時刻' => 'edited_time',
        //   '更新時端末IP' => 'other28',
        '更新者' => 'other29',
    ];

    public function postProductSubMaster(Request $request)
    {
        //dd($request->all());
        $bango = request('userId');
        $data_from_view = $request->all();
        session()->put('oldProductSub' . $bango, $data_from_view);
        $tantousya = tantousya::find($bango);
        if (!empty($data_from_view['chkboxinp'])) {
            $deleted_item = $data_from_view['chkboxinp'];
        } else {
            $deleted_item = 0;
        }
        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 20;
        }
        $buttonMessage = ButtonMsg::read($bango);
        $request['1'] = QueryHelper::select(['*'])->from('request')->where("color = '0814サブ区分'")->orderBy('bango ASC')->get()->execute();
        $request['2'] = QueryHelper::select(['*'])->from('request')->where("color = '0814バージョン区分'")->orderBy('bango ASC')->get()->execute();
        $request['13'] = QueryHelper::select(['*'])->from('request')->where("color = '0814データ区分'")->orderBy('bango ASC')->get()->execute();
        $request['14'] = QueryHelper::select(['*'])->from('request')->where("color = '0814作成ステータス'")->orderBy('bango ASC')->get()->execute();
        $request['17'] = QueryHelper::select(['*'])->from('request')->where("color = '0814入力区分'")->orderBy('bango ASC')->get()->execute();
        $categorykanris['D2'] = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'D2'")->where("suchi2 = 0")->orderBy('bango ASC')->get()->execute();
        $categorykanris['D3'] = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'D3'")->where("suchi2 = 0")->orderBy('bango ASC')->get()->execute();
        $categorykanris['D4'] = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'D4'")->where("suchi2 = 0")->orderBy('bango ASC')->get()->execute();
        $categorykanris['E4'] = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'E4'")->where("suchi2 = 0")->orderBy('bango ASC')->get()->execute();
        if (isset($categorykanris['E4'][0])) {
            $categorykanris['E5'] = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'E5'")->where("category2 LIKE '" . $categorykanris['E4'][0]->category2 . "%'")->where("suchi2 = 0")->orderBy('bango ASC')->get()->execute();
        } else {
            $categorykanris['E5'] = [];
        }

        if (isset($categorykanris['E5'][0])) {
            $categorykanris['E8'] = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'E8'")->where("category2 LIKE '" . $categorykanris['E5'][0]->category2 . "%'")->where("suchi2 = 0")->orderBy('bango ASC')->get()->execute();
        } else {
            $categorykanris['E8'] = [];
        }

        $headers = productSubMasterheaders::headers($bango);
        $table_headers = productSubMasterheaders::headers($bango, 'table_headers');
        $page_no = productSubMasterheaders::$page_no;
        $route = 'ProductSubMasterTableSetting';
        $redirect_path = 'ProductSubMasterReload';
        $tantousyas = QueryHelper::select(['*'])->from('tantousya')->where('deleteflag = 0')
            ->where('innerlevel >=10 OR innerlevel is null')
            ->orderBy('bango ASC')->get()->execute();
        // dd($request['1']);
        $temp_table = 'others_temp';
        if (isset($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls')) {
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp'];
            $query = allOthers::data($bango, $deleted_item)->toSql();

            try {
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort') {
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);
                    $others = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);

                    //                    $others = SearchClass::search(allOthers::data($bango, $deleted_item), $data_from_view, $bango, 'others_temp')->paginate($pagination);
                    //dd($others);

                    if ($others->items() == null && $others->currentPage() != 1) {

                        $currentPage = ($others->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        //                        $others = SearchClass::search(allOthers::data($bango, $deleted_item), $data_from_view, $bango, 'others_temp')->paginate($pagination);
                        $others = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    }
                    if ($others->total() == 0) {
                        $exceedUser = '該当するデータがありません。';
                    } else {
                        $exceedUser = '';
                    }
                } else if ($data_from_view['Button'] == 'xls') {
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);
                    $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                    $headers = $this->headers;
                    $excelName = '商品サブマスタ.xlsx';
                    return $this->excelDownload($headers, $searched, $excelName);
                }
            } catch (\Exception $e) {
                $exceedUser = '該当するデータがありません。';
                $others = QueryHelper::fetchResult($query);
                $others = collect($others)->paginate($pagination);
                return view('master.productSub.productSubMaster', compact('others', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'deleted_item', 'bango', 'tantousya', 'deleted_item', 'exceedUser', 'request', 'tantousyas', 'categorykanris', 'buttonMessage'));
            }
            return view('master.productSub.productSubMaster', compact('others', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'deleted_item', 'exceedUser', 'bango', 'tantousya', 'deleted_item', 'request', 'tantousyas', 'categorykanris', 'buttonMessage'));
        }


        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;

        if (request('change_id')) {
            $change_id =  request('change_id');
            $query  = allOthers::data($bango)->whereRaw("other25 = '" . $change_id . "'")->toSql();
            // $query = allOthers::data($bango, $deleted_item)
            //     ->whereRaw("other26 = '" . $change_id[0] . "' OR other27 = '" . $change_id[0] . "'")
            //     ->whereRaw("other29_original = '" . $change_id[1] . "'")->toSql();
        } else {
            $query = allOthers::data($bango, $deleted_item)->toSql();
        }
        $others = QueryHelper::fetchResult($query);
        $others = collect($others)->paginate($pagi);
        session()->forget('oldProductSub' . $bango);
        return view('master.productSub.productSubMaster', compact('others', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'deleted_item', 'bango', 'tantousya', 'deleted_item', 'request', 'tantousyas', 'categorykanris', 'pagi', 'buttonMessage'));
    }

    public function postEditProductSubMaster(Request $request, $bango)
    {
        if (request('type') == 'create') {

            $insert = createProductSubMaster::create($request->all(), $bango, $this->headers, request('validate_only'));
            if (is_array($insert) && $insert['status'] == 'ok') {
                Session::flash('success_msg', '商品サブCD ' . $insert['other2'] . ' 登録 完了しました。');
                return $insert;
            } else {
                $errors = $insert->all();
                return ['err_field' => $insert, 'err_msg' => $errors];
            }
        }

        if (request('type') == 'edit') {

            $insert = editProductSubMaster::edit($request->all(), $bango, $this->headers, request('validate_only'));
            if (is_array($insert) && $insert['status'] == 'ok') {
                Session::flash('success_msg', '商品サブCD ' . $insert['other2'] . ' 変更完了しました。');
                return $insert;
            } else {
                $errors = $insert->all();
                return ['err_field' => $insert, 'err_msg' => $errors];
            }
        }
    }

    public function ProductSubApi(Request $request, $id, $bango)
    {
        $sql = allTantousya::data($bango, 0, $id, true);
        $tantousya = QueryHelper::fetchResult($sql);

        //        $tantousya = allTantousya::data($bango)
        //            ->where('bango', $id)
        //            ->get();
        // $tantousya= tantousya::where('bango',$id)
        //                          ->first();

        return $tantousya;
    }

    public function masterDetail(Request $request, $bango)
    {
        // $primaryKey = $request['id'];
        // $primaryArray = explode('%%', $primaryKey);

        // if (!empty($primaryArray[1])) {
        //     $data = allOthers::data($bango)
        //         ->whereRaw("other26 ='" . $primaryArray[0] . "'")
        //         ->whereRaw("other27 ='" . $primaryArray[1] . "'")->toSql();
        // } else {
        //     $data = allOthers::data($bango)
        //         ->whereRaw("other26 ='" . $primaryArray[0] . "'")->toSql();
        // }
        $other25 = $request['id'];
        $data  = allOthers::data($bango)->whereRaw("other25 = '" . $other25 . "'")->toSql();

        $data = collect(QueryHelper::fetchSingleResult($data))->map(function ($item, $key) {
            $filterKeys  = ['other3', 'other3_detail', 'other4', 'other4_detail', 'other25', 'other25_detail'];
            if (in_array($key, $filterKeys)) {
                return substr($item, 2);
            }
            return  $item;
        })->toArray();

        if (isset($data['other3'])) {
            $categorykanris1 = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'E4'")->where("category2 = '" . $data['other3'] . "'")->get()->execute();
            $data['other3cat4'] = $categorykanris1[0]->category4;
            $categorykanris2 = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'E5'")->where("category2 = '" . $data['other4'] . "'")->get()->execute();
            $data['other4cat4'] = $categorykanris2[0]->category4;
            $categorykanris3 = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'E8'")->where("category2 = '" . $data['other25'] . "'")->get()->execute();
            //            $request1 = QueryHelper::select(['*'])->from('request')->where("color = '0814バージョン区分'")->where("syouhinbango = '".$data['other25']."'")->get()->execute();
            $data['other25cat4'] = $categorykanris3[0]->category4;
        }

        $array = [];
        foreach ($data as $key => $value) {
            $array[$key] = $value;
        }

        return $array;
    }

    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = productSubMasterheaders::$page_no;
        return $Setting = TableSetting::setting($this->headers, $id, $pageNo);
    }

    public function tableSettingSave(Request $request, $id, $type = null)
    {
        $pageNo = productSubMasterheaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '商品サブマスタ', $type);
    }

    public function deleteData(Request $request, $bango, $type = null)
    {
        $bangoName = tantousya::find($bango)->name;
        // $mytime = Carbon::now()->toDateTimeString();
        // $mytime = str_replace(":", "", $mytime);
        // $mytime = str_replace("-", "", $mytime);
        // $mytime = str_replace(" ", "", $mytime);

        // $primaryKey = $request['kesuId'];

        // $primaryArray = explode('%%', $primaryKey);
        $other25 = $request['kesuId'];
        $deleteBefore = allOthers::data($bango)->whereRaw("other25 ='" . $other25 . "'")->toSql();
        $deleteBefore = (object)collect(QueryHelper::fetchSingleResult($deleteBefore))->toArray();
        //        $deleteBefore = allOthers::data($primaryArray[0])->where('other26', $primaryArray[0])->first();
        // $other27 = !empty($primaryArray[1]) ? $primaryArray[1] : null;
        // $other26 = $primaryArray[0];
        // $condition = ['other27' => $other27, 'other26' => $other26];
        $condition = ['other25' => $other25];
        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 商品サブマスタ start\n";
        QueryHandler::logger($bango, $log_data);
        if ($type == 1) {
            $updateData = [
                'other19' => 0,
                'other25' => $other25
                // 'other27' => $mytime,
                //     'other28' => Helper::getSystemIP(),
                // 'other29' => $bango
            ];
        } else {
            $updateData = [
                'other19' => 1,
                'other25' => $other25
                // 'other27' => $mytime,
                //   'other28' => Helper::getSystemIP(),
                // 'other29' => $bango
            ];
        }
        QueryHelper::updateData('others', $updateData, $condition, $bango, __CLASS__, __FUNCTION__, __LINE__);
        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 商品サブマスタ end\n";
        QueryHandler::logger($bango, $log_data);
        $deleteAfter = allOthers::data($bango)->whereRaw("other25 ='" . $other25 . "'")->toSql();
        $deleteAfter = (object)collect(QueryHelper::fetchSingleResult($deleteAfter))->toArray();
        //        $deleteAfter = allOthers::data($bango)->where('other26', $primaryArray[0])->first();
        $headers = $this->headers;
        $headers['データ有効区分'] = 'other19';
        csvRecordDelete::putData('productsubMaster.csv', 'others', $deleteBefore, $deleteAfter, $bangoName, $headers);

        return 'ok';
    }

    public function getCatogoryData(Request $request)
    {
        if (isset($request->other3)) {
            $data = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'E5'")->where("category2 LIKE '" . $request->other3 . "%'")->where("suchi2 = 0")->orderBy('bango ASC')->get()->execute();
        } elseif (isset($request->other4)) {
            $data = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'E8'")->where("category2 LIKE '" . $request->other4 . "%'")->where("suchi2 = 0")->orderBy('bango ASC')->get()->execute();
        } else {
            $data = null;
        }
        return $data;
    }
}
