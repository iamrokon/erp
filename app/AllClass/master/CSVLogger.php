<?php

namespace App\AllClass\master;

use DB;
Use \Carbon\Carbon;
use App\tantousya;
use Illuminate\Support\Facades\Schema;

Class CSVLogger
{

    public static function putData($filename, $tableName, $tableData1, $tableData2, $bangoName, $headers, $mode)
    {
        $current_mode = [0 => 'DELETE', 1 => 'INSERT', 2 => 'UPDATE', 3 => 'RETRIEVE'];
        $current_mode = $current_mode[$mode];
        $csvfile = 'logfile/' . $filename;

        if (!file_exists($csvfile)) {
            $data = '変更日時,ユーザーID,内容,作業内容';

            foreach ($headers as $key => $value) {
                $data .= ',' . $key;
            }
            $list = array
            (
                $data
            );
            $file_handle = fopen($csvfile, 'a');
            foreach ($list as $line) {
                fputcsv($file_handle, explode(',', mb_convert_encoding($line, "SJIS", "UTF-8")));
            }
            fclose($file_handle);
        }
        $mytime = Carbon::now()->toDateTimeString();
        //$ip = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : null;
        $data1 = $mytime . ',' . $bangoName . ',変更前,' . $current_mode;
        $data2 = $mytime . ',' . $bangoName . ',変更後,' . $current_mode;

        //$csvfile = 'logfile/'.$filename;
        //$headers= Schema::getColumnListing($tableName);

        foreach ($headers as $key => $value) {
            $data1 .= ',' . $tableData1->$value;
        }
        foreach ($headers as $key => $value) {
            $data2 .= ',' . $tableData2->$value;
        }

        if ($mode == 1) {
            $list = [$data1];
        } else {
            $list = [$data1, $data2];
        }




        $file_handle = fopen($csvfile, 'a');

        foreach ($list as $line) {
            fputcsv($file_handle, explode(',', mb_convert_encoding($line, "SJIS", "UTF-8")));
        }
        fclose($file_handle);

    }
}
