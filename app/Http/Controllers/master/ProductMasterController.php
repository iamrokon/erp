<?php

namespace App\Http\Controllers\master;
use App\AllClass\master\nameMaster\allCategorykanri;
use Illuminate\Http\Request;
use App\tantousya;
use App\kengen;
use App\requestTable;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\master\productMaster\createProductMaster;
use App\AllClass\master\employeeMaster\ButtonMsg;
use App\AllClass\master\productMaster\productHeaders;
use App\AllClass\master\productMaster\editProduct;
use App\AllClass\SearchClass;
use App\AllClass\SortClass;
use Illuminate\Pagination\Paginator;
use App\AllClass\master\excelDownload;
use App\AllClass\master\productMaster\allProduct;
use App\syouhin1;
use App\syouhin2;
use App\kokyaku1;
use App\haisou;
use App\etsuransya;
use App\AllClass\TableSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Excel;
use App\AllClass\master\ExcelReportDownload;
use Carbon\Carbon;
use App\AllClass\master\csvRecordRetrieve;
use App\AllClass\master\csvRecordDelete;
use App\AllClass\master\CSVLogger;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use App\Helpers\Helper;

class ProductMasterController extends Controller
{
    private $headers = [
        '商品CD' => 'product_kokyakusyouhinbango',
            '商品名' => 'name',
            '品目群' => 'jouhou_detail',
            '製品区分' => 'koyuujouhou_detail',
            '品目区分' => 'color_detail',
            '販売形態' => 'bumon_detail',
            'バージョン' => 'jouhou2_detail',
            '保守区分' => 'data21',
            '継続区分' => 'tokuchou',
            '新規VUP区分' => 'data22',
            'サブ区分' => 'data23',
            '商品名略称' => 'size',
            '入力区分1' => 'data24',
            '仕入先CD' => 'product_season',
            '基本販売価格' => 'formatted_kakaku',
            'PB販売価格' => 'formatted_hanbaisu',
            '営業粗利' => 'formatted_jyougensu',
            'PB営業粗利' => 'formatted_kakaku_yoyaku',
            '仕入価格' => 'formatted_yoyakusu',
            '仕切(SE)' => 'formatted_yoyakukanousu',
            '仕切(研究所)' => 'formatted_sortbango',
            '仕切(出荷センター)' => 'formatted_dataint01',
            '入力区分2' => 'data25',
            '製品仕入品区分' => 'data52_detail',
            '事業分類' => 'data53_detail',
            '保守サブスク区分' => 'data54_detail',
            '商品分類3' => 'data100_detail',
            'ﾎﾞﾘｭｰﾑﾗｲｾﾝｽ区分' => 'data50',
            'ﾊﾞｰｼﾞｮﾝｱｯﾌﾟ区分' => 'data51',
            '上市開始日' => 'synchrosyouhinbango_detail',
            '終売日' => 'endtime_detail',
            '最新ﾊﾞｰｼﾞｮﾝ区分' => 'data26_detail',
            '前受請求区分' => 'data27',
            '請求課税区分' => 'data28_detail',
            '販売可能' => 'data29_detail',
            '単価区分' => 'data101_detail',
            '保守作成区分' => 'url_detail',
            '受注先限定' => 'product_data20',
            '保守商品CD' => 'url_mobile_detail',
            'セット商品上位CD' => 'product_chardata4',
            'メーカー品番' => 'product_kongouritsu',
            'メーカー品名' => 'mdjouhou',
            '価格設定区分' => 'meker',
            '単位' => 'konpoumei',
            '保守会社CD' => 'product_data104',
            '内訳製品粗利比率' => 'dspbango_detail',
            'UIS対象商品' => 's4_color_detail',
            '納品方法' => 's4_size_detail',
            '予備4' => 'syouhingroup_detail',
            '予備5' => 'ruijihinbango_detail',
            '予備6' => 'chardata1_detail',
            '予備7' => 'chardata2_detail',
            '登録年月日' => 'created_date',
            '登録時刻' => 'created_time',
            '更新年月日' => 'edited_date',
            '更新時刻' => 'edited_time',
           // '更新時端末IP' => 'code3',
            '更新者' => 'user_name'
    ];


    public function postProductMaster(Request $request)
    {
        $bango = request('userId');

        $data_from_view = $request->all();
        $data_from_view_session = $request->all();
        session()->put('oldInput' . $bango, $data_from_view);

        //string to int conversion search, check leading zeroes, lzc=leading zero check
        $lzcKeys = ['kokyakusyouhinbango_search_sort','chardata4_search_sort','season_search_sort','data104_search_sort'];
        $data_from_view = $this->stringToIntSearch($data_from_view, $lzcKeys);

        $tantousya = tantousya::find($bango);
        $buttonMessage = ButtonMsg::read($bango);

        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 20;
        }

        //$popUpData['kokyaku1'] = kokyaku1::where('denpyosaiban', 0)->orderBy('yobi12', 'ASC')->get();
        $popUpData['kokyaku1'] = QueryHelper::select(['*'])->from('kokyaku1')->where("denpyosaiban = 0")->orderBy("yobi12 asc")->get()->execute();

        if (!empty($data_from_view['chkboxinp'])) {
            $deleted_item = $data_from_view['chkboxinp'];
        } else {
            $deleted_item = 0;
        }

        $headers = productHeaders::headers($bango);
        $table_headers = productHeaders::headers($bango, 'table_headers');
        $page_no = productHeaders::$page_no;
        $route = 'productMasterTableSetting';
        $redirect_path = 'productMasterReload';
        $syouhin1Info = QueryHelper::select(['*'])->from('syouhin1')->where("data21 = '2 保守'")->orderBy('kokyakusyouhinbango ASC')->get()->execute();
        $kheInfo = QueryHelper::select(['kokyaku1.*', 'kokyaku1.name as kokyaku1name', 'haisou.*', 'haisou.name as haisouname', 'haisou.torihikisakibango as haisoutorihikisakibango', 'etsuransya.*'])->from('kokyaku1 join haisou on kokyaku1.bango = haisou.kokyakubango join etsuransya on kokyaku1.bango = etsuransya.kokyakubango')->get()->execute();

        $jouhouSortOrder = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'C4'")->where('suchi1 != NULL')->where('suchi2 = 0')->get()->execute();
        if (count($jouhouSortOrder) > 0) {
            $jouhou = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'C4'")->where('suchi2 = 0')->orderBy('suchi1 ASC')->get()->execute();
        } else {
            $jouhou = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'C4'")->where('suchi2 = 0')->orderBy('category2 ASC')->get()->execute();
        }

        $koyuujouhouSortOrder = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'C5'")->where('suchi2 = 0')->where('suchi1 != NULL')->get()->execute();
        $categoryValue = $jouhou[0]->category2 ?? null;
        if (count($koyuujouhouSortOrder) > 0) {
            $koyuujouhou = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'C5'")->where("substring (category2,1,2) = '$categoryValue'")->where('suchi2 = 0')->orderBy('suchi1 ASC')->get()->execute();
        } else {
            $koyuujouhou = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'C5'")->where("substring (category2,1,2) = '$categoryValue'")->where('suchi2 = 0')->orderBy('category2 ASC')->get()->execute();
        }

        $colorSortOrder = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'C6'")->where('suchi2 = 0')->where('suchi1 != NULL')->get()->execute();
        $categoryValue2 = $koyuujouhou[0]->category2 ?? null;
        if (count($colorSortOrder) > 0) {
            $color = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'C6'")->where("substring (category2,1,4) = '$categoryValue2'")->where('suchi2 = 0')->orderBy('suchi1 ASC')->get()->execute();
        } else {
            $color = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'C6'")->where("substring (category2,1,4) = '$categoryValue2'")->where('suchi2 = 0')->orderBy('category2 ASC')->get()->execute();
        }

        $data52SortOrder = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'C7'")->where('suchi2 = 0')->where('suchi1 != NULL')->get()->execute();
        if (count($data52SortOrder) > 0) {
            $data52 = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'C7'")->where('suchi2 = 0')->orderBy('suchi1 ASC')->get()->execute();
        } else {
            $data52 = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'C7'")->where('suchi2 = 0')->orderBy('category2 ASC')->get()->execute();
        }

        $data53SortOrder = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'C8'")->where('suchi2 = 0')->where('suchi1 != NULL')->get()->execute();
        if (count($data53SortOrder) > 0) {
            $data53 = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'C8'")->where('suchi2 = 0')->orderBy('suchi1 ASC')->get()->execute();
        } else {
            $data53 = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'C8'")->where('suchi2 = 0')->orderBy('category2 ASC')->get()->execute();
        }

        $data54SortOrder = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'C9'")->where('suchi2 = 0')->where('suchi1 != NULL')->get()->execute();
        if (count($data54SortOrder) > 0) {
            $data54 = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'C9'")->where('suchi2 = 0')->orderBy('suchi1 ASC')->get()->execute();
        } else {
            $data54 = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'C9'")->where('suchi2 = 0')->orderBy('category2 ASC')->get()->execute();
        }

        $data100SortOrder = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'D1'")->where('suchi2 = 0')->where('suchi1 != NULL')->get()->execute();
        if (count($data100SortOrder) > 0) {
            $data100 = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'D1'")->where('suchi2 = 0')->orderBy('suchi1 ASC')->get()->execute();
        } else {
            $data100 = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'D1'")->where('suchi2 = 0')->orderBy('category2 ASC')->get()->execute();
        }

        $bumonSortOrder = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'E7'")->where('suchi2 = 0')->where('suchi1 != NULL')->get()->execute();
        if (count($bumonSortOrder) > 0) {
            $bumon = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'E7'")->where('suchi2 = 0')->where("substring(category2,1,2) = '$categoryValue'")->orderBy('suchi1 ASC')->get()->execute();
        } else {
            $bumon = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'E7'")->where('suchi2 = 0')->where("substring(category2,1,2) = '$categoryValue'")->orderBy('category2 ASC')->get()->execute();
        }


        $yoyakuSortOrder = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'E6'")->where('suchi2 = 0')->where('suchi1 != NULL')->get()->execute();
        if (count($yoyakuSortOrder) > 0) {
            $yoyaku = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'E6'")->where('suchi2 = 0')->where("substring(category2,1,2) = '$categoryValue'")->orderBy('suchi1 ASC')->get()->execute();
        } else {
            $yoyaku = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'E6'")->where('suchi2 = 0')->where("substring(category2,1,2) = '$categoryValue'")->orderBy('category2 ASC')->get()->execute();
        }


        $request_data21 = QueryHelper::select(['*'])->from('request')->where("color = '0804保守区分'")->get()->execute();
        $request_tokuchou = QueryHelper::select(['*'])->from('request')->where("color = '0804継続区分'")->get()->execute();

        $data101SortOrder = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'D5'")->where('suchi2 = 0')->where('suchi1 != NULL')->get()->execute();
        if (count($yoyakuSortOrder) > 0) {
            $data101 = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'D5'")->where('suchi2 = 0')->orderBy('suchi1 ASC')->get()->execute();
        } else {
            $data101 = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'D5'")->where('suchi2 = 0')->orderBy('category2 ASC')->get()->execute();
        }

        $request_data22 = QueryHelper::select(['*'])->from('request')->where("color = '0804新規VUP区分'")->get()->execute();
        $request_data23 = QueryHelper::select(['*'])->from('request')->where("color = '0804サブ区分'")->get()->execute();
        $request_data24 = QueryHelper::select(['*'])->from('request')->where("color = '0804入力区分１'")->get()->execute();
        $request_data25 = QueryHelper::select(['*'])->from('request')->where("color = '0804入力区分2'")->get()->execute();
        $request_data50 = QueryHelper::select(['*'])->from('request')->where("color = '0804ﾎﾞﾘｭｰﾑﾗｲｾﾝｽ区分'")->get()->execute();
        $request_data51 = QueryHelper::select(['*'])->from('request')->where("color = '0804ﾊﾞｰｼﾞｮﾝｱｯﾌﾟ区分'")->get()->execute();

        $data26SortOrder = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'H6'")->where('suchi2 = 0')->where('suchi1 != NULL')->get()->execute();
        if (count($data26SortOrder) > 0) {
            $data26 = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'H6'")->where('suchi2 = 0')->orderBy('suchi1 ASC')->get()->execute();
        } else {
            $data26 = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'H6'")->where('suchi2 = 0')->orderBy('category2 ASC')->get()->execute();
        }


        $request_data27 = QueryHelper::select(['*'])->from('request')->where("color = '0804前受請求区分'")->get()->execute();

        $data28SortOrder = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'B1'")->where('suchi2 = 0')->where('suchi1 != NULL')->get()->execute();
        if (count($data28SortOrder) > 0) {
            $data28 = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'B1'")->where('suchi2 = 0')->orderBy('suchi1 ASC')->get()->execute();
        } else {
            $data28 = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'B1'")->where('suchi2 = 0')->orderBy('category2 ASC')->get()->execute();
        }

        $data29SortOrder = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'F6'")->where('suchi2 = 0')->where('suchi1 != NULL')->get()->execute();
        if (count($data29SortOrder) > 0) {
            $data29 = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'F6'")->where('suchi2 = 0')->orderBy('suchi1 ASC')->get()->execute();
        } else {
            $data29 = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'F6'")->where('suchi2 = 0')->orderBy('category2 ASC')->get()->execute();
        }

        $dataUrlSortOrder = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'E9'")->where('suchi2 = 0')->where('suchi1 != NULL')->get()->execute();
        if (count($dataUrlSortOrder) > 0) {
            $url = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'E9'")->where('suchi2 = 0')->orderBy('suchi1 ASC')->get()->execute();
        } else {
            $url = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'E9'")->where('suchi2 = 0')->orderBy('category2 ASC')->get()->execute();
        }

        $request_meker = QueryHelper::select(['*'])->from('request')->where("color = '0804価格設定区分'")->get()->execute();

        $dspbangoSortOrder = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'G2'")->where('suchi2 = 0')->where('suchi1 != NULL')->get()->execute();
        if (count($dspbangoSortOrder) > 0) {
            $dspbango = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'G2'")->where('suchi2 = 0')->orderBy('suchi1 ASC')->get()->execute();
        } else {
            $dspbango = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'G2'")->where('suchi2 = 0')->orderBy('category2 ASC')->get()->execute();
        }

        $syouhin4ColorSortOrder = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'G3'")->where('suchi2 = 0')->where('suchi1 != NULL')->get()->execute();
        if (count($syouhin4ColorSortOrder) > 0) {
            $syouhin4_color = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'G3'")->where('suchi2 = 0')->orderBy('suchi1 ASC')->get()->execute();
        } else {
            $syouhin4_color = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'G3'")->where('suchi2 = 0')->orderBy('category2 ASC')->get()->execute();
        }

        $syouhin4SizeSortOrder = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'G4'")->where('suchi2 = 0')->where('suchi1 != NULL')->get()->execute();
        if (count($syouhin4SizeSortOrder) > 0) {
            $syouhin4_size = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'G4'")->where('suchi2 = 0')->orderBy('suchi1 ASC')->get()->execute();
        } else {
            $syouhin4_size = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'G4'")->where('suchi2 = 0')->orderBy('category2 ASC')->get()->execute();
        }

        $syouhingroupSortOrder = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'G5'")->where('suchi2 = 0')->where('suchi1 != NULL')->get()->execute();
        if (count($syouhingroupSortOrder) > 0) {
            $syouhingroup = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'G5'")->where('suchi2 = 0')->orderBy('suchi1 ASC')->get()->execute();
        } else {
            $syouhingroup = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'G5'")->where('suchi2 = 0')->orderBy('category2 ASC')->get()->execute();
        }

        $ruijihinbangoSortOrder = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'G6'")->where('suchi2 = 0')->where('suchi1 != NULL')->get()->execute();
        if (count($ruijihinbangoSortOrder) > 0) {
            $ruijihinbango = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'G6'")->where('suchi2 = 0')->orderBy('suchi1 ASC')->get()->execute();
        } else {
            $ruijihinbango = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'G6'")->where('suchi2 = 0')->orderBy('category2 ASC')->get()->execute();
        }

        $chardata1SortOrder = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'G7'")->where('suchi2 = 0')->where('suchi1 != NULL')->get()->execute();
        if (count($chardata1SortOrder) > 0) {
            $chardata1 = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'G7'")->where('suchi2 = 0')->orderBy('suchi1 ASC')->get()->execute();
        } else {
            $chardata1 = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'G7'")->where('suchi2 = 0')->orderBy('category2 ASC')->get()->execute();
        }

        $chardata2SortOrder = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'G8'")->where('suchi2 = 0')->where('suchi1 != NULL')->get()->execute();
        if (count($chardata2SortOrder) > 0) {
            $chardata2 = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'G8'")->where('suchi2 = 0')->orderBy('suchi1 ASC')->get()->execute();
        } else {
            $chardata2 = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'G8'")->where('suchi2 = 0')->orderBy('category2 ASC')->get()->execute();
        }

        $authoritySortOrder = QueryHelper::select(['*'])->from('categorykanri')->where("category3 = '権限'")->where('suchi2 = 0')->where('suchi1 != NULL')->get()->execute();
        if (count($authoritySortOrder) > 0) {
            $authority = QueryHelper::select(['*'])->from('categorykanri')->where("category3 = '権限'")->where('suchi2 = 0')->orderBy('suchi1 ASC')->get()->execute();
        } else {
            $authority = QueryHelper::select(['*'])->from('categorykanri')->where("category3 = '権限'")->where('suchi2 = 0')->orderBy('category2 ASC')->get()->execute();
        }


        $temp_table = 'product_temp';
        //show page start here
        if (isset($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls')) {
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp'];
            $query = allProduct::data($bango, $deleted_item)->toSql();

            try {
                //modify number format fields
                $str_to_int = ['kakaku', 'hanbaisu', 'jyougensu', 'kakaku_yoyaku', 'yoyakusu', 'yoyakukanousu', 'sortbango', 'dataint01'];
                foreach ($data_from_view as $key => $value) {
                    if (in_array($key, $str_to_int)) {
                        $data_from_view[$key] = str_replace(',', '', $data_from_view[$key]);
                    }
                }
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort') {
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);
                    $productInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    if ($productInfo->items() == null && $productInfo->currentPage() != 1) {
                        $currentPage = ($productInfo->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $productInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    }
                    if ($productInfo->total() == 0) {
                        $exceedUser = '該当するデータがありません。';
                    } else {
                        $exceedUser = '';
                    }
                } else if ($data_from_view['Button'] == 'xls') {
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);
                    $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                    $headers = $this->headers;
                    $excelName = '商品マスタ.xlsx';
                    return $this->excelDownload($headers, $searched, $excelName);
                }
            } catch (\Exception $e) {
                $exceedUser = '検索形式が間違っています。';
                $productInfo = QueryHelper::fetchResult($query);
                $productInfo = collect($productInfo)->paginate($pagination);
                return view('master.productMaster.mainProductMaster', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'productInfo', 'kheInfo', 'syouhin1Info', 'jouhou', 'koyuujouhou', 'color', 'data52', 'data53', 'data54', 'data100', 'data101', 'bumon', 'yoyaku', 'request_data21', 'request_tokuchou', 'request_meker', 'request_data22', 'request_data23', 'request_data24', 'request_data25', 'request_data50', 'request_data51', 'data26', 'request_data27', 'data28', 'data29', 'dspbango', 'syouhin4_color', 'syouhin4_size', 'syouhingroup', 'ruijihinbango', 'chardata1', 'chardata2', 'url', 'tantousya', 'deleted_item', 'exceedUser', 'popUpData', 'buttonMessage'));
            }

            return view('master.productMaster.mainProductMaster', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'productInfo', 'kheInfo', 'syouhin1Info', 'jouhou', 'koyuujouhou', 'color', 'data52', 'data53', 'data54', 'data100', 'data101', 'bumon', 'yoyaku', 'request_data21', 'request_tokuchou', 'request_meker', 'request_data22', 'request_data23', 'request_data24', 'request_data25', 'request_data50', 'request_data51', 'data26', 'request_data27', 'data28', 'data29', 'dspbango', 'syouhin4_color', 'syouhin4_size', 'syouhingroup', 'ruijihinbango', 'chardata1', 'chardata2', 'url', 'tantousya', 'deleted_item', 'exceedUser', 'popUpData', 'buttonMessage'));
        }

        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;
        if (request('change_id')) {
            $query = allProduct::data($bango, $deleted_item)->whereRaw("bango = '" . request('change_id') . "'")->toSql();
        } else {
            $query = allProduct::data($bango, $deleted_item)->toSql();
        }
        $productInfo = QueryHelper::fetchResult($query);
        $productInfo = collect($productInfo)->paginate($pagi);
        session()->forget('oldInput' . $bango);
        return view('master.productMaster.mainProductMaster', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'productInfo', 'kheInfo', 'syouhin1Info', 'jouhou', 'koyuujouhou', 'color', 'data52', 'data53', 'data54', 'data100', 'data101', 'bumon', 'yoyaku', 'request_data21', 'request_tokuchou', 'request_meker', 'request_data22', 'request_data23', 'request_data24', 'request_data25', 'request_data50', 'request_data51', 'data26', 'request_data27', 'data28', 'data29', 'dspbango', 'syouhin4_color', 'syouhin4_size', 'syouhingroup', 'ruijihinbango', 'chardata1', 'chardata2', 'url', 'tantousya', 'pagi', 'deleted_item', 'popUpData', 'buttonMessage'));

    }

    public function postEditProductMaster(Request $request, $bango)
    {
        //create & edit start here
        if (request('type') == 'create') {
            $insert = createProductMaster::create($request->all(), $bango, $this->headers);
            if (is_array($insert) && $insert['status'] == 'ok') {
                $product_info = QueryHelper::select(['*'])->from('syouhin1')->orderBy('bango desc')->get()->first();
                $last_inserted_bango = $product_info->kokyakusyouhinbango;
                Session::flash('success_msg', '商品CD　' . $last_inserted_bango . ' 登録 完了しました。');
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
            $insert = editProduct::edit($request->all(), $bango, $this->headers);
            if (is_array($insert) && $insert['status'] == 'ok') {
                $product_info_bango = $request['kokyakusyouhinbango'];
                Session::flash('success_msg', '商品CD ' . $product_info_bango . ' 変更完了しました。');
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

    public function productMasterDetail(Request $request, $bango)
    {
        $id = $request['id'];
        $product = allProduct::data($bango)->whereRaw("bango ='" . $id . "'")->toSql();
        $product = collect(QueryHelper::fetchSingleResult($product))->toArray();
       
        $categoryValue = substr($product['jouhou'],2,2) ?? null;
        $koyuujouhou = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'C5'")->where("substring (category2,1,2) = '$categoryValue'")->where('suchi2 = 0')->orderBy('suchi1 ASC')->get()->execute();
        //$categoryValue2 = $koyuujouhou[0]->category2 ?? null;
        $categoryValue2 = substr($product['koyuujouhou'],2,4) ?? null;
        $color = QueryHelper::select(['*'])->from('categorykanri')->where("category1 = 'C6'")->where("substring (category2,1,4) = '$categoryValue2'")->where('suchi2 = 0')->orderBy('suchi1 ASC')->get()->execute();
       
        //$koyuujouhou_html = '<option data-categoryType="null" data-categoryValue="null"  value="">-</option>';
        $koyuujouhou_html = '';
        foreach ($koyuujouhou as $category) {
            $koyuujouhou_html .= "<option data-categoryType=" . $category->category1 . " data-categoryValue=" . $category->category2 . " value=" . $category->category1 . $category->category2 . ">" . $category->category1 . $category->category2 . " " . $category->category4 . "</option>";
        }
        
        //$color_html = '<option data-categoryType="null" data-categoryValue="null"  value="">-</option>';
        $color_html = '';
        foreach ($color as $temp_category) {
            $color_html .= "<option data-categoryType=" . $temp_category->category1 . " data-categoryValue=" . $temp_category->category2 . " value=" . $temp_category->category1 . $temp_category->category2 . ">" . $temp_category->category1 . $temp_category->category2 . " " . $temp_category->category4 . "</option>";
        }
        
        //$data = response()->json($product);
        return ['data'=>$product,'koyuujouhou_html'=>$koyuujouhou_html,'color_html'=>$color_html];
    }

    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = productHeaders::$page_no;
        return $Setting = TableSetting::setting($this->headers, $id, $pageNo);

    }

    public function tableSettingSave(Request $request, $id, $type = null)
    {
        $pageNo = productHeaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '商品マスタ', $type);
    }


    public function deleteOrReturnProduct(Request $request, $bango, $type = null)
    {
        $bangoName = tantousya::find($bango)->name;

        $id = $request->all();
        $kesuId = array_keys($id)[0];

        $mytime = Carbon::now()->toDateTimeString();
        $mytime = str_replace(":", "", $mytime);
        $mytime = str_replace("-", "", $mytime);
        $mytime = str_replace(" ", "", $mytime);

        $query = allProduct::data($bango)->whereRaw("bango ='" . $kesuId . "'")->toSql();
        $deleteBefore = QueryHelper::fetchSingleResult($query);

        //start log query
        $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 商品マスタ start\n";
        QueryHandler::logger($bango,$log_data);

        if ($type == 1) {
            $update_data = [
               'bango' => $kesuId,
               'isuriage' => 0,
           //    'code3' => Helper::getSystemIP(),
               'code2' => $mytime,
            ];
            QueryHelper::updateData('syouhin1',$update_data,'bango',$bango,__CLASS__,__FUNCTION__,__LINE__);
        } else {

            $update_data = [
               'bango' => $kesuId,
               'isuriage' => 1,
               'code2' => $mytime,
            ];
            QueryHelper::updateData('syouhin1',$update_data,'bango',$bango,__CLASS__,__FUNCTION__,__LINE__);
        }

        $s2_update_data = [
            'bango' => $kesuId,
            'catalogbango' => $bango,
        ];
        QueryHelper::updateData('syouhin2',$s2_update_data,'bango',$bango,__CLASS__,__FUNCTION__,__LINE__);

        //end log query
        $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 商品マスタ end\n";
        QueryHandler::logger($bango,$log_data);

        $deleteAfter = QueryHelper::fetchSingleResult($query);

        $headers = $this->headers;
        $headers['データ有効区分'] = 'isuriage';
        if ($type == 1) {
            CSVLogger::putData('productMaster.csv', 'syouhin1', $deleteBefore, $deleteAfter, $bangoName, $headers, 3);
        } else {
            CSVLogger::putData('productMaster.csv', 'syouhin1', $deleteBefore, $deleteAfter, $bangoName, $headers, 0);
        }
        return 'ok';
    }


    public function categoryWiseCategory($bango)
    {
        $categoryType = request('category_type') ? trim(\request('category_type')) : null;
        $categoryValue = request('category_value') ? trim(\request('category_value')) : null;
        $type = request('type');
        $currentCategory = '';
        $length = null;

        if ($categoryType == 'C4' || $type == "C4") {
            $currentCategory = request('currentCategory') ? request('currentCategory') : "";
            if ($categoryType != "") {
                //$categories = DB::table('categorykanri')->where('category1', $currentCategory)->where('suchi2', 0)->whereRaw('substring(category2,1,2) = ?', $categoryValue)->get();
                $categories = QueryHelper::fetchResult("select * from categorykanri where category1 = '$currentCategory' and suchi2 = 0 and substring (category2,1,2) = '$categoryValue'");
            } else {
                $categories = QueryHelper::fetchResult("select * from categorykanri where category1 = '$currentCategory' and suchi2 = 0");
            }

        } else if ($categoryType == 'C5' || $type == "C5") {
            $currentCategory = 'C6';
            if ($categoryType != "") {
                //$categories = DB::table('categorykanri')->where('category1', $currentCategory)->where('suchi2', 0)->whereRaw('substring(category2,1,4) = ?', $categoryValue)->get();
                $categories = QueryHelper::fetchResult("select * from categorykanri where category1 = '$currentCategory' and suchi2 = 0 and substring (category2,1,4) = '$categoryValue'");
            } else {
                $categories = QueryHelper::fetchResult("select * from categorykanri where category1 = '$currentCategory' and suchi2 = 0");
            }
        }

        if(request('currentCategory') == 'E6' || request('currentCategory') == 'E7'){
            $html = '<option data-categoryType="null" data-categoryValue="null"  value="">-</option>';
        }else{
           $html = ''; 
        }
        
        if (isset($categories)) {
            foreach ($categories as $category) {
                $html .= "<option data-categoryType=" . $category->category1 . " data-categoryValue=" . $category->category2 . " value=" . $category->category1 . $category->category2 . ">" . $category->category1 . $category->category2 . " " . $category->category4 . "</option>";
                //$html .= "<option data-categoryType=" . $category->category1 . " data-categoryValue=" . $category->category2 . " value=" . $category->category1 . $category->category2 . ">" . $category->category2 . " " . $category->category4 . "</option>";
            }
            return $html;
        } else {
            return $html;
        }

    }


    public function getSyouhinName($bango)
    {
        $kokyakusyouhinbango = request('kokyakusyouhinbango') ? trim(\request('kokyakusyouhinbango')) : null;
        $syouhinInfo = QueryHelper::select(['name'])->from('syouhin1')->where("kokyakusyouhinbango = '$kokyakusyouhinbango' ")->get()->first();

        return response()->json($syouhinInfo);
    }


}
