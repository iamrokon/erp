<?php

namespace App\AllClass\master;

use DB;
Use \Carbon\Carbon;
use App\tantousya;
use Illuminate\Support\Facades\Schema;

Class csvRecordInsert{

    public static function putData($filename,$tableName,$tableData,$bangoName,$headers)
    {
        $csvfile = 'logfile/'.$filename;
        $columns= Schema::getColumnListing($tableName);

        if (!file_exists($csvfile)) 
        {
        $data =  '変更日時,ユーザーID,ルーターIP,内容,作業内容';

        foreach ($headers as $key => $value) 
        {
            $data .=','.$key;
        } 
        $list = array
        (
          $data
        );
        $file_handle = fopen($csvfile, 'a'); 
        foreach ($list as $line)
        {
         fputcsv($file_handle,explode(',',mb_convert_encoding($line, "SJIS", "UTF-8")));
        }
        fclose($file_handle);
        }

        $mytime = Carbon::now()->toDateTimeString();
        $ip=!empty($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:null;
        $data=$mytime.','.$bangoName.','.$ip.',変更前,INSERT';
        foreach ($headers as $key => $value) 
        {
           $data.=','.$tableData->$value;
        }
        $list = array
        (
          $data
        );
        
        $file_handle = fopen($csvfile, 'a'); 
        foreach ($list as $line)
        {
         fputcsv($file_handle,explode(',',mb_convert_encoding($line, "SJIS", "UTF-8")));
        }
        fclose($file_handle);
        
    }
}
