
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
    <div class="row order_entry_topcontent purchase-inquiry-top custom-mb">

      <div class="col">
        <div class="content-head-top" style="margin-bottom: 0px!important;">
          <div class="row">
            <div class="col">
              <table class="table custom-form custom-table"
                style="border: none!important;width: auto;margin-bottom:4px !important;">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 79px!important;">仕入区分</td>
                    <td style=" border: none!important;width: 202px;">
                    <input type="text" name="" class="form-control" placeholder="仕入区分" readonly="" value="{{$purchaseHistoryInquiryInfos[0]->purchase_segment}}">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col">
              <table class="table custom-form custom-table"
                style="border: none!important;margin-bottom:4px !important;">
                <tbody>
                  <tr>
                    <td style="width: 93px!important;padding: 1px!important;border:0!important;">
                      <div class="line-icon-box "><span style="padding-left:28px;">作成区分</span></div>
                    </td>
                    <!--td style=" border: none!important;width: 70px!important;">　作成区分</td> -->
                    <td style=" border: none!important; min-width: 179px!important;">
                    <input type="text" name="" class="form-control" placeholder="作成区分" readonly="" value="{{$purchaseHistoryInquiryInfos[0]->creating_division}}">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col">
              <table class="table custom-form custom-table"
                style="border: none!important;width: auto;margin-bottom:4px !important">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 53px!important;">番号検索</td>
                    <td style=" border: none!important;width: 219px">
                    <div style="width: 100% !important;">
                        <div class="input-group input-group-sm position-relative">
                          <input type="text" class="form-control" placeholder="番号検索" readonly="" value="{{$purchaseHistoryInquiryInfos[0]->purchase_no}}"
                            style="padding: 0!important;">

                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="col" style="margin-left:-1px;">
              <table class="table custom-form"
                style="border: none!important;margin-bottom:4px !important;">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 69px!important;">仕入番号</td>
                    <td style=" border: none!important;width: 152px;">
                      <input type="text" name="" class="form-control" placeholder="仕入番号" readonly="" value="{{$purchaseHistoryInquiryInfos[0]->purchase_no_searched}}">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row mb-2" style="padding-top: 0px;">
            <div class="col-3">
              <table class="table custom-form custom-table" style="margin-bottom: 2px!important;width:auto;">
                <tbody>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;width: 103px !important;padding-left: 0px!important;">
                      <div class="line-icon-box float-left mr-3"></div>仕入日
                    </td>
                    <td style="border: none!important;width: 202px !important;">
                      <div class="input-group">
                        <input type="text" class="form-control"
                          oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                          maxlength="10" autocomplete="off" placeholder="年/月/日" style="" value="{{$purchaseHistoryInquiryInfos[0]->purchase_date}}" readonly>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col">
              <table class="table custom-form custom-table" style="margin-bottom: 2px!important;width:auto;">
                <tbody>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;width: 94px !important;">
                      <div class="line-icon-box float-left mr-3"></div>仕入先
                    </td>
                    <td style="border: none!important;width: 499px;">
                    <div style="width: 100% !important;">
                        <div class="input-group input-group-sm position-relative custom_modal_input">
                          <input type="text" class="form-control" placeholder="仕入先" readonly="" style="padding: 0!important;" value="{{$purchaseHistoryInquiryInfos[0]->supplier}}">
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-3" style="margin-left: -2px;">
              <table class="table custom-form" style="margin-bottom: 2px!important;">
                <tbody>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;width: 94px !important;">
                      <div class="line-icon-box float-left mr-3"></div>担当
                    </td>
                    <td style="border: none!important;width: 151px;">
                    <input type="text" name="" class="form-control" placeholder="担当" readonly="" value="{{$purchaseHistoryInquiryInfos[0]->purchaser}}">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row mb-2" style="padding-top: 0px;">
            <div class="col">
              <table class="table custom-form custom-table" style="margin-bottom: 2px!important;width:305px;">
                <tbody>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;width: 103px !important;padding-left: 0px!important;">
                      <div class="line-icon-box float-left mr-3"></div>納品書番号
                    </td>
                    <td style="border: none!important;">
                    <input type="text" name="" class="form-control" placeholder="納品書番号" value="{{$purchaseHistoryInquiryInfos[0]->invoice_number}}" readonly>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col">
              <table class="table custom-form custom-table" style="margin-bottom: 2px!important;">
                <tbody>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;width: 64px !important;">
                      <div class="line-icon-box float-left mr-3"></div>納品書日付
                    </td>
                    <td style="border: none!important;width: 151px;">
                    <input type="text" name="" class="form-control" placeholder="納品書日付" value="{{$purchaseHistoryInquiryInfos[0]->invoice_date}}" readonly>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col" >
            <table class="table custom-form custom-table" style="width:auto; margin-bottom: 2px!important;">
                <tbody>
                  <tr>
                    <td style="padding: 0!important;border: none!important;text-align: left;color: black;width: 78px !important;">
                      <div class="line-icon-box float-left"></div>支払方法
                    </td>
                    <td style="border: none!important;width: 219px !important;">
                    <input type="text" name="" class="form-control" placeholder="支払方法" readonly="" value="{{$purchaseHistoryInquiryInfos[0]->payment_method}}">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col">
              <table class="table custom-form" style="margin-bottom: 2px!important;">
                <tbody>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;width: 94px !important;">
                      <div class="line-icon-box float-left mr-3" style="margin-left:-2px;"></div>支払日
                    </td>
                    <td style="border: none!important;width: 151px;">
                      <div class="input-group">
                        <input type="text" class="form-control" readonly
                          oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                          maxlength="10" autocomplete="off" placeholder="年/月/日" style="" value="{{$purchaseHistoryInquiryInfos[0]->payment_date}}">
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
        <div class="row">

        <div class="col-6">
              <table class="table custom-form custom-table" style="border: none!important;margin-bottom:0px!important;">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 79px!important;">受注先</td>
                    <td style=" border: none!important;">
                      <div class="input-group input-group-sm custom_modal_input" style="margin-bottom: 4px;">
                        <input type="text" class="form-control" placeholder="受注先" readonly="" value="">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 79px!important;">最終顧客</td>
                    <td style=" border: none!important;">
                      <div class="input-group input-group-sm custom_modal_input " style="margin-bottom: 4px;">
                        <input type="text" class="form-control" placeholder="最終顧客" readonly="" value="">
                      </div>
                    </td>
                  </tr>

                </tbody>
              </table>
            </div>
            <div class="col">

            <table class="table custom-form custom-table" style="border: none!important;width: auto;margin-bottom:0px !important;">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 55px!important;">指示者</td>
                    <td style=" border: none!important;width: 218px;">
                      <input type="text" name="" class="form-control" placeholder="指示者" readonly="" value="{{$purchaseHistoryInquiryInfos[0]->indicator_name}}">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col" style="margin-left:-3px;">

            <table class="table custom-form " style="border: none!important;margin-bottom:0px !important">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 89px!important;">検印者</td>
                    <td style=" border: none!important;width: 185px">
                    <div>
                        <div class="input-group input-group-sm position-relative">
                          <input type="text" class="form-control" placeholder="検印者" readonly="" style="padding: 0!important;" value="{{$purchaseHistoryInquiryInfos[0]->checker}}">
                        </div>
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
  </div>
</div>
