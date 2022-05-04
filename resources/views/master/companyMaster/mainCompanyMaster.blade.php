@section('title', '会社マスタ')
@section('menu-test1', '会社マスタ')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- <title>@yield('title')</title>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <link rel="icon" href="{{url('img')}}/logoicon.png" type="image/png">
  <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/navbar_styles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/login_styles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/modal_styles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/product_styles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/pagination_styles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/datepicker.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/test_styles_fixed.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/test_modal_styles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/test_nav_new_styles_fixed.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/custom_checkbox_radio.css') }}"> --}}

  {{-- Including Common Header Starts Here --}}
  @include('layouts.header')
  {{-- Including Common Header Ends Here--}}

  <style>
  .custom-mb2{
    margin-bottom: 2px;
    font-size:12px!important;
  }
  .margin_t > span{
    font-size:12px!important;
  }
    .overflow_cls {
      overflow: hidden !important;
    }

    .c-mt-com {
      margin-top: 147px;
    }

    .c-mb-70 {
      margin-bottom: 70px;
    }

    .largeTable thead tr:nth-child(1) th {
      position: sticky;
      top: -1px;
      z-index: 1;
    }

    .largeTable tbody tr:nth-child(1) td {
      position: sticky;
      top: 43px;
      z-index: 1;
    }

    .table .thead-dark th {
      border: #29487d !important;
    }

    .largeTable {
      max-height: 800px;
      padding-bottom: 20px;
    }

    .custom-form .tab-content>.active {
      display: block;
      border: 1px solid #e1e1e1 !important;
    }

    @media only screen and (min-width: 1400px) {
      .largeTable {
        max-height: 695px;
        padding-bottom: 20px;
      }

      .left_right_margin {
        margin-bottom: : 0px;
      }
    }

    @media (max-width: 1800px) and (min-width: 280px) {
      .fullpage_width1 {
        min-width: 0px;
      }

      .responsive-page-view .footer-wrapper {
        min-width: 0px;
      }
    }

    .custom-file-input::-webkit-file-upload-button {
      visibility: hidden;
    }

    .custom-file-input::before {
      content: '参照';
      display: inline-block;
      background: linear-gradient(top, #f9f9f9, #e3e3e3);
      border: 1px solid #999;
      border-radius: 3px;
      padding: 5px 8px;
      outline: none;
      white-space: nowrap;
      -webkit-user-select: none;
      cursor: pointer;
      text-shadow: 1px 1px #fff;
      font-weight: 700;
      font-size: 10pt;
    }

    .custom-file-input:hover::before {
      border-color: black;
    }

    .custom-file-input:active::before {
      background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
    }

    .add_border {
      border: 2px solid #ff9900;
      padding: 0px;
    }

    .removeBorder {
      border: none;
      padding: 0px;
    }

    .comp_content1_row,
    .comp_content2_row,
    .comp_content3_row {
      cursor: pointer;
    }

    .box-dark {
      width: 13px;
      height: 13px;
      background-color: #333;
      color: #fff;
      text-align: right;
      float: right;
      cursor: pointer;
    }

    .ml-45 {
      margin-left: 45px;
    }

    .m_t {
      margin-top: 7px;
      font-size:12px!important;
    }

    @media screen and (-ms-high-contrast: active),
    (-ms-high-contrast: none) {
      .nav-tabs .nav-link.active {
        border: 0px !important;
      }
    }

    .nav-tabs .nav-link.active_nav {
      color: #55595c !important;
      border-color: #ddd #ddd transparent !important;
    }

    .nav-tabs .nav-link:not(.active) {
      border-color: transparent !important;
    }

    .nav-tabs .nav-link {
      color: #55595c !important;
    }

    .nav-tabs .nav-link.active,
    .nav-tabs .nav-item.show .nav-link {
      background-color: #c2d6d6 !important;
    }

    .tab-content>.active {
      display: block;
      border: 1px solid #29487d !important;
    }

    .nav-tabs .nav-link.active {
      border-top: 1px solid #29487d !important;
      border-right: 1px solid #29487d !important;
      border-left: 1px solid #29487d !important;
      border-bottom: 1px solid #fff !important;
    }

    .table>tbody>tr>td {
      border: 1px solid #29487d !important;
      color: #17252A;
    }

    .table-bordered td {
      border: 1px solid white !important;
    }

    .border {
      border: 1px solid #29487d !important;
    }

    .button_wrap_right_top {
      width: 40%;
    }

    .rounded_table_wrap {
      width: 60%;
    }

    @media only screen and (max-width: 767px) {

      .mt-sm {
        margin-top: 5px !important;
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

      .largeTable .btn-m-view {
        margin-bottom: 0px;
      }
    }

    .Red {
      border: 1px solid red !important;
      display: block;
      width: 100%;
      height: 30px;
      padding: 0.375rem 0.75rem;
    }

    .table-fill th span {
      height: 22px !important;
      line-height: 12px;
    }

    .custom-control-inline {
      margin-left: 12px !important;
    }

    .close:hover,
    .close:focus {
      outline: 0;
    }

    .content-head-section{
      padding: 0;
      min-height: 0;
    }
    .tag-line {
      margin-bottom: 13px;
      font-size: 12px;
      display: none;
    }
  </style>

  {{-- <style>
    .overflow_cls {
      overflow: hidden !important;
    }

    .w-cust-21 {
      width: 21%;
      float: left;
    }

    .w-cust-33 {
      width: 33%;
      float: left;
    }

    .w-cust-46 {
      width: 46%;
      float: left;
    }

    .tag-line {
      display: none;
    }

    .table-fill.table tbody tr td input {
      border: 1px solid #e1e1e1 !important;
      border-radius: 4px !important;
    }

    .table-fill.table tbody tr td {
      background: white;
      border: 1px solid #E1E1E1 !important;
    }

    .highlight span {
      background: #388BF5 !important;
      border: 2px solid #388BF5 !important;
    }

    .tdhighlight {
      background: #E2ECF5 !important;
    }

    .c-mt-com {
      margin-top: 147px;
    }

    .c-mb-70 {
      margin-bottom: 70px;
    }

    .largeTable thead tr:nth-child(1) th {
      position: sticky;
      top: -1px;
      z-index: 1;
    }

    .largeTable tbody tr:nth-child(1) td {

      position: sticky;
      top: 43px;
      z-index: 1;
    }

    .table .thead-dark th {
      border: #29487d !important;
    }

    .largeTable {
      max-height: 800px;
      padding-bottom: 20px;

    }

    @media only screen and (min-width: 1400px) {
      .largeTable {
        max-height: 695px;
        padding-bottom: 20px;

      }

      .left_right_margin {
        margin-bottom: : 0px;

      }
    }

    @media (max-width: 1800px) and (min-width: 280px) {
      .fullpage_width1 {
        min-width: 0px;
      }
    }

    .chk-wrapper input[type=checkbox]+label {
      display: block;
      margin: 0.2em;
      cursor: pointer;
      padding: 0.2em;
    }

    .chk-wrapper input[type=checkbox] {
      display: none;
    }

    .chk-wrapper input[type=checkbox]+label:before {
      content: "\2714";
      border: 0.1em solid #000;
      border-radius: 0.2em;
      display: inline-block;
      width: 18px;
      height: 18px;
      padding-left: 0.2em;
      padding-bottom: 0.3em;
      margin-right: 0.2em;
      vertical-align: bottom;
      color: transparent;
      transition: .2s;
    }

    .chk-wrapper input[type=checkbox]+label:active:before {
      transform: scale(0);
    }

    .chk-wrapper input[type=checkbox]:checked+label:before {
      background-color: #3e6ec1 !important;
      border-color: #3e6ec1 !important;
      color: #fff;
    }

    .chk-wrapper input[type=checkbox]:disabled+label:before {
      transform: scale(1);
      border-color: #aaa;
    }

    .chk-wrapper input[type=checkbox]:checked:disabled+label:before {
      transform: scale(1);
      background-color: #3e6ec1 !important;
      border-color: #3e6ec1 !important;
    }



    .custom-file-input::-webkit-file-upload-button {
      visibility: hidden;
    }

    .custom-file-input::before {
      content: '参照';
      display: inline-block;
      background: linear-gradient(top, #f9f9f9, #e3e3e3);
      border: 1px solid #999;
      border-radius: 3px;
      padding: 5px 8px;
      outline: none;
      white-space: nowrap;
      -webkit-user-select: none;
      cursor: pointer;
      text-shadow: 1px 1px #fff;
      font-weight: 700;
      font-size: 10pt;
    }

    .custom-file-input:hover::before {
      border-color: black;
    }

    .custom-file-input:active::before {
      background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
    }

    .add_border {
      border: 2px solid #ff9900;
      padding: 0px;
    }

    .removeBorder {
      border: none;
      padding: 0px;
    }

    .comp_content1_row,
    .comp_content2_row,
    .comp_content3_row {
      cursor: pointer;

    }

    .box-dark {
      width: 13px;
      height: 13px;
      background-color: #333;
      color: #fff;
      text-align: right;
      float: right;
      cursor: pointer;
    }

    .ml-45 {
      margin-left: 45px;
    }

    .m_t {
      margin-top: 7px;

    }


    @media screen and (-ms-high-contrast: active),
    (-ms-high-contrast: none) {
      .nav-tabs .nav-link.active {

        border: 0px !important;
      }
    }

    .tbl_tab td {
      border: 1px solid #29487d !important;
    }

    .tbl_tab td:first-child {
      border: none !important;
    }

    .nav-tabs .nav-link.active_nav {
      color: #55595c !important;

      border-color: #ddd #ddd transparent !important;
      /*1px solid #c2d6d6 !important*/

    }

    .nav-tabs {
      /*border-bottom: 0px!important;*/
    }

    .nav-tabs .nav-link:not(.active) {
      border-color: transparent !important;
    }

    .nav-tabs .nav-link {
      color: #55595c !important;


    }

    .nav-tabs .nav-link.active,
    .nav-tabs .nav-item.show .nav-link {
      background-color: #c2d6d6 !important;


    }


    .tab-content>.active {
      display: block;
      border: 1px solid #29487d !important;


    }

    .nav-tabs .nav-link.active {
      border-top: 1px solid #29487d !important;
      border-right: 1px solid #29487d !important;
      border-left: 1px solid #29487d !important;
      border-bottom: 1px solid #fff !important;
    }

    .table>tbody>tr>td {
      border: 1px solid #29487d !important;
      color: #17252A;
    }

    .table-bordered td {
      border: 1px solid white !important;
    }

    .border {
      border: 1px solid #29487d !important;

    }

    .button_wrap_right_top {
      width: 40%;
      /*margin: 2%;*/
    }

    .rounded_table_wrap {
      width: 60%;
      /*margin: 2%;*/
    }


    @media only screen and (max-width: 767px) {

      .w-cust-21 {
        width: 100%;
      }

      .w-cust-33 {
        width: 100%;
      }

      .w-cust-33 input {
        width: 100% !important;
      }

      .w-cust-46 {
        width: 100%;
      }

      .mt-sm {
        margin-top: 5px !important;
      }

      .chk-wrapper {
        float: left;
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

    }

    .Red {
      border: 1px solid red !important;
      display: block;
      width: 100%;
      height: 30px;
      padding: 0.375rem 0.75rem;
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

    .table-fill th span {
      height: 22px !important;
      line-height: 12px;
    }

    .custom-control-inline {
      margin-left: 12px !important;
    }

    @media only screen and (max-width: 767px) {
      .button-responsive-view {
        padding: 10px 0px !important;
      }
    }

    .link-hover a {
      position: relative;
      display: inline-block;
      color: royalblue;
      font-weight: 800;
      text-decoration: none;
      overflow: hidden;
    }

    .link-hover a:hover {
      text-decoration: none;
    }

    .link-hover a:before {
      position: absolute;
      content: attr(data-content);
      top: 0;
      left: 0;
      width: 0;
      // height: 0;
      color: midnightblue;
      white-space: nowrap;
      overflow: hidden;
      transition: width 875ms ease;
      // transition: height 275ms ease;
    }

    .link-hover a:hover:before {
      width: 100%;
      text-decoration: none;
      // height: 100%;
    }

    .link-hover {
      float: right;
    }

    @media (max-width: 991px) {
      .link-hover {
        float: left !important;
      }
    }

    @media only screen and (max-width: 767px) {
      .link-hover {
        float: left !important;
      }
    }

    .custom-arrow select::-ms-expand {
      display: none;
    }

    .custom-arrow select {
      -webkit-appearance: none;
    }

    .error {
      border: 1px solid red !important;
    }


    textarea {
      outline: none !important;
    }
  </style> --}}
</head>

<body class="responsive-page-view">

  {{-- Navbar Starts Here --}}
  @include('layout.nav_fixed')
  {{-- Navbar Ends Here --}}

  <style type="text/css">

    @media only screen and (max-width: 767px) {
      .header-checkbox {
        margin-left: 0 !important;
      }

      .button-responsive-view {
        padding: 10px 0px !important;
      }
    }

    textarea {
      outline: none !important;
    }
  </style>



  {{-- <style type="text/css">
    .container {
      max-width: 1140px !important;
    }

    @media only screen and (max-width: 767px) {
      .largeTable .btn-m-view {
        margin-bottom: 0px;
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
    }
  </style>
  <style type="text/css">
    .tag-line {
      display: none;
    }

    .container {
      max-width: 1140px !important;
    }

    @media (max-width: 1800px) and (min-width: 280px) {
      .fullpage_width1 {
        min-width: 0px;
      }
    }

    @media only screen and (max-width: 767px) {
      .largeTable .btn-m-view {
        margin-bottom: 0px;
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
    }
  </style> --}}

  {{-- Main Content Starts Here --}}
  @include('master.companyMaster.companyMainContent')
  {{-- Main Content Ends Here --}}

  {{-- Registration Modal Starts Here --}}
  @include('master.companyMaster.companyRegistrationModal')
  {{-- Registration Modal Ends Here --}}

  {{-- Detatils Modal Starts Here --}}
  @include('master.companyMaster.companyDetailViewModal')
  {{-- Detatils Modal Ends Here --}}

  {{-- Edit Modal Starts Here --}}
  @include('master.companyMaster.companyEditModal')
  {{-- Edit Modal Ends Here --}}

  {{-- Table Header Settings Modal Starts Here --}}
  @include('master.common.table_settings_modal')
  {{-- Table Header Settings Modal Ends Here --}}

  {{-- New Modal Starts Here --}}
  @include('master.companyMaster.companyAtarashiModal')
  @include('master.companyMaster.companyAtarashiModal2')
  {{-- New Modal Ends Here --}}

  {{-- Print Modal Starts Here --}}
  @include('master.companyMaster.printModal')
  {{-- Print Modal Ends Here --}}

  {{-- Footer Starts Here --}}
  @include('layout.footer_new')
  {{-- Footer Ends Here --}}



  <script src=" {{ asset('js/jquery-3.4.1.min.js') }}"></script>
  <script src=" {{ asset('js/bootstrap.min.js') }}"></script>
  <script src=" {{ asset('js/select2.min.js') }}"></script>
  {{-- <script src=" {{ asset('js/master/companyMaster.js') }}"></script> --}}
  {{-- <script src=" {{ asset('js/common.js') }}"></script> --}}
  <script src=" {{ asset('js/datepicker2.js') }}"></script>
  <script src=" {{ asset('js/datepicker.ja-JP.js') }}"></script>

  <!-- Hard reload js link starts here -->
  <script type="text/javascript">
    var companyMasterLink = document.createElement("script");
    companyMasterLink.type = "text/javascript";
    companyMasterLink.src = "{{ asset('js/master/companyMaster.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(companyMasterLink);
  </script>
  <!-- Hard reload js link ends here -->

  {{-- common.js link include starts here --}}
  @include('layouts.common_js')
  {{-- common.js link include ends here --}}

  <!-- Hard reload js link end -->


  {{-- Open Table Header Settings Starts here --}}
  <script>
    $(document).ready(function(){
      $('#openSettingModal').attr('onclick', "showTableSetting('{{route('companyMasterTableSetting',$bango)}}')");
    });
  </script>
  {{-- Open Table Header Settings Ends here --}}


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



  {{-- Enter to  Last tab to First Tab focus Starts Here --}}
  <script>
    // for table header settings lat input to first input focusing
    function firstTab(event) {
      if (event.keyCode == 13) {
        $("#product_name").focus();
        event.preventDefault();
      }
    }
  </script>
  {{-- Enter to  Last tab to First Tab focus Ends Here --}}

  {{-- Autofocus Starts Here --}}
  <script>
    $(document).on('shown.bs.modal', function(e) {
      $('[autofocus]', e.target).focus();
    });
  </script>
  <script>
  //Change tab menu still focus on header button....
  $('a[data-toggle="tab"]').on("click", function () {
    $("#regButton").focus();
  });
  //edit.....
  $('a[data-toggle="tab"]').on("click", function () {
    $("#editButton").focus();
  });
  $('a[data-toggle="tab"]').on("click", function () {
    $("#deleteThis").focus();
  });
</script>
  {{-- Autofocus Ends Here --}}

  {{-- showing edit modal custom Starts here  --}}
  <script type="text/javascript">
    $("#comp_button3").on("click", function(){
      $('.modal-backdrop').remove();
      $('#comp_modal3').on('show.bs.modal', function (e) {
        $('body').addClass('overflow_cls');
      })
      $('#comp_modal3').on('hide.bs.modal', function (e) {
        $('body').removeClass('overflow_cls');
      })
      $("#company_code_modal2").modal("hide");
    });
  </script>
  {{-- showing edit modal custom Ends here  --}}

  {{-- #SI - Calendar modified code Starts here --}}
  {{-- Registration Modal --}}
  {{-- Registration - Tab 1 Starts Here --}}
  <script type="text/javascript">
    $(function () {
      $('#datepicker1_comShow').datepicker({
        language: 'ja-JP',
        format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,
        offset: 36,
        trigger: '#cal_icon1_c',

      });
      $('#datepicker1_comShow').on('change', function(){
        let datevalue = document.getElementById("datepicker1_comShow").value;  //getting date value from calendar
        let current_datetime = new Date(datevalue);
        // console.log(datevalue);
        let yearValue = current_datetime.getFullYear();
        let monthValue = (current_datetime.getMonth() + 1);
        let dayValue = current_datetime.getDate();
        if (dayValue < 10) {
            dayValue = "0" + dayValue;
        }
        if (monthValue < 10) {
            monthValue = "0" + monthValue;
        }
        let formatted_date = yearValue + "" + monthValue + "" + dayValue;
        // console.log(formatted_date);
        document.getElementById("reg_tel").value = formatted_date;
        $('#reg_tel').focus(); //focusing current input on select
        // $(this).focus(); //focusing current input on select
      });

      $('#reg_tel').on('change', function() {
        let inputDateValue = document.getElementById("reg_tel").value;  //getting date value from input
        // console.log(inputDateValue);

        if(inputDateValue.length==8){
          let slicedYear = inputDateValue.slice(0, 4);
          // console.log(slicedYear);

          let slicedMonth = inputDateValue.slice(4, 6) - 1;
          // console.log(slicedMonth);

          let slicedDay = inputDateValue.slice(6, 8);
          // console.log(slicedDay);
          $('#datepicker1_comShow').datepicker('setDate', new Date(slicedYear, slicedMonth, slicedDay));
        }


      });
    });
  </script>

  {{-- Registration - Tab 2 Starts Here --}}
  <script type="text/javascript">
    $(function () {
      $('#datepicker2_comShow').datepicker({
        language: 'ja-JP',
        format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,
        offset: 36,
        trigger: '#cal_icon2_c',

      });
      $('#datepicker2_comShow').on('change', function(){
        let datevalue = document.getElementById("datepicker2_comShow").value;  //getting date value from calendar
        let current_datetime = new Date(datevalue);
        // console.log(datevalue);
        let yearValue = current_datetime.getFullYear();
        let monthValue = (current_datetime.getMonth() + 1);
        let dayValue = current_datetime.getDate();
        if (dayValue < 10) {
            dayValue = "0" + dayValue;
        }
        if (monthValue < 10) {
            monthValue = "0" + monthValue;
        }
        let formatted_date = yearValue + "" + monthValue + "" + dayValue;
        // console.log(formatted_date);
        document.getElementById("reg_kaiinbango").value = formatted_date;
        $('#reg_kaiinbango').focus(); //focusing current input on select
        // $(this).focus(); //focusing current input on select
      });

      $('#reg_kaiinbango').on('change', function() {
        let inputDateValue = document.getElementById("reg_kaiinbango").value;  //getting date value from input
        // console.log(inputDateValue);

        if(inputDateValue.length==8){
          // console.log(inputDateValue.length);
          let slicedYear = inputDateValue.slice(0, 4);
          let slicedMonth = inputDateValue.slice(4, 6) - 1;
          let slicedDay = inputDateValue.slice(6, 8);
          $('#datepicker2_comShow').datepicker('setDate', new Date(slicedYear, slicedMonth, slicedDay));
        }

      });
    });
  </script>

  <script type="text/javascript">
    $(function () {
      $('#datepicker3_comShow').datepicker({
        language: 'ja-JP',
        format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,
        offset: 36,
        trigger: '#cal_icon3_c',

      });
      $('#datepicker3_comShow').on('change', function(){
        let datevalue = document.getElementById("datepicker3_comShow").value;  //getting date value from calendar
        let current_datetime = new Date(datevalue);
        // console.log(datevalue);
        let yearValue = current_datetime.getFullYear();
        let monthValue = (current_datetime.getMonth() + 1);
        let dayValue = current_datetime.getDate();
        if (dayValue < 10) {
            dayValue = "0" + dayValue;
        }
        if (monthValue < 10) {
            monthValue = "0" + monthValue;
        }
        let formatted_date = yearValue + "" + monthValue + "" + dayValue;
        // console.log(formatted_date);
        document.getElementById("reg_zokugara").value = formatted_date;
        $('#reg_zokugara').focus(); //focusing current input on select
        // $(this).focus(); //focusing current input on select
      });

      $('#reg_zokugara').on('change', function() {
        let inputDateValue = document.getElementById("reg_zokugara").value;  //getting date value from input
        // console.log(inputDateValue);

        if(inputDateValue.length==8){
          // console.log(inputDateValue.length);
          let slicedYear = inputDateValue.slice(0, 4);
          let slicedMonth = inputDateValue.slice(4, 6) - 1;
          let slicedDay = inputDateValue.slice(6, 8);
          $('#datepicker3_comShow').datepicker('setDate', new Date(slicedYear, slicedMonth, slicedDay));
        }

      });
    });
  </script>

  <script type="text/javascript">
    $(function () {
      $('#datepicker4_comShow').datepicker({
        language: 'ja-JP',
        format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,
        offset: 36,
        trigger: '#cal_icon4_c',

      });
      $('#datepicker4_comShow').on('change', function(){
        let datevalue = document.getElementById("datepicker4_comShow").value;  //getting date value from calendar
        let current_datetime = new Date(datevalue);
        // console.log(datevalue);
        let yearValue = current_datetime.getFullYear();
        let monthValue = (current_datetime.getMonth() + 1);
        let dayValue = current_datetime.getDate();
        if (dayValue < 10) {
            dayValue = "0" + dayValue;
        }
        if (monthValue < 10) {
            monthValue = "0" + monthValue;
        }
        let formatted_date = yearValue + "" + monthValue + "" + dayValue;
        // console.log(formatted_date);
        document.getElementById("reg_haisoujouhou_name").value = formatted_date;
        $('#reg_haisoujouhou_name').focus(); //focusing current input on select
        // $(this).focus(); //focusing current input on select
      });

      $('#reg_haisoujouhou_name').on('change', function() {
        let inputDateValue = document.getElementById("reg_haisoujouhou_name").value;  //getting date value from input
        // console.log(inputDateValue);

        if(inputDateValue.length==8){
          // console.log(inputDateValue.length);
          let slicedYear = inputDateValue.slice(0, 4);
          let slicedMonth = inputDateValue.slice(4, 6) - 1;
          let slicedDay = inputDateValue.slice(6, 8);
          $('#datepicker4_comShow').datepicker('setDate', new Date(slicedYear, slicedMonth, slicedDay));
        }

      });
    });
  </script>

  <script type="text/javascript">
    $(function () {
      $('#datepicker5_comShow').datepicker({
        language: 'ja-JP',
        format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,
        offset: 36,
        trigger: '#cal_icon5_c',

      });
      $('#datepicker5_comShow').on('change', function(){
        let datevalue = document.getElementById("datepicker5_comShow").value;  //getting date value from calendar
        let current_datetime = new Date(datevalue);
        // console.log(datevalue);
        let yearValue = current_datetime.getFullYear();
        let monthValue = (current_datetime.getMonth() + 1);
        let dayValue = current_datetime.getDate();
        if (dayValue < 10) {
            dayValue = "0" + dayValue;
        }
        if (monthValue < 10) {
            monthValue = "0" + monthValue;
        }
        let formatted_date = yearValue + "" + monthValue + "" + dayValue;
        // console.log(formatted_date);
        document.getElementById("reg_haisoujouhou_yubinbango").value = formatted_date;
        $('#reg_haisoujouhou_yubinbango').focus(); //focusing current input on select
        // $(this).focus(); //focusing current input on select
      });

      $('#reg_haisoujouhou_yubinbango').on('change', function() {
        let inputDateValue = document.getElementById("reg_haisoujouhou_yubinbango").value;  //getting date value from input
        // console.log(inputDateValue);

        if(inputDateValue.length==8){
          // console.log(inputDateValue.length);
          let slicedYear = inputDateValue.slice(0, 4);
          let slicedMonth = inputDateValue.slice(4, 6) - 1;
          let slicedDay = inputDateValue.slice(6, 8);
          $('#datepicker5_comShow').datepicker('setDate', new Date(slicedYear, slicedMonth, slicedDay));
        }

      });
    });
  </script>

  {{-- Edit Modal --}}
  {{-- Edit - Tab 1 Starts Here --}}
  <script type="text/javascript">
    $(function () {
      $('#datepicker6_comShow').datepicker({
        language: 'ja-JP',
        format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,
        offset: 36,
        trigger: '#cal_icon6_c',

      });
      $('#datepicker6_comShow').on('change', function(){
        let datevalue = document.getElementById("datepicker6_comShow").value;  //getting date value from calendar
        let current_datetime = new Date(datevalue);
        // console.log(datevalue);
        let yearValue = current_datetime.getFullYear();
        let monthValue = (current_datetime.getMonth() + 1);
        let dayValue = current_datetime.getDate();
        if (dayValue < 10) {
            dayValue = "0" + dayValue;
        }
        if (monthValue < 10) {
            monthValue = "0" + monthValue;
        }
        let formatted_date = yearValue + "" + monthValue + "" + dayValue;
        // console.log(formatted_date);
        document.getElementById("edit_tel").value = formatted_date;
        // $(this).focus(); //focusing current input on select
        $('#edit_tel').focus(); //focusing current input on select
      });

      $('#edit_tel').on('change', function() {
        let inputDateValue = document.getElementById("edit_tel").value;  //getting date value from input
        // console.log(inputDateValue);

        if(inputDateValue.length==8){
          // console.log(inputDateValue.length);
          let slicedYear = inputDateValue.slice(0, 4);
          let slicedMonth = inputDateValue.slice(4, 6) - 1;
          let slicedDay = inputDateValue.slice(6, 8);
          $('#datepicker6_comShow').datepicker('setDate', new Date(slicedYear, slicedMonth, slicedDay));
        }

      });
    });
  </script>

  {{-- Edit - Tab 2 Starts Here --}}
  <script type="text/javascript">
    $(function () {
      $('#datepicker7_comShow').datepicker({
        language: 'ja-JP',
        format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,
        offset: 36,
        trigger: '#cal_icon7_c',

      });
      $('#datepicker7_comShow').on('change', function(){
        let datevalue = document.getElementById("datepicker7_comShow").value;  //getting date value from calendar
        let current_datetime = new Date(datevalue);
        // console.log(datevalue);
        let yearValue = current_datetime.getFullYear();
        let monthValue = (current_datetime.getMonth() + 1);
        let dayValue = current_datetime.getDate();
        if (dayValue < 10) {
            dayValue = "0" + dayValue;
        }
        if (monthValue < 10) {
            monthValue = "0" + monthValue;
        }
        let formatted_date = yearValue + "" + monthValue + "" + dayValue;
        // console.log(formatted_date);
        document.getElementById("edit_kaiinbango").value = formatted_date;
        $('#edit_kaiinbango').focus(); //focusing current input on select
        // $(this).focus(); //focusing current input on select
      });

      $('#edit_kaiinbango').on('change', function() {
        let inputDateValue = document.getElementById("edit_kaiinbango").value;  //getting date value from input
        // console.log(inputDateValue);

        if(inputDateValue.length==8){
          // console.log(inputDateValue.length);
          let slicedYear = inputDateValue.slice(0, 4);
          let slicedMonth = inputDateValue.slice(4, 6) - 1;
          let slicedDay = inputDateValue.slice(6, 8);
          $('#datepicker7_comShow').datepicker('setDate', new Date(slicedYear, slicedMonth, slicedDay));
        }

      });
    });
  </script>

  <script type="text/javascript">
    $(function () {
      $('#datepicker8_comShow').datepicker({
        language: 'ja-JP',
        format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,
        offset: 36,
        trigger: '#cal_icon8_c',

      });
      $('#datepicker8_comShow').on('change', function(){
        let datevalue = document.getElementById("datepicker8_comShow").value;  //getting date value from calendar
        let current_datetime = new Date(datevalue);
        // console.log(datevalue);
        let yearValue = current_datetime.getFullYear();
        let monthValue = (current_datetime.getMonth() + 1);
        let dayValue = current_datetime.getDate();
        if (dayValue < 10) {
            dayValue = "0" + dayValue;
        }
        if (monthValue < 10) {
            monthValue = "0" + monthValue;
        }
        let formatted_date = yearValue + "" + monthValue + "" + dayValue;
        // console.log(formatted_date);
        document.getElementById("edit_zokugara").value = formatted_date;
        $('#edit_zokugara').focus(); //focusing current input on select
        // $(this).focus(); //focusing current input on select
      });

      $('#edit_zokugara').on('change', function() {
        let inputDateValue = document.getElementById("edit_zokugara").value;  //getting date value from input
        // console.log(inputDateValue);

        if(inputDateValue.length==8){
          // console.log(inputDateValue.length);
          let slicedYear = inputDateValue.slice(0, 4);
          let slicedMonth = inputDateValue.slice(4, 6) - 1;
          let slicedDay = inputDateValue.slice(6, 8);
          $('#datepicker8_comShow').datepicker('setDate', new Date(slicedYear, slicedMonth, slicedDay));
        }

      });
    });
  </script>

  <script type="text/javascript">
    $(function () {
      $('#datepicker9_comShow').datepicker({
        language: 'ja-JP',
        format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,
        offset: 36,
        trigger: '#cal_icon9_c',

      });
      $('#datepicker9_comShow').on('change', function(){
        let datevalue = document.getElementById("datepicker9_comShow").value;  //getting date value from calendar
        let current_datetime = new Date(datevalue);
        // console.log(datevalue);
        let yearValue = current_datetime.getFullYear();
        let monthValue = (current_datetime.getMonth() + 1);
        let dayValue = current_datetime.getDate();
        if (dayValue < 10) {
            dayValue = "0" + dayValue;
        }
        if (monthValue < 10) {
            monthValue = "0" + monthValue;
        }
        let formatted_date = yearValue + "" + monthValue + "" + dayValue;
        // console.log(formatted_date);
        document.getElementById("edit_haisoujouhou_name").value = formatted_date;
        $('#edit_haisoujouhou_name').focus(); //focusing current input on select
        // $(this).focus(); //focusing current input on select
      });

      $('#edit_haisoujouhou_name').on('change', function() {
        let inputDateValue = document.getElementById("edit_haisoujouhou_name").value;  //getting date value from input
        // console.log(inputDateValue);

        if(inputDateValue.length==8){
          // console.log(inputDateValue.length);
          let slicedYear = inputDateValue.slice(0, 4);
          let slicedMonth = inputDateValue.slice(4, 6) - 1;
          let slicedDay = inputDateValue.slice(6, 8);
          $('#datepicker9_comShow').datepicker('setDate', new Date(slicedYear, slicedMonth, slicedDay));
        }

      });
    });
  </script>

  <script type="text/javascript">
    $(function () {
      $('#datepicker10_comShow').datepicker({
        language: 'ja-JP',
        format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,
        offset: 36,
        trigger: '#cal_icon10_c',

      });
      $('#datepicker10_comShow').on('change', function(){
        let datevalue = document.getElementById("datepicker10_comShow").value;  //getting date value from calendar
        let current_datetime = new Date(datevalue);
        // console.log(datevalue);
        let yearValue = current_datetime.getFullYear();
        let monthValue = (current_datetime.getMonth() + 1);
        let dayValue = current_datetime.getDate();
        if (dayValue < 10) {
            dayValue = "0" + dayValue;
        }
        if (monthValue < 10) {
            monthValue = "0" + monthValue;
        }
        let formatted_date = yearValue + "" + monthValue + "" + dayValue;
        // console.log(formatted_date);
        document.getElementById("edit_haisoujouhou_yubinbango").value = formatted_date;
        $('#edit_haisoujouhou_yubinbango').focus(); //focusing current input on select
        // $(this).focus(); //focusing current input on select
      });

      $('#edit_haisoujouhou_yubinbango').on('change', function() {
        let inputDateValue = document.getElementById("edit_haisoujouhou_yubinbango").value;  //getting date value from input
        // console.log(inputDateValue);

        if(inputDateValue.length==8){
          // console.log(inputDateValue.length);
          let slicedYear = inputDateValue.slice(0, 4);
          let slicedMonth = inputDateValue.slice(4, 6) - 1;
          let slicedDay = inputDateValue.slice(6, 8);
          $('#datepicker10_comShow').datepicker('setDate', new Date(slicedYear, slicedMonth, slicedDay));
        }

      });
    });
  </script>
  {{-- #SI - Calendar modified code ends here --}}

  {{-- <!-- Check uncheck for table settings Starts here -->
  <script type="text/javascript">
    var state = false; // desecelted

    $('.checkall').click(function () {
      $('.customCheckBox').each(function () {
        if (!state) {
          this.checked = true;
        }
      });
    });

    //Unchecked....
    $('.uncheck').click(function () {
      $('.customCheckBox').each(function () {
        if (!state) {
          this.checked = false;
          $("input[type='tel']").val("");
        }
      });
    });

  </script>
  <!-- Check uncheck for table settings Ends here --> --}}

  {{-- Custom Header Design Starts Here --}}
  {{-- <script type="text/javascript">
    $(document).ready(function () {
      $('th.signbtn').click(function () {
        $(this).addClass('highlight').siblings().removeClass('highlight');
        var th_index = $(this).index();
        $('#userTable tr').each(function () {
          $(this).find('td').eq(th_index).addClass('tdhighlight').siblings().removeClass('tdhighlight');
        });
      });
    });
  </script> --}}
  {{-- Custom Header Design Ends Here --}}

  {{-- hover message Starts here --}}
  {{-- <script type="text/javascript">
    // hover message
  $(function () {
    $(".message_content").hover(function () {
      var mssg = $(this).attr("message");
      $('.hover_message').html(mssg);
    },
    function () {
      $('.hover_message').html('');
    });
  });

  //message on hover on input in modal
  $(function () {
    $(".hover_message_content").hover(function () {
      var mssg = $(this).attr("message");
      $('.modal_hover_message').html(mssg);
    }, function () {
      $('.modal_hover_message').html('');
    });
  });

  </script> --}}

  {{-- hover message Ends here --}}


  <!-- Focus input while opening modal starts -->
  <script>
    // Registration Modal
    $('#registrationModal').on('shown.bs.modal', function () {
      $("#reg_kounyusu").focus();
    });
    // //Tab first field focus....
    //   $(document).on('shown.bs.modal', function (e) {
    //     if ('a[data-toggle="tab"]') {
    //       $('[autofocus]', e.target).focus();
    //     }


    // Settings Modal
    $('#setting_display_modal').on('shown.bs.modal', function () {
      $("#setting_name").focus();
    });

  </script>

  <!-- Focus input while opening modal ends -->
  <!-- Border script starts here -->
  <script>
    function removeBorder(){
      $('.show_office_master_info').removeClass('add_border');
      $('.show_personal_master_info').removeClass('add_border');
      $('.show_content_last').removeClass('add_border');
    }

    $(function () {
      $('.show_office_master_info').click(function(event) {
          $('.show_office_master_info').not(this).removeClass('add_border');
          $(this).addClass('add_border');
          //$("#office_master_content_div").show();
      });
    });

    $(function () {
      $(document).on('click','.show_personal_master_info',function(){
        $('.show_personal_master_info').not(this).removeClass('add_border');
        $(this).addClass('add_border');
        //$("#personal_master_content_div").show();
      });
    });

    $(function () {
      $(document).on('click','.show_content_last',function(){
        $('.show_content_last').not(this).removeClass('add_border');
        $(this).addClass('add_border');
        //$("#office_content_div_last").show();
      });

    });


    $(function () {
      $(document).on('click','.show_personal_master_info2',function(){
        $('.show_personal_master_info2').not(this).removeClass('add_border');
        $(this).addClass('add_border');
        //$("#personal_master_content_div").show();
      });
    });

    $(function () {
      $(document).on('click','.show_content_last2',function(){
        $('.show_content_last2').not(this).removeClass('add_border');
        $(this).addClass('add_border');
        //$("#office_content_div_last").show();
      });

    });
  </script>
  <!-- Border script ends here -->

</body>

</html>
