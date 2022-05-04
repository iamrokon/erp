<div class="content-head-section custom-mb" style="padding: 13px 0 0;">
  <div class="container position-relative">
    <form id="firstSearch" action="{{ route('purchaseResultList') }}" method="post">
      <input type="hidden" name="Button" id="firstButton" value="{{isset($old['Button'])?$old['Button']:null}}">
      <input type="hidden" id="fs_userId" name="userId" value="{{$bango}}">
      <input type="hidden" id="first_csrf" value="{{csrf_token()}}" name="_token" disabled>
      <input type="hidden" id="source" value="purchaseResultList"/>
      @csrf

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
    <div class="row order_entry_topcontent purchase_resultList_top">
      <div class="col">
        <div class="content-head-top" style="padding-bottom: 16px;">
          {{--@include('layout.commonOfficeDeptGroup')--}}
          <div class="row">

            <div class="col">
              <table class="table custom-form" style="width:auto;">
                <tbody>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;width:120px !important;padding-left: 0px !important;">
                      <div class="line-icon-box float-left mr-3"></div> 事業部
                    </td>
                    <td style="border: none!important;width:270px;">
                      <input type="hidden" id="search_data_exist_status" value="@if(isset($fsReqData['division_datachar05_start'])){{ $fsReqData['division_datachar05_start'] }}@endif">
                        <div class="custom-arrow">
                      <select name="division_datachar05_start" id="division_datachar05_start" class="form-control" autofocus>
                            <!--<option class="null" value="">-</option>-->
                            @foreach($B9Data_left as $B9Dt)
                              @if(isset($fsReqData['division_datachar05_start']) && $fsReqData['division_datachar05_start'] !='')
                                <option value="{{$B9Dt->category1.$B9Dt->category2}}" @if(isset($fsReqData['division_datachar05_start']) && $fsReqData['division_datachar05_start'] == $B9Dt->category1.$B9Dt->category2){{'selected'}}@endif >
                                  {{$B9Dt->category2_show." ".$B9Dt->category4}}
                                </option>
                              @else
                                <option value="{{$B9Dt->category1.$B9Dt->category2}}" @if(isset($personal_datatxt0003->category2 ) && $personal_datatxt0003->category2 == $B9Dt->category2) selected @endif>
                                  {{$B9Dt->category2_show." ".$B9Dt->category4}}
                                </option>
                              @endif
                            @endforeach
                      </select>
                        </div>
                    </td>
                    <td style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
                      ～
                    </td>
                    <td style="border: none!important;width:270px;">
                      <div class="custom-arrow">
                        <select name="division_datachar05_end" id="division_datachar05_end" class="form-control">
                            <!--<option class="null" value="">-</option>-->
                            @foreach($B9Data_right as $B9Dt)
                              @if(isset($fsReqData['division_datachar05_end']) && $fsReqData['division_datachar05_end'] !='')
                                  <option value="{{$B9Dt->category1.$B9Dt->category2}}" @if(isset($fsReqData['division_datachar05_end']) && $fsReqData['division_datachar05_end'] == $B9Dt->category1.$B9Dt->category2){{'selected'}}@endif >
                                    {{$B9Dt->category2_show." ".$B9Dt->category4}}
                                  </option>
                              @else
                                  <option value="{{$B9Dt->category1.$B9Dt->category2}}" @if(isset($personal_datatxt0003->category2) && $personal_datatxt0003->category2 == $B9Dt->category2) selected @endif>
                                    {{$B9Dt->category2_show." ".$B9Dt->category4}}
                                  </option>
                              @endif
                            @endforeach
                        </select>
                      </div>

                    </td>
                  </tr>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;padding-left: 0px !important;"><div class="line-icon-box float-left mr-3"></div>部
                    </td>
                    <td style="border: none!important;">
                      <div class="custom-arrow">
                          <select class="form-control" name="department_datachar05_start" id="department_datachar05_start" >
                              <option class="null" value="">-</option>
                              @foreach($C1Data_left as $C1Dt)
                                @if(isset($fsReqData['department_datachar05_start']))
                                  <option value="{{$C1Dt->category1.$C1Dt->category2}}" @if(isset($fsReqData['department_datachar05_start']) && $C1Dt->category1.$C1Dt->category2==$fsReqData['department_datachar05_start']){{'selected'}}@endif >
                                    {{substr($C1Dt->category2,4,1)." ".$C1Dt->category4}}
                                  </option>
                                @else
                                    @if(isset($fsReqData)  && count($fsReqData)>0))
                                        <option value="{{$C1Dt->category1.$C1Dt->category2}}">
                                          {{substr($C1Dt->category2,4,1)." ".$C1Dt->category4}}
                                        </option>
                                    @else
                                        <option value="{{$C1Dt->category1.$C1Dt->category2}}" >
                                          {{substr($C1Dt->category2,4,1)." ".$C1Dt->category4}}
                                        </option>
                                    @endif
                                @endif
                              @endforeach
                          </select>
                      </div>
                    </td>
                    <td style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
                      ～
                    </td>
                    <td style="border: none!important;">
                        <div class="custom-arrow">
                            <select class="form-control" name="department_datachar05_end" id="department_datachar05_end" >
                                <option class="null" value="">-</option>
                                @foreach($C1Data_right as $C1Dt)
                                  @if(isset($fsReqData['department_datachar05_end']))
                                    <option value="{{$C1Dt->category1.$C1Dt->category2}}" @if(isset($fsReqData['department_datachar05_end']) && $C1Dt->category1.$C1Dt->category2==$fsReqData['department_datachar05_end']){{'selected'}}@endif >
                                      {{substr($C1Dt->category2,4,1)." ".$C1Dt->category4}}
                                    </option>
                                  @else
                                      @if(isset($fsReqData) && count($fsReqData)>0))
                                      <option value="{{$C1Dt->category1.$C1Dt->category2}}" >
                                          {{substr($C1Dt->category2,4,1)." ".$C1Dt->category4}}
                                      </option>
                                      @else
                                      <option value="{{$C1Dt->category1.$C1Dt->category2}}" >
                                          {{substr($C1Dt->category2,4,1)." ".$C1Dt->category4}}
                                      </option>
                                      @endif
                                  @endif
                                @endforeach
                            </select>
                        </div>
                    </td>
                  </tr>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;padding-left: 0px !important;">
                      <div class="line-icon-box float-left mr-3"></div>グループ
                    </td>
                    <td style="border: none!important;">
                        <div class="custom-arrow">
                            <select class="form-control" name="group_datachar05_start" id="group_datachar05_start" >
                                <option class="null" value="">-</option>
                                  @if(isset($fsReqData['department_datachar05_start']))
                                    @foreach($C2Data_left as $C2Dt)
                                      <option value="{{$C2Dt->category1.$C2Dt->category2}}" @if(isset($fsReqData['group_datachar05_start']) && $C2Dt->category1.$C2Dt->category2==$fsReqData['group_datachar05_start']){{'selected'}}@endif >
                                        {{substr($C2Dt->category2,5,1)." ".$C2Dt->category4}}
                                      </option>
                                    @endforeach 
                                  @endif
                            </select>
                        </div>
                    </td>
                    <td style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
                        ～
                      </td>
                    <td style="border: none!important;">
                        <div class="custom-arrow">
                            <select class="form-control" name="group_datachar05_end" id="group_datachar05_end" >
                              <option class="null" value="">-</option>
                                @if(isset($fsReqData['department_datachar05_start']))
                                @foreach($C2Data_right as $C2Dt)
                                    <option value="{{$C2Dt->category1.$C2Dt->category2}}" @if(isset($fsReqData['group_datachar05_end']) && $C2Dt->category1.$C2Dt->category2==$fsReqData['group_datachar05_end']){{'selected'}}@endif >
                                      {{substr($C2Dt->category2,5,1)." ".$C2Dt->category4}}
                                    </option>
                                @endforeach 
                                @endif
                            </select>
                        </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <!-- <table class="table custom-form" style="width:auto;margin-bottom: 0px!important;">
                <tbody>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;width:120px !important;padding-left: 0px!important;">
                      <div class="line-icon-box float-left mr-3"></div> 事業部
                    </td>
                    <td style="border: none!important;width:270px;">
                      <div class="custom-arrow">
                        <select class="form-control" name="" id="" autofocus="">
                          <option value="">03 東日本ソリューション事業部</option>
                          <option value="">fdjlkasdjflasdjf</option>
                          <option value="">fdjlkasdjflasdjf</option>
                          <option value="">fdjlkasdjflasdjf</option>
                          <option value="">fdjlkasdjflasdjf</option>
                        </select>
                      </div>
                    </td>
                    <td style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
                      ～
                    </td>
                    <td style="border: none!important;width:270px;">
                      <div class="custom-arrow">
                        <select class="form-control" name="" id="">
                          <option value="">03 東日本ソリューション事業部</option>
                          <option value=""></option>
                        </select>
                      </div>

                    </td>
                  </tr>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;padding-left: 0px!important;">
                      <div class="line-icon-box float-left mr-3"></div>部
                    </td>
                    <td style="border: none!important;">
                      <div class="custom-arrow">
                        <select class="form-control" name="" id="">
                          <option value="">1 東日本ソリューション営業部</option>
                          <option value=""></option>
                        </select>
                      </div>
                    </td>
                    <td style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
                      ～
                    </td>
                    <td style="border: none!important;">
                      <div class="custom-arrow">
                        <select class="form-control" name="" id="">
                          <option value="">選択してください</option>
                          <option value=""></option>
                        </select>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;padding-left: 0px!important;">
                      <div class="line-icon-box float-left mr-3"></div>グループ
                    </td>
                    <td style="border: none!important;">
                      <div class="custom-arrow">
                        <select class="form-control" name="" id="">
                          <option value="">1 第1グループ</option>
                          <option value=""></option>
                        </select>
                      </div>
                    </td>
                    <td style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
                      ～
                    </td>
                    <td style="border: none!important;">
                      <div class="custom-arrow">
                        <select class="form-control" name="" id="">
                          <option value="">選択してください</option>
                          <option value=""></option>
                        </select>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table> -->
              <table class="table custom-form" style="margin-bottom: 0px!important;width: auto;">
                <tbody>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;width: 120px !important;padding-left: 0px!important;">
                      <div class="line-icon-box float-left mr-3"></div>担当
                    </td>
                    <td style="text-align: center;border: none!important;;width:270px!important;">
                      <div class="custom-arrow">
                        <!-- <select class="form-control" name="" id="">
                          <option value="">275 小川卓也</option>
                          <option value=""></option>
                        </select> -->
                        <select name="datachar05" id="datachar05" class="form-control">
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
                    <td style="border: none!important;width:310px;"> </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div class="row">
            <div class="ml-3 mr-3" style="width: 646px;">
              <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                <tbody>
                  @php 
                  $year = date('Y');
                  $month = date('m');
                  $last_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                  $start_date = date('Y/m/')."01";
                  $end_date = date('Y/m/d');
                  @endphp
                  <tr>
                    <td
                      style="border: none!important;text-align: left;color: black;width: 120px !important;padding-left:0px!important;">
                      <div class="line-icon-box float-left mr-3"></div>売上日
                    </td>
                    <td style="border: none!important;width: 121px;">
                      <input type="text" name="purchaseDateFrom" id="datepicker1" class="form-control datePicker datePicker1_1"
                        autocomplete="off" value="{{isset($fsReqData['purchaseDateFrom'])?$fsReqData['purchaseDateFrom']:$start_date}}" placeholder="年/月/日"
                        oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                        onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))"
                        maxlength="10" autofocus="">
                      <input type="hidden" class="datePickerHidden" value="">
                    </td>
                    <td style="width: 30px!important;border:0!important;text-align: center;">
                      ～
                    </td>
                    <td style="border: none!important;width: 121px;">
                      <input type="text" name="purchaseDateTo" id="datepicker2"  class="form-control datePicker datePicker1_2" autocomplete="off"
                        value="{{isset($fsReqData['purchaseDateTo'])?$fsReqData['purchaseDateTo']:$end_date}}" placeholder="年/月/日"
                        oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                        onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))"
                        maxlength="10">
                      <input type="hidden" class="datePickerHidden">
                    </td>
                  </tr>
                  <tr>
                    <td
                      style="border: none!important;text-align: left;color: black;width: 95px !important;padding-left:0px!important;">
                      <div class="line-icon-box float-left mr-3"></div>外注仕入完了日
                    </td>
                    <td style="border: none!important;width: 121px;">
                      <input type="text" name="salesDateFrom" id="datepicker3"  class="form-control datePicker datePicker1_3"
                        autocomplete="off" value="{{isset($fsReqData['salesDateFrom'])?$fsReqData['salesDateFrom']:null}}" placeholder="年/月/日"
                        oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                        onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))"
                        maxlength="10" autofocus="">
                      <input type="hidden" class="datePickerHidden" value="">
                    </td>
                    <td style="width: 30px!important;border:0!important;text-align: center;">
                      ～
                    </td>
                    <td style="border: none!important;width: 121px;">
                      <input type="text" name="salesDateTo" id="datepicker4" class="form-control datePicker datePicker1_4" autocomplete="off"
                        value="{{isset($fsReqData['salesDateTo'])?$fsReqData['salesDateTo']:null}}" placeholder="年/月/日"
                        oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                        onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))"
                        maxlength="10">
                      <input type="hidden" class="datePickerHidden">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="content-head-top">
          <div class="row mb-4 mt-4">
            <div class="col-8">
              <div class="radio-rounded d-inline-block ">
                <div class="custom-control custom-radio custom-control-inline"
                  style="padding-left:11px!important;">
                  <input type="radio" class="custom-control-input" id="customRadio" name="payresd1" value="1"
                  @if(isset($fsReqData['payresd1'])&& $fsReqData['payresd1']=="1"){{"checked"}}@endif checked="">
                  <label class="custom-control-label" for="customRadio"
                    style="font-size: 12px!important;cursor:pointer;">未</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline"
                  style="padding-left:20px!important;">
                  <input type="radio" class="custom-control-input" id="customRadio2" name="payresd1" value="2" @if(isset($fsReqData['payresd1'])&& $fsReqData['payresd1']=="2"){{"checked"}}@endif>
                  <label class="custom-control-label" for="customRadio2"
                    style="font-size: 12px!important;cursor:pointer;"> 指示済</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline"
                  style="padding-left:20px!important;">
                  <input type="radio" class="custom-control-input" id="customRadio3" name="payresd1" value="3" @if(isset($fsReqData['payresd1'])&& $fsReqData['payresd1']=="3"){{"checked"}}@endif>
                  <label class="custom-control-label" for="customRadio3"
                    style="font-size: 12px!important;cursor:pointer;">検印済</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline"
                  style="padding-left:20px!important;">
                  <input type="radio" class="custom-control-input" id="customRadio4" name="payresd1" value="4" @if(isset($fsReqData['payresd1'])&& $fsReqData['payresd1']=="4"){{"checked"}}@endif>
                  <label class="custom-control-label" for="customRadio4"
                    style="font-size: 12px!important;cursor:pointer;">完了</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline"
                style="padding-left:20px!important;">
                <input type="radio" class="custom-control-input" id="customRadio5" name="payresd1" value="5" @if(isset($fsReqData['payresd1'])&& $fsReqData['payresd1']=="5"){{"checked"}}@endif>
                <label class="custom-control-label" for="customRadio5"
                  style="font-size: 12px!important;cursor:pointer;">すべて</label>
              </div>
              </div>
            </div>
            <div class="col-4">
              <div class="d-inline-block float-right">
                <button onclick="firstSearch('{{route('purchaseResultList')}}',event.preventDefault())" type="submit" style="width: 150px;height:30px;line-height:30px;" class="btn btn-info">表示</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </form>
  </div>
</div>