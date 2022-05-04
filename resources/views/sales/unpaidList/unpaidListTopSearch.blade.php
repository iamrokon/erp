<div class="content-head-section">
    <div class="container" style="position: relative;">
        <form id="firstSearch" action="{{ route('unpaidList') }}" method="post">
            <input type="hidden" name="Button" id="firstButton" value="{{isset($old['Button'])?$old['Button']:null}}">
            <input type="hidden" id="fs_sortField" name="sortField" value="{{isset($old['sortField'])?$old['sortField']:null}}">
            <input type="hidden" id="fs_sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
            <input type="hidden" id="fs_userId" name="userId" value="{{$bango}}">
            <input type="hidden" id="first_csrf" value="{{csrf_token()}}" name="_token" disabled>
            @csrf
        

        <div class="row order_entry_topcontent uncollected-list ">
            <div class="col">
                
                <!-- Show Update Message -->
                @if(Session::has('update_msg'))
                @php
                $update_msgs = session()->get('update_msg');
                @endphp
                <div id="update-success-msg" class="row success-msg-box" style="position: relative; width:100%;max-width: 1452px;z-index: 1;">
                  <div class="col-12">
                    <div class="alert alert-primary alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" autofocus
                      onclick="$('#division_datachar05_start').focus();">&times;</button>
                      @foreach($update_msgs as $key=>$val)
                      <strong>{{$val}}</strong><br>
                      @endforeach
                    </div>
                  </div>
                </div>
                @endif

                @if(isset($exceedUser))
                <p class="common_error" id="no_found_data">{{$exceedUser}}</p>
                @endif         

                <!-- Error Message Starts Here -->
                <div class="common_error" id="error_data"></div>
                <!-- Error Message Ends Here -->

                <div class="content-head-top inner-top-content" style="padding-bottom: 20px;">
                    
                    <!-- Top search common pull-down layout -->
                    @include('layout.commonOfficeDeptGroup')
                    
                    <div class="row">
                      <div class="col">
                        <table class="table custom-form" style="width:auto;">
                            <tbody>
                                <tr>
                                    <td style="border: none!important;text-align: left;color: black;padding-left:0px!important;">
                                      <div class="line-icon-box float-left mr-3"></div>担当
                                    </td>
                                    <td style="border: none!important;">
                                        <div class="custom-arrow">
                                            <select class="form-control" name="datachar05" id="search_datachar05">
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
                                <tr>
                                  <td style="border: none!important;text-align: left;color: black;width: 95px !important;padding-left:0px!important;">
                                    <div class="line-icon-box float-left mr-3"></div>入金予定日
                                  </td>
                                  <td style="border: none!important;width: 270px !important;">
                                      <div class="input-group">
                                          <input name="intorder05_start" type="text" class="form-control" id="datepicker1_oen"
                                          oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                          maxlength="10" autocomplete="off" placeholder="年/月/日" style=""
                                          value="{{isset($fsReqData['intorder05_start'])?$fsReqData['intorder05_start']:""}}">
                                        <input type="hidden" class="datePickerHidden">
                                      </div>
                                  </td>
                                  <td style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
                                      ～
                                    </td>
                                  <td style="border: none!important;width: 270px !important;">
                                      <div class="input-group">
                                        <input name="intorder05_end" type="text" class="form-control" id="datepicker2_oen"
                                          oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                          maxlength="10" autocomplete="off" placeholder="年/月/日" style=""
                                          value="{{isset($fsReqData['intorder05_end'])?$fsReqData['intorder05_end']:""}}">
                                        <input type="hidden" class="datePickerHidden">
                                      </div>
                                  </td>
                                </tr>
                                <td style="border: none!important;text-align: left;color: black;padding-left:0px!important;">
                                  <div class="line-icon-box float-left mr-3"></div>売上日
                                </td>
                                <td style="border: none!important;width: 270px !important;">
                                    <div class="input-group">
                                      <input name="intorder03_start" type="text" class="form-control" id="datepicker3_oen"
                                        oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                        maxlength="10" autocomplete="off" placeholder="年/月/日" style=""
                                        value="{{isset($fsReqData['intorder03_start'])?$fsReqData['intorder03_start']:""}}">
                                      <input type="hidden" class="datePickerHidden">
                                    </div>
                                </td>
                                <td style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
                                    ～
                                  </td>
                                <td style="border: none!important;width: 270px !important;">
                                    <div class="input-group">
                                      <input name="intorder03_end" type="text" class="form-control" id="datepicker4_oen"
                                        oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                        maxlength="10" autocomplete="off" placeholder="年/月/日" style=""
                                        value="{{isset($fsReqData['intorder03_end'])?$fsReqData['intorder03_end']:""}}">
                                      <input type="hidden" class="datePickerHidden">
                                    </div>
                                </td>
                            </tbody>
                        </table>
                      </div>
                    </div>
                </div>

                <div class="content-head-top">
                  <div class="row mb-4 mt-4">
                      <div class="col-8">
                      <div class="radio-rounded custom-table-oh d-inline-block">
                          <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                              <input type="radio" class="custom-control-input" id="customRadio" name="rd1" value="rd1_1" @if(isset($fsReqData['rd1'])&& $fsReqData['rd1']=="rd1_1"){{"checked"}}@endif checked="">
                              <label class="custom-control-label" for="customRadio" style="font-size: 12px!important;cursor:pointer;">@if(isset($mode_selection[0])){{$mode_selection[0]->jouhou}}@endif</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                              <input type="radio" class="custom-control-input" id="customRadio2" name="rd1" value="rd1_2" @if(isset($fsReqData['rd1'])&& $fsReqData['rd1']=="rd1_2"){{"checked"}}@endif>
                              <label class="custom-control-label" for="customRadio2" style="font-size: 12px!important;cursor:pointer;"> @if(isset($mode_selection[1])){{$mode_selection[1]->jouhou}}@endif</label>
                            </div>
                          
                          <!--
                            <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                              <input type="radio" class="custom-control-input" id="customRadio3" name="rd1" value="rd1_3" @if(isset($fsReqData['rd1'])&& $fsReqData['rd1']=="rd1_3"){{--"checked"--}}@endif>
                              <label class="custom-control-label" for="customRadio3" style="font-size: 12px!important;cursor:pointer;">@if(isset($mode_selection[2])){{--$mode_selection[2]->jouhou--}}@endif</label>
                            </div>
                            -->
                      </div>

                          <div class="radio-rounded d-inline-block">
                              <div class="custom-control custom-radio custom-control-inline" style="padding-left: 26px!important;">
                                  <input type="radio" class="custom-control-input" id="customRadio4" name="rd2" value="rd2_1" @if(isset($fsReqData['rd2'])&& $fsReqData['rd2']=="rd2_1"){{"checked"}}@endif checked="">
                                  <label class="custom-control-label" for="customRadio4" style="font-size: 12px!important;cursor:pointer;">  @if(isset($display_order[0])){{$display_order[0]->jouhou}}@endif</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                                  <input type="radio" class="custom-control-input" id="customRadio5" name="rd2" value="rd2_2" @if(isset($fsReqData['rd2'])&& $fsReqData['rd2']=="rd2_2"){{"checked"}}@endif>
                                  <label class="custom-control-label" for="customRadio5" style="font-size: 12px!important;cursor:pointer;"> @if(isset($display_order[1])){{$display_order[1]->jouhou}}@endif</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                                  <input type="radio" class="custom-control-input" id="customRadio6" name="rd2" value="rd2_3" @if(isset($fsReqData['rd2'])&& $fsReqData['rd2']=="rd2_3"){{"checked"}}@endif>
                                  <label class="custom-control-label" for="customRadio6" style="font-size: 12px!important;cursor:pointer;">@if(isset($display_order[2])){{$display_order[2]->jouhou}}@endif</label>
                                </div>

                          </div>

                      </div>
                      <div class="col-1"></div>
                      <div class="col-3">
                         <div class="d-inline-block float-right">
                              <button onclick="firstSearch('{{route('unpaidList')}}',event.preventDefault())" type="submit" class="btn btn-info uskc-button">表 示</button>
                          </div>
                      </div>

                    </div>

                </div>
                <div class="content-head-bottom">
                  <div class="row mb-2 mt-2">
                      <div class="col">

                      </div>
                  </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>