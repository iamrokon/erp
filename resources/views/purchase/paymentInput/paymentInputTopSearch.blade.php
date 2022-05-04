<div class="content-head-section custom-mb" style="padding-bottom: 11px;">
  <div class="container">
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
    <div class="row order_entry_topcontent payment_input inner-top-content">
      <div class="col">
        <div class="content-head-top" style="margin-bottom: 0px;">
          <div class="row">
            <div class="col">
              <table class="table custom-form custom-table"
                style="border: none!important;width: auto;margin-bottom:4px !important;">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    @php
                     $system_date = date('Y/m/d');
                    @endphp
                    <td style=" border: none!important;width: 79px!important;padding-left: 0px!important;">支払日</td>
                    <td style=" border: none!important;width: 202px;">
                      <div class="input-group">
                        <input type="text" class="form-control" id="datepicker1_oen"  name="payment_date"
                          oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                          maxlength="10" autocomplete="off" placeholder="年/月/日" style="" value="{{$system_date}}" autofocus>
                        <input type="hidden" class="datePickerHidden" value="{{$system_date}}">
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col">
              <table class="table custom-form custom-table"
                style="border: none!important;margin-bottom:4px !important;width:auto;">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 70px!important;">　会計伝票日</td>
                    <td style=" border: none!important; min-width: 179px!important;">
                      <div class="input-group">
                        <input type="text" class="form-control" id="datepicker2_oen" name="slip_date"
                          oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                          maxlength="10" autocomplete="off" placeholder="年/月/日" style="" value="{{$system_date}}">
                        <input type="hidden" class="datePickerHidden" value="{{$system_date}}">
                      </div>

                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col">
              <table class="table custom-form"
                style="border: none!important;width: auto;margin-bottom:4px !important">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 53px!important;">買掛区分</td>
                    <td style=" border: none!important;width: 219px">
                      <div style="width: 100% !important;">
                        <div class="custom-arrow">
                          <select class="form-control" name="payment_classification" id="payment_classification">
                            @foreach ($c4Categorykanries as $categoryKanri) 
                              <option value="{{ $categoryKanri->category2 }}">
                              {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                              </option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>


          </div>
          <div class="row" style="padding-top: 0px;">

            <div class="col-6">
              <table class="table custom-form custom-table" style="margin-bottom: 2px!important;width:auto;">
                <tbody>
                  <tr>
                    <td
                      style="border: none!important;text-align: left;color: black;width: 103px !important;padding-left:0px!important;">
                      <div class="line-icon-box float-left"></div>仕入先
                    </td>
                    <td style="border: none!important;width: 499px;">
                      <div style="width: 100% !important;">
                        <div class="input-group input-group-sm position-relative custom_modal_input ">
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
              <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                <tbody>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;width: 94px !important;">
                      <div class="line-icon-box float-left mr-3"></div>残高
                    </td>
                    <td style="border: none!important;width: 151px;">
                      <input type="text" name="balance" class="form-control text-right" placeholder="" value="0"
                        readonly="">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="col">
              <table class="table custom-form" style="border: none!important;width:auto;">
                <tbody>
                  <tr style="height: 28px;">
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td
                      style=" border: none!important;width: 36px!important;color: #000;font-weight: bold;font-size: 0.9em;">
                      合計</td>
                    <input type="hidden" name="total_amount" id="total_amount_db">
                    <td id="total_amount"
                      style=" border: none!important;width: 164px;color: #000;font-weight: bold;font-size: 0.9em;">
                      ¥
                      0</td>
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
