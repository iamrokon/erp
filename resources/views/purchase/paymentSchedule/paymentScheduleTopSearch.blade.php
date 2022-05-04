<div class="content-head-section" style="padding-bottom: 5px;">
  <div class="container position-relative">

      {{-- Success Message Starts Here --}}
      {{--@if(Session::has('success_msg'))--}}
          <div class="row success-msg-box d-none" id="success_msg" style="position: relative; width: 100%; max-width: 1452px; z-index: 1;" >
              <div class="col-12" style="white-space: normal; word-break: break-all;">
                  <div class="alert alert-primary alert-dismissible">
                      <button type="button" class="close dismissMe" data-dismiss="alert" autofocus
                              onclick="$('#datepicker1_oen').focus();">
                          &times;
                      </button>
                      <strong>{{--{{session()->pull('success_msg') }}--}}</strong>
                  </div>
              </div>
          </div>
      {{--@endif--}}
      {{-- Success Message Ends Here --}}

      {{-- Error Message Starts Here --}}
      <div  class="common_error" id="error_msg_div">@if(isset($paymentScheduleError)&& $paymentScheduleError!=null){{$paymentScheduleError}} @elseif(Session::has('error_msg')) {!! session()->pull('error_msg')  !!} @endif</div>
      {{-- Error Message Ends Here --}}
    <script>
      // Focus on Alert Closing
      $(".dismissMe").keydown(function(e) {
          if (e.shiftKey && e.which == 13) {
              $('.close').alert('close');
              event.preventDefault();
              document.getElementById("datepicker1_oen").click();
              $('#datepicker1_oen').focus();
          }
      });
    </script>

    <div class="row order_entry_topcontent pay_schedule_list inner-top-content">
        <form id="firstSearch" action="{{ route('paymentSchedule') }}" method="post">
            @csrf
            <input type="hidden" name="firstButton" value="topSearch">
            <input type="hidden" id="userId" name="userId" value="{{$bango}}">
            <input type="hidden" id="searchedDataCount" name="searchedDataCount" value="{{count($paymentScheduleInfos)}}">
            <input type="hidden" id="defaultSrc_h" name="defaultSrc_h" @if(Session::has('defaultSrc')) value="{{session()->pull('defaultSrc')}}" value="0" @else  @endif >
              <div class="col">
                <div class="content-head-top" style="border-bottom:0px!important;">
                  <div class="row">
                    <div class="col">
                      <table class="table custom-form"
                        style="border: none!important;width: auto;margin-bottom:4px !important;">
                        <tbody>
                          <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style=" border: none!important;width: 71px!important;">締切日</td>
                            <td style=" border: none!important;width: 151px;">
                              <div class="input-group">
                                <input type="text" name="dateDeadLine" class="form-control" id="datepicker1_oen"
                                       autocomplete="off" value="{{isset($fsReqData['dateDeadLine'])?$fsReqData['dateDeadLine']:''}}"
                                       oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                       onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))"
                                       maxlength="10" placeholder="年/月/日"  autofocus="">
                                <input type="hidden" class="datePickerHidden" value="{{isset($fsReqData['dateDeadLine'])?$fsReqData['dateDeadLine']:''}}">
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    <div class="col">

                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <table class="table custom-form" style="width:auto;margin-bottom: 4px !important;">
                        <tbody>
                          <tr>
                            <td
                              style="border: none!important;text-align: left;color: black;width:95px !important;padding-left:0px!important;">
                              <div class="line-icon-box float-left mr-3"></div>仕入先
                            </td>
                            <td style="border: none!important;width:270px;">
                              <div class="input-group input-group-sm position-relative custom_modal_input">
                                <input type="text" name="information1_text" id="tsearch_information1_v2" value="{{isset($fsReqData['information1_text'])?$fsReqData['information1_text']:null}}" class="form-control" readonly="" style="padding: 0!important;">
                                    <input name="information1_short" id="tsearch_information1_db" value="{{isset($fsReqData['information1_short'])?$fsReqData['information1_short']:null}}" type="hidden" >
                                    <div class="input-group-append" >
                                      <button onclick="supplierSelectionModalOpener_2('tsearch_information1_v2','tsearch_information1_db','1','nullable','r16cd',event.preventDefault())" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                                    </div>
                              </div>
                            </td>
                            <td
                              style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
                              ～
                            </td>
                            <td style="border: none!important;width:270px;">
                              <div class="input-group input-group-sm position-relative custom_modal_input">
                                <input type="text" name="information2_text" id="tsearch_information2_v2" value="{{isset($fsReqData['information2_text'])?$fsReqData['information2_text']:null}}" class="form-control" readonly="" style="padding: 0!important;">
                                    <input name="information2_short" id="tsearch_information2_db" value="{{isset($fsReqData['information2_short'])?$fsReqData['information2_short']:null}}" type="hidden" >
                                    <div class="input-group-append" >
                                      <button onclick="supplierSelectionModalOpener_2('tsearch_information2_v2','tsearch_information2_db','1','nullable','r16cd',event.preventDefault())" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                                    </div>
                              </div>

                            </td>
                          </tr>

                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="row">
                    <div class="ml-3 mr-3" style="width: 646px;">
                      <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                        <tbody>
                          <tr>
                            <td
                              style="border: none!important;text-align: left;color: black;width: 95px !important;padding-left:0px!important;">
                              <div class="line-icon-box float-left mr-3"></div>支払日
                            </td>
                            <td style="border: none!important;width: 151px;">
                              <input type="text" name="paymentDateFrom" class="form-control datePicker" id="datepicker2_oen"
                                autocomplete="off" value="{{isset($fsReqData['paymentDateFrom'])?$fsReqData['paymentDateFrom']:''}}" placeholder="年/月/日"
                                oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))"
                                maxlength="10" autofocus="">
                              <input type="hidden" class="datePickerHidden" value="{{isset($fsReqData['paymentDateFrom'])?$fsReqData['paymentDateFrom']:''}}">
                            </td>
                            <td style="width: 30px!important;border:0!important;text-align: center;">
                              ～
                            </td>
                            <td style="border: none!important;width: 151px;">
                              <input type="text" name="paymentDateTo" class="form-control datePicker datePicker1_1" id="datepicker3_oen"
                                autocomplete="off" value="{{isset($fsReqData['paymentDateTo'])?$fsReqData['paymentDateTo']:''}}" placeholder="年/月/日"
                                oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))"
                                maxlength="10">
                              <input type="hidden" class="datePickerHidden" value="{{isset($fsReqData['paymentDateTo'])?$fsReqData['paymentDateTo']:''}}">
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="ml-3 mr-3">
                      <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                        <tbody>
                          <tr>
                            <td style="border: none!important;text-align: left;color: black;width: 94px !important;">
                              <div class="line-icon-box float-left mr-3"></div>支払方法
                            </td>
                            <td style="border: none!important;width: 151px;">
                              <div class="custom-arrow">
                                  <select class="form-control" name="paymentMethod" id="paymentMethod">
                                      <option value=""> - </option>
                                      @foreach ($data104 as $categoryKanri)
                                          @if(isset($fsReqData['paymentMethod']))
                                              <option value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}" @if($categoryKanri->category1 . $categoryKanri->category2==$fsReqData['paymentMethod']){{'selected'}}@endif>
                                                  {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                                              </option>
                                          @else
                                              <option value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}">
                                                  {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
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
                  </div>
                </div>
              </div>

    </div>

    <div style="border-top: 1px solid #E1E1E1; border-bottom: 1px solid #E1E1E1;margin-top:20px;margin-bottom:14px;">
      <div class="row mt-4">
        <div class="col-8">
          <div class="radio-rounded d-inline-block " >
            <div class="custom-control custom-radio custom-control-inline"
              style="padding-left:11px!important;">
              <input type="radio" class="custom-control-input" id="customRadio" name="rd1" value="1" @if(isset($fsReqData['rd1'])&& $fsReqData['rd1']=="1"){{"checked"}}@endif>
              <label class="custom-control-label" for="customRadio"
                style="font-size: 12px!important;cursor:pointer;">仕入</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline"
              style="padding-left:11px!important;">
              <input type="radio" class="custom-control-input" id="customRadio2" name="rd1" value="2" @if(isset($fsReqData['rd1'])&& $fsReqData['rd1']=="2"){{"checked"}}@endif>
              <label class="custom-control-label" for="customRadio2"
                style="font-size: 12px!important;cursor:pointer;"> 購入</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline"
              style="padding-left:11px!important;">
              <input type="radio" class="custom-control-input" id="customRadio3" name="rd1" value="3" @if(isset($fsReqData['rd1']) && $fsReqData['rd1']=="3"){{"checked"}} @elseif(!isset($fsReqData['rd1'])) {{"checked"}} @endif  >
              <label class="custom-control-label" for="customRadio3"
                style="font-size: 12px!important;cursor:pointer;">すべて</label>
            </div>
          </div>
        </div>
        <div class="col-4">
          <div class="d-inline-block float-right" style="margin-bottom: 23px;">
            <a style="width: 150px;height:30px;line-height:30px;" href="#" class="btn btn-info" id="topSearchBtn">表示</a>
            <button style="width: 150px;height:30px;line-height:30px;" href="#" class="btn btn-info" id="pdfCreationBtn" @if(count($paymentScheduleInfos)<1)  disabled @endif>PDFダウンロード</button>
          </div>
        </div>

          <div style="display: flex; justify-content: flex-end; width: 100%;">
              <div class="progress" style="width: 348px; display: none; margin-right: 15px;">
                  <div id="progress-bar" class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: 0%"
                       aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
          </div>
      </div>
    </div>
  </form>
  </div>
</div>
