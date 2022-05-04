@section('title', '名称マスタ')
@section('menu-test1', '名称マスタ')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- <title>@yield('title')</title>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <link rel="icon" href="{{url('img')}}/logoicon.png">
  <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
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
    .c-mt-n {
      margin-top: 147px;
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

    /* Table Header Settings Border Removing */
    .custom-form .table>tbody>tr>td {
      border: 1px solid lightgray !important;
      color: #17252A;
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

    .m_t {
      margin-top: 7px;

    }

    @media only screen and (max-width: 767px) {
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
  </style>

  {{-- Main Content Starts Here --}}
  @include('master.nameMaster.nameMainTable')
  {{-- Main Content Ends Here --}}

  {{-- Registration Modal Starts Here --}}
  @include('master.nameMaster.nameRegistrationModal')
  {{-- Registration Modal Ends Here --}}

  {{-- Detatils Modal Starts Here --}}
  @include('master.nameMaster.nameDetailModal')
  {{-- Detatils Modal Ends Here --}}

  {{-- Edit Modal Starts Here --}}
  @include('master.nameMaster.nameEditModal')
  {{-- Edit Modal Ends Here --}}

  {{-- Table Header Settings Modal Starts Here --}}
  @include('master.common.table_settings_modal')
  {{-- Table Header Settings Modal Ends Here --}}

  {{-- Print Modal Starts Here --}}
  @include('master.seqNumberingMaster.printModal')
  {{-- Print Modal Ends Here --}}

  {{-- Footer Starts Here --}}
  @include('layout.footer_new')
  {{-- Footer Ends Here --}}



  <link href="//ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css" rel="stylesheet" type="text/css">
  <script src=" {{ asset('js/jquery-3.4.1.min.js') }}"></script>
  <script src=" {{ asset('js/bootstrap.min.js') }}"></script>
  {{-- <script src=" {{ asset('js/common.js') }}"></script> --}}
  {{-- <script src=" {{ asset('js/master/nameMaster.js') }}"></script> --}}
  <script src=" {{ asset('js/select2.min.js') }}"></script>

  {{-- common.js link include starts here --}}
  @include('layouts.common_js')
  {{-- common.js link include ends here --}}

  <!-- Hard reload js link starts here -->
  <script type="text/javascript">
    var nameMasterLink = document.createElement("script");
    nameMasterLink.type = "text/javascript";
    nameMasterLink.src = "{{ asset('js/master/nameMaster.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(nameMasterLink);
  </script>
  <!-- Hard reload js link ends here -->


  {{-- Table Header Settings Calling Starts Here   --}}
  <script>
    $(document).ready(function(){
      $('#openSettingModal').attr('onclick', "showTableSetting('{{route('nameMasterTableSetting',$bango)}}')");
    });
  </script>
  <script>
    $(document).ready(function(){
      $('#clearTableSetting').attr('onclick', " clearTableSetting('{{route('clearNameSetting',$bango)}}')");
    });
  </script>
  {{-- Table Header Settings Calling Ends Here --}}

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
    $(document).on('shown.bs.modal', function (e) {
      $('[autofocus]', e.target).focus();
    });
  </script>

  <script>
    // for table header settings lat input to first input focusing
    function firstTab(event) {
      if (event.keyCode == 13) {
        $("#th2").focus();
        event.preventDefault();
        // alert('second event works');
      }
    }
  </script>

  <script type="text/javascript">
    function openModalDetailCPM() {
      $("#view_modal").modal('show');
      $('.modal-backdrop').show();
    }
  </script>

  <script type="text/javascript">
    $("#nameButton3").on("click", function () {
      $('.modal-backdrop').remove();
      $('#name_modal3').on('show.bs.modal', function (e) {
        $('body').addClass('overflow_cls');
        $("#name_modal2").modal("hide");
      })
      $('.modal-backdrop').show();
      $('#name_modal3').on('hide.bs.modal', function (e) {
        $('body').removeClass('overflow_cls');
      })
    });
  </script>

  <script>
    // Registration Modal
  $('#name_modal1').on('shown.bs.modal', function () {
    $("#insert_category1").focus();
  });

  // Edit Modal
  $('#name_modal3').on('shown.bs.modal', function () {
    $("#edit_category1").focus();
  });

  // Settings Modal
  $('#setting_display_modal').on('shown.bs.modal', function () {
    $("#setting_category2").focus();
  });
  </script>

</body>

</html>
