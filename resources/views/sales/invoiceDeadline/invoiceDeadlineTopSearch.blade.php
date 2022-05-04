<div class="content-head-section1" style="padding-bottom: 5px;">
  <div class="container">

    <!-- Show Success Message -->
    @if(Session::has('pdf_msg'))
    @php
    $pdf_msg = session()->get('pdf_msg');
    @endphp
    <div class="row success-msg-box" style="position: relative; width:100%;max-width: 1452px;z-index: 1;">
      <div class="col-12 pl-0 pr-0 ml-3">
        <div class="alert alert-primary alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" autofocus>&times;</button>
          <strong>{{$pdf_msg}}</strong>
        </div>
      </div>
    </div>
    @endif

    <!-- Show Error Message -->
    @if(Session::has('pdf_err_msg'))
    @php
    $pdf_err_msgs = session()->get('pdf_err_msg');
    @endphp
    @if(!Session::has('pdf_msg'))
    @foreach($pdf_err_msgs as $key=>$val)
    <p class="common_error">{{$val}}</p>
    @endforeach
    @endif
    @endif

    <!-- Sent Mail Message -->
    @if(Session::has('success_email'))
    @php
    $success_email_msg = session()->get('success_email');
    @endphp
    <div class="row success-msg-box" style="position: relative; width:100%;max-width: 1452px;z-index: 1;">
      <div class="col-12 pl-0 pr-0 ml-3">
        <div class="alert alert-primary alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" autofocus>&times;</button>
          <strong>{{$success_email_msg}}</strong>
        </div>
      </div>
    </div>
    @endif

    <!-- No Password Messages -->
    @if(Session::has('no_pass_msg'))
    @php
    $no_pass_msggs = session()->get('no_pass_msg');
    @endphp
    @foreach($no_pass_msggs as $key=>$val)
    <p class="common_error">{{$val}}</p>
    @endforeach
    @endif

    <!-- NG Messages -->
    @if(Session::has('ng_msg'))
    @php
    $ng_msgs = session()->get('ng_msg');
    @endphp
    @foreach($ng_msgs as $key=>$val)
    <div class="row success-msg-box" style="position: relative; width:100%;max-width: 1452px;z-index: 1;">
      <div class="col-12 pl-0 pr-0 ml-3">
        <div class="alert alert-primary alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" autofocus>&times;</button>
          <strong>{{$val}}</strong>
        </div>
      </div>
    </div>
    @endforeach
    @endif

    <!-- Not generated pdf Common Message -->
    @if(Session::has('not_generated_pdf_common_msg'))
    @php
    $not_generated_pdf_common_msg = session()->get('not_generated_pdf_common_msg');
    @endphp
    @if(!Session::has('email_success_msg'))
    <p id="no_found_data" class="common_error">{{$not_generated_pdf_common_msg}}</p>
    @endif
    @endif

    <!-- Not generated pdf messages -->
    @if(Session::has('not_generated_pdf_msg'))
    @php
    $not_generated_pdf_msgs = session()->get('not_generated_pdf_msg');
    @endphp
    @if(!Session::has('email_success_msg'))
    @foreach($not_generated_pdf_msgs as $key=>$val)
    <p id="no_found_data" class="common_error">{{$val}}</p>
    @endforeach
    @endif
    @endif

    <!-- Invalid Email messages -->
    @if(Session::has('invalid_email_common_msg'))
    @php
    $invalid_email_common_msg = session()->get('invalid_email_common_msg');
    $invalid_email_msgs = session()->get('invalid_email');
    @endphp
    @if(!Session::has('email_success_msg'))
    <p id="no_found_data" class="common_error">{{$invalid_email_common_msg}}</p>
    @foreach($invalid_email_msgs as $key=>$val)
    <p id="no_found_data" class="common_error">{{$val}}</p>
    @endforeach
    @endif
    @endif

    {{-- @if(Session::has('success_msg'))
    <div class="row" id="session_msg" style="position: absolute;top:-60px;width:100%;">
      <div class="col-12">
        <div class="alert alert-primary alert-dismissible">
          <button type="button" class="close dismissMe" data-dismiss="alert" autofocus style="background-color: white;"
            onclick="$('#creation_category').focus();">
            &times;
          </button>
          <strong>{{session()->get('success_msg') }}</strong>
        </div>
      </div>
    </div>
    @endif --}}

    <div class="msgDiv common_error" id="msgDiv"></div>

    @if(isset($invoiceDeadlineError)&& $invoiceDeadlineError!=null)
    <p class="common_error">{{$invoiceDeadlineError}}</p>
    @endif

    <!-- Error Message Starts Here -->
    <div id="error_data" class="common_error"></div>
    <!-- Error Message Ends Here -->

    <!-- pdf download message -->
    <div class="row success-msg-box" id="req_status_msg_main" style="width:100%; position: relative; max-width: 1452px; z-index: 1; display: none;">
      <div class="col-12 pl-0 pr-0 ml-3">
        <div class="alert alert-primary alert-dismissible">
          <button type="button" class="close dismissMe alertclose2" data-dismiss="alert" autofocus onclick="$('#categorykanri').focus(); closeMsg();">
            &times;
          </button>
          <strong id="req_status_msg"></strong>
        </div>
      </div>
    </div>
    <script>
      // Focus on Alert Closing
      $(".dismissMe").keydown(function (e) {
          if (e.shiftKey && e.which == 13) {
              $('.close').alert('close');
              event.preventDefault();
              document.getElementById("creation_category").click();
          }
          $('#creation_category').focus();
      });
    </script>


    <form id="firstSearch" action="{{ route('invoiceDeadline') }}" method="post">
      <input type="hidden" name="firstButton" value="topSearch">
      <input type="hidden" name="userId" id="userId" value="{{$bango}}">
      <input id='page_name' value='invoiceDeadline' type='hidden'/>
      @csrf
      <div class="row order_entry_topcontent inner-top-content">
        <div class="col">

          <div class="content-head-top" style="margin-top: 5px;margin-bottom:25px !important;padding-bottom:17px;">
            <div class="row">
              <div class="col-3">
                <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                  <tbody>
                    <tr>
                      <td
                        style="border: none!important;text-align: left;color: black;width: 94px !important;padding: 0px !important;">
                        <div class="line-icon-box float-left mr-3"></div>
                        締め日
                      </td>
                      <td style="border: none!important;width: 115px;">
                        <!--                                        <div class="input-group">
                                                <input autofocus="" type="text" class="form-control" autocomplete="off" value="" placeholder="" style="width: 96px!important;">
                                            </div>-->
                        <div class="custom-arrow">
                          <select class="form-control" name="categorykanri" id="categorykanri" autofocus="">
                            <!--                                                    <option value="">空欄</option>-->
                            @foreach($categorykanri as $val)
                            <option value="{{$val->category1.$val->category2}}"
                              @if(isset($fsReqData['categorykanri']))@if($fsReqData['categorykanri']==$val->
                              category1.$val->category2) selected @endif
                              @endif>{{substr($val->category2,-2,2).' '.$val->category4}}</option>
                            @endforeach
                          </select>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-3">
                <table class="table custom-form" style="width: auto;">
                  <tbody>
                    <tr>
                      <td
                        style="border: none!important;text-align: left;color: black;width: 23px !important;padding: 0px !important;">
                        <div class="line-icon-box float-left"></div>

                      </td>
                      <td style=" border: none!important;width: 53px!important;">印刷日</td>
                      <td style="border: none!important;width: 115px;">
                        <input type="text" name="print_date" id="print_date"
                          class="form-control datePicker datePicker1_1" autocomplete="off"
                          @if(isset($fsReqData['print_date'])) value="{{$fsReqData['print_date']}}" @else
                          value="{{$intialCategorykanriAndPrintDate}}" @endif placeholder="年/月/日"
                          oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                          maxlength="10" autofocus>
                        <input type="hidden" class="datePickerHidden">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row" style="padding-top: 0px;">
              <div class="col-5">
                <table class="table custom-form" style="width: auto;">
                  <tbody>
                    <tr>
                      <td
                        style="border: none!important;text-align: left;color: black;width: 94px !important;padding: 0px !important;">
                        <div class="line-icon-box float-left mr-3"></div>
                        請求日
                      </td>
                      <td style="border: none!important;width: 115px;">
                        <input type="text" name="categorykanri_date" id="datepicker1_oen"
                          class="form-control datePicker datePicker1_2" autocomplete="off"
                          @if(isset($fsReqData['categorykanri_date'])) value="{{$fsReqData['categorykanri_date']}}"
                          @else value="{{$intialCategorykanriAndPrintDate}}" @endif placeholder="年/月/日"
                          oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                          maxlength="10">
                        <input type="hidden" class="datePickerHidden">
                      </td>

                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="ml-3">
                <table class="table custom-form" style="width:auto;">
                  <tbody>
                    <tr>
                      <td
                        style="border: none!important;text-align: left;color: black;width:94px !important;padding: 0px !important;">
                        <div class="line-icon-box float-left mr-3"></div>
                        売上請求先
                      </td>
                      <td style="border: none!important;">
                        <div class="input-group input-group-sm position-relative">
                          <input type="text" id="invoiceDeadlineSupplier1" name="invoiceDeadlineSupplier1" readonly=""
                            class="form-control custom_modal_input" placeholder="売上請求先"
                            style="padding-left: 0px !important;"
                            value="{{isset($fsReqData['invoiceDeadlineSupplier1']) && count($fsReqData)>0? $fsReqData['invoiceDeadlineSupplier1'] : ""}}">
                          <input type="hidden" id="invoiceDeadlineSupplier1_db" name="invoiceDeadlineSupplier1_db"
                            value="{{isset($fsReqData['invoiceDeadlineSupplier1_db']) && count($fsReqData)>0? $fsReqData['invoiceDeadlineSupplier1_db'] : null}}">
                          <div class="input-group-append">
                            <button class="input-group-text btn"
                              onclick="supplierSelectionModalOpener_2('invoiceDeadlineSupplier1','invoiceDeadlineSupplier1_db','1','required','r16cd',event.preventDefault())"
                              style="cursor: pointer;"><i class="fas fa-arrow-left" style="color: #fff"></i></button>
                          </div>
                        </div>
                      </td>
                      <td
                        style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
                        ～
                      </td>
                      <td style="border: none!important;">
                        <div class="input-group input-group-sm position-relative">
                          <input type="text" id="invoiceDeadlineSupplier2" name="invoiceDeadlineSupplier2" readonly=""
                            class="form-control custom_modal_input" placeholder="売上請求先"
                            style="padding-left: 0px !important;"
                            value="{{isset($fsReqData['invoiceDeadlineSupplier2'])&& count($fsReqData)>0? $fsReqData['invoiceDeadlineSupplier2'] : ""}}">
                          <input type="hidden" id="invoiceDeadlineSupplier2_db" name="invoiceDeadlineSupplier2_db"
                            value="{{isset($fsReqData['invoiceDeadlineSupplier2_db'])&& count($fsReqData)>0? $fsReqData['invoiceDeadlineSupplier2_db'] : null}}">
                          <div class="input-group-append">
                            <button class="input-group-text btn"
                              onclick="supplierSelectionModalOpener_2('invoiceDeadlineSupplier2','invoiceDeadlineSupplier2_db','1','required','r16cd',event.preventDefault())"
                              style="cursor: pointer;"><i class="fas fa-arrow-left" style="color: #fff"></i></button>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-3">
                <table class="table custom-form custom-table" style="border: none!important;width: auto;">
                  <tbody>
                    <tr>
                      <td style="width: 23px!important;padding: 0!important;border:0!important;">
                        <div class="line-icon-box"></div>
                      </td>
                      <td style=" border: none!important;width: 70px!important;">郵送</td>
                      <td style=" border: none!important;width: 178px;">
                        <div class="custom-arrow">
                          <select class="form-control" autofocus="" id="request_data01" name="request_data01">
                            @foreach($request1_pulldown as $val)
                            <option value="{{$val->syouhinbango.' '.$val->jouhou}}"
                              @if(isset($fsReqData['request_data01']))@if($fsReqData['request_data01']==$val->
                              syouhinbango.' '.$val->jouhou) selected @endif @elseif('5 すべて' == $val->syouhinbango.' '.$val->jouhou) selected @endif>{{$val->syouhinbango.' '.$val->jouhou}}</option>
                            @endforeach
                          </select>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-3">
                <table class="table custom-form" style="border: none!important;width: auto;">
                  <tbody>
                    <tr>
                      <td style="width: 23px!important;padding: 0!important;border:0!important;">
                        <div class="line-icon-box"></div>
                      </td>
                      <td style=" border: none!important;width: 53px!important;">メール</td>
                      <td style=" border: none!important;width: 178px">
                        <div class="custom-arrow">
                          <select class="form-control" autofocus="" id="request_data02" name="request_data02">
                            @foreach($request2_pulldown as $val)
                            <option value="{{$val->syouhinbango.' '.$val->jouhou}}"
                              @if(isset($fsReqData['request_data02']))@if($fsReqData['request_data02']==$val->
                              syouhinbango.' '.$val->jouhou) selected @endif @elseif('3 すべて' == $val->syouhinbango.' '.$val->jouhou) selected @endif>
                              {{$val->syouhinbango.' '.$val->jouhou}}
                            </option>
                            @endforeach
                          </select>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-3">
                <table class="table custom-form" style="border: none!important;width: auto;">
                  <tbody>
                    <tr>
                      <td style="width: 23px!important;padding: 0!important;border:0!important;">
                        <div class="line-icon-box"></div>
                      </td>
                      <td style=" border: none!important;width: 70px!important;">発行状態</td>
                      <td style=" border: none!important;width: 178px">
                        <div class="custom-arrow">
                          <select class="form-control" autofocus="" id="request_data03" name="request_data03">
                            @foreach($request3_pulldown as $val)
                            <option value="{{$val->syouhinbango.' '.$val->jouhou}}"
                              @if(isset($fsReqData['request_data03']))@if($fsReqData['request_data03']==$val->
                              syouhinbango.' '.$val->jouhou) selected @endif @elseif('2 未発行' == $val->syouhinbango.' '.$val->jouhou) selected @endif>{{$val->syouhinbango.' '.$val->jouhou}}</option>
                            @endforeach
                          </select>
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
      <div style="border-bottom: 1px solid #e1e1e1;padding-bottom: 25px;">
        <div class="row">
          <div class="col-4"></div>
          <div class="col-8">
            <div class="text-right">
              <a href="#" id="topSearchBtn" class="btn btn-info btn-m-view uskc-button">表 示</a>
              <a id="customprogress" onclick="voucherCreation('{{route("invoiceVoucherCreation",[$bango])}}');" href="#"
                class="btn btn-info btn-m-view uskc-button loadingProgress" style="margin-left: 10px;">請求書作成</a>
              <a href="#" onclick="mailConfirmation();" class="btn btn-info btn-m-view uskc-button"
                style="margin-left: 10px;">メール送信</a>
              <a id="loading-icon" onclick="downloadPDF('{{route("invoiceDownloadPDF",[$bango])}}');" href="#"
                class="btn btn-info btn-m-view  uskc-button" style="margin-left: 10px;">PDFダウンロード</a>
                <div class="loading-icon" style="display: none;">
              <span style="font-size: 30px;vertical-align: middle;"><i class="fa fa-spinner" aria-hidden="true"></i></span>
              </div>
              <div class="progress"
                style="width: 348px; float: right;position: absolute;right: 58px;bottom: -25px;display: none;">
                <div id="progress-bar" class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: 0%"
                  aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
             
              </div>
              
          </div>
        </div>
      </div>
    </form>

  </div>
</div>

<!-- Confirm email transmission modal start here -->
@include('sales.invoiceDeadline.mailConfirmationModal')
<!-- Confirm email transmission modal end end here -->