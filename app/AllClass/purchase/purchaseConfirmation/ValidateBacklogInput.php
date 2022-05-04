<?php

namespace App\AllClass\purchase\purchaseConfirmation;

use DB;
use Illuminate\Support\Facades\Validator;
use App\AllClass\specialCharValidation;
use App\AllClass\zenkaku;
use Illuminate\Support\Facades\Input;

Class ValidateBacklogInput{
  public static function validate($request,$bango)
  { 
    $request = $request->all();
    $rules=[];
     
    if(request('datachar10_detail') == "" && request('information2_detail') == "" && request('datachar11_detail') == ""){
       $rules['all'] = ['required'];
    }else{
        $rules['all'] = ['nullable'];
    }
    
    $message=[];    
    $message['required']='受注先、売上請求先、最終顧客のいずれかを指定してください。';
    
    $attributes = [
        'all' => '受注先,売上請求先,最終顧客',
    ];
    

    $validator = Validator::make($request,$rules,$message,$attributes);    

    return $validator;
  }   
} 
