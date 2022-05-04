@section('title', '売上→会計データ作成')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '売上請求 >')
@section('menu-test5', '売上→会計データ作成')
@section('tag-test', 'ここにはガイドの文章が入ります。')

<!DOCTYPE html>
<html lang="ja">

<head>

  {{-- Including Common Header Starts Here --}}
  @include('layouts.header')
  {{-- Including Common Header Ends Here--}}

  {{-- Common Style Starts Here --}}
  @include('sales.accountingDataCreation.styles')
  {{-- Common Style Ends Here --}}

</head>


<body id="body" class="common-nav" style="overflow-x:visible;">
  <section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      <div class="content-head-section">
        <div class="container position-relative">
          <form id="mainForm" action="{{ route('accountingDataCreation') }}" method="post">
            <input type="hidden" id="userId" name="userId" value="{{$bango}}">
            <input id='submit_confirmation' value='' type='hidden' />
            @csrf

            {{-- Success Message Starts Here --}}
            @if(Session::has('success_msg'))
              @php
                $success_msg = session()->get('success_msg');
              @endphp
              <div class="row success-msg-box" style="position: relative; width: 100%; max-width: 1452px; z-index: 1;">
                <div class="col-12" style="white-space: normal; word-break: break-all;">
                  <div class="alert alert-primary alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>{{$success_msg}}</strong>
                  </div>
                </div>
              </div>
            @endif
            {{-- Success Message Ends Here --}}

            {{-- Error Message Starts Here --}}
            <div id="error_data" class="common_error"></div>
            {{-- Error Message Ends Here --}}

            <div class="row inner-top-content">
              <div class="col-12">
                <div class="row mb-2" style="padding-top: 0px;">
                  <div class="col-6">
                    <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                      <tbody>
                        @php
                        $start_date = date("Y/m",strtotime(date('Y-m')." -1 month")).'/01';
                        $lastday = date('t',strtotime(date('Y-m-d')));
                        $end_date = date('Y/m/').$lastday;
                        @endphp
                        <tr>
                          <td
                            style="border: none!important;text-align: left;color: black;width: 115px !important;padding-left: 0px !important;">
                            <div class="line-icon-box float-left mr-3"></div>
                            売上日
                          </td>
                          <td style="border: none!important;width: 151px;">
                            <div class="input-group">
                              <input id="datepicker2_oen" name="intorder03_start" autocomplete="off" type="text"
                                class="form-control input_field datePicker1_1"
                                oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                value="{{$start_date}}" placeholder="年/月/日" style="width: 96px!important;">
                              <input type="hidden" class="datePickerHidden">
                            </div>
                          </td>
                          <td style="width: 30px!important;border:0!important;text-align: center;">
                            ～
                          </td>
                          <td style="border: none!important;width: 151px;">
                            <div class="input-group">
                                <input id="datepicker1_oen" value="{{$end_date}}" name="intorder03_end" autocomplete="off" type="text"
                                class="form-control input_field datePicker1_2"
                                oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                placeholder="年/月/日" style="width: 96px!important;">
                              <input type="hidden" class="datePickerHidden">
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="content-head-top">
              <div class="row">
                <div class="col-6">
                  <div class="radio-rounded custom-table-oh d-inline-block">
                    <table class="table custom-form" style="width: auto;margin-bottom: 3px!important;">
                      <tbody>
                        <tr>
                          <td
                            style="border: none!important;text-align: left;color: black;width: 115px !important;padding-left: 0px !important;">
                            <div class="line-icon-box float-left mr-3"></div>
                            整理仕訳区分
                          </td>
                          <td style="border: none!important;width: 65px;">
                            <div class="custom-control custom-radio custom-control-inline"
                              style="margin-left: -7px !important;">
                              <input type="radio" class="custom-control-input" id="customRadio" name="rd1" value="rd1_1"
                                checked="">
                              <label class="custom-control-label" for="customRadio"
                                style="font-size: 12px!important;cursor:pointer;">通常</label>
                            </div>
                          </td>
                          <td style="border: none!important;width: 151px;">
                            <div class="custom-control custom-radio custom-control-inline" style="">
                              <input type="radio" class="custom-control-input" id="customRadio2" name="rd1"
                                value="rd1_2">
                              <label class="custom-control-label" for="customRadio2"
                                style="font-size: 12px!important;cursor:pointer;"> 決算</label>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-6">
                  <div class="radio-rounded custom-table-oh d-inline-block">
                    <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                      <tbody>
                        <tr>
                          <td
                            style="border: none!important;text-align: left;color: black;width: 115px !important;padding-left: 0px !important;">
                            <div class="line-icon-box float-left mr-3"></div>
                            作成方法
                          </td>
                          <td style="border: none!important;width: 65px;">
                            <div class="custom-control custom-radio custom-control-inline"
                              style="margin-left: -7px !important;">
                              <input type="radio" class="custom-control-input" id="customRadio3" name="rd2"
                                value="rd2_1" checked="">
                              <label class="custom-control-label" for="customRadio3"
                                style="font-size: 12px!important;cursor:pointer;">新規作成</label>
                            </div>
                          </td>
                          <td style="border: none!important;width: 151px;">
                            <div class="custom-control custom-radio custom-control-inline" style="">
                              <input type="radio" class="custom-control-input" id="customRadio4" name="rd2"
                                value="rd2_2">
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
              <div class="row">
                <div class="ml-3 mr-3 d-flex mt-2 w-100 justify-content-end">
                  <div>
                      <button onclick="accountingDataCreation();event.preventDefault();" id="submit" type="submit" class="btn btn-info uskc-button">TXTエクスポート</button>
                  </div>
                  <div class="loading-icon" style="display: none;">
                    <span style="font-size: 30px;"><i class="fa fa-spinner" aria-hidden="true"></i></span>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- container-fluid div end -->
      </div>
    </div>

    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{--  Footer Ends Here --}}
    
  </section>

  <!-- Including Common Footer Links Starts Here -->
  @include('layouts.footer')
  <!-- Including Common Footer Links Ends Here -->

  <!-- Hard reload js link starts here -->
  <script type="text/javascript">
    var accountingDataCreationLink = document.createElement("script");
      accountingDataCreationLink.type = "text/javascript";
      accountingDataCreationLink.src = "{{ asset('js/sales/accounting_data_creation/accountingDataCreation.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(accountingDataCreationLink);
  </script>
  <!-- Hard reload js link ends here -->

  {{-- Knockout - Enter to New Input Starts Here --}}
  {{-- @include('master.common.knockout') --}}
  <script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>

  {{-- Loader Show/Hide Starts Here --}}
  <script>
  //$(document).ready(function () {
  //  $(".loading-icon").hide();
  //  $(".uskc-button").click(function () {
  //    $(".loading-icon").toggle();
  //  });
  //}); 
  </script>
  {{-- Loader Show/Hide Ends Here --}}

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

  <script>
    // Start
    $('.datePicker1_1').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 10,
      offset: 6,
      trigger: '.datePicker1_1'
    });

    $(document).on('change focus', '.datePicker1_1', function () {
      if ($(this).val().length == 10) {
        $(this).datepicker('update');
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus();
        $(this).datepicker('hide');
      }
    });

    $(document).on('click', '.datePicker1_1', function () {
      if ($(this).val().length == 0) {
        $(this).datepicker('show');
      }
      else if ($(this).val().length <= 7 ) {
        $(this).datepicker('hide');
      }
    });

    $(document).on('keyup', '.datePicker1_1', function (e) {
      let inputDateValue = $(this).val();  //getting date value from input
      if (inputDateValue.length == 8) {
        let slicedYear = inputDateValue.slice(0, 4);
        let slicedMonth = inputDateValue.slice(4, 6);
        let slicedDay = inputDateValue.slice(6, 8);
        let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
        $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
        $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
        $(this).datepicker('update');
      }
    });

    // Update date value with slash on blur
    $(document).on('blur', '.datePicker1_1', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      } else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });

    //Enter press hide dropdown
    $(".datePicker1_1").keydown(function (e) {
      if (e.keyCode == 13) {
        $(".datePicker1_1").datepicker('hide');
      }
    });

    // End
    $('.datePicker1_2').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 10,
      offset: 6,
      trigger: '.datePicker1_2'
    });

    $(document).on('change focus', '.datePicker1_2', function () {
      if ($(this).val().length == 10) {
        $(this).datepicker('update');
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus();
        $(this).datepicker('hide');
      }
    });

    $(document).on('click', '.datePicker1_2', function () {
      if ($(this).val().length == 0) {
        $(this).datepicker('show');
      }
      else if ($(this).val().length <= 7 ) {
        $(this).datepicker('hide');
      }
    });

    $(document).on('keyup', '.datePicker1_2', function (e) {
      // $(this).datepicker('hide');
      let inputDateValue = $(this).val();  //getting date value from input
      if (inputDateValue.length == 8) {
        let slicedYear = inputDateValue.slice(0, 4);
        let slicedMonth = inputDateValue.slice(4, 6);
        let slicedDay = inputDateValue.slice(6, 8);
        let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
        $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
        $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
        $(this).datepicker('update');
      }
    });

    // Update date value with slash on blur
    $(document).on('blur', '.datePicker1_2', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      } else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });

    //Enter press hide cal
    $(".datePicker1_2").keydown(function (e) {
      if (e.keyCode == 13) {
        $(".datePicker1_2").datepicker('hide');
      }
    });

  </script>
<script>
  //Click to hide calendar
  $("#add_icon").click(function () {
    $("#datepicker2_oen ").datepicker('hide');
    $("#datepicker1_oen").datepicker('hide');
  });
</script>
<!--  footer content // windows height resize call-->

  <!--  footer content end // windows height resize call-->

</body>

</html>