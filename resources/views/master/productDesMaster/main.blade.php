@section('title', '商品説明マスタ')
@section('menu-test1', '商品説明マスタ')
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
  <link rel="stylesheet" type="text/css" href="{{ asset('css/test_modal_styles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/test_nav_new_styles_fixed.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/custom_checkbox_radio.css') }}">
  <link rel="icon" href="{{url('img')}}/logoicon.png" type="image/png" id="faviconInage"> --}}

  {{-- Including Common Header Starts Here --}}
  @include('layouts.header')
  {{-- Including Common Header Ends Here--}}

  <style>
    .c-mt-pd {
      margin-top: 144px;
    }

    .c-mb-70 {
      margin-bottom: 70px;
    }

    .pl-custom-0 {
      padding-left: 0px !important;
    }

    #radiodiv1Pdes,
    #radiodiv2Pdes,
    #radiodiv3Pdes,
    #radiodiv4Pdes,
    #radiodiv5Pdes,
    #radiodiv6Pdes {
      padding-left: 10px !important;
    }

    .pr-custom-0 {
      padding-right: 0px !important;
    }

    .overflow_cls {
      overflow: hidden !important;
    }

    /* .largeTable {
      padding-bottom: 10px;
      height: 455px;
      overflow: auto;
    } */

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

    .m_t {
      margin-top: 7px;

    }

    @media only screen and (max-width: 767px) {

      #radiodiv1Pdes,
      #radiodiv2Pdes,
      #radiodiv3Pdes,
      #radiodiv4Pdes,
      #radiodiv5Pdes,
      #radiodiv6Pdes {
        padding-left: 24px !important;
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

      .pl-custom-0 {
        padding-left: 15px !important;
      }

      .pr-custom-0 {
        padding-right: 15px !important;
      }
    }

    }

    .border_none_table td {
      border: 1px solid #29487d !important;
      padding: 4px;
    }


    .form-control-custom-input {
      border: 1px solid #29487d !important;
      background: white;
      height: 28px !important;
      margin-top: 2px;
      border-radius: 0px !important;
    }

    .form-control-custom-input {
      display: block;
      width: auto;
      padding: 0.375rem 0.75rem;
      font-size: 1rem;
      line-height: 1.5;
      color: #495057;
      background-color: #fff;
      -webkit-background-clip: padding-box;
      background-clip: padding-box;
      border: 1px solid #ced4da;
      -webkit-border-radius: 0.25rem;
      border-radius: 0.25rem;
      -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
      transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
      -o-transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
      transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
      transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    }


    /* #SI - Code starts here */
    .form-group {
      margin-bottom: 0.1rem !important;
    }

    textarea {
      padding: 0px !important;
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

    @media only screen and (max-width: 767px) {
      .header-checkbox {
        margin-left: 0 !important;
      }

      .button-responsive-view {
        padding: 10px 0px !important;
      }
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
  @include('layout.nav_fixed')
  {{-- @include('layout.nav_test') --}}
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

      @media only screen and (max-width: 767px) {
        .largeTable .btn-m-view {
          margin-bottom: 0px;
        }
      }
    }

    .radio-rounded .custom-radio .custom-control-label:before {
      background: #EFEFEF !important;
      border: 1px solid #CDCDCD !important;
      margin-top: -2px;
    }

    .radio-rounded .custom-radio .custom-control-input:checked~.custom-control-label:before,
    .radio-rounded .custom-radio .custom-control-input:checked~.custom-control-label:after {
      background: #3F8CED !important;
      box-shadow: none;
      content: "\f00c";
      font-family: 'FontAwesome';
      color: #fff;
      font-size: 10px;
      text-align: center;
      border: 1px solid #3F8CED !important;
      margin-top: -2px;
    }

    .radio-rounded .custom-radio .custom-control-label {
      cursor: pointer;
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

      .crm-m {
        margin-left: 20px !important;
        margin-right: 5px !important;
      }
    }
  </style>

  {{-- Main Content Starts Here --}}
  @include('master.productDesMaster.main_content')
  {{-- Main Content Ends Here --}}

  {{-- Registration Modal Starts Here --}}
  @include('master.productDesMaster.registration_modal')
  {{-- Registration Modal Ends Here --}}

  {{-- Detatils Modal Starts Here --}}
  @include('master.productDesMaster.view_modal')
  {{-- Detatils Modal Ends Here --}}

  {{-- Edit Modal Starts Here --}}
  @include('master.productDesMaster.edit_modal')
  {{-- Edit Modal Ends Here --}}

  {{-- Table Header Settings Modal Starts Here --}}
  @include('master.common.table_settings_modal')
  {{-- Table Header Settings Modal Ends Here --}}

  {{-- Footer Starts Here --}}
  @include('layout.footer_new')
  {{-- Footer Ends Here --}}


  <link href="//ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css" rel="stylesheet" type="text/css">
  <script src=" {{ asset('js/jquery-3.4.1.min.js') }}"></script>
  <script src=" {{ asset('js/bootstrap.min.js') }}"></script>
  <script src=" {{ asset('js/select2.min.js') }}"></script>
  
  <!-- Hard reload js link starts here -->
  <script type="text/javascript">
    var productDescriptionLink = document.createElement("script");
    productDescriptionLink.type = "text/javascript";
    productDescriptionLink.src = "{{ asset('js/master/productDescription.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(productDescriptionLink);
  </script>
  <!-- Hard reload js link ends here -->

 {{-- common.js link include starts here --}}
 @include('layouts.common_js')
 {{-- common.js link include ends here --}}

  <script>
    $(document).ready(function () {
      $('#openSettingModal').attr('onclick', "showTableSetting('{{route('productDescriptionTableSetting',$bango)}}')");
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
    function lastTab1_office(event) {
      if (event.keyCode == 13) {
        document.getElementById("product_description_CD").focus();
        event.preventDefault();
      }
    }
  </script>


  <script type="text/javascript">
    $("#product_des_Button3").on("click", function () {
      $('.modal-backdrop').remove();
      $('#editModal').on('show.bs.modal', function (e) {
        $('body').addClass('overflow_cls');
        $("#detailsModal").modal("hide");
      })
      $('.modal-backdrop').show();
      $('#editModal').on('hide.bs.modal', function (e) {
        $('body').removeClass('overflow_cls');
      })
    });
  </script>

  <script type="text/javascript">
    // Focus on modal open
    $(document).on('shown.bs.modal', function (e) {
      if ('a[data-toggle="tab"]') {
        $('[autofocus]', e.target).focus();
      }
    });
  </script>

  <script>
    $(".custom-file1").on("change", function () {
      var fileName2 = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label2").addClass("selected").html(fileName2);
      $("#input_file_prdes1").val(fileName2);
    });
  </script>

</body>

</html>
