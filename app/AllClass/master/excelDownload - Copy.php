<?php

namespace App\AllClass\master;

use DB;
use App\tantousya;



Class excelDownload{

    public static function read($request,$searched,$headers,$change){


        $variable= $searched->get(); 
        $export_data=null;

        /*$numItems = count($headers);
        $i = 0;
        foreach($headers as $key=>$value) 
        {
       
            $export_data.=$key."\t";
      
        }
        $export_data.="\n";*/
        ob_end_clean();
        ob_start();
        $export_data= '<table><tr>';
        foreach($headers as $key=>$value) 
        {
           
            $export_data.='<th style="border:1px solid black">'.$key.'</th>'."\t";
          
        }
        $export_data.='</tr>'."\r\n".'<tbody><tr>';

        foreach($variable as $k=>$val)
        {
            foreach ($headers as $field=>$Fname) 
            {
                $export_data.='<td style="border:1px solid black">'.$val->$Fname.'</td>'."\t";
            }

            $export_data.='</tr><tr>';
        }
        $export_data.='</tr>'.'</tbody></table>';
       
        //header('Content-type: application/ms-excel');

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="myfile.xlsx"');
    header('Cache-Control: max-age=0');
    echo $export_data; exit();

        

      
   }
}
