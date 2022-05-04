<div class="content-head-section">
    <div class="container" style="position: relative;">
 
        <form id="firstSearch" action="{{ route('orderHistory') }}" method="post">
        <input type="hidden" name="Button" id="firstButton" value="{{isset($old['Button'])?$old['Button']:null}}">
        <!--<input type="hidden" id="fs_sortField" name="sortField" value="{{--isset($old['sortField'])?$old['sortField']:null--}}">
        <input type="hidden" id="fs_sortType" name="sortType" value="{{--isset($old['sortType'])?$old['sortType']:null--}}">-->
        <input type="hidden" id="fs_userId" name="userId" value="{{$bango}}">
        <input type="hidden" id="first_csrf" value="{{csrf_token()}}" name="_token" disabled>
        <input type="hidden" id="source" value="orderHistory"/>
            @csrf

            <div class="row order_entry_topcontent">
              <div class="col">

                <!-- Error Message Starts Here -->
                <div id="error_data" class="common_error"></div>
                
                @if(isset($exceedUser))
                <p id="no_found_data" class="common_error">{{$exceedUser}}</p>
                @endif
                <!-- Error Message Ends Here -->
          
                <div class="content-head-top inner-top-content">
                  
                  <!-- Top search common pull-down layout -->
                  @include('layout.commonOfficeDeptGroup')
                  
                  <div class="row" style="padding-top: 0px;margin-bottom:15px;">
                      <div class="col-6">
                          <table class="table custom-form" style="margin-bottom: 2px!important;width: auto;">
                              <tbody>
                                <tr>
                                  <td style="border: none!important;text-align: left;color: black;width: 94px !important;padding-left:0px!important;">
                                    <div class="line-icon-box float-left mr-3"></div>担当
                                  </td>
                                  <td style="width: 78%!important;text-align: center;border: none!important;">
                                      <div class="custom-arrow">
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
                                </tr>
                              </tbody>
                            </table>
                            <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                              <tbody>
                                <tr>
                                  <td style="border: none!important;text-align: left;color: black;width: 94px !important;padding-left:0px!important;">
                                    <div class="line-icon-box float-left mr-3"></div>受注日
                                  </td>
                                    <td style="border: none!important;width: 151px;">
                                        <div class="input-group">
                                            @php 
                                            $year = date('Y');
                                            $month = date('m');
                                            $last_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                                            //$start_date = $year.'/'.$month.'/'.'01';
                                            //$end_date = $year.'/'.$month.'/'.$last_day;
                                            $start_date = date('Y/m/')."01";
                                            $end_date = date('Y/m/d');
                                            @endphp
                                            <input name="intorder01_start" id="datepicker2_oen" 
                                            oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                            onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" maxlength="8" value="{{isset($fsReqData['intorder01_start'])?$fsReqData['intorder01_start']:$start_date}}" type="text" class="form-control input_field" autocomplete="off" value="" placeholder="年/月/日" maxlength="8" style="width: 96px!important;">
                                            <input type="hidden" class="datePickerHidden">
                                        </div>
                                    </td>
                                    <td style="width: 30px!important;border:0!important;text-align: center;">
                                      ～
                                    </td>
                                    <td style="border: none!important;width: 151px;">
                                      <div class="input-group">
                                        <input name="intorder01_end" id="datepicker1_oen" 
                                        oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value="{{isset($fsReqData['intorder01_end'])?$fsReqData['intorder01_end']:$end_date}}" type="text" class="form-control input_field" autocomplete="off" value="" placeholder="年/月/日" maxlength="8" style="width: 96px!important;">
                                        <input type="hidden" class="datePickerHidden">
                                      </div>
                                    </td>
                                </tr>
                              </tbody>
                            </table>
                            <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;padding-left:0px!important;">
                              <tbody>
                                <tr>
                                  <td style="padding-left:0px !important;border: none!important;text-align: left;color: black;width:94px !important;">
                                    <div class="line-icon-box float-left mr-3"></div>受注番号
                                  </td>
                                  <td style="border: none!important;width: 151px;">
                                      <div class="input-group input-group-sm position-relative" id="kokyakuorderbango_start_err">
                                          <input name="kokyakuorderbango_start" id="orderNumber1" 
                                          oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');"
                                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value="{{isset($fsReqData['kokyakuorderbango_start'])?$fsReqData['kokyakuorderbango_start']:null}}" type="text" class="form-control" maxlength="10" placeholder="受注番号" style="width: 94px!important;padding-left: 0px !important;">
                                        <div class="input-group-append" id="modalarea">
                                          <button class="input-group-text btn " onclick="handleNumberSearchModalOpener('orderNumber1',event.preventDefault())"><i class="fas fa-arrow-left"></i></button>
                                        </div>
                                      </div>
                                    </td>
                                    <td style="width: 30px!important;border:0!important;text-align: center;">
                                      ～
                                    </td>
                                    <td style="border: none!important;width: 151px;">
                                       <div class="input-group input-group-sm position-relative" id="kokyakuorderbango_end_err">
                                      <input name="kokyakuorderbango_end" id="orderNumber2" 
                                      oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');"
                                      onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value="{{isset($fsReqData['kokyakuorderbango_end'])?$fsReqData['kokyakuorderbango_end']:null}}" type="text" maxlength="10" class="form-control" placeholder="受注番号" style="padding-left: 0px !important;width: 80px;">
                                      <div class="input-group-append" id="modalarea">
                                        <button class="input-group-text btn " onclick="handleNumberSearchModalOpener('orderNumber2',event.preventDefault())"><i class="fas fa-arrow-left"></i></button>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                        </div>
                        <div class="ml-3 mr-3">
                          <table class="table custom-form" style="margin-bottom: 0px!important;" id="tbl-supplier">
                              <tbody>

                                <tr>
                                  <td class="text-render" style="border: none!important;color: black;width: 95px !important;">
                                      <div style="width: 91px;">
                                          <div class="line-icon-box float-left mr-3"></div>受注先
                                      </div>
                                    </td>
                                  <td style=" border: none!important;">
                                    <div>
                                      <div class="input-group input-group-sm">
                                        <input name="information1_text" id="tsearch_information1" value="{{isset($fsReqData['information1_text'])?$fsReqData['information1_text']:null}}" type="text" class="form-control custom_modal_input" placeholder="受注先" readonly="" style="padding: 0!important;">
                                        <input name="information1" id="tsearch_information1_db" value="{{isset($fsReqData['information1'])?$fsReqData['information1']:null}}" type="hidden" >
                                        <div class="input-group-append">
                                          <button onclick="supplierSelectionModalOpener('tsearch_information1','tsearch_information1_db','1','nullable','r17_3',event.preventDefault())" class="input-group-text btn" style="cursor: pointer;"><i class="fas fa-arrow-left"></i></button>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                              </tr>
                              <tr>
                                <td class="text-render" style="border: none!important;color: black;width: 95px !important;">
                                    <div style="width: 91px;">
                                        <div class="line-icon-box float-left mr-3"></div>売上請求先
                                    </div>
                                  </td>
                                <td style=" border: none!important;">
                                  <div>
                                    <div class="input-group input-group-sm">
                                      <input name="information2_text" id="tsearch_information2" value="{{isset($fsReqData['information2_text'])?$fsReqData['information2_text']:null}}" type="text" class="form-control custom_modal_input" placeholder="売上請求先" readonly="" style="padding: 0!important;">
                                      <input name="information2" id="tsearch_information2_db" value="{{isset($fsReqData['information2'])?$fsReqData['information2']:null}}" type="hidden" >
                                      <div class="input-group-append">
                                        <button onclick="supplierSelectionModalOpener('tsearch_information2','tsearch_information2_db','1','nullable','r17_3',event.preventDefault())" class="input-group-text btn" style="cursor: pointer;"><i class="fas fa-arrow-left"></i></button>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td class="text-render" style="border: none!important;color: black;width: 95px !important;">
                                    <div style="width: 91px;">
                                        <div class="line-icon-box float-left mr-3"></div>最終顧客
                                    </div>
                                  </td>
                                <td style=" border: none!important;">
                                  <div>
                                    <div class="input-group input-group-sm">
                                      <input name="information3_text" id="tsearch_information3" value="{{isset($fsReqData['information3_text'])?$fsReqData['information3_text']:null}}" type="text" class="form-control custom_modal_input" placeholder="最終顧客" readonly="" style="padding: 0!important;">
                                      <input name="information3" id="tsearch_information3_db" value="{{isset($fsReqData['information3'])?$fsReqData['information3']:null}}" type="hidden" >
                                      <div class="input-group-append">
                                        <button onclick="supplierSelectionModalOpener('tsearch_information3','tsearch_information3_db','3','nullable','r17_3',event.preventDefault())" class="input-group-text btn" style="cursor: pointer;"><i class="fas fa-arrow-left"></i></button>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                                </tbody>
                              </table>


                        </div>
                        <div class="col-1"></div>
                      </div>

                </div>

                <div class="content-head-top content-head-middle">
                  <div class="row" style="margin-top: 25px;margin-bottom:23px;">
                      <div class="col-9">
                      <div class="radio-rounded custom-table-oh d-inline-block" style="margin-top: 5px;">
                          <div class="custom-control custom-radio custom-control-inline" style="padding-left:8px!important;">
                              <input type="radio" class="custom-control-input" id="custmRadio" name="rd1" value="rd1_1" @if(isset($fsReqData['rd1'])&& $fsReqData['rd1']=="rd1_1"){{"checked"}}@endif checked="">
                              <label class="custom-control-label" for="custmRadio" style="font-size: 12px!important;cursor:pointer;">新規</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                              <input type="radio" class="custom-control-input" id="custmRadio2" name="rd1" value="rd1_2" @if(isset($fsReqData['rd1'])&& $fsReqData['rd1']=="rd1_2"){{"checked"}}@endif>
                              <label class="custom-control-label" for="custmRadio2" style="font-size: 12px!important;cursor:pointer;"> 訂正分のみ</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                              <input type="radio" class="custom-control-input" id="custmRadio3" name="rd1" value="rd1_3" @if(isset($fsReqData['rd1'])&& $fsReqData['rd1']=="rd1_3"){{"checked"}}@endif>
                              <label class="custom-control-label" for="custmRadio3" style="font-size: 12px!important;cursor:pointer;">すべて</label>
                            </div>
                      </div>

                          <div class="radio-rounded d-inline-block" style="margin-top: 5px;">
                              <div class="custom-control custom-radio custom-control-inline" style="padding-left: 26px!important;">
                                  <input type="radio" class="custom-control-input" id="customRadio4" name="rd2" value="rd2_1" @if(isset($fsReqData['rd2'])&& $fsReqData['rd2']=="rd2_1"){{"checked"}}@endif checked="">
                                  <label class="custom-control-label" for="customRadio4" style="font-size: 12px!important;cursor:pointer;">  通常</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                                  <input type="radio" class="custom-control-input" id="customRadio5" name="rd2" value="rd2_2" @if(isset($fsReqData['rd2'])&& $fsReqData['rd2']=="rd2_2"){{"checked"}}@endif>
                                  <label class="custom-control-label" for="customRadio5" style="font-size: 12px!important;cursor:pointer;"> 定期定額以外</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                                  <input type="radio" class="custom-control-input" id="customRadio6" name="rd2" value="rd2_3" @if(isset($fsReqData['rd2'])&& $fsReqData['rd2']=="rd2_3"){{"checked"}}@endif>
                                  <label class="custom-control-label" for="customRadio6" style="font-size: 12px!important;cursor:pointer;">保守</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                                  <input type="radio" class="custom-control-input" id="customRadio7" name="rd2" value="rd2_4" @if(isset($fsReqData['rd2'])&& $fsReqData['rd2']=="rd2_4"){{"checked"}}@endif>
                                  <label class="custom-control-label" for="customRadio7" style="font-size: 12px!important;cursor:pointer;"> サブスク</label>
                                </div>
                          </div>

                      </div>
                      <div class="col-3">
                         <div class="d-inline-block float-right">
                             <button onclick="firstSearch('{{route('orderHistory')}}',event.preventDefault())" type="submit" class="btn btn-info uskc-button">表示</button>
                          </div>
                      </div>
                      <div class="col-1"></div>
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
