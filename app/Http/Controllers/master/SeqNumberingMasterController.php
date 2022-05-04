<?php

namespace App\Http\Controllers\master;

use Illuminate\Http\Request;
use App\tantousya;
use App\Review;
use App\kengen;
use App\requestTable;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\master\seqNumberingMaster\createSeqNumberingMaster;
use App\AllClass\master\employeeMaster\ButtonMsg;
use App\AllClass\master\seqNumberingMaster\seqNumberingHeaders;
use App\AllClass\master\seqNumberingMaster\editSeqNumberingMaster;
use App\AllClass\SearchClass;
use App\AllClass\SortClass;
use App\AllClass\master\excelDownload;
use App\AllClass\master\seqNumberingMaster\allSeqNumbering;
use App\AllClass\TableSetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Excel;
use App\AllClass\master\ExcelReportDownload;
use Carbon\Carbon;
use App\AllClass\master\csvRecordRetrieve;
use App\AllClass\master\csvRecordDelete;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use App\Helpers\Helper;

class SeqNumberingMasterController extends Controller
{
    private $headers = [
        '番号区分' => 'kokyakusyouhinbango_detail',
        '番号' => 'orderbango',
        '番号総桁数' => 'mobile_flag',
        '登録年月日' => 'created_date',
        '登録時刻' => 'created_time',
        '更新年月日' => 'edited_date',
        '更新時刻' => 'edited_time',
      //  '更新時端末IP' => 'size',
        '更新者' => 'user_name',
    ];

    public function postSeqNumberingMaster(Request $request)
    {
        $bango = request('userId');
        $data_from_view = $request->all();
        session()->put('oldInput' . $bango, $data_from_view);
        $tantousya = tantousya::find($bango);
        $buttonMessage = ButtonMsg::read($bango);

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

        $headers = seqNumberingHeaders::headers($bango);
        $table_headers = seqNumberingHeaders::headers($bango, 'table_headers');
        $page_no = seqNumberingHeaders::$page_no;
        $route = 'seqNumberingMasterTableSetting';
        $redirect_path = 'seqNumberingMasterReload';
        $cat1D7 = QueryHelper::fetchResult("select * from categorykanri where category1 = 'D7' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $temp_table = 'review_temp';
        if (isset($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls')) {
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp'];
            $query = allSeqNumbering::data($bango, $deleted_item)->toSql();
            try {
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort') {
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);
                    $seqNumbering = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);

                    if ($seqNumbering->items() == null && $seqNumbering->currentPage() != 1) {
                        $currentPage = ($seqNumbering->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $seqNumbering = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    }

                    if ($seqNumbering->total() == 0) {
                        $exceedUser = '該当するデータがありません。';
                    } else {
                        $exceedUser = '';
                    }

                } else if ($data_from_view['Button'] == 'xls') {
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);
                    $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                    $headers = $this->headers;
                    $excelName = 'SEQ番号付番マスタ.xlsx';
                    return $this->excelDownload($headers, $searched, $excelName);
                }
            } catch (\Illuminate\Database\QueryException $ex) {
                $exceedUser = '検索形式が間違っています。';
                $seqNumbering = allSeqNumbering::data($bango, $deleted_item)->paginate($pagination);
                return view('master.seqNumberingMaster.mainSeqNumberingMaster', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'seqNumbering', 'cat1D7', 'tantousya', 'deleted_item', 'exceedUser', 'buttonMessage'));
            }

            return view('master.seqNumberingMaster.mainSeqNumberingMaster', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'seqNumbering', 'cat1D7', 'tantousya', 'deleted_item', 'exceedUser', 'buttonMessage'));
        }

        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;
        if (request('change_id')) {
            $query = allSeqNumbering::data($bango, $deleted_item)->whereRaw("bango = '" . request('change_id') . "'")->toSql();
        } else {
            $query = allSeqNumbering::data($bango, $deleted_item)->toSql();
        }
        $seqNumbering = QueryHelper::fetchResult($query);
        $seqNumbering = collect($seqNumbering)->paginate($pagi);
        session()->forget('oldInput' . $bango);
        return view('master.seqNumberingMaster.mainSeqNumberingMaster', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'seqNumbering', 'cat1D7', 'tantousya', 'pagi', 'deleted_item', 'buttonMessage'));
    }

    public function postEditSeqNumberingMaster(Request $request, $bango)
    {
        //create & edit start here
        if (request('type') == 'create') {

            $insert = createSeqNumberingMaster::create($request->all(), $bango, $this->headers);

            if (is_array($insert) && $insert['status'] == 'ok') {
                $review_info = Review::orderBy('bango', 'DESC')->first();
                $last_inserted_bango = $review_info->bango;
                Session::flash('success_msg', 'SEQ番号付番　' . $last_inserted_bango . ' 登録完了しました。');

                return $insert;
            }else if($insert == 'confirmation'){
                return "confirmation_msg"; 
            } else {
                $errors = $insert->all();
                return ['err_field' => $insert, 'err_msg' => $errors];
            }
        } elseif (request('type') == 'edit') {
            $insert = editSeqNumberingMaster::edit($request->all(), $bango, $this->headers);

            if (is_array($insert) && $insert['status'] == 'ok') {
                $review_info_bango = $request['review_bango'];
                Session::flash('success_msg', 'SEQ番号付番 ' . $review_info_bango . ' 変更完了しました。');
                return $insert;
            }else if($insert == 'confirmation'){
                return "confirmation_msg"; 
            } else {
                $errors = $insert->all();
                return ['err_field' => $insert, 'err_msg' => $errors];
            }
        }
    }

    public function seqNumberingMasterDetail(Request $request, $bango)
    {
        $id = $request['id'];
        $seq_numbering = allSeqNumbering::data($bango)->whereRaw("bango ='" . $id . "'")->toSql();
        $seq_numbering = collect(QueryHelper::fetchSingleResult($seq_numbering))->toArray();

        return response()->json($seq_numbering);
    }

    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = seqNumberingHeaders::$page_no;
        return $Setting = TableSetting::setting($this->headers, $id, $pageNo);

    }

    public function tableSettingSave(Request $request, $id, $type = null)
    {
        $pageNo = seqNumberingHeaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, 'SEQ番号付番マスタ', $type);
    }

    public function deleteOrReturnSeqNumbering(Request $request, $bango, $type = null)
    {
        $bangoName = tantousya::find($bango)->name;

        $id = $request->all();
        $kesuId = array_keys($id)[0];

        $mytime = Carbon::now()->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        $mytime = str_replace(" ", "", $mytime);

        $deleteBefore = allSeqNumbering::data($kesuId)->whereRaw("bango='" . $kesuId . "'")->toSql();
        $deleteBefore = (object)collect(QueryHelper::fetchSingleResult($deleteBefore))->toArray();

        //start log query
        $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### SEQ番号付番マスタ start\n";
        QueryHandler::logger($bango,$log_data);

        if ($type == 1) {
            $update_data = [
               'bango' => $kesuId,
               'check_flag' => 0,
               'color' => $mytime,
             //  'size' => Helper::getSystemIP(),
               'nickname' => $bango,
            ];
            QueryHelper::updateData('review',$update_data,'bango',$bango,__CLASS__,__FUNCTION__,__LINE__);
        } else {
            $update_data = [
               'bango' => $kesuId,
               'check_flag' => 1,
               'color' => $mytime,
               'nickname' => $bango,
            ];
            QueryHelper::updateData('review',$update_data,'bango',$bango,__CLASS__,__FUNCTION__,__LINE__);
        }

        //end log query
        $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### SEQ番号付番マスタ end\n";
        QueryHandler::logger($bango,$log_data);

        $deleteAfter = allSeqNumbering::data($kesuId)->whereRaw("bango='" . $kesuId . "'")->toSql();
        $deleteAfter = (object)collect(QueryHelper::fetchSingleResult($deleteAfter))->toArray();
        $headers = $this->headers;
        $headers['データ有効区分'] = 'check_flag';
        if ($type == 1) {
            csvRecordRetrieve::putData('seqNumberingMaster.csv', 'review', $deleteBefore, $deleteAfter, $bangoName, $headers);
        } else {
            csvRecordDelete::putData('seqNumberingMaster.csv', 'review', $deleteBefore, $deleteAfter, $bangoName, $headers);
        }
        return 'ok';
    }

}
