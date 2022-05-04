<?php

namespace App\Http\Controllers\sales;
use Illuminate\Http\Request;
use App\tantousya;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\sales\accountingDataCreation\ValidateAccountingDataCreation;
use App\AllClass\sales\accountingDataCreation\TxtFormat_1;
use App\AllClass\sales\accountingDataCreation\TxtFormat_2;
use App\AllClass\sales\accountingDataCreation\TxtFormat_3;
use App\AllClass\sales\accountingDataCreation\TxtFormat_4;
use App\AllClass\sales\accountingDataCreation\TxtFormat_1_3_updateBangos;
use App\AllClass\sales\accountingDataCreation\TxtFormat_2_updateBangos;
use App\AllClass\sales\accountingDataCreation\TxtFormat_4_updateBangos;
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

class AccountingDataCreationController extends Controller
{
    private $headers = ['会社コード','伝票日付','整理月フラグ','伝票番号','借方部門コード','借方科目コード','借方枝番コード','借方税率','借方課税区分','貸方部門コード','貸方科目コード','貸方枝番コード','貸方税率','貸方課税区分','分離区分','消費税対象科目','金額','摘要','借方 軽減税率区分','貸方 軽減税率区分','消費税対象 軽減税率区分','余白'];

    public function index(Request $request){
        $bango = request('userId');
        $tantousya = tantousya::find($bango);
        $input = $request->all();
        
        if($request->ajax()){
            $validator = ValidateAccountingDataCreation::validate($request,$bango);
            $errors = $validator->errors();
            if($errors->any()){ 
                $err_msgs = $errors->all();
                return ['err_field' => $errors, 'err_msg' => $err_msgs];
            }else if(!$errors->any() && request('submit_confirmation') == ""){
               return "confirmation_msg";
            }else{
                $headers = $this->headers;
                
                //update hikiatesyukko where dataint03 = 3
                $hikiatesyukkoData = QueryHelper::fetchResult("select orderbango,dataint03 from hikiatesyukko where hikiatesyukko.dataint03 = 3");
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
                    
                    //write txtformat_1 data
                    foreach($txt_format_1_data as $key=>$value){
                        if($value->text1 == 'U523' && $value->unsoudaibikitesuryou == 1 && $value->unsoutesuryou == 2 && $value->dataint01 == 1){
                            //write nothing,this data exist in text format 4
                        }else{
                            $txt .= "0501";
                            $txt .= $value->intorder03;
                            $txt .= $sort_jounal;
                            $txt .= "99999999";
                            $txt .= "    ";
                            $txt .= "001170";
                            $txt .= "      ";
                            $txt .= "        ";
                            $txt .= "100";
                            $txt .= str_pad($value->patternsub2,4,0,STR_PAD_LEFT);
                            $txt .= "004100";
                            $txt .= "      ";
                            $txt .= $value->category5; //貸方税率
                            $txt .= "002";
                            $txt .= "0";
                            $txt .= "      ";
                            //$txt .= $value->sum_of_dataint04;
                            $txt .= str_pad($value->sum_of_datachar19,13,0,STR_PAD_LEFT);
                            $txt .= "                              ";
                            $txt .= " ";
                            $txt .= $value->checking_patternsub2 == '081'?0:" ";
                            $txt .= " ";
                            $txt .= "                                                                                                                        ";
                            $txt .= "\r\n";
                            
                            //write txtformat_3 data
                            $value3 = $txt_format_3_data[$key];
                            $txt .= "0501";
                            $txt .= $value3->intorder03;
                            $txt .= $sort_jounal;
                            $txt .= "99999999";
                            $txt .= "    ";
                            $txt .= "001170";
                            $txt .= "      ";
                            $txt .= "        ";
                            $txt .= "100";
                            //$txt .= str_pad($value2->patternsub2,4,0,STR_PAD_LEFT);
                            $txt .= "    ";
                            $txt .= "003181";
                            $txt .= "      ";
                            $txt .= $value->category5; //貸方税率
                            $txt .= "100";
                            $txt .= "0";
                            $txt .= "004100";
                            $txt .= str_pad($value3->sum_of_datachar20,13,0,STR_PAD_LEFT);
                            $txt .= "                              ";
                            $txt .= " ";
                            $txt .= $value3->checking_patternsub2 == '081'?0:" ";
                            $txt .= $value3->checking_patternsub2 == '081'?0:" ";
                            $txt .= "                                                                                                                        ";
                            $txt .= "\r\n";
                            
                        }
                    }
                    
                    //write txtformat_3 data
                    //foreach($txt_format_3_data as $key3=>$value3){
                    //    if($value3->text1 == 'U523' && $value3->unsoudaibikitesuryou == 1 && $value3->unsoutesuryou == 2 && $value3->dataint01 == 1){
                    //        //write nothing,this data exist in text format 4
                    //    }else{
                    //        $txt .= "0501";
                    //        $txt .= $value3->intorder03;
                    //        $txt .= $sort_jounal;
                    //        $txt .= "99999999";
                    //        $txt .= "    ";
                    //        $txt .= "001170";
                    //        $txt .= "      ";
                    //        $txt .= "        ";
                    //        $txt .= "100";
                    //        //$txt .= str_pad($value2->patternsub2,4,0,STR_PAD_LEFT);
                    //        $txt .= "    ";
                    //        $txt .= "003181";
                    //        $txt .= "      ";
                    //        $txt .= "0.100000";
                    //        $txt .= "100";
                    //        $txt .= "0";
                    //        $txt .= "004100";
                    //        $txt .= str_pad($value3->sum_of_datachar20,13,0,STR_PAD_LEFT);
                    //        $txt .= "                              ";
                    //        $txt .= " ";
                    //        $txt .= $value3->checking_patternsub2 == '081'?0:" ";
                    //        $txt .= $value3->checking_patternsub2 == '081'?0:" ";
                    //        $txt .= "                                                                                                                        ";
                    //        $txt .= "\n";
                    //       
                    //    }
                    //}
                    
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
                        $txt .= "0501";
                        $txt .= $value2->intorder03;
                        $txt .= $sort_jounal;
                        $txt .= "99999999";
                        $txt .= "    ";
                        $txt .= "001170";
                        $txt .= "      ";
                        $txt .= "        ";
                        $txt .= "100";
                        $txt .= str_pad($value2->patternsub2,4,0,STR_PAD_LEFT);
                        $txt .= "004110";
                        $txt .= "      ";
                        $txt .= $value2->category5; //貸方税率
                        $txt .= "003";
                        $txt .= "0";
                        $txt .= "      ";
                        $txt .= str_pad($value2->sum_of_datachar19,13,0,STR_PAD_LEFT);
                        $txt .= "                              ";
                        $txt .= " ";
                        $txt .= " ";
                        $txt .= " ";
                        $txt .= "                                                                                                                        ";
                        $txt .= "\r\n";
                                           
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
                        $txt .= "    ";
                        $txt .= "003160";
                        $txt .= "      ";
                        $txt .= "        ";
                        $txt .= "100";
                        $txt .= "    ";
                        $txt .= "001170";
                        $txt .= "      ";
                        $txt .= "        "; //貸方税率
                        $txt .= "100";
                        $txt .= "0";
                        $txt .= "004100";
                        $txt .= str_pad(($value4->sum_of_datachar19 + $value4->sum_of_datachar20),13,0,STR_PAD_LEFT);
                        $txt .= "                              ";
                        $txt .= " ";
                        $txt .= $value4->checking_patternsub2 == '081'?0:" ";
                        $txt .= " ";
                        $txt .= "                                                                                                                        ";
                        $txt .= "\r\n";

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
            return view('sales.accountingDataCreation.mainAccountingDataCreation',compact('bango','tantousya')); 
        }
        
    }
    
    public function deleteTempFile(Request $request){
        $bango = request('userId');
        $filename = 'temp_file/'.request('filename');
         if(File::exists($filename)) {
            $success_msg = "処理が正常に終了しました。";
            Session::flash('success_msg', $success_msg);
            unlink($filename);
            return "ok";
        }
        return "not_found";
    }

}




