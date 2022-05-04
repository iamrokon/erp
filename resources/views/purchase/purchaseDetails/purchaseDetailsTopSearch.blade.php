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
          <div id="error_data" class="common_error" style="color: red;position: relative;">@if(isset($purchaseDetailsError)&& $purchaseDetailsError!=null){{$purchaseDetailsError}}@endif</div>
        </div>
          <div class="col-12">
              <div id="warning_data" class="common_error" style="color: red;position: relative;">@if(isset($purchaseDetailsInfos)) @if(count($purchaseDetailsInfos)>0) @if(($purchaseDetailsInfos[0]->datachar16==1) && ($purchaseDetailsInfos[0]->datachar18!=null)) <p>仕入完了計算済です。</p> <p>仕入完了検印済です。</p> @elseif($purchaseDetailsInfos[0]->datachar16==1) <p>仕入完了計算済です。</p> @elseif($purchaseDetailsInfos[0]->datachar18!=null) <p>仕入完了検印済です。</p> @endif @endif @endif</div>
          </div>
      </div>
    {{-- Error Message Ends Here --}}
    <div class="row order_entry_topcontent purchase_details_top">
      <div class="col">
        <div class="content-head-top">
          <div class="row mb-2">
            <div class="col-5">
                <form id="firstSearch" action="{{ route('purchaseDetails') }}" method="post">
                    @csrf
                    <input type="hidden" name="firstButton" value="topSearch">
                    <input type="hidden" id="userId" name="userId" value="{{$bango}}">
                    <input type="hidden" id="userName" name="userName" value="{{$tantousya->name}}">
                    <input type="hidden" id="searchDetails" name="searchDetails" value="{{count($purchaseDetailsInfos)}}">
                    <input type="hidden" id="searchDetails1" name="searchDetails1" value="{{count($purchaseDetails1Infos)}}">
                    <input type="hidden" id="searchDetails2" name="searchDetails2" value="{{count($purchaseDetails2Infos)}}">
                    <input type="hidden" id="defaultSrc_h" name="defaultSrc_h" @if(Session::has('defaultSrc')) value="{{session()->pull('defaultSrc')}}" value="0" @else  @endif >
                    <input type="hidden" id="idoutanabango_h" name="idoutanabango_h" value="@if(isset($purchaseDetailsInfos)) @if(count($purchaseDetailsInfos)>0) {{$purchaseDetailsInfos[0]->idoutanabango}}  @endif @endif" >

                    <table class="table custom-form" style="margin-bottom: 2px!important;">
                    <tbody>
                      <tr>
                        <td style="border: none!important;text-align: left;color: black;width: 94px !important;padding-left: 0px!important;">
                          <div class="line-icon-box float-left mr-3"></div>受注番号
                        </td>
                        <td style="border: none!important;">
                          <input type="text" name="order_no" id="order_no" class="form-control num-input" placeholder="" autofocus oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="10" style="width: 200px !important;" value="{{isset($fsReqData['order_no'])?$fsReqData['order_no']:''}}">
                        </td>
                        <td style="border: none!important;padding-left: 0px!important;">
                          <a id="topSearchBtn" style="width: 100px;height: 28px;line-height: 28px;" class="btn btn-info">表示</a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </form>
            </div>
          </div>
        </div>

        <div class="content-head-top">
          <div class="row">
            <div class="col">
              <table class="table custom-form" style="margin-bottom: 2px!important;">
                <tbody>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;width: 94px !important;padding-left: 0px!important;">
                      <div class="line-icon-box float-left mr-3"></div>担当
                    </td>
                    <td style="border: none!important;">
                      <input type="text" name="" class="form-control" placeholder="" readonly="" value="@if(isset($purchaseDetailsInfos)) @if(count($purchaseDetailsInfos)>0) {{$purchaseDetailsInfos[0]->responsible_name}} @endif @endif">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col">
              <table class="table custom-form" style="margin-bottom: 2px!important;">
                <tbody>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;width: 80px !important;padding-left: 0px!important;">
                      <div class="line-icon-box float-left mr-3"></div>受注先
                    </td>
                    <td style="border: none!important;">
                      <input type="text" name="" class="form-control" placeholder="受注先" readonly="" value="@if(isset($purchaseDetailsInfos)) @if(count($purchaseDetailsInfos)>0) {{$purchaseDetailsInfos[0]->contractor}} @endif @endif">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col">
              <table class="table custom-form" style="margin-bottom: 2px!important;">
                <tbody>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;width: 90px !important;padding-left: 0px!important;">
                      <div class="line-icon-box float-left mr-3"></div>受注件名
                    </td>
                    <td style="border: none!important;">
                      <input type="text" name="" class="form-control" placeholder="受注内容" readonly="" value="@if(isset($purchaseDetailsInfos)) @if(count($purchaseDetailsInfos)>0) {{$purchaseDetailsInfos[0]->order_sub}} @endif @endif">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-4">
              <table class="table custom-form" style="margin-bottom: 2px!important;">
                <tbody>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;width: 94px !important;padding-left: 0px!important;">
                      <div class="line-icon-box float-left mr-3"></div>売上日
                    </td>
                    <td style="border: none!important;width: 151px;">
                      <input type="text" name="" class="form-control"  placeholder="年/月/日" readonly value="@if(isset($purchaseDetailsInfos)) @if(count($purchaseDetailsInfos)>0) {{$purchaseDetailsInfos[0]->sales_date}} @endif @endif">
                    </td>
                    <td style="border: none!important;width: 15px;"></td>
                    <td style="border: none!important;padding-left: 0px!important;">
                      <input type="text" name="" class="form-control" placeholder="" readonly="" style="width: 80px;" value="@if(isset($purchaseDetailsInfos)) @if(count($purchaseDetailsInfos)>0) {{$purchaseDetailsInfos[0]->sales_slip_flag}} @endif @endif">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="col-8">
              <table class="table custom-form" style="margin-bottom: 2px!important;margin-top: 8px;">
                <tbody>
                  <tr>
                    <td style="border: none!important;text-align: left;width: 94px !important;padding-left: 0px!important;color: #000;font-weight: bold;font-size: 0.9em;">
                      <div class="line-icon-box float-left mr-3"></div>受注金額
                    </td>
                    <td style="border: none!important;width: 120px;text-align: left;padding-left: 0px!important;color: #000;font-weight: bold;font-size: 0.9em;">@if(isset($purchaseDetailsInfos)) @if(count($purchaseDetailsInfos)>0) ¥ {{$purchaseDetailsInfos[0]->money10}} @else ¥ 0 @endif @else ¥ 0 @endif
                    </td>
                    <td style="border: none!important;width: 30px;"></td>
                    <td style="border: none!important;text-align: left;width: 94px !important;padding-left: 0px!important;color: #000;font-weight: bold;font-size: 0.9em;">
                      <div class="line-icon-box float-left mr-3"></div>仕入差額
                    </td>
                   <td style="border: none!important;text-align: left;padding-left: 0px!important;color: #000;font-weight: bold;font-size: 0.9em;" id="difference207">
                        ¥ 0
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="content-head-top">
          <div class="row mb-2">
            <div class="col-6 ml-auto">
              <table class="table custom-form" style="margin-bottom: 2px!important;">
                <tbody>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;width: 80px !important;padding-left: 0px!important;">
                      <div class="line-icon-box float-left mr-3"></div>指示者
                    </td>
                    <td style=" border: none!important;width: 196px;">
                      <div>
                        <div class="input-group input-group-sm position-relative">
                          <input type="text" id="input_instructor" class="form-control" placeholder="" readonly="" style="padding: 0!important;" value="@if(isset($purchaseDetailsInfos)) @if(count($purchaseDetailsInfos)>0) {{$purchaseDetailsInfos[0]->instructor}} @endif @endif">
                          <input type="hidden" id="input_instructor_h" class="form-control" placeholder="" readonly="" style="padding: 0!important;" @if(isset($purchaseDetailsInfos)) @if(count($purchaseDetailsInfos)>0) value="{{$purchaseDetailsInfos[0]->instructor_bango}}" @endif @endif>
                          <div class="input-group-append" id="modalarea">
                            <button id="instructorBtn" class="input-group-text btn" style="padding-left: 7px!important;width: 40px!important" @if(isset($purchaseDetailsInfos)) @if(count($purchaseDetailsInfos)>0) @if($purchaseDetailsInfos[0]->datachar16==1) disabled @endif @endif @endif>指示</button>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td style="border: none!important;width: 15px;"></td>
                    <td style="border: none!important;text-align: left;color: black;width: 80px !important;padding-left: 0px!important;">
                      <div class="line-icon-box float-left mr-3"></div>検印者
                    </td>
                    <td style=" border: none!important;width: 196px;">
                      <div>
                        <div class="input-group input-group-sm position-relative">
                          <input type="text" id="input_inspector" class="form-control" placeholder="" readonly="" style="padding: 0!important;" value="@if(isset($purchaseDetailsInfos)) @if(count($purchaseDetailsInfos)>0) {{$purchaseDetailsInfos[0]->inspector}} @endif @endif">
                          <input type="hidden" id="input_inspector_h" class="form-control" placeholder="" readonly="" style="padding: 0!important;" @if(isset($purchaseDetailsInfos)) @if(count($purchaseDetailsInfos)>0) value="{{$purchaseDetailsInfos[0]->inspector_bango}}" @endif @endif>
                          <div class="input-group-append" id="modalarea">
                            <button id="inspectorBtn" class="input-group-text btn" style="padding-left: 7px!important;width: 40px!important" @if(isset($purchaseDetailsInfos)) @if(count($purchaseDetailsInfos)>0) @if(($purchaseDetailsInfos[0]->datachar16==1) || ($tantousya->innerlevel > 17)) disabled @endif @endif @endif>検印</button>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td style="border: none!important;width: 15px;"></td>
                    <td style="border: none!important;padding-left: 0px!important;">
                      <button style="width: 100px;height: 28px;line-height: 28px;" id="updatePdBtn" class="btn btn-info" @if(isset($purchaseDetailsInfos)) @if(count($purchaseDetailsInfos)>0) @if($purchaseDetailsInfos[0]->datachar16==1) disabled @endif @endif @endif>更新</button>
                    </td>
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
