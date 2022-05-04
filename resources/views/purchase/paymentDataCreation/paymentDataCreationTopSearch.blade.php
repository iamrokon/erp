{{-- <div class="content-head-section custom-mb" style="padding: 13px 0 0;">
  <div class="container position-relative"> --}}

    <div class="row order_entry_topcontent payment-schedule-top-content">
      <div class="col">
        <div class="content-head-top" style="border-bottom: 0px;">
          <div class="row mb-2">
            <div class="col-12">
              <div class="row">
                <div class="col-12">

                  <div>
                    <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                      <tbody>
                        <tr>
                          <td
                            style="border: none!important;text-align: left;color: black;width: 120px !important;padding-left:0px!important;">
                            <div class="line-icon-box float-left mr-3"></div>
                            締切日
                          </td>
                          <td style="border: none!important;width: 151px;">
                            <div class="input-group">
                              <input type="text" class="form-control datePicker1" name="payment_deadline" id="payment_deadline"
                                oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                maxlength="10" autocomplete="off" placeholder="年/月/日"
                                style="width: 96px!important;" value="" autofocus>
                              <input type="hidden" class="datePickerHidden">
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <div>
                    <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                      <tbody>
                        <tr>
                          <td
                            style="border: none!important;text-align: left;color: black;width: 120px !important;padding-left:0px!important;">
                            <div class="line-icon-box float-left mr-3"></div>
                            支払日
                          </td>
                          <td style="border: none!important;width: 151px;">
                            <div class="input-group">
                              <input type="text" class="form-control datePicker2" name="payment_date" id="payment_date"
                                oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                maxlength="10" autocomplete="off" placeholder="年/月/日"
                                style="width: 96px!important;" value="">
                              <input type="hidden" class="datePickerHidden">
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <div>
                    <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                      <tbody>
                        <tr>
                          <td
                            style="border: none!important;text-align: left;color: black;width: 120px !important;padding-left:0px!important;">
                            <div class="line-icon-box float-left mr-3"></div>
                            伝票日
                          </td>
                          <td style="border: none!important;width: 151px;">
                            <div class="input-group">
                              <input type="text" class="form-control datePicker3" name="voucher_date" id="voucher_date"
                                oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                maxlength="10" autocomplete="off" placeholder="年/月/日"
                                style="width: 96px!important;" value="">
                              <input type="hidden" class="datePickerHidden">
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                </div>
              </div>

              <div class="row">
                <div class="d-flex mt-2 mb-4 w-100 ml-3 mr-3 justify-content-end align-items-center" style="height: 45px;">
                  <div class="">
                    <button class="btn btn-info uskc-button" id="loaderButton" >データ作成</button>
                  </div>
                  <div class="loading-icon ml-2" style="display: none;">
                    <span style="font-size: 30px;"><i class="fa fa-spinner" aria-hidden="true"></i></span>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  {{-- </div>
</div> --}}

  {{-- Alert message modal start here --}}

  <div class="modal custom-data-modal" data-backdrop="static" id="paymentData_pop_up_modal" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 400px;">
    <div class="modal-content bg-blue">
      <div class="modal-header p-2 pl-4 border-bottom-0" style="background: #fff;">
        <h5 class="modal-title" id="exampleModalLabel"><strong></strong></h5>
        <span type="button" class="close paymentConfirmModalClose" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </span>
      </div>
      <div class="modal-body pt-0 pr-1 pl-1" style="border: 2px solid #fff;" data-bind="nextFieldOnEnter:true">
        <div class="modal-data-box pl-4 pr-4">
          <table class="table text-white" id="table-basic">
            <tbody class="pl-4 pr-4">
          
              <tr>
  
                <td
                  style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 30px 0px 5px 0px !important;border-bottom: 0px!important;">
  
                  <div class="text-white"> 支払データを作成します(はい/いいえ) </div>
                </td>
              </tr>
             
              <tr>
  
                <td
                  style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 30px 0px 5px 0px !important;border-bottom: 0px!important;">
                  <div class="text-center">
                    <button type="button" id="choice_button" class="btn w-145 bg-teal text-white ml-2 confirmOk" data-dismiss="modal">
                      はい
                     </button>
                    <button type="button" id="choice_button" class="btn w-145 bg-default text-white ml-2 confirmCancel" data-dismiss="modal">
                      いいえ
                    </button>
                  </div>
                </td>
              </tr>
  
  
            </tbody>
          </table>
        </div>
        <div class="modal-footer border-top-0 pl-4 pr-4">
          
        </div>
      </div>
    </div>
  </div>
  </div>
  
  {{--  Alert message modal end end here --}}