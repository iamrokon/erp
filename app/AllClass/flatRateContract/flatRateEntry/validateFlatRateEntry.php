<?php

namespace App\AllClass\flatRateContract\flatRateEntry;

use DB;
use Illuminate\Support\Facades\Validator;
use App\AllClass\specialCharValidation;
use App\AllClass\flatRateContract\flatRateEntry\specialCharValidation2;
use App\AllClass\Mobile;
use App\AllClass\zenkaku;
use App\AllClass\AlphanumericKatakanaSymbolValidation;
use Illuminate\Support\Facades\Input;

Class validateFlatRateEntry{
  public static function validate($request,$bango)
  { 
    $rules=[];
    
    $request['syukkasu'] = str_replace(',','',$request['syukkasu']);
    $request['money1'] = str_replace(',','',$request['money1']);
    $request['money2'] = str_replace(',','',$request['money2']);
    $request['money4'] = str_replace(',','',$request['money4']);
    $request['money5'] = str_replace(',','',$request['money5']);
    $request['money6'] = str_replace(',','',$request['money6']);
    $request['money7'] = str_replace(',','',$request['money7']);
    $request['money8'] = str_replace(',','',$request['money8']);
    //$no_of_month = self::countMonth(request('date0004'),request('date0005'));
    $no_of_month = $request['numeric8'] - $request['numeric9'];
    $request['temp_count_month'] = $no_of_month;
    
    $rules['information2'] = ['required'];
    $rules['information1'] = ['required'];
    $rules['information3'] = ['required'];
    $rules['information6'] = ['required'];
    $rules['datachar05'] = ['required'];
    $rules['kawasename'] = ['required','max:5','regex:/^[0-9]+$/'];
    $rules['syouhinname'] = ['required','max:40'];
    $rules['syukkasu'] = ['required','max:6','regex:/^[0-9]+$/'];
    $rules['money1'] = ['required','max:9','regex:/^[0-9,]+$/'];
    $rules['money2'] = ['max:9'];
    
    if(str_replace('/', '', request('date0002')) > str_replace('/', '', request('date0003'))){
       $rules['date0002'] = ['before:date0003'];
    }else{
        $rules['date0002'] = ['required'];
    }
    
    $rules['numeric8'] = ['required'];
    $rules['numeric10'] = [new CheckGreaterEqual($request['numeric10'],$no_of_month),new CheckIsDivisible($request['numeric10'],$no_of_month)]; 
    if(request('numeric8') != ""){
        $rules['numeric9'] = ['required','max:2','lt:numeric8','regex:/^[0-9]+$/'];
    }else{
        $rules['numeric9'] = ['required','max:2','regex:/^[0-9]+$/'];
    }
    
    //maintenance popup field validation starts here
    $rules['datatxt0124'] = ['required'];
    $rules['numericmax'] = ['required','max:3','regex:/^[0-9]+$/'];
    $rules['datatxt0123'] = ['nullable'];
    $rules['datatxt0120'] = ['nullable','max:20','regex:/^[a-zA-Z0-9 ]+$/'];
    //maintenance popup field validation ends here
    
    //order shipping popup field validation starts here
    $rules['datachar03'] = ['nullable','max:13',new specialCharValidation2,new AlphanumericKatakanaSymbolValidation];
    $rules['datachar04'] = ['nullable','max:40',new zenkaku];
    $rules['dataint09'] = ['required'];
    $rules['dataint10'] = ['required'];
    $rules['datachar06'] = ['required'];
    $rules['datachar07'] = ['nullable','max:60',new zenkaku];
    //order shipping popup field validation ends here
    
    $rules['datachar08.*'] = ['max:40'];
    
    if($request['money5'] > 0){
        $rules['datachar02'] = ['required'];
    }
    $rules['money4'] = ['max:9'];
    $rules['money5'] = ['max:9'];
    $rules['money6'] = ['max:9'];
    $rules['money7'] = ['max:9'];
    $rules['money8'] = ['max:9'];
    
//    if(Input::has('field')){
//        $rules['urlsm'] = ['required','max:50',new zenkaku];
//    }else{
//        $rules['urlsm'] = ['required','max:50',new specialCharValidation,new zenkaku];
//    }
       

    $message=[];    
    $message['required']='【:attribute】正しく入力されていません。';
    $message['datatxt0124.required']='【:attribute】該当するデータがありません。';
    $message['datachar06.required']='【:attribute】該当するデータがありません。';
    $message['unique']='【:attribute】の入力が重複しています。';
    $message['max']='【:attribute】:max桁以下で入力してください。';
    $message['money2.max']='【:attribute】最大桁数は９桁です。';
    $message['money4.max']='【:attribute】最大桁数は９桁です。';
    $message['min']='【:attribute】の入力は:min文字以上必要です。';
    $message['innerlevel.max']='【:attribute】の入力形式が間違っています。';
    $message['regex']='【:attribute】半角数字以外は使用できません。';
    $message['datatxt0120.regex']='【:attribute】半角英数字以外は使用できません。';
    $message['numeric']='【:attribute】入力形式が間違っています。';
    $message['email']='【:attribute】の入力形式が間違っています。';
    $message['date']='【:attribute】入力形式が間違っています。';
    $message['mbcatch.regex']='【:attribute】入力形式が間違っています。';
    $message['mbcatchsm.regex']='【:attribute】入力形式が間違っています。';
    $message['date_format']='【:attribute】yyyy/mm/ddの形式で入力してください。';
    $message['before']='【:attribute】終了日は開始日より後の日付を選択してください。';
    $message['after']='【:attribute】開始年月より過去の年月は設定できません。';
    $message['url.regex']='【:attribute】半角数字以外は使用できません。';
    $message['mbcatch.date_format']='【:attribute】入力形式が間違っています。';
    $message['mbcatchsm.date_format']='【:attribute】入力形式が間違っています。';
    $message['numeric9.lt']='【:attribute】契約期間の月数の範囲内で入力してください。';
    

    $attributes = [
        'information2' => '売上請求先',
        'information1' => '受注先',
        'information3' => '最終顧客',
        'information6' => '請求書送付先',
        'datachar05' => '担当',
        'kawasename' => '商品CD',
        'syouhinname' => '商品名',
        'syukkasu' => '数量',
        'money1' => '単価',
        'money2' => '契約金額',
        'date0002' => '契約期間',
        'numeric8' => '契約月数',
        'datatxt0124' => '保守窓口',
        'numericmax' => '窓口数',
        'datatxt0123' => '保守会社',
        'datatxt0120' => '保証書番号',
        'datachar02' => 'SE',
        'numeric9' => '無償期間',
        'datachar08.*' => '明細備考',
        'numeric10' => '請求サイクル',
        'datachar03' => 'メーカー品番',
        'datachar04' => 'メーカー品名',
        'dataint09' => '発注日',
        'dataint10' => '個別納期',
        'datachar06' => '納品先',
        'datachar07' => '発注出荷指示備考',
        'money4' => '営業粗利',
        'money5' => 'SE',
        'money6' => '研究所',
        'money7' => 'コール',
        'money8' => '仕入金額',
    ];
    
    //check front validation
    if(Input::has('field')){
        $front_field = explode(",",request('field'));
        foreach($rules as $key=>$val){
            if(!in_array($key, $front_field)){
                unset($rules[$key]);
            }
        }
    }

    $validator = Validator::make($request,$rules,$message,$attributes);    

    return $validator;
  }  
  
  public static function countMonth($date1,$date2){
    $date1 = strtotime($date1);
    $date2 = strtotime($date2);

    $year1 = date('Y', $date1);
    $year2 = date('Y', $date2);

    $month1 = date('m', $date1);
    $month2 = date('m', $date2);

    $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
    return $diff+1;
  }
  
} 
