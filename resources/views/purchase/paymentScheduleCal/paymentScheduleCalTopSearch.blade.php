<form id="firstSearch" method="post">
    <input type="hidden" name="Button" id="firstButton" value="{{isset($old['Button'])?$old['Button']:null}}">
    <input type="hidden" id="userId" name="userId" value="{{$bango}}">
    <input id='submit_confirmation' value='' type='hidden'/>
    @csrf  

<!-- <div class="content-head-section" style="padding: 13px 0 0;">
  <div class="container"> -->
    <div class="row order_entry_topcontent payment-schedule-top-content">
      <div class="col">
        <div class="content-head-top" style="border-bottom: 0px;">
          <div class="row mb-2">
            <div class="col-12">
            <div class="row">
              <div class="col-12">
              <div>
                  <table class="table custom-form" style="border: none!important;width: auto; margin-bottom: 2px!important;">
                    <tbody>
                      <tr>
                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                          <div class="line-icon-box"></div>
                        </td>
                        <td style=" border: none!important;width: 96px!important;">支払締め日</td>
                        <td style=" border: none!important;width: 152px;">
                          <div class="custom-arrow">
                              <select name="payment_deadline" id="payment_deadline" onchange="dateCal()" class="form-control" autofocus="">                        
                                @foreach($payment_deadline as $payment_deadlin)
                                    <option value="{{$payment_deadlin->category1.$payment_deadlin->category2}}" @if($payment_deadlin->category1.$payment_deadlin->category2 == 'D820'){{'selected'}}@endif>
                                        {{$payment_deadlin->category2." ".$payment_deadlin->category4}}
                                    </option>
                                @endforeach
                            </select>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              <div>
                <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                  <tbody>
                    <tr>
                        @php
                        $year = date('Y');
                        $month = date('m');
                        $day = date('d');
                        $last_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                        $previous_date = date("Y/m",strtotime($year.'-'.$month." -1 month"))."/".$last_day;
                        $start_date = date("Y/m/").$last_day;
                        $end_date = date('Y/m/d');
                        @endphp
                    
                      <td style="border: none!important;text-align: left;color: black;width: 120px !important;padding-left:0px!important;">
                        <div class="line-icon-box float-left mr-3"></div>
                        支払日
                        
                         <input value="{{$previous_date}}" id="temp_previous_date" type="hidden"/>
                         <input value="{{$start_date}}" id="temp_start_date" type="hidden"/>
                        <input value="{{$end_date}}" id="temp_end_date" type="hidden"/>
                        <input value="{{$day}}" id="system_day" type="hidden"/>
                      </td>
                      <td style="border: none!important;width: 151px;">
                        <div class="input-group">
                            <input name="payment_date" id="payment_date" type="text" class="form-control datePicker1_1" oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                     onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                         maxlength="10"
                                         autocomplete="off" placeholder="年/月/日"
                                         style="width: 96px!important;" value="">
                            <input type="hidden" class="datePickerHidden" id="payment_date_hidden">
                              </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
            </div>
            <div>
                <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                  <tbody>
                    <tr>
                      <td style="border: none!important;text-align: left;color: black;width: 120px !important;padding-left:0px!important;">
                        <div class="line-icon-box float-left mr-3"></div>
                        締切日
                      </td>
                      <td style="border: none!important;width: 151px;">
                        <div class="input-group">
                                  <input name="deadline" id="deadline" type="text" class="form-control datePicker1_2"  oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                     onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                         maxlength="10"
                                         autocomplete="off" placeholder="年/月/日"
                                         style="width: 96px!important;" value="">
                                  <input type="hidden" class="datePickerHidden" id="deadline_hidden">
                              </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
            </div>
              </div>
            </div>

            <div class="row">
              <div class="col-7">
                <div>
                  <table class="table custom-form">
                    <tbody>
                      <tr>
                        <td style="width: 23px!important;border:0!important;padding-left:0px!important;">
                          <div class="line-icon-box" style="background: #353A81;"></div>
                        </td>
                        <td style="width: 94px!important;border: none!important;text-align: left;color: black;">
                        仕入先・購入先
                        </td>
                        <td style=" border: none!important;">
                          <div>
                            <div class="input-group input-group-sm custom_modal_input ">
                              <input name="bikou1_text" id="bikou1_v2" type="text" class="form-control" placeholder="" readonly="" style="padding: 0!important;">
                              <input name="bikou1" id="bikou1_db" type="hidden" value=""/>
                              <div onclick="supplierSelectionModalOpener_2('bikou1_v2','bikou1_db','2','nullable','r17_3cd',event.preventDefault())" class="input-group-append" style="margin-left: 0px!important;">
                                <button class="input-group-text btn" style="cursor: pointer;"><i class="fas fa-arrow-left"></i></button>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
            <div class="row">
            <div class="d-flex mt-2 mb-4 w-100 ml-3 mr-3  justify-content-end">
                <div class="">
                    <button onclick="registerPaymentScheduleCal();event.preventDefault();" class="btn btn-info uskc-button">更&nbsp;&nbsp;新</button>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <!-- </div>
</div> -->
</form>