<?php

namespace App\Http\Controllers\order;
use App\AllClass\master\nameMaster\allCategorykanri;
use Illuminate\Http\Request;
use App\tantousya;
use App\kengen;
use App\requestTable;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\order\backlogList2\BacklogList2Headers;
use App\AllClass\order\backlogList2\ValidateBacklogList2;
use App\AllClass\order\backlogList2\BacklogList2_1;
use App\AllClass\order\backlogList2\BacklogList2_2;
use App\AllClass\order\backlogList2\BacklogList2_3;
use App\AllClass\order\backlogList2\BacklogList2_4;
use App\AllClass\order\backlogList2\BacklogList2_5;
use App\AllClass\order\backlogList2\BacklogList2_6;
use App\AllClass\ButtonMsg;
use Illuminate\Pagination\Paginator;
use App\AllClass\master\excelDownload;
use App\kokyaku1;
use App\AllClass\TableSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Excel;
use App\AllClass\master\ExcelReportDownload;
use Carbon\Carbon;
use App\AllClass\master\CSVLogger;
use App\AllClass\newExcelExport;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;

class BacklogList2Controller extends Controller
{
    private $headers = [
        '番号' => 'jhvw001',
        '担当' => 'user_name',
        '受注先' => 'jhvw022_detail',
        '受注内容' => 'jhvw053',
        '受注日' => 'jhvw030',
        '納期' => 'jhvw031',
        '検収日' => 'jhvw033',
        '売上予定日' => 'jhvw032',
        '入金予定日' => 'jhvw034',
        '分類明細金額' => 'jhvw049',
        '粗利額' => 'jhvw048',
        '売上先' => 'jhvw023_detail',
        '最終顧客' => 'jhvw024_detail',
        '定期定額契約番号' => 'jhvw007',
        '受注番号' => 'order_number',
        '代理店1CD' => 'jhvw025_detail',
        '代理店2CD' => 'jhvw026_detail',
        '発注金額分類' => 'jhvw043',
        '事業部' => 'jhvw050',
        '部' => 'jhvw051',
        
    ];


    public function postBacklogList2(Request $request)
    {
        $bango = request('userId');

        //check validation for first search
        if($request->ajax()){
            $validator = ValidateBacklogList2::validate($request,$bango);
            $errors = $validator->errors();
            if($errors->any()){
               $err_msg = $errors->all();
               return ['err_field'=>$errors,'err_msg'=>$err_msg];
            }else{
                return "ok";
            }
        }

        $data_from_view = $request->all();//dd($data_from_view);
        $data_from_view_session = $request->all();
        session()->put('oldInput' . $bango, $data_from_view);

        $tantousya = tantousya::find($bango);

        //pull option selection starts here
        $data003=substr($tantousya->datatxt0003, 2,4);
        $data003_left=substr($tantousya->datatxt0003, 2,4);
        $data003_right=substr($tantousya->datatxt0003, 2,4);
        if (isset($data_from_view['division_datachar05_start'])) {
           $data003_left=substr($data_from_view['division_datachar05_start'], 2,4);
        }else if (isset($data_from_view['division_datachar05_startReqVal'])) {
           $data003_left=substr($data_from_view['division_datachar05_startReqVal'], 2,4);
        }
        if (isset($data_from_view['division_datachar05_end'])) {
           $data003_right=substr($data_from_view['division_datachar05_end'], 2,4);
        }if (isset($data_from_view['division_datachar05_endReqVal'])) {
           $data003_right=substr($data_from_view['division_datachar05_endReqVal'], 2,4);
        }
        $data004=substr($tantousya->datatxt0004, 2,5);
        $data005=substr($tantousya->datatxt0005, 2,6);
        $personal_datatxt0003=QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'B9' ")->where("category2 = '$data003' ")->get()->first();
        $personal_datatxt0004=QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C1' ")->where("category2 = '$data004' ")->get()->first();
        $personal_datatxt0005=QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("category2 = '$data005' ")->get()->first();
        //pull option selection ends here

        $buttonMessage = ButtonMsg::read($bango);

        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 20;
        }

        $default_content_setumei = $bango;
        $check_tan = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango'")->where("mail4 = 'C310'")->get()->execute();

        //review data
        $reviewData = QueryHelper::fetchSingleResult("select * from review where kokyakusyouhinbango = 'D7501'");
        $review_orderbango = $reviewData->orderbango;

        //get categorykanri data
        $B9Data_left = QueryHelper::fetchResult("select *,RIGHT(category2, 2) as category2_show from categorykanri where category1 = 'B9' and (suchi2 = 0 or suchi2 is null) and left(category2, 2) ='$review_orderbango' ORDER BY category2 ASC");
        $B9Data_right = QueryHelper::fetchResult("select *,RIGHT(category2, 2) as category2_show from categorykanri where category1 = 'B9' and (suchi2 = 0 or suchi2 is null) and left(category2, 2) ='$review_orderbango' ORDER BY category2 ASC");
        $C1Data_left = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C1' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_left%' ")->get()->execute();
        $C1Data_right = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C1' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_right%' ")->get()->execute();
        if (isset($data_from_view['department_datachar05_start'])) {
            $data003_left = substr($data_from_view['department_datachar05_start'],2,5);
            $data003_right = substr($data_from_view['department_datachar05_start'],2,5);
        }
        if (isset($data_from_view['group_datachar05_start'])) {
            $data003_short = substr($data_from_view['group_datachar05_start'],2,5);
            $data003 = substr($data_from_view['group_datachar05_start'],2,6);
            $C2Data_left = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_short%' ")->get()->execute();
            $C2Data_right = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_short%' ")->where("CAST(category2 as integer) >= $data003 ")->get()->execute();
        }else{
            $C2Data_left = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_left%' ")->get()->execute();
            $C2Data_right = QueryHelper::select(['category1','category2','category4'])->from('categorykanri')->where("category1 = 'C2' ")->where("left(category2, 2) ='$review_orderbango'")->where("category2 LIKE '%$data003_right%' ")->get()->execute();
        }
        
        //get tantousya data
        $datachar05 = QueryHelper::fetchResult("select * from tantousya where deleteflag = 0 and ztanka='$review_orderbango' and innerlevel >= 10 and innerlevel <= 20 order by bango");

        if (!empty($data_from_view['chkboxinp'])) {
            $deleted_item = $data_from_view['chkboxinp'];
        } else {
            $deleted_item = 0;
        }

        $headers = BacklogList2Headers::headers($bango);
        $table_headers = BacklogList2Headers::headers($bango, 'table_headers');
        $page_no = BacklogList2Headers::$page_no;
        $route = 'backlogList2TableSetting';
        $redirect_path = 'backlogList2Reload';
        $temp_table = 'backloglist2_6_temp';

        //show page start here
        if (isset($data_from_view['Button']) && ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh')) {
            self::update_list();
            $fsRemoveKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp'];
            $removeKeys = ['page', 'Button', 'pagination', '_token', 'userId', 'chkboxinp','division_datachar05_start','division_datachar05_end','department_datachar05_start','department_datachar05_end','sales_date_start','sales_date_end','rd1','rd2'];

            try {
                if ($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'FirstSearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'xls' || $data_from_view['Button'] == 'refresh') {
                    //clear bottom search request data
                    if($data_from_view['Button'] == 'refresh'){
                        $data_from_view = self::clearBottomReqData($data_from_view);
                    }
                    
                    //default req data
                    $default_data =  $data_from_view;

                    //formatted first search data
                    $defalut_check = 0;
                    $req_data = $this->removeDataFromView($data_from_view, $fsRemoveKeys);
                    foreach ($req_data as $key => $value) {
                        if (strpos($key, 'ReqVal') !== false) {
                            $defalut_check++;
                            $req_data[str_replace('ReqVal', '', $key)] = $value;
                            unset($req_data[$key]);
                        }
                    }
                    
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);

                    //first search req data
                    $fsReqData = [];
                    $bangos = [];
                   
                    foreach ($data as $key => $value) {
                        if (strpos($key, 'ReqVal') !== false) {
                            
                            $fsReqData[str_replace('ReqVal', '', $key)] = $value;
                            $data[str_replace('ReqVal', '', $key)] = $value;
                            unset($data[$key]);
                        }
                    }
                   
                    $data = $this->removeDataFromView($data, $removeKeys);

                    if($data_from_view['Button'] == 'FirstSearch'){
                        $fsReqData = $req_data; //fsReqData = first search request data
                    }
                    
                    //no data show if first search is yet to search
                    if(($data_from_view['Button'] == 'Thesearch' || $data_from_view['Button'] == 'sort' || $data_from_view['Button'] == 'refresh') && $defalut_check == 0){
                        $pagi = 20;
                        return view('order.backlogList2.mainBacklogList2', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'pagi', 'deleted_item', 'buttonMessage','B9Data_left','B9Data_right','C1Data_left','C1Data_right','C2Data_left','C2Data_right','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','datachar05'));
                    }
            
                    $backlogList2_1Query = BacklogList2_1::data($bango, $deleted_item,$req_data);
                    $backlogList2_2Query = BacklogList2_2::data($bango, $deleted_item,$req_data);
                    $backlogList2_3Query = BacklogList2_3::data($bango, $deleted_item,$req_data);                  
                    $backlogList2_4Query = BacklogList2_4::data($bango, $deleted_item,$req_data);
                    //$backlogList2_5Query = BacklogList2_5::data($bango, $deleted_item,$req_data);
                    $query = BacklogList2_6::data($bango, $deleted_item,$req_data)->toSql();
                    //$query = "select * from backloglist2_final_temp where   substring(datatxt0003::text,1,2)='B9' AND right(datatxt0003::text,2) between '01' and '06' and jhvw001='0151015265'";
                    
                   
                    
                    $backlogList2Info = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                   
                    $backlogList2Info2 = $this->searchDataFetch($query, $data, $bango, $temp_table);
                    //dd($backlogList2Info);
                    if ($backlogList2Info->items() == null && $backlogList2Info->currentPage() != 1) {
                        $currentPage = ($backlogList2Info->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $backlogList2Info = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                        $backlogList2Info2 = $this->searchDataFetch($query, $data, $bango, $temp_table);
                    }
                    if ($backlogList2Info->total() == 0) {
                        $exceedUser = '該当するデータがありません。';
                    } else {
                        $exceedUser = '';
                    }


                    //export excel
                    if ($data_from_view['Button'] == 'xls') {
                        $searched = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination, 'xls');
                        $headers = $this->headers;
                        // dd($searched);
                        $excelName = '月別受注残一覧2.xlsx';
                        $searched = collect(self::createExceelData($searched, $headers));
                        // dd($searched);
                        //return newExcelExport::download($searched,$headers, $excelName);
                        return $this->excelDownload($headers, $searched, $excelName);
                    }


                }
            } catch (\Exception $e) {
                dd($e);
                $exceedUser = '検索形式が間違っています。';
                $backlogList2Info = collect();
                $backlogList2Info = $backlogList2Info->paginate($pagination);
                $grand_total_amount  = $backlogList2Info->sum('jhvw049');
                return view('order.backlogList2.mainBacklogList2', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'backlogList2Info', 'tantousya', 'deleted_item','exceedUser', 'buttonMessage','B9Data_left','B9Data_right','C1Data_left','C1Data_right','C2Data_left','C2Data_right','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','datachar05','fsReqData','grand_total_amount'));
            }
              
            $grand_total_amount  = $backlogList2Info2->sum('jhvw049');

            return view('order.backlogList2.mainBacklogList2', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'backlogList2Info', 'tantousya', 'deleted_item','exceedUser', 'buttonMessage','B9Data_left','B9Data_right','C1Data_left','C1Data_right','C2Data_left','C2Data_right','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','datachar05','req_data','fsReqData','grand_total_amount'));
        }

        $pagi = !empty($data_from_view['pagination']) ? $data_from_view['pagination'] : 20;
        session()->forget('oldInput' . $bango);
        return view('order.backlogList2.mainBacklogList2', compact('bango', 'headers', 'table_headers', 'page_no', 'route', 'redirect_path', 'tantousya', 'pagi', 'deleted_item', 'buttonMessage','B9Data_left','B9Data_right','C1Data_left','C1Data_right','C2Data_left','C2Data_right','personal_datatxt0003','personal_datatxt0004','personal_datatxt0005','datachar05'));
    }


    public function tableSetting($id, $user_default = null)
    {
        $id = $user_default ? $user_default : $id;
        $pageNo = BacklogList2Headers::$page_no;
        return $Setting = TableSetting::setting($this->headers, $id, $pageNo);

    }

    public function tableSettingSave(Request $request, $id, $type = null)
    {
        $pageNo = BacklogList2Headers::$page_no;
        TableSetting::settingSave($request, $id, $pageNo, $this->headers, '月別受注残一覧2', $type);
    }

    public function clearBottomReqData($request_data){
        $headers = [
            '番号' => 'jhvw001',
            '担当' => 'user_name_search',
            '受注先' => 'jhvw022_detail',
            '受注内容' => 'jhvw053',
            '受注日' => 'jhvw030',
            '納期' => 'jhvw031',
            '検収日' => 'jhvw033',
            '売上予定日' => 'jhvw032',
            '入金予定日' => 'jhvw034',
            '分類明細金額' => 'jhvw049',
            '粗利額' => 'jhvw048',
            '売上先' => 'jhvw023_detail',
            '最終顧客' => 'jhvw024_detail',
            '定期定額契約番号' => 'jhvw007',
            '受注番号' => 'order_number',
            '代理店1CD' => 'jhvw025_detail',
            '代理店2CD' => 'jhvw026_detail',
            '発注金額分類' => 'jhvw043',
            '事業部' => 'jhvw050',
            '部' => 'jhvw051',
        ];
        foreach($request_data as $key=>$val){
            if (in_array($key, $headers)){
                $request_data[$key] = null;
            }
        }
        return $request_data;
    }

    private function update_list()
    {
        $updated_data=QueryHelper::fetchResult("SELECT distinct
        JC.kokyakuorderbango::text AS JU0001,
        JC.ordertypebango2 AS JU0002,
        JC.date as check_date,
        JC.intorder03,
        JC.datachar02,
        JM.datachar13,
        JC.datachar01 AS JU0003,
        JC.datachar02  AS JU0004,
        JC.datachar06 AS JU0005,
        JC.datachar05 AS JU0008,
        JC.information1 AS JU0009,
        JC.information2 AS JU0010,
        JC.information3 AS JU0011,
        JC.information4 AS JU0012,
        JC.information5 AS JU0013,
        JC.juchukubun1 AS JU0015,
        JC.intorder01 AS JU0016,
        JC.intorder02 AS JU0017,
        JC.intorder04 AS JU0019,
        JC.money10 AS JU0027,
        JC.chumonbango AS JU0031,
        COALESCE(JCF.datachar04,  '2' ) AS JUF005,
        JCF.datachar16 AS JUF018,   
        JM.syouhinid AS JM0001,
        JM.syouhinsyu AS JM0002,
        JM.hantei AS JM0003,
        JM.dataint01 AS JM0004,
        JM.dataint02 AS JM0005,
        JM.datachar13 AS JM0006,
        JM.syouhinname AS JM0008,
        JM.syukkasu AS JM0012,
        JM.dataint04 AS JM0014,
        JM.dataint05 AS JM0015,
        JM.dataint06 AS JM0016,
        JM.dataint07 AS JM0017,
        JM.dataint08 AS JM0018,
        JM.datachar01 AS JM0019,
        JM.datachar02 AS JM0020,
        JM.datachar06 AS JM0026,
        JM.dataint16 AS JM0033,
        JM.datachar21 AS JM0038,
        JM.datachar22 AS JM0039,
        JM.kawasename AS JM0007,
        JM.dataint18 AS JM0035,
        JMF.datachar03 AS JMF006,
        null as char01,
        null as char02,
        null as char03,
        null as char04,
        null as char05,
        null as char06,
        null as char07,
        COALESCE(UR.unsoudaibikitesuryou,  '2' ) AS UR0025,
        UR.unsoutesuryou AS UR0026,
        URF.dataint01 AS URF002,
        (CASE 
              WHEN COALESCE(JCF.datachar04,  '2' ) = '1' THEN UR.intorder03
              ELSE JC.intorder03 END) AS UR0012_JU0018,
        (CASE 
              WHEN COALESCE(JCF.datachar04,  '2' ) = '1' THEN UR.intorder05 
              ELSE JC.intorder05 END) AS UR0014_JU0020  

        from (SELECT J.*,T.*                                                 
             FROM orderhenkan AS J,(SELECT  orderhenkan.kokyakuorderbango, (case when MAX(orderhenkan.datachar10) IS null then MAX(orderhenkan.ordertypebango2::text) else MAX(datachar10) end) AS  ordertypebango2  FROM orderhenkan where orderhenkan.date::date = CURRENT_DATE GROUP BY orderhenkan.kokyakuorderbango) AS D11JC ,tuhanorder as T             
             WHERE                                                                        J.kokyakuorderbango = D11JC.kokyakuorderbango 
                
                 AND D11JC.ordertypebango2::text  = (case when J.datachar10 IS null then J.ordertypebango2::text else J.datachar10 end) 
                 AND T.orderbango=J.bango) AS JC    

        LEFT JOIN  hikiatesyukko AS JCF
        ON JC.kokyakuorderbango = JCF.syouhinid 
        AND JC.bango= JCF.orderbango
        AND JCF.yoteimeter <> 1         

        LEFT JOIN (SELECT M.*                                                               
            FROM misyukko AS M
            ,(SELECT misyukko.syouhinid, misyukko.syouhinsyu, misyukko.hantei, MAX(misyukko.dataint01 ) AS dataint01  FROM misyukko GROUP BY misyukko.syouhinid, misyukko.syouhinsyu, misyukko.hantei) AS D11JM
            ,(SELECT orderhenkan.kokyakuorderbango, MAX(orderhenkan.ordertypebango2 ) AS  ordertypebango2  FROM orderhenkan where orderhenkan.date::date = CURRENT_DATE GROUP BY orderhenkan.kokyakuorderbango) AS D11JC             

             WHERE 
                M.syouhinid = D11JM.syouhinid 
                AND M.syouhinsyu = D11JM.syouhinsyu 
                AND M.hantei = D11JM.hantei 
                AND M.dataint01  = D11JM.dataint01 
                AND D11JC.kokyakuorderbango=M.syouhinid 
                AND M.yoteimeter <> 1) AS JM            
          ON JC.kokyakuorderbango = JM.syouhinid 
          AND JM.yoteimeter <> 1

        LEFT JOIN  juchusyukko AS JMF                       
          ON JM.syouhinid = JMF.syouhinid 
          AND JM.syouhinsyu = JMF.syouhinsyu 
          AND JM.hantei = JMF.hantei
          AND JMF.yoteimeter <> 1   

        LEFT JOIN (SELECT U.*,T1.* 
           FROM orderhenkan AS U                                             
            ,(SELECT orderhenkan.datachar10, MAX(orderhenkan.ordertypebango2 ) AS ordertypebango2  FROM orderhenkan where orderhenkan.date::date = CURRENT_DATE
                        GROUP BY orderhenkan.datachar10) AS D11U        
            ,tuhanorder as T1                                                         

        WHERE                        
           U.datachar10 = D11U.datachar10 
           AND U.ordertypebango2  = D11U.ordertypebango2   
           AND T1.orderbango=U.bango) AS UR 
          ON JC.kokyakuorderbango = UR.kokyakuorderbango 
          AND UR.synchroorderbango <> 1

        LEFT JOIN hikiatesyukko AS URF  
          ON UR.datachar10 = URF.kaiinid 
          AND UR.bango=URF.orderbango
          AND URF.yoteimeter  <> 1                  

        LEFT JOIN (SELECT M.*                                                                       FROM syukkoold AS M
            ,(SELECT kaiinid, syouhinsyu, hantei, MAX(dataint01) AS dataint01  FROM syukkoold GROUP BY kaiinid, syouhinsyu, hantei) AS D11UM  
            ,(SELECT orderhenkan.datachar10, MAX(orderhenkan.ordertypebango2 ) AS ordertypebango2  FROM orderhenkan  where orderhenkan.date::date = CURRENT_DATE
                        GROUP BY orderhenkan.datachar10) AS D11U            
            WHERE 
                M.kaiinid = D11UM.kaiinid 
                AND M.syouhinsyu = D11UM.syouhinsyu 
                AND M.hantei = D11UM.hantei 
                AND M.dataint01  = D11UM.dataint01   
                AND D11U.datachar10=M.kaiinid ) AS UM                       
          ON UR.datachar10 = UM.kaiinid 
          AND JC.kokyakuorderbango = UM.syouhinid 
          AND UM.yoteimeter <> 1                        

        WHERE JC.synchroorderbango <> 1 AND ( COALESCE( JCF.datachar04 ,  '2') = '2' OR COALESCE( UR.unsoudaibikitesuryou  , '2') = '2' )");
    if (!empty($updated_data)) {
        $str='(';
    }else{
        $str="('')";
    }

    foreach ($updated_data as $key => $value) {

            if ($key == (array_key_last($updated_data))) {
               $str=$str."'".$value->ju0001."'".')';
            }else{
               $str=$str."'".$value->ju0001."'".',';
            }
        }
        $delete=QueryHelper::runQuery("DELETE FROM backloglist2_view1 WHERE ju0001 IN $str");
        QueryHelper::runQuery("INSERT INTO backloglist2_view1
        SELECT distinct
        JC.bango,
        JC.kokyakuorderbango AS JU0001,
        JC.ordertypebango2 AS JU0002,
        JC.datachar10 AS uriage,
        JC.date as check_date,
        JC.intorder03,
        jc.datachar02,
        jm.datachar13,
        JC.datachar01 AS JU0003,
        JC.datachar02  AS JU0004,
        JC.datachar06 AS JU0005,
        JC.datachar05 AS JU0008,
        JC.information1 AS JU0009,
        JC.information2 AS JU0010,
        JC.information3 AS JU0011,
        JC.information4 AS JU0012,
        JC.information5 AS JU0013,
        JC.juchukubun1 AS JU0015,
        JC.intorder01 AS JU0016,
        JC.intorder02 AS JU0017,
        JC.intorder04 AS JU0019,
        JC.money10 AS JU0027,
        JC.chumonbango AS JU0031,
        COALESCE(JCF.datachar04,  '2' ) AS JUF005,
        JCF.datachar16 AS JUF018,   
        JM.syouhinid AS JM0001,
        JM.syouhinsyu AS JM0002,
        JM.hantei AS JM0003,
        JM.dataint01 AS JM0004,
        JM.dataint02 AS JM0005,
        JM.datachar13 AS JM0006,
        JM.syouhinname AS JM0008,
        JM.syukkasu AS JM0012,
        JM.dataint04 AS JM0014,
        JM.dataint05 AS JM0015,
        JM.dataint06 AS JM0016,
        JM.dataint07 AS JM0017,
        JM.dataint08 AS JM0018,
        JM.datachar01 AS JM0019,
        JM.datachar02 AS JM0020,
        JM.datachar06 AS JM0026,
        JM.dataint16 AS JM0033,
        JM.datachar21 AS JM0038,
        JM.datachar22 AS JM0039,
        JM.kawasename AS JM0007,
        JM.dataint18 AS JM0035,
        JMF.datachar03 AS JMF006,
        null as char01,
        null as char02,
        null as char03,
        null as char04,
        null as char05,
        null as char06,
        null as char07,
        COALESCE(UR.unsoudaibikitesuryou,  '2' ) AS UR0025,
        UR.unsoutesuryou AS UR0026,
        URF.dataint01 AS URF002,
        (CASE 
              WHEN COALESCE(JCF.datachar04,  '2' ) = '1' THEN UR.intorder03
              ELSE JC.intorder03 END) AS UR0012_JU0018,
        (CASE 
              WHEN COALESCE(JCF.datachar04,  '2' ) = '1' THEN UR.intorder05 
              ELSE JC.intorder05 END) AS UR0014_JU0020  

        from (SELECT J.*, T.*                                                 
             FROM orderhenkan AS J,(SELECT  orderhenkan.kokyakuorderbango, (case when MAX(orderhenkan.datachar10) IS null then MAX(orderhenkan.ordertypebango2::text) else MAX(datachar10) end) AS  ordertypebango2  FROM orderhenkan where orderhenkan.date::date = CURRENT_DATE GROUP BY orderhenkan.kokyakuorderbango) AS D11JC ,tuhanorder as T             
             WHERE                                                                        J.kokyakuorderbango = D11JC.kokyakuorderbango 
                
                 AND D11JC.ordertypebango2::text  = (case when J.datachar10 IS null then J.ordertypebango2::text else J.datachar10 end) 
                 AND T.orderbango=J.bango) AS JC 
                   

        LEFT JOIN  hikiatesyukko AS JCF
        ON JC.kokyakuorderbango = JCF.syouhinid 
        AND JC.bango= JCF.orderbango
         
        AND JCF.yoteimeter <> 1         

        LEFT JOIN (SELECT M.*                                                               
            FROM misyukko AS M
            ,(SELECT misyukko.syouhinid, misyukko.syouhinsyu, misyukko.hantei, MAX(misyukko.dataint01 ) AS dataint01  FROM misyukko GROUP BY misyukko.syouhinid, misyukko.syouhinsyu, misyukko.hantei) AS D11JM
            ,(SELECT orderhenkan.kokyakuorderbango, MAX(orderhenkan.ordertypebango2 ) AS  ordertypebango2  FROM orderhenkan where orderhenkan.date::date = CURRENT_DATE GROUP BY orderhenkan.kokyakuorderbango) AS D11JC             

             WHERE 
                M.syouhinid = D11JM.syouhinid 
                AND M.syouhinsyu = D11JM.syouhinsyu 
                AND M.hantei = D11JM.hantei 
                AND M.dataint01  = D11JM.dataint01 
                AND D11JC.kokyakuorderbango=M.syouhinid 
                AND M.yoteimeter <> 1) AS JM            
          ON JC.kokyakuorderbango = JM.syouhinid 
          AND JM.yoteimeter <> 1

        LEFT JOIN  juchusyukko AS JMF                       
          ON JM.syouhinid = JMF.syouhinid 
          AND JM.syouhinsyu = JMF.syouhinsyu 
          AND JM.hantei = JMF.hantei
          AND JMF.yoteimeter <> 1   

        LEFT JOIN (SELECT U.*,T1.* 
           FROM orderhenkan AS U                                             
            ,(SELECT orderhenkan.datachar10, MAX(orderhenkan.ordertypebango2 ) AS ordertypebango2  FROM orderhenkan where orderhenkan.date::date = CURRENT_DATE
                        GROUP BY orderhenkan.datachar10) AS D11U        
            ,tuhanorder as T1                                                         

        WHERE                        
           U.datachar10 = D11U.datachar10 
           AND U.ordertypebango2  = D11U.ordertypebango2   
           AND T1.orderbango=U.bango) AS UR 
          ON JC.kokyakuorderbango = UR.kokyakuorderbango 
          AND UR.synchroorderbango <> 1

        LEFT JOIN hikiatesyukko AS URF  
          ON UR.datachar10 = URF.kaiinid 
          AND UR.bango=URF.orderbango
          AND URF.yoteimeter  <> 1                  

        LEFT JOIN (SELECT M.*                                                                       FROM syukkoold AS M
            ,(SELECT kaiinid, syouhinsyu, hantei, MAX(dataint01) AS dataint01  FROM syukkoold GROUP BY kaiinid, syouhinsyu, hantei) AS D11UM  
            ,(SELECT orderhenkan.datachar10, MAX(orderhenkan.ordertypebango2 ) AS ordertypebango2  FROM orderhenkan where datachar10 is not null AND orderhenkan.date::date = CURRENT_DATE
                        GROUP BY orderhenkan.datachar10) AS D11U            
            WHERE 
                M.kaiinid = D11UM.kaiinid 
                AND M.syouhinsyu = D11UM.syouhinsyu 
                AND M.hantei = D11UM.hantei 
                AND M.dataint01  = D11UM.dataint01   
                AND D11U.datachar10=M.kaiinid ) AS UM                       
          ON UR.datachar10 = UM.kaiinid 
          AND JC.kokyakuorderbango = UM.syouhinid 
          AND UM.yoteimeter <> 1                        

        WHERE JC.synchroorderbango <> 1 AND ( COALESCE( JCF.datachar04 ,  '2') = '2' OR COALESCE( UR.unsoudaibikitesuryou  , '2') = '2' )");

      return true;
    }

    public static function createExceelData($backlogList2Info , $headers){
        $searched = array();
        $group_check = "";
        $n = 0;
        $total_count = count($backlogList2Info) ?? 0;
        $sub_total = 0;
        $temp_sub_total = 0;
        $grand_total = 0;
        $previous_date = "";
        foreach ($backlogList2Info as $key=>$val){
            if(request('rd2') == 'rd2_2'){
                $temp_current = $val->jhvw050.$val->jhvw032;
            }else{
                $temp_current = $val->jhvw050.$val->jhvw021.$val->jhvw032;
            }
            $current_group = $val->jhvw050_detail;
            if ($n > 0 && $temp_current != $temp_sub_check){
                foreach ($headers as $header=>$field){
                    if($field == "jhvw045"){
                        $newRow["jhvw053"] = substr($previous_date,0,4) . '年' . substr($previous_date,5,2) . '月'; 
                    }
                    elseif($field == "jhvw049"){
                        $newRow[$field] = number_format($sub_total);
                    }
                    else{
                        $newRow[$field] = null;
                    }
                }
                array_push($searched, (object)$newRow);
                $temp_sub_total = $temp_sub_total + $sub_total;
                $sub_total = 0;
            }
            if($n > 0 && $current_group != $group_check){
                foreach($headers as $header=>$field){
                    if($field == "jhvw045"){
                        $newRow["jhvw053"] = $group_check; 
                    }
                    elseif($field == "jhvw049"){
                        $newRow[$field] = number_format($temp_sub_total);
                    }
                    else{
                        $newRow[$field] = null;
                    }
                }
                array_push($searched, (object)$newRow);
                $grand_total = $grand_total + $temp_sub_total;
                $temp_sub_total = 0;
            }
            foreach($headers as $header=>$field){
                $newRow[$field] = $val->$field;
            }
            array_push($searched, (object)$newRow);
            $n++;
            if(request('rd2') == 'rd2_2'){
            $temp_sub_check = $val->jhvw050.$val->jhvw032;
            $previous_date = $val->jhvw032;
            $group_check = $val->jhvw050_detail;
            }else{
            $temp_sub_check = $val->jhvw050.$val->jhvw021.$val->jhvw032;
            $previous_date = $val->jhvw032;
            $group_check = $val->jhvw050_detail;
            }
            $sub_total = $sub_total + $val->jhvw049;
            if($total_count == $n){
                $temp_sub_total = $temp_sub_total+$sub_total;
                $grand_total = $grand_total + $temp_sub_total;
                foreach($headers as $header=>$field){
                    if($field == "jhvw045"){
                        $newRow["jhvw053"] = substr($val->jhvw032,0,4). '年' . substr($val->jhvw032,5,2) . '月'; 
                    }
                    elseif($field == "jhvw049"){
                        $newRow[$field] = number_format($sub_total);
                    }
                    else{
                        $newRow[$field] = null;
                    }
                }
                array_push($searched, (object)$newRow);
                foreach($headers as $header=>$field){
                    if($field == "jhvw045"){
                        $newRow["jhvw053"] = $val->jhvw050_detail; 
                    }
                    elseif($field == "jhvw049"){
                        $newRow[$field] = number_format($temp_sub_total);
                    }
                    else{
                        $newRow[$field] = null;
                    }
                }
                array_push($searched, (object)$newRow);
            }
        }
        // dd($searched);
        return $searched;
    }
}
