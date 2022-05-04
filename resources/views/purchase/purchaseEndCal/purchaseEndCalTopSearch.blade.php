<div class="content-head-section" style="padding: 13px 0 0;">
  <div class="container">
    <div class="row success-msg-box d-none " id="session_msg" style="position: relative; z-index: 1;" >
      <div class="col-12">
        <div class="alert alert-primary alert-dismissible mb-0">
          <button type="button" class="close dismissAlertMessage"  data-dismiss="alert" autofocus onclick="$('#categorikanri').focus();">
          &times;</button>
          <strong>success message</strong>
        </div>
      </div>
    </div>

    <div class="row success-msg-box" id="success_msg" style="width:100%; position: relative; width: 100%; max-width: 1452px; z-index: 1;"></div>
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
            <div  class="common_error" id="error_msg_div">@if(isset($dataCreationError)&& $dataCreationError!=null){{$dataCreationError}} @elseif(Session::has('error_msg')) {!! session()->pull('error_msg')  !!} @endif</div>
        </div>
      </div>
    {{-- Error Message Ends Here --}}
      @php $systemDate=date('Y/m/d') @endphp
    <div class="row purchaseEndCal_top">
        <form id="insertData" style="width: 100%;">
            <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token">
            <input type="hidden" name="bango" id="userId" value="{{$bango}}">
            <div class="col-12">
            @include('layout.commonOfficeDeptGroupAllRequired')
            <div class="row mb-2" style="padding-top: 0px;">
              <div class="col-7">
                <table class="table custom-form" style="width:212px;">
                  <tbody>
                    <tr>
                      <td style="border: none!important;text-align: left;color: black;padding: 0!important;">
                        <div class="line-icon-box float-left mr-3"></div>仕入完了日
                      </td>
                      <td style="border: none!important;width: 100px;">
                        <div class="input-group">
                          <input type="text" name="purchase_completion_date" id="purchase_completion_date" class="form-control datePicker datePicker1_1" autocomplete="off" value="{{$systemDate}}" placeholder="年/月/日" oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" maxlength="10" autofocus>
                          <input type="hidden" class="datePickerHidden">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td style="border: none!important;text-align: left;color: black;padding: 0!important;">
                        <div class="line-icon-box float-left mr-3"></div>受注番号
                      </td>
                      <td style="border: none!important;width: 100px;">
                        <div class="input-group">
                          <input autocomplete="off" type="text" class="form-control" name="order_no" id="order_no" value="" placeholder="" oninput="this.value = this.value.replace(/[^\d]/g, '');" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" maxlength="10" autocomplete="off">
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="content-head-top">
            <div class="row">
            <div class="col-9">
              <table class="table" style="width: auto;margin-bottom: 0px!important;float: right;">
                <tbody>
                  <tr>
                    <td style=" border: none!important;padding: 0px!important;">
                        <button onclick="createData();event.preventDefault();" href="#" class="btn btn-info uskc-button">実行</button>
                    </td>
                    <td style="border: none !important;">
                      <div class="loading-icon" style="">
                        <span style="font-size: 30px;"><i class="fa fa-spinner" aria-hidden="true"></i></span>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>
           </div>
      </div>
        </form>
  </div>

  </div>
</div>
