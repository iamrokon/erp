<div class="content-head-section custom-mb" style="padding: 13px 0 0;">
  <div class="container position-relative">
      <form id="firstSearch" action="{{ route('purchaseBalanceList') }}" method="post">
        <input type="hidden" name="Button" id="firstButton" value="{{isset($old['Button'])?$old['Button']:null}}">
        <!--<input type="hidden" id="fs_sortField" name="sortField" value="{{--isset($old['sortField'])?$old['sortField']:null--}}">
        <input type="hidden" id="fs_sortType" name="sortType" value="{{--isset($old['sortType'])?$old['sortType']:null--}}">-->
        <input type="hidden" id="fs_userId" name="userId" value="{{$bango}}">
        <input type="hidden" id="first_csrf" value="{{csrf_token()}}" name="_token" disabled>
        <input type="hidden" id="page_name" value="purchaseBalanceList" >
        @csrf 
      
        <div class="row success-msg-box d-none " id="session_msg" style="position: relative; z-index: 1;" >
          <div class="col-12">
            <div class="alert alert-primary alert-dismissible">
              <button type="button" class="close dismissAlertMessage"  data-dismiss="alert" autofocus onclick="$('#categorikanri').focus();">
              &times;</button>
              <strong>success message</strong>
            </div>
          </div>
        </div>
        
        @if(isset($exceedUser))
        <p id="no_found_data" class="common_error">{{$exceedUser}}</p>
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
              <div id="error_data" class="common_error" style="color: red;position: relative;"></div>
            </div>
          </div>
        {{-- Error Message Ends Here --}}
        <div class="row order_entry_topcontent purchase_balanceList_top">
          <div class="col">

            {{-- Top Contents Starts Here --}}
            <div class="content-head-top">
              <div class="row">

                {{-- Top Left Side Contents Starts Here --}}
                <div class="ml-3 mr-5" style="width: auto;">
                  <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                    <tbody>
                      <tr>
                        <td style="border: none!important;text-align: left;color: black;width: 94px !important;">
                          <div class="line-icon-box float-left mr-3"></div>年月
                        </td>
                        <td style="border: none!important;width: 151px;">
                           <input type="text" name="kk0001" id="kk0001" class="form-control datePicker datePicker1_1" autocomplete="off"
                            value="{{isset($fsReqData['kk0001'])?$fsReqData['kk0001']:date('Y/m')}}" placeholder="年/月"
                            oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                            onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))"
                            maxlength="10" autofocus="">
                          <input type="hidden" class="datePickerHidden" value="{{isset($fsReqData['kk0001'])?$fsReqData['kk0001']:date('Y/m')}}">
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
                        <td style=" border: none!important;width: 70px!important;">仕入先</td>
                        <td style="border: none!important;width: 537px;">
                          <div class="input-group input-group-sm custom_modal_input" style="margin-bottom: 4px;">
                            <input name="db_kk0002_start" id="db_kk0002_start" type="hidden" value="{{isset($fsReqData['db_kk0002_start'])?$fsReqData['db_kk0002_start']:null}}"/>
                            <input name="kk0002_start" id="kk0002_start_v2" type="text" value="{{isset($fsReqData['kk0002_start'])?$fsReqData['kk0002_start']:null}}" class="form-control" placeholder="" readonly="">
                            <div class="input-group-append">
                              <button onclick="supplierSelectionModalOpener_2('kk0002_start_v2','db_kk0002_start','1','required','r16cd',event.preventDefault())" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                            </div>
                          </div>
                        </td>
                        <td style="width: 30px!important;border:0!important;text-align: center;">
                          ～
                        </td>
                        <td style="border: none!important;width: 537px;">
                          <div class="input-group input-group-sm custom_modal_input" style="margin-bottom: 4px;">
                            <input name="db_kk0002_end" id="db_kk0002_end" type="hidden" value="{{isset($fsReqData['db_kk0002_end'])?$fsReqData['db_kk0002_end']:null}}"/>
                            <input name="kk0002_end" id="kk0002_end_v2" type="text" value="{{isset($fsReqData['kk0002_end'])?$fsReqData['kk0002_end']:null}}" class="form-control" placeholder="" readonly="">
                            <div class="input-group-append" >
                              <button onclick="supplierSelectionModalOpener_2('kk0002_end_v2','db_kk0002_end','1','required','r16cd',event.preventDefault())" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
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
                  <div class="d-flex float-right">
                      <div class="radio-rounded  d-inline-block mr-3 mt-1">
                          <div class="custom-control custom-radio  custom-control-inline" style="padding-left:11px!important;">
                              <input type="radio" class="custom-control-input" id="customRadio" name="rd" value="rd_1" checked="">
                              <label class="custom-control-label" for="customRadio" style="font-size: 12px!important;cursor:pointer;">仕入</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                              <input type="radio" class="custom-control-input" id="customRadio2" name="rd" value="rd_2" @if(isset($fsReqData['rd'])&& $fsReqData['rd'] == 'rd_2'){{"checked"}}@endif>
                              <label class="custom-control-label" for="customRadio2" style="font-size: 12px!important;cursor:pointer;"> 購入</label>
                            </div>
                      </div>
                      <div class="d-inline-block float-right">
                          <button onclick="firstSearch('{{route('purchaseBalanceList')}}',event.preventDefault())" type="button" style="width: 150px;height:30px;line-height:30px;" class="btn btn-info">表示</button>
                      </div>
                    </div>
                </div>
              </div>
            </div>
            {{-- Checkbox with Button Ends Here --}}

          </div>
        </div>
    </form>
  </div>
</div>