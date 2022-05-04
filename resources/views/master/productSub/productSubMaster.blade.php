@section('title', '商品サブマスタ')
@section('menu-test1', '商品サブマスタ')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- <title>@yield('title')</title>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
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
  <link rel="icon" href="{{url('img')}}/logoicon.png" type="image/png" id="faviconInage"> --}}

  {{-- Including Common Header Starts Here --}}
  @include('layouts.header')
  {{-- Including Common Header Ends Here--}}

  <style>
    .c-mt-psub {
      margin-top: 146px;

    }

    .c-mb-70 {
      margin-bottom: 70px;
    }

    .datepicker-dropdown {
      z-index: 9999 !important;
    }

    .overflow_cls {
      overflow: hidden !important;
    }

    .c-pl-0 {
      padding-left: 0px !important;
    }

    .largeTable {
      padding-bottom: 10px;
      max-height: 455px;
      overflow: auto;
    }

    .border_none_table td {
      border: 1px solid #29487d !important;
      padding: 4px;
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
      border: 2px solid #ff9900;
      padding: 0px;
    }

    .removeBorder {
      border: none;
      padding: 0px;
    }

    .product_supplier_content1_row,
    .product_supplier_content2_row {
      cursor: pointer;
    }

    #cal_icon1,
    #cal_icon2,
    #cal_icon3,
    #cal_icon4 {
      cursor: pointer;
    }

    .modal-open {
      overflow: hidden;
    }

    .modal {
      overflow: auto !important;
    }

    .m_t {
      margin-top: 7px;
    }

    .button_wrap_right_top {
      width: 40%;
      /*margin: 2%;*/
    }
    .disable {
     pointer-events: none;
     cursor: default;
    }
    .rounded_table_wrap {
      width: 60%;
      /*margin: 2%;*/
    }

    .custom-form .table>tbody>tr>td {
      border: 1px solid lightgray !important;
      /* border: 1px solid #e1e1e1 !important; */
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

      .c-pl-0 {
        padding-left: 15px !important;
      }
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

    .error {
      border: 1px solid red !important;
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

<body>

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

      .footer-wrapper {
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

      .button-responsive-view {
        padding: 10px 0px !important;
      }
    }

    .alert-dismissible  button:focus{
      outline: 0;
    }
  </style>

  {{-- Main Content Starts Here --}}
  @include('master.productSub.mainTableProductSub')
  {{-- Main Content Ends Here --}}

  <script type="text/javascript">
    function resizeInput() {
        $(this).attr('size', $(this).val().length);
      }

      $('input[type="text"]')
        .keyup(resizeInput)
        .each(resizeInput);
  </script>

  {{-- Registration Modal Starts Here --}}
  @include('master.productSub.productSubRegistration')
  {{-- Registration Modal Ends Here --}}

  {{-- Detatils Modal Starts Here --}}
  @include('master.productSub.productSubDetail')
  {{-- Detatils Modal Ends Here --}}

  {{-- Edit Modal Starts Here --}}
  @include('master.productSub.productSubEdit')
  {{-- Edit Modal Ends Here --}}

  {{-- Table Header Settings Modal Starts Here --}}
  @include('master.common.table_settings_modal')
  {{-- Table Header Settings Modal Ends Here --}}

  {{-- New Modal Starts Here --}}
  @include('master.productSub.atarashiPopUp')
  {{-- New Modal Ends Here --}}

  {{-- Print Modal Starts Here --}}
  @include('master.productSub.printModal')
  {{-- Print Modal Ends Here --}}

  {{-- Footer Starts Here --}}
  {{-- @include('layout.footer') --}}
  @include('layout.footer_new')
  {{-- Footer Ends Here --}}


  <script src=" {{ asset('js/jquery-3.4.1.min.js') }}"></script>
  <script src=" {{ asset('js/bootstrap.min.js') }}"></script>
  <script src=" {{ asset('js/select2.min.js') }}"></script>
  <script src=" {{ asset('js/datepicker2.js') }}"></script>
  <script src=" {{ asset('js/datepicker.ja-JP.js') }}"></script>
  
  {{-- common.js link include starts here --}}
  @include('layouts.common_js')
  {{-- common.js link include ends here --}}

  <!-- Hard reload js link starts here -->
  <script type="text/javascript">
    var productSubMasterLink = document.createElement("script");
    productSubMasterLink.type = "text/javascript";
    productSubMasterLink.src = "{{ asset('js/master/productSubMaster.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(productSubMasterLink);
  </script>
  <!-- Hard reload js link ends here -->

  <script>
    $(document).ready(function(){
      $('#openSettingModal').attr('onclick', "showTableSetting('{{route('ProductSubMasterTableSetting',$bango)}}')");
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

  <script>
    // for table header settings lat input to first input focusing
      var level= {{$tantousya->innerlevel}};
      function firstTab(event) {
        if (event.keyCode == 13) {
          $("#product_name").focus();
          event.preventDefault();
        }
      }
  </script>

  <script>
    $(document).on('shown.bs.modal', function(e) {
      $('[autofocus]', e.target).focus();
    });
  </script>

  <script>
    $("textarea").keydown(function(event) {
      if (event.keyCode == 13 && !e.shiftKey) {
        event.preventDefault();
      }
      });
  </script>

  <script type="text/javascript">
    $("#choice_button").click(function () {
      //$("#initial_content").hide();
      $("#product_supplier_content1").hide();
      $("#product_supplier_content2").hide();
      $("#product_supplier_content3").hide();
      if ($(".product_supplier_content1_row").hasClass("add_border")) {
        $(".product_supplier_content1_row").removeClass('add_border');
      }

      if ($(".product_supplier_content2_row").hasClass("add_border")) {
        $(".product_supplier_content2_row").removeClass('add_border');
      }
      if ($(".product_supplier_content3_row").hasClass("add_border")) {
        $(".product_supplier_content3_row").removeClass('add_border');
      }
    });
  </script>

  <script type="text/javascript">
    $(function () {
      $("#show_view_modal").click(function () {
        $("#msg_modal1").modal("show");
      });
    });
  </script>

  <script type="text/javascript">
    $("#productSubButton3").on("click", function () {
      $('.modal-backdrop').remove();
      $('#product_sub_modal3').on('show.bs.modal', function (e) {
        $('body').addClass('overflow_cls');
        $("#product_sub_modal2").modal("hide");
      })
      $('.modal-backdrop').show();
      $('#product_sub_modal3').on('hide.bs.modal', function (e) {
        $('body').removeClass('overflow_cls');
      })
    });
  </script>


{{-- #SI - Calendar Modified Code Starts Here --}}
{{-- Registration Modal --}}
<script type="text/javascript">
  $(function () {
    $('#datepicker1_comShow').datepicker({
      container: '#product_sub_modal1',
      language: 'ja-JP',
      format: 'yyyy-mm-dd',
      autoHide: true,
      zIndex: 2048,
      offset: 36,
      trigger: '#cal_icon_insert1',

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
      document.getElementById("insert_other15").value = formatted_date;
      $('#insert_other15').focus(); //focusing current input on select
      // $(this).focus(); //focusing current input on select
    });

    $('#insert_other15').on('change', function() {
      let inputDateValue = document.getElementById("insert_other15").value;  //getting date value from input
      // console.log(inputDateValue);

      if(inputDateValue.length==8){
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
      container: '#product_sub_modal1',
      language: 'ja-JP',
      format: 'yyyy-mm-dd',
      autoHide: true,
      zIndex: 2048,
      offset: 36,
      trigger: '#cal_icon_insert2',

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
      document.getElementById("insert_other16").value = formatted_date;
      $('#insert_other16').focus(); //focusing current input on select
      // $(this).focus(); //focusing current input on select
    });

    $('#insert_other16').on('change', function() {
      let inputDateValue = document.getElementById("insert_other16").value;  //getting date value from input
      // console.log(inputDateValue);

      if(inputDateValue.length==8){
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
      container: '#product_sub_modal3',
      language: 'ja-JP',
      format: 'yyyy-mm-dd',
      autoHide: true,
      zIndex: 2048,
      offset: 36,
      trigger: '#cal_icon_edit1',

    });
    $('#datepicker1_comShow_edit1').on('change', function(){
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
      document.getElementById("edit_other15_modified").value = formatted_date;
      $('#edit_other15_modified').focus(); //focusing current input on select
      // $(this).focus(); //focusing current input on select
    });

    $('#edit_other15_modified').on('change', function() {
      let inputDateValue = document.getElementById("edit_other15_modified").value;  //getting date value from input
      // console.log(inputDateValue);

      if(inputDateValue.length==8){
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
      container: '#product_sub_modal3',
      language: 'ja-JP',
      format: 'yyyy-mm-dd',
      autoHide: true,
      zIndex: 2048,
      offset: 36,
      trigger: '#cal_icon_edit2',

    });
    $('#datepicker1_comShow_edit2').on('change', function(){
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
      document.getElementById("edit_other16_modified").value = formatted_date;
      $('#edit_other16_modified').focus(); //focusing current input on select
      // $(this).focus(); //focusing current input on select
    });

    $('#edit_other16_modified').on('change', function() {
      let inputDateValue = document.getElementById("edit_other16_modified").value;  //getting date value from input
      // console.log(inputDateValue);

      if(inputDateValue.length==8){
        let slicedYear = inputDateValue.slice(0, 4);
        let slicedMonth = inputDateValue.slice(4, 6) - 1;
        let slicedDay = inputDateValue.slice(6, 8);
        $('#datepicker1_comShow_edit2').datepicker('setDate', new Date(slicedYear, slicedMonth, slicedDay));
      }

    });
  });

</script>
{{-- #SI - Calendar Modified Code Ends Here --}}

<script>
  // Registration Modal
  $('#product_sub_modal1').on('shown.bs.modal', function () {
    $("#insert_other1").focus();
  });

  // Edit Modal
  $('#product_sub_modal3').on('shown.bs.modal', function () {
    $("#edit_other1").focus();
  });

  // Settings Modal
  $('#setting_display_modal').on('shown.bs.modal', function () {
    $("#setting_other2").focus();
  });
</script>

</body>

</html>
