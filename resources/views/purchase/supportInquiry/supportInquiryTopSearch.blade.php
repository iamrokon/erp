
<div class="content-head-section" style="padding: 13px 0 0;">
  <div class="container position-relative">
         {{-- Success Message Starts Here --}}
      
         <div class="row success-msg-box d-none" style="position: relative; width: 100%; max-width: 1452px; z-index: 1;" >
          <div class="col-12">
            <div class="alert alert-primary alert-dismissible">
              <button type="button" class="close dismissAlertMessage"  autofocus>&times;</button>
              <strong>Success alert</strong>
            </div>
          </div>
        </div>
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
        <div id="error_data" style="color: red;position: relative;"></div>
    </div>
  </div>
  {{-- Error Message Ends Here --}}
    <div class="row order_entry_topcontent support-inquiry-top">
      
      <div class="col">
        <div class="content-head-top" style="margin-bottom: 4px;">
          <div class="row">
            <div class="ml-3 mr-3">
              <table class="table custom-form custom-table"
                style="border: none!important;margin-bottom:4px !important;">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 72px!important;">作成区分</td>
                    <td style=" border: none!important;width: 142px;">
                      <div class="custom-arrow">
                        <input type="text" value='@if(isset($supportInquiryData->intorder04_detail)){{$supportInquiryData->intorder04_detail}}@endif' class="form-control" placeholder="" readonly=""
                            style="width: 138px!important;padding: 0!important;">
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="ml-3 mr-3">
              <table class="table custom-form custom-table"
                style="border: none!important;width: auto;margin-bottom:4px !important">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 85px!important;">サポート番号</td>
                    <td style=" border: none!important;width: 132px">
                        <input type="text" name="" value='@if(isset($supportInquiryData->support_number)){{$supportInquiryData->support_number}}@endif' class="form-control" placeholder="" readonly="">
                    </td>
                    <td style=" border: none!important;width: 45px;padding-left:7px!important;">
                      <input type="text" name="" value='@if(isset($supportInquiryData->ordertypebango2)){{$supportInquiryData->ordertypebango2}}@endif' class="form-control" placeholder="" readonly="">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="ml-3 mr-3">
              <table class="table custom-form"
                style="border: none!important;width: auto;margin-bottom:4px !important;">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 53px!important;">受注番号</td>
                    <td style=" border: none!important;width: 159px;">
                      <input type="text" name="" value='@if(isset($supportInquiryData->orderuserbango)){{$supportInquiryData->orderuserbango}}@endif' class="form-control" placeholder="" readonly="">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row" style="margin-bottom: 4px;">
            <div class="ml-3 mr-3">
              <table class="table custom-form" style="margin-bottom: 0px!important;" id="tbl-supplier">
                <tbody>
                  <tr>
                    <td class="text-render" style="border: none!important;color: black;width: 96px !important;padding-left:0px!important;">
                      <div>
                        <div class="line-icon-box float-left mr-3"></div>受注先
                      </div>
                    </td>
                    <td style=" border: none!important;">
                      <div style="width: 443px;">
                        <div class="input-group input-group-sm">
                          <input type="text" value='@if(isset($supportInquiryData->datachar10)){{$supportInquiryData->datachar10_detail}}@endif' class="form-control" placeholder="受注先" readonly=""
                            style="padding: 0!important;">

                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="ml-1 mr-3">
              <table class="table custom-form" style="margin-bottom: 0px!important;" id="tbl-supplier">
                <tbody>
                  <tr>
                    <td class="text-render" style="border: none!important;color: black;width: 133px !important;padding-left: 24px!important;">
                      <div style="width: 97px;">
                        <div class="line-icon-box float-left mr-3"></div>最終顧客
                      </div>
                    </td>
                    <td style=" border: none!important;width: 395px;">
                      <div style="width: 393px;">
                        <div class="input-group input-group-sm">
                          <input type="text" value='@if(isset($supportInquiryData->datachar11)){{$supportInquiryData->datachar11_detail}}@endif' class="form-control" placeholder="最終顧客" readonly=""
                            style="padding: 0!important;">

                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row mb-2" style="padding-top: 0px;">
            <div class="ml-3 mr-3">
              <table class="table custom-form custom-table" style="margin-bottom: 2px!important;">
                <tbody>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;width: 96px !important;padding-left:0px!important;">
                      <div class="line-icon-box float-left mr-3"></div>受注日
                    </td>
                    <td style="border: none!important; width: 143px;">
                      <div class="input-group">
                        <input type="text" value='@if(isset($supportInquiryData->intorder01)){{$supportInquiryData->intorder01}}@endif' class="form-control" id="datepicker1_oen" readonly=""
                          maxlength="10" autocomplete="off" placeholder="年/月/日" style="">
                        
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="ml-3 mr-3">
              <table class="table custom-form custom-table" style="width: auto;margin-bottom: 2px!important;">
                <tbody>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;width: 94px !important;">
                      <div class="line-icon-box float-left mr-3"></div>納期
                    </td>
                    <td style="border: none!important;width: 143px;">
                      <div class="input-group">
                        <input type="text" value='@if(isset($supportInquiryData->intorder02)){{$supportInquiryData->intorder02}}@endif' class="form-control" id="datepicker2_oen" readonly=""
                          maxlength="10" autocomplete="off" placeholder="年/月/日" style="">
                        <input type="hidden" class="datePickerHidden">
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="ml-3 mr-3">
              <table class="table custom-form custom-table" style="width: auto;margin-bottom: 2px!important;">
                <tbody>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;width: 94px !important;">
                      <div class="line-icon-box float-left mr-3"></div>検収日
                    </td>
                    <td style="border: none!important;width: 143px;">
                      <div class="input-group">
                        <input type="text" value='@if(isset($supportInquiryData->intorder04)){{$supportInquiryData->intorder04}}@endif' class="form-control" id="datepicker3_oen" readonly=""
                          maxlength="10" autocomplete="off" placeholder="年/月/日" style="" >
                        <input type="hidden" class="datePickerHidden">
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="ml-3 mr-3">
              <table class="table custom-form custom-table" style="width: auto;margin-bottom: 2px!important;">
                <tbody>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;width: 94px !important;">
                      <div class="line-icon-box float-left mr-3"></div>売上日
                    </td>
                    <td style="border: none!important;width: 143px;">
                      <div class="input-group">
                        <input type="text" value='@if(isset($supportInquiryData->intorder03)){{$supportInquiryData->intorder03}}@endif' class="form-control" id="datepicker4_oen" readonly=""
                          maxlength="10" autocomplete="off" placeholder="年/月/日" style="" value="">
                        <input type="hidden" class="datePickerHidden">
                      </div>
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
                      <div class="line-icon-box float-left mr-3"></div>入金日
                    </td>
                    <td style="border: none!important;width: 143px;">
                      <div class="input-group">
                        <input type="text" value='@if(isset($supportInquiryData->intorder05)){{$supportInquiryData->intorder05}}@endif' class="form-control" id="datepicker5_oen" readonly=""
                          maxlength="10" autocomplete="off" placeholder="年/月/日" style="" value="">
                        <input type="hidden" class="datePickerHidden">
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div style="border-bottom: 1px solid #E1E1E1;border-top:1px solid #E1E1E1; padding: 10px 0px 12px 0px">
            <div class="row">
              <div class="col-12">
                
                <table class="table custom-form"
                  style="border: none!important;width: auto;margin-bottom: 0px!important;float:right; margin-top: 7px;">
                  <tbody>
                    <tr style="">
                      <td style="width: 23px!important;padding: 0!important;border:0!important;">
                        <div class="line-icon-box"></div>
                      </td>
                      <td style=" border: none!important;width: 60px!important;color: #000; font-size: 0.9em;font-weight:bold;">SE粗利計
                      </td>
                      <td style=" border: none!important;width: 15px!important;"></td>
                      <td style=" border: none!important;width: 50%;color: #000;font-size: 0.9em;font-weight:bold;">¥ @if(isset($supportInquiryData->sum_of_syouhizeiritu)){{$supportInquiryData->formatted_sum_of_syouhizeiritu}}@endif</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    
        </div>
      </div>
    </div>
  </div>
</div>