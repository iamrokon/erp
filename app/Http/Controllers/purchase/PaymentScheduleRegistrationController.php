<?php
namespace App\Http\Controllers\purchase;

use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\Http\Controllers\Controller;
use App\AllClass\ButtonMsg;
use App\AllClass\purchase\paymentScheduleRegister\PaymentScheduleRegister;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class PaymentScheduleRegistrationController extends Controller{

    //  private $headers = [
    //     '行' => 'serial_no',
    //     '仕入購入区分' => 'purchase_category',
    //     '仕入日' => 'purchase_date',
    //     '納品書番号' => 'delivery_note_number',
    //     '品名' => 'product_name',
    //     '数' => 'number',
    //     '単価' => 'unit_price',
    //     '金額' => 'amount',
    //     '消費税額' => 'consumption_tax',
    //     '税込金額' => 'tax_included_amount'
    // ];

    private $headers = [
        '行' => 'serial_no',
        '仕入購入区分' => 'purchase_category',
        '仕入日' => 'purchase_date',
        '納品書番号' => 'delivery_note_number',
        '品名' => 'product_name',
        '数' => 'number',
        '単価' => 'unit_price',
        '金額' => 'amount',
        '消費税額' => 'consumption_tax',
        '税込金額' => 'tax_included_amount'
    ];


    public function index(){

        // initial value
        $bango = request('userId');
        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $purchase_categories = QueryHelper::select(['syouhinbango', 'jouhou', 'color', 'bango'])->from('request')->where("color = '0610仕入購入区分'")->orderBy("bango asc")->get()->execute();

        $categorykanries = QueryHelper::select(['category1', 'category2', 'category4'])->from('categorykanri')->where("category1 = 'D9'")->get()->execute();

        // @Todo 20220113
        // Initially blank data return.
        // Show only blank 1 row
        // So blank and pagination is 1
        // $categorykanries_2 = QueryHelper::select(["row_number() OVER () as serial_no", "concat(category1, category2) as purchase_category", "'' as purchase_date", "'' as delivery_note_number", "'' as product_name", "'' as number", "'' as unit_price", "'' as amount", "'' as consumption_tax", "'' as tax_included_amount"])->from('categorykanri')->where("category1 = 'U6'")->get()->execute();

        // $categorykanries_2 = QueryHelper::select(["'' as serial_no", "'' as purchase_category", "'' as purchase_date", "'' as delivery_note_number", "'' as product_name", "'' as number", "'' as unit_price", "'' as amount", "'' as consumption_tax", "'' as tax_included_amount"])->from('categorykanri')->where("category1 = 'U6'")->get()->execute();

        $categorykanries_2 = QueryHelper::fetchResult("
                                select
                                '' as serial_no,
                                '' as purchase_category,
                                '' as purchase_date,
                                '' as delivery_note_number,
                                '' as product_name,
                                '' as number,
                                '' as unit_price,
                                '' as amount,
                                '' as consumption_tax,
                                '' as tax_included_amount
                                from categorykanri
                                where category1 = 'U6'
                                limit 1
                    ");

        $buttonMessage = ButtonMsg::read($bango);

        // pagination part
        // $paymentHistoryInfos = collect([])->paginate(20);
        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            $pagination = 20;
        }

        //  $payment_schedule_reg_data_table = collect($categorykanries_2)->paginate(20);
        $payment_schedule_reg_data_table = collect($categorykanries_2)->paginate($pagination);
        // dd($payment_schedule_reg_data_table);
        $headers = $this->headers;
        $ajax_request = "pagination_ajax_not_ok";


        return view('purchase.paymentScheduleRegistration.mainPaymentScheduleRegistration', compact('bango', 'tantousya', 'purchase_categories', 'categorykanries', 'categorykanries_2', 'buttonMessage', 'payment_schedule_reg_data_table', 'headers', 'ajax_request'));
    }

    public function handlePaymentScheduleRegistrationPagination(Request $request){
        $bango = $request->userId;
        $buttonMessage = ButtonMsg::read($bango);
        $headers = $this->headers;

        if (!empty(request('pagination'))) {
            $pagination = request('pagination');
        } else {
            // initital
            $pagination = 20;
        }


        if($request->pagination_dynamic_variable && $request->pagination_dynamic_variable == "payment_datatable_3_1"){
            $purchase_payment_schedule_reg_101 = date("Y-m-d 00:00:00", strtotime($request->pagination_dynamic_variable_purchase_payment_schedule_reg_101));
            $purchase_payment_schedule_reg_102 = $request->pagination_dynamic_variable_purchase_payment_schedule_reg_102;
            $purchase_payment_schedule_reg_102 = substr($purchase_payment_schedule_reg_102, 0, 8);

            $condition_sql = "";
            if($request->pagination_dynamic_variable_purchase_payment_schedule_reg_201){
                if($request->pagination_dynamic_variable_purchase_payment_schedule_reg_201 == '仕入'){
                    $condition_sql = "and toiawasebango.toiawasebango not in ('U623', 'U670')";
                }else{
                    if($request->pagination_dynamic_variable_purchase_payment_schedule_reg_201 == '購入'){
                        $condition_sql = "and toiawasebango.toiawasebango = 'U670'";
                    }
                }
            }

            QueryHelper::runQuery("DROP TABLE IF EXISTS toiawasebango_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE toiawasebango_temp as
                                select distinct
                                toiawasebango, touchakudate, dataint01, denpyoname, datachar03, unsoumei,
                                max(toiawasebango.datanum0013) as toiawasebango_datanum0013
                                from toiawasebango
                                where
                                touchakudate <= '$purchase_payment_schedule_reg_101' and
                                bikou1 = '$purchase_payment_schedule_reg_102' and
                                datachar03 = '0'
                                $condition_sql
                                group by toiawasebango, touchakudate, dataint01, denpyoname, datachar03, unsoumei  ");

            QueryHelper::runQuery("DROP TABLE IF EXISTS pay_shedule_reg_datatable_temp");
            QueryHelper::runQuery("CREATE TEMPORARY TABLE pay_shedule_reg_datatable_temp as
                select
                row_number() OVER () as serial_no,
                -- toiawasebango.toiawasebango as purchase_category,
                -- @Toto 20220127
                concat(categorykanri.category2, ' ', categorykanri.category4) as purchase_category,
                concat_ws('/',substring(CAST(toiawasebango.dataint01 as text),1,4),substring(CAST(toiawasebango.dataint01 as text),5,2),substring(CAST(toiawasebango.dataint01 as text),7,2)) as purchase_date,
                --toiawasebango.dataint01 as purchase_date,
                toiawasebango.denpyoname as delivery_note_number,
                nyukoold.datachar08 as product_name,
                -- nyukoold.nyukosu as number,
                to_char(nyukoold.nyukosu,'FM99,999,999,999,999') as number,
                -- nyukoold.kingaku as unit_price,
                to_char(nyukoold.kingaku,'FM99,999,999,999,999') as unit_price,
                -- nyukoold.syouhizeiritu as amount,
                to_char(nyukoold.syouhizeiritu,'FM99,999,999,999,999') as amount,
                -- nyukoold.soukobango as consumption_tax,
                to_char(nyukoold.soukobango,'FM99,999,999,999,999') as consumption_tax,
                -- (nyukoold.syouhizeiritu + nyukoold.soukobango) as tax_included_amount
                to_char(nyukoold.syouhizeiritu + nyukoold.soukobango,'FM99,999,999,999,999') as tax_included_amount

                from

                toiawasebango_temp as toiawasebango
                -- join hikiatenyuko on hikiatenyuko.syouhinid = toiawasebango.unsoumei and
                --                      hikiatenyuko.datachar07 != null
                join nyukoold on nyukoold.syouhinid = toiawasebango.unsoumei
                left join categorykanri on category1= substring(toiawasebango.toiawasebango, 1, 2) and category2 = substring(toiawasebango.toiawasebango, 3, 4)

                where toiawasebango.touchakudate <= '$purchase_payment_schedule_reg_101' and
                           toiawasebango.datachar03 = '0'
                order by serial_no, toiawasebango.touchakuDate, nyukoold.syouhinid, nyukoold.syouhinsyu asc
            ");

            $payment_schedule_reg_data_table = collect(QueryHelper::fetchResult(DB::table('pay_shedule_reg_datatable_temp')->toSql()));

        }else{
            // initial pagination
            // $payment_schedule_reg_data_table = QueryHelper::select(["row_number() OVER () as serial_no", "concat(category1, category2) as purchase_category", "'' as purchase_date", "'' as delivery_note_number", "'' as product_name", "'' as number", "'' as unit_price", "'' as amount", "'' as consumption_tax", "'' as tax_included_amount"])->from('categorykanri')->where("category1 = 'U6'")->get()->execute();
            $payment_schedule_reg_data_table = QueryHelper::fetchResult("
                                select
                                '' as serial_no,
                                '' as purchase_category,
                                '' as purchase_date,
                                '' as delivery_note_number,
                                '' as product_name,
                                '' as number,
                                '' as unit_price,
                                '' as amount,
                                '' as consumption_tax,
                                '' as tax_included_amount
                                from categorykanri
                                where category1 = 'U6'
                                limit 1
                    ");
        }


        $payment_schedule_reg_data_table = collect($payment_schedule_reg_data_table)->paginate($pagination);

        if(isset($payment_schedule_reg_data_table)){
            $current_page=$payment_schedule_reg_data_table->currentPage();
            $per_page=$payment_schedule_reg_data_table->perPage();
            $first_data= ($current_page - 1)*$per_page+1;
            $last_data=($current_page - 1)*$per_page+ sizeof($payment_schedule_reg_data_table->items());
            $total=$payment_schedule_reg_data_table->total();
            $lastPage=$payment_schedule_reg_data_table->lastPage();
        }else{
            $current_page = 1;
            $per_page = 20;
            $first_data = 1;
            $last_data = 0;
            $total = 0;
            $lastPage = 1;
        }

        $html_pagination_new1_rendered = $this->pagination_new1_render($current_page, $per_page, $first_data, $last_data, $total, $lastPage);
        $html_pagination_new2_rendered = "情報総数 $total";
        $html_pagination_new3_rendered = "表示範囲 $first_data". "～"."$last_data";

        $html_pagination_new4_rendered = "ページ総数 ". $lastPage ."&nbsp;&nbsp;";
        $html_pagination_new6_body_rendered = view('purchase.paymentScheduleRegistration.pagination_new.pagination_new6', compact('buttonMessage', 'payment_schedule_reg_data_table', 'headers'))->render();

        return response()->json(["status" => "view rendered", "html_pagination_new1_rendered" => $html_pagination_new1_rendered, "html_pagination_new2_rendered" => $html_pagination_new2_rendered, "html_pagination_new3_rendered" => $html_pagination_new3_rendered, "html_pagination_new4_rendered" => $html_pagination_new4_rendered, "html_pagination_new6_body_rendered" => $html_pagination_new6_body_rendered]);
    }

    public function pagination_new1_render($current_page, $per_page, $first_data, $last_data, $total, $lastPage){
        $str = "<div class='pagi' style='float: left;' id='tmp_internal_payment_schedule_registration_0610_pagination_header_html_pagination_new1'>
                <div class='nav_mview'>
                  <nav aria-label='Page navigation example '>
                    <ul class='pagination'>
                      <li class='page-item' style='padding-right: 3px;'>
                        <a class='page-link' href='#' aria-label='Previous' onclick='gotoBack_0610_page();' style='padding-top:7px;border: 1px solid #2C66B0!important;background: #2C66B0 !important;border-radius: 4px!important;color:white !important;'>
                          <span aria-hidden='true'>«</span>
                          <span class='sr-only'>Previous</span>
                        </a>
                      </li>
                      <li class='w_50'>
                        <input type='text' name='page' id='paginate' maxlength='9' class='form-control intLimitTextBox text-center input_pagi' value='$current_page' style='margin-top: 0px;height: 27px!important;border-radius: 4px!important;' onkeypress='return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))'>
                      </li>
                      <input type='hidden' id='paginationhelper' name='page' value='' disabled='disabled'>
                      <li class='page-item' style='padding-left: 3px!important;'>
                        <a class='page-link' href='#' onclick='goToPage_0610_page();' style='padding-top:7px;border: 1px solid #2C66B0!important;background: #2C66B0 !important;;border-radius: 4px!important;color: white !important;'>=</a>
                      </li>
                      <li class='page-item' style='padding-left: 3px!important;'>
                        <a class='page-link' href='#' onclick='goForward_0610_page()' aria-label='Next' style='padding-top:7px;border: 1px solid #2C66B0!important;background: #2C66B0 !important;border-radius: 4px!important;color: white !important;'>
                          <span aria-hidden='true'>»</span>
                          <span class='sr-only'>Next</span>
                        </a>
                      </li>
                    </ul>
                  </nav>
                </div>
              </div>
            ";
        return $str;
    }

    public function handlePaymentScheduleRegistrationPagination_3_1(Request $request){

    }



    public function process_2_202_display_data(Request $request){
        $purchase_payment_schedule_reg_101 = date("Y-m-d 00:00:00", strtotime($request->purchase_payment_schedule_reg_101));
        $purchase_payment_schedule_reg_102 = $request->purchase_payment_schedule_reg_102;
        $purchase_payment_schedule_reg_102 = substr($purchase_payment_schedule_reg_102, 0, 8);
        //$purchase_payment_schedule_reg_102 = '00014301';
        $purchase_payment_schedule_reg_201 = $request->purchase_payment_schedule_reg_201;


        // echo $purchase_payment_schedule_reg_101;
        //  echo $purchase_payment_schedule_reg_102;
        // @Todo 20211230
        // 3.1 implementation
        // QueryHelper::runQuery("DROP TABLE IF EXISTS shiharaizandaka_temp");
        // QueryHelper::runQuery("CREATE TEMPORARY TABLE shiharaizandaka_temp as
        //     select * from shiharaizandaka");

        QueryHelper::runQuery("DROP TABLE IF EXISTS shiharaizandaka_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE shiharaizandaka_temp as
            select
            shiharaizandaka.sz0001,
            shiharaizandaka.sz0002,
            case when shiharaizandaka.sz0003 is null then 0 else shiharaizandaka.sz0003 end as sz0003,
            case when shiharaizandaka.sz0004 is null then 0 else shiharaizandaka.sz0004 end as sz0004,
            case when shiharaizandaka.sz0005 is null then 0 else shiharaizandaka.sz0005 end as sz0005,
            case when shiharaizandaka.sz0006 is null then 0 else shiharaizandaka.sz0006 end as sz0006,
            case when shiharaizandaka.sz0007 is null then 0 else shiharaizandaka.sz0007 end as sz0007,
            case when shiharaizandaka.sz0008 is null then 0 else shiharaizandaka.sz0008 end as sz0008,
            case when shiharaizandaka.sz0009 is null then 0 else shiharaizandaka.sz0009 end as sz0009,
            case when shiharaizandaka.sz0010 is null then 0 else shiharaizandaka.sz0010 end as sz0010,

            case when shiharaizandaka.sz0011 is null then 0 else shiharaizandaka.sz0011 end as sz0011,
            case when shiharaizandaka.sz0012 is null then 0 else shiharaizandaka.sz0012 end as sz0012,
            case when shiharaizandaka.sz0013 is null then 0 else shiharaizandaka.sz0013 end as sz0013,
            case when shiharaizandaka.sz0014 is null then 0 else shiharaizandaka.sz0014 end as sz0014,
            case when shiharaizandaka.sz0015 is null then 0 else shiharaizandaka.sz0015 end as sz0015,
            case when shiharaizandaka.sz0016 is null then 0 else shiharaizandaka.sz0016 end as sz0016,
            case when shiharaizandaka.sz0017 is null then 0 else shiharaizandaka.sz0017 end as sz0017,
            case when shiharaizandaka.sz0018 is null then 0 else shiharaizandaka.sz0018 end as sz0018,
            case when shiharaizandaka.sz0019 is null then 0 else shiharaizandaka.sz0019 end as sz0019,
            case when shiharaizandaka.sz0020 is null then 0 else shiharaizandaka.sz0020 end as sz0020,

            case when shiharaizandaka.sz0021 is null then 0 else shiharaizandaka.sz0021 end as sz0021,
            case when shiharaizandaka.sz0022 is null then 0 else shiharaizandaka.sz0022 end as sz0022,
            case when shiharaizandaka.sz0023 is null then 0 else shiharaizandaka.sz0023 end as sz0023,
            case when shiharaizandaka.sz0024 is null then 0 else shiharaizandaka.sz0024 end as sz0024,
            shiharaizandaka.sz0025,
            case when shiharaizandaka.sz0026 is null then 0 else shiharaizandaka.sz0026 end as sz0026,
            shiharaizandaka.sz0027,
            case when shiharaizandaka.sz0028 is null then 0 else shiharaizandaka.sz0028 end as sz0028,
            shiharaizandaka.sz0029,
            case when shiharaizandaka.sz0030 is null then 0 else shiharaizandaka.sz0030 end as sz0030,

            shiharaizandaka.sz0031,
            case when shiharaizandaka.sz0032 is null then 0 else shiharaizandaka.sz0032 end as sz0032,
            shiharaizandaka.sz0033,
            case when shiharaizandaka.sz0034 is null then 0 else shiharaizandaka.sz0034 end as sz0034,
            shiharaizandaka.sz0035,
            case when shiharaizandaka.sz0036 is null then 0 else shiharaizandaka.sz0036 end as sz0036,
            shiharaizandaka.sz0037,
            case when shiharaizandaka.sz0038 is null then 0 else shiharaizandaka.sz0038 end as sz0038,
            case when shiharaizandaka.sz0039 is null then 0 else shiharaizandaka.sz0039 end as sz0039

            from shiharaizandaka
            where date(sz0001) = '$purchase_payment_schedule_reg_101'
            and sz0002='$purchase_payment_schedule_reg_102' ");

        $condition_sql = "";
        if($purchase_payment_schedule_reg_201){
            if($purchase_payment_schedule_reg_201 == '仕入'){
                $condition_sql = "and toiawasebango.toiawasebango not in ('U623', 'U670')";
            }else{
                if($purchase_payment_schedule_reg_201 == '購入'){
                    $condition_sql = "and toiawasebango.toiawasebango = 'U670'";
                }
            }
        }



        QueryHelper::runQuery("DROP TABLE IF EXISTS toiawasebango_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE toiawasebango_temp as
                                select distinct
                                toiawasebango, touchakudate, dataint01, denpyoname, datachar03, unsoumei,
                                max(toiawasebango.datanum0013) as toiawasebango_datanum0013
                                from toiawasebango
                                where
                                touchakudate <= '$purchase_payment_schedule_reg_101' and
                                bikou1 = '$purchase_payment_schedule_reg_102' and
                                datachar03 = '0'
                                $condition_sql
                                group by toiawasebango, touchakudate, dataint01, denpyoname, datachar03, unsoumei  ");


        QueryHelper::runQuery("DROP TABLE IF EXISTS pay_shedule_reg_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE pay_shedule_reg_temp as
                select
                -- 111 to 119 field data extraction
                --shiharaizandaka.sz0010::BIGINT,
                --shiharaizandaka.sz0011::BIGINT,
                --shiharaizandaka.sz0012::BIGINT,
                cast (shiharaizandaka.sz0013 as numeric),
                case
                    when (shiharaizandaka.sz0005::BIGINT + shiharaizandaka.sz0006::BIGINT + shiharaizandaka.sz0007::BIGINT + shiharaizandaka.sz0008::BIGINT + shiharaizandaka.sz0010::BIGINT + shiharaizandaka.sz0011::BIGINT + shiharaizandaka.sz0012::BIGINT + shiharaizandaka.sz0013::BIGINT)::BIGINT is null then 0
                    else (shiharaizandaka.sz0005::BIGINT + shiharaizandaka.sz0006::BIGINT + shiharaizandaka.sz0007::BIGINT + shiharaizandaka.sz0008::BIGINT + shiharaizandaka.sz0010::BIGINT + shiharaizandaka.sz0011::BIGINT + shiharaizandaka.sz0012::BIGINT + shiharaizandaka.sz0013::BIGINT)::BIGINT end as purchase_payment_schedule_reg_111,
                case
                    when (shiharaizandaka.sz0009::BIGINT + shiharaizandaka.sz0014::BIGINT)::BIGINT is null then 0
                    else (shiharaizandaka.sz0009::BIGINT + shiharaizandaka.sz0014::BIGINT)::BIGINT end as purchase_payment_schedule_reg_112,
                case
                    when (shiharaizandaka.sz0005::BIGINT + shiharaizandaka.sz0006::BIGINT + shiharaizandaka.sz0007::BIGINT + shiharaizandaka.sz0008::BIGINT + shiharaizandaka.sz0010::BIGINT + shiharaizandaka.sz0011::BIGINT + shiharaizandaka.sz0012::BIGINT + shiharaizandaka.sz0013::BIGINT + shiharaizandaka.sz0009::BIGINT + shiharaizandaka.sz0014::BIGINT)::BIGINT is null then 0
                    else (shiharaizandaka.sz0005::BIGINT + shiharaizandaka.sz0006::BIGINT + shiharaizandaka.sz0007::BIGINT + shiharaizandaka.sz0008::BIGINT + shiharaizandaka.sz0010::BIGINT + shiharaizandaka.sz0011::BIGINT + shiharaizandaka.sz0012::BIGINT + shiharaizandaka.sz0013::BIGINT + shiharaizandaka.sz0009::BIGINT + shiharaizandaka.sz0014::BIGINT)::BIGINT end as purchase_payment_schedule_reg_113,
                --(shiharaizandaka.sz0005::BIGINT + shiharaizandaka.sz0006::BIGINT + shiharaizandaka.sz0007::BIGINT + shiharaizandaka.sz0008::BIGINT + shiharaizandaka.sz0010::BIGINT + shiharaizandaka.sz0011::BIGINT + shiharaizandaka.sz0012::BIGINT + shiharaizandaka.sz0013::BIGINT)::BIGINT as purchase_payment_schedule_reg_111,
                --(shiharaizandaka.sz0009::BIGINT + shiharaizandaka.sz0014::BIGINT)::BIGINT as purchase_payment_schedule_reg_112,
                --(shiharaizandaka.sz0005::BIGINT + shiharaizandaka.sz0006::BIGINT + shiharaizandaka.sz0007::BIGINT + shiharaizandaka.sz0008::BIGINT + shiharaizandaka.sz0010::BIGINT + shiharaizandaka.sz0011::BIGINT + shiharaizandaka.sz0012::BIGINT + shiharaizandaka.sz0013::BIGINT + shiharaizandaka.sz0009::BIGINT + shiharaizandaka.sz0014::BIGINT)::BIGINT as purchase_payment_schedule_reg_113,

                (shiharaizandaka.sz0005::BIGINT + shiharaizandaka.sz0006::BIGINT + shiharaizandaka.sz0007::BIGINT + shiharaizandaka.sz0008::BIGINT)::BIGINT as purchase_payment_schedule_reg_114,

                shiharaizandaka.sz0009::BIGINT as purchase_payment_schedule_reg_115,

                (shiharaizandaka.sz0005::BIGINT + shiharaizandaka.sz0006::BIGINT + shiharaizandaka.sz0007::BIGINT + shiharaizandaka.sz0008::BIGINT + shiharaizandaka.sz0009::BIGINT)::BIGINT as purchase_payment_schedule_reg_116,

                (shiharaizandaka.sz0010::BIGINT + shiharaizandaka.sz0011::BIGINT + shiharaizandaka.sz0012::BIGINT + shiharaizandaka.sz0013::BIGINT)::BIGINT as purchase_payment_schedule_reg_117,

                shiharaizandaka.sz0014::BIGINT as purchase_payment_schedule_reg_118,

                (shiharaizandaka.sz0010::BIGINT + shiharaizandaka.sz0011::BIGINT + shiharaizandaka.sz0012::BIGINT + shiharaizandaka.sz0013::BIGINT + shiharaizandaka.sz0014::BIGINT)::BIGINT as purchase_payment_schedule_reg_119,

                -- 211 to 231 data extraction
                shiharaizandaka.sz0025 as purchase_payment_schedule_reg_211,
                case
                    when shiharaizandaka.sz0025 is null then null
                    else shiharaizandaka.sz0026::BIGINT end as purchase_payment_schedule_reg_212,
                shiharaizandaka.sz0027 as purchase_payment_schedule_reg_213,
                case
                    when shiharaizandaka.sz0027 is null then null
                    else shiharaizandaka.sz0028::BIGINT end as purchase_payment_schedule_reg_214,
                shiharaizandaka.sz0029 as purchase_payment_schedule_reg_215,
                case
                    when shiharaizandaka.sz0029 is null then null
                    else shiharaizandaka.sz0030::BIGINT end as purchase_payment_schedule_reg_216,
                (shiharaizandaka.sz0026::BIGINT + shiharaizandaka.sz0028::BIGINT + shiharaizandaka.sz0030::BIGINT)::BIGINT as purchase_payment_schedule_reg_217,
                shiharaizandaka.sz0031 as purchase_payment_schedule_reg_221,
                case
                    when shiharaizandaka.sz0031 is null then null
                    else shiharaizandaka.sz0032::BIGINT end as purchase_payment_schedule_reg_222,
                shiharaizandaka.sz0033 as purchase_payment_schedule_reg_223,
                case
                    when shiharaizandaka.sz0033 is null then null
                    else shiharaizandaka.sz0034::BIGINT end as purchase_payment_schedule_reg_224,
                shiharaizandaka.sz0035 as purchase_payment_schedule_reg_225,
                case
                    when shiharaizandaka.sz0035 is null then null
                    else shiharaizandaka.sz0036::BIGINT end as purchase_payment_schedule_reg_226,
                (shiharaizandaka.sz0032::BIGINT + shiharaizandaka.sz0034::BIGINT + shiharaizandaka.sz0036::BIGINT)::BIGINT as purchase_payment_schedule_reg_227,
                to_char(shiharaizandaka.sz0037, 'YYYY/MM/DD' ) as purchase_payment_schedule_reg_231,
                (shiharaizandaka.sz0026::BIGINT + shiharaizandaka.sz0028::BIGINT + shiharaizandaka.sz0030::BIGINT + shiharaizandaka.sz0032::BIGINT + shiharaizandaka.sz0034::BIGINT + shiharaizandaka.sz0036::BIGINT)::BIGINT as purchase_payment_schedule_reg_232

                from
                shiharaizandaka_temp as shiharaizandaka
                left join toiawasebango_temp as toiawasebango on
                           toiawasebango.touchakudate > shiharaizandaka.sz0001 and
                           toiawasebango.touchakudate <= '$purchase_payment_schedule_reg_101' and
                           toiawasebango.datachar03 = '0'
                left join hikiatenyuko on hikiatenyuko.syouhinid = toiawasebango.unsoumei and
                                     hikiatenyuko.datachar07 != null
            ");


        // ./ Ends 3.1 implementations

        $query = DB::table('pay_shedule_reg_temp')->toSql();
        $result_3_1 = collect(QueryHelper::fetchResult($query));
        //dd($result_3_1);
        // echo  'count : ' .count($result);

        // 3.2 implementation starts
        if(count($result_3_1) == 0){
            // QueryHelper::runQuery("DROP TABLE IF EXISTS haisou_temp");
            // QueryHelper::runQuery("CREATE TEMPORARY TABLE haisou_temp as
            //                         select haisoujouhou.bunrui3, others2.other24,
            //                         concat(haisoujouhou.bunrui3, others2.other24) as purchase_payment_schedule_reg_211,
            //                         concat(haisoujouhou.bunrui3, others2.other24) as purchase_payment_schedule_reg_221
            //                         from haisou
            //                         left join kokyaku1 on kokyaku1.bango=haisou.bango
            //                         left join others2 on others2.otherint1 = haisou.bango
            //                         left join haisoujouhou on haisoujouhou.syukei1 = kokyaku1.bango
            //                         where concat(haisou.shikibetsucode, haisou.torihikisakibango) = '$purchase_payment_schedule_reg_102'

            //                     ");

            // $query = DB::table('haisou_temp')->toSql();
            // var_dump(collect(QueryHelper::fetchResult($query)));
            $bunrui3_other24_data = static::calculateBunruiOther24($purchase_payment_schedule_reg_102);
            $result_3_2 = [ 'purchase_payment_schedule_reg_211' => $bunrui3_other24_data,
                'purchase_payment_schedule_reg_221' => $bunrui3_other24_data];
//            dd($result_3_2);
            // $query = DB::table('haisou_temp')->toSql();
            // $result_3_2 = collect(QueryHelper::fetchResult($query));

            if(count($result_3_2) == 0){
                // 3.1 and 3.2 both are empty return
                $result["status"] = "false";
                $result["error"] = "error";
                $result["errror_message"] = "該当するデータがありません。";

                return $result;
            }else{
                $result["status"] = "true";
                $result["success"] = "success_result_3_2";
                $result["result_3_2"] = $result_3_2;
                return $result;
            }
        }else{
            $result["status"] = "true";
            $result["success"] = "success_result_3_1";
            $result["result_3_1"] = $result_3_1;
            // datatable for 3.1 condition
            //$result_datatable_3_1 = $this->pay_shedule_reg_datatable_3_1($purchase_payment_schedule_reg_101);
            //$result["result_datatable_3_1"] = $result_datatable_3_1;
            return $result;
        }

        // ./ Ends 3.2 implementation
    }

    public function pay_shedule_reg_datatable_3_1($purchase_payment_schedule_reg_101){
        QueryHelper::runQuery("DROP TABLE IF EXISTS pay_shedule_reg_datatable_temp");
        QueryHelper::runQuery("CREATE TEMPORARY TABLE pay_shedule_reg_datatable_temp as
                select
                toiawasebango.toiawasebango as purchase_payment_schedule_reg_301,
                toiawasebango.dataint01 as purchase_payment_schedule_reg_302,
                toiawasebango.denpyoname as purchase_payment_schedule_reg_303,
                nyukoold.datachar08 as purchase_payment_schedule_reg_304,
                nyukoold.nyukosu as purchase_payment_schedule_reg_305,
                nyukoold.kingaku as purchase_payment_schedule_reg_306,
                nyukoold.syouhizeiritu as purchase_payment_schedule_reg_307,
                nyukoold.soukobango as purchase_payment_schedule_reg_308,
                (nyukoold.syouhizeiritu + nyukoold.soukobango) as purchase_payment_schedule_reg_309

                from

                toiawasebango_temp as toiawasebango
                -- join hikiatenyuko on hikiatenyuko.syouhinid = toiawasebango.unsoumei and
                --                      hikiatenyuko.datachar07 != null
                join nyukoold on nyukoold.syouhinid = toiawasebango.unsoumei

                where toiawasebango.touchakudate <= '$purchase_payment_schedule_reg_101' and
                           toiawasebango.datachar03 = '0'
                order by toiawasebango.touchakuDate, nyukoold.syouhinid, nyukoold.syouhinsyu asc
            ");

        // $query = DB::table('pay_shedule_reg_datatable_temp')->toSql();
        // var_dump(collect(QueryHelper::fetchResult($query)));
        $result_datatable_3_1 = collect(QueryHelper::fetchResult(DB::table('pay_shedule_reg_datatable_temp')->toSql()));

        return $result_datatable_3_1;
    }

    public static function calculateBunruiOther24($supplierID){
        $yobi12 = substr($supplierID, 0, 6);
        $torihikisakibango = substr($supplierID, 6, 2);
        $haisou = QueryHelper::fetchSingleResult("select * from haisou where shikibetsucode = '$yobi12'  and kounyusu = 0 and torihikisakibango = '$torihikisakibango'");
        $companyData = QueryHelper::fetchSingleResult("select * from kokyaku1 where yobi12 = '$yobi12' and denpyosaiban = 0 ");
        $haisouBango = $haisou->bango ?? null;
        $companyBango = $companyData->bango ?? null;
        $output = null;

        if ($haisouBango) {
            $other2 = QueryHelper::fetchSingleResult("select * from others2 where otherint1 = '$haisouBango'");
            $other1 = $other2->other1 ?? null;
            if ($other1) {
                if (explode(" ", $other1)[0] == '1') {
                    $haisoujouhou = QueryHelper::fetchSingleResult("select * from haisoujouhou where syukei1 = $companyBango");
                    $output = $haisoujouhou->bunrui3 ?? null;
                } elseif (explode(" ", $other1)[0] == '2') {
                    $output = $other2->other24 ?? null;
                }
            }
        }
        return $output;
    }


    public function save(Request $request, $bango){
//        dd($request);
        // when data empty in shiharaizandaka table
        // meet the 3.2 spec
        if($request->success_result_3_2){
            $insert = PaymentScheduleRegister::create($request, $bango);
        }else{
            // update the shiharaizandaka table
            // meet the 3.1 spec
            if($request->success_result_3_1){
                $insert = PaymentScheduleRegister::update($request, $bango);
            }
        }


        if(is_array($insert) && $insert['status'] == 'ok') {
            return $insert;
        }else if (is_array($insert) && $insert['status'] == 'confirm') {
            return "confirm";
        }else if (is_array($insert) && $insert['status'] == 'ng') {
            return $insert;
        }else {
            $errors = $insert->all();
            return ['err_field' => $insert, 'err_msg' => $errors];
        }
    }

}
