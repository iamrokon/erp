<div class="content-head-section custom-mb" style="padding: 13px 0 0;">
  <div class="container position-relative">
  <form id="firstSearch" action="{{ route('supplierLedger') }}" method="post">
    <input type="hidden" name="Button" id="firstButton" value="{{isset($old['Button'])?$old['Button']:null}}">
    <input type="hidden" id="fs_userId" name="userId" value="{{$bango}}">
      <input type="hidden" id="first_csrf" value="{{csrf_token()}}" name="_token" disabled>
      <input type="hidden" id="source" value="supplierLedger"/>
      @csrf
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
          <div  class="common_error " id="error_data"></div>
          @if(isset($exceedUser))
            <p id="no_found_data" class="common_error">{{$exceedUser}}</p>
          @endif
          {{-- Error Message Ends Here --}}
          <div class="row pay_history_list_top_content supplier-leger-top">
            <div class="col">

              {{-- Top Contents Starts Here --}}
              <div class="content-head-top">
                <div class="row mb-4">
                  <div class="ml-3 mr-5" style="width: auto;">
                    <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                      <tbody>
                        <tr>
                          <td style="border: none!important;text-align: left;color: black;width: 94px !important;">
                            <div class="line-icon-box float-left mr-3"></div>年月
                          </td>
                          <td style="border: none!important;width: 151px;">
                            @php 
                            $year = date('Y');
                            $month = date('m');
                            $last_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                            //$start_date = $year.'/'.$month.'/'.'01';
                            //$end_date = $year.'/'.$month.'/'.$last_day;
                            $start_date = date('Y/m');
                            $end_date = date('Y/m');
                            @endphp
                            <input type="text" id="datepicker1_oen" name="start_date" class="form-control datePicker datePicker1_1" autocomplete="off"
                              value="{{isset($fsReqData['start_date'])?$fsReqData['start_date']:$start_date}}" placeholder="年/月"
                              oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2})/g, '$1$2').replace(/([\d]{6})([\d]{1,2})?/g, '$1');"
                              onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))"
                              maxlength="7">
                            <input type="hidden" class="datePickerHidden" value="">
                          </td>
                          <td style="width: 30px!important;border:0!important;text-align: center;">
                            ～
                          </td>
                          <td style="border: none!important;width: 151px;">
                            <input type="text" id="datepicker2_oen" name="end_date" class="form-control datePicker datePicker1_2" autocomplete="off"
                              value="{{isset($fsReqData['end_date'])?$fsReqData['end_date']:$end_date}}" placeholder="年/月"
                              oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2})/g, '$1$2').replace(/([\d]{6})([\d]{1,2})?/g, '$1');"
                              onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))"
                              maxlength="7">
                            <input type="hidden" class="datePickerHidden">
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="table custom-form" style="width: auto; margin-bottom: 2px!important;">
                      <tbody>
                        <tr>
                          <td
                            style="border: none!important;text-align: left;color: black; width: 94px !important;padding-left:0px!important;">
                            <div class="line-icon-box float-left mr-3"></div>仕入先
                          </td>
                          <td style="border: none!important;">
                            <div class="input-group input-group-sm custom_modal_input">
                              <!-- <input type="text" class="form-control" placeholder="仕入先" readonly=""> -->
                              <input id="supplier_v2" name="supplier_text" value="{{isset($fsReqData['supplier_text'])?$fsReqData['supplier_text']:null}}" type="text" class="form-control" placeholder="仕入先"  readonly>
                              <input id="supplier_db" type="hidden" name="supplier" value="{{isset($fsReqData['supplier'])?$fsReqData['supplier']:null}}" class="db_hidden_field supplier_db">
                              <div class="input-group-append" 
                                style="margin-left: 0px!important;">
                                <button type="button" onclick="supplierSelectionModalOpener_2('supplier_v2','supplier_db','2','nullable','r16cd',2,event.preventDefault())" 
                                class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              {{-- Top Contents Ends Here --}}

              {{-- Button Starts Here --}}
              <div class="content-head-top">
                <div class="row mb-4 mt-4">
                  <div class="col-12">
                    <div class="d-inline-block float-right">
                      <button onclick="firstSearch('{{route('supplierLedger')}}',event.preventDefault())" type="submit"  style="width: 150px;height:30px;line-height:30px;" class="btn btn-info">表示</button>
                    </div>
                  </div>
                </div>
              </div>
              {{-- Button Ends Here --}}

            </div>
          </div>
          </form>
        </div>
      </div>