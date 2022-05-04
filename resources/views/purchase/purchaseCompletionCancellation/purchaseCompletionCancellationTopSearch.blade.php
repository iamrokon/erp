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
    <div class="row billing-cancellation">
      <div class="col">
        <div class="content-head-top" style="padding-top: 60px;">
          <div class="row">
            <div class="col">
              <table class="table custom-form" style="border: none!important;width: auto;margin-bottom: 2px!important;">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 67px!important;">受注番号</td>
                    <td style=" border: none!important;width: 180px;">
                      <input autofocus="" type="text" name="order_number" id="order_number"  class="form-control" autocomplete="off" value="" placeholder="受注件名">
                    </td>
                    <td style=" border: none!important;width: 50%;">
                      <input autofocus="" type="text" name="order_subject" id="order_subject" class="form-control" autocomplete="off" value="受注件名" readonly>
                    </td>
                    <td style=" border: none!important;width: 180px;">
                      <input autofocus="" type="text" name="employee_code" id="employee_code" class="form-control" autocomplete="off" value="社員" readonly>
                    </td>
                    <td style=" border: none!important;width: 180px;">
                      <input autofocus="" type="text" name="order_amount" id="order_amount" class="form-control" autocomplete="off" value="受注金額" readonly>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="content-head-top">
          <div class="row my-3">
            <div class="ml-3 mr-3 d-flex w-100 justify-content-end">
              <div>
                <button id="contenthide" href="#" class="btn btn-info uskc-button">実 行</button>
              </div>
              <div class="loading-icon" style="">
                <span style=""><i class="fa fa-spinner" aria-hidden="true" style="font-size: 26px;"></i></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- container-fluid div end -->
</div>