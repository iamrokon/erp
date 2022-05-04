@section('title', '受注入力')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '受注 >')
@section('menu-test5', '受注入力')
@section('tag-test', 'ここには、ガイドの文章が入ります。ここには、ガイドの文章が入ります。')
@section('tag-test1', 'ここには、ガイドの文章が入ります。ここには、ガイドの文章が入ります。')
@section('tag-test2', 'ここには、ガイドの文章が…')
@section('tag-test3', 'つづきを読む')

<!DOCTYPE html>
<html class="modaloverlay" lang="ja">

<head>
    {{-- <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <title>受注入力</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.usebootstrap.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/navbar_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/modal_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sales_acceptance_styles.css') }}">
    <!--    <link rel="stylesheet" type="text/css" href="{{ asset('css/order_entry_styles.css') }}"> -->

    <!--      <link rel="stylesheet" href="{{ asset('css/jquery.jpDatePicker.css') }}"> -->
    <!--     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datepicker.css') }}">
    <!-- Test style css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/test_styles_fixed.css') }}">
    <link rel="icon" href="{{url('img')}}/logoicon.png" type="image/png" id="faviconInage">

    <!--   <link rel="stylesheet" type="text/css" href="{{ asset('css/nav_new_styles.css') }}" > -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/test_nav_new_styles_fixed.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/test_modal_styles.css') }}"> --}}

    {{-- Including Common Header Starts Here --}}
    @include('layouts.header')
    {{-- Including Common Header Ends Here --}}

    <meta name="csrf-token" content="{{ csrf_token() }}" />

</head>

{{-- Including CSS Style 1 Starts Here --}}
@include('order.order-entry.styles')
{{-- @include('order.order-entry.styles1') --}}
{{-- Including CSS Style 1 Ends Here --}}

<body style="overflow-x:visible;" class="common-nav">

    <!-- preloader start here -->
    <div class="preloader">
        <div class="loading" style="display: none"></div>
    </div>
    <!-- preloader end here -->

    <section class="">

        {{-- Navbar Starts Here --}}
        @include('layout.nav_fixed')
        {{-- Navbar Ends Here --}}

        {{-- Including CSS Style 2 Starts Here --}}
        {{-- @include('order.order-entry.styles2') --}}
        {{-- Including CSS Style 2 Ends Here --}}
        <form id="insertData" enctype="multipart/form-data">
            <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
                <div class="content-head-section">
                    <div class="container" style="position: relative;">
                        <input type="hidden" id="formSubmitButton" name="type" />
                        <input type="hidden" id="csrf" value="{{ csrf_token() }}" name="_token">
                        <input type="hidden" name="bango" id="userId" value="{{ $bango }}">
                        <input type="hidden" id="confirm_status" name="confirm_status" value="0">
                        <input type="hidden" name="payment_method" id="kessaihouhou" />
                        <input type="hidden" name="acceptance_condition" id="chumonsyajouhou" />
                        <input type="hidden" name="sales_standard" id="soufusakijouhou" />
                        <input type="hidden" name="immediate_version" id="housoukubun">
                        <input type="hidden" name="source" value="orderEntry" />
                        <input type="hidden" id="hikiatesyukkodatachar01">
                        <input type="hidden" id="hikiatesyukkodatachar04">
                        <input type="hidden" name="datachar08" id="datachar08">
                        <input type="hidden" name="datachar05" id="datachar05" value="">
                        <input type="hidden" id="lineFromIdRand">
                        <input type="hidden" id="isEditReadonly">
                        <input type="hidden" id="image_url" value="{{ asset('img/logoicon.png') }}">
                        <input id='page_name' value='orderEntry' type='hidden' />
                        <input id='_hikitasukko_val' type='hidden' />
                        <input id='innerLevel' value='{{$tantousya->innerlevel}}' type='hidden'/>
                        <input id='patternsub2_1' value='{{$patternsub2_1}}' type='hidden'/>
                        <input id='patternsub2_2' value='{{$patternsub2_2}}' type='hidden'/>
                        <input id='price_total_p1' value='0' type='hidden'/>
                        <input id='purchase_total_p1' value='0' type='hidden'/>
                        <input type="hidden" id="dataint16_total" name="dataint16_total" value="">
                        <input type="hidden" id="total_money10" name="total_money10" value="0">
                        <input type="hidden" id="purchase_other_total" name="purchase_other_total" value="0">
                        <input id='deletion_restriction' value='0' type='hidden'/>
                        <input id='update_restriction' value='0' type='hidden'/>
                        <input id='max_update_count' value='' type='hidden'/>
                        <input id='value_of_F' value='' type='hidden'/>
                        <input id='value_of_B' value='' type='hidden'/>
                        <input id='max_update_count' value='' type='hidden'/>

                        @if (Session::has('success_msg'))
                        <div class="row success-msg-box" id="session_msg" style="width:100%; position: relative; width: 100%; max-width: 1452px; z-index: 1;">
                            <div class="col-12 pl-0 pr-0 ml-3">
                                <div class="alert alert-primary alert-dismissible">
                                    <button type="button" class="close dismissMe" data-dismiss="alert" autofocus onclick="$('#categorikanri').focus();">
                                        &times;
                                    </button>
                                    <strong>{{ session()->pull('success_msg') }}</strong>
                                </div>
                            </div>
                        </div>
                        @endif

                        <script>
                            // Focus on Alert Closing
                            $(".dismissMe").keydown(function(e) {
                                if (e.shiftKey && e.which == 13) {
                                    $('.close').alert('close');
                                    event.preventDefault();
                                    document.getElementById("categorikanri").click();
                                    $('#categorikanri').focus();
                                }
                            });

                        </script>

                        {{-- Error Message Starts Here --}}
                        <div class="row">
                            <div class="col-12">
                                <div id="error_data" style="color: red;position: relative;"></div>
                            </div>
                        </div>
                        {{-- Error Message Ends Here --}}

                        <div class="row order_entry_topcontent inner-top-content">
                            <div class="ml-3 mr-3">
                                <div class="content-head-top" style="margin-bottom:17px !important;">
                                    <div class="row">
                                        <div class="col">
                                            <table class="table custom-form custom-table" style="margin-bottom:6px !important;border: none!important;">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                            <div class="line-icon-box"></div>
                                                        </td>
                                                        <td style=" border: none!important;width: 65px!important;">受注区分
                                                        </td>
                                                        <td style=" border: none!important;width: 178px;">
                                                            <div class="custom-arrow">
                                                                <select class="form-control" name="order_category" id="categorikanri" autofocus>
                                                                    {{-- onfocus="$('.close').alert('close');"> --}}
                                                                    @foreach ($categorykanriesU1 as $categoryKanri)
                                                                    <option value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}">
                                                                        {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col">
                                            <table class="table custom-form custom-table" style="border: none!important;">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                            <div class="line-icon-box"></div>
                                                        </td>
                                                        <td style=" border: none!important;width: 53px!important;">作成区分
                                                        </td>
                                                        <td style=" border: none!important;width: 178px">
                                                            <div class="custom-arrow">
                                                                <select class="form-control" name="creation_category" id="request">
                                                                    @foreach ($request1s as $request)
                                                                    <option value="{{ $request->syouhinbango}}">
                                                                        {{ $request->syouhinbango . ' ' . $request->jouhou }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col">
                                            <table class="table custom-form custom-table" style="border: none!important;width: 100% !important;">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                            <div class="line-icon-box"></div>
                                                        </td>
                                                        <td style=" border: none!important;width: 53px!important;">番号検索
                                                        </td>
                                                        <td style=" border: none!important; min-width: 179px!important;">
                                                            <div style="width: 100% !important;">
                                                                <div class="input-group position-relative">
                                                                    <input type="text" class="form-control" name="number_search" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" id="number_search" placeholder="番号検索" style="width: 127px!important;">
                                                                    <input type="hidden" name="ordertypebango2" id="ordertypebango2">
                                                                    <div class="input-group-append">
                                                                        <button class="input-group-text btn open_number_search" type="button" style="height: 30px !important; width: 30px !important; padding: 0px 8px !important;" onclick="handleNumberSearchModalOpener('number_search',event.preventDefault())">
                                                                            <i class="fas fa-arrow-left"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col">
                                            <table class="table custom-form" style="border: none!important;">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                            <div class="line-icon-box"></div>
                                                        </td>
                                                        <td style=" border: none!important;width: 53px!important;">受注番号
                                                        </td>
                                                        <td style=" border: none!important;width: 178px;">
                                                            <!-- <div style="width: 269px !important"> -->
                                                            <input type="text" id="order_number" name="order_number" value="" class="form-control" placeholder="受注番号" readonly>
                                                            <!-- </div> -->
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <table class="table custom-form custom-table-1" style="border: none!important;margin-bottom:13px !important;">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                            <div class="line-icon-box"></div>
                                                        </td>
                                                        <td style=" border: none!important;width: 64px!important;">受注先
                                                        </td>
                                                        <td style=" border: none!important;width: 84%;">
                                                            <div class="input-group input-group-sm custom_modal_input" style="margin-bottom: 4px;">
                                                                <input id="reg_sold_to" type="text" class="form-control" placeholder="受注先" readonly>
                                                                <input id="reg_sold_to_db" type="hidden" name="sold_to" class="db_hidden_field">
                                                                <div class="input-group-append">
                                                                    <button type="button" onclick="supplierSelectionModalOpener('reg_sold_to','reg_sold_to_db','1','required','r17_3cd',2,event.preventDefault());" class="input-group-text btn sold_to_modal_opener"><i class="fas fa-arrow-left"></i></button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                            <div class="line-icon-box"></div>
                                                        </td>
                                                        <td style=" border: none!important;width: 64px!important;">売上請求先
                                                        </td>
                                                        <td style=" border: none!important;width: 84%;">
                                                            <div class="input-group input-group-sm custom_modal_input" style="margin-bottom: 4px;">
                                                                <input id="reg_sales_billing_destination" type="text" class="form-control" placeholder="売上請求先" readonly>
                                                                <input id="reg_sales_billing_destination_db" type="hidden" name="sales_billing_destination" class="db_hidden_field" />
                                                                <div class="input-group-append">
                                                                    <button id="sales_billing_destination_btn" type="button" onclick="supplierSelectionModalOpener('reg_sales_billing_destination','reg_sales_billing_destination_db','1','required','r17_3cd',2,event.preventDefault()); $('#reg_sales_billing_destination').addClass('focusInput');" class="input-group-text btn sold_to_modal_opener"><i class="fas fa-arrow-left"></i></button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                            <div class="line-icon-box"></div>
                                                        </td>
                                                        <td style=" border: none!important;width: 64px!important;">最終顧客
                                                        </td>
                                                        <td style=" border: none!important;width: 84%;">
                                                            <div class="input-group input-group-sm custom_modal_input" style="margin-bottom: 4px;">
                                                                <input id="reg_end_customer" type="text" class="form-control" placeholder="最終顧客" readonly>
                                                                <input id="reg_end_customer_db" type="hidden" name="end_customer" class="db_hidden_field" />
                                                                <div class="input-group-append">
                                                                    <button type="button" onclick="supplierSelectionModalOpener('reg_end_customer','reg_end_customer_db','0','required','r17_3cd',1,event.preventDefault())" class="input-group-text btn sold_to_modal_opener"><i class="fas fa-arrow-left"></i></button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col">
                                            <table class="table custom-form" style="border: none!important;width: auto;">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                            <div class="line-icon-box"></div>
                                                        </td>
                                                        <td style=" border: none!important;width: 77px!important;">代理店1
                                                        </td>
                                                        <td style=" border: none!important;width: 100%;">
                                                            <div class="input-group input-group-sm custom_modal_input" style="margin-bottom: 4px;">
                                                                <input id="reg_agency_1" type="text" class="form-control" placeholder="代理店1" readonly>
                                                                <input id="reg_agency_1_db" type="hidden" name="agency_1" class="db_hidden_field" />
                                                                <div class="input-group-append ">
                                                                    <button type="button" onclick="supplierSelectionModalOpener('reg_agency_1','reg_agency_1_db','0','nullable','r17_3cd',1,event.preventDefault())" class="input-group-text btn sold_to_modal_opener"><i class="fas fa-arrow-left"></i></button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                            <div class="line-icon-box"></div>
                                                        </td>
                                                        <td style=" border: none!important;width: 77px!important;">代理店2
                                                        </td>
                                                        <td style=" border: none!important;width: 100%;">
                                                            <div class="input-group input-group-sm custom_modal_input" style="margin-bottom: 4px;">
                                                                <input id="reg_agency_2" type="text" class="form-control" placeholder="代理店2" readonly>
                                                                <input id="reg_agency_2_db" type="hidden" name="agency_2" class="db_hidden_field" />
                                                                <div class="input-group-append">
                                                                    <button type="button" onclick="supplierSelectionModalOpener('reg_agency_2','reg_agency_2_db','0','nullable','r17_3cd',1,event.preventDefault())" class="input-group-text btn sold_to_modal_opener"><i class="fas fa-arrow-left"></i></button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                            <div class="line-icon-box"></div>
                                                        </td>
                                                        <td style=" border: none!important;width: 77px!important;">
                                                            請求書送付先</td>
                                                        <td style=" border: none!important;width: 100%;">
                                                            <div class="input-group input-group-sm custom_modal_input" style="margin-bottom: 4px;">
                                                                <input id="reg_bill_to" type="text" class="form-control" placeholder="請求書送付先" readonly>
                                                                <input id="reg_bill_to_db" type="hidden" name="bill_to" class="db_hidden_field" />
                                                                <div class="input-group-append">
                                                                    <button type="button" onclick="supplierSelectionModalOpener('reg_bill_to','reg_bill_to_db','0','required','r17_3cd',1,event.preventDefault())" class="input-group-text btn sold_to_modal_opener"><i class="fas fa-arrow-left"></i></button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="content-head-bottom">
                                    <div class="row">
                                        <div class="ml-3 mr-3">
                                            <table class="table custom-form" style="border: none!important;margin-bottom:4px !important;">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                            <div class="line-icon-box"></div>
                                                        </td>
                                                        <td style=" border: none!important;width: 79px!important;">受注日
                                                        </td>
                                                        <td style=" border: none!important;width: 183px;">
                                                            <div class="input-group">
                                                                <input type="text" id="datepicker1_oen" maxlength="10" oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" class="form-control input_field datepicker1_oen" autocomplete="off" name="order_date" placeholder="年/月/日" style="width: 96px!important;">
                                                                <input id="datepicker1_comShow" type="hidden">
                                                            </div>
                                                            {{-- <div class="input-group">
                                                                <input name="" id="datepicker1_comShow" ignore
                                                                    type="text" class="input_field form-control"
                                                                    value="" autocomplete="off"
                                                                    style="background-color: white !important; color: white !important; position: absolute ; border: 1px solid white !important;">
                                                            </div> --}}
                                                        </td>

                                                        <td style="width: 33px!important;border:0!important;position: relative;">
                                                            <div class="td-border-line"></div>
                                                        </td>

                                                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                            <div class="line-icon-box"></div>
                                                        </td>
                                                        <td style=" border: none!important;width: 60px!important;">納期
                                                        </td>
                                                        <td style=" border: none!important;width: 150px;">
                                                            <div class="input-group">
                                                                <input type="text" id="datepicker2_oen" maxlength="10" oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" class="form-control input_field datepicker2_oen" autocomplete="off" name="delivery_date" placeholder="年/月/日" style="width: 96px!important;">
                                                                <input id="datepicker2_comShow" type="hidden">
                                                            </div>
                                                            {{-- <div class="input-group">
                                                                <input name="" id="datepicker2_comShow" ignore
                                                                    type="text" class="input_field form-control"
                                                                    value="" autocomplete="off"
                                                                    style="background-color: white !important; color: white !important; position: absolute ; border: 1px solid white !important;">
                                                            </div> --}}
                                                        </td>

                                                        <td style="width: 33px!important;border:0!important;position: relative;">
                                                            <div class="td-border-line"></div>
                                                        </td>

                                                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                            <div class="line-icon-box"></div>
                                                        </td>
                                                        <td style=" border: none!important;width: 60px!important;">検収日
                                                        </td>
                                                        <td style=" border: none!important;width: 148px;">
                                                            <div class="input-group">
                                                                <input type="text" id="datepicker3_oen" maxlength="10" oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" class="form-control input_field datepicker3_oen" autocomplete="off" name="inspection_date" placeholder="年/月/日" style="width: 96px!important;">
                                                                <input id="datepicker3_comShow" type="hidden">
                                                            </div>
                                                            {{-- <div class="input-group">
                                                                <input name="" id="datepicker3_comShow" ignore
                                                                    type="text" class="input_field form-control"
                                                                    value="" autocomplete="off"
                                                                    style="background-color: white !important; color: white !important; position: absolute ; border: 1px solid white !important;">
                                                            </div> --}}
                                                        </td>

                                                        <td style="width: 33px!important;border:0!important;position: relative;">
                                                            <div class="td-border-line"></div>
                                                        </td>

                                                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                            <div class="line-icon-box"></div>
                                                        </td>
                                                        <td style=" border: none!important;width: 60px!important;">売上日
                                                        </td>
                                                        <td style=" border: none!important;width: 138px;">
                                                            <div class="input-group">
                                                                <input type="text" id="datepicker4_oen" maxlength="10" oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" class="form-control input_field datepicker4_oen" autocomplete="off" name="sales_date" placeholder="年/月/日" style="width: 96px!important;">
                                                                <input id="datepicker4_comShow" type="hidden">
                                                            </div>
                                                            {{-- <div class="input-group">
                                                                <input name="" id="datepicker4_comShow" ignore
                                                                    type="text" class="input_field form-control"
                                                                    value="" autocomplete="off"
                                                                    style="background-color: white !important; color: white !important; position: absolute ; border: 1px solid white !important;">
                                                            </div> --}}
                                                        </td>

                                                        <td style="width: 33px!important;border:0!important;position: relative;">
                                                            <div class="td-border-line"></div>
                                                        </td>

                                                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                            <div class="line-icon-box"></div>
                                                        </td>
                                                        <td style=" border: none!important;width: 60px!important;">入金日
                                                        </td>
                                                        <td style=" border: none!important;width: 131px;">
                                                            <div class="input-group">
                                                                <input type="text" id="datepicker5_oen" maxlength="10" oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" class="form-control input_field datepicker5_oen" autocomplete="off" name="payment_date" placeholder="年/月/日" style="width: 96px!important;">
                                                                <input id="datepicker5_comShow" type="hidden">
                                                            </div>
                                                            {{-- <div class="input-group">
                                                                <input name="" id="datepicker5_comShow" ignore
                                                                    type="text" class="input_field form-control"
                                                                    value="" autocomplete="off"
                                                                    style="background-color: white !important; color: white !important; position: absolute ; border: 1px solid white !important;">
                                                            </div> --}}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="ml-3 mr-3">
                                            <table class="table custom-form custom-inpur-field" style="border: none!important;margin-bottom:4px !important;">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                            <div class="line-icon-box"></div>
                                                        </td>
                                                        <td style=" border: none!important;width: 79px!important;">受注件名
                                                        </td>
                                                        <td style=" border: none!important;width: 545px;">
                                                            <input type="text" id="order_subject" name="order_subject" class="form-control" placeholder="受注件名（全角40文字まで）" maxlength="40">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="mr-3">
                                            <table class="table custom-form custom-inpur-field" style="border: none!important;margin-bottom:4px !important;">
                                                <tbody>
                                                    <tr>
                                                        <td style=" border: none!important;width: 173px!important;">
                                                            <div class="input-group input-group-sm border-line-area ml-2">
                                                                <button class="btn c_hover" type="button" onkeydown="ignoreDisabledButton(event);" style="background: #4D82C6;color: #fff!important;border:1px solid #4D82C6;width:115px; border-radius: 4px 0 0 4px;line-height: 26px;text-align: center;font-size: 13px; pointer-events: none !important;">
                                                                    取引条件
                                                                </button>
                                                                <div class="input-group-append">
                                                                    {{-- <a class="input-group-text" id="igroup1"
                                                                        style="color: white;">
                                                                        <i class="fas fa-arrow-left"></i>
                                                                    </a> --}}
                                                                    <button class="input-group-text btn igroup1" id="igroup1" style="" type="button">
                                                                        <i class="fas fa-arrow-left"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td style="width: 23px!important;padding: 0!important;border:0!important;padding-left: 15px !important;">
                                                            <div class="line-icon-box"></div>
                                                        </td>
                                                        <td style=" border: none!important;width: 58px!important;">P J
                                                        </td>
                                                        <td style=" border: none!important;width: 385px;">
                                                            <div class="custom-arrow">
                                                                <select class="form-control" name="pj" id="pj">
                                                                    <option value="">プロジェクトを選択してください</option>
                                                                    @foreach ($pjs as $pj)
                                                                    <option value="{{ $pj->url }}">
                                                                        {{ $pj->urlsm }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="ml-3 mr-3">
                                            <table class="table custom-form custom-table" style="border: none!important;margin-bottom:4px !important;">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                            <div class="line-icon-box"></div>
                                                        </td>
                                                        <td style=" border: none!important;width: 79px!important;">伝票備考
                                                        </td>
                                                        <td style=" border: none!important;width: 545px;">
                                                            <input type="text" id="voucher_remarks" name="voucher_remarks" class="form-control" placeholder="伝票備考（全角40文字まで）" maxlength="40">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="ml-3 mr-3">
                                            <table class="table custom-form" style="border: none!important;margin-bottom:4px !important;">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                            <div class="line-icon-box"></div>
                                                        </td>
                                                        <td style=" border: none!important;width: 89px!important;">社内備考
                                                        </td>
                                                        <td style=" border: none!important;min-width: 526px;">
                                                            <input type="text" id="in_house_remarks" name="in_house_remarks" class="form-control" placeholder="社内備考（全角40文字まで）" maxlength="40">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="ml-3 mr-3">
                                            <table class="table custom-form custom-table " style="border: none!important;width: auto;">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                            <div class="line-icon-box"></div>
                                                        </td>
                                                        <td style=" border: none!important;width: 79px!important;">注文書
                                                        </td>
                                                        <td style=" border: none!important; min-width:186px;">
                                                            <div class="custom-select-file-upload input-group input-group-sm">
                                                                <div class="custom-file-area">
                                                                    <div class="input-group input-group-sm">
                                                                        <input type="file" accept=".zip,.pdf" class="custom-file-input" name="purchase_order" id="customFile" onchange="readURL(this);">
                                                                        <input type="hidden" name="purchase_order_file_name">
                                                                        <label class="custom-file-label c_hover" for="customFile" style="cursor: pointer;width: 152px;margin-right: -2px;background: #4D82C6;color: #fff!important; border: 1px solid #4D82C6;overflow: hidden;">注文書PDFアップロード
                                                                        </label>
                                                                        <div class="input-group-append">
                                                                            <button id="fileUploadClose" class="input-group-text btn fileUploadClose" type="button" style="padding: 0px 10px !important;cursor: pointer!important;">
                                                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <style type="text/css">
                                                                    .custom-select-file-upload .custom-file-input:lang(en)~.custom-file-label::after {
                                                                        content: "";
                                                                        background: transparent;
                                                                    }

                                                                    .custom-select-file-upload .custom-file-input:lang(ja)~.custom-file-label::after {
                                                                        content: "";
                                                                        background: transparent;
                                                                    }

                                                                    .custom-select-file-upload .custom-file-label::after {
                                                                        border-left: 0px;
                                                                    }

                                                                    .custom-select-file-upload .custom-file-label {

                                                                        color: #fff;
                                                                        position: relative;
                                                                        margin-bottom: 0px;
                                                                        height: 30px;
                                                                        border: 1px solid #2C66B0;
                                                                        background: #2C66B0;
                                                                    }

                                                                    .custom-select-file-upload .custom-file-label:hover {
                                                                        background: #398BF7;
                                                                        border: 1px solid #398BF7;
                                                                        cursor: pointer !important;
                                                                    }

                                                                    .c_hover:hover {
                                                                        background: #398BF7 !important;
                                                                        border: 1px solid #398BF7 !important;
                                                                        cursor: pointer !important;
                                                                    }

                                                                </style>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="ml-3 mr-3">
                                            <table class="table custom-form custom-table" style="border: none!important;width: auto;">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                            <div class="line-icon-box"></div>
                                                        </td>
                                                        <td style=" border: none!important;width: 53px!important;">客先注番
                                                        </td>
                                                        <td style=" border: none!important;width: 252px;position: relative;">
                                                            <input type="text" id="customer_order_number" name="customer_order_number" class="form-control" placeholder="（全角20文字まで）" maxlength="20">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="ml-3 mr-3" style="width: 230px;">
                                            <table class="table custom-form custom-table" style="border: none!important;width: auto;">
                                                <tbody>
                                                    <tr style="height: 28px;">
                                                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                            <div class="line-icon-box"></div>
                                                        </td>
                                                        <td style=" border: none!important;width: 60px!important;font-weight: bold;font-size: 0.9em;">
                                                            販売金額計
                                                        </td>
                                                        <input type="hidden" name="sales_amount_total" id="money10">
                                                        <td style=" border: none!important;width: 15px!important;"></td>
                                                        <td id="sales_amount_total" style=" border: none!important;width: 50%;font-weight: bold;font-size: 0.9em;">
                                                            ¥
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="ml-3 mr-3" style="width: 226px;">
                                            <table class="table custom-form" style="border: none!important;width: auto;">
                                                <tbody>
                                                    <tr style="height: 28px;">
                                                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                            <div class="line-icon-box"></div>
                                                        </td>
                                                        <td style=" border: none!important;width: 60px!important;font-weight: bold;font-size: 0.9em;">
                                                            営業粗利計
                                                        </td>
                                                        <input type="hidden" name="gross_profit_margin" id="moneymax">
                                                        <td style=" border: none!important;width: 15px!important;"></td>
                                                        <td style=" border: none!important;width: 50%;font-weight: bold;font-size: 0.9em;" id="gross_profit_margin">
                                                            ¥
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-bottom-section">
                    <div class="content-bottom-top" style="margin-bottom: 32px;">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="bottom-top-btn" style="cursor: pointer;">
                                        <span onclick="contentHideShow()" id="closetopcontent">閉じる</span>
                                    </div>

                                    <div class="bottom-top-title">
                                        受注明細
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="data-wrapper-content" style="width: 100%;">
                                        <div class="data-box-content" style="width: 10%; float: left;background-color:#666666;text-align: center;color:#fff;height: 67px;vertical-align: middle;border-radius: 5px 0px 5px;">
                                            <div style="padding: 23px;">
                                                行
                                            </div>
                                        </div>
                                        <div class="data-box-content2 text-center orderentry-databox" style="width: 90%;float: left;">
                                            <div style="width: 100%;float: left;">
                                                <div class="data-box float-left border border-bottom-0 border-right-0 border-left-0" style="padding: 5px; width: 12%;">
                                                    商品CD
                                                </div>
                                                <div class="data-box float-left border border-bottom-0 border-right-0" style="padding: 5px; width: 35%;">
                                                    商品名
                                                </div>
                                                <div class="data-box float-left border border-bottom-0 border-right-0" style="padding: 5px; width: 15%;">
                                                    発注日
                                                </div>
                                                <div class="data-box float-left border border-bottom-0 border-right-0" style="padding: 5px; width: 15%;">
                                                    個別納期
                                                </div>
                                                <div class="data-box float-left border border-bottom-0" style="padding: 5px; width: 23%;">
                                                    納品先
                                                </div>
                                            </div>
                                        </div>
                                        <div class="data-box-content2 text-center orderentry-databox" style="width: 90%;float: left;">
                                            <div style="width: 100%;float: left;">
                                                <div class="data-box float-left border" style="padding: 5px; width: 14%;border-right: 0 !important; border-left: 0 !important;">
                                                    単 位
                                                </div>
                                                <div class="data-box float-left border" style="padding: 5px; width: 8%;border-right: 0 !important;">
                                                    数量
                                                </div>
                                                <div class="data-box float-left border" style="padding: 5px; width: 8%;border-right: 0 !important;">
                                                    販売単価
                                                </div>
                                                <div class="data-box float-left border" style="padding: 5px; width: 8%;border-right: 0 !important;">
                                                    販売金額
                                                </div>
                                                <div class="data-box float-left border" style="padding: 5px; width: 8%;border-right: 0 !important;">
                                                    営業粗利
                                                </div>
                                                <div class="data-box float-left border" style="padding: 5px; width: 8%;border-right: 0 !important;">
                                                    S E@
                                                </div>
                                                <div class="data-box border  border-right-0" style="padding: 5px;float: left; width: 9%;">
                                                    研究所＠
                                                </div>
                                                <div class="data-box border  border-right-0" style="padding: 5px;float: left; width: 8%;">
                                                    出荷C@
                                                </div>
                                                <div class="data-box border  border-right-0" style="padding: 5px;float: left; width: 8%;">
                                                    仕入＠
                                                </div>
                                                <div class="data-box border border-right-0" style="padding: 5px;float: left; width: 11%;">
                                                    営 業
                                                </div>
                                                <div class="data-box border" style="padding: 5px;float: left; width: 10%;">
                                                    S E
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data-box-content3 orderentry-databox  text-center" style="width: 100%;float: left;">
                                        <div style="width: 100%;float: left;">
                                            <div class="data-box float-left border border-top-0" style="padding: 5px; width: 25%;border-right: 0 !important; border-left: 0 !important;">
                                                商品サブCD
                                            </div>
                                            <div class="data-box float-left border border-top-0" style="padding: 5px; width: 14%;border-right: 0 !important;">
                                                出荷指示
                                            </div>
                                            <div class="data-box float-left border border-top-0" style="padding: 5px; width: 4%;border-right: 0 !important;">
                                                保 守
                                            </div>
                                            <div class="data-box float-left border border-top-0" style="padding: 5px; width: 25%;border-right: 0 !important;">
                                                仕入先
                                            </div>
                                            <div class="data-box float-left border border-top-0" style="padding: 5px; width: 12%;border-right: 0 !important;">
                                                メーカー品番
                                            </div>
                                            <div class="data-box float-left border border-top-0" style="padding: 5px; width: 20%;border-right: 0 !important;">
                                                メーカー品名
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-bottom-bottom">
                        <div class="container">
                            @include('order.order-entry.include.line')

                            <div class="row submitDiv" id="products_button" style="margin-top: 16px;">
                                <!-- show err message if parent child has no dsbango -->
                                <div id="no_child_msg" style="color: red;padding-left: 15px;padding-bottom: 10px;font-size: 13px;">

                                </div>

                                <div class="col-4 ml-auto">
                                    <div class="form-button" style="float:right;display:inline-block;">
                                        <button type="button" id="excelBtn" class="btn btn-sm btn-success excelBtn uskc-button">Excel インポート</button>
                                        <button type="button" id="orderEntrySubmitBtn" class="btn btn-sm btn-primary orderEntrySubmitBtn uskc-button">登&nbsp;&nbsp;録</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- @include('layout.footer') --}}
                @include('layout.footer_new')
            </div>

    </section>


    @include('order.order-entry.include.number_search.main')

    <!-- Supplier Modal start here -->
    @include('common.supplierModal')
    <!-- Supplier Modal end here -->

    @include('order.order-entry.include.trading_condition')
    @include('order.order-entry.include.shipping_instruction')
    @include('order.order-entry.include.product.main')
    @include('order.order-entry.include.product_sub.main')
    @include('order.order-entry.include.product_description_detail')
    @include('order.order-entry.include.product_description_detail_page')
    @include('order.order-entry.alert_modal')
    @include('order.order-entry.alert_modal_new')
    @include('order.order-entry.include.confirm_modal')
    </form>

    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery.clone.min.js') }}"></script>
    <script src="https://cdn.usebootstrap.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/underscore.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/datepicker.js') }}"></script>
    <script src="{{ asset('js/datepicker.ja-JP.js') }}"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>

    <script>
        ko.bindingHandlers.nextFieldOnEnter = {
            init: function(element, valueAccessor, allBindingsAccessor) {
                $(element).on('keydown', '.trfocus', function(e) {
                    var self = $(this)
                        , form = $(element)
                        , focusable, next;

                    if (e.keyCode == 13 && !e.shiftKey) {
                        focusable = form.find('.trfocus').filter(':visible');
                        var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
                        next = focusable.eq(nextIndex);
                        next.find('.trfocus').addClass('rowSelect').focus();
                        // $(this).click();
                        return false;
                    }
                    if (e.keyCode == 13 && e.shiftKey) {
                        // alert('hello');
                        var rowSelect2 = $('.rowSelect');
                        $(this).trigger('click');

                    }
                });
            }
        };
        ko.applyBindings({});

    </script>
    <script type="text/javascript">
        var fileorderentry = document.createElement("script");
        fileorderentry.type = "text/javascript";
        fileorderentry.src = "{{ asset('js/order/order_entry/order_entry.js') }}?v=" + Math.floor((Math.random() *
            500) + 1);
        document.getElementsByTagName("head")[0].appendChild(fileorderentry);

    </script>
    <script type="text/javascript">
        var fileorderentrydev = document.createElement("script");
        fileorderentrydev.type = "text/javascript";
        fileorderentrydev.src = "{{ asset('js/order/order_entry/order_entry_dev.js') }}?v=" + Math.floor((Math
            .random() * 500) + 1);
        document.getElementsByTagName("head")[0].appendChild(fileorderentrydev);

    </script>
    <script type="text/javascript">
        var fileorderdetail = document.createElement("script");
        fileorderdetail.type = "text/javascript";
        fileorderdetail.src = "{{ asset('js/order/order_entry/order_detail.js') }}?v=" + Math.floor((Math.random() *
            500) + 1);
        document.getElementsByTagName("head")[0].appendChild(fileorderdetail);

    </script>
    <script type="text/javascript">
        var filenumsearch = document.createElement("script");
        filenumsearch.type = "text/javascript";
        filenumsearch.src = "{{ asset('js/order/order_entry/number_search.js') }}?v=" + Math.floor((Math.random() *
            500) + 1);
        document.getElementsByTagName("head")[0].appendChild(filenumsearch);

    </script>
    <script type="text/javascript">
        var filesupplier = document.createElement("script");
        filesupplier.type = "text/javascript";
        filesupplier.src = "{{ asset('js/order/order_entry/supplier.js') }}?v=" + Math.floor((Math.random() * 500) +
            1);
        document.getElementsByTagName("head")[0].appendChild(filesupplier);

    </script>
    <script type="text/javascript">
        var filepro = document.createElement("script");
        filepro.type = "text/javascript";
        filepro.src = "{{ asset('js/order/order_entry/product.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
        document.getElementsByTagName("head")[0].appendChild(filepro);

    </script>
    <script type="text/javascript">
        var fileprosub = document.createElement("script");
        fileprosub.type = "text/javascript";
        fileprosub.src = "{{ asset('js/order/order_entry/product_sub.js') }}?v=" + Math.floor((Math.random() * 500) +
            1);
        document.getElementsByTagName("head")[0].appendChild(fileprosub);

    </script>
    <script type="text/javascript">
        var fileshipstate = document.createElement("script");
        fileshipstate.type = "text/javascript";
        fileshipstate.src = "{{ asset('js/order/order_entry/shippment_statement.js') }}?v=" + Math.floor((Math
            .random() * 500) + 1);
        document.getElementsByTagName("head")[0].appendChild(fileshipstate);

    </script>
    <script type="text/javascript">
        var filetradcorp = document.createElement("script");
        filetradcorp.type = "text/javascript";
        filetradcorp.src = "{{ asset('js/order/order_entry/trading_conditions.js') }}?v=" + Math.floor((Math
            .random() * 500) + 1);
        document.getElementsByTagName("head")[0].appendChild(filetradcorp);

    </script>
    <script type="text/javascript">
        var fileprodes = document.createElement("script");
        fileprodes.type = "text/javascript";
        fileprodes.src = "{{ asset('js/order/order_entry/product_description_detail.js') }}?v=" + Math.floor((Math
            .random() * 500) + 1);
        document.getElementsByTagName("head")[0].appendChild(fileprodes);

    </script>
    <script type="text/javascript">
        var filecomm = document.createElement("script");
        filecomm.type = "text/javascript";
        filecomm.src = "{{ asset('js/common.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
        document.getElementsByTagName("head")[0].appendChild(filecomm);

    </script>

    {{-- <script src="{{asset('js/order/order_entry/order_entry.js')}}"></script>
    <script src="{{asset('js/order/order_entry/order_entry_dev.js')}}"></script>
    <script src="{{asset('js/order/order_entry/order_detail.js')}}"></script>
    <script src="{{asset('js/order/order_entry/number_search.js')}}"></script>
    <script src="{{asset('js/order/order_entry/supplier.js')}}"></script>
    <script src="{{asset('js/order/order_entry/product.js')}}"></script>
    <script src="{{asset('js/order/order_entry/product_sub.js')}}"></script>
    <script src="{{asset('js/order/order_entry/shippment_statement.js') }}"></script>
    <script src="{{asset('js/order/order_entry/trading_conditions.js')}}"></script>
    <script src="{{asset('js/order/order_entry/product_description_detail.js')}}"></script> --}}

    <!-- Hard reload js link -->
    {{-- <script src="{{ asset('js/order/order_entry/order_entry.js?v=50030') }}"></script>
    <script src="{{ asset('js/order/order_entry/order_entry_dev.js?v=50031') }}"></script>
    <script src="{{ asset('js/order/order_entry/order_detail.js?v=50032') }}"></script>
    <script src="{{ asset('js/order/order_entry/number_search.js?v=50033') }}"></script>
    <script src="{{ asset('js/order/order_entry/supplier.js?v=50034') }}"></script>
    <script src="{{ asset('js/order/order_entry/product.js?v=50035') }}"></script>
    <script src="{{ asset('js/order/order_entry/product_sub.js?v=50036') }}"></script>
    <script src="{{ asset('js/order/order_entry/shippment_statement.js?v=50037') }}"></script>
    <script src="{{ asset('js/order/order_entry/trading_conditions.js?v=50038') }}"></script>
    <script src="{{ asset('js/order/order_entry/product_description_detail.js?v=50039') }}"></script> --}}
    {{-- common.js link include starts here --}}
    {{-- @include('layouts.common_js') --}}
    {{-- common.js link include ends here --}}

    <!-- Hard reload js link end -->

</body>

</html>
