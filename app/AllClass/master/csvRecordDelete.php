<?php

namespace App\AllClass\master;

use DB;
Use \Carbon\Carbon;
use App\tantousya;
use Illuminate\Support\Facades\Schema;

Class csvRecordDelete{

    public static function putData($filename,$tableName,$tableData1,$tableData2,$bangoName,$headers)
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
        $data1=$mytime.','.$bangoName.','.$ip.',変更前,DELETE';
        $data2=$mytime.','.$bangoName.','.$ip.',変更後,DELETE';

        //$csvfile = 'logfile/'.$filename;
        //$headers= Schema::getColumnListing($tableName);
        foreach ($headers as $key => $value) 
        {
           $data1.=','.$tableData1->$value;
        }
        foreach ($headers as $key => $value) 
        {
           $data2.=','.$tableData2->$value;
        }
        $list = array
        (
          $data1,$data2
        );
        
        $file_handle = fopen($csvfile, 'a'); 
        foreach ($list as $line)
        {
         fputcsv($file_handle,explode(',',mb_convert_encoding($line, "SJIS", "UTF-8")));
        }
        fclose($file_handle);
        
    }
}
