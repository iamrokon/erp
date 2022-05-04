<div class="content-head-section" style="padding-bottom: 5px;">
    <div class="container position-relative">
        <!-- Show Success Message -->
       @if(Session::has('pdf_msg'))
        @php
        $pdf_msgs = session()->get('pdf_msg');
        @endphp
        @foreach($pdf_msgs as $key=>$val)
         <div class="row success-msg-box" style="position: relative; width:100%;max-width: 1452px;z-index: 1;">
          <div class="col-12 pl-0 pr-0 ml-3">
            <div class="alert alert-primary alert-dismissible">
              <button type="button" class="close" autofocus data-dismiss="alert" onclick="$('#division_datachar05_start').focus();">&times;</button>
              <strong> {{$val}}</strong>
            </div>
          </div>
        </div>
        @endforeach
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
        
        <!-- Show Date Error Message -->
        @if(Session::has('date_err_msg'))
        @php
        $date_err_msgs = session()->get('date_err_msg');
        @endphp
        @foreach($date_err_msgs as $key=>$val)
        <p class="common_error">{{$val}}</p>
        @endforeach
        @endif


        <!-- Show Error Message -->
        @if(Session::has('ng_msg'))
        @php
        $ng_msgs = session()->get('ng_msg');
        @endphp
        @foreach($ng_msgs as $key=>$val)
        <div class="row success-msg-box" style="position: relative; width:100%; max-width: 1452px; z-index: 1;">
          <div class="col-12 pl-0 pr-0 ml-3">
            <div class="alert alert-primary alert-dismissible">
              <button type="button" class="close" autofocus data-dismiss="alert" onclick="$('#division_datachar05_start').focus();">&times;</button>
              <strong>{{$val}}</strong>
            </div>
          </div>
        </div>
        @endforeach
        @endif

        <!-- Show Email Success Message -->
        @if(Session::has('email_success_msg'))
        @php
        $email_success_msg = session()->get('email_success_msg');
        @endphp
        <div class="row success-msg-box" style="position: relative; width: 100%; max-width: 1452px; z-index: 1;">
          <div class="col-12 pl-0 pr-0 ml-3">
            <div class="alert alert-primary alert-dismissible">
              <button type="button" class="close" autofocus  data-dismiss="alert" onclick="$('#division_datachar05_start').focus();">&times;</button>
              <strong>{{$email_success_msg}}</strong>
            </div>
          </div>
        </div>
        @endif

        <!-- No Email Common Message -->
        @if(Session::has('no_mail_common_msg'))
        @php
        $no_mail_common_msg = session()->get('no_mail_common_msg');
        @endphp
        <p class="common_error" id="no_found_data">{{$no_mail_common_msg}}</p>
        @endif
 
         <!-- No Email Messages -->
        @if(Session::has('no_mail_msg'))
        @php
        $no_mail_msgs = session()->get('no_mail_msg');
        @endphp
        @foreach($no_mail_msgs as $key=>$val)
        <p class="common_error">{{$val}}</p>
        @endforeach
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

        <!-- Not generated pdf Common Message -->
        @if(Session::has('not_generated_pdf_common_msg'))
        @php
        $not_generated_pdf_common_msg = session()->get('not_generated_pdf_common_msg');
        @endphp
        @if(!Session::has('email_success_msg') && !Session::has('date_err_msg'))
        <p class="common_error" id="not_generated_pdf_common_msg">{{$not_generated_pdf_common_msg}}</p>
        @endif
        @endif

        <!-- Not generated pdf messages -->
        @if(Session::has('not_generated_pdf_msg'))
        @php
        $not_generated_pdf_msgs = session()->get('not_generated_pdf_msg');
        @endphp
        @if(!Session::has('email_success_msg') && !Session::has('date_err_msg'))
        @foreach($not_generated_pdf_msgs as $key=>$val)
        <p class="common_error" id="not_generated_pdf">{{$val}}</p>
        @endforeach
        @endif
        @endif
       
        {{-------------------------------- Request Status Message and Total Sent Mail Alert Starts Here --------------------------------}}

        <div class="row success-msg-box" id="req_status_msg_main" style="position: relative; width: 100%; max-width: 1452px; z-index: 1; display: none;">
          <div class="col-12 pl-0 pr-0 ml-3">
            <div class="alert alert-primary alert-dismissible">
              <button type="button" class="close dismissAlertMessageRequestStatusMessage" data-dismiss="alert" autofocus>&times;</button>
              <strong id="req_status_msg"></strong>
            </div>
          </div>
        </div>
        
        <div class="row success-msg-box" id="total_sent_mail_count" style="position: relative; width: 100%; max-width: 1452px; z-index: 1; display: none;">
          <div class="col-12 pl-0 pr-0 ml-3">
            <div class="alert alert-primary alert-dismissible">
              <button type="button" class="close dismissAlertMessageTotalSentMail" data-dismiss="alert" autofocus>&times;</button>
              <strong id="total_sent_mail_msg"></strong>
            </div>
          </div>
        </div>

        <script>
          $(document).ready(function(){
            // Request Status Message
            $(".dismissAlertMessageRequestStatusMessage").click(function (){
              $('#req_status_msg_main').hide();
              $('#division_datachar05_start').focus();
            });
            $(".dismissAlertMessageRequestStatusMessage").keydown(function (e){
              if (e.shiftKey && e.which == 13) {
                $('#req_status_msg_main').hide();
                $('#division_datachar05_start').focus();
                e.preventDefault();
                $('#division_datachar05_start').click();
              }
            });
            
            // Total Sent Mail
            $(".dismissAlertMessageTotalSentMail").click(function (){
              $('#total_sent_mail_count').hide();
              $('#division_datachar05_start').focus();
            });
            $(".dismissAlertMessageTotalSentMail").keydown(function (e){
              if (e.shiftKey && e.which == 13) {
                $('#total_sent_mail_count').hide();
                $('#division_datachar05_start').focus();
                e.preventDefault();
                $('#division_datachar05_start').click();
              }
            });
          });
        </script>
        {{-------------------------------- Request Status Message and Total Sent Mail Alert Starts Here --------------------------------}}

        <form id="firstSearch" action="{{ route('salesSlip') }}" method="post">
        <input type="hidden" name="Button" id="firstButton" value="{{isset($old['Button'])?$old['Button']:null}}">
        <input type="hidden" id="fs_sortField" name="sortField" value="{{isset($old['sortField'])?$old['sortField']:null}}">
        <input type="hidden" id="fs_sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
        <input type="hidden" id="fs_userId" name="userId" value="{{$bango}}">
        <input type="hidden" id="first_csrf" value="{{csrf_token()}}" name="_token" disabled>
        <input type="hidden" id="first_pagination" name="pagination" disabled>

        <input type="hidden" id="source" value="salesSlip"/>
        @csrf

            <div class="row">
              <div class="col">

                <!-- Error Message Starts Here -->
                <div class="common_error" id="error_data"></div>
                <!-- Error Message Ends Here -->

                @if(isset($exceedUser))
                  <p class="common_error" id="no_found_data">{{$exceedUser}}</p>
                @endif

                <div class="content-head-top inner-top-content" style="margin-bottom: 2px;">
                  
                  <!-- Top search common pull-down layout -->
                  @include('layout.commonOfficeDeptGroup')
                    
                  <div class="row mt-2">
                    <div class="ml-3">
                      <table class="table custom-form" style="border: none!important; width: auto;">
                        <tbody>
                          <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style=" border: none!important;width: 71px!important;">受注先</td>
                            <td style=" border: none!important;">
                              <div class="input-group input-group-sm" id="information1_err_msg">
                                <input type="text" name="information1_text" id="tsearch_information1" value="{{isset($fsReqData['information1_text'])?$fsReqData['information1_text']:null}}" class="form-control custom_modal_input" readonly="" style="padding: 0!important;">
                                <input name="information1_short" id="tsearch_information1_db" value="{{isset($fsReqData['information1_short'])?$fsReqData['information1_short']:null}}" type="hidden" >
                                <div class="input-group-append" >
                                  <button onclick="supplierSelectionModalOpener_2('tsearch_information1','tsearch_information1_db','1','nullable','r16cd',event.preventDefault())" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style=" border: none!important;width: 71px!important;">売上請求先</td>
                            <td style=" border: none!important;">
                              <div class="input-group input-group-sm" id="information2_err_msg">
                                <input name="information2_text" id="tsearch_information2" value="{{isset($fsReqData['information2_text'])?$fsReqData['information2_text']:null}}" type="text" class="form-control custom_modal_input" readonly="" style="padding: 0!important;">
                                <input name="information2_short" id="tsearch_information2_db" value="{{isset($fsReqData['information2_short'])?$fsReqData['information2_short']:null}}" type="hidden" >
                                <div class="input-group-append" >
                                  <button onclick="supplierSelectionModalOpener_2('tsearch_information2','tsearch_information2_db','1','nullable','r16cd',event.preventDefault())" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style=" border: none!important;width: 71px!important;">最終顧客</td>
                            <td style=" border: none!important;">
                              <div class="input-group input-group-sm" id="information3_err_msg">
                                <input name="information3_text" id="tsearch_information3" value="{{isset($fsReqData['information3_text'])?$fsReqData['information3_text']:null}}" type="text" class="form-control custom_modal_input" readonly="" style="padding: 0!important;">
                                <input name="information3_short" id="tsearch_information3_db" value="{{isset($fsReqData['information3_short'])?$fsReqData['information3_short']:null}}" type="hidden" >
                                <div class="input-group-append" >
                                  <button onclick="supplierSelectionModalOpener_2('tsearch_information3','tsearch_information3_db','0','nullable','r16cd',event.preventDefault())" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                                </div>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="ml-3">
                      <table class="table custom-form" style="border: none!important;width: auto;margin-bottom: 0!important;">
                        <tbody>
                          <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style=" border: none!important;width: 65px!important;">売上日</td>
                            <td style=" border: none!important;width: 122px;">
                              <div class="input-group">
                                 @php
                                 $previous_date = date('Y-m');
                                 $previous_year = explode("-",$previous_date)[0];
                                 $previous_month = explode("-",$previous_date)[1];
                                 $intorder03_start = $previous_year.'/'.$previous_month.'/'.'01';
                                 @endphp
                                <input name="intorder03_start" id="datepicker1_dnote" 
                                  maxlength="8"
                                  value="{{isset($fsReqData['intorder03_start'])?$fsReqData['intorder03_start']:$intorder03_start}}" placeholder="年/月/日" type="text" 
                                  class="form-control datePicker" autocomplete="off" style="width: 96px!important;"
                                  oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                  onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                >
                                <input class="datePickerHidden" type="hidden" value="{{isset($fsReqData['intorder03_start'])?$fsReqData['intorder03_start']:$intorder03_start}}">
                            </td>
                            <td style="width: 40px!important;border:0!important;text-align: center;">
                              ～
                            </td>
                            <td style=" border: none!important;width: 122px;">
                              <div class="input-group">
                                <input name="intorder03_end" id="datepicker2_dnote" value="{{isset($fsReqData['intorder03_end'])?$fsReqData['intorder03_end']:date('Y/m/d')}}" placeholder="年/月/日" 
                                maxlength="8"
                                type="text" class="form-control datePicker" autocomplete="off" style="width: 96px!important;"
                                oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                              >
                              <input class="datePickerHidden" type="hidden" value="{{isset($fsReqData['intorder03_end'])?$fsReqData['intorder03_end']:date('Y/m/d')}}">
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <table class="table custom-form" style="border: none!important;width: auto;">
                        <tbody>
                          <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style="border: none!important;width: 65px!important;">受注区分</td>
                            <td style=" border: none!important;width: 123px !important;">
                              <div class="custom-arrow">
                                  <select name="datachar02" id="datachar02" class="form-control" style="width:100%;" autofocus="">
                                    @foreach($datachar02 as $dtchar02)
                                        @if(isset($fsReqData))
                                        <option value="{{$dtchar02->category1.$dtchar02->category2}}" @if(isset($fsReqData['datachar02']) && $fsReqData['datachar02'] == $dtchar02->category1.$dtchar02->category2){{'selected'}}@endif>
                                          {{$dtchar02->category2." ".$dtchar02->category4}}
                                        </option>
                                        @else
                                        <option value="{{$dtchar02->category1.$dtchar02->category2}}" @if($dtchar02->category1.$dtchar02->category2 == 'U110'){{'selected'}}@endif>
                                          {{$dtchar02->category2." ".$dtchar02->category4}}
                                        </option>
                                        @endif
                                    @endforeach
                                </select>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style="border: none!important;width: 65px!important;">発行区分</td>
                            <td style=" border: none!important;width: 123px !important;">
                              <div class="custom-arrow">
                                <select name="hktsyukko_datachar04" id="hktsyukko_datachar04" class="form-control" style="width:100%;" autofocus="">
                                  @if(isset($fsReqData))
                                  <option value="1" @if(isset($fsReqData['hktsyukko_datachar04']) && $fsReqData['hktsyukko_datachar04'] == 1){{'selected'}}@endif>1　発行済</option>
                                  <option value="2" @if(isset($fsReqData['hktsyukko_datachar04']) && $fsReqData['hktsyukko_datachar04'] == 2){{'selected'}}@endif>2　未発行</option>
                                  <option value="3" @if(isset($fsReqData['hktsyukko_datachar04']) && $fsReqData['hktsyukko_datachar04'] == 3){{'selected'}}@endif>3　すべて</option>
                                  @else
                                  <option value="1">1　発行済</option>
                                  <option value="2" selected>2　未発行</option>
                                  <option value="3">3　すべて</option>
                                  @endif
                                </select>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="position-relative" style="margin-top: 17px; margin-bottom: 25px; border-top: 1px solid #E1E1E1;border-bottom: 1px solid #E1E1E1 ;padding: 25px 0px;">
                    <div class="row">
                      <div class="col-4"></div>
                      <div class="col-8">
                        
                          <div class="text-right buttonGroup">
                            <button onclick="firstSearch('{{route('salesSlip')}}',event.preventDefault())" style="margin-left:15px;" type="submit" class="btn btn-info btn-view btn-m-view uskc-button">表示</button>
                        
                      
                            <a id="customprogress" onclick="voucherCreation('{{route("voucherCreation",[$bango])}}');" style="margin-left:15px;@if($tantousya->innerlevel>14) {{"pointer-events: none;display:none"}} @endif"  href="#" class="btn btn-info btn-m-view uskc-button loadingProgress" >伝票作成</a>
                        
                            <a id="customprogress" onclick="mailConfirmation();" href="#" class="btn btn-info btn-m-view uskc-button" style="margin-left:15px;@if($tantousya->innerlevel>14) {{"pointer-events: none"}} @endif" >メール送信</a>
                        
                            <a id="loading-icon" onclick="downloadPDF('{{route("downloadPDF",[$bango])}}');" href="#" class="btn btn-info btn-m-view uskc-button" style="margin-left:15px;">PDFダウンロード</a>
                            <div class="loading-icon" style="display: none;">
                              <span style="font-size: 30px;display: inline-block;margin-top:4px;"><i class="fa fa-spinner" aria-hidden="true"></i></span>
                            </div>
                            <div id="progress" class="progress" style="width: 348px; float: right;position: absolute;right: 58px;bottom: -25px;display: none;">
                                <div id="progress-bar" class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
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
