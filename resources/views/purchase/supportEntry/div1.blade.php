<form id="insertData" enctype="multipart/form-data">
  <input type="hidden" id="csrf" value="{{ csrf_token() }}" name="_token">
  <input type="hidden" name="bango" id="userId" value="{{ $bango }}">
  <input type="hidden" name="source" id="source" value="supportEntry" />
  <input type="hidden" name="tuhanorder_otodoketime_ju0029" id="tuhanorder_otodoketime_ju0029"/>
  <input type="hidden" name="tuhanorder_information1" id="tuhanorder_information1"/>
  <input type="hidden" name="tuhanorder_information2" id="tuhanorder_information2"/>
  <input type="hidden" name="tuhanorder_information3" id="tuhanorder_information3"/>
  <input type="hidden" name="orderhenkan_bango" id="orderhenkan_bango">
  <input type="hidden" name="datachar05_ju0008" id="datachar05_ju0008"/>
  <input type="hidden" name="tuhanorder_juchukubun1_orders_subject" id="tuhanorder_juchukubun1_orders_subject"/>
  <input type="hidden" name="orderhenkan_ordertypebango2_maxval" id="orderhenkan_ordertypebango2_maxval" value="" />
  <input type="hidden" name="hidden_orderhenkan_date0016" id="hidden_orderhenkan_date0016" value="" />
  <input type="hidden" id='submit_confirmation' name="submit_confirmation" value=''/>


  <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
    <div class="content-head-section">
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
        {{-- Success Message Ends Here --}}

        {{-- Error Message Starts Here --}}
        <div  class="common_error d-none"> error Message</div>
        {{-- Error Message Ends Here --}}

        {{-- Error Message Starts Here --}}
          <div class="row">
              <div class="col-12">
                  <div class="common_error" id="error_data"></div>
              </div>
          </div>
        {{-- Error Message Ends Here --}}


          <div class="row support-entry inner-top-content" data-bind="nextFieldOnEnter:true">
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
                             <!--  <select class="form-control" name="order_category" id="categorikanri" autofocus style="display: none">
                                  <option value="U110">U110: 通常受注</option>
                              </select> -->

                              <select class="form-control" name="syouhinbango_jouhou" id="syouhinbango_jouhou" autofocus>
                                  @foreach ($request1s as $request)
                                  <option value="{{ $request->syouhinbango}}">
                                      {{ $request->syouhinbango . ' ' . $request->jouhou }}
                                  </option>
                                  @endforeach
                              </select>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="ml-3 mr-3">
                    <table class="table custom-form custom-table"
                      style="border: none!important;width: 100% !important;margin-bottom:4px !important;">
                      <tbody>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 70px!important;">　番号検索</td>
                          <td style=" border: none!important;width: 192px!important;">
                            <!-- <div style="width: 100% !important;">
                              <div class="input-group input-group-sm position-relative">
                                <input type="text" class="form-control" placeholder="999999999" readonly=""
                                  style="width: 127px!important;padding: 0!important;">
                                 <div class="input-group-append" id="modalarea" data-toggle="modal"
                                  data-target="#exampleModal3">
                                  <button class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                                </div> 
                              </div>
                            </div> -->
                           
                              <div style="width: 177px !important;">
                                  <div class="input-group position-relative">
                                      <!-- 102, 102-1 -->
                                      <input type="text" class="form-control" name="number_search" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" id="number_search" placeholder="番号検索" style="width: 127px!important;"  style="pointer-events: none;" maxlength="10">
                    
                                      <div class="input-group-append">
                                          <button class="input-group-text btn open_number_search" type="button" style="height: 30px !important; width: 30px !important; padding: 0px 8px !important;" onclick="handleNumberSearchModalOpener102ChildScreen('number_search',event.preventDefault())">
                                              <i class="fas fa-arrow-left"></i>
                                          </button>
                                      </div>
                                  </div>
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
                             <!-- 103 -->
                            <input type="text" name="support_number" id="support_number" class="form-control" placeholder="" readonly="">
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
                             <!-- 104 -->
                            <input type="text" name="order_number" id="order_number" class="form-control" placeholder="" readonly="">
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
                                <!-- 105 -->
                                <input type="hidden" name="orderhenkan_datachar10_information1" id="orderhenkan_datachar10_information1"/>
                                <input type="text" class="form-control" name="contractor" id="contractor" placeholder="受注先" readonly=""
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
                                <!-- 106 -->
                                <input type="hidden" name="orderhenkan_datachar10_information3" id="orderhenkan_datachar10_information3"/>
                                <input type="text" name="end_customer" id="end_customer" class="form-control" placeholder="最終顧客" readonly=""
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
                          <td style="border: none!important;text-align: left;color: black;width: 95px !important;padding-left:0px!important;">
                            <div class="line-icon-box float-left mr-3"></div>受注日
                          </td>
                          <td style="border: none!important;width: 143px;">
                            <div class="input-group">
                              <input type="text" class="form-control" id="datepicker1_oen" name="datepicker1_oen" 
                                oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                maxlength="10" autocomplete="off" placeholder="年/月/日" style="" value="">
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
                            <div class="line-icon-box float-left mr-3"></div>納期
                          </td>
                          <td style="border: none!important;width: 143px;">
                            <div class="input-group">
                              <input type="text" class="form-control" id="datepicker2_oen" name="datepicker2_oen" 
                                oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                maxlength="10" autocomplete="off" placeholder="年/月/日" style="" value="">
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
                              <input type="text" class="form-control" id="datepicker3_oen" name="datepicker3_oen" 
                                oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                maxlength="10" autocomplete="off" placeholder="年/月/日" style="" value="">
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
                              <input type="text" class="form-control" id="datepicker4_oen" name="datepicker4_oen" 
                                oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                maxlength="10" autocomplete="off" placeholder="年/月/日" style="" value="">
                              <input type="hidden" class="datePickerHidden">
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="ml-3">
                    <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                      <tbody>
                        <tr>
                          <td style="border: none!important;text-align: left;color: black;width: 94px !important;padding-left:0px!important;">
                            <div class="line-icon-box float-left mr-3"></div>入金日
                          </td>
                          <td style="border: none!important;width: 143px;">
                            <div class="input-group">
                              <input type="text" class="form-control" id="datepicker5_oen" name="datepicker5_oen" 
                                oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                maxlength="10" autocomplete="off" placeholder="年/月/日" style="" value="">
                              <input type="hidden" class="datePickerHidden">
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12" style="margin-top: 7px;">
                    <div class="buttom-btn text-right" style="border-top: 1px solid #E1E1E1;"></div>
                      <table class="table custom-form"
                        style="border: none!important;width: auto;margin-top: 7px;float:right;">
                        <tbody>
                          <tr style="">
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style=" border: none!important;width: 60px!important;color: #000; font-size: 0.9em;font-weight: bold;">SE粗利計
                            </td>
                            <td style=" border: none!important;width: 15px!important;"></td>
                            <td style=" border: none!important;width: 50%;color: #000;font-size: 0.9em;font-weight: bold;" id="se_profit_meter">¥ </td>
                            <input type="hidden" id="hidden_se_profit_meter" name="hidden_se_profit_meter">
                          </tr>
                        </tbody>
                      </table>
                  </div>
                  <div class="col-12" style="margin-bottom: 2px;">
                    <div style="border-top: 1px solid #E1E1E1; margin-top: 6px;"></div>  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
 <div class="content-bottom-section" style="padding-bottom:46px;">