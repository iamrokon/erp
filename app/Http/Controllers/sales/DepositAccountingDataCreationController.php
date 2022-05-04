<?php

namespace App\Http\Controllers\sales;

use App\tantousya;
use App\Http\Controllers\Controller;
use App\AllClass\sales\depositAccountDataCreation\allData;
use App\AllClass\sales\depositAccountDataCreation\validateData;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Carbon\Carbon;

class DepositAccountingDataCreationController extends Controller
{
	public function index()
    {
        $bango = request('userId');
        $tantousya = tantousya::find($bango);
        return view('sales.DepositAccountingDataCreation.index',compact('tantousya','bango'));
    }


    public function validation()
    {
        $validator = validateData::validate(request()->all());
        $errors = $validator->errors();
        if($errors->any()){
           $err_msg = $errors->all();
           return ['err_field'=>$errors,'err_msg'=>$err_msg];
        }
        $query = allData::data(request('date_start'),request('date_end'),request('creation_method'));
        $query_result = QueryHelper::fetchResult($query);
        if(is_array($query_result) && count($query_result)==0) return ['err_field'=>$errors,'err_msg'=>['該当するデータがありません']];
    	return 'ok';
    }

    public function download()
    {
        $current_date = Carbon::now()->setTimezone("Asia/Tokyo")->format('Y-m-d H:i:s');
        //update hikiatesyukko where dataint03 = 3
        $eczaikorendouData = QueryHelper::fetchResult("select sitename,tsuchimail from eczaikorendou where eczaikorendou.tsuchimail = '3'");
        if(request('creation_method')=='new'){
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
                        
        $query = allData::data(request('date_start'),request('date_end'),request('creation_method'));
        $query_result = QueryHelper::fetchResult($query);
        $bango = request('userId');
        if(request('creation_method')=='new'){ 
            allData::flag_raise($query_result, '3', $bango, $current_date);
        }else{
            //allData::flag_raise($query_result, '3', $bango, $current_date);
        }

        ob_clean();

        $export = '';

        foreach($query_result as $result) {
            $special1 = self::special1_generation($result->ck0003);
            $special2 = self::special2_generation($result->ck0003,substr($result->ck0008,-2),substr($result->ck0009,-1));
            $special3 = self::special3_generation($result->ck0003,$result->unsoudaibikitesuryou);

            $a909 = ($result->ck0003 == "A909");

            $result_array = [
                '0501',
                str_replace('-', '', $result->ck0006),
                request('sort_method')=='normal'?'0':'1',
                substr($result->ck0001, 0, 2).substr($result->ck0001, -6,6),
                '    ',
                $special1,
                $special2,
                $a909 ? '0.100000' : '        ',
                $a909 ? '001' : '100',
                '    ',
                $special3,
                '      ',
                $a909 ? '0.100000' : '        ',
                '100',
                $a909 ? '1' : '0',
                '      ',
                str_pad($result->ck0005,13,'0',STR_PAD_LEFT),
                '                              ',
                $a909 ? '0' : ' ',
                ' ',
                $a909 ? '0' : ' ',
                '                                                                                                                        ',
            ];
            $export .= implode($result_array)."\r\n";
        }

        $file = "shiwake-nyu.txt";
        $txt = fopen($file, "w") or die("Unable to open file!");
        fwrite($txt, $export);
        fclose($txt);

        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        header("Content-Type: text/plain");
        readfile($file);

        exit();
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
