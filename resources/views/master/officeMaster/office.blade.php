@section('title', '事業所マスタ')
@section('menu-test1', '事業所マスタ')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- <title>@yield('title')</title>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <link rel="icon" href="{{url('img')}}/logoicon.png" type="image/png">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
  <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/navbar_styles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/login_styles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/modal_styles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/product_styles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/pagination_styles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/datepicker.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/test_styles_fixed.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/test_modal_styles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/test_nav_new_styles_fixed.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/custom_checkbox_radio.css') }}">
  <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="{{ asset('js/i18n/ja.js') }}"></script> --}}

  {{-- Including Common Header Starts Here --}}
  @include('layouts.header')
  {{-- Including Common Header Ends Here--}}

  <style>
    .select2-container--default .select2-selection--single .select2-selection__arrow b {
      border-color: #000 transparent transparent transparent;
    }

    .inner {
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25) !important;
      border-radius: 4px;
    }

    span.select2-selection.select2-selection--single:focus {
      outline: 0;
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25) !important;
    }

    span.select2.select2-container.select2-container--default.select2-container--above.select2-container--focus:focus {
      outline: 0;
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25) !important;
    }

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

    .c-mt-com {
      margin-top: 147px;
    }

    .largeTable {
     
      /* max-height: 455px; */
      overflow: auto;
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

    /* .largeTable {
      max-height: 820px;
    } */

    @media only screen and (min-width: 1400px) {
      /* .largeTable {
        max-height: 695px;
      } */

      .left_right_margin {
        margin-bottom: : 0px;
      }
    }

    @media (max-width: 1800px) and (min-width: 280px) {
      .fullpage_width1 {
        min-width: 0px;
      }
      .footer-wrapper {
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
    }

    .th_design {
      cursor: pointer;
      border: 2px solid #3e6ec1;
      padding: 3px;
      text-align: center;
      display: block;
      min-width: 80px;
      margin: auto;
      background-color: #3e6ec1;
      color: #fff;
      border-radius: 4px;
    }

    .custom-form .tab-content>.active {
      display: block;
      border: 1px solid #E1E1E1 !important;
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
        margin-bottom: 0px !important;
      }

      .pagi-input-field {
        height: 36px !important;
      }
    }

    .custom-control-inline {
      margin-left: 12px !important;
    }

    .custom-form .select2-container--default .select2-selection--single {
      border: 1px solid #e1e1e1 !important;
      border-radius: 4px !important;
    }

    @media only screen and (max-width: 767px) {
      .button-responsive-view {
        padding: 11px 16px !important;
      }
    }

    @media only screen and (max-width: 767px) {
      .largeTable .btn-m-view {
        margin-bottom: 0px;
      }
    }

    .content-head-section1 {
      padding-top: 127px;
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

    .close:hover,
    .close:focus {
      outline: 0;
    }

    /* Table Header Settings Border Remove */
    .custom-form .table>tbody>tr>td {
      border: 1px solid #e1e1e1 !important;
      color: #17252A;
    }
  </style>




</head>


<body style="">

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

    .bigdrop {
      width: 300px !important;
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

  {{-- <style type="text/css">
    .container {
      max-width: 1140px !important;
    }

    @media only screen and (max-width: 767px) {
      .largeTable .btn-m-view {
        margin-bottom: 0px;
      }
    }

    .fullpage_width1 {
      min-height: 100vh;
      position: relative;
    }

    .content-head-section1 {
      padding-top: 127px;
    }

    .footer-wrapper {
      position: absolute;
      bottom: 0;
    }

    @media (max-width: 1800px) and (min-width: 280px) {
      /* .fullpage_width1 {
        margin-top: 0; */
      /*min-width: 1140px;*/
    }
    }

    .custom-arrow select::-ms-expand {
      display: none;
    }

    .custom-arrow select {
      -webkit-appearance: none;
    }

    .header-checkbox {
      margin-top: 5px;
      margin-left: 15px !important;
    }

    @media only screen and (max-width: 767px) {
      .header-checkbox {
        margin-left: 0 !important;
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
  </style> --}}

  {{-- Main Content Starts Here --}}
  @include('master.officeMaster.officeMainTable')
  {{-- Main Content Ends Here --}}

  {{-- Registration Modal Starts Here --}}
  @include('master.officeMaster.officeRegistrationModal')
  {{-- Registration Modal Ends Here --}}

  {{-- Detatils Modal Starts Here --}}
  @include('master.officeMaster.officeDetailModal')
  {{-- Detatils Modal Ends Here --}}

  {{-- Edit Modal Starts Here --}}
  @include('master.officeMaster.officeEditModal')
  {{-- Edit Modal Ends Here --}}

  {{-- Table Header Settings Modal Starts Here --}}
  @include('master.common.table_settings_modal')
  {{-- Table Header Settings Modal Ends Here --}}

  {{-- New Modal Starts Here --}}
  @include('master.officeMaster.officeAtarashiModal')
  @include('master.officeMaster.officeAtarashiModal2')
  {{-- New Modal Ends Here --}}

  {{-- Print Modal Starts Here --}}
  @include('master.officeMaster.officePrint')
  {{-- Print Modal Ends Here --}}

  {{-- Footer Starts Here --}}
  @include('layout.footer_new')
  {{-- Footer Ends Here --}}


  <script src=" {{ asset('js/jquery-3.4.1.min.js') }}"></script>
  <script src=" {{ asset('js/bootstrap.min.js') }}"></script>
  <script src=" {{ asset('js/select2.min.js') }}"></script>
  {{-- <script src=" {{ asset('js/common.js') }}"></script> --}}
  {{-- <script src=" {{ asset('js/master/officeMaster.js') }}"></script> --}}
  <script src=" {{ asset('js/datepicker2.js') }}"></script>
  <script src=" {{ asset('js/datepicker.ja-JP.js') }}"></script>
  <!-- Hard reload js link -->
  
  {{-- common.js link include starts here --}}
  @include('layouts.common_js')
  {{-- common.js link include ends here --}}

  <!-- Hard reload js link starts here -->
  <script type="text/javascript">
    var officeMasterLink = document.createElement("script");
    officeMasterLink.type = "text/javascript";
    officeMasterLink.src = "{{ asset('js/master/officeMaster.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(officeMasterLink);
  </script>
  <!-- Hard reload js link ends here -->

  <script>
    $(document).ready(function () {
      $('#openSettingModal').attr('onclick', "showTableSetting('{{route('officeMasterTableSetting',$bango)}}')");
        $('.custom_select_search').select2({
            dropdownParent: $('#registrationModal'),
            minimumResultsForSearch: Infinity,
            language: "ja"
        });
        $('.custom_select_search_edit').select2({
            dropdownParent: $('#office_modal3'),
            minimumResultsForSearch: Infinity,
            language: "ja"
        });
    });
  </script>
  <script>
    $('#registrationModal').on('hidden.bs.modal', function () {
      $(this).find('form').trigger('reset');
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

  {{-- Enter to  Last tab to First Tab focus Starts Here --}}
  <script>
    // for table header settings lat input to first input focusing
    function firstTab(event) {
      if (event.keyCode == 13) {
        $("#product_name").focus();
        event.preventDefault();
        // alert('second event works');
      }
    }
  </script>
  {{-- Enter to  Last tab to First Tab focus Ends Here --}}

  {{-- Autofocus Starts Here --}}
  <script>
    $(document).on('shown.bs.modal', function (e) {
      $('[autofocus]', e.target).focus();
    });
  </script>
  {{-- Autofocus Ends Here --}}

  <script type="text/javascript">
    function openModalDetailCPM() {
      $("#view_modal").modal('show');
      $('.modal-backdrop').show();
    }
  </script>

  {{-- showing edit modal custom Starts here  --}}
  <script type="text/javascript">
    $("#officeButton3").on("click", function () {
      // $('body').removeClass('modal-open');
      //$('body').addClass('overflow_cls');
      $('.modal-backdrop').remove();
      $('#office_modal3').on('show.bs.modal', function (e) {
        //$('.custom_select_search_edit').trigger("change");
        $('body').addClass('overflow_cls');

      })
      $('#office_modal3').on('hide.bs.modal', function (e) {
        $('body').removeClass('overflow_cls');
      })
      $("#office_modal2").modal("hide");
    });
  </script>
  {{-- showing edit modal custom Ends here  --}}


  <script>
    function lastTab(event) {
      if (event.keyCode == 13) {
        document.getElementById("check_torihikisakibango").focus();
        event.preventDefault();
      }
    }
  </script>

  <!-- Focus for Custom Select starts here -->
  <script>
    // for registration
    function secondTab(event) {
      if (event.keyCode == 13) {
        document.getElementById("insert_name").focus();
        event.preventDefault();
        // alert('second event works');
      }
    }

    function finalTab(event) {
      if (event.keyCode == 13) {
        document.getElementById("insert_shikibetsucode").focus();
        $(".custom-select-option").focus();
        // $("#insert_shikibetsucode").focus();
        console.log($(".custom-select-option").focus());
        // event.preventDefault();
        // alert('final event works');
      }
    }
  </script>

  {{-- custom focus Starts here --}}
  <script>
    // Registration Modal
    $('#registrationModal').on('shown.bs.modal', function () {
      // $("#insert_shikibetsucode").focus();
      $(".custom_select_search").focus();

    });

    // Edit Modal
    $('#office_modal3').on('shown.bs.modal', function () {
      $("#edit_name").focus();
    });

    // Settings Modal
    $('#setting_display_modal').on('shown.bs.modal', function () {
      $("#setting_gaishamei").focus();
    });
  </script>


  <script>
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      var target = e.target.attributes.href.value;
      $(target + ' [autofocus]').focus();
    });
    $(document).on('shown.bs.modal', function (e) {
      if ('a[data-toggle="tab"]') {
        $('[autofocus]', e.target).focus();
      }

      if (".custom_select_search[autofocus]") {
        $('.select2-container--default').addClass('inner');
        $('.select2-selection__rendered').addClass('inner'); // #SI - first focus issue solving
      }
    });
  </script>

  <script>
    $(".custom_select_search[autofocus]").keydown(function () {
      var keycode = (event.keyCode ? event.keyCode : event.which);

      if (keycode == '13') {
        $('.select2-container--default').removeClass('inner');
        $(".select2-selection__rendered").removeClass('inner'); // #SI - first focus issue solving
      }
    });

    $(".lastEnter").keydown(function () {
      var keycode = (event.keyCode ? event.keyCode : event.which);

      if (keycode == '13') {
        $(".select2-container--default").addClass('inner');
      }
    });

    $(document).on("click", 'a[data-toggle="tab"]', function () {
      $(".custom_select_search").focus(); // #SI - first focus issue solving
      $('.select2-container--default').addClass('inner');
    });
    $('body').on("click", function () {
      $('.select2-container--default').removeClass('inner');
    });

    $(document).click(function () {
      $('.select2-container--focus').keydown(function (event) {
        var keyCode = event.keyCode || event.which;
        if (keyCode == 9) {
          event.preventDefault();
        }
      });
    });
  </script>
  {{-- custom focus Ends here --}}

</body>

</html>
