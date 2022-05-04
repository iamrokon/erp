<div class="content-head-section custom-mb" style="padding: 13px 0 0;">
  <div class="container position-relative">
    <form id="firstSearch" action="" method="post">
      <input type="hidden" name="Button" id="firstButton" value="{{isset($old['Button'])?$old['Button']:null}}">
      <input type="hidden" id="fs_userId" name="userId" value="{{$bango}}">
      <input type="hidden" id="first_csrf" value="{{csrf_token()}}" name="_token" disabled>
      <input type="hidden" id="source" value="purchaseInquiryResult"/>
      <input id='submit_confirmation' value='' type='hidden'/>
      @csrf
    {{-- Success Message Starts Here --}}
    @if(Session::has('success_msg'))
    <div class="row success-msg-box" id="session_msg" style="position: relative; z-index: 1;" >
      <div class="col-12">
        <div class="alert alert-primary alert-dismissible">
          <button type="button" class="close dismissAlertMessage"  data-dismiss="alert" autofocus onclick="$('#support_number_1').focus();">
          &times;</button>
          <strong>{{session()->pull('success_msg') }}</strong>
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
          @if(isset($exceedUser))
            <p id="no_found_data" class="common_error">{{$exceedUser}}</p>
          @endif
        </div>
      </div>
    {{-- Error Message Ends Here --}}
    <div class="row order_entry_topcontent purchase_inquiry_result_top">
      <div class="col">

        {{-- Top Contents Starts Here --}}
        <div class="content-head-top">

          <div class="row mb-2">
            <div class="ml-3 mr-3">
              <table class="table custom-form custom-table" style="border: none!important;width: auto;margin-bottom:4px !important;">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 79px!important;">サポート番号行</td>
                    <td style=" border: none!important;width: 202px;">
                      <input type="text" id="support_number_1" name="support_number" class="form-control" placeholder="" value="{{$support_number}}" readonly="" autofocus="">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
           
            <div class="ml-3 mr-3">
              <table class="table custom-form" style="border: none!important;width: auto;margin-bottom:4px !important;">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 103px!important;">外注発注番号</td>
                    <td style=" border: none!important;width: 202px;">
                      <input type="text" name="kokyakuorderbango" class="form-control" value="{{$kokyakuorderbango}}" placeholder="" readonly="" >
                    </td>
                  </tr>
                </tbody>
              </table>
    
            </div>

          </div>


        </div>


        {{-- Top Contents Ends Here --}}
        <div class="content-head-top" style="padding-bottom: 13px;">
          <div class="row">
            <div class="ml-3 mr-3">
              <table class="table custom-form custom-table" style="border: none!important;width: auto;margin-bottom:2px !important;">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 83px!important;">担当</td>
                    <td style=" border: none!important;width: 202px;">
                    <input type="text" name="employe_cd" class="form-control" placeholder="" value="{{$orderhenkanData->name}}" readonly="">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="ml-3 mr-3">
              <table class="table custom-form custom-table" style="border: none!important;width: auto;margin-bottom:2px !important;">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 103px!important;">受注先</td>
                    <td style=" border: none!important;width: 202px;">
                    <input type="text" name="" class="form-control" placeholder="受注先" value="{{$orderhenkanData->contractor}}" readonly="">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="ml-3 mr-3">
              <table class="table custom-form" style="border: none!important;width: auto;margin-bottom:2px !important;">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 79px!important;">受注件名</td>
                    <td style=" border: none!important;width: 202px;">
                    <input type="text" name="" class="form-control" placeholder="受注内容" value="{{$juchukubun1}}" readonly="">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div class="row">
            <div class="ml-3 mr-3">
              <table class="table custom-form custom-table" style="border: none!important;width: auto;margin-bottom:2px !important;">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 83px!important;">売上日</td>
                    <td style=" border: none!important;width: 202px;">
                      <input type="text" name="" class="form-control" placeholder="年/月/日" value="{{$intorder03}}" readonly="">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="ml-3 mr-3">
              <table class="table custom-form custom-table" style="border: none!important;width: auto;margin-bottom:4px !important;">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 79px!important;color: #000;font-weight: bold;font-size: 0.9em;">外注発注金額：</td>
                    <td style=" border: none!important;width: 203px;color: #000;font-weight: bold;font-size: 0.9em;">¥
                    @if(isset($orderhenkanData->intorder01))
                                {{number_format($orderhenkanData->intorder01)}} @endif</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="ml-3 mr-3">
              <table class="table custom-form" style="border: none!important;width: auto;margin-bottom:4px !important;">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 79px!important;color: #000;font-weight: bold;font-size: 0.9em;">差額計：</td>
                    <td style=" border: none!important;width: 202px;color: #000;font-weight: bold;font-size: 0.9em;">¥
                    @if(isset($order_amount))
                                {{number_format($order_amount)}} @endif</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
 
        </div>
        {{-- Checkbox with Button Starts Here --}}
        <div class="content-head-top">
          <div class="row mb-4 mt-4">
            <div class="col-8">

            </div>
            <div class="col-4">
          

              <div class="d-inline-block float-right">
                <table class="table custom-form" style="width: auto;margin-bottom: 0px!important;">
                  <tbody>
                    <tr>
                      <td style="border: none!important;text-align: left;color: black;width: 94px !important;">
                        <div class="line-icon-box float-left mr-3"></div>完了指検
                      </td>
                      <td style="border: none!important;width:100px;">
                        <div class="custom-arrow">
                          <select class="form-control" name="selected_inspection" id="">
                          <option value="1" @if($purchase_flag ==1){{'selected'}}@endif>1 未</option>
                                <option value="2" @if($purchase_flag == 2){{'selected'}}@endif>2 指示</option>
                                <option value="3" @if($purchase_flag == 3){{'selected'}}@endif @if($tantousya->innerlevel > 18){{'disabled'}}@endif>3 検印</option>
                                <option value="4" @if($purchase_flag == 4){{'selected'}}@endif @if($tantousya->innerlevel > 14){{'disabled'}}@endif>4 完了</option>
                          </select>
                          <input type="hidden" class="prev_inspection" name="prev_inspection" id="" value="{{ $purchase_flag }}">
                        </div>
                      </td>
                      <td style="border: none!important;width: 15px;">
                       
                      </td>
                      <td style="border: none!important;width: 150px;">
                        <button id="updateButton" onclick="updatePurchaseInquiryResult('{{route('updatePurchaseInquiryResult')}}',event.preventDefault())" type="submit" style="width: 150px;height:30px;line-height:30px;" class="btn btn-info">更新</button>
                      </td>
                    </tr>
                  </tbody>
                </table>
                
              </div>
            </div>
          </div>
        </div>
        {{-- Checkbox with Button Ends Here --}}

      </div>
    </div>
    </form>
  </div>
</div>