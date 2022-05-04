<?php

namespace App\Http\Controllers\other;
use Illuminate\Http\Request;
use App\tantousya;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\other\allAccountingDataCreation\ValidateAccountingDataCreation;
use App\AllClass\sales\accountingDataCreation\TxtFormat_1;
use App\AllClass\sales\accountingDataCreation\TxtFormat_2;
use App\AllClass\sales\accountingDataCreation\TxtFormat_3;
use App\AllClass\sales\accountingDataCreation\TxtFormat_4;
use App\AllClass\sales\accountingDataCreation\TxtFormat_1_3_updateBangos;
use App\AllClass\sales\accountingDataCreation\TxtFormat_2_updateBangos;
use App\AllClass\sales\accountingDataCreation\TxtFormat_4_updateBangos;
use App\AllClass\sales\depositAccountDataCreation\allData;
use App\AllClass\other\allAccountingDataCreation\AllPurchaseData;
use App\AllClass\other\allAccountingDataCreation\AllPaymentData;
use Illuminate\Pagination\Paginator;
use App\AllClass\TableSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use App\Helpers\Helper;
use File;

class AllAccountingDataCreationController extends Controller
{
    private $headers = ['会社コード','伝票日付','整理月フラグ','伝票番号','借方部門コード','借方科目コード','借方枝番コード','借方税率','借方課税区分','貸方部門コード','貸方科目コード','貸方枝番コード','貸方税率','貸方課税区分','分離区分','消費税対象科目','金額','摘要','借方 軽減税率区分','貸方 軽減税率区分','消費税対象 軽減税率区分','余白'];

    public function index(Request $request){
        $bango = request('userId');
        $tantousya = tantousya::find($bango);
        $input = $request->all();
       
        if($request->ajax()){
            if(request('rd3_1') == "" && request('rd3_2') == "" && request('rd3_3') == "" && request('rd3_4') == ""){
                return "no_selection";
            }
            $validator = ValidateAccountingDataCreation::validate($request,$bango);
            $errors = $validator->errors();
            if($errors->any()){ 
                $err_msgs = $errors->all();
                return ['err_field' => $errors, 'err_msg' => $err_msgs];
            }else if(!$errors->any() && request('submit_confirmation') == ""){
               return "confirmation_msg";
            }else{
                $headers = $this->headers;
                $query = TxtFormat_1::data($bango,$input)->toSql();
                $txt_format_1_data = QueryHelper::fetchResult($query);
                $query13 = TxtFormat_1_3_updateBangos::data($bango,$input)->toSql();
                $txt13UpdateBangos = QueryHelper::fetchResult($query13);
                
                $query2 = TxtFormat_2::data($bango,$input)->toSql();
                $txt_format_2_data = QueryHelper::fetchResult($query2);
                $temp_query2 = TxtFormat_2_updateBangos::data($bango,$input)->toSql();
                $txt2UpdateBangos = QueryHelper::fetchResult($temp_query2);
                
                $query3 = TxtFormat_3::data($bango,$input)->toSql();
                $txt_format_3_data = QueryHelper::fetchResult($query3);
                
                $query4 = TxtFormat_4::data($bango,$input)->toSql();
                $txt_format_4_data = QueryHelper::fetchResult($query4);
                $temp_query4 = TxtFormat_4_updateBangos::data($bango,$input)->toSql();
                $txt4UpdateBangos = QueryHelper::fetchResult($temp_query4);
                
                $total_data = count($txt_format_1_data)+count($txt_format_2_data)+count($txt_format_3_data)+count($txt_format_4_data);
                
                if($total_data > 0){
                    $hikiatesyukkoData = QueryHelper::fetchResult("select orderbango,dataint03 from hikiatesyukko where hikiatesyukko.dataint03 = 3");
                    //update hikiatesyukko where dataint03 = 3
                    if(request('rd2') == 'rd2_1'){
                        foreach($hikiatesyukkoData as $update_k1=>$update_v1){
                            $hikiatesyukko_update_data = [
                                'orderbango' => $update_v1->orderbango,
                                'dataint03' => 1,
                                'idoutanabango' => Carbon::now()->setTimezone("Asia/Tokyo")->format('YmdHis'),
                                'tantousyabango' => $bango
                            ];
                            $hikiatesyukkoUpdate = QueryHelper::updateData('hikiatesyukko', $hikiatesyukko_update_data, 'orderbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                        }
                    }
                }
                
                    //file generation starts here
                    $txt = "";
                    
                    $rd1 = $input['rd1'];
                    if($rd1 == 'rd1_1'){
                       $sort_jounal = 0; 
                    }else{
                       $sort_jounal = 1; 
                    }
                    
                    if(request('rd2') == 'rd2_1'){
                        $hikiatesyukko_dataint03 = 1;
                    }else{
                        $hikiatesyukko_dataint03 = 3;
                    }
                    

                    //rd3_1 starts
                    if(isset($input['rd3_1']) && $input['rd3_1'] == 'rd3_1'){
                        //write txtformat_1 data
                        foreach($txt_format_1_data as $key=>$value){
                            if($value->text1 == 'U523' && $value->unsoudaibikitesuryou == 1 && $value->unsoutesuryou == 2 && $value->dataint01 == 1){
                                //write nothing,this data exist in text format 4
                            }else{
                                $txt .= "0501"; //SW0001
                                $txt .= $value->intorder03; //SW0002
                                $txt .= $sort_jounal; //SW0003
                                $txt .= "99999999"; //SW0004
                                $txt .= "    "; //SW0005
                                $txt .= "001170"; //SW0006
                                $txt .= "      "; //SW0007
                                $txt .= "        "; //SW0008
                                $txt .= "100"; //SW0009
                                $txt .= str_pad($value->patternsub2,4,0,STR_PAD_LEFT); //SW0010
                                $txt .= "004100"; //SW0011
                                $txt .= "      "; //SW0012
                                //$txt .= "0.100000"; //貸方税率
                                $txt .= $value->category5; //貸方税率 //SW0013
                                $txt .= "002"; //SW0014
                                $txt .= "0"; //SW0015
                                $txt .= "      "; //SW0016
                                //$txt .= $value->sum_of_dataint04;
                                $txt .= str_pad($value->sum_of_datachar19,13,0,STR_PAD_LEFT); //SW0017
                                $txt .= "                              "; //SW0018
                                $txt .= " "; //SW0019
                                $txt .= $value->checking_patternsub2 == '081'?0:" "; //SW0020
                                $txt .= " "; //SW0021
                                $txt .= "                                                                                                                        "; //SW0022
                                $txt .= "\r\n"; //SW0023

                                //write txtformat_3 data
                                $value3 = $txt_format_3_data[$key];
                                $txt .= "0501"; //SW0001
                                $txt .= $value3->intorder03; //SW0002
                                $txt .= $sort_jounal; //SW0003
                                $txt .= "99999999"; //SW0004
                                $txt .= "    "; //SW0005
                                $txt .= "001170"; //SW0006
                                $txt .= "      "; //SW0007
                                $txt .= "        "; //SW0008
                                $txt .= "100"; //SW0009
                                //$txt .= str_pad($value2->patternsub2,4,0,STR_PAD_LEFT);
                                $txt .= "    "; //SW0010
                                $txt .= "003181"; //SW0011
                                $txt .= "      "; //SW0012
                                $txt .= $value->category5; //SW0013
                                $txt .= "100"; //SW0014
                                $txt .= "0"; //SW0015
                                $txt .= "004100"; //SW0016
                                $txt .= str_pad($value3->sum_of_datachar20,13,0,STR_PAD_LEFT); //SW0017
                                $txt .= "                              "; //SW0018
                                $txt .= " "; //SW0019
                                $txt .= $value3->checking_patternsub2 == '081'?0:" "; //SW0020
                                $txt .= $value3->checking_patternsub2 == '081'?0:" "; //SW0021
                                $txt .= "                                                                                                                        "; //SW0022
                                $txt .= "\r\n"; //SW0023

                            }
                        }
                        
                        //update hikiatesyukko for txt format 1&3
                        if(request('rd2') == 'rd2_1'){
                            foreach($txt13UpdateBangos as $update_key1=>$update_value1){
                                if($update_value1->text1 == 'U523' && $update_value1->unsoudaibikitesuryou == 1 && $update_value1->unsoutesuryou == 2 && $update_value1->dataint01 == 1){
                                    //write nothing,this data exist in text format 4
                                }else{
                                    $hikiatesyukko_update_data = [
                                        'orderbango' => $update_value1->bango,
                                        'dataint03' => 3,
                                        'idoutanabango' => Carbon::now()->setTimezone("Asia/Tokyo")->format('YmdHis'),
                                        'tantousyabango' => $bango
                                    ];
                                    $hikiatesyukkoUpdate = QueryHelper::updateData('hikiatesyukko', $hikiatesyukko_update_data, 'orderbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                                }
                            }
                        }

                        //write txtformat_2 data
                        foreach($txt_format_2_data as $key2=>$value2){
                            $txt .= "0501"; //SW0001
                            $txt .= $value2->intorder03; //SW0002
                            $txt .= $sort_jounal; //SW0003
                            $txt .= "99999999"; //SW0004
                            $txt .= "    "; //SW0005
                            $txt .= "001170"; //SW0006
                            $txt .= "      "; //SW0007
                            $txt .= "        "; //SW0008
                            $txt .= "100"; //SW0009
                            $txt .= str_pad($value2->patternsub2,4,0,STR_PAD_LEFT); //SW0010
                            $txt .= "004110"; //SW0011
                            $txt .= "      "; //SW0012
                            $txt .= $value2->category5; //SW0013
                            $txt .= "003"; //SW0014
                            $txt .= "0"; //SW0015
                            $txt .= "      "; //SW0016
                            $txt .= str_pad($value2->sum_of_datachar19,13,0,STR_PAD_LEFT); //SW0017
                            $txt .= "                              "; //SW0018
                            $txt .= " "; //SW0019
                            $txt .= " "; //SW0020
                            $txt .= " "; //SW0021
                            $txt .= "                                                                                                                        "; //SW0022
                            $txt .= "\r\n"; //SW0023

                        }

                        //update hikiatesyukko for txt format 2
                        if(request('rd2') == 'rd2_1'){
                            foreach($txt2UpdateBangos as $update_key2=>$update_value2){
                                $hikiatesyukko_update_data2 = [
                                    'orderbango' => $update_value2->bango,
                                    'dataint03' => 3,
                                    'idoutanabango' => Carbon::now()->setTimezone("Asia/Tokyo")->format('YmdHis'),
                                    'tantousyabango' => $bango
                                ];
                                $hikiatesyukkoUpdate = QueryHelper::updateData('hikiatesyukko', $hikiatesyukko_update_data2, 'orderbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                            }
                        }
                        
                        //write txtformat_4 data
                        foreach($txt_format_4_data as $key4=>$value4){
                            $txt .= "0501"; //SW0001
                            $txt .= $value4->intorder03; //SW0002
                            $txt .= $sort_jounal; //SW0003
                            //$txt .= substr($value4->datachar10,2, (strlen($value4->datachar10)-2)); //SW0004
                            $txt .= substr($value4->datachar10,0,2).substr($value4->datachar10,4,6); //SW0004
                            $txt .= "    "; //SW0005
                            $txt .= "003160"; //SW0006
                            $txt .= "      "; //SW0007
                            $txt .= "        "; //SW0008
                            $txt .= "100"; //SW0009
                            $txt .= "    "; //SW0010
                            $txt .= "001170"; //SW0011
                            $txt .= "      "; //SW0012
                            $txt .= "        "; //SW0013
                            $txt .= "100"; //SW0014
                            $txt .= "0"; //SW0015
                            $txt .= "004100"; //SW0016
                            $txt .= str_pad(($value4->sum_of_datachar19 + $value4->sum_of_datachar20),13,0,STR_PAD_LEFT); //SW0017
                            $txt .= "                              "; //SW0018
                            $txt .= " "; //SW0019
                            $txt .= $value4->checking_patternsub2 == '081'?0:" "; //SW0020
                            $txt .= " "; //SW0021
                            $txt .= "                                                                                                                        "; //SW0022
                            $txt .= "\r\n"; //SW0023

                        }

                        
                        //update hikiatesyukko for txt format 4
                        if(request('rd2') == 'rd2_1'){
                            foreach($txt4UpdateBangos as $temp_key4=>$temp_value4){
                                $hikiatesyukko_update_data4 = [
                                    'orderbango' => $temp_value4->bango,
                                    'dataint03' => 3,
                                    'idoutanabango' => Carbon::now()->setTimezone("Asia/Tokyo")->format('YmdHis'),
                                    'tantousyabango' => $bango
                                ];
                                $hikiatesyukkoUpdate = QueryHelper::updateData('hikiatesyukko', $hikiatesyukko_update_data4, 'orderbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                            }
                        }
                        
                    }
                    //rd3_1 ends
                    
                    //rd3_2 starts
                    if(isset($input['rd3_2']) && $input['rd3_2'] == 'rd3_2'){
                        $current_date = Carbon::now()->setTimezone("Asia/Tokyo")->format('Y-m-d H:i:s');
                        $rd2 = request('rd2') == 'rd2_1' ? 'new' : '';
                        $query = allData::data(request('intorder03_start'),request('intorder03_end'),$rd2);
                        $query_result = QueryHelper::fetchResult($query);
                        if($rd2 == 'new') {
                            //update hikiatesyukko where dataint03 = 3
                            $eczaikorendouData = QueryHelper::fetchResult("select sitename,tsuchimail from eczaikorendou where eczaikorendou.tsuchimail = '3'");
                            if(count($query_result) > 0){
                                foreach($eczaikorendouData as $update_k2=>$update_v2){
                                    $eczaikorendou_update_data = [
                                        'sitename' => $update_v2->sitename,
                                        'tsuchimail' => 1,
                                        'apitime01' => $current_date,
                                        'apiid01' => $bango
                                    ];
                                    $eczaikorendouUpdate = QueryHelper::updateData('eczaikorendou', $eczaikorendou_update_data, 'sitename', $bango, __CLASS__, __FUNCTION__, __LINE__);
                                }
                            }
                            allData::flag_raise($query_result, '3', $bango, $current_date);
                        }else{
                            //allData::flag_raise($query_result, '3', $bango, $current_date);
                        }
                        foreach($query_result as $result) {
                            $special1 = self::special1_generation($result->ck0003);
                            $special2 = self::special2_generation($result->ck0003,substr($result->ck0008,-2),substr($result->ck0009,-1));
                            $special3 = self::special3_generation($result->ck0003,$result->unsoudaibikitesuryou);

                            $a909 = ($result->ck0003 == "A909");
                            $SW0005 = $result->ck0003 == "A909" ? '0092' : '    ';

                            $result_array = [
                                '0501', //SW0001
                                str_replace('-', '', $result->ck0006), //SW0002
                                request('sort_method')=='normal'?'0':'1', //SW0003
                                substr($result->ck0001, 0, 2).substr($result->ck0001, -6,6), //SW0004
                                //'    ', //SW0005
                                $SW0005, //SW0005
                                $special1, //SW0006
                                $special2, //SW0007
                                $a909 ? '0.100000' : '        ', //SW0008
                                $a909 ? '001' : '100', //SW0009
                                '    ', //SW0010
                                $special3, //SW0011
                                '      ', //SW0012
                                $a909 ? '0.100000' : '        ', //SW0013
                                '100', //SW0014
                                $a909 ? '1' : '0', //SW0015
                                '      ', //SW0016
                                str_pad($result->ck0005,13,'0',STR_PAD_LEFT), //SW0017
                                '                              ', //SW0018
                                $a909 ? '0' : ' ', //SW0019
                                ' ', //SW0020
                                $a909 ? '0' : ' ', //SW0021
                                '                                                                                                                        ', //SW0022
                            ];
                            $txt .= implode($result_array)."\r\n"; //SW0023
                        }
                    }
                    //rd3_2 ends
                 
                    if($input['rd2'] == 'rd2_1'){
                        $hikiatenyuko_update_flag = 1;
                    }else{
                        $hikiatenyuko_update_flag = 3;
                    }
                 
                    //rd3_3 starts
                    if(isset($input['rd3_3']) && $input['rd3_3'] == 'rd3_3'){
                        $query = AllPurchaseData::data($bango, $input)->toSql();
                        $purchaseData = QueryHelper::fetchResult($query);
                        if(count($purchaseData) > 0){
                            //update hikiatenyuko where dataint01 = 3
                            $hikiatenyukoData = QueryHelper::fetchResult("select syouhinid,dataint01 from hikiatenyuko where hikiatenyuko.dataint01 = 3");
                            if(request('rd2') == 'rd2_1'){
                                foreach($hikiatenyukoData as $update_k3=>$update_v3){
                                    $hikiatenyuko_update_data = [
                                        'syouhinid' => $update_v3->syouhinid,
                                        'dataint01' => 1,
                                        'denpyoshimebi' => Carbon::now()->setTimezone("Asia/Tokyo")->format('Y-m-d H:i:s'),
                                        'tantousyabango' => $bango,
                                    ];
                                    $hikiatenyukoUpdate = QueryHelper::updateData('hikiatenyuko', $hikiatenyuko_update_data, 'syouhinid', $bango, __CLASS__, __FUNCTION__, __LINE__);
                                }
                            }
                        }
                        
                        foreach($purchaseData as $key5=>$value5){
                            $datachar18 = $value5->datachar18;
                            $barcode_short = $value5->barcode_short;
                            $sw0009 = "   ";
                            $sw0008 = "        ";
                            $sw0019 = " ";
                            $sw0021 = " ";
                            
                            if($datachar18 == 'E110'){
                                $sw0008 = "        ";
                                $sw0019 = " ";
                                $sw0021 = " ";
                            }elseif($datachar18 == 'E120'){
                                $sw0008 = "0.100000";
                                $sw0019 = "0";
                                $sw0021 = "0";
                            }elseif($datachar18 == 'E130'){
                                $sw0008 = "0.080000";
                                $sw0019 = "0";
                                $sw0021 = "0";
                            }elseif($datachar18 == 'E140'){
                                $sw0008 = "0.080000";
                                $sw0019 = "1";
                                $sw0021 = "1";
                            }else{
                                $sw0008 = "        ";
                                $sw0019 = " ";
                                $sw0021 = " ";
                            }
                            if($barcode_short == '01310' || $barcode_short == '02430'){
                                $sw0008 = "        ";
                                $sw0019 = " ";
                                $sw0021 = " ";
                            }
                            
                            
                            if($barcode_short == '02140' || $barcode_short == '02310' || $barcode_short == '02311' || $barcode_short == '02530'){
                                if($datachar18 == 'E110'){
                                   $sw0009 = "041"; 
                                }elseif($datachar18 == 'E120'){
                                    $sw0009 = "013";
                                }elseif($datachar18 == 'E130'){
                                    $sw0009 = "013";
                                }elseif($datachar18 == 'E140'){
                                    $sw0009 = "013";
                                }else{
                                    $sw0009 = "041";
                                }
                            }elseif($barcode_short == '01310' || $barcode_short == '02430'){
                                 $sw0009 = "100";
                            }else{
                                if($datachar18 == 'E110'){
                                   $sw0009 = "004"; 
                                }elseif($datachar18 == 'E120'){
                                    $sw0009 = "002";
                                }elseif($datachar18 == 'E130'){
                                    $sw0009 = "002";
                                }elseif($datachar18 == 'E140'){
                                    $sw0009 = "002";
                                }else{
                                    //if($barcode_short == '01310' || $barcode_short == '02430'){
                                    //    $sw0009 = "100";
                                    //}else{
                                        $sw0009 = "004";
                                    //}
                                }
                            }
                            
                            $tmp_barcode_short = (int) $barcode_short;
                            if(($tmp_barcode_short > 6001 && $tmp_barcode_short < 6999) 
                                || ($tmp_barcode_short > 96001 && $tmp_barcode_short < 9699)
                                || $barcode_short == '05120' || $barcode_short == '05121'
                                || $barcode_short == '05150' || $barcode_short == '05130'
                                || $barcode_short == '05160' || $barcode_short == '02140'
                                || $barcode_short == '02310' || $barcode_short == '02311'
                                || $barcode_short == '02310' || $barcode_short == '02530'
                                || $barcode_short == '01310' || $barcode_short == '02430'
                                || $barcode_short == '04120' || $barcode_short == '06250'
                            ){
                               //nothing changes
                            }else{
                                $sw0008 = "        ";
                                $sw0009 = "   ";
                            }
                            
                            //if( strpos($value5->syouhizeiritu, '-') !== false) {
                            //   $tmp_syouhizeiritu = str_replace("-",'',$value5->syouhizeiritu);
                            //   $syouhizeiritu = '-'.STR_PAD($tmp_syouhizeiritu,12,'0',STR_PAD_LEFT);
                            //}else{
                            //   $syouhizeiritu = STR_PAD($value5->syouhizeiritu,13,'0',STR_PAD_LEFT);
                            //}
                            if( strpos($value5->sum_of_soukobango, '-') !== false) {
                               $tmp_sum_of_soukobango = str_replace("-",'',$value5->sum_of_soukobango);
                               $sum_of_soukobango = '-'.STR_PAD($tmp_sum_of_soukobango,12,'0',STR_PAD_LEFT);
                            }else{
                               $sum_of_soukobango = STR_PAD($value5->sum_of_soukobango,13,'0',STR_PAD_LEFT);
                            }
                            if( strpos($value5->sum_of_syouhizeiritu, '-') !== false) {
                               $tmp_sum_of_syouhizeiritu = str_replace("-",'',$value5->sum_of_syouhizeiritu);
                               $sum_of_syouhizeiritu = '-'.STR_PAD($tmp_sum_of_syouhizeiritu,12,'0',STR_PAD_LEFT);
                            }else{
                               $sum_of_syouhizeiritu = STR_PAD($value5->sum_of_syouhizeiritu,13,'0',STR_PAD_LEFT);
                            } 
                            
                            if($value5->purchase_category == '10' || $value5->purchase_category == '20' || $value5->purchase_category == '23' || $value5->purchase_category == '40'){
                                $txt .= '0501'; //SW0001
                                $txt .= $value5->touchakudate_display; //SW0002
                                $txt .= $sort_jounal; //SW0003
                                $txt .= '99999999'; //SW0004
                                $txt .= STR_PAD($value5->treasury_division_cd,4,'0',STR_PAD_LEFT); //SW0005
                                $txt .= STR_PAD($value5->barcode_short,6,'0',STR_PAD_LEFT); //SW0006
                                $txt .= '      '; //SW0007
                                $txt .= $sw0008; //SW0008
                                $txt .= $sw0009; //SW0009
                                $txt .= '    '; //SW0010
                                $txt .= '003120'; //SW0011
                                $txt .= '      '; //SW0012
                                $txt .= '        '; //SW0013
                                $txt .= '100'; //SW0014
                                $txt .= '0'; //SW0015
                                $txt .= '      '; //SW0016
                                //$txt .= $syouhizeiritu; //SW0017
                                $txt .= $sum_of_syouhizeiritu; //SW0017
                                $txt .= '                              '; //SW0018
                                $txt .= $sw0019; //SW0019
                                $txt .= ' '; //SW0020
                                $txt .= ' '; //SW0021
                                $txt .= '                                                                                                                        '; //SW0022
                                $txt .= "\r\n"; ////SW0023
                                
                                //消費税
                                $len = 30 - mb_strlen('仮払消費税（仕入）');
                                $SW0018_0 = STR_PAD('',$len,' ',STR_PAD_LEFT).'仮払消費税（仕入）';
                                $txt .= '0501'; //SW0001
                                $txt .= $value5->touchakudate_display; //SW0002
                                $txt .= $sort_jounal; //SW0003
                                $txt .= '99999999'; //SW0004
                                $txt .= '    '; //SW0005
                                $txt .= '001318'; //SW0006
                                $txt .= '      '; //SW0007
                                $txt .= $sw0008; //SW0008
                                $txt .= '100'; //SW0009
                                $txt .= '    '; //SW0010
                                $txt .= '003120'; //SW0011
                                $txt .= '      '; //SW0012
                                $txt .= '        '; //SW0013
                                $txt .= '100'; //SW0014
                                $txt .= '0'; //SW0015
                                $txt .= '006999'; //SW0016
                                //$txt .= $syouhizeiritu; //SW0017
                                $txt .= $sum_of_soukobango; //SW0017
                                $txt .= $SW0018_0; //SW0018
                                $txt .= $sw0019; //SW0019
                                $txt .= ' '; //SW0020
                                $txt .= $sw0021; //SW0021
                                $txt .= '                                                                                                                        '; //SW0022
                                $txt .= "\r\n"; //SW0023
                            }else{
                                $tmp_barcode_short = (int) $barcode_short;
                                if(($tmp_barcode_short > 6001 && $tmp_barcode_short < 6999) || ($tmp_barcode_short > 96001 && $tmp_barcode_short < 9699)){
                                    $tmp_sw0005 = $value5->codename_short;
                                }else{
                                    $tmp_sw0005 = '    ';
                                }
                                
                                if($barcode_short != '04120')
                                {   
                                    $tmp_datachar11 = mb_substr($value5->datachar11,0,30);
                                    $len = 30 - mb_strlen($tmp_datachar11);
                                    $SW0018_1 = STR_PAD('',$len,' ',STR_PAD_LEFT).$tmp_datachar11;
                                    $txt .= '0501'; //SW0001
                                    $txt .= $value5->touchakudate_display; //SW0002
                                    $txt .= $sort_jounal; //SW0003
                                    $txt .= $value5->sw0004; //SW0004
                                    //$txt .= $value5->codename == null ? '    ' : STR_PAD($value5->codename,4,'0',STR_PAD_LEFT); //SW0005
                                    $txt .= $tmp_sw0005; //SW0005
                                    $txt .= STR_PAD($value5->barcode_short,6,'0',STR_PAD_LEFT); //SW0006
                                    $txt .= '      '; //SW0007
                                    $txt .= $sw0008; //SW0008
                                    $txt .= $sw0009; //SW0009
                                    $txt .= '    '; //SW0010
                                    $txt .= '003140'; //SW0011
                                    $txt .= '000001'; //SW0012
                                    $txt .= '        '; //SW0013
                                    $txt .= '100'; //SW0014
                                    $txt .= '0'; //SW0015
                                    $txt .= '      '; //SW0016
                                    //$txt .= $syouhizeiritu; //SW0017
                                    $txt .= $sum_of_syouhizeiritu; //SW0017
                                    $txt .= $SW0018_1; //SW0018
                                    $txt .= $sw0019; //SW0019
                                    $txt .= ' '; //SW0020
                                    $txt .= ' '; //SW0021
                                    $txt .= '                                                                                                                        '; //SW0022
                                    $txt .= "\r\n"; //SW0023

                                    //消費税
                                    $len = 30 - mb_strlen('仮払消費税（購入）');
                                    $SW0018_2 = STR_PAD('',$len,' ',STR_PAD_LEFT).'仮払消費税（購入）';
                                    $txt .= '0501'; //SW0001
                                    $txt .= $value5->touchakudate_display; //SW0002
                                    $txt .= $sort_jounal; //SW0003
                                    $txt .= $value5->sw0004; //SW0004
                                    $txt .= '    '; //SW0005
                                    $txt .= '001318'; //SW0006
                                    $txt .= '      '; //SW0007
                                    $txt .= $sw0008; //SW0008
                                    $txt .= '100'; //SW0009
                                    $txt .= '    '; //SW0010
                                    $txt .= '003140'; //SW0011
                                    $txt .= '000001'; //SW0012
                                    $txt .= '        '; //SW0013
                                    $txt .= '100'; //SW0014
                                    $txt .= '0'; //SW0015
                                    //$txt .= '003140'; //SW0016
                                    $txt .= STR_PAD($value5->barcode_short,6,'0',STR_PAD_LEFT); //SW0016
                                    $txt .= $sum_of_soukobango; //SW0017
                                    $txt .= $SW0018_2; //SW0018
                                    $txt .= $sw0019; //SW0019
                                    $txt .= ' '; //SW0020
                                    $txt .= $sw0021; //SW0021
                                    $txt .= '                                                                                                                        '; //SW0022
                                    $txt .= "\r\n"; //SW0023
                                }
                                
                                if($barcode_short == '04120')
                                {
                                    if($value5->datatxt0003_text != null){
                                       $sw0005 =  $value5->datatxt0003_text;
                                    }else{
                                        $sw0005 = '    ';
                                    }
                                    //本体（売上割戻）
                                    $tmp_datachar11_2 = mb_substr($value5->datachar11,0,30);
                                    $len = 30 - mb_strlen($tmp_datachar11_2);
                                    $SW0018_3 = STR_PAD('',$len,' ',STR_PAD_LEFT).$tmp_datachar11_2;
                                    $txt .= '0501'; //SW0001
                                    $txt .= $value5->touchakudate_display; //SW0002
                                    $txt .= $sort_jounal; //SW0003
                                    $txt .= $value5->sw0004; //SW0004
                                    //$txt .= '    '; //SW0005
                                    $txt .= $sw0005; //SW0005
                                    $txt .= STR_PAD($value5->barcode_short,6,'0',STR_PAD_LEFT); //SW0006
                                    $txt .= '      '; //SW0007
                                    $txt .= $sw0008; //SW0008
                                    $txt .= $sw0009; //SW0009
                                    $txt .= '    '; //SW0010
                                    $txt .= '003140'; //SW0011
                                    $txt .= '000001'; //SW0012
                                    $txt .= '        '; //SW0013
                                    $txt .= '100'; //SW0014
                                    $txt .= '0'; //SW0015
                                    $txt .= '      '; //SW0016
                                    $txt .= $sum_of_syouhizeiritu; //SW0017
                                    $txt .= $SW0018_3; //SW0018
                                    $txt .= $sw0019; //SW0019
                                    $txt .= ' '; //SW0020
                                    $txt .= ' '; //SW0021
                                    $txt .= '                                                                                                                        '; //SW0022
                                    $txt .= "\r\n"; //SW0023

                                    //消費税（売上割戻）
                                    $len = 30 - mb_strlen('仮受消費税（購入）');
                                    $SW0018_4 = STR_PAD('',$len,' ',STR_PAD_LEFT).'仮受消費税（購入）';
                                    $txt .= '0501'; //SW0001
                                    $txt .= $value5->touchakudate_display; //SW0002
                                    $txt .= $sort_jounal; //SW0003
                                    $txt .= $value5->sw0004; //SW0004
                                    //$txt .= '    '; //SW0005
                                    $txt .= $sw0005; //SW0005
                                    $txt .= '003181'; //SW0006
                                    $txt .= '      '; //SW0007
                                    $txt .= $sw0008; //SW0008
                                    $txt .= '100'; //SW0009
                                    $txt .= '    '; //SW0010
                                    $txt .= '003140'; //SW0011
                                    $txt .= '000001'; //SW0012
                                    $txt .= '        '; //SW0013
                                    $txt .= '100'; //SW0014
                                    $txt .= '0'; //SW0015
                                    //$txt .= '003140'; //SW0016
                                    $txt .= STR_PAD($value5->barcode_short,6,'0',STR_PAD_LEFT); //SW0016
                                    $txt .= $sum_of_soukobango; //SW0017
                                    $txt .= $SW0018_4; //SW0018
                                    $txt .= $sw0019; //SW0019
                                    $txt .= ' '; //SW0020
                                    $txt .= $sw0021; //SW0021
                                    $txt .= '                                                                                                                        '; //SW0022
                                    $txt .= "\r\n"; //SW0023
                                }
                            }
                            
                            if(request('rd2') == 'rd2_1'){
                                $hikiatenyuko_update_data = [
                                    'syouhinid' => $value5->syouhinid,
                                    'dataint01' => 3,
                                    'denpyoshimebi' => Carbon::now()->setTimezone("Asia/Tokyo")->format('Y-m-d H:i:s'),
                                    'tantousyabango' => $bango,
                                ];
                                $hikiatenyukoUpdate = QueryHelper::updateData('hikiatenyuko', $hikiatenyuko_update_data, 'syouhinid', $bango, __CLASS__, __FUNCTION__, __LINE__);
                            }
                        }
                    }
                    
                    
                    //rd3_4 starts
                    if(isset($input['rd3_4']) && $input['rd3_4'] == 'rd3_4'){
                        $query2 = AllPaymentData::data($bango, $input)->toSql();
                        $paymentData = QueryHelper::fetchResult($query2);
                        if(count($paymentData) > 0){
                            //update hikiatenyuko where dataint01 = 3
                            $hikiatenyukoData2 = QueryHelper::fetchResult("select syouhinid,dataint01 from hikiatenyuko where hikiatenyuko.syouhinsyu = 3");
                            if(request('rd2') == 'rd2_1'){
                                foreach($hikiatenyukoData2 as $update_k4=>$update_v4){
                                    $hikiatenyuko_update_data2 = [
                                        'syouhinid' => $update_v4->syouhinid,
                                        'syouhinsyu' => 1,
                                        'denpyoshimebi' => Carbon::now()->setTimezone("Asia/Tokyo")->format('Y-m-d H:i:s'),
                                        'tantousyabango' => $bango,
                                    ];
                                    $hikiatenyukoUpdate = QueryHelper::updateData('hikiatenyuko', $hikiatenyuko_update_data2, 'syouhinid', $bango, __CLASS__, __FUNCTION__, __LINE__);
                                }
                            }
                        }
                        
                        foreach($paymentData as $key5=>$value5){
                            $datachar01_right = $value5->datachar01_right;
                            $datachar02_right = $value5->datachar02_right;
                            
                            //$tmp_sw0012 = "      ";
                            //if($datachar02_right == '01'){
                            //    $tmp_sw0012 = '000001';
                            //}elseif($datachar02_right == '02'){
                            //    $tmp_sw0012 = '000003';
                            //}elseif($datachar02_right == '03'){
                            //    $tmp_sw0012 = '000004';
                            //}elseif($datachar02_right == '04'){
                            //    $tmp_sw0012 = '000009';
                            //}
                            
                            $sw0010 = "    ";
                            $sw0011 = "      ";
                            $sw0012 = "      ";
                            $sw0013 = "        ";
                            //$sw0015 = "";
                            $sw0020 = "";
                            $sw0014 = "";
                            if($datachar01_right == '01'){
                                $sw0010 = "    ";
                                $sw0011 = "001120";
                                if($value5->datachar01 != 'D910'){
                                    //$sw0012 = $tmp_sw0012;
                                    $sw0012 = $value5->patternsub2 != null ? $value5->patternsub2 : '      ';
                                }else{
                                    $sw0012 = $value5->d910_patternsub2 != null ? $value5->d910_patternsub2 : '      ';
                                }
                                $sw0013 = "        ";
                                //$sw0015 = "0";
                                $sw0020 = " ";
                                $sw0014 = "100";
                            }elseif($datachar01_right == '02'){
                                $sw0010 = "    ";
                                $sw0011 = "001120";
                                if($value5->datachar01 != 'D910'){
                                    //$sw0012 = $tmp_sw0012;
                                    $sw0012 = $value5->patternsub2 != null ? $value5->patternsub2 : '      ';
                                }else{
                                    $sw0012 = $value5->d910_patternsub2 != null ? $value5->d910_patternsub2 : '      ';
                                }
                                $sw0013 = "        ";
                                $sw0015 = "0";
                                $sw0020 = " ";
                                $sw0014 = "100";
                            }elseif($datachar01_right == '03'){
                                $sw0010 = "    ";
                                $sw0011 = "003110";
                                if($value5->otherfloat1 == '1'){
                                    if($value5->other36 == null){
                                       $sw0012 = "      "; 
                                    }else{
                                       $sw0012 = "0".$value5->other36; 
                                    }
                                }else{
                                    $sw0012 = $value5->shikibetsucode;
                                }
                                $sw0013 = "        ";
                                //$sw0015 = "0";
                                $sw0020 = " ";
                                $sw0014 = "100";
                            }elseif($datachar01_right == '04'){
                                $sw0010 = "    ";
                                $sw0011 = "001120";
                                if($value5->datachar01 != 'D910'){
                                    //$sw0012 = $tmp_sw0012;
                                    $sw0012 = $value5->patternsub2 != null ? $value5->patternsub2 : '      ';
                                }else{
                                    $sw0012 = $value5->d910_patternsub2 != null ? $value5->d910_patternsub2 : '      ';
                                }
                                $sw0013 = "        ";
                                //$sw0015 = "0";
                                $sw0020 = " ";
                                $sw0014 = "100";
                            }elseif($datachar01_right == '06'){
                                $sw0010 = "0092";
                                $sw0011 = "006280";
                                $sw0012 = "      ";
                                $sw0013 = "0.100000";
                                //$sw0015 = "1";
                                $sw0020 = "0";
                                $sw0014 = "1";
                            }elseif($datachar01_right == '07'){
                                $sw0010 = "    ";
                                $sw0011 = "003170";
                                $sw0012 = "000002";
                                $sw0013 = "        ";
                                //$sw0015 = "0";
                                $sw0020 = " ";
                                $sw0014 = "100";
                            }elseif($datachar01_right == '08'){
                                $sw0010 = "    ";
                                $sw0011 = "001120";
                                if($value5->datachar01 != 'D910'){
                                    //$sw0012 = $tmp_sw0012;
                                    $sw0012 = $value5->patternsub2 != null ? $value5->patternsub2 : '      ';
                                }else{
                                    $sw0012 = $value5->d910_patternsub2 != null ? $value5->d910_patternsub2 : '      ';
                                }
                                $sw0013 = "        ";
                                $sw0015 = "0";
                                $sw0020 = " ";
                                $sw0014 = "100";
                            }elseif($datachar01_right == '09'){
                                $sw0010 = "    ";
                                $sw0011 = "001170";
                                $sw0012 = "      ";
                                $sw0013 = "        ";
                                //$sw0015 = "0";
                                $sw0020 = " ";
                                $sw0014 = "100";
                            }elseif($datachar01_right == '10'){
                                $sw0010 = "    ";
                                $sw0011 = "001120";
                                if($value5->datachar01 != 'D910'){
                                    //$sw0012 = $tmp_sw0012;
                                    $sw0012 = $value5->patternsub2 != null ? $value5->patternsub2 : '      ';
                                }else{
                                    $sw0012 = $value5->d910_patternsub2 != null ? $value5->d910_patternsub2 : '      ';
                                }
                                $sw0013 = "        ";
                                //$sw0015 = "0";
                                $sw0020 = " ";
                                $sw0014 = "100";
                            }
                            
                            if($value5->season == 1){
                                if($value5->datachar01 != 'D906')
                                {
                                    //支払（仕入）
                                    $txt .= '0501'; //SW0001
                                    $txt .= $value5->denpyohakkoubi_display; //SW0002
                                    $txt .= $sort_jounal; //SW0003
                                    $txt .= $value5->sw0004; //SW0004
                                    $txt .= '    '; //SW0005
                                    $txt .= '003120'; //SW0006
                                    $txt .= '      '; //SW0007
                                    $txt .= '        '; //SW0008
                                    $txt .= '100'; //SW0009
                                    $txt .= $sw0010; //SW0010
                                    $txt .= $sw0011; //SW0011
                                    $txt .= $sw0012; //SW0012
                                    $txt .= $sw0013; //SW0013
                                    $txt .= '100'; //SW0014
                                    $txt .= '0'; //SW0015
                                    $txt .= '      '; //SW0016
                                    $txt .= STR_PAD($value5->syouhizeiritu,13,'0',STR_PAD_LEFT); //SW0017
                                    $txt .= '                              '; //SW0018
                                    $txt .= ' '; //SW0019
                                    $txt .= $sw0020; //SW0020
                                    $txt .= ' '; //SW0021
                                    $txt .= '                                                                                                                        '; //SW0022
                                    $txt .= "\r\n"; //SW0023
                                }

                                if($value5->datachar01 == 'D906')
                                {
                                    //支払（仕入　支払手数料）
                                    $txt .= '0501'; //SW0001
                                    $txt .= $value5->denpyohakkoubi_display; //SW0002
                                    $txt .= $sort_jounal; //SW0003
                                    $txt .= $value5->sw0004; //SW0004
                                    $txt .= '    '; //SW0005
                                    $txt .= '003120'; //SW0006
                                    $txt .= '      '; //SW0007
                                    $txt .= '        '; //SW0008
                                    $txt .= '100'; //SW0009
                                    $txt .= '0092'; //SW0010
                                    $txt .= '006280'; //SW0011
                                    $txt .= '      '; //SW0012
                                    $txt .= '0.100000'; //SW0013
                                    $txt .= '001'; //SW0014
                                    $txt .= '1'; //SW0015
                                    $txt .= '      '; //SW0016
                                    $txt .= STR_PAD($value5->syouhizeiritu,13,'0',STR_PAD_LEFT); //SW0017
                                    $txt .= '                              '; //SW0018
                                    $txt .= ' '; //SW0019
                                    $txt .= '0'; //SW0020
                                    $txt .= ' '; //SW0021
                                    $txt .= '                                                                                                                        '; //SW0022
                                    $txt .= "\r\n"; //SW0023
                                }
                            }
                            
                            if($value5->season == 2){
                                if($value5->datachar01 != 'D906')
                                {
                                    //支払（購入）
                                    $txt .= '0501'; //SW0001
                                    $txt .= $value5->denpyohakkoubi_display; //SW0002
                                    $txt .= $sort_jounal; //SW0003
                                    $txt .= $value5->sw0004; //SW0004
                                    $txt .= '    '; //SW0005
                                    $txt .= '003140'; //SW0006
                                    $txt .= '000001'; //SW0007
                                    $txt .= '        '; //SW0008
                                    $txt .= '100'; //SW0009
                                    $txt .= $sw0010; //SW0010
                                    $txt .= $sw0011; //SW0011
                                    $txt .= $sw0012; //SW0012
                                    $txt .= $sw0013; //SW0013
                                    $txt .= '100'; //SW0014
                                    $txt .= '0'; //SW0015
                                    $txt .= '      '; //SW0016
                                    $txt .= STR_PAD($value5->syouhizeiritu,13,'0',STR_PAD_LEFT); //SW0017
                                    $txt .= '                              '; //SW0018
                                    $txt .= ' '; //SW0019
                                    $txt .= $sw0020; //SW0020
                                    $txt .= ' '; //SW0021
                                    $txt .= '                                                                                                                        '; //SW0022
                                    $txt .= "\r\n"; //SW0023
                                }

                                if($value5->datachar01 == 'D906')
                                {
                                    //支払（購入　支払手数料）
                                    $txt .= '0501'; //SW0001
                                    $txt .= $value5->denpyohakkoubi_display; //SW0002
                                    $txt .= $sort_jounal; //SW0003
                                    $txt .= $value5->sw0004; //SW0004
                                    $txt .= '    '; //SW0005
                                    $txt .= '003140'; //SW0006
                                    $txt .= '000001'; //SW0007
                                    $txt .= '        '; //SW0008
                                    $txt .= '100'; //SW0009
                                    $txt .= '0092'; //SW0010
                                    $txt .= '006280'; //SW0011
                                    $txt .= '      '; //SW0012
                                    $txt .= '0.100000'; //SW0013
                                    $txt .= '001'; //SW0014
                                    $txt .= '1'; //SW0015
                                    $txt .= '      '; //SW0016
                                    $txt .= STR_PAD($value5->syouhizeiritu,13,'0',STR_PAD_LEFT); //SW0017
                                    $txt .= '                              '; //SW0018
                                    $txt .= ' '; //SW0019
                                    $txt .= '0'; //SW0020
                                    $txt .= ' '; //SW0021
                                    $txt .= '                                                                                                                        '; //SW0022
                                    $txt .= "\r\n"; //SW0023
                                }
                            }
                            
                           if(request('rd2') == 'rd2_1'){ 
                                $hikiatenyuko_update_data = [
                                    'syouhinid' => $value5->hikiatenyuko_syouhinid,
                                    'syouhinsyu' => 3,
                                    'denpyoshimebi' => Carbon::now()->setTimezone("Asia/Tokyo")->format('Y-m-d H:i:s'),
                                    'tantousyabango' => $bango,
                                ];
                                $hikiatenyukoUpdate = QueryHelper::updateData('hikiatenyuko', $hikiatenyuko_update_data, 'syouhinid', $bango, __CLASS__, __FUNCTION__, __LINE__);
                            }
                        }
                    }
                    
                if($txt != ""){
                    $file_name = 'temp_file/'.date('YmdHms').'_'.$bango.'.txt';
                    $file_url[] = URL($file_name);
                    if (!file_exists('temp_file/'))
                    {
                        mkdir('temp_file/', 0777, true);
                    }
                    $file = fopen($file_name,'a');
                    fwrite($file,$txt);
                    fclose($file);
                    //file generation ends here
                    
                    return $file_url;
                }else{
                    return "no_data";
                }

            }
        }else{
            return view('other.allAccountingDataCreation.mainAllAccountingDataCreation',compact('bango','tantousya')); 
        }
    }
    
    public function deleteTempFile(Request $request){
        $bango = request('userId');
        $filename = 'temp_file/'.request('filename');
         if(File::exists($filename)) {
            $success_msg = "処理が正常に終了しました。";
            //Session::flash('success_msg', $success_msg);
            unlink($filename);
            return "ok";
        }
        return "not_found";
    }
    
    static function special1_generation($ck0003) {
        if($ck0003=='A902'||$ck0003=='A903'||$ck0003=='A907') return "001120";
        else if($ck0003=='A905') return "001160";
        else if($ck0003=='A906') return "003160";
        else if($ck0003=='A909') return "006280";
        else return "001110";
    }

    static function special2_generation($ck0003, $ck0008, $ck0009) {
        if($ck0003 == 'A902'||$ck0003 == 'A903'||$ck0003 == 'A907')
        {
            if($ck0003 == 'A902')
            {
                //if($ck0008 == '01' && $ck0009 == '1') return '000001';
                //if($ck0008 == '02' && $ck0009 == '2') return '000003';
                //if($ck0008 == '03' && $ck0009 == '3') return '000004';
                //if($ck0008 == '04' && $ck0009 == '4') return '000009';
                //$patternsub2 = QueryHelper::fetchSingleResult("select lpad(patternsub2,6,'0') as patternsub2 from categorykanri where category1 = 'A9' and category2 = '02'")->patternsub2 ?? null;
                $patternsub2 = QueryHelper::fetchSingleResult("select lpad(patternsub2,6,'0') as patternsub2 from categorykanri where category1 = 'H2' and category2 = '$ck0008'")->patternsub2 ?? null;
                return $patternsub2;
            }
            else if($ck0003 == 'A903')
            {
                //return '000003';
                $text = QueryHelper::fetchSingleResult("select lpad(text,6,'0') as text from categorykanri where category1 = 'A9' and category2 = '03'")->text ?? null;
                return $text;
            }
            else if($ck0003 == 'A907')
            {
                //return '000001';
                $text = QueryHelper::fetchSingleResult("select lpad(text,6,'0') as text from categorykanri where category1 = 'A9' and category2 = '07'")->text ?? null;
                return $text;
            }
        }
        return '      ';
    }

    static function special3_generation($ck0003, $unsoudaibikitesuryou) {
        if($unsoudaibikitesuryou == '1'){
            if($ck0003 == 'A907'){ 
                return '001160';
            }else{
                return '001170';
            }
        }else{
            if($ck0003 == 'A907'){ 
                return '      ';
            }else{
                return '003160';
            }
        }
//        if($unsoudaibikitesuryou == '2')
//        {
//            if(in_array($ck0003, ['A907'])) return '      ';
//            return '003160';
//        }
//        else
//        {
//            if(in_array($ck0003, ['A907'])) return '001160';
//            else return '001170';
//        }
//        return NULL;
    }

}




