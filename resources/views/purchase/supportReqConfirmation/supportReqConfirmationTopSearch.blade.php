<div class="content-head-section">
    <div class="container position-relative">
      <form id="firstSearch" action="{{ route('supportReqConfirmation') }}" method="post">
        <input type="hidden" name="Button" id="firstButton" value="{{isset($old['Button'])?$old['Button']:null}}">
        <!--<input type="hidden" id="fs_sortField" name="sortField" value="{{--isset($old['sortField'])?$old['sortField']:null--}}">
        <input type="hidden" id="fs_sortType" name="sortType" value="{{--isset($old['sortType'])?$old['sortType']:null--}}">-->
        <input type="hidden" id="fs_userId" name="userId" value="{{$bango}}">
        <input type="hidden" id="first_csrf" value="{{csrf_token()}}" name="_token" disabled>
        <input type="hidden" id="innerlevel" value="{{$tantousya->innerlevel}}">
        @csrf  
        
      {{-- Success Message Starts Here --}}
      <div class="row success-msg-box d-none" style="position: relative; width: 100%; max-width: 1452px; z-index: 1;" >
        <div class="col-12">
          <div class="alert alert-primary alert-dismissible">
            <button type="button" class="close dismissAlertMessage"  autofocus>&times;</button>
            <strong>Success alert</strong>
          </div>
        </div>
      </div>
      {{-- Success Message Ends Here --}}

      {{-- Error Message Starts Here --}}
      <div id="error_data" class="common_error"></div>
      {{-- Error Message Ends Here --}}
      
        @if(isset($exceedUser))
        <p id="no_found_data" class="common_error">{{$exceedUser}}</p>
        @endif
        
        <!-- Show Success Message -->
       @if(Session::has('pdf_msg'))
        @php
        $pdf_msgs = session()->get('pdf_msg');
        @endphp
        @foreach($pdf_msgs as $key=>$val)
         <div class="row success-msg-box" style="position: relative; width:100%;max-width: 1452px;z-index: 1;">
          <div class="col-12 pl-0 pr-0 ml-3">
            <div class="alert alert-primary alert-dismissible">
              <button type="button" class="close" autofocus data-dismiss="alert" onclick="$('#start_date').focus();">&times;</button>
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
        <p class="common_error update_common_error">{{$val}}</p>
        @endforeach
        @endif
        @endif
        
        <!-- No Data Found Message -->
        @if(Session::has('no_data_found'))
        @php
        $no_data_found = session()->get('no_data_found');
        @endphp
        @if(empty(session()->get('pdf_msg')))
        <p class="common_error update_common_error">{{$no_data_found}}</p>
        @endif
        @endif
        
        <!-- Show Update Message -->
        @if(Session::has('update_msg'))
        @php
        $update_msg = session()->get('update_msg');
        @endphp
        <div id="update-success-msg" class="row success-msg-box" style="position: relative; width:100%;max-width: 1452px;z-index: 1;">
          <div class="col-12">
            <div class="alert alert-primary alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" autofocus
              onclick="$('#start_date').focus();">&times;</button>
              <strong>{{$update_msg}}</strong><br>
            </div>
          </div>
        </div>
        @endif
        
        <!-- Show Update Err Message -->
        @if(Session::has('update_err_msg'))
        @php
        $update_err_msg = session()->get('update_err_msg');
        @endphp
        <p class="common_error update_common_error">{{$update_err_msg}}</p>
        @endif
      
      <div class="row order_entry_topcontent support-req-confirmation inner-top-content">
        <div class="col">
          <div class="content-head-top">
            <div class="row">
              <div class="col">
                <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                  <tbody>
                    <tr>
                        @php
                        $year = date('Y');
                        $month = date('m');
                        $day = date('d');
                        $last_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                        $start_date = date("Y/m",strtotime($year.'-'.$month." -1 month")).date('/d');
                        $end_date = date('Y/m/d');
                        @endphp
                      <td style="border: none!important;text-align: left;color: black;width: 95px !important;">
                        <div class="line-icon-box float-left mr-3"></div>依頼日
                      </td>
                      <td style="border: none!important;width: 151px;">
                        <input type="text" name="start_date" id="start_date" class="form-control datePicker datePicker1_1" autocomplete="off"
                          value="{{isset($fsReqData['start_date'])?$fsReqData['start_date']:$start_date}}" placeholder="年/月/日"
                          oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                          maxlength="10" autofocus>
                        <input type="hidden" class="datePickerHidden" value="{{isset($fsReqData['start_date'])?$fsReqData['start_date']:$start_date}}">
                      </td>
                      <td style="width: 30px!important;border:0!important;text-align: center;">
                        ～
                      </td>
                      <td style="border: none!important;width: 151px;">
                        <input type="text" name="end_date" id="end_date" class="form-control datePicker datePicker1_2" autocomplete="off"
                          value="{{isset($fsReqData['end_date'])?$fsReqData['end_date']:$end_date}}" placeholder="年/月/日"
                          oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                          maxlength="10">
                        <input type="hidden" class="datePickerHidden" value="{{isset($fsReqData['end_date'])?$fsReqData['end_date']:$end_date}}">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <table class="table custom-form" style="width:auto; margin-bottom: 2px!important;">
                  <tbody>
                    <tr>
                      <td style="border: none!important;text-align: left;color: black;width:95px !important;">
                        <div class="line-icon-box float-left mr-3"></div> 事業部
                      </td>
                      <td style="border: none!important;width:270px;">
                        <div class="custom-arrow">
                          <select class="form-control" name="datatxt0003" id="division_datachar05_start" autofocus>
                                <option value="">-</option>
                                @foreach($datatxt0003 as $dttxt0003)
                                    @if(isset($fsReqData['datatxt0003']))
                                        <option value="{{$dttxt0003->category1.$dttxt0003->category2}}" @if(isset($fsReqData['datatxt0003']) && $dttxt0003->category1.$dttxt0003->category2 == $fsReqData['datatxt0003']){{'selected'}}@endif >
                                            {{$dttxt0003->category2_display." ".$dttxt0003->category4}}
                                        </option>
                                    @else
                                        @if(isset($fsReqData)  && count($fsReqData) > 0))
                                        <option value="{{$dttxt0003->category1.$dttxt0003->category2}}">
                                            {{$dttxt0003->category2_display." ".$dttxt0003->category4}}
                                        </option>
                                        @else
                                            <option value="{{$dttxt0003->category1.$dttxt0003->category2}}" @if($dttxt0003->category1.$dttxt0003->category2 == $tantousya->datatxt0003){{'selected'}}@endif>
                                                {{$dttxt0003->category2_display." ".$dttxt0003->category4}}
                                            </option>
                                        @endif
                                    @endif
                                @endforeach
                          </select>
                        </div>
                      </td>

                      <td style="width: 30px!important;border:0!important;text-align: center;"></td>

                      <td style="border: none!important;text-align: left;color: black;">
                        <div class="line-icon-box float-left mr-3"></div>部
                      </td>
                      <td style="border: none!important; width:270px;">
                        <div class="custom-arrow">
                          <select class="form-control" name="datatxt0004" id="department_datachar05_start">
                                <option value="">-</option>
                                @foreach($datatxt0004 as $dttxt0004)
                                    @if(isset($fsReqData['datatxt0004']))
                                        <option value="{{$dttxt0004->category1.$dttxt0004->category2}}" @if(isset($fsReqData['datatxt0004']) && $dttxt0004->category1.$dttxt0004->category2 == $fsReqData['datatxt0004']){{'selected'}}@endif >
                                            {{$dttxt0004->category2_display." ".$dttxt0004->category4}}
                                        </option>
                                    @else
                                        @if(isset($fsReqData)  && count($fsReqData) > 0))
                                        <option value="{{$dttxt0004->category1.$dttxt0004->category2}}">
                                            {{$dttxt0004->category2_display." ".$dttxt0004->category4}}
                                        </option>
                                        @else
                                            <option value="{{$dttxt0004->category1.$dttxt0004->category2}}" @if($dttxt0004->category1.$dttxt0004->category2 == $tantousya->datatxt0004){{'selected'}}@endif>
                                                {{$dttxt0004->category2_display." ".$dttxt0004->category4}}
                                            </option>
                                        @endif
                                    @endif
                                @endforeach
                          </select>
                        </div>
                      </td>

                      <td style="width: 30px!important;border:0!important;text-align: center;"></td>

                      {{-- Radio Option Starts Here --}}
                      <td style="border: none!important; width:270px;">
                        @foreach($mail4 as $ml4)
                        <div class="radio-rounded d-inline-block">
                          <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                              @if(isset($fsReqData['rd1']))
								  <input type="radio" class="custom-control-input" id="customRadio{{$ml4->syouhinbango}}" name="rd1" value="{{$ml4->syouhinbango}}" @if(isset($fsReqData['rd1'])&& $fsReqData['rd1'] == $ml4->syouhinbango){{"checked"}}@endif>
							  @else
								  <input type="radio" class="custom-control-input" id="customRadio{{$ml4->syouhinbango}}" name="rd1" value="{{$ml4->syouhinbango}}" @if($ml4->syouhinbango == substr($tantousya->mail4,2,2)){{"checked"}}@endif>
                              @endif
                            
                            <label class="custom-control-label" for="customRadio{{$ml4->syouhinbango}}" style="font-size: 12px!important;cursor:pointer;">{{$ml4->jouhou}}</label>
                          </div>
                        </div>
                        @endforeach
                      </td>
                      {{-- Radio Option Ends Here --}}

                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row" style="padding-top: 0px; margin-bottom: 13px;">
              <div class="col-6">
                <table class="table custom-form" id="tbl-supplier" style="margin-bottom: 2px!important; width: auto;">
                  <tbody>
                    <tr>
                      <td class="text-render" style="border: none!important;color: black;width: 95px !important;">
                        <div style="width: 91px;">
                          <div class="line-icon-box float-left mr-3"></div>受注先
                        </div>
                      </td>
                      <td style=" border: none!important;">
                        <div>
                          <div class="input-group input-group-sm position-relative">
                            <input name="information1_text" id="tsearch_information1" value="{{isset($fsReqData['information1_text'])?$fsReqData['information1_text']:null}}" type="text" class="form-control" placeholder="受注先" readonly="" style="padding: 0!important; width: 507px !important;">
                            <input name="information1" id="tsearch_information1_db" type="hidden" value="{{isset($fsReqData['information1'])?$fsReqData['information1']:null}}"/>
                            <div class="input-group-append" style="margin-left:0px!important;">
                              <button onclick="supplierSelectionModalOpener_3('tsearch_information1','tsearch_information1_db','1','nullable','r20cd',event.preventDefault())" class="input-group-text btn" style="cursor: pointer;"><i class="fas fa-arrow-left"></i></button>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <table class="table custom-form" id="tbl-supplier" style="margin-bottom: 2px!important; width: auto;">
                  <tbody>
                    <tr>
                      <td class="text-render" style="border: none!important;color: black;width: 95px !important;">
                        <div style="width: 91px;">
                          <div class="line-icon-box float-left mr-3"></div>最終顧客
                        </div>
                      </td>
                      <td style=" border: none!important;">
                        <div>
                          <div class="input-group input-group-sm position-relative">
                            <input name="information3_text" id="tsearch_information3" value="{{isset($fsReqData['information3_text'])?$fsReqData['information3_text']:null}}" type="text" class="form-control" placeholder="最終顧客" readonly="" style="padding: 0!important; width: 507px !important;">
                            <input name="information3" id="tsearch_information3_db" type="hidden" value="{{isset($fsReqData['information1'])?$fsReqData['information1']:null}}"/>
                            <div class="input-group-append" style="margin-left:0px!important;">
                              <button onclick="supplierSelectionModalOpener_3('tsearch_information3','tsearch_information3_db','1','nullable','r20cd',event.preventDefault())" class="input-group-text btn" style="cursor: pointer;"><i class="fas fa-arrow-left"></i></button>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                  <tbody>
                    <tr>
                      <td style="border: none!important;text-align: left;color: black;width:94px !important;">
                        <div class="line-icon-box float-left mr-3"></div>作成区分
                      </td>
                      <td style="border: none!important;width: 151px;">
                        <div class="custom-arrow">
                          <select class="form-control" name="creation_category" id="creation_category" autofocus="">
                                <!--<option value="">-</option>-->
                                @foreach($creation_category as $creation_cat)
                                    @if(isset($fsReqData['creation_category']))
                                        <option value="{{$creation_cat->syouhinbango}}" @if(isset($fsReqData['creation_category']) && $creation_cat->syouhinbango == $fsReqData['creation_category']){{'selected'}}@endif >
                                            {{$creation_cat->syouhinbango." ".$creation_cat->jouhou}}
                                        </option>
                                    @else
                                        @if(isset($fsReqData)  && count($fsReqData) > 0))
                                        <option value="{{$creation_cat->syouhinbango}}">
                                            {{$creation_cat->syouhinbango." ".$creation_cat->jouhou}}
                                        </option>
                                        @else
                                            <option value="{{$creation_cat->syouhinbango}}" @if($creation_cat->syouhinbango == 2){{'selected'}}@endif>
                                                {{$creation_cat->syouhinbango." ".$creation_cat->jouhou}}
                                            </option>
                                        @endif
                                    @endif
                                @endforeach
                          </select>
                        </div>

                      </td>
                      <td style="width: 30px!important;border:0!important;text-align: center;">

                      </td>
                      
                      @if($tantousya->innerlevel <= 18)
                      <td style="border: none!important;text-align: left;color: black;width:94px !important;">
                        <div class="line-icon-box float-left mr-3"></div>検印区分
                      </td>
                      <td style="border: none!important;width: 151px;">

                        <div class="custom-arrow">
                          <select class="form-control" name="seal_classification" id="seal_classification" autofocus="">
                                <!--<option value="">-</option>-->
                                @foreach($seal_classification as $seal_classifcatn)
                                    @if(isset($fsReqData['seal_classification']))
                                        <option value="{{$seal_classifcatn->syouhinbango}}" @if(isset($fsReqData['seal_classification']) && $seal_classifcatn->syouhinbango == $fsReqData['seal_classification']){{'selected'}}@endif >
                                            {{$seal_classifcatn->syouhinbango." ".$seal_classifcatn->jouhou}}
                                        </option>
                                    @else
                                        @if(isset($fsReqData)  && count($fsReqData) > 0))
                                        <option value="{{$seal_classifcatn->syouhinbango}}">
                                            {{$seal_classifcatn->syouhinbango." ".$seal_classifcatn->jouhou}}
                                        </option>
                                        @else
                                            <option value="{{$seal_classifcatn->syouhinbango}}" @if($seal_classifcatn->syouhinbango == 3){{'selected'}}@endif>
                                                {{$seal_classifcatn->syouhinbango." ".$seal_classifcatn->jouhou}}
                                            </option>
                                        @endif
                                    @endif
                                @endforeach
                          </select>
                        </div>

                      </td>
                      @endif
                      
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div style="border-bottom: 1px solid #E1E1E1;border-top:1px solid #E1E1E1;padding:25px 0px;">
              <div class="row">
                <div class="col-5"></div>
                <div class="col-7 text-right">
                  <div class="row" style="margin-right:0px;float:right">
                    <div class="mr-2 text-center pr-0">
                      <a onclick="firstSearch('{{route('supportReqConfirmation')}}',event.preventDefault())" href="#" class="btn btn-info btn-view btn-m-view uskc-button">表示</a>
                    </div>
                    <div class="mr-2  text-center pl-m-non-res">
                      <a id="stamp_btn" onclick="updateSelectedSupportReqCon('{{route("support.updateSelectedSupportReqCon",[$bango])}}');"  href="#" class="btn btn-info btn-m-view uskc-button">検印</a>
                    </div>
                    <div class="mr-2 text-center pl-m-non-res">
                      <a id="customprogress" onclick="pdfCreation('{{route("support.pdfCreation",[$bango])}}');" href="#" href="#" class="btn btn-info btn-m-view uskc-button" 
                        >帳票作成</a>
                    </div>
                    {{-- <div class="text-center pl-m-non-res"> --}}
                      <!-- <a id="loading-icon" href="http://localhost/usk-mock-new/public/pdf_doc/モックアップユーザックシステム_0403売上伝票発行_20200819.pdf" target="”_blank”" class="btn btn-info btn-m-view  " style="width: 142px !important;">PDFダウンロード</a> -->
                      <a onclick="downloadPDF('{{route("support.downloadPDF",[$bango])}}');" id="loading-icon" href="#" class="btn btn-info btn-m-view uskc-button">PDFダウンロード</a>
                      <div class="loading-icon">
                        <span style="font-size: 30px; vertical-align: middle;"><i class="fa fa-spinner" aria-hidden="true"></i></span>
                      </div>
                      <div id="progress" class="progress" style="width: 348px; float: right;position: absolute;right: 55px;bottom: -16px;display: none;">
                        <div id="progress-bar" class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    {{-- </div> --}}
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