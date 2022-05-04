<form id="firstSearch" action="{{ route('purchaseLedger') }}" method="post">
    <input type="hidden" name="Button" id="firstButton" value="{{isset($old['Button'])?$old['Button']:null}}">
    <input type="hidden" id="fs_userId" name="userId" value="{{$bango}}">
    <input type="hidden" id="first_csrf" value="{{csrf_token()}}" name="_token" disabled>
    @csrf  
        
    <div class="content-head-section custom-mb" style="padding: 13px 0 0;">
        <div class="container position-relative">
        {{-- Success Message Starts Here --}}
          <div class="row success-msg-box d-none" id="success_msg" style="position: relative; width: 100%; max-width: 1452px; z-index: 1;" >
              <div class="col-12" style="white-space: normal; word-break: break-all;">
                  <div class="alert alert-primary alert-dismissible">
                      <button type="button" class="close dismissMe" data-dismiss="alert" autofocus
                              onclick="$('#division_datachar05_start').focus();">
                          &times;
                      </button>
                      <strong>success message</strong>
                  </div>
              </div>
          </div>
          {{-- Success Message End Here --}}

          {{-- Error Message Starts Here --}}
          <div  class="common_error" id="error_data"></div>
          @if(isset($exceedUser))
            <p id="no_found_data" class="common_error">{{$exceedUser}}</p>
          @endif
          {{-- Error Message Ends Here --}}

          <div class="row pay_history_list_top_content purchase-ledger-top">

            <div class="col">

              {{-- Top Contents Starts Here --}}
              <div class="content-head-top">
                <div class="row mb-4">

                  {{-- Top Left Side Contents Starts Here --}}
                  <div class="ml-3 mr-5" style="width: auto;">
                    <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                      <tbody>
                        <tr>
                          <td style="border: none!important;text-align: left;color: black;width: 94px !important;">
                            <div class="line-icon-box float-left mr-3"></div>年月
                          </td>
                          @php 
                            $year = date('Y');
                            $month = date('m');
                            $last_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                            //$start_date = $year.'/'.$month.'/'.'01';
                            //$end_date = $year.'/'.$month.'/'.$last_day;
                            $start_date = date('Y/m');
                            $end_date = date('Y/m');
                            @endphp
                          <td style="border: none!important;width: 151px;">
                              <input type="text" name="touchakudate_start" id="touchakudate_start" class="form-control datePicker datePicker1_1" autocomplete="off"
                              value="{{isset($fsReqData['touchakudate_start'])?$fsReqData['touchakudate_start']:$start_date}}" placeholder="年/月"
                              oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                              onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))"
                              maxlength="10" >
                            <input type="hidden" class="datePickerHidden" value="">
                          </td>
                          <td style="width: 30px!important;border:0!important;text-align: center;">
                            ～
                          </td>
                          <td style="border: none!important;width: 151px;">
                            <input type="text" name="touchakudate_end" id="touchakudate_end" class="form-control datePicker datePicker1_2" autocomplete="off"
                              value="{{isset($fsReqData['touchakudate_end'])?$fsReqData['touchakudate_end']:$start_date}}" placeholder="年/月"
                              oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                              onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))"
                              maxlength="10">
                            <input type="hidden" class="datePickerHidden">
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="table custom-form " style="border: none!important;">
                      <tbody>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 70px!important;">購入先</td>
                          <td style="border: none!important;width: 537px;">
                            <div class="input-group input-group-sm custom_modal_input" id="bikou1_err" style="margin-bottom: 4px;">
                              <input name="bikou1" id="bikou1" type="hidden" readonly=""
                              value="{{isset($fsReqData['bikou1'])?$fsReqData['bikou1']:null}}">
                              <input id="bikou1_text" name="bikou1_text" value="{{isset($fsReqData['bikou1_text'])?$fsReqData['bikou1_text']:null}}"
                              type="text" class="form-control" placeholder="購入先" readonly="">
                              <div class="input-group-append" data-toggle="modal" data-target="#search_modal4">
                                  <button onclick="supplierSelectionModalOpener_2('bikou1_text','bikou1','1','nullable','r16cd',event.preventDefault())" type="button" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>

                  </div>
                  {{-- Top Left Side Contents Ends Here --}}


                </div>
              </div>
              {{-- Top Contents Ends Here --}}

              {{-- Checkbox with Button Starts Here --}}
              <div class="content-head-top" style="margin-bottom: 5px;">
                <div class="row mb-4 mt-4">
                  <div class="col-8">

                  </div>
                  <div class="col-4">
                    <div class="d-inline-block float-right">
                      <button onclick="firstSearch('{{route('purchaseLedger')}}',event.preventDefault())" style="width: 150px;height:30px;line-height:30px;" class="btn btn-info">表示</button>
                    </div>
                  </div>
                </div>
              </div>
              {{-- Checkbox with Button Ends Here --}}

            </div>
          </div>
        </div>
    </div>
</form>