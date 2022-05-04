<?php
namespace App\Http\Controllers\master;

use App\AllClass\db\QueryHandler;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\master\CSVLogger;
use App\AllClass\master\employeeMaster\ButtonMsg;
use App\AllClass\master\productDescription\AllProductDescription;
use App\AllClass\master\productDescription\ProductDescription;
use App\AllClass\TableSetting;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

class ProductDescriptionController extends Controller
{
    public $headers = [
        '商品説明CD区分' => 'url',
        '商品説明CD' => 'product_des_urlsm',
        '商品名' => 'shohin1_name',
        '見積明細備考' => 'mbcatch',
        'サービス内容' => 'setumei',
        '工数目安' => 'catch',
        '成果物' => 'caption',
        '社内備考' => 'catchsm',
        '販売時留意点' => 'mbcatchsm',
        '商品説明PDF' => 'mbcaption',
        '補足説明' => 'supplementary_explanation',
        '入力区分' => 'datatxt0096',
        '登録年月日' => 'created_date',
        '登録時刻' => 'created_time',
        '更新年月日' => 'edited_date',
        '更新時刻' => 'edited_time',
      //  '更新時端末IP' => 'ip_address',
        '更新者' => 'created_by'
    ];


    public function postMethod(Request $request)
    {
      //  QueryHelper::runQuery("DELETE FROM kengensettei  WHERE kengenchar01 = 'col' and kengenchar05 = '08-15'");
        $bango = request('userId');

        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $requests = QueryHelper::select(['*'])->from('request')->where(" color = '0815入力区分'")->orderBy("bango asc")->get()->execute();
        $data_from_view=$request->all();
        $data_from_view_session=$request->all();
        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;
        session()->put('oldInput'.$bango,$data_from_view_session);
        //string to int conversion search, check leading zeroes, lzc=leading zero check
        $lzcKeys = ['urlsm_search_sort'];
        $data_from_view = $this->stringToIntSearch($data_from_view, $lzcKeys);
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
        $headers = ProductDescription::headers($bango);
        $table_headers = ProductDescription::headers($bango, 'table_headers');
        $page_no = ProductDescription::$page_no;
        $route = 'productDescriptionTableSetting';
        $redirect_path = 'productDescriptionReload';

        if (!empty($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls')) {
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp'];
            $query = AllProductDescription::data($bango, $deleted_item);
            $temp_table = 'product_desc_temp';
            try {
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort') {
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);
                    $gazous = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    if ($gazous->items() == null && $gazous->currentPage() != 1) {
                        $currentPage = ($gazous->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $gazous = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);

                    }
                    if ($gazous->total() == 0) {
                        $exceedgazous = '該当するデータがありません。';
                    } else {
                        $exceedgazous = '';
                    }
                } else if ($data_from_view['Button'] == 'xls') {
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);
                    $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                    $headers = $this->headers;
                    $excelName = '商品説明マスタ .xlsx';
                    return $this->excelDownload($headers, $searched, $excelName);
                }
            } catch (\Exception $e) {
                $exceedgazous = '検索形式が間違っています。';
                $gazous = QueryHelper::fetchResult($query);
                $gazous = collect($gazous)->paginate($pagination);
            }
            return view('master.productDesMaster.main', compact('bango', 'tantousya', 'headers', 'page_no', 'table_headers', 'route', 'redirect_path', 'gazous', 'buttonMessage', 'exceedgazous', 'pagi', 'deleted_item','requests'));
        }
        
        $exceedgazous = '';
        if (request('product_des_master_id')) {
            $productDesId = request('product_des_master_id');
            $query = AllProductDescription::data($bango, $deleted_item);
            $query .= " and  urlsm = '$productDesId' ";
        } else {
            $query = AllProductDescription::data($bango, $deleted_item);
        }
        $gazous = QueryHelper::fetchResult($query);
        $gazous = collect($gazous)->paginate($pagi);

        session()->forget('oldInput' . $bango);
        return view('master.productDesMaster.main', compact('bango', 'tantousya', 'headers', 'page_no', 'table_headers', 'route', 'redirect_path', 'gazous', 'buttonMessage', 'exceedgazous', 'pagi', 'deleted_item','requests'));

    }


    public function postEditPersonalDetail(Request $request, $bango)
    {
        $file = $request->file('mbcaption');
        if (request('type') == 'create') {
            $insert = ProductDescription::create($request->all(), $bango, $file, $this->headers,request('validate_only'));
            if (is_array($insert) && $insert['status'] == 'ok') {
                return $insert;
            } else {
                $errors = $insert->all();
                return ['err_field' => $insert, 'err_msg' => $errors];
            }
        } elseif (request('type') == 'edit') {
            $insert = ProductDescription::edit($request->all(), $bango, $file, $this->headers,request('validate_only'));

            if (is_array($insert) && $insert['status'] == 'ok') {
                return $insert;
            } else {
                $errors = $insert->all();
                return ['err_field' => $insert, 'err_msg' => $errors];
            }
        }
    }

    public function productDesDetail($bango)
    {
        $id = \request('id');
        $query = AllProductDescription::data($bango);
        $query .= " where urlsm = '$id'";
        $data['gazou'] = QueryHelper::fetchSingleResult($query);
        return $data;
    }


    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = ProductDescription::$page_no;
        return $Setting = TableSetting::setting($this->headers, $id, $pageNo);

    }

    public function tableSettingSave(Request $request, $id, $type = null)
    {

        $pageNo = ProductDescription::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '商品説明マスタ', $type);
    }

    public function deleteProductDescriptionDetail($bango, $type = null)
    {

        $tantousha = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $bangoName = $tantousha->name ?? null;
        $id = \request('id');
        $query = AllProductDescription::data($bango);
        $query .= " where urlsm = '$id'";
        $deleteBefore = QueryHelper::fetchSingleResult($query);
        $condition = ['urlsm' => $id];
        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 会社マスタ start\n";
        QueryHandler::logger($bango, $log_data);
        if ($type == 1) {
            $updateData = [
                'hyouji' => 0,
                'datatxt0099' => trim(ProductDescription::getCurrentTime()),
             // 'datatxt0100' => Helper::getSystemIP(),
                'datatxt0101' => $bango,
            ];
            QueryHelper::updateData('gazou', $updateData, $condition, $bango, __CLASS__, __FUNCTION__, __LINE__);
        } else {
            $updateData = [
                'hyouji' => 1,
                'datatxt0099' => trim(ProductDescription::getCurrentTime()),
             // 'datatxt0100' => Helper::getSystemIP(),
                'datatxt0101' => $bango,
            ];
            QueryHelper::updateData('gazou', $updateData, $condition, $bango, __CLASS__, __FUNCTION__, __LINE__);
        }
        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 会社マスタ end\n";
        QueryHandler::logger($bango, $log_data);
        $query = AllProductDescription::data($bango);
        $query .= " where urlsm = '$id'";
        $deleteAfter = QueryHelper::fetchSingleResult($query);
        $headers = $this->headers;
        $headers['データ有効区分'] = 'hyouji';

        if ($type == 1) {
            CSVLogger::putData('productDescriptionMaster.csv', 'gazou', $deleteBefore, $deleteAfter, $bangoName, $headers, 3);
        } else {
            CSVLogger::putData('productDescriptionMaster.csv', 'gazou', $deleteBefore, $deleteAfter, $bangoName, $headers, 0);
        }
        return 'ok';
    }

    public function getBangoWiseName($bango, $type)
    {
        $value = \request('name');
        if ($type == 'syouhin1') {
            $name = QueryHelper::fetchSingleResult("select * from syouhin1 where kokyakusyouhinbango = '$value'")->name ?? null;
        } else {
            $name = QueryHelper::fetchSingleResult("select * from others where other2 = '$value'")->other21 ?? null;
        }
        return $name;
    }


}




