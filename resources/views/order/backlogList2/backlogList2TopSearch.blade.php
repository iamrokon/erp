<form id="firstSearch" action="{{ route('backlogList2') }}" method="post">
    <input type="hidden" name="Button" id="firstButton" value="{{isset($old['Button'])?$old['Button']:null}}">
    <!--<input type="hidden" id="fs_sortField" name="sortField" value="{{--isset($old['sortField'])?$old['sortField']:null--}}">
    <input type="hidden" id="fs_sortType" name="sortType" value="{{--isset($old['sortType'])?$old['sortType']:null--}}">-->
    <input type="hidden" id="fs_userId" name="userId" value="{{$bango}}">
    <input type="hidden" id="first_csrf" value="{{csrf_token()}}" name="_token" disabled>
    @csrf
    <div class="row list_backlog2 inner-top-content">
        <div class="col">
          <div class="content-head-top" style="padding-bottom: 16px;">
              
            <!-- Top search common pull-down layout -->
            @include('layout.commonOfficeDept')
            
            <div class="row">
              <div class="col">
                <table class="table custom-form" style="margin-bottom: 0px!important;width: auto;">
                  <tbody>
                    <tr>
                      <td
                        style="border: none!important;text-align: left;color: black;width: 95px !important;padding-left:0px!important;">
                        <div class="line-icon-box float-left mr-3"></div>担当
                      </td>
                      <td style="text-align: center;border: none!important;;width:270px!important;">
                        <div class="custom-arrow">
                           <select name="tantousya_bango" id="tantousya_bango" class="form-control">
                                <option value="">-</option>
                                @foreach($datachar05 as $dtchar05)
                                  @if(isset($fsReqData['tantousya_bango']))
                                      <option value="{{$dtchar05->bango}}" @if($dtchar05->bango==$fsReqData['tantousya_bango']){{'selected'}}@endif>
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

                      <td style="border: none!important;width:310px;">

                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

            </div>

            <div class="row">
              <div class="ml-3 mr-3">
                <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                  <tbody>
                    <tr>
                        @php
                        $year = date('Y');
                        $month = date('m');
                        $start_date = $year.'/'.$month;
                        $temp_month = (int) $month + 2;
                        $end_date = $year.'/'.str_pad($temp_month,2,'0',STR_PAD_LEFT);
                        @endphp
                      <td
                        style="border: none!important;text-align: left;color: black;width:95px !important;padding-left:0px!important;">
                        <div class="line-icon-box float-left mr-3"></div> 売上年月
                      </td>
                      <td style="border: none!important;width:270px;">
                          <input type="text" name="sales_date_start" id="sales_date_start" class="form-control datePicker datePicker1_1" autocomplete="off"
                          value="{{isset($fsReqData['sales_date_start'])?$fsReqData['sales_date_start']:$start_date}}" placeholder="年/月"
                          oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2').replace(/([\d]{6})([\d]{1,2})?/g, '$1');"
                          onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))"
                          maxlength="6" autofocus="">
                        <input type="hidden" class="datePickerHidden" value="">
                      </td>
                      <td
                        style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
                        ～
                      </td>
                      <td style="border: none!important;width:270px;">
                        <input type="text" name="sales_date_end" id="sales_date_end" class="form-control datePicker datePicker1_2" autocomplete="off"
                          value="{{isset($fsReqData['sales_date_end'])?$fsReqData['sales_date_end']:$end_date}}" placeholder="年/月"
                          oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2').replace(/([\d]{6})([\d]{1,2})?/g, '$1');"
                          onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))"
                          maxlength="6">
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
              <div class="col-10">
                <div class="radio-rounded d-inline-block ">
                  <div class="custom-control custom-radio custom-control-inline"
                    style="padding-left:11px!important;">
                    <input type="radio" class="custom-control-input" id="customRadiolist1" name="rd1"
                      value="rd1_1" @if(isset($fsReqData['rd1'])&& $fsReqData['rd1']=="rd1_1"){{"checked"}}@endif checked="">
                    <label class="custom-control-label" for="customRadiolist1"
                      style="font-size: 12px!important;cursor:pointer;">すべて</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline"
                    style="padding-left:20px!important;">
                    <input type="radio" class="custom-control-input" id="customRadiolist2" name="rd1"
                      value="rd1_2" @if(isset($fsReqData['rd1'])&& $fsReqData['rd1']=="rd1_2"){{"checked"}}@endif>
                    <label class="custom-control-label" for="customRadiolist2"
                      style="font-size: 12px!important;cursor:pointer;"> 定期定額以外</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline"
                    style="padding-left:20px!important;">
                    <input type="radio" class="custom-control-input" id="customRadiolist3" name="rd1"
                      value="rd1_3" @if(isset($fsReqData['rd1'])&& $fsReqData['rd1']=="rd1_3"){{"checked"}}@endif>
                    <label class="custom-control-label" for="customRadiolist3"
                      style="font-size: 12px!important;cursor:pointer;">保守</label>
                  </div>
                  <div class="custom-control custom-table custom-radio custom-control-inline"
                    style="padding-left:20px!important;">
                    <input type="radio" class="custom-control-input" id="customRadiolist4" name="rd1"
                      value="rd1_4" @if(isset($fsReqData['rd1'])&& $fsReqData['rd1']=="rd1_4"){{"checked"}}@endif>
                    <label class="custom-control-label" for="customRadiolist4"
                      style="font-size: 12px!important;cursor:pointer;">サブスク</label>
                  </div>
                </div>
                <div class="radio-rounded d-inline-block" style="margin-left: 12px;">
                  <div class="custom-control custom-radio custom-control-inline"
                    style="padding-left:20px!important;">
                    <input type="radio" class="custom-control-input" id="customRadiolist5" name="rd2"
                      value="rd2_1" @if(isset($fsReqData['rd2'])&& $fsReqData['rd2']=="rd2_1"){{"checked"}}@endif checked="">
                    <label class="custom-control-label" for="customRadiolist5"
                      style="font-size: 12px!important;cursor:pointer;">担当順</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline"
                    style="padding-left:20px!important;">
                    <input type="radio" class="custom-control-input" id="customRadiolist6" name="rd2"
                      value="rd2_2" @if(isset($fsReqData['rd2'])&& $fsReqData['rd2']=="rd2_2"){{"checked"}}@endif>
                    <label class="custom-control-label" for="customRadiolist6"
                      style="font-size: 12px!important;cursor:pointer;">
                      売上予定順</label>
                  </div>
                </div>
              </div>
              <div class="col-2">
                <div class="d-inline-block float-right">
                  <button onclick="firstSearch('{{route('backlogList2')}}',event.preventDefault())" style="width: 150px;height:30px;line-height:30px; margin-right: 10px;"
                    class="btn btn-info">表示</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</form>