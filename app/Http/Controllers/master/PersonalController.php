<?php
namespace App\Http\Controllers\master;

use App\AllClass\db\QueryHandler;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\master\CSVLogger;
use App\AllClass\master\csvRecordDelete;
use App\AllClass\master\csvRecordRetrieve;
use App\AllClass\master\employeeMaster\ButtonMsg;
use App\AllClass\master\excelDownload;
use App\AllClass\master\ExcelReportDownload;
use App\AllClass\master\personal_master\AllPersonal;
use App\AllClass\master\personal_master\Personal;
use App\AllClass\SearchClass;
use App\AllClass\SortClass;
use App\AllClass\TableSetting;
use App\etsuransya;
use App\haisou;
use App\Http\Controllers\Controller;
use App\kokyaku1;
use App\requestTable;
use App\tantousya;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Helpers\Helper;

class PersonalController extends Controller
{

    public $headers = [
        '会社CＤ' => 'personal_company_cd',
        '会社名' => 'company_name',
        '事業所CＤ' => 'personal_office_cd',
        '事業所名' => 'office_name',
        '個人CＤ' => 'personal_datatxt0049',
        '部署' => 'mail2',
        '役職' => 'mail3',
        '個人名' => 'tantousya',
        '個人名略称' => 'mail4',
        '入力区分' => 'mail5',
        'メールアドレス' => 'mail1',
        'TEL' => 'personal_datatxt0016',
        'FAX' => 'personal_datatxt0017',
        '備考' => 'datatxt0018',
        '案内フラグ' => 'datatxt0040',
        'キーマンフラグ' => 'datatxt0041',
        '役員改選案内' => 'datatxt0042',
        '年賀状' => 'datatxt0043',
        'ユーザー様感謝会案内' => 'datatxt0044',
        '送付物フラグ４' => 'datatxt0045',
        '登録年月日' => 'created_date',
        '登録時刻' => 'created_time',
        '更新年月日' => 'edited_date',
        '更新時刻' => 'edited_time',
        //'更新時端末IP' => 'datatxt0048',
        '更新者' => 'created_by'
    ];


    public function postMethod(Request $request)
    {

        $bango = request('userId');
        $buttonMessage = ButtonMsg::read($bango);
        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $data_from_view = $request->all();
        $data_from_view_session = $request->all();
        session()->put('oldInput' . $bango, $data_from_view_session);

        //string to int conversion search, check leading zeroes, lzc=leading zero check
        $lzcKeys = ['company_cd_search_sort', 'datatxt0049_search_sort', 'office_cd_search_sort'];
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

        if (!empty($data_from_view['torihikisakibango']) || \request('officeId')) {
            $officeId = $data_from_view['torihikisakibango'] ?? \request('officeId');
        } else {
            $officeId = null;
        }

        if (!empty($data_from_view['Button']) && $data_from_view['Button'] == 'refresh') {
            $officeId = null;
        }

        $headers = Personal::headers($bango);
        $table_headers = Personal::headers($bango, 'table_headers');

        $page_no = Personal::$page_no;
        $route = 'personalMasterTableSetting';
        $redirect_path = 'personalReload';
        $color = '0803入力区分';
        $color1 = '0803案内停止フラグ';
        $color2 = '0803キーマンフラグ';
        $color3 = '0803役員改選案内';
        $color4 = '0803年賀状';
        $color5 = '0803ユーザー会案内';
        $color6 = '0803送付物フラグ４';
        if ($officeId) {
            $companyId = QueryHelper::fetchSingleResult("select * from haisou where bango = $officeId")->shikibetsucode ?? null;
            $kokyaku1s = QueryHelper::select(['*'])->from("kokyaku1")->where("denpyosaiban = 0")->where("yobi12 is not null")->where("yobi12 = '$companyId' ")->orderBy("yobi12 asc")->get()->execute();
            $haisous = QueryHelper::select(['*'])->from("haisou")->where("kounyusu = 0")->where("bango = $officeId")->orderBy("bango asc")->get()->execute();
        } else {
            $kokyaku1s = QueryHelper::select(['*'])->from("kokyaku1")->where("denpyosaiban = 0")->where("yobi12 is not null")->orderBy("yobi12 asc")->get()->execute();
            $haisous = QueryHelper::select(['*'])->from("haisou")->where("kounyusu = 0")->orderBy("bango asc")->get()->execute();
        }


        $requestColors = QueryHelper::select(['*'])->from('request')->where(" color = '$color'")->orderBy("bango asc")->get()->execute();
        $requestColor1s = QueryHelper::select(['*'])->from('request')->where(" color = '$color1'")->orderBy("bango asc")->get()->execute();
        $requestColor2s = QueryHelper::select(['*'])->from('request')->where(" color = '$color2'")->orderBy("bango asc")->get()->execute();
        $requestColor3s = QueryHelper::select(['*'])->from('request')->where(" color = '$color3'")->orderBy("bango asc")->get()->execute();
        $requestColor4s = QueryHelper::select(['*'])->from('request')->where(" color = '$color4'")->orderBy("bango asc")->get()->execute();
        $requestColor5s = QueryHelper::select(['*'])->from('request')->where(" color = '$color5'")->orderBy("bango asc")->get()->execute();
        $requestColor6s = QueryHelper::select(['*'])->from('request')->where(" color = '$color6'")->orderBy("bango asc")->get()->execute();
        if (!empty($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls')) {
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId','officeId', 'chkboxinp'];
            $query = AllPersonal::data($bango, $deleted_item, $officeId);
            $temp_table = 'personal_temp';
            try {
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort') {
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);
                    $etsuransyas = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    if ($etsuransyas->items() == null && $etsuransyas->currentPage() != 1) {
                        $currentPage = ($etsuransyas->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $etsuransyas = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);

                    }
                    if ($etsuransyas->total() == 0) {
                        $exceedEtsuransyas = '該当するデータがありません。';
                    } else {
                        $exceedEtsuransyas = '';
                    }
                } else if ($data_from_view['Button'] == 'xls') {
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);
                    $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                    $headers = $this->headers;
                    $excelName = '個人マスタ.xlsx';
                    return $this->excelDownload($headers, $searched, $excelName);
                }
            } catch (\Exception $e) {

                $exceedEtsuransyas = '検索形式が間違っています。';
                $etsuransyas = QueryHelper::fetchResult($query);
                $etsuransyas = collect($etsuransyas)->paginate($pagination);
            }
            return view('master.personal_master.main', compact('bango', 'tantousya', 'headers', 'page_no', 'table_headers', 'route', 'redirect_path', 'etsuransyas', 'request', 'kokyaku1s', 'haisous', 'requestColors', 'requestColor1s', 'requestColor2s', 'requestColor3s', 'requestColor4s', 'requestColor5s', 'requestColor6s', 'deleted_item', 'officeId', 'buttonMessage', 'exceedEtsuransyas'));
        }
        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;

        if (request('personal_master_id')) {
            $personalMasterId = request('personal_master_id');
            $query = AllPersonal::data($bango, $deleted_item, $officeId);
            $query .= " and bango = $personalMasterId";
        } else {
            $query = AllPersonal::data($bango, $deleted_item, $officeId);
        }
        $etsuransyas = QueryHelper::fetchResult($query);
        $etsuransyas = collect($etsuransyas)->paginate($pagi);
        session()->forget('oldInput' . $bango);
        return view('master.personal_master.main', compact('bango', 'tantousya', 'headers', 'page_no', 'table_headers', 'route', 'redirect_path', 'etsuransyas', 'request', 'kokyaku1s', 'haisous', 'requestColors', 'requestColor1s', 'requestColor2s', 'requestColor3s', 'requestColor4s', 'requestColor5s', 'requestColor6s', 'deleted_item', 'pagi', 'officeId', 'buttonMessage'));
    }

    public function postEditPersonalDetail(Request $request, $bango)
    {

        if (request('type') == 'create') {

            $insert = Personal::create(request()->all(), $bango, $this->headers,request('validate_only'));

            if (is_array($insert) && $insert['status'] == 'ok') {
                return $insert;
            } else {
                $errors = $insert->all();
                return ['err_field' => $insert, 'err_msg' => $errors];
            }
        } elseif (request('type') == 'edit') {
            $insert = Personal::edit(request()->all(), $bango, $this->headers,request('validate_only'));

            if (is_array($insert) && $insert['status'] == 'ok') {
                return $insert;
            } else {
                $errors = $insert->all();
                return ['err_field' => $insert, 'err_msg' => $errors];
            }
        }
    }

    public function personalDetail($bango)
    {
        $id = \request('id');
        $query = AllPersonal::data($bango);
        $query .= " where bango = $id";
        $data['etsuransya'] = QueryHelper::fetchSingleResult($query);
        return $data;
    }

    public function changeSerial($bango)
    {
        $id = \request('id');
        if ($id == '') {
            return null;
        } else {
            //$serial = etsuransya::where('deleteflag', 0)->where('datanum0018', $id)->get()->count() + 1
            $id = explode('-', $id)[0];
            $query = "select count(*) from etsuransya where datanum0018 = $id";
            $serial = QueryHelper::fetchResult($query)[0]->count ?? 0;
            $serial += 1;
            $serial = sprintf('%03d', $serial);
            return $serial;
        }

    }

    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = Personal::$page_no;
        return $Setting = TableSetting::setting($this->headers, $id, $pageNo);

    }

    public function tableSettingSave(Request $request, $id, $type = null)
    {

        $pageNo = Personal::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '個人マスタ', $type);
    }

    public function deletePersonalDetail($bango, $type = null)
    {
        $tantousha = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $bangoName = $tantousha->name ?? null;
        $id = \request('id');
        $query = AllPersonal::data($bango);
        $query .= " where bango = $id";
        $deleteBefore = QueryHelper::fetchSingleResult($query);
        $condition = ['bango' => $id];
        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 個人マスタ start\n";
        QueryHandler::logger($bango, $log_data);
        if ($type == 1) {
            $updateData = [
                'deleteflag' => 0,
                'datatxt0047' => Personal::getCurrentTime(),
                'yukokigen' => $bango,
               // 'datatxt0048' => Helper::getSystemIP()
            ];
            QueryHelper::updateData('etsuransya', $updateData, $condition, $bango, __CLASS__, __FUNCTION__, __LINE__);
        } else {

            $updateData = [
                'deleteflag' => 1,
                'datatxt0047' => Personal::getCurrentTime(),
                'yukokigen' => $bango,
              //  'datatxt0048' => Helper::getSystemIP()
            ];
            QueryHelper::updateData('etsuransya', $updateData, $condition, $bango, __CLASS__, __FUNCTION__, __LINE__);
        }
        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 個人マスタ end\n";
        QueryHandler::logger($bango, $log_data);
        $query = AllPersonal::data($bango);
        $query .= " where bango = $id";
        $deleteAfter = QueryHelper::fetchSingleResult($query);
        $headers = $this->headers;
        $headers['データ有効区分'] = 'deleteflag';
        if ($type == 1) {
            CSVLogger::putData('personalMaster.csv', 'etsuransya', $deleteBefore, $deleteAfter, $bangoName, $headers, 3);
        } else {
            CSVLogger::putData('personalMaster.csv', 'etsuransya', $deleteBefore, $deleteAfter, $bangoName, $headers, 0);
        }
        return 'ok';
    }

    public function getKokyakuWiseHaisou($bango)
    {
        $id = request('id');
        $officeBango = \request('officeBango');
        //$haisous = haisou::where('kounyusu', 0)->whereNotNull('kokyakubango')->where('kokyakubango', $id)->orderBy('bango', 'asc')->get();
        if ($officeBango) {
            $query = "select * from haisou where kounyusu = 0 and kokyakubango = $id and bango = $officeBango and kokyakubango is not null order by bango";
        } else {
            $query = "select * from haisou where kounyusu = 0 and kokyakubango = $id and kokyakubango is not null order by bango";
        }

        $haisous = QueryHelper::fetchResult($query);
        $html = "";
        if (count($haisous)) {
            foreach ($haisous as $haisou) {
                $html .= "<option value=" . $haisou->torihikisakibango . "-" . $haisou->bango . ">" . $haisou->torihikisakibango . " " . $haisou->name . "</option>";
            }
        } else {
            $html .= "<option value=''></option>";
        }
        return $html;

    }

}
