<div class="content-head-section custom-mb" style="padding: 13px 0 0;">
  <div class="container position-relative">

  {{-- Success Message Starts Here --}}
      @if(Session::has('success_msg'))
          <div class="row success-msg-box" id="success_msg" style="position: relative; width: 100%; max-width: 1452px; z-index: 1;" >
              <div class="col-12" style="white-space: normal; word-break: break-all;">
                  <div class="alert alert-primary alert-dismissible">
                      <button type="button" class="close dismissMe" data-dismiss="alert" autofocus
                              onclick="$('#datepicker1_oen').focus();">
                          &times;
                      </button>
                      <strong>{{session()->pull('success_msg') }}</strong>
                  </div>
              </div>
          </div>
      @endif
      {{-- Success Message Ends Here --}}

      {{-- Error Message Starts Here --}}
      <div  class="common_error" id="error_msg_div">@if(isset($paymentHistoryError)&& $paymentHistoryError!=null){{$paymentHistoryError}} @elseif(Session::has('error_msg')) {!! session()->pull('error_msg')  !!} @endif</div>
      {{-- Error Message Ends Here --}}
    <!-- <div class="row success-msg-box d-none " id="session_msg" style="position: relative; z-index: 1;" >
      <div class="col-12">
        <div class="alert alert-primary alert-dismissible">
          <button type="button" class="close dismissAlertMessage"  data-dismiss="alert" autofocus onclick="$('#categorikanri').focus();">
          &times;</button>
          <strong>success message</strong>
        </div>
      </div>
    </div> -->
    <script>
      // Focus on Alert Closing
      // $(".dismissMe").keydown(function(e) {
      //     if (e.shiftKey && e.which == 13) {
      //         $('.close').alert('close');
      //         event.preventDefault();
      //         document.getElementById("categorikanri").click();
      //         $('#categorikanri').focus();
      //     }
      // });
    </script>
  
    {{-- Error Message Starts Here --}}
      <div class="row">
        <div class="col-12">
          <div id="error_data" class="common_error" style="color: red;position: relative;"></div>
        </div>
      </div>
    {{-- Error Message Ends Here --}}

    <form id="firstSearch" action="{{ route('purchaseSlip') }}" method="post">
      <input type="hidden" name="firstButton" value="topSearch">
      <input type="hidden" id="userId" name="userId" value="{{$bango}}">
      <input type="hidden" id="tax_rate" name="tax_rate" value="@if(isset($tax_rate)){{ $tax_rate['value'] }}@endif">
      <input type="hidden" id="format" name="format" value="@if(isset($tax_rate)){{ $tax_rate['format'] }}@endif">
      @csrf
    <div class="row pay_history_list_top_content purchase_slips_top">
      <div class="col">

        {{-- Top Contents Starts Here --}}
        <div class="content-head-top">
          <div class="row">

            {{-- Top Left Side Contents Starts Here --}}
            <div class="ml-3 mr-5" style="width: auto;">
              <table class="table custom-form " style="border: none!important;">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style=" border: none!important;width: 70px!important;">仕入先</td>
                    <td style="border: none!important;width: 537px;">
                      <div>
                        <div class="input-group input-group-sm custom_modal_input">
                            <input type="text" class="form-control reg_sold_to" name="reg_sold_to_text" value="{{isset($fsReqData['reg_sold_to_text'])?$fsReqData['reg_sold_to_text']:null}}"
                                id="reg_sold_to" placeholder="仕入先" readonly="" style="padding-left: 0px !important;padding-right: 0px !important;max-width:507px!important;" autofocus>
                            <input type="hidden" name="reg_sold_to" value="{{isset($fsReqData['reg_sold_to'])?$fsReqData['reg_sold_to']:null}}"
                                id="reg_sold_to_db">
                            <div class="input-group-append">
                                <button type="button" class="input-group-text btn"
                                        onclick="supplierSelectionModalOpener_2('reg_sold_to','reg_sold_to_db','1','nullable','r16cd',event.preventDefault())">
                                    <i class="fas fa-arrow-left"></i></button>
                            </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td style="width: 5%!important;padding: 0!important;border:0!important;">
                      <div class="line-icon-box"></div>
                    </td>
                    <td style="border: none!important;width: 10%!important;">入力担当者</td>
                    <td style=" border: none!important;width: 75%;">
                      <div class="custom-arrow">
                        
                        <select name="input_person" id="input_person" class="form-control">
                            <option value="">-</option>
                            @foreach($incharge_purchasing as $person)
                            @if(isset($fsReqData['input_person']))
                            <option value="{{$person->bango}}" @if($person->
                              bango==$fsReqData['input_person']){{'selected'}}@endif>
                              {{$person->bango." ".$person->name}}
                            </option>
                            @else
                            @if(isset($fsReqData) && count($fsReqData)>0)
                            <option value="{{$person->bango}}">
                              {{$person->bango." ".$person->name}}
                            </option>
                            @else
                            <option value="{{$person->bango}}" @if($person->bango==$bango){{'selected'}}@endif>
                              {{$person->bango." ".$person->name}}
                            </option>
                            @endif
                            @endif
                            @endforeach
                          </select>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>

            </div>
            {{-- Top Left Side Contents Ends Here --}}


          </div>
        </div>
        {{-- Top Contents Ends Here --}}

        {{-- Checkbox with Button Starts Here --}}
        <div class="content-head-top" style="margin-bottom: 5px;">
          <div class="row mb-4 mt-4">
            <div class="col-8">
              
            </div>
            <div class="col-4">
                  <div class="d-inline-block float-right">
                    <a style="width: 150px;height:30px;line-height:30px;" href="#" class="btn btn-info" id="topSearchBtn">表示</a>
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