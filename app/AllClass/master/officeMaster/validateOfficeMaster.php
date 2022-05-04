<?php

namespace App\AllClass\master\officeMaster;

use DB;
use App\AllClass\Mobile;
use App\AllClass\specialCharValidation;
use Illuminate\Support\Facades\Validator;
use App\AllClass\zenkaku;
use App\AllClass\CheckNumberHypen;
use App\AllClass\master\officeMaster\CheckSameValue;
use Illuminate\Support\Facades\Input;

Class validateOfficeMaster{
  public static function validate($request,$bango)
  {
    $rules=[];

    $rules['shikibetsucode'] = ['required','max:6','regex:/^([0-9])*$/'];

    if(Input::has('field')){
        $rules['name'] = ['required','max:30',new zenkaku];
    }else{
       $rules['name'] = ['required','max:30',new specialCharValidation,new zenkaku];
    }

    if(Input::has('field')){
        $rules['haisoumoji1'] = ['required','max:10',new zenkaku];
    }else{
        $rules['haisoumoji1'] = ['required','max:10',new specialCharValidation,new zenkaku];
    }

    $rules['haisousuchi1'] = ['nullable'];
    $rules['denpyoustart'] = ['nullable'];
    $rules['denpyouend'] = ['nullable'];
    $rules['saiban'] = ['nullable'];

    if(Input::has('field')){
        $rules['torihikisakirank1'] = ['nullable'];
    }else{
        $rules['torihikisakirank1'] = ['required'];
    }
    if($request['other14'] == "1" && $request['haisoumoji2']==1){
      $rules['zip1'] = ['required','nullable','regex:/^([0-9])*$/','min:7','max:7'];
      $rules['address1'] = ['required','nullable']; 
    }else {
      $rules['zip1'] = ['nullable','regex:/^([0-9])*$/','min:7','max:7'];
      $rules['address1'] = ['nullable']; 
    }
    //$rules['zip2'] = ['nullable','regex:/^([0-9])*$/','min:4','max:4',new specialCharValidation];

    if(Input::has('field')){
      if($request['other14'] == "1" && $request['haisoumoji2']==1){
        $rules['address2'] = ['required','nullable','max:15',new zenkaku];
      }else {
        $rules['address2'] = ['nullable','max:15',new zenkaku];
      }
    }else{
      if($request['other14'] == "1" && $request['haisoumoji2']==1){
        $rules['address2'] = ['required','nullable','max:15',new specialCharValidation,new zenkaku];
      }else {
        $rules['address2'] = ['nullable','max:15',new specialCharValidation,new zenkaku];
      }
    }

    if(Input::has('field')){
      if($request['other14'] == "1" && $request['haisoumoji2']==1){
        $rules['address3'] = ['required','nullable','max:15',new zenkaku];
      }else {
        $rules['address3'] = ['nullable','max:15',new zenkaku];
      }
    }else{
      if($request['other14'] == "1" && $request['haisoumoji2']==1){
        $rules['address3'] = ['required','nullable','max:15',new specialCharValidation,new zenkaku];
      }else {
        $rules['address3'] = ['nullable','max:15',new specialCharValidation,new zenkaku];
      }
    }

    if(Input::has('field')){
      if($request['other14'] == "1" && $request['haisoumoji2']==1){
        $rules['address4'] = ['nullable','max:40',new zenkaku];
      }else {
        $rules['address4'] = ['nullable','max:40',new zenkaku];
      }
    }else{
      if($request['other14'] == "1" && $request['haisoumoji2']==1){
        $rules['address4'] = ['nullable','max:40',new specialCharValidation,new zenkaku];
      }else {
        $rules['address4'] = ['nullable','max:40',new specialCharValidation,new zenkaku];
      }
    }

    $rules['tel'] = ['nullable','max:11','regex:/^([0-9])*$/'];
    $rules['torihikisakirank2'] = ['nullable','max:11','regex:/^([0-9])*$/'];
    $rules['yobi1'] = ['nullable','min:5','max:5','regex:/^([0-9])*$/'];

    if(Input::has('field')){
        $rules['mail'] = ['nullable','max:70','email','confirmed'];
    }else{
        $rules['mail'] = ['nullable','max:70','email',new specialCharValidation,'confirmed'];
    }

    if(Input::has('field')){
        $rules['mail_confirmation'] = ['nullable','max:70','email'];
    }else{
        $rules['mail_confirmation'] = ['nullable','max:70','email',new specialCharValidation];
    }

    $rules['haisoumoji2'] = ['required','max:1','regex:/^[1-2]{1}+$/']; //new CheckSameValue($request['haisoumoji2'],$request['syukeiki'])

    $rules['syukeiki'] = ['required','max:1','regex:/^[1-2]{1}+$/']; //new CheckSameValue($request['haisoumoji2'],$request['syukeiki'])

    $rules['other1'] = ['nullable','max:1','regex:/^[1-2]+$/'];
    $rules['other36'] = ['nullable','min:5','max:5','regex:/^[0-9]+$/'];

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==2 && $request['syukeiki']==1) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
         $rules['other2'] = ['nullable'];
    }else{
        $rules['other2'] = ['nullable',"required_if:haisoumoji2,==,1",'max:1','regex:/^[1-2]{1}+$/'];
    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==2 && $request['syukeiki']==1) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
        $rules['other3'] = ['nullable'];
    }else{
        $rules['other3'] = ['nullable',"required_if:haisoumoji2,==,1"];
    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==2 && $request['syukeiki']==1) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
        $rules['other4'] = ['nullable'];
    }else{
        $rules['other4'] = ['nullable',"required_if:haisoumoji2,==,1"];
    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==2 && $request['syukeiki']==1) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
        $rules['other5'] = ['nullable'];
    }else{
        $rules['other5'] = ['nullable',"required_if:haisoumoji2,==,1",'max:1','regex:/^[0-4]{1}+$/'];
    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==2 && $request['syukeiki']==1) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
        $rules['other6'] = ['nullable'];
    }else{
        $rules['other6'] = ['nullable',"required_if:haisoumoji2,==,1"];
    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==2 && $request['syukeiki']==1) || ($request['haisoumoji2']<1 || $request['syukeiki']<1) ){
        $rules['other7'] = ['nullable'];
    }else{
        $rules['other7'] = ['nullable',"required_if:haisoumoji2,==,1",'max:1','regex:/^[1-2]{1}+$/'];
    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==2 && $request['syukeiki']==1) || ($request['haisoumoji2']<1 || $request['syukeiki']<1) ){
        $rules['other8'] = ['nullable'];
    }else{
        $rules['other8'] = ['nullable',"required_if:haisoumoji2,==,1",'max:1','regex:/^[1-2]{1}+$/'];
    }

    $request['otherfloat1'] = str_replace(",","",$request['otherfloat1']);
    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==2 && $request['syukeiki']==1) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
        $rules['otherfloat1'] = ['nullable'];
    }else{
        $rules['otherfloat1'] = ['nullable',"required_if:haisoumoji2,==,1",'max:8','regex:/^[0-9]+$/'];
    }

    if( $request['haisoumoji2']==1 || $request['syukeiki']==1 ){
        $rules['other9'] = ['nullable'];
    }else{
        if(Input::has('field')){
            $rules['other9'] = ['nullable'];
        }else{
            $rules['other9'] = ['nullable',"required_if:haisoumoji2,==,1"];
        }
    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==2 && $request['syukeiki']==1) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
        $rules['other10'] = ['nullable'];
    }else{
        //$rules['other10'] = ['nullable',"required_if:haisoumoji2,==,1",'max:3','regex:/^([-][0-9]|[-]1[0]|[0-9]|1[0])$/'];
        $rules['other10'] = ['nullable',"required_if:haisoumoji2,==,1",'max:3','regex:/^([-]{1}[1-9]{1})$|^([0]{1})+$/'];
    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==2 && $request['syukeiki']==1) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
        $rules['other11'] = ['nullable'];
    }else{
        $rules['other11'] = ['nullable',"required_if:haisoumoji2,==,1",'max:1','regex:/^[1-2]{1}+$/'];
    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==2 && $request['syukeiki']==1) || ($request['haisoumoji2']>2 && $request['syukeiki']>2) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
         $rules['other12'] = ['nullable'];
    }else{
        if(Input::has('field')){
            $rules['other12'] = ['nullable',"required_if:other11,==,1",'max:70'];
        }else{
            $rules['other12'] = ['nullable',"required_if:other11,==,1",'max:70',new specialCharValidation];
        }
    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==2 && $request['syukeiki']==1) || ($request['haisoumoji2']>2 && $request['syukeiki']>2) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
        $rules['other13'] = ['nullable'];
    }else{
        $rules['other13'] = ['nullable',"required_if:haisoumoji2,==,1",'max:1','regex:/^[1-2]{1}+$/'];
    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==2 && $request['syukeiki']==1) || ($request['haisoumoji2']>2 && $request['syukeiki']>2) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
        $rules['other14'] = ['nullable'];
    }else{
        $rules['other14'] = ['nullable',"required_if:haisoumoji2,==,1",'max:1','regex:/^[14]{1}+$/'];
    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==2 && $request['syukeiki']==1) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
        $rules['other16'] = ['nullable'];
    }else{
        $rules['other16'] = ['nullable',"required_if:haisoumoji2,==,1"];
    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==2 && $request['syukeiki']==1) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
        $rules['other18'] = ['nullable'];
    }else{
        $rules['other18'] = ['nullable']; //"required_if:haisoumoji2,==,1"
    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==2 && $request['syukeiki']==1) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
        $rules['other17'] = ['nullable'];
    }else{
         $rules['other17'] = ['nullable','required_if:haisoumoji2,==,1','max:1','regex:/^[1-3]{1}+$/'];
    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==2 && $request['syukeiki']==1) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
        $rules['other39'] = ['nullable'];
    }else{
        $rules['other39'] = ['nullable','max:1','regex:/^[1-2]{1}+$/']; //"required_if:haisoumoji2,==,1"
    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==2 && $request['syukeiki']==1) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
        $rules['other40'] = ['nullable'];
    }else{
         if(Input::has('field')){
             $rules['other40'] = ['nullable','required_if:other39,==,1','min:8','max:8','regex:/^([0-9])*$/'];
         }else{
             $rules['other40'] = ['nullable','required_if:other39,==,1','min:8','max:8','regex:/^([0-9])*$/',new specialCharValidation]; //'required_if:haisoumoji2,==,1'
         }
    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==1 && $request['syukeiki']==2) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
        $rules['other19'] = ['nullable'];
    }else{
        $rules['other19'] = ['nullable','required_if:syukeiki,==,1'];
    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==1 && $request['syukeiki']==2) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
        $rules['other20'] = ['nullable'];
    }else{
        $rules['other20'] = ['nullable','required_if:syukeiki,==,1','max:1','regex:/^[0-4]{1}+$/'];
    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==1 && $request['syukeiki']==2) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
        $rules['other21'] = ['nullable'];
    }else{
        $rules['other21'] = ['nullable','required_if:syukeiki,==,1'];
    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2)  || ($request['haisoumoji2']==1 && $request['syukeiki']==2) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
        $rules['other22'] = ['nullable'];
    }else{
        $rules['other22'] = ['nullable','required_if:syukeiki,==,1','max:1','regex:/^[1-2]{1}+$/'];
    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==1 && $request['syukeiki']==2) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
        $rules['other23'] = ['nullable'];
    }else{
        $rules['other23'] = ['nullable','required_if:syukeiki,==,1','max:1','regex:/^[1-2]{1}+$/'];
    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==1 && $request['syukeiki']==2) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
        $rules['other24'] = ['nullable'];
    }else{
        $rules['other24'] = ['nullable','required_if:syukeiki,==,1'];
    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==1 && $request['syukeiki']==2) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
        $rules['otherfloat2'] = ['nullable'];
    }else{
        $rules['otherfloat2'] = ['nullable','max:3','regex:/^[0-9]+$/'];
    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==1 && $request['syukeiki']==2) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
        $rules['other25'] = ['nullable'];
    }else{
        $rules['other25'] = ['nullable','min:4','max:4','regex:/^[0-9]+$/'];
    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==1 && $request['syukeiki']==2) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
        $rules['other26'] = ['nullable'];
    }else{
        $rules['other26'] = ['nullable','min:3','max:3','regex:/^[0-9]+$/'];
    }

//    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==1 && $request['syukeiki']==2) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
//        $rules['otherfloat4'] = ['nullable'];
//    }else{
//        $rules['otherfloat4'] = ['nullable','max:1','regex:/^[0-1]{1}+$/'];
//    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==1 && $request['syukeiki']==2) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
        $rules['other27'] = ['nullable'];
    }else{
        $rules['other27'] = ['nullable','min:8','max:8','regex:/^[0-9]+$/'];
    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==1 && $request['syukeiki']==2) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
        $rules['other28'] = ['nullable'];
    }else{
        $rules['other28'] = ['nullable','max:20',new specialCharValidation,new zenkaku];
    }

    $rules['other30'] = ['nullable'];

    $rules['other31'] = ['nullable'];

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==1 && $request['syukeiki']==2) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
        $rules['other33'] = ['nullable'];
    }else{
        $rules['other33'] = ['nullable','required_if:syukeiki,==,1'];
    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==1 && $request['syukeiki']==2) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
         $rules['other34'] = ['nullable'];
    }else{
        $rules['other34'] = ['nullable','required_if:syukeiki,==,1','max:1','regex:/^[1-2]{1}+$/'];
    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==1 && $request['syukeiki']==2) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
        $rules['other35'] = ['nullable'];
    }else{
        $rules['other35'] = ['nullable','required_if:syukeiki,==,1'];
    }

    if(($request['haisoumoji2']==2 && $request['syukeiki']==2) || ($request['haisoumoji2']==1 && $request['syukeiki']==2) || ($request['haisoumoji2']<1 || $request['syukeiki']<1)){
        $rules['otherfloat3'] = ['nullable'];
    }else{
        $rules['otherfloat3'] = ['nullable','max:5','regex:/^[0-9]{1,2}$|^[0-9]{1,2}[.][0-9]{1,2}+$/']; //'required_if:syukeiki,==,1'
    }

    if($request['haisoumoji2']==2 && $request['syukeiki']==2){
        $rules['other37'] = ['nullable'];
    }else{
        $rules['other37'] = ['nullable','max:1','regex:/^[0-4]{1}+$/'];
    }

    $message=[];
    $message['required']='【:attribute】必須項目に入力がありません。';
    $message['required_if']='【:attribute】必須項目に入力がありません。';
    $message['unique']='【:attribute】の入力が重複しています。';
    $message['max']='【:attribute】:max桁以下で入力してください。';
    $message['other25.max']='【:attribute】:max桁で入力してください。';
    $message['other25.min']='【:attribute】:min桁で入力してください。';
    $message['other26.max']='【:attribute】:max桁で入力してください。';
    $message['other26.min']='【:attribute】:min桁で入力してください。';
    $message['other27.max']='【:attribute】:max桁で入力してください。';
    $message['other27.min']='【:attribute】:min桁で入力してください。';
    $message['other36.max']='【:attribute】:max桁で入力してください。';
    $message['other36.min']='【:attribute】:min桁で入力してください。';
    $message['other40.max']='【:attribute】:max桁で入力してください。';
    $message['other40.min']='【:attribute】:min桁で入力してください。';
    $message['zip1.max']='【:attribute】ハイフンなし:max桁で入力してください。';
    $message['zip1.min']='【:attribute】ハイフンなし:min桁で入力してください。';
    $message['yobi1.max']='【:attribute】:max桁で入力してください。';
    $message['yobi1.min']='【:attribute】:min桁で入力してください。';
    $message['mail.confirmed']='【メールアドレス(確認用)】メールアドレスが一致しません。';
    $message['min']='【:attribute】の入力は:min文字以上必要です。';
    $message['regex']='【:attribute】半角数字以外は使用できません。';
    $message['haisoumoji2.regex']='【:attribute】入力が間違っています。';
    $message['syukeiki.regex']='【:attribute】入力が間違っています。';
    $message['other1.regex']='【:attribute】入力が間違っています。';
    $message['other2.regex']='【:attribute】入力が間違っています。';
    $message['other5.regex']='【:attribute】入力が間違っています。';
    $message['other7.regex']='【:attribute】入力が間違っています。';
    $message['other8.regex']='【:attribute】入力が間違っています。';
    $message['other10.regex']='【:attribute】入力が間違っています。';
    $message['other11.regex']='【:attribute】入力が間違っています。';
    $message['other13.regex']='【:attribute】入力が間違っています。';
    $message['other14.regex']='【:attribute】入力が間違っています。';
    $message['other17.regex']='【:attribute】入力が間違っています。';
    $message['other39.regex']='【:attribute】入力が間違っています。';
    $message['other20.regex']='【:attribute】入力が間違っています。';
    $message['other22.regex']='【:attribute】入力が間違っています。';
    $message['other23.regex']='【:attribute】入力が間違っています。';
    $message['otherfloat3.regex']='【:attribute】入力が間違っています。';
    $message['other37.regex']='【:attribute】入力が間違っています。';
    $message['other34.regex']='【:attribute】入力が間違っています。';
    $message['numeric']='【:attribute】入力形式が間違っています。';
    $message['email']='【:attribute】入力されたメールアドレスの形式はご登録いただけません。';

    $attributes = [
        'shikibetsucode' => '会社CD',
        'name' => '事業所名',
        'haisoumoji1' => '事業所名略称',
        'torihikisakirank1' => '入力区分',
        'haisousuchi1' => '担当SA1 ',
        'denpyoustart' => '担当SA2',
        'denpyouend' => '担当SE1',
        'saiban' => '担当SE2',
        'zip1' => '郵便番号',
        'address1' => '都道府県',
        'address2' => '市区町村名',
        'address3' => '町域名',
        'address4' => '番地・建物名',
        'tel' => 'TEL',
        'torihikisakirank2' => 'FAX',
        'yobi1' => 'JIS市区町村CD',
        'mail' => 'メールアドレス',
        'mail_confirmation' => 'メールアドレス(確認用)',
        'haisoumoji2' => '売上区分',
        'syukeiki' => '仕入区分',
        'other1' => '事業所口座使用区分',
        'other36' => '旧取引先CD',
        'other2' => '即時区分',
        'other3' => '請求締め日',
        'other4' => '入金方法',
        'other5' => '入金月',
        'other6' => '入金日',
        'other7' => '入金日休日設定',
        'other8' => '入金時手数料設定',
        'otherfloat1' => '与信限度額',
        'other9' => '請求先',
        'other10' => '請求書送付日',
        'other11' => '請求書メール区分',
        'other12' => '請求書メール宛先',
        'other13' => '請求書UIS',
        'other14' => '請求書郵送',
        'other15' => '請求書郵送先',
        'other16' => '請求税区分',
        'other18' => '請求税端数区分',
        'other17' => '請求消費税計算区分',
        'other39' => '専伝区分',
        'other40' => '指定納品書帳票CD',
        'other19' => '支払締め日',
        'other20' => '支払月',
        'other21' => '支払日',
        'other22' => '支払日休日設定',
        'other23' => '支払振込手数料設定',
        'other24' => '支払方法',
        'otherfloat2' => '支払手形サイト',
        'other30' => '支払振込手数料区分',
        'other25' => '振込銀行',
        'other26' => '振込支店',
        'otherfloat4' => '預金種別',
        'other27' => '口座番号',
        'other28' => '口座名義人',
        'other31' => '仕向銀行',
        'other32' => '仕向支店',
        'other33' => '支払税区分',
        'other34' => '支払消費税計算区分',
        'other35' => '支払税端数区分',
        'otherfloat3' => '源泉税率',
        'other37' => '手形決済月',
        'other38' => '手形決済日',
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
