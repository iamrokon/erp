<?php


namespace App\Http\Controllers\sales;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\sales\DeliveryNote\AllDeliveryNote;
use App\AllClass\sales\DeliveryNote\DeliveryNote;
use App\AllClass\sales\DeliveryNote\DeliveryNoteCSVCreate;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class DeliveryNoteController extends Controller
{
    private $headers = [
        '売上番号' => 'sales_number',
        '訂正回数' => 'number_of_correction',
        '売上区分' => 'sales_category',
        '受注番号' => 'order_number',
        '売上請求先ＣＤ' => 'sales_billing_cd',
        '最終顧客ＣＤ' => 'last_customer_cd',
        '売上日' => 'sales_date',
        '即時区分' => 'immediate_classification',
        '伝票備考' => 'voucher_remark',
        '売上金額' => 'sales_amount',
        '売上消費税額' => 'consumption_tax_amount',
        '請求確定日' => 'billing_confirmation_date',
        '表示順' => 'display_order',
        '商品ＣＤ' => 'product_cd',
        '商品名' => 'product_name',
        '数量' => 'quantity',
        '単位' => 'unit',
        '売上単価' => 'unit_sales_price',
        '明細備考' => 'details_remark',
        '発行済フラグ' => 'issued_flag',
        '売上請求先会社名' => 'billing_commpany_name',
        '売上請求先事業所名' => 'office_name',
        '売上請求先部署' => 'billing_department',
        '売上請求先役職' => 'billing_position',
        '売上請求先個人名' => 'personal_name',
        '売上請求先郵便番号' => 'billing_zipcode',
        '売上請求先都道府県名' => 'billing_destination_name',
        '売上請求先市区町村名' => 'billing_city_name',
        '売上請求先町域名' => 'billing_area_name',
        '売上請求先番地・建物名' => 'billing_building_name',
        '売上請求先個人名TEL' => 'billing_tel',
        '売上請求先個人名FAX' => 'billing_fax',
        '最終顧客会社名' => 'last_customer_company_name',
        '指定納品書帳票コード' => 'delivery_code',
        '客先発注番号' => 'customer_order_number',
        '売上明細金額' => 'sales_statement_amount', // @20220211, USAC002-246
        '売上明細消費税額' => 'sales_details_consumption_tax_amount', // @20220211, USAC002-246
    ];

    public function index()
    {
        $bango = request('userId');
        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7501'");
        $review_orderbango = $reviewData->orderbango;
        $data003 = substr($tantousya->datatxt0003, 2, 4);
        $data004 = substr($tantousya->datatxt0004, 2, 5);
        $data005 = substr($tantousya->datatxt0005, 2, 6);
        $data003_left = substr($tantousya->datatxt0003, 2, 4);
        $data003_right = substr($tantousya->datatxt0003, 2, 4);
        $personal_datatxt0003 = QueryHelper::select(['category1', 'category2', 'category4'])->from('categorykanri')->where("category1 = 'B9' ")->where("category2 = '$data003' ")->get()->first();
        $personal_datatxt0004 = QueryHelper::select(['category1', 'category2', 'category4'])->from('categorykanri')->where("category1 = 'C1' ")->where("category2 = '$data004' ")->get()->first();
        $personal_datatxt0005 = QueryHelper::select(['category1', 'category2', 'category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("category2 = '$data005' ")->get()->first();
        $B9Data_left = QueryHelper::fetchResult("select *,RIGHT(category2, 2) as category2_show from categorykanri where category1 = 'B9' and (suchi2 = 0 or suchi2 is null) and left(category2, 2) ='$review_orderbango' ORDER BY category2 ASC");
        $C1Data_left = QueryHelper::select(['category1', 'category2', 'category4'])->from('categorykanri')->where("category1 = 'C1' ")->where("category2 LIKE '%$data003_left%' ")->where("left(category2, 2) ='$review_orderbango'")->get()->execute();
        $B9Data_right = QueryHelper::fetchResult("select *,RIGHT(category2, 2) as category2_show from categorykanri where category1 = 'B9' and (suchi2 = 0 or suchi2 is null) and left(category2, 2) ='$review_orderbango' ORDER BY category2 ASC");
        $C1Data_right = QueryHelper::select(['category1', 'category2', 'category4'])->from('categorykanri')->where("left(category2, 2) ='$review_orderbango'")->where("category1 = 'C1' ")->where("category2 LIKE '%$data003_right%' ")->get()->execute();
        if (isset($data_from_view['department_datachar05_start'])) {
            $data003_left = substr($data_from_view['department_datachar05_start'], 2, 5);
            $data003_right = substr($data_from_view['department_datachar05_start'], 2, 5);
        }
        if (isset($data_from_view['group_datachar05_start'])) {
            $data003_short = substr($data_from_view['group_datachar05_start'], 2, 5);
            $data003 = substr($data_from_view['group_datachar05_start'], 2, 6);
            $C2Data_left = QueryHelper::select(['category1', 'category2', 'category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_short%' ")->get()->execute();
            $C2Data_right = QueryHelper::select(['category1', 'category2', 'category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_short%' ")->where("CAST(category2 as integer) >= $data003 ")->get()->execute();
        } else {
            $C2Data_left = QueryHelper::select(['category1', 'category2', 'category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_left%' ")->get()->execute();
            $C2Data_right = QueryHelper::select(['category1', 'category2', 'category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_right%' ")->get()->execute();
        }
        $categorykanriesU5 = QueryHelper::fetchResult("select category1,category2,category4,suchi2,suchi1 from categorykanri where category1 = 'U5' and (suchi2 = 0 or suchi2 is null)  ORDER BY suchi1 ASC");
        return view('sales.deliveryNote.main', compact('bango', 'tantousya',  'categorykanriesU5', 'B9Data_left', 'C1Data_left', 'C2Data_left', 'B9Data_right', 'C1Data_right', 'C2Data_right', 'personal_datatxt0003', 'personal_datatxt0004', 'personal_datatxt0005'));
    }

    public function createCSV($bango, Request $request)
    {

        $processRequest = $request->all();
        foreach ($processRequest as $key => $value) {
            if ($key == '_token') {
                unset($processRequest[$key]);
            }
            if ($key == 'order_date_start' || $key == 'order_date_end') {
                $processRequest[$key] = Helper::replaceSpecificString($value, '/');
            }
            if (!$value) {
                $processRequest[$key] = null;
            }
        }
        $validate = DeliveryNote::validate($processRequest);
        $errors = $validate->errors();
        if ($errors->any()) {
            $result['status'] = 'error';
            $result['errors'] = $errors;
            return $result;
        } else if (!$errors->any() && $request['confirm_status'] == 0) {
            $result['status'] = 'confirm';
            return $result;
        } else if ($request['confirm_status'] == 1 && !$errors->any()) {
            try {
                $query = AllDeliveryNote::data($processRequest, $bango);
                $searched_data = QueryHelper::fetchResult($query);
                $half_width_field = ['voucher_remark', 'product_name', 'details_remark', 'billing_department', 'billing_position', 'last_customer_company_name', 'customer_order_number'];
                $converted_search_data = [];
                foreach ($searched_data as $data) {
                    foreach ($data as $k => $v) {
                        if (in_array($k, $half_width_field)) {
                            $data->$k = mb_convert_kana($v, "rnaskc");
                        } else {
                            $data->$k = $v;
                        }
                    }
                    array_push($converted_search_data, $data);
                }
                $searched_data = $converted_search_data;
                if ($searched_data) {
                    $dataCount = count($searched_data);
                    $file_name = 'denpatsu-' . $bango . '-' . substr(Helper::getCurrentTime(), 0, 8) . '.csv';
                    DeliveryNoteCSVCreate::putData($file_name, $this->headers, $searched_data);
                    $orderBangos = [];
                    foreach ($searched_data as $data) {
                        array_push($orderBangos, $data->orderhenkanbango);
                    }
                    if ($orderBangos) {
                        foreach ($orderBangos as $orderbango) {
                            $data = [
                                'dataint07' => 1
                            ];
                            QueryHelper::updateData('hikiatesyukko', $data, ['orderbango' => $orderbango], $bango, __CLASS__, __FUNCTION__, __LINE__);
                        }
                    }
                    session()->put('denpatsu-' . $bango, $file_name);
                    $result['message'] = ["CSVへ出力しました。($dataCount 件)", "対象データの指定納品書作成フラグを「1：済」に更新しました。"];
                    $result['csv_has'] = true;
                } else {
                    session()->put('denpatsu-' . $bango, '');
                    $result['message'] = "該当するデータがありません。";
                    $result['csv_has'] = false;
                }
                $result['status'] = "ok";
            } catch (\Exception $e) {
                $result['status'] = "ng";
                dd($e);
            }
            return $result;
        }
    }

    public function downloadCSV($bango)
    {
        $fileName = \session()->get('denpatsu-' . $bango);
        $file = "uploads/delivery_notes/$fileName";
        if ($fileName && file_exists($file)) {
            $file = "uploads/delivery_note/$fileName";
            static::delete7daysBeforeData($bango);
            $result['file_name'] = $fileName;
            $result['status'] = 'ok';
            $result['msg'] = 'CSVエクスポートが完了しました。';
        } else {
            $result['status'] = 'ng';
            $result['msg'] = 'ファイルがLAMUサーバに存在しません。';
        }
        return $result;
    }

    public function deleteCSV($bango)
    {
        $fileName = \session()->get('denpatsu-' . $bango);
        $file = "uploads/delivery_notes/$fileName";
        if ($fileName && file_exists($file)) {
            unlink($file);
            $result['status'] = 'ok';
            $result['msg'] = "「 $fileName 」 処理が終了しました。";
        } else {
            $result['status'] = 'ng';
            $file_name = 'denpatsu-' . $bango . '-' . substr(Helper::getCurrentTime(), 0, 8) . '.csv';
            $result['msg'] = " 「 $file_name 」ファイルがLAMUサーバに存在しません。";
        }
        return $result;
    }

    public static function filterCategoryForMultiRow(Request $request)
    {

        $filterOn = request('filterOn');
        $searchOn = substr($filterOn, 2);
        $datachar03 = substr($searchOn, 0, 4);
        $datachar04 = substr($searchOn, 0, 5);

        $categorykanri2 = QueryHelper::select(['category1,category2,category4'])->from('categorykanri')->where(" category1 = 'C1'")
            ->where(" category2::text LIKE '$searchOn%'")
            ->where("suchi2 = 0")
            ->orderBy("bango asc")
            ->get()->execute();

        //        $categoryhtml2="<option value=''>選択無し</option>\n";
        $categoryhtml2 = "";
        foreach ($categorykanri2 as $value) {
            $categoryhtml2 .= "<option value='" . $value->category1 . $value->category2 . "'>" . substr($value->category2, -1) . " " . $value->category4 . "</option>\n";
        }

        $categorykanri3 = QueryHelper::select(['category1,category2,category4'])->from('categorykanri')->where(" category1 = 'C2'")
            ->where(" category2::text LIKE '$searchOn%'")
            ->where("suchi2 = 0")
            ->orderBy("bango asc")
            ->get()->execute();

        $categoryhtml3 = "<option value=''>選択無し</option>\n";

        foreach ($categorykanri3 as $value) {
            $categoryhtml3 .= "<option value='" . $value->category1 . $value->category2 . "'>" . substr($value->category2, -1) . " " . $value->category4 . "</option>\n";
        }

        $categorykanri1 = QueryHelper::select(['category1,category2,category4'])->from('categorykanri')->where(" category1 = 'B9'")
            ->where(" category2 >= '$datachar03'")
            ->where("suchi2 = 0")
            ->orderBy("bango asc")
            ->get()->execute();

        //        $categoryhtml1_right="<option value=''>選択無し</option>\n";
        $categoryhtml1_right = "";
        foreach ($categorykanri1 as $value) {
            $categoryhtml1_right .= "<option value='" . $value->category1 . $value->category2 . "'>" . substr($value->category2, 2, 2) . " " . $value->category4 . "</option>\n";
        }

        $categorykanri2_other = QueryHelper::select(['category1,category2,category4'])->from('categorykanri')->where(" category1 = 'C1'")
            ->where(" category2 >= '$searchOn'")
            ->where(" category2::text LIKE '$datachar03%'")
            ->where("suchi2 = 0")
            ->orderBy("bango asc")
            ->get()->execute();

        //        $categoryhtml2_other="<option value=''>選択無し</option>\n";
        $categoryhtml2_other = "";

        foreach ($categorykanri2_other as $value) {
            $categoryhtml2_other .= "<option value='" . $value->category1 . $value->category2 . "'>" . substr($value->category2, -1) . " " . $value->category4 . "</option>\n";
        }

        $categorykanri3_other = QueryHelper::select(['category1,category2,category4'])->from('categorykanri')->where(" category1 = 'C2'")
            ->where(" category2 >= '$searchOn'")
            ->where(" category2::text LIKE '$datachar04%'")
            ->where("suchi2 = 0")
            ->orderBy("bango asc")
            ->get()->execute();

        $categoryhtml3_other = "<option value=''>選択無し</option>\n";

        foreach ($categorykanri3_other as $value) {
            $categoryhtml3_other .= "<option value='" . $value->category1 . $value->category2 . "'>" . substr($value->category2, -1) . " " . $value->category4 . "</option>\n";
        }

        $var = [
            'categoryhtml2' => $categoryhtml2,
            'categoryhtml1_right' => $categoryhtml1_right,
            'categoryhtml2_other' => $categoryhtml2_other,
            'categoryhtml3_other' => $categoryhtml3_other,
            'categoryhtml3' => $categoryhtml3
        ];

        return json_encode($var);
    }

    public static function delete7daysBeforeData($bango)
    {
        try {
            if (file_exists('uploads/delivery_notes/')) {
                $filenames = scandir('uploads/delivery_notes/');
                $filenames = array_diff($filenames, ['.', '..']);
                foreach ($filenames as $file) {
                    $filename = basename($file, '.csv');
                    $username = isset(explode('-', $filename)[1]) ? explode('-', $filename)[1] : null;
                    $file_time = isset(explode('-', $filename)[2]) ? explode('-', $filename)[2] : null;
                    $time = now()->subDays(7)->format('Ymd');
                    if ($username && $file_time &&  $username == $bango && $file_time <= $time) {
                        unlink("uploads/delivery_notes/" . $file);
                    }
                }
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
