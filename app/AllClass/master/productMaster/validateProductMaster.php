<?php

namespace App\AllClass\master\productMaster;

use DB;
use Illuminate\Support\Facades\Validator;
use App\AllClass\specialCharValidation;
use App\AllClass\Mobile;
use App\AllClass\zenkaku;
use App\AllClass\AlphanumericKatakanaSymbolValidation;
use App\AllClass\master\productMaster\ValidateRange;
use App\AllClass\master\productMaster\specialCharValidation2;
use Illuminate\Support\Facades\Input;

Class validateProductMaster{
  public static function validate($request,$bango)
  {
    $rules=[];

    //if(Input::has('field')){
    //    $rules['kokyakusyouhinbango'] = ['required','max:5','regex:/^[0-9]+$/'];
    //}else{
    //    $rules['kokyakusyouhinbango'] = ['required','max:5','regex:/^[0-9]+$/',new specialCharValidation,'unique:syouhin1,kokyakusyouhinbango'];
    //}
    
    if(Input::has('field')){
        $rules['name'] = ['required','max:40',new zenkaku];
    }else{
        $rules['name'] = ['required','max:40',new specialCharValidation,new zenkaku];
    }
   
    $rules['jouhou'] = ['required'];
    
    $rules['koyuujouhou'] = ['required'];
   
    $rules['color'] = ['required'];
    
    $rules['yoyaku'] = ['nullable'];
    //$rules['yoyaku'] = ['nullable','max:4','regex:/^[0-9]+$/',new specialCharValidation];
    
    if(Input::has('field')){
        $rules['size'] = ['nullable','max:20',new zenkaku];
    }else{
        $rules['size'] = ['nullable','max:20',new specialCharValidation,new zenkaku];
    }
    
    $rules['kakaku'] = ['nullable','max:8','regex:/^[0-9]+$/'];
    $rules['hanbaisu'] = ['nullable','max:8','regex:/^[0-9]+$/'];
    $rules['jyougensu'] = ['nullable']; //,'gte:0'
    $rules['kakaku_yoyaku'] = ['nullable']; //,'gte:0'
    $rules['jouhou2'] = ['nullable','min:6','max:6','regex:/^[0-9]+$/'];
    
    if(Input::has('field')){
        $rules['chardata4'] = ['nullable','min:5','max:5','regex:/^[0-9]+$/'];
    }else{
        $rules['chardata4'] = ['nullable',"required_if:data100,D111,D131",'min:5','max:5','regex:/^[0-9]+$/'];
    }
    
    $rules['yoyakusu'] = ['nullable','max:8','regex:/^[0-9]+$/']; //new ValidateRange($request['jyougensu'],'基本販売価格'),new ValidateRange($request['yoyaku'],'PB販売金額')
    $rules['yoyakukanousu'] = ['nullable','max:8','regex:/^[0-9]+$/']; //new ValidateRange($request['jyougensu'],'基本販売価格'),new ValidateRange($request['yoyaku'],'PB販売金額')
    $rules['sortbango'] = ['nullable','max:8','regex:/^[0-9]+$/']; //new ValidateRange($request['jyougensu'],'基本販売価格'),new ValidateRange($request['yoyaku'],'PB販売金額')
    $rules['dataint01'] = ['nullable','max:8','regex:/^[0-9]+$/']; //new ValidateRange($request['jyougensu'],'基本販売価格'),new ValidateRange($request['yoyaku'],'PB販売金額')
    
    $rules['data25'] = ['required'];
    
    if(request('endtime') != ""){
        if(Input::has('field')){
            $rules['synchrosyouhinbango'] = ['nullable','max:8','regex:/^[0-9]+$/']; 
        }else{
            $rules['synchrosyouhinbango'] = ['nullable','max:8','date','regex:/^[0-9]+$/','before:endtime']; //'date_format:Y/m/d',
        }
    }else{
        if(Input::has('field')){
            $rules['synchrosyouhinbango'] = ['nullable','max:8','regex:/^[0-9]+$/'];
        }else{
           $rules['synchrosyouhinbango'] = ['nullable','max:8','date','regex:/^[0-9]+$/']; 
        }
    }
    
    if(Input::has('field')){
        $rules['endtime'] = ['nullable','max:8','regex:/^[0-9]+$/']; 
    }else{
        $rules['endtime'] = ['nullable','max:8','date','regex:/^[0-9]+$/','after:synchrosyouhinbango']; //'date_format:Y/m/d',
    }
   
    $rules['data52'] = ['required'];
    $rules['data100'] = ['required'];
    $rules['data29'] = ['required'];
    $rules['url'] = ['required'];
   
    if(Input::has('field')){
        //$rules['kongouritsu'] = ['nullable','max:13','regex:/^[a-zA-Z0-9]+$/'];
        $rules['kongouritsu'] = ['nullable','max:13',new AlphanumericKatakanaSymbolValidation];
    }else{
        $rules['kongouritsu'] = ['nullable','max:13',new specialCharValidation2,new AlphanumericKatakanaSymbolValidation];
    }
    
    if(Input::has('field')){
        $rules['mdjouhou'] = ['nullable','max:40',new zenkaku];
    }else{
        $rules['mdjouhou'] = ['nullable','max:40',new specialCharValidation,new zenkaku];
    }
    
    if(Input::has('field')){
        $rules['konpoumei'] = ['nullable','max:2',new zenkaku];
    }else{
        $rules['konpoumei'] = ['nullable','max:2',new specialCharValidation,new zenkaku];
    }

    $message=[];    
    $message['required']='【:attribute】必須項目に入力がありません。';
    $message['chardata4.required_if']='【:attribute】必須項目に入力がありません。';
    $message['unique']='【:attribute】の入力が重複しています。';
    $message['max']='【:attribute】:max桁以下で入力してください。';
    $message['jouhou2.max']='【:attribute】:max桁で入力してください。';
    $message['jouhou2.min']='【:attribute】:min桁で入力してください。';
    $message['chardata4.max']='【:attribute】:max桁で入力してください。';
    $message['chardata4.min']='【:attribute】:min桁で入力してください。';
    $message['min']='【:attribute】の入力は:min文字以上必要です。';
    $message['innerlevel.max']='【:attribute】の入力形式が間違っています。';
    $message['regex']='【:attribute】半角英数字以外は使用できません。';
    $message['numeric']='【:attribute】入力形式が間違っています。';
    $message['email']='【:attribute】の入力形式が間違っています。';
    $message['date']='【:attribute】入力形式が間違っています。';
    $message['date_format']='【:attribute】yyyy/mm/ddの形式で入力してください。';
    $message['before']='【:attribute】終売日より未来の日付は設定できません。';
    $message['after']='【:attribute】上市開始日より過去の日付は設定できません。';
    $message['kokyakusyouhinbango.regex']='【:attribute】半角数字以外は使用できません。';
    $message['chardata4.regex']='【:attribute】半角数字以外は使用できません。';
    $message['jouhou2.regex']='【:attribute】半角数字以外は使用できません。';
    $message['kakaku.regex']='【:attribute】半角数字以外は使用できません。';
    $message['hanbaisu.regex']='【:attribute】半角数字以外は使用できません。';
    $message['jyougensu.regex']='【:attribute】半角数字以外は使用できません。';
    $message['yoyaku.regex']='【:attribute】半角数字以外は使用できません。';
    $message['yoyakusu.regex']='【:attribute】半角数字以外は使用できません。';
    $message['yoyakukanousu.regex']='【:attribute】半角数字以外は使用できません。';
    $message['sortbango.regex']='【:attribute】半角数字以外は使用できません。';
    $message['dataint01.regex']='【:attribute】半角数字以外は使用できません。';
    $message['kokyakusyouhinbango.unique']='【:attribute】このコードはすでに登録されています。';
    $message['jyougensu.gte']='【:attribute】合計金額が基本販売価格を上回っています。';
    $message['kakaku_yoyaku.gte']='【:attribute】合計金額がPB販売価格を上回っています。';

    $attributes = [
        'kokyakusyouhinbango' => '商品CD',
        'name' => '商品名',
        'jouhou' => '品目群CD',
        'koyuujouhou' => '製品区分',
        'color' => '品目区分',
        'yoyaku' => 'バージョン',
        'data23' => 'サブ区分',
        'size' => '商品名略称',
        'kakaku' => '基本販売価格',
        'hanbaisu' => 'PB販売価格',
        'jyougensu' => '営業粗利',
        'kakaku_yoyaku' => 'PB営業粗利',
        'jouhou2' => '受注先限定',
        'chardata4' => 'セット商品上位CD',
        'yoyakusu' => '仕入価格',
        'yoyakukanousu' => '仕切(SE)',
        'sortbango' => '仕切(研究所)',
        'dataint01' => '仕切(出荷ｾﾝﾀｰ)',
        'data25' => '入力区分２',
        'synchrosyouhinbango' => '上市開始日',
        'endtime' => '終売日',
        'data100' => '商品分類3',
        'data29' => '販売可能',
        'url' => '保守作成区分',
        'data52' => '製品仕入品区分',
        'data26' => '最新ﾊﾞｰｼﾞｮﾝ区分',
        'data101' => 'サービス内容',
        'data102' => '成果物',
        'data103' => '工数目安',
        'name2' => 'サービス内容（社内備考)',
        'kongouritsu' => 'メーカー品番',
        'mdjouhou' => 'メーカー品名',
        'konpoumei' => '単位',
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
