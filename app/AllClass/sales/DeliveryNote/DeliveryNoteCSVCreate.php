<?php


namespace App\AllClass\sales\DeliveryNote;


class DeliveryNoteCSVCreate
{
    public static function putData($filename, $headers, $searchedDatas)
    {
        if (!file_exists('uploads')) {
            mkdir('uploads', 0777, true);
        }
        if (!file_exists('uploads/delivery_notes')) {
            mkdir('uploads/delivery_notes', 0777, true);
        }
        $file = 'uploads/delivery_notes/' . $filename;
        if (file_exists($file)) {
            unlink($file);
        }
        $csvHeaders = array_keys($headers);
        $csvItem = array_values($headers);
        $str = null;
        foreach ($csvHeaders as $key => $value) {
            $str .= '"' . $value . '"' . ',';
        }
        $str .= "\n";
        foreach ($searchedDatas as $key => $data) {
            foreach ($csvItem as $k => $v) {
                $str .= '"' . $data->$v . '"' . ',';
            }
            $str .= "\n";
        }
        // $data=mb_convert_encoding($str,"SJIS", "utf8");
        $data = mb_convert_encoding($str, "utf8");

        $file = fopen($file, 'wb');
        fwrite($file, $data);
        fclose($file);
    }
}
