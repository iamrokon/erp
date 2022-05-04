<?php
$today = date('Y/m/d');
$first_date = date('Y/m/01');
?>

<div class="content-head-section" style="margin-top: 12px;">
  <div class="container" style="position: relative;">
    <!-- Show Success Message -->
    @if(Session::has('status_msg'))
    @php
    $status_msgs = session()->get('status_msg');
    @endphp
    <div class="row success-msg-box" style="position: relative;width:100%; max-width: 1452px; z-index: 1;">
      <div class="col-12">
        <div class="alert alert-primary alert-dismissible">
          <button type="button" class="close dismissMe" data-dismiss="alert" onclick="$('#division_datachar05_start').focus();" autofocus>&times;</button>
          <strong>{{$status_msgs}}</strong><br>
        </div>
      </div>
    </div>
    @endif

    <script>
      // Focus on Alert Closing
      $(".dismissMe").keydown(function(e) {
          if (e.shiftKey && e.which == 13) {
            $('.close').alert('close');
            event.preventDefault();
            document.getElementById("division_datachar05_start").click();
            $('#division_datachar05_start').focus();
          }
      });
    </script>

    <!-- Error Message Starts Here -->
    <div id="error_data" class="common_error"></div>
    <!-- Error Message Ends Here -->

    @if(isset($exceedUser))
    <p id="no_found_data" class="common_error">{{$exceedUser}}</p>
    @endif
    <form id="firstSearch" action="{{ route('salesHistory') }}" method="post">
      <input type="hidden" name="Button" id="firstButton" value="{{isset($old['Button'])?$old['Button']:null}}">
      <input type="hidden" id="fs_sortField" name="sortField"
        value="{{isset($old['sortField'])?$old['sortField']:null}}">
      <input type="hidden" id="fs_sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
      <input type="hidden" id="fs_userId" name="userId" value="{{$bango}}">
      <input type="hidden" id="first_csrf" value="{{csrf_token()}}" name="_token" disabled>
      <input type="hidden" id="source" value="salesHistory" />
      @csrf
      <div class="row order_entry_topcontent inner-top-content">
        <div class="col">

          <div class="content-head-top">

            @include('layout.commonOfficeDeptGroup')

            <div class="row" style="padding-top: 0px; margin-bottom: 25px;">
              <div class="col" style="width: 674px !important; max-width: 674px !important;">
                <table class="table custom-form" style="margin-bottom: 2px!important;width: auto;">
                  <tbody>
                    <tr>
                      <td
                        style="border: none!important;text-align: left;color: black;width: 95px !important;padding-left:0px!important;">
                        <div class="line-icon-box float-left mr-3"></div>担当者
                      </td>
                      <td style="width: 74%!important;text-align: center;border: none!important;">
                        <div class="custom-arrow">
                          <select name="datachar05" id="datachar05" class="form-control">
                            <option value="">-</option>
                            @foreach($datachar05 as $dtchar05)
                            @if(isset($fsReqData['datachar05']))
                            <option value="{{$dtchar05->bango}}" @if($dtchar05->
                              bango==$fsReqData['datachar05']){{'selected'}}@endif>
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
                      <td
                        style="border: none!important;text-align: left;color: black;width: 95px !important;padding-left:0px!important;">
                        <div class="line-icon-box float-left mr-3"></div>処理日付
                      </td>
                        {{--@php
                            /*dd(array_key_exists("date_start",$fsReqData),$fsReqData);*/
                            dd(isset($fsReqData['date_start']));
                        @endphp--}}
                      <td style="border: none!important;width: 151px;">
                        <div class="input-group">
                          <input id="date_start" type="text" class="form-control input_field"
                            onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                            oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                            maxlength="10" autocomplete="off" placeholder="年/月/日" style="width: 96px!important;"
                            name="date_start"
                            value="{{ isset($fsReqData)?$fsReqData['date_start']:$first_date}}">
                          <input type="hidden" class="datePickerHidden">
                        </div>
                      </td>
                      <td style="width: 30px!important;border:0!important;text-align: center;">
                        ～
                      </td>
                      <td style="border: none!important;width: 151px;">
                        <div class="input-group">
                          <input id="date_end" type="text" class="form-control input_field"
                            onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                            oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                            maxlength="10" autocomplete="off" placeholder="年/月/日" style="width: 96px!important;"
                            name="date_end" value="{{ isset($fsReqData)?$fsReqData['date_end']:$today}}">
                          <input type="hidden" class="datePickerHidden">
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                  <tbody>
                    <tr>
                      <td
                        style="border: none!important;text-align: left;color: black;width: 95px !important;padding-left:0px!important;">
                        <div class="line-icon-box float-left mr-3"></div>売上日
                      </td>
                      <td style="border: none!important;width: 151px;">
                        <div class="input-group">
                          <input id="intorder03_start" type="text" class="form-control input_field"
                            onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                            oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                            maxlength="10" autocomplete="off" placeholder="年/月/日" style="width: 96px!important;"
                            name="intorder03_start"
                            value="{{ isset($fsReqData)?$fsReqData['intorder03_start']:$first_date}}">
                          <input type="hidden" class="datePickerHidden">
                        </div>
                      </td>
                      <td style="width: 30px!important;border:0!important;text-align: center;">
                        ～
                      </td>
                      <td style="border: none!important;width: 151px;">
                        <div class="input-group">
                          <input id="intorder03_end" type="text" class="form-control input_field"
                            onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                            oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                            maxlength="10" autocomplete="off" placeholder="年/月/日" style="width: 96px!important;"
                            name="intorder03_end"
                            value="{{ isset($fsReqData)?$fsReqData['intorder03_end']:$today}}">
                          <input type="hidden" class="datePickerHidden">
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                  <tbody>
                    <tr>
                      <td
                        style="border: none!important;text-align: left;color: black;width:95px !important;padding-left:0px!important;">
                        <div class="line-icon-box float-left mr-3"></div>売上番号
                      </td>
                      <td style="border: none!important;width: 151px;">
                        <div class="input-group input-group-sm position-relative" id="juchukubun_start_err">
                          <input type="text" class="form-control"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"
                            maxlength="10" placeholder="" style="width: 94px!important;padding-left: 0px !important;"
                            id="juchukubun_start" name="juchukubun_start"
                            value="{{ isset($fsReqData['juchukubun_start'])?$fsReqData['juchukubun_start']:''}}">
                        </div>
                      </td>
                      <td style="width: 30px!important;border:0!important;text-align: center;">
                        ～
                      </td>
                      <td style="border: none!important;width: 151px;">
                        <div class="input-group input-group-sm position-relative" id="juchukubun_end_err">
                          <input type="text" class="form-control"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"
                            maxlength="10" placeholder="" style="padding-left: 0px !important;width: 80px;"
                            id="juchukubun_end" name="juchukubun_end"
                            value="{{isset($fsReqData['juchukubun_end'])?$fsReqData['juchukubun_end']:''}}">
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col" style="width: 674px !important; max-width: 674px !important;">
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
                          <div class="input-group input-group-sm custom_modal_input">
                            <input type="text" name="information1_detail" id="tsearch_information1"
                              value="{{isset($fsReqData['information1_detail'])?$fsReqData['information1_detail']:null}}"
                              class="form-control" readonly="" style="padding: 0!important;">
                            <input name="information1_db" id="tsearch_information1_db"
                              value="{{isset($fsReqData['information1_db'])?$fsReqData['information1_db']:null}}"
                              type="hidden">
                            <div class="input-group-append" data-toggle="modal" data-target="#search_modal4" style="margin-left: 0px !important;">
                              <button
                                onclick="supplierSelectionModalOpener_2('tsearch_information1','tsearch_information1_db','1','nullable','r16cd',event.preventDefault())"
                                class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
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
                      <td style=" border: none!important;width: 443px;">
                        <div style="width: 443px;">
                          <div class="input-group input-group-sm custom_modal_input">
                            <input type="text" name="information2_detail" id="tsearch_information2"
                              value="{{isset($fsReqData['information2_detail'])?$fsReqData['information2_detail']:null}}"
                              class="form-control" readonly="" style="padding: 0!important;width: 90px !important;">
                            <input name="information2_db" id="tsearch_information2_db"
                              value="{{isset($fsReqData['information2_db'])?$fsReqData['information2_db']:null}}"
                              type="hidden">
                            <div class="input-group-append" data-toggle="modal" data-target="#search_modal4" style="margin-left: 0px !important;">
                              <button
                                onclick="supplierSelectionModalOpener_2('tsearch_information2','tsearch_information2_db','1','nullable','r16cd',event.preventDefault())"
                                class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
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
                      <td style=" border: none!important;width: 443px;">
                        <div style="width: 443px;">
                          <div class="input-group input-group-sm custom_modal_input">
                            <input type="text" name="information3_detail" id="tsearch_information3"
                              value="{{isset($fsReqData['information3_detail'])?$fsReqData['information3_detail']:null}}"
                              class="form-control" readonly="" style="padding: 0!important;width: 90px !important;">
                            <input name="information3_db" id="tsearch_information3_db"
                              value="{{isset($fsReqData['information3_db'])?$fsReqData['information3_db']:null}}"
                              type="hidden">
                            <div class="input-group-append" data-toggle="modal" data-target="#search_modal4" style="margin-left: 0px !important;">
                              <button
                                onclick="supplierSelectionModalOpener_2('tsearch_information3','tsearch_information3_db','3','nullable','r16cd',event.preventDefault())"
                                class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td style="border: none!important;text-align: left;color: black;width: 93px !important;">
                        <div class="line-icon-box float-left mr-3"></div>売上区分
                      </td>
                      <td style="width: 72%!important;text-align: center;border: none!important;">
                        <div class="custom-arrow" style="width: 35%">
                          <select class="form-control" name="text1">
                            <option value="">-</option>
                            @foreach($text1s as $text1)
                            @if(isset($fsReqData['text1']))
                            <option value="{{$text1->value}}" @if($text1->
                              value==$fsReqData['text1']){{'selected'}}@endif>
                              {{$text1->option}}
                            </option>
                            @else
                            @if(isset($fsReqData) && count($fsReqData)>0)
                            <option value="{{$text1->value}}">
                              {{$text1->option}}
                            </option>
                            @else
                            <option value="{{$text1->value}}" @if($text1->value == "U510"){{'selected'}}@endif>
                              {{$text1->option}}
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
              </div>
              {{-- <div class="col-1"></div> --}}
            </div>
            <div class="row">
              <div class="col-12">
                <div class="w-100 float-right "
                  style="border-bottom: 1px solid #E1E1E1; border-top: 1px solid #E1E1E1;">
                  @if($privileged_user)
                  <div class="buttom-btn mt-4 mb-4 ml-2 d-inline float-right">
                    <button
                      onclick="updateSelectedSalesBango('{{route('updateSelectedSalesHistory')}}',event.preventDefault())"
                      type="submit" id="updateButton" class="btn btn-info uskc-button">登録</button>
                  </div>
                  @endif

                  <div class="buttom-btn mt-4 mb-4 d-inline float-right">
                    <button onclick="firstSearch('{{route('salesHistory')}}',event.preventDefault())" type="submit"
                      class="btn btn-info uskc-button">表示</button>
                  </div>

                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
    </form>
  </div>
</div>
