<div class="content-head-section custom-mb" style="padding: 13px 0 0;">
  <div class="container position-relative">
  <form id="firstSearch" action="{{ route('purchaseRecordList') }}" method="post">
        <input type="hidden" name="Button" id="firstButton" value="{{isset($old['Button'])?$old['Button']:null}}">
        <!--<input type="hidden" id="fs_sortField" name="sortField" value="{{--isset($old['sortField'])?$old['sortField']:null--}}">
        <input type="hidden" id="fs_sortType" name="sortType" value="{{--isset($old['sortType'])?$old['sortType']:null--}}">-->
        <input type="hidden" id="fs_userId" name="userId" value="{{$bango}}">
        <input type="hidden" id="first_csrf" value="{{csrf_token()}}" name="_token" disabled>
        <input type="hidden" id="source" value="purchaseRecordList"/>

      {{-- Success Message Starts Here --}}
      @if(Session::has('success_msg'))
      <div class="row success-msg-box" id="session_msg" style="position: relative; z-index: 1;" >
        <div class="col-12">
          <div class="alert alert-primary alert-dismissible">
            <button type="button" class="close dismissAlertMessage"  data-dismiss="alert" autofocus onclick="$('#division_datachar05_start').focus();">
            &times;</button>
            <strong>{{session()->pull('success_msg') }}</strong>
          </div>
        </div>
      </div>
      @endif
      {{-- Success Message Ends Here --}}
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
   @csrf
    {{-- Error Message Starts Here --}}
      <div class="row">
        <div class="col-12">
          <div id="error_data" class="common_error" style="color: red;position: relative;"></div>
         @if(isset($exceedUser))
              <p id="no_found_data" class="common_error">{{$exceedUser}}</p>
          @endif
        </div>
      </div>
    {{-- Error Message Ends Here --}}
    <div class="row pay_history_list_top_content purchase_record_top">
      <div class="col">

        {{-- Top Contents Starts Here --}}
        <div class="content-head-top">
          <div class="row mb-4">

            {{-- Top Left Side Contents Starts Here --}}
            <div class="ml-3 mr-5" style="width: auto;">
               <!-- Top search common pull-down layout -->
                  @include('layout.commonOfficeDeptGroup')
                <table class="table custom-form" style="width:auto;;margin-bottom:2px!important;">
                      <tbody>
                        <tr>
                          <td style="border: none!important;text-align: left;color: black;width:95px !important;padding-left: 0px!important;">
                            <div class="line-icon-box float-left mr-3"></div> 担当
                          </td>
                          <td style="border: none!important;width:220px;">
                              <div class="custom-arrow">
                            <select class="form-control" name="datachar05" id="datachar05" autofocus="">
                              <option value="">-</option>
                                             @foreach($datachar05 as $dtchar05)
                                                @if(isset($fsReqData['datachar05']))
                                                    <option value="{{$dtchar05->bango}}" @if($dtchar05->bango==$fsReqData['datachar05']){{'selected'}}@endif>
                                                        {{$dtchar05->bango." ".$dtchar05->name}}
                                                    </option>
                                                @else
                                                    @if(isset($fsReqData) && count($fsReqData)>0)
                                                        <option value="{{$dtchar05->bango}}">
                                                          {{$dtchar05->bango." ".$dtchar05->name}}
                                                        </option>
                                                    @else
                                                        <option value="{{$dtchar05->bango}}" @if($dtchar05->bango==$bango){{'selected'}}@endif>
                                                          {{$dtchar05->bango." ".$dtchar05->name}}
                                                        </option>
                                                    @endif
                                                @endif
                                              @endforeach
                            </select>
                              </div>
                          </td>
                        </tr>
                  </tbody>
                </table>
                <table class="table custom-form" style="margin-bottom: 2px!important;width:auto;">
                  <tbody>
                    <tr>
                      <td style="border: none!important;text-align: left;color: black;width: 95px !important;padding-left: 0px!important;">
                        <div class="line-icon-box float-left mr-3"></div>売上日
                      </td>
                      <td style="border: none!important;width: 177px !important;">
                        <div class="input-group">
                            @php 
                            $current_date = date("Y-m");
                            $start_date = date("Y/m/", strtotime($current_date." -3 months"))."01";           
                            $end_date = date("Y/m/t");                               
                            @endphp
                          <input type="text" name="intorder01_start"  class="form-control datePicker1_1" id="datepicker2_oen" 
                          oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');" 
                          onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))" maxlength="10" autocomplete="off" placeholder="年/月/日" style="" 
                          value="{{isset($fsReqData['intorder01_start'])?$fsReqData['intorder01_start']:$start_date}}" autofocus="">
                          <input type="hidden" class="datePickerHidden" value="">
                        </div>
                      </td>
                      <td style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
                          ～
                        </td>
                        <td style="border: none!important;width: 177px;">

                          <input type="text" name="intorder01_end" class="form-control datePicker1_2" id="datepicker1_oen"
                           oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');" 
                           onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))" maxlength="10" autocomplete="off" 
                           placeholder="年/月/日" style="" value="{{isset($fsReqData['intorder01_end'])?$fsReqData['intorder01_end']:$end_date}}">
                            <input type="hidden" class="datePickerHidden" value="">
                        </td>
                    </tr>
                  </tbody>
                </table>
                <table class="table custom-form" style="margin-bottom: 2px!important;width:auto;">
                  <tbody>
                    <tr>
                      <td style="border: none!important;text-align: left;color: black;width:95px !important;padding-left: 0px!important;">
                        <div class="line-icon-box float-left mr-3"></div>仕入完了日
                      </td>
                      <td style="border: none!important;width: 177px;">
                        <input type="text" name="intorder02_start" class="form-control datePicker datePicker2_1" id="datepicker4_oen" autocomplete="off" placeholder="年/月/日"
                          oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                          maxlength="10" autofocus="" value="{{isset($fsReqData['intorder02_start'])?$fsReqData['intorder02_start']:null}}">
                        <input type="hidden" class="datePickerHidden">
                      </td>
                      <td style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
                          ～
                        </td>
                        <td style="border: none!important;width: 177px;">
                          <input type="text" name="intorder02_end" class="form-control datePicker datePicker2_2" id="datepicker3_oen" autocomplete="off"
                                placeholder="年/月/日"
                                oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                maxlength="10" value="{{isset($fsReqData['intorder02_end'])?$fsReqData['intorder02_end']:null}}">
                                <input type="hidden" class="datePickerHidden">
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
        <div class="content-head-top" style="margin-bottom: 5px;border-top:1px solid #E1E1E1;border-bottom:1px solid #E1E1E1">
          <div class="row mb-4 mt-4">
            <div class="col-8">
                <table class="table custom-form" style="margin-bottom: 2px!important;width:auto;">
                  <tbody>
                    <tr>
                      {{-- <td style="border: none!important;text-align: left;color: black;width: 103px !important;padding-left: 0px!important;">
                        <div class="line-icon-box float-left mr-3"></div>未指示
                      </td> --}}
                      <td style="border: none!important;width: 177px !important;">
                            <div class="radio-rounded d-inline-block">
                              <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                                <input type="radio" class="custom-control-input" id="customRadio" name="rd1" value="rd_1"@if(isset($fsReqData['rd1'])&& $fsReqData['rd1']=="rd_1"){{"checked"}} @endif checked >
                                <label class="custom-control-label" for="customRadio" style="font-size: 12px!important;cursor:pointer;">未指示</label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                                  <input type="radio" class="custom-control-input" id="customRadio1" name="rd1" value="rd_2" @if(isset($fsReqData['rd1'])&& $fsReqData['rd1']=="rd_2"){{"checked"}} @endif >
                                  <label class="custom-control-label" for="customRadio1" style="font-size: 12px!important;cursor:pointer;">指示済</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                                  <input type="radio" class="custom-control-input" id="customRadio2" name="rd1" value="rd_3" @if(isset($fsReqData['rd1'])&& $fsReqData['rd1']=="rd_3"){{"checked"}} @endif>
                                  <label class="custom-control-label" for="customRadio2" style="font-size: 12px!important;cursor:pointer;">検印済</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                                  <input type="radio" class="custom-control-input" id="customRadio4" name="rd1" value="rd_4" @if(isset($fsReqData['rd1'])&& $fsReqData['rd1']=="rd_4"){{"checked"}} @endif>
                                  <label class="custom-control-label" for="customRadio4" style="font-size: 12px!important;cursor:pointer;">完了</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                                  <input type="radio" class="custom-control-input" id="customRadio5" name="rd1" value="rd_5" @if(isset($fsReqData['rd1'])&& $fsReqData['rd1']=="rd_5"){{"checked"}} @endif>
                                  <label class="custom-control-label" for="customRadio5" style="font-size: 12px!important;cursor:pointer;">すべて</label>
                                </div>
                                
                          </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
            </div>
            <div class="col-4">
                  <div class="d-inline-block float-right">
                    <button onclick="firstSearch('{{route('purchaseRecordList')}}',event.preventDefault())" type="submit" style="width: 150px;height:30px;line-height:30px;" class="btn btn-info">表示</button>
                  </div>
                </div>
          </div>
        </div>
        {{-- Checkbox with Button Ends Here --}}

      </div>
    </div>
  </div>
  </form>
</div>