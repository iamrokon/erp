@section('title', '社員マスタ')
@section('menu-test1', '社員マスタ')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
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
  <link rel="stylesheet" type="text/css" href="{{ asset('css/custom_checkbox_radio.css') }}"> --}}

  {{-- Including Common Header Starts Here --}}
  @include('layouts.header')
  {{-- Including Common Header Ends Here--}}

  <style>
      body{
          pointer-events: none;
      }
    .c-mt-emp {
      margin-top: 144px;
    }

    .c-mb-70 {
      margin-bottom: 70px;
    }

    .overflow_cls {
      overflow: hidden !important;
    }

    /* .largeTable {
      padding-bottom: 10px;
      height: 455px;
      overflow: auto;
    } */

    .mt_d {
      margin-top: 7px;
    }

    .modal-open {
      overflow: hidden;
    }

    .outer {
      padding-left: 12px;
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

    .tbl_emp1 td {
      border: none !important;
    }

    .modal {
      overflow: auto !important;
    }

    .tbl_emp1 td:first-child {
      border: none !important;
    }

    @media only screen and (min-width: 1400px) {
      /* .largeTable {
        padding-bottom: 10px;
        height: 688px;
        overflow: auto;
      } */

      .left_right_margin {
        margin-bottom: : 0px;
      }
    }

    @media only screen and (max-width: 768px) {}


    @media only screen and (max-width: 767px) {
      .pl-m-15 {
        padding-left: 15px;
      }

      .pr-m-15 {
        padding-right: 15px;
      }

      .modal {
        padding: 0 !important;
      }

      .modal-open .modal {
        overflow-x: hidden;
        overflow-y: auto;
      }

      .outer {

        padding-left: 0px !important;
      }

      .rounded_table_wrap {
        width: 50%;
        padding-left: 15px !important;
      }
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

    .custom-arrow select::-ms-expand {
      display: none;
    }

    .custom-arrow select {
      -webkit-appearance: none;
    }

    /* Table Header Settings Border Remove */
    .custom-form .table>tbody>tr>td {
      border: 1px solid #e1e1e1 !important;
      color: #17252A;
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


</head>


<body style="">

  {{-- Navbar Starts Here --}}
  {{-- @include('layout.nav_test') --}}
  @include('layout.nav_fixed')
  {{-- Navbar Ends Here --}}

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

      @media only screen and (max-width: 767px) {
        .largeTable . {
          margin-bottom: 0px;
        }
      }
    }

    @media only screen and (max-width: 767px) {
      .header-checkbox {
        margin-left: 0 !important;
      }

      .button-responsive-view {
        padding: 10px 0px !important;
      }
    }

    @media only screen and (max-width: 992px) {
      .cpl-m {
        padding-left: 15px !important;
      }
    }
  </style>

  {{-- Main Content Starts Here --}}
  @include('master.employeemaster.employeeMainContent')
  {{-- Main Content Ends Here --}}

  {{-- Registration Modal Starts Here --}}
  @include('master.employeemaster.employeeRegistrationModal')
  {{-- Registration Modal Ends Here --}}

  {{-- Detatils Modal Starts Here --}}
  @include('master.employeemaster.employeeDetailViewModal')
  {{-- Detatils Modal Ends Here --}}

  {{-- Edit Modal Starts Here --}}
  @include('master.employeemaster.employeeEditModal')
  {{-- Edit Modal Ends Here --}}

  {{-- Table Header Settings Modal Starts Here --}}
  @include('master.common.table_settings_modal')
  {{-- Table Header Settings Modal Ends Here --}}

  {{-- Print Modal Starts Here --}}
  @include('master.employeemaster.printModal')
  {{-- Print Modal Ends Here --}}

  {{-- Footer Starts Here --}}
  {{-- @include('layout.footer') --}}
  @include('layout.footer_new')
  {{-- Footer Ends Here --}}


  <link href="//ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css" rel="stylesheet" type="text/css">
  <script src=" {{ asset('js/jquery-3.4.1.min.js') }}"></script>
  <script src=" {{ asset('js/bootstrap.min.js') }}"></script>
  {{-- <script src=" {{ asset('js/master/employeeMaster.js') }}"></script> --}}
  {{-- <script src=" {{ asset('js/common.js') }}"></script> --}}
  <script src=" {{ asset('js/select2.min.js') }}"></script>
  <script src=" {{ asset('js/datepicker.js') }}"></script>
  <script src=" {{ asset('js/datepicker.ja-JP.js') }}"></script>
  <script src=" {{ asset('js/pdf.js') }}" type="text/javascript"></script>
  <script src=" {{ asset('js/pdf.worker.js') }}" type="text/javascript"></script>
  
  <!-- Hard reload js link starts here -->
  <script type="text/javascript">
    var customerProductMasterLink = document.createElement("script");
      customerProductMasterLink.type = "text/javascript";
      customerProductMasterLink.src = "{{ asset('js/master/employeeMaster.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(customerProductMasterLink);
  </script>
  <!-- Hard reload js link ends here -->

  {{-- common.js link include starts here --}}
  @include('layouts.common_js')
  {{-- common.js link include ends here --}}

  <script>
    $(document).ready(function () {
      $('#openSettingModal').attr('onclick', "showTableSetting('{{route('employeeMasterTableSetting',$bango)}}')");
    });
  </script>

  {{-- Knockout - Enter to New Input Starts Here --}}
  @include('master.common.knockout')
  {{-- Knockout - Enter to New Input Ends Here --}}

  {{-- Table Header Settings - Check/Uncheck All Checkbox Starts Here --}}
  {{-- @include('master.common.check_uncheck_all') --}}
  {{-- Table Header Settings - Check/Uncheck All Checkbox Ends Here --}}

  {{-- Button Hover Message Starts Here --}}
  @include('master.common.hover_message')
  {{-- Button Hover Message Ends Here --}}

  {{-- Table Column Selection Starts Here --}}
  @include('master.common.table_column_selection')
  {{-- Table Column Selection Ends Here --}}

  <script>
    $(document).on('shown.bs.modal', function (e) {
      $('[autofocus]', e.target).focus();
    });
  </script>

  <script>
    function lastTab(event) {
      if (event.keyCode == 13) {
        document.getElementById("check_name").focus();
        event.preventDefault();
      }
    }
  </script>

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

  {{-- <script type="text/javascript">
    $("#empButton3").on("click", function () {

      // $('body').removeClass('modal-open');
      //$('body').addClass('overflow_cls');
      $('.modal-backdrop').remove();
      $('#employee_modal3').on('show.bs.modal', function (e) {
        $('body').addClass('overflow_cls');
        $("#employee_modal2").modal("hide");
      })
      $('.modal-backdrop').show();
      $('#employee_modal3').on('hide.bs.modal', function (e) {
        $('body').removeClass('overflow_cls');
      })


    });
  </script>

  <script>
    $(".custom-file-input1").on("change", function () {
      var fileName1 = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label1").addClass("selected").html(fileName2);
      $("#input_file1").val(fileName1);
    });
  </script>
  <script>
    $(".custom-file-input2").on("change", function () {
      var fileName2 = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label2").addClass("selected").html(fileName2);
      $("#input_file2").val(fileName2);
    });
  </script> --}}


  <script>
    document.querySelector("html").classList.add('js');

    var fileInput = document.querySelector(".input-file1"),
      button = document.querySelector(".input-file-trigger1"),
      the_return = document.querySelector(".file-return1");

    function uploadAction() {
      var fileValue = document.getElementById("my-file").value.split("\\");
      var fileName = fileValue[fileValue.length - 1].split(".");
      var fileName2 = fileName[0].match(/(.|[\r\n]){1,13}/g);
      fileName2[0] = fileName2[0] + "." + fileName[fileName.length - 1]
      console.log(fileName2[0]);

      document.getElementById('file-name-show_emp1').innerHTML = fileName2[0];
    }
  </script>

  <script>
    document.querySelector("html").classList.add('js');

    var fileInput = document.querySelector(".input-file1"),
      button = document.querySelector(".input-file-trigger1"),
      the_return = document.querySelector(".file-return1");

    function uploadAction2() {
      var fileValue = document.getElementById("my-file2").value.split("\\");
      var fileName = fileValue[fileValue.length - 1].split(".");
      var fileName2 = fileName[0].match(/(.|[\r\n]){1,13}/g);
      fileName2[0] = fileName2[0] + "." + fileName[fileName.length - 1]
      console.log(fileName2[0]);
      document.getElementById('file-name-show_emp2').innerHTML = fileName2[0];
    }
  </script>

</body>

</html>
