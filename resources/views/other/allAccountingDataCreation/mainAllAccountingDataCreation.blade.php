@section('title', '会計データ作成')
@section('menu-test1', 'ホーム >')
@section('menu-test3', ' その他  >')
@section('menu-test5', '会計データ作成')
<!DOCTYPE html>
<html lang="en" >
  <head>
    @include('layouts.header')
  </head>
  @include('other.allAccountingDataCreation.styles')
  <body id="body" style="overflow-x:visible;" class="common-nav">
    <section>
      @include('layout.nav_fixed')
      <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
        <div class="content-head-section">
            <div class="container">
              {{-- Success Message Starts Here --}}
              <div id="success_msg_main" class="row success-msg-box" style="display:none;position: relative; width: 100%; max-width: 1452px; z-index: 1;">
                  <div class="col-12" style="white-space: normal; word-break: break-all;">
                    <div class="alert alert-primary alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <strong id="success_msg"></strong>
                    </div>
                  </div>
                </div>
              {{-- Success Message Ends Here --}}

              <div id="error_data" class="common_error"></div>
                

              <form id="mainForm" action="{{ route('allAccountingDataCreation') }}" method="post">
              <input type="hidden" id="userId" name="userId" value="{{$bango}}">
              <input id='submit_confirmation' value='' type='hidden' />
              @csrf
            
              <div class="row deposit-data-creation">
                <div class="col-12">
                  <div class="row mb-2" style="padding-top: 0px;">
                    <div class="col-6">
                      <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                        <tbody>
                            @php
                            //$start_date = date("Y/m",strtotime(date('Y-m')." -1 month")).'/01';
                            $start_date = date("Y/m").'/01';
                            $lastday = date('t',strtotime(date('Y-m-d')));
                            $end_date = date('Y/m/').$lastday;
                            @endphp
                          <tr>
                            <td style="border: none!important;text-align: left;color: black;width: 115px !important;">
                              <div class="line-icon-box float-left mr-3"></div>
                              伝票日付
                            </td>
                            <td style="border: none!important;width: 151px;">
                              <div class="input-group">
                                <input type="text" name="intorder03_start" class="form-control" id="datepicker1_oen"
                                  oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                  onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                  maxlength="10" autocomplete="off" placeholder="年/月/日" style="width: 96px!important;"
                                  value="{{$start_date}}">
                                <input type="hidden" class="datePickerHidden">
                              </div>
                            </td>
                            <td style="width: 30px!important;border:0!important;text-align: center;">
                              ～
                            </td>
                            <td style="border: none!important;width: 151px;">
                              <div class="input-group">
                                <input type="text" name="intorder03_end" class="form-control" id="datepicker2_oen"
                                  oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                  onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                  maxlength="10" autocomplete="off" placeholder="年/月/日" style="width: 96px!important;"
                                  value="{{$end_date}}">
                                <input type="hidden" class="datePickerHidden">
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="radio-rounded custom-table-oh d-inline-block">
                        <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                          <tbody>
                            <tr>
                              <td style="border: none!important;text-align: left;color: black;width: 115px !important;">
                                <div class="line-icon-box float-left mr-3"></div>
                                整理仕訳区分
                              </td>
                              <td style="border: none!important;width: 65px;">
                              <div class="custom-control custom-radio custom-control-inline" style="margin-left: -7px !important;">
                                <input type="radio" class="custom-control-input" id="customRadio" name="rd1" value="rd1_1" checked="">
                                <label class="custom-control-label" for="customRadio" style="font-size: 12px!important;cursor:pointer;"><span style="margin-top: 2px !important;display: inline-block">通常</span></label>
                              </div>
                              </td>
                              <td style="border: none!important;width: 151px;">
                                <div class="custom-control custom-radio custom-control-inline" style="">
                                  <input type="radio" class="custom-control-input" id="customRadio2" name="rd1" value="rd1_2">
                                  <label class="custom-control-label" for="customRadio2" style="font-size: 12px!important;cursor:pointer;"><span style="margin-top: 2px !important;display: inline-block">決算</span></label>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td style="border: none!important;text-align: left;color: black;padding-top:13px !important;">
                                <div class="line-icon-box float-left mr-3"></div>
                                作成方法
                              </td>
                              <td style="border: none!important;width: 65px;padding-top:13px !important;">
                              <div class="custom-control custom-radio custom-control-inline" style="margin-left: -7px !important;">
                                <input type="radio" class="custom-control-input" id="customRadio3" name="rd2" value="rd2_1" checked="">
                                <label class="custom-control-label" for="customRadio3" style="font-size: 12px!important;cursor:pointer;"><span style="margin-top: 2px !important;display: inline-block">新規作成</span></label>
                              </div>
                              </td>
                              <td style="border: none!important;width: 151px;padding: top 13px!important;">
                                <div class="custom-control custom-radio custom-control-inline" style="margin-top:13px !important;">
                                  <input type="radio" class="custom-control-input" id="customRadio4" name="rd2" value="rd2_2">
                                  <label class="custom-control-label" for="customRadio4" style="font-size: 12px!important;cursor:pointer;"><span style="margin-top: 2px !important;display: inline-block">再作成</span></label>
                                </div>
                              </td>
                            </tr>

                            <tr>
                              <td rowspan="4" style="border: none!important;text-align: left;vertical-align: baseline !important;color: black;padding-top:13px !important;">
                                <div class="line-icon-box float-left mr-3"></div>
                                作成データ
                              </td>
                              <td colspan="2" style="border: none!important;text-align: left;color: black;padding-top:13px !important;">
                                <label class="checkbox_container header-checkbox">売上→会計データ作成
                                  <input class="checkAllCheckbox" type="checkbox" id="" name="rd3_1" value="rd3_1" checked>
                                  <span class="checkmark" style="top: 1px;"></span>
                                </label>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="2" style="border: none!important;text-align: left;color: black;padding-top:13px !important;">
                                <label class="checkbox_container header-checkbox">入金→会計データ作成
                                  <input class="checkAllCheckbox" type="checkbox" id="" name="rd3_2" value="rd3_2" checked>
                                  <span class="checkmark" style="top: 1px;"></span>
                                </label>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="2" style="border: none!important;text-align: left;color: black;padding-top:13px !important;">
                                <label class="checkbox_container header-checkbox">仕入→会計データ作成
                                  <input class="checkAllCheckbox" type="checkbox" id="" name="rd3_3" value="rd3_3" checked>
                                  <span class="checkmark" style="top: 1px;"></span>
                                </label>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="2" style="border: none!important;text-align: left;color: black;padding-top:13px !important;">
                                <label class="checkbox_container header-checkbox">支払→会計データ作成
                                  <input class="checkAllCheckbox" type="checkbox" id="" name="rd3_4" value="rd3_4" checked>
                                  <span class="checkmark" style="top: 1px;"></span>
                                </label>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <div class="d-flex mt-2 w-100 justify-content-end">
                        <button onclick="allAccountingDataCreation();event.preventDefault();" id="contenthide" href="#" class="btn btn-info uskc-button" >TXTエクスポート
                        </button>
                        <div class="loading-icon" style="display: none;">
                          <span style="font-size: 30px;" id="temp_id_581"><i class="fa fa-spinner" aria-hidden="true"></i></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <!-- container-fluid div end -->
          </form>
          </div>
        </div>
        @include('layout.footer_new')
      </section>

      @include('layouts.footer')
      <!--  loading icon -->
      
      <!-- Hard reload js link starts here -->
    <script type="text/javascript">
      var accountingDataCreationLink = document.createElement("script");
        accountingDataCreationLink.type = "text/javascript";
        accountingDataCreationLink.src = "{{ asset('js/other/all_accounting_data_creation/allAccountingDataCreation.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
        document.getElementsByTagName("head")[0].appendChild(accountingDataCreationLink);
    </script>
    <!-- Hard reload js link ends here -->
      
    <script>
      $(document).ready(function(){
        $(".customalert, .loading-icon").hide();
        $("#contenthide").click(function(){
          $(".customalert,.loading-icon").toggle();
        });

      });
    </script>

    <script type="text/javascript">
      // Date Picker Initialization
      $('#datepicker1_oen').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 2048,
        offset: 4,
        trigger: '#datepicker1_oen'
      });

      $('#datepicker1_oen').on('change focus', function () {
        if ($(this).val().length == 10) {
          $(this).siblings('.datePickerHidden').val($(this).val());
          let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
          let formatted_date = datevalue.replaceAll('/', '')
          $(this).val(formatted_date);
          $(this).focus(); //focusing current input on select
          $(this).datepicker('hide');

          if($(this).val().replaceAll('/', '') > $('#datepicker2_oen').val().replaceAll('/', '')){
            $('#datepicker2_oen').val(datevalue);
            $('#datepicker2_oen').datepicker('setStartDate', $('#datepicker1_oen').datepicker('getDate'));
            $('#datepicker2_oen').datepicker('update');
            $('#datepicker2_oen').val('');
          }
          else{
            $('#datepicker2_oen').datepicker('setStartDate', $('#datepicker1_oen').datepicker('getDate'));
            $('#datepicker2_oen').datepicker('update');
          }
        }
      });

      $('#datepicker1_oen').on('keyup', function (e) {
        let inputDateValue = $(this).val();  //getting date value from input
        if (inputDateValue.length == 8) {
          let slicedYear = inputDateValue.slice(0, 4);
          let slicedMonth = inputDateValue.slice(4, 6);
          let slicedDay = inputDateValue.slice(6, 8);
          let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
          $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
          $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
          $('#datepicker2_oen').datepicker('setStartDate', $('#datepicker1_oen').datepicker('getDate'));
          $('#datepicker2_oen').datepicker('update');
        }
      });
      // Update date value with slash on blur
      $('#datepicker1_oen').on('blur', function () {
        if ($(this).val() != '') {
          $(this).val($(this).siblings('.datePickerHidden').val());
        }
        else if ($(this).val() == '') {
          $(this).val('');
          $(this).siblings('.datePickerHidden').val('');
        }
      });

      $('#datepicker2_oen').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 2048,
        offset: 4,
        trigger: '#datepicker2_oen',
        startDate: $('#datepicker1_oen').datepicker('getDate')
      });

      $('#datepicker2_oen').on('change focus', function () {
        if ($(this).val().length == 10) {
          $(this).siblings('.datePickerHidden').val($(this).val());
          let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
          let formatted_date = datevalue.replaceAll('/', '')
          $(this).val(formatted_date);
          $(this).focus(); //focusing current input on select
          $(this).datepicker('hide');
        }
      });

      $('#datepicker2_oen').on('keyup', function (e) {
        let inputDateValue = $(this).val();  //getting date value from input
        if (inputDateValue.length == 8) {
          let slicedYear = inputDateValue.slice(0, 4);
          let slicedMonth = inputDateValue.slice(4, 6);
          let slicedDay = inputDateValue.slice(6, 8);
          let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
          $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
          $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
        }
      });
      // Update date value with slash on blur
      $('#datepicker2_oen').on('blur', function () {
        if ($(this).val() != '') {
          $(this).val($(this).siblings('.datePickerHidden').val());
        }
        else if ($(this).val() == '') {
          $(this).val('');
          $(this).siblings('.datePickerHidden').val('');
        }
      });

      //Enter press hide dropdown...
      $("#datepicker1_oen").keydown(function (e) {
        if (e.keyCode == 13) {
          $("#datepicker1_oen").datepicker('hide');
        }
      });
      $("#datepicker2_oen").keydown(function (e) {
        if (e.keyCode == 13) {
          $("#datepicker2_oen").datepicker('hide');
        }
      });
    </script>

  </html>
