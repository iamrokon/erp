<?php

namespace App\Http\Controllers\support;

use App\Http\Controllers\Controller;
use Excel;
use App\AllClass\master\ExcelReportDownload;
use Carbon\Carbon;
use App\AllClass\master\CSVLogger;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use App\tantousya;
use Illuminate\Http\Request;
use App\AllClass\support\manPowerManagementDataCreation\ManPowerManagementDataCreationValidation;
use DB;
use ZipArchive;

class ManPowerManagementDataCreationController extends Controller{
    const BILLING_HEADERS_TERI_CSV = [
        "DATA区分", // 1
        "取引先CD", // 2
        "伝票日付", // 3
        "伝票No", // 4
        "伝票区分", // 5
        "担当CD", // 6
        "受注No", // 7
        "金額", // 8
        "消費税額" // 9
    ];

    const BILLING_HEADERS_TMEISEI_CSV = [
        "DATA区分", // 1
        "伝票No", // 2
        "行No", // 3
        "枝番", // 4
        "大分類CD", // 5
        "中分類CD", // 6
        "明細内容", // 7
        "数量", // 8
        "単位", // 9
        "単価", // 10
        "金額", // 11
        "受注No", // 12
        "科目CD", // 13
        "内訳CD", // 14
        "商品分類3", // 15
    ];

    const BILLING_HEADERS_JUCHU_CSV = [
        "受注No", // 1 
        "訂正回数", // 2 
        "業務区分", // 3 
        "元受注No", // 4 
        "親受注No", // 5 
        "担当CD", // 6 
        "受注先CD", // 7 
        "売上先CD", // 8 
        "最終顧客CD", // 9 
        "受注内容", // 10 
        "受注日", // 11 
        "売上予定日", // 12 
        "回収予定日", // 13 
        "受注金額", // 14 
        "粗利予定額", // 15 
        "受注先名", // 16 
        "受注先事業所名", // 17 
        "最終顧客名", // 18 
        "最終顧客事業所名", // 19 
        "入力日時", // 20 
        "データ区分", // 21 
    ];

    const BILLING_HEADERS_JMEISEI_CSV = [
        "受注番号", // 1 
        "訂正回数", // 2 
        "区分", // 3 
        "行No", // 4 
        "枝番", // 5 
        "大分類CD", // 6 
        "中分類CD", // 7 
        "明細内容", // 8 
        "数量", // 9 
        "単位", // 10 
        "単価", // 11 
        "金額", // 12 
        "原価", // 13 
        "仕切先CD", // 14 
        "仕切先名", // 15 
        "仕切先事業所名", // 16 
        "売上集計フラグ", // 17 
        "入力日時", // 18 
        "商品分類３", // 19 
        "受注集計フラグ", // 20 
    ];

    public function index(){

        // $result = DB::select(DB::raw("select * from rireki where kr0000 = '0000000030' and kr0003='1' and kr0009='2'"));

        // echo "<pre>";
        // var_dump($result);
        // return 0;

        // kr0001 = 'V820', kr0008 ='U110' => kr0001 = 'V810', kr0008 ='U160'
       // $result = DB::select(DB::raw("update rireki set kr0001 = 'V810', kr0008='U160' where kr0000 = '0000000030' and kr0003='1' and kr0009='2'"));


        $bango = request('userId');
        $tantousya = tantousya::find($bango);
        $request_101 = QueryHelper::select(['syouhinbango', 'jouhou', 'color', 'bango'])->from('request')->where("color = '1003データ区分'")->orderBy("bango asc")->get()->execute();
        $request_102 = QueryHelper::select(['syouhinbango', 'jouhou', 'color', 'bango'])->from('request')->where("color = '1003出力区分'")->orderBy("bango asc")->get()->execute();

         return view('support.manPowerManagementDataCreation.mainManPowerManagementDataCreation', compact('bango', 'tantousya', 'request_101', 'request_102'));
    }


    public function csvProcess(Request $request){
      //  echo "call me from controller <br>";
        // 1. first placing the validation check
        $validator = ManPowerManagementDataCreationValidation::handle(request()->all());
        $errors = $validator->errors();

        if ($errors->any()) {
            return ['err_msg' => $errors];
        }elseif(!$errors->any() && $request->submit_confirmation == ""){
            $result["status"] = "confirm";
            return $result;
        }else if (!$errors->any()) {
            // 2. when man_power_management_data_creation_101 = 2 : create tori.csv and tmeisei.csv
            // 3. when man_power_management_data_creation_101 = 1 : create juchu.csv and jmeisei.csv
            // 4. zip the csv and download
            $man_power_management_data_creation_101 = $request->man_power_management_data_creation_101;
            if($man_power_management_data_creation_101 == 2){
                $this->csvProcessAndDownload2($request);
            }else{
                if($man_power_management_data_creation_101 == 1){
                    $this->csvProcessAndDownload1($request);
                } // ./Ends else if
            } // ./ Ends else 
        }// ./Ends no errors found
    }


    private function csvProcessAndDownload1(Request $request){
        $juchu_csv_export = $this->juchuCsvCreation($request);
        $jmeisei_csv_export = $this->jmeiseiCsvCreation($request);
        
        $file_name = "juchu_" .date("YmdHis");
        header('Content-Type: application/csv');
        
        if(!file_exists($file_name)){
            mkdir($file_name,0777,true);
        }

         file_put_contents($file_name . '/juchu.csv', $juchu_csv_export);
         file_put_contents($file_name. '/jmeisai.csv', $jmeisei_csv_export);

        $zip = new ZipArchive;
        if ($zip->open($file_name . '/'. $file_name. ".zip", ZipArchive::CREATE) === TRUE){
            // Add files to the zip file
            $zip->addFile($file_name . '/juchu.csv');
            $zip->addFile($file_name . '/jmeisai.csv');
         
            // All files are added, so close the zip file.
            $zip->close();
            ob_end_clean();
            header('Content-disposition: attachment; filename='. $file_name . ".zip");
            header('Content-type: application/zip');
            readfile($file_name . '/'. $file_name . ".zip");

            unlink($file_name . "/juchu.csv");
            unlink($file_name . "/jmeisai.csv");
            unlink($file_name . "/" . $file_name . ".zip");
        }
    }

     private function csvProcessAndDownload2(Request $request){
        $tori_export = $this->toriCsvCreation($request);
        $tmeisei_export = $this->tmeiseiCsvCreation($request);
        
        $file_name = "tori_" .date("YmdHis");
        header('Content-Type: application/csv');
        
        if(!file_exists($file_name)){
            mkdir($file_name,0777,true);
        }

         file_put_contents($file_name . '/tori.csv', $tori_export);
         file_put_contents($file_name. '/tmeisai.csv', $tmeisei_export);

        $zip = new ZipArchive;
        if ($zip->open($file_name . '/'. $file_name. ".zip", ZipArchive::CREATE) === TRUE){
            // Add files to the zip file
            $zip->addFile($file_name . '/tori.csv');
            $zip->addFile($file_name . '/tmeisai.csv');
         
            // All files are added, so close the zip file.
            $zip->close();
            ob_end_clean();
            header('Content-disposition: attachment; filename='. $file_name . ".zip");
            header('Content-type: application/zip');
            readfile($file_name . '/'. $file_name . ".zip");

            unlink($file_name . "/tori.csv");
            unlink($file_name . "/tmeisai.csv");
            unlink($file_name . "/" . $file_name . ".zip");
        }
    }


    private function csvProcessAndDownload2_tmp(Request $request){
        $tori_export = $this->toriCsvCreation($request);
        $tmeisei_export = $this->tmeiseiCsvCreation($request);
        
        header('Content-Type: application/csv');
        
        if(!file_exists('manPowerManagementDataCreation')){
            mkdir('manPowerManagementDataCreation',0777,true);
        }

        file_put_contents('manPowerManagementDataCreation/tori_new.csv', $tori_export);
        file_put_contents('manPowerManagementDataCreation/tmeisai_new.csv', $tmeisei_export);

        $zip = new ZipArchive;
        if ($zip->open('manPowerManagementDataCreation/manPower.zip', ZipArchive::CREATE) === TRUE){
            // Add files to the zip file
            $zip->addFile('manPowerManagementDataCreation/tori_new.csv');
            $zip->addFile('manPowerManagementDataCreation/tmeisai_new.csv');
         
            // All files are added, so close the zip file.
            $zip->close();
            header('Content-disposition: attachment; filename=manPower.zip');
            header('Content-type: application/zip');
            readfile('manPowerManagementDataCreation/manPower.zip');
            unlink("manPowerManagementDataCreation/tori_new.csv");
            unlink("manPowerManagementDataCreation/tmeisai_new.csv");
            unlink("manPowerManagementDataCreation/manPower.zip");
        }
    }

    private function jmeiseiCsvCreation(Request $request){
        $man_power_management_data_creation_102 = $request->man_power_management_data_creation_102;
        // $sql = "";
        // if($man_power_management_data_creation_102 == 1){
        //     $sql .= " kr0071 = '2'";
        // }

        // if($man_power_management_data_creation_102 == 2){
        //     $sql .= " kr0071 = '1'";
        // }

        // if($man_power_management_data_creation_102 == 3){
        //     $sql .= " kr0071 = '1' or kr0071 = '2'";
        // }

        // $man_power_management_data_creation_103_1 = date("Y-m-d 00:00:00", strtotime($request->man_power_management_data_creation_103_1));
        // $man_power_management_data_creation_103_2 = date("Y-m-d 23:59:59", strtotime($request->man_power_management_data_creation_103_2));

        $man_power_management_data_creation_104_1 = $request->man_power_management_data_creation_104_1;
        $man_power_management_data_creation_104_2 = $request->man_power_management_data_creation_104_2;

        QueryHelper::runQuery("DROP TABLE IF EXISTS man_power_management_data_creation_table");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE man_power_management_data_creation_table as
            select  
            kr0001,
            kr0002,
            kr0003,
            kr0004,
            kr0005, 
            kr0006, 
            kr0007,
            kr0009,
            kr0016,
            kr0018,
            kr0025,
            kr0026,
            kr0028,
            kr0029,
            kr0030,
            kr0073,
            kr0082,
            kr0111,
            kr0116,
            kr0117
            from rireki
            where
            -- ② ⑥ condition
            (kr0001 = 'V810' or kr0001 = 'V830') and
            (kr0002 >= '$man_power_management_data_creation_104_1' and kr0002 <= '$man_power_management_data_creation_104_2') and
            (kr0007 = 'V120' or kr0007 = 'V130' or kr0007 = 'V140')

            order by kr0001,  kr0002, kr0005, kr0006, kr0007, kr0003, kr0004");

        $query = DB::table('man_power_management_data_creation_table')->toSql();

        $query_result = QueryHelper::fetchResult($query);
        $file_name = mb_convert_encoding("jmeisei".date("YmdHis").".csv","SJIS", "UTF-8");


        $export = implode(",",self::BILLING_HEADERS_JMEISEI_CSV)."\n";

       // echo "<pre>";
       // var_dump($query_result);
        foreach($query_result as $result) {
            $first_column = "";
            $second_column = "";
            $third_column = "";
            $fourth_column = "";
            $fifth_column = "";
            $sixth_column = "";
            $seventh_column = "";
            $eighth_column = "";
            $ninth_column = "";
            $tenth_column = "";
            $eleventh_column = "";
            $twelfth_column = "";
            $thirteen_column = "";
            $fourteen_column = "";
            $fifteen_column = "";
            $sixteen_column = "";
            $seventeen_column = "";
            $eighteen_column = "";
            $nineteen_column = "";
            $tweenty_column = "";

            
            // ②
            if($result->kr0001 == 'V810'){
                if($result->kr0007 == 'V110'){
                    $first_column = "'". $result->kr0002;
                    $second_column = $result->kr0005;
                    $third_column = $result->kr0006;
                    $fourth_column = $result->kr0003;
                    $fifth_column = $result->kr0004;
                    $sixth_column = "'". substr($result->kr0116, 0, 4);
                    $seventh_column = "'". substr($result->kr0117, 0, 5);
                    $eighth_column = $result->kr0018;
                    $ninth_column = $result->kr0025;
                    $tenth_column = $result->kr0026;
                    $eleventh_column = $result->kr0029;
                    $twelfth_column = $result->kr0030;
                    $thirteen_column = 0;
                    $fourteen_column = "'". 0;
                    $fifteen_column = "";
                    $sixteen_column = "";
                    $seventeen_column = $result->kr0009;
                    $eighteen_column = $result->kr0082;
                    $nineteen_column = $result->kr0111;
                    $tweenty_column = $result->kr0073;
                }else{
                    if($result->kr0007 == 'V150' || $result->kr0007 == 'V160'){
                        $first_column = "'". $result->kr0002;
                        $second_column = $result->kr0005;
                        $third_column = $result->kr0006;
                        $fourth_column = $result->kr0003;
                        $fifth_column = $result->kr0004;
                        $seventh_column = "'" . "01";
                        $eighth_column = $result->kr0018;
                        $ninth_column = $result->kr0025;
                        $tenth_column = $result->kr0026;
                        $eleventh_column = $result->kr0029;
                        $twelfth_column = $result->kr0030;
                        $thirteen_column = 0;
                        $fourteen_column = "'". $result->kr0016;
                        $fifteen_column =  "'". substr($result->kr0016, 0, 6);
                        $sixteen_column =  "'". substr($result->kr0016, 0, 8);
                        $seventeen_column = $result->kr0009;
                        $eighteen_column = $result->kr0082;
                        $nineteen_column = $result->kr0111;
                        $tweenty_column = $result->kr0073;
                    }else{
                        if($result->kr0007 == 'V120' || $result->kr0007 == 'V130' || $result->kr0007 == 'V140'){
                            $first_column = "'". $result->kr0002; 
                            $second_column = $result->kr0005;
                            $third_column = $result->kr0006;
                            $fourth_column = $result->kr0003;
                            $fifth_column = $result->kr0004;
                            $sixth_column = "'" . "00";
                            $seventh_column = "'" . "01";
                            $eighth_column = $result->kr0018;
                            $ninth_column = $result->kr0025;
                            $tenth_column = $result->kr0026;
                            $eleventh_column = $result->kr0029;
                            $twelfth_column = $result->kr0030;
                            $thirteen_column = 0;
                            $fourteen_column = "'".$result->kr0028;
                            $fifteen_column =  "'".$result->kr0028;
                            $sixteen_column =  "";
                            $seventeen_column = $result->kr0009;
                            $eighteen_column = $result->kr0082;
                            $nineteen_column = $result->kr0111;
                            $tweenty_column = $result->kr0073;
                        }
                    }
                }

                $csv_array = [
                    $first_column,      // 1 受注No
                    $second_column,     // 2 訂正回数
                    $third_column,      // 3 業務区分
                    $fourth_column,     // 4 元受注No
                    $fifth_column,      // 5 親受注No
                    $sixth_column,      // 6 担当CD
                    $seventh_column,    // 7 受注先CD
                    $eighth_column,     // 8 売上先CD
                    $ninth_column,      // 9 最終顧客CD
                    $tenth_column,      // 10 受注内容
                    $eleventh_column,   // 11 受注日
                    $twelfth_column,    // 12 売上予定日
                    $thirteen_column,   // 13 回収予定日
                    $fourteen_column,   // 14 受注金額
                    $fifteen_column,    // 15 粗利予定額
                    $sixteen_column,    // 16 受注先名
                    $seventeen_column,  // 17 受注先事業所名
                    $eighteen_column,   // 18 最終顧客名
                    $nineteen_column,   // 19 最終顧客事業所名
                    $tweenty_column,    // 20 入力日時  
                ];

                $export .= implode(",",$csv_array)."\r\n";
            } // ./ Ends  ②


             // ④
            if(($result->kr0001 == 'V810') and ($result->kr0007 == 'V120' || $result->kr0007 == 'V130' || $result->kr0007 == 'V140')){
                    $first_column = "'". $result->kr0002;
                    $second_column = $result->kr0005;
                    $third_column = $result->kr0006;
                    $fourth_column = $result->kr0003;
                    $fifth_column = $result->kr0004;
                    $sixth_column = "'". substr($result->kr0116, 0, 4);
                    $seventh_column = "'". substr($result->kr0117, 0, 5);
                    $eighth_column = $result->kr0018;
                    $ninth_column = $result->kr0025;
                    $tenth_column = $result->kr0026;
                    $eleventh_column = $result->kr0029;
                    $twelfth_column = $result->kr0030;
                    $thirteen_column = 0;
                    $fourteen_column = "'".$result->kr0028;
                    $fifteen_column =  "'".$result->kr0026;
                    $sixteen_column = "";
                    $seventeen_column = $result->kr0009;
                    $eighteen_column = $result->kr0082;
                    $nineteen_column = $result->kr0111;
                    $tweenty_column = $result->kr0073;

                    $csv_array = [
                        $first_column,      // 1 受注No
                        $second_column,     // 2 訂正回数
                        $third_column,      // 3 業務区分
                        $fourth_column,     // 4 元受注No
                        $fifth_column,      // 5 親受注No
                        $sixth_column,      // 6 担当CD
                        $seventh_column,    // 7 受注先CD
                        $eighth_column,     // 8 売上先CD
                        $ninth_column,      // 9 最終顧客CD
                        $tenth_column,      // 10 受注内容
                        $eleventh_column,   // 11 受注日
                        $twelfth_column,    // 12 売上予定日
                        $thirteen_column,   // 13 回収予定日
                        $fourteen_column,   // 14 受注金額
                        $fifteen_column,    // 15 粗利予定額
                        $sixteen_column,    // 16 受注先名
                        $seventeen_column,  // 17 受注先事業所名
                        $eighteen_column,   // 18 最終顧客名
                        $nineteen_column,   // 19 最終顧客事業所名
                        $tweenty_column,    // 20 入力日時  
                    ];

                    $export .= implode(",",$csv_array)."\r\n";
            } // ./ Ends  ④

            //  ⑥ condition
            if(($result->kr0001 == 'V830') and ($result->kr0007 == 'V120' || $result->kr0007 == 'V130' || $result->kr0007 == 'V140' || $result->kr0007 == 'V160')){
                if($result->kr0007 == 'V120' || $result->kr0007 == 'V130' || $result->kr0007 == 'V140'){
                    $first_column = "'". $result->kr0002;
                    $second_column = $result->kr0005;
                    $third_column = $result->kr0006;
                    $fourth_column = $result->kr0003;
                    $fifth_column = $result->kr0004;
                    $sixth_column = "'". substr($result->kr0116, 0, 4);
                    $seventh_column = "'". substr($result->kr0117, 0, 5);
                    $eighth_column = $result->kr0018;
                    $ninth_column = $result->kr0025;
                    $tenth_column = $result->kr0026;
                    $eleventh_column = $result->kr0029;
                    $twelfth_column = $result->kr0030;
                    $thirteen_column = 0;
                    $fourteen_column = "'". $result->kr0028;
                    $fifteen_column =  "'". $result->kr0026;
                    $sixteen_column = "";
                    $seventeen_column = $result->kr0009;
                    $eighteen_column = $result->kr0082;
                    $nineteen_column = $result->kr0111;
                    $tweenty_column = $result->kr0073;
                }else{
                    if($result->kr0007 == 'V160'){
                        $first_column = "'". $result->kr0002;
                        $second_column = $result->kr0005;
                        $third_column = $result->kr0006;
                        $fourth_column = $result->kr0003;
                        $fifth_column = $result->kr0004;
                        $sixth_column = "'00";
                        $seventh_column = "'03";
                        $eighth_column = $result->kr0018;
                        $ninth_column = $result->kr0025;
                        $tenth_column = $result->kr0026;
                        $eleventh_column = $result->kr0029;
                        $twelfth_column = $result->kr0030;
                        $thirteen_column = 0;
                        $fourteen_column = "'". $result->kr0016;
                        $fifteen_column =  "'". $result->kr0016;
                        $sixteen_column = "";
                        $seventeen_column = $result->kr0009;
                        $eighteen_column = $result->kr0082;
                        $nineteen_column = $result->kr0111;
                        $tweenty_column = $result->kr0073;
                    }
                }
                    

                    $csv_array = [
                        $first_column,      // 1 受注No
                        $second_column,     // 2 訂正回数
                        $third_column,      // 3 業務区分
                        $fourth_column,     // 4 元受注No
                        $fifth_column,      // 5 親受注No
                        $sixth_column,      // 6 担当CD
                        $seventh_column,    // 7 受注先CD
                        $eighth_column,     // 8 売上先CD
                        $ninth_column,      // 9 最終顧客CD
                        $tenth_column,      // 10 受注内容
                        $eleventh_column,   // 11 受注日
                        $twelfth_column,    // 12 売上予定日
                        $thirteen_column,   // 13 回収予定日
                        $fourteen_column,   // 14 受注金額
                        $fifteen_column,    // 15 粗利予定額
                        $sixteen_column,    // 16 受注先名
                        $seventeen_column,  // 17 受注先事業所名
                        $eighteen_column,   // 18 最終顧客名
                        $nineteen_column,   // 19 最終顧客事業所名
                        $tweenty_column,    // 20 入力日時  
                    ];

                    $export .= implode(",",$csv_array)."\r\n";
            } // ./ Ends  ⑥
        }

         $export = mb_convert_encoding($export,"SJIS", "UTF-8");
        // header('Content-Type: application/csv');
        // header('Content-Disposition: attachment; filename='.$file_name);
        // ob_end_clean();
        // echo $export;
        // exit();

        return $export;
    }

    private function juchuCsvCreation(Request $request){
        $man_power_management_data_creation_102 = $request->man_power_management_data_creation_102;
        $sql = "";
        if($man_power_management_data_creation_102 == 1){
            $sql .= " kr0071 = '2'";
        }

        if($man_power_management_data_creation_102 == 2){
            $sql .= " kr0071 = '1'";
        }

        if($man_power_management_data_creation_102 == 3){
            $sql .= " kr0071 = '1' or kr0071 = '2'";
        }

        $man_power_management_data_creation_103_1 = date("Y-m-d 00:00:00", strtotime($request->man_power_management_data_creation_103_1));
        $man_power_management_data_creation_103_2 = date("Y-m-d 23:59:59", strtotime($request->man_power_management_data_creation_103_2));

        $man_power_management_data_creation_104_1 = $request->man_power_management_data_creation_104_1;
        $man_power_management_data_creation_104_2 = $request->man_power_management_data_creation_104_2;

        QueryHelper::runQuery("DROP TABLE IF EXISTS man_power_management_data_creation_table");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE man_power_management_data_creation_table as
            select  
            kr0001,
            kr0002,
            kr0005, 
            kr0006, 
            kr0007,
            max(kr0008) as kr0008,
            max(kr0010) as kr0010,
            max(kr0011) as kr0011,
            max(kr0012) as kr0012,
            max(kr0013) as kr0013,
            kr0018,
            kr0028,
            sum(kr0030) as kr0030,
            max(kr0033) as kr0033,
            max(kr0036) as kr0036,
            max(kr0040) as kr0040,
            max(kr0041) as kr0041,
            kr0057,
            max(kr0082) as kr0082,
            max(kr0118) as kr0118
            from rireki
            where
            -- ① ③ ⑤ condition
            (kr0082 >= '$man_power_management_data_creation_103_1' and kr0082 <= '$man_power_management_data_creation_103_2') and
            -- ① ③ ⑤ condition
            ((kr0002 >= '$man_power_management_data_creation_104_1' and kr0002 <= '$man_power_management_data_creation_104_2') or (kr0057 >= '$man_power_management_data_creation_104_1' and kr0057 <= '$man_power_management_data_creation_104_2')) and
            -- ① ③ ⑤ condition
            ((kr0001 = 'V810' and kr0008 !='U160') or (kr0007 = 'V120' or kr0007 = 'V130' or kr0007 = 'V140' or kr0007 = 'V160') or (kr0001 = 'V830' and kr0008 = 'V413')) and
            -- ① ③ ⑤ condition
            $sql

            group by kr0001, kr0002, kr0005, kr0006, kr0007, kr0008, kr0018, kr0028, kr0057, kr0082
            order by kr0082, kr0001,  kr0002, kr0005, kr0006, kr0007, kr0028");

        $query = DB::table('man_power_management_data_creation_table')->toSql();

        $query_result = QueryHelper::fetchResult($query);
        $file_name = mb_convert_encoding("juchu_".date("YmdHis").".csv","SJIS", "UTF-8");


        $export = implode(",",self::BILLING_HEADERS_JUCHU_CSV)."\n";

        // echo "<pre>";
        // var_dump($query_result);
        foreach($query_result as $result) {
            $first_column = "";
            $second_column = "";
            $third_column = "";
            $fourth_column = "";
            $fifth_column = "";
            $sixth_column = "";
            $seventh_column = "";
            $eighth_column = "";
            $ninth_column = "";
            $tenth_column = "";
            $eleventh_column = "";
            $twelfth_column = "";
            $thirteen_column = "";
            $fourteen_column = "";
            $fifteen_column = "";
            $sixteen_column = "";
            $seventeen_column = "";
            $eighteen_column = "";
            $nineteen_column = "";
            $tweenty_column = "";
            $tweentyone_column = "";

            
            // ①
            if($result->kr0001 == 'V810'){
                $first_column = "'". $result->kr0002;
                $second_column = $result->kr0005;

                // third column
                if($result->kr0118 == '2'){
                    $third_column = '2';
                }else{
                    if($result->kr0118 == '3'){
                        $third_column = '9';
                    }else{
                        if($result->kr0008 == '20' || $result->kr0008 == '22' || $result->kr0008 == '23'){
                            $third_column = '4';
                        }else{
                            $third_column = '1';
                        }
                    }
                } 

                $fourth_column = "'". $result->kr0002;
                $fifth_column = "'". $result->kr0002;
                $sixth_column = $result->kr0010;
                $seventh_column = "'". substr($result->kr0011, 0, 8);
                $eighth_column = "'". substr($result->kr0012, 0, 8);
                $ninth_column = "'". substr($result->kr0013, 0, 8);;
                $tenth_column = "'". $result->kr0002 . $result->kr0005;
                $eleventh_column = $result->kr0036;
                $twelfth_column = $result->kr0040;
                $thirteen_column = $result->kr0041;
                $fourteen_column = $result->kr0033;
                $fifteen_column =  "'". $result->kr0002 . $result->kr0005;
                $sixteen_column = "'". substr($result->kr0011, 0, 8);
                $seventeen_column = "'". substr($result->kr0011, 0, 8);
                $eighteen_column = "'". substr($result->kr0013, 0, 8);
                $nineteen_column = "'". substr($result->kr0013, 0, 8);
                $tweenty_column = $result->kr0082;
                $tweentyone_column = $result->kr0008;

                $csv_array = [
                    $first_column,      // 1 受注No
                    $second_column,     // 2 訂正回数
                    $third_column,      // 3 業務区分
                    $fourth_column,     // 4 元受注No
                    $fifth_column,      // 5 親受注No
                    $sixth_column,      // 6 担当CD
                    $seventh_column,    // 7 受注先CD
                    $eighth_column,     // 8 売上先CD
                    $ninth_column,      // 9 最終顧客CD
                    $tenth_column,      // 10 受注内容
                    $eleventh_column,   // 11 受注日
                    $twelfth_column,    // 12 売上予定日
                    $thirteen_column,   // 13 回収予定日
                    $fourteen_column,   // 14 受注金額
                    $fifteen_column,    // 15 粗利予定額
                    $sixteen_column,    // 16 受注先名
                    $seventeen_column,  // 17 受注先事業所名
                    $eighteen_column,   // 18 最終顧客名
                    $nineteen_column,   // 19 最終顧客事業所名
                    $tweenty_column,    // 20 入力日時   
                    $tweentyone_column  // 21 データ区分
                ];

                $export .= implode(",",$csv_array)."\r\n";
            }   

             // ③
            if(($result->kr0001 == 'V810') and ($result->kr0007 == 'V120' || $result->kr0007 == 'V130' || $result->kr0007 == 'V140')){
                $first_column = 0;
                $second_column = 0;
                $third_column = 3;
                $fourth_column = "'". $result->kr0002;
                $fifth_column = "'". $result->kr0002;
                $sixth_column = $result->kr0028;
                $seventh_column = "'" . substr($result->kr0011, 0, 8);
                $eighth_column = "'" . substr($result->kr0012, 0, 8);
                $ninth_column = "'" . substr($result->kr0013, 0, 8);
                $tenth_column = "'". $result->kr0002 . $result->kr0005;
                $eleventh_column = $result->kr0036;
                $twelfth_column = $result->kr0040;
                $thirteen_column = $result->kr0041;
                $fourteen_column = $result->kr0030;
                $fifteen_column = $result->kr0030;
                $sixteen_column = "'" . substr($result->kr0011, 0, 8);
                $seventeen_column = "'" . substr($result->kr0011, 0, 8);
                $eighteen_column = "'" . substr($result->kr0013, 0, 8);
                $nineteen_column = "'" . substr($result->kr0013, 0, 8);
                $tweenty_column = $result->kr0082;
                $tweentyone_column = $result->kr0008;

                $csv_array = [
                    $first_column,      // 1 受注No
                    $second_column,     // 2 訂正回数
                    $third_column,      // 3 業務区分
                    $fourth_column,     // 4 元受注No
                    $fifth_column,      // 5 親受注No
                    $sixth_column,      // 6 担当CD
                    $seventh_column,    // 7 受注先CD
                    $eighth_column,     // 8 売上先CD
                    $ninth_column,      // 9 最終顧客CD
                    $tenth_column,      // 10 受注内容
                    $eleventh_column,   // 11 受注日
                    $twelfth_column,    // 12 売上予定日
                    $thirteen_column,   // 13 回収予定日
                    $fourteen_column,   // 14 受注金額
                    $fifteen_column,    // 15 粗利予定額
                    $sixteen_column,    // 16 受注先名
                    $seventeen_column,  // 17 受注先事業所名
                    $eighteen_column,   // 18 最終顧客名
                    $nineteen_column,   // 19 最終顧客事業所名
                    $tweenty_column,    // 20 入力日時   
                    $tweentyone_column  // 21 データ区分
                ];

                $export .= implode(",",$csv_array)."\r\n";
            }



            // ⑤
            if(($result->kr0001 == 'V830') and ($result->kr0007 == 'V120' || $result->kr0007 == 'V130' || $result->kr0007 == 'V140' || $result->kr0007 == 'V160')){
                $first_column = "'". $result->kr0002;
                $second_column = "'". $result->kr0005;
                $third_column = 3;
                $fourth_column = $result->kr0057;
                $fifth_column = $result->kr0057;
                $sixth_column = $result->kr0028;
                $seventh_column = "'" . substr($result->kr0011, 0, 8);
                $eighth_column = "'" . substr($result->kr0012, 0, 8);
                $ninth_column = "'" . substr($result->kr0013, 0, 8);
                $tenth_column = "'". $result->kr0002 . $result->kr0005;
                $eleventh_column = $result->kr0036;
                $twelfth_column = $result->kr0040;
                $thirteen_column = $result->kr0041;
                $fourteen_column = $result->kr0030;
                $fifteen_column = $result->kr0030;
                $sixteen_column = "'" . substr($result->kr0011, 0, 8);
                $seventeen_column = "'" . substr($result->kr0011, 0, 8);
                $eighteen_column = "'" . substr($result->kr0013, 0, 8);
                $nineteen_column = "'" . substr($result->kr0013, 0, 8);
                $tweenty_column = $result->kr0082;
                $tweentyone_column = $result->kr0008;

                $csv_array = [
                    $first_column,      // 1 受注No
                    $second_column,     // 2 訂正回数
                    $third_column,      // 3 業務区分
                    $fourth_column,     // 4 元受注No
                    $fifth_column,      // 5 親受注No
                    $sixth_column,      // 6 担当CD
                    $seventh_column,    // 7 受注先CD
                    $eighth_column,     // 8 売上先CD
                    $ninth_column,      // 9 最終顧客CD
                    $tenth_column,      // 10 受注内容
                    $eleventh_column,   // 11 受注日
                    $twelfth_column,    // 12 売上予定日
                    $thirteen_column,   // 13 回収予定日
                    $fourteen_column,   // 14 受注金額
                    $fifteen_column,    // 15 粗利予定額
                    $sixteen_column,    // 16 受注先名
                    $seventeen_column,  // 17 受注先事業所名
                    $eighteen_column,   // 18 最終顧客名
                    $nineteen_column,   // 19 最終顧客事業所名
                    $tweenty_column,    // 20 入力日時   
                    $tweentyone_column  // 21 データ区分
                ];

                $export .= implode(",",$csv_array)."\r\n";
            }
        }

        $export = mb_convert_encoding($export,"SJIS", "UTF-8");
        // header('Content-Type: application/csv');
        // header('Content-Disposition: attachment; filename='.$file_name);
        // ob_end_clean();
        // echo $export;
        // exit();

       return $export;
    }

    private function toriCsvCreation(Request $request){

        $man_power_management_data_creation_102 = $request->man_power_management_data_creation_102;
        $sql = "";

        if($man_power_management_data_creation_102 == 1){
            $sql .= " kr0071 = '2'";
        }else{
            if($man_power_management_data_creation_102 == 2 || $man_power_management_data_creation_102 == 3){
                $sql .= " kr0071 = '1'";
            }else{
                $sql .= " kr0071 = '2'";
            }
        }

        

        $man_power_management_data_creation_105_1 = date("Y-m-d 00:00:00", strtotime($request->man_power_management_data_creation_105_1));
        $man_power_management_data_creation_105_2 = date("Y-m-d 23:59:59", strtotime($request->man_power_management_data_creation_105_2));

        QueryHelper::runQuery("DROP TABLE IF EXISTS man_power_management_data_creation_table");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE man_power_management_data_creation_table as
            select  
            kr0001,
            kr0002,
            kr0005,
            kr0006,
            kr0008,
            max(kr0010) as kr0010,
            max(kr0012) as kr0012,
            max(kr0016) as kr0016,
            max(kr0033) as kr0033,
            max(kr0034) as kr0034,
            kr0040,
            max(kr0057) as kr0057,
            max(kr0070) as kr0070,
            max(kr0071) as kr0071


            from rireki
            where
            (kr0040 >= '$man_power_management_data_creation_105_1' and
            kr0040 <= '$man_power_management_data_creation_105_2') and
            (kr0070 = '1' or kr0070='-1') and
           -- ((kr0001 = 'V820' and kr0008 !='U160' or (kr0001 = 'V840' and kr0008 !='U170')) and
            (kr0001 = 'V820' or kr0001 = 'V840') and (kr0008 !='U160' and kr0008 !='U170') and
            
            $sql

            group by kr0001, kr0002, kr0005, kr0006, kr0008, kr0012, kr0016, kr0040
            order by kr0001, kr0002, kr0005, kr0006");

        $query = DB::table('man_power_management_data_creation_table')->toSql();

        $query_result = QueryHelper::fetchResult($query);
        $file_name = mb_convert_encoding("tori_".date("YmdHis").".csv","SJIS", "UTF-8");


        $export = implode(",",self::BILLING_HEADERS_TERI_CSV)."\n";

         // echo "<pre>";
         // var_dump($query_result);
        foreach($query_result as $result) {
            $first_column = "";
            $second_column = "";
            $third_column = "";
            $fourth_column = "";
            $fifth_column = "";
            $sixth_column = "";
            $seventh_column = "";
            $eighth_column = "";
            $ninth_column = "";

        
            if($result->kr0001 == 'V840'){
                $first_column = '3';
                $second_column = "'". substr($result->kr0016, 0, 8); 
                $third_column = date('y/m/d', strtotime($result->kr0040)); 
                $fourth_column = "'". $result->kr0002; 
                $fifth_column = '30'; 
                $sixth_column = $result->kr0010;
                $seventh_column = '0';
                $eighth_column = '0';
                $ninth_column = '0';

                $csv_array = [
                    $first_column, // 1 DATA区分
                    $second_column, // 2 取引先CD
                    $third_column, // 3 伝票日付
                    $fourth_column, // 4 伝票No
                    $fifth_column, // 5 伝票区分
                    $sixth_column, // 6 担当CD
                    $seventh_column, // 7 受注No
                    $eighth_column, // 8 金額
                    $ninth_column, // 9 消費税額
                ];

                $export .= implode(",",$csv_array)."\r\n";
            }


            if($result->kr0001 == 'V820'){
                if($result->kr0008 == '20' || $result->kr0008 == '22' || $result->kr0008 = '23'){
                    $first_column = '7';
                }else{
                    $first_column = '1';
                }

                $second_column = "'". substr($result->kr0012, 0, 6); 
                $third_column = date('y/m/d', strtotime($result->kr0040)); 
                $fourth_column = "'". $result->kr0002; 
                $fifth_column = ($result->kr0008 == '50') ? '13' : '10'; 
                $sixth_column = $result->kr0010;
                $seventh_column = $result->kr0057;
                $eighth_column = $result->kr0033;
                $ninth_column = $result->kr0034;

                $csv_array = [
                    $first_column, // 1 DATA区分
                    $second_column, // 2 取引先CD
                    $third_column, // 3 伝票日付
                    $fourth_column, // 4 伝票No
                    $fifth_column, // 5 伝票区分
                    $sixth_column, // 6 担当CD
                    $seventh_column, // 7 受注No
                    $eighth_column, // 8 金額
                    $ninth_column, // 9 消費税額
                ];

                $export .= implode(",",$csv_array)."\r\n";
            }
        }

        $export = mb_convert_encoding($export,"SJIS", "UTF-8");
       /* header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename='.$file_name);
        ob_end_clean();
        echo $export;
        exit();*/

        return $export;
    }

    private function tmeiseiCsvCreation(Request $request){
        $man_power_management_data_creation_102 = $request->man_power_management_data_creation_102;
        $sql = "";
        if($man_power_management_data_creation_102 == 1){
            $sql .= " kr0071 = '2'";
        }else{
           if($man_power_management_data_creation_102 == 2 || $man_power_management_data_creation_102 == 3){
                $sql .= " kr0071 = '1'";
            }else{
                $sql .= " kr0071 = '2'";
            }
        }

        

        $man_power_management_data_creation_105_1 = date("Y-m-d 00:00:00", strtotime($request->man_power_management_data_creation_105_1));
        $man_power_management_data_creation_105_2 = date("Y-m-d 23:59:59", strtotime($request->man_power_management_data_creation_105_2));

        QueryHelper::runQuery("DROP TABLE IF EXISTS man_power_management_data_creation_table");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE man_power_management_data_creation_table as
            select  
            kr0001,
            kr0002,
            kr0003,
            kr0004,
            kr0005,
            kr0006,
            kr0008,
            max(kr0010) as kr0010,
            max(kr0012) as kr0012,
            max(kr0016) as kr0016,
            kr0017,
            kr0018,
            kr0024,
            kr0025,
            kr0026,
            kr0027,
            max(kr0033) as kr0033,
            max(kr0034) as kr0034,
            kr0040,
            kr0055,
            kr0056,
            max(kr0057) as kr0057,
            max(kr0070) as kr0070,
            max(kr0071) as kr0071,
            kr0111


            from rireki
            where 
            (kr0040 >= '$man_power_management_data_creation_105_1' and
            kr0040 <= '$man_power_management_data_creation_105_2') and
            (kr0070 = '1' or kr0070='-1') and
            -- ((kr0001 = 'V820' and kr0008 !='U160') or (kr0001 = 'V840' and kr0008 !='U170')) and
            (kr0001 = 'V820' or kr0001 = 'V840') and (kr0008 !='U160' and kr0008 !='U170') and
            $sql

            group by kr0001, kr0002, kr0005, kr0006, kr0008, kr0012, kr0016, kr0017, kr0018, kr0024, kr0025, kr0026, kr0027, kr0040, kr0003, kr0004, kr0055, kr0056, kr0111
            order by kr0001, kr0002, kr0005, kr0006, kr0003, kr0004");

        $query = DB::table('man_power_management_data_creation_table')->toSql();

        $query_result = QueryHelper::fetchResult($query);
        $file_name = mb_convert_encoding("tmeisei_".date("YmdHis").".csv","SJIS", "UTF-8");


        $export = implode(",",self::BILLING_HEADERS_TMEISEI_CSV)."\n";

        // echo "<pre>";
        // var_dump($query_result);
        foreach($query_result as $result) {
            $first_column = "";
            $second_column = "";
            $third_column = "";
            $fourth_column = "";
            $fifth_column = "";
            $sixth_column = "";
            $seventh_column = "";
            $eighth_column = "";
            $ninth_column = "";
            $tenth_column = "";
            $eleventh_column = "";
            $twelve_column = "";
            $thirteen_column = "";
            $fourteen_column = "";
            $fifteen_column = "";

        
            if($result->kr0001 == 'V840'){
                $first_column = '3';
                //$second_column = "'". substr($result->kr0002, 0, 8); 
                $second_column = "'". $result->kr0002; 
                $third_column = $result->kr0003; 
                $fourth_column = $result->kr0004; 
                $fifth_column = $result->kr0016; 
                $sixth_column = $result->kr0017; 
                $seventh_column = $result->kr0018; 
                $eighth_column = ($result->kr0070 * $result->kr0025); 
                $ninth_column = $result->kr0026; 
                $tenth_column = $result->kr0024; 
                $eleventh_column = ($result->kr0070 * $result->kr0027); 
                $twelve_column = "'". $result->kr0057; 
                $thirteen_column = $result->kr0055; 
                $fourteen_column = $result->kr0056; 
                $fifteen_column = $result->kr0111; 
            }

            // else{
            //     if($result->kr0001 == 'V820'){
            //         if($result->kr0008 == '20' || $result->kr0008 == '22' || $result->kr0008 = '23'){
            //             $first_column = '7';
            //         }else{
            //             $first_column = '1';
            //         }

            //         $second_column = substr($result->kr0012, 0, 6); 
            //         $third_column = date('y/m/d', strtotime($result->kr0040)); 
            //         $fourth_column = $result->kr0002; 
            //         $fifth_column = ($result->kr0008 == '50') ? '13' : '10'; 
            //         $sixth_column = $result->kr0010;
            //         $seventh_column = $result->kr0057;
            //         $eighth_column = $result->kr0033;
            //         $ninth_column = $result->kr0034;
            //     }
            // }

            $csv_array = [
                $first_column, // 1 DATA区分
                $second_column, // 2 伝票No
                $third_column, // 3 行No
                $fourth_column, // 4 枝番
                $fifth_column, // 5 大分類CD
                $sixth_column, // 6 中分類CD
                $seventh_column, // 7 明細内容
                $eighth_column, // 8 数量
                $ninth_column, // 9 単位
                $tenth_column, // 10 単価
                $eleventh_column, // 11 金額
                $twelve_column, // 12 受注No
                $thirteen_column, // 13 科目CD
                $fourteen_column, // 14 内訳CD
                $fifteen_column, // 15 商品分類3
            ];

            $export .= implode(",",$csv_array)."\r\n";
        }

        $export = mb_convert_encoding($export,"SJIS", "UTF-8");
       /* header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename='.$file_name);
        ob_end_clean();
        echo $export;
        exit();*/

        return $export;
    }
}