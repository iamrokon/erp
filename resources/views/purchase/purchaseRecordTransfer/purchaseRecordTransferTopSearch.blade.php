<div class="content-head-section custom-mb" style="padding: 13px 0 0;">
  <div class="container position-relative">
    <div class="row success-msg-box d-none " id="session_msg" style="position: relative; z-index: 1;" >
      <div class="col-12">
        <div class="alert alert-primary alert-dismissible">
          <button type="button" class="close dismissAlertMessage"  data-dismiss="alert" autofocus onclick="$('#categorikanri').focus();">
          &times;</button>
          <strong>success message</strong>
        </div>
      </div>
    </div>
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
    <div class="row order_entry_topcontent purchase_record_transfer">
      <div class="col">
  <form id="mainForm1" method="post"> 
    <input type="hidden" id="userId" name="userId" value="{{$bango}}">
    <input type="hidden" id="csrf" value="{{ csrf_token() }}" name="_token">
    <input id='submit_confirmation' value='' type='hidden'/>

        <div class="content-head-top" style="padding-bottom: 16px;">
          <div class="row">
            <div class="ml-3 mr-3">
              <table class="table custom-form"
                style="border: none!important;margin-bottom:4px !important;">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 71px!important;">振替元受注番号</td>
                    <td style=" border: none!important;width: 151px;">
                      <input autofocus="" type="text" name="order_number_101" id="order_number_101" class="form-control" autocomplete="off" value="" placeholder="">
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
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 71px!important;">受注先</td>
                    <td style=" border: none!important;width: 360px;">
                      <input  type="text" name="data_102" id="data_102" class="form-control" autocomplete="off" value="" placeholder="受注先" readonly>
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
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 71px!important;">受注担当</td>
                    <td style=" border: none!important;width: 151px;">
                      <input  type="text" name="data_103" id="data_103" class="form-control" autocomplete="off" value="" placeholder="受注担当" readonly>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="content-head-top">
          <div class="row mb-4 mt-4">
            <div class="col-8">
         
            </div>
            <div class="col-4">
              <div class="d-inline-block float-right">
                <button onclick="firstSearch('{{route('sourceOrderData')}}',event.preventDefault())" style="width: 150px;height:30px;line-height:30px;" class="btn btn-info">表示</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </form>
  </div>
</div>
