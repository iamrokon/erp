<?php

namespace App\Http\Controllers\master;
use Illuminate\Http\Request;
use App\tantousya;
use App\kengen;
use App\requestTable;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\master\companyMaster\createCompanyMaster;
use App\AllClass\master\companyMaster\companyHeaders;
use App\AllClass\ButtonMsg;
use App\AllClass\master\companyMaster\HeaderMsg;
use App\AllClass\TableSettHeaderMsg;
use App\AllClass\master\companyMaster\editCompanyMaster;
use App\AllClass\SearchClass;
use App\AllClass\SortClass;
use Illuminate\Pagination\Paginator;
use App\AllClass\master\excelDownload;
use App\AllClass\master\companyMaster\allCompany;
use App\syouhin1;
use App\kokyaku1;
use App\haisou;
use App\haisoujouhou;
use App\etsuransya;
use App\AllClass\TableSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Excel;
use App\AllClass\master\ExcelReportDownload;
use Carbon\Carbon;
use App\AllClass\master\csvRecordRetrieve;
Use App\AllClass\master\csvRecordDelete;
use App\AllClass\master\CSVLogger;
use URL;
use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;
use App\Helpers\Helper;

class CompanyMasterController extends Controller
{
    private $headers = [
            '会社CD'=>'yobi12',
            '会社名'=>'name',
            '会社名略称'=>'address',
            '会社名カナ'=>'furigana',
            '入力区分'=>'yubinbango',
            '帝国ﾃﾞｰﾀﾊﾞﾝｸ信用録PDF'=>'yobi13_short',
            '信用録書類保管番号' => 'bunrui6',
            '帝国ﾃﾞｰﾀﾊﾞﾝｸ取得年月日'=>'tel',
            '帝国ﾃﾞｰﾀﾊﾞﾝｸ企業CD'=>'fax',
            '帝国ﾃﾞｰﾀﾊﾞﾝｸ評点'=>'torihikisakibango',
            '経済産業省業種区分1'=>'tantousya_detail',
            '経済産業省業種区分2'=>'kcode1_detail',
            '基本業種'=>'kcode2_detail',
            '備考'=>'kensakukey',
            '即時区分'=>'kcode3',
            '請求締め日'=>'ytoiawsestart_detail',
            '入金方法'=>'ytoiawseend_detail',
            '入金月'=>'ytoiawsesaiban',
            '入金日'=>'yetoiawsestart',
            '入金日休日設定'=>'yetoiawseend',
            '入金振込手数料設定'=>'yetoiawsesaiban',
            '与信限度額'=>'formatted_denpyostart',
            '請求先CD'=>'mail_soushin',
            '請求書送付日'=>'mail_jyushin',
            '請求書メール区分'=>'mail_nouhin',
            '請求書メール宛先'=>'mail_toiawase',
            '請求書UIS'=>'mail_soushin_mb',
            '請求書郵送'=>'mail_jyushin_mb',
            '請求書郵送先CD'=>'mail_nouhin_mb',
            '請求課税区分'=>'mail_toiawase_mb_detail',
            '請求税端数区分'=>'mallsoukobango1_detail',
            '専伝区分'=>'mallsoukobango2',
            '指定納品書帳票CD'=>'mallsoukobango3',
            'ユーザー区分'=>'kcode4',
            'データソース'=>'kcode5_detail',
            '販売ランク'=>'domain_detail',
            '顧客深耕層別化'=>'domain2_detail',
            '得意先分類3'=>'datatxt0058_detail',
            '得意先分類4'=>'datatxt0059_detail',
            '得意先分類5'=>'datatxt0060_detail',
            '得意先分類6'=>'datatxt0061_detail',
            '年商'=>'stoiawsestart_detail',
            '従業員'=>'stoiawseend_detail',
            '資本金'=>'stoiawsesaiban_detail',
            '取引開始日 東直'=>'kaiinbango',
            '取引開始日 東流'=>'zokugara',
            '取引開始日 西直'=>'haisoujouhou_name',
            '取引開始日 西流'=>'haisoujouhou_yubinbango',
            '単価設定区分'=>'haisoujouhou_address_detail',
            '支払締め日'=>'haisoujouhou_tel_detail',
            '支払月'=>'mail',
            '支払日'=>'sex_detail',
            '支払日休日設定'=>'bunrui1',
            '支払振込手数料設定'=>'bunrui2',
            '支払振込手数料区分'=>'syukeinenkijun_detail',
            '支払方法'=>'bunrui3_detail',
            '振込銀行'=>'datatxt0054',
            '振込支店'=>'datatxt0055',
            '預金種別'=>'endtime',
            '口座番号'=>'datatxt0056',
            '口座名義人'=>'datatxt0057',
            '支払手形サイト'=>'syukei3',
            '仕向銀行'=>'syukeiki_detail',
            '仕向支店'=>'datatxt0053_detail',
            '支払課税区分'=>'bunrui4_detail',
            '支払税端数区分'=>'bunrui5_detail',
            '源泉税率'=>'syukei2',
            '手形決済月'=>'bunrui9',
            '手形決済日'=>'bunrui10',
            '保守更新案内有無'=>'netusername_detail',
            'ライセンス証書有無'=>'netuserpasswd_detail',
            '検収条件'=>'netlogin_detail',
            '法人マイナンバー'=>'kounyusu',
            '会計取引先CD'=>'syukeitukikijun',
            '旧取引先CD' => 'syukeinen',
            '売上区分'=>'syukeituki',
            '仕入区分'=>'syukeikikijun',
            '会社名カナ入金消込用'=>'datatxt0050',
            '請求消費税計算区分'=>'datatxt0051',
            '支払消費税計算区分'=>'datatxt0052',
            '登録年月日'=>'created_date',
            '登録時刻'=>'created_time',
            '更新年月日'=>'edited_date',
            '更新時刻'=>'edited_time',
           // '更新時端末IP'=>'sekessaihouhou',
            '更新者'=>'user_name',
        ];


    public function postCompanyMaster(Request $request)
    {

        $bango=request('userId');

        $data_from_view=$request->all();
        $data_from_view_session=$request->all();
        session()->put('oldInput'.$bango,$data_from_view_session);

        //string to int conversion search, check leading zeroes, lzc=leading zero check
        $lzcKeys = ['yobi12_search_sort','syukeinen_search_sort','mail_soushin_search_sort','mail_nouhin_mb_search_sort','mallsoukobango3_search_sort'];
        $data_from_view = $this->stringToIntSearch($data_from_view, $lzcKeys);

        $tantousya =  QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();

        $buttonMessage = ButtonMsg::read($bango);
        $headerMessage = HeaderMsg::msg($bango);
        $tableSettHeaderMsg = TableSettHeaderMsg::msg($bango);

        if (!empty(request('pagination'))) {
            $pagination=request('pagination');
        }else{
            $pagination=20;
        }

        $popUpData['kokyaku1'] = QueryHelper::select(['*'])->from('kokyaku1')->where("denpyosaiban = 0")->orderBy("bango asc")->get()->execute();
        $popUpData['haisou'] = QueryHelper::select(['*'])->from('haisou')->get()->execute();
        $popUpData['etsuransya'] = QueryHelper::select(['*'])->from('etsuransya')->get()->execute();

        if (!empty($data_from_view['chkboxinp'])) {
            $deleted_item=$data_from_view['chkboxinp'];
        }
        else{
             $deleted_item=0;
        }

        $headers=companyHeaders::headers($bango);
        $table_headers = companyHeaders::headers($bango,'table_headers');
        $page_no = companyHeaders::$page_no;
        $route = 'companyMasterTableSetting';
        $redirect_path = 'companyMasterReload';

        $yubinbango_color = '0801入力区分';
        $request_yubinbango = QueryHelper::select(['*'])->from('request')->where(" color = '$yubinbango_color'")->orderBy("syouhinbango asc")->get()->execute();

        $reg_tantousya = QueryHelper::fetchResult("select * from categorykanri where category1 = 'A1' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $kcode1 = QueryHelper::fetchResult("select * from categorykanri where category1 = 'A2' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $kcode2 = QueryHelper::fetchResult("select * from categorykanri where category1 = 'A3' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $stoiawsestart = QueryHelper::fetchResult("select * from categorykanri where category1 = 'A4' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $stoiawseend = QueryHelper::fetchResult("select * from categorykanri where category1 = 'A5' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $stoiawsesaiban = QueryHelper::fetchResult("select * from categorykanri where category1 = 'A6' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $ytoiawsestart = QueryHelper::fetchResult("select * from categorykanri where category1 = 'A8' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $ytoiawseend = QueryHelper::fetchResult("select * from categorykanri where category1 = 'A9' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $yetoiawsestart_color = '0801回収日';
        $yetoiawsestart = QueryHelper::select(['*'])->from('request')->where(" color = '$yetoiawsestart_color'")->orderBy("bango asc")->get()->execute();

        $netusername = QueryHelper::fetchResult("select * from categorykanri where category1 = 'F6' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $netuserpasswd = QueryHelper::fetchResult("select * from categorykanri where category1 = 'F6' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $netlogin = QueryHelper::fetchResult("select * from categorykanri where category1 = 'U2' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $mail_toiawase_mb = QueryHelper::fetchResult("select * from categorykanri where category1 = 'B1' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $mallsoukobango1 = QueryHelper::fetchResult("select * from categorykanri where category1 = 'B2' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $domain = QueryHelper::fetchResult("select * from categorykanri where category1 = 'B4' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $domain2 = QueryHelper::fetchResult("select * from categorykanri where category1 = 'B5' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $datatxt0058 = QueryHelper::fetchResult("select * from categorykanri where category1 = 'B6' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $datatxt0059 = QueryHelper::fetchResult("select * from categorykanri where category1 = 'B7' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $datatxt0060 = QueryHelper::fetchResult("select * from categorykanri where category1 = 'B8' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $datatxt0061 = QueryHelper::fetchResult("select * from categorykanri where category1 = 'H8' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $haisoujouhou_address = QueryHelper::fetchResult("select * from categorykanri where category1 = 'D6' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $kcode4_color = '0801ユーザー区分';
        $kcode4 = QueryHelper::select(['*'])->from('request')->where(" color = '$kcode4_color'")->orderBy("bango asc")->get()->execute();

        $kcode5 = QueryHelper::fetchResult("select * from categorykanri where category1 = 'E3' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $haisoujouhou_tel = QueryHelper::fetchResult("select * from categorykanri where category1 = 'D8' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $sex = QueryHelper::fetchResult("select * from categorykanri where category1 = 'F9' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $syukeinenkijun = QueryHelper::fetchResult("select * from categorykanri where category1 = 'F2' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $bunrui3 = QueryHelper::fetchResult("select * from categorykanri where category1 = 'D9' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $endtime_color = '0801預金種別';
        $endtime = QueryHelper::select(['*'])->from('request')->where(" color = '$endtime_color'")->orderBy("syouhinbango asc")->get()->execute();

        $syukeiki = QueryHelper::fetchResult("select * from categorykanri where category1 = 'H2' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $datatxt0053 = QueryHelper::fetchResult("select * from categorykanri where category1 = 'H3' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $bunrui4 = QueryHelper::fetchResult("select * from categorykanri where category1 = 'E1' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        $bunrui5 = QueryHelper::fetchResult("select * from categorykanri where category1 = 'E2' and (suchi2 = 0 or suchi2 is null) ORDER BY category2 ASC");

        //show page start here
        if(!empty($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls'))
        {
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp'];
            $query = allCompany::data($bango, $deleted_item);
            $temp_table = 'company_temp';
            try {
                //remove comma from formatted value
                $str_to_int = ['denpyostart'];
                foreach ($data_from_view as $key => $value) {
                    if (in_array($key, $str_to_int)) {
                        $data_from_view[$key] = str_replace(',', '', $data_from_view[$key]);
                    }
                }
                
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort') {
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);
                    $companyInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    if ($companyInfo->items() == null && $companyInfo->currentPage() != 1) {
                        $currentPage = ($companyInfo->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $companyInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);

                    }
                    if ($companyInfo->total() == 0) {
                        $exceedUser = '該当するデータがありません。';
                    } else {
                        $exceedUser = '';
                    }
                } else if ($data_from_view['Button'] == 'xls') {
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);
                    $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                    $headers = $this->headers;
                    $excelName = '会社マスタ.xlsx';
                    return $this->excelDownload($headers, $searched, $excelName);
                }

            } catch (\Exception $e) {
               $exceedUser='検索形式が間違っています。';
               $companyInfo = QueryHelper::fetchResult($query);
               $companyInfo = collect($companyInfo)->paginate($pagination);
            }

            return view('master.companyMaster.mainCompanyMaster',compact('bango','headers','table_headers','page_no','route','redirect_path','companyInfo','request_yubinbango','reg_tantousya','kcode1','kcode2','stoiawsestart','stoiawseend','stoiawsesaiban','ytoiawsestart','ytoiawseend','yetoiawsestart','netusername','netuserpasswd','netlogin','mail_toiawase_mb','mallsoukobango1','domain','domain2','datatxt0058','datatxt0059','datatxt0060','datatxt0061','haisoujouhou_address','kcode4','kcode5','haisoujouhou_tel','sex','syukeinenkijun','bunrui3','endtime','bunrui4','bunrui5','syukeiki','datatxt0053','tantousya','deleted_item','exceedUser','popUpData','buttonMessage','headerMessage','tableSettHeaderMsg'));
        }
        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;

        if(request('change_id')){
            $query = allCompany::data($bango, $deleted_item, request('change_id'));
        }else{
            $query = allCompany::data($bango, $deleted_item);
        }
            $companyInfo = QueryHelper::fetchResult($query);
            $companyInfo = collect($companyInfo)->paginate($pagi);

            session()->forget('oldInput' . $bango);
            return view('master.companyMaster.mainCompanyMaster',compact('bango','headers','table_headers','page_no','route','redirect_path','companyInfo','request_yubinbango','reg_tantousya','kcode1','kcode2','stoiawsestart','stoiawseend','stoiawsesaiban','ytoiawsestart','ytoiawseend','yetoiawsestart','netusername','netuserpasswd','netlogin','mail_toiawase_mb','mallsoukobango1','domain','domain2','datatxt0058','datatxt0059','datatxt0060','datatxt0061','haisoujouhou_address','kcode4','kcode5','haisoujouhou_tel','sex','syukeinenkijun','bunrui3','endtime','bunrui4','bunrui5','syukeiki','datatxt0053','tantousya','pagi','deleted_item','popUpData','buttonMessage','headerMessage','tableSettHeaderMsg'));
    }

    public function postEditCompanyMaster(Request $request, $bango)
    {
        //create & edit start here
        if (request('type') == 'create')
        {
            $file = $request->file('filename');


           $insert= createCompanyMaster::create($request->all(),$bango,$file,$this->headers);

            if (is_array($insert) && $insert['status'] == 'ok') {
                $company_info =  QueryHelper::select(['*'])->from('kokyaku1')->orderBy('bango desc')->get()->first();
                $last_inserted_bango = $company_info->yobi12;
                Session::flash('success_msg','会社CD　'.$last_inserted_bango.' 登録完了しました。');

                return $insert;
            }elseif(is_array($insert) && $insert['status'] == 'ng'){
               Session::flash('failure_msg','間違えました。');
               return $insert;
            }else if($insert == 'confirmation'){
                return "confirmation_msg"; 
            }else{
               $errors=$insert->all();
               return ['err_field'=>$insert,'err_msg'=>$errors];
           }
        }
        elseif (request('type') == 'edit')
        {
            $file = $request->file('filename');
            $insert= editCompanyMaster::edit($request->all(),$bango,$file,$this->headers);
            if (is_array($insert) && $insert['status'] == 'ok') {
               $company_info_bango = $request['yobi12'];
               Session::flash('success_msg','会社CD '.$company_info_bango.' 変更完了しました。');

               return $insert;
            }elseif(is_array($insert) && $insert['status'] == 'ng'){
               Session::flash('failure_msg','間違えました。');
               return $insert;
            }else if($insert == 'confirmation'){
                return "confirmation_msg"; 
            }else{
               $errors=$insert->all();
               return ['err_field'=>$insert,'err_msg'=>$errors];
            }
        }
        //create & edit end here
    }

    public function companyMasterDetail(Request $request, $bango)
    {
        $id=$request['id'];
        $query = allCompany::data($bango, '*', $id);
        $data = collect(QueryHelper::fetchSingleResult($query))->toArray();
        $array = [];
        foreach ($data as $key => $value) {
            $array[$key] = $value;
        }
        $array['base_url'] = URL::to('/');
        return $array;

    }

    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = companyHeaders::$page_no;
        return $Setting =TableSetting::setting($this->headers,$id,$pageNo);

    }

    public function tableSettingSave(Request $request, $id,$type=null)
    {

        $pageNo = companyHeaders::$page_no;
        TableSetting::settingSave($request, $id, $pageNo,$this->headers,'会社マスタ',$type);
    }


    public function deleteOrReturnCompany(Request $request, $bango,$type = null)
    {
        $bangoName=tantousya::find($bango)->name;

        $id=$request->all();
        $kesuId=array_keys($id)[0];

        $mytime = Carbon::now()->toDateTimeString();
        $mytime=str_replace(":","",$mytime);
        $mytime=str_replace("-","",$mytime);
        $mytime=str_replace(" ","",$mytime);

        $query = allCompany::data($bango, '*', $kesuId);
        $deleteBefore = QueryHelper::fetchSingleResult($query);

        //start log query
        $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 会社マスタ start\n";
        QueryHandler::logger($bango,$log_data);

        if($type ==1){
            $update_data = [
               'bango' => $kesuId,
               'denpyosaiban' => 0,
               'sokurijyouhinmei' => $mytime,
               'pointterm' => $bango,
              // 'sekessaihouhou' => Helper::getSystemIP()
            ];
            QueryHelper::updateData('kokyaku1',$update_data,'bango',$bango,__CLASS__,__FUNCTION__,__LINE__);
        }else{
            $update_data = [
               'bango' => $kesuId,
               'denpyosaiban' => 1,
               'sokurijyouhinmei' => $mytime,
               'pointterm' => $bango,
            //   'sekessaihouhou' => Helper::getSystemIP()
            ];
            QueryHelper::updateData('kokyaku1',$update_data,'bango',$bango,__CLASS__,__FUNCTION__,__LINE__);
        }

        //end log query
        $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 会社マスタ end\n";
        QueryHandler::logger($bango,$log_data);

        $query = allCompany::data($bango, '*', $kesuId);
        $deleteAfter = QueryHelper::fetchSingleResult($query);

        $headers=$this->headers;
        $headers['データ有効区分']='denpyosaiban';
        if ($type == 1) {
            CSVLogger::putData('会社マスタ.csv', 'kokyaku1', $deleteBefore, $deleteAfter, $bangoName, $headers, 3);
        } else {
            CSVLogger::putData('会社マスタ.csv', 'kokyaku1', $deleteBefore, $deleteAfter, $bangoName, $headers, 0);
        }

        return 'ok';
    }


    public function billingSearch(Request $request, $id)
    {
       $searchType = request('searchType');
       $searchData = request('searchData');
       $html="";
       if($searchType == "part1"){
           $kokyaku1Info = kokyaku1::where("name",$searchData)->get();
           if($kokyaku1Info){
               foreach($kokyaku1Info as $kokyaku1Inf){
                  $html.= '<tr class="comp_content1_row table_hover2 gridAlternada">';
                    $html.= '<td style="width: 50px; text-align: center;">'.$kokyaku1Inf->yobi11.'</td>';
                    $html.='<td>'.$kokyaku1Inf->name.'</td>';
                $html.= '</tr>';
               }
               return $html;
           }
       }
    }


    public function categoryWiseCategory($bango)
    {
        $categoryType = request('category_type') ? trim(\request('category_type')) : null;
        $categoryValue = request('category_value') ? trim(\request('category_value')) : null;
        $type = request('type');
        $currentCategory = '';
        $length = null;
        if ($categoryType == 'A1' || $type == "A1") {
            $currentCategory = 'A2';
            if($categoryType != ""){
                $categories = DB::table('categorykanri')->where('category1', $currentCategory)->where('suchi2', 0)->whereRaw('substring(category2,1,1) = ?', $categoryValue)->get();
            }else{
                $categories = DB::table('categorykanri')->where('category1', $currentCategory)->where('suchi2', 0)->get();
            }

        }

        $html = '<option data-categoryType="null" data-categoryValue="null"  value="">-</option>';
        if (isset($categories)) {
            foreach ($categories as $category) {
                $html .= "<option data-categoryType=" . $category->category1 . " data-categoryValue=" . $category->category2 . " value=" . $category->category1 . $category->category2 . ">" . $category->category1 . $category->category2 . " " . $category->category4 . "</option>";
            }
            return $html;
        } else {
            return $html;
        }
    }


    public function getExtraShowingData($bango){
        $value = request('value');
        $part1 = substr($value, 0,6);
        $part2 = substr($value, 6,2);
        $part3 = substr($value, 8,3);

        $kokyaku1 = QueryHelper::fetchSingleResult("select * from kokyaku1 where yobi12 = '$part1' ");
        if($kokyaku1){
            $address = $kokyaku1->address;
            $haisou = QueryHelper::fetchSingleResult("select * from haisou where shikibetsucode = '$part1' and torihikisakibango = '$part2' ");
            if($haisou){
                $haisou_bango = $haisou->bango;
                $haisoumoji1 = $haisou->haisoumoji1;
                $etsuransya = QueryHelper::fetchSingleResult("select * from etsuransya where datanum0018 = '$haisou_bango' and datatxt0049 = '$part3' ");
                if($etsuransya){
                    $etsuransya_tantousya = $etsuransya->tantousya;
                    $extra_data = $address."/".$haisoumoji1."/".$etsuransya_tantousya;
                    return $extra_data;
                }else{
                    return "not_found";
                }
            }else{
                return "not_found";
            }
        }else{
            return "not_found";
        }

    }



}
