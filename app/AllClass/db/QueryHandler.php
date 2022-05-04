<?php

namespace App\AllClass\db;

class QueryHandler
{
	public static function logger($id,$log_data)
	{
        $log_file_name = 'log/'.date('Ymd').'_'.$id.'.txt';
		if (!file_exists('log/'))
        {
            mkdir('log/', 0777, true);
        }
        $file = fopen($log_file_name,'a');
        fwrite($file,$log_data);
        fclose($file);
	}
    public static function log_data_formatter($file_name,$function,$line_no,$query,$table)
    {
        return date('Y-m-d H:i:s')." ".$file_name." ".$function." ".$line_no." ".$query."\n".date('Y-m-d H:i:s')." ".$file_name." ".$function." ".$line_no." ".$table." end\n";
    }
}
