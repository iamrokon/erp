@section('title', '個人マスタ')
@section('menu-test1', '個人マスタ')
    <!DOCTYPE html>
<html lang="ja">

<head>
    {{-- <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="icon" href="{{url('img')}}/logoicon.png">
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
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/select2.min.js') }}"></script> --}}

    {{-- Including Common Header Starts Here --}}
    @include('layouts.header')
    {{-- Including Common Header Ends Here--}}
    <style>
        .tag-line {
            display: none;
        }

        .c-mt-per {
            margin-top: 22px;
        }

        .c-mb-70 {
            margin-bottom: 70px;
        }

        .overflow_cls {
            overflow: hidden !important;
        }

        .largeTable {
            padding-bottom: 10px;
            max-height: 455px;
            overflow: auto;
        }

        .m_t {
            margin-top: 7px;
        }

        .m-pl-15 {
            padding-left: 0px !important;
        }

        .m-pr-15 {
            padding-right: 0px !important;
        }

        @media only screen and (min-width: 1400px) {
            .largeTable {
                padding-bottom: 10px;
                max-height: 688px;
                overflow: auto;
            }

            .left_right_margin {
                margin-bottom:: 0px;
            }
        }

        @media only screen and (max-width: 767px) {
            .m-pl-15 {
                padding-left: 15px !important;
            }

            .m-pr-15 {
                padding-right: 15px !important;
            }

            .rounded_table_wrap {
                width: 50%;
                padding-left: 15px !important;
            }

            .nav_mview {
                margin-bottom: 15px !important;
            }

            .pagi-input-field {
                height: 36px !important;
            }

            .border_none_table td {
                border: 1px solid #29487d !important;
                padding: 4px;
            }

            .custom-control.square-box {
                margin-left: 13px !important;
            }

            .ml-m {
                margin-left: -10px;;
            }
        }

        .header-checkbox {
            margin-top: 5px;
        }

        @media (max-width: 1800px) and (min-width: 280px) {
            .fullpage_width1 {
                min-width: 0px;
            }

            .footer-wrapper {
                min-width: 0px;
            }
        }

        .close:hover,
        .close:focus {
            outline: 0;
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

        .custom-arrow select::-ms-expand {
            display: none;
        }

        .custom-arrow select {
            -webkit-appearance: none;
        }

        .custom-form .table > tbody > tr > td {
            border: 1px solid #e1e1e1 !important;
            color: #17252A;
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
    </style>



</head>

<body style="">

{{-- Navbar Starts Here --}}
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
    }

    .header-checkbox {
        margin-top: 5px;
    }

    @media only screen and (max-width: 767px) {
        .header-checkbox {
            margin-left: 0px !important;
        }

        .button-responsive-view {
            padding: 10px 0px !important;
        }
    }
</style>

{{-- Main Content Starts Here --}}
@include('master.personal_master.main_content')
{{-- Main Content Ends Here --}}

{{-- Registration Modal Starts Here --}}
@include('master.personal_master.registration_modal')
{{-- Registration Modal Ends Here --}}

{{-- Detatils Modal Starts Here --}}
@include('master.personal_master.view_modal')
{{-- Detatils Modal Ends Here --}}

{{-- Edit Modal Starts Here --}}
@include('master.personal_master.edit_modal')
{{-- Edit Modal Ends Here --}}

{{-- Table Header Settings Modal Starts Here --}}
@include('master.common.table_settings_modal')
{{-- Table Header Settings Modal Ends Here --}}

{{-- Print Modal Starts Here --}}
@include('master.personal_master.print_modal')
{{-- Print Modal Ends Here --}}

{{-- Footer Starts Here --}}
@include('layout.footer_new')
{{-- Footer Ends Here --}}


<link href="//ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css" rel="stylesheet" type="text/css">
<script src=" {{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src=" {{ asset('js/bootstrap.min.js') }}"></script>
{{-- <script src=" {{ asset('js/master/personalMaster.js') }}"></script> --}}
{{-- <script src=" {{ asset('js/common.js') }}"></script> --}}
<script src=" {{ asset('js/select2.min.js') }}"></script>

<!-- Hard reload js link starts here -->
<script type="text/javascript">
    var personalMasterLink = document.createElement("script");
    personalMasterLink.type = "text/javascript";
    personalMasterLink.src = "{{ asset('js/master/personalMaster.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(personalMasterLink);
</script>
<!-- Hard reload js link ends here -->

 {{-- common.js link include starts here --}}
 @include('layouts.common_js')
 {{-- common.js link include ends here --}}

<script>
    $(document).ready(function () {
        $('.custom_select_search').select2({
            dropdownParent: $('#registration_modal'),
            minimumResultsForSearch: Infinity
        });
        $('#openSettingModal').attr('onclick', "showTableSetting('{{route('personalMasterTableSetting',$bango)}}')");
        // $('.custom_select_search').select2({
        //     dropdownParent: $('#registration_modal'),
        //     minimumResultsForSearch: Infinity
        // });
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

{{-- <script>
  // for table header settings lat input to first input focusing
  function firstTab(event) {
    if (event.keyCode == 13) {
      $("#th2").focus();
      event.preventDefault();
      // alert('second event works');
    }
  }
</script> --}}

<script>
    // Registration Modal
    $('#registration_modal').on('shown.bs.modal', function () {
        $("#insert_company_cd_id").focus();
    });

    // Settings Modal
    $('#setting_display_modal').on('shown.bs.modal', function () {
        $("#setting_company_name").focus();
    });
</script>

<script>
    $(document).on('shown.bs.modal', function (e) {
        $('[autofocus]', e.target).focus();
    });
</script>

{{-- <script type="text/javascript">
  $("#personalButton3").on("click", function() {

  // $('body').removeClass('modal-open');
  //$('body').addClass('overflow_cls');
  $('.modal-backdrop').remove();
  $('#personal_modal3').on('show.bs.modal', function(e) {
    $('body').addClass('overflow_cls');
    $("#personal_modal2").modal("hide");
  })
  $('.modal-backdrop').show();
  $('#personal_modal3').on('hide.bs.modal', function(e) {
    $('body').removeClass('overflow_cls');
  })


});
</script> --}}

</body>

</html>
