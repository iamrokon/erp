{{-- @section('menu-test1', 'SEQ番号付番マスタ') --}}
@section('title', 'SEQ番号付番マスタ')
@section('menu-test1', 'SEQ番号付番マスタ')
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
  <link rel="icon" href="{{url('img')}}/logoicon.png" type="image/png" id="faviconInage"> --}}

  {{-- Including Common Header Starts Here --}}
  @include('layouts.header')
  {{-- Including Common Header Ends Here--}}

  <style>
    .tag-line {
      display: none;
    }

    .c-mt-seq {
      margin-top: 147px;
    }

    .c-mb-70 {
      margin-bottom: 70px;
    }

    .overflow_cls {
      overflow: hidden !important;
    }

    .mt_d {
      margin-top: 7px;
    }

    /* .largeTable {
      padding-bottom: 10px;
      height: 455px;
      overflow: auto;
    } */

    .custom-form .table>tbody>tr>td {
      border: 1px solid lightgray !important;
      /* border: 1px solid #e1e1e1 !important; */
      color: #17252A;
    }

    @media only screen and (max-width: 767px) {

      .nav_mview {
        margin-bottom:0px !important;
      }

      .pagi-input-field {
        height: 36px !important;
      }

    }

    .border_none_table td {
      border: 1px solid #29487d !important;
      padding: 4px;
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

      .footer-wrapper {
        min-width: 0px;
      }

      @media only screen and (max-width: 767px) {
        .largeTable .btn-m-view {
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
  @include('master.seqNumberingMaster.seqNumberingMainContent')
  {{-- Main Content Ends Here --}}

  {{-- Registration Modal Starts Here --}}
  @include('master.seqNumberingMaster.seqNumberingRegistrationModal')
  {{-- Registration Modal Ends Here --}}

  {{-- Detatils Modal Starts Here --}}
  @include('master.seqNumberingMaster.seqNumberingDetailViewModal')
  {{-- Detatils Modal Ends Here --}}

  {{-- Edit Modal Starts Here --}}
  @include('master.seqNumberingMaster.seqNumberingEditModal')
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
  <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/select2.min.js') }}"></script>
  
  <!-- Hard reload js link starts here -->
  <script type="text/javascript">
    var seqNumberingMasterLink = document.createElement("script");
    seqNumberingMasterLink.type = "text/javascript";
    seqNumberingMasterLink.src = "{{ asset('js/master/seqNumberingMaster.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(seqNumberingMasterLink);
  </script>
  <!-- Hard reload js link ends here -->

  {{-- common.js link include starts here --}}
  @include('layouts.common_js')
  {{-- common.js link include ends here --}}

  <script>
    $(document).ready(function () {
      $('#openSettingModal').attr('onclick', "showTableSetting('{{route('seqNumberingMasterTableSetting',$bango)}}')");
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
    function firstTab(event) {
      if (event.keyCode == 13) {
        $("#numchk").focus();
        event.preventDefault();
      }
    }
  </script>

  <script>
    $(document).on('shown.bs.modal', function(e) {
      $('[autofocus]', e.target).focus();
    });
  </script>

  <script type="text/javascript">
    function openModalDetailCPM() {
      $("#view_modal").modal('show');
      $('.modal-backdrop').show();
    }
  </script>

  <script type="text/javascript">
    $("#seq_Button3").on("click", function() {
      $('.modal-backdrop').remove();
      $('#seq_numbering_edit_modal').on('show.bs.modal', function(e) {
        $('body').addClass('overflow_cls');
        $("#seqNumberingDetailModal").modal("hide");
      })
      $('.modal-backdrop').show();
      $('#seq_numbering_edit_modal').on('hide.bs.modal', function(e) {
        $('body').removeClass('overflow_cls');
        })
      });
  </script>

  <script>
    // Registration Modal
    $('#registrationModal').on('shown.bs.modal', function () {
      $("#reg_kokyakusyouhinbango").focus();
    });

    // Edit Modal
    $('#seq_numbering_edit_modal').on('shown.bs.modal', function () {
      $("#edit_kokyakusyouhinbango").focus();
    });

    // Settings Modal
    $('#setting_display_modal').on('shown.bs.modal', function () {
      $("#setting_orderbango").focus();
    });
  </script>

</body>

</html>
