<?php
$today = date('Y/m/d');
?>
<div class="content-head-section" style="margin-top:12px;">
        <div class="container" style="position: relative;">
          
          {{-- Success Message Starts Here --}}
          @if(Session::has('status_msg'))
          @php
          $status_msgs = session()->get('status_msg');
          @endphp
          <div class="row success-msg-box" style="position: relative; width: 100%; max-width: 1452px; z-index: 1;">
            <div class="col-12">
              <div class="alert alert-primary alert-dismissible">
                <button type="button" class="close" autofocus data-dismiss="alert" onclick="$('#torikomidate_start').focus();">&times;</button>
                <strong>{{$status_msgs}}</strong><br>
              </div>
            </div>
          </div>
          @endif
          {{-- Success Message Ends Here --}}

          <form id="firstSearch" action="{{ route('depositHistory') }}" method="post">
          <input type="hidden" name="Button" id="firstButton" value="{{isset($old['Button'])?$old['Button']:null}}">
          <input type="hidden" id="fs_sortField" name="sortField" value="{{isset($old['sortField'])?$old['sortField']:null}}">
          <input type="hidden" id="fs_sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
          <input type="hidden" id="fs_userId" name="userId" value="{{$bango}}">
          <input type="hidden" id="first_csrf" value="{{csrf_token()}}" name="_token" disabled>
          <input type="hidden" id="source" value="depositHistory"/>
          @csrf
          <div class="row order_entry_topcontent">
            <div class="col">
              
              <!-- Error Message Starts Here -->
              <div id="error_data" class="common_error"></div>
              
              @if(isset($exceedUser))
              <p id="no_found_data" class="common_error">{{$exceedUser}}</p>
              @endif
              <!-- Error Message Ends Here -->

              <div class="content-head-top inner-top-content" style="border-bottom: 1px solid #E1E1E1;padding-bottom: 20px;">

                <div class="row mb-2" style="padding-top: 0px;">
                    <div class="col-5">
                        <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                            <tbody>
                              <tr>
                                <td style="border: none!important;text-align: left;color: black;width:123px !important;padding-left: 0px !important;">
                                  <div class="line-icon-box float-left mr-3"></div>入金日
                                </td>
                                  <td style="border: none!important;width: 151px;">
                                    <div class="input-group">
                                        <input name="torikomidate_start" id="torikomidate_start" autofocus="" type="text" class="form-control datePicker orderDate" oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                           onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                               maxlength="10"
                                               autocomplete="off" placeholder="年/月/日"
                                               style="width: 96px!important;" value="{{ isset($fsReqData['torikomidate_start'])?$fsReqData['torikomidate_start']:$today}}">
                                        <input type="hidden" class="datePickerHidden" value="{{ isset($fsReqData['torikomidate_start'])?$fsReqData['torikomidate_start']:$today}}">

                                    </div>
                                  </td>
                                  <td style="width: 30px!important;border:0!important;text-align: center;">
                                    ～
                                  </td>
                                  <td style="border: none!important;width: 151px;">
                                    <div class="input-group">
                                        <input name="torikomidate_end" id="torikomidate_end" type="text" class="form-control datePicker orderDate" oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                           onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                               maxlength="10"
                                               autocomplete="off" placeholder="年/月/日"
                                               style="width: 96px!important;" value="{{ isset($fsReqData['torikomidate_end'])?$fsReqData['torikomidate_end']:$today}}">
                                        <input type="hidden" class="datePickerHidden">

                                    </div>
                                  </td>
                              </tr>
                              <tr>
                                <td style="border: none!important;text-align: left;color: black;width: 123px !important;padding-left: 0px !important;">
                                  <div class="line-icon-box float-left mr-3"></div>処理日
                                </td>
                                  <td style="border: none!important;width: 151px;">
                                    <div class="input-group">
                                        <input name="nyukinbi2_start" id="nyukinbi2_start" type="text" class="form-control datePicker orderDate" oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                           onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                               maxlength="10"
                                               autocomplete="off" placeholder="年/月/日"
                                               style="width: 96px!important;" value="{{ isset($fsReqData['nyukinbi2_start'])?$fsReqData['nyukinbi2_start']:$today}}">
                                        <input type="hidden" class="datePickerHidden">

                                    </div>
                                  </td>
                                  <td style="width: 30px!important;border:0!important;text-align: center;">
                                    ～
                                  </td>
                                  <td style="border: none!important;width: 151px;">
                                    <div class="input-group">
                                        <input name="nyukinbi2_end" id="nyukinbi2_end" type="text" class="form-control datePicker orderDate" oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                           onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                               maxlength="10"
                                               autocomplete="off" placeholder="年/月/日"
                                               style="width: 96px!important;" value="{{ isset($fsReqData['nyukinbi2_end'])?$fsReqData['nyukinbi2_end']:$today}}">
                                        <input type="hidden" class="datePickerHidden">

                                    </div>
                                  </td>
                              </tr>
                            </tbody>
                          </table>
                      </div>
                      <div class="col-1"></div>
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <table class="table custom-form" style="margin-bottom: 0px!important;" id="tbl-supplier">
                            <tbody>

                              <tr>
                                <td class="text-render" style="border: none!important;color: black;padding-left: 0px !important;">
                                    <div style="width: 121px;">
                                        <div class="line-icon-box float-left mr-3"></div>売上請求先
                                    </div>
                                  </td>
                                <td style=" border: none!important;">
                                  <div class="custom_modal_input ">
                                    <div class="input-group input-group-sm">
                                        <input type="text" name="information1_detail" id="tsearch_information1" value="{{isset($fsReqData['information1_detail'])?$fsReqData['information1_detail']:null}}" class="form-control" readonly="" style="padding: 0!important;width: 90px !important;padding-right: 0px !important;max-width:507px!important;">
                                        <input name="information1_db" id="tsearch_information1_db" value="{{isset($fsReqData['information1_db'])?$fsReqData['information1_db']:null}}" type="hidden" >
                                        <div class="input-group-append" data-toggle="modal" data-target="#search_modal4">
                                          <button onclick="supplierSelectionModalOpener_2('tsearch_information1','tsearch_information1_db','1','nullable','r16cd',event.preventDefault())" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                                        </div>
                                    </div>
                                  </div>
                                </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
              </div>
              <div class="content-head-middle">
                <div class="row mb-3 mt-4">
                    <div class="col-8">
                    <!-- <div class="radio-rounded custom-table-oh d-inline-block">
                        <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                            <input type="radio" class="custom-control-input" id="customRadio" name="shinkurokokyakuorderbango" value="1" @if(isset($fsReqData['shinkurokokyakuorderbango'])&& $fsReqData['shinkurokokyakuorderbango']=="1"){{"checked"}}@endif checked="">
                            <label class="custom-control-label" for="customRadio" style="font-size: 12px!important;cursor:pointer;">新規</label>
                          </div>
                          <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                            <input type="radio" class="custom-control-input" id="customRadio2" name="shinkurokokyakuorderbango" value="2" @if(isset($fsReqData['shinkurokokyakuorderbango'])&& $fsReqData['shinkurokokyakuorderbango']=="2"){{"checked"}}@endif>
                            <label class="custom-control-label" for="customRadio2" style="font-size: 12px!important;cursor:pointer;"> 訂正分のみ</label>
                          </div>
                          <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                            <input type="radio" class="custom-control-input" id="customRadio3" name="shinkurokokyakuorderbango" value="3" @if(isset($fsReqData['shinkurokokyakuorderbango'])&& $fsReqData['shinkurokokyakuorderbango']=="3"){{"checked"}}@endif>
                            <label class="custom-control-label" for="customRadio3" style="font-size: 12px!important;cursor:pointer;">すべて</label>
                          </div>
                    </div>

                    <div class="radio-rounded d-inline-block">
                        <div class="custom-control custom-radio custom-control-inline" style="padding-left: 26px!important;">
                            <input type="radio" class="custom-control-input" id="customRadio4" name="unsoutesuryou" value="1" @if(isset($fsReqData['unsoutesuryou'])&& $fsReqData['unsoutesuryou']=="1"){{"checked"}}@endif checked="">
                            <label class="custom-control-label" for="customRadio4" style="font-size: 12px!important;cursor:pointer;">  通常</label>
                          </div>
                          <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                            <input type="radio" class="custom-control-input" id="customRadio5" name="unsoutesuryou" value="2" @if(isset($fsReqData['unsoutesuryou'])&& $fsReqData['unsoutesuryou']=="2"){{"checked"}}@endif>
                            <label class="custom-control-label" for="customRadio5" style="font-size: 12px!important;cursor:pointer;"> 前受</label>
                          </div>
                          <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                            <input type="radio" class="custom-control-input" id="customRadio6" name="unsoutesuryou" value="3" @if(isset($fsReqData['unsoutesuryou'])&& $fsReqData['unsoutesuryou']=="3"){{"checked"}}@endif>
                            <label class="custom-control-label" for="customRadio6" style="font-size: 12px!important;cursor:pointer;">前受振替</label>
                          </div>
                    </div> -->

                    </div>
                    <div class="col-4">
                       <div class="d-inline-block float-right">
                          <button onclick="firstSearch('{{route('depositHistory')}}',event.preventDefault())" type="submit" class="btn btn-info uskc-button">表示</button>
                       </div>
                    </div>
                   
                  </div>

              </div>
            </div>
          </div>
          </form>
        </div>
      </div>
