<?php

namespace App\Http\Controllers\sales;

use App\tantousya;
use App\Http\Controllers\Controller;
use App\AllClass\sales\billingDataCreation\allData;
use App\AllClass\sales\billingDataCreation\validateBillingData;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

class BillingDataCreationController extends Controller
{
	const BILLING_HEADERS = [
		"顧客番号",
		"請求番号",
		"締日",
		"請求方法",
		"請求件名",
		"請求摘要",
		"請求日",
		"入金予定日",
		"前回請求金額",
		"当月入金額",
		"調整額",
		"繰越残高",
		"請求額",
		"請求消費税額",
		"請求合計金額",
		"請求担当者",
		"伝票番号",
		"伝票明細番号",
		"利用年月日",
		"商品名",
		"商品単価",
		"数量",
		"金額",
		"消費税金額",
		"合計金額",
		"備考",
		"汎用文字項目０１",
		"汎用文字項目０２",
		"汎用文字項目０３",
		"汎用文字項目０４",
		"汎用文字項目０５",
		"汎用文字項目０６",
		"汎用文字項目０７",
		"汎用文字項目０８",
		"汎用文字項目０９",
		"汎用文字項目１０",
		"汎用数値項目０１",
		"汎用数値項目０２",
		"汎用数値項目０３",
		"汎用数値項目０４",
		"汎用数値項目０５",
		"汎用数値項目０６",
		"汎用数値項目０７",
		"汎用数値項目０８",
		"汎用数値項目０９",
		"汎用数値項目１０",
		"汎用日付項目０１",
		"汎用日付項目０２",
		"汎用日付項目０３",
		"汎用日付項目０４",
		"汎用日付項目０５",
		"汎用日付項目０６",
		"汎用日付項目０７",
		"汎用日付項目０８",
		"汎用日付項目０９",
		"汎用日付項目１０",
		"顧客氏名１（漢字）",
		"顧客氏名２（漢字）",
		"顧客氏名１（カナ）",
		"顧客氏名２（カナ）",
		"取扱区分",
		"組織コード",
		"郵便番号",
		"顧客住所１（漢字）",
		"顧客住所２（漢字）",
		"顧客住所３（漢字）",
		"電話番号",
		"携帯番号",
		"FAX番号",
		"メールアドレス",
		"相手先担当所属",
		"相手先担当者名",
		"請求方法_1",
		"締日（日）",
		"入金予定日（日）",
		"スライド月数",
		"取引銀行コード",
		"決済口座情報/銀行コード",
		"決済口座情報/支店コード",
		"決済口座情報/預金種別",
		"決済口座情報/口座番号",
		"決済口座情報/口座名義人",
		"仮想口座情報/銀行コード",
		"仮想口座情報/支店コード",
		"仮想口座情報/預金種別",
		"仮想口座情報/口座番号",
		"備考_2",
		"手数料負担区分",
		"与信限度額",
		"代表債権者フラグ",
		"手数料自動学習フラグ",
		"カナ自動学習フラグ",
		"手数料誤差利用",
		"営業担当者ID",
		"顧客汎用文字項目０１",
		"顧客汎用文字項目０２",
		"顧客汎用文字項目０３",
		"顧客汎用文字項目０４",
		"顧客汎用文字項目０５",
		"顧客汎用数値項目０１",
		"顧客汎用数値項目０２",
		"顧客汎用数値項目０３",
		"顧客汎用数値項目０４",
		"顧客汎用数値項目０５",
		"顧客汎用日付項目０１",
		"顧客汎用日付項目０２",
		"顧客汎用日付項目０３",
		"顧客汎用日付項目０４",
		"顧客汎用日付項目０５",
	];
    public function index()
    {
        $bango = request('userId');
        $tantousya = tantousya::find($bango);
        return view('sales.billingDataCreation.index',compact('tantousya','bango'));
    }


    public function validation()
    {
        // 1. Checking the any validation
        $validator = validateBillingData::validate(request()->all());
        $errors = $validator->errors();
        if($errors->any()){
           $err_msg = $errors->all();
           return ['err_field'=>$errors,'err_msg'=>$err_msg];
        }

        // 2. Get the data
        $query = allData::data(request('date_start'),request('date_end'))->toSql();
        $query_result = QueryHelper::fetchSingleResult($query);

        // 3. If no any data between start date and end date then return error msg 該当するデータがありません。
        if($query_result == []) return ['err_field'=>[],'err_msg'=>['該当するデータがありません。']];
        // 4. If data exists in database then else works for extra validation
        else
        {
            $error_messages = [];
             /*
               4.1.  $extra_validation =  
                "AND left(tuhanorder.information2, 8) = concat(haisou.shikibetsucode , haisou.torihikisakibango)
                AND RIGHT(others2.otherfloat1::TEXT, 1)='1'
                AND others2.other36 IS NULL";
            */
            $query = allData::data(request('date_start'),request('date_end'),true)->toSql();
            $query_results = QueryHelper::fetchResult($query);
            foreach($query_results as $result)
            {
                $key = substr($result->dummy, 0,8);
                // 4.2 show the error 旧取引先CDが登録されていません(事業所マスタ . tuhanorder.information2(0, 8)
                $error_messages[$key] = '旧取引先CDが登録されていません(事業所マスタ'.substr($result->dummy, 0,8).')';
            }
            if(count($error_messages) > 0) return ['err_field'=>[],'err_msg'=>$error_messages];
        }
        return 'ok';
    }

    public function downloadCsv()
    {
        $query = allData::data(request('date_start'),request('date_end'))->toSql();
        $query_result = QueryHelper::fetchResult($query);
        $file_name = mb_convert_encoding("入金消込SYS請求データ_".date("YmdHis").".csv","SJIS", "UTF-8");


        $export = implode(",",self::BILLING_HEADERS)."\n";

        foreach($query_result as $result) {
            $csv_array = [
                $result->information2, //顧客番号
                "", //請求番号
                $result->intorder03, //締日
                "1", //請求方法
                $result->juchukubun1, //請求件名
                "", //請求摘要
                $result->intorder03, //請求日
                $result->intorder05, //入金予定日
                "0", //前回請求金額
                "0", //当月入金額
                "0", //調整額
                "0", //繰越残高
                $result->billing_amount, //請求額
                "0", //請求消費税額
                $result->billing_amount, //請求合計金額
                "", //請求担当者
                "", //伝票番号
                "", //伝票明細番号
                $result->intorder03, //利用年月日
                "", //商品名
                "0", //商品単価
                "0", //数量
                "0", //金額
                "0", //消費税金額
                "0", //合計金額
                "", //備考
                $result->kessaihouhou, //汎用文字項目０１
                $result->juchukubun1, //汎用文字項目０２
                $result->information8, //汎用文字項目０３
                $result->datachar10, //汎用文字項目０４
                "", //汎用文字項目０５
                "", //汎用文字項目０６
                "", //汎用文字項目０７
                "", //汎用文字項目０８
                "", //汎用文字項目０９
                "", //汎用文字項目１０
                "0", //汎用数値項目０１
                "0", //汎用数値項目０２
                "0", //汎用数値項目０３
                "0", //汎用数値項目０４
                "0", //汎用数値項目０５
                "0", //汎用数値項目０６
                "0", //汎用数値項目０７
                "0", //汎用数値項目０８
                "0", //汎用数値項目０９
                "0", //汎用数値項目１０
                "", //汎用日付項目０１
                "", //汎用日付項目０２
                "", //汎用日付項目０３
                "", //汎用日付項目０４
                "", //汎用日付項目０５
                "", //汎用日付項目０６
                "", //汎用日付項目０７
                "", //汎用日付項目０８
                "", //汎用日付項目０９
                "", //汎用日付項目１０
                $result->name, //顧客氏名１（漢字）
                "", //顧客氏名２（漢字）
                $result->datatxt0050, //顧客氏名１（カナ）
                "", //顧客氏名２（カナ）
                "", //取扱区分
                "100001", //組織コード
                "", //郵便番号
                "", //顧客住所１（漢字）
                "", //顧客住所２（漢字）
                "", //顧客住所３（漢字）
                "", //電話番号
                "", //携帯番号
                "", //FAX番号
                "", //メールアドレス
                "", //相手先担当所属
                "", //相手先担当者名
                "1", //請求方法_1
                $result->flag_check3==='31'?'99':$result->flag_check3, //締日（日）
                $result->flag_check6==='31'?'99':$result->flag_check6, //入金予定日（日）
                is_string($result->flag_check5)?substr($result->flag_check5,0,1):$result->flag_check5, //スライド月数
                "", //取引銀行コード
                "", //決済口座情報/銀行コード
                "", //決済口座情報/支店コード
                "", //決済口座情報/預金種別
                "", //決済口座情報/口座番号
                "", //決済口座情報/口座名義人
                "", //仮想口座情報/銀行コード
                "", //仮想口座情報/支店コード
                "", //仮想口座情報/預金種別
                "", //仮想口座情報/口座番号
                "", //備考_2
                substr($result->flag_check8,0,1)==='2'?'0':'1', //手数料負担区分
                "", //与信限度額
                "0", //代表債権者フラグ
                substr($result->flag_check8,0,1)==='2'?'0':'1', //手数料自動学習フラグ
                "1", //カナ自動学習フラグ
                "1", //手数料誤差利用
                "1", //営業担当者ID
                "", //顧客汎用文字項目０１
                "", //顧客汎用文字項目０２
                "", //顧客汎用文字項目０３
                "", //顧客汎用文字項目０４
                "", //顧客汎用文字項目０５
                "", //顧客汎用数値項目０１
                "", //顧客汎用数値項目０２
                "", //顧客汎用数値項目０３
                "", //顧客汎用数値項目０４
                "", //顧客汎用数値項目０５
                "", //顧客汎用日付項目０１
                "", //顧客汎用日付項目０２
                "", //顧客汎用日付項目０３
                "", //顧客汎用日付項目０４
                "", //顧客汎用日付項目０５
            ];
            $export .= implode(",",$csv_array)."\n";
        }

        $export = mb_convert_encoding($export,"SJIS", "UTF-8");
        //dd(mb_convert_encoding('①',"SJIS"));
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename='.$file_name);
        ob_end_clean();
        echo $export;
        exit();
    }
}
