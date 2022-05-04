<?php

namespace App\AllClass\master\companyMaster;

use DB;
use App\AllClass\Mobile;
use App\AllClass\specialCharValidation;
use Illuminate\Support\Facades\Validator;
use App\AllClass\zenkaku;
use App\AllClass\CheckNumberHypen;
use App\AllClass\checkValidEmail;
use App\AllClass\master\companyMaster\CheckSameValue;
use App\AllClass\master\companyMaster\CheckPopUpValue;
use Illuminate\Support\Facades\Input;

Class validateCompanyEditMaster{ 
  public static function validate($request,$bango)
  { 
    $rules=[];
    
    $kcode4 = substr($request['kcode4'],0,1)==1?1:0;
    
    $rules['kounyusu'] = ['nullable','max:13','regex:/^[0-9]+$/'];
    
    if(Input::has('field')){
        $rules['name'] = ['required','max:30',new zenkaku];
    }else{
        $rules['name'] = ['required','max:30',new specialCharValidation,new zenkaku];
    }
    
    if(Input::has('field')){
        $rules['address'] = ['required','max:10',new zenkaku];
    }else{
        $rules['address'] = ['required','max:10',new specialCharValidation,new zenkaku];
    }
    
    if(Input::has('field')){
        $rules['furigana'] = ['nullable','max:20',new zenkaku];
    }else{
        $rules['furigana'] = ['nullable','max:20',new specialCharValidation,new zenkaku];
    }
    
     if(Input::has('field')){
        $rules['datatxt0050'] = ['nullable','max:40',new zenkaku];
    }else{
        $rules['datatxt0050'] = ['nullable','max:40',new specialCharValidation,new zenkaku];
    }
    
    if(Input::has('field')){
        $rules['syukeitukikijun'] = ['nullable','max:8','regex:/^[0-9]+$/'];
    }else{
        $rules['syukeitukikijun'] = ['nullable','max:8',new specialCharValidation,'regex:/^[0-9]+$/'];
    }
    
    $rules['syukeinen'] = ['nullable','min:5','max:5','regex:/^[0-9]+$/'];
    $rules['filename'] = ['nullable','mimes:pdf'];
    
    if(Input::has('field')){
        $rules['tel'] = ['nullable','max:8','regex:/^[0-9]+$/'];
    }else{
        $rules['tel'] = ['nullable','max:8','date','regex:/^[0-9]+$/'];
    }
    
    $rules['fax'] = ['nullable','min:9','max:9','regex:/^[0-9]+$/'];
    
    if(Input::has('field')){
        $rules['torihikisakibango'] = ['nullable','max:2','regex:/^[a-zA-Z0-9]+$/'];
    }else{
        $rules['torihikisakibango'] = ['nullable','max:2','regex:/^[a-zA-Z0-9]+$/',new specialCharValidation];
    }
    
    if(Input::has('field')){
        $rules['kensakukey'] = ['nullable','max:50',new zenkaku];
    }else{
        $rules['kensakukey'] = ['nullable','max:50',new specialCharValidation,new zenkaku];
    }
    
    $rules['syukeituki'] = ['required','max:1','regex:/^[1-2]{1}+$/']; //new CheckSameValue($request['syukeituki'],$request['syukeikikijun'])
    
    $rules['syukeikikijun'] = ['required','max:1','regex:/^[1-2]{1}+$/']; //new CheckSameValue($request['syukeituki'],$request['syukeikikijun'])
   
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==2 && $request['syukeikikijun']==1) || ($request['syukeituki']<1 || $request['syukeikikijun']<1)){
        $rules['kcode3'] = ['nullable'];
    }else{
        if(Input::has('field')){
            $rules['kcode3'] = ['nullable','max:1','regex:/^[1-2]{1}+$/'];
        }else{
            //$rules['kcode3'] = ['nullable',"required_if:syukeituki,==,1 && required_if:kcode4,==,$kcode4",'max:1','regex:/^[1-2]{1}+$/'];
            $rules['kcode3'] = ['nullable',"required_if:syukeituki,==,1",'max:1','regex:/^[1-2]{1}+$/'];
        }
    }
   
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==2 && $request['syukeikikijun']==1) || ($request['syukeituki']<1 || $request['syukeikikijun']<1)){
        $rules['ytoiawsestart'] = ['nullable'];
    }else{
        $rules['ytoiawsestart'] = ['required'];
    }
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==2 && $request['syukeikikijun']==1) || ($request['syukeituki']<1 || $request['syukeikikijun']<1)){
        $rules['ytoiawseend'] = ['nullable'];
    }else{
        $rules['ytoiawseend'] = ['required'];
    }   
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==2 && $request['syukeikikijun']==1) || ($request['syukeituki']<1 || $request['syukeikikijun']<1)){
        $rules['ytoiawsesaiban'] = ['nullable'];
    }else{
        if(Input::has('field')){
            $rules['ytoiawsesaiban'] = ['nullable','max:1','regex:/^[0-4]{1}+$/'];
        }else{
            //$rules['ytoiawsesaiban'] = ['nullable',"required_if:syukeituki,==,1 && required_if:kcode4,==,$kcode4",'max:1','regex:/^[0-4]{1}+$/'];
            $rules['ytoiawsesaiban'] = ['nullable',"required_if:syukeituki,==,1",'max:1','regex:/^[0-4]{1}+$/'];
        }
    }
    
    $rules['yetoiawsestart'] = ['nullable',"required_if:syukeituki,==,1 && required_if:kcode4,==,$kcode4"];
   
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==2 && $request['syukeikikijun']==1) || ($request['syukeituki']<1 || $request['syukeikikijun']<1)){
        $rules['yetoiawseend'] = ['nullable'];
    }else{
        if(Input::has('field')){
            $rules['yetoiawseend'] = ['nullable','max:1','regex:/^[1-2]{1}+$/'];
        }else{
            //$rules['yetoiawseend'] = ['nullable',"required_if:syukeituki,==,1 && required_if:kcode4,==,$kcode4",'max:1','regex:/^[1-2]{1}+$/'];
            $rules['yetoiawseend'] = ['nullable',"required_if:syukeituki,==,1",'max:1','regex:/^[1-2]{1}+$/'];
        }
    }
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==2 && $request['syukeikikijun']==1) || ($request['syukeituki']<1 || $request['syukeikikijun']<1)){
        $rules['yetoiawsesaiban'] = ['nullable'];
    }else{
        if(Input::has('field')){
            $rules['yetoiawsesaiban'] = ['nullable','max:1','regex:/^[1-2]{1}+$/'];
        }else{
            //$rules['yetoiawsesaiban'] = ['nullable',"required_if:syukeituki,==,1 && required_if:kcode4,==,$kcode4",'max:1','regex:/^[1-2]{1}+$/'];
            $rules['yetoiawsesaiban'] = ['nullable',"required_if:syukeituki,==,1",'max:1','regex:/^[1-2]{1}+$/'];
        }
    }
    
//    if( ($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==1 && $request['syukeikikijun']==1) || ($request['syukeituki']==2 && $request['syukeikikijun']==1) || ($request['syukeituki']<1 && $request['syukeikikijun']<1) ){
//        $rules['netusername'] = ['nullable'];
//    }else{
//        $rules['netusername'] = ['nullable','max:1','regex:/^[1-2]{1}+$/'];
//    }
    
//    if( ($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==1 && $request['syukeikikijun']==1) || ($request['syukeituki']==2 && $request['syukeikikijun']==1) || ($request['syukeituki']<1 && $request['syukeikikijun']<1) ){
//        $rules['netuserpasswd'] = ['nullable'];
//    }else{
//        $rules['netuserpasswd'] = ['nullable','max:1','regex:/^[1-2]{1}+$/'];
//    }
    
    //if( 
    //    ($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']>2 && $request['syukeikikijun']>2)
    //    || ($request['syukeituki']==1 && $request['syukeikikijun']==1) || ($request['syukeituki']==2 && $request['syukeikikijun']==1)
    //    || ($request['syukeituki']<1 && $request['syukeikikijun']<1) || ($request['syukeituki']=="" && $request['syukeikikijun']==1) 
    //    || ($request['syukeituki']>2 && $request['syukeikikijun']==1) || ($request['syukeituki']>2 && $request['syukeikikijun']>=2) 
    //    || ($request['syukeituki']>=2 && $request['syukeikikijun']>2) || ($request['syukeituki']>=2 && $request['syukeikikijun']=="") 
    //    || ($request['syukeituki']=="" && $request['syukeikikijun']>=2) 
    //){
    //    $rules['netlogin'] = ['nullable'];
    //}else{
    //    $rules['netlogin'] = ['required'];
    //}
    
    $request['denpyostart'] = str_replace(",","",$request['denpyostart']);
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==2 && $request['syukeikikijun']==1) || ($request['syukeituki']<1 || $request['syukeikikijun']<1)){
        $rules['denpyostart'] = ['nullable'];
    }else{
        $rules['denpyostart'] = ['required','max:8','regex:/^[0-9]+$/'];
    }
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==2 && $request['syukeikikijun']==1) || ($request['syukeituki']<1 || $request['syukeikikijun']<1)){
        $rules['mail_soushin'] = ['nullable'];
    }else{
        $rules['mail_soushin'] = ['required','max:11','regex:/^[0-9]+$/']; //new CheckPopUpValue($request['mail_soushin_extra'])
    }
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==2 && $request['syukeikikijun']==1) || ($request['syukeituki']<1 || $request['syukeikikijun']<1)){
        $rules['mail_jyushin'] = ['nullable'];
    }else{
        $rules['mail_jyushin'] = ['required','max:3','regex:/^([-]{1}[1-9]{1})$|^([0]{1})+$/'];
    }
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==2 && $request['syukeikikijun']==1) || ($request['syukeituki']<1 || $request['syukeikikijun']<1)){
        $rules['mail_nouhin'] = ['nullable'];
    }else{
        $rules['mail_nouhin'] = ['required','max:1','regex:/^[1-2]{1}+$/'];
    }
   
    if( 
        ($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']>2 && $request['syukeikikijun']>2)
        || ($request['syukeituki']==2 && $request['syukeikikijun']==1)
        || ($request['syukeituki']<1 && $request['syukeikikijun']<1) || ($request['syukeituki']=="" && $request['syukeikikijun']==1) 
        || ($request['syukeituki']>2 && $request['syukeikikijun']==1) || ($request['syukeituki']>2 && $request['syukeikikijun']>=2) 
        || ($request['syukeituki']>=2 && $request['syukeikikijun']>2) || ($request['syukeituki']>=2 && $request['syukeikikijun']=="") 
        || ($request['syukeituki']=="" && $request['syukeikikijun']>=2) 
    ){
         $rules['mail_toiawase'] = ['nullable'];
    }else{
        if(Input::has('field')){
            $rules['mail_toiawase'] = ['nullable','max:70']; 
        }else{
            $rules['mail_toiawase'] = ['nullable',"required_if:mail_nouhin,==,1",'max:70',new specialCharValidation]; //'regex:/^[a-zA-Z0-9]+$/'
        }
    }
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==2 && $request['syukeikikijun']==1) || ($request['syukeituki']<1 || $request['syukeikikijun']<1)){
        $rules['mail_soushin_mb'] = ['nullable'];
    }else{
        $rules['mail_soushin_mb'] = ['required','max:1','regex:/^[1-2]{1}+$/'];
    }
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==2 && $request['syukeikikijun']==1) || ($request['syukeituki']<1 || $request['syukeikikijun']<1)){
        $rules['mail_jyushin_mb'] = ['nullable'];
    }else{
        $rules['mail_jyushin_mb'] = ['required','max:1','regex:/^[14]{1}+$/'];
    }
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==2 && $request['syukeikikijun']==1) || ($request['syukeituki']<1 || $request['syukeikikijun']<1)){
        $rules['mail_nouhin_mb'] = ['nullable'];
    }else{
        $rules['mail_nouhin_mb'] = ['nullable','max:11','regex:/^[0-9]+$/']; //new CheckPopUpValue($request['mail_nouhin_mb_extra'])
    }
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==2 && $request['syukeikikijun']==1) || ($request['syukeituki']<1 || $request['syukeikikijun']<1)){
        $rules['mail_toiawase_mb'] = ['nullable'];
    }else{
        // $rules['mail_toiawase_mb'] = ['nullable',"required_if:syukeituki,==,1 && required_if:kcode4,==,$kcode4"];
        $rules['mail_toiawase_mb'] = ['nullable',"required_if:syukeituki,==,1"];
    }
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==2 && $request['syukeikikijun']==1) || ($request['syukeituki']<1 || $request['syukeikikijun']<1)){
        $rules['mallsoukobango1'] = ['nullable'];
    }else{
        //$rules['mallsoukobango1'] = ['nullable',"required_if:syukeituki,==,1 && required_if:kcode4,==,$kcode4"];
        $rules['mallsoukobango1'] = ['nullable',"required_if:syukeituki,==,1"];
    }
    
    if( ($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==2 && $request['syukeikikijun']==1) || ($request['syukeituki']<1 && $request['syukeikikijun']<1) ){
        $rules['datatxt0051'] = ['nullable'];
    }else{
        $rules['datatxt0051'] = ['nullable','required_if:syukeituki,==,1','max:1','regex:/^[1-3]{1}+$/'];
    }
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==2 && $request['syukeikikijun']==1) || ($request['syukeituki']<1 || $request['syukeikikijun']<1)){
        $rules['mallsoukobango2'] = ['nullable'];
    }else{
        $rules['mallsoukobango2'] = ['required','max:1','regex:/^[1-2]{1}+$/'];
    }
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==2 && $request['syukeikikijun']==1) || ($request['syukeituki']<1 || $request['syukeikikijun']<1)){
        $rules['mallsoukobango3'] = ['nullable'];
    }else{
        if($request['syukeituki']==1 && $request['mallsoukobango2']==1){
           if(Input::has('field')){
                $rules['mallsoukobango3'] = ['required','min:8','max:8','regex:/^[0-9\/]+$/'];
            }else{
                $rules['mallsoukobango3'] = ['required','min:8','max:8','regex:/^[0-9\/]+$/',new specialCharValidation];
            } 
        }else{
            if(Input::has('field')){
                $rules['mallsoukobango3'] = ['nullable','min:8','max:8','regex:/^[0-9\/]+$/'];
            }else{
                $rules['mallsoukobango3'] = ['nullable','min:8','max:8','regex:/^[0-9\/]+$/',new specialCharValidation];
            }
        }
    }
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==2 && $request['syukeikikijun']==1) || ($request['syukeituki']<1 || $request['syukeikikijun']<1)){
        $rules['kaiinbango'] = ['nullable'];
    }else{
        if(Input::has('field')){
            $rules['kaiinbango'] = ['nullable','max:8','regex:/^[0-9]+$/'];
        }else{
           $rules['kaiinbango'] = ['nullable','max:8','date','regex:/^[0-9]+$/']; 
        }
    }
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==2 && $request['syukeikikijun']==1) || ($request['syukeituki']<1 || $request['syukeikikijun']<1)){
        $rules['zokugara'] = ['nullable'];
    }else{
        if(Input::has('field')){
            $rules['zokugara'] = ['nullable','max:8','regex:/^[0-9]+$/'];
        }else{
            $rules['zokugara'] = ['nullable','max:8','date','regex:/^[0-9]+$/'];
        }
    }
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==2 && $request['syukeikikijun']==1) || ($request['syukeituki']<1 || $request['syukeikikijun']<1)){
        $rules['haisoujouhou_name'] = ['nullable'];
    }else{
        if(Input::has('field')){
            $rules['haisoujouhou_name'] = ['nullable','max:8','regex:/^[0-9]+$/'];
        }else{
            $rules['haisoujouhou_name'] = ['nullable','max:8','date','regex:/^[0-9]+$/'];
        }
    }
    
    $rules['kcode4'] = ['nullable',"required_if:syukeituki,==,1"];
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==2 && $request['syukeikikijun']==1) || ($request['syukeituki']<1 || $request['syukeikikijun']<1)){
        $rules['haisoujouhou_yubinbango'] = ['nullable'];
    }else{
        if(Input::has('field')){
            $rules['haisoujouhou_yubinbango'] = ['nullable','max:8','regex:/^[0-9]+$/'];
        }else{
            $rules['haisoujouhou_yubinbango'] = ['nullable','max:8','date','regex:/^[0-9]+$/'];
        }
    }
    
//    if( ($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==2 && $request['syukeikikijun']==1) || ($request['syukeituki']<1 && $request['syukeikikijun']<1) ){
//        $rules['haisoujouhou_address'] = ['nullable'];
//    }else{
//        $rules['haisoujouhou_address'] = ['nullable','required_if:syukeituki,==,1'];
//    }
    
//    if( ($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==1 && $request['syukeikikijun']==2) || ($request['syukeituki']<1 && $request['syukeikikijun']<1) ){
//        $rules['haisoujouhou_tel'] = ['nullable'];
//    }else{
//        if(Input::has('field')){
//            $rules['haisoujouhou_tel'] = ['nullable'];
//        }else{
//            $rules['haisoujouhou_tel'] = ['nullable','required_if:syukeikikijun,==,1'];
//        }
//    }
    
    $rules['bunrui6'] = ['nullable','min:10','max:10','regex:/^[0-9]+$/'];
    
    if( ($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==1 && $request['syukeikikijun']==2) || ($request['syukeituki']<1 && $request['syukeikikijun']<1) ){
        $rules['mail'] = ['nullable'];
    }else{
        $rules['mail'] = ['nullable','required_if:syukeikikijun,==,1','max:1','regex:/^[0-4]{1}+$/'];
    }
    
    $rules['sex'] = ['nullable','required_if:syukeikikijun,==,1'];
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==1 && $request['syukeikikijun']==2) || ($request['syukeituki']<1 && $request['syukeikikijun']<1)){
        $rules['bunrui1'] = ['nullable'];
    }else{
         $rules['bunrui1'] = ['nullable','required_if:syukeikikijun,==,1','max:1','regex:/^[1-2]{1}+$/'];
    }
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==1 && $request['syukeikikijun']==2) || ($request['syukeituki']<1 && $request['syukeikikijun']<1)){
        $rules['bunrui2'] = ['nullable'];
    }else{
        $rules['bunrui2'] = ['nullable','required_if:syukeikikijun,==,1','max:1','regex:/^[1-2]{1}+$/'];
    }
    
    if($request['syukeikikijun']==1 && $request['bunrui3']=='D901'){
       $rules['syukeinenkijun'] = ['required']; //'max:5','regex:/^[0-9]+$/' 
    } 
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==1 && $request['syukeikikijun']==2) || ($request['syukeituki']<1 && $request['syukeikikijun']<1)){
        $rules['bunrui3'] = ['nullable'];
    }else{
        if(Input::has('field')){
            $rules['bunrui3'] = ['nullable','required_if:syukeikikijun,==,1'];
        }else{
            $rules['bunrui3'] = ['nullable','required_if:syukeikikijun,==,1'];
        }
    }
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==1 && $request['syukeikikijun']==2) || ($request['syukeituki']<1 || $request['syukeikikijun']<1)){
        $rules['datatxt0054'] = ['nullable'];
    }else{
        $rules['datatxt0054'] = ['nullable','min:4','max:4','regex:/^[0-9]+$/'];
    }
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==1 && $request['syukeikikijun']==2) || ($request['syukeituki']<1 || $request['syukeikikijun']<1)){
        $rules['datatxt0055'] = ['nullable'];
    }else{
        $rules['datatxt0055'] = ['nullable','min:3','max:3','regex:/^[0-9]+$/'];
    }
    
//    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==1 && $request['syukeikikijun']==2) || ($request['syukeituki']<1 || $request['syukeikikijun']<1)){
//        $rules['endtime'] = ['nullable'];
//    }else{
//        $rules['endtime'] = ['nullable','max:1','regex:/^[0-1]{1}+$/'];
//    }
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==1 && $request['syukeikikijun']==2) || ($request['syukeituki']<1 || $request['syukeikikijun']<1)){
        $rules['datatxt0056'] = ['nullable'];
    }else{
        $rules['datatxt0056'] = ['nullable','min:8','max:8','regex:/^[0-9]+$/'];
    }
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==1 && $request['syukeikikijun']==2) || ($request['syukeituki']<1 || $request['syukeikikijun']<1)){
        $rules['datatxt0057'] = ['nullable'];
    }else{
        $rules['datatxt0057'] = ['nullable','max:20',new specialCharValidation,new zenkaku];
    }
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==1 && $request['syukeikikijun']==2) || ($request['syukeituki']<1 || $request['syukeikikijun']<1)){
        $rules['syukei3'] = ['nullable'];
    }else{
        $rules['syukei3'] = ['nullable','max:3','regex:/^[0-9]+$/'];
    }
    
    $rules['syukeiki'] = ['nullable'];
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==1 && $request['syukeikikijun']==2) || ($request['syukeituki']<1 && $request['syukeikikijun']<1)){
        $rules['bunrui4'] = ['nullable'];
    }else{
        $rules['bunrui4'] = ['nullable','required_if:syukeikikijun,==,1'];
    }
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==1 && $request['syukeikikijun']==2) || ($request['syukeituki']<1 && $request['syukeikikijun']<1)){
        $rules['bunrui5'] = ['nullable'];
    }else{
        $rules['bunrui5'] = ['nullable','required_if:syukeikikijun,==,1'];
    }
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==1 && $request['syukeikikijun']==2) || ($request['syukeituki']<1 && $request['syukeikikijun']<1)){
        $rules['syukei2'] = ['nullable'];
    }else{
        $rules['syukei2'] = ['nullable','max:5','regex:/^[0-9]{1,2}$|^[0-9]{1,2}[.][0-9]{1,2}+$/'];
    }
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==1 && $request['syukeikikijun']==2) || ($request['syukeituki']<1 || $request['syukeikikijun']<1)){
        $rules['bunrui9'] = ['nullable'];
    }else{
        if($request['syukeikikijun']==1 && $request['ytoiawseend']=='A905'){
            $rules['bunrui9'] = ['required','max:1','regex:/^[0-4]{1}+$/'];
        }else{
           $rules['bunrui9'] = ['nullable','max:1','regex:/^[0-4]{1}+$/']; 
        }
    }
    
    if(($request['syukeituki']==2 && $request['syukeikikijun']==2) || ($request['syukeituki']==1 && $request['syukeikikijun']==2) || ($request['syukeituki']<1 && $request['syukeikikijun']<1)){
         $rules['datatxt0052'] = ['nullable'];
    }else{
        $rules['datatxt0052'] = ['nullable','required_if:syukeikikijun,==,1','max:1','regex:/^[1-2]{1}+$/'];
    }
    

    $message=[];    
    $message['required']='【:attribute】必須項目に入力がありません。';
    $message['required_if']='【:attribute】必須項目に入力がありません。';
    $message['unique']='【:attribute】の入力が重複しています。';
    $message['max']='【:attribute】:max桁以下で入力してください。';
    $message['bunrui6.max']='【:attribute】:max桁で入力してください。';
    $message['bunrui6.min']='【:attribute】:min桁で入力してください。';
    $message['mallsoukobango3.max']='【:attribute】:max桁で入力してください。';
    $message['mallsoukobango3.min']='【:attribute】:min桁で入力してください。';
    $message['denpyostart.max']='【:attribute】:max桁以下で入力してください。';
    $message['fax.max']='【:attribute】:max桁で入力してください。';
    $message['fax.min']='【:attribute】:min桁で入力してください。';
    $message['datatxt0054.max']='【:attribute】:max桁で入力してください。';
    $message['datatxt0054.min']='【:attribute】:min桁で入力してください。';
    $message['datatxt0055.max']='【:attribute】:max桁で入力してください。';
    $message['datatxt0055.min']='【:attribute】:min桁で入力してください。';
    $message['datatxt0056.max']='【:attribute】:max桁で入力してください。';
    $message['datatxt0056.min']='【:attribute】:min桁で入力してください。';
    $message['syukeinen.max']='【:attribute】:max桁で入力してください。';
    $message['syukeinen.min']='【:attribute】:min桁で入力してください。';
    $message['min']='【:attribute】の入力は:min文字以上必要です。';
    $message['innerlevel.max']='【:attribute】の入力形式が間違っています。';
    $message['regex']='【:attribute】半角数字以外は使用できません。';
    $message['torihikisakibango.regex']='【:attribute】半角英数字以外は使用できません。';
    $message['syukeituki.regex']='【:attribute】入力が間違っています。';
    $message['syukeikikijun.regex']='【:attribute】入力が間違っています。';
    $message['kcode3.regex']='【:attribute】入力が間違っています。';
    $message['ytoiawsesaiban.regex']='【:attribute】入力が間違っています。';
    $message['yetoiawseend.regex']='【:attribute】入力が間違っています。';
    $message['yetoiawsesaiban.regex']='【:attribute】入力が間違っています。';
    $message['mail_jyushin.regex']='【:attribute】入力が間違っています。';
    $message['mail_nouhin.regex']='【:attribute】入力が間違っています。';
    $message['mail_soushin_mb.regex']='【:attribute】入力が間違っています。';
    $message['mail_jyushin_mb.regex']='【:attribute】入力が間違っています。';
    $message['datatxt0051.regex']='【:attribute】入力が間違っています。';
    $message['mallsoukobango2.regex']='【:attribute】入力が間違っています。';
    $message['netusername.regex']='【:attribute】入力が間違っています。';
    $message['netuserpasswd.regex']='【:attribute】入力が間違っています。';
    $message['mail.regex']='【:attribute】入力が間違っています。';
    $message['bunrui1.regex']='【:attribute】入力が間違っています。';
    $message['bunrui2.regex']='【:attribute】入力が間違っています。';
    $message['bunrui9.regex']='【:attribute】入力が間違っています。';
    $message['datatxt0052.regex']='【:attribute】入力が間違っています。';
    $message['numeric']='【:attribute】入力形式が間違っています。';
    $message['email']='【:attribute】の入力形式が間違っています。';
    $message['date']='【:attribute】入力形式が間違っています。';
    $message['date_format']='【:attribute】入力形式が間違っています。';
    //$message['mail_toiawase.regex']='【:attribute】半角英数字以外は使用できません。';
    $message['filename.mimes']='【:attribute】File Extension should be PDF。';

    $attributes = [
        'kounyusu' => '法人マイナンバー',
        'name' => '会社名',
        'address' => '会社名略称',
        'furigana' => '会社名カナ',
        'datatxt0050' => '会社名カナ入金消込用',
        'syukeitukikijun' => '会計取引先CD',
        'syukeinen' => '旧取引先CD',
        'filename' => '帝国ﾃﾞｰﾀﾊﾞﾝｸ信用録PDF',
        'bunrui6' => '信用録書類保管番号',
        'tel' => '帝国ﾃﾞｰﾀﾊﾞﾝｸ取得年月日',
        'fax' => '帝国ﾃﾞｰﾀﾊﾞﾝｸ企業CD',
        'torihikisakibango' => '帝国ﾃﾞｰﾀﾊﾞﾝｸ評点',
        'kensakukey' => '社内備考（会社）',
        'syukeituki' => '売上区分',
        'syukeikikijun' => '仕入区分',
        'kcode3' => '即時区分',
        'ytoiawsestart' => '請求締め日',
        'ytoiawseend' => '入金方法',
        'ytoiawsesaiban' => '入金月',
        'yetoiawsestart' => '入金日',
        'yetoiawseend' => '入金日休日設定',
        'yetoiawsesaiban' => '入金時手数料設定',
        'netusername' => '保守更新案内有無',
        'netuserpasswd' => 'ライセンス証書有無',
        'netlogin' => '検収条件',
        'denpyostart' => '与信限度額',
        'mail_soushin' => '請求先CD',
        'mail_jyushin' => '請求書送付日',
        'mail_nouhin' => '請求書メール区分',
        'mail_toiawase' => '請求書メール宛先',
        'mail_soushin_mb' => '請求書UIS',
        'mail_jyushin_mb' => '請求書郵送',
        'mail_nouhin_mb' => '請求書郵送先',
        'mail_toiawase_mb' => '請求税区分',
        'mallsoukobango1' => '請求税端数区分',
        'datatxt0051' => '請求消費税計算区分',
        'mallsoukobango2' => '専伝区分',
        'mallsoukobango3' => '指定納品書帳票CD',
        'kaiinbango' => '取引開始日 東直',
        'zokugara' => '取引開始日 東流',
        'haisoujouhou_name' => '取引開始日 西直',
        'haisoujouhou_yubinbango' => '取引開始日 西流',
        'kcode4' => 'ユーザー区分',
        'haisoujouhou_address' => '単価設定区分',
        'haisoujouhou_tel' => '支払締め日',
        'mail' => '支払月',
        'sex' => '支払日',
        'bunrui1' => '支払日休日設定',
        'bunrui2' => '支払振込手数料設定',
        'syukeinenkijun' => '支払振込手数料区分',
        'bunrui3' => '支払方法',
        'datatxt0054' => '振込銀行',
        'datatxt0055' => '振込支店',
        'endtime' => '預金種別',
        'datatxt0056' => '口座番号',
        'datatxt0057' => '口座名義人',
        'syukei3' => '支払手形サイト',
        'syukeiki' => '仕向銀行',
        'bunrui4' => '支払税区分',
        'bunrui5' => '支払税端数区分',
        'syukei2' => '源泉税率',
        'bunrui9' => '手形決済月',
        'datatxt0052' => '仕入消費税計算区分',
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
