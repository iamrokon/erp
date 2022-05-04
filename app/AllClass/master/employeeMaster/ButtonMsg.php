<?php

namespace App\AllClass\master\employeeMaster;


use DB;
use App\tantousya;
Use \Carbon\Carbon;
Use App\AllClass\master\csvRecordInsert;
Use App\AllClass\master\employeeMaster\validateEmployeeMaster;
use App\AllClass\master\employeeMaster\allTantousya;
use Illuminate\Support\Facades\Schema;

Class ButtonMsg{ 
    
    public static function read($bango){
       $buttonMsg = [
            'search' => '検索欄に入力した内容を検索します。',
            'refresh' => 'データを一覧表示します。',
            'insert' => '新規登録画面を表示します。',
            'ecxel' => 'データをEXCELファイルとしてダウンロードします。',
            'reg' => 'データを登録します。',
            'edit' => 'データを更新します。',
            'edit_open' => '変更画面へ遷移します。',
            'delete' => 'データを削除します。削除したデータは一覧画面の「削除データ表示」にチェックをすると表示さ。',
            'delete_dt_display' => '削除したデータを表示します。',
            'pagination' => '1ページに表示する行数を変更します。',
            'return' => '削除したデータを戻します。',
            'sett_select_all' => 'チェックボックスをすべて選択します。',
            'sett_deselect_all' => 'チェックボックスの選択をすべて解除します。',
            'sett_default' => 'デフォルト設定を表示します。',
            'sett_save' => '設定したカラムを保存します。',
        ];
       return $buttonMsg;
    }   
    
//  public static function read($bango)
//  {
//       $filename='message.csv';
//       $csvfile = 'message/'.$filename;
//       
//        
//        if (file_exists($csvfile)) 
//        {
//           $file = fopen($csvfile,"r");
//           $datamsg=file($csvfile);
//           fclose($file);
//        }
//        foreach ($datamsg as $key => $value) 
//        {
//            $val=explode(',', $value);
//            $msgArray[$val[0]]=$val[1];
//        }
//
//        return $msgArray;
//  } 

} 
