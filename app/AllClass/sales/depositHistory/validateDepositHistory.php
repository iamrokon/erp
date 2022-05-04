<?php

namespace App\AllClass\sales\depositHistory;

use DB;
use Illuminate\Support\Facades\Validator;
use App\AllClass\specialCharValidation;
use App\AllClass\zenkaku;
use Illuminate\Support\Facades\Input;
//use App\AllClass\sales\salesHistory\CheckOrderbangoRange;

Class validateDepositHistory{
  public static function validate($request,$bango)
  {
    $request = $request->all();
    $rules=[];
    $message=[];
    $attr = "入金日";
    $attr2 = "処理日";

    // $rules['division_datachar05_start'] = ['required'];
    // $rules['division_datachar05_end'] = ['required'];
    //
    if(str_replace('/', '', request('torikomidate_start')) > str_replace('/', '', request('torikomidate_end'))){
      if(request('torikomidate_end') == ""){
       $request['torikomidate'] = request('torikomidate_start');
       $rules['torikomidate_end'] = ['before:torikomidate_end'];
       $message['torikomidate_end.before']='【:attribute】必須項目に入力がありません。';
       $attr = "入金日2";
      }else {
         $request['torikomidate'] = request('torikomidate_start');
         $rules['torikomidate'] = ['before:torikomidate_end'];
         $message['torikomidate.before']='【:attribute】正しい年月日を入力してください。';
      }
    }else{
        $rules['torikomidate_start'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
        $rules['torikomidate_end'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
    }
    if(str_replace('/', '', request('nyukinbi2_start')) > str_replace('/', '', request('nyukinbi2_end'))){
      if(request('nyukinbi2_end') == ""){
       $request['nyukinbi2'] = request('nyukinbi2_start');
       $rules['nyukinbi2_end'] = ['before:nyukinbi2_end'];
       $message['nyukinbi2_end.before']='【:attribute】必須項目に入力がありません。';
       $attr2 = "処理日2";
      }else {
       $request['nyukinbi2'] = request('nyukinbi2_start');
       $rules['nyukinbi2'] = ['before:nyukinbi2_end'];
       $message['nyukinbi2.before']='【:attribute】正しい年月日を入力してください。';
      }
    }else{
        $rules['nyukinbi2_start'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
        $rules['nyukinbi2_end'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
    }
    //
    // if(str_replace('/', '', request('intorder03_start')) > str_replace('/', '', request('intorder03_end'))){
    //    $request['intorder03'] = request('intorder03_start');
    //    $rules['intorder03'] = ['before:intorder03_end'];
    // }else{
    //     $rules['intorder03_start'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
    //     $rules['intorder03_end'] = ['required','max:10','date','regex:/^[0-9\/]+$/','date_format:Y/m/d'];
    // }
    // $rules['juchukubun_start'] = ['nullable','max:10','regex:/^[0-9]+$/',new CheckOrderbangoRange(request('juchukubun_start'),request('juchukubun_end'))];
    // if(request('juchukubun_start') == ""){
    //   $rules['juchukubun_end'] = ['nullable','max:10','regex:/^[0-9]+$/',new CheckOrderbangoRange(request('juchukubun_start'),request('juchukubun_end'))];
    // }

    $message['required']='【:attribute】必須項目に入力がありません。';
    $message['max']='【:attribute】:max桁以下で入力してください。';
    $message['min']='【:attribute】の入力は:min文字以上必要です。';
    $message['regex']='【:attribute】半角数字以外は使用できません。';
    $message['date']='【:attribute】入力形式が間違っています。';
    $message['date_format']='【:attribute】yyyy/mm/ddの形式で入力してください。';
    $message['before']='【:attribute】終売日より未来の日付は設定できません。';
    $message['after']='【:attribute】上市開始日より過去の日付は設定できません。';
    //$message['torikomidate.before']='【:attribute】正しい年月日を入力してください。';
    //$message['nyukinbi2.before']='【:attribute】正しい年月日を入力してください。';


    $attributes = [
        'torikomidate' => $attr,
        'torikomidate_start' => '入金日1',
        'torikomidate_end' => '入金日2',
        'nyukinbi2' => $attr2,
        'nyukinbi2_start' => '処理日1',
        'nyukinbi2_end' => '処理日2',
        // 'date' => '伝票日付',
        // 'date_start' => '処理日付1',
        // 'date_end' => '処理日付2',
        // 'intorder03' => '売上日',
        // 'intorder03_start' => '売上日1',
        // 'intorder03_end' => '売上日2',
        // 'juchukubun_start' => '売上番号',
        // 'juchukubun_end' => '売上番号',
        // 'information1_detail' => '受注先',
        // 'information2_detail' => '売上請求先',
        // 'information3_detail' => '最終顧客',
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
}
