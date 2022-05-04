@section('title', '商品マスタ')
@section('menu-test1', '商品マスタ')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <link rel="icon" href="{{url('img')}}/logoicon.png">
  <title>@yield('title')</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
  <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/navbar_styles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/login_styles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/modal_styles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/product_styles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/pagination_styles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/datepicker.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/test_styles_fixed.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/test_nav_new_styles_fixed.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/custom_checkbox_radio.css') }}"> --}}

  {{-- Including Common Header Starts Here --}}
  @include('layouts.header')
  {{-- Including Common Header Ends Here--}}

  <style>
    .tag-line {
      display: none;
    }

    .c-mt-p {
      margin-top: 22px;
    }

    .c-mb-70 {
      margin-bottom: 70px;
    }

    /* #SI - code starts here */
    textarea {
      padding: 0 !important;
    }

    /* #SI - code ends here */

    .overflow_cls {
      overflow: hidden !important;
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

    .add_border {
      background: #AEC7E6;
      padding: 0px;
    }


    .removeBorder {
      border: none;
      padding: 0px;
    }

    .show_office_master_info,
    .show_personal_master_info,
    .show_content_last {
      cursor: pointer;

    }

    .largeTable {
      padding-bottom: 10px;
      max-height: 455px;
      overflow: auto;
    }

    #cal_icon1,
    #cal_icon2,
    #cal_icon3,
    #cal_icon4 {
      cursor: pointer;
    }

    .m_t {
      margin-top: 7px;

    }

    .border_none_table td {
      border: 1px solid #29487d !important;
      padding: 4px;
    }

    .button_wrap_right_top {
      width: 40%;
    }

    .rounded_table_wrap {
      width: 60%;
    }

    .modal {
      overflow: auto !important;

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

    @media only screen and (min-width: 1400px) {
      .largeTable {
        padding-bottom: 10px;
        height: 688px;
        overflow: auto;
      }

      .left_right_margin {
        margin-bottom: : 0px;

      }
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

      .ml-m {
        margin-left: -10px;
        ;
      }
    }

    .border_none_table td {
      border: 1px solid #29487d !important;
      padding: 4px;
    }

    .ui-datepicker {
      width: 314px !important;
      padding: .2em .2em 0;
    }

    .ui-datepicker td a {
      text-align: center !important;
    }

    .ui-datepicker td {
      border: 0;
      padding: 1px;
      width: 64px !important;
    }

    /* #SI - Code starts here */
    /* Table header design */
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
        .largeTable . {
          margin-bottom: 0px;
        }

        .custom-control {
          margin-left: 13px !important;
        }
      }
    }

    @media only screen and (max-width: 767px) {
      .header-checkbox {
        margin-left: 0px !important;
      }

      .button-responsive-view {
        padding: 10px 0px !important;
      }
    }

    .custom-form .table>tbody>tr>td {
      border: 1px solid lightgray !important;
      /* border: 1px solid #e1e1e1 !important; */
      color: #17252A;
    }
  </style>

  {{-- Main Content Starts Here --}}
  @include('master.productMaster.productMainContent')
  {{-- Main Content Ends Here --}}

  {{-- Registration Modal Starts Here --}}
  @include('master.productMaster.productRegistrationModal')
  {{-- Registration Modal Ends Here --}}

  {{-- Detatils Modal Starts Here --}}
  @include('master.productMaster.productDetailViewModal')
  {{-- Detatils Modal Ends Here --}}

  {{-- Edit Modal Starts Here --}}
  @include('master.productMaster.productEditModal')
  {{-- Edit Modal Ends Here --}}

  {{-- Table Header Settings Modal Starts Here --}}
  @include('master.common.table_settings_modal')
  {{-- Table Header Settings Modal Ends Here --}}

  {{-- Product Atarashi Modal Starts Here --}}
  @include('master.productMaster.productAtarashiModal')
  {{-- Product Atarashi Modal Starts Here --}}

  {{-- Product Atarashi Modal 2 Starts Here --}}
  @include('master.productMaster.productAtarashiModal2')
  {{-- Product Atarashi Modal 2 Starts Here --}}

  {{-- Print Modal Starts Here --}}
  @include('master.productMaster.printModal')
  {{-- Print Modal Ends Here --}}

  {{-- Footer Starts Here --}}
  {{-- @include('layout.footer') --}}
  @include('layout.footer_new')
  {{-- Footer Ends Here --}}

  <link href="//ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css" rel="stylesheet" type="text/css">
  <script src=" {{ asset('js/jquery-3.4.1.min.js') }}"></script>
  <script src=" {{ asset('js/bootstrap.min.js') }}"></script>
  {{-- <script src=" {{ asset('js/master/productMaster.js') }}"></script> --}}
  {{-- <script src=" {{ asset('js/common.js') }}"></script> --}}
  <script src=" {{ asset('js/select2.min.js') }}"></script>
  <script src=" {{ asset('js/datepicker.js') }}"></script>
  <script src=" {{ asset('js/datepicker.ja-JP.js') }}"></script>

  <!-- Hard reload js link starts here -->
  <script type="text/javascript">
    var productMasterLink = document.createElement("script");
    productMasterLink.type = "text/javascript";
    productMasterLink.src = "{{ asset('js/master/productMaster.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(productMasterLink);
  </script>
  <!-- Hard reload js link ends here -->

  {{-- common.js link include starts here --}}
   @include('layouts.common_js')
  {{-- common.js link include ends here --}}

  <script>
    $(document).ready(function () {
      $('#openSettingModal').attr('onclick', "showTableSetting('{{route('productMasterTableSetting',$bango)}}')");
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


  <script type="text/javascript">

    function openModalDetail() {
      $("#product_code_modal2").modal('show');
      $('.modal-backdrop').show();
    }

    function openModalPopup1() {
      $('.show_office_master_info').removeClass('add_border');
      document.getElementById('choice_buttonApi').disabled = true;
      $("#office_content_div_last").hide();
      $("#office_master_content_div").hide();
      $("#personal_master_content_div").hide();
      $("#office_modal4").modal('show');
    }

    function openModalPopup2() {
      $('.show_office_master_info').removeClass('add_border');
      document.getElementById('choice_buttonApi2').disabled = true;
      $("#product_content_div_last2").hide();
      $("#product_master_content_div2").hide();
      $("#office_master_content_div2").hide();
      $("#product_modal42").modal('show');
    }

  </script>

  <script type="text/javascript">
    $("#productButton3").on("click", function () {
      $('.modal-backdrop').remove();
      $('#product_code_modal3').on('show.bs.modal', function (e) {
        $('body').addClass('overflow_cls');
        $("#product_code_modal2").modal("hide");
      })
      $('#product_code_modal3').on('hide.bs.modal', function (e) {
        $('body').removeClass('overflow_cls');
      })
    });
  </script>

  <script type="text/javascript">
    $("#choice_button_product").click(function () {
      $("#office_master_content_div").hide();
      $("#personal_master_content_div").hide();
      $("#office_content_div_last").hide();
      $('body').addClass('overflow_cls');
      if ($(".show_office_master_info").hasClass("add_border")) {
        $(".show_office_master_info").addeClass('add_border');
      }

      if ($(".show_personal_master_info").hasClass("add_border")) {
        $(".show_personal_master_info").removeClass('add_border');
      }

      if ($(".show_content_last").hasClass("add_border")) {
        $(".show_content_last").removeClass('add_border');
      }
    });

  </script>

  {{-- #SI - Calendar Code Starts Here --}}
  {{-- Registration Modal --}}
  <script type="text/javascript">
    $(function () {
      $('#datepicker1_comShow').datepicker({
        container: '#registrationModal',
        language: 'ja-JP',
        format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,
        offset: -26,
        trigger: '#cal_icon1_p',

      });
      $('#datepicker1_comShow').on('change', function () {
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
        document.getElementById("reg_synchrosyouhinbango").value = formatted_date;
        $('#reg_synchrosyouhinbango').focus(); //focusing current input on select
        // $(this).focus(); //focusing current input on select
      });

      $('#reg_synchrosyouhinbango').on('change', function () {
        let inputDateValue = document.getElementById("reg_synchrosyouhinbango").value;  //getting date value from input
        // console.log(inputDateValue);

        if (inputDateValue.length == 8) {
          let slicedYear = inputDateValue.slice(0, 4);
          let slicedMonth = inputDateValue.slice(4, 6) - 1;
          let slicedDay = inputDateValue.slice(6, 8);
          $('#datepicker1_comShow').datepicker('setDate', new Date(slicedYear, slicedMonth, slicedDay));
        }

      });
    });

  </script>


  <script type="text/javascript">
    $(function () {
      $('#datepicker2_comShow').datepicker({
        container: '#registrationModal',
        language: 'ja-JP',
        format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,
        offset: -26,
        trigger: '#cal_icon2_p',

      });
      $('#datepicker2_comShow').on('change', function () {
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
        document.getElementById("reg_endtime").value = formatted_date;
        $('#reg_endtime').focus(); //focusing current input on select
        // $(this).focus(); //focusing current input on select
      });

      $('#reg_endtime').on('change', function () {
        let inputDateValue = document.getElementById("reg_endtime").value;  //getting date value from input
        // console.log(inputDateValue);

        if (inputDateValue.length == 8) {
          let slicedYear = inputDateValue.slice(0, 4);
          let slicedMonth = inputDateValue.slice(4, 6) - 1;
          let slicedDay = inputDateValue.slice(6, 8);
          $('#datepicker2_comShow').datepicker('setDate', new Date(slicedYear, slicedMonth, slicedDay));
        }

      });
    });

  </script>


  {{-- Edit Modal --}}
  <script type="text/javascript">
    $(function () {
      $('#datepicker1_comShow_edit1').datepicker({
        container: '#product_code_modal3',
        language: 'ja-JP',
        format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,
        offset: -26,
        trigger: '#cal_icon3_p',

      });
      $('#datepicker1_comShow_edit1').on('change', function () {
        let datevalue = document.getElementById("datepicker1_comShow_edit1").value;  //getting date value from calendar
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
        document.getElementById("edit_synchrosyouhinbango").value = formatted_date;
        $('#edit_synchrosyouhinbango').focus(); //focusing current input on select
        // $(this).focus(); //focusing current input on select
      });

      $('#edit_synchrosyouhinbango').on('change', function () {
        let inputDateValue = document.getElementById("edit_synchrosyouhinbango").value;  //getting date value from input
        // console.log(inputDateValue);

        if (inputDateValue.length == 8) {
          let slicedYear = inputDateValue.slice(0, 4);
          let slicedMonth = inputDateValue.slice(4, 6) - 1;
          let slicedDay = inputDateValue.slice(6, 8);
          $('#datepicker1_comShow_edit1').datepicker('setDate', new Date(slicedYear, slicedMonth, slicedDay));
        }

      });
    });

  </script>

  <script type="text/javascript">
    $(function () {
      $('#datepicker1_comShow_edit2').datepicker({
        container: '#product_code_modal3',
        language: 'ja-JP',
        format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,
        offset: -26,
        trigger: '#cal_icon4_p',

      });
      $('#datepicker1_comShow_edit2').on('change', function () {
        let datevalue = document.getElementById("datepicker1_comShow_edit2").value;  //getting date value from calendar
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
        document.getElementById("edit_endtime").value = formatted_date;
        $('#edit_endtime').focus(); //focusing current input on select
        // $(this).focus(); //focusing current input on select
      });

      $('#edit_endtime').on('change', function () {
        let inputDateValue = document.getElementById("edit_endtime").value;  //getting date value from input
        // console.log(inputDateValue);

        if (inputDateValue.length == 8) {
          let slicedYear = inputDateValue.slice(0, 4);
          let slicedMonth = inputDateValue.slice(4, 6) - 1;
          let slicedDay = inputDateValue.slice(6, 8);
          $('#datepicker1_comShow_edit2').datepicker('setDate', new Date(slicedYear, slicedMonth, slicedDay));
        }

      });
    });

  </script>

  {{-- #SI - Calendar Code Ends Here --}}


  <script>
    function lastTab(event) {
      if (event.keyCode == 13) {
        document.getElementById("check_name").focus();
        event.preventDefault();
      }
    }
  </script>

  <!-- Focus input while opening modal starts -->
  <script>
    // Registration Modal
    $('#registrationModal').on('shown.bs.modal', function () {
      $("#reg_kokyakusyouhinbango").focus();
    });

    // Edit Modal
    $('#product_code_modal3').on('shown.bs.modal', function () {
      $("#edit_kokyakusyouhinbango").focus();
    });

    // Settings Modal
    $('#setting_display_modal').on('shown.bs.modal', function () {
      $("#setting_name").focus();
    });

  </script>
  <!-- Focus input while opening modal ends -->

  <!-- Border script starts here -->
  <script>
    function removeBorder() {
      $('.show_office_master_info').removeClass('add_border');
      $('.show_personal_master_info').removeClass('add_border');
      $('.show_content_last').removeClass('add_border');
    }

    $(function () {
      $('.show_office_master_info').click(function (event) {
        $('.show_office_master_info').not(this).removeClass('add_border');
        $(this).addClass('add_border');
        $("#office_master_content_div").show();
      });
    });

    $(function () {
      $(document).on('click', '.show_personal_master_info', function () {
        $('.show_personal_master_info').not(this).removeClass('add_border');
        $(this).addClass('add_border');
        //$("#personal_master_content_div").show();
      });
    });

    $(function () {
      $(document).on('click', '.show_content_last', function () {
        $('.show_content_last').not(this).removeClass('add_border');
        $(this).addClass('add_border');
        //$("#office_content_div_last").show();
      });

    });

    $(function () {
      $(document).on('click', '.show_personal_master_info2', function () {
        $('.show_personal_master_info2').not(this).removeClass('add_border');
        $(this).addClass('add_border');
        //$("#personal_master_content_div").show();
      });
    });

    $(function () {
      $(document).on('click', '.show_content_last2', function () {
        $('.show_content_last2').not(this).removeClass('add_border');
        $(this).addClass('add_border');
        //$("#office_content_div_last").show();
      });

    });


    // Modal first focus....
    $(document).on('shown.bs.modal', function(e) {
      $('[autofocus]', e.target).focus();
    });

  </script>
  <!-- Border script ends here -->

</body>

</html>
