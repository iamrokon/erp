<div class="content-head-section custom-mb" style="padding: 13px 0 0;">
  <div class="container position-relative">
      {{-- Success Message Starts Here --}}
      
     {{-- <div class="row success-msg-box" id="session_msg" style="width:100%; position: relative; width: 100%; max-width: 1452px; z-index: 1;">
          <div class="col-12 pl-0 pr-0 ml-3">
              <div class="alert alert-primary alert-dismissible">
                  <button type="button" class="close dismissMe" data-dismiss="alert" autofocus onclick="$('#categorikanri').focus();">
                      &times;
                  </button>
                  <strong></strong>
              </div>
          </div>
      </div>--}}
     
      
        <!-- Show Success Message -->
        @if(Session::has('success_msg'))
        @php
        $success_msg = session()->get('success_msg');
        @endphp
        <div id="update-success-msg" class="row success-msg-box" style="position: relative; width:100%;max-width: 1452px;z-index: 1;">
          <div class="col-12">
            <div class="alert alert-primary alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" autofocus
              onclick="$('#categorikanri').focus();">&times;</button>
              <strong>{{$success_msg}}</strong><br>
            </div>
          </div>
        </div>
        @endif

      <script>
          // Focus on Alert Closing
          $(".dismissMe").keydown(function(e) {
              if (e.shiftKey && e.which == 13) {
                  $('.close').alert('close');
                  event.preventDefault();
                  document.getElementById("categorikanri").click();
                  $('#categorikanri').focus();
              }
          });

      </script>

  {{-- Error Message Starts Here --}}
  <div class="row">
    <div class="col-12">
        <div id="error_data" class="common_error"></div>
    </div>
  </div>
  {{-- Error Message Ends Here --}}
  
    <div class="row  purchase_confirmantion ">
      <div class="col">
          
        <form id="firstSearch" method="post">  
            <input type="hidden" id="userId" name="userId" value="{{$bango}}">
            @csrf  
            <div class="content-head-top">
              <div class="row mb-2 d-flex justify-content-between">
                <div class="d-flex">
                  <div class="ml-3 mr-3">
                    <table class="table custom-form custom-table" style="border: none!important;width: auto;margin-bottom:4px !important;">
                      <tbody>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 79px!important;">担当</td>
                          <td style=" border: none!important;width: 202px;">
                            <div class="custom-arrow">
                              <select class="form-control" name="touchakutime" id="" autofocus="">
                                <option value="">-</option>
                                @foreach($touchakutime as $touchakutm)
                                <option value="{{$touchakutm->bango}}" @if($touchakutm->bango == $bango){{'selected'}}@endif>
                                    {{$touchakutm->bango." ".$touchakutm->name}}
                                </option>
                                @endforeach
                              </select>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="ml-3 mr-3">
                    <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                      <tbody>
                        <tr>
                            @php
                            $year = date('Y');
                            $month = date('m');
                            $day = date('d');
                            $last_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                            $start_date = date("Y/m",strtotime($year.'-'.$month." -3 year")).'/01';
                            $end_date = date('Y/m/d');
                            @endphp
                          <td style="border: none!important;text-align: left;color: black;width: 104px !important;">
                            <div class="line-icon-box float-left mr-3"></div>仕入日
                          </td>
                          <td style="border: none!important;width: 151px;">
                            <input type="text" name="touchakudate_start" id="touchakudate_start" value="{{$start_date}}" class="form-control datePicker datePicker1_1" autocomplete="off" value="" placeholder="年/月/日" oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');" onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))" maxlength="10" autofocus="">
                            <input type="hidden" class="datePickerHidden" value="{{$start_date}}">
                          </td>
                          <td style="width: 30px!important;border:0!important;text-align: center;">
                            ～
                          </td>
                          <td style="border: none!important;width: 151px;">
                            <input type="text" name="touchakudate_end" id="touchakudate_end" value="{{$end_date}}" class="form-control datePicker datePicker1_2" autocomplete="off" value="" placeholder="年/月/日" oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');" onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))" maxlength="10">
                            <input type="hidden" value="{{$end_date}}" class="datePickerHidden">
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="ml-3 mr-3">
                    <table class="table custom-form" style="border: none!important;width: auto;margin-bottom:4px !important">
                      <tbody>
                        <tr>
                          <td style=" border: none!important;width: 53px!important;">
                            <div class="radio-rounded d-inline-block">
                              <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                                <input type="radio" class="custom-control-input" id="customRadio" name="rd1" value="rd1_1" checked="">
                                <label class="custom-control-label" for="customRadio"
                                  style="font-size: 12px!important;cursor:pointer;">未チェック分</label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline"
                                style="padding-left: 20px!important;padding-right: 30px!important;">
                                <input type="radio" class="custom-control-input" id="customRadio2" name="rd1" value="rd1_2">
                                <label class="custom-control-label" for="customRadio2"
                                  style="font-size: 12px!important;cursor:pointer;">すべて</label>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="ml-3 mr-3">
                  <table class="table custom-form" style="border: none!important;width: auto;margin-bottom:4px !important">
                    <tbody>
                      <tr>
                        <td style=" border: none!important;width: 162px">
                          <button onclick="firstSearch('{{route('purchaseData')}}',event.preventDefault())" class="btn btn-info uskc-button">表示</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </form>
          
		<div id="purchaseHeaderPart">
        @include('purchase.purchaseConfirmation.purchaseConfirmationHeaderPart')
		</div>
          
      </div>
    </div>
  </div>
</div>
  