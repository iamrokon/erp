<?php

namespace App\Http\Controllers\master;

use App\AllClass\master\creditMaster\creditheaders;
use App\AllClass\master\creditMaster\editCreditMaster;
use App\AllClass\master\creditMaster\CreditSearch;
use App\AllClass\master\creditMaster\CreditSearch1;
use App\AllClass\master\creditMaster\CreditJoinQuery;
use App\AllClass\master\creditMaster\CreditSort;
use App\AllClass\master\creditMaster\allCredit;
use App\AllClass\master\ExcelReportDownload;
use App\AllClass\TableSetting;
use App\categorykanri;
use App\kokyaku1;
use App\requestTable;
use App\tantousya;
use App\kaiin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use DB;
use Session;
use Excel;

class CreditMasterController extends Controller
{
    private $headers = [
        '会社CD' => 'point',
        '会社名' => 'kokyaku1_name',
        '年月' => 'kounyusu',
        '与信限度額' => 'denpyostart',
        '前月与信残高金額' => 'syukei1',
        '当月受注金額' => 'syukei2',
        '当月売上金額' => 'syukei3',
        '当月入金金額' => 'syukei4',
        '当月与信残高金額' => 'syukei5',
        '登録年月日' => 'mail11',
        '登録時刻' => 'mail12',
        '更新年月日' => 'mail21',
        '更新時刻' => 'mail22',
       // '更新時端末IP' => 'name',
        '更新者' => 'kaka',
    ];

    public function creditMasterDetail(Request $request)
    {
        $bango = request('bango');
        $kaiinDetails = DB::table('kaiin')
            ->join('kokyaku1', 'kaiin.kokyakubango', '=', 'kokyaku1.bango')
            ->select('kaiin.*', 'kokyaku1.name as kokyaku_name', 'kokyaku1.denpyostart')
            ->where('kaiin.bango', $bango)
            ->get()->toArray();
        return $kaiinDetails;
    }

//    public function creditMasterEdit(Request $request, $bango)
//    {
//        $id =$request->get('id');
//        dd($id);
//        $kaiinDetails =DB::table('kaiin')
//            ->join('kokyaku1','kaiin.kokyakubango','=','kokyaku1.bango')
//            ->select('kaiin.*','kokyaku1.name as kokyaku1Name','kokyaku1.denpyostart')
//            ->where('kaiin.bango', $id)
//            ->get()->toArray();
//        return $kaiinDetails;
//    }

    public function postCreditMaster(Request $request)
    {
//        dd($request->all());
        $bango = request('userId');
        if (request('type') == 'edit') {
            $insert = editCreditMaster::edit($request->all(), $bango);
            if ($insert == 'ok') {
                Session::flash('success_msg', '会社CD ' . $bango . ' 変更完了しました。');
                return $insert;
            } else {
                $errors = $insert->all();
                return ['err_field' => $insert, 'err_msg' => $errors];
            }
        }

        $headers = creditheaders::headers($bango);
        $table_headers = creditheaders::headers($bango, 'table_headers');
        $page_no = creditheaders::$page_no;
        $route = 'creditMasterTableSetting';
        $redirect_path = 'creditMasterReload';
        $data_from_view = $request->all();
        session()->put('oldInput' . $bango, $data_from_view);
//        dd($data_from_view);
        $tantousya = tantousya::find($bango);
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
        $mytime = Carbon::now()->toDateString();
        $date = explode("-", $mytime);
        $year = $date[0];
        $month = $date[1];
        $year1 = $date[0];
        $month1 = $date[1] - 1;
        if ($month1 == 0) {
            $month1 = 12;
            $year1 = $year1 - 1;
        }
        if ($month == 0) {
            $month = 12;
            $year = $year - 1;
        }


        $name = array();
        if (isset($data_from_view['kokyakuNameDrop'])) {
            $kokyakuDrop = $data_from_view['kokyakuNameDrop'];

            if ($data_from_view['kokyakuNameDrop'] === '0') {
                $name = DB::table('kokyaku1')
                    ->join('haisoujouhou', 'kokyaku1.bango', '=', 'haisoujouhou.syukei1')
                    ->where('haisoujouhou.syukeituki', 1)
                    ->pluck('kokyaku1.name')->toArray();
            } else {

                $name[0] = $data_from_view['kokyakuNameDrop'];
            }
        } else {
            $name = DB::table('kokyaku1')
                ->join('haisoujouhou', 'kokyaku1.bango', '=', 'haisoujouhou.syukei1')
                ->where('haisoujouhou.syukeituki', 1)
                ->pluck('kokyaku1.name')->toArray();
            $kokyakuDrop = "0";
        }
        if (isset($data_from_view['fromYear']) && isset($data_from_view['fromMonth'])) {
            if (strlen($data_from_view['fromMonth']) < 2) {
                $month = '0' . $data_from_view['fromMonth'];
            }
            $dateTimeFrom = $data_from_view['fromYear'] . $month . "01000000";
            $year1 = $data_from_view['fromYear'];
            $month1 = $data_from_view['fromMonth'];
        } else {
            $dateTimeFrom = Carbon::now()->subDays(30);
        }
        if (isset($data_from_view['toYear']) && isset($data_from_view['toMonth'])) {
            if (strlen($request['toMonth']) < 2) {
                $month = '0' . $request['toMonth'];
            } else {
                $month = $request['toMonth'];
            }
            if ($month == '02') {
                if ($request['toYear'] % 4 == 0 || ($request['toYear'] % 100 == 0 && $request['toYear'] % 400 == 0)) {
                    $dateTimeTo = $request['toYear'] . $month . "29235959";
                } else {
                    $dateTimeTo = $request['toYear'] . $month . "28235959";
                }
            } elseif ($month == '01' || $month == '03' || $month == '05' || $month == '07' || $month == '08' || $month == '10' || $month == '12') {
                $dateTimeTo = $request['toYear'] . $month . "31235959";
            } else {
                $dateTimeTo = $request['toYear'] . $month . "30235959";
            }
            $year = $data_from_view['toYear'];
            $month = $data_from_view['toMonth'];
        } else {
            $dateTimeTo = $date[0] . $date[1] . $date[2] . '235959';
        }
        $kaiinInfos = DB::table('kaiin')
            ->join('kokyaku1', 'kaiin.kokyakubango', '=', 'kokyaku1.bango')
            ->select('kaiin.*', 'kokyaku1.name as kokyaku1_name', 'kokyaku1.denpyostart')
            ->whereIn('kokyaku1.name', $name)
            ->where('kaiin.mail', '>=', $dateTimeFrom)
            ->where('kaiin.mail', '<=', $dateTimeTo)
            ->where('kaiin.mailflagu', 0)
            ->orderBy('kaiin.bango', 'ASC')
            ->paginate($pagination);
        $kokyakuNames = DB::table('kokyaku1')
            ->join('haisoujouhou', 'kokyaku1.bango', '=', 'haisoujouhou.syukei1')
            ->where('haisoujouhou.syukeituki', 1)
            ->pluck('kokyaku1.name')->toArray();

        if (!empty($data_from_view['Button']) && $data_from_view['Button'] == 'Thesearch') {
            foreach ($data_from_view as $key => $value) {
                if ($key == "page" || $key == "Button" || $key == "pagination" || $key == "_token" || $key == "kokyakuNameDrop" || $key == "fromYear" || $key == "fromMonth" || $key == "toYear" || $key == "toMonth" || $key == "userId" || $key == "type" || $key == "chkboxinp") {
                    unset ($data_from_view[$key]);
                }
            }
//            $kaiinInfos = CreditSearch::search(allCredit::data($bango,$name, $dateTimeFrom, $dateTimeTo), $data_from_view, $bango)->paginate($pagination);
            try {
                $kaiinInfos = CreditSearch::search(allCredit::data($bango, $name, $dateTimeFrom, $dateTimeTo, $deleted_item), $data_from_view, $bango)->paginate($pagination);
                $copyMono = session()->get('MEditData');
                if ($kaiinInfos->items() == null && $kaiinInfos->currentPage() != 1) {

                    while (CreditSearch::search(allCredit::data($bango, $name, $dateTimeFrom, $dateTimeTo, $deleted_item), $data_from_view, $bango)->paginate($pagination)->items() == null && CreditSearch::search('kaiin', $data_from_view, $bango)->paginate($pagination)->currentPage() != 1) {
                        $currentPage = ($kaiinInfos->currentPage() - 1);
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $kaiinInfos = CreditSearch::search(allCredit::data($bango, $name, $dateTimeFrom, $dateTimeTo, $deleted_item), $data_from_view, $bango)->paginate($pagination);
                    }
                }
                if ($kaiinInfos->total() == 0) {
                    $exceedUser = '該当するデータがありません。';
                } else {
                    $exceedUser = '';
                }
            } catch (\Illuminate\Database\QueryException $ex) {
                $exceedUser = '検索形式が間違っています。';
            }
            return view('master.creditMaster.mainCreditMaster', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'kaiinInfos', 'kokyakuNames', 'year', 'month', 'year1', 'month1', 'kokyakuDrop', 'tantousya', 'deleted_item', 'exceedUser'));
        }

        if (!empty($data_from_view['Button']) && $data_from_view['Button'] == 'sort') {
            foreach ($data_from_view as $key => $value) {
                if ($key == "page" || $key == "Button" || $key == "pagination" || $key == "_token" || $key == "kokyakuNameDrop" || $key == "fromYear" || $key == "fromMonth" || $key == "toYear" || $key == "toMonth" || $key == "userId" || $key == "chkboxinp") {
                    unset ($data_from_view[$key]);
                }
            }
//            $kaiinInfos= CreditSort::sort(allCredit::data($bango,$name, $dateTimeFrom, $dateTimeTo),$data_from_view,$bango)->paginate($pagination);
//            dd($kaiinInfos);
            try {
                $kaiinInfos = CreditSort::sort(allCredit::data($bango, $name, $dateTimeFrom, $dateTimeTo, $deleted_item), $data_from_view, $bango)->paginate($pagination);

                $copyMono = session()->get('MEditData');
                if ($kaiinInfos->items() == null && $kaiinInfos->currentPage() != 1) {
                    while (CreditSort::sort(allCredit::data($bango, $name, $dateTimeFrom, $dateTimeTo, $deleted_item), $data_from_view, $bango)->paginate($pagination)->items() == null && CreditSort::sort(allCredit::data($bango, $name, $dateTimeFrom, $dateTimeTo, $deleted_item), $data_from_view, $bango)->paginate($pagination)->currentPage() != 1) {
                        $currentPage = ($kaiinInfos->currentPage() - 1);
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $users = CreditSort::sort(allCredit::data($bango, $name, $dateTimeFrom, $dateTimeTo, $deleted_item), $data_from_view, $bango)->paginate($pagination);
                    }
                }
                if ($kaiinInfos->total() == 0) {
                    $exceedUser = '該当するデータがありません。';
                } else {
                    $exceedUser = '';
                }
            } catch (\Illuminate\Database\QueryException $ex) {
                $exceedUser = '検索形式が間違っています。';
            }
            return view('master.creditMaster.mainCreditMaster', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'kaiinInfos', 'kokyakuNames', 'year', 'month', 'year1', 'month1', 'kokyakuDrop', 'tantousya', 'deleted_item', 'exceedUser'));
        }

        if (!empty($data_from_view['Button']) && $data_from_view['Button'] == 'xls') {
//            dd($data_from_view);
            foreach ($data_from_view as $key => $value) {
                if ($key == "page" || $key == "Button" || $key == "pagination" || $key == "_token" || $key == "type" || $key == "kokyakuNameDrop" || $key == "fromYear" || $key == "fromMonth" || $key == "toYear" || $key == "toMonth" || $key == "userId" || $key == "chkboxinp") {
                    unset ($data_from_view[$key]);
                }
            }
//            $kaiinInfos=CreditSearch::search(allCredit::data($bango),$data_from_view,$bango)->paginate($pagination);
//            try {
            $searched = CreditSearch::search(allCredit::data($bango, $name, $dateTimeFrom, $dateTimeTo, $deleted_item), $data_from_view, $bango);
//            $kaiinInfos =excelDownload::read($request->all(),$searched,$headers,'Credits');

            ob_end_clean(); // this
            ob_start(); // and this
            return Excel::download(new ExcelReportDownload($this->headers, $searched), '売上請求先別与信管理マスタ.xlsx');
//            if ($kaiinInfos==true)
//            {
//                $kaiinInfos=CreditSearch::search(allCredit::data($bango,$name, $dateTimeFrom, $dateTimeTo, $deleted_item),$data_from_view,$bango)->paginate($pagination);
//                if($kaiinInfos->items() == null && $kaiinInfos->currentPage($name, $dateTimeFrom, $dateTimeTo) != 1){
//                    while (CreditSearch::search(allCredit::data($bango,$name, $dateTimeFrom, $dateTimeTo),$data_from_view,$bango)->paginate($pagination)->items() == null && CreditSearch::search(allCredit::data($bango,$name, $dateTimeFrom, $dateTimeTo),$data_from_view,$bango)->paginate($pagination)->currentPage() != 1){
//                        $currentPage= ($kaiinInfos->currentPage()-1);
//                        Paginator::currentPageResolver(function () use ($currentPage) {
//                            return $currentPage;
//                        });
//                        $kaiinInfos = CreditSearch::search(allCredit::data($bango,$name, $dateTimeFrom, $dateTimeTo, $deleted_item),$data_from_view,$bango)->paginate($pagination);
//                    }
//                }
//                if ($kaiinInfos->total() == 0) {
//                    $exceedUser='該当するデータがありません。';
//                }
//                else{
//                    $exceedUser='';
//                }
//            }

//            } catch (\Illuminate\Database\QueryException $ex) {
//                $exceedUser='検索形式が間違っています。';
//
//            }

//            return view('master.creditMaster.mainCreditMaster',compact('bango','headers','table_headers','page_no','route','redirect_path','kaiinInfos','kokyakuNames', 'year', 'month', 'year1', 'month1', 'kokyakuDrop'. 'tantousya','deleted_item', 'exceedUser'));
        }
        session()->forget('oldInput' . $bango);
        $kaiinInfos = allCredit::data($bango, $name, $dateTimeFrom, $dateTimeTo, $deleted_item)->paginate($pagination);
        return view('master.creditMaster.mainCreditMaster', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'kaiinInfos', 'kokyakuNames', 'year', 'month', 'year1', 'month1', 'kokyakuDrop', 'tantousya', 'deleted_item'));
    }

    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = creditheaders::$page_no;
        return $Setting = TableSetting::setting($this->headers, $id, $pageNo);

    }

    public function tableSettingSave(Request $request, $id, $type = null)
    {
        $pageNo = creditheaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '売上請求先別与信管理マスタ', $type);
    }

    public function clearTableSetting(Request $request, $bango)
    {
        $id = $request->all();
        $kesuId = array_keys($id)[0];
        kaiin::where('bango', $kesuId)->update([
            'mailflagu' => 1,
        ]);
        return 'ok';
    }


}
