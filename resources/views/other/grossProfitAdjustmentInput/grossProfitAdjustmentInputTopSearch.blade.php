<div class="content-head-section custom-mb" style="padding: 13px 0 0;">
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
    <div class="row order_entry_topcontent gross_profit_adjustment_input">
      <div class="col">
        <div class="content-head-top" style="margin-bottom: 0px;">
          <div class="row">
            <div class="ml-3 mr-3">
              <table class="table custom-form custom-table"
                style="border: none!important;width: auto;margin-bottom:4px !important;">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 79px!important;">発注金額分類</td>
                    <td style=" border: none!important;width: 202px;">
                      <div class="custom-arrow">
                        <select class="form-control" name="order_category" id="categorikanri"  autofocus>
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
            <div class="ml-3 mr-3">
              <table class="table custom-form"
                style="border: none!important;margin-bottom:4px !important;">
                <tbody>
                  <tr>
                    <td style="width: 93px!important;padding: 1px!important;border:0!important;">
                      <div class="line-icon-box "><span style="padding-left:28px;">担当<span></div>
                    </td>
                    <td style=" border: none!important; min-width: 179px!important;">
                      <div class="custom-arrow">
                        <select class="form-control" name="employee" id="employee_cd" autofocus>
                          <option value="">-</option>
                          @foreach ($name as $tanto)
                            {{--<option value="{{ $tanto->bango}}" {{ ( $tanto->bango == $tantousya->bango) ? 'selected' : '' }}>--}}
                            <option value="{{ $tanto->bango}}">
                                {{ $tanto->bango." ".$tanto->name }}
                            </option>
                          @endforeach
                        </select>
                        <input type="hidden" name="employee_cd" id="employee">
                        {{-- @if($isSelected)
                          <input type="hidden" name="employee_cd" id="employee" value="{{$isSelected}}">
                        @else
                          <input type="hidden" name="employee_cd" id="employee">
                        @endif --}}
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
      
          </div>
          @php  
            $system_date = date('Y/m/d');
          @endphp
          <div class="row mb-2" style="padding-top: 0px;">
            <div class="ml-3 mr-3">
              <table class="table custom-form custom-table" style="margin-bottom: 2px!important;width:auto;">
                <tbody>
                  <tr>
                    <td
                      style="border: none!important;text-align: left;color: black;width: 103px !important;padding-left: 0px!important;">
                      <div class="line-icon-box float-left mr-3"></div>処理日
                    </td>
                    <td style="border: none!important;width: 203px !important;">
                      <div class="input-group">
                        <input type="text" class="form-control" id="datepicker1_oen" name="order_date"
                          oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                          maxlength="10" autocomplete="off" placeholder="年/月/日" style="" value="{{$system_date}}">
                        <input type="hidden" class="datePickerHidden">
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row mb-2" style="padding-top: 0px;">
            <div class="col-3">
              <table class="table custom-form custom-table" style="margin-bottom: 2px!important;width:305px;">
                <tbody>
                  <tr>
                    <td
                      style="border: none!important;text-align: left;color: black;width: 103px !important;padding-left: 0px!important;">
                      <div class="line-icon-box float-left mr-3"></div>受注番号
                    </td>
                    <td style="border: none!important;">
                      <input type="text" name="order_number" id="order_number" class="form-control" placeholder="受注番号" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-9">
              <table class="table custom-form" style="margin-bottom: 2px!important;">
                <tbody>
                  <tr>
                   
                    <td style="border: none!important; width:552px!important;">
                      <input type="text" name="order_subject" id="order_subject" class="form-control" placeholder="受注件名" readonly>
                    </td>
                    <td style="border: none!important;width: 218px!important;">
                      <input type="text" name="employee_name" id="employee_name" class="form-control" placeholder="社員姓 社員名" readonly>
                    </td>
                    <td style="border: none!important;width: 213px!important;">
                      <input type="text" name="order_amount" id="order_amount" class="form-control text-right" readonly placeholder="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-9"></div>
            <div class="col-3">
                  <table class="table custom-form" style="border: none!important;margin-bottom:0px!important;">
                    <tbody>
                      <tr style="">
                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                          <div class="line-icon-box"></div>
                        </td>
                        <td style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;    font-size: 0.9em;">
                          合計金額</td>
                        <td style=" border: none!important;width: 15px!important;"></td>
                        <td id="total_order_amount_show" style=" border: none!important;width: 208px!important;color: #000;font-weight: bold;font-size: 0.9em;">
                          ¥ </td>
                        <input type="hidden" name="total_order_amount" id="total_order_amount" class="form-control text-right" readonly>
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