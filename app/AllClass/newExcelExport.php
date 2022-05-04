<?php

namespace App\AllClass;


class newExcelExport
{
	public static function download($data,$header_field,$filename)
    {
        $header = array_keys($header_field);
        $header_names = array_values($header_field);
        $excel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $excel->getActiveSheet();
        // dd($excel,$sheet,$data,$header,$header_field,$filename,$data[0]->bango);
        $column = 'A';
        foreach($header as $head) {
            $sheet->setCellValueExplicit($column . '1' ,  $head, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $column++;
        }

        $excel_key = 2;
        foreach($data as $row) {
            $column = 'A';
            foreach($header_names as $header_name) {
                $sheet->setCellValueExplicit($column . $excel_key,  $row->$header_name, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $column++;
            }
            $excel_key++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;');
        header("Content-Disposition: attachment; filename=\"{$filename}\"");
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($excel, 'Xlsx');
        ob_end_clean();
        $writer->save('php://output');

        return;
    }
}
