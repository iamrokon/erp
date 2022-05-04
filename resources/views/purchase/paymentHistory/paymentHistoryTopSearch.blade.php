<div class="content-head-section custom-mb" style="padding: 13px 0 0;">
  <div class="container">


  {{-- Success Message Starts Here --}}
      @if(Session::has('success_msg'))
          <div class="row success-msg-box" id="success_msg" style="position: relative; width: 100%; max-width: 1452px; z-index: 1;" >
              <div class="col-12" style="white-space: normal; word-break: break-all;">
                  <div class="alert alert-primary alert-dismissible">
                      <button type="button" class="close dismissMe" data-dismiss="alert" autofocus
                              onclick="$('#datepicker1_oen').focus();">
                          &times;
                      </button>
                      <strong>{{session()->pull('success_msg') }}</strong>
                  </div>
              </div>
          </div>
      @endif
      {{-- Success Message Ends Here --}}

      {{-- Error Message Starts Here --}}
      <div  class="common_error" id="error_msg_div">@if(isset($paymentHistoryError)&& $paymentHistoryError!=null){{$paymentHistoryError}} @elseif(Session::has('error_msg')) {!! session()->pull('error_msg')  !!} @endif</div>
      {{-- Error Message Ends Here --}}

    <form id="firstSearch" action="{{ route('paymentHistory') }}" method="post">
      
      <input type="hidden" name="firstButton" value="topSearch">
      <input type="hidden" id="userId" name="userId" value="{{$bango}}">
      @csrf

      <div class="row payment_history_list inner_top_content payment_history_list">
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
                        <div class="line-icon-box float-left mr-3"></div>処理日
                      </td>
                      <td style="border: none!important;width: 151px;">
                        <input type="text" name="yoteibi_start" id="yoteibi_start" class="form-control datePicker datePicker1_1" autocomplete="off"
                         placeholder="年/月/日" value="{{isset($fsReqData['yoteibi_start'])?$fsReqData['yoteibi_start']:$first_date}}"
                          oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                          onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))"
                          maxlength="10" autofocus="">
                        <input type="hidden" class="datePickerHidden" value="{{isset($fsReqData['yoteibi_start'])?$fsReqData['yoteibi_start']:$first_date}}">
                      </td>
                      <td style="width: 30px!important;border:0!important;text-align: center;">
                        ～
                      </td>
                      <td style="border: none!important;width: 151px;">
                        <input type="text" name="yoteibi_end" id="yoteibi_end" class="form-control datePicker datePicker1_2" autocomplete="off"
                        value="{{isset($fsReqData['yoteibi_end'])?$fsReqData['yoteibi_end']:$last_date}}" placeholder="年/月/日"
                          oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                          onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))"
                          maxlength="10">
                        <input type="hidden" class="datePickerHidden" value="{{isset($fsReqData['yoteibi_end'])?$fsReqData['yoteibi_end']:$last_date}}">
                      </td>
                    </tr>
                  </tbody>
                </table>
                <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                  <tbody>
                    <tr>
                      <td style="border: none!important;text-align: left;color: black;width: 94px !important;">
                        <div class="line-icon-box float-left mr-3"></div>支払日
                      </td>
                      <td style="border: none!important;width: 151px;">
                        <input type="text" name="denpyohakkoubi_start" id="denpyohakkoubi_start" class="form-control datePicker datePicker2_1" autocomplete="off"
                          value="{{isset($fsReqData['denpyohakkoubi_start'])?$fsReqData['denpyohakkoubi_start']:$first_date}}" placeholder="年/月/日"
                          oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                          onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))"
                          maxlength="10" autofocus="">
                        <input type="hidden" class="datePickerHidden" value="{{isset($fsReqData['denpyohakkoubi_start'])?$fsReqData['denpyohakkoubi_start']:$first_date}}">
                      </td>
                      <td style="width: 30px!important;border:0!important;text-align: center;">
                        ～
                      </td>
                      <td style="border: none!important;width: 151px;">
                        <input type="text" name="denpyohakkoubi_end" id="denpyohakkoubi_end" class="form-control datePicker datePicker2_2" autocomplete="off"
                          value="{{isset($fsReqData['denpyohakkoubi_end'])?$fsReqData['denpyohakkoubi_end']:$last_date}}" placeholder="年/月/日"
                          oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                          onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))"
                          maxlength="10">
                        <input type="hidden" class="datePickerHidden" value="{{isset($fsReqData['denpyohakkoubi_end'])?$fsReqData['denpyohakkoubi_end']:$last_date}}">
                      </td>
                    </tr>
                  </tbody>
                </table>

              </div>
              {{-- Top Left Side Contents Ends Here --}}

              {{-- Top Right Side Contents Starts Here --}}
              <div class="ml-5 mr-3" style="width: auto;">
                <table class="table custom-form" style="width: auto; margin-bottom: 2px!important;">
                  <tbody>
                    <tr>
                      <td style="border: none!important;text-align: left;color: black;width: 94px !important;">
                        <div class="line-icon-box float-left mr-3"></div>支払番号
                      </td>
                      <td style="border: none!important; width: 180px;">
                        <input type="text" name="syouhinid_start" id="syouhinid_start"
                          oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');"
                          class="form-control" autocomplete="off" value="{{isset($fsReqData['syouhinid_start'])?$fsReqData['syouhinid_start']:''}}" maxlength="10" placeholder="999999999">
                      </td>
                      <td style="width: 30px!important;border:0!important;text-align: center;">
                        ～
                      </td>
                      <td style="border: none!important; width: 180px;">
                        <input type="text" name="syouhinid_end" id="syouhinid_end"
                          oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');"
                          class="form-control" autocomplete="off" value="{{isset($fsReqData['syouhinid_end'])?$fsReqData['syouhinid_end']:''}}" maxlength="10" placeholder="999999999">
                      </td>
                    </tr>
                  </tbody>
                </table>
                <table class="table custom-form" style="width: auto; margin-bottom: 2px!important;">
                  <tbody>
                    <tr>
                      <td style="border: none!important;text-align: left;color: black;width:95px !important;">
                        <div class="line-icon-box float-left mr-3"></div>支払方法
                      </td>
                      <td style="border: none!important; width: 180px;">
                        <div class="custom-arrow">
                          <select class="form-control" name="datachar01_start" id="datachar01_start">
                            <option value="">-</option>
                            @foreach($data104 as $d104)
                              @if(isset($fsReqData['datachar01_start']) && $fsReqData['datachar01_start'] !='')
                                <option value="{{$d104->category1.$d104->category2}}" @if(isset($fsReqData['datachar01_start']) && $fsReqData['datachar01_start'] == $d104->category1.$d104->category2){{'selected'}}@endif >
                                  {{$d104->category2." ".$d104->category4}}
                                </option>
                              @else
                                <option value="{{$d104->category1.$d104->category2}}" >
                                  {{$d104->category2." ".$d104->category4}}
                                </option>
                              @endif
                            @endforeach
                          </select>
                        </div>
                      </td>
                      <td style="width: 30px!important;border:0!important;text-align: center;">
                        ～
                      </td>
                      <td style="border: none!important; width: 180px;">
                        <div class="custom-arrow">
                          <select class="form-control" name="datachar01_end" id="datachar01_end">
                            <option value="">-</option>
                            @foreach($data104 as $d104)
                              @if(isset($fsReqData['datachar01_end']) && $fsReqData['datachar01_end'] !='')
                                <option value="{{$d104->category1.$d104->category2}}" @if(isset($fsReqData['datachar01_end']) && $fsReqData['datachar01_end'] == $d104->category1.$d104->category2){{'selected'}}@endif >
                                  {{$d104->category2." ".$d104->category4}}
                                </option>
                              @else
                                <option value="{{$d104->category1.$d104->category2}}" >
                                  {{$d104->category2." ".$d104->category4}}
                                </option>
                              @endif
                            @endforeach
                          </select>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              {{-- Top Right Side Contents Ends Here --}}

            </div>
          </div>
          {{-- Top Contents Ends Here --}}
          
          @if(!isset($fsReqData['rd1']))
            @php $fsReqData['rd1'] = '0'; @endphp
          @endif


          {{-- Checkbox with Button Starts Here --}}
          <div class="content-head-top">
            <div class="row mb-4 mt-4">
              <div class="col-7">
 
              </div>
              <div class="col-5">
                <div class="radio-rounded d-inline-block" style="margin-top: 5px;">
                  <div class="custom-control custom-radio custom-control-inline"
                    style="padding-left:11px!important;">
                    <input type="radio" class="custom-control-input" id="customRadio" name="rd1" value="1" @if(isset($fsReqData['rd1'])&& $fsReqData['rd1']=="1"){{"checked"}}@endif>
                    <label class="custom-control-label" for="customRadio"
                      style="font-size: 12px!important;cursor:pointer;">買掛分</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline"
                    style="padding-left: 20px!important;">
                    <input type="radio" class="custom-control-input" id="customRadio2" name="rd1" value="2" @if(isset($fsReqData['rd1'])&& $fsReqData['rd1']=="2"){{"checked"}}@endif>
                    <label class="custom-control-label" for="customRadio2"
                      style="font-size: 12px!important;cursor:pointer;">未払分</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline"
                    style="padding-left: 20px!important;">
                    <input type="radio" class="custom-control-input" id="customRadio3" name="rd1" value="0" @if(isset($fsReqData['rd1']) && $fsReqData['rd1']!="1" && $fsReqData['rd1']!="2"){{"checked"}}@endif>
                    <label class="custom-control-label" for="customRadio3"
                      style="font-size: 12px!important;cursor:pointer;">すべて</label>
                  </div>
                </div>
                <div class="d-inline-block float-right">
                   <a style="width: 150px;height:30px;line-height:30px;" href="#" class="btn btn-info" id="topSearchBtn">表示</a>
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
