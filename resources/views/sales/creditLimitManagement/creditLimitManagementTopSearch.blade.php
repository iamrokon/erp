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
          <div id="error_data" class="common_error" style="color: red;position: relative;">@if(isset($creditLimitManagementError)&& $creditLimitManagementError!=null){{$creditLimitManagementError}} @endif</div>
        </div>
      </div>
    {{-- Error Message Ends Here --}}
    <div class="row order_entry_topcontent credit_limit_mangement_top ">
        <form id="firstSearch" action="{{ route('creditLimitManagement') }}" method="post" style="width: 100%;">
            @csrf
            <input type="hidden" name="firstButton" value="topSearch">
            <input type="hidden" id="userId" name="userId" value="{{$bango}}">
            <div class="col">

            <div class="content-head-top inner-top-content2" >
              @include('layout.commonOfficeDeptGroup')
              <div class="row outer" style="margin-bottom: 19px;">
                <div class="col-6">
                  <table class="table custom-form" style="width:auto;">
                    <tbody>
<!--                      <tr>
                        <td style="border: none!important;text-align: left;color: black;width:90px !important;padding: 0!important;">
                          <div class="line-icon-box float-left mr-3"></div>事業部
                        </td>
                        <td style="border: none!important;width:270px;">
                          <div class="custom-arrow position-relative">
                            <select id="test" class="form-control disabledDesign" style="width:100%;" autofocus="">
                              <option value="0">03 東日本ソリューション事業部</option>
                              <option value="1">03 東日本ソリューション事業部</option>
                              <option value="2">03 東日本ソリューション事業部</option>
                              <option value="3">03 東日本ソリューション事業部</option>
                            </select>
                          </div>
                        </td>
                        <td style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
                          ～
                        </td>
                        <td style="border: none!important;width:270px;">
                          <div class="custom-arrow">
                            <select class="form-control" style="width:100%;" autofocus="">
                              <option value="0">03 東日本ソリューション事業部</option>
                            </select>
                          </div>

                        </td>
                      </tr>
                      <tr>
                        <td style="border: none!important;text-align: left;color: black;padding: 0!important;"><div class="line-icon-box float-left mr-3"></div>部
                        </td>
                        <td style="border: none!important;">
                          <div class="custom-arrow">
                            <select id="sdb" class="form-control" style="width:100%;">
                              <option value="0">1 東日本ソリューション営業部</option>
                            </select>
                          </div>
                        </td>
                        <td style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
                          ～
                        </td>
                        <td style="border: none!important;">
                          <div class="custom-arrow">
                            <select class="form-control" style="width:100%;">
                              <option value="0">1 東日本ソリューション営業部</option>
                            </select>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td style="border: none!important;text-align: left;color: black;padding: 0!important;">
                          <div class="line-icon-box float-left mr-3"></div>グループ
                        </td>
                        <td style="border: none!important;">
                            <div class="custom-arrow">
                              <select class="form-control" style="width:100%;">
                                <option value="0">0 保守</option>
                              </select>
                            </div>
                        </td>
                        <td style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
                            ～
                          </td>
                        <td style="border: none!important;">
                          <div class="custom-arrow">
                            <select class="form-control" style="width:100%;">
                              <option value="0">0 保守</option>
                            </select>
                          </div>
                        </td>
                      </tr>-->
                      <tr>
                        <td style="border: none!important;text-align: left;color: black;padding: 0!important;width: 94px!important;">
                          <div class="line-icon-box float-left mr-3"></div>担当
                        </td>
                        <td style="border: none!important;width: 270px!important;">
                            <div class="custom-arrow">
                                <select name="datachar05" id="datachar05" class="form-control disabledDesign" style="width:100%;" autofocus="" > <!-- id="hidari0003" onchange="hidarifilter0003($(this))" -->
                                    <option value="">-</option>
                                    @foreach($datachar05 as $dtchar05)
                                        @if(isset($fsReqData['datachar05']))
                                            <option value="{{$dtchar05->bango}}" @if($dtchar05->bango==$fsReqData['datachar05']){{'selected'}}@endif>
                                                {{$dtchar05->bango." ".$dtchar05->name}}
                                            </option>
                                        @else
                                            @if(isset($fsReqData) && count($fsReqData)>0)
                                                <option value="{{$dtchar05->bango}}">
                                                    {{$dtchar05->bango." ".$dtchar05->name}}
                                                </option>
                                            @else
                                                <option value="{{$dtchar05->bango}}" @if($dtchar05->bango==$bango){{'selected'}}@endif>
                                                    {{$dtchar05->bango." ".$dtchar05->name}}
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


              </div>
            </div>
            <div class="content-head-top">
              <div class="row my-3">
                <div class="col-4 ml-auto">
                  <div class="d-inline-block float-right">
                    <button style="width: 150px;height:30px;line-height:30px;" class="btn btn-info">表示</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
    </div>
  </div>
</div>
