<div class="content-head-section" style="padding-bottom: 3px!important;">
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
          <div class="row order_entry_topcontent hatchu-nyuryoku inner-top-content">
            <div class="ml-3 mr-3">
              <div class="content-head-top">
                <div class="row">
                  <div class="col">
                    <table class="table custom-form custom-table"
                      style="border: none!important;margin-bottom: 4px !important;">
                      <tbody>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box" style="margin-right: 9px;"></div>
                          </td>
                          <td style=" border: none!important;width: 67px!important;padding-left: 0px!important;">発注区分</td>
                          <td style=" border: none!important;width: 178px;">
                            <div class="custom-arrow">
                              <select class="form-control" name="order_category" id="categorikanri" autofocus>
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
                      style="border: none!important;margin-bottom: 4px !important;">
                      <tbody>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 53px!important;">作成区分</td>
                          <td style=" border: none!important;width: 178px">
                            <div class="custom-arrow">
                              <select class="form-control" name="creation_category" id="request">
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
                  <div class="col">
                    <table class="table custom-form custom-table"
                      style="border: none!important;width: 100% !important;margin-bottom: 4px !important;">
                      <tbody>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 53px!important;">番号検索</td>
                          <td style=" border: none!important; min-width: 179px!important;">
                            <div style="width: 100% !important;">
                              <div class="input-group input-group-sm position-relative">
                                <input type="text" class="form-control" name="number_search" oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');" maxlength="10" id="number_search" placeholder="番号検索" 
                                  style="width: 127px!important;">
                                <input type="hidden" name="ordertypebango2" id="ordertypebango2">
                                <!-- <div class="input-group-append" id="modalarea" data-toggle="modal"
                                  data-target="#exampleModal3"> -->
                                  <button type="button" class="input-group-text btn open_number_search" type="button" style="height: 30px !important; width: 30px !important; padding: 0px 8px !important;" onclick="handleNumberSearchModalOpener('number_search',event.preventDefault())" name="ganboukensaku_button"><i class="fas fa-arrow-left"></i></button>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="col">
                    <table class="table custom-form" style="border: none!important;margin-bottom: 4px !important;">
                      <tbody>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 53px!important;">発注番号</td>
                          <td style=" border: none!important;width: 178px;">
                            <input type="text" id="order_number" class="form-control" placeholder="発注番号" name="order_number" readonly>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <table class="table custom-form custom-inpur-field"
                      style="border: none!important;margin-bottom: 4px !important;">
                      <tbody>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 76px!important;">仕入先</td>
                          <td style=" border: none!important;width: 468px;">
                            <div class="input-group input-group-sm custom_modal_input">
                              <!-- <input id="reg_sold_to" type="text" class="form-control" placeholder="仕入先" name="siiresaki" readonly> -->
                              <input id="supplier_v2" type="text" class="form-control" placeholder="仕入先"  readonly>
                              <input id="supplier_db" type="hidden" name="supplier" class="db_hidden_field supplier_db">
                              <div class="input-group-append" 
                                style="margin-left: 0px!important;">
                                <button type="button" name="siiresaki_button" onclick="supplierSelectionModalOpener('supplier_v2','supplier_db','2','nullable','r17',2,event.preventDefault())"
                                 class="input-group-text btn sold_to_modal_opener"><i class="fas fa-arrow-left"></i></button>
                              </div>
                            </div>
                          </td>
                          <td style="border: none!important;width: 218px;padding-left: 6px!important;">
                            <div class="input-group input-group-sm border-line-area" style="cursor: pointer;">
                              <button type="button" onkeydown="ignoreDisabledButton(event);" class="btn c_hover" name="torihikijoken"
                                style="background: #4D82C6;color: #fff!important;border:1px solid #4D82C6;width:115px; border-radius: 4px 0 0 4px;line-height: 26px;text-align: center;font-size: 13px;pointer-events: none !important;">
                                取引条件
                              </button>
                              <div class="input-group-append">
                                <button type="button" class="input-group-text btn igroup1" name="torihikijoken" id="igroup1" style="" type="button"><i
                                    class="fas fa-arrow-left"></i></button>
                              </div>
                            </div>
                          </td>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 35px!important;">サポート番号行番号</td>
                          <td style=" border: none!important;width: 274px;">
                            <div class="input-group input-group-sm position-relative">
                              <input type="text" class="form-control support_number_search" name="support_number_search" maxlength="13" placeholder="(サポート番号行番号)" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" 
                              id="support_number_search" style="width: 127px!important;">
                              <input type="hidden" name="suportOrdertypebango2" id="supportOrdertypebango2">
                              <div class="input-group-append" id="modalarea" >
                                <button type="button" class="input-group-text btn open_support_number_search" id= "support_number_search_button" name="support-bangou-button" onclick="handleSupportNumberSearchModalOpener('support_number_search',event.preventDefault())"><i class="fas fa-arrow-left"></i></button>
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
                    <table class="table custom-table custom-form custom-inpur-field"
                      style="border: none!important;margin-bottom: 4px !important;">
                      <tbody>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box" style="margin-right: 9px;"></div>
                          </td>
                          <td style=" border: none!important;width: 68px!important;padding-left: 0px!important;">発注日</td>
                          @php  
                            $system_date = date('Y/m/d');
                            @endphp
                          <td style=" border: none!important;width: 180px;">
                            <div class="input-group">
                              <input type="text" id="datepicker1_oen" class="form-control datePicker datePicker1" autocomplete="off" name="order_date"
                                value="{{$system_date}}" placeholder="年/月/日"
                                oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                maxlength="10">
                              <input type="hidden" id="datepicker1_comShow" class="datePickerHidden" >
                              <input type="hidden" id="order_entry_date" name="order_entry_date" >
                            </div>
                          </td>

                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-3">
                    <table class="table custom-form custom-table custom-inpur-field"
                      style="border: none!important;margin-bottom: 4px !important;">
                      <tbody>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 35px!important;">担当</td>
                          <td style=" border: none!important;width: 196px;">
                            <div class="custom-arrow">
                              <select id="ignoreButton" class="form-control tantou" name="tantou">
                                <!-- <option value="">{{ $tantousya->name }}</option> -->
                                @foreach ($name as $tanto)
                                <option value="{{ $tanto->name}}" {{ ( $tanto->name == $tantousya->name) ? 'selected' : '' }}>
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

                  <div class="col-6">
                    <table class="table custom-form custom-inpur-field"
                      style="border: none!important;margin-bottom: 4px !important;">
                      <tbody>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 100px!important;">仕入先見積番号</td>
                          <td style=" border: none!important;width: 469px;">
                            <input type="text"  class="form-control" name="siiresakimitumori" placeholder="(仕入先見積番号)" maxlength="15">
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="row">
                  <div class="col-6">
                    <table class="table custom-form custom-inpur-field"
                      style="border: none!important;margin-bottom: 4px !important;">
                      <tbody>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 85px!important;">受注先</td>
                          <td style=" border: none!important;width: 466px;">
                            <div class="input-group input-group-sm custom_modal_input">
                              <input id="reg_sold_to" type="text" class="form-control" placeholder="受注先"  readonly>
                              <input id="reg_sold_to_db" type="hidden" name="sold_to" class="db_hidden_field">
                              <div class="input-group-append"
                                style="margin-left: 0px!important;">
                                <button type="button" onclick="supplierSelectionModalOpener('reg_sold_to','reg_sold_to_db','1','required','r17_3cd',2,event.preventDefault())" class="input-group-text btn sold_to_modal_opener" name="juchusaki-button"><i class="fas fa-arrow-left"></i></button>
                              </div>
                            </div>
                          </td>
                
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <div class="col-6">

                    <table class="table custom-form custom-inpur-field d-flex justify-content-end align-content-end" style="border: none!important;margin-bottom: 4px !important;">
                    <tbody>
                      <tr>
                        <td style=" border: none!important;width: 134px!important;"></td>
                        <td style=" border: none!important;">
                          <div class="custom-select-file-upload input-group input-group-sm">
                            <div class="custom-file-area">
                              <div class="input-group input-group-sm">
                                <input type="file" accept=".zip,.pdf" class="custom-file-input" id="customFile" name="purchase_order" onchange="readURL(this);">
                                <input type="hidden" name="purchase_order_file_name">
                                <label class="custom-file-label c_hover custom_file_label_fhd " for="customFile"
                                  style="cursor: pointer;margin-right: -2px;background: #4D82C6;color: #fff!important; border: 1px solid #4D82C6;overflow: hidden;">仕入見積書PDFアップロード
                                </label>
                                <div class="input-group-append">
                                  <button type="button" id="fileUploadClose" class="input-group-text btn fileUploadClose" name="siiresakimitumori-sakujo" type="button"
                                    style="padding: 0px 10px !important;cursor: pointer!important;"><i
                                      class="fa fa-times" aria-hidden="true"></i></button>
                                </div>
                              </div>
                            </div>
                            <style type="text/css">
                              .custom-select-file-upload .custom-file-input:lang(en)~.custom-file-label::after {
                                  content: "";
                                  background: transparent;
                              }

                              .custom-select-file-upload .custom-file-input:lang(ja)~.custom-file-label::after {
                                  content: "";
                                  background: transparent;
                              }

                              .custom-select-file-upload .custom-file-label::after {
                                  border-left: 0px;
                              }

                              .custom-select-file-upload .custom-file-label {

                                  color: #fff;
                                  position: relative;
                                  margin-bottom: 0px;
                                  height: 30px;
                                  border: 1px solid #2C66B0;
                                  background: #2C66B0;
                              }

                              .custom-select-file-upload .custom-file-label:hover {
                                  background: #398BF7;
                                  border: 1px solid #398BF7;
                                  cursor: pointer !important;
                              }

                              .c_hover:hover {
                                  background: #398BF7 !important;
                                  border: 1px solid #398BF7 !important;
                                  cursor: pointer !important;
                              }

                          </style>
                          </div>
                        </td>
                  
                      </tr>
                    </tbody>
                  </table>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <table class="table custom-form custom-inpur-field"
                      style="border: none!important;margin-bottom: 4px !important;width:100%;">
                      <tbody>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 81px!important;">最終顧客</td>
                          <td style=" border: none!important;width: 466px;">
                            <div class="input-group input-group-sm custom_modal_input">
                              <input id="reg_end_customer" type="text" class="form-control" name="saisyukokyaku" placeholder="最終顧客" readonly>
                              <input id="reg_end_customer_db" type="hidden" name="end_customer" class="db_hidden_field" />
                              <div class="input-group-append" 
                                style="margin-left: 0px!important;">
                                <button type="button" onclick="supplierSelectionModalOpener('reg_end_customer','reg_end_customer_db','1','required','r17_3cd',2,event.preventDefault())" class="input-group-text btn sold_to_modal_opener" name="saisyukokyaku-button"><i class="fas fa-arrow-left"></i></button>
                              </div>
                            </div>
                          </td>
                          <td style="border: none!important;width: 28px!important;"></td>
                          <td style="border: none !important;">
                            <label class="checkbox_container header-checkbox"> 
                              <input class="checkAllCheckbox" type="checkbox" id="" name="saisyukokyaku_checkbox" value="1" checked>
                              <span class="checkmark" style="top: 1px;"></span>
                            </label>
                            <label style=" border: none!important;margin-left:28px;margin-top:1px;">印字する</label>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="row">
                  <div class="col-6">
                    <table class="table custom-form custom-inpur-field" style="border: none!important;width:100%;">
                      <tbody>
                        <tr>
                          <td style="width: 4%!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 64px!important;padding-left: 0px!important;">備考</td>
                          <td style=" border: none!important;width: 84%;">
                            <input type="text"  class="form-control" name="hacchu_bikou1" maxlength="60" placeholder="（発注備考1）"
                            value="納品書には必ず弊社発注番号・行番号を正確に記入して下さい。明日中に納期を発注担当者まで回答願います。">
                          </td>
                        </tr>
                        <tr>
                          <td style="border: none!important;"></td>
                          <td style="border: none!important;"></td>
                          <td style=" border: none!important;">
                            <input type="text"  class="form-control" name="hacchu_bikou2" maxlength="60" placeholder="（発注備考2）">
                          </td>
                        </tr>
                        <tr>
                          <td style="border: none!important;"></td>
                          <td style="border: none!important;"></td>
                          <td style=" border: none!important;">
                            <input type="text" class="form-control" name="hacchu_bikou3" maxlength="60" placeholder="（発注備考3）">
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <div class="col-3">
                   <!-- <table class="table custom-form custom-inpur-field" style="border: none!important;">
                      <tbody>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;width: 67px!important;">合計</td>
                          <td style=" border: none!important;width: 120px;">
                            // <input type="hidden" name="sales_amount_total" id="money10"> 
                            <input type="text" id="sales_amount_total" class="form-control text-right" name="goukei-kingaku" 
                              readonly>
                          </td>
                        </tr>
                        <tr>
                          <td style="width: 23px!important;padding: 0!important;border:0!important;">
                            <div class="line-icon-box"></div>
                          </td>
                          <td style=" border: none!important;">消費税合計</td>
                          <td style=" border: none!important;">
                            //<input type="hidden" name="gross_profit_margin" id="moneymax"> 
                            <input type="text" class="form-control text-right" name="syouhizei" id="totalTax"
                              readonly>
                          </td>
                        </tr>
                      </tbody>
                    </table> -->
                  </div>
                  <div class="col-3"></div>
                </div>
                <div class="row">
                  <div class="d-flex w-100 justify-content-center align-items-center" style="margin-left: 491px;">
                    <div class="row" style="margin-top: 5px;">
                      <div class="col">
                        <table class="table custom-form custom-table" style="border: none!important;width: auto;margin-bottom: 0px !important;">
                          <tbody>
                            <tr style="">
                              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                <div class="line-icon-box"></div>
                              </td>
                              <td
                                style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;    font-size: 0.9em;">
                                合計</td>
                              <input type="hidden" name="sales_amount_total" id="money10">
                              <td style=" border: none!important;width: 15px!important;"></td>
                              <td id="sales_amount_total"
                                style=" border: none!important;width: 50%;color: #000;font-weight: bold;    font-size: 0.9em;">
                                ¥ </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="col">
                        <table class="table custom-form" style="border: none!important;width: auto; margin-bottom: 0px !important;">
                          <tbody>
                            <tr style="">
                              <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                <div class="line-icon-box"></div>
                              </td>
                              <td
                                style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;    font-size: 0.9em;">
                                消費税合計</td>
                              <input type="hidden" name="totalTax" id="moneymax">
                              <td style=" border: none!important;width: 15px!important;"></td>
                              <td id="totalTax"
                                style=" border: none!important;width: 50%;color: #000;font-weight: bold;    font-size: 0.9em;">
                                ¥ </td>
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
 