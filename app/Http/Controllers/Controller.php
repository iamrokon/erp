<?php

namespace App\Http\Controllers;
use App\AllClass\common\AllCompany_2;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
//use App\AllClass\db\QueryHelper;
use App\AllClass\SearchAndSortClass;
use App\AllClass\master\ExcelReportDownload;
use Excel;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use App\AllClass\common\AllCompany;
use App\AllClass\newExcelExport;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param array $dataFromView
     * @param array $removeKeys
     * @return array
     */
    public function removeDataFromView(array $dataFromView, array $removeKeys): array
    {
        $dataFromView = collect($dataFromView)->except($removeKeys)->toArray();
        return $dataFromView;

    }

    /**
     * @param string $query
     * @param array $data
     * @param string $bango
     * @param string $temp_table
     * @param int $pagination
     * @param string|null $from
     * @return Collection
     */
    public function searchDataFetch(string $query, array $data, string $bango, string $temp_table, int $pagination=null, string $from = null)
    {
        if ($from) {
            return collect( SearchAndSortClass::search($query, $data, $bango, $temp_table));
        }

        if($pagination == null){
            return collect(SearchAndSortClass::search($query, $data, $bango, $temp_table));
        }else{
           return collect(SearchAndSortClass::search($query, $data, $bango, $temp_table))->paginate($pagination);
        }

    }

    /**
     * @param array $headers
     * @param string $searched
     * @param string $excelName
     * @return mixed
     */
    public function excelDownload( $headers,  $searched,  $excelName)
    {
        ob_end_clean(); // this
        ob_start(); // and this
        //return Excel::download(new ExcelReportDownload($headers, $searched), $excelName);
        return newExcelExport::download($searched,$headers, $excelName);
    }


    /**
     * @param array $data_from_view
     * @param array $lzcKeys
     * lzcKeys leading zeros check
     * @return array
     */
    public function stringToIntSearch(array $data_from_view, array $lzcKeys)
    {
        foreach ($data_from_view as $key => $value) {
            if (in_array($key, $lzcKeys) && $data_from_view[$key] != "") {
                $data_from_view[$key] = ltrim($data_from_view[$key],'0');
            }
        }

        return $data_from_view;

    }

    //suppiler modal,company data
    public static function getCompanyData($bango){
        $condition = request('condition');
        $modal_type = request('modal_type');
        if($modal_type == 'v2'){
            $query = AllCompany_2::data($bango, 0,$condition);
            $data = QueryHelper::fetchResult($query);
        }else{
            $query = AllCompany::data($bango, 0,$condition);
            $data = QueryHelper::fetchResult($query);
        }
        return $data;
    }

    //supplier modal2_2,company data
    public static function getCompanyData_2($bango){
        $condition = request('condition');
        $query = AllCompany_2::data($bango, 0,$condition);
        $data = QueryHelper::fetchResult($query);
        return $data;
    }

    //suppiler modal,torihikisaki data
    public static function getTorihikisakiData($bango){
        $modal_type = request('modal_type');
        if($modal_type == 'short'){
            $torihikisaki_cd = request('torihikisaki_cd');
            $torihikisakiInfo = QueryHelper::fetchResult("select * from v_torihikisaki where substring(torihikisaki_cd,1,8) = '$torihikisaki_cd' LIMIT 1");
            return $torihikisakiInfo;
        }if($modal_type == 'min_short'){
            $torihikisaki_cd = request('torihikisaki_cd');
            $torihikisakiInfo = QueryHelper::fetchResult("select * from v_torihikisaki where yobi12 = '$torihikisaki_cd' LIMIT 1");
            return $torihikisakiInfo;
        }else{
            $torihikisaki_cd = request('torihikisaki_cd');
            $torihikisakiInfo = QueryHelper::fetchResult("select * from v_torihikisaki where torihikisaki_cd = '$torihikisaki_cd'");
            return $torihikisakiInfo;
        }
    }

    // @Todo 20220124
    // Details : Save the current page html to server /log/html_log
    /*public function saveHtmlContent(){
        $user = $_POST["bango"];
        $content = $_POST["usac_custom_html_content"];
        $directory = "log/html_log/$user";
        $filename = $directory . '/' . $user. '_'.date("YmdHis") . '.html';

        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        $myfile = fopen($filename, "w");
        fwrite($myfile, $content);
        fclose($myfile);
    }*/

    public function saveHtmlContent(){
 
        $user = $_POST["bango"];
        $html_content = $_POST["usac_custom_html_content"];
        $png_content = $_POST["usac_custom_png_content"];
        $directory = "log/html_log/". date("Ymd")."/$user";
      
        $filename_html = $directory . '/' . $user . '_' . date("YmdHis") . '.html';
        $filename_png = $directory . '/' . $user. '_'.date("YmdHis") . '.png';

        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
 
        // html content save
        $myfile = fopen($filename_html, "w");
        file_put_contents($filename_html, base64_decode($html_content));
        fwrite($myfile, $html_content);
        fclose($myfile);
        
        // png file save
        $data = $_POST["usac_custom_png_content"];

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);

        file_put_contents($filename_png, $data);
    }
    
}
