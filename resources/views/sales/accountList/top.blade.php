<div class="content-head-section1">
  <div class="container position-relative">
    <form id="firstSearch" action="{{ route('accountList') }}" method="post">
      <input type="hidden" name="Button" id="firstButton" value="{{ isset($old['Button']) ? $old['Button'] : null }}">
      <input type="hidden" id="fs_sortField" name="sortField" value="{{ isset($old['sortField']) ? $old['sortField'] : null }}">
      <input type="hidden" id="fs_sortType" name="sortType" value="{{ isset($old['sortType']) ? $old['sortType'] : null }}">
      <input type="hidden" id="fs_userId" name="userId" value="{{ $bango }}">
      <input type="hidden" id="first_csrf" value="{{ csrf_token() }}" name="_token" disabled>
      @csrf

      {{-- Error Message Starts Here --}}
      <div  class="common_error" id="search_error_data">
        @if(isset($exceedUser) && $exceedUser != '')
          {{ $exceedUser }}
        @endif
      </div>
      {{-- Error Message Ends Here --}}

      <div class="row  inner-top-content">
        <div class="col-lg-12">
          <div>
            <div class="row">
              <div class="col-12">
                <!-- box design for table view -->
                <div class="row">
                  <div class="col-lg-12">
                    <div id="payment_history_inquiry_content_1">
                      <div class="row outer">
                        <div class="col-2">
                          <table class="table custom-form">
                            <tbody>
                              <tr>
                                <td style="width: 23px!important;border:0!important;">
                                  <div class="line-icon-box"></div>
                                </td>
                                <td style="width: 65px!important;border: none!important;text-align: left;color: black;">
                                  年月
                                </td>
                                <td style="border: none !important;">
                                  <div>
                                    <input id="date" type="text" name="date" value="{{ isset($fsReqData['date']) ? $fsReqData['date'] : date("Y/m") }}" class="form-control datePicker datePicker1_1"
                                    autocomplete="off" placeholder="年/月"
                                    {{-- oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');" --}}
                                    oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2})/g, '$1$2').replace(/([\d]{6})([\d]{1,2})?/g, '$1');"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                    maxlength="7" autofocus>
                                    <input type="hidden" class="datePickerHidden" value="{{ isset($fsReqData['date']) ? $fsReqData['date'] : date("Y/m") }}" />
                                  </div>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <table class="table custom-form" style="margin-bottom: 30px!important;">
                            <tbody>
                              <tr>
                                <td style="width:23px !important;border:0!important;">
                                  <div class="line-icon-box"></div>
                                </td>
                                <td style="width:65px !important;border: none!important;text-align: left;color: black;">売上請求先</td>
                                <td style=" border: none!important;width: 399px;">
                                  <div style="width: 100%;">
                                    <div class="input-group input-group-sm" id="information2_1_err_msg">
                                      <input type="text" class="form-control" name="information2_1_text" id="tsearch_information2_1" value="{{ isset($fsReqData['information2_1_text']) ? $fsReqData['information2_1_text'] : null }}" readonly="">
                                      <input type="hidden" name="information2_1_short" id="tsearch_information2_1_db" value="{{ isset($fsReqData['information2_1_short']) ? $fsReqData['information2_1_short'] : null }}">
                                      <div class="input-group-append" >
                                        <button class="input-group-text btn" onclick="supplierSelectionModalOpener_2('tsearch_information2_1','tsearch_information2_1_db','1','nullable','r16cd',event.preventDefault())" ><i class="fas fa-arrow-left"></i></button>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                                <td style="border: none!important;width: 37px; text-align: center;">
                                  ～
                                </td>
                                <td style=" border: none!important;width: 399px;">
                                  <div style="width: 100%;">
                                    <div class="input-group input-group-sm" id="information2_2_err_msg">
                                      <input type="text" class="form-control" name="information2_2_text" id="tsearch_information2_2" value="{{ isset($fsReqData['information2_2_text']) ? $fsReqData['information2_2_text'] : null }}" readonly="">
                                      <input type="hidden" name="information2_2_short" id="tsearch_information2_2_db" value="{{ isset($fsReqData['information2_2_short']) ? $fsReqData['information2_2_short'] : null }}">
                                      <div class="input-group-append" >
                                        <button class="input-group-text btn" onclick="supplierSelectionModalOpener_2('tsearch_information2_2','tsearch_information2_2_db','1','nullable','r16cd',event.preventDefault())" ><i class="fas fa-arrow-left"></i></button>
                                      </div>
                                    </div>
                                  </div>
                                </td>                        
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="row">
                      <div class="col">
                      <div class="text-right content-button-section" style="margin-top: 17px;margin-bottom: 47px;margin-right: 12px;border-top: 1px solid #e1e1e1;border-bottom: 1px solid #e1e1e1;padding-top: 25px;padding-bottom: 25px;">
                         <button type="submit" onclick="firstSearch('{{ route('accountList') }}',event.preventDefault())" class="btn btn-info uskc-button">表示</button>
                         <button style="width: 150px;height:30px;line-height:30px;" href="#" class="btn btn-info" id="pdfCreationBtn">PDF作成</button>                              
                      </div>
                      </div>
                    </div>
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