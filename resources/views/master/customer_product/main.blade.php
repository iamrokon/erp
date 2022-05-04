@section('title', '得意先別商品マスタ')
@section('menu-test1', '得意先別商品マスタ')
    <!DOCTYPE html>
<html lang="ja">

<head>
    {{-- <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/navbar_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/modal_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/product_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pagination_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/test_styles_fixed.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/test_nav_new_styles_fixed.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom_checkbox_radio.css') }}">
    <link rel="icon" href="{{url('img')}}/logoicon.png" type="image/png" id="faviconInage">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/select2.min.js') }}"></script> --}}

    {{-- Including Common Header Starts Here --}}
    @include('layouts.header')
    {{-- Including Common Header Ends Here--}}
    <style>
        .tag-line {
            display: none;
        }

        .overflow_cls {
            overflow: hidden !important;
        }

        /* .largeTable {
          padding-bottom: 10px;
          max-height: 500px;
        } */

        @media only screen and (min-width: 1400px) {


            .left_right_margin {
                margin-bottom:: 0px;

            }
        }


        .m_t {
            margin-top: 7px;

        }

        .modal-open {
            overflow: hidden;
        }

        .modal {
            overflow: auto !important;

        }

        .button_wrap_right_top {
            width: 40%;
            /*margin: 2%;*/
        }

        .rounded_table_wrap {
            width: 60%;
            /*margin: 2%;*/
        }

        .custom-form .table > tbody > tr > td {
            border: 1px solid #e1e1e1 !important;
            color: #17252A;
        }

        @media only screen and (max-width: 767px) {

            .modal {
                /*  overflow: auto !important;*/
                padding: 0 !important;
            }

            .modal-open .modal {
                overflow-x: hidden;
                overflow-y: auto;
            }

            .rounded_table_wrap {
                width: 50%;
                padding-left: 15px !important;
            }

            .nav_mview {
                margin-bottom: 0px !important;
            }

            .pagi-input-field {
                height: 36px !important;
            }

        }

        .border_none_table td {
            border: 1px solid #29487d !important;
            padding: 4px;
        }

        .c-mt-crd {
            margin-top: 147px;
        }

        .c-mb-70 {
            margin-bottom: 70px;
        }

        .table-fill.table tbody tr td {
            background: white;
            border: 1px solid #E1E1E1 !important;
        }

        .table-fill.table tbody tr td input {
            border: 1px solid #e1e1e1 !important;
            border-radius: 4px !important;
        }

        .table-fill th span {
            height: 22px !important;
            line-height: 12px;
            border-radius: 4px;
        }

        .highlight {
            position: relative;
        }

        .highlight:before {
            width: 0;
            height: 0;
            border-left: 7px solid transparent;
            border-right: 7px solid transparent;
            border-top: 8px solid #388BF5;
            content: '';
            position: absolute;
            bottom: 4px;
            left: 0;
            right: 0;
            margin: 0 auto;
        }

        .highlight span {
            background: #388BF5 !important;
            border: 2px solid #388BF5 !important;
        }

        .tdhighlight {
            background: #E2ECF5 !important;
        }

        .largeTable thead tr:nth-child(1) th {
            position: sticky;
            top: -1px;
            z-index: 1;
        }

        .largeTable tbody tr:nth-child(1) td {
            position: sticky;
            top: 44px;
            z-index: 1;
        }

        .table .thead-dark th {
            border: #29487d !important;
        }

        .content-head-section {
            padding: 0;
            min-height: 0;
        }

        .tag-line {
            margin-bottom: 13px;
            font-size: 12px;
            display: none;
        }

        /*
          .custom-arrow select::-ms-expand {
            display: none;
          }

          .custom-arrow select {
            -webkit-appearance: none;
          }*/
    </style>
</head>


<body style="">

{{-- Navbar Starts Here --}}
{{-- @include('layout.nav_test') --}}
@include('layout.nav_fixed')
{{-- Navbar Ends Here --}}

<style type="text/css">
    .container {
        max-width: 1140px !important;
    }

    @media (max-width: 1800px) and (min-width: 280px) {
        .fullpage_width1 {
            min-width: 0px;
        }

        .footer-wrapper {
            min-width: 0px;
        }

        @media only screen and (max-width: 767px) {
            .largeTable .btn-m-view {
                margin-bottom: 0px;
            }
        }
    }

    .custom-arrow select::-ms-expand {
        display: none;
    }

    .custom-arrow select {
        -webkit-appearance: none;
    }

    @media only screen and (max-width: 767px) {
        .header-checkbox {
            margin-left: 0 !important;
        }

        .button-responsive-view {
            padding: 10px 0px !important;
        }
    }

    /* Button Hover Starts Here */
    .btn-info:hover {
        background-color: #398BF7 !important;
        background-image: none !important;
        border-color: #398BF7 !important;
    }

    /* Button Hover Ends Here */
</style>

{{-- Main Content Starts Here --}}
@include('master.customer_product.main_content')
{{-- Main Content Ends Here --}}

{{-- Registration Modal Starts Here --}}
@include('master.customer_product.registration_modal')
{{-- Registration Modal Ends Here --}}

{{-- Detatils Modal Starts Here --}}
@include('master.customer_product.view_modal')
{{-- Detatils Modal Ends Here --}}

{{-- Edit Modal Starts Here --}}
@include('master.customer_product.edit_modal')
{{-- Edit Modal Ends Here --}}

{{-- Print Modal Starts Here --}}
@include('master.customer_product.print_modal')
{{-- Print Modal Ends Here --}}

{{-- Table Header Settings Modal Starts Here --}}
@include('master.common.table_settings_modal')
{{-- Table Header Settings Modal Ends Here --}}

{{-- Footer Starts Here --}}
{{-- @include('layout.footer') --}}
@include('layout.footer_new')
{{-- Footer Ends Here --}}

<link href="//ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css" rel="stylesheet" type="text/css">
<script src=" {{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src=" {{ asset('js/bootstrap.min.js') }}"></script>
<script src=" {{ asset('js/select2.min.js') }}"></script>

<!-- Hard reload js link starts here -->
<script type="text/javascript">
    var customerProductMasterLink = document.createElement("script");
    customerProductMasterLink.type = "text/javascript";
    customerProductMasterLink.src = "{{ asset('js/master/customerProduct.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(customerProductMasterLink);
</script>
<!-- Hard reload js link ends here -->

 {{-- common.js link include starts here --}}
 @include('layouts.common_js')
 {{-- common.js link include ends here --}}

<script>
    $(document).ready(function () {
        $('#openSettingModal').attr('onclick', "showTableSetting('{{route('customerProductManagementTableSetting',$bango)}}')");
        $('.custom_select_search').select2({
            dropdownParent: $('#registration_modal'),
            minimumResultsForSearch: Infinity
        });
    });
</script>

{{-- Knockout - Enter to New Input Starts Here --}}
@include('master.common.knockout')
{{-- Knockout - Enter to New Input Ends Here --}}

{{-- Table Header Settings - Check/Uncheck All Checkbox Starts Here --}}
@include('master.common.check_uncheck_all')
{{-- Table Header Settings - Check/Uncheck All Checkbox Ends Here --}}

{{-- Button Hover Message Starts Here --}}
@include('master.common.hover_message')
{{-- Button Hover Message Ends Here --}}

{{-- Table Column Selection Starts Here --}}
@include('master.common.table_column_selection')
{{-- Table Column Selection Ends Here --}}

{{-- Mock --}}
<script type="text/javascript">
    $("#credit_s_button3").on("click", function () {
        $('.modal-backdrop').remove();
        $('#credit_s_modal3').on('show.bs.modal', function (e) {
            $('body').addClass('overflow_cls');
            $("#credit_s_modal2").modal("hide");
        })
        $('.modal-backdrop').show();
        $('#credit_s_modal3').on('hide.bs.modal', function (e) {
            $('body').removeClass('overflow_cls');
        })
    });
</script>


<script type="text/javascript">
    function openModalDetailCPM() {
        $("#view_modal").modal('show');
        $('.modal-backdrop').show();
    }

</script>
<script>
    // $("textarea").keydown(function (e) {
    //   if (e.keyCode == 13 && !e.shiftKey) {
    //     e.preventDefault();
    //   }
    // });

    function lastTab(event) {
        if (event.keyCode == 13) {
            document.getElementById("check_product_name").focus();
            event.preventDefault();
        }
    }

</script>

<script>

    $(document).on('shown.bs.modal', function (e) {
        $('[autofocus]', e.target).focus();
    });
</script>

</body>

</html>
