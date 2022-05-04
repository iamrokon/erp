@section('title', '入金→会計データ作成')
@section('menu-test1', 'ホーム >')
@section('menu-test3', ' 売上請求 >')
@section('menu-test5', '入金→会計データ作成')
@section('tag-test', 'ここにはガイドの文章が入ります。')

<!DOCTYPE html>
<html lang="ja">

<head>

  {{-- Including Common Header Starts Here --}}
  @include('layouts.header')
  {{-- Including Common Header Ends Here--}}

  {{-- Common Style Starts Here --}}
  @include('sales.DepositAccountingDataCreation.styles')
  {{-- Common Style Ends Here --}}

</head>

<body id="body" class="common-nav" style="overflow-x:visible;">
  <section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      <div class="content-head-section1">
        <div class="container position-relative">

          {{-- Success Message Starts Here --}}
          <div class="row success-msg-box" id="successMessage">
            <div class="col-12 pl-0 pr-0 ml-3">
              <div class="alert alert-primary alert-dismissible mb-0">
                <button type="button" class="close dismissAlertMessage"  autofocus onclick="$('#successMessage').css('display','none');$('#datepicker2_oen').focus();">&times;</button>
                <strong>正常に終了しました。</strong>
              </div>
            </div>
          </div>
          {{-- Success Message Ends Here --}}

          {{-- Error Message Starts Here --}}
          <div id="error_data" class="common_error"></div>
          {{-- Error Message Ends Here --}}

          <div class="inner-top-content">
            <form id="csvForm" method="GET" action="{{ route('depositAccountingDataDownloadCSV') }}">
              <input type="hidden" id="userId" name="userId" value="{{$bango}}">
              @csrf
              <div class="row deposit-data-creation">
                <div class="col-12">
                  <div class="row" style="padding-top: 0px;">
                    <div class="col-6">
                      <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                        <tbody>
                          <tr>
                            <td
                              style="border: none!important;text-align: left;color: black;width: 115px !important;padding-left:0px !important;">
                              <div class="line-icon-box float-left mr-3"></div>
                              入金日
                            </td>
                            <td style="border: none!important;width: 151px;">
                              <div class="input-group">
                                <input type="text" id="datepicker2_oen" maxlength="8"
                                  oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                  onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                  class="form-control input_field datepicker2_oen" autocomplete="off" name="date_start"
                                  placeholder="年/月/日" style="width: 96px!important;">
                                <input id="datepicker2_comShow" type="hidden">
                              </div>
                            </td>
                            <td style="width: 30px!important;border:0!important;text-align: center;">
                              ～
                            <td style="border: none!important;width: 151px;">
                              <div class="input-group">
                                <input type="text" id="datepicker1_oen" maxlength="8"
                                  oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                  onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                  class="form-control input_field datepicker1_oen" autocomplete="off" name="date_end"
                                  placeholder="年/月/日" style="width: 96px!important;">
                                <input id="datepicker1_comShow" type="hidden">
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mb-1">
                <div class="col-6">
                  <div class="radio-rounded custom-table-oh d-inline-block">
                    <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                      <tbody>
                        <tr>
                          <td
                            style="padding-left:0px !important;border: none!important;text-align: left;color: black;width: 115px !important;">
                            <div class="line-icon-box float-left mr-3"></div>
                            整理仕訳区分
                          </td>
                          <td style="border: none!important;width: 65px;">
                            <div class="custom-control custom-radio custom-control-inline"
                              style="margin-left: -7px !important;margin-top:6px !important;">
                              <input type="radio" class="custom-control-input" id="customRadio" name="sort_method"
                                value="normal" checked="">
                              <label class="custom-control-label" for="customRadio"
                                style="font-size: 12px!important;cursor:pointer;">通常</label>
                            </div>
                          </td>
                          <td style="border: none!important;width: 151px;">
                            <div class="custom-control custom-radio custom-control-inline" style="margin-top:6px !important;">
                              <input type="radio" class="custom-control-input" id="customRadio2" name="sort_method"
                                value="settle">
                              <label class="custom-control-label" for="customRadio2"
                                style="font-size: 12px!important;cursor:pointer;"> 決算</label>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="table" style="width: auto;margin-bottom: 2px!important;">
                      <tbody>
                        <tr>
                          <td
                            style="padding-left:0px !important;border: none!important;text-align: left;color: black;width: 115px !important;">
                            <div class="line-icon-box float-left mr-3"></div>
                            作成方法
                          </td>
                          <td style="border: none!important;width: 65px;">
                            <div class="custom-control custom-radio custom-control-inline"
                              style="margin-left: -7px !important; margin-top:6px !important;">
                              <input type="radio" class="custom-control-input" id="customRadio3" name="creation_method"
                                value="new" checked="">
                              <label class="custom-control-label" for="customRadio3"
                                style="font-size: 12px!important;cursor:pointer;">新規作成</label>
                            </div>
                          </td>
                          <td style="border: none!important;width: 151px;">
                            <div class="custom-control custom-radio custom-control-inline" style="margin-left:15px; margin-top:6px !important;">
                              <input type="radio" class="custom-control-input" id="customRadio4" name="creation_method"
                                value="old">
                              <label class="custom-control-label" for="customRadio4"
                                style="font-size: 12px!important;cursor:pointer;"> 再作成</label>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </form>
            <div class="row">
              <div class="ml-3 mr-3 d-flex mt-2 w-100 justify-content-end">
                <div>
                  <button id="contenthide" href="#" class="btn btn-info uskc-button"
                    onclick="csvExport('{{ route('depositAccountingDataCreateCSV',['id' => $bango]) }}')">TXTエクスポート
                  </button>
                </div>
                <div>
                  <div class="loading-icon" style="">
                    <span style="font-size: 30px;"><i class="fa fa-spinner" aria-hidden="true"></i></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}
  </section>

  <!-- Including Common Footer Links Starts Here -->
  @include('layouts.footer')
  <!-- Including Common Footer Links Ends Here -->

  {{-- Shift + Enter to Close Alert Message Starts Here --}}
  <script>
    $(document).ready(function(){
      $(".dismissAlertMessage").click(function (){
        $('#successMessage').hide();
        $('#datepicker2_oen').focus();
      });
      $(".dismissAlertMessage").keydown(function (e){
        if (e.shiftKey && e.which == 13) {
          $('#successMessage').hide();
          $('#datepicker2_oen').focus();
          e.preventDefault();
        }
      });
    });
  </script>
  {{-- Shift + Enter to Close Alert Message Ends Here --}}

  <script type="text/javascript">
    var depositAccountDataCreation = document.createElement("script");
  depositAccountDataCreation.type = "text/javascript";
  depositAccountDataCreation.src = "{{ asset('js/sales/deposit_account_data_creation/deposit_account_data_creation.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
  document.getElementsByTagName("head")[0].appendChild(depositAccountDataCreation);
  </script>

  {{-- Knockout - Enter to New Input Starts Here --}}
  <script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>
  <script>
    // Enter key press auto focus next input......
      ko.bindingHandlers.nextFieldOnEnter = {
        init: function (element, valueAccessor, allBindingsAccessor) {
          $(element).on('keydown', 'input, textarea, select, button, tr.trfocus, a.btn', function (e) {
            var self = $(this),
            form = $(element),
            focusable, next;
            if (e.keyCode == 13 && !e.shiftKey) {
              focusable = form.find('input:not([disabled]), select, textarea, button:not([disabled]), tr.trfocus, a.btn').filter(':visible');
              // focusable = form.find('input:not([ignore]), select, textarea, button:not([ignore]), a.btn').filter(':visible');
              var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
              next = focusable.eq(nextIndex);
              next.focus();
              return false;
            }
            if (e.keyCode == 9) {
              e.preventDefault();
            }
          });
        }
      };
      ko.applyBindings({});
  </script>
  {{-- Knockout - Enter to New Input Ends Here --}}

 

  <script type="text/javascript">
    // #SI - modified date function starts here
    $(function () {
      // 入金日 - START

      $('#datepicker1_oen').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 10,
        offset: 6,
      });

      $(document).on('change focus', '#datepicker1_oen', function () {
        if ($(this).is('[readonly]')) {
          $(this).datepicker('hide');
          $(this).css("pointer-events", "none");
        }
        else if ($(this).val().length == 10) {
            $(this).datepicker('update');
            $(this).siblings('#datepicker1_comShow').val($(this).val());
            let datevalue = $(this).siblings('#datepicker1_comShow').val();  //getting date value from calendar
            let formatted_date = datevalue.replaceAll('/', '');
            $(this).val(formatted_date);
            $(this).focus();
            $(this).datepicker('hide');
          }
      });

      $(document).on('click', '#datepicker1_oen', function () {
        $(this).datepicker('show');
      });

      $(document).on('keyup', '#datepicker1_oen', function (e) {
        let inputDateValue = $(this).val();  //getting date value from input
        if (inputDateValue.length == 8) {
          let slicedYear = inputDateValue.slice(0, 4);
          let slicedMonth = inputDateValue.slice(4, 6);
          let slicedDay = inputDateValue.slice(6, 8);
          let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
          $(this).siblings('#datepicker1_comShow').val(formatted_sliced_date);
          $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
        }
      });
      // Update date value with slash on blur
      $(document).on('blur', '#datepicker1_oen', function () {
        if ($(this).val() != '') {
          $(this).val($(this).siblings('#datepicker1_comShow').val());
        } else if ($(this).val() == '') {
          $(this).val('');
          $(this).siblings('#datepicker1_comShow').val('');
        }
      });


      // 入金日 - END

      $('#datepicker2_oen').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 10,
        offset: 6,
      });

      $(document).on('change focus', '#datepicker2_oen', function () {
        if ($(this).is('[readonly]')) {
          $(this).datepicker('hide');
          $(this).css("pointer-events", "none");
        }
        else if ($(this).val().length == 10) {
          $(this).datepicker('update');
          $(this).siblings('#datepicker2_comShow').val($(this).val());
          let datevalue = $(this).siblings('#datepicker2_comShow').val();  //getting date value from calendar
          let formatted_date = datevalue.replaceAll('/', '');
          $(this).val(formatted_date);
          $(this).focus();
          $(this).datepicker('hide');
        }
      });

      $(document).on('click', '#datepicker2_oen', function () {
        $(this).datepicker('show');
      });

      $(document).on('keyup', '#datepicker2_oen', function (e) {
        let inputDateValue = $(this).val();  //getting date value from input
        if (inputDateValue.length == 8) {
          let slicedYear = inputDateValue.slice(0, 4);
          let slicedMonth = inputDateValue.slice(4, 6);
          let slicedDay = inputDateValue.slice(6, 8);
          let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
          $(this).siblings('#datepicker2_comShow').val(formatted_sliced_date);
          $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
        }
      });
      // Update date value with slash on blur
      $(document).on('blur', '#datepicker2_oen', function () {
        if ($(this).val() != '') {
          $(this).val($(this).siblings('#datepicker2_comShow').val());
        } else if ($(this).val() == '') {
          $(this).val('');
          $(this).siblings('#datepicker2_comShow').val('');
        }
      });

      //Enter press hide calendar
      $("#datepicker1_oen").keydown(function (e) {
        if (e.keyCode == 13) {
          $(this).datepicker('hide');
        }
      });

      $("#datepicker2_oen").keydown(function (e) {
        if (e.keyCode == 13) {
          $(this).datepicker('hide');
        }
      });

      //Click to hide calendar
      $("#add_icon").click(function () {
        $("#datepicker1_oen").datepicker('hide');
        $("#datepicker2_oen").datepicker('hide');
      });

// Success Close Button Click to hide calendar
      $(".close").click(function () {
        $("#datepicker2_oen").datepicker('hide');
      });
    });
  </script>

 <!--  loading icon -->
 <script>
    $(document).ready(function(){
        $(".customalert, .loading-icon").hide();
        $("#contenthide").click(function(){
          $(".customalert,.loading-icon").toggle();
        });
      });
  </script>

</body>

</html>