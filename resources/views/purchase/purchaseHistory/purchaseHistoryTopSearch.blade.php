<div class="content-head-section" style="padding: 13px 0 0;">
  <div class="container position-relative">
      {{-- Success Message Starts Here --}}
      @if(Session::has('success_msg'))
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
      @endif
      {{-- Success Message Ends Here --}}

      {{-- Error Message Starts Here --}}
      <div  class="common_error" id="error_msg_div">@if(isset($purchaseHistoryError)&& $purchaseHistoryError!=null){{$purchaseHistoryError}} @elseif(Session::has('error_msg')) {!! session()->pull('error_msg')  !!} @endif</div>
      {{-- Error Message Ends Here --}}
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
    <div class="row order_entry_topcontent purchase-hislist-top-content">
    <form id="firstSearch" action="{{ route('purchaseHistory') }}" method="post">
        @csrf
        <input type="hidden" name="firstButton" value="topSearch">
        <input type="hidden" id="userId" name="userId" value="{{$bango}}">
        <div class="col">
        <div class="content-head-top" style="border-bottom:0px!important;margin-bottom:0px; ">
          <div class="row mb-2">
            <div class="col">
<!--              <table class="table custom-form" style="width:auto;margin-bottom: 0px!important;">
                <tbody>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;width:95px !important;">
                      <div class="line-icon-box float-left mr-3"></div> 事業部
                    </td>
                    <td style="border: none!important;width:270px;">
                      <div class="custom-arrow">
                        <select class="form-control" name="" id="" autofocus>
                          <option value="">03 東日本ソリューション事業部</option>
                          <option value="">fdjlkasdjflasdjf</option>
                          <option value="">fdjlkasdjflasdjf</option>
                          <option value="">fdjlkasdjflasdjf</option>
                          <option value="">fdjlkasdjflasdjf</option>
                        </select>
                      </div>
                    </td>
                    <td
                      style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
                      ～
                    </td>
                    <td style="border: none!important;width:270px;">
                      <div class="custom-arrow">
                        <select class="form-control" name="" id="">
                          <option value="">選択してください</option>
                          <option value=""></option>
                        </select>
                      </div>

                    </td>
                  </tr>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;">
                      <div class="line-icon-box float-left mr-3"></div>部
                    </td>
                    <td style="border: none!important;">
                      <div class="custom-arrow">
                        <select class="form-control" name="" id="">
                          <option value="">1 東日本ソリューション営業部</option>
                          <option value=""></option>
                        </select>
                      </div>
                    </td>
                    <td
                      style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
                      ～
                    </td>
                    <td style="border: none!important;">
                      <div class="custom-arrow">
                        <select class="form-control" name="" id="">
                          <option value="">選択してください</option>
                          <option value=""></option>
                        </select>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;">
                      <div class="line-icon-box float-left mr-3"></div>グループ
                    </td>
                    <td style="border: none!important;">
                      <div class="custom-arrow">
                        <select class="form-control" name="" id="">
                          <option value="">1 第1グループ</option>
                          <option value=""></option>
                        </select>
                      </div>
                    </td>
                    <td
                      style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
                      ～
                    </td>
                    <td style="border: none!important;">
                      <div class="custom-arrow">
                        <select class="form-control" name="" id="">
                          <option value="">選択してください</option>
                          <option value=""></option>
                        </select>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>-->
                @include('layout.commonOfficeDeptGroup')

              <table class="table custom-form" style="margin-bottom: 0px!important;width: auto;">
                <tbody>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;width: 101px !important;padding-left:0px!important;">
                      <div class="line-icon-box float-left mr-3"></div>担当
                    </td>
                    <td style="text-align: center;border: none!important;;width:277px!important;">
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
                    {{-- <td
                    style="border: none!important;width: 40px!important; max-width: 40px!important;">

                  </td> --}}
                  <td style="border: none!important;width:310px;">

                  </td>
                  </tr>
                </tbody>
              </table>
              <table class="table custom-form" style="width:auto;">
                <tbody>
                  <tr>
                    <td style="border: none!important;text-align: left;color: black;width:101px !important;padding-left:0px!important;">
                      <div class="line-icon-box float-left mr-3"></div>仕入先
                    </td>
                    <td style="border: none!important;width:288px;">
<!--                      <div class="input-group input-group-sm position-relative">
                        <input type="text" class="form-control" placeholder="仕入先"
                          style="width: 94px!important;padding-left: 0px !important;">
                        <div class="input-group-append" id="modalarea" data-toggle="modal"
                          data-target="#search_modal4">
                          <button class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                        </div>
                      </div>-->
                        <div class="input-group input-group-sm ">
                            <input type="text" name="information1_text" id="tsearch_information1_v2" value="{{isset($fsReqData['information1_text'])?$fsReqData['information1_text']:null}}" class="form-control" readonly="" style="padding: 0!important;">
                            <input name="information1_short" id="tsearch_information1_db" value="{{isset($fsReqData['information1_short'])?$fsReqData['information1_short']:null}}" type="hidden" >
                            <div class="input-group-append" >
                              <button onclick="supplierSelectionModalOpener_2('tsearch_information1_v2','tsearch_information1_db','1','nullable','r16cd',event.preventDefault())" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                            </div>
                        </div>
                    </td>
                    <td
                      style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
                      ～
                    </td>
                    <td style="border: none!important;width:270px;">
<!--                      <div class="input-group input-group-sm position-relative">
                        <input type="text" name="" class="form-control" placeholder="仕入先"
                          style="padding-left: 0px !important;width: 80px;">
                        <div class="input-group-append" id="modalarea" data-toggle="modal"
                          data-target="#search_modal4">
                          <button class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                        </div>
                      </div>-->
                         <div class="input-group input-group-sm ">
                            <input type="text" name="information2_text" id="tsearch_information2_v2" value="{{isset($fsReqData['information2_text'])?$fsReqData['information2_text']:null}}" class="form-control" readonly="" style="padding: 0!important;">
                            <input name="information2_short" id="tsearch_information2_db" value="{{isset($fsReqData['information2_short'])?$fsReqData['information2_short']:null}}" type="hidden" >
                            <div class="input-group-append" >
                              <button onclick="supplierSelectionModalOpener_2('tsearch_information2_v2','tsearch_information2_db','1','nullable','r16cd',event.preventDefault())" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                            </div>
                         </div>
                    </td>
                  </tr>

                </tbody>
              </table>
            </div>
            <div class="col">
              <div>
                <div class="radio-rounded d-inline-block">
                  <div class="custom-control custom-radio custom-control-inline"
                    style="padding-left: 9px!important;">
                    <input type="radio" class="custom-control-input" id="customRadio4" name="rd2" value="1" @if(isset($fsReqData['rd2'])&& $fsReqData['rd2']=="1"){{"checked"}}@endif checked="">
                    <label class="custom-control-label" for="customRadio4"
                      style="font-size: 12px!important;cursor:pointer;"> 仮引当</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline"
                    style="padding-left:11px!important;">
                    <input type="radio" class="custom-control-input" id="customRadio5" name="rd2" value="2" @if(isset($fsReqData['rd2'])&& $fsReqData['rd2']=="2"){{"checked"}}@endif>
                    <label class="custom-control-label " for="customRadio5"
                      style="font-size: 12px!important;cursor:pointer;"> 指示</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline"
                    style="padding-left:11px!important;">
                    <input type="radio" class="custom-control-input" id="customRadio6" name="rd2" value="3" @if(isset($fsReqData['rd2'])&& $fsReqData['rd2']=="3"){{"checked"}}@endif>
                    <label class="custom-control-label" for="customRadio6"
                      style="font-size: 12px!important;cursor:pointer;">指示+仮引当</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline"
                    style="padding-left:11px!important;">
                    <input type="radio" class="custom-control-input" id="customRadio7" name="rd2" value="4" @if(isset($fsReqData['rd2'])&& $fsReqData['rd2']=="4"){{"checked"}}@endif>
                    <label class="custom-control-label" for="customRadio7"
                      style="font-size: 12px!important;cursor:pointer;">検印</label>
                  </div>
                </div>
                <div class="radio-rounded">
                  <div class="custom-control custom-radio custom-control-inline"
                    style="padding-left: 9px!important;">
                    <input type="radio" class="custom-control-input" id="customRadio8" name="rd3" value="1" @if(isset($fsReqData['rd3'])&& $fsReqData['rd3']=="1"){{"checked"}}@endif checked="">
                    <label class="custom-control-label" for="customRadio8"
                      style="font-size: 12px!important;cursor:pointer;"> 仕入</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline"
                    style="padding-left:23px!important;">
                    <input type="radio" class="custom-control-input" id="customRadio9" name="rd3" value="2" @if(isset($fsReqData['rd3'])&& $fsReqData['rd3']=="2"){{"checked"}}@endif>
                    <label class="custom-control-label" for="customRadio9"
                      style="font-size: 12px!important;cursor:pointer;"> 購入</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline"
                    style="padding-left:11px!important;">
                    <input type="radio" class="custom-control-input" id="customRadio10" name="rd3" value="3" @if(isset($fsReqData['rd3'])&& $fsReqData['rd3']=="3"){{"checked"}}@endif>
                    <label class="custom-control-label" for="customRadio10"
                      style="font-size: 12px!important;cursor:pointer;">すべて</label>
                  </div>
                </div>
              </div>

              <div>
                <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                  <tbody>
                    <tr>
                      <td style="border: none!important;text-align: left;color: black;width: 94px !important;">
                        <div class="line-icon-box float-left mr-3"></div>入力日
                      </td>
                      <td style="border: none!important;width: 151px;">
                        <input type="text" name="inputDateFrom" id="datepicker1" class="form-control datePicker datePicker1_1"
                          autocomplete="off" value="{{isset($fsReqData['inputDateFrom'])?$fsReqData['inputDateFrom']:$lastYear}}" placeholder="年/月/日"
                          oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                          onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))"
                          maxlength="10" autofocus="">
                        <input type="hidden" class="datePickerHidden" id="datepicker1_h">
                      </td>
                      <td style="width: 30px!important;border:0!important;text-align: center;">
                        ～
                      </td>
                      <td style="border: none!important;width: 151px;">
                        <input type="text" name="inputDateTo" id="datepicker2" class="form-control datePicker datePicker1_2"
                          autocomplete="off" value="{{isset($fsReqData['inputDateTo'])?$fsReqData['inputDateTo']:$systemDate}}" placeholder="年/月/日"
                          oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                          onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))"
                          maxlength="10">
                        <input type="hidden" class="datePickerHidden" id="datepicker2_h">
                      </td>
                    </tr>
                  </tbody>
                </table>
                <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                  <tbody>
                    <tr>
                      <td style="border: none!important;text-align: left;color: black;width: 94px !important;">
                        <div class="line-icon-box float-left mr-3"></div>仕入日
                      </td>
                      <td style="border: none!important;width: 151px;">
                        <input type="text" name="purchaseDateFrom" id="datepicker3" class="form-control datePicker datePicker2_1"
                          autocomplete="off" value="{{isset($fsReqData['purchaseDateFrom'])?$fsReqData['purchaseDateFrom']:$beforeSystemDate}}" placeholder="年/月/日"
                          oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                          onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))"
                          maxlength="10" autofocus="">
                        <input type="hidden" class="datePickerHidden" id="datepicker3_h">
                      </td>
                      <td style="width: 30px!important;border:0!important;text-align: center;">
                        ～
                      </td>
                      <td style="border: none!important;width: 151px;">
                        <input type="text" name="purchaseDateTo" id="datepicker4" class="form-control datePicker datePicker2_2"
                          autocomplete="off" value="{{isset($fsReqData['purchaseDateTo'])?$fsReqData['purchaseDateTo']:$systemDate}}" placeholder="年/月/日"
                          oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                          onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))"
                          maxlength="10">
                        <input type="hidden" class="datePickerHidden" id="datepicker4_h">
                      </td>
                    </tr>
                  </tbody>
                </table>
                <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                  <tbody>
                    <tr>
                      <td style="border: none!important;text-align: left;color: black;width: 94px !important;">
                        <div class="line-icon-box float-left mr-3"></div>仕入番号
                      </td>
                      <td style="border: none!important;width: 151px;">
                        <input type="text" name="purchaseNoFrom" id="purchaseNoFrom"
                          oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');"
                          class="form-control" autocomplete="off"  value="{{isset($fsReqData['purchaseNoFrom'])?$fsReqData['purchaseNoFrom']:null}}" placeholder="" maxlength="10">
                      </td>
                      <td style="width: 30px!important;border:0!important;text-align: center;">
                        ～
                      </td>
                      <td style="border: none!important;width: 151px;">
                        <input type="text" name="purchaseNoTo" id="purchaseNoTo"
                          oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');"
                          class="form-control" autocomplete="off" value="{{isset($fsReqData['purchaseNoTo'])?$fsReqData['purchaseNoTo']:null}}" placeholder="" maxlength="10">
                      </td>
                    </tr>
                  </tbody>
                </table>
                <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                  <tbody>
                    <tr>
                      <td style="border: none!important;text-align: left;color: black;width: 94px !important;">
                        <div class="line-icon-box float-left mr-3"></div>会計科目
                      </td>
                      <td style="border: none!important;width: 233px;">
                        <div class="custom-arrow">
                          <select class="form-control" name="accountingSub" id="accountingSub">
                              <option value=""> - </option>
                              @foreach ($data310 as $categoryKanri)
                                  @if(isset($fsReqData['accountingSub']))
                                      <option value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}" @if($categoryKanri->category1 . $categoryKanri->category2==$fsReqData['accountingSub']){{'selected'}}@endif>
                                          {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                                      </option>
                                  @else
                                      <option value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}">
                                          {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                                      </option>
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

        </div>

   
      </div>
      
  
    </div>
    <div style="border-top: 1px solid #E1E1E1; border-bottom: 1px solid #E1E1E1;margin-top:100px;margin-bottom:8px;">

        <div class="row mt-4 mb-4">
            <div class="col-8">
              <div class="radio-rounded d-inline-block">
                <div class="custom-control custom-radio custom-control-inline"
                  style="padding-left:11px!important;">
                  <input type="radio" class="custom-control-input" id="customRadio" name="rd1" value="1" @if(isset($fsReqData['rd1'])&& $fsReqData['rd1']=="1"){{"checked"}}@endif checked="">
                  <label class="custom-control-label" for="customRadio"
                    style="font-size: 12px!important;cursor:pointer;">新規</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline"
                  style="padding-left:20px!important;">
                  <input type="radio" class="custom-control-input" id="customRadio2" name="rd1" value="2" @if(isset($fsReqData['rd1'])&& $fsReqData['rd1']=="2"){{"checked"}}@endif>
                  <label class="custom-control-label" for="customRadio2"
                    style="font-size: 12px!important;cursor:pointer;"> 訂正分のみ</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline"
                  style="padding-left:20px!important;">
                  <input type="radio" class="custom-control-input" id="customRadio3" name="rd1" value="3" @if(isset($fsReqData['rd1'])&& $fsReqData['rd1']=="3"){{"checked"}}@endif>
                  <label class="custom-control-label" for="customRadio3"
                    style="font-size: 12px!important;cursor:pointer;">すべて</label>
                </div>
              </div>
            </div>
            <div class="col-4">
              <div class="d-inline-block float-right">
                <a style="width: 150px;height:30px;line-height:30px;" class="btn btn-info" id="topSearchBtn">表示</a>
              </div>
            </div>
      
        </div>
      
    </div>
  </form>
  </div>
</div>
