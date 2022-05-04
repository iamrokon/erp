<?php

namespace App\AllClass\other\dashboardComment;

use DB;
use Illuminate\Support\Facades\Validator;
use App\AllClass\specialCharValidation;
use App\AllClass\Mobile;
use Illuminate\Support\Facades\Input;

Class validateDashboardEditComment{
  public static function validate($request,$bango)
  {
    $processRequest = $request;
    $reqToChange = ['kinsyousu', 'kinsyousetteisu'];
    foreach ($processRequest as $key => $value) {
        if (in_array($key, $reqToChange)) {
            $processRequest[$key] = DashboardCommentEntry::stringDataConvertedToIntegerFormat($value);
        }
    }
//dd($processRequest);
    $formatArr=['jpeg','jpg','png','gif','bmp','pdf','tiff','tif'];
    $current_date=date('Ymd');
    $rules=[];

    if (Input::has("field")) {
        $rules['sitesyubetsu'] = ['required', 'max:50'];
        if ($processRequest['kinsyousu']!=null && $processRequest['kinsyousetteisu']!=null){
//            dd('hlw');
            if ($processRequest['kinsyousu'] < $current_date){
                $rules['kinsyousu'] = ['after:yesterday'];
            }
            elseif ($processRequest['kinsyousu']>$processRequest['kinsyousetteisu']){
                $rules['kinsyousetteisu'] = ['digits_between:0,8', new DateCheckGreaterThan('kinsyousu')];
            }
        }
        else{
            $rules['kinsyousu'] = ['required','digits_between:0,8','after:yesterday'];
            $rules['kinsyousetteisu'] = ['nullable'];
        }
        $rules['status_validate'] = ['required', 'max:500'];

        if(isset($processRequest['filename'])==false && $processRequest['hanbaimode'] == null){
            $rules['hanbaimode'] = ['nullable'];
            $rules['filename'] = ['nullable'];
        }
        elseif (isset($processRequest['filename'])==false && $processRequest['hanbaimode'] != null){
//        dd('2nd');
            if ($processRequest['hanbaimode'] != $processRequest['old_hanbaimode']){
                $rules['hanbaimode'] = ['mimes:jpeg,jpg,png,gif,bmp,pdf,tiff,tif'];
            }
        }
        elseif (isset($processRequest['filename'])==true && $processRequest['hanbaimode'] == null){
//          dd('3rd');
            $rules['hanbaimode'] = ['mimes:jpeg,jpg,png,gif,bmp,pdf,tiff,tif'];
        }
        elseif(isset($processRequest['filename'])==true && $processRequest['hanbaimode'] != null){
//        dd('hlw');
            if (substr_count(strtolower($processRequest['hanbaimode']),'.')>0){
                $fStatus=false;
                $extension=explode('.',strtolower($processRequest['hanbaimode']));
                foreach ($formatArr as $format){
//                  dd(substr_count(strtolower($processRequest['hanbaimode']),'.')==1);
                    if (end($extension)==$format){
                        $fStatus=true;
                        break;
                    }
                    else{
                        $fStatus=false;
                    }
                }
//              dd($fStatus);
                if ($fStatus==false){
//                  dd('4th');
                    $rules['hanbaimode'] = ['mimes:jpeg,jpg,png,gif,bmp,pdf,tiff,tif'];
                    $rules['filename'] = ['max:100000', 'mimes:jpeg,jpg,png,gif,bmp,pdf,tiff,tif'];
                }
                else{
//                  dd('5th');
                    $rules['hanbaimode'] = ['max:90'];
                    $rules['filename'] = ['max:100000', 'mimes:jpeg,jpg,png,gif,bmp,pdf,tiff,tif'];
                }
            }
            else{
//              dd('6th',substr_count(strtolower($processRequest['hanbaimode']),'.'));
                $rules['hanbaimode'] = ['mimes:jpeg,jpg,png,gif,bmp,pdf,tiff,tif'];
            }

//        dd(strtolower($processRequest['hanbaimode']),$fStatus);
        }
    }else {
        $rules['sitesyubetsu'] = ['required', 'max:50'];
        if ($processRequest['kinsyousu']!=null && $processRequest['kinsyousetteisu']!=null){
//            dd('hi');
            if ($processRequest['kinsyousu'] < $current_date){
                $rules['kinsyousu'] = ['after:yesterday'];
            }
            elseif ($processRequest['kinsyousu']>$processRequest['kinsyousetteisu']){
                $rules['kinsyousetteisu'] = ['digits_between:0,8', new DateCheckGreaterThan('kinsyousu')];
            }
        }
        else{
            $rules['kinsyousu'] = ['required','digits_between:0,8','after:yesterday'];
            $rules['kinsyousetteisu'] = ['nullable'];
        }
        $rules['status_validate'] = ['required', 'max:500'];
        if(isset($processRequest['filename'])==false && $processRequest['hanbaimode'] == null){
            $rules['hanbaimode'] = ['nullable'];
            $rules['filename'] = ['nullable'];
        }
        elseif (isset($processRequest['filename'])==false && $processRequest['hanbaimode'] != null){
//        dd('2nd');
            if ($processRequest['hanbaimode'] != $processRequest['old_hanbaimode']){
                $rules['hanbaimode'] = ['mimes:jpeg,jpg,png,gif,bmp,pdf,tiff,tif'];
            }
        }
        elseif (isset($processRequest['filename'])==true && $processRequest['hanbaimode'] == null){
//          dd('3rd');
            $rules['hanbaimode'] = ['mimes:jpeg,jpg,png,gif,bmp,pdf,tiff,tif'];
        }
        elseif(isset($processRequest['filename'])==true && $processRequest['hanbaimode'] != null){
//        dd('hlw');
            if (substr_count(strtolower($processRequest['hanbaimode']),'.')>0){
                $fStatus=false;
                $extension=explode('.',strtolower($processRequest['hanbaimode']));
                foreach ($formatArr as $format){
//                  dd(substr_count(strtolower($processRequest['hanbaimode']),'.')==1);
                    if (end($extension)==$format){
                        $fStatus=true;
                        break;
                    }
                    else{
                        $fStatus=false;
                    }
                }
//              dd($fStatus);
                if ($fStatus==false){
//                  dd('4th');
                    $rules['hanbaimode'] = ['mimes:jpeg,jpg,png,gif,bmp,pdf,tiff,tif'];
                    $rules['filename'] = ['max:100000', 'mimes:jpeg,jpg,png,gif,bmp,pdf,tiff,tif'];
                }
                else{
//                  dd('5th');
                    $rules['hanbaimode'] = ['max:90'];
                    $rules['filename'] = ['max:100000', 'mimes:jpeg,jpg,png,gif,bmp,pdf,tiff,tif'];
                }
            }
            else{
//              dd('6th',substr_count(strtolower($processRequest['hanbaimode']),'.'));
                $rules['hanbaimode'] = ['mimes:jpeg,jpg,png,gif,bmp,pdf,tiff,tif'];
            }

//        dd(strtolower($processRequest['hanbaimode']),$fStatus);
        }

    }

    $message=[];
    $message['required']='【:attribute】必須項目に入力がありません。';
    $message['unique']='【:attribute】の入力が重複しています。';
    $message['max']='【:attribute】:max文字以下で入力してください。';
    $message['hanbaimode.max']='【:attribute】ファイル名が長すぎます。';
    $message['min']='【:attribute】の入力は:min文字以上必要です。';
    $message['innerlevel.max']='【:attribute】の入力形式が間違っています。';
    $message['regex']='【:attribute】半角英数字以外は使用できません。';
    $message['numeric']='【:attribute】入力形式が間違っています。';
    $message['email']='【:attribute】の入力形式が間違っています。';
    $message['date']='【:attribute】入力形式が間違っています。';
    $message['mbcatch.regex']='【:attribute】入力形式が間違っています。';
    $message['mbcatchsm.regex']='【:attribute】入力形式が間違っています。';
    $message['date_format']='【:attribute】yyyy/mm/ddの形式で入力してください。';
    $message['before']='【:attribute】終売日より未来の日付は設定できません。';
    $message['after']='【:attribute】開始年月より過去の年月は設定できません。';
    $message['kinsyousu.after']='【:attribute】正しい年月日を入力してください。';
    $message['url.regex']='【:attribute】半角数字以外は使用できません。';
    $message['mimes'] = '【:attribute】このファイル形式には対応していません。';
    $message['hanbaimode.mimes']='【:attribute】このファイル形式には対応していません。';

    $attributes = [
        'sitesyubetsu' => 'タイトル',
        'kinsyousu' => '掲載開始日',
        'kinsyousetteisu' => '掲載終了日',
        'status_validate' => '内容',
        'hanbaimode' => '添付ファイル',
        'filename' => '添付ファイル'
    ];

    $validator = Validator::make($processRequest,$rules,$message,$attributes);

    return $validator;
  }
}
