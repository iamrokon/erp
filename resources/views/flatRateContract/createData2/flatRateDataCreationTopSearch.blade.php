<div class="content-head-section" style="padding-bottom: 46px;">
  <div class="container">
      {{-- Success Message Starts Here --}}
      {{--@if(Session::has('success_msg'))
          <div class="row success-msg-box" id="success_msg" style="position: relative; width: 100%; max-width: 1452px; z-index: 1;" >
              <div class="col-12" style="white-space: normal; word-break: break-all;">
                  <div class="alert alert-primary alert-dismissible">
                      <button type="button" class="close dismissMe" data-dismiss="alert" autofocus
                              onclick="$('#division_datachar05_start').focus();">
                          &times;
                      </button>
                      <strong>{{session()->pull('success_msg') }}</strong>
                  </div>
              </div>
          </div>
      @endif--}}
          <div class="row success-msg-box" id="success_msg" style="width:100%; position: relative; width: 100%; max-width: 1452px; z-index: 1;"></div>
      {{-- Success Message Ends Here --}}

      {{-- Error Message Starts Here --}}
      <div  class="common_error" id="error_msg_div">@if(isset($dataCreationError)&& $dataCreationError!=null){{$dataCreationError}} @elseif(Session::has('error_msg')) {!! session()->pull('error_msg')  !!} @endif</div>
      {{-- Error Message Ends Here --}}
    <div class="row order_entry_topcontent flat_rate_data_creation">
      <div class="col">
        <div class="content-head-top">
            <form id="insertData">
                <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token">
                <input type="hidden" name="bango" id="userId" value="{{$bango}}">

                <div class="row">
                <div class="col-8">

                    @include('layout.commonOfficeDeptGroup')

                    <table class="table custom-form" style="width:auto;">
                        <tbody>
                            <tr>
                                <td style="border: none!important;text-align: left;color: black;width: 94px !important;padding-left: 0px!important;">
                                    <div class="line-icon-box float-left mr-3"></div>担当
                                </td>
                                <td style="border: none!important;width:350px;">
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
                            <tr>
                                <td style="border: none!important;text-align: left;color: black;width: 94px !important;padding-left: 0px!important;">
                                    <div class="line-icon-box float-left mr-3"></div>受注番号
                                </td>
                                <td style="border: none!important;width:350px;">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="order_no" id="order_no"
                                               oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');"
                                               placeholder="" maxlength="10" autocomplete="off" style="width: 96px!important;"
                                               value="">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
              </div>
                <div class="row">
                  <div class="ml-3 mr-3 d-flex mt-2 w-100 justify-content-end">
                    <div>
                      <button onclick="createData();event.preventDefault();" id="dataCreationBtn" href="#" class="btn btn-info uskc-button"
                        @if($tantousya->innerlevel>14) disabled @endif>データ作成
                      </button>
                    </div>
                    <div>
                      <div class="loading-icon" style="">
                        <span style="font-size: 30px;"><i class="fa fa-spinner" aria-hidden="true"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
