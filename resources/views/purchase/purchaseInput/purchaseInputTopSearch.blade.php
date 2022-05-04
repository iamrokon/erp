<div class="content-head-section">
  <div class="container position-relative">
  
  {{-- Success Message Starts Here --}}
  @if (Session::has('success_msg'))
  <div class="row success-msg-box" id="session_msg" style="position: relative; z-index: 1;" >
    <div class="col-12">
      <div class="alert alert-primary alert-dismissible">
        <button type="button" class="close dismissAlertMessage"  data-dismiss="alert" autofocus onclick="$('#categorikanri').focus();">
        &times;</button>
        <strong>{{ session()->pull('success_msg') }}</strong>
      </div>
    </div>
  </div>
  @endif
  {{-- Success Message Ends Here --}}
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
        <div id="error_data" class="common_error" style="color: red;position: relative;"></div>
      </div>
    </div>
  {{-- Error Message Ends Here --}}

    <div class="row purchase_input">
      <div class="col">
        <div class="content-head-top">
          <div class="row">
            <div class="col">
              <table class="table custom-form custom-table"
                style="border: none!important;width: auto;margin-bottom:6px !important;">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 79px!important;">仕入購入区分
                    </td>
                    <td style=" border: none!important;width: 202px;">
                      <div class="custom-arrow">
                        <select class="form-control" name="order_category" id="categorikanri" autofocus disabled>
                          <option value="">-</option>
                        @foreach ($categorykanriesU1 as $categoryKanri) 
                          <option value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}">
                          {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                          </option>
                        @endforeach
                        </select>
                      </div>
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
                    <td style="width: 93px!important;padding: 1px!important;border:0!important;padding-left: 0px!important;">
                      <div class="line-icon-box "><span style="padding-left:28px;">作成区分<span>
                      </div>
                    </td>
                    <td style=" border: none!important; min-width: 179px!important;">
                      <div class="custom-arrow">
                        <select class="form-control" name="creation_category" id="request" autofocus>
                          @foreach ($request1s as $request)
                            <option value="{{ $request->syouhinbango }}">
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
                          <input type="text" class="form-control open_number_search_input" name="number_search" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" id="number_search" placeholder="番号検索"
                            style="padding: 0!important;">
                          <input type="hidden" name="ordertypebango2" id="ordertypebango2">
                          <div class="input-group-append" id="modalarea"
                            style="margin-left: 0px!important;">
                          <button type="button" class="input-group-text btn open_number_search" onclick="handleNumberSearchModalOpener('number_search',event.preventDefault())"><i class="fas fa-arrow-left"></i></button>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col">
              <table class="table custom-form" style="border: none!important;margin-bottom:4px !important;">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box" style="margin-right: 9px;"></div>
                    </td>
                    <td style=" border: none!important;width: 69px!important;padding-left:0px!important;">仕入番号</td>
                    <td style=" border: none!important;width: 152px;">
                      <input type="text" id="purchase_number" name="purchase_number" class="form-control" placeholder="" readonly="">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row" style="padding-top: 0px;">
            <div class="col-3">
              <table class="table custom-form custom-table" style="margin-bottom: 6px!important;width:auto;">
                <tbody>
                  <tr>
                    <td
                      style="border: none!important;text-align: left;color: black;width: 103px !important;padding-left: 0px!important;">
                      <div class="line-icon-box float-left" style="margin-right: 12px;"></div>仕入日
                    </td>
                    <td style="border: none!important;width: 203px !important;">
                      <div class="input-group">
                        <input type="text" class="form-control datepicker1" id="datepicker1_oen" name="purchase_date"
                          oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                          maxlength="10" autocomplete="off" placeholder="年/月/日" style="" value="">
                        <input id="datepicker1_comShow" type="hidden" class="datePickerHidden">
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-6">
              <table class="table custom-form custom-table" style="margin-bottom: 2px!important;width:auto;">
                <tbody>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;width: 94px !important;padding-left: 0px!important;">
                      <div class="line-icon-box float-left mr-3"></div>仕入先
                    </td>
                    <td style="border: none!important;width: 499px;">
                      <div style="width: 100% !important;">
                        <div class="input-group input-group-sm position-relative custom_modal_input   ">
                          <input id="supplier_v2" type="text" class="form-control" placeholder="仕入先" readonly>
                          <input id="supplier_db" type="hidden" name="supplier" class="db_hidden_field supplier_db">
                          <div class="input-group-append" id="modalarea" style="margin-left:0px!important;">
                            <button type="button" onclick="supplierSelectionModalOpener_2('supplier_v2','supplier_db','2','nullable','r16cd',2,event.preventDefault())"
                            class="input-group-text btn sold_to_modal_opener"><i class="fas fa-arrow-left"></i></button>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col">
              <table class="table custom-form" style="margin-bottom: 2px!important;">
                <tbody>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;width: 94px !important;padding-left: 0px!important;">
                      <div class="line-icon-box float-left mr-3"></div>担当
                    </td>
                    <td style="border: none!important;width: 151px;">
                      <div class="custom-arrow">
                        <select class="form-control" name="tantou" id="employee_id" autofocus="">
                          <option value="">-</option>
                          @foreach ($name as $tanto)
                            <option value="{{ $tanto->name}}" {{--( $tanto->name == $tantousya->name) ? 'selected' : '' --}}>
                              {{ $tanto->name }}
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
          <div class="row" style="padding-top: 0px;">
            <div class="col">
              <table class="table custom-form custom-table" style="margin-bottom: 6px!important;width:305px;">
                <tbody>
                  <tr>
                    <td
                      style="border: none!important;text-align: left;color: black;width: 103px !important;padding-left: 0px!important;">
                      <div class="line-icon-box float-left" style="margin-right: 12px;"></div>納品書番号
                    </td>
                    <td style="border: none!important;">
                      <input type="text" id="delivery_note" name="delivery_note" class="form-control" maxlength="20" placeholder="" oninput="this.value = this.value.replace(/[^A-za-z0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col">
              <table class="table custom-form custom-table" style="margin-bottom: 2px!important;">
                <tbody>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;width: 66px !important;padding-left: 0px!important;">
                      <div class="line-icon-box float-left mr-3"></div>納品書日付
                    </td>
                    <td style="border: none!important;width: 151px;">
                      <input type="text" class="form-control" id="datepicker3"
                                oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                maxlength="10" autocomplete="off" placeholder="年/月/日" style="" value="" name="delivery_date" >
                              <input type="hidden" class="datePickerHidden">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col">
              <table class="table custom-form custom-table" style="width:auto; margin-bottom: 2px!important;">
                <tbody>
                  <tr>
                    <td
                      style="padding: 0!important;border: none!important;text-align: left;color: black;width: 78px !important;">
                      <div class="line-icon-box float-left" style="margin-right:12px;"></div>支払方法
                    </td>
                    <td style="border: none!important;width: 218px !important;">
                      <div class="custom-arrow">
                        <select class="form-control" name="payment_method" id="payment_method" autofocus="" disabled="true" ignore  readonly>
                          <option value=""></option>
                          @foreach ($U2Data as $categoryKanri)
                            <option value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}">
                              {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col">
              <table class="table custom-form" style="margin-bottom: 2px!important;">
                <tbody>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;width: 94px !important;padding-left: 0px!important;">
                      <div class="line-icon-box float-left mr-3"></div>支払日
                    </td>
                    <td style="border: none!important;width: 151px;">
                      <div class="input-group">
                        <input type="text" class="form-control datepicker2" id="datepicker2_oen" name="payment_date"
                          oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                          maxlength="10" autocomplete="off" placeholder="年/月/日" style="" value="">
                        <input id="datepicker2_comShow" type="hidden" class="datePickerHidden">
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <table class="table custom-form " style="border: none!important;">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 79px!important;">受注先</td>
                    <td style=" border: none!important;">
                      <div class="input-group input-group-sm custom_modal_input" style="margin-bottom: 6px;">
                        <input id="reg_sold_to" type="text" class="form-control" placeholder="受注先"  readonly>
                        <input id="reg_sold_to_db" type="hidden" name="sold_to" class="db_hidden_field">
                        <div class="input-group-append"
                          style="margin-left: 0px!important;">
                          <button type="button" onclick="supplierSelectionModalOpener_2('reg_sold_to','reg_sold_to_db','1','required','r20cd',2,event.preventDefault())" class="input-group-text btn sold_to_modal_opener" name="juchusaki-button"><i class="fas fa-arrow-left"></i></button>
                        </div>    
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
                        <input id="reg_end_customer" type="text" class="form-control" placeholder="最終顧客" readonly="">
                        <input id="reg_end_customer_db" type="hidden" name="end_customer" class="db_hidden_field" />
                        <div class="input-group-append" 
                          style="margin-left: 0px!important;">
                          <button type="button" onclick="supplierSelectionModalOpener_2('reg_end_customer','reg_end_customer_db','1','required','r20cd',event.preventDefault())" class="input-group-text btn sold_to_modal_opener" 
                          name="saisyukokyaku-button" ><i class="fas fa-arrow-left"></i></button>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col">
              <table class="table custom-form" style="border: none!important;width: auto;margin-bottom:4px !important;">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 54px!important;">指示者</td>
                    <td style=" border: none!important;width: 216px;">
                      <input type="hidden" class="form-control" id="instructor" name="instructor" >
                      <input type="text" id="instructorShow" name="instructorShow" class="form-control" placeholder="" readonly="">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col">
              <table class="table custom-form" style="border: none!important;margin-bottom:4px !important">
                <tbody>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;width: 94px !important;padding-left: 0px!important;">
                      <div class="line-icon-box float-left mr-3"></div>検印者
                    </td>
                    <td style=" border: none!important;width: 151px">
                      <div>
                        <div class="input-group input-group-sm position-relative">
                          <input type="hidden" class="form-control" id="inspector" name="inspector" >
                          <input type="text" class="form-control" id="inspectorShow" name="inspectorShow" placeholder="" readonly=""
                            style="padding: 0!important;">
                          <div class="input-group-append">
                            <button type="button" class="input-group-text btn inspector-button" id="inspectorButton"
                              style="padding-left: 7px!important;width: 40px!important">検印</button>
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
      </div>
    </div>
    <div style="border-top: 1px solid #E1E1E1; border-bottom: 1px solid #E1E1E1;margin-top:100px;margin-bottom:8px;">
      <div class="row">
        <div class="d-flex mt-4 mb-4 w-100 ml-3 mr-3 justify-content-end">
          <div>
            <button type="button" class="btn btn-info uskc-button" id="topSearchSubmitButton">表&nbsp;&nbsp;示</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>